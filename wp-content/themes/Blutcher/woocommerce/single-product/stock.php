<?php
/**
 * Single Product stock.
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/stock.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 3.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

?>
<p class="stock <?php echo esc_attr( $class ); ?>"><?php echo wp_kses_post( $availability ); ?></p>

<?php if($class=='out-of-stock') {?>
<!-- Template for Out if stock item 19-07-22 By: Aizem -->
<?php echo '<p class="oostemplate">', $title = get_the_title($product->ID),' </p>';?>
<?php if( is_product() ){?>
<?php echo '<p class="oosreview">', wc_yotpo_show_buttomline(),'</p>'; ?>
<?php } ?>
<?php echo '<p class="oosprice">', $product->get_price_html(),' </p>';?>

<button class="btn-ofs">Out of stock</button>
<h5 class="ofs-note">Please check back and try this item soon</h5>
<?php }?>