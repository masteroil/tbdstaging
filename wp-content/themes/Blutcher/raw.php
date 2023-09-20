<?php
/* template name: raw */

get_header();

?>





<link href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.6.0/slick.css" rel="stylesheet" />
<link href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.6.0/slick-theme.css" rel="stylesheet" />
<style>
  section#demos .owl-nav {
    display: none;
  }

  .slider.slider-x.slick-initialized.slick-slider {
    margin-top: 100px;
    padding-bottom: 41px;
  }

  .slick-slide {

    color: white;
    padding: 40px 0;
    font-size: 30px;
    font-family: "Arial", "Helvetica";
    text-align: center;
  }

  .slick-arrow:before {
    color: black;
  }

  .slick-dots {
    bottom: -30px;
  }

  /*.slick-slide:nth-child(odd) {
  background: #e84a69;
}*/

  .slider {
    margin: 0 30px;
  }
</style>
<section class="top-raw" id="all-page-header-space">
  <div class="container">
    <div class="inner-top-raw">
      <div class="text-area">
        <h1>
          <?php the_field('title'); ?>
        </h1>
        <?php the_field('content'); ?>
        <!--img src="https://thebutchersdog.oxdigital.com.au/wp-content/uploads/2022/06/Scroll-down.png"-->
        <a href="#chosse-scrool" class="down-arrow-h"><i class="fa fa-chevron-down" aria-hidden="true"></i></a>
      </div>
    </div>
  </div>
  <div class="Dog-img">
    <img src="<?php the_field('feed_image'); ?>">
    <div class="wfr-floating-text" id="wfr-floating-text1">REAL DOGS REAL FOOD</div>
    <div class="wfr-floating-text" id="wfr-floating-text2">
      Higher quality produce means your dog is getting significantly more nutrients and goodness
    </div>
  </div>
</section>



<section class="choose-why" id="chosse-scrool">


  <div class="container">

    <div class="chose-why-head" id="why-choose">
      <h6>
        <?php the_field('heading'); ?>
      </h6>
      <p>
        <?php the_field('sub_heading'); ?>
      </p>
    </div>

    <div class="ch-why-inner">
      <div class="flex-why">
        <div class="ch-1 test">
          <img src="<?php echo site_url(); ?>/wp-content/uploads/2022/07/Why_Raw_1.png">
          <p>We use premium Australian ingredients and ethical manufacturing processes</p>
        </div>

        <div class="ch-img">
          <img src="<?php the_field('butcher_image'); ?>">
        </div>

        <div class="ch-1">
          <img src="<?php echo site_url(); ?>/wp-content/uploads/2022/07/Why_Raw_2.png">
          <p>We don’t cut corners or compromise at all, our food is all natural and all great</p>
        </div>
      </div>

      <div class="flex-why flex-why-2">

        <div class="ch-1 po-left">
          <img src="<?php echo site_url(); ?>/wp-content/uploads/2022/07/Why_Raw_3.png">
          <p>Our raw food is exactly what we say it is, no hidden ingredients and no chemicals</p>
        </div>

        <div class="ch-1 po-right">
          <img src="<?php echo site_url(); ?>/wp-content/uploads/2022/07/Why_Raw_4.png">
          <p>We want only the best for your dog, high quality food has higher nutritional value</p>
        </div>

      </div>
    </div>

  </div>
  <div class="ss_pp">
    <a href="#" onClick="location.href='<?php echo site_url(); ?>/shop-2/'">Shop now!</a>
  </div>
</section>




