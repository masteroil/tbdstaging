var pklist_dc_row=(function( $ ) {

	var pklist_dc_row=
	{
		/**
		*	Remove row border and editor panel
		*/
		remove_row_border:function()
		{
			pklist_dc.selected_row=null;
			$('.wt_pklist_dc_layout_preview_box').trigger('blur');
			this.hide_row_edit_popup();
			$('.wfte_row').removeClass('wt_pklist_dc_row_hover');
			$('.wt_pklist_dc_editor_panel').remove();
			$('.wfte_row').find('.wt_pklist_dc_empty_column').css('border','');
		},

		/**
		*	Set row border on hover
		*/
		set_row_border:function(elm)
		{
			var row=this.get_row(elm);
			if(row && this.selected_row && row.attr('data-wfte-id')==this.selected_row.attr('data-wfte-id'))
			{
				return false;
			}

			this.remove_row_border();
			
			if(row)
			{
				this.selected_row=row;
				row.addClass('wt_pklist_dc_row_hover');
				this.set_row_editor_panel(row);
				row.find('.wt_pklist_dc_empty_column').css('border','dashed 1px #C8C8C9');
			}
		},

		set_row_editor_panel:function(elm)
		{
			/* add editing panel */
			if(elm.find('.wt_pklist_dc_editor_panel').length==0)
			{
				$('.wt_pklist_dc_editor_panel').remove();
				elm.prepend(pklist_dc.editor_panel);
				var editor_panel_html='<div class="wt_pklist_dc_editor_panel_btn_box">';
				editor_panel_html+='<span class="editor_btn wt_pklist_dc_editor_edit_btn" title="'+wt_pklist_dc_params.labels.edit_row+'"><i class="material-icons" style="width:24px;">edit_outline</i></span>';
				editor_panel_html+='<span class="editor_btn wt_pklist_dc_editor_delete_btn" title="'+wt_pklist_dc_params.labels.delete_row+'"><i class="material-icons">delete_outline</i></span>';
				var w=37*2; /* width of above 6 buttons */
				if(!elm.hasClass('template_footer')){
					editor_panel_html+='<span class="editor_btn wt_pklist_dc_editor_insertafter_btn" title="'+wt_pklist_dc_params.labels.insert_after+'"></span>';
					editor_panel_html+='<span class="editor_btn wt_pklist_dc_editor_insertbefore_btn" title="'+wt_pklist_dc_params.labels.insert_before+'"></span>';						
					editor_panel_html+='<span class="editor_btn wt_pklist_dc_editor_movedown_btn" title="'+wt_pklist_dc_params.labels.move_down+'"><i class="material-icons">keyboard_arrow_down</i></span>';
					editor_panel_html+='<span class="editor_btn wt_pklist_dc_editor_moveup_btn" title="'+wt_pklist_dc_params.labels.move_up+'"><i class="material-icons">keyboard_arrow_up</i></span>';
					w=37*6; /* width of above 6 buttons */
				}
				editor_panel_html+='</div>';

				
				var pos=elm.position();
				var posl=parseFloat(pos.left)+parseFloat(elm.css('margin-left'));
				var post=parseFloat(pos.top)+parseFloat(elm.css('margin-top'));
				elm.find('.wt_pklist_dc_editor_panel').html(editor_panel_html).css({'left':posl, 'top':post, 'width':w});
			}
		},

		do_row_moveup:function(row)
		{
			var prev_row=row.prevAll('.wfte_row').first();
			if(prev_row.length>0)
			{
				/* check there is a clearfix div */
				var prev=row.prev();
				row.insertBefore(prev_row);

				if(prev.length>0 && prev.attr('class').trim()=='clearfix')
				{
					prev.insertBefore(prev_row);
				}
			}
		},


		do_row_movedown:function(row)
		{
			var next_row=row.nextAll('.wfte_row').first();
			if(next_row.length>0)
			{
				/* check there is a clearfix div */
				var nxt=row.next();
				row.insertAfter(next_row);
				if(nxt.length>0 && nxt.attr('class').trim()=='clearfix')
				{
					nxt.insertAfter(next_row);
				}
			}
		},

		hide_row_edit_popup:function()
		{
			$('.wt_pklist_dc_edit_row').hide();
		},

		show_row_edit_popup:function(row, btn_elm)
		{
			var pos=row.position();
			var posl=pos.left;
			var post=pos.top;
			$('.wt_pklist_dc_layout_preview_box').hide();
			$('.wt_pklist_dc_color_picker_close').click();
			this.remove_editable_selected(true);
			var row_popup=$('.wt_pklist_dc_edit_row');
				
			row_popup.show().css({'opacity':0, 'left':posl, 'top':post}).stop(true, true).animate({'opacity':1, 'top':post+3}, 200); 

			pklist_dc.row_popup_rowelm=row;
			pklist_dc.row_popup_btnelm=btn_elm;

			this.set_row_property_editor();
		},

		set_row_editor_color_picker:function()
		{
			$('.wt_pklist_dc_edit_row .wt_pklist_dc_color_picker_input').each(function(){
				var elm=$(this);

				/* enable picker, if not already */
				if(elm.attr('data-color_picker_enabled')!=1)
	            {
	                elm.iris({
	                    change: function(event, ui) {
	                        var elm=$(event.target);
	                        var prev_elm=elm.siblings('.wt_pklist_dc_color_preview');
	                        var color_vl=ui.color.toString();
	                        prev_elm.css({'background-color': color_vl});
	                        prev_elm.removeClass('wt_pklist_dc_color_preview_transparent');

	                        elm.val(color_vl);
	                        var prop=elm.attr('data-css-property');
	                        pklist_dc.row_popup_rowelm.css(prop, color_vl);

	                        pklist_dc.source_apply_prop(pklist_dc.row_popup_rowelm, prop, color_vl, 'css'); /* to source code */
	                        pklist_dc.add_history(); /* save for undo redo */
	                    }
	                });
	                elm.attr('data-color_picker_enabled', 1);
	            }
			});
			
			/* color picker open */
            $(document).on('click', '.wt_pklist_dc_color_picker_input, .wt_pklist_dc_edit_row .wt_pklist_dc_color_preview', function(){
             	
             	var elm=$(this);

	            if(elm.hasClass('wt_pklist_dc_color_preview'))
	            {
	                elm=elm.siblings('.wt_pklist_dc_color_picker_input');
	            }

	            if(elm.siblings('.iris-picker').length>0 && elm.siblings('.iris-picker').is(':visible'))
	            {
	            	elm.iris('hide');
	            	return false;
	            }

	            $('.wt_pklist_dc_color_picker_input[data-color_picker_enabled="1"]').iris('hide');
            	elm.iris('show');

            	setTimeout(function(){          
	                var picker_box=elm.siblings('.iris-picker');
	                if(picker_box.find('.wt_pklist_dc_color_picker_close').length===0)
	                {
	                    var h=parseInt(picker_box.height());
	                    picker_box.css({'height':h+30}); 
	                    picker_box.find('.iris-picker-inner').append('<div class="wt_pklist_dc_color_picker_close">'+wt_pklist_dc_params.labels.close+'</div>');
	                    picker_box.find('.wt_pklist_dc_color_picker_close').data('target_input', elm);
	                }
	            }, 200);

            });

            /* color picker close */
            $(document).on('click', '.wt_pklist_dc_color_picker_close', function(){
	            $(this).data('target_input').iris('hide');
	        });
		},

		/**
		 * 	Register row form field action events
		 */
		reg_row_editor_events:function()
		{

			$('.wt_pklist_dc_edit_row .wt_pklist_dc_row_editor_input[type="text"]').on('keyup', function(){
				var elm=$(this);
				var prop=elm.attr('data-css-property');
				var val=elm.val();
				pklist_dc.row_popup_rowelm.css(prop, val);
				pklist_dc.source_apply_prop(pklist_dc.row_popup_rowelm, prop, val, 'css'); /* to source code */

				pklist_dc.add_history(); /* save for undo redo */
			});

			/* border section */
			$('.wt_pklist_dc_edit_row select.wt_pklist_dc_row_editor_input').on('change', function(){
				var elm=$(this);
				var prop=elm.attr('data-css-property');
				var side=elm.attr('data-side');
				var val=elm.val();
				pklist_dc.row_popup_rowelm.css(prop, val);
				pklist_dc.source_apply_prop(pklist_dc.row_popup_rowelm, prop, val, 'css'); /* to source code */
				
				var border_size_prop='border-'+side+'-width';
				var border_size=$('.wt_pklist_dc_edit_row .wt_pklist_dc_row_editor_input[data-css-property="'+border_size_prop+'"]').val();
				pklist_dc.row_popup_rowelm.css(border_size_prop, border_size);
				pklist_dc.source_apply_prop(pklist_dc.row_popup_rowelm, border_size_prop, border_size, 'css'); /* to source code */

				pklist_dc.add_history(); /* save for undo redo */
			});
		},

		/**
		 * 	Read row properties and populate in the form fields 
		 */
		set_row_property_editor:function()
		{
			$('.wt_pklist_dc_edit_row .wt_pklist_dc_row_editor_input').each(function(){
				var elm=$(this);
				var prop=elm.attr('data-css-property');
				var value=pklist_dc.row_popup_rowelm.css(prop);
				elm.val(value);

				if(elm.hasClass('wt_pklist_dc_color_picker_input'))
				{
					var color_preview_elm=elm.siblings('.wt_pklist_dc_color_preview');
					if(pklist_dc.get_alpha_value_from_color(value)==0)
					{
						var color_string='transparent';
						var color_vl='';
						color_preview_elm.addClass('wt_pklist_dc_color_preview_transparent');
					}else
					{
						var color_string=Color(value).toString();
						var color_vl=color_string;
						color_preview_elm.removeClass('wt_pklist_dc_color_preview_transparent');
					}

					/* set current color preview */
					color_preview_elm.css({'background-color':color_string});
					elm.val(color_vl).attr('data-default', color_string)
				}
			});
		},

		/**
		*	Popup to show available row options
		*	Show row popup on click
		*/
		show_row_popup:function(row, btn_elm)
		{
			var pos=row.position();
			var posl=pos.left;
			var post=pos.top;
			this.hide_row_edit_popup();
			this.remove_editable_selected(true);
			var row_popup=$('.wt_pklist_dc_layout_preview_box');
			
			if(row.is('.wt_pklist_dc_empty_editor'))
			{
				post=parseInt(post)+parseInt(row.outerHeight());
				posl=parseInt(posl)+parseInt(row.css('margin-left'))+(parseInt(row.outerWidth()/2) - parseInt(row_popup.outerWidth()/2));
			}
					
			row_popup.trigger('blur');			
			row_popup.show().css({'opacity':0, 'left':posl, 'top':post}).stop(true, true).animate({'opacity':1, 'top':post+3}, 200, function(){
				$(this).focus();
			});

			pklist_dc.row_popup_rowelm=row;
			pklist_dc.row_popup_btnelm=btn_elm;	
		},

		/**
		*	Popup to show available row options
		*	Handle row popup related events.
		*	Eg: Insert new row
		*/
		set_row_popup:function()
		{
			var row_popup=$('.wt_pklist_dc_layout_preview_box');
			
			row_popup.on('blur', function(){
			    if(pklist_dc.row_popup_rowelm && pklist_dc.row_popup_rowelm.hasClass('wt_pklist_dc_empty_editor'))
			    {
			    	/* do not close the popup */
			    }else
			    {
			    	$(this).hide();
			    }
			});

			row_popup.unbind('mouseover').on('mouseover', function(){
				if(pklist_dc.row_popup_rowelm)
				{
					pklist_dc.set_row_border(pklist_dc.row_popup_rowelm);
				}
			});

			row_popup.find('.wfte_row').unbind('click').on('click', function(){
				if(!pklist_dc.row_popup_rowelm || !pklist_dc.row_popup_btnelm)
				{
					return false;
				}

				var row=pklist_dc.row_popup_rowelm;
				var btn_elm=pklist_dc.row_popup_btnelm;

				var elm=$(this).clone();
				elm=pklist_dc.add_dom_element_id(elm);

				var clearfix_elm=$('<div class="clearfix"></div>');
				clearfix_elm=pklist_dc.add_dom_element_id(clearfix_elm);

				/* source code */
				var source_elm=elm.clone();
				var source_row=pklist_dc.get_source_elm_from_visual_elm(row);
				var source_clearfix_elm=clearfix_elm.clone();

				elm=pklist_dc.set_droppable_elements(elm);
				if(btn_elm.hasClass('wt_pklist_dc_editor_insertafter_btn'))
				{
					/* source code */
					if(source_row)
					{
						source_row.after(source_elm);
						source_row.after(source_clearfix_elm);
					}

					row.after(elm);
					row.after(clearfix_elm);
				}else
				{
					/* source code */
					if(source_row)
					{
						source_row.before(source_elm);
						source_row.before(source_clearfix_elm);
					}

					row.before(elm);
					row.before(clearfix_elm);
				}
				pklist_dc.row_popup_rowelm=null;
				row_popup.trigger('blur');
				if(row.is('.wt_pklist_dc_empty_editor'))
				{
					/* if the template is empty then add the new row directly to the editor/main element */
					var editor_elm=$('.wt_pklist_dc_code_editor');
					var main_elm=$('.wt_pklist_dc_visual_editor').find('[data-wfte_name="'+pklist_dc.page_wfte_name+'"]');
					if(main_elm.length===0) /* check there is main page element exists */
					{
						main_elm=editor_elm;
					}else{
						main_elm=pklist_dc.get_source_elm_from_visual_elm(main_elm); /* find source element */
					}
					main_elm.append(source_clearfix_elm);
					main_elm.append(source_elm);

					row.remove(); /* remove the empty editor placeholder */
				}
				pklist_dc.add_history(); /* save for undo redo */
			});
		},

		/**
		*	Register row related action events
		*/
		set_row_editable:function()
		{
			$('body').on('mouseover', function(e){
				if($(e.target).parents('.wt_pklist_dc_visual_editor').length===0 
					&& $(e.target).parents('.wt_pklist_dc_layout_preview_box').length===0 
					&& !$(e.target).hasClass('wt_pklist_dc_layout_preview_box')
					&& $(e.target).parents('.wt_pklist_dc_edit_row').length===0 
					&& !$(e.target).hasClass('wt_pklist_dc_edit_row')
				)
				{
					pklist_dc.remove_row_border();		
				}
			});

			$(document).on('mouseover', '.wt_pklist_dc_visual_editor .wfte_row', function(){
				pklist_dc.set_row_border($(this));
			});

			$(document).on('mouseout', '.wt_pklist_dc_visual_editor .wfte_row', function(e){
				pklist_dc.set_row_border($(e.target));
			});

			$(document).on('mouseover', '.wt_pklist_dc_visual_editor .template_footer', function(){
				pklist_dc.set_row_border($(this));
			});

			$(document).on('mouseout', '.wt_pklist_dc_visual_editor .template_footer', function(e){
				pklist_dc.set_row_border($(e.target));
			});

			$(document).on('mouseover', '.wt_pklist_dc_editor_panel', function(e){ 				
				e.stopPropagation();
				var elm=$(this);
				pklist_dc.set_row_border(elm);
			});

			/* move up/down/delete */
			$(document).on('click', '.wt_pklist_dc_editor_panel_btn_box .editor_btn', function(e){ 				
				e.stopPropagation();
				var elm=$(this);
				var row=pklist_dc.get_row(elm);
				if(row)
				{
					if(elm.hasClass('wt_pklist_dc_editor_moveup_btn'))
					{
						pklist_dc.remove_row_border();
						pklist_dc.do_row_moveup(row);

						/* source code */
						var source_row=pklist_dc.get_source_elm_from_visual_elm(row);
						pklist_dc.do_row_moveup(source_row);
						pklist_dc.add_history(); /* save for undo redo */

					}else if(elm.hasClass('wt_pklist_dc_editor_movedown_btn'))
					{
						pklist_dc.remove_row_border();
						pklist_dc.do_row_movedown(row);

						/* source code */
						var source_row=pklist_dc.get_source_elm_from_visual_elm(row);
						pklist_dc.do_row_movedown(source_row);
						pklist_dc.add_history(); /* save for undo redo */
					}
					else if(elm.hasClass('wt_pklist_dc_editor_delete_btn'))
					{
						if(row.text().trim()!="" || row.find('img').length>0) /* non empty columns found, ask confirmation */
						{	
							var confirm_text = wt_pklist_dc_params.labels.sure;
							if(row.hasClass('template_footer')){
								confirm_text = wt_pklist_dc_params.labels.footer_delete_prompt;
							}
							if(confirm(confirm_text))
							{
								/* source code */
								pklist_dc.source_row_delete(row);

								row.remove();
								pklist_dc.check_and_remove_editable_selected();
							}
						}else
						{
							/* source code */
							pklist_dc.source_row_delete(row);

							row.remove();
							pklist_dc.check_and_remove_editable_selected();							
						}
						pklist_dc.add_no_row_div();
						pklist_dc.add_history(); /* save for undo redo */
					}
					else if(elm.hasClass('wt_pklist_dc_editor_insertafter_btn') || elm.hasClass('wt_pklist_dc_editor_insertbefore_btn'))
					{
						pklist_dc.show_row_popup(row, elm);
					}
					else if(elm.hasClass('wt_pklist_dc_editor_edit_btn'))
					{
						pklist_dc.show_row_edit_popup(row, elm);
					}
					
				}
			});

			$(document).on('click', '.wt_pklist_dc_empty_editor', function(){
				pklist_dc.show_row_popup($(this), $(this));
			});

			$('.wt_pklist_dc_edit_row_close_btn').on('click', function(){
				pklist_dc.hide_row_edit_popup();
			});

			this.set_row_popup(); /* handle row_popup actions */
			this.set_row_editor_color_picker();
			this.reg_row_editor_events();
		},

		/**
		 *  If no rows present in the editor, shows an option to create new rows
		 * 
		 */
		add_no_row_div:function()
		{
			$('.wt_pklist_dc_layout_preview_box').hide(); /* hide row adding box if open */
			if($('.wt_pklist_dc_visual_editor .wfte_row').length==0) /* no row */
			{
				var editor_elm=$('.wt_pklist_dc_visual_editor');
				var main_elm=editor_elm.find('[data-wfte_name="'+pklist_dc.page_wfte_name+'"]');
				if(main_elm.length===0) /* check there is main page element exists */
				{
					main_elm=editor_elm;
				}
				main_elm.append('<div class="wt_pklist_dc_empty_editor"></div>'); /* use append. May be other non wfte elements are there */
			}
		},

		/**
		*	get holding of an element row 
		*/
		get_row:function(elm) 
		{
			var row=null;
			if(!elm.hasClass('wfte_row'))
			{	
				if(elm.hasClass('template_footer')){
					row=elm;
				}else{
					var parent_row=elm.parents('.wfte_row');
					var footer_parent_row=elm.parents('.template_footer');
					if(parent_row.length>0)
					{
						row=parent_row;
					}else if(footer_parent_row.length > 0){
						row=footer_parent_row;
					}
				}
			}else
			{
				row=elm;
			}
			return row;
		},
	}
	return pklist_dc_row;

})( jQuery );