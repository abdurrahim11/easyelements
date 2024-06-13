<?php
if ( ! function_exists( 'ele_make_classname' ) ) {
    function ele_make_classname( $dirname ) {
        $dirname    = pathinfo( $dirname, PATHINFO_FILENAME );
        $class_name = explode( '-', $dirname );
        $class_name = array_map( 'ucfirst', $class_name );
        $class_name = implode( '_', $class_name );

        return $class_name;
    }
}

function ele_kses( $raw ) {
    $allowed_tags = array(
        'a'          => array(
            'class'  => array(),
            'href'   => array(),
            'rel'    => array(),
            'title'  => array(),
            'target' => array(),
        ),
        'abbr'       => array(
            'title' => array(),
        ),
        'b'          => array(),
        'blockquote' => array(
            'cite' => array(),
        ),
        'cite'       => array(
            'title' => array(),
        ),
        'code'       => array(),
        'pre'        => array(),
        'del'        => array(
            'datetime' => array(),
            'title'    => array(),
        ),
        'dd'         => array(),
        'div'        => array(
            'class'                      => array(),
            'id'                         => array(),
            'title'                      => array(),
            'style'                      => array(),
            'data-template-source'       => array(),
            'data-ele-widgetarea-key'   => array(),
            'data-ele-widgetarea-index' => array(),
        ),
        'dl'         => array(),
        'dt'         => array(),
        'em'         => array(),
        'strong'     => array(),
        'h1'         => array(
            'id'    => array(),
            'class' => array(),
        ),
        'h2'         => array(
            'id'    => array(),
            'class' => array(),
        ),
        'h3'         => array(
            'id'    => array(),
            'class' => array(),
        ),
        'h4'         => array(
            'id'    => array(),
            'class' => array(),
        ),
        'h5'         => array(
            'id'    => array(),
            'class' => array(),
        ),
        'h6'         => array(
            'id'    => array(),
            'class' => array(),
        ),
        'i'          => array(
            'id'          => array(),
            'class'       => array(),
            'title'       => array(),
            'aria-hidden' => array(),
        ),
        'img'        => array(
            'alt'    => array(),
            'class'  => array(),
            'height' => array(),
            'src'    => array(),
            'width'  => array(),
        ),
        'li'         => array(
            'class' => array(),
        ),
        'ol'         => array(
            'class' => array(),
        ),
        'p'          => array(
            'class' => array(),
        ),
        'q'          => array(
            'cite'  => array(),
            'title' => array(),
        ),
        'span'       => array(
            'class' => array(),
            'title' => array(),
            'style' => array(),
        ),
        'iframe'     => array(
            'width'       => array(),
            'height'      => array(),
            'scrolling'   => array(),
            'frameborder' => array(),
            'allow'       => array(),
            'src'         => array(),
            'id'          => array(),
            'class'       => array(),
        ),
        'strike'     => array(),
        'br'         => array(),
        'table'      => array(),
        'thead'      => array(),
        'tbody'      => array(),
        'tfoot'      => array(),
        'tr'         => array(),
        'th'         => array(),
        'td'         => array(),
        'colgroup'   => array(),
        'col'        => array(),
        'ul'         => array(
            'class' => array(),
        ),
        'svg'        => array(
            'class'           => true,
            'aria-hidden'     => true,
            'aria-labelledby' => true,
            'role'            => true,
            'xmlns'           => true,
            'width'           => true,
            'height'          => true,
            'viewbox'         => true, // <= Must be lower case!
        ),
        'g'          => array( 'fill' => true ),
        'title'      => array( 'title' => true ),
        'path'       => array(
            'd'    => true,
            'fill' => true,
        ),
        'style'      => array(
            'type' => array(),
        ),
    );

    echo wp_kses( $raw, $allowed_tags );
}

function ele_esc_options( $str, $options = array(), $default = '' ) {
    if ( ! in_array( $str, $options ) ) {
        return $default;
    }

    return $str;
}

