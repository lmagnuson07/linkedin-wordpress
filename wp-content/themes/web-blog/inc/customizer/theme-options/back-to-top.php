<?php
/**
 * Back To Top settings
 */

$wp_customize->add_section(
	'web_blog_back_to_top_section',
	array(
		'title' => esc_html__( 'Scroll Up ( Back To Top )', 'web-blog' ),
		'panel' => 'web_blog_theme_options_panel',
	)
);

// Scroll to top enable setting.
$wp_customize->add_setting(
	'web_blog_enable_scroll_to_top',
	array(
		'default'           => true,
		'sanitize_callback' => 'web_blog_sanitize_checkbox',
	)
);
$wp_customize->add_control(
	new Web_Blog_Toggle_Checkbox_Custom_control(
		$wp_customize,
		'web_blog_enable_scroll_to_top',
		array(
			'label'    => esc_html__( 'Enable scroll to top.', 'web-blog' ),
			'settings' => 'web_blog_enable_scroll_to_top',
			'section'  => 'web_blog_back_to_top_section',
			'type'     => 'checkbox',
		)
	)
);
