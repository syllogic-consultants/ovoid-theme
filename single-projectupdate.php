<?php
/**
 * The Template for displaying all single posts.
 *
 * @package fluxus
 * @since fluxus 1.0
 */

get_header();

?>

<div id="main" class="site site-with-sidebar">

	<div id="content" class="site-content">
	<?php

		while ( have_posts() ) : the_post();

			$post_categories = get_the_category();
			$posted_in = false;

				if ( $post_categories && fluxus_categorized_blog() ) {

					if ( count( $post_categories ) > 1 ) {
						foreach ( $post_categories as $post_cat ) {
							if ( $post_cat->term_id != 1 ) {
							$posted_in = $post_cat;
							break;
							}
						}
					} elseif ( !in_category( 1 ) ) {
						$posted_in = $post_categories[0];
					}

				}

	?>
			<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
				<header class="entry-header"><?php

					$post_data = fluxus_standard_post_get_data( get_the_ID() );

					/**
					 * If a standard post has a featured image and user wish to shows it OR
					 * if link or quote post has a featured image.
					 */
					//if ( ( has_post_thumbnail() && $post_data['show_featured_image'] && !get_post_format() ) ||
						 //( has_post_thumbnail() && in_array( get_post_format(), array( 'quote', 'link' ) ) ) ) :

						$image = it_get_post_thumbnail( get_the_ID(), 'fluxus-max', true );

						?>
						<div class="post-image">
							<img src="<?php echo esc_url( $image[0] ); ?>" width="<?php echo $image[1]; ?>" height="<?php echo $image[2]; ?>" alt="" />
							
								<div class="cover">
									<h1><?php the_title(); ?></h1>
									<?php

										if ( $posted_in ) {
											printf( '<p>' . __( 'posted in %s', 'fluxus' ) . '</p> ', '<a href="' . esc_url( get_category_link( $posted_in->term_id ) ) . '">' . $posted_in->name . '</a>' );
										}

									?>
								</div>
								<?php

							//endif;

							?>
						</div>
					
					<h1 class="entry-title">
						<?php the_title(); ?>	
					</h1>
					<h2>
						<?php get_post_custom_values('projectname',get_the_ID()); ?>
					</h2>
					<div class="entry-meta">
						<?php
							fluxus_posted_by();
							fluxus_posted_on();
							fluxus_comment_count();
						?>
					</div>

				</header>

					<div class="entry-content">
						<?php
							$content = the_content();
							$loop = new WP_Query( array( 'post_type' => array('projectupdate')&'post_status=publish'));
							if ( $loop->have_posts() ) : $loop->the_post(); ?>
							
						<?php endif; ?>
						<?php echo $content ?>
						<div class="entry-navigation"><?php
							the_fluxus_tags( __( 'tagged with', 'fluxus' ) );
							fluxus_post_nav(); ?>
						</div>
						<?php edit_post_link( __( 'Edit', 'fluxus' ), '<span class="edit-link">', '</span>' ); ?>
					</div>

			</article>


		<?php endwhile; ?>

	</div>

	<?php get_sidebar( 'post' ); ?>

</div>

<?php get_footer(); ?>