<?php
/**
 * File contains Admin class.
 *
 * Loads all the admin functionality for the plugin.
 *
 * @package EasyFancyBox
 */

/**
 * The easyFancyBox_Admin admin class.
 *
 * This should be capitalized, but keeping as is for backwards compatibility.
 */
class easyFancyBox_Admin { // phpcs:ignore

	/**
	 * The screen ID for the top-level Firelight settings page.
	 *
	 * @var string
	 */
	private static $screen_id = 'toplevel_page_firelight-settings';

	/**
	 * The screen ID for the Firelight Pro settings page.
	 *
	 * @var string
	 */
	private static $pro_screen_id = 'lightbox_page_firelight-pro';

	/**
	 * The minimum version of Firelight Pro required for compatibility.
	 *
	 * @var string
	 */
	private static $compat_pro_min = '2.0.0';

	/**
	 * Flag to determine whether to display a compatibility warning.
	 *
	 * @var bool
	 */
	private static $do_compat_warning = false;

	/**
	 * Constructor for the EasyFancyBox Admin class.
	 */
	public function __construct() {
		// Text domain.
		add_action( 'plugins_loaded', array( __CLASS__, 'load_textdomain' ) );

		// Admin notices.
		add_action( 'admin_init', array( __CLASS__, 'compat_warning' ) );
		add_action( 'admin_notices', array( __CLASS__, 'admin_notice' ) );

		// Enqueue JS and CSS.
		add_action( 'admin_enqueue_scripts', array( __CLASS__, 'enqueue_scripts' ) );
		add_action( 'enqueue_block_assets', array( __CLASS__, 'block_editor_scripts' ) );

		// Plugin action links.
		add_filter( 'plugin_action_links_' . EASY_FANCYBOX_BASENAME, array( __CLASS__, 'add_action_link' ) );

		// Settings & Options page.
		add_action( 'admin_init', array( __CLASS__, 'add_media_settings_section' ) );
		add_action( 'admin_init', array( __CLASS__, 'register_settings' ) );
		add_action( 'admin_init', array( __CLASS__, 'add_settings_sections' ) );
		add_action( 'admin_init', array( __CLASS__, 'add_settings_fields' ) );
		add_action( 'admin_menu', array( __CLASS__, 'add_options_page' ) );

		// Review requests.
		add_action( 'wp_loaded', array( __CLASS__, 'save_date' ) );
		add_action( 'admin_notices', array( __CLASS__, 'show_review_request' ) );
		add_action( 'wp_ajax_efb-review-action', array( __CLASS__, 'process_efb_review_action' ) );
	}

	/**
	 * The old settings area for Fancybox settings.
	 *
	 * This now just loads a notice on the media screen
	 * that links to the new settings screen.
	 */
	public static function add_media_settings_section() {
		add_settings_section(
			'fancybox_section',
			'<a name="fancybox"></a>' . __( 'Easy FancyBox', 'easy-fancybox' ),
			function () {
				include EASY_FANCYBOX_DIR . '/views/settings-section-intro.php';
			},
			'media'
		);
	}

