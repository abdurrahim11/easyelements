(function ($) {
  "use strict";
  function ee_open_tab(tabId) {
    $(".ee-body-wrapper").removeClass("active");
    $("#" + tabId).addClass("active");
    $(".ee-dashboard-tabs a").removeClass("active");
    $('.ee-dashboard-tabs a[data-tab="' + tabId + '"]').addClass("active");
  }

  function ee_get_tab_from_hash() {
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

  $(".ee-dashboard-tabs a").on("click", function (e) {
    e.preventDefault();
    const tabId = $(this).data("tab");
    window.location.hash = "tab=" + tabId;
    ee_open_tab(tabId);
  });

  $(window).on("hashchange", function () {
    ee_open_tab(ee_get_tab_from_hash());
  });

  ee_open_tab(ee_get_tab_from_hash());

    // Get the button that opens the modal
    var ee_btn = $('.ee-videoButton');

    // Get the modal
    var ee_popup = $('#ee-videoPopup');

    // Get the close button
    var ee_close = $('.ee-close');

    // Get the iframe
    var ee_iframe = $('#ee-videoIframe');

    // When the user clicks the button, open the modal 
    ee_btn.on('click', function() {
        var ee_videoSrc = $(this).data('video');
        ee_popup.show();
        ee_iframe.attr('src', ee_videoSrc);
    });

    // When the user clicks on <span> (x), close the modal
    ee_close.on('click', function() {
        ee_popup.hide();
        ee_iframe.attr('src', '');
    });

    // When the user clicks anywhere outside of the modal, close it
    $(window).on('click', function(event) {
        if ($(event.target).is(ee_popup)) {
            ee_popup.hide();
            ee_iframe.attr('src', '');
        }
    });
  
})(jQuery);