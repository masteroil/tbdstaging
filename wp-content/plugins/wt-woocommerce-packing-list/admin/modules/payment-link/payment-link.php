<?php
/**
 * Template for payment links
 *
 * @link       
 * @since 4.0.0     
 *
 * @package  Wf_Woocommerce_Packing_List  
 */
if (!defined('ABSPATH')) {
    exit;
}
class Wf_Woocommerce_Packing_List_Payment_Link
{
    public $module_base='payment-link';
    public static $module_id_static='';
    private $to_module='';
    private $to_module_id='';
    private static $to_module_title='';

    public function __construct()
    {
        $this->module_id=Wf_Woocommerce_Packing_List::get_module_id($this->module_base);
        self::$module_id_static=$this->module_id;

        add_action('wf_pklist_intl_after_setting_update', array($this, 'after_setting_update'), 10, 2);
    }

    /**
     *  @since 4.2.1
     *  Initializing Payment Link under module settings page hook
     */
    public function init($base, $title)
    {
        $this->to_module = $base;
        $this->to_module_id = Wf_Woocommerce_Packing_List::get_module_id($base);
        self::$to_module_title = $title;

        add_filter('wt_pklist_module_settings_tabhead',array( __CLASS__,'settings_tabhead'));
        add_action('wt_pklist_module_out_settings_form',array($this,'out_settings_form'));
        add_filter('wt_pklist_intl_alter_multi_select_fields', array($this,'alter_multi_select_fields'), 10, 2);
       // add_filter('wt_pklist_intl_alter_payment_link_field',array($this,'alter_payment_post_values'),10,2);
    }

    public function after_setting_update($the_options, $module_id){
       if(isset($_POST['woocommerce_wf_payment_link_in_order_status_hidden'])){
            if(!isset($_POST['woocommerce_wf_enable_payment_link_in_invoice'])){
                Wf_Woocommerce_Packing_List::update_option('woocommerce_wf_enable_payment_link_in_invoice',0,$module_id);
            }

            if(!isset($_POST['woocommerce_wf_show_pay_later_in_checkout'])){
                Wf_Woocommerce_Packing_List::update_option('woocommerce_wf_show_pay_later_in_checkout',0,$module_id);
            }

            if(!isset($_POST['woocommerce_wf_payment_link_in_order_status'])){
                Wf_Woocommerce_Packing_List::update_option('woocommerce_wf_payment_link_in_order_status',array(),$module_id);
            }
            Wf_Woocommerce_Packing_List_Invoice::save_paylater_settings();
       }
    }
    public function alter_multi_select_fields($arr, $base_id)
    {
        if($base_id==$this->module_id)
        {
            $arr=array(
                'woocommerce_wf_payment_link_in_order_status' => array(),
            );
        }
        return $arr;
    }

    /**
     *  @since 4.0.4
     *  Tab head for module settings page
     **/
    public static function settings_tabhead($arr)
    {
        if((class_exists('Wf_Woocommerce_Packing_List_Pay_Later_Payment')) && (class_exists('WC_Payment_Gateway'))){
            $added=0;
            $out_arr=array();
            $menu_pos_key='general';
            $tab_title=sprintf(__('%s', 'wf-woocommerce-packing-list'), self::$to_module_title);
            foreach($arr as $k=>$v)
            {
                $out_arr[$k]=$v;
                if($k==$menu_pos_key && $added==0)
                {               
                    $out_arr[self::$module_id_static]=$tab_title;
                    $added=1;
                }
            }
            if($added==0){
                $out_arr[self::$module_id_static]=$tab_title;
            }
            return $out_arr;
        }else{
            return $arr;
        }
    }

    /**
     * Add seqential number tab
     * @since 4.0.4
     **/
    public function out_settings_form($args)
    {   
        if((class_exists('Wf_Woocommerce_Packing_List_Pay_Later_Payment')) && (class_exists('WC_Payment_Gateway'))){
            wp_enqueue_script($this->module_id,plugin_dir_url( __FILE__ ).'assets/js/payment_link.js',array('jquery'),WF_PKLIST_VERSION);  
            $view_file=plugin_dir_path( __FILE__ ).'views/payment-link.php';
            $params=array(
                'to_module'=>$this->to_module,
                'to_module_id'=>$this->to_module_id,
                'to_module_title'=>self::$to_module_title,
            );
            Wf_Woocommerce_Packing_List_Admin::envelope_settings_tabcontent($this->module_id,$view_file,'',$params,0);
        }
    }

    /**
    *   @since 4.0.5            
    *   Declaring validation rule for form fields in settings form
    *
    */
    public static function get_validation_rule()
    {
        return array(
            'woocommerce_wf_payment_link_in_order_status'   => array('type' =>  'text_arr'),
            'woocommerce_wf_pay_later_description'          => array('type' =>  'textarea'),
            'woocommerce_wf_pay_later_instuction'           => array('type' =>  'textarea'),
        );
    }

    /**
    *   @since 4.0.4            
    *   Retriving default values for sequential number tab
    *
    */
    public static function get_payment_link_default_settings()
    {
        return array(
            'woocommerce_wf_enable_payment_link_in_invoice' =>  0,
            'woocommerce_wf_show_pay_later_in_checkout'     =>  0,
            'woocommerce_wf_payment_link_in_order_status'   =>  array(),
            'woocommerce_wf_pay_later_title'                =>  __('Pay Later','wt-woocommerce-packing-list'),
            'woocommerce_wf_pay_later_description'          =>  '',
            'woocommerce_wf_pay_later_instuction'           =>  '',
        );
    }
}