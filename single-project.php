<?php
/**
 * single project post template.
 */

fluxus_add_html_class( 'horizontal-page' );

the_post();
$title = get_the_title();
$ID = get_the_ID();




/*$project = new PortfolioProject( get_the_ID() );
$project_media = $project->get_media();
$featured = $project->get_featured_media();

if ( $query->have_posts() ) {
    global $fluxus_theme;

    // Use featured image as page thumbnail.
    $image = '';
    if ( $featured->is_image() ) {
        $image = $featured->get_image_data( 'fluxus-max' );
    } else {
        $image = $featured->get_video_thumbnail( 'fluxus-max' );
    }

    if ( $image ) {
        $fluxus_theme->set_image( $image['src'] );
    }

    // Use project excerpt as page description.
    $excerpt = get_the_excerpt();
    if ( $excerpt ) {
        $fluxus_theme->set_description( $excerpt );
    }
}*/

get_header();

?>
<div id="main" class="site site-with-sidebar"><?php

    if ( ! post_password_required() ) :

        $lazy_loading = of_get_option( 'fluxus_lazy_loading' );
        $on_click_action = of_get_option( 'fluxus_project_image_click', 'disabled' );

        $portfolio_settings = array(
                'class' => 'portfolio-single horizontal-content',
                'data-loading' => __( 'Please wait...', 'fluxus' ),
                'data-lazy' => of_get_option( 'fluxus_lazy_loading' )
            );

        if ( $on_click_action != 'disabled' ) {
            $portfolio_settings['data-onclick-action'] = $on_click_action;
        }

        if ( $lazy_loading ) {
            $portfolio_settings['class'] .= ' lazy-loading';
        }

        $portfolio_settings = it_array_to_attributes( $portfolio_settings );

        ?>
        <div id="content" class="site-content">
              
            <article <?php echo $portfolio_settings; ?>><?php
				
                $index = 0;
                $qargs = array('post_type'=>'projectupdate',
                        'meta_query'=>array(array(
                            'key'=>'projectname',
                            'value'=>$ID)),
							'orderby' => 'name', 
							'order' => 'ASC' );
                
                $query = new WP_Query($qargs);
                while($query->have_posts()){
                    $query->the_post();
                    $postID = get_the_ID();
                    $thumbID = get_post_thumbnail_id($postID);
                    $img_meta = wp_get_attachment($thumbID);
                    $featured_img = wp_get_attachment_image_src( $thumbID, 'fluxus-max');
                    $display = get_post_meta($postID, "display", true);
					
				   
					  if($display == 1 || $display == 3){
					?>
					
                        <div class="horizontal-item project-image">
                            <figure>
                                 <a href="<?php the_permalink();  ?>" class=""><?php
                                   if ( $lazy_loading ) : ?>
                                      <div class="image lazy-image" data-width="<?php echo $featured_img[1]; ?>" data-height="<?php echo $featured_img[2]; ?>" data-src="<?php echo esc_url( $featured_img[0] ); ?>">
                                          <div class="loading"><?php _e( 'Please Wait', 'fluxus' ); ?></div>
                                       </div><?php
                                    else: ?>
										<img class="image" src="<?php echo esc_url( $featured_img[0] ); ?>" width="<?php echo $featured_img[1]; ?>" height="<?php echo $featured_img[2]; ?>" alt="<?php echo $img_meta['alt']?>" />                                       	   
                                    </a>
                            		<?php	 
							            endif;?>					
                                    <?php
									if ( $img_meta['caption'] ) : ?>
										<figcaption><?php echo nl2br( $img_meta['caption'] ); ?></figcaption>
									<?php
										endif;
									?>
                            </figure>
							
							
						</div>	
					<?php }
                       if($display == 2 || $display == 3){
 					?>	
						
						<div class="horizontal-item project-text">
							<?php get_template_part('content','single_column_text');?>
						</div>
						<?php }  	
                }
                wp_reset_query(); //reset to original query post

                /**
                 * Portfolio navigation & sharing.
                 */

                $disable_like_this_project = of_get_option( 'fluxus_disable_like_this_project' );
                $disable_other_projects = of_get_option( 'fluxus_disable_other_projects' );
                if ( ! ( $disable_like_this_project && $disable_other_projects ) ) : ?>
                    <nav class="portfolio-navigation"><?php
                        if ( ! $disable_like_this_project ) : ?>
                            <header<?php if ( $disable_other_projects ) { echo ' class="other-projects-disabled"'; } ?>>
                                <h3><?php _e( 'Like this project?', 'fluxus' ); ?></h3>
                                <div class="feedback-buttons"><?php

                                    $args = array(
                                            'class' => 'btn-appreciate',
                                            'title' => __( 'Appreciate', 'fluxus' ),
                                            'title_after' => __( 'Appreciated', 'fluxus' )
                                        );
                                    fluxus_appreciate( $post->ID, $args );

                                    $args = array(
                                            'id' => 'sharrre-project',
                                            'data-buttons-title' => array(
                                                    __( 'Share this project', 'fluxus' )
                                                )
                                        );
                                    $sharrre = fluxus_get_social_share( $args );
                                    if ( $sharrre ) : ?>
                                        <span class="choice"><span><?php _e( 'Or', 'fluxus' ); ?></span></span><?php
                                        echo $sharrre;
                                    endif;
                                ?>
                                </div>
                            </header><?php
                        endif; // end of Like this project?
                        if ( ! $disable_other_projects ) : ?>
                            <div class="navigation">
                                <div class="other-projects">
                                    <h3><?php _e( 'Other projects', 'fluxus' ); ?></h3>     
                                </div>
                                /**
                                 * Next / Previous / Back to portfolio buttons.
                                 */
                                <a href="<?php echo esc_url( '/' ); ?>" class="button-minimal back-portfolio">Back to Portfolio</a>
                            </div>
							<?php
                        endif; // end of Other Proejcts
                        ?>
                    </nav><?php
                endif;
                ?>
            </article>
        </div><?php
    endif; // end of !post_password_required()
    get_sidebar( 'project-single' );
    ?>
</div><?php // end of #main

get_footer(); ?>