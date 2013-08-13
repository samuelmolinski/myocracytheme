<?php
function mb2_shortcodes_button() {
	if ( ! current_user_can('edit_posts') && ! current_user_can('edit_pages') )
		return;

	if ( get_user_option('rich_editing') == 'true') {
		add_filter("mce_external_plugins", "add_tcustom_tinymce_plugin");
		add_filter('mce_buttons', 'register_tcustom_button');
	}
}
function register_tcustom_button($buttons) {
	array_push($buttons, "|", "mb2_shortcodes");
	return $buttons;
} 
function add_tcustom_tinymce_plugin($plugin_array) {
	$plugin_array['mb2_shortcodes'] = get_template_directory_uri().'/framework/theme_plugins/shortcodes-mce/plugin-mce.js';
	return $plugin_array;
}
add_action('init', 'mb2_shortcodes_button');