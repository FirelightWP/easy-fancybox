<?php
/*
Plugin Name: Easy FancyBox
Plugin URI: http://4visions.nl/en/wordpress-plugins/easy-fancybox/
Description: Easily enable the <a href="http://fancybox.net/">FancyBox jQuery extension</a> on all image, SWF, YouTube and Vimeo links. Multi-Site compatible and supports iFrame and Flash movies in overlay viewport. Happy with it? Please leave me a small <a href="https://www.paypal.com/cgi-bin/webscr?cmd=_donations&business=ravanhagen%40gmail%2ecom&item_name=Easy%20FancyBox&amp;item_number=1%2e3%2e4&no_shipping=0&tax=0&bn=PP%2dDonationsBF&charset=UTF%2d8&lc=us">TIP</a> for development and support on this plugin and please consider a DONATION to the <a href="http://fancybox.net/">FancyBox project</a>.
Version: 1.3.4.6
Author: RavanH
Author URI: http://4visions.nl/
*/

// DEF

define( 'FANCYBOX_VERSION', '1.3.4' );
define( 'MOUSEWHEEL_VERSION', '3.0.4' );
define( 'EASING_VERSION', '1.3' );
// check if easy-fancybox.php is moved one dir up like in WPMU's /mu-plugins/
// NOTE: don't use WP_PLUGIN_URL to avoid problems when installed in /mu-plugins/
if(file_exists(dirname(__FILE__).'/easy-fancybox'))
	define( 'FANCYBOX_SUBDIR', 'easy-fancybox' );
else
	define( 'FANCYBOX_SUBDIR', '' );


// FUNCTIONS //

