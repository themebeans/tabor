<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme and one of the
 * two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * For example, it puts together the home page when no home.php file exists.
 *
 * @link http://codex.wordpress.org/Template_Hierarchy
 *
 * @package     Tabor
 * @link        https://themebeans.com/themes/tabor
 */

get_header();

if ( have_posts() ) :

	/* Start the Loop */
	while ( have_posts() ) :

		the_post();

		// Are we using the content or the excerpt?
		$content = get_theme_mod( 'blogroll_excerpt', tabor_defaults( 'blogroll_excerpt' ) ) ? 'excerpt' : get_post_format();

		/*
		 * Include the Post-Format-specific template for the content.
		 * If you want to override this in a child theme, then include a file
		 * called content-___.php (where ___ is the Post Format name) and that will be used instead.
		 *
		 * If the excerpt is enabled via the Customizer, load the
		 * content-excerpt.php file in the /components/post/ directory.
		 */
		get_template_part( 'components/post/content', $content );

	endwhile;

	if ( ! class_exists( 'Jetpack' ) || ! Jetpack::is_module_active( 'infinite-scroll' ) ) :
		/*
		 * The posts pagination outputs a set of page numbers with links to the previous and next pages of posts.
		 *
		 * @link https://codex.wordpress.org/Function_Reference/the_posts_pagination
		 */
		the_posts_pagination(
			array(
				'prev_text'          => wp_kses( tabor_get_svg( array( 'icon' => 'left' ) ), tabor_svg_allowed_html() ) . '<span class="screen-reader-text">' . __( 'Previous page', 'tabor' ) . '</span>',
				'next_text'          => '<span class="screen-reader-text">' . __( 'Next page', 'tabor' ) . '</span>' . wp_kses( tabor_get_svg( array( 'icon' => 'right' ) ), tabor_svg_allowed_html() ),
				'before_page_number' => '<span class="meta-nav screen-reader-text">' . __( 'Page', 'tabor' ) . ' </span>',
			)
		);
	endif;

else :
	get_template_part( 'components/post/content', 'none' );
endif;

get_footer();
