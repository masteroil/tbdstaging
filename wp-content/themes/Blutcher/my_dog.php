<?php
/* template name: mydog */

get_header();

?>
<meta name="googlebot" content="noindex">
<style>
	.header-alert.alert.alert-success {
    display: none;
}
 	footer{
 		display:none;
 	}
 	.foot-social{
 		display:none;
 	}
 	.foot-bot{
 		display: none;
 	}
 	input.submit-changes-do {
    background: black;
}
</style>

<?php 
if(isset($_POST["update"])){ 
global $wpdb;
$uuserid=$_POST['useridu'];
$uid=$_POST['idu'];
$date_fieldu = strtotime($_POST['dateu']);
$table = "wp_my_dogs";
    $data = array(
        'name' => isset($_POST['fnameu']) ? $_POST['fnameu'] : "",
         'user_id' => $uuserid,
         'gender'   => isset($_POST['genderu']) ? $_POST['genderu'] : "",
         'breed' => isset($_POST['breadu']) ? $_POST['breadu'] : "",
         'dob' => isset($date_fieldu) ? $date_fieldu : "",
         'weigt' => isset($_POST['weightu']) ? $_POST['weightu'] : "",
         'allergies' => isset($_POST['allergiesu']) ? $_POST['allergiesu'] : "",
         'type' => isset($_POST['typeu']) ? $_POST['typeu'] : "",
    );
    $where = [ 'id' => $uid ];
$updated = $wpdb->update( $table, $data, $where );
	if($updated){
		//echo "<div style='color:green'>Your dog’s information has been updated</div>";?>
		<style>
			.update_msg{
				display:block!important;
				color: green;
			}
		</style>
		<?php
		}

    else{
    	echo "error";
    }
}

$userID = get_current_user_id();


 if (!empty($_POST['save'])) {

 	$date_field = strtotime($_POST['date']);

 
	global $wpdb;
    $table = "wp_my_dogs";
    $data = array(
        'name' => isset($_POST['fname']) ? $_POST['fname'] : "",
         'user_id' => $userID,
         'gender'   => isset($_POST['gender']) ? $_POST['gender'] : "",
         'breed' => isset($_POST['bread']) ? $_POST['bread'] : "",
         'dob' => isset($date_field) ? $date_field : "",
         'weigt' => isset($_POST['weight']) ? $_POST['weight'] : "",
         'allergies' => isset($_POST['allergies']) ? $_POST['allergies'] : "",
         'type' => isset($_POST['type']) ? $_POST['type'] : "",
    );
    $format = array(
        '%s',
        '%d',
        '%s',
        '%s',
        '%d',
        '%s',
        '%s',
        '%s',
    );
    $success=$wpdb->insert( $table, $data, $format );
    if($success){
        echo 'data has been save' ; 
    }
    else{
    	echo "error";
    }
 }

$results = $wpdb->get_results( "SELECT * FROM wp_my_dogs WHERE user_id = '".$userID."'");


defined( 'ABSPATH' ) || exit;

/**
 * My Account navigation.
 *
 * @since 2.6.0
 */
?>

<div class="woocommerce-MyAccount-content">
	
