<div class="ele-modal" id="ele-mega-menu-modal">
    <div class="ele-modal-content">
        <div class="ele-modal-header">
            <div class="ele-modal-header-left">
                <img src="<?php echo ELE_ADMIN_ASSETS_UR .'images/logo.gif'; ?>" alt="Easy Elements" class="ele-modal-header-logo">
                <span>Mega Menu</span>
            </div>
            <span class="ele-modal-close" data-dismiss="modal">&times;</span>
        </div>
        <div class="ele-modal-body">
            <div class="ele-table-option-wrapper">

                <!-- Enable Mega Menu -->
                <div class="ele-option-row">
                    <strong class="ele-option-label"><?php esc_html_e( 'Enable Mega Menu', 'easy-elements' ); ?></strong>
                    <div class="ele-option-control">
                        <div class="ele-setting-switcher">
                            <input type="checkbox" value="1" id="easyelements-menu-item-enable" />
                            <label for="easyelements-menu-item-enable"></label>
                        </div>
                    </div>
                </div>

                <!-- Mega Menu Content -->
                <div class="ele-option-row">
                    <strong class="ele-option-label"><?php esc_html_e( 'Mega Menu Content', 'easy-elements' ); ?></strong>
                    <div class="ele-option-control">
                        <?php if ( defined( 'ELEMENTOR_VERSION' ) ) : ?>
                        <button disabled type="button" id="easyelements-menu-builder-trigger" class="easyelements-menu-elementor-button button" data-attr-toggle="modal" data-target="#ele-menu-builder-modal">
                            <img src="<?php echo esc_url( ELE_PLUGIN_URL  ); ?>includes/modules/mega-menu/assets/images/elementor-icon.png" alt="easyelements megamenu" />
                            <?php esc_html_e( 'Edit with Elementor', 'easy-elements' ); ?>
                        </button>
                        <?php else : ?>
                            <p class="ele-no-elementor-notice">
                                <?php esc_html_e( 'This plugin requires Elementor page builder to edt megamenu items content', 'easy-elements' ); ?>
                            </p>
                        <?php endif; ?>
                    </div>
                </div>

                <!-- Use mobile submenu as -->
                <div class="ele-option-row">
                    <strong class="ele-option-label"><?php esc_html_e( 'Use mobile submenu as', 'easy-elements' ); ?></strong>
                    <div class="ele-option-control">
                        <select name="content_type" id="ele-mobile-submenu-content-type" class="ele-select">
                            <option value="builder_content" selected><?php esc_html_e( 'Builder content', 'easy-elements' ); ?></option>
                            <option value="submenu_list"><?php esc_html_e( 'WP submenu list', 'easy-elements' ); ?></option>
                        </select>
                    </div>
                </div>

                <!-- Mega Menu Width as -->
                <div class="ele-option-row">
                    <strong class="ele-option-label"><?php esc_html_e( 'Mega Menu Width as:', 'easy-elements' ); ?></strong>
                    <div class="ele-option-control">
                        <select name="width_type"  id="ele-megamenu-width-type" class="ele-select">
                            <option value="default_width" selected><?php esc_html_e( 'Default Width', 'easy-elements' ); ?></option>
                            <option value="full_width"><?php esc_html_e( 'Full Width', 'easy-elements' ); ?></option>
                            <option value="custom_width"><?php esc_html_e( 'Custom Width', 'easy-elements' ); ?></option>
                        </select>
                    </div>
                </div>

                <!-- Menu Width -->
                <div class="ele-option-row ele-menu-width-container is_disabled">
                    <strong class="ele-option-label"><?php esc_html_e( 'Menu Width', 'easy-elements' ); ?></strong>
                    <div class="ele-option-control">
                        <input type="text" placeholder="<?php esc_html_e( '750px', 'easy-elements' ); ?>" id="easyelements-menu-vertical-menu-width-field" />
                    </div>
                </div>

                <!-- Mega Menu Position as -->
                <div class="ele-option-row">
                    <strong class="ele-option-label"><?php esc_html_e( 'Mega Menu Position as:', 'easy-elements' ); ?></strong>
                    <div class="ele-option-control">
                        <select name="position_type" id="ele-vertical-megamenu-position-type" class="ele-select">
                            <option value="top_position" selected><?php esc_html_e( 'Default', 'easy-elements' ); ?></option>
                            <option value="relative_position"><?php esc_html_e( 'Relative', 'easy-elements' ); ?></option>
                        </select>
                    </div>
                </div>

                <!-- Enable Ajax Load -->
                <div class="ele-option-row">
                    <strong class="ele-option-label"><?php esc_html_e( 'Enable Ajax Load:', 'easy-elements' ); ?></strong>
                    <div class="ele-option-control">
                        <select name="megamenu_ajax_load" id="ele-enable-ajax-load" class="ele-select">
                            <option value="no" selected><?php esc_html_e( 'No', 'easy-elements' ); ?></option>
                            <option value="yes"><?php esc_html_e( 'Yes', 'easy-elements' ); ?></option>
                        </select>
                    </div>
                </div>

                <!-- Select icon -->
                <div class="ele-option-row">
                    <strong class="ele-option-label"><?php esc_html_e( 'Select icon', 'easy-elements' ); ?></strong>
                    <div class="ele-option-control">
                        <div class="ele-picker-wrap" id="ele-picker-wrap">
                            <ul class="ele-picker">
                                <li class="icon-none" title="None"><i class="fas fa-ban"></i></li>
                                <li id='ele-select-icon' class="ele-select-icon" title="Icon Library"><i class="fas fa-circle"></i></li>
                                <input type="hidden" name="icon_value" id="easyelements-menu-icon-field"  value="">
                            </ul>
                        </div>
                    </div>
                </div>

                <!-- Choose icon color -->
                <div class="ele-option-row">
                    <strong class="ele-option-label"><?php esc_html_e( 'Choose icon color', 'easy-elements' ); ?></strong>
                    <div class="ele-option-control">
                        <input type="text" value="#bada55" class="easyelements-menu-wpcolor-picker" id="easyelements-menu-icon-color-field" />
                    </div>
                </div>

                <!-- Badge text -->
                <div class="ele-option-row">
                    <strong class="ele-option-label"><?php esc_html_e( 'Badge text', 'easy-elements' ); ?></strong>
                    <div class="ele-option-control">
                        <input type="text" placeholder="<?php esc_html_e( 'Badge Text', 'easy-elements' ); ?>" id="easyelements-menu-badge-text-field" />
                    </div>
                </div>

                <!-- Choose badge color -->
                <div class="ele-option-row">
                    <strong class="ele-option-label"><?php esc_html_e( 'Choose badge color', 'easy-elements' ); ?></strong>
                    <div class="ele-option-control">
                        <input type="text" class="easyelements-menu-wpcolor-picker" value="#ffffff" id="easyelements-menu-badge-color-field" />
                    </div>
                </div>

                <!-- Choose badge background -->
                <div class="ele-option-row">
                    <strong class="ele-option-label"><?php esc_html_e( 'Choose badge background', 'easy-elements' ); ?></strong>
                    <div class="ele-option-control">
                        <input type="text" class="easyelements-menu-wpcolor-picker" value="#bada55" id="easyelements-menu-badge-background-field" />
                    </div>
                </div>

            </div>

        </div>
        <div class="ele-modal-footer">
            <input type="hidden" id="easyelements-menu-modal-menu-id">
            <input type="hidden" id="easyelements-menu-modal-menu-has-child">
            <span class='spinner'></span>
            <?php echo wp_kses( get_submit_button( esc_html__( 'Save', 'easy-elements' ), 'easyelements-menu-item-save button-primary ele-table-align-right', '', false ), ['input'=>['class'=>[], 'type'=>[], 'value'=>[]]] ); ?>
        </div>
    </div>
</div>

<div class="ele-modal" id="ele-menu-builder-modal">
    <div class="ele-modal-content">
        <div class="ele-close-area">
            <span class="ele-modal-close" data-dismiss="modal">&times;</span>
        </div>
        <iframe id="easyelements-menu-builder-iframe" src="" frameborder="0"></iframe>
    </div>
</div>
