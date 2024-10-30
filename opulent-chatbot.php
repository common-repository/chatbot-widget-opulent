<?php
/**
  * Trigger this file on Plugin uninstall
  * 
  * @package OpulentChatbotWidget
  */
/*
Plugin Name: Chatbot Widget for Opulent
Plugin URI: https://opulent.com/
description: Opulent chatbot plugin to embed chat widget code into wordpress site
Version: 1.2
Author: Abdul Qadir
Author URI: http://abdulqadir.info
License: GPLv2 or later
Text Domain : opulent-chatbot
*/

/*
This program is free software; you can redistribute it and/or
modify it under the terms of the GNU General Public License
as published by the Free Software Foundation; either version 2
of the License, or (at your option) any later version.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program; if not, write to the Free Software
Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston, MA  02110-1301, USA.
*/

define('CWO_LICENSE', true );
defined( 'ABSPATH' ) or die( 'You cannot accesss this file' );
if ( ! function_exists( 'add_action' ) ){
	echo "Hey, You cannot access this file";
}

add_action( 'admin_menu', 'cwo_register_custom_menu_page' );
add_action( 'wp_footer', 'cwo_footer_scripts' );
  
function cwo_register_custom_menu_page(){
		// Add the main admin Opulent menu

wp_register_style('opulent_chatbot_dashicons', plugins_url('css/opulent-chatbot.css',__FILE__));
wp_enqueue_style('opulent_chatbot_dashicons');

     add_menu_page('Opulent', 'Opulent', 'manage_options', 'opulent_api_key', 'cwo_add_api_key_page','dashicons-opulent-logo');
  
     // add_submenu_page('botsify_api_key', 'Submenu Page Title', 'Whatever You Want', 'manage_options', 'botsify_api_key' );
     // add_submenu_page( 'botsify_api_key', 'Page title', 'Sub-menu title', 'manage_options', 'child-submenu-handle', 'my_magic_function');
}

function cwo_add_api_key_page () {
  // echo 'this is where we will edit the variable';
	include_once("api_key.php");
}

// mt_settings_page() displays the page content for the Test Settings submenu
function cwo_settings_page() {
    echo "<h2>" . __( 'Footer Settings Configurations', 'menu-test' ) . "</h2>";
	include_once('footer_settings_page.php');
}

function cwo_deactivate(){

}


function cwo_footer_scripts(){
    if (get_option('opulent_chatbot_api_key')){
 ?>
 <script>
 !function() {
 var t; if (t = window.webbot = window.webbot = window.webbot || [], !t.init)
 return t.invoked ? void (window.console && console.error && console.error("Opulent snippet included twice.")) : (
 t.load =function(e){    var o,n;    o=document.createElement("script"); e.type="text/javscript"; o.async=!0;
 o.crossorigin="anonymous";o.src="https://theopulent.botsify.com/web-bot/script/frame/"+e+"/webbot.js";
 n=document.getElementsByTagName("script")[0];    n.parentNode.insertBefore(o,n); });
 }(); webbot.load("<?php echo get_option('opulent_chatbot_api_key'); ?>");
</script>
 <?php
}
}