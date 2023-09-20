<?php
if ( ! defined( 'WPINC' ) ) {
    die;
}
?>
<style type="text/css">
.wf_pklist_dashboard_box_main{ display:flex; flex-direction:row; flex-wrap:wrap; justify-content:space-around; padding:20px 0px; }
.wf_pklist_dashboard_box{ display:inline-block; margin-top:25px; max-width:200px; width:100%; height:194px; border:solid 1px rgba(220,220,220,1); box-shadow:0px 1px 7px -1px rgb(230, 230, 230.5); background:rgba(250,250,250,1); margin-left:20px;}
.wf_pklist_dashboard_box_body{ width:inherit; height:150px; border-bottom:solid 1px rgba(230,230,230,1); text-align:center; line-height:100px; }
.wf_pklist_dashboard_box_body_inner{ display:inline-block; line-height:16px; margin-top:45px; font-size:15px; text-shadow:1px 1px 5px #fff; color:#666; font-weight:600;}
.wf_pklist_dashboard_box_body img{ display:inline-block; width:50px; }
.wf_pklist_dashboard_box_footer{ width:inherit; height:34px; border-top:solid 1px #fff;}
.wf_pklist_dashboard_btn{ display:inline-block; cursor:pointer; width:70px; height:28px; text-align:center; color:#fff; font-weight:600; line-height:28px; font-size:11px; margin:5px 8px; text-decoration:none; background:#2271b1;border-color: #2271b1; border-radius: 3px;}
.wf_pklist_dashboard_btn:hover{ color:#fff; }
.wf_pklist_dashboard_checkbox{ float:right; line-height:27px; margin: 6px 8px 6px 8px; }
.wf_pklist_dashboard_checkbox .wf_switch{ width:37px; height:15px;}
.wf_pklist_dashboard_checkbox .wf_slider::before{ width: 15px;height: 15px;}
.wf_pklist_dashboard_checkbox input:checked + .wf_slider {
  background-color:#2270b1;
}
.wf_pklist_dashboard_checkbox input:checked + .wf_slider::before {
  transform: translateX(22px); -webkit-transform: translateX(22px); -ms-transform: translateX(22px);
}
.wf_pklist_dashboard_checkbox input:focus + .wf_slider {
  box-shadow: 0 0 1px #5fb90a;
}
.wt_pklist_info_msg{ margin-top:0px; list-style:disc; margin-left:15px; }
</style>
<div class="wf-tab-content" data-id="<?php echo $target_id;?>">
	
	<div class="wt_info_box" style="display:none;">
		<?php _e('The document types (Invoice, Packing slip, Delivery note, Shipping label, Dispatch label, Address label, Picklist, Proforma invoice and Credit note ) are enabled by default.','wf-woocommerce-packing-list'); ?>
		<br /><br />
		<i>
		  	<?php _e('Note:', 'wf-woocommerce-packing-list');?>
		   	<ul class="wt_pklist_info_msg">
		   		<li><?php _e("Fill up the 'Company' and 'Address' information from the 'General' tab prior to customization, to get it auto-populated in respective document types.", 'wf-woocommerce-packing-list');?></li>
		   		<li><?php echo sprintf(__('For better Unicode/RTL support, use our free %s mPDF add-on %s along with this plugin.', 'wf-woocommerce-packing-list'), '<a href="https://wordpress.org/plugins/mpdf-addon-for-pdf-invoices/" target="_blank">', '</a>');?></li>
			</ul>
		</i>
	</div>

	<form method="post">
	<?php
        // Set nonce:
        if (function_exists('wp_nonce_field'))
        {
            wp_nonce_field(WF_PKLIST_PLUGIN_NAME);
        }
       $wt_pklist_common_modules=get_option('wt_pklist_common_modules');
		    if($wt_pklist_common_modules===false)
		    {
		        $wt_pklist_common_modules=array();
		    }

		    if(!empty($wt_pklist_common_modules)){
		    	$module_list=array(
	            'invoice'=>1,
	            'packinglist'=>1,
	            'shippinglabel'=>1,
	            'deliverynote'=>1,
	            'dispatchlabel'=>1,
	            'addresslabel'=>1,
	            'picklist'=>1,
	            'proformainvoice'=>1,
	            'creditnote'=>1,
	        );
	        foreach($wt_pklist_common_modules as $m_key => $m_value){
	        	$module_list[$m_key] = $m_value;
	        }
	        $wt_pklist_common_modules = $module_list;
		    }
		    $wt_pklist_common_modules_main=array_chunk($wt_pklist_common_modules,3,true);
		    //$wt_pklist_common_modules_main=$wt_pklist_common_modules;
		    $document_module_labels=Wf_Woocommerce_Packing_List_Public::get_document_module_labels();
    ?>
    <input type="hidden" name="wf_update_module_status" value="1">
		
			<?php
			foreach ($wt_pklist_common_modules_main as $wt_pklist_common_modules_sub)
	  	{
		    ?>
		    <div class="wfte_doc_row" style="float:left;width: 100%;display: table;align-items: center;">
		    <!-- <div class="wf_pklist_dashboard_box_main"> -->
		    <?php
		    foreach($wt_pklist_common_modules_sub as $k=>$v)
		    {
		    	//only document modules
		    	if(isset($document_module_labels[$k]))
		    	{
		    		$module_id=Wf_Woocommerce_Packing_List::get_module_id($k);
		    		$settings_url=admin_url('admin.php?page='.$module_id);
		    ?>
		    		<div class="wfte_doc_col-3" style="width: 30%;display: block;border: 1px solid #ededed;float: left;margin: 10px 10px 20px 10px;justify-content: center;">
							<div style="display: flex;background: #fafafa;align-items: center;padding: 0px 15px;justify-content: space-evenly;">
								<div style="background: #fff;padding: 14px;">
									<img src="<?php echo WF_PKLIST_PLUGIN_URL;?>assets/images/<?php echo $k;?>_logo.png">
								</div>
								<div style="margin: 10px 0;">
									<div style="border-bottom: 1px solid #ccc;line-height: 21px;font-size: 15px;font-weight: 500;">
											<h3 style="margin: 5px 0 10px 0;color: #4F575F;font-size: 15px;"><?php _e(Wf_Woocommerce_Packing_List_Public::$modules_label[$k], 'wf-woocommerce-packing-list'); ?></h3>
									</div>
									<div  class="wf_pklist_dashboard_box_footer_up" style="align-items: center;display: flex;width: 100%;justify-content:;">
										<div>
												<a class="doc_module_link" href="<?php echo esc_url($settings_url); ?>" data-href="<?php echo esc_url($settings_url); ?>" style="font-size: 14px; text-decoration: none; opacity: 1; cursor: pointer;"><span class="dashicons dashicons-admin-generic" style="font-size: 17px;"></span> <?php echo __("Settings", "wf-woocommerce-packing-list"); ?></a>
										</div>
										<div class="wf_pklist_dashboard_checkbox">
		    					<input type="checkbox" value="1" name="wt_pklist_common_modules[<?php echo $k;?>]" <?php echo ($v==1 ? 'checked' : '');?> class="wf_slide_switch wt_document_module_enable" id="wt_pklist_<?php echo $k; ?>">	
		    				</div>
									</div>
								</div>
							</div>
						</div>
		    <?php
				}
			}
			?>
			</div>
		    <!-- </div> -->
		    <?php
		}
		?>
		
	</form>
</div>