	/**
	 * Enqueue scripts and styles for the admin area.
	 *
	 * Loads necessary scripts and styles depending on current admin screen.
	 *
	 * @since 1.0.0
	 * @access public
	 * @static
	 *
	 * @return void
	 */
	public static function enqueue_scripts() {
		$screen          = get_current_screen();
		$is_efb_settings = self::$screen_id === $screen->id;
		$is_pro_landing  = self::$pro_screen_id === $screen->id;
		$is_dashboard    = 'dashboard' === $screen->id;
		$freemius_js     = 'https://checkout.freemius.com/checkout.min.js';
		$purchase_js     = easyFancyBox::$plugin_url . 'inc/admin-purchase.js';
		$settings_js     = easyFancyBox::$plugin_url . 'inc/admin-settings.js';
		$notice_js       = easyFancyBox::$plugin_url . 'inc/admin-notice.js';
		$css_file        = easyFancyBox::$plugin_url . 'inc/admin.css';
		$version         = defined( 'WP_DEBUG' ) ? time() : EASY_FANCYBOX_PRO_VERSION;

		if ( $is_pro_landing ) {
			wp_register_script( 'firelight-freemius-js', $freemius_js, array( 'jquery', 'wp-dom-ready' ), $version, true );
			wp_register_script( 'firelight-purchase-js', $purchase_js, array( 'jquery', 'wp-dom-ready' ), $version, true );
			wp_enqueue_script( 'firelight-freemius-js' );
			wp_enqueue_script( 'firelight-purchase-js' );
		}

		if ( $is_efb_settings ) {
			wp_register_script( 'firelight-settings-js', $settings_js, array( 'jquery', 'wp-dom-ready' ), $version, true );
			wp_enqueue_script( 'firelight-settings-js' );
		}

		if ( $is_efb_settings || $is_pro_landing || $is_dashboard ) {
			wp_register_style( 'firelight-css', $css_file, false, $version );
			wp_enqueue_style( 'firelight-css' );
			wp_register_script( 'firelight-notice-js', $notice_js, array( 'jquery', 'wp-dom-ready' ), $version, true );
			wp_enqueue_script( 'firelight-notice-js' );
		}

		wp_localize_script(
			'firelight-settings-js',
			'settings',
			array(
				'proLandingUrl' => admin_url( 'admin.php?page=firelight-pro' ),
			)
		);
	}

	/**
	 * Adds the new Lightbox Settings screen to main menu.
	 */
	public static function add_options_page() {
		add_menu_page(
			__( 'Lightbox Settings - Easy Fancybox', 'easy-fancybox' ),
			'Lightbox',
			'manage_options',
			'firelight-settings',
			array( __CLASS__, 'options_page' ),
			'dashicons-format-image',
			85
		);
		if ( ! class_exists( 'easyFancyBox_Advanced' ) ) {
			add_submenu_page(
				'firelight-settings',
				'My Custom Page',
				'Settings',
				'manage_options',
				'firelight-settings'
			);
			add_submenu_page(
				'firelight-settings',
				'Go Pro',
				'Go Pro',
				'manage_options',
				'firelight-pro',
				array( __CLASS__, 'pro_landing_page' )
			);
		}
	}

	/**
	 * Renders the settings page using the Settings API.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return void
	 */
	public static function options_page() {
		if ( ! class_exists( 'easyFancyBox_Advanced' ) && ! self::should_show_review_request() ) {
			echo '<div class="sale-banner"><p>';
			esc_html_e( 'Easy Fancybox Pro is launched! Take 40% off this week - use code LAUNCH at checkout.', 'easy-fancybox' );
			echo ' <a href="https://firelightwp.com/pro-lightbox" target="_blank">' . esc_html__( 'LEARN MORE', 'easy-fancybox' ) . '</a>';
			echo '</p></div>';
		}

		echo '<img class="firelight-logo" src="' . esc_url( easyFancyBox::$plugin_url ) . 'images/firelight-logo.png">';

		echo '<form method="post" action="options.php">';

		settings_fields( 'firelight-settings-group' );
		do_settings_sections( 'firelight-settings' );
		submit_button();

		echo '</form>';
	}

