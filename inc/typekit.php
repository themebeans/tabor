<?php
/**
 * Add Typekit Support
 * See: https://typekit.com/
 *
 * @package     Tabor
 * @link        https://themebeans.com/themes/tabor
 */

if ( ! function_exists( 'tabor_typekit_setup' ) ) :
	/**
	 * Enqueue Typekit scripts.
	 */
	function tabor_typekit_setup() {

		// Get the option from the Customizer > Typography section.
		$typekit_id = get_theme_mod( 'typekit_id', tabor_defaults( 'typekit_id' ) );

		// Return if there's no font ID.
		if ( empty( $typekit_id ) ) {
			return;
		}

		// Enqueue the Typekit Javascript file, using the Typekit ID provided.
		wp_enqueue_script( 'tabor-typekit', '//use.typekit.net/' . esc_js( $typekit_id ) . '.js', false, '@@pkg.version', 'all' );

		// Add the inine script.
		if ( wp_script_is( 'tabor-typekit', 'enqueued' ) ) {
			wp_add_inline_script( 'tabor-typekit', 'try{Typekit.load({ async: true });}catch(e){}' );
		}
	}
endif;
add_action( 'wp_head', 'tabor_typekit_setup', 6 );
add_action( 'enqueue_block_editor_assets', 'tabor_typekit_setup' );

/**
 * Prepends the Typekit enabled fonts added to the Customizer.
 *
 * @param  array $fonts Default fonts from the ava_get_fonts function.
 * @return array of default fonts, plus the new typekit additions.
 */
function tabor_typekit_fonts( $fonts ) {

	// Get the options from the Customizer > Typography section.
	$typekit_id = get_theme_mod( 'typekit_id', tabor_defaults( 'typekit_id' ) );
	$font_1     = get_theme_mod( 'typekit_font_1', tabor_defaults( 'typekit_font_1' ) );
	$font_2     = get_theme_mod( 'typekit_font_2', tabor_defaults( 'typekit_font_2' ) );

	// Return if there's no font family added.
	if ( empty( $typekit_id ) || ( ! $font_1 && ! $font_2 ) ) {
		return $fonts;
	}

	if ( $font_1 ) {
		// Generate the slug.
		$font_1_slug = ( $font_1 ) ? strtolower( preg_replace( '/\s+/', '-', $font_1 ) ) : null;

		// Setup the array.
		$typekit_fonts = array(
			$font_1_slug => $font_1,
		);

		// Combine arrays.
		$fonts = array_merge( $typekit_fonts, $fonts );
	}

	if ( $font_2 ) {
		// Generate the slug.
		$font_2_slug = ( $font_1 ) ? strtolower( preg_replace( '/\s+/', '-', $font_2 ) ) : null;

		// Setup the array.
		$typekit_fonts = array(
			$font_2_slug => $font_2,
		);

		// Combine arrays.
		$fonts = array_merge( $typekit_fonts, $fonts );
	}

	return $fonts;
}
add_filter( 'tabor_fonts', 'tabor_typekit_fonts' );
