<?php

/**
 * Font section
 */

// Font section.
$wp_customize->add_section(
	'web_blog_font_options',
	array(
		'title' => esc_html__( 'Font ( Typography ) Options', 'web-blog' ),
		'panel' => 'web_blog_theme_options_panel',
	)
);

// Typography - Site Title Font.
$wp_customize->add_setting(
	'web_blog_site_title_font',
	array(
		'default'           => '',
		'sanitize_callback' => 'web_blog_sanitize_google_fonts',
	)
);

$wp_customize->add_control(
	'web_blog_site_title_font',
	array(
		'label'    => esc_html__( 'Site Title Font Family', 'web-blog' ),
		'section'  => 'web_blog_font_options',
		'settings' => 'web_blog_site_title_font',
		'type'     => 'select',
		'choices'  => web_blog_font_choices(),
	)
);

// Typography - Site Description Font.
$wp_customize->add_setting(
	'web_blog_site_description_font',
	array(
		'default'           => '',
		'sanitize_callback' => 'web_blog_sanitize_google_fonts',
	)
);

$wp_customize->add_control(
	'web_blog_site_description_font',
	array(
		'label'    => esc_html__( 'Site Description Font Family', 'web-blog' ),
		'section'  => 'web_blog_font_options',
		'settings' => 'web_blog_site_description_font',
		'type'     => 'select',
		'choices'  => web_blog_font_choices(),
	)
);

// Typography - Header Font.
$wp_customize->add_setting(
	'web_blog_header_font',
	array(
		'default'           => '',
		'sanitize_callback' => 'web_blog_sanitize_google_fonts',
	)
);

$wp_customize->add_control(
	'web_blog_header_font',
	array(
		'label'    => esc_html__( 'Header Font Family', 'web-blog' ),
		'section'  => 'web_blog_font_options',
		'settings' => 'web_blog_header_font',
		'type'     => 'select',
		'choices'  => web_blog_font_choices(),
	)
);

// Typography - Body Font.
$wp_customize->add_setting(
	'web_blog_body_font',
	array(
		'default'           => '',
		'sanitize_callback' => 'web_blog_sanitize_google_fonts',
	)
);

$wp_customize->add_control(
	'web_blog_body_font',
	array(
		'label'    => esc_html__( 'Body Font Family', 'web-blog' ),
		'section'  => 'web_blog_font_options',
		'settings' => 'web_blog_body_font',
		'type'     => 'select',
		'choices'  => web_blog_font_choices(),
	)
);
