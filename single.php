<?php
/**
 * The template for displaying all single posts.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package     Tabor
 * @link        https://themebeans.com/themes/tabor
 */

get_header();

// Start the loop.
while ( have_posts() ) :

	the_post();

	// If this post is protected, let's re-route.
	if ( post_password_required() ) :
		get_template_part( 'components/post/content-password-protected', get_post_format() );
	else :
		/*
		 * Include the Post-Format-specific template for the content.
		 * If you want to override this in a child theme, then include a file
		 * called content-___.php (where ___ is the Post Format name) and that will be used instead.
		 */
		get_template_part( 'components/post/content', get_post_format() );

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

		// Let's display the post minibar, on singular blog posts only.
		if ( is_singular( 'post' ) ) {
			get_template_part( 'components/post/bar' );
		}

	endif;

endwhile;

get_footer();
