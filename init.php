<?php
/**
 * Plugin Name: YITH WooCommerce EU Energy Label
 * Plugin URI: https://yithemes.com/themes/plugins/yith-woocommerce-eu-energy-label
 * Description: YITH WooCommerce EU Energy Label allows you to assign EU Energy Labels to your products.
 * Version: 1.1.2
 * Author: YITHEMES
 * Author URI: http://yithemes.com/
 * Text Domain: yith-woocommerce-eu-energy-label
 * Domain Path: /languages/
 * WC requires at least: 3.0.0
 * WC tested up to: 3.3.x
 *
 * @author Yithemes
 * @package YITH WooCommerce EU Energy Label
 * @version 1.1.2
 */
/*  Copyright 2015  Your Inspiration Themes  (email : plugins@yithemes.com)

This program is free software; you can redistribute it and/or modify
it under the terms of the GNU General Public License, version 2, as
published by the Free Software Foundation.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program; if not, write to the Free Software
Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
*/

/* == COMMENT == */

if ( !defined( 'ABSPATH' ) ) {
    exit;
} // Exit if accessed directly

if ( !function_exists( 'is_plugin_active' ) ) {
    require_once( ABSPATH . 'wp-admin/includes/plugin.php' );
}

function yith_wceue_install_woocommerce_admin_notice() {
    ?>
    <div class="error">
        <p><?php _e( 'YITH WooCommerce EU Energy Label is enabled but not effective. It requires WooCommerce in order to work.', 'yith-woocommerce-eu-energy-label' ); ?></p>
    </div>
    <?php
}


function yith_wceue_install_free_admin_notice() {
    ?>
    <div class="error">
        <p><?php _e( 'You can\'t activate the free version of YITH WooCommerce EU Energy Label while you are using the premium one.', 'yith-woocommerce-eu-energy-label' ); ?></p>
    </div>
    <?php
}

if ( !function_exists( 'yith_plugin_registration_hook' ) ) {
    require_once 'plugin-fw/yit-plugin-registration-hook.php';
}
register_activation_hook( __FILE__, 'yith_plugin_registration_hook' );


if ( !defined( 'YITH_WCEUE_VERSION' ) ) {
    define( 'YITH_WCEUE_VERSION', '1.1.2' );
}

if ( !defined( 'YITH_WCEUE_FREE_INIT' ) ) {
    define( 'YITH_WCEUE_FREE_INIT', plugin_basename( __FILE__ ) );
}

if ( !defined( 'YITH_WCEUE' ) ) {
    define( 'YITH_WCEUE', true );
}

if ( !defined( 'YITH_WCEUE_FILE' ) ) {
    define( 'YITH_WCEUE_FILE', __FILE__ );
}

if ( !defined( 'YITH_WCEUE_URL' ) ) {
    define( 'YITH_WCEUE_URL', plugin_dir_url( __FILE__ ) );
}

if ( !defined( 'YITH_WCEUE_DIR' ) ) {
    define( 'YITH_WCEUE_DIR', plugin_dir_path( __FILE__ ) );
}

if ( !defined( 'YITH_WCEUE_TEMPLATE_PATH' ) ) {
    define( 'YITH_WCEUE_TEMPLATE_PATH', YITH_WCEUE_DIR . 'templates' );
}

if ( !defined( 'YITH_WCEUE_ASSETS_URL' ) ) {
    define( 'YITH_WCEUE_ASSETS_URL', YITH_WCEUE_URL . 'assets' );
}


function yith_wceue_init() {

    load_plugin_textdomain( 'yith-woocommerce-eu-energy-label', false, dirname( plugin_basename( __FILE__ ) ) . '/languages/' );

    // Load required classes and functions
    require_once( 'class.yith-wceue-admin.php' );
    require_once( 'class.yith-wceue-frontend.php' );
    require_once( 'class.yith-wceue.php' );
    require_once( 'functions.yith-wceue.php' );

    // Let's start the game!
    YITH_WCEUE();
}

add_action( 'yith_wceue_init', 'yith_wceue_init' );


function yith_wceue_plugin_install() {

    if ( !function_exists( 'WC' ) ) {
        add_action( 'admin_notices', 'yith_wceue_install_woocommerce_admin_notice' );
    } elseif ( defined( 'YITH_WCEUE_PREMIUM' ) ) {
        add_action( 'admin_notices', 'yith_wceue_install_free_admin_notice' );
        deactivate_plugins( plugin_basename( __FILE__ ) );
    } else {
        do_action( 'yith_wceue_init' );
    }
}

add_action( 'plugins_loaded', 'yith_wceue_plugin_install', 11 );

/* Plugin Framework Version Check */
if ( !function_exists( 'yit_maybe_plugin_fw_loader' ) && file_exists( plugin_dir_path( __FILE__ ) . 'plugin-fw/init.php' ) ) {
    require_once( plugin_dir_path( __FILE__ ) . 'plugin-fw/init.php' );
}
yit_maybe_plugin_fw_loader( plugin_dir_path( __FILE__ ) );