<?php return;
/**
 * This file exists solely to store the plugin translation strings, used only for PO parsing.
 */

// Appearance.
__('Set a border radius to create rounded corners. Higher is rounder.','easy-fancybox');

// Autopopup.
__('Link with ID matching URL hash','easy-fancybox');
__('First Image link','easy-fancybox');
__('First PDF link','easy-fancybox');
__('First SWF link','easy-fancybox');
__('First SVG link','easy-fancybox');
__('First VideoPress link','easy-fancybox');
__('First YouTube link','easy-fancybox');
__('First Vimeo link','easy-fancybox');
__('First Dailymotion link','easy-fancybox');
__('First iFrame link','easy-fancybox');
__('First of any link','easy-fancybox');

__('Treat popups on different URLs separately','easy-fancybox');

// Gallery section.
__('Links inside Section(s) only (below)','easy-fancybox');

// More easing effect names.
__('easeInQuad','easy-fancybox');
__('easeOutQuad','easy-fancybox');
__('easeInOutQuad','easy-fancybox');
__('easeInCubic','easy-fancybox');
__('easeOutCubic','easy-fancybox');
__('easeInOutCubic','easy-fancybox');
__('easeInQuart','easy-fancybox');
__('easeOutQuart','easy-fancybox');
__('easeInOutQuart','easy-fancybox');
__('easeInQuint','easy-fancybox');
__('easeOutQuint','easy-fancybox');
__('easeInOutQuint','easy-fancybox');
__('easeInSine','easy-fancybox');
__('easeOutSine','easy-fancybox');
__('easeInOutSine','easy-fancybox');
__('easeInExpo','easy-fancybox');
__('easeOutExpo','easy-fancybox');
__('easeInOutExpo','easy-fancybox');
__('easeInCirc','easy-fancybox');
__('easeOutCirc','easy-fancybox');
__('easeInOutCirc','easy-fancybox');
__('easeInElastic','easy-fancybox');
__('easeOutElastic','easy-fancybox');
__('easeInOutElastic','easy-fancybox');
__('easeInOutBack','easy-fancybox');
__('easeInBounce','easy-fancybox');
__('easeOutBounce','easy-fancybox');
__('easeInOutBounce','easy-fancybox');

// Advanced options.

__('Galleries per Section (below)','easy-fancybox');
__('This applies when <em>Apply to</em> is set to <em>Limited to Sections</em> and/or <em>Autogallery</em> is set to <em>Galleries per Section</em>. Adapt it to conform with your theme.','easy-fancybox');
__('Examples: If your theme wraps post content in a div with class post, change this value to "div.post". If you want to group images in a WordPress gallery together, use ".gallery,.wp-block-gallery,.tiled-gallery". If you want to include images in a sidebar with ID primary, add ", #primary".','easy-fancybox');
__('Hide/show title on mouse hover action works best with Overlay title position.','easy-fancybox');
__('Auto-rotation uses a fixed 3, 6, 9 or 12 second pause per image.','easy-fancybox');
__('(3 seconds)','easy-fancybox');
__('(6 seconds)','easy-fancybox');
__('(9 seconds)','easy-fancybox');
__('(12 seconds)','easy-fancybox');

// License page.
__( 'Easy FancyBox Pro License', 'easy-fancybox' );
__( 'License', 'easy-fancybox' );
__( 'Support', 'easy-fancybox' );
printf( /* Translators: Plugin name, renew your license (linked) */
	__( 'Enter your license key for %s.', 'easy-fancybox' ),
	'<a href="' . trailingslashit( self::$store_url ) . 'downloads/easy-fancybox-pro/" target="_blank">' . __( 'Easy FancyBox Pro', 'easy-fancybox' ) . '</a>'
);
__( 'An active license key grants you access to plugin updates and support. If a license key is absent, deactivated or expired, the plugin may continue to work properly but you will not receive automatic updates.', 'easy-fancybox' );
sprintf( /* Translators: Plugin name, Status301 Premium account (linked) */
	__( 'You can find your %1$s license key in your %2$s.', 'easy-fancybox' ),
	__( 'Easy FancyBox Pro', 'easy-fancybox' ),
	'<a href="https://premium.status301.com/account/" target="_blank">' . __( 'Status301 Premium account', 'easy-fancybox' ) . '</a>'
);
__( 'License key', 'easy-fancybox' );
__( 'Enter your license key.', 'easy-fancybox' );
_e( 'Your license is active for this site.', 'easy-fancybox' );

