(function ($) {
    $(window).on('elementor:init', function () {
        elementor.hooks.addFilter('editor/style/styleText', function (styleText, element) {
            if (element) {
                var model = element.model,
                    customCss = model.get('settings').get('ele_custom_css'),
                    cssSelector = '.elementor-element.elementor-element-' + model.get('id');

                if (model.get('elType') === 'document') {
                    cssSelector = elementor.config.document.settings.cssWrapperSelector;
                }

                if (customCss) {
                    styleText += customCss.replace(/selector/g, cssSelector);
                }

                return styleText;
            }
        });
    });
})(jQuery);