<?php
if ( ! defined( 'WPINC' ) ) {
    die;
}
/**
 * Provide a admin area view for the plugin
 *
 * This file is used to markup the admin-facing aspects of the plugin.
 *
 * @link       https://www.webtoffee.com/
 * @since      4.0.0
 *
 * @package    Wf_Woocommerce_Packing_List
 * @subpackage Wf_Woocommerce_Packing_List/admin/partials
 */

$wf_admin_view_path=plugin_dir_path(WF_PKLIST_PLUGIN_FILENAME).'admin/views/';
?>
<style type="text/css">
    .wf_settings_left{
        width: 73%;
        float: left;
        margin-bottom: 25px;
    }

    .wf_settings_right {
        width: 27%;
        box-sizing: border-box;
        float: left;
        padding-left: 25px;
    }
    .wt-pdfpro-doc_links{
        background: #FFFFFF;
        border-radius: 7px;
        padding: 0;
        margin-bottom: 1em;
        margin-top: 20px;
        display: block;
    }
    .wt-pdfpro-doc_links ul{
        padding: 10px 10px 10px 20px;
    }
    .wt-pdfpro-doc_links ul li{
        font-style: normal;
        font-weight: 500;
        font-size: 13px;
        line-height: 17px;
        /*color: #001A69;*/
        list-style: none;
        position: relative;
        margin: 0 0 15px 0;
        /* display: flex; */
        align-items: center;
    }
    .wt-pdfpro-doc_links ul li a{
        text-decoration: none;
        /*color: #001A69;*/
    }
