<?php
class easyFancyBox_Options extends easyFancyBox {

	static function go() {

	    parent::$options = array ( 

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
							'default' => ( function_exists('is_plugin_active_for_network') && is_plugin_active_for_network( plugin_basename( __FILE__ ) ) ) ? '' : '1',
							'description' => '<strong>' . __('Images','easy-fancybox') . '</strong>'
							),
						'Inline' => array (
							'id' => 'fancybox_enableInline',
							'input' => 'checkbox',
							'hide' => true,
							'default' => '',
							'description' => '<strong>' . __('Inline content','easy-fancybox') . '</strong>'
							),
						'PDF' => array (
							'id' => 'fancybox_enablePDF',
							'input' => 'checkbox',
							'hide' => true,
							'default' => '',
							'description' => '<strong>' . __('PDF','easy-fancybox') . '</strong>'
							),
						'SWF' => array (
							'id' => 'fancybox_enableSWF',
							'input' => 'checkbox',
							'hide' => true,
							'default' => '',
							'description' => '<strong>' . __('SWF','easy-fancybox') . '</strong>'
							),
						'SVG' => array (
							'id' => 'fancybox_enableSVG',
							'input' => 'checkbox',
							'hide' => true,
							'default' => '',
							'description' => '<strong>' . __('SVG','easy-fancybox') . '</strong>'
							),
						'YouTube' => array (
							'id' => 'fancybox_enableYoutube',
							'input' => 'checkbox',
							'hide' => true,
							'default' => '',
							'description' => '<strong>' . __('YouTube','easy-fancybox') . '</strong>'
							),
						'Vimeo' => array (
							'id' => 'fancybox_enableVimeo',
							'input' => 'checkbox',
							'hide' => true,
							'default' => '',
							'description' => '<strong>' . __('Vimeo','easy-fancybox') . '</strong>'
							),
						'Dailymotion' => array (
							'id' => 'fancybox_enableDailymotion',
							'input' => 'checkbox',
							'hide' => true,
							'default' => '',
							'description' => '<strong>' . __('Dailymotion','easy-fancybox') . '</strong>'
							),
						'iFrame' => array (
							'id' => 'fancybox_enableiFrame',
							'input' => 'checkbox',
							'hide' => true,
							'default' => '',
							'description' => '<strong>' . __('iFrames','easy-fancybox') . '</strong>' 
							)							
						),
					'description' => '<a href="http://status301.net/wordpress-plugins/easy-fancybox-pro/"><strong><em>' . __('For advanced options and support, please get the Easy FancyBox - Pro extension.','easy-fancybox') . '</strong></a>'
					),
				'Links' => array(
					'title' => translate('Links'),
					'input' => 'multiple',
					'hide' => true,
					'options' => array(
						'attributeLimit' => array (
							'id' => 'fancybox_attributeLimit',
							'title' => __('Exclude','easy-fancybox'),
							'label_for' => 'fancybox_attributeLimit',
							'hide' => true,
							'input' => 'select',
							'options' => array(
								'' => translate('None'),
								':not(:empty)' => __('Empty (hidden) links','easy-fancybox'),
								':has(img)' => __('Without thumbnail image','easy-fancybox')
								),
							'default' => '',
							'description' => '<br />' 
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
							'description' => '<em><a href="http://status301.net/wordpress-plugins/easy-fancybox-pro/">' . __('More options &raquo;','easy-fancybox') . '</a></em><br />' 
							),
						'metaData' => array (
							'id' => 'fancybox_metaData',
							'hide' => true,
							'input' => 'checkbox',
							'default' =>  '',
							'description' => __('Include the Metadata jQuery extension script to allow passing custom parameters via link class.','easy-fancybox')
							)
						)
					),
				'Overlay' => array (
					'title' => __('Overlay','easy-fancybox'),
					'input' => 'multiple',
					'hide' => true,
					'options' => array(
						'overlayShow' => array (
							'id' => 'fancybox_overlayShow',
							'input' => 'checkbox',
							'noquotes' => true,
							'default' => '1',
							'description' => __('Show the overlay around content opened in FancyBox.','easy-fancybox')
							),
						'hideOnOverlayClick' => array (
							'id' => 'fancybox_hideOnOverlayClick',
							'input' => 'checkbox',
							'noquotes' => true,
							'default' => '1',
							'description' => __('Close FancyBox when overlay is clicked.','easy-fancybox')
							),
						'overlayOpacity' => array (
							'id' => 'fancybox_overlayOpacity',
							'title' => __('Opacity','easy-fancybox'),
							'label_for' => 'fancybox_overlayOpacity',
							'input' => 'number',
							'step' => '0.1',
							'min' => '0',
							'max' => '1',
							'class' => 'small-text',
							'default' => '',
							'description' => __('Value between 0 and 1. ','easy-fancybox') . ' <em>' . __('Default:','easy-fancybox')  . ' 0.7</em><br />' 
							),
						'overlayColor' => array (
							'id' => 'fancybox_overlayColor',
							'title' => __('Color','easy-fancybox'),
							'label_for' => 'fancybox_overlayColor',
							'input' => 'text',
							'class' => 'small-text',
							'default' => '',
							'description' => __('Enter an HTML color value.','easy-fancybox') . ' <em>' . __('Default:','easy-fancybox')  . ' #777</em><br />' 
							),
						'overlaySpotlight' => array (
							'id' => 'fancybox_overlaySpotlight',
							'input' => 'checkbox',
							'hide' => true,
							//'status' => 'disabled',
							'default' => '',
							'description' => __('Spotlight effect','easy-fancybox') //. '. <em><a href="http://status301.net/wordpress-plugins/easy-fancybox-pro/">' . __('Make available &raquo;','easy-fancybox') . '</a></em>'
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
						'showCloseButton' => array (
							'id' => 'fancybox_showCloseButton',
							'input' => 'checkbox',
							'noquotes' => true,
							'default' => '1',
							'description' => __('Show the (X) close button','easy-fancybox')
							),
						'backgroundColor' => array (
							'id' => 'fancybox_backgroundColor',
							'hide' => true,
							'title' => __('Background color','easy-fancybox'),
							'input' => 'text',
							'status' => 'disabled',
							'class' => 'small-text',
							'default' => '',
							'description' => ''
							),
						'paddingColor' => array (
							'id' => 'fancybox_paddingColor',
							'hide' => true,
							'title' => __('Border color','easy-fancybox'),
							'input' => 'text',
							'status' => 'disabled',
							'class' => 'small-text',
							'default' => '',
							'description' => ''
							),
						'textColor' => array (
							'id' => 'fancybox_textColor',
							'hide' => true,
							'title' => __('Text color','easy-fancybox'),
							'input' => 'text',
							'status' => 'disabled',
							'class' => 'small-text',
							'default' => '',
							'description' => '<em><a href="http://status301.net/wordpress-plugins/easy-fancybox-pro/">' . __('Make available &raquo;','easy-fancybox') . '</a></em><br />'
							),
						'frameOpacity' => array (
							'id' => 'fancybox_frameOpacity',
							'hide' => true,
							'title' => __('Opacity','easy-fancybox'),
							'input' => 'number',
							'step' => '0.1',
							'min' => '0',
							'max' => '1',
							'status' => 'disabled',
							'class' => 'small-text',
							'default' => '',
							'description' => '<em><a href="http://status301.net/wordpress-plugins/easy-fancybox-pro/">' . __('Make available &raquo;','easy-fancybox') . '</a></em><br />'
							),
						'borderRadius' => array (
							'id' => 'fancybox_borderRadius',
							'hide' => true,
							'title' => __('Border radius','easy-fancybox'),
							'input' => 'number',
							'step' => '1',
							'min' => '0',
							'max' => '99',
							'status' => 'disabled',
							'class' => 'small-text',
							'default' => '',
							'description' => __('Set a border radius to create rounded corners. Higher is rounder.','easy-fancybox') . ' <em><a href="http://status301.net/wordpress-plugins/easy-fancybox-pro/">' . __('Make available &raquo;','easy-fancybox') . '</a></em><br />'
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
							'default' => ''
							),
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
							'description' => '<em>' . __('Default:','easy-fancybox')  . ' 560 x 340 x 10</em><br />' . __('If content size is not set or cannot be determined automatically, these default dimensions will be used.','easy-fancybox') . '<br />'
							),

						'p2' => array (
							'hide' => true,
							'description' => '<br /><strong>' . __('Behavior','easy-fancybox') . '</strong><br />'
							),
						'centerOnScroll' => array (
							'id' => 'fancybox_centerOnScroll',
							'input' => 'checkbox',
							'noquotes' => true,
							'default' => '1',
							'description' => __('Center while scrolling','easy-fancybox')
							),
						'enableEscapeButton' => array (
							'id' => 'fancybox_enableEscapeButton',
							'input' => 'checkbox',
							'noquotes' => true,
							'default' => '1',
							'description' => __('Esc key stroke closes FancyBox','easy-fancybox')
							),
						'autoScale' => array (
							'id' => 'fancybox_autoScale',
							'input' => 'checkbox',
							'noquotes' => true,
							'default' => '1',
							'description' => __('Scale large content down to fit in the browser viewport.','easy-fancybox')
							),
						'speedIn' => array (
							'id' => 'fancybox_speedIn',
							'title' => __('Opening speed','easy-fancybox'),
							'label_for' => 'fancybox_speedIn',
							'input' => 'number',
							'step' => '1',
							'min' => '0',
							'max' => '6000',
							'sanitize_callback' => 'intval',
							'class' => 'small-text',
							'default' => '',
							),
						'speedOut' => array (
							'id' => 'fancybox_speedOut',
							'title' => __('Closing speed','easy-fancybox'),
							'label_for' => 'fancybox_speedOut',
							'input' => 'number',
							'step' => '1',
							'min' => '0',
							'max' => '6000',
							'sanitize_callback' => 'intval',
							'class' => 'small-text',
							'default' => '',
							'description' => '<br />' . __('Duration in milliseconds. Higher is slower.','easy-fancybox') . ' <em>' . __('Default:','easy-fancybox')  . ' 300</em><br />'
							),
						'bgColor' => array (
							'id' => 'fancybox_backgroundColor',
							'hide' => true,
							'input' => 'hidden',
							'default' => '#fff',
							),
						'pColor' => array (
							'id' => 'fancybox_paddingColor',
							'hide' => true,
							'input' => 'hidden',
							'default' => '#fff'
							),
						'tColor' => array (
							'id' => 'fancybox_textColor',
							'hide' => true,
							'input' => 'hidden',
							'default' => 'inherit'
							),
						'fOpacity' => array (
							'id' => 'fancybox_frameOpacity',
							'hide' => true,
							'input' => 'hidden',
							'default' => '1.0'
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
					'default' => 'a.fancybox, area.fancybox, li.fancybox a:not(li.nofancybox a)'
					),
				'class' => array (
					'hide' => true,
					'default' => 'fancybox'
					),
/*				'type' => array (
					'default' => 'image'
					),*/
				'autoAttribute' => array (
					'id' => 'fancybox_autoAttribute',
					'title' => __('Autodetect','easy-fancybox'),
					'label_for' => 'fancybox_autoAttribute',
					'input' => 'text',
					'class' => 'regular-text',
					'hide' => true,
					'default' => '.jpg .jpeg .png',
					'selector' => 'href*=',
					'description' => ' <em>' . __('Example:','easy-fancybox') . ' .jpg .jpeg .png .gif</em><br />'
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
					'description' => '<em><a href="http://status301.net/wordpress-plugins/easy-fancybox-pro/">' . __('More options &raquo;','easy-fancybox') . '</a></em><br />'
					),
				'p2' => array (
					'hide' => true,
					'description' => '<br /><strong>' . __('Behavior','easy-fancybox') . '</strong><br />'
					),
				'transitionIn' => array (
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
				'easingIn' => array (
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
					'default' => 'easeOutBack',
					'description' => ' <em><a href="http://status301.net/wordpress-plugins/easy-fancybox-pro/">' . __('More options &raquo;','easy-fancybox') . '</a></em><br />'
					),
				'transitionOut' => array (
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
				'easingOut' => array (
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
					'default' => 'easeInBack',
					'description' => ' <em><a href="http://status301.net/wordpress-plugins/easy-fancybox-pro/">' . __('More options &raquo;','easy-fancybox') . '</a></em><br />' . __('Note:','easy-fancybox') . ' ' . __('Easing effects only apply when Transition is set to Elastic. ','easy-fancybox')  . '<br /><br />'
					),
				'opacity' => array (
					'id' => 'fancybox_opacity',
					'input' => 'checkbox',
					'noquotes' => true,
					'default' => '',
					'description' => __('Transparency fade during elastic transition. CAUTION: Use only when at least Transition In is set to Elastic!','easy-fancybox')
					),
				'hideOnContentClick' => array (
					'id' => 'fancybox_hideOnContentClick',
					'input' => 'checkbox',
					'noquotes' => true,
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
					'noquotes' => true,
					'default' => '1',
					'description' => __('Show title','easy-fancybox')
					),
				'titlePosition' => array (
					'id' => 'fancybox_titlePosition',
					'title' => __('Title Position','easy-fancybox'),
					'label_for' => 'fancybox_titlePosition',
					'input' => 'select',
					'options' => array(
						'' => __('Float','easy-fancybox'),
						'outside' => __('Outside','easy-fancybox'),
						'inside' => __('Inside','easy-fancybox'),
						'over' => __('Overlay','easy-fancybox')
						),
					'default' => 'over',
					'description' => ' '
					),
				'titleFromAlt' => array (
					'id' => 'fancybox_titleFromAlt',
					'input' => 'checkbox',
					'noquotes' => true,
					'default' => '1',
					'description' => __('Allow title from thumbnail alt tag','easy-fancybox')
					),
				'onStart' => array (
					'id' => '',
					'title' => __('Advanced','easy-fancybox'),
					'input' => 'select',
					'status' => 'disabled',
					'options' => array(
						'' => __('Hide/show title on mouse hover action','easy-fancybox')
						),
					'default' => '',
					'description' =>  '<em><a href="http://status301.net/wordpress-plugins/easy-fancybox-pro/">' . __('Make available &raquo;','easy-fancybox') . '</a></em><br />'
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
					'description' => '<em><a href="http://status301.net/wordpress-plugins/easy-fancybox-pro/">' . __('More options &raquo;','easy-fancybox') . '</a></em><br />' . __('Note:','easy-fancybox') . ' ' . __('When disabled, you can use the rel attribute to manually group image links together.','easy-fancybox') . '<br /><br />'
					),
				'showNavArrows' => array (
					'id' => 'fancybox_showNavArrows',
					'input' => 'checkbox',
					'noquotes' => true,
					'default' => '1',
					'description' => __('Show the gallery navigation arrows','easy-fancybox')
					),
				'enableKeyboardNav' => array (
					'id' => 'fancybox_enableKeyboardNav',
					'input' => 'checkbox',
					'noquotes' => true,
					'default' => '1',
					'description' => __('Arrow key strokes browse the gallery','easy-fancybox')
					),
				'mouseWheel' => array (
					'id' => 'fancybox_mouseWheel',
					'hide' => true,
					'input' => 'checkbox',
					'default' => '1',
					'description' => __('Include the Mousewheel jQuery extension script to allow gallery browsing by mousewheel action.','easy-fancybox')
					),
				'cyclic' => array (
					'id' => 'fancybox_cyclic',
					'input' => 'checkbox',
					'noquotes' => true,
					'default' => '',
					'description' => __('Make galleries cyclic, allowing you to keep pressing next/back.','easy-fancybox')
					),
				'changeSpeed' => array (
					'id' => 'fancybox_changeSpeed',
					'title' => __('Change speed','easy-fancybox'),
					'label_for' => 'fancybox_changeSpeed',
					'input' => 'number',
					'step' => '1',
					'min' => '0',
					'max' => '6000',
					'sanitize_callback' => 'intval',
					'class' => 'small-text',
					'default' => '',
					),
				'changeFade' => array (
					'id' => 'fancybox_changeFade',
					'title' => __('Fade speed','easy-fancybox'),
					'label_for' => 'fancybox_changeFade',
					'input' => 'number',
					'step' => '1',
					'min' => '0',
					'max' => '6000',
					'sanitize_callback' => 'intval',
					'class' => 'small-text',
					'default' => '',
					'description' => '<br />' . __('Duration in milliseconds. Higher is slower.','easy-fancybox') . ' <em>' . __('Default:','easy-fancybox')  . ' 300</em><br /><br />'
					),
				'autoSelector' => array (
					'id' => 'fancybox_autoSelector',
					'hide' => true,
					'input' => 'hidden',
					'default' => 'div.gallery ', // add div.tiled-gallery for Tiled Galleries support
					'translations' => __('Galleries per Section (below)','easy-fancybox') . __('This applies when <em>Apply to</em> is set to <em>Limited to Sections</em> and/or <em>Autogallery</em> is set to <em>Galleries per Section</em>. Adapt it to conform with your theme.','easy-fancybox') . __('Examples: If your theme wraps post content in a div with class post, change this value to "div.post". If you only want to group images in a WordPress gallery together, use "div.gallery". If you want to include images in a sidebar with ID primary, add ", #primary".','easy-fancybox') . __('Hide/show title on mouse hover action works best with Overlay title position.','easy-fancybox') . __('Auto-rotation uses a fixed 3, 6, 9 or 12 second pause per image.','easy-fancybox') . __('(3 seconds)','easy-fancybox') . __('(6 seconds)','easy-fancybox') . __('(9 seconds)','easy-fancybox') . __('(12 seconds)','easy-fancybox')
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
					'description' =>  '<em><a href="http://status301.net/wordpress-plugins/easy-fancybox-pro/">' . __('Make available &raquo;','easy-fancybox') . '</a></em>'
					),
/*				'titleFormat' => array (
					'id' => 'fancybox_titleFormat',
					'title' => __('Title format','easy-fancybox'),
					'label_for' => 'fancybox_titleFormat',
					'input' => 'select',
					'options' => array(
						'' => __('Default FancyBox style','easy-fancybox'),
						'function(title, currentArray, currentIndex, currentOpts) { return \'<div style="font-face:Arial,sans-serif;text-align:left"><span style="float:right;font-size:large"><a href="javascript:;" onclick="$.fancybox.close();">' . __('Close','easy-fancybox') . ' <img src="' . plugins_url(FANCYBOX_SUBDIR, __FILE__) . '/fancybox/fancy_close.png" /></a></span>\' + (title && title.length ? \'<b style="display:block;margin-right:80px">\' + title + \'</b>\' : \'\' ) + \'' . __('Image','easy-fancybox') . '\' + (currentIndex + 1) + \' ' . __('of','easy-fancybox') . ' \' + currentArray.length + \'</div>\';
}' => __('Mimic Lightbox2 style','easy-fancybox'),
						),
					'noquotes' => true,
					'default' => '',
					'description' =>  '<br />' . __('To improve Lightbox2 style disable Show close button and set titleposition to Inside or Outside','easy-fancybox') . '<br />'
					),*/
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
					'default' => 'a.fancybox-inline, area.fancybox-inline, li.fancybox-inline a:not(li.nofancybox-inline a)'
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
					'input' => 'checkbox',
					'noquotes' => true,
					'default' => '1',
					'description' => __('Try to adjust size to inline/html content. If unchecked or size cannot be determined, the default dimensions will be used.','easy-fancybox') . ''
					),
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
					'default' => 'no',
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
					'description' => ' <em><a href="http://status301.net/wordpress-plugins/easy-fancybox-pro/">' . __('More options &raquo;','easy-fancybox') . '</a></em><br />'
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
					'description' => ' <em><a href="http://status301.net/wordpress-plugins/easy-fancybox-pro/">' . __('More options &raquo;','easy-fancybox') . '</a></em><br />' . __('Note:','easy-fancybox') . ' ' . __('Easing effects only apply when Transition is set to Elastic. ','easy-fancybox')  . '<br /><br />'
					),
				'opacity' => array (
					'id' => 'fancybox_opacityInline',
					'input' => 'checkbox',
					'noquotes' => true,
					'default' => '',
					'description' => __('Transparency fade during elastic transition. CAUTION: Use only when at least Transition In is set to Elastic!','easy-fancybox')
					),
				'hideOnContentClick' => array (
					'id' => 'fancybox_hideOnContentClickInline',
					'input' => 'checkbox',
					'noquotes' => true,
					'default' => '',
					'description' => __('Close FancyBox when content is clicked','easy-fancybox')
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
					'selector' => 'href*=".pdf"',
					'description' => __('Autodetect','easy-fancybox') . '<br />'
					),
				'tag' => array (
					'hide' => true,
					'default' => 'a.fancybox-pdf, area.fancybox-pdf, li.fancybox-pdf a:not(li.nofancybox a)'
					),
				'class' => array (
					'hide' => true,
					'default' => 'fancybox-pdf'
					),
				'type' => array (
					'default' => 'html'
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
/*				'autoScale' => array (
					'noquotes' => true,
					'default' => 'false'
					),*/
				'titleShow' => array (
					'id' => 'fancybox_PDFtitleShow',
					'input' => 'checkbox',
					'noquotes' => true,
					'default' => '',
					'description' => __('Show title','easy-fancybox')
					),
				'titlePosition' => array (
					'id' => 'fancybox_PDFtitlePosition',
					'title' => __('Title Position','easy-fancybox'),
					'label_for' => 'fancybox_PDFtitlePosition',
					'input' => 'select',
					'options' => array(
						'float' => __('Float','easy-fancybox'),
						'outside' => __('Outside','easy-fancybox'),
						'inside' => __('Inside','easy-fancybox')
						),
					'default' => 'float',
					),
				'titleFromAlt' => array (
					'id' => 'fancybox_PDFtitleFromAlt',
					'input' => 'checkbox',
					'noquotes' => true,
					'default' => '1',
					'description' => __('Allow title from thumbnail alt tag','easy-fancybox')
					),
/*				'transitionOut' => array (
					'id' => 'fancybox_PDFtransitionOut',
					'title' => __('Transition Out','easy-fancybox'),
					'label_for' => 'fancybox_PDFtransitionOut',
					'input' => 'select',
					'class' => '',
					'options' => array(
						'fade' => __('Fade','easy-fancybox'),
						//'elastic' => __('Elastic','easy-fancybox'),
						'none' => translate('None')
						),
					'default' => 'fade',
					),
				'easingIn' => array (
					'default' => 'swing'
					),*/
				'autoDimensions' => array (
					'noquotes' => true,
					'default' => 'false'
					),
				'scrolling' => array (
					'default' => 'no',
					),
				'onStart' => array ( 
					'noquotes' => true,
//					'default' => 'function(selectedArray, selectedIndex, selectedOpts) { selectedOpts.content = \'<embed src="\' + selectedArray[selectedIndex].href + \'#nameddest=self&page=1&view=FitH,0&zoom=80,0,0" type="application/pdf" height="100%" width="100%" />\' }'
//					'default' => 'function(selectedArray, selectedIndex, selectedOpts) { selectedOpts.content = \'<object data="\' + selectedArray[selectedIndex].href + \'#toolbar=1&navpanes=0&nameddest=self&page=1&view=FitH,0&zoom=80,0,0" type="application/pdf" height="100%" width="100%"><param name="src" value="\' + selectedArray[selectedIndex].href + \'#toolbar=1&navpanes=0&nameddest=self&page=1&view=FitH,0&zoom=80,0,0" /><embed src="\' + selectedArray[selectedIndex].href + \'#toolbar=1&navpanes=0&nameddest=self&page=1&view=FitH,0&zoom=80,0,0" type="application/pdf" height="100%" width="100%" /><a href="\' + selectedArray[selectedIndex].href + \'" style="display:block;font-size:18px;position:absolute;top:50%;width:100%;text-align:center">\' + jQuery(selectedArray[selectedIndex]).html() + \'</a></object>\' }'
					'default' => 'function(selectedArray, selectedIndex, selectedOpts) { selectedOpts.content = \'<embed src="\' + selectedArray[selectedIndex].href + \'#toolbar=1&navpanes=0&nameddest=self&page=1&view=FitH,0&zoom=80,0,0" type="application/pdf" height="100%" width="100%" />\' }'
					),
/*				'onClosed' => array ( 
					'noquotes' => true,
					'default' => 'function() { $("#fancybox-content").empty(); }'
					)*/
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
					'selector' => 'href*=".swf"',
					'description' => __('Autodetect','easy-fancybox') . '<br />'
					),
				'tag' => array (
					'hide' => true,
					'default' => 'a.fancybox-swf, area.fancybox-swf, li.fancybox-swf a:not(li.nofancybox a)'
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
					'noquotes' => true,
					'default' => '',
					'description' => __('Show title','easy-fancybox')
					),
				'titlePosition' => array (
					'id' => 'fancybox_SWFtitlePosition',
					'title' => __('Title Position','easy-fancybox'),
					'label_for' => 'fancybox_SWFtitlePosition',
					'input' => 'select',
					'options' => array(
						'float' => __('Float','easy-fancybox'),
						'outside' => __('Outside','easy-fancybox'),
						'inside' => __('Inside','easy-fancybox')
						),
					'default' => 'float',
					),
				'titleFromAlt' => array (
					'id' => 'fancybox_SWFtitleFromAlt',
					'input' => 'checkbox',
					'noquotes' => true,
					'default' => '1',
					'description' => __('Allow title from thumbnail alt tag','easy-fancybox')
					),
				'swf' => array (
					'noquotes' => true,
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
					'selector' => 'href$=".svg"',
					'description' => __('Autodetect','easy-fancybox') . '<br />'
					),
				'tag' => array (
					'hide' => true,
					'default' => 'a.fancybox-svg, area.fancybox-svg, li.fancybox-svg a:not(li.nofancybox a)'
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
					'noquotes' => true,
					'default' => '',
					'description' => __('Show title','easy-fancybox')
					),
				'titlePosition' => array (
					'id' => 'fancybox_SVGtitlePosition',
					'title' => __('Title Position','easy-fancybox'),
					'label_for' => 'fancybox_SVGtitlePosition',
					'input' => 'select',
					'options' => array(
						'float' => __('Float','easy-fancybox'), 
						'outside' => __('Outside','easy-fancybox'),
						'inside' => __('Inside','easy-fancybox')
						//,'over' => __('Overlay','easy-fancybox')
						),
					'default' => 'float',
					),
				'titleFromAlt' => array (
					'id' => 'fancybox_SVGtitleFromAlt',
					'input' => 'checkbox',
					'noquotes' => true,
					'default' => '1',
					'description' => __('Allow title from thumbnail alt tag','easy-fancybox')
					),
				'svg' => array (
					'noquotes' => true,
					'default' => '{\'wmode\':\'opaque\',\'allowfullscreen\':true}'
					)
				)
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
					'selector' => 'href*="youtube.com/watch"',
					//'href-replace' => "return attr.replace(new RegExp('watch\\\?v=', 'i'), 'v/')",
					'description' => __('Autodetect','easy-fancybox')
					),
				'autoAttributeAlt' => array (
					'id' => 'fancybox_autoAttributeYoutubeShortURL',
					'input' => 'checkbox',
					'hide' => true,
					'default' => '1',
					'selector' => 'href*="youtu.be/"',
					//'href-replace' => "return attr.replace(new RegExp('youtu.be', 'i'), 'www.youtube.com/v')",
					'description' => __('Autodetect Short links','easy-fancybox') . '<br />'
					),
				'tag' => array (
					'hide' => true,
					'default' => 'a.fancybox-youtube, area.fancybox-youtube, li.fancybox-youtube a:not(li.nofancybox a)'
					),
				'class' => array (
					'hide' => true,
					'default' => 'fancybox-youtube'
					),
				'type' => array( 
					'default' => 'iframe' 
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
				'titleShow' => array (
					'id' => 'fancybox_YoutubetitleShow',
					'input' => 'checkbox',
					'noquotes' => true,
					'default' => '',
					'description' => __('Show title','easy-fancybox')
					),
				'titlePosition' => array (
					'id' => 'fancybox_YoutubetitlePosition',
					'title' => __('Title Position','easy-fancybox'),
					'label_for' => 'fancybox_YoutubetitlePosition',
					'input' => 'select',
					'options' => array(
						'float' => __('Float','easy-fancybox'),
						'outside' => __('Outside','easy-fancybox'),
						'inside' => __('Inside','easy-fancybox')
						),
					'default' => 'float',
					),
				'titleFromAlt' => array (
					'id' => 'fancybox_YoutubetitleFromAlt',
					'input' => 'checkbox',
					'noquotes' => true,
					'default' => '1',
					'description' => __('Allow title from thumbnail alt tag','easy-fancybox')
					),
				'onStart' => array ( 
					'noquotes' => true,
					'default' => 'function(selectedArray, selectedIndex, selectedOpts) { selectedOpts.href = selectedArray[selectedIndex].href.replace(new RegExp(\'youtu.be\', \'i\'), \'www.youtube.com/embed\').replace(new RegExp(\'watch\\\?(.*)v=([a-z0-9\_\-]+)(&|\\\?)?(.*)\', \'i\'), \'embed/$2?$1$4\') }'
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
					'selector' => 'href*="vimeo.com/"',
					//'href-replace' => "return attr.replace(new RegExp('/([0-9])', 'i'), '/moogaloop.swf?clip_id=$1')",
					'description' => __('Autodetect','easy-fancybox') . '<br />'
					),
				'tag' => array (
					'hide' => true,
					'default' => 'a.fancybox-vimeo, area.fancybox-vimeo, li.fancybox-vimeo a:not(li.nofancybox a)'
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
				'titleShow' => array (
					'id' => 'fancybox_VimeotitleShow',
					'input' => 'checkbox',
					'noquotes' => true,
					'default' => '',
					'description' => __('Show title','easy-fancybox')
					),
				'titlePosition' => array (
					'id' => 'fancybox_VimeotitlePosition',
					'title' => __('Title Position','easy-fancybox'),
					'label_for' => 'fancybox_VimeotitlePosition',
					'input' => 'select',
					'options' => array(
						'float' => __('Float','easy-fancybox'),
						'outside' => __('Outside','easy-fancybox'),
						'inside' => __('Inside','easy-fancybox')
						),
					'default' => 'float',
					),
				'titleFromAlt' => array (
					'id' => 'fancybox_VimeotitleFromAlt',
					'input' => 'checkbox',
					'noquotes' => true,
					'default' => '1',
					'description' => __('Allow title from thumbnail alt tag','easy-fancybox')
					),
				'onStart' => array ( 
					'noquotes' => true,
					'default' => 'function(selectedArray, selectedIndex, selectedOpts) { selectedOpts.href = selectedArray[selectedIndex].href.replace(new RegExp(\'http://(www\\.)?vimeo\\.com/([0-9]+)(&|\\\?)?(.*)\', \'i\'), \'http://player.vimeo.com/video/$2?$4\') }'
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
					'selector' => 'href*="dailymotion.com/"',
					//'href-replace' => "return attr.replace(new RegExp('/video/', 'i'), '/swf/')",
					'description' => __('Autodetect','easy-fancybox') . '<br />'
					),
				'tag' => array (
					'hide' => true,
					'default' => 'a.fancybox-dailymotion, area.fancybox-dailymotion, li.fancybox-dailymotion a:not(li.nofancybox a)'
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
				'titleShow' => array (
					'id' => 'fancybox_DailymotiontitleShow',
					'input' => 'checkbox',
					'noquotes' => true,
					'default' => '',
					'description' => __('Show title','easy-fancybox')
					),
				'titlePosition' => array (
					'id' => 'fancybox_DailymotiontitlePosition',
					'title' => __('Title Position','easy-fancybox'),
					'label_for' => 'fancybox_DailymotiontitlePosition',
					'input' => 'select',
					'options' => array(
						'float' => __('Float','easy-fancybox'),
						'outside' => __('Outside','easy-fancybox'),
						'inside' => __('Inside','easy-fancybox')
						),
					'default' => 'float',
					),
				'titleFromAlt' => array (
					'id' => 'fancybox_DailymotiontitleFromAlt',
					'input' => 'checkbox',
					'noquotes' => true,
					'default' => '1',
					'description' => __('Allow title from thumbnail alt tag','easy-fancybox')
					),
				'onStart' => array ( 
					'noquotes' => true,
					'default' => 'function(selectedArray, selectedIndex, selectedOpts) { selectedOpts.href = selectedArray[selectedIndex].href.replace(new RegExp(\'/video/(.*)\', \'i\'), \'/embed/video/$1\') }'
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
					'default' => 'a.fancybox-iframe, area.fancybox-iframe, li.fancybox-iframe a:not(li.nofancybox a)'
					),
				'class' => array (
					'hide' => true,
					'default' => 'fancybox-iframe'
					),
				'type' => array (
					'default' => 'iframe'
					),
				'scrolling' => array (
					'id' => 'fancybox_iFrameScrolling',
					'title' => __('Scrolling','easy-fancybox'),
					'label_for' => 'fancybox_iFrameScrolling',
					'input' => 'select',
					'options' => array(
						'auto' => __('Auto','easy-fancybox'),
						'yes' => __('Always','easy-fancybox'),
						'no' => __('Never','easy-fancybox')
						),
					'default' => 'auto',
					'description' => __('Define scrolling and scrollbar visibility.','easy-fancybox') . '<br />'
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
					'noquotes' => true,
					'default' => '',
					'description' => __('Show title','easy-fancybox')
					),
				'titlePosition' => array (
					'id' => 'fancybox_iFrametitlePosition',
					'title' => __('Title Position','easy-fancybox'),
					'label_for' => 'fancybox_iFrametitlePosition',
					'input' => 'select',
					'options' => array(
						'float' => __('Float','easy-fancybox'),
						'outside' => __('Outside','easy-fancybox'),
						'inside' => __('Inside','easy-fancybox')
						),
					'default' => 'float',
					),
				'titleFromAlt' => array (
					'id' => 'fancybox_iFrametitleFromAlt',
					'input' => 'checkbox',
					'noquotes' => true,
					'default' => '1',
					'description' => __('Allow title from thumbnail alt tag','easy-fancybox')
					)
				)
			)
			
		);

	}
	
}

easyFancyBox_Options::go();
