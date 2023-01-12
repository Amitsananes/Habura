jQuery(document).on("ready", function() {
    let offset = 39;
    let loaded = false;
    let load_more_on_offset = document.getElementsByClassName('section-5-wrap')[0].offsetTop;

    if (!loaded && jQuery(document).scrollTop() >= load_more_on_offset) {
        loaded = true;
        load_more_on_offset = document.getElementsByClassName('elementor-location-footer')[0].offsetTop;
        load_more_posts(offset);
        offset += 10;
        loaded = false;
    }

    document.addEventListener('scroll', function () {
        if (!loaded && jQuery(document).scrollTop() >= load_more_on_offset) {
            loaded = true;
            load_more_on_offset = document.getElementsByClassName('elementor-location-footer')[0].offsetTop;
            load_more_posts(offset);
            offset += 10;
            loaded = false;
        }
    });
});

function load_more_posts(offset) {
    const xhttp = new XMLHttpRequest();
    xhttp.onload = function() {
        let posts = JSON.parse(this.responseText)['data'];
        let posts_container = document.getElementById('section-5-posts');
        if (posts.length > 0) {
            posts.forEach(function(post) {
                posts_container.innerHTML += '<hr/>' +
                    '<a href="'+post['permalink']+'">' +
                    '                                <div class="section-5-post">' +
                    '                                    <div class="section-5-post-right">' +
                    '                                        <img src="'+post['thumbnail']+'" alt="">' +
                    '                                    </div>' +
                    '                                    <div class="section-5-post-left">' +
                    '                                        <h2 class="section-5-left-h2">'+post['title']+'</h2>' +
                    '                                        <!-- <p class="section-5-left-p"><?php //echo wp_trim_words((strip_tags( $posts[28 + $i]->post_content)), 23, "..."); ?></p> -->' +
                    '                                        <p class="section-5-left-p">'+post['excerpt']+'</p>' +
                    '                                        <div class="section-5-left-foot">' +
                    '                                            <span>'+post['author_fname']+' '+post['author_lname']+'</span>' +
                    '                                        </div>' +
                    '                                    </div>' +
                    '                                </div>' +
                    '                            </a>';
            });
        }
    }
    xhttp.open('POST', '/wp-admin/admin-ajax.php?action='+author_ajax.action+'&nonce='+author_ajax.nonce+"&author_id="+author_ajax.author_id+"&offset="+offset);
    xhttp.send();
}