<section class="benifits-box desktop-only">
  <div class="container">
    <div class="inner-beni">
      <div class="chose-why-head">
        <h6>
          <?php the_field('title_row'); ?>
        </h6>
        <?php the_field('content_row'); ?>
      </div>
      <div class="benifits-tabs">
        <div class="left-beni-tab">

          <ul class="nav nav-tabs" role="tablist">
            <?php
            $count = 1;
            if (have_rows('dog_icons')):
              while (have_rows('dog_icons')):
                the_row();
                if ($count == '1') {
                  ?>
                  <li class="nav-item">
                    <a class="nav-link active" data-toggle="tab" id="main<?php echo $count; ?>"
                      href="#menu<?php echo $count; ?>">
                      <img src="<?php the_sub_field('image'); ?>">
                      <img class="hover-show" src="<?php the_sub_field('hover_image'); ?>">
                    </a>
                  </li>
                <?php }
                if ($count != '1') { ?>
                  <li class="nav-item">
                    <a class="nav-link" data-toggle="tab" id="main<?php echo $count; ?>" href="#menu<?php echo $count; ?>">
                      <img src="<?php the_sub_field('image'); ?>">
                      <img class="hover-show" src="<?php the_sub_field('hover_image'); ?>">
                    </a>
                  </li>
                <?php }
                $count++;
              endwhile;
            endif;

            ?>


          </ul>



          <div class="tab-content dog-image">
            <?php $count = 1;
            if (have_rows('dog_icons')):
              while (have_rows('dog_icons')):
                the_row();
                if ($count == '1') {

                  ?>
                  <div id="menu<?php echo $count; ?>" class="container tab-pane active">
                    <h6>
                      <?php the_sub_field('title'); ?>
                    </h6>
                    <p>
                      <?php the_sub_field('content'); ?>
                    </p>
                  </div>

                <?php }
                if ($count != '1') { ?>
                  <div id="menu<?php echo $count; ?>" class="container tab-pane">
                    <h6>
                      <?php the_sub_field('title'); ?>
                    </h6>
                    <p>
                      <?php the_sub_field('content'); ?>
                    </p>
                  </div>
                <?php }
                $count++;
              endwhile;
            endif;

            ?>

          </div>
        </div>

        <div class="right-beni-tab tab-content dog-image">
          <?php $countt = 1;
          if (have_rows('dog_icons')):
            while (have_rows('dog_icons')):
              the_row();
              if ($countt == '1') {

                ?>
                <div id="menu<?php echo $countt; ?>" class="container tab-pane active">
                  <img src="<?php the_sub_field('dog_image'); ?>">
                </div>
              <?php }
              if ($countt != '1') { ?>

                <div id="menu<?php echo $countt; ?>" class="container tab-pane">
                  <img src="<?php the_sub_field('dog_image'); ?>">
                </div>
              <?php }
              $countt++;
            endwhile;
          endif;

          ?>
        </div>

      </div>

    </div>
  </div>
  </div>
</section>


<section class="benifits-box mobile-only">
  <div class="container">
    <div class="inner-beni">
      <div class="chose-why-head">
        <h6>
          <?php the_field('title_row'); ?>
        </h6>
        <?php the_field('content_row'); ?>
      </div>
      <div class="benifits-tabs">
        <div class="left-beni-tab">

          <!-- crousal -->
          <!--  Demos -->
          <!--  <section id="demos" class="dog-icon-image">
          <div class="loop1 owl-carousel owl-carousel-two owl-theme">
             <?php
             if (have_rows('dog_icons')):
               while (have_rows('dog_icons')):
                 the_row();


                 ?>
            <div class="item ">
              <a class="nav-link active" data-toggle="tab" href="#menu1"> 
               
                   <img src="<?php the_sub_field('dog_image'); ?>">
                   <img class="hover-show" src="<?php the_sub_field('dog_image'); ?>">
                      </a>
                     
            </div>
            <?php
               endwhile;
             endif;

             ?>
           
</div>
</section>  -->


          <!-- <section id="demos">
          <div class="loop owl-carousel owl-carousel-two  owl-theme">
             <?php
             if (have_rows('dog_icons')):
               while (have_rows('dog_icons')):
                 the_row();


                 ?>
            <div class="item">
              <a class="nav-link active" data-toggle="tab" href=""> 
                         <img src="<?php the_sub_field('image'); ?>">
                        <img class="hover-show" src="<?php the_sub_field('hover_image'); ?>">
                      </a>
            </div>
             <?php
               endwhile;
             endif;

             ?>
            
          </div>
