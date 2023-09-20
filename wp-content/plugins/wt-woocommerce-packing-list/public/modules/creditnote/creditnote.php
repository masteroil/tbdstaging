<?php
/**
 * Credit Note section of the plugin
 *
 * @link       
 * @since 4.0.0     
 *
 * @package  Wf_Woocommerce_Packing_List  
 */
if (!defined('ABSPATH')) {
    exit;
}

class Wf_Woocommerce_Packing_List_Creditnote
{
	public $module_id='';
	public static $module_id_static='';
	public $module_base='creditnote';
    public $customizer=null;
    private $seq_number=null;
	public function __construct()
	{
		$this->module_id=Wf_Woocommerce_Packing_List::get_module_id($this->module_base);
		self::$module_id_static=$this->module_id;

		add_filter('wf_module_default_settings',array($this,'default_settings'),10,2);
		add_filter('wf_module_single_checkbox_fields', array($this, 'single_checkbox_fields'), 10, 2);
		add_filter('wf_module_customizable_items',array($this,'get_customizable_items'),10,2);
		add_filter('wf_module_non_options_fields',array($this,'get_non_options_fields'),10,2);
		add_filter('wf_module_non_disable_fields',array($this,'get_non_disable_fields'),10,2);
		
		//hook to add which fiedls to convert
		add_filter('wf_module_convert_to_design_view_html',array($this,'convert_to_design_view_html'),10,3);

		//hook to generate template html
		add_filter('wf_module_generate_template_html_creditnote',array($this,'generate_template_html'),10,6);

		//hide empty fields on template
		add_filter('wf_pklist_alter_hide_empty',array($this,'hide_empty_elements'),10,6);

		add_action('wt_print_doc',array($this,'print_it'),10,2);

		add_filter('wt_email_attachments', array($this,'add_email_attachments'),10,4);	

		//initializing customizer		
		$this->customizer=Wf_Woocommerce_Packing_List::load_modules('customizer');

		//initializing Sequential Number
		$this->seq_number=Wf_Woocommerce_Packing_List::load_modules('sequential-number');

		add_filter('wt_admin_menu', array($this,'add_admin_pages'),10,1);
		add_filter('wt_print_docdata_metabox',array($this,'add_docdata_metabox'),10,3);
		add_filter('wt_print_actions', array($this,'add_print_actions'),10,4);				

		add_filter('wt_pklist_alter_tooltip_data', array($this,'register_tooltips'),1);


		/** 
		* @since 4.0.5 declaring multi select form fields in settings form 
		*/
		add_filter('wt_pklist_intl_alter_multi_select_fields', array($this,'alter_multi_select_fields'), 10, 2);
		
		/** 
		* @since 4.0.5 Declaring validation rule for form fields in settings form 
		*/
		add_filter('wt_pklist_intl_alter_validation_rule', array($this,'alter_validation_rule'), 10, 2);

		/**
		* @since 4.3.1 Add to remote printing
		*/
		add_filter('wt_pklist_add_to_remote_printing', array($this, 'add_to_remote_printing'), 10, 2);

		/**
		* @since 4.3.1 Do remote printing
		*/
		add_filter('wt_pklist_do_remote_printing', array($this, 'do_remote_printing'), 10, 2);

	}

	/**
	*	@since 4.3.1
	*	Add to remote printing, this will enable remote printing settings
	*/
	public function add_to_remote_printing($arr, $remote_print_vendor)
	{
		$arr[$this->module_base]=__('Credit Note', 'wf-woocommerce-packing-list');
		return $arr;
	}

	/**
	*	@since 4.3.1
	*	Do remote printing.
	*/
	public function do_remote_printing($module_base_arr, $order_id)
	{
        return Wf_Woocommerce_Packing_List_Admin::do_remote_printing($module_base_arr, $order_id, $this);
    }

	/**
	* 	@since 4.0.5
	* 	Declaring validation rule for form fields in settings form
	*/
	public function alter_validation_rule($arr, $base_id)
	{
		if($base_id == $this->module_id)
		{
			$arr=array(
				'wf_'.$this->module_base.'_contactno_email'=>array('type'=>'text_arr'),
	        	'wf_'.$this->module_base.'_product_meta_fields'=>array('type'=>'text_arr'),
	        	'wt_'.$this->module_base.'_product_attribute_fields'=>array('type'=>'text_arr'),
			);

			if(Wf_Woocommerce_Packing_List_Admin::module_exists('sequential-number'))
			{
				//sequential number validation rule
				$seq_arr=Wf_Woocommerce_Packing_List_Sequential_Number::get_validation_rule();
				$seq_arr=(!is_array($seq_arr) ? array() : $seq_arr);
				$arr=array_merge($arr, $seq_arr);
			}
		}
		return $arr;
	}

	/**
	* 	@since 4.0.5
	* 	Declaring multi select form fields in settings form
	*/
	public function alter_multi_select_fields($arr, $base_id)
	{
		if($base_id==$this->module_id)
		{
			$arr=array(
	        	'wf_'.$this->module_base.'_contactno_email'=>array(),
				'wf_'.$this->module_base.'_product_meta_fields'=>array(),
				'wt_'.$this->module_base.'_product_attribute_fields'=>array(),
	        );
		}
		return $arr;
	}


	/**
	* Get creditnote date
	* @since  	4.0.4
	* @return mixed
	*/
    public static function get_creditnote_date($order_id, $date_format, $order, $recent=false)
    {
    	if(Wf_Woocommerce_Packing_List_Admin::module_exists('sequential-number'))
	    {
	    	if(is_a($order, 'WC_Order'))
	    	{
	    		$creditnote_date_arr=array();
	    		foreach ($order->get_refunds() as $ref_order) 
	    		{
	    			$ref_id = (WC()->version < '2.7.0') ? $ref_order->id : $ref_order->get_id();
	    			$creditnote_date_arr[]=self::get_creditnote_date($ref_id, $date_format, $ref_order, $recent);
	    			if($recent){
	    				break;
	    			}
	    		}
	    		$creditnote_date_arr=array_filter($creditnote_date_arr);
	    		return implode(", ",$creditnote_date_arr);
	    	}else
	    	{
	    		return Wf_Woocommerce_Packing_List_Sequential_Number::get_sequential_date($order_id, 'wf_creditnote_date', $date_format, $order);
	    	}
	    }else
	    {
	    	return '';
	    }
    }

