<?php
/**
 * Provide a admin area view for the plugin
 *
 * This file is used to markup the admin-facing aspects of the plugin.
 *
 * @link       https://makewebbetter.com/
 * @since      1.0.0
 *
 * @package    Replace_text
 * @subpackage Replace_text/admin/partials
 */

if ( ! defined( 'ABSPATH' ) ) {

	exit(); // Exit if accessed directly.
}

global $rt_mwb_rt_obj;
$rt_active_tab   = isset( $_GET['rt_tab'] ) ? sanitize_key( $_GET['rt_tab'] ) : 'replace-text-general';
$rt_default_tabs = $rt_mwb_rt_obj->mwb_rt_plug_default_tabs();
?>

<!-- This file should primarily consist of HTML with a little bit of PHP. -->
<div class="mwb-rt-main-wrapper">
	<div class="mwb-rt-go-pro">
		<div class="mwb-rt-go-pro-banner">
			<div class="mwb-rt-inner-container">
				<div class="mwb-rt-name-wrapper">
					<p><?php esc_html_e( 'replace-text', 'replace-text' ); ?></p></div>
					<div class="mwb-rt-static-menu">
						<ul>
							<li>
								<a href="<?php echo esc_url( 'https://makewebbetter.com/contact-us/' ); ?>" target="_blank">
									<span class="dashicons dashicons-phone"></span>
								</a>
							</li>
							<li>
								<a href="<?php echo esc_url( 'https://docs.makewebbetter.com/hubspot-woocommerce-integration/' ); ?>" target="_blank">
									<span class="dashicons dashicons-media-document"></span>
								</a>
							</li>
							<?php $rt_plugin_pro_link = apply_filters( 'rt_pro_plugin_link', '' ); ?>
							<?php if ( isset( $rt_plugin_pro_link ) && '' != $rt_plugin_pro_link ) { ?>
								<li class="mwb-rt-main-menu-button">
									<a id="mwb-rt-go-pro-link" href="<?php echo esc_url( $rt_plugin_pro_link ); ?>" class="" title="" target="_blank"><?php esc_html_e( 'GO PRO NOW', 'replace-text' ); ?></a>
								</li>
							<?php } else { ?>
								<li class="mwb-rt-main-menu-button">
									<a id="mwb-rt-go-pro-link" href="#" class="" title=""><?php esc_html_e( 'GO PRO NOW', 'replace-text' ); ?></a>
								</li>
							<?php } ?>
							<?php $rt_plugin_pro = apply_filters( 'rt_pro_plugin_purcahsed', 'no' ); ?>
							<?php if ( isset( $rt_plugin_pro ) && 'yes' == $rt_plugin_pro ) { ?>
								<li>
									<a id="mwb-rt-skype-link" href="<?php echo esc_url( 'https://join.skype.com/invite/IKVeNkLHebpC' ); ?>" target="_blank">
										<img src="<?php echo esc_url( REPLACE_TEXT_DIR_URL . 'admin/images/skype_logo.png' ); ?>" style="height: 15px;width: 15px;" ><?php esc_html_e( 'Chat Now', 'replace-text' ); ?>
									</a>
								</li>
							<?php } ?>
						</ul>
					</div>
				</div>
			</div>
		</div>

		<div class="mwb-rt-main-template">
			<div class="mwb-rt-body-template">
				<div class="mwb-rt-navigator-template">
					<div class="mwb-rt-navigations">
						<?php
						if ( is_array( $rt_default_tabs ) && ! empty( $rt_default_tabs ) ) {

							foreach ( $rt_default_tabs as $rt_tab_key => $rt_default_tabs ) {

								$rt_tab_classes = 'mwb-rt-nav-tab ';

								if ( ! empty( $rt_active_tab ) && $rt_active_tab === $rt_tab_key ) {
									$rt_tab_classes .= 'rt-nav-tab-active';
								}
								?>
								
								<div class="mwb-rt-tabs">
									<a class="<?php echo esc_attr( $rt_tab_classes ); ?>" id="<?php echo esc_attr( $rt_tab_key ); ?>" href="<?php echo esc_url( admin_url( 'admin.php?page=replace_text_menu' ) . '&rt_tab=' . esc_attr( $rt_tab_key ) ); ?>"><?php echo esc_html( $rt_default_tabs['title'] ); ?></a>
								</div>

								<?php
							}
						}
						?>
					</div>
				</div>

				<div class="mwb-rt-content-template">
					<div class="mwb-rt-content-container">
						<?php
							// if submenu is directly clicked on woocommerce.
						if ( empty( $rt_active_tab ) ) {

							$rt_active_tab = 'mwb_rt_plug_general';
						}

							// look for the path based on the tab id in the admin templates.
						$rt_tab_content_path = 'admin/partials/' . $rt_active_tab . '.php';

						$rt_mwb_rt_obj->mwb_rt_plug_load_template( $rt_tab_content_path );
						?>
					</div>
				</div>
			</div>
		</div>
	</div>
