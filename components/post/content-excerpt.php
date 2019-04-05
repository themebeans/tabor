<?php
/**
 * Template part for displaying posts with excerpts
 *
 * Used in Search Results.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package     Tabor
 * @link        https://themebeans.com/themes/tabor
 */

?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

	<header class="entry-header top-spacer bottom-spacer">

		<?php
		if ( is_front_page() && ! is_home() ) {
			// The excerpt is being displayed within a front page section, so it's a lower hierarchy than h2.
			the_title( sprintf( '<h3 class="h1"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h3>' );
		} else {
			the_title( sprintf( '<h2 class="h1"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h2>' );
		}

		tabor_posted_on();
		?>

	</header>

	<?php tabor_post_media( $post->ID ); ?>

	<div class="entry-summary">
		<?php the_excerpt(); ?>
	</div>

</article><!-- #post-## -->
