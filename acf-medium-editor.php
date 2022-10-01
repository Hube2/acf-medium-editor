<?php

	/*
		Plugin Name: ACF Medium Editor Field
		Plugin URI: https://wordpress.org/plugins/acf-medium-editor-field/
		Description: Medium Editor Field for ACF 5
		Version: 2.6.1
		Author: John A. Huebner II
		Text Domain: acf-medium-editor
		Author URI: https://github.com/Hube2
		
	*/
	
	// exit if accessed directly
	if (!defined('ABSPATH')) {
		exit;
	}
	
	
	// check if class already exists
	if (!class_exists('acf_plugin_medium_editor')) :
	
		class acf_plugin_medium_editor {
			
			/*
			*  __construct
			*
			*  This function will setup the class functionality
			*
			*  @type	function
			*  @date	17/02/2016
			*  @since	1.0.0
			*
			*  @param	n/a
			*  @return	n/a
			*/
			
			function __construct() {
				
				// vars
				$this->settings = array(
					'version'	=> '2.6.1',
					'url'		=> plugin_dir_url(__FILE__),
					'path'		=> plugin_dir_path(__FILE__)
				);
				
				
				// set text domain
				// https://codex.wordpress.org/Function_Reference/load_plugin_textdomain
				load_plugin_textdomain('acf-medium-editor', false, plugin_basename(dirname(__FILE__)) . '/languages'); 
				
				
				// include field
				add_action('acf/include_field_types', 	array($this, 'include_field_types')); // v5
				
				// v4 not supported
				//add_action('acf/register_fields', 		array($this, 'include_field_types')); // v4
				
				add_action('admin_notices', array($this, 'admin_notice'));
			}
			
			function admin_notice() {
				$screen = get_current_screen();
				if ($screen->id != 'plugins') {
					return;
				}
				?>
					<div class="notice notice-error">
						<p>
							<strong>IMPORTANT NOTICE FOR ACF MEDIUM EDITOR FIELD USERS</strong><br />
							The ACF Medium Editor Field is not compatible with ACF Version 6<br />
							I am currently working on making this plugin compatible with ACF 6.<br />
							If you have already updated to ACF V6 you will need to revert to ACF V5 to continue using
							Medium Editor fields until an update to this plugin for V6 is available.<br/>
						</p>
						<p>
							In addition to the this when an update for ACF6 is available it will no longer support custom buttons
							in the editor. Custom buttons will only be supported using the acf/medium-editor-field/custom-buttons
							filter hook as described in the documentation.
						</p>
						<p>
							If you have any questions or need help please use the
							<a href="https://wordpress.org/support/plugin/acf-medium-editor-field/" target="_blank">support forum</a>.
						</p>
					</div>
				<?php 
			}
			
			
			/*
			*  include_field_types
			*
			*  This function will include the field type class
			*
			*  @type	function
			*  @date	17/02/2016
			*  @since	1.0.0
			*
			*  @param	$version (int) major ACF version. Defaults to false
			*  @return	n/a
			*/
			
			function include_field_types($version = false) {
				
				// support empty $version
				if (!$version) $version = 4;
				
				
				// include
				include_once('fields/acf-medium-editor-v' . $version . '.php');
				
			}
			
		}
		
		
		// initialize
		new acf_plugin_medium_editor();
	
	
	// class_exists check
	endif;
	
?>
