<?php
/**
* Options for Fancybox Classic, Legacy, and V2 Lightboxes
*/

if ( ! function_exists( 'efb_pro_button'  )) {
	function efb_pro_button( $add_options = false ) {
		if ( ! class_exists('easyFancyBox_Advanced') ) {
			$options_prompt = $add_options ? __( 'Want more options? ' ) : '';
			return $options_prompt . '<a class="pro-button" href="'.easyFancyBox::$pro_plugin_url.'">' . __('Get Pro','easy-fancybox') . '</a>';
		}
	}
}

$efb_options = array (
	'Global' => array(
		'title' => __('Global settings','easy-fancybox'),
		'backwardcompatible' => true, // Marks older Pro version compatibility.
		'input' => 'deep',
		'hide' => true,
		'options' => array(
			'Enable' => array (
				'title' => __('Enable','easy-fancybox'),
				'slug' => 'enable-settings-section',
				'input' => 'multiple',
				'hide' => true,
				'options' => array(
					'IMG' => array (
						'id' => 'fancybox_enableImg',
						'title' => __( 'Enable for Images','easy-fancybox' ),
						'input' => 'checkbox',
						'sanitize_callback' => 'wp_validate_boolean',
						'hide' => true,
						'default' => ( function_exists( 'is_plugin_active_for_network' ) && is_plugin_active_for_network( EASY_FANCYBOX_BASENAME ) ) ? '' : '1',
					),
					'Inline' => array (
						'id' => 'fancybox_enableInline',
						'title' => __( 'Enable for Inline Content','easy-fancybox' ),
						'input' => 'checkbox',
						'sanitize_callback' => 'wp_validate_boolean',
						'hide' => true,
						'default' => '',
					),
					'PDF' => array (
						'id' => 'fancybox_enablePDF',
						'title' => __( 'Enable for PDFs','easy-fancybox' ),
						'input' => 'checkbox',
						'sanitize_callback' => 'wp_validate_boolean',
						'hide' => true,
						'default' => '',
					),
					'SWF' => array (
						'id' => 'fancybox_enableSWF',
						'title' => __( 'Enable for SWFs','easy-fancybox' ),
						'input' => 'checkbox',
						'sanitize_callback' => 'wp_validate_boolean',
						'hide' => true,
						'default' => '',
						'exclude' => array( 'classic', 'fancybox2' ),
					),
					'SVG' => array (
						'id' => 'fancybox_enableSVG',
						'title' => __( 'Enable for SVGs','easy-fancybox' ),
						'input' => 'checkbox',
						'sanitize_callback' => 'wp_validate_boolean',
						'hide' => true,
						'default' => '',
					),
					'VideoPress' => array (
						'id' => '',
						'title' => __( 'Enable for VideoPress','easy-fancybox' ),
						'input' => 'checkbox',
						'sanitize_callback' => 'wp_validate_boolean',
						'hide' => true,
						'default' => '',
						'status' => 'disabled',
						'description' => efb_pro_button()
					),
					'YouTube' => array (
						'id' => 'fancybox_enableYoutube',
						'title' => __( 'Enable for Youtube','easy-fancybox' ),
						'input' => 'checkbox',
						'sanitize_callback' => 'wp_validate_boolean',
						'hide' => true,
						'default' => '',
					),
					'Vimeo' => array (
						'id' => 'fancybox_enableVimeo',
						'title' => __( 'Enable for Vimeo','easy-fancybox' ),
						'input' => 'checkbox',
						'sanitize_callback' => 'wp_validate_boolean',
						'hide' => true,
						'default' => '',
					),
					'Dailymotion' => array (
						'id' => 'fancybox_enableDailymotion',
						'title' => __( 'Enable for Dailymotion','easy-fancybox' ),
						'input' => 'checkbox',
						'sanitize_callback' => 'wp_validate_boolean',
						'hide' => true,
						'default' => '',
					),
					'iFrame' => array (
						'id' => 'fancybox_enableiFrame',
						'title' => __( 'Enable for iFrames','easy-fancybox' ),
						'input' => 'checkbox',
						'sanitize_callback' => 'wp_validate_boolean',
						'hide' => true,
						'default' => '',
					)
				),
				'description' => ''
			),
			'Window' => array (
				'title' => __('Window Appearance','easy-fancybox'),
				'slug' => 'window-settings-section',
				'input' => 'multiple',
				'hide' => true,
				'options' => array(
					'autoScale' => array (
						'id' => 'fancybox_autoScale',
						'title' => __('Auto scale to fit','easy-fancybox'),
						'input' => 'checkbox',
						'sanitize_callback' => 'wp_validate_boolean',
						'noquotes' => true,
						'fancybox_name' => 'fitToView',
						'default' => '1',
						'description' => __('Scale large content down to fit in the browser viewport.','easy-fancybox')
					),
					'showCloseButton' => array (
						'id' => 'fancybox_showCloseButton',
						'title' => __('Show close button','easy-fancybox'),
						'input' => 'checkbox',
						'sanitize_callback' => 'wp_validate_boolean',
						'fancybox2_name' => 'closeBtn',
						'noquotes' => true,
						'default' => '1',
						'description' => __('Show the (X) close button','easy-fancybox')
					),
					'width' => array (
						'id' => 'fancybox_width',
						'title' => translate('Window width'),
						'label_for' => 'fancybox_width',
						'input' => 'text',
						'sanitize_callback' => 'intval',
						'default' => '560',
						'description' => __( 'Default of 560 ussed if not set or cannot be determined automatically.' ),
					),
					'height' => array (
						'id' => 'fancybox_height',
						'title' => translate('Window height'),
						'label_for' => 'fancybox_height',
						'input' => 'text',
						'sanitize_callback' => 'intval',
						'default' => '340',
						'description' => __( 'Default of 340 ussed if not set or cannot be determined automatically.' ),
					),
					'margin' => array (
						'id' => 'fancybox_margin',
						'title' => __('Window margin','easy-fancybox'),
						'label_for' => 'fancybox_margin',
						'input' => 'number',
						'step' => '1',
						'min' => '20',
						'max' => '80',
						'sanitize_callback' => array( 'easyFancyBox_Admin', 'sanitize_number' ),
						'default' => '20',
						'description' => __( 'Default: 20' )
					),
					'backgroundColor' => array (
						'id' => 'fancybox_backgroundColor',
						'hide' => true,
						'title' => __('Window background color','easy-fancybox'),
						'label_for' => 'fancybox_backgroundColor',
						'input' => 'text',
						'sanitize_callback' => 'sanitize_hex_color',
						'status' => 'disabled',
						'default' => '#ffffff',
						'description' => efb_pro_button()
					),
					'paddingColor' => array (
						'id' => 'fancybox_paddingColor',
						'hide' => true,
						'title' => __('Border color','easy-fancybox'),
						'label_for' => 'fancybox_paddingColor',
						'input' => 'text',
						'sanitize_callback' => array( 'easyFancyBox_Admin', 'colorval' ),
						'default' => '#ffffff',
						'description' => __('Use RGBA notation for semi-transparent borders.','easy-fancybox') . ' ' . __('Example:','easy-fancybox') . ' rgba(10,10,30,0.7)'
					),
					'padding' => array (
						'id' => 'fancybox_padding',
						'title' => translate('Border width'),
						'label_for' => 'fancybox_padding',
						'input' => 'number',
						'step' => '1',
						'min' => '0',
						'max' => '100',
						'sanitize_callback' => array( 'easyFancyBox_Admin', 'sanitize_number' ),
						'default' => '10',
						'description' => __( 'Default: 10' )
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
						'sanitize_callback' => array( 'easyFancyBox_Admin', 'sanitize_number' ),
						'status' => 'disabled',
						'default' => '0',
						'description' => efb_pro_button()
					),
					'titleColor' => array (
						'id' => 'fancybox_titleColor',
						'hide' => true,
						'title' => __('Title color','easy-fancybox'),
						'label_for' => 'fancybox_titleColor',
						'input' => 'text',
						'sanitize_callback' => 'sanitize_hex_color',
						'default' => '#fff',
						'description' => ''
					),
					'textColor' => array (
						'id' => 'fancybox_textColor',
						'hide' => true,
						'title' => __('Text color','easy-fancybox'),
						'label_for' => 'fancybox_textColor',
						'input' => 'text',
						'sanitize_callback' => 'sanitize_hex_color',
						'status' => 'disabled',
						'default' => '#000000',
						'description' => efb_pro_button()
					),
					'centerOnScroll' => array (
						'id' => 'fancybox_centerOnScroll',
						'title' => __('Center when scrolling','easy-fancybox'),
						'input' => 'checkbox',
						'sanitize_callback' => 'wp_validate_boolean',
						'noquotes' => true,
						'default' => '',
						'exclude' => array( 'classic', 'fancybox2' ),
						'description' => __('Disabled on touch devices and when content might be larger than the viewport.','easy-fancybox')
					),
					'enableEscapeButton' => array (
						'id' => 'fancybox_enableEscapeButton',
						'title' => __('Enable ESC key','easy-fancybox'),
						'input' => 'checkbox',
						'sanitize_callback' => 'wp_validate_boolean',
						'noquotes' => true,
						'fancybox2_hide' => true,
						'default' => '1',
						'description' => __('Esc key closes FancyBox','easy-fancybox')
					),
					'speedIn' => array (
						'id' => 'fancybox_speedIn',
						'title' => __('Opening speed','easy-fancybox'),
						'label_for' => 'fancybox_speedIn',
						'input' => 'number',
						'fancybox2_name' => 'openSpeed',
						'step' => '100',
						'min' => '0',
						'max' => '6000',
						'sanitize_callback' => array( 'easyFancyBox_Admin', 'sanitize_number' ),
						'default' => '300',
						'description' => __('Duration in milliseconds. Higher is slower.','easy-fancybox') . ' <em>' . __('Default:','easy-fancybox')  . ' 300</em>'
					),
					'speedOut' => array (
						'id' => 'fancybox_speedOut',
						'title' => __('Closing speed','easy-fancybox'),
						'label_for' => 'fancybox_speedOut',
						'input' => 'number',
						'fancybox2_name' => 'closeSpeed',
						'step' => '100',
						'min' => '0',
						'max' => '6000',
						'sanitize_callback' => array( 'easyFancyBox_Admin', 'sanitize_number' ),
						'default' => '300',
						'description' => __('Duration in milliseconds. Higher is slower.','easy-fancybox') . ' <em>' . __('Default:','easy-fancybox')  . ' 300</em>'
					),
					'mouseWheel' => array (
						'id' => 'fancybox_mouseWheel',
						'title' => __('Load mousewheel script','easy-fancybox'),
						'hide' => true,
						'input' => 'checkbox',
						'sanitize_callback' => 'wp_validate_boolean',
						'default' => '',
						'description' => __('Include Mousewheel jQuery extension to allow gallery browsing by mousewheel action.','easy-fancybox')
					)
				)
			),
			'Overlay' => array (
				'title' => __('Overlay Appearance','easy-fancybox'),
				'slug' => 'overlay-settings-section',
				'input' => 'multiple',
				'hide' => true,
				'options' => array(
					'overlayShow' => array (
						'id' => 'fancybox_overlayShow',
						'title' => __('Show overlay','easy-fancybox'),
						'input' => 'checkbox',
						'sanitize_callback' => 'wp_validate_boolean',
						'noquotes' => true,
						'fancybox2_hide' => true,
						'default' => '1',
						'description' => __('Show the overlay around content opened in FancyBox.','easy-fancybox')
					),
					'hideOnOverlayClick' => array (
						'id' => 'fancybox_hideOnOverlayClick',
						'title' => __('Close when overlay clicked','easy-fancybox'),
						'input' => 'checkbox',
						'sanitize_callback' => 'wp_validate_boolean',
						'noquotes' => true,
						'fancybox2_hide' => true,
						'default' => '1',
						'description' => __('Close FancyBox when overlay is clicked.','easy-fancybox')
					),
					'overlayColor' => array (
						'id' => 'fancybox_overlayColor',
						'title' => __('Overlay color','easy-fancybox'),
						'label_for' => 'fancybox_overlayColor',
						'input' => 'text',
						'sanitize_callback' => 'sanitize_text_field',
						'default' => '#000',
						'description' => __('Enter an HTML color value.','easy-fancybox') . ' <em>' . __('Default:','easy-fancybox')  . ' #000</em>'
					),
					'overlayColor2' => array (
						'id' => 'fancybox_overlayColor2',
						'title' => __('Overlay color','easy-fancybox'),
						'label_for' => 'fancybox_overlayColor2',
						'input' => 'text',
						'fancybox2_name' => 'overlayColor',
						'exclude' => array( 'classic', 'legacy' ),
						'hide' => true,
						'sanitize_callback' => 'sanitize_text_field',
						'default' => '',
						'description' => __('Enter an RGBA color value.','easy-fancybox') . ' <em>' . __('Example:','easy-fancybox') . ' rgba(119,119,119,0.7)</em>'
					),
					'overlayOpacity' => array (
						'id' => 'fancybox_overlayOpacity',
						'title' => __('Overlay opacity','easy-fancybox'),
						'label_for' => 'fancybox_overlayOpacity',
						'input' => 'number',
						'sanitize_callback' => array( 'easyFancyBox_Admin', 'sanitize_number' ),
						'step' => '0.1',
						'min' => '0',
						'max' => '1',
						'default' => '0.6',
						'description' => __('Value between 0 and 1. ','easy-fancybox') . ' <em>' . __('Default:','easy-fancybox')  . ' 0.6</em>'
					),
					'overlaySpotlight' => array (
						'id' => 'fancybox_overlaySpotlight',
						'title' => __('Overlay spotlight effect','easy-fancybox'),
						'input' => 'checkbox',
						'sanitize_callback' => 'wp_validate_boolean',
						'hide' => true,
						'status' => get_option('fancybox_overlaySpotlight') ? '' : 'disabled',
						'default' => '',
						'description' => __('Show gradient spotlight effect around image.','easy-fancybox') . efb_pro_button()
					)
				)
			),
			'Miscellaneous' => array (
				'title' => __('Miscellaneous','easy-fancybox'),
				'input' => 'multiple',
				'slug' => 'miscellaneous-settings-section',
				'hide' => true,
				'options' => array(
					'autoClick' => array (
						'id' => 'fancybox_autoClick',
						'title' => __('Enable autopopup','easy-fancybox'),
						'label_for' => 'fancybox_autoClick',
						'hide' => true,
						'input' => 'select',
						'options' => array(
							'' => translate('None'),
							'1' => __('Link with ID "fancybox-auto"','easy-fancybox'),
						),
						'sanitize_callback' => 'wp_validate_boolean',
						'default' => '1',
						'description' => __( 'Open lightbox automatically on page load' )
					),
					'delayClick' => array (
						'id' => 'fancybox_delayClick',
						'title' => __('Autopopup - delay','easy-fancybox'),
						'label_for' => 'fancybox_delayClick',
						'hide' => true,
						'input' => 'number',
						'step' => '100',
						'min' => '0',
						'max' => '',
						'sanitize_callback' => array( 'easyFancyBox_Admin', 'sanitize_number' ),
						'default' => '1000',
						'description' => __( 'Delay in milliseconds' ) . ' <em>' . __('Default:','easy-fancybox')  . ' 1000</em>'
					),
					'jqCookie' => array (
						'id' => '',
						'title' => __('Autopopup - hide after first','easy-fancybox'),
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
						'description' => __( 'Hide auto popup for X time after first visit. ' ) . efb_pro_button()
					),
					'cookiePath' => array (
						// 'id' => '',
						'default' => '',
						'hide' => true
					),
					'minViewportWidth' => array (
						'id' => 'fancybox_minViewportWidth',
						'title' => __('Minimum viewport width','easy-fancybox'),
						'label_for' => 'fancybox_minViewportWidth',
						'input' => 'number',
						'fancybox2_name' => 'minVpWidth',
						'step' => '1',
						'min' => '320',
						'max' => '900',
						'sanitize_callback' => array( 'easyFancyBox_Admin', 'sanitize_number' ),
						'default' => '320',
						'description' => '<em>' . __('Default:','easy-fancybox') . ' 320</em>'
					),
					'minVpHeight' => array (
						'id' => 'fancybox_minViewportHeight',
						'title' => __('Minimum viewport height','easy-fancybox'),
						'label_for' => 'fancybox_minViewportHeight',
						'input' => 'number',
						'step' => '1',
						'min' => '320',
						'max' => '900',
						'exclude' => array( 'classic', 'legacy' ),
						'sanitize_callback' => array( 'easyFancyBox_Admin', 'sanitize_number' ),
						'default' => '320',
						'description' => '<em>' . __('Default:','easy-fancybox') . ' 320</em><br />'
					),
					'compatIE8' => array (
						'id' => 'fancybox_compatIE8',
						'title' => __('IE 8 compatibility','easy-fancybox'),
						'input' => 'checkbox',
						'sanitize_callback' => 'wp_validate_boolean',
						'hide' => true,
						'default' => '',
						'exclude' => array( 'classic', 'fancybox2' ),
						'description' => __('Include IE 8 compatibility style rules','easy-fancybox')
					),
					'p2' => array (
						'hide' => true,
						'description' => '<br /><strong>' . __('Theme & plugins compatibility','easy-fancybox') . '</strong><br />' . __('Try to deactivate all conflicting light box scripts in your theme or other plugins. If this is not possible, try a higher script priority number which means scripts are added later, wich may allow them to override conflicting scripts. A lower priority number, excluding WordPress standard jQuery, or even moving the plugin scripts to the header may work in cases where there are blocking errors occuring in other script.','easy-fancybox')
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
						'sanitize_callback' => array( 'easyFancyBox_Admin', 'sanitize_number' ),
						'default' => '10',
						'description' => __('Default priority is 10.','easy-fancybox') . ' ' . __('Higher is later.','easy-fancybox')
					),
					'noFooter' => array (
						'id' => 'fancybox_noFooter',
						'title' => __('Load scripts in head','easy-fancybox'),
						'input' => 'checkbox',
						'sanitize_callback' => 'wp_validate_boolean',
						'hide' => true,
						'default' => '',
						'description' => __('Move scripts from footer to theme head section (not recommended for site load times!)','easy-fancybox')
					),
					'nojQuery' => array (
						'id' => 'fancybox_nojQuery',
						'title' => __('Exclude core jQuery','easy-fancybox'),
						'input' => 'checkbox',
						'sanitize_callback' => 'wp_validate_boolean',
						'hide' => true,
						'default' => '',
						'description' => __('Do not include standard WordPress jQuery library (do this only if you are sure jQuery is included from another source!)','easy-fancybox')
					),
					'pre45Compat' => array (
						'id' => 'fancybox_pre45Compat',
						'title' => __('Exclude inline_script','easy-fancybox'),
						'input' => 'checkbox',
						'sanitize_callback' => 'wp_validate_boolean',
						'hide' => true,
						'default' => function_exists( 'wp_add_inline_script' ) ? '' : '1',
						'description' => __('Do not use wp_add_inline_script/style (may solve issues with old minification plugins)','easy-fancybox')
					),
					'p3' => array (
						'hide' => true,
						'description' => '<br /><strong>' . __('Advanced','easy-fancybox') . '</strong><br />'
					),
					'metaData' => array (
						'id' => 'fancybox_metaData',
						'title' => __('Include metadata script','easy-fancybox'),
						'hide' => true,
						'input' => 'checkbox',
						'sanitize_callback' => 'wp_validate_boolean',
						'status' => get_option('fancybox_metaData') ? '' : 'disabled',
						'default' =>  '',
						'description' => __('Include Metadata jQuery extension to allow passing custom parameters via link class.','easy-fancybox') . efb_pro_button()
					),
					'vcMasonryCompat' => array (
						'id' => 'fancybox_vcMasonryCompat',
						'title' => __('WPBakery compatibility','easy-fancybox'),
						'hide' => true,
						'input' => 'checkbox',
						'sanitize_callback' => 'wp_validate_boolean',
						'status' => 'disabled',
						'default' =>  '',
						'description' => __('WPBakery / VC Masonry compatibility, replaces prettyPhoto lightbox. ','easy-fancybox') . efb_pro_button()
					),
					'autoExclude' => array (
						'id' => 'fancybox_autoExclude',
						'title' => __('Exclude','easy-fancybox'),
						'label_for' => 'fancybox_autoExclude',
						'input' => 'text',
						'class' => 'regular-text',
						'hide' => true,
						'default' => '.nolightbox,a.wp-block-file__button,a.pin-it-button,a[href*=\'pinterest.com/pin/create\'],a[href*=\'facebook.com/share\'],a[href*=\'twitter.com/share\']',
						'sanitize_callback' => 'sanitize_text_field',
						'description' => __( 'Comma-separated list of selectors to exclude for lightbox autodetect.','easy-fancybox') . ' <em>' . __('Default:','easy-fancybox') . ' .nolightbox,a.wp-block-file__button,a.pin-it-button,a[href*=\'pinterest.com/pin/create\'],a[href*=\'facebook.com/share\'],a[href*=\'twitter.com/share\']</em><br />'
					)
				)
			)
		)
	),
	'IMG' => array(
		'title' => __('Images','easy-fancybox'),
		'slug' => 'image-settings-section',
		'section_description' => function() {
			echo '<div class="setting-section-description">' . __( 'To make images open in an overlay, add their extension to the Autodetect field or use the class "fancybox" for its link. Clear field to switch off all autodetection.', 'easy-fancybox' ) . '</div>';
		},
		'input' => 'multiple',
		'options' => array(
			'tag' => array (
				'hide' => true,
				'default' => 'a.fancybox,area.fancybox,.fancybox>a'
			),
			'class' => array (
				'hide' => true,
				'default' => 'fancybox image'
			),
			'autoAttribute' => array (
				'id' => 'fancybox_autoAttribute',
				'title' => __('Autodetect','easy-fancybox'),
				'label_for' => 'fancybox_autoAttribute',
				'input' => 'text',
				'class' => 'regular-text',
				'hide' => true,
				'default' => '.jpg,.png,.webp,.jpeg',
				'sanitize_callback' => 'sanitize_text_field',
				'selector' => 'href*=',
				'description' => __('Comma-separated list of file extensions to detect. Clear field to disable autodetection. ','easy-fancybox') . ' ' . __('Example:','easy-fancybox') . ' .jpg,.png,.gif,.jpeg'
			),
			'autoAttributeLimit' => array (
				'id' => 'fancybox_autoAttributeLimit',
				'title' => __('Apply to','easy-fancybox'),
				'label_for' => 'fancybox_autoAttributeLimit',
				'hide' => true,
				'input' => 'select',
				'sanitize_callback' => 'sanitize_text_field',
				'options' => array(
					'' => __('All image links', 'easy-fancybox')
				),
				'default' => '',
				'description' => efb_pro_button( true )
			),
			'type' => array (
				'id' => 'fancybox_classType',
				'title' => __('Treat fancybox class as image','easy-fancybox'),
				'label_for' => 'fancybox_classType',
				'input' => 'select',
				'sanitize_callback' => 'sanitize_text_field',
				'options' => array(
					'image' => translate('Yes'),
					'' => translate('No')
				),
				'default' => get_option('fancybox_enableInline') ? 'image' : '',
				'description' => __('Force FancyBox to treat all media linked with class="fancybox" as images?','easy-fancybox')
			),
			'transitionIn' => array (
				'id' => 'fancybox_transitionIn',
				'title' => __('Transition In','easy-fancybox'),
				'label_for' => 'fancybox_transitionIn',
				'input' => 'select',
				'sanitize_callback' => 'sanitize_text_field',
				'fancybox2_name' => 'openEffect',
				'options' => array(
					'none' => translate('None'),
					'' => __('Fade','easy-fancybox'),
					'elastic' => __('Elastic','easy-fancybox'),
				),
				'default' => 'elastic',
				'description' => efb_pro_button( true )
			),
			'easingIn' => array (
				'id' => 'fancybox_easingIn',
				'title' => __('Easing In','easy-fancybox'),
				'label_for' => 'fancybox_easingIn',
				'input' => 'select',
				'sanitize_callback' => 'sanitize_text_field',
				'options' => array(
					'linear' => __('Linear','easy-fancybox'),
					'' => __('Swing','easy-fancybox')
				),
				'default' => '',
				'description' => __('Only applies when Transition is set to Elastic. ','easy-fancybox') . efb_pro_button( true )
			),
			'transitionOut' => array (
				'id' => 'fancybox_transitionOut',
				'title' => __('Transition Out','easy-fancybox'),
				'label_for' => 'fancybox_transitionOut',
				'input' => 'select',
				'sanitize_callback' => 'sanitize_text_field',
				'fancybox2_name' => 'closeEffect',
				'options' => array(
					'none' => translate('None'),
					'' => __('Fade','easy-fancybox'),
					'elastic' => __('Elastic','easy-fancybox'),
				),
				'default' => 'elastic',
				'description' => efb_pro_button( true )
			),
			'easingOut' => array (
				'id' => 'fancybox_easingOut',
				'title' => __('Easing Out','easy-fancybox'),
				'label_for' => 'fancybox_easingOut',
				'input' => 'select',
				'sanitize_callback' => 'sanitize_text_field',
				'options' => array(
					'linear' => __('Linear','easy-fancybox'),
					'' => __('Swing','easy-fancybox')
				),
				'default' => '',
				'description' => __('Only applies when Transition is set to Elastic. ','easy-fancybox') . efb_pro_button( true )
			),
			'opacity' => array (
				'id' => 'fancybox_opacity',
				'title' => __('Transition Opacity','easy-fancybox'),
				'input' => 'checkbox',
				'sanitize_callback' => 'wp_validate_boolean',
				'noquotes' => true,
				'default' => '',
				'description' => __('Transparency fade during elastic transition. CAUTION: Use only when at least Transition In is set to Elastic!','easy-fancybox')
			),
			'hideOnContentClick' => array (
				'id' => 'fancybox_hideOnContentClick',
				'title' => __('Close on click','easy-fancybox'),
				'input' => 'checkbox',
				'sanitize_callback' => 'wp_validate_boolean',
				'noquotes' => true,
				'fancybox2_name' => 'closeClick',
				'default' => '',
				'description' => __('Close FancyBox when content is clicked','easy-fancybox')
			),
			'titleShow' => array (
				'id' => 'fancybox_titleShow',
				'title' => __('Show title','easy-fancybox'),
				'input' => 'checkbox',
				'sanitize_callback' => 'wp_validate_boolean',
				'noquotes' => true,
				'fancybox2_hide' => true,
				'default' => '1',
				'description' => __('FancyBox will try to get a title from the link or thumbnail title attributes.','easy-fancybox')
			),
			'titlePosition' => array (
				'id' => 'fancybox_titlePosition',
				'title' => __('Title Position','easy-fancybox'),
				'label_for' => 'fancybox_titlePosition',
				'input' => 'select',
				'sanitize_callback' => 'sanitize_text_field',
				'fancybox2_hide' => true,
				'exclude' => array( 'fancybox2' ),
				'options' => array(
					'over' => __('Overlay','easy-fancybox'),
					'outside' => __('Outside','easy-fancybox'),
					'inside' => __('Inside','easy-fancybox'),
					'' => __('Float','easy-fancybox'),
				),
				'default' => 'over',
			),
			'titlePosition2' => array (
				'id' => 'fancybox_titlePosition2',
				'title' => __('Title Style','easy-fancybox'),
				'label_for' => 'fancybox_titlePosition2',
				'input' => 'select',
				'sanitize_callback' => 'sanitize_text_field',
				'hide' => true,
				'exclude' => array( 'classic', 'legacy' ),
				'fancybox2_name' => 'titlePosition',
				'options' => array(
					'over' => __('Overlay','easy-fancybox'),
					'outside' => __('Outside','easy-fancybox'),
					'outside-top' => __('Outside top','easy-fancybox'),
					'inside' => __('Inside','easy-fancybox'),
					'inside-top' => __('Inside top','easy-fancybox'),
					'' => __('Float','easy-fancybox'),
					
				),
				'default' => 'over',
			),
			'titleFromAlt' => array (
				'id' => 'fancybox_titleFromAlt',
				'title' => __('Title from alt','easy-fancybox'),
				'input' => 'checkbox',
				'sanitize_callback' => 'wp_validate_boolean',
				'noquotes' => true,
				'fancybox2_hide' => true,
				'default' => '1',
				'description' => __('Allow title from thumbnail alt attribute.','easy-fancybox')
			),
			'onStart' => array (
				'id' => 'fancybox_onStart',
				'title' => __( 'Show title on hover' ),
				'hide' => true,
				'input' => 'checkbox',
				'sanitize_callback' => 'wp_validate_boolean',
				'status' => 'disabled',
				'default' => '',
				'description' => __( 'Hide/show title on mouse hover action', 'easy-fancybox' ) . efb_pro_button()
			),
			'autoGallery' => array (
				'id' => 'fancybox_autoGallery',
				'title' => __('Automattically group images','easy-fancybox'),
				'label_for' => 'fancybox_autoGallery',
				'hide' => true,
				'input' => 'select',
				'sanitize_callback' => 'sanitize_text_field',
				'options' => array(
					'' => translate('Disabled'),
					'1' => __('WordPress galleries only','easy-fancybox'),
					'2' => __('All in one gallery','easy-fancybox')
				),
				'default' => '1',
				'description' => __('You can also use rel attribute to manually group images together. ','easy-fancybox') . efb_pro_button( true )
			),
			'showNavArrows' => array (
				'id' => 'fancybox_showNavArrows',
				'title' => __('Show nav arrows','easy-fancybox'),
				'input' => 'checkbox',
				'sanitize_callback' => 'wp_validate_boolean',
				'fancybox2_name' => 'arrows',
				'noquotes' => true,
				'default' => '1',
				'description' => __('Show the gallery navigation arrows','easy-fancybox')
			),
			'enableKeyboardNav' => array (
				'id' => 'fancybox_enableKeyboardNav',
				'title' => __('Enable keyboard nav','easy-fancybox'),
				'input' => 'checkbox',
				'sanitize_callback' => 'wp_validate_boolean',
				'noquotes' => true,
				'fancybox2_hide' => true,
				'default' => '1',
				'description' => __('Arrow key strokes browse the gallery','easy-fancybox')
			),
			'cyclic' => array (
				'id' => 'fancybox_cyclic',
				'title' => __('Continuous navigation','easy-fancybox'),
				'input' => 'checkbox',
				'sanitize_callback' => 'wp_validate_boolean',
				'fancybox2_name' => 'loop',
				'fancybox2_hide' => true,
				'noquotes' => true,
				'default' => '',
				'description' => __('Make galleries cyclic, allowing you to keep pressing next/back.','easy-fancybox')
			),
			'mouseWheel' => array (
				'id' => 'fancybox_mouseWheel',
				'title' => __('Mousewheel navigation','easy-fancybox'),
				'input' => 'checkbox',
				'sanitize_callback' => 'wp_validate_boolean',
				'default' => '1',
				'exclude' => array( 'classic', 'legacy' ),
				'description' => __('Allow gallery browsing by mousewheel action.','easy-fancybox')
			),
			'changeSpeed' => array (
				'id' => 'fancybox_changeSpeed',
				'title' => __( 'Change speed', 'easy-fancybox' ),
				'label_for' => 'fancybox_changeSpeed',
				'input' => 'number',
				'step' => '50',
				'min' => '0',
				'max' => '6000',
				'sanitize_callback' => array( 'easyFancyBox_Admin', 'sanitize_number' ),
				'default' => '250',
				'description' => __('Duration in milliseconds. Higher is slower.','easy-fancybox') . ' <em>' . __('Default:','easy-fancybox')  . ' 250</em>'
			),
			'changeFade' => array (
				'id' => 'fancybox_changeFade',
				'title' => __('Fade speed','easy-fancybox'),
				'label_for' => 'fancybox_changeFade',
				'input' => 'number',
				'exclude' => array( 'fancybox2' ),	
				'step' => '1',
				'min' => '0',
				'max' => '6000',
				'sanitize_callback' => array( 'easyFancyBox_Admin', 'sanitize_number' ),
				'default' => '300',
				'description' => __('Duration in milliseconds. Higher is slower.','easy-fancybox') . ' <em>' . __('Default:','easy-fancybox')  . ' 300</em>'
			),
			//Prob need this, but as hiiden field, doesn't display right
			// on options page, and can't remove ID.
			'autoSelector' => array (
				'id' => 'fancybox_autoSelector',
				'title' => __( 'Image css selectors'),
				'hide' => true,
				'input' => 'text',
				'status' => 'disabled',
				'default' => '.gallery,.wp-block-gallery,.tiled-gallery,.wp-block-jetpack-tiled-gallery'
			),
			'autoPlay' => array (
				'id' => 'fancybox_autoPlay',
				'title' => __('Auto play slideshow','easy-fancybox'),
				'hide' => true,
				'input' => 'checkbox',
				'sanitize_callback' => 'wp_validate_boolean',
				'status' => 'disabled',
				'default' => '',
				'description' =>  efb_pro_button()
			),
			'playSpeed' => array(
				'id' => 'fancybox_playSpeed',
				'hide' => true,
				'title' => __( 'Play speed', 'easy-fancybox' ),
				'label_for' => 'fancybox_changeSpeed',
				'input' => 'number',
				'status' => 'disabled',
				'step' => '500',
				'min' => '3000',
				'max' => '12000',
				'sanitize_callback' => array( 'easyFancyBox_Admin', 'sanitize_number' ),
				'default' => '3000',
				'description' => __('Duration in milliseconds. Higher is slower.','easy-fancybox') . ' <em>' . __('Default:','easy-fancybox')  . ' 3000</em>'
			)
		)
	),

	'Inline' => array(
		'title' => __('Inline Content','easy-fancybox'),
		'slug' => 'inline-settings-section',
		'input' => 'multiple',
		'options' => array(
			'tag' => array (
				'hide' => true,
				'default' => 'a.fancybox-inline,area.fancybox-inline,.fancybox-inline>a'
			),
			'class' => array (
				'hide' => true,
				'default' => 'fancybox-inline'
			),
			'type' => array (
				'default' => 'inline'
			),
			'autoDimensions' => array (
				'id' => 'fancybox_autoDimensions',
				'title' => __('Auto dimensions','easy-fancybox'),
				'input' => 'checkbox',
				'sanitize_callback' => 'wp_validate_boolean',
				'fancybox2_name' => 'autoSize',
				'noquotes' => true,
				'default' => '1',
				'description' => __('Try to adjust size to inline/html content. If unchecked the default dimensions will be used.','easy-fancybox') . ''
			),
			'scrolling' => array (
				'id' => 'fancybox_InlineScrolling',
				'title' => __('Scrolling','easy-fancybox'),
				'label_for' => 'fancybox_InlineScrolling',
				'input' => 'select',
				'sanitize_callback' => 'sanitize_text_field',
				'options' => array(
					'auto' => __('Auto','easy-fancybox'),
					'yes' => __('Always','easy-fancybox'),
					'no' => __('Never','easy-fancybox')
				),
				'default' => 'auto',
				'description' => __('Define scrolling and scrollbar visibility.','easy-fancybox')
			),
			'transitionIn' => array (
				'id' => 'fancybox_transitionInInline',
				'title' => __('Transition In','easy-fancybox'),
				'label_for' => 'fancybox_transitionInInline',
				'input' => 'select',
				'sanitize_callback' => 'sanitize_text_field',
				'fancybox2_name' => 'openEffect',
				'options' => array(
					'none' => translate('None'),
					'' => __('Fade','easy-fancybox'),
					'elastic' => __('Elastic','easy-fancybox'),
				),
				'default' => '',
				'description' => efb_pro_button( true )
			),
			'easingIn' => array (
				'id' => 'fancybox_easingInInline',
				'title' => __('Easing In','easy-fancybox'),
				'label_for' => 'fancybox_easingInInline',
				'input' => 'select',
				'sanitize_callback' => 'sanitize_text_field',
				'options' => array(
					'linear' => __('Linear','easy-fancybox'),
					'' => __('Swing','easy-fancybox')
				),
				'default' => 'easeOutBack',
				'description' => __('Only applies when Transition is set to Elastic. ','easy-fancybox') . efb_pro_button( true )
			),
			'transitionOut' => array (
				'id' => 'fancybox_transitionOutInline',
				'title' => __('Transition Out','easy-fancybox'),
				'label_for' => 'fancybox_transitionOutInline',
				'input' => 'select',
				'sanitize_callback' => 'sanitize_text_field',
				'fancybox2_name' => 'closeEffect',
				'options' => array(
					'none' => translate('None'),
					'' => __('Fade','easy-fancybox'),
					'elastic' => __('Elastic','easy-fancybox'),
				),
				'default' => '',
				'description' => efb_pro_button( true )
			),
			'easingOut' => array (
				'id' => 'fancybox_easingOutInline',
				'title' => __('Easing Out','easy-fancybox'),
				'label_for' => 'fancybox_easingOutInline',
				'input' => 'select',
				'sanitize_callback' => 'sanitize_text_field',
				'options' => array(
					'linear' => __('Linear','easy-fancybox'),
					'' => __('Swing','easy-fancybox')
				),
				'default' => '',
				'description' => __('Only applies when Transition is set to Elastic. ','easy-fancybox') . efb_pro_button( true )
			),
			'opacity' => array (
				'id' => 'fancybox_opacityInline',
				'title' => __('Transition Opacity','easy-fancybox'),
				'input' => 'checkbox',
				'sanitize_callback' => 'wp_validate_boolean',
				'noquotes' => true,
				'default' => '',
				'description' => __('Transparency fade during elastic transition. CAUTION: Use only when at least Transition In is set to Elastic!','easy-fancybox')
			),
			'hideOnContentClick' => array (
				'id' => 'fancybox_hideOnContentClickInline',
				'title' => __('Close on click','easy-fancybox'),
				'input' => 'checkbox',
				'sanitize_callback' => 'wp_validate_boolean',
				'fancybox2_name' => 'closeClick',
				'noquotes' => true,
				'default' => '',
				'description' => __('Close FancyBox when content is clicked','easy-fancybox')
			),
			'titleShow' => array (
				'noquotes' => true,
				'default' => 'false',
				'fancybox2_hide' => true,
			)
		)
	),

	'PDF' => array(
		'title' => __('PDF','easy-fancybox'),
		'slug' => 'pdf-settings-section',
		'input' => 'multiple',
		'options' => array(
			'intro' => array (
				'hide' => true,
				'description' => __('To make any PDF document file open in an overlay, switch on Autodetect or use the class "fancybox-pdf" for its link.','easy-fancybox') . '<br />'
			),
			'autoAttribute' => array (
				'id' => 'fancybox_autoAttributePDF',
				'input' => 'checkbox',
				'sanitize_callback' => 'wp_validate_boolean',
				'hide' => true,
				'default' => '1',
				'selector' => '\'a[href*=".pdf" i],area[href*=".pdf" i]\'',
				'title' => __('Autodetect','easy-fancybox')
			),
			'tag' => array (
				'hide' => true,
				'default' => 'a.fancybox-pdf,area.fancybox-pdf,.fancybox-pdf>a'
			),
			'class' => array (
				'hide' => true,
				'default' => 'fancybox-pdf'
			),
			'type' => array (
				'default' => 'iframe'
			),
			'onStart' => array (
				'id' => 'fancybox_PDFonStart',
				'noquotes' => true,
				'title' => __('Embed with','easy-fancybox'),
				'label_for' => 'fancybox_PDFonStart',
				'input' => 'select',
				'sanitize_callback' => 'sanitize_text_field',
				'fancybox2_name' => 'beforeLoad',
				'options' => array(
					'{{object}}'       => __('Object tag (plus fall-back link)','easy-fancybox'),
					'{{embed}}'        => __('Embed tag','easy-fancybox'),
					''                 => __('iFrame tag (let browser decide)','easy-fancybox'),
					'{{googleviewer}}' => __('Google Docs Viewer (external)','easy-fancybox')
				),
				'default' => '{{object}}',
				'description' => __('Note:','easy-fancybox') . ' ' . __('External viewers have bandwidth, usage rate and and file size limits.','easy-fancybox')
			),
			'width' => array (
				'id' => 'fancybox_PDFwidth',
				'title' => translate('Width'),
				'label_for' => 'fancybox_PDFwidth',
				'input' => 'text',
				'sanitize_callback' => 'intval',
				'default' => '90%',
				'description' => ' '
			),
			'height' => array (
				'id' => 'fancybox_PDFheight',
				'title' => translate('Height'),
				'label_for' => 'fancybox_PDFheight',
				'input' => 'text',
				'sanitize_callback' => 'intval',
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
				'sanitize_callback' => array( 'easyFancyBox_Admin', 'sanitize_number' ),
				'default' => '10',
			),
			'titleShow' => array (
				'id' => 'fancybox_PDFtitleShow',
				'title' => __('Show title','easy-fancybox'),
				'input' => 'checkbox',
				'sanitize_callback' => 'wp_validate_boolean',
				'noquotes' => true,
				'fancybox2_hide' => true,
				'default' => '',
				'description' => __('FancyBox will try to get a title from the link or thumbnail title attributes.','easy-fancybox')
			),
			'titlePosition' => array (
				'id' => 'fancybox_PDFtitlePosition',
				'title' => __('Title Position','easy-fancybox'),
				'label_for' => 'fancybox_PDFtitlePosition',
				'input' => 'select',
				'sanitize_callback' => 'sanitize_text_field',
				'exclude' => array( 'fancybox2' ),
				'options' => array(
					'float' => __('Float','easy-fancybox'),
					'outside' => __('Outside','easy-fancybox'),
					'inside' => __('Inside','easy-fancybox')
				),
				'default' => 'float',
			),
			'titlePosition2' => array (
				'id' => 'fancybox_PDFtitlePosition2',
				'title' => __('Title Position','easy-fancybox'),
				'label_for' => 'fancybox_PDFtitlePosition2',
				'input' => 'select',
				'sanitize_callback' => 'sanitize_text_field',
				'fancybox2_name' => 'titlePosition',
				'exclude' => array( 'classic', 'legacy' ),
				'hide' => true,
				'options' => array(
					'float' => __('Float','easy-fancybox'),
					'outside' => __('Outside','easy-fancybox'),
					'inside' => __('Inside','easy-fancybox')
				),
				'default' => 'float',
			),
			'titleFromAlt' => array (
				'id' => 'fancybox_PDFtitleFromAlt',
				'title' => __('Title from alt','easy-fancybox'),
				'input' => 'checkbox',
				'sanitize_callback' => 'wp_validate_boolean',
				'noquotes' => true,
				'fancybox2_hide' => true,
				'default' => '1',
				'description' => __('Allow title from thumbnail alt attribute.','easy-fancybox')
			),
			'autoDimensions' => array (
				'noquotes' => true,
				'default' => 'false'
			),
			'scrolling' => array (
				'default' => 'no',
			),
		)
	),

	'SWF' => array(
		'title' => __('SWF','easy-fancybox'),
		'slug' => 'swf-settings-section',
		'input' => 'multiple',
		'exclude' => array( 'classic', 'fancybox2' ),
		'options' => array(
			'autoAttribute' => array (
				'id' => 'fancybox_autoAttributeSWF',
				'title' => __('Autodetect','easy-fancybox'),
				'input' => 'checkbox',
				'sanitize_callback' => 'wp_validate_boolean',
				'hide' => true,
				'default' => '1',
				'selector' => '\'a[href*=".swf" i],area[href*=".swf" i]\'',
			),
			'tag' => array (
				'hide' => true,
				'default' => 'a.fancybox-swf,area.fancybox-swf,.fancybox-swf>a'
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
				'options' => array(),
				'default' => '680',
			),
			'height' => array (
				'id' => 'fancybox_SWFHeight',
				'title' => translate('Height'),
				'label_for' => 'fancybox_SWFHeight',
				'input' => 'text',
				'sanitize_callback' => 'intval',
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
				'default' => '0',
			),
			'titleShow' => array (
				'id' => 'fancybox_SWFtitleShow',
				'title' => __('Show title','easy-fancybox'),
				'input' => 'checkbox',
				'sanitize_callback' => 'wp_validate_boolean',
				'noquotes' => true,
				'default' => '',
				'description' => __('Show title.','easy-fancybox') . ' ' . __('FancyBox will try to get a title from the link or thumbnail title attributes.','easy-fancybox')
			),
			'titlePosition' => array (
				'id' => 'fancybox_SWFtitlePosition',
				'title' => __('Title Position','easy-fancybox'),
				'label_for' => 'fancybox_SWFtitlePosition',
				'input' => 'select',
				'sanitize_callback' => 'sanitize_text_field',
				'options' => array(
					'float' => __('Float','easy-fancybox'),
					'outside' => __('Outside','easy-fancybox'),
					'inside' => __('Inside','easy-fancybox')
				),
				'default' => 'float',
			),
			'titleFromAlt' => array (
				'id' => 'fancybox_SWFtitleFromAlt',
				'title' => __('Title from alt','easy-fancybox'),
				'input' => 'checkbox',
				'sanitize_callback' => 'wp_validate_boolean',
				'noquotes' => true,
				'default' => '1',
				'description' => __('Allow title from thumbnail alt attribute.','easy-fancybox')
			),
			'swf' => array (
				'noquotes' => true,
				'default' => '{\'wmode\':\'opaque\',\'allowfullscreen\':true}'
			)
		)
	),

	'SVG' => array(
		'title' => __('SVG','easy-fancybox'),
		'slug' => 'svg-settings-section',
		'input' => 'multiple',
		'options' => array(
			'autoAttribute' => array (
				'id' => 'fancybox_autoAttributeSVG',
				'title' => __('Autodetect','easy-fancybox'),
				'input' => 'checkbox',
				'sanitize_callback' => 'wp_validate_boolean',
				'hide' => true,
				'default' => '1',
				'selector' => '\'a[href*=".svg" i],area[href*=".svg" i]\'',
			),
			'tag' => array (
				'hide' => true,
				'default' => 'a.fancybox-svg,area.fancybox-svg,.fancybox-svg>a'
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
				'options' => array(),
				'default' => '680',
			),
			'height' => array (
				'id' => 'fancybox_SVGHeight',
				'title' => translate('Height'),
				'label_for' => 'fancybox_SVGHeight',
				'input' => 'text',
				'sanitize_callback' => 'intval',
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
				'sanitize_callback' => array( 'easyFancyBox_Admin', 'sanitize_number' ),
				'default' => '0',
			),
			'titleShow' => array (
				'id' => 'fancybox_SVGtitleShow',
				'title' => __('Show title','easy-fancybox'),
				'input' => 'checkbox',
				'sanitize_callback' => 'wp_validate_boolean',
				'noquotes' => true,
				'fancybox2_hide' => true,
				'default' => '',
				'description' => __('FancyBox will try to get a title from the link or thumbnail title attributes.','easy-fancybox')
			),
			'titlePosition' => array (
				'id' => 'fancybox_SVGtitlePosition',
				'title' => __('Title Position','easy-fancybox'),
				'label_for' => 'fancybox_SVGtitlePosition',
				'input' => 'select',
				'sanitize_callback' => 'sanitize_text_field',
				'exclude' => array( 'fancybox2' ),
				'options' => array(
					'float' => __('Float','easy-fancybox'),
					'outside' => __('Outside','easy-fancybox'),
					'inside' => __('Inside','easy-fancybox')
				),
				'default' => 'float',
			),
			'titlePosition2' => array (
				'id' => 'fancybox_SVGtitlePosition2',
				'title' => __('Title Style','easy-fancybox'),
				'label_for' => 'fancybox_SVGtitlePosition2',
				'input' => 'select',
				'sanitize_callback' => 'sanitize_text_field',
				'fancybox2_name' => 'titlePosition',
				'exclude' => array( 'classic', 'legacy' ),
				'hide' => true,
				'options' => array(
					'' => __('Float','easy-fancybox'),
					'outside' => __('Outside','easy-fancybox'),
					'outside-top' => __('Outside top','easy-fancybox'),
					'inside' => __('Inside','easy-fancybox'),
					'inside-top' => __('Inside top','easy-fancybox'),
				),
				'default' => '',
			),
			'titleFromAlt' => array (
				'id' => 'fancybox_SVGtitleFromAlt',
				'title' => __('Title from alt','easy-fancybox'),
				'input' => 'checkbox',
				'sanitize_callback' => 'wp_validate_boolean',
				'noquotes' => true,
				'fancybox2_hide' => true,
				'default' => '1',
				'description' => __('Allow title from thumbnail alt attribute.','easy-fancybox')
			),
			'svg' => array (
				'noquotes' => true,
				'default' => '{\'wmode\':\'opaque\',\'allowfullscreen\':true}'
			)
		)
	),

	'VideoPress' => array(
		'title' => esc_html__('VideoPress','easy-fancybox'),
		'slug' => 'videopress-settings-section',
		'input' => 'multiple',
		'options' => array(
			'autoAttribute' => array (
				'id' => 'fancybox_autoAttributeVideoPress',
				'title' => __( 'Autodetect' ),
				'input' => 'checkbox',
				'hide' => true,
				'default' => '1',
				'selector' => '\'a[href*="video.wordpress.com/v/"],area[href*="video.wordpress.com/v/"],a[href*="videopress.com/v/"],area[href*="videopress.com/v/"]\'',
				'status' => 'disabled',
				'description' => efb_pro_button()
			),
		),
	),

	'YouTube' => array(
		'title' => __('YouTube','easy-fancybox'),
		'slug' => 'youtube-settings-section',
		'input' => 'multiple',
		'options' => array(
			'intro' => array (
				'hide' => true,
				'description' => __('To make any YouTube movie open in an overlay, switch on Autodetect or use the class "fancybox-youtube" for its link.','easy-fancybox') . '<br />'
			),
			'autoAttribute' => array (
				'id' => 'fancybox_autoAttributeYoutube',
				'title' => __('Autodetect','easy-fancybox'),
				'input' => 'checkbox',
				'sanitize_callback' => 'wp_validate_boolean',
				'hide' => true,
				'default' => '1',
				'selector' => '\'a[href*="youtu.be/" i],area[href*="youtu.be/" i],a[href*="youtube.com/" i],area[href*="youtube.com/" i]\').filter(function(){return this.href.match(/\/(?:youtu\.be|watch\?|embed\/)/);}',
			),
			'tag' => array (
				'hide' => true,
				'default' => 'a.fancybox-youtube,area.fancybox-youtube,.fancybox-youtube>a'
			),
			'class' => array (
				'hide' => true,
				'default' => 'fancybox-youtube'
			),
			'type' => array(
				'default' => 'iframe'
			),
			'noCookie' => array (
				'id' => 'fancybox_YoutubenoCookie',
				'title' => translate('Enable privacy mode'),
				'input' => 'checkbox',
				'sanitize_callback' => 'wp_validate_boolean',
				'hide' => true,
				'default' => '',
				'description' => __('Disables cookies.','easy-fancybox')
			),
			'width' => array (
				'id' => 'fancybox_YoutubeWidth',
				'title' => translate('Width'),
				'label_for' => 'fancybox_YoutubeWidth',
				'input' => 'number',
				'step' => '1',
				'min' => '420',
				'max' => '1500',
				'default' => '640',
			),
			'height' => array (
				'id' => 'fancybox_YoutubeHeight',
				'title' => translate('Height'),
				'label_for' => 'fancybox_YoutubeHeight',
				'input' => 'number',
				'step' => '1',
				'min' => '315',
				'max' => '900',
				'sanitize_callback' => array( 'easyFancyBox_Admin', 'sanitize_number' ),
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
				'sanitize_callback' => array( 'easyFancyBox_Admin', 'sanitize_number' ),
				'default' => '0',
			),
			'keepRatio' => array(
				'noquotes' => true,
				'default' => '1'
			),
			'aspectRatio' => array(
				'default' => '1'
			),
			'titleShow' => array (
				'id' => 'fancybox_YoutubetitleShow',
				'title' => __('Show title','easy-fancybox'),
				'input' => 'checkbox',
				'sanitize_callback' => 'wp_validate_boolean',
				'noquotes' => true,
				'fancybox2_hide' => true,
				'default' => '',
				'description' => __('FancyBox will try to get a title from the link or thumbnail title attributes.','easy-fancybox')
			),
			'titlePosition' => array (
				'id' => 'fancybox_YoutubetitlePosition',
				'title' => __('Title Position','easy-fancybox'),
				'label_for' => 'fancybox_YoutubetitlePosition',
				'input' => 'select',
				'sanitize_callback' => 'sanitize_text_field',
				'exclude' => array( 'fancybox2' ),
				'options' => array(
					'float' => __('Float','easy-fancybox'),
					'outside' => __('Outside','easy-fancybox'),
					'inside' => __('Inside','easy-fancybox')
				),
				'default' => 'float',
			),
			'titlePosition2' => array (
				'id' => 'fancybox_YoutubetitlePosition2',
				'title' => __('Title Position','easy-fancybox'),
				'label_for' => 'fancybox_YoutubetitlePosition2',
				'input' => 'select',
				'sanitize_callback' => 'sanitize_text_field',
				'fancybox2_name' => 'titlePosition',
				'exclude' => array( 'classic', 'legacy' ),
				'hide' => true,
				'options' => array(
					'' => __('Float','easy-fancybox'),
					'outside' => __('Outside','easy-fancybox'),
					'outside-top' => __('Outside top','easy-fancybox'),
					'inside' => __('Inside','easy-fancybox'),
					'inside-top' => __('Inside top','easy-fancybox'),
				),
				'default' => '',
			),
			'titleFromAlt' => array (
				'id' => 'fancybox_YoutubetitleFromAlt',
				'title' => __('Title from alt','easy-fancybox'),
				'input' => 'checkbox',
				'sanitize_callback' => 'wp_validate_boolean',
				'noquotes' => true,
				'fancybox2_hide' => true,
				'default' => '1',
				'description' => __('Allow title from thumbnail alt attribute.','easy-fancybox')
			),
			'onStart' => array (
				'noquotes' => true,
				'default' => get_option( 'fancybox_YoutubenoCookie' ) ?
					'function(a,i,o){var splitOn=a[i].href.indexOf("?");var urlParms=(splitOn>-1)?a[i].href.substring(splitOn):"";o.allowfullscreen=(urlParms.indexOf("fs=0")>-1)?false:true;o.href=a[i].href.replace(/https?:\/\/(?:www\.)?youtu(?:\.be\/([^\?]+)\??|be\.com\/watch\?(.*(?=v=))v=([^&]+))(.*)/gi,"https://www.youtube-nocookie.com/embed/$1$3?$2$4");}' :
					'function(a,i,o){var splitOn=a[i].href.indexOf("?");var urlParms=(splitOn>-1)?a[i].href.substring(splitOn):"";o.allowfullscreen=(urlParms.indexOf("fs=0")>-1)?false:true;o.href=a[i].href.replace(/https?:\/\/(?:www\.)?youtu(?:\.be\/([^\?]+)\??|be\.com\/watch\?(.*(?=v=))v=([^&]+))(.*)/gi,"https://www.youtube.com/embed/$1$3?$2$4&autoplay=1");}'
			)
		)
	),

	'Vimeo' => array(
		'title' => __('Vimeo','easy-fancybox'),
		'slug' => 'vimeo-settings-section',
		'input' => 'multiple',
		'options' => array(
			'intro' => array (
				'hide' => true,
				'description' => __('To make any Vimeo movie open in an overlay, switch on Autodetect or use the class "fancybox-vimeo" for its link.','easy-fancybox') . '<br />'
			),
			'autoAttribute' => array (
				'id' => 'fancybox_autoAttributeVimeo',
				'title' => __('Autodetect','easy-fancybox'),
				'input' => 'checkbox',
				'sanitize_callback' => 'wp_validate_boolean',
				'hide' => true,
				'default' => '1',
				'selector' => '\'a[href*="vimeo.com/" i],area[href*="vimeo.com/" i]\').filter(function(){return this.href.match(/\/(?:[0-9]+|video\/)/);}',
			),
			'tag' => array (
				'hide' => true,
				'default' => 'a.fancybox-vimeo,area.fancybox-vimeo,.fancybox-vimeo>a'
			),
			'class' => array (
				'hide' => true,
				'default' => 'fancybox-vimeo'
			),
			'type' => array(
				'default' => 'iframe'
			),
			'width' => array (
				'id' => 'fancybox_VimeoWidth',
				'title' => translate('Width'),
				'label_for' => 'fancybox_VimeoWidth',
				'input' => 'number',
				'step' => '1',
				'min' => '400',
				'max' => '1500',
				'sanitize_callback' => array( 'easyFancyBox_Admin', 'sanitize_number' ),
				'default' => '500',
			),
			'height' => array (
				'id' => 'fancybox_VimeoHeight',
				'title' => translate('Height'),
				'label_for' => 'fancybox_VimeoHeight',
				'input' => 'number',
				'step' => '1',
				'min' => '225',
				'max' => '900',
				'sanitize_callback' => array( 'easyFancyBox_Admin', 'sanitize_number' ),
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
				'sanitize_callback' => array( 'easyFancyBox_Admin', 'sanitize_number' ),
				'default' => '0',
			),
			'keepRatio' => array(
				'noquotes' => true,
				'default' => '1'
			),
			'aspectRatio' => array(
				'default' => '1'
			),
			'titleShow' => array (
				'id' => 'fancybox_VimeotitleShow',
				'title' => __('Show title','easy-fancybox'),
				'input' => 'checkbox',
				'sanitize_callback' => 'wp_validate_boolean',
				'noquotes' => true,
				'fancybox2_hide' => true,
				'default' => '',
				'description' => __('FancyBox will try to get a title from the link or thumbnail title attributes.','easy-fancybox')
			),
			'titlePosition' => array (
				'id' => 'fancybox_VimeotitlePosition',
				'title' => __('Title Position','easy-fancybox'),
				'label_for' => 'fancybox_VimeotitlePosition',
				'input' => 'select',
				'sanitize_callback' => 'sanitize_text_field',
				'exclude' => array( 'fancybox2' ),
				'options' => array(
					'float' => __('Float','easy-fancybox'),
					'outside' => __('Outside','easy-fancybox'),
					'inside' => __('Inside','easy-fancybox')
				),
				'default' => 'float',
			),
			'titlePosition2' => array (
				'id' => 'fancybox_VimeotitlePosition2',
				'title' => __('Title Style','easy-fancybox'),
				'label_for' => 'fancybox_VimeotitlePosition2',
				'input' => 'select',
				'sanitize_callback' => 'sanitize_text_field',
				'fancybox2_name' => 'titlePosition',
				'exclude' => array( 'classic', 'legacy' ),
				'hide' => true,
				'options' => array(
					'' => __('Float','easy-fancybox'),
					'outside' => __('Outside','easy-fancybox'),
					'outside-top' => __('Outside top','easy-fancybox'),
					'inside' => __('Inside','easy-fancybox'),
					'inside-top' => __('Inside top','easy-fancybox'),
				),
				'default' => '',
			),
			'titleFromAlt' => array (
				'id' => 'fancybox_VimeotitleFromAlt',
				'title' => __('Title from alt','easy-fancybox'),
				'input' => 'checkbox',
				'sanitize_callback' => 'wp_validate_boolean',
				'noquotes' => true,
				'fancybox2_hide' => true,
				'default' => '1',
				'description' => __('Allow title from thumbnail alt attribute.','easy-fancybox')
			),
			'onStart' => array (
				'noquotes' => true,
				'default' => 'function(a,i,o){var splitOn=a[i].href.indexOf("?");var urlParms=(splitOn>-1)?a[i].href.substring(splitOn):"";o.allowfullscreen=(urlParms.indexOf("fullscreen=0")>-1)?false:true;o.href=a[i].href.replace(/https?:\/\/(?:www\.)?vimeo\.com\/([0-9]+)\??(.*)/gi,"https://player.vimeo.com/video/$1?$2&autoplay=1");}'
			)
		)
	),
	'Dailymotion' => array(
		'title' => __('Dailymotion','easy-fancybox'),
		'slug' => 'dailymotion-settings-section',
		'input' => 'multiple',
		'options' => array(
			'intro' => array (
				'hide' => true,
				'description' => __('To make any Dailymotion movie open in an overlay, switch on Autodetect or use the class "fancybox-dailymotion" for its link.','easy-fancybox') . '<br />'
			),
			'autoAttribute' => array (
				'id' => 'fancybox_autoAttributeDailymotion',
				'title' => __('Autodetect','easy-fancybox'),
				'input' => 'checkbox',
				'sanitize_callback' => 'wp_validate_boolean',
				'hide' => true,
				'default' => '1',
				'selector' => '\'a[href*="dailymotion.com/" i],area[href*="dailymotion.com/" i]\').filter(function(){return this.href.match(/\/video\//);}',
			),
			'tag' => array (
				'hide' => true,
				'default' => 'a.fancybox-dailymotion,area.fancybox-dailymotion,.fancybox-dailymotion>a'
			),
			'class' => array (
				'hide' => true,
				'default' => 'fancybox-dailymotion'
			),
			'type' => array(
				'default' => 'iframe'
			),
			'width' => array (
				'id' => 'fancybox_DailymotionWidth',
				'title' => translate('Width'),
				'label_for' => 'fancybox_DailymotionWidth',
				'input' => 'number',
				'step' => '1',
				'min' => '320',
				'max' => '1500',
				'sanitize_callback' => array( 'easyFancyBox_Admin', 'sanitize_number' ),
				'default' => '560',
			),
			'height' => array (
				'id' => 'fancybox_DailymotionHeight',
				'title' => translate('Height'),
				'label_for' => 'fancybox_DailymotionHeight',
				'input' => 'number',
				'step' => '1',
				'min' => '180',
				'max' => '900',
				'sanitize_callback' => array( 'easyFancyBox_Admin', 'sanitize_number' ),
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
				'sanitize_callback' => array( 'easyFancyBox_Admin', 'sanitize_number' ),
				'default' => '0',
				'description' => '<br /><br />'
			),
			'keepRatio' => array(
				'noquotes' => true,
				'default' => '1'
			),
			'aspectRatio' => array(
				'default' => '1'
			),
			'titleShow' => array (
				'id' => 'fancybox_DailymotiontitleShow',
				'title' => __('Show title','easy-fancybox'),
				'input' => 'checkbox',
				'sanitize_callback' => 'wp_validate_boolean',
				'noquotes' => true,
				'fancybox2_hide' => true,
				'default' => '',
				'description' => __('FancyBox will try to get a title from the link or thumbnail title attributes.','easy-fancybox')
			),
			'titlePosition' => array (
				'id' => 'fancybox_DailymotiontitlePosition',
				'title' => __('Title Position','easy-fancybox'),
				'label_for' => 'fancybox_DailymotiontitlePosition',
				'input' => 'select',
				'sanitize_callback' => 'sanitize_text_field',
				'exclude' => array( 'fancybox2' ),
				'options' => array(
					'float' => __('Float','easy-fancybox'),
					'outside' => __('Outside','easy-fancybox'),
					'inside' => __('Inside','easy-fancybox')
				),
				'default' => 'float',
			),
			'titlePosition2' => array (
				'id' => 'fancybox_DailymotiontitlePosition2',
				'title' => __('Title Style','easy-fancybox'),
				'label_for' => 'fancybox_DailymotiontitlePosition2',
				'input' => 'select',
				'sanitize_callback' => 'sanitize_text_field',
				'fancybox2_name' => 'titlePosition',
				'exclude' => array( 'classic', 'legacy' ),
				'hide' => true,
				'options' => array(
					'' => __('Float','easy-fancybox'),
					'outside' => __('Outside','easy-fancybox'),
					'outside-top' => __('Outside top','easy-fancybox'),
					'inside' => __('Inside','easy-fancybox'),
					'inside-top' => __('Inside top','easy-fancybox'),
				),
				'default' => '',
			),
			'titleFromAlt' => array (
				'id' => 'fancybox_DailymotiontitleFromAlt',
				'title' => __('Title from alt','easy-fancybox'),
				'input' => 'checkbox',
				'sanitize_callback' => 'wp_validate_boolean',
				'noquotes' => true,
				'fancybox2_hide' => true,
				'default' => '1',
				'description' => __('Allow title from thumbnail alt attribute.','easy-fancybox')
			),
			'onStart' => array (
				'noquotes' => true,
				'default' => 'function(a,i,o){var splitOn=a[i].href.indexOf("?");var urlParms=(splitOn>-1)?a[i].href.substring(splitOn):"";o.allowfullscreen=(urlParms.indexOf("fullscreen=0")>-1)?false:true;o.href=a[i].href.replace(/^https?:\/\/(?:www\.)?dailymotion.com\/video\/([^\?]+)(.*)/gi,"https://www.dailymotion.com/embed/video/$1?$2&autoplay=1");}'
			)
		)
	),
	'iFrame' => array(
		'title' => __('iFrames','easy-fancybox'),
		'slug' => 'iframe-settings-section',
		'input' => 'multiple',
		'options' => array(
			'intro' => array (
				'hide' => true,
				'description' => __('To make a website or HTML document open in an overlay, use the class "fancybox-iframe" for its link.','easy-fancybox') . '<br /><br />'
			),
			'tag' => array (
				'hide' => true,
				'default' => 'a.fancybox-iframe,area.fancybox-iframe,.fancybox-iframe>a'
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
				'default' => '70%',
			),
			'height' => array (
				'id' => 'fancybox_iFrameheight',
				'title' => translate('Height'),
				'label_for' => 'fancybox_iFrameheight',
				'input' => 'text',
				'sanitize_callback' => 'intval',
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
				'default' => '0',
			),
			'titleShow' => array (
				'id' => 'fancybox_iFrametitleShow',
				'title' => __('Show title','easy-fancybox'),
				'input' => 'checkbox',
				'sanitize_callback' => 'wp_validate_boolean',
				'noquotes' => true,
				'fancybox2_hide' => true,
				'default' => '',
				'description' => __('FancyBox will try to get a title from the link or thumbnail title attributes.','easy-fancybox')
			),
			'titlePosition' => array (
				'id' => 'fancybox_iFrametitlePosition',
				'title' => __('Title Position','easy-fancybox'),
				'label_for' => 'fancybox_iFrametitlePosition',
				'input' => 'select',
				'sanitize_callback' => 'sanitize_text_field',
				'exclude' => array( 'fancybox2' ),
				'options' => array(
					'float' => __('Float','easy-fancybox'),
					'outside' => __('Outside','easy-fancybox'),
					'inside' => __('Inside','easy-fancybox')
				),
				'default' => 'float',
			),
			'titlePosition2' => array (
				'id' => 'fancybox_iFrametitlePosition2',
				'title' => __('Title Style','easy-fancybox'),
				'label_for' => 'fancybox_iFrametitlePosition2',
				'input' => 'select',
				'sanitize_callback' => 'sanitize_text_field',
				'fancybox2_name' => 'titlePosition',
				'exclude' => array( 'classic', 'legacy' ),
				'hide' => true,
				'options' => array(
					'' => __('Float','easy-fancybox'),
					'outside' => __('Outside','easy-fancybox'),
					'outside-top' => __('Outside top','easy-fancybox'),
					'inside' => __('Inside','easy-fancybox'),
					'inside-top' => __('Inside top','easy-fancybox'),
				),
				'default' => '',
			),
			'titleFromAlt' => array (
				'id' => 'fancybox_iFrametitleFromAlt',
				'title' => __('Title from alt','easy-fancybox'),
				'input' => 'checkbox',
				'sanitize_callback' => 'wp_validate_boolean',
				'noquotes' => true,
				'fancybox2_hide' => true,
				'default' => '1',
				'description' => __('Allow title from thumbnail alt attribute.','easy-fancybox') . '<br/>'
			),
			'allowfullscreen' => array (
				'id' => 'fancybox_allowFullScreen',
				'title' => __('Allow fullscreen','easy-fancybox'),
				'input' => 'checkbox',
				'sanitize_callback' => 'wp_validate_boolean',
				'fancybox2_name' => 'allowFullScreen',
				'noquotes' => true,
				'fancybox2_hide' => true,
				'default' => '',
				'description' => __('Allow embedded content to jump to full screen mode','easy-fancybox')
			)
		)
	)
);
