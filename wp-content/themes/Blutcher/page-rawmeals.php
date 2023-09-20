<?php
/* template name: Raw Meal Archive */


$_GET[ 'swoof'] = '?swoof=1&paged=1';
$_GET[ 'paged'] = isset($_GET[ 'paged'])?$_GET[ 'paged']:1;
$_GET[ 'product_cat'] = 'raw-meals';
get_header();

?>

<style>
.wc-product-table-select-filters {
    display: none;
}

.category-filter-parent a {
    cursor: pointer;
}

a.acc-icon:hover {
    color: red !important;
}

.ui-loader .ui-icon-loading {
    background-color: #000;
    display: block;
    margin: 0;
    width: 2.75em;
    height: 2.75em;
    padding: .0625em;
    -webkit-border-radius: 2.25em;
    border-radius: 2.25em;
}

.ui-icon-loading {
    background: url("https://demos.jquerymobile.com/1.4.2/css/themes/default/images/ajax-loader.gif");
    background-size: 2.875em 2.875em;
}

/*
.csarprlo ul.products li:hover .product-thum {
    display: none !important;
}

.csarprlo ul.products li:hover .hover-image_prod {
    display: block !important;
}
*/
.hover-image_prod {
    display: none;
}

.shop_section .treproc.csarprlo {
    padding: 0px !important;
}

.shop_container {
    display: grid;
    grid-template-columns: .7fr 1.3fr;
}

.shop_result {
    margin: auto;
    padding-right: 56px;
    padding-top: 100px;
}

#woof_results_by_ajax {
    max-width: 1140px;
}


.shop_section .desktop {
    max-width: 386px !important;
    width: 100%;
    background-color: #e4e0d6;

}

.mobile .woof {
    background-color: #e4e0d6;
}

.woof .woof_redraw_zone {
    width: 100%;
}

.woof .woof_checkbox_term:checked {
    background-color: #000;
}

.woof .woof_checkbox_term {
    width: 1.5em;
    height: 1.5em;
    border-radius: 50%;
    border: 1px solid #000 !important;
}

.woof_block_html_items {
    margin-left: 40px;
}

.woof_submit_search_form_container {
    justify-content: center !important;
}

.button.woof_reset_search_form {
    width: 255px !important;

}

@media only screen and (max-width: 768px) {
    .button.woof_reset_search_form {
        width: 100% !important;
        margin-left: 0px;
    }
}

.desktop .woof_container_inner.woof_container_inner_filterproducts h4 {
    padding-top: 73px !important;
    padding-left: 61px !important;
}

.footer_desktop .TERM-postcode:hover {
    color: #A4866C;
}

.woof .woof_checkbox_term:checked {
    background-image: url("https://sprattmortgages.com.au/wp-content/uploads/2021/08/thik.png");
    background-repeat: no-repeat;
    background-position: center;
    object-fit: cover;
    background-size: 64%;
    background-repeat: no-repeat;
    background-position: center;
    transform: none;
    transition: none;
}

.product_cat-combo-boxes:hover .product-thum {
    display: none;
}

.product_cat-combo-boxes:hover .hover-image_prod {
    display: block;
}

.hover-image_prod {
    display: none;
}

.product_cat-raw-meals:hover .product-thum {
    display: none;

}

.product_cat-raw-meals:hover .hover-image_prod {
    display: block;

}

.filter_float {
    display: flex;
    justify-content: center;
}

.filter_float_box {
    text-align: center;
    margin-right: auto;
    margin-left: auto;
}

.filter_float_box img {
    margin: auto;
}

.filter_float_box button {
    background-color: #A4866C;
    padding: 10px 45px;
    color: #fff;
}

.filter_float_box img {
    width: 50px;
}

.filter_float_box p {
    width: 200px;
    margin-top: 10px;
    font-family: 'Special Elite', cursive;
    margin-right: auto;
    margin-left: auto;
}

