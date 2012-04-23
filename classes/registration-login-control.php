<?php

/*
 * Controls registration form login form etc
 */

class popup_registration_and_login_control{
	
	/*
	 * contans all the hooks
	 */
	static function  init(){		
		add_action('login_enqueue_scripts', array(get_class(), 'registration_js_css'));
		//add_filter('template_include', array(get_class(), 'template_include'));
		add_action('init', array(get_class(), 'login_to_notfound'));
		
	}
	
	static function template_include($template){
		var_dump($template);
		exit;
	}


	/*
	 * Hanldes the login css files
	 */
	static function registration_js_css(){	
		
		wp_register_style('PopupLoginpageCSS', PopUpURL . '/css/login-page.css');
		wp_enqueue_style('PopupLoginpageCSS');
		
		
	}
	
	static function login_to_notfound(){
		
		if(preg_match('/wp-login.php/', $_SERVER['REQUEST_URI'])){
			if($_REQUEST['action'] == 'register' || $_REQUEST['action'] == 'login' || empty($_REQUEST['action'])){
				$template = get_404_template();
				include($template);
				exit;
			}
		}
		
	}
		
}