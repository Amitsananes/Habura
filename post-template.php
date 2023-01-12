<?php
/**
 * Template Name: New Article
 * Template Post Type: post
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}
get_header();
?>

<div class="tw-container">
    <div class="tw-flex">
        <div class="tw-w-2/3">
			<?php
			the_title();
			the_excerpt();
			echo get_the_author_meta( 'display_name' );
			the_date( 'd/m/y H:i' );
			the_content();
			get_footer();
			?>
        </div>
    </div>
</div>
