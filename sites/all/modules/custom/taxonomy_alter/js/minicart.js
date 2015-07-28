  (function(factory) {
    if (typeof define === "function" && define.amd) {
      define(factory)
    }
    else {
      window.purl = factory()
    }
  })(function() {
  var tag2attr = {
    a: "href",
    img: "src",
    form: "action",
    base: "href",
    script: "src",
    iframe: "src",
    link: "href",
    embed: "src",
    object: "data"
  },
  key = ["source", "protocol", "authority", "userInfo", "user", "password", "host", "port", "relative", "path", "directory", "file", "query", "fragment"],
  aliases = {
    "anchor": "fragment"
  },
  parser = {
    strict: /^(?:([^:\/?#]+):)?(?:\/\/((?:(([^:@]*):?([^:@]*))?@)?([^:\/?#]*)(?::(\d*))?))?((((?:[^?#\/]*\/)*)([^?#]*))(?:\?([^#]*))?(?:#(.*))?)/,
    loose: /^(?:(?![^:@]+:[^:@\/]*@)([^:\/?#.]+):)?(?:\/\/)?((?:(([^:@]*):?([^:@]*))?@)?([^:\/?#]*)(?::(\d*))?)(((\/(?:[^?#](?![^?#\/]*\.[^?#\/.]+(?:[?#]|$)))*\/?)?([^?#\/]*))(?:\?([^#]*))?(?:#(.*))?)/
  },
  isint = /^[0-9]+$/;

  function parseUri(url, strictMode) {
    var str = decodeURI(url),
      res = parser[strictMode || false ? "strict" : "loose"].exec(str),
      uri = {
        attr: {},
        param: {},
        seg: {}
      },
      i = 14;
    while (i--) {
      uri.attr[key[i]] = res[i] || ""
    }
    uri.param["query"] = parseString(uri.attr["query"]);
    uri.param["fragment"] = parseString(uri.attr["fragment"]);
    uri.seg["path"] = uri.attr.path.replace(/^\/+|\/+$/g, "").split("/");
    uri.seg["fragment"] = uri.attr.fragment.replace(/^\/+|\/+$/g, "").split("/");
    uri.attr["base"] = uri.attr.host ? (uri.attr.protocol ? uri.attr.protocol + "://" + uri.attr.host : uri.attr.host) + (uri.attr.port ? ":" + uri.attr.port : "") : "";
    return uri
  }

  function getAttrName(elm) {
    var tn = elm.tagName;
    if (typeof tn !== "undefined") {
      return tag2attr[tn.toLowerCase()]
    }
    return tn
  }

  function promote(parent, key) {
    if (parent[key].length === 0) {
      return parent[key] = {}
    }
    var t = {};
    for (var i in parent[key]) {
      t[i] = parent[key][i]
    }
    parent[key] = t;
    return t
  }

  function parse(parts, parent, key, val) {
    var part = parts.shift();
    if (!part) {
      if (isArray(parent[key])) {
        parent[key].push(val)
      }
      else {
        if ("object" == typeof parent[key]) {
          parent[key] = val
        }
        else {
          if ("undefined" == typeof parent[key]) {
            parent[key] = val
          }
          else {
            parent[key] = [parent[key], val]
          }
        }
      }
    }
    else {
      var obj = parent[key] = parent[key] || [];
      if ("]" == part) {
        if (isArray(obj)) {
          if ("" !== val) {
            obj.push(val)
          }
        }
        else {
          if ("object" == typeof obj) {
            obj[keys(obj).length] = val
          }
          else {
            obj = parent[key] = [parent[key], val]
          }
        }
      }
      else {
        if (~part.indexOf("]")) {
          part = part.substr(0, part.length - 1);
          if (!isint.test(part) && isArray(obj)) {
            obj = promote(parent, key)
          }
          parse(parts, obj, part, val)
        }
        else {
          if (!isint.test(part) && isArray(obj)) {
            obj = promote(parent, key)
          }
          parse(parts, obj, part, val)
        }
      }
    }
  }

  function merge(parent, key, val) {
    if (~key.indexOf("]")) {
      var parts = key.split("[");
      parse(parts, parent, "base", val)
    }
    else {
      if (!isint.test(key) && isArray(parent.base)) {
        var t = {};
        for (var k in parent.base) {
            t[k] = parent.base[k]
        }
        parent.base = t
      }
      if (key !== "") {
        set(parent.base, key, val)
      }
    }
    return parent
  }

  function parseString(str) {
    return reduce(String(str).split(/&|;/), function(ret, pair) {
      try {
        pair = decodeURIComponent(pair.replace(/\+/g, " "))
      }
      catch (e) {}
      var eql = pair.indexOf("="),
        brace = lastBraceInKey(pair),
        key = pair.substr(0, brace || eql),
        val = pair.substr(brace || eql, pair.length);
      val = val.substr(val.indexOf("=") + 1, val.length);
      if (key === "") {
        key = pair;
        val = ""
      }
      return merge(ret, key, val)
    }, {
      base: {}
    }).base
  }

  function set(obj, key, val) {
    var v = obj[key];
    if (typeof v === "undefined") {
      obj[key] = val
    }
    else {
      if (isArray(v)) {
        v.push(val)
      }
      else {
        obj[key] = [v, val]
      }
    }
  }

  function lastBraceInKey(str) {
    var len = str.length,
      brace, c;
    for (var i = 0; i < len; ++i) {
      c = str[i];
      if ("]" == c) {
        brace = false
      }
      if ("[" == c) {
        brace = true
      }
      if ("=" == c && !brace) {
        return i
      }
    }
  }

  function reduce(obj, accumulator) {
    var i = 0,
      l = obj.length >> 0,
      curr = arguments[2];
    while (i < l) {
      if (i in obj) {
        curr = accumulator.call(undefined, curr, obj[i], i, obj)
      }++i
    }
    return curr
  }

  function isArray(vArg) {
    return Object.prototype.toString.call(vArg) === "[object Array]"
  }

  function keys(obj) {
    var key_array = [];
    for (var prop in obj) {
      if (obj.hasOwnProperty(prop)) {
        key_array.push(prop)
      }
    }
    return key_array
  }

  function purl(url, strictMode) {
    if (arguments.length === 1 && url === true) {
      strictMode = true;
      url = undefined
    }
    strictMode = strictMode || false;
    url = url || window.location.toString();
    return {
      data: parseUri(url, strictMode),
      attr: function(attr) {
        attr = aliases[attr] || attr;
        return typeof attr !== "undefined" ? this.data.attr[attr] : this.data.attr
      },
      param: function(param) {
        return typeof param !== "undefined" ? this.data.param.query[param] : this.data.param.query
      },
      fparam: function(param) {
        return typeof param !== "undefined" ? this.data.param.fragment[param] : this.data.param.fragment
      },
      segment: function(seg) {
        if (typeof seg === "undefined") {
          return this.data.seg.path
        }
        else {
          seg = seg < 0 ? this.data.seg.path.length + seg : seg - 1;
          return this.data.seg.path[seg]
        }
      },
      fsegment: function(seg) {
        if (typeof seg === "undefined") {
          return this.data.seg.fragment
        } else {
          seg = seg < 0 ? this.data.seg.fragment.length + seg : seg - 1;
          return this.data.seg.fragment[seg]
        }
      }
    }
  }

  purl.jQuery = function($) {
    if ($ != null) {
      $.fn.url = function(strictMode) {
        var url = "";
        if (this.length) {
          url = $(this).attr(getAttrName(this[0])) || ""
        }
        return purl(url, strictMode)
      };
      $.url = purl
    }
  };
  purl.jQuery(window.jQuery);
  return purl
});

var addToCart = (function() {
  var _itemCount;
  var _itemNumber;
  var _unitPrice;
  var _itemCountInCart = 0;
  var _itemCountAdded = 0;
  var parseItemCountObj = {};
  var parseItemCountEventDoneName = "parseItemCountEventDone";
  var _parseItemCountFromCookie = function() {
    NEG.run(function(require) {
      var cookie = require("NEG.Utility.Cookie");
      var jq = require("NEG.ThirdParty.jQuery");
      var cartinfo = cookie.get("NV_CARTINFO");
      try {
        if (cartinfo && cartinfo.length > 2) {
          cartinfo = cartinfo.substring(2);
          var cart = jQuery.parseJSON(cartinfo);
          if (cart) {
            var reg = /\d+/gi;
            var itemCount = reg.exec(cart.Sites.USA.Value);
            if (itemCount && itemCount != "") {
              _itemCountAdded = itemCount[0] - _itemCountInCart;
              _itemCountInCart = itemCount[0];
              NEG(parseItemCountObj).trigger("parseItemCountEventDone");
            }
          }
        }
      }
      catch (exception) {}
    });
  };

  var updateMiniCartClass = function() {};

  return {
    newegg_add_cart_callback: function(d) {
      if (d) {
        if (d.msg == "success") {
          jQuery('#block-gamecrate-core-newegg-buy-box a.' + _itemNumber).attr("href", "http://secure.newegg.com/Shopping/ShoppingCart.aspx");
          jQuery('.block-newegg-featured-products a.' + _itemNumber).addClass("button-primary");

          var timeout;
          var timeout2;
          clearTimeout(timeout);
          timeout = setTimeout(function() {
            jQuery('.block-newegg-featured-products a.' + _itemNumber).text("Loading...");
            jQuery('#block-gamecrate-core-newegg-buy-box a.' + _itemNumber).text("Loading...");
            jQuery('.deals-wrap .featured-seller a.' + _itemNumber).text("Loading...");
          }, 500);

          clearTimeout(timeout2);
          timeout2 = setTimeout(function() {
            jQuery('.block-newegg-featured-products a.' + _itemNumber).text("Checkout");
            jQuery('#block-gamecrate-core-newegg-buy-box a.' + _itemNumber).text("Checkout");
            jQuery('.deals-wrap .featured-seller a.' + _itemNumber).text("Checkout");
          }, 1500);

          jQuery('.block-newegg-featured-products a.' + _itemNumber).attr("href", "http://secure.newegg.com/Shopping/ShoppingCart.aspx");
          jQuery('.deals-wrap .featured-seller a.' + _itemNumber).attr("href", "http://secure.newegg.com/Shopping/ShoppingCart.aspx");
          jQuery('#block-gamecrate-core-newegg-buy-box a.' + _itemNumber + ', .block-newegg-featured-products a.' + _itemNumber).click(function() {
            jQuery(location).attr('href', 'http://secure.newegg.com/Shopping/ShoppingCart.aspx');
          });

          jQuery(".buybox-modal-close, .cb-dark-bg").click(function(e) {
              e.preventDefault();
              jQuery("#buybox-modal_" + _itemNumber).animate({
                  opacity: 0
              }, 350, function() {
                  jQuery(".cb-dark-bg").animate({
                      opacity: 0
                  }, 250, function() {
                      jQuery("#buybox-modal_" + _itemNumber).toggle();
                      jQuery(".cb-dark-bg").toggle();
                      jQuery(".cb-dark-bg").remove();
                  });
              });
          });

          if (s) {
            s.linkTrackEvents = s.events = "scAdd,event16,event17";
            if (_itemCountInCart == 0) {
                s.linkTrackEvents = s.events = "scAdd,scOpen,event16,event17";
            }
            s.products = ";" + _itemNumber + ";;;event16=" + _unitPrice.toString() + "|event17=" + _itemCount.toString();
            s.tl(this, 'o', "gamecrate add to cart");
          }
          _parseItemCountFromCookie();
          jQuery(window).resize();
        }
      }
    },
    newegg_add_cart: function(theAjaxUrl, itemNumber, unitPrice) {
      _itemCount = jQuery("#qtyMainItems_" + itemNumber).val();
      _itemNumber = itemNumber;
      _unitPrice = unitPrice;
      theAjaxUrl = theAjaxUrl + "|" + _itemCount;
      _parseItemCountFromCookie();
      jQuery.ajax({
        url: theAjaxUrl,
        processData: false,
        cache: false,
        dataType: 'jsonp',
        jsonp: "callback",
        jsonpCallback: 'addToCart.newegg_add_cart_callback'
      });
    },
    update_mini_cart: function() {
      updateMiniCartClass();
    }
  }
})();

addToCart.update_mini_cart();

NEG.domReady(function() {
  var checkQTY = function() {
    var value = this.value;
    var lmtqty = jQuery(this).attr("lmtqty");
    if (value) {
      var regQTY = /[1-9]\d*/gi;
      var result = value.match(regQTY);
      if (result != value) {
        this.value = 1;
      }
      else {
        if (parseInt(value) < 1) {
          this.value = 1;
        }
        if (lmtqty && parseInt(lmtqty) < parseInt(value)) {
          this.value = lmtqty;
        }
      }
    }
    else {
      this.value = 1;
    }
  };
  jQuery("input[id^='qtyMainItems_']").blur(checkQTY);
  jQuery("input[id^='qtyMainItems_']").keyup(checkQTY);
  jQuery("input[id^='qtyMainItems_']").mouseout(checkQTY);
  jQuery(window).resize(function(e) {
    var mobilMiniCar = jQuery("#MiniCart-mobile");
    if (mobilMiniCar.css("display") == "none") {
      var minicart = jQuery("#MiniCart");
      var cartframe = minicart.find("iframe");
      var framepurl = cartframe.url();
      var newframeurl = framepurl.attr("protocol") + "://" + framepurl.attr("host") + framepurl.attr("path");
      var time = new Date();

      newframeurl = newframeurl + "?t=" + time.getMilliseconds();

      var width = jQuery(document).width();
      var iframeHeight = cartframe.height();
      if (width >= 1200) {
        newframeurl = newframeurl + "#height=48&cartSize=31&countSize=16&needRefresh=1";
        iframeHeight = 48;
      }
      else if (width > 1002) {
        newframeurl = newframeurl + "#height=46&cartSize=29&countSize=16&needRefresh=1";
        iframeHeight = 46;
      }
      else {
        newframeurl = newframeurl + "#height=39&cartSize=22&countSize=14&needRefresh=1";
        iframeHeight = 39;
      }

        cartframe.attr("src", newframeurl);
        cartframe.height(iframeHeight);
        minicart.height(iframeHeight);
        jQuery("#cb-nav-bar").height(iframeHeight).css("overflow", "hidden");
      }
    });
    jQuery(window).resize();
  });
