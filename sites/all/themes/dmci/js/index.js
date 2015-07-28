(function ($, Drupal) {
  Drupal.behaviors.dmci = {
    attach: function (context, settings) {

      $('.close-approval').click(function() {
        $('.approval').foundation('reveal', 'close');
      })

      function compute_sheet(price, $this) {
        $('.calc').show();
        $('.important').show();

        var option_index = $this[0].selectedIndex;
        var downpayment_percentage = $('.term').find('input').eq(option_index-1).data('downpayment');
        var bank_percentage = $('.term').find('input').eq(option_index-1).data('bank');

        // Unit Price.
        $('#calc-unit-price-amount').html(accounting.formatNumber(price, 2));

        // Regular Discount.
        var reg_discount = $this.val();
        var decimal_reg_discount = reg_discount / 100;
        var reg_discount_amount = price * decimal_reg_discount;
        $('#calc-reg-discount-label').html(accounting.formatNumber(reg_discount, 2) + "%");
        $('#calc-reg-discount-amount').html(accounting.formatNumber(reg_discount_amount, 2));

        // Net.
        var net = price - reg_discount_amount;
        $('#calc-net-amount').html(accounting.formatNumber(net, 2));

        // PDC.
        var pdc_discount = 2;
        var decimal_pdc_discount = pdc_discount / 100;
        var pdc_discount_amount = net * decimal_pdc_discount;
        $('#calc-pdc-discount-label').html(accounting.formatNumber(pdc_discount, 2) + "%");
        $('#calc-pdc-discount-amount').html(accounting.formatNumber(pdc_discount_amount, 2));

        // Total Price.
        var total_price = net - pdc_discount_amount;
        $('#calc-total-price').html(accounting.formatNumber(total_price, 2));

        // Divided in DP Period.
        var dp_discount = 10;
        var decimal_dp_discount = dp_discount / 100;
        var dp_discount_amount = total_price * decimal_dp_discount;
        $('#calc-dp-period-label').html(accounting.formatNumber(dp_discount, 2) + "%");
        $('#calc-dp-period-amount').html(accounting.formatNumber(dp_discount_amount, 2));

        // Downpayment.
        var downpayment = downpayment_percentage;
        var decimal_downpayment = downpayment / 10;
        var downpayment_amount = dp_discount_amount * decimal_downpayment;
        $('#calc-downpayment-label').html(accounting.formatNumber(downpayment, 2) + "%");
        $('#calc-downpayment-amount').html(accounting.formatNumber(downpayment_amount, 2));

        // 1st Net Downpayment.
        $('#calc-net-downpayment-amount').html(accounting.formatNumber(downpayment_amount, 2));

        // Less: Reservation Fee.
        var reservation_fee = 20000;
        $('#reservation-fee').html(accounting.formatNumber(reservation_fee, 2));

        // 2nd Net Downpayment.
        var downpayment_amount_2 = downpayment_amount - reservation_fee;
        $('#calc-net-downpayment-amount-2').html(accounting.formatNumber(downpayment_amount_2, 2));

        // Payable In.
        var month_spread = $('#month-spread-php').val();
        var payable_in_amount = downpayment_amount_2 / month_spread;
        $('#calc_payable_in_label').html(month_spread);
        $('.calc_payable_in_amount').html(accounting.formatNumber(payable_in_amount, 2));

        // Balance.
        var bank = bank_percentage;
        var decimal_bank = bank / 100;
        var balance = total_price * decimal_bank;
        $('#balance_label').html(accounting.formatNumber(bank_percentage, 2) + "%");
        $('#balance_amount').html(accounting.formatNumber(balance, 2));

        // Total Contract Price.
        $('.total_contract_price_amount').html(accounting.formatNumber(total_price, 2));
      }

      var swiper = new Swiper('.swiper-container', {
        pagination: '.swiper-pagination',
        paginationClickable: true,
        grabCursor: true,
        nextButton: '.swiper-button-next',
        prevButton: '.swiper-button-prev'
      });

      var swiper2 = new Swiper('.swiper-container2', {
        pagination: '.swiper-pagination2',
        paginationClickable: true,
        spaceBetween: 0,
        centeredSlides: true,
        autoplay: 5000,
        pagination: '.swiper-pagination2',
        paginationClickable: true,
        spaceBetween: 0,
        centeredSlides: true,
        autoplay: 3000,
        autoplayDisableOnInteraction: false
      });

      var swiper3 = new Swiper('.swiper-container-3', {
        slidesPerView: 4,
        centeredSlides: true,
        paginationClickable: true,
        spaceBetween: 10,
        grabCursor: true
      });

      $(document).on('click', '.search', function() {
        if ($('.form-search').is(':hidden')) {
          $('.form-search').show();
          $('.search-overflow').css({'top': '0px'});
        }
        else {
          $('.form-search').hide();
          $('.search-overflow').css({'top': '0px'});
        }
      })

      var price = 0;

      var $this = null;

      // rfo, dp, spread.
      $('#rfo-date').html($('#rfo-date-php').val());
      $('#end-of-dp').html($('#end-of-dp-php').val());
      $('#month-spread').html($('#month-spread-php').val());

      // Get the active computation sheet.
      var active = $('.select-computation .active').data('select');
      $('#unit-selected').data('reveal-id', 'myModalUnit');

      // Change modal depending on computation sheet selected.
      $(document).on('click', '.select-computation .columns', function() {
        $('.room').remove();
        $('.select-computation .columns').removeClass('active');
        $(this).addClass('active');
        active = $(this).data('select');
        $('#unit-selected').data('reveal-id', 'myModalUnit');

        $('#select-project')[0].selectedIndex = 0;
        $('#unit-selected').html("-- Select Unit--");
        $('#unit-area').html("");
        $('#select-term')[0].selectedIndex = 0;
        $('.calc').hide();
        $('.important').hide();
        $this = null;
      });

      // Select a Unit for unit, parking.
      var sel_unit = ""
      $(document).on('click', '.bldg .available', function() {
        var type = $(this).data('type');
        var unit = $(this).data('unit');
        var facing = $(this).data('facing');
        var area = $(this).data('area');
        var balcony = $(this).data('balcony');
        var unit_area = area + balcony;
        price = $(this).data('price');
        sel_unit = unit;

        if ($('#bpc-reservation').val() == 1) {
          $('#edit-submitted-choose-unit').val("Unit " + unit);
        }

        if (active == "Unit") {
          var unit_selected = type +" / "+ unit +" "+ facing;
          $('#unit-selected').html(unit_selected);
          $('#unit-area').html(unit_area + " sqm" +" ("+ area +" sqm + "+ balcony +" sqm balcony"+")");
        }
        else if (active == "Parking") {
          var unit_selected = unit +" "+ facing;
          $('#unit-selected').html(unit_selected);
          $('#unit-area').html(unit_area + " sqm");
        }
        $('#myModalUnit').foundation('reveal', 'close');

        if ($this != null) {
          compute_sheet(price, $this);
        }
      });

      // Change Tower.
      $('#select-bldg').on('change', function() {
        var tower = $(this).val();
        $('.tower-label').html(tower);
      });

      // Computation Sheet.
      $('#select-term').on('change', function() {
        $this = $(this);
        compute_sheet(price, $this);
        $('.visual').show();
      });

      $('.table-units').click(function() {
        $(this).parents().eq(3).find('.available-units').show();
        $('.visual').hide();
      });

      $('.table-back').click(function() {
        $(this).parents().eq(3).find('.available-units').hide();
        $('.visual').show();
      });

      $.get('/data/project', function(data) {
        var len = data.length;
        for(var x=0; x<len; x++) {
          var title = data[x].node.title.replace(" ", "_");
          $('#select-project').append("<option value="+ title.toLowerCase() +">" + data[x].node.title + "</option>");
        }
      });

      function get_project(project, floor, select) {
        if (select == "Unit" || select == null) {
          $.get('/data/project-units/' + project + "/" + floor, function(data) {
            var len = data.nodes.length;
            for(var x=0; x<len; x++) {
              var unit_type = "";
              var img = "/sites/all/themes/dmci/images/layout.png"
              if (data.nodes[x].node.type == "3 Bedrooms") {
                unit_type = "three-br";
              } else if (data.nodes[x].node.type == "2 Bedrooms") {
                unit_type = "two-br";
              } else if (data.nodes[x].node.type == "1 Bedrooms") {
                unit_type = "one-br";
              } else {
                unit_type = "stairs";
                img = "";
              }
              $('.floor-plan-layout').prepend('<div class="room '+ unit_type +' '+ data.nodes[x].node.status +' tile" data-type="'+ data.nodes[x].node.type +'" data-unit="'+ data.nodes[x].node.number +'" data-facing="Facing Amenities" data-area="'+ data.nodes[x].node.area +'" data-balcony="'+ data.nodes[x].node.balcony +'" data-price="'+ data.nodes[x].node.price +'"><span>'+ data.nodes[x].node.number +'</span><img src="'+ img +'"><div class="stat2">'+ data.nodes[x].node.status +'</div></div>')
            }
          })
        } else {
          $.get('/data/project-parking/' + project + "_parking/" + floor, function(data) {
            var len = data.nodes.length;
            for(var x=0; x<len; x++) {
              $('.floor-plan-layout').prepend('<div class="room parking '+ data.nodes[x].node.status +' tile" data-unit="'+ data.nodes[x].node.number +'" data-facing="Facing Amenities" data-area="'+ data.nodes[x].node.area +'" data-balcony="0" data-price="'+ data.nodes[x].node.price +'"><span>'+ data.nodes[x].node.number +'</span></div>')
            }
          })
        }
      }

      $('#select-project, #edit-submitted-property-interested-in').on('change',function() {
        if ($(this).context.id == "edit-submitted-property-interested-in") {
          var select = "Unit";
        } else {
          var select = $('.select-computation .active').data('select');
        }

        $('.room').remove();
        var project = $(this).val();
        var floor = $('#select-floor').val();
        get_project(project, floor, select);

        $.get('/data/bpc-information/' + $("#select-project option:selected, #edit-submitted-property-interested-in option:selected").text(), function(data) {
          $('.facing.top').text(data[0].top);
          $('.facing.bottom').text(data[0].bottom);
          $('.construction').text(data[0].construction);
        });
      });

      $('#select-floor').on('change',function() {
        if ($(this).context.id == "edit-submitted-property-interested-in") {
          var select = "Unit";
        } else {
          var select = $('.select-computation .active').data('select');
        }

        $('.room').remove();
        var project = $('#select-project, #edit-submitted-property-interested-in, #hidden-availability').val();
        var floor = $('#select-floor').val();
        get_project(project, floor, select);
      })

      $(document).on('change', '#edit-submitted-property-interested-in', function() {
        var project_machine_name = $(this).val();
        var options = $('#edit-submitted-choose-unit option[value]');
        var options_length = options.length;

        options.each(function(index) {
          $(this).hide();
          var each_option = $(this).val();
          if (each_option.indexOf(project_machine_name) != -1) {
            $(this).show();
          }
        })
      })

      $(document).on('click', '.showAvailability', function() {
        $('#hidden-availability').val($(this).data('title'));
        $('.room').remove();
        $.get('/data/project-units/' + $(this).data('title') + "/all", function(data) {
          for(var x=0; x<data.nodes.length; x++) {
            var unit_type = "";
            var img = "/sites/all/themes/dmci/images/layout.png"
            if (data.nodes[x].node.type == "3 Bedrooms") {
              unit_type = "three-br";
            } else if (data.nodes[x].node.type == "2 Bedrooms") {
              unit_type = "two-br";
            } else if (data.nodes[x].node.type == "1 Bedrooms") {
              unit_type = "one-br";
            } else {
              unit_type = "stairs";
              img = "";
            }
            $('.section-availability .x-large .units').prepend('<div class="room '+ unit_type +' '+ data.nodes[x].node.status +' tile" data-type="'+ data.nodes[x].node.type +'" data-unit="'+ data.nodes[x].node.number +'" data-facing="Facing Amenities" data-area="'+ data.nodes[x].node.area +'" data-balcony="'+ data.nodes[x].node.balcony +'" data-price="'+ data.nodes[x].node.price +'"><span>'+ data.nodes[x].node.number +'</span><img src="'+ img +'"><div class="stat2">'+ data.nodes[x].node.status +'</div></div>')
          }
        })

        $.get('/data/bpc-information/' + $(this).parent().find('.logo').text().trim(), function(data) {
          $('.facing.top').text(data[0].top);
          $('.facing.bottom').text(data[0].bottom);
          $('.construction').text(data[0].construction);
        });
      })

      $(document).on('click', '.webform-component--choose-unit', function() {
        $('#myModalUnit').foundation('reveal', 'open');
      })

      $('.go-reserve').click(function() {
        $('#unit-selected-2').val(sel_unit);
      })

      $('#edit-submitted-property-interested-in').val($('#reserve_project').val());
      $('#edit-submitted-choose-unit').val("Unit " + $('#reserve_unit').val());
      $('#edit-submitted-terms').val($('#reserve_term').val());

    }
  };
})(jQuery, Drupal);