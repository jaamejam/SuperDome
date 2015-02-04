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
define('DB_USER', 'superdome');

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
define('AUTH_KEY',         'YY@ -2#F|D: 6)Zkb-LLMdAyE/)V~3-hv/UoW|,.HT$!rO%nT:1s>.10i^q-/[+^');
define('SECURE_AUTH_KEY',  '`|eg XO@js{hfkU+RKbn }* +xn!?zGRTb[#?--tcdA%j|~9:N@d7hgw(crn3-4,');
define('LOGGED_IN_KEY',    'qM/IB8!k_XDzDLYLJ[8r%R&j/W*bSL@,$F/+iW8Mt$<(+L0X+&0{n1|7Xehy8|y=');
define('NONCE_KEY',        'B*Q:lr,eQ|Tn=KrlHwvB214b)D-!]R>kR#+tzv7/ C`?_3t9=+SREiX*!cwbH$!S');
define('AUTH_SALT',        '|b>=+||BfD eMv?SXI}2<J:`U_1g8vhh/?g![a,9Nyx+p)doLEw;`-|%4vkgSoMu');
define('SECURE_AUTH_SALT', '[Klg+&hd!hg`(8+N-Pd-w([&PTE|0dmKJufSRYgC+hf=,nll;E5a}*oJdUkptYd#');
define('LOGGED_IN_SALT',   'gCv^Q+IRQ%<CJvQ&KJ!Xah+#rUQ}-_]-kf|OpUs@>3}<31_sAe4Ac%oOSQAK?~Uv');
define('NONCE_SALT',       'HsUJY6[%~BA- YeS4FdhtNS8ze,CC**8*>}#C}g%-4]+S[Dn-SBBz-+:u5wq;03e');

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

/* Multisite */
define( 'WP_ALLOW_MULTISITE', true );

/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');
