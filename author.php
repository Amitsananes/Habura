<?php

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly.
}

function add_author_schema() {
    ?>

    <?php
}
add_action( 'wp_head', 'add_author_schema' );

get_header();

$curauth = (isset($_GET['author_name'])) ? get_user_by('slug', $author_name) : get_userdata(intval($author));
$author_id = $curauth->ID;

wp_enqueue_script( 'author-infinite-scroll', get_template_directory_uri() . '-child/js/author-infinite-scroll.js', array(), '1.0.0', true );
wp_localize_script('author-infinite-scroll', 'author_ajax', array(
    'nonce' => wp_create_nonce('author_more_posts'),
    'action' => 'author_load_more_posts',
    'author_id' => $author_id,
));

global $wp_query;
$posts = $wp_query->posts;

$first_post = $posts[0];

$posts = get_posts(array(
    'post_type' => 'post',
    'author' => $author_id,
    'post_status' => 'publish',
    'posts_per_page' => 39,
));

array_unshift( $posts, $first_post );

$facebook_url = get_field('עמוד_פייסבוק', 'user_'.$author_id);
$youtube_url = get_field('youtubep', 'user_'.$author_id);
$instagram_url = get_field('חשבון_אינסטגרם', 'user_'.$author_id);
$spotify_url = get_field('spotify', 'user_'.$author_id);
$twitter_url = get_field('חשבון_טוויטר', 'user_'.$author_id);
$whatsapp_url = get_field(' whatsapp-link', 'user_'.$author_id);
$whatsapp_group_url = get_field('whatsgroup', 'user_'.$author_id);
$website_url = get_field(' personal-website', 'user_'.$author_id);
$tiktok_url = get_field('tiktok', 'user_'.$author_id);

$custom_logo_id = get_theme_mod( 'custom_logo' );
$image = wp_get_attachment_image_src( $custom_logo_id , 'full' );
$logo_url = $image[0];

