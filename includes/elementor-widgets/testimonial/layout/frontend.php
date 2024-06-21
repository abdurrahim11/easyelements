<?php
$title_tag   = ( $settings['name_link']['url'] ) ? 'a' : 'h3';
$title_attr  = $settings['name_link']['is_external'] ? ' target="_blank"' : '';
$title_attr .= $settings['name_link']['nofollow'] ? ' rel="nofollow"' : '';
$title_attr .= $settings['name_link']['url'] ? ' href="' . esc_url( $settings['name_link']['url'] ) . '"' : '';
?>

<?php if ( '4' === $settings['layout'] || '5' === $settings['layout'] || '10' === $settings['layout'] ) { ?>
	<?php if ( $settings['image']['id'] || $settings['image']['url'] ) : ?>
		<div class="ele-testimonial-image">
			<?php
			$image_markup = ( ! empty( $settings['image']['id'] ) ) ? wp_get_attachment_image( $settings['image']['id'], $settings['thumbnail_size'] ) : '';
			echo ! empty( $image_markup ) ? $image_markup : '<img src="' . esc_url( $settings['image']['url'] ) . '">';
			?>
		</div>
	<?php endif; ?>
<?php } ?>

<?php echo ( '4' === $settings['layout'] || '5' === $settings['layout'] || '6' === $settings['layout'] ) ? '<div class="ele-testimonial-inner-wrapper">' : ''; ?>
<div class="ele-testimonial-content">

	<?php if ( 'yes' === $settings['show_quote'] && $settings['quote_icon']['value'] && '6' !== $settings['layout'] && '9' !== $settings['layout'] && '10' !== $settings['layout'] ) : ?>
		<span class="ele-testimonial-quote">
			<?php \Elementor\Icons_Manager::render_icon( $settings['quote_icon'], array( 'aria-hidden' => 'true' ) ); ?>
		</span>
	<?php endif; ?>

	<?php if ( 'none' !== $settings['ratting_style'] && ( '2' === $settings['layout'] || '6' === $settings['layout'] || '10' === $settings['layout'] ) ) { ?>
		<div class="ele-testimonial-rating ele-rating-layout-<?php echo esc_attr( $settings['ratting_style'] ); ?>">
			<?php
			if ( 'num' === $settings['ratting_style'] ) {
				echo esc_html( $settings['ratting']['size'] ) . '<svg aria-hidden="true" class="fill e-font-icon-svg e-far-star" viewBox="0 0 576 512" xmlns="http://www.w3.org/2000/svg"><path d="M528.1 171.5L382 150.2 316.7 17.8c-11.7-23.6-45.6-23.9-57.4 0L194 150.2 47.9 171.5c-26.2 3.8-36.7 36.1-17.7 54.6l105.7 103-25 145.5c-4.5 26.3 23.2 46 46.4 33.7L288 439.6l130.7 68.7c23.2 12.2 50.9-7.4 46.4-33.7l-25-145.5 105.7-103c19-18.5 8.5-50.8-17.7-54.6zM388.6 312.3l23.7 138.4L288 385.4l-124.3 65.3 23.7-138.4-100.6-98 139-20.2 62.2-126 62.2 126 139 20.2-100.6 98z"></path></svg>';
			} else {
				for ( $x = 1; $x <= 5; $x ++ ) {
					if ( $x <= $settings['ratting']['size'] ) {
						echo '<svg class="fill" aria-hidden="true" class="e-font-icon-svg e-fas-star" viewBox="0 0 576 512" xmlns="http://www.w3.org/2000/svg"><path d="M259.3 17.8L194 150.2 47.9 171.5c-26.2 3.8-36.7 36.1-17.7 54.6l105.7 103-25 145.5c-4.5 26.3 23.2 46 46.4 33.7L288 439.6l130.7 68.7c23.2 12.2 50.9-7.4 46.4-33.7l-25-145.5 105.7-103c19-18.5 8.5-50.8-17.7-54.6L382 150.2 316.7 17.8c-11.7-23.6-45.6-23.9-57.4 0z"></path></svg>';
					} else {
						echo '<svg aria-hidden="true" class="e-font-icon-svg e-far-star" viewBox="0 0 576 512" xmlns="http://www.w3.org/2000/svg"><path d="M528.1 171.5L382 150.2 316.7 17.8c-11.7-23.6-45.6-23.9-57.4 0L194 150.2 47.9 171.5c-26.2 3.8-36.7 36.1-17.7 54.6l105.7 103-25 145.5c-4.5 26.3 23.2 46 46.4 33.7L288 439.6l130.7 68.7c23.2 12.2 50.9-7.4 46.4-33.7l-25-145.5 105.7-103c19-18.5 8.5-50.8-17.7-54.6zM388.6 312.3l23.7 138.4L288 385.4l-124.3 65.3 23.7-138.4-100.6-98 139-20.2 62.2-126 62.2 126 139 20.2-100.6 98z"></path></svg>';
					}
				}
			}
			?>

		</div>
	<?php } ?>

	<?php if ( $settings['description'] ) : ?>
		<div class="ele-testimonial-description">
			<?php ele_kses( $settings['description'] ); ?>
		</div>
	<?php endif; ?>

	<?php if ( 'none' !== $settings['ratting_style'] && ( '1' === $settings['layout'] || '3' === $settings['layout'] || '7' === $settings['layout'] || '8' === $settings['layout'] || '9' === $settings['layout'] ) ) { ?>
		<div class="ele-testimonial-rating ele-rating-layout-<?php echo esc_attr( $settings['ratting_style'] ); ?>">
			<?php
			if ( 'num' === $settings['ratting_style'] ) {
				echo esc_html( $settings['ratting']['size'] ) . ' <svg aria-hidden="true" class="fill e-font-icon-svg e-far-star" viewBox="0 0 576 512" xmlns="http://www.w3.org/2000/svg"><path d="M528.1 171.5L382 150.2 316.7 17.8c-11.7-23.6-45.6-23.9-57.4 0L194 150.2 47.9 171.5c-26.2 3.8-36.7 36.1-17.7 54.6l105.7 103-25 145.5c-4.5 26.3 23.2 46 46.4 33.7L288 439.6l130.7 68.7c23.2 12.2 50.9-7.4 46.4-33.7l-25-145.5 105.7-103c19-18.5 8.5-50.8-17.7-54.6zM388.6 312.3l23.7 138.4L288 385.4l-124.3 65.3 23.7-138.4-100.6-98 139-20.2 62.2-126 62.2 126 139 20.2-100.6 98z"></path></svg>';
			} else {
				for ( $x = 1; $x <= 5; $x ++ ) {
					if ( $x <= $settings['ratting']['size'] ) {
						echo '<svg class="fill" aria-hidden="true" class="e-font-icon-svg e-fas-star" viewBox="0 0 576 512" xmlns="http://www.w3.org/2000/svg"><path d="M259.3 17.8L194 150.2 47.9 171.5c-26.2 3.8-36.7 36.1-17.7 54.6l105.7 103-25 145.5c-4.5 26.3 23.2 46 46.4 33.7L288 439.6l130.7 68.7c23.2 12.2 50.9-7.4 46.4-33.7l-25-145.5 105.7-103c19-18.5 8.5-50.8-17.7-54.6L382 150.2 316.7 17.8c-11.7-23.6-45.6-23.9-57.4 0z"></path></svg>';
					} else {
						echo '<svg aria-hidden="true" class="e-font-icon-svg e-far-star" viewBox="0 0 576 512" xmlns="http://www.w3.org/2000/svg"><path d="M528.1 171.5L382 150.2 316.7 17.8c-11.7-23.6-45.6-23.9-57.4 0L194 150.2 47.9 171.5c-26.2 3.8-36.7 36.1-17.7 54.6l105.7 103-25 145.5c-4.5 26.3 23.2 46 46.4 33.7L288 439.6l130.7 68.7c23.2 12.2 50.9-7.4 46.4-33.7l-25-145.5 105.7-103c19-18.5 8.5-50.8-17.7-54.6zM388.6 312.3l23.7 138.4L288 385.4l-124.3 65.3 23.7-138.4-100.6-98 139-20.2 62.2-126 62.2 126 139 20.2-100.6 98z"></path></svg>';
					}
				}
			}
			?>

		</div>
	<?php } ?>
