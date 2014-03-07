<?php
/**
 * Portfolio Single Sidebar.
 *
 * @package fluxus
 * @since fluxus 1.0
 */

$project = new PortfolioProject( get_the_ID() );

?>
<div class="sidebar sidebar-portfolio-single widget-area">

    <?php do_action( 'before_sidebar' ); ?>

    <div class="scroll-container">
        <div class="scrollbar"><div class="track"><div class="thumb"><div class="end"></div></div></div></div>
        <div class="viewport">
            <div class="overview"><?php

                if ( ! post_password_required() ) :

                    if ( $project->exists() ) : ?>
                        <hgroup><?php

                            if ( $project->meta_subtitle ) : ?>
                                <h2 class="subtitle"><?php echo $project->meta_subtitle; ?></h2><?php
                            endif;

                            ?>
                            <h1 class="title"><?php the_title(); ?></h1>
                        </hgroup><?php
                    endif;

                    $content = trim( strip_tags( $post->post_content ) );
                    if ( ! empty( $content ) ) : ?>
                        <div class="widget">
                            <div class="textwidget">
                                <?php the_content(); ?>
                            </div>
                        </div><?php
                    endif;

                    if ( $project->meta_link ) : ?>
                        <aside class="widget widget-project-info">
                            <div class="decoration"></div>
                            <h3 class="widget-title"><?php _e( 'Info', 'fluxus' ); ?></h3>
                            <a class="external-link" href="<?php echo esc_url( $project->meta_link ); ?>" target="_blank">
                                <?php _e( 'Personal website', 'fluxus' ); ?>
                            </a>
                        </aside><?php
                    endif;

                    if ( $project->meta_info && is_array( $project->meta_info ) &&
                         isset( $project->meta_info[0] ) && $project->meta_info[0] ) :

                        foreach ( $project->meta_info as $info ) : ?>
                            <aside class="widget widget-project-custom-info">
                                <div class="decoration"></div>
                                <h3 class="widget-title"><?php echo $info['title']; ?></h3>
                                <div class="widget-content">
                                    <?php echo nl2br( $info['content'] ); ?>
                                </div>
                            </aside><?php
                        endforeach;

                    endif;
                   
                    dynamic_sidebar( 'sidebar-portfolio-single' );

                else: ?>

                    <div class="password-protected-project">

                        <hgroup>
                            <h2 class="subtitle"><?php echo $project->meta_subtitle; ?></h2>
                            <h1 class="title"><?php the_title(); ?></h1>
                        </hgroup>

                        <div class="widget widget-password">
                            <div class="decoration"></div>
                            <h1 class="widget-title"><?php _e( 'Password', 'fluxus' ); ?></h1>
                            <div class="textwidget">
                                <form action="<?php echo esc_url( site_url( 'wp-login.php?action=postpass', 'login_post' ) ) ?>" method="post">
                                    <p>
                                        <?php _e( 'This post is password protected. To view it please enter your password below:', 'fluxus' ); ?>
                                    </p>
                                    <input type="submit" name="Submit" class="post-password-submit" value="<?php esc_attr_e( 'Submit', 'fluxus' ); ?>" />
                                    <input name="post_password" class="post-password" type="password" size="20" />
                                </form>
                            </div>
                        </div>

                    </div><?php

                endif; ?>

            </div>

        </div>

    </div>

</div>