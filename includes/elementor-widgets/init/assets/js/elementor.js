(function ($) {
    "use strict";

    // Helper functions for easyelements
    const easyelements_helper = {
        mega_menu_ajax_load: function (target) {
            let submenu_indicator = target.find(".easyelements-submenu-indicator, .ele-submenu-indicator-icon"),
                ajax_loader = target.find(".megamenu-ajax-load"),
                responsive_breakpoint = target.closest(".ele-wid-con").data("responsive-breakpoint"),
                original_class = submenu_indicator.attr("class"),
                loading_class = "easyelements-submenu-indicator eicon-loading eicon-animation-spin";

            if (ajax_loader.length && !target.hasClass("ele-ajax-loading")) {

                $.ajax({
                    url: window.easyelements.resturl + "megamenu/megamenu_content",
                    type: "get",
                    data: { id: ajax_loader.data("id") },
                    beforeSend: function () {
                        target.addClass("ele-ajax-loading");
                        submenu_indicator.removeClass(original_class).addClass(loading_class);
                        $(document).width() <= Number(responsive_breakpoint) ? submenu_indicator.css({ border: "none" }) : submenu_indicator.css({ "padding-right": 0, "margin-right": "5px" });
                    },
                    success: function (response) {
                        target.removeClass("ele-ajax-loading");
                        ajax_loader.replaceWith(response);
                        submenu_indicator.removeClass(loading_class).addClass(original_class).removeAttr("style");
                        target.find(".elementor-element").each(function () {
                            elementorFrontend.elementsHandler.runReadyTrigger($(this));
                        });
                    },
                });
            }
        },
    };

    const easyelements = {
        init: function () {
            let element_actions = {
                "ele-nav-menu.default": easyelements.nav_menu,
                "ele-post-grid.default": easyelements.post_grid,
                "ele-team.default": easyelements.team,
                "ele-horizontal-timeline.default": easyelements.horizontal_timeline,
                "ele-hot-spot.default": easyelements.hot_spot,
                "ele-progress-bar.default": easyelements.progress_bar,
                "ele-modal-video.default": easyelements.model_popup,
            };
            $.each(element_actions, function (event, action) {
                elementorFrontend.hooks.addAction("frontend/element_ready/" + event, action);
            });
        },

        nav_menu: function (element) {
            if (element.find(".easyelements-megamenu-has").length > 0) {
                let responsive_breakpoint = element.find(".ele-wid-con").data("responsive-breakpoint"),
                    mega_menu_items = element.find(".easyelements-megamenu-has"),
                    menu_container_height = element.find(".easyelements-menu-container").outerHeight();

                $(window)
                    .on("resize", function () {
                        element.find(".easyelements-megamenu-panel").css({ top: menu_container_height });
                    })
                    .trigger("resize");

                mega_menu_items.on("mouseenter", function () {
                    let vertical_menu = $(this).data("vertical-menu"),
                        mega_menu_panel = $(this).children(".easyelements-megamenu-panel");

                    // Logic for handling full-width dropdown menu
                    if ($(this).hasClass("easyelements-dropdown-menu-full_width") && $(this).hasClass("top_position")) {
                        let left_position = Math.floor($(this).position().left - $(this).offset().left),
                            parent_element = $(this);

                        parent_element.find(".easyelements-megamenu-panel").css("max-width", $(window).width());

                        $(window).on("resize", function () {
                            parent_element.find(".easyelements-megamenu-panel").css({ left: left_position + "px" });
                        }).trigger("resize");
                    }

                    // Handling default menu position
                    if (!$(this).hasClass("easyelements-dropdown-menu-full_width") && $(this).hasClass("top_position")) {
                        $(this).on({
                            mouseenter: function () {
                                if ($(".default_menu_position").length === 0) $(this).parents(".elementor-section-wrap").addClass("default_menu_position");
                            },
                            mouseleave: function () {
                                if ($(".default_menu_position").length !== 0) $(this).parents(".elementor-section-wrap").removeClass("default_menu_position");
                            },
                        });
                    }

                    // Handling custom width for mega menu panel
                    if (vertical_menu && vertical_menu !== undefined) {
                        if (typeof vertical_menu === "string") {
                            if (/^[0-9]/.test(vertical_menu)) {
                                $(window).on("resize", function () {
                                    mega_menu_panel.css({ width: vertical_menu });
                                    $(document).width() > Number(responsive_breakpoint) || mega_menu_panel.removeAttr("style");
                                }).trigger("resize");
                            } else {
                                $(window).on("resize", function () {
                                    mega_menu_panel.css({ width: vertical_menu + "px" });
                                    $(document).width() > Number(responsive_breakpoint) || mega_menu_panel.removeAttr("style");
                                }).trigger("resize");
                            }
                        } else {
                            mega_menu_panel.css({ width: vertical_menu + "px" });
                        }
                    } else {
                        $(window).on("resize", function () {
                            mega_menu_panel.css({ width: vertical_menu + "px" });
                            $(document).width() > Number(responsive_breakpoint) || mega_menu_panel.removeAttr("style");
                        }).trigger("resize");
                    }
                }).trigger("mouseenter");
            }

            // Dropdown menu click event handling
            if (element.find(".ele-nav-dropdown-click").length > 0) {
                let responsive_breakpoint = element.find(".ele-wid-con").data("responsive-breakpoint");

                element.on("click", ".easyelements-dropdown-has > a", function (event) {
                    event.preventDefault();
                    if ($(document).width() < Number(responsive_breakpoint)) return;

                    let submenu = $(this).parent().find(">.easyelements-dropdown, >.easyelements-megamenu-panel"),
                        parent_dropdown = $(this).parents(".easyelements-dropdown-has");

                    element.find(".easyelements-dropdown-has").not(parent_dropdown).find(">.easyelements-dropdown, >.easyelements-megamenu-panel").removeClass("ele-dropdown-open-onclick");
                    submenu.toggleClass("ele-dropdown-open-onclick");
                });

                $(window).on("resize", function () {
                    if ($(document).width() < Number(responsive_breakpoint)) element.find(".ele-dropdown-open-onclick").removeClass("ele-dropdown-open-onclick");
                });

                $(document).on("click", function (event) {
                    if (!$(event.target).closest(".easyelements-dropdown-has").length) element.find(".ele-dropdown-open-onclick").removeClass("ele-dropdown-open-onclick");
                });

                $(window).on("sticky:stick sticky:unstick", (event) => {
                    $(event.target).find(".ele-dropdown-open-onclick").removeClass("ele-dropdown-open-onclick");
                    $(event.target).next().find(".ele-dropdown-open-onclick").removeClass("ele-dropdown-open-onclick");
                });
            }

            // Mega menu ajax loading
            if (element.find(".megamenu-ajax-load").length > 0) {
                element.find(".ele-nav-dropdown-hover").on("mouseenter", ".easyelements-megamenu-has", function (event) {
                    easyelements_helper.mega_menu_ajax_load($(this));
                });

                element.find(".ele-nav-dropdown-click").on("click", ".easyelements-megamenu-has", function (event) {
                    easyelements_helper.mega_menu_ajax_load($(this));
                });
            }
        },

        progress_bar: function (element) {
            let settings = easyelements.getElementSettings(element),
                progressCount = element.find(".ele-progress-count"),
                progressTrack = element.find(".ele-progress-track");

            element.find(".ele-progress-bar").elementorWaypoint(
                function () {
                    if ("yes" === settings.show_count) {
                        progressCount.animate(
                            { Counter: settings.value },
                            {
                                duration: 1000 * settings.duration.size || 3000,
                                easing: "swing",
                                step: function (now) {
                                    $(this).text(Math.ceil(now));
                                    $(this).parents(".ele-progress-counter").find(".ele-progress-count-less").text(100 - Math.ceil(now));
                                },
                            }
                        );
                    }
                    progressTrack.animate({ width: settings.value + "%" }, 1000 * settings.duration.size || 3000);
                },
                { offset: "100%" }
            );
        },



        hot_spot: function (element) {
            let settings = easyelements.getElementSettings(element),
                postGridMain = element.find(".ele-post-grid-main");

            element.find(".ele-hotspot-type-click").on("click", function (event) {
                event.preventDefault();
                e(this).find(".ele-hotspot-tooltip-text").toggleClass("active");
            });
        },




        horizontal_timeline: function (element) {
            let settings = easyelements.getElementSettings(element),
                timelineElement = element.find(".ele-horizontal-timeline"),
                responsiveWrapper,
                breakpoint = 767;

            function adjustHeight() {
                if ("yes" === settings.reverse && $(window).width() >= breakpoint) {
                    let equalHeightDivs = element.find(".ele-horiz-equal-height > div"),
                        maxHeight = 0;
                    equalHeightDivs.each(function () {
                        maxHeight = Math.max(maxHeight, $(this).outerHeight());
                    });
                    equalHeightDivs.parent().css({ minHeight: maxHeight + "px" });
                } else {
                    let contentDivs = element.find(".ele-horizontal-timeline-content > div"),
                        contentMaxHeight = 0;
                    contentDivs.each(function () {
                        contentMaxHeight = Math.max(contentMaxHeight, $(this).outerHeight());
                    });
                    contentDivs.parent().css({ minHeight: contentMaxHeight + "px" });

                    let dateDivs = element.find(".ele-horizontal-timeline-date > div"),
                        dateMaxHeight = 0;
                    dateDivs.each(function () {
                        dateMaxHeight = Math.max(dateMaxHeight, $(this).outerHeight());
                    });
                    dateDivs.parent().css({ minHeight: dateMaxHeight + "px" });
                }
            }

            $(".e-route-panel-editor-content").length && (responsiveWrapper = ".elementor-preview-responsive-wrapper"),
            $(".elementor-editor-active").length && (breakpoint = 750);

            timelineElement.owlCarousel({
                loop: "yes" === settings.loop,
                center: "yes" === settings.center,
                nav: "yes" === settings.nav,
                navText: ["", ""],
                dots: "yes" === settings.dots,
                mouseDrag: "yes" === settings.mouse_drag,
                rtl: "yes" === settings.rtl,
                touchDrag: true,
                autoHeight: false,
                autoWidth: "yes" === settings.custom_width,
                responsiveBaseElement: responsiveWrapper,
                autoplay: "yes" === settings.autoplay,
                autoplayTimeout: "yes" === settings.autoplay ? 1000 * settings.autoplay_timeout.size : 3000,
                autoplayHoverPause: true,
                smartSpeed: 500,
                responsive: { 0: { items: settings.item_per_row_mobile || 1 }, 768: { items: settings.item_per_row_tablet || 1 }, 1024: { items: settings.item_per_row || 2 } },
            });

            setTimeout(function () {
                adjustHeight();
            }, 300);

            $(window).on("resize", function () {
                setTimeout(function () {
                    adjustHeight();
                }, 500);
            });
        },










        team: function (teamElement) {
            let settings = easyelements.getElementSettings(teamElement);
            if ("3" === settings.layout) {
                teamElement.find(".ele-team-layout-3").hover(
                    function () {
                        $(this).find(".ele-team-description").slideDown(200);
                    },
                    function () {
                        $(this).find(".ele-team-description").slideUp(200);
                    }
                );
            }
            if ("7" === settings.layout) {
                teamElement.find(".ele-team-layout-7").hover(
                    function () {
                        $(this).find(".ele-team-description").slideDown(200);
                        $(this).find(".ele-team-social-list").slideDown(250);
                    },
                    function () {
                        $(this).find(".ele-team-description").slideUp(200);
                        $(this).find(".ele-team-social-list").slideUp(250);
                    }
                );
            }
            if ("8" === settings.layout) {
                teamElement.find(".ele-team-layout-8").hover(
                    function () {
                        $(this).find(".ele-team-content").slideDown(200);
                    },
                    function () {
                        $(this).find(".ele-team-content").slideUp(200);
                    }
                );
            }
            if ("9" === settings.layout) {
                let teamImageHeight = teamElement.find(".ele-team-image > img").height(),
                    teamInnerContentHeight = teamElement.find(".ele-team-inner-content").height();
                teamElement.find(".ele-team-inner-content").width(teamImageHeight);
                teamElement.find(".ele-team-inner-content").css("left", teamInnerContentHeight + "px");
            }
            if ("14" === settings.layout) {
                teamElement.find(".ele-team-layout-14").hover(
                    function () {
                        $(this).find(".ele-team-description").slideDown(200);
                        $(this).find(".ele-team-social-list").slideDown(250);
                    },
                    function () {
                        $(this).find(".ele-team-description").slideUp(200);
                        $(this).find(".ele-team-social-list").slideUp(250);
                    }
                );
            }
        },








        post_grid: function (element) {
            let elementSettings = easyelements.getElementSettings(element),
                gridMain = element.find(".ele-post-grid-main");
            element.find(".ele-post-grid-item"),
                gridMain.cubeportfolio({
                    layoutMode: "grid",
                    gridAdjustment: "responsive",
                    lightboxGallery: false,
                    mediaQueries: [
                        { width: elementorFrontend.config.breakpoints.lg, cols: elementSettings.desktopColumns || 3, options: { gapHorizontal: elementSettings.desktopGap || 0, gapVertical: elementSettings.desktopGap || 0 } },
                        { width: elementorFrontend.config.breakpoints.md, cols: elementSettings.tabletColumns || 2, options: { gapHorizontal: elementSettings.tabletGap || 0, gapVertical: elementSettings.tabletGap || 0 } },
                        { width: 0, cols: elementSettings.mobileColumns || 1, options: { gapHorizontal: elementSettings.mobileGap || 0, gapVertical: elementSettings.mobileGap || 0 } },
                    ],
                    displayType: "default",
                    displayTypeSpeed: 0,
                });
        },
        getElementSettings: function (element, modelCid) {
            var settings = {},
                dataModelCid = element.data("model-cid");
            if (elementorFrontend.isEditMode() && dataModelCid) {
                var elementData = elementorFrontend.config.elements.data[dataModelCid],
                    elementType = elementData.attributes.widgetType || elementData.attributes.elType,
                    elementKeys = elementorFrontend.config.elements.keys[elementType];
                elementKeys ||
                ((elementKeys = elementorFrontend.config.elements.keys[elementType] = []),
                    jQuery.each(elementData.controls, function (controlKey, control) {
                        control.frontend_available && elementKeys.push(controlKey);
                    })),
                    jQuery.each(elementData.getActiveControls(), function (controlKey) {
                        -1 !== elementKeys.indexOf(controlKey) && (settings[controlKey] = elementData.attributes[controlKey]);
                    });
            } else settings = element.data("settings") || {};
            return easyelements.getItems(settings, modelCid);
        },
        getItems: function (settings, keyPath) {
            if (keyPath) {
                var keys = keyPath.split("."),
                    currentKey = keys.splice(0, 1);
                if (!keys.length) return settings[currentKey];
                if (!settings[currentKey]) return;
                return this.getItems(settings[currentKey], keys.join("."));
            }
            return settings;
        },
        model_popup: function ($scope, $) {

            var modalWrapper = $scope.find('.ele-modal').eq(0),
                modalOverlayWrapper = $scope.find('.ele-modal-overlay'),
                modalItem = $scope.find('.ele-modal-item'),
                modalAction = modalWrapper.find('.ele-modal-image-action'),
                closeButton = modalWrapper.find('.ele-close-btn');

            modalAction.on('click', function (e) {
                e.preventDefault();
                var modalOverlay = $(this).parents().eq(1).next();
                var modal = $(this).data('ele-modal');

                var overlay = $(this).data('ele-overlay');
                modalItem.css('display', 'block');
                setTimeout(function () {
                    $(modal).addClass('active');
                }, 100);
                if ('yes' === overlay) {
                    modalOverlay.addClass('active');
                }

            });

            closeButton.click(function () {
                var modalOverlay = $(this).parents().eq(3).next();
                var modalItem = $(this).parents().eq(2);
                modalOverlay.removeClass('active');
                modalItem.removeClass('active');

                var modal_iframe = modalWrapper.find('iframe'),
                    $modal_video_tag = modalWrapper.find('video');

                if (modal_iframe.length) {
                    var modal_src = modal_iframe.attr('src').replace('&autoplay=1', '');
                    modal_iframe.attr('src', '');
                    modal_iframe.attr('src', modal_src);
                }
                if ($modal_video_tag.length) {
                    $modal_video_tag[0].pause();
                    $modal_video_tag[0].currentTime = 0;
                }

            });

            modalOverlayWrapper.click(function () {
                var overlay_click_close = $(this).data('ele_overlay_click_close');
                if ('yes' === overlay_click_close) {
                    $(this).removeClass('active');
                    $('.ele-modal-item').removeClass('active');

                    var modal_iframe = modalWrapper.find('iframe'),
                        $modal_video_tag = modalWrapper.find('video');

                    if (modal_iframe.length) {
                        var modal_src = modal_iframe.attr('src').replace('&autoplay=1', '');
                        modal_iframe.attr('src', '');
                        modal_iframe.attr('src', modal_src);
                    }
                    if ($modal_video_tag.length) {
                        $modal_video_tag[0].pause();
                        $modal_video_tag[0].currentTime = 0;
                    }
                }
            });
        }
        

    };

    // Initializing easyelements
    $(window).on("elementor/frontend/init", easyelements.init);

})(jQuery);
