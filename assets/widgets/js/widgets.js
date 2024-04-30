(function ($) {
    "use strict";

    function add_event_listener(type, selector, listener) {
        $(document).on(type, selector, listener);
    }

    var menu_containers;
    menu_containers = $(".easyelements-menu-container");
    $(menu_containers).each(function() {
        var el = $(this);
        if ("yes" !== el.attr("ele-dom-added")) {
            if (0 === el.parents(".elementor-widget-ele-nav-menu").length) {
                el.parents(".ele-wid-con").addClass("ele_menu_responsive_tablet");
            }
            el.attr("ele-dom-added", "yes");
        }
    });

    add_event_listener("click", ".easyelements-dropdown-has > a", function(event) {
        var div_span = $(this).parents(".easyelements-navbar-nav, .ele-vertical-navbar-nav");
        var from_index = $(this).parents(".ele-wid-con").data("responsive-breakpoint");
        if ((!div_span.hasClass("submenu-click-on-icon") || $(event.target).hasClass("easyelements-submenu-indicator")) && (!($(document).width() > Number(from_index) && div_span.hasClass("submenu-click-on-")) || $(event.target).hasClass("easyelements-submenu-indicator"))) {
            event.preventDefault();
            var select_box = $(this).parent().find(">.easyelements-dropdown, >.easyelements-megamenu-panel");
            select_box.find(".easyelements-dropdown-open").removeClass("easyelements-dropdown-open");
            if (select_box.hasClass("easyelements-dropdown-open")) {
                select_box.removeClass("easyelements-dropdown-open");
            } else {
                select_box.addClass("easyelements-dropdown-open");
            }
        }
    });

    add_event_listener("click", ".easyelements-menu-toggler", function(event) {
        event.preventDefault();
        var sh_cell = $(this).parents(".easyelements-menu-container").parent();
        if (sh_cell.length < 1) {
            sh_cell = $(this).parent();
        }
        var next = sh_cell.find(".easyelements-menu-offcanvas-elements");
        if (next.hasClass("active")) {
            next.removeClass("active");
        } else {
            next.addClass("active");
        }
    });

    $(".easyelements-navbar-nav li a").on("click", function(event) {
        if ($(this).attr("href") && "easyelements-submenu-indicator" !== event.target.className) {
            var field = $(this);
            var link = field.get(0);
            var href = link.href;
            var segment_index = href.indexOf("#");
            var one_page_yes = field.parents(".easyelements-menu-container").hasClass("ele-nav-menu-one-page-yes");
            if (-1 !== segment_index) {
                if (href.length > 1) {
                    if (one_page_yes) {
                        if (link.pathname == window.location.pathname) {
                            event.preventDefault();
                            field.parents(".ele-wid-con").find(".easyelements-menu-close").trigger("click");
                        }
                    }
                }
            }
        }
    });

})(jQuery);
