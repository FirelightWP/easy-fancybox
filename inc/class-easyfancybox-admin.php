<?php
/**
 * Easy FancyBox Admin Class.
 */
class easyFancyBox_Admin {

	private static $compat_pro_min = '1.8';

	private static $do_compat_warning = false;

	/**
	 * ADMIN METHODS
	 */
	public static function add_media_settings_section()
	{
		add_filter( 'easy_fancybox_enable', function() { return easyFancyBox::$options['Global']['options']['Enable']['options']; } );

 		add_settings_section( 'fancybox_section', '<a name="fancybox"></a>'.__( 'FancyBox', 'easy-fancybox' ), function() { include EASY_FANCYBOX_DIR . '/views/settings-section-intro.php'; }, 'media' );
 	}

	/**
	* Add options page
	*/
	public static function add_options_page()
	{
		// This page will be under "Settings".
		$screen_id = add_options_page (
			__( 'FancyBox', 'easy-fancybox' ),
			__( 'FancyBox', 'easy-fancybox' ),
			'manage_options',
			'easy_fancybox',
			array( __CLASS__, 'options_page' ),
			5
		);

		// Help tab.
		add_action(
			'load-'.$screen_id,
			array( __CLASS__, 'help_tab' )
		);

		add_filter( 'easy_fancybox_enable', function() {
			return array (
				'IMG' => array (
					'id' => 'fancybox_enableImg',
					'default' => ( function_exists( 'is_plugin_active_for_network' ) && is_plugin_active_for_network( EASY_FANCYBOX_BASENAME ) ) ? '' : '1',
					'description' => '<strong>' . esc_html__( 'Images', 'easy-fancybox' ) . '</strong>' . ( get_option('fancybox_enableImg') ? ' &mdash; <a href="?page=easy_fancybox&tab=images">' . translate( 'Settings' ) . '</a>' : '' )
				),
				'Inline' => array (
					'id' => 'fancybox_enableInline',
					'default' => '',
					'description' => '<strong>' . esc_html__( 'Inline content', 'easy-fancybox' ) . '</strong>' . '</strong>' . ( get_option('fancybox_enableInline') ? ' &mdash; <a href="?page=easy_fancybox&tab=inline">' . translate( 'Settings' ) . '</a>' : '' )
				),
				'PDF' => array (
					'id' => 'fancybox_enablePDF',
					'default' => '',
					'description' => '<strong>' . esc_html__( 'PDF', 'easy-fancybox' ) . '</strong>' . '</strong>' . ( get_option('fancybox_enablePDF') ? ' &mdash; <a href="?page=easy_fancybox&tab=pdf">' . translate( 'Settings' ) . '</a>' : '' )
				),
				'SWF' => array (
					'id' => 'fancybox_enableSWF',
					'default' => '',
					'description' => '<strong>' . esc_html__( 'SWF', 'easy-fancybox' ) . '</strong>' . '</strong>' . ( get_option('fancybox_enableSWF') ? ' &mdash; <a href="?page=easy_fancybox&tab=swf">' . translate( 'Settings' ) . '</a>' : '' )
				),
				'SVG' => array (
					'id' => 'fancybox_enableSVG',
					'default' => '',
					'description' => '<strong>' . esc_html__( 'SVG', 'easy-fancybox' ) . '</strong>' . '</strong>' . ( get_option('fancybox_enableSVG') ? ' &mdash; <a href="?page=easy_fancybox&tab=svg">' . translate( 'Settings' ) . '</a>' : '' )
				),
				'VideoPress' => array (
					'id' => 'fancybox_enableVideoPress',
					'default' => '',
					'status' => 'disabled',
					'description' => '<strong>' . esc_html__( 'VideoPress', 'easy-fancybox' ) . '</strong>' . ' ' . '<em><a href="'.easyFancyBox::$pro_plugin_url.'">' . esc_html__('Make available &raquo;','easy-fancybox') . '</a></em>'
				),
				'YouTube' => array (
					'id' => 'fancybox_enableYoutube',
					'default' => '',
					'description' => '<strong>' . esc_html__( 'YouTube', 'easy-fancybox' ) . '</strong>' . '</strong>' . ( get_option('fancybox_enableYouTube') ? ' &mdash; <a href="?page=easy_fancybox&tab=youtube">' . translate( 'Settings' ) . '</a>' : '' )
				),
				'Vimeo' => array (
					'id' => 'fancybox_enableVimeo',
					'default' => '',
					'description' => '<strong>' . esc_html__( 'Vimeo', 'easy-fancybox' ) . '</strong>' . '</strong>' . ( get_option('fancybox_enableVimeo') ? ' &mdash; <a href="?page=easy_fancybox&tab=vimeo">' . translate( 'Settings' ) . '</a>' : '' )
				),
				'Dailymotion' => array (
					'id' => 'fancybox_enableDailymotion',
					'default' => '',
					'description' => '<strong>' . esc_html__( 'Dailymotion', 'easy-fancybox' ) . '</strong>' . '</strong>' . ( get_option('fancybox_enableDailymotion') ? ' &mdash; <a href="?page=easy_fancybox&tab=dailymotion">' . translate( 'Settings' ) . '</a>' : '' )
				),
				'Instagram' => array (
					'id' => 'fancybox_enableInstagram',
					'status' => 'disabled',
					'default' => '',
					'description' => '<strong>' . esc_html__( 'Instagram', 'easy-fancybox' ) . '</strong>' . ' ' . '<em><a href="'.easyFancyBox::$pro_plugin_url.'">' . esc_html__('Make available &raquo;','easy-fancybox') . '</a></em>'
				),
				'GoogleMaps' => array (
					'id' => 'fancybox_enableGoogleMaps',
					'status' => 'disabled',
					'default' => '',
					'description' => '<strong>' . esc_html__( 'Google Maps', 'easy-fancybox' ) . '</strong>' . ' ' . '<em><a href="'.easyFancyBox::$pro_plugin_url.'">' . esc_html__('Make available &raquo;','easy-fancybox') . '</a></em>'
				),
				'iFrame' => array (
					'id' => 'fancybox_enableiFrame',
					'default' => '',
					'description' => '<strong>' . esc_html__('iFrames','easy-fancybox') . '</strong>' . '</strong>' . ( get_option('fancybox_enableiFrame') ? ' &mdash; <a href="?page=easy_fancybox&tab=iframe">' . translate( 'Settings' ) . '</a>' : '' )
				)
				);
		} );

	}

