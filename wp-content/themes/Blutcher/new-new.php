<?php
/**
 * The front page template file
 *
 * If the user has selected a static page for their homepage, this is what will
 * appear.
 * Learn more: https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package WordPress
 * @subpackage Twenty_Seventeen
 * @since Twenty Seventeen 1.0
 * @version 1.0
 */

get_header(); ?>

<div class="hero-banner" id="all-page-header-space">
    <div class="hero-banner-inner">
        <div class="top-buthler-home-d">
            <!-- <div class="merry-xmas-head">
                <div class="img"><img src="<?php echo get_site_url();?>/wp-content/themes/Blutcher/assets/images/Merry-Christmas.png" alt=""></div>
                <div class="sap-white-btn"><a href="<?php echo get_site_url();?>/christmas-gifts/">Christmas Gifts</a></div>
            </div> -->
            <div data-aos="fade-up" data-aos-duration="800" data-aos-delay="500"  class="logo">
                <img src="<?php echo get_site_url();?>/wp-content/themes/Blutcher/assets/images/banner-logo.png" alt="">
            </div>
            <div data-aos="fade-up" data-aos-duration="800" data-aos-delay="700" class="hero-heading ">
	            <div class="ani-box">real food</br>for dogs</div>
	        </div>
            <div data-aos="fade-up" data-aos-duration="800" data-aos-delay="900" class="puchline">
            	<div class="">NATURAL. RAW. DELIVERED.</div>
            </div>
        </div>
        <a data-aos="fade-up" data-aos-duration="800" data-aos-delay="1100" data-aos-offset="0" href="#fitbutcherdog"  class="down-arrow">
        	<div class="box-ani"><img src="<?php echo get_site_url();?>/wp-content/themes/Blutcher/assets/images/down-arrow.png" alt=""></div>
        </a>
    </div>
</div>

<div class="fitbutcherdog container" id="fitbutcherdog"> 

    <a href="#" onClick= "modelCalOpen();" class="float-box"><span><img src="<?php echo get_site_url();?>/wp-content/themes/Blutcher/assets/images/food-cal.png" alt=""></span><span>Food calculator</span></a>
    
    <div class="sap-big-heading">“As fit as The Butcher’s Dog”</div>
      <?php        
          if(!is_user_logged_in()  ) {          
           ?>
    <a href="<?php echo get_site_url();?>/my-account/" class="the-dog-btnn"><button class="deskstrtnw">Start Today</button></a>
     <?php  }
   if(is_user_logged_in() ) {   
    ?>
    <a href="<?php echo get_site_url();?>/raw-meals/" class="the-dog-btnn"><button class="deskstrtnw">Shop Now</button></a>
     <?php } ?>
    <div class="fitbutcherdog-inner">
        <div class="fitbutcherdog-tri-sec" id="firsttri-burch">
            <div class="fitbutcherdog-tri-sec-inner">
                <div class="icon"><img src="<?php echo get_site_url();?>/wp-content/themes/Blutcher/assets/images/Rectangle-11.png" alt=""></div>
                <div class="sap-med-heading">RAW <span style="font-family: 'acumin-pro'; font-weight: 600; font-style: italic;">by</span> NATURE</div>
                <div class="text-para">Because dogs are carnivores and feeding a balanced raw diet emulates the food and nutrition that nature intended.</div>
            </div>
            <div class="fitbutcherdog-tri-sec-inner">
                <div class="icon"><img src="<?php echo get_site_url();?>/wp-content/themes/Blutcher/assets/images/Rectangle-10.png" alt=""></div>
                <div class="sap-med-heading">REAL INGREDIENTS</div>
                <div class="text-para">We only use human-grade meat, bones, organs and seasonal vegetables and fruits, farmed right here in Australia.
                </div>
            </div>
        </div>
   


        <div class="fitbutcherdog-tri-sec" id="fitbutcherdog-tri-sec2">
              <img src="<?php echo get_site_url();?>/wp-content/themes/Blutcher/assets/images/TBD_Before_After.gif">
         <!--    <div class="_2ij4cE"> -->
                <!-- <picture>
                    <source type="image/png" srcset="https://www.thefarmersdog.com/images/bowl-mixed-08422a.png">
                    <img alt="Bowl of The Farmer's Dog" class="Yq0BZd">
                </picture>
                <picture>
                    <source type="image/png" srcset="https://www.thefarmersdog.com/images/bowl-ingredients-eb0c55.png">
                    <img alt="Bowl of ingredients" class="inc454" style="clip-path: inset(0px 50.2162% 0px 0px);">
                </picture> -->
                <!-- <div class="_3-V5l2" style="transform: translate(-100.2162%, -50%);"></div> -->
            <!-- </div> -->
        </div>


        <div class="fitbutcherdog-tri-sec" id="last-tri-butchl">
            <div class="fitbutcherdog-tri-sec-inner">
                <div class="icon"><img src="<?php echo get_site_url();?>/wp-content/themes/Blutcher/assets/images/Rectangle-9.png" alt=""></div>
                <div class="sap-med-heading">FORMULATED</div>
                <div class="text-para">Formulated by animal nutritionists to provide natural balanced nutrition. No preservatives, synthetic vitamins & minerals or chemicals.</div>
            </div>
            <div class="fitbutcherdog-tri-sec-inner">
                <div class="icon"><img src="<?php echo get_site_url();?>/wp-content/themes/Blutcher/assets/images/Rectangle-8.png" alt=""></div>
                <div class="sap-med-heading">DELIVERED</div>
                <div class="text-para">One-off or subscription plans delivered frozen directly to your door in our temperature-controlled vans.</div>
                <div class="phonex-home-page"><?php echo do_shortcode( '[phoeniixx-pincode-check]' );?></div>
            </div>
        </div>
        </div>
    </div>
