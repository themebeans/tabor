( function( $, api ) {

	api.controlConstructor['themebeans-range'] = api.Control.extend( {

		ready: function() {
			var control = this;

			this.container.on( 'change', 'input[data-input-type="range"]', function() {
				value = $( this ).val();
				$( this ).prev( '.themebeans-range__value' ).find( 'span' ).html( value );
				control.setting.set( value );
			} );

			$( '.themebeans-range__reset' ).on( 'click', function () {
				var
				input        = $( this ).prev( $( 'input[data-input-type="range"]' ) ),
				defaultValue = input.data( 'default-value' );

				input.val( defaultValue );

				var value = input.val();
				input.prev( '.themebeans-range__value' ).find( 'span' ).html( value );
				input.change();
			});
		}
	} );

} )( jQuery, wp.customize );
