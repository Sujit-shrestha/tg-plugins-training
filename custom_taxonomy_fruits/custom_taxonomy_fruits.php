<?php 

/**
 * Plugin Name: Custom Taxonomy :Fruits 
 * Description: Adds custom taxonomy called fruits
 * Version: 2024.5.21
 * Author: Sujit Shrestha
 * Author URI: https://linkedin.com/in/mrsujiit
 * License: GPLv2 or Later
 */
defined('ABSPATH') or die( 'Unauthorized to access this file!!' );

include dirname(__FILE__) .'/autoloader.php';

 class Custom_taxonomy_fruits{
  public function __construct(){
    new Plugins\Custom_taxonomy_fruits\Ctf_fruits_taxonomy_manager();

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
if( class_exists( 'Custom_taxonomy_fruits' ) ){
  //initialize
  $taxonomy_instance = new Custom_taxonomy_fruits();
}

register_activation_hook(
  __FILE__,
  array( $taxonomy_instance , 'activate' )
);

/**
 * Deactivation registration of plugin
 */

 register_deactivation_hook(
  __FILE__,
  array( $taxonomy_instance , 'deactivate' )
 );