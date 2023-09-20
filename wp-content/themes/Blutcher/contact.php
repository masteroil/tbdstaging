<?php 
/* template name: contact*/

get_header();
wp_head();
?>
	 <div class="rajister-tb-banner" id="all-page-header-space">
	 	
			 
			<div class="container-fluid">
				<div class="container">
					<div class="row">
					    <div class="only-top-ratbd">
							<h1 class="rajister-headline-mini">Contact Us</h1>
							<h2 class="rajister-headline-mini-2">Have a question? we're here to help.</h2>
						</div>
					</div>
				</div>
			</div>							 
		 </div>

		<div class="inner-text-sec form-sect-tb-login only-contect-page-tb">
		 		<div class="container">
					<div class="row">
						<div class="only-secound-ratbd">
							<p class="rajis-gray-heading">Our preferred form of messaging is via email. However please provide a phone number if you'd like one of our team to call you back.</p>
						</div>
						<div id="table-all-dogs-but-log">
							<?php echo do_shortcode('[contact-form-7 id="357" title="Contact form 1"]');?>
						</div>
					</div>
				</div>
			</div>

<?php
wp_footer();
get_footer();
?>