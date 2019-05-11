<?php
/**
 * Theme functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package     Tabor
 * @link        https://themebeans.com/themes/tabor
 */

if ( ! defined( 'TABOR_DEBUG' ) ) :
	/**
	 * Check to see if development mode is active.
	 * If set to false, the theme will load un-minified assets.
	 */
	define( 'TABOR_DEBUG', true );
endif;

if ( ! defined( 'TABOR_ASSET_SUFFIX' ) ) :
	/**
	 * If not set to true, let's serve minified .css and .js assets.
	 * Don't modify this, unless you know what you're doing!
	 */
	if ( ! defined( 'TABOR_DEBUG' ) || true === TABOR_DEBUG ) {
		define( 'TABOR_ASSET_SUFFIX', null );
	} else {
		define( 'TABOR_ASSET_SUFFIX', '.min' );
	}
endif;

/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function tabor_setup() {
	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on Tabor, use a find and replace
	 * to change 'tabor' to the name of your theme in all the template files
	 */
	load_theme_textdomain( 'tabor', get_parent_theme_file_path( '/languages' ) );

	/*
	 * Add default posts and comments RSS feed links to head.
	 */
	add_theme_support( 'automatic-feed-links' );

	/*
	 * Let WordPress manage the document title.
	 * By adding theme support, we declare that this theme does not use a
	 * hard-coded <title> tag in the document head, and expect WordPress to
	 * provide it for us.
	 */
	add_theme_support( 'title-tag' );

	/**
	 * Filter Tabor's custom-background support argument.
	 *
	 * @param array $args {
	 *     An array of custom-background support arguments.
	 * }
	 */
	add_theme_support(
		'custom-background', apply_filters(
			'tabor_custom_background_args', array(
				'default-color' => 'ffffff',
				'default-image' => '',
			)
		)
	);

	/**
	 * Filter Tabor custom-header support arguments.
	 *
	 * @param array $args {
	 *     An array of custom-header support arguments.
	 *
	 *     @type boolean    $header-text        Enable the site description.
	 *     @type string     $wp-head-callback   Callback function used to styles the header text.
	 * }
	 */
	add_theme_support(
		'custom-header', apply_filters(
			'tabor_custom_header_args', array(
				'header-text'      => true,
				'wp-head-callback' => 'tabor_header_style',
			)
		)
	);

	/*
	 * Enable support for Post Thumbnails on posts and pages.
	 * @link http://codex.wordpress.org/Function_Reference/add_theme_support#Post_Thumbnails
	 */
	add_theme_support( 'post-thumbnails' );
	add_image_size( 'tabor-featured-image-xsm', 120, 120, true );
	add_image_size( 'tabor-featured-image-sml', 434, 9999, false );
	add_image_size( 'tabor-featured-image-med', 868, 9999, false );
	add_image_size( 'tabor-featured-image-lrg', 1736, 9999, false );

	/*
	 * This theme uses wp_nav_menu() in the following locations.
	 */
	register_nav_menus(
		array(
			'primary' => esc_html__( 'Primary Menu', 'tabor' ),
			'footer'  => esc_html__( 'Footer Menu', 'tabor' ),
			'social'  => esc_html__( 'Social Menu', 'tabor' ),
		)
	);

	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support(
		'html5', array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
		)
	);

	/**
	 * Filter Tabor Post Format support arguments.
	 * See: https://codex.wordpress.org/Post_Formats
	 */
	add_theme_support(
		'post-formats', apply_filters(
			'tabor_post_formats', array(
				'link',
				'video',
			)
		)
	);

	/*
	 * Enable support for the WordPress default Theme Logo.
	 * See: https://codex.wordpress.org/Theme_Logo
	 */
	add_theme_support(
		'custom-logo', array(
			'flex-width' => true,
		)
	);

	/*
	 * Enable support responsive embedded content
	 * See: https://wordpress.org/gutenberg/handbook/extensibility/theme-support/#responsive-embedded-content
	 */
	add_theme_support( 'customize-selective-refresh-widgets' );

	/*
	 * Enable support responsive embedded content
	 * See: https://wordpress.org/gutenberg/handbook/extensibility/theme-support/#responsive-embedded-content
	 */
	add_theme_support( 'responsive-embeds' );

	/**
	 * Custom colors for use in the editor.
	 *
	 * @link https://wordpress.org/gutenberg/handbook/reference/theme-support/
	 */
	add_theme_support(
		'editor-color-palette', array(
			array(
				'name'  => esc_html__( 'Black', 'tabor' ),
				'slug'  => 'black',
				'color' => '#242424',
			),
			array(
				'name'  => esc_html__( 'Gray', 'tabor' ),
				'slug'  => 'gray',
				'color' => '#535353',
			),
			array(
				'name'  => esc_html__( 'Light Gray', 'tabor' ),
				'slug'  => 'light-gray',
				'color' => '#f5f5f5',
			),
			array(
				'name'  => esc_html__( 'White', 'tabor' ),
				'slug'  => 'white',
				'color' => '#ffffff',
			),
			array(
				'name'  => esc_html__( 'Titan White', 'tabor' ),
				'slug'  => 'titan-white',
				'color' => '#E0D8E2',
			),
			array(
				'name'  => esc_html__( 'Tropical Blue', 'tabor' ),
				'slug'  => 'tropical-blue',
				'color' => '#C5DCF3',
			),
			array(
				'name'  => esc_html__( 'Peppermint', 'tabor' ),
				'slug'  => 'peppermint',
				'color' => '#d0eac4',
			),
			array(
				'name'  => esc_html__( 'Iceberg', 'tabor' ),
				'slug'  => 'iceberg',
				'color' => '#D6EFEE',
			),
			array(
				'name'  => esc_html__( 'Bridesmaid', 'tabor' ),
				'slug'  => 'bridesmaid',
				'color' => '#FBE7DD',
			),
			array(
				'name'  => esc_html__( 'Pipi', 'tabor' ),
				'slug'  => 'pipi',
				'color' => '#fbf3d6',
			),
			array(
				'name'  => esc_html__( 'Accent', 'tabor' ),
				'slug'  => 'accent',
				'color' => esc_html( get_theme_mod( 'accent_color', tabor_defaults( 'accent_color' ) ) ),
			),
		)
	);

	/**
	 * Custom font sizes for use in the editor.
	 *
	 * @link https://wordpress.org/gutenberg/handbook/extensibility/theme-support/#block-font-sizes
	 */
	add_theme_support(
		'editor-font-sizes', array(
			array(
				'name'      => esc_html__( 'Small', 'tabor' ),
				'shortName' => esc_html__( 'S', 'tabor' ),
				'size'      => 17,
				'slug'      => 'small',
			),
			array(
				'name'      => esc_html__( 'Medium', 'tabor' ),
				'shortName' => esc_html__( 'M', 'tabor' ),
				'size'      => 21,
				'slug'      => 'medium',
			),
			array(
				'name'      => esc_html__( 'Large', 'tabor' ),
				'shortName' => esc_html__( 'L', 'tabor' ),
				'size'      => 24,
				'slug'      => 'large',
			),
			array(
				'name'      => esc_html__( 'Huge', 'tabor' ),
				'shortName' => esc_html__( 'XL', 'tabor' ),
				'size'      => 32,
				'slug'      => 'huge',
			),
		)
	);

	// Add support for block styles.
	add_theme_support( 'wp-block-styles' );

	// Add support for full and wide alignment, if the sidebar is not in use.
	if ( ! is_active_sidebar( 'sidebar-3' ) ) {
		add_theme_support( 'align-wide' );
	}

	// Add support for editor styles.
	add_theme_support( 'editor-styles' );

	// Enqueue editor styles.
	add_editor_style( 'assets/css/style-editor' . TABOR_ASSET_SUFFIX . '.css' );

	// Enqueue fonts in the editor.
	add_editor_style( tabor_fonts_url() );

	/*
	 * Define starter content for the theme.
	 * See: https://make.wordpress.org/core/2016/11/30/starter-content-for-themes-in-4-7/
	 */
	$starter_content = array(
		'options'     => array(
			'show_on_front' => 'page',
			'page_on_front' => '{{home}}',
		),

		'attachments' => array(
			'image-logo' => array(
				'post_title' => _x( 'Logo', 'Theme starter content', 'tabor' ),
				'file'       => 'inc/customizer/images/logo.jpg',
			),
		),

		'theme_mods'  => array(
			'show_on_front'         => 'page',
			'page_for_posts'        => '{{blog}}',
			'blogdescription'       => _x( 'Tabor, A WordPress theme by ThemeBeans', 'Theme starter content', 'tabor' ),
			'custom_logo'           => '{{image-logo}}',
			'custom_logo_max_width' => tabor_defaults( 'custom_logo_max_width' ),
			'header_textcolor'      => '',
			'display_header_text'   => false,
		),

		'widgets'     => array(
			'sidebar-1' => array(
				'text_about',
			),
		),

		'posts'       => array(
			'home'    => array(
				'post_title'   => _x( 'Home', 'Theme starter content', 'tabor' ),
				'post_content' => tabor_home_starter_content(),
			),
			'about'   => array(
				'post_title'   => _x( 'Hi, I’m Rich Tabor', 'Theme starter content', 'tabor' ),
				'post_content' => tabor_about_starter_content(),
			),
			'contact' => array(
				'post_title'   => _x( 'Why, hello there', 'Theme starter content', 'tabor' ),
				'post_content' => tabor_content_starter_content(),
			),
			'blog'    => array(),
		),

		'nav_menus'   => array(
			'primary' => array(
				'name'  => esc_html__( 'Primary Menu', 'tabor' ),
				'items' => array(
					'page_blog'    => array(
						'title' => _x( 'Articles', 'Theme starter content', 'tabor' ),
					),
					'page_about'   => array(
						'title' => _x( 'About', 'Theme starter content', 'tabor' ),
					),
					'page_contact' => array(
						'title' => _x( 'Contact', 'Theme starter content', 'tabor' ),
					),
				),
			),
			'social'  => array(
				'name'  => esc_html__( 'Social Menu', 'tabor' ),
				'items' => array(
					'link_twitter',
					'link_instagram',
				),
			),
		),
	);

	/**
	 * Filters Tabor array of starter content.
	 *
	 * @since Tabor 1.0
	 *
	 * @param array $starter_content Array of starter content.
	 */
	$starter_content = apply_filters( 'tabor_starter_content', $starter_content );

	add_theme_support( 'starter-content', $starter_content );
}
add_action( 'after_setup_theme', 'tabor_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function tabor_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'tabor_content_width', 700 );
}
add_action( 'after_setup_theme', 'tabor_content_width', 0 );

