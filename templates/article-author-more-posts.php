<h2 class="tw-inline-block tw-px-4 tw-bg-blue-500 tw-text-white tw-text-center tw-text-2xl tw-font-bold">
    <?php echo Habura::MORE_INTERESTING_HEADLINES; ?></h2>

<?php
$recent_args              = array(
	"posts_per_page" => -1,
	"orderby"        => "date",
	"order"          => "DESC",
);
$recent_query = new WP_Query( $recent_args );
$recent_posts = $recent_query->posts;

//
$ads_args  = array(
	"post_type"      => "adv",
	'orderby'        => 'rand',
	"posts_per_page" => 2,
);
$ads_query = new WP_Query( $ads_args );
$ads_posts_ids = wp_list_pluck( $ads_query->posts, 'ID' );
shuffle($ads_posts_ids);

echo '<div class="tw-flex tw--mx-4">';
    foreach ( $recent_posts as $key => $post ) {
        echo '<div class="tw-px-4">';
            if ($key === 1) {
                $ad_id = $ads_posts_ids[0];
                include THEME_DIR . '/templates/ad-content.php';
                continue;
            }

            if ($key === 3) {
                $ad_id = $ads_posts_ids[1];
                include THEME_DIR . '/templates/ad-content.php';
                continue;
            }

            include THEME_DIR . '/templates/post-content-2.php';
        echo '</div>';
    }
echo '</div>';
?>

