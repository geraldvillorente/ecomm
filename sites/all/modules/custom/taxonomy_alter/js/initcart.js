/**
 * @file
 * initcart.js
 *
 * Initialize cart js.
 */
(function ($) {
  Drupal.behaviors.initcart = {

    // This behavior function is called when new element is being added.
    attach: function (context, settings) {
      addToCart.update_mini_cart();
    },

    // This behavior function is called when elements are removed.
    detach: function (context, settings) {
      // Do your js stuffs you want to do after your AJAX call.
    },

  };
})(jQuery);
