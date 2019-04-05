<?php
/**
 * Custom shortcodes.
 *
 * @package     Tabor
 * @link        https://themebeans.com/themes/tabor
 */

/**
 * Shortcode for Typed.JS functionality.
 *
 * @example: [typed text="ThemeBeans Founder, Designer, WordPress Developer"]
 * @param array $atts An array of arguments.
 */
function tabor_typed_shortcode( $atts ) {

	// Set up defaults.
	$args = shortcode_atts(
		array(
			'text' => 'ThemeBeans Founder, Designer, WordPress Developer',
		), $atts
	);

	// Convert the args so we can use it.
	$args     = implode( ',', $args );
	$new_args = explode( ',', $args );

	$text = array();

	// Prepare the shortcode text $atts.
	foreach ( $new_args as $key => $value ) {
		// Wrap each item in <p> tags.
		$text[] = sprintf( '<p>%1$s</p>', esc_html( $value ) );
	}

	// Join the array.
	$printed_text = join( '', $text );

	$output  = '<div class="typed-content">';
	$output .= '<h2 class="h2 extra-large extra-important"><span id="animated-headline"></span></h2>';
	$output .= '<div class="animated-headline--strings hide">';
	$output .= $printed_text;
	$output .= '</div>';
	$output .= '</div>';

	return $output;
}
add_shortcode( 'typed', 'tabor_typed_shortcode' );
