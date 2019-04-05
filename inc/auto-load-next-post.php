<?php
/**
 * Auto Load Next Post ompatibility File
 * See https://wordpress.org/plugins/auto-load-next-post/
 *
 * @package     Tabor
 * @link        https://themebeans.com/themes/tabor
 */

if ( ! function_exists( 'tabor_alnp_setup' ) ) :
	/**
	 * Add Auto Load Next Post support.
	 */
	function tabor_alnp_setup() {
		add_theme_support( 'auto-load-next-post' );
	}
endif;
add_action( 'after_setup_theme', 'tabor_alnp_setup' );

/**
 * Filter the location of the auto load next post template.
 */
function tabor_alnp_template_location() {
	return '/components/post/';
}
add_filter( 'alnp_template_location', 'tabor_alnp_template_location' );

/**
 * Modify the post divider with a little more pizazz.
 */
function tabor_alnp_post_divider() {
	?>
	<div class="alnp--read-more center-align">
		<span id="alnp--read-more__text" class="display-inline-block header-font gray">
			<?php echo esc_html( apply_filters( 'tabor_post_up_next', esc_html__( 'Read my next article', 'tabor' ) ) ); ?>
		</span>
		<?php echo wp_kses( tabor_get_svg( array( 'icon' => 'arrow-down' ) ), tabor_svg_allowed_html() ); ?>
	</div>
<?php
}

add_action( 'alnp_load_before_loop', 'tabor_alnp_post_divider', 0 );
