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
		
		//ajax handling
		add_action('wp_ajax_nopriv_popup_user_registration',array(get_class(), 'ajax_registration'));
		add_action('wp_ajax_popup_user_registration',array(get_class(), 'ajax_registration'));			

	 }
	 
	 /*
	  * css
	  */
	 static function login_css(){
			 
		if(is_user_logged_in()) return;
		wp_register_style('PopupLoginCSS', PopUpURL . '/css/popup.css');
		wp_enqueue_style('PopupLoginCSS');	
		
	 }
	 
	 /*
	  * js add
	  */
	 static function login_js(){
		if(is_user_logged_in()) return;
		
		$ajax_loader = PopUpURL . '/images/ajax-loader.gif';
		wp_enqueue_script('jquery');
		wp_enqueue_script('PopupLoginJS', PopUpURL . '/js/popup.js',array('jquery'));
		wp_localize_script(
			'PopupLoginJS', 'PopUp', array('ajaxurl' => admin_url( 'admin-ajax.php' ), 'ajaxloader' => $ajax_loader)
		);
	 }
	 
	 /*
	  * holds the login and registration form
	  */
	 static function login_registration_form(){
		 if(is_user_logged_in()) return;
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
	 
	 /*
	  * Handle ajax registration
	  */
	 static function ajax_registration(){
		$data = $_POST;
		 $error = array();
		
		
		 if(empty($data['fname']) || $data['fname'] == '') $error['fname'] = __('First Name Error');
		 if(empty($data['lname']) || $data['lname'] == '') $error['lname'] = __('Last Name Error');
		 
		 if(empty($data['password1']) || empty($data['password2'])){
			 $error['password'] = __('Empty password Field');			
		 }
		 elseif($data['password1'] != $data['password2']) {
			 $error['password'] = __('Password Does not Match');
		}
		else{
			$password = $data['password1'];
		}
		 
		 if(empty($data['road']) || $data['road'] == '') $error['road'] = __('Street Address is Empty');
		 if(empty($data['place']) || $data['place'] == '') $error['place'] = __('Place error');
		 if(empty($data['land']) || $data['land'] == '') $error['land'] = __('Land');
		 if(validate_username($data['username'])){
			 if(username_exists($data['username'])){
				 $error['username'] = __('Duplicate Username Found');
			 }
		 }
		 else{
			 $error['username'] = __("Invalid Username");
		 }
		 
		 if(!is_email($data['email'])) $error['email'] = __("Invalid Email address");
			 
		 if(email_exists($data['email'])) $error['email'] = __("Duplicate Email address");
		 
		 if(empty($error)){

			$user_data = array(
				'user_login' => $data['username'],
				'user_pass' => $password,
				'user_email' => $data['email'],
				'first_name' => $data['fname'],
				'last_name' => $data['lname'],
			);			
			$user = wp_insert_user($user_data);
			
		 }
		 else{
			 echo "<div>";
			foreach($error as $er=>$value){				
				echo "<strong>ERROR: </strong>" . $value . '<br/>' ;				
			} 
			echo "</div>";
			exit;
		 }
		 
		 if(is_object($user)){
			 $errors = $user->errors;
			 echo '<div>';
			 foreach ($errors as $er){
				 foreach($er as $e){
					 echo '<strong>ERROR: </strong>' . __($e);
				 }
			 }
			 echo '</div>';
		 }
		 else{
			 echo 'a';
		 }
		exit;
	 }
 }
