<?php
// function foodrecipe_init() {
//      if ( ! session_id() ) {
//      	session_start();
//      }
// }
if ( ! isset( $content_width ) )
$content_width = 827;
function foodrecipe_enqueue_style() {
	wp_enqueue_style( 'foodrecipe-fontawesomestyles', trailingslashit( get_template_directory_uri() ) . 'css/font-awesome.min.css', false );
 	wp_enqueue_style( 'foodrecipe-bootstrapstyles', trailingslashit( get_template_directory_uri() ) . 'css/bootstrap.min.css', false );
 	wp_enqueue_script( 'foodrecipe-bootstrapjs', trailingslashit( get_template_directory_uri() ) . 'js/bootstrap.min.js', array( 'jquery' ), '3.3.7', true );
 	wp_enqueue_script( 'foodrecipe-scripts', trailingslashit( get_template_directory_uri() ) . 'js/scripts.js', array(), '1.0', true );
	wp_enqueue_style( 'foodrecipe-stylesheet', get_stylesheet_uri(), false );
 	wp_localize_script( 'foodrecipe-scripts', 'foodrecipe_var',
            array( 'ajax_url' => admin_url( 'admin-ajax.php' ) ) );
}
function foodrecipe_setup() {
	// Post Format support. You can also use the legacy "gallery" or "asides" (note the plural) categories.
	add_theme_support( 'post-formats', array( 'aside',
											  'gallery',
											  'link',
											  'image',
											  'quote',
											  'status',
											  'video',
											  'audio',
											  'chat'
											)
					 );
	// This theme uses post thumbnails
	add_theme_support( 'post-thumbnails' );
	// Make theme available for translation
	// Translations can be filed in the /languages/ directory
	load_theme_textdomain( 'foodrecipe', get_template_directory() . '/languages' );
	$locale = get_locale();
	$locale_file = get_template_directory() . "/languages/$locale.php";
	if ( is_readable( $locale_file ) )
		require_once( $locale_file );
	// This theme uses wp_nav_menu() in one location.
	register_nav_menus( array(
		'primary' => __( 'Primary Navigation', 'foodrecipe' )
	) );
	// This theme allows users to set a custom background
	$defaults = array(
	    'default-image' => '',
	    'default-preset' => 'default',
	    'default-position-x' => 'left',
	    'default-position-y' => 'top',
	    'default-size' => 'auto',
	    'default-repeat' => 'repeat',
	    'default-attachment' => 'scroll',
	    'default-color' => 'fff',
	    'wp-head-callback' => '_custom_background_cb',
	    'admin-head-callback' => '',
	    'admin-preview-callback' => '',
	);
	add_theme_support( 'custom-background', $defaults );

	add_theme_support( 'custom-logo', array(
	    'height'      => 37,
	    'width'       => 45,
	    'flex-height' => true,
	    'flex-width'  => true,
	    'header-text' => array( 'site-title', 'site-description' ),
	) );
	// Your changeable header business starts here
	if ( ! defined( 'HEADER_TEXTCOLOR' ) )
		define( 'HEADER_TEXTCOLOR', 'fff' );
	// Don't support text inside the header image.
	if ( ! defined( 'NO_HEADER_TEXT' ) )
		define( 'NO_HEADER_TEXT', false );
	add_image_size( 'foodrecipe-slider', 4000, 780, array( 'center', 'center' ) );
	add_image_size( 'foodrecipe-gallery', 415, 415, array( 'center', 'center' ) );
}
function foodrecipe_widgets_init() {
	$args = array(
		'name'          => __( 'Sidebar', 'foodrecipe' ),
		'id'            => 'foodrecipe-sidebar',
		'description'   => '',
		'class'         => '',
		'before_widget' => '<li id="%1$s" class="widget %2$s">',
		'after_widget'  => '</li>',
		'before_title'  => '<h2 class="widgettitle">',
		'after_title'   => '</h2>'
	);
	register_sidebar( $args );
	$args = array(
		'name'          => __( 'Sidebar-footer', 'foodrecipe' ),
		'id'            => 'foodrecipe-sidebar-footer',
		'description'   => '',
		'class'         => '',
		'before_widget' => '<li id="%1$s" class="widget col-sm-3 %2$s">',
		'after_widget'  => '</li>',
		'before_title'  => '<h2 class="widgettitle">',
		'after_title'   => '</h2>'
	);
	register_sidebar( $args );
}
function foodrecipe_count_display() {
	if ( ( ! isset( $_SESSION['foodrecipe_count_post'] ) &&  isset( $_POST['count'] ) && 0 < $_POST['count'] ) ||
		( isset( $_POST['count'] ) && 0 < $_POST['count'] && $_SESSION['foodrecipe_count_post'] != $_POST['count'] ) ) {
		$_SESSION['foodrecipe_count_post'] = $_POST['count'];
		$url = esc_url( remove_query_arg( 'paged', $_POST['url'] ) );
		$pattern = '/page\\/[0-9]+\\//i';
		$url = preg_replace( $pattern, '', $url );
		echo json_encode( array( 'action' => "success", 'url' => $url ) );
	}
	wp_die();
}
function foodrecipe_count_post( $query ) {
    if ( $query->is_main_query() && isset( $_SESSION['foodrecipe_count_post'] ) ) {
        $query->set( 'posts_per_page', $_SESSION['foodrecipe_count_post'] );
        //$query->set( 'order_by', $_SESSION['foodrecipe_count_post'] );
    }
    if ( $query->is_main_query() && isset( $_SESSION['foodrecipe_sort_post'] ) ) {
        $query->set( 'orderby', $_SESSION['foodrecipe_sort_post'] );
        $query->set( 'order', 'ASC' );
        //$query->set( 'order', 'DESC' );
        //$query->set( 'order_by', $_SESSION['foodrecipe_count_post'] );
    }
}
function foodrecipe_sort_display() {
	if ( ( ! isset( $_SESSION['foodrecipe_sort_post'] ) && isset( $_POST['sort'] ) &&  '' != isset( $_POST['sort'] ) ) ||
		( isset( $_POST['sort'] ) &&  '' != isset( $_POST['sort'] ) && $_SESSION['foodrecipe_sort_post'] != $_POST['sort'] )  ) {
		$_SESSION['foodrecipe_sort_post'] = $_POST['sort'];
	}
	echo 'success';
	wp_die(); // this is required to terminate immediately and return a proper response
}
function wpdocs_after_setup_theme() {
    add_theme_support( 'html5', array( 'search-form' ) );
}
function excerpt_word_limit( $length ) {
	return 55;
}
function new_excerpt_more($more) {
    return '...';
}
function food_recipe_reorder_comment_fields( $fields ){
	// die(print_r( $fields ));
	$new_fields = array();
	$myorder = array('author','email','url','comment'); // order that we need
	foreach( $myorder as $key ){
		$new_fields[ $key ] = $fields[ $key ];
		unset( $fields[ $key ] );
	}
	if( $fields )
		foreach( $fields as $key => $val )
			$new_fields[ $key ] = $val;
	return $new_fields;
}
function mce_add_page_break( $mce_buttons ) {
    $pos_more = array_search('wp_more', $mce_buttons, true);
    if( $pos_more !== false ) {
        $buttons = array_slice( $mce_buttons, 0, $pos_more );
        $buttons[] = 'wp_page';
        $mce_buttons = array_merge($buttons, array_slice($mce_buttons, $pos_more));
    }
    return $mce_buttons;
}
function foodrecipe_comment($comment, $args, $depth){
   $GLOBALS['comment'] = $comment; ?>
	<li <?php comment_class(); ?> id="li-comment-<?php comment_ID() ?>">
		<div class="comment-unit">
			<?php echo get_avatar( $comment); ?>
			<div id="comment-<?php comment_ID(); ?>" style="float: right; width: 85%;">
				<div class="comment-author vcard">
					<div class="fn"><?php echo get_comment_author_link() ?></div>
					<div class="reply">
						<div class="div_reply_link">
						<?php
							if (is_user_logged_in()) {
							 	comment_reply_link( array_merge( $args, array( 'depth' => $depth,
									'max_depth'  => $args['max_depth'],
									'before'     => '<i class="fa fa-reply" aria-hidden="true"></i>',
									'reply_text' => "reply" ) ) );
							 } else {
							 	comment_reply_link( array_merge( $args, array( 'depth' => $depth,
									'max_depth'  => $args['max_depth'],
									//'before'     => '<i class="fa fa-reply" aria-hidden="true"></i>',
									'reply_text' => false ) ) );
							 } ?>
						</div>
					</div>
					<div style="clear:both;"></div>
				</div><!-- .comment-author -->
				<?php if ($comment->comment_approved == '0') : ?>
					<em>Your comment is awaiting review.</em>
					<br />
				<?php endif; ?>
				<?php comment_text() ?>
				<div class="comment-meta commentmetadata">
					<?php echo human_time_diff( get_comment_time('U'), current_time('timestamp') ) . ' ago';?>
				</div>
			</div>
		</div><!-- .comment-unit -->
		<div style="clear:both;"></div>
	</li>
<?php  }

