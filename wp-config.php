<?php
/**
 * WordPress configuration for Render deployment
 */

// Database settings from environment variables
define('DB_NAME', getenv('DATABASE_NAME') ?: 'wordpress');
define('DB_USER', getenv('DATABASE_USER') ?: 'wordpress');
define('DB_PASSWORD', getenv('DATABASE_PASSWORD') ?: 'password');
define('DB_HOST', getenv('DATABASE_HOST') ?: 'localhost');
define('DB_CHARSET', 'utf8mb4');
define('DB_COLLATE', '');

// Security keys - use environment variables or generate new ones
define('AUTH_KEY',         getenv('AUTH_KEY') ?: 'put your unique phrase here');
define('SECURE_AUTH_KEY',  getenv('SECURE_AUTH_KEY') ?: 'put your unique phrase here');
define('LOGGED_IN_KEY',    getenv('LOGGED_IN_KEY') ?: 'put your unique phrase here');
define('NONCE_KEY',        getenv('NONCE_KEY') ?: 'put your unique phrase here');
define('AUTH_SALT',        getenv('AUTH_SALT') ?: 'put your unique phrase here');
define('SECURE_AUTH_SALT', getenv('SECURE_AUTH_SALT') ?: 'put your unique phrase here');
define('LOGGED_IN_SALT',   getenv('LOGGED_IN_SALT') ?: 'put your unique phrase here');
define('NONCE_SALT',       getenv('NONCE_SALT') ?: 'put your unique phrase here');

// WordPress table prefix
$table_prefix = getenv('TABLE_PREFIX') ?: 'wp_';

// WordPress debugging
define('WP_DEBUG', getenv('WP_DEBUG') === 'true');
define('WP_DEBUG_LOG', getenv('WP_DEBUG_LOG') === 'true');
define('WP_DEBUG_DISPLAY', getenv('WP_DEBUG_DISPLAY') === 'true');

// Force SSL if HTTPS is available
if (isset($_SERVER['HTTP_X_FORWARDED_PROTO']) && $_SERVER['HTTP_X_FORWARDED_PROTO'] === 'https') {
    $_SERVER['HTTPS'] = 'on';
    define('FORCE_SSL_ADMIN', true);
}

// WordPress URLs - use environment variables for flexibility
if (getenv('WP_HOME')) {
    define('WP_HOME', getenv('WP_HOME'));
}
if (getenv('WP_SITEURL')) {
    define('WP_SITEURL', getenv('WP_SITEURL'));
}

// File permissions
define('FS_METHOD', 'direct');

// Memory limit
define('WP_MEMORY_LIMIT', getenv('WP_MEMORY_LIMIT') ?: '256M');

// Automatic updates
define('WP_AUTO_UPDATE_CORE', true);

// Disable file editing in admin
define('DISALLOW_FILE_EDIT', true);

// That's all, stop editing! Happy publishing.
if (!defined('ABSPATH')) {
    define('ABSPATH', __DIR__ . '/');
}

require_once ABSPATH . 'wp-settings.php';