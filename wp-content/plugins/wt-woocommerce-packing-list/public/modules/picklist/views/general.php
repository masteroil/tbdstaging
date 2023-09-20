<?php
if (!defined('ABSPATH')) {
	exit;
}
?>
<div class="wf-tab-content" data-id="<?php echo $target_id;?>">
<p>
	<?php _e('Configure the general settings required for picklist.','wf-woocommerce-packing-list');?>
</p>
<table class="wf-form-table">
	<?php
	$product_meta_doc_url = 'https://www.webtoffee.com/add-custom-fields-to-woocommerce-documents/#product-meta';
    $product_attr_doc_url = 'https://www.webtoffee.com/add-custom-fields-to-woocommerce-documents/#product-attribute';
	    
	Wf_Woocommerce_Packing_List_Admin::generate_form_field(array(
		array(
			'type'=>"checkbox",
			'label'=>__("Group products by 'Category'",'wf-woocommerce-packing-list'),
			'option_name'=>"wf_woocommerce_product_category_wise_splitting",
			'field_vl' => "Yes",
			'help_text'=>__('Select \'Yes\' if you need to group the picklist by category. (This is however applicable only for Packaging Type "Single package per order", configurable in General settings->Advanced).', 'wf-woocommerce-packing-list')
		),
		array(
			'type'=>"checkbox",
			'label'=>__("Group products by 'Order'",'wf-woocommerce-packing-list'),
			'option_name'=>"wf_woocommerce_product_order_wise_splitting",
			'field_vl' => "Yes",
			'help_text'=>__('Select \'Yes\' if you need to group the picklist by order. (This is however applicable only for Packaging Type "Single package per order", configurable in General settings->Advanced).', 'wf-woocommerce-packing-list')
		),
		array(
			'type'=>"checkbox",
			'label'=>__("Show variation data below each product",'wf-woocommerce-packing-list'),
			'option_name'=>"woocommerce_wf_packinglist_variation_data",
			'field_vl' => "Yes",
			'help_text' => __('Enable to display variation data of products beneath the product.','wf-woocommerce-packing-list')
		),
		array(
			'type'=>"checkbox",
			'label'=>__("Exclude virtual items",'wf-woocommerce-packing-list'),
			'option_name'=>"woocommerce_wf_packinglist_exclude_virtual_items",
			'field_vl' => "Yes",
		),
		array(
			'type'=>"product_sort_by",
			'label'=>__("Sort products by", 'wf-woocommerce-packing-list'),
			'option_name'=>"sort_products_by",
			'help_text'=>'',
		),
		array(
			'type'=>"product_meta",
			'label'=>__("Product meta fields",'wf-woocommerce-packing-list'),
			'option_name'=>'wf_'.$this->module_base.'_product_meta_fields',
			'module_base'=>$this->module_base,
			'help_text'=>sprintf(__('Selected product meta will be displayed beneath the respective product in the picklist.<br> %s Learn how to add product meta %s','wf-woocommerce-packing-list'),'<a href="'.esc_url($product_meta_doc_url).'" target="_blank">', '</a>'),
		),
		array(
			'type'=>"product_attribute",
			'label'=>__("Product attributes", 'wf-woocommerce-packing-list'),
			'option_name'=>'wt_'.$this->module_base.'_product_attribute_fields',
			'module_base'=>$this->module_base,
			'help_text'=>sprintf(__('Selected product attribute will be displayed beneath the respective product in the picklist.<br> %s Learn how to add product attribute %s', 'wf-woocommerce-packing-list'),'<a href="'.esc_url($product_attr_doc_url).'" target="_blank">', '</a>'),
		),
		array(
			'type'=>'order_st_multiselect',
			'label'=>__("Email Picklist automatically", 'wf-woocommerce-packing-list'),
			'option_name'=>"woocommerce_wf_generate_for_orderstatus",
			'order_statuses'=>$order_statuses,
			'field_vl'=>array_flip($order_statuses),
			'help_text'=>__('PDF version of picklist will be attached with the order email','wf-woocommerce-packing-list'),
		),
		array(
			'type'=>"checkbox",
			'label'=>__("Share Picklist PDF as a separate email",'wf-woocommerce-packing-list'),
			'option_name'=>"wt_pklist_separate_email",
			'field_vl' => "Yes",
			'help_text'=>sprintf(__('Enable the option and configure the email %s here %s, if you need to send a copy of the picklist to another email id e.g admin email.', 'wf-woocommerce-packing-list'), '<a href="'.$email_settings_path.'" target="_blank">', '</a>'),
		) 
	),$this->module_id);
	?>
</table>

<?php 
include plugin_dir_path( WF_PKLIST_PLUGIN_FILENAME )."admin/views/admin-settings-save-button.php";
?>
</div>