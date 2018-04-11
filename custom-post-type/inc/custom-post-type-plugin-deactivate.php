<?php
/**
* @package CustomPostType
*/

class CustomPostTypePluginDeactivate
{
  public static function deactivate() {
    // flush rewrite rules
    flush_rewrite_rules();
  }
}
