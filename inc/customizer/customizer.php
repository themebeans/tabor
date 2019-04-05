<?php
/**
 * Theme Customizer functionality
 *
 * @package     Tabor
 * @link        https://themebeans.com/themes/tabor
 */

/**
 * Customizer.
 *
 * @param WP_Customize_Manager $wp_customize the Customizer object.
 */
function tabor_customize_register( $wp_customize ) {

	/**
	 * Remove the Header Image panel, as we only need the "Display Site Title and Tagline" setting in Site Identity.
	 */
	$wp_customize->remove_section( 'header_image' );

	/**
	 * Customize.
	 */
	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
	$wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';

	$wp_customize->selective_refresh->add_partial(
		'blogname', array(
			'selector'        => '.site-title a',
			'render_callback' => 'tabor_customize_partial_blogname',
		)
	);

	$wp_customize->selective_refresh->add_partial(
		'blogdescription', array(
			'selector'        => '.site-description',
			'render_callback' => 'tabor_customize_partial_blogdescription',
		)
	);

	/**
	 * Add custom controls.
	 */
	require get_parent_theme_file_path( THEMEBEANS_CUSTOM_CONTROLS_DIR . 'class-themebeans-title-control.php' );
	require get_parent_theme_file_path( THEMEBEANS_CUSTOM_CONTROLS_DIR . 'class-themebeans-range-control.php' );
	require get_parent_theme_file_path( THEMEBEANS_CUSTOM_CONTROLS_DIR . 'class-themebeans-toggle-control.php' );

	/**
	 * Top-Level Customizer sections and panels.
	 */
	$wp_customize->add_section(
		'tabor_theme_options', array(
			'title'    => esc_html__( 'Theme Options', 'tabor' ),
			'priority' => 30,
		)
	);

	$wp_customize->add_section(
		'tabor_fonts', array(
			'title'    => esc_html__( 'Typography', 'tabor' ),
			'priority' => 40,
		)
	);

	/**
	 * Typography.
	 */
	$wp_customize->add_setting(
		'heading_font', array(
			'default'           => tabor_defaults( 'heading_font' ),
			'sanitize_callback' => 'tabor_sanitize_nohtml',
		)
	);

	$wp_customize->add_control(
		'heading_font', array(
			'type'        => 'select',
			'label'       => esc_html__( 'Heading Font', 'tabor' ),
			'description' => '',
			'section'     => 'tabor_fonts',
			'choices'     => tabor_get_fonts(),
		)
	);

	$wp_customize->add_setting(
		'body_font', array(
			'default'           => tabor_defaults( 'body_font' ),
			'sanitize_callback' => 'tabor_sanitize_nohtml',
		)
	);

	$wp_customize->add_control(
		'body_font', array(
			'type'        => 'select',
			'label'       => esc_html__( 'Body Font', 'tabor' ),
			'description' => '',
			'section'     => 'tabor_fonts',
			'choices'     => tabor_get_fonts(),
		)
	);

	/**
	 * Typekit.
	 */
	$wp_customize->add_setting(
		'typekit_id', array(
			'default'           => tabor_defaults( 'typekit_id' ),
			'sanitize_callback' => 'esc_html',
		)
	);

	$wp_customize->add_control(
		'typekit_id', array(
			'type'        => 'text',
			'label'       => esc_html__( 'Typekit Kit ID', 'tabor' ),
			'description' => esc_html__( 'Located within your kit embed code. Font changes can be added to the CSS module or child theme.', 'tabor' ),
			'section'     => 'tabor_fonts',
		)
	);

	$wp_customize->add_setting(
		'typekit_font_1', array(
			'default'           => tabor_defaults( 'typekit_font_1' ),
			'sanitize_callback' => 'esc_html',
		)
	);

	$wp_customize->add_control(
		'typekit_font_1', array(
			'type'    => 'text',
			'label'   => esc_html__( 'Font Family #1', 'tabor' ),
			'section' => 'tabor_fonts',
		)
	);

	$wp_customize->add_setting(
		'typekit_font_2', array(
			'default'           => tabor_defaults( 'typekit_font_2' ),
			'sanitize_callback' => 'esc_html',
		)
	);

	$wp_customize->add_control(
		'typekit_font_2', array(
			'type'    => 'text',
			'label'   => esc_html__( 'Font Family #2', 'tabor' ),
			'section' => 'tabor_fonts',
		)
	);

	/**
	 * Add the site logo max-width options to the Site Identity section.
	 */
	$wp_customize->add_setting(
		'custom_logo_max_width', array(
			'default'           => tabor_defaults( 'custom_logo_max_width' ),
			'transport'         => 'postMessage',
			'sanitize_callback' => 'absint',
		)
	);

	$wp_customize->add_control(
		new ThemeBeans_Range_Control(
			$wp_customize, 'custom_logo_max_width', array(
				'default'     => tabor_defaults( 'custom_logo_max_width' ),
				'type'        => 'themebeans-range',
				'label'       => esc_html__( 'Max Width', 'tabor' ),
				'description' => 'px',
				'section'     => 'title_tagline',
				'priority'    => 8,
				'input_attrs' => array(
					'min'  => 40,
					'max'  => 300,
					'step' => 2,
				),
			)
		)
	);

	$wp_customize->add_setting(
		'custom_logo_mobile_max_width', array(
			'default'           => tabor_defaults( 'custom_logo_max_width' ),
			'transport'         => 'postMessage',
			'sanitize_callback' => 'absint',
		)
	);

	$wp_customize->add_control(
		new ThemeBeans_Range_Control(
			$wp_customize, 'custom_logo_mobile_max_width', array(
				'default'     => tabor_defaults( 'custom_logo_max_width' ),
				'type'        => 'themebeans-range',
				'label'       => esc_html__( 'Mobile Max Width', 'tabor' ),
				'description' => 'px',
				'section'     => 'title_tagline',
				'priority'    => 9,
				'input_attrs' => array(
					'min'  => 40,
					'max'  => 200,
					'step' => 2,
				),
			)
		)
	);

	$wp_customize->add_setting(
		'custom_logo_border_radius', array(
			'default'           => tabor_defaults( 'custom_logo_border_radius' ),
			'transport'         => 'postMessage',
			'sanitize_callback' => 'tabor_sanitize_checkbox',
		)
	);

	$wp_customize->add_control(
		new ThemeBeans_Toggle_Control(
			$wp_customize, 'custom_logo_border_radius', array(
				'type'     => 'themebeans-toggle',
				'label'    => esc_html__( 'Border Radius', 'tabor' ),
				'section'  => 'title_tagline',
				'priority' => 9,
			)
		)
	);

	$wp_customize->add_setting(
		'custom_logo_hover_animation', array(
			'default'           => tabor_defaults( 'custom_logo_hover_animation' ),
			'transport'         => 'postMessage',
			'sanitize_callback' => 'tabor_sanitize_checkbox',
		)
	);

	$wp_customize->add_control(
		new ThemeBeans_Toggle_Control(
			$wp_customize, 'custom_logo_hover_animation', array(
				'type'     => 'themebeans-toggle',
				'label'    => esc_html__( 'Hover Animation', 'tabor' ),
				'section'  => 'title_tagline',
				'priority' => 9,
			)
		)
	);

	$wp_customize->add_setting(
		'invert_night_mode_logo', array(
			'default'           => tabor_defaults( 'invert_night_mode_logo' ),
			'transport'         => 'postMessage',
			'sanitize_callback' => 'tabor_sanitize_checkbox',
		)
	);

	$wp_customize->add_control(
		new ThemeBeans_Toggle_Control(
			$wp_customize, 'invert_night_mode_logo', array(
				'type'     => 'themebeans-toggle',
				'label'    => esc_html__( 'Invert for Night Mode', 'tabor' ),
				'section'  => 'title_tagline',
				'priority' => 9,
			)
		)
	);

	$wp_customize->add_setting(
		'site_title_and_logo', array(
			'default'           => tabor_defaults( 'site_title_and_logo' ),
			'transport'         => 'postMessage',
			'sanitize_callback' => 'tabor_sanitize_checkbox',
		)
	);

	$wp_customize->add_control(
		'site_title_and_logo', array(
			'type'    => 'checkbox',
			'label'   => esc_html__( 'Display Site Title and Logo', 'tabor' ),
			'section' => 'title_tagline',
		)
	);

	/**
	 * Search.
	 */
	$wp_customize->add_setting( 'header_title', array( 'sanitize_callback' => 'esc_html' ) );

	$wp_customize->add_control(
		new ThemeBeans_Title_Control(
			$wp_customize, 'header_title', array(
				'type'    => 'themebeans-title',
				'label'   => esc_html__( 'Header', 'tabor' ),
				'section' => 'tabor_theme_options',
			)
		)
	);

	$wp_customize->add_setting(
		'header_search', array(
			'default'           => tabor_defaults( 'header_search' ),
			'transport'         => 'postMessage',
			'sanitize_callback' => 'tabor_sanitize_checkbox',
		)
	);

	$wp_customize->add_control(
		new ThemeBeans_Toggle_Control(
			$wp_customize, 'header_search', array(
				'type'                => 'themebeans-toggle',
				'label'               => esc_html__( 'Header Search', 'tabor' ),
				'description'         => esc_html__( 'Toggle a site-wide search toggle next to the header navigation.', 'tabor' ),
				'toggled_description' => esc_html__( 'Showing the site-wide search toggle and search form.', 'tabor' ),
				'section'             => 'tabor_theme_options',
			)
		)
	);

	/**
	 * Accessibility Settings.
	 */
	$wp_customize->add_setting(
		'accessibility_settings', array(
			'default'           => tabor_defaults( 'accessibility_settings' ),
			'transport'         => 'postMessage',
			'sanitize_callback' => 'tabor_sanitize_checkbox',
		)
	);

	$wp_customize->add_control(
		new ThemeBeans_Toggle_Control(
			$wp_customize, 'accessibility_settings', array(
				'type'                => 'themebeans-toggle',
				'label'               => esc_html__( 'Accessibility Settings', 'tabor' ),
				'description'         => esc_html__( 'Toggle night mode and text size modifiers for your readers.', 'tabor' ),
				'toggled_description' => esc_html__( 'Showing the night mode and text size accessibility settings.', 'tabor' ),
				'section'             => 'tabor_theme_options',
			)
		)
	);

	$wp_customize->add_setting(
		'accessibility_settings_icon', array(
			'default'           => tabor_defaults( 'accessibility_settings_icon' ),
			'transport'         => 'postMessage',
			'sanitize_callback' => 'tabor_sanitize_select',
		)
	);

	$wp_customize->add_control(
		'accessibility_settings_icon', array(
			'type'    => 'select',
			'section' => 'tabor_theme_options',
			'choices' => array(
				'settings'   => esc_html__( 'Cog Icon', 'tabor' ),
				'settings-2' => esc_html__( 'Mix Panel Icon', 'tabor' ),
				'settings-3' => esc_html__( 'Mix Panel Filled', 'tabor' ),
			),
		)
	);

	/**
	 * Blogroll.
	 */
	$wp_customize->add_setting( 'blogroll_title', array( 'sanitize_callback' => 'esc_html' ) );

	$wp_customize->add_control(
		new ThemeBeans_Title_Control(
			$wp_customize, 'blogroll_title', array(
				'type'            => 'themebeans-title',
				'label'           => esc_html__( 'Blogroll', 'tabor' ),
				'section'         => 'tabor_theme_options',
				'active_callback' => 'tabor_is_blog',
			)
		)
	);

	$wp_customize->add_setting(
		'blogroll_featured_media', array(
			'default'           => tabor_defaults( 'blogroll_featured_media' ),
			'transport'         => 'postMessage',
			'sanitize_callback' => 'tabor_sanitize_checkbox',
		)
	);

	$wp_customize->add_control(
		new ThemeBeans_Toggle_Control(
			$wp_customize, 'blogroll_featured_media', array(
				'type'                => 'themebeans-toggle',
				'label'               => esc_html__( 'Featured Media', 'tabor' ),
				'description'         => esc_html__( 'Toggle to display featured images and videos on the blogroll.', 'tabor' ),
				'toggled_description' => esc_html__( 'Showing featured images and videos on the blogroll.', 'tabor' ),
				'section'             => 'tabor_theme_options',
				'active_callback'     => 'tabor_is_blog',
			)
		)
	);

	$wp_customize->add_setting(
		'blogroll_excerpt', array(
			'default'           => tabor_defaults( 'blogroll_excerpt' ),
			'sanitize_callback' => 'tabor_sanitize_checkbox',
		)
	);

	$wp_customize->add_control(
		new ThemeBeans_Toggle_Control(
			$wp_customize, 'blogroll_excerpt', array(
				'type'                => 'themebeans-toggle',
				'label'               => esc_html__( 'Excerpt', 'tabor' ),
				'description'         => esc_html__( 'Toggle to use to the post excerpt on the blogroll, instead of the More block, to truncate content.', 'tabor' ),
				'toggled_description' => esc_html__( 'Using the post excerpt on the blogroll to truncate content.', 'tabor' ),
				'section'             => 'tabor_theme_options',
				'active_callback'     => 'tabor_is_blog',
			)
		)
	);

	$wp_customize->add_setting(
		'blogroll_more_btn', array(
			'default'           => tabor_defaults( 'blogroll_more_btn' ),
			'transport'         => 'postMessage',
			'sanitize_callback' => 'tabor_sanitize_checkbox',
		)
	);

	$wp_customize->add_control(
		new ThemeBeans_Toggle_Control(
			$wp_customize, 'blogroll_more_btn', array(
				'type'                => 'themebeans-toggle',
				'label'               => esc_html__( 'More Button', 'tabor' ),
				'description'         => esc_html__( 'Toggle to display the More block button on the blogroll if you are not using post excerpts.', 'tabor' ),
				'toggled_description' => esc_html__( 'Showing the More block button on the blogroll.', 'tabor' ),
				'section'             => 'tabor_theme_options',
				'active_callback'     => 'tabor_is_blog',
			)
		)
	);

	/**
	 * Posts.
	 */
	$wp_customize->add_setting( 'post_title', array( 'sanitize_callback' => 'esc_html' ) );

	$wp_customize->add_control(
		new ThemeBeans_Title_Control(
			$wp_customize, 'post_title', array(
				'type'    => 'themebeans-title',
				'label'   => esc_html__( 'Post', 'tabor' ),
				'section' => 'tabor_theme_options',
			)
		)
	);

	$wp_customize->add_setting(
		'single_featured_media', array(
			'default'           => tabor_defaults( 'single_featured_media' ),
			'transport'         => 'postMessage',
			'sanitize_callback' => 'tabor_sanitize_checkbox',
		)
	);

	$wp_customize->add_control(
		new ThemeBeans_Toggle_Control(
			$wp_customize, 'single_featured_media', array(
				'type'                => 'themebeans-toggle',
				'label'               => esc_html__( 'Featured Media', 'tabor' ),
				'description'         => esc_html__( 'Toggle to display featured media on singlular pages and posts.', 'tabor' ),
				'toggled_description' => esc_html__( 'Showing featured media on singlular pages and posts.', 'tabor' ),
				'section'             => 'tabor_theme_options',
			)
		)
	);

	$wp_customize->add_setting(
		'selective_sharing', array(
			'default'           => tabor_defaults( 'selective_sharing' ),
			'transport'         => 'postMessage',
			'sanitize_callback' => 'tabor_sanitize_checkbox',
		)
	);

	$wp_customize->add_control(
		new ThemeBeans_Toggle_Control(
			$wp_customize, 'selective_sharing', array(
				'type'                => 'themebeans-toggle',
				'label'               => esc_html__( 'Selective Sharing', 'tabor' ),
				'description'         => esc_html__( 'Toggle to enable select-to-share on singular pages and posts.', 'tabor' ),
				'toggled_description' => esc_html__( 'Select sharing is enabled on singlular pages and posts.', 'tabor' ),
				'section'             => 'tabor_theme_options',
			)
		)
	);

	$wp_customize->add_setting(
		'author_meta', array(
			'default'           => tabor_defaults( 'author_meta' ),
			'transport'         => 'postMessage',
			'sanitize_callback' => 'tabor_sanitize_checkbox',
		)
	);

	$wp_customize->add_control(
		new ThemeBeans_Toggle_Control(
			$wp_customize, 'author_meta', array(
				'type'                => 'themebeans-toggle',
				'label'               => esc_html__( 'Author', 'tabor' ),
				'description'         => esc_html__( 'Toggle to display the author below the title in the metadata section.', 'tabor' ),
				'toggled_description' => esc_html__( 'Showing the author below the title in the metadata section.', 'tabor' ),
				'section'             => 'tabor_theme_options',
			)
		)
	);

	$wp_customize->add_setting(
		'categories', array(
			'default'           => tabor_defaults( 'categories' ),
			'transport'         => 'postMessage',
			'sanitize_callback' => 'tabor_sanitize_checkbox',
		)
	);

	$wp_customize->add_control(
		new ThemeBeans_Toggle_Control(
			$wp_customize, 'categories', array(
				'type'                => 'themebeans-toggle',
				'label'               => esc_html__( 'Categories', 'tabor' ),
				'description'         => esc_html__( 'Toggle to show post categories below the singular post content.', 'tabor' ),
				'toggled_description' => esc_html__( 'Showing post categories below the singular post content.', 'tabor' ),
				'section'             => 'tabor_theme_options',
			)
		)
	);

	$wp_customize->add_setting(
		'tags', array(
			'default'           => tabor_defaults( 'tags' ),
			'transport'         => 'postMessage',
			'sanitize_callback' => 'tabor_sanitize_checkbox',
		)
	);

	$wp_customize->add_control(
		new ThemeBeans_Toggle_Control(
			$wp_customize, 'tags', array(
				'type'                => 'themebeans-toggle',
				'label'               => esc_html__( 'Tags', 'tabor' ),
				'description'         => esc_html__( 'Toggle to show post tags below the singular post content.', 'tabor' ),
				'toggled_description' => esc_html__( 'Showing post tags below the singular post content.', 'tabor' ),
				'section'             => 'tabor_theme_options',
			)
		)
	);

	$wp_customize->add_setting(
		'comments_visibility', array(
			'default'           => tabor_defaults( 'comments_visibility' ),
			'transport'         => 'postMessage',
			'sanitize_callback' => 'tabor_sanitize_checkbox',
		)
	);

	$wp_customize->add_control(
		new ThemeBeans_Toggle_Control(
			$wp_customize, 'comments_visibility', array(
				'type'                => 'themebeans-toggle',
				'label'               => esc_html__( 'Comments Trigger', 'tabor' ),
				'description'         => esc_html__( 'Toggle to show the comments button and enable the show effect.', 'tabor' ),
				'toggled_description' => esc_html__( 'Comments are now visible when the comments button is triggered.', 'tabor' ),
				'section'             => 'tabor_theme_options',
			)
		)
	);

	$wp_customize->add_setting(
		'post_date', array(
			'default'           => tabor_defaults( 'post_date' ),
			'transport'         => 'postMessage',
			'sanitize_callback' => 'tabor_sanitize_select',
		)
	);

	$wp_customize->add_control(
		'post_date', array(
			'type'        => 'select',
			'label'       => esc_html__( 'Date', 'tabor' ),
			'description' => esc_html__( 'Choose to display either the updated or published date on all posts.', 'tabor' ),
			'section'     => 'tabor_theme_options',
			'choices'     => array(
				'none'      => esc_html__( 'None', 'tabor' ),
				'updated'   => esc_html__( 'Updated', 'tabor' ),
				'published' => esc_html__( 'Published', 'tabor' ),
			),
		)
	);

	/**
	 * Social.
	 */
	$wp_customize->add_setting( 'social_title', array( 'sanitize_callback' => 'esc_html' ) );

	$wp_customize->add_control(
		new ThemeBeans_Title_Control(
			$wp_customize, 'social_title', array(
				'type'    => 'themebeans-title',
				'label'   => esc_html__( 'Social', 'tabor' ),
				'section' => 'tabor_theme_options',
			)
		)
	);

	$wp_customize->add_setting(
		'post_bar', array(
			'default'           => tabor_defaults( 'post_bar' ),
			'transport'         => 'postMessage',
			'sanitize_callback' => 'tabor_sanitize_checkbox',
		)
	);

	$wp_customize->add_control(
		new ThemeBeans_Toggle_Control(
			$wp_customize, 'post_bar', array(
				'type'                => 'themebeans-toggle',
				'label'               => esc_html__( 'Engagement Bar', 'tabor' ),
				'description'         => esc_html__( 'Toggle the engagement bar that appears on singular posts.', 'tabor' ),
				'toggled_description' => esc_html__( 'Showing the social engagement bar on singular posts.', 'tabor' ),
				'section'             => 'tabor_theme_options',
			)
		)
	);

	$wp_customize->add_setting(
		'post_bar_style', array(
			'default'           => tabor_defaults( 'post_bar_style' ),
			'transport'         => 'postMessage',
			'sanitize_callback' => 'tabor_sanitize_select',
		)
	);

	$wp_customize->add_control(
		'post_bar_style', array(
			'type'    => 'select',
			'section' => 'tabor_theme_options',
			'choices' => array(
				'drop-in-style-1' => esc_html__( 'Shadow Style', 'tabor' ),
				'drop-in-style-2' => esc_html__( 'Stroke Style', 'tabor' ),
			),
		)
	);

	$wp_customize->add_setting(
		'facebook_share', array(
			'default'           => tabor_defaults( 'facebook_share' ),
			'transport'         => 'postMessage',
			'sanitize_callback' => 'tabor_sanitize_checkbox',
		)
	);

	$wp_customize->add_control(
		new ThemeBeans_Toggle_Control(
			$wp_customize, 'facebook_share', array(
				'type'                => 'themebeans-toggle',
				'label'               => esc_html__( 'Facebook', 'tabor' ),
				'description'         => esc_html__( 'Toggle the Facebook sharing button in the engagement bar.', 'tabor' ),
				'toggled_description' => esc_html__( 'Showing the Facebook sharing button in the engagement bar.', 'tabor' ),
				'section'             => 'tabor_theme_options',
			)
		)
	);

	$wp_customize->add_setting(
		'linkedin_share', array(
			'default'           => tabor_defaults( 'linkedin_share' ),
			'transport'         => 'postMessage',
			'sanitize_callback' => 'tabor_sanitize_checkbox',
		)
	);

	$wp_customize->add_control(
		new ThemeBeans_Toggle_Control(
			$wp_customize, 'linkedin_share', array(
				'type'                => 'themebeans-toggle',
				'label'               => esc_html__( 'LinkedIn', 'tabor' ),
				'description'         => esc_html__( 'Toggle the LinkedIn sharing button in the engagement bar.', 'tabor' ),
				'toggled_description' => esc_html__( 'Showing the LinkedIn sharing button in the engagement bar.', 'tabor' ),
				'section'             => 'tabor_theme_options',
			)
		)
	);

	$wp_customize->add_setting(
		'twitter_share', array(
			'default'           => tabor_defaults( 'twitter_share' ),
			'transport'         => 'postMessage',
			'sanitize_callback' => 'tabor_sanitize_checkbox',
		)
	);

	$wp_customize->add_control(
		new ThemeBeans_Toggle_Control(
			$wp_customize, 'twitter_share', array(
				'type'                => 'themebeans-toggle',
				'label'               => esc_html__( 'Twitter', 'tabor' ),
				'description'         => esc_html__( 'Toggle the Twitter sharing button in the engagement bar.', 'tabor' ),
				'toggled_description' => esc_html__( 'Showing the Twitter sharing button in the engagement bar.', 'tabor' ),
				'section'             => 'tabor_theme_options',
			)
		)
	);

	$wp_customize->add_setting(
		'twitter_via', array(
			'default'           => tabor_defaults( 'twitter_via' ),
			'transport'         => 'postMessage',
			'sanitize_callback' => 'tabor_sanitize_html',
		)
	);

	$wp_customize->add_control(
		'twitter_via', array(
			'type'    => 'text',
			'label'   => esc_html__( '@username:', 'tabor' ),
			'section' => 'tabor_theme_options',
		)
	);

	/**
	 * Colophon.
	 */
	$wp_customize->add_setting( 'colophon_title', array( 'sanitize_callback' => 'esc_html' ) );

	$wp_customize->add_control(
		new ThemeBeans_Title_Control(
			$wp_customize, 'colophon_title', array(
				'type'    => 'themebeans-title',
				'label'   => esc_html__( 'Colophon', 'tabor' ),
				'section' => 'tabor_theme_options',
			)
		)
	);

	$wp_customize->add_setting(
		'theme_info', array(
			'default'           => tabor_defaults( 'theme_info' ),
			'transport'         => 'postMessage',
			'sanitize_callback' => 'tabor_sanitize_checkbox',
		)
	);

	$wp_customize->add_control(
		new ThemeBeans_Toggle_Control(
			$wp_customize, 'theme_info', array(
				'type'                => 'themebeans-toggle',
				'label'               => esc_html__( 'Theme Info', 'tabor' ),
				'description'         => esc_html__( 'Toggle the add the Tabor theme information to the site footer.', 'tabor' ),
				'toggled_description' => esc_html__( 'Showing the Tabor theme information in the site footer.', 'tabor' ),
				'section'             => 'tabor_theme_options',
			)
		)
	);

	$wp_customize->add_setting(
		'copyright_year', array(
			'default'           => tabor_defaults( 'copyright_year' ),
			'transport'         => 'postMessage',
			'sanitize_callback' => 'tabor_sanitize_checkbox',
		)
	);

	$wp_customize->add_control(
		new ThemeBeans_Toggle_Control(
			$wp_customize, 'copyright_year', array(
				'type'                => 'themebeans-toggle',
				'label'               => esc_html__( 'Copyright Year', 'tabor' ),
				'description'         => esc_html__( 'Toggle to show a copyright badge and the current year in the footer.', 'tabor' ),
				'toggled_description' => esc_html__( 'Showing a copyright badge and the current year in the footer.', 'tabor' ),
				'section'             => 'tabor_theme_options',
			)
		)
	);

	$wp_customize->add_setting(
		'copyright_text', array(
			'default'           => tabor_defaults( 'copyright_text' ),
			'transport'         => 'postMessage',
			'sanitize_callback' => 'tabor_sanitize_html',
		)
	);

	$wp_customize->add_control(
		'copyright_text', array(
			'type'        => 'text',
			'label'       => esc_html__( 'Custom Copyright', 'tabor' ),
			'description' => esc_html__( 'Add custom text to display beside the copyright date in the site footer.', 'tabor' ),
			'section'     => 'tabor_theme_options',
		)
	);

	/**
	 * Colors.
	 */
	$wp_customize->add_setting(
		'heading_color', array(
			'default'           => tabor_defaults( 'heading_color' ),
			'sanitize_callback' => 'sanitize_hex_color',
			'transport'         => 'postMessage',
		)
	);

	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize, 'heading_color', array(
				'label'   => esc_html__( 'Heading Color', 'tabor' ),
				'section' => 'colors',
			)
		)
	);

	$wp_customize->add_setting(
		'alt_heading_color', array(
			'default'           => tabor_defaults( 'alt_heading_color' ),
			'sanitize_callback' => 'sanitize_hex_color',
			'transport'         => 'postMessage',
		)
	);

	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize, 'alt_heading_color', array(
				'label'   => esc_html__( 'Alt Heading Color', 'tabor' ),
				'section' => 'colors',
			)
		)
	);

	$wp_customize->add_setting(
		'text_color', array(
			'default'           => tabor_defaults( 'text_color' ),
			'sanitize_callback' => 'sanitize_hex_color',
			'transport'         => 'postMessage',
		)
	);

	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize, 'text_color', array(
				'label'   => esc_html__( 'Text Color', 'tabor' ),
				'section' => 'colors',
			)
		)
	);

	$wp_customize->add_setting(
		'header_icon_color', array(
			'default'           => tabor_defaults( 'header_icon_color' ),
			'sanitize_callback' => 'sanitize_hex_color',
			'transport'         => 'postMessage',
		)
	);

	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize, 'header_icon_color', array(
				'label'   => esc_html__( 'Header Icon Color', 'tabor' ),
				'section' => 'colors',
			)
		)
	);

	$wp_customize->add_setting(
		'nav_color', array(
			'default'           => tabor_defaults( 'nav_color' ),
			'sanitize_callback' => 'sanitize_hex_color',
			'transport'         => 'postMessage',
		)
	);

	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize, 'nav_color', array(
				'label'   => esc_html__( 'Navigation Color', 'tabor' ),
				'section' => 'colors',
			)
		)
	);

	$wp_customize->add_setting(
		'mobile_nav_color', array(
			'default'           => tabor_defaults( 'mobile_nav_color' ),
			'sanitize_callback' => 'sanitize_hex_color',
			'transport'         => 'postMessage',
		)
	);

	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize, 'mobile_nav_color', array(
				'label'   => esc_html__( 'Mobile Navigation Color', 'tabor' ),
				'section' => 'colors',
			)
		)
	);

	$wp_customize->add_setting(
		'footer_bg_color', array(
			'default'           => tabor_defaults( 'footer_bg_color' ),
			'sanitize_callback' => 'sanitize_hex_color',
			'transport'         => 'postMessage',
		)
	);

	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize, 'footer_bg_color', array(
				'label'   => esc_html__( 'Footer Background Color', 'tabor' ),
				'section' => 'colors',
			)
		)
	);

	$wp_customize->add_setting(
		'footer_text_color', array(
			'default'           => tabor_defaults( 'footer_text_color' ),
			'sanitize_callback' => 'sanitize_hex_color',
			'transport'         => 'postMessage',
		)
	);

	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize, 'footer_text_color', array(
				'label'   => esc_html__( 'Footer Text Color', 'tabor' ),
				'section' => 'colors',
			)
		)
	);

	// Register the accent color only if Gutenberg is enabled.
	if ( function_exists( 'register_block_type' ) ) {
		$wp_customize->add_setting(
			'accent_color', array(
				'default'           => tabor_defaults( 'accent_color' ),
				'sanitize_callback' => 'sanitize_hex_color',
				'transport'         => 'postMessage',
			)
		);

		$wp_customize->add_control(
			new WP_Customize_Color_Control(
				$wp_customize, 'accent_color', array(
					'label'       => esc_html__( 'Accent Color', 'tabor' ),
					'description' => esc_html__( 'Add an accent color to use within the editor color palette.', 'tabor' ),
					'section'     => 'colors',
				)
			)
		);
	}

	/**
	 * Adding support for Customize inline editing.
	 *
	 * @link https://github.com/xwp/wp-customize-inline-editing
	 */
	$opt_in_partials = array_filter(
		array(
			$wp_customize->selective_refresh->get_partial( 'blogname' ),
		)
	);
	foreach ( $opt_in_partials as $partial ) {
		$partial->type = 'inline_editable';
	}
}
add_action( 'customize_register', 'tabor_customize_register', 11 );

