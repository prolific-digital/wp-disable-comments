# Changelog

All notable changes to the "WP Disable Comments" plugin will be documented in this file.

The format is based on [Keep a Changelog](https://keepachangelog.com/en/1.1.0/) and this project adheres to [Semantic Versioning](https://semver.org/spec/v2.0.0.html).

## [Unreleased]

## [1.1.0] - 2026-09-29

### Changed
- Adopted the Prolific plugin standard. Updates now come from the Prolific Digital license server (`api.prolificdigital.io`). Set `PROLIFIC_LICENSE_KEY_WP_DISABLE_COMMENTS` in `wp-config.php` (or use the `prolific_license_key` filter) to receive updates.
- The main file is renamed from `index.php` to `wp-disable-comments.php`. Reactivate the plugin once after updating.
- License changed from GPL-3.0 to GPL-2.0-or-later.
- Requires WordPress 6.5+ and PHP 8.4+.

### Added
- `WP_DISABLE_COMMENTS_VERSION` constant and translation loading from `languages/`.
- `readme.txt`, coding-standards config and CI/release workflows.

## [1.0.0] - 2023-07-30

### Added

- Initial release of the plugin.
- Disabled comments on the front end for all post types.
- Removed comment-related sections from the WordPress admin dashboard.
- Hidden the "Comments" link from the admin toolbar.
- Disabled Comment Feeds for a more streamlined experience.
- Eliminated comment-related widgets for a cleaner user interface.
- Removed comment-related JavaScript and CSS for improved performance.
- Disabled comment notifications for a quieter comment management experience.
- Removed comments from dashboard widgets, providing a distraction-free environment.
- Disabled comment-related REST API endpoints for enhanced security.
- Removed comment form from theme templates for a comment-free presentation.

[Unreleased]: https://github.com/prolific-digital/wp-disable-comments/compare/v1.1.0...HEAD
[1.1.0]: https://github.com/prolific-digital/wp-disable-comments/compare/v1.0.0...v1.1.0
[1.0.0]: https://github.com/prolific-digital/wp-disable-comments/releases/tag/v1.0.0
