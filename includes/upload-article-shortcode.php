<?php
// Exit if accessed directly
if ( !defined( 'ABSPATH' ) ) exit;

function process_user_upload_article() {

//    echo json_encode($_FILES);
//    exit;

    $tags = array();
    $categories = array();

    if ( isset($_POST['tags']) ) {
        $tags = $_POST['tags'];
    }

    if ( isset($_POST['categories']) ) {
        $categories = $_POST['categories'];
    }

//    check_ajax_referer('file_upload', 'security');
    $arr_img_ext = array('image/png', 'image/jpeg', 'image/jpg', 'image/gif');
    $arr_video_ext = array('video/mp4');
    $arr_audio_ext = array('audio/mpeg', 'audio/wav');
//    if (in_array($_FILES['file']['type'], $arr_img_ext)) {

    $args = array(
        'post_title' => $_POST['post_title'],
        'post_status' => 'pending',
        'post_content' => $_POST['post_content'],
        'post_excerpt' => $_POST['post_excerpt'],
        'post_category' => $categories,
    );

    $hour = (int) date('H') + 2;
    $is_saturday = (date('w') + 1 == 6 && $hour >= 19) || (date('w') + 1 == 7 && $hour < 19);

    if ( isset($_POST['schedule_post_checkbox']) && isset($_POST['schedule_post']) ) {
        $postdate = date('Y-m-d H:i:s',strtotime($_POST['schedule_post']));
        $postdate_gmt = gmdate('Y-m-d H:i:s',strtotime($postdate));

        $args['post_date'] = $postdate;
        $args['post_date_gmt'] = $postdate_gmt;
        $args['post_status'] = 'future';
//	    $args['edit_date'] = true;
    }

    $post_id = wp_insert_post( $args );

    if ( $is_saturday ) {
        update_post_meta( $post_id, 'uploaded_on_saturday', true );
    }

    $user_id = get_current_user_id();
    update_field( 'terms_approved', true, 'user_'.$user_id );

    if ( count($tags) ) {
        $tags_id = array(get_term_by('name', 'חבורה', 'post_tag')->term_id);
//        $tags_id = array();
        $current_user = wp_get_current_user();
        $user_full_name = $current_user->user_firstname . ' ' . $current_user->user_lastname;
        $username_tag_exists = tag_exists( $user_full_name );
//	    if ( $username_tag_exists ) {
//		    $tag_id = get_term_by('name', $user_full_name, 'post_tag')->term_id;
//		    $tags_id[] = $tag_id;
//	    } else {
//		    $new_tag = wp_insert_term( $user_full_name, 'post_tag', $args = array() );
//		    $tags_id[] = intval($new_tag['term_id']);
//	    }
        foreach ( $tags as $tag ) {
            if ( !is_numeric($tag) ) {
                $tag_exists = tag_exists( $tag );
                if ( $tag_exists ) {
                    $tag_id = get_term_by('name', $tag, 'post_tag')->term_id;
                    $tags_id[] = $tag_id;
                } else {
                    $new_tag = wp_insert_term( $tag, 'post_tag', $args = array() );
                    $tags_id[] = intval($new_tag['term_id']);
                }
            } else {
                $tags_id[] = intval($tag);
            }
        }
        wp_set_object_terms($post_id, $tags_id, 'post_tag', true);
    }

    $file_description_categories = '';
    foreach ( $categories as $category ) {
        $category_name = get_field( 'cat_name', 'category_'.$category );
        if ( !$category_name || $category_name == '') {
            $category_name = get_the_category_by_ID( $category );
        }
        $file_description_categories .= ' / ' . $category_name;
    }

    if ( isset($_POST['files_descriptions']) ) {
        $descriptions = $_POST['files_descriptions'];
    }

    $featured_img_file = $_FILES['featured_image'];
//	$alt_text = substr($featured_img_file["name"], 0,strrpos($featured_img_file["name"], '.'));
    $alt_text = $_POST['featured_img_alt'];
    $featured_img_desc = $_POST['post_title'];
    $display_featured_image_desc = false;
    if (isset($_POST['featured_img_desc'])) {
        $display_featured_image_desc = true;
        $featured_img_desc = $_POST['featured_img_desc'];
    }

    $attach_id = add_media_file( $featured_img_file, $alt_text, $featured_img_desc.$file_description_categories );
    wp_update_post( array(
        'ID' => $attach_id,
        'post_excerpt' => $featured_img_desc.$file_description_categories,
    ) );
    set_post_thumbnail( $post_id, $attach_id );

//    if ( $featured_img_desc && $featured_img_desc != '' ) {
//        $alt_text .= ' / '.$featured_img_desc;
//    }

    update_field( 'קרדיט_לתמונה', $alt_text , $post_id );
    update_field( 'תיאור_התמונה', isset($_POST['featured_img_desc']) ?: '', $post_id );
    update_field( 'display_featured_image_desc', $display_featured_image_desc, $post_id );

    // Upload the media file to the server
    if ( isset($_FILES['media_files'])) {
        for ( $i = 0; $i < count($_FILES['media_files']['name']); $i++ ) {
            $file = array(
                'name'      => $_FILES['media_files']['name'][$i],
                'type'      => $_FILES['media_files']['type'][$i],
                'tmp_name'  => $_FILES['media_files']['tmp_name'][$i],
                'error'     => $_FILES['media_files']['error'][$i],
                'size'      => $_FILES['media_files']['size'][$i],
            );
            $alt_text = $_POST['files_alts'][$i];

            // Update file's description
            $file_description = $_POST['post_title'];
            $display_description = false;

            if ( isset($descriptions) && isset($descriptions[$i]) && $descriptions[$i] != '' ) {
                $display_description = true;
                $file_description = $descriptions[$i];
            }

            $file_description .= $file_description_categories;

            $attach_id = add_media_file( $file, $alt_text, $file_description );
            wp_update_post( array(
                'ID' => $attach_id,
                'post_excerpt' => $file_description,
            ) );

            $row = array(
                'media' => $attach_id,
                'media_credit' => $alt_text,
                'description' => $file_description,
                'display_description' => $display_description,
            );

            // If the media file is a video, add it to the post's video_content field
            if ( in_array( $file['type'], $arr_video_ext ) ) {
                add_row( 'video_content', $row, $post_id );
            }

            // If the media file is a video, add it to the post's media_content field
            if ( in_array( $file['type'], $arr_img_ext ) ) {
                add_row( 'media_content', $row, $post_id );
            }

            // If the media file is an image, add it to the post's media_content field
            if ( in_array( $file['type'], $arr_audio_ext ) ) {
                add_row( 'audio_content', $row, $post_id );
            }
        }
    }

    // Send response
    wp_send_json_success($_POST);
//    }
}
add_action( 'wp_ajax_user_upload_article', 'process_user_upload_article' );
add_action( 'wp_ajax_nopriv_user_upload_article', 'process_user_upload_article' );