function easy_fancybox_settings(){

	if (function_exists('is_plugin_active_for_network') && is_plugin_active_for_network(plugin_basename( __FILE__ )))
		$no_network_activate = '';
	else
		$no_network_activate = '1';
	
	return array ( 
		'Global' => array(
			'title' => __('Global settings','easy-fancybox'),
			'input' => 'multiple',
			'hide' => true,
			'options' => array(
				'intro' => array (
						'hide' => true,
						'description' => __('These settings determine the global overlay appearance and behaviour controlled by FancyBox.','easy-fancybox') . '<br />'
					),
				'p0' => array (
						'hide' => true,
						'description' => '<br /><strong>' . __('Links') . '</strong><br />'
					),
				'attributeLimit' => array (
						'id' => 'fancybox_attributeLimit',
						'title' => __('Exclude','easy-fancybox'),
						'label_for' => 'fancybox_attributeLimit',
						'hide' => true,
						'input' => 'select',
						'options' => array(
								'' => __('None'),
								'.not(\':empty\')' => __('Empty (hidden)','easy-fancybox'),
								'.has(\'img\')' => __('Without thumbnail image','easy-fancybox'),
							),
						'default' => '.not(\':empty\')'
					),
				'p1' => array (
						'hide' => true,
						'description' => '<br /><br /><strong>' . __('Overlay','easy-fancybox') . '</strong><br />'
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
						'description' => '<br />' . __('Change default width, heigth and border of the overlay window.','easy-fancybox') . ' ' . __('Set Border 0 to remove it.','easy-fancybox') . ' <em>' . __('Default:','easy-fancybox')  . ' 560 x 340 x 10</em><br />'
					),
				'centerOnScroll' => array (
						'id' => 'fancybox_centerOnScroll',
						'input' => 'checkbox',
						'default' => '1',
						'description' => __('Center while scrolling','easy-fancybox')
					),
				'showCloseButton' => array (
						'id' => 'fancybox_showCloseButton',
						'input' => 'checkbox',
						'default' => '1',
						'description' => __('Show the (X) close button','easy-fancybox')
					),
				'showNavArrows' => array (
						'id' => 'fancybox_showNavArrows',
						'input' => 'checkbox',
						'default' => '1',
						'description' => __('Show the gallery navigation arrows','easy-fancybox')
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
						'description' => ' '
					),
				'titleFromAlt' => array (
						'id' => 'fancybox_titleFromAlt',
						'input' => 'checkbox',
						'default' => '1',
						'description' => __('Allow title from thumbnail alt tag','easy-fancybox')
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
				'onComplete' => array (
						'id' => 'fancybox_onComplete',
						'title' => __('Extra\'s','easy-fancybox'),
						'label_for' => 'fancybox_onComplete',
						'input' => 'select',
						'options' => array(
								'' => __('No extra\'s','easy-fancybox'), // no extra's
								'function() { $(\'#fancybox-title\').hide(); $(\'#fancybox-wrap\').hover(function() { $(\'#fancybox-title\').show(); }, function() { $(\'#fancybox-title\').hide(); }); }' => __('Hide/show title on mouse hover action','easy-fancybox')
							),
						'noquotes' => true,
						'default' => '',
						'description' =>  '<br />' . __('Hide/show title on mouse hover action works best with Overlay title position','easy-fancybox') . '<br />'
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
						'description' => '<br />' . __('Easing effects only apply when Transition is set to Elastic. ','easy-fancybox') . '<br /><br />'
					),
				'opacity' => array (
						'id' => 'fancybox_opacity',
						'input' => 'checkbox',
						'default' => '',
						'description' => __('Transparency fade during elastic transition.','easy-fancybox')
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
						'description' => '<br />' . __('Duration in milliseconds. Higher is slower.','easy-fancybox') . ' <em>' . __('Default:','easy-fancybox')  . ' 300</em><br />'
					)				)
			),
		'IMG' => array(
			'title' => __('Images','easy-fancybox'),
			'input' => 'multiple',
			'options' => array(
				'enable' => array (
						'id' => 'fancybox_enableImg',
						'input' => 'checkbox',
						'hide' => true,
						'default' => ( function_exists('is_plugin_active_for_network') && is_plugin_active_for_network(plugin_basename( __FILE__ )) ) ? '' : '1',
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
					)
				)
			),

		'PDF' => array(
			'title' => __('PDF','easy-fancybox'),
			'input' => 'multiple',			
			'options' => array(
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
						'description' => __('To make any PDF document file open in an overlay, switch on auto-detect or use the tag class="fancybox-pdf" for its link.','easy-fancybox') . ' ' . __('Adjust its specific settings below.','easy-fancybox') . '<br /><br />'
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
						'id' => 'fancybox_PDFpadding',
						'title' => __('Border'),
						'label_for' => 'fancybox_PDFpadding',
						'input' => 'text',
						'class' => 'small-text',
						'default' => '0',
						'description' => '<br />' . __('Width and height can be relative (%) or absolute sizes.','easy-fancybox') . ' ' . __('Set Border 0 to remove it.','easy-fancybox') . '<br />'
					),
				'autoScale' => array (
						'noquotes' => true,
						'default' => 'false'
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
								'float' => __('Float','easy-fancybox'), // same as 'float'
								'outside' => __('Outside','easy-fancybox'),
								'inside' => __('Inside','easy-fancybox')
								//,'over' => __('Overlay','easy-fancybox')
							),
						'default' => 'float',
					),
				'titleFromAlt' => array (
						'id' => 'fancybox_PDFtitleFromAlt',
						'input' => 'checkbox',
						'default' => '',
						'description' => __('Allow title from thumbnail alt tag','easy-fancybox')
					),
				'transitionOut' => array (
						'id' => 'fancybox_PDFtransitionOut',
						'title' => __('Transition Out','easy-fancybox'),
						'label_for' => 'fancybox_PDFtransitionOut',
						'input' => 'select',
						'class' => '',
						'options' => array(
							'fade' => __('Fade','easy-fancybox'),
							//'elastic' => __('Elastic','easy-fancybox'),
							'none' => __('None','easy-fancybox')
							),
						'default' => 'fade',
					),
				'easingIn' => array (
						'default' => 'swing'
					),
				'autoDimensions' => array (
						'noquotes' => true,
						'default' => 'false'
					),
				'scrolling' => array (
						'default' => 'no',
					),
				'onStart' => array ( 
						'noquotes' => true,
//						'default' => 'function(selectedArray, selectedIndex, selectedOpts) { selectedOpts.content = \'<embed src="\' + selectedArray[selectedIndex].href + \'#nameddest=self&page=1&view=FitH,0&zoom=80,0,0" type="application/pdf" height="100%" width="100%" />\' }'
						'default' => 'function(selectedArray, selectedIndex, selectedOpts) { if ( selectedArray[selectedIndex].title == "" ) { selectedArray[selectedIndex].title = $(selectedArray[selectedIndex]).html() }; selectedOpts.content = \'<object data="\' + selectedArray[selectedIndex].href + \'#toolbar=0&amp;navpanes=0&amp;nameddest=self&amp;page=1&amp;view=FitH,0&amp;zoom=80,0,0" type="application/pdf" height="100%" width="100%" /><param name="src" value="\' + selectedArray[selectedIndex].href + \'#toolbar=0&amp;navpanes=0&amp;nameddest=self&amp;page=1&amp;view=FitH,0&amp;zoom=80,0,0" /><a href="\' + selectedArray[selectedIndex].href + \'">\' + selectedArray[selectedIndex].title + \'</a></object>\' }'
					)
				)
			),

		'SWF' => array(
			'title' => __('SWF','easy-fancybox'),
			'input' => 'multiple',
			'options' => array(
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
						'description' => __('To make any Flash (.swf) file open in an overlay, switch on auto-detect or use the tag class="fancybox-swf" for its link.','easy-fancybox') . ' ' . __('Adjust its specific settings below.','easy-fancybox') . '<br /><br />'
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
						'id' => 'fancybox_SWFpadding',
						'title' => __('Border'),
						'label_for' => 'fancybox_SWFpadding',
						'input' => 'text',
						'class' => 'small-text',
						'default' => '0',
						'description' => '<br />' . __('Width and height can be relative (%) or absolute sizes.','easy-fancybox') . ' ' . __('Set Border 0 to remove it.','easy-fancybox') . '<br />'
					),
				'autoScale' => array (
						'noquotes' => true,
						'default' => 'false'
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
								'float' => __('Float','easy-fancybox'), // same as 'float'
								'outside' => __('Outside','easy-fancybox'),
								'inside' => __('Inside','easy-fancybox')
								//,'over' => __('Overlay','easy-fancybox')
							),
						'default' => 'float',
					),
				'titleFromAlt' => array (
						'id' => 'fancybox_SWFtitleFromAlt',
						'input' => 'checkbox',
						'default' => '',
						'description' => __('Allow title from thumbnail alt tag','easy-fancybox')
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
				'easingIn' => array (
						'default' => 'swing'
					),
				'swf' => array (
						'noquotes' => true,
						'default' => '{\'wmode\':\'opaque\',\'allowfullscreen\':true}'
					)
				)
			),

		'YouTube' => array(
			'title' => __('YouTube','easy-fancybox'),
			'input' => 'multiple',			
			'options' => array(
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
						'selector' => 'href*="youtube.com/"',
						//'href-replace' => "return attr.replace(new RegExp('watch\\\?v=', 'i'), 'v/')",
						'description' => __('Auto-detect','easy-fancybox')
					),
				'autoAttributeAlt' => array (
						'id' => 'fancybox_autoAttributeYoutubeShortURL',
						'input' => 'checkbox',
						'hide' => true,
						'default' => '',
						'selector' => 'href*="youtu.be/"',
						//'href-replace' => "return attr.replace(new RegExp('youtu.be', 'i'), 'www.youtube.com/v')",
						'description' => __('Auto-detect Short links','easy-fancybox')
					),
				'class' => array (
						'hide' => true,
						'default' => 'fancybox-youtube'
					),
				'intro' => array (
						'hide' => true,
						'description' => __('To make any YouTube movie open in an overlay, switch on auto-detect or use the tag class="fancybox-youtube" for its link.','easy-fancybox') . ' ' . __('Adjust its specific settings below.','easy-fancybox') . '<br /><br />'
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
						'id' => 'fancybox_Youtubepadding',
						'title' => __('Border'),
						'label_for' => 'fancybox_Youtubepadding',
						'input' => 'text',
						'class' => 'small-text',
						'default' => '0',
						'description' => '<br />' . __('Width and height can be relative (%) or absolute sizes.','easy-fancybox') . ' ' . __('Set Border 0 to remove it.','easy-fancybox') . '<br />'
					),
				'autoScale' => array (
						'noquotes' => true,
						'default' => 'false'
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
								'float' => __('Float','easy-fancybox'), // same as 'float'
								'outside' => __('Outside','easy-fancybox'),
								'inside' => __('Inside','easy-fancybox')
								//,'over' => __('Overlay','easy-fancybox')
							),
						'default' => 'float',
					),
				'titleFromAlt' => array (
						'id' => 'fancybox_YoutubetitleFromAlt',
						'input' => 'checkbox',
						'default' => '',
						'description' => __('Allow title from thumbnail alt tag','easy-fancybox')
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
				'easingIn' => array (
						'default' => 'swing'
					),
				'swf' => array (
						'noquotes' => true,
						'default' => '{\'wmode\':\'opaque\',\'allowfullscreen\':true}'
					),
				'onStart' => array ( 
						'noquotes' => true,
						'default' => 'function(selectedArray, selectedIndex, selectedOpts) { selectedOpts.href = selectedArray[selectedIndex].href.replace(new RegExp(\'youtu.be\', \'i\'), \'www.youtube.com/v\').replace(new RegExp(\'watch\\\?v=\', \'i\'), \'v/\') }'
					)
				)
			),

		'Vimeo' => array(
			'title' => __('Vimeo','easy-fancybox'),
			'input' => 'multiple',			
			'options' => array(
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
						//'href-replace' => "return attr.replace(new RegExp('/([0-9])', 'i'), '/moogaloop.swf?clip_id=$1')",
						'description' => __('Auto-detect','easy-fancybox')
					),
				'class' => array (
						'hide' => true,
						'default' => 'fancybox-vimeo'
					),
				'intro' => array (
						'hide' => true,
						'description' => __('To make any Vimeo movie open in an overlay, switch on auto-detect or use the tag class="fancybox-vimeo" for its link.','easy-fancybox') . ' ' . __('Adjust its specific settings below.','easy-fancybox') . '<br /><br />'
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
						'id' => 'fancybox_Vimeopadding',
						'title' => __('Border'),
						'label_for' => 'fancybox_Vimeopadding',
						'input' => 'text',
						'class' => 'small-text',
						'default' => '0',
						'description' => '<br />' . __('Width and height can be relative (%) or absolute sizes.','easy-fancybox') . ' ' . __('Set Border 0 to remove it.','easy-fancybox') . '<br />'
					),
				'autoScale' => array (
						'noquotes' => true,
						'default' => 'false'
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
				'easingIn' => array (
						'default' => 'swing'
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
								'float' => __('Float','easy-fancybox'), // same as 'float'
								'outside' => __('Outside','easy-fancybox'),
								'inside' => __('Inside','easy-fancybox')
								//,'over' => __('Overlay','easy-fancybox')
							),
						'default' => 'float',
					),
				'titleFromAlt' => array (
						'id' => 'fancybox_VimeotitleFromAlt',
						'input' => 'checkbox',
						'default' => '',
						'description' => __('Allow title from thumbnail alt tag','easy-fancybox')
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
				'easingIn' => array (
						'default' => 'swing'
					),
				'swf' => array (
						'noquotes' => true,
						'default' => '{\'wmode\':\'opaque\',\'allowfullscreen\':true}'
					),
				'onStart' => array ( 
						'noquotes' => true,
						'default' => 'function(selectedArray, selectedIndex, selectedOpts) { selectedOpts.href = selectedArray[selectedIndex].href.replace(new RegExp(\'/([0-9])\', \'i\'), \'/moogaloop.swf?clip_id=$1\') }'
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
				'enable' => array (
						'id' => 'fancybox_enableiFrame',
						'input' => 'checkbox',
						'hide' => true,
						'default' => '',
						'description' => '<strong>' . __('Enable FancyBox for','easy-fancybox') . ' ' . __('iFrames','easy-fancybox') . '</strong>' 
					),
				'class' => array (
						'hide' => true,
						'default' => 'fancybox-iframe, li.fancybox-iframe a'
					),
				'intro' => array (
						'hide' => true,
						'description' => __('To make a website or HTML document open in an overlay, use the tag class="fancybox-iframe" or class="fancybox iframe" for its link.','easy-fancybox') . ' ' . __('Adjust its specific settings below.','easy-fancybox') . '<br /><br />'
					),
				'type' => array (
						'default' => 'iframe'
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
						'id' => 'fancybox_iFramepadding',
						'title' => __('Border'),
						'label_for' => 'fancybox_iFramepadding',
						'input' => 'text',
						'class' => 'small-text',
						'default' => '0',
						'description' => '<br />' . __('Width and height can be relative (%) or absolute sizes.','easy-fancybox') . ' ' . __('Set Border 0 to remove it.','easy-fancybox') . '<br />'
					),
				'scrolling' => array (
						'default' => 'auto'
					),
				'autoScale' => array (
						'noquotes' => true,
						'default' => 'false'
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
								'float' => __('Float','easy-fancybox'), // same as 'float'
								'outside' => __('Outside','easy-fancybox'),
								'inside' => __('Inside','easy-fancybox')
								//,'over' => __('Overlay','easy-fancybox')
							),
						'default' => 'float',
					),
				'titleFromAlt' => array (
						'id' => 'fancybox_iFrametitleFromAlt',
						'input' => 'checkbox',
						'default' => '',
						'description' => __('Allow title from thumbnail alt tag','easy-fancybox')
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
				'easingIn' => array (
						'default' => 'swing'
					)
				)
			)
			
		);
}