/**
 * Register widget areas.
 *
 * @link http://codex.wordpress.org/Function_Reference/register_sidebar
 */
function tabor_widgets_init() {
	register_sidebar(
		array(
			'name'          => esc_html__( 'Footer', 'tabor' ),
			'id'            => 'sidebar-1',
			'description'   => esc_html__( 'Appears in the site footer.', 'tabor' ),
			'before_widget' => '<aside id="%1$s" class="widget %2$s clearfix">',
			'after_widget'  => '</aside>',
			'before_title'  => '<h6 class="h2">',
			'after_title'   => '</h6>',
		)
	);

	if ( ! function_exists( 'register_block_type' ) ) {
		register_sidebar(
			array(
				'name'          => esc_html__( 'Front Page', 'tabor' ),
				'id'            => 'sidebar-2',
				'description'   => esc_html__( 'Appears on the front page only.', 'tabor' ),
				'before_widget' => '<aside id="%1$s" class="widget %2$s clearfix">',
				'after_widget'  => '</aside>',
				'before_title'  => '<h6 class="h2">',
				'after_title'   => '</h6>',
			)
		);
	}

	register_sidebar(
		array(
			'name'          => esc_html__( 'Sidebar', 'tabor' ),
			'id'            => 'sidebar-3',
			'description'   => esc_html__( 'Appears on the single pages and posts, if widgets are placed here.', 'tabor' ),
			'before_widget' => '<aside id="%1$s" class="widget %2$s clearfix">',
			'after_widget'  => '</aside>',
			'before_title'  => '<h6 class="h4">',
			'after_title'   => '</h6>',
		)
	);
}
add_action( 'widgets_init', 'tabor_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function tabor_scripts() {

	// Add custom fonts, used in the main stylesheet.
	wp_enqueue_style( 'tabor-fonts', tabor_fonts_url(), false, '@@pkg.version', 'all' );

	// Load theme styles.
	if ( is_child_theme() ) {
		wp_enqueue_style( 'tabor-style', get_parent_theme_file_uri( '/style' . TABOR_ASSET_SUFFIX . '.css' ), false, '@@pkg.version' );
		wp_enqueue_style( 'tabor-child-style', get_theme_file_uri( '/style.css' ), false, '@@pkg.version', 'all' );
	} else {
		wp_enqueue_style( 'tabor-style', get_theme_file_uri( '/style' . TABOR_ASSET_SUFFIX . '.css' ), false, '@@pkg.version' );
	}

	/**
	 * Now let's check the same for the scripts.
	 */
	if ( TABOR_DEBUG ) {

		// Vendor scripts.
		wp_enqueue_script( 'tabor-lazyload', get_theme_file_uri( '/assets/js/vendors/lazyload.js' ), array( 'jquery' ), '@@pkg.version', true );
		wp_enqueue_script( 'tabor-typed', get_theme_file_uri( '/assets/js/vendors/typed.js' ), array( 'jquery' ), '@@pkg.version', true );
		wp_enqueue_script( 'tabor-headroom', get_theme_file_uri( '/assets/js/vendors/headroom.js' ), array( 'jquery' ), '@@pkg.version', true );
		wp_enqueue_script( 'tabor-share-this', get_theme_file_uri( '/assets/js/vendors/share-this.js' ), array( 'jquery' ), '@@pkg.version', true );

		// Custom scripts.
		wp_enqueue_script( 'tabor-skip-link-focus-fix', get_theme_file_uri( '/assets/js/custom/skip-link-focus-fix.js' ), array(), '@@pkg.version', true );
		wp_enqueue_script( 'tabor-navigation', get_theme_file_uri( '/assets/js/custom/navigation.js' ), array( 'jquery' ), '@@pkg.version', true );
		wp_enqueue_script( 'tabor-global', get_theme_file_uri( '/assets/js/custom/global.js' ), array( 'jquery' ), '@@pkg.version', true );

		$translation_handle = 'tabor-navigation'; // Variable for wp_localize_script.

	} else {
		wp_enqueue_script( 'tabor-vendors-min', get_theme_file_uri( '/assets/js/vendors.min.js' ), array( 'jquery' ), '@@pkg.version', true );
		wp_enqueue_script( 'tabor-custom-min', get_theme_file_uri( '/assets/js/custom.min.js' ), array( 'jquery' ), '@@pkg.version', true );

		$translation_handle = 'tabor-custom-min'; // Variable for wp_localize_script for minified javascript.
	}

	// Load the standard WordPress comments reply javascript.
	if ( is_singular( 'post' ) && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}

	// Localization.
	$tabor_l10n['expand']   = __( 'Expand child menu', 'tabor' );
	$tabor_l10n['collapse'] = __( 'Collapse child menu', 'tabor' );
	$tabor_l10n['icon']     = tabor_get_svg(
		array(
			'icon'     => 'down',
			'fallback' => true,
		)
	);

	wp_localize_script( $translation_handle, 'taborScreenReaderText', $tabor_l10n );
}
add_action( 'wp_enqueue_scripts', 'tabor_scripts' );

