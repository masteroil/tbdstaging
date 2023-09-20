<?php
global $wpdb,$table_prefix;

if( isset($_GET['action']) && sanitize_text_field( $_GET['action'] ) == 'delete-all' )
{
		
	$delete_all =  $wpdb->query(  "truncate table `".$table_prefix."check_pincode_pro` "  );
	
	if($delete_all == 1)
	{
		
		?>
		
			<div id="message" class="updated">

				<p><strong><?php _e('Successfully Deleted All Pincodes', 'pho-pincode-zipcode-cod'); ?>.</strong></p>

			</div>
			
		<?php
		
	}
		
}

wp_enqueue_script('wp-color-picker'); //for color picker scripts

wp_enqueue_style( 'wp-color-picker' );

wp_enqueue_media();  //for upload media scripts

/* Form Post Data */

if( isset($_POST['reset-style'])) {
	
	update_option('phoen_pincode_info_ext_effct','hinge','yes');
	
	update_option('phoen_pincode_info_ent_effct','bounceInDown','yes');
	
	
	
	$result = $wpdb->query( "UPDATE `".$table_prefix."pincode_setting_pro`  SET  `bgcolor` = '',`textcolor` = '',`bordercolor` = '', `buttoncolor` = '', `buttontcolor` = '', `ttbordercolor` = '', `ttbagcolor` = '', `tttextcolor` = '', `devbytcolor` = '', `codtcolor` = '', `datecolor` = '', `codmsgcolor` = '', `errormsgcolor` = '', `image_size` = '', `image_size1` = '',`help_image` = '', `date_time` = NOW() " );
	
}
if( isset($_POST['reset'])) {
	
	update_option('woo_pin_check_del_info_text','Get item availability info & delivery time for your location.','yes');

	update_option('del_place_holder_text','Enter Pincode','yes');

	update_option('woo_pin_check_checkpin_text','Enter Your Pincode');
	
	update_option('state_based_pincode','0');
	
	update_option('phoen_pincode_ent_effct','bounceInDown','yes');

	update_option('phoen_pincode_ext_effct','hinge','yes');

	update_option('woo_pin_checkplc_odr_div',1,'yes');

	update_option('active_pincode_check',1,'yes');
	
	update_option('show_product_page',1,'yes');
	
	update_option('val_product_page',1,'yes');
	
	update_option('show_d_est',1,'yes');
	
	update_option('show_cod_a',1,'yes');
	
	update_option('pincode_length', '6');
	
	update_option( 'woo_pin_check_error_msg_b', 'Pincode should not be blank.');
	
	update_option( 'woo_pin_check_show_s_on_pro', '1');

	update_option( 'woo_pin_check_show_c_on_pro', '1');
	
	update_option( 'woo_pin_check_show_d_d_on_pro', '1');
	
	update_option( 'auto_load_popup', '0');
	
	update_option( 'auto_load_popup_shop_cat', '1');
	
	update_option( 'auto_load_validate', '1');
	
	update_option( 'auto_load_block', '0');
		

		
	$qry22 = $wpdb->get_results( "SELECT * FROM `".$table_prefix."pincode_setting_pro` ORDER BY `id` ASC  limit 1" ,ARRAY_A);	

	foreach($qry22 as $qry) {

	}
	
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
		
		$result = $wpdb->query( "UPDATE `".$table_prefix."pincode_setting_pro`  SET `del_help_text` = '$del_help_text', `cod_help_text` = '$cod_help_text', `cod_msg1` = '$cod_msg1', `cod_msg2` = '$cod_msg2', `error_msg` = '$error_msg', `del_date` = '$del_date', `cod` = '$cod', `s_s` = '$s_s', `s_s1` = '$s_s1', `cod_p` = '$cod_p', `delv_by_cart` = '', `val_checkout` = '$val_checkout' , `date_time` = NOW() " );
		
}
if( isset($_POST['submit-style'])) {
	
	$info_ent_effct =  isset($_POST['info_ent_effct'])?sanitize_text_field( $_POST['info_ent_effct'] ):'';
	
	update_option('phoen_pincode_info_ent_effct', $info_ent_effct);
	
	$info_ext_effct =  isset($_POST['info_ext_effct'])?sanitize_text_field( $_POST['info_ext_effct'] ):'';
	
	update_option('phoen_pincode_info_ext_effct', $info_ext_effct);
	
	
	$bgcolor =  isset($_POST['bgcolor'])?sanitize_text_field( $_POST['bgcolor'] ):'';
	
	$textcolor =  isset($_POST['textcolor'])?sanitize_text_field( $_POST['textcolor'] ):'';

	$bordercolor = isset($_POST['bordercolor'])?sanitize_text_field( $_POST['bordercolor'] ):'';

	$buttoncolor =  isset($_POST['buttoncolor'])?sanitize_text_field( $_POST['buttoncolor'] ):'';

	$buttontcolor =  isset($_POST['buttontcolor'])?sanitize_text_field( $_POST['buttontcolor'] ):'';

	$ttbordercolor =  isset($_POST['ttbordercolor'])?sanitize_text_field( $_POST['ttbordercolor'] ):'';

	$ttbagcolor =  isset($_POST['ttbagcolor'])?sanitize_text_field( $_POST['ttbagcolor'] ):'';

	$tttextcolor =isset($_POST['tttextcolor'])?sanitize_text_field( $_POST['tttextcolor'] ):'';

	$devbytcolor =  isset($_POST['devbytcolor'])?sanitize_text_field( $_POST['devbytcolor'] ):'';

	$codtcolor = isset($_POST['codtcolor'])?sanitize_text_field( $_POST['codtcolor'] ):'';

	$datecolor =  isset($_POST['datecolor'])?sanitize_text_field( $_POST['datecolor'] ):'';

	$codmsgcolor =  isset($_POST['codmsgcolor'])?sanitize_text_field( $_POST['codmsgcolor'] ):'';

	$errormsgcolor =  isset($_POST['errormsgcolor'])?sanitize_text_field( $_POST['errormsgcolor'] ):'';

	$image_size =  isset($_POST['image_size'])?sanitize_text_field( $_POST['image_size'] ):'';
	
	$image_size1 =  isset($_POST['image_size1'])?sanitize_text_field( $_POST['image_size1'] ):'';

	$help_image = isset($_POST['help_image'])?sanitize_text_field( $_POST['help_image'] ):'';
	
	
	/* Database Queries */
	
	$num_rows = $wpdb->get_var( "SELECT COUNT(*) FROM `".$table_prefix."pincode_setting_pro` " );

	if($num_rows == 0)
	{
	
		$result = $wpdb->query( "INSERT INTO `".$table_prefix."pincode_setting_pro` (  `bgcolor`, `textcolor`, `bordercolor`, `buttoncolor`, `buttontcolor`, `ttbordercolor`, `ttbagcolor`, `tttextcolor`, `devbytcolor`, `codtcolor`, `datecolor`, `codmsgcolor`, `errormsgcolor` , `image_size`, `image_size1`,`help_image`,`date_time`) VALUES ($bgcolor', '$textcolor', '$bordercolor', '$buttoncolor', '$buttontcolor', '$ttbordercolor', '$ttbagcolor', '$tttextcolor', '$devbytcolor', '$codtcolor', '$datecolor', '$codmsgcolor', '$errormsgcolor' , '$image_size', '$image_size1', '$help_image',NOW())" );
	
	}
	else
	{
		
		$result = $wpdb->query( "UPDATE `".$table_prefix."pincode_setting_pro`  SET  `bgcolor` = '$bgcolor', `textcolor` = '$textcolor', `bordercolor` = '$bordercolor', `buttoncolor` = '$buttoncolor', `buttontcolor` = '$buttontcolor', `ttbordercolor` = '$ttbordercolor', `ttbagcolor` = '$ttbagcolor', `tttextcolor` = '$tttextcolor', `devbytcolor` = '$devbytcolor', `codtcolor` = '$codtcolor', `datecolor` = '$datecolor', `codmsgcolor` = '$codmsgcolor', `errormsgcolor` = '$errormsgcolor', `image_size` = '$image_size', `image_size1` = '$image_size1', `help_image` = '$help_image',`date_time` = NOW() " );
	
	}

}
if( isset($_POST['submit'])) {

	$del_help_text = isset($_POST['del_help_text'])?sanitize_text_field( $_POST['del_help_text'] ):'';

	$cod_help_text = isset($_POST['cod_help_text'])?sanitize_text_field( $_POST['cod_help_text'] ):'';

	$cod_msg1 = isset($_POST['cod_msg1'])?sanitize_text_field( $_POST['cod_msg1'] ):'';

	$cod_msg2 =  isset($_POST['cod_msg2'])?sanitize_text_field( $_POST['cod_msg2'] ):'';

	$error_msg =  isset($_POST['error_msg'])?sanitize_text_field( $_POST['error_msg'] ):'';
	
	$success_msg_b =  isset($_POST['success_msg_b'])?sanitize_text_field( $_POST['success_msg_b'] ):'';
	
	$error_msg_b = isset($_POST['error_msg_b'])?sanitize_text_field( $_POST['error_msg_b'] ):'';

	$del_date =  isset($_POST['del_date'])?sanitize_text_field( $_POST['del_date'] ):'';

	$cod =  isset($_POST['cod'])?sanitize_text_field( $_POST['cod'] ):'';
	
	$s_s =  isset($_POST['s_s'])?sanitize_text_field( $_POST['s_s'] ):'';

	$s_s1 =  isset($_POST['s_s1'])?sanitize_text_field( $_POST['s_s1'] ):'';
	
	$enable_cod =  isset($_POST['enable_cod'])?sanitize_text_field( $_POST['enable_cod'] ):'';

	$cod_p =  isset($_POST['cod_p'])?sanitize_text_field( $_POST['cod_p'] ):'';
	
	$delv_by_cart =  isset($_POST['delv_by_cart'])?sanitize_text_field( $_POST['delv_by_cart'] ):'';

	$val_checkout =  isset($_POST['val_checkout'])?sanitize_text_field( $_POST['val_checkout'] ):'';

	$unsuccess_msg_b =  isset($_POST['unsuccess_msg_b'])?sanitize_text_field( $_POST['unsuccess_msg_b'] ):'';
	
	$unsuccess_msg_l = isset($_POST['unsuccess_msg_l'])?sanitize_text_field( $_POST['unsuccess_msg_l'] ):'';
	
	$unsuccess_msg_lt = isset($_POST['unsuccess_msg_lt'])?sanitize_text_field( $_POST['unsuccess_msg_lt'] ):'';
	
	$link_invalid_pin =  isset($_POST['link_invalid_pin'])?sanitize_text_field( $_POST['link_invalid_pin'] ):'';
	
	update_option( 'woo_pin_checksuccess_msg_b', $success_msg_b );
	
	update_option( 'enable_cod', $enable_cod );
	
	update_option( 'unsuccess_msg_b', $unsuccess_msg_b );
	
	update_option( 'unsuccess_msg_l', $unsuccess_msg_l );
	
	update_option( 'unsuccess_msg_lt', $unsuccess_msg_lt );
	
	update_option( 'link_invalid_pin', $link_invalid_pin );
	
	$plc_odr =  isset($_POST['plc_odr'])?sanitize_text_field( $_POST['plc_odr'] ):'';
	
	$hide_place_no_match =  isset($_POST['hide_place_no_match'])?sanitize_text_field( $_POST['hide_place_no_match'] ):'';
	
	update_option( 'woo_pin_checkplc_odr_div', $plc_odr );
	
	update_option( 'hide_place_no_match', $hide_place_no_match);
	
	$area_wise_delivery =  isset($_POST['area_wise_delivery'])?sanitize_text_field( $_POST['area_wise_delivery'] ):'';
	
	update_option( 'area_wise_delivery', $area_wise_delivery );
	
	$del_label =  isset($_POST['del_label'])?sanitize_text_field( $_POST['del_label'] ):'';
	
	update_option( 'woo_pin_check_del_label', $del_label );
	
	$del_info_text =  isset($_POST['del_info_text'])?sanitize_text_field( $_POST['del_info_text'] ):'';
	
	update_option( 'woo_pin_check_del_info_text', $del_info_text);
	
	$popup_button_text =  isset($_POST['popup_button_text'])?sanitize_text_field( $_POST['popup_button_text'] ):'';
	
	update_option( 'popup_button_text', $popup_button_text );
	
	$del_place_holder_text =  isset($_POST['del_place_holder_text'])?sanitize_text_field( $_POST['del_place_holder_text'] ):'';
	
	update_option( 'woo_pin_check_place_holder_info_text', $del_place_holder_text );
	
	$checkpin_text =  isset($_POST['checkpin_text'])?sanitize_text_field( $_POST['checkpin_text'] ):'';
	
	update_option( 'woo_pin_check_checkpin_text', $checkpin_text );

	$checkpintext =  isset($_POST['checkpintext'])?sanitize_text_field( $_POST['checkpintext'] ):'';
	
	update_option( 'checkpintext', $checkpintext );
	
	$textascheck =  isset($_POST['textascheck'])?sanitize_text_field( $_POST['textascheck'] ):'';
	
	update_option( 'textascheck', $textascheck );
	
	$cod_label =  isset($_POST['cod_label'])?sanitize_text_field( $_POST['cod_label'] ):'';
	
	update_option( 'woo_pin_check_cod_label', $cod_label );
	
	$availableat_text =  isset($_POST['availableat_text'])?sanitize_text_field( $_POST['availableat_text'] ):'';
	
	update_option( 'availableat_text', $availableat_text );
	
	$show_s_on_pro =  isset($_POST['show_s_on_pro'])?sanitize_text_field( $_POST['show_s_on_pro'] ):'';
	
	update_option( 'woo_pin_check_show_s_on_pro', $show_s_on_pro );
	
	$show_c_on_pro =  isset($_POST['show_c_on_pro'])?sanitize_text_field( $_POST['show_c_on_pro'] ):'';
	
	update_option( 'woo_pin_check_show_c_on_pro', $show_c_on_pro);
	
	$error_msg_b =  isset($_POST['error_msg_b'])?sanitize_text_field( $_POST['error_msg_b'] ):'';
	
	update_option( 'woo_pin_check_error_msg_b', $error_msg_b);
	
	$show_d_d_on_pro =  isset($_POST['show_d_d_on_pro'])?sanitize_text_field( $_POST['show_d_d_on_pro'] ):'';
	
	update_option( 'woo_pin_check_show_d_d_on_pro', $show_d_d_on_pro);
	
	$checkpc =  isset($_POST['checkpc'])?sanitize_text_field( $_POST['checkpc'] ):'';
	
	update_option('active_pincode_check', $checkpc);
	
	$showpp =  isset($_POST['showpp'])?sanitize_text_field( $_POST['showpp'] ):'';
	
	update_option('show_product_page', $showpp);
	
	$valpp =  isset($_POST['valpp'])?sanitize_text_field( $_POST['valpp'] ):'';
		
	update_option('val_product_page', $valpp);
	
	$show_d_est =  isset($_POST['show_d_est'])?sanitize_text_field( $_POST['show_d_est'] ):'';
	
	update_option('show_deli_est', $show_d_est);
	
	$state_based_pincode =  isset($_POST['state_based_pincode'])?sanitize_text_field( $_POST['state_based_pincode'] ):'';
	
	update_option('state_based_pincode', $state_based_pincode);
	
	$show_cod_a =  isset($_POST['show_cod_a'])?sanitize_text_field( $_POST['show_cod_a'] ):'';
	
	update_option('show_cod_a', $show_cod_a);
	
	$auto_pch =  isset($_POST['auto_pch'])?sanitize_text_field( $_POST['auto_pch'] ):'';
	
	update_option('auto_load_popup', $auto_pch);
	
	$show_cod_products =  isset($_POST['show_cod_products'])?sanitize_text_field( $_POST['show_cod_products'] ):'';
	
	update_option('show_cod_products', $show_cod_products);
	
	$auto_pchs =  isset($_POST['auto_pchs'])?sanitize_text_field( $_POST['auto_pchs'] ):'';
	
	update_option('auto_load_popup_shop_cat', $auto_pchs);
	
	$auto_pch_v =  isset($_POST['auto_pch_v'])?sanitize_text_field( $_POST['auto_pch_v'] ):'';
	
	update_option('auto_load_validate', $auto_pch_v);
	
	$auto_pch_bu =  isset($_POST['auto_pch_bu'])?sanitize_text_field( $_POST['auto_pch_bu'] ):'';
	
	update_option('auto_load_block', $auto_pch_bu);
	
	$popup_ent_effct =  isset($_POST['popup_ent_effct'])?sanitize_text_field( $_POST['popup_ent_effct'] ):'';
	
	update_option('phoen_pincode_ent_effct', $popup_ent_effct);
	
	$popup_ext_effct =  isset($_POST['popup_ext_effct'])?sanitize_text_field( $_POST['popup_ext_effct'] ):'';
	
	update_option('phoen_pincode_ext_effct', $popup_ext_effct);
	
	$pincode_len =  isset($_POST['pincode_len'])?sanitize_text_field( $_POST['pincode_len'] ):'';
	
	update_option('pincode_length', $pincode_len);
	
	
	$adddate = date('Y-m-d H:i:s');

	/* Database Queries */
	
	$num_rows = $wpdb->get_var( "SELECT COUNT(*) FROM `".$table_prefix."pincode_setting_pro` " );

	if($num_rows == 0)
	{
	
		$result = $wpdb->query( "INSERT INTO `".$table_prefix."pincode_setting_pro` (`del_help_text`, `cod_help_text`, `cod_msg1`, `cod_msg2`, `error_msg`, `del_date`, `cod`, `s_s`, `s_s1`, `cod_p`, `delv_by_cart`, `val_checkout`,`date_time`) VALUES ('$del_help_text', '$cod_help_text', '$cod_msg1', '$cod_msg2', '$error_msg', '$del_date', '$cod','$s_s', '$s_s1', '$cod_p', '$delv_by_cart', '$val_checkout',NOW())" );
	
	}
	else
	{
		
		$result = $wpdb->query( "UPDATE `".$table_prefix."pincode_setting_pro`  SET `del_help_text` = '$del_help_text', `cod_help_text` = '$cod_help_text', `cod_msg1` = '$cod_msg1', `cod_msg2` = '$cod_msg2', `error_msg` = '$error_msg', `del_date` = '$del_date', `cod` = '$cod', `s_s` = '$s_s', `s_s1` = '$s_s1', `cod_p` = '$cod_p', `delv_by_cart` = '$delv_by_cart', `val_checkout` = '$val_checkout',`date_time` = NOW() " );
	
	}
	
	if($result == 1)
	{
	?>

		<div class="updated" id="message">

			<p><strong><?php _e('Setting updated', 'pho-pincode-zipcode-cod'); ?>.</strong></p>

		</div>

	<?php
	}
	else
	{
		?>
			<div class="error below-h2" id="message"><p><?php _e('Something Went Wrong Please Try Again With Valid Data', 'pho-pincode-zipcode-cod'); ?>.</p></div>
		<?php
	}

}

