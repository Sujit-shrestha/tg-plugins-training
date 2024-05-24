<?php 
namespace Wp_content\Plugins\Metabox_learn;
class EmailContentChanger {

  public function __construct(){

    //filters
    add_filter('custom_email_data' , array( $this , 'metabox_learn_changeEmailContent' ) , 10 , 1);

    //action
    add_filter('custom_email_data_save' , array( $this , 'metabox_learn_save_email_data' )  ,10 , 1 );

  }
  /**
   * Changing the email content
   *
   * @param [type] $email_content
   * @return void
   */
  public function metabox_learn_changeEmailContent( $email_data ){


    $email_data["modified"] = true;
    $email_data["publish"] = true;
    $email_data["email_content"] = "MODIFIED!!";
   return $email_data;

  }

  /**
   * Saving email data by modification  - > saving in database
   */

   public function metabox_learn_save_email_data( $email_data ){

    $too_insert = array(
      'post_content'  => $email_data["email_content"],
      'post_title'    => $email_data["email_subject"],
      'post_status'   => $email_data['publish'],
      'post_type'     => 'ss_sent_mail'
    );
    print_r($too_insert); 
    print_r(wp_insert_post(
        $too_insert
    ));

   }


}