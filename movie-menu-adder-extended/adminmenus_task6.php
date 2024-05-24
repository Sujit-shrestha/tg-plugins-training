<?php

namespace Wp_content\Plugins\Movie_menu_adder_extended;


class Adminmenus
{
  public function __construct()
  {

    /**
     * Actions
     */

    //adding the menu
    add_action('admin_menu', array($this, 'addMenu'));

    add_action('admin_init', array($this, 'mmae_display_options'));

    /**
     * Filters
     */


  }

  /**
   *   menu Registration
   * 
   */
  public function addMenu()
  {

    add_menu_page(
      'Movie',
      'Movie',
      'manage_options',
      'admin_movie_menu',
      'dashicons-admin-tool'
    );

    //Loads submenu to the menu
    $this->addSubMenu();
  }

  /**
   *  Sub menus registration
   */

  public function addSubMenu()
  {

    //Dashboard as Sub Menu
    add_submenu_page(
      'admin_movie_menu',
      'Dashboard',
      'Dashboard',
      'manage_options',
      'admin_movie_submenu_dashboard',
      [$this, 'dashboard_contents_display']
    );

    //Settings as Sub Menu
    add_submenu_page(
      'admin_movie_menu',
      'Settings',
      'Settings',
      'manage_options',
      'admin_movie_submenu_setting',
      [$this, 'settings_submenu_display']
    );

  }

  //display contents of the Dashboard
  public function dashboard_contents_display()
  {

    ?>
    <div class="wrap">
      <div id="icon-options-general" class="icon32"></div>
      <h1>Dashboard contents here : Using dashboard_contents_display function !! </h1>

      <form method="post" action="options.php">
        <?php

        settings_fields("header_section");

        do_settings_sections("admin_movie_submenu_dashboard");

        submit_button();

        ?>

      </form>
    </div>

    <?php
  }

  //displays content of the Movie_settings submenu
  public function settings_submenu_display()
  {
    ?>
    <div>
      <h1>Settings submenu contents here !! </h1>
    </div>

    <?php

  }

  //display the contents of Movie -> dashboard submenu
  public function mmae_display_options()
  {

    // add the section to general settings so we can add our fields to it
    add_settings_section(
      'mmae_settings_section',
      'Section',
      [$this, 'mmae_section_callback_function'],
      'admin_movie_submenu_dashboard'

    );

    //add the field with the names and funcntion to use for out new settings , put it in out new section
    add_settings_field(
      'mmae_settings_name',
      'Settings Name',
      [$this, 'mmae_settings_callback_function'],
      'admin_movie_submenu_dashboard',
      'mmae_settings_section'
    );

    //adding a input field
    add_settings_field(
      'dashboard_input',
      'Dashboard input test',
      [$this, 'mmae_movie_dashboard_input'],
      'admin_movie_submenu_dashboard',
      'mmae_settings_section'

    );

    //adding email taking field
    add_settings_field(
      'dashboard_email__input',
      'Email',
      [$this, 'email_field_callback'],
      'admin_movie_submenu_dashboard',
      'mmae_settings_section'
    );

    //radio box
    add_settings_field(
      'dashboard_radio_input',
      'Gender',
      [$this, 'radio_field_callback'],
      'admin_movie_submenu_dashboard',
      'mmae_settings_section'
    );

    //checkbox
    add_settings_field(
      'dashboard_checkbox_input',
      'Ownerships',
      [$this, 'dashboard_checkbox_input_callback'],
      'admin_movie_submenu_dashboard',
      'mmae_settings_section'
    );

    //dropdown
    add_settings_field(
      'select_your_favourite_brand',
      'Select your favourite brand',
      [$this, 'select_your_favourite_brand_callback'],
      'admin_movie_submenu_dashboard',
      'mmae_settings_section'
    );




    ///registring fields into groups
    register_setting('header_section', 'mmae_settings_name');
    register_setting('header_section', 'dashboard_input');
    register_setting('header_section', 'dashboard_email_input');
    register_setting('header_section', 'dashboard_radio_input');
    register_setting('header_section', 'dashboard_checkbox_input');
    register_setting('header_section', 'select_your_favourite_brand');

  }
  public function select_your_favourite_brand_callback()
  {
    $option = get_option('select_your_favourite_brand');
    ?>
    <select name="select_your_favourite_brand" id="cars">
      <option value="volvo" <?php selected($option, 'volvo'); ?>>Volvo</option>
      <option value="saab" <?php selected($option, 'saab'); ?>>Saab</option>
      <option value="mercedes" <?php selected($option, 'mercedes'); ?>>Mercedes</option>
      <option value="audi" <?php selected($option, 'audi'); ?>>Audi</option>
    </select>
    <?php
  }

  public function dashboard_checkbox_input_callback()
  {
    $options = get_option('dashboard_checkbox_input', []);
    ?>
    <input type="checkbox" id="vehicle1" name="dashboard_checkbox_input[]" value="Bike">
    <label for="vehicle1"> I have a bike</label><br>
    <input type="checkbox" id="vehicle2" name="dashboard_checkbox_input[]" value="Car">
    <label for="vehicle2"> I have a car</label><br>
    <input type="checkbox" id="vehicle3" name="dashboard_checkbox_input[]" value="Boat">
    <label for="vehicle3"> I have a boat</label><br><br>

    <?php

  }
  public function email_field_callback()
  {
    $option = get_option('dashboard_email_input');
    ?>
    <input type="email" name="dashboard_email_input" value="<?php echo esc_attr($option); ?>" />
    <?php
  }

  //radio buttons calllback
  public function radio_field_callback()
  {
    $option = get_option('dashboard_radio_input');
    ?>
    <input type="radio" id="male" name="dashboard_radio_input" value="Male" <?php checked($option, 'Male'); ?>>
    <label for="male">Male</label><br>
    <input type="radio" id="female" name="dashboard_radio_input" value="Female" <?php checked($option, 'Feale'); ?>>
    <label for="female">Female</label><br>
    <input type="radio" id="other" name="dashboard_radio_input" value="Other" <?php checked($option, 'Other'); ?>>
    <label for="Other">Other</label>

    <?php
  }
  public function mmae_settings_callback_function()
  {
    $option = get_option('mmae_settings_name');
    ?>
    <input type="textarea" name="mmae_settings_name" value="<?php echo esc_attr($option); ?>" />
    <?php

  }

  public function mmae_section_callback_function()
  {
    ?>
    <div style="border:1px solid black">
      <h1> This is section function </h1>
    </div>

    <?php
  }

  public function mmae_movie_dashboard_input()
  {
  
     $option = get_option('dashboard_input');
    ?>
    <input type="text" name="dashboard_input" value="<?php echo esc_attr($option); ?>" />
    <?php
  }


}