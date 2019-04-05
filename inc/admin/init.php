<?php
/**
 * Load admin functionalities
 *
 * ThemeBeans Core: v1.6.1
 *
 * @package     ThemeBeans Admin
 * @link        https://themebeans.com/
 */

/**
 * Define variables.
 */
if ( ! defined( 'THEMEBEANS_ADMIN_DIR' ) ) :
	define( 'THEMEBEANS_ADMIN_DIR', '/inc/admin/' );
endif;

if ( ! defined( 'THEMEBEANS_UPDATER_DIR' ) ) :
	define( 'THEMEBEANS_UPDATER_DIR', '/inc/admin/updater/' );
endif;

if ( ! defined( 'THEMEBEANS_CUSTOM_CONTROLS_DIR' ) ) :
	define( 'THEMEBEANS_CUSTOM_CONTROLS_DIR', '/inc/admin/controls/' );
endif;

/**
 * Initiate.
 */
if ( ! function_exists( 'themebeans_admin_init' ) ) :
	/**
	 * Initiate the theme's admin.
	 *
	 * Add the following in your child theme to disable the admin features:
	 *
	 * function themebeans_admin_init() {}
	 *
	 * Note that this does not disable the theme updater or the inline docs.
	 *
	 * @link https://gist.github.com/richtabor/7a7da34f9db5b1eddae9976445e29ca3
	 */
	function themebeans_admin_init() {
		add_action( 'update_footer', 'themebeans_dashboard_footer_version', 12 );
	}
endif;
add_action( 'init', 'themebeans_admin_init' );

/**
 * Remote updater.
 */
if ( ! function_exists( 'themebeans_updater' ) ) :
	/**
	 * Theme license handler & updater functionality.
	 *
	 * Add the following in your child theme to disable the licensing and remote update features:
	 *
	 * function themebeans_updater() {}
	 *
	 * Note that you will need to manually update the theme and you will no longer receive update notifications.
	 *
	 * @link https://gist.github.com/richtabor/7a7da34f9db5b1eddae9976445e29ca3
	 */
	function themebeans_updater() {
		require get_parent_theme_file_path( THEMEBEANS_UPDATER_DIR . '/class-themebeans-license.php' );
		require get_parent_theme_file_path( THEMEBEANS_UPDATER_DIR . '/config.php' );
	}
endif;
add_action( 'after_setup_theme', 'themebeans_updater' );

/**
 * TGMPA.
 */
if ( file_exists( get_parent_theme_file_path( '/inc/plugins.php' ) ) ) {

	// The theme's recommeded plugins.
	require get_parent_theme_file_path( '/inc/plugins.php' );

	// Load TGMPA.
	require get_parent_theme_file_path( THEMEBEANS_ADMIN_DIR . '/tgmpa/class-tgm-plugin-activation.php' );

	// Load recommended plugins.
	require get_parent_theme_file_path( THEMEBEANS_ADMIN_DIR . '/recommended-plugins.php' );
}

/**
 * Merlin WP.
 */
if ( ! function_exists( 'themebeans_merlin' ) ) :
	/**
	 * Initiate Merlin WP.
	 *
	 * Add the following in your child theme to disable Merlin WP:
	 *
	 * function themebeans_merlin() {}
	 */
	function themebeans_merlin() {
		require_once get_parent_theme_file_path( THEMEBEANS_ADMIN_DIR . '/merlin/vendor/autoload.php' );
		require_once get_parent_theme_file_path( THEMEBEANS_ADMIN_DIR . '/merlin/class-merlin.php' );
		require_once get_parent_theme_file_path( THEMEBEANS_ADMIN_DIR . '/merlin-config.php' );
	}
endif;
add_action( 'after_setup_theme', 'themebeans_merlin' );

/**
 * This theme only works in WordPress 4.7 or later.
 */
if ( version_compare( $GLOBALS['wp_version'], '4.7', '<' ) ) {
	require get_parent_theme_file_path( THEMEBEANS_ADMIN_DIR . '/back-compat.php' );
}

/**
 * Admin functions.
 */
require get_parent_theme_file_path( THEMEBEANS_ADMIN_DIR . '/admin-functions.php' );

/**
 * Metabox functions.
 */
require get_parent_theme_file_path( THEMEBEANS_ADMIN_DIR . '/metaboxes/metaboxes.php' );

/**
 * Customizer controls.
 */
require get_parent_theme_file_path( THEMEBEANS_ADMIN_DIR . '/controls/controls.php' );

/**
 * Custom logo migration (for older themes).
 */
require get_parent_theme_file_path( THEMEBEANS_ADMIN_DIR . '/migrations.php' );
