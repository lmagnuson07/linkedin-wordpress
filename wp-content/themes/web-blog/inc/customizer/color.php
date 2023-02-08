<?php

/**
 * Color Options
 */

// Site tagline color setting.
$wp_customize->add_setting(
	'web_blog_header_tagline',
	array(
		'default'           => '#cd7140',
		'sanitize_callback' => 'web_blog_sanitize_hex_color',
	)
);

$wp_customize->add_control(
	new WP_Customize_Color_Control(
		$wp_customize,
		'web_blog_header_tagline',
		array(
			'label'   => esc_html__( 'Site tagline Color', 'web-blog' ),
			'section' => 'colors',
		)
	)
);