sprintf( /* Translators: Expiration date */
	__( 'It expires on %s.', 'easy-fancybox' ),
	$expires
);
sprintf( /* Translators: Plugin name */
	__( 'To receive updates for %s, please activate your license for this site.', 'easy-fancybox' ),
	__( 'Easy FancyBox Pro', 'easy-fancybox' )
);
sprintf( /* Translators: Premium Plugin name, renew your license (linked) */
	__( 'To continue receiving updates for %1$s, please %2$s.', 'easy-fancybox' ),
	__( 'Easy FancyBox Pro', 'easy-fancybox' ),
	'<a href="' . trailingslashit( self::$store_url ) . 'checkout/?edd_license_key=' . $key . '&download_id=' . self::$item_id . '" target="_blank">' . __( 'renew your license', 'easy-fancybox' ) . '</a>'
);
sprintf( /* Translators: Account (linked), Premium Plugin name */
	__( 'Please check your %1$s for possibilities to upgrade your %2$s license.', 'easy-fancybox' ),
	'<a href="' . trailingslashit( self::$store_url ) . 'account/' . $payment_path . '" target="_blank">' . __( 'Status301 Premium account', 'easy-fancybox' ) . '</a>',
	__( 'Easy FancyBox Pro', 'easy-fancybox' )
);

__( 'Beta version', 'easy-fancybox' );
sprintf( /* Translators: Premium Plugin name */
	__( 'Get updates for pre-release versions of %s.', 'easy-fancybox' ),
	__( 'Easy FancyBox Pro', 'easy-fancybox' )
);
__( 'This option will allow you to update the plugin to the latest beta release.', 'easy-fancybox' );
sprintf( /* Translators: Account (linked) */
	__( 'Please note: Auto-updates are blocked for non-stable versions. Disabling this option will <em>not</em> automatically revert the plugin to the latest stable release. To downgrade manually, first download the latest stable release from your %1$s and then install it via %2$s.', 'easy-fancybox' ),
	'<a href="' . trailingslashit( self::$store_url ) . 'account/downloads/" target="_blank">' . __( 'Status301 Premium account', 'easy-fancybox' ) . '</a>', '<a href="' . admin_url( 'plugin-install.php' ) . '?tab=upload">' . translate( 'Upload Plugin' ) . '</a>'
);

__( 'License action', 'easy-fancybox' );
__( 'Check license key', 'easy-fancybox' );
__( 'Activate license for this site', 'easy-fancybox' );
__( 'Deactivate license for this site', 'easy-fancybox' );
sprintf( /* Translators: Plugin name, Account (linked) */
	__( 'You can (de)activate your %1$s license from here or manage domains from your %2$s.', 'easy-fancybox' ),
	__( 'Easy FancyBox Pro', 'easy-fancybox' ),
	'<a href="' . trailingslashit( self::$store_url ) . 'account/' . $payment_path . '" target="_blank">' . __( 'Status301 Premium account', 'easy-fancybox' ) . '</a>'
);

// Admin notices.
sprintf( /* Translators: Premium Plugin name, Plugin name (linked) */
	__( 'To use the %1$s advanced options, please install %$2s.', 'easy-fancybox' ),
	__( 'Easy FancyBox Pro', 'easy-fancybox' ),
	'<a href="' . esc_url( network_admin_url( 'plugin-install.php?tab=plugin-information&plugin=easy-fancybox&TB_iframe=true&width=600&height=550' ) ) . '" target="_blank" class="thickbox">'.__( 'Easy FancyBox', 'easy-fancybox' ).'</a>'
);
sprintf( /* Translators: Premium Plugin name, Plugin name */
	__( 'In order to use %1$s, please activate %2$s.', 'easy-fancybox' ),
	__( 'Easy FancyBox Pro', 'easy-fancybox' ),
	'<strong>'.__( 'Easy FancyBox', 'easy-fancybox' ).'</strong>'
);
__( 'Notice: The current Easy FancyBox plugin version is not fully compatible with your version of the Pro extension. Some advanced options may not be functional.', 'easy-fancybox' );
printf( /* Translators: Plugin name (linked), version number */
	__( 'Please upgrade %1$s to version %2$s or later.', 'easy-fancybox' ),
	'<a href="' . esc_url( network_admin_url( 'plugin-install.php?tab=plugin-information&plugin=easy-fancybox&TB_iframe=true&width=600&height=550' ) ) . '" target="_blank" class="thickbox">'.__( 'Easy FancyBox', 'easy-fancybox' ).'</a>',
	self::$compat_min
);

