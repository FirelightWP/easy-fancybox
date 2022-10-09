<?php
/**
 * Easy FancyBox Admin Class.
 */
class easyFancyBox_Admin extends easyFancyBox {

	/**
	* Holds the values to be used in the fields callbacks
	*/
	private static $screen_id;

	private static $compat_pro_min = '1.8';

	private static $do_compat_warning = false;

	/**
	 * ADMIN METHODS
	 */

	public static function add_settings_section()
	{
 		add_settings_section( 'fancybox_section', __( 'FancyBox', 'easy-fancybox' ), array( __CLASS__, 'settings_section' ), 'media');
 	}

	/**
	* Add options page
	*/
	public static function add_settings_page()
	{
		// This page will be under "Settings"
		self::$screen_id = add_options_page (
		  __( 'FancyBox', 'easy-fancybox' ),
		  __( 'FancyBox', 'easy-fancybox' ),
		  'manage_options',
		  'easy_fancybox',
		  array( __CLASS__, 'settings_page' ),
		  5
		);
	}

	public static function settings_page()
	{
		/** GENERAL */
		add_settings_section( 'easy_fancybox_general_section', /*'<a name="xmlsf"></a>'.__('XML Sitemap','xml-sitemap-feed')*/ '', '', 'easy_fancybox_general' );
		add_settings_field( 'easy_fancybox_media', __( 'Media', 'easy-fancybox' ), array( __CLASS__, 'media_fields' ), 'easy_fancybox_general', 'easy_fancybox_general_section' );

		/** GENERAL */


	}

	public static function add_settings_fields()
	{

	}

	public static function register_settings( $args = array() )
	{
		// Version.
		add_settings_field( 'fancybox_Version', esc_html__('Version','easy-fancybox'), function(){ include EASY_FANCYBOX_DIR . '/views/settings-field-version.php'; }, 'media', 'fancybox_section', array('label_for'=>'fancybox_scriptVersion') );
		register_setting( 'media', 'fancybox_scriptVersion', 'sanitize_text_field' );

		if ( empty( $args ) ) {
			$args = parent::$options;
		}

		foreach ( $args as $key => $value ) {
			// Check to see if the section is enabled, else skip to next.
			if ( ! isset( $value['input'] ) ||
				array_key_exists($key, parent::$options['Global']['options']['Enable']['options']) &&
				!get_option( parent::$options['Global']['options']['Enable']['options'][$key]['id'], parent::$options['Global']['options']['Enable']['options'][$key]['default'])
			) {
				continue;
			}

			switch( $value['input'] ) {
				case 'deep':
					// Go deeper by looping back on itself.
					self::register_settings($value['options']);
					break;

				case 'multiple':
					add_settings_field( 'fancybox_'.$key, '<a name="'.$key.'"></a>'.$value['title'], array( __CLASS__, 'settings_fields' ), 'media', 'fancybox_section', $value);
					foreach ( $value['options'] as $_value ) {
						if ( !isset($_value['sanitize_callback']) )
							$sanitize_callback = '';
						else
							$sanitize_callback = array( __CLASS__, $_value['sanitize_callback'] );
						if ( isset($_value['id']) )
							register_setting( 'media', $_value['id'], $sanitize_callback );
						//register_setting( 'media', $_value['id'], isset($_value['sanitize_callback']) ? array( __CLASS__, $_value['sanitize_callback'] ) : '' );
					}
					break;

				default:
					if ( !isset($value['sanitize_callback']) )
						$sanitize_callback = '';
					else
						$sanitize_callback = array(__CLASS__, $value['sanitize_callback']);
					if ( isset($value['id']) )
						register_setting( 'media', 'fancybox_'.$key, $sanitize_callback );
			}
		}
	}

	// Add our FancyBox Media Settings Section on Settings > Media admin page.
	public static function settings_section()
	{
		include EASY_FANCYBOX_DIR . '/views/settings-section.php';
	}

