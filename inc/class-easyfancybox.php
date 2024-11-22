<?php
/**
 * This file defines the main easyFancyBox class for the plugin.
 *
 * @package   Easy_FancyBox
 * @author    FirelightWP
 * @license GPL-2.0+
 *
 * @version 1.0.0
 */

/**
 * The main Easy FancyBox class.
 *
 * Handles general and frontend logic.
 * The easyFancyBox_Admin handles admin logic.
 *
 * Class name should uppercase, but defined as lowercase long ago.
 * We leave it as is for backward compatibility.
 *
 * @since 1.0.0
 */
class easyFancyBox { // phpcs:ignore

	/**
	 * URL for the plugin.
	 *
	 * @var string
	 */
	public static $plugin_url;

	/**
	 * Priority level for the plugin.
	 *
	 * @var int
	 */
	public static $priority;

	/**
	 * Base name for the plugin.
	 *
	 * @var string
	 */
	public static $plugin_basename;

	/**
	 * Flag to determine if scripts should be added.
	 *
	 * @var bool
	 */
	public static $add_scripts;

	/**
	 * Array to store styles.
	 *
	 * @var array
	 */
	public static $styles = array();

	/**
	 * Array to store inline styles.
	 *
	 * @var array
	 */
	public static $inline_styles = array();

	/**
	 * Array to store scripts.
	 *
	 * @var array
	 */
	public static $scripts = array();

	/**
	 * Array to store inline scripts.
	 *
	 * @var array
	 */
	public static $inline_scripts = array();

	/**
	 * URL for the style.
	 *
	 * @var string
	 */
	public static $style_url;

	/**
	 * URL for the IE-specific style.
	 *
	 * @var string
	 */
	public static $style_ie_url;

	/**
	 * URL for the script.
	 *
	 * @var string
	 */
	public static $script_url;

	/**
	 * Inline script.
	 *
	 * @var string
	 */
	public static $inline_script;

	/**
	 * Inline style.
	 *
	 * @var string
	 */
	public static $inline_style;

	/**
	 * IE-specific inline style.
	 *
	 * @var string
	 */
	public static $inline_style_ie;

	/**
	 * URL for the easing script.
	 *
	 * @var string
	 */
	public static $easing_script_url;

	/**
	 * URL for the mousewheel script.
	 *
	 * @var string
	 */
	public static $mousewheel_script_url;

	/**
	 * URL for the metadata script.
	 *
	 * @var string
	 */
	public static $metadata_script_url;

	/**
	 * Flag to determine if onready_auto is enabled.
	 *
	 * @var bool
	 */
	public static $onready_auto = false;

	/**
	 * Array to store options.
	 *
	 * @var array
	 */
	public static $options = array();

	/**
	 * Array to store events.
	 *
	 * @var array
	 */
	public static $events = array( 'post-load' );

	/**
	 * URL for the pro plugin.
	 *
	 * @var string
	 */
	public static $pro_plugin_url = 'https://firelightwp.com/pro-lightbox/';

	/**
	 * Array to store free lightboxes.
	 *
	 * @var array
	 */
	public static $free_lightboxes;

	/**
	 * Constructor for the class.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return void
	 */
	public function __construct() {
		global $wp_version;
		self::$plugin_url      = plugins_url( '/', EASY_FANCYBOX_BASENAME /* EASY_FANCYBOX_DIR.'/easy-fancybox.php' */ );

		self::$free_lightboxes = array(
			'legacy'          => 'FancyBox Legacy',
			'classic'         => 'FancyBox Classic Reloaded',
			'fancyBox2'       => 'FancyBox V2',
			'fancybox5-promo' => 'Firelight Pro Lightbox',
		);

		// Frontend hooks.
		add_action( 'init', array( __CLASS__, 'extend' ), 9 );

		// Disable core lightbox.
		if (
			isset( $wp_version )
			&& version_compare( $wp_version, '6.5.0' ) >= 0
			&& self::should_disable_core_lightbox()
		) {
			add_action( 'wp_enqueue_scripts', array( __CLASS__, 'disable_core_lightbox_on_frontend' ), 99 );
			add_filter( 'wp_theme_json_data_user', array( __CLASS__, 'hide_core_lightbox_in_editor' ) );
		}
	}