if ( ! function_exists( 'ele_is_template_created' ) ) {
    function ele_is_template_created($type) {
        global $wpdb;

        // Build the SQL query
        $sql = $wpdb->prepare(
            "SELECT ID FROM $wpdb->posts
        LEFT JOIN $wpdb->postmeta ON $wpdb->posts.ID = $wpdb->postmeta.post_id
        WHERE $wpdb->posts.post_type = %s
        AND $wpdb->posts.post_status = 'publish'
        AND $wpdb->postmeta.meta_key = 'ele_template_type'
        AND $wpdb->postmeta.meta_value = %s",
            'ele-template-builder',
            $type
        );

        // Execute the query
        $template_ids = $wpdb->get_col( $sql );

        // Check if any template is found
        if (empty($template_ids)) {
            return false;
        }


        // Detect the current condition based on the page being visited
        if (is_archive()) {
            $condition = 'archive';
        } elseif (is_singular()) {
            $condition = 'singular';
        } else {
            $condition = 'entire-site';
        }

        // Check if any of the templates can be displayed based on the condition
        foreach ($template_ids as $template_id) {
            $template_condition = get_post_meta($template_id, 'ele_condition', true);
            if ($template_condition === $condition || $template_condition === 'entire-site') {
                return $template_id;
            }
        }

        return false;
    }
}


function ele_attachment_meta( $id ) {
    $attachment = get_post( $id );
    if ( $attachment == null || $attachment->post_type != 'attachment' ) {
        return null;
    }
    return array(
        'alt'         => get_post_meta( $attachment->ID, '_wp_attachment_image_alt', true ),
        'caption'     => $attachment->post_excerpt,
        'description' => $attachment->post_content,
        'href'        => get_permalink( $attachment->ID ),
        'src'         => $attachment->guid,
        'title'       => $attachment->post_title,
    );
}

function ele_get_attachment_image_html( $settings, $image_key, $image_size_key = null, $image_attr = array() ) {
    if ( ! $image_key ) {
        $image_key = $image_size_key;
    }

    $image = $settings[ $image_key ];

    $size = $image_size_key;

    $html = '';
    if ( ! empty( $image['id'] ) && $image['id'] != '-1' ) {
        $html .= wp_get_attachment_image( $image['id'], $size, false, $image_attr );
    } else {
        $html .= sprintf( '<img src="%s" title="%s" alt="%s" />', esc_attr( $image['url'] ), \Elementor\Control_Media::get_image_title( $image ), \Elementor\Control_Media::get_image_alt( $image ) );
    }

    $html = preg_replace( array( '/max-width:[^"]*;/', '/width:[^"]*;/', '/height:[^"]*;/' ), '', $html );

    return $html;
}


function ele_save_option( $key, $value = '' ) {
    $data_all         = get_option( 'easyelements_options' );
    $data_all[ $key ] = $value;
    update_option( 'easyelements_options', $data_all );
}

function ele_get_option( $key, $default = '' ) {
    $data_all = get_option( 'easyelements_options' );
    return ( isset( $data_all[ $key ] ) && $data_all[ $key ] != '' ) ? $data_all[ $key ] : $default;
}


function ele_get_page_by_title( $page_title, $post_type = 'page' ) {
    $query = new \WP_Query(
        array(
            'post_type' => $post_type,
            'title' => $page_title,
        )
    );

    if (!empty($query->post)) {
        $page_got_by_title = $query->post;
    } else {
        $page_got_by_title = null;
    }

    return $page_got_by_title;
}


function ele_elementor_get_post_types() {
    $post_types = get_post_types(
        array(
            'public' => true,
        ),
        'objects'
    );
    $post_types = wp_list_pluck( $post_types, 'label', 'name' );

    return array_diff_key( $post_types, array( 'elementor_library', 'attachment' ) );
}

