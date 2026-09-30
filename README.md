# WP Disable Comments

The WP Disable Comments plugin for WordPress is designed to disable all WordPress comments and related functionality, providing a streamlined experience for your website users.

## Table of Contents

- [Features](#features)
- [Installation](#installation)
- [Usage](#usage)
- [Updates](#updates)
- [Development](#development)
- [Releasing](#releasing)
- [Support](#support)
- [Contributing](#contributing)

## Features

- Disables comments on the front end for all post types.
- Removes comment-related sections from the WordPress admin dashboard.
- Hides the "Comments" link from the admin toolbar.
- Disables comment feeds for a more streamlined experience.
- Eliminates comment-related widgets for a cleaner user interface.
- Removes comment-related JavaScript and CSS for improved performance.
- Disables comment notifications for a quieter comment management experience.
- Removes comments from dashboard widgets, providing a distraction-free environment.
- Disables comment-related REST API endpoints for enhanced security.
- Removes comment form from theme templates for a comment-free presentation.

## Installation

1. Download `wp-disable-comments.zip` from the latest [GitHub release](https://github.com/prolific-digital/wp-disable-comments/releases).
2. Upload the plugin folder to your WordPress plugin directory (usually `wp-content/plugins/`).
3. Activate the plugin through the 'Plugins' menu in your WordPress admin.

> This plugin requires PHP 8.4+ and WordPress 6.5+.

## Usage

Once the plugin is activated, all WordPress comments and related functionality are disabled. There are no settings; deactivate the plugin to restore comment features. Note that the plugin sets `comment_status` to `closed` on every existing post, and deactivating it does not reopen them.

The plugin stores no options.

## Updates

Updates are served by the Prolific Digital license server. Add the site's license key to `wp-config.php`:

```php
define( 'PROLIFIC_LICENSE_KEY_WP_DISABLE_COMMENTS', 'your-key' );
```

You can also supply the key with the `prolific_license_key` filter, which receives `( $key, 'wp-disable-comments' )`.

## Development

The dev site is the DDEV sandbox at `https://wp-sandbox.ddev.site`. Run commands in the container:

```sh
ddev exec -d /var/www/html/wp-content/plugins/wp-disable-comments composer install
ddev exec -d /var/www/html/wp-content/plugins/wp-disable-comments composer lint    # php -l on every file
ddev exec -d /var/www/html/wp-content/plugins/wp-disable-comments composer phpcs   # WordPress-Extra + PHPCompatibilityWP
```

`vendor/` is not committed. A git checkout needs `composer install` before the updater loads. The plugin itself still runs without it.

## Releasing

1. Bump the version in the plugin header, `WP_DISABLE_COMMENTS_VERSION` and `readme.txt` `Stable tag`.
2. Add a `## [x.y.z] - YYYY-MM-DD` section to `CHANGELOG.md` and a `= x.y.z =` entry to `readme.txt`.
3. Merge to `main`, then push a `vx.y.z` tag. The release workflow builds `wp-disable-comments.zip` (with `composer install --no-dev`, honoring `.distignore`) and attaches it to a GitHub Release.

CI and release logic live in the shared workflows in [`prolific-digital/.github`](https://github.com/prolific-digital/.github).
## Support

For support, feedback, or feature requests, please [submit an issue](https://github.com/prolific-digital/wp-disable-comments/issues) on GitHub.

## Contributing

We welcome contributions to improve the WP Disable Comments plugin. To contribute:

1. Fork the project.
2. Make your feature addition or bug fix.
3. Send us a pull request with a brief description of your changes.

> Before sending a pull request for a feature addition, please discuss it with us first. We want to ensure that changes align with the project's direction and goals.

## License

This project is licensed under GPL-2.0-or-later. See [LICENSE](LICENSE).

---

_Proudly crafted by Prolific Digital_
