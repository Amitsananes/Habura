<div class="tw-border-b-2 tw-border-gray-950 tw-pb-5 tw-mb-5">
    <div class="tw-flex tw--mx-2">
        <div class="tw-px-2" style="flex: 0 0 auto;">
            <a href="<?php the_permalink();?>" class="tw-block">
                <?php the_post_thumbnail( 'small', array( 'class' => 'tw-block small-post-image' ) ); ?>
            </a>
        </div>
        <div class="tw-px-2">
                <a
                   href="<?php the_permalink();?>"
                   class="tw-font-medium tw-text-base tw-text-black"
                   style="color: #000000;">
                    <?php the_title(); ?>
                </a>
        </div>
    </div>
</div>
