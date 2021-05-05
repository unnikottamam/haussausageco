$(document).ready(function () {
  $(".header__menutoggle").on("click", function (e) {
    e.preventDefault();
    $(".header, body, .header__menutoggle").toggleClass("menuactive");
  });
  $(".scroll-down").on("click", function (e) {
    e.preventDefault();
    $("html, body").animate(
      {
        scrollTop: $($(this).attr("href")).offset().top
      },
      500
    );
  });

  $(".cart_totals .input-text").addClass("form-control");

  let formEl = $(".woocommerce-shipping-calculator");
  if (formEl.length) {
    formEl
      .submit(function (e) {
        e.preventDefault();
      })
      .validate({
        rules: {
          calc_shipping_city: {
            required: true
          },
          calc_shipping_address_1: {
            required: true
          },
          calc_shipping_postcode: {
            required: true
          }
        }
      });
  }

  $(".product__tabtitle a").on("click", function (e) {
    e.preventDefault();
    if (!$(this).hasClass("active")) {
      $(".product__tabtitle a, .product__tabcont").removeClass("active");
      $(this).addClass("active");
      $(this)
        .parents(".product__tab")
        .find(".product__tabcont")
        .addClass("active");
    } else {
      $(".product__tabtitle a, .product__tabcont").removeClass("active");
    }
  });
  jQuery(function ($) {
    if (!String.prototype.getDecimals) {
      String.prototype.getDecimals = function () {
        var num = this,
          match = ("" + num).match(/(?:\.(\d+))?(?:[eE]([+-]?\d+))?$/);
        if (!match) {
          return 0;
        }
        return Math.max(
          0,
          (match[1] ? match[1].length : 0) - (match[2] ? +match[2] : 0)
        );
      };
    }
    // Quantity "plus" and "minus" buttons
    $(document.body).on("click", ".qtyplus, .qtyminus", function () {
      var $qty = $(this).closest(".quantity").find(".qty"),
        currentVal = parseFloat($qty.val()),
        max = parseFloat($qty.attr("max")),
        min = parseFloat($qty.attr("min")),
        step = $qty.attr("step");

      // Format values
      if (!currentVal || currentVal === "" || currentVal === "NaN")
        currentVal = 0;
      if (max === "" || max === "NaN") max = "";
      if (min === "" || min === "NaN") min = 0;
      if (
        step === "any" ||
        step === "" ||
        step === undefined ||
        parseFloat(step) === "NaN"
      )
        step = 1;

      // Change the value
      if ($(this).is(".qtyplus")) {
        if (max && currentVal >= max) {
          $qty.val(max);
        } else {
          $qty.val((currentVal + parseFloat(step)).toFixed(step.getDecimals()));
        }
      } else {
        if (min && currentVal <= min) {
          $qty.val(min);
        } else if (currentVal > 0) {
          $qty.val((currentVal - parseFloat(step)).toFixed(step.getDecimals()));
        }
      }

      // Trigger change event
      $("button[name='update_cart']").removeAttr("disabled");
    });
  });
});
