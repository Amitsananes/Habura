<?php
// Exit if accessed directly
if ( !defined( 'ABSPATH' ) ) exit;

require_once( 'includes/expired-cron-new.php' );
require_once( 'includes/upload-article-shortcode.php' );
require_once( 'includes/statuses.php' );

// BEGIN ENQUEUE PARENT ACTION
// AUTO GENERATED - Do not modify or remove comment markers above or below:

if ( !function_exists( 'chld_thm_cfg_locale_css' ) ):
    function chld_thm_cfg_locale_css( $uri ){
        if ( empty( $uri ) && is_rtl() && file_exists( get_template_directory() . '/rtl.css' ) )
            $uri = get_template_directory_uri() . '/rtl.css';
        return $uri;
    }
endif;
add_filter( 'locale_stylesheet_uri', 'chld_thm_cfg_locale_css' );

if ( !function_exists( 'child_theme_configurator_css' ) ):
    function child_theme_configurator_css() {
        wp_enqueue_style( 'chld_thm_cfg_child', trailingslashit( get_stylesheet_directory_uri() ) . 'style.css', array( 'hello-elementor','hello-elementor','hello-elementor-theme-style' ) , "1.1.17" );
        wp_enqueue_style( 'new-style', trailingslashit( get_stylesheet_directory_uri() ) . 'new-style.css' );
    }
endif;
add_action( 'wp_enqueue_scripts', 'child_theme_configurator_css', 100 );

/* Remove duplicate posts */

//advertise post views
function getPostViews($postID){
    $count_key = 'post_views_count';
    $count = get_post_meta($postID, $count_key, true);
    if($count==''){
        delete_post_meta($postID, $count_key);
        add_post_meta($postID, $count_key, '0');
        return "0 View";
    }
    return $count.' ';
}
function setPostViews($postID) {
    $count_key = 'post_views_count';
    $count = get_post_meta($postID, $count_key, true);
    if($count==''){
        $count = 0;
        delete_post_meta($postID, $count_key);
        add_post_meta($postID, $count_key, '0');
    }else{
        $count++;
        update_post_meta($postID, $count_key, $count);
    }
}

// Remove issues with prefetching adding extra views
remove_action( 'wp_head', 'adjacent_posts_rel_link_wp_head', 10, 0);



//END ADS




//logout redirect
add_action('wp_logout','ps_redirect_after_logout');
function ps_redirect_after_logout(){
    wp_redirect( 'https://wordpress-668856-3151571.cloudwaysapps.com' );
    exit();
}


// END ENQUEUE PARENT ACTION
//
comment_form();
wp_list_comments();
add_filter('comment_form_default_fields', 'email_filtered_bynati');
function email_filtered_bynati($fields)
{
    if(isset($fields['email']))
        unset($fields['email']);
    return $fields;
}


//add users facebook to admin
add_filter( 'manage_users_columns', 'column_register_wpse_101322' );

add_filter( 'manage_users_custom_column', 'column_display_wpse_101322', 10, 3 );

function column_register_wpse_101322( $columns )
{

    $columns['accountmanager_col'] = 'פייסבוק';
    return $columns;
}

function column_display_wpse_101322( $value, $column_name, $user_id )
{
    $user_info = get_user_meta( $user_id, 'עמוד_פייסבוק', true );
    if($column_name == 'accountmanager_col') return $user_info;
    return $value;

}
//*instagram
add_filter( 'manage_users_columns', 'column_register_wpse_101323' );

add_filter( 'manage_users_custom_column', 'column_display_wpse_101323', 10, 3 );

function column_register_wpse_101323( $columns1 )
{

    $columns1['accountmanager_col1'] = 'אינסטגרם';
    return $columns1;
}

function column_display_wpse_101323( $value, $column_name, $user_id )
{
    $user_info = get_user_meta( $user_id, 'חשבון_אינסטגרם', true );
    if($column_name == 'accountmanager_col1') return $user_info;
    return $value;

}

//tweeter
add_filter( 'manage_users_columns', 'column_register_wpse_101324' );

add_filter( 'manage_users_custom_column', 'column_display_wpse_101324', 10, 3 );

function column_register_wpse_101324( $columns2 )
{

    $columns2['accountmanager_col2'] = 'טוויטר';
    return $columns2;
}

function column_display_wpse_101324( $value, $column_name, $user_id )
{
    $user_info = get_user_meta( $user_id, 'חשבון_טוויטר', true );
    if($column_name == 'accountmanager_col2') return $user_info;
    return $value;

}


// add link to user at comments
function force_comment_author_url($comment)
{
    // does the comment have a valid author URL?
    $no_url = !$comment->comment_author_url || $comment->comment_author_url == 'https://';

    if ($comment->user_id && $no_url) {
        // comment was written by a registered user but with no author URL
        $comment->comment_author_url = '/?author=' . $comment->username;
    }
    return $comment;
}
add_filter('get_comment', 'force_comment_author_url');

//admin css
add_action('admin_head', 'my_custom_fonts');

function my_custom_fonts() {
    echo '<style>
 .wplpp-push-preview.fixed {
    position: unset !important;
} 
  </style>';
}

//default gravatar
add_filter( 'avatar_defaults', 'wpb_new_gravatar' );
function wpb_new_gravatar ($avatar_defaults) {
    $myavatar = '/wp-content/uploads/2021/12/370076_account_avatar_client_male_person_icon.webp';
    $avatar_defaults[$myavatar] = "Default Gravatar tal";
    return $avatar_defaults;
}

// Comment Form Placeholder Author by netanel

function placeholder_author_form_field($fields) {
    $replace_author = __('שם', 'שם');


    $fields['author'] = '<p class="comment-form-author">' . '<label for="author">' . __( '', 'שם' ) . '</label> ' . ( $req ? '<span class="required">*</span>' : '' ) .
        '<input id="author" name="author" type="text" placeholder="'.$replace_author.'" value="' . esc_attr( $commenter['comment_author'] ) . '" size="20"' . $aria_req . ' /></p>';



    return $fields;
}

add_filter('comment_form_default_fields','placeholder_author_form_field');
/**
 * Comment Form Placeholder Comment Field by netanel
 */
