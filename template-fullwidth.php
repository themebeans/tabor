<?php
/**
 * Template Name: Fullwidth
 * The template for displaying a fullwidth template.
 *
 * @package     Tabor
 * @link        https://themebeans.com/themes/tabor
 */

get_header();

while ( have_posts() ) :

	the_post();

	// If this page is protected, let's re-route.
	if ( post_password_required() ) :
		get_template_part( 'components/post/content-password-protected', get_post_format() );
	else :
		get_template_part( 'components/page/content', 'page' );

		do_action( 'tabor_before_comments' );

		/*
		 * If comments are open or we have at least one comment, load up the comment template.
		 *
		 * @link https://codex.wordpress.org/Function_Reference/comments_open/
		 * @link https://codex.wordpress.org/Template_Tags/get_comments_number/
		 * @link https://developer.wordpress.org/reference/functions/comments_template/
		 */
		if ( comments_open() || get_comments_number() ) :
			comments_template();
		endif;

		do_action( 'tabor_after_comments' );
	endif;

endwhile; // End of the loop.

get_footer();
