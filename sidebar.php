<?php
/**
 * The sidebar containing the main widget area
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package     Tabor
 * @link        https://themebeans.com/themes/tabor
 */

if ( ! is_active_sidebar( 'sidebar-1' ) ) {
	return;
}
?>

<aside id="secondary" class="widget-area" role="complementary">

	<div class="widget-area__inner">

		<div class="widget-area__wrapper">

			<?php do_action( 'tabor_before_footer_widgets' ); ?>

			<?php dynamic_sidebar( 'sidebar-1' ); ?>

			<?php do_action( 'tabor_after_footer_widgets' ); ?>
		</div>

	</div>
</aside>
