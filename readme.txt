=== ACF Medium Editor Field ===
Contributors: Hube2
Tags: acf, add on, inline wysywig, medium editor, configurable
Requires at least: 4.0.0
Tested up to: 4.8
Stable tag: 2.4.0
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

Medium Editor Field for ACF

== Description ==

= Compatibility =
This ACF field type is compatible with:
* ACF 5

***This is an add on plugin for Advanced Custom Fields (ACF) 5. This plugin also requires either ACF Pro or the repeater field add on for ACF. This plugin will not work if ACF5 is not installed and active or if the ACF repeater field is not available. This plugin may work in a limited capacity if the repeater field is not avilable.***

Ever needed to give a client a way to edit the appearence of text without wanting to give them a full blown WYSIWYG editor? Need something less than a WYSYWIG but more than a text or textarea field that you can configure the way you need it to work with the features you need it to have?

This add on for ACF5 adds [MediumEditor](https://github.com/yabwe/medium-editor) as an ACF field. 
Each field instance is configurable, and each field instance has its own settings. Many of the options 
available in MediumEditor are supported, including the creation of custom buttons using [MediumButton](https://github.com/arcs-/MediumButton). It is also possible using either a configuration
setting or a filter to alter the MediumEditor Theme. Some of the available options are covered below.
For more information on MediumEditor and MediumButton, see the description of these libaries at the links provided.

For more information see
[Other Notes](https://wordpress.org/plugins/medium-editor-field-for-acf/other_notes) and
[Screenshots](https://wordpress.org/plugins/medium-editor-field-for-acf/screenshots)


== Screenshots ==

1. Medium Editor field when toolbar is not shown
2. Medium Editor field when toolbar is shown
2. Medium Editor Settings

== Installation ==

1. Copy the `acf-medium-editor` folder into your `wp-content/plugins` folder
2. Activate the Medium Editor Field plugin via the plugins admin page
3. Create a new field via ACF and select the Medium Editor Field type
4. Please refer to the description for more info regarding the field type settings

== Other Notes ==

== Github Repository ==

This plugin is also on GitHub 
[https://github.com/Hube2/acf-medium-editor](https://github.com/Hube2/acf-medium-editor)

== Field Settings ==

The following is an explanation of the fields, not including the ones that should be self explanatory.

**Buttons:** These are the buttons that are included in [MediumEditor](https://github.com/yabwe/medium-editor#buttons).
Select the buttons you want to include in each editor instance.

**Custom Buttons:** This is the main reason that I created this plugin. This field supports adding 
custom buttons using [MediumButton](https://github.com/arcs-/MediumButton#html-buttons). 
Please note that if any of the main fields (Name, Label, HTML Tag) are empty that the entire 
button will be ignored.

***Name***: This is then name of the button and will be used when instaniating the MediumButton Object. 
The button name must be unique and cannot be one of the buttons already included in MediumEditor, a
button of the same name as one of the standard button in Medium Editor will not override that button
if it is also included. I do not know what the effects of custom characters in the name will be. 
Please report any bugs and I will look into adding something to clean up characters or find some other work-around for any that cause errors.

***Label***: This is the label that will appear in the button bar. This field allows HTML. 
Please make sure it is valid html (I do not validate the html you enter). Invalid markup will probably 
break the button bar or the entire admin. MediumButton also supports using icons for buttons.
If you want to use icons in your buttons then it is your responsibility to make sure the icon font set is
available for use in the admin of your site.

***HTML Tag***: Enter the html tag that will be inserted by this button. Only non-empty html tags are allowed.
Most valid HTML tags are supported. If an invalid HTML tag is entered then the button will be ignored.

I'm not sure at this time what effect some of the tags will have in the editor. I haven't tried them all
if you run into issues let me know and I'll need to make a decision on wheter to try to fix it or remove
the tag(s) from the allowed list.

The currently supported tags are: abbr, acronym, address, article, asside, b, 
bdi, bdo, blockquote, button, caption, cite, code, del, details, dfn, 
div, em, footer, h1, h2, h3, h4, h5, h6, header, 
i, ins, main, mark, meta, p, pre, q, s, samp, section, small, span, 
strong, sub, sup, summary, time, u, var, wbr

***Attributes***: Add attributes to the html tag. Attibute names must be valid (they must 
begin with a letter and contain only letter, numbers, underscores and dashes. Attribute 
values must not contain double quotes (") any attributes that do not conform to these 
rules will be ignored. Please note that beyond this, attribute names and values are not 
validated. I do not know what effect invalid entries will have on your admin. Like other 
values, if you find something that causes an issue, open one and I'll see what needs to be done.

**Other MediumEditor Options:** This is a selection of other
[Core Options](https://github.com/yabwe/medium-editor#core-options) available for 
MediumEditor with the exception of ***allowBreakInSingleLineInput*** (see below). Please 
see the MediumEditor documentation for information on each of the other options. Selecting 
an option will set that option's value to true, unselecting the value will set it to false.

***allowBreakInSingleLineInput:*** This is an option added specifically for use with WP.
If you set disableReturn on then the medium editor acts like a single line input field. Setting
allowBreakInSingleLineInput allows editors to manually type in &lt;br&gt; tags into these
single line fields to create line breaks.

== Medium Editor Theme ==

MediumEditor fields will use the WordPress theme created specifically for the this plugin unless you change it.
You can alter the theme used for all MediumEditor fields, this is not something that you can apply to only 
some fields. You can change the theme on your site in one of two ways:

1) wp-config.php
Add the following code to your wp-cofig.php file
`
define('MEDIUM_EDITOR_THEME', 'beagle');
`

2) filter
Add the following code to your functions.php file or wherever you would add such a filter
`
add_filter('medium-editor-theme', 'my_medium_editor_theme_function');
function my_medium_editor_theme_function($theme) {
  $theme = 'beagle';
  return $theme;
}
`

Theme name in the above code is one of the following themes currently supported by MediumEditor:
beagle, bootstrap, default, flat, mani, roman, tim

For more information see [MediumEditor](https://github.com/yabwe/medium-editor#mediumeditor) and
[MediumButton](https://github.com/arcs-/MediumButton#mediumbutton)

== Add Custom Buttons in Code ==

This filter is applied to the custom buttons before they are validated as having all the correct
requirements that are given when creating a custom button in the field settings for a Medium Editor Field.

**Hooks**

1. **acf/medium-editor-field/custom-buttons** - filter for every field 
2. **acf/medium-editor-field/custom-buttons/name={$field_name}** - filter for specific field based on it's name
3. **acf/medium-editor-field/custom-buttons/key={$field_key}** - filter for specific field based on it's key

**Parameters**

1. **$buttons** - an array of button options
2. **$field** - an array containing all the fields settings for the field being loaded

`
// functions.php

function my_custom_buttons($buttons, $field) {
  $buttons[] = array(
    'name' => 'red',
    'label' => '<b style="color: #F00;">Red</b>"',
    'attributes' => array(
      'name' => 'style',
      'value' => 'color: #F00;'
    )
  );
  return $buttons;
}
add_filter('acf/medium-editor-field/custom-buttons', 'my_custom_buttons', 10, 2);
`

== Filter Buttons ==

This filter is applied to the list of buttons that will be shown. This list will contain the "name"
of each standard button as well as the "name" of each custom button that has been set up for the field.
Please note that only valid button names can be used here. See medium editor's list of available
buttons.

**Hooks**

1. **acf/medium-editor-field/buttons** - filter for every field 
2. **acf/medium-editor-field/buttons/name={$field_name}** - filter for specific field based on it's name
3. **acf/medium-editor-field/buttons/key={$field_key}** - filter for specific field based on it's key

**Parameters**

1. **$buttons** - an array of button options
2. **$field** - an array containing all the fields settings for the field being loaded

`
// functions.php

function my_custom_buttons($buttons, $field) {
  // add underline button to all medium editor fields
  // set both the index and the value of the array element
  if (!isset($buttons['underline'])) {
    $buttons['underline'] = 'underline';
  }
  // unset strikethrough if it is set
	if (isset($buttons['strikethrough'])) {
    unset($buttons['strikethrough']);
  }
  return $buttons;
}
add_filter('acf/medium-editor-field/buttons', 'my_buttons', 10, 2);
`


== Changelog ==

= 2.4.0 =
* updated Medium Editor to 5.23.0
* updated Medium Butoon to latest 
* added new html button for medium editor

= 2.3.1 =
* corrected button style to allow wider buttons for custom buttons
* abandoned static container, for now, do to incompatibility with Mac

= 2.3.0 =
* corrected bug - in_array() error on line 725
* css change, fix, work-around for jumpy editor behaviour
* added delay initialization setting

= 2.2.2 =
* fixed jumpy behavior of editer/toolbar - thanks @Hrohh

= 2.2.1 =
* fixed behaviour of toolbar in safari

= 2.2.0 =
* added WordPress theme to medium editor
* other changes to make the editor look and feel more like WordPress

= 2.1.1 =
* added missing anchor button missed in 2.1.0 update
* reverted button order to Medium Editor default
* corrected bug in custom buttons created in 2.1.0
* updated screenshots

= 2.1.0 =
* Added dashicons (tmconnect)
* Added transaltion Support (tmconnect)
* Added German transaltion (tmconnect)
* - Thanks [tmconnect](https://github.com/tmconnect)

= 2.0.2 =
* Removed github updater support

= 2.0.1 =
* First released to wordpress.org

= 2.0.0 =
* removed support for nested html tags for custom buttons

= 0.0.7 =
* corrected bug when in clone field

= 0.0.6 =
* correcting bugs

= 0.0.1 =
* initial release