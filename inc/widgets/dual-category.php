<?php

/**
 * Displays posts from two categories in a two block layout.
 */

class Awaken_Dual_Category_Posts extends WP_Widget {

	/* Register Widget with WordPress*/
	function __construct() {
		parent::__construct(
			'dual_category_posts', // Base ID
			__( 'Awaken: Two Block Posts Widget', 'awaken' ), // Name
			array( 'description' => __( 'Displays posts in a full width layout', 'awaken' ), ) // Args
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
			'title1'		=>	__( 'Latest Posts', 'awaken' ),
			'category1'		=>	'',
			'number_posts1'	=> 4,
			'sticky_posts1' => true,
			'offset1' 		=> 0,
			'title2'		=>	__( 'Latest Posts', 'awaken' ),
			'category2'		=>	'',
			'number_posts2'	=> 4,
			'sticky_posts2' => true,
			'offset2' 		=> 0			
		);
		$instance = wp_parse_args( (array) $instance, $defaults );
		$number_posts1   = isset( $instance['number_posts1'] ) ? absint( $instance['number_posts1'] ) : 4;
		$offset1	=	isset( $instance['offset1'] ) ? absint( $instance['offset1'] ) : 0;
		$number_posts2   = isset( $instance['number_posts2'] ) ? absint( $instance['number_posts2'] ) : 4;
		$offset2	=	isset( $instance['offset2'] ) ? absint( $instance['offset2'] ) : 0;

	?>
		<!-- Form for category 1 -->
		<h3> First Set of Posts </h3>
		<p>
			<label for="<?php echo $this->get_field_id( 'title1' ); ?>"><?php _e( 'Title:', 'awaken' ); ?></label>
			<input type="text" class="widefat" id="<?php echo $this->get_field_id( 'title1' ); ?>" name="<?php echo $this->get_field_name( 'title1' ); ?>" value="<?php echo esc_attr($instance['title1']); ?>"/>
		</p>
		<p>
			<label><?php _e( 'Select a post category', 'awaken' ); ?></label>
			<?php wp_dropdown_categories( array( 'name' => $this->get_field_name('category1'), 'selected' => $instance['category1'], 'show_option_all' => 'Show all posts' ) ); ?>
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'number_posts1' ); ?>"><?php _e( 'Number of posts:', 'awaken' ); ?></label>
			<input type="text" id="<?php echo $this->get_field_id( 'number_posts1' ); ?>" name="<?php echo $this->get_field_name( 'number_posts1' );?>" value="<?php echo $number_posts1; ?>" size="3"/> 
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'offset1' ); ?>"><?php _e( 'Number of posts to skip:', 'awaken' ); ?></label>
			<input type="text" id="<?php echo $this->get_field_id( 'offset1' ); ?>" name="<?php echo $this->get_field_name( 'offset1' );?>" value="<?php echo $offset1; ?>" size="3"/> 
		</p>
		<p>
			<input type="checkbox" <?php checked( $instance['sticky_posts1'], true ) ?> class="checkbox" id="<?php echo $this->get_field_id('sticky_posts1'); ?>" name="<?php echo $this->get_field_name('sticky_posts1'); ?>" />
			<label for="<?php echo $this->get_field_id('sticky_posts1'); ?>"><?php _e( 'Ignore sticky posts.', 'awaken' ); ?></label>
		</p>

		<hr />
		<!-- Form for category 2 -->
		<h3> Second Set of Posts </h3>
		<p>
			<label for="<?php echo $this->get_field_id( 'title2' ); ?>"><?php _e( 'Title:', 'awaken' ); ?></label>
			<input type="text" class="widefat" id="<?php echo $this->get_field_id( 'title2' ); ?>" name="<?php echo $this->get_field_name( 'title2' ); ?>" value="<?php echo esc_attr($instance['title2']); ?>"/>
		</p>
		<p>
			<label><?php _e( 'Select a post category', 'awaken' ); ?></label>
			<?php wp_dropdown_categories( array( 'name' => $this->get_field_name('category2'), 'selected' => $instance['category2'], 'show_option_all' => 'Show all posts' ) ); ?>
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'number_posts2' ); ?>"><?php _e( 'Number of posts:', 'awaken' ); ?></label>
			<input type="text" id="<?php echo $this->get_field_id( 'number_posts2' ); ?>" name="<?php echo $this->get_field_name( 'number_posts2' );?>" value="<?php echo $number_posts2; ?>" size="3"/> 
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'offset2' ); ?>"><?php _e( 'Number of posts to skip:', 'awaken' ); ?></label>
			<input type="text" id="<?php echo $this->get_field_id( 'offset2' ); ?>" name="<?php echo $this->get_field_name( 'offset2' );?>" value="<?php echo $offset2; ?>" size="3"/> 
		</p>
		<p>
			<input type="checkbox" <?php checked( $instance['sticky_posts2'], true ) ?> class="checkbox" id="<?php echo $this->get_field_id('sticky_posts2'); ?>" name="<?php echo $this->get_field_name('sticky_posts2'); ?>" />
			<label for="<?php echo $this->get_field_id('sticky_posts2'); ?>"><?php _e( 'Ignore sticky posts.', 'awaken' ); ?></label>
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
		$instance[ 'title1' ] = strip_tags( $new_instance[ 'title1' ] );	
		$instance[ 'category1' ]	= $new_instance[ 'category1' ];
		$instance[ 'number_posts1' ] = (int)$new_instance[ 'number_posts1' ];
		$instance[ 'sticky_posts1' ] = (bool)$new_instance[ 'sticky_posts1' ];
		$instance[ 'offset1' ] = (int)$new_instance[ 'offset1' ];
		$instance[ 'title2' ] = strip_tags( $new_instance[ 'title2' ] );	
		$instance[ 'category2' ]	= $new_instance[ 'category2' ];
		$instance[ 'number_posts2' ] = (int)$new_instance[ 'number_posts2' ];
		$instance[ 'sticky_posts2' ] = (bool)$new_instance[ 'sticky_posts2' ];
		$instance[ 'offset2' ] = (int)$new_instance[ 'offset2' ];
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

		$title1 = ( ! empty( $instance['title1'] ) ) ? $instance['title1'] : esc_html__( 'Latest Posts', 'awaken' );
		$number_posts1 = ( ! empty( $instance['number_posts1'] ) ) ? absint( $instance['number_posts1'] )  : 4; 
		$sticky_posts1 = ( isset( $instance['sticky_posts1'] ) ) ? $instance['sticky_posts1'] : true;
		$category1 = ( isset( $instance['category1'] ) ) ? $instance['category1'] : '';
		$offset1 = ( ! empty( $instance['offset1'] ) ) ? absint( $instance['offset1'] ) : 0;
		$title2 = ( ! empty( $instance['title2'] ) ) ? $instance['title2'] : esc_html__( 'Latest Posts', 'awaken' );
		$number_posts2 = ( ! empty( $instance['number_posts2'] ) ) ? absint( $instance['number_posts2'] )  : 4; 
		$sticky_posts2 = ( isset( $instance['sticky_posts2'] ) ) ? $instance['sticky_posts2'] : true;
		$category2 = ( isset( $instance['category2'] ) ) ? $instance['category2'] : '';
		$offset2 = ( ! empty( $instance['offset2'] ) ) ? absint( $instance['offset2'] ) : 0;

		// Latest Posts 1
		$latest_posts1 = new WP_Query( 
			array(
				'cat'	=>	$category1,
				'posts_per_page'	=>	$number_posts1,
				'post_status'         => 'publish',
				'ignore_sticky_posts' => $sticky_posts1,
				'offset'	=>	$offset1
				)
		);	

		// Latest Posts 2
		$latest_posts2 = new WP_Query( 
			array(
				'cat'	=>	$category2,
				'posts_per_page'	=>	$number_posts2,
				'post_status'         => 'publish',
				'ignore_sticky_posts' => $sticky_posts2,
				'offset'	=>	$offset2
				)
		);	
	echo $before_widget; 

