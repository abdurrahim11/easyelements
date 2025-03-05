<?php
namespace EasyElements\Modules\Mega_Menu;

use EasyElements\Modules\Mega_Menu\Init;

class Nav_Menu_Walker extends \Walker_Nav_Menu {


    // Retrieve the meta data for a menu item
    public function get_item_meta( $menu_item_id ) {
        $meta_key = Init::$menuitem_settings_key;
        $menu_item_meta_data = get_post_meta( $menu_item_id, $meta_key, true );
        $menu_item_meta_data = (array) json_decode( $menu_item_meta_data );

        // Set default settings for the menu item
        $default_menu_item_settings = array(
            'menu_id'                         => null,
            'menu_has_child'                  => '',
            'menu_enable'                     => 0,
            'menu_icon'                       => '',
            'menu_icon_color'                 => '',
            'menu_badge_text'                 => '',
            'menu_badge_color'                => '',
            'menu_badge_background'           => '',
            'mobile_submenu_content_type'     => 'builder_content',
            'vertical_megamenu_position_type' => 'relative_position',
            'vertical_menu_width'             => '',
            'megamenu_width_type'             => 'default_width',
            'megamenu_ajax_load'              => 'no',
        );
        return array_merge( $default_menu_item_settings, $menu_item_meta_data );
    }

    // Check if a menu is a megamenu
    public function is_megamenu( $menu_slug ) {
        $menu_object = wp_get_nav_menu_object($menu_slug);
        $menu_slug = ( ( ( gettype( $menu_object ) == 'object' ) && ( isset( $menu_object->slug ) ) ) ? $menu_object->slug : $menu_slug );

        $cache_key = 'easyelements_megamenu_data_' . $menu_slug;
        $cached_data = wp_cache_get( $cache_key );
        if ( false !== $cached_data ) {
            return $cached_data;
        }

        $is_megamenu_enabled = 0;

        $active_modules_list = \EasyElements\Core\Modules_List::get_active_modules_list();
        $megamenu_settings = ele_get_option( Init::$megamenu_settings_key, array() );
        $menu_term = get_term_by( 'slug', $menu_slug, 'nav_menu' );

        // Check if the megamenu module is active and enabled for the menu location
        if ( in_array( 'mega-menu', array_keys( $active_modules_list ) )
            && isset( $menu_term->term_id )
            && isset( $megamenu_settings[ 'menu_location_' . $menu_term->term_id ] )
            && $megamenu_settings[ 'menu_location_' . $menu_term->term_id ]['ele_is_enabled'] == '1' ) {
            $is_megamenu_enabled = 1;
        }

        wp_cache_set( $cache_key, $is_megamenu_enabled );
        return $is_megamenu_enabled;
    }

    // Check if a menu item is a megamenu item
    public function is_megamenu_item( $menu_item_meta, $menu ) {
        if ( $this->is_megamenu( $menu ) == 1 && $menu_item_meta['menu_enable'] == 1 && class_exists( 'Elementor\Plugin' ) ) {
            return true;
        }
        return false;
    }

    // Start the level output for the menu
    public function start_lvl( &$output, $depth = 0, $args = array() ) {
        $indentation  = str_repeat( "\t", $depth );
        $output .= "\n$indentation<ul class=\"easyelements-dropdown easyelements-submenu-panel\">\n";
    }

    // End the level output for the menu
    public function end_lvl( &$output, $depth = 0, $args = array() ) {
        $indentation  = str_repeat( "\t", $depth );
        $output .= "$indentation</ul>\n";
    }

