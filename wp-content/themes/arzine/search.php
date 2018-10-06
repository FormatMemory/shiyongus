<?php
/**
 * The search template file
 * @package WordPress
 */
 
get_header(); 
get_template_part('index', 'bannerstrip'); // banner strip
?>

<!-- Blog & Sidebar Section -->
<section>
	<div class="container">
		<div class="row">
		<?php	echo '<div class="col-md-'.( !is_active_sidebar( "sidebar-primary" ) ?"12" :"8" ).'">'; ?>
			<div class="row site-content" id="blog-masonry">
				<?php
					if ( have_posts() ) :
					// Start the Loop.
					while ( have_posts() ) : the_post();
					echo '<div class="item">';
					get_template_part('content','');
					echo '</div>';
					endwhile;
					
					else : ?>
					<h2><?php _e( "Nothing Found", 'arzine' ); ?></h2>
					<p><?php _e( "Sorry, but nothing matched your search criteria. Please try again with some different keywords.", 'arzine' ); ?>
			
			<!-- Pagination -->			
			<div class="paginations">
				<?php
				// Previous/next page navigation.
				the_posts_pagination( array(
				'prev_text'          => __('Previous','arzine'),
				'next_text'          => __('Next','arzine'),
				'screen_reader_text' => ' ',
				) ); ?>
			</div>
			<?php endif; ?>
					<!-- /Pagination -->
		
		</div>
		</div>
		
		<?php get_sidebar();?>
		
		</div>
	</div>
</section>
<!-- End of Blog Masonry 3 Column Section -->
<div class="clearfix"></div>
<?php get_footer(); ?>