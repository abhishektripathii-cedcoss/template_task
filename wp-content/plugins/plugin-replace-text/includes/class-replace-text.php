<?php
/**
 * The file that defines the core plugin class
 *
 * A class definition that includes attributes and functions used across both the
 * public-facing side of the site and the admin area.
 *
 * @link       https://makewebbetter.com/
 * @since      1.0.0
 *
 * @package    Replace_text
 * @subpackage Replace_text/includes
 */

/**
 * The core plugin class.
 *
 * This is used to define internationalization, admin-specific hooks, and
 * public-facing site hooks.
 *
 * Also maintains the unique identifier of this plugin as well as the current
 * version of the plugin.
 *
 * @since      1.0.0
 * @package    Replace_text
 * @subpackage Replace_text/includes
 * @author     makewebbetter <webmaster@makewebbetter.com>
 */
class Replace_text {

	/**
	 * The loader that's responsible for maintaining and registering all hooks that power
	 * the plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      Replace_text_Loader    $loader    Maintains and registers all hooks for the plugin.
	 */
	protected $loader;

	/**
	 * The unique identifier of this plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      string    $plugin_name    The string used to uniquely identify this plugin.
	 */
	protected $plugin_name;

	/**
	 * The current version of the plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      string    $version    The current version of the plugin.
	 */
	protected $version;

	/**
	 * Define the core functionality of the plugin.
	 *
	 * Set the plugin name and the plugin version that can be used throughout the plugin.
	 * Load the dependencies, define the locale, and set the hooks for the admin area and
	 * the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function __construct() {

		if ( defined( 'REPLACE_TEXT_VERSION' ) ) {

			$this->version = REPLACE_TEXT_VERSION;
		} else {

			$this->version = '1.0.0';
		}

		$this->plugin_name = 'replace-text';

		$this->replace_text_dependencies();
		$this->replace_text_locale();
		$this->replace_text_admin_hooks();
		$this->replace_text_public_hooks();

	}

	/**
	 * Load the required dependencies for this plugin.
	 *
	 * Include the following files that make up the plugin:
	 *
	 * - Replace_text_Loader. Orchestrates the hooks of the plugin.
	 * - Replace_text_i18n. Defines internationalization functionality.
	 * - Replace_text_Admin. Defines all hooks for the admin area.
	 * - Replace_text_Public. Defines all hooks for the public side of the site.
	 *
	 * Create an instance of the loader which will be used to register the hooks
	 * with WordPress.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function replace_text_dependencies() {

		/**
		 * The class responsible for orchestrating the actions and filters of the
		 * core plugin.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/class-replace-text-loader.php';

		/**
		 * The class responsible for defining internationalization functionality
		 * of the plugin.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/class-replace-text-i18n.php';

		/**
		 * The class responsible for defining all actions that occur in the admin area.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'admin/class-replace-text-admin.php';

		/**
		 * The class responsible for defining all actions that occur in the public-facing
		 * side of the site.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'public/class-replace-text-public.php';

		$this->loader = new Replace_text_Loader();

	}

	/**
	 * Define the locale for this plugin for internationalization.
	 *
	 * Uses the Replace_text_I18n class in order to set the domain and to register the hook
	 * with WordPress.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function replace_text_locale() {

		$plugin_i18n = new Replace_text_I18n();

		$this->loader->add_action( 'plugins_loaded', $plugin_i18n, 'load_plugin_textdomain' );

	}

	/**
	 * Register all of the hooks related to the admin area functionality
	 * of the plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function replace_text_admin_hooks() {

		$rt_plugin_admin = new Replace_text_Admin( $this->rt_get_plugin_name(), $this->rt_get_version() );

		$this->loader->add_action( 'admin_enqueue_scripts', $rt_plugin_admin, 'rt_admin_enqueue_styles' );
		$this->loader->add_action( 'admin_enqueue_scripts', $rt_plugin_admin, 'rt_admin_enqueue_scripts' );

		// Add settings menu for replace-text.
		$this->loader->add_action( 'admin_menu', $rt_plugin_admin, 'rt_options_page' );

		// All admin actions and filters after License Validation goes here.
		$this->loader->add_filter( 'mwb_add_plugins_menus_array', $rt_plugin_admin, 'rt_admin_submenu_page', 15 );
		$this->loader->add_filter( 'rt_general_settings_array', $rt_plugin_admin, 'rt_admin_general_settings_page', 10 );

	}

	/**
	 * Register all of the hooks related to the public-facing functionality
	 * of the plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function replace_text_public_hooks() {

		$rt_plugin_public = new Replace_text_Public( $this->rt_get_plugin_name(), $this->rt_get_version() );

		$this->loader->add_action( 'wp_enqueue_scripts', $rt_plugin_public, 'rt_public_enqueue_styles' );
		$this->loader->add_action( 'wp_enqueue_scripts', $rt_plugin_public, 'rt_public_enqueue_scripts' );

	}


	/**
	 * Run the loader to execute all of the hooks with WordPress.
	 *
	 * @since    1.0.0
	 */
	public function rt_run() {
		$this->loader->rt_run();
	}