	/**
	* 	Function to generate credit note number
	* 	@since 4.0.4
	* 	@return mixed
	* 	@param object $order Order object
	* 	@param boolean $force_generate Force generate if not exists
	* 	@param boolean $recent Only one recent record
	*/
    public static function generate_creditnote_number($order, $force_generate=true, $recent=false) 
    {
	    if(Wf_Woocommerce_Packing_List_Admin::module_exists('sequential-number'))
	    {
	    	if(is_a($order, 'WC_Order'))
	    	{
	    		$creditnote_num_arr=array();
	    		foreach ($order->get_refunds() as $ref_order) 
	    		{
	    			$creditnote_num_arr[]=self::generate_creditnote_number($ref_order, $force_generate);
	    			if($recent){
	    				break;
	    			}
	    		}
	    		$creditnote_num_arr=array_filter($creditnote_num_arr);
	    		return implode(", ",$creditnote_num_arr);
	    	}else
	    	{
	    		return Wf_Woocommerce_Packing_List_Sequential_Number::generate_sequential_number($order, self::$module_id_static, array('number'=>'wf_creditnote_number', 'date'=>'wf_creditnote_date', 'enable'=>''), $force_generate);
	    	}
	    }else
	    {
	    	return '';
	    }
	}

	/**
	* 	@since 4.0.4
	* 	Hook the tooltip data to main tooltip array
	*/
	public function register_tooltips($tooltip_arr)
	{
		include(plugin_dir_path( __FILE__ ).'data/data.tooltip.php');
		$tooltip_arr[$this->module_id]=$arr;
		return $tooltip_arr;
	}

	public function hide_empty_elements($hide_on_empty_fields,$template_type)
	{
		if($template_type==$this->module_base)
		{
			
		}
		return $hide_on_empty_fields;
	}

	/**
	 *  Items needed to be converted to design view
	 */
	public function convert_to_design_view_html($find_replace,$html,$template_type)
	{
		if($template_type==$this->module_base)
		{
			$find_replace=Wf_Woocommerce_Packing_List_CustomizerLib::set_billing_address($find_replace, $template_type, $html);		
			$find_replace=Wf_Woocommerce_Packing_List_CustomizerLib::set_shipping_address($find_replace,$template_type, $html);		
			$find_replace=Wf_Woocommerce_Packing_List_CustomizerLib::set_product_table($find_replace,$template_type,$html);		
			$find_replace=Wf_Woocommerce_Packing_List_CustomizerLib::set_extra_charge_fields($find_replace,$template_type,$html);		
			$find_replace=Wf_Woocommerce_Packing_List_CustomizerLib::set_other_data($find_replace,$template_type,$html);
			$find_replace=$this->set_design_view_data($find_replace, $html, $template_type);
		}
		return $find_replace;
	}

	/**
	*	@since 4.0.4	set refund rows in product table
	*	
	*/
	private function set_refund_entries($find_replace, $html, $template_type, $order, $refund_order=null,$refund_id=null)
	{
		$refund_items_match=array();
		if(preg_match('/<[^>]*data-row-type\s*=\s*"[^"]*\bwfte_refund_items\b[^"]*"[^>]*>(.*?)<\/tr>/s',$html,$refund_items_match))
		{
			$refund_items_html='';
			$refund_items_row_html=isset($refund_items_match[0]) ? $refund_items_match[0] : '';
			if(!is_null($order) && $refund_items_row_html!='')
			{
				$refund_data_arr=$order->get_refunds();
				if(!empty($refund_data_arr))
				{
					$wc_version=WC()->version;
					$order_id=$wc_version<'2.7.0' ? $order->id : $order->get_id();
					$user_currency=get_post_meta($order_id,'_order_currency',true);
					foreach($refund_data_arr as $refund_data)
					{	
						$refund_data_id = ($wc_version< '2.7.0' ? $refund_data->id : $refund_data->get_id());
						if($refund_id == $refund_data_id){
							$refund_label = __('Refund Reason', 'wf-woocommerce-packing-list');
		                    $refund_reason = esc_html($refund_data->get_reason());
		                    $refund_reason=($refund_reason=='' ? __('-', 'wf-woocommerce-packing-list') : $refund_reason);
		                    $refund_items_html.=str_replace(array('[wfte_product_table_refund_item_label]', '[wfte_product_table_refund_item]'), array($refund_label, $refund_reason), $refund_items_row_html);
						}
						/*$refund_label=esc_html($refund_data->get_reason());
						$refund_label=($refund_label=='' ? __('Refund', 'wf-woocommerce-packing-list') : $refund_label);
						$refund_label.=' ('. self::generate_creditnote_number($refund_data) .')';
						$refund_label=apply_filters('wf_pklist_alter_refunditem_label', $refund_label, $refund_data, $template_type, $order);
	                    $refund_amount=apply_filters('wf_pklist_alter_refunditem_amount', $refund_data->get_amount(), $refund_data, $template_type, $order);
	                    $refund_amount=Wf_Woocommerce_Packing_List_Admin::wf_display_price($user_currency,$order,$refund_amount);
	                    $refund_amount = apply_filters('wf_pklist_alter_price_creditnote',$refund_amount,$template_type,$order);
	                    $refund_items_html.=str_replace(array('[wfte_product_table_refund_item_label]', '[wfte_product_table_refund_item]'), array($refund_label, $refund_amount), $refund_items_row_html);*/
					}
				}
			}
			$find_replace[$refund_items_match[0]]=$refund_items_html;
		}
		return $find_replace;
	}

	public function set_design_view_data($find_replace, $html, $template_type)
	{
		$find_replace=$this->set_refund_entries($find_replace, $html, $template_type, null);
		$find_replace['[wfte_creditnote_number]']=123456;
		return $find_replace;
	}

