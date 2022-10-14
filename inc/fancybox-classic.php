<?php
/**
 * FancyBox v1
 */

namespace easyFancyBox\fancyBox_1;

/**
 * MAIN INLINE SCRIPT
 */

function prepare_inline() {
	// Begin building output FancyBox settings.
	$script = 'var fb_timeout, fb_opts={';

	/**
	 * Global settings routine.
	 */
	$more = 0;
	foreach ( \easyFancyBox::$options['Global']['options'] as $globals ) {
		foreach ( $globals['options'] as $_key => $_value ) {
			if ( isset($_value['id']) )
				if ( isset($_value['default']) )
					$parm = \get_option($_value['id'], $_value['default']);
				else
					$parm = \get_option($_value['id']);
			elseif ( isset($_value['default']) )
				$parm = $_value['default'];
			else
				$parm = '';

			if ( isset($_value['input']) && 'checkbox'==$_value['input'] )
				$parm = ( '1' == $parm ) ? 'true' : 'false';

			if( ! isset($_value['hide']) && $parm!='' ) {
				$quote = ( is_numeric($parm) || (isset($_value['noquotes']) && $_value['noquotes'] == true) ) ? '' : '\'';
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
var easy_fancybox_handler=function(){';

	$exclude = \get_option( 'fancybox_autoExclude', \easyFancyBox::$options['Global']['options']['Miscellaneous']['options']['autoExclude']['default'] );
	$exclude_array = $exclude ? explode( ',', $exclude ) : array();
	$exclude_selectors = ! empty( $exclude_array ) ? \wp_json_encode( $exclude_array ) : false;
	if ( $exclude_selectors ) {
		$script .= '
jQuery(' . $exclude_selectors . '.join(\',\')).addClass(\'nofancybox\');';
	}

	$script .= '
jQuery(\'a.fancybox-close\').on(\'click\',function(e){e.preventDefault();jQuery.fancybox.close()});';

	foreach ( \easyFancyBox::$options as $key => $value ) {
		// Check if not enabled or hide=true then skip.
		if ( isset( $value['hide'] ) || ! isset( \easyFancyBox::$options['Global']['options']['Enable']['options'][$key]['id'] ) || ! \get_option( \easyFancyBox::$options['Global']['options']['Enable']['options'][$key]['id'], \easyFancyBox::$options['Global']['options']['Enable']['options'][$key]['default'] ) )
			continue;

		$script .= '
/* ' . $key . ' */';

		/**
		 * Auto-detection routines (2x)
		 */
		$autoAttribute = isset( $value['options']['autoAttribute'] ) ? \get_option( $value['options']['autoAttribute']['id'], $value['options']['autoAttribute']['default'] ) : '';

		if ( !empty($autoAttribute) ) {
			if ( is_numeric($autoAttribute) ) {
				$script .= '
jQuery('.$value['options']['autoAttribute']['selector'].').not(\'.nofancybox,li.nofancybox>a\').addClass(\''.$value['options']['class']['default'].'\');';
			} else {
				// Set selectors.
				$file_types = array_filter( explode( ',', str_replace( ' ', ',', $autoAttribute ) ) );
				$more = 0;
				$script .= '
var fb_'.$key.'_select=jQuery(\'';
				foreach ( $file_types as $type ) {
					if ($type == "jpg" || $type == "jpeg" || $type == "png" || $type == "webp" || $type == "gif")
						$type = '.'.$type;
					if ($more>0)
						$script .= ',';
					$script .= 'a['.$value['options']['autoAttribute']['selector'].'"'.$type.'" i]:not(.nofancybox,li.nofancybox>a),area['.$value['options']['autoAttribute']['selector'].'"'.$type.'" i]:not(.nofancybox)';
					$more++;
				}
				$script .= '\');';

				$autoselector = class_exists('easyFancyBox_Advanced') ? \get_option($value['options']['autoSelector']['id'],$value['options']['autoSelector']['default']) : $value['options']['autoSelector']['default'];

				// Class and rel depending on settings.
				if( '1' == \get_option($value['options']['autoAttributeLimit']['id'],$value['options']['autoAttributeLimit']['default']) ) {
					// Add class.
					$script .= '
var fb_'.$key.'_sections=jQuery(\''.$autoselector.'\');
fb_'.$key.'_sections.each(function(){jQuery(this).find(fb_'.$key.'_select).addClass(\''.$value['options']['class']['default'].'\')';
					// Set rel.
					switch( \get_option($value['options']['autoGallery']['id'],$value['options']['autoGallery']['default']) ) {
						case '':
						default :
							$script .= ';});';
							break;

						case '1':
							$script .= '.attr(\'rel\',\'gallery-\'+fb_'.$key.'_sections.index(this));});';
							break;

						case '2':
							$script .= '.attr(\'rel\',\'gallery\');});';
							break;
					}
				} else {
					// Add class.
					$script .= '
fb_'.$key.'_select.addClass(\''.$value['options']['class']['default'].'\')';
					// Set rel.
					switch( \get_option($value['options']['autoGallery']['id'],$value['options']['autoGallery']['default']) ) {
						case '':
						default :
							$script .= ';';
							break;

						case '1':
							$script .= ';
var fb_'.$key.'_sections=jQuery(\''.$autoselector.'\');
fb_'.$key.'_sections.each(function(){jQuery(this).find(fb_'.$key.'_select).attr(\'rel\',\'gallery-\'+fb_'.$key.'_sections.index(this));});';
							break;

						case '2':
							$script .= '.attr(\'rel\',\'gallery\');';
							break;
					}
				}
			}
		}

		/**
		 * Generate .fancybox() bind.
		 */

		// Prepare auto popup.
		if ( $key == $autoClick )
			$trigger = $value['options']['class']['default'];

		$script .= '
jQuery(\'' . $value['options']['tag']['default'] . '\')';

		// Use each() to allow different metadata values per instance; fix by Elron. Thanks!
		$script .= '.each(function(){';

		// Filter here.
		$bind = 'jQuery(this).fancybox(jQuery.extend(true,{},fb_opts,{';
		$more = 0;
		foreach ( $value['options'] as $_key => $_value ) {
			if ( isset($_value['id']) || isset($_value['default']) )
				$parm = isset($_value['id']) ? strval( \get_option($_value['id'], isset($_value['default']) ? $_value['default'] : '' ) ) : strval( $_value['default'] );
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

		$script .= \apply_filters( 'easy_fancybox_bind', $bind );

		$script .= '});';
	}

	$script .= '
};};';

	if ( empty( $delayClick ) ) $delayClick = '0';

	switch ( $autoClick ) {
		case '':
			break;

		case '1':
			$script .= PHP_EOL . 'var easy_fancybox_auto=function(){setTimeout(function(){jQuery(\'a#fancybox-auto,#fancybox-auto>a\').first().trigger(\'click\')},'.$delayClick.');};';
			\easyFancyBox::$onready_auto = true;
			break;

		case '2':
			$script .= PHP_EOL . 'var easy_fancybox_auto=function(){setTimeout(function(){if(location.hash){jQuery(location.hash).trigger(\'click\');}},'.$delayClick.');};';
			\easyFancyBox::$onready_auto = true;
			break;

		case '99':
			$script .= PHP_EOL . 'var easy_fancybox_auto=function(){setTimeout(function(){jQuery(\'a[class|="fancybox"]\').filter(\':first\').trigger(\'click\')},'.$delayClick.');};';
			\easyFancyBox::$onready_auto = true;
			break;

		default :
			if ( ! empty( $trigger ) ) {
				$script .= PHP_EOL . 'var easy_fancybox_auto=function(){setTimeout(function(){jQuery(\'a[class*="'.$trigger.'"]\').filter(\':first\').trigger(\'click\')},'.$delayClick.');};';
				\easyFancyBox::$onready_auto = true;
			}
	}


	$script .= PHP_EOL;

	// Replace PDF embed shortcodes.
	if ( ! empty( get_option('fancybox_enablePDF') ) && ! empty( get_option( 'fancybox_PDFonStart', '{{object}}' ) ) ) {
		$replaces = array(
			'{{object}}'       => 'function(a,i,o){o.type=\'pdf\';}',
			'{{embed}}'        => 'function(a,i,o){o.type=\'html\';o.content=\'<embed src="\'+a[i].href+\'" type="application/pdf" height="100%" width="100%" />\'}',
			'{{googleviewer}}' => 'function(a,i,o){o.href=\'https://docs.google.com/viewer?embedded=true&url=\'+a[i].href;}'
		);
		foreach ($replaces as $short => $replace) {
			$script = str_replace( $short, $replace, $script );
		}
	}
	\easyFancyBox::$inline_script = \apply_filters( 'easy_fancybox_inline_script', $script );

	/**
	 * HEADER STYLES
	 */

	// Customized styles.
	$styles = '';
	! isset( $overlaySpotlight ) || 'true' !== $overlaySpotlight || $styles .= '#fancybox-overlay{background-attachment:fixed;background-image:url("' . \easyFancyBox::$plugin_url . 'images/light-mask.png");background-position:center;background-repeat:no-repeat;background-size:100% 100%}';

	empty( $borderRadius ) || $styles .= '#fancybox-outer,#fancybox-content{border-radius:'.$borderRadius.'px}.fancybox-title-inside{padding-top:'.$borderRadius.'px;margin-top:-'.$borderRadius.'px !important;border-radius: 0 0 '.$borderRadius.'px '.$borderRadius.'px}';

	$content_style = '';
	empty( $backgroundColor ) || $content_style .= 'background:'.$backgroundColor.';';
	empty( $paddingColor ) || $content_style .= 'border-color:'.$paddingColor.';';
	if ( ! empty( $textColor ) ) {
		$content_style .= 'color:'.$textColor.';';
		$styles .= '#fancybox-outer{background:'.$paddingColor.'}'; //.fancybox-title-inside{background-color:'.$paddingColor.';margin-left:0 !important;margin-right:0 !important;width:100% !important;}
	}
	empty( $content_style ) || $styles .= '#fancybox-content{'.$content_style.'}';

	empty( $titleColor ) || $styles .= '#fancybox-title,#fancybox-title-float-main{color:'.$titleColor.'}';

	$styles = \apply_filters( 'easy_fancybox_inline_style', $styles );

	empty( $styles ) || \easyFancyBox::$inline_style = \wp_strip_all_tags( $styles );
}

function add_easing() {
	// Check IMG settings.
	if (
		\get_option( 'fancybox_enableImg', \easyFancyBox::$options['Global']['options']['Enable']['options']['IMG']['default'] ) &&
		( 'elastic' === \get_option( 'fancybox_transitionIn', 'elastic' ) || 'elastic' === \get_option( 'fancybox_transitionOut', 'elastic' ) )
	) {
		return true;
	}

	// Check Inline Content settings.
	if (
		\get_option( 'fancybox_enableInline', false ) &&
		( 'elastic' === \get_option( 'fancybox_transitionInInline' ) || 'elastic' === \get_option( 'fancybox_transitionOutInline' ) )
	) {
		return true;
	}

	return false;
}

/**
 *  ACTIONS & FILTERS
 */

function prepare_scripts_styles() {
	// Make sure whe actually need to do anything.
	if ( ! \easyFancyBox::add_scripts() ){
		return;
	}

	// INLINE SCRIPT & STYLE
	prepare_inline();

	$min = ( defined('WP_DEBUG') && WP_DEBUG ) ? '' : '.min';

	// SCRIPT & STYLE URLS

	$dep    = get_option( 'fancybox_nojQuery', false ) ? array() : array( 'jquery' );
	$ver    = defined( 'WP_DEBUG' ) && WP_DEBUG        ? time()  : false;
	$min    = defined( 'WP_DEBUG' ) && WP_DEBUG        ? ''      : '.min';
	$footer = get_option( 'fancybox_noFooter', false ) ? false   : true;

	// FancyBox.
	\easyFancyBox::$styles['fancybox'] = array(
		'src'   => \easyFancyBox::$plugin_url.'fancybox/'.FANCYBOX_VERSIONS['classic'].'/jquery.fancybox'.$min.'.css',
		'deps'  => array(),
		'ver'   => $ver,
		'media' => 'screen'
	);
	\easyFancyBox::$scripts['jquery-fancybox'] = array(
		'src'    => \easyFancyBox::$plugin_url.'fancybox/'.FANCYBOX_VERSIONS['classic'].'/jquery.fancybox'.$min.'.js',
		'deps'   => $dep,
		'ver'    => $ver,
		'footer' => $footer
	);

	// jQuery Easing, which is not needed if jQueryUI Core Effects are loaded or when using fancyBox 3.
	if ( add_easing() ) {
		\easyFancyBox::$easing_script_url = \easyFancyBox::$plugin_url.'vendor/jquery.easing'.$min.'.js';
	}

	// jQuery Mousewheel, which is not needed if jQueryUI Mouse is loaded or when using fancyBox 3.
	if ( \get_option( 'fancybox_mouseWheel', true ) ) {
		\easyFancyBox::$mousewheel_script_url = \easyFancyBox::$plugin_url.'vendor/jquery.mousewheel'.$min.'.js';
	}

	// Metadata in Miscellaneous settings?
	if ( \get_option( 'fancybox_metaData' ) ) {
		\easyFancyBox::$scripts['jquery-metadata'] = array(
			'src'    => \easyFancyBox::$plugin_url.'vendor/jquery.metadata.min.js',
			'deps'   => $dep,
			'ver'    => METADATA_VERSION,
			'footer' => $footer
		);
	}
}
\add_action( 'init', __NAMESPACE__.'\prepare_scripts_styles', 12 );

function onready_callback( $content ) {
	$content .= 'jQuery(easy_fancybox_handler);jQuery(document).on(\'' . implode( " ", \easyFancyBox::$events ) . '\',easy_fancybox_handler);' . PHP_EOL;

	if ( \easyFancyBox::$onready_auto )
		$content .= \apply_filters( 'easy_fancybox_onready_auto', 'jQuery(easy_fancybox_auto);' );

	return $content;
}
\add_filter( 'easy_fancybox_inline_script', __NAMESPACE__.'\onready_callback' );
