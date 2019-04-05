/**
 * This file adds some LIVE to the Theme Customizer live preview. To leverage
 * this, set your custom settings to 'postMessage' and then add your handling
 * here. This javascript will grab settings from customizer controls, and
 * then make any necessary changes to the page using jQuery.
 */

( function( $ ) {

	wp.customize( 'blogdescription', function( value ) {
		value.bind( function( to ) {
			$( '.site-description' ).text( to );
		});
	});

	// Header text color.
	wp.customize( 'header_textcolor', function( value ) {
		value.bind( function( to ) {

			if ( 'blank' === to ) {
				$( '.site-branding-text' ).css({
					clip: 'rect(1px, 1px, 1px, 1px)',
					position: 'absolute'
				});
			} else {
				if ( ! to.length ) {
					$( '#tabor-custom-header-styles' ).remove();
				}
				$( '.site-branding-text' ).css({
					clip: 'auto',
					position: 'relative'
				});
			}
		});
	});

	wp.customize( 'accent_color', function( value ) {
		value.bind( function( to ) {
			$( '.has-accent-color' ).css( 'color', to );
			$( '.has-accent-background-color' ).css( 'background-color', to );
			$( '.c-settings .c-switch[aria-checked=true]' ).css( 'background-color', to );
		} );
	} );

	wp.customize( 'background_color', function( value ) {
		value.bind( function( to ) {
			var style, el;

			style = '<style class="background_color">@media (max-width: 599px) { .site-header::after { background: ' + to + '; } }</style>';

			el =  $( '.background_color' );

			if ( el.length ) {
				el.replaceWith( style );
			} else {
				$( 'head' ).append( style );
			}
		} );
	} );

	wp.customize( 'custom_logo', function( value ) {
		value.bind( function( to ) {

			if ( to ) {

				$( 'h1.site-title' ).css({
					clip: 'rect(1px, 1px, 1px, 1px)',
					position: 'absolute'
				});

				$( 'h1.site-title' ).removeClass( 'no-site-logo' );

			} else {

				// Give it a few ms to remove the image before we show the title back.
				setTimeout( function() {
					$( 'h1.site-title' ).css({
						clip: 'auto',
						position: 'relative'
					});

					$( 'h1.site-title' ).removeClass( 'hidden' ).addClass( 'no-site-logo' );
				}, 900 );
			}
		} );
	} );

	wp.customize( 'site_title_and_logo', function( value ) {
		value.bind( function( to ) {

			if ( to ) {

				$( 'h1.site-title' ).css({
					clip: 'auto',
					position: 'relative'
				});

				$( 'h1.site-title' ).removeClass( 'hidden' );

			} else {

				$( 'h1.site-title' ).css({
					clip: 'rect(1px, 1px, 1px, 1px)',
					position: 'absolute'
				});
			}
		} );
	} );





	wp.customize( 'custom_logo_max_width', function( value ) {
		value.bind( function( to ) {
			var style, el;

			style = '<style class="custom_logo_max_width">@media (min-width: 600px) { body .custom-logo-link img.custom-logo { width: ' + to + 'px; } }</style>';

			el =  $( '.custom_logo_max_width' );

			if ( el.length ) {
				el.replaceWith( style );
			} else {
				$( 'head' ).append( style );
			}
		} );
	} );

	wp.customize( 'custom_logo_mobile_max_width', function( value ) {
		value.bind( function( to ) {
			var style, el;

			style = '<style class="custom_logo_mobile_max_width">@media (max-width: 599px) { body .custom-logo-link img.custom-logo { width: ' + to + 'px; } .main-navigation ul:not(.sub-menu) { top: calc( 30px + ' + to + 'px ); padding-top: ' + to + 'px; } .site-header::after { top: calc( 50px + ' + to + 'px ); } }</style>';

			el =  $( '.custom_logo_mobile_max_width' );

			if ( el.length ) {
				el.replaceWith( style );
			} else {
				$( 'head' ).append( style );
			}
		} );
	} );

	wp.customize( 'custom_logo_border_radius', function( value ) {
		value.bind( function( to ) {

			if ( true === to ) {
				$( '#masthead .site-logo' ).removeClass( 'no-border-radius' );

			} else {

				$( '#masthead .site-logo' ).addClass( 'no-border-radius' );
			}
		});
	});

	wp.customize( 'custom_logo_hover_animation', function( value ) {
		value.bind( function( to ) {

			if ( true === to ) {
				$( '#masthead .site-logo' ).removeClass( 'no-animation' );

			} else {

				$( '#masthead .site-logo' ).addClass( 'no-animation' );
			}
		});
	});

	wp.customize( 'invert_night_mode_logo', function( value ) {
		value.bind( function( to ) {

			if ( true === to ) {
				$( '#masthead .site-logo' ).addClass( 'is-inverted-for-night-mode' );

			} else {

				$( '#masthead .site-logo' ).removeClass( 'is-inverted-for-night-mode' );
			}
		});
	});

	wp.customize( 'text_color', function( value ) {
		value.bind( function( to ) {
			$( 'body' ).css( 'color', to );
		} );
	} );

	wp.customize( 'footer_bg_color', function( value ) {
		value.bind( function( to ) {
			$( 'body .widget-area__wrapper' ).css( 'background', to );

			var style, el;

			style = '<style class="footer_bg_color">body #secondary #tucson-optin .tucson-field-submit, body .widget-area__wrapper form input[type=submit], body .widget-area__wrapper form input[type=button] { color: ' + to + ' !important; } }</style>';

			el =  $( '.footer_bg_color' );

			if ( el.length ) {
				el.replaceWith( style );
			} else {
				$( 'head' ).append( style );
			}
		} );
	} );

	wp.customize( 'footer_text_color', function( value ) {
		value.bind( function( to ) {
			$( 'body .widget-area__wrapper, body .widget-area__wrapper h1, body .widget-area__wrapper h2, body .widget-area__wrapper h3, body .widget-area__wrapper h4, body .widget-area__wrapper h5, body .widget-area__wrapper h6' ).css( 'color', to );
			$( 'body .widget-area__wrapper form input:not([type="submit"]), body #secondary #tucson-optin input' ).css( 'color', to );
			$( 'body .widget-area__wrapper form input:not([type="submit"]), body #secondary #tucson-optin input' ).css( 'border-color', to );

			var style, el;

			style = '<style class="footer_text_color">body .widget-area__wrapper form input[type=submit], body .widget-area__wrapper form input[type=button], body #secondary #tucson-optin .tucson-field-submit { background-color: ' + to + ' !important; } body .widget-area__wrapper form input.placeholder, body .widget-area__wrapper form input:-moz-placeholder, body .widget-area__wrapper form input::-moz-placeholder, body .widget-area__wrapper form input:-ms-input-placeholder, body .widget-area__wrapper form input::-webkit-input-placeholder, body #secondary #tucson-optin input:-ms-input-placeholder, body #secondary #tucson-optin input::-webkit-input-placeholder, body #secondary #tucson-optin input::-moz-placeholder, body #secondary #tucson-optin input:-moz-placeholder { color: ' + to + ' !important; }</style>';

			el =  $( '.footer_text_color' );

			if ( el.length ) {
				el.replaceWith( style );
			} else {
				$( 'head' ).append( style );
			}
		} );
	} );

	wp.customize( 'header_icon_color', function( value ) {
		value.bind( function( to ) {

			$( '.search-toggle .icon, .site-header .social-navigation svg, .search-form .search-submit .icon' ).css( 'fill', to );

			$( '.social-navigation ul li a' ).css( 'color', to );

			var style, el;

			style = '<style class="header_icon_color">body .menu-toggle::after, body .menu-toggle::before{ background-color: ' + to + ' !important; } }</style>';

			el =  $( '.header_icon_color' );

			if ( el.length ) {
				el.replaceWith( style );
			} else {
				$( 'head' ).append( style );
			}
		} );
	} );

	wp.customize( 'heading_color', function( value ) {
		value.bind( function( to ) {
			$( 'body #course-body #course-element-title-content, body h1, body h2, body h3, body 4, body h5, body h6, body .h1:not(.gray), body .h2:not(.gray), body .h3:not(.gray), body .h4:not(.gray), body .h5:not(.gray), body .h6:not(.gray), .home:not(.blog) .entry-content h5' ).css( 'color', to );
		} );
	} );

	wp.customize( 'nav_color', function( value ) {
		value.bind( function( to ) {
			$( '.site-header .nav li a' ).css( 'color', to );
			$( '.main-navigation .dropdown-toggle .icon' ).css( 'fill', to );
		} );
	} );

	wp.customize( 'mobile_nav_color', function( value ) {
		value.bind( function( to ) {
			var style, el;

			style = '<style class="mobile_nav_color">@media (max-width: 599px) { body .main-navigation ul:not(.sub-menu) a { color: ' + to + ' !important; } }</style>';

			el =  $( '.mobile_nav_color' );

			if ( el.length ) {
				el.replaceWith( style );
			} else {
				$( 'head' ).append( style );
			}
		} );
	} );

	wp.customize( 'alt_heading_color', function( value ) {
		value.bind( function( to ) {
			$( '.gray, label, blockquote, .logged-in-as, .wp-caption-text, .page-links a span, .comment-metadata a, .bctt-click-to-tweet, .taxonomy-description, .comment-reply-title small, .no-svg .dropdown-toggle .svg-fallback.icon-down' ).css( 'color', to );
		} );
	} );

	wp.customize( 'header_search', function( value ) {
		value.bind( function( to ) {

			if ( true === to ) {

				$( '#search-toggle, #site-search' ).css({
					clip: 'auto',
					position: 'relative'
				});

				$( '#site-search' ).css({
					position: 'fixed'
				});

				$( '#search-toggle, #site-search' ).removeClass( 'hidden' );

			} else {

				$( '#search-toggle, #site-search' ).css({
					clip: 'rect(1px, 1px, 1px, 1px)',
					position: 'absolute'
				});


				// Remove the open class, just in case it's applied.
				$( 'body' ).removeClass( 'site-search-open' );
			}
		});
	});

	wp.customize( 'accessibility_settings', function( value ) {
		value.bind( function( to ) {

			if ( true === to ) {

				$( '#c-settings' ).css({
					clip: 'auto',
					position: 'relative'
				});

				$( '#c-settings' ).removeClass( 'hidden' );

			} else {

				$( '#c-settings' ).css({
					clip: 'rect(1px, 1px, 1px, 1px)',
					position: 'absolute'
				});
			}
		});
	});

	wp.customize( 'blogroll_more_btn', function( value ) {
		value.bind( function( to ) {

			if ( true === to ) {

				$( '.entry-content .more-link' ).css({
					clip: 'auto',
					position: 'relative'
				});

				$( '.entry-content .more-link' ).removeClass( 'hidden' );

			} else {

				$( '.entry-content .more-link' ).css({
					clip: 'rect(1px, 1px, 1px, 1px)',
					position: 'absolute'
				});
			}
		});
	});

	wp.customize( 'accessibility_settings_icon', function( value ) {
		value.bind( function( newval ) {
			$( '.c-settings__toggle .icon .icon' ).attr('class', 'icon');
			$( '.c-settings__toggle .icon .icon' ).addClass( 'icon-'+newval );
			$( '.c-settings__toggle .icon .icon use' ).attr( 'xlink:href' , $( '.c-settings__toggle .icon use').attr( 'xlink:href' ).replace(/#.*$/,'') + '#icon-' + newval );

			$( '.c-settings__toggle .icon' ).attr( 'class', 'icon' );
			$( '.c-settings__toggle .icon' ).addClass( 'icon-'+newval );
			$( '.c-settings__toggle .icon use' ).attr( 'xlink:href' , $( '.c-settings__toggle .icon use' ).attr( 'xlink:href' ).replace(/#.*$/,'') + '#icon-' + newval);
		} );
	} );

	wp.customize( 'comments_visibility', function( value ) {
		value.bind( function( to ) {

			if ( true === to ) {
				$( 'body' ).addClass( 'has-hidden-comments' );

				$( '.entry-footer .flex.justify-start.items-center' ).css({
					clip: 'auto',
					position: 'relative'
				});

				$( '.entry-footer .flex.justify-start.items-center' ).removeClass( 'hidden' );

			} else {
				$( 'body' ).removeClass( 'has-hidden-comments' );

				$( '.entry-footer .flex.justify-start.items-center' ).css({
					clip: 'rect(1px, 1px, 1px, 1px)',
					position: 'absolute'
				});
			}

		} );
	} );

	wp.customize( 'post_bar_style', function( value ) {
		value.bind( function( to ) {

			if ( 'drop-in-style-2' === to ) {
				$( 'body' ).addClass( to );
			} else {
				$( 'body' ).removeClass( 'drop-in-style-2' );
			}
		} );
	} );

	wp.customize( 'selective_sharing', function( value ) {
		value.bind( function( to ) {

			if ( true === to ) {
				$( 'body' ).addClass( 'has-selective-sharing' );
			} else {
				$( 'body' ).removeClass( 'has-selective-sharing' );
			}
		} );
	} );

	wp.customize( 'single_featured_media', function( value ) {
		value.bind( function( to ) {

			if ( true === to ) {

				$( '.entry-media, .entry-video' ).css({
					clip: 'auto',
					position: 'relative'
				});

				$( '.entry-media, .entry-video' ).removeClass( 'hidden' );

			} else {

				$( '.entry-media, .entry-video' ).css({
					clip: 'rect(1px, 1px, 1px, 1px)',
					position: 'absolute'
				});
			}
		});
	});

	wp.customize( 'blogroll_featured_media', function( value ) {
		value.bind( function( to ) {

			if ( true === to ) {

				$( '.entry-media, .entry-video' ).css({
					clip: 'auto',
					position: 'relative'
				});

				$( '.entry-media, .entry-video' ).removeClass( 'hidden' );

			} else {

				$( '.entry-media, .entry-video' ).css({
					clip: 'rect(1px, 1px, 1px, 1px)',
					position: 'absolute'
				});
			}
		});
	});

	wp.customize( 'post_bar', function( value ) {
		value.bind( function( to ) {

			if ( true === to ) {
				$( '.bar' ).removeClass( 'is-hidden' );

			} else {
				$( '.bar' ).addClass( 'is-hidden' );
			}
		});
	});

	wp.customize( 'author_meta', function( value ) {
		value.bind( function( to ) {

			if ( true === to ) {

				$( '.byline' ).css({
					clip: 'auto',
					position: 'relative'
				});

				$( '.byline' ).removeClass( 'hidden' );

			} else {

				$( '.byline' ).css({
					clip: 'rect(1px, 1px, 1px, 1px)',
					position: 'absolute'
				});
			}
		});
	});

	wp.customize( 'categories', function( value ) {
		value.bind( function( to ) {

			if ( true === to ) {

				$( '.cat-links' ).css({
					clip: 'auto',
					position: 'relative'
				});

				$( '.cat-links' ).removeClass( 'hidden' );

			} else {

				$( '.cat-links' ).css({
					clip: 'rect(1px, 1px, 1px, 1px)',
					position: 'absolute'
				});
			}
		});
	});

	wp.customize( 'tags', function( value ) {
		value.bind( function( to ) {

			if ( true === to ) {

				$( '.tags-links' ).css({
					clip: 'auto',
					position: 'relative'
				});

				$( '.tags-links' ).removeClass( 'hidden' );

			} else {

				$( '.tags-links' ).css({
					clip: 'rect(1px, 1px, 1px, 1px)',
					position: 'absolute'
				});
			}
		});
	});

	function jsUcfirst( string ) {
		return string.charAt(0).toUpperCase() + string.slice(1);
	}

	wp.customize( 'post_date', function( value ) {
		value.bind( function( to ) {

			if ( 'published' === to ) {

				$( '.posted-on' ).removeClass( 'hidden' );

				$( '.posted-on span' ).html( jsUcfirst( to ) );

				$( '.posted-on a' ).attr( 'class', 'posted-on--published' );

			} else if ( 'none' === to ) {

				$( '.posted-on' ).attr( 'class', 'hidden' );

			} else {

				$( '.posted-on' ).removeClass( 'hidden' );

				$( '.posted-on span' ).html( jsUcfirst( to ) );

				$( '.posted-on a' ).attr( 'class', 'posted-on--updated' );
			}
		});
	});

	wp.customize( 'twitter_share', function( value ) {
		value.bind( function( to ) {

			if ( true === to ) {

				$( '.share-icon--twitter' ).css({
					clip: 'auto',
					position: 'relative'
				});

				$( '.share-icon--twitter' ).removeClass( 'hidden' );

			} else {

				$( '.share-icon--twitter' ).css({
					clip: 'rect(1px, 1px, 1px, 1px)',
					position: 'absolute'
				});
			}
		});
	});

	wp.customize( 'facebook_share', function( value ) {
		value.bind( function( to ) {

			if ( true === to ) {

				$( '.share-icon--facebook' ).css({
					clip: 'auto',
					position: 'relative'
				});

				$( '.share-icon--facebook' ).removeClass( 'hidden' );

			} else {

				$( '.share-icon--facebook' ).css({
					clip: 'rect(1px, 1px, 1px, 1px)',
					position: 'absolute'
				});
			}
		});
	});

	wp.customize( 'linkedin_share', function( value ) {
		value.bind( function( to ) {

			if ( true === to ) {

				$( '.share-icon--linkedin' ).css({
					clip: 'auto',
					position: 'relative'
				});

				$( '.share-icon--linkedin' ).removeClass( 'hidden' );

			} else {

				$( '.share-icon--linkedin' ).css({
					clip: 'rect(1px, 1px, 1px, 1px)',
					position: 'absolute'
				});
			}
		});
	});

	wp.customize( 'copyright_year', function( value ) {
		value.bind( function( to ) {

			if ( true === to ) {

				$( '.copyright-year' ).css({
					clip: 'auto',
					position: 'relative'
				});

				$( '.copyright-year' ).removeClass( 'hidden' );

			} else {

				$( '.copyright-year' ).css({
					clip: 'rect(1px, 1px, 1px, 1px)',
					position: 'absolute'
				});
			}
		});
	});

	wp.customize( 'theme_info', function( value ) {
		value.bind( function( to ) {

			if ( true === to ) {

				$( '.site-theme' ).css({
					clip: 'auto',
					position: 'relative'
				});

				$( '.site-theme' ).removeClass( 'hidden' );

			} else {

				$( '.site-theme' ).css({
					clip: 'rect(1px, 1px, 1px, 1px)',
					position: 'absolute'
				});
			}
		});
	});

	wp.customize( 'copyright_text', function( value ) {
		value.bind( function( to ) {
			$( '.copyright-text' ).html( to );
		} );
	} );

} )( jQuery );
