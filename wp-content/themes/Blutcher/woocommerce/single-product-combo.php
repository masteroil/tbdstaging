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

.datpri {
    display: none;
}
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
                content_category: 'Combo Boxes',
                pluginVersion: '2.1.4',
                currency: 'AUD',
                value: <?php echo $product->get_price(); ?>,
                content_name: '<?php the_title(); ?>',
                content_ids: ["<?php echo $product->get_sku() . '_' . get_the_ID(); ?>"],
                version: '4.6.0'
            });
        }

    });
});
</script>
<section class="chuni-beef-banner" id="all-page-header-space">
    <div class="chunny-butlee-under">
        <div class="chunii-left-image">
            <img class="rawicoimg" src="<?php the_field('introduction_combo_bag'); ?>">
            <img class="bagicoimg" src="<?php the_field('introduction_combo_image'); ?>">
            <div class="chuni-liver-card">
                <ul>
                    <li>
                        <p class="rwashowfirst">
                            <img class="rawico blckimageicon1" src="<?php the_field('introduction_combo_image2'); ?>">
                            <img class="whiteimageicon1"
                                src="https://thebutchersdog.com.au/wp-content/uploads/2020/10/TBD_Build-A-Box.png">
                        </p>
                    </li>
                    <li>
                        <p>
                            <img class="rwashowlast blackimageicon2"
                                src="<?php the_field('introduction_combo_image1'); ?>">
                            <img class="whiteimageicon2"
                                src="https://thebutchersdog.com.au/wp-content/uploads/2022/01/TBD_Combo-Box.png">
                        </p>
                    </li>
                </ul>
            </div>
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
                                        <?php echo do_shortcode('[phoeniixx-pincode-check]'); ?>
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

                            if (!defined('ABSPATH')) {
                                exit; // Exit if accessed directly
                            }

                            get_header('shop'); ?>

                            <?php
                            /**
                             * woocommerce_before_main_content hook.
                             *
                             * @hooked woocommerce_output_content_wrapper - 10 (outputs opening divs for the content)
                             * @hooked woocommerce_breadcrumb - 20
                             */
                            do_action('woocommerce_before_main_content');
                            ?>

                            <?php while (have_posts()): ?>
                            <?php the_post(); ?>

                            <?php wc_get_template_part('content', 'single-product'); ?>

                            <?php endwhile; // end of the loop. ?>

                            <?php
                            /**
                             * woocommerce_after_main_content hook.
                             *
                             * @hooked woocommerce_output_content_wrapper_end - 10 (outputs closing divs for the content)
                             */
                            do_action('woocommerce_after_main_content');
                            ?>

                            <?php
                            /**
                             * woocommerce_sidebar hook.
                             *
                             * @hooked woocommerce_get_sidebar - 10
                             */
                            do_action('woocommerce_sidebar');
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


        $product = wc_get_product($current_product_id);

        // //echo ">>>>>>>";
        

        ?>




        <span id="dataprice" data-price="<?php echo $product->get_price(); ?>"
            data-max="<?php echo $product->get_max_purchase_quantity(); ?>"><?php echo $product->get_price_html(); ?></span>
    </div>
    <!-- <div class="madeby-icone-arstulian">
        <img src="<//?php echo get_site_url();?>/wp-content/uploads/2021/03/Australian-Made_White.png">
    </div> -->
</section>
<section class="wuntety-using-banner">
    <div class="container">
        <div class="row">
            <div class="excerpt-ban-text">

                <div class="text-excerpt">
                    <?php the_field('excerpt_text'); ?>
                    <?php the_field('excerpt_content'); ?>
                </div>
                <div class="except-img">
                    <img src="https://thebutchersdog.com.au/wp-content/uploads/2021/03/Australian-Made_White.png">
                </div>


            </div>
            <div class="col-md-6">
                <div class="quntety-ban-text">
                    <h6>QUANTITIES</h6>
                    <ul>
                        <?php the_field('quentity'); ?>
                    </ul>
                </div>
            </div>
            <div class="col-md-6">
                <div class="quntety-ban-text">
                    <h6>THIS BOX INCLUDES</h6>
                    <ul>
                        <?php the_field('this_box'); ?>
                    </ul>
                </div>
            </div>
        </div>
        <div class="row mels-combo-product">
            <div class="feeding-guid-lin">
                <div class="accordion" id="beefacorden">
                    <div class="card">
                        <div class="card-header" id="heading0">
                            <h2 class="mb-0">
                                <button class="btn btn-link collapsed" type="button" data-toggle="collapse"
                                    data-target="#collapse0" aria-expanded="true" aria-controls="collapse0">
                                    <?php the_field('feeding_headline'); ?></button>
                            </h2>
                        </div>
                        <div id="collapse0" class="custome-collep-b collapse" aria-labelledby="heading0"
                            data-parent="#beefacorden">
                            <div class="card-body">
                                <div class="arrive-ferozen-text">
                                    <?php the_field('guideline'); ?>
                                </div>
                            </div>
                        </div>
                    </div>
                    <br />
                    <div class="card">
                        <div class="card-header" id="collapse_reviews_heading">
                            <h2 class="mb-0">
                                <button class="btn btn-link collapsed" type="button" data-toggle="collapse"
                                    data-target="#collapse_reviews" aria-expanded="true"
                                    aria-controls="collapse_reviews">
                                    <?php _e('REVIEWS', 'blaze-online'); ?></button>
                            </h2>
                        </div>
                        <div id="collapse_reviews" class="custome-collep-b collapse"
                            aria-labelledby="collapse_reviews_heading" data-parent="#beefacorden">
                            <div class="card-body">
                                <div class="arrive-ferozen-text">
                                    <?php if (function_exists('wc_yotpo_show_widget')) {
                                        wc_yotpo_show_widget();
                                    } ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>


