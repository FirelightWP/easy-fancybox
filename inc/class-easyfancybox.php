<?php
/**
 * Easy FancyBox Class
 */
class easyFancyBox {

	private static $plugin_url;

	protected static $plugin_basename;

	public static $add_scripts = false;

	public static $options = array();

	/**********************
	   MAIN SCRIPT OUTPUT
	 **********************/

	public static function main_script() {

		if ( empty(self::$options) )
			easyFancyBox_Options::load_defaults();

		echo '
<!-- Easy FancyBox ' . EASY_FANCYBOX_VERSION . ' using FancyBox ' . FANCYBOX_VERSION . ' - RavanH (http://status301.net/wordpress-plugins/easy-fancybox/) -->';

		// check for any enabled sections
		foreach (self::$options['Global']['options']['Enable']['options'] as $value) {
			// anything enabled?
			if ( isset($value['id']) && '1' == get_option($value['id'],$value['default']) ) {
				self::$add_scripts = true;
				break;
			}
		}
		// and abort when none are active
		if (!self::$add_scripts) {
			echo '
<!-- Nothing enabled under Settings > Media > FancyBox. -->

	';
			return;
		}

		// begin output FancyBox settings
		echo '
<script type="text/javascript">
/* <![CDATA[ */
var fb_timeout = null;';

		/*
		 * Global settings routine
		 */
		$more=0;
		echo '
var fb_opts = {';
		foreach (self::$options['Global']['options'] as $globals) {
			foreach ($globals['options'] as $_key => $_value) {
				if ( isset($_value['id']) )
					if ( isset($_value['default']) )
						$parm = get_option($_value['id'], $_value['default']);
					else
						$parm = get_option($_value['id']);
				elseif ( isset($_value['default']) )
					$parm = $_value['default'];
				else
					$parm = '';

				if ( isset($_value['input']) && 'checkbox'==$_value['input'] )
					$parm = ( '1' == $parm ) ? 'true' : 'false';

				if( !isset($_value['hide']) && $parm!='' ) {
					$quote = (is_numeric($parm) || (isset($_value['noquotes']) && $_value['noquotes'] == true) ) ? '' : '\'';
					if ($more>0)
						echo ',';
					echo ' \''.$_key.'\' : ';
					echo $quote.$parm.$quote;
					$more++;
				} else {
					${$_key} = $parm;
				}
			}
		}
		echo ' };
var easy_fancybox_handler = function(){';

		foreach (self::$options as $key => $value) {
			// check if not enabled or hide=true then skip
			if ( isset($value['hide']) || !get_option(self::$options['Global']['options']['Enable']['options'][$key]['id'], self::$options['Global']['options']['Enable']['options'][$key]['default']) )
				continue;

			echo '
	/* ' . $key . ' */';
			/*
			 * Auto-detection routines (2x)
			 */
			$autoAttribute = (isset($value['options']['autoAttribute'])) ? get_option( $value['options']['autoAttribute']['id'], $value['options']['autoAttribute']['default'] ) : "";

			if(!empty($autoAttribute)) {
				if(is_numeric($autoAttribute)) {
					echo '
	jQuery(\''.$value['options']['autoAttribute']['selector'].'\').not(\'.nolightbox\').addClass(\''.$value['options']['class']['default'].'\');';
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
							echo ', ';
						echo 'a['.$value['options']['autoAttribute']['selector'].'"'.$type.'"]:not(.nolightbox,li.nolightbox>a), area['.$value['options']['autoAttribute']['selector'].'"'.$type.'"]:not(.nolightbox)';
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

			/*
			 * Generate .fancybox() bind
			 */

			// prepare auto popup
			if( $key == $autoClick )
				$trigger = $value['options']['class']['default'];

			echo '
	jQuery(\'' . $value['options']['tag']['default']. '\')';

			// use each() to allow different metadata values per instance; fix by Elron. Thanks!
			if ( '1' == get_option(self::$options['Global']['options']['Miscellaneous']['options']['metaData']['id'],self::$options['Global']['options']['Miscellaneous']['options']['metaData']['default']) )
				echo '.each(function() { jQuery(this)';

			echo '.fancybox( jQuery.extend({}, fb_opts, {';
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
			echo ' }) ';

			// use each() to allow different metadata values per instance; fix by Elron. Thanks!
			if ( '1' == get_option(self::$options['Global']['options']['Miscellaneous']['options']['metaData']['id'],self::$options['Global']['options']['Miscellaneous']['options']['metaData']['default']) )
				echo ');} ';

			echo ');';

		}

			echo '
}
var easy_fancybox_auto = function(){';

		if ( empty($delayClick) ) $delayClick = '0';

		switch( $autoClick ) {
			case '':
				break;
			case '1':
				echo '
	/* Auto-click */
	setTimeout(function(){jQuery(\'#fancybox-auto\').trigger(\'click\')},'.$delayClick.');';
				break;
			case '99':
				echo '
	/* Auto-click */
	setTimeout(function(){jQuery(\'a[class|="fancybox"]\').filter(\':first\').trigger(\'click\')},'.$delayClick.');';
				break;
			default :
				if ( !empty($trigger) ) echo '
	/* Auto-click */
	setTimeout(function(){jQuery(\'a[class*="'.$trigger.'"]\').filter(\':first\').trigger(\'click\')},'.$delayClick.');';
		}

		echo '
}
/* ]]> */
</script>
';

		// HEADER STYLES //

		// customized styles
		$styles = '';
		if (isset($overlaySpotlight) && 'true' == $overlaySpotlight)
			$styles .= '
#fancybox-overlay{background-attachment:fixed;background-image:url("' . self::$plugin_url . 'images/light-mask.png");background-position:center;background-repeat:no-repeat;background-size:100% 100%}';
		if (!empty($borderRadius))
			$styles .= '
#fancybox-outer,#fancybox-content{border-radius:'.$borderRadius.'px}.fancybox-title-inside{padding-top:'.$borderRadius.'px;margin-top:-'.$borderRadius.'px !important;border-radius: 0 0 '.$borderRadius.'px '.$borderRadius.'px}';
		if (!empty($backgroundColor))
			$styles .= '
#fancybox-content{background-color:'.$backgroundColor.'}';
		if (!empty($paddingColor))
			$styles .= '
#fancybox-content{border-color:'.$paddingColor.'}#fancybox-outer{background-color:'.$paddingColor.'}'; //.fancybox-title-inside{background-color:'.$paddingColor.';margin-left:0 !important;margin-right:0 !important;width:100% !important;}
		if (!empty($textColor))
			$styles .= '
#fancybox-content{color:'.$textColor.'}';
		if (!empty($titleColor))
			$styles .= '
#fancybox-title,#fancybox-title-float-main{color:'.$titleColor.'}';

		if ( !empty($styles) ) {
			echo '<style type="text/css">' . $styles . '
</style>
';
		}

		// running our IE alphaimageloader relative path styles here
		if ( isset($compatIE8) && 'true' == $compatIE8 ) {
			echo '<!--[if IE 8]>
<style type="text/css">
.fancybox-ie #fancybox-title-over{background-image:url(' . self::$plugin_url . 'fancybox/fancy_title_over.png); }
.fancybox-bg{position:absolute;padding:0;margin:0;border:0;width:20px;height:20px;z-index:111001;}
#fancybox-bg-n{top:-20px;left:0;width: 100%;}#fancybox-bg-ne{top:-20px;right:-20px;}#fancybox-bg-e{top:0;right:-20px;height:100%;}#fancybox-bg-se{bottom:-20px;right:-20px;}#fancybox-bg-s{bottom:-20px;left:0;width:100%;}#fancybox-bg-sw{bottom:-20px;left:-20px;}#fancybox-bg-w{top:0;left:-20px;height:100%;}#fancybox-bg-nw {top:-20px;left:-20px;}
.fancybox-ie .fancybox-bg{background:transparent !important;}
.fancybox-ie #fancybox-bg-n{filter:progid:DXImageTransform.Microsoft.AlphaImageLoader(src="' . self::$plugin_url . 'fancybox/fancy_shadow_n.png", sizingMethod="scale");}
.fancybox-ie #fancybox-bg-ne{filter:progid:DXImageTransform.Microsoft.AlphaImageLoader(src="' . self::$plugin_url . 'fancybox/fancy_shadow_ne.png", sizingMethod="scale");}
.fancybox-ie #fancybox-bg-e{filter:progid:DXImageTransform.Microsoft.AlphaImageLoader(src="' . self::$plugin_url . 'fancybox/fancy_shadow_e.png", sizingMethod="scale");}
.fancybox-ie #fancybox-bg-se{filter:progid:DXImageTransform.Microsoft.AlphaImageLoader(src="' . self::$plugin_url . 'fancybox/fancy_shadow_se.png", sizingMethod="scale");}
.fancybox-ie #fancybox-bg-s{filter:progid:DXImageTransform.Microsoft.AlphaImageLoader(src="' . self::$plugin_url . 'fancybox/fancy_shadow_s.png", sizingMethod="scale");}
.fancybox-ie #fancybox-bg-sw{filter:progid:DXImageTransform.Microsoft.AlphaImageLoader(src="' . self::$plugin_url . 'fancybox/fancy_shadow_sw.png", sizingMethod="scale");}
.fancybox-ie #fancybox-bg-w{filter:progid:DXImageTransform.Microsoft.AlphaImageLoader(src="' . self::$plugin_url . 'fancybox/fancy_shadow_w.png", sizingMethod="scale");}
.fancybox-ie #fancybox-bg-nw{filter:progid:DXImageTransform.Microsoft.AlphaImageLoader(src="' . self::$plugin_url . 'fancybox/fancy_shadow_nw.png", sizingMethod="scale");}';

		if (isset($overlaySpotlight) && 'true' == $overlaySpotlight)
			echo '
#fancybox-overlay{filter:progid:DXImageTransform.Microsoft.AlphaImageLoader(src="' . self::$plugin_url . 'images/light-mask.png",sizingMethod="scale");';

		echo '
</style>
<![endif]-->
';
		}


	}

	/***********************
	    ACTIONS & FILTERS
	 ***********************/

	public static function register_scripts() {

	    if ( is_admin() ) return;

		// ENQUEUE
		// first get rid of previously registered variants of jquery.fancybox by other plugins or theme
		wp_deregister_script('fancybox');
		wp_deregister_script('jquery.fancybox');
		wp_deregister_script('jquery_fancybox');
		wp_deregister_script('jquery-fancybox');
		// register main fancybox script
		if ( defined('WP_DEBUG') && true == WP_DEBUG )
			wp_register_script('jquery-fancybox', self::$plugin_url.'fancybox/jquery.fancybox-'.FANCYBOX_VERSION.'.js', array('jquery'), EASY_FANCYBOX_VERSION, true);
		else
			wp_register_script('jquery-fancybox', self::$plugin_url.'fancybox/jquery.fancybox-'.FANCYBOX_VERSION.'.min.js', array('jquery'), EASY_FANCYBOX_VERSION, true);

		// easing in IMG settings?
		if ( ( '' == get_option( self::$options['IMG']['options']['easingIn']['id'], self::$options['IMG']['options']['easingIn']['default']) || 'linear' == get_option( self::$options['IMG']['options']['easingIn']['id'], self::$options['IMG']['options']['easingIn']['default']) ) && ( '' == get_option( self::$options['IMG']['options']['easingOut']['id'], self::$options['IMG']['options']['easingOut']['default']) || 'linear' == get_option( self::$options['IMG']['options']['easingOut']['id'], self::$options['IMG']['options']['easingOut']['default']) ) ) {
			// do nothing
		} else {
			if ( 'elastic' == get_option( self::$options['IMG']['options']['transitionIn']['id'], self::$options['IMG']['options']['transitionIn']['default']) || 'elastic' == get_option( self::$options['IMG']['options']['transitionOut']['id'], self::$options['IMG']['options']['transitionOut']['default']) ) {
				wp_deregister_script('jquery-easing');
				wp_register_script('jquery-easing', self::$plugin_url.'js/jquery.easing.min.js', array('jquery'), EASING_VERSION, true);
			}
		}

		// mousewheel in IMG settings?
		if ( '1' == get_option( self::$options['IMG']['options']['mouseWheel']['id'], self::$options['IMG']['options']['mouseWheel']['default']) ) {
			wp_deregister_script('jquery-mousewheel');
			wp_register_script('jquery-mousewheel', self::$plugin_url.'js/jquery.mousewheel.min.js', array('jquery'), MOUSEWHEEL_VERSION, true);
		}

		// metadata in Miscellaneous settings?
		if ('1' == get_option( self::$options['Global']['options']['Miscellaneous']['options']['metaData']['id'], self::$options['Global']['options']['Miscellaneous']['options']['metaData']['default']) ) {
			wp_register_script('jquery-metadata',self::$plugin_url.'js/jquery.metadata.min.js', array('jquery'), METADATA_VERSION, true);
		}
	}

	public static function enqueue_styles() {
		// register style
		wp_dequeue_style('fancybox');
		if ( defined('WP_DEBUG') && true == WP_DEBUG )
			wp_enqueue_style('fancybox', self::$plugin_url.'fancybox/jquery.fancybox-'.FANCYBOX_VERSION.'.css', false, EASY_FANCYBOX_VERSION, 'screen');
		else
			wp_enqueue_style('fancybox', self::$plugin_url.'fancybox/jquery.fancybox-'.FANCYBOX_VERSION.'.min.css', false, EASY_FANCYBOX_VERSION, 'screen');
	}

	public static function enqueue_footer_scripts() {
		if (!self::$add_scripts)
			return;

		// FancyBox
		wp_enqueue_script('jquery-fancybox');

		// jQuery Easing, which is ot needed if jQueryUI Core Effects are loaded
		if ( !wp_script_is( 'jquery-effects-core', 'enqueued' ) )
			wp_enqueue_script('jquery-easing');

		// jQuery Mousewheel, which is ot needed if jQueryUI Mouse is loaded
		if ( !wp_script_is( 'jquery-ui-mouse', 'enqueued' ) )
			wp_enqueue_script('jquery-mousewheel');

		wp_enqueue_script('jquery-metadata');

	}

	public static function on_ready() {

		if (!self::$add_scripts) // abort mission, there is no need for any script files
			return;

		// 'gform_post_render' for gForms content triggers an error... Why?
		// 'post-load' is for Infinite Scroll by JetPack

		// first exclude some links by adding nolightbox class:
		// (1) nofancybox backwards compatibility and (2) tries to detect social sharing buttons with known issues
		echo '<script type="text/javascript">
jQuery(document).on(\'ready post-load\', function(){ jQuery(\'.nofancybox,a.pin-it-button,a[href*="pinterest.com/pin/create/button"]\').addClass(\'nolightbox\'); });';

		echo apply_filters( 'easy_fancybox_onready_handler', '
jQuery(document).on(\'ready post-load\',easy_fancybox_handler);' );

		echo apply_filters( 'easy_fancybox_onready_auto', '
jQuery(document).on(\'ready\',easy_fancybox_auto);' );

		echo '</script>
';
	}

	// Hack to fix missing wmode in Youtube oEmbed code based on David C's code in the comments on
	// http://www.mehigh.biz/wordpress/adding-wmode-transparent-to-wordpress-3-media-embeds.html
	public static function add_video_wmode_opaque($html, $url, $attr) {
		if (strpos($html, "<embed src=" ) !== false) {
			$html = str_replace('</param><embed', '</param><param name="wmode" value="opaque"></param><embed wmode="opaque"', $html);
		} elseif (strpos($html, 'youtube' ) !== false && strpos($html, 'wmode' ) == false ) {
			$html = str_replace('feature=oembed', 'feature=oembed&wmode=opaque', $html);
		} elseif ( strpos($html, "vimeo" ) !== false  && strpos($html, 'wmode' ) == false ) {
			$html = str_replace('" width', '?theme=none&wmode=opaque" width', $html);
		} elseif ( strpos($html, "dailymotion" ) !== false  && strpos($html, 'wmode' ) == false ) {
			$html = str_replace('" width', '?wmode=opaque" width', $html);
		}
		return $html;
	}

	public static function init() {
		easyFancyBox_Options::load_defaults();
		add_filter('embed_oembed_html', array(__CLASS__, 'add_video_wmode_opaque'), 10, 3);
	}

	public static function plugins_loaded(){
		if ( is_admin() ) {
			require_once dirname(__FILE__) . '/class-easyfancybox-admin.php';
			easyFancyBox_Admin::run();
		}
	}

	/**********************
	         RUN
	 **********************/

	public function __construct( $file ) {

		// VARS
		self::$plugin_url = plugins_url( '/', $file );
		self::$plugin_basename = plugin_basename( $file );

		require_once dirname(__FILE__) . '/class-easyfancybox-options.php';

		// HOOKS //
		add_action('plugins_loaded', array(__CLASS__, 'plugins_loaded'));

		add_action('init', array(__CLASS__, 'init'));
		add_action('wp_enqueue_scripts', array(__CLASS__, 'enqueue_styles'), 999);
		add_action('wp_head', array(__CLASS__, 'main_script'), 999);
		add_action('wp_print_scripts', array(__CLASS__, 'register_scripts'), 999);
		add_action('wp_footer', array(__CLASS__, 'enqueue_footer_scripts'));
		add_action('wp_footer', array(__CLASS__, 'on_ready'), 999);
	}

}
