<?php 

namespace Plugins\Custom_taxonomy_fruits;

/**
* Autoloading the classes.
*/
spl_autoload_register(function ($class) {
 
  /**
   *  Reversing the array and taking the 0th part so that it complies with the case when the namespace is not presented.
   */ 

  $classname = plugin_dir_path(__FILE__) . '/' . lcfirst(array_reverse(explode('\\', $class))[0]) . '.php';
  // Exit.
  if (file_exists($classname)) {
      include_once $classname;
  }
});