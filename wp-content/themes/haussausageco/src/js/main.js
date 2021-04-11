$(document).ready(function () {
  $(".header__menutoggle").on("click", function (e) {
    e.preventDefault();
    $(".header, body").toggleClass("menuactive");
  });
});
