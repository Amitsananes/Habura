<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

get_header();


/* 	if(false === ($results_by_rating = get_transient("results_by_rating"))){ */
		$results_by_rating = home_page_by_rating();
/* 		set_transient( "results_by_rating", $results_by_rating, 300 );
	} */




	//$results_by_rating = home_page_by_rating();
	// print_r($results_by_rating);
?>

<div class="wrapper"><!-- START Wrap -->
    <div class="container flex-container-master"><!-- START Section 1 -->
        <div class="master-main-container flex-item-master flex-container-main">
            <div class="main flex-item-main">
                <div class="main-container">
                    <div class="first-article">
                        <a href="<?php echo get_permalink($results_by_rating[0]->post_id); ?>">
							<div class="first-article-container">
								<div class="first-article-wrap">
									<img id="home-main-image" class="main-first-img" src="<?php echo get_the_post_thumbnail_url($results_by_rating[0]->post_id, 'large'); ?>" alt="">

									<?php //echo get_the_post_thumbnail($results_by_rating[0]->post_id, 'main');?> 

									<h2 class="main-first-h2"><?php echo $results_by_rating[0]->post_title; ?></h2>
									<!-- <p class="main-first-p"><?php// echo wp_trim_words((strip_tags($results_by_rating[0]->post_content)), 23, "..."); ?></p> -->
									<p class="main-first-p"><?php echo get_post($results_by_rating[0]->post_id)->post_excerpt; ?></p>
									<div class="main-foot main-first-foot">
									<span><?php echo the_author_meta('first_name', ($results_by_rating[0]->post_author)); ?> <?php echo the_author_meta('last_name', ($results_by_rating[0]->post_author)); ?></span>
									</div>
								</div>
							</div>
						</a>
                    </div>
                    <div class="secound-article">
                        <a href="<?php echo get_permalink($results_by_rating[1]->post_id); ?>">
							<div class="secound-article-container">
								<div class="secound-article-wrap">
									<img class="main-secound-img" src="<?php echo get_the_post_thumbnail_url($results_by_rating[1]->post_id, 'large'); ?>" alt="">

									<?php //echo get_the_post_thumbnail($results_by_rating[1]->post_id, 'main');?> 
									<h2 class="main-secound-h2"><?php echo $results_by_rating[1]->post_title; ?></h2>
									<!-- <p class="main-secound-p"><?php //echo wp_trim_words((strip_tags($results_by_rating[1]->post_content)), 23, "..."); ?></p> -->
									<p class="main-secound-p"><?php echo get_post($results_by_rating[1]->post_id)->post_excerpt; ?></p>
									<div class="main-foot main-secound-foot">
										<span><?php the_author_meta('first_name', ($results_by_rating[1]->post_author)); ?> <?php echo the_author_meta('last_name', ($results_by_rating[1]->post_author)); ?></span>
									</div>
								</div>
							</div>
						</a>
                    </div>
                </div>
            </div>
            <div class="main-side flex-item-main">
                <div class="main-side-container">
                    <div class="first-article">
                        <a href="<?php echo get_permalink($results_by_rating[2]->post_id); ?>">
							<div class="first-article-container">
								<div class="first-article-wrap">
									<img class="side-secound-img" src="<?php echo get_the_post_thumbnail_url($results_by_rating[2]->post_id, 'large'); ?>" alt="">
									<h2 class="side-secound-h2"><?php echo $results_by_rating[2]->post_title; ?></h2>
									<!-- <p class="side-secound-p"><?php //echo wp_trim_words((strip_tags($results_by_rating[2]->post_content)), 23, "..."); ?></p> -->
									<p class="main-secound-p"><?php echo get_post($results_by_rating[2]->post_id)->post_excerpt; ?></p>
									<div class="side-foot side-secound-foot">
										<span><?php echo the_author_meta('first_name', ($results_by_rating[2]->post_author)); ?> <?php echo the_author_meta('last_name', ($results_by_rating[2]->post_author)); ?></span>
									</div>
								</div>
							</div>
						</a>
                    </div>
                    <div class="secound-article">
                        <a href="<?php echo get_permalink($results_by_rating[3]->post_id); ?>">
							<div class="secound-article-container">
								<div class="secound-article-wrap">
									<img class="side-secound-img" src="<?php echo get_the_post_thumbnail_url($results_by_rating[3]->post_id, 'large'); ?>" alt="">
									<h2 class="side-secound-h2"><?php echo $results_by_rating[3]->post_title; ?></h2>
									<!-- <p class="side-secound-p"><?php // echo wp_trim_words((strip_tags($results_by_rating[3]->post_content)), 23, "..."); ?></p> -->
									<p class="side-secound-p"><?php echo get_post($results_by_rating[3]->post_id)->post_excerpt; ?></p>
									<div class="side-foot side-secound-foot">
									<span><?php echo the_author_meta('first_name', ($results_by_rating[3]->post_author)); ?> <?php echo the_author_meta('last_name', ($results_by_rating[3]->post_author)); ?></span>
									</div>
								</div>
							</div>
						</a>
                    </div>
                    <div class="third-article">
                        <a href="<?php echo get_permalink($results_by_rating[4]->post_id); ?>">
							<div class="third-article-container">
								<div class="third-article-wrap">
									<img class="side-secound-img" src="<?php echo get_the_post_thumbnail_url($results_by_rating[4]->post_id, 'large'); ?>" alt="">
									<h2 class="side-secound-h2"><?php echo $results_by_rating[4]->post_title; ?></h2>
									<!-- <p class="side-secound-p"><?php //echo wp_trim_words((strip_tags($results_by_rating[4]->post_content)), 23, "..."); ?></p> -->
									<p class="side-secound-p"><?php echo get_post($results_by_rating[4]->post_id)->post_excerpt; ?></p>
									<div class="side-foot side-secound-foot">
									<span><?php echo the_author_meta('first_name', ($results_by_rating[4]->post_author)); ?> <?php echo the_author_meta('last_name', ($results_by_rating[4]->post_author)); ?></span>
									</div>
								</div>
							</div>
						</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="mivzakim flex-item-master flex-container-mivzakim">
            <div class="mivzakim-wrap">
                <div class="mivzakim-header">
                    <h2 class="mivzakim-header-h2" style ="font-family: 'Heebo';"><i class="fa fa-comment" style="font-size:20px;color:#fff"></i>&nbsp;מבזקים</h2>
                </div>

				<?php
					$args = array(  
						'post_type' => 'flash_news',
						'post_status' => 'publish',
						'posts_per_page' => 6, 
						'orderby' => 'post_date', 
						'order' => 'DESC', 
					);
				
					$loop = new WP_Query( $args ); 
						
					while ( $loop->have_posts() ) : $loop->the_post(); ?>
						<?php $avatar = get_field('profile_pic', 'user_' . get_the_author_ID()); ?>
						<div class="mivzakim-content">
							<div class="mivzakim-content-wrap">
								<?php //if ($avatar) : ?>
								<!-- <a href="<?php // get_author_posts_url( get_the_author_meta( 'ID' ) ); ?>">
									<img src="<?php //echo $avatar['url']; ?>" alt="שמוליק מושקוביץ">
								<?php //else : ?>
									<img src="https://secure.gravatar.com/avatar/aa2f6055b35acdd39df05b70833213cb?s=300&amp;d=mm&amp;r=g" alt="שמוליק מושקוביץ">
								<?php //endif; ?>
								<span class="mivzakim-content-header"><?php //echo get_author_name(); ?></span></a> -->
								<p class="mivzakim-content-p">
									<?php print the_title(); ?>
								</p>
								<!-- <span class="mivzakim-content-time"><?php //echo date('H:i', get_post_time()); ?></span> -->
								<a href="https://forms.monday.com/forms/84511f635b4eb08fe6c28a8d5b3ad033?r=use1"><i aria-hidden="true" class="far fa-flag"></i></a>
							</div>
						</div>
						
					<?php
					// print_r(get_the_post());
					// the_excerpt(); 
					// $post_meta = get_post_meta( get_the_ID(), 'flash_news_meta', true );

					// print_r($post_meta);
					endwhile; ?>
				<div class="mivzakim-button-wrap">
					<div class="mivzakim-button-content">
						<a href="https://wordpress-668856-3151571.cloudwaysapps.com/allflashnews/" class="mivzakim-button">
						<span class="mivzakim-button-text">לכל המבזקים</span>
					</a>
					</div>
				</div>
            </div>
        </div>
    </div><!-- END Section 1 -->
	
	<div class="home-line-wrap"><!-- START Divider -->
		<div class="home-line-container">
			<div class="home-line-content">
				<div class="home-line-right"></div>
				<div class="home-line-pic"><img src="https://wordpress-668856-3151571.cloudwaysapps.com/wp-content/uploads/2021/10/cropped-cropped-cropped-cropped-אייקון-512-512P-180x180.png" /></div>
				<div class="home-line-left"></div>
			</div>
		</div>
	</div><!-- END Divider -->

	<div class="container-section-2 flex-container-section-2"><!-- START Section 2 -->
		<div class="right-side-section-2 flex-item-section-2">
			<div class="right-side-container-section-2">
				<div class="right-side-article-section-2">
					<a href="<?php echo get_permalink($results_by_rating[5]->post_id); ?>">
						<div class="right-side-wrap-section-2">
							<img class="right-side-img-section-2" src="<?php echo get_the_post_thumbnail_url($results_by_rating[5]->post_id, 'large'); ?>" alt="">
							<h2 class="right-side-h2-section-2"><?php echo $results_by_rating[5]->post_title; ?></h2>
							<!-- <p class="right-side-p-section-2"><?php //echo wp_trim_words((strip_tags($results_by_rating[5]->post_content)), 23, "..."); ?></p> -->
							<p class="right-side-p-section-2"><?php echo get_post($results_by_rating[5]->post_id)->post_excerpt; ?></p>
							<div class="right-side-foot-section-2">
							<span><?php echo the_author_meta('first_name', ($results_by_rating[5]->post_author)); ?> <?php echo the_author_meta('last_name', ($results_by_rating[5]->post_author)); ?></span>
							</div>
						</div>
					</a>
				</div>
			</div>
		</div>
		<div class="center-section-2 flex-item-section-2">
			<div class="center-container-section-2">
				<div class="center-first-article-section-2">
					<a href="<?php echo get_permalink($results_by_rating[6]->post_id); ?>">
						<div class="center-article-container-section-2">
							<div class="center-article-wrap-section-2">
								<img class="center-article-img-section-2" src="<?php echo get_the_post_thumbnail_url($results_by_rating[6]->post_id, 'large'); ?>" alt="">
								<h2 class="center-article-h2-section-2"><?php echo $results_by_rating[6]->post_title; ?></h2>
								<span><?php echo the_author_meta('first_name', ($results_by_rating[6]->post_author)); ?> <?php echo the_author_meta('last_name', ($results_by_rating[6]->post_author)); ?></span>
							</div>
						</div>
					</a>
				</div>
				<div class="center-secound-article-section-2">
					<a href="<?php echo get_permalink($results_by_rating[7]->post_id); ?>">
						<div class="center-article-container-section-2">
							<div class="center-article-wrap-section-2">
								<img class="center-article-img-section-2" src="<?php echo get_the_post_thumbnail_url($results_by_rating[7]->post_id, 'large'); ?>" alt="">
								<h2 class="center-article-h2-section-2"><?php echo $results_by_rating[7]->post_title; ?></h2>
								<span><?php echo the_author_meta('first_name', ($results_by_rating[7]->post_author)); ?> <?php echo the_author_meta('last_name', ($results_by_rating[7]->post_author)); ?></span>
							</div>
						</div>
					</a>
				</div>
			</div>
		</div>
		<div class="left-side-section-2 flex-item-section-2">
			<div class="left-side-container-section-2">
				<div class="left-side-first-article-section-2">
					<a href="<?php echo get_permalink($results_by_rating[8]->post_id); ?>">
						<div class="left-side-first-article-container-section-2">
							<div class="left-side-article-wrap-section-2">
								<div class="left-side-pic-article-section-2">
									<img class="left-side-article-img-section-2" src="<?php echo get_the_post_thumbnail_url($results_by_rating[8]->post_id, 'thumbnails'); ?>" alt="">
								</div>
								<div class="left-side-text-article-section-2">
									<h2 class="left-side-article-h2-section-2"><?php echo $results_by_rating[8]->post_title; ?></h2>
									<div class="left-side-article-foot-section-2">
									<span><?php echo the_author_meta('first_name', ($results_by_rating[8]->post_author)); ?> <?php echo the_author_meta('last_name', ($results_by_rating[8]->post_author)); ?></span>
									</div>
								</div>
							</div>
						</div>
					</a>
				</div>
				<div class="dedivider"></div>
				<div class="left-side-secound-article-section-2">
					<a href="<?php echo get_permalink($results_by_rating[9]->post_id); ?>">
						<div class="left-side-secound-article-container-section-2">
							<div class="left-side-article-wrap-section-2">
								<div class="left-side-pic-article-section-2">
									<img class="left-side-article-img-section-2" src="<?php echo get_the_post_thumbnail_url($results_by_rating[9]->post_id, 'thumbnails'); ?>" alt="">
								</div>
								<div class="left-side-text-article-section-2">
									<h2 class="left-side-article-h2-section-2"><?php echo $results_by_rating[9]->post_title; ?></h2>
									<div class="left-side-article-foot-section-2">
									<span><?php echo the_author_meta('first_name', ($results_by_rating[9]->post_author)); ?> <?php echo the_author_meta('last_name', ($results_by_rating[9]->post_author)); ?></span>
									</div>
								</div>
							</div>
						</div>
					</a>
				</div>
				<div class="dedivider"></div>
				<div class="left-side-third-article-section-2">
					<a href="<?php echo get_permalink($results_by_rating[10]->post_id); ?>">
						<div class="left-side-third-article-container-section-2">
							<div class="left-side-article-wrap-section-2">
								<div class="left-side-pic-article-section-2">
									<img class="left-side-article-img-section-2" src="<?php echo get_the_post_thumbnail_url($results_by_rating[10]->post_id, 'thumbnails'); ?>" alt="">
								</div>
								<div class="left-side-text-article-section-2">
									<h2 class="left-side-article-h2-section-2"><?php echo $results_by_rating[10]->post_title; ?></h2>
									<div class="left-side-article-foot-section-2">
									<span><?php echo the_author_meta('first_name', ($results_by_rating[10]->post_author)); ?> <?php echo the_author_meta('last_name', ($results_by_rating[10]->post_author)); ?></span>
									</div>
								</div>
							</div>
						</div>
					</a>
				</div>
				<div class="dedivider"></div>
				<div class="left-side-fourth-article-section-2">
					<a href="<?php echo get_permalink($results_by_rating[11]->post_id); ?>">
						<div class="left-side-fourth-article-container-section-2">
							<div class="left-side-article-wrap-section-2">
								<div class="left-side-pic-article-section-2">
									<img class="left-side-article-img-section-2" src="<?php echo get_the_post_thumbnail_url($results_by_rating[11]->post_id, 'thumbnails'); ?>" alt="">
								</div>
								<div class="left-side-text-article-section-2">
									<h2 class="left-side-article-h2-section-2"><?php echo $results_by_rating[11]->post_title; ?></h2>
									<div class="left-side-article-foot-section-2">
									<span><?php echo the_author_meta('first_name', ($results_by_rating[11]->post_author)); ?> <?php echo the_author_meta('last_name', ($results_by_rating[11]->post_author)); ?></span>
									</div>
								</div>
							</div>
						</div>
					</a>
				</div>
				<div class="dedivider"></div>
				<div class="left-side-fifth-article-section-2">
					<a href="<?php echo get_permalink($results_by_rating[12]->post_id); ?>">
						<div class="left-side-fifth-article-container-section-2">
							<div class="left-side-article-wrap-section-2">
								<div class="left-side-pic-article-section-2">
									<img class="left-side-article-img-section-2" src="<?php echo get_the_post_thumbnail_url($results_by_rating[12]->post_id, 'thumbnails'); ?>" alt="">
								</div>
								<div class="left-side-text-article-section-2">
									<h2 class="left-side-article-h2-section-2"><?php echo $results_by_rating[12]->post_title; ?></h2>
									<div class="left-side-article-foot-section-2">
									<span><?php echo the_author_meta('first_name', ($results_by_rating[12]->post_author)); ?> <?php echo the_author_meta('last_name', ($results_by_rating[12]->post_author)); ?></span>
									</div>
								</div>
							</div>
						</div>
					</a>
				</div>
				<div class="dedivider"></div>
				<div class="left-side-six-article-section-2">
					<a href="<?php echo get_permalink($results_by_rating[13]->post_id); ?>">
						<div class="left-side-six-article-container-section-2">
							<div class="left-side-article-wrap-section-2">
								<div class="left-side-pic-article-section-2">
									<img class="left-side-article-img-section-2" src="<?php echo get_the_post_thumbnail_url($results_by_rating[13]->post_id, 'thumbnails'); ?>" alt="">
								</div>
								<div class="left-side-text-article-section-2">
									<h2 class="left-side-article-h2-section-2"><?php echo $results_by_rating[13]->post_title; ?></h2>
									<div class="left-side-article-foot-section-2">
										<span><?php echo the_author_meta('first_name', ($results_by_rating[13]->post_author)); ?> <?php echo the_author_meta('last_name', ($results_by_rating[13]->post_author)); ?></span>
									</div>
								</div>
							</div>
						</div>
					</a>
				</div>
			</div>
		</div>
    </div><!-- END Section 2 -->
	
	<div class="home-line-wrap"><!-- START Wrap -->
		<div class="home-line-container">
			<div class="home-line-content">
				<div class="home-line-right"></div>
				<div class="home-line-pic"><img src="https://wordpress-668856-3151571.cloudwaysapps.com/wp-content/uploads/2021/10/cropped-cropped-cropped-cropped-אייקון-512-512P-180x180.png" /></div>
				<div class="home-line-left"></div>
			</div>
		</div>
	</div><!-- END Divider -->

	<div class="container-section-3 flex-container-section-3">
		<div id="section-3-right">
			<a href="<?php echo get_permalink($results_by_rating[14]->post_id); ?>">
				<div class="section-3-big-post">
					<img src="<?php echo get_the_post_thumbnail_url($results_by_rating[14]->post_id, 'large'); ?>" alt="">
					<div class="textuals">
						<h3 class="section-3-big-post-title"><?php echo $results_by_rating[14]->post_title; ?></h3>
						<div class="section-3-big-post-author"><?php echo the_author_meta('first_name', ($results_by_rating[14]->post_author)); ?> <?php echo the_author_meta('last_name', ($results_by_rating[14]->post_author)); ?></div>
					</div>
				</div>
			</a>

			<div class="section-3-small-articles-wrap">
				<a href="<?php echo get_permalink($results_by_rating[16]->post_id); ?>">
					<div class="section-3-small-article">
						<img src="<?php echo get_the_post_thumbnail_url($results_by_rating[16]->post_id, 'large'); ?>" alt="">
						<div class="textuals">
							<h3 class="section-3-small-post-title"><?php echo $results_by_rating[16]->post_title; ?></h3>
							<div class="section-3-small-post-author"><?php echo the_author_meta('first_name', ($results_by_rating[16]->post_author)); ?> <?php echo the_author_meta('last_name', ($results_by_rating[16]->post_author)); ?></div>
						</div>
					</div>					
				</a>

				<a href="<?php echo get_permalink($results_by_rating[17]->post_id); ?>">
					<div class="section-3-small-article">
						<img src="<?php echo get_the_post_thumbnail_url($results_by_rating[17]->post_id, 'large'); ?>" alt="">
						<div class="textuals">
							<h3 class="section-3-small-post-title"><?php echo $results_by_rating[17]->post_title; ?></h3>
							<div class="section-3-small-post-author"><?php echo the_author_meta('first_name', ($results_by_rating[17]->post_author)); ?> <?php echo the_author_meta('last_name', ($results_by_rating[17]->post_author)); ?></div>
						</div>
					</div>
				</a>
			</div>
		</div>

		<div id="section-3-left">
			<a href="<?php echo get_permalink($results_by_rating[15]->post_id); ?>">
				<div class="section-3-big-post">
					<img src="<?php echo get_the_post_thumbnail_url($results_by_rating[15]->post_id, 'large'); ?>" alt="">
					<div class="textuals">
						<h3 class="section-3-big-post-title"><?php echo $results_by_rating[15]->post_title; ?></h3>
						<div class="section-3-big-post-author"><?php echo the_author_meta('first_name', ($results_by_rating[15]->post_author)); ?> <?php echo the_author_meta('last_name', ($results_by_rating[15]->post_author)); ?></div>
					</div>
				</div>
			</a>

				<div class="section-3-small-articles-wrap">
					<a href="<?php echo get_permalink($results_by_rating[18]->post_id); ?>">
						<div class="section-3-small-article">
							<img src="<?php echo get_the_post_thumbnail_url($results_by_rating[18]->post_id, 'large'); ?>" alt="">
							<div class="textuals">
								<h3 class="section-3-small-post-title"><?php echo $results_by_rating[18]->post_title; ?></h3>
								<div class="section-3-small-post-author"><?php echo the_author_meta('first_name', ($results_by_rating[18]->post_author)); ?> <?php echo the_author_meta('last_name', ($results_by_rating[18]->post_author)); ?></div>
							</div>
						</div>
					</a>

					<a href="<?php echo get_permalink($results_by_rating[19]->post_id); ?>">
						<div class="section-3-small-article">
							<img src="<?php echo get_the_post_thumbnail_url($results_by_rating[19]->post_id, 'large'); ?>" alt="">
							<div class="textuals">
								<h3 class="section-3-small-post-title"><?php echo $results_by_rating[19]->post_title; ?></h3>
								<div class="section-3-small-post-author"><?php echo the_author_meta('first_name', ($results_by_rating[19]->post_author)); ?> <?php echo the_author_meta('last_name', ($results_by_rating[19]->post_author)); ?></div>
							</div>
						</div>
					</a>
				</div>
			</a>
		</div>
	</div>

	<div class="home-line-wrap"><!-- START Wrap -->
		<div class="home-line-container">
			<div class="home-line-content">
				<div class="home-line-right"></div>
				<div class="home-line-pic"><img src="https://wordpress-668856-3151571.cloudwaysapps.com/wp-content/uploads/2021/10/cropped-cropped-cropped-cropped-אייקון-512-512P-180x180.png" /></div>
				<div class="home-line-left"></div>
			</div>
		</div>
	</div><!-- END Divider -->

	<div class="container-section-2 flex-container-section-2 section-4-wrap"><!-- START Section 4 -->
		<div class="center-section-2 flex-item-section-2">
			<div class="center-container-section-2">
				<div class="center-first-article-section-2">
					<a href="<?php echo get_permalink($results_by_rating[20]->post_id); ?>">
						<div class="center-article-container-section-2">
							<div class="center-article-wrap-section-2">
								<img class="center-article-img-section-2" src="<?php echo get_the_post_thumbnail_url($results_by_rating[20]->post_id, 'large'); ?>" alt="">
								<h2 class="center-article-h2-section-2"><?php echo $results_by_rating[20]->post_title; ?></h2>
								<span><?php echo the_author_meta('first_name', ($results_by_rating[20]->post_author)); ?> <?php echo the_author_meta('last_name', ($results_by_rating[20]->post_author)); ?></span>
							</div>
						</div>
					</a>
				</div>
				<div class="center-secound-article-section-2">
					<a href="<?php echo get_permalink($results_by_rating[21]->post_id); ?>">
						<div class="center-article-container-section-2">
							<div class="center-article-wrap-section-2">
								<img class="center-article-img-section-2" src="<?php echo get_the_post_thumbnail_url($results_by_rating[21]->post_id, 'large'); ?>" alt="">
								<h2 class="center-article-h2-section-2"><?php echo $results_by_rating[21]->post_title; ?></h2>
								<span><?php echo the_author_meta('first_name', ($results_by_rating[21]->post_author)); ?> <?php echo the_author_meta('last_name', ($results_by_rating[21]->post_author)); ?></span>
							</div>
						</div>
					</a>
				</div>
			</div>
		</div>

		<div class="right-side-section-2 flex-item-section-2">
			<div class="right-side-container-section-2">
				<div class="right-side-article-section-2">
					<a href="<?php echo get_permalink($results_by_rating[22]->post_id); ?>">
						<div class="right-side-wrap-section-2">
							<img class="right-side-img-section-2" src="<?php echo get_the_post_thumbnail_url($results_by_rating[22]->post_id, 'large'); ?>" alt="">
							<h2 class="right-side-h2-section-2"><?php echo $results_by_rating[22]->post_title; ?></h2>
							<!-- <p class="right-side-p-section-2"><?php //echo wp_trim_words((strip_tags($results_by_rating[22]->post_content)), 23, "..."); ?></p> -->
							<p class="right-side-p-section-2"><?php echo get_post($results_by_rating[22]->post_id)->post_excerpt; ?></p>
							<div class="right-side-foot-section-2">
								<span><?php echo the_author_meta('first_name', ($results_by_rating[22]->post_author)); ?> <?php echo the_author_meta('last_name', ($results_by_rating[22]->post_author)); ?></span>
							</div>
						</div>
					</a>
				</div>
			</div>
		</div>

		<div class="left-side-section-2 flex-item-section-2">
			<div class="left-side-container-section-2">
				<div class="left-side-first-article-section-2">
					<a href="<?php echo get_permalink($results_by_rating[23]->post_id); ?>">
						<div class="left-side-first-article-container-section-2">
							<div class="left-side-article-wrap-section-2">
								<div class="left-side-pic-article-section-2">
									<img class="left-side-article-img-section-2" src="<?php echo get_the_post_thumbnail_url($results_by_rating[23]->post_id, 'thumbnails'); ?>" alt="">
								</div>
								<div class="left-side-text-article-section-2">
									<h2 class="left-side-article-h2-section-2"><?php echo $results_by_rating[23]->post_title; ?></h2>
									<div class="left-side-article-foot-section-2">
									<span><?php echo the_author_meta('first_name', ($results_by_rating[23]->post_author)); ?> <?php echo the_author_meta('last_name', ($results_by_rating[23]->post_author)); ?></span>
									</div>
								</div>
							</div>
						</div>
					</a>
				</div>
				<div class="dedivider"></div>
				<div class="left-side-secound-article-section-2">
					<?php echo $results_by_rating[24]->post_id; ?>
					<a href="<?php echo get_permalink($results_by_rating[24]->post_id); ?>">
						<div class="left-side-secound-article-container-section-2">
							<div class="left-side-article-wrap-section-2">
								<div class="left-side-pic-article-section-2">
									<img class="left-side-article-img-section-2" src="<?php echo get_the_post_thumbnail_url($results_by_rating[24]->post_id, 'thumbnails'); ?>" alt="">
								</div>
								<div class="left-side-text-article-section-2">
									<h2 class="left-side-article-h2-section-2"><?php echo $results_by_rating[24]->post_title; ?></h2>
									<div class="left-side-article-foot-section-2">
										<span><?php echo the_author_meta('first_name', ($results_by_rating[24]->post_author)); ?> <?php echo the_author_meta('last_name', ($results_by_rating[24]->post_author)); ?></span>
									</div>
								</div>
							</div>
						</div>
					</a>
				</div>
				<div class="dedivider"></div>
				<div class="left-side-third-article-section-2">
					<a href="<?php echo get_permalink($results_by_rating[25]->post_id); ?>">
						<div class="left-side-third-article-container-section-2">
							<div class="left-side-article-wrap-section-2">
								<div class="left-side-pic-article-section-2">
									<img class="left-side-article-img-section-2" src="<?php echo get_the_post_thumbnail_url($results_by_rating[25]->post_id, 'thumbnails'); ?>" alt="">
								</div>
								<div class="left-side-text-article-section-2">
									<h2 class="left-side-article-h2-section-2"><?php echo $results_by_rating[25]->post_title; ?></h2>
									<div class="left-side-article-foot-section-2">
										<span><?php echo the_author_meta('first_name', ($results_by_rating[25]->post_author)); ?> <?php echo the_author_meta('last_name', ($results_by_rating[25]->post_author)); ?></span>
									</div>
								</div>
							</div>
						</div>
					</a>
				</div>
				<div class="dedivider"></div>
				<div class="left-side-fourth-article-section-2">
					<a href="<?php echo get_permalink($results_by_rating[26]->post_id); ?>">
						<div class="left-side-fourth-article-container-section-2">
							<div class="left-side-article-wrap-section-2">
								<div class="left-side-pic-article-section-2">
									<img class="left-side-article-img-section-2" src="<?php echo get_the_post_thumbnail_url($results_by_rating[26]->post_id, 'thumbnails'); ?>" alt="">
								</div>
								<div class="left-side-text-article-section-2">
									<h2 class="left-side-article-h2-section-2"><?php echo $results_by_rating[26]->post_title; ?></h2>
									<div class="left-side-article-foot-section-2">
										<span><?php echo the_author_meta('first_name', ($results_by_rating[26]->post_author)); ?> <?php echo the_author_meta('last_name', ($results_by_rating[26]->post_author)); ?></span>
									</div>
								</div>
							</div>
						</div>
					</a>
				</div>
				<div class="dedivider"></div>
				<div class="left-side-fifth-article-section-2">
					<a href="<?php echo get_permalink($results_by_rating[27]->post_id); ?>">
						<div class="left-side-fifth-article-container-section-2">
							<div class="left-side-article-wrap-section-2">
								<div class="left-side-pic-article-section-2">
									<img class="left-side-article-img-section-2" src="<?php echo get_the_post_thumbnail_url($results_by_rating[27]->post_id, 'thumbnails'); ?>" alt="">
								</div>
								<div class="left-side-text-article-section-2">
									<h2 class="left-side-article-h2-section-2"><?php echo $results_by_rating[27]->post_title; ?></h2>
									<div class="left-side-article-foot-section-2">
										<span><?php echo the_author_meta('first_name', ($results_by_rating[27]->post_author)); ?> <?php echo the_author_meta('last_name', ($results_by_rating[27]->post_author)); ?></span>
									</div>
								</div>
							</div>
						</div>
					</a>
				</div>
				<div class="dedivider"></div>
				<div class="left-side-six-article-section-2">
					<a href="<?php echo get_permalink($results_by_rating[28]->post_id); ?>">
						<div class="left-side-six-article-container-section-2">
							<div class="left-side-article-wrap-section-2">
								<div class="left-side-pic-article-section-2">
									<img class="left-side-article-img-section-2" src="<?php echo get_the_post_thumbnail_url($results_by_rating[28]->post_id, 'thumbnails'); ?>" alt="">
								</div>
								<div class="left-side-text-article-section-2">
									<h2 class="left-side-article-h2-section-2"><?php echo $results_by_rating[28]->post_title; ?></h2>
									<div class="left-side-article-foot-section-2">
										<span><?php echo the_author_meta('first_name', ($results_by_rating[28]->post_author)); ?> <?php echo the_author_meta('last_name', ($results_by_rating[28]->post_author)); ?></span>
									</div>
								</div>
							</div>
						</div>
					</a>
				</div>
			</div>
		</div>
    </div>

	<div class="home-line-wrap"><!-- START Wrap -->
		<div class="home-line-container">
			<div class="home-line-content">
				<div class="home-line-right"></div>
				<div class="home-line-pic"><img src="https://wordpress-668856-3151571.cloudwaysapps.com/wp-content/uploads/2021/10/cropped-cropped-cropped-cropped-אייקון-512-512P-180x180.png" /></div>
				<div class="home-line-left"></div>
			</div>
		</div>
	</div><!-- END Divider -->

	<div class="section-5-wrap">
		<div id="section-5-content">
			<div id="section-5-right">
				<div id="section-5-posts">
					<?php for ($i = 0; $i < 10; $i++) : ?>
						<a href="<?php echo get_permalink($results_by_rating[29 + $i]->post_id); ?>">
							<div class="section-5-post">
								<div class="section-5-post-right">
									<img src="<?php echo get_the_post_thumbnail_url($results_by_rating[29 + $i]->post_id, 'large'); ?>" alt="">
								</div>

								<div class="section-5-post-left">
									<h2 class="section-5-left-h2"><?php echo $results_by_rating[29 + $i]->post_title; ?></h2>
									<!-- <p class="section-5-left-p"><?php //echo wp_trim_words((strip_tags($results_by_rating[28 + $i]->post_content)), 23, "..."); ?></p> -->
									<p class="section-5-left-p"><?php echo get_post($results_by_rating[29 + $i]->post_id)->post_excerpt; ?></p>
									<div class="section-5-left-foot">
									<span><?php echo the_author_meta('first_name', ($results_by_rating[29 + $i]->post_author)); ?> <?php echo the_author_meta('last_name', ($results_by_rating[29 + $i]->post_author)); ?></span>
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
	
</div><!-- END Wrap -->

<script defer src="https://cdn.enable.co.il/licenses/enable-L12934rctog9b6am-0822-31743/init.js"></script>




<?php

get_footer();