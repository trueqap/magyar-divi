<?php
// Prevent file from being loaded directly
if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
}

class ET_Authors_Widget_Hun extends WP_Widget {

	function __construct() {
		parent::__construct(
			'et_authors_hu',
			esc_html__( 'Extra - szerzők - magyar', 'extra' ),
			array(
				'description' => esc_html__( 'Javítja a fordítási hibákat.', 'extra' ),
			)
		);
	}

	public function widget( $args, $instance ) {
		$query_args = array(
			'who'     => 'authors',
			'order'   => 'ASC',
			'orderby' => 'display_name',
		);

		$authors = get_users( $query_args );

		echo $args['before_widget'];
		if ( ! empty( $instance['title'] ) ) {
			echo $args['before_title'] . apply_filters( 'widget_title', $instance['title'] ). $args['after_title'];
		}
		?>
		<div class="widget_content">
			<ul class="widget_list">
				<?php
				foreach ( $authors as $author ) {
					$count = count_user_posts( $author->ID );
					$count = sprintf( _n( '%d Post', '%d Posts', $count,'extra'), $count );
					$url = get_author_posts_url( $author->ID );
				
					if ($count > 0) {

					
				?>

				<li>
					<a href="<?php echo esc_url( $url ); ?>" class="widget_list_portrait" rel="author">
						<?php echo get_avatar( $author->ID, 150, 'mystery', esc_attr( $author->display_name ) ); ?>
					</a>
					<a href="<?php echo esc_url( $url ); ?>" class="widget_list_author">
						<h3 class="title"><?php echo esc_html( $author->display_name ); ?></h3>
						<span class="post-meta"><?php echo esc_html( $count ); ?></span>
					</a>
				</li>
				<?php 
			}} ?>
			</ul>
		</div>
		<?php
		echo $args['after_widget'];
	}

	public function form( $instance ) {
		$title = isset( $instance[ 'title' ] ) ? $instance[ 'title' ] : esc_html__( 'Our Authors', 'extra' );
		?>
		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php esc_html_e( 'Title:', 'extra' ); ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" />
		</p>
		<?php
	}

	public function update( $new_instance, $old_instance ) {
		$instance = array();
		$instance['title'] = ( ! empty( $new_instance['title'] ) ) ? sanitize_text_field( $new_instance['title'] ) : '';

		return $instance;
	}

}

function extra_widgets_init_hun() {

	register_widget( 'ET_Authors_Widget_Hun' );

}

function extra_widgets_init_widgets_hun( $framework_widgets ) {
	foreach ($framework_widgets as $key => $framework_widget) {
		if ( 'ET_Ad_Widget' == $framework_widget ) {
			unset( $framework_widgets[$key] );
		}
	}

	return $framework_widgets;
}

if (wp_get_theme() == 'Extra' || wp_get_theme()->parent() == 'Extra' || strpos(@$theme->Name, 'Extra') !== false) {
	add_action( 'et_widgets_init_widgets', 'extra_widgets_init_widgets_hun' );
	add_action( 'widgets_init', 'extra_widgets_init_hun' );
}


