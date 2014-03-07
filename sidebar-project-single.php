<?php
/**
 * Project Single Sidebar.
 *
 * @package fluxus
 * @since fluxus 1.0
 */

//$project = new PortfolioProject( get_the_ID() );

?>
<div class="sidebar sidebar-portfolio-single widget-area">

    <?php do_action( 'before_sidebar' ); ?>

    <div class="scroll-container">
        <div class="scrollbar"><div class="track"><div class="thumb"><div class="end"></div></div></div></div>
        <div class="viewport">
            <div class="overview">

                <hgroup><!--?php

                    //if ( $project->meta_subtitle ) : ?-->
                        <!--h2 class="subtitle"><!--?php echo $project->meta_subtitle; ?--><!--/h2-->
                        <!--?php
                    //endif;

                    ?-->
                    <h1 class="title"><?php the_title(); ?></h1>
                </hgroup><?php

                $content = trim( strip_tags( $post->post_content ) );
                if ( ! empty( $content ) ) : ?>
                    <div class="widget">
                        <div class="textwidget">
                            <?php the_content(); ?>
                        </div>
                    </div>
					
					
					
					
					
					<?php
                endif;

                //if ( $project->meta_info && is_array( $project->meta_info ) &&
                //     isset( $project->meta_info[0] ) && $project->meta_info[0] ) :

                //    foreach ( $project->meta_info as $info ) : 
                ?>
                        <aside class="widget widget-project-custom-info">
                            <div class="decoration"></div>
                            <h3 class="widget-title"><?php echo $info['title']; ?></h3>
                            <div class="widget-content">
                                <?php echo nl2br( $info['content'] ); ?>
                            </div>
                        </aside><?php
                 //   endforeach;

                //endif;

                dynamic_sidebar( 'sidebar-project-single' ); ?>

            </div>

        </div>

    </div>
	

</div>

    