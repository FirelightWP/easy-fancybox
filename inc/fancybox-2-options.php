<?php
/**
* FancyBox v2 options and their defaults array.
*/

$efb_options = array (
	'Global' => array(
		'title' => __('Global settings','easy-fancybox'),
		'input' => 'deep',
		'hide' => true,
		'options' => array(
			'Enable' => array (
				'title' => __('Media','easy-fancybox'),
				'input' => 'multiple',
				'hide' => true,
				'options' => array(
					'p1' => array (
						'hide' => true,
						'description' => __('Enable FancyBox for','easy-fancybox') . '<br />'
					),
					'IMG' => array (
						'id' => 'fancybox_enableImg',
						'input' => 'checkbox',
						'hide' => true,
						'default' => ( function_exists( 'is_plugin_active_for_network' ) && is_plugin_active_for_network( easyFancyBox::$plugin_basename ) ) ? '' : '1',
						'description' => '<strong>' . __( 'Images', 'easy-fancybox' ) . '</strong>' . ( get_option('fancybox_enableImg') ? ' &mdash; <a href="#IMG">' . translate( 'Settings' ) . '</a>' : '' )
					),
					'Inline' => array (
						'id' => 'fancybox_enableInline',
						'input' => 'checkbox',
						'hide' => true,
						'default' => '',
						'description' => '<strong>' . __( 'Inline content', 'easy-fancybox' ) . '</strong>' . '</strong>' . ( get_option('fancybox_enableInline') ? ' &mdash; <a href="#Inline">' . translate( 'Settings' ) . '</a>' : '' )
					),
					'PDF' => array (
						'id' => 'fancybox_enablePDF',
						'input' => 'checkbox',
						'hide' => true,
						'default' => '',
						'description' => '<strong>' . __( 'PDF', 'easy-fancybox' ) . '</strong>' . '</strong>' . ( get_option('fancybox_enablePDF') ? ' &mdash; <a href="#PDF">' . translate( 'Settings' ) . '</a>' : '' )
					),
					'SWF' => array (
						'id' => 'fancybox_enableSWF',
						'input' => 'checkbox',
						'hide' => true,
						'default' => '',
						'description' => '<strong>' . __( 'SWF', 'easy-fancybox' ) . '</strong>' . '</strong>' . ( get_option('fancybox_enableSWF') ? ' &mdash; <a href="#SWF">' . translate( 'Settings' ) . '</a>' : '' )
					),
					'SVG' => array (
						'id' => 'fancybox_enableSVG',
						'input' => 'checkbox',
						'hide' => true,
						'default' => '',
						'description' => '<strong>' . __( 'SVG', 'easy-fancybox' ) . '</strong>' . '</strong>' . ( get_option('fancybox_enableSVG') ? ' &mdash; <a href="#SVG">' . translate( 'Settings' ) . '</a>' : '' )
					),
					'VideoPress' => array (
						'id' => 'fancybox_enableVideoPress',
						'input' => 'checkbox',
						'hide' => true,
						'default' => '',
						'status' => 'disabled',
						'description' => '<strong>' . __( 'VideoPress', 'easy-fancybox' ) . '</strong>' . ' ' . '<em><a href="'.easyFancyBox::$pro_plugin_url.'">' . __('Make available &raquo;','easy-fancybox') . '</a></em>'
					),
					'YouTube' => array (
						'id' => 'fancybox_enableYoutube',
						'input' => 'checkbox',
						'hide' => true,
						'default' => '',
						'description' => '<strong>' . __( 'YouTube', 'easy-fancybox' ) . '</strong>' . '</strong>' . ( get_option('fancybox_enableYouTube') ? ' &mdash; <a href="#YouTube">' . translate( 'Settings' ) . '</a>' : '' )
					),
					'Vimeo' => array (
						'id' => 'fancybox_enableVimeo',
						'input' => 'checkbox',
						'hide' => true,
						'default' => '',
						'description' => '<strong>' . __( 'Vimeo', 'easy-fancybox' ) . '</strong>' . '</strong>' . ( get_option('fancybox_enableVimeo') ? ' &mdash; <a href="#Vimeo">' . translate( 'Settings' ) . '</a>' : '' )
					),
					'Dailymotion' => array (
						'id' => 'fancybox_enableDailymotion',
						'input' => 'checkbox',
						'hide' => true,
						'default' => '',
						'description' => '<strong>' . __( 'Dailymotion', 'easy-fancybox' ) . '</strong>' . '</strong>' . ( get_option('fancybox_enableDailymotion') ? ' &mdash; <a href="#Dailymotion">' . translate( 'Settings' ) . '</a>' : '' )
					),
					'Instagram' => array (
						'id' => 'fancybox_enableInstagram',
						'input' => 'checkbox',
						'hide' => true,
						'status' => 'disabled',
						'description' => '<strong>' . __( 'Instagram', 'easy-fancybox' ) . '</strong>' . ' ' . '<em><a href="'.easyFancyBox::$pro_plugin_url.'">' . __('Make available &raquo;','easy-fancybox') . '</a></em>'
					),
					'GoogleMaps' => array (
						'id' => 'fancybox_enableGoogleMaps',
						'input' => 'checkbox',
						'hide' => true,
						'status' => 'disabled',
						'description' => '<strong>' . __( 'Google Maps', 'easy-fancybox' ) . '</strong>' . ' ' . '<em><a href="'.easyFancyBox::$pro_plugin_url.'">' . __('Make available &raquo;','easy-fancybox') . '</a></em>'
					),
					'iFrame' => array (
						'id' => 'fancybox_enableiFrame',
						'input' => 'checkbox',
						'hide' => true,
						'default' => '',
						'description' => '<strong>' . __('iFrames','easy-fancybox') . '</strong>' . '</strong>' . ( get_option('fancybox_enableiFrame') ? ' &mdash; <a href="#iFrame">' . translate( 'Settings' ) . '</a>' : '' )
					)
				),
				'description' => ''
			),
			'Overlay' => array (
				'title' => __('Overlay','easy-fancybox'),
				'input' => 'multiple',
				'hide' => true,
				'options' => array(
					'overlayShow' => array (
						'id' => 'fancybox_overlayShow',
						'input' => 'checkbox',
						'hide' => true,
						'default' => '1',
						'description' => __('Show the overlay around content opened in FancyBox.','easy-fancybox')
					),
					'hideOnOverlayClick' => array (
						'id' => 'fancybox_hideOnOverlayClick',
						'input' => 'checkbox',
						'hide' => true,
						'default' => '1',
						'description' => __('Close FancyBox when overlay is clicked.','easy-fancybox')
					),
					'overlayColor' => array (
						'id' => 'fancybox_overlayColor',
						'title' => __('Color','easy-fancybox'),
						'label_for' => 'fancybox_overlayColor',
						'input' => 'text',
						'hide' => true,
						'sanitize_callback' => 'colorval',
						'class' => '',
						'default' => '',
						'description' => __('Enter an RGBA color value.','easy-fancybox') . ' <em>' . __('Example:','easy-fancybox') . ' rgba(119,119,119,0.7)</em><br />'
					),
					'overlaySpotlight' => array (
						'id' => 'fancybox_overlaySpotlight',
						'input' => 'checkbox',
						'hide' => true,
						'status' => get_option('fancybox_overlaySpotlight') ? '' : 'disabled',
						'default' => '',
						'description' => __('Spotlight effect','easy-fancybox') . ( get_option('fancybox_overlaySpotlight') ? '' : '. <em><a href="'.easyFancyBox::$pro_plugin_url.'">' . __('Make available &raquo;','easy-fancybox') ) . '</a></em>'
					)
				)
			),
			'Window' => array (
				'title' => __('Window','easy-fancybox'),
				'input' => 'multiple',
				'hide' => true,
				'options' => array(
					'p1' => array (
						'hide' => true,
						'description' => '<strong>' . __('Appearance','easy-fancybox') . '</strong><br />'
					),
					'closeBtn' => array (
						'id' => 'fancybox_showCloseButton',
						'input' => 'checkbox',
						'default' => '1',
						'description' => __('Show the (X) close button','easy-fancybox')
					),
					'backgroundColor' => array (
						'id' => 'fancybox_backgroundColor',
						'hide' => true,
						'title' => __('Background color','easy-fancybox'),
						'label_for' => 'fancybox_backgroundColor',
						'input' => 'text',
						'sanitize_callback' => 'colorval',
						'status' => 'disabled',
						'class' => 'small-text',
						'default' => '',
						'description' => ''
					),
					'textColor' => array (
						'id' => 'fancybox_textColor',
						'hide' => true,
						'title' => __('Text color','easy-fancybox'),
						'label_for' => 'fancybox_textColor',
						'input' => 'text',
						'sanitize_callback' => 'colorval',
						'status' => 'disabled',
						'class' => 'small-text',
						'default' => '',
						'description' => '<em><a href="'.easyFancyBox::$pro_plugin_url.'">' . __('Make available &raquo;','easy-fancybox') . '</a></em><br />'
					),
					'titleColor' => array (
						'id' => 'fancybox_titleColor',
						'hide' => true,
						'title' => __('Title color','easy-fancybox'),
						'label_for' => 'fancybox_titleColor',
						'input' => 'text',
						'sanitize_callback' => 'colorval',
						'class' => 'small-text',
						'default' => '',
						'description' => ''
					),
					'paddingColor' => array (
						'id' => 'fancybox_paddingColor',
						'hide' => true,
						'title' => __('Border color','easy-fancybox'),
						'label_for' => 'fancybox_paddingColor',
						'input' => 'text',
						'sanitize_callback' => 'colorval',
						'class' => 'small-text',
						'default' => '',
						'description' => '<em>' . __('Default:','easy-fancybox')  . ' #000 x #fff</em><br />' . __('Note:','easy-fancybox') . ' ' . __('Use RGBA notation for semi-transparent borders.','easy-fancybox') . ' <em>' . __('Example:','easy-fancybox') . ' rgba(10,10,30,0.7)</em><br />'
					),
					'borderRadius' => array (
						'id' => 'fancybox_borderRadius',
						'hide' => true,
						'title' => __('Border radius','easy-fancybox'),
						'label_for' => 'fancybox_borderRadius',
						'input' => 'number',
						'step' => '1',
						'min' => '0',
						'max' => '99',
						'sanitize_callback' => 'intval',
						'status' => 'disabled',
						'class' => 'small-text',
						'default' => '4',
						'description' => '<em><a href="'.easyFancyBox::$pro_plugin_url.'">' . __('Make available &raquo;','easy-fancybox') . '</a></em><br />'
					),

					'p11' => array (
						'hide' => true,
						'description' => '<br /><strong>' . __('Dimensions','easy-fancybox') . '</strong><br />'
					),
					'width' => array (
						'id' => 'fancybox_width',
						'title' => translate('Width'),
						'label_for' => 'fancybox_width',
						'input' => 'text',
						'sanitize_callback' => 'intval',
						'class' => 'small-text',
						'default' => '',
						'description' => ' '
					),
					'height' => array (
						'id' => 'fancybox_height',
						'title' => translate('Height'),
						'label_for' => 'fancybox_height',
						'input' => 'text',
						'sanitize_callback' => 'intval',
						'class' => 'small-text',
						'default' => '',
						'description' => '<em>' . __('Default:','easy-fancybox')  . ' 800 x 600</em><br />' . __('If content size is not set or cannot be determined automatically, these default dimensions will be used.','easy-fancybox') . '<br />'
					),
					// TODO: minWidth minHeight maxWidth maxHeight
					'padding' => array (
						'id' => 'fancybox_padding',
						'title' => translate('Border'),
						'label_for' => 'fancybox_padding',
						'input' => 'number',
						'step' => '1',
						'min' => '0',
						'max' => '100',
						'sanitize_callback' => 'intval',
						'class' => 'small-text',
						'default' => '',
						'description' => '<em>' . __('Default:','easy-fancybox')  . ' 15</em><br />'
					),
					'margin' => array (
						'id' => 'fancybox_margin',
						'title' => __('Margin','easy-fancybox'),
						'label_for' => 'fancybox_margin',
						'input' => 'number',
						'step' => '1',
						'min' => '20',
						'max' => '80',
						'sanitize_callback' => 'intval',
						'class' => 'small-text',
						'default' => '20',
						'description' => '<em>' . __('Default:','easy-fancybox')  . ' 20</em><br />'
					),

					'p2' => array (
						'hide' => true,
						'description' => '<br /><strong>' . __('Behavior','easy-fancybox') . '</strong><br />'
					),
					/* TODO: autoResize
					/* TODO: Autocenter select box for always true, always false or default (!isTouch)
					'autoCenter' => array (
						'id' => 'fancybox_centerOnScroll',
						'input' => 'checkbox',
						'default' => '!isTouch',
						'description' => __('Center while scrolling (always disabled on touch devices and when content, including the title, might be larger than the viewport)','easy-fancybox')
					),*/
					/* TODO: Section to define keyboard keys for gallery navigation, closing and slideshow
Default value:
'keys' : {
	next : {
		13 : 'left', // enter
		34 : 'up',   // page down
		39 : 'left', // right arrow
		40 : 'up'    // down arrow
	},
	prev : {
		8  : 'right',  // backspace
		33 : 'down',   // page up
		37 : 'right',  // left arrow
		38 : 'down'    // up arrow
	},
	close  : [27], // escape key
	play   : [32], // space - start/stop slideshow
	toggle : [70]  // letter "f" - toggle fullscreen
}*/
					'enableEscapeButton' => array (
						'id' => 'fancybox_enableEscapeButton',
						'input' => 'checkbox',
						'hide' => true,
						'default' => '1',
						'description' => __('Esc key stroke closes FancyBox','easy-fancybox')
					),
					/* TODO: topRatio leftRatio for centering adjustments. */
					'fitToView' => array (
						'id' => 'fancybox_autoScale',
						'input' => 'checkbox',
						'default' => '1',
						'description' => __('Scale large content down to fit in the browser viewport.','easy-fancybox')
					),
					'openSpeed' => array (
						'id' => 'fancybox_speedIn',
						'title' => __('Opening speed','easy-fancybox'),
						'label_for' => 'fancybox_speedIn',
						'input' => 'number',
						'step' => '100',
						'min' => '0',
						'max' => '6000',
						'sanitize_callback' => 'intval',
						'class' => 'small-text',
						'default' => '',
					),
					'closeSpeed' => array (
						'id' => 'fancybox_speedOut',
						'title' => __('Closing speed','easy-fancybox'),
						'label_for' => 'fancybox_speedOut',
						'input' => 'number',
						'step' => '100',
						'min' => '0',
						'max' => '6000',
						'sanitize_callback' => 'intval',
						'class' => 'small-text',
						'default' => '',
						'description' => '<br />' . __('Duration in milliseconds. Higher is slower.','easy-fancybox') . ' <em>' . __('Default:','easy-fancybox')  . ' 250</em><br />'
					)
				)
			),

			'Miscellaneous' => array (
				'title' => __('Miscellaneous','easy-fancybox'),
				'input' => 'multiple',
				'hide' => true,
				'options' => array(
					'p0' => array (
						'hide' => true,
						'description' => '<strong>' . __('Auto popup','easy-fancybox') . '</strong><br />'
					),
					'autoClick' => array (
						'id' => 'fancybox_autoClick',
						'title' => __('Open on page load','easy-fancybox'),
						'label_for' => 'fancybox_autoClick',
						'hide' => true,
						'input' => 'select',
						'options' => array(
							'' => translate('None'),
							'1' => __('Link with ID "fancybox-auto"','easy-fancybox'),
						),
						'default' => '1',
						'description' => '<em><a href="'.easyFancyBox::$pro_plugin_url.'">' . __('More options &raquo;','easy-fancybox') . '</a></em><br />'
					),
					'delayClick' => array (
						'id' => 'fancybox_delayClick',
						'title' => __('Delay in milliseconds','easy-fancybox'),
						'label_for' => 'fancybox_delayClick',
						'hide' => true,
						'input' => 'number',
						'step' => '100',
						'min' => '0',
						'max' => '',
						'sanitize_callback' => 'intval',
						'class' => 'small-text',
						'default' => '1000',
						'description' => ' <em>' . __('Default:','easy-fancybox')  . ' 1000</em><br />'
					),
					'jqCookie' => array (
						'id' => '',
						'title' => __('Hide popup after first visit?','easy-fancybox'),
						'hide' => true,
						'input' => 'select',
						'status' => 'disabled',
						'default' => '0',
						'sanitize_callback' => 'intval',
						'options' => array(
							'0' => translate('No'),
							'1' => __('1 Day','easy-fancybox'),
							'7' => __('1 Week','easy-fancybox'),
							'30' => __('1 Month','easy-fancybox'),
							'365' => __('1 Year','easy-fancybox')
						),
						'description' => ' <em><a href="'.easyFancyBox::$pro_plugin_url.'">' . __('Make available &raquo;','easy-fancybox') . '</a></em><br />'
					),
					'cookiePath' => array (
						'id' => '',
						'default' => '',
						'hide' => true
					),
					'p1' => array (
						'hide' => true,
						'description' => '<br /><strong>' . __('Browser & device compatibility','easy-fancybox') . '</strong><br />'
					),
					'minVpWidth' => array (
						'id' => 'fancybox_minViewportWidth',
						'title' => __('Minimum browser/device viewport width','easy-fancybox'),
						'label_for' => 'fancybox_minViewportWidth',
						'input' => 'number',
						'step' => '1',
						'min' => '320',
						'max' => '900',
						'sanitize_callback' => 'intval',
						'class' => 'small-text',
						'default' => '',
						'description' => '<em>' . __('Default:','easy-fancybox') . ' 320</em><br />'
					),
					'minVpHeight' => array (
						'id' => 'fancybox_minViewportHeight',
						'title' => __('Minimum browser/device viewport height','easy-fancybox'),
						'label_for' => 'fancybox_minViewportHeight',
						'input' => 'number',
						'step' => '1',
						'min' => '320',
						'max' => '900',
						'sanitize_callback' => 'intval',
						'class' => 'small-text',
						'default' => '',
						'description' => '<em>' . __('Default:','easy-fancybox') . ' 320</em><br />'
					),
/*					'forceNewtab' => array (
						'id' => 'fancybox_forceNewtab',
						'input' => 'checkbox',
						'hide' => true,
						'default' => '1',
						'description' => __('Make media links open in a new tab when viewport falls below minimum width (above)','easy-fancybox')
					),*/
					'p2' => array (
						'hide' => true,
						'description' => '<br /><strong>' . __('Theme & plugins compatibility','easy-fancybox') . '</strong><br />'
										. __('Try to deactivate all conflicting light box scripts in your theme or other plugins. If this is not possible, try a higher script priority number which means scripts are added later, wich may allow them to override conflicting scripts. A lower priority number, excluding WordPress standard jQuery, or even moving the plugin scripts to the header may work in cases where there are blocking errors occuring in other script.','easy-fancybox')
										. '<br /><br />'
					),
					'scriptPriority' => array (
						'id' => 'fancybox_scriptPriority',
						'title' => __('FancyBox script priority','easy-fancybox'),
						'label_for' => 'fancybox_scriptPriority',
						'hide' => true,
						'input' => 'number',
						'step' => '1',
						'min' => '-99',
						'max' => '999',
						'sanitize_callback' => 'intval',
						'class' => 'small-text',
						'default' => '10',
						'description' => __('Default priority is 10.','easy-fancybox') . ' ' . __('Higher is later.','easy-fancybox') . '<br/>'
					),
					'noFooter' => array (
						'id' => 'fancybox_noFooter',
						'input' => 'checkbox',
						'hide' => true,
						'default' => '',
						'description' => __('Move scripts from footer to theme head section (not recommended for site load times!)','easy-fancybox')
					),
					'nojQuery' => array (
						'id' => 'fancybox_nojQuery',
						'input' => 'checkbox',
						'hide' => true,
						'default' => '',
						'description' => __('Do not include standard WordPress jQuery library (do this only if you are sure jQuery is included from another source!)','easy-fancybox')
					),
					'pre45Compat' => array (
						'id' => 'fancybox_pre45Compat',
						'input' => 'checkbox',
						'hide' => true,
						'default' => function_exists( 'wp_add_inline_script' ) ? '' : '1',
						'description' => __('Do not use wp_add_inline_script/style functions (may solve issues with older script minification plugins)','easy-fancybox')
					),
					'p3' => array (
						'hide' => true,
						'description' => '<br /><strong>' . __('Advanced','easy-fancybox') . '</strong><br />'
					),
					'metaData' => array (
						'id' => 'fancybox_metaData',
						'hide' => true,
						'input' => 'checkbox',
						'status' => get_option('fancybox_metaData') ? '' : 'disabled',
						'default' =>  '',
						'description' => __('Include the Metadata jQuery extension script to allow passing custom parameters via link class.','easy-fancybox') . ( get_option('fancybox_metaData') ? '' : '. <em><a href="'.easyFancyBox::$pro_plugin_url.'">' . __('Make available &raquo;','easy-fancybox') ) . '</a></em>'
					),
					'vcMasonryCompat' => array (
						'id' => 'fancybox_vcMasonryCompat',
						'hide' => true,
						'input' => 'checkbox',
						'status' => 'disabled',
						'default' =>  '',
						'description' => __('WPBakery / Visual Composer - Masonry Grid Gallery compatibility.','easy-fancybox') . ' <em><a href="'.easyFancyBox::$pro_plugin_url.'">' . __('Make available &raquo;','easy-fancybox') . '</a></em>'
					),
					'autoExclude' => array (
						'id' => 'fancybox_autoExclude',
						'title' => __('Exclude','easy-fancybox'),
						'label_for' => 'fancybox_autoExclude',
						'input' => 'text',
						'class' => 'regular-text',
						'hide' => true,
						'default' => '.nolightbox,a.wp-block-file__button,a.pin-it-button,a[href*=\'pinterest.com/pin/create\'],a[href*=\'facebook.com/share\'],a[href*=\'twitter.com/share\']',
						'sanitize_callback' => 'csl_text',
						'description' => __('A comma-separated list of selectors for elements to which FancyBox should not automatically bind itself. Media links inside these elements will be ignored by Autodetect.','easy-fancybox') . ' <em>' . __('Default:','easy-fancybox') . ' .nolightbox,a.wp-block-file__button,a.pin-it-button,a[href*=\'pinterest.com/pin/create\'],a[href*=\'facebook.com/share\'],a[href*=\'twitter.com/share\']</em><br />'
					)
				)
			)
		)
	),

	'IMG' => array(
		'title' => __('Images','easy-fancybox'),
		'input' => 'multiple',
		'options' => array(
			'intro' => array (
				'hide' => true,
				'description' => __('To make images open in an overlay, add their extension to the Autodetect field or use the class "fancybox" for its link. Clear field to switch off all autodetection.','easy-fancybox') . '<br />'
			),
			'tag' => array (
				'hide' => true,
				'default' => 'a.fancybox,area.fancybox,li.fancybox>a'
			),
			'class' => array (
				'hide' => true,
				'default' => 'fancybox'
			),
			'autoAttribute' => array (
				'id' => 'fancybox_autoAttribute',
				'title' => __('Autodetect','easy-fancybox'),
				'label_for' => 'fancybox_autoAttribute',
				'input' => 'text',
				'class' => 'regular-text',
				'hide' => true,
				'default' => '.jpg,.png,.webp',
				'sanitize_callback' => 'csl_text',
				'selector' => 'href*=',
				'description' => __('A comma-separated list of image file extensions to which FancyBox should automatically bind itself.','easy-fancybox') . ' <em>' . __('Example:','easy-fancybox') . ' .jpg,.png,.gif,.jpeg</em><br />'
			),
			'autoAttributeLimit' => array (
				'id' => 'fancybox_autoAttributeLimit',
				'title' => __('Apply to','easy-fancybox'),
				'label_for' => 'fancybox_autoAttributeLimit',
				'hide' => true,
				'input' => 'select',
				'options' => array(
					'' => __('All image links', 'easy-fancybox')
				),
				'default' => '',
				'description' => '<em><a href="'.easyFancyBox::$pro_plugin_url.'">' . __('More options &raquo;','easy-fancybox') . '</a></em><br />'
			),
			'type' => array (
				'id' => 'fancybox_classType',
				'title' => __('Force FancyBox to treat all media linked with class="fancybox" as images?','easy-fancybox'),
				'label_for' => 'fancybox_classType',
				'input' => 'select',
				'options' => array(
					'image' => translate('Yes'),
					'' => translate('No')
				),
				'default' => get_option('fancybox_enableInline') ? 'image' : '',
				'description' => '<br/>'
			),
			'p2' => array (
				'hide' => true,
				'description' => '<br /><strong>' . __('Behavior','easy-fancybox') . '</strong><br />'
			),
			'openEffect' => array (
				'id' => 'fancybox_transitionIn',
				'title' => __('Transition In','easy-fancybox'),
				'label_for' => 'fancybox_transitionIn',
				'input' => 'select',
				'options' => array(
					'none' => translate('None'),
					'' => __('Fade','easy-fancybox'),
					'elastic' => __('Elastic','easy-fancybox'),
				),
				'default' => 'elastic',
				'description' => ' '
			),
			'openEasing' => array (
				'id' => 'fancybox_easingIn',
				'title' => __('Easing In','easy-fancybox'),
				'label_for' => 'fancybox_easingIn',
				'input' => 'select',
				'options' => array(
					'linear' => __('Linear','easy-fancybox'),
					'' => __('Swing','easy-fancybox'),
					'easeInBack' => __('easeInBack','easy-fancybox'),
					'easeOutBack' => __('easeOutBack','easy-fancybox')
				),
				'default' => '',
				'description' => ' <em><a href="'.easyFancyBox::$pro_plugin_url.'">' . __('More options &raquo;','easy-fancybox') . '</a></em><br />'
			),
			'closeEffect' => array (
				'id' => 'fancybox_transitionOut',
				'title' => __('Transition Out','easy-fancybox'),
				'label_for' => 'fancybox_transitionOut',
				'input' => 'select',
				'options' => array(
					'none' => translate('None'),
					'' => __('Fade','easy-fancybox'),
					'elastic' => __('Elastic','easy-fancybox'),
				),
				'default' => 'elastic',
				'description' => ' '
			),
			'closeEasing' => array (
				'id' => 'fancybox_easingOut',
				'title' => __('Easing Out','easy-fancybox'),
				'label_for' => 'fancybox_easingOut',
				'input' => 'select',
				'options' => array(
					'linear' => __('Linear','easy-fancybox'),
					'' => __('Swing','easy-fancybox'),
					'easeInBack' => __('easeInBack','easy-fancybox'),
					'easeOutBack' => __('easeOutBack','easy-fancybox')
				),
				'default' => '',
				'description' => ' <em><a href="'.easyFancyBox::$pro_plugin_url.'">' . __('More options &raquo;','easy-fancybox') . '</a></em><br />' . __('Note:','easy-fancybox') . ' ' . __('Easing effects only apply when Transition is set to Elastic. ','easy-fancybox')  . '<br /><br />'
			),
/*			'openOpacity' => array (
				'id' => 'fancybox_openOpacity',
				'input' => 'checkbox',
				'default' => '1',
				'description' => __('Transparency fade during elastic open transition.','easy-fancybox')
			),
			'closeOpacity' => array (
				'id' => 'fancybox_closeOpacity',
				'input' => 'checkbox',
				'default' => '1',
				'description' => __('Transparency fade during elastic close transition.','easy-fancybox')
			),*/
			/* TODO: openMethod / closeMethod / nextMethod / prevMethod */
			'closeClick' => array (
				'id' => 'fancybox_hideOnContentClick',
				'input' => 'checkbox',
				'default' => '',
				'description' => __('Close FancyBox when content is clicked','easy-fancybox')
			),
			'p1' => array (
				'hide' => true,
				'description' => '<br /><strong>' . __('Appearance','easy-fancybox') . '</strong><br />'
			),
			'titleShow' => array (
				'id' => 'fancybox_titleShow',
				'input' => 'checkbox',
				'hide' => true,
				'default' => '1',
				'description' => __('Show title.','easy-fancybox') . ' ' . __('FancyBox will try to get a title from the link or thumbnail title attributes.','easy-fancybox')
			),
			'titleType' => array (
				'id' => 'fancybox_titlePosition',
				'title' => __('Title Style','easy-fancybox'),
				'label_for' => 'fancybox_titlePosition',
				'input' => 'select',
				'hide' => true,
				'options' => array(
					'float' => __('Float','easy-fancybox'),
					'outside' => __('Outside','easy-fancybox'),
					'inside' => __('Inside','easy-fancybox'),
					'over' => __('Overlay','easy-fancybox')
				),
				'default' => 'float',
				'description' => '<br />'
			),
			'titlePosition' => array (
				'id' => 'fancybox_titlePosition2',
				'title' => __('Title Position','easy-fancybox'),
				'label_for' => 'fancybox_titlePosition2',
				'input' => 'select',
				'hide' => true,
				'options' => array(
					'' => __('Bottom','easy-fancybox'),
					'top' => __('Top','easy-fancybox')
				),
				'default' => '',
				'description' => '<br />'
			),
			'titleFromAlt' => array (
				'id' => 'fancybox_titleFromAlt',
				'input' => 'checkbox',
				'hide' => true,
				'default' => '1',
				'description' => __('Allow title from thumbnail alt attribute.','easy-fancybox')
			),
			'beforeLoad' => array (
				'id' => '',
				'title' => __('Advanced','easy-fancybox'),
				'input' => 'select',
				'status' => 'disabled',
				'options' => array(
					'' => __('Hide/show title on mouse hover action','easy-fancybox')
				),
				'default' => '',
				'description' =>  '<em><a href="'.easyFancyBox::$pro_plugin_url.'">' . __('Make available &raquo;','easy-fancybox') . '</a></em><br />'
			),
			'p3' => array (
				'hide' => true,
				'description' => '<br /><strong>' . __('Gallery','easy-fancybox') . '</strong><br />'
			),
			'autoGallery' => array (
				'id' => 'fancybox_autoGallery',
				'title' => __('Autogallery','easy-fancybox'),
				'label_for' => 'fancybox_autoGallery',
				'hide' => true,
				'input' => 'select',
				'options' => array(
					'' => translate('Disabled'),
					'1' => __('WordPress galleries only','easy-fancybox'),
					'2' => __('All in one gallery','easy-fancybox')
				),
				'default' => '1',
				'description' => '<em><a href="'.easyFancyBox::$pro_plugin_url.'">' . __('More options &raquo;','easy-fancybox') . '</a></em><br />' . __('Note:','easy-fancybox') . ' ' . __('When disabled, you can use the rel attribute to manually group image links together.','easy-fancybox') . '<br /><br />'
			),
			'arrows' => array (
				'id' => 'fancybox_showNavArrows',
				'input' => 'checkbox',
				'default' => '1',
				'description' => __('Show the gallery navigation arrows','easy-fancybox')
			),
			/* TODO: nextClick to navigate to next gallery item when user clicks the content, default false */
			'enableKeyboardNav' => array (
				'id' => 'fancybox_enableKeyboardNav',
				'input' => 'checkbox',
				'hide' => true,
				'default' => '1',
				'description' => __('Arrow key strokes browse the gallery','easy-fancybox')
			),
			'loop' => array (
				'id' => 'fancybox_cyclic',
				'input' => 'checkbox',
				'hide' => true,
				'default' => '',
				'description' => __('Make galleries cyclic, allowing you to keep pressing next/back.','easy-fancybox')
			),
			'mouseWheel' => array (
				'id' => 'fancybox_mouseWheel',
				'input' => 'checkbox',
				'default' => '1',
				'description' => __('Allow gallery browsing by mousewheel action.','easy-fancybox')
			),
			'nextSpeed' => array (
				'id' => 'fancybox_nextSpeed',
				'title' => __('Change speed to next item','easy-fancybox'),
				'label_for' => 'fancybox_nextSpeed',
				'input' => 'number',
				'step' => '1',
				'min' => '0',
				'max' => '6000',
				'sanitize_callback' => 'intval',
				'class' => 'small-text',
				'default' => '',
			),
			'prevSpeed' => array (
				'id' => 'fancybox_prevSpeed',
				'title' => __('Change speed to previous item','easy-fancybox'),
				'label_for' => 'fancybox_prevSpeed',
				'input' => 'number',
				'step' => '1',
				'min' => '0',
				'max' => '6000',
				'sanitize_callback' => 'intval',
				'class' => 'small-text',
				'default' => '',
				'description' => '<br />' . __('Duration in milliseconds. Higher is slower.','easy-fancybox') . ' <em>' . __('Default:','easy-fancybox')  . ' 250</em><br /><br />'
			),
			'autoSelector' => array (
				'id' => 'fancybox_autoSelector',
				'hide' => true,
				'input' => 'hidden',
				'default' => '.gallery,.wp-block-gallery,.tiled-gallery,.wp-block-jetpack-tiled-gallery'
			),
			'onComplete' => array (
				'id' => '',
				'title' => __('Advanced','easy-fancybox'),
				'input' => 'select',
				'status' => 'disabled',
				'options' => array(
					'' => __('Slideshow','easy-fancybox')
				),
				'default' => '',
				'description' =>  '<em><a href="'.easyFancyBox::$pro_plugin_url.'">' . __('Make available &raquo;','easy-fancybox') . '</a></em>'
			)
		)
	),

	'Inline' => array(
		'title' => __('Inline content','easy-fancybox'),
		'input' => 'multiple',
		'options' => array(
			'intro' => array (
				'hide' => true,
				'description' => __('To make inline content open in an overlay, wrap that content in a div with a unique ID, create a link with target "#uniqueID" and give it a class "fancybox-inline" attribute.','easy-fancybox') . '<br /><br />'
			),
			'tag' => array (
				'hide' => true,
				'default' => 'a.fancybox-inline,area.fancybox-inline,li.fancybox-inline>a'
			),
			'class' => array (
				'hide' => true,
				'default' => 'fancybox-inline'
			),
			'type' => array (
				'default' => 'inline'
			),
			'autoSize' => array (
				'id' => 'fancybox_autoDimensions',
				'input' => 'checkbox',
				'default' => '1',
				'description' => __('Try to adjust size to inline/html content. If unchecked the default dimensions will be used.','easy-fancybox') . ''
			),
			/* TODO: autoHeight autoWidth */
			'scrolling' => array (
				'id' => 'fancybox_InlineScrolling',
				'title' => __('Scrolling','easy-fancybox'),
				'label_for' => 'fancybox_InlineScrolling',
				'input' => 'select',
				'options' => array(
					'auto' => __('Auto','easy-fancybox'),
					'yes' => __('Always','easy-fancybox'),
					'no' => __('Never','easy-fancybox')
				),
				'default' => 'auto',
				'description' => __('Define scrolling and scrollbar visibility.','easy-fancybox') . '<br /><br />'
			),
			'transitionIn' => array (
				'id' => 'fancybox_transitionInInline',
				'title' => __('Transition In','easy-fancybox'),
				'label_for' => 'fancybox_transitionInInline',
				'input' => 'select',
				'options' => array(
					'none' => translate('None'),
					'' => __('Fade','easy-fancybox'),
					'elastic' => __('Elastic','easy-fancybox'),
				),
				'default' => '',
				'description' => ' '
			),
			'easingIn' => array (
				'id' => 'fancybox_easingInInline',
				'title' => __('Easing In','easy-fancybox'),
				'label_for' => 'fancybox_easingInInline',
				'input' => 'select',
				'options' => array(
					'linear' => __('Linear','easy-fancybox'),
					'' => __('Swing','easy-fancybox'),
					'easeInBack' => __('easeInBack','easy-fancybox'),
					'easeOutBack' => __('easeOutBack','easy-fancybox')
				),
				'default' => 'easeOutBack',
				'description' => ' <em><a href="'.easyFancyBox::$pro_plugin_url.'">' . __('More options &raquo;','easy-fancybox') . '</a></em><br />'
			),
			'transitionOut' => array (
				'id' => 'fancybox_transitionOutInline',
				'title' => __('Transition Out','easy-fancybox'),
				'label_for' => 'fancybox_transitionOutInline',
				'input' => 'select',
				'options' => array(
					'none' => translate('None'),
					'' => __('Fade','easy-fancybox'),
					'elastic' => __('Elastic','easy-fancybox'),
				),
				'default' => '',
				'description' => ' '
			),
			'easingOut' => array (
				'id' => 'fancybox_easingOutInline',
				'title' => __('Easing Out','easy-fancybox'),
				'label_for' => 'fancybox_easingOutInline',
				'input' => 'select',
				'options' => array(
					'linear' => __('Linear','easy-fancybox'),
					'' => __('Swing','easy-fancybox'),
					'easeInBack' => __('easeInBack','easy-fancybox'),
					'easeOutBack' => __('easeOutBack','easy-fancybox')
				),
				'default' => 'easeInBack',
				'description' => ' <em><a href="'.easyFancyBox::$pro_plugin_url.'">' . __('More options &raquo;','easy-fancybox') . '</a></em><br />' . __('Note:','easy-fancybox') . ' ' . __('Easing effects only apply when Transition is set to Elastic. ','easy-fancybox')  . '<br /><br />'
			),
			'opacity' => array (
				'id' => 'fancybox_opacityInline',
				'input' => 'checkbox',
				'default' => '',
				'description' => __('Transparency fade during elastic transition. CAUTION: Use only when at least Transition In is set to Elastic!','easy-fancybox')
			),
			'closeClick' => array (
				'id' => 'fancybox_hideOnContentClickInline',
				'input' => 'checkbox',
				'default' => '',
				'description' => __('Close FancyBox when content is clicked','easy-fancybox')
			),
			'titleShow' => array (
				'default' => 'false',
				'hide' => true
			)
		)
	),

	'PDF' => array(
		'title' => __('PDF','easy-fancybox'),
		'input' => 'multiple',
		'options' => array(
			'intro' => array (
				'hide' => true,
				'description' => __('To make any PDF document file open in an overlay, switch on Autodetect or use the class "fancybox-pdf" for its link.','easy-fancybox') . '<br />'
			),
			'autoAttribute' => array (
				'id' => 'fancybox_autoAttributePDF',
				'input' => 'checkbox',
				'hide' => true,
				'default' => '1',
				'selector' => '\'a[href*=".pdf"],area[href*=".pdf"],a[href*=".PDF"],area[href*=".PDF"]\'',
				'description' => __('Autodetect','easy-fancybox')
			),
			'tag' => array (
				'hide' => true,
				'default' => 'a.fancybox-pdf,area.fancybox-pdf,li.fancybox-pdf>a'
			),
			'class' => array (
				'hide' => true,
				'default' => 'fancybox-pdf'
			),
			'type' => array (
				'default' => 'iframe'
			),
			'beforeLoad' => array (
				'id' => 'fancybox_PDFonStart',
				'title' => __('Embed with','easy-fancybox'),
				'label_for' => 'fancybox_PDFonStart',
				'input' => 'select',
				'options' => array(
					'function(a,i,o){o.type=\'pdf\';}' => __('Object tag (plus fall-back link)','easy-fancybox'),
					'function(a,i,o){o.type=\'html\';o.content=\'<embed src="\'+a[i].href+\'" type="application/pdf" height="100%" width="100%" />\'}' => __('Embed tag','easy-fancybox'),
					'' => __('iFrame tag (let browser decide)','easy-fancybox'),
					'function(a,i,o){o.href=\'https://docs.google.com/viewer?embedded=true&url=\'+a[i].href;}' => __('Google Docs Viewer (external)','easy-fancybox')
				),
				'default' => '',
				'description' => __('Note:','easy-fancybox') . ' ' . __('External viewers have bandwidth, usage rate and and file size limits.','easy-fancybox') . '<br /><br />'
			),
			'width' => array (
				'id' => 'fancybox_PDFwidth',
				'title' => translate('Width'),
				'label_for' => 'fancybox_PDFwidth',
				'input' => 'text',
				'sanitize_callback' => 'intval',
				'class' => 'small-text',
				'default' => '90%',
				'description' => ' '
			),
			'height' => array (
				'id' => 'fancybox_PDFheight',
				'title' => translate('Height'),
				'label_for' => 'fancybox_PDFheight',
				'input' => 'text',
				'sanitize_callback' => 'intval',
				'class' => 'small-text',
				'default' => '90%'
			),
			'padding' => array (
				'id' => 'fancybox_PDFpadding',
				'title' => translate('Border'),
				'label_for' => 'fancybox_PDFpadding',
				'input' => 'number',
				'step' => '1',
				'min' => '0',
				'max' => '100',
				'sanitize_callback' => 'intval',
				'class' => 'small-text',
				'default' => '10',
				'description' => '<br /><br />'
			),
			'titleShow' => array (
				'id' => 'fancybox_PDFtitleShow',
				'input' => 'checkbox',
				'hide' => true,
				'default' => '',
				'description' => __('Show title.','easy-fancybox') . ' ' . __('FancyBox will try to get a title from the link or thumbnail title attributes.','easy-fancybox')
			),
			'titlePosition' => array (
				'id' => 'fancybox_PDFtitlePosition',
				'title' => __('Title Position','easy-fancybox'),
				'label_for' => 'fancybox_PDFtitlePosition',
				'input' => 'select',
				'hide' => true,
				'options' => array(
					'float' => __('Float','easy-fancybox'),
					'outside' => __('Outside','easy-fancybox'),
					'inside' => __('Inside','easy-fancybox')
				),
				'default' => 'float',
				'description' => '<br />'
			),
			'titlePosition' => array (
				'id' => 'fancybox_PDFtitlePosition',
				'title' => __('Title Position','easy-fancybox'),
				'label_for' => 'fancybox_PDFtitlePosition',
				'input' => 'select',
				'hide' => true,
				'options' => array(
					'float' => __('Float','easy-fancybox'),
					'outside' => __('Outside','easy-fancybox'),
					'inside' => __('Inside','easy-fancybox')
				),
				'default' => 'float',
				'description' => '<br />'
			),
			'titleFromAlt' => array (
				'id' => 'fancybox_PDFtitleFromAlt',
				'input' => 'checkbox',
				'hide' => true,
				'default' => '1',
				'description' => __('Allow title from thumbnail alt attribute.','easy-fancybox')
			),
			'autoSize' => array (
				'default' => 'false'
			),
			'scrolling' => array (
				'default' => 'no',
			),
		)
	),

	'SWF' => array(
		'title' => __('SWF','easy-fancybox'),
		'input' => 'multiple',
		'options' => array(
			'intro' => array (
				'hide' => true,
				'description' => __('To make any Flash (.swf) file open in an overlay, switch on Autodetect or use the class "fancybox-swf" for its link.','easy-fancybox') . '<br />'
			),
			'autoAttribute' => array (
				'id' => 'fancybox_autoAttributeSWF',
				'input' => 'checkbox',
				'hide' => true,
				'default' => '1',
				'selector' => '\'a[href*=".swf"],area[href*=".swf"],a[href*=".SWF"],area[href*=".SWF"]\'',
				'description' => __('Autodetect','easy-fancybox') . '<br />'
			),
			'tag' => array (
				'hide' => true,
				'default' => 'a.fancybox-swf,area.fancybox-swf,li.fancybox-swf>a'
			),
			'class' => array (
				'hide' => true,
				'default' => 'fancybox-swf'
			),
			'type' => array(
				'default' => 'swf'
			),
			'width' => array (
				'id' => 'fancybox_SWFWidth',
				'title' => translate('Width'),
				'label_for' => 'fancybox_SWFWidth',
				'input' => 'text',
				'sanitize_callback' => 'intval',
				'class' => 'small-text',
				'options' => array(),
				'default' => '680',
				'description' => ' '
			),
			'height' => array (
				'id' => 'fancybox_SWFHeight',
				'title' => translate('Height'),
				'label_for' => 'fancybox_SWFHeight',
				'input' => 'text',
				'sanitize_callback' => 'intval',
				'class' => 'small-text',
				'options' => array(),
				'default' => '495',
			),
			'padding' => array (
				'id' => 'fancybox_SWFpadding',
				'title' => translate('Border'),
				'label_for' => 'fancybox_SWFpadding',
				'input' => 'number',
				'step' => '1',
				'min' => '0',
				'max' => '100',
				'sanitize_callback' => 'intval',
				'class' => 'small-text',
				'default' => '0',
				'description' => '<br /><br />'
			),
			'titleShow' => array (
				'id' => 'fancybox_SWFtitleShow',
				'input' => 'checkbox',
				'hide' => true,
				'default' => '',
				'description' => __('Show title.','easy-fancybox') . ' ' . __('FancyBox will try to get a title from the link or thumbnail title attributes.','easy-fancybox')
			),
			'titlePosition' => array (
				'id' => 'fancybox_SWFtitlePosition',
				'title' => __('Title Position','easy-fancybox'),
				'label_for' => 'fancybox_SWFtitlePosition',
				'input' => 'select',
				'hide' => true,
				'options' => array(
					'float' => __('Float','easy-fancybox'),
					'outside' => __('Outside','easy-fancybox'),
					'inside' => __('Inside','easy-fancybox')
				),
				'default' => 'float',
				'description' => '<br />'
			),
			'titleFromAlt' => array (
				'id' => 'fancybox_SWFtitleFromAlt',
				'input' => 'checkbox',
				'hide' => true,
				'default' => '1',
				'description' => __('Allow title from thumbnail alt attribute.','easy-fancybox')
			),
			'swf' => array (
				'default' => '{\'wmode\':\'opaque\',\'allowfullscreen\':true}'
			)
		)
	),

	'SVG' => array(
		'title' => __('SVG','easy-fancybox'),
		'input' => 'multiple',
		'options' => array(
			'intro' => array (
				'hide' => true,
				'description' => __('To make any SVG (.svg) file open in an overlay, switch on Autodetect or use the class "fancybox-svg" for its link.','easy-fancybox') . '<br />'
			),
			'autoAttribute' => array (
				'id' => 'fancybox_autoAttributeSVG',
				'input' => 'checkbox',
				'hide' => true,
				'default' => '1',
				'selector' => '\'a[href*=".svg"],area[href*=".svg"],a[href*=".SVG"],area[href*=".SVG"]\'',
				'description' => __('Autodetect','easy-fancybox') . '<br />'
			),
			'tag' => array (
				'hide' => true,
				'default' => 'a.fancybox-svg,area.fancybox-svg,li.fancybox-svg>a'
			),
			'class' => array (
				'hide' => true,
				'default' => 'fancybox-svg'
			),
			'type' => array(
				'default' => 'svg'
			),
			'width' => array (
				'id' => 'fancybox_SVGWidth',
				'title' => translate('Width'),
				'label_for' => 'fancybox_SVGWidth',
				'input' => 'text',
				'sanitize_callback' => 'intval',
				'class' => 'small-text',
				'options' => array(),
				'default' => '680',
				'description' => ' '
			),
			'height' => array (
				'id' => 'fancybox_SVGHeight',
				'title' => translate('Height'),
				'label_for' => 'fancybox_SVGHeight',
				'input' => 'text',
				'sanitize_callback' => 'intval',
				'class' => 'small-text',
				'options' => array(),
				'default' => '495',
			),
			'padding' => array (
				'id' => 'fancybox_SVGpadding',
				'title' => translate('Border'),
				'label_for' => 'fancybox_SVGpadding',
				'input' => 'number',
				'step' => '1',
				'min' => '0',
				'max' => '100',
				'sanitize_callback' => 'intval',
				'class' => 'small-text',
				'default' => '0',
				'description' => '<br /><br />'
			),
			'titleShow' => array (
				'id' => 'fancybox_SVGtitleShow',
				'input' => 'checkbox',
				'hide' => true,
				'default' => '',
				'description' => __('Show title.','easy-fancybox') . ' ' . __('FancyBox will try to get a title from the link or thumbnail title attributes.','easy-fancybox')
			),
			'titlePosition' => array (
				'id' => 'fancybox_SVGtitlePosition',
				'title' => __('Title Position','easy-fancybox'),
				'label_for' => 'fancybox_SVGtitlePosition',
				'input' => 'select',
				'hide' => true,
				'options' => array(
					'float' => __('Float','easy-fancybox'),
					'outside' => __('Outside','easy-fancybox'),
					'inside' => __('Inside','easy-fancybox')
				),
				'default' => 'float',
				'description' => '<br />'
			),
			'titleFromAlt' => array (
				'id' => 'fancybox_SVGtitleFromAlt',
				'input' => 'checkbox',
				'hide' => true,
				'default' => '1',
				'description' => __('Allow title from thumbnail alt attribute.','easy-fancybox')
			),
			'svg' => array (
				'default' => '{\'wmode\':\'opaque\',\'allowfullscreen\':true}'
			)
		)
	),

	'VideoPress' => array(
	),

	'YouTube' => array(
		'title' => __('YouTube','easy-fancybox'),
		'input' => 'multiple',
		'options' => array(
			'intro' => array (
				'hide' => true,
				'description' => __('To make any YouTube movie open in an overlay, switch on Autodetect or use the class "fancybox-youtube" for its link.','easy-fancybox') . '<br />'
			),
			'autoAttribute' => array (
				'id' => 'fancybox_autoAttributeYoutube',
				'input' => 'checkbox',
				'hide' => true,
				'default' => '1',
				'selector' => '\'a[href*="youtu.be/"],area[href*="youtu.be/"],a[href*="youtube.com/"],area[href*="youtube.com/"]\').filter(function(){return this.href.match(/\/(?:youtu\.be|watch\?|embed\/)/);}',
				'description' => __('Autodetect','easy-fancybox') . '<br />'
			),
			'tag' => array (
				'hide' => true,
				'default' => 'a.fancybox-youtube,area.fancybox-youtube,li.fancybox-youtube>a'
			),
			'class' => array (
				'hide' => true,
				'default' => 'fancybox-youtube'
			),
			'width' => array (
				'id' => 'fancybox_YoutubeWidth',
				'title' => translate('Width'),
				'label_for' => 'fancybox_YoutubeWidth',
				'input' => 'number',
				'step' => '1',
				'min' => '420',
				'max' => '1500',
				'sanitize_callback' => 'intval',
				'class' => 'small-text',
				'default' => '640',
				'description' => ' '
			),
			'height' => array (
				'id' => 'fancybox_YoutubeHeight',
				'title' => translate('Height'),
				'label_for' => 'fancybox_YoutubeHeight',
				'input' => 'number',
				'step' => '1',
				'min' => '315',
				'max' => '900',
				'sanitize_callback' => 'intval',
				'class' => 'small-text',
				'default' => '360',
			),
			'padding' => array (
				'id' => 'fancybox_Youtubepadding',
				'title' => translate('Border'),
				'label_for' => 'fancybox_Youtubepadding',
				'input' => 'number',
				'step' => '1',
				'min' => '0',
				'max' => '100',
				'sanitize_callback' => 'intval',
				'class' => 'small-text',
				'default' => '0',
				'description' => '<br /><br />'
			),
			'aspectRatio' => array(
				'default' => '1'
			),
			'titleShow' => array (
				'id' => 'fancybox_YoutubetitleShow',
				'input' => 'checkbox',
				'hide' => true,
				'default' => '',
				'description' => __('Show title.','easy-fancybox') . ' ' . __('FancyBox will try to get a title from the link or thumbnail title attributes.','easy-fancybox')
			),
			'titlePosition' => array (
				'id' => 'fancybox_YoutubetitlePosition',
				'title' => __('Title Position','easy-fancybox'),
				'label_for' => 'fancybox_YoutubetitlePosition',
				'input' => 'select',
				'hide' => true,
				'options' => array(
					'float' => __('Float','easy-fancybox'),
					'outside' => __('Outside','easy-fancybox'),
					'inside' => __('Inside','easy-fancybox')
				),
				'default' => 'float',
				'description' => '<br />'
			),
			'titleFromAlt' => array (
				'id' => 'fancybox_YoutubetitleFromAlt',
				'input' => 'checkbox',
				'hide' => true,
				'default' => '1',
				'description' => __('Allow title from thumbnail alt attribute.','easy-fancybox')
			)
		)
	),

	'Vimeo' => array(
		'title' => __('Vimeo','easy-fancybox'),
		'input' => 'multiple',
		'options' => array(
			'intro' => array (
				'hide' => true,
				'description' => __('To make any Vimeo movie open in an overlay, switch on Autodetect or use the class "fancybox-vimeo" for its link.','easy-fancybox') . '<br />'
			),
			'autoAttribute' => array (
				'id' => 'fancybox_autoAttributeVimeo',
				'input' => 'checkbox',
				'hide' => true,
				'default' => '1',
				'selector' => '\'a[href*="vimeo.com/"],area[href*="vimeo.com/"]\').filter(function(){return this.href.match(/\/(?:[0-9]+|video\/)/);}',
				'description' => __('Autodetect','easy-fancybox') . '<br />'
			),
			'tag' => array (
				'hide' => true,
				'default' => 'a.fancybox-vimeo,area.fancybox-vimeo,li.fancybox-vimeo>a'
			),
			'class' => array (
				'hide' => true,
				'default' => 'fancybox-vimeo'
			),
			'width' => array (
				'id' => 'fancybox_VimeoWidth',
				'title' => translate('Width'),
				'label_for' => 'fancybox_VimeoWidth',
				'input' => 'number',
				'step' => '1',
				'min' => '400',
				'max' => '1500',
				'sanitize_callback' => 'intval',
				'class' => 'small-text',
				'default' => '500',
				'description' => ' '
			),
			'height' => array (
				'id' => 'fancybox_VimeoHeight',
				'title' => translate('Height'),
				'label_for' => 'fancybox_VimeoHeight',
				'input' => 'number',
				'step' => '1',
				'min' => '225',
				'max' => '900',
				'sanitize_callback' => 'intval',
				'class' => 'small-text',
				'default' => '281'
			),
			'padding' => array (
				'id' => 'fancybox_Vimeopadding',
				'title' => translate('Border'),
				'label_for' => 'fancybox_Vimeopadding',
				'input' => 'number',
				'step' => '1',
				'min' => '0',
				'max' => '100',
				'sanitize_callback' => 'intval',
				'class' => 'small-text',
				'default' => '0',
				'description' => '<br /><br />'
			),
			'aspectRatio' => array(
				'default' => '1'
			),
			'titleShow' => array (
				'id' => 'fancybox_VimeotitleShow',
				'input' => 'checkbox',
				'hide' => true,
				'default' => '',
				'description' => __('Show title.','easy-fancybox') . ' ' . __('FancyBox will try to get a title from the link or thumbnail title attributes.','easy-fancybox')
			),
			'titlePosition' => array (
				'id' => 'fancybox_VimeotitlePosition',
				'title' => __('Title Position','easy-fancybox'),
				'label_for' => 'fancybox_VimeotitlePosition',
				'input' => 'select',
				'hide' => true,
				'options' => array(
					'float' => __('Float','easy-fancybox'),
					'outside' => __('Outside','easy-fancybox'),
					'inside' => __('Inside','easy-fancybox')
				),
				'default' => 'float',
				'description' => '<br />'
			),
			'titleFromAlt' => array (
				'id' => 'fancybox_VimeotitleFromAlt',
				'input' => 'checkbox',
				'hide' => true,
				'default' => '1',
				'description' => __('Allow title from thumbnail alt attribute.','easy-fancybox')
			)
		)
	),

	'Dailymotion' => array(
		'title' => __('Dailymotion','easy-fancybox'),
		'input' => 'multiple',
		'options' => array(
			'intro' => array (
				'hide' => true,
				'description' => __('To make any Dailymotion movie open in an overlay, switch on Autodetect or use the class "fancybox-dailymotion" for its link.','easy-fancybox') . '<br />'
			),
			'autoAttribute' => array (
				'id' => 'fancybox_autoAttributeDailymotion',
				'input' => 'checkbox',
				'hide' => true,
				'default' => '1',
				'selector' => '\'a[href*="dailymotion.com/"],area[href*="dailymotion.com/"]\').filter(function(){return this.href.match(/\/video\//);}',
				'description' => __('Autodetect','easy-fancybox') . '<br />'
			),
			'tag' => array (
				'hide' => true,
				'default' => 'a.fancybox-dailymotion,area.fancybox-dailymotion,li.fancybox-dailymotion>a'
			),
			'class' => array (
				'hide' => true,
				'default' => 'fancybox-dailymotion'
			),
			'width' => array (
				'id' => 'fancybox_DailymotionWidth',
				'title' => translate('Width'),
				'label_for' => 'fancybox_DailymotionWidth',
				'input' => 'number',
				'step' => '1',
				'min' => '320',
				'max' => '1500',
				'sanitize_callback' => 'intval',
				'class' => 'small-text',
				'default' => '560',
				'description' => ' '
			),
			'height' => array (
				'id' => 'fancybox_DailymotionHeight',
				'title' => translate('Height'),
				'label_for' => 'fancybox_DailymotionHeight',
				'input' => 'number',
				'step' => '1',
				'min' => '180',
				'max' => '900',
				'sanitize_callback' => 'intval',
				'class' => 'small-text',
				'default' => '315'
			),
			'padding' => array (
				'id' => 'fancybox_DailymotionPadding',
				'title' => translate('Border'),
				'label_for' => 'fancybox_DailymotionPadding',
				'input' => 'number',
				'step' => '1',
				'min' => '0',
				'max' => '100',
				'sanitize_callback' => 'intval',
				'class' => 'small-text',
				'default' => '0',
				'description' => '<br /><br />'
			),
			'aspectRatio' => array(
				'default' => '1'
			),
			'titleShow' => array (
				'id' => 'fancybox_DailymotiontitleShow',
				'input' => 'checkbox',
				'hide' => true,
				'default' => '',
				'description' => __('Show title.','easy-fancybox') . ' ' . __('FancyBox will try to get a title from the link or thumbnail title attributes.','easy-fancybox')
			),
			'titlePosition' => array (
				'id' => 'fancybox_DailymotiontitlePosition',
				'title' => __('Title Position','easy-fancybox'),
				'label_for' => 'fancybox_DailymotiontitlePosition',
				'input' => 'select',
				'hide' => true,
				'options' => array(
					'float' => __('Float','easy-fancybox'),
					'outside' => __('Outside','easy-fancybox'),
					'inside' => __('Inside','easy-fancybox')
				),
				'default' => 'float',
				'description' => '<br />'
			),
			'titleFromAlt' => array (
				'id' => 'fancybox_DailymotiontitleFromAlt',
				'input' => 'checkbox',
				'hide' => true,
				'default' => '1',
				'description' => __('Allow title from thumbnail alt attribute.','easy-fancybox')
			)
		)
	),

/*		'Tudou' => array(
		'id' => 'fancybox_Tudou',
		'title' => __('Tudou','easy-fancybox'),
		'label_for' => '',
		'input' => 'multiple',
		'class' => '',			'description' =>  '',
		'options' => array(
			 'autoAttributeTudou' => array (
				'id' => 'fancybox_autoAttributeTudou',
				'label_for' => '',
				'input' => 'checkbox',
				'class' => '',
				'options' => array(),
				'hide' => true,
				'default' => '1',
				'description' => __('Tudou links','easy-fancybox')
				)
			)
		),*/

/*		'Animoto' => array(),

Example ANIMOTO page link http://animoto.com/play/Kf9POzQMSOGWyu41gtOtsw should become
http://static.animoto.com/swf/w.swf?w=swf/vp1&f=Kf9POzQMSOGWyu41gtOtsw&i=m

*/

	'iFrame' => array(
		'title' => __('iFrames','easy-fancybox'),
		'input' => 'multiple',
		'options' => array(
			'intro' => array (
				'hide' => true,
				'description' => __('To make a website or HTML document open in an overlay, use the class "fancybox-iframe" for its link.','easy-fancybox') . '<br /><br />'
			),
			'tag' => array (
				'hide' => true,
				'default' => 'a.fancybox-iframe,area.fancybox-iframe,li.fancybox-iframe>a'
			),
			'class' => array (
				'hide' => true,
				'default' => 'fancybox-iframe'
			),
			'type' => array (
				'default' => 'iframe'
			),
			'width' => array (
				'id' => 'fancybox_iFramewidth',
				'title' => translate('Width'),
				'label_for' => 'fancybox_iFramewidth',
				'input' => 'text',
				'sanitize_callback' => 'intval',
				'class' => 'small-text',
				'default' => '70%',
				'description' => ' '
			),
			'height' => array (
				'id' => 'fancybox_iFrameheight',
				'title' => translate('Height'),
				'label_for' => 'fancybox_iFrameheight',
				'input' => 'text',
				'sanitize_callback' => 'intval',
				'class' => 'small-text',
				'default' => '90%',
			),
			'padding' => array (
				'id' => 'fancybox_iFramepadding',
				'title' => translate('Border'),
				'label_for' => 'fancybox_iFramepadding',
				'input' => 'number',
				'step' => '1',
				'min' => '0',
				'max' => '100',
				'sanitize_callback' => 'intval',
				'class' => 'small-text',
				'default' => '0',
				'description' => '<br /><br />'
			),
			'titleShow' => array (
				'id' => 'fancybox_iFrametitleShow',
				'input' => 'checkbox',
				'hide' => true,
				'default' => '',
				'description' => __('Show title.','easy-fancybox') . ' ' . __('FancyBox will try to get a title from the link or thumbnail title attributes.','easy-fancybox')
			),
			'titlePosition' => array (
				'id' => 'fancybox_iFrametitlePosition',
				'title' => __('Title Position','easy-fancybox'),
				'label_for' => 'fancybox_iFrametitlePosition',
				'input' => 'select',
				'hide' => true,
				'options' => array(
					'float' => __('Float','easy-fancybox'),
					'outside' => __('Outside','easy-fancybox'),
					'inside' => __('Inside','easy-fancybox')
				),
				'default' => 'float',
				'description' => '<br />'
			),
			'titleFromAlt' => array (
				'id' => 'fancybox_iFrametitleFromAlt',
				'input' => 'checkbox',
				'hide' => true,
				'default' => '1',
				'description' => __('Allow title from thumbnail alt attribute.','easy-fancybox') . '<br/>'
			),
			'allowfullscreen' => array (
				'id' => 'fancybox_allowFullScreen',
				'input' => 'checkbox',
				'default' => '',
				'description' => __('Allow embedded content to jump to full screen mode','easy-fancybox')
			)
		)
	)
);
