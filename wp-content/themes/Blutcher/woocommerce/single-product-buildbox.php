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
</style>
<script>
    jQuery(document).ready(function(){
    // Get value on button click and show alert
    jQuery(".single_add_to_cart_button").click(function(){
        var str = $("#pincode_field_id").val();
        if (str == "")
        {
        jQuery(".errorponote").css("display", "block");
        return false;
        }
        if (str != "")
        {
        jQuery(this).html('Added to Box');
        fbq('track', 'AddToCart',{
        content_type:'product',
        content_category: 'Build a Box', 
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
	 <a href="#" onClick= "modelCalOpen();" class="float-box"><span><img src="<?php echo get_site_url();?>/wp-content/themes/Blutcher/assets/images/food-cal.png" alt=""></span><span>Food calculator</span></a> 
	<div class="chunny-butlee-under">
		<div class="chunii-left-image">
			<img class="rawicoimg" src="<?php the_field('raw');?>">
			<img class="bagicoimg" src="<?php the_field('pack');?>">
			<div class="chuni-liver-card">
				<ul>
					<li><p class="rwashowfirst">
						<img class="rawico blckimageicon1" src="<?php echo get_site_url();?>/wp-content/themes/Blutcher/assets/images/Bowl%20Icon.png">
						<img class="whiteimageicon1" src="<?php echo get_site_url();?>/wp-content/themes/Blutcher/assets/images/Bowl-Icon-white-clr.png">
					</p></li>
					<li><p>
						<img class="rwashowlast blackimageicon2" src="<?php echo get_site_url();?>/wp-content/themes/Blutcher/assets/images/Bowl%20Icon2.png">
						<img class="whiteimageicon2" src="<?php echo get_site_url();?>/wp-content/themes/Blutcher/assets/images/Bowl-Icon2-white-clr.png">
					</p></li>
				</ul> 
			</div>
		</div>
		<div class="chunii-right-image">
			<div class="heart-beef-chunk">
				<?php 
 
 $current_product_id = get_the_ID();
 $product1 = wc_get_product( $current_product_id );
 $quentity=$product1->get_stock_quantity();

 $product = wc_get_product( $current_product_id );

// //echo ">>>>>>>";
 

				if($quentity<=0) {?>
							  
							   <button>Out of stock</button>
							    
							<?php }
						?>
				<h2><?php the_title();?></h2>
				<p><?php the_field('introduction_text');?></p>
				<?php if( get_field('product_weight') ): ?>
				<div class="chuuni-beff-weigh">
					<p><span><?php the_field('product_weight');?></span><span><?php the_field('product_discs');?> discs</span></p>
				</div>
				<?php endif; ?>
				<span  id="dataprice" data-price="<?php echo $product->get_price();?>" data-max="<?php echo $product->get_max_purchase_quantity();?>"><?php echo $product->get_price_html();?></span>
			</div>
		</div>
	</div>
	<div class="madeby-icone-arstulian">
		<img src="<?php echo get_site_url();?>/wp-content/uploads/2021/03/Australian-Made_White.png">
	</div>
</section>



<section class="ingredient-human-grad">
	<div class="container">
		<div class="row">
			<div class="main-himan-gred-h">
				<h4>Made with human-grade ingredients</h4>
			</div>
		</div>
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
		<div class="row">
			<div class="feeding-guid-lin">
				<div class="accordion" id="beefacorden">
					<div class="card">
						<div class="card-header" id="heading0">
							<h2 class="mb-0">
								<button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#collapse0" aria-expanded="true" aria-controls="collapse0"><?php the_field('feeding_headline');?></button>
							</h2>
						</div>
					<div id="collapse0" class="custome-collep-b collapse" aria-labelledby="heading0" data-parent="#beefacorden">
						<div class="card-body">
							<div class="arrive-ferozen-text">
								<?php the_field('guidelines_text');?>
							</div>
						</div>
					</div>
					</div>
                    <br />
                    <div class="card">
                        <div class="card-header" id="collapse_reviews_heading">
                            <h2 class="mb-0">
                                <button class="btn btn-link collapsed" type="button" data-toggle="collapse"
                                    data-target="#collapse_reviews" aria-expanded="true" aria-controls="collapse_reviews">
                                    <?php _e( 'REVIEWS', 'blaze-online' ); ?></button>
                            </h2>
                        </div>
                        <div id="collapse_reviews" class="custome-collep-b collapse" aria-labelledby="collapse_reviews_heading"
                            data-parent="#beefacorden">
                            <div class="card-body">
                                <div class="arrive-ferozen-text">
                                    <?php if ( function_exists( 'wc_yotpo_show_widget' ) ) { wc_yotpo_show_widget(); } ?>
                                </div>
                            </div>
                        </div>
                    </div>
				</div>
			</div>
		</div>
	</div>
</section>

<section class="working-dog-butler">
	<div class="container">
		<div class="row">
			<div class="col-md-12">
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
				<p style="display:none; color:red;" class="errorponote">Please add postcode</p>
			</div>
		</div>
	</div>
</section>

<section class="beef-fechurd-banner">
	<div class="container">
		          <section class="guide-sec-head"> 
    <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="guide-sec">
                        <div class="guide-book"><img src="https://thebutchersdog.com.au/wp-content/uploads/2022/03/guide-img.png" alt=""></div>
                        <form id="form-contact" class="guide-book-download row" action="" method="POST">
                            <div class="guide-form-top-row">
                                <div class="heading">Download our Puppy Guide</div>
                                <div class="form-group-head">
                                    <div class="form-group">
                                        <input type="text" value="" name="first_name" id="first_name" class="form-control" placeholder="Full name" />
                                    </div> 
                                    <div class="form-group">
                                        <input type="hidden" name="UmbEEm" id="UmbEEm" value="UmbEEm">
                                        <input type="email" value="" name="email" id="email" class="form-control" placeholder="Email" />
                                    </div>
                                </div>
                            </div>
                            <div class="form-group guide-download">
                                <span class="form-subtitle">To download you agree to sign up to our mailing list.</span>
                                <div class="sap-btn-dark">
                                <input value="Download" id="onetimeonly" type="submit"  name="submit">
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
    </div>
</section>
			<H4 class="relatd-last-prod">KEEP SHOPPING</H4>
			<div class="featured-meals">
			    <div class="owl-carousel prod" id="owl-prod">
			    	<?php
		    	$args = array( 'post_type' => 'product', 'posts_per_page' => 20, 'product_cat' => "build-a-box", 'order'=>'ASC');
		    
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
			            <div class="prod-des">
			            	<span><?php the_field('product_weight');?></span>
			            	<span><?php the_field('product_discs');?> discs</span></div>
                            <?php if ( function_exists( 'wc_yotpo_show_buttomline_blaze' ) ) {
                        print '<div style="margin-bottom:10px;">';
                        wc_yotpo_show_buttomline_blaze( $product );
                        print '</div>';
                    } ?>
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
							<li><p>Choose your way</p></li>
                            <li><a href="<?php echo site_url();?>/shop-2/?swoof=1&product_cat=combo-boxes" class="boxse-btn-s">Combo Boxes</a></li>
                            <li><a href="<?php echo site_url();?>/shop-2/?swoof=1&product_cat=raw-meals">Raw Meals</a></li>
						</ul>
					</div>
				</div>
				<div class="way-your-combo">
					<div class="combo-box-thre">
						<ul class="way-list-right">
							<li><p>ADD TO YOUR ORDER</p></li>
                            <li><a href="<?php echo site_url();?>/shop-2/?swoof=1&product_cat=treats">Treats</a></li>
                            <li><a href="<?php echo site_url();?>/shop-2/?swoof=1&product_cat=apothecary">Apothecary</a></li>
						</ul>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>
<style>

nav.woocommerce-breadcrumb {
    display: none;
}
.madeby-icone-arstulian img {height: 60px;}
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
</style>
<?php
get_footer();
?>
