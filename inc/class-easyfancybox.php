<?php
/**
 * Easy FancyBox Class
 */
class easyFancyBox {

	private static $plugin_url;

	protected static $plugin_basename;

	private static $inline_script;

	private static $inline_style;

	private static $inline_style_ie8;

	public static $onready_auto = false;

	public static $add_scripts = false;

	public static $options = array();

	public static $events = array( 'post-load' );

	/**********************
	   MAIN SCRIPT OUTPUT
	 **********************/

	public static function main() {

		if ( empty(self::$options) )
			return;

		// check for any enabled sections
		foreach ( self::$options['Global']['options']['Enable']['options'] as $value )
			if ( isset($value['id']) && '1' == get_option($value['id'],$value['default']) ) {
				self::$add_scripts = true;
				break;
			}

		// and abort when none are active
		if ( !self::$add_scripts )
			return;

		// begin building output FancyBox settings
		$script = '
var fb_timeout=null;';

		/*
		 * Global settings routine
		 */
		$more = 0;
		$script .= '
var fb_opts={';
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
						$script .= ',';
					$script .= '\''.$_key.'\':';
					$script .= $quote.$parm.$quote;
					$more++;
				} else {
					${$_key} = $parm;
				}
			}
		}

		$script .= ' };
if(typeof easy_fancybox_handler===\'undefined\'){
var easy_fancybox_handler=function(){
jQuery(\'.nofancybox,a.pin-it-button,a[href*="pinterest.com/pin/create"]\').addClass(\'nolightbox\');';

		foreach (self::$options as $key => $value) {
			// check if not enabled or hide=true then skip
			if ( isset($value['hide']) || !get_option(self::$options['Global']['options']['Enable']['options'][$key]['id'], self::$options['Global']['options']['Enable']['options'][$key]['default']) )
				continue;

			$script .= '
/* ' . $key . ' */';

			/*
			 * Auto-detection routines (2x)
			 */
			$autoAttribute = isset($value['options']['autoAttribute']) ? get_option( $value['options']['autoAttribute']['id'], $value['options']['autoAttribute']['default'] ) : '';

			if ( !empty($autoAttribute) ) {
				if ( is_numeric($autoAttribute) ) {
					$script .= '
jQuery(\''.$value['options']['autoAttribute']['selector'].'\').not(\'.nolightbox,li.nolightbox>a\').addClass(\''.$value['options']['class']['default'].'\');';
				} else {
					// set selectors
					$file_types = array_filter( explode( ' ', str_replace( ',', ' ', $autoAttribute ) ) );
					$more=0;
					$script .= '
var fb_'.$key.'_select=\'';
					foreach ( $file_types as $type ) {
						if ($type == "jpg" || $type == "jpeg" || $type == "png" || $type == "gif")
							$type = '.'.$type;
						if ($more>0)
							$script .= ',';
						$script .= 'a['.$value['options']['autoAttribute']['selector'].'"'.$type.'"]:not(.nolightbox,li.nolightbox>a),area['.$value['options']['autoAttribute']['selector'].'"'.$type.'"]:not(.nolightbox)';
						$more++;
					}
					$script .= '\';';

					// class and rel depending on settings
					if( '1' == get_option($value['options']['autoAttributeLimit']['id'],$value['options']['autoAttributeLimit']['default']) ) {
						// add class
						$script .= '
var fb_'.$key.'_sections=jQuery(\''.get_option($value['options']['autoSelector']['id'],$value['options']['autoSelector']['default']).'\');
fb_'.$key.'_sections.each(function(){jQuery(this).find(fb_'.$key.'_select).addClass(\''.$value['options']['class']['default'].'\')';
						// and set rel
						switch( get_option($value['options']['autoGallery']['id'],$value['options']['autoGallery']['default']) ) {
							case '':
							default :
								$script .= '; });';
								break;
							case '1':
								$script .= '.attr(\'rel\',\'gallery-\'+fb_'.$key.'_sections.index(this));});';
								break;
							case '2':
								$script .= '.attr(\'rel\',\'gallery\');});';
						}
					} else {
						// add class
						$script .= '
jQuery(fb_'.$key.'_select).addClass(\''.$value['options']['class']['default'].'\')';
						// set rel
						switch( get_option($value['options']['autoGallery']['id'],$value['options']['autoGallery']['default']) ) {
							case '':
							default :
								$script .= ';';
								break;
							case '1':
								$script .= ';
var fb_'.$key.'_sections = jQuery(\''.get_option($value['options']['autoSelector']['id'],$value['options']['autoSelector']['default']).'\');
fb_'.$key.'_sections.each(function(){jQuery(this).find(fb_'.$key.'_select).attr(\'rel\',\'gallery-\'+fb_'.$key.'_sections.index(this));});';
								break;
							case '2':
								$script .= '.attr(\'rel\',\'gallery\');';
						}
					}
				}
			}

			/*
			 * Generate .fancybox() bind
			 */

			// prepare auto popup
			if ( $key == $autoClick )
				$trigger = $value['options']['class']['default'];

			$script .= '
jQuery(\'' . $value['options']['tag']['default'] . '\')';

			// use each() to allow different metadata values per instance; fix by Elron. Thanks!
			$script .= '.each(function(){';

			// filter here
			$bind = 'jQuery(this).fancybox(jQuery.extend({},fb_opts,{';
			$more = 0;
			foreach ( $value['options'] as $_key => $_value ) {
				if ( isset($_value['id']) || isset($_value['default']) )
					$parm = isset($_value['id']) ? get_option($_value['id'], $_value['default']) : $_value['default'];
				else
					$parm = '';

				if ( isset($_value['input']) && 'checkbox'==$_value['input'] )
					$parm = ( '1' == $parm ) ? 'true' : 'false';

				if ( !isset($_value['hide']) && $parm!='' ) {
					$quote = ( is_numeric($parm) || ( isset($_value['noquotes']) && $_value['noquotes'] == true ) ) ? '' : '\'';
					if ( $more > 0 )
						$bind .= ',';
					$bind .= '\''.$_key.'\':';
					$bind .= $quote.$parm.$quote;
					$more++;
				}
			}
			$bind .= '}))';

			$script .= apply_filters( 'easy_fancybox_bind', $bind );

//			if ( '1' == get_option(self::$options['Global']['options']['Miscellaneous']['options']['metaData']['id'],self::$options['Global']['options']['Miscellaneous']['options']['metaData']['default']) )
//				$script .= '});}';

			$script .= '});';
		}

		$script .= '};
jQuery(\'a.fancybox-close\').on(\'click\',function(e){e.preventDefault();jQuery.fancybox.close()});
};';

		if ( empty($delayClick) ) $delayClick = '0';

		switch ( $autoClick ) {
			case '':
			break;

			case '1':
				$script .= '
var easy_fancybox_auto=function(){setTimeout(function(){jQuery(\'#fancybox-auto\').trigger(\'click\')},'.$delayClick.');};';
				self::$onready_auto = true;
			break;

			case '2':
				$script .= '
var easy_fancybox_auto=function(){setTimeout(function(){if(location.hash){jQuery(location.hash).trigger(\'click\');}},'.$delayClick.');};';
				self::$onready_auto = true;
			break;

			case '99':
				$script .= '
var easy_fancybox_auto=function(){setTimeout(function(){jQuery(\'a[class|="fancybox"]\').filter(\':first\').trigger(\'click\')},'.$delayClick.');};';
				self::$onready_auto = true;
			break;

			default :
				if ( !empty($trigger) ) {
					$script .= '
var easy_fancybox_auto=function(){setTimeout(function(){jQuery(\'a[class*="'.$trigger.'"]\').filter(\':first\').trigger(\'click\')},'.$delayClick.');};';
					self::$onready_auto = true;
				}
			break;
		}

		$script .= PHP_EOL;

		self::$inline_script = apply_filters( 'easy_fancybox_inline_script', $script );

		// HEADER STYLES //

		// customized styles
		$styles = '';
		if ( isset($overlaySpotlight) && 'true' == $overlaySpotlight )
			$styles .= '
#fancybox-overlay{background-attachment:fixed;background-image:url("' . self::$plugin_url . 'images/light-mask.png");background-position:center;background-repeat:no-repeat;background-size:100% 100%}';
		if ( !empty($borderRadius) )
			$styles .= '
#fancybox-outer,#fancybox-content{border-radius:'.$borderRadius.'px}.fancybox-title-inside{padding-top:'.$borderRadius.'px;margin-top:-'.$borderRadius.'px !important;border-radius: 0 0 '.$borderRadius.'px '.$borderRadius.'px}';
		if ( !empty($backgroundColor) )
			$styles .= '
#fancybox-content{background:'.$backgroundColor.'}';
		if ( !empty($paddingColor) )
			$styles .= '
#fancybox-content{border-color:'.$paddingColor.'}#fancybox-outer{background:'.$paddingColor.'}'; //.fancybox-title-inside{background-color:'.$paddingColor.';margin-left:0 !important;margin-right:0 !important;width:100% !important;}
		if ( !empty($textColor) )
			$styles .= '
#fancybox-content{color:'.$textColor.'}';
		if ( !empty($titleColor) )
			$styles .= '
#fancybox-title,#fancybox-title-float-main{color:'.$titleColor.'}';

		if ( !empty($styles) ) {
			self::$inline_style = $styles;
		}

		// running our IE alphaimageloader relative path styles here
		if ( isset($compatIE8) && 'true' == $compatIE8 ) {
			self::$inline_style_ie8 = '<!--[if lt IE 9]>
<style type="text/css">
/* IE6 */
#fancybox-left:hover,#fancybox-right:hover{visibility:visible}
.fancybox-ie6 #fancybox-close{background:transparent;filter:progid:DXImageTransform.Microsoft.AlphaImageLoader(src="'.self::$plugin_url.'fancybox/fancy_close.png",sizingMethod="scale");}
.fancybox-ie6 #fancybox-left-ico{background:transparent;filter:progid:DXImageTransform.Microsoft.AlphaImageLoader(src="'.self::$plugin_url.'fancybox/fancy_nav_left.png",sizingMethod="scale");}
.fancybox-ie6 #fancybox-right-ico{background:transparent;filter:progid:DXImageTransform.Microsoft.AlphaImageLoader(src="'.self::$plugin_url.'fancybox/fancy_nav_right.png",sizingMethod="scale");}
.fancybox-ie6 #fancybox-title-over{background:transparent;filter:progid:DXImageTransform.Microsoft.AlphaImageLoader(src="'.self::$plugin_url.'fancybox/fancy_title_over.png",sizingMethod="scale");zoom:1;}
.fancybox-ie6 #fancybox-title-float-left{background:transparent;filter:progid:DXImageTransform.Microsoft.AlphaImageLoader(src="'.self::$plugin_url.'fancybox/fancy_title_left.png",sizingMethod="scale");}
.fancybox-ie6 #fancybox-title-float-main{background:transparent;filter:progid:DXImageTransform.Microsoft.AlphaImageLoader(src="'.self::$plugin_url.'fancybox/fancy_title_main.png",sizingMethod="scale");}
.fancybox-ie6 #fancybox-title-float-right{background:transparent;filter:progid:DXImageTransform.Microsoft.AlphaImageLoader(src="'.self::$plugin_url.'fancybox/fancy_title_right.png",sizingMethod="scale");}
.fancybox-ie6 #fancybox-bg-w,.fancybox-ie6 #fancybox-bg-e,.fancybox-ie6 #fancybox-left,.fancybox-ie6 #fancybox-right,#fancybox-hide-sel-frame{height: expression(this.parentNode.clientHeight + "px");}
#fancybox-loading.fancybox-ie6{position:absolute;margin-top:0;top:expression((-20+(document.documentElement.clientHeight?document.documentElement.clientHeight/2:document.body.clientHeight/2)+(ignoreMe=document.documentElement.scrollTop?document.documentElement.scrollTop:document.body.scrollTop))+"px");}
#fancybox-loading.fancybox-ie6 div{background:transparent;filter:progid:DXImageTransform.Microsoft.AlphaImageLoader(src="'.self::$plugin_url.'fancybox/fancy_loading.png",sizingMethod="scale");}
/* IE6, IE7, IE8 */
.fancybox-ie #fancybox-title-over{background-image:url(' . self::$plugin_url . 'fancybox/fancy_title_over.png); }
.fancybox-bg{position:absolute;padding:0;margin:0;border:0;width:20px;height:20px;z-index:111001;}
#fancybox-bg-n{top:-20px;left:0;width: 100%;}#fancybox-bg-ne{top:-20px;right:-20px;}#fancybox-bg-e{top:0;right:-20px;height:100%;}#fancybox-bg-se{bottom:-20px;right:-20px;}#fancybox-bg-s{bottom:-20px;left:0;width:100%;}#fancybox-bg-sw{bottom:-20px;left:-20px;}#fancybox-bg-w{top:0;left:-20px;height:100%;}#fancybox-bg-nw {top:-20px;left:-20px;}
.fancybox-ie .fancybox-bg{background:transparent !important;}
.fancybox-ie #fancybox-bg-n{filter:progid:DXImageTransform.Microsoft.AlphaImageLoader(src="'.self::$plugin_url.'fancybox/fancy_shadow_n.png",sizingMethod="scale");}
.fancybox-ie #fancybox-bg-ne{filter:progid:DXImageTransform.Microsoft.AlphaImageLoader(src="'.self::$plugin_url.'fancybox/fancy_shadow_ne.png",sizingMethod="scale");}
.fancybox-ie #fancybox-bg-e{filter:progid:DXImageTransform.Microsoft.AlphaImageLoader(src="'.self::$plugin_url.'fancybox/fancy_shadow_e.png",sizingMethod="scale");}
.fancybox-ie #fancybox-bg-se{filter:progid:DXImageTransform.Microsoft.AlphaImageLoader(src="'.self::$plugin_url.'fancybox/fancy_shadow_se.png",sizingMethod="scale");}
.fancybox-ie #fancybox-bg-s{filter:progid:DXImageTransform.Microsoft.AlphaImageLoader(src="'.self::$plugin_url.'fancybox/fancy_shadow_s.png",sizingMethod="scale");}
.fancybox-ie #fancybox-bg-sw{filter:progid:DXImageTransform.Microsoft.AlphaImageLoader(src="'.self::$plugin_url.'fancybox/fancy_shadow_sw.png",sizingMethod="scale");}
.fancybox-ie #fancybox-bg-w{filter:progid:DXImageTransform.Microsoft.AlphaImageLoader(src="'.self::$plugin_url.'fancybox/fancy_shadow_w.png",sizingMethod="scale");}
.fancybox-ie #fancybox-bg-nw{filter:progid:DXImageTransform.Microsoft.AlphaImageLoader(src="'.self::$plugin_url.'fancybox/fancy_shadow_nw.png",sizingMethod="scale");}';

			if ( isset($overlaySpotlight) && 'true' == $overlaySpotlight )
				self::$inline_style_ie8 .= '
#fancybox-overlay{filter:progid:DXImageTransform.Microsoft.AlphaImageLoader(src="'.self::$plugin_url.'images/light-mask.png",sizingMethod="scale");';

			self::$inline_style_ie8 .= '</style>
<![endif]-->
';
		}
	}

	public static function print_ie_inline_style() {
		if ( !self::$add_scripts || empty(self::$inline_style_ie8) )
			return;

		print( self::$inline_style_ie8 );
	}

	/***********************
	    ACTIONS & FILTERS
	 ***********************/

	public static function enqueue_scripts() {
		// make sure whe actually need to do anything
		if ( !self::$add_scripts )
			return;

		$min = ( defined('WP_DEBUG') && true == WP_DEBUG ) ? '' : '.min';

		// ENQUEUE STYLE
		wp_enqueue_style( 'fancybox', self::$plugin_url.'fancybox/jquery.fancybox'.$min.'.css', false, FANCYBOX_VERSION, 'screen' );
		wp_add_inline_style( 'fancybox', self::$inline_style );

		// ENQUEUE SCRIPTS
		// register main fancybox script
		wp_enqueue_script( 'jquery-fancybox', self::$plugin_url.'fancybox/jquery.fancybox'.$min.'.js', array('jquery'), FANCYBOX_VERSION, true );
		wp_add_inline_script( 'jquery-fancybox', self::$inline_script );

		// jQuery Easing, which is ot needed if jQueryUI Core Effects are loaded
		if ( !wp_script_is( 'jquery-effects-core', 'enqueued' ) ) {
			$add_easing = false;
			// test for easing in IMG settings
			if ( get_option(self::$options['Global']['options']['Enable']['options']['IMG']['id'], self::$options['Global']['options']['Enable']['options']['IMG']['default'])
				&& ( 'elastic' == get_option( self::$options['IMG']['options']['transitionIn']['id'], self::$options['IMG']['options']['transitionIn']['default'])
				|| 'elastic' == get_option( self::$options['IMG']['options']['transitionOut']['id'], self::$options['IMG']['options']['transitionOut']['default']) ) )
				$add_easing = true;
			// test for easing in Inline settings
			if ( get_option(self::$options['Global']['options']['Enable']['options']['Inline']['id'], self::$options['Global']['options']['Enable']['options']['Inline']['default'])
				&& ( 'elastic' == get_option( self::$options['Inline']['options']['transitionIn']['id'], self::$options['Inline']['options']['transitionIn']['default'])
				|| 'elastic' == get_option( self::$options['Inline']['options']['transitionOut']['id'], self::$options['Inline']['options']['transitionOut']['default']) ) )
				$add_easing = true;
			// enqueue easing?
			if ( $add_easing ) {
				wp_enqueue_script('jquery-easing', self::$plugin_url.'js/jquery.easing'.$min.'.js', array('jquery'), EASING_VERSION, true);
			}
		}

		// jQuery Mousewheel, which is not needed if jQueryUI Mouse is loaded
		if ( !wp_script_is( 'jquery-ui-mouse', 'enqueued' ) AND '1' == get_option( self::$options['IMG']['options']['mouseWheel']['id'], self::$options['IMG']['options']['mouseWheel']['default']) ) {
			wp_enqueue_script('jquery-mousewheel', self::$plugin_url.'js/jquery.mousewheel'.$min.'.js', array('jquery'), MOUSEWHEEL_VERSION, true);
		}

		// metadata in Miscellaneous settings?
		if ( '1' == get_option( self::$options['Global']['options']['Miscellaneous']['options']['metaData']['id'], self::$options['Global']['options']['Miscellaneous']['options']['metaData']['default']) ) {
			wp_enqueue_script('jquery-metadata',self::$plugin_url.'js/jquery.metadata'.$min.'.js', array('jquery'), METADATA_VERSION, true);
		}
	}

	// Hack to fix missing wmode in Youtube oEmbed code based on David C's code in the comments on
	// http://www.mehigh.biz/wordpress/adding-wmode-transparent-to-wordpress-3-media-embeds.html
	public static function add_video_wmode_opaque($html, $url, $attr) {
		if ( strpos($html, "<embed src=" ) !== false ) {
			$html = str_replace('</param><embed', '</param><param name="wmode" value="opaque"></param><embed wmode="opaque"', $html);
		} elseif ( strpos($html, 'youtube' ) !== false && strpos($html, 'wmode' ) == false ) {
			$html = str_replace('feature=oembed', 'feature=oembed&wmode=opaque', $html);
		} elseif ( strpos($html, "vimeo" ) !== false  && strpos($html, 'wmode' ) == false ) {
			$html = str_replace('" width', '?theme=none&wmode=opaque" width', $html);
		} elseif ( strpos($html, "dailymotion" ) !== false  && strpos($html, 'wmode' ) == false ) {
			$html = str_replace('" width', '?wmode=opaque" width', $html);
		}
		return $html;
	}

	public static function onready_callback( $content ) {

		$content .= 'jQuery(easy_fancybox_handler);jQuery(document).on(\'' . implode(" ", self::$events) . '\',easy_fancybox_handler);' . PHP_EOL;

		if ( self::$onready_auto )
			$content .=	apply_filters( 'easy_fancybox_onready_auto', 'jQuery(easy_fancybox_auto);' );

		return $content;
	}

	public static function init() {
		easyFancyBox_Options::load_defaults();
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
		add_action( 'init', array(__CLASS__, 'init') );
		add_action( 'wp_loaded', array(__CLASS__, 'main') );
		add_action( 'wp_enqueue_scripts', array(__CLASS__, 'enqueue_scripts') );
		add_action( 'wp_head', array(__CLASS__, 'print_ie_inline_style'), 11 );

		// FILTERS
		add_filter( 'embed_oembed_html', array(__CLASS__,'add_video_wmode_opaque'), 10, 3 );
		add_filter( 'easy_fancybox_inline_script', array(__CLASS__,'onready_callback') );
	}
}
