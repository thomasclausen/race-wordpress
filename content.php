
	<section id="page-<?php the_ID(); ?>">
		<h1><?php the_title(); ?></h1>
		<article <?php post_class( 'clearfix' ); ?>>
			<?php the_content(); ?>
		</article>
		<?php if ( has_post_thumbnail() ) :
			the_post_thumbnail( 'post-image' );
		endif; ?>
	</section>