.filter_float_box {
    background-color: #fff;
    padding: 15px 0px;
    width: 255px;
}

.footer_details {
    color: #fff;
}

#footer_cart_count {
    position: unset !important;
    display: flex !important;
    align-items: center;
}

.footer_cart_item {
    display: flex;
    align-items: center;
}

#footer_cart_count span {
    width: 176px;
}

#fo_cart_item .woo_amc_footer_total {
    width: 150px;
    padding-left: 10px;
}

#fo_cart_item .woo_amc_footer_total {
    width: 68px !important;
}

#fo_cart_item #footer_cart_count {
    width: 30px !important;
}

@media only screen and (max-width: 768px) {
    .sticky_cart {
        display: block;
        text-align: center;
        margin: auto;
    }

    .footer_left {
        display: block;
        width: 100%;
        text-align: center;
    }

    .footer_mini_cart {
        margin-right: auto;
        margin-left: auto;
        width: 356px;
    }

    .footer_mobile {
        display: block !important;
        margin-top: 10px;
    }

    .footer_desktop {
        display: none;
    }

    .footer_left {
        width: 100% !important;
    }

    .sticky_footer_cart {
        height: 138px !important;
        padding-top: 6px;
    }

    .sticky_cart {
        display: block !important;
    }

    woof .button.woof_reset_search_form {
        width: 100% !important;
        margin-left: 0px !important;
    }

    .btn_btt.desktop {
        display: none;
    }

    .btn_btt.mobile {
        display: block !important;
        float: right;
    }
}

.footer_mobile {
    display: none;
}

.btn_btt.mobile {
    display: none;
}

#hover_images {
    position: relative;
}

.overlay {
    position: absolute;
    width: 100%;
    height: 100%;
    top: 0px;
    background-color: rgba(0, 0, 0, 0.41);
    z-index: 1;
}

.new_sub_button ins {
    text-decoration: none !important;
}

@media only screen and (max-width: 400px) and (min-width: 320px) {
    #fo_cart_item span {
        font-size: 14px !important;
    }

    .radio-custom-labelc.of {
        text-align: left;
    }

    .radio-custom-labelc {
        text-align: left !important;
    }

    .footer_mini_cart {
        width: auto !important;
    }

    .footer_cart_btn {
        font-size: 14px !important;
    }

    #fo_cart_item #footer_cart_count {
        width: 20px !important;
    }

    .footer_cart_item {
        padding: 10px 5px !important;
    }

    .off-purchase .new_price {
        padding-right: 12px;
    }

    .check-filter .common-label label {
        padding-left: 35px !important;
    }

    .mx-auto.subscribe-tps.w-3\/4 .new_sub_button {
        padding-right: 12px !important;
    }

    .woocommerce ul.products[class*="columns-"] li.product,
    .woocommerce-page ul.products[class*="columns-"] li.product {
        width: 50% !important;
    }

    .choose-fequancy input.radio-customc:checked+.radio-custom-labelc::after,
    .radio-custom-labelc::before {
        left: 5px !important;
    }

    .check-filter .common-label label {
        padding-left: 35px !important;
    }

    .mx-auto.subscribe-tps.w-3\/4 {
        padding: 0 10px !important;
    }

    .off-purchase {
        padding: 0 10px !important;
    }

    .woof .woof_redraw_zone .woof_block_html_items {
        padding-left: 20px !important;
    }

    .woof_list.woof_list_checkbox label {
        font-size: 14px !important !important;
    }

    .woof .woof_redraw_zone .woof_block_html_items label {
        padding-left: 0px !important;
    }


}

.filter_float {
    margin-top: 120px;
}
</style>

