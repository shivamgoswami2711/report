<?php get_header(); ?>
<div id="page">
	<div class="content">
		<article class="article">
			<div id="content_box">
				<h1 class="postsby">
					<span><?php _e("Search Results for:", "mythemeshop"); ?></span> <?php the_search_query(); ?>
				</h1>
				<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
					<div class="post excerpt">
						<header>						
							<h2 class="title">
								<a href="<?php the_permalink() ?>" title="<?php the_title(); ?>" rel="bookmark"><?php the_title(); ?></a>
							</h2>
							<div class="post-info">
								<span class="theauthor"><?php the_author_posts_link(); ?></span>
								<time><?php the_time('F j, Y'); ?></time>
								<span class="thecategory"><?php the_category(', ') ?></span>
							</div>
						</header><!--.header-->
						<div class="post-content image-caption-format-1">
							<?php if ( has_post_thumbnail() ) { ?> 
								<a href="<?php the_permalink() ?>" title="<?php the_title(); ?>" id="featured-thumbnail">
									<?php echo '<div class="featured-thumbnail" style="width: 100px; height: 100px;">'; the_post_thumbnail('news',array('title' => '')); echo '</div>'; ?>
								</a>
							<?php } ?>
							<?php echo excerpt(45);?>
						</div>
					</div><!--.post excerpt-->
				<?php endwhile; else: ?>
					<div class="post excerpt">
						<div class="no-results">
							<p><strong><?php _e('There has been an error.', 'mythemeshop'); ?></strong></p>
							<p><?php _e('We apologize for any inconvenience, please hit back on your browser or use the search form below.', 'mythemeshop'); ?></p>
							<?php get_search_form(); ?>
						</div><!--noResults-->
					</div>
				<?php endif; ?>
				<?php pagination();?>		
			</div>
		</article>
		<?php get_sidebar(); ?>
<?php get_footer(); ?>