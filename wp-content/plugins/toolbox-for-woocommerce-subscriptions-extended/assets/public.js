'use strict';

(function($){
    function getEnhancedSelectFormatString() {
        return {
            'language': {
                errorLoading: function() {
                    // Workaround for https://github.com/select2/select2/issues/4355 instead of i18n_ajax_error.
                    return wc_enhanced_select_params.i18n_searching;
                },
                inputTooLong: function( args ) {
                    var overChars = args.input.length - args.maximum;

                    if ( 1 === overChars ) {
                        return wc_enhanced_select_params.i18n_input_too_long_1;
                    }

                    return wc_enhanced_select_params.i18n_input_too_long_n.replace( '%qty%', overChars );
                },
                inputTooShort: function( args ) {
                    var remainingChars = args.minimum - args.input.length;

                    if ( 1 === remainingChars ) {
                        return wc_enhanced_select_params.i18n_input_too_short_1;
                    }

                    return wc_enhanced_select_params.i18n_input_too_short_n.replace( '%qty%', remainingChars );
                },
                loadingMore: function() {
                    return wc_enhanced_select_params.i18n_load_more;
                },
                maximumSelected: function( args ) {
                    if ( args.maximum === 1 ) {
                        return wc_enhanced_select_params.i18n_selection_too_long_1;
                    }

                    return wc_enhanced_select_params.i18n_selection_too_long_n.replace( '%qty%', args.maximum );
                },
                noResults: function() {
                    return wc_enhanced_select_params.i18n_no_matches;
                },
                searching: function() {
                    return wc_enhanced_select_params.i18n_searching;
                }
            }
        };
    }

    function productSearch() {
        $(':input.wcte-product-search').val(null);
        // Ajax product search box
        $(':input.wcte-product-search').not('.enhanced').each(function () {
            var $this = $(this);

            $(this).selectWoo({
                minimumResultsForSearch: -1,
                dropdownCssClass: 'wcte-dropdown'
            }).addClass('enhanced');

            $this.on('select2:select', function (e) {
                var value = $(this).val();
                if ( value ) {
                    $.ajax({
                        url: wcte.ajaxurl,
                        method: 'GET',
                        data: {
                            action: 'get_wcte_item_row',
                            product_id: value,
                            nonce: wcte.nonce,
                            subscription: $this.attr('data-subscription')
                        },
                        success: function(resp){
                            if (resp.success) {
                                var exclude = JSON.parse( $this.attr('data-exclude') );
                                exclude.push(value);
                                $this.attr('data-exclude', JSON.stringify( exclude ));
                                $( resp.data.html ).insertBefore($this.parents('tbody').find('.wcte_new_order_item'));
                                //$this.parents('form').find('.order_details tbody').append( resp.data.html )
                                $this.find("option[value='" + value + "']").remove();

                            } else {
                                alert(resp.data.message);
                            }
                            $('.wcte_new_order_item').toggleClass('hidden');
                            $this.val(null).trigger('change');
                        }
                    })
                }
            })

        }).val(null);
    }

    $(function(){

        $(document.body).on( 'click', '.wcte-remove-item', function(e){
           e.preventDefault();
           $(this).parents('tr').remove();
        });

        $('.wcte-show-product-search').on( 'click', function(e){
            e.preventDefault();
            productSearch();
            $('.wcte_new_order_item').toggleClass('hidden');
        });

        $(document.body).on( 'change', '.wcte_quantity', function(){
           var item_id = $(this).attr('data-item-id'),
               product_total = $('#wcteProductTotal_' + item_id ),
               price         = product_total.attr('data-price'),
               currencyHTML  = product_total.find('.woocommerce-Price-currencySymbol').html(),
               amount        = product_total.find('.woocommerce-Price-amount'),
               decimals      = product_total.attr( 'data-decimals' ),
               qty           = $(this).val(),
               total         = parseFloat( qty * parseFloat( price ) ).toFixed(decimals);

            amount.html('').append(currencyHTML).append(total);
        });
    });

})(jQuery);