	/**
	 * Retrieve the lightboxes.
	 *
	 * Gets list of available lightboxes.
	 * Also defines firelight_get_lightboxes filter that
	 * can be used elsewhere to add lightboxes to the array.
	 *
	 * @since 2.0.0
	 * @access public
	 *
	 * @return array Returns an array of lightboxes.
	 */
	public static function get_lightboxes() {
		return apply_filters( 'firelight_get_lightboxes', self::$free_lightboxes );
	}

	/**
	 * Enqueue scripts and styles.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return void
	 */
	public static function enqueue_scripts() {
		// Make sure whe actually need to do anything.
		if ( ! self::add_scripts() ) {
			return;
		}

		global $wp_styles;
		$_dep    = get_option( 'fancybox_nojQuery', false ) ? array( 'fancybox-purify' ) : array( 'fancybox-purify', 'jquery' );
		$_ver    = defined( 'WP_DEBUG' ) && WP_DEBUG ? time() : false;
		$_footer = get_option( 'fancybox_noFooter', false ) ? false : true;

		// Register DomPurify Script for use below and elsewhere.
		$purify_script_url = \easyFancyBox::$plugin_url . 'vendor/purify.min.js';
		wp_register_script( 'fancybox-purify', $purify_script_url, array(), $_ver, $_footer );

		// Enqueue styles.
		if ( ! empty( self::$styles ) ) {
			foreach ( self::$styles as $handle => $options ) {
				$src   = ! empty( $options['src'] ) ? $options['src'] : '';
				$deps  = ! empty( $options['deps'] ) ? (array) $options['deps'] : array();
				$ver   = ! empty( $options['ver'] ) ? $options['ver'] : $_ver;
				$media = ! empty( $options['media'] ) ? $options['media'] : 'all';
				wp_enqueue_style( $handle, $src, $deps, $ver, $media );
				if ( ! empty( $options['conditional'] ) ) {
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

		// Enqueue JS.
		if ( ! empty( self::$scripts ) ) {
			foreach ( self::$scripts as $handle => $options ) {
				$src  = ! empty( $options['src'] ) ? $options['src'] : '';
				$deps = ! empty( $options['deps'] ) ? (array) $options['deps'] : array();
				$ver  = ! empty( $options['ver'] ) ? $options['ver'] : $_ver;
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
		if ( ! empty( self::$inline_styles ) ) {
			foreach ( self::$inline_styles as $handle => $data ) {
				if ( function_exists( 'wp_add_inline_style' ) && ! get_option( 'fancybox_pre45Compat', false ) ) {
					wp_add_inline_style( $handle, $data );
				} else {
					// Do it the old way.
					add_action(
						'wp_head',
						function () use ( $data ) {
							print( '<style id="fancybox-inline-css" type="text/css">' . $data . '</style>' );
						},
						self::priority()
					);
				}
			}
		} else { // phpcs:ignore
			if ( function_exists( 'wp_add_inline_style' ) && ! get_option( 'fancybox_pre45Compat', false ) ) {
				empty( self::$inline_style ) || wp_add_inline_style( 'fancybox', self::$inline_style );
				empty( self::$inline_style_ie ) || wp_add_inline_style( 'fancybox-ie', self::$inline_style_ie );
			} else {
				// Do it the old way.
				empty( self::$inline_style ) || add_action(
					'wp_head',
					function () {
						print(
							'<style id="fancybox-inline-css" type="text/css">' . self::$inline_style . '</style>'
						);
					},
					self::priority()
				);
				empty( self::$inline_style_ie ) || add_action(
					'wp_head',
					function () {
						print( '<!--[if lt IE 9]><style id="fancybox-inline-css-ie" type="text/css">' . self::$inline_style_ie . '</style><![endif]-->' );
					},
					self::priority()
				);
			}
		}

		// Inline scripts.
		if ( ! empty( self::$inline_scripts ) ) {
			foreach ( self::$inline_scripts as $handle => $data ) {
				if ( is_array( $data ) ) {
					$position = ! empty( $data['position'] ) ? $data['position'] : 'after';
					$data     = ! empty( $data['data'] ) ? $data['data'] : '';
				}
				if ( function_exists( 'wp_add_inline_script' ) && ! get_option( 'fancybox_pre45Compat', false ) ) {
					wp_add_inline_script( $handle, $data, $position );
				} else {
					// Do it the old way.
					$priority = self::priority();
					if ( 'after' !== $position ) {
						$priority = $priority - 1; // phpcs:ignore
					}
					add_action(
						$_footer ? 'wp_footer' : 'wp_head',
						function () use ( $data ) {
							print( '<script type="text/javascript">' . $data . '</script>' );
						},
						$priority
					);
				}
			}
		} else { // phpcs:ignore
			if ( function_exists( 'wp_add_inline_script' ) && ! get_option( 'fancybox_pre45Compat', false ) ) {
				empty( self::$inline_script ) || wp_add_inline_script( 'jquery-fancybox', self::$inline_script );
			} else {
				// Do it the old way.
				empty( self::$inline_script ) || add_action(
					$_footer ? 'wp_footer' : 'wp_head',
					function () {
						print( '<script type="text/javascript">' . self::$inline_script . '</script>' );
					},
					self::priority()
				);
			}
		}
	}

	/**
	 * Determines if the core lightbox should be disabled.
	 *
	 * @since 2.0.0
	 * @access public
	 *
	 * @return bool Returns true if the core lightbox should be disabled, false otherwise.
	 */
	public static function should_disable_core_lightbox() {
		$selected_lightbox = get_option( 'fancybox_scriptVersion', 'classic' );
		$is_free_lightbox  = in_array( $selected_lightbox, array_keys( self::$free_lightboxes ), true );
		$is_pro_lightbox   = 'fancybox5' === $selected_lightbox;

		$disable_for_free_lightboxes = get_option( 'fancybox_disableCoreLightbox', true );
		$disable_for_pro_lightbox    = get_option( 'fancybox5_disable_core_lightbox', true );

		if ( $is_free_lightbox && $disable_for_free_lightboxes ) {
			return true;
		}

		if ( $is_pro_lightbox && $disable_for_pro_lightbox ) {
			return true;
		}

		return false;
	}

	/**
	 * Disables the core lightbox on the frontend.
	 *
	 * Details:
	 * https://github.com/WordPress/gutenberg/blob/8dc36f6d30cc163671bdaa33f0656fdfe91f1447/packages/block-library/src/image/index.php#L64
	 *
	 * @since 2.0.0
	 * @access public
	 *
	 * @return void
	 */
	public static function disable_core_lightbox_on_frontend() {
		if ( function_exists( 'wp_dequeue_script_module' ) ) {
			wp_dequeue_script_module( '@wordpress/block-library/image' );
		}
		remove_filter( 'render_block_core/image', 'block_core_image_render_lightbox', 15 );
		remove_filter( 'render_block_core/image', 'block_core_image_render_lightbox', 15, 2 );
	}


	/**
	 * Hides the core lightbox in the editor.
	 * Does this by filtering $theme_json.
	 *
	 * @since 2.0.0
	 * @access public
	 *
	 * @param obj $theme_json The theme JSON configuration.
	 *
	 * @return obj Filtered theme_json.
	 */
	public static function hide_core_lightbox_in_editor( $theme_json ) {
		$new_data = array(
			'version'  => 2,
			'settings' => array(
				'blocks' => array(
					'core/image' => array(
						'lightbox' => array(
							'allowEditing' => false,
							'enabled'      => false,
						),
					),
				),
			),
		);
		return $theme_json->update_with( $new_data );
	}

	/**
	 * Add video wmode opaque.
	 *
	 * Hack to fix missing wmode in Youtube oEmbed code based on David C's code in the comments on
	 * http://www.mehigh.biz/wordpress/adding-wmode-transparent-to-wordpress-3-media-embeds.html
	 * without the wmode, videos will float over the light box no matter what z-index is set.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @param string $html Content to filter.
	 * @return string $html Fitlered content.
	 */
	public static function add_video_wmode_opaque( $html ) {
		// Make sure whe actually need this at all.
		if ( ! self::add_scripts() ) {
			return $html;
		}

		if ( strpos( $html, '<embed src=' ) !== false ) {
			$html = str_replace( '</param><embed', '</param><param name="wmode" value="opaque"></param><embed wmode="opaque"', $html );
		} elseif ( strpos( $html, 'youtube' ) !== false && strpos( $html, 'wmode' ) === false ) {
			$html = str_replace( 'feature=oembed', 'feature=oembed&amp;wmode=opaque', $html );
		} elseif ( strpos( $html, 'vimeo' ) !== false && strpos( $html, 'wmode' ) === false ) {
			$html = str_replace( '" width', '?theme=none&amp;wmode=opaque" width', $html );
		} elseif ( strpos( $html, 'dailymotion' ) !== false && strpos( $html, 'wmode' ) === false ) {
			$html = str_replace( '" width', '?wmode=opaque" width', $html );
		}

		return $html;
	}

	/**
	 * Get or set the priority.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return int Returns the priority of the object.
	 */
	public static function priority() {
		if ( null === self::$priority ) {
			$priority = get_option( 'fancybox_scriptPriority' );

			self::$priority = is_numeric( $priority ) ? (int) $priority : 10;
		}

		return self::$priority;
	}

	/**
	 * Add scripts to the page.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return bool $add_scripts
	 */
	public static function add_scripts() {
		if ( null === self::$add_scripts ) {
			_doing_it_wrong( __FUNCTION__, 'Method easyFancyBox::add_scripts() has been called before init.', '2.0' );
			return false;
		}

		return self::$add_scripts;
	}

	/**
	 * Applies fancybox lightbox based on which lightbox is selected.
	 *
	 * This only handles the original fancybox scripts for now.
	 * If Pro lightbox is selected, switch here will not load anything.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return void
	 */
	public static function extend() {
		$script_version = get_option( 'fancybox_scriptVersion', 'classic' );
		if ( empty( self::$options ) ) {
			include EASY_FANCYBOX_DIR . '/inc/fancybox-options.php';
			self::$options = $efb_options;
		}
		foreach ( self::$options['Global']['options']['Enable']['options'] as $value ) {
			if ( isset( $value['id'] ) && '1' === get_option( $value['id'], $value['default'] ) ) {
				self::$add_scripts = true;
				break;
			} else {
				self::$add_scripts = false;
			}
		}

		switch ( $script_version ) {
			case 'legacy':
				include EASY_FANCYBOX_DIR . '/inc/fancybox-legacy.php';
				break;
			case 'fancyBox2':
				include EASY_FANCYBOX_DIR . '/inc/fancybox-2.php';
				if ( ! class_exists( 'easyFancyBox_Admin' ) ) {
					include EASY_FANCYBOX_DIR . '/inc/class-easyfancybox-admin.php';
				}
				self::$options = easyFancyBox_Admin::rename_fb2_options( self::$options );
				break;
			case 'classic':
				include EASY_FANCYBOX_DIR . '/inc/fancybox-classic.php';
				break;
			default:
				break;
		}

		add_action( 'wp_enqueue_scripts', array( __CLASS__, 'enqueue_scripts' ), self::priority() );
	}
}
