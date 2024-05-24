<?php

namespace Plugins\Metadata_metabox;

/**
 * Adds metabox to the admin menu
 */
class Metabox_adder
{

  public function __construct()
  {
    //dipslaying metabox
    add_action('add_meta_boxes', array( $this, 'add_metabox'));

    //this saves the metabox data
    add_action( 'save_post' , array( $this , 'save_onpostload_metabox' ));
  }

  /**
   * Adding metabox to screens
   * 
   */
  public function add_metabox()
  {
    $screens = ['post', 'wporg_cpt'];
    foreach ($screens as $screen) {

      add_meta_box(
        '111',
        'On Post Load',
        [$this, 'display_onpostload_metabox'],
        $screen
      );

    }

  }

  /**
   * Displays metabox layout
   *
   * @param [type] $post
   * @return void
   */
  public function display_onpostload_metabox($post)
  {

    // $value = get_post_meta($post->ID, '_wporg_meta_key', true);

    //html content for the metabox on post load
    ?>

    <form action="" method="post">
      <label name="textbox">Textbox: </label>
      <input type="text" name="textbox" placeholder="write somethings here"  /></br></br>

      <label name="dropdown">Dropdown</label>

      <select name="dropdown" id="dropdown">
        <option value="drop1">Drop1</option>
        <option value="drop2">Drop2</option>
        <option value="drop3">Drop3</option>
        <option value="drop4">Drop4</option>
      </select>
      </br></br>
      <label name="textarea">Textarea</label>
      <input type="textarea" name="textarea" placeholder="This is text area" />
      </br></br>
    </form>

    <?php
  }

  /**
   * Saves the metabox data in meta table using updatepostmeta
   *
   * @param [type] $post_id
   * @return void
   */
  public function save_onpostload_metabox($post_id)
  {


    // echo "<pre>";
    // print_r($_POST);
    // exit;


//saving textbox data
    if (array_key_exists('textbox', $_POST)) {
      update_post_meta(
        $post_id,
        '_onpostload_mb_textbox',
        sanitize_text_field($_POST["textbox"])
      );
    }

    //saving dropdown
    if (array_key_exists('dropdown', $_POST)) {
      update_post_meta(
        $post_id,
        '_onpostload_mb_dropdown',
        sanitize_text_field($_POST["dropdown"])
      );
    }
    //saving textarea data
    if(  array_key_exists('textarea' , $_POST)){
      update_post_meta(
        $post_id,
        '_onpostlaod_mb_textarea',
        sanitize_textarea_field($_POST['textarea'])
      );
    }

  }
}