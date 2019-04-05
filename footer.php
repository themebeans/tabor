<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #page div and all content after
 *
 * @package     Tabor
 * @link        https://themebeans.com/themes/tabor
 */

?>

		</main>

		</div>

		<?php if ( ! is_404() && ! post_password_required() ) { ?>

			<?php do_action( 'tabor_before_footer' ); ?>

			<footer class="site-footer">

				<?php get_sidebar(); ?>

				<?php tabor_site_info(); ?>

				<?php do_action( 'tabor_after_site_info' ); ?>

				<?php if ( has_nav_menu( 'footer' ) ) : ?>

					<nav class="footer-navigation container" aria-label="<?php esc_attr_e( 'Footer Menu', 'tabor' ); ?>">

						<?php
						wp_nav_menu(
							array(
								'theme_location' => 'footer',
								'menu_class'     => 'footer-menu header-font medium gray list-reset',
								'depth'          => '1',
							)
						);
						?>

					</nav>

				<?php endif; ?>

			</footer>

			<?php do_action( 'tabor_after_footer' ); ?>

		<?php } ?>

	</div>

	<?php wp_footer(); ?>

	</body>

</html>
