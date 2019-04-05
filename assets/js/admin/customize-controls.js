/**
 * Scripts within the customizer controls window.
 *
 * Contextually shows the color hue control and informs the preview
 * when users open or close the front page sections section.
 */

( function() {

	wp.customize.bind( 'ready', function() {

		/**
		 * Function to hide/show Customizer options, based on another control.
		 *
		 * Parent option, Affected Control, Value which affects the control.
		 */
		function customizer_option_display( parent_setting, affected_control, value, speed ) {
			wp.customize( parent_setting, function( setting ) {
				wp.customize.control( affected_control, function( control ) {
					var visibility = function() {
						if ( value === setting.get() ) {
							control.container.slideDown( speed );
						} else {
							control.container.slideUp( speed );
						}
					};

					visibility();
					setting.bind( visibility );
				});
			});
		}

		/**
		 * Function to hide/show Customizer options, based on another control.
		 *
		 * Parent option, Affected Control, Value which affects the control.
		 */
		function customizer_image_option_display( parent_setting, affected_control, speed ) {
			wp.customize( parent_setting, function( setting ) {
				wp.customize.control( affected_control, function( control ) {
					var visibility = function() {
						if ( setting.get() && 'none' !== setting.get() && '0' !== setting.get() ) {
							control.container.slideDown( speed );
						} else {
							control.container.slideUp( speed );
						}
					};

					visibility();
					setting.bind( visibility );
				});
			});
		}

		// Only show the Accessibility Settings Icon selector, if Accessibility Settings is enabled.
		customizer_option_display( 'accessibility_settings', 'accessibility_settings_icon', true, 100 );

		// Only show the Post Bar Style selector, if the Post Bar is enabled.
		customizer_option_display( 'post_bar', 'post_bar_style', true, 100 );

		// Only show the Social options, if the Post Bar is enabled.
		customizer_option_display( 'post_bar', 'facebook_share', true, 100 );
		customizer_option_display( 'post_bar', 'twitter_share', true, 100);
		customizer_option_display( 'post_bar', 'linkedin_share', true, 100 );
		customizer_option_display( 'post_bar', 'twitter_via', true, 100);
		customizer_option_display( 'twitter_share', 'twitter_via', true, 100);

		// Only show the Read More Button option, if the Excerpt is disabled.
		customizer_option_display( 'blogroll_excerpt', 'blogroll_more_btn', false, 100 );

		// Only show the following options, if a logo is uploaded.
		customizer_image_option_display( 'custom_logo', 'custom_logo_max_width', 100 );
		customizer_image_option_display( 'custom_logo', 'custom_logo_mobile_max_width', 100 );
		customizer_image_option_display( 'custom_logo', 'custom_logo_border_radius', 100 );
		customizer_image_option_display( 'custom_logo', 'custom_logo_hover_animation', 100 );
		customizer_image_option_display( 'custom_logo', 'invert_night_mode_logo', 100 );
		customizer_image_option_display( 'custom_logo', 'site_title_and_logo', 100 );
	});

} )( jQuery );