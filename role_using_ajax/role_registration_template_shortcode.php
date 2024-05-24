<?php

namespace Plugins\Role_using_ajax;

use Plugins\Role_using_ajax\Manage_user_role_usingAJAx as RoleManager;

defined('ABSPATH') || exit;

/**
 * Generates shortcode called as  : [user_role_using_AJAX].
 */

class Role_registration_template_shortcode
{
  //class instance.
  private $roleManager;
  public function __construct(RoleManager $roleManager)
  {

    $this->roleManager = $roleManager;

    //adding shortcodes to add the data in the user area
    add_action('init', array($this, 'shortcode_init_role_registration_template'));
  }

  /**
   * Adds shortcode for the template.
   *
   * @return void
   */
  public function shortcode_init_role_registration_template()
  {

    add_shortcode('user_role_using_AJAX', array($this, 'user_role_shortcode_template'));

  }

  /**
   * Template for the user role registration.
   *
   * @return 
   */
  public function user_role_shortcode_template($atts = [], $content = null, $tag = '')
  {

    $atts = array_change_key_case((array) $atts, CASE_LOWER);

    $o = '<div class="rua-user_role_using_AJAX-box">';
    
    $o .= "<p1>";
    $o .= esc_html__('Test html here.', 'rua-themegrill-training');

    //get the template for user registration role
    $o .= $this->roleManager->role_form_template();

    $o .= ' <div class="g-recaptcha" data-sitekey="your_site_key"></div><br/>';

    $o .= '</div>';

    return $o;
  }

}