$success_msg_b = get_option('woo_pin_checksuccess_msg_b');

$unsuccess_msg_b = get_option('unsuccess_msg_b');

$unsuccess_msg_l = get_option('unsuccess_msg_l');

$unsuccess_msg_lt = get_option('unsuccess_msg_lt');

$link_invalid_pin = get_option('link_invalid_pin');

$active_pincode_check = get_option('active_pincode_check');

$textascheck = get_option('textascheck');

$checkpintext = get_option('checkpintext');

/* Fetching Data From DB */
$del_label =  get_option( 'woo_pin_check_del_label' );

$del_info_text = get_option('woo_pin_check_del_info_text');

$popup_button_text = get_option('popup_button_text');

$del_place_holder_text = get_option('woo_pin_check_place_holder_info_text');

$cod_label =  get_option( 'woo_pin_check_cod_label' );

$availableat_text =  get_option( 'availableat_text' );

$show_s_on_pro =  get_option( 'woo_pin_check_show_s_on_pro' );

$show_c_on_pro =  get_option( 'woo_pin_check_show_c_on_pro' );

$error_msg_b =  get_option( 'woo_pin_check_error_msg_b' );

$checkpin_text =  get_option( 'woo_pin_check_checkpin_text' );

$show_d_d_on_pro =  get_option( 'woo_pin_check_show_d_d_on_pro' );

$showpp = get_option('show_product_page');

$valpp = get_option('val_product_page');

$show_d_est = get_option('show_deli_est');

$show_cod_a = get_option('show_cod_a');

$auto_pch = get_option( 'auto_load_popup' );

$state_based_pincode = get_option( 'state_based_pincode' );

$auto_pchs = get_option( 'auto_load_popup_shop_cat' );

$auto_pch_v = get_option( 'auto_load_validate' );

$show_cod_products = get_option( 'show_cod_products' );

$auto_pch_bu = get_option( 'auto_load_block' );

$popup_ent_effct = get_option( 'phoen_pincode_ent_effct' );

$enable_cod = get_option( 'enable_cod' );

$popup_ext_effct = get_option( 'phoen_pincode_ext_effct' );

$info_ent_effct = get_option( 'phoen_pincode_info_ent_effct' );

$info_ext_effct =  get_option( 'phoen_pincode_info_ext_effct' );

$_plc_odr_div =  get_option( 'woo_pin_checkplc_odr_div' );

$hide_place_no_match =  get_option( 'hide_place_no_match' );

$area_wise_delivery =  get_option( 'area_wise_delivery' );

$pincode_length = get_option('pincode_length');

$qry22 = $wpdb->get_results( "SELECT * FROM `".$table_prefix."pincode_setting_pro` ORDER BY `id` ASC  limit 1" ,ARRAY_A);	

