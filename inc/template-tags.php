<?php
/**
 * Custom template tags for this theme.
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package     Tabor
 * @link        https://themebeans.com/themes/tabor
 */

if ( ! function_exists( 'tabor_accessibility_settings' ) ) :
	/**
	 * Toggle for the site's accessibility settings.
	 *
	 * Create your own tabor_accessibility_settings() to override in a child theme.
	 */
	function tabor_accessibility_settings() {

		// Get the selected icon from the Customizer option.
		$icon                     = get_theme_mod( 'accessibility_settings_icon', tabor_defaults( 'accessibility_settings_icon' ) );
		$accessibility            = get_theme_mod( 'accessibility_settings', tabor_defaults( 'accessibility_settings' ) );
		$accessibility_visibility = ( false === $accessibility ) ? ' hidden' : null;

		if ( $accessibility || is_customize_preview() ) { ?>

			<div id="c-settings" class="c-settings <?php echo esc_attr( $accessibility_visibility ); ?>">
				<button id="settings-toggle" class="c-settings__toggle search-toggle button--chromeless" aria-label="<?php esc_attr_e( 'Show/hide accessibility settings', 'tabor' ); ?>" aria-controls="settings" aria-expanded="false">
					<?php echo tabor_get_svg( array( 'icon' => esc_attr( $icon ) ) ); ?>
					<span class="screen-reader-text"><?php echo esc_html_x( 'Settings', 'settings button', 'tabor' ); ?></span>
				</button>
				<?php tabor_accessibility_dropdown(); ?>
			</div>
			<?php
		}

	}
endif;

if ( ! function_exists( 'tabor_accessibility_dropdown' ) ) :
	/**
	 * Content for the site's accessibility content.
	 *
	 * Create your own tabor_accessibility_dropdown() to override in a child theme.
	 */
	function tabor_accessibility_dropdown() {
	?>
		<div id="settings" class="c-settings__wrapper" aria-hidden="true" aria-labelledby="settings-toggle">
			<div class="c-settings__inner header-font medium smooth">
				<div class="c-settings__arrow"></div>
				<div class="c-settings__item c-settings__item--night-mode">
					<div class="c-settings__item-inner flex items-center">
						<span class="c-settings__label gray"><?php apply_filters( 'tabor_accessibility_settings_night_mode_label', esc_html_e( 'Night Mode', 'tabor' ) ); ?></span>
						<button tabindex="0" class="c-settings__switch c-settings__switch--night-mode c-switch" role="switch" aria-checked="false" aria-label="<?php apply_filters( 'tabor_accessibility_settings_night_mode_aria_label', esc_attr_e( 'Toggle Night Mode', 'tabor' ) ); ?>"></button>
					</div>
				</div>
				<div class="c-settings__item text-size">
					<div class="c-settings__item-inner flex items-center">
						<span class="c-settings__label gray"><?php apply_filters( 'tabor_accessibility_settings_text_size_label', esc_html_e( 'Text Size', 'tabor' ) ); ?></span>
						<button class="c-settings__text-size" tabindex="0" aria-label="<?php apply_filters( 'tabor_accessibility_settings_text_size_label', esc_attr_e( 'Change Text Size', 'tabor' ) ); ?>">A</button>
					</div>
				</div>
			</div>
		</div>

	<?php
	}
endif;

if ( ! function_exists( 'tabor_customize_home_entry_header' ) ) :
	/**
	 * Outputs a entry header within the Customizer, to aid with live previewing.
	 *
	 * Create your own tabor_customize_home_entry_header() to override in a child theme.
	 */
	function tabor_customize_home_entry_header() {

		// Get the selected icon from the Customizer option.
		if ( is_customize_preview() && ( is_front_page() ) ) {

			// Let's check to see if styles are enabled or not.
			$option = get_theme_mod( 'disable_home_styles', tabor_defaults( 'disable_home_styles' ) );

			// Only display if the option is selected in the Customizer.
			$visibility = ( false === $option ) ? ' hidden' : null;
			?>

			<header class="entry-header entry-header--customizer top-spacer bottom-spacer <?php echo esc_attr( $visibility ); ?>">
				<?php the_title( '<h1 class="entry-title h1">', '</h1>' ); ?>
			</header>

		<?php
		}
	}
endif;

