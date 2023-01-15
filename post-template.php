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

<div class="tw-container tw-mx-auto tw-mt-6">
    <div class="tw-flex lg:tw--mx-10">
        <div class="lg:tw-px-10 lg:tw-w-2/3">
            <?php wp_is_mobile() ? null : nm_print_breadcrumbs(get_the_ID()); ?>
            <h1 class="heading-title tw-text-black tw-mb-2"><?php the_title(); ?></h1>
            <p class="excerpt-text tw-text-gray-1000"><?php echo get_the_excerpt(); ?></p>
            <div class="tw-mb-6">
                <?php echo nm_get_post_meta(); ?>
            </div>
            <div class="tw-mb-6">
	            <?php the_post_thumbnail(); ?>
	            <?php echo get_field('image_credit', get_post_thumbnail_id()); ?>
            </div>
            <?php include get_stylesheet_directory() . '/templates/join-habura-1.php'; ?>
            <div class="tw-mb-6">
	            <?php
	            the_content();
	            ?>
            </div>
	        <?php include get_stylesheet_directory() . '/templates/join-habura-2.php'; ?>
        </div>
        <div class="lg:tw-px-10 lg:tw-w-1/3">
            <h2 class="tw-bg-blue-500 tw-text-white tw-text-center tw-text-2xl tw-font-bold"><?php echo
                Habura::MORE_HEADLINES;
            ?></h2>
        </div>
    </div>
</div>


<?php
get_footer();
