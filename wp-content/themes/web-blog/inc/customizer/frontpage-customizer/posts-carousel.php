<?php
/**
 * Adore Themes Customizer
 *
 * @package Web Blog
 *
 * Posts Carousel Section
 */

$wp_customize->add_section(
	'web_blog_posts_carousel_section',
	array(
		'title' => esc_html__( 'Posts Carousel Section', 'web-blog' ),
		'panel' => 'web_blog_frontpage_panel',
	)
);

// Posts Carousel enable setting.
$wp_customize->add_setting(
	'web_blog_posts_carousel_section_enable',
	array(
		'default'           => false,
		'sanitize_callback' => 'web_blog_sanitize_checkbox',
	)
);

$wp_customize->add_control(
	new Web_Blog_Toggle_Checkbox_Custom_control(
		$wp_customize,
		'web_blog_posts_carousel_section_enable',
		array(
			'label'    => esc_html__( 'Enable Posts Carousel Section', 'web-blog' ),
			'type'     => 'checkbox',
			'settings' => 'web_blog_posts_carousel_section_enable',
			'section'  => 'web_blog_posts_carousel_section',
		)
	)
);

// Posts Carousel title settings.
$wp_customize->add_setting(
	'web_blog_posts_carousel_title',
	array(
		'default'           => __( 'Posts Carousel', 'web-blog' ),
		'sanitize_callback' => 'sanitize_text_field',
	)
);

$wp_customize->add_control(
	'web_blog_posts_carousel_title',
	array(
		'label'           => esc_html__( 'Section Title', 'web-blog' ),
		'section'         => 'web_blog_posts_carousel_section',
		'active_callback' => 'web_blog_if_posts_carousel_enabled',
	)
);

// Abort if selective refresh is not available.
if ( isset( $wp_customize->selective_refresh ) ) {
	$wp_customize->selective_refresh->add_partial(
		'web_blog_posts_carousel_title',
		array(
			'selector'            => '.post-carousel-section h3.section-title',
			'settings'            => 'web_blog_posts_carousel_title',
			'container_inclusive' => false,
			'fallback_refresh'    => true,
			'render_callback'     => 'web_blog_posts_carousel_title_text_partial',
		)
	);
}

// Posts Carousel subtitle settings.
$wp_customize->add_setting(
	'web_blog_posts_carousel_subtitle',
	array(
		'default'           => '',
		'sanitize_callback' => 'sanitize_text_field',
	)
);

$wp_customize->add_control(
	'web_blog_posts_carousel_subtitle',
	array(
		'label'           => esc_html__( 'Section Subtitle', 'web-blog' ),
		'section'         => 'web_blog_posts_carousel_section',
		'active_callback' => 'web_blog_if_posts_carousel_enabled',
	)
);

// View All button label setting.
$wp_customize->add_setting(
	'web_blog_posts_carousel_view_all_button_label',
	array(
		'default'           => __( 'View All', 'web-blog' ),
		'sanitize_callback' => 'sanitize_text_field',
	)
);

$wp_customize->add_control(
	'web_blog_posts_carousel_view_all_button_label',
	array(
		'label'           => esc_html__( 'View All Button Label', 'web-blog' ),
		'section'         => 'web_blog_posts_carousel_section',
		'settings'        => 'web_blog_posts_carousel_view_all_button_label',
		'type'            => 'text',
		'active_callback' => 'web_blog_if_posts_carousel_enabled',
	)
);

// Abort if selective refresh is not available.
if ( isset( $wp_customize->selective_refresh ) ) {
	$wp_customize->selective_refresh->add_partial(
		'web_blog_posts_carousel_view_all_button_label',
		array(
			'selector'            => '.post-carousel-section .adore-view-all',
			'settings'            => 'web_blog_posts_carousel_view_all_button_label',
			'container_inclusive' => false,
			'fallback_refresh'    => true,
			'render_callback'     => 'web_blog_posts_carousel_view_all_button_label_text_partial',
		)
	);
}