	public static function help_tab()
	{
		// TODO
	}

	public static function options_page()
	{
		// Prepare sections and settings and nav tabs.
		self::add_settings();

		// Prepare nav tabs.
		$active_tab = isset( $_GET[ 'tab' ] ) ? $_GET[ 'tab' ] : 'general';
		$tabs = array (
			'general'     =>  translate( 'General' ),
			//'appearance'  =>  translate( 'Appearance' ),
			//'behavior'    => esc_html__( 'Behavior', 'easy-fancybox' ),
			'images'      => get_option( 'fancybox_enableImg' )         ? esc_html__( 'Images', 'easy-fancybox' )      : false,
			'inline'      => get_option( 'fancybox_enableInline' )      ? esc_html__( 'Inline', 'easy-fancybox' )      : false,
			'pdf'         => get_option( 'fancybox_enablePDF' )         ? esc_html__( 'PDF', 'easy-fancybox' )         : false,
			'swf'         => get_option( 'fancybox_enableSWF' )         ? esc_html__( 'SWF', 'easy-fancybox' )         : false,
			/*'video'       => get_option( 'fancybox_enableVideoPress' ) ||
			                 get_option( 'fancybox_enableYoutube' ) || get_option( 'fancybox_enableVimeo' ) ||
							 get_option( 'fancybox_enableDailymotion' ) ? esc_html__( 'Video', 'easy-fancybox' )       : false,*/
			//'videopress'  => get_option( 'fancybox_enableVideoPress' )  ? esc_html__( 'VideoPress', 'easy-fancybox' )  : false,
			'youtube'     => get_option( 'fancybox_enableYoutube' )     ? esc_html__( 'YouTube', 'easy-fancybox' )     : false,
			'vimeo'       => get_option( 'fancybox_enableVimeo' )       ? esc_html__( 'Vimeo', 'easy-fancybox' )       : false,
			'dailymotion' => get_option( 'fancybox_enableDailymotion' ) ? esc_html__( 'Dailymotion', 'easy-fancybox' ) : false,
			'instagram'   => get_option( 'fancybox_enableInstagram' )   ? esc_html__( 'Instagram', 'easy-fancybox' )   : false,
			'googlemaps'  => get_option( 'fancybox_enableGoogleMaps' )  ? esc_html__( 'Google Maps', 'easy-fancybox' ) : false,
			'iframe'      => get_option( 'fancybox_enableiFrame' )      ? esc_html__( 'iFrames', 'easy-fancybox' )     : false,
			//'advanced'    => esc_html__( 'Advanced', 'easy-fancybox' ),
		);

		// Render page.
		include EASY_FANCYBOX_DIR . '/views/admin-page.php';
	}

