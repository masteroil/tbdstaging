<?php include('calculator.php'); ?>
<div class="footer-container">
    <footer>

        <div class="dual-sec">
            <div class="foot-logo"><img
                    src="<?php echo get_site_url(); ?>/wp-content/uploads/2020/09/TBD_Portrait_Logo_White.png" alt="">
            </div>
            <div class="logo-title">real food</br>for dogs</div>
        </div>
        <div class="dual-sec foot-links">
            <ul>
                <span>PRODUCTS</span>
                <li><a href="<?php echo get_site_url(); ?>/combo-boxes">Combo Boxes</a></li>
                <li><a href="<?php echo get_site_url(); ?>/raw-meals">Raw Meals</a></li>
                <li><a href="<?php echo get_site_url(); ?>/treats">Treats</a></li>
                <li><a href="<?php echo get_site_url(); ?>/apothecary">Apothecary</a></li>
                <li><a href="<?php echo get_site_url(); ?>/gifts">Gifts</a></li>
            </ul>
            <ul>
                <span>MORE</span>
                <li><a href="<?php echo get_site_url(); ?>/our-story/">Our Story</a></li>
                <li><a href="<?php echo get_site_url(); ?>/raw/">Why Raw</a></li>
                <li><a href="<?php echo get_site_url(); ?>/stockists/">Stockists</a></li>
                <li><a href="<?php echo get_site_url(); ?>/contact/">Contact Us</a></li>
            </ul>
            <ul>
                <span>LEARN</span>
                <li><a href="<?php echo get_site_url(); ?>/the-butchers-dog-frequently-asked-questions/">FAQs</a></li>
                <!-- <li><a  onClick= "modelCalOpen();" href="#">Food Calculator</a></li> -->
                <li><a href="<?php echo get_site_url(); ?>/terms/">Terms & Conditions</a></li>
                <li><a href="<?php echo get_site_url(); ?>/privacy-policy/">Privacy Policy</a></li>
                <li><a href="<?php echo get_site_url(); ?>/delivery-shipping/">Delivery & Shipping</a></li>
            </ul>
            <ul>
                <span>MY ACCOUNT</span>
                <li><a href="<?php echo get_site_url(); ?>/my-account/">Login</a></li>
                <li><a href="<?php echo get_site_url(); ?>/my-account/">Register</a></li>
                <li class="last-li-social">
                    <div class="foot-social">
                        <div class="foot-social-inner"><strong>Follow us</strong>
                            <a href="https://www.facebook.com/thebutchersdogau" target="_blank"><i
                                    class="fab fa-facebook-square    "></i></a>
                            <a href="https://www.instagram.com/thebutchersdogau/" target="_blank"><i
                                    class="fab fa-instagram    "></i></a>
                        </div>
                    </div>
                </li>
            </ul>
        </div>
    </footer>
</div>

<div class="foot-social desktop-social-l">
    <div class="foot-social-inner">Follow us <a href="https://www.facebook.com/thebutchersdogau" target="_blank"><i
                class="fab fa-facebook-square    "></i></a><a href="https://www.instagram.com/thebutchersdogau/"
            target="_blank"><i class="fab fa-instagram    "></i></a></div>
</div>
<div class="foot-bot-container">
    <div class="foot-bot">
        <div class="dual-sec">
            <img src="<?php echo get_site_url(); ?>/wp-content/uploads/2020/09/TBD_Visa.png" alt="">
            <img src="<?php echo get_site_url(); ?>/wp-content/uploads/2020/09/TBD_Mastercard.png" alt="">
            <img src="<?php echo get_site_url(); ?>/wp-content/uploads/2020/09/TBD_American-Express.png" alt="">
            <img src="<?php echo get_site_url(); ?>/wp-content/uploads/2020/09/TBD_PayPal.png" alt="">
            <img src="<?php echo get_site_url(); ?>/wp-content/uploads/2021/02/TBD_Apple-Pay_100px-1.png" alt="">
            <img src="<?php echo get_site_url(); ?>/wp-content/uploads/2020/09/TBD_Stripe.png" alt="">
        </div>
        <div class="dual-sec">
            <span>© The Butcher's Dog</span><span class="siteby">SITE BY <a href="https://oxdigital.com.au/"
                    target="_blank">OX DIGITAL</a></span>
        </div>
    </div>
</div>
<!-- Optional JavaScript -->
<!-- jQuery first, then Popper.js, then Bootstrap JS -->

<?php
if (is_page_template('stockists.php')) { ?>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/slim.js/4.0.3/Slim.min.js" crossorigin="anonymous"></script>
<?php } else { ?>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
        integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous">
        </script>

<?php }
?>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"
    integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous">
    </script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"
    integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous">
    </script>

<?php if (!is_page_template('stockists.php')) { ?>
    <script src="<?php echo get_site_url(); ?>/wp-content/themes/Blutcher/assets/js/jquery.min.js"></script>
<?php } ?>
<?php if (!is_page_template('raw.php')) { ?>
    <script src="<?php echo get_site_url(); ?>/wp-content/themes/Blutcher/assets/js/owl.carousel.min.js"></script>
<?php } ?>
<link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>



<script>
    $(".navbar-toggler-icon").click(function () {
        $("body").addClass("mobile-open");
    });

    $(".plus-bar-mob").click(function () {
        $("body").removeClass("mobile-open");
    });
</script>
<script>
    jQuery("select[name='subscription-options']").on('change', function () {
        var cooksel = jQuery(this).val();

        Cookies.set('name', cooksel);

        Cookies.get('name');

    });