<section class="cariour-box-banner">
    <div class="container">
        <?php
        global $product;
        if (is_single('296') || is_single('293')) { ?>
        <div class="row">
            <div class="col-md-12">
                <div class="guide-sec">
                    <div class="guide-book"><img src="/wp-content/uploads/2020/10/guide-img.png" alt=""></div>
                    <form id="form-contact" class="guide-book-download row" action="" method="POST">
                        <div class="guide-form-top-row">
                            <div class="heading">Download our Puppy Guide</div>
                            <div class="form-group-head">
                                <div class="form-group">
                                    <input type="text" value="" name="first_name" id="first_name" class="form-control"
                                        placeholder="Full name" />
                                </div>
                                <div class="form-group">
                                    <input type="hidden" name="UmbEEm" id="UmbEEm" value="UmbEEm">
                                    <input type="email" value="" name="email" id="email" class="form-control"
                                        placeholder="Email" />
                                </div>
                            </div>
                        </div>
                        <div class="form-group guide-download">
                            <span class="form-subtitle">To download you agree to sign up to our mailing list.</span>
                            <div class="sap-btn-dark">
                                <input value="Download" id="onetimeonly" type="submit" name="submit">
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div><br><br>
        <?php } ?>
        <H4 class="relatd-last-prod">KEEP SHOPPING</H4>
        <div class="featured-meals">
            <div class="owl-carousel prod" id="owl-prod">
                <?php
                $args = array('post_type' => 'product', 'posts_per_page' => 20, 'product_cat' => "combo-boxes", 'order' => 'ASC');

                $loop = new WP_Query($args);
                $ctr = 1;
                if (have_posts()):
                    while ($loop->have_posts()):
                        $loop->the_post();

                        ?>
                <?php get_the_ID();
                        $current_product_id = get_the_ID();
                        $product1 = wc_get_product($current_product_id);
                        $quentity = $product1->get_stock_quantity();
                        ?>


                <div class="owl-head-sec">
                    <?php if ($quentity == 0) { ?>
                    <div class="out_stock_box"><span>Out of Stock</span></div>
                    <?php } ?>
                    <div class="on-hover-all-build">
                        <img class="build-whithout-hover2" src="<?php the_field('box_image'); ?>">
                        <img class="buld-hover2" src="<?php the_field('bag_image'); ?>">
                    </div>
                    <div class="prod-title">
                        <?php the_title(); ?>
                    </div>
                    <div class="pera-produ-als">
                        <p>
                            <?php the_field('excerpt_text'); ?>
                        </p>
                    </div>
                    <?php if (function_exists('wc_yotpo_show_buttomline_blaze')) {
                                print '<div style="margin-bottom:10px;">';
                                wc_yotpo_show_buttomline_blaze($product1);
                                print '</div>';
                            } ?>
                    <span class="gepricus">
                        <?php echo "$" . $product->get_price(); ?>
                    </span>
                    <div class="prod-but">
                        <a href="<?php the_permalink($loop->ID); ?>">View Product</a>

                        <?php /*if($product->get_stock_quantity()>0) {
                                            echo '<a href="'.$checkout_url.'?add-to-cart='.$current_product_id.'">Add to Box</a>';
                                        } else {
                                            echo '<a href="#" class="oos">Out Of Stock</a>';
                                            
                                        }*/
                                ?>
                    </div>
                </div>

                <?php
                        $ctr++;
                    endwhile; ?>
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
                            <li><a href="<?php echo site_url(); ?>/shop-2/?swoof=1&product_cat=combo-boxes"
                                    class="boxse-btn-s">Combo Boxes</a></li>
                            <li><a href="<?php echo site_url(); ?>/shop-2/?swoof=1&product_cat=raw-meals">Raw Meals</a>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="way-your-combo">
                    <div class="combo-box-thre">
                        <ul class="way-list-right">
                            <li>
                                <p>ADD TO YOUR ORDER</p>
                            </li>
                            <li><a href="<?php echo site_url(); ?>/shop-2/?swoof=1&product_cat=treats">Treats</a></li>
                            <li><a
                                    href="<?php echo site_url(); ?>/shop-2/?swoof=1&product_cat=apothecary">Apothecary</a>
                            </li>
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
}
</style>

<?php
get_footer();
?>