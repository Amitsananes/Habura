<?php

//$user_email = get_the_author_meta('user_email');

$result = get_post_id_if_expired();
if (!$result) {
    global $wpdb;
    $rating = $wpdb->get_results( "SELECT * FROM wp_rating_article WHERE post_id = ".get_the_ID() );
    $has_rating = $rating ? true : false;
}
if ($result || !$has_rating) {
    // Check if user already rated this article
    $ip = get_user_ip();
    $post_id = get_the_ID();
    global $wpdb;

    $did_rate = count($wpdb->get_results("SELECT * FROM article_raters WHERE post_id = $post_id AND ip = '$ip'"));

    $ip = get_user_ip();
    $post_author_ip = get_field( 'author_ip', $post_id );

    ?>

    <?php // Only let users rate if they did not rate yet, the current user is not the author and if entered the page from the popup ?>
        <?php if ( (is_admin() && !$did_rate) || (!$did_rate && $ip != $post_author_ip && isset($_GET['source']) && $_GET['source'] == 'popup')) : ?>
        <div class="rating-wrap rating-1">
            <div class="rating-content">
                <div class="rating-main">
                    <p>כתבה זו עדיין לא פורסמה בחבּוּרֶה. את/ה ואחוז קטן מהגולשים נבחרתם לדרג ולהשפיע אם היא תעלה והיכן
                        היא תמוקם</p>
                    <h4>דרג/י עכשיו והשפיע/י!</h4>
                    <div class="rating-stars">
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                    </div>
                    <?php
                    $post_id = get_the_ID();

                    // foreach($result as $row){

                    // 	$numbers_of_raters = $row->numbers_of_raters;
                    // 	$sum_rate = $row->sum_rate;
                    // 	$final_rating = ($sum_rate / $numbers_of_raters);
                    // 	$final_rating = number_format($final_rating, 1, '.', '');
                    // }

                    // if (current_user_can('manage_options')) {
                    // 	if ( $final_rating == 0 ) {
                    // 		echo '<p>דירוג הכתבה: 0. הזדמנות שלכם לדרג!</p>';
                    // 	} else {
                    // 		echo '<p>דירוג הכתבה: ' . $final_rating . ' <span class="rating-raters-dot">.</span> <span class="rating-raters">' . $numbers_of_raters . ' מדרגים</span></p>';
                    // 	}
                    // }

                    ?>
                </div>
            </div>
        </div>
    <?php endif; ?>

    <!--<div class="rating-wrap rating-2">
        <div class="rating-content">
            <div class="rating-main">
                <p>כתבה זו עדיין לא פורסמה בחבּוּרֶה. את/ה ואחוז קטן מהגולשים נבחרתם לדרג ולהשפיע אם היא תעלה והיכן היא תמוקם</p>
                <h4>דרג/י עכשיו והשפיע/י!</h4>
                <div class="rating-stars">
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                </div>
                <button class="rating-buttton" onclick="">
                    <i class="fas fa-paper-plane"></i>
                </button>
            </div>
        </div>
    </div>-->

    <div class="rating-wrap rating-3">
        <div class="rating-content">
            <div class="rating-main">
                <img class="rating-image" src="https://wordpress-668856-3037938.cloudwaysapps.com/wp-content/uploads/2021/11/mashov-rating.png"/>
                <p>ּשלח/י לכתב מדוע לדעתך התוכן לא מתאים לחבּוּרֶה?</p>
                <form id="article-feedback-form" class="rating-input-wrap">
                    <input class="rating-input" placeholder="לא חייב, אבל ככה תוכל לעזור לכתב להשתפר"/>
                    <a href="#"><i class="fas fa-paper-plane"></i></a>
                </form>
            </div>
        </div>
    </div>

    <div class="rating-wrap rating-4" style="<?php if ($did_rate) echo 'display: block'; ?>">
        <div class="rating-content">
            <div class="rating-main">
                <h3>תודה שדירגת!</h3>
                <i class="fas fa-thumbs-up"></i>
                <p>ּּבדקות הקרובות נעשה שכלול של כלל המדרגים ורק אם הכתבה תתאים לחבּוּרֶה היא תעלה לאתר</p>
                <h4>המשך לעקוב ולהשפיע</h4>
                <a href="/" class="rating-a">לדף הבית</a>
            </div>
        </div>
    </div>

    <script>
        jQuery(document).ready(function ($) {

            var rating;

            $('.rating-stars i:nth-child(5)').hover(function () {
                $('.rating-stars i:nth-child(5)').css({"color": "#FFC800"});
            }, function () {
                $('.rating-stars i:nth-child(5)').css({"color": "#cbcbcb"});
            });
            $('.rating-stars i:nth-child(4)').hover(function () {
                $('.rating-stars i:nth-child(5)').css({"color": "#FFC800"});
                $('.rating-stars i:nth-child(4)').css({"color": "#FFC800"});
            }, function () {
                $('.rating-stars i:nth-child(5)').css({"color": "#cbcbcb"});
                $('.rating-stars i:nth-child(4)').css({"color": "#cbcbcb"});
            });
            $('.rating-stars i:nth-child(3)').hover(function () {
                $('.rating-stars i:nth-child(5)').css({"color": "#FFC800"});
                $('.rating-stars i:nth-child(4)').css({"color": "#FFC800"});
                $('.rating-stars i:nth-child(3)').css({"color": "#FFC800"});
            }, function () {
                $('.rating-stars i:nth-child(5)').css({"color": "#cbcbcb"});
                $('.rating-stars i:nth-child(4)').css({"color": "#cbcbcb"});
                $('.rating-stars i:nth-child(3)').css({"color": "#cbcbcb"});
            });
            $('.rating-stars i:nth-child(2)').hover(function () {
                $('.rating-stars i:nth-child(5)').css({"color": "#FFC800"});
                $('.rating-stars i:nth-child(4)').css({"color": "#FFC800"});
                $('.rating-stars i:nth-child(3)').css({"color": "#FFC800"});
                $('.rating-stars i:nth-child(2)').css({"color": "#FFC800"});
            }, function () {
                $('.rating-stars i:nth-child(5)').css({"color": "#cbcbcb"});
                $('.rating-stars i:nth-child(4)').css({"color": "#cbcbcb"});
                $('.rating-stars i:nth-child(3)').css({"color": "#cbcbcb"});
                $('.rating-stars i:nth-child(2)').css({"color": "#cbcbcb"});
            });
            $('.rating-stars i:nth-child(1)').hover(function () {
                $('.rating-stars i:nth-child(5)').css({"color": "#FFC800"});
                $('.rating-stars i:nth-child(4)').css({"color": "#FFC800"});
                $('.rating-stars i:nth-child(3)').css({"color": "#FFC800"});
                $('.rating-stars i:nth-child(2)').css({"color": "#FFC800"});
                $('.rating-stars i:nth-child(1)').css({"color": "#FFC800"});
            }, function () {
                $('.rating-stars i:nth-child(5)').css({"color": "#cbcbcb"});
                $('.rating-stars i:nth-child(4)').css({"color": "#cbcbcb"});
                $('.rating-stars i:nth-child(3)').css({"color": "#cbcbcb"});
                $('.rating-stars i:nth-child(2)').css({"color": "#cbcbcb"});
                $('.rating-stars i:nth-child(1)').css({"color": "#cbcbcb"});
            });
            $('.rating-stars i:nth-child(5)').on("click", function () {
                rating = 1;
                $('.rating-stars i:nth-child(5)').css({"color": "#FFC800"});
                setTimeout(function () {
                    $('.rating-1').hide();
                    $('.rating-3').show();
                }, 1000);
            });
            $('.rating-stars i:nth-child(4)').on("click", function () {
                rating = 2;
                $('.rating-stars i:nth-child(5)').css({"color": "#FFC800"});
                $('.rating-stars i:nth-child(4)').css({"color": "#FFC800"});
                setTimeout(function () {
                    $('.rating-1').hide();
                    $('.rating-3').show();
                }, 1000);
            });
            $('.rating-stars i:nth-child(3)').on("click", function () {
                rating = 3;
                $('.rating-stars i:nth-child(5)').css({"color": "#FFC800"});
                $('.rating-stars i:nth-child(4)').css({"color": "#FFC800"});
                $('.rating-stars i:nth-child(3)').css({"color": "#FFC800"});
                setTimeout(function () {
                    $('.rating-1').hide();
                    $('.rating-4').show();
                }, 1000);
            });
            $('.rating-stars i:nth-child(2)').on("click", function () {
                rating = 4;
                $('.rating-stars i:nth-child(5)').css({"color": "#FFC800"});
                $('.rating-stars i:nth-child(4)').css({"color": "#FFC800"});
                $('.rating-stars i:nth-child(3)').css({"color": "#FFC800"});
                $('.rating-stars i:nth-child(2)').css({"color": "#FFC800"});
                setTimeout(function () {
                    $('.rating-1').hide();
                    $('.rating-4').show();
                }, 1000);
            });
            $('.rating-stars i:nth-child(1)').on("click", function () {
                rating = 5;
                $('.rating-stars i:nth-child(5)').css({"color": "#FFC800"});
                $('.rating-stars i:nth-child(4)').css({"color": "#FFC800"});
                $('.rating-stars i:nth-child(3)').css({"color": "#FFC800"});
                $('.rating-stars i:nth-child(2)').css({"color": "#FFC800"});
                $('.rating-stars i:nth-child(1)').css({"color": "#FFC800"});
                setTimeout(function () {
                    $('.rating-1').hide();
                    $('.rating-4').show();
                }, 1000);
            });

            // $('.rating-input a').on('click', function() {
            // 	const postID1 = <?php //echo get_the_ID(); ?>;
            // 	$.ajax({
            // 		type: 'POST',
            // 		url: '/wp-admin/admin-ajax.php',
            // 		data: {
            // 			'post_id': postID1,
            // 			action: 'call_update_rating',
            // 			'sum_rate': rating1,
            // 			'numbers_of_raters': numbersOfRaters,
            // 			//'category_id': catID,
            // 		}, success: function (result) {
            // 			//console.log('result = ' + result);
            // 		},
            // 		error: function (error) {
            // 			//console.log('error = ' + error)
            // 		}
            // 	});
            // });

            /* Ajax for article rating */
            $(".rating-stars i").on('click', function () {
                const rating1 = rating;
                const numbersOfRaters = 1;
                const postID = <?php echo get_the_ID(); ?>;
                //const catID = <?php //echo get_cat_ID(); ?>;

                $.ajax({
                    type: 'POST',
                    url: '/wp-admin/admin-ajax.php',
                    data: {
                        'post_id': postID,
                        action: 'call_update_rating',
                        'sum_rate': rating1,
                        'numbers_of_raters': numbersOfRaters,
                        //'category_id': catID,
                    }, success: function (result) {
                        //console.log('result = ' + result);
                    },
                    error: function (error) {
                        //console.log('error = ' + error)
                    }
                });
            });

            // Article feedback
            $("#article-feedback-form > a").click(function (e) {
                e.preventDefault();
                $("#article-feedback-form").submit();
            })
            $("#article-feedback-form").submit(function (e) {
                e.preventDefault();

                $(".rating-3").hide();
                $(".rating-4").show();
            })

            /* END of Ajax for article rating */

        });
    </script>
<?php } ?>