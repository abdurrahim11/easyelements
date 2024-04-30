<?php
/**
 * Nav menu page MegaMenu trigger template
 */

defined( 'ABSPATH' ) || exit;
?>
<script>
    var easyelements_options_megamenu_markup = `
    <div class="ele-megamenu-trigger" id="ele-megamenu-trigger">
        <div class="ele-setting-switcher">
            <input name="ele_is_enabled" type="checkbox" <?php checked( ( isset( $data['ele_is_enabled'] ) ? $data['ele_is_enabled'] : '' ), '1' ); ?> value="1" id="easyelements-menu-metabox-input-is-enabled" value="1">
            <label for="easyelements-menu-metabox-input-is-enabled"></label>
        </div>
        <h3 class="ele-dashboard-widgets__item-title">
            <label for="ele-menu-metabox-input-is-enabled"><?php esc_html_e( 'EasyElements Menu', 'easy-elements' ); ?></label>
        </h3>
    </div>
    `;
    var easyelements_megamenu_nonce = `<?php echo esc_attr( wp_create_nonce( 'wp_rest' ) ); ?>`;
</script>
