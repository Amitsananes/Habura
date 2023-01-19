<?php

$banner_data     = get_field( 'banner_join_2', 'options');
$banner_bg_image = $banner_data['banner_join_2_background'];
$banner_title    = $banner_data['banner_join_2_title'];
$banner_button   = $banner_data['banner_join_2_button'];
?>

<a href="<?php echo esc_url($banner_button['url']);?>" class="nm-join small" style="background-image: url('<?php echo
$banner_bg_image;?>')">
    <div class="tw-w-3/4">
        <h2><?php echo $banner_title; ?></h2>
    </div>
    <div class="nm-join-button">
		<?php echo esc_html($banner_button['title']);?>
    </div>
</a>
