<?php
function add_pincodes_f()
{
	?>
		<div class="wrap">
	<?php
	global $table_prefix, $wpdb;
	
	$product_id=isset($_GET["pro_id"])?$_GET["pro_id"]:"";
	
	$pincode_length = get_option('pincode_length');
	
	if(isset($_POST['submit']))
	{
		$pincode = isset($_POST['pincode'])?sanitize_text_field( $_POST['pincode'] ):'';
		$area = isset($_POST['area'])?sanitize_text_field( $_POST['area'] ):'';
		$city = isset($_POST['city'])?sanitize_text_field( $_POST['city'] ):'';
		$state = isset($_POST['state'])?sanitize_text_field( $_POST['state'] ):'';
		$dod = isset($_POST['dod'])?sanitize_text_field( $_POST['dod'] ):'';
		$cod = isset($_POST['cod'])?sanitize_text_field( $_POST['cod'] ):'';
		$dod_name=isset($_POST['dod_name'])?sanitize_text_field( $_POST['dod_name'] ):'';
		$time_minuts=isset($_POST['time_minuts'])?sanitize_text_field( $_POST['time_minuts'] ):'';
		$time_hrs=isset($_POST['time_hrs'])?sanitize_text_field( $_POST['time_hrs'] ):'';
		$quantity_into= isset($_POST['quantity_into'])? sanitize_text_field( $_POST['quantity_into'] ):'';
		$cod_charge=isset($_POST['cod_charge'])?sanitize_text_field( $_POST['cod_charge'] ):'';
		$dquantity_min=isset($_POST['delevery_quantity'])? $_POST['delevery_quantity'] :array();
		$dday_min=isset($_POST['delevery_day'])?$_POST['delevery_day'] :array();
		$all_products = isset($_POST['all_products']) ? $_POST['all_products']:'';
		
		$dquantity="";
		$dday="";
		
		if(!empty($dquantity_min)){
			
			$dquantity=implode(",",$dquantity_min);
		
			$dday=implode(",",$dday_min);
			
		}
		
		
		$products_list='';
		
		if(!empty($all_products) && is_array($all_products)){	
			
			$products_list=sanitize_text_field(implode(",",$all_products));
			
		}
		
		$deliver_by=sanitize_text_field( $_POST['deliver_by'] );
		
		$safe_zipcode = $pincode;
		
		$safe_dod = intval( $dod );
		
		$phen_pincode_list=get_post_meta( $product_id,'phen_pincode_list',true);
		
		$llok=array();
		
		if ( $safe_zipcode)
		{
			
			if(!empty($product_id)){
				
				$llok= array(
				"$pincode"=>array( $pincode, $city, $state, $dod, $cod ,$dod_name,$deliver_by,$time_hrs,$time_minuts,$cod_charge,$quantity_into,$area,$dquantity,$dday));
				
				if(!empty($phen_pincode_list) && is_array($phen_pincode_list)){
				
					$llok=$phen_pincode_list+$llok;
					
				}
				
				
				
				$min_result=update_post_meta( $product_id,'phen_pincode_list',$llok );	
				
				if(isset($min_result))
				{
					?>

						<div class="updated below-h2" id="message"><p><?php _e('Added Successfully', 'pho-pincode-zipcode-cod'); ?>.</p></div>

					<?php
				}
				else
				{
					?>
						<div class="error below-h2" id="message"><p><?php _e('Something Went Wrong Please Try Again With Valid Data', 'pho-pincode-zipcode-cod'); ?>.</p></div>
					<?php
					
				}
				
			}else{
				
				$num_rows = $wpdb->get_var( $wpdb->prepare( "SELECT COUNT(*) FROM `".$table_prefix."check_pincode_pro` where `pincode` = %s", $pincode ) );

				if($num_rows == 0)
				{

					$result = $wpdb->query( "INSERT INTO `".$table_prefix."check_pincode_pro` (`pincode`, `area`,`city`, `state`, `dod`,`cod`, `dod_name`, `time_hrs`, `time_minuts`, `product_list`, `deliver_by`, `cod_charge`, `quantity_into`, `deliver_day`, `deliver_quantity`) VALUES ('$pincode', '$area','$city', '$state', $dod,'$cod','$dod_name','$time_hrs','$time_minuts','$products_list','$deliver_by','$cod_charge','$quantity_into','$dday','$dquantity')" );
					
					if($result == 1)
					{
					?>

						<div class="updated below-h2" id="message"><p><?php _e('Added Successfully', 'pho-pincode-zipcode-cod'); ?>.</p></div>

					<?php
					}
					else
					{
						?>
							<div class="error below-h2" id="message"><p><?php _e('Something Went Wrong Please Try Again With Valid Data', 'pho-pincode-zipcode-cod'); ?>.</p></div>
						<?php
						
					}
				}
				else
				{
					?>

						<div class="error below-h2" id="message"><p><?php _e('This Pincode Already Exists', 'pho-pincode-zipcode-cod'); ?>.</p></div>

					<?php
				}
			}
			
		}
		else
		{
			?>

				<div class="error below-h2" id="message"><p><?php _e('Please Fill Valid Data', 'pho-pincode-zipcode-cod'); ?>.</p></div>

			<?php
		}
	}
		$loop = new WP_Query( array( 'post_type' => array('product', 'product_variation')) );
		
		$phoen_all_product_list=array();
		
		if(count($loop->posts)!==''){
			
			foreach($loop->posts as $list_products){
				
				if($list_products->post_status=='publish'){
					
					$phoen_all_product_list[$list_products->ID]=$list_products->post_title;
					
				}
				
			}
			
		}
		
		$args     = array( 'post_type' => array('product', 'product_variation'), 'posts_per_page' => -1 );
		
		$products = get_posts( $args );
		
		$phoen_all_product_list=array();
		
		if(!empty($products)){
			
			foreach($products as $list_products){
				
				if($list_products->post_status=='publish'){
					
					$phoen_all_product_list[$list_products->ID]=$list_products->post_title;
					
				}
				
			}
			
		}
		// echo count($phoen_all_product_list);
		$product_name="";
		
		if(isset($_REQUEST['pro_id'])){
			
			$product=wc_get_product($_REQUEST['pro_id']);
							
			$product_name="( ".$product->get_name()." )";
		}
			
	?>
			<div id="icon-users" class="icon32"><br/></div>

				<h2><?php _e('Add Zip Code', 'pho-pincode-zipcode-cod');   echo $product_name;?></h2>

					<!-- Forms are NOT created automatically, so you need to wrap the table in one to use features like bulk actions -->

				<form action="" method="post" id="azip_form" name="azip_form">


					<table class="form-table">

					<tbody>

						<tr class="user-user-login-wrap">

							<th><label for="pincode"><?php _e('Pincode', 'pho-pincode-zipcode-cod'); ?></label></th>

							<td><input type="text" required="required" maxlength="<?php echo $pincode_length;?>" class="regular-text" id="pincode" name="pincode"></td>

						</tr>

						<tr class="user-first-name-wrap">

							<th><label for="area"><?php _e('Area', 'pho-pincode-zipcode-cod'); ?></label></th>

							<td><input type="text" class="regular-text" id="area" name="area"></td>

						</tr>
						
						<tr class="user-first-name-wrap">

							<th><label for="city"><?php _e('City', 'pho-pincode-zipcode-cod'); ?></label></th>

							<td><input type="text" required="required" class="regular-text" id="city" name="city"></td>

						</tr>

						<tr class="user-last-name-wrap">

							<th><label for="state"><?php _e('State', 'pho-pincode-zipcode-cod'); ?></label></th>

							<td><input type="text" required="required" class="regular-text" id="state" name="state"></td>

						</tr>
						
						<tr class="user-nickname-wrap">

							<th><label for="deliver_by"><?php _e('Delivery by', 'pho-pincode-zipcode-cod'); ?></label></th>
							
							<td>
								<label for="nickname"><input type="radio" checked class="deliver_by" value="day" name="deliver_by"><?php _e('Day(s)', 'pho-pincode-zipcode-cod'); ?></label>

								<label for="nickname"><input type="radio"  class="deliver_by" value="day_name" name="deliver_by"><?php _e('Day name', 'pho-pincode-zipcode-cod'); ?></label>
								
								<label for="nickname"><input type="radio"  class="deliver_by" value="time_picker" name="deliver_by"><?php _e('Hours and minutes', 'pho-pincode-zipcode-cod'); ?></label>
								
								<label for="nickname"><input type="radio"  class="deliver_by" value="quantity" name="deliver_by"><?php _e('Quantity', 'pho-pincode-zipcode-cod'); ?></label>
							</td>

						</tr>

						<tr class="user-nickname-wrap day_min">

							<th><label for="dod"><?php _e('Delivery within day(s)', 'pho-pincode-zipcode-cod'); ?></label></th>

							<td><input type="number" min="0" max="365" step="1" value="0" class="regular-text" id="dod" name="dod"></td>

						</tr>
						
						<tr class="user-nickname-wrap day_name_min" style="display:none;">

							<th><label for="dod_name"><?php _e('Delivery within day name', 'pho-pincode-zipcode-cod'); ?></label></th>

							<td>
								<select name="dod_name">
									<option value="monday"><?php _e('Monday', 'pho-pincode-zipcode-cod'); ?></option>
									<option value="tuesday"><?php _e('Tuesday', 'pho-pincode-zipcode-cod'); ?></option>
									<option value="wednesday"><?php _e('Wednesday', 'pho-pincode-zipcode-cod'); ?></option>
									<option value="thursday"><?php _e('Thursday', 'pho-pincode-zipcode-cod'); ?></option>
									<option value="friday"><?php _e('Friday', 'pho-pincode-zipcode-cod'); ?></option>
									<option value="saturday"><?php _e('Saturday', 'pho-pincode-zipcode-cod'); ?></option>
									<option value="sunday"><?php _e('Sunday', 'pho-pincode-zipcode-cod'); ?></option>
								</select>
							</td>

						</tr>
						<tr class="user-nickname-wrap time_min" style="display:none;">

							<th><label for="time_hrs"><?php _e('Delivery within hours', 'pho-pincode-zipcode-cod'); ?></label></th>

							<td>
								<input type="number" placeholder="<?php _e('Max 23', 'pho-pincode-zipcode-cod'); ?>"  min="0" max="23" name="time_hrs" />
							</td>

						</tr>
						<tr class="user-nickname-wrap time_min" style="display:none;">

							<th><label for="time_minuts"><?php _e('Delivery within minutes', 'pho-pincode-zipcode-cod'); ?></label></th>
							<td>
								<input type="number"  min="0" max="59" placeholder="<?php _e('Max 59', 'pho-pincode-zipcode-cod'); ?>" name="time_minuts" />
							</td>

						</tr>
						
						<tr class="user-nickname-wrap dq" style="display:none;">
							<th><label for="time_minuts"><?php _e('Quantity range', 'pho-pincode-zipcode-cod'); ?></label></th>
							<td class="range_data" >
								<table>
									<thead>
										<tr>
											<th class="pncode_range_q" ><?php _e('Delivery quantity(s)', 'custom-options'); ?><span class='phoen-help-tip'></span><span class='phoen_quentity_content' >It shows the number of quantity,equal to or less than which is delivered on the mention delivery day.</span></th>
											<th class="pncode_range_d" ><?php _e('Delivery day(s)', 'custom-options'); ?></th>
										</tr>
									</thead>
									<tbody>
										<tr>
											<td><input class="delevery_quantity" required type="number" min="1"  name="delevery_quantity[]" value="1" placeholder="<?php _e('Quantity(s)', 'woocommerce-product-addons'); ?>" /></td><td><input class="delevery_day" required type="number" min="1"  name="delevery_day[]" value="1" placeholder="<?php _e('Day(s)', 'woocommerce-product-addons'); ?>" /></td>
											<td  class="actions" width="1%"><button type="button" class="remove_range button">x</button></td>
										</tr>
									</tbody>
									<tfoot>
										<tr>
											
											<td><button class="add_qrange button button-primary" type="button">Add Range</button></td>
										</tr>
									</tfoot>
								</table>
							</td>
						</tr>
						<tr class="user-nickname-wrap">

							<th><label for="cod"><?php _e('Enable cash on delivery for this pincode', 'pho-pincode-zipcode-cod'); ?></label></th>

							<td><label for="cod"><input type="radio" value="no" class="cod_val" checked="checked" name="cod"><?php _e('No', 'pho-pincode-zipcode-cod'); ?></label>

							<label for="cod"><input type="radio" value="yes" class="cod_val" name="cod"><?php _e('Yes', 'pho-pincode-zipcode-cod'); ?></label></td>
							
						</tr>
						<tr class="user-nickname-wrap cod_min" style="display:none;">

							<th><label for="cod_charge"><?php _e('COD charge', 'pho-pincode-zipcode-cod'); ?></label></th>

							<td>
								<input type="number"  min="0" value="0" name="cod_charge" />
							</td>

						</tr>
						<tr class="user-nickname-wrap cod_min" style="display:none;">

							<th><label for="quantity_into"><?php _e('Enable quantity * COD charge', 'pho-pincode-zipcode-cod'); ?></label></th>

							<td>
								<input type="checkbox"  value="1" name="quantity_into" />
							</td>

						</tr>
						
						<tr class="user-nickname-wrap" style="display:<?php echo !empty($product_id)?"none":"";?>;">
							<th><label for="all_products"><?php _e('Exclude products on shop page', 'pho-pincode-zipcode-cod'); ?></label></th>
							<td>
								<select id="phoen_product_list" name="all_products[]" multiple>
									<?php
									if(isset($phoen_all_product_list) && is_array($phoen_all_product_list)){
										
										foreach($phoen_all_product_list as $key =>$value){
											?>
											<option value="<?php echo $key;?>"><?php echo $value;?></option>
											<?php
											
										}	
										
									}
									?>
								</select>
							</td>
						</tr>

					</tbody>

				</table>
				<?php	
				$product_id=isset($_GET["pro_id"])?$_GET["pro_id"]:'';
				
				if(isset($_GET["rpage"]) && $_GET["rpage"]=="pedit"){
					
					$min_url=  "post.php?post=$product_id&action=edit";
					
				}elseif(!isset($_GET["rpage"])&& !empty($product_id)){
					
					$min_url=  "admin.php?page=list_pincodes&product_id=$product_id";
					
				}else{
					
					$min_url=  "admin.php?page=list_pincodes";
					
				}
				
				?>
				
					<p class="submit"><a class="button" href="<?php echo $min_url;?>"><?php _e('Back', 'pho-pincode-zipcode-cod'); ?></a>&nbsp;&nbsp;<input type="submit" value="Add" class="phoen_add_sub button button-primary" id="submit" name="submit"></p>

			</form>
		</div>
		<style>
		.phoen_ex_num {
			display: block;
			font-size: 11px;
			padding: 5px 0 0;
		}
		
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
		.phoen_quentity_content {
			display: none;
			width: 25%;
			height:"auto";
			padding: 5px 5px 5px 5px;
			background-color: black;
			color: #fff;
			text-align: center;
			border-radius: 6px;
			padding: 5px 0;
			position: absolute;
			z-index: 1;
		}
		
		.form-table td.range_data {
			padding: 0;
		}
		
		.form-table td.range_data table thead th {
			padding-left: 0;  
			width: auto;
		}
		
		.form-table td.range_data table tbody td	{
			width: auto;
		}
		
		</style>
		<script>
		jQuery(document).ready(function(){
			jQuery("#phoen_product_list").select2();
			jQuery(".deliver_by").change(function(){
				if(jQuery(this).val()=="day"){
					jQuery(".day_min").show();
					jQuery(".day_name_min").hide();
					jQuery(".dq").hide();
					jQuery(".time_min").hide();
				}else if(jQuery(this).val()=="day_name"){
					jQuery(".day_min").hide();
					jQuery(".day_name_min").show();
					jQuery(".dq").hide();
					jQuery(".time_min").hide();
				}else if(jQuery(this).val()=="quantity"){
					jQuery(".day_min").hide();
					jQuery(".day_name_min").hide();
					jQuery(".dq").show();
					jQuery(".time_min").hide();
				}else{
					jQuery(".day_min").hide();
					jQuery(".day_name_min").hide();
					jQuery(".dq").hide();
					jQuery(".time_min").show();
					
				}
			});
			jQuery(".cod_val").change(function(){
				
				if(jQuery(this).val()=="yes"){
					
					jQuery(".cod_min").show();
					
				}else{
					
					jQuery(".cod_min").hide();
					
				}
				
			});
			jQuery("body").on("click",".remove_range",function(){
				
				var answer = confirm('<?php _e('Are you sure you want to delete this range?', 'custom-options'); ?>');

				if (answer) {
					
					jQuery(this).closest("tr").remove();
				
				}
				
				return false;
				
				
			});
			
			jQuery("body").on("click",".phoen_add_sub",function(){
				
				if(jQuery("input[name='deliver_by']:checked").val()=="quantity"){
					
					if(jQuery(".range_data tbody tr").length==""){
						confirm('<?php _e('Plese add a range', 'custom-options'); ?>');
						return false;
					}
					
				}
				
			});
			jQuery("body").on("click",".add_qrange",function(){
				
				var html = '<?php
											
					ob_start();
			
					include( 'quantity_range.php' );
				
					$html = ob_get_clean();
					
					echo str_replace( array( "\n", "\r" ), '', str_replace( "'", '"', $html ) );
				
				?>';
				
				jQuery(this).closest('.range_data').find('tbody').append( html );
			});
			
			jQuery(".phoen-help-tip").mouseover(function(){
				jQuery(".phoen_quentity_content").show();
			}); 
			jQuery(".phoen-help-tip").mouseout(function(){
				jQuery(".phoen_quentity_content").hide();
			}); 
			
		});
		</script>
	<?php
}
?>