/* global wcsatt_admin_params */
/**
 * This is JG Toolbox Add To Subscription - Simple product script.
 * It is added to single product page for the add to existing subscription feature.
 */

(function($, window, document, undefined) {
	$(function() {

		let quantity = $('.quantity input.qty');

		if ( quantity.length === 0 ){
			quantity = $('.quantity input' );
		}
		let toForm = $('.jgtb-add-to-subscription');
		let toQuantity = toForm.find('input[name="ats_quantity"]');
		let button = toForm.find('button');
		let subscriptionList = toForm.find('#jgtb_add_to_existing');

		subscriptionList.on('change', function() {
			let val = $(this).find(':selected').val();

			if(val === 'null') {
				button.attr('disabled', 'disabled');
			} else if ( val !== 'null') {
				button.removeAttr('disabled');
			}
		});

		quantity.on('change', function() {
			toQuantity.val(quantity.val());
		});

		toQuantity.val(quantity.val());
	});
}(window.jQuery, window, document));
