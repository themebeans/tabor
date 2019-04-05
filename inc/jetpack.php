<?php
/**
 * Jetpack Compatibility File
 * See: http://jetpack.me/
 *
 * @package     Tabor
 * @link        https://themebeans.com/themes/tabor
 */

/**
 * Add JetPack support.
 */
function tabor_jetpack_setup() {

	/**
	 * Add support for JetPack Infinite scrolling.
	 *
	 * @see https://jetpack.com/support/infinite-scroll/
	 * @since Tabor 1.0.5
	 */
	add_theme_support(
		'infinite-scroll', array(
			'container' => 'main',
			'footer'    => false,
			'render'    => 'tabor_infinite_scroll',
		)
	);

}
add_action( 'after_setup_theme', 'tabor_jetpack_setup' );

/**
 * Custom Infinite Scroll Render function.
 */
function tabor_infinite_scroll() {
	while ( have_posts() ) {
		the_post();
		get_template_part( 'components/post/content', get_post_format() );
	}
}

/**
 * Filter Jetpack's Infinite Scroll text on button that loads more posts.
 *
 * @param array $settings An array of settings for infinite scroll.
 */
function tabor_filter_jetpack_infinite_scroll_button_text( $settings ) {

	$text = apply_filters( 'tabor_infinite_scroll_button_text', esc_html__( 'Load More...', 'tabor' ) );

	$settings['text'] = esc_html( $text );

	return $settings;
}
add_filter( 'infinite_scroll_js_settings', 'tabor_filter_jetpack_infinite_scroll_button_text' );

/**
 * Remove sharing, so we can place it elsewhere.
 */
function tabor_filter_jetpack_sharing() {
	remove_filter( 'the_content', 'sharing_display', 19 );
	remove_filter( 'the_excerpt', 'sharing_display', 19 );
}
add_action( 'loop_start', 'tabor_filter_jetpack_sharing' );

if ( ! function_exists( 'tabor_jetpack_sharing' ) ) :
	/**
	 * Jetpack's sharing module.
	 *
	 * Create your own tabor_jetpack_sharing() to override in a child theme.
	 */
	function tabor_jetpack_sharing() {

		if ( ! class_exists( 'Jetpack' ) ) {
			return;
		}

		if ( function_exists( 'sharing_display' ) ) :

			$sidebar_class = ( is_active_sidebar( 'sidebar-3' ) ) ? ' has-sidebar' : null;

			echo '<div class="container ' . esc_attr( $sidebar_class ) . '">';

			if ( function_exists( 'sharing_display' ) ) {
				sharing_display( '', true );
			}
			echo '</div>';

		endif;

	}
endif;
add_action( 'tabor_after_comments', 'tabor_jetpack_sharing' );
