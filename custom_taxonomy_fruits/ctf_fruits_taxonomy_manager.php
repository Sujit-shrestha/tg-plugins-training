<?php 

namespace Plugins\Custom_taxonomy_fruits;

class Ctf_fruits_taxonomy_manager{

  public function __construct(){

    //actions
    add_action( 'init' , array( $this , 'register_taxonomy_fruits' )  , 11);
  }

  public function register_taxonomy_fruits(){

    $labels = array(
      'name'              => _x( 'Friuts', 'taxonomy general name' ),
      'singular_name'     => _x( 'Fruit', 'taxonomy singular name' ),
      'search_items'      => __( 'Search Fruits' ),
      'all_items'         => __( 'All Fruits' ),
      'edit_item'         => __( 'Edit Fruit Details' ),
      'update_item'       => __( 'Update Fruit quickly' ),
      'add_new_item'      => __( 'Add New Fruit' ),
      'new_item_name'     => __( 'New Fruit Name' ),
      'menu_name'         => __( 'Fruits' ),
    );
    $args   = array(
      'hierarchical'      => false, // make it hierarchical (like categories)
      'labels'            => $labels,
      'show_ui'           => true,
      'show_admin_column' => true,
      'query_var'         => true,
      'rewrite'           => [ 'slug' => 'fruit' ],
    );
    register_taxonomy( 'fruit', [ 'post' ], $args );

  }
}