<section class="shop-page-outer" id="topback">
    <section class="shop-banner-tps">
        <div class="container">
            <div class="tps-text-shop">
                <h2>shop the range</h2>
                <p>The most important health decision you can make for your dog is what you put in their bowl.</p>
            </div>
        </div>
    </section>



    <div class="c_b csarprlo">
        <div class="container">
            <?php //echo do_shortcode('[products category="build-a-box, combo-boxes" orderby="date" order="ASC" columns="4"]');?>
        </div>
    </div>
    <section class="shop_section">
        <div class="treproc csarprlo">
            <div class="shop_container">
                <div class="desktop"><?php echo do_shortcode( '[woof]' ); ?>
                    <div class="filter_float">
                        <div class="filter_float_box">
                            <img src="<?php echo get_site_url();?>/wp-content/themes/Blutcher/assets/images/food-cal.png"
                                alt="">
                            <p>Unsure how much to feed?</p><br>
                            <button onclick="modelCalOpen()">Food Calculator</button>
                        </div>
                    </div>
                </div>
                <div class="mobile"><?php echo do_shortcode( '[woof]' ); ?></div>
                <?php //echo do_shortcode('[product_table category="combo-boxes,raw-meals,treats" lazy_load=false sort_by="menu_order" filters="categories" is_ajax="1"]'); ?>
                <?php //echo do_shortcode( '[woof_products per_page="12" columns="3" is_ajax="1" tpl_index="tpl_woo_table"]' ); ?>
                <div class="shop_result">
                    <?php $is_oos_last = true; ?>
                    <?php echo do_shortcode( '[woof_products per_page="12" columns="3" is_ajax="1"]' ); ?>
                    <?php $is_oos_last = false; ?>
                    <section class="apse-box">
                        <div class="container">
                            <div class="inner-apse">
                                <div class="left-aesp apse-common">
                                    <h2>APOTHECARY</h2>
                                    <p>Adored Beast Apothecary is a line of all-natural
                                        pet products designed to support your dog’s
                                        health inside and out. Imported from Canada.</p>
                                    <a href="<?php echo get_site_url();?>/shop-2/?swoof=1&product_cat=apothecary">Add to
                                        order</a>
                                </div>
                                <div class="right-aesp apse-common">
                                    <h2>BLOG</h2>
                                    <p> Alongside delivering raw food we like providing a dose of inspiring and
                                        informative content to our passionate community of dog lovers!</p>
                                    <a href="<?php echo get_site_url();?>/blog/">Blog</a>
                                </div>
                            </div>
                        </div>

                    </section>
                </div>
            </div>
        </div>
    </section>

</section>
<div class="sticky_footer_cart">
    <div class="footer-con">
        <div class="sticky_cart">
            <div class="footer_left">
                <div class="footer_desktop">
                    <p class="footer_details">CHECK WE DELIVER TO YOUR AREA*</p>
                    <a href="/delivery-shipping" class="TERM-postcode">Delivery & Shipping Information</a>
                </div>
                <div class="footer_mini_cart">
                    <?php global $woocommerce; ?>
                    <a class="footer_cart_item" id="fo_cart_item" href="#">
                        <div class="woo_amc_open_count" id="footer_cart_count"><?php echo $cart_count; ?>
                            <?php echo ($woocommerce->cart->cart_contents_count);?></div>




                        <span>Items on your box</span>
                        <div class="woo_amc_footer_total">
                            <div class="woo_amc_value"><?php echo $cart_total; ?> <?php echo WC()->cart->get_total(); ?>
                            </div>
                        </div>


                    </a>
                    <button class="footer_cart_btn">Go to cart</button>


                </div>
            </div>
            <div class="footer_mobile">
                <p class="footer_details">CHECK WE DELIVER TO YOUR AREA</p>
                <a href="/delivery-shipping" class="TERM-postcode">*Delivery & Shipping Information</a>
                <button id="btn_btt" class="btn_btt mobile" onclick="topFunction();"></button>
            </div>
            <button id="btn_btt" class="btn_btt desktop" onclick="topFunction();">BACK TO TOP</button>

        </div>
    </div>
