<?php

use Elementor\Icons_Manager;

$layout = ( 'none' !== $settings['separator_layout_style'] ) ? ' ele-step-' . $settings['separator_layout_style'] : '';
?>

<!-- Step Flow -->
<div class="ele-step-flow-wrapper <?php echo esc_attr( $layout ); ?> ele-step-flow-separator-disable-<?php echo esc_attr( $settings['separator_hide_on'] ); ?>">
	<div class="ele-step-flow-icon">

		<?php
		if ( $settings['step_flow_icon'] ) {
			ele_render_icon( $settings['step_flow_icon'], array( 'aria-hidden' => 'true' ) );
		}
		?>

		<!-- Separator -->
		<?php if ( 'yes' === $settings['step_flow_separator'] ) { ?>
			<span class="ele-step-flow-<?php echo esc_attr( $settings['separator_layout_style'] ); ?>"></span>
		<?php } ?>

		<!-- Badge -->
		<?php if ( $settings['step_flow_badge_text'] ) { ?>
			<span class="ele-step-flow-badge ele-badge ele-badge-<?php echo esc_attr( $settings['badge_position'] ); ?>">
				<?php echo esc_html( $settings['step_flow_badge_text'] ); ?>
			</span>
		<?php } ?>

	</div>
	<div class="ele-step-flow-content">
		<!-- Title -->
		<?php if ( $settings['step_flow_title'] ) { ?>
			<h2 class="ele-step-flow-title"><?php echo esc_html( $settings['step_flow_title'] ); ?></h2>
		<?php } ?>

		<!-- Description -->
		<?php if ( $settings['step_flow_description'] ) { ?>
			<div class="ele-step-flow-description"><?php ele_kses( $settings['step_flow_description'] ); ?></div>
		<?php } ?>

	</div>
</div>
