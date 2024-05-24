<?php
/*
 * Plugin Name: Learning Metabox
 * Plugin URI: http://fb.com
 * Description: A test plugin to learn about metabox
 * Version: 2024.14.5
 * Author: MrSujit
 * Author URI: https://linkedin.com/in/mrsujiit
 * License: GPLv2 or later
 * License URI: https://linkedin.com
 * Update URI: http://yt.com
 * Domain Path: /languages
 */

defined('ABSPATH') or die('Can\'t access this  file !!');


require_once dirname(__FILE__) . '/emailContentChanger.php';
require_once dirname(__FILE__) . '/shortcodes-learn.php';
require_once dirname(__FILE__) . '/metabox_users_roles.php';
require_once dirname(__FILE__) .'/metabox_task5_tsb.php';

use Wp_content\Plugins\Metabox_learn\EmailContentChanger;
use Wp_content\Plugins\Metabox_learn\Shortcodes_learn;
use Wp_content\Plugins\Metabox_learn\Metabox_users_roles;
use Wp_content\Plugins\Metabox_learn\Metabox_task5_tsb;
class Metabox_learn
{

  public function __construct()
  {
    //actions
    add_action('init', [$this, 'metaboxlearn_setup_post_type']);
    add_action('init', array($this, 'register_custom_posttype'));
    add_action('admin_notices', [$this, 'display_activation_message']);
    add_action('add_meta_boxes', [$this, 'wporg_add_custom_box']);
    add_action('save_post', [$this, 'learnMetabox_update_metabox_personal_feelings']);
    add_action('admin_menu', [$this, 'custom_test_email_menu']);
    add_action('admin_post_send_email', [$this, 'testemail_handle_send_email']);
    add_action('plugins_loaded' , array( $this , 'loadCustomClasses' ));
  //shortcodes example
    // add_action( 'init', array( 'Shortcodes_learn', 'init') );


    //filters
    add_filter('the_title', [$this, 'learn_metabox_filter_title']);

  }

  /**
   * Loading custom classes
   * 
   * @return void
   */

   public function loadCustomClasses () {

    //loading Shortcodes_learn class
    new Shortcodes_learn();

    //loading user roles learnign class
    new Metabox_users_roles();

    //loading class for task 5 : template , shortcode , save un wo_users and wp_metadata
    new Metabox_task5_tsb();

   

   }

  /**
   * Registering a custom post type for testing
   *
   * @return void
   */
  public function register_custom_posttype()
  {
    $args = array();

    register_post_type('ss_sent_mail', $args);
  }

  /**
   * Activation of the plugin 
   *
   * @return void
   */
  public function activate()
  {
    $this->metaboxlearn_setup_post_type();
    //flush rewrite rules
    flush_rewrite_rules();

    //add option to show activation message
    add_option('metabox_learn_activated', true);
  }

  /**
   * Deactivation Hook
   *
   * @return void
   */
  public function deactivate()
  {
    //unregister the post type
    unregister_post_type('theme');

    //flush rerite rules
    flush_rewrite_rules();

    //remove actication message option
    delete_option('metabox_learn_activated');
  }

  /**
   * Uninstalling the plugin
   *
   * @return void
   */
  public function uninstall()
  {

  }

  /**
   * setting custom post type
   *
   * @return void
   */
  public function metaboxlearn_setup_post_type()
  {
    register_post_type('themegrill', ['public' => true, 'label' => 'themegrill']);
  }

  /**
   * Diplaying custom activation message
   *
   * @return void
   */
  public function display_activation_message()
  {

    //check if plugin had been activated
    if (get_option('metabox_learn_activated')) {
      ?>
      <div class="notice notice-success is-dismissible">
        <p><?php _e('"Metabox-Learn" plugin has been activated successfully !', 'metabox-learn'); ?></p>
      </div>
      <?php
      // Remove the activation message option to prevent showing it again
      delete_option('metabox_learn_activated');
    }
  }

  /**
   * Adding meta boxes
   * 
   */
  function wporg_add_custom_box()
  {
    $screens = ['post', 'wp_admin', 'dashboard', 'themegrill'];
    foreach ($screens as $screen) {
      add_meta_box(
        'wporg_box_id',                 // Unique ID
        'Themegrill Meta box learning ',      // Box title
        [$this, 'metabox_html_content'],  // Content callback, must be of type callable
        $screen                            // Post type
      );
    }
  }

