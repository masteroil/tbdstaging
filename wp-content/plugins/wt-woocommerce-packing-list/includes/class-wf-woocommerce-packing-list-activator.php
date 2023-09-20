<?php

/**
 * Fired during plugin activation
 *
 * @link       https://www.webtoffee.com/
 * @since      4.0.0
 *
 * @package    Wf_Woocommerce_Packing_List
 * @subpackage Wf_Woocommerce_Packing_List/includes
 */

/**
 * Fired during plugin activation.
 *
 * This class defines all code necessary to run during the plugin's activation.
 *
 * @since      4.0.0
 * @package    Wf_Woocommerce_Packing_List
 * @subpackage Wf_Woocommerce_Packing_List/includes
 * @author     WebToffee <info@webtoffee.com>
 */
class Wf_Woocommerce_Packing_List_Activator {

	/**
	 * 	Plugin activation hook
	 *
	 * 	@since   4.0.0
	 *	@since 	 4.0.6 Added option to secure directory with htaccess	
	 *	@since 	 4.1.1 Added option to update Store address from Woo
	 */
	public static function activate() 
	{ 
	    global $wpdb;
	    require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );       
        if(is_multisite()) 
        {	
        	if(is_network_admin()){
                $blog_ids = $wpdb->get_col( "SELECT blog_id FROM $wpdb->blogs" );
                foreach($blog_ids as $blog_id ) 
                {   
                    self::install_tables_multi_site($blog_id);
                }
            }else{
                $current_blog_id = get_current_blog_id();
                self::install_tables_multi_site($current_blog_id);
            }
        }
        else 
        {
            self::install_tables();
            self::copy_address_from_woo();
            self::save_plugin_version();
        }

