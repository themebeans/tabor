<?php
/**
 * ThemeBeans License Handler
 *
 * @package     ThemeBeans Admin
 * @link        https://themebeans.com/
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! class_exists( 'ThemeBeans_License' ) ) :
	/**
	 * Enqueues JS & CSS assets
	 */
	class ThemeBeans_License {

		/**
		 * The API URL of the site we're sending the update request to.
		 *
		 * @var string $remote_api_url
		 */
		protected $remote_api_url = null;

		/**
		 * The theme slug.
		 *
		 * @var string $theme_slug
		 */
		protected $theme_slug = null;

		/**
		 * The version number of this theme.
		 *
		 * @var string $version
		 */
		protected $version = null;

		/**
		 * The author of the theme.
		 *
		 * @var string $author
		 */
		protected $author = null;

		/**
		 * The download ID of the theme on the remote site.
		 *
		 * @var string $download_id
		 */
		protected $download_id = null;

		/**
		 * The renewal URL the download on the remote site.
		 *
		 * @var string $renew_url
		 */
		protected $renew_url = null;

		/**
		 * The text string array.
		 *
		 * @var array $strings
		 */
		protected $strings = null;

		/**
		 * Initialize the class.
		 *
		 * @param array $config The remote request args.
		 * @param array $strings The string texts defined in updater.php.
		 */
		public function __construct( $config = array(), $strings = array() ) {

			$config = wp_parse_args(
				$config, array(
					'remote_api_url' => '',
					'theme_slug'     => get_template(),
					'item_name'      => '',
					'license'        => '',
					'version'        => '',
					'author'         => '',
					'download_id'    => '',
					'renew_url'      => '',
					'beta'           => false,
				)
			);

			// Set config arguments.
			$this->remote_api_url = $config['remote_api_url'];
			$this->item_name      = $config['item_name'];
			$this->theme_slug     = sanitize_key( $config['theme_slug'] );
			$this->version        = $config['version'];
			$this->author         = $config['author'];
			$this->download_id    = $config['download_id'];
			$this->renew_url      = $config['renew_url'];
			$this->beta           = $config['beta'];

			// Populate version fallback.
			if ( '' === $config['version'] ) {
				$theme         = wp_get_theme( $this->theme_slug );
				$this->version = $theme->get( 'Version' );
			}

			// Strings passed in from the updater config.
			$this->strings = $strings;

			add_action( 'admin_init', array( $this, 'redirect_customizer' ) );
			add_action( 'admin_init', array( $this, 'updater' ) );
			add_action( 'admin_menu', array( $this, 'options_page' ) );
			add_action( 'wp_ajax_activate_license', array( $this, 'ajax_activate_license' ) );
			add_action( 'wp_ajax_deactivate_license', array( $this, 'ajax_deactivate_license' ) );
			add_filter( 'merlin_ajax_activate_license', array( $this, 'merlin_activate_license' ) );

			// Check the license whenever the themes.php admin page is loaded.
			add_action( 'load-themes.php', array( $this, 'check_license' ) );

			// Cron hooks.
			add_filter( 'cron_schedules', array( $this, 'add_schedules' ) );
			add_action( 'wp', array( $this, 'schedule_events' ) );

			// Check that license is valid once per week.
			add_action( 'themebeans_check_license', array( $this, 'check_license' ) );

			// License control.
			add_action( 'customize_register', array( $this, 'license_control' ) );

			// Deactivate when switching themes.
			add_action( 'switch_theme', array( $this, 'switch_theme' ) );
		}

		/**
		 * Add license key support in the Customizer.
		 *
		 * @param WP_Customize_Manager $wp_customize the Customizer object.
		 */
		public function license_control( $wp_customize ) {

			require get_parent_theme_file_path( THEMEBEANS_CUSTOM_CONTROLS_DIR . '/class-themebeans-license-control.php' );

			$wp_customize->add_section(
				'license_key', array(
					'title' => esc_html__( 'License Key', 'themebeans' ),
				)
			);

			$wp_customize->add_setting(
				'themebeans_license[key]', array(
					'transport'         => 'postMessage',
					'type'              => 'option',
					'sanitize_callback' => 'sanitize_text_field',
				)
			);

			/* translators: theme name */
			$description = sprintf( esc_html__( 'Enter a license key to enable remote updates and access theme support for %s.', 'themebeans' ), $this->item_name );

			$url = 'https://kb.themebeans.com/article/14-license-activation-guide';

			$tooltip = esc_html__( 'Need help?', 'themebeans' );

			if ( $this->status() ) {

				if ( 'valid' === $this->status() ) {

					$description = esc_html__( 'Awesome! Your site is connected to ThemeBeans and ready for remote updates, and support if you need it.', 'themebeans' );

				} elseif ( 'expired' === $this->status() ) {

					/* translators: 1. theme name, 2. expiration date */
					$description = sprintf( esc_html__( 'Your license for %1$s expired on %2$s and is no longer connected to ThemeBeans. Please renew your license to activate remote updates and support.', 'themebeans' ), $this->item_name, $this->expiration() );

					// Set the tooltip URL to use the renewal link instead.
					$url = $this->get_renewal_link();

					$tooltip = esc_html__( 'Renew License', 'themebeans' );

				}
			}

			$wp_customize->add_control(
				new ThemeBeans_License_Control(
					$wp_customize, 'themebeans_license[key]', array(
						'type'        => 'themebeans-license',
						/* translators: theme name */
						'label'       => sprintf( esc_html__( '%s License', 'themebeans' ), $this->item_name ),
						'description' => esc_html( $description ),
						'section'     => 'license_key',
						'priority'    => 1,
						'input_attrs' => array(
							'tooltip'      => esc_html( $tooltip ),
							'tooltip_link' => esc_url( $url ),
						),
					)
				)
			);
		}

		/**
		 * Register new cron schedules.
		 *
		 * @param array $schedules Array of schedules.
		 * @return array
		 */
		public function add_schedules( $schedules = array() ) {
			// Adds once weekly to the existing schedules.
			$schedules['weekly'] = array(
				'interval' => 604800,
				'display'  => esc_html__( 'Once Weekly', 'themebeans' ),
			);

			return $schedules;
		}

		/**
		 * Schedule weekly checks.
		 *
		 * @access public
		 * @return void
		 */
		public function schedule_events() {
			$this->weekly_events();
		}

		/**
		 * Schedule weekly checks.
		 *
		 * @access private
		 * @return void
		 */
		private function weekly_events() {
			if ( ! wp_next_scheduled( 'themebeans_check_license' ) ) {
				wp_schedule_event( current_time( 'timestamp', true ), 'weekly', 'themebeans_check_license' );
			}
		}

		/**
		 * The updater.
		 */
		public function updater() {

			// Continue if the current user can manage options.
			if ( ! current_user_can( 'manage_options' ) ) {
				return;
			}

			// Don't run within the Customizer itself.
			if ( is_customize_preview() ) {
				return;
			}

			$key    = $this->key();
			$status = $this->status();

			/* If there is no valid license key status, don't allow updates. */
			if ( ! $status ) {
				return;
			}

			if ( ! class_exists( 'ThemeBeans_Updater' ) ) {
				include get_parent_theme_file_path( THEMEBEANS_UPDATER_DIR . '/class-themebeans-updater.php' );
			}

			new ThemeBeans_Updater(
				array(
					'remote_api_url' => $this->remote_api_url,
					'version'        => $this->version,
					'license'        => trim( $key ),
					'item_name'      => $this->item_name,
					'author'         => $this->author,
					'beta'           => $this->beta,
				),
				$this->strings
			);
		}

		/**
		 * Check if license key is valid once per week.
		 *
		 * @access  public
		 * @since   2.5
		 * @return  void
		 */
		public function check_license() {

			// If we have a transient, don't check the license again.
			if ( get_transient( $this->theme_slug . '_license_check', false ) ) {
				return;
			}

			$key    = $this->key();
			$status = $this->status();

			// Don't fire if we don't have a license key.
			if ( empty( $key ) ) {
				return;
			}

			if ( empty( $status ) ) {
				return;
			}

			// Data to send in our API request.
			$api_params = array(
				'edd_action' => 'check_license',
				'license'    => rawurlencode( $key ),
				'item_name'  => rawurlencode( $this->item_name ),
				'url'        => esc_url( home_url( '/' ) ),
			);

			// Get the response.
			$response = $this->get_api_response( $api_params );

			if ( $response && isset( $response->license ) ) {

				// Set up options.
				$options = array();

				// Pull options from WP.
				$license_options = get_option( 'themebeans_license', array() );

				// Get the license key (from the AJAX $_POST call up above).
				$options['key'] = $key;

				// Get the license status.
				$response_status   = $response->license;
				$options['status'] = $response_status;

				// Get the license expiration date.
				$response_expiration   = date_i18n( get_option( 'date_format' ), strtotime( $response->expires ) );
				$options['expiration'] = $response_expiration;

				// Get the number of activations left.
				$response_site_count   = $response->site_count;
				$options['site_count'] = $response_site_count;

				// Get the number of activations left.
				$response_activations_left   = $response->activations_left;
				$options['activations_left'] = $response_activations_left;

				// Get the time this check ran.
				$options['last_checked'] = date( 'Y-m-d H:i:s' );

				// Merge options.
				$merged_options  = array_merge( $license_options, $options );
				$license_options = $merged_options;

				update_option( 'themebeans_license', $license_options );
			}

			delete_transient( $this->theme_slug . '_license_check' );
			set_transient( $this->theme_slug . '_license_check', true, HOUR_IN_SECONDS ); // 1 hour.
		}

		/**
		 * Makes a call to the API.
		 *
		 * @param array $api_params to be used for wp_remote_get.
		 * @return array $response decoded JSON response.
		 */
		public function get_api_response( $api_params ) {

			// Call the custom API.
			$response = wp_remote_post(
				$this->remote_api_url,
				array(
					'timeout'   => 15,
					'sslverify' => true,
					'body'      => $api_params,
				)
			);

			// Make sure the response came back okay.
			if ( is_wp_error( $response ) ) {
				return false;
			}

			$response = json_decode( wp_remote_retrieve_body( $response ) );

			return $response;
		}

		/**
		 * Constructs a renewal link
		 *
		 * @since 1.0.0
		 */
		public function get_renewal_link() {

			// If a renewal link was passed in the config, use that.
			if ( '' !== $this->renew_url ) {
				return $this->renew_url;
			}

			// If download_id was passed in the config, a renewal link can be constructed.
			$key = $this->key();

			if ( '' !== $this->download_id && $key ) {
				$url  = esc_url( $this->remote_api_url );
				$url .= '/checkout/?edd_license_key=' . $key . '&download_id=' . $this->download_id;
				return $url;
			}

			// Otherwise return the remote_api_url.
			return $this->remote_api_url;
		}

		/**
		 * Add a page under the "Apperance" menu, that links directly to the license section.
		 *
		 * @access public
		 * @return void
		 */
		public function options_page() {

			// Continue if the current user can manage options.
			if ( ! current_user_can( 'manage_options' ) ) {
				return;
			}

			// Check if the license is valid.
			$is_valid = $this->is_valid_license();

			// Return if the license is valid.
			if ( true === $is_valid ) {
				return;
			}

			/**
			 * Continue if the label is not disabled.
			 *
			 * Use the following filter to disable the "Theme License" label within the Appearance tab.
			 *
			 * function themebeans_remove_license_menu() {
			 *       return false;
			 * }
			 * add_action( 'themebeans_remove_license_menu_item', 'themebeans_remove_license_menu' );
			 */
			if ( apply_filters( 'themebeans_remove_license_menu_item', false ) ) {
				return;
			}

			// Status indicators — @todo Turn these on one day. Ran into minor styling issues so I disabled.
			if ( ! $this->key() || 'inactive' === $this->status() ) {
				$notifcation = ' <span class="dashicons dashicons-warning" style="font-size: 19px; margin-bottom: -10px; top: -1px; position: relative; transition-duration: .05s;"></span>';
			} elseif ( $this->key() && 'expired' === $this->status() ) {
				$notifcation = ' <span class="dashicons dashicons-warning" style="font-size: 19px; margin-bottom: -10px; top: -1px; position: relative; transition-duration: .05s;"></span>';
			} elseif ( $this->key() && 'valid' === $this->status() ) {
				$notifcation = ' <span class="update-plugins count-1" style="background-color: #4a4c4e; margin-bottom: -10px; margin-top: -1px"><span class="update-count dashicons dashicons-yes" style="font-size: 17px; width: 13px; position: relative; left: -2px; top: 1px; transition-duration: .05s;"></span></span>';
			} else {
				$notifcation = null;
			}

			$notifcation = null;

			add_theme_page( esc_html__( 'Theme License', 'themebeans' ), esc_html__( 'Theme License', 'themebeans' ) . $notifcation, 'manage_options', 'themebeans-license-key', '__return_null' );
		}

		/**
		 * Hook to redirect the page for the Customizer.
		 *
		 * @access public
		 * @return void
		 */
		public function redirect_customizer() {

			// Continue if the current user can manage options.
			if ( ! current_user_can( 'manage_options' ) ) {
				return;
			}

			if ( ! empty( $_GET['page'] ) ) { // Input var okay.

				if ( 'themebeans-license-key' === $_GET['page'] ) { // Input var okay.

					wp_safe_redirect( admin_url( '/customize.php?autofocus[section]=license_key' ) );
				}
			}
		}

		/**
		 * Get the license key.
		 *
		 * @access public
		 */
		public function key() {

			$options = get_option( 'themebeans_license', array() );
			$key     = array_key_exists( 'key', $options ) ? sanitize_text_field( $options['key'] ) : false;

			return $key;
		}

		/**
		 * Get the license status.
		 *
		 * @access public
		 */
		public function status() {

			$options = get_option( 'themebeans_license', array() );
			$status  = array_key_exists( 'status', $options ) ? sanitize_text_field( $options['status'] ) : false;

			return $status;
		}

		/**
		 * Get the license's expiration date.
		 *
		 * @access public
		 */
		public function expiration() {

			$options    = get_option( 'themebeans_license', array() );
			$expiration = array_key_exists( 'expiration', $options ) ? sanitize_text_field( $options['expiration'] ) : false;

			return $expiration;
		}

		/**
		 * Get status.
		 *
		 * @access public
		 */
		public function site_count() {

			$options    = get_option( 'themebeans_license', array() );
			$site_count = array_key_exists( 'site_count', $options ) ? sanitize_text_field( $options['site_count'] ) : false;

			return $site_count;
		}

		/**
		 * Get status.
		 *
		 * @access public
		 */
		public function activations_left() {

			$options          = get_option( 'themebeans_license', array() );
			$activations_left = array_key_exists( 'activations_left', $options ) ? sanitize_text_field( $options['activations_left'] ) : false;

			return $activations_left;
		}

		/**
		 * Get the license status.
		 *
		 * @access public
		 */
		public function is_valid_license() {

			// Get the status of the license.
			$status = $this->status();

			if ( 'valid' === $status ) {
				return true;
			} else {
				return false;
			}
		}

		/**
		 * License Activation AJAX.
		 */
		public function ajax_activate_license() {

			if ( ! check_ajax_referer( 'themebeans-activate-license', 'nonce', false ) ) {
				wp_send_json_error( 'invalid_nonce' );
			}

			$this->activate_license();
		}

		/**
		 * License Deactivation AJAX.
		 */
		public function ajax_deactivate_license() {

			if ( ! check_ajax_referer( 'themebeans-deactivate-license', 'nonce', false ) ) {
				wp_send_json_error( 'invalid_nonce' );
			}

			$this->deactivate_license();
		}

		/**
		 * Check the license and activate it. (Test: de5d3d143d81b95a6d89568848e43a8e)
		 */
		public function activate_license() {

			// Veritfy and validate the request.
			if ( isset( $_POST['key'], $_POST['themebeans-activate-license'] ) && wp_verify_nonce( sanitize_key( $_POST['themebeans-activate-license'] ), 'nonce' ) ) {  // Input var okay.
				return;
			}

			// Get the option from AJAX and save it to our options array.
			$key = sanitize_text_field( wp_unslash( $_POST['key'] ) );  // Input var okay.

			// Data to send in our API request.
			$api_params = array(
				'edd_action' => 'activate_license',
				'license'    => rawurlencode( $key ),
				'item_id'    => $this->download_id,
				'url'        => home_url( '/' ),
			);

			// Get the response.
			$response = $this->get_api_response( $api_params );

			// Make sure the response came back okay.
			if ( ! isset( $response->license ) ) {
				$message = esc_html__( 'An error occurred, please try again.', 'themebeans' );
			} else {
				// If the license response is not successful.
				if ( false === $response->success ) {

					switch ( $response->error ) {

						case 'expired':
							$message = sprintf(
								/* translators: 1: date. 2: a href link. 3: closing </a>. */
								esc_html__( 'Your license expired on %1$s. %2$sClick here to renew &rarr;%3$s', 'themebeans' ),
								date_i18n( get_option( 'date_format' ), strtotime( $response->expires, current_time( 'timestamp' ) ) ),
								'<a href="' . esc_url( $this->get_renewal_link() ) . '" target="_blank">',
								'</a>'
							);
							break;

						case 'revoked':
							$message = esc_html__( 'Your license key has been disabled.', 'themebeans' );
							break;

						case 'missing':
							$message = esc_html__( 'Invalid license.', 'themebeans' );
							break;

						case 'invalid':
						case 'site_inactive':
							$message = esc_html__( 'Your license is not active for this URL.', 'themebeans' );
							break;

						case 'item_name_mismatch':
							$message = esc_html__( 'This appears to be an invalid license key.', 'themebeans' );
							break;

						case 'no_activations_left':
							$message = esc_html__( 'Your license key has reached its activation limit.', 'themebeans' );
							break;

						default:
							$message = esc_html__( 'An error occurred, please try again.', 'themebeans' );
							break;
					}
				}
			}

			// We need to update the license at the same time the message is updated.
			if ( $response && isset( $response->license ) ) {

				// Set up options.
				$options = array();

				// Pull options from WP.
				$license_options = get_option( 'themebeans_license', array() );

				// Get the license key (from the AJAX $_POST call up above).
				$options['key'] = $key;

				// Get the license status.
				$response_status   = $response->license;
				$options['status'] = $response_status;

				// Get the license expiration date.
				$response_expiration   = date_i18n( get_option( 'date_format' ), strtotime( $response->expires ) );
				$options['expiration'] = $response_expiration;

				// Get the number of activations left.
				$response_site_count   = $response->site_count;
				$options['site_count'] = $response_site_count;

				// Get the number of activations left.
				$response_activations_left   = $response->activations_left;
				$options['activations_left'] = $response_activations_left;

				// Get the time this check ran.
				$options['last_checked'] = date( 'Y-m-d H:i:s' );

				// Merge options.
				$merged_options  = array_merge( $license_options, $options );
				$license_options = $merged_options;

				update_option( 'themebeans_license', $license_options );

				wp_send_json(
					array(
						'done'             => 1,
						'error'            => $message,
						'expiration'       => $response_expiration,
						'status'           => $response_status,
						'site_count'       => $response_site_count,
						'activations_left' => $response_activations_left,
					)
				);
			}
		}

		/**
		 * Deactivates the license key.
		 */
		public function deactivate_license() {

			// Veritfy and validate the request.
			if ( isset( $_POST['themebeans-deactivate-license'] ) && wp_verify_nonce( sanitize_key( $_POST['themebeans-deactivate-license'] ), 'nonce' ) ) {  // Input var okay.
				return;
			}

			// Get the license key.
			$key = $this->key();

			// If there's no key, return now.
			if ( ! $key ) {
				return;
			}

			// Data to send in our API request.
			$api_params = array(
				'edd_action' => 'deactivate_license',
				'license'    => rawurlencode( $key ),
				'item_id'    => $this->download_id,
				'url'        => esc_url( home_url( '/' ) ),
			);

			$response = $this->get_api_response( $api_params );

			// $response->license will be either "deactivated" or "failed".
			if ( $response && ( 'deactivated' === $response->license ) ) {

				// Remove the license option and transients.
				delete_option( 'themebeans_license' );
				delete_transient( $this->theme_slug . '_update_response' );
				delete_transient( $this->theme_slug . '_license_check' );

				// Let the Customizer know we're done here.
				wp_send_json(
					array(
						'done' => 1,
					)
				);
			}
		}

		/**
		 * Deactivates the license key when switching themes.
		 */
		public function switch_theme() {

			// Get the license key.
			$key = $this->key();

			// If there's no key, return now.
			if ( ! $key ) {
				return;
			}

			// Get the theme's info.
			$theme         = wp_get_theme();
			$current_theme = themebeans_get_theme( true );

			// If we're just switching to the child theme, return now.
			if ( $current_theme === $theme->get( 'Template' ) ) {
				return;
			}

			// If we're just switching from a child theme to the parent theme, return now.
			if ( $current_theme === $this->theme_slug ) {
				return;
			}

			// Data to send in our API request.
			$api_params = array(
				'edd_action' => 'deactivate_license',
				'license'    => rawurlencode( $key ),
				'item_id'    => $this->download_id,
				'url'        => esc_url( home_url( '/' ) ),
			);

			$response = $this->get_api_response( $api_params );

			// $response->license will be either "deactivated" or "failed".
			if ( $response && ( 'deactivated' === $response->license ) ) {

				// Remove the license option and transients.
				delete_transient( $this->theme_slug . '_update_response' );
				delete_transient( $this->theme_slug . '_license_check' );

				// Set up options.
				$options = array();

				// Pull options from WP.
				$license_options = get_option( 'themebeans_license', array() );

				// Remove the license values.
				$options['status']                = null;
				$options['site_count']            = null;
				$options['activations_left']      = null;
				$options['last_checked']          = null;
				$options['expiration']            = null;
				$options['last_check_for_update'] = null;

				// Merge options.
				$merged_options  = array_merge( $license_options, $options );
				$license_options = $merged_options;

				update_option( 'themebeans_license', $license_options );

			}

			// Redirect back once we're done.
			$url = wp_get_referer();

			if ( ! $url ) {
				$url = admin_url();
			}

			wp_safe_redirect( esc_url_raw( $url ), WP_Http::SEE_OTHER );

			exit;
		}

		/**
		 * Activate the EDD license within the Merlin WP wizard.
		 *
		 * @param string $license_key The license key.
		 * @return array
		 */
		public function merlin_activate_license( $license_key ) {
			$success = false;

			// Data to send in our API request.
			$api_params = array(
				'edd_action' => 'activate_license',
				'license'    => rawurlencode( $license_key ),
				'item_id'    => $this->download_id,
				'url'        => esc_url( home_url( '/' ) ),
			);

			$response = $this->get_api_response( $api_params );

			// Make sure the response came back okay.
			if ( ! isset( $response->license ) ) {
				$message = esc_html__( 'An error occurred, please try again.', 'themebeans' );
			} else {
				// If the license response is not successful.
				if ( false === $response->success ) {

					switch ( $response->error ) {

						case 'expired':
							$message = sprintf(
								/* translators: Expiration date */
								esc_html__( 'Your license key expired on %s.', 'themebeans' ),
								date_i18n( get_option( 'date_format' ), strtotime( $response->expires, current_time( 'timestamp' ) ) )
							);
							break;

						case 'revoked':
							$message = esc_html__( 'Your license key has been disabled.', 'themebeans' );
							break;

						case 'missing':
							$message = esc_html__( 'This appears to be an invalid license key. Please try again or contact support.', 'themebeans' );
							break;

						case 'invalid':
						case 'site_inactive':
							$message = esc_html__( 'Your license is not active for this URL.', 'themebeans' );
							break;

						case 'item_name_mismatch':
							/* translators: EDD Item Name */
							$message = esc_html__( 'This appears to be an invalid license key.', 'themebeans' );
							break;

						case 'no_activations_left':
							$message = esc_html__( 'Your license key has reached its activation limit.', 'themebeans' );
							break;

						default:
							$message = esc_html__( 'An error occurred, please try again.', 'themebeans' );
							break;
					}
				} else {
					if ( 'valid' === $response->license ) {
						$message = esc_html__( 'Your theme is activated! Remote updates and theme support are enabled.', 'themebeans' );
						$success = true;
					}
				}
			}

			// We need to update the license at the same time the message is updated.
			if ( $response && isset( $response->license ) ) {

				// Set up options.
				$options = array();

				// Pull options from WP.
				$license_options = get_option( 'themebeans_license', array() );

				// Get the license key.
				$options['key'] = $license_key;

				// Get the license status.
				$response_status   = $response->license;
				$options['status'] = $response_status;

				// Get the license expiration date.
				$response_expiration   = date_i18n( get_option( 'date_format' ), strtotime( $response->expires ) );
				$options['expiration'] = $response_expiration;

				// Get the number of activations left.
				$response_site_count   = $response->site_count;
				$options['site_count'] = $response_site_count;

				// Get the number of activations left.
				$response_activations_left   = $response->activations_left;
				$options['activations_left'] = $response_activations_left;

				// Get the time this check ran.
				$options['last_checked'] = date( 'Y-m-d H:i:s' );

				// Merge options.
				$merged_options  = array_merge( $license_options, $options );
				$license_options = $merged_options;

				update_option( 'themebeans_license', $license_options );
			}

			return compact( 'success', 'message' );
		}
	}

endif;
