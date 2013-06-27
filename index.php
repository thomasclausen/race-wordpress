<?php $race_post_type = get_post_type(); ?>

<?php get_header( $race_post_type ); ?>

	<?php $args = array( 'post_type' => 'page', 'post_status' => 'publish', 'orderby' => 'menu_order', 'order' => 'ASC', 'posts_per_page' => '-1', 'nopaging' => 'true' );
	$race_pages = new WP_Query( $args );
	while ( $race_pages->have_posts() ) : $race_pages->the_post();
		get_template_part( 'content', $race_post_type );
	endwhile; ?>

<?php get_footer( $race_post_type ); ?>