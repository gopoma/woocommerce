<?php
/**
 * The base configuration for WordPress
 *
 * The wp-config.php creation script uses this file during the installation.
 * You don't have to use the website, you can copy this file to "wp-config.php"
 * and fill in the values.
 *
 * This file contains the following configurations:
 *
 * * Database settings
 * * Secret keys
 * * Database table prefix
 * * ABSPATH
 *
 * @link https://wordpress.org/documentation/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** Database settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'bitnami_wordpress' );

/** Database username */
define( 'DB_USER', 'bn_wordpress' );

/** Database password */
define( 'DB_PASSWORD', '49bd417f8f4dcd0a4cc9d42e5aee76607aa7d11530b57b1c9a15525bdcfd4583' );

/** Database hostname */
define( 'DB_HOST', '127.0.0.1:3306' );

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
define( 'AUTH_KEY',         'vD 1($W<Zp$<G&W4Aq[eQoa6BUjIbrqw]<~=woX/QI[p<y$<{Ay2Hih71ogK%2wZ' );
define( 'SECURE_AUTH_KEY',  '] W;OV>HK_DdXyVVU-TsKR1SB7Rte{4XJWH0#%3m q$cV=&E*W[6$z3M~d&t|fq@' );
define( 'LOGGED_IN_KEY',    '2u6-#BO%_lAL$[XE.DiBY#=*+J?:#T!9W@g.V*G|%:KXv`h8Fx+(KM})socXi4*]' );
define( 'NONCE_KEY',        '%}*%sW2G]NZ}q71i`3fElzm7GMDJc:VdJzmq.j{Z5+G&~[jv)I)n~a_YO$u9DQ*b' );
define( 'AUTH_SALT',        'Khx/kGRL0{l!l%Sti wa!u*Kf;WT^cZWL$lV/4/r.*$8kC9-2y/,Uw4dQN*i=%o' );
define( 'SECURE_AUTH_SALT', 'C*Yst]W2 rVmAw)[hG0NG1kuycJ}E_GY+^{#P]?wLD]H^L_iSg9;mO^F?eLX&-gh' );
define( 'LOGGED_IN_SALT',   '4Y4L~[GAK$NcN<=7Lx~*Jm^wj[WbYCuL[UnU;URE(TH|=<c+|SRh9H*bN~jxBq(Q' );
define( 'NONCE_SALT',       'WcG%-`%}:/I~wu9+>FUUA$K[x{=@:[j-#5~NygTc8HPY.7%h&+l@!*i0`6!557!i' );

/**#@-*/

/**
 * WordPress database table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'wp_';

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
 * @link https://wordpress.org/documentation/article/debugging-in-wordpress/
 */
define( 'WP_DEBUG', false );

/* Add any custom values between this line and the "stop editing" line. */



define( 'FS_METHOD', 'direct' );
/**
 * The WP_SITEURL and WP_HOME options are configured to access from any hostname or IP address.
 * If you want to access only from an specific domain, you can modify them. For example:
 *  define('WP_HOME','http://example.com');
 *  define('WP_SITEURL','http://example.com');
 *
 */
if ( defined( 'WP_CLI' ) ) {
	$_SERVER['HTTP_HOST'] = '127.0.0.1';
}

define( 'WP_HOME', 'http://' . $_SERVER['HTTP_HOST'] . '/' );
define( 'WP_SITEURL', 'http://' . $_SERVER['HTTP_HOST'] . '/' );
define( 'WP_AUTO_UPDATE_CORE', 'minor' );
/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';

/**
 * Disable pingback.ping xmlrpc method to prevent WordPress from participating in DDoS attacks
 * More info at: https://docs.bitnami.com/general/apps/wordpress/troubleshooting/xmlrpc-and-pingback/
 */
if ( !defined( 'WP_CLI' ) ) {
	// remove x-pingback HTTP header
	add_filter("wp_headers", function($headers) {
		unset($headers["X-Pingback"]);
		return $headers;
	});
	// disable pingbacks
	add_filter( "xmlrpc_methods", function( $methods ) {
		unset( $methods["pingback.ping"] );
		return $methods;
	});
}
