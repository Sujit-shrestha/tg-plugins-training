<?php 

namespace Wp_content\Plugins\Movie_menu_adder;

//getting the class file
require_once dirname(__FILE__) .'/adminmenus_task6.php';


use Wp_content\Plugins\Metabox_learn\Adminmenus;


//initializing it
function initializeClasses(){

  $admin_movie_menu = new Adminmenus();
  


  return array( 
    
    // $admin_movie_menu 

  );
}

initializeClasses();