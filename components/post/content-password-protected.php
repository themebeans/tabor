<?php
/**
 * The template part for displaying a message that posts cannot be found.
 *
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package     Tabor
 * @link        https://themebeans.com/themes/tabor
 */

if ( post_password_required() ) { ?>

	<div class="is-protected">

		<div class="is-protected__inner">

			<section class="is-protected__inner-wrapper center-align">
				<header class="page-header">
					<?php echo wp_kses( tabor_get_svg( array( 'icon' => 'lock' ) ), tabor_svg_allowed_html() ); ?>
				</header>
				<div class="page-content container--sml">
					<?php the_content(); ?>
					<?php echo get_the_password_form(); // WPCS: XSS OK. ?>
				</div>
			</section>

		</div>

	</div>

<?php
}