</div>


<div class="category-sec-head">
    <div class="category-sec-inner">
        <div class="dual-sec">
            <div class="dual-sec-inner" id="dual-sec-inner-text">
                <div class="sap-big-heading">Choose your way</div>
                <div class="radio-but">
                    <form action="#">
                        <p class="next">
                            <label for="test1">Combo Boxes</label>
                            <input type="radio" id="test1" name="radio-group" checked>
                          <label>or</label>
                        </p>
                        <p  class="prev">
                          <input type="radio" id="test2" name="radio-group">
                          <label for="test2">Raw Meals</label>
                        </p>
                      </form>
                </div>
                <div class="owl-carousel" id="owlCarousel" >
                    <div class="owl-head-sec">
                        <div class="icon"><img src="<?php echo get_site_url();?>/wp-content/uploads/2020/10/TBD_Combo-Box-1.png" alt=""></div>
                        <div class="sap-med-heading">Combo Boxes</div>
                        <div class="text-para">Not sure where to start? We’ve carefully selected our most popular raw meal combinations. You can add on your choice of  treats and supplements.</div>
                        <div class="owl-but"><a href="<?php echo get_site_url();?>/combo-boxes/">Shop now</a></div>
                    </div>
                    <div class="owl-head-sec">
                        <div class="icon"><img src="<?php echo get_site_url();?>/wp-content/uploads/2020/10/TBD_Build-A-Box.png" alt=""></div>
                        <div class="sap-med-heading">Raw Meals</div>
                        <div class="text-para">Know what your dog likes? Sniff around and select your own variety of meals and treats.</div>
                        <div class="owl-but"><a href="<?php echo get_site_url();?>/raw-meals/">Shop now</a></div>
                    </div>
                </div>

            </div>
        </div>
        <div class="dual-sec" id="prev" ><img src="<?php echo get_site_url();?>/wp-content/uploads/2020/10/Box-Opening-Animation-sequence-1-2.gif" alt=""></div>
        <div class="dual-sec" id="next" style="display: none;"><img src="<?php echo get_site_url();?>/wp-content/uploads/2020/10/TBD_Category_Build-A-Box-2.png" alt=""></div>
    </div>
    <div class="category-sec-inner">
        <div class="dual-sec">
            <div class="dual-sec-inner" id="dual-sec-inner-text">
                <div class="sap-big-heading">ADD TO YOUR ORDER</div>
                <div class="radio-but">
                    <form action="#">
                        <p class="nextTwo">
                            <label for="test3">Treats</label>
                          <input type="radio" id="test3" name="radio-group" checked>
                          <label>&</label>
                        </p>
                        <p class="prevTwo">
                          <input type="radio" id="test4"  name="radio-group">
                          <label for="test4">Apothecary</label>
                        </p>
                      </form>
                </div>
                <div class="owl-carousel" id="owlCarouselTwo" >
                    <div class="owl-head-sec">
                        <div class="icon"><img src="<?php echo get_site_url();?>/wp-content/uploads/2020/10/TBD_Treats-1.png" alt=""></div>
                        <div class="sap-med-heading">Treats</div>
                        <div class="text-para">Add some healthy air-dried treats to your box. Great for training or to keep them entertained.</div>
                        <div class="owl-but"><a href="<?php echo get_site_url();?>/treats/">Shop now</a></div>
                    </div>
                    <div class="owl-head-sec">
                        <div class="icon"><img src="<?php echo get_site_url();?>/wp-content/uploads/2020/10/TBD_Apothecary-1.png" alt=""></div>
                        <div class="sap-med-heading">Apothecary</div>
                        <div class="text-para">A range of pre & probiotics, and homeopathic remedies designed to support your dog’s health, from the inside out.  Imported from Canada.</div>
                        <div class="owl-but"><a href="<?php echo get_site_url();?>/apothecary/">Shop now</a></div>
                    </div> 
                </div>
            </div>
        </div>
        <div class="dual-sec prevTwoId" id=" black-round "><img src="<?php echo get_site_url();?>/wp-content/uploads/2020/10/TBD_Category_Treats-2.png" alt=""></div>
        <div class="dual-sec nextTwoId" id=" black-round " style="display: none;"><img src="<?php echo get_site_url();?>/wp-content/uploads/2020/10/TBD_Category_Apothecary-2.png" alt=""></div>
    </div>
