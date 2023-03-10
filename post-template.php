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
    <div class="nm-layout">
        <aside class="nm-social-bar">
            <?php echo do_shortcode('[social]'); ?>
        </aside>
        <main class="nm-main-bar">
			<?php wp_is_mobile() ? null : nm_print_breadcrumbs( get_the_ID() ); ?>
			<h1 class="heading-title tw-text-black tw-mb-2"><?php the_title(); ?></h1>
					<p class="excerpt-text tw-text-gray-1000"><?php echo get_the_excerpt(); ?></p>
			<div class="tw-mb-6">
				<?php echo nm_get_post_meta(); ?>
			</div>
			<div class="tw-mb-6">
				<?php the_post_thumbnail(); ?>
				<?php echo get_field( 'image_credit', get_post_thumbnail_id() ); ?>
			</div>
            <div id="js-article-join-container" class="tw-mb-6">
	            <?php require THEME_DIR . '/templates/join-habura-1.php'; ?>
            </div>
			<div class="tw-mb-6">
                <div class="entry-content">
                  <?php the_content(); ?>
                </div>
            </div>
			  <?php require THEME_DIR . '/templates/join-habura-2.php'; ?>
              <?php echo do_shortcode('[rating_post_php_output]');?>
		</main>
		<aside class="nm-side-bar" style="top: 5rem;">
			<?php require THEME_DIR . '/partials/article-sidebar.php'; ?>
		</aside>
	</div>
	<section class="tw-w-full tw-mb-6">
		<?php require THEME_DIR . '/partials/article-author-more-posts.php'; ?>
	</section>
	<section class="tw-w-full tw-mb-6">
		<?php require THEME_DIR . '/partials/article-infinite-posts.php'; ?>
	</section>
</div>

<?php require THEME_DIR . '/partials/article-running-strip-1.php'; ?>
<?php require THEME_DIR . '/partials/article-running-strip-2.php'; ?>

<?php
get_footer();
