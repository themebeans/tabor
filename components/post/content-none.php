<?php
/**
 * Template part for displaying a message that posts cannot be found.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package     Tabor
 * @link        https://themebeans.com/themes/tabor
 */

?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

	<div class="post-wrapper">

		<header class="entry-header top-spacer bottom-spacer">

			<h1 class="entry-title"><?php esc_html_e( 'Nothing Found', 'tabor' ); ?></h1>

		</header>

		<div class="entry-content">

			<?php
			if ( is_home() && current_user_can( 'publish_posts' ) ) :
			?>

				<p><?php printf( __( 'Ready to publish your first post? <a href="%1$s">Get started here</a>.', 'tabor' ), esc_url( admin_url( 'post-new.php' ) ) ); ?></p>

			<?php else : ?>

				<p><?php esc_html_e( 'It seems we can&rsquo;t find what you&rsquo;re looking for. Perhaps searching can help.', 'tabor' ); ?></p>
				<?php
					get_search_form();

			endif;
			?>

		</div>

	</div>

	<?php
	// Sidebar widget area.
	if ( is_single() && ! is_front_page() && is_active_sidebar( 'sidebar-3' ) ) {
		?>

		<aside class="widget-area widget-area--sidebar top-spacer">
			<?php dynamic_sidebar( 'sidebar-3' ); ?>
		</aside>

	<?php } ?>

	<nav class="post-navigation">
		<?php previous_post_link(); ?> <?php next_post_link(); ?>
	</nav>

</article><!-- #post-## -->
