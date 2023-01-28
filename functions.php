<?php
	
	/**
	 * Bootstrap on Wordpress functions and definitions
	 *
	 * For more information on hooks, actions, and filters, see http://codex.wordpress.org/Plugin_API.
	 *
	 * @package 	WordPress
	 * @subpackage 	Bootstrap 5.2.3
	 * @autor 		Babobski
	 */

	define('BOOTSTRAP_VERSION', '5.2.3');
	define('BOOTSTRAP_ICON_VERSION', '1.10.2');

	/* ========================================================================================================================

	01. Add language support to theme

	======================================================================================================================== */

	add_action('after_setup_theme', 'my_theme_setup');

	function my_theme_setup(){
		load_theme_textdomain('wp_babobski', get_template_directory() . '/language');
	}

	/* ========================================================================================================================

	02. Required external files

	======================================================================================================================== */

	require_once( 'external/bootstrap-utilities.php' );
	require_once( 'external/bs5navwalker.php' );

	/* ========================================================================================================================

    03. Add html 5 support to wordpress elements

	======================================================================================================================== */

	add_theme_support( 'html5', [
		'comment-list',
		'search-form',
		'comment-form',
		'gallery',
		'caption',
	]);

	/* ========================================================================================================================

	04. Theme specific settings

	======================================================================================================================== */

	add_theme_support('post-thumbnails');

	//add_image_size( 'name', width, height, crop true|false );

	register_nav_menus([
		'primary' => 'Primary Navigation'
	]);

	/* ========================================================================================================================

	05. Actions and Filters

	======================================================================================================================== */

	add_action( 'wp_enqueue_scripts', 'bootstrap_script_init' );

	$BsWp = new BsWp;
	add_filter( 'body_class', [$BsWp, 'add_slug_to_body_class'] );

	/* ========================================================================================================================

	06. Custom Post Types - include custom post types and taxonomies here e.g.

	e.g. require_once( 'custom-post-types/your-custom-post-type.php' );

	======================================================================================================================== */



	/* ========================================================================================================================

	07. Scripts

	======================================================================================================================== */

	/**
	 * Add scripts via wp_head()
	 *
	 * @return void
	 * @author Keir Whitaker
	 */
	if ( !function_exists( 'bootstrap_script_init' ) ) {
		function bootstrap_script_init() {

			// Get theme version number (located in style.css)
			$theme = wp_get_theme();

			wp_enqueue_script( 'bootstrap', get_template_directory_uri() . '/js/bootstrap.bundle.min.js', [ 'jquery' ], BOOTSTRAP_VERSION, true );
			wp_enqueue_script( 'site', get_template_directory_uri() . '/js/app.js', [ 'jquery', 'bootstrap' ], $theme->get( 'Version' ), true );

			wp_enqueue_style( 'bootstrap', get_template_directory_uri() . '/css/bootstrap.min.css', [], BOOTSTRAP_VERSION, 'all' );
			wp_enqueue_style( 'bootstrap_icons', get_template_directory_uri() . '/css/bootstrap-icons.css', [], BOOTSTRAP_ICON_VERSION, 'all' );
			wp_enqueue_style( 'screen', get_template_directory_uri() . '/style.css', [], $theme->get( 'Version' ), 'screen' );
		}
	}

	/* ========================================================================================================================

	08. Security & cleanup wp admin

	======================================================================================================================== */

	//remove wp version
	function theme_remove_version() {
		return '';
	}

	add_filter('the_generator', 'theme_remove_version');

	//remove default footer text
	function remove_footer_admin () {
		echo "";
	}

	add_filter('admin_footer_text', 'remove_footer_admin');

	//remove wordpress logo from adminbar
	function wp_logo_admin_bar_remove() {
		global $wp_admin_bar;

		/* Remove their stuff */
		$wp_admin_bar->remove_menu('wp-logo');
	}

	add_action('wp_before_admin_bar_render', 'wp_logo_admin_bar_remove', 0);

	// Remove default Dashboard widgets
	if ( !function_exists( 'disable_default_dashboard_widgets' ) ) {
		function disable_default_dashboard_widgets() {

			//remove_meta_box('dashboard_right_now', 'dashboard', 'core');
			remove_meta_box('dashboard_activity', 'dashboard', 'core');
			remove_meta_box('dashboard_recent_comments', 'dashboard', 'core');
			remove_meta_box('dashboard_incoming_links', 'dashboard', 'core');
			remove_meta_box('dashboard_plugins', 'dashboard', 'core');
	
			remove_meta_box('dashboard_quick_press', 'dashboard', 'core');
			remove_meta_box('dashboard_recent_drafts', 'dashboard', 'core');
			remove_meta_box('dashboard_primary', 'dashboard', 'core');
			remove_meta_box('dashboard_secondary', 'dashboard', 'core');
		}
	}
	add_action('admin_menu', 'disable_default_dashboard_widgets');

	remove_action('welcome_panel', 'wp_welcome_panel');

	// Disable the emoji's
	if ( !function_exists( 'disable_emojis' ) ) {
		function disable_emojis() {
			remove_action('wp_head', 'print_emoji_detection_script', 7);
			remove_action('admin_print_scripts', 'print_emoji_detection_script');
			remove_action('wp_print_styles', 'print_emoji_styles');
			remove_action('admin_print_styles', 'print_emoji_styles');
			remove_filter('the_content_feed', 'wp_staticize_emoji');
			remove_filter('comment_text_rss', 'wp_staticize_emoji');
			remove_filter('wp_mail', 'wp_staticize_emoji_for_email');

			// Remove from TinyMCE
			add_filter('tiny_mce_plugins', 'disable_emojis_tinymce');
		}
	}
	add_action('init', 'disable_emojis');

	// Filter out the tinymce emoji plugin.
	function disable_emojis_tinymce($plugins) {
		if (is_array($plugins)) {
			return array_diff($plugins, array('wpemoji'));
		} else {
			return [];
		}
	}

	add_action('admin_head', 'custom_logo_guttenberg');

	if ( !function_exists( 'custom_logo_guttenberg' ) ) {
		function custom_logo_guttenberg() {
			echo '<link rel="stylesheet" type="text/css" href="'.get_bloginfo('stylesheet_directory').
			'/css/admin-custom.css?v=1.0.0" />';
		}
	}

	/* ========================================================================================================================

	09. Disabeling Guttenberg

	======================================================================================================================== */

	// Optional disable guttenberg block editor
	// add_filter( 'use_block_editor_for_post', '__return_false' );


	//Remove Gutenberg Block Library CSS from loading on the frontend
	// function smartwp_remove_wp_block_library_css() {
	// 	wp_dequeue_style('wp-block-library');
	// 	wp_dequeue_style('wp-block-library-theme');
	// 	wp_dequeue_style('wc-block-style'); // Remove WooCommerce block CSS
	// wp_dequeue_style( 'storefront-gutenberg-blocks' ); // Storefront 
	// }
	// add_action('wp_enqueue_scripts', 'smartwp_remove_wp_block_library_css', 100);

	/* ========================================================================================================================

	10. Custom login

	======================================================================================================================== */

	// Add custom css
	if ( !function_exists( 'my_custom_login' ) ) {
		function my_custom_login() {
			echo '<link rel="stylesheet" type="text/css" href="' . get_bloginfo('stylesheet_directory') . '/css/custom-login-style.css?v=1.0.0" />';
		}
	}
	add_action('login_head', 'my_custom_login');

	// Link the logo to the home of our website
	if ( !function_exists( 'my_login_logo_url' ) ) {
		function my_login_logo_url() {
			return get_bloginfo( 'url' );
		}
	}
	add_filter( 'login_headerurl', 'my_login_logo_url' );

	// Change the title text
	if ( !function_exists( 'my_login_logo_url_title' ) ) {
		function my_login_logo_url_title() {
			return get_bloginfo( 'name' );
		}
	}
	add_filter( 'login_headertext', 'my_login_logo_url_title' );
	

	/* ========================================================================================================================

	11. Comments

	======================================================================================================================== */

	/**
	 * Custom callback for outputting comments
	 *
	 * @return void
	 * @author Keir Whitaker
	 */
	if (!function_exists( 'bootstrap_comment' )) {
		function bootstrap_comment( $comment, $args, $depth ) {
			$GLOBALS['comment'] = $comment;
			?>
			<?php if ( $comment->comment_approved == '1' ): ?>
			<li class="row">
				<div class="col-4 col-md-2">
					<?php echo get_avatar( $comment ); ?>
				</div>
				<div class="col-8 col-md-10">
					<h4><?php comment_author_link() ?></h4>
					<time><a href="#comment-<?php comment_ID() ?>" pubdate><?php comment_date() ?> at <?php comment_time() ?></a></time>
					<?php comment_text() ?>
				</div>
			<?php endif;
		}
	}