if ( ! function_exists( 'tabor_header_search' ) ) :
	/**
	 * Site-wide search bar.
	 *
	 * Create your own tabor_header_search() to override in a child theme.
	 */
	function tabor_header_search() {

		$search            = get_theme_mod( 'header_search', tabor_defaults( 'header_search' ) );
		$search_visibility = ( false === $search ) ? ' hidden' : null;

		if ( $search || is_customize_preview() ) {
			?>
			<div id="site-search" class="site-search <?php echo esc_attr( $search_visibility ); ?>">
				<?php get_search_form(); ?>
				<div id="site-search-overlay" class="site-search-overlay"></div>
			</div>
			<?php
		}

	}
endif;
add_action( 'tabor_before_header', 'tabor_header_search' );

if ( ! function_exists( 'tabor_header_search_toggle' ) ) :
	/**
	 * Trigger toggle for the site-wide search bar.
	 *
	 * Create your own tabor_header_search_toggle() to override in a child theme.
	 */
	function tabor_header_search_toggle() {

		$search            = get_theme_mod( 'header_search', tabor_defaults( 'header_search' ) );
		$search_visibility = ( false === $search ) ? ' hidden' : null;

		if ( $search || is_customize_preview() ) {
			?>
			<button id="search-toggle" type="submit" class="button--chromeless search-toggle search-submit <?php echo esc_attr( $search_visibility ); ?>">
				<?php echo tabor_get_svg( array( 'icon' => 'search' ) ); ?>
				<span class="screen-reader-text"><?php echo esc_html_x( 'Search', 'submit button', 'tabor' ); ?></span>
			</button>
		<?php
		}

	}
endif;

if ( ! function_exists( 'tabor_site_info' ) ) :
	/**
	 * Site colophon content.
	 *
	 * Create your own tabor_site_info() to override in a child theme.
	 */
	function tabor_site_info() {

		$copyrightyear = get_theme_mod( 'copyright_year', tabor_defaults( 'copyright_year' ) );
		$copyrighttext = get_theme_mod( 'copyright_text', tabor_defaults( 'copyright_text' ) );
		$themeinfo     = get_theme_mod( 'theme_info', tabor_defaults( 'theme_info' ) );

		/*
		 * Check if the copyright or theme info is visible. If so, proceed.
		 */
		if ( $copyrightyear || $themeinfo || $copyrighttext || is_customize_preview() ) {

			echo '<div class="site-info container center-align medium header-font gray" role="contentinfo">';

			/*
			 * Check if the Copyright option is selected in the Customizer.
			 * Let's also display it in the Customizer, so we don't have to do a page refresh.
			 */
			if ( $copyrightyear || $copyrighttext || is_customize_preview() ) {

				/**
				 * Only display if the option is selected in the Customizer.
				 */
				$visibility = ( false === $copyrightyear ) ? ' hidden' : null;

				echo '<span class="site-copyright">';

				// Year.
				if ( $copyrightyear || is_customize_preview() ) {
					printf(
						'<span class="%1s%2s" itemscope itemtype="http://schema.org/copyrightYear">&copy; %3s </span>',
						esc_attr( 'copyright-year' ),
						esc_attr( $visibility ),
						esc_html( date( 'Y' ) )
					);
				}

				/*
				 * Format an array of allowed HTML tags and attributes for the $copyrighttext value.
				 *
				 * @link https://codex.wordpress.org/Function_Reference/wp_kses
				 */
				$allowed_html_array = array(
					'a'      => array(
						'href'  => array(),
						'title' => array(),
					),
					'br'     => array(),
					'cite'   => array(),
					'em'     => array(),
					'strong' => array(),
				);

				// Check if the Copyright option is selected in the Customizer.
				if ( $copyrighttext || is_customize_preview() ) {
					printf(
						'<span class="%1s" itemscope itemtype="http://schema.org/copyrightHolder">%2s </span>',
						esc_attr( 'copyright-text' ),
						wp_kses( $copyrighttext, $allowed_html_array )
					);
				}

				echo '</span>';
			}

			/*
			 * Check if the Theme Info option is selected in the Customizer.
			 * Let's also display it in the Customizer, so we don't have to do a page refresh.
			 */
			if ( $themeinfo || is_customize_preview() ) :
				/**
				 * Only display if the option is selected in the Customizer.
				 */
				$visibility = ( false === $themeinfo ) ? ' hidden ' : null;

				/*
				 * Format an array of allowed HTML tags and attributes for the $copyrighttext value.
				 *
				 * @link https://codex.wordpress.org/Function_Reference/wp_kses
				 */
				$allowed_html_array = array(
					'a'    => array(
						'href'  => array(),
						'title' => array(),
					),
					'span' => array(
						'class' => array(),
					),
				);

				printf(
					/* translators: 1: class. 2: visibility class. 3: the theme url. 4: The theme name */
					wp_kses( __( '<span class="%1$1s%2$2s"><a href="%3$3s">Powered by %4$4s WordPress Theme</a></span>', 'tabor' ), $allowed_html_array ),
					esc_attr( 'site-theme' ),
					esc_attr( $visibility ),
					esc_url( 'https://themebeans.com/themes/tabor/' ),
					esc_html( 'Tabor' ) // Don't translate the theme name please!
				);

			endif;

			echo '</div>';

		}
	}
