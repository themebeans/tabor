<?php
/**
 * The template for displaying search results pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#search-result
 *
 * @package     Tabor
 * @link        https://themebeans.com/themes/tabor
 */

get_header();

$site = get_bloginfo( 'name' );

global $wp_query; ?>

<section class="search-wrapper">

	<header class="page-header page-header__archive container bottom-spacer">
		<?php if ( have_posts() ) : ?>
			<h2 class="page-title h2"><?php echo esc_html__( 'Search Results', 'tabor' ); ?></h2>
			<div class="taxonomy-description header-font">
				<?php /* translators: 1: search results count 2: search query */ ?>
				<p><?php printf( esc_html__( 'There are %1$s search results for "%2$s"', 'tabor' ), esc_html( $wp_query->found_posts ), esc_html( get_search_query() ) ); ?></p>
			</div>
		<?php else : ?>
			<h2 class="page-title h2"><?php esc_html_e( 'Nothing Found', 'tabor' ); ?></h2>
		<?php endif; ?>

	</header>

	<?php
	if ( have_posts() ) :
		/* Start the Loop */
		while ( have_posts() ) :

			the_post();

			/**
			 * Run the loop for the search to output the results.
			 * If you want to overload this in a child theme then include a file
			 * called content-excerpt.php in the /components/post/ directory and that will be used instead.
			 */
			get_template_part( 'components/post/content', 'excerpt' );

		endwhile; // End of the loop.

		the_posts_pagination(
			array(
				'prev_text'          => wp_kses( tabor_get_svg( array( 'icon' => 'left' ) ), tabor_svg_allowed_html() ) . '<span class="screen-reader-text">' . esc_html__( 'Previous page', 'tabor' ) . '</span>',
				'next_text'          => '<span class="screen-reader-text">' . esc_html__( 'Next page', 'tabor' ) . '</span>' . wp_kses( tabor_get_svg( array( 'icon' => 'right' ) ), tabor_svg_allowed_html() ),
				'before_page_number' => '<span class="meta-nav screen-reader-text">' . esc_html__( 'Page', 'tabor' ) . ' </span>',
			)
		);

	else :
	?>

		<div class="container--sml center-align">
			<p><?php esc_html_e( 'Sorry, but nothing matched your search terms. Please try searching again.', 'tabor' ); ?></p>
			<?php get_search_form(); ?>
		</div>

	<?php endif; ?>

</section>

<?php
get_footer();
