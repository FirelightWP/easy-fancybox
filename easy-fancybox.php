<?php
/*
Plugin Name: Easy FancyBox
Plugin URI: http://4visions.nl/en/wordpress-plugins/easy-fancybox/
Description: Easily enable the <a href="http://fancybox.net/">FancyBox jQuery extension</a> on all image, SWF, PDF, YouTube, Dailymotion and Vimeo links. Also supports iFrame and inline content.
Text Domain: easy-fancybox
Domain Path: languages
Version: 1.3.4.10dev7
Author: RavanH
Author URI: http://4visions.nl/
*/

// DEF

define( 'EASY_FANCYBOX_VERSION', '1.3.4.10' );
define( 'FANCYBOX_VERSION', '1.3.4' );
define( 'MOUSEWHEEL_VERSION', '3.0.6' );
define( 'EASING_VERSION', '1.3' );
define( 'METADATA_VERSION', '2.1' );

// Check if easy-fancybox.php is moved one dir up like in WPMU's /mu-plugins/
// or if plugins_url() returns the main plugins dir location as it does on 
// a Debian repository install.
// NOTE: WP_PLUGIN_URL causes problems when installed in /mu-plugins/
if(!stristr(plugins_url('', __FILE__),'/easy-fancybox'))
	define( 'FANCYBOX_SUBDIR', '/easy-fancybox' );
else
	define( 'FANCYBOX_SUBDIR', '' );

$easy_fancybox_array = array();

require_once(dirname(__FILE__) . FANCYBOX_SUBDIR . '/easy-fancybox-settings.php');

if( file_exists( dirname(dirname(__FILE__)) . '/easy-fancybox-pro.php' ) )
	include( dirname(dirname(__FILE__)) . '/easy-fancybox-pro.php' );


// FUNCTIONS //

