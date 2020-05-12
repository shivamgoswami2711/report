<?php get_header(); ?>
<?php $options = get_option('report'); ?>
<div id="page" class="single">
	<div class="content">
		<article class="article">
			<div id="content_box" >
				<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>
					<div id="post-<?php the_ID(); ?>" <?php post_class('g post'); ?>>
						<?php if ($options['mts_breadcrumb'] == '1') {
							the_breadcrumb();
						} ?>
						<h1 class="title single-title"><?php the_title(); ?></h1>
						<?php if($options['mts_headline_meta'] == '1') { ?>
							<div class="post-info">
								<span class="theauthor"> <?php _e('posted by ','mythemeshop'); ?><?php the_author_posts_link(); ?></span>
								<time><?php the_time('F j, Y'); ?></time>
								<span class="thecategory"><?php the_category(', ') ?></span>
							</div>
						<?php }?>
						<?php if($options['mts_social_buttons'] == '1') { ?>
							<div class="shareit">
								<?php if($options['mts_twitter'] == '1') { ?>
										<!-- Twitter -->
										<span class="share-item twitterbtn">
										<a href="https://twitter.com/share" class="twitter-share-button" data-via="<?php echo $options['mts_twitter_username']; ?>">Tweet</a>
										</span>
								<?php } ?>
								<?php if($options['mts_gplus'] == '1') { ?>
										<!-- GPlus -->
										<span class="share-item gplusbtn">
										<g:plusone size="medium"></g:plusone>
										</span>
								<?php } ?>
								<?php if($options['mts_facebook'] == '1') { ?>
										<!-- Facebook -->
										<span class="share-item facebookbtn">
										<div class="fb-like" data-send="false" data-layout="button_count" data-width="150" data-show-faces="false"></div>
										</span>
								<?php } ?>
								<?php if($options['mts_linkedin'] == '1') { ?>
										<!--Linkedin -->
										<span class="share-item linkedinbtn">
										<script type="text/javascript" src="http://platform.linkedin.com/in.js"></script><script type="in/share" data-url="<?php the_permalink(); ?>" data-counter="right"></script>
										</span>
								<?php } ?>
								<?php if($options['mts_stumble'] == '1') { ?>
										<!-- Stumble -->
										<span class="share-item stumblebtn">
										<su:badge layout="1"></su:badge>
										<script type="text/javascript">
										(function() {
										var li = document.createElement('script'); li.type = 'text/javascript'; li.async = true;
										li.src = window.location.protocol + '//platform.stumbleupon.com/1/widgets.js';
										var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(li, s);
										})();
										</script>
										</span>
								<?php } ?>
								<?php if($options['mts_pinterest'] == '1') { ?>
										<!-- Pinterest -->
										<span class="share-item pinbtn">
										<a href="http://pinterest.com/pin/create/button/?url=<?php the_permalink(); ?>&media=<?php $thumb = wp_get_attachment_image_src( get_post_thumbnail_id(get_the_ID()), 'large' ); echo $thumb['0']; ?>&description=<?php the_title(); ?>" class="pin-it-button" count-layout="horizontal">Pin It</a>
										<script type="text/javascript" src="//assets.pinterest.com/js/pinit.js"></script>
										</span>
								<?php } ?>
							</div>
						<?php } ?><!--Shareit-->
						<?php if($options['mts_single_thumb'] == '1') { ?>
							<?php if ( has_post_thumbnail() ) { ?>
								<?php echo the_post_thumbnail('slider',array('title' => ''));?>
							<?php }?>
						<?php }?>
						<div id="single-post-wrapper">
							<div class="post-content box mark-links">
								<?php if ($options['mts_posttop_adcode'] != '') { ?>
									<?php $toptime = $options['mts_posttop_adcode_time']; if (strcmp( date("Y-m-d", strtotime( "-$toptime day")), get_the_time("Y-m-d") ) >= 0) { ?>
										<div class="topad">
											<?php echo $options['mts_posttop_adcode']; ?>
										</div>
									<?php } ?>
								<?php } ?>
								<?php the_content(); ?>
								<?php wp_link_pages('before=<div class="pagination2">&after=</div>'); ?>
								<?php if($options['mts_tags'] == '1') { ?>
									<div class="tags"><?php the_tags('<span class="tagtext">Tags:</span>',' ') ?></div>
								<?php } ?>
							</div>
						</div><!--.post-content box mark-links-->
						<?php if($options['mts_author_box'] == '1') { ?>
							<div class="postauthor">
							<h4><?php _e('About Author', 'mythemeshop'); ?></h4>
								<?php if(function_exists('get_avatar')) { echo get_avatar( get_the_author_meta('email'), '75' );  } ?>
								<h5><?php the_author_meta( 'nickname' ); ?></h5>
								<p><?php the_author_meta('description') ?></p>
							</div>
						<?php } ?>
						<div class="intercept">
							<div class="Intercept-1">
								<div class="IPLeft">
									<?php if ($options['mts_postend_adcode'] != '') { ?>
										<div class="bottomad">
											<?php echo(stripslashes ($options['mts_postend_adcode']));?>
										</div>
										<span><?php _e('Advertisement','mythemeshop'); ?></span>
									<?php } ?>
								</div>
								<div class="IPRight">
									<?php if($options['mts_related_posts'] == '1') { ?>
										<div class="related-posts">
											<?php $categories = get_the_category(get_the_ID()); if ($categories) { $category_ids = array(); foreach($categories as $individual_category) $category_ids[] = $individual_category->term_id; $args=array( 'category__in' => $category_ids, 'post__not_in' => array(get_the_ID()), 'showposts'=>3, 'orderby' => 'rand', 'ignore_sticky_posts'=>1 ); $my_query = new wp_query( $args ); if( $my_query->have_posts() ) { echo '<h3>'.__('Related Posts','mythemeshop').'</h3><ul>'; while( $my_query->have_posts() ) { $my_query->the_post(); ?>
											<li>
												<a class="relatedthumb" href="<?php the_permalink()?>" rel="bookmark" title="<?php the_title(); ?>">
													<?php if (strlen($post->post_title) > 52) { echo substr(the_title($before = '', $after = '', FALSE), 0, 52) . '...'; } else { the_title(); } ?>
												</a>
												<span class='navtext'><?php _e('By ','mythemeshop'); the_author_meta( 'nickname' ); ?></span>
											</li>
											<?php } echo '</ul>'; } } wp_reset_query(); ?>
										</div><!-- .related-posts -->
									<?php } ?>
								</div>
								<div class="clear"></div>
							</div>
						</div>
					</div><!--.g post-->
					<?php comments_template( '', true ); ?>
				<?php endwhile; /* end loop */ ?>
			</div>
		</article>
		<?php get_sidebar(); ?>
<?php get_footer(); ?>
