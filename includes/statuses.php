<?php
// Exit if accessed directly
if ( !defined( 'ABSPATH' ) ) exit;

//// Add the custom post status "running" to WordPress
//function add_running_status() {
//	register_post_status( 'running', array(
//		'label' => 'בהרצה',
//		'label_count' => _n_noop( 'בהרצה <span class="count">(%s)</span>', 'בהרצה <span class="count">(%s)</span>'),
//		'public' => true,
//        'publicly_queryable' => true,
//		'exclude_from_search' => true,
//		'show_in_admin_all_list' => true,
//		'show_in_admin_status_list' => true,
//	));
//}
//add_action( 'init', 'add_running_status' );
//
//// Add the custom post status "running" to the posts' dropdown
//function add_to_post_status_dropdown()
//{
//	global $post;
//	if($post->post_type != 'post')
//		return false;
//	$status = ($post->post_status == 'running') ? "jQuery( '#post-status-display' ).text( 'בהרצה' ); jQuery(
//'select[name=\"post_status\"]' ).val('running');" : '';
//	echo "<script>
//jQuery(document).ready( function() {
//jQuery( 'select[name=\"post_status\"]' ).append( '<option value=\"running\">בהרצה</option>' );
//".$status."
//});
//</script>";
//}
//add_action( 'post_submitbox_misc_actions', 'add_to_post_status_dropdown');

// Set the post status to "running" when schedule time arrived
function set_status_to_running( $post ) {
	if ( $post && $post->post_type === "post" ) {
		$post->post_status = "running";
		wp_update_post( $post );
	}
}
//add_action( 'future_to_publish', 'set_status_to_running' );

// Prevent search engines from crawling posts with status "running"
function prevent_running_status_crawl() {
	if ( get_post_status() == "running" ) { ?>
		<meta name="robots" content="noindex,follow">
	<?php }
}
add_action( 'wp_head', 'prevent_running_status_crawl' );

function my_search_exclude_filter( $query ) {
	if ( ($query->is_search || is_archive()) && $query->is_main_query() ) {
        $posts = get_posts( array( 'post_status' => 'running' ) );
        $posts_to_hide = array();
        foreach ( $posts as $post ) {
	        $posts_to_hide[] = $post->ID;
        }
		$query->set( 'post__not_in', $posts_to_hide );
	}
}
add_action( 'pre_get_posts', 'my_search_exclude_filter', 9999999 );
