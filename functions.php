<?php
/**
 * RACE functions and definitions
 *
 * @package RACE
 * @since RACE 1.0
 * @last_updated RACE 1.0
 */


if ( ! function_exists( 'race_setup' ) ) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features
	 *
	 * @since RACE 1.0
	 */
	function race_setup() {
		/**
		 * Set the content width based on the theme's design and stylesheet
		 *
		 * @since RACE 1.0
		 */
		if ( ! isset( $content_width ) ) :
			$content_width = 560;
		endif;

		/**
		 * Add custom stylesheet for the editor
		 *
		 * @since RACE 1.0
		 */
		add_editor_style();

		/**
		 * Add theme options
		 *
		 * @since RACE 1.0
		 */
		//require( get_template_directory() . '/theme-options.php' );

		/**
		 * Make theme available for translation
		 * Translations can be filed in the /languages/ directory
		 *
		 * @since RACE 1.0
		 */
		load_theme_textdomain( 'race', get_template_directory() . '/languages' );

		/**
		 * Add support for custom background
		 *
		 * @since RACE 1.0
		 */
		$defaults = array(
			'default-image' => get_template_directory_uri() . '/images/body-bg.png'
		);
		add_theme_support( 'custom-background', $defaults );

		/**
		 * Add support for post thumbnails and set size
		 *
		 * @since RACE 1.0
		 */
		add_theme_support( 'post-thumbnails', array( 'page' ) );
		set_post_thumbnail_size( 600, 600 );

		/**
		 * Add support for post image and set size
		 *
		 * @since RACE 1.0
		 */
		add_image_size( 'post-image', 600, 600 );
		
		/**
		 * Add support for default posts and comments RSS feed links to head
		 *
		 * @since RACE 1.0
		 */
		add_theme_support( 'automatic-feed-links' );
	}
endif;
add_action( 'after_setup_theme', 'race_setup' );

/**
 * Extend user profiles by adding input fields for facebook, twitter etc. and removing unwanted ones
 *
 * @since RACE 1.0
 */
function race_user_profile( $contactmethods ) {
	$contactmethods = array(
		'twitter' => __( 'Twitter', 'race' ),
		'facebook' => __( 'Facebook', 'race' ),
		'googleplus' => __( 'Google+', 'race' ),
		'skype' => __( 'Skype', 'race' )
	);
	
	unset( $contactmethods['aim'] );
	unset( $contactmethods['yim'] );
	unset( $contactmethods['jabber'] );
	
	return $contactmethods;
}
add_filter( 'user_contactmethods', 'race_user_profile', 10, 1 );

/**
 * Remove unwanted meta tags and scripts from header
 *
 * @since RACE 1.0
 */
remove_action( 'wp_head', 'wp_generator' ); // WordPress version number
remove_action( 'wp_head', 'rsd_link' );
remove_action( 'wp_head', 'wlwmanifest_link' );
remove_action( 'wp_head', 'feed_links_extra', 3 );

/**
 * Enqueue scripts and styles
 *
 * @since RACE 1.0
 * @last_updated RACE 1.0
 */
function race_scripts_styles() {
	wp_register_style( 'reset-html5', get_template_directory_uri() . '/reset-html5.css', false, '1.0' );
	wp_enqueue_style( 'reset-html5' );
	wp_register_style( 'race-theme', get_template_directory_uri() . '/style.css', array( 'reset-html5' ), '1.0' );
	wp_enqueue_style( 'race-theme' );
	if ( ! is_404() ) :
		wp_deregister_script( 'comment-reply' );
		wp_enqueue_script( 'jquery' );
		wp_register_script( 'moment-script', get_template_directory_uri() . '/js/moment.min.js', array( 'jquery' ), '2.0.0', true );
		wp_enqueue_script( 'moment-script' );
		wp_register_script( 'race-theme-script', get_template_directory_uri() . '/script.js', array( 'jquery', 'moment-script' ), '1.0', true );
		wp_enqueue_script( 'race-theme-script' );
	endif;
}
add_action( 'wp_enqueue_scripts', 'race_scripts_styles' );

/**
 * Insert HTML5 extras
 *
 * @since RACE 1.0
 */
function race_html5extras() {
	echo '<meta http-equiv="X-UA-Compatible" content="IE=edge, chrome=1" />' . "\n";
	echo '<meta name="viewport" content="width=device-width, initial-scale=1.0" />' . "\n";
}
add_action( 'wp_head', 'race_html5extras', 1 );

/**
 * Insert HTML5 shiv
 *
 * @since RACE 1.0
 */