function placeholder_comment_form_field($fields) {
    $replace_comment = __('כתוב תגובה', 'yourdomain');

    $fields['comment_field'] = '<p class="comment-form-comment"><label for="comment">' . _x( '', 'כתוב תגובה' ) .
        '</label><textarea id="comment" name="comment" cols="45" rows="1" placeholder="'.$replace_comment.'" aria-required="true"></textarea></p>';

    return $fields;
}
add_filter( 'comment_form_defaults', 'placeholder_comment_form_field' );


add_action('wp_head', 'add_css_head');
function add_css_head() {
    if ( is_user_logged_in() ) {
        ?>
        <style>
            .form-submit {
                width: 25%;
                padding-right: 0px;
                margin-top: -8px;
            }
            .comment-form-comment {
                width: 75%;
            }
        </style>
        <?php
    } else {
        ?>
        <style>
            .form-submit{
                margin-top: 0px !important;
            }
            .comment-form-comment {
                width: 100%;
            }
        </style>
        <?php
    }
}



add_filter('acf/validate_value/name=validate_this_image', 'my_acf_validate_value', 10, 4);

function my_acf_validate_value( $valid, $value, $field, $input ){

    // bail early if value is already invalid
    if( !$valid ) {

        return $valid;

    }


    // load data

    $my_text_field = get_field('תוכן_הכתבה');

    if ( strlen($my_text_field) < 10 ) {

        $valid = 'Must be a minimum of 10 characters.';
    }


    // return
    return $valid;

}

function comment_validation_init() {
    if(is_single() && comments_open() ) { ?>
        <script type="text/javascript" src="https://ajax.aspnetcdn.com/ajax/jquery.validate/1.9/jquery.validate.min.js"></script>
        <script type="text/javascript">
            jQuery(document).ready(function($) {
                $('#commentform').validate({

                    rules: {
                        author: {
                            required: true,
                            minlength: 2
                        },

                        email: {
                            required: true,
                            email: true
                        },

                        comment: {
                            required: true,
                            minlength: 2
                        }
                    },

                    messages: {
                        author: "שדה חובה",
                        email: "שדה חובה",
                        comment: "שדה חובה"
                    },

                    errorElement: "div",
                    errorPlacement: function(error, element) {
                        element.after(error);
                    }

                });
            });
        </script>
        <?php
    }
}
add_action('wp_footer', 'comment_validation_init');




//comments display fullname instead nickname
add_filter('get_comment_author', 'my_comment_author', 10, 1);

function my_comment_author( $author = '' ) {
    // Get the comment ID from WP_Query

    $comment = get_comment( $comment_ID );

    if ( empty($comment->comment_author) ) {
        if (!empty($comment->user_id)){
            $user=get_userdata($comment->user_id);
            $author=$user->first_name.' '.substr($user->last_name,0,1).'.'; // this is the actual line you want to change
        } else {
            $author = __('Anonymous');
        }
    } else {
        $author = $comment->comment_author;
    }

    return $author;
}

/*
 *
 * ShorCode For Home Page
 *
*/
function wpc_elementor_shortcode( $atts ) {
    // Load Home Page File
    include get_theme_file_path( '/home-page.php' );
}
add_shortcode( 'home_page_php_output', 'wpc_elementor_shortcode');

/*
 *
 * ShorCode For New Post
 *
*/
function wpc_elementor_shortcode_2( $atts ) {
    // Load Home Page File
//    echo "<pre>" . print_r(get_the_author_meta('ID'), true) . "</pre>";
//    if ( get_current_user_id() != get_the_author_meta('ID') ) {
        include get_theme_file_path( '/rating-post.php' );
//    }
}
add_shortcode( 'rating_post_php_output', 'wpc_elementor_shortcode_2');


/**
 * Use ACF image field as avatar
 * @author Mike Hemberger
 * @link http://thestizmedia.com/acf-pro-simple-local-avatars/
 * @uses ACF Pro image field (tested return value set as Array )
 */
add_filter('get_avatar', 'tsm_acf_profile_avatar', 10, 5);
function tsm_acf_profile_avatar( $avatar, $id_or_email, $size, $default, $alt ) {

    $user = '';

    // Get user by id or email
    if ( is_numeric( $id_or_email ) ) {

        $id   = (int) $id_or_email;
        $user = get_user_by( 'id' , $id );

    } elseif ( is_object( $id_or_email ) ) {

        if ( ! empty( $id_or_email->user_id ) ) {
            $id   = (int) $id_or_email->user_id;
            $user = get_user_by( 'id' , $id );
        }

    } else {
        $user = get_user_by( 'email', $id_or_email );
    }

    if ( ! $user ) {
        return $avatar;
    }

    // Get the user id
    $user_id = $user->ID;

    // Get the file id
    $image_id = get_user_meta($user_id, 'profile_pic', true); // CHANGE TO YOUR FIELD NAME

    // Bail if we don't have a local avatar
    if ( ! $image_id ) {
        return $avatar;
    }

    // Get the file size
    $image_url  = wp_get_attachment_image_src( $image_id, 'thumbnail' ); // Set image size by name
    // Get the file url
    $avatar_url = $image_url[0];
    // Get the img markup
    $avatar = '<img alt="' . $alt . '" src="' . $avatar_url . '" class="avatar avatar-' . $size . '" height="' . $size . '" width="' . $size . '"/>';

    // Return our new avatar
    return $avatar;
}

/**
 * Estimate time to read the article
 *
 * @return string
 */
function savvy_estimated_reading_time() {

    $post = get_post();

    $words = count(preg_split('/\s+/', strip_tags( $post->post_content )));
    $minutes = floor( $words / 200 );
    $seconds = floor( $words % 200 / ( 200 / 60 ) );

    // Only Time numbers
    if($minuts < 1) {
        $estimated_time_num = $minutes + $seconds;
    } else {
        $estimated_time_num = ($minutes*60) + $seconds;
    }
    // For Rating Procces

    if ( 1 <= $minutes ) {
        $estimated_time = ($minutes == 1 ? ' דקה אחת' : $minutes . 'דקות' ) . ' ו' . ($seconds == 1 ? 'שנייה אחת' :  $seconds . ' שניות' );
    } else {
        $estimated_time = $seconds . ' שניות';
    }

    return $estimated_time;

}
/* Duble for RATING! */
/*function asavvy_estimated_reading_time() {

	$post = get_post();

    $words = count(preg_split('/\s+/', strip_tags( $post->post_content )));
	$minutes = floor( $words / 200 );
	$seconds = floor( $words % 200 / ( 200 / 60 ) );

	// Only Time numbers
	if($minuts < 1) {
		$estimated_time_num = $minutes + $seconds;
	} else {
		$estimated_time_num = ($minutes*60) + $seconds;
	}
	// For Rating Procces

	return $estimated_time_num;

}*/
/* START
 * Fetching from DataBase list of Not Rated Posts
 */
