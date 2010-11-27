<?php
/*
Plugin Name: Easy FancyBox
Plugin URI: http://4visions.nl/en/wordpress-plugins/easy-fancybox/
Description: Easily enable the <a href="http://fancybox.net/">FancyBox 1.3.3 jQuery extension</a> on all image, SWF, YouTube and Vimeo links. Multi-Site compatible and supports iFrame and Flash movies in overlay viewport. Happy with it? Please leave me a small <a href="https://www.paypal.com/cgi-bin/webscr?cmd=_donations&business=ravanhagen%40gmail%2ecom&item_name=Easy%20FancyBox&amp;item_number=1%2e3%2e3&no_shipping=0&tax=0&bn=PP%2dDonationsBF&charset=UTF%2d8&lc=us">TIP</a> for development and support on this plugin and please consider a DONATION to the <a href="http://fancybox.net/">FancyBox project</a>.
Version: 1.3.4.5
Author: RavanH
Author URI: http://4visions.nl/
*/

// DEF

define( 'FANCYBOX_VERSION', '1.3.4' );
define( 'MOUSEWHEEL_VERSION', '3.0.4' );
define( 'EASING_VERSION', '1.3' );

// FUNCTIONS //

function easy_fancybox_settings(){
	return array ( 
		'Glob' => array(
			'title' => __('Global settings','easy-fancybox'),
			'input' => 'multiple',
			'hide' => true,
			'options' => array(
				'intro' => array (
						'hide' => true,
						'description' => __('These settings determine the global overlay appearance and behaviour controlled by FancyBox. Leave blank if you want to keep the default settings.','easy-fancybox') . '<br />'
					),
				'p1' => array (
						'hide' => true,
						'description' => '<br /><strong>' . __('Overlay','easy-fancybox') . '</strong><br />'
					),
				'overlayShow' => array (
						'id' => 'fancybox_overlayShow',
						'input' => 'checkbox',
						'default' => '1',
						'description' => __('Show the overlay around content opened in FancyBox.','easy-fancybox')
					),
				'overlayOpacity' => array (
						'id' => 'fancybox_overlayOpacity',
						'title' => __('Overlay opacity','easy-fancybox'),
						'label_for' => 'fancybox_overlayOpacity',
						'input' => 'text',
						'class' => 'small-text',
						'default' => '',
						'description' => __('Value between 0 and 1. ','easy-fancybox') . ' <em>' . __('Default:','easy-fancybox')  . ' 0.7</em><br />' 
					),
				'overlayColor' => array (
						'id' => 'fancybox_overlayColor',
						'title' => __('Overlay color','easy-fancybox'),
						'label_for' => 'fancybox_overlayColor',
						'input' => 'text',
						'class' => 'small-text',
						'default' => '',
						'description' => __('Enter a HTML color value.','easy-fancybox') . ' <em>' . __('Default:','easy-fancybox')  . ' #777</em><br />' 
					),
				'p2' => array (
						'hide' => true,
						'description' => '<br /><strong>' . __('Overlay window','easy-fancybox') . '</strong><br />'
					),
				'centerOnScroll' => array (
						'id' => 'fancybox_centerOnScroll',
						'input' => 'checkbox',
						'default' => '1',
						'description' => __('Center the FancyBox overlay window while scrolling.','easy-fancybox')
					),
				'showCloseButton' => array (
						'id' => 'fancybox_showCloseButton',
						'input' => 'checkbox',
						'default' => '1',
						'description' => __('Show the (X) close button.','easy-fancybox')
					),
				'showNavArrows' => array (
						'id' => 'fancybox_showNavArrows',
						'input' => 'checkbox',
						'default' => '1',
						'description' => __('Show the gallery navigation arrows.','easy-fancybox')
					),
				'width' => array (
						'id' => 'fancybox_width',
						'title' => __('Width'),
						'label_for' => 'fancybox_width',
						'input' => 'text',
						'class' => 'small-text',
						'default' => '',
						'description' => ' '
					),
				'height' => array (
						'id' => 'fancybox_height',
						'title' => __('Height'),
						'label_for' => 'fancybox_height',
						'input' => 'text',
						'class' => 'small-text',
						'default' => ''
					),
				'padding' => array (
						'id' => 'fancybox_padding',
						'title' => __('Border'),
						'label_for' => 'fancybox_padding',
						'input' => 'text',
						'class' => 'small-text',
						'default' => '',
						'description' => '<br />' . __('Change default width, heigth and border of the overlay window. Set Border 0 to remove the border.','easy-fancybox') . ' <em>' . __('Default:','easy-fancybox')  . ' 560 x 340 x 10</em><br />'
					),
				'p3' => array (
						'hide' => true,
						'description' => '<br /><strong>' . __('Transition','easy-fancybox') . '</strong><br />'
					),
				'transitionIn' => array (
						'id' => 'fancybox_transitionIn',
						'title' => __('Transition In','easy-fancybox'),
						'label_for' => 'fancybox_transitionIn',
						'input' => 'select',
						'options' => array(
							'' => __('Fade','easy-fancybox'),
							'elastic' => __('Elastic','easy-fancybox'),
							'none' => __('None','easy-fancybox')
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
							'' => __('Swing','easy-fancybox'),
							'easeOutBack' => __('Back','easy-fancybox'),
							'easeOutQuad' => __('Quad','easy-fancybox'),
							'easeOutExpo' => __('Expo','easy-fancybox'),
							),
						'default' => 'easeOutBack',
						'description' => '<br />'
					),
				'transitionOut' => array (
						'id' => 'fancybox_transitionOut',
						'title' => __('Transition Out','easy-fancybox'),
						'label_for' => 'fancybox_transitionOut',
						'input' => 'select',
						'options' => array(
							'' => __('Fade','easy-fancybox'),
							'elastic' => __('Elastic','easy-fancybox'),
							'none' => __('None','easy-fancybox')
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
							'' => __('Swing','easy-fancybox'),
							'easeInBack' => __('Back','easy-fancybox'),
							'easeInQuad' => __('Quad','easy-fancybox'),
							'easeInExpo' => __('Expo','easy-fancybox'),
							),
						'default' => 'easeInBack',
						'description' => '<br />' . __('Easing effects only apply when Transition is set to Elastic. ','easy-fancybox') . '<br />'
					),
				'speedIn' => array (
						'id' => 'fancybox_speedIn',
						'title' => __('Opening speed','easy-fancybox'),
						'label_for' => 'fancybox_speedIn',
						'input' => 'text',
						'class' => 'small-text',
						'default' => '',
					),
				'speedOut' => array (
						'id' => 'fancybox_speedIn',
						'title' => __('Closing speed','easy-fancybox'),
						'label_for' => 'fancybox_speedOut',
						'input' => 'text',
						'class' => 'small-text',
						'default' => '',
					),
				'changeFade' => array (
						'id' => 'fancybox_changeFade',
						'title' => __('Fade speed','easy-fancybox'),
						'label_for' => 'fancybox_changeFade',
						'input' => 'text',
						'class' => 'small-text',
						'default' => '',
						'description' => '<br />' . __('Duration in milliseconds. Higher is slower.','easy-fancybox') . ' <em>' . __('Default:','easy-fancybox')  . ' 300</em>' 
					)
				)
			),
		'Img' => array(
			'title' => __('Images','easy-fancybox'),
			'input' => 'multiple',
			'options' => array(
				'enable' => array (
						'id' => 'fancybox_enableImg',
						'input' => 'checkbox',
						'hide' => true,
						'default' => '1',
						'description' => '<strong>' . __('Enable FancyBox for','easy-fancybox') . ' ' . __('Images','easy-fancybox') . '</strong>'
					),
				'intro' => array (
						'hide' => true,
						'description' => __('To make any image file open in an overlay, add its extension to the auto-detect field or use the tag class="fancybox" for its link.','easy-fancybox') . '<br />'
					),
				'autoAttribute' => array (
						'id' => 'fancybox_autoAttribute',
						'title' => __('Auto-detect','easy-fancybox'),
						'label_for' => 'fancybox_autoAttribute',
						'input' => 'text',
						'class' => 'regular-text',
						'hide' => true,
						'default' => 'jpg gif png',
						'selector' => 'href$=',
						'description' => '<br />' . __('Enter file types FancyBox should be automatically enabled for. Clear field to switch off auto-enabling.','easy-fancybox') . ' <em>' . __('Default:','easy-fancybox')  . ' jpg gif png</em>' 
					),
				'class' => array (
						'hide' => true,
						'default' => 'fancybox'
					),
				'p1' => array (
						'hide' => true,
						'description' => '<br /><br />'
					),
				'titleShow' => array (
						'id' => 'fancybox_titleShow',
						'input' => 'checkbox',
						'default' => '1',
						'description' => __('Show title','easy-fancybox')
					),
				'titlePosition' => array (
						'id' => 'fancybox_titlePosition',
						'title' => __('Title Position','easy-fancybox'),
						'label_for' => 'fancybox_titlePosition',
						'input' => 'select',
						'options' => array(
								'' => __('Float','easy-fancybox'), // same as 'float'
								'outside' => __('Outside','easy-fancybox'),
								'inside' => __('Inside','easy-fancybox'),
								'over' => __('Overlay','easy-fancybox')
							),
						'default' => 'over',
					),
				'titleFromAlt' => array (
						'id' => 'fancybox_titleFromAlt',
						'input' => 'checkbox',
						'default' => '1',
						'description' => __('Get title from the thumbnail alt tag','easy-fancybox')
					)
/* TODO  : only use this parm when 'titlePosition' : 'over'
				,'onComplete' => array (
						'noquotes' => true,
						'default' => 'function() { $(\'#fancybox-wrap\').hover(function() { $(\'#fancybox-title\').show(); }, function() { $(\'#fancybox-title\').hide(); }); }'
					)*/
				)
			),

		'PDF' => array(
			'title' => __('PDF','easy-fancybox'),
			'input' => 'multiple',			'options' => array(
				'enable' => array (
						'id' => 'fancybox_enablePDF',
						'input' => 'checkbox',
						'hide' => true,
						'default' => '',
						'description' => '<strong>' . __('Enable FancyBox for','easy-fancybox') . ' ' . __('PDF','easy-fancybox') . '</strong>'
					),
				'autoAttribute' => array (
						'id' => 'fancybox_autoAttributePDF',
						'input' => 'checkbox',
						'hide' => true,
						'default' => '',
						'selector' => 'href$=".pdf"',
						'description' => __('Auto-detect','easy-fancybox')
					),
				'class' => array (
						'hide' => true,
						'default' => 'fancybox-pdf'
					),
				'intro' => array (
						'hide' => true,
						'description' => __('To make any PDF document file open in an overlay, switch on auto-detect or use the tag class="fancybox-pdf" for its link.','easy-fancybox') . ' ' . __('The overlay will use the dimensions set here. These can be relative (using %) or absolute sizes.','easy-fancybox') . '<br /><br />'
					),
				'type' => array (
						'default' => 'html'
					),
				'width' => array (
						'id' => 'fancybox_PDFwidth',
						'title' => __('Width'),
						'label_for' => 'fancybox_PDFwidth',
						'input' => 'text',
						'class' => 'small-text',
						'default' => '90%',
						'description' => ' '
					),
				'height' => array (
						'id' => 'fancybox_PDFheight',
						'title' => __('Height'),
						'label_for' => 'fancybox_PDFheight',
						'input' => 'text',
						'class' => 'small-text',
						'default' => '90%'
					),
				'margin' => array (
						'default' => '0'
					),
				'padding' => array (
						'default' => '0'
					),
				'autoScale' => array (
						'noquotes' => true,
						'default' => 'false'
					),
				'p1' => array (
						'hide' => true,
						'description' => '<br /><br />'
					),
				'titleShow' => array (
						'id' => 'fancybox_PDFtitleShow',
						'input' => 'checkbox',
						'default' => '',
						'description' => __('Show title','easy-fancybox')
					),
				'titlePosition' => array (
						'id' => 'fancybox_PDFtitlePosition',
						'title' => __('Title Position','easy-fancybox'),
						'label_for' => 'fancybox_PDFtitlePosition',
						'input' => 'select',
						'options' => array(
								'' => __('Float','easy-fancybox'), // same as 'float'
								'outside' => __('Outside','easy-fancybox'),
								'inside' => __('Inside','easy-fancybox')
								//,'over' => __('Overlay','easy-fancybox')
							),
						'default' => '',
					),
				'titleFromAlt' => array (
						'id' => 'fancybox_PDFtitleFromAlt',
						'input' => 'checkbox',
						'default' => '',
						'description' => __('Get title from the thumbnail alt tag','easy-fancybox')
					),
				'p2' => array (
						'hide' => true,
						'description' => '<br />'
					),
				'transitionIn' => array (
						'id' => 'fancybox_PDFtransitionIn',
						'title' => __('Transition In','easy-fancybox'),
						'label_for' => 'fancybox_PDFtransitionIn',
						'input' => 'select',
						'options' => array(
							'' => __('Fade','easy-fancybox'),
							'elastic' => __('Elastic','easy-fancybox'),
							'none' => __('None','easy-fancybox')
							),
						'default' => 'elastic',
					),
				'easingIn' => array (
						'id' => 'fancybox_PDFeasingIn',
						'title' => __('Easing In','easy-fancybox'),
						'label_for' => 'fancybox_PDFeasingIn',
						'input' => 'select',
						'options' => array(
							'' => __('Swing','easy-fancybox'),
							'easeOutBack' => __('Back','easy-fancybox'),
							'easeOutQuad' => __('Quad','easy-fancybox'),
							'easeOutExpo' => __('Expo','easy-fancybox'),
							),
						'default' => '',
					),
				'p3' => array (
						'hide' => true,
						'description' => '<br />'
					),
				'transitionOut' => array (
						'id' => 'fancybox_PDFtransitionOut',
						'title' => __('Transition Out','easy-fancybox'),
						'label_for' => 'fancybox_PDFtransitionOut',
						'input' => 'select',
						'options' => array(
							'fade' => __('Fade','easy-fancybox'),
							//'elastic' => __('Elastic','easy-fancybox'), // removed for browser compatibility reasons
							'none' => __('None','easy-fancybox')
							),
						'default' => 'fade',
					),
/*				'easingOut' => array (
						'id' => 'fancybox_PDFeasingOut',
						'title' => __('Easing Out','easy-fancybox'),
						'label_for' => 'fancybox_PDFeasingOut',
						'input' => 'select',
						'class' => '',
						'options' => array(
							'' => __('Swing','easy-fancybox'),
							'easeInBack' => __('Back','easy-fancybox'),
							'easeInQuad' => __('Quad','easy-fancybox'),
							'easeInExpo' => __('Expo','easy-fancybox'),
							),
						'default' => ''
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
						'default' => "function(selectedArray, selectedIndex, selectedOpts) { selectedOpts.content = '<embed src=\"' + selectedArray[selectedIndex].href + '#nameddest=self&page=1&view=FitH,0&zoom=80,0,0\" type=\"application/pdf\" height=\"100%\" width=\"100%\" />' }"
					),
				'outro' => array (
						'hide' => true,
						'description' => '<br />' . __('Easing effects only apply when Transition is set to Elastic. ','easy-fancybox')
					)
				)
			),

		'SWF' => array(
			'title' => __('SWF','easy-fancybox'),
			'input' => 'multiple',			'options' => array(
				'enable' => array (
						'id' => 'fancybox_enableSWF',
						'input' => 'checkbox',
						'hide' => true,
						'default' => '',
						'description' => '<strong>' . __('Enable FancyBox for','easy-fancybox') . ' ' . __('SWF','easy-fancybox') . '</strong>'
					),
				'autoAttribute' => array (
						'id' => 'fancybox_autoAttributeSWF',
						'input' => 'checkbox',
						'hide' => true,
						'default' => '',
						'selector' => 'href$=".swf"',
						'description' => __('Auto-detect','easy-fancybox')
					),
				'class' => array (
						'hide' => true,
						'default' => 'fancybox-swf'
					),
				'intro' => array (
						'hide' => true,
						'description' => __('These settings determine the SWF overlay behaviour controlled by FancyBox.','easy-fancybox') . ' ' . __('To make any Flash (.swf) file open in an overlay, switch on auto-detect or use the tag class="fancybox-swf" for its page link.','easy-fancybox') . ' ' . __('The overlay will use the dimensions set here. These can be relative (using %) or absolute sizes.','easy-fancybox') . '<br /><br />'
					),
				'type' => array( 
						'default' => 'swf' 
					),
				'width' => array (
						'id' => 'fancybox_SWFWidth',
						'title' => __('Width'),
						'label_for' => 'fancybox_SWFWidth',
						'input' => 'text',
						'class' => 'small-text',
						'options' => array(),
						'default' => '680',
						'description' => ' '
					),
				'height' => array (
						'id' => 'fancybox_SWFHeight',
						'title' => __('Height'),
						'label_for' => 'fancybox_SWFHeight',
						'input' => 'text',
						'class' => 'small-text',
						'options' => array(),
						'default' => '495',
					),
				'padding' => array (
						'default' => '0'
					),
				'autoScale' => array (
						'noquotes' => true,
						'default' => 'false'
					),
				'p1' => array (
						'hide' => true,
						'description' => '<br /><br />'
					),
				'titleShow' => array (
						'id' => 'fancybox_SWFtitleShow',
						'input' => 'checkbox',
						'default' => '',
						'description' => __('Show title','easy-fancybox')
					),
				'titlePosition' => array (
						'id' => 'fancybox_SWFtitlePosition',
						'title' => __('Title Position','easy-fancybox'),
						'label_for' => 'fancybox_SWFtitlePosition',
						'input' => 'select',
						'options' => array(
								'' => __('Float','easy-fancybox'), // same as 'float'
								'outside' => __('Outside','easy-fancybox'),
								'inside' => __('Inside','easy-fancybox')
								//,'over' => __('Overlay','easy-fancybox')
							),
						'default' => '',
					),
				'titleFromAlt' => array (
						'id' => 'fancybox_SWFtitleFromAlt',
						'input' => 'checkbox',
						'default' => '',
						'description' => __('Get title from the thumbnail alt tag','easy-fancybox')
					),
				'p2' => array (
						'hide' => true,
						'description' => '<br />'
					),
				'transitionIn' => array (
						'id' => 'fancybox_SWFtransitionIn',
						'title' => __('Transition In','easy-fancybox'),
						'label_for' => 'fancybox_SWFtransitionIn',
						'input' => 'select',
						'class' => '',
						'options' => array(
							'' => __('Fade','easy-fancybox'),
							'elastic' => __('Elastic','easy-fancybox'),
							'none' => __('None','easy-fancybox')
							),
						'default' => 'elastic',
						'description' => ' '
					),
				'easingIn' => array (
						'id' => 'fancybox_SWFeasingIn',
						'title' => __('Easing In','easy-fancybox'),
						'label_for' => 'fancybox_SWFeasingIn',
						'input' => 'select',
						'class' => '',
						'options' => array(
							'' => __('Swing','easy-fancybox'),
							'easeOutBack' => __('Back','easy-fancybox'),
							'easeOutQuad' => __('Quad','easy-fancybox'),
							'easeOutExpo' => __('Expo','easy-fancybox'),
							),
						'default' => '',
					),
				'p3' => array (
						'hide' => true,
						'description' => '<br />'
					),
				'transitionOut' => array (
						'id' => 'fancybox_SWFtransitionOut',
						'title' => __('Transition Out','easy-fancybox'),
						'label_for' => 'fancybox_SWFtransitionOut',
						'input' => 'select',
						'class' => '',
						'options' => array(
							'fade' => __('Fade','easy-fancybox'),
							//'elastic' => __('Elastic','easy-fancybox'),
							'none' => __('None','easy-fancybox')
							),
						'default' => 'fade',
					),
/*				'easingOut' => array (
						'id' => 'fancybox_SWFeasingOut',
						'title' => __('Easing Out','easy-fancybox'),
						'label_for' => 'fancybox_SWFeasingOut',
						'input' => 'select',
						'options' => array(
							'' => __('Swing','easy-fancybox'),
							'easeInBack' => __('Back','easy-fancybox'),
							'easeInQuad' => __('Quad','easy-fancybox'),
							'easeInExpo' => __('Expo','easy-fancybox'),
							),
						'default' => ''
					),*/
				'swf' => array (
						'noquotes' => true,
						'default' => '{\'wmode\':\'opaque\',\'allowfullscreen\':true}'
					),
				'outro' => array (
						'hide' => true,
						'description' => '<br />' . __('Easing effects only apply when Transition is set to Elastic. ','easy-fancybox')
					)
				)
			),

		'YouTube' => array(
			'title' => __('YouTube','easy-fancybox'),
			'input' => 'multiple',			'options' => array(
				'enable' => array (
						'id' => 'fancybox_enableYoutube',
						'input' => 'checkbox',
						'hide' => true,
						'default' => '',
						'description' => '<strong>' . __('Enable FancyBox for','easy-fancybox') . ' ' . __('YouTube','easy-fancybox') . '</strong>'
					),
				'autoAttribute' => array (
						'id' => 'fancybox_autoAttributeYoutube',
						'input' => 'checkbox',
						'hide' => true,
						'default' => '',
						'selector' => 'href*="youtube.com/watch"',
						'href-replace' => "return attr.replace(new RegExp('watch\\\?v=', 'i'), 'v/')",
						'description' => __('Auto-detect','easy-fancybox')
					),
				'class' => array (
						'hide' => true,
						'default' => 'fancybox-youtube'
					),
				'autoAttributeAlt' => array (
						'id' => 'fancybox_autoAttributeYoutubeShortURL',
						'input' => 'checkbox',
						'hide' => true,
						'default' => '',
						'selector' => 'href*="youtu.be/"',
						'href-replace' => "return attr.replace(new RegExp('youtu.be', 'i'), 'www.youtube.com/v')",
						'description' => __('Auto-detect Short links.','easy-fancybox')
					),
				'intro' => array (
						'hide' => true,
						'description' => __('To make any YouTube movie open in an overlay, switch on auto-detect or use the tag class="fancybox-youtube" for its page link.','easy-fancybox') . ' ' . __('The overlay will use the dimensions set here. These can be relative (using %) or absolute sizes.','easy-fancybox') . '<br /><br />'
					),
				'type' => array( 
						'default' => 'swf' 
					),
				'width' => array (
						'id' => 'fancybox_YoutubeWidth',
						'title' => __('Width'),
						'label_for' => 'fancybox_YoutubeWidth',
						'input' => 'text',
						'class' => 'small-text',
						'default' => '640',
						'description' => ' '
					),
				'height' => array (
						'id' => 'fancybox_YoutubeHeight',
						'title' => __('Height'),
						'label_for' => 'fancybox_YoutubeHeight',
						'input' => 'text',
						'class' => 'small-text',
						'default' => '385',
					),
				'padding' => array (
						'default' => '0'
					),
				'autoScale' => array (
						'noquotes' => true,
						'default' => 'false'
					),
				'p1' => array (
						'hide' => true,
						'description' => '<br /><br />'
					),
				'titleShow' => array (
						'id' => 'fancybox_YoutubetitleShow',
						'input' => 'checkbox',
						'default' => '',
						'description' => __('Show title','easy-fancybox')
					),
				'titlePosition' => array (
						'id' => 'fancybox_YoutubetitlePosition',
						'title' => __('Title Position','easy-fancybox'),
						'label_for' => 'fancybox_YoutubetitlePosition',
						'input' => 'select',
						'options' => array(
								'' => __('Float','easy-fancybox'), // same as 'float'
								'outside' => __('Outside','easy-fancybox'),
								'inside' => __('Inside','easy-fancybox')
								//,'over' => __('Overlay','easy-fancybox')
							),
						'default' => '',
					),
				'titleFromAlt' => array (
						'id' => 'fancybox_YoutubetitleFromAlt',
						'input' => 'checkbox',
						'default' => '',
						'description' => __('Get title from the thumbnail alt tag','easy-fancybox')
					),
				'p2' => array (
						'hide' => true,
						'description' => '<br />'
					),
				'transitionIn' => array (
						'id' => 'fancybox_YoutubetransitionIn',
						'title' => __('Transition In','easy-fancybox'),
						'label_for' => 'fancybox_YoutubetransitionIn',
						'input' => 'select',
						'options' => array(
							'' => __('Fade','easy-fancybox'),
							'elastic' => __('Elastic','easy-fancybox'),
							'none' => __('None','easy-fancybox')
							),
						'default' => 'elastic'
					),
				'easingIn' => array (
						'id' => 'fancybox_YoutubeeasingIn',
						'title' => __('Easing In','easy-fancybox'),
						'label_for' => 'fancybox_YoutubeeasingIn',
						'input' => 'select',
						'options' => array(
							'' => __('Swing','easy-fancybox'),
							'easeOutBack' => __('Back','easy-fancybox'),
							'easeOutQuad' => __('Quad','easy-fancybox'),
							'easeOutExpo' => __('Expo','easy-fancybox'),
							),
						'default' => ''
					),
				'p3' => array (
						'hide' => true,
						'description' => '<br />'
					),
				'transitionOut' => array (
						'id' => 'fancybox_YoutubetransitionOut',
						'title' => __('Transition Out','easy-fancybox'),
						'label_for' => 'fancybox_YoutubetransitionOut',
						'input' => 'select',
						'options' => array(
							'fade' => __('Fade','easy-fancybox'),
							//'elastic' => __('Elastic','easy-fancybox'),
							'none' => __('None','easy-fancybox')
							),
						'default' => 'fade'
					),
/*				'easingOut' => array (
					'id' => 'fancybox_YoutubeeasingOut',
					'title' => __('Easing Out','easy-fancybox'),
					'label_for' => 'fancybox_YoutubeeasingOut',
					'input' => 'select',
					'class' => '',
					'options' => array(
						'' => __('Swing','easy-fancybox'),
						'easeInBack' => __('Back','easy-fancybox'),
						'easeInQuad' => __('Quad','easy-fancybox'),
						'easeInExpo' => __('Expo','easy-fancybox'),
						),
					'default' => ''
					),*/
				'swf' => array (
						'noquotes' => true,
						'default' => '{\'wmode\':\'opaque\',\'allowfullscreen\':true}'
					),
				'outro' => array (
						'hide' => true,
						'description' => '<br />' . __('Easing effects only apply when Transition is set to Elastic. ','easy-fancybox')
					)
				)
			),

		'Vimeo' => array(
			'title' => __('Vimeo','easy-fancybox'),
			'input' => 'multiple',			'options' => array(
				'enable' => array (
						'id' => 'fancybox_enableVimeo',
						'input' => 'checkbox',
						'hide' => true,
						'default' => '',
						'description' => '<strong>' . __('Enable FancyBox for','easy-fancybox') . ' ' . __('Vimeo','easy-fancybox') . '</strong>'
					),
				'autoAttribute' => array (
						'id' => 'fancybox_autoAttributeVimeo',
						'input' => 'checkbox',
						'hide' => true,
						'default' => '',
						'selector' => 'href*="vimeo.com/"',
						'href-replace' => "return attr.replace(new RegExp('/([0-9])', 'i'), '/moogaloop.swf?clip_id=$1')",
						'description' => __('Auto-detect','easy-fancybox')
					),
				'class' => array (
						'hide' => true,
						'default' => 'fancybox-vimeo'
					),
				'intro' => array (
						'hide' => true,
						'description' => __('To make any Vimeo movie open in an overlay, switch on auto-detect or use the tag class="fancybox-vimeo" for its page link.','easy-fancybox') . ' ' . __('The overlay will use the dimensions set here. These can be relative (using %) or absolute sizes.','easy-fancybox') . '<br /><br />'
					),
				'type' => array( 
						'default' => 'swf' 
					),
				'width' => array (
					'id' => 'fancybox_VimeoWidth',
					'title' => __('Width'),
					'label_for' => 'fancybox_VimeoWidth',
					'input' => 'text',
					'class' => 'small-text',
					'default' => '640',
					'description' => ' '
					),
				'height' => array (
						'id' => 'fancybox_VimeoHeight',
						'title' => __('Height'),
						'label_for' => 'fancybox_VimeoHeight',
						'input' => 'text',
						'class' => 'small-text',
						'default' => '360'
					),
				'padding' => array (
						'default' => '0'
					),
				'autoScale' => array (
						'noquotes' => true,
						'default' => 'false'
					),
				'p1' => array (
						'hide' => true,
						'description' => '<br /><br />'
					),
				'titleShow' => array (
						'id' => 'fancybox_VimeotitleShow',
						'input' => 'checkbox',
						'default' => '',
						'description' => __('Show title','easy-fancybox')
					),
				'titlePosition' => array (
						'id' => 'fancybox_VimeotitlePosition',
						'title' => __('Title Position','easy-fancybox'),
						'label_for' => 'fancybox_VimeotitlePosition',
						'input' => 'select',
						'options' => array(
								'' => __('Float','easy-fancybox'), // same as 'float'
								'outside' => __('Outside','easy-fancybox'),
								'inside' => __('Inside','easy-fancybox')
								//,'over' => __('Overlay','easy-fancybox')
							),
						'default' => '',
					),
				'titleFromAlt' => array (
						'id' => 'fancybox_VimeotitleFromAlt',
						'input' => 'checkbox',
						'default' => '',
						'description' => __('Get title from the thumbnail alt tag','easy-fancybox')
					),
				'p2' => array (
						'hide' => true,
						'description' => '<br />'
					),
				'transitionIn' => array (
						'id' => 'fancybox_VimeotransitionIn',
						'title' => __('Transition In','easy-fancybox'),
						'label_for' => 'fancybox_VimeotransitionIn',
						'input' => 'select',
						'options' => array(
							'' => __('Fade','easy-fancybox'),
							'elastic' => __('Elastic','easy-fancybox'),
							'none' => __('None','easy-fancybox')
							),
						'default' => 'elastic'
					),
				'easingIn' => array (
						'id' => 'fancybox_VimeoeasingIn',
						'title' => __('Easing In','easy-fancybox'),
						'label_for' => 'fancybox_VimeoeasingIn',
						'input' => 'select',
						'options' => array(
							'' => __('Swing','easy-fancybox'),
							'easeOutBack' => __('Back','easy-fancybox'),
							'easeOutQuad' => __('Quad','easy-fancybox'),
							'easeOutExpo' => __('Expo','easy-fancybox'),
							),
						'default' => ''
					),
				'p3' => array (
						'hide' => true,
						'description' => '<br />'
					),
				'transitionOut' => array (
						'id' => 'fancybox_VimeotransitionOut',
						'title' => __('Transition Out','easy-fancybox'),
						'label_for' => 'fancybox_VimeotransitionOut',
						'input' => 'select',
						'options' => array(
							'fade' => __('Fade','easy-fancybox'),
							//'elastic' => __('Elastic','easy-fancybox'),
							'none' => __('None','easy-fancybox')
							),
						'default' => 'fade',
						'description' => __('Transition effect when closing the overlay.','easy-fancybox')
					),
/*				'easingOut' => array (
					'id' => 'fancybox_VimeoeasingOut',
					'title' => __('Easing Out','easy-fancybox'),
					'label_for' => 'fancybox_VimeoeasingOut',
					'input' => 'select',
					'class' => '',
					'options' => array(
						'' => __('Swing','easy-fancybox'),
						'easeInBack' => __('Back','easy-fancybox'),
						'easeInQuad' => __('Quad','easy-fancybox'),
						'easeInExpo' => __('Expo','easy-fancybox'),
						),
					'default' => ''
					),*/
				'swf' => array (
						'noquotes' => true,
						'default' => '{\'wmode\':\'opaque\',\'allowfullscreen\':true}'
					),
				'outro' => array (
						'hide' => true,
						'description' => '<br />' . __('Easing effects only apply when Transition is set to Elastic. ','easy-fancybox')
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
					'description' => __('Tudou links.','easy-fancybox')
					) 
				)					
			),*/

		'iFrame' => array(
			'title' => __('iFrames','easy-fancybox'),
			'input' => 'multiple',			'options' => array(
				'enable' => array (
						'id' => 'fancybox_enableiFrame',
						'input' => 'checkbox',
						'hide' => true,
						'default' => '',
						'description' => '<strong>' . __('Enable FancyBox for','easy-fancybox') . ' ' . __('iFrames','easy-fancybox') . '</strong>' 
					),
				'class' => array (
						'hide' => true,
						'default' => 'fancybox-iframe'
					),
				'intro' => array (
						'hide' => true,
						'description' => __('To make a website or HTML document open in an overlay, use the tag class="fancybox-iframe" or class="fancybox iframe" for its link.','easy-fancybox') . ' ' . __('The overlay will use the dimensions set here. These can be relative (using %) or absolute sizes.','easy-fancybox') . '<br /><br />'
					),
				'type' => array (
						'default' => 'html'
					),
				'padding' => array (
						'default' => '0'
					),
				'width' => array (
						'id' => 'fancybox_iFramewidth',
						'title' => __('Width'),
						'label_for' => 'fancybox_iFramewidth',
						'input' => 'text',
						'class' => 'small-text',
						'default' => '70%',
						'description' => ' '
					),
				'height' => array (
						'id' => 'fancybox_iFrameheight',
						'title' => __('Height'),
						'label_for' => 'fancybox_iFrameheight',
						'input' => 'text',
						'class' => 'small-text',
						'default' => '90%',
					),
				'padding' => array (
						'default' => '0'
					),
				'autoScale' => array (
						'noquotes' => true,
						'default' => 'false'
					),
				'p1' => array (
						'hide' => true,
						'description' => '<br /><br />'
					),
				'titleShow' => array (
						'id' => 'fancybox_iFrametitleShow',
						'input' => 'checkbox',
						'default' => '',
						'description' => __('Show title','easy-fancybox')
					),
				'titlePosition' => array (
						'id' => 'fancybox_iFrametitlePosition',
						'title' => __('Title Position','easy-fancybox'),
						'label_for' => 'fancybox_iFrametitlePosition',
						'input' => 'select',
						'options' => array(
								'' => __('Float','easy-fancybox'), // same as 'float'
								'outside' => __('Outside','easy-fancybox'),
								'inside' => __('Inside','easy-fancybox')
								//,'over' => __('Overlay','easy-fancybox')
							),
						'default' => '',
					),
				'titleFromAlt' => array (
						'id' => 'fancybox_iFrametitleFromAlt',
						'input' => 'checkbox',
						'default' => '',
						'description' => __('Get title from the thumbnail alt tag','easy-fancybox')
					),
				'p2' => array (
						'hide' => true,
						'description' => '<br />'
					),
				'transitionIn' => array (
						'id' => 'fancybox_iFrametransitionIn',
						'title' => __('Transition In','easy-fancybox'),
						'label_for' => 'fancybox_iFrametransitionIn',
						'input' => 'select',
						'options' => array(
							'' => __('Fade','easy-fancybox'),
							'elastic' => __('Elastic','easy-fancybox'),
							'none' => __('None','easy-fancybox')
							),
						'default' => 'elastic'
					),
				'easingIn' => array (
						'id' => 'fancybox_iFrameeasingIn',
						'title' => __('Easing In','easy-fancybox'),
						'label_for' => 'fancybox_iFrameeasingIn',
						'input' => 'select',
						'options' => array(
							'' => __('Swing','easy-fancybox'),
							'easeOutBack' => __('Back','easy-fancybox'),
							'easeOutQuad' => __('Quad','easy-fancybox'),
							'easeOutExpo' => __('Expo','easy-fancybox'),
							),
						'default' => ''
					),
				'p3' => array (
						'hide' => true,
						'description' => '<br />'
					),
				'transitionOut' => array (
						'id' => 'fancybox_iFrametransitionOut',
						'title' => __('Transition Out','easy-fancybox'),
						'label_for' => 'fancybox_iFrametransitionOut',
						'input' => 'select',
						'options' => array(
							'fade' => __('Fade','easy-fancybox'),
							//'elastic' => __('Elastic','easy-fancybox'),
							'none' => __('None','easy-fancybox')
							),
						'default' => 'fade'
					),
/*				'easingOut' => array (
					'id' => 'fancybox_iFrameeasingOut',
					'title' => __('Easing Out','easy-fancybox'),
					'label_for' => 'fancybox_iFrameeasingOut',
					'input' => 'select',
					'class' => '',
					'options' => array(
						'' => __('Swing','easy-fancybox'),
						'easeInBack' => __('Back','easy-fancybox'),
						'easeInQuad' => __('Quad','easy-fancybox'),
						'easeInExpo' => __('Expo','easy-fancybox'),
						),
					'default' => ''
					),*/
				'outro' => array (
						'hide' => true,
						'description' => '<br />' . __('Easing effects only apply when Transition is set to Elastic. ','easy-fancybox')
					)
				)
			)
			
		);
}