	/**
	 *  Items needed to be converted to HTML for print/download
	 */
	public function generate_template_html($find_replace,$html,$template_type,$order,$refund_order,$refund_id,$box_packing=null,$order_package=null)
	{
		if($template_type==$this->module_base)
		{
			//Generate invoice number while printing Credit note
			if(Wf_Woocommerce_Packing_List_Public::module_exists('invoice'))
			{
				Wf_Woocommerce_Packing_List_Invoice::generate_invoice_number($order);	
			}			
			$find_replace=$this->set_other_data($find_replace,$template_type,$html,$order,$refund_order,$refund_id);

			$find_replace=Wf_Woocommerce_Packing_List_CustomizerLib::set_billing_address($find_replace, $template_type, $html,$order);		
			$find_replace=Wf_Woocommerce_Packing_List_CustomizerLib::set_shipping_address($find_replace,$template_type, $html,$order);
			$find_replace=Wf_Woocommerce_Packing_List_CustomizerLib::set_product_table_creditnote($find_replace,$template_type,$html,$order,$refund_id,$refund_order);
			$find_replace=Wf_Woocommerce_Packing_List_CustomizerLib::set_extra_charge_fields_creditnote($find_replace,$template_type,$html,$order,$refund_id,$refund_order);
			$find_replace=Wf_Woocommerce_Packing_List_CustomizerLib::set_other_data($find_replace,$template_type,$html,$order);		
			$find_replace=Wf_Woocommerce_Packing_List_CustomizerLib::set_order_data($find_replace,$template_type,$html,$order);		
			$find_replace=Wf_Woocommerce_Packing_List_CustomizerLib::set_extra_fields($find_replace,$template_type,$html,$order);			
		}
		return $find_replace;
	}

	public function set_other_data($find_replace, $template_type, $html, $order,$refund_order,$refund_id)
	{	
		$wc_version=WC()->version;
		add_filter('wf_pklist_alter_item_quantiy', array($this, 'alter_quantity_column'), 1, 5);
		add_filter('wf_pklist_alter_item_price_formated', array($this, 'alter_price_column'), 1, 6);
		add_filter('wf_pklist_alter_item_total_formated', array($this, 'alter_total_price_column'), 1, 6);
		add_filter('wf_pklist_alter_item_individual_tax',array($this,'alter_item_individual_tax_column'),1,5);
		add_filter('wf_pklist_alter_item_tax_formated', array($this, 'alter_total_tax_column'), 1, 6);
		add_filter('wf_pklist_alter_subtotal_formated', array($this, 'alter_sub_total_row'), 1, 5);
		add_filter('wf_pklist_alter_shipping_row',array($this,'alter_shipping_row'),1,4);
		add_filter('wf_pklist_alter_total_fee',array($this,'alter_fee_row'),1,5);
		add_filter('wf_pklist_alter_taxitem_amount',array($this,'alter_extra_tax_row'),1,5);
		add_filter('wf_pklist_alter_total_tax_row',array($this,'alter_total_tax_row'),1,4);

		add_filter('wf_pklist_alter_item_quantiy_deleted_product',array($this,'alter_quantity_column_deleted_product'),1,4);
		add_filter('wf_pklist_alter_item_total_formated_deleted_product',array($this, 'alter_total_price_column_deleted_product'), 1, 5);
		add_filter('wf_pklist_alter_item_tax_formated_deleted_product', array($this, 'alter_total_tax_column_deleted_product'), 1, 5);
		
		$order_id=$wc_version<'2.7.0' ? $order->id : $order->get_id();
		$find_replace=$this->set_refund_entries($find_replace, $html, $template_type, $order,$refund_order,$refund_id);
		$find_replace['[wfte_creditnote_number]']=self::generate_creditnote_number($refund_order, true, true);
		//creditnote date
		$creditnote_date_match=array();
		$creditnote_date_format='m/d/Y';
		if(preg_match('/data-creditnote_date-format="(.*?)"/s',$html,$creditnote_date_match))
		{
			$creditnote_date_format=$creditnote_date_match[1];
		}
		$credit_date = self::get_creditnote_date($refund_id,$creditnote_date_format,$refund_order);
		$credit_date=apply_filters('wf_pklist_alter_creditnote_date',$credit_date,$template_type,$order);
		$find_replace['[wfte_creditnote_date]'] = $credit_date;
		return $find_replace; 
	}

	public static function refunded_item_details($refunded_item_id,$detail,$order){
		$refunded_item = new WC_Order_Item_Product($refunded_item_id);
		$incl_tax_text='';
		$incl_tax=false;
		$tax_type=Wf_Woocommerce_Packing_List::get_option('woocommerce_wf_generate_for_taxstatus');
		$template_type = "creditnote";
		if(in_array('in_tax', $tax_type)) /* including tax */
		{
			$incl_tax_text=Wf_Woocommerce_Packing_List_CustomizerLib::get_tax_incl_text($template_type, $order, 'product_price');
			$incl_tax_text=($incl_tax_text!="" ? ' ('.$incl_tax_text.')' : $incl_tax_text);
			$incl_tax=true;
		}
		switch ($detail) {
			case 'quantity':
				return $refunded_item->get_quantity();
				break;
			case 'line_total':
				$product_total=(float) (WC()->version< '2.7.0' ? $order->get_item_meta($refunded_item_id,'_line_total',true) : $order->get_line_total($refunded_item, $incl_tax, true));
				return $product_total;
				break;
			case 'line_total_tax':
				$tax_rate=0;
				$item_taxes=$refunded_item->get_taxes();
        		$item_tax_subtotal=(isset($item_taxes['subtotal']) ? $item_taxes['subtotal'] : array());
        		foreach($item_tax_subtotal as $tax_id => $tax_val)
        		{
        			$tax_rate+=(isset($tax_data_arr[$tax_id]) ? (float) $tax_data_arr[$tax_id] : 0);
        		}
        		$product_total=(float) (WC()->version< '2.7.0' ? $order->get_item_meta($refunded_item_id,'_line_total',true) : $order->get_line_total($refunded_item, $incl_tax, true));

        		if($tax_rate > 0){
        			$item_tax = $product_total * ($tax_rate/100);
        		}else{
        			$item_tax=$order->get_line_tax($refunded_item);
        		}

        		return $item_tax;
				break;
			default:
				return "";
				break;
		}
	}
	/**
	*	@since 4.0.4
	*	Alter quantity of order item if the item is refunded
	*	
	*/
	public function alter_quantity_column($qty, $template_type, $_product, $order_item, $order)
	{
		$item_id = $order_item->get_id();
		$order = Wf_Woocommerce_Packing_List_Admin::check_full_refunded_property($order);
		if($order->full_refunded == 0){
			$refunded_item_id = $order_item->this_refund_item_id;
			$qty = self::refunded_item_details($refunded_item_id,'quantity',$order);
			if($qty<0)
			{	
				$qty_formatted='<span style="">'.absint($qty).'</span>';
			}else{
				$qty_formatted = "-";
			}
		}else{
			$qty_formatted='<span style="">'.absint($qty).'</span>';
		}
		$qty_formatted = apply_filters('wt_pklist_alter_quantity_column_in_creditnote',$qty_formatted,$qty,$template_type,$order_item,$order);
		return $qty_formatted;
	}

