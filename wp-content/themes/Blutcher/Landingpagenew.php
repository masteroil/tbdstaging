<?php
/* template name: Landing page New*/

include 'Landingpageheader.php';

?>
<div class="landing-page">
    <div class="banner">
        <div class="desktop-banner">
            <?php 
        $image = get_field('desktop-image');
        if( !empty( $image ) ): ?>
            <img src="<?php echo esc_url($image['url']); ?>" alt="<?php echo esc_attr($image['alt']); ?>" />
            <?php endif; ?>
        </div>
        <div class="mobile-banner">
            <?php 
        $image = get_field('mobile-image');
        if( !empty( $image ) ): ?>
            <img src="<?php echo esc_url($image['url']); ?>" alt="<?php echo esc_attr($image['alt']); ?>" />
            <?php endif; ?>
        </div>
        <div class="centered">
            <h1><?php the_field('page-heading'); ?></h1>
        </div>
        <div class="centered">
            <h3><?php the_field('page-subheading'); ?></h3>
        </div>
    </div>
    <div class="section-sign-up">
        <h2><?php the_field('section-heading'); ?></h2>
        <p><?php the_field('section-subheading'); ?></p>
        <button><?php the_field('signup_text'); ?><a href="#sign-up"></a></button>
    </div>
    <div class="why-raw">
        <div class="raw-img-desktop">
            <?php 
        $image = get_field('raw_desktop');
        if( !empty( $image ) ): ?>
            <img src="<?php echo esc_url($image['url']); ?>" alt="<?php echo esc_attr($image['alt']); ?>" />
            <?php endif; ?>
        </div>
        <div class="raw-text">
            <span><?php the_field('raw_heading'); ?></span>
            <p><?php the_field('raw_text'); ?></p>
            <p><?php the_field('raw_text_p'); ?></p>
            <button><a href="#sign-up"><?php the_field('signup_text'); ?></a></button>
        </div>
        <div class="raw-img-mobile">
            <?php 
        $image = get_field('raw_mobile_image');
        if( !empty( $image ) ): ?>
            <img src="<?php echo esc_url($image['url']); ?>" alt="<?php echo esc_attr($image['alt']); ?>" />
            <?php endif; ?>
        </div>
    </div>
    <div class="benefits">
        <div class="benefits-title"><?php the_field('benefits_of_feeding_raw_heading'); ?></div>
        <div class="benefits-section">

            <div class="columns-row">
                <div class="list-row">
                    <div class="list-img"><?php 
                        $image = get_field('benefits_of_feeding_raw_image');
                        if( !empty( $image ) ): ?>
                        <img src="<?php echo esc_url($image['url']); ?>" alt="<?php echo esc_attr($image['alt']); ?>" />
                        <?php endif; ?>
                    </div>
                    <div class="list-text"><?php the_field('list_item_of_text_1'); ?></div>
                </div>
                <div class="list-row">
                    <div class="list-img"><?php 
                        $image = get_field('benefits_of_feeding_raw_image');
                        if( !empty( $image ) ): ?>
                        <img src="<?php echo esc_url($image['url']); ?>" alt="<?php echo esc_attr($image['alt']); ?>" />
                        <?php endif; ?>
                    </div>
                    <div class="list-text"><?php the_field('list_item_of_text_2'); ?></div>
                </div>
                <div class="list-row">
                    <div class="list-img"><?php 
                        $image = get_field('benefits_of_feeding_raw_image');
                        if( !empty( $image ) ): ?>
                        <img src="<?php echo esc_url($image['url']); ?>" alt="<?php echo esc_attr($image['alt']); ?>" />
                        <?php endif; ?>
                    </div>
                    <div class="list-text"><?php the_field('list_item_of_text_3'); ?></div>
                </div>
            </div>

            <div class="columns-row">
                <div class="list-row">
                    <div class="list-img"><?php 
                        $image = get_field('benefits_of_feeding_raw_image');
                        if( !empty( $image ) ): ?>
                        <img src="<?php echo esc_url($image['url']); ?>" alt="<?php echo esc_attr($image['alt']); ?>" />
                        <?php endif; ?>
                    </div>
                    <div class="list-text"><?php the_field('list_item_of_text_4'); ?></div>
                </div>
                <div class="list-row">
                    <div class="list-img"><?php 
                        $image = get_field('benefits_of_feeding_raw_image');
                        if( !empty( $image ) ): ?>
                        <img src="<?php echo esc_url($image['url']); ?>" alt="<?php echo esc_attr($image['alt']); ?>" />
                        <?php endif; ?>
                    </div>
                    <div class="list-text"><?php the_field('list_item_of_text_5'); ?></div>
                </div>
                <div class="list-row">
                    <div class="list-img"><?php 
                        $image = get_field('benefits_of_feeding_raw_image');
                        if( !empty( $image ) ): ?>
                        <img src="<?php echo esc_url($image['url']); ?>" alt="<?php echo esc_attr($image['alt']); ?>" />
                        <?php endif; ?>
                    </div>
                    <div class="list-text"><?php the_field('list_item_of_text_6'); ?></div>
                </div>
            </div>

            <div class="columns-row">
                <div class="list-row">
                    <div class="list-img"><?php 
                        $image = get_field('benefits_of_feeding_raw_image');
                        if( !empty( $image ) ): ?>
                        <img src="<?php echo esc_url($image['url']); ?>" alt="<?php echo esc_attr($image['alt']); ?>" />
                        <?php endif; ?>
                    </div>
                    <div class="list-text"><?php the_field('list_item_of_text_7'); ?></div>
                </div>
                <div class="list-row">
                    <div class="list-img"><?php 
                        $image = get_field('benefits_of_feeding_raw_image');
                        if( !empty( $image ) ): ?>
                        <img src="<?php echo esc_url($image['url']); ?>" alt="<?php echo esc_attr($image['alt']); ?>" />
                        <?php endif; ?>
                    </div>
                    <div class="list-text"><?php the_field('list_item_of_text_8'); ?></div>
                </div>
                <div class="list-row">
                    <div class="list-img">
                        <?php 
                        $image = get_field('benefits_of_feeding_raw_image');
                        if( !empty( $image ) ): ?>
                        <img src="<?php echo esc_url($image['url']); ?>" alt="<?php echo esc_attr($image['alt']); ?>" />
                        <?php endif; ?>
                    </div>
                    <div class="list-text"><?php the_field('list_item_of_text_9'); ?></div>
                </div>
            </div>
        </div>
    </div>
    <div class="delivery-section">
        <div class="delivery-title"><?php the_field('delivery_heading'); ?></div>
        <div class="delivery-text"><?php the_field('delivery_text'); ?></div>
        <button><a href="#sign-up"><?php the_field('signup_text'); ?></a></button>
        <figure
            class="wp-block-embed-vimeo wp-block-embed is-type-video is-provider-vimeo wp-embed-aspect-16-9 wp-has-aspect-ratio">
            <div class="wp-block-embed__wrapper"><?php the_field('delivery_iframe'); ?></div>
        </figure>
    </div>
    <div id="sign-up" class="signup-section">
        <div class="signup-title"><?php the_field('signup_section_heading'); ?></div>
        <div class="signup-promo"><?php the_field('signup_section_text'); ?></div>
    </div>
    <?php gravity_form( 1 );
                ?>
    <div class="client-say">
        <div class="client-title"><?php the_field('what_our_customers_have_to_say_heading'); ?></div>
        <div class="rating-section">
            <div class="list-rating">
                <div class="avatar-rating">
                    <?php 
                        $image = get_field('customer_image_1');
                        if( !empty( $image ) ): ?>
                    <img src="<?php echo esc_url($image['url']); ?>" alt="<?php echo esc_attr($image['alt']); ?>" />
                    <?php endif; ?>
                </div><span><?php the_field('customer_heading_1'); ?></span>
                <p><?php the_field('customer_text_1'); ?></p>
                <h4><?php the_field('customer_name_1'); ?></h4>
                <div class="rating-star">
                    <?php 
                        $image = get_field('customer_rating');
                        if( !empty( $image ) ): ?>
                    <img src="<?php echo esc_url($image['url']); ?>" alt="<?php echo esc_attr($image['alt']); ?>" />
                    <?php endif; ?>
                </div>
            </div>
            <div class="list-rating">
                <div class="avatar-rating">
                    <?php 
                        $image = get_field('customer_image_2');
                        if( !empty( $image ) ): ?>
                    <img src="<?php echo esc_url($image['url']); ?>" alt="<?php echo esc_attr($image['alt']); ?>" />
                    <?php endif; ?>
                </div><span><?php the_field('customer_heading_2'); ?></span>
                <p><?php the_field('customer_text_2'); ?></p>
                <h4><?php the_field('customer_name_2'); ?></h4>
                <div class="rating-star">
                    <?php 
                        $image = get_field('customer_rating');
                        if( !empty( $image ) ): ?>
                    <img src="<?php echo esc_url($image['url']); ?>" alt="<?php echo esc_attr($image['alt']); ?>" />
                    <?php endif; ?>
                </div>
            </div>
            <div class="list-rating">
                <div class="avatar-rating">
                    <?php 
                        $image = get_field('customer_image_3');
                        if( !empty( $image ) ): ?>
                    <img src="<?php echo esc_url($image['url']); ?>" alt="<?php echo esc_attr($image['alt']); ?>" />
                    <?php endif; ?>
                </div><span><?php the_field('customer_heading_3'); ?></span>
                <p><?php the_field('customer_text_3'); ?></p>
                <h4><?php the_field('customer_name_3'); ?></h4>
                <div class="rating-star">
                    <?php 
                        $image = get_field('customer_rating');
                        if( !empty( $image ) ): ?>
                    <img src="<?php echo esc_url($image['url']); ?>" alt="<?php echo esc_attr($image['alt']); ?>" />
                    <?php endif; ?>
                </div>
            </div>

        </div>
    </div>
    <div class="client-vid">
        <div class="client-vid-title"><?php the_field('healthier_dog_heading'); ?></div>
        <figure
            class="wp-block-embed-vimeo wp-block-embed is-type-video is-provider-vimeo wp-embed-aspect-16-9 wp-has-aspect-ratio">
            <div class="wp-block-embed__wrapper"><?php the_field('healthier_dog_video'); ?></div>
        </figure>
        <button><a href="#sign-up"><?php the_field('signup_text'); ?></a></button>
    </div>
    <div class="delivery-section new-section">
        <?php 
                                $image = get_field('new_section_image');
                                if( !empty( $image ) ): ?>
        <img src="<?php echo esc_url($image['url']); ?>" alt="<?php echo esc_attr($image['alt']); ?>" />
        <?php endif; ?>

        <div class="new-section-t1"><?php the_field('new_section'); ?></div>
        <div class="new-section-p1"><?php the_field('new_section_text'); ?></div>
        <a class="new-section" href="https://thebutchersdog.com.au/delivery-shipping/">*Delivery &
            Shipping
            Conditions apply</a>
    </div>

