<?php
get_header();
global $product;
?>
<style>
li.subscription-option.active {
    display: block;
}

ul.wcsatt-options-product li {
    display: none;
}

.single-pro-acc.seco-box-ac {
    display: block !important;
}

.woocommerce-product-details__short-description {
    display: none;
}

.disapprstate .acc-head p {
    color: red;
}

.disapprstate .acc-icon .open-down-arrow {
    color: red;
}

label.subscriptions-listcs {
    display: none !important;
}

. a.accod-btn.subs {
    display: none;
}

a.accod-btn.one-off {
    display: block;
}

select#subscription-options {
    display: none;
}

/*.datpri {
    display: none;
}*/
</style>
<script>
jQuery(document).ready(function() {
    // Get value on button click and show alert
    jQuery(".single_add_to_cart_button").click(function() {
        var str = $("#pincode_field_id").val();
        if (str == "") {
            jQuery(".errorponote").css("display", "block");
            return false;
        }
        if (str != "") {
            jQuery(this).html('Added to Box');
            fbq('track', 'AddToCart', {
                content_type: 'product',
                content_category: 'Christmas Gifts',
                pluginVersion: '2.1.4',
                currency: 'AUD',
                value: <?php echo $product->get_price();?>,
                content_name: '<?php the_title();?>',
                content_ids: ["<?php echo $product->get_sku().'_'.get_the_ID();?>"],
                version: '4.6.0'
            });
        }

    });
});
</script>
<section class="chuni-beef-banner" id="all-page-header-space">
    <a href="#" onClick="modelCalOpen();" class="float-box"><span><img
                src="https://thebutchersdog.oxdigital.com.au/wp-content/themes/Blutcher/assets/images/food-cal.png"
                alt=""></span><span>Food calculator</span></a>
    <div class="chunny-butlee-under">
        <div class="chunii-left-image">
            <img class="rawicoimg" src="<?php the_field('raw');?>">
            <img class="bagicoimg" src="<?php the_field('pack');?>">
        </div>
        <div class="chunii-right-image sigle-ps">
            <section class="working-dog-butler">
                <div class="container">
                    <div class="row">
                        <div class="col-md-12 sp-space">

                            <div class="single-pro-acc">

                                <a class="accod-btn pnrmlstate collapsed" id="pnrmlstate" data-toggle="collapse"
                                    href="#collapse27" role="button" aria-expanded="false"
                                    aria-controls="collapseExample">
                                    <div class="acc-head">
                                        <p>CHECK WE DELIVER TO YOUR AREA</p>
                                    </div>
                                    <div class="acc-icon">
                                        <i class="fa fa-minus open-down-up" aria-hidden="true"></i>
                                        <i class="fas fa-chevron-down open-down-arrow"></i>
                                    </div>
                                </a>
                                <div class="collapse" id="collapse27">
                                    <div class="data-single-ac">
                                        <?php echo do_shortcode( '[phoeniixx-pincode-check]' );?>
                                    </div>
                                </div>
                            </div>

                            <?php
			/**
			 * The Template for displaying all single products
			 *
			 * This template can be overridden by copying it to yourtheme/woocommerce/single-product.php.
			 *
			 * HOWEVER, on occasion WooCommerce will need to update template files and you
			 * (the theme developer) will need to copy the new files to your theme to
			 * maintain compatibility. We try to do this as little as possible, but it does
			 * happen. When this occurs the version of the template file will be bumped and
			 * the readme will list any important changes.
			 *
			 * @see         https://docs.woocommerce.com/document/template-structure/
			 * @package     WooCommerce\Templates
			 * @version     1.6.4
			 */

			if ( ! defined( 'ABSPATH' ) ) {
				exit; // Exit if accessed directly
			}

			get_header( 'shop' ); ?>

                            <?php
					/**
					 * woocommerce_before_main_content hook.
					 *
					 * @hooked woocommerce_output_content_wrapper - 10 (outputs opening divs for the content)
					 * @hooked woocommerce_breadcrumb - 20
					 */
					do_action( 'woocommerce_before_main_content' );
				?>

                            <?php while ( have_posts() ) : ?>
                            <?php the_post(); ?>

                            <?php wc_get_template_part( 'content', 'single-product' ); ?>

                            <?php endwhile; // end of the loop. ?>

                            <?php
					/**
					 * woocommerce_after_main_content hook.
					 *
					 * @hooked woocommerce_output_content_wrapper_end - 10 (outputs closing divs for the content)
					 */
					do_action( 'woocommerce_after_main_content' );
				?>

                            <?php
					/**
					 * woocommerce_sidebar hook.
					 *
					 * @hooked woocommerce_get_sidebar - 10
					 */
					do_action( 'woocommerce_sidebar' );
				?>
                            <!-- <p style="display:none; color:red;" class="errorponote">Please add postcode</p> -->
                        </div>
                    </div>
                </div>
            </section>


        </div>
    </div>

    <div class="datpri">
        <?php 
 
 $current_product_id = get_the_ID();


 $product = wc_get_product( $current_product_id );