	public function alter_quantity_column_deleted_product($qty, $template_type, $order_item, $order)
	{
		$item_id = $order_item->get_id();
		$order = Wf_Woocommerce_Packing_List_Admin::check_full_refunded_property($order);
		if($order->full_refunded == 0){
			$refunded_item_id = $order_item->this_refund_item_id;
			$qty = self::refunded_item_details($refunded_item_id,'quantity',$order);
			if($qty<0)
			{	
				$qty_formatted='<span style="">'.absint($qty).'</span>';
			}else{
				$qty_formatted = "-";
			}
		}else{
			$qty_formatted='<span style="">'.absint($qty).'</span>';
		}
		$qty_formatted = apply_filters('wt_pklist_alter_deleted_quantity_column_in_creditnote',$qty_formatted,$qty,$template_type,$order_item,$order);
		return $qty_formatted;
	}
	/**
	* @since 4.2.0 
	* Show the item price when refund is done in quantity field
	* 
	*/

	public function alter_price_column($item_price_formated,$template_type,$item_price,$_product,$order_item,$order){
		$item_id = $order_item->get_id();
		$order = Wf_Woocommerce_Packing_List_Admin::check_full_refunded_property($order);
		if($order->full_refunded == 0){
			$new_qty = $order->get_qty_refunded_for_item($item_id);
			if($new_qty<0)
			{
				$item_price_formated = $item_price_formated;
			}else{
				$item_price_formated = "-";
			}
		}
		$item_price_formated = apply_filters('wt_pklist_alter_unit_price_column_in_creditnote',$item_price_formated,$template_type,$item_price,$_product,$order_item,$order);
		return $item_price_formated;
	}

	/**
	*	@since 4.0.4
	*	Alter total price of order item if the item is refunded
	*	
	*/
	public function alter_total_price_column($product_total_formated, $template_type, $product_total, $_product, $order_item, $order)
	{	
		$wc_version=WC()->version;
		$order_id=$wc_version<'2.7.0' ? $order->id : $order->get_id();
		$user_currency=get_post_meta($order_id,'_order_currency',true);
		$order = Wf_Woocommerce_Packing_List_Admin::check_full_refunded_property($order);
		if($order->full_refunded == 0){
			$refunded_item_id = $order_item->this_refund_item_id;
			$refunded_tot_price = self::refunded_item_details($refunded_item_id,'line_total',$order);
			if($refunded_tot_price < 0){
				$product_total = abs((float)$refunded_tot_price);
				$product_total_formated=Wf_Woocommerce_Packing_List_Admin::wf_display_price($user_currency,$order,$product_total);
			}else{
				$product_total_formated= '-';
			}
		}
		$product_total_formated = apply_filters('wt_pklist_alter_total_price_column_in_creditnote',$product_total_formated,$product_total,$template_type,$order_item,$order);
		$product_total_formated = apply_filters('wf_pklist_alter_price_creditnote',$product_total_formated,$template_type,$order);
		return $product_total_formated;
	}

	public function alter_total_price_column_deleted_product($product_total_formated, $template_type, $product_total, $order_item, $order)
	{
		$wc_version=WC()->version;
		$order_id=$wc_version<'2.7.0' ? $order->id : $order->get_id();
		$user_currency=get_post_meta($order_id,'_order_currency',true);
		$order = Wf_Woocommerce_Packing_List_Admin::check_full_refunded_property($order);
		if($order->full_refunded == 0){
			$refunded_item_id = $order_item->this_refund_item_id;
			$refunded_tot_price = self::refunded_item_details($refunded_item_id,'line_total',$order);
			if($refunded_tot_price < 0){
				$product_total = abs((float)$refunded_tot_price);
				$product_total_formated=Wf_Woocommerce_Packing_List_Admin::wf_display_price($user_currency,$order,$product_total);
			}else{
				$product_total_formated= '-';
			}
		}
		$product_total_formated = apply_filters('wt_pklist_alter_total_price_column_in_creditnote',$product_total_formated,$product_total,$template_type,$order_item,$order);
		$product_total_formated = apply_filters('wf_pklist_alter_price_creditnote',$product_total_formated,$template_type,$order);
		return $product_total_formated;
	}

