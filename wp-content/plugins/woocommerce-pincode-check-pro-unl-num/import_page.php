<?php
function import_page_f()
{
	global $table_prefix, $wpdb;
	if(isset($_POST['upload-zip']))
	{
		
		$filename = $_FILES['pincsv']['name'];
		$allowed =  array('csv','CSV');
		$ext = pathinfo($filename, PATHINFO_EXTENSION);
		if(!in_array($ext,$allowed) )
		{
			?>
			<div class="error" id="message">
				<p><strong><?php _e('Please Upload CSV Format', 'pho-pincode-zipcode-cod'); ?>.</strong></p>
			</div>
			<?php
		}
		else
		{

			$file_tmp = $_FILES['pincsv']['tmp_name'];

			$filename = dirname(__FILE__) .'/assets/ufile/'.$filename;

			$move_uploaded_file = move_uploaded_file($file_tmp, $filename);
			
			if($move_uploaded_file == 1)
			{
				?>

				<div class="updated" id="message">

					<p><strong><?php _e('CSV Uploaded', 'pho-pincode-zipcode-cod'); ?>.</strong></p>

				</div>
				
				<?php
			}
			else
			{
				?>

				<div class="error" id="message">

					<p><strong><?php _e('Something Went Wrong, Please Try Again', 'pho-pincode-zipcode-cod'); ?>.</strong></p>

				</div>
				
				<?php
			}

				if(file_exists($filename)) 
				{
					/* INSERT Pincode In Table  */
					$file_handle = fopen("$filename","r");
	
					while(! feof($file_handle))
					{

						$line_of_text = fgetcsv($file_handle, 1024);
						
						$pincode = isset($line_of_text[0])?$line_of_text[0]:'';

						$area = isset($line_of_text[1])?$line_of_text[1]:'';
						
						$city = isset($line_of_text[2])?$line_of_text[2]:'';

						$state = isset($line_of_text[3])?$line_of_text[3]:'';

						$dod = isset($line_of_text[4])?$line_of_text[4]:'';
						
						$codc = isset($line_of_text[5])?$line_of_text[5]:'';
						
						$cod_charge = isset($line_of_text[6])?$line_of_text[6]:'';
						
						$quantity_into = isset($line_of_text[7])?$line_of_text[7]:'';
						
						$dod_name = isset($line_of_text[8])?$line_of_text[8]:'';
						
						$time_hrs = isset($line_of_text[9])?$line_of_text[9]:'';
						
						$time_minuts = isset($line_of_text[10])?$line_of_text[10]:'';
						
						$deliver_by = isset($line_of_text[11])?$line_of_text[11]:'';
						
						$product_list = isset($line_of_text[12])?$line_of_text[12]:'';
						
						$deliver_day = isset($line_of_text[14]) ? $line_of_text[14] :'';
						
						$deliver_quantity = isset($line_of_text[13]) ? $line_of_text[13] : '';
					
						if($dod == '')
						{		
							$dod = 1;
						}
						$quantity_into1='';
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

						if(!empty($pincode) && $pincode!="Pincode")
						{
							
							$num_rows = $wpdb->get_var(" SELECT COUNT(*) FROM `".$table_prefix."check_pincode_pro` where `pincode` = '$pincode' ");

							if($num_rows == 0)
							{
							
								$wpdb->query(" INSERT INTO `".$table_prefix."check_pincode_pro` (`pincode`, `area`, `city`, `state`, `dod`, `cod`,`dod_name`,`time_hrs`,`time_minuts`,`product_list`,`deliver_by`,`cod_charge`,`quantity_into`,`deliver_day`,`deliver_quantity`) VALUES ('$pincode', '$area', '$city', '$state', '$dod', '$cod','$dod_name','$time_hrs','$time_minuts','$product_list','$deliver_by','$cod_charge','$quantity_into1','$deliver_day','$deliver_quantity') ");

							}
							else
							{
								
								$wpdb->query(" UPDATE `".$table_prefix."check_pincode_pro` SET `pincode`='$pincode', `city`='$city', `area`='$area', `state`='$state', `dod`='$dod', `cod`='$cod' ,`dod_name`='$dod_name',`time_hrs`='$time_hrs',`time_minuts`='$time_minuts',`product_list`='$product_list' ,`deliver_by`='$deliver_by',`cod_charge`='$cod_charge',`quantity_into`='$quantity_into1',`deliver_day`='$deliver_day',`deliver_quantity`='$deliver_quantity' where `pincode` = '$pincode' ");

							}
							
						}

					}
	
					fclose($file_handle);

					unlink($filename);

				} 

				else 
				{

				}

		}

	}

	?>

	<div class="wrap">

		<h2><?php _e('Import Zip Codes in CSV Format', 'pho-pincode-zipcode-cod'); ?></h2>
		
		<div class="phoen_import_main">
			<form name="upload_zip_form" id="upload_zip_form" method="post" action="" enctype="multipart/form-data">

				<p><?php _e('Upload File', 'pho-pincode-zipcode-cod'); ?>: &nbsp; <input type="file" name="pincsv" id="pincsv"></p>

				<input type="submit" value="Import" class="button" id="upload-zip" name="upload-zip" >

			</form>		
			<?php 
			$max_upload = (int)(ini_get('upload_max_filesize')); 
			$plugin_dir_url =  plugin_dir_url( __FILE__ );
			?>		
			<p class="max-upload-size"><?php _e('Maximum upload file size', 'pho-pincode-zipcode-cod'); ?>: <?php echo $max_upload; ?> <?php _e('MB', 'pho-pincode-zipcode-cod'); ?>.</p>
			<p class="upload-html-bypass hide-if-no-js">
				<a href="<?php echo $plugin_dir_url; ?>assets/testfile/test.csv"><?php _e('Example CSV File', 'pho-pincode-zipcode-cod'); ?></a>.
			</p>
		</div>
		
	</div>
	
	<style>
		.phoen_import_main {background-color: #fff; padding: 10px 20px 20px; margin-top: 20px;}
	</style>

	<?php

}

?>