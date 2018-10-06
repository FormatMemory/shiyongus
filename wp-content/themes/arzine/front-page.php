<?php 
get_header();
?>

<?php if(!is_page_template('template-home-two.php') && !is_page_template('front-page.php')){ ?>
<!-- Page Title -->
<section class="page-header">
	<div class="container">
		<div class="row">
			<div class="col-md-6">
				<div class="page-title">
					<h2><?php 
						 the_title(); 
						?>
					</h2>
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

<?php } ?>




<!-- End of Page Title -->
<div class="clearfix"></div>
<!-- Blog Masonry 3 Column Section -->

<?php if(is_home()){ ?>
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
					?>	
					<article class="post"> 	
					<?php if(has_post_thumbnail())
					{ ?>
					<figure class="post-thumbnail">
						<a  href="<?php the_permalink(); ?>"><?php the_post_thumbnail(); ?></a>
						<?php $cat_list = get_the_category_list();
							if(!empty($cat_list)) { ?>
						<span class="cat-links"><a href="<?php the_permalink(); ?>"><?php the_category(', '); ?></a></span>
						<?php } ?>
					</figure> 
					<?php }?>
					<aside class="masonry-content">
						
						<div class="entry-meta">
						<?php $cat_list = get_the_category_list();
								if(!empty($cat_list)) {
						?>
						<?php if(!has_post_thumbnail()){ 
						?>
						<span class="cat-links"><a href="<?php the_permalink(); ?>"><?php the_category(', '); ?></a></span>
						<?php } }?>
						<span class="entry-date"><a href="<?php the_permalink(); ?>"><time datetime=""><?php the_time('M j,Y');?></time></a></span>
						</div>
						<header class="entry-header">
							<h3 class="entry-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
						</header>					
						<div class="entry-content">
							<?php the_content( __( 'Read More' , 'arzine' ) ); ?>
						</div>
						<span class="author">
						<figure class="avatar">
						<?php $author_id=$post->post_author; ?>
							<a href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ) );?>" title="<?php echo the_author_meta( 'display_name' , $author_id ); ?>"><?php echo get_avatar( get_the_author_meta( 'ID' ), 32 ); ?></a>
						</figure>
						<?php _e('by','arzine'); echo ' ';?><a rel="tag" class="name" href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ) );?>"><?php echo the_author_meta( 'display_name' , $author_id ); ?></a>
						</span>
					</aside>
				</article>
					<?php echo '</div>';
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

<?php }

elseif(is_page_template('front-page.php')){ 

   $busiprof_theme_options=theme_setup_data();
  $is_front_page = wp_parse_args(  get_option( 'busiprof_theme_options', array() ), $busiprof_theme_options );
  
  if (  $is_front_page['front_page'] != 'yes' ) {
  get_template_part('index');
  }
  else {	
  
  		get_header();
  $current_options = wp_parse_args(  get_option( 'busiprof_theme_options', array() ), $busiprof_theme_options );
  		?>
<!-- Slider Section of Index Page -->
<?php 
if($current_options['home_page_slider_enabled']=="on"){
$busiprof_slide_content = get_theme_mod('busiprof_slider_content');
	if(!empty($busiprof_slide_content)){
		get_template_part('index', 'slider') ;
	}
else
{
	get_template_part('index', 'slider-two') ;
	
}	
}
?>
<!-- Service Section of index Page -->
<?php
if( $current_options['enable_services']=="on" ) {
get_template_part('index', 'services') ;
}
 ?>
<!-- Projects Section of index Page -->
<?php if($current_options['enable_projects']=="on") {
get_template_part('index', 'projects'); }
?>
<!-- footer Section of index blog -->
<?php get_template_part('index', 'blog'); ?>
<!-- footer Section of index Testimonial -->
<?php get_template_part('index', 'testimonials-two') ; ?>
<?php get_footer(); } 

} 


