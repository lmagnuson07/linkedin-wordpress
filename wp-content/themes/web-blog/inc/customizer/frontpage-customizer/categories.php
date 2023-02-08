<?php
/**
 * Adore Themes Customizer
 *
 * @package Web Blog
 *
 * Categories Section
 */

$wp_customize->add_section(
	'web_blog_categories_section',
	array(
		'title' => esc_html__( 'Categories Section', 'web-blog' ),
		'panel' => 'web_blog_frontpage_panel',
	)
);

// Categories Section section enable settings.
$wp_customize->add_setting(
	'web_blog_categories_section_enable',
	array(
		'default'           => false,
		'sanitize_callback' => 'web_blog_sanitize_checkbox',
	)
);

$wp_customize->add_control(
	new Web_Blog_Toggle_Checkbox_Custom_control(
		$wp_customize,
		'web_blog_categories_section_enable',
		array(
			'label'    => esc_html__( 'Enable Categories Section', 'web-blog' ),
			'type'     => 'checkbox',
			'settings' => 'web_blog_categories_section_enable',
			'section'  => 'web_blog_categories_section',
		)
	)
);

// Categories Section title settings.
$wp_customize->add_setting(
	'web_blog_categories_title',
	array(
		'default'           => __( 'Posts Categories', 'web-blog' ),
		'sanitize_callback' => 'sanitize_text_field',
	)
);

$wp_customize->add_control(
	'web_blog_categories_title',
	array(
		'label'           => esc_html__( 'Section Title', 'web-blog' ),
		'section'         => 'web_blog_categories_section',
		'active_callback' => 'web_blog_if_categories_enabled',
	)
);

// Abort if selective refresh is not available.
if ( isset( $wp_customize->selective_refresh ) ) {
	$wp_customize->selective_refresh->add_partial(
		'web_blog_categories_title',
		array(
			'selector'            => '.categories-section h3.section-title',
			'settings'            => 'web_blog_categories_title',
			'container_inclusive' => false,
			'fallback_refresh'    => true,
			'render_callback'     => 'web_blog_categories_title_text_partial',
		)
	);
}

// Categories Section subtitle settings.
$wp_customize->add_setting(
	'web_blog_categories_subtitle',
	array(
		'default'           => '',
		'sanitize_callback' => 'sanitize_text_field',
	)
);

$wp_customize->add_control(
	'web_blog_categories_subtitle',
	array(
		'label'           => esc_html__( 'Section Subtitle', 'web-blog' ),
		'section'         => 'web_blog_categories_section',
		'active_callback' => 'web_blog_if_categories_enabled',
	)
);

// View All button label setting.
$wp_customize->add_setting(
	'web_blog_categories_view_all_button_label',
	array(
		'default'           => __( 'View All', 'web-blog' ),
		'sanitize_callback' => 'sanitize_text_field',
	)
);

$wp_customize->add_control(
	'web_blog_categories_view_all_button_label',
	array(
		'label'           => esc_html__( 'View All Button Label', 'web-blog' ),
		'section'         => 'web_blog_categories_section',
		'settings'        => 'web_blog_categories_view_all_button_label',
		'type'            => 'text',
		'active_callback' => 'web_blog_if_categories_enabled',
	)
);

// Abort if selective refresh is not available.
if ( isset( $wp_customize->selective_refresh ) ) {
	$wp_customize->selective_refresh->add_partial(
		'web_blog_categories_view_all_button_label',
		array(
			'selector'            => '.categories-section .adore-view-all',
			'settings'            => 'web_blog_categories_view_all_button_label',
			'container_inclusive' => false,
			'fallback_refresh'    => true,
			'render_callback'     => 'web_blog_categories_view_all_button_label_text_partial',
		)
	);
}

// View All button URL setting.
$wp_customize->add_setting(
	'web_blog_categories_view_all_button_url',
	array(
		'default'           => '#',
		'sanitize_callback' => 'esc_url_raw',
	)
);

$wp_customize->add_control(
	'web_blog_categories_view_all_button_url',
	array(
		'label'           => esc_html__( 'View All Button Link', 'web-blog' ),
		'section'         => 'web_blog_categories_section',
		'settings'        => 'web_blog_categories_view_all_button_url',
		'type'            => 'url',
		'active_callback' => 'web_blog_if_categories_enabled',
	)
);

for ( $i = 1; $i <= 5; $i++ ) {

	// categories category setting.
	$wp_customize->add_setting(
		'web_blog_categories_category_' . $i,
		array(
			'sanitize_callback' => 'web_blog_sanitize_select',
		)
	);

	$wp_customize->add_control(
		'web_blog_categories_category_' . $i,
		array(
			'label'           => sprintf( esc_html__( 'Category %d', 'web-blog' ), $i ),
			'section'         => 'web_blog_categories_section',
			'settings'        => 'web_blog_categories_category_' . $i,
			'type'            => 'select',
			'choices'         => web_blog_get_post_cat_choices(),
			'active_callback' => 'web_blog_if_categories_enabled',
		)
	);

	// categories bg image.
	$wp_customize->add_setting(
		'web_blog_categories_image_' . $i,
		array(
			'default'           => '',
			'sanitize_callback' => 'web_blog_sanitize_image',
		)
	);

	$wp_customize->add_control(
		new WP_Customize_Image_Control(
			$wp_customize,
			'web_blog_categories_image_' . $i,
			array(
				'label'           => sprintf( esc_html__( 'Category Image %d', 'web-blog' ), $i ),
				'section'         => 'web_blog_categories_section',
				'settings'        => 'web_blog_categories_image_' . $i,
				'active_callback' => 'web_blog_if_categories_enabled',
			)
		)
	);

}

/*========================Active Callback==============================*/
function web_blog_if_categories_enabled( $control ) {
	return $control->manager->get_setting( 'web_blog_categories_section_enable' )->value();
}

/*========================Partial Refresh==============================*/
if ( ! function_exists( 'web_blog_categories_title_text_partial' ) ) :
	// Title.
	function web_blog_categories_title_text_partial() {
		return esc_html( get_theme_mod( 'web_blog_categories_title' ) );
	}
endif;
if ( ! function_exists( 'web_blog_categories_view_all_button_label_text_partial' ) ) :
	// Title.
	function web_blog_categories_view_all_button_label_text_partial() {
		return esc_html( get_theme_mod( 'web_blog_categories_view_all_button_label' ) );
	}
endif;