/**
 * Enqueue supplemental block editor styles.
 */
function tabor_editor_frame_styles() {
	wp_enqueue_style( 'tabor-editor-frame-styles', get_theme_file_uri( '/assets/css/style-editor-frame.css' ), false, '@@pkg.version', 'all' );
}
add_action( 'enqueue_block_editor_assets', 'tabor_editor_frame_styles' );

/**
 * Remove the duplicate stylesheet enqueue for older versions of the child theme.
 *
 * Since v1.1.4 Tabor has a built-in auto-loader for loading the appropriate
 * parent theme stylesheet, without the need for a wp_enqueue_scripts function within
 * the child theme. This means that stylesheets will "just work" and there's less chance
 * that users will accidently disrupt stylesheet loading.
 */
function tabor_remove_duplicate_child_parent_enqueue_scripts() {
	remove_action( 'wp_enqueue_scripts', 'tabor_child_scripts', 10 );
}
add_action( 'init', 'tabor_remove_duplicate_child_parent_enqueue_scripts' );

/**
 * Enqueue inline script for the accessibility settings module.
 */
function tabor_localstorage_scripts() {

	$accessibility = get_theme_mod( 'accessibility_settings', tabor_defaults( 'accessibility_settings' ) );

	// If the option is not available, or we're not in the Customizer, return.
	if ( $accessibility || is_customize_preview() ) {
		echo '
		<script type="text/javascript">
			! function(e, t, n) {
				"use strict";

				function o(e) {
					var n = localStorage.getItem(e);
					n && ("font-size" === e ? t.documentElement.classList.add("font-size--" + n) : "true" === n && t.documentElement.classList.add(e))
				}

				"querySelector" in t && "addEventListener" in e, "localStorage" in e && (o("night-mode"), o("font-size") )

			}(window, document)
		</script>';
	}
}
add_action( 'wp_enqueue_scripts', 'tabor_localstorage_scripts' );

