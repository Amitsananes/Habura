<div class="tw-border-b-2 tw-border-gray-950 tw-pb-5 tw-mb-5">
	<div class="tw-flex tw--mx-2">
		<div class="tw-px-2" style="flex: 0 0 auto;">
			<a href="<?php echo get_the_permalink( $ad_id ); ?>" class="tw-block">
				<?php echo wp_get_attachment_image( get_post_thumbnail_id( $ad_id ), 'small', '', array( 'class' => 'tw-block small-post-image' ) ); ?>
			</a>
		</div>
		<div class="tw-px-2">
				<a
                    href="<?php echo get_the_permalink( $ad_id ); ?>"
                    class="tw-font-medium tw-text-base tw-text-black"
                    style="color: #000000;"
                >
                    <?php echo get_the_title( $ad_id ); ?></a>
                <div>
                    <span class="tw-text-sm"><?php echo Habura::PROMOTED; ?></span>
                </div>
		</div>
	</div>
</div>
