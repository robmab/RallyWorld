<?php
/**
 * Template Name: AT Builder Page
 *
 * @link https://developer.wordpress.org/themes/template-files-section/page-template-files/
 *
 * @package Acme Themes
 * @subpackage Fitness Hub
 */
get_header();
global $fitness_hub_customizer_all_values;
$fitness_hub_template_builder_header_options_meta = get_post_meta( $post->ID, 'fitness_hub_template_builder_header_options', true );

if(
	'hide-header' != $fitness_hub_template_builder_header_options_meta
){
	?>
	<div class="wrapper inner-main-title">
		<?php
		echo fitness_hub_get_header_normal_image();
		?>
		<div class="container">
			<header class="entry-header init-animate">
				<?php
				the_title( '<h1 class="entry-title">', '</h1>' );

				fitness_hub_breadcrumbs();
				?>
			</header><!-- .entry-header -->
		</div>
	</div>
	<?php
}

while ( have_posts() ) : the_post();

    the_content();

endwhile; // End of the loop.

get_footer();