if ( ! function_exists( 'tabor_fonts_url' ) ) :
	/**
	 * Register custom fonts.
	 */
	function tabor_fonts_url() {
		$fonts_url     = '';
		$font_families = array();

		/*
		 * Translators: If there are characters in your language that are not
		 * supported by Heebo, translate this to 'off'. Do not translate
		 * into your own language.
		 */
		$heebo = esc_html_x( 'on', 'Heebo font: on or off', 'tabor' );

		/*
		 * Translators: If there are characters in your language that are not
		 * supported by Lora, translate this to 'off'. Do not translate
		 * into your own language.
		 */
		$lora = esc_html_x( 'on', 'Lora font: on or off', 'tabor' );

		/**
		 * Get font selections from Customizer options.
		 */
		$heading = get_theme_mod( 'heading_font', tabor_defaults( 'heading_font' ) );
		$body    = get_theme_mod( 'body_font', tabor_defaults( 'body_font' ) );

		// Return early if we're using system fonts.
		if ( ( 'System Fonts' === $heading || 'System Serif' === $heading ) && ( 'System Fonts' === $body || 'System Serif' === $body ) ) {
			return null;
		}

		// Heading font.
		if ( 'off' !== $heebo ) {
			// Load Heebo most of the time.
			$font_families[] = 'Heebo:400,500,800';

			if ( 'Default' !== $heading || ( 'System Fonts' !== $heading && 'System Serif' !== $heading ) ) {
				$font_families[] = get_theme_mod( 'heading_font', tabor_defaults( 'heading_font' ) );
			}
		}

		// Body font.
		if ( 'off' !== $lora ) {
			if ( 'Default' === $body ) {
				$font_families[] = 'Lora:400,400i,700';
			} else {
				if ( 'System Fonts' !== $body && 'System Serif' !== $body ) {
					$font_families[] = get_theme_mod( 'body_font', tabor_defaults( 'body_font' ) );
				}
			}
		}

		$query_args = array(
			'family' => rawurlencode( implode( '|', array_unique( $font_families ) ) ),
			'subset' => rawurlencode( 'latin,latin-ext' ),
		);

		$fonts_url = add_query_arg( $query_args, 'https://fonts.googleapis.com/css' );

		return esc_url_raw( $fonts_url );
	}
