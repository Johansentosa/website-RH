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
define('DB_NAME', 'bubatest');

/** MySQL database username */
define('DB_USER', 'root');

/** MySQL database password */
define('DB_PASSWORD', '');

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
define('AUTH_KEY',         'vOisqShr_Jz^79u0@*U1>|r{O.{RGMT!S&WTHh?lEEt8]47vg$)KKucz8Zm>iOHT');
define('SECURE_AUTH_KEY',  'C,~MF1vlS,:tw7ixlnQSnn:xc|fg9GK:]egSRg^5qe*xGx4gxWzOXlP1ihz3kL/J');
define('LOGGED_IN_KEY',    'EoDiqjFSjD3vBq]sQ;@tAX?A.g X]1d%Kw=sLMKT!tax<KHzS,=O7`A2snn:D=Kg');
define('NONCE_KEY',        'aofj<swn;r.z+P<_m8}FO%~(!mvHm:{Bke}lr>Hkl}d6`J]U(bX}F3;*Xtbno9*K');
define('AUTH_SALT',        'hP;_Blvk|D:NU7n.C;-H8p9.QW^.Hs98okz(M(1leV>4r]%H@+=hl8,PfI~JFu&c');
define('SECURE_AUTH_SALT', 'V_*txb!hWg+7&z_iB82?dGU&82Lz_sFTsYMk7h}p2VS e+MlQqyTq,G87Us*JF/~');
define('LOGGED_IN_SALT',   ']svIwBcH$6pJ854SGsn0d?uM!HdK{I9,RFP^gV)FP(!y]SXGzcBCSPPUjO5:gX_<');
define('NONCE_SALT',       '0j+Slmdig(=Ob_mYp&DWKZ>wL#kx+)~zC3iXff(I:Cza*V6n&RZN>!s~#Ff>,Gv*');

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
