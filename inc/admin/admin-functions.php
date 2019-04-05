<?php
/**
 * Dashboard functions
 *
 * @package     ThemeBeans Admin
 * @link        https://themebeans.com/
 */

/**
 * Retrieve the current theme's name or URL slug.
 *
 * @param string|string $url URL or not.
 */
function themebeans_get_theme( $url ) {

	// Get the parent theme's name.
	$theme = esc_attr( wp_get_theme( get_template() )->get( 'Name' ) );

	// Replace spaces with hypens, and makes it lowercase for links.
	if ( true === $url ) {
		$theme = strtolower( $theme );
		$theme = str_replace( ' ', '-', $theme );
		$theme = preg_replace( '#[ -]+#', '-', $theme );
	} else {
		$theme = str_replace( '_', ' ', $theme );
	}

	return $theme;
}

/**
 * Theme changelog in footer admin.
 *
 * @param string|string $html WordPress version.
 */
function themebeans_dashboard_footer_version( $html ) {

	// Get the parent theme's current version number.
	$version = wp_get_theme( get_template() )->get( 'Version' );
	$html   .= ' | ' . esc_html( themebeans_get_theme( false ) . '&nbsp;' . $version );

	return $html;
}

/**
 * Dashboard help guide.
 */
if ( ! function_exists( 'themebeans_guide' ) ) :
	/**
	 * Initiate the inline dashboard help guide.
	 *
	 * Add the following in your child theme to disable the inline docs:
	 *
	 * function themebeans_guide() {}
	 *
	 * Note that this does not disable the theme updater or the inline docs.
	 *
	 * @link https://gist.github.com/richtabor/7a7da34f9db5b1eddae9976445e29ca3
	 */
	function themebeans_guide() {

		require get_parent_theme_file_path( '/inc/admin/guide/class-themebeans-guide.php' );

		if ( ! class_exists( 'ThemeBeans_Guide' ) ) {
			return;
		}

		global $pagenow;

		// No inline-docs on the post editing screens, as Gutenberg causes issues.
		if ( 'post.php' === $pagenow || 'post-new.php' === $pagenow && function_exists( 'register_block_type' ) ) {
			return;
		}

		$markdown_url = 'https://raw.githubusercontent.com/themebeans/theme-docs/master/' . esc_attr( themebeans_get_theme( true ) ) . '/readme.md';

		$huh = new ThemeBeans_Guide();
		$huh->init( $markdown_url );
	}
endif;
add_action( 'admin_init', 'themebeans_guide' );

/**
 * This function takes a css-string and compresses it, removing
 * unneccessary whitespace, colons, removing unneccessary px/em
 * declarations etc.
 *
 * @param string $css Styles to be minified.
 * @return string compressed css content
 * @see https://github.com/Schepp/CSS-JS-Booster
 */
function themebeans_minify_css( $css ) {
	// Remove comments.
	$css = preg_replace( '!/\*[^*]*\*+([^/][^*]*\*+)*/!', '', $css );

	// Backup values within single or double quotes.
	preg_match_all( '/(\'[^\']*?\'|"[^"]*?")/ims', $css, $hit, PREG_PATTERN_ORDER );
	$count = count( $hit[1] );
	for ( $i = 0; $i < $count; $i++ ) {
		$css = str_replace( $hit[1][ $i ], '##########' . $i . '##########', $css );
	}

	// Remove traling semicolon of selector's last property.
	$css = preg_replace( '/;[\s\r\n\t]*?}[\s\r\n\t]*/ims', "}\r\n", $css );

	// Remove any whitespace between semicolon and property-name.
	$css = preg_replace( '/;[\s\r\n\t]*?([\r\n]?[^\s\r\n\t])/ims', ';$1', $css );

	// Remove any whitespace surrounding property-colon.
	$css = preg_replace( '/[\s\r\n\t]*:[\s\r\n\t]*?([^\s\r\n\t])/ims', ':$1', $css );

	// Remove any whitespace surrounding selector-comma.
	$css = preg_replace( '/[\s\r\n\t]*,[\s\r\n\t]*?([^\s\r\n\t])/ims', ',$1', $css );

	// Remove any whitespace surrounding opening parenthesis.
	$css = preg_replace( '/[\s\r\n\t]*{[\s\r\n\t]*?([^\s\r\n\t])/ims', '{$1', $css );

	// Remove any whitespace between numbers and units.
	$css = preg_replace( '/([\d\.]+)[\s\r\n\t]+(px|em|pt|%)/ims', '$1$2', $css );

	// Shorten zero-values.
	$css = preg_replace( '/([^\d\.]0)(px|em|pt|%)/ims', '$1', $css );

	// Constrain multiple whitespaces.
	$css = preg_replace( '/\p{Zs}+/ims', ' ', $css );

	// Remove newlines.
	$css = str_replace( array( "\r\n", "\r", "\n" ), '', $css );

	// Restore backupped values within single or double quotes.
	$count = count( $hit[1] );
	for ( $i = 0; $i < $count; $i++ ) {
		$css = str_replace( '##########' . $i . '##########', $hit[1][ $i ], $css );
	}
	return $css;
}
