<h2 class="tw-bg-blue-500 tw-text-white tw-text-center tw-text-2xl tw-font-bold"><?php
	echo Habura::MORE_HEADLINES; ?></h2>
<?php
$recent_args  = array(
	'posts_per_page' => 5,
	'orderby'        => 'date',
	'order'          => 'DESC',
);
$recent_query = new WP_Query( $recent_args );
$recent_posts = $recent_query->posts;

$ads_args      = array(
	'post_type'      => 'adv',
	'orderby'        => 'rand',
	'posts_per_page' => 2,
);
$ads_query     = new WP_Query( $ads_args );
$ads_posts_ids = wp_list_pluck( $ads_query->posts, 'ID' );
shuffle( $ads_posts_ids );

foreach ( $recent_posts as $key => $_post ) {
	if ( 1 === $key ) {
		$ad_id = $ads_posts_ids[0];
		include THEME_DIR . '/templates/ad-content.php';
		continue;
	}

	if ( 4 === $key ) {
		$ad_id = $ads_posts_ids[1];
		include THEME_DIR . '/templates/ad-content.php';
		continue;
	}

	include THEME_DIR . '/templates/post-content-1.php';
}

wp_reset_postdata();
