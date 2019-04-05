<?php
/**
 * Fonts functionality.
 *
 * @package     Tabor
 * @link        https://themebeans.com/themes/tabor
 */

/**
 * Returns an array of Google Font options
 *
 * @return array of font styles.
 */
function tabor_get_fonts() {

	$fonts = array(
		'Default'          => 'Default',
		'System Fonts'     => 'System Fonts',
		'System Serif'     => 'System Serif',
		'Abril Fatface'    => 'Abril Fatface',
		'georgia'          => 'Georgia',
		'helvetica'        => 'Helvetica',
		'Lato'             => 'Lato',
		'Karla'            => 'Karla',
		'Montserrat'       => 'Montserrat',
		'Merriweather'     => 'Merriweather',
		'Nunito'           => 'Nunito',
		'Playfair Display' => 'Playfair Display',
		'Roboto'           => 'Roboto',
		'Source+Sans+Pro ' => 'Source Sans Pro',
	);

	return apply_filters( 'tabor_fonts', $fonts );
}
