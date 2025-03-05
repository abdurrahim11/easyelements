<?php

// Determine the layout class based on the separator layout style
// If the separator layout style is not 'none', then append the appropriate class
$separator_layout_class = ( 'none' !== $settings['separator_layout_style'] ) ? ' ele-step-' . $settings['separator_layout_style'] : '';

?>

<!-- Apply classes based on settings for layout style and separator visibility -->
<div class="ele-step-flow-wrapper <?php echo esc_attr( $separator_layout_class ); ?> ele-step-flow-separator-disable-<?php echo esc_attr( $settings['separator_hide_on'] ); ?>">
    <div class="ele-step-flow-icon">

        <?php
        // Render the step flow icon if it is set
        if ( $settings['step_flow_icon'] ) {
            \Elementor\Icons_Manager::render_icon( $settings['step_flow_icon'], array( 'aria-hidden' => 'true' ) );
        }
        ?>

        <!-- Display the separator if the 'step_flow_separator' setting is 'yes' -->
        <?php if ( 'yes' === $settings['step_flow_separator'] ) { ?>
            <span class="ele-step-flow-<?php echo esc_attr( $settings['separator_layout_style'] ); ?>"></span>
        <?php } ?>

        <!-- Show the badge with the text if 'step_flow_badge_text' is set -->
        <?php if ( $settings['step_flow_badge_text'] ) { ?>
            <span class="ele-step-flow-badge ele-badge ele-badge-<?php echo esc_attr( $settings['badge_position'] ); ?>">
                <?php echo esc_html( $settings['step_flow_badge_text'] ); ?>
            </span>
        <?php } ?>

    </div>
    <div class="ele-step-flow-content">

        <!-- Display the step flow title if it is set -->
        <?php if ( $settings['step_flow_title'] ) { ?>
            <h2 class="ele-step-flow-title"><?php echo esc_html( $settings['step_flow_title'] ); ?></h2>
        <?php } ?>

        <!-- Render the step flow description if it is set -->
        <?php if ( $settings['step_flow_description'] ) { ?>
            <div class="ele-step-flow-description"><?php wp_kses_post( $settings['step_flow_description'] ); ?></div>
        <?php } ?>

    </div>
</div>