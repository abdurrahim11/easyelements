<?php

use Elementor\Icons_Manager;

global $post;

// Set the content length for the excerpt, default to 15 if not specified
$content_length = $display_settings['content_length'] ? $display_settings['content_length'] : 15;

// Create an array of words from the post excerpt, limited by content length
$post_excerpt = explode(' ', get_the_excerpt(), $content_length);

// If the number of words is greater than or equal to content length, add ellipsis at the end
if (count($post_excerpt) >= $content_length) {
    array_pop($post_excerpt);
    $post_excerpt = implode(' ', $post_excerpt) . '...';
} else {
    $post_excerpt = implode(' ', $post_excerpt);
}

// Remove any shortcodes from the excerpt
$post_excerpt = preg_replace('`[[^]]*]`', '', $post_excerpt);

?>

<div class="cbp-item ele-post-grid-item">
    <?php if (has_post_thumbnail() && 'yes' === $display_settings['show_image']) { ?>
        <!-- Display post thumbnail if available and show_image setting is enabled -->
        <div class="ele-post-grid-image">
            <?php echo wp_get_attachment_image(get_post_thumbnail_id($post->ID), $display_settings['thumbnail_size']); ?>
            <?php if ('yes' === $display_settings['show_readmore'] && '3' === $display_settings['layout']) { ?>
                <!-- Display read more button if show_readmore setting is enabled and layout is '3' -->
                <a href="<?php echo esc_url(get_permalink($post->ID)); ?>" class="ele-post-grid-btn"><?php echo esc_html($display_settings['readmore_text']); ?></a>
            <?php } ?>
        </div>
    <?php } ?>

    <div class="ele-post-grid-content">
        <?php if ('yes' === $display_settings['show_author'] && '4' === $display_settings['layout']) { ?>
            <!-- Display author avatar if show_author and show_author_avatar settings are enabled and layout is '4' -->
            <div class="ele-post-grid-author">
                <?php if ('yes' === $display_settings['show_author_avatar']) { ?>
                    <img src="<?php echo esc_url(get_avatar_url(get_the_author_meta('ID'))); ?>" alt="author-avatar">
                <?php } ?>
            </div>
        <?php } ?>

        <?php if (!empty($display_settings['show_meta']) && ('3' !== $display_settings['layout'] && '7' !== $display_settings['layout'])) { ?>
            <!-- Display meta information if show_meta setting is not empty and layout is neither '3' nor '7' -->
            <ul class="ele-post-grid-meta-list">
                <?php foreach ($display_settings['show_meta'] as $meta_field) { ?>
                    <?php if ('date' === $meta_field) { ?>
                        <!-- Display date meta information -->
                        <li class="ele-post-grid-meta-date">
                            <?php Icons_Manager::render_icon($display_settings['date_icon'], array('aria-hidden' => 'true')); ?>
                            <?php the_time(get_option('date_format')); ?>
                        </li>
                    <?php } ?>
                    <?php if ('category' === $meta_field && get_the_category_list()) { ?>
                        <!-- Display category meta information -->
                        <li class="ele-post-grid-meta-category">
                            <?php Icons_Manager::render_icon($display_settings['category_icon'], array('aria-hidden' => 'true')); ?>
                            <span><?php echo wp_kses_post(get_the_category_list(', ')); ?></span>
                        </li>
                    <?php } ?>
                    <?php if ('comments' === $meta_field) { ?>
                        <!-- Display comments meta information -->
                        <li class="ele-post-grid-meta-comments">
                            <?php Icons_Manager::render_icon($display_settings['comments_icon'], array('aria-hidden' => 'true')); ?>
                            <?php comments_number(esc_html__('No Comments', 'easy-elements'), esc_html__('1 Comment', 'easy-elements'), esc_html__('% Comments', 'easy-elements')); ?>
                        </li>
                    <?php } ?>
                <?php } ?>
            </ul>
        <?php } ?>

        <!-- Display post title as a link to the post -->
        <a href="<?php echo esc_url(get_permalink($post->ID)); ?>">
            <h2 class="ele-post-grid-title"><?php the_title(); ?></h2>
        </a>

        <?php if (!empty($display_settings['show_meta']) && '3' === $display_settings['layout']) { ?>
            <!-- Display meta information if layout is '3' -->
            <ul class="ele-post-grid-meta-list">
                <?php foreach ($display_settings['show_meta'] as $meta_field) { ?>
                    <?php if ('date' === $meta_field) { ?>
                        <li class="ele-post-grid-meta-date">
                            <?php Icons_Manager::render_icon($display_settings['date_icon'], array('aria-hidden' => 'true')); ?>
                            <?php the_time(get_option('date_format')); ?>
                        </li>
                    <?php } ?>
                    <?php if ('category' === $meta_field && get_the_category_list()) { ?>
                        <li class="ele-post-grid-meta-category">
                            <?php Icons_Manager::render_icon($display_settings['category_icon'], array('aria-hidden' => 'true')); ?>
                            <span><?php echo wp_kses_post(get_the_category_list(', ')); ?></span>
                        </li>
                    <?php } ?>
                    <?php if ('comments' === $meta_field) { ?>
                        <li class="ele-post-grid-meta-comments">
                            <?php Icons_Manager::render_icon($display_settings['comments_icon'], array('aria-hidden' => 'true')); ?>
                            <?php comments_number(esc_html__('No Comments', 'easy-elements'), esc_html__('1 Comment', 'easy-elements'), esc_html__('% Comments', 'easy-elements')); ?>
                        </li>
                    <?php } ?>
                <?php } ?>
            </ul>
        <?php } ?>

        <?php if ('yes' === $display_settings['show_content']) { ?>
            <!-- Display post excerpt if show_content setting is enabled -->
            <p class="ele-post-grid-excerpt"><?php ele_kses($post_excerpt); ?></p>
        <?php } ?>
        <?php if ('yes' === $display_settings['show_readmore'] && '3' !== $display_settings['layout']) { ?>
            <!-- Display read more button if show_readmore setting is enabled and layout is not '3' -->
            <a href="<?php echo esc_url(get_permalink($post->ID)); ?>" class="ele-post-grid-btn"><?php echo esc_html($display_settings['readmore_text']); ?></a>
        <?php } ?>
        <?php if ('yes' === $display_settings['show_author'] && '4' !== $display_settings['layout']) { ?>
            <!-- Display author information if show_author setting is enabled and layout is not '4' -->
            <div class="ele-post-grid-author">
                <?php if ('yes' === $display_settings['show_author_avatar']) { ?>
                    <img src="<?php echo esc_url(get_avatar_url(get_the_author_meta('ID'))); ?>" alt="author-avatar">
                <?php } ?>
                <div class="ele-post-grid-author-content">
                    <?php if ($display_settings['author_title']) { ?>
                        <span class="ele-post-grid-author-title"><?php echo esc_html($display_settings['author_title']); ?></span>
                    <?php } ?>
                    <a href="<?php echo esc_url(get_author_posts_url(get_the_author_meta('ID'))); ?>" class="ele-post-grid-author-name">
                        <?php echo esc_html(get_the_author_meta('display_name')); ?></a>
                </div>
            </div>
        <?php } ?>

        <?php if (!empty($display_settings['show_meta']) && '7' === $display_settings['layout']) { ?>
            <!-- Display meta information if layout is '7' -->
            <ul class="ele-post-grid-meta-list">
                <?php foreach ($display_settings['show_meta'] as $meta_field) { ?>
                    <?php if ('date' === $meta_field) { ?>
                        <li class="ele-post-grid-meta-date">
                            <?php Icons_Manager::render_icon($display_settings['date_icon'], array('aria-hidden' => 'true')); ?>
                            <?php the_time(get_option('date_format')); ?>
                        </li>
                    <?php } ?>
                    <?php if ('category' === $meta_field && get_the_category_list()) { ?>
                        <li class="ele-post-grid-meta-category">
                            <?php Icons_Manager::render_icon($display_settings['category_icon'], array('aria-hidden' => 'true')); ?>
                            <span><?php echo wp_kses_post(get_the_category_list(', ')); ?></span>
                        </li>
                    <?php } ?>
                    <?php if ('comments' === $meta_field) { ?>
                        <li class="ele-post-grid-meta-comments">
                            <?php Icons_Manager::render_icon($display_settings['comments_icon'], array('aria-hidden' => 'true')); ?>
                            <?php comments_number(esc_html__('No Comments', 'easy-elements'), esc_html__('1 Comment', 'easy-elements'), esc_html__('% Comments', 'easy-elements')); ?>
                        </li>
                    <?php } ?>
                <?php } ?>
            </ul>
        <?php } ?>

    </div>
</div>