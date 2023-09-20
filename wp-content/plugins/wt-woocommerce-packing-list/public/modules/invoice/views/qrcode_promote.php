<?php
if (!defined('ABSPATH')) {
    exit;
}
$wf_admin_img_path=WF_PKLIST_PLUGIN_URL . 'admin/images';
?>
<style type="text/css">
    .qrcode_promotion_content,.qrcode_promotion_img{width: 50%;padding: 0 0 1em 0;}
    .qrcode_promotion_content{line-height: 15px;font-style: normal;font-weight: 500;font-size: 14px;position: relative;padding-left: 1.5em;}
    .qrcode_promotion_img img{width: 100%;}
    #qrcode_pre_placeholders{columns: 3;}
    .qr_code_features_list > li{font-style: normal;font-weight: 500;font-size: 14px;line-height: 25px;list-style: none;position: relative;padding-left: 49px;margin: 0 0 15px 0;}
    .qr_code_features_list > li:before{content: '';position: absolute;height: 18px;width: 18px;background-image: url(<?php echo esc_url($wf_admin_img_path.'/point_out.png'); ?>);background-size: contain;background-repeat: no-repeat;background-position: center;left: 10px;margin-top: 6px;}
    .qr_code_features_list{width: 80%;}
    .qr_code_for,#qrcode_pre_placeholders{margin-left: 1em;}
    .qr_code_for > li{list-style: disc;}
    #qrcode_pre_placeholders > li{list-style: disc;}
    #qrcode_pre_placeholders{margin-top: 5px;}
    .buy_qrcode_btn{background: linear-gradient(90.67deg, #2608DF -34.86%, #3284FF 115.74%);box-shadow: 0px 4px 13px rgb(46 80 242 / 39%);border-radius: 5px;padding: 10px 35px 10px 35px;display: inline-block;font-style: normal;font-weight: bold;font-size: 14px;line-height: 18px;color: #FFFFFF;text-decoration: none;transition: all .2s ease;border: none;margin-left: 10px;margin-top: 10px;}
    .buy_qrcode_btn:hover{box-shadow: 0px 4px 13px rgb(46 80 242 / 50%);text-decoration: none;transform: translateY(2px);transition: all .2s ease;color: #FFFFFF;}
</style>
<div class="wf-tab-content" data-id="<?php echo $target_id;?>">
    <div style="display:flex;">
        <div class="qrcode_promotion_content">
            <h3 style="font-size:1.7em;">QR Code Addon for WooCommerce PDF Invoices</h3>
            <p style="font-size: 14px;"><?php _e('To help you comply with invoice mandates that require QR Codes','wf-woocommerce-packing-list'); ?></p>
            <ul class="qr_code_features_list">
                <li><?php _e('Assign QR code to all of invoices generated for the orders in your store','wf-woocommerce-packing-list'); ?></li>
                <li><?php _e('Assign different types of info in your QR code, including:','wf-woocommerce-packing-list'); ?>
                    <ul class="qr_code_for">
                        <li><?php _e('Order number (default)', 'wf-woocommerce-packing-list'); ?></li>
                        <li><?php _e('Invoice number','wf-woocommerce-packing-list'); ?></li>
                        <li>
                            <?php _e('Custom details, as below:','wf-woocommerce-packing-list'); ?>
                            <ul id="qrcode_pre_placeholders">
                                <li><?php _e('Invoice number','wf-woocommerce-packing-list'); ?></li>
                                <li><?php _e('Order number','wf-woocommerce-packing-list'); ?></li>
                                <li><?php _e('Invoice date','wf-woocommerce-packing-list'); ?></li>
                                <li><?php _e('Order date','wf-woocommerce-packing-list'); ?></li>
                                <li><?php _e('Seller tax ID','wf-woocommerce-packing-list'); ?></li>
                                <li><?php _e('Buyer name','wf-woocommerce-packing-list'); ?></li>
                                <li><?php _e('Seller name','wf-woocommerce-packing-list'); ?></li>
                                <li><?php _e('Invoice total','wf-woocommerce-packing-list'); ?></li>
                                <li><?php _e('Invoice total tax','wf-woocommerce-packing-list'); ?></li>
                            </ul>
                        </li>
                    </ul>
                </li>
                <li><?php _e('Compatible with WooCommerce PDF Invoice, Packing Slips, Delivery Notes, and Shipping Label (Free and Pro versions)','wf-woocommerce-packing-list'); ?></li>
            </ul>
            <a href="https://www.webtoffee.com/product/qr-code-addon-for-woocommerce-pdf-invoices/?utm_source=pro_plugin_cta&utm_medium=PDF_invoice_pro&utm_campaign=QR_Code_Addon&utm_content=<?php echo WF_PKLIST_VERSION; ?>" class="buy_qrcode_btn" target="_blank"><?php echo __('Get Plugin','wf-woocommerce-packing-list'); ?></a>
        </div>
        <div class="qrcode_promotion_img">
            <img src="<?php echo $wf_admin_img_path; ?>/qrcode_promotion_img.png">
        </div>
    </div>
        
</div>