</script>
<script>
    $(document).ready(function () {
        jQuery('.wc-product-table-select-filters').hide();
        var scrolled_height = jQuery('.login-header').height();

        $(".down-arrow").click(function (e) {
            e.preventDefault();
            $('html,body').animate({
                scrollTop: jQuery(".fitbutcherdog").offset().top - scrolled_height
            },
                'slow');
        });
        $('html,body').scroll(function () {

            if ($(this).scrollTop() > 5) {
                //
                //alert("scroll down");
                $('.header-alert').fadeOut();
            } else {

                $('.header-alert').fadeIn();
            }
        });

    });


    $(window).scroll(function () {
        if ($(window).scrollTop() >= 2) {
            $('#myHeader').addClass('sticky');
            $('.woo_amc_open.right-top-fixed ').addClass('drag-stick');
        } else {
            $('#myHeader').removeClass('sticky');
            $('.woo_amc_open.right-top-fixed').removeClass('drag-stick');
        }
    });




    $(window).scroll(function () {
        if ($(window).scrollTop() >= 1) {
            $('#leftsheadernav').addClass('sliddeing');
        } else {
            $('#leftsheadernav').removeClass('sliddeing');
        }
    });



    $(window).scroll(function () {
        if ($(window).scrollTop() >= 1) {
            $('.woocommerce-MyAccount-navigation').addClass('sliddeing');
        } else {
            $('.woocommerce-MyAccount-navigation').removeClass('sliddeing');
        }
    });


    $('.slider').on('initialized.owl.carousel changed.owl.carousel', function (e) {
        if (!e.namespace) {
            return;
        }
        var carousel = e.relatedTarget;
        $('.count-slide').text(carousel.relative(carousel.current()) + 1 + ' OF ' + carousel.items().length);
    }).owlCarousel({
        items: 3,
        loop: true,
        margin: 10,
        rewindNav: false,
        pagination: false,
        responsive: {
            0: {
                items: 1
            },
            600: {
                items: 1
            },
            1000: {
                items: 3
            }
        }

    });

    $('#SlideCarousel').owlCarousel({
        loop: true,
        margin: 10,
        responsiveClass: true,
        responsive: {
            0: {
                items: 2,
                nav: true
            },
            600: {
                items: 2,
                nav: false
            },
            1000: {
                items: 6,
                nav: true,
                loop: false
            }
        }
    })




    $(document).ready(function () {
        $("#owl-prod").owlCarousel();
    });
    $('#owl-prod').owlCarousel({
        loop: true,
        margin: 10,
        responsiveClass: true,
        responsive: {
            0: {
                items: 2,
                nav: true
            },
            600: {
                items: 3,
                nav: true
            },
            1000: {
                items: 4,
                nav: true,
                loop: false
            }
        }
    })



    $(document).ready(function () {


        $('.owl-carousel').owlCarousel({
            loop: true,
            margin: 10,
            responsiveClass: true,
            responsive: {
                0: {
                    items: 1,
                    nav: true
                },
                600: {
                    items: 1,
                    nav: false
                },
                1000: {
                    items: 1,
                    nav: true,
                    loop: false
                }
            }
        });


        $(".next").click(function () {
            $("#owlCarousel .owl-prev").trigger('click');
            $("#next").hide();
            $("#prev").show();

        });
        $(".prev").click(function () {
            $("#owlCarousel .owl-next").trigger('click');
            $("#prev").hide();
            $("#next").show();
        });

        $("#owlCarousel .owl-next").click(function () {
            $("#test1").prop('checked', false);
            $("#test2").prop('checked', true);
            $("#prev").hide();
            $("#next").show();

        });
        $("#owlCarousel .owl-prev").click(function () {
            //console.log("prev--ccc------");
            $("#test1").prop('checked', true);
            $("#test2").prop('checked', false);
            $("#next").hide();
            $("#prev").show();
        });


        $(".nextTwo").click(function () {
            $("#owlCarouselTwo .owl-prev").trigger('click');
            $(".nextTwoId").hide();
            $(".prevTwoId").show();
        });
        $(".prevTwo").click(function () {
            $("#owlCarouselTwo .owl-next").trigger('click');
            $(".prevTwoId").hide();
            $(".nextTwoId").show();
        });


        $("#owlCarouselTwo .owl-next").click(function () {
            $("#test3").prop('checked', false);
            $("#test4").prop('checked', true);
            $(".prevTwoId").hide();
            $(".nextTwoId").show();

        });
        $("#owlCarouselTwo .owl-prev").click(function () {
            $("#test3").prop('checked', true);
            $("#test4").prop('checked', false);
            $(".nextTwoId").hide();
            $(".prevTwoId").show();
        });
    });
    /*review page*/
    $("#topbarcut").click(function () {
        $(".review-container").addClass("review_close");
    })

    $("#topbarcut").click(function () {
        $(".header-cus").addClass("intro");
        $('.woo_amc_open.right-top-fixed ').addClass('sagar');
    });
    $("#topbarcut").click(function () {
        $("body").addClass("margin");
    });


    $(document).ready(function () {
        $('#cus-nav').click(function () {
            $("#cus-show").slideToggle(600);
        });
    });
    $(document).ready(function () {
        $('.abs-ic').click(function () {
            $("#cus-show").slideUp(600);
        });
    });

    jQuery('body').click(function () {
        jQuery('#cus-show').slideUp();
    });

    $('#cus-nav').click(function (e) {

        e.stopPropagation();
    });

    $('#cus-head').on('click', 'body *', function () {
        $("#cus-show").slideUp(600);
    });

    $("#cus-nav1").click(function () {
        $("body").addClass("m-open");
    });

    $(".abs-ic").click(function () {
        $("body").removeClass("m-open");
    });


    jQuery(document).ready(function () {
        jQuery('iframe[src*="https://player.vimeo.com/video/"]').addClass("youtube-iframe");
        jQuery(".close").click(function () {

            $('.youtube-iframe').each(function (index) {
                $(this).attr('src', $(this).attr('src'));

            });
        });

        jQuery('iframe[src*="https://player.vimeo.com/video/"]').addClass("youtube-iframe");
        jQuery(".modal").click(function () {

            $('.youtube-iframe').each(function (index) {
                $(this).attr('src', $(this).attr('src'));
                return false;
            });
        });
        jQuery('iframe[src*="https://player.vimeo.com/video/"]').addClass("youtube-iframe");
        jQuery("body").click(function () {

            $('.youtube-iframe').each(function (index) {
                $(this).attr('src', $(this).attr('src'));
                //return false;
            });

        });
    });

    $(document).ready(function () {
        var curnturl = window.location.href;
        if (curnturl == "<?php echo get_site_url(); ?>/product/apothecary/healthy-gut/") {
            $(".woocommerce-variation single_variation").css("display", "block");
        }

    });
    /** yoypo refresh AjAX */
    $(document).ajaxComplete(function (event, xhr, settings) {
        if (settings.data.indexOf('action=woof_draw_products&') >= 0) {
            //alert(1);
            yotpo.refreshWidgets();
            //yotpo.init();
        }
        console.log(xhr);
        console.log(settings);
    });


    //prevent reloading the shope page
    $('.nav-item a[href="#"]').click(function () {
        return false;
    });
    /*backto top*/
    let mybutton = document.getElementById("btn_btt");

    function topFunction() {
        document.body.scrollTop = 0;
        document.documentElement.scrollTop = 0;
    };
    $('.radio-customc').change(function () {
        if ($(this).is(":checked")) {
            $('.img-overlay').addClass("overlay");
        } else {
            $('.img-overlay').removeClass("overlay");
        }
    });

    $(".off-purchase .of").click(function () {
        $(".select-img").css("display", "none");
    });

    $(document).ready(function () {
        var ca = getCookie('weeklyPack');
        if (ca == '' || typeof ca == "undefined") {
            setCookie("weeklyPack", '1_week', 365);
        }
        $(".off-purchase .radio-customc").click(function () {
            $(".select-img").css("display", "none");
        });
        $(".subscribe-tps .radio-customc").click(function () {
            $(".select-img").css("visibility", "visible");
        });
        $(document).on('change', ".subscribe-tps .radio-customc", function (e) {
            e.preventDefault();
            var checked = $(this).prop('checked'),
                product = $(this).closest('li.product');
            if (checked) {
                setWeeklyPack(product);
                $(this).parent().next().show();
                $(".off").prop('checked', false);
            } else {
                // updateSubscriptionCookie(0);
                // $("li.one-time-option").removeAttr('style');
                // $('.one-time-option').removeClass('hide-one-time');
                // $("li.one-time-option").css('display', "block");
                product.find(".subscription-option").siblings().removeClass("active");
                product.find('.sub-price').remove();
                $(this).parent().next().hide();
                product.find('.wcsatt-options-product input[value="0"]').prop('checked', true).change();
            }
        });
        // $(document).on('click', '.woof_results_by_ajax_shortcode a.woocommerce-LoopProduct-link.woocommerce-loop-product__link', function(e) {
        //     e.preventDefault();
        // })
    });

    $(document).ready(function () {
        var cntprourl = window.location.href;
        if (cntprourl == "<?php echo get_site_url(); ?>/raw-meals/" || cntprourl ==
            "<?php echo get_site_url(); ?>/combo-boxes/" || cntprourl == "<?php echo get_site_url(); ?>/treats/" ||
            cntprourl == "<?php echo get_site_url(); ?>/apothecary/") {
            $(window).scroll(function () {
                if ($(document).scrollTop() > 425) {
                    $(".chose-comob-box").addClass("box-sticky-add");
                } else {
                    $(".chose-comob-box").removeClass("box-sticky-add");
                }
            });
        }
    });

    jQuery('#mc-embedded-subscribe').click(function () {
        //alert('Here');
        var formstring = $('#mc-embedded-subscribe-form').serialize();

        $.ajax({
            type: "POST",
            url: "/registerdb",
            data: formstring,
            success: function (data) {
                alert("You have been successfully registered!");
                window.location.href = "<?php echo get_site_url(); ?>/login/";
                return false;
            },
            error: function (err) {
                alert("Please complete all required fields");
                return false;
            }
        })
    });

    $(document).ready(function () {
        $(".rwashowlast").click(function () {
            $(".chunii-left-image").addClass("backshoimg");
        });
        $(".rwashowfirst").click(function () {
            $(".chunii-left-image").removeClass("backshoimg");
        });
    });

    function login() {
        var email = $("#email").val();
        var password = $("#password").val();



        $.ajax({
            type: "POST",
            url: "/loginpage",
            data: {
                email: email,
                password: password
            },
            success: function (data) {

                var trimmeddata = data.trim();

                if (trimmeddata == "Invalid Email or Password") {


                } else {

                    location.href = "<?php echo get_site_url(); ?>";
                }


                return false;
            },
            error: function (err) {

                return false;
            }
        });
        return false;
    }

    $(document).ready(function () {

        $(".suspend").html("Pause");
    });


    $(document).ready(function () {
        $(".adtsubce").click(function () {

            $(this).html('Added to Subscription');

        });
        jQuery(document).on('click', ".show-pincode-pop-up", function () {
            //postcode checker for product  
            var product_id = $(this).attr("product_id")
            $("#checkpin").attr("product_id", product_id)

            var str = $("#pincode_field_id").val();
            if (str == "") {
                $('.pc-popup').addClass('open');
                /*jQuery(".attnstate").css("display", "flex");
                  jQuery(".postapprstate").css("display", "none");
                jQuery(".pnrmlstate").css("display", "none");
                jQuery(".disapprstate").css("display", "none");*/
                //jQuery("#collapse11").collapse("show");
                //jQuery('.mobile-pincode-heading').html("WE DON'T DELIVER TO THIS AREA.");
                jQuery('.mobile-pincode-heading').css("color", "red");
                jQuery("html, body").animate({
                    scrollTop: 100
                }, "slow");
                return false;
            }
            if (str != "") {
                $(this).html('Added to Box');
                setTimeout(function () {
                    $(this).html('Add item')
                }, 2000);
            }
        });
        // $(".single_add_to_cart_button").click(function() {
        //  var str = $("#pincode_field_id").val();
        // if (str == "") {
        //   $('.pc-popup').addClass('open');
        /*jQuery(".attnstate").css("display", "flex");
          jQuery(".postapprstate").css("display", "none");
        jQuery(".pnrmlstate").css("display", "none");
        jQuery(".disapprstate").css("display", "none");*/
        //jQuery("#collapse11").collapse("show");
        //jQuery('.mobile-pincode-heading').html("WE DON'T DELIVER TO THIS AREA.");
        // jQuery('.mobile-pincode-heading').css("color", "red");
        // jQuery("html, body").animate({
        //    scrollTop: 100
        // }, "slow");
        // return false;
        // }
        // if (str != "") {
        //   $(this).html('Added to Box');
        // setTimeout(function() {
        //    $(this).html('Add item')
        // }, 2000);
        // }
        //});

    });
    jQuery(document).on('click', '#checkpin', function () {
        //jQuery('.mobile-pincode-heading').html("CHECK WE DELIVER TO YOUR AREA");
        jQuery('.mobile-pincode-heading').removeAttr("style");
    });
    $(document).ready(function () {
        $(".quantity").css("display", "none");
        $('.ajax_add_to_cart').click(function () {
            var d = $(this).data('product_id');

            $('.post-' + d + ' > .quantity').css("display", "block");
            $('.post-' + d + ' > .ajax_add_to_cart').css("display", "none");
        });
    });

    $(document).ready(function () {
        $(".toggle-acount").click(function () {
            $("body").toggleClass("short-slide-box");
        });
    });


    var fclass = jQuery('ul.wcsatt-options-product li:nth-child(1)').attr('class');
    if (fclass == 'subscription-option') {
        $(".wcsatt-options-product li:nth-child(2)").addClass('active');
    }
    jQuery("select[name='subscription-options']").on('change', function (e) {
        var aa = jQuery(this).val(),
            product = $(this).closest('li.product');
        updateSubscriptionCookie(aa, product);
        console.log(aa);
        product.find('.sub-price').remove();
        product.find("ul.wcsatt-options-product input[type='radio'][value='" + aa + "']").prop('checked', true)
            .change();
        var fclass = product.find('ul.wcsatt-options-product li:nth-child(1)').attr('class');
        var fval = 1;
        if (product.find('ul.wcsatt-options-product li:nth-child(1)').hasClass('one-time-option')) {
            fval = 0;
        }

        if (aa == '1_week') {
            var childval = 2 - fval;
            product.find('ul.wcsatt-options-product li').removeClass('active');
            product.find('ul.wcsatt-options-product li:nth-child(' + childval + ')').addClass('active');
        }
        if (aa == '2_week') {
            var childval = 3 - fval;
            product.find('ul.wcsatt-options-product li').removeClass('active');
            product.find('ul.wcsatt-options-product li:nth-child(' + childval + ')').addClass('active');
        }
        if (aa == '3_week') {
            var childval = 4 - fval;
            product.find('ul.wcsatt-options-product li').removeClass('active');
            product.find('ul.wcsatt-options-product li:nth-child(' + childval + ')').addClass('active');
        }
        if (aa == '4_week') {
            var childval = 5 - fval;
            product.find('ul.wcsatt-options-product li').removeClass('active');
            product.find('ul.wcsatt-options-product li:nth-child(' + childval + ')').addClass('active');
        }
        if (aa == '5_week') {
            var childval = 6 - fval;
            product.find('ul.wcsatt-options-product li').removeClass('active');
            product.find('ul.wcsatt-options-product li:nth-child(' + childval + ')').addClass('active');
        }
        if (aa == '6_week') {
            var childval = 7 - fval;
            product.find('ul.wcsatt-options-product li').removeClass('active');
            product.find('ul.wcsatt-options-product li:nth-child(' + childval + ')').addClass('active');
        }
        var sub_price = product.find('li.subscription-option.active span.price.subscription-price').clone();
        sub_price.addClass('sub-price');
        sub_price.insertBefore(product.find('> a > span.price'));
    });

    jQuery('#pincode_field_idp label:contains("Check Availability At")').text("SEE IF WE DELIVER TO YOUR DOOR");
    jQuery('#pincode_field_idp').prepend('<p class="subpurstep">Step 1</p>');
    jQuery('#change_pin').append('Change postcode');


    $(".togmcalcu").click(function () {
        $("body").removeClass("mobile-open");
    });
    $(document).ready(function () {

        $('select option:contains("Every 2 Week")').text('Every 2 Weeks');
        $('select option:contains("Every 3 Week")').text('Every 3 Weeks');
        $('select option:contains("Every 4 Week")').text('Every 4 Weeks');
        $('select option:contains("Every 5 Week")').text('Every 5 Weeks');
        $('select option:contains("Every 6 Week")').text('Every 6 Weeks');

        localStorage.setItem('subpack', 0);
        var maxval = parseFloat($("#dataprice").attr('data-max'));
        if (maxval <= 0 || maxval == '') {
            maxval = 100;
        }
        var dataprice = parseFloat($("#dataprice").attr('data-price'));
        var vals = localStorage.getItem('subpack');
        if (vals == 0 || vals == '0') {
            $(".one-time-option").show();


            $(".one-time-option label .one-time-option-details").before(
                '<span class="woocommerce-Price-amount amount"><bdi><span class="woocommerce-Price-currencySymbol">$</span><span id="kbsask">' +
                dataprice.toFixed(2) + '</span></bdi></span>');
        } else {
            $(".one-time-option").hide();
        }

        $(document).on('click', '.minus', function () {
            var qty = parseInt($('.qty').val());
            if (qty >= 1) {

                var prodprice = dataprice * (qty).toFixed(2);
                var offerPrice = calOfferPrice(prodprice);
                $("#dataprice .woocommerce-Price-amount,.subscription-price del .woocommerce-Price-amount,#kbsask")
                    .html('<bdi><span class="woocommerce-Price-currencySymbol">$</span>' + prodprice
                        .toFixed(2) + '</bdi></span>');
                $("#dataprice .woocommerce-Price-amount,.subscription-price ins .woocommerce-Price-amount,#kbsask")
                    .html('<bdi><span class="woocommerce-Price-currencySymbol">$</span>' + offerPrice
                        .toFixed(2) + '</bdi></span>');
                updateonchangeqty(qty);
            }
        });
        $(document).on('click', '.plus', function () {
            var qty = parseInt($('.qty').val());
            if (qty >= 1 && qty < maxval) {

                var prodprice = dataprice * (qty).toFixed(2);
                var offerPrice = calOfferPrice(prodprice);
                $("#dataprice .woocommerce-Price-amount,.subscription-price del .woocommerce-Price-amount,#kbsask")
                    .html('<bdi><span class="woocommerce-Price-currencySymbol">$</span>' + prodprice
                        .toFixed(2) + '</bdi></span>');
                $("#dataprice .woocommerce-Price-amount,.subscription-price ins .woocommerce-Price-amount,#kbsask")
                    .html('<bdi><span class="woocommerce-Price-currencySymbol">$</span>' + offerPrice
                        .toFixed(2) + '</bdi></span>');
                updateonchangeqty(qty);
            }
        });
    });



    $('select[name="subscription-options"]').change(function () {
        var product = $(this).closest('li.product')
        updateSubscriptionCookie($(this).val(), product);
        $(".one-time-option").hide();
        var qty = parseInt($('.qty').val());
        if ($(this).val() != '1_week') {
            product.find(".wcsatt-options-product li:nth-child(2)").removeClass('active');
        }
        var dataprice = parseFloat($("#dataprice").attr('data-price'));
        var vals = $(this).val();
        product.find('select.subs_intervl').val(vals);

        // var  cusData = product.find('input[value="'+vals+'"]').attr('data-custom_data');
        //     var valspase= JSON.parse(cusData);
        //     var discountSub = valspase['subscription_scheme'].discount;
        //     discountSub=  ((dataprice/100)*discountSub).toFixed(2);
        //     var discountVal = qty*(dataprice-discountSub); 
        //     var hrmlprice = $(".subscription-option.active label span span ins").html('<span class="woocommerce-Price-amount amount"><bdi><span class="woocommerce-Price-currencySymbol">$</span>'+discountVal.toFixed(2)+'</bdi></span>');
    })

    function calOfferPrice(price) {
        var newPrice = (price * 7.5 / 100).toFixed(2);
        return (price - newPrice);
    }

    function updateonchangeqty(qty) {

        var dataprice = parseFloat($("#dataprice").attr('data-price'));
        var vals = localStorage.getItem('subpack');

        if (vals == 0 || vals == '0') {

            $("li.one-time-option").removeAttr('style');
            var checkclass = $('.one-time-option').find('.woocommerce-Price-amount');
            if (checkclass.length == 0) {
                var hrmlprice = $(".one-time-option label .one-time-option-details").before(
                    '<span class="woocommerce-Price-amount amount "><bdi><span class="woocommerce-Price-currencySymbol">$</span><span id="kbsask">' +
                    (qty * dataprice).toFixed(2) + '</span></bdi></span>');
            } else {
                $('#kbsask').html((qty * dataprice).toFixed(2));
            }


        } else {

            var cusData = $('input[value="' + vals + '"]').attr('data-custom_data');
            if (cusData != undefined) {
                var valspase = JSON.parse(cusData);
                if (valspase.length > 0) {

                    var discountSub = valspase['subscription_scheme'].discount;

                    discountSub = parseFloat(((dataprice / 100) * discountSub).toFixed(2));

                    var discountVal = qty * (dataprice - discountSub);

                    var hrmlprice = $(".subscription-option.active label span span ins").html(
                        '<span class="woocommerce-Price-amount amount"><bdi><span class="woocommerce-Price-currencySymbol">$</span>' +
                        discountVal.toFixed(2) + '</bdi></span>');
                }
            }
        }

    }
    $('.purchase-options input').change(function () {
        var qty = parseInt($('.qty').val());

        localStorage.setItem('subpack', '1_week');
        updateonchangeqty(qty);
    });





    $('.subscription-option .subscription-price').contents().filter(function () {

        return this.nodeType === Node.TEXT_NODE;
    }).remove();
    jQuery(document).on('click', '.relative.select-img', function (e) {
        e.preventDefault();
        e.stopImmediatePropagation();
    });
    /* Subscription Cache block start */
    function setWeeklyPack(product) {
        var ca = getCookie('weeklyPack');

        if (ca != 0) {
            var fval = 0;
            var qty = parseInt($('.qty').val());
            product.find('select.subs_intervl').val(ca);
            product.find('select.subs_intervl').select2();
            product.find('.sub-price').remove();
            // $('.purchase-options select').val(ca);
            $('.one-time-option').addClass('hide-one-time');
            $('#subscriptions-list').parent().addClass('selected');
            $('#one-time-purchase').parent().removeClass('selected');
            $('#one-time-purchase').attr('checked', false);
            $('#subscriptions-list').attr('checked', true).trigger('change');
            $('a.subs').show();
            $('a.one-off').hide();
            var dataprice = parseFloat(product.find("#dataprice").attr('data-price'));
            var cusData = $('input[value="' + ca + '"]').attr('data-custom_data');
            console.log(dataprice, 'dataprice');
            console.log(cusData, 'cusData');
            product.find("ul.wcsatt-options-product input[type='radio']").prop('checked', false).change();
            product.find("ul.wcsatt-options-product input[type='radio'][value='" + ca + "']").prop('checked', true)
                .change();

            var valspase = JSON.parse(cusData);


            // var discountSub = valspase['subscription_scheme'].discount;

            // discountSub=  parseFloat(((dataprice/100)*discountSub).toFixed(2));

            // var discountVal = qty*(dataprice-discountSub); 

            // var hrmlprice = $(".subscription-option.active label span span ins").html('<span class="woocommerce-Price-amount amount"><bdi><span class="woocommerce-Price-currencySymbol">$</span>'+discountVal.toFixed(2)+'</bdi></span>');

            var aa = ca;


            if (aa == '1_week') {

                var childval = 2 - fval;
                product.find('ul.wcsatt-options-product li').removeClass('active');
                product.find('ul.wcsatt-options-product li:nth-child(' + childval + ')').addClass('active');



            }
            if (aa == '2_week') {

                var childval = 3 - fval;
                product.find('ul.wcsatt-options-product li').removeClass('active');
                product.find('ul.wcsatt-options-product li:nth-child(' + childval + ')').addClass('active');
            }
            if (aa == '3_week') {

                var childval = 4 - fval;
                product.find('ul.wcsatt-options-product li').removeClass('active');
                product.find('ul.wcsatt-options-product li:nth-child(' + childval + ')').addClass('active');
            }
            if (aa == '4_week') {

                var childval = 5 - fval;
                product.find('ul.wcsatt-options-product li').removeClass('active');
                product.find('ul.wcsatt-options-product li:nth-child(' + childval + ')').addClass('active');
            }
            if (aa == '5_week') {

                var childval = 6 - fval;
                product.find('ul.wcsatt-options-product li').removeClass('active');
                product.find('ul.wcsatt-options-product li:nth-child(' + childval + ')').addClass('active');
            }
            if (aa == '6_week') {

                var childval = 7 - fval;
                product.find('ul.wcsatt-options-product li').removeClass('active');
                product.find('ul.wcsatt-options-product li:nth-child(' + childval + ')').addClass('active');
            }

            var sub_price = product.find('li.subscription-option.active span.price.subscription-price').clone();
            sub_price.addClass('sub-price');
            sub_price.insertBefore(product.find('> a > span.price'));
        }
    }


    console.log('window.location.pathname this is footer', window.location.pathname);

    // var ca = getCookie('weeklyPack');

    // if(ca != 0){
    //     var fval = 0;
    //     var qty= parseInt($('.qty').val());
    //     $('.purchase-options select').val(ca);
    //     $('.one-time-option').addClass('hide-one-time');
    //     $('#subscriptions-list').parent().addClass('selected');
    //     $('#one-time-purchase').parent().removeClass('selected');
    //     $('#one-time-purchase').attr('checked', false);
    //     $('#subscriptions-list').attr('checked', true).trigger('change');
    //     $('a.subs').show();
    //     $('a.one-off').hide();
    //     var dataprice=  parseFloat($("#dataprice").attr('data-price'));
    //     var cusData = $('input[value="'+ca+'"]').attr('data-custom_data');
    //     jQuery("ul.wcsatt-options-product input[type='radio']").prop('checked', false).change();
    //     jQuery("ul.wcsatt-options-product input[type='radio'][value='"+ca+"']").prop('checked', true).change();

    //         var valspase= JSON.parse(cusData);


    //         var discountSub = valspase['subscription_scheme'].discount;

    //         discountSub=  parseFloat(((dataprice/100)*discountSub).toFixed(2));

    //         var discountVal = qty*(dataprice-discountSub); 

    //         var hrmlprice = $(".subscription-option.active label span span ins").html('<span class="woocommerce-Price-amount amount"><bdi><span class="woocommerce-Price-currencySymbol">$</span>'+discountVal.toFixed(2)+'</bdi></span>');

    //     var aa = ca;            

    //     if(aa=='1_week'){

    //         var childval=2-fval;
    //         jQuery('ul.wcsatt-options-product li').removeClass('active'); 
    //         jQuery('ul.wcsatt-options-product li:nth-child('+childval+')').addClass('active');



    //     }
    //     if(aa=='2_week'){

    //         var childval=3-fval;
    //         jQuery('ul.wcsatt-options-product li').removeClass('active'); 
    //         jQuery('ul.wcsatt-options-product li:nth-child('+childval+')').addClass('active');
    //     }
    //     if(aa=='3_week'){

    //         var childval=4-fval;
    //         jQuery('ul.wcsatt-options-product li').removeClass('active');   
    //         jQuery('ul.wcsatt-options-product li:nth-child('+childval+')').addClass('active');
    //     }
    //     if(aa=='4_week'){

    //         var childval=5-fval;
    //     jQuery('ul.wcsatt-options-product li').removeClass('active');   
    //     jQuery('ul.wcsatt-options-product li:nth-child('+childval+')').addClass('active');
    //     }
    //     if(aa=='5_week'){

    //         var childval=6-fval;
    //     jQuery('ul.wcsatt-options-product li').removeClass('active');   
    //     jQuery('ul.wcsatt-options-product li:nth-child('+childval+')').addClass('active');
    //     }
    //     if(aa=='6_week'){

    //         var childval=7-fval;
    //         jQuery('ul.wcsatt-options-product li').removeClass('active');   
    //         jQuery('ul.wcsatt-options-product li:nth-child('+childval+')').addClass('active');
    //     }
    // }
    $('.purchase-options input').click(function () {
        var subscriptionType = $(this).attr('id'),
            product = $(this).closest('li.product');
        if (subscriptionType == 'one-time-purchase') {
            updateSubscriptionCookie(0, product);
            $(".one-time-option").show();
            $("li.one-time-option").removeAttr('style');
            $('.one-time-option').removeClass('hide-one-time');
            $("li.one-time-option").css('display', "block");
            $(".subscription-option").siblings().removeClass("active");
        } else {
            updateSubscriptionCookie($('.purchase-options select').val(), product);
            $(".one-time-option").hide();
            $('.one-time-option').addClass('hide-one-time');
            var interest = $('.wcsatt-options-product').find('li.active');
            if (interest.length == 0) {
                $(".wcsatt-options-product li:nth-child(2)").addClass('active');
                $('.purchase-options select[name="subscription-options"]').val("1_week");

            } else {

            }
        };

        $(this).closest('li').addClass('selected')
            .siblings().removeClass('selected');

    });

    $('.purchase-options select').change(function () {
        $('.purchase-options input[value="subscription"]').prop('checked', true).change();

    });

    function updateSubscriptionCookie(v, product) {
        console.log(v, product);
        setCookie("weeklyPack", v, 365);
        product.find('.wcsatt-options-product input[value="' + v + '"]').prop('checked', true).change();
    }

    function getCookie(cname) {
        let name = cname + "=";
        let ca = document.cookie.split(';');
        for (let i = 0; i < ca.length; i++) {
            let c = ca[i];
            while (c.charAt(0) == ' ') {
                c = c.substring(1);
            }
            if (c.indexOf(name) == 0) {
                return c.substring(name.length, c.length);
            }
        }
        return "";
    }

    function setCookie(cname, cvalue, exdays) {
        const d = new Date();
        d.setTime(d.getTime() + (exdays * 24 * 60 * 60 * 1000));
        let expires = "expires=" + d.toUTCString();
        document.cookie = cname + "=" + cvalue + ";" + expires + ";path=/";
    }
    /* Subscription code block end */

    $(document).ready(function () {
        $(".qty").change(function () {

            $('#cart_product_' + $(this).attr('data-productID')).attr('data-quantity', $(this).val());
        });
    });
    $(document).ready(function () {
        $(".sticky_cart_btn").click(function () {
            $(".woo_amc_container_wrap_right").addClass('woo_amc_show');
        });
    });


    $(document).ready(function () {
        $("input[name='add-to-cart']").click(function () {

            $('.woo_amc_container_wrap_right').removeClass('woo_amc_show');
        });
    });

    $(document).ready(function () {
        $(".footer_cart_btn").click(function () {
            $(".woo_amc_container_wrap_right").addClass("woo_amc_show");
            $(".woo_amc_bg").addClass("woo_amc_show");
        });
    });




    $(document).ready(function () {
        var windowWidth = window.innerWidth;
        if (windowWidth > '1024') {
            $(".subscriptions-listcs").click(function () {
                $(".subs").css("display", "flex");
                $(".one-off").css("display", "none");
            });
            $(".one-time-purchasecs").click(function () {
                $(".subs").css("display", "none");
                $(".one-off").css("display", "flex");
            });
        }
    });
    jQuery(document).ready(function () {
        var deviceWidth = jQuery(window).width();
        if (deviceWidth >= 767) {
            jQuery('.mobile-show').remove();
        } else {
            jQuery('.mobile-hide').remove();
            jQuery('.mobile-show').show();
        }
    });



    jQuery("#change_pin").click(function () {
        jQuery(".postapprstate").css("display", "none");
        jQuery(".pnrmlstate").css("display", "flex");
        jQuery(".disapprstate").css("display", "none");
    });
    jQuery.ajaxSetup({
        success: function (data) {
            console.log(data);
        }
    });

    AOS.init({
        once: true
    });


    /*-----------------*/

    var fclass = jQuery('ul.wcsatt-options-product li:nth-child(1)').attr('class');
    if (fclass == 'subscription-option') {
        $(".wcsatt-options-product li:nth-child(2)").addClass('active');
    }
    jQuery("select[name='subscription-options']").on('change', function () {
        var aa = jQuery(this).val();
        console.log(aa);
        jQuery("ul.wcsatt-options-product input[type='radio'][value='" + aa + "']").prop('checked', true).change();
        var fclass = jQuery('ul.wcsatt-options-product li:nth-child(1)').attr('class');
        var fval = 1;
        if (jQuery('ul.wcsatt-options-product li:nth-child(1)').hasClass('one-time-option')) {
            fval = 0;
        }
        if (aa == '1_week') {
            var childval = 2 - fval;
            jQuery('ul.wcsatt-options-product li').removeClass('active');
            jQuery('ul.wcsatt-options-product li:nth-child(' + childval + ')').addClass('active');
        }
        if (aa == '2_week') {

            var childval = 3 - fval;
            jQuery('ul.wcsatt-options-product li').removeClass('active');
            jQuery('ul.wcsatt-options-product li:nth-child(' + childval + ')').addClass('active');
        }
        if (aa == '3_week') {

            var childval = 4 - fval;
            jQuery('ul.wcsatt-options-product li').removeClass('active');
            jQuery('ul.wcsatt-options-product li:nth-child(' + childval + ')').addClass('active');
        }
        if (aa == '4_week') {

            var childval = 5 - fval;
            jQuery('ul.wcsatt-options-product li').removeClass('active');
            jQuery('ul.wcsatt-options-product li:nth-child(' + childval + ')').addClass('active');
        }
        if (aa == '5_week') {

            var childval = 6 - fval;
            jQuery('ul.wcsatt-options-product li').removeClass('active');
            jQuery('ul.wcsatt-options-product li:nth-child(' + childval + ')').addClass('active');
        }
        if (aa == '6_week') {

            var childval = 7 - fval;
            jQuery('ul.wcsatt-options-product li').removeClass('active');
            jQuery('ul.wcsatt-options-product li:nth-child(' + childval + ')').addClass('active');
        }
    });

    jQuery('#pincode_field_idp label:contains("Check Availability At")').text("SEE IF WE DELIVER TO YOUR DOOR");
    jQuery('#pincode_field_idp').prepend('<p class="subpurstep">Step 1</p>');
    //jQuery('#change_pin').append('Change postcode');


    $(".togmcalcu").click(function () {
        $("body").removeClass("mobile-open");
    });
    $(document).ready(function () {

        $('select option:contains("Every 2 Week")').text('Every 2 Weeks');
        $('select option:contains("Every 3 Week")').text('Every 3 Weeks');
        $('select option:contains("Every 4 Week")').text('Every 4 Weeks');
        $('select option:contains("Every 5 Week")').text('Every 5 Weeks');
        $('select option:contains("Every 6 Week")').text('Every 6 Weeks');

        localStorage.setItem('subpack', 0);
        var maxval = parseFloat($("#dataprice").attr('data-max'));
        if (maxval <= 0 || maxval == '') {
            maxval = 100;
        }
        var dataprice = parseFloat($("#dataprice").attr('data-price'));
        var vals = localStorage.getItem('subpack');

        $(document).on('click', '.minus', function () {
            var qty = parseInt($('.qty').val());
            if (qty >= 1) {

                var prodprice = dataprice * (qty).toFixed(2);
                var offerPrice = calOfferPrice(prodprice);
                $("#dataprice .woocommerce-Price-amount,.subscription-price del .woocommerce-Price-amount,#kbsask")
                    .html('<bdi><span class="woocommerce-Price-currencySymbol">$</span>' + prodprice
                        .toFixed(2) + '</bdi></span>');
                $("#dataprice .woocommerce-Price-amount,.subscription-price ins .woocommerce-Price-amount,#kbsask")
                    .html('<bdi><span class="woocommerce-Price-currencySymbol">$</span>' + offerPrice
                        .toFixed(2) + '</bdi></span>');
                updateonchangeqty(qty);
            }
        });
        $(document).on('click', '.plus', function () {
            var qty = parseInt($('.qty').val());
            if (qty >= 1 && qty < maxval) {

                var prodprice = dataprice * (qty).toFixed(2);
                var offerPrice = calOfferPrice(prodprice);
                $("#dataprice .woocommerce-Price-amount,.subscription-price del .woocommerce-Price-amount,#kbsask")
                    .html('<bdi><span class="woocommerce-Price-currencySymbol">$</span>' + prodprice
                        .toFixed(2) + '</bdi></span>');
                $("#dataprice .woocommerce-Price-amount,.subscription-price ins .woocommerce-Price-amount,#kbsask")
                    .html('<bdi><span class="woocommerce-Price-currencySymbol">$</span>' + offerPrice
                        .toFixed(2) + '</bdi></span>');
                updateonchangeqty(qty);
            }
        });
    });


    function calOfferPrice(price) {
        var newPrice = (price * 7.5 / 100).toFixed(2);
        return (price - newPrice);
    }

    function updateonchangeqty(qty) {

        var dataprice = parseFloat($("#dataprice").attr('data-price'));
        var vals = localStorage.getItem('subpack');

        if (vals == 0 || vals == '0') {

            $("li.one-time-option").removeAttr('style');
            var checkclass = $('.one-time-option').find('.woocommerce-Price-amount');
            if (checkclass.length == 0) {
                var hrmlprice = $(".one-time-option label .one-time-option-details").before(
                    '<span class="woocommerce-Price-amount amount "><bdi><span class="woocommerce-Price-currencySymbol">$</span><span id="kbsask">' +
                    (qty * dataprice).toFixed(2) + '</span></bdi></span>');
            } else {
                $('#kbsask').html((qty * dataprice).toFixed(2));
            }


        } else {

            var cusData = $('input[value="' + vals + '"]').attr('data-custom_data');
            if (cusData != undefined) {
                var valspase = JSON.parse(cusData);
                if (valspase.length > 0) {

                    var discountSub = valspase['subscription_scheme'].discount;

                    discountSub = parseFloat(((dataprice / 100) * discountSub).toFixed(2));

                    var discountVal = qty * (dataprice - discountSub);

                    var hrmlprice = $(".subscription-option.active label span span ins").html(
                        '<span class="woocommerce-Price-amount amount"><bdi><span class="woocommerce-Price-currencySymbol">$</span>' +
                        discountVal.toFixed(2) + '</bdi></span>');
                }
            }
        }
    }
    $('.purchase-options input').change(function () {
        var qty = parseInt($('.qty').val());

        localStorage.setItem('subpack', '1_week');
        updateonchangeqty(qty);
    });
    $('.subscription-option .subscription-price').contents().filter(function () {

        return this.nodeType === Node.TEXT_NODE;
    }).remove();
