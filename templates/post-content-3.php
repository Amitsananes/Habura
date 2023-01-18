<div>
    3
    <a href="<?php echo get_the_permalink($queried_post_id);?>" class="tw-block">
	    <?php echo wp_get_attachment_image( get_post_thumbnail_id($queried_post_id), 'small','', array( 'class' => 'medium-post-image' ) ); ?>
    </a>

    <a
       href="<?php echo get_the_permalink($queried_post_id);?>" class="tw-font-medium tw-text-base tw-text-black"
       style="color: #000000;"
    >
        <?php echo get_the_title($queried_post_id); ?></a>
</div>
