<?php
global $table_prefix, $wpdb;

if( (isset($_GET['action']) &&   $_GET['action']  == 'delete') || (isset($_GET['action2']) && $_GET['action2'] == 'delete' )  ||   (isset($_GET['action'])&& $_GET['action'] == 'delete-all' ) ||   (isset($_GET['action2'])&& $_GET['action2'] == 'delete-all' ) )
{
	
	$id = isset($_GET['id'])?$_GET['id']:'';
	
	$product_id = isset($_GET['product_id'])?$_GET['product_id']:'';

	if($product_id != '' )
	{
		$phen_pincodes_list = get_post_meta( $product_id, 'phen_pincode_list' );
		
		$phen_pincode_list = is_array($phen_pincodes_list[0])?$phen_pincodes_list[0]:'';
		
		$ids = isset($_GET['pincode'])?$_GET['pincode']:'';
		
		if(isset($ids) && is_array($ids)){
			
			$count = count($ids);

			for($i=0;$i<$count;$i++)
			{


				$_id = isset($ids[$i])?$ids[$i]:'';

				unset($phen_pincode_list[$_id]);

			}
			
			update_post_meta( $product_id,'phen_pincode_list',$phen_pincode_list );
			
		}
		
		
		if( array_key_exists(  $id,$phen_pincode_list ) )
		{
			 
			unset($phen_pincode_list[$id]);

			update_post_meta( $product_id,'phen_pincode_list',$phen_pincode_list );
		}
		
		
		if($_GET['action'] == 'delete-all' )
		{
			
			$phen_pincode_list = array();
			 
			update_post_meta( $product_id,'phen_pincode_list',$phen_pincode_list );
						
			$url = admin_url("post.php?post=$product_id&action=edit");
						
			 header("Location: $url");
			
		}
		
		
	}
	else
	{
		
		if( isset($id) )
		{

			
			$wpdb->query( $wpdb->prepare( "DELETE FROM `".$table_prefix."check_pincode_pro` WHERE `id` = %d", $id ) );
				
			$delete_check = true;

			
		}

		$ids = isset($_GET['pincode'])?$_GET['pincode']:'';

		if( isset( $ids ) )
		{

			$count = !empty($ids)?count($ids):0;

			for($i=0;$i<$count;$i++)

			{


				$_id = isset($ids[$i])?$ids[$i]:'';


				$wpdb->query( $wpdb->prepare( "DELETE FROM `".$table_prefix."check_pincode_pro` WHERE `id` = %d ", $_id ) );
			
			}

		}
	
	}

}

if(!class_exists('WP_List_Table')){

    require_once( ABSPATH . 'wp-admin/includes/class-wp-list-table.php' );

}

class TT_Example_List_Tablee extends WP_List_Table {

    function __construct(){

        global $status, $page;

        //Set parent defaults

        parent::__construct( array(

            'singular'  => 'Zipcode',     //singular name of the listed records

            'plural'    => 'Zipcodes',    //plural name of the listed records

            'ajax'      => false        //does this table support ajax?

        ) );

    }

    function column_default($item, $column_name){


    }

    function column_title($item){

        //Build row actions

        $actions = array(

            'edit'      => sprintf('<a href="?page=%s&action=%s&p=%s">Edit</a>',$_REQUEST['page'],'edit',$item['id']),

            'delete'    => sprintf('<a href="?page=%s&action=%s&p=%s">Delete</a>',$_REQUEST['page'],'delete',$item['id']),

        );

        

        //Return the title contents

        return sprintf('%1$s <span style="color:silver">(id:%2$s)</span>%3$s',

            /*$1%s*/ $item['pincode'],

            /*$2%s*/ $item['id'],

            /*$3%s*/ $this->row_actions($actions)

        );

    }

    function column_cb($item){

        return sprintf(

            '<input type="checkbox" name="%1$s[]" value="%2$s" />',

            /*$1%s*/ $this->_args['singular'],  //Let's simply repurpose the table's singular label ("movie")

            /*$2%s*/ $item['ID']                //The value of the checkbox should be the record's id

        );

    }

    function get_columns(){
		$product_id = isset($_GET['product_id'])?$_GET['product_id']:'';
		if( empty($product_id) && $product_id == '' ) {
			
			$Pincode = __('Pincode','pho-pincode-zipcode-cod');
			$City = __('City','pho-pincode-zipcode-cod');
			$State = __('State','pho-pincode-zipcode-cod');
			$Delivery_within_days = __('Delivery within days','pho-pincode-zipcode-cod');
			$Cash_on_delivery = __('Cash on delivery','pho-pincode-zipcode-cod');
			$Delivery_within_days_name = __('Delivery by','pho-pincode-zipcode-cod');
			// $product_list = __('Excluded product','pho-pincode-zipcode-cod');
			$product_list =  __('Excluded product','pho-pincode-zipcode-cod')."<span class='phoen-help-tip'><span class='phoen_tiptip_content' >Excluded product ID(s) which is hidden in the respective pincode/zipcode.</span></span>";
		
			
			$columns = array(

				'id'        => '<label for="id-select-all-1" class="screen-reader-text">Select All</label><input class="id-select-all-1" type="checkbox" />', //Render a checkbox instead of text

				'pincode'     => $Pincode,

				'city'    => $City,

				'state'  =>$State,
				
				'cod'  => $Cash_on_delivery,
				
				'deliver_by'=>$Delivery_within_days_name,
								
				'product_list'=>$product_list

			);
		
		}
		else
		{
			
			$Pincode = __('Pincode','pho-pincode-zipcode-cod');
			$City = __('City','pho-pincode-zipcode-cod');
			$State = __('State','pho-pincode-zipcode-cod');
			$Cash_on_delivery = __('Cash on delivery','pho-pincode-zipcode-cod');
			$Delivery_within_days_name = __('Delivery by','pho-pincode-zipcode-cod');
			
				$columns = array(
				
					'id'        => '<label for="id-select-all-1" class="screen-reader-text">Select All</label><input class="id-select-all-1" type="checkbox" />', //Render a checkbox instead of text
					
					'pincode'     => $Pincode,

					'city'    => $City,

					'state'  => $State,
					
					'cod'  => $Cash_on_delivery,
					
					'deliver_by'=>$Delivery_within_days_name,
			);

		}

        return $columns;

    }


