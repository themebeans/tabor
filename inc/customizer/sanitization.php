<?php
/**
 * Customizer: Sanitization Callbacks
 *
 * This file defines sanitization callback functions for various data types
 * referred to in the Customizer.
 *
 * @see https://github.com/WPTRT/code-examples/blob/master/customizer/sanitization-callbacks.php
 *
 * @package     Tabor
 * @link        https://themebeans.com/themes/tabor
 */

/**
 * Checkbox sanitization callback example.
 *
 * Sanitization callback for 'checkbox' type controls. This callback sanitizes `$checked`
 * as a boolean value, either TRUE or FALSE.
 *
 * @param bool $checked Whether the checkbox is checked.
 * @return bool Whether the checkbox is checked.
 */
function tabor_sanitize_checkbox( $checked ) {
	// Boolean check.
	return ( ( isset( $checked ) && true === $checked ) ? true : false );
}

/**
 * Image sanitization callback example.
 *
 * Checks the image's file extension and mime type against a whitelist. If they're allowed,
 * send back the filename, otherwise, return the setting default.
 *
 * - Sanitization: image file extension
 * - Control: text, WP_Customize_Image_Control
 *
 * @see wp_check_filetype() https://developer.wordpress.org/reference/functions/wp_check_filetype/
 *
 * @param string|string        $image   Image filename.
 * @param WP_Customize_Setting $setting Setting instance.
 * @return string The image filename if the extension is allowed; otherwise, the setting default.
 */
function tabor_sanitize_image( $image, $setting ) {
	/*
	 * Array of valid image file types.
	 *
	 * The array includes image mime types that are included in wp_get_mime_types()
	 */
	$mimes = array(
		'jpg|jpeg|jpe' => 'image/jpeg',
		'gif'          => 'image/gif',
		'png'          => 'image/png',
		'bmp'          => 'image/bmp',
		'tif|tiff'     => 'image/tiff',
		'ico'          => 'image/x-icon',
	);

	// Return an array with file extension and mime_type.
	$file = wp_check_filetype( $image, $mimes );

	// If $image has a valid mime_type, return it; otherwise, return the default.
	return ( $file['ext'] ? $image : $setting->default );
}

/**
 * No-HTML sanitization callback example.
 *
 * - Sanitization: nohtml
 * - Control: text, textarea, password
 *
 * Sanitization callback for 'nohtml' type text inputs. This callback sanitizes `$nohtml`
 * to remove all HTML.
 *
 * NOTE: wp_filter_nohtml_kses() can be passed directly as `$wp_customize->add_setting()`
 * 'sanitize_callback'. It is wrapped in a callback here merely for example purposes.
 *
 * @see wp_filter_nohtml_kses() https://developer.wordpress.org/reference/functions/wp_filter_nohtml_kses/
 *
 * @param string|string $nohtml The no-HTML content to sanitize.
 * @return string Sanitized no-HTML content.
 */
function tabor_sanitize_nohtml( $nohtml ) {
	return wp_filter_nohtml_kses( $nohtml );
}

/**
 * Sanitization: html
 * Control: textarea
 *
 * Sanitization callback for 'html' type text inputs. This
 * callback sanitizes $input for HTML allowable in posts.
 *
 * https://codex.wordpress.org/Function_Reference/wp_kses
 * https://gist.github.com/adamsilverstein/10783774
 * https://github.com/devinsays/options-framework-plugin/blob/master/options-check/functions.php#L69
 * http://ottopress.com/2010/wp-quickie-kses/
 *
 * @uses wp_filter_post_kses() https://developer.wordpress.org/reference/functions/wp_filter_post_kses/
 * @uses wp_kses() https://developer.wordpress.org/reference/functions/wp_kses/
 */
function tabor_sanitize_html( $input ) {
	global $allowedposttags;
	return wp_kses( $input, $allowedposttags );
}

/**
 * Number sanitization callback example.
 *
 * - Sanitization: number_absint
 * - Control: number
 *
 * Sanitization callback for 'number' type text inputs. This callback sanitizes `$number`
 * as an absolute integer (whole number, zero or greater).
 *
 * NOTE: absint() can be passed directly as `$wp_customize->add_setting()` 'sanitize_callback'.
 * It is wrapped in a callback here merely for example purposes.
 *
 * @see absint() https://developer.wordpress.org/reference/functions/absint/
 *
 * @param int                  $number  Number to sanitize.
 * @param WP_Customize_Setting $setting Setting instance.
 * @return int Sanitized number; otherwise, the setting default.
 */
function tabor_sanitize_number_absint( $number, $setting ) {
	// Ensure $number is an absolute integer (whole number, zero or greater).
	$number = absint( $number );

	// If the input is an absolute integer, return it; otherwise, return the default.
	return ( $number ? $number : $setting->default );
}

/**
 * Inverval sanitization callback.
 *
 * @param int $int Number to sanitize.
 * @return int Sanitized number; otherwise, the setting default.
 */
function tabor_sanitize_number_intval( $int ) {
	return intval( $int );
}

/**
 * Select sanitization callback example.
 *
 * - Sanitization: select
 * - Control: select, radio
 *
 * Sanitization callback for 'select' and 'radio' type controls. This callback sanitizes `$input`
 * as a slug, and then validates `$input` against the choices defined for the control.
 *
 * @see sanitize_key()               https://developer.wordpress.org/reference/functions/sanitize_key/
 * @see $wp_customize->get_control() https://developer.wordpress.org/reference/classes/wp_customize_manager/get_control/
 *
 * @param string|string        $input   Slug to sanitize.
 * @param WP_Customize_Setting $setting Setting instance.
 * @return string Sanitized slug if it is a valid choice; otherwise, the setting default.
 */
function tabor_sanitize_select( $input, $setting ) {

	// Ensure input is a slug.
	$input = sanitize_key( $input );

	// Get list of choices from the control associated with the setting.
	$choices = $setting->manager->get_control( $setting->id )->choices;

	// If the input is a valid key, return it; otherwise, return the default.
	return ( array_key_exists( $input, $choices ) ? $input : $setting->default );
}
