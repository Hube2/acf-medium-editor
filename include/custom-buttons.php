<?php 
	
	
	// exit if accessed directly
	if (!defined('ABSPATH')) {
		exit;
	}
	
	if (!class_exists('acf_plugin_medium_editor_buttons')) {
		
		class acf_plugin_medium_editor_buttons {
			
			public function __construct() {
				add_action('init', array($this, 'post_type'));
			} // end public function __construct
			
			public function post_type() {
				$post_type = 'acf-med-edit-button';
				$labels = array(
					// many of these won't be used
					// included for completeness
					// you never know
					'name' => __('ACF Medium Editor Custom Buttons', 'acf-medium-editor'),
					'singular_name' => __('Custom Button', 'acf-medium-editor'),
					'add_new' => __('Add New', 'acf-medium-editor'),
					'add_new_item' => __('Add New Button', 'acf-medium-editor'),
					'edit_item' => __('Edit Button', 'acf-medium-editor'),
					'new_item' => __('New Button', 'acf-medium-editor'),
					'view_item' => __('View Button', 'acf-medium-editor'),
					'view_items' => __('View Buttons', 'acf-medium-editor'),
					'search_items' => __('Search Buttons', 'acf-medium-editor'),
					'not_found' => __('No Buttons Found', 'acf-medium-editor'),
					'not_found_in_trash' => __('No Buttons Found in Trash', 'acf-medium-editor'),
					'all_items' => __('Custom Buttons', 'acf-medium-editor'),
					'filter_items_list' => __('Filter Buttons', 'acf-medium-editor'),
					'items_list_navigation' => __('Buttons List Navigation', 'acf-medium-editor'),
					'items_list' => __('Buttons List', 'acf-medium-editor')
				);
				$capabilities = array(
					'edit_post'			=> 'manage_options',
					'delete_post'		=> 'manage_options',
					'edit_posts'		=> 'manage_options',
					'delete_posts'		=> 'manage_options'
				);
				$supports = array(
					'title',
					'revisions'
				);
				$args = array(
					'label' => __('Custom Buttons', 'acf-medium-editor'),
					'labels' => $labels,
					'description' => __('Custom Buttons for ACF Medium Editor', 'acf-medium-editor'),
					'public' => false,
					'hierarchical' => false,
					'exclude_from_search' => true,
					'publicly_queryable' => false,
					'show_ui' => true,
					'show_in_menu' => 'acf-medium-editor-options',
					'show_in_nav_menus' => false,
					'show_in_admin_bar' => false,
					'show_in_rest' => false,
					'capability_type' => 'post',
					'capabilities' => $capabilities,
					'supports' => $supports,
					'has_archive' => false,
					'rewrite' => false,
					'query_var' => false
				);
				register_post_type($post_type, $args);
			} // end public function post_type
			
		} // end class acf_plugin_medium_editor_buttons
		
		new acf_plugin_medium_editor_buttons();
		
	} // end class check
	
?>