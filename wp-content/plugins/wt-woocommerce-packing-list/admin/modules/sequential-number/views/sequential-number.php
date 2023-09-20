<?php
if (!defined('ABSPATH')) {
	exit;
}
$query = new WC_Order_Query( array(
    'limit' => 1,
    'orderby' => 'date',
    'order' => 'DESC',
    'parent'=>0,
) );

$orders = $query->get_orders();
$order_number = "123";
if(count($orders)>0)
{
	$order=$orders[0];
	$order_number=$order->get_order_number();
}

$current_invoice_number =(int) Wf_Woocommerce_Packing_List::get_option('woocommerce_wf_Current_Invoice_number',$to_module_id);
$current_invoice_number=($current_invoice_number<0 ? 0 : $current_invoice_number);
$inv_num=++$current_invoice_number;
$date_frmt_tooltip=__('Click to append with existing data','wf-woocommerce-packing-list');
$use_wc_order_number = Wf_Woocommerce_Packing_List::get_option('woocommerce_wf_invoice_as_ordernumber',$to_module_id);
$date_frmt_tooltip=__('Click to append with existing data','wf-woocommerce-packing-list');
?>
<style type="text/css">
.wf_inv_num_frmt_hlp_btn{ cursor:pointer; }
.wf_inv_num_frmt_hlp table thead th{ font-weight:bold; text-align:left; }
.wf_inv_num_frmt_hlp table tbody td{ text-align:left; }
.wf_inv_num_frmt_hlp .wf_pklist_popup_body{min-width:300px; padding:20px;}
.wf_inv_num_frmt_append_btn{ cursor:pointer; }
</style>
<!-- Invoice number Prefix/Suffix help popup -->
<div class="wf_inv_num_frmt_hlp wf_pklist_popup">
	<div class="wf_pklist_popup_hd">
		<span style="line-height:40px;" class="dashicons dashicons-calendar-alt"></span> <?php _e('Date formats','wf-woocommerce-packing-list');?>
		<div class="wf_pklist_popup_close">X</div>
	</div>
	<div class="wf_pklist_popup_body">
		
		<p style="text-align:left; max-width:400px; margin-top:0px;">
			<?php _e("By default the arguments will consider the document date(date on which the document invoice, shipping label etc is generated) as the input. ",'wf-woocommerce-packing-list'); ?>
			<br />
			<br />
			<input type="checkbox" name="wf_inv_num_frmt_data_val" id="wf_inv_num_frmt_order_date" value="order_date"> <label for="wf_inv_num_frmt_order_date"><?php _e('Use order date as input instead.','wf-woocommerce-packing-list');?></label>
			<span class="wf_form_help" style="margin-top:2px;"><?php _e('Enable this if you want to use the order date as input for the below arguments.', 'wf-woocommerce-packing-list');?></span> 
		</p>

		<p style="text-align:left; margin-bottom:2px;">
			<?php _e('Select from any of the formats below:','wf-woocommerce-packing-list');?>
		</p>
		<table class="wp-list-table widefat striped">
			<thead>
				<tr>
					<th><?php _e('Format','wf-woocommerce-packing-list');?></th><th><?php _e('Output','wf-woocommerce-packing-list');?></th>
				</tr>
			</thead>
			<tbody>
				<tr>
					<td><a class="wf_inv_num_frmt_append_btn" title="<?php echo $date_frmt_tooltip; ?>">[F]</a></td>
					<td><?php echo date('F'); ?></td>
				</tr>
				<tr>
					<td><a class="wf_inv_num_frmt_append_btn" title="<?php echo $date_frmt_tooltip; ?>">[dS]</a></td>
					<td><?php echo date('dS'); ?></td>
				</tr>
				<tr>
					<td><a class="wf_inv_num_frmt_append_btn" title="<?php echo $date_frmt_tooltip; ?>">[M]</a></td>
					<td><?php echo date('M'); ?></td>
				</tr>
				<tr>
					<td><a class="wf_inv_num_frmt_append_btn" title="<?php echo $date_frmt_tooltip; ?>">[m]</a></td>
					<td><?php echo date('m'); ?></td>
				</tr>
				<tr>
					<td><a class="wf_inv_num_frmt_append_btn" title="<?php echo $date_frmt_tooltip; ?>">[d]</a></td>
					<td><?php echo date('d'); ?></td>
				</tr>
				<tr>
					<td><a class="wf_inv_num_frmt_append_btn" title="<?php echo $date_frmt_tooltip; ?>">[D]</a></td>
					<td><?php echo date('D'); ?></td>
				</tr>
				<tr>
					<td><a class="wf_inv_num_frmt_append_btn" title="<?php echo $date_frmt_tooltip; ?>">[y]</a></td>
					<td><?php echo date('y'); ?></td>
				</tr>
				<tr>
					<td><a class="wf_inv_num_frmt_append_btn" title="<?php echo $date_frmt_tooltip; ?>">[Y]</a></td>
					<td><?php echo date('Y'); ?></td>
				</tr>
				<tr>
					<td><a class="wf_inv_num_frmt_append_btn" title="<?php echo $date_frmt_tooltip; ?>">[d/m/y]</a></td>
					<td><?php echo date('d/m/y'); ?></td>
				</tr>
				<tr>
					<td><a class="wf_inv_num_frmt_append_btn" title="<?php echo $date_frmt_tooltip; ?>">[d-m-Y]</a></td>
					<td><?php echo date('d-m-Y'); ?></td>
				</tr>
			</tbody>
		</table>
	</div>
