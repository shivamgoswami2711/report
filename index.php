<?php $options = get_option('report'); ?>
<?php get_header(); ?>
<div id="page">
	<div class="content">
		<article class="article">
			<div id="content_box">
				<?php if (is_home() && !is_paged()) { ?>
					<?php if( isset( $options['mts_featured_slider'] ) && $options['mts_featured_slider'] == '1') { ?>
						<div class="flex-container">
							<div class="flexslider">
								<ul class="slides">
									<?php $my_query = new WP_Query('cat='.$options['mts_featured_cat'].'&posts_per_page=3'); while ($my_query->have_posts()) : $my_query->the_post(); ?>
									<li>
										<a href="<?php the_permalink() ?>">
											<?php the_post_thumbnail('slider',array('title' => '')); ?>
											<p class="flex-caption">
												<span class="slidertitle"><?php the_title(); ?></span>
												<span class="slidertext"><?php echo excerpt(20); ?></span>
											</p>
										</a>
									</li>
								   <?php endwhile; ?>
								</ul>
							</div>
						</div>
					<?php } ?>
				<?php } ?>
				<div class="leftCatBox">
                    <?php global $wpdb; $i = 1; $my_query = new wp_query( 'cat='.$options['mts_featured_first_cat'].'&posts_per_page=4' ); ?>
						<?php if ($my_query->have_posts()) : while ($my_query->have_posts()) : $my_query->the_post(); ?>
							<?php if($i == 1){ ?>
								<div class="post excerpt">
									<header>
										<div class="category-head">
											<?php $category = get_the_category(); echo $category[0]->cat_name;?>
										</div>
										<a href="<?php the_permalink() ?>" title="<?php the_title(); ?>" id="featured-thumbnail">
											<?php if ( has_post_thumbnail() ) { ?>
											<?php echo '<div class="featured-thumbnail">'; the_post_thumbnail('featured',array('title' => '')); echo '</div>'; ?>
											<?php } else { ?>
												<div class="featured-thumbnail">
													<img width="300" height="150" src="<?php echo get_template_directory_uri(); ?>/images/nothumb.png" class="attachment-featured wp-post-image" alt="<?php the_title(); ?>">
												</div>
											<?php } ?>
										</a>
										<h2 class="title front-view-title">
											<a href="<?php the_permalink() ?>" title="<?php the_title(); ?>" rel="bookmark"><?php the_title(); ?></a>
										</h2>
									</header><!--.header-->
									<div class="post-content image-caption-format-1 front-view-text">
										<?php echo excerpt(17);?>
									</div>
								</div><!--.post excerpt-->
							<?php } else {?>
							<div class="post excerptsmall <?php if($i == 4){echo 'last';} ?>">
                                <div class="frontThumb">
									<a href="<?php the_permalink() ?>" title="<?php the_title(); ?>" id="featured-thumbnail">
										<?php if ( has_post_thumbnail() ) { ?>
											<?php echo '<div class="featured-thumbnail-small">'; the_post_thumbnail('related',array('title' => '')); echo '</div>'; ?>
										<?php } else { ?>
											<div class="featured-thumbnail-small">
												<img width="50" height="50" src="<?php echo get_template_directory_uri(); ?>/images/nothumb50.png" class="attachment-featured wp-post-image" alt="<?php the_title(); ?>">
											</div>
										<?php } ?>
									</a>
                                </div>
                                <div class="frontContentSmall">
									<div class="category-head-small"><?php $category = get_the_category(); echo $category[0]->cat_name;?></div>
									<h2 class="title front-view-title-small">
										<a href="<?php the_permalink() ?>" title="<?php the_title(); ?>" rel="bookmark"><?php the_title(); ?></a>
									</h2>
									<div class="post-content image-caption-format-1 front-view-text-small">
										<?php echo excerpt(10);?>
									</div>
									<div class="timeDate"><?php the_time('j F'); ?> | <?php _e('by ','mythemeshop'); ?><?php the_author_posts_link(); ?></div>
								</div>
							</div><!--.post excerpt-->
                        <?php } ?>
					<?php $i++; endwhile; endif; ?>
				</div>
				<div class="rightCatBox">
                    <?php $i = 1; $my_query = new wp_query( 'cat='.$options['mts_featured_second_cat'].'&posts_per_page=4' ); ?>
					<?php if ($my_query->have_posts()) : while ($my_query->have_posts()) : $my_query->the_post(); ?>
						<?php if($i == 1){ ?>
							<div class="post excerpt">
								<header>
									<div class="category-head">
										<?php $category = get_the_category(); echo $category[0]->cat_name;?>
									</div>
									<a href="<?php the_permalink() ?>" title="<?php the_title(); ?>" id="featured-thumbnail">
										<?php if ( has_post_thumbnail() ) { ?>
											<?php echo '<div class="featured-thumbnail">'; the_post_thumbnail('featured',array('title' => '')); echo '</div>'; ?>
										<?php } else { ?>
											<div class="featured-thumbnail">
												<img width="300" height="150" src="<?php echo get_template_directory_uri(); ?>/images/nothumb.png" class="attachment-featured wp-post-image" alt="<?php the_title(); ?>">
											</div>
										<?php } ?>
									</a>
									<h2 class="title front-view-title">
										<a href="<?php the_permalink() ?>" title="<?php the_title(); ?>" rel="bookmark"><?php the_title(); ?></a>
									</h2>
								</header><!--.header-->
								<div class="post-content image-caption-format-1 front-view-text">
									<?php echo excerpt(17);?>
								</div>
							</div><!--.post excerpt-->
						<?php } else{ ?>
							<div class="post excerptsmall <?php if($i == 4){echo 'last';} ?>">
								<div class="frontThumb">
									<a href="<?php the_permalink() ?>" title="<?php the_title(); ?>" id="featured-thumbnail">
										<?php if ( has_post_thumbnail() ) { ?>
											<?php echo '<div class="featured-thumbnail-small">'; the_post_thumbnail('related',array('title' => '')); echo '</div>'; ?>
										<?php } else { ?>
											<div class="featured-thumbnail-small">
												<img width="50" height="50" src="<?php echo get_template_directory_uri(); ?>/images/nothumb50.png" class="attachment-featured wp-post-image" alt="<?php the_title(); ?>">
											</div>
										<?php } ?>
									</a>
								</div>
								<div class="frontContentSmall">
									<div class="category-head-small"><?php $category = get_the_category(); echo $category[0]->cat_name;?></div>
									<h2 class="title front-view-title-small">
										<a href="<?php the_permalink() ?>" title="<?php the_title(); ?>" rel="bookmark"><?php the_title(); ?></a>
									</h2>
									<div class="post-content image-caption-format-1 front-view-text-small">
										<?php echo excerpt(10);?>
									</div>
									<div class="timeDate"><?php the_time('j F'); ?> | <?php _e('by ','mythemeshop'); ?><?php the_author_posts_link(); ?></div>
								</div>
							</div><!--.post excerpt-->
						<?php } ?>
					<?php $i++; endwhile; endif; ?>
				</div>
				<div id="frontNewsBox">
                    <?php $i = 1; $my_query = new wp_query( 'cat='.$options['mts_featured_third_cat'].'&posts_per_page=3' ); ?>
					<?php if ($my_query->have_posts()) : while ($my_query->have_posts()) : $my_query->the_post(); ?>
						<div class="imageBB <?php if($i == 3){echo 'last';} ?>">
							<a href="<?php the_permalink() ?>" title="<?php the_title(); ?>" rel="bookmark">
								<?php if ( has_post_thumbnail() ) { ?>
									<?php the_post_thumbnail('news',array('title' => '')); ?>
								<?php } else { ?>
									<img width="200" height="200" src="<?php echo get_template_directory_uri(); ?>/images/nothumb200.png" class="attachment-featured wp-post-image" alt="<?php the_title(); ?>">
								<?php } ?>
								<span class="bbtitle"><?php the_title(); ?></span>
								<?php $f3cat=$options['mts_featured_third_cat']; if($i == 1){echo '<span class="bbcat">'.get_the_category_by_id($f3cat).'</span>';}else{echo'';} ?>
							</a>
						</div>
                    <?php $i++; endwhile; endif;?>
				</div>
				<div id="frontLastCatBox">
					<div class="leftLastCatBox">
						<?php $i = 1; $my_query = new wp_query( 'cat='.$options['mts_featured_forth_cat'].'&posts_per_page=4' ); ?>
						<?php if ($my_query->have_posts()) : while ($my_query->have_posts()) : $my_query->the_post(); ?>
							<?php if($i == 1){ ?>
								<div class="leftLastCatBoxLeft">
									<a href="<?php the_permalink() ?>" title="<?php the_title(); ?>">
										<?php if ( has_post_thumbnail() ) { ?>
											<?php echo '<div class="featured-thumbnail">'; the_post_thumbnail('featured',array('title' => '')); echo '</div>'; ?>
										<?php } else { ?>
											<div class="featured-thumbnail">
												<img width="300" height="150" src="<?php echo get_template_directory_uri(); ?>/images/nothumb.png" class="attachment-featured wp-post-image" alt="<?php the_title(); ?>">
											</div>
										<?php } ?>
									</a>
									<h2 class="title front-cat-title">
										<a href="<?php the_permalink() ?>" title="<?php the_title(); ?>" rel="bookmark"><?php the_title(); ?></a>
									</h2>
									<div class="timeDate"><?php the_time('j F'); ?> | <?php _e('by ','mythemeshop'); ?><?php the_author_posts_link(); ?></div>
									<div class="post-content image-caption-format-1 front-cat-text">
										<?php echo excerpt(25);?>
									</div>
								</div>
							<?php } else { ?>
								<div class="leftLastCatBoxRight <?php if($i == 4){echo 'last';} ?>">
									<div class="post excerptsmall">
										<div class="frontThumb">
											<a href="<?php the_permalink() ?>" title="<?php the_title(); ?>" id="featured-thumbnail">
												<?php if ( has_post_thumbnail() ) { ?>
													<?php echo '<div class="featured-thumbnail-small">'; the_post_thumbnail('related',array('title' => '')); echo '</div>'; ?>
												<?php } else { ?>
													<div class="featured-thumbnail-small">
														<img width="50" height="50" src="<?php echo get_template_directory_uri(); ?>/images/nothumb50.png" class="attachment-featured wp-post-image" alt="<?php the_title(); ?>">
													</div>
												<?php } ?>
											</a>
										</div>
										<div class="frontContentSmall">
											<div class="category-head-small"><?php $category = get_the_category(); echo $category[0]->cat_name;?></div>
											<h2 class="title front-view-title-small">
												<a href="<?php the_permalink() ?>" title="<?php the_title(); ?>" rel="bookmark"><?php the_title(); ?></a>
											</h2>
											<div class="post-content image-caption-format-1 front-view-text-small">
												<?php echo excerpt(10);?>
											</div>
											<div class="timeDate"></div>
										</div>
									</div><!--.post excerpt-->
								</div>
							<?php } ?>
						<?php $i++; endwhile; endif;?>
					</div>
				</div>
			</div>
		</article>
		<?php get_sidebar(); ?>
<?php get_footer(); ?>
