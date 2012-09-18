<?php
/*
Plugin Name: MindBody Widget Plugin
Plugin URI: 
Description: 
Author: Richard Testani, Clint Warren
Version: 1.0
*/

//Or, visit https://clients.mindbodyonline.com/ASP/home.asp?studioid=29886, which is the your MINDBODY URL. We suggest you bookmark it.
//Login using the following:
// Username: owner
// Temporary password: trainer1

// http://support.mindbodyonline.com/entries/21301433-how-to-issue-api-credentials/
// Source Name: ClintonWarrenWebDesign   Key:   NnGTlQnl6Pl2iHN/iQ9tCJX35Mg=

//use and action hook to register our new widget
add_action('widgets_init', 'mb_register_widgets');

function mb_register_widgets() {
	register_widget('mb_widget');
}


//declare the new widget, extending the WP_Widget class
class mb_widget extends WP_Widget {
	
	//processes the new widget
	function mb_widget() {
		$widget_ops = array (
			'classname' => 'mb_widget_class',
			'description' => 'Displays upcoming classes from MindBody Online'
		
		);
		$this->WP_Widget ( 'mb_widget', 'Mindbody Online Widget', $widget_ops );
	}
	
	//build the widget settings form
	function form($instance) {
	
		$defaults = array();
		$instance = wp_parse_args( (array) $instance, $defaults);
		$username = $instance['username'];
		$password = $instance['password'];
		?>
		<p>Username: <input class="widefat" name="<?php echo $this->get_field_name('username');?>" type="text" value="<?php echo esc_attr($username);?>"/></p>
		<p>Password: <input class="widefat" name="<?php echo $this->get_field_name('password');?>" type="text" value="<?php echo esc_attr($password);?>"/></p>
	<?php
	}
	
	function update($new_instance, $old_instance){
	//processes widget options to save
		$instance = $old_instance;
		$instance['username'] = strip_tags($new_instance['username'] );
		$instance['password'] = strip_tags($new_instance['password']);
					
		return $instance;
	}
	
	function widget($args, $instance){
	//displays the widget
		extract($args);
		
		echo $before_widget;
		
		//load the widget settings
		$title = apply_filters('widget_title', $instance['username']);
		$password = empty($instance['password'] ) ? '' : $instance['password'];
		
		//output content here
		
			
		echo $after_widget;
		
		
	}
}