	// Add our FancyBox Media Settings Fields.
	public static function settings_fields( $args )
	{
		$output = array();

		if ( isset( $args['input'] ) ) :

			switch( $args['input'] ) {

				case 'multiple':
				case 'deep':
					foreach ( $args['options'] as $options ) {
						self::settings_fields( $options );
					}
					if ( isset( $args['description'] )) {
						$output[] = $args['description'];
					}
					break;

				case 'select':
					if ( ! empty( $args['label_for'] ) ) {
						$output[] = '<label for="'.$args['label_for'].'">'.$args['title'].'</label> ';
					} else {
						$output[] = $args['title'];
					}
					$output[] = '<select name="'.$args['id'].'" id="'.$args['id'].'">';
					foreach ( $args['options'] as $optionkey => $optionvalue ) {
						$output[] = '<option value="'.esc_attr( $optionkey ).'"'. selected( get_option( $args['id'], $args['default'] ) == $optionkey, true, false ) .' '. disabled( isset( $args['status']) && 'disabled' == $args['status'], true, false ) .' >'.$optionvalue.'</option>';
					}
					$output[] = '</select> ';
					if ( empty( $args['label_for'] ) ) {
						$output[] = '<label for="'.$args['id'].'">'.$args['description'].'</label> ';
					} else {
						if ( isset( $args['description'] ) ) {
							$output[] = $args['description'];
						}
					}
					break;

				case 'checkbox':
					if ( ! empty($args['label_for']) ) {
						$output[] = '<label for="'.$args['label_for'].'">'.$args['title'].'</label> ';
					} else {
						if ( isset($args['title']) ) {
							$output[] = $args['title'];
						}
					}
					if ( empty($args['label_for']) ) {
						$output[] = '<label><input type="checkbox" name="'.$args['id'].'" id="'.$args['id'].'" value="1" '. checked( get_option( $args['id'], $args['default'] ), true, false ) .' '. disabled( isset( $args['status']) && 'disabled' == $args['status'], true, false ) .' /> '.$args['description'].'</label><br />';
					} else {
						$output[] = '<input type="checkbox" name="'.$args['id'].'" id="'.$args['id'].'" value="1" '. checked( get_option( $args['id'], $args['default'] ), true, false ) .' '. disabled( isset( $args['status']) && 'disabled' == $args['status'], true, false ) .' /> '.$args['description'].'<br />';
					}
					break;

				case 'text':
				case 'color': // TODO make color picker available for color values but do NOT use type="color" because that does not allow empty fields!
					if ( ! empty( $args['label_for'] ) ) {
						$output[] = '<label for="'.$args['label_for'].'">'.$args['title'].'</label> ';
					} else {
						$output[] = $args['title'];
					}
					$output[] = '<input type="text" name="'.$args['id'].'" id="'.$args['id'].'" value="'.esc_attr( get_option($args['id'], $args['default']) ).'" class="'.$args['class'].'"'. disabled( isset( $args['status']) && 'disabled' == $args['status'], true, false ) .' /> ';
					if ( empty( $args['label_for'] ) ) {
						$output[] = '<label for="'.$args['id'].'">'.$args['description'].'</label> ';
					} else {
						if ( isset( $args['description'] ) ) {
							$output[] = $args['description'];
						}
					}
					break;

				case 'number':
					if ( ! empty( $args['label_for'] ) ) {
						$output[] = '<label for="'.$args['label_for'].'">'.$args['title'].'</label> ';
					} else {
						$output[] = $args['title'];
					}
					$output[] = '<input type="number" step="'.$args['step'].'" min="'.$args['min'].'" max="'.$args['max'].'" name="'.$args['id'].'" id="'.$args['id'].'" value="'.esc_attr( get_option($args['id'], $args['default']) ).'" class="'.$args['class'].'"'. disabled( isset( $args['status']) && 'disabled' == $args['status'], true, false ) .' /> ';
					if ( empty( $args['label_for'] ) ) {
						$output[] = '<label for="'.$args['id'].'">'.$args['description'].'</label> ';
					} else {
						if ( isset( $args['description'] ) ) {
							$output[] = $args['description'];
						}
					}
					break;

				case 'hidden':
					$output[] = '<input type="hidden" name="'.$args['id'].'" id="'.$args['id'].'" value="'.esc_attr( get_option($args['id'], $args['default']) ).'" /> ';
					break;

				default:
					if ( isset( $args['description'] ) ) {
						$output[] = $args['description'];
					}
			}

		else :

			if ( isset( $args['description'] ) ) {
				$output[] = $args['description'];
			}

		endif;

		echo implode( '', $output );
	}

	/**
	 * Adds an action link to the Plugins page.
	 */
	public static function add_action_link( $links )
	{
		array_unshift( $links, '<a href="' . admin_url('options-media.php') . '">' . translate('Settings') . '</a>' );

		return $links;
	}

