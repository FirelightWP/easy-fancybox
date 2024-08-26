(function($) {
	$('#basic-purchase').on('click', function (e) {
		var basicHandler = FS.Checkout.configure({
			plugin_id:  '15188',
			plan_id:    '25303',
			public_key: 'pk_a82dd43b11d3bf7b055b47c428513',
			image:      'https://firelightwp.com/wp-content/uploads/2024/03/icon-300px.png',
            trial:      ! settings.hasLitePlan
		});
		basicHandler.open({
			name     : 'Firelight Pro - Basic',
			licenses : $('#basic-licenses').val(),
			// You can consume the response for after purchase logic.
			purchaseCompleted  : function (response) {
				// The logic here will be executed immediately after the purchase confirmation.
				// alert(response.user.email);
			},
			success  : function (response) {
				// The logic here will be executed after the customer closes the checkout, after a successful purchase.                                
				// alert(response.user.email);
			}
		});
		e.preventDefault();
	});
	
	$('#pro-purchase').on('click', function (e) {
		var proHandler = FS.Checkout.configure({
			plugin_id:  '15188',
			plan_id:    '25304',
			public_key: 'pk_a82dd43b11d3bf7b055b47c428513',
			image:      'https://firelightwp.com/wp-content/uploads/2024/03/icon-300px.png',
            trial:      ! settings.hasLitePlan
		});
		proHandler.open({
			name     : 'Firelight Pro',
			licenses : $('#pro-licenses').val(),
			// You can consume the response for after purchase logic.
			purchaseCompleted  : function (response) {
				// The logic here will be executed immediately after the purchase confirmation.
				// alert(response.user.email);
			},
			success  : function (response) {
				// The logic here will be executed after the customer closes the checkout, after a successful purchase.                                
				// alert(response.user.email);
			}
		});
		e.preventDefault();
	});
	
	$('#enterprise-purchase').on('click', function (e) {
		var enterpriseHandler = FS.Checkout.configure({
			plugin_id:  '15188',
			plan_id:    '25330',
			public_key: 'pk_a82dd43b11d3bf7b055b47c428513',
			image:      'https://firelightwp.com/wp-content/uploads/2024/03/icon-300px.png',
            trial:      ! settings.hasLitePlan
		});
		enterpriseHandler.open({
			name     : 'Firelight Pro - Enterprise',
			licenses : $('#enterprise-licenses').val(),
			// You can consume the response for after purchase logic.
			purchaseCompleted  : function (response) {
				// The logic here will be executed immediately after the purchase confirmation.
				// alert(response.user.email);
			},
			success  : function (response) {
				// The logic here will be executed after the customer closes the checkout, after a successful purchase.                                
				// alert(response.user.email);
			}
		});
		e.preventDefault();
	});
})( jQuery );
