<h2 class="tw-inline-block tw-px-4 tw-bg-blue-500 tw-text-white tw-text-center tw-text-2xl tw-font-bold">
	<?php echo esc_html( Habura::MORE_ARTICLES_BY . ' ' . get_the_author_meta( 'display_name' ) ); ?></h2>

<?php
$recent_args         = array(
	'posts_per_page' => 12,
	'orderby'        => 'date',
	'order'          => 'DESC',
	'author__in'     => get_the_author_meta( 'ID' ),
);
$recent_query        = new WP_Query( $recent_args );
$recent_author_posts = $recent_query->posts;

$ads_args      = array(
	'post_type'      => 'adv',
	'orderby'        => 'rand',
	'posts_per_page' => 2,
);
$ads_query     = new WP_Query( $ads_args );
$ads_posts_ids = wp_list_pluck( $ads_query->posts, 'ID' );
shuffle( $ads_posts_ids );

echo '<div class="tw-flex tw-flex-wrap tw-w-full tw--mx-3">';
foreach ( $recent_author_posts as $key => $recent_author_post ) {
    echo '<div class="tw-px-3 tw-w-1/4 tw-mb-5">';
	if ( 1 === $key ) {
		$ad_id = $ads_posts_ids[0];
		include THEME_DIR . '/templates/ad-content-2.php';
		echo '</div>';
		continue;
	}

	if ( 4 === $key ) {
		$ad_id = $ads_posts_ids[1];
		include THEME_DIR . '/templates/ad-content-2.php';
		echo '</div>';
		continue;
	}

	$queried_post_id = $recent_author_post->ID;
	include THEME_DIR . '/templates/post-content-2.php';
	echo '</div>';
}
echo '</div>';

wp_reset_postdata();
?>
