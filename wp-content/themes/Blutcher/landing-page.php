<?php
/* template name: Landing page*/

include 'Landingpageheader.php';

?>
<div class="banner">
    <div class="desktop-banner">
        <?php
     $image = get_field('banner');
      if ( !empty($image) ): ?>
        <img src="<?php echo $image['url']; ?>" alt="<?php echo $image['alt']; ?>" />
        <?php endif; ?>
    </div>
    <div class="mobile-banner">
        <?php
      $image = get_field('banner_mobile');
      if ( !empty($image) ): ?>
        <img src="<?php echo $image['url']; ?>" alt="<?php echo $image['alt']; ?>" />
        <?php endif; ?>
    </div>
    <div class="centered">
        <h1>
            <?php the_field('banner_title') ?>
        </h1>
    </div>
    <div class="centered">
        <h3>
            <?php the_field('banner_description') ?>
        </h3>
    </div>
</div>
<div class="after-banner">
    <h3>
        <?php the_field('after_banner') ?>
    </h3>
    <p><?php the_field('after_banner_description') ?></p>
    <button class="btn-sign"><a href="#sign-up">Sign Up Now</a></button>
</div>
<div class="why-raw">
    <div class="raw-img-desktop">
        <?php
          $image = get_field('raw_image');
            if ( !empty($image) ): ?>
        <img src="<?php echo $image['url']; ?>" alt="<?php echo $image['alt']; ?>" />
        <?php endif; ?>
    </div>
    <div class="raw-text">
        <span><?php the_field('raw_title') ?></span>
        <p><?php the_field('raw_description') ?></p>
        <button class="btn-raw"><a href="#sign-up">Sign Up Now</a></button>
    </div>
    <div class="raw-img-mobile">
        <?php
            $image = get_field('raw_image');
            if ( !empty($image) ): ?>
        <img src="<?php echo $image['url']; ?>" alt="<?php echo $image['alt']; ?>" />
        <?php endif; ?>
    </div>
</div>
<div class="benefits">
    <div class="benefits-title">BENEFITS OF FEEDING RAW</div>
    <div class="benefits-section">
        <div class="columns-row">
            <div class="list-row">
                <div class="list-img"><img src="https://1504726.blz.onl/wp-content/uploads/2022/03/check.png"></div>
                <div class="list-text">Reduced allergies, itching and inflammation</div>
            </div>
            <div class="list-row">
                <div class="list-img"><img src="https://1504726.blz.onl/wp-content/uploads/2022/03/check.png"></div>
                <div class="list-text">Softer shiny coat with less shedding </div>
            </div>
            <div class="list-row">
                <div class="list-img"><img src="https://1504726.blz.onl/wp-content/uploads/2022/03/check.png"></div>
                <div class="list-text">Improved fitness &amp; elevated energy levels</div>
            </div>
        </div>
        <div class="columns-row">
            <div class="list-row">
                <div class="list-img"><img src="https://1504726.blz.onl/wp-content/uploads/2022/03/check.png"></div>
                <div class="list-text">Smaller, less stinky poos (and less farting!)</div>
            </div>
            <div class="list-row">
                <div class="list-img"><img src="https://1504726.blz.onl/wp-content/uploads/2022/03/check.png"></div>
                <div class="list-text">Reduced anxiety and stress, by enabling more balanced hormones</div>
            </div>
            <div class="list-row">
                <div class="list-img"><img src="https://1504726.blz.onl/wp-content/uploads/2022/03/check.png"></div>
                <div class="list-text">Leaner, for less weight on their joints</div>
            </div>
        </div>
        <div class="columns-row">
            <div class="list-row">
                <div class="list-img"><img src="https://1504726.blz.onl/wp-content/uploads/2022/03/check.png"></div>
                <div class="list-text">A calmer dog, by eliminating synthetic nutrients and starchy carbs</div>
            </div>
            <div class="list-row">
                <div class="list-img"><img src="https://1504726.blz.onl/wp-content/uploads/2022/03/check.png"></div>
                <div class="list-text">Healthy heart &amp; brain function and improved trainabilty</div>
            </div>
            <div class="list-row">
                <div class="list-img"><img src="https://1504726.blz.onl/wp-content/uploads/2022/03/check.png"></div>
                <div class="list-text">Oral hygiene (and no more dog breath!)</div>
            </div>
        </div>
    </div>
