<?php

class EmailExportPlugin extends MantisPlugin {

	/**
	 * A method that populates the plugin information and minimum requirements.
	 * @return void
	 */
	function register() {
		$this->name = plugin_lang_get('title');
		$this->description = plugin_lang_get('description');
		$this->page = "config_page";

		$this->version = '0.0.1';
		$this->requires = array(
		    'MantisCore' => '2.0.0',
		);

		$this->author = 'Evgeny Khryukin';
		$this->contact = 'wadealer@gmail.com';
		$this->url = 'https://www.unitwest.com.ua';
	}

	/**
	 * Default plugin configuration.
	 * @return array
	 */
	public function config() {
		return array(
		    "export_threshold" => MANAGER,
		    "email_theme" => plugin_lang_get('email_theme'),
		    "email_text" => plugin_lang_get('email_text'),
		    "email_from" => config_get('from_email'),
		    "email_to" => "",
		    
		);
	}

	/**
	 * Plugin hooks
	 * @return array
	 */
	function hooks() {
		$t_hooks = array(
		    'EVENT_MENU_FILTER' => 'export_issues_menu',
		);
		return $t_hooks;
	}

	/**
	 * Export Issues Menu
	 * @return array
	 */
	function export_issues_menu() {
		if (!access_has_project_level(plugin_config_get('export_threshold'))) {
			return array();
		}
		return array('<a class="btn btn-sm btn-primary btn-white btn-round" href="' . plugin_page('export_page') . '">' . plugin_lang_get('export') . '</a>',);
	}

	/**
	 * Plugin Installation
	 * @return boolean
	 */
	function install() {
		/* $t_result = extension_loaded( 'xmlreader' ) && extension_loaded( 'xmlwriter' );
		  if( !$t_result ) {
		  # @todo returning false should trigger some error reporting, needs rethinking error_api
		  error_parameters( plugin_lang_get( 'error_no_xml' ) );
		  trigger_error( ERROR_PLUGIN_INSTALL_FAILED, ERROR );
		  }
		  return $t_result; */

		return true;
	}

}
