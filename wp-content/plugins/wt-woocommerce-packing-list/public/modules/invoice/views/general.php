<?php
if (!defined('ABSPATH')) {
	exit;
}
?>
<div class="wf-tab-content" data-id="<?php echo $target_id;?>">
<p><?php _e('Configure the general settings required for the invoice.','wf-woocommerce-packing-list');?></p>
<table class="wf-form-table">
	<tbody>
		<tr valign="top" class="">
	        <th scope="row">
	        	<label for="">
	        		<?php echo __("Enable invoice",'wf-woocommerce-packing-list'); ?><?php echo Wf_Woocommerce_Packing_List_Admin::set_tooltip('woocommerce_wf_enable_invoice',$this->module_id); ?>
	        	</label>
	        </th>
	        <td>
				<div class="wf_pklist_dashboard_checkbox">
					<?php 
						$v = Wf_Woocommerce_Packing_List::get_option('woocommerce_wf_enable_invoice',$this->module_id);
					?>
					<input type="checkbox" value="Yes" name="woocommerce_wf_enable_invoice" <?php echo ($v=='Yes' ? 'checked' : '');?> class="wf_slide_switch wt_document_module_enable" id="woocommerce_wf_enable_invoice">	
				</div>
	        <td></td>
	    </tr>	
	<?php
	$tax_doc_url = 'https://www.webtoffee.com/add-tax-column-in-woocommerce-invoice/#tax-display-formats';
	$individual_tax_doc_url = 'https://www.webtoffee.com/add-tax-column-in-woocommerce-invoice/#customize-tax';
	Wf_Woocommerce_Packing_List_Admin::generate_form_field(array(
		array(
			'type'=>"checkbox",
			'label'=>__("Group products by 'Category'",'wf-woocommerce-packing-list'),
			'option_name'=>"wf_woocommerce_product_category_wise_splitting",
			'field_vl' => 'Yes',
			'help_text' => __('Enable to group the products based on a category in the invoice.','wf-woocommerce-packing-list')
		),
		array(
			'type'=>"radio",
			'label'=>__("Invoice date",'wf-woocommerce-packing-list'),
			'option_name'=>"woocommerce_wf_orderdate_as_invoicedate",
			'radio_fields'=>array(
				'Yes'=>__('Order date','wf-woocommerce-packing-list'),
				'No'=>__('Invoice created date','wf-woocommerce-packing-list')
			),
		),
		array(
			'type'=>"product_sort_by",
			'label'=>__("Sort products by", 'wf-woocommerce-packing-list'),
			'option_name'=>"sort_products_by",
			'help_text'=>__('Sort products in ascending/descending order based on Name or SKU','wf-woocommerce-packing-list')
		),
		array(
			'type'=>'order_st_multiselect',
			'label'=>__("Create invoice automatically",'wf-woocommerce-packing-list'),
			'option_name'=>"woocommerce_wf_generate_for_orderstatus",
			'help_text'=>__("Creates invoices for selected order statuses.",'wf-woocommerce-packing-list'),
			'order_statuses'=>$order_statuses,
			'field_vl'=>array_flip($order_statuses),
			'attr'=>'',
		),
		array(
			'type'=>"checkbox",
			'label'=>__("Attach invoice PDF in the order email",'wf-woocommerce-packing-list'),
			'option_name'=>"woocommerce_wf_add_".$this->module_base."_in_mail",
			'field_vl' => 'Yes',
			'help_text'=>__('Invoice in PDF format will be attached with the order email for chosen order statuses.','wf-woocommerce-packing-list'),		
		),
		array(
            'type' => 'print_button_checkbox',
            'label'=>__("Show print invoice button for customers",'wf-woocommerce-packing-list'),
            'option_name' => 'wf_woocommerce_invoice_show_print_button',
            'checkbox_fields' => array(
                'order_listing' => __('My account - Order lists page','wf-woocommerce-packing-list'),
                'order_details' => __('My account - Order details page', 'wf-woocommerce-packing-list'),
                'order_email' => __('Order email','wf-woocommerce-packing-list'),
            ),
            'module_base'=>$this->module_base,
        ),
		array(
			'type'=>"checkbox",
			'label'=>__("Show variation data below each product",'wf-woocommerce-packing-list'),
			'option_name'=>"woocommerce_wf_packinglist_variation_data",
			'field_vl' => 'Yes',
			'help_text' => __('Enable to display variation data of products beneath the product.','wf-woocommerce-packing-list')
		),
		array(
			'type'=>"multi_checkbox",
			'checkbox_id' => 'wt_pklist_total_tax_column_display_option',
			'label'=>__("'Total Tax' column display options", 'wf-woocommerce-packing-list'),
			'option_name'=>"wt_pklist_total_tax_column_display_option",
			'checkbox_fields'=>array(
				'amount'=>__('Amount', 'wf-woocommerce-packing-list'),
				'rate'=>__('Rate (%)', 'wf-woocommerce-packing-list'),
			),
			'checkbox_fields_condition'=>array(
				'amount' => array('amount'),
				'rate' => array('rate'),
				'amount-rate' => array('amount','rate'),
			),
			'help_text'=>sprintf(__("Choose %s how to display total tax column %s in the invoice", 'wf-woocommerce-packing-list'),'<a href="'.esc_url($tax_doc_url).'" target="_blank">', '</a>')
		),
		array(
			'type'=>"checkbox",
			'label'=>__("Show separate columns for each tax",'wf-woocommerce-packing-list'),
			'option_name'=>"wt_pklist_show_individual_tax_column",
			'field_vl' => 'Yes',
			'help_text'=>sprintf(__("Enable it to to display tax classes in separate columns.From 'Customize' tab choose a template that supports the individual tax column. %s Learn more. %s ",'wf-woocommerce-packing-list'),'<a href="'.esc_url($individual_tax_doc_url).'" target="_blank">', '</a>'),
			'form_toggler'=>array(
				'type'=>'parent',
				'target'=>'individual_tax_column',
			)
		),
		array(
			'type'=>"multi_checkbox",
			'label'=>__("'Tax' column display options", 'wf-woocommerce-packing-list'),
			'option_name'=>"wt_pklist_individual_tax_column_display_option",
			'checkbox_fields'=>array(
				'amount'=>__('Amount', 'wf-woocommerce-packing-list'),
				'rate'=>__('Rate (%)', 'wf-woocommerce-packing-list'),
				'separate-column'=>__('Separate columns for Rate (%) and Amount', 'wf-woocommerce-packing-list'),
			),
			'checkbox_fields_condition'=>array(
				'amount' => array('amount'),
				'rate' => array('rate'),
				'amount-rate' => array('amount','rate'),
				'separate-column' => array('separate-column'),
			),
			'checkbox_fields_condition_js' => array(
				'amount' => 'separate-column',
				'rate' => 'separate-column',
				'separate-column' => 'amount rate',
			),
			'help_text'=>__("Choose how to display tax column in the invoice", 'wf-woocommerce-packing-list'),
			'form_toggler'=>array(
				'type'=>'child',
				'id'=>'individual_tax_column',
				'val'=>'Yes',
			)
		),
		array(
			'type'=>"uploader",
			'label'=>__("Upload signature",'wf-woocommerce-packing-list'),
			'option_name'=>"woocommerce_wf_packinglist_invoice_signature",
			'help_text' => __('Upload a signature to appear on the invoice. Leave it blank to have the logo from general settings.','wf-woocommerce-packing-list')
		),
		array(
			'type'=>"uploader",
			'label'=>__("Custom logo for invoice",'wf-woocommerce-packing-list'),
			'option_name'=>"woocommerce_wf_packinglist_logo",
			'help_text'=>__('Upload a logo to appear on the invoice. Leave it blank to have the logo from general settings.Ensure to select company logo from ‘Invoice > Customize > Company Logo’ to reflect on the invoice. Recommended size is 150x50px.','wf-woocommerce-packing-list'),
		),
		array(
			'type'=>"checkbox",
			'label'=>__("Use latest settings for invoice",'wf-woocommerce-packing-list'),
			'option_name'=>"woocommerce_wf_use_latest_settings_invoice",
			'field_vl' => 'Yes',
			'help_text_conditional'=>array(
	                array(
	                	'help_text'=>__("Enable to apply the most recent settings to previous order invoices. This will match the previous invoices with the upcoming invoices.Changing the company address, name or any other settings in the future may overwrite previously created invoices with the most up-to-date information.",'wf-woocommerce-packing-list'),
	                    'condition'=>array(
	                        array('field'=>'woocommerce_wf_use_latest_settings_invoice', 'value'=>'Yes')
	                    )
	                ),
	                array(
	                	'help_text'=>__("If it is unchecked,the previous invoices will not be updated to the latest settings.",'wf-woocommerce-packing-list'),
	                    'condition'=>array(
	                        array('field'=>'woocommerce_wf_use_latest_settings_invoice', 'value'=>'')
	                    )
	                )
	            ),
		),
		array(
            'type'=>"checkbox",
            'label'=>__("Generate invoices for old orders",'wf-woocommerce-packing-list'),
            'option_name'=>"wf_woocommerce_invoice_prev_install_orders",
            'help_text'=>__("Enable to generate invoices for orders created before the installation of the plugin.",'wf-woocommerce-packing-list'),
            'field_vl' => 'Yes',
        ),
	),$this->module_id);
	?>
</tbody>
</table>
<?php 
include plugin_dir_path( WF_PKLIST_PLUGIN_FILENAME )."admin/views/admin-settings-save-button.php";
?>
</div>