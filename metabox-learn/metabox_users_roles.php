<?php

namespace Wp_content\Plugins\Metabox_learn;

class Metabox_users_roles
{
  public function __construct()
  {
    // Add the simple_role.
    add_action('admin_menu', array($this, 'wporg_simple_role'));

  }

  public function wporg_simple_role()
  {
    
    add_role(
      'themegrill_dev',
      'Themegrill Dev',
      array(
        'read' => true,
        'edit_posts' => true,
        'upload_files' => true,
      ),
    );

    add_role(
      'themegrill_alumn',
      'Themegrill Alumni',
      array(
        'read' => true,
        'edit_posts' => true,
        'upload_files' => true,
      ),
    );
  }




}