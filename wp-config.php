<?php
/**
 * The base configuration for WordPress
 *
 * The wp-config.php creation script uses this file during the installation.
 * You don't have to use the web site, you can copy this file to "wp-config.php"
 * and fill in the values.
 *
 * This file contains the following configurations:
 *
 * * Database settings
 * * Secret keys
 * * Database table prefix
 * * Localized language
 * * ABSPATH
 *
 * @link https://wordpress.org/support/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** Database settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'local' );
// define( 'DB_NAME', 'defaultdb' );

/** Database username */
define( 'DB_USER', 'root' );
// define( 'DB_USER', 'doadmin' );

/** Database password */
define( 'DB_PASSWORD', 'root' );
// define( 'DB_PASSWORD', 'AVNS_1jyJw1p9cB9fPXDB5eM' );

/** Database hostname */
define( 'DB_HOST', 'localhost' );
// define( 'DB_HOST', 'sfh-dev-do-user-8651349-0.b.db.ondigitalocean.com:25060' );

/** Database charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8' );

/** The database collate type. Don't change this if in doubt. */
define( 'DB_COLLATE', '' );

/**#@+
 * Authentication unique keys and salts.
 *
 * Change these to different unique phrases! You can generate these using
 * the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}.
 *
 * You can change these at any point in time to invalidate all existing cookies.
 * This will force all users to have to log in again.
 *
 * @since 2.6.0
 */


/**#@-*/

/**
 * WordPress database table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'wp_';
// $table_prefix = 'sfh_';


/* Add any custom values between this line and the "stop editing" line. */



/**
 * For developers: WordPress debugging mode.
 *
 * Change this to true to enable the display of notices during development.
 * It is strongly recommended that plugin and theme developers use WP_DEBUG
 * in their development environments.
 *
 * For information on other constants that can be used for debugging,
 * visit the documentation.
 *
 * @link https://wordpress.org/support/article/debugging-in-wordpress/
 */
define( 'WP_DEBUG', true );
define( 'WP_DEBUG_LOG', false );


define( 'AUTH_KEY', 'WW9Z9fM/MnN+UplJVsVWoEEeLccTAo1VZNRwuX5qSYlSFuAt3nk4EHecEmStzrNQtL7uc8QDBCHs9engbubgzA==' );
define( 'SECURE_AUTH_KEY', '79SWkZirVx+WSq/SM4hLxkSspQrQwCZT1cBQ9hnfU6locERWqWf6w7oUH0dt8xBju5oH6V8Y6ToCjfcFOx6PEw==' );
define( 'LOGGED_IN_KEY', 'nkc4L5WE4tFIWwTe6RZ5NYZJzD6CaLxWxazDe0z0NSXGvM3pusSpbFeUZZgKW/ImIStGnNw6e8IN+BnVexax+w==' );
define( 'NONCE_KEY', 'GWfC7pPu/WfSbiAH98j5KDx9emUpdFPB/BPTc5ioH2fgFXqB8aLMcbJ3V7mN/a4QJOSS2OA/X3PEXa8YNAVoAA==' );
define( 'AUTH_SALT', 'omyanO30B2H4aInlK561G1Q1ZtUTOlhbtN3TGsBMrwbALikJFfclFDT7sVeWemxptli5R9w1W8Aj69CjdDkFpA==' );
define( 'SECURE_AUTH_SALT', 'fRBeZT6c6J2QOxQtZ+rpErdi3uac4PCn4BYaZ/3FOKLv2X3xYTP3yj/EFfWnPB016GOzjsqYbUE//Fgw8PSGFA==' );
define( 'LOGGED_IN_SALT', 'wwY4DAkt+kHRxGU+qkQo31fBowYLETaVNcSQ6KpZRKAtXSsyYQ9y8XZL9s0gvg+KC0spwz8bHF2qIlbFM1ICAA==' );
define( 'NONCE_SALT', '/5P8iWyDEwvCSXroEaY/QUeewoX4ssEJhZO7yo5330LXDOEl3LqrPDsBaHD3820lERjkpxeWMwhJZCZ1jyZatA==' );
define( 'WP_ENVIRONMENT_TYPE', 'local' );
/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