foreach($qry22 as $qry) {

}
$tab = isset($_GET['tab'])?sanitize_text_field($_GET['tab']):'';
?>

<div id="profile-page" class="wrap phoen_check_pin_wrap">

<h2><?php _e('WooCommerce Pincode Check - Plugin Options', 'pho-pincode-zipcode-cod'); ?></h2>

<form method="post" action="">
<div id="profile-page" class="wrap">
<h2 class="nav-tab-wrapper woo-nav-tab-wrapper">
	<a class="nav-tab <?php if($tab == 'setting' || $tab == ''){ echo esc_attr( "nav-tab-active" ); } ?>" href="?page=pincodes_setting&amp;tab=setting"><?php _e('Settings', 'pho-pincode-zipcode-cod'); ?></a>
	<a class="nav-tab <?php if($tab == 'style'){ echo esc_attr( "nav-tab-active" ); } ?>" href="?page=pincodes_setting&amp;tab=style"> <?php _e('Style', 'pho-pincode-zipcode-cod'); ?></a>
</h2>

<?php  if($tab == 'setting' || $tab == '')
		{ ?>
	<table class="form-table">

	<tbody>
	
		<tr class="user-user-login-wrap">

			<th><label for="checkpc"><?php _e('Enable pincode check', 'pho-pincode-zipcode-cod'); ?> </label></th>
			
			<td><input type="checkbox" value="1" <?php if($active_pincode_check == 1){ echo "checked"; } ?> id="checkpc" name="checkpc" ></td>

		</tr>
		
		<tr class="user-user-login-wrap">

			<th><label for="pincode_len"><?php _e('Pincode length', 'pho-pincode-zipcode-cod'); ?></label></th>
			
			<td><input type="number" value="<?php echo $pincode_length; ?>" id="pincode_len" name="pincode_len" min="1" /></td>

		</tr>
		
		<tr class="user-user-login-wrap">

			<th><label for="showpp"><?php _e('Show on product page', 'pho-pincode-zipcode-cod'); ?> </label></th>
			
			<td><input type="checkbox" value="1" <?php if($showpp == 1){ echo "checked"; } ?> id="showpp" name="showpp" ></td>

		</tr>	
		
		<tr class="v-d-p-p">

			<th><label for="valpp"><?php _e('Validation on product page', 'pho-pincode-zipcode-cod'); ?> </label></th>
			
			<td><input type="checkbox" value="1" <?php if($valpp == 1){ echo "checked"; } ?> id="valpp" name="valpp" ></td>

		</tr>
		
		<tr class="user-user-login-wrap">

			<th><label for="enable_cod"><?php _e('Enable COD charges', 'pho-pincode-zipcode-cod'); ?> </label></th>
			
			<td><input type="checkbox" value="1" <?php if($enable_cod == 1){ echo "checked"; } ?> id="enable_cod" name="enable_cod" ></td>

		</tr>
		<tr class="user-user-login-wrap">

			<th><label for="del_label"><?php _e('Delivery date label', 'pho-pincode-zipcode-cod'); ?></label></th>
			
			<td><textarea class="regular-text" id="del_label" name="del_label"><?php echo $del_label; ?></textarea></td>

		</tr>
		
		<tr class="user-user-login-wrap">

			<th><label for="del_help_text"><?php _e('Delivery date help text', 'pho-pincode-zipcode-cod'); ?></label></th>
			
			<td><textarea class="regular-text" id="del_help_text" name="del_help_text"><?php echo $qry['del_help_text']; ?></textarea></td>

		</tr>
		
		<tr class="user-user-login-wrap">

			<th><label for="cod_label"><?php _e('COD label', 'pho-pincode-zipcode-cod'); ?></label></th>
			
			<td><textarea class="regular-text" id="cod_label" name="cod_label"><?php echo $cod_label; ?></textarea></td>

		</tr>
		<tr class="user-user-login-wrap">

			<th><label for="availableat_text"><?php _e('Heading text(Available)', 'pho-pincode-zipcode-cod'); ?></label></th>
			
			<td><textarea class="regular-text" id="availableat_text" name="availableat_text"><?php echo $availableat_text; ?></textarea></td>

		</tr>

		<tr class="user-first-name-wrap">

			<th><label for="cod_help_text"><?php _e('COD help text', 'pho-pincode-zipcode-cod'); ?></label></th>

			<td><textarea class="regular-text" id="cod_help_text" name="cod_help_text"><?php echo $qry['cod_help_text']; ?></textarea></td>

		</tr>

		<tr class="user-last-name-wrap">

			<th><label for="cod_msg1"><?php _e('COD message(Available)', 'pho-pincode-zipcode-cod'); ?></label></th>

			<td><textarea class="regular-text" id="cod_msg1" name="cod_msg1"><?php echo $qry['cod_msg1']; ?></textarea></td>

		</tr>

		<tr class="user-last-name-wrap">

			<th><label for="cod_msg2"><?php _e('COD message(Not Available)', 'pho-pincode-zipcode-cod'); ?></label></th>

			<td><textarea class="regular-text" id="cod_msg2" name="cod_msg2"><?php echo $qry['cod_msg2']; ?></textarea></td>

		</tr>
		
		<tr class="user-nickname-wrap">

			<th><label for="error_msg_b"><?php _e('Error message on blank & less than pincode length', 'pho-pincode-zipcode-cod'); ?></label></th>

			<td><textarea class="regular-text" id="error_msg_b" name="error_msg_b"><?php echo $error_msg_b; ?></textarea></td>

		</tr>

		<tr class="user-nickname-wrap">

			<th><label for="error_msg"><?php _e('Error message after checking pincode', 'pho-pincode-zipcode-cod'); ?></label></th>

			<td><textarea class="regular-text" id="error_msg" name="error_msg"><?php echo $qry['error_msg']; ?></textarea></td>

		</tr>
		<tr class="user-nickname-wrap">

			<th><label for="checkpin_text"><?php _e('Check pincode input placeholder text', 'pho-pincode-zipcode-cod'); ?></label></th>

			<td><textarea class="regular-text" id="error_msg" name="checkpin_text"><?php echo $checkpin_text; ?></textarea></td>

		</tr>
		
		<tr class="user-nickname-wrap">

			<th><label for="s_s"><?php _e('Delivery on saturday', 'pho-pincode-zipcode-cod'); ?></label></th>

			<td><label for="s_s"><input type="radio" name="s_s" <?php if($qry['s_s'] == 1) { ?> checked <?php } ?> value="1"><?php _e('ON', 'pho-pincode-zipcode-cod'); ?></label>

			<label for="s_s"><input type="radio" name="s_s" <?php if($qry['s_s'] == 0) { ?> checked <?php } ?> value="0"><?php _e('OFF', 'pho-pincode-zipcode-cod'); ?></label></td>

		</tr>
		
		<tr class="user-nickname-wrap">

			<th><label for="s_s1"><?php _e('Delivery on sunday', 'pho-pincode-zipcode-cod'); ?></label></th>

			<td><label for="s_s1"><input type="radio" name="s_s1" <?php if($qry['s_s1'] == 1) { ?> checked <?php } ?> value="1"><?php _e('ON', 'pho-pincode-zipcode-cod'); ?></label>

			<label for="s_s1"><input type="radio" name="s_s1" <?php if($qry['s_s1'] == 0) { ?> checked <?php } ?> value="0"><?php _e('OFF', 'pho-pincode-zipcode-cod'); ?></label></td>

		</tr>

		
		<tr class="user-nickname-wrap">

			<th><label for="cod_p"><?php _e('Enable check pincode based COD on checkout page', 'pho-pincode-zipcode-cod'); ?></label></th>

			<td><label for="cod_p"><input type="radio" name="cod_p" <?php if($qry['cod_p'] == 1) { ?> checked <?php } ?> value="1"><?php _e('ON', 'pho-pincode-zipcode-cod'); ?></label>

			<label for="cod_p"><input type="radio" name="cod_p" <?php if($qry['cod_p'] == 0) { ?> checked <?php } ?> value="0"><?php _e('OFF', 'pho-pincode-zipcode-cod'); ?></label></td>

		</tr>
		
		<tr class="user-nickname-wrap">

			<th><label for="plc_odr_show"><?php _e('Enable check pincode based place order on checkout page', 'pho-pincode-zipcode-cod'); ?></label></th>

			<td><label for="plc_odr_show"><input type="radio" <?php if($_plc_odr_div == 1) { ?> checked <?php } ?> name="plc_odr" value="1"><?php _e('ON', 'pho-pincode-zipcode-cod'); ?></label>

			<label for="plc_odr_show"><input type="radio" <?php if($_plc_odr_div == 0) { ?> checked <?php } ?> name="plc_odr" value="0"><?php _e('OFF', 'pho-pincode-zipcode-cod'); ?></label></td>

		</tr>
		<tr class="user-nickname-wrap">

			<th><label for="hide_place_no_match"><?php _e('Hide place order if pincode not in list  on checkout page', 'pho-pincode-zipcode-cod'); ?></label></th>

			<td><label for="hide_place_no_match"><input type="radio" <?php if($hide_place_no_match == 1) { ?> checked <?php } ?> name="hide_place_no_match" value="1"><?php _e('ON', 'pho-pincode-zipcode-cod'); ?></label>

			<label for="hide_place_no_match"><input type="radio" <?php if($hide_place_no_match == 0) { ?> checked <?php } ?> name="hide_place_no_match" value="0"><?php _e('OFF', 'pho-pincode-zipcode-cod'); ?></label></td>

		</tr>
		<tr class="user-nickname-wrap">

			<th><label for="area_wise_delivery"><?php _e('Enable area based delivery option', 'pho-pincode-zipcode-cod'); ?></label></th>

			<td><label for="area_wise_delivery"><input type="radio" class="area_wise_delivery" <?php if($area_wise_delivery == 1) { ?> checked <?php } ?> name="area_wise_delivery" value="1"><?php _e('ON', 'pho-pincode-zipcode-cod'); ?></label>

			<label for="area_wise_delivery"><input type="radio" class="area_wise_delivery" <?php if($area_wise_delivery == 0) { ?> checked <?php } ?> name="area_wise_delivery" value="0"><?php _e('OFF', 'pho-pincode-zipcode-cod'); ?></label></td>

		</tr>
		<tr class="user-nickname-wrap">

			<th><label for="state_based_pincode"><?php _e('Enable state based pincode search', 'pho-pincode-zipcode-cod'); ?></label></th>

			<td>
			<label for="state_based_pincode"><input type="radio" class="state_based_pincode" name="state_based_pincode" <?php if($state_based_pincode == 1) { ?> checked <?php } ?> value="1"><?php _e('On', 'pho-pincode-zipcode-cod'); ?></label>
			<label for="state_based_pincode"><input type="radio" class="state_based_pincode" name="state_based_pincode" <?php if($state_based_pincode == 0) { ?> checked <?php } ?> value="0"><?php _e('OFF', 'pho-pincode-zipcode-cod'); ?></label>
			
			</td>
			
		</tr>
				
		<tr class="user-nickname-wrap">

			<th><label for="delv_by_cart"><?php _e('Show state on product page', 'pho-pincode-zipcode-cod'); ?></label></th>

			<td><label for="delv_by_cart"><input type="radio" name="show_s_on_pro" <?php if($show_s_on_pro == 1) { ?> checked <?php } ?> value="1"><?php _e('ON', 'pho-pincode-zipcode-cod'); ?></label>

			<label for="delv_by_cart"><input type="radio" name="show_s_on_pro" <?php if($show_s_on_pro == 0) { ?> checked <?php } ?> value="0"><?php _e('OFF', 'pho-pincode-zipcode-cod'); ?></label></td>

		</tr>

		<tr class="user-nickname-wrap">

			<th><label for="delv_by_cart"><?php _e('Show city on product page', 'pho-pincode-zipcode-cod'); ?></label></th>

			<td><label for="delv_by_cart"><input type="radio" name="show_c_on_pro" <?php if($show_c_on_pro == 1) { ?> checked <?php } ?> value="1"><?php _e('ON', 'pho-pincode-zipcode-cod'); ?></label>

			<label for="delv_by_cart"><input type="radio" name="show_c_on_pro" <?php if($show_c_on_pro == 0) { ?> checked <?php } ?> value="0"><?php _e('OFF', 'pho-pincode-zipcode-cod'); ?></label></td>

		</tr>
		
		<tr class="user-nickname-wrap">

			<th><label for="delv_estimation"><?php _e('Show delivery estimation', 'pho-pincode-zipcode-cod'); ?></label></th>

			<td><label for="delv_estimation"><input type="radio" name="show_d_est" <?php if($show_d_est == 1) { ?> checked <?php } ?> value="1"><?php _e('ON', 'pho-pincode-zipcode-cod'); ?></label>

			<label for="delv_estimation"><input type="radio" name="show_d_est" <?php if($show_d_est == 0) { ?> checked <?php } ?> value="0"><?php _e('OFF', 'pho-pincode-zipcode-cod'); ?></label></td>

		</tr>
		
		<tr class="user-nickname-wrap">

			<th><label for="delv_estimation"><?php _e('Show COD area', 'pho-pincode-zipcode-cod'); ?></label></th>

			<td><label for="delv_estimation"><input type="radio" name="show_cod_a" <?php if($show_cod_a == 1) { ?> checked <?php } ?> value="1"><?php _e('ON', 'pho-pincode-zipcode-cod'); ?></label>

			<label for="delv_estimation"><input type="radio" name="show_cod_a" <?php if($show_cod_a == 0) { ?> checked <?php } ?> value="0"><?php _e('OFF', 'pho-pincode-zipcode-cod'); ?></label></td>

		</tr>
		
		<tr class="s-d-d">

			<th><label for="delv_by_cart"><?php _e('Show date or days', 'pho-pincode-zipcode-cod'); ?></label></th>

			<td><label for="delv_by_cart"><input type="radio" name="show_d_d_on_pro" <?php if($show_d_d_on_pro == 1) { ?> checked <?php } ?> value="1"><?php _e('Date', 'pho-pincode-zipcode-cod'); ?></label>

			<label for="delv_by_cart"><input type="radio" name="show_d_d_on_pro" <?php if($show_d_d_on_pro == 0) { ?> checked <?php } ?> value="0"><?php _e('Days', 'pho-pincode-zipcode-cod'); ?></label></td>

		</tr>
		
		<tr class="user-nickname-wrap" style="display:none">

			<th><label for="val_checkout"><?php _e('Validate (on checkout page)', 'pho-pincode-zipcode-cod'); ?></label></th>

			<td><label for="val_checkout"><input type="radio" name="val_checkout" <?php if($qry['val_checkout'] == 1) { ?> checked <?php } ?> value="1"><?php _e('ON', 'pho-pincode-zipcode-cod'); ?></label>

			<label for="val_checkout"><input type="radio" name="val_checkout" <?php if($qry['val_checkout'] == 0) { ?> checked <?php } ?> value="0"><?php _e('OFF', 'pho-pincode-zipcode-cod'); ?></label></td>

		</tr>
		
		<tr class="user-user-login-wrap">

			<th><label for="enable_cod"><?php _e('Enable text as check pincode on product page', 'pho-pincode-zipcode-cod'); ?> </label></th>
			
			<td><input type="checkbox" value="1" <?php if($textascheck == 1){ echo "checked"; } ?> id="textascheck" name="textascheck" ></td>

		</tr>
		<tr class="user-user-login-wrap">

			<th><label for="del_label"><?php _e('Check pincode text', 'pho-pincode-zipcode-cod'); ?> </label></th>
			
			<td><input type="text" class="regular-text" id="checkpintext" name="checkpintext" value="<?php echo !empty($checkpintext)?$checkpintext:'Check' ; ?>"></td>

		</tr>

</tbody>

</table>

<table class="form-table">

	<tbody>
	
		<h3><?php _e('Pincode check popup', 'pho-pincode-zipcode-cod'); ?></h3>
		
			<tr class="user-user-login-wrap">

				<th><label for="auto_pch"><?php _e('Autoload popup home', 'pho-pincode-zipcode-cod'); ?></label></th>

					<td>
					
						<label for="auto_pch"><input type="radio" name="auto_pch" <?php if($auto_pch == 1) { ?> checked <?php }   ?> value="1"><?php _e('ON', 'pho-pincode-zipcode-cod'); ?></label>

						<label for="auto_pch"><input type="radio" name="auto_pch" <?php if($auto_pch == 0) { ?> checked <?php } ?> value="0"><?php _e('OFF', 'pho-pincode-zipcode-cod'); ?></label>
						
					</td>

			</tr>
			
			<tr class="user-user-login-wrap">

				<th><label for="auto_pchs"><?php _e('Popup on click of "add to cart" button on shop/category page', 'pho-pincode-zipcode-cod'); ?></label></th>

					<td>
					
						<label for="auto_pchs"><input type="radio" name="auto_pchs" <?php if($auto_pchs == 1) { ?> checked <?php }   ?> value="1"><?php _e('ON', 'pho-pincode-zipcode-cod'); ?></label>

						<label for="auto_pchs"><input type="radio" name="auto_pchs" <?php if($auto_pchs == 0) { ?> checked <?php } ?> value="0"><?php _e('OFF', 'pho-pincode-zipcode-cod'); ?></label>
						
					</td>

			</tr>
			
			<tr class="user-user-login-wrap">

				<th><label for="auto_pch_v"><?php _e('Let user close popup if not validate', 'pho-pincode-zipcode-cod'); ?></label></th>
				
					<td>
					
						<label for="auto_pch_v"><input type="radio" name="auto_pch_v" <?php  if($auto_pch_v == 0) { ?> checked <?php }  ?> value="0"><?php _e('NO', 'pho-pincode-zipcode-cod'); ?></label>

						<label for="auto_pch_v"><input type="radio" name="auto_pch_v" <?php  if($auto_pch_v == 1) { ?> checked <?php }  ?> value="1"><?php _e('YES', 'pho-pincode-zipcode-cod'); ?></label>
						
					</td>

			</tr>
			<tr class="user-user-login-wrap">

				<th><label for="auto_lod_shop"><?php _e('Enable exclude products based on pincode on shop page', 'pho-pincode-zipcode-cod'); ?></label></th>
				
					<td>
					
						<label for="show_cod_products"><input type="radio" name="show_cod_products" <?php  if($show_cod_products == 0) { ?> checked <?php }  ?> value="0"><?php _e('NO', 'pho-pincode-zipcode-cod'); ?></label>

						<label for="show_cod_products"><input type="radio" name="show_cod_products" <?php  if($show_cod_products == 1) { ?> checked <?php }  ?> value="1"><?php _e('YES', 'pho-pincode-zipcode-cod'); ?></label>
						
					</td>

			</tr>
			
			<tr class="user-user-login-wrap">

				<th><label for="auto_pch"><?php _e('Block user to access website if not validate', 'pho-pincode-zipcode-cod'); ?></label></th>
				
				<td>
				
					<label for="auto_pch_bu"><input type="radio" name="auto_pch_bu" <?php if($auto_pch_bu == 0) { ?> checked <?php } ?> value="0"><?php _e('NO', 'pho-pincode-zipcode-cod'); ?></label>

					<label for="auto_pch_bu"><input type="radio" name="auto_pch_bu" <?php  if($auto_pch_bu == 1) { ?> checked <?php } ?> value="1"><?php _e('YES', 'pho-pincode-zipcode-cod'); ?></label>
					
				</td>

			</tr>
			
			<tr class="user-user-login-wrap">

				<th><label for="del_label"><?php _e('Popup button text', 'pho-pincode-zipcode-cod'); ?> </label></th>
				<?php if($popup_button_text==''){ $popup_button_text='Check Pincode';  } ?>
				<td><input type="text" class="regular-text" id="popup_button_text" name="popup_button_text" value="<?php echo $popup_button_text ; ?>"></td>

			</tr>
			
			
			<tr class="user-user-login-wrap">

				<th><label for="del_label"><?php _e('Popup info text', 'pho-pincode-zipcode-cod'); ?> </label></th>
				
				<td><textarea class="regular-text" id="del_info_text" name="del_info_text"><?php echo $del_info_text; ?></textarea></td>

			</tr>
			
			<tr class="user-user-login-wrap">

				<th><label for="del_label"><?php _e('Popup pincode text field placeholder text', 'pho-pincode-zipcode-cod'); ?> </label></th>
				
				<td><textarea class="regular-text" id="del_place_holder_text" name="del_place_holder_text"><?php echo $del_place_holder_text; ?></textarea></td>

			</tr>
			
			
			<tr class="user-nickname-wrap">

				<th><label for="success_msg_b"><?php _e('Message for valid pincode', 'pho-pincode-zipcode-cod'); ?></label></th>

				<td><textarea class="regular-text" id="success_msg_b" name="success_msg_b"><?php echo $success_msg_b; ?></textarea></td>

			</tr>
			<tr class="user-nickname-wrap">

				<th><label for="unsuccess_msg_b"><?php _e('Message for invalid pincode', 'pho-pincode-zipcode-cod'); ?></label></th>

				<td><textarea class="regular-text" id="unsuccess_msg_b" name="unsuccess_msg_b"><?php echo $unsuccess_msg_b; ?></textarea></td>

			</tr>
			
			<tr class="user-nickname-wrap">

				<th><label for="link_invalid_pin"><?php _e('Enable link for invalid pincode', 'pho-pincode-zipcode-cod'); ?></label></th>

				<td>
				<label for="link_invalid_pin"><input type="radio" class="nolink" name="link_invalid_pin" <?php if($link_invalid_pin == 0) { ?> checked <?php } ?> value="0"><?php _e('NO', 'pho-pincode-zipcode-cod'); ?></label>
				
				<label for="link_invalid_pin"><input type="radio" class="nolink" name="link_invalid_pin" <?php if($link_invalid_pin == 1) { ?> checked <?php } ?> value="1"><?php _e('YES', 'pho-pincode-zipcode-cod'); ?></label></td>
				
			</tr>
			
			<tr class="user-nickname-wrap hide_nolink" style="display:<?php if($link_invalid_pin != 1){  echo "none"; } ?>;">

				<th><label for="unsuccess_msg_l"><?php _e('Link for invalid pincode', 'pho-pincode-zipcode-cod'); ?></label></th>

				<td><textarea class="regular-text" id="unsuccess_msg_l" name="unsuccess_msg_l"><?php echo $unsuccess_msg_l; ?></textarea></td>

			</tr>
			
			
			<tr class="user-nickname-wrap hide_nolink" style="display:<?php if($link_invalid_pin != 1){  echo "none"; } ?>;">

				<th><label for="unsuccess_msg_lt"><?php _e('Link text for invalid pincode', 'pho-pincode-zipcode-cod'); ?></label></th>

				<td><textarea class="regular-text" id="unsuccess_msg_lt" name="unsuccess_msg_lt"><?php echo $unsuccess_msg_lt; ?></textarea></td>

			</tr>
			
			
			<tr class="user-nickname-wrap">
								
				<th><label for="popup_ent_effct"> <?php _e('Popup entrance effect','pho-pincode-zipcode-cod'); ?></label></th>
				
				<td>
				
					<select id="popup_ent_effct" name="popup_ent_effct">
					
					<option value="none" <?php if( $popup_ent_effct == 'none' ){ echo "selected"; } ?>><?php _e('None', 'pho-pincode-zipcode-cod'); ?></option>
					
						<option value="bounceIn" <?php if( $popup_ent_effct == 'bounceIn' ){ echo "selected"; } ?>><?php _e('Bounce In', 'pho-pincode-zipcode-cod'); ?></option>
						
						<option value="bounceInDown" <?php if( $popup_ent_effct == 'bounceInDown' ){ echo "selected"; } ?>><?php _e('Bounce In Down', 'pho-pincode-zipcode-cod'); ?></option>
						
						<option value="bounceInLeft" <?php if( $popup_ent_effct == 'bounceInLeft' ){ echo "selected"; } ?>><?php _e('Bounce In Left', 'pho-pincode-zipcode-cod'); ?></option>
						
						<option value="bounceInRight" <?php if( $popup_ent_effct == 'bounceInRight' ){ echo "selected"; } ?>><?php _e('Bounce In Right', 'pho-pincode-zipcode-cod'); ?></option>
						
						<option value="bounceInUp" <?php if( $popup_ent_effct == 'bounceInUp' ){ echo "selected"; } ?>><?php _e('Bounce In Up', 'pho-pincode-zipcode-cod'); ?></option>
						
						<option value="fadeIn" <?php if( $popup_ent_effct == 'fadeIn' ){ echo "selected"; } ?>><?php _e('Fade In', 'pho-pincode-zipcode-cod'); ?></option>
						
						<option value="fadeInDown" <?php if( $popup_ent_effct == 'fadeInDown' ){ echo "selected"; } ?>><?php _e('Fade In Down', 'pho-pincode-zipcode-cod'); ?></option>
						
						<option value="fadeInDownBig" <?php if( $popup_ent_effct == 'fadeInDownBig' ){ echo "selected"; } ?>><?php _e('Fade In Down Big', 'pho-pincode-zipcode-cod'); ?></option>
						
						<option value="fadeInLeft" <?php if( $popup_ent_effct == 'fadeInLeft' ){ echo "selected"; } ?>><?php _e('Fade In Left', 'pho-pincode-zipcode-cod'); ?></option>
						
						<option value="fadeInLeftBig" <?php if( $popup_ent_effct == 'fadeInLeftBig' ){ echo "selected"; } ?>><?php _e('Fade In Left Big', 'pho-pincode-zipcode-cod'); ?></option>
						
						<option value="fadeInRight" <?php if( $popup_ent_effct == 'fadeInRight' ){ echo "selected"; } ?>><?php _e('Fade In Right', 'pho-pincode-zipcode-cod'); ?></option>
						
						<option value="fadeInRightBig" <?php if( $popup_ent_effct == 'fadeInRightBig' ){ echo "selected"; } ?>><?php _e('Fade In Right Big', 'pho-pincode-zipcode-cod'); ?></option>
						
						<option value="fadeInUp" <?php if( $popup_ent_effct == 'fadeInUp' ){ echo "selected"; } ?>><?php _e('Fade In Up', 'pho-pincode-zipcode-cod'); ?></option>
						
						<option value="fadeInUpBig" <?php if( $popup_ent_effct == 'fadeInUpBig' ){ echo "selected"; } ?>><?php _e('Fade In Up Big', 'pho-pincode-zipcode-cod'); ?></option>
						
						<option value="rotateIn" <?php if( $popup_ent_effct == 'rotateIn' ){ echo "selected"; } ?>><?php _e('Rotate In', 'pho-pincode-zipcode-cod'); ?></option>
						
						<option value="rotateInDownLeft" <?php if( $popup_ent_effct == 'rotateInDownLeft' ){ echo "selected"; } ?>><?php _e('Rotate In Down Left', 'pho-pincode-zipcode-cod'); ?></option>
						
						<option value="rotateInDownRight" <?php if( $popup_ent_effct == 'rotateInDownRight' ){ echo "selected"; } ?>><?php _e('Rotate In Down Right', 'pho-pincode-zipcode-cod'); ?></option>
						
						<option value="rotateInUpLeft" <?php if( $popup_ent_effct == 'rotateInUpLeft' ){ echo "selected"; } ?>><?php _e('Rotate In Up Left', 'pho-pincode-zipcode-cod'); ?></option>
						
						<option value="rotateInUpRight" <?php if( $popup_ent_effct == 'rotateInUpRight' ){ echo "selected"; } ?>><?php _e('Rotate In Up Right', 'pho-pincode-zipcode-cod'); ?></option>
						
						<option value="slideInUp" <?php if( $popup_ent_effct == 'slideInUp' ){ echo "selected"; } ?>><?php _e('SlideIn Up', 'pho-pincode-zipcode-cod'); ?></option>
						
						<option value="slideInDown" <?php if( $popup_ent_effct == 'slideInDown' ){ echo "selected"; } ?>><?php _e('Slide In Down', 'pho-pincode-zipcode-cod'); ?></option>
						
						<option value="slideInLeft" <?php if( $popup_ent_effct == 'slideInLeft' ){ echo "selected"; } ?>><?php _e('Slide In Left', 'pho-pincode-zipcode-cod'); ?></option>
						
						<option value="slideInRight" <?php if( $popup_ent_effct == 'slideInRight' ){ echo "selected"; } ?>><?php _e('Slide In Right', 'pho-pincode-zipcode-cod'); ?></option>
						
						<option value="zoomIn" <?php if( $popup_ent_effct == 'zoomIn' ){ echo "selected"; } ?>><?php _e('Zoom In', 'pho-pincode-zipcode-cod'); ?></option>
						
						<option value="zoomInDown" <?php if( $popup_ent_effct == 'zoomInDown' ){ echo "selected"; } ?>><?php _e('Zoom In Down', 'pho-pincode-zipcode-cod'); ?></option>
						
						<option value="zoomInLeft" <?php if( $popup_ent_effct == 'zoomInLeft' ){ echo "selected"; } ?>><?php _e('Zoom In Left', 'pho-pincode-zipcode-cod'); ?></option>
						
						<option value="zoomInRight" <?php if( $popup_ent_effct == 'zoomInRight' ){ echo "selected"; } ?>><?php _e('Zoom In Right', 'pho-pincode-zipcode-cod'); ?></option>
						
						<option value="zoomInUp" <?php if( $popup_ent_effct == 'zoomInUp' ){ echo "selected"; } ?>><?php _e('Zoom In Up', 'pho-pincode-zipcode-cod'); ?></option>
						
						<option value="rollIn" <?php if( $popup_ent_effct == 'rollIn' ){ echo "selected"; } ?>><?php _e('rollIn', 'pho-pincode-zipcode-cod'); ?></option>

					</select>
					
				</td>
				
			</tr>
			
			<tr class="user-nickname-wrap">
					
				<th><label for="popup_ext_effct"> <?php _e('Popup exits effect','pho-pincode-zipcode-cod'); ?></label></th>
				
				<td>
				
					<select id="popup_ext_effct" name="popup_ext_effct">
					
						<option value="none" <?php if( $popup_ext_effct == 'none' ){ echo "selected"; } ?>><?php _e('None', 'pho-pincode-zipcode-cod'); ?></option>
						
						<option value="bounceOut" <?php if( $popup_ext_effct == 'bounceOut' ){ echo "selected"; } ?>><?php _e('Bounce Out', 'pho-pincode-zipcode-cod'); ?></option>
						
						<option value="bounceOutDown" <?php if( $popup_ext_effct == 'bounceOutDown' ){ echo "selected"; } ?>><?php _e('Bounce Out Down', 'pho-pincode-zipcode-cod'); ?></option>
						
						<option value="bounceOutLeft" <?php if( $popup_ext_effct == 'bounceOutLeft' ){ echo "selected"; } ?>><?php _e('Bounce Out Left', 'pho-pincode-zipcode-cod'); ?></option>
						
						<option value="bounceOutRight" <?php if( $popup_ext_effct == 'bounceOutRight' ){ echo "selected"; } ?>><?php _e('Bounce Out Right', 'pho-pincode-zipcode-cod'); ?></option>
						
						<option value="bounceOutUp" <?php if( $popup_ext_effct == 'bounceOutUp' ){ echo "selected"; } ?>><?php _e('Bounce Out Up', 'pho-pincode-zipcode-cod'); ?></option>
						
						<option value="fadeOut" <?php if( $popup_ext_effct == 'fadeOut' ){ echo "selected"; } ?>><?php _e('Fade Out', 'pho-pincode-zipcode-cod'); ?></option>
						
						<option value="fadeOutDown" <?php if( $popup_ext_effct == 'fadeOutDown' ){ echo "selected"; } ?>><?php _e('Fade Out Down', 'pho-pincode-zipcode-cod'); ?></option>
						
						<option value="fadeOutDownBig" <?php if( $popup_ext_effct == 'fadeOutDownBig' ){ echo "selected"; } ?>><?php _e('Fade Out Down Big', 'pho-pincode-zipcode-cod'); ?></option>
						
						<option value="fadeOutLeft" <?php if( $popup_ext_effct == 'fadeOutLeft' ){ echo "selected"; } ?>><?php _e('Fade Out Left', 'pho-pincode-zipcode-cod'); ?></option>
						
						<option value="fadeOutLeftBig" <?php if( $popup_ext_effct == 'fadeOutLeftBig' ){ echo "selected"; } ?>><?php _e('Fade Out Left Big', 'pho-pincode-zipcode-cod'); ?></option>
						
						<option value="fadeOutRight" <?php if( $popup_ext_effct == 'fadeOutRight' ){ echo "selected"; } ?>><?php _e('Fade Out Right', 'pho-pincode-zipcode-cod'); ?></option>
						
						<option value="fadeOutRightBig" <?php if( $popup_ext_effct == 'fadeOutRightBig' ){ echo "selected"; } ?>><?php _e('Fade Out Right Big', 'pho-pincode-zipcode-cod'); ?></option>
						
						<option value="fadeOutUp" <?php if( $popup_ext_effct == 'fadeOutUp' ){ echo "selected"; } ?>><?php _e('Fade Out Up', 'pho-pincode-zipcode-cod'); ?></option>
						
						<option value="fadeOutUpBig" <?php if( $popup_ext_effct == 'fadeOutUpBig' ){ echo "selected"; } ?>><?php _e('Fade Out Up Big', 'pho-pincode-zipcode-cod'); ?></option>
						
						<option value="rotateOut" <?php if( $popup_ext_effct == 'rotateOut' ){ echo "selected"; } ?>><?php _e('Rotate Out', 'pho-pincode-zipcode-cod'); ?></option>
						
						<option value="rotateOutDownLeft" <?php if( $popup_ext_effct == 'rotateOutDownLeft' ){ echo "selected"; } ?>><?php _e('Rotate Out Down Left', 'pho-pincode-zipcode-cod'); ?></option>
						
						<option value="rotateOutDownRight" <?php if( $popup_ext_effct == 'rotateOutDownRight' ){ echo "selected"; } ?>><?php _e('Rotate Out Down Right', 'pho-pincode-zipcode-cod'); ?></option>
						
						<option value="rotateOutUpLeft" <?php if( $popup_ext_effct == 'rotateOutUpLeft' ){ echo "selected"; } ?>><?php _e('Rotate Out Up Left', 'pho-pincode-zipcode-cod'); ?></option>
						
						<option value="rotateOutUpRight" <?php if( $popup_ext_effct == 'rotateOutUpRight' ){ echo "selected"; } ?>><?php _e('Rotate Out Up Right', 'pho-pincode-zipcode-cod'); ?></option>
						
						<option value="slideOutUp" <?php if( $popup_ext_effct == 'slideOutUp' ){ echo "selected"; } ?>><?php _e('Slide Out Up', 'pho-pincode-zipcode-cod'); ?></option>
						
						<option value="slideOutDown" <?php if( $popup_ext_effct == 'slideOutDown' ){ echo "selected"; } ?>><?php _e('Slide Out Down', 'pho-pincode-zipcode-cod'); ?></option>
						
						<option value="slideOutLeft" <?php if( $popup_ext_effct == 'slideOutLeft' ){ echo "selected"; } ?>><?php _e('Slide Out Left', 'pho-pincode-zipcode-cod'); ?></option>
						
						<option value="slideOutRight" <?php if( $popup_ext_effct == 'slideOutRight' ){ echo "selected"; } ?>><?php _e('Slide Out Right', 'pho-pincode-zipcode-cod'); ?></option>
						
						<option value="zoomOut" <?php if( $popup_ext_effct == 'zoomOut' ){ echo "selected"; } ?>><?php _e('Zoom Out', 'pho-pincode-zipcode-cod'); ?></option>
						
						<option value="zoomOutDown" <?php if( $popup_ext_effct == 'zoomOutDown' ){ echo "selected"; } ?>><?php _e('Zoom Out Down', 'pho-pincode-zipcode-cod'); ?></option>
						
						<option value="zoomOutLeft" <?php if( $popup_ext_effct == 'zoomOutLeft' ){ echo "selected"; } ?>><?php _e('Zoom Out Left', 'pho-pincode-zipcode-cod'); ?></option>
						
						<option value="zoomOutRight" <?php if( $popup_ext_effct == 'zoomOutRight' ){ echo "selected"; } ?>><?php _e('Zoom Out Right', 'pho-pincode-zipcode-cod'); ?></option>
						
						<option value="zoomOutUp" <?php if( $popup_ext_effct == 'zoomOutUp' ){ echo "selected"; } ?>><?php _e('Zoom Out Up', 'pho-pincode-zipcode-cod'); ?></option>
						
						<option value="hinge" <?php if( $popup_ext_effct == 'hinge' ){ echo "selected"; } ?>><?php _e('hinge', 'pho-pincode-zipcode-cod'); ?></option>
						
						<option value="rollOut" <?php if( $popup_ext_effct == 'rollOut' ){ echo "selected"; } ?>><?php _e('Roll Out', 'pho-pincode-zipcode-cod'); ?></option>
						
					</select>
					
				</td>
				
			</tr>
		
	</tbody>

</table>

<table class="form-table">

	<tbody>

		<h3><?php _e('Enable help text', 'pho-pincode-zipcode-cod'); ?></h3>

		<tr class="user-nickname-wrap">

			<th><label for="del_date"><?php _e('Delivery date', 'pho-pincode-zipcode-cod'); ?></label></th>

			<td><label for="del_date"><input type="radio" <?php if($qry['del_date'] == 1) { ?> checked <?php } ?> name="del_date" value="1"><?php _e('ON', 'pho-pincode-zipcode-cod'); ?></label>

			<label for="del_date"><input type="radio" <?php if($qry['del_date'] == 0) { ?> checked <?php } ?> name="del_date" value="0"><?php _e('OFF', 'pho-pincode-zipcode-cod'); ?></label></td>

		</tr>

		

		<tr class="user-nickname-wrap">

			<th><label for="cod"><?php _e('COD', 'pho-pincode-zipcode-cod'); ?></label></th>

			<td><label for="cod"><input type="radio" <?php if($qry['cod'] == 1) { ?> checked <?php } ?> name="cod" value="1"><?php _e('ON', 'pho-pincode-zipcode-cod'); ?></label>

			<label for="cod"><input type="radio" <?php if($qry['cod'] == 0) { ?> checked <?php } ?> name="cod" value="0"><?php _e('OFF', 'pho-pincode-zipcode-cod'); ?></label></td>

		</tr>
		
	</tbody>

</table>
	<p class=""><input type="submit" value="<?php _e('Save', 'pho-pincode-zipcode-cod'); ?>" class="button button-primary" id="submit" name="submit">&nbsp;&nbsp;<input type="submit" value="<?php _e('Reset', 'pho-pincode-zipcode-cod'); ?>" class="button button-primary phoe_reset_form" id="reset" name="reset"> </p>
	<?php }else{
		?>
			<table class="form-table">

	<tbody>

		<h3><?php _e('Animation on COD and delivered by result','pho-pincode-zipcode-cod'); ?></h3>

		<tr class="user-nickname-wrap">
								
				<th><label for="info_ent_effct"> <?php _e('Animation on COD and delivered info entrance result','pho-pincode-zipcode-cod'); ?></label></th>
				
				<td>
				
					<select id="info_ent_effct" name="info_ent_effct">
					
						<option value="bounceIn" <?php if( $info_ent_effct == 'bounceIn' ){ echo "selected"; } ?>><?php _e('bounceIn', 'pho-pincode-zipcode-cod'); ?></option>
						
						<option value="bounceInDown" <?php if( $info_ent_effct == 'bounceInDown' ){ echo "selected"; } ?>><?php _e('bounceInDown', 'pho-pincode-zipcode-cod'); ?></option>
						
						<option value="bounceInLeft" <?php if( $info_ent_effct == 'bounceInLeft' ){ echo "selected"; } ?>><?php _e('bounceInLeft', 'pho-pincode-zipcode-cod'); ?></option>
						
						<option value="bounceInRight" <?php if( $info_ent_effct == 'bounceInRight' ){ echo "selected"; } ?>><?php _e('bounceInRight', 'pho-pincode-zipcode-cod'); ?></option>
						
						<option value="bounceInUp" <?php if( $info_ent_effct == 'bounceInUp' ){ echo "selected"; } ?>><?php _e('bounceInUp', 'pho-pincode-zipcode-cod'); ?></option>
						
						<option value="fadeIn" <?php if( $info_ent_effct == 'fadeIn' ){ echo "selected"; } ?>><?php _e('fadeIn', 'pho-pincode-zipcode-cod'); ?></option>
						
						<option value="fadeInDown" <?php if( $info_ent_effct == 'fadeInDown' ){ echo "selected"; } ?>><?php _e('fadeInDown', 'pho-pincode-zipcode-cod'); ?></option>
						
						<option value="fadeInDownBig" <?php if( $info_ent_effct == 'fadeInDownBig' ){ echo "selected"; } ?>><?php _e('fadeInDownBig', 'pho-pincode-zipcode-cod'); ?></option>
						
						<option value="fadeInLeft" <?php if( $info_ent_effct == 'fadeInLeft' ){ echo "selected"; } ?>><?php _e('fadeInLeft', 'pho-pincode-zipcode-cod'); ?></option>
						
						<option value="fadeInLeftBig" <?php if( $info_ent_effct == 'fadeInLeftBig' ){ echo "selected"; } ?>><?php _e('fadeInLeftBig', 'pho-pincode-zipcode-cod'); ?></option>
						
						<option value="fadeInRight" <?php if( $info_ent_effct == 'fadeInRight' ){ echo "selected"; } ?>><?php _e('fadeInRight', 'pho-pincode-zipcode-cod'); ?></option>
						
						<option value="fadeInRightBig" <?php if( $info_ent_effct == 'fadeInRightBig' ){ echo "selected"; } ?>><?php _e('fadeInRightBig', 'pho-pincode-zipcode-cod'); ?></option>
						
						<option value="fadeInUp" <?php if( $info_ent_effct == 'fadeInUp' ){ echo "selected"; } ?>><?php _e('fadeInUp', 'pho-pincode-zipcode-cod'); ?></option>
						
						<option value="fadeInUpBig" <?php if( $info_ent_effct == 'fadeInUpBig' ){ echo "selected"; } ?>><?php _e('fadeInUpBig', 'pho-pincode-zipcode-cod'); ?></option>
						
						<option value="rotateIn" <?php if( $info_ent_effct == 'rotateIn' ){ echo "selected"; } ?>><?php _e('rotateIn', 'pho-pincode-zipcode-cod'); ?></option>
						
						<option value="rotateInDownLeft" <?php if( $info_ent_effct == 'rotateInDownLeft' ){ echo "selected"; } ?>><?php _e('rotateInDownLeft', 'pho-pincode-zipcode-cod'); ?></option>
						
						<option value="rotateInDownRight" <?php if( $info_ent_effct == 'rotateInDownRight' ){ echo "selected"; } ?>><?php _e('rotateInDownRight', 'pho-pincode-zipcode-cod'); ?></option>
						
						<option value="rotateInUpLeft" <?php if( $info_ent_effct == 'rotateInUpLeft' ){ echo "selected"; } ?>><?php _e('rotateInUpLeft', 'pho-pincode-zipcode-cod'); ?></option>
						
						<option value="rotateInUpRight" <?php if( $info_ent_effct == 'rotateInUpRight' ){ echo "selected"; } ?>><?php _e('rotateInUpRight', 'pho-pincode-zipcode-cod'); ?></option>
						
						<option value="slideInUp" <?php if( $info_ent_effct == 'slideInUp' ){ echo "selected"; } ?>><?php _e('slideInUp', 'pho-pincode-zipcode-cod'); ?></option>
						
						<option value="slideInDown" <?php if( $info_ent_effct == 'slideInDown' ){ echo "selected"; } ?>><?php _e('slideInDown', 'pho-pincode-zipcode-cod'); ?></option>
						
						<option value="slideInLeft" <?php if( $info_ent_effct == 'slideInLeft' ){ echo "selected"; } ?>><?php _e('slideInLeft', 'pho-pincode-zipcode-cod'); ?></option>
						
						<option value="slideInRight" <?php if( $info_ent_effct == 'slideInRight' ){ echo "selected"; } ?>><?php _e('slideInRight', 'pho-pincode-zipcode-cod'); ?></option>
						
						<option value="zoomIn" <?php if( $info_ent_effct == 'zoomIn' ){ echo "selected"; } ?>><?php _e('zoomIn', 'pho-pincode-zipcode-cod'); ?></option>
						
						<option value="zoomInDown" <?php if( $info_ent_effct == 'zoomInDown' ){ echo "selected"; } ?>><?php _e('zoomInDown', 'pho-pincode-zipcode-cod'); ?></option>
						
						<option value="zoomInLeft" <?php if( $info_ent_effct == 'zoomInLeft' ){ echo "selected"; } ?>><?php _e('zoomInLeft', 'pho-pincode-zipcode-cod'); ?></option>
						
						<option value="zoomInRight" <?php if( $info_ent_effct == 'zoomInRight' ){ echo "selected"; } ?>><?php _e('zoomInRight', 'pho-pincode-zipcode-cod'); ?></option>
						
						<option value="zoomInUp" <?php if( $info_ent_effct == 'zoomInUp' ){ echo "selected"; } ?>><?php _e('zoomInUp', 'pho-pincode-zipcode-cod'); ?></option>
						
						<option value="rollIn" <?php if( $info_ent_effct == 'rollIn' ){ echo "selected"; } ?>><?php _e('rollIn', 'pho-pincode-zipcode-cod'); ?></option>

					</select>
					
				</td>
				
			</tr>
			<tr class="user-nickname-wrap">
					
				<th><label for="info_ext_effct"> <?php _e('Animation on COD and delivered info exit result','pho-pincode-zipcode-cod'); ?></label></th>
				
				<td>
				
					<select id="info_ext_effct" name="info_ext_effct">
					
						<option value="bounceOut" <?php if( $info_ext_effct == 'bounceOut' ){ echo "selected"; } ?>><?php _e('bounceOut', 'pho-pincode-zipcode-cod'); ?></option>
						
						<option value="bounceOutDown" <?php if( $info_ext_effct == 'bounceOutDown' ){ echo "selected"; } ?>><?php _e('bounceOutDown', 'pho-pincode-zipcode-cod'); ?></option>
						
						<option value="bounceOutLeft" <?php if( $info_ext_effct == 'bounceOutLeft' ){ echo "selected"; } ?>><?php _e('bounceOutLeft', 'pho-pincode-zipcode-cod'); ?></option>
						
						<option value="bounceOutRight" <?php if( $info_ext_effct == 'bounceOutRight' ){ echo "selected"; } ?>><?php _e('bounceOutRight', 'pho-pincode-zipcode-cod'); ?></option>
						
						<option value="bounceOutUp" <?php if( $info_ext_effct == 'bounceOutUp' ){ echo "selected"; } ?>><?php _e('bounceOutUp', 'pho-pincode-zipcode-cod'); ?></option>
						
						<option value="fadeOut" <?php if( $info_ext_effct == 'fadeOut' ){ echo "selected"; } ?>><?php _e('fadeOut', 'pho-pincode-zipcode-cod'); ?></option>
						
						<option value="fadeOutDown" <?php if( $info_ext_effct == 'fadeOutDown' ){ echo "selected"; } ?>><?php _e('fadeOutDown', 'pho-pincode-zipcode-cod'); ?></option>
						
						<option value="fadeOutDownBig" <?php if( $info_ext_effct == 'fadeOutDownBig' ){ echo "selected"; } ?>><?php _e('fadeOutDownBig', 'pho-pincode-zipcode-cod'); ?></option>
						
						<option value="fadeOutLeft" <?php if( $info_ext_effct == 'fadeOutLeft' ){ echo "selected"; } ?>><?php _e('fadeOutLeft', 'pho-pincode-zipcode-cod'); ?></option>
						
						<option value="fadeOutLeftBig" <?php if( $info_ext_effct == 'fadeOutLeftBig' ){ echo "selected"; } ?>><?php _e('fadeOutLeftBig', 'pho-pincode-zipcode-cod'); ?></option>
						
						<option value="fadeOutRight" <?php if( $info_ext_effct == 'fadeOutRight' ){ echo "selected"; } ?>><?php _e('fadeOutRight', 'pho-pincode-zipcode-cod'); ?></option>
						
						<option value="fadeOutRightBig" <?php if( $info_ext_effct == 'fadeOutRightBig' ){ echo "selected"; } ?>><?php _e('fadeOutRightBig', 'pho-pincode-zipcode-cod'); ?></option>
						
						<option value="fadeOutUp" <?php if( $info_ext_effct == 'fadeOutUp' ){ echo "selected"; } ?>><?php _e('fadeOutUp', 'pho-pincode-zipcode-cod'); ?></option>
						
						<option value="fadeOutUpBig" <?php if( $info_ext_effct == 'fadeOutUpBig' ){ echo "selected"; } ?>><?php _e('fadeOutUpBig', 'pho-pincode-zipcode-cod'); ?></option>
						
						<option value="rotateOut" <?php if( $info_ext_effct == 'rotateOut' ){ echo "selected"; } ?>><?php _e('rotateOut', 'pho-pincode-zipcode-cod'); ?></option>
						
						<option value="rotateOutDownLeft" <?php if( $info_ext_effct == 'rotateOutDownLeft' ){ echo "selected"; } ?>><?php _e('rotateOutDownLeft', 'pho-pincode-zipcode-cod'); ?></option>
						
						<option value="rotateOutDownRight" <?php if( $info_ext_effct == 'rotateOutDownRight' ){ echo "selected"; } ?>><?php _e('rotateOutDownRight', 'pho-pincode-zipcode-cod'); ?></option>
						
						<option value="rotateOutUpLeft" <?php if( $info_ext_effct == 'rotateOutUpLeft' ){ echo "selected"; } ?>><?php _e('rotateOutUpLeft', 'pho-pincode-zipcode-cod'); ?></option>
						
						<option value="rotateOutUpRight" <?php if( $info_ext_effct == 'rotateOutUpRight' ){ echo "selected"; } ?>><?php _e('rotateOutUpRight', 'pho-pincode-zipcode-cod'); ?></option>
						
						<option value="slideOutUp" <?php if( $info_ext_effct == 'slideOutUp' ){ echo "selected"; } ?>><?php _e('slideOutUp', 'pho-pincode-zipcode-cod'); ?></option>
						
						<option value="slideOutDown" <?php if( $info_ext_effct == 'slideOutDown' ){ echo "selected"; } ?>><?php _e('slideOutDown', 'pho-pincode-zipcode-cod'); ?></option>
						
						<option value="slideOutLeft" <?php if( $info_ext_effct == 'slideOutLeft' ){ echo "selected"; } ?>><?php _e('slideOutLeft', 'pho-pincode-zipcode-cod'); ?></option>
						
						<option value="slideOutRight" <?php if( $info_ext_effct == 'slideOutRight' ){ echo "selected"; } ?>><?php _e('slideOutRight', 'pho-pincode-zipcode-cod'); ?></option>
						
						<option value="zoomOut" <?php if( $info_ext_effct == 'zoomOut' ){ echo "selected"; } ?>><?php _e('zoomOut', 'pho-pincode-zipcode-cod'); ?></option>
						
						<option value="zoomOutDown" <?php if( $info_ext_effct == 'zoomOutDown' ){ echo "selected"; } ?>><?php _e('zoomOutDown', 'pho-pincode-zipcode-cod'); ?></option>
						
						<option value="zoomOutLeft" <?php if( $info_ext_effct == 'zoomOutLeft' ){ echo "selected"; } ?>><?php _e('zoomOutLeft', 'pho-pincode-zipcode-cod'); ?></option>
						
						<option value="zoomOutRight" <?php if( $info_ext_effct == 'zoomOutRight' ){ echo "selected"; } ?>><?php _e('zoomOutRight', 'pho-pincode-zipcode-cod'); ?></option>
						
						<option value="zoomOutUp" <?php if( $info_ext_effct == 'zoomOutUp' ){ echo "selected"; } ?>><?php _e('zoomOutUp', 'pho-pincode-zipcode-cod'); ?></option>
						
						<option value="hinge" <?php if( $info_ext_effct == 'hinge' ){ echo "selected"; } ?>><?php _e('hinge', 'pho-pincode-zipcode-cod'); ?></option>
						
						<option value="rollOut" <?php if( $info_ext_effct == 'rollOut' ){ echo "selected"; } ?>><?php _e('rollOut', 'pho-pincode-zipcode-cod'); ?></option>
						
					</select>
					
				</td>
				
			</tr>

	</tbody>

</table>

<table class="form-table">

<tbody>

<h3><?php _e('Styling of check pincode functionality on product page', 'pho-pincode-zipcode-cod'); ?></h3>


	<tr class="user-user-login-wrap">

			<th><label for="bgcolor"><?php _e('Box background color', 'pho-pincode-zipcode-cod'); ?></label></th>

			<td><input type="text" class="regular-text" value="<?php echo $qry['bgcolor']; ?>" id="bgcolor" name="bgcolor"></td>

		</tr>


		<tr class="user-first-name-wrap">

			<th><label for="textcolor"><?php _e('Check pincode label text color', 'pho-pincode-zipcode-cod'); ?></label></th>

			<td><input type="text" class="regular-text" value="<?php echo $qry['textcolor']; ?>" id="textcolor" name="textcolor"></td>

		</tr>



		<tr class="user-last-name-wrap">

			<th><label for="bordercolor"><?php _e('Box border color', 'pho-pincode-zipcode-cod'); ?></label></th>

			<td><input type="text" class="regular-text" value="<?php echo $qry['bordercolor']; ?>" id="bordercolor" name="bordercolor"></td>

		</tr>
		
		<tr class="user-last-name-wrap">

			<th><label for="ttbordercolor"><?php _e('Tooltip border color', 'pho-pincode-zipcode-cod'); ?></label></th>

			<td><input type="text" class="regular-text" value="<?php echo $qry['ttbordercolor']; ?>" id="ttbordercolor" name="ttbordercolor"></td>

		</tr>
		
		<tr class="user-last-name-wrap">

			<th><label for="ttbagcolor"><?php _e('Tooltip background color', 'pho-pincode-zipcode-cod'); ?></label></th>

			<td><input type="text" class="regular-text" value="<?php echo $qry['ttbagcolor']; ?>" id="ttbagcolor" name="ttbagcolor"></td>

		</tr>
		
		<tr class="user-last-name-wrap">

			<th><label for="tttextcolor"><?php _e('Tooltip text color', 'pho-pincode-zipcode-cod'); ?></label></th>

			<td><input type="text" class="regular-text" value="<?php echo $qry['tttextcolor']; ?>" id="tttextcolor" name="tttextcolor"></td>

		</tr>
		
		<tr class="user-last-name-wrap">

			<th><label for="devbytcolor"><?php _e('Delivered by text color', 'pho-pincode-zipcode-cod'); ?></label></th>

			<td><input type="text" class="regular-text" value="<?php echo $qry['devbytcolor']; ?>" id="devbytcolor" name="devbytcolor"></td>

		</tr>
		
		<tr class="user-last-name-wrap">

			<th><label for="codtcolor"><?php _e('Cash on delivery text color', 'pho-pincode-zipcode-cod'); ?></label></th>

			<td><input type="text" class="regular-text" value="<?php echo $qry['codtcolor']; ?>" id="codtcolor" name="codtcolor"></td>

		</tr>
		
		<tr class="user-last-name-wrap">

			<th><label for="datecolor"><?php _e('Date/Days color', 'pho-pincode-zipcode-cod'); ?></label></th>

			<td><input type="text" class="regular-text" value="<?php echo $qry['datecolor']; ?>" id="datecolor" name="datecolor"></td>

		</tr>
		
		
		<tr class="user-last-name-wrap">

			<th><label for="codmsgcolor"><?php _e('COD message color', 'pho-pincode-zipcode-cod'); ?></label></th>

			<td><input type="text" class="regular-text" value="<?php echo $qry['codmsgcolor']; ?>" id="codmsgcolor" name="codmsgcolor"></td>

		</tr>
		
		
		<tr class="user-last-name-wrap">

			<th><label for="errormsgcolor"><?php _e('Error message color', 'pho-pincode-zipcode-cod'); ?></label></th>

			<td><input type="text" class="regular-text" value="<?php echo $qry['errormsgcolor']; ?>" id="errormsgcolor" name="errormsgcolor"></td>

		</tr>



</tbody>

</table>		

<table class="form-table">

<tbody>

<h3><?php _e('Image options', 'pho-pincode-zipcode-cod'); ?></h3>

		<tr class="user-nickname-wrap">

			<th><label for="image_size"><?php _e('Help text icon image size', 'pho-pincode-zipcode-cod'); ?></label></th>

			<td><span class="long"><label class="up grey"><?php _e('Height(px)', 'pho-pincode-zipcode-cod'); ?><input style="width:100px" type="number" max="20" min="0" class="regular-text up " value="<?php echo $qry['image_size']; ?>" id="image_size" name="image_size"></label></span><span class="px-multiply">&nbsp; X &nbsp;  </span>
			
			<span class="wid"><label class="up grey"><?php _e('Width(px)', 'pho-pincode-zipcode-cod'); ?><input style="width:100px" type="number" max="20" min="0" class="regular-text up" value="<?php echo $qry['image_size1']; ?>" id="image_size1" name="image_size1"></label></span><span class="px-multiply"></span></td>

		</tr>
		

		<tr class="user-nickname-wrap">

			<th><label for="help_image"><?php _e('Help text icon image upload', 'pho-pincode-zipcode-cod'); ?></label></th>

			<td><input type="text" class="regular-text" value="<?php echo $qry['help_image']; ?>" id="help_image" name="help_image"><input id="help_image_button" class="button uploadimage" type="button" value="Upload" /></td>

		</tr>

</tbody>

</table>	
<p class=""><input type="submit" value="<?php _e('Save', 'pho-pincode-zipcode-cod'); ?>" class="button button-primary" id="submit" name="submit-style">&nbsp;&nbsp;<input type="submit" value="<?php _e('Reset', 'pho-pincode-zipcode-cod'); ?>" class="button button-primary phoe_reset_form" id="reset" name="reset-style"> </p>
		<?php
	} ?>


