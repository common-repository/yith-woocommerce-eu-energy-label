<?php
/**
 * Main class
 *
 * @author  Yithemes
 * @package YITH WooCommerce EU Energy Label
 * @version 1.0.0
 */


if ( !defined( 'YITH_WCEUE' ) ) {
    exit;
} // Exit if accessed directly

if ( !class_exists( 'YITH_WCEUE' ) ) {
    /**
     * YITH WooCommerce EU Energy Label
     *
     * @since 1.0.0
     */
    class YITH_WCEUE {

        /**
         * Single instance of the class
         *
         * @var YITH_WCEUE
         * @since 1.0.0
         */
        private static $_instance;

        /**
         * Returns single instance of the class
         *
         * @return YITH_WCEUE
         * @since 1.0.0
         */
        public static function get_instance() {
            return !is_null( self::$_instance ) ? self::$_instance : self::$_instance = new self();
        }

        /**
         * Constructor
         *
         * @since 1.0.0
         */
        private function __construct() {

            // Load Plugin Framework
            add_action( 'plugins_loaded', array( $this, 'plugin_fw_loader' ), 15 );

            if ( is_admin() ) {
                YITH_WCEUE_Admin();
            } else {
                YITH_WCEUE_Frontend();
            }
        }

        /**
         * Load Plugin Framework
         *
         * @since  1.0
         * @access public
         * @return void
         * @author Andrea Grillo <andrea.grillo@yithemes.com>
         */
        public function plugin_fw_loader() {
            if ( !defined( 'YIT_CORE_PLUGIN' ) ) {
                global $plugin_fw_data;
                if ( !empty( $plugin_fw_data ) ) {
                    $plugin_fw_file = array_shift( $plugin_fw_data );
                    require_once( $plugin_fw_file );
                }
            }
        }
    }
}

/**
 * Unique access to instance of YITH_WCEUE class
 *
 * @return YITH_WCEUE
 * @since 1.0.0
 */
function YITH_WCEUE() {
    return YITH_WCEUE::get_instance();
}