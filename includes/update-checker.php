<?php
/**
 * Automatic updates from the Prolific Digital license server.
 *
 * Loaded from the main plugin file after Composer's autoloader. The license
 * key is read from the PROLIFIC_LICENSE_KEY_WP_DISABLE_COMMENTS constant
 * (wp-config.php) and can be overridden with the `prolific_license_key` filter.
 *
 * @package WPDisableComments
 */

defined( 'ABSPATH' ) || exit;

use YahnisElsts\PluginUpdateChecker\v5\PucFactory;

if ( ! class_exists( PucFactory::class ) ) {
	return;
}

( static function (): void {
	$update_checker = PucFactory::buildUpdateChecker(
		'https://api.prolificdigital.io/api/update?plugin=wp-disable-comments',
		WP_DISABLE_COMMENTS_PLUGIN_FILE,
		'wp-disable-comments'
	);
	$update_checker->addQueryArgFilter(
		static function ( array $args ): array {
			$key = defined( 'PROLIFIC_LICENSE_KEY_WP_DISABLE_COMMENTS' ) ? constant( 'PROLIFIC_LICENSE_KEY_WP_DISABLE_COMMENTS' ) : '';
			$key = (string) apply_filters( 'prolific_license_key', $key, 'wp-disable-comments' );
			if ( '' !== $key ) {
				$args['license_key'] = $key;
			}
			return $args;
		}
	);
} )();
