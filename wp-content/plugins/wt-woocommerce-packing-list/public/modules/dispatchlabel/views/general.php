<?php
if (!defined('ABSPATH')) {
	exit;
}
?>
<div class="wf-tab-content" data-id="<?php echo $target_id;?>">
	<p><?php _e('Configure the general settings required for dispatch label.','wf-woocommerce-packing-list');?>
	<table class="wf-form-table">
	    <?php
	    $tax_doc_url = 'https://www.webtoffee.com/add-tax-column-in-woocommerce-invoice/#tax-display-formats';
		$individual_tax_doc_url = 'https://www.webtoffee.com/add-tax-column-in-woocommerce-invoice/#customize-tax';
	    $order_meta_doc_url = 'https://www.webtoffee.com/add-custom-fields-to-woocommerce-documents/#order-meta';
	    $product_meta_doc_url = 'https://www.webtoffee.com/add-custom-fields-to-woocommerce-documents/#product-meta';
	    $product_attr_doc_url = 'https://www.webtoffee.com/add-custom-fields-to-woocommerce-documents/#product-attribute';
	    
		Wf_Woocommerce_Packing_List_Admin::generate_form_field(array(
			array(
				'type'=>"checkbox",
				'label'=>__("Show variation data below each product",'wf-woocommerce-packing-list'),
				'option_name'=>"woocommerce_wf_packinglist_variation_data",
				'field_vl' => 'Yes',
				'help_text' => __('Enable to display variation data of products beneath the product.','wf-woocommerce-packing-list')
			),
			array(
				'type'=>"product_sort_by",
				'label'=>__("Sort products by", 'wf-woocommerce-packing-list'),
				'option_name'=>"sort_products_by",
				'help_text'=>'',
			),
			array(
				'type'=>"additional_fields",
				'label'=>__("Order meta fields",'wf-woocommerce-packing-list'),
				'option_name'=>'wf_'.$this->module_base.'_contactno_email',
				'module_base'=>$this->module_base,
				'help_text'=>sprintf(__('Select/add additional order information in the dispatch label.%s Learn how to add order meta %s','wf-woocommerce-packing-list'),'<a href="'.esc_url($order_meta_doc_url).'" target="_blank">', '</a>'),
			),
			array(
				'type'=>"product_meta",
				'label'=>__("Product meta fields",'wf-woocommerce-packing-list'),
				'option_name'=>'wf_'.$this->module_base.'_product_meta_fields',
				'module_base'=>$this->module_base,
				'help_text'=>sprintf(__('Selected product meta will be displayed beneath the respective product in the dispatch label.<br> %s Learn how to add product meta %s','wf-woocommerce-packing-list'),'<a href="'.esc_url($product_meta_doc_url).'" target="_blank">', '</a>'),
			),
			array(
				'type'=>"product_attribute",
				'label'=>__("Product attributes", 'wf-woocommerce-packing-list'),
				'option_name'=>'wt_'.$this->module_base.'_product_attribute_fields',
				'module_base'=>$this->module_base,
				'help_text'=>sprintf(__('Selected product attribute will be displayed beneath the respective product in the dispatch label.<br> %s Learn how to add product attribute %s', 'wf-woocommerce-packing-list'),'<a href="'.esc_url($product_attr_doc_url).'" target="_blank">', '</a>'),
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
				'type'=>'order_st_multiselect',
				'label'=>__("Show 'Print Dispatch Label' button for selected order statuses",'wf-woocommerce-packing-list'),
				'option_name'=>"woocommerce_wf_attach_".$this->module_base,
				'help_text'=>__("Adds print dispatch label button to the order email for chosen status",'wf-woocommerce-packing-list'),
				'order_statuses'=>$order_statuses,
				'field_vl'=>array_flip($order_statuses),
			),
		),$this->module_id);
		?>
	</table>
	<?php 
    include plugin_dir_path( WF_PKLIST_PLUGIN_FILENAME )."admin/views/admin-settings-save-button.php";
    ?>
</div>