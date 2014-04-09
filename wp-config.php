<?php
define('WP_MEMORY_LIMIT', '64M');

/**
 * The base configurations of the WordPress.
 *
 * This file has the following configurations: MySQL settings, Table Prefix,
 * Secret Keys, WordPress Language, and ABSPATH. You can find more information
 * by visiting {@link http://codex.wordpress.org/Editing_wp-config.php Editing
 * wp-config.php} Codex page. You can get the MySQL settings from your web host.
 *
 * This file is used by the wp-config.php creation script during the
 * installation. You don't have to use the web site, you can just copy this file
 * to "wp-config.php" and fill in the values.
 *
 * @package WordPress
 */

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define('DB_NAME', 'the_midnight_mission');
//define('DB_NAME', 'cristalj_midnightmission');

/** MySQL database username */
define('DB_USER', 'root');
//define('DB_USER', 'cristalj_cann');

/** MySQL database password */
define('DB_PASSWORD', 'root');
//define('DB_PASSWORD', 'MMission');

/** MySQL hostname */
define('DB_HOST', 'localhost');

/** Database Charset to use in creating database tables. */
define('DB_CHARSET', 'utf8');

/** The Database Collate type. Don't change this if in doubt. */
define('DB_COLLATE', '');

/** Max upload file size **/
define('WP_MEMORY_LIMIT', '50M');

/**#@+
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         ']nback<M6,?a[@]?q!R~M}`$]JR:CjN@ii1+ xC|FnWT3KxBv0@@N< 9 cU7vx;;');
define('SECURE_AUTH_KEY',  'Moj<Z6^#.1P^A6=wDuaSMGo7(gz5I_C|A_9SD?>/<< g!oRJ&rDHZ.iNAqq</hj(');
define('LOGGED_IN_KEY',    'oxLd%;GrFKJ}-CSu*RV]&zO/YA)&.A`eq3WhGaf&YT</Y4IL9&rnqpMba~|6 **G');
define('NONCE_KEY',        '06%B.=?*5i]4!PyEClI~*^(Ct/@dy=fJ`?Gm2WC`>70gswd_@R?-2~F ?-^v`):e');
define('AUTH_SALT',        'inu@vfiM=w_]f+9&z,FSNDwAY:P1PvS_@kLql7?ylvYOhZ(L[x.9[vV5te(81dL>');
define('SECURE_AUTH_SALT', '(DkI>,Rl]h-:LU0(Vp%4kZ`1_`l3KFyxfo)sw*Z*3j=?{IvLK2^!@{uy^B^vJDMS');
define('LOGGED_IN_SALT',   '-zQPNEUho&Yq5M!f$RaoTYX7P&6*iGi[sq^K!sVQK*5R`]ah{q-viVc%{x=|J4mZ');
define('NONCE_SALT',       'WEt@jRvA?9XKZP{OXA3<tWM7nZU}UROjyK,6;B2&eg&/B]?3gYqpd_{4W?nYlWTW');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each a unique
 * prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'wp_';

/**
 * WordPress Localized Language, defaults to English.
 *
 * Change this to localize WordPress. A corresponding MO file for the chosen
 * language must be installed to wp-content/languages. For example, install
 * de_DE.mo to wp-content/languages and set WPLANG to 'de_DE' to enable German
 * language support.
 */
define('WPLANG', '');

/**
 * For developers: WordPress debugging mode.
 *
 * Change this to true to enable the display of notices during development.
 * It is strongly recommended that plugin and theme developers use WP_DEBUG
 * in their development environments.
 */
define('WP_DEBUG', false);

/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');

