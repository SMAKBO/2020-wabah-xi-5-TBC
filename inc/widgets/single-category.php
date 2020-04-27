<?php

/**
 * Displays latest, category wised posts in a 3 block layout.
 *
 */

class Awaken_Single_Category_Posts extends WP_Widget {

	/* Register Widget with WordPress*/
	function __construct() {
		parent::__construct(
			'awaken_single_category_posts', // Base ID
			__( 'Awaken: Single Category Posts', 'awaken' ), // Name
			array( 'description' => __( 'Displays latest posts or posts from a choosen category.', 'awaken' ), ) // Args
		);
	}


	/**
	 * Back-end widget form.
	 *
	 * @see WP_Widget::form()
	 *
	 * @param array $instance Previously saved values from database.
	 */

	public function form( $instance ) {
		
		$defaults = array(
			'title'		=>	__( 'Latest Posts', 'awaken' ),
			'category'	=>	'all'
		);
		$instance = wp_parse_args( (array) $instance, $defaults );

	?>

		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:', 'awaken' ); ?></label>
			<input type="text" class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo esc_attr($instance['title']); ?>"/>
		</p>
		<p>
			<label><?php _e( 'Select a post category', 'awaken' ); ?></label>
			<?php wp_dropdown_categories( array( 'name' => $this->get_field_name('category'), 'selected' => $instance['category'], 'show_option_all' => 'Show all posts' ) ); ?>
		</p>

	<?php

	}



	/**
	 * Sanitize widget form values as they are saved.
	 *
	 * @see WP_Widget::update()
	 *
	 * @param array $new_instance Values just sent to be saved.
	 * @param array $old_instance Previously saved values from database.
	 *
	 * @return array Updated safe values to be saved.
	 */
	
	public function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$instance[ 'title' ] = strip_tags( $new_instance[ 'title' ] );	
		$instance[ 'category' ]	= $new_instance[ 'category' ];
		return $instance;
	}


	/**
	 * Front-end display of widget.
	 *
	 * @see WP_Widget::widget()
	 *
	 * @param array $args     Widget arguments.
	 * @param array $instance Saved values from database.
	 */
	
	public function widget( $args, $instance ) {
		extract($args);

		$title = ( ! empty( $instance['title'] ) ) ? $instance['title'] : esc_html__( 'Latest Posts', 'awaken' );	
		$category = ( isset( $instance['category'] ) ) ? $instance['category'] : '';
		// Latest Posts
		$latest_posts = new WP_Query( 
			array(
				'cat'				=>	$category,
				'posts_per_page'	=>	5,
				'post_status'		=>	'publish',
				'ignore_sticky_posts'=>	'true'
				)
		);	

		echo $before_widget;
		if ( ! empty($title) ) {
			echo $before_title. $title . $after_title;
		}
		?>

		<div class="awaken-one-category">
			<div class="row">
				<?php $i = 1 ?>
				<?php 
					if ( $latest_posts -> have_posts() ) :
					while ( $latest_posts -> have_posts() ) : $latest_posts -> the_post(); ?>

					<?php if( $i == 1 ) { ?>

						<div class="col-xs-12 col-sm-6 col-md-6">
							<?php if ( has_post_thumbnail() ) { ?>
								<a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_post_thumbnail( 'featured', array('title' => get_the_title()) ); ?></a>
							<?php } else { ?>
								<a href="<?php the_permalink(); ?>" rel="bookmark" title="<?php the_title(); ?>"><img  src="<?php echo get_template_directory_uri(); ?>/images/thumbnail-default.jpg" alt="<?php the_title(); ?>" /></a>
							<?php } ?>

						<?php the_title( sprintf( '<h3 class="genpost-entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h3>' ); ?>							
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
						<div class="genpost-entry-content mag-summary"><?php the_excerpt(); ?></div>
	
						</div>
						<div class="col-xs-12 col-sm-6 col-md-6">
					<?php } else { ?>
						<div class="ams-post">
							<div class="ams-thumb">
								<?php if ( has_post_thumbnail() ) { ?>
									<a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_post_thumbnail( 'small-thumb', array('title' => get_the_title()) ); ?></a>
								<?php } else { ?>
									<a href="<?php the_permalink(); ?>" rel="bookmark" title="<?php the_title(); ?>"><img  src="<?php echo get_template_directory_uri(); ?>/images/mini-thumbnail-default.jpg" alt="<?php the_title(); ?>" /></a>
								<?php } ?>
							</div>
							<div class="ams-details">
								<?php the_title( sprintf( '<h3 class="ams-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h3>' ); ?>
								<p class="ams-meta"><?php echo awaken_posted_datetime(); ?></p>
							</div>
						</div>
					<?php } ?>
					<?php $i++ ?>
				<?php endwhile; ?>
						</div><!-- .bootstrap cols -->
				<?php endif; ?>
			</div><!-- .row -->
		</div>

	<?php
		echo $after_widget;

	}


}

// Register single category posts widget
function register_awaken_single_category_posts() {
    register_widget( 'Awaken_Single_Category_Posts' );
}
add_action( 'widgets_init', 'register_awaken_single_category_posts' );