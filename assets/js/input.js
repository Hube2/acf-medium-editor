
var acf_medium_editors = {};

(function($){
	function initialize_acf_medium_editor_field($el) {
		var $key = $el.data('key');
		var $uniqid = acf.get_uniqid();
		var $data = $el.find('div[data-key="medium_editor_'+$key+'"]').first();
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
			toolbar: {buttons: $buttons},
			extensions: $custom_buttons,
			placeholder: {
				text: $placeholder,
				hideOnClick: false
			}
		};
		for (i in $options) {
			$object[i] = $options[i];
		}
		var $selector = '[data-key="'+$key+'"] textarea';
		var $parent = $el.parent();
		if ($parent.hasClass('acf-row')) {
			var $id = $parent.data('id');
			$selector = '[data-id="'+$id+'"] '+$selector;
		} else if ($parent.is('td')) {
			$parent = $parent.parent();
			if ($parent.hasClass('acf-row')) {
				var $id = $parent.data('id');
				$selector = '[data-id="'+$id+'"] '+$selector;
			}
		}
		var editor = new MediumEditor($selector, $object);
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
