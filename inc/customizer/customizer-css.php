<?php
/**
 * Enqueues front-end CSS for Customizer options.
 *
 * @package     Tabor
 * @link        https://themebeans.com/themes/tabor
 */

/**
 * Set the Custom CSS via Customizer options.
 */
function tabor_customizer_css() {

	$accent_color = get_theme_mod( 'accent_color', tabor_defaults( 'accent_color' ) );

	$background_color               = get_theme_mod( 'background_color', '#ffffff' );
	$background_color_rgba_from_hex = tabor_hex2rgb( $background_color );
	$background_color_rgba          = vsprintf( 'rgba( %1$s, %2$s, %3$s, 0.1)', $background_color_rgba_from_hex );
	$background_color_rgba_0        = vsprintf( 'rgba( %1$s, %2$s, %3$s, 0)', $background_color_rgba_from_hex );

	$site_logo_width        = get_theme_mod( 'custom_logo_max_width', tabor_defaults( 'custom_logo_max_width' ) );
	$site_logo_mobile_width = get_theme_mod( 'custom_logo_mobile_max_width', tabor_defaults( 'custom_logo_mobile_max_width' ) );

	$heading_color     = get_theme_mod( 'heading_color', tabor_defaults( 'heading_color' ) );
	$alt_heading_color = get_theme_mod( 'alt_heading_color', tabor_defaults( 'alt_heading_color' ) );
	$nav_color         = get_theme_mod( 'nav_color', tabor_defaults( 'nav_color' ) );
	$mobile_nav_color  = get_theme_mod( 'mobile_nav_color', tabor_defaults( 'mobile_nav_color' ) );
	$text_color        = get_theme_mod( 'text_color', tabor_defaults( 'text_color' ) );
	$header_icon_color = get_theme_mod( 'header_icon_color', tabor_defaults( 'header_icon_color' ) );
	$footer_bg_color   = get_theme_mod( 'footer_bg_color', tabor_defaults( 'footer_bg_color' ) );

	$footer_text_color      = get_theme_mod( 'footer_text_color', tabor_defaults( 'footer_text_color' ) );
	$footer_text_color_rgba = tabor_hex2rgb( $footer_text_color );
	$footer_text_color_rgba = vsprintf( 'rgba( %1$s, %2$s, %3$s, 0.75)', $footer_text_color_rgba );

	$css =
	'
	body {
		color: ' . esc_attr( $text_color ) . ';
	}

	body .custom-logo-link img.custom-logo {
		width: ' . esc_attr( $site_logo_mobile_width ) . 'px;
	}

	@media (min-width: 600px) {
		body .custom-logo-link img.custom-logo {
			width: ' . esc_attr( $site_logo_width ) . 'px;
		}
	}

	body .widget-area__wrapper {
		background: ' . esc_attr( $footer_bg_color ) . ';
	}

	.nav--overflow:not(.sub-menu)::after {
		background: linear-gradient(90deg, ' . esc_attr( $background_color_rgba_0 ) . ' 0, #' . esc_attr( $background_color ) . ' 95%, #' . esc_attr( $background_color ) . ');
	}

	.has-accent-color { color: ' . esc_attr( $accent_color ) . '; }

	.has-accent-background-color { background-color: ' . esc_attr( $accent_color ) . '; }

	.c-settings .c-switch[aria-checked=true]  { background-color: ' . esc_attr( $accent_color ) . '; }

	body .widget-area__wrapper,
	body .widget-area__wrapper .h1,
	body .widget-area__wrapper .h2,
	body .widget-area__wrapper .h3,
	body .widget-area__wrapper .h4,
	body .widget-area__wrapper .h5,
	body .widget-area__wrapper .h6 {
		color: ' . esc_attr( $footer_text_color ) . ';
	}

	body .widget-area__wrapper form input {
		border-color: ' . esc_attr( $footer_text_color ) . ';
	}

	body .widget-area__wrapper form input:focus {
		border-color: ' . esc_attr( $footer_text_color_rgba ) . ';
	}

	body .widget-area__wrapper form input,
	body .widget-area__wrapper form input:focus {
		color: ' . esc_attr( $footer_text_color ) . ';
	}

	body #secondary #tucson-optin input,
	body .widget-area__wrapper form input.placeholder {
		color: ' . esc_attr( $footer_text_color ) . ' !important;
	}

	body .widget-area__wrapper form input:-moz-placeholder {
		color: ' . esc_attr( $footer_text_color ) . ';
	}

	body .widget-area__wrapper form input::-moz-placeholder {
		color: ' . esc_attr( $footer_text_color ) . ';
	}

	body .widget-area__wrapper form input:-ms-input-placeholder {
		color: ' . esc_attr( $footer_text_color ) . ';
	}

	body .widget-area__wrapper form input::-webkit-input-placeholder {
		color: ' . esc_attr( $footer_text_color ) . ';
	}

	body #secondary #tucson-optin .tucson-field-submit,
	body .widget-area__wrapper form input[type=submit],
	body .widget-area__wrapper form input[type=button] {
		background-color: ' . esc_attr( $footer_text_color ) . ' !important;
	}

	body .widget-area__wrapper form input[type=submit]:hover,
	body .widget-area__wrapper form input[type=button]:hover {
		background-color: ' . esc_attr( $footer_text_color_rgba ) . ';
	}

	body #secondary #tucson-optin .tucson-field-submit,
	body .widget-area__wrapper form input[type=submit],
	body .widget-area__wrapper form input[type=button] {
		color: ' . esc_attr( $footer_bg_color ) . ' !important;
	}

	body #secondary #tucson-optin input:-moz-placeholder {
		color: ' . esc_attr( $footer_text_color ) . ';
	}

	body #secondary #tucson-optin input::-moz-placeholder {
		color: ' . esc_attr( $footer_text_color ) . ';
	}

	body #secondary #tucson-optin input:-ms-input-placeholder {
		color: ' . esc_attr( $footer_text_color ) . ';
	}

	body #secondary #tucson-optin input::-webkit-input-placeholder {
		color: ' . esc_attr( $footer_text_color ) . ';
	}

	body #secondary #tucson-optin .tucson-field-submit:hover {
		background-color: ' . esc_attr( $footer_text_color_rgba ) . ' !important;
	}

	body #secondary #tucson-optin input {
		border-color: ' . esc_attr( $footer_text_color ) . ';
	}

	body #secondary #tucson-optin input:focus {
		border-color: ' . esc_attr( $footer_text_color_rgba ) . ';
	}

	@media (max-width: 599px) {
		.site-header {
			background: ' . esc_attr( $background_color ) . ' !important;
		}

		.main-navigation ul:not(.sub-menu) {
			top: calc( 30px + ' . esc_attr( $site_logo_mobile_width ) . 'px ) !important;
			padding-top: ' . esc_attr( $site_logo_mobile_width ) . 'px !important;
		}

		.admin-bar .main-navigation ul:not(.sub-menu) {
			top: calc( 46px + 30px + ' . esc_attr( $site_logo_mobile_width ) . 'px ) !important;
		}

		body .main-navigation ul:not(.sub-menu) a {
			color: ' . esc_attr( $mobile_nav_color ) . ' !important;
		}
	}

	@media (max-width: 599px) {
		.site-header::after {
			top: calc( 30px + ' . esc_attr( $site_logo_mobile_width ) . 'px )!important;
			background: transparent;
   			background: -webkit-linear-gradient( #' . esc_attr( $background_color ) . ' 0%, ' . esc_attr( $background_color_rgba ) . ')!important;
   			background: linear-gradient( #' . esc_attr( $background_color ) . ' 0%, ' . esc_attr( $background_color_rgba ) . ')!important;
		}

		.admin-bar .site-header::after {
			top: calc( 46px + 30px + ' . esc_attr( $site_logo_mobile_width ) . 'px ) !important;
		}
	}

	.gray:not(.has-text-color),
	label,
	cite,
	.logged-in-as,
	.wp-caption-text,
	.page-links a span,
	.comment-metadata a,
	.entry-media figcaption,
	.entry-content figcaption:not(.blockgallery--caption),
	.entry-content .blockgallery:not(.has-caption-color) figcaption,
	.taxonomy-description,
	.comment-reply-title small,
	.wp-block-tabor-hero .subHeading:not(.has-text-color),
	.no-svg .dropdown-toggle .svg-fallback.icon-down {
		color: ' . esc_attr( $alt_heading_color ) . ';
	}

	.wp-block-tabor-hero .subHeading.h5.gray:not(.has-text-color) {
		color: ' . esc_attr( $alt_heading_color ) . ';
	}

	body .search-toggle .icon, body .site-header .social-navigation svg, body .search-form .search-submit .icon {
		fill: ' . esc_attr( $header_icon_color ) . ';
	}

	body .social-navigation ul li a {
		color: ' . esc_attr( $header_icon_color ) . ';
	}

	body .menu-toggle::after, body .menu-toggle::before {
		background-color: ' . esc_attr( $header_icon_color ) . ';
	}

	.site-header .nav li a {
		color: ' . esc_attr( $nav_color ) . ';
	}

	.main-navigation .dropdown-toggle .icon {
		fill: ' . esc_attr( $nav_color ) . ';
	}

	h1, h2, h3, h4, h5, h6, .h1:not(.gray), .h2:not(.gray), .h3:not(.gray), .h4:not(.gray), .h5:not(.gray), .h6:not(.gray), .home:not(.blog):not(.has-tabor-blocks) .entry-content h5 {
		color: ' . esc_attr( $heading_color ) . ';
	}

	body #course-body #course-element-title-content {
		color: ' . esc_attr( $heading_color ) . ' !important;
	}
	';

	// Minify.
	if ( function_exists( 'themebeans_minify_css' ) ) {
		$css = themebeans_minify_css( $css );
	}

	return wp_strip_all_tags( $css );
}

