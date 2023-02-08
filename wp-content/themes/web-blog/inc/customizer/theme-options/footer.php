<?php
/**
 * Footer copyright
 */

// Footer copyright
$wp_customize->add_section(
	'web_blog_footer_section',
	array(
		'title' => esc_html__( 'Footer Options', 'web-blog' ),
		'panel' => 'web_blog_theme_options_panel',
	)
);

$copyright_default = sprintf( esc_html_x( 'Copyright &copy; %1$s %2$s', '1: Year, 2: Site Title with home URL', 'web-blog' ), '[the-year]', '[site-link]' );

// Footer copyright setting.
$wp_customize->add_setting(
	'web_blog_copyright_txt',
	array(
		'default'           => $copyright_default,
		'sanitize_callback' => 'web_blog_sanitize_html',
	)
);

$wp_customize->add_control(
	'web_blog_copyright_txt',
	array(
		'label'   => esc_html__( 'Copyright text', 'web-blog' ),
		'section' => 'web_blog_footer_section',
		'type'    => 'textarea',
	)
);