function add_media_file( $file, $alt, $desc ) {
    $upload = wp_upload_bits($file["name"], null, file_get_contents($file["tmp_name"]));
    if (!isset($upload['file'])) {
        echo $upload['error'];
        exit;
    }
    $wp_filetype = wp_check_filetype( $upload['file'], null );

    // Create an attachment for the media file
    $attachment = array(
        'post_mime_type' => $wp_filetype['type'],
        'post_title' => sanitize_file_name( $file["name"] ),
        'post_content' => '',
        'post_status' => 'inherit'
    );
    $attach_id = wp_insert_attachment( $attachment, $upload['file'] );

    // Update file's description
    wp_update_post( array(
        'ID' => $attach_id,
        'post_content' => $desc,
    ) );

    require_once( ABSPATH . 'wp-admin/includes/image.php' );
    $attach_data = wp_generate_attachment_metadata( $attach_id, $upload['file'] );
    wp_update_attachment_metadata( $attach_id, $attach_data );

    update_post_meta($attach_id, '_wp_attachment_image_alt', $alt);

    return $attach_id;
}

function load_more_tags() {
    if ( isset($_POST['term']) ) {
        wp_send_json_success( get_tags( array(
            'hide_empty' => false,
            'name__like' => $_POST['term'],
        ) ) );
    } else {
        $offset = 0;
        if ( isset($_POST['offset']) ) {
            $offset = $_POST['offset'];
        }
        wp_send_json_success( get_tags( array(
            'hide_empty' => false,
            'offset' => $offset,
            'number' => 30,
        ) ) );
    }
}
add_action( 'wp_ajax_load_more_tags', 'load_more_tags' );
add_action( 'wp_ajax_nopriv_load_more_tags', 'load_more_tags' );