/**
 * Binds JS handlers to make the Customizer preview reload changes asynchronously.
 */
function tabor_customize_preview_js() {
	wp_enqueue_script( 'tabor-customize-preview', get_theme_file_uri( '/assets/js/admin/customize-preview' . TABOR_ASSET_SUFFIX . '.js' ), array( 'customize-preview' ), '@@pkg.version', true );
}
add_action( 'customize_preview_init', 'tabor_customize_preview_js' );

/**
 * Load dynamic logic for the customizer controls area.
 */
function tabor_customize_controls_js() {
	wp_enqueue_script( 'tabor-customize-controls', get_theme_file_uri( '/assets/js/admin/customize-controls' . TABOR_ASSET_SUFFIX . '.js' ), array( 'customize-controls' ), '@@pkg.version', true );
}
add_action( 'customize_controls_enqueue_scripts', 'tabor_customize_controls_js' );

/**
 * Customizer Events.
 */
function tabor_customize_events_js() {
	wp_enqueue_script( 'tabor-customize-events', get_theme_file_uri( '/assets/js/admin/customize-events' . TABOR_ASSET_SUFFIX . '.js' ), array( 'customize-controls' ), '@@pkg.version', true );
}
add_action( 'customize_controls_enqueue_scripts', 'tabor_customize_events_js' );

