<?php
/**
 * Easy FancyBox Class
 */

class easyFancyBox {

	public static $plugin_url;

	public static $priority;

	public static $plugin_basename;

	public static $add_scripts;

	public static $styles         = array();
	public static $inline_styles  = array();
	public static $scripts        = array();
	public static $inline_scripts = array();

	public static $style_url;

	public static $style_ie_url;

	public static $script_url;

	public static $inline_script;

	public static $inline_style;

	public static $inline_style_ie;

	public static $easing_script_url;

	public static $mousewheel_script_url;

	public static $metadata_script_url;

	public static $onready_auto = false;

	public static    $options = array();

	public static    $events = array( 'post-load' );

	public static    $pro_plugin_url = "https://premium.status301.com/downloads/easy-fancybox-pro/";

	/**
	 * ACTIONS & FILTERS
	 */

	public static function enqueue_scripts()
	{
		// Make sure whe actually need to do anything.
		if ( ! self::add_scripts() ){
			return;
		}

		global $wp_styles;
		$_dep    = get_option( 'fancybox_nojQuery', false ) ? array() : array( 'jquery' );
		$_ver    = defined( 'WP_DEBUG' ) && WP_DEBUG ? time() : false;
		$_footer = get_option( 'fancybox_noFooter', false ) ? false : true;

		// ENQUEUE STYLES
		if ( !empty( self::$styles ) ) {
			foreach ( self::$styles as $handle => $options ) {
				$src   = ! empty( $options['src'] )   ?         $options['src']   : '';
				$deps  = ! empty( $options['deps'] )  ? (array) $options['deps']  : array();
				$ver   = ! empty( $options['ver'] )   ?         $options['ver']   : $_ver;
				$media = ! empty( $options['media'] ) ?         $options['media'] : 'all';
				wp_enqueue_style( $handle, $src, $deps, $ver, $media );
				if ( ! empty( $options['conditional']) ) {
					$wp_styles->add_data( $handle, 'conditional', $options['conditional'] );
				}
			}
		} else {
			wp_enqueue_style( 'fancybox', self::$style_url, array(), $_ver, 'screen' );
			if ( ! empty( self::$inline_style_ie ) ) {
				wp_enqueue_style( 'fancybox-ie', self::$style_ie_url, false, null, 'screen' );
				$wp_styles->add_data( 'fancybox-ie', 'conditional', 'lt IE 9' );
			}
		}

		// ENQUEUE SCRIPTS
		if ( !empty( self::$scripts ) ) {
			foreach ( self::$scripts as $handle => $options ) {
				$src   = ! empty( $options['src'] )   ?         $options['src']   : '';
				$deps  = ! empty( $options['deps'] )  ? (array) $options['deps']  : array();
				$ver   = ! empty( $options['ver'] )   ?         $options['ver']   : $_ver;
				wp_enqueue_script( $handle, $src, $deps, $ver, ! empty( $options['footer'] ) );
			}
		} else {
			// Register main fancybox script.
			wp_enqueue_script( 'jquery-fancybox', self::$script_url, $_dep, $_ver, $_footer );

			// Metadata in Miscellaneous settings?
			if ( ! empty( self::$metadata_script_url ) ) {
				wp_enqueue_script( 'jquery-metadata', self::$metadata_script_url, $_dep, METADATA_VERSION, $_footer );
			}
		}

		// jQuery Easing, which is not needed if jQueryUI Core Effects are loaded or when using fancyBox 3.
		if ( ! empty( self::$easing_script_url ) && ! wp_script_is( 'jquery-effects-core', 'enqueued' ) ) {
			wp_enqueue_script( 'jquery-easing', self::$easing_script_url, $_dep, EASING_VERSION, $_footer );
		}

		// jQuery Mousewheel, which is not needed if jQueryUI Mouse is loaded or when using fancyBox 3.
		if ( ! empty( self::$mousewheel_script_url ) && ! wp_script_is( 'jquery-ui-mouse', 'enqueued' ) ) {
			wp_enqueue_script( 'jquery-mousewheel', self::$mousewheel_script_url, $_dep, MOUSEWHEEL_VERSION, $_footer );
		}

		// Inline styles.
		if ( !empty( self::$inline_styles ) ) {
			foreach ( self::$inline_styles as $handle => $data ) {
				if ( function_exists( 'wp_add_inline_script' ) && ! get_option( 'fancybox_pre45Compat', false ) ) {
					wp_add_inline_style( $handle, $data );
				} else {
					// Do it the old way.
					add_action( 'wp_head', function() use ( $data ) { print( '<style id="fancybox-inline-css" type="text/css">' . $data . '</style>' ); }, 11 );
				}
			}
		} else {
			if ( function_exists( 'wp_add_inline_style' ) && ! get_option( 'fancybox_pre45Compat', false ) ) {
				empty( self::$inline_style )    || wp_add_inline_style( 'fancybox', self::$inline_style );
				empty( self::$inline_style_ie ) || wp_add_inline_style( 'fancybox-ie', self::$inline_style_ie );
			} else {
				// Do it the old way.
				empty( self::$inline_style )    || add_action( 'wp_head', function() { print( '<style id="fancybox-inline-css" type="text/css">' . self::$inline_style . '</style>' ); }, 11 );
				empty( self::$inline_style_ie ) || add_action( 'wp_head', function() { print( '<!--[if lt IE 9]><style id="fancybox-inline-css-ie" type="text/css">' . self::$inline_style_ie . '</style><![endif]-->' ); }, 12 );
			}
		}

		// Inline scripts.
		if ( !empty( self::$inline_scripts ) ) {
			foreach ( self::$inline_scripts as $handle => $data ) {
				if ( function_exists( 'wp_add_inline_script' ) && ! get_option( 'fancybox_pre45Compat', false ) ) {
					if ( is_array( $data ) ) {
						$position = ! empty( $data['position'] ) ? $data['position'] : 'after';
						$data = ! empty( $data['data'] ) ? $data['data'] : '';
					}
					wp_add_inline_script( $handle, $data, $position );
				} else {
					// Do it the old way.
					add_action( $footer ? 'wp_footer' : 'wp_head', function() { print( '<script type="text/javascript">' . self::$inline_script . '</script>' ); }, self::priority() + 1 );
				}
			}
		} else {
			if ( function_exists( 'wp_add_inline_script' ) && ! get_option( 'fancybox_pre45Compat', false ) ) {
				empty( self::$inline_script )   || wp_add_inline_script( 'jquery-fancybox', self::$inline_script );
			} else {
				// Do it the old way.
				empty( self::$inline_script )   || add_action( $footer ? 'wp_footer' : 'wp_head', function() { print( '<script type="text/javascript">' . self::$inline_script . '</script>' ); }, self::priority() + 1 );
			}
		}

	}

