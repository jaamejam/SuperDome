<?php
/**
 * The base configurations of the WordPress.
 *
 * This file has the following configurations: MySQL settings, Table Prefix,
 * Secret Keys, and ABSPATH. You can find more information by visiting
 * {@link http://codex.wordpress.org/Editing_wp-config.php Editing wp-config.php}
 * Codex page. You can get the MySQL settings from your web host.
 *
 * This file is used by the wp-config.php creation script during the
 * installation. You don't have to use the web site, you can just copy this file
 * to "wp-config.php" and fill in the values.
 *
 * @package WordPress
 */

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define('DB_NAME', 'Superdome');

/** MySQL database username */
define('DB_USER', 'Superdome');

/** MySQL database password */
define('DB_PASSWORD', 'superdome');

/** MySQL hostname */
define('DB_HOST', 'localhost');

/** Database Charset to use in creating database tables. */
define('DB_CHARSET', 'utf8');

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
define('AUTH_KEY',         'Bb@gULrrd+cWuLz$:{%g](vm;[;:G}WNV4}.R[ *2{S-{!yaO-nMU30;/9v;-0kC');
define('SECURE_AUTH_KEY',  'FI/^_c3>+{5 $(p_m#K,f7]Z|amR+rg>.1m<*gbJ(%16VLRVEePX|0whA-O0b:SQ');
define('LOGGED_IN_KEY',    '_bpl[c>ujc|,()qH@3Ra>8I.lkJY&{!sAc,3|)x)EG{IF(~,b^`^$$%qiXMM:h?l');
define('NONCE_KEY',        '&]~$7]sz|<,&7A9t))12Bx#k{)kQp7p3lv4@Gu!GsWncF3w6Q. hPq|WTJ>i-9.B');
define('AUTH_SALT',        'p75Y*JcbB;Ig_5vICX#P<]pt5<4zkPv<^6QD=%PDpiO,Od.h|njh}Gy?j}>Axyc!');
define('SECURE_AUTH_SALT', 'Btv)[?t+5JY<hpf+tq<D#D=GJ+qgvln5]BF1{ +W5Wryv.4!3y_1L]4NYon+?l2(');
define('LOGGED_IN_SALT',   'bde##M)9m@1*-}NGR.X@GU-)XH]MRU5guG-KA07+vD||8E)^l++ws ~XWNLy{:]l');
define('NONCE_SALT',       'I=SskRUm_,,O;F[P|?v;L-o7iE%aj>b`?](e+h]@jgue4,KLh-D>+xq([VY;;1L6');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each a unique
 * prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'wp_';

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