/**
 * Binds JS handlers to make the Customizer preview reload changes asynchronously.
 */
function tabor_customize_live_js() {
	wp_enqueue_script( 'tabor-customize-live', get_theme_file_uri( '/assets/js/admin/customize-live' . TABOR_ASSET_SUFFIX . '.js' ), array( 'customize-preview' ), '@@pkg.version', true );
}
add_action( 'customize_preview_init', 'tabor_customize_live_js' );

/**
 * CSS to make the Customizer controls look a bit better.
 */
function tabor_customize_controls_css() {
	wp_enqueue_style( 'tabor-customize-preview', get_theme_file_uri( '/assets/css/customize-controls' . TABOR_ASSET_SUFFIX . '.css' ), '@@pkg.version', true );
}
add_action( 'customize_controls_print_styles', 'tabor_customize_controls_css' );

/**
 * Render the site title for the selective refresh partial.
 *
 * @see tabor_customize_register()
 *
 * @return void
 */
function tabor_customize_partial_blogname() {
	bloginfo( 'name' );
}

/**
 * Render the site tagline for the selective refresh partial.
 *
 * @see tabor_customize_register()
 *
 * @return void
 */
function tabor_customize_partial_blogdescription() {
	bloginfo( 'description' );
}

/**
 * Return if we're previewing the blogroll.
 */
function tabor_is_blog() {
	return ( is_home() );
}

/**
 * Return if we're previewing the front page and it's a static page.
 */
function tabor_is_static_front_page() {
	return ( is_front_page() && ! is_home() );
}
