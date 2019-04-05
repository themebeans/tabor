<?php
/**
 * Template part for displaying page content in page.php
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package     Tabor
 * @link        https://themebeans.com/themes/tabor
 */

$header = get_post_meta( get_the_ID(), '_tabor_header', true );
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

	<div class="page-wrapper">

		<?php if ( ! class_exists( 'FLBuilder' ) || ! FLBuilderModel::is_builder_enabled() ) { ?>

			<?php if ( ! $header ) { ?>

					<header class="entry-header top-spacer bottom-spacer">

						<?php the_title( '<h1 class="entry-title h1">', '</h1>' ); ?>

						<?php tabor_posted_on(); ?>

					</header>

				<?php } ?>

			<?php } ?>

		<?php tabor_customize_home_entry_header(); ?>

		<?php
		// Don't show the entry media on any Beaver Builder enabled pages.
		if ( ! class_exists( 'FLBuilder' ) || ! FLBuilderModel::is_builder_enabled() ) {
			tabor_post_media( $post->ID );
		}
		?>

		<div class="entry-content">
			<?php
				the_content();

				wp_link_pages(
					array(
						'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'tabor' ),
						'after'  => '</div>',
					)
				);
			?>
		</div>

	</div>

	<?php
	// Sidebar widget area.
	if ( ! is_front_page() && is_active_sidebar( 'sidebar-3' ) ) {
	?>

		<aside class="widget-area widget-area--sidebar top-spacer">
			<?php dynamic_sidebar( 'sidebar-3' ); ?>
		</aside>

	<?php
	}

	// Front Page widget area.
	if ( is_front_page() && is_active_sidebar( 'sidebar-2' ) && ! function_exists( 'register_block_type' ) ) {
	?>

		<aside class="widget-area widget-area--frontpage">
			<?php dynamic_sidebar( 'sidebar-2' ); ?>
		</aside>

	<?php } ?>

</article>
