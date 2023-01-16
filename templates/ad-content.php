<div class="tw-border-b-2 tw-border-gray-950 tw-pb-5 tw-mb-5">
    <div class="tw-flex tw--mx-2">
        <div class="tw-px-2">
            <a href="<?php get_the_permalink($ad_id);?>">
                <?php the_post_thumbnail( 'small', array( 'class' => 'small-post-image' ) ); ?>
            </a>
        </div>
        <div class="tw-px-2">
                <a href="<?php get_the_permalink($ad_id);?>" class="tw-font-medium tw-text-base tw-text-black"><?php
                    get_the_title($ad_id); ?></a>
                    <div>
                        <span class="tw-text-sm"><?php echo Habura::PROMOTED; ?></span>
                    </div>
        </div>
    </div>
</div>