</section> -->

          <!--  <section id="demos">
          <div class="loop1 owl-carousel owl-carousel-two owl-theme">
             <?php
             if (have_rows('dog_icons')):
               while (have_rows('dog_icons')):
                 the_row();


                 ?>
            <div class="item">
              <a class="nav-link active" data-toggle="tab" href="#menu1"> 
                <h6><?php the_sub_field('title'); ?></h6>
                 <p><?php the_sub_field('content'); ?></p>
                      </a>
            </div>
            <?php
               endwhile;
             endif;

             ?>
           
</div>
</section>
 -->

          <!-- Slider for mobile -->
          <div class="slider slider-x">
            <?php
            if (have_rows('dog_icons')):
              while (have_rows('dog_icons')):
                the_row();


                ?>
                <div class="item"><img src="<?php the_sub_field('dog_image'); ?>"></div>

                <?php
              endwhile;
            endif;

            ?>

          </div>

          <div class="slider slider-nav">
            <?php
            if (have_rows('dog_icons')):
              while (have_rows('dog_icons')):
                the_row();


                ?>
                <div class="item"><img class="without_current" src="<?php the_sub_field('image'); ?>">
                  <img class="hover-show" src="<?php the_sub_field('hover_image'); ?>">
                </div>

                <?php
              endwhile;
            endif;

            ?>


          </div>

          <div class="slider slider-for">
            <?php
            if (have_rows('dog_icons')):
              while (have_rows('dog_icons')):
                the_row();


                ?>
                <!-- <div><h3>2015</h3></div> -->
                <div class="item">
                  <h6>
                    <?php the_sub_field('title'); ?>
                  </h6>
                  <p>
                    <?php the_sub_field('content'); ?>
                  </p>
                </div>

                <?php
              endwhile;
            endif;

            ?>


          </div>


          <!-- EnsSlider for mobile -->



        </div>

        <div class="right-beni-tab">
          <img src="<?php the_field('dog_image'); ?>">
        </div>

      </div>

    </div>
  </div>
  </div>
</section>






<!-- End - crousal -->

<section class="choice-box">
  <div class="container">
    <div class="inner-choice">
      <div class="po-img">
        <img src="/wp-content/uploads/2022/07/TBD_Food_Image_Desktop.png" class="why-raw-testi-art-desktop">
        <img src="/wp-content/uploads/2022/07/TBD_Food_Image_Mobile.png" class="why-raw-testi-art-mobile">
      </div>
      <div class="choice-text">
        <div class="choice-text-img"><img src="<?php the_field('custom_image'); ?>" alt=""></div>
        <div class="choice-text-con">
          <?php the_field('custom_review'); ?>
          <div class="name-user">
            <h6>
              <?php the_field('custom_name'); ?>
            </h6>
            <span>Cancer survivor and mother of Roux</span>
          </div>
        </div>

      </div>


      <div class="chunky-text">
        <h6>Chunky Beef <br>and Vegetable</h6>

        <div class="span-box">
          <span>1.55kg</span>
          <span>6 discs</span>
        </div>

        <a href="<?php echo site_url(); ?>/shop-2">Shop now!</a>
      </div>


    </div>
  </div>
</section>


<section class="ABOUT_KIBBLE">
  <div class="container">
    <div class="about_kibble_inner">
      <div class="chose-why-head">
        <h6>
          <?php the_field('realise_title'); ?>
        </h6>
        <p>
          <?php the_field('realise_subtitle'); ?>
        </p>
      </div>

      <div class="ak-mobile">

        <div class="slider slider-forr">
          <?php
          if (have_rows('highly_processed_diet')):
            while (have_rows('highly_processed_diet')):
              the_row();


              ?>
              <!-- <div><h3>2015</h3></div> -->
              <div class="item">
                <img src="<?php the_sub_field('image'); ?>">
                <?php the_sub_field('content'); ?>
              </div>

              <?php
            endwhile;
          endif;

          ?>


        </div>



      </div>

      <div class="ak-box ak-desktop">
        <?php

        if (have_rows('highly_processed_diet')):
          while (have_rows('highly_processed_diet')):
            the_row(); ?>

            <div class="ak1">
              <img src="<?php the_sub_field('image'); ?>">
              <?php the_sub_field('content'); ?>
            </div>

          <?php endwhile;
        endif;
        ?>

      </div>
    </div>
  </div>
