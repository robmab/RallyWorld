/*! Custom Sidebars - v3.2.3
 * Copyright (c) 2020; * Licensed GPLv2+ */
/*! Custom Sidebars - v3.2.3
 * Copyright (c) 2020; * Licensed GPLv2+ */
;(function ($) {
	if ( window.WPMUDEV_CS_AdminNotification ) {
		return;
	}

	window.WPMUDEV_CS_AdminNotification = {
		ajax_action: 'custom_sidebars_retirement_notice_dismiss',

		init () {
			document.addEventListener( 'click', function( event ) {
				if ( ! event.target.matches( '#wpmudev-cs-retirement-notice button.notice-dismiss' ) ) {
					return;
				}

				let _self = WPMUDEV_CS_AdminNotification;
				event.preventDefault();
				_self.mark_dismissed();
			});
		},

		mark_dismissed() {
			let _self = WPMUDEV_CS_AdminNotification,
				data = {
					action  : _self.ajax_action,
					user_id : CS_Notice.user_id,
					nonce   : CS_Notice.nonce
				} ;

			$.post( ajaxurl, data, function( response ) {
				if( response.success ){
					document.querySelector( '#wpmudev-cs-retirement-notice' ).style.display = 'none';
				}
			});
		}
	}

	document.addEventListener( 'DOMContentLoaded', function() {
		WPMUDEV_CS_AdminNotification.init();
	});
})(jQuery);
