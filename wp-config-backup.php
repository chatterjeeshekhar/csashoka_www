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
define('DB_NAME', 'csashoka');

/** MySQL database username */
define('DB_USER', 'XXXXXX');

/** MySQL database password */
define('DB_PASSWORD', 'XXXXXX');

/** MySQL hostname */
define('DB_HOST', 'XXXXXX');

/** Database Charset to use in creating database tables. */
define('DB_CHARSET', 'utf8mb4');

/** The Database Collate type. Don't change this if in doubt. */
define('DB_COLLATE', '');

/**#@+
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         '^Ny.2{yi;pxVASCpd{;c|eE^^Pf9SzNmW=<0]C6?9-H(?z+o9AMyKPvbiXW@(I[ ');
define('SECURE_AUTH_KEY',  'rUgZu%6%O:z;jF4t[y,[K;<eZqMKfHzZ_yuJFf9s^O6WJ+/kqR(TB/Mm=)Iu`SSG');
define('LOGGED_IN_KEY',    '-p];^o}l=4(zs]4/}^gHi&)VO3CqeE-Z/+011fGwN<[jV=x,O>&T`kRq/+)0NgB^');
define('NONCE_KEY',        '@;(k`!Fb;J2I19Xw@By#!RT[$gDsO|442g37N,<,_(X<if-KKt_2A5U$O-*}6I9F');
define('AUTH_SALT',        'mcNktdq1UJ2u7_?i?,Lc<XU+v#5)lQGn4A&<6QEA>?/!-ClmY[N78$e~zs{n^C*H');
define('SECURE_AUTH_SALT', 'e=9~rTLv(]C x?I.h??Y8M93_`b}s9iHA#GmoXl))l-](1#R6tLaJn`:TK>9M{b8');
define('LOGGED_IN_SALT',   '&Y.(&-X!0y7EWDT9Au_`<ib.T0;0^5-hbLx2FlP.XP&&wzuop.^SxTAs3zxjitw7');
define('NONCE_SALT',       'z9*T4_,qRP(f1 B)F&8l*Ww#?NWVt?PIgu*No8!cLq1q!nC8H;lJDF$rb]=Gr2.J');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'cs_';

/**
 * For developers: WordPress debugging mode.
 *
 * Change this to true to enable the display of notices during development.
 * It is strongly recommended that plugin and theme developers use WP_DEBUG
 * in their development environments.
 *
 * For information on other constants that can be used for debugging,
 * visit the Codex.
 *
 * @link https://codex.wordpress.org/Debugging_in_WordPress
 */
define('WP_DEBUG', false);

/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');