function fetch_posts_list_to_rate() {

    global $wpdb;

    $table = 'wp_rating_article';
    $table_post = 'wp_posts';
    $table_expiration = 'wp_expiration_time';
    $time = time();

    $results_posts = $wpdb->get_results( "SELECT * FROM $table_post LEFT JOIN $table_expiration ON $table_post.ID = $table_expiration.post_id WHERE post_status = 'publish' AND post_type = 'post' AND ($table_expiration.expiration_time IS NULL OR $table_expiration.expiration_time > $time) " );

    return $results_posts;
}

/* END
 * Fetching from DataBase list of Not Ratated Posts
 */

/* START
 * Get Post ID if expired
 */
function get_post_id_if_expired() {
    global $wpdb;
    $table_expiration = 'wp_expiration_time';
    $post_id = get_the_ID();
    $time = time();

    $results = $wpdb->get_results(" SELECT * FROM $table_expiration WHERE $table_expiration.post_id = $post_id AND expiration_time > $time");
    if(count($results) > 0) {
        return true;
    }

    false;

}
/* END
 * Get Post ID if expired
 */

/* START
 * fetch Rating by most Rating
 */

function home_page_by_rating() {

//    $args = array(
//        'post_type'         => 'post',
//        'post_status'       => 'publish',
//        'posts_per_page'    => 10,
//        'orderby'           => array(
//            'post_score'        => 'DESC',
////            'date'              => 'DESC',
//        ),
//        'meta_query'        => array(
//            'relation'      => 'AND',
//            array(
//                'key'           => 'post_score',
//                'value'         => 1.6,
//                'compare'       => '>=',
//                'type'		    => 'NUMERIC',
//            ),
//            array(
//                'key'           => 'running_done',
//                'value'         => true,
//                'compare'       => '=',
//            ),
//        ),
//    );
//
//    $posts = get_posts( $args );
//    $posts_ids = array();
//    for ( $i = 0; $i < count($posts); $i++ ) {
//        $post_id = $posts[$i]->ID;
//        if ( get_the_date($post_id) )
//        $posts_ids[] = $post_id;
//        $posts[$i]->avrage = get_field( 'post_score', $post_id );
//        $posts[$i]->post_id = $post_id;
//    }
//
//    $older_posts_args = array(
//        'post_type'         => 'post',
//        'post_status'       => 'publish',
//        'posts_per_page'    => 50,
//        'post__not_in'      => $posts_ids,
//        'orderby'           => array(
//            'date'              => 'DESC',
//        ),
//        'meta_query'        => array(
//            array(
//                'key'           => 'running_done',
//                'value'         => true,
//                'compare'       => '=',
//            ),
//        ),
//    );
//
//    $older_posts = get_posts( $older_posts_args );
//
//    for ( $i = 0; $i < count($older_posts); $i++ ) {
//        $post_id = $older_posts[$i]->ID;
//        if ( in_array( $post_id, $posts_ids ) ) {
//            unset($older_posts[$i]);
//            continue;
//        }
//        $older_posts[$i]->avrage = get_field( 'post_score', $post_id );
//        $older_posts[$i]->post_id = $post_id;
//    }
//
////    if ( get_current_user_id() == 637 ) {
//        return array_merge($posts, $older_posts);
////    }

    global $wpdb;

    $final_articles = [];

    $table = 'wp_rating_article';
    $table_posts = 'wp_posts';

    $results_top_rating = $wpdb->get_results( "SELECT DISTINCT wp_posts.post_author, wp_posts.post_content, wp_posts.post_title, wp_rating_article.post_id, (wp_rating_article.sum_rate/wp_rating_article.numbers_of_raters - wp_rating_article.minus) as avrage FROM wp_rating_article INNER JOIN wp_posts ON wp_posts.ID = wp_rating_article.post_id WHERE post_status = 'publish' AND (wp_rating_article.sum_rate/wp_rating_article.numbers_of_raters - wp_rating_article.minus) > 1.6 ORDER BY avrage DESC LIMIT 50" );

    $articles = [];

    // Check how many posts have >= 1.6 rating
    $num_posts_rated = 0;

    foreach ($results_top_rating as $article) {
        // Check if article is expired
        $article_id = $article->post_id;
        $hide_from_homepage = get_field( 'hide_from_homepage', $article_id );
        if ( $hide_from_homepage ) {
            continue;
        }
        $time = time();

        if ($article->avrage > 1.65) {
            $num_posts_rated++;

            if (count($wpdb->get_results("SELECT * FROM wp_expiration_time WHERE post_id = $article_id AND expiration_time < $time"))) {
                array_push($final_articles, $article);
            }
        }

        // if (count($wpdb->get_results("SELECT * FROM wp_expiration_time WHERE post_id = $article_id AND expiration_time < $time"))) {
        // 	array_push($articles, $article);
        // }
    }

    // Get old posts sorted
    $old_posts_query = $wpdb->get_results("SELECT *, ID as post_id FROM wp_posts WHERE post_status = 'publish' AND post_type = 'post' ORDER BY ID DESC LIMIT 100");

    foreach ($old_posts_query as $article) {
        // Check if is not in the top rating array

        $article_id = $article->post_id;
        $hide_from_homepage = get_field( 'hide_from_homepage', $article_id );
        if ( $hide_from_homepage ) {
            continue;
        }
        $time = time();


        $found = false;

        for ($i = 0; $i < count($final_articles); $i++) {
            if ($final_articles[$i]->post_id == $article->post_id) {
                $found = true;
                break;
            }
        }

        if (!$found) {
            if (count($wpdb->get_results("SELECT * FROM wp_expiration_time WHERE post_id = $article_id AND expiration_time < $time"))) {
                // Check if post had rating
                $rating_row = $wpdb->get_row("SELECT * FROM wp_rating_article WHERE post_id = {$article_id}");

                if ($rating_row) {
                    array_push($final_articles, $article);
                }
            }
        }
    }

    // foreach ($results_top_rating2 as $article) {
    // 	array_push($articles, $article);
    // }

//    if ( get_current_user_id() == 637 ) {
//        echo "-----------------------------------------------------------------------";
//        echo "<pre>" . print_r($final_articles, true) . "</pre>";
//    }
    return $final_articles;
}