</div>
<style>
@media only screen and (max-width: 375px) {
    .new-section-p1 {
        margin: 10px 20px;
    }
}

a.new-section {
    font-size: 12px;
    color: #fff;
    padding: 5px 0 0;
    margin-top: 19px;
    bottom: 36px;
    width: 100%;
    text-align: center;
    left: 0;
    text-decoration: underline;
}

a.new-section:hover {
    color: #a4866c;
}


.delivery-section.new-section {
    margin-bottom: 150px;
}

.new-section-t1 {
    color: #9f866f;
    font-style: normal;
    font-size: 12px;
    line-height: 16px;
    margin-top: 15px;
    font-family: 'acumin-pro';
    font-weight: bolder;
    margin-top: 15px;
}

.new-section-p1 {
    color: #fff;
    font-size: 16px;
    line-height: 30px;
    transition: 0.2s;
    margin-top: 16px;
}

.landing-page {
    margin-top: 130px;
}

.banner {
    position: relative;
    text-align: center;
}

.banner .desktop-banner img {
    width: 100%;
    height: 687px;
    object-fit: cover;
    transition: 0.5s ease-out;
}

.banner .mobile-banner img {
    display: none;
}

.landing-page .centered h1 {
    position: absolute;
    top: 170px;
    left: 106px;
    font-family: "NorthwestTextured";
    font-style: normal;
    font-weight: normal;
    font-size: 98px;
    line-height: 86px;
    width: 633px;
    text-transform: uppercase;
    transition: 0.5s ease-out;
    color: #fff;
}

