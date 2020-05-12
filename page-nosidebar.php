<?php
/**
 * Template Name: Page Without Sidebar
 */
?>
<?php get_header(); ?>
<?php $options = get_option('report'); ?>
<div id="page">
	<div class="content">
		<article class="ss-full-width">
			<div id="content_box" >
				<div id="content" class="hfeed">
					<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>
						<div id="post-<?php the_ID(); ?>" <?php post_class('g post'); ?>>
							<?php if ($options['mts_breadcrumb'] == '1') {
								if( function_exists( 'rank_math' ) && rank_math()->breadcrumbs ) {
								    rank_math_the_breadcrumbs();
								  } else { ?>
								    <div class="breadcrumb" xmlns:v="http://rdf.data-vocabulary.org/#"><?php the_breadcrumb(); ?></div>
								<?php }
							} ?>
							<header>
								<h1 class="title"><?php the_title(); ?></h1>
							</header>
							<div class="post-content box mark-links">
								<?php the_content(); ?>
								<?php wp_link_pages('before=<div class="pagination">&after=</div>'); ?>
							</div><!--.post-content box mark-links -->
						</div><!--.g post-->
						<?php comments_template( '', true ); ?>
					<?php endwhile; ?>
				</div>
			</div>
		</article>
<?php get_footer(); ?>