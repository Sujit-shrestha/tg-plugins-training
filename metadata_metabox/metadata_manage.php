<?php

namespace Plugins\Metadata_metabox;

/**
 * MAnages the metadata
 */
class Metadata_manage
{
  public function __construct(){

      $this->metadata_adder();
  }

  /**
   * Adding  custom metadata c
   *
   * @return void
   */
  public function metadata_adder(){
    add_post_meta( 68, '_color', 'pink', true );
    update_post_meta( 69 , '_color' , 'yellow' , true );
    update_post_meta( 69 , '_cup' , 'ceramic' , true );

  }
}