	/**
	 * The name of the plugin used to uniquely identify it within the context of
	 * WordPress and to define internationalization functionality.
	 *
	 * @since     1.0.0
	 * @return    string    The name of the plugin.
	 */
	public function rt_get_plugin_name() {
		return $this->plugin_name;
	}

	/**
	 * The reference to the class that orchestrates the hooks with the plugin.
	 *
	 * @since     1.0.0
	 * @return    Replace_text_Loader    Orchestrates the hooks of the plugin.
	 */
	public function rt_get_loader() {
		return $this->loader;
	}

	/**
	 * Retrieve the version number of the plugin.
	 *
	 * @since     1.0.0
	 * @return    string    The version number of the plugin.
	 */
	public function rt_get_version() {
		return $this->version;
	}

	/**
	 * Predefined default mwb_rt_plug tabs.
	 *
	 * @return  Array       An key=>value pair of replace-text tabs.
	 */
	public function mwb_rt_plug_default_tabs() {

		$rt_default_tabs = array();

		$rt_default_tabs['replace-text-general'] = array(
			'title'       => esc_html__( 'General Setting', 'replace-text' ),
			'name'        => 'replace-text-general',
		);
		$rt_default_tabs = apply_filters( 'mwb_rt_plugin_standard_admin_settings_tabs', $rt_default_tabs );

		$rt_default_tabs['replace-text-system-status'] = array(
			'title'       => esc_html__( 'System Status', 'replace-text' ),
			'name'        => 'replace-text-system-status',
		);

		return $rt_default_tabs;
	}

	/**
	 * Locate and load appropriate tempate.
	 *
	 * @since   1.0.0
	 * @param string $path path file for inclusion.
	 * @param array  $params parameters to pass to the file for access.
	 */
	public function mwb_rt_plug_load_template( $path, $params = array() ) {

		$rt_file_path = REPLACE_TEXT_DIR_PATH . $path;

		if ( file_exists( $rt_file_path ) ) {

			include $rt_file_path;
		} else {

			/* translators: %s: file path */
			$rt_notice = sprintf( esc_html__( 'Unable to locate file at location "%s". Some features may not work properly in this plugin. Please contact us!', 'replace-text' ), $rt_file_path );
			$this->mwb_rt_plug_admin_notice( $rt_notice, 'error' );
		}
	}

	/**
	 * Show admin notices.
	 *
	 * @param  string $rt_message    Message to display.
	 * @param  string $type       notice type, accepted values - error/update/update-nag.
	 * @since  1.0.0
	 */
	public static function mwb_rt_plug_admin_notice( $rt_message, $type = 'error' ) {

		$rt_classes = 'notice ';

		switch ( $type ) {

			case 'update':
				$rt_classes .= 'updated is-dismissible';
				break;

			case 'update-nag':
				$rt_classes .= 'update-nag is-dismissible';
				break;

			case 'success':
				$rt_classes .= 'notice-success is-dismissible';
				break;

			default:
				$rt_classes .= 'notice-error is-dismissible';
		}

		$rt_notice  = '<div class="' . esc_attr( $rt_classes ) . '">';
		$rt_notice .= '<p>' . esc_html( $rt_message ) . '</p>';
		$rt_notice .= '</div>';

		echo wp_kses_post( $rt_notice );
	}


