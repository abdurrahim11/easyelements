<div class="ele-hotspot-wrapper">
    <!-- Display the main image -->
    <figure class="ele-hotspot-image">
        <?php
        if ($settings['image']) {
            echo wp_kses_post(\Elementor\Group_Control_Image_Size::get_attachment_image_html($settings, 'media_thumbnail', 'image'));
        }
        ?>
    </figure>

    <?php
    // Loop through each hotspot item
    foreach ($settings['hotspot_items'] as $index => $hotspot_item) {

    $html_tag = ($hotspot_item['link']['url']) ? 'a' : 'span';
    $attributes = $hotspot_item['link']['is_external'] ? ' target="_blank"' : '';
    $attributes .= $hotspot_item['link']['nofollow'] ? ' rel="nofollow"' : '';
    $attributes .= $hotspot_item['link']['url'] ? ' href="' . esc_url($hotspot_item['link']['url']) . '"' : '';

    // Add custom attributes if any
    if ($hotspot_item['link'] && $hotspot_item['link']['custom_attributes']) {
        $custom_attributes = explode(',', $hotspot_item['link']['custom_attributes']);

        foreach ($custom_attributes as $attribute) {
            if (!empty($attribute)) {
                $custom_attr = explode('|', $attribute, 2);
                if (!isset($custom_attr[1])) {
                    $custom_attr[1] = '';
                }
                $attributes .= ' ' . $custom_attr[0] . '="' . $custom_attr[1] . '"';
            }
        }
    }

    ?>
    <!-- Render each hotspot item -->
    <<?php echo esc_attr($html_tag); ?> <?php ele_kses($attributes); ?> class="elementor-repeater-item-<?php echo esc_attr($hotspot_item['_id']); ?> ele-hotspot-item">

    <span class="ele-hotspot-item-wrap ele-hotspot-type-<?php echo esc_attr($settings['type']); ?> ">

            <?php
            if ('yes' === $hotspot_item['show_tooltip']) {
                ?>
                <!-- Display tooltip if enabled -->
                <span class="ele-hotspot-tooltip-text <?php echo esc_attr($hotspot_item['show_default_tooltip'] === 'yes' ? 'ele-active' : ''); ?> ele-hotspot-<?php echo esc_attr($hotspot_item['position']); ?>">
                <?php echo wp_kses_post($hotspot_item['tooltip_text']); ?>
            </span>
                <?php
            }
            ?>

        <?php
        // Render icon or image based on hotspot media type
        if ('icon' === $hotspot_item['hot_media_type']) {
            \Elementor\Icons_Manager::render_icon($hotspot_item['hot_icon'], array('aria-hidden' => 'true'));
        }
        if ('image' === $hotspot_item['hot_media_type']) {
            echo wp_kses_post(\Elementor\Group_Control_Image_Size::get_attachment_image_html($hotspot_item, 'spots_thumbnail', 'spots_image'));
        }
        ?>
        </span>
</<?php echo esc_attr($html_tag); ?>>
<?php
}
?>

</div>