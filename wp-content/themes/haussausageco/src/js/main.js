$(document).ready(function () {
  $(".header__menutoggle").on("click", function (e) {
    e.preventDefault();
    $(".header, body").toggleClass("menuactive");
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