</div>

<div class="bg-color-sup">
    <div class="subscribe-sec container">
        <div class="subtitle">SUPPORT</div>
        <div class="subs-heading">Unsure where to start?<br>
            <span>Speak to our Nutritionist about the best diet for your puppy or dog.</span>
        </div>
        <a href="<?php echo get_site_url();?>/contact/"><input type="button" value="Contact Us"></a>


    </div>
</div>
<script>
jQuery('#checkpin').click(function() {
    var bla = jQuery('#pincode_field_id').val();
    const array1 = [2000, 2007, 2008, 2009, 2010, 2011, 2012, 2015, 2016, 2017, 2018, 2019, 2020, 2021, 2022,
        2023, 2024, 2025, 2026, 2027, 2028, 2029, 2030, 2031, 2032, 2033, 2034, 2035, 2036, 2037, 2038,
        2039, 2040, 2041, 2042, 2043, 2044, 2045, 2046, 2047, 2048, 2049, 2050, 2060, 2061, 2062, 2063,
        2064, 2065, 2066, 2067, 2068, 2069, 2070, 2071, 2072, 2073, 2074, 2075, 2076, 2077, 2079, 2080,
        2081, 2082, 2083, 2084, 2085, 2086, 2087, 2088, 2089, 2090, 2092, 2093, 2094, 2095, 2096, 2097,
        2099, 2100, 2101, 2102, 2103, 2104, 2105, 2106, 2107, 2108, 2110, 2111, 2112, 2113, 2114, 2115,
        2116, 2117, 2118, 2119, 2120, 2121, 2122, 2125, 2126, 2127, 2128, 2129, 2130, 2131, 2132, 2133,
        2134, 2135, 2136, 2137, 2138, 2140, 2141, 2142, 2143, 2144, 2145, 2146, 2147, 2148, 2150, 2151,
        2152, 2153, 2154, 2155, 2156, 2157, 2158, 2159, 2160, 2161, 2162, 2163, 2164, 2165, 2166, 2167,
        2168, 2170, 2171, 2173, 2175, 2176, 2177, 2178, 2179, 2190, 2191, 2192, 2193, 2194, 2195, 2196,
        2197, 2198, 2199, 2200, 2203, 2204, 2205, 2206, 2207, 2208, 2209, 2210, 2211, 2212, 2213, 2214,
        2216, 2217, 2218, 2219, 2220, 2221, 2222, 2223, 2224, 2225, 2226, 2227, 2228, 2229, 2230, 2231,
        2232, 2233, 2234, 2250, 2251, 2256, 2257, 2258, 2259, 2260, 2261, 2262, 2263, 2264, 2267, 2278,
        2280, 2281, 2282, 2283, 2284, 2285, 2286, 2287, 2289, 2290, 2291, 2292, 2293, 2294, 2295, 2296,
        2297, 2298, 2299, 2300, 2302, 2303, 2304, 2305, 2306, 2307, 2308, 2318, 2322, 2500, 2502, 2505,
        2506, 2508, 2515, 2516, 2517, 2518, 2519, 2525, 2526, 2527, 2528, 2529, 2530, 2533, 2534, 2535,
        2540, 2541, 2555, 2556, 2557, 2558, 2559, 2560, 2563, 2564, 2565, 2566, 2567, 2568, 2569, 2570,
        2571, 2572, 2573, 2574, 2575, 2576, 2577, 2579, 2580, 2600, 2601, 2602, 2603, 2604, 2605, 2606,
        2607, 2609, 2611, 2612, 2614, 2615, 2617, 2619, 2620, 2745, 2747, 2748, 2749, 2750, 2752, 2753,
        2754, 2756, 2757, 2758, 2759, 2760, 2761, 2762, 2763, 2765, 2766, 2767, 2768, 2769, 2770, 2773,
        2774, 2776, 2777, 2778, 2779, 2780, 2782, 2783, 2784, 2900, 2902, 2903, 2904, 2905, 2906, 2911,
        2913, 2914
    ];
    const found = array1.find(element => element == bla);
    if (!found) {
        jQuery('.c_b').css('display', 'none');
        jQuery('.filter-item:nth-child(3)').css('display', 'none');
        jQuery('.filter-item:nth-child(2)').css('display', 'none');
    }
});

