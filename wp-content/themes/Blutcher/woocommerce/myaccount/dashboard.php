<?php
/**
 * My Account Dashboard
 *
 * Shows the first intro screen on the account dashboard.
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/myaccount/dashboard.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 4.4.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

$allowed_html = array(
	'a' => array(
		'href' => array(),
	),
);
?>
<meta name="googlebot" content="noindex">
<style>

.main-login-agin {
    width: 100%;
    padding: 40px 0px;
}
.agin-login-row {
    width: 100%;
    display: flex;
    padding: 40px 0px;
}
.agin-login-box {
    text-align: center;
    max-width: 115px;
    width: 115px;
    margin-right: 5px;
}
.agin-with-hovert {
    display: none;
}
.agin-login-box img {
    max-width: 30px;
    margin: auto;
    margin-bottom: 15px;
}
.agin-login-box span {
    color: #a4866c;
    font-size: 16px;
}
.agin-login-box a:hover {
    text-decoration: none;
}
.agin-login-box a:hover img.agin-whtout-hover {
    display: none;
}
.agin-login-box a:hover .agin-with-hovert {
    display: block;
}
.agin-order-row {
    width: 100%;
    display: flex;
    padding: 40px 0px;
}
.aing-box-order {
    text-align: center;
    max-width: 115px;
    width: 115px;
    margin-right: 5px;
}
.aing-box-order img {
    max-width: 30px;
    margin: auto;
    margin-bottom: 15px;
}
.aing-box-order .agin-with-hovert {
    display: none;
}
.aing-box-order a:hover {
    text-decoration: none;
}
.aing-box-order a:hover img.agin-whtout-hover {
    display: none;
}
.aing-box-order a:hover .agin-with-hovert {
    display: block;
}
.agin-login-box a:hover span, .aing-box-order a:hover span {
	color: #826852;
}
.aing-box-order span {
    color: #a4866c;
    font-size: 17px;
}
.agin-login-row .agin-login-box:last-child {
    margin-right: 0px;
}
.accout-of-new .woocommerce-MyAccount-content p a:hover {
    color: #826852;
}

	@media (max-width: 1300px) and (min-width: 1200px) {
	    .agin-login-box {
	        margin-right: 50px;
	    }
	    .aing-box-order {
	        margin-right: 50px;
	    }
	}
	@media (max-width: 1199px) and (min-width: 992px) {
		.agin-login-box {
	        margin-right: 10px;
	    }
	    .aing-box-order {
	        margin-right: 10px;
	    }
	}
	@media (max-width: 576px) {
		.agin-login-row, .agin-order-row {
	        display: inline-block;
	    }
	    .agin-login-box, .aing-box-order {
	        max-width: 100%;
	        width: 50%;
	        margin-right: 0;
	        float: left;
	        margin-bottom: 30px;
	    }
	    .agin-login-box span, .aing-box-order span {
		    display: block;
		    max-width: 113px;
		    margin: auto;
		}
    }
</style>

<div class="cover-sec">
<p class="name-kbs">
			<?php
			printf(
				/* translators: 1: user display name 2: logout url */
				wp_kses( __( 'Hello %1$s', 'woocommerce' ), $allowed_html ),
				'<strong>' . esc_html( $current_user->display_name ) . '</strong>',
				esc_url( wc_logout_url() )
			);
			?>
		</p>
