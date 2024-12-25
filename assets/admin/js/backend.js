(function ($) {
  "use strict";
  function ele_open_tab(tabId) {
    $(".ele-body-wrapper").removeClass("active");
    $("#" + tabId).addClass("active");
    $(".ele-dashboard-tabs a").removeClass("active");
    $('.ele-dashboard-tabs a[data-tab="' + tabId + '"]').addClass("active");
  }

  function ele_get_tab_from_hash() {
    const hash = window.location.hash;
    const defaultTab = "dashboard";
    if (hash) {
      const tabId = hash.replace("#tab=", "");
      if ($("#" + tabId).length) {
        return tabId;
      }
    }
    return defaultTab;
  }

  $(".ele-dashboard-tabs a").on("click", function (e) {
    e.preventDefault();
    const tabId = $(this).data("tab");
    window.location.hash = "tab=" + tabId;
    ele_open_tab(tabId);
  });

  $(window).on("hashchange", function () {
    ele_open_tab(ele_get_tab_from_hash());
  });

  ele_open_tab(ele_get_tab_from_hash());

    // Get the button that opens the modal
    var ele_btn = $('.ele-videoButton');
  
})(jQuery);