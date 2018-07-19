<?php 
	
	// exit if accessed directly
	if (!defined('ABSPATH')) {
		exit;
	}
	
	if (!class_exists('acf_plugin_medium_editor_options')) {
	
		class acf_plugin_medium_editor_options {
			
			private $settings = array();
			
			public function __construct() {
				$this->settings = array(
					'page_title' => __('ACF Medium Editor Settings', 'acf-medium-editor'),
					'menu_title' => __('ACF Med. Editor', 'acf-medium-editor'),
					'menu_slug' => 'acf-medium-editor-options',
					'capability' => 'manage_options',
					'position' => '80.374981',
					'parent_slug' => '',
					'icon_url' => '',
					'redirect' => false,
					'post_id' => 'options',
					'autoload' => true
				);
				add_action('init', array($this, 'acf_options_page'));
				add_action('admin_menu', array($this, 'menu_page'), 9);
				add_action('admin_menu', array($this, 'remove_duplicate_admin_menu'), 100);
			} // end public function __construct
			
			public function acf_options_page() {
				acf_add_options_page($this->settings);
			} // end public function acf_options_page
			
			public function menu_page() {
				// all of these arguments are identical to the arguments
				// used to create in the function acf_add_options_page() 
				$page_title = $this->settings['page_title'];
				$menu_title = $this->settings['menu_title'];
				$capability = $this->settings['capability'];
				$position = $this->settings['position'];
				$menu_slug = $this->settings['menu_slug'];
				$callback = '';
				$icon = $this->settings['icon_url'];
				add_menu_page($page_title, $menu_title, $capability, $menu_slug, $callback, $icon, $position);
			}  // end public function menu_page
			
			public function remove_duplicate_admin_menu() {
				global $menu;
				// loop trrough the menu and remove one of the duplicates
				// this loop is looking for the page slug
				foreach ($menu as $key => $values) {
					if ($values[2] == 'acf-medium-editor-options') {
						// found our slug, unset the menu item and exit
						unset($menu[$key]);
						break;
					}
				}
			} // end public function remove_duplicate_admin_menu
			
		} // end class acf_plugin_medium_editor_options
		
		new acf_plugin_medium_editor_options();
	
	}  // class_exists check
	
?>