	/**
	 * Determine if the review request should be shown.
	 *
	 * To summarize, this will only show:
	 * if is options screen and
	 * if has not already been rated and
	 * if user is selected for metered rollout and
	 * if user has plugin more than 60 days and
	 * if use has not interacted with reviews within 90 days.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return bool Returns true if the review request should be shown, false otherwise.
	 */
	public static function should_show_review_request() {
		// Don't show if not on options screen or dashboard, or if already rated.
		$screen                      = get_current_screen();
		$is_dashboard_or_efb_options = 'dashboard' === $screen->id || self::$screen_id === $screen->id;
		$already_rated               = get_option( 'efb_plugin_rated' ) && get_option( 'efb_plugin_rated' ) === 'true';
		if ( ! $is_dashboard_or_efb_options || $already_rated ) {
			return false;
		}

		// Limit review notices to 10% of users initially.
		$user_review_number = get_option( 'efb_user_review_number' );
		if ( ! $user_review_number ) {
			$user_review_number = rand( 1, 10 ); // phpcs:ignore
			update_option( 'efb_user_review_number', $user_review_number );
		}
		$selected = '1' === $user_review_number || '2' === $user_review_number || '3' === $user_review_number || '4' === $user_review_number || '5' === $user_review_number || '6' === $user_review_number;
		if ( ! $selected ) {
			return false;
		}

		// Only show if user has been using plugin for more than 60 days.
		$current_date      = new DateTimeImmutable( gmdate( 'Y-m-d' ) );
		$plugin_time_stamp = get_option( 'easy_fancybox_date' );
		$activation_date   = $plugin_time_stamp
			? new DateTimeImmutable( $plugin_time_stamp )
			: $current_date;
		$days_using_plugin = $activation_date->diff( $current_date )->days;
		if ( $days_using_plugin < 60 ) {
			return false;
		}

		// Do not show if user interacted with reviews within last 90 days.
		$efb_last_review_interaction = get_option( 'efb_last_review_interaction' );
		if ( $efb_last_review_interaction ) {
			$last_review_interaction_date = new DateTimeImmutable( $efb_last_review_interaction );
			$days_since_last_interaction  = $last_review_interaction_date->diff( $current_date )->days;
			if ( $days_since_last_interaction < 90 ) {
				return false;
			}
		}

		return true;
	}

	/**
	 * Render the review request to the user.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return void
	 */
	public static function show_review_request() {
		if ( self::should_show_review_request() ) {
			?>
				<div class="notice notice-success is-dismissible efb-review-notice">
					<p><?php esc_html_e( 'You\'ve been using Easy Fancybox for a long time! Awesome and thanks!', 'easy-fancybox' ); ?></p>
					<p>
						<?php
						printf(
							__( 'We work hard to maintain it. Would you do us a BIG favor and give us a 5-star review on WordPress.org? Or share feedback <a %s>here</a>.', 'easy-fancybox' ), // phpcs:ignore
							'href="https://firelightwp.com/contact/" target="_blank"'
						);
						?>
					</p>

					<ul class="efb-review-actions" data-nonce="<?php echo esc_attr( wp_create_nonce( 'efb_review_action_nonce' ) ); ?>">
						<li style="display:inline;"><a class="button-primary" data-rate-action="do-rate"
							href="https://wordpress.org/support/plugin/easy-fancybox/reviews/#new-post" target="_blank"><?php esc_html_e( 'Ok, you deserve it!', 'easy-fancybox' ); ?></a>
						</li>
						<li style="display:inline;"><a class="button-secondary" data-rate-action="maybe-later" href="#"><?php esc_html_e( 'Maybe later', 'easy-fancybox' ); ?></a></li>
						<li style="display:inline;"><a class="button-secondary" data-rate-action="done" href="#"><?php esc_html_e( 'Already did!', 'easy-fancybox' ); ?></a></li>
					</ul>
				</div>

			<?php
		}
	}

	/**
	 * Process Ajax request when user interacts with review requests
	 */
	public static function process_efb_review_action() {
		check_admin_referer( 'efb_review_action_nonce', '_n' );
		if ( ! current_user_can( 'manage_options' ) ) {
			return;
		}

		$rate_action            = isset( $_POST['rate_action'] ) ? sanitize_text_field( wp_unslash( $_POST['rate_action'] ) ) : '';
		$current_date           = new DateTimeImmutable( gmdate( 'Y-m-d' ) );
		$current_date_as_string = $current_date->format( 'Y-m-d' );
		update_option( 'efb_last_review_interaction', $current_date_as_string );

		if ( 'done' === $rate_action ) {
			update_option( 'efb_plugin_rated', 'true' );
		}

		exit;
	}