function easy_fancybox() {
	global $easy_fancybox_array;
	
	echo '
<!-- Easy FancyBox ' . EASY_FANCYBOX_VERSION . ' using FancyBox ' . FANCYBOX_VERSION . ' - RavanH (http://4visions.nl/en/wordpress-plugins/easy-fancybox/) -->';

	// check for any enabled sections
	$do_fancybox = false;
	foreach ($easy_fancybox_array['Global']['options']['Enable']['options'] as $value) {
		// anything enabled?
		if ( isset($value['id']) && '1' == get_option($value['id'],$value['default']) ) {
			$do_fancybox = true;
			break;
		}
	}
	// and abort when none are active
	if (!$do_fancybox) {
		echo '
<!-- Nothing enabled under Settings > Media > FancyBox, please disable the plugin if you are not using it -->

';
		return;
	}
	
	// begin output FancyBox settings
	echo '
<script type="text/javascript">
/* <![CDATA[ */
jQuery(document).bind(\'ready gform_post_render\',function(){
var fb_timeout = null;';

	/*
	 * Global settings routine
	 */
	$more=0;
	echo '
var fb_opts = {';
	foreach ($easy_fancybox_array['Global']['options'] as $globals) {
		foreach ($globals['options'] as $_key => $_value) {
			if (isset($_value['id']) || isset($_value['default'])) 
				$parm = (isset($_value['id']))? get_option($_value['id'], $_value['default']) : $_value['default'];
			else
				$parm = '';

			if( isset($_value['input']) && 'checkbox'==$_value['input'] )
				$parm = ( '1' == $parm ) ? 'true' : 'false';

			if( !isset($_value['hide']) && $parm!='' ) {
				$quote = (is_numeric($parm) || (isset($_value['noquotes']) && $_value['noquotes'] == true) ) ? '' : '\'';
				if ($more>0)
					echo ',';
				echo ' \''.$_key.'\' : ';
				echo $quote.$parm.$quote;
				$more++;
			} else {
				$$_key = $parm;
			}
		}
	}
	echo ' };';
	
	foreach ($easy_fancybox_array as $key => $value) {
		// check if not enabled or hide=true then skip
		if ( isset($value['hide']) || !get_option($easy_fancybox_array['Global']['options']['Enable']['options'][$key]['id'], $easy_fancybox_array['Global']['options']['Enable']['options'][$key]['default']) )
			continue;

		echo '
/* ' . $key . ' */';
		/*
		 * Auto-detection routines (2x)
		 */
		$autoAttribute = (isset($value['options']['autoAttribute'])) ? get_option( $value['options']['autoAttribute']['id'], $value['options']['autoAttribute']['default'] ) : "";
		// update from previous version:
		if($attributeLimit == '.not(\':empty\')')
			$attributeLimit = ':not(:empty)';
		elseif($attributeLimit == '.has(\'img\')')
			$attributeLimit = ':has(img)';
		
		if(!empty($autoAttribute)) {
			if(is_numeric($autoAttribute)) {
				echo '
jQuery(\'a['.$value['options']['autoAttribute']['selector'].']:not(.nofancybox)'.$attributeLimit.'\')';
				if ($value['options']['autoAttribute']['href-replace'])
					echo '.attr(\'href\', function(index, attr){'.$value['options']['autoAttribute']['href-replace'].'})';
				echo '.addClass(\''.$value['options']['class']['default'].'\');';
			} else {
				// set selectors
				$file_types = array_filter( explode( ' ', str_replace( ',', ' ', $autoAttribute ) ) );
				$more=0;
				echo '
var fb_'.$key.'_select = \'';
				foreach ($file_types as $type) {
					if ($type == "jpg" || $type == "jpeg" || $type == "png" || $type == "gif")
						$type = '.'.$type;
					if ($more>0)
						echo ',';
					echo 'a['.$value['options']['autoAttribute']['selector'].'"'.$type.'"]:not(.nofancybox)'.$attributeLimit;
					$more++;
				}
				echo '\';';

				// class and rel depending on settings
				if( '1' == get_option($value['options']['autoAttributeLimit']['id'],$value['options']['autoAttributeLimit']['default']) ) {
					// add class
					echo '
var fb_'.$key.'_sections = jQuery(\''.get_option($value['options']['autoSelector']['id'],$value['options']['autoSelector']['default']).'\');
fb_'.$key.'_sections.each(function() { jQuery(this).find(fb_'.$key.'_select).addClass(\''.$value['options']['class']['default'].'\')';
					// and set rel
					switch( get_option($value['options']['autoGallery']['id'],$value['options']['autoGallery']['default']) ) {
						case '':
						default :
							echo '; });';
							break;
						case '1':
							echo '.attr(\'rel\', \'gallery-\' + fb_'.$key.'_sections.index(this)); });';
							break;
						case '2':
							echo '.attr(\'rel\', \'gallery\'); });';
					}
				} else {
					// add class
					echo '
jQuery(fb_'.$key.'_select).addClass(\''.$value['options']['class']['default'].'\')';
					// set rel
					switch( get_option($value['options']['autoGallery']['id'],$value['options']['autoGallery']['default']) ) {
						case '':
						default :
							echo ';';
							break;
						case '1':
							echo ';
var fb_'.$key.'_sections = jQuery(\''.get_option($value['options']['autoSelector']['id'],$value['options']['autoSelector']['default']).'\');
fb_'.$key.'_sections.each(function() { jQuery(this).find(fb_'.$key.'_select).attr(\'rel\', \'gallery-\' + fb_'.$key.'_sections.index(this)); });';
							break;
						case '2':
							echo '.attr(\'rel\', \'gallery\');';
					}
				}
				
			}
		}
		
		$autoAttributeAlt = ( isset($value['options']['autoAttributeAlt']) ) ? get_option( $value['options']['autoAttributeAlt']['id'], $value['options']['autoAttributeAlt']['default'] ) : "";
		if(!empty($autoAttributeAlt) && is_numeric($autoAttributeAlt)) {
			echo '
jQuery(\'a['.$value['options']['autoAttributeAlt']['selector'].']:not(.nofancybox)'.$attributeLimit.'\')';
			if ($value['options']['autoAttributeAlt']['href-replace'])
				echo '.attr(\'href\', function(index, attr){'.$value['options']['autoAttributeAlt']['href-replace']. '})';
			echo '.addClass(\''.$value['options']['class']['default'].'\');';
		}
		
		/*
		 * Generate .fancybox() bind
		 */
		$trigger='';
		if( $key == $autoClick )
			$trigger = '.filter(\':first\').trigger(\'click\')';

		echo '
jQuery(\'';
		$tags = array_filter( explode( ',' , $value['options']['tag']['default'] ));
		$more=0;
		foreach ($tags as $_tag) {
			if ($more>0)
				echo ', ';
			$_tagarray = explode( ' ' , trim($_tag) );
			echo $_tagarray[0].'.'.$value['options']['class']['default'];
			if (isset($_tagarray[1]))
				echo ' ' . $_tagarray[1];
			$more++;
		}
		echo '\').fancybox( jQuery.extend({}, fb_opts, {';
		$more=0;
		foreach ($value['options'] as $_key => $_value) {
			if (isset($_value['id']) || isset($_value['default'])) 
				$parm = (isset($_value['id']))? get_option($_value['id'], $_value['default']) : $_value['default'];
			else
				$parm = '';
			
			if( isset($_value['input']) && 'checkbox'==$_value['input'] )
				$parm = ( '1' == $parm ) ? 'true' : 'false';

			if( !isset($_value['hide']) && $parm!='' ) {
				$quote = (is_numeric($parm) || (isset($_value['noquotes']) && $_value['noquotes'] == true) ) ? '' : '\'';
				if ($more>0)
					echo ',';
				echo ' \''.$_key.'\' : ';
				echo $quote.$parm.$quote;
				$more++;
			}
		}
		echo ' }) )'.$trigger.';';

	}

	switch( $autoClick ) {
		case '':
		default :
			break;
		case '1':
			echo '
/* Auto-click */ 
jQuery(\'#fancybox-auto\').trigger(\'click\');';
			break;
		case '99':
			echo '
/* Auto-load */ 
jQuery(\'a[class*="fancybox"]\').filter(\':first\').trigger(\'click\');';
			break;
	}
	echo '
});
/* ]]> */
</script>
<style type="text/css">#page #branding{z-index:999}.fancybox-hidden{display:none}.rtl #fancybox-left{left:auto;right:0px}.rtl #fancybox-right{left:0px;right:auto}.rtl #fancybox-right-ico{background-position:-40px -30px}.rtl #fancybox-left-ico{background-position:-40px -60px}.rtl .fancybox-title-over{text-align:right}.rtl #fancybox-left-ico,.rtl #fancybox-right-ico{right:-9999px}.rtl #fancybox-right:hover span{right:auto;left:20px}.rtl #fancybox-left:hover span{right:20px}';

	if ('1' == $overlaySpotlight)
		echo '#fancybox-overlay{background-image:url("'. plugins_url(FANCYBOX_SUBDIR.'/light-mask.png', __FILE__) . '");background-position:50% -3%;background-repeat:no-repeat;-o-background-size:100%;-webkit-background-size:100%;-moz-background-size:100%;-khtml-background-size:100%;background-size:100%;position:fixed}';
	if ('' != $backgroundColor)
		echo '#fancybox-outer{background-color:'.$backgroundColor.'}';
	if ('' != $paddingColor)
		echo '#fancybox-content{border-color:'.$paddingColor.'}';
	if ('' != $textColor)
		echo '#fancybox-content{color:'.$textColor.'}';
	if ('' != $frameOpacity) {
		$frameOpacity_percent = (int)$frameOpacity*100;
		echo '#fancybox-outer{filter:alpha(opacity='.$frameOpacity_percent.');-moz-opacity:'.$frameOpacity.';opacity:'.$frameOpacity.'}';
	}
echo '</style>
';

}

// add our FancyBox Media Settings Section on Settings > Media admin page
function easy_fancybox_settings_section() {
	echo '<p><a href="https://www.paypal.com/cgi-bin/webscr?cmd=_donations&business=ravanhagen%40gmail%2ecom&item_name=Easy%20FancyBox&item_number='.EASY_FANCYBOX_VERSION.'&no_shipping=0&tax=0&charset=UTF%2d8" title="'.__('Donate to Easy FancyBox plugin development with PayPal - it\'s fast, free and secure!','easy-fancybox').'"><img src="https://www.paypalobjects.com/en_US/i/btn/btn_donate_LG.gif" style="border:none;float:left;margin:5px 10px 0 0" alt="'.__('Donate to Easy FancyBox plugin development with PayPal - it\'s fast, free and secure!','easy-fancybox').'" width="92" height="26" /></a>'.__('The options in this section are provided by the plugin <strong><a href="http://4visions.nl/wordpress-plugins/easy-fancybox/">Easy FancyBox</a></strong> and determine the <strong>Media Lightbox</strong> overlay appearance and behaviour controlled by <strong><a href="http://fancybox.net/">FancyBox</a></strong>.','easy-fancybox').' '.__('First enable each sub-section that you need. Then save and come back to adjust its specific settings.','easy-fancybox').'</p><p>'.__('Note: Each additional sub-section and features like <em>Auto-detection</em>, <em>Elastic transitions</em> and all <em>Easing effects</em> (except Swing) will have some extra impact on client-side page speed. Enable only those sub-sections and options that you actually need on your site.','easy-fancybox').' '.__('Some setting like Transition options are unavailable for SWF video, PDF and iFrame content to ensure browser compatibility and readability.','easy-fancybox').'</p>';
}

// add our FancyBox Media Settings Fields
function easy_fancybox_settings_fields($args){
	$disabled = ('disabled' == $args['status']) ? ' disabled="disabled"' : '';
	switch($args['input']) {
		case 'multiple':
		case 'deep':
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
				<option value="'.esc_attr($optionkey).'"'.$selected.' '.$disabled.' >'.$optionvalue.'</option>';
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
			<label><input type="checkbox" name="'.$args['id'].'" id="'.$args['id'].'" value="1" '.$checked.' '.$disabled.' /> '.$args['description'].'</label><br />';
			else
				echo '
			<input type="checkbox" name="'.$args['id'].'" id="'.$args['id'].'" value="1" '.$checked.' '.$disabled.' /> '.$args['description'].'<br />';
			break;
		case 'text':
			if( !empty($args['label_for']) )
				echo '<label for="'.$args['label_for'].'">'.$args['title'].'</label> ';
			else
				echo $args['title'];
			echo '
			<input type="text" name="'.$args['id'].'" id="'.$args['id'].'" value="'.esc_attr( get_option($args['id'], $args['default']) ).'" class="'.$args['class'].'"'.$disabled.' /> ';
			if( empty($args['label_for']) )
				echo '<label for="'.$args['id'].'">'.$args['description'].'</label> ';
			else
				echo $args['description'];
			break;
		case 'hidden':
			echo '
			<input type="hidden" name="'.$args['id'].'" id="'.$args['id'].'" value="'.esc_attr( get_option($args['id'], $args['default']) ).'" /> ';
			break;
		default:
			echo $args['description'];
	}
}


function easy_fancybox_register_settings($args){
	global $easy_fancybox_array;
	foreach ($args as $key => $value) {
		// check to see if the section is enabled, else skip to next
		if ( array_key_exists($key, $easy_fancybox_array['Global']['options']['Enable']['options']) && !get_option($easy_fancybox_array['Global']['options']['Enable']['options'][$key]['id'], $easy_fancybox_array['Global']['options']['Enable']['options'][$key]['default']) )
			continue;
			
		switch($value['input']) {
			case 'deep':
				// go deeper by looping back on itself 
				easy_fancybox_register_settings($value['options']);
				break;
			case 'multiple':
				add_settings_field( 'fancybox_'.$key, $value['title'], 'easy_fancybox_settings_fields', 'media', 'fancybox_section', $value);
				foreach ( $value['options'] as $_value ) {
					if ( !isset($_value['sanitize_callback']) )
						$_value['sanitize_callback'] = '';
					if ( isset($_value['id']) )
						register_setting( 'media', $_value['id'], $_value['sanitize_callback'] );
				}
				break;
			default:
				if ( !isset($value['sanitize_callback']) )
					$value['sanitize_callback'] = '';
				if ( isset($value['id']) )
					register_setting( 'media', 'fancybox_'.$key, $value['sanitize_callback'] );
		}
	}
}

function easy_fancybox_intval($setting = '') {
	if ($setting == '')
		return '';
	
	if (substr($setting, -1) == '%') {
		$val = intval(substr($setting, 0, -1));
		$prc = '%';
	} else {
		$val = intval($setting);
	}
	
	return ( $val != 0 ) ? $val.$prc : 0;
}

function easy_fancybox_array_merge_recursive_simple() {
     // slightly adapted version of custom array_merge_recursive function
     // on http://www.php.net/manual/en/function.array-merge-recursive.php#104145
     if (func_num_args() < 2) {
         trigger_error(__FUNCTION__ .' needs two or more array arguments', E_USER_WARNING);
         return;
     }
     $arrays = func_get_args();
     $merged = array();
     while ($arrays) {
         $array = array_shift($arrays);
         if (!is_array($array)) {
             trigger_error(__FUNCTION__ .' encountered a non array argument', E_USER_WARNING);
             return;
         }
         if (!$array)
             continue;
         foreach ($array as $key => $value)
           //if (is_string($key))
             if (is_array($value) && array_key_exists($key, $merged) && is_array($merged[$key]))
                 $merged[$key] = call_user_func(__FUNCTION__, $merged[$key], $value);
             else
                 $merged[$key] = $value;
           //else
           //    $merged[] = $value;
     }
     return $merged;
}

function easy_fancybox_init(){
	global $easy_fancybox_array;

	if ( is_admin() ) {
		// text domain must be in init even if it is for admin only
		load_plugin_textdomain('easy-fancybox', false, dirname(plugin_basename( __FILE__ )) . '/languages' );
	}

	// TODO figure what is better: load defaults each time or fill DB with defaults on activation or when options are not found (for network wide activation / WPMU compatibility) ?
	if( function_exists('easy_fancybox_pro_settings') )
		$easy_fancybox_array = easy_fancybox_array_merge_recursive_simple( 
			easy_fancybox_settings(), 
			easy_fancybox_pro_settings() 
			);
	else
		$easy_fancybox_array = easy_fancybox_settings();
}

function easy_fancybox_admin_init(){
	global $easy_fancybox_array;
	
	add_settings_section('fancybox_section', __('FancyBox','easy-fancybox'), 'easy_fancybox_settings_section', 'media');

	easy_fancybox_register_settings($easy_fancybox_array);
	
	add_filter('plugin_action_links_' . plugin_basename(__FILE__), 'easy_fancybox_add_action_link');

}

/**
 * Adds an action link to the Plugins page
 */
function easy_fancybox_add_action_link( $links ) {
	$settings_link = '<a href="' . admin_url('options-media.php') . '">' . __('Settings') . '</a>';
	array_unshift( $links, $settings_link ); 
	return $links;
}

function easy_fancybox_enqueue_scripts() {
	global $easy_fancybox_array;
	
	// check for any enabled sections plus the need for easing script
	$do_fancybox = false;
	$easing = false;

	foreach ($easy_fancybox_array['Global']['options']['Enable']['options'] as $value) {
		// anything enabled?
		if ( isset($value['id']) && '1' == get_option($value['id'],$value['default']) ) {
			$do_fancybox = true;
			break;
		}
	} // TODO: combine this function with the one in easy_fancybox() ... (as class global value later) 
	
	// break off if there is no need for any script files
	if (!$do_fancybox) 
		return;

	// ENQUEUE
	// first get rid of previously registered variants of jquery.fancybox by other plugins or theme
	wp_deregister_script('jquery.fancybox');
	wp_deregister_script('fancybox');
	wp_deregister_script('jquery-fancybox');
	// register main fancybox script
	wp_enqueue_script('jquery-fancybox', plugins_url(FANCYBOX_SUBDIR.'/fancybox/jquery.fancybox-'.FANCYBOX_VERSION.'.pack.js', __FILE__), array('jquery'), FANCYBOX_VERSION, true);
	
	// easing in IMG settings?
	if ( ( '' == get_option($easy_fancybox_array['IMG']['options']['easingIn']['id'],$easy_fancybox_array['IMG']['options']['easingIn']['default']) || 'linear' == get_option($easy_fancybox_array['IMG']['options']['easingIn']['id'],$easy_fancybox_array['IMG']['options']['easingIn']['default']) ) && ( '' == get_option($easy_fancybox_array['IMG']['options']['easingOut']['id'],$easy_fancybox_array['IMG']['options']['easingOut']['default']) || 'linear' == get_option($easy_fancybox_array['IMG']['options']['easingOut']['id'],$easy_fancybox_array['IMG']['options']['easingOut']['default']) ) ) {
		// do nothing
	} else {
		if ( 'elastic' == get_option($easy_fancybox_array['IMG']['options']['transitionIn']['id'],$easy_fancybox_array['IMG']['options']['transitionIn']['default'])	|| 'elastic' == get_option($easy_fancybox_array['IMG']['options']['transitionOut']['id'],$easy_fancybox_array['IMG']['options']['transitionOut']['default']) ) {
			// first get rid of previously registered variants of jquery.easing by other plugins or theme
			wp_deregister_script('jquery.easing');
			wp_deregister_script('jqueryeasing');
			wp_deregister_script('jquery-easing');
			wp_deregister_script('easing');
			// then register our version
			wp_enqueue_script('jquery-easing', plugins_url(FANCYBOX_SUBDIR.'/fancybox/jquery.easing-'.EASING_VERSION.'.pack.js', __FILE__), array('jquery'), EASING_VERSION, true);
		}
	}
	
	// first get rid of previously registered variants of jquery.mousewheel (by other plugins)
	wp_deregister_script('jquery.mousewheel');
	wp_deregister_script('jquerymousewheel');
	wp_deregister_script('jquery-mousewheel');
	wp_deregister_script('mousewheel');
	// then register our version
	wp_enqueue_script('jquery-mousewheel', plugins_url(FANCYBOX_SUBDIR.'/jquery.mousewheel.pack.js', __FILE__), array('jquery'), MOUSEWHEEL_VERSION, true);
	
	// first get rid of previously registered variants of jquery.metadata (by other plugins)
	wp_deregister_script('jquery.metadata');
	wp_deregister_script('jquerymetadata');
	wp_deregister_script('jquery-metadata');
	wp_deregister_script('metadata');
	// then register our version
	wp_enqueue_script('jquery-metadata',plugins_url(FANCYBOX_SUBDIR.'/jquery.metadata.pack.js', __FILE__), array('jquery'), METADATA_VERSION, true);
}
	
function easy_fancybox_enqueue_styles() {
	// register style
	wp_enqueue_style('easy-fancybox-css', plugins_url(FANCYBOX_SUBDIR.'/easy-fancybox.css.php', __FILE__), false, FANCYBOX_VERSION, 'screen');
}

// Hack to fix missing wmode in Youtube oEmbed code based on David C's code in the comments on
// http://www.mehigh.biz/wordpress/adding-wmode-transparent-to-wordpress-3-media-embeds.html
// + own hack for dailymotion iframe embed...
if(!function_exists('add_video_wmode_opaque')) {
 function add_video_wmode_opaque($html, $url, $attr) {
 	if (strpos($html, "wmode" ) == false && strpos($html, "youtube" ) !== false) {
		$html = preg_replace('/feature=oembed/', '$0&wmode=opaque', $html);
		//$html = preg_replace('/(object|embed).*?height=\"\d+\"/', '$0 wmode="opaque"', $html);
 	}
 	return $html;
 }
}

// HOOKS //

add_action('admin_init','easy_fancybox_admin_init');
add_action('init','easy_fancybox_init');

add_filter('embed_oembed_html', 'add_video_wmode_opaque', 10, 3);
add_action('wp_print_styles', 'easy_fancybox_enqueue_styles', 999);
add_action('wp_enqueue_scripts', 'easy_fancybox_enqueue_scripts', 999);
add_action('wp_head', 'easy_fancybox');