  function metabox_html_content($post)
  {
    $value = get_post_meta($post->ID, '_wporg_meta_key', true);
    ?>
    <label for="tg_name">Write your name : </label>
    <input name="tg_name" type="text" />

    <label for="tg_feelings">How are you feeling today ? </label>
    <input name="tg_feelings" type="text" />

    <?php
  }

  /**
   * Saving the metabox contents provided by user
   */
  function learnMetabox_update_metabox_personal_feelings($post_id)
  {
    if ('themegrill' == get_post_type()) {
      if (isset($_POST['tg_feelings']) || $_POST['tg_name']) {
        update_post_meta($post_id, 'wp_org_box_id', $_POST['tg_feelings']);
      }
    }
  }

  /**
   * Filter to alter the title of page
   */
  function learn_metabox_filter_title($title)
  {
    return $title;
  }

  // Add a menu page for Test Email
  function custom_test_email_menu()
  {
    add_menu_page(
      'Test Email',        // Page title
      'Test Email',        // Menu title
      'manage_options',    // Capability required
      'test_email_menu',   // Menu slug
      [$this, 'display_test_email_menu'] // Function to display the menu
    );

    // Add a submenu page for Send Email
    add_submenu_page(
      'test_email_menu',   // Parent slug
      'Send Email',        // Page title
      'Send Email',        // Menu title
      'manage_options',    // Capability required
      'send_email_submenu', // Menu slug
      [$this, 'display_send_email_submenu'] // Function to display the submenu
    );
  }

  // Callback function to display Test Email menu page
  function display_test_email_menu()
  {
  
    // Display your menu page content here
    ?>
    <h1>This is test email page</h1>
   

    <?php

    
  }

  // Callback function to display Send Email submenu page
  function display_send_email_submenu()
  {
    // Display fields for Email Subject, Email Content, Send To, and Send button
    ?>
    <form method="post" action="<?php echo admin_url('admin-post.php'); ?>">
      </br>
      <input type="hidden" name="action" value="send_email">
      <input type="hidden" name="send_email" value="1">
      <label for="email_subject">Email Subject: </label>
      <input name="email_subject" type="text" />
      <label for="email_content">Email Content: </label>
      <input type="text" name="email_content" id="email_content">
      <label for="send_to">Send to: </label>
      <input name="send_to" type="text" required />
      <input type="submit" value="Send">
    </form>

    <?php
  }

  /**
   * Handling send email form data
   */
  public function testemail_handle_send_email()
  {

    if (isset($_POST['send_email'])) {

      //sanitize the inputs
      $email_subject = sanitize_text_field($_POST['email_subject']);
      $email_content = sanitize_textarea_field($_POST['email_content']);
      $send_to = sanitize_email($_POST['send_to']);

      // Prepare data array
      $email_data = array(
        'email_subject' => $email_subject,
        'email_content' => $email_content,
        'send_to' => $send_to
      );

      // Save data to post || save it in database
      $to_insert = [
        'post_title' => $email_subject,
        'post_content' => $email_content,
        'post_status' => 'publish',
        'post_type' => 'ss_sent_mail'
      ];

      $post_id = wp_insert_post(
        $to_insert
      );

      //email content changer task
      $emailContentChangerClass = new EmailContentChanger();
      $modified_email_data = apply_filters('custom_email_data', $email_data);
      $saving_modified_data = apply_filters('custom_email_data_save', $modified_email_data);



      // }
    }

  }

}

/**
 * checking if class exists
 */
if (class_exists('Metabox_learn')) {
  $metabox_learn = new Metabox_learn();


}

/**
 * Activating this plugin
 */

register_activation_hook(
  __FILE__,
  [$metabox_learn, 'activate']
);

/**
 * Deactivating the plugin
 */

register_deactivation_hook(
  __FILE__,
  [$metabox_learn, 'deactivate']
);

/**
 * Uninstalling the plugin
 */
// register_uninstall_hook(
//   __FILE__,
//   [$metabox_learn, 'uninstall']
// );



