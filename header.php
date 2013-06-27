<!DOCTYPE html>
<!--[if lt IE 8]><html class="no-js ie ie7" <?php language_attributes(); ?>><![endif]-->
<!--[if IE 8]><html class="no-js ie ie8" <?php language_attributes(); ?>><![endif]-->
<!--[if IE 9]><html class="no-js ie ie9" <?php language_attributes(); ?>><![endif]-->
<!--[if (gt IE 9)|!(IE)]><!--><html class="no-js" <?php language_attributes(); ?>><!--<![endif]-->

<head>
<meta charset="<?php bloginfo( 'charset' ); ?>" />
<meta http-equiv="content-type" content="<?php bloginfo( 'html_type' ); ?>; charset=<?php bloginfo( 'charset' ); ?>" />
<title><?php wp_title( '', true, 'right' ); ?></title>
<meta name="description" content="<?php bloginfo( 'description' ); ?>" />

<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
	<nav class="mainmenu">
		<ul class="clearfix">
			<li class="logo"><img src="<?php echo get_template_directory_uri(); ?>/images/logo.png" alt="<?php bloginfo( 'name' ); ?><?php echo ( get_bloginfo( 'description' ) ? ' - ' . get_bloginfo( 'description' ) : ''); ?>" /></li>
			
			<?php $args = array( 'post_type' => 'page', 'post_status' => 'publish', 'orderby' => 'menu_order', 'order' => 'ASC', 'posts_per_page' => '-1', 'nopaging' => 'true' );
			$race_pages = new WP_Query( $args );
			while ( $race_pages->have_posts() ) : $race_pages->the_post(); ?>
				<span class="seperator"></span>
				<li>
					<a href="#page-<?php the_ID(); ?>"><?php the_title(); ?></a>
				</li>
			<?php endwhile; ?>
		</ul>
	</nav>
	<div class="header-spacer"></div>
