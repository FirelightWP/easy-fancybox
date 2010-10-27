<?php
/*
Plugin Name: Easy FancyBox
Plugin URI: http://4visions.nl/en/wordpress-plugins/easy-fancybox/
Description: Hassle-free, no-settings, auto-enable <a href="http://fancybox.net/">FancyBox 1.3.1</a> on all image links including BMP, GIF, JPG, JPEG, and PNG. Uses packed Javascript. Happy with it? Please leave me a small <a href="https://www.paypal.com/cgi-bin/webscr?cmd=_donations&business=ravanhagen%40gmail%2ecom&item_name=Easy%20FancyBox&amp;item_number=1%2e3%2e1&no_shipping=0&tax=0&bn=PP%2dDonationsBF&charset=UTF%2d8&lc=us">TIP</a> for development and support on this plugin and please consider a DONATION to the <a href="http://fancybox.net/">FancyBox project</a>.
Version: 1.3.1.3
Author: RavanH
Author URI: http://4visions.nl/
*/

// FUNCTIONS //

function easy_fancybox_settings(){
	return array(
		'autoAttribute' => array (
			'id' => 'fancybox_autoAttribute',
			'title' => __('Auto-enable','easy-fancybox'),
			'label_for' => 'fancybox_autoAttribute',
			'input' => 'text',
			'options' => array(),
			'hide' => 'true',
			'default' => 'jpg bmp gif jpeg png swf',
			'description' => __('File types FancyBox should be automatically enabled for. Clear to switch off auto-enabling. Use the tags class="fancybox", class="fancybox-iframe" or class="fancybox-swf" on any link to manually enable FancyBox for it.','easy-fancybox').' '.__('Default:','easy-fancybox')
			),
		'titlePosition' => array (
			'id' => 'fancybox_titlePosition',
			'title' => __('Title Position','easy-fancybox'),
			'label_for' => 'fancybox_titlePosition',
			'input' => 'select',
			'options' => array(
				'over' => __('Overlay','easy-fancybox'),
				'inside' => __('Inside','easy-fancybox'),
				'outside' => __('Outside','easy-fancybox')
				),
			'default' => 'over',
			'description' => __('Position of the overlay content title.','easy-fancybox').' '.__('Default:','easy-fancybox')
			),
		'transitionIn' => array (
			'id' => 'fancybox_transitionIn',
			'title' => __('Transition In','easy-fancybox'),
			'label_for' => 'fancybox_transitionIn',
			'input' => 'select',
			'options' => array(
				'elastic' => __('Elastic','easy-fancybox'),
				'fade' => __('Fade in','easy-fancybox'),
				'none' => __('None','easy-fancybox')
				),
			'default' => 'elastic',
			'description' => __('Transition effect when opening the overlay.','easy-fancybox').' '.__('Default:','easy-fancybox')
			),
		'transitionOut' => array (
			'id' => 'fancybox_transitionOut',
			'title' => __('Transition Out','easy-fancybox'),
			'label_for' => 'fancybox_transitionOut',
			'input' => 'select',
			'options' => array(
				'elastic' => __('Elastic','easy-fancybox'),
				'fade' => __('Fade out','easy-fancybox'),
				'none' => __('None','easy-fancybox')
				),
			'default' => 'elastic',
			'description' => __('Transition effect when closing the overlay.','easy-fancybox').' '.__('Default:','easy-fancybox')
			),
		);
}

