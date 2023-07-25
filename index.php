<?php

/**
 * Plugin Name: WP Disable Comments
 * Description: Disable all WordPress comments and related functionality for a streamlined experience.
 * Version: 0.1.0
 * Author: Prolific Digital
 * License: GPL3
 * Text Domain: wp-disable-comments
 */

// If this file is called directly, abort.
if (!defined('WPINC')) {
  die;
}

// Disable comments on the front end
function wp_disable_comments_disable() {
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

add_action('init', 'wp_disable_comments_disable');

// Remove comment-related sections from the admin dashboard
function wp_disable_comments_remove_sections() {
  remove_menu_page('edit-comments.php');
  remove_submenu_page('options-general.php', 'options-discussion.php');
}

add_action('admin_menu', 'wp_disable_comments_remove_sections');

// Hide the "Comments" link from the admin toolbar
function wp_disable_comments_hide_link() {
  if (is_admin_bar_showing()) {
    remove_action('admin_bar_menu', 'wp_admin_bar_comments_menu', 60);
  }
}

add_action('wp_before_admin_bar_render', 'wp_disable_comments_hide_link');

// Disable Comment Feeds
function wp_disable_comments_disable_feed() {
  add_filter('feed_links_show_comments_feed', '__return_false');
}

add_action('init', 'wp_disable_comments_disable_feed');

// Disable Comment-related Widgets
function wp_disable_comments_disable_widgets() {
  unregister_widget('WP_Widget_Recent_Comments');
}

add_action('widgets_init', 'wp_disable_comments_disable_widgets');

// Disable Comment-related JS and CSS
function wp_disable_comments_disable_assets() {
  wp_dequeue_script('comment-reply');
  wp_dequeue_style('wp-admin');
}

add_action('wp_enqueue_scripts', 'wp_disable_comments_disable_assets', 100);
add_action('admin_enqueue_scripts', 'wp_disable_comments_disable_assets', 100);

// Disable Comment Notifications
function wp_disable_comments_disable_notifications($notify, $comment_id) {
  return false;
}

add_filter('comment_notification_recipients', 'wp_disable_comments_disable_notifications', 10, 2);

// Remove Comments from Dashboard Widgets
function wp_disable_comments_remove_dashboard_comments_widget() {
  remove_meta_box('dashboard_recent_comments', 'dashboard', 'normal');
}

add_action('wp_dashboard_setup', 'wp_disable_comments_remove_dashboard_comments_widget');

// Disable Comment-related REST API Endpoints
function wp_disable_comments_disable_rest_endpoints($endpoints) {
  if (isset($endpoints['/wp/v2/comments'])) {
    unset($endpoints['/wp/v2/comments']);
  }
  if (isset($endpoints['/wp/v2/comments/(?P<id>[\d]+)'])) {
    unset($endpoints['/wp/v2/comments/(?P<id>[\d]+)']);
  }
  return $endpoints;
}

add_filter('rest_endpoints', 'wp_disable_comments_disable_rest_endpoints');

// Remove Comment Form from the Theme Templates
function wp_disable_comments_remove_comment_form($defaults) {
  $defaults['comment_form'] = null;
  return $defaults;
}

add_filter('comment_form_defaults', 'wp_disable_comments_remove_comment_form');