	/**
	* Adds links to plugin's description.
	*/
	public static function plugin_meta_links( $links, $file )
	{
	  if ( $file == parent::$plugin_basename ) {
	    $links[] = '<a target="_blank" href="https://wordpress.org/support/plugin/easy-fancybox/">' . __('Support','easy-fancybox') . '</a>';
	    $links[] = '<a target="_blank" href="https://wordpress.org/support/plugin/easy-fancybox/reviews/?filter=5#new-post">' . __('Rate ★★★★★','easy-fancybox') . '</a>';
	  }

	  return $links;
	}

	/***
	 * Santize Callbacks.
	 */

	public static function intval( $setting = '' )
	{
		if ($setting == '')
			return '';

		if (substr($setting, -1) == '%') {
			$val = intval(substr($setting, 0, -1));
			$prc = '%';
		} else {
			$val = intval($setting);
			$prc = '';
		}

		return ( $val != 0 ) ? $val.$prc : 0;
	}

	public static function colorval( $setting = '' ) {
		$setting = trim( $setting );
		$sanitized = '';

		// Is it a hex value?
		if ( substr( $setting, 0, 1 ) == '#' ) {
			// Strip #.
			$setting = substr( $setting, 1 );

			// Only allow hex values or empty string.
			$sanitized = ctype_xdigit( $setting ) ? '#'.$setting : '';
		}

		// Is it an rgb value?
		if ( substr( $setting, 0, 3 ) == 'rgb' ) {
			// Strip...
			$setting = str_replace( array('rgb(','rgba(',')'), '', $setting );

			$rgb_array = explode( ',', $setting );

			if ( $rgb_array ) {
				$r = isset( $rgb_array[0] ) ? (int) $rgb_array[0] : 119;
				$g = isset( $rgb_array[1] ) ? (int) $rgb_array[1] : 119;
				$b = isset( $rgb_array[2] ) ? (int) $rgb_array[2] : 119;
				$a = isset( $rgb_array[3] ) ? (float) $rgb_array[3] : 0.7;
				$sanitized = 'rgba('.$r.','.$g.','.$b.','.$a.')';
			}
		}

		return $sanitized;
	}

	public static function csl_text( $setting = '' ) {
		$settings_array = explode( ',', $setting );

		$sanitized_array = array();
		foreach ( $settings_array as $text ) {
			if ( empty( $text ) ) {
				continue;
			}
			$sanitized_array[] = sanitize_text_field( $text );
		}

		$json = wp_json_encode( $sanitized_array );
		if ( ! $json ) {
			return '';
		}
		$sanitized_array = json_decode( $json );
		$sanitized = implode( ',', $sanitized_array );

		return $sanitized;
	}

	/***********************
	    ACTIONS & FILTERS
	 ***********************/

	public static function admin_notice()
	{
		global $current_user;

		if ( get_user_meta( $current_user->ID, 'easy_fancybox_ignore_notice' ) || ! current_user_can( 'install_plugins' ) ) {
			return;
		}

		/* Version Nag */
		if ( self::$do_compat_warning ) {
			include EASY_FANCYBOX_DIR . '/views/admin-notice.php';
		}
	}

	public static function load_textdomain()
	{
		load_plugin_textdomain('easy-fancybox', false, dirname( parent::$plugin_basename ) . '/languages' );
	}

	public static function admin_init()
	{
		/* Dismissable notice */
		/* If user clicks to ignore the notice, add that to their user meta */
		global $current_user;

		if ( isset( $_GET['easy_fancybox_ignore_notice'] ) && '1' == $_GET['easy_fancybox_ignore_notice'] ) {
			add_user_meta( $current_user->ID, 'easy_fancybox_ignore_notice', 'true', true );
		}

		if (
			class_exists( 'easyFancyBox_Advanced' ) &&
			( ! defined( 'easyFancyBox_Advanced::VERSION' ) || version_compare( easyFancyBox_Advanced::VERSION, self::$compat_pro_min, '<' ) )
		) {
			self::$do_compat_warning = true;
		}

	}

	/**
	 * RUN
	 */

	public function __construct()
	{
		add_action( 'plugins_loaded', array(__CLASS__, 'load_textdomain') );
		add_action( 'admin_notices', array(__CLASS__, 'admin_notice') );
		add_filter( 'plugin_action_links_'.parent::$plugin_basename, array(__CLASS__, 'add_action_link') );

		add_action( 'admin_menu', array(__CLASS__, 'add_settings_page') );

		add_action( 'admin_init', array(__CLASS__, 'add_settings_section') );
		add_action( 'admin_init', array(__CLASS__, 'register_settings') );
		add_action( 'admin_init', array(__CLASS__, 'admin_init') );
	}
}