	/**
	 * Render the content of the Lightbox Settings page.
	 */
	public static function pro_landing_page() {
		include EASY_FANCYBOX_DIR . '/views/pro-landing-page.php';
	}

	/**
	 * Register settings.
	 */
	public static function register_settings() {
		// Register general settings that apply to all lightboxes.
		register_setting(
			'firelight-settings-group',
			'fancybox_scriptVersion',
			array(
				'default'           => 'classic',
				'sanitize_callback' => 'sanitize_text_field',
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
	 *
	 * @param array $settings Array of settings to register.
	 * @return void
	 */
	public static function register_settings_recursively( $settings ) {
		foreach ( $settings as $key => $setting ) {

			// If there's an id, this is an option that needs registering.
			if (
				is_array( $setting ) &&
				array_key_exists( 'id', $setting ) &&
				'' !== $setting['id']
			) {
				$id                = $setting['id'];
				$default           = isset( $setting['default'] ) ? $setting['default'] : '';
				$sanitize_callback = isset( $setting['sanitize_callback'] ) ? $setting['sanitize_callback'] : null;
				register_setting(
					'firelight-settings-group',
					$id,
					array(
						'sanitize_callback' => $sanitize_callback,
						'show_in_rest'      => true,
						'default'           => $default,
					)
				);
			}

			// If options key exists, this is a holder setting for other options.
			// We need to go through each of those too.
			if ( is_array( $setting ) && array_key_exists( 'options', $setting ) ) {
				self::register_settings_recursively( $setting['options'] );
			}
		}
	}

	/**
	 * Add setting sections and fields to options page.
	 */
	public static function add_settings_sections() {
		add_settings_section(
			'lightbox-general-settings-section', // Section ID.
			'Easy Fancybox General Settings', // Section title.
			null, // Callback for top-of-section content.
			'firelight-settings', // Page ID.
			array(
				'before_section' => '<div class="general-settings-section settings-section">',
				'after_section'  => '</div>',
			)
		);

		$lightboxes              = array( 'legacy', 'classic', 'fancybox2' );
		$global_setting_sections = easyFancybox::$options['Global']['options'];
		$media_setting_sections  = array_slice( easyFancybox::$options, 1 );
		$sections                = array_merge( $global_setting_sections, $media_setting_sections );

		foreach ( $lightboxes as $lightbox ) {
			foreach ( $sections as $section ) {
				$id    = $lightbox . '-' . $section['slug'];
				$title = 'fancybox2' === $lightbox
					? 'FancyBox 2: ' . $section['title']
					: 'FancyBox ' . ucfirst( $lightbox ) . ': ' . $section['title'];
				add_settings_section(
					$id, // Section id.
					$title, // Section title.
					isset( $section['section_description'] ) ? $section['section_description'] : null, // Callback for section heading.
					'firelight-settings', // Page ID.
					array(
						'before_section' => '<div id="' . $id . '" class="' . $lightbox . ' ' . $section['slug'] . ' settings-section sub-settings-section">',
						'after_section'  => '</div>',
					)
				);
			}
		}
	}

	/**
	 * Add setting sections and fields to options page.
	 */
	public static function add_settings_fields() {
		// Add general settings fields.
		add_settings_field(
			'fancybox_version',
			__( 'Choose Lighbox Version', 'easy-fancybox' ),
			function () {
				include EASY_FANCYBOX_DIR . '/views/settings-field-version.php';
			},
			'firelight-settings',
			'lightbox-general-settings-section',
			array( 'label_for' => 'fancybox_scriptVersion' )
		);

		// Add FB Legacy settings fields.
		$legacy_options          = easyFancybox::$options;
		$legacy_options_filtered = self::filter_fb_options( $legacy_options, 'legacy' );
		self::add_settings_fields_recursively( $legacy_options_filtered, 'legacy' );

		// Add FB Class settings fields.
		$classic_options          = easyFancybox::$options;
		$classic_options_filtered = self::filter_fb_options( $classic_options, 'classic' );
		self::add_settings_fields_recursively( $classic_options_filtered, 'classic' );

		// Add FB V2 settings fields.
		$fancybox2_options          = easyFancybox::$options;
		$fancybox2_options_filtered = self::filter_fb_options( $fancybox2_options, 'fancybox2' );
		$fancybox2_options_renamed  = self::rename_fb2_options( $fancybox2_options_filtered );
		self::add_settings_fields_recursively( $fancybox2_options_renamed, 'fancybox2' );
	}

	/**
	 * Add setting sections and fields to options page.
	 *
	 * @param array  $options_to_filter Array of options to filter.
	 * @param string $script_version    Active fancybox version.
	 */
	public static function filter_fb_options( $options_to_filter, $script_version ) {
		// First foreach cycles through Global, IMG, Inline, PDF.
		foreach ( $options_to_filter as $option_category_key => $option_category ) {

			// Second foreach through Global[options], IMG[options], etc.
			if ( array_key_exists( 'options', $option_category ) ) {
				foreach ( $option_category['options'] as $option_key => $option ) {

					// Now check if this option is itself an array of options.
					if ( array_key_exists( 'options', $option ) ) {
						foreach ( $option['options'] as $sub_option_key => $suboption ) {
							if (
								is_array( $suboption ) &&
								array_key_exists( 'exclude', $suboption ) &&
								in_array( $script_version, $suboption['exclude'], true )
							) {
								unset(
									$options_to_filter[ $option_category_key ]['options'][ $option_key ]['options'][ $sub_option_key ]
								);
							}
						}
					}

					// Or else handle it as single option.
					if (
						array_key_exists( 'exclude', $option ) &&
						in_array( $script_version, $option['exclude'], true )
					) {
						unset(
							$options_to_filter[ $option_category_key ]['options'][ $option_key ]
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
	 *
	 * @param array $options_to_filter Array of options to filter.
	 * @return array Filtered options.
	 */
	public static function rename_fb2_options( $options_to_filter ) {
		// First foreach cycles through Global, IMG, Inline, PDF.
		foreach ( $options_to_filter as $option_category_key => $option_category ) {
			if ( 'Global' === $option_category_key ) {
				// Global options are nested, so there is an extra loop.
				foreach ( $option_category['options'] as $global_option_key => $global_option ) {
					foreach ( $global_option['options'] as $key => $option ) {
						if ( is_array( $option ) && array_key_exists( 'fancybox2_name', $option ) ) {
							$new_key = $option['fancybox2_name'];
							$options_to_filter['Global']['options'][ $global_option_key ]['options'][ $new_key ] = $option;
						}
					}
				}
			} else {
				foreach ( $option_category['options'] as $key => $option ) {
					if ( is_array( $option ) && array_key_exists( 'fancybox2_name', $option ) ) {
						$new_key = $option['fancybox2_name'];
						$options_to_filter[ $option_category_key ]['options'][ $new_key ] = $option;
					}
				}
			}
		}
		return $options_to_filter;
	}

	/**
	 * Add setting sections and fields to options page.
	 *
	 * @param array $options_to_filter Array of options to filter.
	 * @param array $script_version    Filtered options.
	 * @return void
	 */
	public static function add_settings_fields_recursively( $options_to_filter, $script_version ) {
		// First foreach cycles through Global, IMG, Inline, PDF.
		foreach ( $options_to_filter as $option_category_key => $option_category ) {

			// We need to go through Global[options], IMG[options], etc.
			// Second foreach through Global[options], IMG[options], etc.
			if ( array_key_exists( 'options', $option_category ) ) {
				foreach ( $option_category['options'] as $option_key => $option ) {
					// Now check if this option is itself an array of options.
					if (
						is_array( $option )
						&& array_key_exists( 'options', $option )
						// Exclude select inputs, which have options key.
						&& 'select' !== $option['input']
					) {
						foreach ( $option['options'] as $sub_option_key => $suboption ) {
							if ( is_array( $suboption ) && array_key_exists( 'id', $suboption ) ) {
								$id      = $suboption['id'];
								$title   = $suboption['title'] ?? '';
								$section = strtolower( $option_key );
								add_settings_field(
									$id, // Setting ID.
									$title, // Setting label.
									array( __CLASS__, 'render_settings_fields' ), // Setting callback.
									'firelight-settings', // Page ID.
									$script_version . '-' . $option['slug'], // Section ID.
									$suboption
								);
							}
						}
					} elseif ( array_key_exists( 'id', $option ) ) {
						$id    = $option['id'];
						$title = $option['title'] ?? '';
						add_settings_field(
							$id, // Setting ID.
							$title, // Setting label.
							array( __CLASS__, 'render_settings_fields' ), // Setting callback.
							'firelight-settings', // Page ID.
							$script_version . '-' . $option_category['slug'], // Section ID.
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
	 *
	 * @param array $args Array of args associated with the setting.
	 * @return void
	 */
	public static function render_settings_fields( $args ) {
		$output = array();

		if ( isset( $args['input'] ) ) :

			switch ( $args['input'] ) {

				case 'multiple':
				case 'deep':
					foreach ( $args['options'] as $options ) {
						self::render_settings_fields( $options );
					}
					if ( isset( $args['description'] ) ) {
						$output[] = $args['description'];
					}
					break;

				case 'select':
					$output[] = '<select name="' . $args['id'] . '" id="' . $args['id'] . '">';
					foreach ( $args['options'] as $optionkey => $optionvalue ) {
						$output[] = '<option value="' . esc_attr( $optionkey ) . '"' . selected( get_option( $args['id'], $args['default'] ) === $optionkey, true, false ) . ' ' . disabled( isset( $args['status'] ) && 'disabled' === $args['status'], true, false ) . ' >' . $optionvalue . '</option>';
					}
					$output[] = '</select> ';
					if ( empty( $args['label_for'] ) ) {
						$output[] = '<label for="' . $args['id'] . '">' . $args['description'] . '</label> ';
					} else { // phpcs:ignore
						if ( isset( $args['description'] ) ) {
							$output[] = $args['description'];
						}
					}
					break;

				case 'checkbox':
					$value       = get_option( $args['id'], $args['default'] );
					$description = isset( $args['description'] ) ? $args['description'] : '';
					$output[]    =
						'<input type="checkbox" name="'
						. $args['id']
						. '" id="' . $args['id']
						. '" value="1" '
						. checked( get_option( $args['id'], $args['default'] ), true, false )
						. ' '
						. disabled( isset( $args['status'] ) && 'disabled' === $args['status'], true, false )
						. ' /> '
						. $description
						. '<br />';
					break;

				case 'text':
				case 'color': // TODO make color picker available for color values but do NOT use type="color" because that does not allow empty fields!
					$value       = get_option( $args['id'], $args['default'] );
					$css_class   = isset( $args['class'] ) ? $args['class'] : '';
					$description = isset( $args['description'] ) ? $args['description'] : '';

					// Options page update.
					// Fix improper past saving over overlay color.
					if ( 'fancybox_overlayColor' === $args['id'] && '' === $value ) {
						$value = $args['default'];
					}

					$output[] = '<input type="text" name="' . $args['id'] . '" id="' . $args['id'] . '" value="' . esc_attr( $value ) . '" class="' . $css_class . '"' . disabled( isset( $args['status'] ) && 'disabled' === $args['status'], true, false ) . ' /> ';
					if ( empty( $args['label_for'] ) ) {
						$output[] = '<label for="' . $args['id'] . '">' . $description . '</label> ';
					} else { // phpcs:ignore
						if ( isset( $args['description'] ) ) {
							$output[] = $args['description'];
						}
					}
					break;

				case 'number':
					$value     = get_option( $args['id'], $args['default'] );
					$css_class = isset( $args['class'] ) ? $args['class'] : '';
					// Options page update.
					// Fix for past options saving below minimums.
					$is_value_above_minimum = isset( $args['min'] )
						? $value > $args['min']
						: true;
					$value                  = $is_value_above_minimum ? $value : $args['min'];

					// Options page update.
					// One time fix for fancybox_opacity being set to 0.
					if ( 'fancybox_overlayOpacity' === $args['id'] && '0' === $value ) {
						$value = $args['default'];
					}

					$output[] = '<input type="number" step="' . ( isset( $args['step'] ) ? $args['step'] : '' ) . '" min="' . ( isset( $args['min'] ) ? $args['min'] : '' ) . '" max="' . ( isset( $args['max'] ) ? $args['max'] : '' ) . '" name="' . $args['id'] . '" id="' . $args['id'] . '" value="' . esc_attr( $value ) . '" class="' . $css_class . '"' . disabled( isset( $args['status'] ) && 'disabled' === $args['status'], true, false ) . ' /> ';
					if ( empty( $args['label_for'] ) ) {
						$output[] = '<label for="' . $args['id'] . '">' . $args['description'] . '</label> ';
					} else { // phpcs:ignore
						if ( isset( $args['description'] ) ) {
							$output[] = $args['description'];
						}
					}
					break;

				case 'hidden':
					$output[] = '<input type="hidden" name="' . $args['id'] . '" id="' . $args['id'] . '" value="' . esc_attr( get_option( $args['id'], $args['default'] ) ) . '" /> ';
					break;

				default:
					if ( isset( $args['description'] ) ) {
						$output[] = $args['description'];
					}
			}

		else : // phpcs:ignore

			if ( isset( $args['description'] ) ) {
				$output[] = $args['description'];
			}

		endif;

		echo implode( '', $output ); // phpcs:ignore
	}

	/**
	 * Enqueue block JavaScript and CSS for the editor
	 */
	public static function block_editor_scripts() {
		$block_js  = easyFancyBox::$plugin_url . 'build/index.js';
		$block_css = easyFancyBox::$plugin_url . 'build/index.css';
		$version   = defined( 'WP_DEBUG' ) ? time() : EASY_FANCYBOX_PRO_VERSION;

		$lightboxes      = easyFancyBox::get_lightboxes();
		$script_version  = get_option( 'fancybox_scriptVersion', 'classic' );
		$active_lightbox = isset( $lightboxes[ $script_version ] )
			? $lightboxes[ $script_version ]
			: esc_html__( 'Easy Fancybox', 'easy-fancybo' );
		$is_pro_user     = class_exists( 'easyFancyBox_Advanced' ) && easyFancyBox_Advanced::has_valid_pro_license();

		// Enqueue block editor CSS.
		wp_enqueue_style(
			'firelight-block-css',
			$block_css,
			array(),
			$version
		);

		// Enqueue block editor JS.
		wp_enqueue_script(
			'firelight-block-js',
			$block_js,
			array( 'wp-blocks', 'wp-i18n', 'wp-element', 'wp-components', 'wp-editor', 'wp-hooks' ),
			$version,
			true,
		);
		wp_localize_script(
			'firelight-block-js',
			'firelight',
			array(
				'activeLightbox' => $active_lightbox,
				'settingsUrl'    => esc_url( admin_url( 'admin.php?page=firelight-settings' ) ),
				'isProUser'      => $is_pro_user,
			)
		);
	}

	/**
	 * Adds an action link to the Plugins page.
	 *
	 * @param array $links Array of links to filter.
	 * @return array Filtered links.
	 */
	public static function add_action_link( $links ) {
		$url = admin_url( 'admin.php?page=firelight-settings' );

		array_unshift( $links, '<a href="' . $url . '">' . esc_html__( 'Settings', 'easy-fancbox' ) . '</a>' );

		return $links;
	}

	/**
	 * Adds links to plugin's description.
	 *
	 * @param array  $links Array of links to filter.
	 * @param string $file  Plugin file being processed.
	 * @return array List of filtered links.
	 */
	public static function plugin_meta_links( $links, $file ) {
		if ( EASY_FANCYBOX_BASENAME === $file ) {
			$links[] = '<a target="_blank" href="https://wordpress.org/support/plugin/easy-fancybox/">' . __( 'Support', 'easy-fancybox' ) . '</a>';
			$links[] = '<a target="_blank" href="https://wordpress.org/support/plugin/easy-fancybox/reviews/?filter=5#new-post">' . __( 'Rate ★★★★★', 'easy-fancybox' ) . '</a>';
		}
		return $links;
	}

	/**
	 * Sanitization function for number inputs.
	 *
	 * @param string|int $setting Number to sanitize.
	 * @return float Sanitized number.
	 */
	public static function sanitize_number( $setting = null ) {
		return (float) $setting;
	}


	/**
	 * Sanitization function for RGB color values.
	 * For HEX values, use sanitize_hex_value from WP core.
	 *
	 * @param string $setting RGB color value to sanitize.
	 * @return string Sanitized color value.
	 */
	public static function colorval( $setting = '' ) {
		$setting   = trim( $setting );
		$sanitized = '';

		// Strip #.
		$setting = ltrim( $setting, '#' );

		// Is it an rgb value?
		if ( substr( $setting, 0, 3 ) === 'rgb' ) {
			// Strip...
			$setting = str_replace( array( 'rgb(', 'rgba(', ')' ), '', $setting );

			$rgb_array = explode( ',', $setting );

			$r = ! empty( $rgb_array[0] ) ? (int) $rgb_array[0] : 0;
			$g = ! empty( $rgb_array[1] ) ? (int) $rgb_array[1] : 0;
			$b = ! empty( $rgb_array[2] ) ? (int) $rgb_array[2] : 0;
			$a = ! empty( $rgb_array[3] ) ? (float) $rgb_array[3] : 0.6;

			$sanitized = 'rgba(' . $r . ',' . $g . ',' . $b . ',' . $a . ')';
		} elseif ( ctype_xdigit( $setting ) ) {
			// Is it a hex value?
			// Only allow max 6 hexdigit values.
			$sanitized = '#' . substr( $setting, 0, 6 );
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
	public static function load_textdomain() {
		load_plugin_textdomain( 'easy-fancybox', false, dirname( EASY_FANCYBOX_BASENAME ) . '/languages' );
	}

	/**
	 * Adds warning if free and pro versions are incompatible.
	 */
	public static function compat_warning() {
		// Dismissable notice.
		// If user clicks to ignore the notice, add that to their user meta.
		global $current_user;

		if ( isset( $_GET['easy_fancybox_ignore_notice'] ) && '1' === $_GET['easy_fancybox_ignore_notice'] ) { // phpcs:ignore
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
	 * Sets date time stamp.
	 *
	 * This is a way to tell later how long a user has
	 * used the plugin. It is used to schedul review reqeuests
	 * and for similar use cases.
	 *
	 * @param string $date_to_set An optional date to use.
	 *
	 * @return bool Returns true on successful update, false on failure.
	 */
	public static function save_date( $date_to_set = null ) {
		$date = get_option( 'easy_fancybox_date' );

		// Date has already been set in the past.
		if ( $date ) {
			return;
		}

		// Method is being called from upgrade routine with date provided.
		if ( $date_to_set ) {
			update_option( 'easy_fancybox_date', $date_to_set );
			return;
		}

		// Method is being called in this file, not upgrade.
		// Best we can do is set it to now.
		$now           = new DateTimeImmutable( gmdate( 'Y-m-d' ) );
		$now_as_string = $now->format( 'Y-m-d' );
		update_option( 'easy_fancybox_date', $now_as_string );
	}
}