function easy_fancybox() {
	$easy_fancybox_array = easy_fancybox_settings();
	
	// begin output FancyBox settings
	echo "
<!-- Easy FancyBox plugin for WordPress using FancyBox ".FANCYBOX_VERSION." - RavanH (http://4visions.nl/en/wordpress-plugins/easy-fancybox/) -->
<script type=\"text/javascript\">
jQuery(document).ready(function($){";

		/*
		 * Global settings routine
		 */
		$more=0;
		echo '
	var fb_opts = {';
		foreach ($easy_fancybox_array['Glob']['options'] as $_key => $_values) {
			$parm = ($_values['id']) ? get_option($_values['id'], $_values['default']) : $_values['default'];
			$parm = ('checkbox'==$_values['input'] && ''==$parm) ? '0' : $parm;
			if(!$_values['hide'] && $parm!='') {
				$quote = (is_numeric($parm) || $_values['noquotes']) ? '' : '\'';
				if ($more>0)
					echo ',';
				echo ' \''.$_key.'\' : ';
				if ('checkbox'==$_values['input'])
					echo ( '1' == $parm ) ? 'true' : 'false';
				else
					echo $quote.$parm.$quote;
				$more++;
			}
		}
		echo ' };';

	
	foreach ($easy_fancybox_array as $key => $value) {
		// check if not enabled or hide=true then skip
		if ( !get_option($value['options']['enable']['id'], $value['options']['enable']['default']) || $value['hide'] )
			continue;

		echo '
	// ' . $key;
		/*
		 * Auto-detection routines (2x)
		 */
		$autoAttribute = get_option( $value['options']['autoAttribute']['id'], $value['options']['autoAttribute']['default'] );
		if(!empty($autoAttribute)) {
			if(is_numeric($autoAttribute)) {
				echo '
	$(\'a['.$value['options']['autoAttribute']['selector'].']\')';
				if ($value['options']['autoAttribute']['href-replace'])
					echo '.attr(\'href\', function(index, attr){'.$value['options']['autoAttribute']['href-replace'].'})';
				echo '.addClass(\''.$value['options']['class']['default'].'\');';
			} else {
				$file_types = array_filter( explode( ' ',  $autoAttribute) );
				$more=0;
				echo '
	var fb_'.$key.'_selector = \'';
				foreach ($file_types as $type) {
					if ($more>0)
						echo ',';
					echo 'a['.$value['options']['autoAttribute']['selector'].'".'.$type.'"],a['.$value['options']['autoAttribute']['selector'].'".'.strtoupper($type).'"]';
					$more++;
				}
				echo '\';';
				if ( is_single() || is_page() ) {
					echo '
	$(fb_'.$key.'_selector).addClass(\''.$value['options']['class']['default'].'\').attr(\'rel\', \'gallery\');';
				} else {
					echo '
	var fb_'.$key.'_posts = jQuery(\'div.post\');
	fb_'.$key.'_posts.each(function() { jQuery(this).find(fb_imglinks).addClass(\''.$value['options']['class']['default'].'\').attr(\'rel\', \'gallery-\' + fb_'.$key.'_posts.index(this)); });';
				}
			}
		}
		
		$autoAttributeAlt = get_option( $value['options']['autoAttributeAlt']['id'], $value['options']['autoAttributeAlt']['default'] );
		if(!empty($autoAttributeAlt) && is_numeric($autoAttributeAlt)) {
			echo '
	$(\'a['.$value['options']['autoAttributeAlt']['selector'].']\')';
			if ($value['options']['autoAttributeAlt']['href-replace'])
				echo '.attr(\'href\', function(index, attr){'.$value['options']['autoAttributeAlt']['href-replace']. '})';
			echo '.addClass(\''.$value['options']['class']['default'].'\');';
		}
		
		/*
		 * Append .fancybox() routine
		 */
		$more=0;
		echo '
	$(\'a.'.$value['options']['class']['default'].'\').fancybox( $.extend(fb_opts, {';
		foreach ($value['options'] as $_key => $_values) {
			$parm = ($_values['id']) ? get_option($_values['id'], $_values['default']) : $_values['default'];
			$parm = ('checkbox'==$_values['input'] && ''==$parm) ? '0' : $parm;
			if(!$_values['hide'] && $parm!='') {
				$quote = (is_numeric($parm) || $_values['noquotes']) ? '' : '\'';
				if ($more>0)
					echo ',';
				echo ' \''.$_key.'\' : ';
				if ('checkbox'==$_values['input'])
					echo ( '1' == $parm ) ? 'true' : 'false';
				else
					echo $quote.$parm.$quote;
				$more++;
			}
		}
		echo ' }) );';
		
	}

	echo"
});
</script>
";
}

// FancyBox Media Settings Section on Settings > Media admin page
function easy_fancybox_settings_section() {
	echo '<a href="https://www.paypal.com/cgi-bin/webscr?cmd=_donations&business=ravanhagen%40gmail%2ecom&item_name=Easy%20FancyBox&item_number=&no_shipping=0&tax=0&bn=PP%2dDonationsBF&charset=UTF%2d8&lc=us" title="'.__('Donate to Easy FancyBox plugin development with PayPal - it\'s fast, free and secure!','easy-fancybox').'"><img src="https://www.paypal.com/en_US/i/btn/x-click-but7.gif" style="border:none;float:right;margin:0 0 10px 10px" alt="'.__('Donate to Easy FancyBox plugin development with PayPal - it\'s fast, free and secure!','easy-fancybox').'" width="72" height="29" /></a><p>'.__('The options in this section are provided by the plugin <strong>Easy Fancybox</strong> by <em>RavanH</em>.','easy-fancybox').'</p><p>'.__('First change the <strong>Global settings</strong> to your liking. Then enable and configure each of the sub-sections that you need.','easy-fancybox').' '.__('Read more on <a href="http://4visions.nl/en/wordpress-plugins/easy-fancybox/">Easy FancyBox for WordPress</a>.','easy-fancybox').'</p><p>'.__('Note: Each additional sub-section and features like <em>Elastic transitions</em> and all <em>Easing effects</em> (except Swing) will have some impact on client-side page speed. Enable only those sub-sections and options that you actually need on your site.','easy-fancybox').' '.__('Some setting for Title Position and Transition are unavailable for swf, video, pdf and iframe content overlays to ensure browser compatibility and readability.','easy-fancybox').'</p>';
}

// FancyBox Media Settings Fields
function easy_fancybox_settings_fields($args){
	switch($args['input']) {
		case 'multiple':
			//if (!get_option($args['options']['enable']['id'], $args['options']['enable']['default']))
			//	easy_fancybox_settings_fields($args['options']['enable']);
			//else
			foreach ($args['options'] as $options)
				easy_fancybox_settings_fields($options);
			echo $args['description'];
			break;
		case 'select':
			if( !empty($args['label_for']) )
				echo '<label for="'.$args['label_for'].'">'.$args['title'].'</label> ';
			else
				echo $args['title'];
			echo '
			<select name="'.$args['id'].'" id="'.$args['id'].'">';
			foreach ($args['options'] as $optionkey => $optionvalue) {
				$selected = (get_option($args['id'], $args['default']) == $optionkey) ? ' selected="selected"' : '';
				echo '
				<option value="'.esc_attr($optionkey).'"'.$selected.'>'.$optionvalue.'</option>';
			}
			echo '
			</select> ';
			if( empty($args['label_for']) )
				echo '<label for="'.$args['id'].'">'.$args['description'].'</label> ';
			else
				echo $args['description'];
			break;
		case 'checkbox':
			if( !empty($args['label_for']) )
				echo '<label for="'.$args['label_for'].'">'.$args['title'].'</label> ';
			else
				echo $args['title'];
			$value = esc_attr( get_option($args['id'], $args['default']) );
			if ($value == "1")
				$checked = ' checked="checked"';
			else
				$checked = '';
			if ($args['default'] == "1")
				$default = __('Checked','easy-fancybox');
			else
				$default = __('Unchecked','easy-fancybox');
			if( empty($args['label_for']) )
				echo '
			<label><input type="checkbox" name="'.$args['id'].'" id="'.$args['id'].'" value="1" '.$checked.'/> '.$args['description'].'</label><br />';
			else
				echo '
			<input type="checkbox" name="'.$args['id'].'" id="'.$args['id'].'" value="1" '.$checked.'/> '.$args['description'].'<br />';
			break;
		case 'text':
			if( !empty($args['label_for']) )
				echo '<label for="'.$args['label_for'].'">'.$args['title'].'</label> ';
			else
				echo $args['title'];
			echo '
			<input type="text" name="'.$args['id'].'" id="'.$args['id'].'" value="'.esc_attr( get_option($args['id'], $args['default']) ).'" class="'.$args['class'].'"/> ';
			if( empty($args['label_for']) )
				echo '<label for="'.$args['id'].'">'.$args['description'].'</label> ';
			else
				echo $args['description'];
			break;
		default:
			echo $args['description'];
	}
}


function easy_fancybox_admin_init(){
	load_plugin_textdomain('easy-fancybox', false, dirname(plugin_basename( __FILE__ )));

	add_settings_section('fancybox_section', __('FancyBox','easy-fancybox'), 'easy_fancybox_settings_section', 'media');
	
	$easy_fancybox_array = easy_fancybox_settings();
	foreach ($easy_fancybox_array as $key => $value) {
		add_settings_field( 'fancybox_'.$key, $value['title'], 'easy_fancybox_settings_fields', 'media', 'fancybox_section', $value);
		if ($value['input']=='multiple')
			foreach ($value['options'] as $_value)
				if ($_value['id']) register_setting( 'media', $_value['id'] );	
		else
			if ($value['id']) register_setting( 'media', 'fancybox_'.$key );
	}
}

function easy_fancybox_enqueue() {
	// check if easy-fancybox.php is moved one dir up like in WPMU's /mu-plugins/
	// NOTE: don't use WP_PLUGIN_URL to avoid problems when installed in /mu-plugins/
	$efb_subdir = (file_exists(dirname(__FILE__).'/easy-fancybox')) ? 'easy-fancybox' : '';

	// ENQUEUE
	// register main fancybox script
	wp_enqueue_script('jquery.fancybox', plugins_url($efb_subdir, __FILE__).'/fancybox/jquery.fancybox-'.FANCYBOX_VERSION.'.pack.js', array('jquery'), FANCYBOX_VERSION);
	
	$easy_fancybox_array = easy_fancybox_settings();
	
	$easing = false;
	foreach ($easy_fancybox_array as $value) {
		if( ( 'elastic' == get_option($value['options']['transitionIn']['id'],$value['options']['transitionIn']['default']) || 'elastic' == get_option($value['options']['transitionOut']['id'],$value['options']['transitionOut']['default']) ) && ( '' != get_option($value['options']['easingIn']['id'],$value['options']['easingIn']['default']) || '' != get_option($value['options']['easingOut']['id'],$value['options']['easingOut']['default']) ) ) {
			$easing = true;
			break;
		}
	}
	if ( $easing ) {
		// first get rid of previously registered variants of jquery.easing (by other plugins)
		wp_deregister_script('jquery.easing');
		wp_deregister_script('jqueryeasing');
		wp_deregister_script('jquery-easing');
		wp_deregister_script('easing');
		// then register our version
		wp_enqueue_script('jquery.easing', plugins_url($efb_subdir, __FILE__).'/fancybox/jquery.easing-'.EASING_VERSION.'.pack.js', array('jquery'), EASING_VERSION);
	}
	
	// first get rid of previously registered variants of jquery.mousewheel (by other plugins)
	wp_deregister_script('jquery.mousewheel');
	wp_deregister_script('jquerymousewheel');
	wp_deregister_script('jquery-mousewheel');
	wp_deregister_script('mousewheel');
	// then register our version
	wp_enqueue_script('jquery.mousewheel', plugins_url($efb_subdir, __FILE__).'/fancybox/jquery.mousewheel-'.MOUSEWHEEL_VERSION.'.pack.js', array('jquery'), MOUSEWHEEL_VERSION);
	
	// register style
	wp_enqueue_style('easy-fancybox.css', plugins_url($efb_subdir, __FILE__).'/easy-fancybox.css.php', false, FANCYBOX_VERSION, 'screen');

}

// HOOKS //

add_action('wp_enqueue_scripts', 'easy_fancybox_enqueue', 999);
add_action('wp_head', 'easy_fancybox');

add_action('admin_init','easy_fancybox_admin_init');