	/**
	 * Show wordpress and server info.
	 *
	 * @return  Array $rt_system_data       returns array of all wordpress and server related information.
	 * @since  1.0.0
	 */
	public function mwb_rt_plug_system_status() {
		global $wpdb;
		$rt_system_status = array();
		$rt_wordpress_status = array();
		$rt_system_data = array();

		// Get the web server.
		$rt_system_status['web_server'] = isset( $_SERVER['SERVER_SOFTWARE'] ) ? sanitize_text_field( wp_unslash( $_SERVER['SERVER_SOFTWARE'] ) ) : '';

		// Get PHP version.
		$rt_system_status['php_version'] = function_exists( 'phpversion' ) ? phpversion() : __( 'N/A (phpversion function does not exist)', 'replace-text' );

		// Get the server's IP address.
		$rt_system_status['server_ip'] = isset( $_SERVER['SERVER_ADDR'] ) ? sanitize_text_field( wp_unslash( $_SERVER['SERVER_ADDR'] ) ) : '';

		// Get the server's port.
		$rt_system_status['server_port'] = isset( $_SERVER['SERVER_PORT'] ) ? sanitize_text_field( wp_unslash( $_SERVER['SERVER_PORT'] ) ) : '';

		// Get the uptime.
		$rt_system_status['uptime'] = function_exists( 'exec' ) ? @exec( 'uptime -p' ) : __( 'N/A (make sure exec function is enabled)', 'replace-text' );

		// Get the server path.
		$rt_system_status['server_path'] = defined( 'ABSPATH' ) ? ABSPATH : __( 'N/A (ABSPATH constant not defined)', 'replace-text' );

		// Get the OS.
		$rt_system_status['os'] = function_exists( 'php_uname' ) ? php_uname( 's' ) : __( 'N/A (php_uname function does not exist)', 'replace-text' );

		// Get WordPress version.
		$rt_wordpress_status['wp_version'] = function_exists( 'get_bloginfo' ) ? get_bloginfo( 'version' ) : __( 'N/A (get_bloginfo function does not exist)', 'replace-text' );

		// Get and count active WordPress plugins.
		$rt_wordpress_status['wp_active_plugins'] = function_exists( 'get_option' ) ? count( get_option( 'active_plugins' ) ) : __( 'N/A (get_option function does not exist)', 'replace-text' );

		// See if this site is multisite or not.
		$rt_wordpress_status['wp_multisite'] = function_exists( 'is_multisite' ) && is_multisite() ? __( 'Yes', 'replace-text' ) : __( 'No', 'replace-text' );

		// See if WP Debug is enabled.
		$rt_wordpress_status['wp_debug_enabled'] = defined( 'WP_DEBUG' ) ? __( 'Yes', 'replace-text' ) : __( 'No', 'replace-text' );

		// See if WP Cache is enabled.
		$rt_wordpress_status['wp_cache_enabled'] = defined( 'WP_CACHE' ) ? __( 'Yes', 'replace-text' ) : __( 'No', 'replace-text' );

		// Get the total number of WordPress users on the site.
		$rt_wordpress_status['wp_users'] = function_exists( 'count_users' ) ? count_users() : __( 'N/A (count_users function does not exist)', 'replace-text' );

		// Get the number of published WordPress posts.
		$rt_wordpress_status['wp_posts'] = wp_count_posts()->publish >= 1 ? wp_count_posts()->publish : __( '0', 'replace-text' );

		// Get PHP memory limit.
		$rt_system_status['php_memory_limit'] = function_exists( 'ini_get' ) ? (int) ini_get( 'memory_limit' ) : __( 'N/A (ini_get function does not exist)', 'replace-text' );

		// Get the PHP error log path.
		$rt_system_status['php_error_log_path'] = ! ini_get( 'error_log' ) ? __( 'N/A', 'replace-text' ) : ini_get( 'error_log' );

		// Get PHP max upload size.
		$rt_system_status['php_max_upload'] = function_exists( 'ini_get' ) ? (int) ini_get( 'upload_max_filesize' ) : __( 'N/A (ini_get function does not exist)', 'replace-text' );

		// Get PHP max post size.
		$rt_system_status['php_max_post'] = function_exists( 'ini_get' ) ? (int) ini_get( 'post_max_size' ) : __( 'N/A (ini_get function does not exist)', 'replace-text' );

		// Get the PHP architecture.
		if ( PHP_INT_SIZE == 4 ) {
			$rt_system_status['php_architecture'] = '32-bit';
		} elseif ( PHP_INT_SIZE == 8 ) {
			$rt_system_status['php_architecture'] = '64-bit';
		} else {
			$rt_system_status['php_architecture'] = 'N/A';
		}

		// Get server host name.
		$rt_system_status['server_hostname'] = function_exists( 'gethostname' ) ? gethostname() : __( 'N/A (gethostname function does not exist)', 'replace-text' );

		// Show the number of processes currently running on the server.
		$rt_system_status['processes'] = function_exists( 'exec' ) ? @exec( 'ps aux | wc -l' ) : __( 'N/A (make sure exec is enabled)', 'replace-text' );

		// Get the memory usage.
		$rt_system_status['memory_usage'] = function_exists( 'memory_get_peak_usage' ) ? round( memory_get_peak_usage( true ) / 1024 / 1024, 2 ) : 0;

		// Get CPU usage.
		// Check to see if system is Windows, if so then use an alternative since sys_getloadavg() won't work.
		if ( stristr( PHP_OS, 'win' ) ) {
			$rt_system_status['is_windows'] = true;
			$rt_system_status['windows_cpu_usage'] = function_exists( 'exec' ) ? @exec( 'wmic cpu get loadpercentage /all' ) : __( 'N/A (make sure exec is enabled)', 'replace-text' );
		}

		// Get the memory limit.
		$rt_system_status['memory_limit'] = function_exists( 'ini_get' ) ? (int) ini_get( 'memory_limit' ) : __( 'N/A (ini_get function does not exist)', 'replace-text' );

		// Get the PHP maximum execution time.
		$rt_system_status['php_max_execution_time'] = function_exists( 'ini_get' ) ? ini_get( 'max_execution_time' ) : __( 'N/A (ini_get function does not exist)', 'replace-text' );

		// Get outgoing IP address.
		$rt_system_status['outgoing_ip'] = function_exists( 'file_get_contents' ) ? file_get_contents( 'http://ipecho.net/plain' ) : __( 'N/A (file_get_contents function does not exist)', 'replace-text' );

		$rt_system_data['php'] = $rt_system_status;
		$rt_system_data['wp'] = $rt_wordpress_status;

		return $rt_system_data;
	}