// //echo ">>>>>>>";
 

			?>




        <span id="dataprice" data-price="<?php echo $product->get_price();?>"
            data-max="<?php echo $product->get_max_purchase_quantity();?>"><?php echo $product->get_price_html();?></span>
    </div>
    <!-- <div class="madeby-icone-arstulian">
		<img src="<//?php echo get_site_url();?>/wp-content/uploads/2021/03/Australian-Made_White.png">
	</div> -->
</section>

<?php// if( get_field('nutrition_content') ): ?>

<section class="ingredient-human-grad">
    <div class="container">
        <div class="new-raw">
            <div class="row">
                <div class="introdution-custom">
                    <div class="introdution-custom-text">
                        <?php the_field('introduction_text');?>
                    </div>
                </div>
            </div>
        </div>
        <?php
       
 if( have_rows('Ingredient') ):
  ?>
        <div class="row">
            <div class="main-himan-gred-h">
                <h4>Made with human-grade ingredients</h4>
            </div>
        </div>

        <?php
 
 endif;
 ?>
        <div class="row">
            <div class="arsulian-bef-card-m">
                <?php
       
 if( have_rows('Ingredient') ):
 while( have_rows('Ingredient') ): the_row();
 
 ?>

                <div class="box-arustlein-beef">
                    <img class="beef-j-image" src="<?php the_sub_field('ingredient_image'); ?> ">
                    <h4><?php the_sub_field('percentage'); ?> </h4>
                    <h6><?php the_sub_field('Ingredient_text'); ?> </h6>
                    <!-- <a href="#"><img src="https://thebutchersdog.oxdigital.com.au/wp-content/themes/Blutcher/assets/images/plusq-white.png"></a> -->
                </div>

                <?php
 
 

 endwhile;
 endif;
 ?>


            </div>
        </div>
        <div class="row">
            <div class="nutrean-less-main">
                <div class="nutren-left-less">
                    <h5 class="mini-mess-head"><?php the_field('nutrition_heading');?></h5>
                    <p><?php the_field('nutrition_content');?></p>
                </div>
                <div class="anlisys-protin-right">
                    <h5 class="mini-mess-head"><?php the_field('analysis_heading');?></h5>
                    <?php the_field('analysis_content');?>
                </div>
            </div>
        </div>
        <?php if( get_field('feeding_headline') ): ?>
        <div class="row">
            <div class="feeding-guid-lin">
                <div class="accordion" id="beefacorden">
                    <div class="card">
                        <div class="card-header" id="heading0">
                            <h2 class="mb-0">
                                <button class="btn btn-link collapsed" type="button" data-toggle="collapse"
                                    data-target="#collapse0" aria-expanded="true"
                                    aria-controls="collapse0"><?php the_field('feeding_headline');?></button>
                            </h2>
                        </div>
                        <div id="collapse0" class="custome-collep-b collapse" aria-labelledby="heading0"
                            data-parent="#beefacorden">
                            <div class="card-body">
                                <div class="arrive-ferozen-text">
                                    <?php the_field('guidelines_text');?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php endif; ?>
    </div>
</section>
<?php //endif; ?>


