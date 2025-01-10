<?php

use Elementor\Group_Control_Image_Size;
use Elementor\Icons_Manager;

// Prepare button attributes based on settings
$button_attributes  = ( $settings['button_css_id'] ) ? ' id="' . $settings['button_css_id'] . '"' : '';
$button_attributes .= $settings['button_link']['is_external'] ? ' target="_blank"' : '';
$button_attributes .= $settings['button_link']['nofollow'] ? ' rel="nofollow"' : '';
$button_attributes .= $settings['button_link']['url'] ? ' href="' . esc_url ( $settings['button_link']['url'] ) . '"' : '';
$button_attributes .= ( $settings['onclick_event'] ) ? ' onclick="' . $settings['onclick_event'] . '"' : '';

if ( $settings['button_link']['custom_attributes'] ) {
    // Split custom attributes and add them to button attributes
    $custom_attributes = explode( ',', $settings['button_link']['custom_attributes'] );

    foreach ( $custom_attributes as $attribute ) {
        if ( ! empty( $attribute ) ) {
            $attribute_parts = explode( '|', $attribute, 2 );
            if ( ! isset( $attribute_parts[1] ) ) {
                $attribute_parts[1] = '';
            }
            $button_attributes .= ' ' . $attribute_parts[0] . '="' . $attribute_parts[1] . '"';
        }
    }
}
?>

