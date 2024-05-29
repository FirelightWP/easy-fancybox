(function($) {
	$( document ).ready( function() {
		var container = $('.efb-review-notice');
		if ( container.length ) {
			container.find( '.efb-review-actions a' ).click(function() {
				container.remove();
				var rateAction = $( this ).attr( 'data-rate-action' );
				$.post(
					ajaxurl,
					{
						action: 'efb-review-action',
						rate_action: rateAction,
						_n: container.find( 'ul:first' ).attr( 'data-nonce' )
					},
					function( result ) {}
				);

				if ( 'do-rate' !== rateAction ) {
					return false;
				}
			});
		}
	});
})( jQuery );