<section class="beef-fechurd-banner">
    <div class="container">
        <H4 class="relatd-last-prod">KEEP SHOPPING</H4>
        <div class="featured-meals">
            <div class="owl-carousel prod" id="owl-prod">
                <?php
		    	$args = array( 'post_type' => 'product', 'posts_per_page' => 20, 'product_cat' => "christmas-gifts", 'order'=>'ASC');
		    
		        $loop = new WP_Query( $args );
		            $ctr=1;
		        if ( have_posts() ) : 
		            while ( $loop->have_posts() ) : $loop->the_post(); 
		            
		             ?>
                <?php get_the_ID();
		        $current_product_id = get_the_ID();
		        $quentity=$product->get_stock_quantity();
		            
		    ?>
                <div class="owl-head-sec">
                    <?php if($quentity==0) {?>
                    <div class="out_stock_box"><span>Out of Stock</span></div>
                    <?php } ?>
                    <div class="on-hover-all-build">
                        <img class="build-whithout-hover2" src="<?php the_field('disc_image');?>">
                        <img class="buld-hover2" src="<?php the_field('bag_image');?>">
                    </div>
                    <div class="prod-title"><?php the_title();?></div>
                    <?php if( get_field('product_weight') ): ?>
                    <div class="prod-des">

                        <span><?php the_field('product_weight');?></span>
                        <span><?php the_field('product_discs');?> discs</span>
                    </div>
                    <?php endif; ?>
                    <span class="gepricus"><?php echo "$".$product->get_price();?></span>
                    <div class="prod-but"><a href="<?php the_permalink($loop->ID); ?>">View Product</a>

                    </div>
                </div>




                <?php
                    $ctr++;
            endwhile;?>
                <?php endif; ?>
            </div>
        </div>
    </div>
</section>
<section class="chose-comob-box">
    <div class="container">
        <div class="row">
            <div class="main-row-combo-b">
                <div class="way-your-combo">
                    <div class="combo-box-thre">
                        <ul class="way-list-left">
                            <li>
                                <p>Choose your way</p>
                            </li>
                            <li><a href="<?php echo get_site_url();?>/combo-boxes">Combo Boxes</a></li>
                            <li><a href="<?php echo get_site_url();?>/raw-meals" class="boxse-btn-s">Raw Meals</a></li>
                        </ul>
                    </div>
                </div>
                <div class="way-your-combo">
                    <div class="combo-box-thre">
                        <ul class="way-list-right">
                            <li>
                                <p>ADD TO YOUR ORDER</p>
                            </li>
                            <li><a href="<?php echo get_site_url();?>/treats">Treats</a></li>
                            <li><a href="<?php echo get_site_url();?>/apothecary">Apothecary</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<style>
/*.wc-delivery-time-response,.shipping-taxable ul.purchase-options,.afterpay-payment-info{display:none}*/

nav.woocommerce-breadcrumb {
    display: none;
}

.working-dog-butler form.cart button.single_add_to_cart_button {
    margin: 41px 0 0 0;
}

.woocommerce-product-gallery.woocommerce-product-gallery--without-images.woocommerce-product-gallery--columns-4.images {
    display: none;
}

.product_meta {
    display: none;
}

section.related.products {
    display: none;
}

aside#secondary {
    display: none;
}

.woocommerce-tabs.wc-tabs-wrapper {
    display: none;
}

.qtylabel {
    text-align: left;
    font-size: 12px;
    letter-spacing: 1.4px;
    color: #fff;
    line-height: 20px;
    font-weight: 400;
    text-transform: uppercase;
    margin-bottom: 24px;
    position: absolute;
    right: 302px;
    top: 44px;
}

@media (max-width: 767px) {
    .wcsatt-options-wrapper ul.wcsatt-options-product li label {
        top: 308px;
    }

    .working-dog-butler .qtylabel {
        margin-bottom: 24px !important;
        right: auto !important;
        top: auto !important;
        bottom: 80px;
        left: 0px;
    }
}

p.afterpay-payment-info {
    display: none;
}

h1.product_title.entry-title {
    display: none !important;
}

.quantity {
    display: block !important;
}

.datpri span {
    background-color: #ffffff;
    color: #ffffff;
}

.datpri {
    background-color: #ffffff;
    color: #ffffff;
    height: 0Px;
}
</style>
<script>
jQuery(document).ready(function() {
    jQuery(".subs .acc-head").empty("");
    jQuery(".one-off .acc-head").empty("");
    jQuery(".subs .acc-head").append("<p>THIS ITEM CAN ONLY BE PURCHASED AS A ONE-OFF ITEM</p>");
    jQuery(".one-off .acc-head").append("<p>THIS ITEM CAN ONLY BE PURCHASED AS A ONE-OFF ITEM</p>");
    jQuery(".open-down-arrow").removeClass("fa-sync-alt");
    jQuery(".open-down-arrow").addClass("fa-check-circle");
    jQuery("ul.purchase-options > li:nth-child(2)").removeClass("selected");
    jQuery("ul.purchase-options > li:nth-child(1)").addClass("selected");
    jQuery("#one-time-purchase").attr("checked");
});
</script>

<?php
get_footer();
?>