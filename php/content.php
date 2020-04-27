<?php
/**
 * @package Awaken
 */
?>
<div class="col-xs-12 col-sm-6 col-md-6">
<article id="post-<?php the_ID(); ?>" <?php post_class( 'genaral-post-item' ); ?>>
	<?php if ( has_post_thumbnail() ) { ?>
		<figure class="genpost-featured-image">
			<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"><?php the_post_thumbnail( 'featured' ); ?></a>
		</figure>
	<?php } else { ?>
		<figure class="genpost-featured-image">
			<a href="<?php the_permalink(); ?>">
				<img src="<?php echo get_template_directory_uri() . '/images/thumbnail-default.jpg'; ?>" />
			</a>
		</figure>
	<?php } ?>

	<header class="genpost-entry-header">
		<?php the_title( sprintf( '<h2 class="genpost-entry-title entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h2>' ); ?>

		<?php if ( 'post' == get_post_type() ) : ?>
			<div class="genpost-entry-meta">
				<?php awaken_posted_on(); ?>
			    <?php 
            		if ( get_theme_mod( 'display_post_comments', 1 ) ) {
                		if ( ! post_password_required() && ( comments_open() || '0' != get_comments_number() ) ) : ?>
                    		<span class="comments-link"><?php comments_popup_link( __( 'Comment', 'awaken' ), '1', '%' ); ?></span>
            			<?php endif; 
        			} 
        		?>
			</div><!-- .entry-meta -->
		<?php endif; ?>
	</header><!-- .entry-header -->

	<div class="genpost-entry-content">
		<?php the_excerpt(); ?>
		<?php
			wp_link_pages( array(
				'before' => '<div class="page-links">' . __( 'Pages:', 'awaken' ),
				'after'  => '</div>',
			) );
		?>
	</div><!-- .entry-content -->
</article><!-- #post-## -->
</div>