<?php
/**
 * Plugin Name: Simple Twitter Widget
 * Plugin URI: https://github.com/sscovil/simple-twitter-widget
 * Description: A simple twitter feed widget.
 * Version: 0.1
 * Author: sscovil
 * Author URI: http://shaunscovil.com
 * Text Domain: simple-twitter-widget
 * License: GPL2
 */

class Simple_Twitter_Widget extends WP_Widget {

    /**
     * Register widget with WordPress.
     */
    public function __construct() {
        parent::__construct(
            'simple_twitter_widget', // Base ID
            'Simple Twitter Widget', // Name
            array( 'description' => 'Add a custom Twitter widget to your sidebar.' ) // Args
        );
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
        extract( $args );
        $title = apply_filters( 'widget_title', $instance['title'] );
        echo $before_widget;
        if ( ! empty( $title ) )
            echo $before_title . $title . $after_title;
        ?>

        <a class="twitter-timeline" data-dnt="true" href="https://twitter.com/wp_shaun" data-widget-id="310167306028326913">Tweets by @wp_shaun</a>
        <script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+"://platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script>

        <?php
        echo $after_widget;
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
        $instance['title'] = strip_tags( $new_instance['title'] );
        return $instance;
    }

    /**
     * Back-end widget form.
     *
     * @see WP_Widget::form()
     *
     * @param array $instance Previously saved values from database.
     */
    public function form( $instance ) {
        if ( isset( $instance[ 'title' ] ) ) {
            $title = $instance[ 'title' ];
        } else {
            $title = 'Twitter Feed';
        }
        ?>
        <p>
            <label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:' ); ?></label>
            <input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" />
        </p>
    <?php
    }

}
add_action( 'widgets_init', create_function( '', 'register_widget( "Simple_Twitter_Widget" );' ) );