    // Start the element output for the menu item
    public function start_el( &$output, $menu_item, $depth = 0, $args = array(), $id = 0 ) {
        $indentation    = ( $depth ) ? str_repeat( "\t", $depth ) : '';
        $menu_classes   = empty( $menu_item->classes ) ? array() : (array) $menu_item->classes;
        $menu_classes[] = 'menu-item-' . $menu_item->ID;

        $class_names = join( ' ', apply_filters( 'nav_menu_css_class', array_filter( $menu_classes ), $menu_item, $args, $depth ) );
        $class_names     .= ' nav-item';
        $menu_item_meta        = $this->get_item_meta( $menu_item->ID );
        $is_megamenu_item = $this->is_megamenu_item( $menu_item_meta, $args->menu );

        // Add additional classes if the item has children or is a megamenu item
        if ( in_array( 'menu-item-has-children', $menu_classes ) || $is_megamenu_item == true ) {
            $class_names .= ' easyelements-dropdown-has ' . $menu_item_meta['vertical_megamenu_position_type'] . ' easyelements-dropdown-menu-' . $menu_item_meta['megamenu_width_type'];
        }

        if ( $is_megamenu_item == true ) {
            $class_names .= ' easyelements-megamenu-has';
        }

        if ( $menu_item_meta['mobile_submenu_content_type'] == 'builder_content' ) {
            $class_names .= ' easyelements-mobile-builder-content';
        }

        if ( in_array( 'current-menu-item', $menu_classes ) ) {
            $class_names .= ' active';
        }

        $class_names = $class_names ? ' class="' . esc_attr( $class_names ) . '"' : '';

        $menu_item_id = apply_filters( 'nav_menu_item_id', 'menu-item-' . $menu_item->ID, $menu_item, $args, $depth );
        $menu_item_id = $menu_item_id ? ' id="' . esc_attr( $menu_item_id ) . '"' : '';

        // Set data attributes based on the menu item meta
        $data_attribute = '';
        switch ( $menu_item_meta['megamenu_width_type'] ) {
            case 'default_width':
                $data_attribute = esc_attr( ' data-vertical-menu=750px' );
                break;

            case 'full_width':
                $data_attribute = ' data-vertical-menu=""';
                break;

            case 'custom_width':
                $data_attribute = $menu_item_meta['vertical_menu_width'] === '' ? esc_attr( ' data-vertical-menu=750px' ) : esc_attr( ' data-vertical-menu=' . $menu_item_meta['vertical_menu_width'] );
                break;

            default:
                $data_attribute = esc_attr( ' data-vertical-menu=750px' );
                break;
        }

        $output        .= $indentation . '<li' . $menu_item_id . $class_names . $data_attribute . '>';
        $anchor_attributes           = array();
        $anchor_attributes['title']  = ! empty( $menu_item->attr_title ) ? $menu_item->attr_title : '';
        $anchor_attributes['target'] = ! empty( $menu_item->target ) ? $menu_item->target : '';
        $anchor_attributes['rel']    = ! empty( $menu_item->xfn ) ? $menu_item->xfn : '';
        $anchor_attributes['href']   = ! empty( $menu_item->url ) ? $menu_item->url : '';

        $submenu_indicator_icon = '';

        // Add classes and indicators for top-level menu items
        if ( $depth === 0 ) {
            $anchor_attributes['class'] = 'ele-menu-nav-link';
        }
        if ( $depth === 0 && in_array( 'menu-item-has-children', $menu_classes ) ) {
            $anchor_attributes['class'] .= ' ele-menu-dropdown-toggle';
        }
        if ( in_array( 'menu-item-has-children', $menu_classes ) || $is_megamenu_item == true ) {
            if(!empty($args->submenu_indicator_icon)) {
                $submenu_indicator_icon .= $args->submenu_indicator_icon;
            } else {
                $submenu_indicator_icon .= '<i aria-hidden="true" class="ele ele-down-arrow easyelements-submenu-indicator"></i>';
            }
        }
        if ( $depth > 0 ) {
            $manual_class   = array_values( $menu_classes )[0] . ' ' . 'dropdown-item';
            $anchor_attributes ['class'] = $manual_class;
        }
        if ( in_array( 'current-menu-item', $menu_item->classes ) ) {
            $anchor_attributes['class'] .= ' active';
        }

        $anchor_attributes       = apply_filters( 'nav_menu_link_attributes', $anchor_attributes, $menu_item, $args, $depth );
        $attributes_list = '';
        foreach ( $anchor_attributes as $attr => $value ) {
            if ( ! empty( $value ) ) {
                $value       = ( 'href' === $attr ) ? esc_url( $value ) : esc_attr( $value );
                $attributes_list .= ' ' . $attr . '="' . $value . '"';
            }
        }
        $item_output = $args->before;
        $item_output .= '<a' . $attributes_list . '>';

        // Add badge and icon for megamenu items
        if ( $this->is_megamenu( $args->menu ) == 1 ) {
            if ( $menu_item_meta['menu_badge_text'] != '' ) {
                $badge_style        = 'background:' . $menu_item_meta['menu_badge_background'] . '; color:' . $menu_item_meta['menu_badge_color'];
                $badge_carret_style = 'border-top-color:' . $menu_item_meta['menu_badge_background'];
                $item_output       .= '<span style="' . $badge_style . '" class="ele-menu-badge">' . $menu_item_meta['menu_badge_text'] . '<i style="' . $badge_carret_style . '" class="ele-menu-badge-arrow"></i></span>';
            }

            if ( $menu_item_meta['menu_icon'] != '' ) {
                $icon_style   = 'color:' . $menu_item_meta['menu_icon_color'];
                $item_output .= '<i class="ele-menu-icon ' . $menu_item_meta['menu_icon'] . '" style="' . $icon_style . '" ></i>';
            }
        }

        $item_output .= $args->link_before . apply_filters( 'the_title', $menu_item->title, $menu_item->ID ) . $args->link_after;
        $item_output .= $submenu_indicator_icon . '</a>';
        $item_output .= $args->after;

        $output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $menu_item, $depth, $args );
    }

    // End the element output for the menu item
    public function end_el( &$output, $menu_item, $depth = 0, $args = array() ) {
        if ( $depth === 0 ) {
            if ( $this->is_megamenu( $args->menu ) == 1 ) {
                $menu_item_meta = $this->get_item_meta( $menu_item->ID );
                if ( $menu_item_meta['menu_enable'] == 1 && class_exists( 'Elementor\Plugin' ) ) {
                    $builder_post_title = 'dynamic-content-megamenu-menuitem' . $menu_item->ID;
                    $builder_post = ele_get_page_by_title( $builder_post_title, 'easyelements_content' );
                    $output .= '<div class="easyelements-megamenu-panel">';
                    if ( $builder_post != null ) {
                        $elementor_instance = \Elementor\Plugin::instance();
                        $megamenu_output = $elementor_instance->frontend->get_builder_content_for_display( $builder_post->ID );

                        if(!empty($menu_item_meta['megamenu_ajax_load']) && $menu_item_meta['megamenu_ajax_load'] == 'yes') {
                            $megamenu_output = sprintf('<div class="megamenu-ajax-load" data-id="%1$s"></div>', $builder_post->ID);
                        }

                        $output .= $megamenu_output;
                    } else {
                        $output .= esc_html__( 'No content found', 'easyelements' );
                    }

                    $output .= '</div>';
                }
            }
            $output .= "</li>\n";
        }
    }
}