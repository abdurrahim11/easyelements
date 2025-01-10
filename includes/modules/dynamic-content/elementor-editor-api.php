<?php

namespace EasyElements\Modules\Dynamic_Content;

use EasyElements\Core\Handler_Api;

class Elementor_Editor_Api  extends Handler_Api {

    public function initialize_config() {
        $this->prefix = 'dynamic-content';
        $this->param  = '/(?P<type>\w+)/(?P<key>\w+(|[-]\w+))/';
    }

    public function get_content_editor() {
        $content_key  = $this->request['key'];
        $content_type = $this->request['type'];

        $editor_post_title = 'dynamic-content-' . $content_type . '-' . $content_key;
        $editor_post_id    = ele_get_page_by_title( $editor_post_title, 'easyelements_content' );

        if ( is_null( $editor_post_id ) ) {
            $post_defaults = array(
                'post_content' => '',
                'post_title'   => $editor_post_title,
                'post_status'  => 'publish',
                'post_type'    => 'easyelements_content',
            );
            $editor_post_id = wp_insert_post( $post_defaults );
            update_post_meta( $editor_post_id, '_wp_page_template', 'elementor_canvas' );
        } else {
            $editor_post_id = $editor_post_id->ID;
        }

        // Check if WPML is active and not set for this post
        if ( defined( 'ICL_SITEPRESS_VERSION' ) ) {
            $editor_post_id = $this->apply_wpml_settings($editor_post_id);
        }

        $redirect_url = admin_url( 'post.php?post=' . $editor_post_id . '&action=elementor' );
        wp_safe_redirect( $redirect_url );
        exit;
    }

    public function apply_wpml_settings($editor_post_id) {
        global $sitepress;
        $default_language = $sitepress->get_default_language();
        $wpml_element_type = apply_filters( 'wpml_element_type', 'easyelements_content' );
        $translation_id = $sitepress->get_element_trid( $editor_post_id, $wpml_element_type );
        if( ! $translation_id ) {
            $sitepress->set_element_language_details( $editor_post_id, $wpml_element_type, false, $default_language, null, false );
        }

        // Get WPML post by language code
        $referer_url = wp_get_referer();
        $parsed_referer = wp_parse_url($referer_url);
        $referer_query = !empty($parsed_referer['query']) ? $parsed_referer['query'] : '';
        parse_str($referer_query, $referer_args);

        if( !empty($referer_args['post']) ) {
            $language_details = apply_filters( 'wpml_post_language_details', NULL, $referer_args['post'] );
            if( !is_wp_error($language_details) ) {
                $editor_post_id = apply_filters( 'wpml_object_id', $editor_post_id, 'easyelements_content', true, $language_details['language_code'] );
            }
        }

        return $editor_post_id;
    }
}