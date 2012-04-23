<?php
/*
 * Plugin Name: PopUp Login/Registration
 * Author: Mahibul Hasan Sohag
 * Plugin Uri: http://sohag.me
 * Author Uri: http://sohag.me
 * */

define("PopUpDir", dirname(__FILE__)); 
define("PopUpURL", plugins_url('', __FILE__));

/*
 * including the class and triggers hooks
 */
include PopUpDir . '/classes/simple-popup-class.php';
simplePopUpLogin :: init();

include PopUpDir . '/classes/registration-login-control.php';
popup_registration_and_login_control :: init();