<?php
/**
 * Frontend class
 *
 * @author  Yithemes
 * @package YITH WooCommerce EU Energy Label
 * @version 1.1.1
 */

if ( !defined( 'YITH_WCEUE' ) ) {
    exit;
} // Exit if accessed directly

if ( !class_exists( 'YITH_WCEUE_Frontend' ) ) {
    /**
     * Frontend class.
     * The class manage all the Frontend behaviors.
     *
     * @author   Leanza Francesco <leanzafrancesco@gmail.com>
     * @since    1.0.0
     *
     */
    class YITH_WCEUE_Frontend {

        /**
         * Single instance of the class
         *
         * @var \YITH_WCEUE_Frontend
         * @since 1.0.0
         */
        protected static $_instance;

        public $is_in_sidebar = false;

        public $show_on_product = false;
        public $show_in_shop    = false;

        /**
         * Returns single instance of the class
         *
         * @return \YITH_WCEUE_Frontend
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
            // add frontend css
            add_action( 'wp_enqueue_scripts', array( $this, 'enqueue_scripts' ) );

            $this->add_energy_label_in_position();

            // action to set this->is_in_sidebar
            add_action( 'dynamic_sidebar_before', array( $this, 'set_is_in_sidebar' ) );
            add_action( 'dynamic_sidebar_after', array( $this, 'unset_is_in_sidebar' ) );

            $this->show_in_shop = get_option( 'yith-wceue-show-in-shop-thumb', 'no' ) == 'yes';
            add_filter( 'post_thumbnail_html', array( $this, 'add_energy_label_on_shop_thumb' ), 10, 2 );
        }

        /**
         * Add Energy Label on shop thumbnails
         *
         * @access   public
         * @since    1.0.0
         * @author   Leanza Francesco <leanzafrancesco@gmail.com>
         */
        public function add_energy_label_on_shop_thumb( $thumb, $post_id ) {
            $show = !$this->is_in_sidebar && !is_cart() && !is_checkout();
            $show = is_archive() ? ( $show && $this->show_in_shop ) : $show;
            $show = is_product() ? ( $show && $this->show_on_product ) : $show;

            $show = apply_filters( 'yith_wceue_show_energy_label_on_product', $show, $post_id );

            if ( $show ) {
                return $this->show_energy_on_product( $thumb, $post_id );
            } else {
                return $thumb;
            }
        }

        /**
         * Edit image in products
         *
         * @access public
         * @return string
         *
         * @param $val string product image
         *
         * @since  1.0.0
         * @author Leanza Francesco <leanzafrancesco@gmail.com>
         */
        public function show_energy_on_product( $thumb, $post_id ) {
            $meta         = get_post_meta( $post_id, '_yith_wceue_eu_meta', true );
            $energy_label = get_post_meta( $post_id, '_yith_wceue_eu_energy_label', true );

            if ( $energy_label <= 0 )
                return $thumb;

            // prevent multiple badge copies
            if ( strpos( $thumb, 'yith-wceue-thumb-and-energy-container' ) > 0 )
                return $thumb;

            $container = "<div class='yith-wceue-thumb-and-energy-container'>" . $thumb;

            $t_args = array(
                'class'        => 'yith-wceue-eu-energy-label-mini',
                'energy_label' => $energy_label,
                'product_id'   => $post_id,
                'meta'         => $meta
            );

            ob_start();
            wc_get_template( '/energy_label.php', $t_args, YITH_WCEUE_TEMPLATE_PATH, YITH_WCEUE_TEMPLATE_PATH );
            $container .= ob_get_clean();

            $container .= "</div><!--yith-wceue-thumb-and-energy-container-->";

            return $container;
        }


        /**
         * Add Energy Label in position set in Settings Tab
         *
         * @access   public
         * @since    1.0.0
         * @author   Leanza Francesco <leanzafrancesco@gmail.com>
         */
        public function add_energy_label_in_position() {
            $button_position = get_option( 'yith-wceue-position-in-single-product', 'before_summary' );
            $bp_array        = array( 'action' => 'woocommerce_after_single_product_summary', 'priority' => 9 );
            switch ( $button_position ) {
                case 'on_thumb':
                    add_filter( 'woocommerce_single_product_image_html', array( $this, 'show_energy_on_product' ), 10, 2 );
                    $this->show_on_product = true;

                    return;
                    break;
                case 'before_summary':
                    $bp_array = array( 'action' => 'woocommerce_before_single_product_summary', 'priority' => 25 );
                    break;
                case 'before_description':
                    $bp_array = array( 'action' => 'woocommerce_single_product_summary', 'priority' => 15 );
                    break;
                case 'after_description':
                    $bp_array = array( 'action' => 'woocommerce_single_product_summary', 'priority' => 25 );
                    break;
                case 'after_add_to_cart':
                    $bp_array = array( 'action' => 'woocommerce_single_product_summary', 'priority' => 35 );
                    break;
                case 'after_summary':
                    $bp_array = array( 'action' => 'woocommerce_after_single_product_summary', 'priority' => 9 );
                    break;
            }
            add_action( $bp_array[ 'action' ], array( $this, 'print_energy_label' ), $bp_array[ 'priority' ] );
        }

        /**
         * Print Best Sellers Icon
         *
         * @access   public
         * @since    1.0.0
         *
         * @author   Leanza Francesco <leanzafrancesco@gmail.com>
         */
        public function print_energy_label() {
            global $product;

            $base_product_id = yit_get_base_product_id( $product );

            $meta         = get_post_meta( $base_product_id, '_yith_wceue_eu_meta', true );
            $energy_label = get_post_meta( $base_product_id, '_yith_wceue_eu_energy_label', true );
            $t_args       = array(
                'class'        => '',
                'energy_label' => $energy_label,
                'product_id'   => $base_product_id,
                'meta'         => $meta
            );
            wc_get_template( '/energy_label.php', $t_args, YITH_WCEUE_TEMPLATE_PATH, YITH_WCEUE_TEMPLATE_PATH );
        }

        /**
         * Set this->is in sidebar to true
         *
         * @access public
         * @since  1.1.4
         * @author Leanza Francesco <leanzafrancesco@gmail.com>
         */
        public function set_is_in_sidebar() {
            $this->is_in_sidebar = true;
        }

        /**
         * Set this->is in sidebar to false
         *
         * @access public
         * @since  1.1.4
         * @author Leanza Francesco <leanzafrancesco@gmail.com>
         */
        public function unset_is_in_sidebar() {
            $this->is_in_sidebar = false;
        }


        public function enqueue_scripts() {
            wp_enqueue_style( 'yith_wceue_frontend_style', YITH_WCEUE_ASSETS_URL . '/css/frontend.css' );
        }
    }
}
/**
 * Unique access to instance of YITH_WCEUE_Frontend class
 *
 * @return YITH_WCEUE_Frontend|YITH_WCEUE_Frontend_Premium
 * @since 1.0.0
 */
function YITH_WCEUE_Frontend() {
    return YITH_WCEUE_Frontend::get_instance();
}