function ele_elementor_get_query_post_list( $post_type = 'post', $limit = - 1, $search = '' ) {

    global $wpdb;
    $where = '';
    $data  = array();

    if ( - 1 === $limit ) {
        $limit = '';
    } elseif ( 0 === $limit ) {
        $limit = 'limit 0,1';
    } else {
        $limit = $wpdb->prepare( ' limit 0,%d', esc_sql( $limit ) );
    }

    if ( 'any' === $post_type ) {
        $in_search_post_types = get_post_types( array( 'exclude_from_search' => false ) );
        if ( empty( $in_search_post_types ) ) {
            $where .= ' AND 1=0 ';
        } else {
            $where .= " AND {$wpdb->posts}.post_type IN ('" . join( "', '", array_map( 'esc_sql', $in_search_post_types ) ) . "')";
        }
    } elseif ( 'dynamic' === $post_type ) {
        $in_search_post_types = array( 'elementor_library', 'ele-themer', 'ele_content' );
        if ( empty( $in_search_post_types ) ) {
            $where .= ' AND 1=0 ';
        } else {
            $where .= " AND {$wpdb->posts}.post_type IN ('" . join( "', '", array_map( 'esc_sql', $in_search_post_types ) ) . "')";
        }
    } elseif ( ! empty( $post_type ) ) {
        $where .= $wpdb->prepare( " AND {$wpdb->posts}.post_type = %s", esc_sql( $post_type ) );
    }

    if ( ! empty( $search ) ) {
        $where .= $wpdb->prepare( " AND {$wpdb->posts}.post_title LIKE %s", '%' . esc_sql( $search ) . '%' );
    }

    $results = $wpdb->get_results(
        sprintf( "select post_title,ID  from %s where post_status = 'publish' %s %s", $wpdb->posts, $where, $limit )  //phpcs:ignore WordPress.DB.PreparedSQL.NotPrepared
    );

    if ( ! empty( $results ) ) {
        foreach ( $results as $row ) {
            $data[ $row->ID ] = $row->post_title;
        }
    }

    return $data;
}


function ele_elementor_get_authors_list() {
    $users = get_users(
        array(
            'fields' => array(
                'ID',
                'display_name',
            ),
        )
    );

    if ( ! empty( $users ) ) {
        return wp_list_pluck( $users, 'display_name', 'ID' );
    }

    return array();
}


function ele_elementor_get_post_orderby_options() {
    $orderby = array(
        'ID'            => 'Post ID',
        'author'        => 'Post Author',
        'title'         => 'Title',
        'date'          => 'Date',
        'modified'      => 'Last Modified Date',
        'parent'        => 'Parent Id',
        'rand'          => 'Random',
        'comment_count' => 'Comment Count',
        'menu_order'    => 'Menu Order',
    );

    return $orderby;
}

function ele_elementor_get_taxonomies( $args = array(), $output = 'object', $list = true, $diff_key = array() ) {

    $taxonomies = get_taxonomies( $args, $output );
    if ( 'object' === $output && $list ) {
        $taxonomies = wp_list_pluck( $taxonomies, 'label', 'name' );
    }

    if ( ! empty( $diff_key ) ) {
        $taxonomies = array_diff_key( $taxonomies, $diff_key );
    }

    return $taxonomies;
}


