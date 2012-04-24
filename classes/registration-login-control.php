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
		add_action('register_form', array(get_class(), 'register_form'));
		add_action('init', array(get_class(), 'login_to_notfound'));
		
	}
	
	/*
	 * sanitize the registeration form
	 */
	static function register_form(){
		?>
		
		<script type="text/javascript">
			
			
			jQuery(document).ready(function(){					
				jQuery('#nav').html(null);
			});
			
		</script>	
		
		<?php
	}


	/*
	 * Hanldes the login css files
	 */
	static function registration_js_css(){	
		
		wp_register_style('PopupLoginpageCSS', PopUpURL . '/css/login-page.css');
		wp_enqueue_style('PopupLoginpageCSS');
		
		
	}
	
	static function login_to_notfound(){
		if(isset($_REQUEST['logout'])) return;
		if(preg_match('/wp-login.php/', $_SERVER['REQUEST_URI'])){
			if($_REQUEST['action'] == 'register' || $_REQUEST['action'] == 'login'){
				$template = get_404_template();
				include($template);
				exit;
			}
		}
		
	}
		
}