</script>
<script type="text/javascript" src="//www.klaviyo.com/media/js/public/klaviyo_subscribe.js"></script>
<script type="text/javascript" src="https://ajax.aspnetcdn.com/ajax/jquery.validate/1.7/jquery.validate.min.js">
</script>
<script type="text/javascript">
    $('#form-contact').validate({
        rules: {
            first_name: {
                required: true,
            },
            email: {
                required: true,
            }
        },

        submitHandler: function (form) {
            /*$('#onetimeonly').on('click', function(e) {
                $(this).prop( "disabled", true );
                });*/
            // alert('valid form submitted');
            insertData()
            //form.submit(); 
            return false;
        }
    });



    function insertData() {

        var first_name = $("#first_name").val();
        var email = $("#email").val();
        var g = $("#UmbEEm").val();

        $.ajax({
            type: "POST",
            async: false,
            url: "https://manage.kmail-lists.com/ajax/subscriptions/subscribe",
            data: {
                first_name: first_name,
                email: email,
                g: g
            },
            success: function (data) {
                //alert(data['success']);
                console.log(data);
                if (data['success'] = "true") {
                    $("#onetimeonly").val("Thanks!");

                }
                return false;
            },
            error: function (err) {
                //alert(err);
                return false
            }
        });
        return false
    }
</script>


<?php wp_footer(); ?>
</body>

</html>