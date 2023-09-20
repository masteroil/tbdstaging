<?php 
$wf_filters_help_doc_cat = array(
	'order_details' => __('Order Details','wf-woocommerce-packing-list'),
	'product_table' => __('Product Table','wf-woocommerce-packing-list'),
	'summary_table' => __('Summary Table','wf-woocommerce-packing-list'),
	'others' => __('Others','wf-woocommerce-packing-list'),
);
$wf_filters_help_doc_lists=array(
	'order_details' => array(
		'wf_pklist_alter_order_number'=> array(
			'title' => __('Alter order number','wf-woocommerce-packing-list'),
			'description'=>__('Alter order number.','wf-woocommerce-packing-list'),
			'params'=>'$order_number,$template_type,$order',
			'function_name'=>'wt_pklist_order_number',
			'function_code'=>'
				/* custom code here */<br />
				$order_number=\' Enter the new order number\'; <br />				
				return $order_number;<br />',
		),
		'wf_pklist_alter_order_date'=> array(
			'title'=>__('Alter order date','wf-woocommerce-packing-list'),
			'description' => __("This filter is used to alter the order date in all the document templates",'wf-woocommerce-packing-list'),
			'params'=>'$order_date, $template_type, $order',
			'function_name'=>'wt_pklist_change_order_date_format',
			'function_code'=>'
				/* new date format */ <br />
				return <i class={inbuilt_fn}>date</i>("Y-m-d",strtotime(<span class={prms_css}>$order_date</span>)); <br />
			',
			'function_code_copy' => '
				/* new date format */ <br />
				return date("Y-m-d",strtotime($order_date)); <br />
			',
		),
		'wf_pklist_alter_invoice_date'=> array(
			'title'=>__('Alter invoice date','wf-woocommerce-packing-list'),
			'description' => __("This filter is used to alter the invoice date in all the document templates",'wf-woocommerce-packing-list'),
			'params'=>'$invoice_date, $template_type, $order',
			'function_name'=>'wt_pklist_change_invoice_date_format',
			'function_code'=>'
				/* new date format */ <br />
				return <i class={inbuilt_fn}>date</i>("M d Y",strtotime(<span class={prms_css}>$invoice_date</span>)); <br />
			',
			'function_code_copy' => '
				/* new date format */ <br />
				return date("M d Y",strtotime($invoice_date)); <br />
			',
		),
		'wf_pklist_alter_dispatch_date'=> array(
			'title' => __('Alter dispatch date','wf-woocommerce-packing-list'),
			'description'=>__('Alter dispatch date','wf-woocommerce-packing-list'),
			'params'=>'$dispatch_date, $template_type, $order',
			'function_name'=>'wt_pklist_change_dispatch_date_format',
			'function_code'=>'
				/* new date format */ <br />
				return <i class={inbuilt_fn}>date</i>("d - M - y",strtotime(<span class={prms_css}>$dispatch_date</span>)); <br />
			',
			'function_code_copy'=>'
				/* new date format */ <br />
				return date("d - M - y",strtotime($dispatch_date)); <br />
			',
		),
		'wf_pklist_alter_barcode_data'=> array(
			'title' => __('Alter barcode information','wf-woocommerce-packing-list'),
			'description'=>__('This filter is used to alter the barcode information for all the document templates','wf-woocommerce-packing-list'),
			'params'=>'$invoice_number, $template_type, $order',
			'function_name'=>'wt_pklist_order_number_in_barcode',
			'function_code'=>'
				/* order number in barcode */ <br />
				return $order->get_order_number();<br />
			',
		),
		'wf_pklist_alter_shipping_address'=> array(
			'title' => __('Alter shipping address','wf-woocommerce-packing-list'),
			'description'=>__('Alter shipping address','wf-woocommerce-packing-list'),
			'params'=>'$shipping_address, $template_type, $order',
			'function_name'=>'wt_pklist_alter_shipping_addr',
			'function_code'=>'
				/* To unset existing field */ <br />
				if(!empty($shipping_address[\'field_name\']))<br/>
				{<br/>
					unset($shipping_address[\'field_name\']);<br/>
				} <br /><br />

				/* add a new field shipping address */ <br />
				$shipping_address[\'new_field\']=\'new field value\';<br /><br />
				return $shipping_address;<br />',
		),
		'wf_pklist_alter_billing_address'=> array(
			'title'=>__('Alter billing address','wf-woocommerce-packing-list'),
			'description'=>__('Alter billing address','wf-woocommerce-packing-list'),
			'params'=>'$billing_address, $template_type, $order',
			'function_name'=>'wt_pklist_alter_billing_addr',
			'function_code'=>'
				/* To unset existing field */ <br />
				if(!empty($billing_address[\'field_name\']))<br/>
				{<br/>
					unset($billing_address[\'field_name\']);<br/>
				} <br /><br />

				/* add a new field billing address */ <br />
				$billing_address[\'new_field\']=\'new field value\';<br /><br />
				return $billing_address;<br />'
		),
		'wf_pklist_alter_shipping_from_address'=> array(
			'title' => __('Alter shipping from address','wf-woocommerce-packing-list'),
			'description'=>__('Alter shipping from address','wf-woocommerce-packing-list'),
			'params'=>'$fromaddress, $template_type, $order',
			'function_name'=>'wt_pklist_alter_from_addr',
			'function_code'=>'
				/* To unset existing field */ <br />
				if(!empty($fromaddress[\'field_name\']))<br/>
				{<br/>
					unset($fromaddress[\'field_name\']);<br/>
				} <br /><br />

				/* add a new field from address */ <br />
				$fromaddress[\'new_field\']=\'new field value\';<br /><br />
				return $fromaddress;<br />'
		),
		'wf_pklist_alter_shipping_return_address'=> array(
			'title' => __('Alter shipping return address','wf-woocommerce-packing-list'),
			'description'=>__('Alter shipping return address','wf-woocommerce-packing-list'),
			'params'=>'$returnaddress, $template_type, $order',
			'function_name'=>'wt_pklist_alter_return_address',
			'function_code'=>'
				/* custom code here */<br />
				return $returnaddress;
			',
		),
		'wf_pklist_add_additional_info'=> array(
			'title' => __('Add additional information','wf-woocommerce-packing-list'),
			'description'=>__('Add additional info','wf-woocommerce-packing-list'),
			'params'=>'$additional_info, $template_type, $order',
			'function_name'=>'wt_pklist_add_additional_data',
			'function_code'=>'
				$additional_info.=\'Additional text\';<br />
				return $additional_info;<br />
			',
		),
	),

	'product_table' => array(
		'wf_pklist_alter_product_table_head'=> array(
			'title' => __('Alter product table head.(Add,remove, change the order)','wf-woocommerce-packing-list'),
			'description'=>__('Alter product table head.(Add, remove, change order)','wf-woocommerce-packing-list'),
			'params'=>'$columns_list_arr, $template_type, $order',
			'function_name'=>'wt_pklist_alter_product_columns',
			'function_code'=>'
				/* removing image column */ <br />
				unset($columns_list_arr[\'image\']); <br /><br />

				/* adding a new custom column with text align right */ <br />
				$columns_list_arr[\'new_col\']=\'&lt;th class=&quot;wfte_product_table_head_new_col wfte_text_right&quot; col-type=&quot;new_col&quot;&gt;__[New column]__&lt;/th&gt;\'; <br />
				<br />

				return $columns_list_arr;<br />
			',
		),
		'wf_pklist_alter_package_product_name'=> array(
			'title' => __('Alter the product name in package documents','wf-woocommerce-packing-list'),
			'description'=>__('Alter product name in product (Works with Packing List, Shipping Label and Delivery note only)','wf-woocommerce-packing-list'),
			'params'=>'$item_name, $template_type, $_product, $item, $order',
			'function_name'=>'wt_pklist_alter_product_name_package_doc',
			'function_code'=>'
				/* custom code here */<br />
				return $item_name;<br />
			',
		),
		'wf_pklist_add_package_product_variation'=> array(
			'title'=>__('Add product variation in package documents','wf-woocommerce-packing-list'),
			'description'=>__('Add product variation in product (Works with Packing List, Shipping Label and Delivery note only)','wf-woocommerce-packing-list'),
			'params'=>'$item_meta, $template_type, $_product, $item, $order',
			'function_name'=>'wt_pklist_add_meta_in_package_doc',
			'function_code' => '
				/* custom code here to add product variation */<br />
			',
		),
		'wf_pklist_add_package_product_meta'=> array(
			'title' => __('Add product meta in package documents','wf-woocommerce-packing-list'),
			'description'=>__('Add product meta in product table (Works with Packing List, Shipping Label and Delivery note only)','wf-woocommerce-packing-list'),
			'params'=>'$addional_product_meta, $template_type, $_product, $item, $order',
			'function_name'=>'wt_pklist_add_product_meta_package_doc',
			'function_code' => '
				/* custom code here */<br />
				return $addional_product_meta;<br />
			',
		),
		'wf_pklist_alter_package_item_quantiy'=> array(
			'title' => __('Alter item quantity in package documents','wf-woocommerce-packing-list'),
			'description'=>__('Alter item quantity in product table (Works with Packing List, Shipping Label and Delivery note only)','wf-woocommerce-packing-list'),
			'params'=>'$item_quantity, $template_type, $_product, $item, $order',
			'function_name'=>'wt_pklist_package_item_quantiy',
			'function_code'=>'
				$item_quantity=\'New quantity\';<br />
				return $item_quantity;<br />',
		),
		'wf_pklist_alter_package_item_total_weight'=> array(
			'title' => __('Alter total weight in package documents','wf-woocommerce-packing-list'),
			'description'=>__('Alter total weight in product table (Works with Packing List, Shipping Label and Delivery note only)','wf-woocommerce-packing-list'),
			'params'=>'$item_weight, $template_type, $_product, $item, $order',
			'function_name'=>'wt_pklist_package_item_weight',
			'function_code'=>'
				$item_weight=\'New weight\';<br />
				return $item_weight;<br />',
		),
		'wf_pklist_alter_package_item_total'=> array(
			'title' => __('Alter item total in package documents','wf-woocommerce-packing-list'),
			'description'=>__('Alter item total in product table (Works with Packing List, Shipping Label and Delivery note only)','wf-woocommerce-packing-list'),
			'params'=>'$product_total, $template_type, $_product, $item, $order',
			'function_name'=>'wt_pklist_package_item_total',
			'function_code'=>'
				$product_total=\'New total price\';<br />
				return $product_total;<br />',
		),
		'wf_pklist_package_product_table_additional_column_val'=> array(
			'title' => __('Add additional column in product table of package documents','wf-woocommerce-packing-list'),
			'description'=>__('You can add additional column head via `wf_pklist_alter_product_table_head` filter. You need to add column data via this filter. (Works with Packing List, Shipping Label and Delivery note only)','wf-woocommerce-packing-list'),
			'params'=>'$column_data, $template_type, $columns_key, $_product, $item, $order',
			'function_name'=>'wt_pklist_package_add_custom_col_vl',
			'function_code'=>'				
				if($columns_key==\'new_col\')<br />
				{ <br />
					&nbsp;&nbsp;&nbsp;&nbsp; $column_data=\'Column data\'; <br />
				}<br />
				return $column_data;<br />
			',
		),
		'wf_pklist_alter_package_product_table_columns'=> array(
			'title' => __('Alter product table column in package documents','wf-woocommerce-packing-list'),
			'description'=>__('Alter product table column. (Works with Packing List, Shipping Label and Delivery note only)','wf-woocommerce-packing-list'),
			'params'=>'$product_row_columns, $template_type, $_product, $item, $order',
			'function_name' => 'wt_pklist_alter_product_columns_in_package',
			'function_code' => '
				/* custom code here */<br />
				return $product_row_columns;<br />
			',
		),
		'wf_pklist_alter_product_name'=> array(
			'title' => __('Alter product name','wf-woocommerce-packing-list'),
			'description'=>__('Alter product name. (Works with Invoice and Dispatch label only)','wf-woocommerce-packing-list'),
			'params'=>'$order_item_name, $template_type, $_product, $order_item, $order',
			'function_name'=>'wt_pklist_new_prodct_name',
			'function_code' => '
				/* custom code here */ <br />
				return $order_item_name, <br />
			',
		),
		'wf_pklist_add_product_variation'=> array(
			'title' => __('Add product variation','wf-woocommerce-packing-list'),
			'description'=>__('Add product variation. (Works with Invoice and Dispatch label only)','wf-woocommerce-packing-list'),
			'params'=>'$item_meta, $template_type, $_product, $order_item, $order',
			'function_name'=>'wt_pklist_prodct_varition',
			'function_code'=>'
				/* custom code here */
				return $item_meta; <br />
			',
		),
		'wf_pklist_add_product_meta'=> array(
			'title' => __('Add product meta','wf-woocommerce-packing-list'),
			'description'=>__('Add product meta. (Works with Invoice and Dispatch label only)','wf-woocommerce-packing-list'),
			'params'=>'$addional_product_meta, $template_type, $_product, $order_item, $order',
			'function_name'=>'wt_pklist_prodct_meta',
			'function_code'=>'
				/* custom code here */
				return $addional_product_meta; <br />
			',
		),
		'wf_pklist_alter_item_quantiy'=> array(
			'title' => __('Alter item quantity','wf-woocommerce-packing-list'),
			'description'=>__('Alter item quantity. (Works with Invoice and Dispatch label only)','wf-woocommerce-packing-list'),
			'params'=>'$order_item_qty, $template_type, $_product, $order_item, $order',
			'function_name'=>'wt_pklist_item_qty',
			'function_code'=>'
				$order_item_qty=\'New item quantity\';<br />
				return $order_item_qty;<br />',
		),
		'wf_pklist_alter_item_price'=> array(
			'title' => __('Alter item price','wf-woocommerce-packing-list'),
			'description'=>__('Alter item price. (Works with Invoice and Dispatch label only)','wf-woocommerce-packing-list'),
			'params'=>'$item_price, $template_type, $_product, $order_item, $order',
			'function_name'=>'wt_pklist_item_price',
			'function_code'=>'
				$item_price=\'New item price\';<br />
				return $item_price;<br />',
		),
		'wf_pklist_alter_item_price_formated'=> array(
			'title' => __('Alter item price format','wf-woocommerce-packing-list'),
			'description'=>__('Alter formated item price. (Works with Invoice and Dispatch label only)','wf-woocommerce-packing-list'),
			'params'=>'$item_price_formated, $template_type, $item_price, $_product, $order_item, $order',
			'function_name'=>'wt_pklist_item_price_formatted',
			'function_code'=>'
				$item_price_formated=\'New item formatted price\';<br />
				return $item_price_formated;<br />',
		),
		'wf_pklist_alter_item_total'=> array(
			'title' => __('Alter item total','wf-woocommerce-packing-list'),
			'description'=>__('Alter item total. (Works with Invoice and Dispatch label only)','wf-woocommerce-packing-list'),
			'params'=>'$product_total, $template_type, $_product, $order_item, $order',
			'function_name'=>'wt_pklist_item_total',
			'function_code'=>'
				$product_total=\'New product total\';<br />
				return $product_total;<br />'
		),
		'wf_pklist_alter_item_total_formated'=> array(
			'title' => __('Alter item total format','wf-woocommerce-packing-list'),
			'description'=>__('Alter formated item total. (Works with Invoice and Dispatch label only)','wf-woocommerce-packing-list'),
			'params'=>'$product_total_formated, $template_type, $product_total, $_product, $order_item, $order',
			'function_name'=>'wt_pklist_item_total_formatted',
			'function_code'=>'
				$product_total_formated=\'New product total formatted\';<br />
				return $product_total_formated;<br />'
		),
		'wf_pklist_product_table_additional_column_val'=> array(
			'title' => __('Add additional column in product table','wf-woocommerce-packing-list'),
			'description'=>__('You can add additional column head via `wf_pklist_alter_product_table_head` filter. You need to add column data via this filter. (Works with Invoice and Dispatch label only)','wf-woocommerce-packing-list'),
			'params'=>'$column_data, $template_type, $columns_key, $_product, $order_item, $order',
			'function_name'=>'wt_pklist_add_custom_col_vl',
			'function_code'=>'				
				if($columns_key==\'new_col\')<br />
				{ <br />
					&nbsp;&nbsp;&nbsp;&nbsp; $column_data=\'Column data\'; <br />
				}<br />
				return $column_data;<br />
			',
		),
		'wf_pklist_alter_product_table_columns'=> array(
			'title' => __('Alter product table column','wf-woocommerce-packing-list'),
			'description'=>__('Alter product table column. (Works with Invoice and Dispatch label only)','wf-woocommerce-packing-list'),
			'params'=>'$product_row_columns, $template_type, $_product, $order_item, $order',
			'function_name' => 'wt_pklist_alter_product_columns',
			'function_code' => '
				/* custom code here */<br />
				return $product_row_columns;<br />
			',
		),
	),
	'summary_table' => array(
		'wf_pklist_alter_subtotal'=> array(
			'title' => __('Alter subtotal','wf-woocommerce-packing-list'),
			'description'=>__('Alter subtotal','wf-woocommerce-packing-list'),
			'params'=>'$sub_total, $template_type, $order',
			'function_name'=>'wt_pklist_alter_sub',
			'function_code'=>'
				$sub_total=\'New subtotal\';<br />
				return $sub_total;<br />
			'
		),
		'wf_pklist_alter_subtotal_formated'=> array(
			'title' => __('Alter subtotal format','wf-woocommerce-packing-list'),
			'description'=>__('Alter formated subtotal','wf-woocommerce-packing-list'),
			'params'=>'$sub_total_formated, $template_type, $sub_total, $order',
			'function_name'=>'wt_pklist_alter_formated_sub',
			'function_code'=>'
				$sub_total_formated=\'New formatted subtotal\';<br />
				return $sub_total_formated;<br />
			'
		),
		'wf_pklist_alter_shipping_method'=> array(
			'title' => __('Alter shipping method','wf-woocommerce-packing-list'),
			'description'=>__('Alter shipping method','wf-woocommerce-packing-list'),
			'params'=>'$shipping, $template_type, $order',
			'function_name'=>'wt_pklist_alter_ship_method',
			'function_code'=>'
				$shipping=\'New shipping method\';<br />
				return $shipping;<br />'
		),
		'wf_pklist_alter_fee'=> array(
			'title' => __('Alter fee','wf-woocommerce-packing-list'),
			'description'=>__('Alter fee','wf-woocommerce-packing-list'),
			'params'=>'$fee_detail_html, $template_type, $fee_detail, $user_currency, $order',
			'function_name'=>'wt_pklist_new_fee',
			'function_code'=>'
				$fee_detail_html=\'New Fee\';<br />
				return $fee_detail_html;<br />'
		),
		'wf_pklist_alter_total_fee'=> array(
			'title' => __('Alter total fee','wf-woocommerce-packing-list'),
			'description'=>__('Alter total fee','wf-woocommerce-packing-list'),
			'params'=>'$fee_total_amount_formated, $template_type, $fee_total_amount, $user_currency, $order',
			'function_name'=>'wt_pklist_new_formated_fee',
			'function_code'=>'
				$fee_total_amount_formated=\'New Formated Fee\';<br />
				return $fee_total_amount_formated;<br />'
		),
		'wf_pklist_alter_total_price'=> array(
			'title' => __('Alter total price','wf-woocommerce-packing-list'),
			'description'=>__('Alter total price','wf-woocommerce-packing-list'),
			'params'=>'$total_price, $template_type, $order',
			'function_name'=>'wt_pklist_alter_total_price',
			'function_code'=>'
				$total_price=\'New Price\';<br />
				return $total_price;<br />
			',
		),
		'wf_pklist_alter_total_price_in_words'=> array(
			'title' => __('Alter total price in words','wf-woocommerce-packing-list'),
			'description'=>__('Alter total price in words','wf-woocommerce-packing-list'),
			'params'=>'$total_in_words, $template_type, $order',
			'function_name'=>'wt_pklist_alter_total_price_in_words',
			'function_code'=>'
				$total_in_words=\'Price in words: \'.$total_in_words;<br />
				return $total_in_words;<br />
			',
		),
		'wf_pklist_alter_tax_inclusive_text'=> array(
			'title' => __('Alter inclusive tax info text','wf-woocommerce-packing-list'),
			'description'=>__('Alter inclusive tax text.','wf-woocommerce-packing-list'),
			'params'=>'$incl_tax_text, $template_type, $order',
			'function_name' => 'wt_pklist_alter_incl_tax_text',
			'function_code' => '
				/* custom code here */ <br />
				return $incl_tax_text;
			',
		),
		'wf_pklist_alter_refund_html'=> array(
			'title' => __('Alter refund data','wf-woocommerce-packing-list'),
			'description'=>__('Alter refund data.','wf-woocommerce-packing-list'),
			'params'=>'$refund_formated, $template_type, $refund_amount, $order',
			'function_name'=>'wt_pklist_alter_total_price_in_words',
			'function_code' => '
				/* custom code here */ <br />
				return $refund_formated;
			',
		),
	),
	'others'=>array(
		'wf_pklist_tracking_data_key'=> array(
			'title' => __('Alter tracking data key','wf-woocommerce-packing-list'),
			'description'=>__('Alter tracking data key','wf-woocommerce-packing-list'),
			'params'=>'$tracking_key, $template_type, $order',
			'function_name'=>'wt_pklist_track_key',
			'function_code'=>'
				$tracking_key=\'new_tracking_key\';<br />
				return $tracking_key;<br />'
		),
		'wf_pklist_alter_tracking_details'=> array(
			'title' => __('Alter trakcing data','wf-woocommerce-packing-list'),
			'description'=>__('Alter tracking data','wf-woocommerce-packing-list'),
			'params'=>'$tracking_details, $template_type, $order',
			'function_name' => 'wt_pklist_alter_tracking_details',
			'function_code' => '
				/* custom code here */ <br />
			',
		),
		'wf_pklist_alter_additional_fields'=> array(
			'title'=>__('Alter additional fields','wf-woocommerce-packing-list'), 
			'description'=>__('Alter additional fields','wf-woocommerce-packing-list'),
			'params'=>'$extra_fields, $template_type, $order',
			'function_name'=>'wt_pklist_add_extra_fields',
			'function_code'=>'
				/* To unset existing field */ <br />
				if(!empty($extra_fields[\'field_name\']))<br/>
				{<br/>
					unset($extra_fields[\'field_name\']);<br/>
				} <br /><br />

				/* add a new field  */ <br />
				$extra_fields[\'new_field\']=\'new field value\';<br /><br />
				return $extra_fields;<br />',
		),
		'wf_pklist_order_additional_item_meta'=> array(
			'title'=>__('Alter additional item meta','wf-woocommerce-packing-list'),
			'description'=>__('Alter additional item meta','wf-woocommerce-packing-list'),
			'params'=>'$order_item_meta_data, $template_type, $order',
			'function_name'=>'wf_pklist_add_order_meta',
			'function_code'=>'			
				/* get post meta */<br/>
				$order_id = $order->get_id(); <br/>
				$meta=get_post_meta($order_id, \'_meta_key\', true);<br/>
				$order_item_meta_data=$meta;<br />
				return $order_item_meta_data;<br />'
		),
		'wf_pklist_toggle_received_seal'=> array(
			'title' => __('Hide/Show received seal in invoice','wf-woocommerce-packing-list'),
			'description'=>__('Hide/Show received seal in invoice.','wf-woocommerce-packing-list'),
			'params'=>'$is_enable_received_seal, $template_type, $order',
			'function_name'=>'wt_pklist_toggle_received_seal',
			'function_code'=>'
				/* hide or show received seal */  <br />
				if($order->get_status()==\'refunded\')<br />
				{ <br />
				&nbsp;&nbsp;&nbsp;&nbsp; return false;  <br />
				}<br />
				return true; <br />
			',
		),
		'wf_pklist_received_seal_extra_text'=> array(
			'title'=>__('Add extra text in received seal','wf-woocommerce-packing-list'),
			'description'=>__('Add extra text in received seal.','wf-woocommerce-packing-list'),
			'params'=>'$extra_text, $template_type, $order',
			'function_name'=>'wt_pklist_received_seal_extra_text',
			'function_code'=>'
				/* add invoice date in received seal */  <br />
				$order_id=$order->get_id();  <br />
				$invoice_date=get_post_meta($order_id, \'_wf_invoice_date\', true);  <br />
				if($invoice_date)   <br />
				{   <br />
					&nbsp;&nbsp;&nbsp;&nbsp; return \'&lt;br /&gt;\'.<i class={inbuilt_fn}>date</i>(\'Y-m-d\',$invoice_date);  <br />
				} <br />
				return \'\'; <br />
			',
		),
		'wf_pklist_alter_hide_empty'=> array(
			'title' => __('Hide custom placeholder','wf-woocommerce-packing-list'),
			'description'=>__('You can add any custom placeholder in your template. You can add that placeholder key via this filter to hide it, while it\'s value is empty.','wf-woocommerce-packing-list'),
			'params'=>'$hide_on_empty_fields, $template_type',
			'function_name'=>'wt_pklist_alter_hide_empty_element',
			'function_code'=>'
				/* To remove an element from the list */<br/>
				unset($hide_on_empty_fields[\'element_name\']);<br/><br/>

				/* add an element to the list */<br/>
				$hide_on_empty_fields[]=\'new_element_name\';<br /><br />
				return $hide_on_empty_fields;<br />',
		),
		'wf_pklist_alter_template_html'=> array(
			'title' => __('Alter template HTML before printing','wf-woocommerce-packing-list'),
			'description'=>__('Alter template HTML before printing.','wf-woocommerce-packing-list'),
			'params'=>'$html, $template_type',
			'function_name'=>'wt_pklist_add_custom_css_in_invoice_html',
			'function_code'=>'
				/* add cutsom css in invoice */  <br />
				if($template_type==\'invoice\')<br />
				{ <br />
					&nbsp;&nbsp;&nbsp;&nbsp; $html.=\'&lt;style type=&quot;text/css&quot;&gt; body{ font-weight:bold; } &lt;/style&gt;\'; <br />
				}<br />
				return $html;<br />
			',
		),
		'wf_pklist_alter_find_replace'=> array(
			'title' => __('Add custom placeholder','wf-woocommerce-packing-list'),
			'description'=>__('You can add any custom placeholder in your template. You can set your placeholder\'s value via this filter.','wf-woocommerce-packing-list'),
			'params'=>'$find_replace, $template_type, $order, $box_packing, $order_package, $html',
			'function_name'=>'wt_pklist_add_custom_placeholder_value',
			'function_code'=>'
				/* add cutsom placeholder value */  <br />
				$find_replace[\'[wfte_my_placeholder]\']=\'Custom value for my placeholder\';
				<br />
				return $find_replace;<br />
			',
		),
		'wf_pklist_alter_addresslabel_extradata'=> array(
			'title' => __('Add extra data to address label','wf-woocommerce-packing-list'),
			'description'=> __('Add extra data to address label.','wf-woocommerce-packing-list'),
			'params'=>'$wfte_addresslabel_extradata, $order',
			'function_name'=>'wt_pklist_alter_addlabel',
			'function_code'=>'
			$wfte_addresslabel_extradata=\'Extra info to addresslabel\';<br />
			return $wfte_addresslabel_extradata;<br />'
		),
		'wf_pklist_label_keep_dimension'=> array(
			'title' => __('Shipping & Address label dimension','wf-woocommerce-packing-list'),
			'description'=>__('Shipping & Address Labels: The customization preference is always given to the number of items in a row by default compared to the dimensions. So the system will override the dimensions to accomdate the number of items thereby shrinking the labels. This filter allows you to prioritize the label dimension and override the default behaviour.','wf-woocommerce-packing-list'),
			'params'=>'$keep_label_dimension, $template_type',
			'function_name'=>'wt_pklist_keep_dimension',
			'function_code'=>'
				/* keep dimension of labels when paper size is small or big  */  <br />				
				return true;<br />
			',
		),
		'wf_pklist_include_box_name_in_packinglist'=> array(
			'title'=>__('Add/Remove box name in packing slip','wf-woocommerce-packing-list'),
			'description'=>__('Add/Remove box name in packing slip','wf-woocommerce-packing-list'),
			'params'=>'$box_name, $box_details, $order',
			'function_name'=>'wt_pklist_box_name',
			'function_code'=>'
				$box_name=\' Enter the box name\'; <br />				
				return $box_name;<br />
			',
		),
		'wf_pklist_alter_pdf_file_name'=> array(
			'title'=>__('Alter PDF/print file name','wf-woocommerce-packing-list'),
			'description'=>__('Alter PDF/print file name.','wf-woocommerce-packing-list'),
			'params'=>'$name, $template_type, $order_ids',
			'function_name'=>'wt_pklist_box_name',
			'function_code'=>'
				/* custom code here */ <br />
				$name=\' Enter the pdf name\'; <br />				
				return $name;<br />',
		),
		'wf_pklist_alter_taxitem_label'=> array(
			'description'=>__('Alter tax item label.','wf-woocommerce-packing-list'),
			'params'=>'$tax_label,$template_type,$order'
		),
		'wf_pklist_alter_package_order_items'=> array(
			'description'=>__('Alter order package items','wf-woocommerce-packing-list'),
			'params'=>'$order_package, $template_type, $order'
		),
		'wf_pklist_package_product_tbody_html'=> array(
			'description'=>__('Alter product table body. (Works with Packing List, Shipping Label and Delivery note only)','wf-woocommerce-packing-list'),
			'params'=>' $html, $columns_list_arr, $template_type, $order, $box_packing, $order_package'
		),
		'wf_pklist_alter_order_grouping_row_text'=> array(
			'description'=>__('Alter grouping row text.','wf-woocommerce-packing-list'),
			'params'=>' $order_info_arr, $item, $template_type'
		),
		'wf_pklist_alter_category_row_html'=> array(
			'description'=>__('Alter category row html.','wf-woocommerce-packing-list'),
			'params'=>' $order_info_arr, $item, $template_type'
		),
		'wf_pklist_alter_order_items'=> array(
			'description'=>__('Alter the order items.(Works with Invoice and Dispatch label only)','wf-woocommerce-packing-list'),
			'params'=>' $order_items, $template_type, $order'
		),
		'wf_pklist_alter_product_meta'=> array(
			'description'=>__('Alter product meta.(Works with Invoice and Dispatch label only)','wf-woocommerce-packing-list'),
			'params'=>' $meta_info_arr,$template_type,$_product,$order_item,$order',
		),
		'wf_pklist_alter_item_individual_tax'=> array(
			'description'=>__('Alter individual tax column.(Works with Invoice and Dispatch label only)','wf-woocommerce-packing-list'),
			'params'=>' $tax_val,$template_type,$tax_id,$order_item,$order'
		),
		'wf_pklist_alter_item_tax'=> array(
			'description'=>__('Alter individual tax item.(Works with Invoice and Dispatch label only)','wf-woocommerce-packing-list'),
			'params'=>' $item_tax,$template_type,$_product,$order_item,$order'
		),
		'wf_pklist_alter_item_tax_formated'=> array(
			'description'=>__('Alter individual tax item formated.(Works with Invoice and Dispatch label only)','wf-woocommerce-packing-list'),
			'params'=>' $item_tax_formated,$template_type,$item_tax,$_product,$order_item,$order'
		),
		'wf_pklist_alter_weight'=> array(
			'description'=>__('Alter the product weight.','wf-woocommerce-packing-list'),
			'params'=>' $weight_data, $total_weight, $order'
		),
		'wf_pklist_modify_meta_data'=> array(
			'description'=>__('Alter the meta data.','wf-woocommerce-packing-list'),
			'params'=>' $meta_data'
		),
		'wf_alter_line_item_variation_data'=> array(
			'description'=>__('Alter the variation data.','wf-woocommerce-packing-list'),
			'params'=>' $current_item, $meta_data, $id, $value'
		),
		'wf_pklist_alter_dummy_data_for_customize'=> array(
			'description'=>__('Alter the dummy data for customizer.','wf-woocommerce-packing-list'),
			'params'=>' $find_replace, $template_type, $html'
		),
		'wf_pklist_alter_settings'=> array(
			'description'=>__('Alter the settings array','wf-woocommerce-packing-list'),
			'params'=>'$settings,$base_id',
			'function_name'=>'wt_pklist_alter_setting',
			'function_code'=>'
				
				/* To remove a setting from the list */<br/>
				unset($settings[\'setting_name\']);<br/><br/>
				
				/* add new setting to the list */<br/>
				$settings[\'new_setting_name\']=\'new default value\';<br/><br/>			

				return $settings;<br />',
		),
		'wf_pklist_alter_package_grouped_order_items'=> array(
			'description'=>__('Alter the grouped order items.','wf-woocommerce-packing-list'),
			'params'=>'$item_arr, $grouping_config, $order_package, $template_type, $order'
		),
		'wf_pklist_alter_grouping_term_names'=> array(
			'description'=>__('Alter the grouping term name array.','wf-woocommerce-packing-list'),
			'params'=>'$term_name_arr, $id, $template_type, $order'
		),
		'wf_pklist_add_custom_css'=> array(
			'description'=>__('Add custom css','wf-woocommerce-packing-list'),
			'params'=>'$custom_css, $template_type, $template_for_pdf',
			'function_name'=>'wt_pklist_add_custom_css_in_invoice_html',
			'function_code'=>'
				/* add cutsom css for pdf in invoice */  <br />
				if($template_type==\'invoice\')<br />
				{ <br />
					&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;if($template_for_pdf)<br />
					&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{ <br />
					&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; $custom_css.=\' body{ font-weight:bold !important; } \'; <br />
					&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;}<br />
				}<br />
				return $custom_css;<br />
			',
		),
		'wf_pklist_alter_print_css'=> array(
			'description'=>__('Alter print css','wf-woocommerce-packing-list'),
			'params'=>'$print_css, $template_type, $template_for_pdf',
			'function_name'=>'wt_pklist_add_custom_css_in_invoice_html',
			'function_code'=>'
				/* add cutsom css in invoice */  <br />
				if($template_type==\'invoice\')<br />
				{ <br />
					&nbsp;&nbsp;&nbsp;&nbsp; $print_css.=\' body{ font-weight:bold !important; } \'; <br />
				}<br />
				return $print_css;<br />
			',

		),
	),
);
?>