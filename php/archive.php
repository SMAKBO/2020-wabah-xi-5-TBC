<?php
/**
 * The template for displaying archive pages.
 *
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package Awaken
 */

get_header(); ?>
<div class="row">
<?php is_rtl() ? $rtl = 'awaken-rtl' : $rtl = ''; ?>
<div class="col-xs-12 col-sm-6 col-md-8 <?php echo $rtl ?>">
	<section id="primary" class="content-area">
		<main id="main" class="site-main" role="main">

		<?php if ( have_posts() ) : ?>

			<header class="archive-page-header">
				<h1 class="archive-page-title">
					<?php
						if ( is_category() ) :
							single_cat_title();

						elseif ( is_tag() ) :
							single_tag_title();

						elseif ( is_author() ) :
							echo '<div class="archive-title-span">';
							_e( 'Author', 'awaken' ); 
							echo '</div>';
							echo get_the_author();

						elseif ( is_day() ) :
							echo '<div class="archive-title-span">';
							_e( 'Date', 'awaken' ); 
							echo '</div>';
							echo get_the_date();

						elseif ( is_month() ) :
							echo '<div class="archive-title-span">';
							_e( 'Month', 'awaken' ); 
							echo '</div>';
							echo get_the_date( _x( 'F Y', 'monthly archives date format', 'awaken' ) );

						elseif ( is_year() ) :
							echo '<div class="archive-title-span">';
							_e( 'Year', 'awaken' ); 
							echo '</div>';
							echo get_the_date( _x( 'Y', 'yearly archives date format', 'awaken' ) );

						elseif ( is_tax( 'post_format', 'post-format-aside' ) ) :
							_e( 'Asides', 'awaken' );

						elseif ( is_tax( 'post_format', 'post-format-gallery' ) ) :
							_e( 'Galleries', 'awaken' );

						elseif ( is_tax( 'post_format', 'post-format-image' ) ) :
							_e( 'Images', 'awaken' );

						elseif ( is_tax( 'post_format', 'post-format-video' ) ) :
							_e( 'Videos', 'awaken' );

						elseif ( is_tax( 'post_format', 'post-format-quote' ) ) :
							_e( 'Quotes', 'awaken' );

						elseif ( is_tax( 'post_format', 'post-format-link' ) ) :
							_e( 'Links', 'awaken' );

						elseif ( is_tax( 'post_format', 'post-format-status' ) ) :
							_e( 'Statuses', 'awaken' );

						elseif ( is_tax( 'post_format', 'post-format-audio' ) ) :
							_e( 'Audios', 'awaken' );

						elseif ( is_tax( 'post_format', 'post-format-chat' ) ) :
							_e( 'Chats', 'awaken' );

						else :
							_e( 'Archives', 'awaken' );

						endif;
					?>
				</h1>

			</header><!-- .page-header -->
            <?php
                // Show an optional term description.
                $term_description = term_description();
                if ( ! empty( $term_description ) ) :
                    printf( '<div class="taxonomy-description">%s</div>', $term_description );
                endif;
            ?>
			<?php /* Start the Loop */
				$counter = 0;
			 ?>
			<div class="row">
			<?php while ( have_posts() ) : the_post(); ?>

				<?php
					/* Include the Post-Format-specific template for the content.
					 * If you want to override this in a child theme, then include a file
					 * called content-___.php (where ___ is the Post Format name) and that will be used instead.
					 */
					get_template_part( 'content', get_post_format() );
				?>
				<?php $counter++;
					if ($counter % 2 == 0) {
						echo '</div><div class="row">';
				 	} 
				?>
			<?php endwhile; ?>

			<div class="col-xs-12 col-sm-12 col-md-12">
				<?php awaken_paging_nav(); ?>
			</div>
		</div><!-- .row -->

		<?php else : ?>

			<?php get_template_part( 'content', 'none' ); ?>

		<?php endif; ?>

		</main><!-- #main -->
	</section><!-- #primary -->

</div><!-- .bootstrap cols -->
<div class="col-xs-12 col-sm-6 col-md-4">
	<?php get_sidebar(); ?>
</div><!-- .bootstrap cols -->
</div><!-- .row -->
<?php get_footer(); ?>
