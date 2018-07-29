<?php 
	
	
	// exit if accessed directly
	if (!defined('ABSPATH')) {
		exit;
	}
	
	if (!class_exists('acf_plugin_medium_editor_buttons')) {
		
		class acf_plugin_medium_editor_buttons {
		
			private $post_type = 'acf-med-edit-button';
			
			public function __construct() {
				add_action('init', array($this, 'post_type'));
				add_filter('manage_edit-'.$this->post_type.'_columns', array($this, 'admin_columns'), 10, 1);
				add_action('manage_'.$this->post_type.'_posts_custom_column', 'admin_columns_content', 10, 2 );
				add_action('acf/init', array($this, 'button_field_group'));
			} // end public function __construct
			
			public function admin_columns($columns) {
				$new_columns = array();
				foreach ($columns as $index => $column) {
					if ($index == 'date') {
						$new_columns['name'] = __('Name', 'acf-medium-editor');
						$new_columns['label'] = __('Label', 'acf-medium-editor');
						$new_columns['html'] = __('HTML', 'acf-medium-editor');
					} else {
						$new_columns[$index] = $column;
					}
				}
				return $new_columns;
			} // end public function admin_columns
			
			public function admin_columns_content($column, $post_id) {
				switch ($column) {
					case 'name':
						echo 'NAME';
						break;
					case 'label':
						echo 'LABEL';
						break;
					case 'html':
						echo 'HTML';
						break;
					default:
						// do nothing
						break;
				} // end switch
			} // end public function admin_columns_content
			
			public function post_type() {
				$labels = array(
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
				register_post_type($this->post_type, $args);
			} // end public function post_type
			
			public function button_field_group() {
				$args = array(
					'key' => 'group_acfmededitbtngrp',
					'title' => __('Custom Button Settings', 'acf-medium-editor'),
					'fields' => array(
						array(
							'key' => 'field_mededitbtnntitle',
							'label' => __('Button Title', 'acf-medium-editor'),
							'name' => 'title',
							'type' => 'text',
							'instructions' => __('Give your button a unique, identifying title. This title will be displayed for selection of custom buttons when setting up a Medium Editor field in an ACF field group.', 'acf-medium-editor'),
							'required' => 1,
							'conditional_logic' => 0,
							'wrapper' => array(
								'width' => '',
								'class' => '',
								'id' => '',
							),
							'default_value' => '',
							'placeholder' => '',
							'prepend' => '',
							'append' => '',
							'maxlength' => '',
						),
						array(
							'key' => 'field_mededitbtnnname',
							'label' => __('Button Name', 'acf-medium-editor'),
							'name' => 'name',
							'type' => 'text',
							'instructions' => __('Give your button a name. This name must contain only lower case letters, numbers and underscores and it must begin with a letter. This is the name that will identify your button for Medium Editor. This value should be unique, but it doe not need to be. When Medium Editor encounters two buttons with the same name the latter buttons will be ignored.', 'acf-medium-editor'),
							'required' => 1,
							'conditional_logic' => 0,
							'wrapper' => array(
								'width' => '',
								'class' => '',
								'id' => '',
							),
							'default_value' => '',
							'placeholder' => '',
							'prepend' => '',
							'append' => '',
							'maxlength' => '',
						),
						array(
							'key' => 'field_mededitbtnlabel',
							'label' => __('Button Label', 'acf-medium-editor'),
							'name' => 'label',
							'type' => 'text',
							'instructions' => __('The Label for the Button that will appear on the button bar. This field can contain HTML markup. For more information see <a href="https://github.com/arcs-/MediumButton" target="_blank">MediumButton</a>. For Font-Awesome or other icon support the icon font set must be installed and included in the admin pages of your site.', 'acf-medium-editor'),
							'required' => 1,
							'conditional_logic' => 0,
							'wrapper' => array(
								'width' => '',
								'class' => '',
								'id' => '',
							),
							'default_value' => '',
							'placeholder' => '',
							'prepend' => '',
							'append' => '',
							'maxlength' => '',
						),
						array(
							'key' => 'field_mededitbtntag',
							'label' => __('Button Tag', 'acf-medium-editor'),
							'name' => 'tag',
							'type' => 'text',
							'instructions' => __('Enter any valid, non-empty HTML tag type to wrap selected text with. Invalid HTML tags will be ignored. See documentation for allowed HTML tags.', 'acf-medium-editor'),
							'required' => 1,
							'conditional_logic' => 0,
								'wrapper' => array(
								'width' => '',
								'class' => '',
								'id' => '',
							),
							'default_value' => 'span',
							'placeholder' => '',
							'prepend' => '',
							'append' => '',
							'maxlength' => '',
						),
						array(
							'key' => 'field_mededitbtnattr',
							'label' => __('HTML Attributes', 'acf-medium-editor'),
							'name' => 'attributes',
							'type' => 'repeater',
							'instructions' => __('Add attributes to the html tag.<br /><em>(any attributes that do not have both a name and a value will be ignored. additionally, attribute names must start with a letter and contain only letters, numbers or dash characters and attribute values must not contain any double quotes.)</em>', 'acf-medium-editor'),
							'required' => 0,
							'conditional_logic' => 0,
							'wrapper' => array(
								'width' => '',
								'class' => '',
								'id' => '',
							),
							'collapsed' => '',
							'min' => 0,
							'max' => 0,
							'layout' => 'table',
							'button_label' => '',
							'sub_fields' => array(
								array(
									'key' => 'field_mededitbtnattrname',
									'label' => __('Name', 'acf-medium-editor'),
									'name' => 'name',
									'type' => 'text',
									'instructions' => '',
									'required' => 1,
									'conditional_logic' => 0,
									'wrapper' => array(
										'width' => '',
										'class' => '',
										'id' => '',
									),
									'default_value' => '',
									'placeholder' => '',
									'prepend' => '',
									'append' => '',
									'maxlength' => '',
								),
								array(
									'key' => 'field_mededitbtnattrval',
									'label' => __('Value', 'acf-medium-editor'),
									'name' => 'value',
									'type' => 'text',
									'instructions' => '',
									'required' => 1,
									'conditional_logic' => 0,
									'wrapper' => array(
										'width' => '',
										'class' => '',
										'id' => '',
									),
									'default_value' => '',
									'placeholder' => '',
									'prepend' => '',
									'append' => '',
									'maxlength' => '',
								),
							),
						),
					),
					'location' => array(
						array(
							array(
							'param' => 'post_type',
							'operator' => '==',
							'value' => 'acf-med-edit-button',
							),
						),
					),
					'menu_order' => 0,
					'position' => 'acf_after_title',
					'style' => 'default',
					'label_placement' => 'left',
					'instruction_placement' => 'label',
					'hide_on_screen' => array(
						0 => 'permalink',
						1 => 'the_content',
						2 => 'excerpt',
						3 => 'discussion',
						4 => 'comments',
						5 => 'slug',
						6 => 'author',
						7 => 'format',
						8 => 'page_attributes',
						9 => 'featured_image',
						10 => 'categories',
						11 => 'tags',
						12 => 'send-trackbacks',
					),
					'active' => 1,
					'description' => ''
				);
				acf_add_local_field_group($args);
			} // end public function button_field_group
			
		} // end class acf_plugin_medium_editor_buttons
		
		new acf_plugin_medium_editor_buttons();
		
	} // end class check
	
?>