    function get_sortable_columns() {

		if(isset($_GET['product_id']) && $_GET['product_id'] == '' ) {
			
			$sortable_columns = array(

				'pincode'     => array('pincode',false),  //true means it's already sorted

				'city'    => array('city',false),

				'state'  => array('state',false),

				'dod'  => array('dod',false),
				
				'cod'  => array('cod',false),
								
				'deliver_by'  => array('deliver_by',false),
				
			);
			
		}
		else
		{
			
			$sortable_columns = array(

				'pincode'     => array('pincode',false),  //true means it's already sorted

				'city'    => array('city',false),

				'state'  => array('state',false),

				'dod'  => array('dod',false),
				
				'cod'  => array('cod',false),
				
				'deliver_by'  => array('deliver_by',false),
				
			);
			
		}
	
        return $sortable_columns;

    }
	
	
    function get_bulk_actions() {

		if(empty( $_GET['product_id'] ) )  {
			
			$actions = array(

				'delete'    => 'Delete'

			);
			
		}
		else
		{
			
			$actions = array(

				'delete'    => 'Delete'

			);
			
		}
		
        return $actions;

    }

    function process_bulk_action() {

        //Detect when a bulk action is being triggered...

        if( 'delete'===$this->current_action() ) {

            wp_die('Items deleted (or they would be if we had items to delete)!');

        }

    }

    function prepare_items() {

	   global $wpdb, $_wp_column_headers,$table_prefix;

		/* -- Preparing your query -- */

        $query = "SELECT * FROM `".$table_prefix."check_pincode_pro`";
        $query22 = "SELECT * FROM `".$table_prefix."check_pincode_pro`";
		
		/* -- Ordering parameters -- */

       //Parameters that are going to be used to order the result

       $orderby = !empty($_GET["orderby"]) ? esc_sql($_GET["orderby"]) : 'ASC';

       $order = !empty($_GET["order"]) ? esc_sql($_GET["order"]) : '';

	   
	   if( empty( $_GET['product_id'] )) {
		   
			if(!empty($orderby) & !empty($order)){ $query.=' ORDER BY '.$orderby.' '.$order; }
		
	    }
	
		/* -- Pagination parameters -- */

        //Number of elements in your table?
		if( empty( $_GET['product_id'] ) )  {
			
			$totalitems = $wpdb->query($query); //return the total number of affected rows
		
		}
		else{
			
			$records1 = get_post_meta( $_GET['product_id'],'phen_pincode_list',true);
			
			$records=array();
			
			if(isset($records1) && !empty($records1)){
				
				foreach($records1 as $record){
					
					$records[]=array(
						'id'=>$record[0],
						'pincode'=>$record[0],
						'city'=>$record[1],
						'state'=>$record[2],
						'dod'=>$record[3],
						'deliver_by'=>$record[6],
						'cod'=>$record[4],
					);
					
				}
				
				usort( $records, array( &$this, 'sort_data' ) );		
			}
			
			$totalitems = count( $records );
			
		}
		
        //How many to display per page?

        $perpage = 15;

		
        //Which page is this?

        $paged = !empty($_GET["paged"]) ? esc_sql($_GET["paged"]) : '';

        //Page Number

        if(empty($paged) || !is_numeric($paged) || $paged<=0 ){ $paged=1; }

        //How many pages do we have in total?

        $totalpages = ceil($totalitems/$perpage);

        //adjust the query to take pagination into account

		if(!empty($paged) && !empty($perpage)){

			$offset=($paged-1)*$perpage;

			$query.=' LIMIT '.(int)$offset.','.(int)$perpage;

		}
	   // $array=$wpdb->get_results($query);
	 

		/* -- Register the pagination -- */

      $this->set_pagination_args( array(

         "total_items" => $totalitems,

         "total_pages" => $totalpages,

         "per_page" => $perpage,

      ) );

	 
      //The pagination links are automatically built according to those parameters

	  /* -- Register the Columns -- */

      $columns = $this->get_columns();

      $hidden = array();

	  $sortable = $this->get_sortable_columns();

	  $this->_column_headers = array($columns, $hidden, $sortable);

	/* -- Fetch the items -- */
	
		if( empty( $_GET['product_id'] ) ) {
			
			$this->items = $wpdb->get_results($query);
			
			
			
		}
		else
		{
			
			
			if(isset($records) && is_array($records)){
				
				$this->items = array_slice($records, $offset, $perpage,true);
				
			}

			$main_list=$records;
		
		}
		
		$main_search_data=array();
		
		if(isset($_POST['search']) && !empty($_POST['search'])){
		
				$query=sanitize_text_field($_POST['search']);
				
				if($query!="day" && strpos("day name",$query) !==false){
					$query="day_name";
				}elseif(strpos("hours and minutes",$query) !==false){
					$query="time_picker";
				}
				
				if( empty( $_GET['product_id'] ) ) {
					
					$main_list= $wpdb->get_results($query22);
					
					foreach($main_list as $phoen_main_search){
					
						if(strpos($phoen_main_search->pincode,$query) !==false || strpos($phoen_main_search->city,$query) !==false || strpos($phoen_main_search->state,$query) !==false || strpos($phoen_main_search->cod,$query) !==false || strpos($phoen_main_search->deliver_by,$query) !==false){
							
							$main_search_data[]=$phoen_main_search;
							
						}
						
					}
					
				}
				else
				{
					
					foreach($main_list as $phoen_main_search){
					
						if(strpos($phoen_main_search["pincode"],$query) !==false || strpos($phoen_main_search["city"],$query) !==false || strpos($phoen_main_search["state"],$query) !==false || strpos($phoen_main_search["cod"],$query) !==false || strpos($phoen_main_search["deliver_by"],$query) !==false){
							
							$main_search_data[]=$phoen_main_search;
							
						}
						
					}
				
				}
				
				$this->items=$main_search_data;
		}
	}
	
	function sort_data( $a, $b )
	{
	
		// Set defaults
		$orderby = 'id';
		$order = 'asc';
		// If orderby is set, use this as the sort column
		if(!empty($_GET['orderby']))
		{
			$orderby = $_GET['orderby'];
		}
		// If order is set use this as the order
		if(!empty($_GET['order']))
		{
			$order = $_GET['order'];
		}
		$result = strcmp( $a[$orderby], $b[$orderby] );
		
		
		if($order === 'asc')
		{
			return $result;
		}
		return -$result;
	}
		
