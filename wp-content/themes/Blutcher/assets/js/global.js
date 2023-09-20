/*Single Product postcode popup*/ 
(function($){
	console.log('window.location.pathname', window.location.pathname);
	if(window.location.pathname.indexOf('product') >= 0){
	  $(document).on('click', '#checkpin', function(e){
		e.preventDefault();
		var postcode_ = $(this).parents('#pincode_field_idp').find('#pincode_field_id').val();
		const pincodes_ = [2000, 2007, 2008, 2009, 2010, 2011, 2012, 2015, 2016, 2017, 2018, 2019, 2020, 2021, 2022,
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
		const exist_pincode = pincodes_.find(element => element == postcode_);

		
		if(exist_pincode){ 
			var _this = this;
			var rdata = {
			action: 'picodecheck_ajax_submit',
			// pin_code: $(this).parents('#pincode_field_idp').find('#pincode_field_id').val(),
			pin_code:exist_pincode,
			product_id: $('#phoen_product_id').val()
			};
			if (window.wc_ga_pro && window.wc_ga_pro.ajax_url) {
			$.post(window.wc_ga_pro.ajax_url, rdata, function(res){
			console.log('res', res);
			if(res == '0' || res == 0){
				$(_this).parents('.pc-popup-modal').find('#error_pin').show();
				$(_this).parents('.pc-popup-modal').find('#post_code_area').html(rdata.pin_code);
			}
			else{
				$(_this).parents('.pc-popup-modal').find('#error_pin').hide();
				$(_this).parents('.pc-popup-modal').find('#post_code_area').html('');
				$('.pc-popup.open .pc-popup-overlay').click();
				window.location = window.location.href;
			}
			});
}
		}
		else{
			$(this).parents('.pc-popup-modal').find('#error_pin').show();
			$(this).parents('.pc-popup-modal').find('#post_code_area').html(postcode_);
		}
	  });
	  $(document).on('click', '#change_pin', function(e){
		e.preventDefault();
		$('.pc-popup.open #avlpin').hide();
		$('.pc-popup.open #my_custom_checkout_field2')
		.show()
		.after('<div class="post-c-add">\
		  <div id="post-p">\
			  <p class="bold-p">Sydney CBD &amp; Metro</p>\
			  <p class="light-p">We deliver your order within 72 hours Monday through Friday*</p>\
		  </div>\
		  <div id="post-p">\
			  <p class="bold-p">Regional NSW</p>\
			  <p class="light-p">Review our Delivery Service Area chart for delivery days</p>\
		  </div>\
		  <div id="post-p">\
			  <p class="bold-p">Melbourne CBD &amp; Metro</p>\
			  <p class="light-p">Orders must be made by 5:00pm Friday for Thursday delivery</p>\
		  </div>\
		  <div class="postc-links">\
			  <a class="TERM-postcode" href="https://app-638030a3c1ac189bf80eeac3.closte.com/delivery-shipping/">*Delivery &amp; Shipping\
				  Conditions apply</a>\
		  </div>\
	  </div>');
	  });
	}
  })(jQuery);


/* global twentyseventeenScreenReaderText */
(function( $ ) {

	// Variables and DOM Caching.
	var $body = $( 'body' ),
		$customHeader = $body.find( '.custom-header' ),
		$branding = $customHeader.find( '.site-branding' ),
		$navigation = $body.find( '.navigation-top' ),
		$navWrap = $navigation.find( '.wrap' ),
		$navMenuItem = $navigation.find( '.menu-item' ),
		$menuToggle = $navigation.find( '.menu-toggle' ),
		$menuScrollDown = $body.find( '.menu-scroll-down' ),
		$sidebar = $body.find( '#secondary' ),
		$entryContent = $body.find( '.entry-content' ),
		$formatQuote = $body.find( '.format-quote blockquote' ),
		isFrontPage = $body.hasClass( 'twentyseventeen-front-page' ) || $body.hasClass( 'home blog' ),
		navigationFixedClass = 'site-navigation-fixed',
		navigationHeight,
		navigationOuterHeight,
		navPadding,
		navMenuItemHeight,
		idealNavHeight,
		navIsNotTooTall,
		headerOffset,
		menuTop = 0,
		resizeTimer;

	// Ensure the sticky navigation doesn't cover current focused links.
	$( 'a[href], area[href], input:not([disabled]), select:not([disabled]), textarea:not([disabled]), button:not([disabled]), iframe, object, embed, [tabindex], [contenteditable]', '.site-content-contain' ).filter( ':visible' ).focus( function() {
		if ( $navigation.hasClass( 'site-navigation-fixed' ) ) {
			var windowScrollTop = $( window ).scrollTop(),
				fixedNavHeight = $navigation.height(),
				itemScrollTop = $( this ).offset().top,
				offsetDiff = itemScrollTop - windowScrollTop;

			// Account for Admin bar.
			if ( $( '#wpadminbar' ).length ) {
				offsetDiff -= $( '#wpadminbar' ).height();
			}

			if ( offsetDiff < fixedNavHeight ) {
				$( window ).scrollTo( itemScrollTop - ( fixedNavHeight + 50 ), 0 );
			}
		}
	});

	// Set properties of navigation.
	function setNavProps() {
		navigationHeight      = $navigation.height();
		navigationOuterHeight = $navigation.outerHeight();
		navPadding            = parseFloat( $navWrap.css( 'padding-top' ) ) * 2;
		navMenuItemHeight     = $navMenuItem.outerHeight() * 2;
		idealNavHeight        = navPadding + navMenuItemHeight;
		navIsNotTooTall       = navigationHeight <= idealNavHeight;
	}

	// Make navigation 'stick'.
	function adjustScrollClass() {

		// Make sure we're not on a mobile screen.
		if ( 'none' === $menuToggle.css( 'display' ) ) {

			// Make sure the nav isn't taller than two rows.
			if ( navIsNotTooTall ) {

				// When there's a custom header image or video, the header offset includes the height of the navigation.
				if ( isFrontPage && ( $body.hasClass( 'has-header-image' ) || $body.hasClass( 'has-header-video' ) ) ) {
					headerOffset = $customHeader.innerHeight() - navigationOuterHeight;
				} else {
					headerOffset = $customHeader.innerHeight();
				}

				// If the scroll is more than the custom header, set the fixed class.
				if ( $( window ).scrollTop() >= headerOffset ) {
					$navigation.addClass( navigationFixedClass );
				} else {
					$navigation.removeClass( navigationFixedClass );
				}

			} else {

				// Remove 'fixed' class if nav is taller than two rows.
				$navigation.removeClass( navigationFixedClass );
			}
		}
	}

	// Set margins of branding in header.
	function adjustHeaderHeight() {
		if ( 'none' === $menuToggle.css( 'display' ) ) {

			// The margin should be applied to different elements on front-page or home vs interior pages.
			if ( isFrontPage ) {
				$branding.css( 'margin-bottom', navigationOuterHeight );
			} else {
				$customHeader.css( 'margin-bottom', navigationOuterHeight );
			}

		} else {
			$customHeader.css( 'margin-bottom', '0' );
			$branding.css( 'margin-bottom', '0' );
		}
	}

	// Set icon for quotes.
	function setQuotesIcon() {
		$( twentyseventeenScreenReaderText.quote ).prependTo( $formatQuote );
	}

	// Add 'below-entry-meta' class to elements.
	function belowEntryMetaClass( param ) {
		var sidebarPos, sidebarPosBottom;

		if ( ! $body.hasClass( 'has-sidebar' ) || (
			$body.hasClass( 'search' ) ||
			$body.hasClass( 'single-attachment' ) ||
			$body.hasClass( 'error404' ) ||
			$body.hasClass( 'twentyseventeen-front-page' )
		) ) {
			return;
		}

		sidebarPos       = $sidebar.offset();
		sidebarPosBottom = sidebarPos.top + ( $sidebar.height() + 28 );

		$entryContent.find( param ).each( function() {
			var $element = $( this ),
				elementPos = $element.offset(),
				elementPosTop = elementPos.top;

			// Add 'below-entry-meta' to elements below the entry meta.
			if ( elementPosTop > sidebarPosBottom ) {
				$element.addClass( 'below-entry-meta' );
			} else {
				$element.removeClass( 'below-entry-meta' );
			}
		});
	}

	/*
	 * Test if inline SVGs are supported.
	 * @link https://github.com/Modernizr/Modernizr/
	 */
	function supportsInlineSVG() {
		var div = document.createElement( 'div' );
		div.innerHTML = '<svg/>';
		return 'http://www.w3.org/2000/svg' === ( 'undefined' !== typeof SVGRect && div.firstChild && div.firstChild.namespaceURI );
	}

	/**
	 * Test if an iOS device.
	*/
	function checkiOS() {
		return /iPad|iPhone|iPod/.test(navigator.userAgent) && ! window.MSStream;
	}

	/*
	 * Test if background-attachment: fixed is supported.
	 * @link http://stackoverflow.com/questions/14115080/detect-support-for-background-attachment-fixed
	 */
	function supportsFixedBackground() {
		var el = document.createElement('div'),
			isSupported;

		try {
			if ( ! ( 'backgroundAttachment' in el.style ) || checkiOS() ) {
				return false;
			}
			el.style.backgroundAttachment = 'fixed';
			isSupported = ( 'fixed' === el.style.backgroundAttachment );
			return isSupported;
		}
		catch (e) {
			return false;
		}
	}

	// Fire on document ready.
	$( document ).ready( function() {

		// If navigation menu is present on page, setNavProps and adjustScrollClass.
		if ( $navigation.length ) {
			setNavProps();
			adjustScrollClass();
		}

		// If 'Scroll Down' arrow in present on page, calculate scroll offset and bind an event handler to the click event.
		if ( $menuScrollDown.length ) {

			if ( $( 'body' ).hasClass( 'admin-bar' ) ) {
				menuTop -= 32;
			}
			if ( $( 'body' ).hasClass( 'blog' ) ) {
				menuTop -= 30; // The div for latest posts has no space above content, add some to account for this.
			}
			if ( ! $navigation.length ) {
				navigationOuterHeight = 0;
			}

			$menuScrollDown.click( function( e ) {
				e.preventDefault();
				$( window ).scrollTo( '#primary', {
					duration: 600,
					offset: { top: menuTop - navigationOuterHeight }
				});
			});
		}

		adjustHeaderHeight();
		setQuotesIcon();
		belowEntryMetaClass( 'blockquote.alignleft, blockquote.alignright' );
		if ( true === supportsInlineSVG() ) {
			document.documentElement.className = document.documentElement.className.replace( /(\s*)no-svg(\s*)/, '$1svg$2' );
		}

		if ( true === supportsFixedBackground() ) {
			document.documentElement.className += ' background-fixed';
		}
	});

	// If navigation menu is present on page, adjust it on scroll and screen resize.
	if ( $navigation.length ) {

		// On scroll, we want to stick/unstick the navigation.
		$( window ).on( 'scroll', function() {
			adjustScrollClass();
			adjustHeaderHeight();
		});

		// Also want to make sure the navigation is where it should be on resize.
		$( window ).resize( function() {
			setNavProps();
			setTimeout( adjustScrollClass, 500 );
		});
	}

	$( window ).resize( function() {
		clearTimeout( resizeTimer );
		resizeTimer = setTimeout( function() {
			belowEntryMetaClass( 'blockquote.alignleft, blockquote.alignright' );
		}, 300 );
		setTimeout( adjustHeaderHeight, 1000 );
	});

	// Add header video class after the video is loaded.
	$( document ).on( 'wp-custom-header-video-loaded', function() {
		$body.addClass( 'has-header-video' );
	});
  $(window).load(function(){
    if($('#collapse_reviews_heading').length){
      if(!$('#collapse_reviews_heading #collapse_reviews').hasClass('show')){
        $('#collapse_reviews_heading button').click();
      }
    }
  });
})







//prevent reloading the shope page
$('.nav-item a[href="#"]').click(function () {
    return false;
  });
//( jQuery );

/* $( document ).ajaxComplete(function(event, xhr, settings) {
	//if(settings.url.indexOf('wc-ajax=update_order_review')){
		//dito yung code the yotpo
	//}
	if (settings.data.indexOf('action=woof_draw_products&')>= 0){
		//alert(1);
		yotpo.refreshWidgets();
		//yotpo.init();
	}
	console.log(xhr);
	console.log(settings);
  }); */



jQuery(document).ready(function($) {
    if ($('body').hasClass('puppy-flow')) { // replace 'page-id-123' with your page's body class
        $(".single_add_to_cart_button").click(function() {
            $(".woo_amc_container_wrap_right").addClass("woo_amc_show");
            $(".woo_amc_bg").addClass("woo_amc_show");
        });
    }
});





  $('li.has-subscription-plans').on("tap",function(){
	$('.btn_prod').show();
  });
  $('select2-results__option').on("click",function(){
	$('.btn_prod').show();
  });
//   if($('.subs').is(':checked')){
// 	$('.btn_prod').show();
//   }
//   $('.select2-container').hasClass()
	// $('#select2-subscription-options-ju-container').on('DOMSubtreeModified', function(){
	// 	console.log('sadada');
	// 	$('.btn_prod').show();
	// });
	function blaze_radio_selected(el){
		let parentli = el.parents('li.has-subscription-plans');
		let subs = parentli.find('.radio-customc.subs:checked').length;
		let off = parentli.find('.radio-customc.off:checked').length;
		console.log(subs);
		console.log(off);
		if(subs || off){
			parentli.find('.btn_prod').addClass('show_btn_prod');
			parentli.css('box-shadow','0px 0px 10px rgb(0 0 0 / 25%)');
		}
		else{
			parentli.find('.btn_prod').removeClass('show_btn_prod');
			parentli.css('box-shadow','none');

		}

	}
	// $('.radio-customc.off').click(blaze_radio_selected(this));

	
	$('.radio-customc.subs').click(function(){
		blaze_radio_selected($(this));
	});
	$('.radio-customc.off').click(function(){
		blaze_radio_selected($(this));
	});
	$('#update_all_subscriptions_addresses').prop('checked', true); // checked checkbox in edit sub address


/*add scroll on puppy-floow*/
   function applyStylesBasedOnBrowserHeight() {
        const leftSecElements = document.querySelectorAll('.left-sec');
        const desktopViewElements = document.querySelectorAll('.desktop-view');
        const browserHeight = window.innerHeight;
		const browserWidth = window.innerWidth;

        // Check if the browser height is between 630 and 800
         if (browserHeight >= 630 && browserHeight <= 800 && browserWidth > 768) {
            // Add the custom class to .left-sec.aos-animate elements
            leftSecElements.forEach(element => {
                element.classList.add('change-to-scroll');
            });

            // Add the custom class to .desktop-view elements
            desktopViewElements.forEach(element => {
                element.classList.add('change-height');
            });
        } else {
            // Remove the custom class from .left-sec.aos-animate elements
            leftSecElements.forEach(element => {
                element.classList.remove('change-to-scroll');
            });

            // Remove the custom class from .desktop-view elements
            desktopViewElements.forEach(element => {
                element.classList.remove('change-height');
            });
        }
    }

    // Apply the styles when the page is loaded
    applyStylesBasedOnBrowserHeight();

    // Update styles when the browser window is resized
    window.addEventListener('resize', applyStylesBasedOnBrowserHeight);




( jQuery, yotpo );