</div>
<div class="ele-testimonial-author">
	<?php if ( '4' !== $settings['layout'] && '5' !== $settings['layout'] && '10' !== $settings['layout'] ) { ?>
		<?php if ( $settings['image']['id'] || $settings['image']['url'] ) : ?>
			<div class="ele-testimonial-image">
				<?php
				$image_markup = ( ! empty( $settings['image']['id'] ) ) ? wp_get_attachment_image( $settings['image']['id'], $settings['thumbnail_size'] ) : '';
				echo ! empty( $image_markup ) ? $image_markup : '<img src="' . esc_url( $settings['image']['url'] ) . '">';
				?>
			</div>
		<?php endif; ?>
	<?php } ?>
	<?php if ( $settings['name'] || $settings['designation'] ) { ?>
	<div class="ele-testimonial-author-bio">
		<?php if ( $settings['name'] ) : ?>
		<<?php echo esc_attr( $title_tag ); ?><?php ele_kses( $title_attr ); ?>
		class="ele-testimonial-title"><?php echo esc_attr( $settings['name'] ); ?></<?php echo esc_attr( $title_tag ); ?>>
<?php endif; ?>
		<?php if ( $settings['designation'] ) : ?>
		<h4 class="ele-testimonial-designation"><?php echo esc_attr( $settings['designation'] ); ?></h4>
	<?php endif; ?>
</div>
<?php } ?>
<?php if ( 'none' !== $settings['ratting_style'] && ('4' === $settings['layout'] || '5' === $settings['layout'] ) ) { ?>
	<div class="ele-testimonial-rating ele-rating-layout-<?php echo esc_attr( $settings['ratting_style'] ); ?>">
		<?php
		if ( 'num' === $settings['ratting_style'] ) {
			echo esc_html( $settings['ratting']['size'] ) . '<i class="fas fa-star" aria-hidden="true"></i>';
		} else {
			for ( $x = 1; $x <= 5; $x ++ ) {
				if ( $x <= $settings['ratting']['size'] ) {
					echo '<svg aria-hidden="true" class="fill e-font-icon-svg e-fas-star" viewBox="0 0 576 512" xmlns="http://www.w3.org/2000/svg"><path d="M259.3 17.8L194 150.2 47.9 171.5c-26.2 3.8-36.7 36.1-17.7 54.6l105.7 103-25 145.5c-4.5 26.3 23.2 46 46.4 33.7L288 439.6l130.7 68.7c23.2 12.2 50.9-7.4 46.4-33.7l-25-145.5 105.7-103c19-18.5 8.5-50.8-17.7-54.6L382 150.2 316.7 17.8c-11.7-23.6-45.6-23.9-57.4 0z"></path></svg>';
				} else {
					echo '<svg aria-hidden="true" class="e-font-icon-svg e-far-star" viewBox="0 0 576 512" xmlns="http://www.w3.org/2000/svg"><path d="M528.1 171.5L382 150.2 316.7 17.8c-11.7-23.6-45.6-23.9-57.4 0L194 150.2 47.9 171.5c-26.2 3.8-36.7 36.1-17.7 54.6l105.7 103-25 145.5c-4.5 26.3 23.2 46 46.4 33.7L288 439.6l130.7 68.7c23.2 12.2 50.9-7.4 46.4-33.7l-25-145.5 105.7-103c19-18.5 8.5-50.8-17.7-54.6zM388.6 312.3l23.7 138.4L288 385.4l-124.3 65.3 23.7-138.4-100.6-98 139-20.2 62.2-126 62.2 126 139 20.2-100.6 98z"></path></svg>';
				}
			}
		}
		?>

	</div>
<?php } ?>
</div>
<?php echo ( '4' === $settings['layout'] || '5' === $settings['layout'] || '6' === $settings['layout'] ) ? '</div>' : ''; ?>
