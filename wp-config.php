<?php

// BEGIN iThemes Security - Do not modify or remove this line
// iThemes Security Config Details: 2
define( 'DISALLOW_FILE_EDIT', true ); // Disable File Editor - Security > Settings > WordPress Tweaks > File Editor
// END iThemes Security - Do not modify or remove this line

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
define('DB_NAME', 'kobujitsu');

/** MySQL database username */
define('DB_USER', 'root');

/** MySQL database password */
define('DB_PASSWORD', 'root');

/** MySQL hostname */
define('DB_HOST', 'localhost');

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
define('AUTH_KEY',         'nWHShV%}kmeK[i1*Tm2a)nhw+X8luuWG*4m>2}p{trWjtY@g1DsF0N;E_]RSX=OG');
define('SECURE_AUTH_KEY',  'DCkp;e^DfbszeJ>L_BkAn4KY4}9dACyy.xq{.CC> -Bh6UU0;?MD&S>]]}N.^[Bi');
define('LOGGED_IN_KEY',    'xjz_G07Ve,E@L_O4[N8zBt|9QzjGbbD=x[vIM+Q<}<(,!2]CrGDda:i#bp$ZeA#%');
define('NONCE_KEY',        'XZ4P$0?qc,v]#]Hn(.]z608(^9^!5ciQJ8f65%vM#G$by-S# Ee96poBJ-t:FP<<');
define('AUTH_SALT',        '6WCpdr@FoBj{mLXD2/G:t#OJ{`qm.ZI#:6Fc6>Y/g_B<8MXH`[s|{K~uxV6  2c-');
define('SECURE_AUTH_SALT', 'ZoX/q@*a+N./hC:717N^`r^dh!EeTSoz;lX?%McON,&q)u$e`kwN5Neoo]4Oh(eM');
define('LOGGED_IN_SALT',   'dH=aJLt1==!E[mivh4`7oYo_7`1vemyeq!>dOwprcg,,l0/2Frno]p;LnzeZId1x');
define('NONCE_SALT',       '4G/OVn>+@Q-ptX=o/*R4YBvrm=hH[0aHl=iS~dJ;b~,sB[arSW5CV_e0`GvYVxRF');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'wp_';

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