</div>


<div class="customer-story container">
    <div class="subtitle-postieo">CUSTOMER STORIES</div>
    <div class="owl-carousel">
        <?php
        $ctr=1;
$Slidecounter=1;
 if( have_rows('customer') ):
 while( have_rows('customer') ): the_row();
 if($Slidecounter=='1'){
 ?>
        <div class="owl-head-sec">
            <div class="cust-story-inner">

                <div class="dual-sec">
                    <div class="subtitle torise-mobail">CUSTOMER STORIES</div>
                    <div class="customer-heading aos-init" data-aos="fade-left" data-aos-easing="linear" data-aos-duration="200">
                        <?php the_sub_field('customer_head'); ?></div>

                    <div class="text-para aos-init" data-aos="fade-left" data-aos-easing="linear" data-aos-duration="1000"><?php the_sub_field('customer_text'); ?></div>

                    <div class="dog-bot-sub aos-init" data-aos="fade-left" data-aos-easing="linear" data-aos-duration="1200"><?php the_sub_field('customer_author'); ?></br><span><?php the_sub_field('customer_title'); ?></span></div>

                    <!-- <div class="video-wathc-butc aos-init" data-aos="fade-left" data-aos-easing="linear" data-aos-duration="400">
                        <a  class="watch-video-but">
                            <div><span><?php //the_sub_field('youtube_title'); ?></span><span class="all-toggle-design-bu" data-toggle="modal" data-target="#video-Moda2<?php //echo $ctr;?>"><img src="<?php //echo get_site_url();?>/wp-content/themes/Blutcher/assets/images/play-button.png" alt=""></span></div>
                        </a>
                    </div> -->
                </div>


                <div class="dual-sec onlu-right-side-dogvideo aos-init" data-aos="fade-left" data-aos-easing="linear" data-aos-duration="500">
                    <!-- Video Section -->
                    <img src="<?php the_sub_field('customer_image'); ?>" alt="">
                    <span class="all-toggle-design-bu" data-toggle="modal" data-target="#video-Moda2<?php echo $ctr;?>"><img src="<?php echo get_site_url();?>/wp-content/themes/Blutcher/assets/images/play-button.png" alt=""></span>
                </div>
            </div>
        </div>
<?php
 }
 if($Slidecounter!='1'){
 ?>
         <div class="owl-head-sec">
            <div class="cust-story-inner">

                <div class="dual-sec">
                    <div class="subtitle" data-aos="fade-left" data-aos-easing="linear" data-aos-duration="200">CUSTOMER STORIES</div>
                    <div class="customer-heading aos-init" data-aos="fade-left" data-aos-easing="linear" data-aos-duration="200">
                        <?php the_sub_field('customer_head'); ?></div>

                    <div class="text-para aos-init" data-aos="fade-left" data-aos-easing="linear" data-aos-duration="1000"><?php the_sub_field('customer_text'); ?></div>

                    <div class="dog-bot-sub aos-init" data-aos="fade-left" data-aos-easing="linear" data-aos-duration="1500"><?php the_sub_field('customer_author'); ?></br><span><?php the_sub_field('customer_title'); ?></span></div>

                    <!-- <div class="video-wathc-butc aos-init" data-aos="fade-left" data-aos-easing="linear" data-aos-duration="200">
                        <a  class="watch-video-but">
                            <div><span><?php the_sub_field('youtube_title'); ?></span><span class="all-toggle-design-bu" data-toggle="modal" data-target="#video-Moda2<?php echo $ctr;?>"><img src="<?php echo get_site_url();?>/wp-content/themes/Blutcher/assets/images/play-button.png" alt=""></span></div>
                        </a>
                    </div> -->
                </div>


                <div class="dual-sec onlu-right-side-dogvideo aos-init" data-aos="zoom-in" data-aos-easing="linear" data-aos-duration="500">
                    <!-- Video Section -->
                    <img src="<?php the_sub_field('customer_image'); ?>" alt="">
                    <span class="all-toggle-design-bu" data-toggle="modal" data-target="#video-Moda2<?php echo $ctr;?>"><img src="<?php echo get_site_url();?>/wp-content/themes/Blutcher/assets/images/play-button.png" alt=""></span>
                </div>
            </div>
        </div>

<?php
 } 
 $Slidecounter;
 $ctr++;
 endwhile;
 endif;
 ?>

    </div>
