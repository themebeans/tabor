/* global jQuery, themebeans_license_control, ajaxurl, wp */

( function ( $ ) {

	$( document ).ready( function ( $ ) {

		var
		activation_button 	= $( '#themebeans-activate-license' ),
		deactivation_button 	= $( '#themebeans-deactivate-license' ),
		valid 			= ( 'is-valid' ),
		not_valid 		= ( 'is-not-valid' );

		// Removes the error class from the license input field, if necessary.
		$( '#theme-license-key' ).blur( function( ) {
			val = $( this ).val();
			if ( val == '') {
				$( this ).removeClass( not_valid );
			}
		});

		activation_button.on( 'click', function ( e ) {

			// Prevent the button from refreshing.
			e.preventDefault();

			// Show the spinner.
			$( '#theme-license-form .spinner' ).addClass( 'visible' );

			// Disable the button so that the request won't be duplicated accidently.
			$( this ).attr( 'disabled', true );

			// Ensure the key is not already invalid.
			$( '#theme-license-key' ).removeClass( not_valid );

			// License activation data.
			var activation_data = {
				type: 'post',
				action: 'activate_license',
				nonce: themebeans_license_control.nonce.activate,
				wp_customize: 'on',
				key: $( '#theme-license-key' ).val(),
			};

			// License activation AJAX request.
			$.post( themebeans_license_control.ajaxurl, activation_data, function ( r ) {

				console.log( r.error );

				// If the request has been performed.
				if ( typeof r.done !== 'undefined' ) {

					// Save the current customizer settings.
					wp.customize.state( 'saved' ).set( true );

					$( '#theme-license-form .spinner' ).removeClass( 'visible' );

					// Remove the disabled attribute.
					activation_button.attr( 'disabled', false );

					// Check for validity.
					if ( 'valid' === r.status ) {
						// Swap the buttons and remove the disabled attribute from the deactivate button.
						deactivation_button.addClass( valid ).removeClass( not_valid );
						activation_button.addClass( valid ).attr( 'disabled', false );

						// Show the license info, as the license is now activated.
						$( '#theme-license-info' ).addClass( valid ).removeClass( not_valid );

						$( '#theme-license-error' ).html();

						$( '#theme-license-error' ).addClass( valid );
					} else {
						$( '#theme-license-key' ).addClass( not_valid );
						$( '#theme-license-key' ).focus();
						wp.customize.control( 'themebeans_license[key]' ).setting.set( '' );


						$( '#theme-license-error' ).html( r.error );
					}

					// Append license info.
					$( '#theme-license-status' ).html( r.status );

					// Log the data, for debugging purposes.
					console.log( activation_data );
				}

			});

		});

		deactivation_button.on( 'click', function (e) {

			// Prevent the button from refreshing.
			e.preventDefault();

			// Show the spinner.
			$( '#theme-license-form .spinner' ).addClass( 'visible' );

			// Disable the button so that the request won't be duplicated accidently.
			$( this ).attr( 'disabled', true );

			// License deactivation data.
			var deactivation_data = {
				type: 'post',
				action: 'deactivate_license',
				nonce: themebeans_license_control.nonce.deactivate,
				wp_customize: 'on',
			};

			// License deactivation AJAX request.
			$.post( themebeans_license_control.ajaxurl, deactivation_data, function ( r ) {

				console.log( r.error );

				// If the request has been performed.
				if ( typeof r.done !== 'undefined' ) {

					// Save the current customizer settings.
					wp.customize.state( 'saved' ).set( true );

					// Remove the spinner.
					$( '#theme-license-form .spinner' ).removeClass( 'visible' );

					// Swap the buttons and remove the disabled attribute from the deactivate button.
					activation_button.removeClass( valid );
					deactivation_button.removeClass( valid ).addClass( not_valid ).attr( 'disabled', false );

					// Hide the license info, as the license is now deactivated.
					$( '#theme-license-info' ).removeClass( valid ).addClass( not_valid );

					// Empty the license key input field.
					wp.customize.control( 'themebeans_license[key]' ).setting.set( '' );

					// Log the data, for debugging purposes.
					console.log( deactivation_data );
				}

			});

		});

	});

} ) ( jQuery );
