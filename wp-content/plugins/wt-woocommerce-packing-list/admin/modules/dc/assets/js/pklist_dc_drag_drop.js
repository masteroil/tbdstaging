/**
 * 	This file handles drag and drop related actions
 */
var pklist_dc_drag_drop=(function( $ ) {

	var pklist_dc_drag_drop=
	{
		drag_elm_offsetx:0,
		drag_elm_offsety:0,
		last_no_drop_elm:null,
		drag_pagex:0,
		drag_pagey:0,
		set_draggable_elements:function(parnt)
		{
			$.each(wt_pklist_dc_params.draggable_elements, function(index, value){
				parnt.find('.wfte_'+value).addClass('wfte_draggable').attr('draggable', true);
			});
			return parnt;
		},

		set_droppable_elements:function(parnt)
		{
			parnt.find('*').filter(function() {
			    var css_class=typeof $(this).attr('class')!='undefined' ? $(this).attr('class') : '';
			    var matched=false;
			    var css_class_arr=css_class.split(" ");
				$.each(css_class_arr, function(css_index, css_value){
					if(!matched)
					{
					    $.each(wt_pklist_dc_params.droppable_elements, function(index, value){

					    	var rgx=new RegExp('^wfte_'+value, 'g');
					    	
					    	if(!matched)
					    	{
					    		matched=css_value.match(rgx);
					    	}else
					    	{
					    		return false; /* break the loop */
					    	}
					    });
					}else{
						return false; /* break the loop */
					}
				});
				
			    return matched;

			}).each(function(){				
				
				$(this).addClass('wfte_droppable');
				pklist_dc.handle_empty_column($(this));

			});

			return parnt;
		},

		/**
		*	This function handles drap and drop related actions
		*
		*/
		set_drag_and_drop:function()
		{		
			$(document).on('dragstart', '.wfte_draggable', function(e){
				var draggable_elm=pklist_dc.get_draggable($(e.target));
				if(!draggable_elm)
				{
					e.preventDefault();
					return false;
				}else
				{
					pklist_dc.on_drag_elm=draggable_elm;
					pklist_dc.drag_elm_offsetx=e.offsetX;
					pklist_dc.drag_elm_offsety=e.offsetY;
					$('.wt_pklist_dc_dragover').removeClass('wt_pklist_dc_dragover');
					if(!$(pklist_dc.on_drag_elm).hasClass('wt_pklist_dc_asset_item')) /* not from sidebar assets section */
					{
						pklist_dc.set_editable_selected(pklist_dc.on_drag_elm);
					}
				}
			});

			$(document).on('dragover', '.wt_pklist_dc_visual_editor *', function(e){
				e.preventDefault();
				e.stopPropagation();

				pklist_dc.drag_pagex=e.pageX;
				pklist_dc.drag_pagey=e.pageY;
				
				if(!$(e.target).hasClass('wfte_droppable'))
				{
					pklist_dc.last_no_drop_elm=$(e.target);
				}

				var droppable_elm=pklist_dc.get_droppable($(e.target));
				if(droppable_elm && !droppable_elm.hasClass('wt_pklist_dc_dragover'))
				{
					$('.wt_pklist_dc_dragover').removeClass('wt_pklist_dc_dragover');
					droppable_elm.addClass('wt_pklist_dc_dragover');
					pklist_dc.on_drop_elm=droppable_elm;
				}
			});

			 $(document).on('dragleave', '.wt_pklist_dc_visual_editor *', function(e){
				var droppable_elm=pklist_dc.get_droppable($(e.target));
				if(droppable_elm)
				{
					pklist_dc.on_drop_elm=droppable_elm;
				}
				$('.wt_pklist_dc_dragover').removeClass('wt_pklist_dc_dragover');			
			});  
			
			$('.wt_pklist_dc_visual_editor, .wt_pklist_dc_visual_editor *').on('drop', function(e){
				e.preventDefault();
			});

			$(document).on('drop dragend', '.wfte_droppable', function(e){
				e.preventDefault();
				if(!pklist_dc.on_drag_elm){ return false; }
				var target_elm=$(e.target);

				var drop_elm_parent=pklist_dc.on_drag_elm.parents('.wfte_droppable');
				var droppable_elm=pklist_dc.get_droppable(target_elm);
				
				var check_nearby_drop_elm=false;
				if(droppable_elm.length===0)
				{
					check_nearby_drop_elm=true;
				}else
				{
					if(e.type=='dragend' && pklist_dc.get_wfte_id(droppable_elm)==pklist_dc.get_wfte_id(drop_elm_parent))
					{
						check_nearby_drop_elm=true;
					}
				}
				e.pageX=pklist_dc.drag_pagex;
				e.pageY=pklist_dc.drag_pagey;

				if(check_nearby_drop_elm)
				{	
					var nearby_found=false;			
					if(pklist_dc.on_drop_elm)
					{
						if(pklist_dc.get_wfte_id(pklist_dc.on_drop_elm)!=pklist_dc.get_wfte_id(drop_elm_parent))
						{
							var x_diff=pklist_dc.on_drop_elm.offset().left-e.pageX;
							var y_diff=pklist_dc.on_drop_elm.offset().top-e.pageY;

							var go_forward_y=false;
							var go_forward_x=false;

							if(y_diff>=0) /* drag to top */
							{
								if(y_diff<=(pklist_dc.on_drag_elm.outerHeight()-pklist_dc.drag_elm_offsety))
								{
									go_forward_y=true;
								}
							}else{

								if(Math.abs(y_diff)<=(pklist_dc.on_drop_elm.outerHeight()+pklist_dc.drag_elm_offsety))
								{
									go_forward_y=true;
								}
							}

							if(x_diff>=0) /* drag to left */
							{
								if(x_diff<=(pklist_dc.on_drag_elm.outerWidth()-pklist_dc.drag_elm_offsetx))
								{
									go_forward_x=true;
								}
							}else{

								if(Math.abs(x_diff)<=(pklist_dc.on_drop_elm.outerWidth()+pklist_dc.drag_elm_offsetx))
								{
									go_forward_x=true;
								}
							}

							if(go_forward_x && go_forward_y)
							{
								droppable_elm=pklist_dc.on_drop_elm;
								nearby_found=true;
							}
						}
					}

					if(!nearby_found) /* no near by drop target found. So check last drag overed element(row) */
					{
						if(pklist_dc.last_no_drop_elm)
						{
							if(pklist_dc.last_no_drop_elm.find('.wfte_droppable').length==0) /* fallback code, May be the current row is a spacer row */
							{
								var drag_elm_parent_offset_top=drop_elm_parent.offset().top;
								var last_no_drop_elm_offset_top=pklist_dc.last_no_drop_elm.offset().top;
								if(drag_elm_parent_offset_top<last_no_drop_elm_offset_top) /* assumes dragging from top to bottom */
								{
									var next_row=pklist_dc.last_no_drop_elm.nextAll('.wfte_row').first();
									if(next_row.length>0)
									{
										var next_row_offset_top=next_row.offset().top;
										var drag_elm_offset_end=(parseInt(e.pageY)+parseInt(pklist_dc.on_drag_elm.outerHeight()-pklist_dc.drag_elm_offsety));
										if(next_row_offset_top<drag_elm_offset_end) /* the drag preview is now over the next row */
										{
											pklist_dc.last_no_drop_elm=next_row; /* set next row as last droppable element hovered */
										}
									}
								}else{ 
									var prev_row=pklist_dc.last_no_drop_elm.prevAll('.wfte_row').first();
									if(prev_row.length>0)
									{
										var prev_row_offset_end=prev_row.offset().top+prev_row.outerHeight();
										var drag_elm_offset_end=(e.pageY-pklist_dc.drag_elm_offsety);
										if(prev_row_offset_end>drag_elm_offset_end)
										{
											pklist_dc.last_no_drop_elm=prev_row; /* set prev row as last droppable element hovered */
										}
									}
								}
							}

							if(pklist_dc.last_no_drop_elm.find('.wfte_droppable').length>0)
							{	
								var drop_elm_w_half=pklist_dc.on_drag_elm.outerWidth()/2;
								var drop_elm_h_half=pklist_dc.on_drag_elm.outerHeight()/2;

								var calculated_pageX=(e.pageX+(drop_elm_w_half-pklist_dc.drag_elm_offsetx)); /* pageX in reference to the center of drag element */
								var calculated_pageY=(e.pageY+(drop_elm_h_half-pklist_dc.drag_elm_offsety)); /* pageY in reference to the center of drag element */	

								var nearest_distance=0;
								var nearest_distance_elm=null;
								pklist_dc.last_no_drop_elm.find('.wfte_droppable').each(function(){
										var elm=$(this);
										var elm_pos=elm.offset();
										var elm_l=parseInt(elm_pos.left);
										var elm_t=parseInt(elm_pos.top);
										var elm_w_half=parseInt(elm.outerWidth()/2);
										var elm_h_half=parseInt(elm.outerHeight()/2);

										var calculated_offsetx=elm_l+elm_w_half; /* offsetx with respect to element center */
										var calculated_offsety=elm_t+elm_h_half; /* offsety with respect to element center */

										/* just assume there is a right angle triangle so first we need to calculate the base side and height side */
										var base_ln=Math.abs(calculated_offsetx-calculated_pageX); /* base side length */
										var height_ln=Math.abs(calculated_offsety-calculated_pageY); /* height side length */

										/* find the opposite side length. That will be the distance */
										var opposite_ln=Math.sqrt(Math.pow(base_ln,2)+Math.pow(height_ln,2));

										if(!nearest_distance_elm)
										{
											nearest_distance_elm=elm;
											nearest_distance=opposite_ln;
										}else{
											if(nearest_distance>opposite_ln) /* current element is nearest than old one */
											{
												nearest_distance_elm=elm;
												nearest_distance=opposite_ln;
											}
										}

								});

								if(nearest_distance_elm)
								{
									droppable_elm=nearest_distance_elm;
								}else
								{
									return false;
								}
							}
						}else
						{
							return false;
						}
					}					
				}

				if($(pklist_dc.on_drag_elm).hasClass('wt_pklist_dc_asset_item')) /* dragged from sidebar */
				{
					var is_element_group_main_item=$(pklist_dc.on_drag_elm).hasClass('wt_pklist_dc_asset_element_group_main'); /* these lines must be above of the below clone method */
					var is_element_group_sub_item=$(pklist_dc.on_drag_elm).hasClass('wt_pklist_dc_asset_element_group_sub'); 
					var tab_content=$(pklist_dc.on_drag_elm).parents('.wt_pklist_dc_sidebar_tabaccord_content');

					if(is_element_group_main_item && tab_content.find('.wt_pklist_dc_asset_element_group_checkbox:checked').length==0)
					{
						droppable_elm.removeClass('wt_pklist_dc_dragover');
						wf_notify_msg.error(wt_pklist_dc_params.labels.no_items_to_drop);
						return false;
					}

					var asset_slug=$(pklist_dc.on_drag_elm).attr('data-slug');
					
					var asset_elm=pklist_dc.get_asset_visual_elm_by_wfte_name(asset_slug);
					var source_asset_elm=pklist_dc.get_asset_source_elm_by_wfte_name(asset_slug);
					pklist_dc.on_drag_elm=asset_elm.clone();
					pklist_dc.source_on_drag_elm=source_asset_elm.clone();

					var sub_parent_slug = null;
					if(is_element_group_main_item) /* check current asset item is an element group main item. If yes then check which elements are choosed to add */ 
					{
						tab_content.find('.wt_pklist_dc_asset_element_group_checkbox:not(:checked)').each(function(){
							var wfte_name=$(this).attr('data-slug');
							pklist_dc.on_drag_elm.find('[data-wfte_name="'+wfte_name+'"]').remove();
							pklist_dc.source_on_drag_elm.find('[data-wfte_name="'+wfte_name+'"]').remove();
						});

					}else if(is_element_group_sub_item) /* if this is an element group sub item, then it must be wrapped with its parent item */
					{
						var asset_parent_slug=tab_content.find('.wt_pklist_dc_asset_element_group_checkbox_main').attr('data-slug'); /* parent slug */
						
						var asset_parent_elm=pklist_dc.get_asset_visual_elm_by_wfte_name(asset_parent_slug); /* parent asset item */
						var source_asset_parent_elm=pklist_dc.get_asset_source_elm_by_wfte_name(asset_parent_slug); /* source parent asset item */
						
						pklist_dc.on_drag_elm=asset_parent_elm.clone();
						pklist_dc.source_on_drag_elm=source_asset_parent_elm.clone(); /* source element */


						/** 
						*	remove items other than current item 
						*/
						pklist_dc.on_drag_elm.children('*').not('[data-wfte_name="'+asset_slug+'"]').remove();
						pklist_dc.on_drag_elm.html(pklist_dc.on_drag_elm.html().trim())
						
						pklist_dc.source_on_drag_elm.children('*').not('[data-wfte_name="'+asset_slug+'"]').remove(); /* source element */
						pklist_dc.source_on_drag_elm.html(pklist_dc.source_on_drag_elm.html().trim());
						sub_parent_slug = asset_parent_slug;
					}


					
					/* preparing the new element for visual editor */
					if(droppable_elm.hasClass('wfte_'+sub_parent_slug)){
						droppable_elm.append(pklist_dc.on_drag_elm.html());
					}else{

						var parent_droppable=droppable_elm.parents('.wfte_droppable');
						if(parent_droppable.length>0)
						{
							droppable_elm=parent_droppable;
						}
						droppable_elm.append(pklist_dc.on_drag_elm);
					}
					
					pklist_dc.source_code_drop_asset(droppable_elm, pklist_dc.source_on_drag_elm);
					
					if(pklist_dc.open_editor_on_drag_from_assets)
					{
						/* adding editable selection to dropped element */
						setTimeout(function(){
							pklist_dc.set_editable_selected(pklist_dc.on_drag_elm);
						}, 200);
					}
				}else
				{
					pklist_dc.source_code_rearrange(droppable_elm, pklist_dc.on_drag_elm);

					droppable_elm.append(pklist_dc.on_drag_elm);
					pklist_dc.handle_empty_column(drop_elm_parent);

					/* adding editable selection to dropped element */
					setTimeout(function(){
						pklist_dc.set_editable_selected(pklist_dc.on_drag_elm);
					}, 200);				
				}			

				droppable_elm.removeClass('wt_pklist_dc_dragover wt_pklist_dc_empty_column wt_pklist_dc_empty_column_height_fix');
				$('.wt_pklist_dc_dragover').removeClass('wt_pklist_dc_dragover');
				pklist_dc.add_history(); /* save for undo redo */
				pklist_dc.set_row_border(target_elm);

			});	
		},

		/** 
		*	get draggable item, may be parent of current element or the elemnt itself 
		*/
		get_draggable:function(elm) 
		{
			var draggable=null;
			if(!elm.hasClass('wfte_draggable'))
			{
				var parent_draggable=elm.parents('.wfte_draggable');
				if(parent_draggable.length>0)
				{
					draggable=parent_draggable;
				}
			}else
			{
				draggable=elm;
			}
			return draggable;
		},

		/**
		*	get droppable item, may be parent of current element or the elemnt itself 
		*/	
		get_droppable:function(elm) 
		{
			var droppable=null;
			if(!elm.hasClass('wfte_droppable'))
			{	
				var invoice_data_parent = elm.parents('.wfte_invoice_data');
				if(invoice_data_parent.length > 0){
					droppable=invoice_data_parent;
				}else{
					var parent_droppable=elm.parents('.wfte_droppable');
					if(parent_droppable.length>0)
					{
						droppable=parent_droppable;
					}
				}
			}else
			{
				droppable=elm;
			}
			return droppable;
		},
	}
	return pklist_dc_drag_drop;
})( jQuery );