</div>

</form>

<table class="form-table">

	<tbody>

			<tr class="user-nickname-wrap">

				<th><label style="color:red"><?php _e('Delete all pincodes from pincode list', 'pho-pincode-zipcode-cod'); ?></label></th>	

				<td><a class="add-new-h2 delete-all" href="<?php echo admin_url( 'admin.php?page=pincodes_setting&&action=delete-all' ); ?>" onclick="return confirm('Are you sure You want to Delete All Pincodes?')" ><?php _e('Delete All', 'pho-pincode-zipcode-cod'); ?></a></td>

			</tr>
			
	</tbody>

</table>

</div>

<script>

jQuery(document).ready(function($) {

	jQuery("#bgcolor").wpColorPicker();

	jQuery("#textcolor").wpColorPicker();
	
	jQuery("#bordercolor").wpColorPicker();

	jQuery("#buttoncolor").wpColorPicker();
	
	jQuery("#buttontcolor").wpColorPicker();
	
	jQuery("#ttbordercolor").wpColorPicker();
	
	jQuery("#ttbagcolor").wpColorPicker();
	
	jQuery("#tttextcolor").wpColorPicker();
	
	jQuery("#devbytcolor").wpColorPicker();
	
	jQuery("#codtcolor").wpColorPicker();
	
	jQuery("#datecolor").wpColorPicker();
	
	jQuery("#codmsgcolor").wpColorPicker();
	
	jQuery("#errormsgcolor").wpColorPicker();
	
    var custom_upload;

	var textid;

	$(document).on("click",".uploadimage",uploadimage_button);

    function uploadimage_button(){

        var custom_upload = wp.media({

        title: 'Add Media',

        button: {

            text: 'Insert Image'

        },

        multiple: false  // Set this to true to allow multiple files to be selected

		})

		.on('select', function() {

			var attachment = custom_upload.state().get('selection').first().toJSON();

			$('.custom_media_image').attr('src', attachment.url);

			$('#help_image').val(attachment.url);


		})

		.open();

    }

	jQuery(".nolink").change(function(){
		if(jQuery(this).val()==1){
			jQuery(".hide_nolink").show();
		}else{
			jQuery(".hide_nolink").hide();
		}
	});
	
	
	jQuery(".area_wise_delivery").change(function(){
		if(jQuery(this).val()==1){
			jQuery("input[name=state_based_pincode][value='0']").prop("checked",true);
		}
	});
	jQuery(".state_based_pincode").change(function(){
		if(jQuery(this).val()==1){
			jQuery("input[name=area_wise_delivery][value='0']").prop("checked",true);
		}
	});
	
	$(document).on("click",".uploadimage1",uploadimage_button1);

    function uploadimage_button1() {

        var custom_upload = wp.media({

			title: 'Add Media',

			button: {

				text: 'Insert Image'

			},

			multiple: false  // Set this to true to allow multiple files to be selected

		})

		.on('select', function() {

			var attachment = custom_upload.state().get('selection').first().toJSON();

			$('.custom_media_image').attr('src', attachment.url);

		})

		.open();

    }

	if($("#showpp").is(':checked'))
	{
		
		$('.v-d-p-p').show();
		
	}
	else
	{
		
		$('.v-d-p-p').hide();
		
		$('#valpp').attr('checked', false); // Checks it
		
	}

	$("#showpp").change(function() {
		
		if(this.checked) {
			
			$('.v-d-p-p').show();
			
		}
		else{
			
			$('.v-d-p-p').hide();
			
			$('#valpp').attr('checked', false); // Checks it
			
		}
		
	});
	
	//alert($("input[type=radio][name=show_d_est]:checked").val());
	if($("input[type=radio][name=show_d_est]:checked").val() == 1) 
	{
		
		$('.s-d-d').show();
		
	}
	else
	{
		
		$('.s-d-d').hide();
		
	}
	
	
	$("input[type=radio][name=show_d_est]").change(function() {
		
		if(this.value == 1) {
			
			$('.s-d-d').show();
			
		}
		else{
			
			$('.s-d-d').hide();
			
		}
		
	});
	
});

