<?php
/**
 * Toggle Customizer Control.
 *
 * @see https://developer.wordpress.org/reference/classes/wp_customize_control/
 *
 * @package     ThemeBeans Admin
 * @link        https://themebeans.com/
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// Exit if WP_Customize_Control does not exsist.
if ( ! class_exists( 'WP_Customize_Control' ) ) {
	return null;
}

/**
 * This class is for the toggle control in the Customizer.
 *
 * @access public
 */
class ThemeBeans_Toggle_Control extends WP_Customize_Control {

	/**
	 * The type of customize control.
	 *
	 * @access public
	 * @var    string
	 */
	public $type = 'themebeans-toggle';

	/**
	 * Custom pro button URL.
	 *
	 * @since  1.0.0
	 * @access public
	 * @var    string
	 */
	public $toggled_description = '';

	/**
	 * Enqueue scripts and styles.
	 */
	public function enqueue() {
		wp_enqueue_style( 'themebeans-toggle-control', get_parent_theme_file_uri( 'inc/admin/controls/assets/css/dist/toggle.min.css' ), false, '@@pkg.version', 'all' );
		wp_enqueue_script( 'themebeans-toggle-control', get_parent_theme_file_uri( 'inc/admin/controls/assets/js/dist/toggle.min.js' ), array( 'jquery' ), '@@pkg.version', true );
	}

	/**
	 * Refresh the parameters passed to the JavaScript via JSON.
	 *
	 * @uses WP_Customize_Control::to_json()
	 */
	public function to_json() {
		parent::to_json();

		// The setting value.
		$this->json['id']                  = $this->id;
		$this->json['value']               = $this->value();
		$this->json['link']                = $this->get_link();
		$this->json['defaultValue']        = $this->setting->default;
		$this->json['toggled_description'] = ( isset( $this->toggled_description ) ) ? $this->toggled_description : null;
	}

	/**
	 * Don't render the control content from PHP, as it's rendered via JS on load.
	 */
	public function render_content() {}

	/**
	 * Render a JS template for the content of the control.
	 */
	protected function content_template() {
		?>

		<div class="components-base-control components-toggle-control">

			<div class="components-base-control__field">

				<# if ( data.label ) { #>
					<label for="inspector-toggle-control-{{ data.id }}" class="customize-control-title components-toggle-control__label">{{ data.label }}</label>
				<# } #>

				<span class="components-form-toggle <# if ( data.value ) { #>is-checked<# } #>">
					<input class="components-form-toggle__input" id="inspector-toggle-control-{{ data.id }}" type="checkbox" value="{{ data.value }}" {{{ data.link }}} <# if ( data.value ) { #> checked="checked" <# } #> />
					<span class="components-form-toggle__track"></span>
					<span class="components-form-toggle__thumb"></span>
					<# if ( data.value ) { #>
						<svg class="components-form-toggle__on" width="2" height="6" aria-hidden="true" role="img" focusable="false" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 2 6">
							<path d="M0 0h2v6H0z"></path>
						</svg>
					<# } else { #>
						<svg class="components-form-toggle__off" width="6" height="6" aria-hidden="true" role="img" focusable="false" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 6 6">
							<path d="M3 1.5c.8 0 1.5.7 1.5 1.5S3.8 4.5 3 4.5 1.5 3.8 1.5 3 2.2 1.5 3 1.5M3 0C1.3 0 0 1.3 0 3s1.3 3 3 3 3-1.3 3-3-1.3-3-3-3z"></path>
						</svg>
					<# } #>
				</span>
			</div>

			<# if ( data.description ) { #>
				<span id="inspector-toggle-control-{{ data.id }}__help" class="description customize-control-description components-base-control__help <# if ( data.toggled_description ) { #> components-base-control__help--has-toggled-description <# } #>">
					<span class="toggle--off <# if ( data.value && data.toggled_description ) { #> hidden <# } #>">{{ data.description }}</span>
					<# if ( data.toggled_description ) { #>
						<span class="toggle--on <# if ( ! data.value && data.toggled_description ) { #> hidden <# } #>">{{ data.toggled_description }}</span>
					<# } #>
				</span>
			<# } #>
		</div>

		<?php
	}
}