elseif(is_page_template('template-home-two.php')){
	
	$busiprof_theme_options=theme_setup_data();
  $is_front_page = wp_parse_args(  get_option( 'busiprof_theme_options', array() ), $busiprof_theme_options );
  
  if (  $is_front_page['front_page'] != 'yes' ) {
  get_template_part('index');
  }
  else {	
  		get_header();
  $current_options = wp_parse_args(  get_option( 'busiprof_theme_options', array() ), $busiprof_theme_options );
  		?>
<!-- Slider Section of Index Page -->
<?php 
if($current_options['home_page_slider_enabled']=="on"){
$busiprof_slide_content = get_theme_mod('busiprof_slider_content');
	if(!empty($busiprof_slide_content)){
		get_template_part('index', 'slider') ;
	}
else
{
	get_template_part('index', 'slider-two') ;
	
}	
}
?>
<!-- Service Section of index Page -->
<?php

$busiprof_service_content  = get_option( 'busiprof_theme_options');

   if($current_options['enable_services']=="on") {
   if(empty($busiprof_service_content)){
			 get_template_part('index', 'services') ;
		}else{
			
			$json_object  = get_theme_mod( 'busiprof_service_content');
			$str_test = json_decode($json_object);
			
			$i=0;
			if(isset($str_test)){
				//print_r($str_test);
			foreach($str_test as $data){
				//print_r($data->text);
				if($data){
					$i = $i+1;
				}
			}
			
			//echo $i;
			if($i>= 0){
				get_template_part('index', 'services') ;
			}else{
			 get_template_part('index', 'services-two') ;
			}
		}else {
			get_template_part('index', 'services-two') ;
		}
		
		}

  }
 ?>
<!-- Projects Section of index Page -->
<?php if($current_options['enable_projects']=="on") {
get_template_part('index', 'projects'); }
?>
<!-- footer Section of index Testimonial -->
<!-- footer Section of index blog -->
<?php get_template_part('index', 'blog'); ?>
<!-- footer Section of index Testimonial -->
<?php get_template_part('index', 'testimonials') ; ?>
<?php get_footer(); } ?>

	
<?php } else { ?>

	<?php if(is_page_template('Page-fullwidth.php')): ?>
	
	<section>		
	<div class="container">
		<div class="row">
			<!--Blog Posts-->
			<div class="col-md-12 col-xs-12">
				<div class="page-content">
					<article id="post-<?php the_ID(); ?>" <?php post_class('post'); ?> > 					
						<div class="entry-content">
							<?php the_post(); the_content(); ?>
						</div>
					</article>
				</div>
			<?php comments_template( '', true ); // show comments ?>	
			</div>
			<!--/End of Blog Posts-->
		</div>	
	</div>
    </section>
	
	<?php else: ?>
	
		<section>		
	<div class="container">
		<div class="row">
			
			<!--Blog Detail-->
			<?php 
				if ( class_exists( 'WooCommerce' ) ) {
					
					if( is_account_page() || is_cart() || is_checkout() ) {
							echo '<div class="col-md-'.( !is_active_sidebar( "woocommerce-1" ) ?"12" :"8" ).'">'; 
					}
					else{ 
				
					echo '<div class="col-md-'.( !is_active_sidebar( "sidebar-primary" ) ?"12" :"8" ).'">'; 
					
					}
					
				}
				else{ 
				
					echo '<div class="col-md-'.( !is_active_sidebar( "sidebar-primary" ) ?"12" :"8" ).'">';
					
					} ?>
				<div class="page-content">
						<?php the_post(); echo the_content(); ?>
						<?php 
						if ( comments_open() || get_comments_number() ) {
							comments_template();
						}
						?>
				</div>
				</div>
				<!--/End of Blog Detail-->

			<?php 
				if ( class_exists( 'WooCommerce' ) ) {
					
					if( is_account_page() || is_cart() || is_checkout() ) {
							get_sidebar('woocommerce'); 
					}
					else{ 
				
					get_sidebar(); 
					
					}
					
				}
				else{ 
				
					get_sidebar(); 
					
					} ?>
			</div>
	</div>
</section>
	
	<?php endif; ?>
	
	
<?php } ?>





<!-- End of Blog Masonry 3 Column Section -->
<div class="clearfix"></div>
<?php get_footer(); ?>