</div>

<div class="wf-tab-content" data-id="<?php echo $target_id;?>" style="position: relative;">
<p style="width: 75%;">
	<?php echo sprintf(__('Use invoice number as order number or set up a custom invoice number with prefix/suffix/number series.', 'wf-woocommerce-packing-list'), $to_module_title);?>
</p>
<input type="hidden" value="<?php echo esc_attr($order_number); ?>" id="sample_invoice_number">
<input type="hidden" id="sample_current_invoice_number" value="<?php echo esc_attr($current_invoice_number); ?>">
<div id="invoice_number_prev_div" style="width: auto;border: 1px solid #dadadc;padding: 5px 12px;border-radius: 5px;display: inline-block;background: #f0f0f1;position: absolute;top: 0;<?php echo is_rtl() ? "left: 1%;" : "right: 1%;"?>">
	<p style="font-weight: bold;line-height: 0;"><?php echo __('PREVIEW','wf-woocommerce-packing-list'); ?></p>
	<p style="margin: 1em  0 0.5em 0; <?php if($use_wc_order_number == "No"){ echo "display: none;"; }?>" id="preview_invoice_number_text"><?php echo __('If the order number is','wf-woocommerce-packing-list'); ?> <?php echo $order_number; ?>, <br> <?php echo sprintf(__("the %1s number would be",'wf-woocommerce-packing-list'),strtolower($to_module_title)); ?> </p>
	<p style="margin: 1em  0 0.5em 0; <?php if($use_wc_order_number == "Yes"){ echo "display: none;"; }?>" id="preview_invoice_number_text_custom"><?php echo sprintf(__('Your next %1s number would be','wf-woocommerce-packing-list'),strtolower($to_module_title)); ?></p>
	<span id="preview_invoice_number" style="background: #ffffff;padding: 5px;color: #3c434a;border-radius: 3px;float: left;font-weight: bold;margin-bottom: 0.5em;"></span>	
</div>
<form method="post" class="wf_settings_form">
<?php
    // Set nonce:
    if (function_exists('wp_nonce_field'))
    {
        wp_nonce_field(WF_PKLIST_PLUGIN_NAME);
    }
