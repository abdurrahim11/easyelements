<?php
/**
 * Generate a class name from a directory name according to WordPress standards.
 *
 */
function ele_generate_class_name( $directory_name ) {
    $filename   = pathinfo( $directory_name, PATHINFO_FILENAME );
    $name_parts = explode( '-', $filename );
    $name_parts = array_map( 'ucfirst', $name_parts );
    $class_name = implode( '_', $name_parts );

    return $class_name;
}

/**
 * Validate and return a string if it exists within a set of allowed options.
 *
 * This function checks if a given string is present in an array of allowed options.
 * If it is, the string is returned. Otherwise, a default value is returned.
 *
 */
function ele_esc_options( $string, $allowed_options = array(), $default_value = '' ) {
    if ( ! in_array( $string, $allowed_options, true ) ) {
        return $default_value;
    }

    return $string;
}

/**
 * Check if an Elementor template of a specific type is created and can be displayed based on the current page condition.
 *
 */
function ele_is_template_created($type) {
    global $wpdb;

    // Build the SQL query to find templates of the specified type
    $query = $wpdb->prepare(
        "SELECT posts.ID FROM $wpdb->posts AS posts
        LEFT JOIN $wpdb->postmeta AS postmeta ON posts.ID = postmeta.post_id
        WHERE posts.post_type = %s
        AND posts.post_status = 'publish'
        AND postmeta.meta_key = 'ele_template_type'
        AND postmeta.meta_value = %s",
        'ele-template-builder',
        $type
    );

    // Execute the query to get template IDs
    $template_ids = $wpdb->get_col($query);

    // Return false if no templates are found
    if (empty($template_ids)) {
        return false;
    }

    // Determine the current page condition
    if (is_archive()) {
        $current_condition = 'archive';
    } elseif (is_singular()) {
        $current_condition = 'singular';
    } else {
        $current_condition = 'entire-site';
    }

    // Check if any template matches the current page condition
    foreach ($template_ids as $template_id) {
        $template_condition = get_post_meta($template_id, 'ele_condition', true);
        if ($template_condition === $current_condition || $template_condition === 'entire-site') {
            return $template_id;
        }
    }

    // Return false if no suitable template is found
    return false;
}

/**
 * Retrieves metadata for a specified attachment.
 *
 */
function ele_attachment_meta($id) {
    // Get the attachment post object
    $attachment_post = get_post($id);

    // Check if the post is a valid attachment
    if ($attachment_post === null || $attachment_post->post_type !== 'attachment') {
        return null;
    }

    // Return an associative array of attachment metadata
    return array(
        'alt'         => get_post_meta($attachment_post->ID, '_wp_attachment_image_alt', true),
        'caption'     => $attachment_post->post_excerpt,
        'description' => $attachment_post->post_content,
        'href'        => get_permalink($attachment_post->ID),
        'src'         => $attachment_post->guid,
        'title'       => $attachment_post->post_title,
    );
}

/**
 * Generates HTML for an attachment image based on the provided settings.
 *
 */
function ele_get_attachment_image_html($settings, $image_key, $image_size_key = null, $image_attr = array()) {
    // Use image_size_key if image_key is not provided
    if (!$image_key) {
        $image_key = $image_size_key;
    }

    // Get the image data from settings
    $image_data = $settings[$image_key];

    // Set the size to image_size_key
    $image_size = $image_size_key;

    // Initialize HTML string
    $image_html = '';

    // Check if the image ID is valid and not equal to '-1'
    if (!empty($image_data['id']) && $image_data['id'] != '-1') {
        // Get the attachment image HTML
        $image_html .= wp_get_attachment_image($image_data['id'], $image_size, false, $image_attr);
    } else {
        // Construct the image HTML with URL, title, and alt attributes
        $image_html .= sprintf(
            '<img src="%s" title="%s" alt="%s" />',
            esc_attr($image_data['url']),
            \Elementor\Control_Media::get_image_title($image_data),
            \Elementor\Control_Media::get_image_alt($image_data)
        );
    }

    // Remove unwanted inline styles
    $image_html = preg_replace(
        array('/max-width:[^"]*;/', '/width:[^"]*;/', '/height:[^"]*;/'),
        '',
        $image_html
    );

    return $image_html;
}

/**
 * Saves a specific option key and value to the 'easyelements_options' option.
 *
 */
function ele_save_option($key, $value = '') {
    $all_options = get_option('easyelements_options');
    $all_options[$key] = $value;
    update_option('easyelements_options', $all_options);
}

/**
 * Retrieves the specified option from the 'easyelements_options' array.
 *
 */
