<?php

/**
 * Displays latest, category wised posts in a 3 block layout.
 *
 */

class Awaken_Medium_Rectangle_Ad extends WP_Widget {

	/* Register Widget with WordPress*/
	function __construct() {
		parent::__construct(
			'awaken_medium_rectangle_ad', // Base ID
			__( 'Awaken: 300x250 Ad', 'awaken' ), // Name
			array( 'description' => __( 'Displays a 300x250 ad unit.', 'awaken' ), ) // Args
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
			'title'		=>	__( 'Advertisement', 'awaken' ),
			'img_url'	=>	get_template_directory_uri()."/images/ad300.jpg",
			'dest_url'	=>	'http://www.themezhut.com'
		);
		$instance = wp_parse_args( (array) $instance, $defaults );

	?>

		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:', 'awaken' ); ?></label>
			<input type="text" class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo esc_attr($instance['title']); ?>"/>
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'img_url' ); ?>"><?php _e( 'Image Link', 'awaken' ); ?></label>
			<input type="text" class="widefat" id="<?php echo $this->get_field_id( 'img_url' ); ?>" name="<?php echo $this->get_field_name( 'img_url' ); ?>" value="<?php echo esc_url($instance['img_url']); ?>"/>
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'dest_url' ); ?>"><?php _e( 'Destination Link', 'awaken' ); ?></label>
			<input type="text" class="widefat" id="<?php echo $this->get_field_id( 'dest_url' ); ?>" name="<?php echo $this->get_field_name( 'dest_url' ); ?>" value="<?php echo esc_url($instance['dest_url']); ?>"/>
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
		$instance[ 'img_url' ]	= $new_instance[ 'img_url' ];
		$instance[ 'dest_url' ]	= $new_instance[ 'dest_url' ];
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
		$img_url = ( ! empty( $instance['img_url'] ) ) ? $instance['img_url'] : '';
		$dest_url = ( ! empty( $instance['dest_url'] ) ) ? $instance['dest_url'] : '';


		echo $before_widget;
		if ( ! empty($title) ) {
			echo $before_title. $title . $after_title;
		}
		?>

		<div class="awaken-medium-rectangle-widget">
			<figure>
				<a href="<?php echo $dest_url ?>"><img src="<?php echo $img_url; ?>"></a>
			</figure>
		</div>

<?php

	echo $after_widget;
	}


}

// register widget
function register_awaken_medium_rectangle_ad() {
    register_widget( 'Awaken_Medium_Rectangle_Ad' );
}
add_action( 'widgets_init', 'register_awaken_medium_rectangle_ad' );