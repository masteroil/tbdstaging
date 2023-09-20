<?php 
  

if(isset($_COOKIE["name"])){ 
    //echo $frequencyname=$_COOKIE["name"];
    
} else{ 
    //echo "No frequency selected yet"; 
}
?>

<!DOCTYPE html>

<?php if(is_page('my-account')){?>
<html lang="en" class="onlyaccountcus">
<?php } 
else{ ?>
<html lang="en">
<?php } ?>

<head>
    <title><?php wp_title();?></title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <!--  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"> -->
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">


    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="<?php echo get_site_url();?>/wp-content/themes/Blutcher/assets/css/animate.min.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="icon" href="<?php echo get_site_url();?>/wp-content/uploads/2020/09/TBD_Favicon.png" type="image/png">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.14.0/css/all.min.css"
        integrity="sha512-1PKOgIY59xJ8Co8+NE6FZ+LOAZKjy+KY8iq0G4B3CyeY6wYHN3yt9PW0XpSriVlkMXe40PTKnXrLnZ9+fkDaog=="
        crossorigin="anonymous" />
    <link rel="stylesheet"
        href="<?php echo get_site_url();?>/wp-content/themes/Blutcher/assets/css/owl.carousel.min.css">
    <link rel="stylesheet"
        href="<?php echo get_site_url();?>/wp-content/themes/Blutcher/assets/css/owl.theme.default.min.css">
    <link rel="stylesheet"
        href="<?php echo get_site_url();?>/wp-content/themes/Blutcher/assets/css/bundle.33dd3bc0.css">
    <link rel="stylesheet" href="<?php echo get_site_url();?>/wp-content/themes/Blutcher/assets/css/style.css">
    <link rel="stylesheet" href="<?php echo get_site_url();?>/wp-content/themes/Blutcher/assets/css/custom_style.css">


    <link rel="stylesheet" href="https://use.typekit.net/rfu8eci.css">
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">

    <!-- Script Files-->



    <?php if ( is_page_template( 'stockists.php' ))  {?>
    <script src="<?php echo get_site_url();?>/wp-content/themes/Blutcher/assets/js/jquery.min.js"></script>
    <?php } ?>
    <script src="<?php echo get_site_url();?>/wp-content/themes/Blutcher/assets/js/wow.min.js"></script>

    <script>
    new WOW().init();
    </script>

    <?php

if(isset($_GET['cancel_order'])){

//header("Location: https://thebutchersdog.com.au/checkout");
echo '<script>window.location.href = "https://thebutchersdog.com.au/checkout";</script>';

exit();
}
?>
    <?php wp_head(); ?>
</head>
<style>
/*sagar 31 mar 2021 start*/

.new-custom-login-account img {
    max-width: 28px;
    height: 27px;
    position: absolute;
    top: 10px;
    bottom: 0;
    margin: auto;
    right: 65px;
}

.new-custom-login-user img {
    max-width: 33px;
    height: 33px;
    position: absolute;
    top: 3px;
    bottom: 0;
    margin: auto;
    right: 61px;
}

@media (min-width: 768px) {

    .new-custom-login-account,
    .new-custom-login-user {
        display: none;
    }
}

@media (max-width: 767px) {
    .new-custom-login-account img {
        top: 0px;
        right: 62px;
    }

    .woo_amc_open.right-top-fixed {
        top: 76px !important;
        width: 27px !important;
    }

    .woo_amc_open.right-top-fixed.drag-stick {
        top: 24px !important;
    }

    .new-custom-login-user img {
        top: -5px;
        max-width: 32px;
        height: 32px;
        right: 55px;
    }
}

@media (max-width: 380px) {
    .navbar-brand img {
        max-width: 140px;
    }
}

/*sagar 31 mar 2021 end*/

/*sagar 1 Apr 2021 start*/

@media (max-width: 767px) {
    .new-custom-login-account img {
        max-width: 29px;
        height: 29px;
    }
}

