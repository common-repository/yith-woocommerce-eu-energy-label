<?php
/**
 * Template for EU Energy Label in Frontend
 *
 * @author  Yithemes
 * @package YITH WooCommerce EU Energy Label
 * @version 1.0.0
 */

if ( !defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
}
$energy_label_array = yith_wceue_get_energy_label_array();


if ( is_array( $meta ) )
    extract( $meta );
?>

<?php if ( $energy_label > 0 ) : ?>

    <div class="yith-wceue-eu-energy-label yith-wceue-eu-energy-label-<?php echo $energy_label ?> <?php echo $class?>">
        <?php echo $energy_label_array[ $energy_label ] ?>
    </div>

<?php endif; ?>