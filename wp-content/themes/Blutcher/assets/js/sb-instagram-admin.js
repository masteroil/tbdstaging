jQuery(document).ready(function($) {
    jQuery('#sbi_no_js_warning').remove();
    /* NEW API CODE */
    $('.sbi_admin_btn, .sbi_reconnect').click(function(event) {
        event.preventDefault();

        var today = new Date(),
            march = new Date('June 1, 2020 00:00:00'),
            oldApiURL = $('a.sbi_admin_btn').attr('data-old-api'),
            oldApiLink = '';
        if (today.getTime() < march.getTime()) {
            oldApiLink = 'To connect using the legacy API, <a href="'+oldApiURL+'">click here</a> (expires on June 1, 2020).';
        }

        var personalBasicApiURL = $('#sbi_config .sbi_admin_btn').attr('data-personal-basic-api'),
            newApiURL = $('#sbi_config .sbi_admin_btn').attr('data-new-api');
        $('#sbi_config').append('<div id="sbi_config_info" class="sb_get_token">' +
            '<div class="sbi_config_modal">' +
            '<p>Are you connecting a Personal or Business Instagram Profile?</p>' +
            '<div class="sbi_login_button_row">' +
            '<input type="radio" id="sbi_basic_login" name="sbi_login_type" value="basic" checked>' +
            '<label for="sbi_basic_login"><b>Personal</b> <i>(User feeds only)</i><a href="JavaScript:void(0);" class="sbi_tooltip_link"><i class="fa fa-question-circle"></i></a><div class="sbi_tooltip">Used for displaying user feeds from a "Personal" Instagram account. ' +
            oldApiLink +
            '</div></div>' +
            '<div class="sbi_login_button_row">' +
            '<input type="radio" id="sbi_business_login" name="sbi_login_type" value="business">' +

            '<label for="sbi_business_login"><b>Business</b> <i>(Required for Hashtag feeds and more)</i></label>&nbsp;<a href="JavaScript:void(0);" class="sbi_tooltip_link"><i class="fa fa-question-circle"></i></a><div class="sbi_tooltip">Used for displaying a user feed from a "Business" or "Creator" Instagram account. A Business or Creator account is required for displaying Hashtag feeds, Tagged feeds, comments, like/comment counts, and automatic avatar/bio display in the header. See <a href="https://smashballoon.com/instagram-business-profiles" target="_blank">this FAQ</a> for more info.</div>' +
            '</div>' +

            '<div class="sbi_login_button_row"><a href="JavaScript:void(0);" class="sbi_tooltip_link" style="margin-left: 102px; font-size: 12px;">I\'m not sure</a><div class="sbi_tooltip" style="display: none;"><p style="margin-top: 0;">If displaying a regular feed of posts from an Instagram account then you can select the "Personal" option, as this can display feeds from either a Personal or Business account.</p><p style="margin-bottom: 0;"">If displaying a Hashtag or Tagged feed then you must have an Instagram Business account. If needed, you can convert a Personal account into a Business account by following the directions <a href="https://smashballoon.com/instagram-business-profiles" target="_blank">here</a>.</p></div></div>' +

            '<a href="'+personalBasicApiURL+'" class="sbi_admin_btn">Connect</a>' +
            '<a href="JavaScript:void(0);"><i class="sbi_modal_close fa fa-times"></i></a>' +
            '</div>' +
            '</div>');

        $('.sbi_modal_close').on('click', function(){
            $('#sbi_config_info').remove();
        });

        $('input[name=sbi_login_type]').change(function() {
            if ($('input[name=sbi_login_type]:checked').val() === 'business') {
                $('a.sbi_admin_btn').attr('href',newApiURL);
            } else {
                $('a.sbi_admin_btn').attr('href',personalBasicApiURL);
            }
        });
    });

    if ($('.sbi_config_modal .sbi-managed-pages').length) {
        $('#sbi_config').append($('#sbi_config_info'));
    }

    $('#sbi-select-all').change(function() {
        var status = $(this).is(':checked');
        $('.sbi-add-checkbox input').each(function() {
            $(this).attr('checked',status);
        });
        if($('.sbi-add-checkbox input:checked').length) {
            $('#sbi-connect-business-accounts').removeAttr('disabled');
        } else {
            $('#sbi-connect-business-accounts').attr('disabled',true);
        }
    });

    $('.sbi-add-checkbox input').change(function() {
        if($('.sbi-add-checkbox input:checked').length) {
            $('#sbi-connect-business-accounts').removeAttr('disabled');
        } else {
            $('#sbi-connect-business-accounts').attr('disabled',true);
        }
    });

    $('#sbi-connect-business-accounts').click(function(event) {
        if(typeof $(this).attr('disabled') === 'undefined') {
            event.preventDefault();
            var accounts = {};
            $('.sbi-add-checkbox input').each(function(index) {
                if ($(this).is(':checked')) {
                    var jsonSubmit = JSON.parse($(this).val());
                    jsonSubmit.access_token = $(this).closest('.sbi-managed-page').attr('data-token');
                    jsonSubmit.page_access_token = $(this).closest('.sbi-managed-page').attr('data-page-token');
                    accounts[index] = jsonSubmit;
                }
            });

            $('.sbi_connected_accounts_wrap,#sbi_config_info').fadeTo("slow" , 0.5);
            jQuery.ajax({
                url: sbiA.ajax_url,
                type: 'post',
                data: {
                    action: 'sbi_connect_business_accounts',
                    accounts: JSON.stringify(accounts),
                    sbi_nonce: sbiA.sbi_nonce
                },
                success: function (data) {
                    if (data.trim().indexOf('{') === 0) {
                        var connectedAccounts = JSON.parse(data);
                        $('.sbi_connected_accounts_wrap').fadeTo("slow" , 1);
                        $('#sbi_config_info').remove();
                        $.each(connectedAccounts,function(index,savedToken) {
                            console.log(savedToken);
                            sbiAfterUpdateToken(savedToken,false);

                        });
                    }

                    if ($('.sbsw-reload').length) {
                        window.location.href= $('.sbsw-reload').attr('data-reload');
                    }

                }
            });
        }

    });

    $('.sbi_modal_close').on('click', function(){
        $('#sbi_config_info').remove();
    });
    /* NEW API CODE */
    //Autofill the token and id
    var hash = window.location.hash,
        token = hash.substring(14),
        id = token.split('.')[0];

    if (token.length > 40 && $('.sbi_admin_btn').length) {
        $('.sbi_admin_btn').css('opacity','.5').after('<div class="spinner" style="visibility: visible; position: relative;float: left;margin-top: 15px;"></div>');
        jQuery.ajax({
            url: sbiA.ajax_url,
            type: 'post',
            data: {
                action: 'sbi_after_connection',
                access_token: token,
            },
            success: function (data) {
                if (data.indexOf('{') === 0) {
                    var accountInfo = JSON.parse(data);
                    if (typeof accountInfo.error_message === 'undefined') {
                        accountInfo.token = token;

                        $('.sbi_admin_btn').css('opacity','1');
                        $('#sbi_config').find('.spinner').remove();
                        if (!$('.sbi_connected_account ').length) {
                            $('.sbi_no_accounts').remove();
                            sbSaveToken(token,true);
                        } else {
                            var buttonText = 'Connect This Account';
                            // if the account is connected, offer to update in case information has changed.
                            if ($('#sbi_connected_account_'+id).length) {
                                buttonText = 'Update This Account';
                            }
                            $('#sbi_config').append('<div id="sbi_config_info" class="sb_get_token">' +
                                '<div class="sbi_config_modal">' +
                                '<img class="sbi_ca_avatar" src="'+accountInfo.profile_picture+'" />' +
                                '<div class="sbi_ca_username"><strong>'+accountInfo.username+'</strong></div>' +
                                '<p class="sbi_submit"><input type="submit" name="sbi_submit" id="sbi_connect_account" class="button button-primary" value="'+buttonText+'">' +
                                '<a href="JavaScript:void(0);" class="button button-secondary" id="sbi_switch_accounts">Switch Accounts</a></p>' +
                                '<a href="JavaScript:void(0);"><i class="sbi_modal_close fa fa-times"></i></a>' +
                                '</div>' +
                                '</div>');

                            $('#sbi_connect_account').click(function(event) {
                                event.preventDefault();
                                $('#sbi_config_info').fadeOut(200);
                                sbSaveToken(token,false);
                            });

                            sbiSwitchAccounts();
                        }
                    } else {
                        $('.sbi_admin_btn').css('opacity','1');
                        $('#sbi_config').find('.spinner').remove();
                        var message = accountInfo.error_message;

                        $('#sbi_config').append('<div id="sbi_config_info" class="sb_get_token">' +
                            '<div class="sbi_config_modal">' +
                            '<p>'+message+'</p>' +
                            '<p class="sbi_submit"><a href="JavaScript:void(0);" class="button button-secondary" id="sbi_switch_accounts">Switch Accounts</a></p>' +
                            '<a href="JavaScript:void(0);"><i class="sbi_modal_close fa fa-times"></i></a>' +
                            '</div>' +
                            '</div>');

                        sbiSwitchAccounts();
                    }

                } else {
                    $('.sbi_admin_btn').css('opacity','1');
                    $('#sbi_config').find('.spinner').remove();
                    var message = 'There was an error connecting your account';

                    $('#sbi_config').append('<div id="sbi_config_info" class="sb_get_token">' +
                        '<div class="sbi_config_modal">' +
                        '<p>'+message+'</p>' +
                        '<p class="sbi_submit"><a href="JavaScript:void(0);" class="button button-secondary" id="sbi_switch_accounts">Switch Accounts</a></p>' +
                        '<a href="JavaScript:void(0);"><i class="sbi_modal_close fa fa-times"></i></a>' +
                        '</div>' +
                        '</div>');

                    sbiSwitchAccounts();
                }

            }
        });

        window.location.hash = '';
    }

    function sbiSwitchAccounts(){
        $('#sbi_switch_accounts').on('click', function(){
            //Log user out of Instagram by hitting the logout URL in an iframe
            $('body').append('<iframe style="display: none;" src="https://www.instagram.com/accounts/logout"></iframe>');

            $(this).text('Please wait...').after('<div class="spinner" style="visibility: visible; float: none; margin: -3px 0 0 3px;"></div>');

            //Wait a couple seconds for the logout to occur, then connect a new account
            setTimeout(function(){
                window.location.href = $('.sbi_admin_btn').attr('href');
            }, 2000);
        });

        $('.sbi_modal_close').on('click', function(){
            $('#sbi_config_info').remove();
        });
    }
    if ($('#sbi_switch_accounts').length) {
        $('.sbi_admin_btn').attr('href',$('#sbi_config .sbi_admin_btn').attr('data-personal-basic-api'));
        sbiSwitchAccounts();
    }

    function sbiAfterUpdateToken(savedToken,saveID){
        $('.sbi_no_accounts').remove();
        if (saveID) {
            sbSaveID(savedToken.user_id);
            $('.sbi_user_feed_ids_wrap').prepend(
                '<div id="sbi_user_feed_id_'+savedToken.user_id+'" class="sbi_user_feed_account_wrap">'+
                '<strong>'+savedToken.username+'</strong> <span>('+savedToken.user_id+')</span>' +
                '<input type="hidden" name="sb_instagram_user_id[]" value="'+savedToken.user_id+'">' +
                '</div>'
            );
        }
        if (typeof savedToken.old_user_id !== 'undefined' && $('#sbi_connected_account_'+savedToken.old_user_id).length) {

            if ($('#sbi_user_feed_id_'+savedToken.old_user_id).length) {
                $('.sbi_user_feed_ids_wrap').prepend(
                    '<div id="sbi_user_feed_id_'+savedToken.user_id+'" class="sbi_user_feed_account_wrap">'+
                    '<strong>'+savedToken.username+'</strong> <span>('+savedToken.user_id+')</span>' +
                    '<input type="hidden" name="sb_instagram_user_id[]" value="'+savedToken.user_id+'">' +
                    '</div>'
                );
                $('#sbi_user_feed_id_'+savedToken.old_user_id).remove();

                saveID = true;
            }

            $('#sbi_connected_account_'+savedToken.old_user_id).remove();
        }
        if ($('#sbi_connected_account_'+savedToken.user_id).length) {
            if (savedToken.is_valid) {
                $('#sbi_connected_account_'+savedToken.user_id).addClass('sbi_account_updated');
            } else {
                $('#sbi_connected_account_'+savedToken.user_id).addClass('sbi_account_invalid');
            }
            $('#sbi_connected_account_'+savedToken.user_id).attr('data-accesstoken',savedToken.access_token);
            if (typeof savedToken.use_tagged !== 'undefined' && savedToken.use_tagged == '1') {
                $('#sbi_connected_account_'+savedToken.user_id).attr('data-permissions','tagged');
                $('#sbi_connected_account_'+savedToken.user_id).find('.sbi_permissions_desc').text('All');
            }

            if (! $('#sbi_connected_account_'+savedToken.user_id + ' .sbi_ca_avatar').length) {
                if (savedToken.profile_picture !== '') {
                    $('#sbi_connected_account_'+savedToken.user_id + ' .sbi_ca_username').prepend('<img class="sbi_ca_avatar" src="'+savedToken.profile_picture+'">');
                }
            }
            $('#sbi_connected_account_'+savedToken.user_id + ' .sbi_ca_username').find('span').text(sbiAccountType(savedToken.type));

            $('#sbi_connected_account_'+savedToken.user_id).find('.sbi_ca_accesstoken .sbi_ca_token').text(savedToken.access_token);
            $('#sbi_connected_account_'+savedToken.user_id).find('.sbi_tooltip code').text('[instagram-feed accesstoken="'+savedToken.access_token+'"]');

        } else {
            //Check which kind of account it is
            if(typeof savedToken.type !== 'undefined'){
                var accountType = savedToken.type;
                $('.sbi_hashtag_feed_issue').removeClass('sbi_hashtag_feed_issue').find('.sbi_hashtag_feed_issue_note').hide();
            } else {
                var accountType = 'personal';
            }

            var permissionsAtt = '';
            if (accountType === 'business') {
                permissionsAtt = ' data-permissions="tagged"';
            }

            var avatarHTML = '';
            if (savedToken.profile_picture !== '') {
                avatarHTML = '<img class="sbi_ca_avatar" src="'+savedToken.profile_picture+'" />';
            }

            //Add the account HTML to the page
            var removeOrSaveHTML = saveID ? '<a href="JavaScript:void(0);" class="sbi_remove_from_user_feed button-primary"><i class="fa fa-minus-circle" aria-hidden="true"></i>Remove from Primary Feed</a>' : '<a href="JavaScript:void(0);" class="sbi_use_in_user_feed button-primary"><i class="fa fa-plus-circle" aria-hidden="true"></i>Add to Primary Feed</a>',
                statusClass = saveID ? 'sbi_account_active' : 'sbi_account_updated',
                html = '<div class="sbi_connected_account '+statusClass+' sbi-init-click-remove" id="sbi_connected_account_'+savedToken.user_id+'" data-accesstoken="'+savedToken.access_token+'" data-userid="'+savedToken.user_id+'" data-username="'+savedToken.username+'"'+permissionsAtt+'>'+
                    '<div class="sbi_ca_info">'+

                    '<div class="sbi_ca_delete">'+
                    '<a href="JavaScript:void(0);" class="sbi_delete_account"><i class="fa fa-times"></i><span class="sbi_remove_text">Remove</span></a>'+
                    '</div>'+

                    '<div class="sbi_ca_username">'+
                    avatarHTML+
                    '<strong>'+savedToken.username+'<span>'+sbiAccountType(accountType)+'</span></strong>'+
                    '</div>'+

                    '<div class="sbi_ca_actions">'+
                    removeOrSaveHTML +
                    '<a class="sbi_ca_token_shortcode button-secondary" href="JavaScript:void(0);"><i class="fa fa-chevron-circle-right" aria-hidden="true"></i>Add to another Feed</a>'+
                    '<a class="sbi_ca_show_token button-secondary" href="JavaScript:void(0);" title="Show access token and account info"><i class="fa fa-cog"></i></a>'+
                    '</div>'+

                    '<div class="sbi_ca_shortcode">'+
                    '<p>Copy and paste this shortcode into your page or widget area:<br>'+
                    '<code>[instagram-feed user="'+savedToken.username+'"]</code>'+
                    '</p>'+
                    '<p>To add multiple users in the same feed, simply separate them using commas:<br>'+
                    '<code>[instagram-feed user="'+savedToken.username+', a_second_user, a_third_user"]</code>'+
                    '<p>Click on the <a href="?page=sb-instagram-feed&tab=display" target="_blank">Display Your Feed</a> tab to learn more about shortcodes</p>'+
                    '</div>'+

                    '<div class="sbi_ca_accesstoken">' +
                    '<span class="sbi_ca_token_label">Access Token:</span><input type="text" class="sbi_ca_token" value="'+savedToken.access_token+'" readonly="readonly" onclick="this.focus();this.select()" title="To copy, click the field then press Ctrl + C (PC) or Cmd + C (Mac)."><br>' +
                    '<span class="sbi_ca_token_label">User ID:</span><input type="text" class="sbi_ca_user_id" value="'+savedToken.user_id+'" readonly="readonly" onclick="this.focus();this.select()" title="To copy, click the field then press Ctrl + C (PC) or Cmd + C (Mac)."><br>' +
                    '<span class="sbi_ca_token_label">Permissions:</span><span class="sbi_permissions_desc">All</span>' +
                    '</div>' +

                    '</div>'+
                    '</div>';
            $('.sbi_connected_accounts_wrap').prepend(html);
            var $clickRemove = $('.sbi-init-click-remove');
            sbiInitClickRemove($clickRemove.find('.sbi_delete_account'));
            if ($clickRemove.find('.sbi_remove_from_user_feed').length ) {
                $clickRemove.find('.sbi_remove_from_user_feed').off();
                sbiInitUserRemove($clickRemove.find('.sbi_remove_from_user_feed'));
            } else {
                $clickRemove.find('.sbi_use_in_user_feed').off();
                sbiInitUserAdd($clickRemove.find('.sbi_use_in_user_feed'));
            }
            $clickRemove.removeClass('sbi-init-click-remove');
        }
    }

    function sbSaveToken(token,saveID) {
        $('.sbi_connected_accounts_wrap').fadeTo("slow" , 0.5);
        jQuery.ajax({
            url: sbiA.ajax_url,
            type: 'post',
            data: {
                action: 'sbi_auto_save_tokens',
                access_token: token,
                just_tokens: true,
                sbi_nonce: sbiA.sbi_nonce
            },
            success: function (data) {
                var savedToken = JSON.parse(data);
                $('.sbi_connected_accounts_wrap').fadeTo("slow" , 1);
                sbiAfterUpdateToken(savedToken,saveID);
            }
        });
    }

    function sbiAccountType(accountType) {
        if (accountType === 'basic') {
            return 'personal (new API)';
        }
        return accountType;
    }

    function sbSaveID(ID) {
        jQuery.ajax({
            url: sbiA.ajax_url,
            type: 'post',
            data: {
                action: 'sbi_auto_save_id',
                id: ID,
                just_tokens: true,
                sbi_nonce: sbiA.sbi_nonce
            },
            success: function (data) {
            }
        });
    }

    // connect accounts
    //sbi-bus-account-error
    if (window.location.hash && window.location.hash === '#test') {
        window.location.hash = '';
        $('#sbi-bus-account-error').html('<p style="margin-top: 5px;"><b style="font-size: 16px">Couldn\'t connect an account with this access token</b><br />' +
            'Please check to make sure that the token you entered is correct.</p>')
    }

    $('.sbi_manually_connect_wrap').hide();
    $('.sbi_manually_connect').click(function(event) {
        event.preventDefault();
        if ( $('.sbi_manually_connect_wrap').is(':visible') ) {
            $('.sbi_manually_connect_wrap').slideUp(200);
        } else {
            $('.sbi_manually_connect_wrap').slideDown(200);
            $('#sb_manual_at').focus();
        }
    });

    $('#sb_manual_at').on('input',function() {
        sbiToggleManualAccountIDInput();
    });
    if ($('#sb_manual_at').length){
        sbiToggleManualAccountIDInput();
    }

    function sbiIsBusinessToken() {
        return ($('#sb_manual_at').val().trim().length > 125);
    }

    function sbiToggleManualAccountIDInput() {
        if (sbiIsBusinessToken()) {
            $('.sbi_manual_account_id_toggle').slideDown();
            $('.sbi_business_profile_tag').css('display', 'inline-block');
        } else {
            $('.sbi_manual_account_id_toggle').slideUp();
        }
    }

    var $body = $('body');
    $body.on('click', '.sbi_test_token, .sbi_ca_token_shortcode', function (event) {
        event.preventDefault();
        var $clicked = $(event.target),
            accessToken = $clicked.closest('.sbi_connected_account').attr('data-accesstoken'),
            action = false,
            atParts = accessToken.split('.'),
            username = $clicked.closest('.sbi_connected_account').attr('data-username'),
            accountID = $clicked.closest('.sbi_connected_account').attr('data-userid');
        if ($clicked.hasClass('sbi_ca_token_shortcode')) {
            jQuery(this).closest('.sbi_ca_info').find('.sbi_ca_shortcode').slideToggle(200);
        } //

    });

    $('.sbi_delete_account').each(function() {
        sbiInitClickRemove($(this));
    });

    function sbiInitClickRemove(el) {
        el.click(function(event) {
            event.preventDefault();
            if (!$(this).closest('.sbi_connected_accounts_wrap').hasClass('sbi-waiting')) {
                $(this).closest('.sbi_connected_accounts_wrap').addClass('sbi-waiting');
                var accessToken = $(this).closest('.sbi_connected_account').attr('data-accesstoken'),
                    action = false,
                    atParts = accessToken.split('.'),
                    username = $(this).closest('.sbi_connected_account').attr('data-username'),
                    accountID = $(this).closest('.sbi_connected_account').attr('data-userid');

                if (window.confirm("Delete this connected account?")) {
                    action = 'sbi_delete_account';
                    $('#sbi_user_feed_id_' + accountID).remove();
                    $('#sbi_tagged_feed_id_' + accountID).remove();
                    $('#sbi_connected_account_' + accountID).append('<div class="spinner" style="margin-top: -10px;visibility: visible;top: 50%;position: absolute;right: 50%;"></div>').find('.sbi_ca_info').css('opacity','.5');

                    jQuery.ajax({
                        url: sbiA.ajax_url,
                        type: 'post',
                        data: {
                            action: action,
                            account_id: accountID,
                            sbi_nonce: sbiA.sbi_nonce
                        },
                        success: function (data) {
                            $('.sbi-waiting').removeClass('sbi-waiting');
                            $('#sbi_connected_account_' + accountID).fadeOut(300, function() { $(this).remove(); });
                        }
                    });
                } else {
                    $('.sbi-waiting').removeClass('sbi-waiting');
                }
            }

        });
    }

    $('.sbi_remove_from_user_feed').each(function() {
        sbiInitUserRemove($(this));
    });

    function sbiInitUserRemove(el,targetClass) {
        el.click(function(event) {
            event.preventDefault();
            targetClass = $('input[name=sb_instagram_type]:checked').val();

            var $clicked = $(this),
                accountID = $clicked.closest('.sbi_connected_account').attr('data-userid');

            $('#sbi_'+targetClass+'_feed_id_'+accountID).remove();

            sbiConAccountsAddRemoveUpdater();
        });
    }



    $('.sbi_use_in_user_feed').each(function() {
        sbiInitUserAdd($(this), 'user');
    });

    function sbiInitUserAdd(el,targetClass) {
        el.click(function(event) {
            targetClass = $('input[name=sb_instagram_type]:checked').val();
            event.preventDefault();
            var $clicked = $(this),
                $closest = $clicked.closest('.sbi_connected_account'),
                username = $clicked.closest('.sbi_connected_account').attr('data-username'),
                accountID = $clicked.closest('.sbi_connected_account').attr('data-userid');

            var name = '<strong>'+accountID+'</strong>';
            if (username !== '') {
                name = '<strong>'+username+'</strong> <span>('+accountID+')</span>';
            }
            $('.sbi_'+targetClass+'_feed_ids_wrap').prepend(
                '<div id="sbi_'+targetClass+'_feed_id_'+accountID+'" class="sbi_'+targetClass+'_feed_account_wrap">'+
                name +
                '<input type="hidden" name="sb_instagram_'+targetClass+'_id[]" value="'+accountID+'">' +
                '</div>'
            );
            $('.sbi_no_accounts').hide();
            sbiConAccountsAddRemoveUpdater();
        });
    }

    function sbiConAccountsAddRemoveUpdater() {
        var targetClass = $('input[name=sb_instagram_type]:checked').val();

        var isSelected = [];
        $('.sbi_'+targetClass+'_feed_account_wrap').find('input').each(function() {
            isSelected.push($(this).val());
        });

        $('.sbi_connected_account').each(function() {
            var username = $(this).attr('data-username'),
                accountID = $(this).attr('data-userid'),
                type = $(this).attr('data-type'),
                permissions = $(this).attr('data-permissions'),
                $addRemoveButton = $(this).find('.sbi_ca_actions .button-primary').first();
            $(this).removeClass('sbi_account_updated');
            $addRemoveButton.removeAttr('disabled');

            if (targetClass === 'tagged' && (type === 'personal' || permissions !== 'tagged')) {
                $addRemoveButton.show();
                if (type === 'personal') {
                    $addRemoveButton.html('Tagged Feeds Not Supported');
                } else {
                    $addRemoveButton.html('Reconnect Account');
                }
                $addRemoveButton.attr('disabled',true).addClass('sbi_remove_from_user_feed').removeClass('sbi_use_in_user_feed');
                $(this).removeClass('sbi_account_active');
            } else if (targetClass === 'hashtag') {
                $addRemoveButton.hide();
                $addRemoveButton.attr('disabled',true).addClass('sbi_remove_from_user_feed').removeClass('sbi_use_in_user_feed');
                $(this).removeClass('sbi_account_active');
            } else {
                $addRemoveButton.show();
                if (isSelected.indexOf(accountID) > -1) {
                    $addRemoveButton.html('<i class="fa fa-minus-circle" aria-hidden="true" style="margin-right: 5px;"></i>Remove from Primary Feed');
                    $addRemoveButton.addClass('sbi_remove_from_user_feed').removeClass('sbi_use_in_user_feed');
                    $(this).addClass('sbi_account_active');
                } else {
                    $addRemoveButton.html('<i class="fa fa-plus-circle" aria-hidden="true"></i>Add to Primary Feed');
                    $addRemoveButton.removeClass('sbi_remove_from_user_feed');
                    $addRemoveButton.addClass('sbi_use_in_user_feed');
                    $(this).removeClass('sbi_account_active');
                }
            }


            if ($(this).find('.sbi_remove_from_user_feed').length ) {
                $(this).find('.sbi_remove_from_user_feed').off();
                sbiInitUserRemove($(this).find('.sbi_remove_from_user_feed'));
            } else {
                $(this).find('.sbi_use_in_user_feed').off();
                sbiInitUserAdd($(this).find('.sbi_use_in_user_feed'),'user');
            }

        });
    }sbiConAccountsAddRemoveUpdater();

    $('input[name=sb_instagram_type]').change(sbiConAccountsAddRemoveUpdater);



    $body.on('click', '.sbi_ca_show_token', function(event) {
        jQuery(this).closest('.sbi_ca_info').find('.sbi_ca_accesstoken').slideToggle(200);
    });

    $('#sbi_manual_submit').click(function(event) {
        event.preventDefault();
        var $self = $(this);
        var accessToken = $('#sb_manual_at').val(),
            error = false;
        if (sbiIsBusinessToken() && $('.sbi_manual_account_id_toggle').find('input').val().length < 3) {
            error = true;
            if (!$('.sbi_manually_connect_wrap').find('.sbi_user_id_error').length) {
                $('.sbi_manually_connect_wrap').show().prepend('<div class="sbi_user_id_error" style="display:block;">Please enter a valid User ID for this Business account.</div>');
            }
        } else {
            error = false;
        }
        if (accessToken.length < 15) {
            if (!$('.sbi_manually_connect_wrap').find('.sbi_user_id_error').length) {
                $('.sbi_manually_connect_wrap').show().prepend('<div class="sbi_user_id_error" style="display:block;">Please enter a valid access token</div>');
            }
        } else if (! error) {
            $(this).attr('disabled',true);
            $(this).closest('.sbi_manually_connect_wrap').fadeOut();
            $('.sbi_connected_accounts_wrap').fadeTo("slow" , 0.5).find('.sbi_user_id_error').remove();

            jQuery.ajax({
                url: sbiA.ajax_url,
                type: 'post',
                data: {
                    action: 'sbi_test_token',
                    access_token: accessToken,
                    account_id : $('.sbi_manual_account_id_toggle').find('input').val().trim(),
                    sbi_nonce: sbiA.sbi_nonce
                },
                success: function (data) {
                    $('.sbi_connected_accounts_wrap').fadeTo("slow" , 1);
                    $self.removeAttr('disabled');
                    if ( data.indexOf('{') > -1) {
                        var savedToken = JSON.parse(data);
                        if (typeof savedToken.url !== 'undefined') {
                            window.location.href = savedToken.url;
                        } else {
                            $(this).closest('.sbi_manually_connect_wrap').fadeOut();
                            $('#sb_manual_at, .sbi_manual_account_id_toggle input').val('');
                            sbiAfterUpdateToken(savedToken,false);
                        }

                    } else {
                        $('.sbi_manually_connect_wrap').show().prepend('<div class="sbi_user_id_error" style="display:block;">'+data+'</div>');
                    }

                }
            });
        }

    });

    //clear backup caches
    jQuery('#sbi_clear_backups').click(function(event) {
        jQuery('.sbi-success').remove();
        event.preventDefault();
        jQuery.ajax({
            url: sbiA.ajax_url,
            type: 'post',
            data: {
                action: 'sbi_clear_backups',
                access_token: token,
                just_tokens: true,
                sbi_nonce: sbiA.sbi_nonce
            },
            success: function (data) {
                jQuery('#sbi_clear_backups').after('<span class="sbi-success"><i class="fa fa-check-circle"></i></span>');
            }
        });
    });

    //Tooltips
    jQuery('#sbi_admin').on('click', '.sbi_tooltip_link, .sbi_type_tooltip_link', function(){
        if( jQuery(this).hasClass('sbi_type_tooltip_link') ){
            jQuery(this).closest('.sbi_row').children('.sbi_tooltip').slideToggle();
        } else {
            $el = jQuery(this);
            if( jQuery(this).hasClass('sbi_tooltip_outside') ) $el = jQuery(this).parent();
            $el.siblings('.sbi_tooltip').slideToggle();
        }
    });

    if (jQuery('input[name=sb_instagram_type]:checked').val() !== 'hashtag') jQuery('.sbi_radio_reveal').hide();
    function sbiToggleOrder() {
        if (jQuery('input[name=sb_instagram_type]:checked').val() === 'hashtag') {
            jQuery('.sbi_radio_reveal').slideDown();
        } else {
            jQuery('.sbi_radio_reveal').slideUp();
        }
    }
    sbiToggleOrder();
    jQuery('input[name=sb_instagram_type]').change(function(){
        sbiToggleOrder();
    });

    //Extra Info
    function sbiToggleInfo(elem) {
        if(elem.is(':checked')) {
            elem.siblings('.sbi_extra_info').slideDown();
        } else {
            elem.siblings('.sbi_extra_info').slideUp();
        }
    }
    sbiToggleInfo(jQuery('#sbi_admin #sb_instagram_moderation_mode'));
    jQuery('#sbi_admin #sb_instagram_moderation_mode').click(function(){
        sbiToggleInfo(jQuery(this));
    });

    //Update the shortcode when input is added
    function sbiToggleIncExCode(elem,type) {
        var str = elem.val();
        elem.siblings('.sbi_incex_shortcode').find('code').text(type+'="'+str+'"');
        if(jQuery('#sb_instagram_incex_one').is(':checked')){
            elem.siblings('.sbi_incex_shortcode').show();
        }
    }
    sbiToggleIncExCode(jQuery('#sbi_admin #sb_instagram_exclude_words'), 'excludewords');
    sbiToggleIncExCode(jQuery('#sbi_admin #sb_instagram_include_words'), 'includewords');
    jQuery('#sbi_admin #sb_instagram_exclude_words, #sbi_admin #sb_instagram_include_words').keyup(function(){
        if(jQuery(this).attr('id') == 'sb_instagram_exclude_words') {
            sbiToggleIncExCode(jQuery(this), 'excludewords');
        } else {
            sbiToggleIncExCode(jQuery(this), 'includewords');
        }
    });

    //Reveal or hide the shortcode generator
    function sbiToggleShortcodeGen($el) {
        if($el.is(':checked') && $el.val() === 'one'){
            $el.closest('td').find('.sbi_incex_shortcode').slideDown();
        } else {
            $el.closest('td').find('.sbi_incex_shortcode').slideUp();
        }
    }
    jQuery('.sb_instagram_incex_one_all').click(function() {
        sbiToggleShortcodeGen(jQuery(this));
        sbiToggleIncExCode(jQuery('#sbi_admin #sb_instagram_exclude_words'), 'excludewords');
        sbiToggleIncExCode(jQuery('#sbi_admin #sb_instagram_include_words'), 'includewords');
    });

    function sbiToggleVisualManual($el) {
        if ($el.is(':checked') && $el.val() === 'visual'){
            $el.closest('td').find('.sbi_tooltip').slideDown();
        } else {
            $el.closest('td').find('.sbi_tooltip').slideUp();
        }
        if ($el.is(':checked') && $el.val() === 'manual'){
            $('.sbi_mod_manual_settings').slideDown();
        } else if (jQuery('#sb_instagram_moderation_mode_visual').is(':checked')) {
            $('.sbi_mod_manual_settings').slideUp();
        }
    }
    jQuery('.sb_instagram_moderation_mode').click(function() {
        sbiToggleVisualManual(jQuery(this));
    });
    jQuery('.sb_instagram_moderation_mode').each(function() {
        sbiToggleVisualManual(jQuery(this));
    });
    //sb_instagram_enable_email_report
    function sbiToggleEmail() {
        if (jQuery('#sb_instagram_enable_email_report').is(':checked')) {
            jQuery('#sb_instagram_enable_email_report').closest('td').find('.sb_instagram_box').slideDown();
        } else {
            jQuery('#sb_instagram_enable_email_report').closest('td').find('.sb_instagram_box').slideUp();
        }
    }sbiToggleEmail();
    jQuery('#sb_instagram_enable_email_report').change(sbiToggleEmail);
    if (jQuery('#sbi-goto').length) {
        jQuery('#sbi-goto').closest('tr').addClass('sbi-goto');
        $('html, body').animate({
            scrollTop: $('#sbi-goto').offset().top - 200
        }, 500);
    }


    jQuery('.sb_instagram_mobile_layout_setting').hide();
    jQuery('.sb_instagram_mobile_layout_reveal').click(function() {
        if (jQuery(this).siblings('.sb_instagram_mobile_layout_setting').is(':visible')) {
            jQuery(this).siblings('.sb_instagram_mobile_layout_setting').slideUp();
            jQuery(this).siblings('.sb_instagram_mobile_layout_reveal').html('Show Mobile Options');
        } else {
            jQuery(this).siblings('.sb_instagram_mobile_layout_setting').slideDown();
            jQuery(this).siblings('.sb_instagram_mobile_layout_reveal').html('Hide Mobile Options');
        }
    });
    jQuery('#sbi_show_advanced').hide();
    jQuery('.sbi_show_advanced_reveal').click(function() {
        if (jQuery('#sbi_show_advanced').is(':visible')) {
            jQuery('#sbi_show_advanced').slideUp();
        } else {
            jQuery('#sbi_show_advanced').slideDown();
        }
    });

    // clear white lists
    var $sbiClearWhiteListsButton = $('#sbi_admin #sbi_clear_white_lists'),
        $sbiClearPermanentWhiteListsButton = $('#sbi_admin #sbi_clear_permanent_white_lists');

    $sbiClearWhiteListsButton.click(function(event) {
        event.preventDefault();

        jQuery('#sbi-clear-cache-success').remove();
        jQuery(this).prop("disabled",true);

        $.ajax({
            url : sbiA.ajax_url,
            type : 'post',
            data : {
                action : 'sbi_clear_white_lists',
            },
            success : function(data) {
                $sbiClearWhiteListsButton.prop('disabled',false);
                if(!data===false) {
                    $sbiClearWhiteListsButton.after('<i id="sbi-clear-cache-success" class="fa fa-check-circle sbi-success"></i>');
                    jQuery('.sbi_white_list_names_wrapper span').fadeOut();
                } else {
                    $sbiClearWhiteListsButton.after('<span>error</span>');
                }
            }
        }); // ajax call
    }); // clear_white_lists click

    $sbiClearPermanentWhiteListsButton.click(function(event) {
        event.preventDefault();

        jQuery('#sbi-clear-cache-success').remove();
        jQuery(this).prop("disabled",true);

        $.ajax({
            url : sbiA.ajax_url,
            type : 'post',
            data : {
                action : 'sbi_disable_permanent_white_lists'
            },
            success : function(data) {
                $sbiClearPermanentWhiteListsButton.prop('disabled',false);
                $sbiClearPermanentWhiteListsButton.after('<i id="sbi-clear-cache-success" class="fa fa-check-circle sbi-success"></i>');
                jQuery('.sbi_white_list_perm span').fadeOut();
            }
        }); // ajax call
    }); // clear_permanent_white_lists click

    // clear white lists
    var $sbiClearCommentCacheButton = $('#sbi_admin #sbi_clear_comment_cache');

    $sbiClearCommentCacheButton.click(function(event) {
        event.preventDefault();

        jQuery('#sbi-clear-cache-success').remove();
        jQuery(this).prop("disabled",true);

        $.ajax({
            url : sbiA.ajax_url,
            type : 'post',
            data : {
                action : 'sbi_clear_comment_cache'
            },
            success : function(data) {
                $sbiClearCommentCacheButton.prop('disabled',false);
                if(!data===false) {
                    $sbiClearCommentCacheButton.after('<i id="sbi-clear-cache-success" class="fa fa-check-circle sbi-success"></i>');
                } else {
                    $sbiClearCommentCacheButton.after('<span>error</span>');
                }
            }
        }); // ajax call
    }); // clear_comment_cache click

    //sbi_reset_resized
    // clear resized
    var $sbiClearResizedButton = $('#sbi_reset_resized');

    $sbiClearResizedButton.click(function(event) {
        event.preventDefault();

        jQuery('#sbi-clear-cache-success').remove();
        jQuery(this).prop("disabled",true);

        $.ajax({
            url : sbiA.ajax_url,
            type : 'post',
            data : {
                action : 'sbi_reset_resized'
            },
            success : function(data) {
                $sbiClearResizedButton.prop('disabled',false);
                if(data=='1') {
                    $sbiClearResizedButton.after('<i id="sbi-clear-cache-success" class="fa fa-check-circle sbi-success"></i>');
                } else {
                    $sbiClearResizedButton.after('<span>error</span>');
                }
            }
        }); // ajax call
    }); // clear_comment_cache click

    //sbi_reset_log
    var $sbiClearLog = $('#sbi_reset_log');

    $sbiClearLog.click(function(event) {
        event.preventDefault();

        jQuery('#sbi-clear-cache-success').remove();
        jQuery(this).prop("disabled",true);

        $.ajax({
            url : sbiA.ajax_url,
            type : 'post',
            data : {
                action : 'sbi_reset_log'
            },
            success : function(data) {
                $sbiClearLog.prop('disabled',false);
                if(data=='1') {
                    $sbiClearLog.after('<i id="sbi-clear-cache-success" class="fa fa-check-circle sbi-success"></i>');
                } else {
                    $sbiClearLog.after('<span>error</span>');
                }
            }
        }); // ajax call
    }); // clear_comment_cache click


    jQuery('#sbi_admin th label, #sbi_admin .sb_instagram_layout_setting label, #sbi_admin .sb_instagram_box_setting label, #sbi_admin .sbi_shortcode_label').click(function(){
        var $el = jQuery(this).parent();
        // if( $el.parent().hasClass('sb_instagram_layout_setting' ) ) $el = $el.parent();

        var $sbi_shortcode = $el.find('.sbi_shortcode');
        if($sbi_shortcode.is(':visible')){
            $el.find('.sbi_shortcode').css('display','none');
        } else {
            $el.find('.sbi_shortcode').css('display','block');
        }
    });

    //Mixed feed directions
    jQuery('#sbi_admin .sbi_mixed_directions .sbi_col').click(function(){
        jQuery(this).parent().find('.sbi_tooltip').slideToggle();
    });

    //Shortcode label on hover
    jQuery('#sbi_admin th, #sbi_admin .sb_instagram_layout_setting label, #sbi_admin .sb_instagram_box_setting label, #sbi_admin .sbi_shortcode_label').hover(function(){
        var $el = $el_title = jQuery(this);
        if( $el.parent().hasClass('sb_instagram_layout_setting' ) || $el.parent().hasClass('sb_instagram_box_setting' ) ) $el = $el.parent();

        if( $el.find('.sbi_shortcode').length > 0 ){
            if( $el.hasClass('sbi_shortcode_label' ) ){
                $el.append('<code class="sbi_shortcode_symbol">[]</code>');
            } else {
                $el.find('label').append('<code class="sbi_shortcode_symbol">[]</code>');
            }
        }
    }, function(){
        jQuery(this).find('.sbi_shortcode_symbol').remove();
    });

    jQuery('#sbi_admin label').hover(function(){
        if( jQuery(this).siblings('.sbi_shortcode').length > 0 ){
            jQuery(this).attr('title', 'Click for shortcode option');
        }
    }, function(){});

    //Add the color picker
    if( jQuery('.sbi_colorpick').length > 0 ) jQuery('.sbi_colorpick').wpColorPicker();

    //Mobile width
    var sb_instagram_feed_width = jQuery('#sbi_admin #sb_instagram_width').val(),
        sb_instagram_width_unit = jQuery('#sbi_admin #sb_instagram_width_unit').val(),
        $sb_instagram_width_options = jQuery('#sbi_admin #sb_instagram_width_options');

    if (typeof sb_instagram_feed_width !== 'undefined') {

        //Show initially if a width is set
        if( (sb_instagram_feed_width.length > 1 && sb_instagram_width_unit == 'px') || (sb_instagram_feed_width !== '100' && sb_instagram_width_unit == '%') ) $sb_instagram_width_options.show();

        jQuery('#sbi_admin #sb_instagram_width, #sbi_admin #sb_instagram_width_unit').change(function(){
            sb_instagram_feed_width = jQuery('#sbi_admin #sb_instagram_width').val();
            sb_instagram_width_unit = jQuery('#sbi_admin #sb_instagram_width_unit').val();

            if( sb_instagram_feed_width.length < 2 || (sb_instagram_feed_width == '100' && sb_instagram_width_unit == '%') ) {
                $sb_instagram_width_options.slideUp();
            } else {
                $sb_instagram_width_options.slideDown();
            }
        });

    }

    //Scroll to hash for quick links
    jQuery('#sbi_admin a').click(function() {
        if (location.pathname.replace(/^\//,'') == this.pathname.replace(/^\//,'') && location.hostname == this.hostname) {
            var target = jQuery(this.hash);
            target = target.length ? target : this.hash.slice(1);
            if (target.length) {
                jQuery('html,body').animate({
                    scrollTop: target.offset().top
                }, 500);
                return false;
            }
        }
    });

    //Boxed header options
    var sb_instagram_header_style = $('#sb_instagram_header_style').val(),
        $sb_instagram_header_style_boxed_options = $('#sb_instagram_header_style_boxed_options');

    //Should we show anything initially?
    if(sb_instagram_header_style == 'boxed'){
        $sb_instagram_header_style_boxed_options.show();
    } else {
        $sb_instagram_header_style_boxed_options.hide();
    }

    //When page type is changed show the relevant item
    $('#sb_instagram_header_style').change(function(){
        sb_instagram_header_style = $('#sb_instagram_header_style').val();

        if( sb_instagram_header_style == 'boxed' ) {
            $sb_instagram_header_style_boxed_options.fadeIn();
        } else {
            $sb_instagram_header_style_boxed_options.fadeOut();
        }
    });

    //sb_instagram_sort

    function sbiSortbyExplanation() {
        if ($('select[name=sb_instagram_sort]').val() === 'likes') {
            $('.sbi_likes_explain').slideDown();
        } else {
            $('.sbi_likes_explain').slideUp();
        }
    }sbiSortbyExplanation();
    $('select[name=sb_instagram_sort]').change(sbiSortbyExplanation);

    //Support tab show video
    jQuery('#sbi-play-support-video').on('click', function(e){
        e.preventDefault();
        jQuery('#sbi-support-video').show().attr('src', jQuery('#sbi-support-video').attr('src')+'&amp;autoplay=1' );
    });

    function sbiUpdateLayoutTypeOptionsDisplay() {
        setTimeout(function(){
            jQuery('.sb_instagram_layout_settings').hide();
            jQuery('.sb_instagram_layout_settings.sbi_layout_type_'+jQuery('.sb_layout_type:checked').val()).show();
        }, 1);
    }
    sbiUpdateLayoutTypeOptionsDisplay();
    jQuery('.sb_layout_type').change(sbiUpdateLayoutTypeOptionsDisplay);

    function sbiUpdateHighlightOptionsDisplay() {
        jQuery('.sb_instagram_highlight_sub_options').hide();
        var selected = jQuery('#sb_instagram_highlight_type').val();

        if (selected === 'pattern') {
            jQuery('.sb_instagram_highlight_pattern').show();
        } else if (selected === 'id') {
            jQuery('.sb_instagram_highlight_ids').show();
        } else {
            jQuery('.sb_instagram_highlight_hashtag').show();
        }

    }
    sbiUpdateHighlightOptionsDisplay();
    jQuery('#sb_instagram_highlight_type').change(sbiUpdateHighlightOptionsDisplay);

    function sbiUpdateStoryOptionsDisplay() {
        jQuery('input[name=sb_instagram_stories]').closest('td').find('.sb_instagram_box').slideUp();
        var selected = jQuery('input[name=sb_instagram_stories]').is(':checked');

        if (selected) {
            jQuery('input[name=sb_instagram_stories]').closest('tr').find('.sb_instagram_box').slideDown();
        }

    }
    sbiUpdateStoryOptionsDisplay();
    jQuery('input[name=sb_instagram_stories]').change(sbiUpdateStoryOptionsDisplay);

    //Open/close the expandable option sections
    jQuery('.sbi-expandable-options').hide();
    jQuery('.sbi-expand-button a').on('click', function(e){
        e.preventDefault();
        var $self = jQuery(this);
        $self.parent().next('.sbi-expandable-options').toggle();
        if( $self.text().indexOf('Show') !== -1 ){
            $self.text( $self.text().replace('Show', 'Hide') );
        } else {
            $self.text( $self.text().replace('Hide', 'Show') );
        }
    });

    //Selecting a post layout
    jQuery('.sbi_layout_cell').click(function(){
        var $self = jQuery(this);
        $('.sb_layout_type').trigger('change');
        $self.addClass('sbi_layout_selected').find('.sb_layout_type').attr('checked', 'checked');
        $self.siblings().removeClass('sbi_layout_selected');
    });

    // disable welcome page
    jQuery('.sbi-redirect-disable').click(function(event) {
        event.preventDefault();

        var $self = jQuery(this);

        $self.css('opacity', .5);
        $self.prop("disabled",true);

        $.ajax({
            url : sbiA.ajax_url,
            type : 'post',
            data : {
                action : 'sbi_disable_welcome'
            },
            success : function(data) {
                if(data=='1') {
                    $self.html('<i id="sbi-clear-cache-success" class="fa fa-check-circle sbi-success"></i>').css('opacity', 1).removeAttr('href');
                } else {
                    $self.html('<span>error</span>');
                }
            }
        }); // ajax call
    });

    //Caching options
    if( jQuery('#sbi_caching_type_page').is(':checked') ) {
        jQuery('.sbi-caching-cron-options').hide();
        jQuery('.sbi-caching-page-options').show();
    } else {
        jQuery('.sbi-caching-page-options').hide();
        jQuery('.sbi-caching-cron-options').show();
    }

    $('input[type=radio][name=sbi_caching_type]').change(function() {
        if (this.value == 'page') {
            jQuery('.sbi-caching-cron-options').slideUp();
            jQuery('.sbi-caching-page-options').slideDown();
        }
        else if (this.value == 'background') {
            jQuery('.sbi-caching-page-options').slideUp();
            jQuery('.sbi-caching-cron-options').slideDown();
        }
    });


    //Should we show the caching time settings?
    var sbi_cache_cron_interval = jQuery('#sbi_cache_cron_interval').val(),
        $sbi_caching_time_settings = jQuery('#sbi-caching-time-settings');

    //Should we show anything initially?
    if(sbi_cache_cron_interval == '30mins' || sbi_cache_cron_interval == '1hour') $sbi_caching_time_settings.hide();

    jQuery('#sbi_cache_cron_interval').change(function(){
        sbi_cache_cron_interval = jQuery('#sbi_cache_cron_interval').val();

        if(sbi_cache_cron_interval == '30mins' || sbi_cache_cron_interval == '1hour'){
            $sbi_caching_time_settings.hide();
        } else {
            $sbi_caching_time_settings.show();
        }
    });
    sbi_cache_cron_interval = jQuery('#sbi_cache_cron_interval').val();

    if(sbi_cache_cron_interval == '30mins' || sbi_cache_cron_interval == '1hour'){
        $sbi_caching_time_settings.hide();
    } else {
        $sbi_caching_time_settings.show();
    }

    setTimeout( function() {
        jQuery('.notice-dismiss').click(function() {
            if (jQuery(this).closest('.sbi-admin-notice').length) {

                if (jQuery(this).closest('.sbi-admin-notice').find('.sbi-admin-error').length) {

                    var exemptErrorType = jQuery(this).closest('.sbi-admin-notice').find('.sbi-admin-error').attr('data-sbi-type');

                    if (exemptErrorType === 'ajax') {
                        jQuery.ajax({
                            url: sbiA.ajax_url,
                            type: 'post',
                            data: {
                                action : 'sbi_on_ajax_test_trigger',
                                sbi_nonce: sbiA.sbi_nonce
                            },
                            success: function (data) {
                            }
                        });
                    }
                }
            }
        });
    },1500);


    /* removing padding */
    if (jQuery('#sbi-admin-about').length) {
        jQuery('#wpcontent').css('padding', 0);
    }

    /* Clear errors visit page */
    jQuery('.sbi-error-directions a').addClass('button button-primary');
    jQuery('.sbi-error-directions.sbi-reconnect a').click(function(){
        event.preventDefault();
        jQuery('.sbi_admin_btn').trigger('click');
    });
    jQuery('.sbi-clear-errors-visit-page').appendTo('.sbi-error-directions');
    jQuery('.sbi-clear-errors-visit-page').click(function(event) {
        event.preventDefault();
        var $btn = jQuery(this);
        $btn.prop( 'disabled', true ).addClass( 'loading' ).html('<i class="fa fa-spinner fa-spin" aria-hidden="true"></i>');
        $.ajax({
            url : sbiA.ajax_url,
            type : 'post',
            data : {
                action : 'sbi_reset_log'
            },
            success : function(data) {
                window.location.href = $btn.attr('href');
            },
            error : function(data)  {
                window.location.href = $btn.attr('href');
            }
        }); // ajax call
    })
});


/* global smash_admin, jconfirm, wpCookies, Choices, List */

(function($) {

    'use strict';

    // Global settings access.
    var s;

    // Admin object.
    var SmashAdmin = {

        // Settings.
        settings: {
            iconActivate: '<i class="fa fa-toggle-on fa-flip-horizontal" aria-hidden="true"></i>',
            iconDeactivate: '<i class="fa fa-toggle-on" aria-hidden="true"></i>',
            iconInstall: '<i class="fa fa-cloud-download" aria-hidden="true"></i>',
            iconSpinner: '<i class="fa fa-spinner fa-spin" aria-hidden="true"></i>',
            mediaFrame: false
        },

        /**
         * Start the engine.
         *
         * @since 1.3.9
         */
        init: function() {

            // Settings shortcut.
            s = this.settings;

            // Document ready.
            $( document ).ready( SmashAdmin.ready );

            // Addons List.
            SmashAdmin.initAddons();
        },

        /**
         * Document ready.
         *
         * @since 1.3.9
         */
        ready: function() {

            // Action available for each binding.
            $( document ).trigger( 'smashReady' );
        },

        //--------------------------------------------------------------------//
        // Addons List.
        //--------------------------------------------------------------------//

        /**
         * Element bindings for Addons List page.
         *
         * @since 1.3.9
         */
        initAddons: function() {

            // Some actions have to be delayed to document.ready.
            $( document ).on( 'smashReady', function() {

                // Only run on the addons page.
                if ( ! $( '#sbi-admin-addons' ).length ) {
                    return;
                }

                // Display all addon boxes as the same height.
                $( '.addon-item .details' ).matchHeight( { byrow: false, property: 'height' } );

                // Addons searching.
                if ( $('#sbi-admin-addons-list').length ) {
                    var addonSearch = new List( 'sbi-admin-addons-list', {
                        valueNames: [ 'addon-name' ]
                    } );

                    $( '#sbi-admin-addons-search' ).on( 'keyup', function () {
                        var searchTerm = $( this ).val(),
                            $heading = $( '#addons-heading' );

                        if ( searchTerm ) {
                            $heading.text( sbi_admin.addon_search );
                        }
                        else {
                            $heading.text( $heading.data( 'text' ) );
                        }

                        addonSearch.search( searchTerm );
                    } );
                }
            });

            // Toggle an addon state.
            $( document ).on( 'click', '#sbi-admin-addons .addon-item button', function( event ) {

                event.preventDefault();

                if ( $( this ).hasClass( 'disabled' ) ) {
                    return false;
                }

                SmashAdmin.addonToggle( $( this ) );
            });
        },

        /**
         * Toggle addon state.
         *
         * @since 1.3.9
         */
        addonToggle: function( $btn ) {

            var $addon = $btn.closest( '.addon-item' ),
                plugin = $btn.attr( 'data-plugin' ),
                plugin_type = $btn.attr( 'data-type' ),
                action,
                cssClass,
                statusText,
                buttonText,
                errorText,
                successText;

            if ( $btn.hasClass( 'status-go-to-url' ) ) {
                // Open url in new tab.
                window.open( $btn.attr('data-plugin'), '_blank' );
                return;
            }

            $btn.prop( 'disabled', true ).addClass( 'loading' );
            $btn.html( s.iconSpinner );

            if ( $btn.hasClass( 'status-active' ) ) {
                // Deactivate.
                action     = 'sbi_deactivate_addon';
                cssClass   = 'status-inactive';
                if ( plugin_type === 'plugin' ) {
                    cssClass += ' button button-secondary';
                }
                statusText = sbi_admin.addon_inactive;
                buttonText = sbi_admin.addon_activate;
                if ( plugin_type === 'addon' ) {
                    buttonText = s.iconActivate + buttonText;
                }
                errorText  = s.iconDeactivate + sbi_admin.addon_deactivate;

            } else if ( $btn.hasClass( 'status-inactive' ) ) {
                // Activate.
                action     = 'sbi_activate_addon';
                cssClass   = 'status-active';
                if ( plugin_type === 'plugin' ) {
                    cssClass += ' button button-secondary disabled';
                }
                statusText = sbi_admin.addon_active;
                buttonText = sbi_admin.addon_deactivate;
                if ( plugin_type === 'addon' ) {
                    buttonText = s.iconDeactivate + buttonText;
                } else if ( plugin_type === 'plugin' ) {
                    buttonText = sbi_admin.addon_activated;
                }
                errorText  = s.iconActivate + sbi_admin.addon_activate;

            } else if ( $btn.hasClass( 'status-download' ) ) {
                // Install & Activate.
                action   = 'sbi_install_addon';
                cssClass = 'status-active';
                if ( plugin_type === 'plugin' ) {
                    cssClass += ' button disabled';
                }
                statusText = sbi_admin.addon_active;
                buttonText = sbi_admin.addon_activated;
                if ( plugin_type === 'addon' ) {
                    buttonText = s.iconActivate + sbi_admin.addon_deactivate;
                }
                errorText = s.iconInstall + sbi_admin.addon_activate;

            } else {
                return;
            }

            var data = {
                action: action,
                nonce : sbi_admin.nonce,
                plugin: plugin,
                type  : plugin_type
            };
            $.post( sbi_admin.ajax_url, data, function( res ) {

                if ( res.success ) {
                    if ( 'sbi_install_addon' === action ) {
                        $btn.attr( 'data-plugin', res.data.basename );
                        successText = res.data.msg;
                        if ( ! res.data.is_activated ) {
                            cssClass = 'status-inactive';
                            if ( plugin_type === 'plugin' ) {
                                cssClass = 'button';
                            }
                            statusText = sbi_admin.addon_inactive;
                            buttonText = s.iconActivate + sbi_admin.addon_activate;
                        }
                    } else {
                        successText = res.data;
                    }
                    $addon.find( '.actions' ).append( '<div class="msg success">'+successText+'</div>' );
                    $addon.find( 'span.status-label' )
                        .removeClass( 'status-active status-inactive status-download' )
                        .addClass( cssClass )
                        .removeClass( 'button button-primary button-secondary disabled' )
                        .text( statusText );
                    $btn
                        .removeClass( 'status-active status-inactive status-download' )
                        .removeClass( 'button button-primary button-secondary disabled' )
                        .addClass( cssClass ).html( buttonText );
                } else {
                    if ( 'download_failed' === res.data[0].code ) {
                        if ( plugin_type === 'addon' ) {
                            $addon.find( '.actions' ).append( '<div class="msg error">'+sbi_admin.addon_error+'</div>' );
                        } else {
                            $addon.find( '.actions' ).append( '<div class="msg error">'+sbi_admin.plugin_error+'</div>' );
                        }
                    } else {
                        $addon.find( '.actions' ).append( '<div class="msg error">'+res.data+'</div>' );
                    }
                    $btn.html( errorText );
                }

                $btn.prop( 'disabled', false ).removeClass( 'loading' );

                // Automatically clear addon messages after 3 seconds.
                setTimeout( function() {
                    $( '.addon-item .msg' ).remove();
                }, 3000 );

            }).fail( function( xhr ) {
                console.log( xhr.responseText );
            });
        },

    };

    SmashAdmin.init();

    window.SmashAdmin = SmashAdmin;

})( jQuery );