function ele_get_option( $key, $default = '' ) {
    $easyelements_options = get_option( 'easyelements_options' );
    return ( isset( $easyelements_options[ $key ] ) && $easyelements_options[ $key ] != '' ) ? $easyelements_options[ $key ] : $default;
}

/**
 * Retrieves a page by its title.
 *
 */
function ele_get_page_by_title( $page_title, $post_type = 'page' ) {
    $query_args = array(
        'post_type' => $post_type,
        'title'     => $page_title,
    );

    $page_query = new \WP_Query( $query_args );

    if ( ! empty( $page_query->post ) ) {
        $page = $page_query->post;
    } else {
        $page = null;
    }

    return $page;
}

/**
 * Retrieves an array of public post types excluding 'elementor_library' and 'attachment'.
 *
 */
function ele_elementor_get_post_types() {
    $public_post_types = get_post_types(
        array(
            'public' => true,
        ),
        'objects'
    );

    $post_types_labels = wp_list_pluck( $public_post_types, 'label', 'name' );

    return array_diff_key( $post_types_labels, array( 'elementor_library' => '', 'attachment' => '' ) );
}

/**
 * Retrieves a list of posts based on the specified post type, limit, and search term.
 *
 */
function ele_elementor_get_query_post_list( $post_type = 'post', $limit = -1, $search = '' ) {

    global $wpdb;
    $where_clause = '';
    $post_data    = array();

    if ( -1 === $limit ) {
        $limit_clause = '';
    } elseif ( 0 === $limit ) {
        $limit_clause = 'LIMIT 0,1';
    } else {
        $limit_clause = $wpdb->prepare( ' LIMIT 0,%d', esc_sql( $limit ) );
    }

    if ( 'any' === $post_type ) {
        $searchable_post_types = get_post_types( array( 'exclude_from_search' => false ) );
        if ( empty( $searchable_post_types ) ) {
            $where_clause .= ' AND 1=0 ';
        } else {
            $where_clause .= " AND {$wpdb->posts}.post_type IN ('" . join( "', '", array_map( 'esc_sql', $searchable_post_types ) ) . "')";
        }
    } elseif ( 'dynamic' === $post_type ) {
        $dynamic_post_types = array( 'elementor_library', 'ele-themer', 'ele_content' );
        if ( empty( $dynamic_post_types ) ) {
            $where_clause .= ' AND 1=0 ';
        } else {
            $where_clause .= " AND {$wpdb->posts}.post_type IN ('" . join( "', '", array_map( 'esc_sql', $dynamic_post_types ) ) . "')";
        }
    } elseif ( ! empty( $post_type ) ) {
        $where_clause .= $wpdb->prepare( " AND {$wpdb->posts}.post_type = %s", esc_sql( $post_type ) );
    }

    if ( ! empty( $search ) ) {
        $where_clause .= $wpdb->prepare( " AND {$wpdb->posts}.post_title LIKE %s", '%' . esc_sql( $search ) . '%' );
    }

    $results = $wpdb->get_results(
        sprintf( "SELECT post_title, ID FROM %s WHERE post_status = 'publish' %s %s", $wpdb->posts, $where_clause, $limit_clause )  //phpcs:ignore WordPress.DB.PreparedSQL.NotPrepared
    );

    if ( ! empty( $results ) ) {
        foreach ( $results as $row ) {
            $post_data[ $row->ID ] = $row->post_title;
        }
    }

    return $post_data;
}

/**
 * Retrieves a list of authors with their display names.
 *
 */
function ele_elementor_get_authors_list() {
    $authors = get_users(
        array(
            'fields' => array(
                'ID',
                'display_name',
            ),
        )
    );

    if ( ! empty( $authors ) ) {
        return wp_list_pluck( $authors, 'display_name', 'ID' );
    }

    return array();
}

/**
 * Retrieves an array of post orderby options for queries.
 *
 */
function ele_elementor_get_post_orderby_options() {
    $orderby_options = array(
        'ID'            => 'Post ID',
        'author'        => 'Post Author',
        'title'         => 'Title',
        'date'          => 'Date',
        'modified'      => 'Last Modified Date',
        'parent'        => 'Parent ID',
        'rand'          => 'Random',
        'comment_count' => 'Comment Count',
        'menu_order'    => 'Menu Order',
    );

    return $orderby_options;
}

/**
 * Retrieves taxonomies based on the specified arguments.
 *
 */
function ele_elementor_get_taxonomies( $args = array(), $output = 'object', $list = true, $diff_key = array() ) {

    $taxonomies = get_taxonomies( $args, $output );
    if ( 'object' === $output && $list ) {
        $taxonomy_labels = wp_list_pluck( $taxonomies, 'label', 'name' );
    } else {
        $taxonomy_labels = $taxonomies;
    }

    if ( ! empty( $diff_key ) ) {
        $taxonomy_labels = array_diff_key( $taxonomy_labels, $diff_key );
    }

    return $taxonomy_labels;
}

