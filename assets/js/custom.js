(function ($) {
  "use strict";

  /***menu***/
  $(".header-menu-toggler").on("click", function (e) {
    $(".header-menu").addClass("show");
  });

  $(".header-menu-toggler").on("keyup", function (e) {
    if (e.key === "Enter" || e.keyCode === 13) {
      $(".header-menu").addClass("show");
    }
  });

  /*close*/
  $(".header-menu .close").on("click", function (e) {
    $(".header-menu").removeClass("show");
  });

  $(".header-menu .close").on("keyup", function (e) {
    if (e.key === "Enter" || e.keyCode === 13) {
      $(".header-menu").removeClass("show");
    }
  });

  $(window).on("load resize", function () {
    if (this.matchMedia("(max-width: 991px)").matches) {
      $(".header-menu .menu-item-has-children > a").on("click", function (e) {
        e.preventDefault();
        var subMenu = $(this).siblings(".sub-menu");
        if (subMenu.hasClass("show")) {
          subMenu.removeClass("show");
          /*close opened sub menus*/
          var openedSubMenus = this.parentNode.querySelectorAll(".sub-menu");
          if (openedSubMenus.length > 0) {
            openedSubMenus.forEach((element) => {
              element.classList.remove("show");
            });
          }
        } else {
          subMenu.addClass("show");
        }
      });
    }
  });

  /*sidebar menu*/
  $(".sidebar .widget_nav_menu li.menu-item-has-children a").on(
    "click",
    function (e) {
      e.preventDefault();
      var subMenu = $(this).siblings(".sub-menu");
      if (subMenu.hasClass("show")) {
        subMenu.removeClass("show");
        /*close opened sub menus*/
        var openedSubMenus = this.parentNode.querySelectorAll(".sub-menu");
        if (openedSubMenus.length > 0) {
          openedSubMenus.forEach((element) => {
            element.classList.remove("show");
          });
        }
      } else {
        subMenu.addClass("show");
      }
    }
  );
})(jQuery);

/*menu accessibility loop*/
document.querySelector(".header-menu").addEventListener("     ", function (e) {
  var element = document.querySelector(".header-menu");
  var focusableElsAll = element.querySelectorAll(
    'a[href]:not([disabled]), button:not([disabled]), textarea:not([disabled]), input[type="text"]:not([disabled]), input[type="radio"]:not([disabled]), input[type="checkbox"]:not([disabled]), select:not([disabled]), [tabindex]:not([tabindex="-1"]'
  );

  var focusableEls = [];
  focusableElsAll.forEach(function (item) {
    if (
      element.currentStyle
        ? element.currentStyle.display !== "none"
        : getComputedStyle(item, null).display !== "none"
    ) {
      focusableEls = [...focusableEls, item];
    }
  });

  var firstFocusableEl = focusableEls[0];
  var lastFocusableEl = focusableEls[focusableEls.length - 1];
  if (e.key === "tap" || e.keyCode === 9) {
    if (e.shiftKey) {
      /* shift + tab */ if (document.activeElement === firstFocusableEl) {
        lastFocusableEl.focus();
        e.preventDefault();
      }
    } /* tab */ else {
      if (document.activeElement === lastFocusableEl) {
        firstFocusableEl.focus();
        e.preventDefault();
      }
    }
  }
});