	function display_rows() 
	{

			$records = $this->items;
			
			//Get the columns registered in the get_columns and get_sortable_columns methods

			list( $columns, $hidden ) = $this->get_column_info();

			//Loop for each record

			if(!empty($records)) {
				
				foreach($records as $rec) 
				{

						//Open the line
					// $min_res=	isset($rec[0])?$rec[0]:'';
						
						if(isset($_GET['product_id']) && $_GET['product_id'] != '' ) {
							
							// echo '<tr class="alternate" id="record_'.$min_res.'">';
							echo '<tr class="alternate" id="record_'.$rec["id"].'">';
							
						}
						else
						{
							
							echo '<tr class="alternate" id="record_'.$rec->id.'">';
							
						}
						
						foreach ( $columns as $column_name => $column_display_name ) {

							//Style attributes for each col

							$class = "class='$column_name column-$column_name'";

							$style = "";

							if ( in_array( $column_name, $hidden ) ) $style = ' style="display:none;"';

							$attributes = $class . $style;

							//edit link
							
							if(isset($_GET['product_id']) && $_GET['product_id'] != '' ) {
								
								$editlink  = '/wp-admin/link.php?action=edit&id='.stripslashes($rec["id"]);
								
								if(isset($rec["deliver_by"]) && $rec["deliver_by"]=="day_name" ){
									$deliver_by="day name";
								}elseif(isset($rec["deliver_by"]) && $rec["deliver_by"]=="quantity" ){
									$deliver_by="quantity";
								}elseif(isset($rec["deliver_by"]) && $rec["deliver_by"]=="time_picker" ){
									$deliver_by="hours and minutes";
								}else{
									$deliver_by="day";
								}
								//Display the cell

								switch ( $column_name ) {

										case "id":     echo '<th '.$attributes.'><input name="pincode[]" type="checkbox" value="'.stripslashes($rec["id"]).'" /></th>';break;

										case "pincode": 
										
										//echo '<td '.$attributes.'>'.stripslashes($rec[0]).'</td>';

										echo '<td '.$attributes.'>'.stripslashes($rec["id"]).'<div class="row-actions"><span class="product_edit"><a href="?page=list_pincodes&amp;action=product_edit&amp;id='.stripslashes($rec["id"]).'&amp;product_id='.stripslashes($_REQUEST['product_id']).'">Edit</a> | </span><span class="delete"><a href="?page=list_pincodes&amp;action=delete&amp;id='.stripslashes($rec["id"]).'&amp;product_id='.stripslashes($_REQUEST['product_id']).'">Delete</a></span></div></td>';

										break;

										case "city": echo '<td '.$attributes.'>'.stripslashes($rec["city"]).'</td>'; break;

										case "state": echo '<td '.$attributes.'>'.stripslashes($rec["state"]).'</td>'; break;

										case "dod": echo '<td '.$attributes.'>'.stripslashes($rec["dod"]).'</td>'; break;
										
										case "deliver_by": echo '<td '.$attributes.'>'.stripslashes($deliver_by).'</td>'; break;
										
										case "cod": echo '<td '.$attributes.'>'.stripslashes($rec["cod"]).'</td>'; break;

								}
								
							}
							else
							{
								
								$editlink  = '/wp-admin/link.php?action=edit&id='.stripslashes($rec->id);
								$deliver_by=isset($rec->deliver_by) ? $rec->deliver_by : 0;
								$city=isset($rec->city) ? $rec->city : 0;
								$state=isset($rec->state) ? $rec->state : 0;
								$dod_name=isset($rec->dod_name) ? $rec->dod_name : 0;
								$cod=isset($rec->cod) ? $rec->cod : 0;
								$product_list=isset($rec->product_list) ? $rec->product_list : 0;
								$time_minuts=isset($rec->time_minuts) ? $rec->time_minuts : 0;
								$time_hr=isset($rec->time_hr) ? $rec->time_hr : 0;
								$time_hrs=isset($rec->time_hrs) ? $rec->time_hrs : 0;
								if(isset($deliver_by) && $deliver_by=="day_name" ){
									$deliver_by="day name";
								}elseif(isset($deliver_by) && $deliver_by=="quantity" ){
									$deliver_by="quantity";
								}elseif(isset($deliver_by) && $deliver_by=="time_picker" ){
									$deliver_by="hours and minutes";
								}else{
									$deliver_by="day";
								}
								
								//Display the cell

								switch ( $column_name ) {

									case "id":     echo '<th '.$attributes.'><input name="pincode[]" type="checkbox" value="'.stripslashes($rec->id).'" /></th>';break;

									case "pincode": echo '<td '.$attributes.'>'.stripslashes($rec->pincode).'<div class="row-actions"><span class="edit"><a href="?page=list_pincodes&amp;action=edit&amp;id='.stripslashes($rec->id).'">Edit</a> | </span><span class="delete"><a href="?page=list_pincodes&amp;action=delete&amp;id='.stripslashes($rec->id).'">Delete</a></span></div></td>'; break;

									case "city": echo '<td '.$attributes.'>'.stripslashes($city).'</td>'; break;

									case "state": echo '<td '.$attributes.'>'.stripslashes($state).'</td>'; break;

									case "deliver_by": echo '<td '.$attributes.'>'.stripslashes($deliver_by).'</td>'; break;			
									
									case "cod": echo '<td '.$attributes.'>'.stripslashes($cod).'</td>'; break;			
									
									case "product_list": echo '<td '.$attributes.'>'.stripslashes($product_list).'</td>'; break;
										
								}
							
							}

						}

						//Close the line

						echo'</tr>';

				}
				
			}	
	}

}

