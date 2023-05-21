# ***I AM NO LONGER SUPPORTING THIS PROJECT***

***Medium Editor needs your help!. This plugin depends Medium Editor which is the JavaScript package that powers this ACF Add On. I do not maintain this package. This plugin is simply an implementation of it for ACF. [Medium Editor is looking for contributors](https://github.com/yabwe/medium-editor/issues/1503). Without people to help maintain and improve it Medium Editor could fade away and if that happens this plugin will no longer be possible.***

***Please do not install this plugin from here. The plugin here has a different slug than the one on wordpress.org. When this plugin in updated it will be updated from wordpress and not from this repo. This will cause the plugin to be deactivated when it is updated.***

# Advanced Custom Fields: Medium Editor Field

Suported ACF Versions
* ACF 5

Ever needed to give a client a way to edit the appearence of text without wanting to give them a full blown
WYSIWYG editor? Need something less than a WYSYWIG but more than a text or textarea field that you can
configure the way you need it to work with the features you need it to have?

![Example](https://github.com/Hube2/acf-medium-editor/blob/master/screenshot-2.png)

== Installation ==

1. Copy the `acf-medium-editor-field` folder into your `wp-content/plugins` folder
2. Activate the Medium Editor Field plugin via the plugins admin page
3. Create a new field via ACF and select the Medium Editor Field type
4. Please refer to the description for more info regarding the field type settings

##Configurable Medium Editor WYSIWYG Field for ACF

This add on for ACF5 adds [MediumEditor](https://github.com/yabwe/medium-editor) as an ACF field. 
Each field instance is configurable, and each field instance has its own settings. Many of the options 
available in MediumEditor are supported, including the creation of custom buttons using [MediumButton](https://github.com/arcs-/MediumButton). It is also possible using either a configuration
setting or a filter to alter the MediumEditor Theme. Some of the available options are covered below.
For more information on MediumEditor and MediumButton, see the description of these libaries at the links above.

Please note that this is only available for the ACF5 verion. It will not work in ACF4. As you'll see 
looking at the field settings, I've added a repeater field (and a nested repeater to the settings for 
this field type. It may work with ACF4 and with the repeater add on, but the JavaScript would need to be 
rewritten for that and if you're using ACF4 and the repeater add on then you may as will upgrade to ACF5.

I have created this custom field with specific features of MediumEditor that I need for a project I'm
currently working on. The most important feature is the inclusion of MediumButton so that I can create
custom buttons that will allow me to complete the admin to meet the client's needs for modifying things
like text color of specific portions of text. I'm not apposed to adding more options and features of 
MediumEditor, drop me a note in issues for this repo and I'll consider them.

There are actually several ACF addons that use MediumEditor, but I needed something that I could congifure
differently for each instance and I especially needed to be able to easily add custom buttons and the 
easiest way to do that was with MediumButton. I couldn't find one and honestly, editing any of the existing
ones to allow what I needed would have mean completely rebuilding them anyway. So this is my take on it. 
Hopefully others find it usefull.


## Field Settings
See Setting Descriptions Below Screenshot
![Field Settings](https://github.com/Hube2/acf-medium-editor/blob/master/screenshot-3.png)

The following is an explanation of the fields, not including the ones that should be self explanatory.

**Buttons:** These are the buttons that are included in [MediumEditor](https://github.com/yabwe/medium-editor#buttons).
Select the buttons you want to include in each editor instance.

**Custom Buttons:** This is the main reason that I created this plugin. This field supports adding 
custom buttons using [MediumButton](https://github.com/arcs-/MediumButton#html-buttons). 
Please note that if any of the main fields (Name, Label, HTML Tag) are empty that the entire 
button will be ignored.

***Name***: This is then name of the button and will be used when instaniating the MediumButton Object. 
The button name must be unique and cannot be one of the buttons already included in MediumEditor, a
button of the same name as on of the standard button in Medium Editor will not override that button
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
an option will set that option's value to true.

***allowBreakInSingleLineInput:*** This is an option added specifically for use with WP.
If you set disableReturn on then the medium editor acts like a single link input. Setting
allowBreakInSingleLineInput allows editors to manually type in &lt;br&gt; tags into these
single line fields.

## MediumEditor Themes
MediumEditor fields will use the default theme unless you change it. You can alter the theme used for all 
MediumEditor fields, this is not something that you can apply only some fields. You can change the theme
on your site in one of two ways:

1) wp-config.php
Add the following code to your wp-cofig.php file
```
define('MEDIUM_EDITOR_THEME', 'beagle');
```

2) filter
Add the following code to your functions.php file or wherever you would add such a filter
```
add_filter('medium-editor-theme', 'my_medium_editor_theme_function');
function my_medium_editor_theme_function($theme) {
  $theme = 'beagle';
  return $theme;
}
```

Theme names in the above code is one of the following themes currently supported by MediumEditor:
beagle, bootstrap, default, flat, mani, roman, tim

For more information see [MediumEditor](https://github.com/yabwe/medium-editor#mediumeditor) and
[MediumButton](https://github.com/arcs-/MediumButton#mediumbutton)

## Custom Editor Styles

The styles used in the medium editor for elementa is inherited from WP. If you want to override these styles
create a file named "medium-editor-syle.css" in your theme folder. If this file exists is will be
automatcially enqueued on all pages where ACF fields appear.

## Filters

### Add Custom Buttons in Code

This filter is applied to the custom buttons before they are validated as having all the correct
requirements that are given when creating a custom button in the field settings for a Medium Editor Field.

**Hooks**

1. **acf/medium-editor-field/custom-buttons** - filter for every field 
2. **acf/medium-editor-field/custom-buttons/name={$field_name}** - filter for specific field based on it's name
3. **acf/medium-editor-field/custom-buttons/key={$field_key}** - filter for specific field based on it's key

**Parameters**

1. **$buttons** - an array of button options
2. **$field** - an array containing all the fields settings for the field being loaded

```
// functions.php

function my_custom_buttons($buttons, $field) {
  $buttons[] = array(
    'name' => 'red',
    'tag' => 'span',
    'label' => '<b title="Title for button" style="color: #F00;"><i class="dashicons dashicons-NAME"></i></b>',
    'attributes'  => array(
      array(
        'name' => 'style',
        'value' => 'color: #F00;'
      ),
      array(
        'name' => 'class',
        'value' => 'myClass'
      )
    )
  );
  return $buttons;
}
add_filter('acf/medium-editor-field/custom-buttons', 'my_custom_buttons', 10, 2);
```

For all dashicons available in WordPress take a look at the [Dashicons List](https://developer.wordpress.org/resource/dashicons/#thumbs-down) and get the correct name for the dashicons-NAME.

If you use your own icon font (e.g. Font-Awesome) the icon font set must be installed and included in the admin pages of your site.

## Filter Buttons

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

```
// functions.php

function my_custom_buttons($buttons, $field) {
  // add underline button to all medium editor fields
  // set both the index and the value of the array element
  if (!isset($buttons['underline'])) {
    $buttons['underline'] = 'underline';
  }
  return $buttons;
}
add_filter('acf/medium-editor-field/buttons', 'my_buttons', 10, 2);
```

#### Automatic Updates
Github Updater support has been removed. This plugin has been puplished to WordPress.org here 
https://wordpress.org/plugins/acf-medium-editor-field/. If you are having problems updating
please try installing from there.

#### Remove Nag
You may notice that I've started adding a little nag to my plugins. It's just a box on some pages that lists my
plugins that you're using with a request do consider making a donation for using them. If you want to disable them
add the following filter to your functions.php file.
```
add_filter('remove_hube2_nag', '__return_true');
```