</section>



<section class="WHAT_STAYS_OUT">
  <div class="container">
    <div class="about_kibble_inner">
      <div class="chose-why-head">
        <h6>
          <?php the_field('stays_out_heading'); ?>
        </h6>
        <p>
          <?php the_field('stays_out_content'); ?>
        </p>
      </div>

      <div class="list-style">

        <div class="left-list">
          <?php
          $count = 1;
          if (have_rows('say_out_decription')):
            while (have_rows('say_out_decription')):
              the_row();
              if ($count <= 4) {
                ?>
                <div class="single-list">
                  <span><img src="<?php the_sub_field('icons'); ?>"></span>
                  <p>
                    <?php the_sub_field('content'); ?>
                  </p>
                </div>


              <?php }
              $count++;
            endwhile;
          endif;
          ?>


        </div>

        <div class="right-list">
          <?php
          $count = 4;
          if (have_rows('say_out_decription')):
            while (have_rows('say_out_decription')):
              the_row();
              if ($count >= 8) {
                ?>
                <div class="single-list">
                  <span><img src="<?php the_sub_field('icons'); ?>"></span>
                  <p>
                    <?php the_sub_field('content'); ?>
                  </p>
                </div>

              <?php }
              $count++;
            endwhile;
          endif;
          ?>


        </div>
      </div>
    </div>


</section>


<section class="Formulated">
  <div class="container">
    <div class="inner-Formulated">
      <div class="heading-head">
        <h6>
          <?php the_field('formulated_title'); ?>
        </h6>
      </div>

      <div class="main-fore">
        <div class="left-form">
          <span class="professional-head">PROFESSIONAL TESTIMONIAL</span>
          <span class="professional-text">
            <?php the_field('testimonial'); ?>
          </span>
          <span class="professional-subtext"> As a vet I know that vegetables, fruits along with high quality
            protein is essential for a dog’s wellbeing and longevity.</span>
          <div class="writer-name-pro">
            <div class="writer-name">
              <?php the_field('author_name'); ?>
            </div>
            <div class="writer-tag-line">Mother of Marley, Teddy & Issy</div>
          </div>
        </div>
        <div class="right-form-img">
          <!--img src="<!-?php the_field('formulated_image');?->"--->
          <div class="video-bb">

            <!-- <iframe src="https://player.vimeo.com/video/680769087?h=131744f551" width="640" height="360" frameborder="0" allow="autoplay; fullscreen; picture-in-picture" allowfullscreen></iframe> -->
            <iframe
              src="https://player.vimeo.com/video/680769087?h=131744f551&amp;badge=0&amp;autopause=0&amp;player_id=0&amp;app_id=58479"
              frameborder="0" allow="autoplay; fullscreen; picture-in-picture" allowfullscreen
              style="position:absolute;top:0;left:0;width:100%;height:100%;"
              title="The Butcher&amp;rsquo;s Dog &amp;reg; | Dr Louise"></iframe>
            <script src="https://player.vimeo.com/api/player.js"></script>
          </div>

          <span class="video-icon"></span>
        </div>
        <div class="review-btn">
          <a href="https://thebutchersdog.com.au/reviews/">Reviews</a>
        </div>
      </div>
    </div>
  </div>
</section>





<?php
get_footer();
?>
<!-- javascript -->
<!--  <script src="<?php echo site_url(); ?>/wp-content/themes/Blutcher/assets/owlcarousel/jquery.min.js"></script> -->
<!--  <script src="<?php echo site_url(); ?>/wp-content/themes/Blutcher/assets/owlcarousel/owl.carousel.js"></script>
     <script src="<?php echo site_url(); ?>/wp-content/themes/Blutcher/assets/owlcarousel/highlight.js"></script>
    <script src="<?php echo site_url(); ?>/wp-content/themes/Blutcher/assets/owlcarousel/app.js"></script>  -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.6.0/slick.js"></script>
