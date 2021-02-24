<?php

/*
Plugin Name: Elms Disable Emojis
Description: WordPress comes with a lot of built in emojis that we don't use on the site. Since everything that is loaded slows down the site to some degree, removing this will make things faster. 
Version: 1.0
Author: Ryan Millner <millnerr@elms.edu>
*/


/**
 * Define the plugin version
 */
define("Elms Disable Emojis", "1.0");


  /**
   * Disable the emoji's
   */
  function disable_emojis() {
    remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
    remove_action( 'admin_print_scripts', 'print_emoji_detection_script' );
    remove_action( 'wp_print_styles', 'print_emoji_styles' );
    remove_action( 'admin_print_styles', 'print_emoji_styles' );
    remove_filter( 'the_content_feed', 'wp_staticize_emoji' );
    remove_filter( 'comment_text_rss', 'wp_staticize_emoji' );
    remove_filter( 'wp_mail', 'wp_staticize_emoji_for_email' );

    // Remove from TinyMCE
    add_filter( 'tiny_mce_plugins', 'disable_emojis_tinymce' );
  }
  add_action( 'init', 'disable_emojis' );

  /**
   * Filter out the tinymce emoji plugin.
   */
  function disable_emojis_tinymce( $plugins ) {
    if ( is_array( $plugins ) ) {
      return array_diff( $plugins, array( 'wpemoji' ) );
    } else {
      return array();
    }
  }

?>