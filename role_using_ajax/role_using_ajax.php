<?php 

/**
 * Plugin Name: Role registration using AJAX.
 * Description: Adds user defined role using AJAX. Creates a shortcode called [user_role_using_AJAX] which renders form for role registration.
 * Version: 2024.5.21
 * Author: Sujit Shrestha
 * Author URI: https://linkedin.com/in/mrsujiit
 * Text Domain: 'rua-themegrill-training'
 * License: GPLv2 or Later
 */
defined('ABSPATH') or die( 'Unauthorized to access this file!!' );

require_once dirname(__FILE__) . '/autoloader.php';

final class Role_using_ajax {

  /**
   * Constructor
   */
  private function __construct(){ 

   $roleManager =  new Plugins\Role_using_ajax\Manage_user_role_usingAJAx();
    new Plugins\Role_using_ajax\Role_registration_template_shortcode( $roleManager );
    
  }
/**
 * Returns instance of this class
 *
 * @return self
 */
  static function getInstance(){
    
    return new self();

  }
  /**
   * Activation jobs
   */
  
  public function activate (){

    //flush rewrite rules
    flush_rewrite_rules();

  }

  /**
   * Deactivation jobs
   */
  public function deactivate (){

    //flush rewrite rules
    flush_rewrite_rules();

  }
}

/**
 * checks if class exists and then initializes the class
 */
if( class_exists( 'Role_using_ajax' ) ) {

  //instantiation
    $role_using_ajax =  Role_using_ajax::getInstance();
}

register_activation_hook(
  __FILE__,
  array( $role_using_ajax , 'activate' )
);

/**
 * Deactivation registration of plugin
 */

 register_deactivation_hook(
  __FILE__,
  array( $role_using_ajax , 'deactivate' )
 );