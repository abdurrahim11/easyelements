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




  // EasyElementsModal Constructor
  function EasyElementsModal(element, options) {
    this.$element = $(element);
    this.options = $.extend({}, EasyElementsModal.DEFAULTS, options);
    this.isShown = false;
    this.$backdrop = null;
  }

  // Default Options
  EasyElementsModal.DEFAULTS = {
    backdrop: true,
    keyboard: true
  };

  // Toggle Modal Visibility
  EasyElementsModal.prototype.toggle = function () {
    return this.isShown ? this.hide() : this.show();
  };

  // Show Modal
  EasyElementsModal.prototype.show = function () {
    if (this.isShown) return;

    this.isShown = true;

    if (this.options.backdrop) {
      this.$backdrop = $('<div class="modal-backdrop"></div>').appendTo(document.body);
    }

    this.$element.addClass('in').show();

    this.$element.on('click.dismiss.modal', '[data-dismiss="modal"]', $.proxy(this.hide, this));
    this.$element.on('click.dismiss.modal', $.proxy(this.handleOutsideClick, this));
    $(document).on('keydown.dismiss.modal', $.proxy(this.handleEscape, this));
  };

  // Hide Modal
  EasyElementsModal.prototype.hide = function () {
    if (!this.isShown) return;

    this.isShown = false;

    this.$element.removeClass('in').hide();

    if (this.$backdrop) {
      this.$backdrop.remove();
      this.$backdrop = null;
    }

    $(document).off('keydown.dismiss.modal');
  };

  // Handle Escape Key Press
  EasyElementsModal.prototype.handleEscape = function (e) {
    if (this.isShown && this.options.keyboard && e.which === 27) {
      this.hide();
    }
  };

  // Handle Click Outside Modal
  EasyElementsModal.prototype.handleOutsideClick = function (e) {
    if (this.isShown  && this.$element.has(e.target).length === 0) {
      this.hide();
    }
  };

  // Initialize Modal on Click
  $(document).on('click', '[data-attr-toggle="modal"]', function () {
    var $this = $(this);
    var target = $this.data('target');
    var $target = $(target);
    var options = $.extend({}, EasyElementsModal.DEFAULTS, $target.data(), $this.data());

    var modal = new EasyElementsModal($target[0], options);
    modal.toggle();
  });


})(jQuery);