<?php $bike_post_type = get_post_type(); ?>

<?php get_header( $bike_post_type . '-404' ); ?>

	<section id="content" class="clearfix">
		<article class="page clearfix">
			<h1><?php _e( 'K&aelig;den er hoppet af!', 'bike' ); ?></h1>
			<p><?php _e( 'Vi har tilkaldt en servicevogn til at hj&aelig;lpe os med hurtigst mulig at f&aring; sat k&aelig;den p&aring; igen.', 'bike' ); ?><br />
			<?php _e( 'Mens vi f&aring;r sat k&aelig;den p&aring; igen kan du:', 'bike' ); ?></p>
			<ul>
				<li><?php printf( __( 'G&aring; tilbage til <a href="%1$s">forrige side</a>.', 'bike' ), 'javascript:history.go(-1)' ); ?></li>
				<li><?php printf( __( 'G&aring; til <a href="%1$s">forsiden</a>.', 'bike' ), home_url() ); ?></li>
				<li><?php printf( __( 'G&aring; til <a href="%1$s">vores nyheder</a>.', 'bike' ), get_permalink( 31 ) ); ?></li>
				<li><?php printf( __( 'G&aring; til <a href="%1$s">vores forum</a>.', 'bike' ), home_url( '/forums/' ) ); ?></li>
			</ul>
			<p><?php _e( 'eller benytte s&oslash;gefeltet nedenfor!', 'bike' ); ?></p>
		</article>
		<?php get_search_form(); ?>
	</section>

<?php get_footer( $bike_post_type . '-404' ); ?>