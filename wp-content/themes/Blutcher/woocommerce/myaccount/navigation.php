<?php
/**
 * My Account navigation
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/myaccount/navigation.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 2.6.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
?>

			<?php
do_action( 'woocommerce_before_account_navigation' );
?>

<nav class="woocommerce-MyAccount-navigation">
	<div class="top-logo-righ">
		<a href="#"><img src="<?php echo get_site_url();?>/wp-content/uploads/2020/09/TBD_Portrait_Logo_White.png"></a>
	</div>

	<ul class="text-linek-desig">
		<li class="only-box-slide-point"><p class="toggle-acount"><img class="witout-onlick-erro" src="<?php echo get_site_url();?>/wp-content/themes/Blutcher/assets/images/DropDown-right-side.png"> <span class="all-acount-menu-link"></span></p></li>
		<?php foreach ( wc_get_account_menu_items() as $endpoint => $label ) : ?>
			<li class="<?php echo wc_get_account_menu_item_classes( $endpoint ); ?>">
				<a href="<?php echo esc_url( wc_get_account_endpoint_url( $endpoint ) ); ?>"><?php echo esc_html( $label ); ?></a>
			</li>
		<?php endforeach; ?>
	</ul>

	<div class="right-signout">
				<!-- <div class="top-sine-out-text">
					<ul class="text-linek-desig">
						<li><a href="#"><img class="no-hover-ii" src="https://thebutchersdog.oxdigital.com.au/wp-content/themes/Blutcher/assets/images/TBD_Login.png"><img class="on-hover-ii" src="https://thebutchersdog.oxdigital.com.au/wp-content/themes/Blutcher/assets/images/TBD_Login_Hover.png"> <span class="all-acount-menu-link">Sign out</span></a></li>
					</ul>
				</div> -->
				<div class="last-copy-right-side">
					<p>© The Butcher's Dog</p>
				</div>
			</div>
</nav>

<?php do_action( 'woocommerce_after_account_navigation' ); ?>