// What about other things than link with img, like: div[rel$="fancybox"] ?
function easy_fancybox() {
	$easy_fancybox_array = easy_fancybox_settings();
	echo "
<!-- Easy FancyBox plugin for WordPress - RavanH (http://4visions.nl/en/wordpress-plugins/easy-fancybox/) -->
<script type=\"text/javascript\">
jQuery(document).ready(function($){";
	
	$file_types = array_filter( explode( ' ', get_option( 'fancybox_autoAttribute', $easy_fancybox_array['autoAttribute']['default']) ) );
	if(!empty($file_types)) {
		echo "
	$('";
		foreach ($file_types as $type)
			echo 'a[href$=".'.$type.'"],a[href$=".'.strtoupper($type).'"],';
		echo "')
		.attr('rel', 'gallery')
		.addClass('fancybox');";
	}
	echo "
	$('a.fancybox').fancybox({";
	foreach ($easy_fancybox_array as $key => $values)
		if('true'!=$values['hide'])
			echo "
		'".$key."'	: '".get_option($values['id'], $values['default'])."',";
	
	if( "over" == get_option("fancybox_titlePosition", $easy_fancybox_array['titlePosition']['default']) )
		echo"
		'onComplete'	: function() {
			$('#fancybox-wrap').hover(function() {
				$('#fancybox-title').show();
			}, function() {
				$('#fancybox-title').hide();
			});
		},";
	echo"
	});
	$('a.fancybox-iframe').fancybox({
			'type'		: 'iframe',
			'padding'	: 0,
			'autoScale'	: false,
			'transitionIn'	: 'none',
			'transitionOut'	: 'none',
			'width'		: '80%',
			'height'	: '90%',
	});
	$('a.fancybox-swf').click(function(){
		$.fancybox({
			'type'		: 'swf',
			'padding'	: 0,
			'autoScale'	: false,
			'transitionIn'	: 'none',
			'transitionOut'	: 'none',
			'title'		: this.title,
			'width'		: 680,
			'height'	: 495,
			'href'		: this.href.replace(new RegExp('watch\\\?v=', 'i'), 'v/'),
			'swf'		: {
			   	'wmode'			: 'transparent',
				'allowfullscreen'	: 'true'
			}
		});
		return false;
	});
});
</script>
";
}

// FancyBox Media Settings Section on Settings > Media admin page
function easy_fancybox_settings_section() {
	echo '<a href="https://www.paypal.com/cgi-bin/webscr?cmd=_donations&business=ravanhagen%40gmail%2ecom&item_name=Easy%20FancyBox&item_number=&no_shipping=0&tax=0&bn=PP%2dDonationsBF&charset=UTF%2d8&lc=us" title="'.__('Donate to Easy FancyBox plugin development with PayPal - it\'s fast, free and secure!','easy-fancybox').'"><img src="https://www.paypal.com/en_US/i/btn/x-click-but7.gif" style="border:none; vertical-align:text-bottom;float:right" alt="'.__('Donate to Easy FancyBox plugin development with PayPal - it\'s fast, free and secure!','easy-fancybox').'" /></a><p>'.__('The settings listed below determine the image overlay behaviour controlled by FancyBox.','easy-fancybox').'</p>';
}
// FancyBox Media Settings Fields
function easy_fancybox_settings_fields($args){
	switch($args['input']) {
		case 'select':
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
				echo '<label for="'.$args['id'].'">'.$args['description'].' <em>'.$args['options'][$args['default']].'</em></label>';
			else
				echo $args['description'].' <em>'.$args['options'][$args['default']].'</em>';
			break;
		case 'text':
		default:
			echo '
			<input type="text" name="'.$args['id'].'" id="'.$args['id'].'" value="'.esc_attr( get_option($args['id'], $args['default']) ).'" class="large-text"><br />';
			if( empty($args['label_for']) )
				echo '<label for="'.$args['id'].'">'.$args['description'].' <em>'.$args['default'].'</em></label>';
			else
				echo $args['description'].' <em>'.$args['default'].'</em>';
			break;
			echo $args['description'];
	}
}


function easy_fancybox_admin_init(){
	load_plugin_textdomain('easy-fancybox', false, dirname(plugin_basename( __FILE__ )));

	add_settings_section('fancybox_section', __('FancyBox','easy-fancybox'), 'easy_fancybox_settings_section', 'media');
	
	$easy_fancybox_array = easy_fancybox_settings();
	foreach ($easy_fancybox_array as $key => $value) {
		add_settings_field( 'fancybox_'.$key, $value['title'], 'easy_fancybox_settings_fields', 'media', 'fancybox_section', $value);
		register_setting( 'media', 'fancybox_'.$key ); 
	}
}

function easy_fancybox_enqueue() {
	// check if fancy.php is moved one dir up like in WPMU's /mu-plugins/
	// NOTE: don't use WP_PLUGIN_URL to avoid problems when installed in /mu-plugins/
	$efb_subdir = (file_exists(dirname(__FILE__).'/easy-fancybox')) ? 'easy-fancybox' : '';

	// ENQUEUE
	// register main fancybox script
	wp_enqueue_script('jquery.fancybox', plugins_url($efb_subdir, __FILE__).'/jquery.fancybox.pack.js', array('jquery'), '1.3.1');
	
	if( "none" != get_option("fancybox_transitionIn") || "none" != get_option("fancybox_transitionOut") ) {
		// first get rid of previously registered variants of jquery.easing (by other plugins)
		wp_deregister_script('jquery.easing');
		wp_deregister_script('jqueryeasing');
		wp_deregister_script('jquery-easing');
		wp_deregister_script('easing');
		// then register our version
		wp_enqueue_script('jquery.easing', plugins_url($efb_subdir, __FILE__).'/jquery.easing.pack.js', array('jquery'), '1.3');
	}
	
	// first get rid of previously registered variants of jquery.mousewheel (by other plugins)
	wp_deregister_script('jquery.mousewheel');
	wp_deregister_script('jquerymousewheel');
	wp_deregister_script('jquery-mousewheel');
	wp_deregister_script('mousewheel');
	// then register our version
	wp_enqueue_script('jquery.mousewheel', plugins_url($efb_subdir, __FILE__).'/jquery.mousewheel.pack.js', array('jquery'), '3.0.2');
	
	// register style
	wp_enqueue_style('jquery.fancybox', plugins_url($efb_subdir, __FILE__).'/jquery.fancybox.css.php', false, '1.3.1');
}

// HOOKS //

add_action('wp_enqueue_scripts', 'easy_fancybox_enqueue', 999);
add_action('wp_head', 'easy_fancybox');

add_action('admin_init','easy_fancybox_admin_init');