jQuery(document).on('click', '.category-filter', function() {
    var clickedOption = jQuery(this).attr('data-slug');
    jQuery('select[name="wcpt_filter_product_cat"]').val(clickedOption).trigger('change');
    jQuery("ul.category-filter-parent li.rawmeals").removeClass("active");
    jQuery("ul.category-filter-parent li.comboboxa").removeClass("active");
    jQuery("ul.category-filter-parent li.treatsa").removeClass("active");
    jQuery(this).parent().addClass('active');
});

jQuery(document).ready(function() {
    jQuery('.wc-product-table-select-filters').hide();
});

jQuery(document).ready(function() {

    jQuery('.seco-box-ac').css("display", "none");
    /*$('.wcsatt-options-product').css("display", "none");*/
    jQuery(".off-purchase .radio-customc").click(function() {
        jQuery('.oneoffstate').css("display", "flex");
        jQuery('.subsstate').css("display", "none");
        jQuery('.nrmlstate').css("display", "none");
        jQuery(".wcsatt-options-product .one-time-option").css("display", "block");
        jQuery(".wcsatt-options-product .one-time-option input[type='radio']").prop('checked', true);
    });
    jQuery(".subscribe-tps .radio-customc").click(function() {
        jQuery('.oneoffstate').css("display", "none");
        jQuery('.subsstate').css("display", "flex");
        jQuery('.nrmlstate').css("display", "none");
        jQuery(".wcsatt-options-product .one-time-option").css("display", "none");
        jQuery(".wcsatt-options-product .one-time-option input[type='radio']").prop('checked', false);
    });
});
</script>



<style>
.sticky_footer_cart {
    width: 100%;
    height: 80px;
    background-color: #717171;
    position: -webkit-sticky;
    position: sticky;
    bottom: 0;
}

div#sticky-buy-now-dock {
    display: block !important;
}

ul.filter-items.filter-text.level-0 li:first-child {
    display: none;
}

ul.filter-items.filter-text.level-0 li:nth-child(3) {
    display: none;
}

small.wcsatt-sub-options {
    display: none;
}

span.wcsatt-sub-discount {
    display: none;
}

p.afterpay-payment-info {
    display: none;
}

.babtitle {
    display: none;
}

.wcsatt-options-product {
    display: none;

}

td.dataTables_empty {
    display: none !important;
}

#sticky-buy-now-dock-pages #sticky_cart_item {
    display: flex;
    align-items: center;
    justify-content: space-between
}

.custom_linesticky {
    width: 100%;
    flex-basis: 100%;
    max-width: 30%
}

.stickybtncs {
    width: 100%;
    flex-basis: 100%;
    max-width: 28%;
    display: flex;
    align-items: center;
    background-color: black;
    min-height: 40px;
    justify-content: space-around;
    position: relative
}

#sticky-buy-now-dock-pages .sticky_show_cart {
    background-color: transparent !important;
    color: #a4866c !important;
    padding: 0;
    font-size: 16px
}

#sticky-buy-now-dock-pages .item_name span {
    color: #fff
}

#sticky-buy-now-dock-pages .item_name {
    font-size: 16px !important;
    font-weight: 400;
    width: auto
}

#sticky-buy-now-dock-pages .sticky_show_cart:hover {
    background-color: transparent !important;
    color: #a4866c !important
}

#sticky-buy-now-dock-pages .sticky_cart_btn {
    width: auto;
    position: relative
}

