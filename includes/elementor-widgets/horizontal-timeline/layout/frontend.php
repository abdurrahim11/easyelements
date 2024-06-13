<?php
use Elementor\Group_Control_Image_Size;
use Elementor\Icons_Manager;
?>
<div class="ele-horizontal-timeline-wrapper<?php echo esc_attr( ( 'yes' === $settings['reverse'] ) ? ' ele-horizontal-timeline-reverse-yes' : '' ); ?> ele-horizontal-timeline-<?php echo esc_attr( $settings['direction'] ); ?>">
	<div class="ele-horizontal-timeline-inner">
		<div id="ele-horizontal-timeline-<?php echo esc_attr( $this->get_id() ); ?>" class="ele-horizontal-timeline owl-carousel ele-owl-theme ele-owl-navigation-horizontal-<?php echo esc_attr( $settings['nav_layout'] ?? 'style-1' ); ?> ele-owl-dots-horizontal-<?php echo esc_attr( $settings['dots_layout'] ?? 'style-1' ); ?>">
			<?php foreach ( $settings['horizontal_timeline_item'] as $i => $item ) : ?>
				<div class="ele-horizontal-timeline-item elementor-repeater-item-<?php echo esc_attr( $item['_id'] ); ?>">
					<div class="ele-horizontal-timeline-date<?php echo esc_attr( ( 'yes' === $settings['reverse'] ) ? ' ele-horiz-equal-height' : '' ); ?>">
						<div class="ele-horiontal-timeline-data-wrap">
							<?php if ( 'image' === $item['date_media_type'] || 'custom' === $item['date_media_type'] ) : ?>
								<div class="ele-horizontal-timeline-dates">
									<!-- Media Type -->
									<?php
									if ( 'image' === $item['date_media_type'] && $item['date_image'] ) {
										echo wp_kses_post( Group_Control_Image_Size::get_attachment_image_html( $item, 'date_image_thumbnail', 'date_image' ) );
									}

									if ( 'custom' === $item['date_media_type'] && $item['title'] && $item['date_custom'] ) {
										?>
										<?php if ( $item['date_custom'] ) : ?>
											<div class="ele-horizontal-timeline-title"><?php ele_kses( $item['title'] ); ?></div>
										<?php endif; ?>
										<?php if ( $item['date_custom'] ) : ?>
											<span class="ele-horizontal-timeline-time"><?php ele_kses( $item['date_custom'] ); ?></span>
										<?php endif; ?>
										<?php
									}
									?>
								</div>
							<?php endif; ?>
						</div>
					</div>

					<div class="ele-horizontal-timeline-media-box">
						<span class="ele-horizontal-timeline-bullet-line"></span>
						<?php if ( 'icon' === $item['bullet_media_type'] || 'image' === $item['bullet_media_type'] || 'custom' === $item['bullet_media_type'] ) : ?>
							<!-- Media Type -->
							<div class="ele-horizontal-timeline-media ele-svg-icon">
								<?php
								if ( 'icon' === $item['bullet_media_type'] && $item['icon'] ) {
									\Elementor\Icons_Manager::render_icon( $item['icon'], array( 'aria-hidden' => 'true' ) );
								}

								if ( 'image' === $item['bullet_media_type'] && $item['image'] ) {
									echo wp_kses_post( Group_Control_Image_Size::get_attachment_image_html( $item, 'bullet_image_thumbnail', 'image' ) );
								}

								if ( 'custom' === $item['bullet_media_type'] && $item['custom'] ) {
									?>
									<span class="ele-horizontal-timeline-media-custom"><?php ele_kses( $item['custom'] ); ?></span>
								<?php } ?>
							</div>
						<?php endif; ?>
					</div>

					<div class="ele-horizontal-timeline-content ele-horiz-equal-height">
						<div class="ele-horizontal-timeline-content-inner">
							<?php if ( 'none' !== $item['content_media_type'] ) : ?>
								<!-- Media Type -->
								<div class="ele-horizontal-timeline-content-media">
									<?php
									if ( 'image' === $item['content_media_type'] && $item['content_image'] ) {
										echo wp_kses_post( Group_Control_Image_Size::get_attachment_image_html( $item, 'content_image_thumbnail', 'content_image' ) );
									}

									?>
								</div>
							<?php endif; ?>

							<div class="ele-horizontal-timeline-content-desc">

								<?php if ( $item['sub_title'] ) : ?>
									<!-- Title -->
									<h2 class="ele-horizontal-timeline-sub-title"><?php echo esc_html( $item['sub_title'] ); ?></h2>
								<?php endif; ?>

								<?php if ( $item['description'] ) : ?>
									<p class="ele-horizontal-timeline-text"><?php echo wp_kses_post( $item['description'] ); ?></p>
								<?php endif; ?>

							</div>
						</div>
					</div>
				</div>
			<?php endforeach; ?>
		</div>
	</div>
</div>
