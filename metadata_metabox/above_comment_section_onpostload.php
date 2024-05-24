<?php 

namespace Plugins\Metadata_metabox;
/**
 * Displays additional meta data above post comment section 
 * uses data from the data stored using emetabox in admin post addition dashboard
 */
class Above_comment_section_onpostload
{
  public function __construct(){

    //adding shortcode to add the data above comment section in post 
    add_action( 'init' , array( $this , 'shortcode_init_post_metadata' ));

    //adds the data above the comments template is rendered
    add_action( 'colormag_before_comments_template' , array( $this , 'data_above_comment_in_posts' ));
    
  }

  //template for display the data 

  public function data_above_comment_in_posts($data){

    ?>

    <div class="">
      <h1>POST META DATA</h1>

      <?php 
    
      //putting the shortcode into the html 
           echo do_shortcode('[themegrillshortcode]')  
      ?>
      
    </div>

    <?php 
  }

//funcotin to retrieve data from database

public function retrieve_data_from_postmeta( $post_id){
 $data = get_post_meta( $post_id );

 return $data;
}

//creating shortcode to display the post meta data
  function shortcode_init_post_metadata(){
    add_shortcode( 'themegrillshortcode' , array( $this , 'mm_shortcode' ) );
  }

  /**
 * The [themegrillshortcode] shortcode.
 *
 * Accepts 3 texts and will display in a box.
 *
 * @param array  $atts    Shortcode attributes. Default empty.
 * @param string $content Shortcode content. Default null.
 * @param string $tag     Shortcode tag (name). Default empty.
 * @return string Shortcode output.
 */
function mm_shortcode( $atts = [], $content = null, $tag = '' ) {
	// normalize attribute keys, lowercase
	$atts = array_change_key_case( (array) $atts, CASE_LOWER );

  //getting data of the post using post->ID
  if (is_single()) {
    global $post;
    $data = $this->retrieve_data_from_postmeta($post->ID);

  }

	// override default attributes with user attributes
	$post_meta_data = shortcode_atts(
		array(
			'textbox' => $data['_onpostload_mb_textbox'][0] ?? 'textbox_data',
      'dropdown' => $data['_onpostload_mb_dropdown'][0] ?? 'dropdown_data',
      'textarea' => $data['_onpostlaod_mb_textarea'][0] ?? 'textarea_data',
      'totalViews' => $data['total_number_of_views'][0]
		), $atts, $tag
	);  

	// start box
	$o = '<div class="wporg-box" style="border:1px solid black">';

	// textbox
	$o .= '<h2> Textbox : ' . esc_html( $post_meta_data['textbox'] ) . '</h2>';
  $o .= '<h2> Dropdown : ' . esc_html( $post_meta_data['dropdown'] ) . '</h2>';
  $o .= '<h2> Textarea : ' . esc_html( $post_meta_data['textarea'] ) . '</h2>';
  $o .= '<h3> Total Views : ' . esc_html( $post_meta_data['totalViews'] ) . '</h3>';

	// enclosing tags
	if ( ! is_null( $content ) ) {
		
		$o .= apply_filters( 'the_content', $content );
	}

	// end box
	$o .= '</div>';

	// return output
	return $o;
}

}