.landing-page .centered h3 {
    position: absolute;
    top: 450px;
    left: 106px;
    font-family: "NorthwestTextured";
    font-style: normal;
    font-weight: normal;
    font-size: 47px;
    line-height: 45px;
    width: 667px;
    text-transform: uppercase;
    transition: 0.5s ease;
    color: #fff;
}

@media only screen and (max-width: 720px) {
    .banner .mobile-banner img {
        display: block;
    }

    .banner .desktop-banner img {
        display: none;
    }

    .banner .mobile-banner img {
        transition: 0.5s ease;
        width: 720px;
        height: 687px;
        object-fit: cover;
    }

    .landing-page .centered h1 {
        position: absolute;
        font-family: "NorthwestTextured";
        font-style: normal;
        font-weight: normal;
        font-size: 54.069px;
        line-height: 47px;
        text-align: center;
        width: 400px;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        transition: 0.5s ease-in-out;
    }

    .landing-page .centered h3 {
        position: absolute;
        font-family: "NorthwestTextured";
        font-style: normal;
        font-weight: normal;
        font-size: 25.931px;
        line-height: 25px;
        text-align: center;
        width: 400px;
        top: 70%;
        left: 50%;
        transform: translate(-50%, -50%);
        transition: 0.5s ease-in-out;
    }
}

