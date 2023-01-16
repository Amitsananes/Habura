<a href="<?php the_permalink();?>">
    <?php the_post_thumbnail( 'small', array( 'class' => 'small-post-image' ) ); ?>
</a>

<a href="<?php the_permalink();?>" class="tw-font-medium tw-text-base tw-text-black"><?php the_title(); ?></a>
<?php if (get_post_type() === 'adv') : ?>
<div>
    <span class="tw-text-sm"><?php echo Habura::PROMOTED; ?></span>
</div>
<?php endif; ?>