// Error messages.
sprintf( /* Translators: Expiration date */
	__( 'Your license key has expired on %s.', 'easy-fancybox' ),
	date_i18n(
		get_option( 'date_format' ),
		strtotime( $expires, current_time( 'timestamp' ) )
	)
);
__( 'Your license key has expired.', 'easy-fancybox' );
__( 'Your license key has been disabled.', 'easy-fancybox' );
__( 'This appears to be an invalid license key.', 'easy-fancybox' );
__( 'Your license is not active for this site.', 'easy-fancybox' );
sprintf( /* Translators: Plugin name */
	__( 'This appears to be an invalid license key for %s.', 'easy-fancybox' ),
	__( 'Easy FancyBox Pro', 'easy-fancybox' )
);
__( 'Your license key has reached its activation limit.', 'easy-fancybox' );
__( 'An error occurred, please try again.', 'easy-fancybox' );
__( 'An unkown error occurred. Please try again.', 'easy-fancybox' );
sprintf( /* Translators: license error code, Support (linked) */
	__( 'Unexpected license error code %1$s. Please try again or get %2$s.', 'easy-fancybox' ),
	'<code>' . $error . '</code>',
	'<a target="_blank" href="https://premium.status301.com/support-ticket/">' . __( 'Support', 'easy-fancybox' ) . '</a>'
);
sprintf( /* Translators: Plugin name */
	__( 'You have not yet entered your license key for %s.', 'easy-fancybox' ),
	__( 'Easy FancyBox Pro', 'easy-fancybox' )
);
sprintf( /* Translators: plugin admin page URL */
	__( 'To receive plugin updates, please <a href="%s">correct this issue</a>.', 'easy-fancybox' ),
	admin_url( 'options.php' ) . '?page=easy-fancybox-license'
);
sprintf( /* Translators: Plugin name */
	__( 'You have an invalid or expired license key for %s.', 'easy-fancybox' ),
	__( 'Easy FancyBox Pro', 'easy-fancybox' )
);
sprintf( /* Translators: plugin admin page URL */
	__( 'To receive plugin updates, please <a href="%s">correct this issue</a>.', 'easy-fancybox' ),
	admin_url( 'options.php' ) . '?page=easy-fancybox-license'
);
sprintf( /* Translators: Plugin name */
	__( 'Your license key for %s is not activated for this site.', 'easy-fancybox' ),
	__( 'Easy FancyBox Pro', 'easy-fancybox' )
);
sprintf( /* Translators: plugin admin page URL */
	__( 'To receive plugin updates, please <a href="%s">correct this issue</a>.', 'easy-fancybox' ),
	admin_url( 'options.php' ) . '?page=easy-fancybox-license'
);
__( 'Your license was successfully activated for this site.', 'easy-fancybox' );
__( 'Your license was successfully deactivated for this site.', 'easy-fancybox' );
__( 'Your license is active for this site.', 'easy-fancybox' );
__( 'Your license is not active for this site.', 'easy-fancybox' );
__( 'Too many requests. Please try again in a minute.', 'easy-fancybox' );
__( 'Cannot make requests to own domain.', 'easy-fancybox' );
__( 'Failed identify the product.', 'easy-fancybox' );
sprintf( /* Translators: http repsonse code */
	__( 'Unexpected response code %d.', 'easy-fancybox' ),
	'<code>' . $response . '</code>'
);

__('To make any VideoPress movie open in an overlay, switch on Autodetect or use the class "fancybox-videopress" for its link.','easy-fancybox');
