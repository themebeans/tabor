/**
 * Theme javascript functions file.
 *
 */

( function( $ ) {
	"use strict";

	var
	body			= $( 'body' ),
	active	 		= ( 'js--active' ),
	open	 		= ( 'nav-open' ),
	commentsOpen		= ( 'comments-open' ),
	leaving	 		= ( 'js--leaving' ),
	finished		= ( 'nav-finished' ),
	comments 		= $( '#comments' ),
	commentsTrigger 	= $( '#comments-trigger' ),
	searchToggle 		= $( '#search-toggle' ),
	searchOverlay 		= $( '#site-search-overlay' ),
	searchOpen		= ( 'site-search-open' ),
	menuTop 		= 0;

	/**
	 * Removes "no-js" and adds "js" classes to the body tag.
	 */
	(function(html){html.className = html.className.replace(/\bno-js\b/,'js');})(document.documentElement);

	/**
	 * Test if inline SVGs are supported.
	 * @link https://github.com/Modernizr/Modernizr/
	 */
	function supportsInlineSVG() {
		var div = document.createElement( 'div' );
		div.innerHTML = '<svg/>';
		return 'http://www.w3.org/2000/svg' === ( 'undefined' !== typeof SVGRect && div.firstChild && div.firstChild.namespaceURI );
	}

	/**
	 * Lazy loading.
	 */
	function lazyLoad() {
		var myLazyLoad = new LazyLoad( {
			callback_set: function (element) {
				$( element ).parent( '.intrinsic' ).addClass( 'lazyload--finished' );

			},
		});
	}
	lazyLoad();

	/**
	 * Share This.
	 */
	function selectiveSharing() {
		var shareThis = window.ShareThis;
		var twitterSharer = window.ShareThisViaTwitter;
		var facebookSharer = window.ShareThisViaFacebook;
		var emailSharer = window.ShareThisViaEmail;
		var speakerSharer = window.ShareThisViaSpeakers;

		var selectionShare = shareThis({
			selector: '.has-selective-sharing .entry-content',
			sharers: [ twitterSharer, facebookSharer, speakerSharer ]
		});

		if ( ! window.matchMedia || ! window.matchMedia("(pointer: coarse)").matches) {
			selectionShare.init();
		}
	}
	selectiveSharing();

	/**
	 * Home typing animation.
	 */
	function typed_shortcode() {

		var typed_id = document.getElementById( 'animated-headline' );

		if ( typed_id ) {
			var typed = new Typed( '#animated-headline', {
				stringsElement: '.animated-headline--strings',
				typeSpeed: 70
			});
		}
	}

	/**
	 * Dropin header.
	 */
	function headroom() {
		if ( body.is( '.single, .blog, .archive, .search' ) ) {
			$(".drop-in").headroom( {
				"offset": 60,
				"tolerance": 5,
				classes : {
					// when element is initialised
					initial : "drop-in--js",
					// when scrolling up
					pinned : "drop-in--pinned",
					// when scrolling down
					unpinned : "drop-in--unpinned",
					// when above offset
					top : "drop-in--top",
					// when below offset
					notTop : "drop-in--not-top"
				},
				onPin : function() {
					body.addClass( 'header-is-sticky' );
				},
				onTop : function() {
					body.removeClass( 'header-is-sticky' );
				},
			});
		}
	}
	headroom();

	/* Document Ready */
	$( document ).ready( function () {

		supportsInlineSVG();

		typed_shortcode();

		$( '.nav-previous' ).find( 'a' ).attr( 'rel', 'prev' );

		if ( true === supportsInlineSVG() ) {
			document.documentElement.className = document.documentElement.className.replace( /(\s*)no-svg(\s*)/, '$1svg$2' );
		}

	 	/* Search */
		searchToggle.on( 'click', function( e ) {
			e.preventDefault();

			if( body.hasClass( searchOpen ) ) {
				body.removeClass( searchOpen );
			} else {
				body.addClass( searchOpen );
				$( '#site-search .search-field' ).focus();
			}
		});

		/* Search overlay */
		searchOverlay.on( 'click', function( e ) {
			e.preventDefault();
			body.removeClass( searchOpen );
		});

		/* Comments */
		if ( commentsTrigger.length ) {

		 	if ( $( 'body' ).hasClass( 'admin-bar' ) ) {
				menuTop -= 32;
			}

			commentsTrigger.on( 'click', function( e ) {
				e.preventDefault();

				if( body.hasClass( commentsOpen ) ) {
					body.removeClass( commentsOpen );
				} else {
					body.addClass( commentsOpen );
				}
			});
		}
	});

	// Call LazyLoad after clicking JetPack's infnite loading button.
	$( document.body ).on( 'post-load', function () {
       		lazyLoad();
   	} );

   	// Runs when auto-post-load is triggered.
	$( document.body ).on( 'alnp-post-loaded', function( e, post_title, post_url, post_ID, post_count ) {
		$( '.nav-previous' ).find( 'a' ).attr( 'rel', 'prev' );
       		$( '.entry-footer' ).addClass( 'alnp-post-loaded' );
       		lazyLoad();
	} );

} )( jQuery );

