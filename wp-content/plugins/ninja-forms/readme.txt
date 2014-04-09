=== Ninja Forms ===
Contributors: kstover, jameslaws
Tags: forms, web forms, contact forms, custom form, form builder, form manager, form, input, contact form, custom forms, form creator, form creation
Requires at least: 3.3
Tested up to: 3.5
Stable tag: 2.1.9
License: GPLv2 or later

Create custom forms with a simple drag and drop interface. Contact forms, Email collection forms, or any other form you want on your WordPress site.

== Description ==
Ninja Forms is a full-featured form creation framework for WordPress. It allows you to easily and quickly design complex forms through a drag and drop interface and absolutely no code. But for you developers it has a ton of hooks and filters so you can do absolutely anything with this powerful form building framework. Here are just a few of the things you will find in Ninja Forms:

* Custom input masks allow you to restrict user input in your forms for things like phone numbers, currency, and dates.
* Manage, Edit, and Export form user submissions.
* Save fields as favorites and re-use them in multiple forms.
* Export and Import forms and favorite fields.
* Set required fields.
* Add a datepicker to text fields.
* Email form results to any number of pre-determined email addresses, as well as specific messages to the user filling out the form.
* Customize form emails with the WordPress editor.
* Anti-Spam field.
* Extremely developer friendly.
* Submit your form by reloading the page or asynchronously with AJAX.
* Please note that if you are using a version of PHP lower than 5.3, you may experience some problems using AJAX Submissions. These can be minimized by using simple success/error messages without any quotes or special characters.

