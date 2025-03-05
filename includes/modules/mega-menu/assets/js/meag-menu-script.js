;
(function($) {
    "use strict";

    // Initialize color picker
    $(".easyelements-menu-wpcolor-picker").wpColorPicker();

    // Define the icon library with the correct prefix
    var easyElementsIcons = {
        "easyelements": {
            regular: {
                prefix: "ele ele-",
                "icon-style": "ele-regular",
                "list-icon": "ele ele-easy-elements",
                icons: [
                    "ele ele-easy-button", "ele ele-horizontal-timelines", "ele ele-info-box", "ele ele-nav-menu", "ele ele-post-grid",
                    "ele ele-pricing-table", "ele ele-progress", "ele ele-step-flow", "ele ele-team-member", "ele ele-testimonials",
                    "ele ele-activity", "ele ele-airplay", "ele ele-alert-circle", "ele ele-alert-octagon", "ele ele-alert-triangle",
                    "ele ele-align-center", "ele ele-align-justify", "ele ele-align-left", "ele ele-align-right", "ele ele-anchor",
                    "ele ele-aperture", "ele ele-archive", "ele ele-arrow-down", "ele ele-arrow-down-circle", "ele ele-arrow-down-left",
                    "ele ele-arrow-down-right", "ele ele-arrow-left", "ele ele-arrow-left-circle", "ele ele-arrow-right",
                    "ele ele-arrow-right-circle", "ele ele-arrow-up", "ele ele-arrow-up-circle", "ele ele-arrow-up-left",
                    "ele ele-arrow-up-right", "ele ele-at-sign", "ele ele-award", "ele ele-bar-chart", "ele ele-bar-chart-2", "ele ele-battery",
                    "ele ele-battery-charging", "ele ele-bell", "ele ele-bell-off", "ele ele-bluetooth", "ele ele-bold", "ele ele-book",
                    "ele ele-bookmark", "ele ele-book-open", "ele ele-box", "ele ele-briefcase", "ele ele-calendar", "ele ele-camera",
                    "ele ele-camera-off", "ele ele-cast", "ele ele-check", "ele ele-check-circle", "ele ele-check-square",
                    "ele ele-chevrons-left", "ele ele-chevrons-up", "ele ele-chrome", "ele ele-circle", "ele ele-clipboard", "ele ele-clock",
                    "ele ele-cloud", "ele ele-cloud-drizzle", "ele ele-cloud-lightning", "ele ele-cloud-off", "ele ele-cloud-rain",
                    "ele ele-cloud-snow", "ele ele-code", "ele ele-codepen", "ele ele-codesandbox", "ele ele-coffee", "ele ele-columns",
                    "ele ele-command", "ele ele-compass", "ele ele-copy", "ele ele-corner-down-left", "ele ele-corner-down-right",
                    "ele ele-corner-left-down", "ele ele-corner-left-up", "ele ele-corner-right-down", "ele ele-corner-right-up",
                    "ele ele-corner-up-left", "ele ele-corner-up-right", "ele ele-cpu", "ele ele-credit-card", "ele ele-crop",
                    "ele ele-crosshair", "ele ele-database", "ele ele-delete", "ele ele-disc", "ele ele-divide", "ele ele-divide-circle",
                    "ele ele-divide-square", "ele ele-dollar-sign", "ele ele-download", "ele ele-download-cloud", "ele ele-dribbble",
                    "ele ele-droplet", "ele ele-edit", "ele ele-edit-2", "ele ele-edit-3", "ele ele-external-link", "ele ele-eye", "ele ele-eye-off",
                    "ele ele-facebook", "ele ele-fast-forward", "ele ele-feather", "ele ele-figma", "ele ele-file", "ele ele-file-minus",
                    "ele ele-file-plus", "ele ele-file-text", "ele ele-film", "ele ele-filter", "ele ele-flag", "ele ele-folder", "ele ele-folder-minus",
                    "ele ele-folder-plus", "ele ele-framer", "ele ele-frown", "ele ele-gift", "ele ele-git-branch", "ele ele-git-commit",
                    "ele ele-github", "ele ele-gitlab", "ele ele-git-merge", "ele ele-git-pull-request", "ele ele-globe", "ele ele-grid",
                    "ele ele-hard-drive", "ele ele-hash", "ele ele-headphones", "ele ele-heart", "ele ele-help-circle", "ele ele-hexagon",
                    "ele ele-home", "ele ele-image", "ele ele-inbox", "ele ele-info", "ele ele-instagram", "ele ele-italic", "ele ele-key", "ele ele-layers",
                    "ele ele-layout", "ele ele-life-buoy", "ele ele-link-2", "ele ele-linkedin", "ele ele-list", "ele ele-loader", "ele ele-lock",
                    "ele ele-log-in", "ele ele-log-out", "ele ele-mail", "ele ele-map", "ele ele-map-pin", "ele ele-maximize", "ele ele-maximize-2",
                    "ele ele-meh", "ele ele-menu", "ele ele-message-circle", "ele ele-message-square", "ele ele-mic", "ele ele-mic-off",
                    "ele ele-minimize", "ele ele-minimize-2", "ele ele-minus", "ele ele-minus-circle", "ele ele-minus-square", "ele ele-monitor",
                    "ele ele-moon", "ele ele-more-horizontal", "ele ele-more-vertical", "ele ele-mouse-pointer", "ele ele-move", "ele ele-music",
                    "ele ele-navigation", "ele ele-navigation-2", "ele ele-octagon", "ele ele-package", "ele ele-paperclip", "ele ele-pause",
                    "ele ele-pause-circle", "ele ele-pen-tool", "ele ele-percent", "ele ele-phone", "ele ele-phone-call", "ele ele-phone-forwarded",
                    "ele ele-phone-incoming", "ele ele-phone-missed", "ele ele-phone-off", "ele ele-phone-outgoing", "ele ele-pie-chart",
                    "ele ele-play", "ele ele-play-circle", "ele ele-plus-circle", "ele ele-plus-square", "ele ele-pocket", "ele ele-power",
                    "ele ele-printer", "ele ele-radio", "ele ele-refresh-ccw", "ele ele-refresh-cw", "ele ele-repeat", "ele ele-rewind",
                    "ele ele-rotate-ccw", "ele ele-rotate-cw", "ele ele-rss", "ele ele-save", "ele ele-scissors", "ele ele-search", "ele ele-send",
                    "ele ele-server", "ele ele-settings", "ele ele-share", "ele ele-share-2", "ele ele-shield", "ele ele-shield-off",
                    "ele ele-shopping-bag", "ele ele-shopping-cart", "ele ele-shuffle", "ele ele-sidebar", "ele ele-skip-back",
                    "ele ele-skip-forward", "ele ele-slack", "ele ele-slash", "ele ele-sliders", "ele ele-smartphone", "ele ele-smile",
                    "ele ele-speaker", "ele ele-square", "ele ele-star", "ele ele-stop-circle", "ele ele-sun", "ele ele-sunrise", "ele ele-sunset",
                    "ele ele-tablet", "ele ele-tag", "ele ele-target", "ele ele-terminal", "ele ele-thermometer", "ele ele-thumbs-down",
                    "ele ele-thumbs-up", "ele ele-toggle-left", "ele ele-toggle-right", "ele ele-tool", "ele ele-trash", "ele ele-trash-2",
                    "ele ele-trello", "ele ele-trending-down", "ele ele-trending-up", "ele ele-triangle", "ele ele-truck", "ele ele-tv",
                    "ele ele-twitch", "ele ele-twitter", "ele ele-type", "ele ele-umbrella", "ele ele-underline", "ele ele-unlock", "ele ele-upload",
                    "ele ele-upload-cloud", "ele ele-user", "ele ele-user-check", "ele ele-user-minus", "ele ele-user-plus", "ele ele-users",
                    "ele ele-user-x", "ele ele-video", "ele ele-video-off", "ele ele-voicemail", "ele ele-volume", "ele ele-volume-1",
                    "ele ele-volume-2", "ele ele-volume-x", "ele ele-watch", "ele ele-wifi", "ele ele-wifi-off", "ele ele-wind", "ele ele-x",
                    "ele ele-x-circle", "ele ele-x-octagon", "ele ele-x-square", "ele ele-youtube", "ele ele-zap", "ele ele-zap-off",
                    "ele ele-zoom-in", "ele ele-zoom-out", "ele ele-easy-elements", "ele ele-view", "ele ele-right-arrow",
                    "ele ele-arrow-point-to-down", "ele ele-down-arrow", "ele ele-left-arrows", "ele ele-link", "ele ele-plus", "ele ele-up-arrow"
                ]
            }
        }
    };

    // Initialize AestheticIconPicker
    var iconPicker = AestheticIconPicker({
        'selector': '#ele-picker-wrap',
        // must be an ID
        'onClick': '#ele-select-icon',
         'iconLibrary': easyElementsIcons,
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
    $(window.easyelements_megamenu_btn_markup)
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