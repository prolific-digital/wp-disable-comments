<?php

/**
 * Plugin Name: WP Disable Comments
 * Plugin URI: https://prolificdigital.com
 * Description: Disable all WordPress comments and related functionality for a streamlined experience.
 * Version: 1.0.0
 * Author: Prolific Digital
 * Author URI: https://prolificdigital.com
 * License: GPL3
 * License URI: https://www.gnu.org/licenses/gpl-3.0.html
 * Text Domain: wp-disable-comments
 * Domain Path: /languages
 */

// If this file is called directly, abort.
if (!defined('WPINC')) {
  die;
}

class WP_Disable_Comments_Plugin {
  public function __construct() {
    // Disable comments on the front end
    add_action('init', array($this, 'disable_comments'));

    // Remove comment-related sections from the admin dashboard
    add_action('admin_menu', array($this, 'remove_dashboard_sections'));

    // Hide the "Comments" link from the admin toolbar
    add_action('wp_before_admin_bar_render', array($this, 'hide_admin_toolbar_link'));

    // Disable Comment Feeds
    add_action('init', array($this, 'disable_comment_feeds'));

    // Disable Comment-related Widgets
    add_action('widgets_init', array($this, 'disable_comment_widgets'));

    // Disable Comment-related JS and CSS
    add_action('wp_enqueue_scripts', array($this, 'disable_comment_assets'), 100);
    add_action('admin_enqueue_scripts', array($this, 'disable_comment_assets'), 100);

    // Disable Comment Notifications
    add_filter('comment_notification_recipients', array($this, 'disable_comment_notifications'), 10, 2);

    // Remove Comments from Dashboard Widgets
    add_action('wp_dashboard_setup', array($this, 'remove_dashboard_comments_widget'));

    // Disable Comment-related REST API Endpoints
    add_filter('rest_endpoints', array($this, 'disable_comment_rest_endpoints'));

    // Remove Comment Form from the Theme Templates
    add_filter('comment_form_defaults', array($this, 'remove_comment_form'));
  }

  public function disable_comments() {
    // Remove support for comments and trackbacks from all post types
    $post_types = get_post_types();
    foreach ($post_types as $post_type) {
      if (post_type_supports($post_type, 'comments')) {
        remove_post_type_support($post_type, 'comments');
        remove_post_type_support($post_type, 'trackbacks');
      }
    }

    // Close comments on all existing posts
    $wpdb = $GLOBALS['wpdb'];
    $wpdb->query("UPDATE $wpdb->posts SET comment_status = 'closed'");

    // Disable the display of comments in the WP API
    add_filter('rest_allow_anonymous_comments', '__return_false');
  }

  public function remove_dashboard_sections() {
    remove_menu_page('edit-comments.php');
    remove_submenu_page('options-general.php', 'options-discussion.php');
  }

  public function hide_admin_toolbar_link() {
    if (is_admin_bar_showing()) {
      remove_action('admin_bar_menu', 'wp_admin_bar_comments_menu', 60);
    }
  }

  public function disable_comment_feeds() {
    add_filter('feed_links_show_comments_feed', '__return_false');
  }

  public function disable_comment_widgets() {
    unregister_widget('WP_Widget_Recent_Comments');
  }

  public function disable_comment_assets() {
    wp_dequeue_script('comment-reply');
    wp_dequeue_style('wp-admin');
  }

  public function disable_comment_notifications($notify, $comment_id) {
    return false;
  }

  public function remove_dashboard_comments_widget() {
    remove_meta_box('dashboard_recent_comments', 'dashboard', 'normal');
  }

  public function disable_comment_rest_endpoints($endpoints) {
    if (isset($endpoints['/wp/v2/comments'])) {
      unset($endpoints['/wp/v2/comments']);
    }
    if (isset($endpoints['/wp/v2/comments/(?P<id>[\d]+)'])) {
      unset($endpoints['/wp/v2/comments/(?P<id>[\d]+)']);
    }
    return $endpoints;
  }

  public function remove_comment_form($defaults) {
    $defaults['comment_form'] = null;
    return $defaults;
  }
}

// Instantiate the plugin class
new WP_Disable_Comments_Plugin();