function omertest2() {
    $args = array(
        'post_type'         => 'post',
        'post_status'       => 'publish',
        'posts_per_page'    => 10,
        'date_query'        => array(
            'before' => date('Y-m-d H:i', strtotime('-10 minutes'))
        ),
        'orderby'           => array(
            'post_score'        => 'DESC',
//            'date'              => 'DESC',
        ),
        'meta_query'        => array(
            array(
                'key'           => 'post_score',
                'value'         => 1.6,
                'compare'       => '>=',
                'type'		    => 'NUMERIC',
            ),
        ),
    );

    $posts = get_posts( $args );
    $posts_ids = array();
    for ( $i = 0; $i < count($posts); $i++ ) {
        $post_id = $posts[$i]->ID;
        if ( get_the_date($post_id) )
            $posts_ids[] = $post_id;
        $posts[$i]->avrage = get_field( 'post_score', $post_id );
        $posts[$i]->post_id = $post_id;
    }

    $older_posts_args = array(
        'post_type'         => 'post',
        'post_status'       => 'publish',
        'posts_per_page'    => 50,
        'post__not_in'      => $posts_ids,
        'date_query'        => array(
            'before' => date('Y-m-d H:i', strtotime('-9 minutes'))
        ),
        'orderby'           => array(
            'date'              => 'DESC',
        ),
    );

    $older_posts = get_posts( $older_posts_args );

    for ( $i = 0; $i < count($older_posts); $i++ ) {
        $post_id = $older_posts[$i]->ID;
        if ( in_array( $post_id, $posts_ids ) ) {
            unset($older_posts[$i]);
            continue;
        }
        $older_posts[$i]->avrage = get_field( 'post_score', $post_id );
        $older_posts[$i]->post_id = $post_id;
    }

//    if ( get_current_user_id() == 637 ) {
    return array_merge($posts, $older_posts);
//    }
}

function omertest4() {
    $posts = home_page_by_rating();
    $post_titles = array();
    foreach ( $posts as $post ) {
        unset($post->post_content);
    }
    echo "<pre>" . print_r($post, true) . "</pre>";
    exit;
}

function posts_to_csv() {
    $args = array(
        'post_type' => 'post',
        'posts_per_page' => -1,
    );

    $posts = get_posts( $args );
//    echo "<pre>" . print_r($posts, true) . "</pre>";
    $urls = array();
    foreach ( $posts as $post ) {
        $post_slug = get_post_field( 'post_name', $post->ID );
        $post_cat_slug = get_the_category( $post->ID )[0]->slug;
        $url = "/$post_cat_slug/$post_slug";
        $current_url = str_replace( "wordpress-860415-2972947.cloudwaysapps.com", "wordpress-668856-3151571.cloudwaysapps.com", get_permalink($post->ID));
        $current_url = str_replace( "https://wordpress-668856-3050814.cloudwaysapps.com", "", $current_url);
        $current_url = urldecode($current_url);
        $url = urldecode($url);
        $urls[] = array("Redirect 301 $current_url $url");
    }
//    echo "<pre>" . print_r($urls, true) . "</pre>";
    array_to_csv_download($urls, "posts_export.csv");
}

function array_to_csv_download($array, $filename = "export.csv", $delimiter=",") {
    header('Content-Encoding: UTF-8');
    header('Content-type: text/csv; charset=UTF-8');
    header('Content-Disposition: attachment; filename="'.$filename.'";');

    // open the "output" stream
    // see http://www.php.net/manual/en/wrappers.php.php#refsect2-wrappers.php-unknown-unknown-unknown-descriptioq
    $f = fopen('php://output', 'w');

    foreach ($array as $line) {
        fputcsv($f, $line, $delimiter);
    }
}

function omertest() {
    register_rest_route( 'export/v1', '/posts', array(
        'methods' => 'GET',
        'callback' => 'posts_to_csv',
        'args' => array(),
    ) );
//    register_rest_route( 'tests/v1', '/home_posts', array(
//        'methods' => 'GET',
//        'callback' => 'fetch_posts_for_popup',
//        'args' => array(),
//    ));
}
add_action( 'rest_api_init', 'omertest' );

