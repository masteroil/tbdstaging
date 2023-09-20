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
.madeby-icone-arstulian img {height: 60px;}
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
	<a href="#" onClick= "modelCalOpen();" class="float-box"><span><img src="https://thebutchersdog.oxdigital.com.au/wp-content/themes/Blutcher/assets/images/food-cal.png" alt=""></span><span>Food calculator</span></a>
	<div class="chunny-butlee-under">
		<div class="chunii-left-image">
			<img class="rawicoimg" src="<?php the_field('raw');?>">
			<img class="bagicoimg" src="<?php the_field('pack');?>">
			<div class="chuni-liver-card">
				<ul>
					<li><p class="rwashowfirst">
						<img class="rawico blckimageicon1" src="https://thebutchersdog.oxdigital.com.au/wp-content/themes/Blutcher/assets/images/Bowl%20Icon.png">
						<img class="whiteimageicon1" src="https://thebutchersdog.oxdigital.com.au/wp-content/themes/Blutcher/assets/images/Bowl-Icon-white-clr.png">
					</p></li>
					<li><p>
						<img class="rwashowlast blackimageicon2" src="https://thebutchersdog.oxdigital.com.au/wp-content/themes/Blutcher/assets/images/Bowl%20Icon2.png">
						<img class="whiteimageicon2" src="https://thebutchersdog.oxdigital.com.au/wp-content/themes/Blutcher/assets/images/Bowl-Icon2-white-clr.png">
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

<?php
       
 if( have_rows('Ingredient') ):?>

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
					<!-- <a href="#"><img src="https://thebutchersdog.oxdigital.com.au/wp-content/themes/Blutcher/assets/images/plusq-white.png"></a> -->
				</div>

				<?php
 
 

 endwhile;
 endif;
 ?>

				<!-- <div class="box-arustlein-beef">
					<img class="beef-j-image" style="visibility: hidden;" src="https://thebutchersdog.oxdigital.com.au/wp-content/themes/Blutcher/assets/images/Beef%20icon.png">
					<h4>10%</h4>
					<h6>Australian Beef <br>Heart</h6> -->
					<!-- <a href="#"><img src="https://thebutchersdog.oxdigital.com.au/wp-content/themes/Blutcher/assets/images/plusq-white.png"></a> -->
				<!-- </div>
				<div class="box-arustlein-beef">
					<img class="beef-j-image" style="visibility: hidden;" src="https://thebutchersdog.oxdigital.com.au/wp-content/themes/Blutcher/assets/images/Beef%20icon.png">
					<h4>5%</h4>
					<h6>Australian Beef <br>Liver</h6> -->
					<!-- <a href="#"><img src="https://thebutchersdog.oxdigital.com.au/wp-content/themes/Blutcher/assets/images/plusq-white.png"></a> -->
				<!-- </div>
				<div class="box-arustlein-beef">
					<img class="beef-j-image" style="visibility: hidden;" src="https://thebutchersdog.oxdigital.com.au/wp-content/themes/Blutcher/assets/images/Beef%20icon.png">
					<h4>5%</h4>
					<h6>Australian Beef <br>Kidney</h6> -->
					<!-- <a href="#"><img src="https://thebutchersdog.oxdigital.com.au/wp-content/themes/Blutcher/assets/images/plusq-white.png"></a> -->
				<!-- </div> -->
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
				</div>
			</div>
		</div>
	</div>
</section>
<?php endif;
 ?>

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
		             $product1 = wc_get_product( $current_product_id );
 $quentity=$product1->get_stock_quantity();
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
			        <span class="gepricus"><?php echo "$".$product->get_price();?></span>
			            <div class="prod-but"><a href="<?php the_permalink($loop->ID); ?>">View Product</a>

			            	<?php /*if($product->get_stock_quantity()>0) {
                                echo '<a href="'.$checkout_url.'?add-to-cart='.$current_product_id.'">Add to Box</a>';
                            } else {
                                echo '<a href="#" class="oos">Out Of Stock</a>';
                                
                            }*/
                        ?></div>
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
							<li><a href="<?php echo get_site_url();?>/combo-boxes">Combo Boxes</a></li>
							<li><a href="<?php echo get_site_url();?>/build-a-box" class="boxse-btn-s">Build a Box</a></li>
						</ul>
					</div>
				</div>
				<div class="way-your-combo">
					<div class="combo-box-thre">
						<ul class="way-list-right">
							<li><p>ADD TO YOUR ORDER</p></li>
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


.working-dog-butler ul.purchase-options li {
    display: none;
}

ul.purchase-options{
    display: none!important;
}
.woocommerce-tabs.wc-tabs-wrapper {
    display: none;
}


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
    right: 500px;
    top: 44px;
}
@media (max-width: 767px) {
	.wcsatt-options-wrapper ul.wcsatt-options-product li label {
	    top: 308px;
	}
	.working-dog-butler .quantity {
	    width: 50%;
	    margin: 25px 0 0 0 !important;
	}
	.working-dog-butler .qtylabel {
	    margin-bottom: 24px !important;
	    right: auto !important;
	    top: auto !important;
	    bottom: 0px;
	    left: 0px;
	}
}

.woo_amc_container_side {z-index: 999;}
.shipping-taxable form.cart a.added_to_cart.wc-forward {display: none;}
.shipping-taxable .quantity {margin: 0 0 0 60px !important;}

p.first-payment-date {
    display: none;
}
</style>
<?php
get_footer();
?>
