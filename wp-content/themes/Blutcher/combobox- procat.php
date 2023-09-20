<?php
/* template name: combobox */

get_header();

?>

<section class="comob-boxx" id="all-page-header-space">
	<div class="container">
		<div class="row">
			
			<div class="combo-box-texty-f">
				<h2><?php the_field('banner_heading');?></h2>
				<p><?php the_field('banner_text');?></p>
			</div>
		</div>
	</div>
	<div class="madeby-icone-arstulian">
		<img src="<?php echo get_site_url();?>/wp-content/uploads/2021/03/Australian-Made_White.png">
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
							<li><a href="#" class="boxse-btn-s">Combo Boxes</a></li>
							<li><a href="<?php echo get_site_url();?>/raw-meals/">Raw Meals</a></li>
						</ul>
					</div>
				</div>
				<div class="way-your-combo">
					<div class="combo-box-thre">
						<ul class="way-list-right">
							<li><p>ADD TO YOUR ORDER</p></li>
							<li><a href="<?php echo get_site_url();?>/treats/">Treats</a></li>
							<li><a href="<?php echo get_site_url();?>/apothecary/">Apothecary</a></li>
							<li><a href="<?php echo get_site_url();?>/gifts/">Gifts</a></li>
						</ul>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>
<section class="all-combo-pack-banner">
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
	$args = array( 'post_type' => 'product', 'posts_per_page' => 20, 'product_cat' => "combo-boxes", 'order'=>'ASC');
	
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
    	
               ?>
               

			<div class="col-md-6">
				<div class="comboc-pack-item">
					<div class="combo-pack-under">
						<img src="<?php the_field('cover_image');?>">
						<div class="combo-pack-botom">
							<h4><?php the_title();?></h4>
							<p><?php the_field('excerpt_text');?></p>
							<span class="gepricus"><?php echo "$".$product->get_price();?></span>
							<div class="combo-pack-btns">
								<a href="<?php the_permalink($loop->ID); ?>">View Product</a>
								<?php /*if($product->get_stock_quantity()>0) {
							    //echo '<a href="#">Add To Box</a>';
							     echo '<a href="?add-to-cart='.$current_product_id.'">Add to Cart</a>';
							} else {
							    echo '<a href="#" class="oos">Out Of Stock</a>';
							    
							}*/
						?>
							</div>
						</div>
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

<section class="apse-box">
	<div class="container">
		<div class="inner-apse">
			<div class="left-aesp apse-common">
				<h2>APOTHECARY</h2>
				<p>Adored Beast Apothecary is a line of all-natural
					pet products designed to support your dog’s
					health inside and out. Imported from Canada.</p>
									<a href=<?php echo get_site_url();?>/apothecary/>Add to order</a>
			</div>
			<div class="right-aesp apse-common">
				<h2>SEALED STORAGE</h2>
				<p>Our Sealed Storage Bowls have been custom
designed to be the perfect size for storing and
defrosting your dog’s meals in the fridge.</p>
									<a href="<?php echo get_site_url();?>/product/build-a-box/sealed-storage-bowl/">Add to order</a>
			</div>
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
