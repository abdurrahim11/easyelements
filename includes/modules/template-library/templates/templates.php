<script type="text/html" id="easy-editor-template-library-loading">
    <div class="elementor-loader-wrapper">
        <div class="elementor-loader">
            <div class="elementor-loader-box"></div>
            <div class="elementor-loader-box"></div>
            <div class="elementor-loader-box"></div>
            <div class="elementor-loader-box"></div>
        </div>
        <div class="elementor-loading-title"><?php esc_html_e( 'Loading', 'easy-elements' ); ?></div>
    </div>
</script>

<script type="text/html" id="easy-elements-view-template-library-header">
    <div id="easy-elements-template-library-header-logo-area">
        <div class="elementor-templates-modal__header__logo">
            <span class="ele-template-library-logo-area">
                <img src="<?php echo esc_url( ELE_ADMIN_ASSETS_UR );?>images/logo.gif" alt="Easy Elements Logo" class="ele-template-library-logo">
            </span>
            <span class="elementor-templates-modal__header__logo__title"><?php esc_html_e( 'Easy Elements', 'easy-elements' ); ?></span>
        </div>
    </div>
    <div id="easy-elements-template-library-header-tabs"></div>
    <div id="easy-elements-template-library-header-actions"></div>
    <div id="easy-elements-template-library-header-close-modal" class="elementor-template-library-header-item" title="<?php esc_html_e('Close', 'easy-elements'); ?>">
        <i class="eicon-close" title="<?php esc_attr_e( 'Close', 'easy-elements' ); ?>"></i>
    </div>
</script>

<script type="text/html" id="view-easy-elements-template-library-content">
    <div class="easy-elements-filters-list"></div>
    <div class="easy-elements-templates-wrap">
        <div id="elementor-template-library-toolbar">

            <p class="search-result-counter" style="display: none"><span>0</span><?php esc_html_e( 'item(s) found!', 'easy-elements' ); ?></p>

            <div id="elementor-template-library-filter-toolbar-remote" class="elementor-template-library-filter-toolbar"></div>

            <div id="elementor-template-library-filter-text-wrapper">

                <label for="elementor-template-library-filter-text" class="elementor-screen-only"><?php esc_html_e( 'Search Templates:', 'easy-elements' ); ?></label>
                <input id="elementor-template-library-filter-text" placeholder="<?php esc_attr_e( 'Search', 'easy-elements' ); ?>">
                <i class="eicon-search"></i>
            </div>
        </div>

        <div class="easy-elements-templates-list"></div>
    </div>

</script>

<script type="text/html" id="view-easy-elements-template-library-tabs">
    <div id="easy-elements-template-library-tabs-items"></div>
</script>

<script type="text/html" id="view-easy-elements-template-library-tabs-item">
    <label>
        <input type="radio" value="{{ term_slug }}" name="easy-elements-library-tab">
        <span>{{ title }}</span>
    </label>
</script>

<script type="text/html" id="view-easy-elements-template-library-templates">
    <div id="easy-elements-template-library-templates-container"></div>
</script>

<script type="text/html" id="view-easy-elements-template-library-item">
    <# var proLink = window.EasyTempsData.license.link; #>
    <# var isActivated = window.EasyTempsData.license.activated; #>
    <# var newDemoRateDate = window.EasyTempsData.new_demo_rang_date; #>

    <div class="elementor-template-library-template-body">
        <div class="elementor-template-library-template-screenshot">
            <div class="elementor-template-library-template-preview">
                <i class="eicon-plus-circle-o"></i>
            </div>
            <img src="{{ thumbnail }}" alt="">
        </div>
        <# if ( newDemoRateDate < date ) { #>
        <span class="bdt-new-item"><?php esc_html_e( 'NEW', 'easy-elements' ); ?></span>
        <# } #>
    </div>
    <div class="elementor-template-library-template-controls">
        <# if ( 1 != is_pro ) { #>
        <button class="elementor-template-library-template-action easy-elements-template-library-template-insert elementor-button elementor-button-success">
            <i class="eicon-file-download"></i>
            <span class="elementor-button-title"><?php esc_html_e( 'Insert', 'easy-elements' ); ?></span>
        </button>
        <# } else { #>
        <# if(isActivated) { #>
        <button class="elementor-template-library-template-action easy-elements-template-library-template-insert elementor-button elementor-button-success">
            <i class="eicon-file-download"></i>
            <span class="elementor-button-title"><?php esc_html_e( 'Insert', 'easy-elements' ); ?></span>
        </button>
        <# } else { #>
        <a class="elementor-template-library-template-action elementor-button easy-elements-template-library-template-go-pro" href="{{ proLink }}" target="_blank">
            <i class="eicon-external-link-square"></i><span class="elementor-button-title"><?php
                esc_html_e( 'Get Access!', 'easy-elements' );
                ?></span>
        </a>
        <# } #>
        <# } #>

    </div>
    <div class="elementor-template-library-template-name">{{ title }}</div>
</script>

<script type="text/html" id="view-easy-elements-template-library-filters">
    <div id="easy-elements-template-library-filters-container"></div>
</script>

<script type="text/html" id="view-easy-elements-template-library-filters-item">
    <label class="easy-elements-template-library-filter-label">
        <input type="radio" value="{{ term_slug }}" <# if ( '' === term_slug ) { #> checked<# } #> name="easy-elements-library-filter">
        <span>{{ term_name }} <span class="ep-category-badge">{{ count }}</span></span>
    </label>
</script>

<script type="text/html"  id="view-easy-elements-template-library-preview">
    <iframe></iframe>
</script>

<script type="text/html"  id="easy-elements-view-template-library-header-back">
    <button type="button" class="easy-elements-template-library-back">
        <i class="dashicons dashicons-arrow-left-alt2"></i>
        <?php esc_html_e( 'Back to Library', 'easy-elements' ); ?>
    </button>
</script>

<script type="text/html" id="view-easy-elements-template-library-insert-button">
    <# if (dependencies != false) { #>
    <div class="ele-tooltip">
        <span class="ele-tooltip-icon ele-required-plugins-list-btn"><span class="dashicons dashicons-editor-help"></span></span>
        <div class="ele-tooltip-wrap">
            <div class="ele-tooltip-inner-wrap">
                <ul class="ele-required-plugins-list">

                </ul>
            </div>
        </div>
    </div>
    <button class="elementor-template-library-template-action easy-elements-template-library-template-insert elementor-button elementor-button-success">
        <i class="eicon-file-download"></i><span class="elementor-button-title"><?php
            esc_html_e('Install Required Plugins & Import', 'easy-elements');
            ?></span>
    </button>
    <# } else { #>
    <button class="elementor-template-library-template-action easy-elements-template-library-template-insert elementor-button elementor-button-success">
        <i class="eicon-file-download"></i><span class="elementor-button-title"><?php
            esc_html_e('Import', 'easy-elements');
            ?></span>
    </button>
    <# } #>
</script>


<script type="text/html"  id="view-easy-elements-template-library-error">
    <div class="elementor-library-error">
        <div class="elementor-library-error-message" style="color:red;"><?php
            esc_html_e( 'Template couldn\'t be loaded. Please activate you license key before.', 'easy-elements' );
            ?></div>
        <div class="elementor-library-error-link"><?php

            ?></div>
    </div>
</script>