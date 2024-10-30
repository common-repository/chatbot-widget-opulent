<?php
cwo_saveAPIKey();

 function cwo_saveAPIKey()
{
   if ( isset($_POST['api_key']) ){
    $api_key = sanitize_text_field( $_POST['api_key'] );
    $retrieved_nonce = $_REQUEST['_wpnonce'];
    if (!wp_verify_nonce($retrieved_nonce, 'wbc_api_key_form' ) ) die( 'Failed security check' );

     if (cwo_checkAPIKey($api_key)){
       update_option('opulent_chatbot_api_key', $api_key);
     }
   }
 }
   
   function cwo_checkAPIKey($api_key){
     $body = wp_remote_retrieve_body( wp_remote_get( 'https://app.botsify.com/verify-bot-api-key?api_key='.$api_key ) );
     $body = json_decode($body);
     if ($body->status == "success"){
       echo '<div class="updated notice">
       <p>Valid API Key ! Widget added successfully</p>
   </div>';
       return true;
     }else{
       echo '<div class="error notice">
       <p>'.$body->message.'</p>
   </div>';
   return false;
     }
   }
   ?>

<div class="wrap">
   <div id="icon-options-general" class="icon32"> <br></div>
   <div class="metabox-holder" style="display: block;margin-left: auto;margin-right: auto; width: 60%; padding: 50px">
      <div class="postbox" style="padding: 40px">
         <center>
            <img src="<?=plugins_url( 'images/opulent_logo.png', __FILE__ )?>" style="width: 30%">
            <h1><a href="https://opulent.com" target="_blank">Opulent Chatbot Widget</a></h1>
            <form method="post" action="<?= esc_url( $_SERVER['REQUEST_URI'] )?>">
              <?php wp_nonce_field('wbc_api_key_form'); ?>
               <div style="margin-top: 30px;">
                  <label><strong> API Key : </strong></label> &nbsp;&nbsp;
                  <input type="text" name="api_key" value="<?php echo get_option( 'opulent_chatbot_api_key' ); ?>" placeholder="Enter API Key here" required style="width: 70%;" />
                  <br /><br /><br />
                  <input name="submit" id="submit" class="button button-primary" value="Save Changes" type="submit">
               </div>
            </form>
         </center>
      </div>
   </div>
</div>