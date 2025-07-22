jQuery(document).ready(function () {
  jQuery(".notice-dismiss").click(function () {
    jQuery.get(
      hs_first_agency_ajax_object.ajax_url,
      { action: "hs_first_agency_dismiss_notice_on_click" },
      function () {}
    );
  });
});
