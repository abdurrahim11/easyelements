(function ( $, elementorFrontend ) {

    'use strict';
    var ele_sticky_helper = {
        init: function() {
            var initialize;

            initialize = function(markup, options) {
                var node;
                var self;
                var is_sticky = false;
                var is_show_on_scroll_up = false;
                var is_effects_active = false;
                var settings = {};
                var scrollY = -1;
                var descriptor = {
                    to: "top",
                    offset: 0,
                    effectsOffset: 0,
                    parent: false,
                    classes: {
                        sticky: "ele-sticky",
                        stickyActive: "ele-sticky-active",
                        stickyEffects: "ele-sticky-effects",
                        spacer: "ele-sticky-spacer",
                        up: "ele-sticky--up",
                        down: "ele-sticky--down"
                    }
                };

                var animate = function(node, type, attributes) {
                    var backup = {};
                    var style = node[0].style;
                    attributes.forEach(function(name) {
                        backup[name] = undefined !== style[name] ? style[name] : "";
                    });
                    node.data("css-backup-" + type, backup);
                };

                var create = function(node, type) {
                    return node.data("css-backup-" + type);
                };

                var show = function() {
                    animate(node, "unsticky", ["position", "width", "margin-top", "margin-bottom", "top", "bottom"]);
                    var css = {
                        position: "fixed",
                        width: check(node, "width"),
                        marginTop: 0,
                        marginBottom: 0
                    };
                    css[self.to] = self.offset + "px";
                    css["top" === self.to ? "bottom" : "top"] = "";
                    node.css(css).addClass(self.classes.stickyActive);
                };

                var toggle = function() {
                    node.css(create(node, "unsticky")).removeClass(self.classes.stickyActive);
                };

                var check = function(node, property, include_margin) {
                    var style = getComputedStyle(node[0]);
                    var value = parseFloat(style[property]);
                    var box_properties = "height" === property ? ["top", "bottom"] : ["left", "right"];
                    var adjustments = [];
                    if ("border-box" !== style.boxSizing) {
                        adjustments.push("border", "padding");
                    }
                    if (include_margin) {
                        adjustments.push("margin");
                    }
                    adjustments.forEach(function(namespace) {
                        box_properties.forEach(function(key) {
                            value += parseFloat(style[namespace + "-" + key]);
                        });
                    });
                    return value;
                };

                var update = function(node) {
                    var y = settings.$window.scrollTop();
                    var height = check(node, "height");
                    var viewport_height = innerHeight;
                    var distance_from_top = node.offset().top - y;
                    var distance_from_bottom = distance_from_top - viewport_height;
                    return {
                        top: {
                            fromTop: distance_from_top,
                            fromBottom: distance_from_bottom
                        },
                        bottom: {
                            fromTop: distance_from_top + height,
                            fromBottom: distance_from_bottom + height
                        }
                    };
                };

                var hide = function() {
                    settings.$spacer = node.clone().addClass(self.classes.spacer).css({
                        visibility: "hidden",
                        transition: "none",
                        animation: "none"
                    });
                    node.after(settings.$spacer);
                    show();
                    is_sticky = true;
                    node.trigger("sticky:stick");
                };

                var save = function() {
                    toggle();
                    settings.$spacer.remove();
                    is_sticky = false;
                    node[0].style.transform = null;
                    node.trigger("sticky:unstick");
                };

                var init = function() {
                    var node_position = update(node);
                    var is_top = "top" === self.to;
                    if (is_effects_active) {
                        if (is_top ? node_position.top.fromTop > self.offset : node_position.bottom.fromBottom < -self.offset) {
                            settings.$parent.css(create(settings.$parent, "childNotFollowing"));
                            node.css(create(node, "notFollowing"));
                            is_effects_active = false;
                        }
                    } else {
                        var parent_position = update(settings.$parent);
                        var parent_style = getComputedStyle(settings.$parent[0]);
                        var parent_border = parseFloat(parent_style[is_top ? "borderBottomWidth" : "borderTopWidth"]);
                        var parent_offset = is_top ? parent_position.bottom.fromTop - parent_border : parent_position.top.fromBottom + parent_border;
                        if (is_top ? parent_offset <= node_position.bottom.fromTop : parent_offset >= node_position.top.fromBottom) {
                            (function() {
                                animate(settings.$parent, "childNotFollowing", ["position"]);
                                settings.$parent.css("position", "relative");
                                animate(node, "notFollowing", ["position", "top", "bottom"]);
                                var css = {
                                    position: "absolute"
                                };
                                css[self.to] = "";
                                css["top" === self.to ? "bottom" : "top"] = 0;
                                node.css(css);
                                is_effects_active = true;
                            })();
                        }
                    }
                };

                var render = function() {
                    var translateY;
                    var offset = self.offset;
                    if (self.stopAt || self.column) {
                        var element = node[0];
                        var container = self.stopAt || node.parent();
                        var container_top = container.offset().top;
                        var container_height = container[0].clientHeight - element.clientHeight;
                        var scrollY_offset = this.scrollY - container_top + self.offset;
                        var is_above_top = scrollY_offset >= container_height;
                        if ("bottom" === self.to && (container_height = container_top - (this.innerHeight - element.clientHeight), is_above_top = (scrollY_offset = this.scrollY + self.offset) <= container_height, element.clientHeight), is_above_top && (self.column && "widget" === element.dataset.element_type)) {
                            return is_sticky && save(), void(element.style.transform = "translateY(" + container_height + "px)");
                        }
                        element.style.transform = null;
                    }
                    if (is_sticky) {
                        var spacer_position = update(settings.$spacer);
                        translateY = "top" === self.to ? spacer_position.top.fromTop - offset : -spacer_position.bottom.fromBottom - offset;
                        if (self.parent) {
                            init();
                        }
                        if (translateY > 0) {
                            save();
                        }
                    } else {
                        var node_position = update(node);
                        if ((translateY = "top" === self.to ? node_position.top.fromTop - offset : -node_position.bottom.fromBottom - offset) <= 0) {
                            hide();
                            if (self.parent) {
                                init();
                            }
                        }
                    }
                    if (self.stopAt || self.column) {
                        if (is_above_top) {
                            if (self.stopAt) {
                                var translateY_offset = "top" === self.to ? -(scrollY_offset - container_height) : container_height - scrollY_offset;
                                element.style.transform = "translateY(" + translateY_offset + "px)";
                            }
                        }
                    }

                    if (is_show_on_scroll_up && -translateY < self.effectsOffset) {
                        node.removeClass(self.classes.stickyEffects);
                        is_show_on_scroll_up = false;
                    } else {
                        if (!is_show_on_scroll_up) {
                            if (-translateY >= self.effectsOffset) {
                                node.addClass(self.classes.stickyEffects);
                                is_show_on_scroll_up = true;
                            }
                        }
                    }

                    complete();
                };

                var complete = function() {
                    if (self.isShowOnScrollUp) {
                        if (-1 != scrollY) {
                            if (scrollY > window.scrollY) {
                                node.addClass(self.classes.up).removeClass(self.classes.down);
                            } else {
                                node.addClass(self.classes.down).removeClass(self.classes.up);
                            }
                        }
                    }
                    scrollY = window.scrollY;
                };

                var scroll = function() {
                    render();
                };

                var start = function() {
                    if (is_sticky) {
                        toggle();
                        show();
                    }
                };

                this.destroy = function() {
                    if (is_sticky) {
                        save();
                    }
                    settings.$window.off("scroll", scroll).off("resize", start);
                    node.removeClass(self.classes.sticky);
                };

                self = jQuery.extend(true, descriptor, options);
                node = $(markup).addClass(self.classes.sticky);
                settings.$window = $(window);
                if (self.parent) {
                    if ("parent" === self.parent) {
                        settings.$parent = node.parent();
                    } else {
                        settings.$parent = node.closest(self.parent);
                    }
                }
                settings.$window.on({
                    scroll: scroll,
                    resize: start
                });
                render();
            };

            $.fn.ele_sticky = function(method) {
                var is_string = "string" == typeof method;
                return this.each(function() {
                    var $el = $(this);
                    if (is_string) {
                        var instance = $el.data("ele_sticky");
                        if (!instance) {
                            throw Error("Trying to perform the `" + method + "` method prior to initialization");
                        }
                        if (!instance[method]) {
                            throw ReferenceError("Method `" + method + "` not found in sticky instance");
                        }
                        instance[method].apply(instance, Array.prototype.slice.call(arguments, 1));
                        if ("destroy" === method) {
                            $el.removeData("ele_sticky");
                        }
                    } else {
                        $el.data("ele_sticky", new initialize(this, method));
                    }
                }), this;
            };
            window.ele_sticky = initialize;
        },

        Sticky_Handler:elementorModules.frontend.handlers.Base.extend({
            bind_events : function() {
                elementorFrontend.addListenerOnce(this.getUniqueHandlerID() + "ele_sticky", "resize", this.run);
            },
            unbind_events : function() {
                elementorFrontend.removeListeners(this.getUniqueHandlerID() + "ele_sticky", "resize", this.run);
            },
            is_sticky_on : function() {
                return undefined !== this.$element.data("ele_sticky");
            },
            activate : function() {
                var self = this.getElementSettings();
                var revision_checkbox = $("#" + self.ele_sticky_until);
                var options = {
                    to : self.ele_sticky,
                    offset : self.ele_sticky_offset.size,
                    effectsOffset : self.ele_sticky_effect_offset.size,
                    classes : {
                        sticky : "ele-sticky",
                        stickyActive : "ele-sticky--active ele-section--handles-inside",
                        stickyEffects : "ele-sticky--effects",
                        spacer : "ele-sticky__spacer"
                    },
                    stopAt : !!revision_checkbox.length && revision_checkbox
                };
                var $cont = elementorFrontend.getElements("$wpAdminBar");
                if ("column" === self.ele_sticky) {
                    options.to = "top";
                    options.column = true;
                }
                if ("show_on_scroll_up" === self.ele_sticky) {
                    options.to = "top";
                    options.isShowOnScrollUp = true;
                }
                if (self.ele_sticky_parent) {
                    options.parent = ".ele-widget-wrap";
                }
                elementorFrontend.hooks.addFilter("frontend/handlers/menu_anchor/scroll_top_distance", function(data) {
                    var self = $(".elementor-top-section.ele-sticky--active:visible");
                    return self.length ? data - self.outerHeight() : data;
                });
                if ($cont.length) {
                    if ("top" === self.ele_sticky) {
                        if ("fixed" === $cont.css("position")) {
                            options.offset += $cont.height();
                        }
                    }
                }
                this.$element.ele_sticky(options);
            },
            deactivate : function() {
                if (this.is_sticky_on()) {
                    this.$element.ele_sticky("destroy");
                }
            },
            run : function(dataAndEvents) {
                if (this.getElementSettings("ele_sticky")) {
                    var searchString = elementorFrontend.getCurrentDeviceMode();
                    var str = this.getElementSettings("ele_sticky_on");
                    if (str) {
                        if ("string" == typeof str) {
                            str = str.split("_");
                        }
                    }
                    if (-1 !== str.indexOf(searchString)) {
                        if (true === dataAndEvents) {
                            this.reactivate();
                        } else {
                            if (!this.is_sticky_on()) {
                                this.activate();
                            }
                        }
                    } else {
                        this.deactivate();
                    }
                } else {
                    this.deactivate();
                }
            },
            reactivate : function() {
                this.deactivate();
                this.activate();
            },
            onElementChange : function(existingFn) {
                if (-1 !== ["ele_sticky", "ele_sticky_on"].indexOf(existingFn)) {
                    this.run(true);
                }
                if (-1 !== ["ele_sticky_offset", "ele_sticky_effect_offset", "ele_sticky_parent", "ele_sticky_until", "ele_sticky_color"].indexOf(existingFn)) {
                    this.reactivate();
                }
            },
            onInit : function() {
                elementorModules.frontend.handlers.Base.prototype.onInit.apply(this, arguments);
                this.run();
            },
            onDestroy : function() {
                elementorModules.frontend.handlers.Base.prototype.onDestroy.apply(this, arguments);
                this.deactivate();
            }
        })
    };

    var ele_sticky = {
        init: function() {
            ele_sticky_helper.init();
            elementorFrontend.hooks.addAction("frontend/element_ready/global", function( element ) {
                var $sticky_element = element.find("[data-ele-sticky]");
                if ($sticky_element.length) {
                    return $sticky_element.attr({
                        "data-element_type": element.data("element_type")
                    }).data({
                        id: element.data("id"),
                        widget_type: element.data("widget_type"),
                        settings: element.data("settings")
                    }), void new ele_sticky_helper.Sticky_Handler({
                        $element: $sticky_element
                    });
                }
                new ele_sticky_helper.Sticky_Handler({
                    $element: element
                });
            });
        }
    };

    $(window).on("elementor/frontend/init", ele_sticky.init );
})(jQuery, window.elementorFrontend );
