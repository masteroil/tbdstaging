<?php
/* template name: treats */

get_header();

?>

<section class="comob-boxx trets-a-box-banner" id="all-page-header-space">
	<div class="container">
		<div class="row">
			
			<div class="combo-box-texty-f">
				<h2><?php the_field('banner_heading');?></h2>
				<p><?php the_field('banner_text');?></p>
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
							<li><a href="<?php echo get_site_url();?>/combo-boxes/">Combo Boxes</a></li>
							<li><a href="<?php echo get_site_url();?>/raw-meals/">Raw Meals</a></li>
						</ul>
					</div>
				</div>
				<div class="way-your-combo">
					<div class="combo-box-thre">
						<ul class="way-list-right">
							<li><p>ADD TO YOUR ORDER</p></li>
							<li><a href="#" class="boxse-btn-s">Treats</a></li>
							<li><a href="<?php echo get_site_url();?>/apothecary/">Apothecary</a></li>
							<li><a href="<?php echo get_site_url();?>/gifts/">Gifts</a></li>
						</ul>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>
<section class="build-boxx-product-baner">
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<div class="build-one-pera">
					<p><?php the_field('introduction_note');?></p>
				</div>
			</div>
		</div>

		<div class="row">
			<?php
	$args = array( 'post_type' => 'product', 'posts_per_page' => 20, 'product_cat' => "treats", 'order'=>'ASC');
	
		$loop = new WP_Query( $args );
			$ctr=1;
		if ( have_posts() ) : 
			while ( $loop->have_posts() ) : $loop->the_post(); 
			
			 ?> 
		<?php get_the_ID();
			global $product;

		?>
		<?php 
               	$current_product_id = get_the_ID();

    			// get the product based on the ID
    			$product = wc_get_product( $current_product_id );

    			// get the "Checkout Page" URL
    			$checkout_url = WC()->cart->get_cart_url();
    			$quentity=$product->get_stock_quantity();
    	
               ?>
			<div class="col-md-3 col-6">
				<div class="trets-box-prod">
					<?php if($quentity<=0) {?>
			        	<div class="out_stock_box"><span>Out of Stock</span></div>
			        	<?php } ?>
					<div class="on-hover-all-build">
						<img class="build-whithout-hover2" src="<?php the_field('pack_image');?>">
						<img class="buld-hover2" src="<?php the_field('raw_image');?>">
					</div>
					<h4><?php the_title();?></h4>
					<div class="size-treats-box">
						<span><?php the_field('pack_weight');?></span>						
					</div>
					<span class="gepricus"><?php echo "$".$product->get_price();?></span>
					<div class="btns-product-trets">
						<a href="<?php the_permalink($loop->ID); ?>">View Product</a>
								<?php /*if($product->get_stock_quantity()>0) {
							    echo '<a href="?add-to-cart='.$current_product_id.'">Add to Box</a>';
							} else {
							    echo '<a href="#" class="oos">Out Of Stock</a>';
							    
							}*/
						?>
					</div>
				</div>
			</div>
			<?php
					$ctr++;
			endwhile;?>
<?php endif; ?>
		</div>
	</div>
</section>
<div class="subscribe-sec container">
    <div class="subtitle">SUPPORT</div>
    <div class="subs-heading">Unsure where to start?</br>
        <span>Speak to our Nutritionist about the best diet for your puppy or dog.</span>
    </div>
    <a href="<?php echo get_site_url();?>/contact/"><input type="button" value="Contact Us"></a>

    
</div>


<?php
get_footer();
?>