/*sagar 1 Apr 2021 end*/
</style>

<body>
    <div class="header-alert alert alert-success">
        <a href="#" class="close" id="topbarcut" data-dismiss="alert" aria-label="close">&times;</a>
        Register to Join the Pack <a href="#sign-up">Register <i class="fas fa-arrow-right"></i></a>
    </div>


    <section class="header-cus login-header" id="myHeader">

        <div class="container-fluid">
            <nav class="navbar navbar-expand-md bg-light navbar-light">
                <!-- Brand -->
                <button class="navbar-toggler" id="btu-menu-toggle" type="button" data-toggle="collapse"
                    data-target="#collapsibleNavbar">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <a class="navbar-brand" href="<?php echo get_site_url();?>">
                    <img src="<?php echo get_site_url();?>/wp-content/themes/Blutcher/assets/images/header-menu-logo.png"
                        alt="">


                </a>
                <?php        
          if(!is_user_logged_in()  ) {          
           ?>

                <a class="new-custom-login-account" href="<?php echo get_site_url();?>/my-account/">
                    <img src="<?php echo get_site_url();?>/wp-content/themes/Blutcher/assets/images/TBD_Login.png"
                        alt="">
                </a>
                <?php  }
   if(is_user_logged_in() ) {   
?>
                <a class="new-custom-login-user" href="<?php echo get_site_url();?>/my-account/">
                    <img src="<?php echo get_site_url();?>/wp-content/themes/Blutcher/assets/images/TBD_Dog_Goldhover.png"
                        alt="">
                </a>
                <?php } ?>

                <div class="mobail-b-car-tonly">
                    <div class="abs-right dext">
                        <div class="cart">
                            <a class="cart-contents allmenu-hover-ef-b" href="#" title=""><img class="hover-out-b"
                                    src="<?php echo get_site_url();?>/wp-content/themes/Blutcher/assets/images/TBD_Cart-Empty.png"
                                    alt="">
                                <img class="hover-in-b"
                                    src="<?php echo get_site_url();?>/wp-content/themes/Blutcher/assets/images/TBD_Cart-Empty_Hover.png"
                                    alt=""><span class="cart-contents-count">0</span></a>
                        </div>
                    </div>
                </div>
                <!-- Toggler/collapsibe Button -->

                <!-- Navbar links -->
                <div class="collapse navbar-collapse without-login descktop-nav-b <?php echo $menucus;?>" id="">
                    <ul class="navbar-nav">
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="cus-nav">
                                Shop<i class="fa fa-angle-down iii" aria-hidden="true"></i>
                            </a>
                            <div class="dropdown-menu" id="cus-show">
                                <div class="my-flex">
                                    <a class="dropdown-item"
                                        href="<?php echo get_site_url();?>/shop-2/?swoof=1&product_cat=combo-boxes&paged=1">
                                        <div class="images-combo-b-dog">
                                            <img class="slide-bar-no-hover-i"
                                                src="<?php echo get_site_url();?>/wp-content/themes/Blutcher/assets/images/TBD_Combo-Box.png"
                                                alt="">
                                            <img class="slide-bar-hover-i"
                                                src="<?php echo get_site_url();?>/wp-content/themes/Blutcher/assets/images/TBD_Combo-Box_Hover.png">
                                        </div>
                                        <p>Combo Boxes</p>
                                        <div class="text-para">We’ve carefully curated our most popular raw meal
                                            combinations for specific benefits and stages of life.</div>
                                    </a>
                                    <a class="dropdown-item"
                                        href="<?php echo get_site_url();?>/shop-2/?swoof=1&paged=1&product_cat=raw-meals">
                                        <div class="images-combo-b-dog">
                                            <img class="slide-bar-no-hover-i"
                                                src="<?php echo get_site_url();?>/wp-content/themes/Blutcher/assets/images/TBD_Build-A-Box.png"
                                                alt="">
                                            <img class="slide-bar-hover-i"
                                                src="<?php echo get_site_url();?>/wp-content/themes/Blutcher/assets/images/TBD_Build-A-Box_Hover.png">
                                        </div>
                                        <p>Raw Meals</p>
                                        <div class="text-para">Choose from our selection of human-grade muscle meats,
                                            organs, bones, vegetables and fruit meals.</div>
                                    </a>
                                    <a class="dropdown-item"
                                        href="<?php echo get_site_url();?>/shop-2/?swoof=1&product_cat=treats&paged=1">
                                        <div class="images-combo-b-dog">
                                            <img class="slide-bar-no-hover-i"
                                                src="<?php echo get_site_url();?>/wp-content/themes/Blutcher/assets/images/TBD_Treats.png"
                                                alt="">
                                            <img class="slide-bar-hover-i"
                                                src="<?php echo get_site_url();?>/wp-content/themes/Blutcher/assets/images/TBD_Treats_Hover.png">
                                        </div>
                                        <p>Treats</p>
                                        <div class="text-para">Add some air-dried treats to your box! High nutritional
                                            value and they're brilliant dental chews.</div>
                                    </a>
                                    <a class="dropdown-item"
                                        href="<?php echo get_site_url();?>/shop-2/?swoof=1&product_cat=apothecary&paged=1">
                                        <div class="images-combo-b-dog">
                                            <img class="slide-bar-no-hover-i"
                                                src="<?php echo get_site_url();?>/wp-content/themes/Blutcher/assets/images/TBD_Apothecary.png"
                                                alt="">
                                            <img class="slide-bar-hover-i"
                                                src="<?php echo get_site_url();?>/wp-content/themes/Blutcher/assets/images/TBD_Apothecary_Hover.png">
                                        </div>
                                        <p>Apothecary</p>
                                        <div class="text-para">All-natural pet products designed to support your dog’s
                                            health inside and out. Imported from Canada.</div>
                                    </a>
                                    <a class="dropdown-item"
                                        href="<?php echo get_site_url();?>/shop-2/?swoof=1&product_cat=christmas-gifts&paged=1">
                                        <div class="images-combo-b-dog">
                                            <img class="slide-bar-no-hover-i"
                                                src="<?php echo get_site_url();?>/wp-content/themes/Blutcher/assets/images/TBD_Gifts.png"
                                                alt="">
                                            <img class="slide-bar-hover-i"
                                                src="<?php echo get_site_url();?>/wp-content/themes/Blutcher/assets/images/TBD_Gifts_Hover.png">
                                        </div>
                                        <p>Gifts</p>
                                        <div class="text-para">Spoil your furry family members with these gifts.</div>
                                    </a>
                                </div>

                            </div>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" href="<?php echo get_site_url();?>/raw/">Why Raw</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="<?php echo get_site_url();?>/our-story/">Our Story</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="<?php echo get_site_url();?>/blog/">Blog</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="<?php echo get_site_url();?>/stockists/">Stockists</a>
                        </li>
                    </ul>
                </div>



                <div class="abs-right dext descktop-view-dsp">
                    <?php        
          if(!is_user_logged_in()  ) {          
           ?>


                    <a href="<?php echo get_site_url();?>/my-account/" class="allmenu-hover-ef-b startnw"><span>Start
                            today</span></a><a href="<?php echo get_site_url();?>/my-account/"
                        class="allmenu-hover-ef-b startnw last-tag-custom"> Login<img class="hover-out-b"
                            src="<?php echo get_site_url();?>/wp-content/themes/Blutcher/assets/images/TBD_Login.png"
                            alt="">
                        <img class="hover-in-b"
                            src="<?php echo get_site_url();?>/wp-content/themes/Blutcher/assets/images/TBD_Login_Hover.png"
                            alt=""></a>
                    <?php  }
   if(is_user_logged_in() ) {   
?>
                    <a href="<?php echo get_site_url();?>/my-account/"
                        class="allmenu-hover-ef-b only-display-acoun-open">My Account <img class="hover-out-b"
                            src="<?php echo get_site_url();?>/wp-content/themes/Blutcher/assets/images/TBD_Dog_Goldhover.png"
                            alt="">
                        <img class="hover-in-b"
                            src="<?php echo get_site_url();?>/wp-content/themes/Blutcher/assets/images/TBD_Dog_Goldhover_Hover.png"
                            alt=""></a>
                    <?php } ?>


                </div>

            </nav>
        </div>
    </section>


    <section class="mobile-menu">

        <div class="top-mobile-content">
            <img class="plus-bar-mob"
                src="<?php echo get_site_url();?>/wp-content/themes/Blutcher/assets/images/black-cross.png">
            <div class="abs-right dext cmobail-menu-toggle">
                <?php        
          if(!is_user_logged_in() ) {         
           ?>


                <a href="<?php echo get_site_url();?>/my-account/" class="allmenu-hover-ef-b mstartnw"><span>Start
                        today</span>Login<img class="hover-out-b"
                        src="<?php echo get_site_url();?>/wp-content/themes/Blutcher/assets/images/TBD_Login.png"
                        alt="">
                    <img class="hover-in-b"
                        src="<?php echo get_site_url();?>/wp-content/themes/Blutcher/assets/images/TBD_Login_Hover.png"
                        alt=""></a>
                <?php  }
   if(is_user_logged_in() ) {   
?>
                <a href="<?php echo get_site_url();?>/my-account/" class="allmenu-hover-ef-b only-display-acoun-open">My
                    Account <img class="hover-out-b"
                        src="<?php echo get_site_url();?>/wp-content/themes/Blutcher/assets/images/TBD_Dog_Goldhover.png"
                        alt="">
                    <img class="hover-in-b"
                        src="<?php echo get_site_url();?>/wp-content/themes/Blutcher/assets/images/TBD_Dog_Goldhover.png"
                        alt=""></a>
                <?php } ?>
            </div>
            <div class="clearfix"></div>
        </div>

        <ul class="navbar-nav">
            <!--<li class="nav-item">
                  <a class="nav-link" href="<?php echo get_site_url();?>/shop-2/">Build a Box</a>
                </li>-->

            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="cus-nav1">
                    Shop<i class="fa fa-angle-down iii" aria-hidden="true"></i>
                </a>
                <div class="dropdown-menu" id="cus-show1">
                    <div class="abs-ic">
                        <p>Select a product category</p>
                        <img class="abs-ic1"
                            src="<?php echo get_site_url();?>/wp-content/themes/Blutcher/assets/images/DropDown.png">
                    </div>
                    <div class="my-flex">
                        <a class="dropdown-item"
                            href="<?php echo get_site_url();?>/shop-2/?swoof=1&product_cat=combo-boxes&paged=1">
                            <div class="images-combo-b-dog">
                                <img class="slide-bar-no-hover-i"
                                    src="<?php echo get_site_url();?>/wp-content/themes/Blutcher/assets/images/TBD_Combo-Box.png"
                                    alt="">
                                <img class="slide-bar-hover-i"
                                    src="<?php echo get_site_url();?>/wp-content/themes/Blutcher/assets/images/TBD_Combo-Box_Hover.png">
                            </div>
                            <p>Combo Boxes</p>
                            <div class="text-para">We’ve carefully curated our most popular raw meal combinations for
                                specific benefits and stages of life.</div>
                        </a>
                        <a class="dropdown-item"
                            href="<?php echo get_site_url();?>/shop-2/?swoof=1&paged=1&product_cat=raw-meals">
                            <div class="images-combo-b-dog">
                                <img class="slide-bar-no-hover-i"
                                    src="<?php echo get_site_url();?>/wp-content/themes/Blutcher/assets/images/TBD_Build-A-Box.png"
                                    alt="">
                                <img class="slide-bar-hover-i"
                                    src="<?php echo get_site_url();?>/wp-content/themes/Blutcher/assets/images/TBD_Build-A-Box_Hover.png">
                            </div>
                            <p>Raw Meals</p>
                            <div class="text-para">Choose from our selection of human-grade muscle meats, organs, bones,
                                vegetables and fruit meals.</div>
                        </a>
                        <a class="dropdown-item" href="<?php echo get_site_url();?>/shop-2/?swoof=1&product_cat=treats">
                            <div class="images-combo-b-dog">
                                <img class="slide-bar-no-hover-i"
                                    src="<?php echo get_site_url();?>/wp-content/themes/Blutcher/assets/images/TBD_Treats.png"
                                    alt="">
                                <img class="slide-bar-hover-i"
                                    src="<?php echo get_site_url();?>/wp-content/themes/Blutcher/assets/images/TBD_Treats_Hover.png">
                            </div>
                            <p>Treats</p>
                            <div class="text-para">Add some air-dried treats to your box! High nutritional value and
                                they're brilliant dental chews.</div>
                        </a>
                        <a class="dropdown-item"
                            href="<?php echo get_site_url();?>/shop-2/?swoof=1&product_cat=apothecary">
                            <div class="images-combo-b-dog">
                                <img class="slide-bar-no-hover-i"
                                    src="<?php echo get_site_url();?>/wp-content/themes/Blutcher/assets/images/TBD_Apothecary.png"
                                    alt="">
                                <img class="slide-bar-hover-i"
                                    src="<?php echo get_site_url();?>/wp-content/themes/Blutcher/assets/images/TBD_Apothecary_Hover.png">
                            </div>
                            <p>Apothecary</p>
                            <div class="text-para">All-natural pet products designed to support your dog’s health inside
                                and out. Imported from Canada.</div>
                        </a>
                        <a class="dropdown-item"
                            href="<?php echo get_site_url();?>/shop-2/?swoof=1&product_cat=christmas-gifts">
                            <div class="images-combo-b-dog">
                                <img class="slide-bar-no-hover-i"
                                    src="<?php echo get_site_url();?>/wp-content/themes/Blutcher/assets/images/TBD_Gifts.png"
                                    alt="">
                                <img class="slide-bar-hover-i"
                                    src="<?php echo get_site_url();?>/wp-content/themes/Blutcher/assets/images/TBD_Gifts_Hover.png">
                            </div>
                            <p>Gifts</p>
                            <div class="text-para">Spoil your furry family members with these gifts.</div>
                        </a>
                    </div>

                </div>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="<?php echo get_site_url();?>/raw/">Why Raw</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="<?php echo get_site_url();?>/our-story/">Our Story</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="<?php echo get_site_url();?>/blog/">Blog</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="<?php echo get_site_url();?>/stockists/">Stockists</a>
            </li>
        </ul>
        <div class="faq-food">
            <ul>
                <li><a href="<?php echo get_site_url();?>/faq/">FAQs</a></li>
                <li><a href="#" class="togmcalcu" onclick="modelCalOpen();">Food Calculator</a></li>
                <li><a href="<?php echo get_site_url();?>/terms/">Terms & Conditions</a></li>
                <li><a href="<?php echo get_site_url();?>/privacy-policy/">Privacy Policy</a></li>
            </ul>
        </div>
        <div class="mob-social">
            <ul>
                <li><a href="https://www.facebook.com/thebutchersdogau" target="_blank"><i
                            class="fab fa-facebook-square"></i></a></li>
                <li><a href="https://www.instagram.com/thebutchersdogau/" target="_blank"><i
                            class="fab fa-instagram"></i></a></li>
            </ul>
        </div>


    </section>



    <?php wp_head();




?>