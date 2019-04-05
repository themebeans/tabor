<?php
/**
 * Updater Config
 *
 * @package     ThemeBeans Admin
 * @link        https://themebeans.com/
 */

$updater = new ThemeBeans_License(

	$config = array(
		'remote_api_url' => 'https://themebeans.com',
		'item_name'      => esc_attr( themebeans_get_theme( false ) ),
		'theme_slug'     => esc_attr( themebeans_get_theme( true ) ),
		'version'        => esc_attr( wp_get_theme( get_template() )->get( 'Version' ) ),
		'author'         => 'ThemeBeans',
		'download_id'    => '@@pkg.downloadid',
		'renew_url'      => '',
		'beta'           => false,
	)
);
