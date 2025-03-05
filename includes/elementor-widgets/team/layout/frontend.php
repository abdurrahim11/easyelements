<?php

use Elementor\Icons_Manager;

$title_tag   = ( $settings['title_link']['url'] ) ? 'a' : 'h2';
$title_attributes  = $settings['title_link']['is_external'] ? ' target="_blank"' : '';
$title_attributes .= $settings['title_link']['nofollow'] ? ' rel="nofollow"' : '';
$title_attributes .= $settings['title_link']['url'] ? ' href="' . esc_url( $settings['title_link']['url'] ) . '"' : '';

?>

<div class="ele-team-wrapper ele-team-layout-<?php echo esc_attr( $settings['layout'] ); ?>">
    <?php if ( $settings['designation'] && '2' === $settings['layout'] ) { ?>
        <h4 class="ele-team-designation"><?php echo esc_attr( $settings['designation'] ); ?></h4>
    <?php } ?>

    <?php if ( $settings['image']['id'] || $settings['image']['url'] ) { ?>
    <div class="ele-team-image">
        <?php
        $image_markup = ( ! empty( $settings['image']['id'] ) ) ? wp_get_attachment_image( $settings['image']['id'], $settings['thumbnail_size'] ) : '';
        $full_image_markup =  ! empty( $image_markup ) ? $image_markup : '<img alt="team-img" src="' . esc_url( $settings['image']['url'] ) . '">';
        echo wp_kses_post( $full_image_markup );
        ?>
        <?php if ( '8' === $settings['layout'] || '9' === $settings['layout'] ) { ?>
        <div class="ele-team-inner-content">
            <?php if ( $settings['title'] ) { ?>
            <<?php echo esc_attr( $title_tag ); ?><?php wp_kses_post( $title_attributes ); ?>
            class="ele-team-title"><?php echo esc_attr( $settings['title'] ); ?></<?php echo esc_attr( $title_tag ); ?>>
    <?php } ?>
        <?php if ( $settings['designation'] ) { ?>
            <h4 class="ele-team-designation"><?php echo esc_attr( $settings['designation'] ); ?></h4>
        <?php } ?>
    </div>
<?php } ?>
    <?php if ( $settings['social_enable'] && $settings['social_icon_list'] && ( '2' === $settings['layout'] || '3' === $settings['layout'] || '5' === $settings['layout'] || '8' === $settings['layout'] || '12' === $settings['layout'] || '13' === $settings['layout'] || '15' === $settings['layout'] ) ) { ?>
        <ul class="ele-team-social-list">
            <?php
            foreach ( $settings['social_icon_list'] as $index => $icon ) {
                $html_tag = $icon['icon_link']['url'] ? 'a' : 'span';
                $icon_attributes = $icon['icon_link']['is_external'] ? ' target="_blank"' : '';
                $icon_attributes .= $icon['icon_link']['nofollow'] ? ' rel="nofollow"' : '';
                $icon_attributes .= $icon['icon_link']['url'] ? ' href="' . esc_url( $icon['icon_link']['url'] ) . '"' : '';

                ?>
            <li class="elementor-repeater-item-<?php echo esc_attr( $icon['_id'] ); ?>">
                <<?php echo esc_attr( $html_tag ); ?> <?php wp_kses_post( $icon_attributes ); ?> class="ele-team-social-icon ele-svg-icon">
                <?php \Elementor\Icons_Manager::render_icon( $icon['social_icon'], array( 'aria-hidden' => 'true' ) ); ?>
                </<?php echo esc_attr( $html_tag ); ?>>
                </li>
            <?php } ?>
        </ul>
    <?php } ?>
</div>
<?php } ?>
<div class="ele-team-content">
    <?php if ( '8' !== $settings['layout'] && '9' !== $settings['layout'] ) { ?>
    <?php if ( $settings['title'] ) { ?>
    <<?php echo esc_attr( $title_tag ); ?><?php wp_kses_post( $title_attributes ); ?>
    class="ele-team-title"><?php echo esc_attr( $settings['title'] ); ?></<?php echo esc_attr( $title_tag ); ?>>
<?php } ?>
<?php if ( $settings['designation'] && '2' !== $settings['layout'] ) { ?>
    <h4 class="ele-team-designation"><?php echo esc_attr( $settings['designation'] ); ?></h4>
<?php } ?>
<?php } ?>
<?php if ( $settings['description'] ) { ?>
    <p class="ele-team-description"><?php echo esc_attr( $settings['description'] ); ?></p>
<?php } ?>

<?php if ( $settings['social_enable'] && $settings['social_icon_list'] && ( '2' !== $settings['layout'] && '3' !== $settings['layout'] && '5' !== $settings['layout'] && '8' !== $settings['layout'] && '12' !== $settings['layout'] && '13' !== $settings['layout'] && '15' !== $settings['layout'] ) ) { ?>
    <ul class="ele-team-social-list">
        <?php
        foreach ( $settings['social_icon_list'] as $index => $icon ) {
            $html_tag = $icon['icon_link']['url'] ? 'a' : 'span';
            $icon_attributes = $icon['icon_link']['is_external'] ? ' target="_blank"' : '';
            $icon_attributes .= $icon['icon_link']['nofollow'] ? ' rel="nofollow"' : '';
            $icon_attributes .= $icon['icon_link']['url'] ? ' href="' . esc_url( $icon['icon_link']['url'] ) . '"' : '';
            ?>
        <li class="elementor-repeater-item-<?php echo esc_attr( $icon['_id'] ); ?>">
            <<?php echo esc_attr( $html_tag ); ?> <?php wp_kses_post( $icon_attributes ); ?> class="ele-team-social-icon ele-svg-icon">
            <?php \Elementor\Icons_Manager::render_icon( $icon['social_icon'], array( 'aria-hidden' => 'true' ) ); ?>
            </<?php echo esc_attr( $html_tag ); ?>>
            </li>
        <?php } ?>
    </ul>
<?php } ?>
</div>
</div>