#sticky-buy-now-dock-pages .sticky_cart_btn:before {
    content: "|";
    position: absolute;
    left: -10px;
    transform: translate(-50%, -50%);
    line-height: normal;
    top: 45%;
    color: #a4866c;
    font-weight: 700
}

.backsticky {
    width: 100%;
    flex-basis: 100%;
    max-width: 30%
}

.backsticky i {
    padding: 0 0 0 10px
}

#sticky-buy-now-dock-pages {
    background-color: #666666
}


@media(max-width:767px) {
    .backsticky {
        font-size: 0;
        max-width: 5%
    }

    .backsticky i {
        font-size: 16px
    }

}

@media(min-width:499px) and (max-width:767px) {
    .stickybtncs {
        max-width: 60%
    }

}

@media(max-width:499px) {
    .stickybtncs {
        position: absolute;
        top: 20px;
        max-width: 90%;
        left: 50%;
        transform: translateX(-50%)
    }

    .custom_linesticky {
        max-width: 90%
    }

    .backsticky {
        max-width: 10%
    }

    #sticky-buy-now-dock-pages #sticky_cart_item {
        padding: 60px 0 0
    }

}

@media(min-width:768px) and (max-width:991px) {
    .stickybtncs {
        max-width: 40%
    }

    .backsticky {
        max-width: 20%
    }

    .custom_linesticky {
        max-width: 40%;
        padding: 0 12px 0 0
    }

}

.fixed {
    position: fixed;
    z-index: 999;
    top: 80px;
}

/* CSS */

.soldout {
    padding: 3px 8px;
    text-align: center;
    background: #af1600;
    color: white;
    font-weight: bold;
    position: absolute;
    top: 6px;
    right: 6px;
    font-size: 12px;
}

a.added_to_cart.wc-forward {
    display: none;
}

html {
    overflow-x: hidden;
    scroll-behavior: smooth
}

body {
    scroll-behavior: smooth;
    overflow-x: initial;
}

section.delivery-filter {
    position: sticky;
    top: 80px;
    z-index: 99999;
}

@media (min-width:801px) {
    .single-pro-acc.seco-box-ac {
        display: none;
    }
}

@media (min-width:1025px) {
    .single-pro-acc.seco-box-ac {
        display: none;
    }
}

@media (min-width:1281px) {
    .single-pro-acc.seco-box-ac {
        display: none;
    }
}

.footer-con {
    margin-right: auto;
    max-width: 1440px;
    margin-left: auto;
}

.sticky_cart {
    display: flex;
    justify-content: space-between;
    padding: 15px 5px;
}

/*
.sticky_footer_cart {
    display: none;
}
*/
.sticky_footer_show {
    display: block !important;
}


.btn_btt {
    align-content: center;
    display: flex;
    align-items: center;
}

#btn_btt {
    color: #fff;
}

#btn_btt:after {
    background-image: url('/wp-content/uploads/2022/09/down-arrow-black1.png');
    background-size: 74%;
    display: inline-block;
    width: 24px;
    height: 10px;
    content: "";
    padding-left: 15px;
    -webkit-transform: rotate(180deg);
    -moz-transform: rotate(180deg);
    -o-transform: rotate(180deg);
    background-repeat: no-repeat;
}

#btn_btt:hover {
    background-color: #717171;
}

.footer_left {
    display: flex;
    justify-content: space-around;
    width: 80%;
}

.footer_left div {
    text-align: center;
}

.footer_mini_cart a:hover {
    color: #fff;
}

.footer_mini_cart {
    display: flex;
    align-items: center;
}

.footer_cart_item {
    background-color: #000;
    padding: 10px 15px;
    color: #fff;
    text-decoration: none;
}

.footer_cart_item:hover {
    text-decoration: none;
}

.footer_cart_btn {
    background-color: #A4866C;
    padding: 10px 15px;
}
</style>

<script>



</script>

<?php
get_footer();
?>