$defaults = array(
    'default-image' => '',
    'random-default' => false,
    'width' => 0,
    'height' => 0,
    'flex-height' => false,
    'flex-width' => false,
    'default-text-color' => '',
    'header-text' => true,
    'uploads' => true,
    'wp-head-callback' => '',
    'admin-head-callback' => '',
    'admin-preview-callback' => '',
    'video' => false,
    'video-active-callback' => 'is_front_page',
);
add_theme_support( 'custom-header', $defaults );
add_theme_support( 'title-tag' );
add_theme_support( 'automatic-feed-links' );

function my_theme_add_editor_styles() {
	add_editor_style( 'styles.css' );
}




add_action( 'current_screen', 'my_theme_add_editor_styles' );

add_action( 'init', 'foodrecipe_init' );
add_action( 'wp_enqueue_scripts', 'foodrecipe_enqueue_style' );
add_action( 'after_setup_theme', 'foodrecipe_setup' );
add_action( 'widgets_init', 'foodrecipe_widgets_init' );

add_action( 'wp_ajax_foodrecipe_count_display', 'foodrecipe_count_display' );
add_action( 'wp_ajax_nopriv_foodrecipe_count_display', 'foodrecipe_count_display' );

add_action( 'wp_ajax_foodrecipe_sort_display', 'foodrecipe_sort_display' );
add_action( 'wp_ajax_nopriv_foodrecipe_sort_display', 'foodrecipe_sort_display' );

add_action( 'pre_get_posts', 'foodrecipe_count_post' );

add_action( 'after_setup_theme', 'wpdocs_after_setup_theme' );
add_filter('excerpt_more', 'new_excerpt_more');

add_filter('excerpt_length', 'excerpt_word_limit');

add_filter('comment_form_fields', 'food_recipe_reorder_comment_fields' ); // kama_reorder_comment_fields

add_filter('mce_buttons', 'mce_add_page_break');