/**
 * Set the Custom Font CSS via Customizer options.
 */
function tabor_customizer_font_css() {

	$heading_font = get_theme_mod( 'heading_font', tabor_defaults( 'heading_font' ) );
	$body_font    = get_theme_mod( 'body_font', tabor_defaults( 'body_font' ) );

	// Return early if both font selections are set to default.
	if ( 'Default' === $heading_font && 'Default' === $body_font ) {
		return;
	}

	// Heading fonts.
	$heading_css = '';

	if ( 'System Fonts' === $heading_font || 'System Serif' === $heading_font ) {

		if ( 'System Fonts' === $heading_font ) {
			$heading_font = '-apple-system, BlinkMacSystemFont, segoe ui, fira sans, helvetica neue, arial, sans-serif';
		} elseif ( 'System Serif' === $heading_font ) {
			$heading_font = 'serif';
		}

		$heading_css = '
			h1,
			h2,
			h3,
			h4,
			h5,
			h6,
			.header-font,
			.wp-block-cover-image-text,
			.submit,
			label,
			.button,
			input[type=submit],
			input[type=button],
			select,
			textarea,
			input[type="text"],
			input[type="email"],
			input[type="url"],
			input[type="password"],
			input[type="search"],
			.wp-caption-text,
			figcaption,
			.wpcf7-form .wpcf7-response-output,
			.comment-awaiting-moderation,
			.comment-author,
			.comment .reply a,
			.comment-metadata,
			.comment-reply-title,
			#infinite-handle span,
			.nf-form-content .nf-error-msg,
			.nf-error-field-errors,
			#course-body #course-element-title-content,
			#course-body #course-element-tagline,
			#course-body #course-field-name,
			#course-body #course-field-email,
			#course-body #course-field-submit,
			#secondary #tucson-optin .tucson-element-title-content,
			#secondary #tucson-optin input,
			#secondary #tucson-optin p.tucson-error,
			#revue-embed .revue-form-group input,
			.widget_ninja_forms_widget input,
			.widget_mc4wp_form_widget input,
			.widget_mc4wp_form_widget .mc4wp-alert,
			.logged-in-as,
			.entry-content .wp-block-coblocks-author__name,
			.entry-content .wp-block-cover .wp-block-cover-text,
			.entry-content .wp-block-quote:not(.is-style-large) p,
			.entry-content .wp-block-coblocks-pricing-table-item__title,
			.entry-content .wp-block-coblocks-pricing-table-item__amount,
			.entry-content .header-font:not(.subHeading) {
				font-family: ' . esc_attr( $heading_font ) . ';
			}
		';

	} elseif ( 'default' !== $heading_font ) {
		$heading_css = '
			h1,
			h2,
			h3,
			h4,
			h5,
			h6,
			.entry-content .wp-block-coblocks-author__name,
			.entry-content .wp-block-cover .wp-block-cover-text,
			.entry-content .wp-block-coblocks-pricing-table-item__title,
			.entry-content .wp-block-coblocks-pricing-table-item__amount,
			#course-body #course-element-tagline,
			#course-body #course-element-title-content,
			#secondary #tucson-optin .tucson-element-tagline-content,
			.entry-content .wp-block-quote:not(.is-style-large) p,
			.entry-content .header-font:not(.subHeading) {
				font-family: ' . esc_attr( $heading_font ) . ';
			}';
	} else {
		$heading_css = null;
	}

	// Body fonts.
	$body_css = '';

	if ( 'System Fonts' === $body_font || 'System Serif' === $body_font ) {

		if ( 'System Fonts' === $body_font ) {
			$body_font = '-apple-system, BlinkMacSystemFont, segoe ui, fira sans, helvetica neue, arial, sans-serif';
		} elseif ( 'System Serif' === $body_font ) {
			$body_font = 'serif';
		}

		$body_css = '
			body,
			button,
			input,
			select,
			textarea,
			.body-font,
			.comments select,
			.comments textarea,
			input[type="search"],
			.comments input[type="url"],
			.comments input[type="text"],
			.comments input[type="email"],
			.wp-block-quote.is-large cite,
			.comments input[type="password"],
			.entry-content .wp-block-coblocks-author__heading,
			.comments #secondary #tucson-optin .tucson-element-tagline-content {
				font-family: ' . esc_attr( $body_font ) . ';
			}
		';

	} elseif ( 'default' !== $body_font ) {
		$body_css = '
			body,
			button,
			input,
			select,
			textarea,
			.body-font,
			.comments select,
			.comments textarea,
			input[type="search"],
			.comments input[type="url"],
			.comments input[type="text"],
			.comments input[type="email"],
			.wp-block-quote.is-large cite,
			.comments input[type="password"],
			.entry-content .wp-block-coblocks-author__heading,
			.comments #secondary #tucson-optin .tucson-element-tagline-content {
				font-family: ' . esc_attr( $body_font ) . ';
			}';
	} else {
		$body_css = null;
	}

	// Minify.
	if ( function_exists( 'themebeans_minify_css' ) ) {
		$heading_css = themebeans_minify_css( $heading_css );
		$body_css    = themebeans_minify_css( $body_css );
	}

	return wp_strip_all_tags( $heading_css . $body_css );
}

/**
 * Enqueue the Customizer styles on the front-end.
 */
function tabor_customizer_styles() {
	wp_add_inline_style( 'tabor-style', tabor_customizer_css() );
	wp_add_inline_style( 'tabor-style', tabor_customizer_font_css() );
}
add_action( 'wp_enqueue_scripts', 'tabor_customizer_styles' );
