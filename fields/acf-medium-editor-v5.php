<?php

	// exit if accessed directly
	if (!defined('ABSPATH')) {
		exit;
	}


	// check if class already exists
	if (!class_exists('acf_medium_editor_field')) :


		class acf_medium_editor_field extends acf_field {
			
			
			/*
			*  __construct
			*
			*  This function will setup the field type data
			*
			*  @type	function
			*  @date	5/03/2014
			*  @since	5.0.0
			*
			*  @param	n/a
			*  @return	n/a
			*/
						
			private $doc_link = '';
			private $button_types = array();
			
			function __construct($settings) {
				
				$this->name = 'medium_editor';
				$this->category = 'content';
				$this->label = __('Medium Editor', 'acf-medium-editor');
				$this->defaults = array(
					'standard_buttons' => array(
						'bold', 'italic', 'underline', 'removeFormat'
					),
					'other_options' => array('disableReturn', 'disableDoubleReturn', 'disableExtraSpaces'),
					'placeholder' => '',
					'default_value'	=> ''
				);


				$this->button_types = array(
					'bold' => array(
						'name' => 'bold',
						'contentDefault' => '<b title="'.__('Bold', 'acf-medium-editor').'"><i class="dashicons dashicons-editor-bold"></i></b>'
					),
					'italic' => array(
						'name' => 'italic',
						'contentDefault' => '<b title="'.__('Italic', 'acf-medium-editor').'"><i class="dashicons dashicons-editor-italic"></i></b>'
					),
					'underline' => array(
						'name' => 'underline',
						'contentDefault' => '<b title="'.__('Underline', 'acf-medium-editor').'"><i class="dashicons dashicons-editor-underline"></i></b>'
					),
					'strikethrough' => array(
						'name' => 'strikethrough',
						'contentDefault' => '<b title="'.__('Strikethrough', 'acf-medium-editor').'"><i class="dashicons dashicons-editor-strikethrough"></i></b>'
					),
					'subscript' => array(
						'name' => 'subscript',
						'contentDefault' => '<b title="'.__('Subscript', 'acf-medium-editor').'">x<sub>1</sub></b>'
					),
					'superscript' => array(
						'name' => 'superscript',
						'contentDefault' => '<b title="'.__('Superscript', 'acf-medium-editor').'">x<sup>1</sup></b>'
					),
					'anchor' => array(
						'name' => 'anchor',
						'contentDefault' => '<b title="'.__('Anchor', 'acf-medium-editor').'"><i class="dashicons dashicons-admin-links"></i></b>'
					),
					'image' => array(
						'name' => 'image',
						'contentDefault' => '<b title="'.__('Image', 'acf-medium-editor').'"><i class="dashicons dashicons-format-image"></i></b>'
					),
					'quote' => array(
						'name' => 'quote',
						'contentDefault' => '<b title="'.__('Blockquote', 'acf-medium-editor').'"><i class="dashicons dashicons-editor-quote"></i></b>'
					),
					'pre' => array(
						'name' => 'pre',
						'contentDefault' => '<b title="'.__('Code', 'acf-medium-editor').'"><i class="dashicons dashicons-editor-code"></i></b>'
					),
					'orderedlist' => array(
						'name' => 'orderedlist',
						'contentDefault' => '<b title="'.__('Numbered list', 'acf-medium-editor').'"><i class="dashicons dashicons-editor-ol"></i></b>'
					),
					'unorderedlist' => array(
						'name' => 'unorderedlist',
						'contentDefault' => '<b title="'.__('Bullet list', 'acf-medium-editor').'"><i class="dashicons dashicons-editor-ul"></i></b>'
					),
					'indent' => array(
						'name' => 'indent',
						'contentDefault' => '<b title="'.__('Increase indent', 'acf-medium-editor').'"><i class="dashicons dashicons-editor-indent"></i></b>'
					),
					'outdent' => array(
						'name' => 'outdent',
						'contentDefault' => '<b title="'.__('Decrease indent', 'acf-medium-editor').'"><i class="dashicons dashicons-editor-outdent"></i></b>'
					),
					'justifyLeft' => array(
						'name' => 'justifyLeft',
						'contentDefault' => '<b title="'.__('Align left', 'acf-medium-editor').'"><i class="dashicons dashicons-editor-alignleft"></i></b>'
					),
					'justifyCenter' => array(
						'name' => 'justifyCenter',
						'contentDefault' => '<b title="'.__('Align center', 'acf-medium-editor').'"><i class="dashicons dashicons-editor-aligncenter"></i></b>'
					),
					'justifyRight' => array(
						'name' => 'justifyRight',
						'contentDefault' => '<b title="'.__('Align right', 'acf-medium-editor').'"><i class="dashicons dashicons-editor-alignright"></i></b>'
					),
					'justifyFull' => array(
						'name' => 'justifyFull',
						'contentDefault' => '<b title="'.__('Justify', 'acf-medium-editor').'"><i class="dashicons dashicons-editor-justify"></i></b>'
					),
					'h1' => array(
						'name' => 'h1',
						'contentDefault' => '<b title="'.__('Heading type 1', 'acf-medium-editor').'">H1</b>'
					),
					'h2' => array(
						'name' => 'h2',
						'contentDefault' => '<b title="'.__('Heading type 2', 'acf-medium-editor').'">H2</b>'
					),
					'h3' => array(
						'name' => 'h3',
						'contentDefault' => '<b title="'.__('Heading type 3', 'acf-medium-editor').'">H3</b>'
					),
					'h4' => array(
						'name' => 'h4',
						'contentDefault' => '<b title="'.__('Heading type 4', 'acf-medium-editor').'">H4</b>'
					),
					'h5' => array(
						'name' => 'h5',
						'contentDefault' => '<b title="'.__('Heading type 5', 'acf-medium-editor').'">H5</b>'
					),
					'h6' => array(
						'name' => 'h6',
						'contentDefault' => '<b title="'.__('Heading type 6', 'acf-medium-editor').'">H6</b>'
					),
					'html' => array(
						'name' => 'html',
						'contentDefault' => '<b title="'.__('HTML', 'acf-medium-editor').'"><i class="dashicons dashicons-arrow-right" style="position: absolute; color: #7f8b99;"></i><i class="dashicons dashicons-editor-code"></i></b>'
					),
					'removeFormat' => array(
						'name' => 'removeFormat',
						'contentDefault' => '<b title="'.__('Clear formating', 'acf-medium-editor').'"><i class="dashicons dashicons-editor-removeformatting"></i></b>'
					)
				);

				$this->other_options = array(
					'disableReturn',
					'disableDoubleReturn',
					'disableExtraSpaces',
					'disableEditing',
					'spellcheck',
					'targetBlank',
					'allowBreakInSingleLineInput'
				);

				$this->valid_tags = array(
					'abbr',
					'acronym',
					'address',
					'article',
					'asside',
					'b',
					'bdi',
					'bdo',
					'blockquote',
					'button',
					'caption',
					'cite',
					'code',
					//'dd',
					'del',
					'details',
					'dfn',
					'div',
					//'dl',
					//'dt',
					'em',
					//'figcaption',
					//'figure',
					'footer',
					'h1',
					'h2',
					'h3',
					'h4',
					'h5',
					'h6',
					'header',
					'i',
					'ins',
					//'li',
					'main',
					'mark',
					'meta',
					//'ol',
					'p',
					'pre',
					'q',
					's',
					'samp',
					'section',
					'small',
					'span',
					'strong',
					'sub',
					'sup',
					'summary',
					//'table',
					//'tbody',
					//'td',
					//'tfoot',
					//'th',
					//'thead',
					'time',
					//'tr',
					'u',
					//'ul',
					'var',
					'wbr'
				);
				
				/*
				*  l10n (array) Array of strings that are used in JavaScript. This allows JS strings to be translated in PHP and loaded via:
				*  var message = acf._e('medium_editor', 'error');
				*/
				$this->l10n = array(
					//'error'	=> __('Error! Please enter a higher value', 'acf-medium-editor'),
				);
				
				$this->settings = $settings;
				
				// do not delete!
				parent::__construct();
				
				//add_action('admin_head', array($this, 'admin_head'));
			} // end function __construct
			
			function render_field_settings($field) {
				
				$args = array(
					'label'			=> __('Default Value', 'acf'),
					'instructions'	=> __('Appears when creating a new post', 'acf'),
					'type'			=> 'textarea',
					'name'			=> 'default_value',
				);
				acf_render_field_setting($field, $args, false);
				
				$args = array(
					'label'			=> __('Placeholder Text', 'acf'),
					'instructions'	=> __('Appears within the input', 'acf'),
					'type'			=> 'text',
					'name'			=> 'placeholder',
				);
				acf_render_field_setting($field, $args, false);

				foreach ($this->button_types as $std_button) {
					$btn_choices[$std_button['name']] = $std_button['contentDefault'];
				}
				
				$args = array(
					'type' => 'checkbox',
					'label' => __('Buttons', 'acf-medium-editor'),
					'name' => 'standard_buttons',
					'instructions'	=> __('Select the standard buttons that you want to include for medium-editor.', 'acf-medium-editor'),
					'required' => 0,
					'default_value' => array('bold', 'italic', 'underline', 'removeFormat'),
					'choices' => $btn_choices,
					'layout' => 'horizontal'
				);
				acf_render_field_setting($field, $args, false);
				
				$args = array(
					'type' => 'repeater',
					'label' => __('Custom Buttons', 'acf-medium-editor'),
					'name' => 'custom_buttons',
					'instructions' => __('Create Custom Buttons to be added to Button Bar.<br /><br /><em>(any buttons with missing values in any fields will be ignored when generating the button bar.)</em>', 'acf-medium-editor'),
					'layout' => 'block',
					'button_label' => __('Add Button', 'acf-medium-editor'),
					'sub_fields' => array(
						array(
							'key' => 'name',
							'type' => 'text',
							'required' => 0,
							'label' => __('Name', 'acf-medium-editor'),
							'name' => 'name',
							'instructions' => __('Each button must have a unique name. Buttons with names that are duplicates of any other button in this button bar will be ignored.', 'acf-medium-editor'),
						),
						array(
							'key' => 'label',
							'type' => 'text',
							'required' => 0,
							'label' => __('Label', 'acf-medium-editor'),
							'name' => 'label',
							'instructions' => __('The Label for the Button that will appear on the button bar. This field can contain HTML markup. For more information see <a href="https://github.com/arcs-/MediumButton" target="_blank">MediumButton</a>. For Font-Awesome or other icon support the icon font set must be installed and included in the admin pages of your site.', 'acf-medium-editor'),
						),
						array(
							'key' => 'tag',
							'type' => 'text',
							'required' => 0,
							'label' => __('HTML Tag', 'acf-medium-editor'),
							'name' => 'start',
							'instructions' => __('Enter any valid, non-empty HTML tag type to wrap selected text with. Invalid tag names will be ignored. See documentaion for allowed HTML tags.', 'acf-medium-editor'),
						),
						
						array(
							'key' => 'attributes',
							'type' => 'repeater',
							'required' => 0,
							'label' => __('Attributes', 'acf-medium-editor'),
							'name' => 'attributes',
							'layout' => 'row',
							'button_label' => __('Add Attribute', 'acf-medium-editor'),
							'instructions' => __('Add attributes to the html tag.<br /><br /><em>(any attributes that do not have both a name and a value will be ignored. additionally, attribute names must start with a letter and contain only letters, numbers or dash characters and attribute values must not contain any double quotes.)</em>', 'acf-medium-editor'),
							'sub_fields' => array(
								array(
									'key' => 'name',
									'type' => 'text',
									'required' => 0,
									'label' => __('Name', 'acf-medium-editor'),
									'name' => 'name'
								),
								array(
									'key' => 'value',
									'type' => 'text',
									'required' => 0,
									'label' => __('Value', 'acf-medium-editor'),
									'name' => 'value'
								),
							)
						),
					)
				);
				acf_render_field_setting($field, $args, false);
				
				$args = array(
					'choices' => array(
						'disableReturn' => 'disableReturn',
						'disableDoubleReturn' => 'disableDoubleReturn',
						'disableExtraSpaces' => 'disableExtraSpaces',
						'disableEditing' => 'disableEditing',
						'spellcheck' => 'spellcheck',
						'targetBlank' => 'targetBlank',
						'allowBreakInSingleLineInput' => 'allowBreakInSingleLineInput'
					),
					'layout' => 'horizontal',
					'label'			=> __('Other Medium Editor Options', 'acf-medium-editor'),
					'instructions'	=> __('Activation of an option will set that option to true. See medium-editor options.', 'acf-medium-editor'),
					'type'			=> 'checkbox',
					'name'			=> 'other_options'
				);
				acf_render_field_setting($field, $args, false);
				
				// delay
				$args = array(
					'label'			=> __('Delay initialization?', 'acf-medium-editor'),
					'instructions'	=> __('Medium Editor will not be initalized until field is clicked', 'acf-medium-editor'),
					'name'			=> 'delay',
					'type'			=> 'true_false',
					'ui'			=> 1,
				);
				acf_render_field_setting($field, $args);
		
			}
			
			function render_field($field) {
				
				// echo '<pre>'; print_r($field); echo '</pre>';
				// vars
				$atts = array();
				$o = array('id', 'class', 'name');
				$s = array('readonly', 'disabled');
				$e = '';
				// append atts
				foreach( $o as $k ) {
					$atts[ $k ] = $field[ $k ];	
				}
				// append special atts
				foreach( $s as $k ) {
					if( !empty($field[ $k ]) ) $atts[ $k ] = $k;
				}
				$e .= '<textarea '.acf_esc_attr( $atts ).'>';
				
				
				$value = $field['value'];
				if (isset($field['other_options']) && is_array($field['other_options'])) {
					if (in_array('disableReturn', $field['other_options'])) {
						if (in_array('allowBreakInSingleLineInput', $field['other_options'])) {
							$value = preg_replace('#<(br[^>]*)>#is', '&amp;lt;\1&amp;gt;', $value);
						}
					}
				}
				$value = str_replace('<', '&lt;', $value);
				$value = str_replace('>', '&gt;', $value);
				
				
				$e .= $value;
				$e .= '</textarea>';
				$e .= '<span class="note">'.apply_filters('acf-medium-editor/field-instructions', __('(select text for formatting options)', 'acf-medium-editor')).'</span>';
				
				echo $e;
				
				$custom_buttons = $field['custom_buttons'];
				if (empty($custom_buttons)) {
					$custom_buttons = array();
				}
				
				$custom_buttons = apply_filters('acf/medium-editor-field/custom-buttons', $custom_buttons, $field);
				$custom_buttons = apply_filters('acf/medium-editor-field/custom-buttons/name='.$field['name'], $custom_buttons, $field);
				$custom_buttons = apply_filters('acf/medium-editor-field/custom-buttons/key='.$field['key'], $custom_buttons, $field);
				
				$buttons = array();
				$removeFormat = false;
				foreach ($field['standard_buttons'] as $button) {
					if ($button == 'removeFormat') {
						$removeFormat = true;
					} else {
						$buttons[$button] = $button;
					}
				}
				
				// add custom buttons
				$extensions = array();
				if (is_array($custom_buttons) && count($custom_buttons)) {
					foreach ($custom_buttons as $button) {
						if (!in_array($button['tag'], $this->valid_tags) || empty($button['name']) || empty($button['label'])) {
							continue;
						}
						if (!in_array($button['name'], $buttons)) {
							$name = $button['name'];
							$buttons[$name] = $name;
							$label = $button['label'];
							$start = '<'.$button['tag'];
							if (!empty($button['attributes']) && is_array($button['attributes']) && count($button['attributes'])) {
								foreach ($button['attributes'] as $attribute) {
									if (!empty($attribute['name']) && !empty($attribute['value'])) {
										$attrib_name = $attribute['name'];
										$attrib_value = $attribute['value'];
										if (preg_match('/^[a-z]/i', $attrib_name) && !preg_match('/[^-a-z0-9]/i', $attrib_name) && !preg_match('/"/', $attrib_value)) {
											$start .= ' '.$attribute['name'].'="'.$attribute['value'].'"';
										}
									} // end if !empty
								} // end foreach attr
							} // end if attr
							$start .= '>';
							$end = '</'.$button['tag'].'>';
							$extensions[] = array(
								'name' => $name,
								'settings' => array(
									'label' => $label,
									'start' => $start,
									'end' => $end
								)
							);
						} // end button not already exists
					} // end foreach custom button
				} // end if custom buttons
				
				// add removeFormat button?
				if ($removeFormat) {
					$buttons['removeFormat'] = 'removeFormat';
				}
				
				$buttons = apply_filters('acf/medium-editor-field/buttons', $buttons, $field);
				$buttons = apply_filters('acf/medium-editor-field/buttons/name='.$field['name'], $buttons, $field);
				$buttons = apply_filters('acf/medium-editor-field/buttons/key='.$field['key'], $buttons, $field);
				
				$buttons = array_keys($buttons);

				$dash_buttons = array();

				foreach ($buttons as $dashbuttons) {
					if ( array_key_exists($dashbuttons, $this->button_types) && is_array($this->button_types[$dashbuttons]) ) {
						$dash_buttons[] = array(
							'name' 				=> $this->button_types[$dashbuttons]['name'],
							'contentDefault'	=> $this->button_types[$dashbuttons]['contentDefault']
						);
					} else {
						$dash_buttons[] = $dashbuttons;
					}
				}
				
				$options = array();
				if (empty($field['other_options'])) {
					$field['other_options'] = array();
				} elseif (!is_array($field['other_options'])) {
					$field['other_options'] = array($field['other_options']);
				}
				foreach ($this->other_options as $option) {
					if ($option == 'allowBreakInSingleLineInput') {
						continue;
					}
					if (in_array($option, $field['other_options'])) {
						$options[$option] = true;
					} else {
						$options[$option] = false;
					}
				}
				$delay = 0;
				if (isset($field['delay'])) {
					$delay = intval($field['delay']);
				}
				?>
					<div class="acf-medium-editor-field-data" style="display:none;" data-key="medium_editor_<?php 
						echo $field['key']; ?>" data-buttons="<?php 
						echo str_replace('+', '%20', urlencode(json_encode($dash_buttons))); ?>" data-extensions="<?php 
						echo str_replace('+', '%20', urlencode(json_encode($extensions))); ?>" data-placeholder="<?php 
						echo $field['placeholder']; ?>" data-options="<?php 
						echo str_replace('+', '%20', urlencode(json_encode($options))); ?>" data-delay="<?php 
						echo $delay; ?>"></div>
				<?php 
			}
			
			function input_admin_enqueue_scripts() {
				
				// vars
				$url = $this->settings['url'];
				$version = $this->settings['version'];
				
				$this->doc_link = $url.'doc/';
				
				$min = '.min';
				//$min = '';
				if (defined('SCRIPT_DEBUG') && SCRIPT_DEBUG) {
					$min = '';
				}
				
				wp_register_script('medium-editor', $url.'assets/vendor/medium-editor/js/medium-editor'.$min.'.js', array(), $version);
				wp_enqueue_script('medium-editor');
				
				wp_register_script('medium-button', $url.'assets/vendor/medium-button/src/medium-button'.$min.'.js', array('medium-editor'), $version);
				wp_enqueue_script('medium-button');
				
				wp_register_style('medium-editor', $url.'assets/vendor/medium-editor/css/medium-editor'.$min.'.css', array(), $version);
				wp_enqueue_style('medium-editor');
				
				
				$themes = array('beagle', 'bootstrap', 'default', 'flat', 'mani', 'roman', 'tim');
				//$theme = 'default';
				$theme = 'wordpress';
				if (defined('MEDIUM_EDITOR_THEME')) {
					if (in_array(MEDIUM_EDITOR_THEME, $themes)) {
						$theme = MEDIUM_EDITOR_THEME;
					}
				}
				$theme_filter = apply_filters('medium-editor-theme', $theme);
				if (in_array($theme_filter, $themes)) {
					$theme = $theme_filter;
				}
				if ($theme == 'wordpress') {
					$min = '';
				}
				
				wp_register_style('medium-editor-theme', $url.'assets/vendor/medium-editor/css/themes/'.$theme.$min.'.css', array('medium-editor'), $version);
				wp_enqueue_style('medium-editor-theme');
				
				wp_register_style('medium-editor-input', $url.'assets/css/input.css', array('medium-editor-theme'), $version);
				wp_enqueue_style('medium-editor-input');
				
				$src = $url.'assets/js/input.js';
				// allow override script to be used
				$src = apply_filters('acf-medium-editor-script-src', $src);
				
				wp_register_script('acf-input-medium-editor', $src, array('acf-input'), $version);
				wp_enqueue_script('acf-input-medium-editor');
				
				// enqueue custom editor stylesheet(s)
				$child_dep = array();
				if (file_exists(get_template_directory().'/medium-editor-style.css')) {
					wp_enqueue_style('medium-editor-style', get_template_directory_uri().'/medium-editor-style.css');
					$child_dep[] = 'medium-editor-style';
				}
				if (is_child_theme() && file_exists(get_stylesheet_directory().'/medium-editor-style.css')) {
					wp_enqueue_style('medium-editor-style-child', get_stylesheet_directory_uri().'/medium-editor-style.css', $child_dep);
				}
				
			}
			
			
			/*
			*  input_admin_head()
			*
			*  This action is called in the admin_head action on the edit screen where your field is created.
			*  Use this action to add CSS and JavaScript to assist your render_field() action.
			*
			*  @type	action (admin_head)
			*  @since	3.6
			*  @date	23/01/13
			*
			*  @param	n/a
			*  @return	n/a
			*/
		
			/*
				
			function input_admin_head() {
			
				
				
			}
			
			*/
			
			
			/*
				*  input_form_data()
				*
				*  This function is called once on the 'input' page between the head and footer
				*  There are 2 situations where ACF did not load during the 'acf/input_admin_enqueue_scripts' and 
				*  'acf/input_admin_head' actions because ACF did not know it was going to be used. These situations are
				*  seen on comments / user edit forms on the front end. This function will always be called, and includes
				*  $args that related to the current screen such as $args['post_id']
				*
				*  @type	function
				*  @date	6/03/2014
				*  @since	5.0.0
				*
				*  @param	$args (array)
				*  @return	n/a
				*/
				
				/*
				
				function input_form_data($args) {
					
				
			
				}
				
				*/
			
			
			/*
			*  input_admin_footer()
			*
			*  This action is called in the admin_footer action on the edit screen where your field is created.
			*  Use this action to add CSS and JavaScript to assist your render_field() action.
			*
			*  @type	action (admin_footer)
			*  @since	3.6
			*  @date	23/01/13
			*
			*  @param	n/a
			*  @return	n/a
			*/
		
			/*
				
			function input_admin_footer() {
			
				
				
			}
			
			*/
			
			
			/*
			*  field_group_admin_enqueue_scripts()
			*
			*  This action is called in the admin_enqueue_scripts action on the edit screen where your field is edited.
			*  Use this action to add CSS + JavaScript to assist your render_field_options() action.
			*
			*  @type	action (admin_enqueue_scripts)
			*  @since	3.6
			*  @date	23/01/13
			*
			*  @param	n/a
			*  @return	n/a
			*/
		
			/*
			
			function field_group_admin_enqueue_scripts() {
				
			}
			
			*/
		
			
			/*
			*  field_group_admin_head()
			*
			*  This action is called in the admin_head action on the edit screen where your field is edited.
			*  Use this action to add CSS and JavaScript to assist your render_field_options() action.
			*
			*  @type	action (admin_head)
			*  @since	3.6
			*  @date	23/01/13
			*
			*  @param	n/a
			*  @return	n/a
			*/
		
			
			/*
			function field_group_admin_head() {
			}
			*/
			
		
		
			/*
			*  load_value()
			*
			*  This filter is applied to the $value after it is loaded from the db
			*
			*  @type	filter
			*  @since	3.6
			*  @date	23/01/13
			*
			*  @param	$value (mixed) the value found in the database
			*  @param	$post_id (mixed) the $post_id from which the value was loaded
			*  @param	$field (array) the field array holding all the field options
			*  @return	$value
			*/
			
			
			function load_value($value, $post_id, $field) {
				
				
				return $value;
				
			}
			
			
			/*
			*  update_value()
			*
			*  This filter is applied to the $value before it is saved in the db
			*
			*  @type	filter
			*  @since	3.6
			*  @date	23/01/13
			*
			*  @param	$value (mixed) the value found in the database
			*  @param	$post_id (mixed) the $post_id from which the value was loaded
			*  @param	$field (array) the field array holding all the field options
			*  @return	$value
			*/
			
			
			function update_value($value, $post_id, $field) {
				// clean up empty html tags
				$value = preg_replace('#<(\w+)\s*[^>]*>\s*(<br\s*/?>)?\s*</\1>#s', '', $value);
				$value = preg_replace('#(^<br\s*/?>|<br\s*/?>$)#s', '', $value);
				if (isset($field['other_options'])) {
					if (is_array($field['other_options']) && in_array('disableReturn', $field['other_options'])) {
						// no return, remove all p tags
						$value = preg_replace('#</?p\s+[^>]*>#is', ' ', $value);
						if (!in_array('allowBreakInSingleLineInput', $field['other_options'])) {
							// remove all br tags
							$value = preg_replace('#<br[^>]*>#is', ' ', $value);
						} else {
							$value = str_replace('&lt;', '<', $value);
							$value = str_replace('&gt;', '>', $value);
						}
						// remove extra spaces that may have been added above
						$value = trim(preg_replace('/\s+/s', ' ', $value));
					}
				}
				$value = wp_kses_post($value);
				return $value;				
			}
			
			
			/*
			*  format_value()
			*
			*  This filter is appied to the $value after it is loaded from the db and before it is returned to the template
			*
			*  @type	filter
			*  @since	3.6
			*  @date	23/01/13
			*
			*  @param	$value (mixed) the value which was loaded from the database
			*  @param	$post_id (mixed) the $post_id from which the value was loaded
			*  @param	$field (array) the field array holding all the field options
			*
			*  @return	$value (mixed) the modified value
			*/
			
			function format_value($value, $post_id, $field) {
				
				// bail early if no value
				if (empty($value)) {
				
					return $value;
					
				}
				return $value;
				$value = preg_replace('/>\s+</s', '><', trim($value));
				$value = preg_replace('/<br\s?\/?><\/p/s', '</p', $value);
				$value = preg_replace('/<br\s?\/?>$/s', '', $value);
				
				// return
				return $value;
			}
			
			/*
			*  validate_value()
			*
			*  This filter is used to perform validation on the value prior to saving.
			*  All values are validated regardless of the field's required setting. This allows you to validate and return
			*  messages to the user if the value is not correct
			*
			*  @type	filter
			*  @date	11/02/2014
			*  @since	5.0.0
			*
			*  @param	$valid (boolean) validation status based on the value and the field's required setting
			*  @param	$value (mixed) the $_POST value
			*  @param	$field (array) the field array holding all the field options
			*  @param	$input (string) the corresponding input name for $_POST value
			*  @return	$valid
			*/
			
			
			function validate_value($valid, $value, $field, $input){
				
				if ($field['required']) {
					$value = trim(preg_replace('#</?\w+[^>]*>#', '', $value));
					if ($value == '') {
						$valid = $field['label'].' is required';
					}
				}
				// return
				return $valid;
				
			}
			
			
			/*
			*  delete_value()
			*
			*  This action is fired after a value has been deleted from the db.
			*  Please note that saving a blank value is treated as an update, not a delete
			*
			*  @type	action
			*  @date	6/03/2014
			*  @since	5.0.0
			*
			*  @param	$post_id (mixed) the $post_id from which the value was deleted
			*  @param	$key (string) the $meta_key which the value was deleted
			*  @return	n/a
			*/
			
			/*
			
			function delete_value($post_id, $key) {
				
				
				
			}
			
			*/
			
			
			/*
			*  load_field()
			*
			*  This filter is applied to the $field after it is loaded from the database
			*
			*  @type	filter
			*  @date	23/01/2013
			*  @since	3.6.0	
			*
			*  @param	$field (array) the field array holding all the field options
			*  @return	$field
			*/
			
			/*
			
			function load_field($field) {
				
				return $field;
				
			}	
			
			*/
			
			
			/*
			*  update_field()
			*
			*  This filter is applied to the $field before it is saved to the database
			*
			*  @type	filter
			*  @date	23/01/2013
			*  @since	3.6.0
			*
			*  @param	$field (array) the field array holding all the field options
			*  @return	$field
			*/
			
			function update_field($field) {
				if (is_array($field['custom_buttons'])) {
					$buttons = array();
					foreach ($field['custom_buttons'] as $button) {
						if (is_array($button['attributes'])) {
							$attributes = array();
							foreach ($button['attributes'] as $attribute) {
								$attributes[] = $attribute;
							}
							$button['attributes'] = $attributes;
						}
						$buttons[] = $button;
					}
					$field['custom_buttons'] = $buttons;
				}
				return $field;
			}
			
			
			/*
			*  delete_field()
			*
			*  This action is fired after a field is deleted from the database
			*
			*  @type	action
			*  @date	11/02/2014
			*  @since	5.0.0
			*
			*  @param	$field (array) the field array holding all the field options
			*  @return	n/a
			*/
			
			/*
			
			function delete_field($field) {
				
				
				
			}	
			
			*/
			
			
		}
	
	
		// initialize
		new acf_medium_editor_field($this->settings);
	
	// class_exists check
	endif;

?>
