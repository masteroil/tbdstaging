<?php
/* template name: blog*/

get_header();
?>

<section class="bloge-post-banner" id="all-page-header-space">
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<div class="alognside-text">
					<h4>Alongside deliverying raw dog food we like providing a dose of positive, inspiring and informative content to our passionate community of dog lovers!</h4>
				</div>
			</div>
			<?php 
   // the query
 $wpb_all_query = new WP_Query(array('post_type'=>'post', 'post_status'=>'publish', 'order' => 'DESC', 'posts_per_page'=> 1 )); 
if ( $wpb_all_query->have_posts() ) : 
 while ( $wpb_all_query->have_posts() ) : $wpb_all_query->the_post(); ?>
			<div class="col-lg-8 col-xl-8 pad-r">
				<div class="blog-title-custome-l">
					<a href="<?php the_permalink($loop->ID); ?>">
						<img src="<?php the_post_thumbnail_url();?>" class="" alt="">
					</a>
				</div>
			</div>
			
			<div class="col-lg-4 col-xl-4 pad-l">
				<div class="blog-title-custome-r">
					<span class="blog-title-1-custm"><?php $cat = get_the_category(); echo $cat[0]->cat_name; ?></span>
				
						<h2 class="blog-title-2-custm"><?php the_title();?></h2>
				
					<div class="blog-title-3-custom">
						<p><?php the_field('excerpt_summary');?></p>
					</div>
					<p class="blog-title-4-custom"><?php echo get_the_date(); ?></p>
					<div class="nature-bottom-blog-custom">
						<a class="left-hover-btn-cust" href="<?php the_permalink($loop->ID); ?>">
							<p>Read More</p>
						</a>
						<a class="rgt-hover-btn-cust" href="<?php the_permalink($loop->ID); ?>">
							<img class="nature-d-more-cust" src="<?php echo get_site_url();?>/wp-content/themes/Blutcher/assets/images/arrow-right-white.png">
						</a>
					</div>
				</div>
			</div>
			 <?php 
    		endwhile; 
  wp_reset_postdata();
 else : ?>
  <p><?php __('No News'); ?></p>
<?php endif; ?>
		</div>
	</div>
</section>
<section class="puppyschool-banner">
	<div class="container">
		<div class="row">
<?php 
   // the query
 $wpb_all_query = new WP_Query(array('post_type'=>'post', 'post_status'=>'publish', 'order' => 'DESC', 'posts_per_page'=> -1 )); 
if ( $wpb_all_query->have_posts() ) : 
 while ( $wpb_all_query->have_posts() ) : $wpb_all_query->the_post(); ?>
			<div class="col-lg-4 blogtopspace">
				<div class="common_blog-image-custom" id="dogshealth">
					<a href="#">
						<img src="<?php the_post_thumbnail_url();?>" class="blog-card-image" alt="">
					</a>
					<div class="name-blog-date">
						<p class="blog-card-name"><?php $cat = get_the_category(); echo $cat[0]->cat_name; ?></p>
						<p class="blog-card-date"><?php echo get_the_date(); ?></p>
					</div>
					<a href="#">
						<h2 class="bloag-card-link"><?php the_title();?></h2>
					</a>
					<div class="nature-bottom-blog-custom">
						<a class="left-hover-btn-cust" href="<?php the_permalink($loop->ID); ?>">
							<p>Read More</p>
						</a>
						<a class="rgt-hover-btn-cust" href="<?php the_permalink($loop->ID); ?>">
							<img class="nature-d-more-cust" src="<?php echo get_site_url();?>/wp-content/themes/Blutcher/assets/images/arrow-right-white.png">
						</a>
					</div>
				</div>
			</div>
			 <?php 
    		endwhile; 
  wp_reset_postdata();
 else : ?>
  <p><?php __('No News'); ?></p>
<?php endif; ?>
		</div>
	</div>
</section>
<section class="out-morebanner">
	<div class="container">
		<div class="row">
			<div class="finde-box-update">
				<div class="first-find-text">
					<h4>Find out more</h4>
				</div>
				<div class="food-safe-during">
					<p>Want to know more about how we keep your food safe during delivery, or how to best make the switch.</p>
				</div>
				<div class="frequnly-btn">
					<a href="#">Frequently asked questions</a>
				</div>
			</div>
		</div>
	</div>
</section> 

<?php
get_footer();
?>