</div>


 <?php
        $ctr=1;
$Slidecounter=1;
 if( have_rows('customer') ):
 while( have_rows('customer') ): the_row();
 if($Slidecounter=='1'){
 ?>
            
            <div class="modal" id="video-Moda2<?php echo $ctr; ?>" aria-modal="true" style="padding-right: 17px; display: none;">
                    <button type="button" class="close" data-dismiss="modal">×</button>
                <div class="modal-dialog model-container container">
                    <div class="modal-content">
                      <!-- Modal body -->
                      <div class="modal-video">
                            <?php the_sub_field('youtube_iframe'); ?>                        
                      </div>

                    </div>
                </div>
            </div>
<?php
 }
 if($Slidecounter!='1'){
 ?>
            <div class="modal" id="video-Moda2<?php echo $ctr; ?>" aria-modal="true" style="padding-right: 17px; display: none;">
                    <button type="button" class="close" data-dismiss="modal">×</button>
                <div class="modal-dialog model-container container">
                    <div class="modal-content">
                      <!-- Modal body -->
                      <div class="modal-video">
                            <?php the_sub_field('youtube_iframe'); ?>                        
                      </div>

                    </div>
                </div>
            </div>
<?php
 } 
 $Slidecounter;
 $ctr++;
 endwhile;
 endif;
 ?>

<div class="deli-zone container">
    <div class="dual-sec">
        <div class="dual-sec-inner"><img src="<?php the_field('stockist_image');?>" alt=""></div>
        <div class="dual-sec-inner">
            <div class="sap-big-heading"><?php the_field('srockist_heading');?></div>
            <div class="text-para"><?php the_field('stockist_text');?></div>
            <div class="stockist-but"><a href="<?php the_field('button_link');?>"><?php the_field('button_text');?></a></div>
        </div>
    </div>
</div>

<div class="featured-meals container">
    <div class="subtitle">FEATURED MEALS</div>
    <div class="sap-big-heading">The most important health decision you make for your dog <br>is what you put in their bowl.</div>
    <div class="owl-carousel prod" id="owl-prod">
        <?php
    $args = array( 'post_type' => 'product', 'posts_per_page' => 20, 'product_cat' => "raw-meals", 'order'=>'ASC');
    
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
        <div class="owl-head-sec">
            <?php if($product->get_stock_quantity()==0) {?>
                                <div class="out_stock_box"><span>Out of Stock</span></div>
                           <?php }
                        ?>
            <div class="on-hover-all-build">
                <img class="build-whithout-hover2" src="<?php the_field('disc_image'); ?>">
                <img class="buld-hover2" src="<?php the_field('bag_image');?>">
            </div>
            <div class="prod-title"><?php the_title();?></div>
            <div class="prod-des">
                <span><?php the_field('product_weight');?></span>
                <span><?php the_field('product_discs');?> discs</span>
            </div>
            <div class="prod-but">
                <a href="<?php the_permalink($loop->ID); ?>">View Product</a>
                <?php /*if($product->get_stock_quantity()>0) {
                                 echo '<a href="?add-to-cart='.$current_product_id.'">Add to Box</a>';
                            } else {
                                echo '<a href="#" class="oos">Out Of Stock</a>';
                                
                            }*/
                        ?>
            </div>
        </div>
        <?php
                    $ctr++;
            endwhile;?>
<?php endif; ?>
        
      
    </div>
</div>



<?php //echo do_shortcode("[instagram-feed num=4 cols=4 showfollow=false]");?>
<?php //dynamic_sidebar('sidebar-2');?>

<div class="subscribe-sec container">
    <div class="subtitle">WELCOME DEAL</div>
    <div class="subs-heading">Don’t worry, we don’t bite!</br>
        <span>Register and receive $10 Off your first Combo Box!</span>
    </div>
    <a href="<?php echo get_site_url();?>/my-account/"><input type="button" value="Register"></a>

    
</div>

<style>
    .wc-delivery-time-response:after {
    content: '';
}
</style>
<?php
get_footer();