function ele_elementor_get_query_args( $settings = array(), $post_type = 'post' ) {

    $settings = wp_parse_args(
        $settings,
        array(
            'post_type'      => $post_type,
            'posts_ids'      => array(),
            'orderby'        => 'date',
            'order'          => 'desc',
            'posts_per_page' => 3,
            'offset'         => '',
            'post__not_in'   => array(),
        )
    );

    $meta_query = array();
    if ( 'yes' === $settings['post_only_image'] ) {
        $meta_query[] = array(
            'key'     => '_thumbnail_id',
            'compare' => 'EXISTS',
        );
    }

    $args = array(
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

        $args['post_type'] = 'any';
        $args['post__in']  = empty( $settings['posts_ids'] ) ? array( 0 ) : $settings['posts_ids'];

    } elseif ( 'source_dynamic' === $settings['post_type'] ) {

        $args['post_type'] = get_post_type();

        if ( ! empty( $settings['terms'] ) && 'category' === $settings['terms'] ) {
            $args['post__not_in'] = array( get_the_ID() );
            $current_cat          = get_the_category();
            $args['tax_query'][]  = array(
                'taxonomy' => 'category',
                'terms'    => isset( $current_cat[0]->term_id ) ? $current_cat[0]->term_id : '',
            );
        }

        if ( ! empty( $settings['terms'] ) && 'post_tag' === $settings['terms'] ) {
            $args['post__not_in'] = array( get_the_ID() );
            $tags                 = array();
            $posttags             = get_the_tags();
            if ( $posttags ) {
                foreach ( $posttags as $tag ) {
                    $tags[] = $tag->term_id;
                }
            }
            $args['tax_query'][] = array(
                'taxonomy' => 'post_tag',
                'terms'    => $tags,
            );
        }
    } else {

        $args['post_type'] = $settings['post_type'];

        $taxonomies = get_object_taxonomies( $settings['post_type'], 'objects' );

        foreach ( $taxonomies as $object ) {
            $setting_key = $object->name . '_ids';

            if ( ! empty( $settings[ $setting_key ] ) ) {
                $args['tax_query'][] = array(
                    'taxonomy' => $object->name,
                    'field'    => 'term_id',
                    'terms'    => $settings[ $setting_key ],
                );
            }
        }

        if ( ! empty( $args['tax_query'] ) ) {
            $args['tax_query']['relation'] = 'AND';
        }
    }

    if ( ! empty( $settings['authors'] ) ) {
        $args['author__in'] = $settings['authors'];
    }

    if ( ! empty( $settings['authors'] ) ) {
        $args['author__in'] = $settings['authors'];
    }

    return $args;
}


function ele_elementor_get_dynamic_args( array $settings, array $args ) {

    $args['suppress_filters'] = 1;

    if ( 'source_dynamic' === $settings['post_type'] ) {
        $data = get_queried_object();

        if ( isset( $data->post_type ) ) {
            $args['post_type']      = $data->post_type;
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

        if ( isset( $data->taxonomy ) ) {
            $args['tax_query'][] = array(
                'taxonomy' => $data->taxonomy,
                'field'    => 'term_id',
                'terms'    => $data->term_id,
            );
        }

        if ( isset( $data->taxonomy ) ) {
            $args['tax_query'][] = array(
                'taxonomy' => $data->taxonomy,
                'field'    => 'term_id',
                'terms'    => $data->term_id,
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

        //Meta Query
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

    //Tax Query
    if ( ! empty( $args['tax_query'] ) ) {
        $args['tax_query']['relation'] = 'AND';
    }

    $queries = array();
    parse_str( $_SERVER['QUERY_STRING'], $queries );
    $woo_taxonomies = get_object_taxonomies( 'product' );

    foreach ( $queries as $key => $querie ) {
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
 * Contain masking shape list
 */
function ele_elementor_masking_shape_list( $element ) {
    $dir        = ELE_PLUGIN_URL . 'includes/elementor-widgets/team/masking-shape/';
    $shape_name = 'shape';
    $extension  = '.svg';
    $list       = array();
    if ( 'list' === $element ) {
        for ( $i = 1; $i <= 57; $i ++ ) {
            $list[ $shape_name . $i ] = array(
                'title' => ucwords( $shape_name . ' ' . $i ),
                'url'   => $dir . $shape_name . $i . $extension,
            );
        }
    } elseif ( 'url' === $element ) {
        for ( $i = 1; $i <= 57; $i ++ ) {
            $list[ $shape_name . $i ] = $dir . $shape_name . $i . $extension;
        }
    }

    return array_merge( $list );
}

