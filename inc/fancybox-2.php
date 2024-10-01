<?php
/**
 * Fancybox Version 2 Integration
 *
 * This file is part of the Easy FancyBox plugin and provides integration for Fancybox version 2,
 * including enqueuing scripts and styles, preparing inline scripts for initialization, and handling
 * specific settings tailored for Fancybox 2 functionality.
 *
 * @package EasyFancyBox
 */

namespace easyFancyBox\fancyBox_2;

/**
 * Prepares inline scripts for Fancybox 2.
 *
 * @return void
 */
function prepare_inline_scripts() {
	/**
	 * Global parameters and value extraction.
	 */
	$fb_opts = array();

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

			if ( isset($_value['input']) && 'checkbox' == $_value['input'] ) {
				$parm = ( '1' == $parm ) ? true : false;
			}

			if( ! isset($_value['hide']) && $parm !== '' ) {
				$fb_opts[$_key] = $parm;
			} else {
				${$_key} = $parm;
			}
		}
	}

	// Retina
	$use_device_pixelRatio = get_option( 'fancybox_pixelRatio' ) === '1';
	if ( ! $use_device_pixelRatio ) {
		$fb_opts['pixelRatio'] = '1';
	} else {
		unset( $fb_opts['pixelRatio'] );
	}

	// Transitions.
	$transition = get_option( 'fancybox_transition' );
	if ( ! empty( $transition ) ) {
		$fb_opts['prevEffect'] = $transition;
		$fb_opts['nextEffect'] = $transition;
	}

	// Change speeds.
	$changespeed = get_option( 'fancybox_changeSpeed' );
	if ( ! empty( $changespeed ) ) {
		$fb_opts['prevSpeed'] = intval( $changespeed );
		$fb_opts['nextSpeed'] = intval( $changespeed );
	}

	// Keys.
	if ( ! \get_option( 'fancybox_enableEscapeButton', true ) ) {
		$fb_opts['keys'] = array( 'close' => null );
	}

	// Overlay.
	if ( \get_option( 'fancybox_overlayShow', true ) ) {
		if ( ! \get_option( 'fancybox_hideOnOverlayClick', true ) ) {
			$fb_opts['helpers']['overlay']['closeClick'] = false;
		}
		if ( \get_option( 'fancybox_overlayColor2' ) ) {
			$fb_opts['helpers']['overlay']['css'] = array(
				'background' =>
				\esc_attr( \get_option('fancybox_overlayColor2') )
			);
		}
	} else {
		$fb_opts['helpers']['overlay'] = null;
	}

	// Media helpers.
	if ( add_media() ) {
		$fb_opts['helpers']['media'] = array();

		// Null the unselected.
		\get_option( 'fancybox_enableYoutube' )     || $fb_opts['helpers']['media']['youtube']     = null;
		\get_option( 'fancybox_enableVimeo' )       || $fb_opts['helpers']['media']['vimeo']       = null;
		\get_option( 'fancybox_enableDailymotion' ) || $fb_opts['helpers']['media']['dailymotion'] = null;
		\get_option( 'fancybox_enableInstagram' )   || $fb_opts['helpers']['media']['instagram']   = null;
		\get_option( 'fancybox_enableGoogleMaps' )  || $fb_opts['helpers']['media']['google_maps'] = null;
	}

	$fb_opts = apply_filters( 'easy_fancybox_fb_opts', $fb_opts );

	/**
	 * Build main handler.
	 */
	$fb_handler = 'function(){';

	// Exclude.
	$exclude = \get_option( 'fancybox_autoExclude', \easyFancyBox::$options['Global']['options']['Miscellaneous']['options']['autoExclude']['default'] );
	$exclude_array = $exclude ? \explode( ',', $exclude ) : array();
	$exclude_selectors = ! empty( $exclude_array ) ? \json_encode( $exclude_array ) : false;

	$fb_handler .= $exclude_selectors ? PHP_EOL . 'jQuery(' . $exclude_selectors . '.join(\',\')).addClass(\'nofancybox\');' : '';

	// Close link.
	$fb_handler .= PHP_EOL . 'jQuery(\'a.fancybox-close\').on(\'click\',function(e){e.preventDefault();jQuery.fancybox.close()});';

	foreach ( \easyFancyBox::$options as $key => $value ) {
		// Check if not enabled or hide=true then skip.
		if ( isset( $value['hide'] ) || ! isset( \easyFancyBox::$options['Global']['options']['Enable']['options'][$key]['id'] ) || ! \get_option( \easyFancyBox::$options['Global']['options']['Enable']['options'][$key]['id'], \easyFancyBox::$options['Global']['options']['Enable']['options'][$key]['default'] ) )
			continue;

		$fb_handler .= '
/* ' . $key . ' */';

		/**
		 * Auto-detection routines (2x)
		 */
		$autoAttribute = isset( $value['options']['autoAttribute'] ) ? \get_option( $value['options']['autoAttribute']['id'], $value['options']['autoAttribute']['default'] ) : '';

		if ( !empty($autoAttribute) ) {
			if ( is_numeric($autoAttribute) ) {
				$fb_handler .= '
jQuery('.$value['options']['autoAttribute']['selector'].').not(\'.nofancybox,li.nofancybox>a\').addClass(\''.$value['options']['class']['default'].'\');';
			} else {
				// First wrap unlinked image blocks depending on settings
				$autoAttributeLimit = \get_option( $value['options']['autoAttributeLimit']['id'], $value['options']['autoAttributeLimit']['default'] );
				if ( 'IMG' === $key && ( 'all' === $autoAttributeLimit || '' === $autoAttributeLimit ) ) {
					$fb_handler .= '
						var unlinkedImageBlocks=jQuery(".wp-block-image > img:not(.nofancybox,figure.nofancybox>img)");
						unlinkedImageBlocks.wrap(function() {
							var href = jQuery( this ).attr( "src" );
							return "<a href=\'" + href + "\'></a>";
						});';
				}
				// Set selectors.
				$file_types = array_filter( explode( ',', str_replace( ' ', ',', $autoAttribute ) ) );
				$more = 0;
				$fb_handler .= '
var fb_'.$key.'_select=jQuery(\'';
				foreach ( $file_types as $type ) {
					if ($type == "jpg" || $type == "jpeg" || $type == "png" || $type == "webp" || $type == "gif")
						$type = '.'.$type;
					if ($more>0)
						$fb_handler .= ',';
					$fb_handler .= 'a['.$value['options']['autoAttribute']['selector'].'"'.$type.'" i]:not(.nofancybox,li.nofancybox>a,figure.nofancybox>a),area['.$value['options']['autoAttribute']['selector'].'"'.$type.'" i]:not(.nofancybox)';
					$more++;
				}
				$fb_handler .= '\');';

				// Gallery Groups/Sections/Selectors
				$nextgen_selectors = '.ngg-galleryoverview,.ngg-imagebrowser,.nextgen_pro_blog_gallery,.nextgen_pro_film,.nextgen_pro_horizontal_filmstrip,.ngg-pro-masonry-wrapper,.ngg-pro-mosaic-container,.nextgen_pro_sidescroll,.nextgen_pro_slideshow,.nextgen_pro_thumbnail_grid,.tiled-gallery';
				$default_autoselector = $value['options']['autoSelector']['default'] . ',' . $nextgen_selectors;
				$custom_autoselector = \get_option( $value['options']['autoSelector']['id'], $value['options']['autoSelector']['default'] );

				// Class and rel depending on settings.
				if( '1' === $autoAttributeLimit || 'sections' === $autoAttributeLimit ) {
					// Only apply fancybox class to images within specific containers.
					$autoselector_for_applying_classes = '' === $custom_autoselector
						? $default_autoselector
						: $custom_autoselector;

					// Add class.
					$fb_handler .= '
var fb_'.$key.'_sections=jQuery(\''.$autoselector_for_applying_classes.'\');
fb_'.$key.'_sections.each(function(){jQuery(this).find(fb_'.$key.'_select).addClass(\''.$value['options']['class']['default'].'\')';
					// Set rel.
					switch( \get_option($value['options']['autoGallery']['id'],$value['options']['autoGallery']['default']) ) {
						case '':
						case 'disabled':
							$fb_handler .= ';});';
							break;

						case '1':
						case 'galleries':
						case 'custom':
						default:
							$fb_handler .= '.attr(\'data-fancybox-group\',\'gallery-\'+fb_'.$key.'_sections.index(this));});';
							break;

						case '2':
						case 'all':
							$fb_handler .= '.attr(\'data-fancybox-group\',\'gallery\');});';
							break;
					}
				} else {
					// Apply fancybox class to all images.
					$fb_handler .= '
fb_'.$key.'_select.addClass(\''.$value['options']['class']['default'].'\')';
					// Set rel.
					switch( \get_option($value['options']['autoGallery']['id'],$value['options']['autoGallery']['default']) ) {
						case '':
						case 'disabled':
							$fb_handler .= ';';
							break;

						case '1':
						case 'galleries':
						default:
							$fb_handler .= ';
var fb_'.$key.'_sections=jQuery(\''.$default_autoselector.'\');
fb_'.$key.'_sections.each(function(){jQuery(this).find(fb_'.$key.'_select).attr(\'data-fancybox-group\',\'gallery-\'+fb_'.$key.'_sections.index(this));});';
							break;

						case 'custom':
							// Group galleries based on custom containers.
							$autoselectors_to_group_galleries = '' === $custom_autoselector
								? $default_autoselector
								: $custom_autoselector;
							$fb_handler .= ';
var fb_'.$key.'_sections=jQuery(\''.$autoselectors_to_group_galleries.'\');
fb_'.$key.'_sections.each(function(){jQuery(this).find(fb_'.$key.'_select).attr(\'data-fancybox-group\',\'gallery-\'+fb_'.$key.'_sections.index(this));});';
							break;

						case '2':
						case 'all':
							$fb_handler .= '.attr(\'data-fancybox-group\',\'gallery\');';
							break;
					}
				}
			}
		}

		// Prepare auto popup.
		$trigger = $key == $autoClick ? $value['options']['class']['default'] : '';

		/**
		 * Generate .fancybox() bind.
		 */

		$bind_parameters = array();
		foreach ( $value['options'] as $_key => $_value ) {
			// Treat some known keys differently
			$convert_to = array(
				'easingIn'   => 'openEasing',
				'easingOut'  => 'closeEasing',
				'onStart'    => false, // Keep for Pro backward compat.
				'onComplete' => false, // Keep for Pro backward compat.
				'onCleanup'  => false, // Keep for Pro backward compat.
			);
			if ( array_key_exists ( $_key, $convert_to ) ) {
				if ( $convert_to[$_key] ) {
					$_key = $convert_to[$_key];
				} else {
					// Skip this one.
					continue;
				}
			}

			if ( isset($_value['id']) || isset($_value['default']) )
				$parm = ! empty($_value['id']) ? strval( \get_option($_value['id'], isset($_value['default']) ? $_value['default'] : '' ) ) : strval( $_value['default'] );
			else
				$parm = '';

			if ( isset($_value['input']) && 'checkbox'==$_value['input'] )
				$parm = ( '1' == $parm ) ? true : false;

			if ( ! isset($_value['hide']) && $parm !== '' ) {
				$bind_parameters[$_key] = $parm;
			}
		}

		// Title.
		if ( isset( $value['options']['titleShow'] ) && ! empty( $value['options']['titleShow']['id'] ) && \get_option( $value['options']['titleShow']['id'] ) ) {
			$bind_parameters['helpers'] = array( 'title' => array() );
			/*if ( isset( $value['options']['titleType'] ) && \get_option( $value['options']['titleType']['id'] ) ) {
				$bind_parameters['helpers']['title']['type'] = \esc_attr( \get_option( $value['options']['titleType']['id'] ) );
			}*/
			if ( isset( $value['options']['titlePosition'] ) ) {
				$position = \get_option( $value['options']['titlePosition']['id'], $value['options']['titlePosition']['default'] );
				$title = explode( '-', $position );
				if ( ! empty( $title ) ) {
					$bind_parameters['helpers']['title']['type'] = $title[0];
					isset( $title[1] ) && $bind_parameters['helpers']['title']['position'] = $title[1];
				}
			}
			if ( isset( $value['options']['titleFromAlt'] ) && \get_option( $value['options']['titleFromAlt']['id'] ) ) {
				$bind_parameters['beforeShow'] = '{{titleFromAlt}}'; //;
			}
		} else {
			$bind_parameters['helpers'] = array( 'title' => null );
		}

		// Iframe
		if ( isset( $value['options']['allowFullScreen'] ) && ! \get_option( $value['options']['allowFullScreen']['id'], $value['options']['allowFullScreen']['default'] ) ) {
			$bind_parameters['iframe'] = array( 'allowfullscreen' => false ); //;
		}

		// Keys.
		if ( isset( $value['options']['enableKeyboardNav'] ) && ! empty( $value['options']['enableKeyboardNav']['id'] ) && ! \get_option( $value['options']['enableKeyboardNav']['id'], true ) ) {
			$bind_parameters['keys'] = array( 'next' => null, 'prev' => null );
		}

		// Cyclic.
		if ( isset( $value['options']['loop'] ) && ! empty( $value['options']['loop']['id'] ) && ! \get_option( $value['options']['loop']['id'] ) ) {
			$bind_parameters['loop'] = false;
		}

		$fb_handler .= PHP_EOL . 'jQuery(\'' . $value['options']['tag']['default'] . '\').fancybox(jQuery.extend(true,{},fb_opts,' . \json_encode( $bind_parameters, JSON_NUMERIC_CHECK ) . '));';
	}

	$fb_handler .= '};';

	// Replace TitleFromAlt shortcode.
	$fb_handler = str_replace( '"{{titleFromAlt}}"', 'function(){var alt=DOMPurify.sanitize(this.element.find(\'img\').attr(\'alt\'));this.inner.find(\'img\').attr(\'alt\',alt);this.title=this.title||alt;}', $fb_handler );

	// Replace PDF embed shortcodes.
	if ( ! empty( get_option('fancybox_enablePDF') ) && ! empty( get_option('fancybox_PDFonStart', '{{object}}') ) ) {
		$replaces = array(
			'"{{object}}"'       => 'function(){this.type=\'html\';this.content=\'<object data="\'+this.href+\'" type="application/pdf" height="\'+this.width+\'" width="\'+this.height+\'" aria-label="\'+this.title+\'" />\'}',
			'"{{embed}}"'        => 'function(){this.type=\'html\';this.autoSize=false;this.content=\'<embed src="\'+this.href+\'" type="application/pdf" height="\'+this.width+\'" width="\'+this.height+\'" aria-label="\'+this.title+\'" />\'}',
			'"{{googleviewer}}"' => 'function(){this.href=\'https://docs.google.com/viewer?embedded=true&url=\'+this.href;}'
		);
		foreach ($replaces as $short => $replace) {
			$fb_handler = str_replace( $short, $replace, $fb_handler );
		}
	}

	// Build script.
	$script = 'var fb_timeout,fb_opts=' . \json_encode( $fb_opts, JSON_NUMERIC_CHECK ) . ',' . PHP_EOL .
	          'easy_fancybox_handler=easy_fancybox_handler||' . $fb_handler . '' . PHP_EOL;

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

	$script .= 'jQuery(easy_fancybox_handler);jQuery(document).on(\'' . implode( " ", \easyFancyBox::$events ) . '\',easy_fancybox_handler);' . PHP_EOL;

	if ( \easyFancyBox::$onready_auto ) {
		$script .= \apply_filters( 'easy_fancybox_onready_auto', 'jQuery(easy_fancybox_auto);' );
	}
	$script = \apply_filters( 'easy_fancybox_inline_script', $script );

	\easyFancyBox::$inline_scripts['jquery-fancybox'] = array(
		'data' => $script,
		'position' => 'after'
	);
}

/**
 * Prepares inline styles for Fancybox 2.
 *
 * @return void
 */
function prepare_inline_styles() {
	$styles = '';

	$background_color  = get_option( 'fancybox_backgroundColor' );
	$text_color        = get_option( 'fancybox_textColor' );
	$border_radius     = get_option( 'fancybox_borderRadius' );
	$padding_color     = get_option( 'fancybox_paddingColor' );
	$overlay_spotlight = get_option( 'fancybox_overlaySpotlight' );
	$title_color       = get_option( 'fancybox_titleColor' );

		// Content styles.
		$content_style                                = '';
		empty( $background_color ) || $content_style .= 'background:' . $background_color . ';';
		empty( $text_color ) || $content_style       .= 'color:' . $text_color . ';';

		// Skin styles.
		$skin_style                             = '';
		empty( $border_radius ) || $skin_style .= 'border-radius:' . $border_radius . 'px;';
		empty( $padding_color ) || $skin_style .= 'background:' . $padding_color . ';';

	// Overlay.
	empty( $overlay_spotlight ) || $styles .= '.fancybox-overlay{background-image:url("' . \easyFancyBox::$plugin_url . 'images/light-mask.png")!important;background-repeat:no-repeat!important;background-size:100% 100% !important}';
	// Content.
	empty( $content_style ) || $styles .= '.fancybox-inner{' . $content_style . '}';
	// Skin.
	empty( $skin_style ) || $styles .= '.fancybox-skin{' . $skin_style . '}';
	// Title.
	empty( $title_color ) || $styles .= '.fancybox-title{color:' . $title_color . '}';

	$styles = \apply_filters( 'easy_fancybox_inline_style', $styles );

	\easyFancyBox::$inline_styles['fancybox'] = \wp_strip_all_tags( $styles, true );
}

/**
 * Adds media support for Fancybox 2.
 */
function add_media() {
	static $add;

	if ( null === $add ) {
		$add = \get_option( 'fancybox_enableYoutube' ) ||
				\get_option( 'fancybox_enableVimeo' ) ||
				\get_option( 'fancybox_enableDailymotion' ) ||
				\get_option( 'fancybox_enableInstagram' ) ||
				\get_option( 'fancybox_enableGoogleMaps' );

		$add = apply_filters( 'easy_fancybox_add_media', $add );
	}

	return $add;
}

/**
 * Adds thumbnail navigation support for Fancybox 2.
 */
function add_thumbs() {
	static $add;

	if ( null === $add ) {
		$add = apply_filters( 'easy_fancybox_add_thumbs', false );
	}

	return $add;
}

/**
 * Adds button support for Fancybox 2.
 */
function add_buttons() {
	static $add;

	if ( null === $add ) {
		$add = apply_filters( 'easy_fancybox_add_buttons', false );
	}

	return $add;
}

/**
 * Adds easing support for Fancybox 2.
 */
function add_easing() {
	// Check IMG settings.
	if ( \get_option( 'fancybox_enableImg', \easyFancyBox::$options['Global']['options']['Enable']['options']['IMG']['default'] ) &&
		(
			( 'linear' !== \get_option( 'fancybox_easingIn', '' ) && '' !== \get_option( 'fancybox_easingIn', '' ) ) ||
			( 'linear' !== \get_option( 'fancybox_easingOut', '' ) && '' !== \get_option( 'fancybox_easingOut', '' ) )
		)
	) {
		return true;
	}

	// Check Inline Content settings.
	if ( \get_option( 'fancybox_enableInline', false ) &&
		(
			( 'linear' !== \get_option( 'fancybox_easingInInline', '' ) && '' !== \get_option( 'fancybox_easingInInline', '' ) ) ||
			( 'linear' !== \get_option( 'fancybox_easingOutInline', '' ) && '' !== \get_option( 'fancybox_easingOutInline', '' ) )
		)
	) {
		return true;
	}

	return false;
}

/**
 * Prepares and enqueues scripts and styles for Fancybox 2.
 */
function prepare_scripts_styles() {
	// Make sure whe actually need to do anything.
	if ( ! \easyFancyBox::add_scripts() ) {
		return;
	}

	// Inline script and style.
	prepare_inline_scripts();
	prepare_inline_styles();

	// Script and style urls.
	$dep    = get_option( 'fancybox_nojQuery', false ) ? array( 'fancybox-purify' ) : array( 'fancybox-purify', 'jquery' );
	$ver    = defined( 'WP_DEBUG' ) && WP_DEBUG ? time() : false;
	$min    = defined( 'WP_DEBUG' ) && WP_DEBUG ? '' : '.min';
	$footer = get_option( 'fancybox_noFooter', false ) ? false : true;

	// https://cdnjs.com/libraries/fancybox.

	// FancyBox.
	\easyFancyBox::$styles['fancybox']         = array(
		'src'   => \easyFancyBox::$plugin_url . 'fancybox/' . FANCYBOX_VERSIONS['fancyBox2'] . '/jquery.fancybox' . $min . '.css',
		'deps'  => array(),
		'ver'   => $ver,
		'media' => 'screen',
	);
	\easyFancyBox::$scripts['jquery-fancybox'] = array(
		'src'    => \easyFancyBox::$plugin_url . 'fancybox/' . FANCYBOX_VERSIONS['fancyBox2'] . '/jquery.fancybox' . $min . '.js',
		'deps'   => $dep,
		'ver'    => $ver,
		'footer' => $footer,
	);

	// Fancybox Media Helpers.
	if ( add_media() ) {
		\easyFancyBox::$scripts['jquery-fancybox-media'] = array(
			'src'    => \easyFancyBox::$plugin_url . 'fancybox/' . FANCYBOX_VERSIONS['fancyBox2'] . '/helpers/jquery.fancybox-media' . $min . '.js',
			'deps'   => array( 'jquery-fancybox' ),
			'ver'    => $ver,
			'footer' => $footer,
		);
	}

	// Fancybox Thumbs Helpers.
	if ( add_thumbs() ) {
		\easyFancyBox::$styles['fancybox-thumbs']         = array(
			'src'   => \easyFancyBox::$plugin_url . 'fancybox/' . FANCYBOX_VERSIONS['fancyBox2'] . '/helpers/jquery.fancybox-thumbs' . $min . '.css',
			'deps'  => array( 'fancybox' ),
			'ver'   => $ver,
			'media' => 'screen',
		);
		\easyFancyBox::$scripts['jquery-fancybox-thumbs'] = array(
			'src'    => \easyFancyBox::$plugin_url . 'fancybox/' . FANCYBOX_VERSIONS['fancyBox2'] . '/helpers/jquery.fancybox-thumbs' . $min . '.js',
			'deps'   => array( 'jquery-fancybox' ),
			'ver'    => $ver,
			'footer' => $footer,
		);
	}

	// Fancybox Buttons Helpers.
	if ( add_thumbs() ) {
		\easyFancyBox::$styles['fancybox-buttons']         = array(
			'src'   => \easyFancyBox::$plugin_url . 'fancybox/' . FANCYBOX_VERSIONS['fancyBox2'] . '/helpers/jquery.fancybox-buttons' . $min . '.css',
			'deps'  => array( 'fancybox' ),
			'ver'   => $ver,
			'media' => 'screen',
		);
		\easyFancyBox::$scripts['jquery-fancybox-buttons'] = array(
			'src'    => \easyFancyBox::$plugin_url . 'fancybox/' . FANCYBOX_VERSIONS['fancyBox2'] . '/helpers/jquery.fancybox-buttons' . $min . '.js',
			'deps'   => array( 'jquery-fancybox' ),
			'ver'    => $ver,
			'footer' => $footer,
		);
	}

	// jQuery Easing, which is not needed if Easing is set to swing or linear.
	if ( add_easing() ) {
		\easyFancyBox::$easing_script_url = \easyFancyBox::$plugin_url . 'vendor/jquery.easing.min.js';
	}

	// jQuery Mousewheel, which is not needed if jQueryUI Mouse is loaded or when using fancyBox 3.
	if ( \get_option( 'fancybox_mouseWheel', true ) ) {
		\easyFancyBox::$mousewheel_script_url = \easyFancyBox::$plugin_url . 'vendor/jquery.mousewheel.min.js';
	}

	// Metadata in Miscellaneous settings?
	if ( \get_option( 'fancybox_metaData' ) ) {
		\easyFancyBox::$scripts['jquery-metadata'] = array(
			'src'    => \easyFancyBox::$plugin_url . 'vendor/jquery.metadata.min.js',
			'deps'   => $dep,
			'ver'    => METADATA_VERSION,
			'footer' => $footer,
		);
	}
}
\add_action( 'init', __NAMESPACE__ . '\prepare_scripts_styles', 12 );
