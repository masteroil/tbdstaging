<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
?>
<tr>
<td><input class="delevery_quantity" required type="number" min="1"  name="delevery_quantity[]" value="1" placeholder="<?php _e('Quantity(s)', 'woocommerce-product-addons'); ?>" /></td><td><input class="delevery_day" required type="number" min="1"  name="delevery_day[]" value="1" placeholder="<?php _e('Day(s)', 'woocommerce-product-addons'); ?>" /></td>
<td  class="actions" width="1%"><button type="button" class="remove_range button">x</button></td>
</tr>