<div class="ele-pricing-item">

    <?php
    // Display badge if enabled and text is provided
    if ( 'yes' === $settings['show_badge'] && ! empty( $settings['badge_text'] ) ) { ?>
        <span class="ele-badge ele-badge-<?php echo esc_attr( $settings['badge_position'] ); ?>">
            <?php echo esc_html( $settings['badge_text'] ); ?>
        </span>
    <?php } ?>

    <?php
    // Display media (icon or image) before header if position is set
    if ( 'before_header' === $settings['media_position'] ) {
        if ( 'icon' === $settings['media_type'] && $settings['icon']['value'] ) { ?>
            <div class="ele-pricing-icon">
                <?php \Elementor\Icons_Manager::render_icon( $settings['icon'], array( 'aria-hidden' => 'true' ) ); ?>
            </div>
        <?php }
        if ( 'image' === $settings['media_type'] && $settings['image']['url'] ) { ?>
            <div class="ele-pricing-media">
                <?php echo wp_kses_post( Group_Control_Image_Size::get_attachment_image_html( $settings, 'media_thumbnail', 'image' ) ); ?>
            </div>
        <?php }
    } ?>

    <?php
    // Display title if provided
    if ( ! empty( $settings['title'] ) ) { ?>
        <div class="ele-pricing-title-wrapper">
            <h2 class="ele-pricing-title"><?php echo esc_html( $settings['title'] ); ?></h2>
        </div>
    <?php } ?>

    <?php
    // Display media (icon or image) after header if position is set
    if ( 'after_header' === $settings['media_position'] ) {
        if ( 'icon' === $settings['media_type'] && $settings['icon']['value'] ) { ?>
            <div class="ele-pricing-icon">
                <?php \Elementor\Icons_Manager::render_icon( $settings['icon'], array( 'aria-hidden' => 'true' ) ); ?>
            </div>
        <?php }
        if ( 'image' === $settings['media_type'] && $settings['image']['url'] ) { ?>
            <div class="ele-pricing-media">
                <?php echo wp_kses_post( Group_Control_Image_Size::get_attachment_image_html( $settings, 'media_thumbnail', 'image' ) ); ?>
            </div>
        <?php }
    } ?>

    <?php
    // Display price before features if position is set
    if ( 'before_features' === $settings['price_position'] ) { ?>
        <div class="ele-pricing-price-box ele-pricing-price-box-style-<?php echo esc_attr( $settings['price_style'] ); ?>">
            <div class="ele-pricing-price-tag">
                <span class="ele-pricing-currency">
                    <?php echo( ( 'none' !== $settings['currency'] ) ? self::get_currency_symbol_by_name( $settings['currency'] ) : esc_html( $settings['currency_custom'] ) ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
                </span>
                <span class="ele-pricing-price">
                    <?php echo esc_html( $settings['price'] ); ?>
                </span>
            </div>

            <?php
            // Display period if provided
            if ( ! empty( $settings['period'] ) ) { ?>
                <p class="ele-pricing-price-period"><?php echo esc_html( $settings['period'] ); ?></p>
            <?php } ?>

        </div>
    <?php } ?>

    <?php
    // Display description before features if position is set
    if ( 'before_features' === $settings['description_position'] && $settings['item_description'] ) { ?>
        <div class="ele-pricing-description-wrapper">
            <div class="ele-pricing-description">
                <?php echo wp_kses_post( $settings['item_description'] ); ?>
            </div>
        </div>
    <?php } ?>

    <?php
    // Display button before features if position is set and title is provided
    if ( 'before_features' === $settings['button_position'] && $settings['button_title'] ) { ?>
        <div class="ele-pricing-btn-wrapper">
            <a class="ele-pricing-btn" <?php echo $button_attributes; ?>>
                <?php echo esc_html( $settings['button_title'] ); ?>
            </a>
        </div>
    <?php } ?>

    <?php
    // Display features if enabled
    if ( 'yes' === $settings['show_feature'] ) { ?>
        <div class="ele-pricing-features">

            <?php
            // Display features title if provided
            if ( ! empty( $settings['features_title'] ) ) { ?>
                <h4 class="ele-pricing-features-title"><?php echo esc_html( $settings['features_title'] ); ?></h4>
            <?php } ?>

            <ul class="ele-pricing-features-list">
                <?php
                // Loop through feature items and display each
                foreach ( $settings['feature_items'] as $i => $feature_item ) { ?>
                    <li class="<?php echo esc_attr( $feature_item['status'] ); ?>">

                        <?php
                        // Display feature icon if provided
                        if ( $feature_item['icon'] ) { ?>
                            <span class="ele-pricing-feature-icon">
                                <?php \Elementor\Icons_Manager::render_icon( $feature_item['icon'], array( 'aria-hidden' => 'true' ) ); ?>
                            </span>
                        <?php } ?>

                        <?php
                        // Display feature title and tooltip if provided
                        if ( $feature_item['title_text'] ) { ?>
                            <span class="ele-pricing-feature-title">
                                <?php echo esc_html( $feature_item['title_text'] ); ?>
                                <?php if ( $feature_item['tooltip_text'] ) { ?>
                                    <i class="ele ele-alert-triangle ele-pricing-tooltip-toggle">
                                    <span class="ele-pricing-tooltip">
                                        <?php echo wp_kses_post( $feature_item['tooltip_text'] ); ?>
                                    </span>
                                    </i>
                                <?php } ?>
                            </span>
                        <?php } ?>

                    </li>
                <?php } ?>
            </ul>

        </div>
    <?php } ?>

    <?php
    // Display description after features if position is set
    if ( 'after_features' === $settings['description_position'] && $settings['item_description'] ) { ?>
        <div class="ele-pricing-description-wrapper">
            <div class="ele-pricing-description">
                <?php echo wp_kses_post( $settings['item_description'] ); ?>
            </div>
        </div>
    <?php } ?>

    <?php
    // Display separator if enabled
    if ( 'yes' === $settings['show_separator'] ) { ?>
        <div class="ele-pricing-separator"></div>
    <?php } ?>

    <?php
    // Display price after features if position is set
    if ( 'after_features' === $settings['price_position'] ) { ?>
        <div class="ele-pricing-price-box ele-pricing-price-box-style-<?php echo esc_attr( $settings['price_style'] ); ?>">
            <div class="ele-pricing-price-tag">
                <span class="ele-pricing-currency">
                    <?php echo( ( 'none' !== $settings['currency'] ) ? self::get_currency_symbol_by_name( $settings['currency'] ) : esc_html( $settings['currency_custom'] ) );  // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
                </span>
                <span class="ele-pricing-price">
                    <?php echo esc_html( $settings['price'] ); ?>
                </span>
            </div>

            <?php
            // Display period if provided
            if ( ! empty( $settings['period'] ) ) { ?>
                <p class="ele-pricing-price-period"><?php echo esc_html( $settings['period'] ); ?></p>
            <?php } ?>

        </div>
    <?php } ?>

    <?php
    // Display button after features if position is set and title is provided
    if ( 'after_features' === $settings['button_position'] && $settings['button_title'] ) { ?>
        <div class="ele-pricing-btn-wrapper">
            <a class="ele-pricing-btn" <?php echo $button_attributes; ?>>
                <?php echo esc_html( $settings['button_title'] ); ?>
            </a>
        </div>
    <?php } ?>
</div>