<div class="dashbord-page">
	<div class="left-side-dash">
		
		<div class="main-login-agin">
			<p class="agin-pera-login up-date">Please keep your details up to date.</p>

			<div class="agin-login-row">
				<div class="agin-login-box">
					<a href="<?php echo get_site_url();?>/my-account/edit-account/">
						<img src="<?php echo get_site_url();?>/wp-content/themes/Blutcher/assets/images/login-TBD_Password.png" class="agin-whtout-hover">
						<img src="<?php echo get_site_url();?>/wp-content/themes/Blutcher/assets/images/login-TBD_Password_Hover.png" class="agin-with-hovert">
						<span>Change your password</span>
					</a>
				</div>
				<div class="agin-login-box">
					<a href="<?php echo get_site_url();?>/my-account/edit-account/">
						<img src="<?php echo get_site_url();?>/wp-content/themes/Blutcher/assets/images/login-TBD_Profile.png" class="agin-whtout-hover">
						<img src="<?php echo get_site_url();?>/wp-content/themes/Blutcher/assets/images/login-TBD_Profile_Hover.png" class="agin-with-hovert">
						<span>Update your profile</span>
					</a> 
				</div>
				<div class="agin-login-box">
					<a href="<?php echo get_site_url();?>/my-account/edit-address/">
						<img src="<?php echo get_site_url();?>/wp-content/themes/Blutcher/assets/images/login-TBD_Address.png" class="agin-whtout-hover">
						<img src="<?php echo get_site_url();?>/wp-content/themes/Blutcher/assets/images/login-TBD_Address_Hover.png" class="agin-with-hovert">
						<span>Check your address</span>
					</a>
				</div>
				<div class="agin-login-box">
					<a href="<?php echo get_site_url();?>/my-account/payment-methods/">
						<img src="<?php echo get_site_url();?>/wp-content/themes/Blutcher/assets/images/login-TBD_Payments.png" class="agin-whtout-hover">
						<img src="<?php echo get_site_url();?>/wp-content/themes/Blutcher/assets/images/login-TBD_Payments_Hover.png" class="agin-with-hovert">
						<span>Verify payment methods</span>
					</a>
				</div>
				<div class="agin-login-box">
					<a href="<?php echo get_site_url();?>/my-dogs/">
						<img src="<?php echo get_site_url();?>/wp-content/themes/Blutcher/assets/images/login-TBD_Dog.png" class="agin-whtout-hover">
						<img src="<?php echo get_site_url();?>/wp-content/themes/Blutcher/assets/images/login-TBD_Dog_Hover.png" class="agin-with-hovert">
						<span>Add your dog's details</span>
					</a>
				</div>
			</div>
			<p class="agin-pera-login up-date">Manage orders and subscriptions.</p>
			<div class="agin-order-row">
				<div class="aing-box-order">
					<a href="<?php echo get_site_url();?>/my-account/orders/">
						<img src="<?php echo get_site_url();?>/wp-content/themes/Blutcher/assets/images/login-TBD_Orders.png" class="agin-whtout-hover">
						<img src="<?php echo get_site_url();?>/wp-content/themes/Blutcher/assets/images/login-TBD_Orders_Hover.png" class="agin-with-hovert">
						<span>View your orders</span>
					</a>
				</div>
				<div class="aing-box-order">
					<a href="<?php echo get_site_url();?>/my-account/subscriptions/">
						<img src="<?php echo get_site_url();?>/wp-content/themes/Blutcher/assets/images/login-TBD_Subscriptions.png" class="agin-whtout-hover">
						<img src="<?php echo get_site_url();?>/wp-content/themes/Blutcher/assets/images/login-TBD_Subscriptions_Hover.png" class="agin-with-hovert">
						<span>Manage your subscriptions</span>
					</a>
				</div>
			</div>

			<!---p class="agin-pera-login"><b>REFER A FRIEND</b><br>Send a friend $25 Off any Combo Box, and you’ll get $25 credit too!*<a href="<?php echo get_site_url();?>/my-account/referral-link/"> Give a little. Get a little.</a></p>
		<br-->
			<p class="agin-pera-login">For technical support please email <a href="mailto:support@thebutchersdog.com.au">support@thebutchersdog.com.au</a></p>
		</div>
	</div>
	<div class="right-side-dash">
		<div class="inner-right-side">
			<div class="img-set">
				<img src="https://thebutchersdog.oxdigital.com.au/wp-content/themes/Blutcher/assets/images/product-pic.png">
			</div>
			<div class="text-frnd">
				<h1>REFER A FRIEND</h1>
				<p>Send a friend $25 Off any Combo Box, and you’ll get $25 credit too!*</p>
				<a href="<?php echo get_site_url();?>/my-account/referral-link/">Give a little. Get a little</a>
			</div>
		</div>
	</div>
</div>
</div>

 

<!-- <p>
	<?php
	/* translators: 1: Orders URL 2: Address URL 3: Account URL. */
	$dashboard_desc = __( 'From your account dashboard you can view your <a href="%1$s">recent orders</a>, manage your <a href="%2$s">billing address</a>, and <a href="%3$s">edit your password and account details</a>.', 'woocommerce' );
	if ( wc_shipping_enabled() ) {
		/* translators: 1: Orders URL 2: Addresses URL 3: Account URL. */
		$dashboard_desc = __( 'From your account dashboard you can view your <a href="%1$s">recent orders</a>, manage your <a href="%2$s">shipping and billing addresses</a>, and <a href="%3$s">edit your password and account details</a>.', 'woocommerce' );
	}
	printf(
		wp_kses( $dashboard_desc, $allowed_html ),
		esc_url( wc_get_endpoint_url( 'orders' ) ),
		esc_url( wc_get_endpoint_url( 'edit-address' ) ),
		esc_url( wc_get_endpoint_url( 'edit-account' ) )
	);
	?>
</p> -->

<?php
	/**
	 * My Account dashboard.
	 *
	 * @since 2.6.0
	 */
	do_action( 'woocommerce_account_dashboard' );

	/**
	 * Deprecated woocommerce_before_my_account action.
	 *
	 * @deprecated 2.6.0
	 */
	do_action( 'woocommerce_before_my_account' );

	/**
	 * Deprecated woocommerce_after_my_account action.
	 *
	 * @deprecated 2.6.0
	 */
	do_action( 'woocommerce_after_my_account' );

/* Omit closing PHP tag at the end of PHP files to avoid "headers already sent" issues. */

?>

