<?php
/**
 * @package Awaken
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="single-entry-header">
		<?php the_title( '<h1 class="single-entry-title entry-title">', '</h1>' ); ?>

		<div class="single-entry-meta">
			<?php awaken_posted_on(); ?>
			<?php edit_post_link( __( 'Edit', 'awaken' ), '<span class="edit-link">', '</span>' ); ?>
		</div><!-- .entry-meta -->
	</header><!-- .entry-header -->

	<?php awaken_featured_image(); ?>

	<div class="entry-content">
		<?php the_content(); ?>
		<?php
			wp_link_pages( array(
				'before' => '<div class="page-links">' . __( 'Pages:', 'awaken' ),
				'after'  => '</div>',
			) );
		?>
	</div><!-- .entry-content -->

	<footer class="single-entry-footer">
		<?php
			/* translators: used between list items, there is a space after the comma */
			$category_list = get_the_category_list( __( ' ', 'awaken' ) );

			/* translators: used between list items, there is a space after the comma */
			$tag_list = get_the_tag_list( '', __( ' ', 'awaken' ) );

			if ( awaken_categorized_blog() ) {
				echo '<div class="categorized-under">';
					_e( 'Posted Under', 'awaken' );
				echo '</div>';
				echo '<div class="awaken-category-list">' . $category_list . '</div>';
				echo '<div class="clearfix"></div>';
			}

			if ( '' != $tag_list ) {
				echo '<div class="tagged-under">';
					_e( 'Tagged', 'awaken' );
				echo '</div>';
				echo '<div class="awaken-tag-list">' . $tag_list . '</div>';
				echo '<div class="clearfix"></div>';	
			}
		?>

	</footer><!-- .entry-footer -->
</article><!-- #post-## -->
