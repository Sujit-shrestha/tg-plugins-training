<?php

namespace Wp_content\Plugins\Metabox_learn;

use WP_Error;

class Metabox_task5_tsb
{

  public function __construct()
  {
    add_shortcode( 'task5_tsb_template_sc' , array( $this , 'task5_tsb_shortcode' ));
    add_action( 'admin_post_save_user_task5_tsb' , array( $this ,  'metabox_task5_handle_submit_for_sc' ));
  }

  //template
  public function task5_tsb_template($title)
  {
    //starting template div
    $template = '<div >';

    //adding title
    $template .= '<h1>'.$title .'</h1>';

    $admin_url = admin_url('admin-post.php');
    //body of template
    $template .= '

    <form method="post"  action="'.$admin_url.'">

     <input type="hidden" name="action" value="save_user_task5_tsb">
      </br>
      <label for="email">Email: </label>
      <input name="email" type="text" required/>

      <label for="password">Password: </label>
      <input type="password" name="password" >

      <label for="username">Username </label>
      <input name="username" type="text" required />

      <label for="display_name">Display Name: </label>
      <input name="display_name" type="text" />

      <label for="first_name">First Name: </label>
      <input name="first_name" type="text" />

      <label for="last_name">Last Name: </label>
      <input name="last_name" type="text" />

      <label for="role">Role: </label>
      <select name="role" id="cars">
        <option value="subscriber">Subscriber</option>
        <option value="editor">Editor</option>
        <option value="admin">Administrator</option>
      </select>

      <input type="submit" value="Send">
    </form>

    ';


//ending template div
$template .= "</div>";
    return $template;
  }

  //shortcode creation with parameter
  public function task5_tsb_shortcode($atts = [], $content = null){

    $wporg_atts = shortcode_atts(
      array(
        'title' => 'Default title',
      ), $atts , 'task5_tsb_template_sc' 
    );
      
    //getting and returning the template
    
    return $this->task5_tsb_template($wporg_atts["title"]) ;
    }
 

  //on click submit save data with resective role in wp_users and p_usermeta

  public function metabox_task5_handle_submit_for_sc () {



    if(isset($_POST["email"])){
      
      //initializing the WP_Error class for error handling
      $error = new WP_Error();



      
      //sanitizing the user input fields
      $email      = $_POST["email"]    ? sanitize_email($_POST["email"])         : '';
      $password    = $_POST["password"] ? sanitize_text_field($_POST["password"]) : '';
      $username   = $_POST["username"] ? sanitize_user($_POST["username"])       : '';
      $display_name =$_POST["display_name"] ?  sanitize_text_field($_POST["display_name"]) : '';
      $first_name = $_POST["first_name"] ? sanitize_text_field($_POST["first_name"]): '';
      $last_name  =$_POST["last_name"] ?  sanitize_text_field($_POST["last_name"]) : '';
      $role       = $_POST["role"] ?? '';
      

      if(empty($email)){
        $error->add('empty' , 'Email is required field');
      }
      if(!is_email($email)){
        $error->add('invalid' , 'Please enter a valid email.'); 
      }
      if(empty($password)){
        $error->add('empty' , 'Password is required field');
      }
      if(count($error->get_error_codes())){
        echo '<div>Please correct the following errors.</div>';
          echo '<ul';
        echo '<li>' . implode('</li><li>', $error->get_error_messages() ) . '</li>';
        echo '</ul>';
      }
      
      //preparing an array 
      $user_data = array(  
        "user_email" => $email,
        "user_pass" => $password,
        "user_login" => $username,
        "display_name" => $display_name,
        "first_name" => $first_name ,
        "last_name" => $last_name,
        "role" => $role
        
      );
     
      //storing data in wp_user table
      $user_id = wp_insert_user($user_data);
      if (is_wp_error($user_id)) {
        // Handle user creation error
        $error->add('user' , 'User creation failed'. $user_id->get_error_message());
    } else {
    
      update_user_meta($user_id, 'first_name', $first_name);
      update_user_meta($user_id , 'last_name' , $last_name);
      
    }
  }

  }
}