	/**
	* 	@since 4.2.0
	* 	Added individual tax column when refund is done in respective tax columns
	* 
	*/
	public function alter_item_individual_tax_column($tax_val, $template_type, $tax_id, $order_item, $order){
		$wc_version=WC()->version;
		$order_id=$wc_version<'2.7.0' ? $order->id : $order->get_id();
		$user_currency=get_post_meta($order_id,'_order_currency',true);
		$new_tax_val_formatted = Wf_Woocommerce_Packing_List_Admin::wf_display_price($user_currency,$order,$tax_val);
		$order = Wf_Woocommerce_Packing_List_Admin::check_full_refunded_property($order);
		if($order->full_refunded == 0){
			$refunded_item_id = $order_item->this_refund_item_id;
			$new_tax_val = 0;
			$refunded_item = new WC_Order_Item_Product($refunded_item_id);
			$refund_tax = $refunded_item->get_taxes();
            $new_tax_val += isset( $refund_tax['total'][ $tax_id ] ) ? abs((float) $refund_tax['total'][ $tax_id ]) : 0;
			$new_tax_val_formatted = Wf_Woocommerce_Packing_List_Admin::wf_display_price($user_currency,$order,$new_tax_val);
			if($new_tax_val > 0){
				$new_tax_val_formatted = '<span style="">'.$new_tax_val_formatted.'</span>';
			}
		}
		$new_tax_val_formatted = apply_filters('wf_pklist_alter_individual_tax_column_in_creditnote',$new_tax_val_formatted,$tax_val,$tax_id,$template_type,$order_item,$order);
		$new_tax_val_formatted = apply_filters('wf_pklist_alter_price_creditnote',$new_tax_val_formatted,$template_type,$order);
		return $new_tax_val_formatted;
	}

	public function alter_total_tax_column($item_tax_formated,$template_type,$item_tax,$_product,$order_item,$order){
		$wc_version=WC()->version;
		$order_id=$wc_version<'2.7.0' ? $order->id : $order->get_id();
		$user_currency=get_post_meta($order_id,'_order_currency',true);
		$order = Wf_Woocommerce_Packing_List_Admin::check_full_refunded_property($order);
		if($order->full_refunded == 0){
			$refunded_item_id = $order_item->this_refund_item_id;
			$refund_tax = self::refunded_item_details($refunded_item_id,'line_total_tax',$order);
			if($refund_tax < 0){
				$refund_tax = abs((float)$refund_tax);
			}
			$item_tax_formated = Wf_Woocommerce_Packing_List_Admin::wf_display_price($user_currency,$order,$refund_tax);
			if($refund_tax > 0){
				$item_tax_formated = '<span style="">'.$item_tax_formated.'</span>';
			}else{
				$item_tax_formated = '-';
			}
		}
			
		$item_tax_formated = apply_filters('wf_pklist_alter_total_tax_column_in_creditnote',$item_tax_formated,$item_tax,$template_type,$order_item,$order);
		$item_tax_formated = apply_filters('wf_pklist_alter_price_creditnote',$item_tax_formated,$template_type,$order);
		return $item_tax_formated;
	}

	public function alter_total_tax_column_deleted_product($item_tax_formated,$template_type,$item_tax,$order_item,$order){
		$wc_version=WC()->version;
		$order_id=$wc_version<'2.7.0' ? $order->id : $order->get_id();
		$user_currency=get_post_meta($order_id,'_order_currency',true);
		$order = Wf_Woocommerce_Packing_List_Admin::check_full_refunded_property($order);
		if($order->full_refunded == 0){
			$refunded_item_id = $order_item->this_refund_item_id;
			$refund_tax = self::refunded_item_details($refunded_item_id,'line_total_tax',$order);
			if($refund_tax < 0){
				$refund_tax = abs((float)$refund_tax);
			}
			$item_tax_formated = Wf_Woocommerce_Packing_List_Admin::wf_display_price($user_currency,$order,$refund_tax);
			if($refund_tax > 0){
				$item_tax_formated = '<span style="">'.$item_tax_formated.'</span>';
			}else{
				$item_tax_formated = '-';
			}
		}
		$item_tax_formated = apply_filters('wf_pklist_alter_total_tax_column_in_creditnote',$item_tax_formated,$item_tax,$template_type,$order_item,$order);
		$item_tax_formated = apply_filters('wf_pklist_alter_price_creditnote',$item_tax_formated,$template_type,$order);
		return $item_tax_formated;
	}

	/**
	* 	@since 4.2.0
	* 	
	*/
	public function alter_sub_total_row($sub_total_formated, $template_type, $sub_total, $order, $incl_tax){
		$wc_version=WC()->version;
		$order_id=$wc_version<'2.7.0' ? $order->id : $order->get_id();
		$user_currency=get_post_meta($order_id,'_order_currency',true);
		$new_total = $sub_total;
		if($sub_total < 0){
			$new_total = abs((float)$sub_total);
		}
		$sub_total_formated = Wf_Woocommerce_Packing_List_Admin::wf_display_price($user_currency,$order,$new_total);
		$sub_total_formated = apply_filters('wf_pklist_alter_subtotal_row_in_creditnote',$sub_total_formated,$sub_total,$incl_tax,$order);
		$sub_total_formated = apply_filters('wf_pklist_alter_price_creditnote',$sub_total_formated,$template_type,$order);
		return $sub_total_formated;
	}

	/**
	* 	@since 4.2.0
	* 	Show the refunded shipping amount
	*/
	public function alter_shipping_row($shipping, $template_type, $order, $product_table){
		$wc_version=WC()->version;
		$order = Wf_Woocommerce_Packing_List_Admin::check_full_refunded_property($order);
		if($order->full_refunded == 0){
			$refunded_shipping = $shipping;
			if(0 < $refunded_shipping){
				$order_id=$wc_version<'2.7.0' ? $order->id : $order->get_id();
				$user_currency=get_post_meta($order_id,'_order_currency',true);
				$shipping = Wf_Woocommerce_Packing_List_Admin::wf_display_price($user_currency,$order,$refunded_shipping);
			}else{
				$shipping = "";
			}
		}
		$shipping = apply_filters('wf_pklist_alter_shipping_row_in_creditnote',$shipping,$template_type,$order);
		$shipping = apply_filters('wf_pklist_alter_price_creditnote',$shipping,$template_type,$order);
		return $shipping;
	}

	/**
	* 	@since 4.2.0
	* 	Show the refunded individual tax amounts
	* 
	*/  
	public function alter_extra_tax_row($tax_amount, $tax_item, $order, $template_type,$tax_rate_id){
		$wc_version=WC()->version;
		$order_id=$wc_version<'2.7.0' ? $order->id : $order->get_id();
		$user_currency=get_post_meta($order_id,'_order_currency',true);
		$order = Wf_Woocommerce_Packing_List_Admin::check_full_refunded_property($order);
		if($order->full_refunded == 0){
			if($tax_amount < 0 ){
				$tax_amount = abs((float)$tax_amount);
				$tax_amount = Wf_Woocommerce_Packing_List_Admin::wf_display_price($user_currency,$order,$tax_amount);
			}else{
				$tax_amount = "";
			}
		}
		$tax_amount = apply_filters('wf_pklist_alter_extra_tax_row_in_creditnote',$tax_amount,$tax_item,$tax_rate_id,$template_type,$order);
		$tax_amount = apply_filters('wf_pklist_alter_price_creditnote',$tax_amount,$template_type,$order);
		return $tax_amount;
	}

