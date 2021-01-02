<?php
/**
 * Provide a admin area view for the plugin
 *
 * This file is used to markup the html for system status.
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
// Template for showing information about system status.
global $rt_mwb_rt_obj;
$rt_default_status = $rt_mwb_rt_obj->mwb_rt_plug_system_status();
$rt_wordpress_details = is_array( $rt_default_status['wp'] ) && ! empty( $rt_default_status['wp'] ) ? $rt_default_status['wp'] : array();
$rt_php_details = is_array( $rt_default_status['php'] ) && ! empty( $rt_default_status['php'] ) ? $rt_default_status['php'] : array();
?>
<div class="mwb-rt-table-wrap">
	<div class="mwb-rt-table-inner-container">
		<table class="mwb-rt-table" id="mwb-rt-wp">
			<thead>
				<tr>
					<th><?php esc_html_e( 'WP Variables', 'replace-text' ); ?></th>
					<th><?php esc_html_e( 'WP Values', 'replace-text' ); ?></th>
				</tr>
			</thead>
			<tbody>
				<?php if ( is_array( $rt_wordpress_details ) && ! empty( $rt_wordpress_details ) ) { ?>
					<?php foreach ( $rt_wordpress_details as $wp_key => $wp_value ) { ?>
						<?php if ( isset( $wp_key ) && 'wp_users' != $wp_key ) { ?>
							<tr>
								<td><?php echo esc_html( $wp_key ); ?></td>
								<td><?php echo esc_html( $wp_value ); ?></td>
							</tr>
						<?php } ?>
					<?php } ?>
				<?php } ?>
			</tbody>
		</table>
	</div>
	<div class="mwb-rt-table-inner-container">
		<table class="mwb-rt-table" id="mwb-rt-php">
			<thead>
				<tr>
					<th><?php esc_html_e( 'Sysytem Variables', 'replace-text' ); ?></th>
					<th><?php esc_html_e( 'System Values', 'replace-text' ); ?></th>
				</tr>
			</thead>
			<tbody>
				<?php if ( is_array( $rt_php_details ) && ! empty( $rt_php_details ) ) { ?>
					<?php foreach ( $rt_php_details as $php_key => $php_value ) { ?>
						<tr>
							<td><?php echo esc_html( $php_key ); ?></td>
							<td><?php echo esc_html( $php_value ); ?></td>
						</tr>
					<?php } ?>
				<?php } ?>
			</tbody>
		</table>
	</div>
</div>
