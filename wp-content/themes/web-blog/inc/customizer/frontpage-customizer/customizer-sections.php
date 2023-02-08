<?php

// Home Page Customizer panel.
$wp_customize->add_panel(
	'web_blog_frontpage_panel',
	array(
		'title'    => esc_html__( 'Frontpage Sections', 'web-blog' ),
		'priority' => 140,
	)
);

$customizer_settings = array( 'categories', 'posts-carousel' );

foreach ( $customizer_settings as $customizer ) {

	require get_template_directory() . '/inc/customizer/frontpage-customizer/' . $customizer . '.php';

}
