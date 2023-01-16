<?php
$banner_data = get_field('banner_join_1', 'options');
$banner_bg_image = $banner_data['banner_join_1_background'];
$banner_title = $banner_data['banner_join_1_title'];
$banner_content = $banner_data['banner_join_1_content'];
$banner_button = $banner_data['banner_join_1_button'];
?>

<section class="nm-join" style="background-image: url('<?php echo $banner_bg_image;?>')">
    <div class="elementor-container elementor-column-gap-default">
        <span class="tw-text-white"><?php echo $banner_title; ?></span>
        <div class="elementor-element elementor-element-264f467 elementor-widget-divider--view-line elementor-widget elementor-widget-divider"
             data-id="264f467" data-element_type="widget" data-widget_type="divider.default">
            <div class="elementor-widget-container">
                <div class="elementor-divider">
			<span class="elementor-divider-separator">
						</span>
                </div>
            </div>
        </div>
        <div class="elementor-element elementor-element-6e07deb elementor-widget elementor-widget-text-editor"
             data-id="6e07deb" data-element_type="widget" data-widget_type="text-editor.default">
            <div class="elementor-widget-container">
                <style>/*! elementor - v3.8.1 - 13-11-2022 */
					.elementor-widget-text-editor.elementor-drop-cap-view-stacked .elementor-drop-cap {
						background-color: #818a91;
						color: #fff
					}

					.elementor-widget-text-editor.elementor-drop-cap-view-framed .elementor-drop-cap {
						color: #818a91;
						border: 3px solid;
						background-color: transparent
					}

					.elementor-widget-text-editor:not(.elementor-drop-cap-view-default) .elementor-drop-cap {
						margin-top: 8px
					}

					.elementor-widget-text-editor:not(.elementor-drop-cap-view-default) .elementor-drop-cap-letter {
						width: 1em;
						height: 1em
					}

					.elementor-widget-text-editor .elementor-drop-cap {
						float: right;
						text-align: center;
						line-height: 1;
						font-size: 50px
					}

					.elementor-widget-text-editor .elementor-drop-cap-letter {
						display: inline-block
					}</style>
                <div class="elementor-text-editor elementor-clearfix">
                    <p><span style="color: #ffffff;">חבּוּרֶה בנויה מתוכן גולשים.<br>גם אתם מעוניינים לכתוב ולהשפיע?<br><strong>הצטרפו והעלו עכשיו את התוכן שלכם</strong></span>
                    </p></div>
            </div>
        </div>
        <div class="make-column-clickable-elementor elementor-column elementor-col-50 elementor-inner-column elementor-element elementor-element-c6efc8b"
             style="cursor: pointer;" data-column-clickable="https://bit.ly/3tYGBVW"
             data-column-clickable-blank="_self" data-id="c6efc8b" data-element_type="column">
            <div class="elementor-column-wrap elementor-element-populated">
                <div class="elementor-widget-wrap">
                    <div class="elementor-element elementor-element-603e0b1 elementor-widget__width-auto elementor-absolute dce_masking-none elementor-widget elementor-widget-image"
                         data-id="603e0b1" data-element_type="widget"
                         data-settings="{&quot;_position&quot;:&quot;absolute&quot;}"
                         data-widget_type="image.default">
                        <div class="elementor-widget-container">
                            <div class="elementor-image">
                                <img width="61" height="50"
                                     src="https://wordpress-668856-3151571.cloudwaysapps.com/wp-content/uploads/2022/02/icon-habura.png"
                                     class="attachment-large size-large" alt="" loading="lazy"></div>
                        </div>
                    </div>
                    <div data-dce-background-color="#CF050E"
                         class="elementor-element elementor-element-b4e1d7c elementor-align-left elementor-tablet-align-right elementor-widget elementor-widget-button"
                         data-id="b4e1d7c" data-element_type="widget" data-widget_type="button.default">
                        <div class="elementor-widget-container">
                            <div class="elementor-button-wrapper">
                                <a href="https://bit.ly/3tYGBVW"
                                   class="elementor-button-link elementor-button elementor-size-md" role="button">
						<span class="elementor-button-content-wrapper">
							<span class="elementor-button-icon elementor-align-icon-right">
				<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24.02"><defs><style>.d {
								fill: #fff;
							}</style></defs><g id="a"></g><g id="b"><g id="c"><path class="d"
                                                                                    d="M0,11.99C-.1,5.46,5.38-.22,12.37,0c3.14,.1,5.88,1.27,8.1,3.49,2.34,2.34,3.53,5.23,3.53,8.53,0,3.3-1.2,6.2-3.55,8.52-2.46,2.43-5.5,3.58-8.96,3.46C5.41,23.81-.07,18.76,0,11.99Zm20.4,6.87s.07-.09,.12-.15c1.16-1.54,1.93-3.24,2.21-5.16,.18-1.23,.15-2.44-.09-3.65-.37-1.89-1.2-3.56-2.46-5.01-1.08-1.24-2.38-2.22-3.91-2.86-1.93-.81-3.92-1.11-6.01-.76-2.11,.36-3.96,1.24-5.55,2.65-1.24,1.1-2.16,2.44-2.8,3.99-.77,1.86-.98,3.8-.69,5.76,.28,1.86,1.05,3.54,2.21,5.03,.08,.1,.33,.16,.47,.12,.38-.11,.74-.29,1.11-.42,1.29-.45,2.59-.9,3.92-1.36-.02-.43,.06-.91-.08-1.31-.37-1.08-.64-2.19-1.15-3.22-.34-.69-.55-1.48-.37-2.25,.19-.8,.15-1.58,.01-2.35-.28-1.58,.39-3.25,1.66-4.13,1.32-.91,2.77-.92,4.27-.72,2.5,.33,4.07,2.73,3.47,5.22-.11,.46-.22,1-.08,1.43,.24,.76,.18,1.46-.04,2.17-.28,.89-.62,1.75-.94,2.63-.23,.63-.46,1.26-.66,1.9-.13,.4,.06,.67,.48,.76,.13,.03,.25,.07,.38,.11,1.48,.51,2.97,1.02,4.51,1.55Zm-15.92,.96c4.49,4.34,11.39,3.78,15.01-.07-1.52-.5-3-1.02-4.5-1.48-.5-.16-.9-.4-1.01-.91-.17-.75-.05-1.49,.23-2.22,.21-.55,.39-1.12,.57-1.68,.06-.2,.06-.44,.17-.6,.59-.82,.8-1.67,.67-2.7-.11-.82-.05-1.68,.09-2.49,.18-.98-.36-2.35-1.17-2.88-1.4-.91-2.92-.92-4.39-.3-1.06,.45-1.68,1.39-1.69,2.59,0,.54,.14,1.09,.14,1.63,0,.6-.14,1.19-.14,1.79,0,.79,.19,1.54,.65,2.21,.1,.14,.18,.29,.22,.45,.09,.32,.1,.66,.23,.96,.41,.95,.58,1.93,.51,2.96-.04,.55-.29,.91-.82,1.09-1.57,.54-3.14,1.08-4.77,1.64Z"></path></g></g></svg>			</span>
						<span class="elementor-button-text">הצטרפות</span>
		</span>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