! function(e, t, n) {

		t.addEventListener( 'DOMContentLoaded', function() {

			function i(e, i) {
				var r = arguments.length > 2 && arguments[2] !== n ? arguments[2] : 'click';
				if (e && i) {
					var c = t.querySelectorAll(e);
					c && c.forEach(function(e) {
						e.addEventListener(r, function() {
							var e = "true" === this.getAttribute(i);
							this.setAttribute(i, String(!e))
						})
					})
				}
			}

			function r(e, t) {

				var i = arguments.length > 2 && arguments[2] !== n ? arguments[2] : 'toggle';

				if (e && t) {
					var r = t.querySelectorAll( 'button' ),
						c = void 0;
					if ( c = "open" !== i && ("close" === i || "true" === e.getAttribute( 'aria-expanded' )), e.setAttribute( 'aria-expanded', String(!c)), t.setAttribute( 'aria-hidden', String(c) ), r) {
						var o = c ? "-1" : "0";
						r.forEach(function(e) {
							e.setAttribute( 'tabindex', o)
						})
					}
				}
			}

			function c( e, n ) {
				! function( e, n ) {
					var i = t.querySelector(e);
					if ( i ) {
						var r = localStorage.getItem(n);
						r && i.setAttribute("aria-checked", r)
					}
				}( e, n ), function(e, n, i) {
					var r = t.querySelector(e);
					r && r.addEventListener("click", function() {
						var e = this.getAttribute( 'aria-checked' ),
							r = i || e;
						"true" === e ? t.documentElement.classList.add(n) : t.documentElement.classList.remove(n), localStorage.setItem(n, r)
					})
				}( e, n )
			}




			i("[aria-pressed]", "aria-pressed"), i('[aria-checked][role="switch"]', "aria-checked");

			// var elementExists = document.getElementById( '#c-settings ' );

			var settings = t.querySelector( "#c-settings" );

			if ( settings ) {

				var o = t.querySelector( "#settings-toggle" ),
					a = t.querySelector( "#settings" );
				o && a && (o.addEventListener( "click", function( e ) {
					e.stopPropagation(), r( o, a )
				}), t.addEventListener("keydown", function( e ) {
					27 === e.keyCode && r( o, a, "close" )
				}), t.addEventListener("click", function() {
					r(o, a, "close")
				}), a.addEventListener("click", function (e ) {
					e.stopPropagation()

					t.documentElement.classList.add( 'changing')

					setTimeout(function() {
						t.documentElement.classList.remove( 'changing')
					}, 25)


				})), c( '.c-settings__switch--night-mode', 'night-mode' );

				var font_sizes = ['normal', 'large', 'larger', 'largest'];

				t.querySelector(".c-settings__text-size").addEventListener("click", function(e) {

					e.preventDefault(), function() {

						var e = localStorage.getItem("font-size") || font_sizes[0];

						!function(e) {

							font_sizes.forEach(function(e) {

								t.documentElement.classList.add( 'changing')

								setTimeout(function() {
									t.documentElement.classList.remove( 'changing')
								}, 25)

								t.documentElement.classList.remove( 'font-size--' + e)

							}), t.documentElement.classList.add( 'font-size--' + font_sizes[e]), localStorage.setItem( 'font-size', font_sizes[e])

						}(font_sizes.indexOf(e) < font_sizes.length - 1 ? font_sizes.indexOf(e) + 1 : 0)
					}()
				})

			}
		})

}(window, document);
