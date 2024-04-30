;
(function($) {
    "use strict";

    // Initialize color picker
    $(".easyelements-menu-wpcolor-picker").wpColorPicker();

    // Initialize AestheticIconPicker
    var iconPicker = AestheticIconPicker({
        'selector': '#ele-icon-picker-wrap',
        // must be an ID
        'onClick': '#ele-select-icon',
    });

    // Save menu item settings
    var nonce = window.easyelements_megamenu_nonce;
    $(".easyelements-menu-item-save").on("click", function() {
        var spinner_wrapper = $(this).parent().find(".spinner");
        var settings_model = {
            // Collect settings data
            settings: {
                menu_id: $("#easyelements-menu-modal-menu-id").val(),
                menu_has_child: $("#easyelements-menu-modal-menu-has-child").val(),
                menu_enable: $("#easyelements-menu-item-enable:checked").val(),
                menu_icon: $("#easyelements-menu-icon-field").val(),
                menu_icon_color: $("#easyelements-menu-icon-color-field").val(),
                menu_badge_text: $("#easyelements-menu-badge-text-field").val(),
                menu_badge_color: $("#easyelements-menu-badge-color-field").val(),
                menu_badge_background: $("#easyelements-menu-badge-background-field").val(),
                vertical_menu_width: $("#easyelements-menu-vertical-menu-width-field").val(),
                mobile_submenu_content_type: $("#ele-mobile-submenu-content-typ").val(),
                vertical_megamenu_position_type: $("#ele-vertical-megamenu-position-type").val(),
                megamenu_width_type: $("#ele-megamenu-width-type").val(),
                megamenu_ajax_load: $("#ele-enable-ajax-load").val()
            },
            nocache: Math.floor(Date.now() / 1E3)
        };
        spinner_wrapper.addClass("loading");
        // AJAX request to save settings
        $.ajax({
            url: window.easyelements.resturl + "megamenu/save_menuitem_settings",
            type: "get",
            data: settings_model,
            headers: {
                "X-WP-Nonce": nonce
            },
            dataType: "json",
            success: function(response) {
                spinner_wrapper.removeClass("loading");
                $("#easyelements-menu-item-settings-modal").modal("hide");
            }
        });
    });

    // Trigger menu builder
    $("#easyelements-menu-builder-trigger").on("click", function() {
        var menu_id = $("#easyelements-menu-modal-menu-id").val();
        var new_menu_url = window.easyelements.resturl + "dynamic-content/content_editor/megamenu/menuitem" + menu_id;
        $("#easyelements-menu-builder-iframe").attr("src", new_menu_url);
    });

    // Add Mega Menu trigger to menu items
    $("body").on("DOMSubtreeModified", "#menu-to-edit", function() {
        setTimeout(function() {
            $("#menu-to-edit li.menu-item").each(function() {
                var target = $(this);
                if (target.find(".ele-menu-trigger").length < 1) {
                    $(".item-title", target).append("<a data-attr-toggle='modal' data-target='#ele-mega-menu-modal' href='#' class='ele-menu-trigger'>Mega Menu</a>");
                }
            });
        }, 200);
    });
    $("#menu-to-edit").trigger("DOMSubtreeModified");

    // Handle Mega Menu trigger click
    $("#menu-to-edit").on("click", ".ele-menu-trigger", function(event) {
        event.preventDefault();
        var modal = $("#attr_menu_control_panel_modal");
        var menu_item = $(this).parents("li.menu-item");
        var menu_id = parseInt(menu_item.attr("id").match(/[0-9]+/)[0], 10);
        menu_item.find(".menu-item-title").text();
        var menu_depth = menu_item.attr("class").match(/\menu-item-depth-(\d+)\b/)[1];

        $("#easyelements-menu-modal-menu-id").val(menu_id);
        $("#easyelements-menu-modal-menu-has-child").val(menu_depth);
        var request_data = {
            menu_id: menu_id,
            nocache: Math.floor(Date.now() / 1E3)
        };
        // AJAX request to get menu item settings
        $.ajax({
            url: window.easyelements.resturl + "megamenu/get_menuitem_settings",
            type: "get",
            data: request_data,
            headers: {
                "X-WP-Nonce": nonce
            },
            dataType: "json",
            success: function(data) {
                // Update form fields with received settings
                $("#easyelements-menu-item-enable").prop("checked", false);
                $("#easyelements-menu-icon-color-field").wpColorPicker("color", data.menu_icon_color);
                $("#easyelements-menu-icon-field").val(data.menu_icon);
                $("#easyelements-menu-badge-text-field").val(data.menu_badge_text);
                $("#easyelements-menu-badge-color-field").wpColorPicker("color", data.menu_badge_color);
                $("#easyelements-menu-badge-background-field").wpColorPicker("color", data.menu_badge_background);
                $("#easyelements-menu-vertical-menu-width-field").val(data.vertical_menu_width);
                if ("undefined" != typeof data.menu_enable && 1 == data.menu_enable) {
                    $("#easyelements-menu-item-enable").prop("checked", true);
                } else {
                    $("#easyelements-menu-item-enable").prop("checked", false);
                }

                if ("undefined" == typeof data.mobile_submenu_content_type || "builder_content" == data.mobile_submenu_content_type) {
                    $('#ele-mobile-submenu-content-typ').val('builder_content');
                } else {
                    $('#ele-mobile-submenu-content-typ').val('submenu_list');

                }

                if ("undefined" == typeof data.vertical_megamenu_position_type || "relative_position" == data.vertical_megamenu_position_type) {
                    $("#ele-vertical-megamenu-position-type").val('relative_position');
                } else {
                    $("#ele-vertical-megamenu-position-type").val('top_position');
                }


                if ("undefined" == typeof data.megamenu_ajax_load || "no" == data.megamenu_ajax_load) {
                    $("#ele-enable-ajax-load").val('no');
                } else {
                    $("#ele-enable-ajax-load").val('yes');
                }

                if ("undefined" == typeof data.megamenu_width_type || "default_width" == data.megamenu_width_type) {
                    $("#ele-megamenu-width-type").val( 'default_width' );
                } else {
                    if ("undefined" == typeof data.megamenu_width_type || "full_width" == data.megamenu_width_type) {
                        $("#ele-megamenu-width-type").val( 'full_width' );
                    } else {
                        $("#ele-megamenu-width-type").val( 'custom_width' );
                    }
                }

                $("#ele-megamenu-width-type").on("change", function() {
                    if ( $( this ).val() == 'custom_width' ) {
                        $(".ele-menu-width-container").removeClass("is_disabled");
                    } else {
                        $(".ele-menu-width-container").addClass("is_disabled");
                    }
                }).trigger("change");


                if ($("#width_type_custom").is(":checked")) {
                    $(".menu-width-container").addClass("ele_is_enabled");
                } else {
                    $(".menu-width-container").removeClass("ele_is_enabled");
                }
                $("#easyelements-menu-item-enable").trigger("change");
                iconPicker.reload();
                setTimeout(function() {
                    modal.removeClass("easyelements-menu-modal-loading");
                }, 500);
            }
        });
    });

    // Handle menu item enable change
    $("#easyelements-menu-item-enable").on("change", function() {
        if ($(this).is(":checked")) {
            $("#easyelements-menu-builder-trigger").prop("disabled", false);
        } else {
            $("#easyelements-menu-item-enable").prop("checked", false);
            $("#easyelements-menu-builder-trigger").prop("disabled", true);
        }
    }).trigger("change");

    // Handle changes in Mega Menu enable checkbox
    $("#nav-menu-header").on("change.ele", "#easyelements-menu-metabox-input-is-enabled", function() {
        if ($(this).is(":checked")) {
            $("body").addClass("is_mega_enabled").removeClass("ele_is_mega_disabled ");
        } else {
            $("body").removeClass("is_mega_enabled").addClass("ele_is_mega_disabled ");
        }
    });

    // Prepend Mega Menu markup and trigger change event
    $(window.easyelements_options_megamenu_markup)
        .insertAfter("#nav-menu-header #menu-name")
        .parent()
        .find("#easyelements-menu-metabox-input-is-enabled")
        .trigger("change.ele");

    // Handle Mega Menu modal hide event
    var modal_collection = $("#easyelements-menu-builder-modal");
    var modal_iframe = document.getElementById("easyelements-menu-builder-iframe");
    var modal_window = modal_iframe.contentWindow || modal_iframe.contentDocument;
    modal_collection.on("hide.bs.attr-modal", function(event) {
        if (!modal_window.jQuery("#elementor-panel-saver-button-publish").hasClass("elementor-disabled")) {
            if (!confirm("Changes you made may not be saved.")) {
                event.preventDefault();
            }
        }
        modal_window.jQuery(modal_window).off("beforeunload");
    });

})(jQuery);