function race_html5shiv() {
	global $is_IE;
	if ( $is_IE ) :
		echo '<!--[if lt IE 9]><script src="//html5shiv.googlecode.com/svn/trunk/html5.js"></script><![endif]-->' . "\n";
	endif;
}
add_action( 'wp_head', 'race_html5shiv' );

/**
 * Insert custom pingback
 *
 * @since RACE 1.0
 */
 // Pingback
function race_pingback() {
	echo '<link rel="pingback" href="' . get_bloginfo( 'pingback_url' ) . '" />' . "\n";
}
add_action( 'wp_head', 'race_pingback' );

/**
 * Insert Open Graph tags
 *
 * @since RACE 1.0
 */
function race_opengraph() {
	if ( !class_exists( WPSEO_OpenGraph ) ) :
	//if ( is_plugin_active( 'wp-plugins/' ) ) :
		echo '<meta property="og:title" content="' . esc_attr( get_bloginfo( 'name' ) ) . '" />' . "\n";
		echo '<meta property="og:description" content="' . esc_attr( get_the_excerpt() ) . '" />' . "\n";
		echo '<meta property="og:url" content="' . get_permalink() . '" />' . "\n";
		echo '<meta property="og:site_name" content="' . esc_attr( get_bloginfo( 'name' ) ) . '" />' . "\n";
	endif;
}
add_action( 'wp_head', 'race_opengraph', 2 );

/**
 * Add support for widgets
 *
 * @since RACE 1.0
 */
function race_widgets_init() {
	register_sidebar( array(
		'name' => __( 'Sidebar', 'race' ),
		'id' => 'sidebar-left',
		'description' => __( 'Benyttes til at inds&aelig;tte indhold i venstre side under undermenu.', 'race' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'before_title' => '<h3>',
		'after_title' => '</h3>',
		'after_widget' => '</aside>',
	) );
	register_sidebar( array(
		'name' => __( 'Footer', 'race' ),
		'id' => 'sidebar-footer',
		'description' => __( 'Benyttes til at inds&aelig;tte indhold i footer. Kan indeholde 3 widgets', 'race' ),
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'before_title' => '<h3>',
		'after_title' => '</h3>',
		'after_widget' => '</div>',
	) );
}
add_action( 'widgets_init', 'race_widgets_init' );

/**
 * Customize the title tag
 *
 * @since RACE 1.0
 */
function race_custom_title( $title ) {
	if ( is_feed() ) :
		return $title;
	endif;

	global $paged, $page;

	if ( is_author() ) :
		$title = __( 'Nyheder skrevet af: ', 'race' ) . $title;
	elseif ( is_category() ) :
		$title = __( 'Kategori: ', 'race' ) . $title;
	elseif ( is_date() ) :
		$title = __( 'Nyheder fra ', 'race' ) . $title;
	elseif ( is_tag() ) :
		$title = __( 'Emne: ', 'race' ) . $title;
	elseif ( is_tax() ) :
		$title = __( 'Type: ', 'race' ) . $title;
	elseif ( is_search() ) :
		$title = __( 'S&oslash;gning: "', 'race' ) . get_search_query() . '" ';
		if ( $paged >= 2 ) :
			$title .= __( ' - Side: ', 'race' ) . get_page_number();
		endif;
	elseif ( is_404() ) :
		$title = __( 'Siden blev ikke fundet!', 'race' );
	endif;

	if ( $paged >= 2 || $page >= 2 ) :
		$title .= __( ' - Side: ', 'race' ) . $page;
	endif;

	if ( !is_front_page() ) :
		$seperator = ' &bull; ';
	endif;

	return $title . $seperator . get_bloginfo( 'name', 'display' );
}
add_filter( 'wp_title', 'race_custom_title' );

/**
 * Customize the thumbnail HTML output
 *
 * @since RACE 1.0
 */
function race_post_image_html( $html, $post_id, $post_image_id ) {
	if ( is_single() ) :
		$html = '<div class="image"><a href="' . get_permalink( $post_image_id ) . '" title="' . esc_attr( get_post_field( 'post_title', $post_image_id ) ) . '">' . $html . '</a></div>';
	else:
		$html = '<div class="image"><a href="' . get_permalink( $post_id ) . '" title="' . esc_attr( get_post_field( 'post_title', $post_id ) ) . '">' . $html . '</a></div>';
	endif;

	return $html;
}
add_filter( 'post_thumbnail_html', 'race_post_image_html', 10, 3 );

/**
 * Remove the inline style from the gallery shortcode
 *
 * @since RACE 1.0
 */
add_filter( 'use_default_gallery_style', '__return_false' );

/**
 * Add meta box
 *
 * @since RACE 1.0
 */
function race_column_show_box() {
	global $post;

	$meta = get_post_meta( $post->ID, '_race_columns', true );

	echo '<div id="race-columns-select">';
		wp_nonce_field( plugin_basename( __FILE__ ), 'race_columns_nonce' );
		echo '<input type="hidden" name="race_columns_nonce" value="' . wp_create_nonce( basename( __FILE__ ) ) . '" />';

		echo '<input type="radio" name="race_columns" class="race-columns" id="race-columns-1" value="1" ' . ( $meta === '1' ? 'checked="checked" ' : '' ) . '/> <label for="race-columns-1">1 kolonne</label><br />';
		echo '<input type="radio" name="race_columns" class="race-columns" id="race-columns-2" value="2" ' . ( $meta === '2' || $meta === '' ? 'checked="checked" ' : '' ) . '/> <label for="race-columns-2">2 kolonner</label>';
	echo '</div>';
}

function race_column_add_box() {
	add_meta_box( 'race_columns', 'Antal kolonner', 'race_column_show_box', 'page', 'side', 'default' );
}
add_action( 'admin_menu', 'race_column_add_box' );

function race_column_save_data( $post_id ) {
	if ( !wp_verify_nonce( $_POST['race_columns_nonce'], basename( __FILE__ ) ) ) {
		return $post_id;
	}

	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
		return $post_id;
	}

	if ( 'page' === $_POST['post_type'] ) {
		if ( !current_user_can( 'edit_page', $post_id ) ) {
			return $post_id;
		}
	}

	$old = get_post_meta( $post_id, '_race_columns', true );
	$new = $_POST['race_columns'];
	if ( $new && $new != $old ) {
		update_post_meta( $post_id, '_race_columns', $new );
	} elseif ( '' === $new && $old ) {
		delete_post_meta( $post_id, '_race_columns', $old );
	}
}
add_action( 'save_post', 'race_column_save_data' );

