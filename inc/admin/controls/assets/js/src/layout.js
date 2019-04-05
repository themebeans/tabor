( function( $, api ) {

	api.controlConstructor['themebeans-layout'] = api.Control.extend( {

		ready: function() {
			var control = this;

			this.container.on( 'change', 'input:radio', function() {
				control.setting.set( $( this ).val() );
			} );

			this.container.on( 'click', '.layout-switcher', function(e) {

				var wrapper = $( this ).next( $( '.layout-switcher__wrapper' ) );

				e.preventDefault();

				wrapper.toggleClass( 'open' );

				if ( $( this ).text() === themebeansLocalization.open ) {
					$( this ).text( themebeansLocalization.close );
				} else {
					$( this ).text( themebeansLocalization.open );
				}
			} );
		}
	} );

} )( jQuery, wp.customize );
