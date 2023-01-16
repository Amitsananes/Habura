<div class="tw-border-b-2 tw-border-gray-950 tw-pb-5 tw-mb-5">
    <div class="tw-flex tw--mx-2">
        <div class="tw-px-2">
            <a href="<?php the_permalink();?>">
                <?php the_post_thumbnail( 'small', array( 'class' => 'small-post-image' ) ); ?>
            </a>
        </div>
        <div class="tw-px-2">
                <a href="<?php the_permalink();?>" class="tw-font-medium tw-text-base tw-text-black"><?php the_title(); ?></a>
        </div>
    </div>
</div>