?>
<input type="hidden" class="wf_settings_base" value="<?php echo $to_module;?>">
<input type="hidden" name="update_sequential_number" value="<?php echo $to_module_id;?>">
<table class="wf-form-table">
	<?php
	Wf_Woocommerce_Packing_List_Admin::generate_form_field(array(
			array(
				'type'=>"radio",
				'label'=>sprintf(__('Use order number as %s number', 'wf-woocommerce-packing-list'), $to_module_title),
				'option_name'=>"woocommerce_wf_invoice_as_ordernumber",
				'radio_fields'=>array(
					'Yes'=>__('Woocommerce order number','wf-woocommerce-packing-list'),
					'No'=>__('Custom number series','wf-woocommerce-packing-list')
				),
				'form_toggler'=>array(
					'type'=>'parent',
					'target'=>'wwpl_custom_inv_no',
				),
				'option_alignment' => 'vertical',
				'field_class' => 'invoice_preview_assert',
				'help_text'=>($to_module=='creditnote' ? __('While using this option multiple refunds(via partial refunds) from the same order will carry the same credit note number unless prefixed or suffixed accordingly with an appropriate date format.', 'wf-woocommerce-packing-list') : ''),
			),
		), $to_module_id);
		?>
	<?php
	$opt_name="woocommerce_wf_invoice_start_number";
	$vl=Wf_Woocommerce_Packing_List::get_option($opt_name,$to_module_id);
	$tt_text=Wf_Woocommerce_Packing_List_Admin::set_tooltip($opt_name,$to_module_id); //tooltip text
	?>
	<tr id="woocommerce_wf_invoice_start_number_tr" wf_frm_tgl-id="wwpl_custom_inv_no" wf_frm_tgl-val="No" wf_frm_tgl-lvl="2">
		<th><label><?php echo sprintf(__('%s Start Number', 'wf-woocommerce-packing-list'), $to_module_title); ?> <?php echo $tt_text; ?></label></th>
		<td>
			<div class="wf-form-group">

				<input type="number" min="1" step="1" readonly="" style="background:#eee; width:58%; float:left;" name="<?php echo $opt_name;?>" value="<?php echo $vl;?>" class="invoice_preview_assert" id="invoice_start_number">
				<input style="float: right;" id="reset_invoice_button" type="button"  class="button button-primary" value="<?php _e('Reset','wf-woocommerce-packing-list'); ?>"/>
			</div>
			<?php
			$opt_name="woocommerce_wf_Current_Invoice_number";
			$vl=Wf_Woocommerce_Packing_List::get_option($opt_name,$to_module_id);
			?>
			<input type="hidden" class="wf_current_invoice_number" value="<?php echo $vl;?>" name="<?php echo $opt_name;?>" class="invoice_preview_assert">
		</td>
		<td></td>
	</tr>
	<?php
	Wf_Woocommerce_Packing_List_Admin::generate_form_field(array(
		array(
			'type'=>'select',
			'label'=>sprintf(__('%s number format', 'wf-woocommerce-packing-list'), $to_module_title),
			'option_name'=>"woocommerce_wf_invoice_number_format",
			'select_fields'=>array(
				'[number]'=>__('[number]', 'wf-woocommerce-packing-list'),
				'[number][suffix]'=>__('[number][suffix]', 'wf-woocommerce-packing-list'),
				'[prefix][number]'=>__('[prefix][number]', 'wf-woocommerce-packing-list'),
				'[prefix][number][suffix]'=>__('[prefix][number][suffix]', 'wf-woocommerce-packing-list'),
			),
			'help_text'=>__('Select a format for the invoice number.','wf-woocommerce-packing-list'),
			'field_class' => 'invoice_preview_assert'
		),
	),$to_module_id);
	?>
	
	<?php
	Wf_Woocommerce_Packing_List_Admin::generate_form_field(array(
		array(
			'label'=>__("Prefix",'wf-woocommerce-packing-list'),
			'option_name'=>"woocommerce_wf_invoice_number_prefix",
			'help_text'=>sprintf(__("Prefix will be appended at the beginning of the invoice number.Use any of the %s date formats %s or alphanumeric characters.", 'wf-woocommerce-packing-list'), '<a class="wf_inv_num_frmt_hlp_btn" data-wf-trget="woocommerce_wf_invoice_number_prefix">', '</a>'),
			'field_class' => 'invoice_preview_assert'
		),
		array(
			'label'=>__("Suffix",'wf-woocommerce-packing-list'),
			'option_name'=>"woocommerce_wf_invoice_number_postfix",
			'help_text'=>sprintf(__("Suffix will appear at the end of an invoice number.Use any of the %s date formats %s or alphanumeric characters.", 'wf-woocommerce-packing-list'), '<a class="wf_inv_num_frmt_hlp_btn" data-wf-trget="woocommerce_wf_invoice_number_postfix">', '</a>'),
			'field_class' => 'invoice_preview_assert'
		),
		array(
			'type'=>'number',
			'label'=>sprintf(__('%s number length','wf-woocommerce-packing-list'), $to_module_title),
			'option_name'=>"woocommerce_wf_invoice_padding_number",
			'attr'=>'min="0"',
			'help_text'=>sprintf(__('Indicates the total length of the %s number, excluding the length of prefix and suffix if added. If the length of the generated %s number is less than the provided, it will be padded with ‘0’. E.g if you specify 7 as %s number length and your %s number is 8009, it will be represented as 0008009 in the respective documents.', 'wf-woocommerce-packing-list'), $to_module_title, $to_module_title, $to_module_title, $to_module_title),
			'field_class' => 'invoice_preview_assert'
		)
	),$to_module_id);
	?>	
</table>
<?php
$settings_button_title=sprintf(__('Save %s number settings', 'wf-woocommerce-packing-list'), $to_module_title);
include plugin_dir_path( WF_PKLIST_PLUGIN_FILENAME )."admin/views/admin-settings-save-button.php";
?>
</form>
</div>