jQuery(document).on("click","#phoe_reset_form",function(){
		
		jQuery( "#checkpc" ).prop( "checked", true );
		
		jQuery( "#pincode_len" ).val( "6" );
		
		jQuery( "#showpp" ).prop( "checked", true );
		
		jQuery( "#valpp" ).prop( "checked", true );
		
		jQuery( "#del_label" ).val( "Delivery Date" );
		
		jQuery( "#cod_label" ).val( "COD" );
		
		jQuery( "#cod_msg1" ).val( "Available." );
		
		jQuery( "#cod_msg2" ).val( "Not Available." );
		
		jQuery( "#error_msg_b" ).val( "Please Enter Vaild Pincode." );
		
		jQuery( "#error_msg" ).val( "Sorry, we do not ship to this location." );

		jQuery("input[name=s_s][value='1']").prop("checked",true);
		
		jQuery("input[name=s_s1][value='1']").prop("checked",true);

		jQuery("input[name=cod_p][value='1']").prop("checked",true);
		
		jQuery("input[name=show_s_on_pro][value='0']").prop("checked",true);
		
		jQuery("input[name=show_c_on_pro][value='0']").prop("checked",true);
		
		jQuery("input[name=show_d_est][value='1']").prop("checked",true);
		
		jQuery("input[name=show_cod_a][value='1']").prop("checked",true);
		
		jQuery("input[name=show_d_d_on_pro][value='1']").prop("checked",true);
		
		jQuery("input[name=auto_pch][value='0']").prop("checked",true);
		
		jQuery("input[name=auto_pchs][value='0']").prop("checked",true);
		
		jQuery("input[name=auto_pch_v][value='1']").prop("checked",true);
		
		jQuery("input[name=auto_pch_bu][value='0']").prop("checked",true);
		
		jQuery("input[name=del_date][value='1']").prop("checked",true);
		
		jQuery("input[name=cod][value='1']").prop("checked",true);
			
});

</script>
<style>
.form-table th {
    width: 270px;
	padding: 25px;
}

.form-table td {
	
    padding: 20px 10px;
}

.form-table {
	background-color: #fff;
}

.phoen_check_pin_wrap h3 {
    padding: 10px;
}

.px-multiply{ color:#ccc; vertical-align:bottom;}

.long{ display:inline-block; vertical-align:middle; }

.wid{ display:inline-block; vertical-align:middle;}

.up{ display:block;}

.grey{ color:#b0adad;}

</style>