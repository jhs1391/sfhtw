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
<<<<<<< HEAD

/** Database username */
define( 'DB_USER', 'root' );

/** Database password */
define( 'DB_PASSWORD', 'root' );

/** Database hostname */
define( 'DB_HOST', 'localhost' );
=======
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
>>>>>>> 85e356d86661e21ee4792334970736d9997dff59

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
<<<<<<< HEAD
define( 'AUTH_KEY',          'HT<K,4~2[l4UUuZ5UjTc;I8f)#-.`ykMVQ>69[-k`BiyQhXoM[LXo%ByNJ iiqmE' );
define( 'SECURE_AUTH_KEY',   't:BLBr`2ObX/,c&Ub%CAdfON7Z2b*{DKmE$ycJt;D_`t+{d#HYQo]]eF*WZ#~i|9' );
define( 'LOGGED_IN_KEY',     'LSo{ONaUnVpq%{i|,Rz})wr_5|N7Y]^ 9zG$w_hqU6G8fRg VV6d$q<hsoZG)w.g' );
define( 'NONCE_KEY',         'mTS|LOQqg;plIB@%[xh67aT$I-JyXr1wEaYhYuO?Q>bar#FWqTFDOG;99`[]wkKO' );
define( 'AUTH_SALT',         'X[gl#uo6Md_ag7nAN4*BhihmNX?G+;Gn~g_#NF!% WH Xk&_IJNP77!XDVeo>4ke' );
define( 'SECURE_AUTH_SALT',  '>]`C:x9s8@g5tv[FglbP`S0h?X~K1|/uQ]{wQR&`#Te|?[{.YAg*[C<<n1-U,rX3' );
define( 'LOGGED_IN_SALT',    'SQi!NM@F&9R>]*YE{IJ1^PO(2-W!_#{_P0[xx%b^jX^|QR~28]%h .rpYqW16,v?' );
define( 'NONCE_SALT',        'i((6bHvKw4GxJ}v{jq6,F|g]DUFw`c^J<|E&xCPPT@>ko23{yU[).`[u.w{oxE`^' );
define( 'WP_CACHE_KEY_SALT', 'cc$RE^{sxHRo+`f98,z>dk1|wg<S45yZ${oUa2^8A-pP~R9e<6(J`ODe8m):F{-]' );
=======
>>>>>>> 85e356d86661e21ee4792334970736d9997dff59


/**#@-*/

/**
 * WordPress database table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'wp_';
<<<<<<< HEAD
=======
// $table_prefix = 'sfh_';
>>>>>>> 85e356d86661e21ee4792334970736d9997dff59


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
<<<<<<< HEAD
if ( ! defined( 'WP_DEBUG' ) ) {
	define( 'WP_DEBUG', false );
}

=======
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
>>>>>>> 85e356d86661e21ee4792334970736d9997dff59
define( 'WP_ENVIRONMENT_TYPE', 'local' );
/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
