<?php
/**
 * The template for displaying search results pages.
 *
 * @package Awaken
 */

get_header(); ?>
<div class="row">
<?php is_rtl() ? $rtl = 'awaken-rtl' : $rtl = ''; ?>
<div class="col-xs-12 col-sm-12 col-md-8 <?php echo $rtl ?>">
	<section id="primary" class="content-area">
		<main id="main" class="site-main" role="main">

		<?php if ( have_posts() ) : ?>

			<header class="search-page-header">
				<h1 class="search-page-title"><?php printf( __( '<span class="search-title-span">Search Results for : </span> %s', 'awaken' ), '<span>' . get_search_query() . '</span>' ); ?></h1>
			</header><!-- .page-header -->

			<?php /* Start the Loop */ 
				$counter = 0;
			?>
			<div class="row">
			<?php while ( have_posts() ) : the_post(); ?>

				<?php
				/**
				 * Run the loop for the search to output the results.
				 * If you want to overload this in a child theme then include a file
				 * called content-search.php and that will be used instead.
				 */
				get_template_part( 'content', 'search' );
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
