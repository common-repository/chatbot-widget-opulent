<?php

/**
  * Trigger this file on Plugin uninstall
  * 
  * @package BotsifyChatbotWidget
  */


if ( !defined( 'WP_UNINSTALL_PLUGIN' ) ) {
	die;

}

delete_option( 'opulent_chatbot_api_key' );
