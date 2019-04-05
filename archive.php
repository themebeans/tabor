<?php
/**
 * The template for displaying archive pages.
 *
 * @link http://codex.wordpress.org/Template_Hierarchy
 *
 * @package     Tabor
 * @link        https://themebeans.com/themes/tabor
 */

get_header();

if ( have_posts() ) :

	?>

	<header class="page-header page-header__archive container bottom-spacer">
		<?php
			the_archive_title( '<h2 class="page-title h2">', '</h2>' );
			the_archive_description( '<div class="taxonomy-description header-font">', '</div>' );
			tabor_related_categories();
		?>
	</header>

	<?php

	/* Start the Loop */
	while ( have_posts() ) :

		the_post();

		/**
		 * Run the loop for the archive view to output the results.
		 * If you want to overload this in a child theme then include a file
		 * called content-excerpt.php in the /components/post/ directory and that will be used instead.
		 */
		get_template_part( 'components/post/content', 'excerpt' );

	endwhile;

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

else :
	get_template_part( 'components/post/content', 'none' );
endif;

get_footer();