	/**
	* 	@since 4.2.0
	* 	Show the refunded fee amount
	*/
	public function alter_fee_row($fee_total_amount_formated,$template_type,$fee_total_amount,$user_currency,$order){
		$order = Wf_Woocommerce_Packing_List_Admin::check_full_refunded_property($order);
		$tax_type=Wf_Woocommerce_Packing_List::get_option('woocommerce_wf_generate_for_taxstatus');
            $incl_tax=in_array('in_tax', $tax_type);
		if($order->full_refunded == 0){
			$fee_refund_amount = 0;
			$refund_data_arr=$order->get_refunds();
			if(!empty($refund_data_arr)){
				foreach($refund_data_arr as $refund_data){
					$fee_details = $refund_data->get_items('fee');
					if(!empty($fee_details)){
						$fee_ord_arr = array();
						foreach($fee_details as $fee => $fee_value){
							$fee_order_id = $fee;
							if(!in_array($fee_order_id,$fee_ord_arr)){
								$fee_refund_amount += (abs((float)wc_get_order_item_meta($fee_order_id,'_line_total',true)));
	                            if($incl_tax)
	                            {
	                                $fee_refund_amount += (abs((float)wc_get_order_item_meta($fee_order_id,'_line_tax',true)));
	                            } 
								$fee_ord_arr[] = $fee_order_id;
							}
						}
					}
				}
			}

			if(0 < $fee_refund_amount){
				$wc_version=WC()->version;
				$order_id=$wc_version<'2.7.0' ? $order->id : $order->get_id();
				$user_currency=get_post_meta($order_id,'_order_currency',true);
				$fee_refund_amount = Wf_Woocommerce_Packing_List_Admin::wf_display_price($user_currency,$order,$fee_refund_amount);
			}else{
				$fee_refund_amount = "";
			}
			$fee_total_amount_formated = $fee_refund_amount;
		}
		$fee_total_amount_formated = apply_filters('wf_pklist_alter_fee_row_in_creditnote',$fee_total_amount_formated,$fee_total_amount,$template_type,$order);
		$fee_total_amount_formated = apply_filters('wf_pklist_alter_price_creditnote',$fee_total_amount_formated,$template_type,$order);
		return $fee_total_amount_formated;
	}

	public function alter_total_tax_row($tax_total,$template_type,$order,$tax_items){
		$wc_version=WC()->version;
		$order_id=$wc_version<'2.7.0' ? $order->id : $order->get_id();
		$user_currency=get_post_meta($order_id,'_order_currency',true);
		$order = Wf_Woocommerce_Packing_List_Admin::check_full_refunded_property($order);
		$refund_tax = $tax_total;
		if($order->full_refunded == 0){
			if($refund_tax < 0){
				$refund_tax = abs((float)$refund_tax);
				$tax_total = Wf_Woocommerce_Packing_List_Admin::wf_display_price($user_currency,$order,$refund_tax);
			}else{
				$tax_total = "";
			}
		}
		$tax_total = apply_filters('wf_pklist_alter_total_tax_row_in_creditnote',$tax_total,$tax_items,$template_type,$order);
		$tax_total = apply_filters('wf_pklist_alter_price_creditnote',$tax_total,$template_type,$order);
		return $tax_total;
	}

	public function get_customizable_items($settings,$base_id)
	{
		if($base_id==$this->module_id)
		{
			//these fields are the classname in template Eg: `company_logo` will point to `wfte_company_logo`
			return array(
				'doc_title'=>__('Document title','wf-woocommerce-packing-list'),
				'company_logo'=>__('Company Logo','wf-woocommerce-packing-list'),
				'order_date'=>__('Order Date','wf-woocommerce-packing-list'),
				'creditnote_number' => __('Credit note number','wf-woocommerce-packing-list'),
				'creditnote_date' => __('Credit note Date','wf-woocommerce-packing-list'),
				'invoice_number'=>__('Invoice Number','wf-woocommerce-packing-list'),		
				'from_address'=>__('From Address','wf-woocommerce-packing-list'),
				'billing_address'=>__('Billing Address','wf-woocommerce-packing-list'),
				'shipping_address'=>__('Shipping Address','wf-woocommerce-packing-list'),
				'return_address'=>__('Return Address','wf-woocommerce-packing-list'),
				'email'=>__('Email Field','wf-woocommerce-packing-list'),
				'tel'=>__('Tel Field','wf-woocommerce-packing-list'),
				'shipping_method'=>__('Shipping Method','wf-woocommerce-packing-list'),
				'tracking_number'=>__('Tracking Number','wf-woocommerce-packing-list'),
				'product_table'=>__('Product Table','wf-woocommerce-packing-list'),
				'product_table_subtotal'=>__('Subtotal','wf-woocommerce-packing-list'),
				'product_table_shipping'=>__('Shipping','wf-woocommerce-packing-list'),
				'product_table_cart_discount'=>__('Cart Discount','wf-woocommerce-packing-list'),
				'product_table_order_discount'=>__('Order Discount','wf-woocommerce-packing-list'),
				'product_table_total_tax'=>__('Total Tax','wf-woocommerce-packing-list'),
				'product_table_fee'=>__('Fee','wf-woocommerce-packing-list'),
				'product_table_coupon'=>__('Coupon info','wf-woocommerce-packing-list'),
				'product_table_payment_method'=>__('Payment Method','wf-woocommerce-packing-list'),
				'product_table_payment_total'=>__('Total','wf-woocommerce-packing-list'),
				'footer'=>__('Footer','wf-woocommerce-packing-list'),
				'return_policy'=>__('Return Policy','wf-woocommerce-packing-list'),
			);
		}
		return $settings;
	}

