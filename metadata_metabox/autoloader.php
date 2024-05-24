<?php 

/**
 * Autoloading the classes 
 */

 spl_autoload_register( function ( $class ) {

  //exploding the class name in case the class name consists of namespaces
  //then , reversing the array and taking the 0th part so that it complies with the case when the namespace is not presented
  $classname = lcfirst(array_reverse(explode( '\\' , $class ))[0]);
  
    include $classname . '.php';
 });