function fetch_posts_for_popup() {
	global $wpdb;
	$post_url = '';

	// Add this variable the different time
	$time_down_rate = get_field( 'time_down_rate', 10537 );
	$new_time_noco  = time() + $time_down_rate;
	// $new_time_noco = time() + (60);
	$table_expiration1 = 'wp_expiration_time';

	$table            = 'wp_rating_article';
	$table_post       = 'wp_posts';
	$table_expiration = 'wp_expiration_time';
	$time             = time();
	//    $time = 1665040000;

	$posts_args = array(
		'post_type'   => 'post',
		'limit'       => '10',
		'post_status' => 'running',
	);

	if ( is_user_logged_in() ) {
		$posts_args['author'] = -get_current_user_id();
	}

	$posts         = get_posts( $posts_args );
	$results_posts = array();
	foreach ( $posts as $post ) {
		//        $results_posts[] = $post->ID;
		//        continue;
		$expiration_time        = $wpdb->get_var( "SELECT expiration_time FROM wp_expiration_time WHERE post_id = $post->ID AND (expiration_time IS NULL OR expiration_time > $time) ORDER BY id DESC LIMIT 1" );
		$ip                     = get_user_ip();
		$post_author_ip         = get_field( 'author_ip', $post->ID );
		$current_user_is_author = is_user_logged_in() && get_current_user_id() == $post->post_author;
		if ( $expiration_time ) {
			$rated = $wpdb->get_var( "SELECT id FROM article_raters WHERE post_id = $post->ID AND ip = '$ip'" );
			if ( ( is_admin() && ! $rated ) || ( ! $rated && ! $current_user_is_author && $ip != $post_author_ip ) ) {
				$post->expiration_time = $expiration_time;
				$results_posts[]       = $post;
			}
		} else {
			$rating = $wpdb->get_results( "SELECT * FROM $table WHERE post_id = $post->ID" );
			if ( ( is_admin() && ! $rating ) || ( ! $rating && ! $current_user_is_author && $ip != $post_author_ip ) ) {
				$expiration_time
					                   = $wpdb->get_var( "SELECT expiration_time FROM wp_expiration_time WHERE post_id = $post->ID ORDER BY id DESC LIMIT 1" );
				$post->expiration_time = $expiration_time;
				$results_posts[]       = $post;
			}
		}
	}
	//    This query is SLOW
	//    $results_posts = $wpdb->get_results( "SELECT * FROM $table_post LEFT JOIN $table_expiration ON $table_post.ID = $table_expiration.post_id WHERE post_status = 'publish' AND post_type = 'post' AND ($table_expiration.expiration_time IS NULL OR $table_expiration.expiration_time > $time)" );

	//    echo json_encode($results_posts);
	//    exit;

	$ip = get_user_ip();

	if ( count( $results_posts ) > 0 ) {
		// print_r($results_posts);
		// echo 'eeee';
		// echo count($results_posts);
		for ( $i = count( $results_posts ); $i >= 0; $i -- ) {
			$post_url = get_the_category( $results_posts[ $i ]->ID )[0]->slug . '/' . $results_posts[ $i ]->post_name;
			if ( is_null( $results_posts[ $i ]->expiration_time ) ) {
				$wpdb->replace( $table_expiration1,
					array( 'post_id' => strval( $results_posts[ $i ]->ID ), 'expiration_time' => $new_time_noco ),
					array( '%d', '%d' ) );
			} else {
				// print_r($results_posts[$i]);

				$post_id = strval( $results_posts[ $i ]->ID );

				// Check if user already rated the article
				$did_rate
					= count( $wpdb->get_results( "SELECT * FROM article_raters WHERE ip = '$ip' AND post_id = $post_id" ) );

				echo json_encode( array(
					"post_id"  => $post_id,
					'ip'       => get_user_ip(),
					"post_url" => $post_url,
					"image"    => get_the_post_thumbnail_url( $post_id ),
					"response" => ! count( $wpdb->get_results( "SELECT * FROM popups_show WHERE ip = '$ip' AND post_id = $post_id" ) )
					              || ! $did_rate,
				) );

				die;

				/* 			if () {
								echo '<a class="popup-div" href="https://wordpress-668856-2361490.cloudwaysapps.com/' . $post_url . '/?source=popup" ><div class="fnc-popup-wrap">
										' . get_the_post_thumbnail($post_id) . '
										<div class="fnc-popup-container">
											<div class="fnc-popup-content">
												<p>נבחרת להשפיע  <br/>על כתבה שנשלחה מגולש.  <br />דרג האם לדעתךּ  <br />היא צריכה לעלות לחבּוּרֶה?</p>
												<button class="fnc-popup-button">דרג עכשיו</button>
											</div>
										</div>
									</div></a>';

								// Insert popup show to DB
								// $wpdb->replace('popups_show', [ 'ip' => $ip, 'post_id' => $post_id ], [ '%s', '%d' ]);
							} */
			}
		}
	}
}

// print_r(home_page_by_rating());
/* END
 * fetch Rating by most Rating
 */

/* START
 * Display PopUp And Rating option in end of New Published Article
 */

add_action( 'wp_body_open', 'popup_register' );
function popup_register() {
    global $wpdb;
    global $post;

    if (isset($_GET['source']) && $_GET['source'] == 'popup') {
        // echo 'popup <br>';
        // echo get_the_ID();
        // print_r($post);
        $post_id = $post->ID;
        $ip = get_user_ip();
        // echo $post->ID;
        // Insert popup show to DB
        $wpdb->replace('popups_show', [ 'ip' => $ip, 'post_id' => $post_id ], [ '%s', '%d' ]);
    }
}

/* END
 * Display PopUp And Rating option in end of New Published Article
 */

//add_action( 'wp_body_open', 'display_popup_and_rating_by_post' );

// Get user IP
function get_user_ip () {
    return $_SERVER['HTTP_CLIENT_IP'] ? : ($_SERVER['HTTP_X_FORWARDED_FOR'] ? : $_SERVER['REMOTE_ADDR']);
}

/**
 * Rating Call Update
 */
function call_update_rating() {

    global $wpdb;

    $table = 'wp_rating_article';
    $post_id = $_POST['post_id'];

    $results = $wpdb->get_results( "SELECT * FROM $table WHERE post_id = $post_id" );

    foreach($results as $row){
        $numbers_of_raters = $row->numbers_of_raters;
        $sum_rate = $row->sum_rate;
    }

    $numbers_of_raters1 = $_POST['numbers_of_raters'];
    $sum_rate1 = $_POST['sum_rate'];

    $ip = get_user_ip();

    // if($numbers_of_raters >= 1) {
    // 	$wpdb->update($table, array('sum_rate' => ($sum_rate+$sum_rate1), 'numbers_of_raters' => ($numbers_of_raters+$numbers_of_raters1)), array('post_id' => $post_id), array('%d', '%d', '%d') );
    // } else {
    // 	$wpdb->replace($table, array( 'post_id' => $post_id, 'numbers_of_raters' => ($numbers_of_raters+$numbers_of_raters1), 'sum_rate' => ($sum_rate+$sum_rate1)), array('%d', '%d', '%d') );
    // }

    // Check if user already rated this post
    if (!count($wpdb->get_results("SELECT * FROM article_raters WHERE post_id = $post_id AND ip = '$ip'"))) {
        update_post_meta( $post_id, 'admin_rated', true );
        // $wpdb->replace($table, array( 'post_id' => $post_id, 'numbers_of_raters' => ($numbers_of_raters+$numbers_of_raters1), 'sum_rate' => ($sum_rate+$sum_rate1)), array('%d', '%d', '%d') );
        if($numbers_of_raters >= 1) {
            $wpdb->update($table, array('sum_rate' => ($sum_rate+$sum_rate1), 'numbers_of_raters' => ($numbers_of_raters+$numbers_of_raters1)), array('post_id' => $post_id), array('%d', '%d', '%d') );
        } else {
            $wpdb->replace($table, array( 'post_id' => $post_id, 'numbers_of_raters' => ($numbers_of_raters+$numbers_of_raters1), 'sum_rate' => ($sum_rate+$sum_rate1)), array('%d', '%d', '%d') );
        }
        $wpdb->replace('article_raters', [ 'post_id' => $post_id, 'ip' => $ip ], [ '%d', '%s' ]);
    }

    $result = $wpdb->insert_id;

    header('Content-Type: application/json');
    echo json_encode(array('rows' => $result));

    die;


}

