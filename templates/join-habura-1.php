<?php
$banner_data = get_field('banner_join_1', 'options');
$banner_bg_image = $banner_data['banner_join_1_background'];
$banner_title = $banner_data['banner_join_1_title'];
$banner_content = $banner_data['banner_join_1_content'];
$banner_button = $banner_data['banner_join_1_button'];
?>

<a
        href="<?php echo esc_url($banner_button['url']);?>"
        class="nm-join"
        style="background-image: url('<?php echo
$banner_bg_image;?>')">
    <div class="tw-w-3/4">
        <h2><?php echo $banner_title; ?></h2>
       <div class="entry-content">
            <?php echo $banner_content; ?>
       </div>
    </div>
    <div class="nm-join-button">
		<?php echo esc_html($banner_button['title']);?>
    </div>
</a>
