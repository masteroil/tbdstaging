/* global wcsatt_admin_params */
(function($, window, undefined) {
	function wcs_toolbox() {
		var popup_opened = false;
		var self         = this;

		this.init = function() {
			$( document.body ).on(
				'click',
				'.skip_next',
				function(e){
					e.preventDefault();
					self.showPopup( 'skip_next', $( this ).attr( 'href' ) );
				}
			);

			$( document.body ).on(
				'click',
				'.ship_now_keep_date',
				function(e){
					e.preventDefault();
					self.showPopup( 'ship_now_keep_date', $( this ).attr( 'href' ) );
				}
			);

			$( document.body ).on(
				'click',
				'.ship_now_recalculate',
				function(e){
					e.preventDefault();
					self.showPopup( 'ship_now_recalculate', $( this ).attr( 'href' ) );
				}
			);

			$( document.body ).on(
				'click',
				'.wcs-toolbox-action[data-type=cancel]',
				function(e) {
					e.preventDefault();
					self.hidePopup();
				}
			);

			$( document.body ).one(
				'click',
				'.wcs-toolbox-action[data-type=yes]',
				function(e) {
					e.preventDefault();
					var link = $('.action-yes').attr('href');
					// hide popup, but keep overlay so button can't be pressed again.
					$('.wcs-toolbox-popup').hide();
					window.location.href = link;
				}
			);
		}

		this.showPopup = function showPopup( type, href ) {
			this.buildPopup( type, href );
			this.openPopup();
			this.togglePopup();
		}

		this.hidePopup = function hidePopup() {
			this.closePopup();
			this.togglePopup();
			this.destroyPopup();
		}

		this.destroyPopup = function destroyPopup() {
			$( '.wcs-toolbox-popup-overlay' ).remove();
		}

		this.buildPopup = function buildPopup( type, href ) {
			var text   = window.wcs_toolbox.text[ type ],
				yes    = window.wcs_toolbox.text['yes'],
				cancel = window.wcs_toolbox.text['cancel'];

			var html = '<div class="wcs-toolbox-popup-overlay">';
			html += '<div class="wcs-toolbox-popup">';
			html += '<h2>' + text + '</h2>';
			html += '<div class="wcs-toolbox-popup-actions">';
			html += '<button type="button" class="wcs-toolbox-action" data-type="cancel">' + cancel + '</button>';
			html += '<a href="' + href + '" class="wcs-toolbox-action action-yes" data-type="yes">' + yes + '</a>';
			html += '</div>';
			html += '</div>';
			html += '</div>'

			$('body').append( html );
		}

		this.openPopup = function() {
			popup_opened = true;
			this.togglePopup();
		}

		this.closePopup = function() {
			popup_opened = false;
			this.togglePopup();
		}

		this.togglePopup = function() {
			if ( popup_opened ) {
				$( 'html' ).addClass( 'wcs-toolbox-popup-opened' );
			} else {
				$( 'html' ).removeClass( 'wcs-toolbox-popup-opened' );
			}
		}

		return this;
	}
	$(
		function() {
			var new_date_input = $( '#pickadate' );

			new_date_input.datepicker(
				{
					dateFormat: "yy-mm-dd",
					minDate: 1,
					maxDate: "+6m"
				}
			);

			var toolbox = wcs_toolbox();
			toolbox.init();
		}
	);
}(window.jQuery, window));