endif;

/**
 * Add preconnect for Google Fonts.
 *
 * @param  array|array   $urls           URLs to print for resource hints.
 * @param  string|string $relation_type  The relation type the URLs are printed.
 * @return array|array   $urls           URLs to print for resource hints.
 */
function tabor_resource_hints( $urls, $relation_type ) {
	if ( wp_style_is( 'tabor-fonts', 'queue' ) && 'preconnect' === $relation_type ) {
		$urls[] = array(
			'href' => 'https://fonts.gstatic.com',
			'crossorigin',
		);
	}

	return $urls;
}
add_filter( 'wp_resource_hints', 'tabor_resource_hints', 10, 2 );

/**
 * Add a pingback url auto-discovery header for singularly identifiable articles.
 */
function tabor_pingback_header() {
	if ( is_singular() && pings_open() ) {
		echo '<link rel="pingback" href="', bloginfo( 'pingback_url' ), '">';
	}
}

add_action( 'wp_head', 'tabor_pingback_header' );

/**
 * Adds a <p> wrapper to the more link, which shows up when the More block is added.
 *
 * @param string|int $more_link Link.
 * @param string|int $more_link_text Text.
 */
function tabor_modify_read_more_link( $more_link, $more_link_text ) {

	$button            = get_theme_mod( 'blogroll_more_btn', tabor_defaults( 'blogroll_more_btn' ) );
	$button_visibility = ( false === $button ) ? ' hidden' : null;

	$allowed_html = array(
		'span' => array(
			'class' => array(),
		),
	);

	// Show this within the Customizer, or if Button is true.
	if ( $button || is_customize_preview() ) {
		return '<p><a class="more-link ' . esc_attr( $button_visibility ) . '" href="' . esc_url( get_permalink() ) . '">' . wp_kses( $more_link_text, $allowed_html ) . '</a></p>';
	} else {
		// Clear the more link.
		$more_link_text = '';

		return $more_link_text;
	}
}
add_filter( 'the_content_more_link', 'tabor_modify_read_more_link', 0, 2 );

