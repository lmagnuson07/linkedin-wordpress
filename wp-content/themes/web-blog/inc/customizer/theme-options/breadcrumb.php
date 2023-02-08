<?php
/**
 * Breadcrumb settings
 */

$wp_customize->add_section(
	'web_blog_breadcrumb_section',
	array(
		'title' => esc_html__( 'Breadcrumb Options', 'web-blog' ),
		'panel' => 'web_blog_theme_options_panel',
	)
);

// Breadcrumb enable setting.
$wp_customize->add_setting(
	'web_blog_breadcrumb_enable',
	array(
		'default'           => true,
		'sanitize_callback' => 'web_blog_sanitize_checkbox',
	)
);
$wp_customize->add_control(
	new Web_Blog_Toggle_Checkbox_Custom_control(
		$wp_customize,
		'web_blog_breadcrumb_enable',
		array(
			'label'    => esc_html__( 'Enable breadcrumb.', 'web-blog' ),
			'type'     => 'checkbox',
			'settings' => 'web_blog_breadcrumb_enable',
			'section'  => 'web_blog_breadcrumb_section',
		)
	)
);

// Breadcrumb - Separator.
$wp_customize->add_setting(
	'web_blog_breadcrumb_separator',
	array(
		'sanitize_callback' => 'sanitize_text_field',
		'default'           => '/',
	)
);

$wp_customize->add_control(
	'web_blog_breadcrumb_separator',
	array(
		'label'           => esc_html__( 'Separator', 'web-blog' ),
		'section'         => 'web_blog_breadcrumb_section',
		'active_callback' => function( $control ) {
			return ( $control->manager->get_setting( 'web_blog_breadcrumb_enable' )->value() );
		},
	)
);
