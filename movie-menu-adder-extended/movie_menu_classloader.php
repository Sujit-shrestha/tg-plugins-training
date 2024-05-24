<?php 

namespace Wp_content\Plugins\Movie_menu_adder_extended;

//getting the class file
require_once dirname(__FILE__) .'/adminmenus_task6.php';
require_once dirname(__FILE__) .'/settings-learn.php';


use Wp_content\Plugins\Movie_menu_adder_extended\Adminmenus;
use Wp_content\Plugins\Movie_menu_adder_extended\Settings_learn;


//initializing it
function initializeClasses(){

  $admin_movie_menu = new Adminmenus();
  


  return array( 
    
    // $admin_movie_menu 

  );
}

initializeClasses();