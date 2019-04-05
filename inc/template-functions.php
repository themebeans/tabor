<?php
/**
 * Additional features to allow styling of the templates.
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package     Tabor
 * @link        https://themebeans.com/themes/tabor
 */

/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 * @return array (Maybe) filtered body classes.
 */
function tabor_body_classes( $classes ) {
	global $post;

	// If comments are open and there are no comments.
	if ( ! is_404() && ( ! get_comments_number() && post_type_supports( get_post_type(), 'comments' ) ) ) {
		if ( comments_open() && ! get_comments_number() ) {
			$classes[] = 'has-no-comments';
		}
	}

	// Add a class if the sidebar is active.
	if ( ( is_singular( 'post' ) || is_page() ) && is_active_sidebar( 'sidebar-3' ) ) {
		$classes[] = 'has-sidebar';
	}

	// Add a class for the comments visibility setting.
	$comments_visibility = get_theme_mod( 'comments_visibility', tabor_defaults( 'comments_visibility' ) );
	if ( true === $comments_visibility ) {
		$classes[] = 'has-hidden-comments';
	}

	// Add a class for the bar style.
	$bar_style = get_theme_mod( 'post_bar_style', tabor_defaults( 'post_bar_style' ) );
	if ( 'drop-in-style-1' !== $bar_style ) {
		$classes[] = $bar_style;
	}

	// Add a class if selective sharing is enabled.
	if ( true === get_theme_mod( 'selective_sharing', tabor_defaults( 'selective_sharing' ) ) ) {
		$classes[] = 'has-selective-sharing';
	}

	return $classes;
}
add_filter( 'body_class', 'tabor_body_classes' );

/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 * @return array (Maybe) filtered body classes.
 */
function tabor_admin_body_classes( $classes ) {
	global $post;

	if ( ! $post ) {
		return $classes;
	}

	$template = get_page_template_slug( $post->ID );

	// Add a class if the sidebar is active.
	if ( 'template-fullwidth.php' === $template ) {
		$classes = 'page-template-template-fullwidth-php';
	}

	return $classes;
}
add_filter( 'admin_body_class', 'tabor_admin_body_classes' );

/**
 * Adds a custom template for the block editor for the post type.
 */
function tabor_add_template_to_posts() {

	if ( function_exists( 'register_block_type' ) && true === get_theme_mod( 'single_featured_media', tabor_defaults( 'single_featured_media' ) ) ) {
		return;
	}

	$post_type_object = get_post_type_object( 'post' );

	$post_type_object->template = array(
		array(
			'core/image',
			array(
				'align' => 'wide',
			),
		),
		array( 'core/paragraph' ),
	);
}
add_action( 'init', 'tabor_add_template_to_posts' );
