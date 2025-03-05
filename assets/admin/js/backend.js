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
        if (this.isShown && this.$element.has(e.target).length === 0) {
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

    // Save Settings button click event
    $('.ele-elements-header-save-settings .ele-button').on('click', function(e) {
        e.preventDefault();
        $('.ele-btn-loading').show();
        $('.ele-btn-text').hide();
        // Gather the data
        var elementsData = {};
        $('#elements .ele-elements-control-switchers-wrapper .ele-elements-control-item').each(function() {
            var widget = $(this).find('input[type="checkbox"]');
            elementsData[widget.attr('name')] = widget.is(':checked') ? 1 : 0;
        });

        var featuresData = {};
        $('#features .ele-elements-control-switchers-wrapper .ele-elements-control-item').each(function() {
            var module = $(this).find('input[type="checkbox"]');
            featuresData[module.attr('name')] = module.is(':checked') ? 1 : 0;
        });

        var eleElementsAll = $('input[name="ele_elements_all"]').is(':checked') ? 1 : 0;
        var eleFeaturesAll = $('input[name="ele_features_data_all"]').is(':checked') ? 1 : 0;

        // Send the data via AJAX
        $.ajax({
            url: ajaxurl,
            type: 'POST',
            data: {
                action: 'save_ele_settings',
                elements: elementsData,
                features: featuresData,
                ele_elements_all: eleElementsAll,
                ele_features_all: eleFeaturesAll,
                security: easyElements.security
            },
            success: function(response) {
                $('.ele-btn-loading').hide();
                $('.ele-btn-text').show();
                if (response.success) {
                    $('.ele-btn-text').html( easyElements.save_btn_success_text );
                } else {
                    alert( easyElements.failed_text );
                }
            }
        });
    });

    // Disable All click event
    $('input[name="ele_elements_all"]').on('change', function() {
        var isChecked = $(this).is(':checked');
        if ( $(this).is(':checked') ) {
            $('.ele-element-checkbox').prop('checked',true);
        } else {
            $('.ele-element-checkbox').prop('checked',false);

        }
    });

    $('input[name="ele_features_data_all"]').on('change', function() {
        if ( $(this).is(':checked') ) {
            $('.ele-features-checkbox').prop('checked',true);
        } else {
            $('.ele-features-checkbox').prop('checked',false);

        }
    });

    $('.ele-element-checkbox').on('change', function () {
        $('.ele-btn-text').html( easyElements.save_btn_new_text );

        if ( $(this).is(':checked') ) {
            $('.ele-elements-all').prop('checked',true);
        }
    });

    $('.ele-features-checkbox').on('change', function () {
        $('.ele-btn-text').html( easyElements.save_btn_new_text );

        if ( $(this).is(':checked') ) {
            $('.ele-features-data-all').prop('checked',true);
        }
    });


})(jQuery);