/**
 * Add extra class to post_class
 *
 * @since RACE 1.0
 */
function race_column_class( $classes ) {
	global $post;

	$columns = get_post_meta( $post->ID, '_race_columns', true );
	if ( $columns === '1' ) :
		$classes[] = 'column-single';
	else :
		$classes[] = 'column-double';
	endif;

	return $classes;
}
add_filter( 'post_class', 'race_column_class' );

/**
 * Add shortcode for countdown box
 *
 * @since RACE 1.0
 */
function race_countdown_filter_content( $atts ) {
	extract( shortcode_atts( array(
		'year' => '',
		'month' => '',
		'day' => '',
		'hour' => '',
		'minute' => ''
	), $atts ) );
	
	$output = '<div class="race_countdown clearfix">' . "\r\n";
	
		$output .= '<h2>' . __( 'Nedt&aelig;lling', 'race' ) . '</h2>' . "\r\n";
	
		$output .= '<script>(function($) { $(document).ready(function(){ var date_target = moment([' . $year . ', ' . ( $month - 1 ) . ', ' . $day . ', ' . $hour . ', ' . $minute . ']); var days = date_target.diff(moment(), \'days\'); var hours = date_target.subtract(\'days\', days).diff(moment(), \'hours\'); var minutes = date_target.subtract(\'hours\', hours).diff(moment(), \'minutes\'); $(\'.race_countdown .days .number\').text(days); $(\'.race_countdown .hours .number\').text(hours); $(\'.race_countdown .minutes .number\').text(minutes); }); })(jQuery);</script>' . "\r\n";
	
		$output .= '<div class="days">';
			$output .= '<div class="number"></div>';
			$output .= __( 'Dage', 'race' );
		$output .= '</div>' . "\r\n";
		
		$output .= '<div class="hours">';
			$output .= '<div class="number"></div>';
			$output .= __( 'Timer', 'race' );
		$output .= '</div>' . "\r\n";
		
		$output .= '<div class="minutes">';
			$output .= '<div class="number"></div>';
			$output .= __( 'Minuter', 'race' );
		$output .= '</div>' . "\r\n";
	
	$output .= '</div>' . "\r\n";
	
	return $output;
}
add_shortcode( 'countdown', 'race_countdown_filter_content' );

/**
 * Add shortcode for button
 *
 * @since RACE 1.0
 */
function race_button_filter_content( $atts ) {
	extract( shortcode_atts( array(
		'label' => '',
		'link' => ''
	), $atts ) );
	
	return '<div class="race_button"><a href="' . $link . '">' . $label . '</a></div>';
}
add_shortcode( 'button', 'race_button_filter_content' );
