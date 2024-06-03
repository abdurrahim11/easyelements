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
			<?php ele_render_icon( $settings['quote_icon'], array( 'aria-hidden' => 'true' ) ); ?>
		</span>
	<?php endif; ?>

	<?php if ( 'none' !== $settings['ratting_style'] && ( '2' === $settings['layout'] || '6' === $settings['layout'] || '10' === $settings['layout'] ) ) { ?>
		<div class="ele-testimonial-rating ele-rating-layout-<?php echo esc_attr( $settings['ratting_style'] ); ?>">
			<?php
			if ( 'num' === $settings['ratting_style'] ) {
				echo esc_html( $settings['ratting']['size'] ) . '<i class="fas fa-star" aria-hidden="true"></i>';
			} else {
				for ( $x = 1; $x <= 5; $x ++ ) {
					if ( $x <= $settings['ratting']['size'] ) {
						echo '<i class="fas fa-star ele-rating-filled" aria-hidden="true"></i>';
					} else {
						echo '<i class="fas fa-star" aria-hidden="true"></i>';
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
				echo esc_html( $settings['ratting']['size'] ) . '<i class="fas fa-star" aria-hidden="true"></i>';
			} else {
				for ( $x = 1; $x <= 5; $x ++ ) {
					if ( $x <= $settings['ratting']['size'] ) {
						echo '<i class="fas fa-star ele-rating-filled" aria-hidden="true"></i>';
					} else {
						echo '<i class="fas fa-star" aria-hidden="true"></i>';
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
					echo '<i class="fas fa-star ele-rating-filled" aria-hidden="true"></i>';
				} else {
					echo '<i class="fas fa-star" aria-hidden="true"></i>';
				}
			}
		}
		?>

	</div>
<?php } ?>
</div>
<?php echo ( '4' === $settings['layout'] || '5' === $settings['layout'] || '6' === $settings['layout'] ) ? '</div>' : ''; ?>
