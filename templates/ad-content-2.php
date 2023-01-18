<a href="<?php echo get_the_permalink($ad_id);?>" class="tw-block">
	<?php echo wp_get_attachment_image( get_post_thumbnail_id($ad_id), 'small','', array( 'class' => 'medium-post-image' ) ); ?>
</a>

<a
   href="<?php echo get_the_permalink($ad_id);?>"
   class="tw-font-medium tw-text-base tw-text-black"
   style="color: #000000;"
>
    <?php echo get_the_title($ad_id); ?></a>
<div>
    <span class="tw-text-sm"><?php echo Habura::PROMOTED; ?></span>
</div>