<div class="main-account-pages-all" id="all-page-header-space">
	<div class="accounts-header-main">
		<div class="left-side-header-main" id="leftsheadernav">
			
			<div class="menu-rightunder">
			<?php do_action( 'woocommerce_account_navigation' ); ?>
				
			</div>
			<div class="right-signout">
				
			</div>
		</div>
		<div class="right-content-header-b">
			
			<div class="pages-right-body" id="pages-right-body">
				<div class="right-box-heddin">
					<h6>MY DOGS</h6>
				</div>
				<p class="update_msg" style="display: none;">Your dog’s information has been updated</p>
				<p class="updated_msg" style="display: none;">Your dog’s information has been Deleted</p>
				<!-- <div class="dogs-daisya-banner">
					<div class="all-heade-dtels-text">
						<h4>Dog 1</h4>
					</div>
				</div> -->
				<div class="image-daisy-row">
					<!-- <div class="doge-dasy-image">
						<img src="<?php echo get_site_url();?>/wp-content/uploads/2020/10/Dog_Profile.png">
						
					</div>
					<div class="text-pera-daisy">
						<h3>Daisy</h3>
					</div> -->
				</div>


			<form method="post">
				<div class="inputs-detelss-row">
					<div class="custome-box-inpu">
						<input type="text" id="" required="required" name="fname" placeholder="Name" class="under-type-input">
					</div>
					<div class="custome-box-inpu">
						<div class="under-redio-bt">
							<p><input type="radio" id="female" name="gender" value="female" required="required"> <label>Female</label></p> <p><input type="radio" id="male" name="gender" value="male" required="required"> <label>Male</label></p>
						</div>
					</div>
				</div>
				<div class="inputs-detelss-row">
					<div class="custome-box-inpu">
						
						<input type="text" id="bread" required="required" name="bread" placeholder="Breed" class="under-type-input">
					</div>
					<div class="custome-box-inpu birthdaytext">
						
						<input type="date" id="start" name="date" value="" min="01-01-2020" max="31-12-2025" class="under-type-input" required="required" placeholder="Birthday">
					</div>
				</div>
				<div class="inputs-detelss-row">
					<div class="custome-box-inpu">
						<input type="text" id="" name="weight" placeholder="Weight (kg)" class="under-type-input">
					</div>
					<div class="custome-box-inpu">
						<input type="text" id="allergies" required="required" name="allergies" placeholder="Allergies" class="under-type-input">
						
					</div>
				</div>
				<div class="inputs-detelss-row">
					<div class="last-under-redio-bt">
						<p><input type="radio" id="Puppy" name="type" value="Puppy"> <label>Puppy</label></p> 
						<p><input type="radio" id="Rescue" name="type" value="Rescue"> <label>Rescue</label></p>
						<p><input type="radio" id="Senior" name="type" value="Senior"> <label>Senior</label></p>
						<p><input type="radio" id="Overweight" name="type" value="Overweight"> <label>Overweight</label></p>
						<p><input type="radio" id="Underweight" name="type" value="Underweight"> <label>Underweight</label></p>
					</div>

					<div class="lst-redio-left-submit">
						<input type='submit' name='save' class="submit-changes-do">
					</div>
				</div>
			</form>
				
			</div>
			<div class="add-other-dosg-amin">
				
					<h4>My Dogs</h4>
					
				</div>
			<div class="doges-custome-tabme">
				<table class="woocommerce-orders-table woocommerce-MyAccount-orders shop_table shop_table_responsive my_account_orders account-orders-table">
					<thead>
						<tr>
							<th class="woocommerce-orders-table__header woocommerce-orders-table__header-order-name"><span class="nobr">Name</span></th>
							<th class="woocommerce-orders-table__header woocommerce-orders-table__header-order-gender"><span class="nobr">Gender</span></th>
							<th class="woocommerce-orders-table__header woocommerce-orders-table__header-order-Breed"><span class="nobr">Breed</span></th>
							<th class="woocommerce-orders-table__header woocommerce-orders-table__header-order-date"><span class="nobr">Birthday</span></th>
							<th class="woocommerce-orders-table__header woocommerce-orders-table__header-order-wight"><span class="nobr">Weight</span></th>
							<th class="woocommerce-orders-table__header woocommerce-orders-table__header-order-wight"><span class="nobr">Allergies</span></th>
							<th class="woocommerce-orders-table__header woocommerce-orders-table__header-order-wight"><span class="nobr">Type</span></th>
							<th class="woocommerce-orders-table__header woocommerce-orders-table__header-order-wight"><span class="nobr">Action</span></th>
						</tr>
					</thead>

					<tbody>
						<?php foreach ($results as $row){ ?>
							<tr class="woocommerce-orders-table__row woocommerce-orders-table__row--status-pending order">
								<td class="dog_name" data-title="Name">
									<?php echo $row->name; ?>
								</td>
								<td class="dog_ender" data-title="Gender">
									<?php echo $row->gender; ?>
								</td>
								<td class="dog_ender" data-title="Gender">
									<?php echo $row->breed; ?>
								</td>
								<td class="dog_dob" data-title="DOB">
									<?php echo date( "m/d/Y", $row->dob); ?>
								</td> 
								<td class="dog_name" data-title="Weight">
									<?php echo $row->weigt; ?>
								</td>
								<td class="dog_allergies" data-title="Allergies">
									<?php echo $row->allergies; ?>
								</td>
								<td class="dog_type" data-title="Type">
									<?php echo $row->type; ?>
								</td>
								<td class="dog_action" data-title="Type">
									<form method="post">
										<input type="hidden" name="rid" value="<?php echo $row->id; ?>">
										<input type="submit" name='edit' class="submit-changes-do" value="Edit">
										<input type="submit" name='delete' class="submit-changes-do" value="Delete">
								</form>
								</td>				
							</tr>
							
						<?php } ?>
						<?php
