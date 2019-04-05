<?php
/**
 * Load metabox functionality from CMB2.
 *
 * @package     ThemeBeans Admin
 * @link        https://themebeans.com/
 */

/**
 * Query whether the theme uses CMB2.
 */
function themebeans_is_cmb2() {

	if ( has_action( 'cmb2_admin_init' ) ) {
		return true;
	} else {
		return false;
	}
}

/**
 * Load CMB2 if this theme is compatible and the pre-packaged plugin exists.
 */
function themebeans_meta() {
	/*
	 * Let's check if CMB2 is activated via plugin form. If so, use that version.
	 */
	include_once ABSPATH . 'wp-admin/includes/plugin.php';

	if ( is_plugin_active( 'cmb2/init.php' ) ) {
		return;
	}

	if ( themebeans_is_cmb2() && file_exists( get_parent_theme_file_path( '/inc/admin/metaboxes/cmb2/init.php' ) ) ) {
		require get_parent_theme_file_path( '/inc/admin/metaboxes/cmb2/init.php' );
	}
}
add_action( 'init', 'themebeans_meta' );

/**
 * Enqueue a custom stylesheet for CMB2.
 *
 * @todo Ensure this only enqueues on the proper editing screens.
 */
function themebeans_meta_styles( $hook ) {

	// Only enqueue this script on edit screens.
	if ( 'edit.php' !== $hook && 'post.php' !== $hook && 'post-new.php' !== $hook ) {
		return;
	}

	if ( file_exists( get_parent_theme_file_path( '/inc/admin/metaboxes/css/style-metaboxes.min.css' ) ) ) {
		wp_enqueue_style( 'themebeans-metaboxes', get_parent_theme_file_uri( '/inc/admin/metaboxes/css/style-metaboxes.min.css' ), false, '@@pkg.version', 'all' );
	}
}
add_action( 'admin_enqueue_scripts', 'themebeans_meta_styles' );
