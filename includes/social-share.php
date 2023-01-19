<?php

function nm_get_the_post_thumbnail_src($img)
{
	return (preg_match('~\bsrc="([^"]++)"~', $img, $matches)) ? $matches[1] : '';
}

function nm_social_buttons($content) {
	global $post;
	if(is_singular() || is_home()){
		$sb_url = urlencode(get_permalink());
		$sb_title = str_replace( ' ', '%20', get_the_title());
		$sb_thumb = nm_get_the_post_thumbnail_src(get_the_post_thumbnail());

		$twitterURL = 'https://twitter.com/intent/tweet?text='.$sb_title.'&amp;url='.$sb_url.'&amp;via=wpvkp';
		$facebookURL = 'https://www.facebook.com/sharer/sharer.php?u='.$sb_url;
		$whatsappURL = 'https://api.whatsapp.com/send?text='.$sb_title . ' ' . $sb_url;
		$emailURL = "mailto:?subject='. Habura::RECOMMENDATION .' '. $sb_title .'&amp; body='. $sb_url.'";

		$content .= '<a class="twitter" href="'. $twitterURL .'" title="'. Habura::SHARE_ON_TWITTER.'" target="_blank" rel="nofollow"><i class="fab fa-twitter"></i></a>';
		$content .= '<a class="facebook" href="'.$facebookURL.'" title="'. Habura::SHARE_ON_FACEBOOK.'" target="_blank" rel="nofollow"><i class="fab fa-facebook"></i></a>';
		$content .= '<a class="whatsapp" href="'.$whatsappURL.'" title="'. Habura::SHARE_ON_WHATSAPP.'" target="_blank" rel="nofollow"><i class="fab fa-whatsapp"></i></a>';
		$content .= '<a class="email" href="'.$emailURL.'" title="'. Habura::SHARE_ON_EMAIL.'" target="_blank" rel="nofollow"><i class="fas fa-envelope"></i></a>';

		return $content;
	}else{
		return $content;
	}
};

// Enable the_content if you want to automatically show social buttons below your post.
//add_filter( 'the_content', 'nm_social_buttons');

add_shortcode('social','nm_social_buttons');
