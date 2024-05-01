<?php
/**
 * Easy FancyBox Admin Class.
 */
class easyFancyBox_Admin {

	private static $screen_id = 'toplevel_page_firelight-settings';

	private static $compat_pro_min = '1.8';

	private static $do_compat_warning = false;

	/**
	 * Class constructor function.
	 * Add hooks here.
	 */
	public function __construct() {
		// Text domain.
		add_action( 'plugins_loaded', array(__CLASS__, 'load_textdomain') );

		// Admin notices.
		add_action( 'admin_init',     array(__CLASS__, 'compat_warning') );
		add_action( 'admin_notices',  array(__CLASS__, 'admin_notice') );
		add_action( 'admin_enqueue_scripts', array( __CLASS__, 'enqueue_scripts' ) );

		// Plugin action links.
		add_filter( 'plugin_action_links_'.EASY_FANCYBOX_BASENAME, array(__CLASS__, 'add_action_link') );

		// Settings & Options page
		// add_action( 'admin_init', array(__CLASS__, 'register_media_settings') );
		add_action( 'admin_init', array(__CLASS__, 'add_media_settings_section') );
		add_action( 'admin_init', array(__CLASS__, 'register_settings' ) );
		add_action( 'admin_init', array(__CLASS__, 'add_settings_sections' ) );
		add_action( 'admin_init', array(__CLASS__, 'add_settings_fields' ) );
		add_action( 'admin_menu', array(__CLASS__, 'add_options_page') );

		add_action( 'wp_loaded', array(__CLASS__, 'save_date' ) );
		add_action( 'admin_notices', array(__CLASS__, 'show_review_request' ) );
		add_action( 'wp_ajax_efb-review-action', array(__CLASS__, 'process_efb_review_action' ) );
	}

	/**
	 * ADMIN METHODS
	 */
	public static function add_media_settings_section()
	{
 		add_settings_section( 'fancybox_section', '<a name="fancybox"></a>'.__( 'Easy FancyBox', 'easy-fancybox' ), function() { include EASY_FANCYBOX_DIR . '/views/settings-section-intro.php'; }, 'media' );
 	}

	/**
	 * Enqueue admin styles and scripts
	 */
	public static function enqueue_scripts( $hook ) {
		$screen = get_current_screen();
		$is_dashboard_or_efb_options = 'dashboard' === $screen->id || self::$screen_id === $screen->id;
		if ( $is_dashboard_or_efb_options ) {
			$css_file = easyFancyBox::$plugin_url . 'inc/admin.css';
			wp_register_style( 'firelight-css', $css_file, false, EASY_FANCYBOX_VERSION );
			wp_enqueue_style( 'firelight-css' );

			$js_file = easyFancyBox::$plugin_url . 'inc/admin.js';
			wp_register_script( 'firelight-js', $js_file, array( 'jquery', 'wp-dom-ready' ), EASY_FANCYBOX_VERSION );
			wp_enqueue_script( 'firelight-js' );
		}
	}

	/**
	* Add Lightbox Settings page to main menu.
	*/
	public static function add_options_page() {
		$screen_id = add_menu_page(
			__( 'Lightbox Settings - Easy Fancybox', 'easy-fancybox' ),
			'Lightbox',
			'manage_options',
			'firelight-settings',
			array( __CLASS__, 'options_page' ),
			'dashicons-format-image',
			85
		);
	}

	/**
	 * Render the content of the Lightbox Settings page.
	 */
	public static function options_page() {
		echo '<img class="firelight-logo" src="' . easyFancyBox::$plugin_url . 'images/firelight-logo.png">';

		echo '<form method="post" action="options.php">';

		settings_fields( 'firelight-settings-group' );
		do_settings_sections( 'firelight-settings' );
		submit_button();

		echo '</form>';
	}

