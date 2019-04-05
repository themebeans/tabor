/**
 * Customizer Events Communicator.
 */
( function ( exports, $ ) {
	"use strict";

	var api = wp.customize, OldPreviewer;

	//  Customizer Previewer
	api.myCustomizerPreviewer = {

		init: function () {

			var
			self = this;

			// Function used for contextually aware Customizer options.
			function bind_control_visibility_event( event, focus_control ) {
				api.myCustomizerPreviewer.preview.bind( event, function() {
					wp.customize.control( focus_control ).focus();
				} );
			}

			bind_control_visibility_event( 'tabor-edit-engagement-bar', 'post_bar' );
			bind_control_visibility_event( 'tabor-edit-footer-colors', 'footer_bg_color' );

			// Add widget to the widget area.
			api.myCustomizerPreviewer.preview.bind( 'tabor-add-footer-widget', function() {
				var
				primary_sidebar_section = wp.customize.section( 'sidebar-widgets-sidebar-1' ),
				primary_sidebar_control = api.control( 'sidebars_widgets[sidebar-1]' );

					// First we'll check to see if the Customizer Sidebar is open
					if ( $( '.wp-full-overlay' ).hasClass( 'collapsed' ) ) {
						// Trigger a click event on the collapse sidebar element
						$( '.collapse-sidebar' ).trigger( 'click' );
					}

				// Then we'll check to see if the Primary Sidebar section is open
				if ( ! primary_sidebar_section.expanded() ) {
					// Expanding the Primary Sidebar section will also open the Widgets Panel
					primary_sidebar_section.expand( {
						duration: 0,
						completeCallback: function() {
							api.Widgets.availableWidgetsPanel.open( primary_sidebar_control );
						}
					} );
				}
				// Otherwise, if the Add a Widget Panel is collapsed, open it
				else if ( ! $( 'body' ).hasClass( 'adding-widget' ) ) {
					// Pass the control to the available widgets panel to give it context
					api.Widgets.availableWidgetsPanel.open( primary_sidebar_control );
				}
			} );
		}
	};

	/**
	 * Capture the instance of the Preview since it is private.
	 */
	OldPreviewer = api.Previewer;
	api.Previewer = OldPreviewer.extend( {
		initialize: function( params, options ) {

			// Store a reference to the Previewer
			api.myCustomizerPreviewer.preview = this;

			// Call the old Previewer's initialize function
			OldPreviewer.prototype.initialize.call( this, params, options );
		}
	} );

	$( function() {
		// Initialize our Previewer
		api.myCustomizerPreviewer.init();
	} );

} )( wp, jQuery );
