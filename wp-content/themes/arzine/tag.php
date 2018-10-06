<?php
/**
 * The Tag template file
 * @package WordPress
 */
get_header(); 
?>
<!-- Page Title -->
<section class="page-header">
	<div class="container">
		<div class="row">
			<div class="col-md-6">
				<div class="page-title">
					<h2><?php  _e( "Tag  Archive ", 'arzine'); echo single_cat_title( '', false ); ?></h2>
					<p><?php bloginfo('description');?></p>
				</div>
			</div>
			<div class="col-md-6">
				<ul class="page-breadcrumb">
					<?php if (function_exists('busiprof_custom_breadcrumbs')) busiprof_custom_breadcrumbs();?>
				</ul>
			</div>
		</div>
	</div>	
</section>
<!-- End of Page Title -->
<div class="clearfix"></div>

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
				?>
			</div>
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
		<?php get_sidebar();?>
		
		</div>
	</div>
</section>
<!-- End of Blog Masonry 3 Column Section -->
 
<div class="clearfix"></div>

<?php get_footer(); ?>