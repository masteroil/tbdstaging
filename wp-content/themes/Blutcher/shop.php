<?php
/* template name: shop */

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
</style>

<section class="shop-page-outer shop" id="topback">

    <a href="#" onClick="modelCalOpen();" class="float-box"><span><img
                src="<?php echo get_site_url();?>/wp-content/themes/Blutcher/assets/images/food-cal.png"
                alt=""></span><span>Food calculator</span></a>

    <section class="shop-banner-tps">
        <div class="container">
            <div class="tps-text-shop">
                <h2>shop the range</h2>
                <p>The most important health descision you can make for your dog is what you put in their bowl.</p>
            </div>
        </div>
    </section>

    <div class="c_b csarprlo">
        <div class="container">
            <?php //echo do_shortcode('[products category="build-a-box, combo-boxes" orderby="date" order="ASC" columns="4"]');?>
        </div>
    </div>
    <div class="treproc csarprlo">
        <div class="container">
            <div class="desktop"><?php echo do_shortcode( '[woof]' ); ?></div>
            <div class="mobile"><?php echo do_shortcode( '[woof]' ); ?></div>
            <?php //echo do_shortcode('[product_table category="combo-boxes,raw-meals,treats" lazy_load=false sort_by="menu_order" filters="categories" is_ajax="1"]'); ?>
            <?php //echo do_shortcode( '[woof_products per_page="12" columns="3" is_ajax="1" tpl_index="tpl_woo_table"]' ); ?>
            <?php $is_oos_last = true; ?>
            <?php echo do_shortcode( '[woof_products per_page="12" columns="3" is_ajax="1"]' ); ?>
            <?php $is_oos_last = false; ?>
        </div>
    </div>

    <section class="apse-box">
        <div class="container">
            <div class="inner-apse">
                <div class="left-aesp apse-common">
                    <h2>APOTHECARY</h2>
                    <p>Adored Beast Apothecary is a line of all-natural
                        pet products designed to support your dog’s
                        health inside and out. Imported from Canada.</p>
                    <a href="<?php echo get_site_url();?>/shop-2/?swoof=1&product_cat=apothecary">Add to order</a>
                </div>
                <div class="right-aesp apse-common">
                    <h2>SEALED STORAGE</h2>
                    <p>Our Sealed Storage Bowls have been custom
                        designed to be the perfect size for storing and
                        defrosting your dog’s meals in the fridge.</p>
                    <a href="<?php echo get_site_url();?>/product/build-a-box/sealed-storage-bowl/">Add to order</a>
                </div>
            </div>
        </div>

    </section>

</section>
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
</style>

<script>



</script>



<?php
get_footer();
?>