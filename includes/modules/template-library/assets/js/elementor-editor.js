(function ($) {

    'use strict';

    var EasyTempsData = window.EasyTempsData || {},
        EasyEditorViews,
        EasyEditor;

    EasyEditorViews = {
        init: function () {

            EasyEditorViews.EleTemplateLibraryTemplateModel = Backbone.Model.extend({
                defaults : {
                    id : 0,
                    date : "",
                    title : "",
                    is_pro : "",
                    thumbnail : "",
                    demo_url : "",
                    categories : "",
                }
            });

            EasyEditorViews.EpCategoryModel = Backbone.Model.extend({
                defaults : {
                    term_slug : "",
                    term_name : "",
                    count : 0
                }
            });

            EasyEditorViews.EpTabModel = Backbone.Model.extend({
                defaults : {
                    term_slug : "",
                    term_name : "",
                    count : 0
                }
            });

            EasyEditorViews.DependencyModel = Backbone.Model.extend({
                defaults: {
                    name: ''
                }
            });

            // Tab collection
            EasyEditorViews.EleTemplateTabsCollection = Backbone.Collection.extend({
                model : EasyEditorViews.EpTabModel
            });

            // Template collection
            EasyEditorViews.EleTemplateCollection = Backbone.Collection.extend({
                model : EasyEditorViews.EleTemplateLibraryTemplateModel
            });

            // Category collection
            EasyEditorViews.EpCategoriesCollection = Backbone.Collection.extend({
                model : EasyEditorViews.EpCategoryModel
            });

            // Dependency Collection
            EasyEditorViews.DependencyCollection = Backbone.Collection.extend({
                model: EasyEditorViews.DependencyModel
            });


            // Elementor loading animation template
            EasyEditorViews.EleTemplateLoadingView = Marionette.ItemView.extend({
                id: "easy-elements-template-library-loading",
                template: "#easy-editor-template-library-loading"
            });

            // Display error massage
            EasyEditorViews.EleTemplateErrorView = Marionette.ItemView.extend({
                id: "easy-elements-template-library-error",
                template: "#view-easy-elements-template-library-error"
            });


            // Category filter Item
            EasyEditorViews.EpFiltersItemView = Marionette.ItemView.extend({
                template: "#view-easy-elements-template-library-filters-item",
                className: function() {
                    return "easy-elements-filter-item";
                },
                ui: function() {
                    return {
                        filterLabels: ".easy-elements-template-library-filter-label"
                    };
                },
                events: function() {
                    return {
                        "click @ui.filterLabels": "onFilterClick"
                    };
                },
                onFilterClick: function(event) {
                    var minbox = jQuery(event.target);
                    EasyEditor.setFilter("searchkeyword", "");
                    EasyEditor.setFilter("category", minbox.val());
                    jQuery("#elementor-template-library-filter-text").val("");
                }
            });

            /**
             * Single tab item
             */
            EasyEditorViews.EleTemplateTabsItemView = Marionette.ItemView.extend({
                template : "#view-easy-elements-template-library-tabs-item",
                className : function() {
                    return "elementor-template-library-menu-item";
                },
                ui : function() {
                    return {
                        tabsLabels : "label",
                        tabsInput : "input"
                    };
                },
                events : function() {
                    return {
                        "click @ui.tabsLabels" : "onTabClick"
                    };
                },
                onRender : function() {
                    if (this.model.get("term_slug") === EasyEditor.getTab()) {
                        this.ui.tabsInput.attr("checked", "checked");
                    }
                },
                onTabClick : function(event) {
                    var minbox = jQuery(event.target);
                    EasyEditor.setTab(minbox.val());
                    EasyEditor.setFilter("searchkeyword", "");
                }
            });

            // Tabs collection view
            EasyEditorViews.EleTemplateTabsCollectionView = Marionette.CompositeView.extend({
                template : "#view-easy-elements-template-library-tabs",
                childViewContainer : "#easy-elements-template-library-tabs-items",
                initialize : function() {
                },
                getChildView : function(name) {
                    return EasyEditorViews.EleTemplateTabsItemView;
                }
            });

            // Header area view
            EasyEditorViews.EleTemplateHeaderView = Marionette.LayoutView.extend({
                id : "easy-elements-template-library-header",
                template : "#easy-elements-view-template-library-header",
                ui : {
                    closeModal : "#easy-elements-template-library-header-close-modal",
                    syncBtn : "#easy-elements-template-library-header-sync.elementor-templates-modal__header__item>i"
                },
                events : {
                    "click @ui.closeModal" : "onCloseModalClick",
                },
                regions : {
                    headerTabs : "#easy-elements-template-library-header-tabs",
                    headerActions : "#easy-elements-template-library-header-actions"
                },
                onCloseModalClick : function() {
                    EasyEditor.closeModal();
                },
            });

            /**
             * Preview code started
             */
            // Preview push
            EasyEditorViews.EleTemplatePreviewView = Marionette.ItemView.extend({
                template: "#view-easy-elements-template-library-preview",
                id: "elementor-template-library-preview",
                ui: {
                    iframe: "iframe"
                },
                onRender: function() {
                    EasyEditor.hideHeaderLogo();
                    this.ui.iframe.attr("src", this.getOption("preview"));
                }
            });

            // Back button
            EasyEditorViews.EleTemplateHeaderBack = Marionette.ItemView.extend({
                template: "#easy-elements-view-template-library-header-back",
                id: "easy-elements-template-library-header-back",
                ui: {
                    button: "button"
                },
                events: {
                    "click @ui.button": "onBackClick"
                },
                onBackClick: function() {
                    EasyEditor.setPreview("back");
                    EasyEditor.showHeaderLogo();
                    EasyEditor.requirePluginShowStatus = false;
                }
            });

            // Import template
            EasyEditorViews.EleTemplateInsertTemplateBehavior = Marionette.Behavior.extend({
                ui: {
                    insertButton: ".easy-elements-template-library-template-insert"
                },
                events: {
                    "click @ui.insertButton": "onInsertButtonClick"
                },
                onInsertButtonClick: function() {
                    var template;
                    var EasyTempsData;
                    var data;
                    var model = this.view.model;
                    EasyEditor.layout.showLoadingView();
                    data = {
                        unique_id: template = model.get("id"),
                        data: {
                            edit_mode: true,
                            display: true,
                            template_id: template
                        }
                    };
                    if (EasyTempsData = {
                        success: function(e) {
                            $e.run("document/elements/import", {
                                model: window.elementor.elementsModel,
                                data: e,
                                EasyTempsData: {}
                            });
                            if ( e.dependencies == true ) {
                                $e.run('document/save/default');
                                elementor.channels.editor.on('saved', function(data) {
                                    location.reload();
                                });
                            }

                            EasyEditor.closeModal();

                        },
                        error: function(deleted_model) {
                            if ("required_activated_license" == deleted_model) {
                                EasyEditor.layout.showLicenseError();
                            } else {
                                alert("An error occurred. Pls try again!");
                            }
                        }
                    }) {
                        jQuery.extend(true, data, EasyTempsData);
                    }
                    elementorCommon.ajax.addRequest("ele_template_import", data);
                }
            });

            // Template insert button
            EasyEditorViews.EleTemplateHeaderInsertButton = Marionette.ItemView.extend({
                template: "#view-easy-elements-template-library-insert-button",
                id: "easy-elements-template-library-insert-button",
                behaviors: {
                    insertTemplate: {
                        behaviorClass: EasyEditorViews.EleTemplateInsertTemplateBehavior
                    }
                },
                ui: function () {
                    return {
                        RequiredPluginsButton: ".ele-required-plugins-list-btn"
                    }
                },
                events: function () {
                    return {
                        "click @ui.RequiredPluginsButton" : "RequiredPluginsListShow"
                    };
                },
                initialize: function () {
                    this.dependencies = new EasyEditorViews.DependencyCollection(this.model.get('dependencies'));
                },
                RequiredPluginsListShow: function () {
                    EasyEditor.showRequiredPluginsList();
                },
                onRender: function () {
                    if (this.dependencies && this.dependencies.length > 0) {
                        this.renderDependencies();
                    }
                },
                renderDependencies: function () {
                    var headerView = new EasyEditorViews.RequiredPluginsHeaderView();
                    this.$('.ele-required-plugins-list').append(headerView.render().el);

                    this.dependencies.each(function(dependency) {
                        var itemView = new EasyEditorViews.DependencyItemView({ model: dependency });
                        this.$('.ele-required-plugins-list').append(itemView.render().el);
                    }, this);
                }

            });

            EasyEditorViews.RequiredPluginsHeaderView = Marionette.ItemView.extend({
                template: _.template('<li class="ele-plugin-card-head"><strong>Install Required Plugins</strong></li>')
            });

            EasyEditorViews.DependencyItemView = Marionette.ItemView.extend({
                template: _.template('<li class="ele-plugin-card"><%- name %></li>')
            });

            // Pro button
            EasyEditorViews.EleTemplateProButton = Marionette.ItemView.extend({
                template: "#view-easy-elements-template-library-pro-button",
                id: "easy-elements-template-library-pro-button"
            });

            /**
             * Preview code end
             */

            // Single template Item view
            EasyEditorViews.EleTemplateTemplateItemView = Marionette.ItemView.extend({
                template : "#view-easy-elements-template-library-item",
                className: function () {
                    var urlClass = ' easy-elements-template-has-url',
                        sourceClass = ' elementor-template-library-template-',
                        proTemplate = '';

                    if ('' === this.model.get('demo_url')) {
                        urlClass = ' easy-elements-template-no-url';
                    }

                    sourceClass += 'remote';

                    if (this.model.get('is_pro') == 1 ) {
                        proTemplate = ' easy-elements-template-pro';
                    }

                    return 'elementor-template-library-template' + sourceClass + urlClass + proTemplate;
                },
                ui : function() {
                    return {
                        previewButton : ".elementor-template-library-template-preview"
                    };
                },
                events : function() {
                    return {
                        "click @ui.previewButton" : "onPreviewButtonClick"
                    };
                },
                onPreviewButtonClick : function() {
                    if ("" !== this.model.get("demo_url")) {
                        EasyEditor.setPreview(this.model);
                    }
                },

                behaviors : {
                    insertTemplate: {
                        behaviorClass: EasyEditorViews.EleTemplateInsertTemplateBehavior
                    }
                }
            });

            // Template Items full area view
            EasyEditorViews.EleTemplateCollectionView = Marionette.CompositeView.extend({
                template: "#view-easy-elements-template-library-templates",
                id: "easy-elements-template-library-templates",
                childViewContainer: "#easy-elements-template-library-templates-container",
                initialize: function() {
                    this.listenTo(EasyEditor.channels.templates, "filter:change", this._renderChildren);
                },
                filter: function(doc) {
                    var currentNick = EasyEditor.getFilter("searchkeyword");
                    if (currentNick) {
                        return currentNick = currentNick.toLowerCase(), -1 !== doc.get("title").toLowerCase().indexOf(currentNick.toLowerCase()) && (EasyEditor.countResult = EasyEditor.countResult + 1, true);
                    }
                    var directionCat = EasyEditor.getFilter("category");
                    return directionCat ? doc.get("categories") == directionCat : doc.get("categories") != directionCat || doc.get("categories") == directionCat;
                },

                getChildView: function(name) {
                    return EasyEditorViews.EleTemplateTemplateItemView;
                },
                onRenderCollection: function() {
                    EasyEditor.showSearchCounter();
                }
            });

            // Category display
            EasyEditorViews.EpFiltersCollectionView = Marionette.CompositeView.extend({
                id: "easy-elements-template-library-filters",
                template: "#view-easy-elements-template-library-filters",
                childViewContainer: "#easy-elements-template-library-filters-container",
                getChildView: function(name) {
                    return EasyEditorViews.EpFiltersItemView;
                }
            });

            // Template body section
            EasyEditorViews.EleTemplateBodyView = Marionette.LayoutView.extend({
                id : "easy-elements-template-library-content",
                className : function() {
                    return "library-tab-" + EasyEditor.getTab();
                },
                ui : function() {
                    return {
                        SearchInput : "input#elementor-template-library-filter-text"
                    };
                },
                events : function() {
                    return {
                        "keyup @ui.SearchInput" : "onTextFilterInput"
                    };
                },
                onTextFilterInput : function() {
                    var value = this.ui.SearchInput.val();
                    EasyEditor.countResult = 0;
                    EasyEditor.setFilter("searchkeyword", value);
                },
                template : "#view-easy-elements-template-library-content",
                regions : {
                    contentTemplates : ".easy-elements-templates-list",
                    contentFilters : ".easy-elements-filters-list"
                }
            });

            // Template full layout
            EasyEditorViews.TemplateLayoutView = Marionette.LayoutView.extend({
                el: "#easy-elements-template-library-modal",
                regions: {
                    "modalHeader": ".dialog-header",
                    "modalContent": ".dialog-message"
                },
                initialize : function() {
                    this.getRegion("modalHeader").show(new EasyEditorViews.EleTemplateHeaderView);
                    this.listenTo(EasyEditor.channels.tabs, "filter:change", this.switchTabs);
                    this.listenTo(EasyEditor.channels.layout, "preview:change", this.switchPreview);
                },
                switchTabs: function() {
                    this.showLoadingView();
                    EasyEditor.getTemplatedata(EasyEditor.getTab());
                },
                switchPreview: function handlePreview() {
                    var settings = this.getHeaderView(); // Get header view settings

                    // Get the preview data
                    var previewData = EasyEditor.getPreview();

                    // If the preview is not available, show header tabs with default settings and return
                    if (previewData === "back") {
                        settings.headerTabs.show(new EasyEditorViews.EleTemplateTabsCollectionView({
                            collection: EasyEditor.collections.tabs
                        }));
                        settings.headerActions.empty();
                        EasyEditor.setTab(EasyEditor.getTab());
                        return;
                    }

                    // If preview data is available
                    if (previewData !== "initial") {
                        // Show preview view with demo URL
                        this.getRegion("modalContent").show(new EasyEditorViews.EleTemplatePreviewView({
                            preview: previewData.get("demo_url")
                        }));

                        // Show header tabs
                        settings.headerTabs.show(new EasyEditorViews.EleTemplateHeaderBack);

                        // Show insert button or Pro button based on conditions
                        if (previewData.get("is_pro") !== 1 || EasyTempsData.license.activated) {
                            settings.headerActions.show(new EasyEditorViews.EleTemplateHeaderInsertButton({
                                model: previewData
                            }));
                        } else {
                            settings.headerActions.show(new EasyEditorViews.EleTemplateProButton({
                                model: previewData
                            }));
                        }
                    } else {
                        settings.headerActions.empty(); // Clear header actions if preview data is "initial"
                    }
                },
                getHeaderView : function() {
                    return this.getRegion("modalHeader").currentView;
                },
                getContentView : function() {
                    return this.getRegion("modalContent").currentView;
                },
                showLoadingView: function () {
                    this.modalContent.show( new EasyEditorViews.EleTemplateLoadingView );
                },
                showLicenseError: function() {
                    this.modalContent.show(new EasyEditorViews.EleTemplateErrorView);
                },
                showTemplatesView : function(templatesCollection, categories) {
                    this.getRegion("modalContent").show(new EasyEditorViews.EleTemplateBodyView);

                    var elementData = this.getContentView();
                    var headerView = this.getHeaderView();

                    EasyEditor.collections.tabs = new EasyEditorViews.EleTemplateTabsCollection(EasyEditor.getTabs());

                    headerView.headerTabs.show(new EasyEditorViews.EleTemplateTabsCollectionView({
                        collection : EasyEditor.collections.tabs
                    }));

                    elementData.contentTemplates.show(new EasyEditorViews.EleTemplateCollectionView({
                        collection : templatesCollection
                    }));

                    elementData.contentFilters.show(new EasyEditorViews.EpFiltersCollectionView({
                        collection : categories
                    }));

                }
            });
        }

    };

    EasyEditor = {
        modal: false,
        layout: false,
        collections: {},
        tabs: {},
        defaultTab: "",
        countResult: 0,
        channels: {},
        atIndex: null,
        requirePluginShowStatus: false,
        init: function () {
            $(document).ready(function () {
                EasyEditor.initEasyTempsButton();
            });

            window.elementor.on('document:loaded', window._.bind( EasyEditor.onPreviewLoaded, EasyEditor ) );

            EasyEditorViews.init();
        },

        onPreviewLoaded: function () {
            window.elementor.$previewContents.on(
                'click',
                '#easy-library-btn',
                _.bind( this.showTemplatesModal, this )
            );

            this.channels = {
                templates : Backbone.Radio.channel("EASY_ELEMENTS:templates"),
                tabs : Backbone.Radio.channel("EASY_ELEMENTS:tabs"),
                layout : Backbone.Radio.channel("EASY_ELEMENTS:layout")
            };

            this.tabs = EasyTempsData.tabs;
            this.defaultTab = EasyTempsData.defaultTab;
        },

        initEasyTempsButton: function () {
            var addEasyTemplate = '<div id="easy-library-btn" class="elementor-add-section-area-button" title="Add Easy Template"><i class="ele ele-easy-elements"></i></div>',
                addSectionTmpl = $("#tmpl-elementor-add-section");


            if (addSectionTmpl.length < 1)
                return;

            var addSectionTmplHTML = addSectionTmpl.html();

            addSectionTmplHTML = addSectionTmplHTML.replace('<div class="elementor-add-section-drag-title', addEasyTemplate + '<div class="elementor-add-section-drag-title');
            addSectionTmpl.html(addSectionTmplHTML);

        },
        getPreview: function(text) {
            return this.channels.layout.request("preview");
        },
        setPreview: function(value, row) {
            this.channels.layout.reply("preview", value);
            if (!row) {
                this.channels.layout.trigger("preview:change");
            }
        },
        showTemplatesModal: function () {
            this.getModal().show();
            if (!this.layout) {
                this.layout = new EasyEditorViews.TemplateLayoutView;
                this.layout.showLoadingView();
            }

            this.setTab(this.defaultTab, true);
            this.getTemplatedata(this.defaultTab);
            this.setPreview("initial");

        },
        getTemplatedata : function(i) {
            var $scope = this;
            var res = $scope.tabs[i];
            $scope.setFilter("category", false);
            if (res.data.templates && res.data.categories) {
                $scope.layout.showTemplatesView(res.data.templates, res.data.categories);
            } else {
                $.ajax({
                    url : ajaxurl,
                    type : "post",
                    dataType : "json",
                    data : {
                        action : "ele_get_templates",
                        tab : i
                    },
                    success : function(res) {
                        var templatesCollection = new EasyEditorViews.EleTemplateCollection(res.data.templates);
                        var categories = new EasyEditorViews.EpCategoriesCollection(res.data.categories);
                        $scope.tabs[i].data = {
                            templates : templatesCollection,
                            categories : categories
                        };
                        $scope.layout.showTemplatesView(templatesCollection, categories);
                    }
                });
            }
        },

        showHeaderLogo: function() {
            $("#easy-elements-template-library-header-logo-area").show();
        },
        hideHeaderLogo: function() {
            $("#easy-elements-template-library-header-logo-area").hide();
        },
        showSearchCounter: function() {
            if (EasyEditor.getFilter("searchkeyword")) {
                $("#easy-elements-template-library-content .search-result-counter span").html(this.countResult);
                $("#easy-elements-template-library-content .search-result-counter").show();
            } else {
                this.hideSearchCounter();
            }
        },
        hideSearchCounter: function() {
            $("#easy-elements-template-library-content .search-result-counter").hide();
            $("#easy-elements-template-library-content .search-result-counter span").html(0);
        },
        getModal: function () {
            if (!this.modal) {
                this.modal = elementor.dialogsManager.createWidget("lightbox", {
                    id: "easy-elements-template-library-modal",
                    closeButton: false,
                    position: {
                        my: "center",
                        at: "center",
                        of: window
                    }
                });
            }
            return this.modal;

        },

        getFilter: function(id) {
            return this.channels.templates.request("filter:" + id);
        },

        setFilter : function(method, data) {
            this.channels.templates.reply("filter:" + method, data);
            this.channels.templates.trigger("filter:change");
        },

        setTab: function (id, index) {
            this.channels.tabs.reply("filter:tabs", id);
            if (!index) {
                this.channels.tabs.trigger("filter:change");
            }
        },

        getTab : function() {
            return this.channels.tabs.request("filter:tabs");
        },

        getTabs : function() {
            var tabItems = [];
            return _.each(this.tabs, function( item, key ) {
                tabItems.push({
                    term_slug : key,
                    title : item.title
                });
            }), tabItems;
        },
        closeModal : function() {
            this.getModal().hide();
            this.showHeaderLogo();
        },
        showRequiredPluginsList: function () {
            if ( this.requirePluginShowStatus == false ) {
                $(".ele-tooltip-wrap").show();
                this.requirePluginShowStatus = true;
            } else {
                $(".ele-tooltip-wrap").hide();
                this.requirePluginShowStatus = false;
            }
        }
    };

    $(window).on('elementor:init', EasyEditor.init);
})(jQuery);