function autoresize_plugin_load($plugin_array) {
    $plug = get_template_directory_uri() . '-child/js/tinymce_autoresize.js';
    $plugin_array['autoresize'] = $plug;
    return $plugin_array;
}

function upload_article_form() {

//    $allowed_users = array(637, 74, 2);
//    if (!in_array(get_current_user_id(), $allowed_users))
//        return;

    add_filter("mce_external_plugins", "autoresize_plugin_load");

    // Enqueue scripts and styles
    wp_enqueue_style( 'upload-previewer-css', get_template_directory_uri() . '-child/css/jquery.uploadPreviewer.css', array(), '6.1.10008' );
    wp_enqueue_script( 'upload-previewer-js', get_template_directory_uri() . '-child/js/jquery.uploadPreviwer.js', array( 'jquery' ), '6.1.10024' );

    wp_enqueue_style( 'select2-css', 'https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css' );
    wp_enqueue_script( 'select2-js', 'https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js' );

//    wp_enqueue_style( 'upload-article-multiselect-css', 'https://cdnjs.cloudflare.com/ajax/libs/selectize.js/0.15.2/css/selectize.default.min.css' );
//    wp_enqueue_script( 'upload-article-multiselect-js', 'https://cdnjs.cloudflare.com/ajax/libs/selectize.js/0.15.2/js/selectize.min.js' );

    wp_enqueue_style( 'upload-article-shortcode', get_template_directory_uri() . '-child/css/upload-article-shortcode.css', array(), '6.1.10024' );
    wp_enqueue_script( 'upload-article-shortcode', get_template_directory_uri() . '-child/js/upload-article-shortcode.js', array( 'jquery' ), '6.1.23104' );
    wp_localize_script('upload-article-shortcode', 'upload_form', array(
        'nonce' => wp_create_nonce('upload_form'),
        'action' => 'user_upload_article',
    ) );

    $terms_approved = get_field( 'terms_approved', 'user_'.get_current_user_id() );

    // Fetch tags
    $tags = get_tags( array(
        'hide_empty' => false,
        'number' => 30,
    ) );

    // Fetch categories
    $categories = get_categories( array(
        'hide_empty' => false,
        'number' => 30,
    ) );

    for ( $i = 0; $i < count($categories); $i++ ) {
        $name_field = get_field( 'cat_name', 'category_'.$categories[$i]->term_id );
        if ( $name_field ) {
            $categories[$i]->name = $name_field;
        }
    }

    $last_update_terms_of_use = get_the_modified_date('d/m/Y', get_page_by_title('תנאי שימוש')->ID);

//    if (get_current_user_id() == 637) {
//        echo '<pre>'.print_r(get_field('media_content', 126889), true).'</pre>';
//    }

    ?>
    <form id="upload-article-shortcode-form">

        <div class="input_container">
            <label for="post_title">
                כותרת ראשית <span class="required_field">*</span>
                <i class="tooltip fa-solid fa-circle-question">
                    <span class="tooltiptext">ספר בקצרה ועניין את הגולש להיכנס לכתבה</span>
                </i>
            </label>
            <p class="error">ערך נדרש</p>
            <div class="textarea_container">
                <input class="input_counter" type="text" maxlength="60" name="post_title" placeholder="עד 60 תווים"/>
                <p class="chars_count"><span class="current_count">0</span>/60</p>
            </div>
        </div>

        <div class="input_container">
            <label for="post_excerpt">
                כותרת משנית <span class="required_field">*</span>
                <i class="tooltip fa-solid fa-circle-question">
                    <span class="tooltiptext">תן תקציר מהחלקים המעניינים בכתבה</span>
                </i>
            </label>
            <p class="error">ערך נדרש</p>
            <div class="textarea_container">
                <textarea class="input_counter post_excerpt" oninput='this.style.height = "";this.style.height = this.scrollHeight + "px"' maxlength="140" name="post_excerpt" placeholder="עד 140 תווים" rows="2" cols="50"></textarea>
                <p class="chars_count"><span class="current_count">0</span>/140</p>
            </div>
        </div>

        <div class="input_container">
            <div class="featured_image_container">
                <label>הוסף תמונה ראשית <span class="required_field">*</span></label>
                <p class="error">ערך נדרש</p>
                <p class="free_images">למאגרי תמונות חינמיים
                    <span>
                        <a href="https://pixabay.com/" target="_blank" rel="noopener"> לחץ כאן</a>
                    </span>
                </p>
                <input type="file" title="הוסף תמונה ראשית" class="featured_image" name="featured_image" accept="image/*"/>
            </div>
        </div>

        <div class="input_container">
            <label for="post_content">
                תוכן הכתבה <span class="required_field">*</span>
                <i class="tooltip fa-solid fa-circle-question">
                    <span class="tooltiptext">הזן כאן את תוכן הכתבה<br/>אין להכניס קישורים/מיילים/מספרי טלפון.</span>
                </i>
            </label>
            <p class="tiny_mce_error error">ערך נדרש</p>
            <?php wp_editor('', 'post_content_tmce', array(
                'media_buttons' => false,
                'textarea_name' => 'post_content',
                'textarea_rows' => 4,
                'tinymce' => array(
                    'selector' => '#post_content_tmce',
                    'toolbar' => 'undo redo styleselect bold italic alignleft aligncenter alignright bullist numlist outdent indent code',
                    'plugins' => 'autoresize paste',
                    'paste_as_text' => true
                ),
                'quicktags' => false,
            )); ?>
            <!--            <textarea class="post_content" oninput='this.style.height = "";this.style.height = this.scrollHeight + "px"' name="post_content" rows="4" cols="50"></textarea>-->
        </div>

        <div class="input_container">
            <div class="tags_categories">
                <div class="categories_container">
                    <label for="categories[]">
                        קטגוריות <span class="required_field">*</span>
                        <i class="tooltip fa-solid fa-circle-question">
                            <span class="tooltiptext">בחר את הקטגוריה שהכי מתאימה לתוכן שלך<br/>עד 2 קטגוריות</span>
                        </i>
                    </label>
                    <p class="error">ערך נדרש</p>
                    <select data-placeholder="בחר את הקטגוריה שהכי מתאימה לתוכן שלך" multiple class="categories-select" name="categories[]" multiple="multiple">
                        <option value=""></option>
                        <?php foreach( $categories as $category ): ?>
                            <option value="<?= $category->term_id ?>"><?= $category->name ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <div class="tags_container">
                    <label for="tabs[]">
                        תגיות <span class="required_field">*</span>
                        <i class="tooltip fa-solid fa-circle-question">
                            <span class="tooltiptext">לקידום אפקטיבי בגוגל יש לשים בן 2 ל 6 תגיות</span>
                        </i>
                    </label>
                    <p class="error">ערך נדרש</p>
                    <select data-placeholder="חפש מהרשימה או הוסף תגית חדשה" multiple class="tags-select" name="tags[]" multiple="multiple">
                        <option value=""></option>
                        <?php foreach( $tags as $tag ): ?>
                            <option value="<?= $tag->term_id ?>"><?= $tag->name ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
            </div>
        </div>

        <div class="input_container">
            <div class="media_files">
                <label for="media_files">
                    הוסף קבצים לכתבה
                    <i class="tooltip fa-solid fa-circle-question">
                        <span class="tooltiptext">הוסף קבצים:<br/>תמונות (עד 5MB)<br/>סרטונים (עד 400MB)<br/>אודיו (עד 5MB)<br/>משקל קבצים כולל לכתבה עד 400MB</span>
                    </i>
                </label>
                <input id="media_files" type="file" multiple title="הוסף קבצים לכתבה" class="video_file_field" name="media_files[]"
                       accept="image/*, audio/*, video/x-m4v, video/mpeg, video/mp4, .mkv, .avi, video/ogg, video/MPV, video/raw"/>
                <p class="total_files_size">
                    <span class="current_size_sum">0</span>/400 Mb
                </p>
                <p>
                    <span>
                        <a href="https://bit.ly/3CeWuuy" target="_blank" rel="noopener">כיווץ סרטונים</a>
                    </span>
                </p>
            </div>
        </div>

        <!--        <div class="more_content"></div>-->
        <!---->
        <!--        <div class="add_more">-->
        <!--            <div class="button_container">-->
        <!--                <button class="add_more_button content" type="button">הוסף תוכן</button>-->
        <!--            </div>-->
        <!--        </div>-->

        <div class="input_container">
            <div class="schedule_post">
                <div class="checkbox_container">
                    <label class="checkbox_inner_container">
                        תזמון כתבה
                        <input type="checkbox" name="schedule_post_checkbox"/>
                        <span class="checkmark"></span>
                    </label>
                </div>
                <div class="schedule_input_container">
                    <p>אני רוצה לפרסם את הכתבה במועד מאוחר יותר</p>
                    <input type="datetime-local" min="<?= date("Y-m-d\TH:i", strtotime("+3 hours")) ?>" name="schedule_post" onkeydown="return false"/>
                    <p class="error past_date">ניתן לבחור רק תאריכים בעתיד</p>
                    <p class="error">ערך נדרש</p>
                </div>
            </div>

            <?php if ( !$terms_approved ): ?>
                <div class="agree_to_terms_container">
                    <div class="checkbox_container">
                        <label class="checkbox_inner_container">
                            אני מאשר את <a href="/תנאי-שימוש/" target="_blank">תנאי השימוש</a> <span class="last_updated">עדכון אחרון: <?= $last_update_terms_of_use ?></span><br/>
                            <span>כאמור בתנאי השימוש, אנא הקפד לטעון רק תוכן שאתה בעל הזכויות בו או בעל הרשאת שימוש בו.</span>

                            <input type="checkbox" name="agree_to_terms"/>
                            <span class="checkmark"></span>
                        </label>
                    </div>
                </div>
            <?php endif; ?>
        </div>

        <p class="before_submit">האלגוריתם החכם שלנו ישלח את התוכן שלך עכשיו לחלק מהגולשים ברגע זה בחבורה, כשרוב הנשאלים ידווחו שהוא מתאים למגזר החרדי-דתי ומעניין הוא יעלה אוטומטית לאתר</p>

        <div class="submit_container">
            <button type="submit">שלח כתבה לאישור הגולשים
                <i class="fa-solid fa-paper-plane"></i>
            </button>
            <button class="show_old_form" type="button">לשימוש בטופס הישן, לחץ כאן</button>
        </div>
    </form>
    <div class="progress_indicator">
        <div class="imported_progress_bar">
            <p class="wait">השאר בדף עד לסיום שליחת הכתבה</p>
            <div class="abs-center container">
                <div class="abs-center front">
                    <svg viewbox="0 0 80 80" class="abs-center rad-progress">
                        <circle class="progress-background" cx="40" cy="40" r="35" />
                        <circle class="progress-bar" cx="40" cy="40" r="35" stroke-dasharray="220" stroke-dashoffset="-220" />
                        <div class="abs-center progress-label">0%</div>
                    </svg>
                </div>
                <div class="abs-center back">
                    <svg viewbox="0 0 80 80" class="abs-center alt-state">
                        <circle class="icon-background" cx="40" cy="40" r="35" fill="#21cd92" stroke="#21cd92" stroke-width="8" />
                        <div class="abs-center icon check"></div>
                        <div class="abs-center icon error"></div>
                    </svg>
                </div>
            </div>
        </div>
    </div>
    <?php
}
add_shortcode( 'upload-article-form', 'upload_article_form' );

function terms_and_conditions_again( $post_id, $post ) {
    if ( $post->post_date == $post->post_modified ) {
        return;
    }
    if ( get_the_title($post_id) == 'תנאי שימוש' ) {
        $args = array(
            'meta_query' => array(
                'key'       => 'terms_approved',
                'value'     => true,
                'compare'   => '='
            ),
        );
        $users = get_users($args);
        foreach ( $users as $user ) {
            update_field( 'terms_approved', false, 'user_'.$user->ID );
        }
    }
}
add_action( 'wp_insert_post', 'terms_and_conditions_again', 10, 2);