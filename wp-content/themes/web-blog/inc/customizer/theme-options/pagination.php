<?php
/**
 * Pagination setting
 */

// Pagination setting.
$wp_customize->add_section(
	'web_blog_pagination',
	array(
		'title' => esc_html__( 'Pagination', 'web-blog' ),
		'panel' => 'web_blog_theme_options_panel',
	)
);

// Pagination enable setting.
$wp_customize->add_setting(
	'web_blog_pagination_enable',
	array(
		'default'           => true,
		'sanitize_callback' => 'web_blog_sanitize_checkbox',
	)
);

$wp_customize->add_control(
	new Web_Blog_Toggle_Checkbox_Custom_control(
		$wp_customize,
		'web_blog_pagination_enable',
		array(
			'label'    => esc_html__( 'Enable Pagination.', 'web-blog' ),
			'settings' => 'web_blog_pagination_enable',
			'section'  => 'web_blog_pagination',
			'type'     => 'checkbox',
		)
	)
);

// Pagination - Pagination Style.
$wp_customize->add_setting(
	'web_blog_pagination_type',
	array(
		'default'           => 'numeric',
		'sanitize_callback' => 'web_blog_sanitize_select',
	)
);

$wp_customize->add_control(
	'web_blog_pagination_type',
	array(
		'label'           => esc_html__( 'Pagination Style', 'web-blog' ),
		'section'         => 'web_blog_pagination',
		'type'            => 'select',
		'choices'         => array(
			'default' => __( 'Default (Older/Newer)', 'web-blog' ),
			'numeric' => __( 'Numeric', 'web-blog' ),
		),
		'active_callback' => function( $control ) {
			return ( $control->manager->get_setting( 'web_blog_pagination_enable' )->value() );
		},
	)
);
