<?php
/**
 * Amazon Polly support.
 *
 * @package     Tabor
 * @link        https://themebeans.com/themes/tabor
 */

/**
 * Customizer.
 *
 * @param WP_Customize_Manager $wp_customize the Customizer object.
 */
function tabor_amazon_polly_adjust_customizer_section_priority( $wp_customize ) {
	$wp_customize->get_section( 'amazonpolly' )->priority = 151;
}
add_action( 'customize_register', 'tabor_amazon_polly_adjust_customizer_section_priority' );

/**
 * Add a label to the Amazon Polly player.
 */
function tabor_amazon_polly_label() {

	if ( ! is_single() ) {
		return;
	}

	// Filter the text.
	$text = apply_filters( 'tabor_amazon_polly_label', esc_html__( 'Listen to this article:', 'tabor' ) );

	// Add the play icon.
	$icon = wp_kses( tabor_get_svg( array( 'icon' => 'play' ) ), tabor_svg_allowed_html() );

	$markup  = '';
	$markup .= '<div class="amazon-polly-label flex align-center">';
	$markup .= $icon;
	$markup .= sprintf( '<p class="amazon-polly-label-text relative h6 header-font gray">%1s</p>', $text );
	$markup .= '</div>';

	return $markup;
}

/**
 * Prepend a label to the Amazon Polly player.
 *
 * @param array $content Post content.
 */
function tabor_amazon_polly_label_before_post( $content ) {

	if ( get_post_meta( $GLOBALS['post']->ID, 'amazon_polly_enable', true ) === '1' ) {

		// Set a label.
		$label = tabor_amazon_polly_label();

		// Get the position of the player.
		$selected_position = get_option( 'amazon_polly_position' );

		// Preserve the original content.
		$original_content = $content;

		// Change the output of the label based on the position.
		if ( strcmp( $selected_position, 'Do not show' ) === 0 ) {
			$content = $original_content;
		} elseif ( strcmp( $selected_position, 'Before post' ) === 0 ) {
			$content = $label . $original_content;
		}
	}

	return $content;
}
add_filter( 'the_content', 'tabor_amazon_polly_label_before_post', 99999 );

/**
 * Add a "Listen" part if Amazon Polly is installed.
 *
 * @param array $content Post content.
 */
function tabor_amazon_polly_label_after_post( $content ) {

	if ( get_post_meta( $GLOBALS['post']->ID, 'amazon_polly_enable', true ) === '1' ) {

		// Set a label.
		$label = tabor_amazon_polly_label();

		// Get the position of the player.
		$selected_position = get_option( 'amazon_polly_position' );

		// Preserve the original content.
		$original_content = $content;

		// Change the output of the label based on the position.
		if ( strcmp( $selected_position, 'Do not show' ) === 0 ) {
			$content = $original_content;
		} elseif ( strcmp( $selected_position, 'After post' ) === 0 ) {
			$content = $original_content . $label;
		}
	}

	return $content;
}
add_filter( 'the_content', 'tabor_amazon_polly_label_after_post', 1 );