	/**
	 * Show request for plugin review on options page
	 */
	public static function show_review_request() {
		// Don't show if not on options screen or dashboard, or if already rated
		$screen = get_current_screen();
		$is_dashboard_or_efb_options = 'dashboard' === $screen->id || self::$screen_id === $screen->id;
		$already_rated = get_option( 'efb_plugin_rated' ) && get_option( 'efb_plugin_rated' ) === 'true';
		if ( ! $is_dashboard_or_efb_options || $already_rated ) {
			return;
		}

		// Limit review notices to 10% of users initially
		$user_review_number = get_option( 'efb_user_review_number' );
		if ( ! $user_review_number ) {
			$user_review_number = rand(1, 10);
			update_option( 'efb_user_review_number', $user_review_number );
		}
		$selected = $user_review_number === '1' || $user_review_number === '2';
		if ( ! $selected ) {
			return;
		}

		// Only show if user has been using plugin for more than 60 days
		$current_date = new DateTimeImmutable( date( 'Y-m-d' ) );
		$plugin_time_stamp = get_option( 'easy_fancybox_date' );
		$activation_date = $plugin_time_stamp
			? new DateTimeImmutable( $plugin_time_stamp )
			: $current_date;
		$days_using_plugin = $activation_date->diff( $current_date )->days;
		if ( $days_using_plugin < 60 ) {
			return;
		}

		// Do not show if user interacted with reviews within last 90 days
		$efb_last_review_interaction = get_option( 'efb_last_review_interaction' );
		if ( $efb_last_review_interaction ) {
			$last_review_interaction_date = new DateTimeImmutable( $efb_last_review_interaction );
			$days_since_last_interaction = $last_review_interaction_date->diff( $current_date )->days;
			if ( $days_since_last_interaction < 90 ) {
				return;
			}
		}

		// To summarize, this will only show:
		// if is options screen
		// if has not already been rated
		// if user is selected for metered rollout
		// if user has plugin more than 60 days
		// if use has not interacted with reviews within 90 days
		?>
			<div class="notice notice-success is-dismissible efb-review-notice">
				<p><?php _e( 'You\'ve been using Easy Fancybox for a long time! Awesome and thanks!', 'easy-fancybox' ); ?></p>
				<p>
					<?php printf(
						__( 'We work hard to maintain it. Would you do us a BIG favor and give us a 5-star review on WordPress.org? Or share feedback <a %s>here</a>.', 'easy-fancybox' ),
						'href="https://firelightwp.com/contact/" target="_blank"'
					); ?>
				</p>

				<ul class="efb-review-actions" data-nonce="<?php echo esc_attr( wp_create_nonce( 'efb_review_action_nonce' ) ) ?>">
					<li style="display:inline;"><a class="button-primary" data-rate-action="do-rate"
						href="https://wordpress.org/support/plugin/easy-fancybox/reviews/#new-post" target="_blank"><?php _e( 'Ok, you deserve it!', 'easy-fancybox' ) ?></a>
					</li>
					<li style="display:inline;"><a class="button-secondary" data-rate-action="maybe-later" href="#"><?php _e( 'Maybe later', 'easy-fancybox' ) ?></a></li>
					<li style="display:inline;"><a class="button-secondary" data-rate-action="done" href="#"><?php _e( 'Already did!', 'easy-fancybox' ) ?></a></li>
				</ul>
			</div>

		<?php
	}
	/**
	 * Process Ajax request when user interacts with review requests
	 */
	public static function process_efb_review_action() {
		check_admin_referer( 'efb_review_action_nonce', '_n' );
		if ( !current_user_can( 'manage_options' ) ) {
			return;
		}

		$rate_action = $_POST['rate_action'];
		$current_date = new DateTimeImmutable( date( 'Y-m-d' ) );
		$current_date_as_string = $current_date->format( 'Y-m-d' );
		update_option( 'efb_last_review_interaction', $current_date_as_string );

		if ( 'done' === $rate_action ) {
			update_option( 'efb_plugin_rated', 'true' );
		}

		exit;
	}

	/**
	 * Register settings.
	 */
	public static function register_settings() {
		// Register general settings that apply to all lightboxes
		register_setting(
			'firelight-settings-group',
			'fancybox_scriptVersion',
			array(
				'default' => 'classic',
				'sanitize_callback' => 'sanitize_text_field'
			)
		);
		
		// Register settings for Fancybox Classic, Legacy, and V2
		// Include statement loads $efb_options array with all options.
		// We recursively go through and add all options.
		include EASY_FANCYBOX_DIR . '/inc/fancybox-options.php';
		self::register_settings_recursively( $efb_options );
	}

