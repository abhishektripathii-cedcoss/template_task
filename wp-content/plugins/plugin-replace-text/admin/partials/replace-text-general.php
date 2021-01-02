<?php
/**
 * Provide a admin area view for the plugin
 *
 * This file is used to markup the html field for general tab.
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
global $rt_mwb_rt_obj;
$rt_genaral_settings = apply_filters( 'rt_general_settings_array', array() );
?>
<!--  template file for admin settings. -->
<div class="rt-secion-wrap">
	<table class="form-table rt-settings-table">
		<?php
			$rt_general_html = $rt_mwb_rt_obj->mwb_rt_plug_generate_html( $rt_genaral_settings );
			echo esc_html( $rt_general_html );
		?>
	</table>
</div>
