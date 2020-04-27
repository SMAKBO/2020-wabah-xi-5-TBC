<?php

/**
 * Custom slider and the featured posts for the theme.
 */

if ( !function_exists( 'awaken_featured_posts' ) ) :

    function awaken_featured_posts() {

        $category = get_theme_mod( 'slider_category', '' );

        $slider_posts = new WP_Query( array(
                'posts_per_page' => 5,
                'cat'	=>	$category
            )
        ); 
        
        ?>

        <div class="awaken-featured-container">
            <div class="awaken-featured-slider">
                <section class="slider">
                    <div class="flexslider">
                        <ul class="slides">
                            <?php while( $slider_posts->have_posts() ) : $slider_posts->the_post(); ?>

                                <li>
                                    <div class="awaken-slider-container">
                                        <?php
                                            if ( has_post_thumbnail() ) {
                                                $thumb_id           = get_post_thumbnail_id();
                                                $thumb_url_array    = wp_get_attachment_image_src($thumb_id, 'featured-slider', true);
                                                $featured_image_url = $thumb_url_array[0]; 
                                            } else {
                                                $featured_image_url = get_template_directory_uri() . '/images/slide.jpg';
                                            }
                                        ?>
                                        <div class="awaken-slide-holder" style="background: url(<?php echo $featured_image_url; ?>);">
                                            <div class="awaken-slide-content">
                                                <div class="awaken-slider-details-container">
                                                    <a href="<?php the_permalink(); ?>" rel="bookmark"><h3 class="awaken-slider-title"><?php the_title(); ?></h3></a>
                                                </div>
                                            </div><!-- .awaken-slide-content -->
                                        </div><!--.awaken-slide-holder-->
                                    </div>
                                </li>

                            <?php endwhile; ?>
                        </ul>
                    </div>
                </section>
            </div><!-- .awaken-slider -->
            <div class="awaken-featured-posts">
                <?php

                $method = get_theme_mod( 'fposts_display_method', 'category' );

                if ( $method == "sticky" ) {
                    
                    $args = array(
                        'posts_per_page'        => 2,
                        'post__in'              => get_option( 'sticky_posts' ),
                        'ignore_sticky_posts'   => 1
                    );

                } else {
                    
                    $fposts_category = get_theme_mod( 'featured_posts_category', '' );

                    $args = array(
                        'posts_per_page'        => 2,
                        'cat'                   => $fposts_category,
                        'ignore_sticky_posts'   => 1
                    );

                }

                $fposts = new WP_Query( $args );

                while( $fposts->have_posts() ) : $fposts->the_post(); ?>

                    <div class="afp">
                        <?php
                            if ( has_post_thumbnail() ) {
                                $thumb_id           = get_post_thumbnail_id();
                                $thumb_url_array    = wp_get_attachment_image_src($thumb_id, 'featured', true);
                                $featured_image_url = $thumb_url_array[0]; 
                            } else {
                                $featured_image_url = get_template_directory_uri() . '/images/featured.jpg';
                            }
                        ?>                    
                        <div class="afpi-holder" style="background: url(<?php echo $featured_image_url; ?>);">
                            <div class="afp-content">
                                <div class="afp-title">
                                    <a href="<?php the_permalink(); ?>" rel="bookmark"><?php the_title(); ?></a>
                                </div>
                            </div><!-- .afp-content -->
                        </div><!-- .afpi-holder -->
                    </div><!-- .afp -->

                <?php endwhile; ?>

            </div>
        </div>
    <?php
    }

endif;