?>

    <div class="wrapper"><!-- START Wrap -->
        <div class="container flex-container-master"><!-- START Section 1 -->
            <div class="master-main-container flex-item-master flex-container-main">
                <div class="main-side flex-item-main">
                    <div class="main-side-container">
                        <?php if (isset($posts[2])): ?>
                        <div class="first-article">
                            <a href="<?php echo get_permalink( $posts[2]->ID); ?>">
                                <div class="first-article-container">
                                    <div class="first-article-wrap">
                                        <img class="side-secound-img" src="<?php echo get_the_post_thumbnail_url( $posts[2]->ID, 'large'); ?>" alt="">
                                        <h2 class="side-secound-h2"><?php echo  $posts[2]->post_title; ?></h2>
                                        <!-- <p class="side-secound-p"><?php //echo wp_trim_words((strip_tags( $posts[2]->post_content)), 23, "..."); ?></p> -->
                                        <p class="main-secound-p"><?php echo get_post( $posts[2]->ID)->post_excerpt; ?></p>
                                        <div class="side-foot side-secound-foot">
                                            <span><?php echo the_author_meta('first_name', ( $posts[2]->post_author)); ?> <?php echo the_author_meta('last_name', ( $posts[2]->post_author)); ?></span>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>
                        <?php endif; ?>
                        <?php if (isset($posts[3])): ?>
                        <div class="secound-article">
                            <a href="<?php echo get_permalink( $posts[3]->ID); ?>">
                                <div class="secound-article-container">
                                    <div class="secound-article-wrap">
                                        <img class="side-secound-img" src="<?php echo get_the_post_thumbnail_url( $posts[3]->ID, 'large'); ?>" alt="">
                                        <h2 class="side-secound-h2"><?php echo  $posts[3]->post_title; ?></h2>
                                        <!-- <p class="side-secound-p"><?php // echo wp_trim_words((strip_tags( $posts[3]->post_content)), 23, "..."); ?></p> -->
                                        <p class="side-secound-p"><?php echo get_post( $posts[3]->ID)->post_excerpt; ?></p>
                                        <div class="side-foot side-secound-foot">
                                            <span><?php echo the_author_meta('first_name', ( $posts[3]->post_author)); ?> <?php echo the_author_meta('last_name', ( $posts[3]->post_author)); ?></span>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>
                        <?php endif; ?>
                        <?php if (isset($posts[4])): ?>
                        <div class="third-article">
                            <a href="<?php echo get_permalink( $posts[4]->ID); ?>">
                                <div class="third-article-container">
                                    <div class="third-article-wrap">
                                        <img class="side-secound-img" src="<?php echo get_the_post_thumbnail_url( $posts[4]->ID, 'large'); ?>" alt="">
                                        <h2 class="side-secound-h2"><?php echo  $posts[4]->post_title; ?></h2>
                                        <!-- <p class="side-secound-p"><?php //echo wp_trim_words((strip_tags( $posts[4]->post_content)), 23, "..."); ?></p> -->
                                        <p class="side-secound-p"><?php echo get_post( $posts[4]->ID)->post_excerpt; ?></p>
                                        <div class="side-foot side-secound-foot">
                                            <span><?php echo the_author_meta('first_name', ( $posts[4]->post_author)); ?> <?php echo the_author_meta('last_name', ( $posts[4]->post_author)); ?></span>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>
                        <?php endif; ?>
                    </div>
                </div>
                <?php if (isset($posts[0])): ?>
                <div class="main flex-item-main">
                    <div class="main-container">
                        <div class="first-article">
                            <a href="<?php echo get_permalink( $posts[0]->ID); ?>">
                                <div class="first-article-container">
                                    <div class="first-article-wrap">
                                        <img id="home-main-image" class="main-first-img" src="<?php echo get_the_post_thumbnail_url( $posts[0]->ID, 'large'); ?>" alt="">

                                        <?php //echo get_the_post_thumbnail( $posts[0]->ID, 'main');?>

                                        <h2 class="main-first-h2"><?php echo  $posts[0]->post_title; ?></h2>
                                        <!-- <p class="main-first-p"><?php// echo wp_trim_words((strip_tags( $posts[0]->post_content)), 23, "..."); ?></p> -->
                                        <p class="main-first-p"><?php echo get_post( $posts[0]->ID)->post_excerpt; ?></p>
                                        <div class="main-foot main-first-foot">
                                            <span><?php echo the_author_meta('first_name', ( $posts[0]->post_author)); ?> <?php echo the_author_meta('last_name', ( $posts[0]->post_author)); ?></span>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>
                        <?php if (isset($posts[1])): ?>
                        <div class="secound-article">
                            <a href="<?php echo get_permalink( $posts[1]->ID); ?>">
                                <div class="secound-article-container">
                                    <div class="secound-article-wrap">
                                        <img class="main-secound-img" src="<?php echo get_the_post_thumbnail_url( $posts[1]->ID, 'large'); ?>" alt="">

                                        <?php //echo get_the_post_thumbnail( $posts[1]->ID, 'main');?>
                                        <h2 class="main-secound-h2"><?php echo  $posts[1]->post_title; ?></h2>
                                        <!-- <p class="main-secound-p"><?php //echo wp_trim_words((strip_tags( $posts[1]->post_content)), 23, "..."); ?></p> -->
                                        <p class="main-secound-p"><?php echo get_post( $posts[1]->ID)->post_excerpt; ?></p>
                                        <div class="main-foot main-secound-foot">
                                            <span><?php the_author_meta('first_name', ( $posts[1]->post_author)); ?> <?php echo the_author_meta('last_name', ( $posts[1]->post_author)); ?></span>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>
                        <?php endif; ?>
                    </div>
                </div>
                <?php endif; ?>
            </div>
            <div class="author-bio">
                <div class="author-profile-image">
                    <?php echo get_avatar( get_the_author_meta( 'ID' )); ?>
                </div>
                <div class="author-bio">
                    <h1><?= get_the_author_meta( 'first_name' ) ?> <?= get_the_author_meta( 'last_name' ) ?></h1>
                    <p><?= $curauth->description ?></p>
                    <div class="author-social">
                        <?php if ( $facebook_url ): ?>
                            <a href="<?= $facebook_url ?>" class="facebook" target="_blank">
                                <i class="fa-brands fa-facebook-f"></i>
                            </a>
                        <?php endif; ?>
                        <?php if ( $youtube_url ): ?>
                            <a href="<?= $youtube_url ?>" class="youtube" target="_blank">
                                <i class="fa-brands fa-youtube"></i>
                            </a>
                        <?php endif; ?>
                        <?php if ( $instagram_url ): ?>
                            <a href="<?= $instagram_url ?>" class="instagram" target="_blank">
                                <i class="fa-brands fa-instagram"></i>
                            </a>
                        <?php endif; ?>
                        <?php if ( $spotify_url ): ?>
                            <a href="<?= $spotify_url ?>" class="spotify" target="_blank">
                                <i class="fa-brands fa-spotify"></i>
                            </a>
                        <?php endif; ?>
                        <?php if ( $twitter_url ): ?>
                            <a href="<?= $twitter_url ?>" class="twitter" target="_blank">
                                <i class="fa-brands fa-twitter"></i>
                            </a>
                        <?php endif; ?>
                        <?php if ( $whatsapp_url ): ?>
                            <a href="<?= $whatsapp_url ?>" class="whatsapp" target="_blank">
                                <i class="fa-brands fa-whatsapp"></i>
                            </a>
                        <?php endif; ?>
