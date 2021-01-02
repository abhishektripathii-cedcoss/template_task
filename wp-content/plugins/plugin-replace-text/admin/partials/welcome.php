<?php
/**
 * Provide a admin area view for the plugin
 *
 * This file is used to markup the welcome html.
 *
 * @link       https://makewebbetter.com/
 * @since      1.0.0
 *
 * @package    Replace_text
 * @subpackage Replace_text/admin/partials
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
?>
<!-- This file should primarily consist of HTML with a little bit of PHP. -->
<div class="mwb-rt-main-wrapper">
	<div class="mwb-rt-go-pro">
		<div class="mwb-rt-go-pro-banner">
			<div class="mwb-rt-inner-container">
				<div class="mwb-rt-name-wrapper" id="mwb-rt-page-header">
					<h3><?php esc_html_e( 'Welcome To MakeWebBetter', 'replace-text' ); ?></h4>
					</div>
				</div>
			</div>
			<div class="mwb-rt-inner-logo-container">
				<div class="mwb-rt-main-logo">
					<img src="<?php echo esc_url( REPLACE_TEXT_DIR_URL . 'admin/images/logo.png' ); ?>">
					<h2><?php esc_html_e( 'We make the customer experience better', 'replace-text' ); ?></h2>
					<h3><?php esc_html_e( 'Being best at something feels great. Every Business desires a smooth buyer’s journey, WE ARE BEST AT IT.', 'replace-text' ); ?></h3>
				</div>
				<div class="mwb-rt-active-plugins-list">
					<?php
					$mwb_rt_all_plugins = get_option( 'mwb_all_plugins_active', false );
					if ( is_array( $mwb_rt_all_plugins ) && ! empty( $mwb_rt_all_plugins ) ) {
						?>
						<table class="mwb-rt-table">
							<thead>
								<tr class="mwb-plugins-head-row">
									<th><?php esc_html_e( 'Plugin Name', 'replace-text' ); ?></th>
									<th><?php esc_html_e( 'Active Status', 'replace-text' ); ?></th>
								</tr>
							</thead>
							<tbody>
								<?php if ( is_array( $mwb_rt_all_plugins ) && ! empty( $mwb_rt_all_plugins ) ) { ?>
									<?php foreach ( $mwb_rt_all_plugins as $rt_plugin_key => $rt_plugin_value ) { ?>
										<tr class="mwb-plugins-row">
											<td><?php echo esc_html( $rt_plugin_value['plugin_name'] ); ?></td>
											<?php if ( isset( $rt_plugin_value['active'] ) && '1' != $rt_plugin_value['active'] ) { ?>
												<td><?php esc_html_e( 'NO', 'replace-text' ); ?></td>
											<?php } else { ?>
												<td><?php esc_html_e( 'YES', 'replace-text' ); ?></td>
											<?php } ?>
										</tr>
									<?php } ?>
								<?php } ?>
							</tbody>
						</table>
						<?php
					}
					?>
				</div>
			</div>
		</div>
