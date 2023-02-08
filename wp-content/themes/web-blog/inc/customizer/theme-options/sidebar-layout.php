<?php
/**
 * Sidebar settings
 */

$wp_customize->add_section(
	'web_blog_sidebar_option',
	array(
		'title' => esc_html__( 'Sidebar Options', 'web-blog' ),
		'panel' => 'web_blog_theme_options_panel',
	)
);

// Sidebar Option - Global Sidebar Position.
$wp_customize->add_setting(
	'web_blog_sidebar_position',
	array(
		'sanitize_callback' => 'web_blog_sanitize_select',
		'default'           => 'right-sidebar',
	)
);

$wp_customize->add_control(
	'web_blog_sidebar_position',
	array(
		'label'   => esc_html__( 'Global Sidebar Position', 'web-blog' ),
		'section' => 'web_blog_sidebar_option',
		'type'    => 'select',
		'choices' => array(
			'right-sidebar' => esc_html__( 'Right Sidebar', 'web-blog' ),
			'no-sidebar'    => esc_html__( 'No Sidebar', 'web-blog' ),
		),
	)
);

// Sidebar Option - Post Sidebar Position.
$wp_customize->add_setting(
	'web_blog_post_sidebar_position',
	array(
		'sanitize_callback' => 'web_blog_sanitize_select',
		'default'           => 'right-sidebar',
	)
);

$wp_customize->add_control(
	'web_blog_post_sidebar_position',
	array(
		'label'   => esc_html__( 'Post Sidebar Position', 'web-blog' ),
		'section' => 'web_blog_sidebar_option',
		'type'    => 'select',
		'choices' => array(
			'right-sidebar' => esc_html__( 'Right Sidebar', 'web-blog' ),
			'no-sidebar'    => esc_html__( 'No Sidebar', 'web-blog' ),
		),
	)
);

// Sidebar Option - Page Sidebar Position.
$wp_customize->add_setting(
	'web_blog_page_sidebar_position',
	array(
		'sanitize_callback' => 'web_blog_sanitize_select',
		'default'           => 'right-sidebar',
	)
);

$wp_customize->add_control(
	'web_blog_page_sidebar_position',
	array(
		'label'   => esc_html__( 'Page Sidebar Position', 'web-blog' ),
		'section' => 'web_blog_sidebar_option',
		'type'    => 'select',
		'choices' => array(
			'right-sidebar' => esc_html__( 'Right Sidebar', 'web-blog' ),
			'no-sidebar'    => esc_html__( 'No Sidebar', 'web-blog' ),
		),
	)
);
