<?php
if (!defined('ABSPATH')) {
	exit;
}
?>
<div class="wf-tab-content" data-id="<?php echo $target_id;?>">
	<p><?php _e('Configure the general settings required for credit note.','wf-woocommerce-packing-list');?>
	<table class="wf-form-table">
	    <?php
	    $tax_doc_url = 'https://www.webtoffee.com/add-tax-column-in-woocommerce-invoice/#tax-display-formats';
		$individual_tax_doc_url = 'https://www.webtoffee.com/add-tax-column-in-woocommerce-invoice/#customize-tax';
	    $order_meta_doc_url = 'https://www.webtoffee.com/add-custom-fields-to-woocommerce-documents/#order-meta';
	    $product_meta_doc_url = 'https://www.webtoffee.com/add-custom-fields-to-woocommerce-documents/#product-meta';
	    $product_attr_doc_url = 'https://www.webtoffee.com/add-custom-fields-to-woocommerce-documents/#product-attribute';

		Wf_Woocommerce_Packing_List_Admin::generate_form_field(array(
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
				'help_text'=>sprintf(__('Select/add additional order information in the credit note.%s Learn how to add order meta %s','wf-woocommerce-packing-list'),'<a href="'.esc_url($order_meta_doc_url).'" target="_blank">', '</a>'),
			),
			array(
				'type'=>"product_meta",
				'label'=>__("Product meta fields",'wf-woocommerce-packing-list'),
				'option_name'=>'wf_'.$this->module_base.'_product_meta_fields',
				'module_base'=>$this->module_base,
				'help_text'=>sprintf(__('Selected product meta will be displayed beneath the respective product in the credit note.<br> %s Learn how to add product meta %s','wf-woocommerce-packing-list'),'<a href="'.esc_url($product_meta_doc_url).'" target="_blank">', '</a>'),
			),
			array(
				'type'=>"product_attribute",
				'label'=>__("Product attributes", 'wf-woocommerce-packing-list'),
				'option_name'=>'wt_'.$this->module_base.'_product_attribute_fields',
				'module_base'=>$this->module_base,
				'help_text'=>sprintf(__('Selected product attribute will be displayed beneath the respective product in the credit note.<br> %s Learn how to add product attribute %s', 'wf-woocommerce-packing-list'),'<a href="'.esc_url($product_attr_doc_url).'" target="_blank">', '</a>'),
			),
			array(
				'type'=>"checkbox",
				'label'=>__("Show variation data below each product",'wf-woocommerce-packing-list'),
				'option_name'=>"woocommerce_wf_packinglist_variation_data",
				'field_vl' => "Yes",
			),
			array(
				'type'=>"checkbox",
				'label'=>__("Show separate columns for each tax",'wf-woocommerce-packing-list'),
				'option_name'=>"wt_pklist_show_individual_tax_column",
				'field_vl' => 'Yes',
				'help_text'=>sprintf(__("Enable it to to display tax classes in separate columns.From 'Customize' tab choose a template that supports the individual tax column. %s Learn more. %s ",'wf-woocommerce-packing-list'),'<a href="'.esc_url($individual_tax_doc_url).'" target="_blank">', '</a>')
			),
			array(
				'type'=>"checkbox",
				'label'=>__("Attach credit note in ‘Refund’ email",'wf-woocommerce-packing-list'),
				'option_name'=>"woocommerce_wf_add_creditnote_in_mail",
				'field_vl' => "Yes",
				'help_text'=>__('PDF version of credit note will be attached with the refund email','wf-woocommerce-packing-list'),
			)
		),$this->module_id);
		?>
	</table>
	<?php 
    include plugin_dir_path( WF_PKLIST_PLUGIN_FILENAME )."admin/views/admin-settings-save-button.php";
    ?>
</div>