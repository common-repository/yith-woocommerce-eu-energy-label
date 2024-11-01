<?php

if ( !defined( 'YITH_WCEUE' ) ) {
    exit;
} // Exit if accessed directly

$settings = array(

    'settings' => array(

        'general-options'            => array(
            'title' => __( 'General Options', 'yith-woocommerce-eu-energy-label' ),
            'type'  => 'title',
            'desc'  => '',
            'id'    => 'yith-wceue-general-options'
        ),
        'position-in-single-product' => array(
            'name'    => __( 'Position in single product page', 'yith-woocommerce-eu-energy-label' ),
            'type'    => 'select',
            'desc'    => __( 'Select where you want to show the EU Energy Label in single product page.', 'yith-woocommerce-eu-energy-label' ),
            'id'      => 'yith-wceue-position-in-single-product',
            'options' => array(
                'on_thumb'           => __( 'On product thumbnail', 'yith-woocommerce-eu-energy-label' ),
                'before_summary'     => __( 'Above summary', 'yith-woocommerce-eu-energy-label' ),
                'before_description' => __( 'Above description', 'yith-woocommerce-eu-energy-label' ),
                'after_description'  => __( 'Below description', 'yith-woocommerce-eu-energy-label' ),
                'after_add_to_cart'  => __( 'Below "Add to Cart" button', 'yith-woocommerce-eu-energy-label' ),
                'after_summary'      => __( 'Below summary', 'yith-woocommerce-eu-energy-label' ),
            ),
            'default' => 'before_summary'
        ),
        'show-in-shop-thumb'         => array(
            'id'      => 'yith-wceue-show-in-shop-thumb',
            'name'    => __( 'Show on shop thumbnails', 'yith-woocommerce-eu-energy-label' ),
            'type'    => 'checkbox',
            'desc'    => __( 'Set this option to show EU Energy Labels on product thumbnails in the shop page.', 'yith-woocommerce-eu-energy-label' ),
            'default' => 'no'
        ),
        'general-options-end'        => array(
            'type' => 'sectionend',
            'id'   => 'yith-wceue-general-options'
        )
    )
);

return apply_filters( 'yith_wceue_panel_settings_options', $settings );