	// Hack to fix missing wmode in Youtube oEmbed code based on David C's code in the comments on
	// http://www.mehigh.biz/wordpress/adding-wmode-transparent-to-wordpress-3-media-embeds.html
	// without the wmode, videos will float over the light box no matter what z-index is set.
	public static function add_video_wmode_opaque( $html )
	{
		// Make sure whe actually need this at all.
		if ( ! self::add_scripts() ) {
			return $html;
		}

		if ( strpos($html, "<embed src=" ) !== false ) {
			$html = str_replace('</param><embed', '</param><param name="wmode" value="opaque"></param><embed wmode="opaque"', $html);
		} elseif ( strpos($html, 'youtube' ) !== false && strpos($html, 'wmode' ) == false ) {
			$html = str_replace('feature=oembed', 'feature=oembed&amp;wmode=opaque', $html);
		} elseif ( strpos($html, "vimeo" ) !== false  && strpos($html, 'wmode' ) == false ) {
			$html = str_replace('" width', '?theme=none&amp;wmode=opaque" width', $html);
		} elseif ( strpos($html, "dailymotion" ) !== false  && strpos($html, 'wmode' ) == false ) {
			$html = str_replace('" width', '?wmode=opaque" width', $html);
		}

		return $html;
	}

	public static function upgrade( $old_version )
	{
		// Upgrade from 1.7 or older.
		if ( ! $old_version ) {
			if ( 'html' === get_option('fancybox_PDFclassType') ) {
				update_option( 'fancybox_PDFonStart', 'function(a,i,o){o.type=\'pdf\';}' );
				delete_option( 'fancybox_PDFclassType' );
			}
		}

		// Upgrade from before 2.0.
		if ( version_compare( $old_version, '0', '>' ) && version_compare( $old_version, '2.0', '<' ) ) {
			// TODO figure out when to upgrade
			update_option( 'fancybox_scriptVersion', 'classic' );

			$onstart = get_option('fancybox_PDFonStart');
			if ( ! empty( $onstart ) ) {
				$replaces = array(
					'function(a,i,o){o.type=\'pdf\';}' => '{{object}}',
					'function(a,i,o){o.type=\'html\';o.content=\'<embed src="\'+a[i].href+\'" type="application/pdf" height="100%" width="100%" />\'}' => '{{embed}}',
					'function(a,i,o){o.href=\'https://docs.google.com/viewer?embedded=true&url=\'+a[i].href;}' => '{{googleviewer}}'
				);
				if ( array_key_exists( $onstart, $replaces ) ) {
					update_option( 'fancybox_PDFonStart', $replaces[$onstart] );
				} else {
					update_option( 'fancybox_PDFonStart', '{{object}}' );
				}
			}
			// OR convert fancybox_overlayColor and fancybox_overlayOpacity values to one rgba for new rgba fancybox_overlayColor:
			/*function hex2rgba($color, $opacity = false) {

				$default = 'rgb(0,0,0)';

				//Return default if no color provided
				if(empty($color))
					  return $default;

				//Sanitize $color if "#" is provided
					if ($color[0] == '#' ) {
						$color = substr( $color, 1 );
					}

					//Check if color has 6 or 3 characters and get values
					if (strlen($color) == 6) {
							$hex = array( $color[0] . $color[1], $color[2] . $color[3], $color[4] . $color[5] );
					} elseif ( strlen( $color ) == 3 ) {
							$hex = array( $color[0] . $color[0], $color[1] . $color[1], $color[2] . $color[2] );
					} else {
							return $default;
					}

					//Convert hexadec to rgb
					$rgb =  array_map('hexdec', $hex);

					//Check if opacity is set(rgba or rgb)
					if($opacity){
						if(abs($opacity) > 1)
							$opacity = 1.0;
						$output = 'rgba('.implode(",",$rgb).','.$opacity.')';
					} else {
						$output = 'rgb('.implode(",",$rgb).')';
					}

					//Return rgb(a) color string
					return $output;
			}*/
		}

		// Save new version.
		update_option( 'easy_fancybox_version', EASY_FANCYBOX_VERSION );
	}