@media only screen and (max-width: 533px) {
    .banner .mobile-banner img {
        height: 484px;
        object-fit: cover;
    }
}

@media only screen and (max-width: 375px) {
    .banner .mobile-banner {
        display: flex;
        /*! height: 484px; */
        width: 100%;
        object-fit: fill;
    }

    .landing-page .centered h1 {
        position: absolute;
        font-family: "NorthwestTextured";
        font-style: normal;
        font-weight: normal;
        font-size: 54.069px;
        line-height: 47px;
        text-align: center;
        width: 345px;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        transition: 0.5s ease-in-out;
    }

    .landing-page .centered h3 {
        position: absolute;
        font-family: "NorthwestTextured";
        font-style: normal;
        font-weight: normal;
        font-size: 25.931px;
        line-height: 25px;
        text-align: center;
        width: 368px;
        top: 75%;
        left: 50%;
        transform: translate(-50%, -50%);
        transition: 0.5s ease-in-out;
    }
}

.landing-page .section-sign-up {
    text-align: center;
    color: #fff;
    display: block;
    justify-content: center;
    margin-bottom: 112px;
}

.landing-page .section-sign-up h2 {
    width: 809px;
    padding-top: 110px;
    padding-bottom: 30px;
    margin-left: auto;
    margin-right: auto;
    font-family: Special Elite;
    font-style: normal;
    font-weight: normal;
    font-size: 35px;
    line-height: 44px;
    transition: 0.5s ease-in-out;
}

.landing-page .section-sign-up p {
    width: 722px;
    text-align: center;
    margin-left: auto;
    margin-right: auto;
    font-family: "Helvetica";
    font-style: normal;
    font-weight: normal;
    font-size: 16px;
    line-height: 30px;
    padding-bottom: 23px;
    transition: 0.5s ease-in-out;
}

.landing-page .section-sign-up button {
    width: 176px;
    height: 46px;
    background-color: #9f866f;
    color: #1f1f1f;
    padding: 11px 15px 10px 14px;
    text-decoration: none;
    font-family: "Helvetica";
    font-style: normal;
    font-weight: normal;
    font-size: 21px;
    line-height: 20px;
    margin-top: 27px;
}

.landing-page .section-sign-up button a:hover {
    text-decoration: none;
    color: #1f1f1f;
}

@media only screen and (max-width: 1120px) {
    .landing-page .section-sign-up h2 {
        width: 700px;
        font-family: Special Elite;
        font-style: normal;
        font-weight: normal;
        transition: 0.5s ease-in-out;
    }

    .landing-page .section-sign-up p {
        font-family: "Helvetica";
        font-style: normal;
        font-weight: normal;
        transition: 0.5s ease-in-out;
        width: 800px;
    }
}

@media only screen and (max-width: 920px) {
    .landing-page .section-sign-up h2 {
        width: 700px;
        font-family: Special Elite;
        font-style: normal;
        font-weight: normal;
        transition: 0.5s ease-in-out;
    }

    .landing-page .section-sign-up p {
        font-family: "Helvetica";
        font-style: normal;
        font-weight: normal;
        transition: 0.5s ease-in-out;
        width: 700px;
    }
}

@media only screen and (max-width: 720px) {
    .landing-page .section-sign-up h2 {
        padding-top: 80px;
        width: 500px;
        font-family: Special Elite;
        font-style: normal;
        font-weight: normal;
        transition: 0.5s ease-in-out;
    }

    .landing-page .section-sign-up p {
        font-family: "Helvetica";
        font-style: normal;
        font-weight: normal;
        transition: 0.5s ease-in-out;
        width: 500px;
    }

    .section-sign-up button {
        padding-top: 8px !important;
    }
}

