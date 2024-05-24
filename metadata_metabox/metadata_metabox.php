<?php

/**
 * Plugin Name: Metadata and metabox
 * Description: Adds metadata and metabox
 * Version: 2024.5.20
 * Author: Sujit Shrestha
 * Author URI: https://linkedin.com/in/mrsujiit
 * License: GPLv2 or Later
 */

 defined('ABSPATH') or die( 'Unauthorized to access this file!!' );

 require_once dirname(__FILE__) .'/autoloader.php';
 class Metadata_metabox{

  public function __construct(){
    //manages meatadata  : basic 
   new Plugins\Metadata_metabox\Metadata_manage();

   //adds metabox to the screens
   new Plugins\Metadata_metabox\Metabox_adder();

   //adds the post meta data above comment seciotn 
   new Plugins\Metadata_metabox\Above_comment_section_onpostload();


  }


  /**
   * Activation
   */
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
 if(class_exists( 'Metadata_metabox' )){
  //initialize
    $meta = new Metadata_metabox();
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