function features() {
    register_nav_menu('headerMenuLocation', 'Header Menu Location');
    register_nav_menu('footerMenuLocationOne', 'Footer Menu Location One');
    register_nav_menu('footerMenuLocationTwo', 'Footer Menu Location Two');
    add_theme_support('title-tag');
    add_theme_support('post-thumbnails');
    add_image_size('alumniLandscape', 400, 260, true);
    add_image_size('alumniPotrait', 480, 650, true);
}

add_action('after_setup_theme', 'features');

//Custom default WP Query
function alumni_custom_query($query){
    if (!is_admin() AND is_post_type_archive('program') AND $query -> is_main_query()){
        $query -> set('order', 'DESC');
    }

    if (!is_admin() AND is_post_type_archive('alumni') AND $query -> is_main_query()){
        $query -> set('posts_per_page', 50);
        $query -> set('order', 'DESC');
        $query -> set('orderby', 'meta_value_num');
        $query -> set('meta_key', ['graduation_year', 'major']);
        $query -> set('meta_query', array(
              'key' => 'verified',
              'compare' => '==',
              'value' => true,
              'type' => 'boolean'
          ));
       
    }

    if (!is_admin() AND is_post_type_archive('institution') AND $query -> is_main_query()){
        $query -> set('posts_per_page', 50);
        $query -> set('order', 'ASC');
        $query -> set('orderby', 'title');
    }

    if (!is_admin() AND is_post_type_archive('vacancy') AND $query -> is_main_query()){
        $query -> set('posts_per_page', 10);
        $query -> set('order', 'ASC');
    }
}