endif;

if ( ! function_exists( 'tabor_post_media' ) ) :
	/**
	 * Wraps the post thumbnail in an anchor element on index views, or a div
	 * element when on single views.
	 *
	 * @param string|int $post_id The current post's id.
	 */
	function tabor_post_media( $post_id ) {

		global $post;

		/* Don't do anything if this post is password protected. */
		if ( post_password_required() ) {
			return;
		}

		// Is the singular featured image selected to display?
		$single_featured_media            = get_theme_mod( 'single_featured_media', tabor_defaults( 'single_featured_media' ) );
		$single_featured_media_visibility = ( is_singular() && false === $single_featured_media ) ? ' hidden' : null;
		if ( is_singular() && false === $single_featured_media && ! is_customize_preview() ) {
			return;
		}

		// Is the blogroll featured image selected to display?
		$blogroll_featured_media            = get_theme_mod( 'blogroll_featured_media', tabor_defaults( 'blogroll_featured_media' ) );
		$blogroll_featured_media_visibility = ( ! is_singular() && false === $blogroll_featured_media ) ? ' hidden' : null;
		if ( ! is_singular() && false === $blogroll_featured_media && ! is_customize_preview() ) {
			return;
		}

		/* Video Post Format */
		$oembed = get_post_meta( get_the_ID(), '_tabor_video', 1 );

		/* Check if the post is a video post format and has an oEmbed. */
		if ( has_post_format( 'video' ) && $oembed ) {

			$output = sprintf( '<div class="entry-video bottom-spacer center-align %1$s %2$s">%3$s</div>', esc_attr( $single_featured_media_visibility ), esc_attr( $blogroll_featured_media_visibility ), wp_oembed_get( esc_url( $oembed ) ) );

			$allowed_html = array(
				'div'    => array(
					'class' => array(),
				),
				'iframe' => array(
					'class'       => array(),
					'style'       => array(),
					'height'      => array(),
					'width'       => array(),
					'src'         => array(),
					'frameborder' => array(),
				),
			);

			echo wp_kses( $output, $allowed_html );

			return;
		}

		/* Don't do anything if there's no post thumbnail. */
		if ( ! has_post_thumbnail() ) {
			return;
		}

		$img_sml = wp_get_attachment_image_src( get_post_thumbnail_id( $post_id ), 'tabor-featured-image-sml' );
		$img_med = wp_get_attachment_image_src( get_post_thumbnail_id( $post_id ), 'tabor-featured-image-med' );
		$img_lrg = wp_get_attachment_image_src( get_post_thumbnail_id( $post_id ), 'tabor-featured-image-lrg' );

		/* You define this doing height / width * 100% */
		$intrinsic = tabor_get_percentage( $img_sml[1], $img_sml[2] ) . '%';

		/*
		 * Output.
		 */
		$output = sprintf(
			'
			<div class="entry-media__figure-wrapper margin-auto" style="max-width:%6$spx;">
			<figure class="intrinsic" style="padding-top: %8$s;">
			<img
				src="%3$s"
				data-original="%3$s"
				data-original-set="%1$s %2$sw, %3$s %4$sw, %5$s %6$sw"
				srcset="%1$s %2$sw, %3$s %4$sw, %5$s %6$sw"
				sizes="90vw, (min-width: 600px) 90vw, 60vw"
				alt="%7$s"
				class="lazyload">
			</figure>
			</div>',
			esc_url( $img_sml[0] ),
			esc_attr( $img_sml[1] ),
			esc_url( $img_med[0] ),
			esc_attr( $img_med[1] ),
			esc_url( $img_lrg[0] ),
			esc_attr( $img_lrg[1] ),
			esc_attr( get_the_title( $post_id ) ),
			esc_attr( $intrinsic )
		);

		$allowed_html = array(
			'div'    => array(
				'class' => array(),
				'style' => array(),
			),
			'figure' => array(
				'class' => array(),
				'style' => array(),
			),
			'img'    => array(
				'src'           => array(),
				'data-original' => array(),
				'srcset'        => array(),
				'sizes'         => array(),
				'alt'           => array(),
				'class'         => array(),
			),
		);

		// Captions.
		$get_caption = get_post( get_post_thumbnail_id( $post_id ) )->post_excerpt;
		$has_caption = $get_caption ? true : false;

		$allowed_caption_html = array(
			'figcaption' => array(),
			'a'          => array(
				'href'   => array(),
				'target' => array(),
				'alt'    => array(),
				'title'  => array(),
			),
		);

		$caption = '';
		if ( $has_caption ) {
			$caption = '<figcaption>' . $get_caption . '</figcaption>';
		}

		if ( '' !== get_the_post_thumbnail() ) {
			?>

			<div class="entry-media bottom-spacer center-align <?php echo esc_attr( $single_featured_media_visibility ); ?> <?php echo esc_attr( $blogroll_featured_media_visibility ); ?>">

				<?php
				if ( is_singular() ) :
					echo wp_kses( $output, $allowed_html );
					echo wp_kses( $caption, $allowed_caption_html );
				else :
					?>
					<a class="post-thumbnail" href="<?php esc_url( the_permalink() ); ?>" aria-hidden="true">
						<?php echo wp_kses( $output, $allowed_html ); ?>
						<?php echo wp_kses( $caption, $allowed_caption_html ); ?>
					</a>
					<?php
				endif;
				?>

			</div>

			<?php
		}
	}
