<?php

/*
 * wizet to contrl the login and registration button
 */

class PopUpLoginWizet extends WP_Widget{
	
	//constructor function that calls the parent constructor
	function PopUpLoginWizet(){
		$widget_ops = array( 'classname' => 'popupLogin_Widget', 'description' => __('A widget that allows the user to show the popup login button', 'lrb') );

		/* Widget control settings. */
		//$control_ops = array( 'width' => 850, 'height' => 350, 'id_base' => 'popuplogin-widget' );

		/* Create the widget. */
		$this->WP_Widget( 'popuplogin-widget', __('Login Registration Button', 'lrb'), $widget_ops, $control_ops );
		
	}
	
	/*
	 * the fornt-end view of the widget
	 * @see WP_Widget::widget 
	 */
	function widget($args, $instance){
		if(is_user_logged_in()) return;
		
		 extract($args);
		 $title = apply_filters('widget_title', $instance['title']);
		 $buttonNname = $instance['buttonNname'];
		 $registrationNname = $instance['registrationNname'];
		?>
			<?php echo $before_widget; ?>
				 <?php// if ( $title ) echo $before_title . $title . $after_title; ?>
					
					
					<input type="submit" name="loign-button" class="popup-login" value="<?php echo $buttonNname;?>" /> 
					
					<input type="submit" class="popup-login" name="reg-button" value="<?php echo  $registrationNname;?>" />
				
			<?php echo $after_widget; ?>

		<?php
		
	}
	
	/** @see WP_Widget::form */
	function form($instance) {	
		 $title = esc_attr($instance['title']);
		 $buttonNname =  esc_attr($instance['buttonNname']);
		 $registrationNname = esc_attr($instance['registrationNname']);
		?>
			 <p>
				<label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:'); ?></label> 
				<input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" />
			</p>
			<p>
				<label for="<?php echo $this->get_field_id('buttonNname'); ?>"><?php _e('Login :'); ?></label> 
				<input class="widefat" id="<?php echo $this->get_field_id('buttonNname'); ?>" name="<?php echo $this->get_field_name('buttonNname'); ?>" type="text" value="<?php echo $buttonNname; ?>" />
			</p>
			<p>
				<label for="<?php echo $this->get_field_id('registrationNname'); ?>"><?php _e('Registration :'); ?></label> 
				<input class="widefat" id="<?php echo $this->get_field_id('registrationNname'); ?>" name="<?php echo $this->get_field_name('registrationNname'); ?>" type="text" value="<?php echo $registrationNname; ?>" />
			</p>
		<?php
	}
	
	
	 /** @see WP_Widget::update */
	function update($new_instance, $old_instance) {		
		global $posttypes;
		$instance = $old_instance;
		$instance['title'] = strip_tags($new_instance['title']);
		$instance['buttonNname'] = strip_tags($new_instance['buttonNname']);
		$instance['registrationNname'] = strip_tags($new_instance['registrationNname']);
		
		return $instance;
	}
}

//register the widget
add_action('widgets_init', create_function('', 'return register_widget("PopUpLoginWizet");'));