	/*
	* These are the fields that have no customizable options, Just on/off
	* 
	*/
	public function get_non_options_fields($settings,$base_id)
	{
		if($base_id==$this->module_id)
		{
			return array(
				'footer',
				'return_policy',
			);
		}
		return $settings;
	}

	/*
	* These are the fields that are not switchable
	* 
	*/
	public function get_non_disable_fields($settings,$base_id)
	{
		if($base_id==$this->module_id)
		{
			return array(
				
			);
		}
		return $settings;
	}
	public function default_settings($settings,$base_id)
	{
		if($base_id==$this->module_id)
		{
			$settings=array(
				'wf_'.$this->module_base.'_contactno_email'=>array('email','contact_number'),
	        	'wf_'.$this->module_base.'_product_meta_fields'=>array(),
	        	'woocommerce_wf_add_creditnote_in_mail'=>'Yes',
	        	'wt_'.$this->module_base.'_product_attribute_fields'=>array(),
	        	'woocommerce_wf_packinglist_variation_data'=>'No',
	        	'sort_products_by'=>'',
	        	'wt_pklist_total_tax_column_display_option'=>"amount", /* Possible values: 1. amount, 2. rate, 3. amount-rate */
	        	'wt_pklist_show_individual_tax_column'=>"No",
				'wt_pklist_individual_tax_column_display_option'=>"amount", /* Possible values: 1. amount, 2. rate, 3. amount-rate, 4. separate-column (amount and rate in separate columns) */
			);
			if(Wf_Woocommerce_Packing_List_Admin::module_exists('sequential-number'))
			{
				//sequential number settings
				$seq_settings=Wf_Woocommerce_Packing_List_Sequential_Number::get_sequential_field_default_settings();
				$seq_settings=(!is_array($seq_settings) ? array() : $seq_settings);
				$settings=array_merge($settings, $seq_settings);
			}
			return $settings;
		}else
		{
			return $settings;
		}
	}

	/*
	*	@since v4.4.0 - Changed the radio button fields to checkbox
	*	This function is for getting the values for checkbox fields when they are unchecked,
	*	since the PHP will not sent the $_POST the unchecked fields.
	*/
	public function single_checkbox_fields($settings,$base_id){
		if($base_id == $this->module_id){
			$settings = array(
				'woocommerce_wf_packinglist_variation_data' => "No",
				'woocommerce_wf_add_creditnote_in_mail' => "No",
				'wt_pklist_show_individual_tax_column'=>"No",
			);
		}
		return $settings;
	}

	public function add_admin_pages($menus)
	{
		$menus[]=array(
			'submenu',
			WF_PKLIST_POST_TYPE,
			__('Credit Note','wf-woocommerce-packing-list'),
			__('Credit Note','wf-woocommerce-packing-list'),
			'manage_woocommerce',
			$this->module_id,
			array($this,'admin_settings_page')
		);
		return $menus;
	}
	public function add_bulk_print_buttons($actions)
	{
		$actions['print_creditnote']=__('Print Credit Note','wf-woocommerce-packing-list');
		return $actions;
	}

	private function generate_print_button_data($order, $order_id, $button_location="detail_page")
	{ 
		if($button_location=='detail_page')
		{
			$args=array(
				'button_type'=>'aggregate',
				'button_key'=>'creditnote_actions', //unique if multiple on same page
				'button_location'=>$button_location,
				'action'=>'',
				'label'=>__('Credit Note','wf-woocommerce-packing-list'),
				'tooltip'=>__('Print/Download Credit Note','wf-woocommerce-packing-list'),
				'is_show_prompt'=>0, //always 0
				'items'=>array(
					array(  
						'action'=>'print_creditnote',
						'label'=>__('Print','wf-woocommerce-packing-list'),
						'tooltip'=>__('Print Credit Note','wf-woocommerce-packing-list'),
						'is_show_prompt'=>0,
						'button_location'=>$button_location,						
					),
					array(
						'action'=>'download_creditnote',
						'label'=>__('Download','wf-woocommerce-packing-list'),
						'tooltip'=>__('Download Credit Note','wf-woocommerce-packing-list'),
						'is_show_prompt'=>0,
						'button_location'=>$button_location,
					)
				),
			);
		}else
		{
			$args=array(
				'action'=>'print_creditnote',
				'label'=>__('Credit Note','wf-woocommerce-packing-list'),
				'tooltip'=>__('Print Credit Note','wf-woocommerce-packing-list'),
				'is_show_prompt'=>0,
				'button_location'=>$button_location,
			);
		}
		return $args;
	}

	public function add_print_actions($item_arr, $order, $order_id, $button_location)
	{	
		$refunds=$order->get_refunds();

		if(self::generate_creditnote_number($order, false)!=='')
		{
			$btn_data=$this->generate_print_button_data($order, $order_id, $button_location);
			if($btn_data)
			{
				$item_arr[]=$btn_data;
			}
		}else
		{
			if($refunds) //refund data exists but creditnote number not generated.
			{
				//generate credit note number
				self::generate_creditnote_number($order, true);
				$btn_data=$this->generate_print_button_data($order, $order_id, $button_location);
				if($btn_data)
				{
					$item_arr[]=$btn_data;
				}
			}
		}
		/**
		*	@since 4.3.1
		*	Alter button array just after adding buttons.
		*	We are specifying `module_base` as an argument to use common callback when needed
		*/
		if($refunds){
			$item_arr=apply_filters('wt_pklist_after_'.$this->module_base.'_print_button_list', $item_arr, $order, $button_location, $this->module_base);
		}
		return $item_arr;
	}