?>
		<!-- Category 1 -->

		<div class="row">
		<div class="col-xs-12 col-sm-6 col-md-6">
		<div class="awaken-dual-category">
			<?php 
				if ( ! empty( $title1 ) ) {
					echo $before_title . $title1 . $after_title;
				}
			?>
				<?php $j = 1; ?>
				<?php 
					if ( $latest_posts1 -> have_posts() ) :
					while ( $latest_posts1 -> have_posts() ) : $latest_posts1 -> the_post(); ?>
					<?php if( $j == 1) { ?>
						<div>
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
						<div class="genpost-entry-content dmag-summary"><?php the_excerpt(); ?></div>
						</div>

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
					<?php $j++ ?>
				<?php endwhile; ?>
				<?php endif; ?>

			</div>
		</div><!-- bootstrap cols -->

		<!-- Category 2 -->

		<div class="col-xs-12 col-sm-6 col-md-6">
		<div class="awaken-dual-category">
			<?php 
				if ( ! empty( $title2 ) ) {
					echo $before_title . $title2 . $after_title;
				}
			?>
			<?php $j = 1 ?>
				
				<?php 
				if ( $latest_posts2 -> have_posts() ) :				
				while ( $latest_posts2 -> have_posts() ) : $latest_posts2 -> the_post(); ?>
					<?php if( $j == 1) { ?>
						<div>
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
						<div class="genpost-entry-content dmag-summary"><?php the_excerpt(); ?></div>
						</div>

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
					<?php $j++ ?>
				<?php endwhile; ?>
				<?php endif; ?>

			</div>
		</div><!-- bootstrap cols -->
		</div><!-- .row -->

<?php
	echo $after_widget;

	}


}

// register awaken dual category posts widget
function register_awaken_dual_category_posts() {
    register_widget( 'Awaken_Dual_Category_Posts' );
}
add_action( 'widgets_init', 'register_awaken_dual_category_posts' );