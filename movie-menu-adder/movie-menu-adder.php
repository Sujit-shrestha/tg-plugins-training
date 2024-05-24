<?php

/**
 * Plugin Name: Movie Menu Adder
 * Description: Adds a Movie Menu in the admin dashboard
 * Version: 2024.5.17
 * Author: Sujit Shrestha
 * Author URI: https://linkedin.com/in/mrsujiit
 * License: GPLv2 or Later
 */

 defined('ABSPATH') or die( 'Unauthorized to access this file!!' );



 class MovieMenuAdder{

  public function __construct(){

     //loads  requried custom classes and initializes them
  require_once dirname(__FILE__) .'/movie_menu_classloader.php';


  }


  /**
   * Activation
   */
  public function activate (){

    //flush rewrite rules
    flush_rewrite_rules();

    //adding option of activation
    add_option( 'movie_menu_activated' , true );
  }

  /**
   * Deactivation
   */
  public function deactivate (){

    //flush rewrite rules
    flush_rewrite_rules();

    //remove option of activation
    delete_option( 'movie_menu_activated' );

  }



 }

 //class object instantiation
 if(class_exists( 'MovieMenuAdder' )){
  //initialize
    $movieMenu = new MovieMenuAdder();
 }

 /**
  * Activation registration of plugin
  */
register_activation_hook(
  __FILE__,
  array( $movieMenu , 'activate' )
);

/**
 * Deactivation registration of plugin
 */

 register_deactivation_hook(
  __FILE__,
  array( $movieMenu , 'deactivate' )
 );