endif;

if ( ! function_exists( 'tabor_posted_on' ) ) :
	/**
	 * Prints HTML with meta information for the author and comments.
	 * Based on Twenty Seventeen.
	 */
	function tabor_posted_on() {

		// Is the option enabled?
		$author            = get_theme_mod( 'author_meta', tabor_defaults( 'author_meta' ) );
		$author_visibility = ( false === $author ) ? ' hidden' : null;

		// Check for link post format and output a link icon if it is one.
		$link        = get_post_meta( get_the_ID(), '_tabor_link', true );
		$format_icon = ( has_post_format( 'link' ) && $link ) ? tabor_get_svg( array( 'icon' => 'chain' ) ) : null;

		// Add a sticky icon, if it's necessary.
		$sticky_icon = ( is_sticky() && is_home() ) ? tabor_get_svg( array( 'icon' => 'thumb-tack' ) ) : null;

		// Add a lock icon, if it's necessary.
		$password_icon = ( post_password_required() && is_home() ) ? tabor_get_svg( array( 'icon' => 'lock' ) ) : null;

		// Get the author name; wrap it in a link.
		$byline = sprintf(
			/* translators: %s: post author */
			'<span>' . __( 'by %s', 'tabor' ) . '</span>',
			'<span class="author vcard"><a class="url fn n" href="' . esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) . '">' . get_the_author() . '</a></span>'
		);

		$allowed_html = array(
			'time' => array(
				'class'    => array(),
				'datetime' => array(),
			),
			'span' => array(
				'class' => array(),
			),
			'a'    => array(
				'class' => array(),
				'href'  => array(),
			),
		);

		// Finally, let's write all of this to the page.
		echo '<div class="entry-meta flex items-center medium header-font gray">' . wp_kses( $password_icon, tabor_svg_allowed_html() ), wp_kses( $sticky_icon, tabor_svg_allowed_html() ), wp_kses( $format_icon, tabor_svg_allowed_html() ) . '<span class="posted-on">' . wp_kses( tabor_time_link(), $allowed_html ) . '</span><span class="byline ' . esc_attr( $author_visibility ) . '"> ' . wp_kses( $byline, $allowed_html ) . '</span></div>';

	}
endif;

