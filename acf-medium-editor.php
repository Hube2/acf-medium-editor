<?php

	/*
		Plugin Name: ACF Medium Editor Field
		Plugin URI: https://wordpress.org/plugins/acf-medium-editor-field/
		Description: Medium Editor Field for ACF 5
		Version: 2.6.0
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
					'version'	=> '2.6.0',
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
