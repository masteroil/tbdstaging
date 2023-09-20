<!-- DC ready -->
<style type="text/css">
body, html{margin:0px; padding:0px; font-family:"Helvetica Neue", Roboto, Arial, "Droid Sans", sans-serif;}
.clearfix::after{ display:block; clear:both; content:""; }

.wfte_invoice-main{ color:#202020; font-size:12px; font-weight:400; box-sizing:border-box; width:100%; padding:30px 10px; background:#fff; height:auto; border:solid 1px #000;margin:10px 0px;}
.wfte_invoice-main *{ box-sizing:border-box;}


.wfte_row{ width:100%; display:block; }
.wfte_col-1{ width:100%; display:block;}
.wfte_col-2{ width:50%; display:block;}
.wfte_col-3{ width:33%; display:block;}
.wfte_col-4{ width:25%; display:block;}
.wfte_col-6{ width:30%; display:block;}
.wfte_col-7{ width:69%; display:block;}

.wfte_padding_left_right{ padding:0px 30px; }
.wfte_hr{ height:1px; font-size:0px; padding:0px; background:#000; margin: 10px 0;}

.wfte_company_logo_img_box{ margin-bottom:10px; }
.wfte_company_logo_img{ width:150px; max-width:100%; }
.wfte_company_name{ font-size:24px; font-weight:bold; }
.wfte_company_logo_extra_details{ font-size:12px; margin-top:3px;}
.wfte_barcode{ margin-top:5px;}
.wfte_invoice_data div span:last-child, .wfte_extra_fields span:last-child{ font-weight:bold; }
.wfte_invoice_number{ color:#000; font-size:18px; font-weight:normal; height:auto; background:#f4f4f4; padding:7px 10px;}
.wfte_invoice_number_label, .wfte_invoice_number_val{ font-weight:bold; font-size:18px; }

.wfte_invoice_data{ line-height:16px; font-size:12px; }
.wfte_shipping_address{ width:95%;}
.wfte_billing_address{ width:95%; }
.wfte_address-field-header{ font-weight:bold; font-size:12px; color:#000; padding:3px; padding-left:0px;}
.wfte_addrss_field_main{ padding-top:15px;}

.wfte_product_table{ width:100%; border-collapse:collapse; margin:0px; }
.wfte_payment_summary_table_body .wfte_right_column{ text-align:left; }
.wfte_payment_summary_table{ margin-bottom:10px; }
.wfte_product_table_head_bg{ background:#f4f4f4; }
.wfte_table_head_color{ color:#2e2e2e; }

.wfte_product_table_head{}
.wfte_product_table_head th{ height:36px; padding:0px 5px; font-size:.75rem; text-align:start; line-height:10px; font-family:"Helvetica Neue", Roboto, Arial, "Droid Sans", sans-serif;}
.wfte_product_table_body td, .wfte_payment_summary_table_body td{ font-size:12px; line-height:16px;}
.wfte_product_table_body td{ padding:7px 5px; border-bottom:solid 1px #dddee0; text-align:start;}
.wfte_product_table .wfte_right_column{ width:20%;}
.wfte_payment_summary_table .wfte_left_column{ width:60%; }
.wfte_product_table_body .product_td b{ font-weight:normal; }

.wfte_payment_summary_table_body td{ padding:5px 5px; border:none;}

.wfte_product_table_payment_total td{ font-size:13px; color:#000; height:28px;}
.wfte_product_table_payment_total td:nth-child(3){ font-weight:bold; }

/* for mPdf */
.wfte_invoice_data{ border:solid 0px #fff; }
.wfte_invoice_data td, .wfte_extra_fields td{ font-size:12px; padding:0px; font-family:"Helvetica Neue", Roboto, Arial, "Droid Sans", sans-serif; line-height:14px;}
.wfte_invoice_data tr td:nth-child(2), .wfte_extra_fields tr td:nth-child(2){ font-weight:bold; }

.wfte_signature{ width:100%; height:auto; min-height:60px; padding:5px 0px;}
.wfte_signature_label{ font-size:12px; }
.wfte_image_signature_box{ display:inline-block;}
.wfte_return_policy{width:100%; height:auto; padding:5px 0px; margin-top:5px; }
.wfte_footer{height:auto; padding:5px 0px; margin-top:5px;}

.wfte_received_seal{ position:absolute; z-index:10; margin-top:0px; margin-left:0px; width:130px; border-radius:5px; font-size:22px; height:40px; line-height:28px; border:solid 5px #00ccc5; color:#00ccc5; font-weight:900; text-align:center; transform:rotate(0deg); opacity:.5; }

.float_left{ float:left; }
.float_right{ float:right; }
.wfte_product_table_category_row td{ padding:10px 5px;}
.wfte_col-1, .wfte_col-2, .wfte_col-3, .wfte_col-4, .wfte_col-5, .wfte_col-6, .wfte_col-7, .wfte_company_logo, .wt_pklist_dc_editable_selected {
    min-height: 35px;
}
.wfte_shipping_address_label,.wfte_shipping_address_val{font-size: 15px;}
</style>
<div class="wfte_rtl_main wfte_invoice-main wfte_main wfte_custom_shipping_size"> 
    <div class="clearfix"></div>
    <div class="wfte_row wfte_padding_left_right clearfix">
        <div class="wfte_col-7 float_left">
            <div class="wfte_company_logo">
                <div class="wfte_company_logo_img_box">
                    <img src="[wfte_company_logo_url]" class="wfte_company_logo_img">
                </div>
                <div class="wfte_company_name wfte_hidden">[wfte_company_name]</div>
            </div>
        </div>
        <div class="wfte_col-6 float_right wfte_text_left">
            <div class="wfte_from_address " data-wfte_name="from_address">
                <div class="wfte_address-field-header wfte_from_address_label">__[From:]__</div>
                <div class="wfte_from_address_val">[wfte_from_address]</div>
            </div>
        </div>
    </div>
    <div class="clearfix"></div>
    <div class="wfte_row wfte_hr clearfix"></div>
    <div class="clearfix"></div>
    <div class="wfte_row wfte_padding_left_right clearfix">
        <div class="wfte_col-6 float_left">
            <div class="wfte_fragile">
                <img src="[wfte_fragile_url]" class="wfte_fragile_img" style="width: auto;">
            </div>
        </div>
        <div class="wfte_col-7 float_left">
            <div class="wfte_shipping_address" data-wfte_name="shipping_address">
                <div class="wfte_address-field-header wfte_shipping_address_label">__[To:]__</div>
                <div class="wfte_shipping_address_val">[wfte_shipping_address]</div>
            </div>
            <div class="wfte_tel wfte_hidden">
                <span class="wfte_tel_label">__[Tel:]__</span>
                <span>[wfte_tel]</span>
            </div>
            <div class="wfte_email wfte_hidden">
                <span class="wfte_email_label">__[Email:]__</span>
                <span>[wfte_email]</span>
            </div>
        </div>
        <div class="wfte_col-3 float_right"></div>
    </div>
    <div class="clearfix"></div>
    <div class="wfte_row wfte_hr clearfix"></div>
    <div class="clearfix"></div>
    <div class="wfte_row wfte_padding_left_right clearfix">
        <div class="wfte_col-2 float_left">
            <div class="wfte_shipping_details wfte_invoice_data " data-wfte_name="invoice_data">
                <div class="wfte_order_number" style="font-weight: bold;">
                    <span class="wfte_order_number_label">__[Order No:]__</span> [wfte_order_number]
                </div>
            </div>
        </div>
        <div class="wfte_col-2 float_left">
            <div class="wfte_barcode " data-wfte_name="barcode">
                <img src="[wfte_barcode_url]" style="">
            </div>
        </div>
    </div>
    <div class="clearfix"></div>
    <div class="wfte_row wfte_hr clearfix"></div>
    <div class="clearfix"></div>
    <div class="wfte_row wfte_padding_left_right clearfix">
        <div class="wfte_col-2 float_left">
            <div class="wfte_shipping_details wfte_invoice_data " data-wfte_name="invoice_data">
                <div class="wfte_package_no wfte_hidden clearfix wfte_text_left">
                    [wfte_package_no]
                </div>
                <div class="wfte_ship_date">
                    <span class="wfte_ship_date_label">__[Ship Date:]__</span> [wfte_ship_date]
                </div>
                <div class="wfte_total_no_of_items wfte_template_element wfte_hidden">
                    <span class="wfte_total_no_of_items_label">__[No of items:]__ </span> 
                    <span class="wfte_total_no_of_items_val">[wfte_total_no_of_items]</span>
                </div>
            </div>
        </div>
        <div class="wfte_col-2 float_left">
            <div class="wfte_tracking_number clearfix">
                <span class="wfte_tracking_number_label">__[Tracking number:]__</span>
                <span>[wfte_tracking_number]</span>
            </div>
            <div class="wfte_shipping_details wfte_invoice_data " data-wfte_name="invoice_data">
                <div class="wfte_weight">
                    <span class="wfte_weight_label">__[Weight:]__</span> [wfte_weight]
                </div>
                <div class="wfte_box_name">
                    [wfte_box_name]
                </div>
                <div class="wfte_order_item_meta">[wfte_order_item_meta]</div>
                [wfte_extra_fields]
                [wfte_additional_data]
            </div>
        </div>
    </div>
    <div class="clearfix"></div>
    <div class="wfte_row wfte_return_policy wfte_padding_left_right clearfix wfte_hidden" style="margin-top:10px;">
        <div class="wfte_col-1 float_right">
            <div class="wfte_return_policy wfte_text_left clearfix wfte_hidden" data-wfte_name="return_policy">
            [wfte_return_policy]
            </div>
        </div>
    </div>
    <div class="clearfix"></div>
    <div class="wfte_row wfte_padding_left_right wfte_footer clearfix wfte_hidden" style="margin-top:10px;">
        <div class="wfte_col-1 float_right">
            <div class="wfte_footer wfte_text_left clearfix wfte_hidden" data-wfte_name="footer">
            [wfte_footer]
            </div>
        </div>
    </div>
    <div class="clearfix"></div>
</div>