	public static function add_settings()
	{
		/** SECTIONS */
		add_settings_section( 'easy_fancybox_general_section',    null, null, 'easy_fancybox_general' );
		//add_settings_section( 'easy_fancybox_appearance_section', null, null, 'easy_fancybox_appearance' );
		//add_settings_section( 'easy_fancybox_behavior_section',   null, null, 'easy_fancybox_behavior' );

		// Media sections.
		add_settings_section( 'easy_fancybox_images_section', null, null, 'easy_fancybox_images' );
		add_settings_section( 'easy_fancybox_inline_section', null, null, 'easy_fancybox_inline' );
		add_settings_section( 'easy_fancybox_pdf_section', null, null, 'easy_fancybox_pdf' );
		add_settings_section( 'easy_fancybox_swf_section', null, null, 'easy_fancybox_swf' );
		add_settings_section( 'easy_fancybox_videopress_section',  null, null, 'easy_fancybox_videopress' );
		add_settings_section( 'easy_fancybox_youtube_section',     null, null, 'easy_fancybox_youtube' );
		add_settings_section( 'easy_fancybox_vimeo_section', null, null, 'easy_fancybox_vimeo' );
		add_settings_section( 'easy_fancybox_dailymotion_section', null, null, 'easy_fancybox_dailymotion' );
		add_settings_section( 'easy_fancybox_instagram_section', null, null, 'easy_fancybox_instagram' );
		add_settings_section( 'easy_fancybox_googlemaps_section', null, null, 'easy_fancybox_googlemaps' );
		add_settings_section( 'easy_fancybox_iframe_section', null, null, 'easy_fancybox_iframe' );

		/** GENERAL */
		add_settings_field( 'fancybox_version', esc_html__( 'Version', 'easy-fancybox' ), function(){ include EASY_FANCYBOX_DIR . '/views/settings-field-version.php'; }, 'easy_fancybox_general', 'easy_fancybox_general_section', array('label_for'=>'fancybox_scriptVersion') );
		add_settings_field( 'fancybox_media',   esc_html__( 'Media', 'easy-fancybox' ),   function(){ include EASY_FANCYBOX_DIR . '/views/settings-field-media.php'; },   'easy_fancybox_general', 'easy_fancybox_general_section' );

		/** IMAGES */
		if ( get_option('fancybox_enableImg') ) {
			add_settings_field( 'fancybox_auto', esc_html__( 'Autodetect', 'easy-fancybox' ), function(){ include EASY_FANCYBOX_DIR . '/views/settings-field-images-auto.php'; }, 'easy_fancybox_images', 'easy_fancybox_images_section', array('label_for'=>'fancybox_autoAttribute') );
			//add_settings_field( 'fancybox_autolimit', esc_html__( 'Autodetect', 'easy-fancybox' ), function(){ include EASY_FANCYBOX_DIR . '/views/settings-field-images-auto-limit.php'; }, 'easy_fancybox_images', 'easy_fancybox_images_section', array('label_for'=>'fancybox_autoAttributeLimit') );

		}
	}

