<?php
if ( ! class_exists( 'Post_Code_Popup' ) ) {
    class Post_Code_Popup
    {
        private static $instance;
        public $version = '1.0.0';

        public static function get_instance()
        {
            if ( null === self::$instance ) {
                self::$instance = new self();
            }

            return self::$instance;
        }

        public function __construct()
        {
            add_action( 'wp_enqueue_scripts', array( $this, 'enqueue_scripts' ) );
            add_action( 'wp_footer', array( $this, 'popup_markup' ) );
            // add_filter( 'woocommerce_checkout_fields', array( $this, 'woocommerce_checkout_fields' ), 9999 );
            // add_action( 'woocommerce_check_cart_items', array( $this, 'set_customer_post_code_prop' ), 999999 );
            add_filter( 'default_checkout_shipping_postcode', array( $this, 'default_checkout_shipping_postcode' ), 9999, 2 );
            add_action( 'woocommerce_after_checkout_validation', array( $this, 'validate_post_code_on_checkout' ), 10, 2);
            add_action( 'woocommerce_thankyou', array( $this, 'save_post_code_cookie' ), 999999 );
        }
 
        public function enqueue_scripts()
        {
            wp_enqueue_style( 'post-code-popup-style', get_theme_file_uri( '/assets/css/post-code-popup.css' ), array(), $this->version );
            wp_register_script( 'post-code-popup', get_theme_file_uri( '/assets/js/post-code-popup.js' ), array( 'jquery', 'picodecheck-ajax-request' ), $this->version, true );
            
            $popup_object = array(
                'pincode' => $this->get_cookie_pin(),
            );
            wp_localize_script( 'post-code-popup', 'pin_popup_object', $popup_object );

            wp_enqueue_script( 'post-code-popup' );
        }

        public function popup_markup()
        {
             if ( is_single( array(296, 293, 291, 290, 258, 270, 255, 252, 249, 244, 241, 238, 234, 232, 229, 125, 528, 25320, 22537, 524, 1181,16833, 24396) )) {
            ?>
<div class="pc-popup">
    <div class="pc-popup-overlay"></div>
    <div class="pc-popup-modal">
        <h6 class="f-heading pnrmlstate first-div-acc">CHECK WE DELIVER RAW FOOD TO YOUR AREA</h6>
        <?php echo do_shortcode( '[phoeniixx-pincode-check]' );?>
    </div>
</div>
<?php
            }
            if ( ! is_page(array('combo-boxes', 'shop-2','apothecary','gifts','treats', 'raw-meals') )) {
                return false;
            }
            // $cookie_pin = false;
            ?>
<div class="pc-popup">
    <div class="pc-popup-overlay"></div>
    <div class="pc-popup-modal">
        <h6 class="f-heading pnrmlstate first-div-acc">CHECK WE DELIVER RAW FOOD TO YOUR AREA</h6>
        <?php echo do_shortcode( '[phoeniixx-pincode-check]' );?>
    </div>
</div>
<?php
        }

        public function woocommerce_checkout_fields( $fields )
        {
            $user_ID = get_current_user_id();
            $post_code = '';
            if(isset($user_ID) && $user_ID != 0) {
                $post_code = get_user_meta( $user_ID, 'shipping_postcode', true );
            } else {
                $post_code = $this->get_cookie_pin();
            }
            $fields['shipping']['shipping_postcode']['default'] = $post_code;
            unset( $fields['shipping']['shipping_postcode']['autocomplete'] );
            echo "<pre>"; print_r($fields); echo "</pre>";
            return $fields;
        }

        public function set_customer_post_code_prop()
        {
            WC()->customer->set_props( array(
                'shipping_postcode' => 1233 
            ) );
        }

        public function default_checkout_shipping_postcode( $value, $input )
        {
            $user_ID = get_current_user_id();
            $post_code = '';
            if( isset($user_ID) && $user_ID != 0 ) {
                $post_code = get_user_meta( $user_ID, 'shipping_postcode', true );
            } else {
                $post_code = $this->get_cookie_pin();
            }
            return $post_code;
        }

        public function validate_post_code_on_checkout( $fields, $errors )
        {
            if ( ! $this->validate_pin_code( $fields[ 'shipping_postcode' ] )  ){
                $errors->add( 'validation', 'Sorry, we don\'t deliver to this area.' );
            }

            $this->update_pin_cookie( $fields[ 'shipping_postcode' ] );
        }

        public function get_cookie_pin()
        {
            return isset( $_COOKIE['valid_pincode'] ) ? $_COOKIE['valid_pincode'] : '';
        }

        public function validate_pin_code( $code )
        {
            global $wpdb;
            $table_pin_codes = $wpdb->prefix . 'check_pincode_pro';

            $safe_zipcode = $code;
            $pincode = substr($code, 0, 3);

            if ( ! $safe_zipcode ) {
                return false;
            }

            $count = $wpdb->get_var( $wpdb->prepare( "select COUNT(*) from $table_pin_codes where `pincode` = %s ", $safe_zipcode ) );
            $like = false;

            if ( $count == 0  ) {
                $ppook = "SELECT * FROM `$table_pin_codes` where pincode LIKE '".$wpdb->esc_like($pincode)."%'";
                $ftc_ary = $wpdb->get_results($ppook);
                $tem_pin = $ftc_ary[0]->pincode;
                $count = count($ftc_ary);
                $like = true;
            }

            if ( $count == 0 || ( isset( $tem_pin ) && false === strpos( $tem_pin,'*' ) ) )
            {
                return false; 
            }

            return true;
        }

        public function update_pin_cookie( $post_code )
        {
            $user_ID = get_current_user_id();
            if( isset($user_ID) && $user_ID != 0 ) { 
                WC()->customer->set_shipping_postcode( $post_code );
            }
            setcookie( 
                "valid_pincode", 
                $post_code,
                time() + (10 * 365 * 24 * 60 * 60),
                "/"
            );
        }

        public function save_post_code_cookie( $order_id )
        {
            $order = wc_get_order( $order_id );
            $post_code = $order->get_shipping_postcode(); // The Order data
            $this->update_pin_cookie( $post_code );
        }
    }

    Post_Code_Popup::get_instance();
}