if(isset($_POST["edit"]))
{
	?>
	<style>
			#pages-right-body{
				display: none;
			}
		</style>
	<?php
 $sum=$_POST["rid"];
 global $wpdb;

$resultsedit = $wpdb->get_results( "SELECT * FROM wp_my_dogs WHERE id = '".$sum."'");
if($resultsedit>=1){
	foreach ($resultsedit as $rowe){ ?>
		<form method="post">
				<div class="inputs-detelss-row">
					<div class="custome-box-inpu">
						<input type="hidden" id="" required="required" name="idu" placeholder="ID" class="under-type-input" value="<?php echo $rowe->id;?>">
						<input type="hidden" id="" required="required" name="useridu" placeholder="ID" class="under-type-input" value="<?php echo $rowe->user_id;?>">
						<input type="text" id="" required="required" name="fnameu" placeholder="Name" class="under-type-input" value="<?php echo $rowe->name;?>">
					</div>
					<div class="custome-box-inpu">
						<div class="under-redio-bt">
							<p><input type="text" id="female" name="genderu" required="required" value="<?php echo $rowe->gender;?>"></p>
						</div>
					</div>
				</div>
				<div class="inputs-detelss-row">
					<div class="custome-box-inpu">
						<input type="text" id="bread" required="required" name="breadu" placeholder="Breed" class="under-type-input" value="<?php echo $rowe->breed;?>">
					</div>
					<div class="custome-box-inpu birthdaytext">
						<input type="text" id="start" name="dateu" value="<?php echo date( "m/d/Y", $rowe->dob);?>" min="01-01-2020" max="31-12-2025" class="under-type-input" required="required" placeholder="Birthday">
					</div>
				</div>
				<div class="inputs-detelss-row">
					<div class="custome-box-inpu">
						<input type="text" id="" name="weightu" placeholder="Weight (kg)" class="under-type-input" value="<?php echo $rowe->weigt;?>">
					</div>
					<div class="custome-box-inpu">
						<input type="text" id="allergies" required="required" name="allergiesu" placeholder="Allergies" class="under-type-input" value="<?php echo $rowe->allergies;?>">
						
					</div>
				</div>
				<div class="inputs-detelss-row">
					<div class="last-under-redio-bt">
						<p><input type="text" id="Puppy" name="typeu" value="<?php echo $rowe->type;?>"></p>
					</div>

					<div class="lst-redio-left-submit">
						<input type='submit' name='update'  value="Update" class="submit-changes-do">
					</div>
				</div>
			</form>
		<?php
 }
}
}

?>

<?php
if(isset($_POST["delete"]))
{
	?>
	<style>
			#pages-right-body{
				display: none;
			}
		</style>
	<?php
	 $sum=$_POST["rid"];
 global $wpdb;

$resultsedit = $wpdb->get_results( "SELECT * FROM wp_my_dogs WHERE id = '".$sum."'");
if($resultsedit>=1){
	$wpctable='wp_my_dogs';
	$deleted=$wpdb->delete( $wpctable, array( 'id' => $sum ) );
		if($deleted){

			header('Location: '.$_SERVER['REQUEST_URI']);
			echo "<div class='updatedmsg' style='color:green;'>Your dog’s information has been Deleted</div>";
			?>
			
		<style>
			.update_msg{
				display:block!important;
				color: green;
			}
		</style>

		<?php
		}
	}

}
?>

					</tbody>
				</table>
			</div>

		</div>
	</div>
</div> 
</div>

<?php
get_footer();
?>