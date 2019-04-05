<?php
/**
 * Add customizer colors to the block editor.
 *
 * @package     Tabor
 * @link        https://themebeans.com/themes/tabor
 */

/**
 * Add customizer colors to the block editor.
 */
function tabor_editor_customizer_generated_values() {

	// Retrieve colors from the Customizer.
	$background_color  = get_theme_mod( 'background_color', '#ffffff' );
	$text_color        = get_theme_mod( 'text_color', tabor_defaults( 'text_color' ) );
	$heading_color     = get_theme_mod( 'heading_color', tabor_defaults( 'heading_color' ) );
	$alt_heading_color = get_theme_mod( 'alt_heading_color', tabor_defaults( 'alt_heading_color' ) );

	// Fonts.
	$heading_font = get_theme_mod( 'heading_font', tabor_defaults( 'heading_font' ) );
	$body_font    = get_theme_mod( 'body_font', tabor_defaults( 'body_font' ) );

	if ( 'System Fonts' === $heading_font ) {
		$heading_font = '-apple-system, BlinkMacSystemFont, segoe ui, fira sans, helvetica neue, arial, sans-serif';
	}

	if ( 'System Fonts' === $body_font ) {
		$body_font = '-apple-system, BlinkMacSystemFont, segoe ui, fira sans, helvetica neue, arial, sans-serif';
	}

	if ( 'System Serif' === $heading_font ) {
		$heading_font = 'serif';
	}

	if ( 'System Serif' === $body_font ) {
		$body_font = 'serif';
	}

	// Build styles.
	$css = '';

	$css .= '.block-editor__container { background-color: #' . esc_attr( $background_color ) . '; }';
	$css .= '.editor-styles-wrapper.edit-post-visual-editor { color: ' . esc_attr( $text_color ) . '; }';
	$css .= '.wp-block-heading h1, .wp-block-heading h2, .wp-block-heading h3, .wp-block-heading h4, .wp-block-heading h5, .wp-block-heading h6 { color: ' . esc_attr( $heading_color ) . ' !important; }';
	$css .= '.editor-styles-wrapper.edit-post-visual-editor .editor-post-title__block .editor-post-title__input { color: ' . esc_attr( $heading_color ) . '; }';
	$css .= '.editor-styles-wrapper.edit-post-visual-editor figcaption:not(.blockgallery--caption), .editor-styles-wrapper.edit-post-visual-editor .blockgallery:not(.has-caption-color) figcaption { color: ' . esc_attr( $alt_heading_color ) . ' }';

	// Build fonts.
	if ( 'Default' !== $heading_font ) {
		$css .= '.editor-styles-wrapper .wp-block h1, .editor-styles-wrapper .wp-block h2, .editor-styles-wrapper .wp-block h3, .editor-styles-wrapper .wp-block h4, .editor-styles-wrapper .wp-block h5:not(.subHeading), .editor-styles-wrapper .wp-block h6 { font-family: ' . esc_attr( $heading_font ) . '; }';
		$css .= '.editor-styles-wrapper.edit-post-visual-editor .editor-post-title__block .editor-post-title__input { font-family: ' . esc_attr( $heading_font ) . '; }';
		$css .= '.editor-styles-wrapper .tabor-hero .typed-content p { font-family: ' . esc_attr( $heading_font ) . '; }';
		$css .= '.editor-styles-wrapper.edit-post-visual-editor .wp-block-quote:not(.is-style-large) p { font-family: ' . esc_attr( $heading_font ) . '; }';
		$css .= '.editor-styles-wrapper.edit-post-visual-editor .wp-block-pullquote p { font-family: ' . esc_attr( $heading_font ) . '; }';
		$css .= '.editor-styles-wrapper.edit-post-visual-editor .wp-block-latest-posts.is-grid li { font-family: ' . esc_attr( $heading_font ) . '; }';
		$css .= '.editor-styles-wrapper.edit-post-visual-editor .wp-block-cover-text { font-family: ' . esc_attr( $heading_font ) . '; }';
		$css .= '.editor-styles-wrapper.edit-post-visual-editor .wp-block-coblocks-author__name { font-family: ' . esc_attr( $heading_font ) . '; }';
		$css .= '.editor-styles-wrapper.edit-post-visual-editor .wp-block-coblocks-pricing-table-item__title { font-family: ' . esc_attr( $heading_font ) . '; }';
		$css .= '.editor-styles-wrapper.edit-post-visual-editor .wp-block-coblocks-pricing-table-item__amount { font-family: ' . esc_attr( $heading_font ) . '; }';
	}

	if ( 'Default' !== $body_font ) {
		$css .= '.editor-styles-wrapper.edit-post-visual-editor { font-family: ' . esc_attr( $body_font ) . '; }';
		$css .= '.editor-styles-wrapper.edit-post-visual-editor .wp-block-coblocks-author__heading { font-family: ' . esc_attr( $body_font ) . '; }';
	}

	return wp_strip_all_tags( apply_filters( 'tabor_editor_customizer_generated_values', $css ) );
}

/**
 * Enqueue Customizer settings into the block editor.
 */
function tabor_editor_customizer_styles() {

	// Register Customizer styles within the editor to use for inline additions.
	wp_register_style( 'tabor-editor-customizer-styles', false, '@@pkg.version', 'all' );

	// Enqueue the Customizer style.
	wp_enqueue_style( 'tabor-editor-customizer-styles' );

	// Add custom colors to the editor.
	wp_add_inline_style( 'tabor-editor-customizer-styles', tabor_editor_customizer_generated_values() );
}
add_action( 'enqueue_block_editor_assets', 'tabor_editor_customizer_styles' );
