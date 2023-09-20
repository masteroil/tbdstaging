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

    <span class='avlpin' id='avlpin'>

        <span class="phoe-green-location-icon">
            <img src="<?php echo esc_url($plugin_dir_url); ?>assets/img/phoeniixx_pin_location_icon.png" />
        </span>

        <p id="avat 1st"><span
                class="pincode_static_text"><?php echo isset($availableat_text) ? $availableat_text : 'Available at'; ?>
                <?php echo esc_html($cookie_pin);  echo esc_html($cookie_pin);
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



        </p>

        <div class="error_pin" id="error_pin" style="display:none">
            <?php if ($qry22[0]['error_msg'] != '') {
						echo esc_html($qry22[0]['error_msg']);
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
            $("#checkpin").click(function() {
                var post_code_area = $("#pincode_field_id").val();
                $("#post_code_area").html(post_code_area);
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