add_action( 'wp_ajax_call_update_rating', 'call_update_rating' );
add_action( 'wp_ajax_nopriv_call_update_rating', 'call_update_rating' );
/*
 * END Rating Call
**/

/** START
 * Console.Log
 */

function console_log( $data ){
    echo '<script>';
    echo 'console.log('. json_encode( $data ) .')';
    echo '</script>';
}
/* END
 * Console.Log
**/

/**
 * Get Rating for Post
 */
function get_rating_by_post() {

    global $wpdb;

    $tbl_name = "wp_rating_article";
    $post_id = get_the_ID();

    //$category_id = get_cat_id();
    $results = $wpdb->get_results( "SELECT * FROM $tbl_name WHERE post_id = $post_id" );

    return $results;
}

add_filter('post_link', 'track_displayed_posts');
add_action('pre_get_posts','remove_already_displayed_posts');

$displayed_posts = [];

function track_displayed_posts($url) {
    global $displayed_posts;
    $displayed_posts[] = get_the_ID();
    return $url; // don't mess with the url
}

function remove_already_displayed_posts($query) {
    global $displayed_posts;
    $query->set('post__not_in', $displayed_posts);
}
/*
 * END Get Rating for Post
**/

// Add "expired" class to expired article body - $result = get_post_id_if_expired();
add_filter( 'body_class','my_body_classes' );
function my_body_classes( $classes ) {
    if (!get_post_id_if_expired() && post_have_rating()) {
        $classes[] = 'expired';
    }

    return $classes;
}

function post_have_rating($post_id=null) {
    if ( $post_id == null) {
        $post_id = get_the_ID();
    }
    global $wpdb;
    $rating = $wpdb->get_var("SELECT * FROM wp_rating_article WHERE post_id = $post_id");
    if ($rating) {
        return true;
    }
    return false;
}

// Add article.js to articles

function wpb_hook_javascript_footer() {
    if (is_single()) {
        wp_enqueue_script('article-script', get_stylesheet_directory_uri().'/js/article.js');
    } ?>
<?php }
add_action('wp_footer', 'wpb_hook_javascript_footer');

// Show rating in posts table
add_filter('manage_post_posts_columns', function($columns) {
    return array_merge($columns, ['rating' => __('דירוג', 'textdomain')]);
});

add_action('manage_post_posts_custom_column', function($column_key, $post_id) {
    if ($column_key == 'rating') {
        global $wpdb;
        $articles_table = 'wp_rating_article';
        $article_rating_query = $wpdb->get_results("SELECT * FROM $articles_table WHERE post_id = $post_id AND sum_rate");
        if (count($article_rating_query)) {
            $article_rating = $article_rating_query[0];
//            $result = $wpdb->get_results("SELECT * FROM wp_expiration_time WHERE post_id = $post_id");
//            if ( $result->expiration_time < time() && !get_field('running_done', $post_id) ) {
//                update_field( 'running_done', true, $post_id );
//            }
            echo ( $article_rating->sum_rate / $article_rating->numbers_of_raters ) - $article_rating->minus;
        }
    }
//    if ($column_key == 'omer_rating') {
//        get_field( 'post_score', $post_id );
//    }
}, 10, 2);

// Original rating column
add_filter('manage_post_posts_columns', function($columns) {
    return array_merge($columns, ['orig_rate' => __('דירוג מקורי', 'textdomain')]);
});

add_action('manage_post_posts_custom_column', function($column_key, $post_id) {
    global $wpdb;
    if ($column_key == 'orig_rate') {
        $articles_table = 'wp_rating_article';
        $article_rating_query = $wpdb->get_results("SELECT * FROM $articles_table WHERE post_id = $post_id AND sum_rate");

        if (count($article_rating_query)) {
            $article_rating = $article_rating_query[0];
            echo ( $article_rating->sum_rate / $article_rating->numbers_of_raters );
        }

    }
}, 10, 2);

// Raters column
add_filter('manage_post_posts_columns', function($columns) {
    return array_merge($columns, ['raters' => __('כמה דירגו', 'textdomain')]);
});

add_action('manage_post_posts_custom_column', function($column_key, $post_id) {
    global $wpdb;
    if ($column_key == 'raters') {
        $articles_table = 'wp_rating_article';
        $article_rating_query = $wpdb->get_results("SELECT * FROM $articles_table WHERE post_id = $post_id AND sum_rate");

        if (count($article_rating_query)) {
            $article_rating = $article_rating_query[0];
            echo $article_rating->numbers_of_raters;
        }

    }
}, 10, 2);



add_action( 'wp_ajax_nopriv_display_popup', 'fetch_posts_for_popup' );
add_action( 'wp_ajax_display_popup', 'fetch_posts_for_popup' );

function display_popup() {

    global $wpdb;
    $post_url = '';

    // Add this variable the diferent time
    $time_down_rate = get_field('time_down_rate', 10537);
    $new_time_noco = time() + $time_down_rate;
    // $new_time_noco = time() + (60);
    $table_expiration1 = 'wp_expiration_time';



    $results_posts = fetch_posts_list_to_rate();


    $ip = get_user_ip();



    if(count($results_posts) > 0) {
        // print_r($results_posts);
        // echo 'eeee';
        // echo count($results_posts);
        for ($i = count($results_posts); $i >= 0 ; $i--) {
            $post_url = $results_posts[$i]->post_name;
            if( is_null($results_posts[$i]->expiration_time) ) {
                $wpdb->replace($table_expiration1, array( 'post_id' => $results_posts[$i]->ID, 'expiration_time' => $new_time_noco ), array('%d', '%d') );
            } else {

                // print_r($results_posts[$i]);

                $post_id = $results_posts[$i]->ID;

                // Check if user already rated the article
                $did_rate = count($wpdb->get_results("SELECT * FROM article_raters WHERE ip = '$ip' AND post_id = $post_id"));



                echo json_encode(array(
                    "post_id"=>$post_id,
                    'ip'=>get_user_ip(),
                    "post_url"=>$post_url,
                    "image"=>get_the_post_thumbnail_url($post_id),
                    "response"=>!count($wpdb->get_results("SELECT * FROM popups_show WHERE ip = '$ip' AND post_id = $post_id")) || !$did_rate
                ));

                die;

                /* 			if () {
                                echo '<a class="popup-div" href="https://wordpress-668856-2361490.cloudwaysapps.com/' . $post_url . '/?source=popup" ><div class="fnc-popup-wrap">
                                        ' . get_the_post_thumbnail($post_id) . '
                                        <div class="fnc-popup-container">
                                            <div class="fnc-popup-content">
                                                <p>נבחרת להשפיע  <br/>על כתבה שנשלחה מגולש.  <br />דרג האם לדעתךּ  <br />היא צריכה לעלות לחבּוּרֶה?</p>
                                                <button class="fnc-popup-button">דרג עכשיו</button>
                                            </div>
                                        </div>
                                    </div></a>';

                                // Insert popup show to DB
                                // $wpdb->replace('popups_show', [ 'ip' => $ip, 'post_id' => $post_id ], [ '%s', '%d' ]);
                            } */
            }
        }
    }



}


