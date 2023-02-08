<?php
/**
 * Single Post Options
 */

$wp_customize->add_section(
	'web_blog_single_page_options',
	array(
		'title' => esc_html__( 'Single Post Options', 'web-blog' ),
		'panel' => 'web_blog_theme_options_panel',
	)
);

// Enable single post category setting.
$wp_customize->add_setting(
	'web_blog_enable_single_category',
	array(
		'default'           => true,
		'sanitize_callback' => 'web_blog_sanitize_checkbox',
	)
);

$wp_customize->add_control(
	new Web_Blog_Toggle_Checkbox_Custom_control(
		$wp_customize,
		'web_blog_enable_single_category',
		array(
			'label'    => esc_html__( 'Enable Category', 'web-blog' ),
			'settings' => 'web_blog_enable_single_category',
			'section'  => 'web_blog_single_page_options',
			'type'     => 'checkbox',
		)
	)
);

// Enable single post author setting.
$wp_customize->add_setting(
	'web_blog_enable_single_author',
	array(
		'default'           => true,
		'sanitize_callback' => 'web_blog_sanitize_checkbox',
	)
);

$wp_customize->add_control(
	new Web_Blog_Toggle_Checkbox_Custom_control(
		$wp_customize,
		'web_blog_enable_single_author',
		array(
			'label'    => esc_html__( 'Enable Author', 'web-blog' ),
			'settings' => 'web_blog_enable_single_author',
			'section'  => 'web_blog_single_page_options',
			'type'     => 'checkbox',
		)
	)
);

// Enable single post date setting.
$wp_customize->add_setting(
	'web_blog_enable_single_date',
	array(
		'default'           => true,
		'sanitize_callback' => 'web_blog_sanitize_checkbox',
	)
);

$wp_customize->add_control(
	new Web_Blog_Toggle_Checkbox_Custom_control(
		$wp_customize,
		'web_blog_enable_single_date',
		array(
			'label'    => esc_html__( 'Enable Date', 'web-blog' ),
			'settings' => 'web_blog_enable_single_date',
			'section'  => 'web_blog_single_page_options',
			'type'     => 'checkbox',
		)
	)
);

// Enable single post tag setting.
$wp_customize->add_setting(
	'web_blog_enable_single_tag',
	array(
		'default'           => true,
		'sanitize_callback' => 'web_blog_sanitize_checkbox',
	)
);

$wp_customize->add_control(
	new Web_Blog_Toggle_Checkbox_Custom_control(
		$wp_customize,
		'web_blog_enable_single_tag',
		array(
			'label'    => esc_html__( 'Enable Post Tag', 'web-blog' ),
			'settings' => 'web_blog_enable_single_tag',
			'section'  => 'web_blog_single_page_options',
			'type'     => 'checkbox',
		)
	)
);

// Enable single post related Posts setting.
$wp_customize->add_setting(
	'web_blog_enable_related_post_section',
	array(
		'default'           => true,
		'sanitize_callback' => 'web_blog_sanitize_checkbox',
	)
);

$wp_customize->add_control(
	new Web_Blog_Toggle_Checkbox_Custom_control(
		$wp_customize,
		'web_blog_enable_related_post_section',
		array(
			'label'    => esc_html__( 'Enable Related Posts', 'web-blog' ),
			'settings' => 'web_blog_enable_related_post_section',
			'section'  => 'web_blog_single_page_options',
			'type'     => 'checkbox',
		)
	)
);

// Single post related Posts title label.
$wp_customize->add_setting(
	'web_blog_related_posts_title',
	array(
		'default'           => __( 'Related Posts', 'web-blog' ),
		'sanitize_callback' => 'sanitize_text_field',
	)
);

$wp_customize->add_control(
	'web_blog_related_posts_title',
	array(
		'label'           => esc_html__( 'Related Posts Title', 'web-blog' ),
		'section'         => 'web_blog_single_page_options',
		'settings'        => 'web_blog_related_posts_title',
		'active_callback' => 'web_blog_if_related_posts_enabled',
	)
);

/*========================Active Callback==============================*/
function web_blog_if_related_posts_enabled( $control ) {
	return $control->manager->get_setting( 'web_blog_enable_related_post_section' )->value();
}