if ( ! function_exists( 'tabor_time_link' ) ) :
	/**
	 * Gets a nicely formatted string for the published date.
	 * Based on Twenty Seventeen.
	 */
	function tabor_time_link() {

		// What label do we want to display?
		$date  = get_theme_mod( 'post_date', tabor_defaults( 'post_date' ) );
		$label = ( 'published' === $date ) ? esc_html__( 'Published', 'tabor' ) : esc_html__( 'Updated', 'tabor' );

		if ( 'none' === $date && ! is_customize_preview() ) {
			return;
		}

		// Get the updated and the published times.
		$time_string = '<span>%5$s</span> <time class="entry-date published updated" datetime="%1$s">%2$s</time>';

		if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
			$time_string = '<span>%5$s</span> <time class="updated" datetime="%3$s">%4$s</time><time class="entry-date published" datetime="%1$s">%2$s</time>';
		}

		$time_string = sprintf(
			$time_string,
			get_the_date( DATE_W3C ),
			get_the_date(),
			get_the_modified_date( DATE_W3C ),
			get_the_modified_date(),
			apply_filters( 'tabor_post_meta_updated_text', $label )
		);

		// Wrap the time string in a link, and preface it with 'Posted on'.
		return sprintf(
			/* translators: %s: post date */
			__( '<span class="screen-reader-text">Posted on</span> %s', 'tabor' ),
			'<a href="' . esc_url( get_permalink() ) . '" class="' . esc_attr( 'posted-on--' . $date ) . '" rel="bookmark">' . $time_string . '</a>'
		);
	}
endif;

if ( ! function_exists( 'tabor_site_logo' ) ) :
	/**
	 * Output an <img> tag of the site logo.
	 */
	function tabor_site_logo() {

		$site_title_and_logo = get_theme_mod( 'site_title_and_logo', tabor_defaults( 'site_title_and_logo' ) );

		$visibility = has_custom_logo() ? ' hidden' : null;
		$visibility = ! $site_title_and_logo ? $visibility : null;

		$has_logo = ! has_custom_logo() && is_customize_preview() ? 'no-site-logo' : null;

		do_action( 'tabor_before_site_logo' );

		the_custom_logo();

		if ( ! has_custom_logo() || $site_title_and_logo ) {
			printf( '<h1 class="h3 site-title site-logo %1$s %4$s" itemscope itemtype="http://schema.org/Organization"><a href="%2$s" rel="home" itemprop="url" class="black">%3$s</a></h1>', esc_attr( $visibility ), esc_url( home_url( '/' ) ), esc_html( get_bloginfo( 'name' ) ), esc_attr( $has_logo ) );

		}

		do_action( 'tabor_after_site_logo' );
	}

endif;

if ( ! function_exists( 'tabor_post_has' ) ) :
	/**
	 * Look for pingbacks.
	 *
	 * @param string|int $type The type of comment.
	 * @param string|int $post_id The current post's id.
	 */
	function tabor_post_has( $type, $post_id ) {
		$comments = get_comments( 'status=approve&type=' . $type . '&post_id=' . $post_id );
		$comments = separate_comments( $comments );
		return 0 < count( $comments[ $type ] );
	}
endif;

if ( ! function_exists( 'tabor_comments_button' ) ) :
	/**
	 * Prints category count button.
	 */
	function tabor_comments_button() {

		global $post;

		// Is the option enabled?
		$comments            = get_theme_mod( 'comments_visibility', tabor_defaults( 'comments_visibility' ) );
		$comments_visibility = ( false === $comments ) ? ' hidden' : null;

		/* Don't do anything if this post is password protected. */
		if ( post_password_required() ) {
			return;
		}

		if ( ! $comments && ! is_customize_preview() ) {
			return;
		}

		// If comments are closed and there are comments, let's leave a little note, shall we?
		if ( tabor_post_has( 'pings', $post->ID ) || comments_open() && post_type_supports( get_post_type(), 'comments' ) ) :
			?>

			<div class="flex justify-start items-center <?php echo esc_attr( $comments_visibility ); ?>">

				<a class="comments-trigger button button--mobile-fullwidth center-align" id="comments-trigger" href="<?php comments_link(); ?>">

					<span class="display-none"><?php esc_html_e( 'Close Comments', 'tabor' ); ?></span>

					<span class="display-inline-block">
						<?php
						// If we have comments.
						if ( get_comments_number() ) {

							esc_html_e( 'Show ', 'tabor' );

							$comments_number = get_comments_number();
							if ( '1' === $comments_number ) {
								esc_html_e( '1 Comment', 'tabor' );
							} else {
								printf(
									esc_html(
										/* translators: 1: number of comments */
										_nx(
											'%s Comment',
											'all %s Comments',
											$comments_number,
											'number of comments',
											'tabor'
										)
									),
									esc_html( number_format_i18n( $comments_number ) )
								);
							}
						} else {
							esc_html_e( 'Leave a Comment', 'tabor' );
						}

						?>

					</span>
				</a>

			</div>

		<?php
		endif;
	}
endif;