function wpb_hook_javascript() {
    ?>
    <script>




        fetch("/wp-admin/admin-ajax.php?action=display_popup").then(res=>res.json()).then((response)=>{

            if(response.response){
                console.log(response);
                const popupWrap = document.createElement('div');
                popupWrap.innerHTML = `<a class='popup-div' rel='nofollow' href='/${response.post_url}/?source=popup' ><div class='fnc-popup-wrap'><img src='${response.image}'/><div class="fnc-popup-container">
								<div class="fnc-popup-content">
									<p>נבחרת להשפיע  <br/>על כתבה שנשלחה מגולש.  <br />דרג האם לדעתךּ  <br />היא צריכה לעלות לחבּוּרֶה?</p>
									<button class="fnc-popup-button">דרג עכשיו</button>
								</div>
							</div>
						</div></a>`;

                document.body.appendChild(popupWrap);



            }

        })






    </script>

    <?php
}
add_action('wp_head', 'wpb_hook_javascript');






function cptui_register_my_cpts() {

    /**
     * Post Type: מבזקים.
     */

    $labels = [
        "name" => __( "מבזקים", "custom-post-type-ui" ),
        "singular_name" => __( "מבזק", "custom-post-type-ui" ),
        "archives" => __( "כל המבזקים", "custom-post-type-ui" ),
    ];

    $args = [
        "label" => __( "מבזקים", "custom-post-type-ui" ),
        "labels" => $labels,
        "description" => "",
        "public" => true,
        "publicly_queryable" => true,
        "show_ui" => true,
        "show_in_rest" => true,
        "rest_base" => "",
        "rest_controller_class" => "WP_REST_Posts_Controller",
        "has_archive" => "allflashnews",
        "show_in_menu" => true,
        "show_in_nav_menus" => true,
        "delete_with_user" => false,
        "exclude_from_search" => false,
        "capability_type" => "post",
        "map_meta_cap" => true,
        "hierarchical" => false,
        "rewrite" => [ "slug" => "flash_news", "with_front" => true ],
        "query_var" => true,
        "menu_icon" => "dashicons-admin-site",
        "supports" => [ "title", "editor", "thumbnail", "custom-fields", "author", "acf costum filed" ],
        "show_in_graphql" => false,
    ];

    register_post_type( "flash_news", $args );
}

add_action( 'init', 'cptui_register_my_cpts' );



/* add_action('elementor/query/author_page', function($query) {
    $query->set('post__not_in', '');
});
 */

function filter_phone_numbers_from_content ( $content ) {


    if ( is_singular( 'post' )  ) {


        //$content = preg_replace('/\b\d{3}[-]?\d{3}[-]?\d{4}|\d{1}[-]?\d{3}[-]?\d{2}[-]?\d{2}[-]?\d{2}|\*{1}?\d{2,5}\b/', '', $content);

        $content = preg_replace('/((http(s)?:\/\/)?)(www\.)?((youtube\.com\/)|(youtu.be\/))[\S]+/', '', $content);

        $content = preg_replace('/^(?:\*)\d+|0{1}5{1}\d\d{7}|0{1}5{1}\d-\d{7}|0{1}(2|3|4|8)\d{7}$/', '', $content);
        $content = preg_replace('/\S+@\S+\.\S+/', '', $content);

        $content = str_replace(array("*" , "@" ) , "" , $content);

        $content = strip_tags($content, '<p> <img> <strong> <span> <h1> <h2> <h3> <h4> <h5> <h6>');
        //$content = preg_replace('/\b((https?|ftp|file):\/\/|www\.)[-A-Z0-9+&@#\/%?=~_|$!:,.;]*[A-Z0-9+&@#\/%=~_|$]/i', ' ', $content);

    }

    return $content;
}
add_filter( 'the_content', 'filter_phone_numbers_from_content');





add_action( 'save_post_advertising', 'wpse63478_save' ,100, 3);
//add_action( 'save_post', 'wpse63478_save' ,100, 3);



function wpse63478_save($post_id, $post, $update) {

    $media = get_field("media_content");

    if($media){

        foreach ($media as $key => $m) {

            if(isset($m['media']['ID'])){

                $id = $m['media']['ID'];
                $credit = $m['media_credit'];
                $desctiption = $m['description'];

                $the_post = array(
                    'ID'           => $id,
                    'post_excerpt' => $credit,
                    'post_content' => $desctiption,
                );

                wp_update_post( $the_post );

            }


        }

    }





}



function upload_article_scripts() {

    wp_enqueue_script( 'add-media-files', get_template_directory_uri() . '-child/js/add-media-files.js', array(), '1.0.3', true );


    ?>


    <style>


        [data-name="media_content"] table {
            display:none;
        }

        /* 		[data-name="media_content"] table th:first-child {
                        display: none;
                }
     */


        .acf-file-uploader .show-if-value{
            width: fit-content;
            margin: 0 auto;
            min-height:initial
        }

        .acf-file-uploader .file-info{
            display:none;
        }


        .acf-file-uploader .upload_thumb{
            max-width:100px;
        }

        [data-name="media_content"] [data-name="icon"]{
            display: block;
        }

        .acf-row-handle.remove .acf-icon.-cancel.dark{
            display: block;
            position: static;
            border:none;
            background-color: #F9F9F9!important;
            margin:0;
        }

        .acf-row-handle.remove .acf-icon.-cancel:before{
            background-color: #F9F9F9!important;
            color:#a7a7a7 !important;
        }


    </style>
    <?php

}
add_action('wp_head', 'upload_article_scripts');




