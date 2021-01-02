<?php
/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              https://makewebbetter.com/
 * @since             1.0.0
 * @package           Replace_text
 *
 * @wordpress-plugin
 * Plugin Name:       replace-text
 * Plugin URI:        https://makewebbetter.com/product/replace-text/
 * Description:       Your Basic Plugin
 * Version:           1.0.0
 * Author:            makewebbetter
 * Author URI:        https://makewebbetter.com/
 * Text Domain:       replace-text
 * Domain Path:       /languages
 *
 * Requires at least: 4.6
 * Tested up to:      4.9.5
 *
 * License:           GNU General Public License v3.0
 * License URI:       http://www.gnu.org/licenses/gpl-3.0.html
 */

// If this file is called directly, abort.
if ( ! defined( 'ABSPATH' ) ) {
	die;
}

/**
 * Define plugin constants.
 *
 * @since             1.0.0
 */
function define_replace_text_constants() {

	replace_text_constants( 'REPLACE_TEXT_VERSION', '1.0.0' );
	replace_text_constants( 'REPLACE_TEXT_DIR_PATH', plugin_dir_path( __FILE__ ) );
	replace_text_constants( 'REPLACE_TEXT_DIR_URL', plugin_dir_url( __FILE__ ) );
	replace_text_constants( 'REPLACE_TEXT_SERVER_URL', 'https://makewebbetter.com' );
	replace_text_constants( 'REPLACE_TEXT_ITEM_REFERENCE', 'replace-text' );
}


/**
 * Callable function for defining plugin constants.
 *
 * @param   String $key    Key for contant.
 * @param   String $value   value for contant.
 * @since             1.0.0
 */
function replace_text_constants( $key, $value ) {

	if ( ! defined( $key ) ) {

		define( $key, $value );
	}
}

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-replace-text-activator.php
 */
function activate_replace_text() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-replace-text-activator.php';
	Replace_text_Activator::replace_text_activate();
	$mwb_rt_active_plugin = get_option( 'mwb_all_plugins_active', false );
	if ( is_array( $mwb_rt_active_plugin ) && ! empty( $mwb_rt_active_plugin ) ) {
		$mwb_rt_active_plugin['replace-text'] = array(
			'plugin_name' => __( 'replace-text', 'replace-text' ),
			'active' => '1',
		);
	} else {
		$mwb_rt_active_plugin = array();
		$mwb_rt_active_plugin['replace-text'] = array(
			'plugin_name' => __( 'replace-text', 'replace-text' ),
			'active' => '1',
		);
	}
	update_option( 'mwb_all_plugins_active', $mwb_rt_active_plugin );
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-replace-text-deactivator.php
 */
function deactivate_replace_text() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-replace-text-deactivator.php';
	Replace_text_Deactivator::replace_text_deactivate();
	$mwb_rt_deactive_plugin = get_option( 'mwb_all_plugins_active', false );
	if ( is_array( $mwb_rt_deactive_plugin ) && ! empty( $mwb_rt_deactive_plugin ) ) {
		foreach ( $mwb_rt_deactive_plugin as $mwb_rt_deactive_key => $mwb_rt_deactive ) {
			if ( 'replace-text' === $mwb_rt_deactive_key ) {
				$mwb_rt_deactive_plugin[ $mwb_rt_deactive_key ]['active'] = '0';
			}
		}
	}
	update_option( 'mwb_all_plugins_active', $mwb_rt_deactive_plugin );
}

register_activation_hook( __FILE__, 'activate_replace_text' );
register_deactivation_hook( __FILE__, 'deactivate_replace_text' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-replace-text.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_replace_text() {
	define_replace_text_constants();

	$rt_plugin_standard = new Replace_text();
	$rt_plugin_standard->rt_run();
	$GLOBALS['rt_mwb_rt_obj'] = $rt_plugin_standard;

}
run_replace_text();

// Add rest api endpoint for plugin.
add_action( 'rest_api_init', 'rt_add_default_endpoint' );

/**
 * Callback function for endpoints.
 *
 * @since    1.0.0
 */
function rt_add_default_endpoint() {
	register_rest_route(
		'rt-route',
		'/rt-dummy-data/',
		array(
			'methods'  => 'POST',
			'callback' => 'mwb_rt_default_callback',
		)
	);
}

/**
 * Begins execution of api endpoint.
 *
 * @param   Array $request    All information related with the api request containing in this array.
 * @return  Array   $mwb_rt_response   return rest response to server from where the endpoint hits.
 * @since    1.0.0
 */
function mwb_rt_default_callback( $request ) {
	require_once REPLACE_TEXT_DIR_PATH . 'includes/class-replace-text-api-process.php';
	$mwb_rt_api_obj = new Replace_text_Api_Process();
	$mwb_rt_resultsdata = $mwb_rt_api_obj->mwb_rt_default_process( $request );
	if ( is_array( $mwb_rt_resultsdata ) && isset( $mwb_rt_resultsdata['status'] ) && 200 == $mwb_rt_resultsdata['status'] ) {
		unset( $mwb_rt_resultsdata['status'] );
		$mwb_rt_response = new WP_REST_Response( $mwb_rt_resultsdata, 200 );
	} else {
		$mwb_rt_response = new WP_Error( $mwb_rt_resultsdata );
	}
	return $mwb_rt_response;
}


// Add settings link on plugin page.
add_filter( 'plugin_action_links_' . plugin_basename( __FILE__ ), 'replace_text_settings_link' );

/**
 * Settings link.
 *
 * @since    1.0.0
 * @param   Array $links    Settings link array.
 */
function replace_text_settings_link( $links ) {

	$my_link = array(
		'<a href="' . admin_url( 'admin.php?page=replace_text_menu' ) . '">' . __( 'Settings', 'replace-text' ) . '</a>',
	);
	return array_merge( $my_link, $links );
}

// Add Filter for content update from Hi to bye.
add_filter( 'the_content', 'mwb_replace_text' );
// Add Filter for content update from Hi to bye.
add_filter( 'the_title', 'mwb_replace_text' );
// Add Filter for content update from Hi to bye .
add_filter( 'the_excerpt', 'mwb_replace_text' );
// Add Filter for content update from Hi to bye .
add_filter( 'comment_text', 'mwb_replace_text' );

/**
 * Convert hi to bye in post content on archive and single page. 
 *
 * @return string post content
 */
function mwb_replace_text( $content ) {
	if( is_single() || is_archive() ) {
		$content = str_replace( 'Hi', 'Bye', $content );
		return $content;
	} else {
		return $content;
	}
}