@media only screen and (max-width: 500px) {
    .landing-page .section-sign-up h2 {
        padding-top: 50px;
        width: 360px;
        font-family: Special Elite;
        font-style: normal;
        font-weight: normal;
        transition: 0.5s ease-in-out;
    }

    .landing-page .section-sign-up p {
        font-family: "Helvetica";
        font-style: normal;
        font-weight: normal;
        transition: 0.5s ease-in-out;
        width: 360px;
    }
}

@media only screen and (max-width: 375px) {
    .landing-page .section-sign-up h2 {
        padding-top: 48px;
        width: 325px;
        font-family: Special Elite;
        font-style: normal;
        font-weight: normal;
        font-size: 29px;
        line-height: 37px;
        transition: 0.5s ease-in-out;
    }

    .landing-page .section-sign-up p {
        font-family: "Helvetica";
        font-style: normal;
        font-weight: normal;
        font-size: 16px;
        line-height: 20px;
        text-align: center;
        width: 275px;
        transition: 0.5s ease-in-out;
    }
}

.why-raw {
    display: flex;
}

.raw-img {
    width: 50%;
}

.raw-text {
    width: 50%;
    text-align: center;
    display: grid;
    justify-content: center;
    align-content: center;
    justify-items: center;
}

.raw-text span {
    font-family: "NorthwestTextured";
    font-style: normal;
    font-weight: normal;
    font-size: 78.17px;
    line-height: 93px;
    color: #ffffff;
    width: 640px;
    margin-bottom: 35px;
    transition: 0.5s ease-in-out;
}

.raw-text p {
    font-family: Helvetica;
    font-style: normal;
    font-weight: normal;
    font-size: 16px;
    line-height: 30px;
    text-align: center;
    width: 475px;
    color: #fff;
    transition: 0.5s ease-in-out;
}

.raw-text button {
    border: 2px solid #9f866f;
    box-sizing: border-box;
    width: 176px;
    height: 46px;
    color: #9f866f;
    font-family: Helvetica;
    font-weight: normal;
    font-size: 21px;
    line-height: 20px;
    text-align: center;
    margin-top: 50px;
}

.raw-text button:hover a {
    text-decoration: none;
    color: #9f866f;
}

.raw-text button:hover {
    background-color: transparent;
}

.raw-img-mobile {
    display: none;
}

@media only screen and (max-width: 1020px) {
    .why-raw {
        display: grid;
        text-align: center;

        align-content: center;
        justify-items: center;
    }

    .raw-img-mobile {
        display: block;
        transition: 0.5s ease-in-out;
    }

    .raw-img-desktop {
        display: none;
    }

    .raw-text {
        display: grid;
        justify-items: center;
        align-content: center;
        justify-content: center;
    }
}

@media only screen and (max-width: 620px) {
    .why-raw {
        display: grid;
        text-align: center;
        justify-content: center;
        justify-items: center;
        align-content: center;
        align-items: center;
    }

    .raw-text span {
        font-size: 60px;
        transition: 0.5s ease-in-out;
    }

    .raw-text p {
        font-size: 20px;
        width: 450px;
        transition: 0.5s ease-in-out;
    }

    .raw-img-mobile img {
        width: 450px !important;
        height: 450px !important;
        transition: 0.5s ease-in-out;
    }
}

@media only screen and (max-width: 460px) {
    .why-raw {
        display: grid;
        text-align: center;
        justify-content: center;
        justify-items: center;
        align-content: center;
        align-items: center;
    }

    .raw-text span {
        font-size: 45px;
        margin-bottom: 15px;
        transition: 0.5s ease-in-out;
    }

    .raw-text p {
        font-size: 16px;
        width: 229px;
        transition: 0.5s ease-in-out;
    }

    .raw-img-mobile img {
        width: 336px !important;
        height: 336px !important;
        transition: 0.5s ease-in-out;
    }
}

.raw-text:before {
    width: 16px;
    content: " ";
    background-image: url("https://thebutchersdog.com.au/wp-content/uploads/2022/03/Line-1.png");
    position: relative;
    height: 2px;
    width: 221px;
    bottom: 120px;
}

