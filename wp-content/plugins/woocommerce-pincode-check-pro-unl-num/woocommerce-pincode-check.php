<?php
/*
Plugin Name: Woocommerce check pincode/zipcode for shipping and cod
Plugin URI: http://www.phoeniixx.com
Description: Woocommerce Product Pincode Check with Unlimited number length of input pincode.
Version: 2.4.6
Author: phoeniixx
Text Domain: pho-pincode-zipcode-cod
Author URI: http://www.phoeniixx.com
Domain Path: /languages/
WC requires at least: 2.6.0
WC tested up to: 4.2.0
*/
ob_start();

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
	
 * Check if WooCommerce is active

 **/

if ( in_array( 'woocommerce/woocommerce.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) ) 
{

	if ( is_admin() ) {  
	
		add_action( 'woocommerce_product_write_panel_tabs', 'pincode_check_admin_tab' );
		
		add_action( 'woocommerce_product_data_panels', 'pincode_check_admin_options' );
		
		add_action( 'woocommerce_process_product_meta', 'pincode_check_admin_meta_custom_tab' );

	}
	
	function pincode_check_admin_tab() {
		?>
		<script>
			jQuery( document ).ready( function($) {

				$("#product-type").change(function () {
					
					var value = this.value;
					
					if(value === 'grouped' || value === 'external')
					{
						
						$('.custom_pincode_check').hide();
						
					}
					else
					{
						
						$('.custom_pincode_check').show();
						
					}
					
				});
				
				var valuep  = $('#product-type :selected').val();
				
				if( valuep === 'grouped' || valuep === 'external' )
				{
					
					$('.custom_pincode_check').hide();
					
				}
				else
				{
					
					$('.custom_pincode_check').show();
					
				}
				
			});
		
		</script>

			<li class="custom_pincode_check"> <a href="#custom_pincode_check_tab"><span><?php _e('Add Pincodes', 'pho-pincode-zipcode-cod'); ?></span></a></li>
		<?php
	}
	
	function pincode_check_admin_options() {
				
		global $post;

			?>
			<div id="custom_pincode_check_tab" class="panel woocommerce_options_panel wc-metaboxes-wrapper">
					
					<div id="custom_pincode_check_tab_data_options" class="wc-metaboxes">
						
						<table cellpadding="0" cellspacing="0" class="wc-metabox-content" style="width:100%;padding: 16px;">
							
							<tbody>
								<tr><td><h3><strong><?php _e( 'Upload CSV', 'pho-pincode-zipcode-cod' ); ?></strong></h3></td></tr>
								<tr>
								
									<td>
										
										<label for="product_pincode_file" style="float:none;margin:0 0 0 10px"><?php _e( 'Upload Product base pincode(csv file):', 'pho-pincode-zipcode-cod' ); ?></label>
										
										<input accept=".csv,text/csv" type="file" id="product_pincode_file" name="product_pincode_file" style="float:right" />
									
									</td>
									
									<td>
									
										<img alt="ajax-loader" id="loading_pin"  style="display:none" src="<?php echo esc_url(  plugin_dir_url( __FILE__ ) ); ?>assets/img/ajax-loader2.gif"/>
										
										<a id="upload_pin_file" class="button"><?php _e('Upload', 'pho-pincode-zipcode-cod'); ?></a>
									
									</td>
									
								</tr>
								
							</tbody>
							
						</table>
						<hr/>
						<table cellpadding="0" cellspacing="0" class="wc-metabox-content" style="width:100%;padding: 16px;">
							
							<tbody>
							
								<tr>
								
									<?php
								
										$pincode_count =  get_post_meta( $post->ID,'phen_pincode_list' ,true);
							
										$product_id = $post->ID;
										
									$count_min=	(!empty($pincode_count) && count($pincode_count)>0)?count($pincode_count):'0';
											
									?>
									<td>
										
										<a id="pheo_add_pincodes" class="button button-primary button-small" href="<?php echo admin_url("admin.php?page=add_pincode&&rpage=pedit&&pro_id=$product_id"); ?>"><?php _e('Add pincode', 'pho-pincode-zipcode-cod'); ?></a> &nbsp;&nbsp;
										
										<a id="pheo_view_pincodes" class="button button-primary button-small" href="<?php echo admin_url("admin.php?page=list_pincodes&&product_id=$product_id"); ?>"><?php _e('View pincodes', 'pho-pincode-zipcode-cod');echo '('.$count_min.')'; ?></a> &nbsp;&nbsp;
										
										<a id="pheo_delete_pincodes" class="button button-primary button-small" onClick="javascript: return confirm('You want to delete all pincodes?');" href="<?php echo admin_url("admin.php?page=list_pincodes&&product_id=$product_id&action=delete-all"); ?>"><?php _e('Delete all', 'pho-pincode-zipcode-cod'); ?></a>

									</td>
									
								</tr>
								
							</tbody>
							
						</table>
						
					</div>

			</div>
			
			<style>
			
				/* stylesheet */

				ul.wc-tabs li.custom_pincode_check a::before {
					content: "\f230"!important;
				}
				
				.pincode-pho-popup {
					background-color: #fff;
					box-shadow: 0 0 10px rgba(0, 0, 0, 0.08);
					left: 50%;
					padding: 3px 10px;
					position: absolute;
					top: 50%;
					transform: translate(-50%, -50%);
					-webkit-transform: translate(-50%, -50%);
					width: 750px;
					height: 500px;
					overflow: auto;
					border:4px solid rgba(0, 0, 0, 0.7);
				}
				
			
				.pincode-pho-popup .pho-close_btn {text-align:right; cursor:pointer; color:#b5b5b5; font-size:18px; position:absolute; top:0; right:6px; font-family:'Roboto', sans-serif; font-weight:300;}
				.pincode-pho-popup .pho-icon img {width:135px;}
				.pincode-pho-popup .pho-icon {text-align:center; margin-top:15px;}
				.pincode-pho-popup .pho-para  p {text-align:center; font-family:'Roboto', sans-serif; font-size:13px; color:#6a7b84; margin:10 auto; }
				.pincode-pho-popup .pho-separator { border: 1px solid #a4aeb4; margin: 5px auto 15px; width: 25px;}
				.pincode-pho-popup .pho-pincode {margin:10px 0; text-align:center;}


				.pincode-pho-popup input {background-color: #fff; border: 1px solid #dbdbdb; box-shadow:0 none; font-size:12px; height:34px; max-width:238px; width: 100%; color: #363636;display: inline-block; vertical-align: middle; margin-left:0; margin-bottom:0;}
				.pincode-pho-popup .pho-submit_btn {background:#1bbc9b; width:auto; color:#ffffff; height:34px; font-size:12px; font-weight:400; letter-spacing:0.5; cursor:pointer; float:none; margin:1px 0 0 0; border: 0 none; border-radius:0; vertical-align:top; padding-top:8px;}
				.pincode-pho-popup form {padding-bottom:16px;}
				.pincode-pho-popup .pho-select_div { border: 1px solid #dbdbdb; box-shadow:0 none; font-size:12px; height:32px; max-width:260px; width: 100%;display: inline-block; padding:5px 10px; color:#929292;}
				.pincode-pho-popup .pho-option-form {width:366px; margin:0 auto;}
				
				.pho-modal-box-backdrop {
					background: rgba(238, 238, 238, 0.75);
					bottom: 0;
					left: 0;
					position: absolute;
					right: 0;
					top: 0;
				}

				.pho-pincode-popup-body{
					bottom: 0;
					display:block;
					left: 0;
					outline: 0 none;
					overflow-y: auto;
					position: fixed;
					right: 0;
					top: 0;
					z-index: 999;
					background: rgba(0, 0, 0, 0.4) none repeat scroll 0 0;
				}
			
			</style>
			
			<script>
			
			jQuery(document).ready( function($) {
				
				$(document).on("click", ".pho-close_btn_admin", function() {
					
					$('.pho-pincode-popup-body-admin').fadeOut();
					
				});
				
				$(document).on("click", "#pheo_view_pincodes", function() {
					
					$('.pho-pincode-popup-body-admin').fadeIn();
					
				});
			
				$(document).on("click", "#upload_pin_file", function() {
					
					var upload_pin_fileData = new FormData();
							
					upload_pin_fileData.append('action', 'upload_pin_fileData' );
					
					var pinfile = $('#product_pincode_file').prop('files')[0];
					
					if(typeof pinfile != "undefined") //no errors
					{
						
						upload_pin_fileData.append('product_pincode_file', pinfile );
						
							$('#loading_pin').show();

							$.ajax({
								
								  url: '<?php echo admin_url( 'admin-ajax.php' ); ?>',
								  
								  type: 'POST',
								  
								  processData: false, // important
								  
								  contentType: false, // important
								  
								  data : upload_pin_fileData,

								success : function( response ) 
								{							
									
									$('#response_pincf').html( response );
									
									$('#loading_pin').hide();
									
								},
								error: function ( jqXHR, exception ) {
									
									//$('#loading_pin').hide();
									
									var msg = '';
									
									if (jqXHR.status === 0) {
										
										msg = 'Not connect.\n Verify Network.';
										
									} else if (jqXHR.status == 404) {
										
										msg = 'Requested page not found. [404]';
										
									} else if (jqXHR.status == 500) {
										
										msg = 'Internal Server Error [500].';
										
									} else if (exception === 'parsererror') {
										
										msg = 'Requested JSON parse failed.';
										
									} else if (exception === 'timeout') {
										
										msg = 'Time out error.';
										
									} else if (exception === 'abort') {
										
										msg = 'Ajax request aborted.';
										
									} else {
										
										msg = 'Uncaught Error.\n' + jqXHR.responseText;
										
									}
									
									//$('#response_pincf').html( msg );
									console.log( msg );
									
								},
								
							});
						
						//}
						
					}
					else
					{
						
						$("#response_pincf").html("Please Select A valid File.Only csv file type allowed.");
							
						//$('#loading_pin').hide();
						
						return false;
						
					}
					
				});
				
			});
				
			</script>
	
		<?php
	}
	
	add_action( 'wp_ajax_nopriv_upload_pin_fileData', 'upload_pin_fileData' );
	
	add_action( 'wp_ajax_upload_pin_fileData', 'upload_pin_fileData' );
	
	function upload_pin_fileData()
	{
		
		$filename = $_FILES['product_pincode_file']['name'];

		$file_tmp = $_FILES['product_pincode_file']['tmp_name'];

		$filename = dirname(__FILE__) .'/assets/ufile/'.$filename;

		$move_uploaded_file = move_uploaded_file($file_tmp, $filename);
		
		if($move_uploaded_file == 1)
		{
			
			$response = 'FIle uploaded sucessfully';
			
		}
		else
		{
			
			$response = 'Something went wrong, please try again.';
			
		}

		
		die($response);
		
	}
	
	function pincode_check_admin_meta_custom_tab( $post_id ) {
		
		$filename = sanitize_text_field($_POST['product_pincode_file']);

		if( $filename != '' )
		{
			
			$filename = dirname(__FILE__) .'/assets/ufile/'.$filename;		
							
			if(file_exists($filename)) 
			{
				
				$file_handle = fopen("$filename","r");
				
				$pincode_array = array();
				
				while(! feof($file_handle))
				{

					$line_of_text = fgetcsv($file_handle, 1024);
					
					$pincode = isset($line_of_text[0])?$line_of_text[0]:'';

					$area =  isset($line_of_text[1])?$line_of_text[1]:'';
					
					$city = isset($line_of_text[2])?$line_of_text[2]:'';

					$state = isset($line_of_text[3])?$line_of_text[3]:'';

					$dod = isset($line_of_text[4])?$line_of_text[4]:'';
					
					$cod_charge =isset($line_of_text[6])?$line_of_text[6]:'';
						
					$quantity_into = isset($line_of_text[7])?$line_of_text[7]:'';
					
					$dod_name = isset($line_of_text[8])?$line_of_text[8]:'';
					
					$time_hrs = isset($line_of_text[9])?$line_of_text[9]:'';
					
					$time_minuts = isset($line_of_text[10])?$line_of_text[10]:'';
					
					$deliver_by =	isset($line_of_text[11])?$line_of_text[11]:'';
					
					$deliver_quantity = isset($line_of_text[13]) ? $line_of_text[13] : '';
					
					$deliver_day = isset($line_of_text[14]) ? $line_of_text[14] :'';
						
					if($dod == '')
					{
						
						$dod = 0;
						
					}

					$codc =  isset($line_of_text[5])?$line_of_text[5]:'';
					
					$quantity_into1="";
					
					if( $quantity_into == 'y' || $quantity_into == 'Y' )
					{
						
						$quantity_into1 = '1';
						
					}
					if( $codc == 'y' || $codc == 'Y' )
					{
						
						$cod = 'yes';
						
					}
					elseif( $codc == 'n' || $codc == 'N' )
					{
						
						$cod = 'no';
						
					}
					else
					{
						
						$cod = 'no';
						
					}

					if( $pincode != '' && $pincode!="Pincode" )
					{
						
						$pincode_array[$pincode] = array( $pincode, $city, $state, $dod, $cod ,$dod_name,$deliver_by,$time_hrs,$time_minuts,$cod_charge,$quantity_into1,$area,$deliver_quantity,$deliver_day);
						
					}

				}
				
				$phen_pincode_list=get_post_meta( $post_id,'phen_pincode_list',true);
			
				
			if(!empty($phen_pincode_list) && is_array($phen_pincode_list)){
				
				$pincode_array=$pincode_array+$phen_pincode_list;
				
			}
				
				
				update_post_meta( $post_id,'phen_pincode_list',$pincode_array );
				
				
				
				unlink($filename);
				
			}
		
		}

	}
	
	function pincodes_settings_link($links) {
	
		  $settings_link = '<a href="admin.php?page=pincodes_setting">Settings</a>'; 
		  
		  array_unshift($links, $settings_link); 
		  
		  return $links; 
		  
	}
		 
	$plugin = plugin_basename(__FILE__);

	add_filter("plugin_action_links_$plugin", 'pincodes_settings_link' ); //for plugin setting link

	function pincodes_setting() {

		require_once(dirname(__FILE__).'/admin-setting.php');
		
	} 
	
	function phoen_adpanel_style3() {

        $plugin_dir_url =  plugin_dir_url( __FILE__ );
		
		$show_s_on_pro =  get_option( 'woo_pin_check_show_s_on_pro' );

		$show_c_on_pro =  get_option( 'woo_pin_check_show_c_on_pro' );
		
		$valpp = get_option('val_product_page');
		
		$show_d_est = get_option('show_deli_est');
		
		$pincode_length = get_option('pincode_length');
		
		$area_wise_delivery = get_option('area_wise_delivery');
		
		if($valpp == '')
		{
			$valpp = 0;
		}
		
		?>
			<script>
				var blog_title = '<?php echo $plugin_dir_url; ?>';
				var usejs = 0;
				var show_s_on_pro = "<?php echo $show_s_on_pro; ?>";
				var show_c_on_pro = "<?php echo $show_c_on_pro; ?>";
				var val_pro_page = "<?php echo $valpp; ?>";
				var show_d_est = "<?php echo $show_d_est; ?>";
				var pincode_length = "<?php echo $pincode_length; ?>";
				
				var area_wise_delivery = "<?php echo $area_wise_delivery ? "newnew":"old"; ?>";
				
				var pincode_success_msg = '<?php echo (get_option('woo_pin_checksuccess_msg_b') != '' )?get_option('woo_pin_checksuccess_msg_b'):'Congratulations! We can deliver to you'; ?>';
				// $del_info_text = get_option('woo_pin_check_del_info_text');
				var unsuccess_msg= '<?php echo (get_option('unsuccess_msg_b') != '' ) ? get_option('unsuccess_msg_b'):get_option('woo_pin_check_del_info_text'); ?>';
				
				var link_invalid_pin='<?php echo (get_option('link_invalid_pin') != '' ) ? get_option('link_invalid_pin'):''; ?>';
				
				
				if(link_invalid_pin==1){
					
					var unsuccess_link='<?php echo (get_option('unsuccess_msg_l') != '' ) ? get_option('unsuccess_msg_l'):'#'; ?>';
					
					var unsuccess_link_text='<?php echo (get_option('unsuccess_msg_lt') != '' ) ? get_option('unsuccess_msg_lt'):'Read More'; ?>';
					
				}
				
				
				var woocommerce_pincode_params = {
						
						entrance : "<?php echo get_option('phoen_pincode_ent_effct'); ?>",
						
						exit : "<?php echo get_option('phoen_pincode_ext_effct'); ?>",
						
						info : "<?php echo get_option('phoen_pincode_info_ent_effct'); ?>",
						
						info_exit : "<?php echo get_option('phoen_pincode_info_ext_effct'); ?>"
						
					}
					
			</script>
		<?php
		
		wp_enqueue_script( 'picodecheck-ajax-request', plugin_dir_url( __FILE__ ) . 'assets/js/custom.min.js', array( 'jquery' ) ,true,true );
		
		wp_localize_script( 'picodecheck-ajax-request', 'MyAjax', array( 'ajaxurl' => admin_url( 'admin-ajax.php' ) ) );
		
		/* wp_enqueue_script( 'pinocde-select2-script',$plugin_dir_url.'assets/js/select2.js' );
		
		wp_enqueue_style( 'pinocde-check_pincode_select2-style',$plugin_dir_url.'assets/css/select2.css' ); */
		
		wp_enqueue_style( 'pincode-style-name',$plugin_dir_url.'assets/css/style.css' );
		
		wp_enqueue_style( 'pinocde-mCustomScrollbar-style',$plugin_dir_url.'assets/css/jquery.mCustomScrollbar.css' );
		
		wp_enqueue_style( 'pinocde-check_pincode_animate-style',$plugin_dir_url.'assets/css/phoen_check_pincode_animate.css' );
		
		wp_enqueue_style( 'pinocde-check_pincode_fontawsome',$plugin_dir_url.'assets/css/fontawsome.css' );
		
		wp_enqueue_script( 'pinocde-mCustomScrollbar-script',$plugin_dir_url.'assets/js/jquery.mCustomScrollbar.js' );
		
		wp_enqueue_script( 'pinocde-mCustomScrollbar-script2',$plugin_dir_url.'assets/js/jquery.mCustomScrollbar.concat.min.js' );
		
	}

	add_action('wp_head', 'phoen_adpanel_style3'); //for adding /assets/js/css in wp head
	
	function phoen_adpanel_style4() {	

        $plugin_dir_url =  plugin_dir_url( __FILE__ );
		
		wp_enqueue_script( 'pinocde-select2-script',$plugin_dir_url.'assets/js/select2.js' );
		
		wp_enqueue_style( 'pinocde-check_pincode_select2-style',$plugin_dir_url.'assets/css/select2.css' );

		?>
		
			<script>
			
				var usejs = 0;
				
			</script>
			

	<style>
		.phoen-help-tip{
			position:relative;
			display: inline-block;
		}
		.phoen-help-tip::after {
			content: "";
			cursor: help;
			font-family: Dashicons;
			font-size: 17px;
			font-variant: normal;
			font-weight: 400;
			height: 100%;
			left: 4px;
			line-height: 1;
			margin: 0;
			position: absolute;
			text-align: center;
			text-indent: 0;
			text-transform: none;
			top: -12px;
			width: 100%;
		}
		.phoen_tiptip_content {
			display: none;
			width: auto;
			background-color: black;
			color: #fff;
			text-align: center;
			border-radius: 6px;
			padding: 12px 20px;
			position: absolute;
			z-index: 1;
			right:0;
		}

	</style>

		<?php

	}

	add_action('admin_head', 'phoen_adpanel_style4'); //for adding assets/js/css in wp head
	
	//Activation Code of table in wordpress

	register_activation_hook(__FILE__, 'pincode_plugin_activation');
	
	function pincode_plugin_activation() {
		
		global $wpdb,$table_prefix;
		
		$active_pincode_check =  get_option( 'active_pincode_check' );
		
		$check_place_oder_show = get_option('woo_pin_checkplc_odr_div');
		
		$show_product_page =  get_option( 'show_product_page' );
		
		$val_product_page =  get_option( 'val_product_page' );
		
		$show_d_est =  get_option( 'show_d_est' );
		
		$show_cod_a =  get_option( 'show_cod_a' );
		
		$pincode_length =  get_option( 'pincode_length' );
		
		$state_based_pincode =  get_option( 'state_based_pincode' );
		
		$error_msg_b =  get_option( 'woo_pin_check_error_msg_b' );
		
		$del_info_text = get_option('woo_pin_check_del_info_text');
		
		$checkpin_text =  get_option( 'woo_pin_check_checkpin_text' );
		
		if($del_info_text == ''){
			
			update_option('woo_pin_check_del_info_text','Get item availability info & delivery time for your location.','yes');
		
		}
		
		$del_place_holder_text = get_option('del_place_holder_text');
		
		if($del_place_holder_text == ''){
			
			update_option('del_place_holder_text','Enter Pincode','yes');
		
		}
		
		if($checkpin_text==''){
			
			update_option('woo_pin_check_checkpin_text','Enter Your Pincode');
			
		}
		if($state_based_pincode==''){
			
			update_option('state_based_pincode','0');
			
		}
		
		$phoen_pincode_ent_effct =  get_option( 'phoen_pincode_ent_effct' );
		
		$phoen_pincode_ext_effct =  get_option( 'phoen_pincode_ext_effct' );
		
		$phoen_pincode_info_ent_effct =  get_option( 'phoen_pincode_info_ent_effct' );
		
		$phoen_pincode_info_ext_effct =  get_option( 'phoen_pincode_info_ext_effct' );
		
		if($phoen_pincode_ent_effct == ''){
			
			update_option('phoen_pincode_ent_effct','bounceInDown','yes');
		
		}
		if($phoen_pincode_ext_effct == ''){
			
			update_option('phoen_pincode_ext_effct','hinge','yes');
		
		}
		if($phoen_pincode_info_ent_effct == ''){
			
			update_option('phoen_pincode_info_ent_effct','bounceInDown','yes');
		
		}
		if($phoen_pincode_info_ext_effct == ''){
			
			update_option('phoen_pincode_info_ext_effct','hinge','yes');
		
		}
		if($check_place_oder_show == ''){
			
			update_option('woo_pin_checkplc_odr_div',1,'yes');
		
		}
		
		if($active_pincode_check == '')
		{
			
			update_option('active_pincode_check',1,'yes');
			
		}
		
		if($show_product_page == '')
		{
			
			update_option('show_product_page',1,'yes');
			
		}
		
		if($val_product_page == '')
		{
			
			update_option('val_product_page',1,'yes');
			
		}
		
		if($show_d_est == '')
		{
			
			update_option('show_d_est',1,'yes');
			
		}
		
		if($show_cod_a == '')
		{
			
			update_option('show_cod_a',1,'yes');
			
		}
		
		if($pincode_length == '')
		{
			
			update_option('pincode_length', '6');
			
		}
		
		if($error_msg_b == '')
		{
			
			update_option( 'woo_pin_check_error_msg_b', 'Pincode should not be blank.');
			
		}
		
		
		$show_s_on_pro =  get_option( 'woo_pin_check_show_s_on_pro' );
		
		if($show_s_on_pro == '')
		{
			
			update_option( 'woo_pin_check_show_s_on_pro', '1');
			
		}
		
		$show_c_on_pro =  get_option( 'woo_pin_check_show_c_on_pro' );
		
		if($show_c_on_pro == '')
		{
			
			update_option( 'woo_pin_check_show_c_on_pro', '1');
			
		}

		$show_d_d_on_pro =  get_option( 'woo_pin_check_show_d_d_on_pro' );
		
		if($show_d_d_on_pro == '')
		{
			
			update_option( 'woo_pin_check_show_d_d_on_pro', '1');
			
		}
		
		$auto_pch = get_option( 'auto_load_popup' );
		
		if($auto_pch == '')
		{
			
			update_option( 'auto_load_popup', '0');
			
		}
		
		$auto_pchs = get_option( 'auto_load_popup_shop_cat' );
		
		if($auto_pchs == '')
		{
			
			update_option( 'auto_load_popup_shop_cat', '1');
			
		}

		$auto_pch_v = get_option( 'auto_load_validate' );
	
		if($auto_pch_v == '')
		{
			
			update_option( 'auto_load_validate', '1');
			
		}

		$auto_pch_bu = get_option( 'auto_load_block' );
	
		if($auto_pch_bu == '')
		{
			
			update_option( 'auto_load_block', '0');
			
		}

			
		$qry22 = $wpdb->get_results( "SELECT * FROM `".$table_prefix."pincode_setting_pro` ORDER BY `id` ASC  limit 1" ,ARRAY_A);	

		foreach($qry22 as $qry) {

		}
		

		if( $qry['s_s']  == '' )
		{
			
			$del_help_text = 'Delivery Date Help Text';
			
			$cod_help_text = 'COD Help Text';
			
			$cod_msg1 = 'Available';
			
			$cod_msg2 = 'Not Available';
			
			$error_msg = 'Please Enter Valid Pincode';
			
			$del_date = '1';
			
			$cod = '1';
						
			$s_s = '1';
			
			$s_s1 = '1';
			
			$cod_p = '1';
			
			$val_checkout = '0';
		
			$result = $wpdb->query( "UPDATE `".$table_prefix."pincode_setting_pro`  SET `del_help_text` = '$del_help_text', `cod_help_text` = '$cod_help_text', `cod_msg1` = '$cod_msg1', `cod_msg2` = '$cod_msg2', `error_msg` = '$error_msg', `del_date` = '$del_date', `cod` = '$cod', `s_s` = '$s_s', `s_s1` = '$s_s1', `cod_p` = '$cod_p',  `val_checkout` = '$val_checkout',`date_time` = NOW() " );
	
		}
		
			create_table();
		
	} 

	function create_table() {
		
		global $table_prefix, $wpdb;

		$tblname = 'check_pincode_pro';
		
		$wp_track_members_table = $table_prefix . "$tblname";
		
		#Check to see if the table exists already, if not, then create it
		
		$main=get_plugin_data(plugin_dir_path(__FILE__).'woocommerce-pincode-check.php');
		
	  $plugin_version=$main['Version']; 
		 // echo $plugin_version;die();
		if($wpdb->get_var( "show tables like '$wp_track_members_table'") != $wp_track_members_table) 
		{
		
			$sql0  = "CREATE TABLE `". $wp_track_members_table . "` ( ";

			$sql0 .= "  `id`  int(11)   NOT NULL auto_increment, ";

			$sql0 .= "  `pincode`  varchar(250)   NOT NULL, ";

			$sql0 .= "  `area`  varchar(250)   NOT NULL, ";
			
			$sql0 .= "  `city`  varchar(250)   NOT NULL, ";

			$sql0 .= "  `state`  varchar(250)   NOT NULL, ";

			$sql0 .= "  `dod`  int(11)   NOT NULL, ";
			
			$sql0 .= "  `cod`  varchar(250)   NOT NULL, ";
			
			$sql0 .= "  `dod_name`  varchar(250)   NOT NULL, ";
			
			$sql0 .= "  `time_hrs`  int(100)   NOT NULL, ";
			
			$sql0 .= "  `time_minuts`  int(100)   NOT NULL, ";
			
			$sql0 .= "  `product_list`  varchar(250)   NOT NULL, ";
			
			$sql0 .= "  `deliver_by`  varchar(250)   NOT NULL, ";
			
			$sql0 .= "  `cod_charge`  int(255)   NOT NULL, ";
			
			$sql0 .= "  `quantity_into`  varchar(255)   NOT NULL, ";
			
			$sql0 .= "  `deliver_day`  varchar(255)   NOT NULL, ";
			
			$sql0 .= "  `deliver_quantity`  varchar(255)   NOT NULL, ";
						
			$sql0 .= "  PRIMARY KEY `order_id` (`id`) "; 

			$sql0 .= ") ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ; ";

			#We need to include this file so we have access to the dbDelta function below (which is used to create the table)

			require_once(ABSPATH . '/wp-admin/upgrade-functions.php');

			dbDelta($sql0);

		} elseif($wpdb->get_var( "show tables like '$wp_track_members_table'") == $wp_track_members_table && version_compare(get_bloginfo('version'),'2.1.2', '<')){
			
			$result = $wpdb->query("SHOW COLUMNS FROM $wp_track_members_table LIKE 'dod_name'");
			
			$result_20 = $wpdb->query("SHOW COLUMNS FROM $wp_track_members_table LIKE 'product_list'");
			
			// echo $result_20;die();
			
			if($result==1 && $result_20 !==1){
				
				$wpdb->query("ALTER TABLE $wp_track_members_table  ADD COLUMN `area` varchar(250)  NOT NULL AFTER `pincode`, ADD COLUMN `cod` varchar(250)  NOT NULL AFTER `dod`, ADD COLUMN `dod_name` varchar(250)  NOT NULL AFTER `cod`, ADD COLUMN `time_hrs` int(100)  NOT NULL AFTER `dod_name`, ADD COLUMN `time_minuts` int(100)  NOT NULL AFTER `time_hrs`, ADD COLUMN `product_list` varchar(250)  NOT NULL AFTER `time_minuts`, ADD COLUMN `deliver_by` varchar(250)  NOT NULL AFTER `product_list`, ADD COLUMN `cod_charge` int(255)  NOT NULL AFTER `deliver_by`, ADD COLUMN `quantity_into` varchar(250)  NOT NULL AFTER `cod_charge`, ADD COLUMN `deliver_day` varchar(250)  NOT NULL AFTER `quantity_into`, ADD COLUMN `deliver_quantity` varchar(250)  NOT NULL AFTER `quantity_into`");
				
			}elseif($result_20==1){
				
				$wpdb->query("ALTER TABLE $wp_track_members_table  ADD COLUMN `area` varchar(250)  NOT NULL AFTER `pincode`, ADD COLUMN `time_hrs` int(100)  NOT NULL AFTER `dod_name`, ADD COLUMN `time_minuts` int(100)  NOT NULL AFTER `time_hrs`, ADD COLUMN `cod_charge` int(255)  NOT NULL AFTER `deliver_by`, ADD COLUMN `quantity_into` varchar(250)  NOT NULL AFTER `cod_charge`, ADD COLUMN `deliver_day` varchar(250)  NOT NULL AFTER `quantity_into`, ADD COLUMN `deliver_quantity` varchar(250)  NOT NULL AFTER `quantity_into`");
				
			}else{ 
				
				$wpdb->query("ALTER TABLE $wp_track_members_table  ADD COLUMN `area` varchar(250)  NOT NULL AFTER `pincode`, ADD COLUMN `time_hrs` int(100)  NOT NULL AFTER `dod_name`, ADD COLUMN `time_minuts` int(100)  NOT NULL AFTER `time_hrs`, ADD COLUMN `product_list` varchar(250)  NOT NULL AFTER `time_minuts`, ADD COLUMN `deliver_by` varchar(250)  NOT NULL AFTER `product_list`, ADD COLUMN `cod_charge` int(255)  NOT NULL AFTER `deliver_by`, ADD COLUMN `quantity_into` varchar(250)  NOT NULL AFTER `cod_charge`, ADD COLUMN `deliver_day` varchar(250)  NOT NULL AFTER `quantity_into`, ADD COLUMN `deliver_quantity` varchar(250)  NOT NULL AFTER `quantity_into`");
				
			}
			
		} 
		
		$old_table = 'check_pincode_p';
		
		$old_table_teack = $table_prefix . "$old_table";
		
		if($wpdb->get_var( "show tables like '$old_table_teack'") == $old_table_teack){
			
			$q_reinter="INSERT INTO $wp_track_members_table SELECT * FROM $old_table_teack";
			
			$wpdb->query($q_reinter);
			
			$sql_drop = "DROP TABLE  $old_table_teack";
						
			$wpdb->query($sql_drop);			
						
		}
		$table_name = $wpdb->prefix . 'pincode_setting_pro';
		
		if($wpdb->get_var( "show tables like '$table_name'") != $table_name) 
		{
			
			$sql = "CREATE TABLE $table_name (
			`id` int(11) NOT NULL AUTO_INCREMENT,
			`del_help_text` text NOT NULL,
			`cod_help_text` text NOT NULL, 
			`cod_msg1` text NOT NULL, 
			`cod_msg2` text NOT NULL, 
			`error_msg` text NOT NULL,
			`del_date` int(11) NOT NULL, 
			`cod` int(11) NOT NULL,
			`s_s` int(11) NOT NULL, 
			`s_s1` int(11) NOT NULL, 
			`cod_p` int(11) NOT NULL,
			`delv_by_cart` int(11) NOT NULL,
			`val_checkout` int(11) NOT NULL,
			`bgcolor` varchar(250) NOT NULL, 
			`textcolor` varchar(250) NOT NULL, 
			`bordercolor` varchar(250) NOT NULL, 
			`buttoncolor` varchar(250) NOT NULL, 
			`buttontcolor` varchar(250) NOT NULL, 
			`ttbordercolor` varchar(250) NOT NULL, 
			`ttbagcolor` varchar(250) NOT NULL, 
			`tttextcolor` varchar(250) NOT NULL, 
			`devbytcolor` varchar(250) NOT NULL, 
			`codtcolor` varchar(250) NOT NULL, 
			`datecolor` varchar(250) NOT NULL, 
			`codmsgcolor` varchar(250) NOT NULL, 
			`errormsgcolor` varchar(250) NOT NULL, 
			`image_size` varchar(250) NOT NULL, 
			`image_size1` varchar(250) NOT NULL, 
			`help_image` text NOT NULL, 
			`date_time` DATETIME NULL,
			PRIMARY KEY id (id));";

			require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
			
			dbDelta( $sql );
			
			$rows_affected = $wpdb->insert( $table_name, array(
				'del_help_text' => 'Delivery Date Help Text',
				'cod_help_text' => 'COD Help Text',
				'cod_msg1' => 'Available',
				'cod_msg2' => 'Not Available',
				'error_msg' => 'Please Enter Valid Pincode',
				'del_date' => '1',
				'cod' => '1',
				's_s' => '1',
				's_s1' => '1',
				'cod_p' => '1',
				'delv_by_cart' => '1',
				'val_checkout' => '0',
				'bordercolor' => '#e5e1e1',
				'ttbagcolor' => '#444446',
				'del_help_text' => 'Delivery Date Help Text', 
				'bgcolor' => '#f6f6f8', 
				'textcolor' => '#737070', 
				'buttoncolor' => '#444446', 
				'buttontcolor' => '#ffffff', 
				'ttbordercolor' => '#444446', 
				'errormsgcolor' => '#d95252', 
				'tttextcolor' => '#ffffff')
			
			);

			dbDelta( $rows_affected );
			
		}/* else{
		
			require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
			
			$rows_affected = $wpdb->query( "UPDATE $table_name SET `bordercolor` = '#e5e1e1',`ttbagcolor` = '#444446', `bgcolor` = '#f6f6f8', `textcolor` = '#737070', `buttoncolor` = '#444446', `buttontcolor` = '#ffffff', `ttbordercolor` = '#444446', `errormsgcolor` = '#d95252','tttextcolor' = '#ffffff' WHERE id != '' " );
			
			dbDelta( $rows_affected );
		} */
		
		// dbDelta( $wpdb->query( "ALTER TABLE `$wp_track_members_table` MODIFY pincode varchar(255)") );
		
	}
	
	require_once(dirname(__FILE__).'/import_page.php');

	require_once(dirname(__FILE__).'/list_pincodes.php');

	require_once(dirname(__FILE__).'/add_pincode.php');
	
	require_once(dirname(__FILE__).'/pincode_shortcode.php');
	
	require_once(dirname(__FILE__).'/pincode_widget.php');
	
	add_action( 'admin_menu', 'register_my_custom_menu_page' ); //for admin menu


	function register_my_custom_menu_page() {
        
        $plugin_dir_url =  plugin_dir_url( __FILE__ );

		add_menu_page(__('Zip Codes','pho-pincode-zipcode-cod'), __('Zip Codes','pho-pincode-zipcode-cod'), 'manage_options' , 'import_page' , '' , "$plugin_dir_url/assets/img/page_white_zip.png" , '6');

		add_submenu_page('import_page', __('Import Zip Codes','pho-pincode-zipcode-cod'), __('Import Zip Codes','pho-pincode-zipcode-cod'), 'manage_options', 'import_page', 'import_page_f');

		add_submenu_page('import_page', __('Add Zip Code','pho-pincode-zipcode-cod'), __('Add Zip Code','pho-pincode-zipcode-cod'), 'manage_options', 'add_pincode', 'add_pincodes_f');

		add_submenu_page('import_page', __('Zip Code List','pho-pincode-zipcode-cod'), __('Zip Code List','pho-pincode-zipcode-cod'), 'manage_options', 'list_pincodes', 'list_pincodes_f');

		add_submenu_page('import_page', __('Setting','pho-pincode-zipcode-cod'), __('Settings','pho-pincode-zipcode-cod'), 'manage_options', 'pincodes_setting', 'pincodes_setting');

	}
	
	$active_pincode_check = get_option('active_pincode_check');
	
	 $showpp = get_option('show_product_page');
	
	if($active_pincode_check == 1)
	{
		
		function pincode_field( $product ) {
								
			global $table_prefix, $wpdb,$woocommerce;
		
			$customer = new WC_Customer();
			
			$pro_id = get_the_ID();
			
			$_pf = new WC_Product_Factory();  

			$_product = $_pf->get_product($pro_id);
			
			$product_type =  $_product->get_type();
			
			$blog_title = site_url();
			
			$del_label =  get_option( 'woo_pin_check_del_label' );

			$cod_label =  get_option( 'woo_pin_check_cod_label' );
			
			$show_s_on_pro =  get_option( 'woo_pin_check_show_s_on_pro' );

			$show_c_on_pro =  get_option( 'woo_pin_check_show_c_on_pro' );
			
			$state_based_pincode =  get_option( 'state_based_pincode' );

			$show_d_d_on_pro =  get_option( 'woo_pin_check_show_d_d_on_pro' );
			
			$valpp = get_option('val_product_page');
			
			$show_d_est = get_option('show_deli_est');
			
			$show_cod_a = get_option('show_cod_a');
			
			$pincode_length = get_option('pincode_length');
			
			$checkpin_text =  get_option( 'woo_pin_check_checkpin_text' );
			
			// echo 'sdghedgrgtfdesg';
			
			if($product_type != 'external' && $_product->is_downloadable('yes') != 1 && $_product->is_virtual ('yes') != 1) 
			{
				
				?>
					<script>
					
						var usejs = 1;
		
					</script>
					<input type="hidden" value="<?php echo $pro_id; ?>" id="phoen_product_id" />
				<?php
				
				//echo "<script src=".plugin_dir_url( __FILE__ ) . '/assets/js/custom.js'."></script>";
				
				$plugin_dir_url =  plugin_dir_url( __FILE__ );

				$ship_pin = $customer->get_shipping_postcode();
				
				if(isset($_COOKIE['valid_pincode']))
				{
					
					$cookie_pin = $_COOKIE['valid_pincode'];
					
					$valid_state = isset($_COOKIE['valid_state'])?$_COOKIE['valid_state']:'';
					
					$star_pincode = substr($cookie_pin, 0, 3).'*';
					
				}
				
				$qry22 = $wpdb->get_results("SELECT * FROM `".$table_prefix."pincode_setting_pro` ORDER BY `id` ASC  limit 1",ARRAY_A);
					
				$table_pin_codes = $table_prefix."check_pincode_pro";
				
				$ppook = "SELECT state FROM `$table_pin_codes`";
							
				$ftc_ary = $wpdb->get_results($ppook);
				
				$state_list1=array();
				$state_list2=array();
				
				if(isset($ftc_ary) && is_array($ftc_ary)){
					foreach($ftc_ary as $key =>$value){
						$state_list1[]=$value->state;
					}
				}else{
					$state_list1=array();
				}
				
			 
			
			
				$phen_pincodes_list = get_post_meta( $pro_id, 'phen_pincode_list' ,true);
				
				
				
				if(isset($phen_pincodes_list) && is_array($phen_pincodes_list)){
					
					foreach($phen_pincodes_list as $ky => $knum){
						
						$state_list2[]=$knum[2];
						
					}
				}else{
					$state_list2=array();
				}
				
				$result=array();
				
				if((isset($state_list1) && !empty($state_list1)) || (isset($state_list2) && !empty($state_list2))){
					
					$result = array_merge($state_list1, $state_list2);
					
				}
				
					
				if(isset($result)&&is_array($result)){
					
					$ftc_ary_unique=array_unique($result);
					
				}
				
				$phen_pincodes_list = get_post_meta( $pro_id, 'phen_pincode_list' ,true);
				
				$phen_pincodes_list_1 = get_post_meta( $pro_id, 'phen_pincode_list' );
				
				$phen_pincodes_min = get_post_meta( $pro_id, 'phen_pincode_list' );
				
				if( isset($_COOKIE['valid_pincode']) && $cookie_pin != '' )
				{
					if((isset($phen_pincodes_list_1[0]) && is_array($phen_pincodes_list_1[0]) && count($phen_pincodes_list_1[0] )== 0) || (isset($phen_pincodes_list_1) &&is_array($phen_pincodes_list_1) && count($phen_pincodes_list_1 )== 0) )
					{
					
						if(!isset($cookie_pin) && $ship_pin != ''){
							
							$cookie_pin = $ship_pin;
						}
						
						$num_rows = $wpdb->get_var( $wpdb->prepare( "SELECT COUNT(*) FROM `".$table_prefix."check_pincode_pro` where `pincode` = %s" , $cookie_pin ) );
						
						$like = false;
						
						
						if( $num_rows == 0  )
						{
							
							$pincode = substr($cookie_pin, 0, 3);
							
							$num_rows = $wpdb->get_var( $wpdb->prepare( "select COUNT(*) from `".$table_prefix."check_pincode_pro` where `pincode` LIKE %s ", $wpdb->esc_like($pincode) .'*%' ) );
							
							$like = true;
							
							//echo 'count1:'.$count;
							
						}
						
						if($num_rows == 0)
						{

							$cookie_pin = '';

						}
					
						if( $like )
						{
							
							$pincode = substr($cookie_pin, 0, 3);
								
							$query = " SELECT * FROM `".$table_prefix."check_pincode_pro` where `pincode` LIKE '".$wpdb->esc_like($pincode) ."*%'";
							
						}
						else
						{
							
							$query = " SELECT * FROM `".$table_prefix."check_pincode_pro` where `pincode` = '$cookie_pin' ";
							
						}
						
						$getdata = $wpdb->get_results($query);
						
						
						
						foreach($getdata as $data) {
					
							$dod =  $data->dod;
							
							$dod_name =  $data->dod_name;

							$cod =  $data->cod;
							
							$state =  $data->state;

							$city =  $data->city;
							
							$deliver_by =  $data->deliver_by;
							
							$time_hrs =  $data->time_hrs;
							
							$time_minuts =  $data->time_minuts;

						}
						
					}
					else
					{
						
						$phen_pincode_list = $phen_pincodes_list;
						
						if (isset($cookie_pin) && is_array($phen_pincode_list) && array_key_exists( $wpdb->esc_like($cookie_pin),$phen_pincode_list ) )
						{
							$safe_zipcode = $cookie_pin;
							
							$dod = $phen_pincode_list[$safe_zipcode][3];
							
							$dod_name = $phen_pincode_list[$safe_zipcode][5];
								
							$state = $phen_pincode_list[$safe_zipcode][2];
							
							$city = $phen_pincode_list[$safe_zipcode][1];
							
							$cod = $phen_pincode_list[$safe_zipcode][4];
							
							$deliver_by = $phen_pincode_list[$safe_zipcode][6];
							
							$time_hrs = $phen_pincode_list[$safe_zipcode][7];
							
							$time_minuts = $phen_pincode_list[$safe_zipcode][8];
							
						}
						elseif(isset($star_pincode) && is_array($phen_pincode_list) && array_key_exists(  $star_pincode,$phen_pincode_list ) )
						{
							
							$safe_zipcode = $cookie_pin;
							
							$dod = $phen_pincode_list[$star_pincode][3];
							
							$dod_name = $phen_pincode_list[$star_pincode][5];
							
							$state = $phen_pincode_list[$star_pincode][2];
							
							$city = $phen_pincode_list[$star_pincode][1];
							
							$cod = $phen_pincode_list[$star_pincode][4];
							
							$deliver_by = $phen_pincode_list[$star_pincode][6];
							
							$time_hrs = $phen_pincode_list[$star_pincode][7];
							
							$time_minuts = $phen_pincode_list[$star_pincode][8];
							
						}
						else
						{
							
							$cookie_pin = '';
							
						}
						
					}	
					
				}
				
				 $area_wise_delivery =  get_option( 'area_wise_delivery' );	
				
				$phen_pincodes_list = get_post_meta( $pro_id, 'phen_pincode_list',true);
				
				$area_list=array();
				$city_list=array();
				$num_1=2;
				$num_11=11;
				
			
				
				if(isset($phen_pincodes_list) && is_array($phen_pincodes_list) && count($phen_pincodes_list) > 0){
					
					foreach($phen_pincodes_list as $min =>$main){
						$area_list[]= isset($main[$num_11]) ? sanitize_text_field($main[$num_11]):'';
						$city_list[]= isset($main[$num_1]) ? sanitize_text_field($main[$num_1]):'';
					}
						
				}else{
					
					$table_pin_codes = $table_prefix."check_pincode_pro";
					
					$ppook = "SELECT * FROM `$table_pin_codes`";
							
					$ftc_ary = $wpdb->get_results($ppook);
					
					if(isset($ftc_ary) && is_array($ftc_ary)){
						foreach($ftc_ary as $key =>$value){
							$area_list[$value->pincode]=$value->area;
							$city_list[]=$value->city;
						}
					}
					
				}
			
				if(isset($city_list)&&is_array($city_list)){
					
					$area_list_unique=array_unique($area_list);
					
					$city_list_unique=array_unique($city_list);
					
				}
				
				$textascheck = get_option('textascheck');

				$checkpintext = get_option('checkpintext');
				
				if(isset($cookie_pin) && $cookie_pin != ''){
				
				
					if($deliver_by=="day"){
								
						if($dod >= 1)
						{
							
							for($i=1; $i<=$dod; $i++)
							{
									$dd = date("D", strtotime("+ $i day"));
									
									if($qry22[0]['s_s'] == 0)
									{			
								
										if($dd == 'Sat')
										{	
									
											$dod++;	
										}
										
									}
									
									if($qry22[0]['s_s1'] == 0)
									{
										
										if($dd == 'Sun')
										{	
									
											$dod++;	
										}
										
									}
									
							}
							
							$delivery_date = date("D, jS M", strtotime("+ $dod day"));
							
						}else{
							
							 $delivery_date = date("D, jS M");
							 
						}
					}elseif($deliver_by=="time_picker"){
						
						// echo 'tghrhrt';
						
						$start = current_time('Y-m-d H:i');
					
						 if(!empty($time_hrs) && !empty($time_minuts)){
							 
							 $delivery_date=date("d-m-Y H:i", strtotime("+$time_hrs hours +$time_minuts minutes",strtotime($start)));
							 
						 }elseif(!empty($time_minuts)){
							 
							  $delivery_date=date("d-m-Y H:i", strtotime("+$time_minuts minutes",strtotime($start)));
							 
						 }else{
							 
							  $delivery_date=date("d-m-Y H:i", strtotime("+$time_hrs hours",strtotime($start)));
							  
						 }
						 
						

					}elseif($deliver_by=="quantity"){
						 
						$delivery_date="Quantity Based";
							
					}
					else
					{
					
						if($dod_name!='')
						{
							$delivery_date =  date('D, jS M', strtotime("next $dod_name"));
						
						}else{
							
							$delivery_date = '';
						}
						
					}
				
					$customer->set_shipping_postcode($cookie_pin);
					
					$user_ID = get_current_user_id();
					
					if(isset($user_ID) && $user_ID != 0) {
						
						update_user_meta($user_ID, 'shipping_postcode', $cookie_pin); //for setting shipping postcode
						
					}
					$availableat_text =  get_option( 'availableat_text' );

				// echo $area_list_unique;
					?>
					<div style="clear:both;font-size:14px;" class="wc-delivery-time-response">
						
						<span class='avlpin' id='avlpin'>
							<span class="phoe-green-location-icon">
								<img src="<?php echo esc_url( $plugin_dir_url ); ?>assets/img/phoeniixx_pin_location_icon.png" />
							</span>
							<p id="avat"><span class="pincode_static_text"><?php  echo !empty($availableat_text)?$availableat_text:'Available at'; ?> <?php echo esc_html( $cookie_pin ); if( $show_s_on_pro == 1 || $show_c_on_pro == 1 ){ echo "</span><br /><span class='pincode_custom_text'>("; } if($show_c_on_pro == 1){ echo $city; } if( $show_s_on_pro == 1 && $show_c_on_pro == 1 ){ echo ", "; } if($show_s_on_pro == 1){ echo $state; } if( $show_s_on_pro == 1 || $show_c_on_pro == 1 ){ echo ")</span>"; } ?></p><a class="button" id='change_pin'><img src="<?php echo esc_url( $plugin_dir_url ); ?>assets/img/phoeniixx_pin_pencil_logo.png" /></a>
						</span>
						
						<div class="pin_div" id="my_custom_checkout_field2" style="display:none;">
							
							<p id="pincode_field_idp" class="form-row my-field-class form-row-wide">

								<label class="" for="pincode_field_id"><?php _e('Check Availability At', 'pho-pincode-zipcode-cod'); ?></label>

								<span class="<?php if($area_wise_delivery !==1 && $state_based_pincode==1){ echo 'phoen_state_upper_min_xox'; } if($area_wise_delivery!=1){ echo ' input-block';  }?>">
									
									<span class="loader_div">
								
										<?php if($area_wise_delivery==1){ ?>
										
											<div class="phoen_state_upper">
												<div class="phoen_city_1">
													<select name="city_list" class="city_list" id="phoen_city_list" <?php if($valpp == 1) { ?> required="required" <?php } ?> data-mine="<?php echo $pro_id;?>" data-lol="<?php echo esc_html( $cookie_pin ); ?>">
													
															<option value=""><?php _e('Select Location', 'pho-pincode-zipcode-cod'); ?></option>
															<?php
															foreach($city_list_unique as $key =>$value){
																?>
																<option value="<?php echo  $value;?>" <?php if($valid_state==$value){ echo 'selected'; } ?>><?php echo  $value;?></option>
																<?php	
															}
															?>
													</select>
												</div>
												<div class="phoen_area" id="phoen_area_select_1">
													<select name="area_list" class="area_list" id="phoen_area_list" <?php if($valpp == 1) { ?> required="required" <?php } ?>>
														<option value=""><?php _e('Select Area', 'pho-pincode-zipcode-cod'); ?></option>
															<?php
															foreach($area_list_unique as $key =>$value1){
																?>
																<option value="<?php echo  $value1;?>" <?php if($cookie_pin==$value1){ echo 'selected'; } ?>><?php echo  $value1;?></option>
																<?php	
															}
															?>
													</select>
												</div>
											</div>
										
											<?php
										}else{
											
											if($state_based_pincode==1){
												?>
												<select name="state_list" class="state_list" id="phoen_state_list_shop">
													<option value=""><?php _e('Select your state', 'pho-pincode-zipcode-cod'); ?></option>
													<?php
													
													foreach($ftc_ary_unique as $key =>$value){
														?>
														<option value="<?php echo  $value;?>"  <?php if($valid_state==$value){ echo 'selected'; } ?>><?php echo  $value;?></option>
														<?php	
													}
													?>
												</select>
												
												<?php
											}?>
											<span class="phoen_pincode_span_min"> 
											<input type="text" <?php if($valpp == 1) { ?> required="required" <?php } ?> value="<?php echo esc_html( $cookie_pin ); ?>" placeholder="<?php echo $checkpin_text; ?>" id="pincode_field_id" maxlength="<?php echo $pincode_length; ?>" name="pincode_field" data-mine="<?php echo $pro_id; ?>" class="input-text pincode_field_id_a" />
											</span>
											<?php
										}
										?>
										<span id="chkpin_loader" style="display:none">
								
											<img alt="ajax-loader" src="<?php echo esc_url( $plugin_dir_url ); ?>assets/img/ajax-loader.gif"/>
											
										</span>
									</span>
									<a class="button <?php echo ($textascheck==1)?'phoen_text_inserted':'phoen_text_removed'; ?>" id="checkpin"><?php echo ($textascheck==1)?$checkpintext:''; ?></a>
								
								</span><!--input-block-->

								
								
							</p>
							
								<div class="error_pin" id="error_pin" style="display:none"><?php if($qry22[0]['error_msg'] != '' ){ echo esc_html( $qry22[0]['error_msg'] ); }else{ echo "Invalid pincode entered"; } ?></div>
									
										<?php
								
											$error_msg_b =  get_option( 'woo_pin_check_error_msg_b' );
										
										?>
									
									<div class="error_pin" id="error_pin_b" style="display:none"><?php echo $error_msg_b;  ?></div>
									
							
						</div>
				
						<div class="delivery-info-wrap">
							
							<div class="delivery-info animated">
							
							<?php 
							
								if($show_d_est == 1)
								{
									
									
									?>
									<div class="header">
								
										<div class="phoe-pincode-pro-tick-img">
											<img  src="<?php echo esc_url( $plugin_dir_url ); ?>assets/img/Phoeniixx_Pin_green_tick.png" />
											<img src="<?php echo esc_url( $plugin_dir_url ); ?>assets/img/phoeniixx_pin_calander.png" />
										</div>
										<div class="phoe-pincode-pro-tick-img">
											<span><h6><?php if($del_label == '' ){ echo "Delivered By"; }else { echo $del_label; } ?></h6></span>
											
												<?php
												
												if($qry22[0]['del_date'] == 1)
												{
													
													?>
													
														<a id="delivery_help_a" class="delivery-help-icon"><?php if($qry22[0]['help_image'] != ''){ ?><img height="<?php echo esc_html( $qry22[0]['image_size'] ); ?>" width="<?php echo esc_html( $qry22[0]['image_size1'] ); ?>" class="help_icon_img" alt="?" src="<?php echo esc_url( $qry22[0]['help_image'] ); ?>"><?php } else { ?> <img class="help_icon_img" alt="?" src="<?php echo esc_url( $plugin_dir_url ); ?>assets/img/phoeniixx_pin_question_mark.png"> <?php } ?></a>
													
													<?php

												}
												
												?>	
												
													<div class="phoen_delivery">
									
														<ul class="ul-disc">
							
															<li>
							
																<?php 
																	// echo $delivery_date
																if($dod!='0' && $deliver_by=="day")
																{
																	if($show_d_d_on_pro == 1)
																	{
																		echo $delivery_date;
																	}
																	else
																	{
																		echo $dod." days";
																	}
																	
																}elseif($dod=='0' && $deliver_by=="day"){
																	
																	if($show_d_d_on_pro == 1)
																	{
																		echo $delivery_date;
																	}
															
																}elseif($deliver_by=="time_picker"){
																	
																	echo $delivery_date;
																	
																}elseif($deliver_by=="quantity"){
						 
																	echo "Quantity Based";
																		
																}
																else{
																	
																	if($show_d_d_on_pro==1 && $dod_name!='')
																	{
																		
																		echo date('D, jS M', strtotime("next $dod_name"));
																		
																	}else{
																		
																		if($dod!='0')
																		{
																			echo $data->dod." days";
																			
																		}else{
																			// echo '54545454';
																			echo date('D, jS M', strtotime("next $dod_name"));
																		}	
																	}
																	
																} 
															
																
																
																?>
							
															</li>
							
														</ul>
							
													</div>
												<?php
												
												if($qry22[0]['del_date'] == 1)
												{
													?>		
													<div class="delivery_help_text_main width_class" style="display:none">
														
														<div class="delivery_help_text width_class">
															
															<?php
															

																	echo esc_html( $qry22[0]['del_help_text'] );
																
															?>
															
														</div>
													</div>
												
												<?php
												}
										?>
										</div>
									</div>
								<?php
								}
								?>
								<div class="cash-on-delivery-info-wrap">
								
									<div class="cash-on-delivery-info">
										<?php
										if($show_cod_a == 1)
										{
										?>
											<div class="header">
										 <div class="phoe-pincode-pro-tick-img">
										
													<?php 
												if($cod == 'yes')
												{?>

													<img class="phoen_chk_avail" src="<?php echo $plugin_dir_url.'assets/img/Phoeniixx_Pin_green_tick.png' ; ?>" />

												<?php }
												else
												{?>
												
													<img class="phoen_chk_avail" src="<?php echo esc_url( $plugin_dir_url ); ?>assets/img/phoeniixx_pin_cross.png" />

												<?php }
											
											?>
												<img src="<?php echo esc_url( $plugin_dir_url ); ?>assets/img/phoeniixx_pin_coins.png" />
											</div> 
											
											<div class="phoe-pincode-pro-tick-img">
											
												<h6><?php if($cod_label == '' ){ echo "Cash On Delivery"; }else { echo $cod_label; } ?></h6>
												<?php
												if($qry22[0]['cod'] == 1)
												{
													?>
														<a id="cash_n_delivery_help_a" class="cash-on-delivery-help-icon"><?php if($qry22[0]['help_image'] != ''){ ?><img height="<?php echo esc_html( $qry22[0]['image_size'] ); ?>" width="<?php echo esc_html( $qry22[0]['image_size1'] ); ?>" class="help_icon_img" alt="?" src="<?php echo esc_url( $qry22[0]['help_image'] ); ?>"><?php } else { ?> <img class="help_icon_img" alt="?" src="<?php echo esc_url( $plugin_dir_url ); ?>assets/img/phoeniixx_pin_question_mark.png"> <?php } ?></a>
													<?php
												}
												?>
												<div class="cash-on-delivery">

													<?php
													if($cod == 'yes')
													{


															echo esc_html( $qry22[0]['cod_msg1'] );

													}
													else
													{
													

														echo esc_html( $qry22[0]['cod_msg2'] );

													}

													?>

												</div>
												<?php
												if($qry22[0]['cod'] == 1)
												{
												?>
													<div class="cash_on_delivery_help_text_main width_class" style="display:none;">
														
														<div class="cash_on_delivery_help_text width_class">
																	
																<?php
																
																	echo esc_html( $qry22[0]['cod_help_text'] );
																
																?>
																
														</div>
													</div>
												
												<?php
											}
											?>
											</div>
											</div>
										<?php
										}
										?>										
									</div>

								</div>		

							</div>

						 </div>

					</div>

					<?php

				}
				else
				{
					
					$availableat_text =  get_option( 'availableat_text' );
					
					?>	
						<div style="clear:both;font-size:14px;" class="wc-delivery-time-response">
						
							<span class='avlpin' id='avlpin' style="display:none">
								<span class="phoe-green-location-icon">
									<img src="<?php echo esc_url( $plugin_dir_url ); ?>assets/img/phoeniixx_pin_location_icon.png" />
								</span>
								<p id="avat"><span class="pincode_static_text"><?php echo !empty($availableat_text)?$availableat_text:'Available at'; ?> <?php echo esc_html( $cookie_pin ); if( $show_s_on_pro == 1 || $show_c_on_pro == 1 ){ echo "</span><br /><span class='pincode_custom_text'>("; } if($show_c_on_pro == 1){ echo $city; } if( $show_s_on_pro == 1 && $show_c_on_pro == 1 ){ echo ", "; } if($show_s_on_pro == 1){ echo $state; } if( $show_s_on_pro == 1 || $show_c_on_pro == 1 ){ echo ")</span>"; } ?></p><a class="button" id='change_pin'><img src="<?php echo esc_url( $plugin_dir_url ); ?>assets/img/phoeniixx_pin_pencil_logo.png" /></a>
							</span>
						
							<div class="pin_div" id="my_custom_checkout_field2" >
							
								<p id="pincode_field_idp" class="form-row my-field-class form-row-wide">

									<label class="" for="pincode_field_id"><?php _e('Check Availability At', 'pho-pincode-zipcode-cod'); ?></label>

									<span class="<?php if($area_wise_delivery !==1 && $state_based_pincode==1){ echo 'phoen_state_upper_min_xox'; } if($area_wise_delivery!=1){ echo ' input-block';  }?>">
										
										<span class="loader_div">
										
										<?php if($area_wise_delivery==1){ ?>
										
											<div class="phoen_state_upper">
												<div class="phoen_city_1">
													<select name="city_list" <?php if($valpp == 1) { ?> required="required" <?php } ?> class="city_list" id="phoen_city_list" data-mine="<?php echo $pro_id;?>" data-lol="<?php echo esc_html( $cookie_pin ); ?>">
													
															<option value=""><?php _e('Select Location', 'pho-pincode-zipcode-cod'); ?></option>
															<?php
															foreach($city_list_unique as $key =>$value){
																?>
																<option value="<?php echo  $value;?>"><?php echo  $value;?></option>
																<?php	
															}
															?>
													</select>
												</div>
												<div class="phoen_area" id="phoen_area_select_1" >
													<select name="area_list" class="area_list" id="phoen_area_list" <?php if($valpp == 1) { ?> required="required" <?php } ?>>
														<option value=""><?php _e('Select Area', 'pho-pincode-zipcode-cod'); ?></option>
													</select>
												</div>
											</div>
										
											<?php
										}else{	

											if($state_based_pincode==1){ ?>
												<select name="state_list" class="state_list" id="phoen_state_list_shop">
													<option value=""><?php _e('Select your state', 'pho-pincode-zipcode-cod'); ?></option>
													<?php
													
													foreach($ftc_ary_unique as $key =>$value){
														?>
														<option value="<?php echo  $value;?>"><?php echo  $value;?></option>
														<?php	
													}
													?>
												</select>
												
												<?php
											} ?>
											
											
												<?php $cookie_pin=isset($cookie_pin)?$cookie_pin:''; ?>
												<span class="phoen_pincode_span_min">
												<input type="text" <?php if($valpp == 1) { ?> required="required" <?php } ?> value="<?php echo esc_html( $cookie_pin ); ?>" placeholder="<?php echo  $checkpin_text; ?>" id="pincode_field_id" maxlength="<?php echo $pincode_length; ?>" data-mine="<?php echo $pro_id; ?>" name="pincode_field" class="input-text pincode_field_id_a" /></span>
											
											<?php

										} ?>
											
											<span id="chkpin_loader" style="display:none">
									
												<img alt="ajax-loader" src="<?php echo esc_url( $plugin_dir_url ); ?>assets/img/ajax-loader.gif"/>
										
											</span>
										</span>
										<a class="button <?php echo ($textascheck==1)?'phoen_text_inserted':'phoen_text_removed'; ?>" id="checkpin"><?php echo ($textascheck==1)?$checkpintext:''; ?></a>
									
									</span><!--input-block-->

									
									
								</p>
							
								<div class="error_pin" id="error_pin" style="display:none"><?php if($qry22[0]['error_msg'] != '' ){ echo esc_html( $qry22[0]['error_msg'] ); }else{ echo "Invalid pincode entered"; } ?></div>
									
										<?php
								
											$error_msg_b =  get_option( 'woo_pin_check_error_msg_b' );
										
										?>
									
								<div class="error_pin" id="error_pin_b" style="display:none"><?php echo $error_msg_b;  ?></div>
									
							
						</div>
							
							<div class="delivery-info-wrap delivery-info-wrap2" style="display:none">
							
								<div class="delivery-info animated">
							<?php 
								if($show_d_est == 1)
								{
									?>
										<div class="header">
										<div class="phoe-pincode-pro-tick-img">
											<img class=""  src="<?php echo esc_url( $plugin_dir_url ); ?>assets/img/Phoeniixx_Pin_green_tick.jpg" />
											<img src="<?php echo esc_url( $plugin_dir_url ); ?>assets/img/phoeniixx_pin_calander.png" />
										</div>
										<div class="phoe-pincode-pro-tick-img">
											<span><h6><?php if($del_label == '' ){ echo "Delivered By"; }else { echo $del_label; } ?></h6></span>
											
												<?php
												
												if($qry22[0]['del_date'] == 1)
												{
													
													?>
													
														<a id="delivery_help_a" class="delivery-help-icon"><?php if($qry22[0]['help_image'] != ''){ ?><img height="<?php echo esc_html( $qry22[0]['image_size'] ); ?>" width="<?php echo esc_html( $qry22[0]['image_size1'] ); ?>" class="help_icon_img" alt="?" src="<?php echo esc_url( $qry22[0]['help_image'] ); ?>"><?php } else { ?> <img class="help_icon_img" alt="?" src="<?php echo esc_url( $plugin_dir_url ); ?>assets/img/phoeniixx_pin_question_mark.png"> <?php } ?></a>
													
													<?php

												}
												
												?>								
														<div class="phoen_delivery">
														
															<ul class="ul-disc">
								
																<li>
								
																	<?php 
																	
																	if(isset($dod) && $dod!='0')
																	{
																		if($show_d_d_on_pro == 1)
																		{
																			echo isset($delivery_date)?$delivery_date:'';
																		}
																		else
																		{
																			echo $data->dod." days";
																		}
																	}else{
																		
																		if(isset($dod_name) && isset($show_d_d_on_pro) &&  $show_d_d_on_pro==1 && $dod_name!='')
																		{
																			echo $dod_name ;
																			
																		}else{
																			
																			if(isset($dod) && $dod!='0')
																			{
																				echo isset($data->dod) ? $data->dod." days":'';
																				
																			}else{
																				
																				echo isset($dod_name)?$dod_name:'';
																			}	
																		}
																		
																	}
																	
																	//echo esc_html( $delivery_date ); 
																	
																	?>
								
																</li>
								
															</ul>
								
														</div>
												<?php
												if($qry22[0]['del_date'] == 1)
												{
													
													?>		
													<div class="delivery_help_text_main width_class" style="display:none">
																				
														<div class="delivery_help_text width_class">
															
															<?php
															

																	echo esc_html( $qry22[0]['del_help_text'] );
																
															?>
															
														</div>
													</div>
												
												<?php
											}
										?>
										</div>
									</div>
								<?php
								}
								?>
									<div class="cash-on-delivery-info-wrap">
									<div class="cash-on-delivery-info">
										<?php
										if($show_cod_a == 1)
										{
										?>
											<div class="header">
												<div class="phoe-pincode-pro-tick-img">
												
													<?php 
											
												if(isset($cod) && $cod == 'yes')
												{?>

													<img class="phoen_chk_avail"  src="<?php echo esc_url( $plugin_dir_url ); ?>assets/img/Phoeniixx_Pin_green_tick.png" />

												<?php }
												else
												{?>
												
													<img class="phoen_chk_avail" src="<?php echo esc_url( $plugin_dir_url ); ?>assets/img/phoeniixx_pin_cross.png" />

												<?php }
											
											?>
												
												<img src="<?php echo esc_url( $plugin_dir_url ); ?>assets/img/phoeniixx_pin_coins.png" />
											</div> 
											<div class="phoe-pincode-pro-tick-img">
												<h6><?php if($cod_label == '' ){ echo "Cash On Delivery"; }else { echo $cod_label; } ?></h6>
												<?php
												if($qry22[0]['cod'] == 1)
												{
													?>
														<a id="cash_n_delivery_help_a" class="cash-on-delivery-help-icon"><?php if($qry22[0]['help_image'] != ''){ ?><img height="<?php echo esc_html( $qry22[0]['image_size'] ); ?>" width="<?php echo esc_html( $qry22[0]['image_size1'] ); ?>" class="help_icon_img" alt="?" src="<?php echo esc_url( $qry22[0]['help_image'] ); ?>"><?php } else { ?> <img class="help_icon_img" alt="?" src="<?php echo esc_url( $plugin_dir_url ); ?>assets/img/phoeniixx_pin_question_mark.png"> <?php } ?></a>
													<?php
												}
												?>
												<div class="cash-on-delivery">

													<?php
													if(isset($cod) && $cod == 'yes')
													{


															echo esc_html( $qry22[0]['cod_msg1'] );

													}
													else
													{
													

														echo esc_html( $qry22[0]['cod_msg2'] );

													}

													?>

												</div>
												<?php
												if($qry22[0]['cod'] == 1)
												{
												?>
													<div class="cash_on_delivery_help_text_main width_class" style="display:none;">
														
														<div class="cash_on_delivery_help_text width_class">
																	
																<?php
																
																	echo esc_html( $qry22[0]['cod_help_text'] );
																
																?>
																
														</div>
													</div>
												
												<?php
											}
											?>
											</div>
											</div>
										<?php
										}
										?>										
									</div>

								</div>		

								</div>

							</div>
							
						</div>
					<?php

				}
			
			}
			else
			{
				?>
				<script>
					var usejs = 0;

				</script>
				<?php
			}
			
			?>
			<script>
			
			
			 jQuery(function(){
				 
					jQuery("select#phoen_city_list").on("change",function(){
						
						jQuery("#shop_chkpin_loader").show();
						var selected_city  = jQuery(this).val();
						var product_id = jQuery(this).attr('data-mine');
						
						var phoen_send_ajax_for_city = '<?php echo admin_url('admin-ajax.php') ;?>';
							jQuery.post(

								phoen_send_ajax_for_city,
								{
									'action'	:  'phoen_action_city_send',
									'city'	:    selected_city,
									'product_id'	:    product_id,
									'required'	:    required
								},
								function(response){
									
									jQuery("#phoen_area_select_1").html(response);	
									
									jQuery('.phoen_area #phoen_area_list').select2();
									jQuery("#shop_chkpin_loader").hide();
									
								} 

							); 
							
						
					});
				});
				jQuery(document).ready(function(){
				
					var selected_city  = jQuery.trim(jQuery('.phoen_city_1 .city_list').val());
					// jQuery("#shop_chkpin_loader").show();
					var product_id = jQuery(".phoen_city_1 .city_list").attr('data-mine');
					var area_min = jQuery(".phoen_city_1 .city_list").attr('data-lol');
					
					var phoen_send_ajax_for_city = '<?php echo admin_url('admin-ajax.php') ;?>';
				
						jQuery.post(

							phoen_send_ajax_for_city,
							{
								'action'	:  'phoen_action_city_send',
								'city'	:    selected_city,
								'area'	:    area_min,
								'product_id'	:    product_id,
								'required'	:    required
							},
							function(response){
								jQuery("#shop_chkpin_loader").hide();
								jQuery("#phoen_area_select_1").html(response);	
								jQuery('.phoen_area #phoen_area_list').select2();
							} 

						); 
						
				});
				
			</script>
			<?php
			
		}

		// Pincode Based Charge Start
			
		function phoen_cod_fee_main( $cart_object ) {

			global $table_prefix, $wpdb,$woocommerce;
			
			$table_pin_codes = $table_prefix."check_pincode_pro";
			
			$safe_zipcode='';
			$pincode='';
				
			parse_str($_POST["post_data"], $person_post);
				
			if(!empty($person_post) && $person_post["ship_to_different_address"]==1){
				
				$post_zipcode=$person_post['shipping_postcode'];
				
			}else{
				
				$post_zipcode=$person_post['billing_postcode'];
				
			}
			
			if(isset($_COOKIE['phoen_new_valid_pincode']) && empty($post_zipcode)){
						
				$safe_zipcode = $_COOKIE['phoen_new_valid_pincode'];
						
			}else{
				
				$safe_zipcode = $post_zipcode;
				
			}
			// echo $safe_zipcode;die();
			
			$pincode = substr($safe_zipcode, 0, 3);
			
			foreach($cart_object->cart_contents as $key => $value){
				
				$product_id = $value['product_id'];
				
				$quantity = $value['quantity'];
				
				$phen_pincodes_list = get_post_meta( $product_id, 'phen_pincode_list',true );
			
				$query_maine='';
			
				if(!empty($safe_zipcode)){
					
					$total_cod_charge=array();
					
					if((is_array($phen_pincodes_list) && count($phen_pincodes_list)==0) || empty($phen_pincodes_list)){
						
						$count = $wpdb->get_var( $wpdb->prepare( "select COUNT(*) from $table_pin_codes where `pincode` = %s ", $safe_zipcode ) );
								
						$like = false;
						
						if( $count == 0  )
						{
							$count_query = "SELECT * FROM `$table_pin_codes` where pincode LIKE '".$wpdb->esc_like($pincode)."%'";
									
							$count_array = $wpdb->get_results($count_query);
							
							$count=count($count_array);
							
							$like = true;
						
						}
						
						// print_r($count_array);die();
						
						if( $count !== 0 )
						{

							if( $like && strpos($count_array->pincode, '*') !== false)
							{
								
								$query_maine = "SELECT * FROM `$table_pin_codes` where pincode LIKE '".$pincode."%'";
								
							}
							else
							{
								
								$query_maine = "SELECT * FROM `$table_pin_codes` where pincode='$safe_zipcode'"; 
								
							}

						}else{
							
							return false;
							
						}
					
						$ftc_ary = $wpdb->get_results($query_maine);
						
						
						
						if(isset($ftc_ary) && is_array($ftc_ary)){
							
							$quantity_into=isset($ftc_ary[0]->quantity_into)?$ftc_ary[0]->quantity_into:0;
						
							$cod_charge=isset($ftc_ary[0]->cod_charge)?$ftc_ary[0]->cod_charge:0;
							
							if($quantity_into==1){
								
								$total_cod_charge[]=$cod_charge*$quantity;
								
							}else{
								
								$total_cod_charge[]=$cod_charge;
								
							}
						}
						
							
					}else{
						
						// echo '1';die();
						
						$phen_pincode_list = isset($phen_pincodes_list[0])?$phen_pincodes_list[0]:$phen_pincodes_list;
							
						if (isset($safe_zipcode) && is_array($phen_pincode_list) && array_key_exists( $wpdb->esc_like($safe_zipcode),$phen_pincode_list ) )
						{
							$cod_charge = $phen_pincode_list[$safe_zipcode][9];
							
							$quantity_into = $phen_pincode_list[$safe_zipcode][10];
							
							if($quantity_into==1){
							
								$total_cod_charge[]=$cod_charge*$quantity;
								
							}else{
								
								$total_cod_charge[]=$cod_charge;
								
							}
							
							
						}
						elseif(isset($pincode) && is_array($phen_pincode_list) && array_key_exists(  $pincode,$phen_pincode_list ) )
						{
							
							$cod_charge = $phen_pincode_list[$safe_zipcode][9];
							
							$quantity_into = $phen_pincode_list[$safe_zipcode][10];
							
							if($quantity_into==1){
							
								$total_cod_charge[]=$cod_charge*$quantity;
								
							}else{
								
								$total_cod_charge[]=$cod_charge;
								
							}
						}
						
					}
				}
				
			}
	
			
			$cod_charges='';
			
			if(isset($total_cod_charge) && !empty($total_cod_charge)){
				
				$cod_charges=array_sum($total_cod_charge);
				
			}
			
			// echo $cod_charges;die();
			
			$chosen_gateway = isset($_POST['payment_method'])?$_POST['payment_method']:'';
			
			$enable_cod = get_option( 'enable_cod' );
	
			if ( $chosen_gateway == 'cod' && $cod_charges!='' && $enable_cod==1) { //test with cod method
			
				
				WC()->cart->add_fee( 'COD charge', $cod_charges, false, '' );
				
			}/* else{
				
				WC()->cart->add_fee( 'COD charge', 0, false, '' );
				
			} */
			
		}
		
		add_action( 'woocommerce_cart_calculate_fees','phoen_cod_fee_main' );
					
		function phoen_cod_fee_main_script() {
			
			if (is_checkout()) :
			?>
			<script>
				jQuery( function( $ ) {
					
					// woocommerce_params is required to continue, ensure the object exists
					if ( typeof woocommerce_params === 'undefined' ) {
						return false;
					}
					
					$checkout_form = $( 'form.checkout' );
						
					$checkout_form.on( 'change', 'input[name="payment_method"]', function() {
							// $checkout_form.trigger( 'update' );
					});
					
				});
			</script>
			<?php
			endif;
		}
		
		// add_action( 'wp_footer', 'phoen_cod_fee_main_script', 999 );	
		
		
		// Pincode Based Charge End
		
		add_action( 'woocommerce_after_order_notes', 'checkout_page_function' , 10, 1 ); //for checkout page functionality

		function checkout_page_function() {
			
			global $table_prefix, $wpdb, $woocommerce;
			
			$blog_title = site_url();
			
			$cookie_pin = isset($_COOKIE['valid_pincode'])?$_COOKIE['valid_pincode']:'';
			 
			$show_error =  0;
			
			$qry22 = $wpdb->get_results("SELECT * FROM `".$table_prefix."pincode_setting_pro` ORDER BY `id` ASC  limit 1",ARRAY_A);
			 
			if (isset( $cookie_pin ) )
			{		
		
				$customer = new WC_Customer();

				$customer->set_shipping_postcode($cookie_pin);
				
				$user_ID = get_current_user_id();
				
				$current_pcode = get_user_meta($user_ID, 'shipping_postcode');
				
				//$customer = new WC_Customer();
				
				if(isset($user_ID) && $user_ID != 0)
				{
					
					update_user_meta( $user_ID, 'shipping_postcode', $cookie_pin );
					
					if($current_pcode[0] != $cookie_pin)
					{
						
						header("Refresh:0");
						
					}
					
				}
				
				$items = $woocommerce->cart->get_cart();
				
				$star_pincode = substr($cookie_pin, 0, 3).'*';

				foreach($items as $item => $values) {
		
					$_product_id = $values['product_id'];
					
					$phen_pincodes_list = get_post_meta( $_product_id, 'phen_pincode_list' );
					
					if( count( $phen_pincodes_list )	== 0 )
					{
						
						$safe_zipcode = $cookie_pin;
				
						$pincode = substr($cookie_pin, 0, 3);
						
						$show_d_d_on_pro =  get_option( 'woo_pin_check_show_d_d_on_pro' );
						
						$table_pin_codes = $table_prefix."check_pincode_pro";
						
						if( $safe_zipcode )
						{
							
							$count = $wpdb->get_var( $wpdb->prepare( "select COUNT(*) from $table_pin_codes where `pincode` = %s ", $safe_zipcode ) );
							
							$like = false;
							
							//echo 'count:'.$count;
							
							if( $count == 0  )
							{
								
								$count = $wpdb->get_var( $wpdb->prepare( "select COUNT(*) from $table_pin_codes where `pincode` LIKE %s ", $wpdb->esc_like($pincode) .'*%' ) );
								
								$like = true;
								
								//echo 'count1:'.$count;
								
							}
							
							if( $count == 0 )
							{

							   //echo "0";  
							   $show_error++;

							}
							else
							{
								
								if( $like )
								{
									
									$query = "SELECT * FROM `$table_pin_codes` where pincode LIKE '".$wpdb->esc_like($pincode) ."%'";
									
								}
								else
								{
									
									$query = "SELECT * FROM `$table_pin_codes` where pincode='$safe_zipcode'"; 
									
								}
								
								//echo $query;
								
								$ftc_ary = $wpdb->get_results($query);
								
								$show_error =  count($ftc_ary);
								
								if($show_error == 0)
								{
									
									$show_error++;
									
								}

							}
							
						}
						
					}
					else
					{
						
						$phen_pincode_list = $phen_pincodes_list[0];
						
						if ( array_key_exists( $wpdb->esc_like($cookie_pin),$phen_pincode_list ) )
						{
							
							//echo 'in';
							
							$safe_zipcode = $cookie_pin;
							
							$dod = $phen_pincode_list[$safe_zipcode][3];
							
							$dod_name = $phen_pincode_list[$safe_zipcode][5];
								
							$state = $phen_pincode_list[$safe_zipcode][2];
							
							$city = $phen_pincode_list[$safe_zipcode][1];
							
							//$show_error++;
							
						}
						elseif( array_key_exists(  $star_pincode,$phen_pincode_list ) )
						{
							
							//echo "elseif";
							
							$safe_zipcode = $cookie_pin;
							
							$dod = $phen_pincode_list[$star_pincode][3];
							
							$dod_name = $phen_pincode_list[$star_pincode][5];
							
							$state = $phen_pincode_list[$star_pincode][2];
							
							$city = $phen_pincode_list[$star_pincode][1];
							
							//$show_error++;
							
						}
						else
						{
							
							$show_error++;
							
						}
						
					}

				}

			}
			else
			{
				
				$show_error++;
				
			}
			?>
			
				<div id="remove_pro_popup_id" class="pho-pincode-popup-body" style="display:none" >
					
					<div class="phoen-popup-div phoen_chk_pncde_anmt_div animated">
					
						<div class="pincode-pho-popup ">
						
							<div class="pho-close_btn"> &#10005; </div>
						
								<div class="pho-icon">
								
										<div class="pho-para">
										
											<p><?php _e('Shipping to this pincode', 'pho-pincode-zipcode-cod'); ?>(<span class="chng_pincode_checkout" ><?php echo $cookie_pin; ?></span>),<?php _e('not available', 'pho-pincode-zipcode-cod'); ?>. </p>
											
										</div>
										
								</div>
							
						</div> <!-- popup class end -->
					
					</div>

				</div>
				
				<script>  
				
					var remove_cod = '<?php echo $qry22[0]['cod_p']; ?>';
					
					var remove_place_order = '<?php echo get_option('woo_pin_checkplc_odr_div'); ?>';
					
					var hide_place_no_match = '<?php echo get_option('hide_place_no_match'); ?>';

					var usejs = 0;
				
				</script>
		
				<p id="err_pin_text" style="display:none;"><?php if($qry22[0]['error_msg'] != '' ){ echo esc_html( $qry22[0]['error_msg'] ); }else{ echo "Invalid pincode entered"; } ?></p>
				
				<?php
				
					$error_msg_b =  get_option( 'woo_pin_check_error_msg_b' );
				
				?>
				
				<p id="err_pin_text_b" style="display:none;"><?php if($error_msg_b != '' ){ echo esc_html( $error_msg_b ); }else{ echo "Invalid pincode entered"; } ?></p>
				
			<?php
			
		}
		
		// if both logged in and not logged in users can send this AJAX request,
		// add both of these actions, otherwise add only the appropriate one
		add_action( 'wp_ajax_nopriv_picodecheck_ajax_submit_home', 'picodecheck_ajax_submit_home' );
		
		add_action( 'wp_ajax_picodecheck_ajax_submit_home', 'picodecheck_ajax_submit_home' );

		function picodecheck_ajax_submit_home() {
			
			global $table_prefix, $wpdb;
			// echo '221';die();
			$pincode = sanitize_text_field( $_POST['pin_code'] );
			
			$state = sanitize_text_field( $_POST['state'] );
			
			$safe_zipcode = $pincode;
		
			$pincode = substr($pincode, 0, 3);
			
			$show_d_d_on_pro =  get_option( 'woo_pin_check_show_d_d_on_pro' );
			
			$state_based_pincode =  get_option( 'state_based_pincode' );
			
			$table_pin_codes = $table_prefix."check_pincode_pro";
			
			$qry22 = $wpdb->get_results("SELECT * FROM `".$table_prefix."pincode_setting_pro` ORDER BY `id` ASC  limit 1",ARRAY_A);
		
			if($safe_zipcode)
			{
				
				if($state_based_pincode==1){
					
					$count = $wpdb->get_var( $wpdb->prepare( "select COUNT(*) from $table_pin_codes where state='$state' AND `pincode` = %s ", $safe_zipcode ) );
				
					$like = false;
					
					if( $count == 0  )
					{
						
						$count = $wpdb->get_var( $wpdb->prepare( "select COUNT(*) from $table_pin_codes where state='$state' AND `pincode` LIKE %s ", $wpdb->esc_like($pincode) .'%' ) );
						
						$like = true;
												
					}
					
					if( $count == 0 )
					{
						echo "0";
					  // setcookie("valid_pincode", "", time() - 3600);

					}
					else
					{
						
						if( $like )
						{
							
							$query = "SELECT * FROM `$table_pin_codes` where state='$state' AND pincode LIKE '".$wpdb->esc_like($pincode) ."%'";
							
						}
						else
						{
							
							$query = "SELECT * FROM `$table_pin_codes` where state='$state' AND pincode='$safe_zipcode'"; 
							
						}
						
						$ftc_ary = $wpdb->get_results($query);
					
						$dod = $ftc_ary[0]->dod;
						
						$dod_name =$ftc_ary[0]->dod_name;
						
						$state = $ftc_ary[0]->state;
						
						$city = $ftc_ary[0]->city;
						
						if($dod >= 1)
						{
							
							for($i=1; $i<=$dod; $i++)
							{
									$dd = date("D", strtotime("+ $i day"));
									
									if($qry22[0]['s_s'] == 0)
									{			
								
										if($dd == 'Sat')
										{	
									
											$dod++;	
										}
										
									}
									
									if($qry22[0]['s_s1'] == 0)
									{
										
										if($dd == 'Sun')
										{	
									
											$dod++;	
										}
										
									}
									
							}
							
							$delivery_date = date("D, jS M", strtotime("+ $dod day"));
							
						}
						else
						{
							
							if($dod_name!='')
							{
								$delivery_date = $ftc_ary[0]->dod_name;
							
							}else{
								
								$delivery_date = '';
							}
							
						}
						
						
						if($ftc_ary[0]->cod == 'no')
						{
							echo "10";
							echo "####";
							if($show_d_d_on_pro == 1)
							{
								echo $delivery_date;
							}
							else
							{
								if($dod!='0')
								{
									echo $ftc_ary[0]->dod." days";
								}else{
									echo $delivery_date = $ftc_ary[0]->dod_name;
								}
							}
							echo "####";
							echo esc_html( $qry22[0]['cod_msg2'] );
							echo "####";
							echo $state;
							echo "####";
							echo $city;
										
						}
						elseif($ftc_ary[0]->cod == 'yes')
						{
							
							
							echo "11";
							echo "####";
							if($show_d_d_on_pro == 1)
							{
								echo $delivery_date;
							}
							else
							{
								if($dod!='0')
								{
									echo $ftc_ary[0]->dod." days";
								}else{
									echo $delivery_date = $ftc_ary[0]->dod_name;
								}
							}
							echo "####";
							echo esc_html( $qry22[0]['cod_msg1'] );
							echo "####";
							echo $state;
							echo "####";
							echo $city;
						}
						$show_cod_products = get_option( 'show_cod_products' );
													
						if($show_cod_products==1 && !empty ($ftc_ary[0]->product_list)){
							
							echo '####';
							echo 'reload';
							
						}
						
						setcookie("valid_pincode",$safe_zipcode,time() + (10 * 365 * 24 * 60 * 60),"/");
						
						$customer = new WC_Customer();
						
						$customer->set_shipping_postcode($safe_zipcode);
							
						$user_ID = get_current_user_id();
						
						if(isset($user_ID) && $user_ID != 0) {
							
							update_user_meta($user_ID, 'shipping_postcode', $safe_zipcode); //for setting shipping postcode
							
						}
						//echo "1";
					}
					
				}else{
					
					$count = $wpdb->get_var( $wpdb->prepare( "select COUNT(*) from $table_pin_codes where `pincode` = %s ", $safe_zipcode ) );
						
					$like = false;
					
					if( $count == 0  )
					{
						
						$count = $wpdb->get_var( $wpdb->prepare( "select COUNT(*) from $table_pin_codes where `pincode` LIKE %s ", $wpdb->esc_like($pincode) .'*%' ) );
						
						$like = true;
						
					}
					
					if( $count == 0 )
					{

					   echo "0";  
					   
					   // setcookie("valid_pincode", "", time() - 3600);

					}
					else
					{
						
						if( $like )
						{
							
							$query = "SELECT * FROM `$table_pin_codes` where pincode LIKE '".$wpdb->esc_like($pincode) ."*%'";
							
						}
						else
						{
							
							$query = "SELECT * FROM `$table_pin_codes` where  pincode='$safe_zipcode'"; 
							
						}
					
						//echo $query;
						
						$ftc_ary = $wpdb->get_results($query);
							
						$dod = $ftc_ary[0]->dod;
						
						$dod_name =$ftc_ary[0]->dod_name;
						
						$state = $ftc_ary[0]->state;
						
						$city = $ftc_ary[0]->city;
						
						if($dod >= 1)
						{
							
							for($i=1; $i<=$dod; $i++)
							{
									$dd = date("D", strtotime("+ $i day"));
									
									if($qry22[0]['s_s'] == 0)
									{			
								
										if($dd == 'Sat')
										{	
									
											$dod++;	
										}
										
									}
									
									if($qry22[0]['s_s1'] == 0)
									{
										
										if($dd == 'Sun')
										{	
									
											$dod++;	
										}
										
									}
									
							}
							
							$delivery_date = date("D, jS M", strtotime("+ $dod day"));
							
						}
						else
						{
							
							if($dod_name!='')
							{
								$delivery_date = $ftc_ary[0]->dod_name;
							
							}else{
								
								$delivery_date = '';
							}
							
						}
						
						
						if($ftc_ary[0]->cod == 'no')
						{
							echo "10";
							echo "####";
							if($show_d_d_on_pro == 1)
							{
								echo $delivery_date;
							}
							else
							{
								if($dod!='0')
								{
									echo $ftc_ary[0]->dod." days";
								}else{
									echo $delivery_date = $ftc_ary[0]->dod_name;
								}
							}
							echo "####";
							echo esc_html( $qry22[0]['cod_msg2'] );
							echo "####";
							echo $state;
							echo "####";
							echo $city;
										
						}
						elseif($ftc_ary[0]->cod == 'yes')
						{
							
							
							echo "11";
							echo "####";
							if($show_d_d_on_pro == 1)
							{
								echo $delivery_date;
							}
							else
							{
								if($dod!='0')
								{
									echo $ftc_ary[0]->dod." days";
								}else{
									echo $delivery_date = $ftc_ary[0]->dod_name;
								}
							}
							echo "####";
							echo esc_html( $qry22[0]['cod_msg1'] );
							echo "####";
							echo $state;
							echo "####";
							echo $city;
						}
						
						$show_cod_products = get_option( 'show_cod_products' );
				
						if($show_cod_products==1 && !empty ($ftc_ary[0]->product_list)){
							
							echo '####';
							echo 'reload';
													
						}
						
						setcookie("valid_pincode",$safe_zipcode,time() + (10 * 365 * 24 * 60 * 60),"/");
						
						$customer = new WC_Customer();
						
						$customer->set_shipping_postcode($safe_zipcode);
							
						$user_ID = get_current_user_id();
						
						if(isset($user_ID) && $user_ID != 0) {
							
							update_user_meta($user_ID, 'shipping_postcode', $safe_zipcode); //for setting shipping postcode
							
						}
					}
				}
				
			}
			else
			{
				
				// setcookie("valid_pincode", "", time() - 3600);
				
				echo "0";
				
			}
			
			exit;

		}
		
		
		
		add_action( 'wp_ajax_nopriv_picodecheck_check_state_list', 'picodecheck_check_state_list' );
		
		add_action( 'wp_ajax_picodecheck_check_state_list', 'picodecheck_check_state_list' );
		
		function picodecheck_check_state_list(){
			
			$product_id = sanitize_text_field( $_POST['product_id'] );
			
			$phen_pincodes_list = get_post_meta( $product_id, 'phen_pincode_list',true);
			
			if(isset($phen_pincodes_list) && count($phen_pincodes_list) >0){
				
				foreach($phen_pincodes_list as $phen_pincodes_ssd){
					?>
					<option value="<?php echo $phen_pincodes_ssd[2];?>"><?php echo $phen_pincodes_ssd[2];?></option>
					<?php
				}
				
			}else{
				echo false;
			}
			die();
			
		}
		
		
		add_action( 'wp_ajax_nopriv_picodecheck_ajax_submit_check', 'picodecheck_ajax_submit_check' );
		
		add_action( 'wp_ajax_picodecheck_ajax_submit_check', 'picodecheck_ajax_submit_check' );

		function picodecheck_ajax_submit_check() {
			
				global $table_prefix, $wpdb;

				$pincode = $_COOKIE['valid_pincode'];
				
				$qry22 = $wpdb->get_results("SELECT * FROM `".$table_prefix."pincode_setting_pro` ORDER BY `id` ASC  limit 1",ARRAY_A);
				
				if( $pincode != '' )
				{
					
					$product_id = sanitize_text_field( $_POST['product_id'] );
			
					$phen_pincodes_list = get_post_meta( $product_id, 'phen_pincode_list' );
										
					$star_pincode = substr($pincode, 0, 3).'*';
					
					//$phen_pincodes_list = get_post_meta( $pro_id, 'phen_pincode_list' );
							
					if( count($phen_pincodes_list)	== 0 )
					{
						
						$safe_zipcode = $pincode;
					
						$pincode = substr($pincode, 0, 3);
						
						$show_d_d_on_pro =  get_option( 'woo_pin_check_show_d_d_on_pro' );
						
						$table_pin_codes = $table_prefix."check_pincode_pro";
						
						if($safe_zipcode)
						{
							
							$count = $wpdb->get_var( $wpdb->prepare( "select COUNT(*) from $table_pin_codes where `pincode` = %s ", $safe_zipcode ) );
							
							$like = false;
							
							//echo 'count:'.$count;
							
							if( $count == 0  )
							{
								
								$count = $wpdb->get_var( $wpdb->prepare( "select COUNT(*) from $table_pin_codes where `pincode` LIKE %s ", $wpdb->esc_like($pincode) .'*%' ) );
								
								$like = true;
								
								//echo 'count1:'.$count;
								
							}
							
							if( $count == 0 )
							{

							   echo "0";  
							   
							   // setcookie("valid_pincode", "", time() - 3600);

							}
							else
							{
								
								if( $like )
								{
									
									$query = "SELECT * FROM `$table_pin_codes` where pincode LIKE '".$wpdb->esc_like($pincode) ."*%'";
									
								}
								else
								{
									
									$query = "SELECT * FROM `$table_pin_codes` where pincode='$safe_zipcode'"; 
									
								}
								
								//echo $query;
								
								$ftc_ary = $wpdb->get_results($query);
								
								$dod = $ftc_ary[0]->dod;
								
								$dod_name = $ftc_ary[0]->dod_name;
								
								$state = $ftc_ary[0]->state;
								
								$city = $ftc_ary[0]->city;

								if($dod >= 1)
								{
									
									for($i=1; $i<=$dod; $i++)
									{
											$dd = date("D", strtotime("+ $i day"));
											
											if($qry22[0]['s_s'] == 0)
											{			
										
												if($dd == 'Sat')
												{	
											
													$dod++;	
												}
												
											}
											
											if($qry22[0]['s_s1'] == 0)
											{
												
												if($dd == 'Sun')
												{	
											
													$dod++;	
												}
												
											}
											
									}
									
									$delivery_date = date("D, jS M", strtotime("+ $dod day"));
									
								}
								else
								{
									
									if($dod_name!='')
									{
										$delivery_date = $ftc_ary[0]->dod_name;
									
									}else{
										
										$delivery_date = '';
									}
									
								}
								
								
								if($ftc_ary[0]->cod == 'no')
								{
									echo "10";
									echo "####";
									if($show_d_d_on_pro == 1)
									{
										echo $delivery_date;
									}
									else
									{
									
										if($dod!='0')
										{
											echo $ftc_ary[0]->dod." days";
										}else{
											echo $delivery_date = $ftc_ary[0]->dod_name;
										}
										
									}
									echo "####";
									echo esc_html( $qry22[0]['cod_msg2'] );
									echo "####";
									echo $state;
									echo "####";
									echo $city;
												
								}
								elseif($ftc_ary[0]->cod == 'yes')
								{
									echo "11";
									echo "####";
									if($show_d_d_on_pro == 1)
									{
										echo $delivery_date;
									}
									else
									{
										if($dod!='0')
										{
											echo $ftc_ary[0]->dod." days";
										}else{
											echo $delivery_date = $ftc_ary[0]->dod_name;
										}
									}
									echo "####";
									echo esc_html( $qry22[0]['cod_msg1'] );
									echo "####";
									echo $state;
									echo "####";
									echo $city;
								}
								setcookie("valid_pincode",$safe_zipcode,time() + (10 * 365 * 24 * 60 * 60),"/");
								
								setcookie("valid_state",$state_min,time() + (10 * 365 * 24 * 60 * 60),"/");
								
								$customer = new WC_Customer();
					
								$customer->set_shipping_postcode($safe_zipcode);
									
								$user_ID = get_current_user_id();
								
								if(isset($user_ID) && $user_ID != 0) {
									
									update_user_meta($user_ID, 'shipping_postcode', $safe_zipcode); //for setting shipping postcode
									
								}
								
								//echo "1";
							}
							
						}
						else
						{
							
							echo "0";
							
							// setcookie("valid_pincode", "", time() - 3600);
							
						}
						
					}
					else
					{
						
						$phen_pincode_list = $phen_pincodes_list[0];
						
						if ( array_key_exists( $wpdb->esc_like($pincode),$phen_pincode_list ) )
						{
							
							//echo "if";
							
							$safe_zipcode = $pincode;
						
							$dod = $phen_pincode_list[$safe_zipcode][3];
							
							$dod_name = $phen_pincode_list[$safe_zipcode][5];
							
							$state = $phen_pincode_list[$safe_zipcode][2];
							
							$city = $phen_pincode_list[$safe_zipcode][1];
							
							$show_d_d_on_pro =  get_option( 'woo_pin_check_show_d_d_on_pro' );	
							
							if($dod >= 1)
							{
								
								for($i=1; $i<=$dod; $i++)
								{
										$dd = date("D", strtotime("+ $i day"));
										
										if($qry22[0]['s_s'] == 0)
										{			
									
											if($dd == 'Sat')
											{	
										
												$dod++;	
											}
											
										}
										
										if($qry22[0]['s_s1'] == 0)
										{
											
											if($dd == 'Sun')
											{	
										
												$dod++;	
											}
											
										}
										
								}
								
								$delivery_date = date("D, jS M", strtotime("+ $dod day"));
								
							}
							else
							{
								
								if($dod_name!='')
								{
									$delivery_date = $dod_name;
								
								}else{
									
									$delivery_date = '';
								}
								
							}
							
							
							if($phen_pincode_list[$safe_zipcode][4] == 'no')
							{
								echo "10";
								echo "####";
								if($show_d_d_on_pro == 1)
								{
									echo $delivery_date;
								}
								else
								{
									if($dod!='0')
									{
										echo $phen_pincode_list[$safe_zipcode][3]." days";
										
									}else{
										
										echo $delivery_date = $dod_name;
									}
								}
								echo "####";
								echo esc_html( $qry22[0]['cod_msg2'] );
								echo "####";
								echo $state;
								echo "####";
								echo $city;
											
							}
							elseif($phen_pincode_list[$safe_zipcode][4] == 'yes')
							{
								echo "11";
								echo "####";
								if($show_d_d_on_pro == 1)
								{
									echo $delivery_date;
								}
								else
								{
									
									
									if($dod!='0')
									{
										echo $phen_pincode_list[$safe_zipcode][3]." days";
										
									}else{
										
										echo $delivery_date = $dod_name;
									}
									
									
								}
								echo "####";
								echo esc_html( $qry22[0]['cod_msg1'] );
								echo "####";
								echo $state;
								echo "####";
								echo $city;
							}
							
							setcookie("valid_pincode",$safe_zipcode,time() + (10 * 365 * 24 * 60 * 60),"/");
							
							setcookie("valid_state",$state_min,time() + (10 * 365 * 24 * 60 * 60),"/");
							
							$customer = new WC_Customer();
					
							$customer->set_shipping_postcode($safe_zipcode);
								
							$user_ID = get_current_user_id();
							
							if(isset($user_ID) && $user_ID != 0) {
								
								update_user_meta($user_ID, 'shipping_postcode', $safe_zipcode); //for setting shipping postcode
								
							}
							
						}
						elseif( array_key_exists(  $star_pincode,$phen_pincode_list ) )
						{
								
							//echo "elseif";
							
							$safe_zipcode = $pincode;
						
							$dod = $phen_pincode_list[$star_pincode][3];
							
							$dod_name = $phen_pincode_list[$star_pincode][5];
							
							$state = $phen_pincode_list[$star_pincode][2];
							
							$city = $phen_pincode_list[$star_pincode][1];
							
							$show_d_d_on_pro =  get_option( 'woo_pin_check_show_d_d_on_pro' );

							if($dod >= 1)
							{
								
								for($i=1; $i<=$dod; $i++)
								{
										$dd = date("D", strtotime("+ $i day"));
										
										if($qry22[0]['s_s'] == 0)
										{			
									
											if($dd == 'Sat')
											{	
										
												$dod++;	
											}
											
										}
										
										if($qry22[0]['s_s1'] == 0)
										{
											
											if($dd == 'Sun')
											{	
										
												$dod++;	
											}
											
										}
										
								}
								
								$delivery_date = date("D, jS M", strtotime("+ $dod day"));
								
							}
							else
							{
								
								if($dod_name!='')
								{
									$delivery_date =$dod_name;
								
								}else{
									
									$delivery_date = '';
								}
								
							}
							
							
							if($phen_pincode_list[$star_pincode][4] == 'no')
							{
								echo "10";
								echo "####";
								if($show_d_d_on_pro == 1)
								{
									echo $delivery_date;
								}
								else
								{
									if($dod!='0')
									{
										echo $phen_pincode_list[$star_pincode][3]." days";
										
									}else{
										
										echo $delivery_date = $dod_name;
									}
								}
								echo "####";
								echo esc_html( $qry22[0]['cod_msg2'] );
								echo "####";
								echo $state;
								echo "####";
								echo $city;
											
							}
							elseif($phen_pincode_list[$star_pincode][4] == 'yes')
							{
								echo "11";
								echo "####";
								if($show_d_d_on_pro == 1)
								{
									echo $delivery_date;
								}
								else
								{
								
									if($dod!='0')
									{
										echo $phen_pincode_list[$star_pincode][3]." days";
										
									}else{
										
										echo $delivery_date = $dod_name;
									}
								}
								echo "####";
								echo esc_html( $qry22[0]['cod_msg1'] );
								echo "####";
								echo $state;
								echo "####";
								echo $city;
							}
							
							setcookie("valid_pincode",$safe_zipcode,time() + (10 * 365 * 24 * 60 * 60),"/");
							
							setcookie("valid_state",$state_min,time() + (10 * 365 * 24 * 60 * 60),"/");
							
							$customer = new WC_Customer();
					
							$customer->set_shipping_postcode($safe_zipcode);
								
							$user_ID = get_current_user_id();
							
							if(isset($user_ID) && $user_ID != 0) {
								
								update_user_meta($user_ID, 'shipping_postcode', $safe_zipcode); //for setting shipping postcode
								
							}
						
						}
						else
						{
							
							// setcookie("valid_pincode", "", time() - 3600);
							
							echo "0";
							
						}
						
					}

				}
				else
				{
					
					echo "0";
					
					// setcookie("valid_pincode", "", time() - 3600);
					
				}
				
				exit;

		}
		
		add_action( 'wp_ajax_nopriv_picodecheck_ajax_submit', 'picodecheck_ajax_submit' );
		
		add_action( 'wp_ajax_picodecheck_ajax_submit', 'picodecheck_ajax_submit' );

		function picodecheck_ajax_submit() {
			
			global $table_prefix, $wpdb;
		
			$pincode = isset($_POST['pin_code'])?sanitize_text_field( $_POST['pin_code'] ):'';
			
			$product_id = isset($_POST['product_id'])?sanitize_text_field( $_POST['product_id'] ):'';
			
			$state_min = isset($_POST['state'])?sanitize_text_field( $_POST['state'] ):'';
		
			$phen_pincodes_list = get_post_meta( $product_id, 'phen_pincode_list' );
				
			$phen_pincode_list = isset($phen_pincodes_list[0])?$phen_pincodes_list[0]:'';
			
			if(isset($phen_pincodes_list) && empty($phen_pincodes_list[0])){
				$phen_pincodes_list='';
			}
			
			$star_pincode = substr($pincode, 0, 3).'*';
			
			$state_based_pincode =  get_option( 'state_based_pincode' );
			
			$qry22 = $wpdb->get_results("SELECT * FROM `".$table_prefix."pincode_setting_pro` ORDER BY `id` ASC  limit 1",ARRAY_A);
		
			if($phen_pincodes_list=='' || count($phen_pincodes_list) == 0 )
			{ 
				
				if(isset($state_based_pincode) && $state_based_pincode==1){
					
					$safe_zipcode = $pincode;
				
					$pincode = substr($pincode, 0, 3);
					
					$show_d_d_on_pro =  get_option( 'woo_pin_check_show_d_d_on_pro' );
					
					$table_pin_codes = $table_prefix."check_pincode_pro";
					
					if($safe_zipcode)
					{
						
						$count = $wpdb->get_var( $wpdb->prepare( "select COUNT(*) from $table_pin_codes where state='$state_min' AND `pincode` = %s ", $safe_zipcode ) );
						
						$like = false;
						
						if( $count == 0  )
						{
							
							$ppook = "SELECT * FROM `$table_pin_codes` where state='$state_min' AND pincode LIKE '".$wpdb->esc_like($pincode)."%'";
							
							$ftc_ary = $wpdb->get_results($ppook);
							
							 $count=count($ftc_ary);
							
							 $tem_pin=$ftc_ary[0]->pincode;
							
							$like = true;
							
						}
					
					
						if( ($count == 0) || (isset($tem_pin) && strpos($tem_pin,'*')===false) )
						{
						   echo "0";  
						   
						}
						else
						{	
							
							if( $like )
							{
								
								$query = "SELECT * FROM `$table_pin_codes` where  state='$state_min' AND pincode LIKE '".$wpdb->esc_like($pincode)."%'";
								
							}
							else
							{
								
								$query = "SELECT * FROM `$table_pin_codes` where state='$state_min' AND pincode='$safe_zipcode'"; 
								
							}
							
							$ftc_ary = $wpdb->get_results($query);
							
							$dod = $ftc_ary[0]->dod;
							
							$dod_name = $ftc_ary[0]->dod_name;
							
							$state = $ftc_ary[0]->state;
							
							$city = $ftc_ary[0]->city;
							
							$deliver_by = $ftc_ary[0]->deliver_by;
							
							if($deliver_by=="day"){
								
								if($dod >= 1)
								{
									
									for($i=1; $i<=$dod; $i++)
									{
											$dd = date("D", strtotime("+ $i day"));
											
											if($qry22[0]['s_s'] == 0)
											{			
										
												if($dd == 'Sat')
												{	
											
													$dod++;	
												}
												
											}
											
											if($qry22[0]['s_s1'] == 0)
											{
												
												if($dd == 'Sun')
												{	
											
													$dod++;	
												}
												
											}
											
									}
									
									$delivery_date = date("D, jS M", strtotime("+ $dod day"));
									
								}else{
									
									 $delivery_date = date("D, jS M");
									 
								}
							}elseif($deliver_by=="time_picker"){
								
								$time_hrs=$ftc_ary[0]->time_hrs;
								
								$time_minuts=$ftc_ary[0]->time_minuts;
								
								 $start = current_time('Y-m-d H:i');
								 
								 if(!empty($time_hrs) && !empty($time_minuts)){
							 
									 $delivery_date=date("d-m-Y H:i", strtotime("+$time_hrs hours +$time_minuts minutes",strtotime($start)));
									 
								 }elseif(!empty($time_minuts)){
									 
									  $delivery_date=date("d-m-Y H:i", strtotime("+$time_minuts minutes",strtotime($start)));
									 
								 }else{
									 
									  $delivery_date=date("d-m-Y H:i", strtotime("+$time_hrs hours",strtotime($start)));
									  
								 }
									
							}elseif($deliver_by=="quantity"){
								 
								$delivery_date="Quantity Based";
									
							}
							else
							{
								
								
								$dod_name = $ftc_ary[0]->dod_name;
								
								if($dod_name!='')
								{
									$delivery_date =  date('D, jS M', strtotime("next $dod_name"));
								
								}else{
									
									$delivery_date = '';
								}
								
							}
							
							
							if($ftc_ary[0]->cod == 'no')
							{
								
								
								echo "10";
								echo "####";
								if($show_d_d_on_pro == 1)
								{
									echo $delivery_date;
								}
								else
								{
									
									if($dod!='0')
									{
										echo $ftc_ary[0]->dod." days";
									}else{
										
										 $dod_name = $ftc_ary[0]->dod_name;
										
										echo $delivery_date =  date('D, jS M', strtotime("next $dod_name"));
									}
									
								}
								
								
								echo "####";
								echo esc_html( $qry22[0]['cod_msg2'] );
								echo "####";
								echo $state;
								echo "####";
								echo $city;
											
							}
							elseif($ftc_ary[0]->cod == 'yes')
							{
								echo "11";
								echo "####";
								if($show_d_d_on_pro == 1)
								{
									echo $delivery_date;
								}
								else
								{
									if($dod!='0')
									{
										echo $ftc_ary[0]->dod." days";
										
									}else{
										
										if($dod!='0')
										{
											echo $ftc_ary[0]->dod." days";
										}else{
											$dod_name = $ftc_ary[0]->dod_name;
										
											echo $delivery_date =  date('D, jS M', strtotime("next $dod_name"));
										}
									}
								}
								echo "####";
								echo esc_html( $qry22[0]['cod_msg1'] );
								echo "####";
								echo $state;
								echo "####";
								echo $city;
							}
							
							setcookie("valid_pincode",$safe_zipcode,time() + (10 * 365 * 24 * 60 * 60),"/");
							
							setcookie("valid_state",$state_min,time() + (10 * 365 * 24 * 60 * 60),"/");
						
							$show_cod_products = get_option( 'show_cod_products' );
							
						
							
							if($show_cod_products==1 && !empty ($ftc_ary[0]->product_list)){
								
								$product_list=	explode(",",$ftc_ary[0]->product_list);
							
								if(!empty($product_list)){
									if(!empty($product_id)){
										if(in_array($product_id,$product_list)){
											echo '####';
											echo 'reload';
										}
										
									}else{
										echo '####';
										echo 'reload';
										
									}
								}
							
							}
							
							$customer = new WC_Customer();
					
							$customer->set_shipping_postcode($safe_zipcode);
								
							$user_ID = get_current_user_id();
							
							if(isset($user_ID) && $user_ID != 0) {
								
								update_user_meta($user_ID, 'shipping_postcode', $safe_zipcode); //for setting shipping postcode
								
							}
							
						}
						
					}
					else
					{
						
						echo "0";
						
						// setcookie("valid_pincode", "", time() - 3600);
						
					}
				
				}else{
					
					$safe_zipcode = $pincode;
				
					$pincode = substr($pincode, 0, 3);
					
					$show_d_d_on_pro =  get_option( 'woo_pin_check_show_d_d_on_pro' );
					
					$table_pin_codes = $table_prefix."check_pincode_pro";
					
					//$qry22 = $wpdb->get_results("SELECT * FROM `".$table_prefix."pincode_setting_p` ORDER BY `id` ASC  limit 1",ARRAY_A);
					
					
					if($safe_zipcode)
					{
						
						$count = $wpdb->get_var( $wpdb->prepare( "select COUNT(*) from $table_pin_codes where `pincode` = %s ", $safe_zipcode ) );
						
						$like = false;
						
						 // 'count:'.$count;
						
						if( $count == 0  )
						{
							
							$ppook = "SELECT * FROM `$table_pin_codes` where pincode LIKE '".$wpdb->esc_like($pincode)."%'";
							
							$ftc_ary = $wpdb->get_results($ppook);
							
							$tem_pin=$ftc_ary[0]->pincode;
							
							 $count=count($ftc_ary);
							
							$like = true;
							
							
						}
						
						if( $count == 0 || (isset($tem_pin) && strpos($tem_pin,'*')===false))
						{
							echo "0";  
							 
							// setcookie("valid_pincode", "", time() - 3600);
						 
						}
						else
						{
							if( $like )
							{
								
								$query = "SELECT * FROM `$table_pin_codes` where pincode LIKE '".$wpdb->esc_like($pincode)."%'";
								
							}
							else
							{
								
								$query = "SELECT * FROM `$table_pin_codes` where pincode='$safe_zipcode'"; 
								
							}
							
							
							
							$ftc_ary = $wpdb->get_results($query);
						
							$dod = $ftc_ary[0]->dod;
							
							$dod_name = $ftc_ary[0]->dod_name;
							
							$state = $ftc_ary[0]->state;
							
							$city = $ftc_ary[0]->city;
							
							$deliver_by = $ftc_ary[0]->deliver_by;
							 
							if($deliver_by=="day"){
								
								if($dod >= 1)
								{
									
									for($i=1; $i<=$dod; $i++)
									{
											$dd = date("D", strtotime("+ $i day"));
											
											if($qry22[0]['s_s'] == 0)
											{			
										
												if($dd == 'Sat')
												{	
											
													$dod++;	
												}
												
											}
											
											if($qry22[0]['s_s1'] == 0)
											{
												
												if($dd == 'Sun')
												{	
											
													$dod++;	
												}
												
											}
											
									}
									
									$delivery_date = date("D, jS M", strtotime("+ $dod day"));
									
								}else{
									
									 $delivery_date = date("D, jS M");
									 
								}
							}elseif($deliver_by=="time_picker"){
								
								$time_hrs=$ftc_ary[0]->time_hrs;
								
								$time_minuts=$ftc_ary[0]->time_minuts;
								
								 $start = current_time('Y-m-d H:i');
								 
								 if(!empty($time_hrs) && !empty($time_minuts)){
							 
									 $delivery_date=date("d-m-Y H:i", strtotime("+$time_hrs hours +$time_minuts minutes",strtotime($start)));
									 
								 }elseif(!empty($time_minuts)){
									 
									  $delivery_date=date("d-m-Y H:i", strtotime("+$time_minuts minutes",strtotime($start)));
									 
								 }else{
									 
									  $delivery_date=date("d-m-Y H:i", strtotime("+$time_hrs hours",strtotime($start)));
									  
								 }
									
							}elseif($deliver_by=="quantity"){
								 
								$delivery_date="Quantity Based";
									
							}
							else
							{
								
								
								$dod_name = $ftc_ary[0]->dod_name;
								
								if($dod_name!='')
								{										
									 $delivery_date =  date('D, jS M', strtotime("next $dod_name"));
								
								}else{
									
									$delivery_date = '';
								}
								
							}
							
							
							if($ftc_ary[0]->cod == 'no')
							{
								
								
								echo "10";
								echo "####";
								if($show_d_d_on_pro == 1)
								{
									echo $delivery_date;
								}
								else
								{
									
									if($dod!='0')
									{
										echo $ftc_ary[0]->dod." days";
									}else{
										$dod_name = $ftc_ary[0]->dod_name;
										
										$delivery_date =  date('D, jS M', strtotime("next $dod_name"));
									}
									
								}
								
								
								echo "####";
								echo esc_html( $qry22[0]['cod_msg2'] );
								echo "####";
								echo $state;
								echo "####";
								echo $city;
											
							}
							elseif($ftc_ary[0]->cod == 'yes')
							{
								echo "11";
								echo "####";
								if($show_d_d_on_pro == 1)
								{
									echo $delivery_date;
								}
								else
								{
									if($dod!='0')
									{
										echo $ftc_ary[0]->dod." days";
										
									}else{
										
										if($dod!='0')
										{
											echo $ftc_ary[0]->dod." days";
										}else{
											
											$dod_name = $ftc_ary[0]->dod_name;
										
											$delivery_date =  date('D, jS M', strtotime("next $dod_name"));
										}
									}
								}
								echo "####";
								echo esc_html( $qry22[0]['cod_msg1'] );
								echo "####";
								echo $state;
								echo "####";
								echo $city;
							}
							
							setcookie("valid_pincode",$safe_zipcode,time() + (10 * 365 * 24 * 60 * 60),"/");
							
							setcookie("valid_state",$state_min,time() + (10 * 365 * 24 * 60 * 60),"/");
							
							$show_cod_products = get_option( 'show_cod_products' );
							
							if($show_cod_products==1){
								
								$product_list=	explode(",",$ftc_ary[0]->product_list);
							
								if(!empty($product_list)){
									if(!empty($product_id)){
										if(in_array($product_id,$product_list)){
											echo '####';
											echo 'reload';
										}
										
									}else{
										echo '####';
										echo 'reload';
										
									}
								}
							
							}
							
							$customer = new WC_Customer();
					
							$customer->set_shipping_postcode($safe_zipcode);
								
							$user_ID = get_current_user_id();
							
							if(isset($user_ID) && $user_ID != 0) {
								
								update_user_meta($user_ID, 'shipping_postcode', $safe_zipcode); //for setting shipping postcode
								
							}
							
						}
						// 
					}
					else
					{
						// setcookie("valid_pincode", "", time() - 3600);
						
						echo "0";
						
					}	
						
				}
				
			}
			else
			{
			
				$phen_pincode_list = $phen_pincodes_list[0];
				$clear_min=false;
				
				if($state_based_pincode==1 && $phen_pincode_list[$pincode][2]==$state_min){
					$clear_min=true;
				}elseif($state_based_pincode!=1){
					$clear_min=true;
				}
				
				if ($clear_min==true &&  array_key_exists( $wpdb->esc_like($pincode),$phen_pincode_list ) )
				{
					
					
					
					$safe_zipcode = $pincode;
				
					$dod = $phen_pincode_list[$safe_zipcode][3];
					
					$dod_name = $phen_pincode_list[$safe_zipcode][5];
					
					$state = $phen_pincode_list[$safe_zipcode][2];
					
					$city = $phen_pincode_list[$safe_zipcode][1];
					
					$deliver_by = $phen_pincode_list[$safe_zipcode][6];
					
					$time_hrs = $phen_pincode_list[$safe_zipcode][7];
					
					$time_minuts = $phen_pincode_list[$safe_zipcode][8];
					
					$show_d_d_on_pro =  get_option( 'woo_pin_check_show_d_d_on_pro' );
					
					
					if($deliver_by=="day"){
						
						if($dod >= 1)
						{
							
							for($i=1; $i<=$dod; $i++)
							{
									$dd = date("D", strtotime("+ $i day"));
									
									if($qry22[0]['s_s'] == 0)
									{			
								
										if($dd == 'Sat')
										{	
									
											$dod++;	
										}
										
									}
									
									if($qry22[0]['s_s1'] == 0)
									{
										
										if($dd == 'Sun')
										{	
									
											$dod++;	
										}
										
									}
									
							}
							
							$delivery_date = date("D, jS M", strtotime("+ $dod day"));
							
						}else{
							
							 $delivery_date = date("D, jS M");
							 
						}
					}elseif($deliver_by=="time_picker"){
						
						 $start = current_time('H:i');
						 
						 if(!empty($time_hrs) && !empty($time_minuts)){
							 
							 $delivery_date=date("d-m-Y H:i", strtotime("+$time_hrs hours +$time_minuts minutes",strtotime($start)));
							 
						 }elseif(!empty($time_minuts)){
							 
							  $delivery_date=date("d-m-Y H:i", strtotime("+$time_minuts minutes",strtotime($start)));
							 
						 }else{
							 
							  $delivery_date=date("d-m-Y H:i", strtotime("+$time_hrs hours",strtotime($start)));
							  
						 }
							
					}elseif($deliver_by=="quantity"){
						 
						$delivery_date="Quantity Based";
							
					}
					else
					{
						
						
						if($dod_name!='')
						{										
							 $delivery_date =  date('D, jS M', strtotime("next $dod_name"));
						
						}else{
							
							$delivery_date = '';
						}
						
					}
					
					if($phen_pincode_list[$safe_zipcode][4] == 'no')
					{
						echo "10";
						echo "####";
						if($show_d_d_on_pro == 1)
						{
							echo $delivery_date;
						}
						else
						{
						
							if($dod!='0')
							{
								echo $phen_pincode_list[$safe_zipcode][3]." days";
								
							}else{
								
								echo $delivery_date =  date('D, jS M', strtotime("next $dod_name"));
							}
							
						}
						echo "####";
						echo esc_html( $qry22[0]['cod_msg2'] );
						echo "####";
						echo $state;
						echo "####";
						echo $city;
									
					}
					elseif($phen_pincode_list[$safe_zipcode][4] == 'yes')
					{
						echo "11";
						echo "####";
						if($show_d_d_on_pro == 1)
						{
							echo $delivery_date;
						}
						else
						{
							if($dod!='0')
							{
								echo $phen_pincode_list[$safe_zipcode][3]." days";
								
							}else{
								
								echo $delivery_date =  date('D, jS M', strtotime("next $dod_name"));
							}
						}
						echo "####";
						echo esc_html( $qry22[0]['cod_msg1'] );
						echo "####";
						echo $state;
						echo "####";
						echo $city;
					}
					
					setcookie("valid_pincode",$safe_zipcode,time() + (10 * 365 * 24 * 60 * 60),"/");
					
					setcookie("valid_state",$state_min,time() + (10 * 365 * 24 * 60 * 60),"/");
					
					$customer = new WC_Customer();
			
					$customer->set_shipping_postcode($safe_zipcode);
						
					$user_ID = get_current_user_id();
					
					if(isset($user_ID) && $user_ID != 0) {
						
						update_user_meta($user_ID, 'shipping_postcode', $safe_zipcode); //for setting shipping postcode
						
					}
					
				}
				elseif( array_key_exists(  $star_pincode,$phen_pincode_list ) )
				{
					
					
					$safe_zipcode = $pincode;
				
					$dod = $phen_pincode_list[$star_pincode][3];
					
					$dod_name = $phen_pincode_list[$star_pincode][5];
					
					$state = $phen_pincode_list[$star_pincode][2];
					
					$city = $phen_pincode_list[$star_pincode][1];
					
					$deliver_by = $phen_pincode_list[$star_pincode][6];
					
					$time_hrs = $phen_pincode_list[$safe_zipcode][7];
					
					$time_minuts = $phen_pincode_list[$safe_zipcode][8];
					
					$show_d_d_on_pro =  get_option( 'woo_pin_check_show_d_d_on_pro' );
					
					if($deliver_by=="day"){
						
						if($dod >= 1)
						{
							
							for($i=1; $i<=$dod; $i++)
							{
									$dd = date("D", strtotime("+ $i day"));
									
									if($qry22[0]['s_s'] == 0)
									{			
								
										if($dd == 'Sat')
										{	
									
											$dod++;	
										}
										
									}
									
									if($qry22[0]['s_s1'] == 0)
									{
										
										if($dd == 'Sun')
										{	
									
											$dod++;	
										}
										
									}
									
							}
							
							$delivery_date = date("D, jS M", strtotime("+ $dod day"));
							
						}else{
							
							 $delivery_date = date("D, jS M");
							 
						}
					}elseif($deliver_by=="time_picker"){
						
						 $start = current_time('H:i');
						 
						 if(!empty($time_hrs) && !empty($time_minuts)){
							 
							 $delivery_date=date("d-m-Y H:i", strtotime("+$time_hrs hours +$time_minuts minutes",strtotime($start)));
							 
						 }elseif(!empty($time_minuts)){
							 
							  $delivery_date=date("d-m-Y H:i", strtotime("+$time_minuts minutes",strtotime($start)));
							 
						 }else{
							 
							  $delivery_date=date("d-m-Y H:i", strtotime("+$time_hrs hours",strtotime($start)));
							  
						 }
							
					}elseif($deliver_by=="quantity"){
						 
						$delivery_date="Quantity Based";
							
					}
					else
					{
						
						
						if($dod_name!='')
						{
							$delivery_date =  date('D, jS M', strtotime("next $dod_name"));
						
						}else{
							
							$delivery_date = '';
						}
						
					}
					
					
					if($phen_pincode_list[$star_pincode][4] == 'no')
					{	
						echo "10";
						echo "####";
						if($show_d_d_on_pro == 1)
						{
							echo $delivery_date;
						}
						else
						{
						
							if($dod!='0')
							{
								echo $phen_pincode_list[$star_pincode][3]." days";
								
							}else{
								
								echo $delivery_date =  date('D, jS M', strtotime("next $dod_name"));
							}
							
							
						}
						echo "####";
						echo esc_html( $qry22[0]['cod_msg2'] );
						echo "####";
						echo $state;
						echo "####";
						echo $city;
									
					}
					elseif($phen_pincode_list[$star_pincode][4] == 'yes')
					{
						echo "11";
						echo "####";
						if($show_d_d_on_pro == 1)
						{
							echo $delivery_date;
						}
						else
						{
							if($dod!='0')
							{
								echo $phen_pincode_list[$star_pincode][3]." days";
								
							}else{
								
								echo $delivery_date =  date('D, jS M', strtotime("next $dod_name"));
							}
						}
						echo "####";
						echo esc_html( $qry22[0]['cod_msg1'] );
						echo "####";
						echo $state;
						echo "####";
						echo $city;
					}
					
					setcookie("valid_pincode",$safe_zipcode,time() + (10 * 365 * 24 * 60 * 60),"/");
					
					setcookie("valid_state",$state_min,time() + (10 * 365 * 24 * 60 * 60),"/");
					
					$customer = new WC_Customer();
			
					$customer->set_shipping_postcode($safe_zipcode);
						
					$user_ID = get_current_user_id();
					
					if(isset($user_ID) && $user_ID != 0) {
						
						update_user_meta($user_ID, 'shipping_postcode', $safe_zipcode); //for setting shipping postcode
						
					}
				
				}
				else
				{
					
					echo "0";
					
					// setcookie("valid_pincode", "", time() - 3600);
					
				}
				
			}

			exit;

		}

		
		add_action( 'wp_ajax_nopriv_picodecheck_ajax_submit_out', 'picodecheck_ajax_submit_out' );
		
		add_action( 'wp_ajax_picodecheck_ajax_submit_out', 'picodecheck_ajax_submit_out' );
		
		function picodecheck_ajax_submit_out() {
			
			// get the submitted parameters
			global $table_prefix, $wpdb,$woocommerce;
		
			setcookie("phoen_new_valid_pincode",'0',time() - 3600,"/");
			
			setcookie("phoen_delivery_date",'0',time() - 3600,"/");
			 
			$cookie_pin = $_COOKIE['valid_pincode'];
					
			$pin_code = sanitize_text_field($_POST['pin_code']);
			
			if( $pin_code == '' )
			{
				
				$pin_code = $cookie_pin;
				
			}
			
			$show_error =  0;
			
			$cod_count = 0;
			
			$cod = '';
			$pincode_array = array();
			
			$star_pincode = substr($pin_code, 0, 3).'*';
			 
			if(isset($pin_code))
			{
				
				$items = $woocommerce->cart->get_cart();

				$product_count = count($items);
				
				$phen_pincode_list = array();
				
				$qry22 = $wpdb->get_results("SELECT * FROM `".$table_prefix."pincode_setting_pro` ORDER BY `id` ASC  limit 1",ARRAY_A);
				
				foreach($items as $item => $values) {
					
					$_product_id = $values['product_id'];
					
					$quantity = $values['quantity'];
					
					$phen_pincodes_list = get_post_meta( $_product_id, 'phen_pincode_list' );
					
					$safe_zipcode = $pin_code;
					// print_r($phen_pincodes_list) ;die();
					if(empty($phen_pincodes_list) || (is_array($phen_pincodes_list[0]) && count($phen_pincodes_list[0]) == 0) )
					{
						
						//echo "else";
						$pincode = substr($pin_code, 0, 3);
						
						//$show_d_d_on_pro =  get_option( 'woo_pin_check_show_d_d_on_pro' );
						
						$table_pin_codes = $table_prefix."check_pincode_pro";
						
						if($safe_zipcode)
						{
							
							$count = $wpdb->get_var( $wpdb->prepare( "select COUNT(*) from $table_pin_codes where `pincode` = %s ", $safe_zipcode ) ); 
							
							$like = false;
							
							//echo 'count:'.$count;
							
							if( $count == 0  )
							{
								
								$ppook = "SELECT * FROM `$table_pin_codes` where pincode LIKE '".$wpdb->esc_like($pincode)."%'";
							
								$ftc_ary = $wpdb->get_results($ppook);
								
								$tem_pin=$ftc_ary[0]->pincode;
								
								 $count=count($ftc_ary);
								
								$like = true;
								
							}
							
							if( $count == 0 || (isset($tem_pin) && strpos($tem_pin,'*')===false))
							{

							   $return["json"]['error'] =  1;
							
								echo json_encode($return);	  
							
								exit;
							 
							}
							else
							{
								
								if( $like )
								{
									
									$query = "SELECT * FROM `$table_pin_codes` where pincode LIKE '".$wpdb->esc_like($pincode) ."%'";
									
								}
								else
								{
									
									$query = "SELECT * FROM `$table_pin_codes` where pincode='$safe_zipcode'"; 
									
								}
								
								//echo $query;
								
								$ftc_ary = $wpdb->get_results($query);
								
								$show_errors =  count($ftc_ary);
								
								if($show_errors == 0)
								{
									
									$show_error++;
									
								}
								else
								{
									
									$cod = $ftc_ary[0]->cod;
									
									$deliver_by = isset($ftc_ary[0]->deliver_by) ? $ftc_ary[0]->deliver_by:'';
									
									$time_hrs = isset($ftc_ary[0]->time_hrs) ? $ftc_ary[0]->time_hrs:'';
									
									$time_minuts = isset($ftc_ary[0]->time_minuts) ? $ftc_ary[0]->time_minuts:'';
									
									$dod = isset($ftc_ary[0]->dod)?  $ftc_ary[0]->dod:'';
									
									if($deliver_by=="day"){
						
										if($dod >= 1)
										{
											
											for($i=1; $i<=$dod; $i++)
											{
													$dd = date("D", strtotime("+ $i day"));
													
													if($qry22[0]['s_s'] == 0)
													{			
												
														if($dd == 'Sat')
														{	
													
															$dod++;	
														}
														
													}
													
													if($qry22[0]['s_s1'] == 0)
													{
														
														if($dd == 'Sun')
														{	
													
															$dod++;	
														}
														
													}
													
											}
											
											$delivery_date = date("D, jS M", strtotime("+ $dod day"));
											
										}else{
											
											 $delivery_date = date("D, jS M");
											 
										}
									} elseif($deliver_by=="time_picker"){
										
										 $start = current_time('H:i');
										 
										 if(!empty($time_hrs) && !empty($time_minuts)){
							 
											 $delivery_date=date("d-m-Y H:i", strtotime("+$time_hrs hours +$time_minuts minutes",strtotime($start)));
											 
										 }elseif(!empty($time_minuts)){
											 
											  $delivery_date=date("d-m-Y H:i", strtotime("+$time_minuts minutes",strtotime($start)));
											 
										 }else{
											 
											  $delivery_date=date("d-m-Y H:i", strtotime("+$time_hrs hours",strtotime($start)));
											  
										 }
											
									}elseif($deliver_by=="quantity"){
										
										$delivery_days=isset($ftc_ary[0]->deliver_day) ? $ftc_ary[0]->deliver_day:'';	

										$delivery_quantity=isset($ftc_ary[0]->deliver_quantity) ? $ftc_ary[0]->deliver_quantity:'';
										
										$delivery_quantity_array=explode(",",$delivery_quantity);
																						
										 $delivery_days_array=explode(",",$delivery_days);

										$min_array=array_combine($delivery_quantity_array,$delivery_days_array);
										
										$delvery_day= getClosest($quantity,$delivery_quantity_array);
									
										$delivery_lol=$min_array[$delvery_day];
										
										$delivery_date = date("D, jS M", strtotime("+ $delivery_lol day"));
											
									}
									else
									{
										
										if($dod_name!='')
										{
											$delivery_date =  date('D, jS M', strtotime("next $dod_name"));
										
										}else{
											
											$delivery_date = '';
										}
										
									} 
									
									if($cod == 'yes')
									{
										
										$cod_count++;
										
									}
									
								}
								
							}

						}
						
					}
					else
					{
						
						$phen_pincode_list = $phen_pincodes_list[0];
				
						//print_r($phen_pincode_list);

						if (!empty($phen_pincodes_list[0]) && array_key_exists( $wpdb->esc_like($pin_code),$phen_pincode_list ) )
						{
							$cod = $phen_pincode_list[$safe_zipcode][4];
							
							$dod_name = isset($phen_pincode_list[$safe_zipcode][5])?$phen_pincode_list[$safe_zipcode][5]:'';
														
							$dod = isset($phen_pincode_list[$safe_zipcode][3])?$phen_pincode_list[$safe_zipcode][3]:'';
												
							$state = isset($phen_pincode_list[$safe_zipcode][2])?$phen_pincode_list[$safe_zipcode][2]:'';
							
							$city = isset($phen_pincode_list[$safe_zipcode][1])?$phen_pincode_list[$safe_zipcode][1]:'';
							
							$deliver_by = isset($phen_pincode_list[$safe_zipcode][6])?$phen_pincode_list[$safe_zipcode][6]:'';
							
							$time_hrs =isset($phen_pincode_list[$safe_zipcode][7])?$phen_pincode_list[$safe_zipcode][7]:'';
							
							$time_minuts = isset($phen_pincode_list[$safe_zipcode][8])?$phen_pincode_list[$safe_zipcode][8]:'';
														
							if($deliver_by=="day"){
								
								if($dod >= 1)
								{
									
									for($i=1; $i<=$dod; $i++)
									{
											$dd = date("D", strtotime("+ $i day"));
											
											if($qry22[0]['s_s'] == 0)
											{			
										
												if($dd == 'Sat')
												{	
											
													$dod++;	
												}
												
											}
											
											if($qry22[0]['s_s1'] == 0)
											{
												
												if($dd == 'Sun')
												{	
											
													$dod++;	
												}
												
											}
											
									}
									
									$delivery_date = date("D, jS M", strtotime("+ $dod day"));
									
								}else{
									
									 $delivery_date = date("D, jS M");
									 
								}
							}elseif($deliver_by=="time_picker"){
								
								 $start = current_time('H:i');
								 
									 if(!empty($time_hrs) && !empty($time_minuts)){
								 
										 $delivery_date=date("d-m-Y H:i", strtotime("+$time_hrs hours +$time_minuts minutes",strtotime($start)));
										 
									 }elseif(!empty($time_minuts)){
										 
										  $delivery_date=date("d-m-Y H:i", strtotime("+$time_minuts minutes",strtotime($start)));
										 
									 }else{
										 
										  $delivery_date=date("d-m-Y H:i", strtotime("+$time_hrs hours",strtotime($start)));
										  
									 }
									
							}elseif($deliver_by=="quantity"){
								
								$finel_array=isset($phen_pincode_list[$safe_zipcode])?$phen_pincode_list[$safe_zipcode]:'';
							
								$delivery_quantity=isset($finel_array[12])?$finel_array[12]:'';	
								
								$delivery_days=isset($finel_array[13])?$finel_array[13]:'';	
							
								$delivery_quantity_array=explode(",",$delivery_quantity);
					
								$delivery_days_array=explode(",",$delivery_days);
								
								$min_array=array_combine($delivery_quantity_array,$delivery_days_array);
								
								$delvery_day= getClosest($quantity,$delivery_quantity_array);
								
								$delivery_lol=isset($min_array[$delvery_day])?$min_array[$delvery_day]:'';
										
								$delivery_date = date("D, jS M", strtotime("+ $delivery_lol day"));
							
							}
							else
							{
								
								
								if(isset($dod_name) && $dod_name!='')
								{
									$delivery_date =  date('D, jS M', strtotime("next $dod_name"));
								
								}else{
									
									$delivery_date = '';
								}
								
							}

							if($cod == 'yes')
							{
								
								$cod_count++;
								
							}
							
						}
						elseif(!empty($phen_pincode_list) && array_key_exists(  $star_pincode,$phen_pincode_list ) )
						{
									
							$cod =isset($phen_pincode_list[$star_pincode][4])?$phen_pincode_list[$star_pincode][4]:'';
							
							$dod =isset($phen_pincode_list[$star_pincode][3])?$phen_pincode_list[$star_pincode][3]:'';
					
							$dod_name =isset($phen_pincode_list[$star_pincode][5])?$phen_pincode_list[$star_pincode][5]:'';
							
							$state = isset($phen_pincode_list[$star_pincode][2])?$phen_pincode_list[$star_pincode][2]:'';
							
							$city = isset($phen_pincode_list[$star_pincode][1])?$phen_pincode_list[$star_pincode][1]:'';
							
							$deliver_by = isset($phen_pincode_list[$star_pincode][6])?$phen_pincode_list[$star_pincode][6]:'';
							
							$time_hrs = isset($phen_pincode_list[$star_pincode][7])?$phen_pincode_list[$star_pincode][7]:'';
							
							$time_minuts = isset($phen_pincode_list[$star_pincode][8])?$phen_pincode_list[$star_pincode][8]:'';
														
							if($deliver_by=="day"){
								
								if($dod >= 1)
								{
									
									for($i=1; $i<=$dod; $i++)
									{
											$dd = date("D", strtotime("+ $i day"));
											
											if($qry22[0]['s_s'] == 0)
											{			
										
												if($dd == 'Sat')
												{	
											
													$dod++;	
												}
												
											}
											
											if($qry22[0]['s_s1'] == 0)
											{
												
												if($dd == 'Sun')
												{	
											
													$dod++;	
												}
												
											}
											
									}
									
									$delivery_date = date("D, jS M", strtotime("+ $dod day"));
									
								}else{
									
									 $delivery_date = date("D, jS M");
									 
								}
							}elseif($deliver_by=="time_picker"){
								
								 $start = current_time('H:i');
								 
								 if(!empty($time_hrs) && !empty($time_minuts)){
									 
									 $delivery_date=date("d-m-Y H:i", strtotime("+$time_hrs hours +$time_minuts minutes",strtotime($start)));
									 
								 }elseif(!empty($time_minuts)){
									 
									  $delivery_date=date("d-m-Y H:i", strtotime("+$time_minuts minutes",strtotime($start)));
									 
								 }else{
									 
									  $delivery_date=date("d-m-Y H:i", strtotime("+$time_hrs hours",strtotime($start)));
									  
								 }
									
							}elseif($deliver_by=="quantity"){
								 
								$finel_array=isset($phen_pincode_list[$star_pincode])?$phen_pincode_list[$star_pincode]:'';
							
								$delivery_quantity=isset($finel_array[12])?$finel_array[12]:'';	
								
								$delivery_days=isset($finel_array[13])?$finel_array[13]:'';	
							
								$delivery_quantity_array=explode(",",$delivery_quantity);
					
								$delivery_days_array=explode(",",$delivery_days);
								
								$min_array=array_combine($delivery_quantity_array,$delivery_days_array);
								
								$delvery_day= getClosest($quantity,$delivery_quantity_array);
								
								$delivery_lol=$min_array[$delvery_day];
										
								$delivery_date = date("D, jS M", strtotime("+ $delivery_lol day"));
									
							}
							else
							{
								
								
								if($dod_name!='')
								{
									$delivery_date =  date('D, jS M', strtotime("next $dod_name"));
								
								}else{
									
									$delivery_date = '';
								}
								
							}
							
							if($cod == 'yes')
							{
								
								$cod_count++;
								
							}
							
						}
						else
						{
							
							$show_error++;
							
						}
						
					}
					$pincode_array[$_product_id]=$delivery_date;
				}

			}
				// ($info)
				$json = json_encode($pincode_array);
				setcookie('phoen_delivery_date', $json);
				
			// setcookie("phoen_delivery_date", json_encode($pincode_array) ,time() + 3600,"/");
			
			if( $product_count == $cod_count )
			{
				$pin_code1=$pin_code?$pin_code:$star_pincode;
				
				$return["json"]['cod'] =  'yes';
				
				setcookie("phoen_new_valid_pincode",$pin_code1,time() + 3600,"/");
			}
			else
			{
				
				$return["json"]['cod'] =  'no';
				
			}
			
			$return["json"]['error'] =  $show_error;
							
			echo json_encode($return);	  
		
			exit;
		}
		
		function add_order_item_meta($item_id, $values) {
			
			global $table_prefix;
			// echo '66';
			global $wpdb;
			// echo '66';
			global $woocommerce;
			// echo '55';
			global $post;
				
		
			
			if(isset($_POST["ship_to_different_address"]) && $_POST["ship_to_different_address"]==1){
				
				$pin_code=isset($_POST["shipping_postcode"])?$_POST["shipping_postcode"]:'';
				
			}else{
				
				$pin_code=isset($_POST["billing_postcode"])?$_POST["billing_postcode"]:'';
				
			}	
					// print_r($pin_code);die();				
			$qry22 = $wpdb->get_results("SELECT * FROM `".$table_prefix."pincode_setting_pro` ORDER BY `id` ASC  limit 1",ARRAY_A);
			
			$key = 'Delivery schedule'; // Define your key here
			
			$_product_id = $values['product_id'];
					
			$quantity = $values['quantity'];
			
			$phen_pincodes_list = get_post_meta( $_product_id, 'phen_pincode_list' );
			
			$safe_zipcode = $pin_code;
			
			if( count($phen_pincodes_list[0])	== 0 )
			{
				
				//echo "else";
				$pincode = substr($pin_code, 0, 3);
				
				//$show_d_d_on_pro =  get_option( 'woo_pin_check_show_d_d_on_pro' );
				
				$table_pin_codes = $table_prefix."check_pincode_pro";
				
				if($safe_zipcode)
				{
					
					$count = $wpdb->get_var( $wpdb->prepare( "select COUNT(*) from $table_pin_codes where `pincode` = %s ", $safe_zipcode ) ); 
					
					$like = false;
					
					//echo 'count:'.$count;
					
					if( $count == 0  )
					{
						
						$ppook = "SELECT * FROM `$table_pin_codes` where state='$state_min' AND pincode LIKE '".$wpdb->esc_like($pincode)."%'";

						$ftc_ary = $wpdb->get_results($ppook);

						$count=count($ftc_ary);

						$tem_pin=$ftc_ary[0]->pincode;

						$like = true;
						
						//echo 'count1:'.$count;
						
					}
				
					if( $count == 0 || (isset($tem_pin) && strpos($tem_pin,'*')===false) )
					{

						$delivery_date="Not Available";

					}
					else
					{
						
						if( $like )
						{
							
							$query = "SELECT * FROM `$table_pin_codes` where pincode LIKE '".$wpdb->esc_like($pincode) ."%'";
							
						}
						else
						{
							
							$query = "SELECT * FROM `$table_pin_codes` where pincode='$safe_zipcode'"; 
							
						}
												
						$ftc_ary = $wpdb->get_results($query);
						
						$show_errors =  count($ftc_ary);
						
						if($show_errors == 0)
						{
							
							$show_error++;
							
						}
						else
						{
							
							$cod = $ftc_ary[0]->cod;
							
							$deliver_by = isset($ftc_ary[0]->deliver_by) ? $ftc_ary[0]->deliver_by:'';
							
							$time_hrs = isset($ftc_ary[0]->time_hrs) ? $ftc_ary[0]->time_hrs:'';
							
							$time_minuts = isset($ftc_ary[0]->time_minuts) ? $ftc_ary[0]->time_minuts:'';
							
							$dod = isset($ftc_ary[0]->dod)?  $ftc_ary[0]->dod:'';
							
							if($deliver_by=="day"){
				
								if($dod >= 1)
								{
									
									for($i=1; $i<=$dod; $i++)
									{
											$dd = date("D", strtotime("+ $i day"));
											
											if($qry22[0]['s_s'] == 0)
											{			
										
												if($dd == 'Sat')
												{	
											
													$dod++;	
												}
												
											}
											
											if($qry22[0]['s_s1'] == 0)
											{
												
												if($dd == 'Sun')
												{	
											
													$dod++;	
												}
												
											}
											
									}
									
									$delivery_date = date("D, jS M", strtotime("+ $dod day"));
									
								}else{
									
									 $delivery_date = date("D, jS M");
									 
								}
							} elseif($deliver_by=="time_picker"){
								
								 $start = current_time('H:i');
								 
								 if(!empty($time_hrs) && !empty($time_minuts)){
									 
									 $delivery_date=date("d-m-Y H:i", strtotime("+$time_hrs hours +$time_minuts minutes",strtotime($start)));
									 
								 }elseif(!empty($time_minuts)){
									 
									  $delivery_date=date("d-m-Y H:i", strtotime("+$time_minuts minutes",strtotime($start)));
									 
								 }else{
									 
									  $delivery_date=date("d-m-Y H:i", strtotime("+$time_hrs hours",strtotime($start)));
									  
								 }
									
							}elseif($deliver_by=="quantity"){
								
								$delivery_days=isset($ftc_ary[0]->deliver_day) ? $ftc_ary[0]->deliver_day:'';	

								$delivery_quantity=isset($ftc_ary[0]->deliver_quantity) ? $ftc_ary[0]->deliver_quantity:'';
								
								$delivery_quantity_array=explode(",",$delivery_quantity);
																				
								 $delivery_days_array=explode(",",$delivery_days);

								$min_array=array_combine($delivery_quantity_array,$delivery_days_array);
								
								$delvery_day= getClosest($quantity,$delivery_quantity_array);
							
								$delivery_lol=$min_array[$delvery_day];
								
								$delivery_date = date("D, jS M", strtotime("+ $delivery_lol day"));
									
							}
							else
							{
								
								if($dod_name!='')
								{
									$delivery_date =  date('D, jS M', strtotime("next $dod_name"));
								
								}else{
									
									$delivery_date = '';
								}
								
							} 
							
						}
						
					}

				}
				
			}
			else
			{
				
				$phen_pincode_list = $phen_pincodes_list[0];
				
				// print_r($safe_zipcode);die();
				// if ( isset($phen_pincode_list[$safe_zipcode]) && !empty($phen_pincode_list[$safe_zipcode]) )
					
				if ( array_key_exists( $wpdb->esc_like($safe_zipcode),$phen_pincode_list ) )
			
				{
					
						 
					$cod = $phen_pincode_list[$safe_zipcode][4];
					
					$dod_name = isset($phen_pincode_list[$safe_zipcode][5])?$phen_pincode_list[$safe_zipcode][5]:'';
												
					$dod = isset($phen_pincode_list[$safe_zipcode][3])?$phen_pincode_list[$safe_zipcode][3]:'';
										
					$state = isset($phen_pincode_list[$safe_zipcode][2])?$phen_pincode_list[$safe_zipcode][2]:'';
					
					$city = isset($phen_pincode_list[$safe_zipcode][1])?$phen_pincode_list[$safe_zipcode][1]:'';
					
					$deliver_by = isset($phen_pincode_list[$safe_zipcode][6])?$phen_pincode_list[$safe_zipcode][6]:'';
					
					$time_hrs =isset($phen_pincode_list[$safe_zipcode][7])?$phen_pincode_list[$safe_zipcode][7]:'';
					
					$time_minuts = isset($phen_pincode_list[$safe_zipcode][8])?$phen_pincode_list[$safe_zipcode][8]:'';
												
					if($deliver_by=="day"){
						
						if($dod >= 1)
						{
							
							for($i=1; $i<=$dod; $i++)
							{
									$dd = date("D", strtotime("+ $i day"));
									
									if($qry22[0]['s_s'] == 0)
									{			
								
										if($dd == 'Sat')
										{	
									
											$dod++;	
										}
										
									}
									
									if($qry22[0]['s_s1'] == 0)
									{
										
										if($dd == 'Sun')
										{	
									
											$dod++;	
										}
										
									}
									
							}
							
							$delivery_date = date("D, jS M", strtotime("+ $dod day"));
							
						}else{
							
							 $delivery_date = date("D, jS M");
							 
						}
					}elseif($deliver_by=="time_picker"){
						
						 $start = current_time('H:i');
						 
						 if(!empty($time_hrs) && !empty($time_minuts)){
							 
							 $delivery_date=date("d-m-Y H:i", strtotime("+$time_hrs hours +$time_minuts minutes",strtotime($start)));
							 
						 }elseif(!empty($time_minuts)){
							 
							  $delivery_date=date("d-m-Y H:i", strtotime("+$time_minuts minutes",strtotime($start)));
							 
						 }else{
							 
							  $delivery_date=date("d-m-Y H:i", strtotime("+$time_hrs hours",strtotime($start)));
							  
						 }
							
					}elseif($deliver_by=="quantity"){
						
						$finel_array=isset($phen_pincode_list[$safe_zipcode])?$phen_pincode_list[$safe_zipcode]:'';
					
						$delivery_quantity=isset($finel_array[12])?$finel_array[12]:'';	
						
						$delivery_days=isset($finel_array[13])?$finel_array[13]:'';	
					
						$delivery_quantity_array=explode(",",$delivery_quantity);
			
						$delivery_days_array=explode(",",$delivery_days);
						
						$min_array=array_combine($delivery_quantity_array,$delivery_days_array);
						
						$delvery_day= getClosest($quantity,$delivery_quantity_array);
						
						$delivery_lol=$min_array[$delvery_day];
								
						$delivery_date = date("D, jS M", strtotime("+ $delivery_lol day"));
					
					}
					else
					{
						
						
						if($dod_name!='')
						{
							$delivery_date =  date('D, jS M', strtotime("next $dod_name"));
						
						}else{
							
							$delivery_date = '';
						}
						
					}
					
				}
				elseif( array_key_exists(  $star_pincode,$phen_pincode_list ) )
				{
							
					$cod =isset($phen_pincode_list[$star_pincode][4])?$phen_pincode_list[$star_pincode][4]:'';
					
					$dod =isset($phen_pincode_list[$star_pincode][3])?$phen_pincode_list[$star_pincode][3]:'';
			
					$dod_name =isset($phen_pincode_list[$star_pincode][5])?$phen_pincode_list[$star_pincode][5]:'';
					
					$state = isset($phen_pincode_list[$star_pincode][2])?$phen_pincode_list[$star_pincode][2]:'';
					
					$city = isset($phen_pincode_list[$star_pincode][1])?$phen_pincode_list[$star_pincode][1]:'';
					
					$deliver_by = isset($phen_pincode_list[$star_pincode][6])?$phen_pincode_list[$star_pincode][6]:'';
					
					$time_hrs = isset($phen_pincode_list[$star_pincode][7])?$phen_pincode_list[$star_pincode][7]:'';
					
					$time_minuts = isset($phen_pincode_list[$star_pincode][8])?$phen_pincode_list[$star_pincode][8]:'';
												
					if($deliver_by=="day"){
						
						if($dod >= 1)
						{
							
							for($i=1; $i<=$dod; $i++)
							{
									$dd = date("D", strtotime("+ $i day"));
									
									if($qry22[0]['s_s'] == 0)
									{			
								
										if($dd == 'Sat')
										{	
									
											$dod++;	
										}
										
									}
									
									if($qry22[0]['s_s1'] == 0)
									{
										
										if($dd == 'Sun')
										{	
									
											$dod++;	
										}
										
									}
									
							}
							
							$delivery_date = date("D, jS M", strtotime("+ $dod day"));
							
						}else{
							
							 $delivery_date = date("D, jS M");
							 
						}
					}elseif($deliver_by=="time_picker"){
						
						 $start = current_time('H:i');
						 
						 if(!empty($time_hrs) && !empty($time_minuts)){
							 
							 $delivery_date=date("d-m-Y H:i", strtotime("+$time_hrs hours +$time_minuts minutes",strtotime($start)));
							 
						 }elseif(!empty($time_minuts)){
							 
							  $delivery_date=date("d-m-Y H:i", strtotime("+$time_minuts minutes",strtotime($start)));
							 
						 }else{
							 
							  $delivery_date=date("d-m-Y H:i", strtotime("+$time_hrs hours",strtotime($start)));
							  
						 }
							
					}elseif($deliver_by=="quantity"){
						 
						$finel_array=isset($phen_pincode_list[$star_pincode])?$phen_pincode_list[$star_pincode]:'';
					
						$delivery_quantity=isset($finel_array[12])?$finel_array[12]:'';	
						
						$delivery_days=isset($finel_array[13])?$finel_array[13]:'';	
					
						$delivery_quantity_array=explode(",",$delivery_quantity);
			
						$delivery_days_array=explode(",",$delivery_days);
						
						$min_array=array_combine($delivery_quantity_array,$delivery_days_array);
						
						$delvery_day= getClosest($quantity,$delivery_quantity_array);
						
						$delivery_lol=$min_array[$delvery_day];
								
						$delivery_date = date("D, jS M", strtotime("+ $delivery_lol day"));
							
					}
					else
					{
						
						
						if($dod_name!='')
						{
							$delivery_date =  date('D, jS M', strtotime("next $dod_name"));
						
						}else{
							
							$delivery_date = '';
						}
						
					}
					
				}
				
			}
		
			woocommerce_add_order_item_meta($item_id, $key, $delivery_date);
		
		}
		add_action('woocommerce_add_order_item_meta', 'add_order_item_meta', 10, 2);
		
		add_shortcode("phoen_pincode_check_popup","phoe_pincode_check_popup_function");
		
		function phoe_pincode_check_popup_function()
		{
			$popup_button_text = get_option('popup_button_text');
		
			if($popup_button_text=='')
			{
				$popup_button_text="Check Pincode";
			}
			?>
			<button class="phoen_popup_button"><?php echo $popup_button_text ; ?></button>
			<?php
		}
		add_filter( 'woocommerce_cart_item_quantity', 'add_excerpt_in_cart_item_name', 10, 3 );
		
		function add_excerpt_in_cart_item_name( $item_name,  $cart_item_key ){
			
			$cart_item = WC()->cart->cart_contents[ $cart_item_key ];
			$product_id=$cart_item["product_id"];
			$quantity=$cart_item["quantity"];
			$pincode='';
			if(isset($_COOKIE["valid_pincode"])){
				
				$pincode=absint($_COOKIE["valid_pincode"]);
				
			}
			
			$phen_pincodes_list = get_post_meta( $product_id, 'phen_pincode_list' ,true);
			
			$area_list=array();
			$city_list=array();
			
			if(is_array(($phen_pincodes_list)) && count($phen_pincodes_list) != 0 && isset($phen_pincodes_list[$pincode])){
				
				$finel_array=isset($phen_pincodes_list[$pincode])?$phen_pincodes_list[$pincode]:'';
				
				$delivery_quantity=isset($finel_array[12])?$finel_array[12]:'';	
				
				$delivery_days=isset($finel_array[13])?$finel_array[13]:'';	
				
				if($finel_array[6]=="quantity" && !empty($delivery_quantity) && !empty($delivery_days)){
					
					$delivery_quantity_array=explode(",",$delivery_quantity);
					
					$delivery_days_array=explode(",",$delivery_days);
					
					$min_array=array_combine($delivery_quantity_array,$delivery_days_array);
					
					$delvery_day= getClosest($quantity,$delivery_quantity_array);
					
					$min_array_min=$min_array[$delvery_day];
					
					$msg='<p style="color:red;">(Delivery Time:'.$min_array_min.' Days)</p>';
					
					return $item_name.$msg;
					
				}else{
					
					return $item_name;
					
				}
				
			}else{
				
				global $table_prefix, $wpdb, $woocommerce;
			
				$table_pin_codes = $table_prefix."check_pincode_pro";
				
				$query_maine = "SELECT * FROM `$table_pin_codes` where pincode='$pincode'"; 
							
				$ftc_ary = $wpdb->get_results($query_maine);
				
				$delivery_days=isset($ftc_ary[0]->deliver_day) ? $ftc_ary[0]->deliver_day:'';	

				$delivery_quantity=isset($ftc_ary[0]->deliver_quantity) ? $ftc_ary[0]->deliver_quantity:'';
				
				if(isset($ftc_ary[0]->deliver_by) && $ftc_ary[0]->deliver_by=="quantity" && !empty($delivery_quantity) && !empty($delivery_days)){
					
					$delivery_quantity_array=explode(",",$delivery_quantity);
					
					 $delivery_days_array=explode(",",$delivery_days);

					$min_array=array_combine($delivery_quantity_array,$delivery_days_array);
					
					$delvery_day= getClosest($quantity,$delivery_quantity_array);
				
					$min_array_min=$min_array[$delvery_day];
					
					if($min_array_min==1){
						
						$day_days="Day";
						
					}else{
						
						$day_days="Days";
						
					}
					
					$msg='<p style="color:red;">(Delivery Time:'.$min_array_min." $day_days)</p>";
					
					return $item_name.$msg;
					
				}else{
					
					return $item_name;
					
				}
			
			}
			
		}
		
		function getClosest($search, $arr) {
			
			$end_arr=end($arr);
			
		   $closest = null;
		   
		   if(isset($arr) && is_array($arr)){
			   
			    foreach ($arr as $key => $item) {
					
					$num_val=$key-1;
					
				  if($key!==0 && $search <= $item && $search > $arr["$num_val"]){
					  
					 $closest = $item;
					 
				  }elseif($arr[0] > $search){
					  
					  $closest=$arr[0];
				  }else{
					
					  if($search > $end_arr){
						  
						  $closest=$end_arr;
						  
					  }
					  if($search==$arr["$key"]){
						  
						   $closest = $item;
						   
					  }
					  
				  }
			   }
		   }
		  
		   return $closest;
		}
		
		add_action("wp_ajax_phoen_action_city_send","phoen_action_city_send");
		add_action("wp_ajax_nopriv_phoen_action_city_send","phoen_action_city_send");
		
		function phoen_action_city_send(){
			// echo 1;die();
			// print_r($_POST);die();
			$city= isset($_POST['city'])?sanitize_text_field( $_POST['city'] ):'';
			
			$area= isset($_POST['city'])?sanitize_text_field( $_POST['area'] ):'';
			
			$pro_id=isset($_POST['product_id'])?sanitize_text_field( $_POST['product_id'] ):'';
			
			$required=isset($_POST['required'])?sanitize_text_field( $_POST['required'] ):'';
			
			$phen_pincodes_list = get_post_meta( $pro_id, 'phen_pincode_list',true);
			
			$area_list=array();
			$city_list=array();
			$resp='';
			if(isset($phen_pincodes_list) && is_array($phen_pincodes_list) &&  count($phen_pincodes_list) != 0){
				
				foreach($phen_pincodes_list as $min =>$main){
					
					$selected=($area==$main[0])?"selected":'';
					
					if($main[2]==$city){
						
						$resp .= "<option value='".$main[0]."' ".$selected.">".$main[11]."</option>";
						
					}
				}
				
				
			}else{
				
				global $table_prefix, $wpdb, $woocommerce;
			
				$table_pin_codes = $table_prefix."check_pincode_pro";
				
				$query_maine = "SELECT area,pincode FROM `$table_pin_codes` where city='$city'"; 
							
				$ftc_ary = $wpdb->get_results($query_maine);
				
				if(count($ftc_ary)>0){
					foreach($ftc_ary as $key =>$prodss){
						
						$selected=($area==$prodss->pincode)?"selected":'';
						
						$resp .= "<option value='".$prodss->pincode."' ".$selected.">".$prodss->area."</option>";
					}
				}
			}
			
			if($city==''){
				$resp='';
			}
			
			?>
			<select name="area_list" <?if($required==1){ echo 'required'; } ?>  class="area_list" id="phoen_area_list">
				<option value=""><?php _e('Select Area', 'pho-pincode-zipcode-cod'); ?></option>
			<?php echo $resp;?>
			</select>
			<?php
			
			die();
		}
		
		add_shortcode("phoeniixx-pincode-check","phoe_pincode_check");
		
		add_filter( 'widget_text', 'shortcode_unautop');

		add_filter('widget_text', 'do_shortcode');

		add_action('wp_head','hook_css'); //for adding dynamic css in wp head
		
		function hook_css() {
			
			global $table_prefix, $wpdb, $woocommerce,$post;
			
			$showpp = get_option('show_product_page');
						
			$product=wc_get_product($post->ID);
			
			if($showpp == 1)
			{
				if(is_product() && ($product->get_type()=="variable" || $product->get_type()=="simple")){
					if($product->get_type()=="variable"){
						add_action( 'woocommerce_before_single_variation', 'pincode_field', 5 );
					}else{
						add_action( 'woocommerce_before_add_to_cart_button', 'pincode_field', 5 );
					}
				}
				
			}
			
			$plugin_dir_url =  plugin_dir_url( __FILE__ );
			
			wp_enqueue_script( 'pinocde-select2-script',$plugin_dir_url.'assets/js/select2.js' );
		
			wp_enqueue_style( 'pinocde-check_pincode_select2-style',$plugin_dir_url.'assets/css/select2.css' );
			
			$blog_title = site_url();
			
			$plugin_dir_url =  plugin_dir_url( __FILE__ );
			
			$table_pin_codes = $table_prefix."check_pincode_pro";
			
			$qry22 = $wpdb->get_results( "SELECT * FROM `".$table_prefix."pincode_setting_pro` ORDER BY `id` ASC  limit 1" ,ARRAY_A);	
			
			$ppook = "SELECT state,city FROM `$table_pin_codes`";
						
			$ftc_ary = $wpdb->get_results($ppook);
			$state_list=array();
			$city_list=array();
			
			if(isset($ftc_ary) && is_array($ftc_ary)){
				
				foreach($ftc_ary as $key =>$value){
					
					$state_list[]=$value->state;
					
					$city_list[]=$value->city;
					
				}
				
				$ftc_ary_unique=array_unique($state_list);
			
				$city_list_unique=array_unique($city_list);
			}
			$homepageID = get_option('page_on_front');
			$shoppageID = get_option('woocommerce_shop_page_id');
			
			$state_based_pincode =  get_option( 'state_based_pincode' );
			
			$bgcolor =  isset($qry22[0]['bgcolor'])?$qry22[0]['bgcolor']:'';
			
			$textcolor =  isset($qry22[0]['textcolor'])?$qry22[0]['textcolor']:'';
			
			$bordercolor = isset($qry22[0]['bordercolor'])?$qry22[0]['bordercolor']:'';
			
			$buttoncolor = isset($qry22[0]['buttoncolor'])?$qry22[0]['buttoncolor']:'';
			
			$buttontcolor = isset($qry22[0]['buttontcolor'])?$qry22[0]['buttontcolor']:'';
			
			$ttbordercolor = isset($qry22[0]['ttbordercolor'])?$qry22[0]['ttbordercolor']:'';
			
			$ttbagcolor = isset($qry22[0]['ttbagcolor'])?$qry22[0]['ttbagcolor']:'';
			
			$tttextcolor = isset($qry22[0]['tttextcolor'])?$qry22[0]['tttextcolor']:'';
			
			$devbytcolor = isset($qry22[0]['devbytcolor'])?$qry22[0]['devbytcolor']:'';
			
			$codtcolor = isset($qry22[0]['codtcolor'])?$qry22[0]['codtcolor']:'';
			
			$datecolor = isset($qry22[0]['datecolor'])?$qry22[0]['datecolor']:'';
			
			$codmsgcolor = isset($qry22[0]['codmsgcolor'])?$qry22[0]['codmsgcolor']:'';
			
			$errormsgcolor = isset($qry22[0]['errormsgcolor'])?$qry22[0]['errormsgcolor']:'';
			
			$cookie_pin='';
			
			if(isset($_COOKIE['valid_pincode']))
			{
				
				$cookie_pin = $_COOKIE['valid_pincode'];
				
			}
		
			$auto_pch = get_option( 'auto_load_popup' );
			
			$auto_pchs = get_option( 'auto_load_popup_shop_cat' );

			$auto_pch_v = get_option( 'auto_load_validate' );

			$auto_pch_bu = get_option( 'auto_load_block' );
			
			$show_cod_products = get_option( 'show_cod_products' );
			
			$pincode_length = get_option('pincode_length');
			
			$del_info_text = get_option('woo_pin_check_del_info_text');
			
			$del_place_holder_text = get_option('woo_pin_check_place_holder_info_text');
			
			$area_wise_delivery =  get_option( 'area_wise_delivery' );
			
			if( $auto_pch_bu == 1 && !isset($cookie_pin) && !is_front_page() )
			{
				
				header("Location: $blog_title");
				
			}
			
			if( $auto_pch == 1 ) {
				
				if( is_front_page() && empty($cookie_pin) )
				{
					
					$sty_dis = "block";
					
				}
				else
				{
					
					$sty_dis = "none";
					
				}
			
			}
			else
			{
				
				$sty_dis = "none";
				
			}
			// $phoen_shop_popup='0';
			if($show_cod_products==1){
				
				
				if( is_shop() && empty($cookie_pin) )
				{
					
					$sty_dis = "block";
					
				}
				
			}
			$valpp = get_option('val_product_page');
			
			$availableat_text =  get_option( 'availableat_text' );
			
			$avail_at= !empty($availableat_text)?$availableat_text:__('Available at', 'pho-pincode-zipcode-cod');
			//if( !isset($cookie_pin) && $auto_pch == 1 ) {
			
			?>
			<script>
				
				jQuery(document).ready(function(){
			
					jQuery('.payment_method_cod').hide();
					
				});
			</script>
			
			<!--<div class="phoen-cod-html-div" style="display:none;">
				<input id="payment_method_cod" class="input-radio" name="payment_method" value="cod" data-order_button_text="" type="radio">

				<label for="payment_method_cod">Cash on Delivery 	</label>
				<div class="payment_box payment_method_cod" style="display:none;">
					<p>Pay with cash upon delivery.</p>
				</div>
			</div>-->
			
			<div class="phoen-place-order-html-div" style="display:none;">
				<input type="submit" data-value="Place order" value="Place order" id="place_order" name="woocommerce_checkout_place_order" class="button alt">
			</div>
			<script>
				
				var cod_msg1 = "<?php echo $qry22[0]['cod_msg1'];?>";
				
				var cod_msg2 = "<?php echo $qry22[0]['cod_msg2'];?>";
				
				var available_at = ' '+"<?php  echo !empty($availableat_text)?$availableat_text:'Available at'; ?>";
				
				var right_image = "<?php echo esc_url( $plugin_dir_url ).'assets/img/Phoeniixx_Pin_green_tick.png'; ?>";
				
				var required = '<?php echo $valpp;?>';
				
				var not_avail = "<?php echo esc_url( $plugin_dir_url ).'assets/img/phoeniixx_pin_cross.png'; ?>";
				
				var show_pincode_popup = "<?php echo $sty_dis;?>";
				
				var phoen_shop_popup = "<?php echo isset($phoen_shop_popup) ? $phoen_shop_popup:'';?>";
				
				var valid_cookie_pin = "<?php echo $cookie_pin;?>";
				
				var remove_cod = "<?php echo $qry22[0]['cod_p']; ?>";
				
				var remove_place_order = "<?php echo get_option('woo_pin_checkplc_odr_div'); ?>";
					
				var hide_place_no_match = '<?php echo get_option('hide_place_no_match'); ?>';
				
				jQuery(document).ready(function(){
					
					jQuery(".phoen_popup_button").on("click",function()
					{
						jQuery(".pho-pincode-popup-body").show();
					});
					
					if( show_pincode_popup != 'none' && (valid_cookie_pin === '')){
						
						if(woocommerce_pincode_params.entrance=="none"){
							
							jQuery('.pho-pincode-popup-body').show();
							
						}else{
							
								jQuery('.pho-pincode-popup-body').fadeIn();
						
								jQuery('.phoen_chk_pncde_anmt_div').addClass(woocommerce_pincode_params.entrance);
								
								setTimeout(function(){
										
										jQuery('.phoen_chk_pncde_anmt_div').removeClass(woocommerce_pincode_params.entrance);
								
								}, 2500);
								
						}
						
					
						
						
					}else{
						
						setTimeout(function(){
							
							jQuery('.pho-pincode-popup-body').hide();
						
						}, 100);
						
					}					
					
					
					jQuery(".pho-close_btn").click( function(e) {
						
						if(woocommerce_pincode_params.exit=="none"){
							
							jQuery('.pho-pincode-popup-body').hide();
							
						}else{
							
							jQuery('.phoen_chk_pncde_anmt_div').addClass(woocommerce_pincode_params.exit);
												
							setTimeout(function(){
																	
								jQuery('.pho-pincode-popup-body').hide();
								
								jQuery('.phoen_chk_pncde_anmt_div').removeClass(woocommerce_pincode_params.exit);
						
							}, 2500);
						}
						
					});
					
					jQuery("body").on("click",".pho-close_btn_shop", function(e) {
				
						
						if(woocommerce_pincode_params.exit=="none"){
							
							jQuery('.pho-pincode-popup-body').hide();
							
						}else{
							
							jQuery('.phoen_chk_pncde_anmt_div').addClass(woocommerce_pincode_params.exit);
												
							setTimeout(function(){
																	
								jQuery('.pho-pincode-popup-body-shop').hide();
								
								jQuery('.phoen_chk_pncde_anmt_div').removeClass(woocommerce_pincode_params.exit);
						
							}, 2500);
							
						}
						
					});
					
					jQuery("#checkpin").click( function(e) {
					
						jQuery('.delivery-info').removeClass(woocommerce_pincode_params.info_exit);
						
						jQuery('.delivery-info').addClass(woocommerce_pincode_params.info);
							
					});
					
					jQuery("#change_pin").click( function(e) {
						
						jQuery('.delivery-info-wrap .delivery-info').removeClass('hinge');
						
						jQuery('.delivery-info-wrap').hide();
						
						jQuery('.animated').addClass(woocommerce_pincode_params.info_exit);
							
					});
					
				});
				
			</script>
			<?php  if($homepageID !==$shoppageID && ! is_shop()){
				//echo 1;die();?>
				<div class="pho-pincode-popup-body" style="display:none;" >
					
					<div class="phoen-popup-div phoen_chk_pncde_anmt_div animated">
					
						<div class="pincode-pho-popup ">
					
						
								<div class="pho-close_btn" style="display:<?php echo ($auto_pch_v == 1)?"block":'none';?>"> &#10005; </div>
									
								<div class="pho-icon">
								
									<img alt="icon" src="<?php echo $plugin_dir_url; ?>/assets/img/icon.jpg" />
										
										<div class="pho-para">
										
											<p><?php echo $del_info_text; ?> </p>
											
										</div>
										
								</div>
								
								<?php  if($area_wise_delivery!=1){ ?>
								
								<div class="pho-separator"></div>
								
								<form data-siteurl="<?php echo site_url(); ?>" id="pho_home_pck" action="<?php echo admin_url( 'admin-ajax.php' ); ?>" method="post" class="pho-option-form <?php  if(!isset($state_based_pincode) || $state_based_pincode !=1){ echo ' phoen_no_mmies';}?>"> 
								
									<div class="pho-pincode <?php if(isset($state_based_pincode) && $state_based_pincode==1){ echo 'phoen_only_state'; }?>">
									
									
									<?php if(isset($state_based_pincode) && $state_based_pincode==1){
												?><div class="phoen_maie_kked">
												<select name="state_list" class="state_list" id="phoen_state_list">
													<option value=""><?php _e('Select Location', 'pho-pincode-zipcode-cod'); ?></option>
														<?php
														
														foreach($ftc_ary_unique as $key =>$value){
															?>
															<option value="<?php echo  $value;?>"><?php echo  $value;?></option>
															<?php	
														}
														?>
												</select>
													</div>
												<?php
											}?>
									<div class="phoen_min_lower">
										
										<input type="text" id="enter_pincode" name="enter_pincode" maxlength="<?php echo $pincode_length; ?>" placeholder="<?php echo $del_place_holder_text ?$del_place_holder_text:'Enter Pincode';?>" />
										
										<input type="hidden" id="cookie_pin" name="cookie_pin" value="<?php echo $cookie_pin; ?>" />
							
										<input type="submit" value="SUBMIT" class="pho-submit_btn">
										
									</div>
									
									<span id="home_chkpin_loader" style="display:none">
							
										<img alt="ajax-loader" src="<?php echo esc_url( $plugin_dir_url ); ?>assets/img/ajax-loader.gif"/>
											
									</span>
									
									<span id="chkpin_loaderr">
										
											<!--<img src="<?php echo esc_url( $plugin_dir_url ); ?>assets/img/ajax-loader.gif"/>-->
											
											<div class="error_pinn" id="error_pinn" style="display:none"><?php if($qry22[0]['error_msg'] != '' ){ echo esc_html( $qry22[0]['error_msg'] ); }else{ echo "Invalid pincode entered"; } ?></div>
											
												<?php
										
													$error_msg_b =  get_option( 'woo_pin_check_error_msg_b' );
												
												?>
											
											<div class="error_pin" id="error_pin_bn" style="display:none"><?php echo $error_msg_b;  ?></div>
											
									</span>
									</div>
								</form>
								<?php  }else{ ?>
											<div class="pho-separator"></div>
								
											<form data-siteurl="<?php echo site_url(); ?>" id="pho_home_pck" action="<?php echo admin_url( 'admin-ajax.php' ); ?>" method="post" class="pho-option-form phoen_new_area_min"> 
											
												<div class="pho-pincode">
													
													<div class="phoen_state_upper">
														<div class="phoen_city">
															<select name="city_list" class="city_list" id="phoen_city_list">
															
																	<option value="0"><?php _e('Select Location', 'pho-pincode-zipcode-cod'); ?></option>
																	<?php
																	foreach($city_list_unique as $key =>$value){
																		?>
																		<option value="<?php echo  $value;?>"><?php echo  $value;?></option>
																		<?php	
																	}
																	?>
															</select>
														</div>
														<div class="phoen_area" id="phoen_area_select">
															<select name="area_list" class="area_list" id="phoen_area_list">
																<option value="0"><?php _e('Select Area', 'pho-pincode-zipcode-cod'); ?></option>
															</select>
														</div>
													</div>
													
													<input type="hidden" id="cookie_pin" name="cookie_pin" value="<?php echo $cookie_pin; ?>" />
										
													<input type="submit" value="SUBMIT" class="pho-submit_btn">
													
													<span id="home_chkpin_loader" style="display:none">
										
														<img alt="ajax-loader" src="<?php echo esc_url( $plugin_dir_url ); ?>assets/img/ajax-loader.gif"/>
														
													</span>
													
												</div>
												
												<span id="chkpin_loaderr">
													
														<!--<img src="<?php echo esc_url( $plugin_dir_url ); ?>assets/img/ajax-loader.gif"/>-->
														
														<div class="error_pinn" id="error_pinn" style="display:none"><?php if($qry22[0]['error_msg'] != '' ){ echo esc_html( $qry22[0]['error_msg'] ); }else{ echo "Invalid pincode entered"; } ?></div>
														
															<?php
													
																$error_msg_b =  get_option( 'woo_pin_check_error_msg_b' );
															
															?>
														
														<div class="error_pin" id="error_pin_bn" style="display:none"><?php echo $error_msg_b;  ?></div>
														
												</span>
												
											</form>
											<script>
											
											 jQuery(function(){
												 
												 jQuery("select#phoen_city_list").on("change", function(e) { 
													// jQuery("#shop_chkpin_loader").show();
													var selected_city  = jQuery(this).val();
													var phoen_send_ajax_for_city = '<?php echo admin_url('admin-ajax.php') ;?>';
													
													if(selected_city!==""){
														
														jQuery.post(

															phoen_send_ajax_for_city,
															{
																'action'	:  'phoen_action_city_send',
																'city'	:    selected_city
															},
															function(response){
																
																jQuery("#phoen_area_select").html(response);	
																jQuery('.phoen_area #phoen_area_list').select2();
																jQuery("#shop_chkpin_loader").hide();							
															} 	

														); 
														
													}
													
												});
												 
												 
											 });
												
											
											</script>
									<?php  } ?>
						</div> <!-- popup class end -->
						
					</div>	

				</div>
				
				<?php
			}
				
				if( is_shop() || is_product_category() )
				{	
				
					?>			
					
					<div class="pho-pincode-popup-body pho-pincode-popup-body-shop" style="display:none" >
						
						<div class="phoen-popup-div phoen_chk_pncde_anmt_div animated">
					
							<div class="pincode-pho-popup ">
							
								<?php
								
								if($auto_pch_v ==  1)
								{
								
									?>
									
										<div  class="pho-close_btn pho-close_btn_shop"> &#10005; </div>
										
									<?php
								
								}
								
								?>	
									<div class="pho-icon">
									
										<img alt="icon" src="<?php echo $plugin_dir_url; ?>/assets/img/icon.jpg" />
											
											<div class="pho-para">
											
												<p><?php echo $del_info_text; ?> </p>
												
											</div>
											
									</div>
								
									<div class="pho-separator"></div>

									<form id="pho_home_pck_shop" data-siteurl="<?php echo site_url(); ?>" action="<?php echo admin_url( 'admin-ajax.php' ); ?>" method="post" class="pho-option-form <?php if($area_wise_delivery==1){ echo ' phoen_new_area_min'; } if($state_based_pincode !=1&& $area_wise_delivery!=1){ echo 'phoen_no_mmies'; } ?>"> 
								
										<div class="pho-pincode <?php if(isset($state_based_pincode) && $state_based_pincode==1){ echo 'phoen_only_state'; }?>">
										
										
										<?php  if($area_wise_delivery!=1){ ?>
								
										<?php if(isset($state_based_pincode) && $state_based_pincode==1){
												?>
												<div class="phoen_maie_kked">
												<select name="state_list" class="state_list" id="phoen_state_list">
													<option value=""><?php _e('Select Location', 'pho-pincode-zipcode-cod'); ?></option>
														<?php
														
														foreach($ftc_ary_unique as $key =>$value){
															?>
															<option value="<?php echo  $value;?>"><?php echo  $value;?></option>
															<?php	
														}
														?>
												</select>
												</div>
												<?php
											}?>
										
										<div class="phoen_min_lower">
											<input type="text" id="enter_pincode_shop" name="enter_pincode" maxlength="<?php echo $pincode_length; ?>" placeholder="<?php echo $del_place_holder_text ? $del_place_holder_text:'Enter Pincode';?>" />
											
										<input type="hidden" id="cookie_pin_shop" name="cookie_pin" value="<?php echo $cookie_pin; ?>" />

										<input type="hidden" id="popup_pro_id_shop" name="popup_pro_id" value="" />

										<input type="submit" value="<?php _e('SUBMIT', 'pho-pincode-zipcode-cod'); ?>" class="pho-submit_btn" id="pho-submit_btn_shop">

										</div>
										<span id="shop_chkpin_loader1" style="display:none">

											<img alt="ajax-loader" src="<?php echo esc_url( $plugin_dir_url ); ?>assets/img/ajax-loader.gif"/>

										</span>
									</div>
									
							
								<?php  }else{ ?>
										
										<div class="pho-pincode">
													
													<div class="phoen_state_upper">
														<div class="phoen_city phoen_city_min">
															<select name="city_list" class="city_list" id="phoen_city_list">
															
																	<option value="0"><?php _e('Select Location', 'pho-pincode-zipcode-cod'); ?></option>
																	<?php
																	foreach($city_list_unique as $key =>$value){
																		?>
																		<option value="<?php echo  $value;?>"><?php echo  $value;?></option>
																		<?php	
																	}
																	?>
															</select>
														</div>
														<div class="phoen_area_min phoen_area" id="phoen_area_select_aa">
															<select name="area_list" class="area_list" id="phoen_area_list">
																<option value="0"><?php _e('Select Area', 'pho-pincode-zipcode-cod'); ?></option>
															</select>
														</div>
													</div>
													
											<input type="hidden" id="popup_pro_id_shop" name="popup_pro_id" value="" />

											<input type="submit" value="<?php _e('SUBMIT', 'pho-pincode-zipcode-cod'); ?>" class="pho-submit_btn" id="pho-submit_btn_shop">
											
											
													<script>
													jQuery(function(){
														jQuery("select#phoen_city_list").on("change",function(){
												
															var selected_city  = jQuery(this).val();
															
															jQuery("#shop_chkpin_loader").show();
															
															var phoen_send_ajax_for_city = '<?php echo admin_url('admin-ajax.php') ;?>';
															
															var product_id = jQuery(this).attr('data-pro');
						
															// if(selected_city!==""){
																
																jQuery.post(

																	phoen_send_ajax_for_city,
																	{
																		'action'	:  'phoen_action_city_send',
																		'product_id'	:    product_id,
																		'city'	:    selected_city
																	},
																	function(response){
																	
																		jQuery("#phoen_area_select_aa").html(response);	
																		
																		jQuery('.phoen_area #phoen_area_list').select2();
																		
																		jQuery("#shop_chkpin_loader").hide();
																	} 

																); 
																
															// }
															
														});
													});
													</script>
										</div>
								<?php } ?>
											<span id="chkpin_loader_shop">
											
												<!--<img src="<?php echo esc_url( $plugin_dir_url ); ?>assets/img/ajax-loader.gif"/>-->
												
												<div class="error_pin_shop" id="error_pin_shop" style="display:none"><?php if($qry22[0]['error_msg'] != '' ){ echo esc_html( $qry22[0]['error_msg'] ); }else{ echo "Invalid pincode entered"; } ?></div>
												
													<?php
											
														$error_msg_b =  get_option( 'woo_pin_check_error_msg_b' );
													
													?>
												
												<div class="error_pin" id="error_pin_b_shop" style="display:none"><?php echo $error_msg_b;  ?></div>
												
										</span>
										
										<input type="hidden" id="siteurl_shop" value="<?php echo site_url(); ?>" />
										</div>
										
										

									</form>
								
							</div> <!-- popup class end -->
							
						</div>	

					</div>
					
					<?php
					
				}
			
			if( $auto_pchs == 1 )
			{
				
				$enable_ajax_add_to_cart = get_settings('woocommerce_enable_ajax_add_to_cart');
				
				if($enable_ajax_add_to_cart=="yes"){
					
					?>
				<script>
				
					jQuery(document).ready(function($){
							
						if( jQuery('.ajax_add_to_cart').length > 0 )
						{
					
							jQuery(".ajax_add_to_cart").click( function(e) {
																
								$this = jQuery(this);
								
								var is_purchasable =   $this.closest('li').hasClass( "purchasable" );
								
								var is_downloadable =   $this.closest('li').hasClass( "downloadable" );
								
								var is_virtual =   $this.closest('li').hasClass( "virtual" );
								
								var product_id = $this.data('product_id');
								
								if(is_purchasable == true && is_downloadable == false && is_virtual == false)
								{	
							
									jQuery.ajax({
										url : MyAjax.ajaxurl,
										type : 'post',
										data : {
										action :  'picodecheck_ajax_submit_check',
										product_id : product_id
										},
										success : function( response ) 
										{
											// alert(77);
											var result = response.split("####");
											
											console.log( result );
											
											if( result[0] == 11 || result[0] == 10 )
											{
												
												var data_cart = {
													
													product_sku: $this.attr( 'data-product_sku' ),
													
													product_id: $this.attr( 'data-product_id' ),
													
													quantity: $this.attr( 'data-quantity' ),
													
												};
												
												var this_page = window.location.toString();

												this_page = this_page.replace( 'add-to-cart', 'added-to-cart' );
							
												console.log( $this );
												
												$this.removeClass( 'added' );
						
												$this.addClass( 'loading' );

												jQuery.post( jQuery('#siteurl_shop').val()+'/shop/?wc-ajax=add_to_cart', data_cart, function( response ) {
													
													if ( response.error && response.product_url ) {
														
														window.location = response.product_url;
														
														return;
														
													}
													
													  // Redirect to cart option
														if ( wc_add_to_cart_params.cart_redirect_after_add === 'yes' ) {

															window.location = wc_add_to_cart_params.cart_url;
															
															return;

														} 
														else
														{

															$this.removeClass( 'loading' );

															fragments = response.fragments;
															
															cart_hash = response.cart_hash;

															// Block fragments class
															if ( fragments ) {
																
																$.each( fragments, function( key, value ) {
																	
																	$( key ).addClass( 'updating' );
																	
																});
																
															}

															// Block widgets and fragments
															$( '.shop_table.cart, .updating, .cart_totals' ).fadeTo( '400', '0.6' ).block({ message: null, overlayCSS: { background: 'transparent url(' + wc_add_to_cart_params.ajax_loader_url + ') no-repeat center', backgroundSize: '16px 16px', opacity: 0.6 } } );

															// Changes button classes
															$this.addClass( 'added' );

															// View cart text
															if ( ! wc_add_to_cart_params.is_cart && $this.parent().find( '.added_to_cart' ).size() === 0 ) {
																
																$this.after( ' <a class="added_to_cart wc-forward" title="' + wc_add_to_cart_params.i18n_view_cart + '" href="' + wc_add_to_cart_params.cart_url + '">' + wc_add_to_cart_params.i18n_view_cart + '</a>' );
															
															}

															// Replace fragments
															if ( fragments ) {
																
																$.each( fragments, function( key, value ) {
																	
																	$( key ).replaceWith( value );
																	
																});
																
															}

															// Unblock
															$( '.widget_shopping_cart, .updating' ).stop( true ).css( 'opacity', '1' ).unblock();

															// Cart page elements
															$( '.shop_table.cart' ).load( this_page + ' .shop_table.cart:eq(0) > *', function() {

																$( 'div.quantity:not(.buttons_added), td.quantity:not(.buttons_added)' ).addClass( 'buttons_added' ).append( '<input id="add1" class="plus" type="button" value="+" />' ).prepend( '<input id="minus1" class="minus" type="button" value="-" />' );

																$( '.shop_table.cart' ).stop( true ).css( 'opacity', '1' ).unblock();

																$( 'body' ).trigger( 'cart_page_refreshed' );
																
															});

															$( '.cart_totals' ).load( this_page + ' .cart_totals:eq(0) > *', function() {
																
																$( '.cart_totals' ).stop( true ).css( 'opacity', '1' ).unblock();
																
															});

															// Trigger event so themes can refresh other areas
															$( 'body' ).trigger( 'added_to_cart', [ fragments, cart_hash ] );
														}
													
												  //console.log( "Data Loaded: " + response );
												  
												});
																					
											}
											else
											{
										
												jQuery('#popup_pro_id_shop').val(product_id);
												
												jQuery('.pho-pincode-popup-body-shop').show();

											}
											
										},
										error: function (jqXHR, exception) {
						
										jQuery('.pho-pincode-popup-body-shop').show();
											var msg = '';
											if (jqXHR.status === 0) {
												msg = 'Not connect.\n Verify Network.';
											} else if (jqXHR.status == 404) {
												msg = 'Requested page not found. [404]';
											} else if (jqXHR.status == 500) {
												msg = 'Internal Server Error [500].';
											} else if (exception === 'parsererror') {
												msg = 'Requested JSON parse failed.';
											} else if (exception === 'timeout') {
												msg = 'Time out error.';
											} else if (exception === 'abort') {
												msg = 'Ajax request aborted.';
											} else {
												msg = 'Uncaught Error.\n' + jqXHR.responseText;
											}
											
											console.log(msg);
										
										},
										
									});
								
									return false;
									
								}
							
							});
						
						}
						
					});
				
				</script>
				
				<?php
					
					
				}else{
					
					?>
				<script>
				
					jQuery(document).ready(function($){
					
						if( jQuery('.ajax_add_to_cart').length > 0 )
						{
					
							jQuery(".ajax_add_to_cart").click( function(e) {
								
								var valid_pincode="<?php echo isset($_COOKIE['valid_pincode'])?$_COOKIE['valid_pincode']:'99'  ?>";

								$this = jQuery(this);
								
								var is_purchasable =   $this.closest('li').hasClass( "purchasable" );
								
								var is_downloadable =   $this.closest('li').hasClass( "downloadable" );
								
								var is_virtual =   $this.closest('li').hasClass( "virtual" );
								
								var product_id = $this.data('product_id');
								
								if(is_purchasable == true && is_downloadable == false && is_virtual == false)
								{	
					
									jQuery.ajax({
										url : MyAjax.ajaxurl,
										type : 'post',
										data : {
										action :  'picodecheck_ajax_submit_check',
										product_id : product_id
										},
										success : function( response ) 
										{
										
											var result = response.split("####");
											
											console.log( result );
											
											if( result[0] == 11 || result[0] == 10 )
											{
													return;					
											}
											else
											{
												// alert(2112);
												jQuery('#popup_pro_id_shop').val(product_id);
												
												jQuery('.pho-pincode-popup-body-shop').show();
												
												return false;
												
											}
											
										},
										error: function (jqXHR, exception) {
						
										// jQuery('.pho-pincode-popup-body-shop').show();
										

											var msg = '';
											if (jqXHR.status === 0) {
												msg = 'Not connect.\n Verify Network.';
											} else if (jqXHR.status == 404) {
												msg = 'Requested page not found. [404]';
											} else if (jqXHR.status == 500) {
												msg = 'Internal Server Error [500].';
											} else if (exception === 'parsererror') {
												msg = 'Requested JSON parse failed.';
											} else if (exception === 'timeout') {
												msg = 'Time out error.';
											} else if (exception === 'abort') {
												msg = 'Ajax request aborted.';
											} else {
												msg = 'Uncaught Error.\n' + jqXHR.responseText;
											}
											
											console.log(msg);
										
										},
										
									});
								
								
									
								}
								
								<?php echo (empty($_COOKIE['valid_pincode']))?'return false;' :''; ?>
								
							});
						
						}
						
					});
				
				</script>
				
				<?php
					
				}
				
				
			}
		
			?>
			<style>
				
				form.cart{ width:100%;}
				
				form.cart #my_custom_checkout_field #pincode_field_idp label{ <?php if($textcolor == ''){ echo "color:#737070;"; } else { echo "color:$textcolor".';'; }  ?> }
				
				color:#fff;<?php if($buttoncolor == ''){ echo "background:#444446;"; } else { echo "background:$buttoncolor".';'; }  ?> padding: 6px 10px;text-transform: uppercase;  font-weight: normal;border:none;}
				
				.delivery_help_text p{font-size: 14px;<?php if($textcolor == ''){ echo "color:#737070;"; } else { echo "color:$textcolor".';'; }  ?>}
				
				.header .cash_on_delivery_help_text p{font-size: 14px;<?php if($textcolor == ''){ echo "color:#737070;"; } else { echo "color:$textcolor".';'; }  ?>}
			
				.wc-delivery-time-response .delivery-info-wrap div.delivery-info{ background: none repeat scroll 0 0 <?php echo $bgcolor; ?>; <?php if($bordercolor != '') { ?> border: 1px dashed <?php echo $bordercolor; ?>; <?php }else { ?> border: 1px dashed #e5e1e1; <?php } ?> padding:10px;text-align: center;}
				
				.woocommerce-cart .header .delivery_help_text{ <?php if($ttbagcolor == ''){ echo "background:#444446;"; } else { echo "background:$ttbagcolor".';'; }  ?> }
				
				.woocommerce-cart .header .delivery_help_text{ <?php if($ttbordercolor == ''){ echo "border:1px solid #444446;"; } else { echo "border:1px solid $buttoncolor".';'; }  ?> }
				
				.woocommerce-cart .header .delivery_help_text{ color:<?php echo $tttextcolor; ?>; }
				
				.cash_on_delivery_help_text p{font-size: 14px;<?php if($textcolor == ''){ echo "color:#737070;"; } else { echo "color:$textcolor".';'; }  ?>}
				
				.avlpin{ <?php if($bgcolor == ''){ echo "background:#f6f6f8;"; } else { echo "background:$bgcolor".';'; }  ?> }
				
				<!--.avlpin{ <?php //if($bordercolor == ''){ echo "border: 1px solid transparent;"; } else { echo "border: 1px solid $bordercolor".';'; }  ?> }-->
				
				.pin_div{ <?php if($bgcolor == ''){ echo "background:#f6f6f8;"; } else { echo "background:$bgcolor".';'; }  ?> }
				
				<!--.pin_div{ <?php //if($bordercolor == ''){ echo "border: 1px solid transparent;"; } else { echo "border: 1px solid $bordercolor".';'; }  ?> }-->
				
				.pin_div{ <?php if($errormsgcolor == ''){ echo "color:#d95252;"; } else { echo "color:$errormsgcolor".';'; }  ?> margin:24px 0 0; padding:20px 25px; text-align:left; width:100%; display:inline-block; box-sizing:border-box;}
				
				.avlpin p{ <?php if($textcolor == ''){ echo "color:#676767;"; } else { echo "color:$textcolor".';'; }  ?> white-space: pre-wrap; display: inline-block; margin-bottom:0;}
				
				#pincode_field_idp label{<?php if($textcolor == ''){ echo "color:#666666;"; } else { echo "color:$textcolor".';'; }  ?> display: inline-block; margin-right: 5px; font-size:14px; font-weight:700; text-align:left;}
				
				#change_pin.button{ <?php if($buttoncolor == ''){ echo "background:transparent;"; } else { echo "background:$buttoncolor".';'; }  ?> }
				
				#change_pin.button{ <?php if($buttontcolor == ''){ echo "color:#ffffff;"; } else { echo "color:$buttontcolor".';'; }  ?> }
				
				#my_custom_checkout_field2 #pincode_field_idp .button{ <?php if($buttontcolor == ''){ echo "color:#ffffff;"; } else { echo "color:$buttontcolor".';'; }  ?> }
				
				#my_custom_checkout_field2 #pincode_field_idp .button{ <?php if($buttoncolor == ''){ echo "background:#444446;"; } else { echo "background:$buttoncolor".';'; }  ?> }

				.header .delivery_help_text{ <?php if($ttbagcolor == ''){ echo "background:#444446;"; } else { echo "background:$ttbagcolor".';'; }  ?> }
				
				.header .delivery_help_text{ <?php if($ttbordercolor == ''){ echo "border:1px solid #444446;"; } else { echo "border:1px solid $ttbordercolor".';'; }  ?> }
				
				.header .delivery_help_text{ <?php if($tttextcolor == ''){ echo "color:#ffffff;"; } else { echo "color:$tttextcolor".';'; }  ?> }
				
				.header .cash_on_delivery_help_text{ <?php if($ttbagcolor == ''){ echo "background:#444446;"; } else { echo "background:$ttbagcolor".';'; }  ?> }
				
				.header .cash_on_delivery_help_text{ <?php if($ttbordercolor == ''){ echo "border:1px solid #444446;"; } else { echo "border:1px solid $ttbordercolor".';'; }  ?> }
				
				.header .cash_on_delivery_help_text{ <?php if($tttextcolor == ''){ echo "color:#ffffff;"; } else { echo "color:$tttextcolor".';'; }  ?> }
				
				.delivery-info span h6{ color:<?php echo $devbytcolor;?>; }
				
				.cash-on-delivery-info h6{ color:<?php echo $codtcolor;?>; }
					
				.delivery .ul-disc li{ color:<?php echo $datecolor; ?>; }
				
				.cash-on-delivery-info .cash-on-delivery { color: <?php echo $codmsgcolor; ?>; }
				
				.err_pin{ <?php if($errormsgcolor == ''){ echo "color:#d95252;"; } else { echo "color:$errormsgcolor".';'; }  ?> }
				
				.div_pin2{ color:<?php echo $devbytcolor;?>; }
				
				.delivery-info-wrap .header .phoe-pincode-pro-tick-img span h6{
					color:<?php echo $devbytcolor;?>;
				}
				
				.delivery-info-wrap .header .phoe-pincode-pro-tick-img .phoen_delivery .ul-disc{
					color:<?php echo $datecolor;?>;
				}.delivery-info-wrap .header .phoe-pincode-pro-tick-img .phoen_delivery .ul-disc li{
					color:<?php echo $datecolor;?>;
				}
				.cash-on-delivery-info .header .phoe-pincode-pro-tick-img h6{
					color:<?php echo $codtcolor;?>;
				}
				.cash-on-delivery-info .header .phoe-pincode-pro-tick-img .cash-on-delivery{
					color:<?php echo $codmsgcolor;?>;
				}
				
				/* stylesheet */

				.pincode-pho-popup {width:570px; background-color:#f6f6f8; box-shadow:0 0 10px rgba(0, 0, 0, 0.08); padding:3px 0; position:absolute; top:50%; left:50%; transform: translate(-50%, -50%); -webkit-transform: translate(-50%, -50%); }
				
				.pincode-pho-popup .pho-close_btn {text-align:right; cursor:pointer; color:#b5b5b5; font-size:18px; position:absolute; top:0; right:6px; font-family:'Roboto', sans-serif; font-weight:300;}
				
				.pincode-pho-popup .pho-icon img {width:135px; margin:0px auto 25px auto; padding:0; height:auto; max-width:100%;}
				
				.pincode-pho-popup .pho-icon {text-align:center; margin-top:15px;}
				
				.pincode-pho-popup .pho-para p {text-align:center; font-size:23px; font-style:normal; margin:0 0 30px 0; font-weight:700; padding:0 35px; line-height:28px; color:#343434; text-decoration:none; text-shadow:none;}
				
				.pincode-pho-popup .pho-separator { border-top: 1px dashed transparent; margin: 5px auto 30px;}
				
				.pincode-pho-popup .pho-pincode {margin:10px 0; text-align:center; position:relative;}
				
				.pho-pincode span#chkpin_loader {position: absolute; right: -22px; top: 7px;}
								
				.pho-pincode span#home_chkpin_loader, .pho-pincode span#shop_chkpin_loader1 {position: relative; right: 0px; top: 7px;}

				.pincode-pho-popup input {background-color: #fff; vertical-align: top; box-shadow:none; outline:none; font-weight:400; box-sizing:border-box; border: 1px solid #dbd9da; border-radius:0; margin-right:-5px; box-shadow:0 none; font-size:12px; max-width:238px; width: 100%; color: #363636;display: inline-block; padding:5px 10px; margin-top:0;  no-repeat scroll 5px center;position:relative;}
			
				.pincode-pho-popup input#enter_pincode:focus{ background-color:#fff;color: #363636; border-color:#1bbc9b;}
			
				.pho-pincode input#enter_pincode{ padding:5px 5px 5px 35px;height:47px;}
				
				.pho-pincode input#enter_pincode_shop{ padding:5px 5px 5px 35px;height:47px; margin: 0;}
				
				.pho-pincode input:-webkit-autofill {-webkit-box-shadow: 0 0 0 30px white inset;box-shadow: 0 0 0 30px white inset;-moz-box-shadow: 0 0 0 30px white inset;}
				
				.pho-pincode input#enter_pincode_shop:focus{ background-color: #fff; border-color: #1bbc9b; color: #363636;}
			
				.pincode-pho-popup .pho-submit_btn {background:#1bbc9b; vertical-align:top; width:auto; color:#ffffff; height:46px; line-height:46px; font-size:12px; font-weight:400; font-style:normal; letter-spacing:0.5px; cursor:pointer; padding:0 10px; float:none; border: #1bbc9b solid 1px;box-sizing:border-box; border-radius:0;margin-top:0;margin-bottom:0;margin-left:0;margin-right:0;}
				
				
				.pincode-pho-popup .pho-submit_btn:focus{ color:#ffffff; outline:none; box-shadow:none; border-color:#1bbc9b;padding:0 10px;}
				
				.pincode-pho-popup .pho-submit_btn:hover{ border:#1bbc9b solid 1px; box-shadow:none;}
				
				.pincode-pho-popup .pho-submit_btn:active {background:#1bbc9b; border:#1bbc9b solid 1px; color: #fff;padding: 0 10px;outline:none; box-shadow:none;}
				
				.pincode-pho-popup .pho-submit_btn:hover, 
				.pincode-pho-popup .pho-submit_btn:focus {background:#1bbc9b; color:#fff;}
				
				.pincode-pho-popup form {padding-bottom:16px;}
				
				.pincode-pho-popup .pho-select_div { border: 1px solid #dbdbdb; box-shadow:0 none; font-size:12px; height:32px; max-width:260px; width: 100%;display: inline-block; padding:5px 10px; color:#929292;}
				
				.pincode-pho-popup .pho-option-form {width:470px; margin:0 auto; box-sizing:border-box; display: table;}

				.pho-modal-box-backdrop {
					
					background: rgba(238, 238, 238, 0.75);
					
					bottom: 0;
					
					left: 0;
					
					position: absolute;
					
					right: 0;
					
					top: 0;
					
				}

				.pho-pincode-popup-body{
					
					bottom: 0;
					
					display:block;
					
					left: 0;
					
					outline: 0 none;
					
					overflow-y: auto;
					
					position: fixed;
					
					right: 0;
					
					top: 0;
					
					z-index: 999;
					
					background-color:rgba(0, 0, 0, 0.6);
				}
				
				.phoen-popup-div {
					left: 50%;
					margin-left: -285px;
					position: absolute;
					top: 50%;
					width: 570px;
				}
				
				#my_custom_checkout_field2 #pincode_field_idp #pincode_field_id.input-text{ }
				
				#my_custom_checkout_field2 #pincode_field_idp #pincode_field_id.input-text {
					border-left: 1px solid #dadada;
					border-top: 1px solid #dadada;
					border-bottom: 1px solid #dadada;
					border-right: none;
					border-radius:0;
					box-shadow:none;
					overflow:hidden;
					text-shadow:none;
					text-decoration:none;
					box-sizing:border-box;
				}
				
				.wc-delivery-time-response .input-block{
					width:100%;
					padding-right:0;
				}
				
				#my_custom_checkout_field2 #checkpin,
				#my_custom_checkout_field2 #pincode_field_idp .button {
					color:#000;
					border: 1px solid #dadada;
					height:46px;
					background:#fff url("<?php echo esc_url( $plugin_dir_url ); ?>assets/img/1467826915_ChevronRight.png") center center no-repeat;
					background-size:auto;
					padding-right:20px;
					padding-left:20px;
					padding-bottom:0;
					padding-top:0;
					border-radius:0;
					box-shadow:none;
					overflow:hidden;
					text-shadow:none;
					text-decoration:none;
					margin:0;
					box-sizing:border-box;
				}

				.wc-delivery-time-response .delivery-info-wrap .header {
					background-color:#fff;
					
					margin-bottom:0!important;
				}
				
				.wc-delivery-time-response .delivery-info .header .phoe-pincode-pro-tick-img {
					display:inline-block;
					vertical-align:middle;
				}
				
				.wc-delivery-time-response .delivery-info .header .phoe-pincode-pro-tick-img span{
					display:inline-block;
				}
				
				.wc-delivery-time-response {
					margin-bottom:20px;
				}
				
				.wc-delivery-time-response .delivery-info .header .phoe-pincode-pro-tick-img img {
					margin-right:10px;
					max-width:100%;
					height:auto;
					border:none;
					vertical-align:middle;
					display:inline;
				}
				
				.delivery-info-wrap .header .delivery {
					line-height:14px;
				}
				
				.delivery-info-wrap .header .cash-on-delivery {
					line-height:14px;
				}
								
				.error_pin {
					background-color: <?php echo $errormsgcolor?$errormsgcolor:'red'?>;
					border-radius: 5px;
					color: #fff;
					font-size: 12px;
					padding: 6px;
					position:relative;
				}
				
				.error_pin::after {
					border-color: transparent transparent <?php echo $errormsgcolor?$errormsgcolor:'red'?>;
					border-style: solid;
					border-width: 8px;
					content: "";
					left: 8px;
					position: absolute;
					top: -15px;
				}
				
				.error_pin{animation: error 0.4s 1; }
								
				.error_pinn {
					background-color: <?php echo $errormsgcolor?$errormsgcolor:'red'?>;
					border-radius: 5px;
					color: #fff;
					clear: both;
					font-size: 12px;
					padding: 6px;
					position:relative;
				}
				
				.pho-pincode-popup-body .error_pin {
					box-sizing: border-box;
					float: left;
					margin: 13px auto 0;
					width: 100%;
				}
				
				.error_pinn::after {
					border-color: transparent transparent <?php echo $errormsgcolor?$errormsgcolor:'red'?>;
					border-style: solid;
					border-width: 8px;
					content: "";
					left: 8px;
					position: absolute;
					top: -15px;
				}
				
				.error_pinn{animation: error 0.4s 1; }
				
				@keyframes error{
					0%{transform: translateX(5px); -webkit-transform: translateX(5px);}
					20%{transform: translateX(-5px); -webkit-transform: translateX(-5px);}
					40%{transform: translateX(5px); -webkit-transform: translateX(5px);}
					60%{transform: translateX(-5px); -webkit-transform: translateX(-5px);}
					80%{transform: translateX(5px); -webkit-transform: translateX(5px);}
					100%{transform: translateX(5px); -webkit-transform: translateX(5px);}

				}
				
				.error_pin_shop {
					background-color: red;
					border-radius: 5px;
					color: #fff;
					font-size: 12px;
					padding: 6px;
					position:relative;
				}
				
				.error_pin_shop::after {
					border-color: transparent transparent red;
					border-style: solid;
					border-width: 8px;
					content: "";
					left: 8px;
					position: absolute;
					top: -15px;
				}
				
				.error_pin_shop{animation: error 0.4s 1; }
				
				.wc-delivery-time-response .pincode_static_text {
					font-size:18px;
					padding:0;
					margin:0;
					text-shadow:none;
				}
				
				.wc-delivery-time-response .pincode_custom_text {
					font-weight:400;
					padding:0;
					margin:0;
				}
				
				@media only screen and (max-width:480px) {
					.pincode-pho-popup{ 
						width:320px;
					}
					
					.pho-pincode input#enter_pincode{ 
						max-width:100%; 
					}
					
					.pho-pincode input#enter_pincode_shop{ 
						max-width:100%; 
					}
					
					.pincode-pho-popup .pho-option-form {
						width:270px;
						margin-bottom:10px;
					}
									
					.pincode-pho-popup .pho-para p {
						margin-bottom:20px;
					}
					
					.pho-pincode-popup-body .error_pin {
						width:270px;
					}
					
					.pincode-pho-popup .pho-submit_btn {
						padding-left:7px;
						padding-right:7px;
					}
					
					.pincode-pho-popup .pho-icon img {
						margin-bottom:5px;
					}
					
					.pincode-pho-popup .pho-separator {
						margin-bottom:15px;
					}
					
					.pincode-pho-popup .pho-icon {
						margin-top:10px;
					}
				}
				
				@media only screen and (max-width:360px) {
					.pincode-pho-popup{ 
						width:320px;
					}
					
					.pho-pincode input#enter_pincode{ 
						max-width:100%; 
					}
					
					.pho-pincode input#enter_pincode_shop{ 
						max-width:100%; 
					}
					
					.pincode-pho-popup .pho-option-form {
						width:270px;
						margin-bottom:10px;
					}
									
					.pincode-pho-popup .pho-para p {
						margin-bottom:20px;
					}
					
					.pho-pincode-popup-body .error_pin {
						width:270px;
					}
					
					.pincode-pho-popup .pho-icon img {
						margin-bottom:25px;
					}
					
					.pincode-pho-popup .pho-separator {
						margin-bottom:30px;
					}
					
					.pincode-pho-popup .pho-icon {
						margin-top:15px;
					}
				}
				
				@media only screen and (max-width:320px) {
					.pincode-pho-popup{ 
						width:280px;
					}
					
					.pho-pincode input#enter_pincode{ 
						max-width:100%; 
					}
					
					.pho-pincode input#enter_pincode_shop{ 
						max-width:100%; 
					}
					
					.pincode-pho-popup .pho-option-form {
						width:250px;
						margin-bottom:10px;
					}
									
					.pincode-pho-popup .pho-para p {
						font-size:19px;
						line-height:25px;
					}
					
					.pho-pincode-popup-body .error_pin {
						width:250px;
					}
				}

				
			</style>
			
			<?php
		}
				
	}
	
	// add_action('wp_head','phoen_head_minimal');
	
	function phoen_head_minimal($safe_zipcode,$pincode){
		
		global $table_prefix, $wpdb,$woocommerce,$post;
		
		$table_pin_codes = $table_prefix."check_pincode_pro";
		
		if(isset($_COOKIE['valid_pincode'])){
			
			$safe_zipcode = $_COOKIE['valid_pincode'];
		
			$pincode = substr($safe_zipcode, 0, 3);

			$list_products_min=array();
		
			$show_cod_products = get_option( 'show_cod_products' );
			$query_maine="";			
			
			$count = $wpdb->get_var( $wpdb->prepare( "select COUNT(*) from $table_pin_codes where `pincode` = %s ", $safe_zipcode ) );
					
			$like = false;
			
			if( $count == 0  )
			{
				$count_query = "SELECT * FROM `$table_pin_codes` where pincode LIKE '".$wpdb->esc_like($pincode)."%'";
						
				$count_array = $wpdb->get_results($count_query);
				
				$count=count($count_array);
				
				$like = true;
			
			}
			
			if( $count !== 0 )
			{

				if( $like )
				{
					
					$query_maine = "SELECT * FROM `$table_pin_codes` where pincode LIKE '".$wpdb->esc_like($pincode)."%'";
					
				}
				else
				{
					
					$query_maine = "SELECT * FROM `$table_pin_codes` where pincode='$safe_zipcode'"; 
					
				}

			}
			if($query_maine!=''){
				
				$ftc_ary = $wpdb->get_results($query_maine);
				
				$product_list=$ftc_ary[0]->product_list;
				
				//Exclude the product
				if($product_list !=='') {
				
					$list_products_min=explode(",",$product_list);		
					
					
			
				}
				
			}
			
		}
		
			return $list_products_min;	
	}
	
	
	// Exclude Products On Shop Page
	
	add_action('pre_get_posts','phoen_remove_products');

	function phoen_remove_products($query) {	
		
		global $table_prefix, $wpdb,$woocommerce,$post;
		
		$table_pin_codes = $table_prefix."check_pincode_pro";
		
		if(isset($_COOKIE['valid_pincode'])){
			
			$safe_zipcode = $_COOKIE['valid_pincode'];
		
			$pincode = substr($safe_zipcode, 0, 3);
			
		}
		
		$phoen_head_minimal=phoen_head_minimal($safe_zipcode,$pincode);
		
		$query->set('post__not_in', $phoen_head_minimal);
	

   }
   
}
