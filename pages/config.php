<?php
form_security_validate( 'plugin_EmailExport_config' );
access_ensure_global_level( config_get( 'manage_plugin_threshold' ) );

/**
 * Sets plugin config option if value is different from current/default
 * @param string $p_name  option name
 * @param string $p_value value to set
 * @return void
 */
function config_set_if_needed( $p_name, $p_value ) {
	if ( $p_value != plugin_config_get( $p_name ) ) {
		plugin_config_set( $p_name, $p_value );
	}
}

$t_redirect_url = plugin_page( 'config_page', true );
layout_page_header( null, $t_redirect_url );
layout_page_begin();

config_set_if_needed( 'export_threshold' , gpc_get_int( 'export_threshold' ) );
config_set_if_needed( 'email_theme' , gpc_get_string( 'email_theme' ) );
config_set_if_needed( 'email_text' , gpc_get_string( 'email_text' ) );
config_set_if_needed( 'email_from' , gpc_get_string( 'email_from' ) );

form_security_purge( 'plugin_EmailExport_config' );

html_operation_successful( $t_redirect_url );
layout_page_end();
