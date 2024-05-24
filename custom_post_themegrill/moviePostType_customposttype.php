<?php

namespace Plugins\Metadata_metabox;

/**
 * Registers Custom post type : Movie
 */
class MoviePostType_customposttype
{
  public function __construct()
  {

    //actions
    add_action( 'init', array( $this, 'register_movie_post_type' ) );

    //displaying metabox
    add_action( 'add_meta_boxes', array($this, 'add_movie_metabox' ) );

    //asving the metabox: movie data
    add_action( 'save_post' , array( $this , 'save_movie_metabox_data' ) );

    //filters
  }

  //register movie post type
  public function register_movie_post_type()
  {
    register_post_type(
      "movies",
      array(
        'labels' => array(
          'name' => __('Movies'),
          'singular_name' => __('Movie'),
        ),
        'public' => true,
        'has_archive' => true,
        'rewrite' => array('slug' => 'movies'),

      )
    );
  }


  //metabox for movie post type
  /**
   * Takes movie meta data using metabox
   */
  public function add_movie_metabox()
  {

    $screens = [ 'movies' ];
    foreach ( $screens as $screen ) {
      add_meta_box(
        'movie_meta_data',
        'Provie Movie data',
        array( $this, 'movie_metabox_template' ),
        $screen
      );
    }

  }

  //metabox movie temaplate

  public function movie_metabox_template()
  {
    ?>
    <form action="" method="post">

      <label name="movie_release_date" for="movie_release_date">Movie Release Date: </label>
      <input name="movie_release_date" type="date" />

      <label name="movie_director" for="movie_director">Movie director :</label>
      <input name="movie_director" type="text" />

      <label name="movie_cast" for="movie_cast">Movie Casts: </label>
      <input name="movie_cast" type="text" />

    </form>
  <?php
  }



  /**
   * Saving the metabox data in movie post menu
   */
  public function save_movie_metabox_data( $post_id ){
   
    if( array_key_exists( 'movie_release_date' , $_POST ) ){
      update_post_meta(
        $post_id,
        '_movie_release_date',
        $_POST['movie_release_date']
      );

      update_post_meta(
        $post_id,
        '_movie_director' ,
        sanitize_text_field( $_POST["movie_director"] )
      );

      update_post_meta(
        $post_id,
        '_movie_cast',
        sanitize_text_field( $_POST["movie_cast"] )
      );
    }
  }

}