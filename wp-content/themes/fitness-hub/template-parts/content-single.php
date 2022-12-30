<?php
/**
 * Template part for displaying single posts.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Acme Themes
 * @subpackage Fitness Hub
 */
$no_blog_image = '';
global $fitness_hub_customizer_all_values;

?>
<article id="post-<?php the_ID(); ?>" <?php post_class('init-animate'); ?>>
	<div class="content-wrapper">
		<?php
		$fitness_hub_hide_single_featured_image = fitness_hub_featured_image_display( );
		if( has_post_thumbnail() && 'disable' != $fitness_hub_hide_single_featured_image ):
			echo '<div class="image-wrap"><figure class="post-thumb">';
			the_post_thumbnail( $fitness_hub_hide_single_featured_image );
			if ( 'post' === get_post_type() && has_category() ) : ?>
                <header class="entry-header <?php echo $no_blog_image; ?>">
                    <div class="entry-meta">
						<?php
						fitness_hub_cats_lists()
						?>
                    </div><!-- .entry-meta -->
                </header><!-- .entry-header -->
				<?php
				echo "</figure></div>";
			endif;
			else:
				$no_blog_image = 'no-image';
		endif;

		?>
		<div class="entry-content <?php echo $no_blog_image?>">
			<?php
			if ( 'post' === get_post_type() && has_category() ) : ?>
				<div class="blog-header-wrap">
					<div class="date">
						<?php fitness_hub_entry_footer( 1,0, 0, 0 ); ?>
					</div>
					<div class="blog-header">
		                <header class="entry-header <?php echo $no_blog_image; ?>">
		                    <div class="entry-meta">
								<?php
								fitness_hub_cats_lists()
								?>
		                    </div><!-- .entry-meta -->
		                </header><!-- .entry-header -->
		                <div class="entry-header-title">
		                	<?php
		                	the_title( '<h1 class="entry-title">', '</h1>' );
		                	?>
		                </div>
		                <footer class="entry-footer">
		                	<?php fitness_hub_entry_footer( 0,  1, 1, 0 ); ?>
		                </footer><!-- .entry-footer -->
						
					</div>
				</div>
			<?php
			endif;

			the_content();
			wp_link_pages( array(
				'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'fitness-hub' ),
				'after'  => '</div>',
			) );
            ?>
		</div><!-- .entry-content -->
	</div>
</article><!-- #post-## -->