</div>
<div class="delivery-section">
    <div class="delivery-title">DELIVERY</div>
    <div class="delivery-text">We deliver our meals frozen to your door! Because feeding raw should be just as easy as
        feeding kibble.
        Why frozen? To maximise nutrients and to ensure safety.
        PS: if you order on subscription you save on every meal! (Don't worry, there are no lock ins, just convenience!)
    </div>
    <button><a href="#sign-up">Sign Up Now</a></button>

    <div class="embed-container">
        <?php the_field('delivery_video_section'); ?>
    </div>
</div>

<div id="sign-up" class="signup-section">
    <div class="signup-title">Sign up to receive our launch offer</div>
    <div class="signup-promo"><strong>Exclusive launch offer:</strong> 15% discount + Free Bowl + A FREE BAG OF TREATS
    </div>
</div>
<div class="form-sign-up" id="sign-up">
    <?php  echo do_shortcode( '[gravityform id="1" title="false" description="false" ajax="false"]' ); ?>
</div>

<div class="client-say">
    <div class="client-title">WHAT OUR CUSTOMERS HAVE TO SAY</div>
    <div class="rating-section">
        <div class="list-rating">
            <div class="avatar-rating"><img src="https://1504726.blz.onl/wp-content/uploads/2022/03/rating-img.png" />
            </div>
            “Couldn’t recommend more highly!!!
            <p>Our 2 King Charles Cavaliers (3 years old &amp; 14 week old puppy) absolutely LOVE their new raw diet.
                They devour it and I feel great knowing I’m giving them the best of the best quality food. They also
                have the best range of bones that our dogs go nuts for!”</p>
            <h4>DAISY</h4>
            <div class="rating-star"><img src="https://1504726.blz.onl/wp-content/uploads/2022/03/start-rating.png" />
            </div>
        </div>
        <div class="list-rating">
            <div class="avatar-rating"><img src="https://1504726.blz.onl/wp-content/uploads/2022/03/Ellipse-11.png" />
            </div>
            “Best decision we have made!
            <p>Arthur has had stomach issues and we have been trying to find food that he can tolerate. We transferred
                to kangaroo then to include the Butchers Dog. He loves his new diet...! He’s healthier, leaner and can’t
                wait for dinner time”</p>
            <h4>DEBRA</h4>
            <div class="rating-star"><img src="https://1504726.blz.onl/wp-content/uploads/2022/03/start-rating.png" />
            </div>
        </div>
        <div class="list-rating">
            <div class="avatar-rating"><img src="https://1504726.blz.onl/wp-content/uploads/2022/03/Ellipse-12.png" />
            </div>
            “She licked the bowl clean!
            <p>Our pooch is the FUSSIEST dog when it comes to what she wants to eat so we decided to try The Butcher's
                Dog and she absolutely loved it. She licked the bowl clean. Will definitely be purchasing more in
                future!”</p>
            <h4>CHANNELLE</h4>
            <div class="rating-star"><img src="https://1504726.blz.onl/wp-content/uploads/2022/03/start-rating.png" />
            </div>
        </div>
    </div>
</div>

<div class="client-vid">
    <div class="client-vid-title">Healthier dogs, Happier owners</div>
    <iframe src="https://player.vimeo.com/video/680766157?h=da3d34b825" width="640" height="360" frameborder="0"
        allow="autoplay; fullscreen; picture-in-picture" allowfullscreen></iframe>
    <button><a href="#sign-up">Sign up now</a></button>
</div>
<style>
<?php include 'assets/css/landing-page.css';
?>
</style>
<?php
 get_footer();
 ?>