	public function add_email_attachments($attachments, $order, $order_id, $email_class_id)
	{ 
		$attach_to_mail_for=array('customer_partially_refunded_order', 'customer_refunded_order');
		$attach_to_mail_for=apply_filters('wf_pklist_alter_'.$this->module_base.'_attachment_mail_type', $attach_to_mail_for, $order_id, $email_class_id, $order);
		
		if(in_array($email_class_id, $attach_to_mail_for)) 
		{                    
           	if(Wf_Woocommerce_Packing_List::get_option('woocommerce_wf_add_creditnote_in_mail', $this->module_id)== "Yes")
           	{          		
           		if(!is_null($this->customizer))
		        { 
		        	$order_ids=array($order_id);
		        	$pdf_name=$this->customizer->generate_pdf_name($this->module_base,$order_ids);
		        	$this->customizer->template_for_pdf=true;
		        	$html=$this->generate_order_template($order_ids,$pdf_name);
		        	$attachments[]=$this->customizer->generate_template_pdf($html, $this->module_base, $pdf_name, 'attach');
		        }
           	}
        }
        return $attachments;
	}

	/**
	* 	@since 4.0.4
	*	Print credit note number details
	*/
	public function add_docdata_metabox($data_arr, $order, $order_id)
	{
		$refunds=$order->get_refunds();
		if($refunds)
		{
			//dummy array
			$data_arr[]=array(
				'label'=>'',
				'value'=>'',
			);
				
			foreach($refunds as $ref_order)
			{
				$creditnote_number=self::generate_creditnote_number($ref_order, false);
				$data_arr[]=array(
					'label'=>__('Credit Note Number','wf-woocommerce-packing-list'),
					'value'=>$creditnote_number,
				);

				$ref_id = (WC()->version < '2.7.0') ? $ref_order->id : $ref_order->get_id();
				$creditnote_date=self::get_creditnote_date($ref_id, get_option( 'date_format' ), $ref_order);
				$data_arr[]=array(
					'label'=>__('Credit Note Date','wf-woocommerce-packing-list'),
					'value'=>$creditnote_date,
				);
			}
		}
		return $data_arr;
	}

	
	public function admin_settings_page()
	{
		$order_statuses = wc_get_order_statuses();
		wp_enqueue_script('wc-enhanced-select');
		wp_enqueue_style('woocommerce_admin_styles',WC()->plugin_url().'/assets/css/admin.css');
		wp_enqueue_media();
		wp_enqueue_script($this->module_id,plugin_dir_url( __FILE__ ).'assets/js/main.js',array('jquery'),WF_PKLIST_VERSION);
		$params=array(
			'nonces' => array(
	            'main'=>wp_create_nonce($this->module_id),
	        ),
	        'ajax_url' => admin_url('admin-ajax.php'),
		);
		wp_localize_script($this->module_id,$this->module_id,$params);
		$the_options=Wf_Woocommerce_Packing_List::get_settings($this->module_id);
		
		
	    //initializing necessary modules, the argument must be current module name/folder
	    if(!is_null($this->customizer))
		{
			$this->customizer->init($this->module_base);
		}

		//initializing necessary modules, the argument must be current module name/folder
	    if(!is_null($this->seq_number))
		{
			$this->seq_number->init($this->module_base, __('Credit Note', 'wf-woocommerce-packing-list'));
		}
		include(plugin_dir_path( __FILE__ ).'views/creditnote-admin-settings.php');
	}
	
	/* 
	* Print_window for invoice
	* @param $orders : order ids
	*/    
    public function print_it($order_ids,$action) 
    { 
    	if($action=='print_creditnote' || $action=='download_creditnote')
    	{   
    		if(!is_array($order_ids))
    		{
    			return;
    		}    
	        if(!is_null($this->customizer))
	        {
	        	$pdf_name=$this->customizer->generate_pdf_name($this->module_base,$order_ids);
				if("download_creditnote" === $action)
	        	{	
	        		$this->customizer->template_for_pdf=true;	        	
	        		$html=$this->generate_order_template($order_ids,$pdf_name);
	        		$this->customizer->generate_template_pdf($html,$this->module_base,$pdf_name,'download');
	        	}else
	        	{	
	        		$this->customizer->template_for_pdf=false;	        	
	        		$html=$this->generate_order_template($order_ids,$pdf_name);
	        		echo $html;
	        	}
	        }else
	        {
	        	_e('Customizer module is not active.', 'wf-woocommerce-packing-list');
	        }
	        exit();
    	}
    }
    public function generate_order_template($orders,$page_title)
    {
    	$template_type=$this->module_base;
    	//taking active template html
    	$html=$this->customizer->get_template_html($template_type);
    	$style_blocks=$this->customizer->get_style_blocks($html);
    	$html=$this->customizer->remove_style_blocks($html,$style_blocks);
    	$out='';
    	if($html!="")
    	{
    		$number_of_orders=count($orders);
			$order_inc=0;
			foreach($orders as $order_id)
			{
				$order_inc++;
				$order=( WC()->version < '2.7.0' ) ? new WC_Order($order_id) : new wf_order($order_id);
				$all_refund_orders = $order->get_refunds();
				$number_of_refunds = count($all_refund_orders);
				if(0 < $number_of_refunds){
					$document_created = Wf_Woocommerce_Packing_List_Admin::created_document_count($order_id,$template_type);
				}
				$page = 1;
				$order_status = ( WC()->version < '2.7.0' ) ? $order->status : $order->get_status();
				foreach($all_refund_orders as $refund_order){
					if($number_of_refunds == 1 && $order_status == "refunded"){
						$order->full_refunded = 1;
					}else{
						$order->full_refunded = 0;
					}
					$refund_id=(WC()->version< '2.7.0' ? $refund_order->id : $refund_order->get_id());
					$out.=$this->customizer->generate_template_html_for_creditnote($html,$template_type,$order,$refund_order,$refund_id);
					if($number_of_refunds>1 && $page!=$number_of_refunds)
					{
	                	$out.='<p class="pagebreak"></p>';
		            }
		            $page++;
				}

				if($number_of_orders>1 && $order_inc<$number_of_orders)
				{
                	$out.='<p class="pagebreak"></p>';
	            }else
	            {
	                //$out.='<p class="no-page-break"></p>';
	            }
			}
			$out=$this->customizer->append_style_blocks($out,$style_blocks);
			$out=$this->customizer->append_header_and_footer_html($out,$template_type,$page_title);
    	}
    	return $out;
    }
}
new Wf_Woocommerce_Packing_List_Creditnote();