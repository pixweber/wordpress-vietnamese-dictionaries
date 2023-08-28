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
 * * ABSPATH
 *
 * @link https://wordpress.org/support/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** Database settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', '' );

/** Database username */
define( 'DB_USER', '' );

/** Database password */
define( 'DB_PASSWORD', '' );

/** Database hostname */
define( 'DB_HOST', '' );

/** Database charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8mb4' );

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
define( 'AUTH_KEY',         'V(?dOMFagS+MSCb( JJI<B`Fo?|Aw&Ddck:9@0&kS|+S8eXa%Ux=PZMY9K76$q9@' );
define( 'SECURE_AUTH_KEY',  'E]bTV ]>GW)4ib|U~7?@.]YN2z:[|#pH(o &mcV08U95;|i:#s%Eo}xllWXu$qr?' );
define( 'LOGGED_IN_KEY',    'Pui 6I1b@,j4hpJk<Dqs+D;BZTpX^T~;I]7il!>^6hP?r~M^mFZ H@6dV(9s(NG]' );
define( 'NONCE_KEY',        '$t!2x+sqZ2TN{rqi@hH{nd|/`[De#o2>QwC=(4l/I>/J{r1;Cp=4^>F?coNx:#^E' );
define( 'AUTH_SALT',        '5p#^O%a=oLMSTN=>MNwOFm&BgMtOTCCZ0a@B.a=%A.f<TTtz>J_oNsn/+sJ6*0Q)' );
define( 'SECURE_AUTH_SALT', '9w;!}t?7tF30:{gOtay`]@*jZOT!j*#8u{ln(fKc@C6$/v6Wa#t6>!<nBQv(5c[K' );
define( 'LOGGED_IN_SALT',   '5WtbZ%[I=w#GV=-T!>tD!cLABZQK>QL QN/yl1xG/I7##XeFuW44m>`?J]VI!QYF' );
define( 'NONCE_SALT',       'F]SpvaR/K7L+T&k4Is[ahX}lZU.do83z8j,ChrW+DS9?lz~iKRL` />8{OZ*}j+t' );

/**#@-*/

/**
 * WordPress database table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'td111_';

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
define( 'WP_DEBUG', false );

/* Add any custom values between this line and the "stop editing" line. */



/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