/**
 * Constructs and returns query arguments for fetching posts based on given settings.
 *
 */
function ele_elementor_get_query_args( $settings = array(), $post_type = 'post' ) {

    $default_settings = array(
        'post_type'      => $post_type,
        'posts_ids'      => array(),
        'orderby'        => 'date',
        'order'          => 'desc',
        'posts_per_page' => 3,
        'offset'         => '',
        'post__not_in'   => array(),
    );

    $settings = wp_parse_args( $settings, $default_settings );

    $meta_query = array();
    if ( 'yes' === $settings['post_only_image'] ) {
        $meta_query[] = array(
            'key'     => '_thumbnail_id',
            'compare' => 'EXISTS',
        );
    }

    $query_args = array(
        'orderby'             => $settings['orderby'],
        'order'               => $settings['order'],
        'ignore_sticky_posts' => true,
        'post_status'         => 'publish',
        'posts_per_page'      => $settings['posts_per_page'],
        'offset'              => $settings['offset'],
        'meta_query'          => $meta_query,
        'tax_query'           => array(),
        'post__not_in'        => $settings['post__not_in'],
    );

    if ( 'by_id' === $settings['post_type'] ) {
        $query_args['post_type'] = 'any';
        $query_args['post__in']  = empty( $settings['posts_ids'] ) ? array( 0 ) : $settings['posts_ids'];
    } elseif ( 'source_dynamic' === $settings['post_type'] ) {
        $query_args['post_type'] = get_post_type();

        if ( ! empty( $settings['terms'] ) && 'category' === $settings['terms'] ) {
            $query_args['post__not_in'] = array( get_the_ID() );
            $current_category = get_the_category();
            $query_args['tax_query'][] = array(
                'taxonomy' => 'category',
                'terms'    => isset( $current_category[0]->term_id ) ? $current_category[0]->term_id : '',
            );
        }

        if ( ! empty( $settings['terms'] ) && 'post_tag' === $settings['terms'] ) {
            $query_args['post__not_in'] = array( get_the_ID() );
            $tags = array();
            $post_tags = get_the_tags();
            if ( $post_tags ) {
                foreach ( $post_tags as $tag ) {
                    $tags[] = $tag->term_id;
                }
            }
            $query_args['tax_query'][] = array(
                'taxonomy' => 'post_tag',
                'terms'    => $tags,
            );
        }
    } else {
        $query_args['post_type'] = $settings['post_type'];
        $taxonomies = get_object_taxonomies( $settings['post_type'], 'objects' );

        foreach ( $taxonomies as $taxonomy ) {
            $taxonomy_setting_key = $taxonomy->name . '_ids';

            if ( ! empty( $settings[ $taxonomy_setting_key ] ) ) {
                $query_args['tax_query'][] = array(
                    'taxonomy' => $taxonomy->name,
                    'field'    => 'term_id',
                    'terms'    => $settings[ $taxonomy_setting_key ],
                );
            }
        }

        if ( ! empty( $query_args['tax_query'] ) ) {
            $query_args['tax_query']['relation'] = 'AND';
        }
    }

    if ( ! empty( $settings['authors'] ) ) {
        $query_args['author__in'] = $settings['authors'];
    }

    if ( ! empty( $settings['authors'] ) ) {
        $query_args['author__in'] = $settings['authors'];
    }

    return $query_args;
}

/**
 * Modifies and returns query arguments for dynamic post fetching based on given settings and arguments.
 *
 */