/**
 * Return a percentage.
 *
 * @param string|int $total Height.
 * @param string|int $number Width.
 */
function tabor_get_percentage( $total, $number ) {
	if ( $total > 0 ) {
		return round( $number / ( $total / 100 ), 2 );
	} else {
		return 0;
	}
}

/**
 * Convert HEX to RGB.
 *
 * @param string $color The original color, in 3- or 6-digit hexadecimal form.
 * @return array Array containing RGB (red, green, and blue) values for the given
 * HEX code, empty array otherwise.
 */
function tabor_hex2rgb( $color ) {
	$color = trim( $color, '#' );

	if ( strlen( $color ) === 3 ) {
		$r = hexdec( substr( $color, 0, 1 ) . substr( $color, 0, 1 ) );
		$g = hexdec( substr( $color, 1, 1 ) . substr( $color, 1, 1 ) );
		$b = hexdec( substr( $color, 2, 1 ) . substr( $color, 2, 1 ) );
	} elseif ( strlen( $color ) === 6 ) {
		$r = hexdec( substr( $color, 0, 2 ) );
		$g = hexdec( substr( $color, 2, 2 ) );
		$b = hexdec( substr( $color, 4, 2 ) );
	} else {
		return array();
	}

	return array(
		'red'   => $r,
		'green' => $g,
		'blue'  => $b,
	);
}

/**
 * Removes the "Protected" prefix on protected post titles. Returns the title back.
 */
function tabor_remove_protected_text() {
	return '%s';
}
add_filter( 'protected_title_format', 'tabor_remove_protected_text' );

/**
 * Customize the content for password protected content.
 *
 * @param string $content The post content.
 */
function tabor_protected_content( $content ) {

	if ( post_password_required() ) {
		$content = sprintf( '<p>%1s "<em>%2s</em>"</p>', esc_html__( 'Please enter the password below to access', 'tabor' ), esc_html( get_the_title() ) );
	}

	return $content;
}
add_filter( 'the_content', 'tabor_protected_content' );

/**
 * Customize the password protected form.
 */
function tabor_password_form() {
	global $post;

	$label = 'pwbox-' . ( empty( $post->ID ) ? wp_rand() : $post->ID );
	$form  = '
	<form action="' . esc_url( site_url( 'wp-login.php?action=postpass', 'login_post' ) ) . '" method="post">
		<label class="hidden" for="' . esc_attr( $label ) . '">' . esc_html__( 'Password', 'tabor' ) . ' </label>
		<input name="post_password" id="' . esc_attr( $label ) . '" type="password" size="20" maxlength="20" /><input type="submit" name="Submit" value="' . esc_attr__( 'Submit', 'tabor' ) . '" />
	</form>
	';

	return $form;
}
add_filter( 'the_password_form', 'tabor_password_form' );

