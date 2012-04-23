<?php

/*
 * Controls registration form login form etc
 */

class popup_registration_and_login_control{
	
	/*
	 * contans all the hooks
	 */
	static function  init(){
		add_action('register_form', array(get_class(), 'register_form'));
		add_action('login_enqueue_scripts', array(get_class(), 'registration_js_css'));
		add_action('login_footer', array(get_class(), 'form'));
	}
	
	/*
	 * sanitize the registeration form
	 */
	static function register_form(){
		?>
		<a class="popup-login" href="#">Register</a>
		<script type="text/javascript">
		//	jQuery(document).ready(function(){				
			//	var newform = '<a href="#" class="popup-login"><input type="button" name="register-button" class="button-primary" value="Register" /></a>';
				//jQuery('#registerform').html(newform);
				//jQuery('#registerform').show();
			//});
		</script>	
		
		<?php
	}
	
	static function registration_js_css(){
		//deregistering
		wp_deregister_style('PopupLoginCSS');
		wp_dequeue_style('PopupLoginCSS');
		
		//registering css
		wp_register_style('PopupLoginCSS', PopUpURL . '/css/popup.css');
		wp_enqueue_style('PopupLoginCSS');
		
		wp_register_style('PopupLoginpageCSS', PopUpURL . '/css/login-page.css');
		wp_enqueue_style('PopupLoginpageCSS');
		
		//de registering js
		wp_deregister_script('PopupLoginJS');
		wp_dequeue_script('PopupLoginJS');
		
		//registering
		$ajax_loader = PopUpURL . '/images/ajax-loader.gif';
		wp_enqueue_script('jquery');
		wp_enqueue_script('PopupLoginJS', PopUpURL . '/js/popup.js',array('jquery'));
		wp_localize_script(
			'PopupLoginJS', 'PopUp', array('ajaxurl' => admin_url( 'admin-ajax.php' ), 'ajaxloader' => $ajax_loader)
		);
	}
	
	/*
	 * contains all the form 
	 */
	static function form(){
		 echo '<div id="popup">';
		 echo '<div id="popup-content" class="window" style="display:none">';
		 echo '<a href="#" class="close"></a>';
		 include PopUpDir . '/includes/login-form.php';
		 include PopUpDir . '/includes/registration-form.php';
		 echo '</div>';
		 echo ' <div id="blanket"></div>';
		 echo '</div>';
	}
	
	 /*
	  *  select day
	  */
	 static function select_day(){
		 $output = '<select id="birth-day">';
		 for($i = 1; $i<32; $i++){
			 $output .= "<option value='$i'>$i</option>";
		 }
		 $output .= "</select>";
		 return $output;
	 }
	 
	 /*
	  *  select Month
	  */
	 static function select_month(){
		 $months = array('January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'Ocober', 'November', 'December');
		 $output = '<select id="birth-month">';
		 foreach($months as $key=>$value){
			 $i = $key + 1;
			 $output .= "<option value='$i'>" . __($value) . "</option>";
		 }
		 $output .= "</select>";
		 return $output;
	 }
	 
	 /*
	  *  select Year
	  */
	 static function select_year(){
		 $start_year = 1950;
		 $endyear = 2012;
		 $output = '<select id="birth-year">';
		 for($i = $start_year; $i<$endyear; $i++){			
			 $output .= "<option value='$i'>$i</option>";
		 }
		 $output .= "</select>";
		 return $output;
	 }
}