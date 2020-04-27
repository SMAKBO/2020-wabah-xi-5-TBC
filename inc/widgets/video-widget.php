<?php

/**
 * Displays latest, category wised posts in a 3 block layout.
 *
 */

class Awaken_Video_Widget extends WP_Widget {

	/* Register Widget with WordPress*/
	function __construct() {
		parent::__construct(
			'awaken_video_widget', // Base ID
			__( 'Awaken: Youtube Video', 'awaken' ), // Name
			array( 'description' => __( 'Displays a youtube video.', 'awaken' ), ) // Args
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
			'title'		=>	__( 'Featured Video', 'awaken' ),
			'vid_url'	=>	'SQEQr7c0-dw'
		);
		$instance = wp_parse_args( (array) $instance, $defaults );

	?>

		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:', 'awaken' ); ?></label>
			<input type="text" class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo esc_attr($instance['title']); ?>"/>
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'vid_url' ); ?>"><?php _e( 'Youtube Video ID', 'awaken' ); ?></label>
			<input type="text" class="widefat" id="<?php echo $this->get_field_id( 'vid_url' ); ?>" name="<?php echo $this->get_field_name( 'vid_url' ); ?>" value="<?php echo esc_attr($instance['vid_url']); ?>"/>
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
		$instance[ 'vid_url' ]	= strip_tags( $new_instance[ 'vid_url' ] );
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

		$title = ( ! empty( $instance['title'] ) ) ? $instance['title'] : '';	
		$vid_url = ( ! empty( $instance['vid_url'] ) ) ? $instance['vid_url'] : '';

		echo $before_widget;
		if ( ! empty($title) ) {
			echo $before_title. $title . $after_title;
		}

		echo '<div class="awaken-video-widget video-container">';
		
		if ($vid_url) : ?>
		<iframe width="100%" height="100%" src="http://www.youtube.com/embed/<?php echo esc_attr( $vid_url ); ?>" frameborder="0" allowfullscreen></iframe>
		<?php endif;

		echo '</div>';

	echo $after_widget;
	}


}

// register widget
function register_awaken_video_widget() {
    register_widget( 'Awaken_Video_Widget' );
}
add_action( 'widgets_init', 'register_awaken_video_widget' );