<script>
  $('.slider-forr').slick({
    arrows: true,
    asNavFor: '.slider-nav,.slider-x',
  });
  $('.slider-for').slick({
    arrows: false,
    asNavFor: '.slider-nav,.slider-x',
  });
  $('.slider-x').slick({
    arrows: true,
    asNavFor: '.slider-for,.slider-nav',
  });
  $('.slider-nav').slick({
    arrows: true,
    asNavFor: '.slider-for,.slider-x',
    centerMode: true,
    centerPadding: '60px',
    dots: true,
    focusOnSelect: true,
    slidesToShow: 5,
    responsive: [{
      breakpoint: 1024,
      settings: {
        slidesToShow: 5,
        slidesToScroll: 5,
      }
    }, {
      breakpoint: 640,
      settings: {
        slidesToShow: 5,
        slidesToScroll: 5,
      }
    }, {
      breakpoint: 420,
      settings: {
        slidesToShow: 5,
        slidesToScroll: 5,
      }
    }]
  });
  $.noConflict();
</script>
<script>
  jQuery('.nav-item').click(function () {
    var href = jQuery(this).find('a').attr('href');
    if (href == '#menu1') {
      jQuery('.dog-image .tab-pane').removeClass('active');
      jQuery('.dog-image #menu1').addClass('active');
    }
    if (href == '#menu2') {
      jQuery('.dog-image .tab-pane').removeClass('active');
      jQuery('.dog-image #menu2').addClass('active');
    }
    if (href == '#menu3') {
      jQuery('.dog-image .tab-pane').removeClass('active');
      jQuery('.dog-image #menu3').addClass('active');
    }
    if (href == '#menu4') {
      jQuery('.dog-image .tab-pane').removeClass('active');
      jQuery('.dog-image #menu4').addClass('active');
    }
    if (href == '#menu5') {
      jQuery('.dog-image .tab-pane').removeClass('active');
      jQuery('.dog-image #menu5').addClass('active');
    }
    if (href == '#menu6') {
      jQuery('.dog-image .tab-pane').removeClass('active');
      jQuery('.dog-image #menu6').addClass('active');
    }
    if (href == '#menu7') {
      jQuery('.dog-image .tab-pane').removeClass('active');
      jQuery('.dog-image #menu7').addClass('active');
    }
    if (href == '#menu8') {
      jQuery('.dog-image .tab-pane').removeClass('active');
      jQuery('.dog-image #menu8').addClass('active');
    }
    if (href == '#menu9') {
      jQuery('.dog-image .tab-pane').removeClass('active');
      jQuery('.dog-image #menu9').addClass('active');
    }
    if (href == '#menu10') {
      jQuery('.dog-image .tab-pane').removeClass('active');
      jQuery('.dog-image #menu10').addClass('active');
    }
    if (href == '#menu11') {
      jQuery('.dog-image .tab-pane').removeClass('active');
      jQuery('.dog-image #menu11').addClass('active');
    }
  });

  jQuery('.nav-item').hover(function () {
    var href = jQuery(this).find('a').attr('href');

    if (href == '#menu1') {
      jQuery('.dog-image .tab-pane').removeClass('active');
      jQuery('.dog-image #menu1').toggleClass('active');
    }
    if (href == '#menu2') {
      jQuery('.dog-image .tab-pane').removeClass('active');
      jQuery('.dog-image #menu2').toggleClass('active');
    }
    if (href == '#menu3') {
      jQuery('.dog-image .tab-pane').removeClass('active');
      jQuery('.dog-image #menu3').toggleClass('active');
    }
    if (href == '#menu4') {
      jQuery('.dog-image .tab-pane').removeClass('active');
      jQuery('.dog-image #menu4').toggleClass('active');
    }
    if (href == '#menu5') {
      jQuery('.dog-image .tab-pane').removeClass('active');
      jQuery('.dog-image #menu5').toggleClass('active');
    }
    if (href == '#menu6') {
      jQuery('.dog-image .tab-pane').removeClass('active');
      jQuery('.dog-image #menu6').toggleClass('active');
    }
    if (href == '#menu7') {
      jQuery('.dog-image .tab-pane').removeClass('active');
      jQuery('.dog-image #menu7').toggleClass('active');
    }
    if (href == '#menu8') {
      jQuery('.dog-image .tab-pane').removeClass('active');
      jQuery('.dog-image #menu8').toggleClass('active');
    }
    if (href == '#menu9') {
      jQuery('.dog-image .tab-pane').removeClass('active');
      jQuery('.dog-image #menu9').toggleClass('active');
    }
    if (href == '#menu10') {
      jQuery('.dog-image .tab-pane').removeClass('active');
      jQuery('.dog-image #menu10').toggleClass('active');
    }
    if (href == '#menu11') {
      jQuery('.dog-image .tab-pane').removeClass('active');
      jQuery('.dog-image #menu11').toggleClass('active');
    }

  }

    // ,function () {
    //        jQuery('.dog-image .tab-pane').removeClass('active');
    //      jQuery('.dog-image #menu11').addClass('active');
    //    }

  );
  //jQuery('.dog-image #menu11').addClass('active');
  //  jQuery('.nav-tabs li.nav-item a').eq(10).addClass('active');


  jQuery('.nav-item').hover(function () {
    var href = jQuery(this).find('a').attr('href');
    if (href == '#menu1') {
      // alert(href);
      jQuery('.nav-link ').removeClass('active');
      jQuery(".nav-item a#main1").addClass('active');
    }
    if (href == '#menu2') {

      jQuery('.nav-link ').removeClass('active');
      jQuery(".nav-item a#main2").addClass('active');
    }
    if (href == '#menu2') {

      jQuery('.nav-link ').removeClass('active');
      jQuery(".nav-item a#main2").addClass('active');
    }
    if (href == '#menu3') {

      jQuery('.nav-link ').removeClass('active');
      jQuery(".nav-item a#main3").addClass('active');
    }
    if (href == '#menu4') {

      jQuery('.nav-link ').removeClass('active');
      jQuery(".nav-item a#main4").addClass('active');
    }
    if (href == '#menu5') {

      jQuery('.nav-link ').removeClass('active');
      jQuery(".nav-item a#main5").addClass('active');
    }
    if (href == '#menu6') {

      jQuery('.nav-link ').removeClass('active');
      jQuery(".nav-item a#main6").addClass('active');
    }
    if (href == '#menu7') {

      jQuery('.nav-link ').removeClass('active');
      jQuery(".nav-item a#main7").addClass('active');
    }
    if (href == '#menu8') {

      jQuery('.nav-link ').removeClass('active');
      jQuery(".nav-item a#main8").addClass('active');
    }
    if (href == '#menu9') {

      jQuery('.nav-link ').removeClass('active');
      jQuery(".nav-item a#main9").addClass('active');
    }
    if (href == '#menu10') {

      jQuery('.nav-link ').removeClass('active');
      jQuery(".nav-item a#main10").addClass('active');
    }
    if (href == '#menu11') {

      jQuery('.nav-link ').removeClass('active');
      jQuery(".nav-item a#main11").addClass('active');
    }

  })
</script>
<script>
  $("#chosse-scrool").click(function (e) {
    e.preventDefault();
    $('html, body').animate({
      scrollTop: $("#chosse-scrool").offset().top
    }, 5000);
  });

  jQuery(document).ready(function () {
    jQuery('#cus-nav').click(function () {
      jQuery("#cus-show").slideToggle(600);
    });
  });
  $('#cus-nav').click(function (e) {

    e.stopPropagation();
  });
  jQuery('body').click(function () {
    jQuery('#cus-show').slideUp();
  });

  $("#cus-nav1").click(function () {
    $("body").addClass("m-open");
  });

  $(".abs-ic").click(function () {
    $("body").removeClass("m-open");
  });
</script>