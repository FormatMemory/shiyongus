<?php
/**
 * The template for displaying posts in the Quote post format.
 *
 * @package metro-creativex
 */
?>
			<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
				<div class="post_icon" style="background-image:url(<?php echo get_template_directory_uri(); ?>/images/pt_quote.png);"></div>
				<div class="post_content">
					<div class="excerpt format" style="text-align: center;">
						<?php  echo get_the_excerpt(); ?>
					</div><!--/excerpt-->
					<div class="post_date"><?php the_time( get_option( 'date_format' ) ); ?></div>
				</div><!--/post_content-->
			</article>
