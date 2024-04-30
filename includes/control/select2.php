<?php


namespace EasyElements\Control;


use Elementor\Base_Data_Control;

class Select2 extends Base_Data_Control {



    const TYPE = 'ele-advanced-select2';

    /**
     * Set control type.
     */
    public function get_type() {
        return self::TYPE;
    }

    public function enqueue() {
        wp_enqueue_script(
            'ele-advanced-select2',
            ELE_PLUGIN_URL . 'includes/control/assets/js/select2.js',
            array( 'jquery-elementor-select2' ),
            ELE_VERSION,
            true
        );
        wp_localize_script(
            'ele-advanced-select2',
            'ele_elementor_select_localize',
            array(
                'ajaxurl'     => admin_url( 'admin-ajax.php' ),
                'search_text' => esc_html__( 'Search', 'ele-elementor-addons' ),
                'nonce'       => wp_create_nonce( 'ele-select-nonce' ),
            )
        );
    }

    /**
     * control field markup
     */
    public function content_template() {
        $control_uid = $this->get_control_uid();
        ?>
        <# var controlUID = '<?php echo esc_attr( $control_uid ); ?>'; #>
        <# var currentID = elementor.panel.currentView.currentPageView.model.attributes.settings.attributes[data.name]; #>
        <div class="elementor-control-field">
            <# if ( data.label ) { #>
            <label for="<?php echo esc_attr( $control_uid ); ?>" class="elementor-control-title">{{{data.label
                }}}</label>
            <# } #>
            <div class="elementor-control-input-wrapper elementor-control-unit-5">
                <# var multiple = ( data.multiple ) ? 'multiple' : ''; #>
                <select id="<?php echo esc_attr( $control_uid ); ?>" {{ multiple }} class="ele-select"
                        data-setting="{{ data.name }}"></select>
            </div>
        </div>
        <#
        ( function( $ ) {
        $( document.body ).trigger( 'ele_elementor_select_init',{currentID:data.controlValue,data:data,controlUID:controlUID,multiple:data.multiple} );
        }( jQuery ) );
        #>
        <?php
    }

    /**
     * Set default settings
     */
    protected function get_default_settings() {
        return array(
            'multiple'    => false,
            'source_name' => 'post_type',
            'source_type' => 'post',
        );
    }
}