function list_pincodes_f()
{
	global $table_prefix, $wpdb;

	//Create an instance of our package class...

   $testListTable = new TT_Example_List_Tablee();

    //Fetch, prepare, sort, and filter our data...

   $testListTable->prepare_items();
	
	$phoen_all_product_list=phoen_main_details();
    ?>

    <div class="wrap">
			
			<?php
				
				$actions_min=isset($_GET["action"])?$_GET["action"]:'';
				
				if(empty($actions_min) ||  $actions_min=="delete-all" ||  $actions_min=="delete"){
					
					if(!isset($_GET['product_id'] ) || empty($_GET['product_id'])) {
							
						?>
						
							<h2><?php _e('Zip Code List', 'pho-pincode-zipcode-cod'); ?><a class="add-new-h2" href="?page=add_pincode"><?php _e('Add New', 'pho-pincode-zipcode-cod'); ?></a></h2>
							
						<?php
					
					}
					else
					{
						
						if($_REQUEST['product_id'] !=""){
							$product=wc_get_product($_REQUEST['product_id']);
						
						$product_name=$product->get_name();
					
						?>
						<h2><?php _e('Zip Code List', 'pho-pincode-zipcode-cod'); ?>- ( <?php echo isset($product_name)?$product_name:''; ?> )<a class="add-new-h2" href="?page=add_pincode&&pro_id=<?php echo isset($_REQUEST['product_id'])?$_REQUEST['product_id']:''; ?>"><?php _e('Add New', 'pho-pincode-zipcode-cod'); ?></a></h2>
						
						<?php
						}
						
						
					}
					
				}
			
			// die();
			
			if(isset($_GET['id']))
			{
				
				$id = sanitize_text_field( $_GET['id'] );
				
			}elseif(isset($_GET["pincode"])){
				
				$id = is_array($_GET['pincode'])?$_GET['pincode']:array();
				
			}else{
				
				$id="";
				
			}

			if(isset($_GET['action'] ) && (sanitize_text_field( $_GET['action'] ) == 'delete') && !empty($id) )
			{

				?>

					<div class="updated below-h2" id="message"><p><?php _e('Deleted Successfully', 'pho-pincode-zipcode-cod'); ?>.</p></div>

				<?php

			}
			
			if (!isset($_GET['action']) || $_GET['action']=="delete"){ ?>
			
			<div>
				<form method="post">
			
				<input type="hidden" name="page" value="myListTable" />
				
				<p class="search-box">
					
					<label class="screen-reader-text" for="search_id-search-input"><?php _e('search:','pho-pincode-zipcode-cod'); ?></label> 
					
					<input id="search_id-search-input" type="text" name="search" value="" /> 
					
					<input id="search-submit" class="button" type="submit" name="" value="search" />
				
				</p>
			
				</form>
				</div>
				<?php 
			}

			if(isset($_GET['action']) && sanitize_text_field( $_GET['action'] ) == 'edit' && isset($id))
			{	
				if(isset($_POST['submit']) && sanitize_text_field( $_POST['submit'] ) == 'Update')
				{
					$pincode = sanitize_text_field( $_POST['pincode'] );

					$area = sanitize_text_field( $_POST['area'] );
					
					$city = sanitize_text_field( $_POST['city'] );

					$state = sanitize_text_field( $_POST['state'] );

					$dod = sanitize_text_field( $_POST['dod'] );
					
					$cod = sanitize_text_field( $_POST['cod'] );
					
					$dod_name = sanitize_text_field( $_POST['dod_name'] );
					
					$time_minuts=sanitize_text_field( $_POST['time_minuts'] );
					
					$time_hrs=sanitize_text_field( $_POST['time_hrs'] );
					
					$deliver_by = sanitize_text_field( $_POST['deliver_by'] );
					
					$quantity_into= isset($_POST['quantity_into']) ? sanitize_text_field( $_POST['quantity_into'] ) : '';
					
					$cod_charge=sanitize_text_field( $_POST['cod_charge'] );
					
					$dquantity_min=isset($_POST['delevery_quantity'])? $_POST['delevery_quantity'] :array();
					
					$dday_min=isset($_POST['delevery_day'])?	$_POST['delevery_day']:array();
					
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
					
					$safe_zipcode = $pincode;
					
					$safe_dod = intval( $dod );

					if (  $safe_zipcode)
					{
						$wpdb->query( "UPDATE `".$table_prefix."check_pincode_pro` SET `pincode`='$pincode', `area`='$area', `city`='$city', `state`='$state', `dod`='$dod', `cod`='$cod' ,`dod_name`='$dod_name',`time_minuts`='$time_minuts',`time_hrs`='$time_hrs',`product_list`='$products_list',`deliver_by`='$deliver_by',`quantity_into`='$quantity_into',`cod_charge`='$cod_charge',`deliver_day`='$dday',`deliver_quantity`='$dquantity' where `id` = $id" );

						?>

							<div class="updated below-h2" id="message"><p><?php _e('Updated Successfully', 'pho-pincode-zipcode-cod'); ?>.</p></div>

						<?php
					}
					else
					{
						?>

							<div class="error below-h2" id="message"><p> <?php _e('Please Fill Valid Data', 'pho-pincode-zipcode-cod'); ?>.</p></div>

						<?php
					}

				}

				$query = "SELECT * FROM `".$table_prefix."check_pincode_pro` where `id` = $id";
				$qry22 = $wpdb->get_results( $query,ARRAY_A);
				
				foreach($qry22 as $qry)
				{
				}
				
				$product_list=isset($qry['product_list']) ? $qry['product_list']:0;
				
				$list_products_min=explode(",",$product_list);
				
				$pincode_length = get_option('pincode_length');
				
				$url = htmlspecialchars($_SERVER['HTTP_REFERER']);
				
				?>

				<div id="icon-users" class="icon32"><br/></div>

				<h2><?php _e('Update Zip Code', 'pho-pincode-zipcode-cod'); ?><a class="add-new-h2" href="?page=add_pincode"><?php _e('Add New', 'pho-pincode-zipcode-cod'); ?></a></h2>
	
					<!-- Forms are NOT created automatically, so you need to wrap the table in one to use features like bulk actions -->

				<form action="" method="post" id="uzip_form" name="uzip_form">

					<table class="form-table">

					<tbody>

						<tr class="user-user-login-wrap">

							<th><label for="user_login"><?php _e('Pincode', 'pho-pincode-zipcode-cod'); ?></label></th>

							<td><input type="text" maxlength="<?php echo $pincode_length;?>" class="regular-text" value="<?php echo $qry['pincode'];?>" id="pincode" name="pincode"></td>

						</tr>
						<tr class="user-first-name-wrap">

							<th><label for="area"><?php _e('Area', 'pho-pincode-zipcode-cod'); ?></label></th>

							<td><input type="text" value="<?php echo isset($qry['area'])?$qry['area']:'';?>" class="regular-text" id="area" name="area"></td>

						</tr>
						<tr class="user-first-name-wrap">

							<th><label for="first_name"><?php _e('City', 'pho-pincode-zipcode-cod'); ?></label></th>

							<td><input type="text" class="regular-text" value="<?php echo isset($qry['city'])?$qry['city']:'';?>" id="city" name="city"></td>

						</tr>

						<tr class="user-last-name-wrap">

							<th><label for="last_name"><?php _e('State', 'pho-pincode-zipcode-cod'); ?></label></th>

							<td><input type="text" class="regular-text" value="<?php echo $qry['state'];?>" id="state" name="state"></td>

						</tr>
						
						<tr class="user-nickname-wrap">

							<th><label for="nickname"><?php _e('Delivery by', 'pho-pincode-zipcode-cod'); ?></label></th>
							
							<td><label for="nickname"><input type="radio" <?php if(isset($qry['deliver_by']) && $qry['deliver_by'] == 'day' || !isset($qry['deliver_by'])){ ?>checked="checked"<?php } ?> class="deliver_by" value="day" name="deliver_by"><?php _e('Day(s)', 'pho-pincode-zipcode-cod'); ?></label>

							<label for="nickname"><input type="radio" <?php if(isset($qry['deliver_by']) && $qry['deliver_by'] == 'day_name'){ ?>checked="checked"<?php } ?> class="deliver_by" value="day_name" name="deliver_by"><?php _e('Day name', 'pho-pincode-zipcode-cod'); ?></label>
							<label for="nickname"><input type="radio" <?php if(isset($qry['deliver_by']) && $qry['deliver_by'] == 'time_picker'){ ?>checked="checked"<?php } ?>  class="deliver_by" value="time_picker" name="deliver_by"><?php _e('Hours and minutes', 'pho-pincode-zipcode-cod'); ?></label>
							<label for="nickname"><input type="radio" <?php if(isset($qry['deliver_by']) && $qry['deliver_by'] == 'quantity'){ ?>checked="checked"<?php } ?>  class="deliver_by" value="quantity" name="deliver_by"><?php _e('Quantity', 'pho-pincode-zipcode-cod'); ?></label>
							</td>
							
							

						</tr>
						
						<tr class="user-nickname-wrap day_min"  style="display:<?php if(isset($qry['deliver_by']) && $qry['deliver_by'] != 'day'){  echo "none"; } ?>;">

							<th><label for="nickname"><?php _e('Delivery within day(s)', 'pho-pincode-zipcode-cod'); ?></label></th>

							<td><input type="number" min="0" step="1" max="365" class="regular-text" value="<?php echo isset($qry['dod'])?$qry['dod']:'0';?>" id="dod" name="dod"></td>

						</tr>
						
						<tr class="user-nickname-wrap day_name_min" style="display:<?php if(isset($qry['deliver_by']) && $qry['deliver_by'] != 'day_name'){  echo "none"; } ?>;">

							<th><label for="nickname"><?php _e('Delivery within day name', 'pho-pincode-zipcode-cod'); ?></label></th>

							<td>
							<?php $dod_name = isset($qry['dod_name'])?$qry['dod_name']:''; ?>
							
							<select name="dod_name">
								<option value="monday" <?php if($dod_name=='monday'){ echo "selected" ; } ?>><?php _e('Monday', 'pho-pincode-zipcode-cod'); ?></option>
								<option value="tuesday" <?php if($dod_name=='tuesday'){ echo "selected" ; } ?>><?php _e('Tuesday', 'pho-pincode-zipcode-cod'); ?></option>
								<option value="wednesday" <?php if($dod_name=='wednesday'){ echo "selected" ; } ?>><?php _e('Wednesday', 'pho-pincode-zipcode-cod'); ?></option>
								<option value="thursday" <?php if($dod_name=='thursday'){ echo "selected" ; } ?>><?php _e('Thursday', 'pho-pincode-zipcode-cod'); ?></option>
								<option value="friday" <?php if($dod_name=='friday'){ echo "selected" ; } ?>><?php _e('Friday', 'pho-pincode-zipcode-cod'); ?></option>
								<option value="saturday" <?php if($dod_name=='saturday'){ echo "selected" ; } ?>><?php _e('Saturday', 'pho-pincode-zipcode-cod'); ?></option>
								<option value="sunday" <?php if($dod_name=='sunday'){ echo "selected" ; } ?>><?php _e('Sunday', 'pho-pincode-zipcode-cod'); ?></option>
							
							</select>
							
							
							</td>

						</tr>
						<tr class="user-nickname-wrap time_min"  style="display:<?php if($qry['deliver_by'] != 'time_picker'){  echo "none"; } ?>;">

							<th><label for="nickname"><?php _e('Delivery within hours', 'pho-pincode-zipcode-cod'); ?></label></th>

							<td>
								<input type="number" placeholder="<?php _e('Max 23', 'pho-pincode-zipcode-cod'); ?>" value="<?php echo $qry['time_hrs'];?>"  min="0" max="23" name="time_hrs" />
							</td>

						</tr>
						<tr class="user-nickname-wrap time_min" style="display:<?php if($qry['deliver_by'] != 'time_picker'){  echo "none"; } ?>;">

							<th><label for="nickname"><?php _e('Delivery within minutes', 'pho-pincode-zipcode-cod'); ?></label></th>
							<td>
								<input type="number"  min="0" max="59" placeholder="<?php _e('Max 59', 'pho-pincode-zipcode-cod'); ?>" value="<?php echo $qry['time_minuts'];?>" name="time_minuts" />
							</td>

						</tr>
						
						<tr class="user-nickname-wrap dq" style="display:<?php if($qry['deliver_by'] != 'quantity'){  echo "none"; } ?>;">
						<th><label for="time_minuts"><?php _e('Quantity range', 'pho-pincode-zipcode-cod'); ?></label></th>
							<td class="range_data">
								<table>
									<thead>
										<tr>
											<th class="pncode_range_q" ><?php _e('Delivery quantity(s)', 'custom-options'); ?><span class='phoen-help-tip'></span><span class='phoen_quentity_content' >It shows the number of quantity,equal to or less than which is delivered on the mention delivery day.</span></th>
											<th class="pncode_range_d" ><?php _e('Delivery day(s)', 'custom-options'); ?></th>
										</tr>
									</thead>
									<tbody>
										<?php  
										
										$deliver_day=isset($qry["deliver_day"])?$qry["deliver_day"]:'';
										
										$deliver_quantity=isset($qry["deliver_quantity"])?$qry["deliver_quantity"]:'';
										
										if(!empty($deliver_quantity)){
											
											$deliver_q= explode(",",$deliver_quantity);
											
											$deliver_d= explode(",",$deliver_day);
											
											for($i=0;$i<count($deliver_q);$i++){
												?>
												<tr>
													<td><input class="delevery_quantity" type="number" min="1"  name="delevery_quantity[]" value="<?php echo $deliver_q[$i];?>" placeholder="<?php _e('Quantity(s)', 'woocommerce-product-addons'); ?>" /></td><td><input class="delevery_day" min="1" type="number"  name="delevery_day[]" value="<?php echo $deliver_d[$i];?>" placeholder="<?php _e('Day(s)', 'woocommerce-product-addons'); ?>" /></td>
													<td class="actions" width="1%"><button type="button" class="remove_range button">x</button></td>
												</tr>
												<?php
											}
											
										}else{
											?>
											<tr>
											<td><input class="delevery_quantity" required type="number" min="1"  name="delevery_quantity[]" value="1" placeholder="<?php _e('Quantity(s)', 'woocommerce-product-addons'); ?>" /></td><td><input class="delevery_day" required type="number" min="1"  name="delevery_day[]" value="1" placeholder="<?php _e('Day(s)', 'woocommerce-product-addons'); ?>" /></td>
											<td  class="actions" width="1%"><button type="button" class="remove_range button">x</button></td>
										</tr>
											
											<?php 
										}
											
										?>
									</tbody>
									<tfoot>
										<tr>
											<td colspan="5"><button class="add_qrange button button-primary" type="button">Add Range</button></td>
										</tr>
									</tfoot>
								</table>
							</td>
						</tr>

						<tr class="user-nickname-wrap">

							<th><label for="nickname"><?php _e('Enable cash on delivery for this pincode', 'pho-pincode-zipcode-cod'); ?></label></th>
							
							<td><label for="nickname"><input type="radio" class="cod_val" <?php if($qry['cod'] == 'no' || $qry['cod'] == ''){ ?>checked="checked"<?php } ?> value="no" name="cod"><?php _e('No', 'pho-pincode-zipcode-cod'); ?></label>

							<label for="nickname"><input type="radio" class="cod_val" <?php if($qry['cod'] == 'yes'){ ?>checked="checked"<?php } ?> value="yes" name="cod"><?php _e('Yes', 'pho-pincode-zipcode-cod'); ?></label></td>

						</tr>
						<tr class="user-nickname-wrap cod_min" style="display:<?php if($qry['cod'] != 'yes'){ echo 'none'; } ?>;">

							<th><label for="nickname"><?php _e('COD charge', 'pho-pincode-zipcode-cod'); ?></label></th>

							<td>
								<input type="number"  min="0" value="<?php echo $qry['cod_charge'] ? $qry['cod_charge'] :'0';?>" name="cod_charge" />
							</td>

						</tr>
						<tr class="user-nickname-wrap cod_min" style="display:<?php if($qry['cod'] != 'yes'){ echo 'none'; } ?>;">

							<th><label for="nickname"><?php _e('Enable quantity * COD charge', 'pho-pincode-zipcode-cod'); ?></label></th>

							<td>
								<input type="checkbox"  value="1" name="quantity_into" <?php if($qry['quantity_into'] == 1){ ?>checked="checked"<?php } ?> />
							</td>

						</tr>
						<tr class="user-nickname-wrap">

							<th><label for="nickname"><?php _e('Exclude products on shop page', 'pho-pincode-zipcode-cod'); ?></label></th>

							<td>
								<select id="phoen_product_list" name="all_products[]" multiple>
									<?php
									if(isset($phoen_all_product_list) && is_array($phoen_all_product_list)){
										
											foreach($phoen_all_product_list as $key =>$value){
												
												
												?>
												<option value="<?php echo $key;?>"  <?php if(in_array($key, $list_products_min)){ echo 'selected'; } ?>><?php echo $value;?></option>
												<?php
											}
											
									
											
									}
									?>
								</select>
							</td>

						</tr>

					</tbody>

				</table>

					<p class="submit"><a class="button" href="admin.php?page=list_pincodes"><?php _e('Back', 'pho-pincode-zipcode-cod'); ?></a>&nbsp;&nbsp;<input type="submit" value="Update" class="button button-primary" id="submit" name="submit"></p>

			</form>
				<style>
				.phoen_ex_num {
					display: block;
					font-size: 11px;
					padding: 5px 0 0;
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
							jQuery(".time_min").hide();
							jQuery(".dq").hide();
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
					jQuery(".phoen-help-tip").mouseover(function(){
						jQuery(".phoen_quentity_content").show();
					}); 
					jQuery(".phoen-help-tip").mouseout(function(){
						jQuery(".phoen_quentity_content").hide();
					}); 
					
				});
				</script>
				<?php

			}elseif(isset($_GET['action']) && sanitize_text_field( $_GET['action'] ) == 'product_edit' && isset($id)){
				
				if(isset($_POST['main_summit']) && sanitize_text_field( $_POST['main_summit'] ) == 'Update')
				{
					
					$pincode = isset($_POST['pincode'])?sanitize_text_field( $_POST['pincode'] ):'';

					$city = isset($_POST['city'])?sanitize_text_field( $_POST['city'] ):'';

					$state = isset($_POST['state'])?sanitize_text_field( $_POST['state'] ):'';

					$dod = isset($_POST['dod'])?sanitize_text_field( $_POST['dod'] ):'';
					
					$cod = isset($_POST['cod'])?sanitize_text_field( $_POST['cod'] ):'';
					
					$dod_name = isset($_POST['dod_name'])?sanitize_text_field( $_POST['dod_name'] ):'';
					
					$deliver_by =isset($_POST['deliver_by'])?sanitize_text_field( $_POST['deliver_by'] ):'';
					
					$time_minuts=isset($_POST['time_minuts'])?sanitize_text_field( $_POST['time_minuts'] ):'';
					
					$time_hrs=isset($_POST['time_hrs'])?sanitize_text_field( $_POST['time_hrs'] ):'';
					
					$dquantity_min=isset($_POST['delevery_quantity'])? $_POST['delevery_quantity'] :array();
					
					$dday_min=isset($_POST['delevery_day'])?	$_POST['delevery_day']:array();
										
					$dquantity="";
					
					$dday="";
					
					if(!empty($dquantity_min)){
						
						$dquantity=implode(",",$dquantity_min);
					
						$dday=implode(",",$dday_min);
						
					}
					
					$quantity_into=isset($_POST['quantity_into'])?sanitize_text_field( $_POST['quantity_into'] ):'';
					
					$cod_charge=isset($_POST['cod_charge'])?sanitize_text_field( $_POST['cod_charge'] ):'';
					
					$area=isset($_POST['area'])?sanitize_text_field( $_POST['area'] ):'';
					
					$product_id=isset($_GET['product_id'])?sanitize_text_field( $_GET['product_id'] ):'';
					
					if( $pincode != '' )
					{
						
						$pincode_array[$pincode] = array( $pincode, $city, $state, $dod, $cod ,$dod_name,$deliver_by,$time_hrs,$time_minuts,$cod_charge,$quantity_into,$area,$dquantity,$dday);
						//echo "'$pincode', '$city', '$state', $dod, '$cod'";
						
						?>

							<div class="updated below-h2" id="message"><p><?php _e('Updated Successfully', 'pho-pincode-zipcode-cod'); ?>.</p></div>

						<?php

					}
					else
					{
						?>

							<div class="error below-h2" id="message"><p> <?php _e('Please Fill Valid Data', 'pho-pincode-zipcode-cod'); ?>.</p></div>

						<?php
					}
					
					$updated = get_post_meta( $product_id,'phen_pincode_list' );
					
					$updated = $updated[0];
					
					if($updated[$pincode]!=''){
						
						foreach($updated as $key => $min){
							
							if($pincode==$key){
								$pincode_array[$key] = array( $pincode, $city, $state, $dod, $cod ,$dod_name,$deliver_by,$time_hrs,$time_minuts,$cod_charge,$quantity_into,$area,$dquantity,$dday);
							}else{
								$pincode_array[$key] =$min;
							}
							
						}
						update_post_meta( $product_id,'phen_pincode_list',$pincode_array );
						
					}else{
						
						$updated[$pincode]= array( $pincode, $city, $state, $dod, $cod ,$dod_name,$deliver_by,$time_hrs,$time_minuts,$cod_charge,$quantity_into,$area,$dquantity,$dday);
						
						unset($updated[$id]);
						
						update_post_meta( $product_id,'phen_pincode_list',$updated );
						
					}
					
				}
				
				$records = get_post_meta( $_GET['product_id'],'phen_pincode_list' );
				
				$current_array=isset($records[0][$id])?$records[0][$id]:''; 
				
				$product=wc_get_product($_REQUEST['product_id']);
						
				$product_name=$product->get_name();
				
					?>
					<div id="icon-users" class="icon32"><br/></div>

				<h2	><?php _e('Update Zip Code', 'pho-pincode-zipcode-cod'); ?>- ( <?php echo isset($product_name)?$product_name:''; ?> )<a class="add-new-h2" href="?page=add_pincode&&pro_id=<?php echo isset($_REQUEST['product_id'])?$_REQUEST['product_id']:''; ?>"><?php _e('Add New', 'pho-pincode-zipcode-cod'); ?></a></h2>

					<!-- Forms are NOT created automatically, so you need to wrap the table in one to use features like bulk actions -->

				<form action="" method="post" id="uzip_form" name="uzip_form">

					<table class="form-table">

					<tbody>

						<tr class="user-user-login-wrap">

							<th><label for="user_login"><?php _e('Pincode', 'pho-pincode-zipcode-cod'); ?></label></th>

							<td><input type="text" class="regular-text" value="<?php echo isset($current_array[0])?$current_array[0]:'';?>" id="pincode" name="pincode"></td>

						</tr>
						
						<tr class="user-first-name-wrap">

							<th><label for="area"><?php _e('Area', 'pho-pincode-zipcode-cod'); ?></label></th>

							<td><input type="text" value="<?php echo isset($current_array[11])?$current_array[11]:'';?>" class="regular-text" id="area" name="area"></td>

						</tr>
						
						<tr class="user-first-name-wrap">

							<th><label for="first_name"><?php _e('City', 'pho-pincode-zipcode-cod'); ?></label></th>

							<td><input type="text" class="regular-text" value="<?php echo isset($current_array[1])?$current_array[1]:'';?>" id="city" name="city"></td>

						</tr>

						<tr class="user-last-name-wrap">

							<th><label for="last_name"><?php _e('State', 'pho-pincode-zipcode-cod'); ?></label></th>

							<td><input type="text" class="regular-text" value="<?php echo isset($current_array[2])?$current_array[2]:'';?>" id="state" name="state"></td>

						</tr>
						
						<tr class="user-nickname-wrap">

							<th><label for="nickname"><?php _e('Delivery By', 'pho-pincode-zipcode-cod'); ?></label></th>
							
							<td><label for="nickname"><input type="radio" <?php if($current_array[6] == 'day'){ ?>checked="checked"<?php } ?> class="deliver_by" value="day" name="deliver_by"><?php _e('Day(s)', 'pho-pincode-zipcode-cod'); ?></label>

							<label for="nickname"><input type="radio" <?php if($current_array[6] == 'day_name'){ ?>checked="checked"<?php } ?> class="deliver_by" value="day_name" name="deliver_by"><?php _e('Day name', 'pho-pincode-zipcode-cod'); ?></label>
							<label for="nickname"><input type="radio" <?php if($current_array[6] == 'time_picker'){ ?>checked="checked"<?php } ?>  class="deliver_by" value="time_picker" name="deliver_by"><?php _e('Hours and minutes', 'pho-pincode-zipcode-cod'); ?></label>
							<label for="nickname"><input type="radio" <?php if($current_array[6] == 'quantity'){ ?>checked="checked"<?php } ?>  class="deliver_by" value="quantity" name="deliver_by"><?php _e('Quantity', 'pho-pincode-zipcode-cod'); ?></label>
							</td>

						</tr>
						
						<tr class="user-nickname-wrap day_min"  style="display:<?php if($current_array[6] != 'day'){  echo "none"; } ?>;">

							<th><label for="nickname"><?php _e('Delivery within day(s)', 'pho-pincode-zipcode-cod'); ?></label></th>

							<td><input type="number" min="0" max="365" step="1" class="regular-text" value="<?php echo $current_array[3];?>" id="dod" name="dod"></td>

						</tr>
						
						<tr class="user-nickname-wrap day_name_min" style="display:<?php if($current_array[6] != 'day_name'){  echo "none"; } ?>;">

							<th><label for="nickname"><?php _e('Delivery within day name', 'pho-pincode-zipcode-cod'); ?></label></th>

							<td>
							<?php $dod_name = $current_array[5]; ?>
							
							<select name="dod_name">
								<option value="monday" <?php if($dod_name=='monday'){ echo "selected" ; } ?>><?php _e('Monday', 'pho-pincode-zipcode-cod'); ?></option>
								<option value="tuesday" <?php if($dod_name=='tuesday'){ echo "selected" ; } ?>><?php _e('Tuesday', 'pho-pincode-zipcode-cod'); ?></option>
								<option value="wednesday" <?php if($dod_name=='wednesday'){ echo "selected" ; } ?>><?php _e('Wednesday', 'pho-pincode-zipcode-cod'); ?></option>
								<option value="thursday" <?php if($dod_name=='thursday'){ echo "selected" ; } ?>><?php _e('Thursday', 'pho-pincode-zipcode-cod'); ?></option>
								<option value="friday" <?php if($dod_name=='friday'){ echo "selected" ; } ?>><?php _e('Friday', 'pho-pincode-zipcode-cod'); ?></option>
								<option value="saturday" <?php if($dod_name=='saturday'){ echo "selected" ; } ?>><?php _e('Saturday', 'pho-pincode-zipcode-cod'); ?></option>
								<option value="sunday" <?php if($dod_name=='sunday'){ echo "selected" ; } ?>><?php _e('Sunday', 'pho-pincode-zipcode-cod'); ?></option>
							</select>
							
							
							</td>
							
						</tr>
						<tr class="user-nickname-wrap time_min"  style="display:<?php if(isset($current_array[6]) && $current_array[6] != 'time_picker'){  echo "none"; } ?>;">

							<th><label for="nickname"><?php _e('Delivery within hours', 'pho-pincode-zipcode-cod'); ?></label></th>

							<td>
								<input type="number" placeholder="<?php _e('Max 23', 'pho-pincode-zipcode-cod'); ?>" value="<?php echo isset($current_array[7])?$current_array[7]:'';?>"  min="0" max="23" name="time_hrs" />
							</td>

						</tr>
						<tr class="user-nickname-wrap time_min" style="display:<?php if(isset($current_array[6]) && $current_array[6] != 'time_picker'){  echo "none"; } ?>;">

							<th><label for="nickname"><?php _e('Delivery within minutes', 'pho-pincode-zipcode-cod'); ?></label></th>
							<td>
								<input type="number"  min="0" placeholder="<?php _e('Max 59', 'pho-pincode-zipcode-cod'); ?>" value="<?php echo isset($current_array[8])?$current_array[8]:'';?>" name="time_minuts" />
							</td>

						</tr>
						
						<tr class="user-nickname-wrap dq" style="display:<?php if(isset($current_array[6]) && $current_array[6] != 'quantity'){  echo "none"; } ?>;">
							<th><label for="time_minuts"><?php _e('Quantity range', 'pho-pincode-zipcode-cod'); ?></label></th>
							<td class="range_data">
								<table>
									<thead>
										<tr>
											<th class="pncode_range_q" ><?php _e('Delivery quantity(s)', 'custom-options'); ?><span class='phoen-help-tip'></span><span class='phoen_quentity_content' >It shows the number of quantity,equal to or less than which is delivered on the mention delivery day.</span></th>
											<th class="pncode_range_d" ><?php _e('Delivery day(s)', 'custom-options'); ?></th>
										</tr>
									</thead>
									<tbody>
										<?php  
										
										$deliver_day=isset($current_array[13])?$current_array[13]:'';
										
										$deliver_quantity=isset($current_array[12])?$current_array[12]:'';
										
										if(!empty($deliver_quantity)){
											
											$deliver_q= explode(",",$deliver_quantity);
											
											$deliver_d= explode(",",$deliver_day);
											
											for($i=0;$i<count($deliver_q);$i++){
												?>
												<tr>
													<td><input class="delevery_quantity" type="number" min="1"  name="delevery_quantity[]" value="<?php echo $deliver_q[$i];?>" placeholder="<?php _e('Quantity(s)', 'woocommerce-product-addons'); ?>" /></td><td><input class="delevery_day" min="1" type="number"  name="delevery_day[]" value="<?php echo $deliver_d[$i];?>" placeholder="<?php _e('Day(s)', 'woocommerce-product-addons'); ?>" /></td>
													<td class="actions"><button type="button" class="remove_range button">x</button></td>
												</tr>
												<?php
											}
											
										}else{ ?>
											<tr>
											<td><input class="delevery_quantity" required type="number" min="1"  name="delevery_quantity[]" value="1" placeholder="<?php _e('Quantity(s)', 'woocommerce-product-addons'); ?>" /></td><td><input class="delevery_day" required type="number" min="1"  name="delevery_day[]" value="1" placeholder="<?php _e('Day(s)', 'woocommerce-product-addons'); ?>" /></td>
											<td  class="actions" width="1%"><button type="button" class="remove_range button">x</button></td>
										</tr>
										<?php }
											
										?>
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

							<th><label for="nickname"><?php _e('Enable cash on delivery for this pincode', 'pho-pincode-zipcode-cod'); ?></label></th>
							
							<td><label for="nickname"><input type="radio" class="cod_val" <?php if(isset($current_array[4]) && $current_array[4]== 'no' ){ ?>checked="checked"<?php } ?> value="no" name="cod"><?php _e('No', 'pho-pincode-zipcode-cod'); ?></label>

							<label for="nickname"><input type="radio" class="cod_val" <?php if( isset($current_array[4]) && $current_array[4]== 'yes'){ ?>checked="checked"<?php } ?> value="yes" name="cod"><?php _e('Yes', 'pho-pincode-zipcode-cod'); ?></label></td>

						</tr>
						<tr class="user-nickname-wrap cod_min" style="display:<?php if( isset($current_array[4]) && $current_array[4] != 'yes'){ echo 'none'; } ?>;">

							<th><label for="nickname"><?php _e('COD charge', 'pho-pincode-zipcode-cod'); ?></label></th>

							<td>
								<input type="number"  min="0" value="<?php echo $current_array[9] ? $current_array[9] :'0';?>" name="cod_charge" />
							</td>

						</tr>
						<tr class="user-nickname-wrap cod_min" style="display:<?php if(isset($current_array[4]) && $current_array[4] != 'yes'){ echo 'none'; } ?>;">

							<th><label for="nickname"><?php _e('Enable quantity * COD charge', 'pho-pincode-zipcode-cod'); ?></label></th>

							<td>
								<input type="checkbox"  value="1" name="quantity_into" <?php if(isset($current_array[10]) && $current_array[10] == 1){ ?>checked="checked"<?php } ?> />
							</td>

						</tr>
					</tbody>

				</table>

					<p class="submit"><a class="button" href="admin.php?page=list_pincodes&&product_id=<?php echo isset($_REQUEST['product_id'])?$_REQUEST['product_id']:'';?>"><?php _e('Back', 'pho-pincode-zipcode-cod'); ?></a>&nbsp;&nbsp;<input type="submit" value="Update" class="button button-primary" id="submit" name="main_summit"></p>

				</form>
					<style>
					.phoen_ex_num {
						display: block;
						font-size: 11px;
						padding: 5px 0 0;
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
					</style>
				<script>
				jQuery(document).ready(function(){
					
					jQuery(".phoen-help-tip").mouseover(function(){
						jQuery(".phoen_quentity_content").show();
					}); 
					jQuery(".phoen-help-tip").mouseout(function(){
						jQuery(".phoen_quentity_content").hide();
					}); 
					jQuery("#phoen_product_list").select2();
					jQuery(".deliver_by").change(function(){
						if(jQuery(this).val()=="day"){
							jQuery(".day_min").show();
							jQuery(".day_name_min").hide();
							jQuery(".time_min").hide();
							jQuery(".dq").hide();
						}else if(jQuery(this).val()=="day_name"){
							jQuery(".day_min").hide();
							jQuery(".day_name_min").show();
							jQuery(".time_min").hide();
							jQuery(".dq").hide();
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
					
				});
				</script>
				<?php
			}
			
			else
			{
				
				?>

				<div id="icon-users" class="icon32"><br/></div>

				<!-- Forms are NOT created automatically, so you need to wrap the table in one to use features like bulk actions -->

				<form id="pincodes-filter" method="get">

					<!-- For plugins, we also need to ensure that the form posts back to our current page -->

					<input type="hidden" name="page" value="<?php echo isset($_REQUEST['page'])?$_REQUEST['page']:'' ?>" />

					<input type="hidden" name="product_id" value="<?php echo isset($_REQUEST['product_id'])?$_REQUEST['product_id']:''; ?>" />
					
					<!-- Now we can render the completed list table -->

					<?php $testListTable->display(); ?>

				</form>

				<?php

			}

		?>

    </div>

	<script>

		jQuery('.id-select-all-1').click(function() {

			if (jQuery(this).is(':checked')) {

				jQuery('div input').attr('checked', true);

			} else {

				jQuery('div input').attr('checked', false);

			}

		});
		
		jQuery("body").on("click",".remove_range",function(){
				
			var answer = confirm('<?php _e('Are you sure you want to delete this range?', 'custom-options'); ?>');

			if (answer) {
				
				jQuery(this).closest("tr").remove();
			
			}
			
			return false;
			
			
		});
		jQuery(".phoen-help-tip").mouseover(function(){
			jQuery(this).find(".phoen_tiptip_content").show();
		}); 
		jQuery(".phoen-help-tip").mouseout(function(){
			jQuery(this).find(".phoen_tiptip_content").hide();
			// jQuery(".phoen_tiptip_content").hide();
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

	</script>
	<style>
	td.range_data table tbody tr td {
		width:auto;
	}
	</style>

    <?php

}
function phoen_main_details(){
	
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
	return $phoen_all_product_list;
}

?>