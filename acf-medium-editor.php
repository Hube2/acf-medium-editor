<?php

	/*
		Plugin Name: ACF Medium Editor Field
		Plugin URI: https://wordpress.org/plugins/acf-medium-editor-field/
		Description: Medium Editor Field for ACF 5
		Version: 2.4.0
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
					'version'	=> '2.4.0',
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
				add_filter('jh_plugins_list', array($this, 'meta_box_data'));
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
			
			function meta_box_data($plugins=array()) {
				
				$plugins[] = array(
					'title' => 'ACF Medium Editor Field',
					'screens' => array('acf-field-group', 'edit-acf-field-group'),
					'doc' => 'https://github.com/Hube2/acf-medium-editor/'
				);
				return $plugins;
				
			} // end function meta_box
			
		}
		
		
		// initialize
		new acf_plugin_medium_editor();
	
	
	// class_exists check
	endif;
	
	if (!function_exists('jh_plugins_list_meta_box')) {
		function jh_plugins_list_meta_box() {
			if (apply_filters('remove_hube2_nag', false)) {
				return;
			}
			$plugins = apply_filters('jh_plugins_list', array());
				
			$id = 'plugins-by-john-huebner';
			$title = '<a style="text-decoration: none; font-size: 1em;" href="https://github.com/Hube2" target="_blank">Plugins by John Huebner</a>';
			$callback = 'show_blunt_plugins_list_meta_box';
			$screens = array();
			foreach ($plugins as $plugin) {
				$screens = array_merge($screens, $plugin['screens']);
			}
			$context = 'side';
			$priority = 'low';
			add_meta_box($id, $title, $callback, $screens, $context, $priority);
			
			
		} // end function jh_plugins_list_meta_box
		add_action('add_meta_boxes', 'jh_plugins_list_meta_box');
			
		function show_blunt_plugins_list_meta_box() {
			$plugins = apply_filters('jh_plugins_list', array());
			?>
				<p style="margin-bottom: 0;">Thank you for using my plugins</p>
				<ul style="margin-top: 0; margin-left: 1em;">
					<?php 
						foreach ($plugins as $plugin) {
							?>
								<li style="list-style-type: disc; list-style-position:">
									<?php 
										echo $plugin['title'];
										if ($plugin['doc']) {
											?> <a href="<?php echo $plugin['doc']; ?>" target="_blank">Documentation</a><?php 
										}
									?>
								</li>
							<?php 
						}
					?>
				</ul>
				<p><a href="https://www.paypal.com/cgi-bin/webscr?cmd=_donations&business=hube02%40earthlink%2enet&lc=US&item_name=Donation%20for%20WP%20Plugins%20I%20Use&no_note=0&cn=Add%20special%20instructions%20to%20the%20seller%3a&no_shipping=1&currency_code=USD&bn=PP%2dDonationsBF%3abtn_donateCC_LG%2egif%3aNonHosted" target="_blank">Please consider making a small donation.</a></p><?php 
		}
	} // end if !function_exists
	
?>
