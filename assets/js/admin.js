jQuery(document).ready(function () {
  var one_click_demo_clicked = false;
  jQuery("#first-agency-one-click-demo-import").click(function () {
    if (one_click_demo_clicked === false) {
      one_click_demo_clicked = true;
      jQuery("#first-agency-one-click-demo-import .icn-spinner").addClass("active");
      jQuery.get(first_agency_ajax_object.ajax_url, { action: "first_agency_one_demo_import_installer" }, function () {
        jQuery("#first-agency-one-click-demo-import").prop("disable", false);
        jQuery("#first-agency-one-click-demo-import .icn-spinner").removeClass(
          "active"
        );
        one_click_demo_clicked = false;
        jQuery(".demo-content-import .inner-item .err_msg").remove();
        jQuery(".first-agency-one-click-demo-import").remove();
        jQuery(".demo-content-import .inner-item").append(
          '<a href="' +
            first_agency_ajax_object.one_demo_import_url +
            '" class="button button-primary">' +
            first_agency_ajax_object.button_text +
            "</a>"
        );
      });
    }
  });
});
