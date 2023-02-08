<?php
/**
 * Blog / Archive Options
 */

$wp_customize->add_section(
	'web_blog_archive_page_options',
	array(
		'title' => esc_html__( 'Blog / Archive Pages Options', 'web-blog' ),
		'panel' => 'web_blog_theme_options_panel',
	)
);

// Excerpt - Excerpt Length.
$wp_customize->add_setting(
	'web_blog_excerpt_length',
	array(
		'default'           => 15,
		'sanitize_callback' => 'web_blog_sanitize_number_range',
	)
);

$wp_customize->add_control(
	'web_blog_excerpt_length',
	array(
		'label'       => esc_html__( 'Excerpt Length (no. of words)', 'web-blog' ),
		'section'     => 'web_blog_archive_page_options',
		'settings'    => 'web_blog_excerpt_length',
		'type'        => 'number',
		'input_attrs' => array(
			'min'  => 5,
			'max'  => 200,
			'step' => 1,
		),
	)
);

// Grid Column layout options.
$wp_customize->add_setting(
	'web_blog_archive_grid_column_layout',
	array(
		'default'           => 'grid-column-2',
		'sanitize_callback' => 'web_blog_sanitize_select',
	)
);

$wp_customize->add_control(
	'web_blog_archive_grid_column_layout',
	array(
		'label'   => esc_html__( 'Grid Column Layout', 'web-blog' ),
		'section' => 'web_blog_archive_page_options',
		'type'    => 'select',
		'choices' => array(
			'grid-column-2' => __( 'Column 2', 'web-blog' ),
			'grid-column-3' => __( 'Column 3', 'web-blog' ),
		),
	)
);

// Enable archive page category setting.
$wp_customize->add_setting(
	'web_blog_enable_archive_category',
	array(
		'default'           => true,
		'sanitize_callback' => 'web_blog_sanitize_checkbox',
	)
);

$wp_customize->add_control(
	new Web_Blog_Toggle_Checkbox_Custom_control(
		$wp_customize,
		'web_blog_enable_archive_category',
		array(
			'label'    => esc_html__( 'Enable Category', 'web-blog' ),
			'settings' => 'web_blog_enable_archive_category',
			'section'  => 'web_blog_archive_page_options',
			'type'     => 'checkbox',
		)
	)
);

// Enable archive page author setting.
$wp_customize->add_setting(
	'web_blog_enable_archive_author',
	array(
		'default'           => true,
		'sanitize_callback' => 'web_blog_sanitize_checkbox',
	)
);

$wp_customize->add_control(
	new Web_Blog_Toggle_Checkbox_Custom_control(
		$wp_customize,
		'web_blog_enable_archive_author',
		array(
			'label'    => esc_html__( 'Enable Author', 'web-blog' ),
			'settings' => 'web_blog_enable_archive_author',
			'section'  => 'web_blog_archive_page_options',
			'type'     => 'checkbox',
		)
	)
);

// Enable archive page date setting.
$wp_customize->add_setting(
	'web_blog_enable_archive_date',
	array(
		'default'           => true,
		'sanitize_callback' => 'web_blog_sanitize_checkbox',
	)
);

$wp_customize->add_control(
	new Web_Blog_Toggle_Checkbox_Custom_control(
		$wp_customize,
		'web_blog_enable_archive_date',
		array(
			'label'    => esc_html__( 'Enable Date', 'web-blog' ),
			'settings' => 'web_blog_enable_archive_date',
			'section'  => 'web_blog_archive_page_options',
			'type'     => 'checkbox',
		)
	)
);