        self::secure_upload_dir();
	}

	public static function install_tables_multi_site($blog_id){
        switch_to_blog( $blog_id );
        self::install_tables();
        self::copy_address_from_woo();
        self::save_plugin_version();
        restore_current_blog();
    }
    
	/**
	*	@since 4.1.1
	*	Update store address from Woo	
	*/
	public static function copy_address_from_woo()
	{
		if(class_exists('Wf_Woocommerce_Packing_List'))
		{
			/* all fields are empty. */
			if((Wf_Woocommerce_Packing_List::get_option('woocommerce_wf_packinglist_sender_address_line1')=='' && 
	        	Wf_Woocommerce_Packing_List::get_option('woocommerce_wf_packinglist_sender_address_line2') == '' && 
	        	Wf_Woocommerce_Packing_List::get_option('woocommerce_wf_packinglist_sender_city') == '' && 
	        	Wf_Woocommerce_Packing_List::get_option('wf_country') == '' && 
	        	Wf_Woocommerce_Packing_List::get_option('woocommerce_wf_packinglist_sender_postalcode') == '' &&
	        	Wf_Woocommerce_Packing_List::get_option('woocommerce_wf_packinglist_logo') == '' &&
	        	Wf_Woocommerce_Packing_List::get_option('woocommerce_wf_packinglist_companyname') == '' &&
	        	Wf_Woocommerce_Packing_List::get_option('woocommerce_wf_packinglist_sender_name') == ''
	        )) 
	        {
	        	Wf_Woocommerce_Packing_List::update_option('woocommerce_wf_packinglist_sender_address_line1', get_option('woocommerce_store_address'));
	        	Wf_Woocommerce_Packing_List::update_option('woocommerce_wf_packinglist_sender_address_line2', get_option('woocommerce_store_address_2'));
	        	Wf_Woocommerce_Packing_List::update_option('woocommerce_wf_packinglist_sender_city', get_option('woocommerce_store_city'));
	        	Wf_Woocommerce_Packing_List::update_option('wf_country', get_option('woocommerce_default_country'));
	        	Wf_Woocommerce_Packing_List::update_option('woocommerce_wf_packinglist_sender_postalcode', get_option('woocommerce_store_postcode'));
	        	Wf_Woocommerce_Packing_List::update_option('woocommerce_wf_packinglist_companyname', get_option('blogname') ? get_option('blogname') : "");
	        	Wf_Woocommerce_Packing_List::update_option('woocommerce_wf_packinglist_sender_name', get_option('blogname') ? get_option('blogname') : "");
	        	if ( has_custom_logo() ) {
					$custom_logo_id = get_theme_mod( 'custom_logo' );
					$invoice_logo = wp_get_attachment_image_src( $custom_logo_id , 'full' );
				    Wf_Woocommerce_Packing_List::update_option('woocommerce_wf_packinglist_logo', esc_url( $invoice_logo[0] ));
				}
			}
		}
	}

	/**
	*	@since 4.0.6
	*	Secure directory with htaccess	
	*/
	public static function secure_upload_dir()
	{
		$upload_dir=Wf_Woocommerce_Packing_List::get_temp_dir('path');

        if(!is_dir($upload_dir))
        {
            @mkdir($upload_dir, 0700);
        }

        $files_to_create=array('.htaccess' => 'deny from all', 'index.php'=>'<?php // Silence is golden');
        foreach($files_to_create as $file=>$file_content)
        {
        	if(!file_exists($upload_dir.'/'.$file))
	        {
	            $fh=@fopen($upload_dir.'/'.$file, "w");
	            if(is_resource($fh))
	            {
	                fwrite($fh,$file_content);
	                fclose($fh);
	            }
	        }
        }    
	}

	public static function install_tables()
	{
		global $wpdb;
		
		//install necessary tables

		//creating table for saving template data================
        $search_query = "SHOW TABLES LIKE %s";
        $charset_collate = $wpdb->get_charset_collate();
        $tb=Wf_Woocommerce_Packing_List::$template_data_tb;
        $like = '%' . $wpdb->prefix.$tb.'%';
        $table_name = $wpdb->prefix.$tb;


        if(!$wpdb->get_results($wpdb->prepare($search_query, $like), ARRAY_N)) 
        {
            $sql_settings = "CREATE TABLE IF NOT EXISTS `$table_name` (
			  `id_wfpklist_template_data` int(11) NOT NULL AUTO_INCREMENT,
			  `template_name` varchar(200) NOT NULL,
			  `template_html` text NOT NULL,
			  `template_from` varchar(200) NOT NULL,
			  `is_dc_compatible` int(11) NOT NULL DEFAULT '0',
			  `is_active` int(11) NOT NULL DEFAULT '0',
			  `template_type` varchar(200) NOT NULL,
			  `created_at` int(11) NOT NULL DEFAULT '0',
			  `updated_at` int(11) NOT NULL DEFAULT '0',
			  PRIMARY KEY(`id_wfpklist_template_data`)
			) DEFAULT CHARSET=utf8;";
            dbDelta($sql_settings);

        }else
        {
	        $search_query = "SHOW COLUMNS FROM `$table_name` LIKE 'is_dc_compatible'";
	        if(!$wpdb->get_results($search_query,ARRAY_N)) 
	        {
	        	$wpdb->query("ALTER TABLE `$table_name` ADD `is_dc_compatible` int(11) NOT NULL DEFAULT '0' AFTER `template_from`");
	        }
        }
        //creating table for saving template data================
        
	}

	public static function save_plugin_version(){
        if(get_option('wfpklist_pro_version_prev') === false){
            $prev_version = "none";
        }else{
            $prev_version = get_option('wfpklist_pro_version_prev','none');
        }
        update_option('wfpklist_pro_version_prev',$prev_version);
        update_option('wfpklist_pro_version',WF_PKLIST_VERSION);

        if(get_option('wt_pklist_pro_installation_date') === false){
            if(get_option('wt_pklist_start_date')){
                $install_date = get_option('wt_pklist_start_date',time());
            }elseif(get_option('wt_pklist_pro_start_date')){
                $install_date = get_option('wt_pklist_pro_start_date',time());
            }else{
            	$install_date = time();
            }
            update_option('wt_pklist_pro_installation_date',$install_date);
        }
    }

}
