=== WP Disable Comments ===
Contributors: prolificdigital
Tags: comments, disable comments, spam
Requires at least: 6.5
Tested up to: 7.1
Requires PHP: 8.4
Stable tag: 1.1.0
License: GPL-2.0-or-later
License URI: https://www.gnu.org/licenses/gpl-2.0.html

Disables WordPress comments and related functionality across the front end, admin, feeds and REST API.

== Description ==

Activate the plugin and comments are gone site-wide. There are no settings.

* Removes comment and trackback support from every post type and closes comments on existing posts.
* Removes the Comments and Discussion admin menus, the admin-bar Comments link and the Recent Comments dashboard widget.
* Hides the comment feed link and unregisters the Recent Comments widget.
* Dequeues the `comment-reply` script.
* Turns off comment notification emails.
* Removes the `/wp/v2/comments` REST endpoints.

Note: existing posts have `comment_status` set to `closed`. Deactivating the plugin does not reopen them.

== Installation ==

1. Upload the `wp-disable-comments` folder to `/wp-content/plugins/`, or install the release zip from **Plugins > Add New > Upload Plugin**.
2. Activate the plugin.
3. To receive automatic updates, add your license key to `wp-config.php`:
   `define( 'PROLIFIC_LICENSE_KEY_WP_DISABLE_COMMENTS', 'your-key' );`

== Changelog ==

= 1.1.0 =
* Updates now come from the Prolific Digital license server. Define `PROLIFIC_LICENSE_KEY_WP_DISABLE_COMMENTS` to receive them.
* Main file renamed to `wp-disable-comments.php`; reactivate the plugin once after updating.
* License changed from GPL-3.0 to GPL-2.0-or-later.
* Requires WordPress 6.5+ and PHP 8.4+.

= 1.0.0 =
* Initial release.
