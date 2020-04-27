<?php

/**
 * Displays latest or category wised posts in a 3 block layout.
 */

class awaken_three_block_posts extends WP_Widget {

	/* Register Widget with WordPress*/
	function __construct() {
		parent::__construct(
			'three_block_widget', // Base ID
			__( 'Awaken: Three Block Posts Widget', 'awaken' ), // Name
			array( 'description' => __( 'Displays posts by three blocks per row.', 'awaken' ), ) // Args
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
		//print_r($instance);
		$defaults = array(
			'title'		=>	__( 'Latest Posts', 'awaken' ),
			'category'	=>	'',
			'number_posts'	=> 3,
			'sticky_posts' => true,
			'offset' => 0
		);
		$instance = wp_parse_args( (array) $instance, $defaults );
		$number_posts   = isset( $instance['number_posts'] ) ? absint( $instance['number_posts'] ) : 3;
		$offset	=	isset( $instance['offset'] ) ? absint( $instance['offset'] ) : 0;

	?>

		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:', 'awaken' ); ?></label>
			<input type="text" class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo esc_attr($instance['title']); ?>"/>
		</p>
		<p>
			<label><?php _e( 'Select a post category', 'awaken' ); ?></label>
			<?php wp_dropdown_categories( array( 'name' => $this->get_field_name('category'), 'selected' => $instance['category'], 'show_option_all' => 'Show all posts' ) ); ?>
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'number_posts' ); ?>"><?php _e( 'Number of posts:', 'awaken' ); ?></label>
			<input type="text" id="<?php echo $this->get_field_id( 'number_posts' ); ?>" name="<?php echo $this->get_field_name( 'number_posts' );?>" value="<?php echo $number_posts; ?>" size="3"/> 
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'offset' ); ?>"><?php _e( 'Number of posts to skip:', 'awaken' ); ?></label>
			<input type="text" id="<?php echo $this->get_field_id( 'offset' ); ?>" name="<?php echo $this->get_field_name( 'offset' );?>" value="<?php echo $offset; ?>" size="3"/> 
		</p>
		<p>
			<input type="checkbox" <?php checked( $instance['sticky_posts'], true ) ?> class="checkbox" id="<?php echo $this->get_field_id('sticky_posts'); ?>" name="<?php echo $this->get_field_name('sticky_posts'); ?>" />
			<label for="<?php echo $this->get_field_id('sticky_posts'); ?>"><?php _e( 'Ignore sticky posts.', 'awaken' ); ?></label>
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
		$instance[ 'number_posts' ] = (int)$new_instance[ 'number_posts' ];
		$instance[ 'sticky_posts' ] = (bool)$new_instance[ 'sticky_posts' ];
		$instance[ 'offset' ] = (int)$new_instance[ 'offset' ];
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
		$number_posts = ( ! empty( $instance['number_posts'] ) ) ? absint( $instance['number_posts'] ) : 3;
		$sticky_posts = ( isset( $instance['sticky_posts'] ) ) ? $instance['sticky_posts'] : true;
		$category = ( isset( $instance['category'] ) ) ? $instance['category'] : '';
		$offset = ( ! empty( $instance['offset'] ) ) ? absint( $instance['offset'] ) : 0;
		// Latest Posts
		$latest_posts = new WP_Query( 
			array(
				'cat'					=> $category,
				'posts_per_page'		=> $number_posts,
				'post_status'         	=> 'publish',
				'ignore_sticky_posts' 	=> $sticky_posts,
				'offset'				=> $offset
				)
		);	

		echo $before_widget;
		if ( ! empty( $title ) ) {
			echo $before_title . $title . $after_title;
		}
		?>

		<div class="awaken-3latest">
			<div class="row">
				<?php $i = 1; ?>
				<?php 
				if ( $latest_posts -> have_posts() ) :
					while ( $latest_posts -> have_posts() ) : $latest_posts -> the_post(); ?>

					<div class="col-xs-12 col-sm-4 col-md-4">
						<div class="awaken-block-post">
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
						</div><!-- .awaken-block-post-->
					</div><!-- .bootstrap-cols -->

					<?php if( $i%3 == 0 ) {
						echo '</div><!--.row--><div class="row">';
					} ?>
					<?php $i++; ?>
				<?php endwhile; ?>
				<?php endif; ?>
			</div><!-- .row -->
		</div>

	<?php
		echo $after_widget;

	}


}

// register awaken three block posts widget
function register_awaken_three_block_posts() {
    register_widget( 'awaken_three_block_posts' );
}
add_action( 'widgets_init', 'register_awaken_three_block_posts' );