<?php
/* template name: ourstory */

get_header();

?>

<section class="new-stoctic-banner out-custme-banneerr" id="all-page-header-space">
	<div class="container"> 
		<div class="row">
			<div class="stockists-he-c">
				<h2>Our story</h2>
			</div>
			
		</div>
	</div>
</section>
<section class="science science-mob story same-class ourstory-page">
	<div class="container">
		<div class="row">
			 <!-- <div class="col-lg-12">
					<div class="science-between">
						<h1 class="science-1"><?php the_field('banner_head');?></h1>
					</div>
				</div>  -->
			<div class="our-storyalways">
				<?php the_field('top_content');?>
			</div>
			<div class="video-popugreg-and">
				<h3>Greg and Jo and Wilson</h3>
				<h6>Founders of The Butcher's Dog</h6>
				<div class="watch-story-video">
					<h4>WATCH OUR STORY</h4>
					<div class="onlystory-watch-video">
						<span class="all-toggle-design-bu" data-toggle="modal" data-target="#video-Moda2<?php echo $ctr;?>"><img src="<?php echo get_site_url();?>/wp-content/themes/Blutcher/assets/images/play-button.png" alt=""></span>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>


<section class="ourstory-welcome">
	<!-- <div class="container">
		<div class="our-inner">
			<?php the_field('introduction');?>
		</div>
	</div> -->

<div class="container">
	<div class="our-inner">
<div class="dual-sec onlu-right-side-dogvideo aos-init" data-aos="fade-left" data-aos-easing="linear" data-aos-duration="500">
                    <!-- Video Section -->
                    <!-- <img src="<?php the_sub_field('customer_image'); ?>" alt=""> -->
                    
                </div>
            </div>
        </div>
                </section>

<div class="modal" id="video-Moda2<?php echo $ctr; ?>" aria-modal="true" style="padding-right: 17px; display: none;">
                    <button type="button" class="close" data-dismiss="modal">×</button>
                <div class="modal-dialog model-container container">
                    <div class="modal-content">
                      <!-- Modal body -->
                      <div class="modal-video">
                           <iframe src="https://player.vimeo.com/video/408367347" width="640" height="360" frameborder="0" allow="autoplay; fullscreen" allowfullscreen></iframe>                     
                      </div>

                    </div>
                </div>
            </div>
<section class="who-whybaner">
	<div class="container">
		<div class="row">
			<?php 
			if( have_rows('our_story') ):
    			
    				while( have_rows('our_story') ): the_row();?>
			<div class="col-md-4">
				<div class="content-why-who">
					<h4><?php the_sub_field('title');?></h4>
					<p><?php the_sub_field('content');?>.</p>
				</div>
			</div>
		<?php endwhile;
    					endif;
    					?>
			<!-- <div class="col-md-4">
				<div class="content-why-who">
					<h4>Who</h4>
					<p>Our formulations are developed with Animal Nutritionists and checked by Vets. We know that it is possible to feed your dog a nutritionally balanced diet without using synthetic vitamin and mineral premixes to make it balance. Unlike dry food companies, we dont believe there is one meal you should be feeding your dog every day of its life. So we encourage you to feed from across our range. Like a good marriage, mix it up and keep it interesting - your dog will love you for it.</p>
				</div>
			</div>
			<div class="col-md-4">
				<div class="content-why-who">
					<h4>How</h4>
					<p>Our Butcher has over 40 years experience in the meat industry and sources the meats that go into The Butcher’s Dog meals from the same farms your local Butcher buys his produce. We buy our vegetables and fruit directly from the growers so it's fresh and seasonal. We make our food in small batches in our HACCP food approved facility and it's delivered to you in temperature controlled vans to make sure it gets delivered promptly and stays perfect and frozen. To us it’s not pet food, it’s just food.</p>
				</div>
			</div> -->
		</div>
	</div>
</section>


<section class="our-support  sales-competition">
	<div class="container">
		<div class="row">
			<div class="col-lg-12">
				
			</div>
		</div>
	</div>
</section>

<div class="we-section">
	<div class="container-fluid">
		<div class="row">
			<div class="col-6 hiding">
				<a href="<?php echo get_site_url(); ?>/raw/"><img class="img-1" src="<?php echo get_site_url(); ?>/wp-content/themes/Blutcher/assets/images/TBD_Button_Gold_new-white.png"></a>
				<h5 class="text">Why Raw</h5>
			</div>
			<div class="col-6 hiding">
				<a href="<?php echo get_site_url(); ?>/contact/"><img class="img-2" src="<?php echo get_site_url(); ?>/wp-content/themes/Blutcher/assets/images/TBD_Button_Black_100-new-black.png"></a>
				<h5 class="text">Get in touch</h5>
			</div>
		</div>
	</div>
</div>
       											
<?php
get_footer();?>