	/**
	 * Helper method to recursively go through/register settings.
	 */
	public static function register_settings_recursively( $settings ) {
		foreach ( $settings as $key => $setting ) {

			// If there's an id, this is an option that needs registering
			if (
				is_array( $setting ) &&
				array_key_exists( 'id', $setting ) &&
				$setting['id'] !== ''
			) {
				$id = $setting['id'];
				$default = isset(  $setting['default'] ) ?  $setting['default'] : '';
				$sanitize_callback = isset( $setting['sanitize_callback'] ) ? $setting['sanitize_callback'] : null;
				register_setting(
					'firelight-settings-group',
					$id,
					array(
						'sanitize_callback' => $sanitize_callback,
						'show_in_rest' => true,
						'default' => $default,
					)
				);
			}
			
			// If options key exists, this is a holder setting for other options.
			// We need to go through each of those too.
			if ( is_array( $setting ) && array_key_exists( 'options', $setting ) ) {
				self::register_settings_recursively( $setting[ 'options' ] );
			}
		}
	}

	/**
	 * Add setting sections and fields to options page
	 */
	public static function add_settings_sections() {
		add_settings_section(
			'lightbox-general-settings-section', // Section ID
			'Easy Fancybox General Settings', // Section title
			null, // Callback for top-of-section content
			'firelight-settings', // Page ID
			array(
				'before_section' => '<div class="general-settings-section settings-section">',
				'after_section'  => '</div>',
			)
		);

		$lightboxes = array( 'legacy', 'classic', 'fancybox2' );
		$global_setting_sections = easyFancybox::$options['Global']['options'];
		$media_setting_sections = array_slice( easyFancybox::$options, 1); 
		$sections = array_merge( $global_setting_sections, $media_setting_sections );

		foreach ( $lightboxes as $lightbox ) {
			foreach ( $sections as $section ) {
				$id = $lightbox . '-' . $section['slug'];
				$title = 'fancybox2' === $lightbox
					? 'FancyBox 2: ' . $section['title']
					: 'FancyBox ' . ucfirst( $lightbox ) . ': ' . $section['title'];
				add_settings_section(
					$id, // Section id
					$title, // Section title
					isset( $section['section_description'] ) ? $section['section_description'] : null, // Callback for section heading
					'firelight-settings', // Page ID
					array(
						'before_section' => '<div id="' . $id . '" class="' . $lightbox . ' ' . $section['slug'] . ' settings-section sub-settings-section">',
						'after_section'  => '</div>',
					)
				);
			}
		}
	}

	/**
	 * Add setting sections and fields to options page
	 */
	public static function add_settings_fields() {
		// Add general settings fields
		add_settings_field(
			'fancybox_version',
			__( 'Choose Lighbox Version', 'easy-fancybox' ),
			function() { 
				include EASY_FANCYBOX_DIR . '/views/settings-field-version.php';
			},
			'firelight-settings',
			'lightbox-general-settings-section',
			array('label_for'=>'fancybox_scriptVersion')
		);

		// Add FB Legacy settings fields
		$legacy_options = easyFancybox::$options;
		$legacy_options_filtered = self::filter_fb_options( $legacy_options, 'legacy' );
		self::add_settings_fields_recursively( $legacy_options_filtered, 'legacy' );

		// Add FB Class settings fields
		$classic_options = easyFancybox::$options;
		$classic_options_filtered = self::filter_fb_options( $classic_options, 'classic' );
		self::add_settings_fields_recursively( $classic_options_filtered, 'classic' );

		// Add FB V2 settings fields
		$fancybox2_options = easyFancybox::$options;
		$fancybox2_options_filtered = self::filter_fb_options( $fancybox2_options, 'fancybox2' );
		$fancybox2_options_renamed = self::rename_fb2_options( $fancybox2_options_filtered );
		self::add_settings_fields_recursively( $fancybox2_options_renamed, 'fancybox2' );
	}

	/**
	 * Add setting sections and fields to options page
	 */
	public static function filter_fb_options( $options_to_filter, $script_version ) {
		// First foreach cycles through Global, IMG, Inline, PDF
		foreach ( $options_to_filter as $option_category_key => $option_category ) {

			// Second foreach through Global[options], IMG[options], etc
			if ( array_key_exists( 'options', $option_category ) ) {
				foreach ( $option_category[ 'options' ] as $option_key => $option ) {

					// Now check if this option is itself an array of options
					if ( array_key_exists( 'options', $option ) ) {
						foreach ( $option[ 'options' ] as $sub_option_key => $suboption ) {
							if (
								is_array( $suboption ) &&
								array_key_exists( 'exclude', $suboption ) &&
								in_array( $script_version, $suboption['exclude'] )
							) {
								unset(
									$options_to_filter[$option_category_key]['options'][$option_key]['options'][$sub_option_key]
								);
							}
						}
					}

					// Or else handle it as single option
					if (
						array_key_exists( 'exclude', $option ) &&
						in_array( $script_version, $option['exclude'] )
					) {
						unset(
							$options_to_filter[$option_category_key]['options'][$option_key]
						);
					}
				}
			}
		}
	
		return $options_to_filter;
	}