function add_media_to_content($content) {

    global $post;

    $new_content = $content;

    if ($post->post_type !== 'advertising') {
        $media = get_field('media_content');
        if($media){
//            $credit = $m['media_credit'];
//            $desctiption = $m['description'];
            foreach ($media as $key => $m) {
                $new_content .="<div class='media_image'>";
                $image = wp_get_attachment_image_src($m['media']['ID'], 'large');
                $image_alt = get_post_meta($m['media']['ID'], '_wp_attachment_image_alt', TRUE);
//                    $image_title = get_the_title($m['media']['ID']);
                $new_content .= '<img src="'.$image[0].'" data-original="'.$image[0].'" alt="'.$image_alt.'" width="'.$image[1].'" height="'.$image[2].'" >';
                $credit = "<p class='elementor_credit'>קרדיט: ".$m['media_credit'];
                if (get_user_ip() == '80.178.14.58') {
//                    $new_content .= $m['description'];
                }

//                if($m['description'] && !str_contains(get_the_title(), $m['description'])){
                $m['description'] = explode(' / ', $m['description'])[0];
                if($m['display_description']){
                    $credit.=" / ".$m['description']."</p>";
                }else{
                    $credit.="</p>";
                }

                $new_content .=$credit;
                $new_content .="</div>";

            }
        }
        $videos_shortcodes = get_field('vimeo_shortcodes');
//        echo "<pre>" . print_r($videos_shortcodes, true) . "</pre>";
        if($videos_shortcodes) {
            $counter = 0;
            $media = get_field('video_content');
            foreach ($videos_shortcodes as $video_shortcode) {
                $new_content .= $video_shortcode['shortcode'];
                $m = $media[$counter];
                $credit = "<p class='elementor_credit' style='margin-top:initial'>קרדיט: ".$m['media_credit'];

                $m['description'] = explode(' / ', $m['description'])[0];
                if($m['display_description']){
                    $credit.=" / ".$m['description']."</p>";
                }else{
                    $credit.="</p>";
                }

                $new_content .=$credit;
            }
        }
        $audio = get_field('audio_content');
        if ($audio) {
            foreach ($audio as $key => $a) {
                $new_content .= '<audio controls style="width: 100%">
                              <source src="'.$a['media']['url'].'" type="'.$a['media']['mime_type'].'">
                            Your browser does not support the audio element.
                            </audio>';
                $credit = "<p class='elementor_credit'>קרדיט: ".$a['media_credit'];

                $m['description'] = explode(' / ', $m['description'])[0];
                if($m['display_description']){
                    $credit.=" / ".$a['description']."</p>";
                }else{
                    $credit.="</p>";
                }
                $new_content .=$credit;
            }
        }
    }

    return $new_content;

}

add_filter('the_content', 'add_media_to_content');


function add_media_to_content_ad($content) {
    global $post;



    if ($post->post_type == 'advertising') {

        echo "e";

        $media = get_field("media_content");


        print_r($media);

        if($media){



            $credit = $m['media_credit'];
            $desctiption = $m['description'];


            foreach ($media as $key => $m) {




                if($m['media']['subtype'] == "mp4"){


                    $vimeo = get_post_meta( $m['media']['id'], "vimeo", true );



                }else{

                    $content .="<div class='media_image'>";
                    $content .= wp_get_attachment_image($m['media']['ID'] , "large");


                    $credit = "<p class='elementor_credit'>קרדיט: ".$m['media_credit'];

                    if($m['description']){
                        $credit.=" / ".$m['description']."</p>";
                    }else{
                        $credit.="</p>";
                    }




                    $content .=$credit;



                    $content .="</div>";

                }

            }

        }


    }
    return $content;
}

add_filter('the_content', 'add_media_to_content_ad');

use BracketSpace\Notification\Register;

add_action( 'notification/init', function() {
    include 'OSCarrier.php';
    Register::carrier( new ExampleCarrier() );
} );

add_action( 'notification/carrier/pre-send', function( $carrier, $trigger, $notification ) {

    if ( $carrier->get_slug() == 'email' ) {
//		$carrier->suppress();
    }
    var_dump("HIHIH");
    file_put_contents("mailSent","mmmm");
}, 10, 3 );

function trigger_cronjob( $post_id ) {

    date_default_timezone_set('Asia/Jerusalem');

    global $wpdb;

    $time_down_rate = 600;
    $new_time_noco = time() + $time_down_rate;

    $expiration_time = $wpdb->get_var("SELECT id FROM wp_expiration_time WHERE post_id = $post_id");

    $values = array(
        'expiration_time' => "{$new_time_noco}",
        'post_id' => $post_id
    );

    if ( !$expiration_time ) {
        $wpdb->insert( 'wp_expiration_time', $values );
    }

	update_post_meta( $post_id, 'running_end_time', time() );

}

add_action( 'running_post', 'trigger_cronjob', 10, 1 );

function author_load_more_posts_func() {
    if (!isset($_REQUEST['nonce']) || !wp_verify_nonce($_REQUEST['nonce'], 'author_more_posts')) {
        wp_send_json_error(array(
            'message' => 'Wrong nonce',
        ));
    }

    $offset = 39;

    if (!isset($_REQUEST['author_id'])) {
        wp_send_json_error(array(
            'message' => 'No author id',
        ));
    }

    if (isset($_REQUEST['offset'])) {
        $offset = $_REQUEST['offset'];
    }

    $posts = get_posts(array(
        'post_type' => 'post',
        'author' => $_REQUEST['author_id'],
        'post_status' => 'publish',
        'offset' => $offset,
        'posts_per_page' => 10,
    ));

    $posts_processed = array();
    foreach ( $posts as $post ) {
        $post = array(
            'permalink' => get_permalink($post->ID),
            'thumbnail' => get_the_post_thumbnail_url($post->ID),
            'title' => $post->post_title,
            'excerpt' => $post->post_excerpt,
            'author_fname' => get_the_author_meta( 'first_name', $post->post_author ),
            'author_lname' => get_the_author_meta( 'last_name', $post->post_author ),
        );
        $posts_processed[] = $post;
    }

    wp_send_json_success($posts_processed);

}
add_action( 'wp_ajax_author_load_more_posts', 'author_load_more_posts_func' );
add_action( 'wp_ajax_nopriv_author_load_more_posts', 'author_load_more_posts_func' );