<!--                        --><?php //if ( $whatsapp_group_url ): ?>
<!--                            <a href="--><?//= $whatsapp_group_url ?><!--" class="facebook" target="_blank">-->
<!--                                <i class="fa-brands fa-square-whatsapp"></i>-->
<!--                            </a>-->
<!--                        --><?php //endif; ?>
                        <?php if ( $website_url ): ?>
                            <a href="<?= $website_url ?>" class="globe" target="_blank">
                                <i class="fa-solid fa-globe"></i>
                            </a>
                        <?php endif; ?>
                        <?php if ( $tiktok_url ): ?>
                            <a href="<?= $tiktok_url ?>" class="tiktok" target="_blank">
                                <i class="fa-brands fa-tiktok"></i>
                            </a>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div><!-- END Section 1 -->

        <?php if (isset($posts[5])): ?>
        <div class="home-line-wrap"><!-- START Divider -->
            <div class="home-line-container">
                <div class="home-line-content">
                    <div class="home-line-right"></div>
                    <div class="home-line-pic">
                        <img src="<?= get_site_icon_url() ?>" />
                    </div>
                    <div class="home-line-left"></div>
                </div>
            </div>
        </div><!-- END Divider -->

        <div class="container-section-2 flex-container-section-2"><!-- START Section 2 -->
            <div class="right-side-section-2 flex-item-section-2">
                <div class="right-side-container-section-2">
                    <div class="right-side-article-section-2">
                        <a href="<?php echo get_permalink( $posts[5]->ID); ?>">
                            <div class="right-side-wrap-section-2">
                                <img class="right-side-img-section-2" src="<?php echo get_the_post_thumbnail_url( $posts[5]->ID, 'large'); ?>" alt="">
                                <h2 class="right-side-h2-section-2"><?php echo  $posts[5]->post_title; ?></h2>
                                <!-- <p class="right-side-p-section-2"><?php //echo wp_trim_words((strip_tags( $posts[5]->post_content)), 23, "..."); ?></p> -->
                                <p class="right-side-p-section-2"><?php echo get_post( $posts[5]->ID)->post_excerpt; ?></p>
                                <div class="right-side-foot-section-2">
                                    <span><?php echo the_author_meta('first_name', ( $posts[5]->post_author)); ?> <?php echo the_author_meta('last_name', ( $posts[5]->post_author)); ?></span>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
            <?php if (isset($posts[6])): ?>
            <div class="center-section-2 flex-item-section-2">
                <div class="center-container-section-2">
                    <div class="center-first-article-section-2">
                        <a href="<?php echo get_permalink( $posts[6]->ID); ?>">
                            <div class="center-article-container-section-2">
                                <div class="center-article-wrap-section-2">
                                    <img class="center-article-img-section-2" src="<?php echo get_the_post_thumbnail_url( $posts[6]->ID, 'large'); ?>" alt="">
                                    <h2 class="center-article-h2-section-2"><?php echo  $posts[6]->post_title; ?></h2>
                                    <span><?php echo the_author_meta('first_name', ( $posts[6]->post_author)); ?> <?php echo the_author_meta('last_name', ( $posts[6]->post_author)); ?></span>
                                </div>
                            </div>
                        </a>
                    </div>
                    <?php if (isset($posts[7])): ?>
                    <div class="center-secound-article-section-2">
                        <a href="<?php echo get_permalink( $posts[7]->ID); ?>">
                            <div class="center-article-container-section-2">
                                <div class="center-article-wrap-section-2">
                                    <img class="center-article-img-section-2" src="<?php echo get_the_post_thumbnail_url( $posts[7]->ID, 'large'); ?>" alt="">
                                    <h2 class="center-article-h2-section-2"><?php echo  $posts[7]->post_title; ?></h2>
                                    <span><?php echo the_author_meta('first_name', ( $posts[7]->post_author)); ?> <?php echo the_author_meta('last_name', ( $posts[7]->post_author)); ?></span>
                                </div>
                            </div>
                        </a>
                    </div>
                    <?php endif; ?>
                </div>
            </div>
            <?php endif; ?>
            <?php if (isset($posts[8])): ?>
            <div class="left-side-section-2 flex-item-section-2">
                <div class="left-side-container-section-2">
                    <div class="left-side-first-article-section-2">
                        <a href="<?php echo get_permalink( $posts[8]->ID); ?>">
                            <div class="left-side-first-article-container-section-2">
                                <div class="left-side-article-wrap-section-2">
                                    <div class="left-side-pic-article-section-2">
                                        <img class="left-side-article-img-section-2" src="<?php echo get_the_post_thumbnail_url( $posts[8]->ID, 'thumbnails'); ?>" alt="">
                                    </div>
                                    <div class="left-side-text-article-section-2">
                                        <h2 class="left-side-article-h2-section-2"><?php echo  $posts[8]->post_title; ?></h2>
                                        <div class="left-side-article-foot-section-2">
                                            <span><?php echo the_author_meta('first_name', ( $posts[8]->post_author)); ?> <?php echo the_author_meta('last_name', ( $posts[8]->post_author)); ?></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                    <?php if (isset($posts[9])): ?>
                    <div class="dedivider"></div>
                    <div class="left-side-secound-article-section-2">
                        <a href="<?php echo get_permalink( $posts[9]->ID); ?>">
                            <div class="left-side-secound-article-container-section-2">
                                <div class="left-side-article-wrap-section-2">
                                    <div class="left-side-pic-article-section-2">
                                        <img class="left-side-article-img-section-2" src="<?php echo get_the_post_thumbnail_url( $posts[9]->ID, 'thumbnails'); ?>" alt="">
                                    </div>
                                    <div class="left-side-text-article-section-2">
                                        <h2 class="left-side-article-h2-section-2"><?php echo  $posts[9]->post_title; ?></h2>
                                        <div class="left-side-article-foot-section-2">
                                            <span><?php echo the_author_meta('first_name', ( $posts[9]->post_author)); ?> <?php echo the_author_meta('last_name', ( $posts[9]->post_author)); ?></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                    <?php endif; ?>
                    <?php if (isset($posts[10])): ?>
                    <div class="dedivider"></div>
                    <div class="left-side-third-article-section-2">
                        <a href="<?php echo get_permalink( $posts[10]->ID); ?>">
                            <div class="left-side-third-article-container-section-2">
                                <div class="left-side-article-wrap-section-2">
                                    <div class="left-side-pic-article-section-2">
                                        <img class="left-side-article-img-section-2" src="<?php echo get_the_post_thumbnail_url( $posts[10]->ID, 'thumbnails'); ?>" alt="">
                                    </div>
                                    <div class="left-side-text-article-section-2">
                                        <h2 class="left-side-article-h2-section-2"><?php echo  $posts[10]->post_title; ?></h2>
                                        <div class="left-side-article-foot-section-2">
                                            <span><?php echo the_author_meta('first_name', ( $posts[10]->post_author)); ?> <?php echo the_author_meta('last_name', ( $posts[10]->post_author)); ?></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                    <?php endif; ?>
                    <?php if (isset($posts[11])): ?>
                    <div class="dedivider"></div>
                    <div class="left-side-fourth-article-section-2">
                        <a href="<?php echo get_permalink( $posts[11]->ID); ?>">
                            <div class="left-side-fourth-article-container-section-2">
                                <div class="left-side-article-wrap-section-2">
                                    <div class="left-side-pic-article-section-2">
                                        <img class="left-side-article-img-section-2" src="<?php echo get_the_post_thumbnail_url( $posts[11]->ID, 'thumbnails'); ?>" alt="">
                                    </div>
                                    <div class="left-side-text-article-section-2">
                                        <h2 class="left-side-article-h2-section-2"><?php echo  $posts[11]->post_title; ?></h2>
                                        <div class="left-side-article-foot-section-2">
                                            <span><?php echo the_author_meta('first_name', ( $posts[11]->post_author)); ?> <?php echo the_author_meta('last_name', ( $posts[11]->post_author)); ?></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                    <?php endif; ?>
                    <?php if (isset($posts[12])): ?>
                    <div class="dedivider"></div>
                    <div class="left-side-fifth-article-section-2">
                        <a href="<?php echo get_permalink( $posts[12]->ID); ?>">
                            <div class="left-side-fifth-article-container-section-2">
                                <div class="left-side-article-wrap-section-2">
                                    <div class="left-side-pic-article-section-2">
                                        <img class="left-side-article-img-section-2" src="<?php echo get_the_post_thumbnail_url( $posts[12]->ID, 'thumbnails'); ?>" alt="">
                                    </div>
                                    <div class="left-side-text-article-section-2">
                                        <h2 class="left-side-article-h2-section-2"><?php echo  $posts[12]->post_title; ?></h2>
                                        <div class="left-side-article-foot-section-2">
                                            <span><?php echo the_author_meta('first_name', ( $posts[12]->post_author)); ?> <?php echo the_author_meta('last_name', ( $posts[12]->post_author)); ?></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                    <?php endif; ?>
                    <?php if (isset($posts[13])): ?>
                    <div class="dedivider"></div>
                    <div class="left-side-six-article-section-2">
                        <a href="<?php echo get_permalink( $posts[13]->ID); ?>">
                            <div class="left-side-six-article-container-section-2">
                                <div class="left-side-article-wrap-section-2">
                                    <div class="left-side-pic-article-section-2">
                                        <img class="left-side-article-img-section-2" src="<?php echo get_the_post_thumbnail_url( $posts[13]->ID, 'thumbnails'); ?>" alt="">
                                    </div>
                                    <div class="left-side-text-article-section-2">
                                        <h2 class="left-side-article-h2-section-2"><?php echo  $posts[13]->post_title; ?></h2>
                                        <div class="left-side-article-foot-section-2">
                                            <span><?php echo the_author_meta('first_name', ( $posts[13]->post_author)); ?> <?php echo the_author_meta('last_name', ( $posts[13]->post_author)); ?></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                    <?php endif; ?>
                </div>
            </div>
            <?php endif; ?>
        </div><!-- END Section 2 -->
        <?php endif; ?>

        <?php if (isset($posts[14])): ?>
        <div class="home-line-wrap"><!-- START Wrap -->
            <div class="home-line-container">
                <div class="home-line-content">
                    <div class="home-line-right"></div>
                    <div class="home-line-pic">
                        <img src="<?= get_site_icon_url() ?>" />
                    </div>
                    <div class="home-line-left"></div>
                </div>
            </div>
        </div><!-- END Divider -->

        <div class="container-section-3 flex-container-section-3">
            <div id="section-3-right">
                <a href="<?php echo get_permalink( $posts[14]->ID); ?>">
                    <div class="section-3-big-post">
                        <img src="<?php echo get_the_post_thumbnail_url( $posts[14]->ID, 'large'); ?>" alt="">
                        <div class="textuals">
                            <h3 class="section-3-big-post-title"><?php echo  $posts[14]->post_title; ?></h3>
                            <div class="section-3-big-post-author"><?php echo the_author_meta('first_name', ( $posts[14]->post_author)); ?> <?php echo the_author_meta('last_name', ( $posts[14]->post_author)); ?></div>
                        </div>
                    </div>
                </a>

                <?php if (isset($posts[16])): ?>
                <div class="section-3-small-articles-wrap">
                    <a href="<?php echo get_permalink( $posts[16]->ID); ?>">
                        <div class="section-3-small-article">
                            <img src="<?php echo get_the_post_thumbnail_url( $posts[16]->ID, 'large'); ?>" alt="">
                            <div class="textuals">
                                <h3 class="section-3-small-post-title"><?php echo  $posts[16]->post_title; ?></h3>
                                <div class="section-3-small-post-author"><?php echo the_author_meta('first_name', ( $posts[16]->post_author)); ?> <?php echo the_author_meta('last_name', ( $posts[16]->post_author)); ?></div>
                            </div>
                        </div>
                    </a>

                    <?php if (isset($posts[17])): ?>
                    <a href="<?php echo get_permalink( $posts[17]->ID); ?>">
                        <div class="section-3-small-article">
                            <img src="<?php echo get_the_post_thumbnail_url( $posts[17]->ID, 'large'); ?>" alt="">
                            <div class="textuals">
                                <h3 class="section-3-small-post-title"><?php echo  $posts[17]->post_title; ?></h3>
                                <div class="section-3-small-post-author"><?php echo the_author_meta('first_name', ( $posts[17]->post_author)); ?> <?php echo the_author_meta('last_name', ( $posts[17]->post_author)); ?></div>
                            </div>
                        </div>
                    </a>
                    <?php endif; ?>
                </div>
                <?php endif; ?>
            </div>

            <?php if (isset($posts[15])): ?>
            <div id="section-3-left">
                <a href="<?php echo get_permalink( $posts[15]->ID); ?>">
                    <div class="section-3-big-post">
                        <img src="<?php echo get_the_post_thumbnail_url( $posts[15]->ID, 'large'); ?>" alt="">
                        <div class="textuals">
                            <h3 class="section-3-big-post-title"><?php echo  $posts[15]->post_title; ?></h3>
                            <div class="section-3-big-post-author"><?php echo the_author_meta('first_name', ( $posts[15]->post_author)); ?> <?php echo the_author_meta('last_name', ( $posts[15]->post_author)); ?></div>
                        </div>
                    </div>
                </a>

                <?php if (isset($posts[18])): ?>
                <div class="section-3-small-articles-wrap">
                    <a href="<?php echo get_permalink( $posts[18]->ID); ?>">
                        <div class="section-3-small-article">
                            <img src="<?php echo get_the_post_thumbnail_url( $posts[18]->ID, 'large'); ?>" alt="">
                            <div class="textuals">
                                <h3 class="section-3-small-post-title"><?php echo  $posts[18]->post_title; ?></h3>
                                <div class="section-3-small-post-author"><?php echo the_author_meta('first_name', ( $posts[18]->post_author)); ?> <?php echo the_author_meta('last_name', ( $posts[18]->post_author)); ?></div>
                            </div>
                        </div>
                    </a>

                    <?php if (isset($posts[19])): ?>
                    <a href="<?php echo get_permalink( $posts[19]->ID); ?>">
                        <div class="section-3-small-article">
                            <img src="<?php echo get_the_post_thumbnail_url( $posts[19]->ID, 'large'); ?>" alt="">
                            <div class="textuals">
                                <h3 class="section-3-small-post-title"><?php echo  $posts[19]->post_title; ?></h3>
                                <div class="section-3-small-post-author"><?php echo the_author_meta('first_name', ( $posts[19]->post_author)); ?> <?php echo the_author_meta('last_name', ( $posts[19]->post_author)); ?></div>
                            </div>
                        </div>
                    </a>
                    <?php endif; ?>
                </div>
            <?php endif; ?>
            </div>
            <?php endif; ?>
        </div>
        <?php endif; ?>

        <?php if (isset($posts[20])): ?>
        <div class="home-line-wrap"><!-- START Wrap -->
            <div class="home-line-container">
                <div class="home-line-content">
                    <div class="home-line-right"></div>
                    <div class="home-line-pic">
                        <img src="<?= get_site_icon_url() ?>" />
                    </div>
                    <div class="home-line-left"></div>
                </div>
            </div>
        </div><!-- END Divider -->

        <div class="container-section-2 flex-container-section-2 section-4-wrap"><!-- START Section 4 -->
            <div class="center-section-2 flex-item-section-2">
                <div class="center-container-section-2">
                    <div class="center-first-article-section-2">
                        <a href="<?php echo get_permalink( $posts[20]->ID); ?>">
                            <div class="center-article-container-section-2">
                                <div class="center-article-wrap-section-2">
                                    <img class="center-article-img-section-2" src="<?php echo get_the_post_thumbnail_url( $posts[20]->ID, 'large'); ?>" alt="">
                                    <h2 class="center-article-h2-section-2"><?php echo  $posts[20]->post_title; ?></h2>
                                    <span><?php echo the_author_meta('first_name', ( $posts[20]->post_author)); ?> <?php echo the_author_meta('last_name', ( $posts[20]->post_author)); ?></span>
                                </div>
                            </div>
                        </a>
                    </div>

                    <?php if (isset($posts[21])): ?>
                    <div class="center-secound-article-section-2">
                        <a href="<?php echo get_permalink( $posts[21]->ID); ?>">
                            <div class="center-article-container-section-2">
                                <div class="center-article-wrap-section-2">
                                    <img class="center-article-img-section-2" src="<?php echo get_the_post_thumbnail_url( $posts[21]->ID, 'large'); ?>" alt="">
                                    <h2 class="center-article-h2-section-2"><?php echo  $posts[21]->post_title; ?></h2>
                                    <span><?php echo the_author_meta('first_name', ( $posts[21]->post_author)); ?> <?php echo the_author_meta('last_name', ( $posts[21]->post_author)); ?></span>
                                </div>
                            </div>
                        </a>
                    </div>
                    <?php endif; ?>
                </div>
            </div>

            <?php if (isset($posts[22])): ?>
            <div class="right-side-section-2 flex-item-section-2">
                <div class="right-side-container-section-2">
                    <div class="right-side-article-section-2">
                        <a href="<?php echo get_permalink( $posts[22]->ID); ?>">
                            <div class="right-side-wrap-section-2">
                                <img class="right-side-img-section-2" src="<?php echo get_the_post_thumbnail_url( $posts[22]->ID, 'large'); ?>" alt="">
                                <h2 class="right-side-h2-section-2"><?php echo  $posts[22]->post_title; ?></h2>
                                <!-- <p class="right-side-p-section-2"><?php //echo wp_trim_words((strip_tags( $posts[22]->post_content)), 23, "..."); ?></p> -->
                                <p class="right-side-p-section-2"><?php echo get_post( $posts[22]->ID)->post_excerpt; ?></p>
                                <div class="right-side-foot-section-2">
                                    <span><?php echo the_author_meta('first_name', ( $posts[22]->post_author)); ?> <?php echo the_author_meta('last_name', ( $posts[22]->post_author)); ?></span>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
            <?php endif; ?>

            <?php if (isset($posts[23])): ?>
            <div class="left-side-section-2 flex-item-section-2">
                <div class="left-side-container-section-2">
                    <div class="left-side-first-article-section-2">
                        <a href="<?php echo get_permalink( $posts[23]->ID); ?>">
                            <div class="left-side-first-article-container-section-2">
                                <div class="left-side-article-wrap-section-2">
                                    <div class="left-side-pic-article-section-2">
                                        <img class="left-side-article-img-section-2" src="<?php echo get_the_post_thumbnail_url( $posts[23]->ID, 'thumbnails'); ?>" alt="">
                                    </div>
                                    <div class="left-side-text-article-section-2">
                                        <h2 class="left-side-article-h2-section-2"><?php echo  $posts[23]->post_title; ?></h2>
                                        <div class="left-side-article-foot-section-2">
                                            <span><?php echo the_author_meta('first_name', ( $posts[23]->post_author)); ?> <?php echo the_author_meta('last_name', ( $posts[23]->post_author)); ?></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>

                    <?php if (isset($posts[24])): ?>
                    <div class="dedivider"></div>
                    <div class="left-side-secound-article-section-2">
                        <?php echo  $posts[24]->ID; ?>
                        <a href="<?php echo get_permalink( $posts[24]->ID); ?>">
                            <div class="left-side-secound-article-container-section-2">
                                <div class="left-side-article-wrap-section-2">
                                    <div class="left-side-pic-article-section-2">
                                        <img class="left-side-article-img-section-2" src="<?php echo get_the_post_thumbnail_url( $posts[24]->ID, 'thumbnails'); ?>" alt="">
                                    </div>
                                    <div class="left-side-text-article-section-2">
                                        <h2 class="left-side-article-h2-section-2"><?php echo  $posts[24]->post_title; ?></h2>
                                        <div class="left-side-article-foot-section-2">
                                            <span><?php echo the_author_meta('first_name', ( $posts[24]->post_author)); ?> <?php echo the_author_meta('last_name', ( $posts[24]->post_author)); ?></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                    <?php endif; ?>

                    <?php if (isset($posts[25])): ?>
                    <div class="dedivider"></div>
                    <div class="left-side-third-article-section-2">
                        <a href="<?php echo get_permalink( $posts[25]->ID); ?>">
                            <div class="left-side-third-article-container-section-2">
                                <div class="left-side-article-wrap-section-2">
                                    <div class="left-side-pic-article-section-2">
                                        <img class="left-side-article-img-section-2" src="<?php echo get_the_post_thumbnail_url( $posts[25]->ID, 'thumbnails'); ?>" alt="">
                                    </div>
                                    <div class="left-side-text-article-section-2">
                                        <h2 class="left-side-article-h2-section-2"><?php echo  $posts[25]->post_title; ?></h2>
                                        <div class="left-side-article-foot-section-2">
                                            <span><?php echo the_author_meta('first_name', ( $posts[25]->post_author)); ?> <?php echo the_author_meta('last_name', ( $posts[25]->post_author)); ?></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                    <?php endif; ?>

                    <?php if (isset($posts[26])): ?>
                    <div class="dedivider"></div>
                    <div class="left-side-fourth-article-section-2">
                        <a href="<?php echo get_permalink( $posts[26]->ID); ?>">
                            <div class="left-side-fourth-article-container-section-2">
                                <div class="left-side-article-wrap-section-2">
                                    <div class="left-side-pic-article-section-2">
                                        <img class="left-side-article-img-section-2" src="<?php echo get_the_post_thumbnail_url( $posts[26]->ID, 'thumbnails'); ?>" alt="">
                                    </div>
                                    <div class="left-side-text-article-section-2">
                                        <h2 class="left-side-article-h2-section-2"><?php echo  $posts[26]->post_title; ?></h2>
                                        <div class="left-side-article-foot-section-2">
                                            <span><?php echo the_author_meta('first_name', ( $posts[26]->post_author)); ?> <?php echo the_author_meta('last_name', ( $posts[26]->post_author)); ?></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                    <?php endif; ?>

                    <?php if (isset($posts[27])): ?>
                    <div class="dedivider"></div>
                    <div class="left-side-fifth-article-section-2">
                        <a href="<?php echo get_permalink( $posts[27]->ID); ?>">
                            <div class="left-side-fifth-article-container-section-2">
                                <div class="left-side-article-wrap-section-2">
                                    <div class="left-side-pic-article-section-2">
                                        <img class="left-side-article-img-section-2" src="<?php echo get_the_post_thumbnail_url( $posts[27]->ID, 'thumbnails'); ?>" alt="">
                                    </div>
                                    <div class="left-side-text-article-section-2">
                                        <h2 class="left-side-article-h2-section-2"><?php echo  $posts[27]->post_title; ?></h2>
                                        <div class="left-side-article-foot-section-2">
                                            <span><?php echo the_author_meta('first_name', ( $posts[27]->post_author)); ?> <?php echo the_author_meta('last_name', ( $posts[27]->post_author)); ?></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                    <?php endif; ?>

                    <?php if (isset($posts[28])): ?>
                    <div class="dedivider"></div>
                    <div class="left-side-six-article-section-2">
                        <a href="<?php echo get_permalink( $posts[28]->ID); ?>">
                            <div class="left-side-six-article-container-section-2">
                                <div class="left-side-article-wrap-section-2">
                                    <div class="left-side-pic-article-section-2">
                                        <img class="left-side-article-img-section-2" src="<?php echo get_the_post_thumbnail_url( $posts[28]->ID, 'thumbnails'); ?>" alt="">
                                    </div>
                                    <div class="left-side-text-article-section-2">
                                        <h2 class="left-side-article-h2-section-2"><?php echo  $posts[28]->post_title; ?></h2>
                                        <div class="left-side-article-foot-section-2">
                                            <span><?php echo the_author_meta('first_name', ( $posts[28]->post_author)); ?> <?php echo the_author_meta('last_name', ( $posts[28]->post_author)); ?></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                    <?php endif; ?>
                </div>
            </div>
            <?php endif; ?>
        </div>
        <?php endif; ?>

        <?php if (isset($posts[29])): ?>
        <div class="home-line-wrap"><!-- START Wrap -->
            <div class="home-line-container">
                <div class="home-line-content">
                    <div class="home-line-right"></div>
                    <div class="home-line-pic">
                        <img src="<?= get_site_icon_url() ?>" />
                    </div>
                    <div class="home-line-left"></div>
                </div>
            </div>
        </div><!-- END Divider -->

        <div class="section-5-wrap">
            <div id="section-5-content">
                <div id="section-5-right">
                    <div id="section-5-posts">
                        <?php for ($i = 0; $i < 10; $i++) : ?>
                            <?php if (!isset($posts[29 + $i])): ?>
                                <?php continue; ?>
                            <?php endif; ?>
                            <a href="<?php echo get_permalink( $posts[29 + $i]->ID); ?>">
                                <div class="section-5-post">
                                    <div class="section-5-post-right">
                                        <img src="<?php echo get_the_post_thumbnail_url( $posts[29 + $i]->ID, 'large'); ?>" alt="">
                                    </div>

                                    <div class="section-5-post-left">
                                        <h2 class="section-5-left-h2"><?php echo  $posts[29 + $i]->post_title; ?></h2>
                                        <!-- <p class="section-5-left-p"><?php //echo wp_trim_words((strip_tags( $posts[28 + $i]->post_content)), 23, "..."); ?></p> -->
                                        <p class="section-5-left-p"><?php echo get_post( $posts[29 + $i]->ID)->post_excerpt; ?></p>
                                        <div class="section-5-left-foot">
                                            <span><?php echo the_author_meta('first_name', ( $posts[29 + $i]->post_author)); ?> <?php echo the_author_meta('last_name', ( $posts[29 + $i]->post_author)); ?></span>
                                        </div>
                                    </div>
                                </div>
                            </a>

                            <?php if ($i != 9) echo '<hr/>';  ?>
                        <?php endfor; ?>
                    </div>
                </div>

                <div id="section-5-left">

                </div>
            </div>
        </div>
        <?php endif; ?>

    </div><!-- END Wrap -->

<?php

get_footer();