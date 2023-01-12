<?php

function expired_articles_manager() {
    register_rest_route( 'cron/v1', '/expired', array(
        'methods' => 'GET',
        'callback' => 'expired_manager_func',
        'args' => array(),
    ));
}
add_action( 'rest_api_init', 'expired_articles_manager' );

function expired_manager_func() {

    try {
        $conn = new PDO("mysql:host=localhost;dbname=dvkrsyyczt", 'dvkrsyyczt', '2FDKzfQuKJ');
        // set the PDO error mode to exception
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        echo "Connected successfully";
    } catch(PDOException $e) {
        echo "Connection failed: " . $e->getMessage();
        die();
    }

    $posts_table = 'wp_posts';
    $articles_table = 'wp_rating_article';

    // Extend expiration time of unrated posts
    $time_to_find_start = time() - 500;
    $time_to_find_end = time();

    $time_down_rate = 300;
    $new_time_noco = time() + $time_down_rate;

    $articles_to_extend = $conn->query("SELECT * FROM wp_expiration_time WHERE expiration_time < ($time_to_find_end) AND expiration_time > ($time_to_find_start)");
//    echo "SELECT * FROM wp_expiration_time WHERE expiration_time < ($time_to_find_end) AND expiration_time > ($time_to_find_start)<br/>";

    while ($post = $articles_to_extend->fetch()) {
//        echo '<br>';
        $expiration_id = $post['id'];
        $post_id = $post['post_id'];
        // Get number of ratings for post
        $rating_row_stmt = $conn->query("SELECT * FROM wp_rating_article WHERE post_id = {$post_id}");

        if (!$rating_row_stmt->rowCount()) {
//            update_field( 'expiration', $new_time_noco, $post_id );
            $conn->query("UPDATE wp_expiration_time SET expiration_time = '{$new_time_noco}' WHERE id = {$expiration_id} ");
        }

    }

    // Get all posts that were expired in the last hour and make than a draft if their rating is lower than 1.5 percent
    $time = time();
    $hour_in_time = 60;
    $two_hours_in_time = 120;
    $two_hours_in_time = 3800;

    $articles_to_draft = $conn->query("SELECT * FROM wp_expiration_time WHERE expiration_time < ($time - $hour_in_time) AND expiration_time > ($time - $two_hours_in_time)");

    while ($post = $articles_to_draft->fetch()) {
        $article_id = $post['post_id'];

        $article_rating_query = $conn->query("SELECT * FROM $articles_table WHERE post_id = $article_id AND sum_rate");

        if ($article_rating_query->rowCount()) {
            $article_rating = $article_rating_query->fetch();
            $average = ($article_rating['sum_rate'] / $article_rating['numbers_of_raters']) - $article_rating['minus'];

            update_field( 'score', $average, $article_id );
//            echo "<br/>1. $article_id<br/>";

            if ($average <= 1.5) {
                echo 'Post to draft: ' . $article_id . '<br>';
                $conn->query("UPDATE $posts_table SET `post_status` = 'draft' WHERE id = $article_id");
            }

            // Save last rate in the db
        }
    }

    date_default_timezone_set('Asia/Jerusalem');

    // if (date('i') == 0) {
    $hour = (int) date('H') + 2;
    $is_saturday = (date('w') + 1 == 6 && $hour >= 19) || (date('w') + 1 == 7 && $hour < 19);
    if ($hour >= 7 && !$is_saturday) {
        echo 'its time';
        // Get all posts with rating of > 1.6
        $posts_to_affect = $conn->query("SELECT * FROM $articles_table WHERE (sum_rate / numbers_of_raters - minus) > 1.6");

        $final_condition = "";
        while ($post = $posts_to_affect->fetch()) {
            $final_condition .= "ID = " . $post['post_id'] . ' OR ';
        }

        $final_condition .= substr($final_condition, 0, -3);


        $articles = $conn->query( "SELECT * FROM `wp_posts` WHERE " . $final_condition );
        // $articles = $wpdb->get_results( "SELECT * FROM `wp_posts` WHERE `post_status` = 'publish' AND `post_type` = 'post' ORDER BY `post_date` DESC LIMIT 100" );
        while ($article = $articles->fetch()) {
            $article_id = $article['ID'];
            $article_rating_query = $conn->query("SELECT * FROM $articles_table WHERE post_id = $article_id AND sum_rate");

            if ($article_rating_query->rowCount()) {
                $article_rating = $article_rating_query->fetch();
                $old_minus = $article_rating['minus'];

                if ($old_minus == '') {
                    $old_minus = 0;
                }

                $to_minus = 0.0125;
                $new_minus = $old_minus + $to_minus;
                $new_rate = ( $article_rating['sum_rate'] / $article_rating['numbers_of_raters'] ) - $new_minus;
                update_field( 'post_score', $new_rate, $article_id );

                // Stop lowering percentage after 1.6
                if ($new_rate < 1.6) {
                    $new_minus = abs(1.6 - $article_rating['sum_rate'] / $article_rating['numbers_of_raters']);
                }

                $rating_id = $article_rating['id'];

                $conn->query("UPDATE $articles_table SET `minus` = $new_minus WHERE id = $rating_id");
            }
        }
    }
    // }

    // Send email to published posts
    $time = time();

    // Get all posts that expired in the last minute
    $articles_to_draft = $conn->query("SELECT * FROM wp_expiration_time WHERE expiration_time < ($time - 60) AND expiration_time > ($time - 120)");

    while ($post = $articles_to_draft->fetch()) {
        $article_id = $post['post_id'];

        $article_rating_query = $conn->query("SELECT * FROM $articles_table WHERE post_id = $article_id AND sum_rate");

        if ($article_rating_query->rowCount()) {
            $article_rating = $article_rating_query->fetch();
            $average = ($article_rating['sum_rate'] / $article_rating['numbers_of_raters']) - $article_rating['minus'];

            update_field( 'initial_score', $average, $article_id );
            update_field( 'running_done', true, $article_id );
            update_field( 'post_score', $average, $article_id );
//            echo "<br/>2. $article_id<br/>";

            if ($average > 1.5) {
                // Check if email already sent

                if (!$conn->query("SELECT * FROM publish_mails WHERE post_id = {$article_id}")->rowCount()) {
                    // Send mail
//                    include './wp-load.php';
                    include 'approved-email-template.php';

                    $post = get_post($article_id);
                    $author = get_the_author_meta('first_name', ($post->post_author)) . ' ' .  get_the_author_meta('last_name', ($post->post_author));
                    $url = $post->guid;
                    $user_id = $post->post_author;
                    $user_info = get_userdata($user_id);
                    $email = $user_info->user_email;
                    $title = $post->post_title;
                    $message = mail_template($author, $title, $url);

                    //php mailer variables
                    $to = $email;
                    $subject = 'איזה יופי הכתבה שלך - ' . $title . ' - אושרה ועלתה לאתר-חֲבּוּרֶה';
                    $headers = 'From: '. $email . "\r\n" .
                        'Reply-To: ' . $email . "\r\n";

                    $sent = wp_mail($to, $subject, $message, $headers);

                    if ($sent) {
                        // Add mail to db
                        $conn->query("INSERT INTO publish_mails (post_id) VALUES({$article_id})");
                    }
                }
            }
        }
    }

    exit;

}