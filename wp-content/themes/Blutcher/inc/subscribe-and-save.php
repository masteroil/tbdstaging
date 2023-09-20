<?php
global $woocommerce;
//$product = new WC_Product(get_the_ID()); 
$product = wc_get_product( $product_id );


if ( ! class_exists( 'Blaze_Subscribe_And_Save' ) ) {
    class Blaze_Subscribe_And_Save
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
            
            //short product discription add_action( 'woocommerce_after_shop_loop_item_title', array( $this, 'wc_add_short_description') );
            add_action( 'woocommerce_after_shop_loop_item', array( $this, 'display_subscribe_and_save_button'), 5, 2);
        }


   /*     public function wc_add_short_description() {
            global $product;
        
            ?>
<div itemprop="description">
    <?php echo apply_filters( 'woocommerce_short_description', $product->get_short_description() ) ?>
</div>
<?php
        }
*/
        public function display_subscribe_and_save_button()
        {
            global $product;
            if ( has_term( array('apothecary', 'gifts'), 'product_cat', get_the_ID() ) ) {
                return '';
            }
            /**
			 * If product(like out of stock) does not support subscription scheme then don't continue the rest of the code in the method.  
			 */
            if ( ! WCS_ATT_Product::supports_feature( $product, 'subscription_scheme_options_product_single' ) ) {
				return '';
			}
            ?>
<div class="sub_and_save_frame">
    <p><?php the_field('excerpt_text'); ?></p>
</div>
<!-- <div class="flex justify-center subscribe-and-save-container">
                    <form action="">
                        <label class="bg-black cursor-pointer hover:bg-butchers-brown mb-3 p-3 text-white subscribe-and-save" for="subscribe-and-save-<?php echo get_the_ID() ?>">
                            <input type="checkbox" name="subscribe-and-save-<?php // echo get_the_ID() ?>" />
                            Subscribe and Save
                        </label>
                    </form>
                </div> -->
<div class="for_yotpo_in_sub">
    <?php 
    if ( function_exists( 'wc_yotpo_show_buttomline_blaze' ) ) { wc_yotpo_show_buttomline_blaze(); } 
  
  ?>
</div>



<?php   
                $base_scheme = WCS_ATT_Product_Schemes::get_base_subscription_scheme( $product );
                $subscription_scheme            = WCS_ATT_Product_Schemes::get_subscription_schemes( $product );
                $subscription_scheme = reset($subscription_scheme);
                //$scheme_key       = (method_exists($subscription_scheme, 'get_key') ) ? $subscription_scheme->get_key() : null;
                $scheme_key       = (method_exists($subscription_scheme, 'get_key')) ? $subscription_scheme->get_key() : $base_scheme->get_key();
                $parent_product = null;
                $option_price_html_args = array(
				'context'         => 'radio',
				'append_discount' => false
		);
                $option_price_html_args = apply_filters( 'wcsatt_single_product_subscription_option_price_html_args', $option_price_html_args, $subscription_scheme, $product, $parent_product );
               $sub_price_html = WCS_ATT_Product_Prices::get_price_html( $product, $scheme_key, $option_price_html_args );
                ?>
<div class="choose-fequancy w-full">
    <div class="check-filter">
        <div class="off-purchase">
            <div class="common-label">
                <input id="radio-<?php echo get_the_ID() ?>-of" class="radio-customc off"
                    name="radio-group-<?php echo get_the_ID() ?>-of" type="checkbox">
                <label for="radio-<?php echo get_the_ID() ?>-of" class="radio-custom-labelc of">One-off purchase <span
                        class="new_price"><?php echo  $product->get_price_html();  ?></span></label>
            </div>
        </div>

        <div class="mx-auto subscribe-tps w-3/4">
            <div class="common-label">
                <input id="radio-group-<?php echo get_the_ID() ?>-ch" class="radio-customc subs"
                    name="radio-group-<?php echo get_the_ID() ?>" type="checkbox">
                <label for="radio-group-<?php echo get_the_ID() ?>-ch" class="radio-custom-labelc">Subscribe &
                    Save<span class="new_sub_button"><?php echo $sub_price_html; ?></span></label>
            </div>
            <div class="relative select-img" style="display: none;">
                <img src="https://sprattmortgages.com.au/wp-content/uploads/2021/08/down-aroow.png">
                <select name="subscription-options" class="subs_intervl">
                    <option value="1_week">Every 1 week</option>
                    <option value="2_week">Every 2 weeks</option>
                    <option value="3_week">Every 3 weeks</option>
                    <option value="4_week">Every 4 weeks</option>
                    <option value="5_week">Every 5 weeks</option>
                    <option value="6_week">Every 6 weeks</option>
                </select>
            </div>
        </div>
    </div>
</div>

<?php
        }
    }

    Blaze_Subscribe_And_Save::get_instance();
}