<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @package     Tabor
 * @link        https://themebeans.com/themes/tabor
 */

get_header(); ?>

<section class="error-404 not-found center-align">
	<header class="page-header">
		<h1 class="h1 extra-large extra-important"><?php echo esc_html( apply_filters( 'tabor_404', esc_html__( '404', 'tabor' ) ) ); ?></h1>
		<h2 class="h2"><?php echo esc_html( apply_filters( 'tabor_404_text', esc_html__( 'This isn’t what you’re looking for.', 'tabor' ) ) ); ?></h2>
	</header>
	<div class="page-content container--sml">
		<?php get_search_form(); ?>
	</div>
</section>

<?php
get_footer();