= Demo Site =
Please feel free to visit our [demo site](http://demo.wpninjas.com/ninja-forms/) where you can test the features of Ninja Forms and all of our extensions. http://demo.wpninjas.com/ninja-forms/

= In addition to these features, extensions are available at our website: =

* [Front-End Editor](http://wpninjas.com/downloads/front-end-editor/) - Give your users the ability to create, edit, or delete posts, pages, or any custom post type and allow your users to edit their Ninja Forms submissions all from the front-end. Also included is front-end profile editing, custom registration forms, login and password resetting, all without needing to see the default, WordPress branded login page.
* [File Uploads](http://wpninjas.com/downloads/file-uploads/) - Allow users to upload files and store those files within a searchable database.
* [Multi-Part Forms](http://wpninjas.com/downloads/multi-part-forms/) - Break up those long, complex forms into multiple pages.
* [Save User Progress](http://wpninjas.com/downloads/save-user-progress/) - Let your users save their progress and return later to finish filling out the form.
* [Conditional Logic](http://wpninjas.com/downloads/conditional-logic/) - Create "smart" forms that show or hide fields based upon user input. Even add a value to a dropdown list when a user selects a specific value from another list.
* [Front-End Posting](http://wpninjas.com/downloads/front-end-posting/) - Use Ninja Forms to create posts from the front-end. These can be added to any post type, including custom post types, and users can select categories and tags.
* [Layout & Styles](http://wpninjas.com/downloads/layout-styles/) - Use Ninja Forms to create amzing form layouts and styles right from your WordPress admin.

We have several other extensions in the works.

== Screenshots ==

To see up to date screenshots, visit the [Ninja Forms](http://wpninjas.com/ninja-forms/) page.

== Installation ==

This section describes how to install the plugin and get it working.

1. Upload the `ninja-forms` directory to your `/wp-content/plugins/` directory
2. Activate the plugin through the 'Plugins' menu in WordPress
3. Visit the 'Forms' menu item in your admin sidebar

Shortcodes have been re-implemented. They are used like so: [ninja_forms_display_form id=3] where 3 is the ID number of the form you want to display.


== Use ==

For help and video tutorials, please visit our website: [Ninja Forms Documentation](http://wpninjas.com/ninja-forms/docs/)

== Upgrade Notice ==

= 2.1.9 =

* Fixed a bug that could cause the success message to not show up properly when using AJAX.
* Please note that if you are using a version of PHP lower than 5.3, you may experience some problems using AJAX Submissions. These can be minimized by using simple success/error messages without any quotes or special characters.

== Requested Features ==

If you have any feature requests, please feel free to visit [wpninjas.com](http://wpninjas.com/downloads/category/ninja-forms/) and let us know about it.

== Changelog ==

= 2.1.9 =

*Bugs:*

* Fixed a bug that could cause the success message to not show up properly when using AJAX.
* Please note that if you are using a version of PHP lower than 5.3, you may experience some problems using AJAX Submissions. These can be minimized by using simple success/error messages without any quotes or special characters.

= 2.1.8 =

*Bugs:*

* Fixed a major bug with displaying success messages via AJAX.

= 2.1.7 =

*Bugs:*

* Fixed a success message display bug.
* Other minor bugfixes.

= 2.1.6 =

*Bugs:*

* Fixed an email formatting bug that was prevenitng HTML emails from displaying properly for some users.
* Fixed a bug that prevented the "inside" label position from working properly with textareas.
* Fixed a bug that could cause the 'ninja_forms_display_form' shortcode to work incorrectly.

= 2.1.5 =

*Bugs:*

* Fixed a bug with adding administrator email addresses incorrectly.
* Fixed a bug that caused success messages to show in the wrong form when adding multiple forms to a single page.

= 2.1.4 =

*Bugs:*

* Fixed a bug that prevented some installations from being able to use AJAX submissions.
* Fixed a problem with appending a form to a page or using a shortcode that sometimes caused extra breaks 

= 2.1.3 =

*Bugs:*

* Fixed a bug that caused some users issues with using AJAX submissions.
* Fixed a bug that caused extensions to show as "installed" even if they were not.

= 2.1.2 =

*Features:*

* AJAX submissions have been re-added. Visit the "Basic Settings" metabox underneath the "Form Settings" tab to enable this feature.
* In the near future, there will be more options and documentation related to this feature.

*Changes:*

* Submissions are now listed from most recent to oldest. A sortable table is in the works.
* Changed the output of the ninja_forms_get_form_id() JS function to just an ID number.

= 2.1.1 =

*Bugs:*

* Hidden Fields should now always properly assign values if set to "Username," "Firstname," etc.

*Changes:*

* Changed the way that the password field works so that it can be used for both registration and normal password entry.
* Added a scheduled action hook (ninja_forms_daily_action) that is executed on a daily basis.

= 2.1.0 =

*Features:*

* Added an option to the "textbox" field type so that the "From Name" of a form submission email can be set as well as the "From Email."

*Changes:*

* $ninja_forms_processing->get_form_setting('sub_id') will now populate with the ID of the submission after it has been inserted into the database.

= 2.0.9 =

*Bugs:*

* Fixed a bug in the redirect script that was causing some users to crash instead of changing sites. Ninja Forms now sets a $_SESSION variable, $_SESSION['ninja_forms_values'], equal to an array that looks like: array( 'field_id' => 32, 'user_value' => 'whatever the user submitted' ) just before it redirects. The target page can access these variables for processing or display.

* Fixed a bug with the ninja_forms_register_tab_metabox_options() function

= 2.0.8 =

*Bugs:*

* Fixed a bug that was causing odd behaviour when two or more forms were on the same page.

*Changes:*

* Modified the way that Ninja Forms outputs admin metaboxes.
* Modified the way that Ninja Forms outputs errors and success messages.

= 2.0.7 =

*Features:*

* Added a new field type of "Password." This field offers the ability to add a password input textbox to your forms, including both password and re-enter password boxes. Ninja Forms will ensure that the text entered into these boxes matches. Please note that using this field within your forms to do things like logins, registrations, etc. will require custom coding.

*Bugs:*

* Modified the way that Ninja Forms created admin metaboxes. Metabox options should now properly output in the order in which they are registered.
* Added a new serializeToArray function to the admin.js to fix a bug some users encountered with popup boxes.

*Changes:*

* Removed unused files.

= 2.0.6 =

*Bugs:*

* Fixed a JS bug that prevented some users from adding new form fields.

= 2.0.5 =

*Features:*

* Added the option to set an email address as the “From” address within the field settings.
* Added basic email validation. This does NOT validate that the email address exists, but only that it is semantically correct.
* Added a label in the plugin settings “Label” tab for an invalid email address.
* Added Shortcode and Template Function output to the Form List. You can now copy and paste the shortcode from there.

*Changes:*

* Admin metaboxes will now remember whether or not they were closed or open.

*Bugs:*

* Fixed a bug that prevented some users from adding new fields.

= 2.0.4 =

*Features:*

* Added a label field to the plugin settings page that will allow users to set the message displayed above the form when there is a required field error.
* Setting a text or textarea’s label position to ‘inside’ will now cause the label to be auto-removed when the input receives focus. If a user leaves the field blank, the label will return.

*Changes:*

* Increased the max file size for form imports.
* Added a filter: ninja_forms_field_wrap_class. This filter is sent a string that contains the wrap class for each field along with its field id.
* The CSS class of the list field wrapping div has been modified slightly. It has been changed from .list to .list-dropdown where dropdown is the list type.
* Added a new shortcode for inserting the date into the success message and emails: [ninja_forms_sub_date format="m/d/Y"]. It follows the php.net date() string formats and defaults to m/d/Y.

*Bugs:*

* Fixed a bug that prevented Help Text from displayin properly when the label was set to the “inside” position.

= 2.0.3 =

*Features:*

* Added a checkbox to allow the appending of field values to administrator emails.
* Save form settings is now checked by default when creating a form.
* Hide form after successful submission is now checked by default when creating a new form.
* Changed the [label] system to [ninja_forms_field id=3] where 3 is the field ID that you want to insert.

*Changes:*

*Changed the way that "settings saved" messages appear. When creating a save function on the admin-backend, you can now return the update message you wish users to see.

*Bugs:*

* Fixed a bug that caused design elements, especially text fields, from showing on multi-part forms.
* Fixed a bug in the backend admin system that was causing problems with the Uploads Browser/Upload Settings tabs.
* To prevent conflicts with other plugins, we removed the position declaration from the admin menu hook. This means that the Forms link will now float to the bottom of the admin menu.
* Fixed a bug that was causing help text to be repeated underneath sections of the Form Settings Tab.
* Fixed a bug that prevented list-based checkboxes from showing up properly when editing submissions.
* Fixed a bug that was causing required checkboxes not to validate properly.

= 2.0.2 =
* Fixed several bugs including:
* A bug that caused multiple forms to a single page broke some JS
* Various export bugs. Exporting submissions should work properly.
* Various activation bugs.
* Varous bugs on the admin/back-end.

* Added widget functionality. You can now add Ninja Forms to your sidebars via a widget.

= 2.0.1 =
* Lots of bug fixes.
* Filter User and Admin email subject line for [bracketed] labels.
* Add an action hook to User and Email sending.
* Add an option to the "user email" section for attaching user submitted values.
* "Settings saved" now appears properly when saving plugin settings.
* Fixed a bug with including display js and css for core and extensions.
* Removed the label "Error message shown when all fields are empty." This wasn't used anyway.
* Added Shortcodes. They can be used like: [ninja_forms_display_form id=3].
* Fixed a bug where saving plugin settings would break upon HTML entry.
* Replaced isset( $ninja_forms_processing with is_object( $ninja_forms_processing.
* Fixed several activation bugs.

= 2.0 =
* Version 2.0 is a major leap forward for Ninja Forms. It is much more stable and developer friendly than previous versions of the plugin.