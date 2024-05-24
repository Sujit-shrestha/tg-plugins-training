<?php 

namespace Wp_content\Plugins\Metabox_learn;


class Adminmenus
{
  public function __construct(){

    /**
     * Actions
     */

    add_action( 'admin_menu' , array( $this , 'addMenu' ) );

    /**
     * Filters
     */


  }

  /**
   *   menu Registration
   * 
   */
  public function addMenu(){

    add_menu_page(
      'Movie',
      'Movie',
      'manage_options',
      'admin_movie_menu',
    );

    //Loads submenu to the menu
    $this->addSubMenu();
  }

  /**
   *  Sub menus registration
   */

   public function addSubMenu(){

    //Dashboard as Sub Menu
    add_submenu_page(
      'admin_movie_menu',
      'Dashboard',
      'Dashboard',
      'manage_options',
      'admin_movie_submenu_dashboard'
    );

    //Settings as Sub Menu
    add_submenu_page(
      'admin_movie_menu',
      'Settings',
      'Settings',
      'manage_options',
      'admin_movie_submenu_setting'
    );

   }


 
}