if ( ! function_exists( 'tabor_categories' ) ) :
	/**
	 * Prints HTML with meta information for the categories.
	 */
	function tabor_categories() {
		if ( 'post' === get_post_type() ) {

			// Let's check to see if the option is enabled via the Customizer.
			$option     = get_theme_mod( 'categories', tabor_defaults( 'categories' ) );
			$visibility = ( false === $option ) ? ' hidden' : null;

			if ( ! $option && ! is_customize_preview() ) {
				return;
			}

			/* translators: used between list items, there is a space after the comma */
			$categories_list = get_the_category_list( '' );

			if ( $categories_list && tabor_categorized_blog() ) {
				printf( '<span class="cat-links header-font extra-small medium smooth dark-gray %1$s">%2$s</span>', esc_attr( $visibility ), $categories_list ); // WPCS: XSS OK.
			}
		}
	}
endif;

if ( ! function_exists( 'tabor_tags' ) ) :
	/**
	 * Prints HTML with meta information for the categories, tags and comments.
	 */
	function tabor_tags() {

		// Hide category and tag text for pages.
		if ( is_singular() && 'post' === get_post_type() ) {

			// Let's check to see if the option is enabled via the Customizer.
			$option     = get_theme_mod( 'tags', tabor_defaults( 'tags' ) );
			$visibility = ( false === $option ) ? ' hidden' : null;

			if ( ! $option && ! is_customize_preview() ) {
				return;
			}

			$tags_list = get_the_tag_list( '', '' );

			if ( ! $tags_list ) {
				return;
			}

			if ( $tags_list ) {
				printf( '<span class="tags-links header-font extra-small medium smooth dark-gray %1$s">%2$s</span>', esc_attr( $visibility ), $tags_list ); // WPCS: XSS OK.
			}
		}
	}
endif;

if ( ! function_exists( 'tabor_related_categories' ) ) :
	/**
	 * Output child categories for use on archive/taxonomy views.
	 */
	function tabor_related_categories() {

		// Return if we're not viewing a post category or tag pages.
		if ( ! is_category() ) {
			return;
		}

		$queried_object = get_queried_object();
		$term_id        = $queried_object->term_id;

		$args = array(
			'taxonomy'            => 'category',
			'use_desc_for_title'  => 0,
			'hide_title_if_empty' => true,
			'title_li'            => false,
			'echo'                => 0,
			'show_option_none'    => 0,
			'child_of'            => $term_id,
		);

		$cats = wp_list_categories( $args );

		// Return early if there are no child categories.
		if ( empty( $cats ) ) {
			return;
		}

		/*
		 * Format an array of allowed HTML tags and attributes.
		 *
		 * @link https://codex.wordpress.org/Function_Reference/wp_kses
		 */
		$allowed_html_array = array(
			'li' => array(
				'class' => array(),
			),
			'a'  => array(
				'href'  => array(),
				'title' => array(),
			),
		);

		// Label for the related title.
		$label = apply_filters( 'tabor_related_categories_label', esc_html__( 'Related topics:', 'tabor' ) );

		// Echo the categories.
		echo sprintf(
			'<nav class="page-header__categories relative display-block nav--overflow overflow-hidden"><div><ul class="list-reset extra-small header-font"><li class="h5 gray medium">%1s</li>%2s</ul></di></nav>',
			esc_html( $label ),
			wp_kses( $cats, $allowed_html_array )
		);
	}
endif;

/**
 * Determine whether blog/site has more than one category.
 *
 * @return bool True of there is more than one category, false otherwise.
 */
function tabor_categorized_blog() {
	// Create an array of all the categories that are attached to posts.
	if ( false === ( $all_the_cool_cats = get_transient( 'tabor_categories' ) ) ) {
		$all_the_cool_cats = get_categories(
			array(
				'fields'     => 'ids',
				'hide_empty' => 1,
				'number'     => 2,
			)
		);

		// Count the number of categories that are attached to the posts.
		$all_the_cool_cats = count( $all_the_cool_cats );

		set_transient( 'tabor_categories', $all_the_cool_cats );
	}

	if ( $all_the_cool_cats > 1 ) {
		// This blog has more than 1 category so tabor_categorized_blog should return true.
		return true;
	} else {
		// This blog has only 1 category so tabor_categorized_blog should return false.
		return false;
	}
}

/**
 * Flush out the transients used in { @see tabor_categorized_blog() }.
 */
function tabor_category_transient_flusher() {
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
		return;
	}
	// Like, beat it. Dig?
	delete_transient( 'tabor_categories' );
}
add_action( 'edit_category', 'tabor_category_transient_flusher' );
add_action( 'save_post', 'tabor_category_transient_flusher' );
