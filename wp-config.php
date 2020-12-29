<?php
/**
 * The base configuration for WordPress
 *
 * The wp-config.php creation script uses this file during the
 * installation. You don't have to use the web site, you can
 * copy this file to "wp-config.php" and fill in the values.
 *
 * This file contains the following configurations:
 *
 * * MySQL settings
 * * Secret keys
 * * Database table prefix
 * * ABSPATH
 *
 * @link https://codex.wordpress.org/Editing_wp-config.php
 *
 * @package WordPress
 */

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'local' );

/** MySQL database username */
define( 'DB_USER', 'root' );

/** MySQL database password */
define( 'DB_PASSWORD', 'root' );

/** MySQL hostname */
define( 'DB_HOST', 'localhost' );

/** Database Charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8' );

/** The Database Collate type. Don't change this if in doubt. */
define( 'DB_COLLATE', '' );

/**
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         'U2scbt4MO7yNdCe0z8e1ArBlZxgXFWJHcjDdJWHcmw77Vn8gwmtLfHQg3y3vNiOuahD8b+4r+iGZw3xDobZU3g==');
define('SECURE_AUTH_KEY',  'Bg1mJiZqif4k+ZmJy4ZD/gDKKj0xh1/JKJP0Sr4a/4GFKjHOSMqGRzScLcKTFGtYMb/NX/eTKfyPj5IEWZN6HA==');
define('LOGGED_IN_KEY',    'hhfiz8TTGb5BtvKV1UKFn+/A+fvvT9cO+Rw7ABk/H067fbmCj44CsfILK+OlCVlZvc1X9bgc2QqvDRQNF95emw==');
define('NONCE_KEY',        'rEEKS9zlhkQy1h87OLDFDtSElBg+n0kDIh6Z456Vjvnz/IE0r2ooSQosmAEsmzK1w2sRBnpn0mMgg2BUldXuZg==');
define('AUTH_SALT',        'GHSu3p1uowd36eYTqzM9x3xm3JhzcGjKyVCxz5iHV1FaTGgrYrqdorHx2w+LUHWGwy9qQRglww26FWAQ+pCS3Q==');
define('SECURE_AUTH_SALT', 'D2Xpjv97lybG4qlY9qaucxAgD9ehdUN38JrpfkIrZaV3WGFL7IDzjVYLVjfiD3mDzTmblTMDFfgU9SVEFiX6eg==');
define('LOGGED_IN_SALT',   '6C6LK5M9gZEQOnBKZddJpTkeb3sBKbzMAnOfjCe+E/hUBIhNNohDdmmoVnP5fNLi3tWzBJAlWpowODWMsZU49g==');
define('NONCE_SALT',       'QlfcAw91PJvXPSHFAJK8Dmv/a6USIadsWSpwf+cWKDWP2764FO0aaOwI3oEurkAd6RxHVc13qV9eqrLNbaY9hg==');

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'wp_';




/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', dirname( __FILE__ ) . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
