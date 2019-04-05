<?php
/**
 * Metaboxes.
 *
 * @package     Tabor
 * @link        https://themebeans.com/themes/tabor
 */

/**
 * Define the metabox and field configurations.
 */
function tabor_metaboxes() {

	// Start with an underscore to hide fields from custom fields list.
	$prefix = '_tabor_';

	// Set the context, based on whether or not Gutenberg is enabled.
	$context = ( function_exists( 'register_block_type' ) ) ? 'side' : 'normal';

	// Check for post formats.
	$formats = apply_filters( 'tabor_post_formats', array( 'link', 'video' ) );

	/**
	 * Page Settings.
	 */
	$cmb = new_cmb2_box(
		array(
			'id'           => 'page-settings',
			'title'        => esc_html__( 'Page Settings', 'tabor' ),
			'object_types' => array( 'page' ),
			'context'      => 'side',
			'priority'     => 'high',
		)
	);

	$cmb->add_field(
		array(
			'name' => esc_html__( 'Remove Header', 'tabor' ),
			'id'   => $prefix . 'header',
			'type' => 'checkbox',
		)
	);

	// Load this metabox only if OptinMonster is activated.
	if ( class_exists( 'OMAPI' ) ) {
		/**
		 * Initiate the metabox.
		 */
		$cmb = new_cmb2_box(
			array(
				'id'           => 'tabor_optinmonster_metabox',
				'title'        => esc_html__( 'OptinMonster', 'tabor' ),
				'object_types' => array( 'post' ),
				'context'      => $context,
				'priority'     => 'high',
			)
		);

		$cmb->add_field(
			array(
				'name' => esc_html__( 'Accent Color', 'tabor' ),
				'id'   => $prefix . 'post_accent_color',
				'type' => 'colorpicker',
			)
		);

		$cmb->add_field(
			array(
				'name' => esc_html__( 'Background Color', 'tabor' ),
				'id'   => $prefix . 'post_background_color',
				'type' => 'colorpicker',
			)
		);
	}

	/**
	 * Video.
	 * Check if video post format is supported.
	 */
	if ( in_array( 'video', $formats, true ) ) {
		$cmb = new_cmb2_box(
			array(
				'id'           => 'video_metabox',
				'title'        => esc_html__( 'Video Post Format', 'tabor' ),
				'object_types' => array( 'post' ),
				'context'      => $context,
				'priority'     => 'high',
			)
		);

		$cmb->add_field(
			array(
				'name' => esc_html__( 'Embed', 'tabor' ),
				'desc' => __( 'Enter a YouTube or Vimeo URL. Supports services listed <a target="_blank" href="http://codex.wordpress.org/Embeds">here</a>.', 'tabor' ),
				'id'   => $prefix . 'video',
				'type' => 'oembed',
			)
		);
	}

	/**
	 * Link.
	 * Check if video post format is supported.
	 */
	if ( in_array( 'link', $formats, true ) ) {
		$cmb = new_cmb2_box(
			array(
				'id'           => 'link_metabox',
				'title'        => esc_html__( 'Link Post Format', 'tabor' ),
				'object_types' => array( 'post' ),
				'context'      => $context,
				'priority'     => 'high',
			)
		);

		$cmb->add_field(
			array(
				'name' => esc_html__( 'Link', 'tabor' ),
				'id'   => $prefix . 'link',
				'type' => 'text_url',
			)
		);

		$cmb->add_field(
			array(
				'name'    => esc_html__( 'Link Target', 'tabor' ),
				'id'      => $prefix . 'link_target',
				'type'    => 'radio_inline',
				'options' => array(
					'_self'  => __( 'Same View', 'tabor' ),
					'_blank' => __( 'New Tab', 'tabor' ),
				),
				'default' => '_blank',
			)
		);
	}
}
add_action( 'cmb2_admin_init', 'tabor_metaboxes' );

/**
 * Set the Custom CSS via Customizer options.
 */
function tabor_post_accent_css() {

	$color      = get_post_meta( get_the_ID(), '_tabor_post_accent_color', true );
	$background = get_post_meta( get_the_ID(), '_tabor_post_background_color', true );

	if ( ! $color && ! $background ) {
		return;
	}

	$color_css      = null;
	$background_css = null;

	if ( $color ) {

		$color_css = '
			#course-optin::before {
				background: ' . esc_attr( $background ) . ' !important;
			}
		';
	}

	if ( $background ) {

		$background_css = '
			body #course-body #course-element-tagline, body #course-body #course-element-title-content {
				color: ' . esc_attr( $color ) . ' !important;
			}

			body #course-body #course-field-submit {
				border-color: ' . esc_attr( $color ) . ' !important;
				background: ' . esc_attr( $color ) . ' !important;
			}

			body #course-body #course-field-submit:hover {
				border-color: ' . esc_attr( $color ) . ' !important;
				background: ' . esc_attr( $color ) . ' !important;
			}
		';
	}

	wp_add_inline_style( 'tabor-style', wp_strip_all_tags( $color_css . $background_css ) );
}
add_action( 'wp_enqueue_scripts', 'tabor_post_accent_css' );

/**
 * Enqueue JavaScript for post meta.
 *
 * @param int $hook Hook suffix for the current admin page.
 */
function tabor_metaboxes_script( $hook ) {

	// Return early if the block editor is deployed.
	if ( function_exists( 'register_block_type' ) ) {
		return;
	}

	// Only enqueue this script on edit screens.
	if ( 'edit.php' !== $hook && 'post.php' !== $hook && 'post-new.php' !== $hook ) {
		return;
	}

	wp_enqueue_script( 'tabor-post-meta', get_theme_file_uri( '/assets/js/admin/metaboxes.js' ), array( 'jquery' ), '@@pkg.version', true );
}
add_action( 'admin_enqueue_scripts', 'tabor_metaboxes_script' );