.raw-text:after {
    content: " ";
    background-image: url("https://thebutchersdog.com.au/wp-content/uploads/2022/03/Line-1.png");
    position: relative;
    height: 2px;
    width: 221px;
    top: 120px;
}

.raw-img-desktop img {
    width: 629px;
    height: 629px;
}

.raw-img-desktop {
    width: 50%;
    align-content: center;
    display: flex;
    justify-content: center;
}

@media only screen and (max-width: 1020px) {
    .why-raw {
        display: grid;
        text-align: center;

        align-content: center;
        justify-items: center;
    }

    .raw-img-mobile {
        display: block;
        transition: 0.5s ease-in-out;
    }

    .raw-img-desktop {
        display: none;
    }

    .raw-text {
        display: grid;
        justify-items: center;
        align-content: center;
        justify-content: center;
    }

    .raw-text:before {
        width: 16px;
        content: " ";
        background-image: url("https://thebutchersdog.com.au/wp-content/uploads/2022/03/Line-1.png");
        position: relative;
        height: 2px;
        width: 221px;
        bottom: 50px;
    }

    .raw-text:after {
        content: " ";
        background-image: url("https://thebutchersdog.com.au/wp-content/uploads/2022/03/Line-1.png");
        position: relative;
        height: 2px;
        width: 221px;
        top: 670px;
    }

    .why-raw {
        margin-top: 100px;
    }
}

@media only screen and (max-width: 620px) {
    .raw-text:after {
        content: " ";
        background-image: url("https://thebutchersdog.com.au/wp-content/uploads/2022/03/Line-1.png");
        position: relative;
        height: 2px;
        width: 221px;
        top: 450px;
    }
}

@media only screen and (max-width: 460px) {
    .raw-text:after {
        content: " ";
        background-image: url("https://thebutchersdog.com.au/wp-content/uploads/2022/03/Line-1.png");
        position: relative;
        height: 2px;
        width: 221px;
        top: 350px;
    }
}


.benefits-section {
    display: flex;
    justify-content: space-evenly;
    transition: 0.5s ease-in-out;
}

.benefits-title {
    text-align: center;
}

.benefits-section .columns-row .list-row {
    display: flex;
    align-items: center;
}

.benefits-section .columns-row .list-row .list-text {
    width: 267px;
}

@media only screen and (max-width: 1120px) {
    .benefits-section {
        display: flex;
        justify-content: center;
    }
}

@media only screen and (max-width: 990px) {
    .benefits-section {
        display: block;
        margin-left: 50px;
    }
}

@media only screen and (max-width: 380px) {
    .benefits-section {
        margin-left: 0px;
    }
}

.list-img {
    margin-right: 15px;
}

.benefits-title {
    color: #9f866f;
    font-family: NorthwestRegular;
    font-style: normal;
    font-weight: normal;
    font-size: 78.1667px;
    line-height: 74px;
    text-align: center;
    margin-top: 90px;
    margin-bottom: 100px;
}

.list-text {
    font-family: Helvetica;
    font-style: normal;
    font-weight: normal;
    font-size: 16px;
    line-height: 22px;
    color: #fff;
}

.list-row {
    margin-bottom: 35px;
}

@media only screen and (max-width: 1120px) {
    .list-img img {
        height: 100% !important;
    }
}

@media only screen and (max-width: 990px) {
    .benefits-title:after {
        content: "";
        background-image: url("https://04272022.blz.onl/wp-content/uploads/2022/03/Line-1.png");
        position: relative;
        height: 2px;
        width: 221px;
        top: 880px !important;
        left: 40% !important;
    }
}

@media only screen and (max-width: 660px) {
    .benefits-title {
        font-size: 50px;
    }
}

@media only screen and (max-width: 380px) {
    .benefits-title {
        font-size: 45px;
        line-height: 50px;
    }

    .benefits-section {
        margin-left: 10px;
    }

    .list-text {
        font-size: 16px;
        line-height: 22px;
    }

    .benefits-title:after {
        left: 20% !important;
    }
}

.benefits-title:after {
    content: "";
    background-image: url("https://04272022.blz.onl/wp-content/uploads/2022/03/Line-1.png");
    position: relative;
    height: 2px;
    width: 221px;
    top: 390px;
    left: 45%;
}

benefits-title {
    display: grid;
}


<?php include 'assets/css/landing-page.css';
?>
</style>
<?php
 get_footer();
 ?>