	public static function register_settings()
	{
		// Version.
		register_setting( 'easy_fancybox_general', 'fancybox_scriptVersion',     array( 'default' => 'classic', 'sanitize_callback' => 'sanitize_text_field' ) );
		// Media.
		register_setting( 'easy_fancybox_general', 'fancybox_enableImg',         array( 'default' => ( function_exists( 'is_plugin_active_for_network' ) && is_plugin_active_for_network( EASY_FANCYBOX_BASENAME ) ) ? '' : '1', 'sanitize_callback' => 'boolval' ) );
		register_setting( 'easy_fancybox_general', 'fancybox_enableInline',      array( 'default' => '', 'sanitize_callback' => 'boolval' ) );
		register_setting( 'easy_fancybox_general', 'fancybox_enablePDF',         array( 'default' => '', 'sanitize_callback' => 'boolval' ) );
		register_setting( 'easy_fancybox_general', 'fancybox_enableSWF',         array( 'default' => '', 'sanitize_callback' => 'boolval' ) );
		//register_setting( 'easy_fancybox_general', 'fancybox_enableVideoPress',  array( 'default' => '', 'sanitize_callback' => 'boolval' ) );
		register_setting( 'easy_fancybox_general', 'fancybox_enableYoutube',     array( 'default' => '', 'sanitize_callback' => 'boolval' ) );
		register_setting( 'easy_fancybox_general', 'fancybox_enableVimeo',       array( 'default' => '', 'sanitize_callback' => 'boolval' ) );
		register_setting( 'easy_fancybox_general', 'fancybox_enableDailymotion', array( 'default' => '', 'sanitize_callback' => 'boolval' ) );
		register_setting( 'easy_fancybox_general', 'fancybox_enableInstagram',   array( 'default' => '', 'sanitize_callback' => 'boolval' ) );
		register_setting( 'easy_fancybox_general', 'fancybox_enableGoogleMaps',  array( 'default' => '', 'sanitize_callback' => 'boolval' ) );
		register_setting( 'easy_fancybox_general', 'fancybox_enableiFrame',      array( 'default' => '', 'sanitize_callback' => 'boolval' ) );

		// Images.
		register_setting( 'easy_fancybox_images', 'fancybox_autoAttribute',      array( 'default' => '.jpg,.png,.webp', 'sanitize_callback' => array( __CLASS__, 'csl_text' ) ) );
		register_setting( 'easy_fancybox_images', 'fancybox_autoAttributeLimit', array( 'default' => '', 'sanitize_callback' => 'sanitize_text_field' ) );
		//register_setting( 'easy_fancybox_images', 'fancybox_',      array( 'default' => '', 'sanitize_callback' => array( __CLASS__, 'csl_text' ) ) );
		//register_setting( 'easy_fancybox_images', 'fancybox_',      array( 'default' => '', 'sanitize_callback' => array( __CLASS__, 'csl_text' ) ) );
		//register_setting( 'easy_fancybox_images', 'fancybox_',      array( 'default' => '', 'sanitize_callback' => array( __CLASS__, 'csl_text' ) ) );
		//register_setting( 'easy_fancybox_images', 'fancybox_',      array( 'default' => '', 'sanitize_callback' => array( __CLASS__, 'csl_text' ) ) );
		//register_setting( 'easy_fancybox_images', 'fancybox_',      array( 'default' => '', 'sanitize_callback' => array( __CLASS__, 'csl_text' ) ) );
		//register_setting( 'easy_fancybox_images', 'fancybox_',      array( 'default' => '', 'sanitize_callback' => array( __CLASS__, 'csl_text' ) ) );
	}

