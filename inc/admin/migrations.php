<?php
/**
 * Migrations.
 *
 * @package     ThemeBeans Admin
 * @link        https://themebeans.com/
 */

/**
 * Site logo update script
 *
 * Runs if version number saved in theme_mod "version" doesn't match current theme version.
 */
function themebeans_logo_migration() {

	// Return if a custom logo already exists.
	if ( get_theme_mod( 'custom_logo', false ) ) {
		return;
	}

	// If we're not on 3.5 yet, exit now.
	if ( ! function_exists( 'the_custom_logo' ) ) {
		return;
	}

	// Set a default value of false for the custom logo.
	$custom_logo = false;

	// If a logo has been set previously, update to use logo feature introduced in WordPress 4.5.
	if ( get_theme_mod( 'site_logo', false ) ) {

		// Since previous logo was stored a URL, convert it to an attachment ID.
		$logo = attachment_url_to_postid( get_theme_mod( 'site_logo' ) );

		if ( is_int( $logo ) ) {
			$custom_logo = $logo;
		}

		set_theme_mod( 'custom_logo', $custom_logo );

		remove_theme_mod( 'site_logo' );
	}
}
add_action( 'after_setup_theme', 'themebeans_logo_migration' );

/**
 * Site logo (alternate, for really older themes) update script
 *
 * Runs if version number saved in theme_mod "version" doesn't match current theme version.
 */
function themebeans_logo_older_themes_migration() {

	// Return if a custom logo already exists.
	if ( get_theme_mod( 'custom_logo', false ) ) {
		return;
	}

	// If we're not on 3.5 yet, exit now.
	if ( ! function_exists( 'the_custom_logo' ) ) {
		return;
	}

	// Set a default value of false for the custom logo.
	$custom_logo = false;

	// If a logo has been set previously, update to use logo feature introduced in WordPress 4.5.
	if ( get_theme_mod( 'img-upload-logo', false ) ) {

		// Since previous logo was stored a URL, convert it to an attachment ID.
		$logo = attachment_url_to_postid( get_theme_mod( 'img-upload-logo' ) );

		if ( is_int( $logo ) ) {
			$custom_logo = $logo;
		}

		set_theme_mod( 'custom_logo', $custom_logo );

		remove_theme_mod( 'img-upload-logo' );
	}

	// If a logo has been set previously, update to use logo feature introduced in WordPress 4.5.
	if ( get_theme_mod( 'retina_logo', false ) ) {

		// Since previous logo was stored a URL, convert it to an attachment ID.
		$logo = attachment_url_to_postid( get_theme_mod( 'retina_logo' ) );

		if ( is_int( $logo ) ) {
			$custom_logo = $logo;
		}

		set_theme_mod( 'custom_logo', $custom_logo );

		remove_theme_mod( 'retina_logo' );
	}
}
add_action( 'after_setup_theme', 'themebeans_logo_older_themes_migration' );

/**
 * Site logo update script
 *
 * Runs if version number saved in theme_mod "version" doesn't match current theme version.
 */
function themebeans_logo_width_migration() {

	// If we're not on 3.5 yet, exit now.
	if ( ! function_exists( 'the_custom_logo' ) ) {
		return;
	}

	// Set a default value of false for the custom logo.
	$retina_width = false;

	// If a logo has been set previously, update to use logo feature introduced in WordPress 4.5.
	if ( get_theme_mod( 'site_logo_width', false ) ) {

		// Grab the old width.
		$width = get_theme_mod( 'site_logo_width' );

		if ( $width ) {

			// The old width value may have pixels. We don't need those.
			$retina_width = str_replace( 'px', '', $width );
		}

		set_theme_mod( 'custom_logo_max_width', $retina_width );

		remove_theme_mod( 'site_logo_width' );
	}
}
add_action( 'after_setup_theme', 'themebeans_logo_width_migration' );

/**
 * Theme license key migration.
 */
function themebeans_license_key_migration() {

	$slug = themebeans_get_theme( true );

	// Set up options.
	$options = array();

	// Pull new license options.
	$license_options = get_option( 'themebeans_license', array() );

	$old_license_option            = get_option( $slug . '_license_key' );
	$old_license_status_option     = get_option( $slug . '_license_key_status' );
	$old_license_expiration_option = get_option( $slug . '_license_expiration' );

	if ( $old_license_option ) {
		$options['key'] = $old_license_option;
	}

	if ( $old_license_status_option ) {
		$options['status'] = $old_license_status_option;
	}

	if ( $old_license_expiration_option ) {
		$options['expiration'] = $old_license_expiration_option;
	}

	// Merge options.
	$merged_options  = array_merge( $license_options, $options );
	$license_options = $merged_options;

	// Update new licensing.
	update_option( 'themebeans_license', $license_options );

	// Remove old settings.
	delete_option( $slug . '_license_key' );
	delete_option( $slug . '_license_key_status' );
	delete_option( $slug . '_license_expiration' );

	// Remove old transients.
	delete_transient( $slug . '-update-response' );
	delete_transient( $slug . '_license_message' );
	delete_transient( $slug . '_themebeans_club_subscription' );
	delete_transient( $slug . '_themebeans_club_email' );
}
add_action( 'after_setup_theme', 'themebeans_license_key_migration' );
