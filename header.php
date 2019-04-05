<?php
/**
 * The header for our theme.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package     Tabor
 * @link        https://themebeans.com/themes/tabor
 */

?><!DOCTYPE html>
<html <?php language_attributes(); ?> class="no-js no-svg">
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover">
	<link rel="profile" href="http://gmpg.org/xfn/11">
	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
	<?php
	if ( function_exists( 'wp_body_open' ) ) {
		wp_body_open();
	}
	?>
	<div id="page" class="site top-spacer bottom-spacer">

		<a class="skip-link screen-reader-text" href="#content"><?php esc_html_e( 'Skip to content', 'tabor' ); ?></a>

		<?php do_action( 'tabor_before_header' ); ?>

		<header id="masthead" class="site-header drop-in drop-in--from-top" role="banner">

			<div class="container max-width">

				<div class="flex justify-between">

					<div class="flex justify-start items-center">

						<?php tabor_site_logo(); ?>

						<?php if ( has_nav_menu( 'social' ) ) : ?>

							<span class="sep"></span>

							<nav class="social-navigation" aria-label="<?php esc_attr_e( 'Social Menu', 'tabor' ); ?>">

								<?php
									wp_nav_menu(
										array(
											'theme_location' => 'social',
											'menu_class'  => 'header-font medium smooth gray list-reset',
											'depth'       => 1,
											'link_before' => '<span class="screen-reader-text">',
											'link_after'  => '</span>' . tabor_get_svg( array( 'icon' => 'chain' ) ),
										)
									);
								?>

							</nav>

						<?php endif; ?>
					</div>

					<div class="flex items-center">

						<?php do_action( 'tabor_before_nav' ); ?>

						<nav id="site-navigation" class="main-navigation nav primary flex items-center justify-end" role="navigation" aria-label="<?php esc_attr_e( 'Primary Menu', 'tabor' ); ?>">

							<?php if ( has_nav_menu( 'primary' ) ) : ?>
								<button class="menu-toggle" aria-controls="top-menu" aria-expanded="false">
									<span class="screen-reader-text"><?php echo esc_html__( 'Menu', 'tabor' ); ?></span>
								</button>

								<?php
								wp_nav_menu(
									array(
										'theme_location' => 'primary',
										'menu_class'     => 'primary-menu header-font medium smooth gray list-reset',
										'depth'          => 2,
									)
								);
								?>

							<?php endif; ?>

							<?php tabor_header_search_toggle(); ?>

							<?php tabor_accessibility_settings(); ?>

						</nav>

						<?php do_action( 'tabor_after_nav' ); ?>

					</div>

				</div>

				<div class="site-branding-text">
					<?php
					$description = get_bloginfo( 'description', 'display' );

					$allowed_html = array(
						'a'      => array(),
						'b'      => array(),
						'strong' => array(),
					);

					if ( $description || is_customize_preview() ) :
					?>
						<p class="site-description header-font medium smooth gray"><?php echo wp_kses( $description, $allowed_html ); ?></p>
					<?php endif; ?>
				</div>

			</div>

		</header>

		<?php do_action( 'tabor_after_header' ); ?>

		<div id="content" class="site-content">

			<main id="main" class="site-main" role="main">
