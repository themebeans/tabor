/**
 * Theme navigation file.
 *
 * Contains handlers for the site's navigation.
 */

(function( $ ) {
	var masthead, menuToggle, siteNavContain, siteNavigation;

	function initMainNavigation( container ) {

		// Add dropdown toggle that displays child menu items.
		var dropdownToggle = $( '<button />', { 'class': 'dropdown-toggle', 'aria-expanded': false })
			.append( taborScreenReaderText.icon )
			.append( $( '<span />', { 'class': 'screen-reader-text', text: taborScreenReaderText.expand }) );

		container.find( '.menu-item-has-children > a, .page_item_has_children > a' ).after( dropdownToggle );

		// Set the active submenu dropdown toggle button initial state.
		container.find( '.current-menu-ancestor > button' )
			.addClass( 'toggled-on' )
			.attr( 'aria-expanded', 'true' )
			.find( '.screen-reader-text' )
			.text( taborScreenReaderText.collapse );

		// Set the active submenu initial state.
		container.find( '.current-menu-ancestor > .sub-menu' ).addClass( 'toggled-on' );

		container.find( '.dropdown-toggle' ).click( function( e ) {
			var _this = $( this ),
				screenReaderSpan = _this.find( '.screen-reader-text' );

			e.preventDefault();
			_this.toggleClass( 'toggled-on' );
			_this.next( '.children, .sub-menu' ).toggleClass( 'toggled-on' );

			_this.attr( 'aria-expanded', _this.attr( 'aria-expanded' ) === 'false' ? 'true' : 'false' );

			screenReaderSpan.text( screenReaderSpan.text() === taborScreenReaderText.expand ? taborScreenReaderText.collapse : taborScreenReaderText.expand );
		});
	}

	initMainNavigation( $( '.main-navigation' ) );

	body       	= $( 'body' );
	masthead       = $( '#masthead' );
	menuToggle     = masthead.find( '.menu-toggle' );
	siteNavContain = masthead.find( '.main-navigation' );
	siteNavigation = masthead.find( '.main-navigation > div > ul' );
	listItems      = masthead.find( '.main-navigation li' );
	blurElements    = $('.site-content, .site-footer'),
	unblur 		= ('unblur'),

	// Enable menuToggle.
	(function() {

		// Return early if menuToggle is missing.
		if ( ! menuToggle.length ) {
			return;
		}

		// Add an initial value for the attribute.
		menuToggle.attr( 'aria-expanded', 'false' );

		menuToggle.on( 'click.tabor', function() {

			siteNavContain.toggleClass( 'nav-enabled' );

			siteNavContain.toggleClass( 'toggled-on' );

			body.toggleClass( 'nav-open' );

			setTimeout( function() {
				listItems.each( function( i, el ) {
					setTimeout( function() {
						$(el).addClass( 'animate-in' );
					}, i * 100);
				});
			}, 100);

			$( this ).attr( 'aria-expanded', siteNavContain.hasClass( 'toggled-on' ) );

			if ( ! body.hasClass( 'nav-open' ) ) {

				blurElements.addClass( unblur );

				setTimeout(function() {
					blurElements.removeClass( unblur );
					listItems.removeClass( 'animate-in' );
				}, 500);

				listItems.removeClass( 'animate-in' );
			}

		});

	})();

	// Fix sub-menus for touch devices and better focus for hidden submenu items for accessibility.
	(function() {

		if ( ! siteNavigation.length || ! siteNavigation.children().length ) {
			return;
		}

		// Toggle `focus` class to allow submenu access on tablets.
		function toggleFocusClassTouchScreen() {
			if ( 'none' === $( '.menu-toggle' ).css( 'display' ) ) {

				$( document.body ).on( 'touchstart.tabor', function( e ) {
					if ( ! $( e.target ).closest( '.main-navigation li' ).length ) {
						$( '.main-navigation li' ).removeClass( 'focus' );
					}
				});

				siteNavigation.find( '.menu-item-has-children > a, .page_item_has_children > a' )
					.on( 'touchstart.tabor', function( e ) {
						var el = $( this ).parent( 'li' );

						if ( ! el.hasClass( 'focus' ) ) {
							e.preventDefault();
							el.toggleClass( 'focus' );
							el.siblings( '.focus' ).removeClass( 'focus' );
						}
					});

			} else {
				siteNavigation.find( '.menu-item-has-children > a, .page_item_has_children > a' ).unbind( 'touchstart.tabor' );
			}
		}

		if ( 'ontouchstart' in window ) {
			$( window ).on( 'resize.tabor', toggleFocusClassTouchScreen );
			toggleFocusClassTouchScreen();
		}

		siteNavigation.find( 'a' ).on( 'focus.tabor blur.tabor', function() {
			$( this ).parents( '.menu-item, .page_item' ).toggleClass( 'focus' );
		});
	})();
})( jQuery );