// View All button URL setting.
$wp_customize->add_setting(
	'web_blog_posts_carousel_view_all_button_url',
	array(
		'default'           => '#',
		'sanitize_callback' => 'esc_url_raw',
	)
);

$wp_customize->add_control(
	'web_blog_posts_carousel_view_all_button_url',
	array(
		'label'           => esc_html__( 'View All Button Link', 'web-blog' ),
		'section'         => 'web_blog_posts_carousel_section',
		'settings'        => 'web_blog_posts_carousel_view_all_button_url',
		'type'            => 'url',
		'active_callback' => 'web_blog_if_posts_carousel_enabled',
	)
);

// posts carousel content type settings.
$wp_customize->add_setting(
	'web_blog_posts_carousel_content_type',
	array(
		'default'           => 'post',
		'sanitize_callback' => 'web_blog_sanitize_select',
	)
);

$wp_customize->add_control(
	'web_blog_posts_carousel_content_type',
	array(
		'label'           => esc_html__( 'Content type:', 'web-blog' ),
		'description'     => esc_html__( 'Choose where you want to render the content from.', 'web-blog' ),
		'section'         => 'web_blog_posts_carousel_section',
		'type'            => 'select',
		'active_callback' => 'web_blog_if_posts_carousel_enabled',
		'choices'         => array(
			'post'     => esc_html__( 'Post', 'web-blog' ),
			'category' => esc_html__( 'Category', 'web-blog' ),
		),
	)
);

for ( $i = 1; $i <= 5; $i++ ) {
	// posts carousel post setting.
	$wp_customize->add_setting(
		'web_blog_posts_carousel_post_' . $i,
		array(
			'sanitize_callback' => 'web_blog_sanitize_dropdown_pages',
		)
	);

	$wp_customize->add_control(
		'web_blog_posts_carousel_post_' . $i,
		array(
			'label'           => sprintf( esc_html__( 'Post %d', 'web-blog' ), $i ),
			'section'         => 'web_blog_posts_carousel_section',
			'type'            => 'select',
			'choices'         => web_blog_get_post_choices(),
			'active_callback' => 'web_blog_posts_carousel_section_content_type_post_enabled',
		)
	);

}

// posts carousel category setting.
$wp_customize->add_setting(
	'web_blog_posts_carousel_category',
	array(
		'sanitize_callback' => 'web_blog_sanitize_select',
	)
);

$wp_customize->add_control(
	'web_blog_posts_carousel_category',
	array(
		'label'           => esc_html__( 'Category', 'web-blog' ),
		'section'         => 'web_blog_posts_carousel_section',
		'type'            => 'select',
		'choices'         => web_blog_get_post_cat_choices(),
		'active_callback' => 'web_blog_posts_carousel_section_content_type_category_enabled',
	)
);

/*========================Active Callback==============================*/
function web_blog_if_posts_carousel_enabled( $control ) {
	return $control->manager->get_setting( 'web_blog_posts_carousel_section_enable' )->value();
}
function web_blog_posts_carousel_section_content_type_post_enabled( $control ) {
	$content_type = $control->manager->get_setting( 'web_blog_posts_carousel_content_type' )->value();
	return web_blog_if_posts_carousel_enabled( $control ) && ( 'post' === $content_type );
}
function web_blog_posts_carousel_section_content_type_category_enabled( $control ) {
	$content_type = $control->manager->get_setting( 'web_blog_posts_carousel_content_type' )->value();
	return web_blog_if_posts_carousel_enabled( $control ) && ( 'category' === $content_type );
}

/*========================Partial Refresh==============================*/
if ( ! function_exists( 'web_blog_posts_carousel_title_text_partial' ) ) :
	// Title.
	function web_blog_posts_carousel_title_text_partial() {
		return esc_html( get_theme_mod( 'web_blog_posts_carousel_title' ) );
	}
endif;
if ( ! function_exists( 'web_blog_posts_carousel_view_all_button_label_text_partial' ) ) :
	// Title.
	function web_blog_posts_carousel_view_all_button_label_text_partial() {
		return esc_html( get_theme_mod( 'web_blog_posts_carousel_view_all_button_label' ) );
	}
endif;
