<?php
/* template name: ingredient_directory */

get_header();
?>



	<section class="sample-banner common_padd">
		<div class="container">
			<div class="row">
				<div class="butc-ingredient"> 
					<h2 class="hdg">Ingredient Directory</h2>
					<!-- <p class="des"></p> -->
				</div>
			</div>
		</div>
	</section> 
	
	
	
	
	
	<section class="about-team dir custom-ingerdient">
        <div class="container">
            <div class="row">
                <div class="butc-goes-wh wow fadeInUp" data-wow-duration="0.3s" data-wow-delay="0.4s" style="visibility: visible; animation-duration: 0.3s; animation-delay: 0.4s; animation-name: fadeInUp;">
						<h2 class="hdg1">WHAT GOES IN</h2>
                </div>
            </div>					
            <div class="row">	
			<?php
$Slidecounter=0;
 if( have_rows('ingredients') ):
 while( have_rows('ingredients') ): the_row();
 if($Slidecounter=='0'){
 ?>
				<div class="col-xs-6 col-sm-4 col-lg-2 parts wow fadeInUp" data-wow-duration="0.3s" data-wow-delay="0.4s" style="visibility: visible; animation-duration: 0.3s; animation-delay: 0.4s; animation-name: fadeInUp;">
					<div class="top">
						<img src="<?php the_sub_field('ingredient_img');?>" />
					</div>						
					<div class="btm">
						<h2 class="name"><?php the_sub_field('ingredient_name');?></h2>
						
						<div class="plus-more">
									<a href="javascript:void(0)" data-toggle="modal" data-target="#myModal"><img src="<?= get_template_directory_uri();?>/assets/images/plus.png" /></a>
							</div>							
					</div>
                </div>
				 <?php
 }
 if($Slidecounter!='0'){
 ?>	
		<div class="col-xs-6 col-sm-4 col-lg-2 parts wow fadeInUp" data-wow-duration="0.3s" data-wow-delay="0.4s">
						<div class="top">
							<img src="<?php the_sub_field('ingredient_img');?>" />
						</div>
						
						<div class="btm">
							<h2 class="name"><?php the_sub_field('ingredient_name');?></h2>
						<div class="plus-more">
				<a href="javascript:void(0)" data-toggle="modal" data-target="#myModal"><img src="<?= get_template_directory_uri();?>/assets/images/plus.png" /></a>
							</div>
							
						</div>
                    </div>			
					<?php
 } 
 $Slidecounter++;
 endwhile;
 endif;
 ?>
 				<div class="clearfix"></div>
                </div>
            </div>
        </section>





	<!------- Model 1 --------->
		<div class="modal" id="myModal">
		  <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered">
		    <div class="modal-content">

		      <!-- Modal Header -->
		    
		      <!-- Modal body -->
				<div class="modal-body">
					<div class="modal-header">
						<h4 class="modal-title">Blair Norfolk</h4>  
						<p>Founder, Director, COO</p>   
					</div>

					<div class="model-team-text">
						<p>Blair is the founder of Biome Australia, an innovative, research-focussed company operating in the microbial therapeutics industry. Biome Australia consists of two consumer brands, Activated Nutrients® — certified organic nutrition, and Activated Probiotics® — a range of precision products targeted at specific diseases.</p>
						<p>With a number of personal, pre-existing health conditions, Blair refocussed his career on finding natural health solutions, to prevent serious diseases and improve quality of life for sick people.<br> Blair is an advocate for natural medicine, health related to the gut microbiome, prevention and education. This was the catalyst for the creation of Biome Australia.</p> 
						<p>In Biome Australia Blair has brought together an international team of industry-leading microbiologists, professors, practitioners, and executives to collaborate on the world’s first range of condition-specific probiotics.</p> 
						<p>With a background in FMCG across the USA and Europe, Blair has refined his skill-set to commercialise breakthrough science into consumer health products. With a master’s degree in marketing and a passion for clinical research, Blair and his team have created a new approach to preventative medicine, servicing patients via the Australian pharmacy channel.</p>
						<p>Through his partnerships with leading global universities and industry bodies, Blair is working to help educate health professionals and the public about the future of medical research.</p>
					</div>
				</div>

		      <!-- Modal footer -->  
			 </div> 
			</div>
			 <div class="modal-footer">
        		    <button type="button" class="close team-close" data-dismiss="modal">×</button>
		      </div>
		</div>
<!----- end ----------->	
<?php
get_footer();
?>
