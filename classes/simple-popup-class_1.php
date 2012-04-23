<?php

/*
 * Handles all the stuff
 * */
 
 class simplePopUpLogin{
	
	/*
	 * contains all the hooks
	 * */
	 function init(){
		add_action('wp_footer', array(get_class(), 'login_registration_form'));
		add_action('wp_print_styles', array(get_class(), 'login_css'));
		add_action('wp_print_scripts', array(get_class(), 'login_js'));
	 }
	 
	 /*
	  * css
	  */
	 static function login_css(){
		 
		if(is_user_logged_in()) return;
		wp_register_style('PopupLoginCSS', PopUpURL . '/css/default.css');
		wp_enqueue_style('PopupLoginCSS');	
		
	 }
	 
	 /*
	  * js add
	  */
	 static function login_js(){
		if(is_user_logged_in()) return;
		wp_enqueue_script('jquery');
		wp_enqueue_script('PopupLoginJS', PopUpURL . '/js/default.js',array('jquery'));
		wp_enqueue_script('PopupLoginJS_simple_modal', PopUpURL . '/js/jquery.simplemodal.js',array('jquery'));
	 }
	 
	 /*
	  * holds the login and registration form
	  */
	 static function login_registration_form(){
		 echo '<div id="simplemodal-login-form" style="display:none">';
		 include PopUpDir . '/includes/login-form.php';
		 include PopUpDir . '/includes/registration-form.php';
		 echo '</div>';
	 }
	 
	 /*
	  *  select day
	  */
	 static function select_day(){
		 $output = '<select name="birth-day">';
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
		 $output = '<select name="birth-month">';
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
		 $output = '<select name="birth-year">';
		 for($i = $start_year; $i<$endyear; $i++){			
			 $output .= "<option value='$i'>$i</option>";
		 }
		 $output .= "</select>";
		 return $output;
	 }
 }
