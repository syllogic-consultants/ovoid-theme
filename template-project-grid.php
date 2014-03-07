<?php
/*
Template Name: Grid Project
*/

fluxus_add_html_class( 'horizontal-page layout-portfolio-grid' );

get_header();

$columns = false;
$rows = false;
$images = array();

if ( is_page() ) {
    //fluxus_query_portfolio();
    $qargs = array('post_type' => 'project');
    $query = new WP_Query($qargs);
} else {
    // This is a project type page
    $grid_size = fluxus_project_type_grid_size( get_queried_object()->term_id );
    if ( $grid_size ) {
        list ( $columns, $rows ) = $grid_size;
    }
}

if ( $query->have_posts() ) :
    
    $grid_portfolio = new GridPortfolio( get_the_ID() );

    if ( ! $columns || ! $rows ) {
        $columns = $grid_portfolio->get_grid_column_count();
        $rows = $grid_portfolio->get_grid_row_count();
    }

    ?>
    <div id="main" class="site">

        <div class="portfolio-grid" data-columns="<?php echo $columns; ?>" data-rows="<?php echo $rows; ?>"><?php

            while ( $query->have_posts() ) :

                $query->the_post();

                //$project = new PortfolioProject( get_the_ID() );
                //$featured = $project->get_featured_media();
                $postID = get_the_ID();
                $thumbID = get_post_thumbnail_id($postID);
                $featured_url = wp_get_attachment_url( $thumbID, 'fluxus-thumbnail');
                $category = get_the_category();
                if ( ! $featured_url ) continue; // We have no media on this project, nothing to show.

                /*$image = $featured->is_image() ? $featured->get_image_data( 'fluxus-thumbnail' )
                                               : $image = $featured->get_video_thumbnail( 'fluxus-thumbnail' );*/

                /*if ( $image ) {
                    $image = $image['src'];
                    $images[] = $image;
                } else {
                    $image = FLUXUS_IMAGES_URI . '/no-portfolio-thumbnail.png';
                }*/

                ?>
                <article class="grid-project">
                    <a href="<?php the_permalink(); ?>" class="preview" style="background-image: url(<?php echo esc_url( $featured_url ); ?>);">
                        <span class="hover-box">
                            <span class="inner"><?php
                                if ( $category ) : ?>
                                    <i><?php echo $category[0]->cat_name; ?></i><?php
                                endif; ?>
                                <b><?php the_title(); ?></b>
                                <!--?php if ( post_password_required() ) : ?-->
                                    <!--span class="password-required"-->
                                        <!--?php _e( 'Password required', 'fluxus' ); ?-->
                                    <!--/span-->
                                <!--?php endif; ?-->
                            </span>
                        </span>
                    </a>
                </article><?php

            endwhile;

            // For Pinterest, Facebook and others 
            ?>
            <div class="hide">
                <img src="<?php echo esc_url( $featured_url ); ?>" alt="" />
            </div>

        </div>

    </div>

<?php

endif;

wp_reset_query();

get_footer();