<?php
/**
 * Customizer defaults
 *
 * @package     Tabor
 * @link        https://themebeans.com/themes/tabor
 */

/**
 * Get the default option for Tabor's Customizer settings.
 *
 * @param  string|string $name Option key name to get.
 * @return mixin
 */
function tabor_defaults( $name ) {
	static $defaults;

	if ( ! $defaults ) {
		$defaults = apply_filters(
			'tabor_defaults', array(

				// Identity.
				'custom_logo_max_width'        => 50,
				'custom_logo_mobile_max_width' => 50,
				'custom_logo_border_radius'    => true,
				'custom_logo_hover_animation'  => true,
				'invert_night_mode_logo'       => false,
				'site_title_and_logo'          => false,

				// Colors.
				'accent_color'                 => '#05897C',
				'heading_color'                => '#242424',
				'alt_heading_color'            => '#535353',
				'text_color'                   => '#242424',
				'header_icon_color'            => '#242424',
				'nav_color'                    => '#535353',
				'mobile_nav_color'             => '#242424',
				'footer_bg_color'              => '#f5f5f5',
				'footer_text_color'            => '#242424',

				// Search.
				'header_search'                => true,
				'accessibility_settings'       => true,
				'accessibility_settings_icon'  => 'settings',

				// Sharing.
				'facebook_share'               => false,
				'twitter_share'                => true,
				'linkedin_share'               => false,
				'twitter_via'                  => '',

				// Blog.
				'blogroll_excerpt'             => false,
				'blogroll_featured_media'      => true,
				'single_featured_media'        => true,
				'selective_sharing'            => true,
				'blogroll_more_btn'            => false,
				'post_bar'                     => true,
				'categories'                   => true,
				'tags'                         => true,
				'post_date'                    => 'updated',
				'post_bar_style'               => 'style-1',
				'author_meta'                  => false,
				'comments_visibility'          => true,

				// Site Info.
				'copyright_year'               => true,
				'theme_info'                   => true,
				'copyright_text'               => 'Rich Tabor',

				// Typography.
				'heading_font'                 => 'Default',
				'body_font'                    => 'Default',
				'typekit_id'                   => '',
				'typekit_font_1'               => '',
				'typekit_font_2'               => '',
			)
		);
	}

	return isset( $defaults[ $name ] ) ? $defaults[ $name ] : null;
}