</style>
<div class="wrap" style="">
    <h2 class="wp-heading-inline">
    <?php _e('Settings','wf-woocommerce-packing-list');?>: 
    <?php _e('WooCommerce PDF Invoices, Packing Slips, Delivery Notes & Shipping Labels','wf-woocommerce-packing-list');?>
    </h2>
    <div class="wf_settings_left">
        <div class="nav-tab-wrapper wp-clearfix wf-tab-head">
            <?php
            $tab_head_arr=array(
                'wf-documents'=>__('Documents','wf-woocommerce-packing-list'),
                'wf-general'=>__('General','wf-woocommerce-packing-list'),            
                'wf-advanced'=>__('Advanced','wf-woocommerce-packing-list'),
                'wf-help'=>__('Help Guide','wf-woocommerce-packing-list')
            );
            if(isset($_GET['debug']))
            {
                $tab_head_arr['wf-debug']='Debug';
            }
            Wf_Woocommerce_Packing_List::generate_settings_tabhead($tab_head_arr);
            ?>
        </div>
        <div class="wf-tab-container">
            <?php
            //inside the settings form
            $setting_views_a=array(
                'wf-general'=>'admin-settings-general.php',                                     
                'wf-advanced'=>'admin-settings-advanced.php',          
            );

            //outside the settings form
            $setting_views_b=array(   
                'wf-documents'=>'admin-settings-documents.php',           
                'wf-help'=>'admin-settings-help.php',           
            );
            if(isset($_GET['debug']))
            {
                $setting_views_b['wf-debug']='admin-settings-debug.php';
            }
            ?>
            <form method="post" class="wf_settings_form">
                <input type="hidden" value="main" class="wf_settings_base" />
                <?php
                
                // Set nonce:
                if (function_exists('wp_nonce_field'))
                {
                    wp_nonce_field(WF_PKLIST_PLUGIN_NAME);
                }
                foreach ($setting_views_a as $target_id=>$value) 
                {
                    $settings_view=$wf_admin_view_path.$value;
                    if(file_exists($settings_view))
                    {
                        include $settings_view;
                    }
                }

                //settings form fields for module
                do_action('wf_pklist_plugin_settings_form');
                ?>           
            </form>
            <?php
            foreach ($setting_views_b as $target_id=>$value) 
            {
                $settings_view=$wf_admin_view_path.$value;
                if(file_exists($settings_view))
                {
                    include $settings_view;
                }
            }
            ?>
            <?php do_action('wt_pklist_plugin_out_settings_form');?> 
        </div>
    </div>
    <div class="wf_settings_right">
        <div class="wt-pdfpro-doc_links">
            <div style="background: linear-gradient(87.57deg, #F4F1FF 3%, rgba(238, 240, 255, 0) 93.18%);border-radius: 3px;margin: 0;text-align: center;padding: 1px;">
                <h3><?php echo __("Help links","wf-woocommerce-packing-list"); ?></h3>
            </div>
            <ul>
                <li><a href="https://www.webtoffee.com/generate-woocommerce-pdf-invoices-packing-slips/" target="_blank"><span class="dashicons dashicons-media-default"></span> <?php echo __("Set up invoice","wf-woocommerce-packing-list"); ?></a></li>
                <li><a href="https://www.webtoffee.com/generate-woocommerce-packing-slip/" target="_blank"><span class="dashicons dashicons-media-default"></span> <?php echo __("Set up packing slip","wf-woocommerce-packing-list"); ?></a></li>
                <li><a href="https://www.webtoffee.com/how-to-set-box-packing-in-woocommerce/" target="_blank"><span class="dashicons dashicons-media-default"></span> <?php echo __("Set up box packing","wf-woocommerce-packing-list"); ?></a></li>
                <li><a href="https://www.webtoffee.com/generate-woocommerce-delivery-notes/" target="_blank"><span class="dashicons dashicons-media-default"></span> <?php echo __("Set up delivery note","wf-woocommerce-packing-list"); ?></a></li>
                <li><a href="https://www.webtoffee.com/generate-woocommerce-shipping-labels/" target="_blank"><span class="dashicons dashicons-media-default"></span> <?php echo __("Set up shipping label","wf-woocommerce-packing-list"); ?></a></li>
                <li><a href="https://www.webtoffee.com/how-to-generate-woocommerce-dispatch-label/" target="_blank"><span class="dashicons dashicons-media-default"></span> <?php echo __("Set up dispatch label","wf-woocommerce-packing-list"); ?></a></li>
                <li><a href="https://www.webtoffee.com/how-to-generate-woocommerce-address-label/" target="_blank"><span class="dashicons dashicons-media-default"></span> <?php echo __("Set up address label","wf-woocommerce-packing-list"); ?></a></li>
                <li><a href="https://www.webtoffee.com/how-to-generate-woocommerce-pick-list/" target="_blank"><span class="dashicons dashicons-media-default"></span> <?php echo __("Set up picklist","wf-woocommerce-packing-list"); ?></a></li>
                <li><a href="https://www.webtoffee.com/how-to-generate-woocommerce-proforma-invoice/" target="_blank"><span class="dashicons dashicons-media-default"></span> <?php echo __("Set up proforma invoice","wf-woocommerce-packing-list"); ?></a></li>
                <li><a href="https://www.webtoffee.com/how-to-generate-woocommerce-credit-note/" target="_blank"><span class="dashicons dashicons-media-default"></span> <?php echo __("Set up credit note","wf-woocommerce-packing-list"); ?></a></li>
                <li><a href="https://www.webtoffee.com/translate-woocommerce-pdf-invoices-with-wpml/" target="_blank"><span class="dashicons dashicons-media-default"></span> <?php echo __("Translate with WPML","wf-woocommerce-packing-list"); ?></a></li>
                <li><a href="https://www.webtoffee.com/pdf-invoice-plugin-third-party-compatibility/" target="_blank"><span class="dashicons dashicons-media-default"></span> <?php echo __("Third-Party compatability","wf-woocommerce-packing-list"); ?></a></li>
                <li><a href="https://www.webtoffee.com/faq-woocommerce-pdf-invoice-packing-slip/" target="_blank"><span class="dashicons dashicons-media-default"></span> <?php echo __("FAQs","wf-woocommerce-packing-list"); ?></a></li>
            </ul>
        </div>
    </div>
</div>