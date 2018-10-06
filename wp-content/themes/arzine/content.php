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