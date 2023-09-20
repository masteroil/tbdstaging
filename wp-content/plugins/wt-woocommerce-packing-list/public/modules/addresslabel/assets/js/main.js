(function( $ ) {
	'use strict';
	$(function() {
		setTimeout(function () {
	        addresslabel_select_customize.Set();
		}, 1000);
		
		$('.wf_cst_change_addrlabel').change(function(){
			var ind=$(this).val();
			if(ind==""){ return false; }
			var trgt_elm=$('.wf_default_template_list_item:eq('+ind+')').find('.wfte_hidden_template_html');
			if(trgt_elm.length>0)
			{				
				/* taking current inner HTML */
				var current_code=$('#wfte_code').val();
				var temp_elm=$('<div />').html(current_code);
				var inner_html=temp_elm.find('.wfte_addresslabel_data').html();
				/* applying new config to current inner HTML */
				var template_html=trgt_elm.html();
				temp_elm=$('<div />').html(template_html);
				temp_elm.find('.wfte_addresslabel_data').html(inner_html);
				template_html=temp_elm.html();
				$('#wfte_code').val(template_html);
				pklist_customize.updateFromCodeView();
			}
		});

		$('.wf_cst_change_addrtype').change(function(){
			var ind=$('.wf_cst_change_addrlabel').val();
			if(ind==""){ return false; }
			var trgt_elm=$('.wf_default_template_list_item:eq('+ind+')').find('.wfte_hidden_template_html');
			if(trgt_elm.length>0)
			{
				var addr_type = $(this).val();
				var addr_class = "wfte_"+addr_type;
				var updated_html = '<div class="wfte_addresslabel_address"><div class="'+addr_class+'">['+addr_class+'][wfte_addresslabel_extradata]</div></div>';
				var current_code=$('#wfte_code').val();
				var temp_elm=$('<div />').html(current_code);
				var inner_html=temp_elm.find('.wfte_addresslabel_data').html();
				/* applying new config to current inner HTML */
				var template_html=trgt_elm.html();
				temp_elm=$('<div />').html(template_html);
				temp_elm.find('.wfte_addresslabel_data').html(inner_html);
				temp_elm.find('.wfte_addr_col').html(updated_html);
				template_html=temp_elm.html();
				$('#wfte_code').val(template_html);
				pklist_customize.updateFromCodeView();
			}
		});
	});

	var addresslabel_select_customize = {
		Set:function(){
			var row = $("table.wfte_addresslabel_data").attr('data-rows');
			var column = $("table.wfte_addresslabel_data").attr('data-columns');
			var l_height = $("table.wfte_addresslabel_data").attr('data-height');
			var l_width = $("table.wfte_addresslabel_data").attr('data-width');
			var select_id = 0;

			var layout = {
				"row_5": 1, 
				"row_3": 2,
				"row_7": 3,
				"row_20": 5,
				"row_15": 6,
				"row_6": 8,
				"row_1":9
			};
			if(row == "10"){
				if(column == "3" && l_height == "1"){
					select_id = 0;
				}else if(column == "3"){
					select_id = 7;
				}else{
					select_id = 4;
				} 
			}else{
				var row_key = "row_"+row;
				select_id = layout[row_key];
			}
			$(".wf_cst_change_addrlabel").val(select_id);

			var addr_class = $(".wfte_addresslabel_address").children().first().attr('class');    
		    if(addr_class.indexOf("billing_address") !== -1){
		        $('.wf_cst_change_addrtype').val('billing_address');
		    }else if(addr_class.indexOf("from_address") !== -1){
		    	$('.wf_cst_change_addrtype').val('from_address');
		    }else if(addr_class.indexOf("return_address") !== -1){
		    	$('.wf_cst_change_addrtype').val('return_address');
		    }else{
		    	$('.wf_cst_change_addrtype').val('shipping_address');
		    }
		}
	}
})( jQuery );