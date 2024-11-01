<?php
/**
 * Admin class
 *
 * @author  Yithemes
 * @package YITH WooCommerce EU Energy Label
 * @version 1.0.0
 */

if ( !defined( 'YITH_WCEUE' ) ) {
    exit;
} // Exit if accessed directly

if ( !class_exists( 'YITH_WCEUE_Admin' ) ) {
    /**
     * Admin class.
     * The class manage all the Admin behaviors.
     *
     * @author   Leanza Francesco <leanzafrancesco@gmail.com>
     * @since    1.0.0
     *
     */
    class YITH_WCEUE_Admin {

        /**
         * Single instance of the class
         *
         * @var YITH_WCEUE_Admin
         * @since 1.0.0
         */
        protected static $_instance;

        /** @var YIT_Plugin_Panel_WooCommerce Panel Object */
        protected $_panel;

        /** @var string Premium version landing link */
        protected $_premium_landing = 'https://yithemes.com/themes/plugins/yith-woocommerce-eu-energy-label';

        /** @var string panel page */
        protected $_panel_page = 'yith_wceue_panel';

        /** @var string doc url */
        public $doc_url = 'http://yithemes.com/docs-plugins/yith-woocommerce-eu-energy-label/';

        /**
         * Returns single instance of the class
         *
         * @return YITH_WCEUE_Admin
         * @since 1.0.0
         */
        public static function get_instance() {
            $self = __CLASS__ . ( class_exists( __CLASS__ . '_Premium' ) ? '_Premium' : '' );

            return !is_null( $self::$_instance ) ? $self::$_instance : $self::$_instance = new $self;
        }

        /**
         * Constructor
         *
         * @access public
         * @since  1.0.0
         */
        protected function __construct() {
            add_action( 'admin_menu', array( $this, 'register_panel' ), 5 );

            //Add action links
            add_filter( 'plugin_action_links_' . plugin_basename( YITH_WCEUE_DIR . '/' . basename( YITH_WCEUE_FILE ) ), array( $this, 'action_links' ) );
            add_filter( 'plugin_row_meta', array( $this, 'plugin_row_meta' ), 10, 4 );

            add_action( 'admin_enqueue_scripts', array( $this, 'admin_enqueue_scripts' ) );

            // ADD EU Energy Label Tab to product data tabs
            add_filter( 'woocommerce_product_data_tabs', array( $this, 'add_product_data_tabs' ) );
            add_action( 'woocommerce_product_data_panels', array( $this, 'add_product_data_panels' ) );
            add_action( 'woocommerce_process_product_meta', array( $this, 'save_product_meta' ) );

            // Premium Tabs
            add_action( 'yith_wceue_premium_tab', array( $this, 'show_premium_tab' ) );
        }

        /**
         * add EU Energy Label Tab [in product wc-metabox]
         *
         * @access public
         * @since  1.0.0
         * @author Leanza Francesco <leanzafrancesco@gmail.com>
         */
        public function add_product_data_tabs( $product_data_tabs ) {
            $product_data_tabs[ 'yith_eu_energy_label' ] = array(
                'label'  => _x( 'EU Energy Label', 'Title of product data tab', 'yith-woocommerce-eu-energy-label' ),
                'target' => 'yith_eu_energy_label_data',
            );

            return $product_data_tabs;
        }

        /**
         * add panel for EU Energy Label Tab [in product wc-metabox]
         *
         * @access public
         * @since  1.0.0
         * @author Leanza Francesco <leanzafrancesco@gmail.com>
         */
        public function add_product_data_panels() {
            global $post;
            $meta         = get_post_meta( $post->ID, '_yith_wceue_eu_meta', true );
            $energy_label = get_post_meta( $post->ID, '_yith_wceue_eu_energy_label', true );

            $default = array(
                'energy_label' => $energy_label,
            );

            $meta = wp_parse_args( $meta, $default );

            wc_get_template( '/admin/eu_energy_panel.php', $meta, YITH_WCEUE_TEMPLATE_PATH, YITH_WCEUE_TEMPLATE_PATH );
        }

        /**
         * Save EU Energy Label Data
         *
         * @access public
         * @since  1.0.0
         * @author Leanza Francesco <leanzafrancesco@gmail.com>
         */
        public function save_product_meta( $post_id ) {
            $meta         = isset( $_POST[ '_yith_wceue_eu_meta' ] ) ? $_POST[ '_yith_wceue_eu_meta' ] : false;
            $energy_label = isset( $_POST[ '_yith_wceue_eu_energy_label' ] ) ? $_POST[ '_yith_wceue_eu_energy_label' ] : false;

            update_post_meta( $post_id, '_yith_wceue_eu_meta', $meta );
            update_post_meta( $post_id, '_yith_wceue_eu_energy_label', $energy_label );
        }

        /**
         * Action Links
         *
         * add the action links to plugin admin page
         *
         * @param $links | links plugin array
         *
         * @return   mixed Array
         * @since    1.0
         * @author   Leanza Francesco <leanzafrancesco@gmail.com>
         * @return mixed
         * @use      plugin_action_links_{$plugin_file_name}
         */
        public function action_links( $links ) {

            $links[] = '<a href="' . admin_url( "admin.php?page={$this->_panel_page}" ) . '">' . __( 'Settings', 'yith-woocommerce-eu-energy-label' ) . '</a>';
            if ( defined( 'YITH_WCEUE_FREE_INIT' ) ) {
                $links[] = '<a href="' . $this->_premium_landing . '" target="_blank">' . __( 'Premium Version', 'yith-woocommerce-eu-energy-label' ) . '</a>';
            }

            return $links;
        }

        /**
         * plugin_row_meta
         *
         * add the action links to plugin admin page
         *
         * @param $plugin_meta
         * @param $plugin_file
         * @param $plugin_data
         * @param $status
         *
         * @return   array
         * @since    1.0
         * @author   Leanza Francesco <leanzafrancesco@gmail.com>
         * @use      plugin_row_meta
         */
        public function plugin_row_meta( $plugin_meta, $plugin_file, $plugin_data, $status ) {

            if ( ( defined( 'YITH_WCEUE_FREE_INIT' ) && YITH_WCEUE_FREE_INIT == $plugin_file ) || ( defined( 'YITH_WCEUE_INIT' ) && YITH_WCEUE_INIT == $plugin_file ) ) {
                $plugin_meta[] = '<a href="' . $this->doc_url . '" target="_blank">' . __( 'Plugin Documentation', 'yith-woocommerce-eu-energy-label' ) . '</a>';
            }

            return $plugin_meta;
        }

        /**
         * Add a panel under YITH Plugins tab
         *
         * @return   void
         * @since    1.0
         * @author   Leanza Francesco <leanzafrancesco@gmail.com>
         * @use      /Yit_Plugin_Panel class
         * @see      plugin-fw/lib/yit-plugin-panel.php
         */
        public function register_panel() {

            if ( !empty( $this->_panel ) ) {
                return;
            }

            $admin_tabs_free = array(
                'settings' => _x( 'Settings', 'tab name in "YIT Plugins" menu', 'yith-woocommerce-eu-energy-label' ),
                'premium'       => _x( 'Premium Version', 'tab name in "YIT Plugins" menu', 'yith-woocommerce-eu-energy-label' )
            );

            $admin_tabs = apply_filters( 'yith_wceue_settings_admin_tabs', $admin_tabs_free );

            $args = array(
                'create_menu_page' => true,
                'parent_slug'      => '',
                'page_title'       => _x( 'EU Energy Label', 'plugin name in admin page title', 'yith-woocommerce-eu-energy-label' ),
                'menu_title'       => _x( 'EU Energy Label', 'plugin name in admin WP menu', 'yith-woocommerce-eu-energy-label' ),
                'capability'       => 'manage_options',
                'parent'           => '',
                'parent_page'      => 'yit_plugin_panel',
                'page'             => $this->_panel_page,
                'admin-tabs'       => $admin_tabs,
                'options-path'     => YITH_WCEUE_DIR . '/plugin-options'
            );


            /* === Fixed: not updated theme  === */
            if ( !class_exists( 'YIT_Plugin_Panel_WooCommerce' ) ) {
                require_once( 'plugin-fw/lib/yit-plugin-panel-wc.php' );
            }

            $this->_panel = new YIT_Plugin_Panel_WooCommerce( $args );
        }

        public function admin_enqueue_scripts() {
            wp_enqueue_style( 'yith_wceue_admin_style', YITH_WCEUE_ASSETS_URL . '/css/admin.css' );
        }

        /**
         * Show premium landing tab
         *
         * @return   void
         * @since    1.0
         * @author   Leanza Francesco <leanzafrancesco@gmail.com>
         */
        public function show_premium_tab() {
            $landing = YITH_WCEUE_TEMPLATE_PATH . '/premium.php';
            file_exists( $landing ) && require( $landing );
        }

        /**
         * Get the premium landing uri
         *
         * @since   1.0.0
         * @author  Leanza Francesco <leanzafrancesco@gmail.com>
         * @return  string The premium landing link
         */
        public function get_premium_landing_uri() {
            return defined( 'YITH_REFER_ID' ) ? $this->_premium_landing . '?refer_id=' . YITH_REFER_ID : $this->_premium_landing . '?refer_id=1030585';
        }
    }
}

/**
 * Unique access to instance of YITH_WCEUE_Admin class
 *
 * @return YITH_WCEUE_Admin|YITH_WCEUE_Admin_Premium
 * @since 1.0.0
 */
function YITH_WCEUE_Admin() {
    return YITH_WCEUE_Admin::get_instance();
}