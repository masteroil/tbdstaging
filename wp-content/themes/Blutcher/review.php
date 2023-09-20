<?php 
/* template name: Review*/

get_header();
wp_head();
?>
<section class="new-stoctic-banner bacground-image-raw" id="review-page">
    <div class="review-container">
        <div class="review-row">
            <div class="review-text-left">
                <h2>Reviews</h2>
            </div>
            <div class="review-text-right">
                <h2>MY DOG LOVES IT!</h2>
                <img src="https://thebutchersdog.com.au/wp-content/uploads/2022/06/ratingreview.png" alt="review stars">
                <p class="review-p">My dog is so much happier and healthier since switching to a raw diet with The
                    Butcher's Dog. I won't
                    go back to feeding anything else.</p>
                <p class="review-label">Sam. L</p>
            </div>

        </div>
    </div>
</section>
<div class="after-review_section">
    <p>We make the best dog food in Australia, if not the world. Don’t just take our word for it, check out what our
        customers have to say.</p>
</div>
<script type="text/javascript">
(function e() {
    var e = document.createElement("script");
    e.type = "text/javascript", e.async = !0,
        e.src = "//staticw2.yotpo.com/1o3FVX1vaSAHGgf94awZWjYQtGl6pwbe8iYY6oc2/widget.js";
    var t = document.getElementsByTagName("script")[0];
    t.parentNode.insertBefore(e, t)
})();

$("#topbarcut").click(function() {
    $(".review-container").addClass("review_close");
});
</script>

<div id='yotpo-testimonials-custom-tab'></div>

<style>
.review_close {
    margin-top: 0px !important;
}

#review-page {
    background: url(https://thebutchersdog.com.au/wp-content/uploads/2022/06/desktopreviewbanner.jpeg);
    background-position-x: 0%;
    background-position-y: 0%;
    background-repeat: repeat;
    background-size: auto;
    background-position: center;
    background-size: cover;
    background-repeat: no-repeat;
    max-height: 720px;
    height: 100%;
    height: 720px;
    margin-top: 133px;
}

.review-container {
    max-width: 1240px;
    margin: auto;
    margin-top: auto;
    width: 100%;
    margin-top: 40px;
}

.review-row {
    display: flex;
    justify-content: space-between;
}

.review-text-left h2 {
    font-family: NorthwestTextured;
    font-size: 80px;
    line-height: 80px;
    color: #fff;
    padding: 30px 0 20px;
}


.review-text-right h2 {
    font-family: NorthwestTextured;
    font-size: 45px;
    color: #a4866c;
    width: 210px;
    margin: 0 auto;
}

.review-p {
    width: 290px;
    text-align: center;
    font-family: 'Special Elite', cursive;
    color: #fff;
    font-size: 20px;
    margin: 25px auto;
}

.review-text-right img {
    margin: 15px auto;
    height: 25px;
}

.review-label {
    font-family: 'Special Elite', cursive;
    text-align: center;
    color: #a4866c;
    margin: 0 auto;
}

.review-text-right {
    text-align: center;
}

.review-text-left {
    text-align: center;
    margin: auto 0;
}

#review-page {
    bottom: 80px;
}

.after-review_section p {
    text-align: center;
    font-family: 'Special Elite', cursive;
    color: #fff;
    font-size: 25px;
    margin: 0 auto;
    width: 1200px;
}

.after-review_section {
    margin: 0px auto;
}

@media only screen and (max-width: 1280px) {
    .review-row {
        padding: 0 25px;
    }
}

@media only screen and (max-width: 1024px) {

    .review-container {
        max-width: 920px;
    }
}

@media only screen and (max-width: 780px) {

    #review-page {
        background: url(https://thebutchersdog.com.au/wp-content/uploads/2022/06/mobilereviewbanner.jpeg);
        height: 680px;
        background-position-x: 0%;
        background-position-y: 0%;
        background-repeat: repeat;
        background-size: auto;
        background-position: center;
        background-size: cover;
        background-repeat: no-repeat;
        object-fit: cover;
    }

    .review-row {
        display: inline;
    }

    .review-container {
        margin-top: 0px;
    }

    .review-text-left h2 {
        font-size: 50px;
        padding: 0;
    }

    .review-text-right h2 {
        font-size: 30px;
        width: 100%;
    }

    .review-text-right img {
        height: 18px;
    }

    .review-p {
        font-size: 16px;
        width: auto;
        margin: 20px auto;
        padding: 0 20px;
    }

    #review-page {
        bottom: 40px;
        margin-top: 110px;
    }

    .after-review_section p {
        font-size: 20px'

    }

}

@media only screen and (max-width: 767px) {
    .review-container {
        margin-top: 60px;
    }
}

@media only screen and (max-width: 1180px) {
    .after-review_section p {
        width: 100%;
        padding: 0 25px;
    }
}

@media only screen and (max-width: 520px) {
    .review-text-right img {
        margin: 10px auto;
    }

    #review-page {
        margin-top: 90px;
    }

    .review-p {
        margin-bottom: 0px;
    }
}

.yotpo-popup-box-small.yotpo-nav.yotpo-nav-primary .yotpo-nav-wrapper {
    border-color: #a4866c !important;
}

.yotpo-modal-body-wrapper .yotpo-icon-profile.yotpo-header-element.pull-left {
    background-color: #a4866c !important;
}
</style>
<?php
wp_footer();
get_footer();
?>