	public static function register_media_settings( $args = array() )
	{
/*		if ( ! in_array( get_option( 'fancybox_scriptVersion', 'classic' ), array( 'classic', 'legacy' ) ) ) {
			register_setting( 'media', 'easy_fancyboxEnabled', array( 'default' => ( function_exists( 'is_plugin_active_for_network' ) && is_plugin_active_for_network( EASY_FANCYBOX_BASENAME ) ) ? '' : '1', 'sanitize_callback' => 'int' ) );
			add_settings_field( 'easy_fancyboxEnabled', esc_html__('FancyBox','easy-fancybox'), function(){ include EASY_FANCYBOX_DIR . '/views/settings-field-enable.php'; }, 'media', 'fancybox_section', array('label_for'=>'easy_fancyboxEnabled') );
			return;
		}*/

		// Version.
		add_settings_field( 'fancybox_scriptVersion', esc_html__('Version','easy-fancybox'), function(){ include EASY_FANCYBOX_DIR . '/views/settings-field-version.php'; }, 'media', 'fancybox_section', array('label_for'=>'fancybox_scriptVersion') );
		register_setting( 'media', 'fancybox_scriptVersion', 'sanitize_text_field' );

		if ( empty( $args ) ) {
			$args = easyFancyBox::$options;
		}

		foreach ( $args as $key => $value ) {
			// Check to see if the section is enabled, else skip to next.
			if ( ! isset( $value['input'] ) ||
				array_key_exists($key, easyFancyBox::$options['Global']['options']['Enable']['options']) &&
				!get_option( easyFancyBox::$options['Global']['options']['Enable']['options'][$key]['id'], easyFancyBox::$options['Global']['options']['Enable']['options'][$key]['default'])
			) {
				continue;
			}

			switch( $value['input'] ) {
				case 'deep':
					// Go deeper by looping back on itself.
					self::register_media_settings($value['options']);
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
					$output[] = '<input type="number" step="' . ( isset( $args['step'] ) ? $args['step'] : '' ) . '" min="' . ( isset( $args['min'] ) ? $args['min'] : '' ) . '" max="' . ( isset( $args['max'] ) ? $args['max'] : '' ) . '" name="'.$args['id'].'" id="'.$args['id'].'" value="'.esc_attr( get_option($args['id'], $args['default']) ).'" class="'.$args['class'].'"'. disabled( isset( $args['status']) && 'disabled' == $args['status'], true, false ) .' /> ';
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
		$url = admin_url( 'options-media.php#fancybox' );

		array_unshift( $links, '<a href="' . $url . '">' . translate( 'Settings' ) . '</a>' );

		return $links;
	}

	/**
	* Adds links to plugin's description.
	*/
	public static function plugin_meta_links( $links, $file )
	{
	  if ( $file == EASY_FANCYBOX_BASENAME ) {
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

		// Strip #.
		$setting = ltrim( $setting, '#' );

		// Is it an rgb value?
		if ( substr( $setting, 0, 3 ) === 'rgb' ) {
			// Strip...
			$setting = str_replace( array('rgb(','rgba(',')'), '', $setting );

			$rgb_array = explode( ',', $setting );

			$r = ! empty( $rgb_array[0] ) ? (int) $rgb_array[0] : 0;
			$g = ! empty( $rgb_array[1] ) ? (int) $rgb_array[1] : 0;
			$b = ! empty( $rgb_array[2] ) ? (int) $rgb_array[2] : 0;
			$a = ! empty( $rgb_array[3] ) ? (float) $rgb_array[3] : 0.6;

			$sanitized = 'rgba('.$r.','.$g.','.$b.','.$a.')';
		}
		// Is it a hex value?
		elseif ( ctype_xdigit( $setting ) ) {
			// Only allow max 6 hexdigit values.
			$sanitized = '#'. substr( $setting, 0, 6 );
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
		load_plugin_textdomain('easy-fancybox', false, dirname( EASY_FANCYBOX_BASENAME ) . '/languages' );
	}

	public static function compat_warning()
	{
		/* Dismissable notice */
		/* If user clicks to ignore the notice, add that to their user meta */
		global $current_user;

		if ( isset( $_GET['easy_fancybox_ignore_notice'] ) && '1' == $_GET['easy_fancybox_ignore_notice'] ) {
			add_user_meta( $current_user->ID, 'easy_fancybox_ignore_notice', 'true', true );
		}

		if (
			class_exists( 'easyFancyBox_Advanced' ) &&
			(
				( ! defined( 'easyFancyBox_Advanced::VERSION' ) && ! defined( 'EASY_FANCYBOX_PRO_VERSION' ) ) ||
				( defined( 'easyFancyBox_Advanced::VERSION' ) && version_compare( easyFancyBox_Advanced::VERSION, self::$compat_pro_min, '<' ) ) ||
				( defined( 'EASY_FANCYBOX_PRO_VERSION' ) && version_compare( EASY_FANCYBOX_PRO_VERSION, self::$compat_pro_min, '<' ) )
			)
		) {
			self::$do_compat_warning = true;
		}

	}

	/**
	 * RUN
	 */

	public function __construct()
	{
		// Text domain.
		add_action( 'plugins_loaded', array(__CLASS__, 'load_textdomain') );

		// Admin notices.
		add_action( 'admin_init',     array(__CLASS__, 'compat_warning') );
		add_action( 'admin_notices',  array(__CLASS__, 'admin_notice') );

		// Plugin action links.
		add_filter( 'plugin_action_links_'.EASY_FANCYBOX_BASENAME, array(__CLASS__, 'add_action_link') );

		// Options page V2
		//add_action( 'admin_init', array(__CLASS__, 'register_settings') );
		//add_action( 'admin_menu', array(__CLASS__, 'add_options_page') );

		add_action( 'admin_init', array(__CLASS__, 'register_media_settings') );
		add_action( 'admin_init', array(__CLASS__, 'add_media_settings_section') );
	}
}
