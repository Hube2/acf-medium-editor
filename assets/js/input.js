
var acf_medium_editors = {};
var acf_medium_editor_timeout = false;

(function($){
	
	function initialize_acf_medium_editor_field($el) {
		var $textarea = $el.find('textarea').first();
		var $selector = 'textarea#'+$textarea.attr('id');
		
		var $key = $el.data('key');
		var $uniqid = acf.get_uniqid();
		var $data = $el.find('div[data-key="medium_editor_'+$key+'"]').first();
		
		var $delay = $data.data('delay');
		if ($delay == 1 && !$textarea.hasClass('focused')) {
			// dealy init
			$el.find('.acf-label label').append('<span class="medium-editor-delay-init">Click to Initialize MediumEditor</span>');
			$textarea.focus(function(e) {
				$textarea.addClass('focused');
				$el = $(e.target).closest('.acf-field');
				$el.find('.acf-label label span.medium-editor-delay-init').remove();
				initialize_acf_medium_editor_field($el);
			});
			return;
		}
		
		var $container;
		var $static = false;
		var $align = 'left';
		
		if (navigator.userAgent.indexOf('Safari') != -1 && navigator.userAgent.indexOf('Chrome') == -1)  {
			$static = true;
			$container = null;
		} else {
			$data.closest('.acf-input').prepend('<div id="medium-editor-container-'+$uniqid+'"></div>');
			$container = document.getElementById('medium-editor-container-'+$uniqid);
		}
		
		$static = false;
		$container = null;
		
		var $buttons = decodeURIComponent($data.data('buttons'));
		var $buttons = JSON.parse(decodeURIComponent($data.data('buttons')));
		var $extensions = JSON.parse(decodeURIComponent($data.data('extensions')));
		var $extension_object = {};
		$custom_buttons = {};
		for (i=0; i<$extensions.length; i++) {
			$custom_buttons[$extensions[i]['name']] = new MediumButton($extensions[i]['settings']);
		}
		var $placeholder = $data.data('placeholder');
		$options =  JSON.parse(decodeURIComponent($data.data('options')));

		var $object = {
			toolbar: {
				buttons: $buttons,
				static: $static,
				align: $align,
				relativeContainer: $container
			},
			extensions: $custom_buttons,
			placeholder: {
				text: $placeholder,
				hideOnClick: false
			},
			elementsContainer: $container
		};
		
		for (i in $options) {
			$object[i] = $options[i];
		}
		
		var editor = new MediumEditor($selector, $object);
		
		if (!editor.elements.length) {
			return;
		}
		
		// cause update to editor to trigger acf change event
		editor.subscribe('editableInput', function(e, editable) {
			$($selector).trigger('change');
		});
	}
	if(typeof acf.add_action !== 'undefined') {
		acf.add_action('ready append', function( $el ){
			acf.get_fields({ type : 'medium_editor'}, $el).each(function(){
				initialize_acf_medium_editor_field($(this));
			});
		});
	} else {
		$(document).on('acf/setup_fields', function(e, postbox){
			$(postbox).find('.field[data-field_type="medium_editor"]').each(function(){
				initialize_acf_medium_editor_field($(this));
			});
		});
	}
})(jQuery);
