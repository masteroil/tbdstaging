<?php
/**
 * Product quantity inputs
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/global/quantity-input.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 4.0.0
 */

defined( 'ABSPATH' ) || exit;
global $product;
if( $_GET['test'] == 1) {
    // WC()->cart->get_cart()
    // input_name
    // c472d4419161e56b79d0aff9fdf463b8
    var_dump($args['input_name']); exit;
}
if ( $max_value && $min_value === $max_value ) {
	?>
	<div class="quantity hidden">
		<input type="hidden" id="<?php echo esc_attr( $input_id ); ?>" class="qty" name="<?php echo esc_attr( $input_name ); ?>" value="<?php echo esc_attr( $min_value ); ?>" />
	</div>
    <span class="price" style="margin-top:8px;">
		<?php //echo $product->get_price_html();?> 
	</span>
	<?php
} else {
	/* translators: %s: Quantity. */
	$label = ! empty( $args['product_name'] ) ? sprintf( esc_html__( '%s quantity', 'woocommerce' ), wp_strip_all_tags( $args['product_name'] ) ) : esc_html__( 'Quantity', 'woocommerce' );
	?>

  <?php if( is_product_category() || is_shop() ) { ?>
  <?php if ( function_exists( 'wc_yotpo_show_buttomline_blaze' ) ) { wc_yotpo_show_buttomline_blaze(); } ?>
	<span class="price test" style="margin-top:8px;">
		<?php //echo $product->get_price_html();?>
	</span>
	<?php } ?>
	<div class="quantity">
        <!-- <span class="cuspriqu"><?php // echo $product->get_price_html(); ?></span> -->
        <span class="quantity-box">
    <label class="screen-reader-text" for="<?php echo esc_attr( $input_id ); ?>"><?php esc_html_e( '', 'woocommerce' ); ?></label>
    <input type="button" value="-" class="qty_button minus" />
    <input
        type="number"
        data-productID="<?php // echo $product->get_id(); ?>"
        id="<?php echo esc_attr( $input_id ); ?>"
        class="input-text qty text"
        step="<?php echo esc_attr( $step ); ?>"
        min="<?php echo esc_attr( $min_value ); ?>"
        max="<?php echo esc_attr( 0 < $max_value ? $max_value : '' ); ?>"
        name="<?php echo esc_attr( $input_name ); ?>"
        value="<?php echo esc_attr( $input_value ); ?>"
        title="<?php echo esc_attr_x( 'Qty', 'Product quantity input tooltip', 'woocommerce' ); ?>"
        size="4"
        pattern="<?php echo esc_attr( $pattern ); ?>"
        inputmode="<?php echo esc_attr( $inputmode ); ?>"
        aria-labelledby="<?php echo esc_attr( $labelledby ); ?>" />
    <input type="button" value="+" class="qty_button plus" />
</span>
</div>
<style>
small.wcsatt-sub-options {
    display: none;
}
span.wcsatt-sub-discount {
    display: none;
}</style>
	<?php
}?>
<p class="babtitle"><?php  the_title(); ?></p>
<?php if(!is_product_category() && !is_shop() ){ ?>
<?php if ( function_exists( 'wc_yotpo_show_buttomline_blaze' ) ) { wc_yotpo_show_buttomline_blaze(); } ?>
<?php } ?>