/**
 * Modify the logo class with Customizer values.
 *
 * @param string $html The logo html.
 */
function tabor_site_logo_class( $html ) {

	// Is the border radius option enabled?
	$radius = get_theme_mod( 'custom_logo_border_radius', tabor_defaults( 'custom_logo_border_radius' ) );
	$radius = ( false === $radius ) ? ' no-border-radius' : null;

	// Is the hover scale animation option enabled?
	$animation = get_theme_mod( 'custom_logo_hover_animation', tabor_defaults( 'custom_logo_hover_animation' ) );
	$animation = ( false === $animation ) ? ' no-animation' : null;

	// Is the invert night mode logo option enabled?
	$invert = get_theme_mod( 'invert_night_mode_logo', tabor_defaults( 'invert_night_mode_logo' ) );
	$invert = ( true === $invert ) ? ' is-inverted-for-night-mode' : null;

	$html = str_replace( 'custom-logo-link', 'custom-logo-link site-logo ' . esc_attr( $radius . $animation . $invert ), $html );

	return $html;
}
add_filter( 'get_custom_logo', 'tabor_site_logo_class' );

/**
 * Styles the header text displayed under the site logo.
 *
 * @see tabor_setup().
 */
function tabor_header_style() {
	$header_text = display_header_text();
	?>
	<style id="tabor-custom-header-styles" type="text/css">
		<?php if ( ! $header_text ) { ?>
			.site-branding-text {
				position: absolute;
				clip: rect(1px, 1px, 1px, 1px);
			}
		<?php } ?>
	</style>
<?php
}

/**
 * Remove anything that looks like an archive title prefix ("Category:").
 *
 * @param string $title The archive title.
 */
function tabor_remove_archive_title_prefix( $title ) {
	return preg_replace( '/^\w+: /', '', $title );
}
add_filter( 'get_the_archive_title', 'tabor_remove_archive_title_prefix' );

/**
 * Custom template tags for this theme.
 */
require get_theme_file_path( '/inc/template-tags.php' );

/**
 * Additional features to allow styling of the templates.
 */
require get_theme_file_path( '/inc/template-functions.php' );

/**
 * Metaboxes.
 */
require get_theme_file_path( '/inc/metaboxes.php' );

/**
 * Additional features to allow styling of the templates.
 */
require get_theme_file_path( '/inc/shortcodes.php' );

/**
 * Customizer additions.
 */
require get_theme_file_path( '/inc/customizer/defaults.php' );
require get_theme_file_path( '/inc/customizer/customizer.php' );
require get_theme_file_path( '/inc/customizer/customizer-css.php' );
require get_theme_file_path( '/inc/customizer/customizer-editor.php' );
require get_theme_file_path( '/inc/customizer/sanitization.php' );
require get_theme_file_path( '/inc/customizer/fonts.php' );

/**
 * Starter Content.
 */
require get_theme_file_path( '/inc/starter-content.php' );

/**
 * SVG icons functions and filters.
 */
require get_theme_file_path( '/inc/icons.php' );

/**
 * Load Typekit compatibility file.
 */
require get_theme_file_path( '/inc/typekit.php' );

/**
 * JetPack compatibility.
 */
if ( class_exists( 'Jetpack' ) ) {
	require get_theme_file_path( '/inc/jetpack.php' );
}

/**
 * Auto Load Next Post compatibility.
 */
if ( class_exists( 'Auto_Load_Next_Post' ) ) {
	require get_theme_file_path( '/inc/auto-load-next-post.php' );
}

/**
 * Amazon Polly support.
 */
if ( class_exists( 'Amazonpolly' ) ) {
	require get_theme_file_path( '/inc/amazon-polly.php' );
}

/**
 * Admin specific functions.
 */
require get_parent_theme_file_path( '/inc/admin/init.php' );

/**
 * Disable Merlin WP.
 */
function themebeans_merlin() {}
