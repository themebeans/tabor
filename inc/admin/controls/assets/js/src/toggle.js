( function( $, api ) {

	api.controlConstructor['themebeans-toggle'] = api.Control.extend( {

		ready: function() {
			var control = this;

			this.container.on( 'change', 'input:checkbox', function() {
				value = this.checked ? true : false;
				control.setting.set( value );
				control.container.find('.components-form-toggle').toggleClass('is-checked');

				if (this.checked) {
					control.container.find('.components-form-toggle__off').remove();
					control.container.find('.components-form-toggle').append('<svg class="components-form-toggle__on" width="2" height="6" aria-hidden="true" role="img" focusable="false" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 2 6"><path d="M0 0h2v6H0z"></path></svg>');
					control.container.find( '.components-base-control__help--has-toggled-description' ).find( '.toggle--on' ).removeClass( 'hidden' );
					control.container.find( '.components-base-control__help--has-toggled-description' ).find( '.toggle--off' ).addClass( 'hidden' );
				}
				else {
					control.container.find('.components-form-toggle__on').remove();
					control.container.find('.components-form-toggle').append('<svg class="components-form-toggle__off" width="6" height="6" aria-hidden="true" role="img" focusable="false" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 6 6"><path d="M3 1.5c.8 0 1.5.7 1.5 1.5S3.8 4.5 3 4.5 1.5 3.8 1.5 3 2.2 1.5 3 1.5M3 0C1.3 0 0 1.3 0 3s1.3 3 3 3 3-1.3 3-3-1.3-3-3-3z"></path></svg>');
					control.container.find( '.components-base-control__help--has-toggled-description' ).find( '.toggle--on' ).addClass( 'hidden' );
					control.container.find( '.components-base-control__help--has-toggled-description' ).find( '.toggle--off' ).removeClass( 'hidden' );
				}
			});
		}
	} );

} )( jQuery, wp.customize );