<?php
/**
* @package CustomPostType
*/

class CustomPostTypePluginActivate
{
  public static function activate() {
    // flush rewrite rules
    flush_rewrite_rules();
  }
}

