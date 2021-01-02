<?php
/**
 * The admin-specific functionality of the plugin.
 *
 * @link       https://makewebbetter.com/
 * @since      1.0.0
 *
 * @package    Replace_text
 * @subpackage Replace_text/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Replace_text
 * @subpackage Replace_text/admin
 * @author     makewebbetter <webmaster@makewebbetter.com>
 */
class Replace_text_Admin {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $plugin_name    The ID of this plugin.
	 */
	private $plugin_name;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string $plugin_name       The name of this plugin.
	 * @param      string $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;

	}

	/**
	 * Register the stylesheets for the admin area.
	 *
	 * @since    1.0.0
	 * @param    string $hook      The plugin page slug.
	 */
	public function rt_admin_enqueue_styles( $hook ) {

		wp_enqueue_style( 'mwb-rt-select2-css', REPLACE_TEXT_DIR_URL . 'admin/css/replace-text-select2.css', array(), time(), 'all' );

		wp_enqueue_style( $this->plugin_name, REPLACE_TEXT_DIR_URL . 'admin/css/replace-text-admin.css', array(), $this->version, 'all' );

	}

	/**
	 * Register the JavaScript for the admin area.
	 *
	 * @since    1.0.0
	 * @param    string $hook      The plugin page slug.
	 */
	public function rt_admin_enqueue_scripts( $hook ) {

		wp_enqueue_script( 'mwb-rt-select2', REPLACE_TEXT_DIR_URL . 'admin/js/replace-text-select2.js', array( 'jquery' ), time(), false );

		wp_register_script( $this->plugin_name . 'admin-js', REPLACE_TEXT_DIR_URL . 'admin/js/replace-text-admin.js', array( 'jquery', 'mwb-rt-select2' ), $this->version, false );

		wp_localize_script(
			$this->plugin_name . 'admin-js',
			'rt_admin_param',
			array(
				'ajaxurl' => admin_url( 'admin-ajax.php' ),
				'reloadurl' => admin_url( 'admin.php?page=replace_text_menu' ),
			)
		);

		wp_enqueue_script( $this->plugin_name . 'admin-js' );
	}

	/**
	 * Adding settings menu for replace-text.
	 *
	 * @since    1.0.0
	 */
	public function rt_options_page() {
		global $submenu;
		if ( empty( $GLOBALS['admin_page_hooks']['mwb-plugins'] ) ) {
			add_menu_page( __( 'MakeWebBetter', 'replace-text' ), __( 'MakeWebBetter', 'replace-text' ), 'manage_options', 'mwb-plugins', array( $this, 'mwb_plugins_listing_page' ), REPLACE_TEXT_DIR_URL . 'admin/images/mwb-logo.png', 15 );
			$rt_menus = apply_filters( 'mwb_add_plugins_menus_array', array() );
			if ( is_array( $rt_menus ) && ! empty( $rt_menus ) ) {
				foreach ( $rt_menus as $rt_key => $rt_value ) {
					add_submenu_page( 'mwb-plugins', $rt_value['name'], $rt_value['name'], 'manage_options', $rt_value['menu_link'], array( $rt_value['instance'], $rt_value['function'] ) );
				}
			}
		}
	}


	/**
	 * replace-text rt_admin_submenu_page.
	 *
	 * @since 1.0.0
	 * @param array $menus Marketplace menus.
	 */
	public function rt_admin_submenu_page( $menus = array() ) {
		$menus[] = array(
			'name'            => __( 'replace-text', 'replace-text' ),
			'slug'            => 'replace_text_menu',
			'menu_link'       => 'replace_text_menu',
			'instance'        => $this,
			'function'        => 'rt_options_menu_html',
		);
		return $menus;
	}


	/**
	 * replace-text mwb_plugins_listing_page.
	 *
	 * @since 1.0.0
	 */
	public function mwb_plugins_listing_page() {
		$active_marketplaces = apply_filters( 'mwb_add_plugins_menus_array', array() );
		if ( is_array( $active_marketplaces ) && ! empty( $active_marketplaces ) ) {
			require REPLACE_TEXT_DIR_PATH . 'admin/partials/welcome.php';
		}
	}

	/**
	 * replace-text admin menu page.
	 *
	 * @since    1.0.0
	 */
	public function rt_options_menu_html() {

		include_once REPLACE_TEXT_DIR_PATH . 'admin/partials/replace-text-admin-display.php';
	}

	/**
	 * replace-text admin menu page.
	 *
	 * @since    1.0.0
	 * @param array $rt_settings_general Settings fields.
	 */
	public function rt_admin_general_settings_page( $rt_settings_general ) {
		$rt_settings_general = array(
			array(
				'title' => __( 'Text Field Demo', 'replace-text' ),
				'type'  => 'text',
				'description'  => __( 'This is text field demo follow same structure for further use.', 'replace-text' ),
				'id'    => 'rt_text_demo',
				'value' => '',
				'class' => 'rt-text-class',
				'placeholder' => __( 'Text Demo', 'replace-text' ),
			),
			array(
				'title' => __( 'Number Field Demo', 'replace-text' ),
				'type'  => 'number',
				'description'  => __( 'This is number field demo follow same structure for further use.', 'replace-text' ),
				'id'    => 'rt_number_demo',
				'value' => '',
				'class' => 'rt-number-class',
				'placeholder' => '',
			),
			array(
				'title' => __( 'Password Field Demo', 'replace-text' ),
				'type'  => 'password',
				'description'  => __( 'This is password field demo follow same structure for further use.', 'replace-text' ),
				'id'    => 'rt_password_demo',
				'value' => '',
				'class' => 'rt-password-class',
				'placeholder' => '',
			),
			array(
				'title' => __( 'Textarea Field Demo', 'replace-text' ),
				'type'  => 'textarea',
				'description'  => __( 'This is textarea field demo follow same structure for further use.', 'replace-text' ),
				'id'    => 'rt_textarea_demo',
				'value' => '',
				'class' => 'rt-textarea-class',
				'rows' => '5',
				'cols' => '10',
				'placeholder' => __( 'Textarea Demo', 'replace-text' ),
			),
			array(
				'title' => __( 'Select Field Demo', 'replace-text' ),
				'type'  => 'select',
				'description'  => __( 'This is select field demo follow same structure for further use.', 'replace-text' ),
				'id'    => 'rt_select_demo',
				'value' => '',
				'class' => 'rt-select-class',
				'placeholder' => __( 'Select Demo', 'replace-text' ),
				'options' => array(
					'INR' => __( 'Rs.', 'replace-text' ),
					'USD' => __( '$', 'replace-text' ),
				),
			),
			array(
				'title' => __( 'Multiselect Field Demo', 'replace-text' ),
				'type'  => 'multiselect',
				'description'  => __( 'This is multiselect field demo follow same structure for further use.', 'replace-text' ),
				'id'    => 'rt_multiselect_demo',
				'value' => '',
				'class' => 'rt-multiselect-class mwb-defaut-multiselect',
				'placeholder' => __( 'Multiselect Demo', 'replace-text' ),
				'options' => array(
					'INR' => __( 'Rs.', 'replace-text' ),
					'USD' => __( '$', 'replace-text' ),
				),
			),
			array(
				'title' => __( 'Checkbox Field Demo', 'replace-text' ),
				'type'  => 'checkbox',
				'description'  => __( 'This is checkbox field demo follow same structure for further use.', 'replace-text' ),
				'id'    => 'rt_checkbox_demo',
				'value' => '',
				'class' => 'rt-checkbox-class',
				'placeholder' => __( 'Checkbox Demo', 'replace-text' ),
			),

			array(
				'title' => __( 'Radio Field Demo', 'replace-text' ),
				'type'  => 'radio',
				'description'  => __( 'This is radio field demo follow same structure for further use.', 'replace-text' ),
				'id'    => 'rt_radio_demo',
				'value' => '',
				'class' => 'rt-radio-class',
				'placeholder' => __( 'Radio Demo', 'replace-text' ),
				'options' => array(
					'yes' => __( 'YES', 'replace-text' ),
					'no' => __( 'NO', 'replace-text' ),
				),
			),

			array(
				'type'  => 'button',
				'id'    => 'rt_button_demo',
				'button_text' => __( 'Button Demo', 'replace-text' ),
				'class' => 'rt-button-class',
			),
		);
		return $rt_settings_general;
	}
}
