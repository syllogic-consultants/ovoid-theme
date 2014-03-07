<?php
/**
 * single_column_text.
 *
 * @package fluxus
 * @since fluxus 1.0
 */


?>
<div class="sidebar1 sidebar-portfolio-single widget-area">


    <div class="scroll-container">
        <div class="scrollbar"><div class="track"><div class="thumb"><div class="end"></div></div></div></div>
        <div class="viewport">
            <div class="overview">

                <hgroup>
                    <h1 class="title"><?php the_title(); ?></h1>
                </hgroup><?php

                $content = trim( strip_tags( $post->post_content ) );
                if ( ! empty( $content ) ) : ?>
                    <div class="widget">
                        <div class="textwidget">
                            <?php the_content(); ?>
							
                        </div>
                    </div>
				<?php endif; ?>
				<aside class="widget widget-project-custom-info">
                            <div class="decoration"></div>
                            <h3 class="widget-title"><?php echo $info['title']; ?></h3>
                            <div class="widget-content">
                                <?php echo nl2br( $info['content'] ); ?>
                            </div>
                        </aside><?php

                dynamic_sidebar( 'sidebar-project-single' ); ?>
            </div>

        </div>

    </div>
	

</div>

    