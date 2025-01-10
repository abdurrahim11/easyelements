<?php
// Determine the HTML tag to use for the title based on whether a URL is provided
$title_tag = ( $settings['name_link']['url'] ) ? 'a' : 'h3';

// Initialize title attributes string and append attributes if conditions are met
$title_attributes  = $settings['name_link']['is_external'] ? ' target="_blank"' : '';
$title_attributes .= $settings['name_link']['nofollow'] ? ' rel="nofollow"' : '';
$title_attributes .= $settings['name_link']['url'] ? ' href="' . esc_url( $settings['name_link']['url'] ) . '"' : '';
?>

<?php
// Check if the layout is 4, 5, or 10
if ( '4' === $settings['layout'] || '5' === $settings['layout'] || '10' === $settings['layout'] ) {
    // Check if an image is provided
    if ( $settings['image']['id'] || $settings['image']['url'] ) : ?>
        <div class="ele-testimonial-image">
            <?php
            // Get image markup based on attachment ID or URL
            $image_markup = ( ! empty( $settings['image']['id'] ) ) ? wp_get_attachment_image( $settings['image']['id'], $settings['thumbnail_size'] ) : '';
            // Display the image
            echo ! empty( $image_markup ) ? $image_markup : '<img src="' . esc_url( $settings['image']['url'] ) . '">';
            ?>
        </div>
    <?php endif; ?>
<?php } ?>

