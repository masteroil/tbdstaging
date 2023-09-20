<?php
function phoe_pincode_check()
{

	global $table_prefix, $wpdb, $woocommerce, $product;

	ob_start();

	$product_id = is_object($product) ? $product->get_id() : '';

	$pro_id = is_object($product) ? $product->get_id() : '';

	$customer = new WC_Customer();

	$textascheck = get_option('textascheck');

	$checkpintext = get_option('checkpintext');

	$blog_title = site_url();

	$del_label = get_option('woo_pin_check_del_label');

	$cod_label = get_option('woo_pin_check_cod_label');

	$show_s_on_pro = get_option('woo_pin_check_show_s_on_pro');

	$show_c_on_pro = get_option('woo_pin_check_show_c_on_pro');

	$show_d_d_on_pro = get_option('woo_pin_check_show_d_d_on_pro');

	$valpp = get_option('val_product_page');

	$show_d_est = get_option('show_deli_est');

	$show_cod_a = get_option('show_cod_a');

	$state_based_pincode = get_option('state_based_pincode');

	$checkpin_text = get_option('woo_pin_check_checkpin_text');

	$area_wise_delivery = get_option('area_wise_delivery');

	$pincode_length = get_option('pincode_length');

	$availableat_text = get_option('availableat_text');

	$avail_at = !empty($availableat_text) ? $availableat_text : __('Available at', 'pho-pincode-zipcode-cod');
	?>
<script>
var usejs = 1;
</script>

<?php

	$plugin_dir_url = plugin_dir_url(__FILE__);

	$ship_pin = $customer->get_shipping_postcode();

	$cookie_pin = isset($_COOKIE['valid_pincode']) ? $_COOKIE['valid_pincode'] : '';

	$valid_state = isset($_COOKIE['valid_state']) ? $_COOKIE['valid_state'] : '';

	if (isset($_COOKIE['valid_pincode'])) {

		$cookie_pin = $_COOKIE['valid_pincode'];

		$valid_state = isset($_COOKIE['valid_state']) ? $_COOKIE['valid_state'] : '';

		$star_pincode = substr($cookie_pin, 0, 3) . '*';

	}

	$qry22 = $wpdb->get_results("SELECT * FROM `" . $table_prefix . "pincode_setting_pro` ORDER BY `id` ASC  limit 1", ARRAY_A);

	$table_pin_codes = $table_prefix . "check_pincode_pro";

	$ppook = "SELECT state FROM `$table_pin_codes`";

	$ftc_ary = $wpdb->get_results($ppook);

	$state_list1 = array();
	$state_list2 = array();

	if (isset($ftc_ary) && is_array($ftc_ary)) {
		foreach ($ftc_ary as $key => $value) {
			$state_list1[] = $value->state;
		}
	} else {
		$state_list1 = array();
	}




	$phen_pincodes_list = get_post_meta($pro_id, 'phen_pincode_list', true);



	if (isset($phen_pincodes_list) && is_array($phen_pincodes_list)) {

		foreach ($phen_pincodes_list as $ky => $knum) {

			$state_list2[] = $knum[2];

		}
	} else {
		$state_list2 = array();
	}

	$result = array();

	if ((isset($state_list1) && !empty($state_list1)) || (isset($state_list2) && !empty($state_list2))) {

		$result = array_merge($state_list1, $state_list2);

	}


	if (isset($result) && is_array($result)) {

		$ftc_ary_unique = array_unique($result);

	}

	$phen_pincodes_list = get_post_meta($pro_id, 'phen_pincode_list', true);

	$phen_pincodes_list_1 = get_post_meta($pro_id, 'phen_pincode_list');

	$phen_pincodes_min = get_post_meta($pro_id, 'phen_pincode_list');

	if (isset($cookie_pin) && $cookie_pin != '') {

		if ((isset($phen_pincodes_list_1[0]) && is_array($phen_pincodes_list_1[0]) && count($phen_pincodes_list_1[0]) == 0) || (isset($phen_pincodes_list_1) && is_array($phen_pincodes_list_1) && count($phen_pincodes_list_1) == 0)) {

			if (!isset($cookie_pin) && $ship_pin != '') {

				$cookie_pin = $ship_pin;
			}

			$num_rows = $wpdb->get_var($wpdb->prepare("SELECT COUNT(*) FROM `" . $table_prefix . "check_pincode_pro` where `pincode` = %s", $cookie_pin));

			$like = false;


			if ($num_rows == 0) {

				$pincode = substr($cookie_pin, 0, 3);

				$num_rows = $wpdb->get_var($wpdb->prepare("select COUNT(*) from `" . $table_prefix . "check_pincode_pro` where `pincode` LIKE %s ", $wpdb->esc_like($pincode) . '*%'));

				$like = true;

				//echo 'count1:'.$count;

			}

			if ($num_rows == 0) {

				$cookie_pin = '';

			}

			if ($like) {

				$pincode = substr($cookie_pin, 0, 3);

				$query = " SELECT * FROM `" . $table_prefix . "check_pincode_pro` where `pincode` LIKE '" . $wpdb->esc_like($pincode) . "*%'";

			} else {

				$query = " SELECT * FROM `" . $table_prefix . "check_pincode_pro` where `pincode` = '$cookie_pin' ";

			}

			$getdata = $wpdb->get_results($query);



			foreach ($getdata as $data) {

				$dod = $data->dod;

				$dod_name = $data->dod_name;

				$cod = $data->cod;

				$state = $data->state;

				$city = $data->city;

				$deliver_by = $data->deliver_by;

				$time_hrs = $data->time_hrs;

				$time_minuts = $data->time_minuts;

			}

		} else {

			$phen_pincode_list = $phen_pincodes_list;

			if (isset($cookie_pin) && is_array($phen_pincode_list) && array_key_exists($wpdb->esc_like($cookie_pin), $phen_pincode_list)) {
				$safe_zipcode = $cookie_pin;

				$dod = $phen_pincode_list[$safe_zipcode][3];

				$dod_name = $phen_pincode_list[$safe_zipcode][5];

				$state = $phen_pincode_list[$safe_zipcode][2];

				$city = $phen_pincode_list[$safe_zipcode][1];

				$cod = $phen_pincode_list[$safe_zipcode][4];

				$deliver_by = $phen_pincode_list[$safe_zipcode][6];

				$time_hrs = $phen_pincode_list[$safe_zipcode][7];

				$time_minuts = $phen_pincode_list[$safe_zipcode][8];

			} elseif (isset($star_pincode) && is_array($phen_pincode_list) && array_key_exists($star_pincode, $phen_pincode_list)) {

				$safe_zipcode = $cookie_pin;

				$dod = $phen_pincode_list[$star_pincode][3];

				$dod_name = $phen_pincode_list[$star_pincode][5];

				$state = $phen_pincode_list[$star_pincode][2];

				$city = $phen_pincode_list[$star_pincode][1];

				$cod = $phen_pincode_list[$star_pincode][4];

				$deliver_by = $phen_pincode_list[$star_pincode][6];

				$time_hrs = $phen_pincode_list[$star_pincode][7];

				$time_minuts = $phen_pincode_list[$star_pincode][8];

			} else {

				$cookie_pin = '';

			}

		}

	}

	$area_wise_delivery = get_option('area_wise_delivery');

	$phen_pincodes_list = get_post_meta($pro_id, 'phen_pincode_list', true);

	$area_list = array();
	$city_list = array();
	$num_1 = 2;
	$num_11 = 11;



	if (isset($phen_pincodes_list) && is_array($phen_pincodes_list) && count($phen_pincodes_list) > 0) {

		foreach ($phen_pincodes_list as $min => $main) {
			$area_list[] = isset($main[$num_11]) ? sanitize_text_field($main[$num_11]) : '';
			$city_list[] = isset($main[$num_1]) ? sanitize_text_field($main[$num_1]) : '';
		}

	} else {

		$table_pin_codes = $table_prefix . "check_pincode_pro";

		$ppook = "SELECT * FROM `$table_pin_codes`";

		$ftc_ary = $wpdb->get_results($ppook);

		if (isset($ftc_ary) && is_array($ftc_ary)) {
			foreach ($ftc_ary as $key => $value) {
				$area_list[$value->pincode] = $value->area;
				$city_list[] = $value->city;
			}
		}

	}

	if (isset($city_list) && is_array($city_list)) {

		$area_list_unique = array_unique($area_list);

		$city_list_unique = array_unique($city_list);

	}

	if (isset($cookie_pin) && $cookie_pin != '') {


		if ($deliver_by == "day") {

			if ($dod >= 1) {

				for ($i = 1; $i <= $dod; $i++) {
					$dd = date("D", strtotime("+ $i day"));

					if ($qry22[0]['s_s'] == 0) {

						if ($dd == 'Sat') {

							$dod++;
						}

					}

					if ($qry22[0]['s_s1'] == 0) {

						if ($dd == 'Sun') {

							$dod++;
						}

					}

				}

				$delivery_date = date("D, jS M", strtotime("+ $dod day"));

			} else {

				$delivery_date = date("D, jS M");

			}
		} elseif ($deliver_by == "time_picker") {

			// echo 'tghrhrt';

			$start = current_time('Y-m-d H:i');

			if (!empty($time_hrs) && !empty($time_minuts)) {

				$delivery_date = date("d-m-Y H:i", strtotime("+$time_hrs hours +$time_minuts minutes", strtotime($start)));

			} elseif (!empty($time_minuts)) {

				$delivery_date = date("d-m-Y H:i", strtotime("+$time_minuts minutes", strtotime($start)));

			} else {

				$delivery_date = date("d-m-Y H:i", strtotime("+$time_hrs hours", strtotime($start)));

			}



		} elseif ($deliver_by == "quantity") {

			$delivery_date = "Quantity Based";

		} else {

			if ($dod_name != '') {
				$delivery_date = date('D, jS M', strtotime("next $dod_name"));

			} else {

				$delivery_date = '';
			}

		}

		$customer->set_shipping_postcode($cookie_pin);

		$user_ID = get_current_user_id();

		if (isset($user_ID) && $user_ID != 0) {

			update_user_meta($user_ID, 'shipping_postcode', $cookie_pin); //for setting shipping postcode

		}
		$availableat_text = get_option('availableat_text');

		?>
<div style="clear:both;font-size:14px;" class="wc-delivery-time-response wc-delivery-time-response-widget">

    <span class='avlpin blz-custom-message' id='avlpin'>

        <span class="phoe-green-location-icon">
            <img src="<?php echo esc_url($plugin_dir_url); ?>assets/img/phoeniixx_pin_location_icon.png" />
        </span>

        <p id="avat 1st" class="blz-message"><span
                class="pincode_static_text"><?php echo isset($availableat_text) ? $availableat_text : 'Available at'; ?>
                <?php echo esc_html($cookie_pin);
						if ($show_s_on_pro == 1 || $show_c_on_pro == 1) {
							echo "</span> <br /><span class='pincode_custom_text'>(";
						}
						if ($show_c_on_pro == 1) {
							echo $city;
						}
						if ($show_s_on_pro == 1 && $show_c_on_pro == 1) {
							echo ",";
						}
						if ($show_s_on_pro == 1) {
							echo $state;
						}
						if ($show_s_on_pro == 1 || $show_c_on_pro == 1) {
							echo ")</span>";
						} ?>
        </p><a class="button" id='change_pin'><img
                src="<?php echo esc_url($plugin_dir_url); ?>assets/img/phoeniixx_pin_pencil_logo.png" /></a>
    </span>

    <div class="pin_div" id="my_custom_checkout_field2" style="display:none;">

        <p id="pincode_field_idp" class="form-row my-field-class form-row-wide">

            <label class=""
                for="pincode_field_id"><?php _e('Check Availability At', 'pho-pincode-zipcode-cod'); ?></label>

            <span class="input-block">

                <span class="loader_div">

                    <?php if ($area_wise_delivery == 1) { ?>

                    <div class="phoen_state_upper">
                        <div class="phoen_city_1">
                            <select name="city_list" class="city_list" id="phoen_city_list">

                                <option value="0">
                                    <?php _e('Select Location', 'pho-pincode-zipcode-cod'); ?>
                                </option>
                                <?php
											foreach ($city_list_unique as $key => $value) {
												?>
                                <option value="<?php echo $value; ?>" <?php if ($valid_state == $value) {
													   echo 'selected';
												   } ?>><?php echo $value; ?></option>
                                <?php
											}
											?>
                            </select>
                        </div>
                        <div class="phoen_area" id="phoen_area_select_1">
                            <select name="area_list" class="area_list" id="phoen_area_list">
                                <option value="0">
                                    <?php _e('Select Area', 'pho-pincode-zipcode-cod'); ?>
                                </option>
                                <?php
											foreach ($area_list_unique as $key => $value1) {
												?>
                                <option value="<?php echo $value1; ?>" <?php if ($cookie_pin == $value1) {
													   echo 'selected';
												   } ?>><?php echo $value1; ?>
                                </option>
                                <?php
											}
											?>
                            </select>
                        </div>
                    </div>

                    <?php
							} else {

								if ($state_based_pincode == 1) {
									?>
                    <select name="state_list" class="state_list" id="phoen_state_list_shop">
                        <?php

										foreach ($ftc_ary_unique as $key => $value) {
											?>
                        <option value="<?php echo $value; ?>" <?php if ($valid_state == $value) {
												   echo 'selected';
											   } ?>>
                            <?php echo $value; ?></option>
                        <?php
										}
										?>
                    </select>

                    <?php
								} ?>

                    <input type="text" <?php if ($valpp == 1) { ?> required="required" <?php } ?>
                        value="<?php echo esc_html($cookie_pin); ?>" placeholder="<?php echo $checkpin_text; ?>"
                        data-mine="<?php echo $product_id; ?>" id="pincode_field_id"
                        maxlength="<?php echo $pincode_length; ?>" name="pincode_field"
                        class="input-text pincode_field_id_a" />
                    <?php
							}
							?>

                    <span id="chkpin_loader" style="display:none">

                        <img alt="ajax-loader"
                            src="<?php echo esc_url($plugin_dir_url); ?>assets/img/ajax-loader.gif" />

                    </span>

                </span>

                <a class="button <?php echo ($textascheck == 1) ? 'phoen_text_inserted' : 'phoen_text_removed'; ?>"
                    id="checkpin"><?php echo ($textascheck == 1) ? $checkpintext : ''; ?></a>

            </span>
            <!--input-block-->

            <script>
            $(document).ready(function() {
                $("#checkpin").click(function() {
                    var post_code_area = $("#pincode_field_id").val();
                    $("#post_code_area").html(post_code_area); {
                        // Postcode is allowed
                        //alert("Delivery is available for this postcode.");

                        // Check the current URL
                        var currentURL = window.location.href;

                        // Condition to check if the URL indicates a single product page
                        if (currentURL.includes("/product/")) {
                            location.reload();
                        }
                    }
                });
            });
            </script>

        </p>

        <div class="error_pin single" id="error_pin" style="display:none">
            <?php if ($qry22[0]['error_msg'] != '') {
						echo esc_html($qry22[0]['error_msg']);
						echo esc_html($pincode_field_id);
						echo '<p id="post_code_area"></p>';
					} else {
						echo "Invalid pincode entered";
					} ?>
        </div>

        <?php

				$error_msg_b = get_option('woo_pin_check_error_msg_b');

				?>

        <div class="error_pin" id="error_pin_b" style="display:none">
            <?php echo $error_msg_b; ?>
        </div>


    </div>

    <div class="delivery-info-wrap">

        <div class="delivery-info animated">
            <?php
					if ($show_d_est == 1) {
						?>
            <div class="header">
                <div class="phoe-pincode-pro-tick-img">
                    <img src="<?php echo esc_url($plugin_dir_url); ?>assets/img/Phoeniixx_Pin_green_tick.png" />
                    <img src="<?php echo esc_url($plugin_dir_url); ?>assets/img/phoeniixx_pin_calander.png" />
                </div>
                <div class="phoe-pincode-pro-tick-img">
                    <span>
                        <h6>
                            <?php if ($del_label == '') {
											echo "Delivered By";
										} else {
											echo $del_label;
										} ?>
                        </h6>
                    </span>

                    <?php
								if ($qry22[0]['del_date'] == 1) {
									?>
                    <a id="delivery_help_a" class="delivery-help-icon">
                        <?php if ($qry22[0]['help_image'] != '') { ?><img
                            height="<?php echo esc_html($qry22[0]['image_size']); ?>"
                            width="<?php echo esc_html($qry22[0]['image_size1']); ?>" class="help_icon_img" alt="?"
                            src="<?php echo esc_url($qry22[0]['help_image']); ?>"><?php } else { ?> <img
                            class="help_icon_img" alt="?"
                            src="<?php echo esc_url($plugin_dir_url); ?>assets/img/phoeniixx_pin_question_mark.png">
                        <?php } ?>
                    </a>
                    <?php

								}
								?>
                    <div class="phoen_delivery">

                        <ul class="ul-disc ul-discw">

                            <li>

                                <?php

											if ($dod != '0' && $deliver_by == "day") {
												if ($show_d_d_on_pro == 1) {
													echo $delivery_date;
												} else {
													echo $data->dod . " days";
												}

											} elseif ($dod == '0' && $deliver_by == "day") {

												if ($show_d_d_on_pro == 1) {
													echo $delivery_date;
												}
												// echo '99';	
											} elseif ($deliver_by == "time_picker") {

												echo $delivery_date;

												// echo '99';	
											} elseif ($deliver_by == "quantity") {

												echo "Quantity Based";

											} else {
												// echo '88';
												if ($show_d_d_on_pro == 1 && $dod_name != '') {
													echo $dod_name;

												} else {

													if ($dod != '0') {
														echo $data->dod . " days";

													} else {

														echo $dod_name;
													}
												}

											}

											?>

                            </li>

                        </ul>

                    </div>
                    <?php

								if ($qry22[0]['del_date'] == 1) {
									?>
                    <div class="delivery_help_text_main width_class" style="display:none">

                        <div class="delivery_help_text width_class">

                            <?php

											echo esc_html($qry22[0]['del_help_text']);

											?>

                        </div>
                    </div>
                </div>
                <?php
								}
								?>

            </div>
            <?php
					}
					?>
            <div class="cash-on-delivery-info-wrap">

                <div class="cash-on-delivery-info">
                    <?php

							if ($show_cod_a == 1) {
								?>
                    <div class="header">

                        <div class="phoe-pincode-pro-tick-img">

                            <?php

										if ($cod == 'yes') { ?>

                            <img class="phoen_chk_avail"
                                src="<?php echo esc_url($plugin_dir_url); ?>assets/img/Phoeniixx_Pin_green_tick.png" />

                            <?php } else { ?>

                            <img class="phoen_chk_avail"
                                src="<?php echo esc_url($plugin_dir_url); ?>assets/img/phoeniixx_pin_cross.png" />

                            <?php }

										?>


                            <img src="<?php echo esc_url($plugin_dir_url); ?>assets/img/phoeniixx_pin_coins.png" />
                        </div>

                        <div class="phoe-pincode-pro-tick-img">
                            <h6>
                                <?php if ($cod_label == '') {
												echo "Cash On Delivery";
											} else {
												echo $cod_label;
											} ?>
                            </h6>

                            <?php

										if ($qry22[0]['cod'] == 1) {
											?>
                            <a id="cash_n_delivery_help_a"
                                class="cash-on-delivery-help-icon"><?php if ($qry22[0]['help_image'] != '') { ?><img
                                    height="<?php echo esc_html($qry22[0]['image_size']); ?>"
                                    width="<?php echo esc_html($qry22[0]['image_size1']); ?>" class="help_icon_img"
                                    alt="" src="<?php echo esc_url($qry22[0]['help_image']); ?>"><?php } else { ?>
                                <img class="help_icon_img" alt="?"
                                    src="<?php echo esc_url($plugin_dir_url); ?>assets/img/phoeniixx_pin_question_mark.png">
                                <?php } ?></a>
                            <?php
										}

										?>

                            <div class="cash-on-delivery">

                                <?php

											if ($cod == 'yes') {

												echo esc_html($qry22[0]['cod_msg1']);

											} else {

												echo esc_html($qry22[0]['cod_msg2']);

											}

											?>

                            </div>

                            <?php

										if ($qry22[0]['cod'] == 1) {

											?>
                            <div class="cash_on_delivery_help_text_main width_class" style="display:none;">

                                <div class="cash_on_delivery_help_text width_class">

                                    <?php

													echo esc_html($qry22[0]['cod_help_text']);

													?>

                                </div>
                            </div>
                        </div>
                        <?php
										}
										?>
                    </div>
                    <?php
							}
							?>
                </div>

            </div>

        </div>

    </div>

</div>

<?php //return ob_get_clean();

	} else {

		$qry22 = $wpdb->get_results("SELECT * FROM `" . $table_prefix . "pincode_setting_pro` ORDER BY `id` ASC  limit 1", ARRAY_A);

		?>
<div style="clear:both;font-size:14px;" class="wc-delivery-time-response wc-delivery-time-response-widget">

    <span class='avlpin' id='avlpin' style="display:none">

        <span class="phoe-green-location-icon">
            <img src="<?php echo esc_url($plugin_dir_url); ?>assets/img/phoeniixx_pin_location_icon.png" />
        </span>

        <p id="avat 2nd"><span
                class="pincode_static_text"><?php echo isset($availableat_text) ? $availableat_text : 'Available at'; ?>
                <?php echo esc_html($cookie_pin);
						if ($show_s_on_pro == 1 || $show_c_on_pro == 1) {
							echo "</span><br /> <span class='pincode_custom_text'>(";
						}
						if ($show_c_on_pro == 1) {
							echo $city;
						}
						if ($show_s_on_pro == 1 && $show_c_on_pro == 1) {
							echo ",";
						}
						if ($show_s_on_pro == 1) {
							echo $state;
						}
						if ($show_s_on_pro == 1 || $show_c_on_pro == 1) {
							echo ") </span>";
						} ?>
        </p><a class="button" id='change_pin'><img
                src="<?php echo esc_url($plugin_dir_url); ?>assets/img/phoeniixx_pin_pencil_logo.png" /></a>
    </span>

    <div class="pin_div" id="my_custom_checkout_field2">

        <p id="pincode_field_idp" class="form-row my-field-class form-row-wide">

            <label class="" for="pincode_field_id">
                <?php _e('Check Availability At', 'pho-pincode-zipcode-cod');
						echo esc_html($cookie_pin); ?>
            </label>

            <span class="input-block">

                <span class="loader_div">

                    <?php if ($area_wise_delivery == 1) { ?>

                    <div class="phoen_state_upper">
                        <div class="phoen_city_1">
                            <select name="city_list" class="city_list" id="phoen_city_list">
                                <option value="0">
                                    <?php _e('Select Location', 'pho-pincode-zipcode-cod'); ?>
                                </option>
                                <?php
											foreach ($city_list_unique as $key => $value) {
												?>
                                <option value="<?php echo $value; ?>"><?php echo $value; ?></option>
                                <?php
											}
											?>
                            </select>
                        </div>
                        <div class="phoen_area" id="phoen_area_select_1">
                            <select name="area_list" class="area_list" id="phoen_area_list">
                                <option value="0">
                                    <?php _e('Select Area', 'pho-pincode-zipcode-cod'); ?>
                                </option>
                            </select>
                        </div>
                    </div>

                    <?php
							} else {

								if ($state_based_pincode == 1) { ?>
                    <select name="state_list" class="state_list" id="phoen_state_list_shop">
                        <?php
										if (isset($ftc_ary_unique) && is_array($ftc_ary_unique)) {
											foreach ($ftc_ary_unique as $key => $value) {
												?>
                        <option value="<?php echo $value; ?>"><?php echo $value; ?></option>
                        <?php
											}
										}

										?>
                    </select>

                    <?php
								} ?>


                    <?php $cookie_pin = isset($cookie_pin) ? $cookie_pin : ''; ?>
                    <input type="text" <?php if ($valpp == 1) { ?> required="required" <?php } ?>
                        value="<?php echo esc_html($cookie_pin); ?>" placeholder="<?php echo $checkpin_text; ?>"
                        data-mine="<?php echo $product_id; ?>" id="pincode_field_id"
                        maxlength="<?php echo $pincode_length; ?>" name="pincode_field"
                        class="input-text pincode_field_id_a" />

                    <?php

							} ?>

                    <span id="chkpin_loader" style="display:none">

                        <img alt="ajax-loader"
                            src="<?php echo esc_url($plugin_dir_url); ?>assets/img/ajax-loader.gif" />

                    </span>
                </span>
                <a class="button <?php echo ($textascheck == 1) ? 'phoen_text_inserted' : 'phoen_text_removed'; ?>"
                    id="checkpin"><?php echo ($textascheck == 1) ? $checkpintext : ''; ?></a>

            </span>
            <!--input-blockaa-->

            <script>
            $(document).ready(function() {
                $("#checkpin").click(function() {
                    var post_code_area = $("#pincode_field_id").val();
                    $("#post_code_area").html(post_code_area);

                    // List of allowed postcodes
                    const allowedPostcodes = [2000, 2007, 2008, 2009, 2010, 2011, 2012, 2015, 2016,
                        2017, 2018, 2019, 2020, 2021, 2022,
                        2023, 2024, 2025, 2026, 2027, 2028, 2029, 2030, 2031, 2032, 2033, 2034,
                        2035, 2036, 2037, 2038,
                        2039, 2040, 2041, 2042, 2043, 2044, 2045, 2046, 2047, 2048, 2049, 2050,
                        2060, 2061, 2062, 2063,
                        2064, 2065, 2066, 2067, 2068, 2069, 2070, 2071, 2072, 2073, 2074, 2075,
                        2076, 2077, 2079, 2080,
                        2081, 2082, 2083, 2084, 2085, 2086, 2087, 2088, 2089, 2090, 2092, 2093,
                        2094, 2095, 2096, 2097,
                        2099, 2100, 2101, 2102, 2103, 2104, 2105, 2106, 2107, 2108, 2110, 2111,
                        2112, 2113, 2114, 2115,
                        2116, 2117, 2118, 2119, 2120, 2121, 2122, 2125, 2126, 2127, 2128, 2129,
                        2130, 2131, 2132, 2133,
                        2134, 2135, 2136, 2137, 2138, 2140, 2141, 2142, 2143, 2144, 2145, 2146,
                        2147, 2148, 2150, 2151,
                        2152, 2153, 2154, 2155, 2156, 2157, 2158, 2159, 2160, 2161, 2162, 2163,
                        2164, 2165, 2166, 2167,
                        2168, 2170, 2171, 2173, 2175, 2176, 2177, 2178, 2179, 2190, 2191, 2192,
                        2193, 2194, 2195, 2196,
                        2197, 2198, 2199, 2200, 2203, 2204, 2205, 2206, 2207, 2208, 2209, 2210,
                        2211, 2212, 2213, 2214,
                        2216, 2217, 2218, 2219, 2220, 2221, 2222, 2223, 2224, 2225, 2226, 2227,
                        2228, 2229, 2230, 2231,
                        2232, 2233, 2234, 2250, 2251, 2256, 2257, 2258, 2259, 2260, 2261, 2262,
                        2263, 2264, 2267, 2278,
                        2280, 2281, 2282, 2283, 2284, 2285, 2286, 2287, 2289, 2290, 2291, 2292,
                        2293, 2294, 2295, 2296,
                        2297, 2298, 2299, 2300, 2302, 2303, 2304, 2305, 2306, 2307, 2308, 2318,
                        2322, 2500, 2502, 2505,
                        2506, 2508, 2515, 2516, 2517, 2518, 2519, 2525, 2526, 2527, 2528, 2529,
                        2530, 2533, 2534, 2535,
                        2540, 2541, 2555, 2556, 2557, 2558, 2559, 2560, 2563, 2564, 2565, 2566,
                        2567, 2568, 2569, 2570,
                        2571, 2572, 2573, 2574, 2575, 2576, 2577, 2579, 2580, 2600, 2601, 2602,
                        2603, 2604, 2605, 2606,
                        2607, 2609, 2611, 2612, 2614, 2615, 2617, 2619, 2620, 2745, 2747, 2748,
                        2749, 2750, 2752, 2753,
                        2754, 2756, 2757, 2758, 2759, 2760, 2761, 2762, 2763, 2765, 2766, 2767,
                        2768, 2769, 2770, 2773,
                        2774, 2776, 2777, 2778, 2779, 2780, 2782, 2783, 2784, 2900, 2902, 2903,
                        2904, 2905, 2906, 2911,
                        2913, 2914, 3000, 3001, 3002, 3003, 3004, 3005, 3006, 3008, 3010, 3011,
                        3012, 3013, 3015, 3016,
                        3018, 3019, 3020, 3021, 3022, 3023, 3024, 3025, 3026, 3027, 3028, 3029,
                        3030, 3031, 3032, 3033,
                        3034, 3036, 3037, 3038, 3039, 3040, 3041, 3042, 3043, 3044, 3045, 3046,
                        3047, 3048, 3049, 3050,
                        3051, 3052, 3053, 3054, 3055, 3056, 3057, 3058, 3059, 3060, 3061, 3062,
                        3063, 3063, 3064, 3065,
                        3066, 3067, 3068, 3070, 3071, 3072, 3073, 3074, 3075, 3078, 3079, 3081,
                        3082, 3083, 3084, 3085,
                        3086, 3087, 3089, 3090, 3091, 3093, 3094, 3095, 3101, 3102, 3103, 3104,
                        3105, 3106, 3107, 3108,
                        3109, 3111, 3113, 3114, 3115, 3116, 3121, 3122, 3123, 3124, 3125, 3126,
                        3127, 3128, 3129, 3130,
                        3131, 3132, 3133, 3133, 3134, 3134, 3134, 3134, 3135, 3135, 3136, 3136,
                        3136, 3136, 3137, 3137,
                        3138, 3140, 3141, 3142, 3143, 3144, 3144, 3145, 3145, 3146, 3147, 3147,
                        3148, 3148, 3149, 3150,
                        3150, 3151, 3152, 3152, 3152, 3153, 3153, 3154, 3155, 3156, 3156, 3156,
                        3156, 3158, 3160, 3160,
                        3160, 3160, 3161, 3162, 3162, 3163, 3163, 3163, 3164, 3165, 3166, 3166,
                        3166, 3166, 3167, 3168,
                        3168, 3169, 3169, 3170, 3171, 3172, 3172, 3173, 3174, 3174, 3175, 3175,
                        3175, 3175, 3177, 3177,
                        3178, 3179, 3180, 3181, 3181, 3182, 3182, 3183, 3183, 3184, 3185, 3185,
                        3185, 3186, 3186, 3187,
                        3188, 3188, 3189, 3189, 3190, 3191, 3192, 3192, 3193, 3193, 3194, 3194,
                        3195, 3195, 3195, 3195,
                        3195, 3195, 3196, 3196, 3196, 3196, 3197, 3197, 3198, 3199, 3199, 3200,
                        3201, 3202, 3204, 3204,
                        3204, 3205, 3205, 3206, 3206, 3207, 3211, 3212, 3212, 3212, 3214, 3214,
                        3214, 3215, 3215, 3215,
                        3215, 3215, 3215, 3216, 3216, 3216, 3216, 3216, 3216, 3216, 3216, 3217,
                        3218, 3218, 3218, 3219,
                        3219, 3219, 3219, 3219, 3219, 3220, 3220, 3220, 3222, 3222, 3222, 3222,
                        3222, 3223, 3223, 3223,
                        3224, 3225, 3225, 3225, 3225, 3226, 3227, 3227, 3227, 3228, 3228, 3228,
                        3228, 3427, 3427, 3428,
                        3796, 3800, 3802, 3803, 3804, 3804, 3805, 3805, 3806, 3806, 3807, 3807,
                        3808, 3808, 3809, 3809,
                        3810, 3810, 3810, 3810, 3910, 3911, 3911, 3912, 3912, 3913, 3915, 3915,
                        3918, 3919, 3930, 3931,
                        3933, 3934, 3936, 3936, 3936, 3937, 3937, 3938, 3939, 3940, 3941, 3942,
                        3943, 3975, 3976, 3977,
                        3978
                    ];

                    if (allowedPostcodes.includes(parseInt(post_code_area))) {
                        // Postcode is allowed
                        //alert("Delivery is available for this postcode.");

                        // Check the current URL


                        // Condition to check if the URL indicates a single product page

                    }
                    var currentURL = window.location.href;
                    if (currentURL.includes("/product/")) {
                        location.reload();
                    }
                });
            });
            </script>


        </p>
        <div class="shoppage_error" id="error_pin" style="display:none">
            <p>
                <?php if ($qry22[0]['error_msg'] != '') {
							echo esc_html($qry22[0]['error_msg']);
							echo esc_html($pincode_field_id);
							echo '<p id="post_code_area"></p>';
						} else {
							echo "Invalid pincode entered";
						} ?>
            </p>

        </div>
        <!-- <div class="error_pin" id="error_pin" style="display:none"><?php //if($qry22[0]['error_msg'] != '' ){ echo esc_html( $qry22[0]['error_msg'] ); }else{ echo "Invalid pincode entered"; } ?></div>
									
										<?php

										$error_msg_b = get_option('woo_pin_check_error_msg_b');

										?> -->

        <div class="error_pin" id="error_pin_b" style="display:none">
            <?php echo $error_msg_b; ?>
        </div>


    </div>
    <div class="post-c-add">
        <div id="post-p">
            <p class="bold-p">Sydney CBD & Metro</p>
            <p class="light-p">We deliver your order within 72 hours Monday through Friday*</p>
        </div>
        <div id="post-p">
            <p class="bold-p">Regional NSW</p>
            <p class="light-p">Review our Delivery Service Area chart for delivery days</p>
        </div>
        <!-- <div id="post-p">
			<p class="bold-p">Melbourne CBD & Metro</p>
			<p class="light-p">Orders must be made by 5:00pm Friday for Thursday delivery</p>
		</div> -->
        <div class="postc-links">
            <a class="TERM-postcode" href="https://thebutchersdog.com.au/delivery-shipping/">*Delivery &amp; Shipping
                Conditions apply</a>
        </div>
    </div>
    <div class="delivery-info-wrap delivery-info-wrap2" style="display:none">

        <div class="delivery-info animated">
            <?php
					if ($show_d_est == 1) {
						?>
            <div class="header">

                <div class="phoe-pincode-pro-tick-img">

                    <img src="<?php echo esc_url($plugin_dir_url); ?>assets/img/Phoeniixx_Pin_green_tick.png" />

                    <img class="" src="<?php echo esc_url($plugin_dir_url); ?>assets/img/phoeniixx_pin_calander.png" />

                </div>
                <div class="phoe-pincode-pro-tick-img">
                    <span>
                        <h6>
                            <?php if ($del_label == '') {
											echo "Delivered By";
										} else {
											echo $del_label;
										} ?>
                        </h6>
                    </span>

                    <?php
								if ($qry22[0]['del_date'] == 1) {
									?>
                    <a id="delivery_help_a" class="delivery-help-icon">
                        <?php if ($qry22[0]['help_image'] != '') { ?><img
                            height="<?php echo esc_html($qry22[0]['image_size']); ?>"
                            width="<?php echo esc_html($qry22[0]['image_size1']); ?>" class="help_icon_img" alt="?"
                            src="<?php echo esc_url($qry22[0]['help_image']); ?>"><?php } else { ?> <img
                            class="help_icon_img" alt="?"
                            src="<?php echo esc_url($plugin_dir_url); ?>assets/img/phoeniixx_pin_question_mark.png">
                        <?php } ?>
                    </a>
                    <?php

								}
								?>
                    <div class="phoen_delivery">

                        <ul class="ul-disc ul-discw">

                        </ul>

                    </div>
                    <?php

								if ($qry22[0]['del_date'] == 1) {
									?>

                    <div class="delivery_help_text_main width_class" style="display:none">

                        <div class="delivery_help_text width_class">

                            <?php

											echo esc_html($qry22[0]['del_help_text']);

											?>

                        </div>

                    </div>
                </div>
                <?php
								}
								?>

            </div>
            <?php
					}
					?>
            <div class="cash-on-delivery-info-wrap">

                <div class="cash-on-delivery-info animated">
                    <?php
							if ($show_cod_a == 1) {
								?>
                    <div class="header">

                        <div class="phoe-pincode-pro-tick-img">

                            <img class="phoen_chk_avail"
                                src="<?php echo esc_url($plugin_dir_url); ?>assets/img/phoeniixx_pin_cross.png" />

                            <img src="<?php echo esc_url($plugin_dir_url); ?>assets/img/phoeniixx_pin_coins.png" />
                        </div>

                        <div class="phoe-pincode-pro-tick-img">

                            <h6>
                                <?php if ($cod_label == '') {
												echo "Cash On Delivery";
											} else {
												echo $cod_label;
											} ?>
                            </h6>
                            <?php

										if ($qry22[0]['cod'] == 1) {
											?>
                            <a id="cash_n_delivery_help_a"
                                class="cash-on-delivery-help-icon"><?php if ($qry22[0]['help_image'] != '') { ?><img
                                    height="<?php echo esc_html($qry22[0]['image_size']); ?>"
                                    width="<?php echo esc_html($qry22[0]['image_size1']); ?>" class="help_icon_img"
                                    alt="" src="<?php echo esc_url($qry22[0]['help_image']); ?>"><?php } else { ?>
                                <img class="help_icon_img" alt="?"
                                    src="<?php echo esc_url($plugin_dir_url); ?>assets/img/phoeniixx_pin_question_mark.png">
                                <?php } ?></a>
                            <?php
										}

										?>
                            <div class="cash-on-delivery"></div>

                            <?php

										if ($qry22[0]['cod'] == 1) {

											?>
                            <div class="cash_on_delivery_help_text_main width_class" style="display:none;">
                                <?php

												if ($qry22[0]['tt_c_image'] != '') {
													?>

                                <img height="<?php echo esc_html($qry22[0]['tt_c_image_size']); ?>"
                                    width="<?php echo esc_html($qry22[0]['tt_c_image_size1']); ?>"
                                    id="cash_n_delivery_help_x" class="delivery-help-cross"
                                    src="<?php echo esc_url($qry22[0]['tt_c_image']); ?>" />

                                <?php
												} else {
													?>

                                <a id="cash_n_delivery_help_x" class="delivery-help-cross"> <img class="help_icon_img"
                                        alt="x" src="<?php echo esc_url($plugin_dir_url); ?>assets/img/cross.png">
                                </a>

                                <?php
												}
												?>

                                <div class="cash_on_delivery_help_text width_class">

                                    <?php

													echo esc_html($qry22[0]['cod_help_text']);

													?>

                                </div>
                            </div>
                        </div>
                        <?php
										}
										?>
                    </div>
                    <?php
							}
							?>
                </div>

            </div>

        </div>

    </div>

</div>
<?php

	}

	?>
<script>
jQuery(function() {
    jQuery("select#phoen_city_list").on("change", function() {
        var selected_city = jQuery(this).val();
        var product_id = jQuery(this).attr('data-mine');
        var phoen_send_ajax_for_city = '<?php echo admin_url('admin-ajax.php'); ?>';
        jQuery("#shop_chkpin_loader").show();
        if (selected_city !== "") {

            jQuery.post(

                phoen_send_ajax_for_city, {
                    'action': 'phoen_action_city_send',
                    'city': selected_city,
                    'product_id': product_id
                },
                function(response) {
                    jQuery("#shop_chkpin_loader").show();
                    jQuery("#phoen_area_select_1").html(response);
                }

            );

        }

    });
});
jQuery(document).ready(function() {

    var selected_city = jQuery.trim(jQuery('.phoen_city_1 .city_list').val());
    var product_id = jQuery(".phoen_city_1 .city_list").attr('data-mine');
    var phoen_send_ajax_for_city = '<?php echo admin_url('admin-ajax.php'); ?>';
    jQuery("#shop_chkpin_loader").show();
    if (selected_city !== "") {

        jQuery.post(

            phoen_send_ajax_for_city, {
                'action': 'phoen_action_city_send',
                'city': selected_city,
                'product_id': product_id
            },
            function(response) {
                jQuery("#shop_chkpin_loader").hide();
                jQuery("#phoen_area_select_1").html(response);
            }

        );

    }

    // jQuery("#phoen_area_list").select2();
    jQuery('.phoen_city_1 .city_list').select2();
    jQuery('#phoen_area_select_1 .area_list').select2();
    jQuery('#phoen_state_list_shop').select2();
});
</script>
<?php
	return ob_get_clean();
}
?>