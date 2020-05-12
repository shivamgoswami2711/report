<?php $options = get_option('report'); ?>
<!DOCTYPE html>
<html class="no-js" <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo('charset'); ?>">
	<title><?php wp_title(''); ?></title>
	<?php mts_meta(); ?>
	<link rel="stylesheet" type="text/css" media="all" href="<?php bloginfo( 'stylesheet_url' ); ?>" />
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
	<?php wp_enqueue_script("jquery"); ?>
	<?php if ( is_singular() ) wp_enqueue_script( 'comment-reply' ); ?>
	<!--[if lt IE 9]>
		<script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
	<![endif]-->
	<?php wp_head(); ?>
	<?php mts_head(); ?>
</head>
<?php flush(); ?>
<body id ="blog" <?php body_class('main'); ?>>
	<div class="main-container">
		<header class="main-header">
			<div class="container">
				<div id="header">
					<?php $options = get_option('report'); if( isset( $options['mts_ticker'] ) && $options['mts_ticker'] == '1') { ?>
						<div class="newsticker">
							<div class="breaking"><?php _e('Breaking', 'mythemeshop'); ?></div>
							<marquee behavior="scroll" direction="left" onmouseover="stop()" onmouseout="start()">
								<ul class="tickers">
									<?php $my_query = new WP_Query('cat='.$options['mts_ticker_cat'].'&posts_per_page=5'); while ($my_query->have_posts()) : $my_query->the_post(); ?>
										<li class="ticker"><a href="<?php the_permalink() ?>"><?php the_title(); ?></a></li>
									<?php endwhile; ?>
								</ul>
							</marquee>
							<div class="arrow-left"></div>
						</div>
					<?php } ?>
					<?php if ($options['mts_logo'] != '') { ?>
						<?php if( is_front_page() || is_home() || is_404() ) { ?>
								<h1 id="logo" class="logo-image">
									<a href="<?php echo home_url(); ?>"><img src="<?php echo $options['mts_logo']; ?>" alt="<?php bloginfo( 'name' ); ?>"></a>
								</h1><!-- END #logo -->
						<?php } else { ?>
								<h2 id="logo" class="logo-image">
									<a href="<?php echo home_url(); ?>"><img src="<?php echo $options['mts_logo']; ?>" alt="<?php bloginfo( 'name' ); ?>"></a>
								</h2><!-- END #logo -->
						<?php } ?>
					<?php } else { ?>
						<?php if( is_front_page() || is_home() || is_404() ) { ?>
								<h1 id="logo">
									<a href="<?php echo home_url(); ?>"><?php bloginfo( 'name' ); ?></a>
								</h1><!-- END #logo -->
						<?php } else { ?>
								<h2 id="logo">
									<a href="<?php echo home_url(); ?>"><?php bloginfo( 'name' ); ?></a>
								</h2><!-- END #logo -->
						<?php } ?>
					<?php } ?>
					<?php if ( ! dynamic_sidebar( 'Header' ) ) : ?><?php endif ?>
				</div><!--#header-->
				<div class="secondary-navigation">
					<nav id="navigation" >
						<?php if ( has_nav_menu( 'secondary-menu' ) ) { ?>
							<?php wp_nav_menu( array( 'theme_location' => 'secondary-menu', 'menu_class' => 'menu', 'container' => '' ) ); ?>
						<?php } else { ?>
							<ul class="menu">
								<?php wp_list_categories('title_li='); ?>
							</ul>
						<?php } ?>
					</nav>
				</div>
			</div><!--.container-->
		</header>
