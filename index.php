<?php
/**
 * Front controller for the IUVENTA WordPress site.
 *
 * WordPress core is installed in the /wp subdirectory while the site is served
 * from the repository root (the "Giving WordPress its own directory" pattern).
 */
define( 'WP_USE_THEMES', true );
require __DIR__ . '/wp/wp-blog-header.php';
