<?php
/**
 * Template for EU Energy Label Panel in Product Editing
 *
 * @author  Yithemes
 * @package YITH WooCommerce EU Energy Label
 * @version 1.0.0
 */

if ( !defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
}
$energy_label_array = array_merge( array( 0 => __( 'None', 'yith-woocommerce-eu-energy-label' ) ), yith_wceue_get_energy_label_array() );
?>

<div id="yith_eu_energy_label_data" class="panel woocommerce_options_panel">

    <div class="options_group">
        <p class="form-field">
            <label for="_yith_wceue_eu_energy_label"><?php _ex( 'EU Energy Label', 'title of label for the dropdown menu in product tab', 'yith-woocommerce-eu-energy-label' ) ?></label>
            <select id="_yith_wceue_eu_energy_label" name="_yith_wceue_eu_energy_label" class="select short" style="">
                <?php foreach ( $energy_label_array as $el_id => $el_label ): ?>
                    <option value="<?php echo $el_id; ?>" <?php selected( $energy_label, $el_id ) ?> ><?php echo $el_label; ?></option>
                <?php endforeach; ?>
            </select>
            <img class="help_tip" heigth="16" width="16" data-tip="<?php _e( 'Select the EU Energy Label you want to link to this product.', 'yith-woocommerce-eu-energy-label' ); ?>" src="<?php echo WC()->plugin_url(); ?>/assets/images/help.png"/>
        </p>
    </div>

</div>