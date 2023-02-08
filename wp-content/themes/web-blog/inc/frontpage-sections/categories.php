<?php
/**
 * Template part for displaying front page introduction.
 *
 * @package Web Blog
 */

// Categories Section.
$categories_section = get_theme_mod( 'web_blog_categories_section_enable', false );

if ( false === $categories_section ) {
	return;
}

$section_content = array();

$content_ids = array();

$content_ids = array();
for ( $i = 1; $i <= 5; $i++ ) {
	$content_post_id = get_theme_mod( 'web_blog_categories_category_' . $i );
	if ( ! empty( $content_post_id ) ) {
		$content_ids[] = $content_post_id;
	}
}
$args = array(
	'taxonomy'   => 'category',
	'number'     => 5,
	'include'    => array_filter( $content_ids ),
	'orderby'    => 'include',
	'hide_empty' => false,
);

$terms = get_terms( $args );
$i     = 1;
foreach ( $terms as $value ) {
	$data['title']         = $value->name;
	$data['permalink']     = get_term_link( $value->term_id );
	$data['thumbnail_url'] = get_theme_mod( 'web_blog_categories_image_' . $i, '' );
	array_push( $section_content, $data );
	$i++;
}

$section_title    = get_theme_mod( 'web_blog_categories_title', __( 'Posts Categories', 'web-blog' ) );
$section_subtitle = get_theme_mod( 'web_blog_categories_subtitle', '' );
$viewall_btn      = get_theme_mod( 'web_blog_categories_view_all_button_label', __( 'View All', 'web-blog' ) );
$viewall_btn_link = get_theme_mod( 'web_blog_categories_view_all_button_url', '#' );
?>

<div id="web_blog_categories_section" class="frontpage categories-section">
	<div class="theme-wrapper">
		<?php if ( ! empty( $section_title || $section_subtitle ) ) : ?>
			<div class="section-head">
				<div class="section-header">
					<h3 class="section-title"><?php echo esc_html( $section_title ); ?></h3>
					<p class="section-subtitle"><?php echo esc_html( $section_subtitle ); ?></p>
				</div>
				<?php if ( ! empty( $viewall_btn ) ) { ?>
					<a href="<?php echo esc_url( $viewall_btn_link ); ?>" class="adore-view-all"><?php echo esc_html( $viewall_btn ); ?></a>
				<?php } ?>
			</div>
		<?php endif; ?>
		<div class="categories-wrapper">
			<?php foreach ( $section_content as $content ) : ?>
				<div class="category-single">
					<?php if ( ! empty( $content['thumbnail_url'] ) ) { ?>
						<div class="category-img">
							<img src="<?php echo esc_url( $content['thumbnail_url'] ); ?>" alt="<?php echo esc_attr( $content['title'] ); ?>">
						</div>
					<?php } ?>
					<a href="<?php echo esc_url( $content['permalink'] ); ?>">
						<span class="title"><?php echo esc_html( $content['title'] ); ?></span>
					</a>
				</div>
			<?php endforeach; ?>
		</div>
	</div>
</div>

<?php