function easy_fancybox() {
	$easy_fancybox_array = easy_fancybox_settings();
	
	echo "
<!-- Easy FancyBox plugin for WordPress using FancyBox ".FANCYBOX_VERSION." - RavanH (http://4visions.nl/en/wordpress-plugins/easy-fancybox/) -->";

	// check for any enabled sections
	$do_fancybox = false;
	foreach ($easy_fancybox_array as $value) {
		if ( '1' == get_option($value['options']['enable']['id'],$value['options']['enable']['default']) ) {
			$do_fancybox = true;
			break;
		}
	}
	if (!$do_fancybox) {
	echo "
<!-- No sections enabled under Settings > Media > FancyBox -->

";
		return;
	}
	
	// begin output FancyBox settings
	echo "
<script type=\"text/javascript\">
jQuery(document).ready(function($){";

	/*
	 * Global settings routine
	 */
	$more=0;
	echo '
var fb_opts = {';
	foreach ($easy_fancybox_array['Global']['options'] as $_key => $_values) {
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
		} else {
			$$_key = $parm;
		}
	}
	echo ' };';
	
	foreach ($easy_fancybox_array as $key => $value) {
		// check if not enabled or hide=true then skip
		if ( !get_option($value['options']['enable']['id'], $value['options']['enable']['default']) || $value['hide'] )
			continue;

		echo '
/* ' . $key . ' */';
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
$(fb_'.$key.'_selector)'.$attributeLimit.'.addClass(\''.$value['options']['class']['default'].'\').attr(\'rel\', \'gallery\');';
				} else {
					echo '
var fb_'.$key.'_posts = jQuery(\'div.post\');
fb_'.$key.'_posts.each(function() { jQuery(this).find(fb_'.$key.'_selector)'.$attributeLimit.'.addClass(\''.$value['options']['class']['default'].'\').attr(\'rel\', \'gallery-\' + fb_'.$key.'_posts.index(this)); });';
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
$(\'a.'.$value['options']['class']['default'].'\')'.$attributeLimit.'.fancybox( $.extend(fb_opts, {';
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
	echo '<a href="https://www.paypal.com/cgi-bin/webscr?cmd=_donations&business=ravanhagen%40gmail%2ecom&item_name=Easy%20FancyBox&item_number=&no_shipping=0&tax=0&bn=PP%2dDonationsBF&charset=UTF%2d8&lc=us" title="'.__('Donate to Easy FancyBox plugin development with PayPal - it\'s fast, free and secure!','easy-fancybox').'"><img src="https://www.paypal.com/en_US/i/btn/x-click-but7.gif" style="border:none;float:right;margin:0 0 10px 10px" alt="'.__('Donate to Easy FancyBox plugin development with PayPal - it\'s fast, free and secure!','easy-fancybox').'" width="72" height="29" /></a><p>'.__('The options in this section are provided by the plugin <strong><a href="http://4visions.nl/en/wordpress-plugins/easy-fancybox/">Easy FancyBox</a></strong> and determine the <strong>Media Lightbox</strong> overlay appearance and behaviour controlled by <strong><a href="http://fancybox.net/">FancyBox</a></strong>.','easy-fancybox').' '.__('First adjust the <strong>Global settings</strong>, then enable each of the other sub-sections that you need and adjust its specific settings.','easy-fancybox').'</p><p>'.__('Note: Each additional sub-section and features like <em>Auto-detection</em>, <em>Elastic transitions</em> and all <em>Easing effects</em> (except Swing) will have some extra impact on client-side page speed. Enable only those sub-sections and options that you actually need on your site.','easy-fancybox').' '.__('Some setting for Title Position and Transition are unavailable for swf, video, pdf and iframe content to ensure browser compatibility and readability.','easy-fancybox').'</p>';
}

// FancyBox Media Settings Fields
function easy_fancybox_settings_fields($args){
	switch($args['input']) {
		case 'multiple':
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
	$easy_fancybox_array = easy_fancybox_settings();
	
	// check for any enabled sections plus the need for easing script
	$do_fancybox = false;
	$easing = false;
	foreach ($easy_fancybox_array as $value) {
		// anything enabled?
		if ( '1' == get_option($value['options']['enable']['id'],$value['options']['enable']['default']) )
			$do_fancybox = true;
		// easing anyone?
		if ( ( 'elastic' == get_option($value['options']['transitionIn']['id'],$value['options']['transitionIn']['default']) || 'elastic' == get_option($value['options']['transitionOut']['id'],$value['options']['transitionOut']['default']) ) && ( '' != get_option($value['options']['easingIn']['id'],$value['options']['easingIn']['default']) || '' != get_option($value['options']['easingOut']['id'],$value['options']['easingOut']['default']) ) )
			$easing = true;
	}
	if (!$do_fancybox) 
		return;

	// ENQUEUE
	// register main fancybox script
	wp_enqueue_script('jquery.fancybox', plugins_url(FANCYBOX_SUBDIR.'/fancybox/jquery.fancybox-'.FANCYBOX_VERSION.'.pack.js', __FILE__), array('jquery'), FANCYBOX_VERSION);
	
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
		wp_enqueue_script('jquery.easing', plugins_url(FANCYBOX_SUBDIR.'/fancybox/jquery.easing-'.EASING_VERSION.'.pack.js', __FILE__), array('jquery'), EASING_VERSION);
	}
	
	// first get rid of previously registered variants of jquery.mousewheel (by other plugins)
	wp_deregister_script('jquery.mousewheel');
	wp_deregister_script('jquerymousewheel');
	wp_deregister_script('jquery-mousewheel');
	wp_deregister_script('mousewheel');
	// then register our version
	wp_enqueue_script('jquery.mousewheel', plugins_url(FANCYBOX_SUBDIR.'/fancybox/jquery.mousewheel-'.MOUSEWHEEL_VERSION.'.pack.js', __FILE__), array('jquery'), MOUSEWHEEL_VERSION);
	
	// register style
	wp_enqueue_style('easy-fancybox.css', plugins_url(FANCYBOX_SUBDIR.'/easy-fancybox.css.php', __FILE__), false, FANCYBOX_VERSION, 'screen');

}

// Hack to fix missing wmode in (auto)embed code based on Crantea Mihaita's work-around on
// http://www.mehigh.biz/wordpress/adding-wmode-transparent-to-wordpress-3-media-embeds.html
if(!function_exists('add_video_wmode_opaque')) {
 function add_video_wmode_opaque($html, $url, $attr) {
   if (strpos($html, "<embed src=" ) !== false) {
    	$html = str_replace('</param><embed', '</param><param name="wmode" value="opaque"></param><embed wmode="opaque" ', $html);
   		return $html;
   } else {
        return $html;
   }
 }
}

// HOOKS //

add_filter('embed_oembed_html', 'add_video_wmode_opaque', 10, 3);

add_action('wp_enqueue_scripts', 'easy_fancybox_enqueue', 999);
add_action('wp_head', 'easy_fancybox');

add_action('admin_init','easy_fancybox_admin_init');

