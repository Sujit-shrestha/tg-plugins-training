<?php 

/**
 * Plugin Name: Custom Post Type 
 * Description: Adds custom post type called Movie
 * Version: 2024.5.20
 * Author: Sujit Shrestha
 * Author URI: https://linkedin.com/in/mrsujiit
 * License: GPLv2 or Later
 */

 defined('ABSPATH') or die( 'Unauthorized to access this file!!' );

 require_once dirname(__FILE__) .'/autoloader.php';

 class Custom_post_themegrill
 {
  public function __construct(){

    //movie  : custom post type init
    new Plugins\Metadata_metabox\MoviePostType_customposttype();
  }
  public function activate (){

    //flush rewrite rules
    flush_rewrite_rules();

  }

  /**
   * Deactivation
   */
  public function deactivate (){

    //flush rewrite rules
    flush_rewrite_rules();


  }

 }

 //class object instantiation
 if(class_exists( 'Custom_post_themegrill' )){
  //initialize
    $meta = new Custom_post_themegrill();
 }

 /**
  * Activation registration of plugin
  */
register_activation_hook(
  __FILE__,
  array( $meta , 'activate' )
);

/**
 * Deactivation registration of plugin
 */

 register_deactivation_hook(
  __FILE__,
  array( $meta , 'deactivate' )
 );
 
 