	public static function priority()
	{
		if ( null === self::$priority ) {
			$priority = get_option( 'fancybox_scriptPriority' );

			self::$priority = is_numeric( $priority ) ? (int) $priority : 10;
		}

		return self::$priority;
	}

	public static function add_scripts()
	{
		if ( null === self::$add_scripts ) {
			_doing_it_wrong( __FUNCTION__, 'Method easyFancyBox::add_scripts() has been called before init.', '2.0' );
			return false;
		}

		return self::$add_scripts;
	}

	public static function maybe_upgrade()
	{
		$old_version = get_option( 'easy_fancybox_version', 0 );

		if ( 0 !== version_compare( EASY_FANCYBOX_VERSION, $old_version ) ) {
			self::upgrade( $old_version );
		}
	}

	public static function extend()
	{
		$script_version = get_option( 'fancybox_scriptVersion', 'classic' );
		if ( ! array_key_exists( $script_version, FANCYBOX_VERSIONS ) ) {
			$script_version = 'classic';
		}

		switch( $script_version ) {
			case 'legacy':
				include EASY_FANCYBOX_DIR . '/inc/fancybox-legacy.php';
				// Load defaults.
				if ( empty( self::$options ) ) {
					include EASY_FANCYBOX_DIR . '/inc/fancybox-legacy-options.php';
					self::$options = $efb_options;
				}
				// Check for any enabled sections to set the scripts flag.
				foreach ( self::$options['Global']['options']['Enable']['options'] as $value ) {
					if ( isset($value['id']) && '1' == get_option($value['id'],$value['default']) ) {
						self::$add_scripts = true;
						break;
					} else {
						self::$add_scripts = false;
					}
				}
				break;

			case 'fancyBox2':
				include EASY_FANCYBOX_DIR . '/inc/fancybox-2.php';
				// Load defaults.
				if ( empty( self::$options ) ) {
					include EASY_FANCYBOX_DIR . '/inc/fancybox-2-options.php';
					self::$options = $efb_options;
				}
				// Check for any enabled sections to set the scripts flag.
				foreach ( self::$options['Global']['options']['Enable']['options'] as $value ) {
					if ( isset($value['id']) && '1' == get_option($value['id'],$value['default']) ) {
						self::$add_scripts = true;
						break;
					} else {
						self::$add_scripts = false;
					}
				}
				break;

			case 'fancyBox3':
				//include EASY_FANCYBOX_DIR . '/inc/fancybox-3.php';
				break;

			case 'classic':
			default:
				include EASY_FANCYBOX_DIR . '/inc/fancybox-classic.php';
				// Load defaults.
				if ( empty( self::$options ) ) {
					include EASY_FANCYBOX_DIR . '/inc/fancybox-classic-options.php';
					self::$options = $efb_options;
				}
				// Check for any enabled sections to set the scripts flag.
				foreach ( self::$options['Global']['options']['Enable']['options'] as $value ) {
					if ( isset($value['id']) && '1' == get_option($value['id'],$value['default']) ) {
						self::$add_scripts = true;
						break;
					} else {
						self::$add_scripts = false;
					}
				}
		}

		add_action( 'wp_enqueue_scripts', array( __CLASS__, 'enqueue_scripts' ), self::priority() );
		//add_filter( 'embed_oembed_html',  array( __CLASS__, 'add_video_wmode_opaque' ) );
	}

	/**
	 * RUN
	 */

	public function __construct()
	{
		// VARS
		self::$plugin_url      = plugins_url( '/', EASY_FANCYBOX_DIR.'/easy-fancybox.php' );
		self::$plugin_basename = plugin_basename( EASY_FANCYBOX_DIR );

		add_action( 'init', array( __CLASS__, 'maybe_upgrade' ), 9 );
		add_action( 'init', array( __CLASS__, 'extend' ), 9 );
	}
}
