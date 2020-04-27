<?php


/**
 * Displays popular posts, comments and tags in a tabbed pane.
 */
class Awaken_Tabbed_Widget extends WP_Widget {

	/**
	 * Register widget with WordPress.
	 */
	function __construct() {
		parent::__construct(
			'awaken_tabbed_widget', // Base ID
			__( 'Awaken: Popular Posts, Tags, Comments', 'awaken' ), // Name
			array( 'description' => __( 'Displays popular posts, comments, tags in a tabbed pane.', 'awaken' ), ) // Args
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
		$nop = ! empty( $instance['nop'] ) ? absint( $instance['nop'] ) : 5;
		$noc = ! empty( $instance['noc'] ) ? absint( $instance['noc'] ) : 5;

		?>


		<p>
			<label for="<?php echo $this->get_field_id( 'nop' ); ?>"><?php _e( 'Number of popular posts:', 'awaken' ); ?></label> 
			<input class="widefat" id="<?php echo $this->get_field_id( 'nop' ); ?>" name="<?php echo $this->get_field_name( 'nop' ); ?>" type="text" value="<?php echo esc_attr( $nop ); ?>">
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'noc' ); ?>"><?php _e( 'Number of comments:', 'awaken' ); ?></label> 
			<input class="widefat" id="<?php echo $this->get_field_id( 'noc' ); ?>" name="<?php echo $this->get_field_name( 'noc' ); ?>" type="text" value="<?php echo esc_attr( $noc ); ?>">
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
		$instance = array();
		$instance['nop'] = ( ! empty( $new_instance['nop'] ) ) ? (int)( $new_instance['nop'] ) : '';
		$instance['noc'] = ( ! empty( $new_instance['noc'] ) ) ? (int)( $new_instance['noc'] ) : '';

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
		$nop = ( ! empty( $instance['nop'] ) ) ? (int)( $instance['nop'] ) : 5;
		$noc = ( ! empty( $instance['noc'] ) ) ? (int)( $instance['noc'] ) : 5;

		echo $before_widget; ?>

<ul class="nav nav-tabs" id="awt-widget">
	<li><a href="#awaken-popular" role="tab" data-toggle="tab"><?php _e( 'Popular', 'awaken' ); ?></a></li>
	<li><a href="#awaken-comments" role="tab" data-toggle="tab"><?php _e( 'Comments', 'awaken' ); ?></a></li>
	<li><a href="#awaken-tags" role="tab" data-toggle="tab"><?php _e( 'Tags', 'awaken' ); ?></a></li>
</ul>

<div class="tab-content">
	<div class="tab-pane fade active in" id="awaken-popular">
		<?php 
			$args = array( 'ignore_sticky_posts' => 1, 'posts_per_page' => $nop, 'post_status' => 'publish', 'orderby' => 'comment_count', 'order' => 'desc' );
			$popular = new WP_Query( $args );

			if ( $popular->have_posts() ) :

			while( $popular-> have_posts() ) : $popular->the_post(); ?>
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
						<p class="ams-meta"><?php the_time('F j, Y'); ?></p>
					</div>
				</div>
			<?php
			endwhile;
			endif;	
		?>
	</div><!-- .tab-pane #awaken-popular -->

	<div class="tab-pane fade" id="awaken-comments">
	<?php

		$avatar_size = 80;
		$comment_length = 90;
		$args = array(
			'number'	=> $noc,
			'status'	=> 'approve'
		);
		$comments_query = new WP_Comment_Query;
		$comments = $comments_query->query( $args );	
	
		if ( $comments ) {
			foreach ( $comments as $comment ) { ?>
				<div class="awc-container clearfix">
				<figure class="awaken_avatar">
                    <a href="<?php echo get_comment_link($comment->comment_ID); ?>">
						<?php echo get_avatar( $comment->comment_author_email, $avatar_size ); ?>     
                    </a>                               
				</figure> 
				<span class="awaken_comment_author"><?php echo get_comment_author( $comment->comment_ID ); ?> </span> - <span class="awaken_comment_post"><?php echo get_the_title($comment->comment_post_ID); ?></span>
				<p class="acmmnt-body">
					<?php comment_excerpt( $comment->comment_ID ); ?>
				</p>
				</div>
			<?php }
		} else {
			echo 'No comments found.';
		}
	?>



</div><!-- .tab-pane #awaken-comments -->
	<div class="tab-pane fade" id="awaken-tags">
		<?php        
			$tags = get_tags(array('get'=>'all'));             
			if($tags) {               
				foreach ($tags as $tag): ?>    
					<span><a href="<?php echo get_term_link($tag); ?>"><?php echo $tag->name; ?></a></span>           
					<?php            
				endforeach;       
			} else {          
				_e( 'No tags created.', 'awaken');           
			}            
		?>
	</div><!-- .tab-pane #awaken-tags-->
</div><!-- .tab-content -->		

<?php

		echo $after_widget;
	}


}

//Registster awaken tabbed widget.
function register_awaken_tabbed_widget() {
    register_widget( 'Awaken_Tabbed_Widget' );
}
add_action( 'widgets_init', 'register_awaken_tabbed_widget' ); 