	/**
	 * Rename some options for Fancybox2.
	 * 
	 * This weirdness is needed because the Fancybox V2 JS script
	 * renamed several of the options it consumes. We use the PHP
	 * options names and pass them on to the script, so we need
	 * to be sure they are named correctly. We could have set
	 * up totally different options for Fancybox2, but then way
	 * we're doing it allows users to set an options once for 
	 * Fancybox Classic or Legacy, and have that same selection
	 * apply if they change to Fancybox2 (or vice versa).
	 */
	public static function rename_fb2_options( $options_to_filter ) {
		// First foreach cycles through Global, IMG, Inline, PDF
		foreach ( $options_to_filter as $option_category_key => $option_category ) {
			if ( $option_category_key === 'Global' ) {
				// Global options are nested, so there is an extra loop
				foreach ( $option_category['options'] as $global_option_key => $global_option ) {
					foreach ( $global_option['options'] as $key => $option ) {
						if ( is_array( $option ) && array_key_exists( 'fancybox2_name', $option ) ) {
							$new_key = $option['fancybox2_name'];
							$options_to_filter['Global']['options'][$global_option_key]['options'][$new_key] = $option;
						}
					}
				}
			} else {
				foreach ( $option_category['options'] as $key => $option ) {
					if ( is_array( $option ) && array_key_exists( 'fancybox2_name', $option ) ) {
						$new_key = $option['fancybox2_name'];
						$options_to_filter[$option_category_key]['options'][$new_key] = $option;
					}
				}
			}
		}
	
		return $options_to_filter;
	}

	/**
	 * Add setting sections and fields to options page
	 */
	public static function add_settings_fields_recursively( $options_to_filter, $script_version ) {
		// First foreach cycles through Global, IMG, Inline, PDF
		foreach ( $options_to_filter as $option_category_key => $option_category ) {

			// We need to go through Global[options], IMG[options], etc
			// Second foreach through Global[options], IMG[options], etc
			if ( array_key_exists( 'options', $option_category ) ) {
				foreach ( $option_category[ 'options' ] as $option_key => $option ) {
					// Now check if this option is itself an array of options
					if (
						is_array( $option )
						&& array_key_exists( 'options', $option )
						// Exclude select inputs, which have options key
						&& 'select' !== $option[ 'input' ]
					) {
						foreach ( $option[ 'options' ] as $sub_option_key => $suboption ) {
							if ( is_array( $suboption ) && array_key_exists( 'id', $suboption ) ) {
								$id = $suboption['id'];
								$title = $suboption['title'] ?? '';
								$section = strtolower( $option_key );
								add_settings_field(  
									$id, // Setting ID              
									$title, // Setting label
									array( __CLASS__, 'render_settings_fields' ), // Setting callback
									'firelight-settings', // Page ID
									$script_version . '-' . $option['slug'], // Section ID
									$suboption
								);
							}
						}
					} elseif ( array_key_exists( 'id', $option ) ) {
						$id = $option['id'];
						$title = $option['title'] ?? '';
						add_settings_field(  
							$id, // Setting ID              
							$title, // Setting label
							array( __CLASS__, 'render_settings_fields' ), // Setting callback
							'firelight-settings', // Page ID
							$script_version . '-' . $option_category['slug'], // Section ID
							$option
						);
					}
				}
			}
		}
	}