add_action('pre_get_posts', 'alumni_custom_query');


function noSubAdminBar(){
    $ourCurrentUser = wp_get_current_user();
    if (count($ourCurrentUser -> roles) == 1 AND $ourCurrentUser -> roles[0] == 'subscriber'){
        show_admin_bar(false);
    }
}

add_action('wp_loaded', 'noSubAdminBar');

function ourLoginUrl(){
    return esc_url(site_url('/'));
}


add_filter('login_headerurl', 'ourLoginUrl');


add_action('acf/init', 'my_acf_form_init');
function my_acf_form_init() {

    // Check function exists.
    if( function_exists('acf_register_form') ) {

        // Register form.
        acf_register_form(array(
            'id'       => 'new-alumni',
            'post_id'  => 'new_post',
            'new_post' => array(
                'post_type'   => 'alumni',
                'post_status' => 'publish'
            ),
            'post_title'  => true,
            'fields' => ['photo', 'biodata', 'graduation_year', 'major', 'institution', 'job', 'address', 'phone'],
            'return'		=> home_url('my-profile'),
            'submit_value'  => 'Add My Profile',
            'html_submit_button'  => '<input type="submit" class="btn btn-primary" value="%s" />',

        ));

    }
}


add_action('acf/save_post', 'my_save_post', 5);

function my_save_post( $post_id ) {
	
	// check if post type = alumni
	if( get_post_type($post_id) !== 'alumni' ) {
		
		return;
		
	}
	
	
	// should not admin
	if( is_admin() ) {
		
		return;
		
	}
	
	
     // Get previous values.
     $prev_values = get_fields( $post_id );

     // Get submitted values.
     $values = $_POST['acf'];
 
     // Check if a specific value was updated.
     if( !isset($_POST['acf']['username']) ) {
         $_POST['acf']['username'] = get_current_user_id();
     }
	
}

//Modify Admin
add_filter( 'manage_alumni_posts_columns', 'alumni_filter_posts_columns' );
function alumni_filter_posts_columns( $columns ) {
  $columns = array(
    'cb' => $columns['cb'],
    'title' => __( 'Name' ),
    'verified' => __( 'Verified?' ),
    'candidate' => __( 'Kandidat Ketua Alumni?'),
  );
  return $columns;
}


add_action( 'manage_alumni_posts_custom_column', 'alumni_column', 10, 2);
function alumni_column( $column, $post_id ) {
  // Verified column
  if ( 'verified' === $column ) {
    $verified = get_post_meta( $post_id, 'verified', true );

    if ($verified == 0){
        _e( 'No' );
    } else {
        _e( 'Yes' );
    }
  }

  if ( 'candidate' === $column ) {
    $candidate = get_post_meta( $post_id, 'candidate', true );

    if ($candidate == 0){
        _e( 'No' );
    } else {
        _e( 'Yes' );
    }
  }
}

