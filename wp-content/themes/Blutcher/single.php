<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package WordPress
 * @subpackage Twenty_Seventeen
 * @since Twenty Seventeen 1.0
 * @version 1.0
 */

get_header(); ?>







<div class="single-post <?php echo get_the_id();?>" id="impor-of-gut-health">
	<div class="container">
		<div class="inner-post">
			<span class="catagory-post"><?php $cat = get_the_category(); echo $cat[0]->cat_name; ?></span>
			<h1><?php the_title();?></h1>
			<div class="date-box">
				<span class="sap-author-name"><?php the_field('author_name');?></span>
				<span class="sap-post-date"><?php echo get_the_date();?></span>
			</div>
			<span class="introduction-post"><?php the_field('excerpt_summary');?></span>
			<div class="style-post">
				<img src="<?php the_post_thumbnail_url();?>">

				<div class="post-text-img">
					<?php the_content();?>
				</div>
				
			</div>

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
		</div>
	</div>
</div>

<?php
if ( is_single('24303') ) {
  ?>

<div class="main-test">
	<div class="container">
		<div class="news-test">
			<div class="testini">
				<img class="image-size" src="<?php echo site_url();?>/wp-content/uploads/2022/09/TBD_Vicki-Austin.png">
				<div class="text">
					<h2>By Vicki Austin</h2>
					<!-- <h2>Clare Kearney</h2> -->
					<p>Vicki is an experienced and respected dog trainer. Her passion is education. A self-confessed ‘nerd’ of the Science of Learning and Behaviour, she loves lively discussion on how best to apply the science in a practical context. Her students often admit to actually enjoying learning the science that previously alluded them.</p>
					<!-- <p>Clare is a guest blogger and pet nutritionist specialising in canine and feline nutrition.</p> -->
				</div>
			</div>
			<div class="news-latter">
				<span class="head-latter">Sign up to our newsletter</span>
				<div class="form-box-sub">
					<!-- Begin Mailchimp Signup Form -->
					<div id="mc_embed_signup">
						<form action="https://thebutchersdog.us18.list-manage.com/subscribe/post?u=b2ec08781614988c5f7653773&amp;id=d9cf35c4af" method="post" id="mc-embedded-subscribe-form" name="mc-embedded-subscribe-form" class="validate" target="_blank" novalidate>
							<div id="mc_embed_signup_scroll">
								<div class="mc-field-group">
									<!-- <label for="mce-EMAIL">Email Address <span class="asterisk">*</span> -->
									</label>
									<input type="email" value="" name="EMAIL" class="required email" id="mce-EMAIL">
								</div>

								<div id="mce-responses" class="clear">
									<div class="response" id="mce-error-response" style="display:none"></div>
									<div class="response" id="mce-success-response" style="display:none"></div>
								</div>

								<div style="position: absolute; left: -5000px;" aria-hidden="true"><input type="text" name="b_b2ec08781614988c5f7653773_d9cf35c4af" tabindex="-1" value=""></div>
								<div class="clear button-sub"><input type="submit" value="Subscribe" name="subscribe" id="mc-embedded-subscribe" class="button"></div>
							</div>
						</form>
					</div>
					<script type='text/javascript' src='//s3.amazonaws.com/downloads.mailchimp.com/js/mc-validate.js'></script><script type='text/javascript'>(function($) {window.fnames = new Array(); window.ftypes = new Array();fnames[1]='FNAME';ftypes[1]='text';fnames[5]='SURNAME';ftypes[5]='text';fnames[0]='EMAIL';ftypes[0]='email';fnames[2]='POSTCODE';ftypes[2]='text'; }(jQuery));var $mcj = jQuery.noConflict(true);</script>
					<!--End mc_embed_signup-->
				</div>
			</div>
		</div>
	</div>
</div>


  <?php
}else{
?>
<div class="main-test">
	<div class="container">
		<div class="news-test">
			<div class="testini test" >
				<img class="image-size" src="<?php the_field( 'author_image');?>">
				<div class="text">
					<h2><?php the_field( 'author_namee'); ?></h2>
					<p><?php the_field( 'author_bio'); ?></p>
				</div>
			</div>
			<div class="news-latter">
				<span class="head-latter">Sign up to our newsletter</span>
				<div class="form-box-sub">
					<!-- Begin Mailchimp Signup Form -->
					<div id="mc_embed_signup">
						<form action="https://thebutchersdog.us18.list-manage.com/subscribe/post?u=b2ec08781614988c5f7653773&amp;id=d9cf35c4af" method="post" id="mc-embedded-subscribe-form" name="mc-embedded-subscribe-form" class="validate" target="_blank" novalidate>
							<div id="mc_embed_signup_scroll">
								<div class="mc-field-group">
									<!-- <label for="mce-EMAIL">Email Address <span class="asterisk">*</span> -->
									</label>
									<input type="email" value="" name="EMAIL" class="required email" id="mce-EMAIL">
								</div>

								<div id="mce-responses" class="clear">
									<div class="response" id="mce-error-response" style="display:none"></div>
									<div class="response" id="mce-success-response" style="display:none"></div>
								</div>

								<div style="position: absolute; left: -5000px;" aria-hidden="true"><input type="text" name="b_b2ec08781614988c5f7653773_d9cf35c4af" tabindex="-1" value=""></div>
								<div class="clear button-sub"><input type="submit" value="Subscribe" name="subscribe" id="mc-embedded-subscribe" class="button"></div>
							</div>
						</form>
					</div>
					<script type='text/javascript' src='//s3.amazonaws.com/downloads.mailchimp.com/js/mc-validate.js'></script><script type='text/javascript'>(function($) {window.fnames = new Array(); window.ftypes = new Array();fnames[1]='FNAME';ftypes[1]='text';fnames[5]='SURNAME';ftypes[5]='text';fnames[0]='EMAIL';ftypes[0]='email';fnames[2]='POSTCODE';ftypes[2]='text'; }(jQuery));var $mcj = jQuery.noConflict(true);</script>
					<!--End mc_embed_signup-->
				</div>
			</div>
		</div>
	</div>
</div>


<?php } ?>



<style>
	.post-text-img p a {
    color: #a4866c;
}
.post-text-img ul {
    padding: 30px 160px 0 177Px!important;
    text-align: left;
    list-style: disc;
}
@media (max-width: 767px){
	.post-text-img ul {
    padding: 30px 0px 0 0Px!important;
}
}
</style>





<?php
get_footer();
