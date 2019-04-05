<?php
/**
 * Template for displaying search forms in Tabor
 *
 * @package     Tabor
 * @link        https://themebeans.com/themes/tabor
 */

$site      = get_bloginfo( 'name' );
$unique_id = esc_attr( uniqid( 'search-form-' ) );

/* translators: %s: site name */
$placeholder = sprintf( esc_html__( 'Search %s ...', 'tabor' ), esc_html( $site ) );
?>

<form role="search" method="get" class="search-form" action="<?php echo esc_url( home_url( '/' ) ); ?>">
	<label for="<?php echo esc_attr( $unique_id ); ?>">
		<span class="screen-reader-text"><?php echo esc_html_x( 'Search for:', 'label', 'tabor' ); ?></span>
	</label>
	<input type="search" id="<?php echo esc_attr( $unique_id ); ?>" class="search-field" placeholder="<?php echo esc_attr( $placeholder ); ?>" value="<?php echo get_search_query(); ?>" name="s" />
	<button type="submit" class="button--chromeless search-submit"><?php echo wp_kses( tabor_get_svg( array( 'icon' => 'search' ) ), tabor_svg_allowed_html() ); ?><span class="screen-reader-text"><?php echo esc_html_x( 'Search', 'submit button', 'tabor' ); ?></span></button>
</form>