	/**
	 * Generate html components.
	 *
	 * @param  string $rt_components    html to display.
	 * @since  1.0.0
	 */
	public function mwb_rt_plug_generate_html( $rt_components = array() ) {
		if ( is_array( $rt_components ) && ! empty( $rt_components ) ) {
			foreach ( $rt_components as $rt_component ) {
				switch ( $rt_component['type'] ) {

					case 'hidden':
					case 'number':
					case 'password':
					case 'email':
					case 'text':
						?>
						<tr valign="top">
							<th scope="row" class="titledesc">
								<label for="<?php echo esc_attr( $rt_component['id'] ); ?>"><?php echo esc_html( $rt_component['title'] ); // WPCS: XSS ok. ?>
							</th>
							<td class="forminp forminp-<?php echo esc_attr( sanitize_title( $rt_component['type'] ) ); ?>">
								<input
								name="<?php echo esc_attr( $rt_component['id'] ); ?>"
								id="<?php echo esc_attr( $rt_component['id'] ); ?>"
								type="<?php echo esc_attr( $rt_component['type'] ); ?>"
								value="<?php echo esc_attr( $rt_component['value'] ); ?>"
								class="<?php echo esc_attr( $rt_component['class'] ); ?>"
								placeholder="<?php echo esc_attr( $rt_component['placeholder'] ); ?>"
								/>
								<p class="rt-descp-tip"><?php echo esc_html( $rt_component['description'] ); // WPCS: XSS ok. ?></p>
							</td>
						</tr>
						<?php
						break;

					case 'textarea':
						?>
						<tr valign="top">
							<th scope="row" class="titledesc">
								<label for="<?php echo esc_attr( $rt_component['id'] ); ?>"><?php echo esc_html( $rt_component['title'] ); ?>
							</th>
							<td class="forminp forminp-<?php echo esc_attr( sanitize_title( $rt_component['type'] ) ); ?>">
								<textarea
								name="<?php echo esc_attr( $rt_component['id'] ); ?>"
								id="<?php echo esc_attr( $rt_component['id'] ); ?>"
								class="<?php echo esc_attr( $rt_component['class'] ); ?>"
								rows="<?php echo esc_attr( $rt_component['rows'] ); ?>"
								cols="<?php echo esc_attr( $rt_component['cols'] ); ?>"
								placeholder="<?php echo esc_attr( $rt_component['placeholder'] ); ?>"
								><?php echo esc_textarea( $rt_component['value'] ); // WPCS: XSS ok. ?></textarea>
								<p class="rt-descp-tip"><?php echo esc_html( $rt_component['description'] ); // WPCS: XSS ok. ?></p>
							</td>
						</tr>
						<?php
						break;

					case 'select':
					case 'multiselect':
						?>
						<tr valign="top">
							<th scope="row" class="titledesc">
								<label for="<?php echo esc_attr( $rt_component['id'] ); ?>"><?php echo esc_html( $rt_component['title'] ); ?>
							</th>
							<td class="forminp forminp-<?php echo esc_attr( sanitize_title( $rt_component['type'] ) ); ?>">
								<select
								name="<?php echo esc_attr( $rt_component['id'] ); ?><?php echo ( 'multiselect' === $rt_component['type'] ) ? '[]' : ''; ?>"
								id="<?php echo esc_attr( $rt_component['id'] ); ?>"
								class="<?php echo esc_attr( $rt_component['class'] ); ?>"
								<?php echo 'multiselect' === $rt_component['type'] ? 'multiple="multiple"' : ''; ?>
								>
								<?php
								foreach ( $rt_component['options'] as $rt_key => $rt_val ) {
									?>
									<option value="<?php echo esc_attr( $rt_key ); ?>"
										<?php
										if ( is_array( $rt_component['value'] ) ) {
											selected( in_array( (string) $rt_key, $rt_component['value'], true ), true );
										} else {
											selected( $rt_component['value'], (string) $rt_key );
										}
										?>
										>
										<?php echo esc_html( $rt_val ); ?>
									</option>
									<?php
								}
								?>
								</select> 
								<p class="rt-descp-tip"><?php echo esc_html( $rt_component['description'] ); // WPCS: XSS ok. ?></p>
							</td>
						</tr>
						<?php
						break;

					case 'checkbox':
						?>
						<tr valign="top">
							<th scope="row" class="titledesc"><?php echo esc_html( $rt_component['title'] ); ?></th>
							<td class="forminp forminp-checkbox">
								<label for="<?php echo esc_attr( $rt_component['id'] ); ?>"></label>
								<input
								name="<?php echo esc_attr( $rt_component['id'] ); ?>"
								id="<?php echo esc_attr( $rt_component['id'] ); ?>"
								type="checkbox"
								class="<?php echo esc_attr( isset( $rt_component['class'] ) ? $rt_component['class'] : '' ); ?>"
								value="1"
								<?php checked( $rt_component['value'], '1' ); ?>
								/> 
								<span class="rt-descp-tip"><?php echo esc_html( $rt_component['description'] ); // WPCS: XSS ok. ?></span>

							</td>
						</tr>
						<?php
						break;

					case 'radio':
						?>
						<tr valign="top">
							<th scope="row" class="titledesc">
								<label for="<?php echo esc_attr( $rt_component['id'] ); ?>"><?php echo esc_html( $rt_component['title'] ); ?>
							</th>
							<td class="forminp forminp-<?php echo esc_attr( sanitize_title( $rt_component['type'] ) ); ?>">
								<fieldset>
									<span class="rt-descp-tip"><?php echo esc_html( $rt_component['description'] ); // WPCS: XSS ok. ?></span>
									<ul>
										<?php
										foreach ( $rt_component['options'] as $rt_radio_key => $rt_radio_val ) {
											?>
											<li>
												<label><input
													name="<?php echo esc_attr( $rt_component['id'] ); ?>"
													value="<?php echo esc_attr( $rt_radio_key ); ?>"
													type="radio"
													class="<?php echo esc_attr( $rt_component['class'] ); ?>"
												<?php checked( $rt_radio_key, $rt_component['value'] ); ?>
													/> <?php echo esc_html( $rt_radio_val ); ?></label>
											</li>
											<?php
										}
										?>
									</ul>
								</fieldset>
							</td>
						</tr>
						<?php
						break;

					case 'button':
						?>
						<tr valign="top">
							<td scope="row">
								<input type="button" class="button button-primary" 
								name="<?php echo esc_attr( $rt_component['id'] ); ?>"
								id="<?php echo esc_attr( $rt_component['id'] ); ?>"
								value="<?php echo esc_attr( $rt_component['button_text'] ); ?>"
								/>
							</td>
						</tr>
						<?php
						break;

					case 'submit':
						?>
						<tr valign="top">
							<td scope="row">
								<input type="submit" class="button button-primary" 
								name="<?php echo esc_attr( $rt_component['id'] ); ?>"
								id="<?php echo esc_attr( $rt_component['id'] ); ?>"
								value="<?php echo esc_attr( $rt_component['button_text'] ); ?>"
								/>
							</td>
						</tr>
						<?php
						break;

					default:
						break;
				}
			}
		}
	}
}