<?php
// Open a wrapper div if the layout is 4, 5, or 6
echo ( '4' === $settings['layout'] || '5' === $settings['layout'] || '6' === $settings['layout'] ) ? '<div class="ele-testimonial-inner-wrapper">' : ''; ?>
    <div class="ele-testimonial-content">

        <?php
        // Display a quote icon if required conditions are met
        if ( 'yes' === $settings['show_quote'] && $settings['quote_icon']['value'] && '6' !== $settings['layout'] && '9' !== $settings['layout'] && '10' !== $settings['layout'] ) : ?>
            <span class="ele-testimonial-quote">
                <?php \Elementor\Icons_Manager::render_icon( $settings['quote_icon'], array( 'aria-hidden' => 'true' ) ); ?>
            </span>
        <?php endif; ?>

        <?php
        // Display rating if rating style is not 'none' and layout is 2, 6, or 10
        if ( 'none' !== $settings['rating_style'] && ( '2' === $settings['layout'] || '6' === $settings['layout'] || '10' === $settings['layout'] ) ) { ?>
            <div class="ele-testimonial-rating ele-rating-layout-<?php echo esc_attr( $settings['rating_style'] ); ?>">
                <?php
                // Check if rating style is numeric
                if ( 'num' === $settings['rating_style'] ) {
                    echo esc_html( $settings['rating']['size'] ) . '<svg aria-hidden="true" class="fill e-font-icon-svg e-far-star" viewBox="0 0 576 512" xmlns="http://www.w3.org/2000/svg"><path d="M528.1 171.5L382 150.2 316.7 17.8c-11.7-23.6-45.6-23.9-57.4 0L194 150.2 47.9 171.5c-26.2 3.8-36.7 36.1-17.7 54.6l105.7 103-25 145.5c-4.5 26.3 23.2 46 46.4 33.7L288 439.6l130.7 68.7c23.2 12.2 50.9-7.4 46.4-33.7l-25-145.5 105.7-103c19-18.5 8.5-50.8-17.7-54.6zM388.6 312.3l23.7 138.4L288 385.4l-124.3 65.3 23.7-138.4-100.6-98 139-20.2 62.2-126 62.2 126 139 20.2-100.6 98z"></path></svg>';
                } else {
                    // Display star icons based on rating size
                    for ( $index = 1; $index <= 5; $index ++ ) {
                        if ( $index <= $settings['rating']['size'] ) {
                            echo '<svg aria-hidden="true" class="fill e-font-icon-svg e-fas-star" viewBox="0 0 576 512" xmlns="http://www.w3.org/2000/svg"><path d="M259.3 17.8L194 150.2 47.9 171.5c-26.2 3.8-36.7 36.1-17.7 54.6l105.7 103-25 145.5c-4.5 26.3 23.2 46 46.4 33.7L288 439.6l130.7 68.7c23.2 12.2 50.9-7.4 46.4-33.7l-25-145.5 105.7-103c19-18.5 8.5-50.8-17.7-54.6L382 150.2 316.7 17.8c-11.7-23.6-45.6-23.9-57.4 0z"></path></svg>';
                        } else {
                            echo '<svg aria-hidden="true" class="e-font-icon-svg e-far-star" viewBox="0 0 576 512" xmlns="http://www.w3.org/2000/svg"><path d="M528.1 171.5L382 150.2 316.7 17.8c-11.7-23.6-45.6-23.9-57.4 0L194 150.2 47.9 171.5c-26.2 3.8-36.7 36.1-17.7 54.6l105.7 103-25 145.5c-4.5 26.3 23.2 46 46.4 33.7L288 439.6l130.7 68.7c23.2 12.2 50.9-7.4 46.4-33.7l-25-145.5 105.7-103c19-18.5 8.5-50.8-17.7-54.6zM388.6 312.3l23.7 138.4L288 385.4l-124.3 65.3 23.7-138.4-100.6-98 139-20.2 62.2-126 62.2 126 139 20.2-100.6 98z"></path></svg>';
                        }
                    }
                }
                ?>
            </div>
        <?php } ?>

        <?php
        // Display description if available
        if ( $settings['description'] ) : ?>
            <div class="ele-testimonial-description">
                <?php ele_kses( $settings['description'] ); ?>
            </div>
        <?php endif; ?>

        <?php
        // Display rating if rating style is not 'none' and layout is 1, 3, 7, 8, or 9
        if ( 'none' !== $settings['rating_style'] && ( '1' === $settings['layout'] || '3' === $settings['layout'] || '7' === $settings['layout'] || '8' === $settings['layout'] || '9' === $settings['layout'] ) ) { ?>
            <div class="ele-testimonial-rating ele-rating-layout-<?php echo esc_attr( $settings['rating_style'] ); ?>">
                <?php
                // Check if rating style is numeric
                if ( 'num' === $settings['rating_style'] ) {
                    echo esc_html( $settings['rating']['size'] ) . ' <svg aria-hidden="true" class="fill e-font-icon-svg e-far-star" viewBox="0 0 576 512" xmlns="http://www.w3.org/2000/svg"><path d="M528.1 171.5L382 150.2 316.7 17.8c-11.7-23.6-45.6-23.9-57.4 0L194 150.2 47.9 171.5c-26.2 3.8-36.7 36.1-17.7 54.6l105.7 103-25 145.5c-4.5 26.3 23.2 46 46.4 33.7L288 439.6l130.7 68.7c23.2 12.2 50.9-7.4 46.4-33.7l-25-145.5 105.7-103c19-18.5 8.5-50.8-17.7-54.6zM388.6 312.3l23.7 138.4L288 385.4l-124.3 65.3 23.7-138.4-100.6-98 139-20.2 62.2-126 62.2 126 139 20.2-100.6 98z"></path></svg>';
                } else {
                    // Display star icons based on rating size
                    for ( $index = 1; $index <= 5; $index ++ ) {
                        if ( $index <= $settings['rating']['size'] ) {
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
<?php
// Check if the layout is not 4, 5, or 10
if ( '4' !== $settings['layout'] && '5' !== $settings['layout'] && '10' !== $settings['layout'] ) {
    // Check if an image is provided
    if ( $settings['image']['id'] || $settings['image']['url'] ) : ?>
        <div class="ele-testimonial-image">
            <?php
            // Get author image markup based on attachment ID or URL
            $author_image_markup = ( ! empty( $settings['image']['id'] ) ) ? wp_get_attachment_image( $settings['image']['id'], $settings['thumbnail_size'] ) : '';
            // Display the image
            echo ! empty( $author_image_markup ) ? $author_image_markup : '<img src="' . esc_url( $settings['image']['url'] ) . '">';
            ?>
        </div>
    <?php endif; ?>
<?php } ?>
<?php
// Check if name or designation is provided
if ( $settings['name'] || $settings['designation'] ) { ?>
    <div class="ele-testimonial-author-bio">
    <?php
    // Check if name is provided and display it
    if ( $settings['name'] ) : ?>
        <<?php echo esc_attr( $title_tag ); ?><?php ele_kses( $title_attributes ); ?>
        class="ele-testimonial-title"><?php echo esc_attr( $settings['name'] ); ?></<?php echo esc_attr( $title_tag ); ?>>
    <?php endif; ?>
    <?php
    // Check if designation is provided and display it
    if ( $settings['designation'] ) : ?>
        <h4 class="ele-testimonial-designation"><?php echo esc_attr( $settings['designation'] ); ?></h4>
    <?php endif; ?>
    </div>
<?php } ?>
<?php
// Display rating if rating style is not 'none' and layout is 4 or 5
if ( 'none' !== $settings['rating_style'] && ('4' === $settings['layout'] || '5' === $settings['layout'] ) ) { ?>
    <div class="ele-testimonial-rating ele-rating-layout-<?php echo esc_attr( $settings['rating_style'] ); ?>">
        <?php
        // Check if rating style is numeric
        if ( 'num' === $settings['rating_style'] ) {
            echo esc_html( $settings['rating']['size'] ) . '<i class="fas fa-star" aria-hidden="true"></i>';
        } else {
            // Display star icons based on rating size
            for ( $index = 1; $index <= 5; $index ++ ) {
                if ( $index <= $settings['rating']['size'] ) {
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
<?php
// Close the wrapper div if the layout is 4, 5, or 6
echo ( '4' === $settings['layout'] || '5' === $settings['layout'] || '6' === $settings['layout'] ) ? '</div>' : ''; ?>