function ele_elementor_get_dynamic_args( array $settings, array $args ) {

    $args['suppress_filters'] = 1;

    if ( 'source_dynamic' === $settings['post_type'] ) {
        $queried_object = get_queried_object();

        if ( isset( $queried_object->post_type ) ) {
            $args['post_type']      = $queried_object->post_type;
            $args['posts_per_page'] = get_option( 'posts_per_page' );
        } else {
            global $wp_query;
            $args['post_type']      = $wp_query->query_vars['post_type'];
            $args['posts_per_page'] = get_option( 'posts_per_page' );
            if ( ! empty( $wp_query->query_vars['s'] ) ) {
                $args['s']      = $wp_query->query_vars['s'];
                $args['offset'] = 0;
            }
        }

        if ( get_post_type() === 'ele-themer' ) {
            $args['post_type'] = 'post';
        }

        if ( ! is_front_page() && is_home() ) {
            $args['post_type'] = 'post';
        }

        if ( class_exists( 'WooCommerce' ) ) {
            if ( is_shop() || is_product_category() || is_product_tag() ) {
                $args['post_type'] = 'product';
            }
        }

        if ( isset( $queried_object->taxonomy ) ) {
            $args['tax_query'][] = array(
                'taxonomy' => $queried_object->taxonomy,
                'field'    => 'term_id',
                'terms'    => $queried_object->term_id,
            );
        }

        if ( get_query_var( 'author' ) > 0 ) {
            $args['author__in'] = get_query_var( 'author' );
        }

        if ( '' !== get_query_var( 's' ) ) {
            $args['s'] = get_query_var( 's' );
        }

        if ( get_query_var( 'year' ) || get_query_var( 'monthnum' ) || get_query_var( 'day' ) ) {
            $args['date_query'] = array(
                'year'  => get_query_var( 'year' ) ? get_query_var( 'year' ) : null,
                'month' => get_query_var( 'monthnum' ) ? get_query_var( 'monthnum' ) : null,
                'day'   => get_query_var( 'day' ) ? get_query_var( 'day' ) : null,
            );
        }

        // Meta Query for price range
        if ( isset( $_GET['min-price'] ) || isset( $_GET['max-price'] ) ) {
            $args['meta_query'][] = array(
                array(
                    'key'     => '_price',
                    'value'   => array( $_GET['min-price'], $_GET['max-price'] ),
                    'compare' => 'BETWEEN',
                    'type'    => 'NUMERIC',
                ),
            );
        }
    }

    // Meta Query for stock status
    if ( isset( $_GET['stock'] ) ) {
        if ( 'outofstock' === $_GET['stock'] ) {
            $args['meta_query'][] = array(
                'key'     => '_stock_status',
                'value'   => 'outofstock',
                'compare' => '==',
            );
        } else {
            $args['meta_query'][] = array(
                'key'     => '_stock_status',
                'value'   => 'instock',
                'compare' => '==',
            );
        }
    }

    // Meta Query for sale status
    if ( isset( $_GET['sale'] ) ) {
        if ( 'on-sale' === $_GET['sale'] ) {
            $args['meta_query'][] = array(
                'relation' => 'OR',
                array(
                    'key'     => '_sale_price',
                    'value'   => 0,
                    'compare' => '>',
                    'type'    => 'numeric',
                ),
                array(
                    'key'     => '_min_variation_sale_price',
                    'value'   => 0,
                    'compare' => '>',
                    'type'    => 'numeric',
                ),
            );
        }

        if ( 'regular-price' === $_GET['sale'] ) {
            $args['meta_query'][] = array(
                'relation' => 'OR',
                array(
                    'key'     => '_sale_price',
                    'value'   => 0,
                    'compare' => '=',
                    'type'    => 'numeric',
                ),
                array(
                    'key'     => '_min_variation_sale_price',
                    'value'   => 0,
                    'compare' => '=',
                    'type'    => 'numeric',
                ),
            );
        }
    }

    // Tax Query
    if ( ! empty( $args['tax_query'] ) ) {
        $args['tax_query']['relation'] = 'AND';
    }

    $parsed_queries = array();
    parse_str( $_SERVER['QUERY_STRING'], $parsed_queries );
    $woo_taxonomies = get_object_taxonomies( 'product' );

    foreach ( $parsed_queries as $key => $query ) {
        $taxonomy = str_replace( 'xa-', 'pa_ele-', $key );
        $taxonomy = str_replace( 'subcategory', 'product_cat', $taxonomy );
        $taxonomy = str_replace( 'category', 'product_cat', $taxonomy );
        if ( isset( $_GET[ $key ] ) && in_array( $taxonomy, $woo_taxonomies, true ) ) {
            $args['tax_query'][] = array(
                'taxonomy' => $taxonomy,
                'field'    => 'slug',
                'terms'    => explode( ',', $_GET[ $key ] ),
            );
        }
    }

    return $args;
}

/**
 * Generates a list of masking shapes with their titles and URLs based on the specified element type.
 *
 */
function ele_elementor_masking_shape_list( $element ) {
    $shape_directory = ELE_PLUGIN_URL . 'includes/elementor-widgets/team/masking-shape/';
    $shape_prefix = 'shape';
    $file_extension = '.svg';
    $shape_list = array();

    if ( 'list' === $element ) {
        for ( $i = 1; $i <= 57; $i++ ) {
            $shape_list[ $shape_prefix . $i ] = array(
                'title' => ucwords( $shape_prefix . ' ' . $i ),
                'url'   => $shape_directory . $shape_prefix . $i . $file_extension,
            );
        }
    } elseif ( 'url' === $element ) {
        for ( $i = 1; $i <= 57; $i++ ) {
            $shape_list[ $shape_prefix . $i ] = $shape_directory . $shape_prefix . $i . $file_extension;
        }
    }

    return array_merge( $shape_list );
}
