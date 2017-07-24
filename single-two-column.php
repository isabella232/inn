<?php
/**
 * Single Post Template: Two Column (Classic Layout)
 * Template Name: Two Column (Classic Layout)
 * Description: Shows the post and sidebar if specified.
 */

global $shown_ids;

add_filter('body_class', function($classes) {
	$classes[] = 'classic';
	return $classes;
});

get_header();

// INN-specific adaptation for pages with particular content
//is this a page or a post in the projects post type
if ( is_page() || is_singular( 'pauinn_project' ) ) {
	get_template_part('partials/internal-subnav');
}

get_template_part('partials/internal-subnav-dropdown');
$content_class = apply_filters( 'inn_single_one_column_content_class', 'span8' );
if ( is_page( 'press' ) || is_page( 'news' ) ) $content_class .= ' stories';
?>

<div id="content" class="<?php echo $content_class; ?>" role="main">
	<?php
		while ( have_posts() ) : the_post();

			$shown_ids[] = get_the_ID();

			$partial = ( is_page() ) ? 'page' : 'single-classic';

			get_template_part( 'partials/content', $partial );

			if ( $partial == 'single-classic' ) {

				do_action( 'largo_before_post_bottom_widget_area' );

				do_action( 'largo_post_bottom_widget_area' );

				do_action( 'largo_after_post_bottom_widget_area' );

				do_action( 'largo_before_comments' );

				comments_template( '', true );

				do_action( 'largo_after_comments' );
			}

		endwhile;
	?>
</div>

<?php do_action('largo_after_content'); ?>

<?php get_sidebar(); ?>

<?php get_footer();
