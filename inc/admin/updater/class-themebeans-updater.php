<?php
/**
 * ThemeBeans Theme Updater
 *
 * @package     ThemeBeans Admin
 * @link        https://themebeans.com/
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! class_exists( 'ThemeBeans_Updater' ) ) :
	/**
	 * Automatic update notification and download class.
	 *
	 * Creates a way to download theme updates from a remote server.
	 *
	 * @package Tabor
	 */
	class ThemeBeans_Updater {
		/**
		 * The API URL of the site we're sending the update request to.
		 *
		 * @var string $remote_api_url
		 */
		private $remote_api_url;

		/**
		 * The API URL of the site we're sending the update request to.
		 *
		 * @var string $request_data
		 */
		private $request_data;

		/**
		 * The response key.
		 *
		 * @var string $response_key
		 */
		private $response_key;

		/**
		 * The theme slug.
		 *
		 * @var string $theme_slug
		 */
		private $theme_slug;

		/**
		 * The customer's license key.
		 *
		 * @var string $license_key
		 */
		private $license_key;

		/**
		 * The theme version.
		 *
		 * @var string $version
		 */
		private $version;

		/**
		 * The author of the download.
		 *
		 * @var string $author
		 */
		private $author;

		/**
		 * Add an update transient.
		 *
		 * @param array $args Download args.
		 */
		public function __construct( $args = array() ) {

			$defaults = array(
				'remote_api_url' => '',
				'request_data'   => array(),
				'theme_slug'     => get_template(),
				'item_name'      => '',
				'license'        => '',
				'version'        => '',
				'author'         => '',
				'beta'           => false,
			);

			$args = wp_parse_args( $args, $defaults );

			$this->license        = $args['license'];
			$this->item_name      = $args['item_name'];
			$this->version        = $args['version'];
			$this->theme_slug     = sanitize_key( $args['theme_slug'] );
			$this->author         = $args['author'];
			$this->beta           = $args['beta'];
			$this->remote_api_url = $args['remote_api_url'];
			$this->response_key   = $this->theme_slug . '_update_response';

			add_filter( 'site_transient_update_themes', array( $this, 'theme_update_transient' ) );
			add_filter( 'delete_site_transient_update_themes', array( $this, 'delete_theme_update_transient' ) );
			add_action( 'load-update-core.php', array( $this, 'delete_theme_update_transient' ) );
			add_action( 'load-themes.php', array( $this, 'delete_theme_update_transient' ) );
			add_action( 'load-themes.php', array( $this, 'load_notices' ) );
		}

		/**
		 * Loads the theme update.
		 */
		public function load_notices() {
			add_action( 'admin_notices', array( $this, 'update_nag' ) );
		}

		/**
		 * Display the update notifications.
		 *
		 * @return void
		 */
		public function update_nag() {

			// If for some reason the licensing class is not found, return.
			if ( ! class_exists( 'ThemeBeans_License' ) ) {
				return;
			}

			$theme        = wp_get_theme( $this->theme_slug );
			$api_response = get_transient( $this->response_key );

			$license    = new ThemeBeans_License();
			$expiration = $license->expiration();
			$status     = $license->status();

			if ( false === $api_response ) {
				return;
			}

			$update_url     = wp_nonce_url( 'update.php?action=upgrade-theme&amp;theme=' . rawurlencode( $this->theme_slug ), 'upgrade-theme_' . $this->theme_slug );
			$update_onclick = ' onclick="if ( confirm(\'' . esc_attr__( 'Updating this theme will lose any customizations you have made. "Cancel" to stop, "OK" to update.', 'themebeans' ) . '\') ) {return true;}return false;"';

			if ( version_compare( $this->version, $api_response->new_version, '<' ) ) {

				if ( 'expired' === $status ) {
					echo '<div class="notice notice-warning">';
						printf(
							__( '<p>%1$s <a href="%2$s" title="%2$s" target="blank">v%3$s</a> has been released, although a valid license is required to enable updates.</p>', 'themebeans' ),
							esc_html( $theme->get( 'Name' ) ),
							'http://demo.themebeans.com/wp-content/themes/' . esc_attr( $this->theme_slug ) . '/changelog.txt',
							esc_html( $api_response->new_version )
						);
					echo '</div>';
				} else {
					echo '<div id="update-nag">';
						printf(
							__( '<strong>%1$s %2$s</strong> is available. <a href="%3$s" title="%4$s" target="blank">Check out what\'s new</a> or <a href="%5$s" %6$s>update now</a>', 'themebeans' ),
							esc_html( $theme->get( 'Name' ) ),
							esc_html( $api_response->new_version ),
							'http://demo.themebeans.com/wp-content/themes/' . esc_attr( $this->theme_slug ) . '/changelog.txt',
							esc_html( $theme->get( 'Name' ) ),
							esc_url( $update_url ),
							esc_attr( $update_onclick )
						);
					echo '</div>';
				}
			}
		}

		/**
		 * Add an update transient.
		 *
		 * @param string $value Transient.
		 */
		function theme_update_transient( $value ) {

			$update_data = $this->check_for_update();

			if ( $update_data ) {
				$value->response[ $this->theme_slug ] = $update_data;
			}

			return $value;
		}

		/**
		 * Delete the transient.
		 */
		function delete_theme_update_transient() {
			delete_transient( $this->response_key );
		}

		/**
		 * Check for an update.
		 */
		function check_for_update() {

			$update_data = get_transient( $this->response_key );

			if ( false === $update_data ) {

				$failed = false;

				$api_params = array(
					'edd_action' => 'get_version',
					'license'    => $this->license,
					'name'       => $this->item_name,
					'slug'       => $this->theme_slug,
					'version'    => $this->version,
					'author'     => $this->author,
					'beta'       => $this->beta,
				);

				$response = wp_remote_post(
					$this->remote_api_url, array(
						'timeout' => 15,
						'body'    => $api_params,
					)
				);

				// Make sure the response was successful.
				if ( is_wp_error( $response ) || 200 !== wp_remote_retrieve_response_code( $response ) ) {
					$failed = true;
				}

				$update_data = json_decode( wp_remote_retrieve_body( $response ) );

				if ( ! is_object( $update_data ) ) {
					$failed = true;
				}

				// If the response failed, try again in 30 minutes.
				if ( $failed ) {
					$data              = new stdClass();
					$data->new_version = $this->version;
					set_transient( $this->response_key, $data, strtotime( '+60 minutes' ) );
					return false;
				}

				// If the status is 'ok', return the update arguments.
				if ( ! $failed ) {
					$update_data->sections = maybe_unserialize( $update_data->sections );
					set_transient( $this->response_key, $update_data, strtotime( '+36 hours' ) );
				}

				// Set up options.
				$options = array();

				// Pull options from WP.
				$license_options = get_option( 'themebeans_license', array() );

				// Get the time this check ran.
				$options['last_check_for_update'] = date( 'Y-m-d H:i:s' );

				// Merge options.
				$merged_options  = array_merge( $license_options, $options );
				$license_options = $merged_options;

				// Update options with the last_checked value.
				update_option( 'themebeans_license', $license_options );
			}

			if ( version_compare( $this->version, $update_data->new_version, '>=' ) ) {
				return false;
			}

			return (array) $update_data;
		}
	}
endif;
