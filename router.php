<?php
/**
 * Router script for the PHP built-in web server (`php -S`).
 *
 * Serves real files/directories directly (WordPress core, wp-content assets)
 * and routes every other request to WordPress so that pretty permalinks work.
 *
 * Usage: php -S localhost:8080 -t /workspace /workspace/router.php
 */
$root = __DIR__;
$path = urldecode( parse_url( $_SERVER['REQUEST_URI'], PHP_URL_PATH ) );
$file = realpath( $root . $path );

// Serve existing static files (but never raw PHP/config) directly.
if ( $path !== '/' && $file && strpos( $file, $root ) === 0 && is_file( $file ) ) {
	$ext = strtolower( pathinfo( $file, PATHINFO_EXTENSION ) );
	if ( $ext !== 'php' ) {
		return false; // Let the built-in server stream the asset as-is.
	}
}

// Let WordPress admin / login / core PHP entry points run normally.
if ( preg_match( '#^/wp/#', $path ) && $file && is_file( $file ) && strtolower( pathinfo( $file, PATHINFO_EXTENSION ) ) === 'php' ) {
	chdir( dirname( $file ) );
	require $file;
	return true;
}

// Everything else goes through the WordPress front controller.
$_SERVER['SCRIPT_NAME'] = '/index.php';
require $root . '/index.php';
