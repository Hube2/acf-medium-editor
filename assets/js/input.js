
var acf_medium_editors = {};
var acf_medium_editor_timeout = false;

(function($){
	
	function acf_get_medium_editor_selector($el, $selector) {
		// because of repeaters, flex fields and clones
		// selector needs to be absolutely specific
		//console.log($selector);
		if ($selector != '') {
			$selector = '>'+$selector.trim();
		}
			
		var $parent = $el.parent();
		if ($parent.hasClass('acf-clone')) {
			// do not add editors to any clones
			// wait until they are active
			return false;
		}
		if ($parent.hasClass('acf-postbox')) {
			$selector = $parent.prop('nodeName').toLowerCase()+'#'+$parent.attr('id')+$selector;
			return $selector;
		}
		if ($parent.prop('nodeName').toLowerCase() == 'form') {
			$selector = $parent.prop('nodeName').toLowerCase()+$selector;
			return $selector;
		}
		if (typeof($parent.data('key')) != 'undefined') {
			$selector = '[data-key="'+$parent.data('key')+'"]'+$selector;
		}
		if (typeof($parent.data('id')) != 'undefined') {
			$selector = '[data-id="'+$parent.data('id')+'"]'+$selector;
		}
		if ($parent.hasClass('acf-row')) {
			$selector = '.acf-row'+$selector;
		}
		if (typeof($parent.attr('id')) != 'undefined') {
			$selector = '#'+$parent.attr('id')+$selector;
		}
		$selector = $parent.prop('nodeName').toLowerCase()+$selector;
		
		// recurse
		$selector = acf_get_medium_editor_selector($parent, $selector);
		
		return $selector;
	}
	
	function initialize_acf_medium_editor_field($el) {
		var $textarea = $el.find('textarea').first();
		//console.log($textarea);
		var $selector = 'textarea'
		$selector = acf_get_medium_editor_selector($textarea, $selector);
		console.log($selector);
		if (!$selector) {
			return;
		}
		
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
		var editor = new MediumEditor($selector, $object);
		
		if (!editor.elements.length) {
			return;
		}
		
		// cause update to editor to trigger acf change event
		editor.subscribe('editableInput', function(e, editable) {
			$($selector).trigger('change');
		});
		
		/* test removing the hack */
		if (1) {return;}
		/* It looks like the hack can be removed now
				will delete this code if I don't see any additional problems
		*/
		
		var elements = editor.elements;
		//console.log(elements);
		for (i=0; i<editor.elements.length; i++) {
			//console.log(elements[i].id);
			var editorId = elements[i].id;
			//console.log(editorId);
			//var $target = document.getElementById(editorId);
			//console.log($target.getAttribute('medium-editor-index'));
			$('#'+editorId).bind('DOMSubtreeModified', function(e) {
				//console.log(e.currentTarget.id);
				var $target = document.getElementById(e.currentTarget.id);
				var $targetObj
				$($target).closest('.acf-input').find('textarea').each(function(index, element) {
					$targetObj = element;
				});
				//console.log($targetObj);
				//console.log($targetObj);
				//$targetObj.innerHTML = $target.innerHTML;
				editor.events.updateInput($target, $targetObj);
				//console.log($($targetObj));
				// force update of content in textarea
				$($targetObj).val($target.innerHTML);
				//console.log($($targetObj).val());
				$($selector).trigger('change');
			});
		}
		/* end of hack */
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