	/**
	 * Rendering settings fields.
	 * Designed to passed as callback to add_settings_field().
	 */
	public static function render_settings_fields( $args ) {
		$output = array();

		if ( isset( $args['input'] ) ) :

			switch( $args['input'] ) {

				case 'multiple':
				case 'deep':
					foreach ( $args['options'] as $options ) {
						self::render_settings_fields( $options );
					}
					if ( isset( $args['description'] )) {
						$output[] = $args['description'];
					}
					break;

				case 'select':
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
					$value = get_option( $args['id'], $args['default'] );
					$description = isset( $args['description'] ) ? $args['description'] : '';
					$output[] =
						'<input type="checkbox" name="'
						. $args['id']
						. '" id="'.$args['id']
						. '" value="1" '
						. checked( get_option( $args['id'], $args['default'] ), true, false )
						. ' '
						. disabled( isset( $args['status']) && 'disabled' == $args['status'], true, false )
						. ' /> '
						. $description
						. '<br />';
					break;

				case 'text':
				case 'color': // TODO make color picker available for color values but do NOT use type="color" because that does not allow empty fields!
					$value = get_option($args['id'], $args['default']);
					$css_class = isset( $args['class'] ) ? $args['class'] : '';
					$description = isset( $args['description'] ) ? $args['description'] : '';

					// Options page update
					// Fix improper past saving over overlay color
					if ( 'fancybox_overlayColor' === $args['id'] && '' ===  $value ) {
						$value = $args['default'];
					}

					$output[] = '<input type="text" name="'.$args['id'].'" id="'.$args['id'].'" value="'.esc_attr( $value ).'" class="'.$css_class.'"'. disabled( isset( $args['status']) && 'disabled' == $args['status'], true, false ) .' /> ';
					if ( empty( $args['label_for'] ) ) {
						$output[] = '<label for="'.$args['id'].'">'.$description.'</label> ';
					} else {
						if ( isset( $args['description'] ) ) {
							$output[] = $args['description'];
						}
					}
					break;

				case 'number':
					$value = get_option( $args['id'], $args['default'] );
					$css_class = isset( $args['class'] ) ? $args['class'] : '';
					// Options page update
					// Fix for past options saving below minimums
					$is_value_above_minimum = isset( $args['min'] )
						? $value > $args['min']
						: true;
					$value = $is_value_above_minimum ? $value : $args['min'];

					// Options page update
					// One time fix for fancybox_opacity being set to 0
					if ( 'fancybox_overlayOpacity' === $args['id'] && '0' ===  $value ) {
						$value = $args['default'];
					}

					$output[] = '<input type="number" step="' . ( isset( $args['step'] ) ? $args['step'] : '' ) . '" min="' . ( isset( $args['min'] ) ? $args['min'] : '' ) . '" max="' . ( isset( $args['max'] ) ? $args['max'] : '' ) . '" name="'.$args['id'].'" id="'.$args['id'].'" value="'.esc_attr( $value ).'" class="'.$css_class.'"'. disabled( isset( $args['status']) && 'disabled' == $args['status'], true, false ) .' /> ';
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
		$url = admin_url( 'admin.php?page=firelight-settings' );

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

	/**
	* Sanitization function for number inputs.
	*/
	public static function sanitize_number( $setting = null ) {
		return (float) $setting;
	}


	/**
	* Sanitization function for RGB color values.
	* For HEX values, use sanitize_hex_value from WP core.
	*/
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

	/**
	 * Add admin notice
	 */
	public static function admin_notice() {
		global $current_user;

		if ( get_user_meta( $current_user->ID, 'easy_fancybox_ignore_notice' ) || ! current_user_can( 'install_plugins' ) ) {
			return;
		}

		/* Version Nag */
		if ( self::$do_compat_warning ) {
			include EASY_FANCYBOX_DIR . '/views/admin-notice.php';
		}
	}

	/**
	 * Text domain for translations
	 */
	public static function load_textdomain()
	{
		load_plugin_textdomain('easy-fancybox', false, dirname( EASY_FANCYBOX_BASENAME ) . '/languages' );
	}

	/**
	 * Adds warning if free and pro versions are incompatible.
	 */
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

	public static function save_date( $date_to_set = null ) {
		$date = get_option( 'easy_fancybox_date' );

		// Date has already been set in the past
		if ( $date ) {
			return;
		}

		// Method is being called from upgrade routine with date provided
		if ( $date_to_set ) {
			update_option( 'easy_fancybox_date', $date_to_set );
			return;
		}

		// Method is being called in this file, not upgrade.
		// Best we can do is set it to now.
		$now = new DateTimeImmutable( date( 'Y-m-d' ) );
		$now_as_string = $now->format( 'Y-m-d' );
		update_option( 'easy_fancybox_date', $now_as_string );
	}
}
