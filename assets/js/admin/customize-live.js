/**
 * Customizer Live Events.
 */
( function ( wp, $ ) {
	"use strict";

	// Bail if the Customizer isn't initialized
	if ( ! wp || ! wp.customize ) {
		return;
	}

	var api = wp.customize, OldPreview;

	// Custom Customizer Preview class (attached to the Customize API)
	api.myCustomizerPreview = {
		// Init
		init: function () {
			var self = this;

			// When the previewer is active, the "active" event has been triggered (on load)
			this.preview.bind( 'active', function() {

				var
				$engagement_bar = $( '#engagement-bar .container'),
				$footer = $( '#secondary .widget-area__wrapper'),
				$document  = $( document );

				$engagement_bar.append( '<span class="customize-partial-edit-shortcut"><button class="customize-partial-edit-shortcut-button tabor-designer-event-button" data-customizer-event="tabor-edit-engagement-bar"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M13.89 3.39l2.71 2.72c.46.46.42 1.24.03 1.64l-8.01 8.02-5.56 1.16 1.16-5.58s7.6-7.63 7.99-8.03c.39-.39 1.22-.39 1.68.07zm-2.73 2.79l-5.59 5.61 1.11 1.11 5.54-5.65zm-2.97 8.23l5.58-5.6-1.07-1.08-5.59 5.6z"></path></svg></button></span>' );
				$footer.append( '<span class="customize-partial-edit-shortcut customize-partial-edit-shortcut--footer-colors"><button class="customize-partial-edit-shortcut-button tabor-designer-event-button" data-customizer-event="tabor-edit-footer-colors"></button></span>' );
				$footer.append( '<button class="tabor-designer-event-button themebeans-customizer-add-widget-line" data-customizer-event="tabor-add-footer-widget"></button>' );

				// Listen for events on the new previewer buttons
				$document.on( 'touch click', '.tabor-designer-event-button', function( e ) {
					var $this = $( this );

					// Send the event that we've specified on the HTML5 data attribute ('data-customizer-event') to the Customizer
					self.preview.send( $this.attr( 'data-customizer-event' ) );
				} );

			} );
		}
	};

	/**
	 * Capture the instance of the Preview since it is private (this has changed in WordPress 4.0)
	 */
	OldPreview = api.Preview;
	api.Preview = OldPreview.extend( {
		initialize: function( params, options ) {
			// Store a reference to the Preview
			api.myCustomizerPreview.preview = this;

			// Call the old Preview's initialize function
			OldPreview.prototype.initialize.call( this, params, options );
		}
	} );

	$( function () {
		// Initialize our Preview
		api.myCustomizerPreview.init();
	} );

} )( window.wp, jQuery );
