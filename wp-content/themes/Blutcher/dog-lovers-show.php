<?php
/* template name: Dog Lover Show */

get_header();

?>


<div class="dogs-lover-page">
    <section class="dog-lover grey-back">
        <div class="dl-back-art" id="dl-back-art1"><img src="https://thebutchersdog.com.au/wp-content/uploads/2022/08/Lamb.png" alt=""></div>
        <div class="dl-back-art" id="dl-back-art2"><img src="https://thebutchersdog.com.au/wp-content/uploads/2022/08/Blueberries.png" alt=""></div>
        <div class="dl-back-art" id="dl-back-art3"><img src="https://thebutchersdog.com.au/wp-content/uploads/2022/08/Kale.png" alt=""></div>
        <div class="dl-back-art" id="dl-back-art4"><img src="https://thebutchersdog.com.au/wp-content/uploads/2022/08/Spinach.png" alt=""></div>
        <div class="dl-back-art" id="dl-back-art5"><img src="https://thebutchersdog.com.au/wp-content/uploads/2022/08/Steak.png" alt=""></div>
        <div class="dog-lover-inner container">
            <div class="sap-dot-big-heading"><?php the_field('heading');?><sup>*</sup></div>
            <div class="sub-heading"><?php the_field('sub_heading');?></div>
            <div class="text-para">
                <?php the_field('content');?>
            </div>
            <div class="dog-lover-form-head">
                <div class="sap-wide-subtext">ENTER YOUR DETAILS FOR A CHANCE TO WIN</div>

                <div class="klaviyo-form-XXXSiu"></div>
                <!-- INTEGRATE FORM HERE -->

            </div>
            <div class="dog-lover-parternship">
                <div class="dlp-img"><img src="https://thebutchersdog.com.au/wp-content/uploads/2022/08/CHWC_Logo.png" alt=""></div>
                <div class="text-para">In partnership with Canine Holistic Wellness Centre </div>
            </div>
        </div>
    </section>
    <section class="dog-lover-tnc black-back">
        <div class="dog-lover-tnc-inner container">
            <div class="dl-tnc-heading">Terms and Conditions</div>
             <?php the_field('term_Conditions');?>
        </div>
    </section>
</div>





<?php
get_footer();
?>