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
 * @link https://wordpress.org/support/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'haussaus_shopdb' );

/** MySQL database username */
define( 'DB_USER', 'haussaus_shopdb' );

/** MySQL database password */
define( 'DB_PASSWORD', '!9pzW&6~-ng~' );

/** MySQL hostname */
define( 'DB_HOST', 'localhost' );

/** Database Charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8mb4' );

/** The Database Collate type. Don't change this if in doubt. */
define( 'DB_COLLATE', '' );

/**#@+
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define( 'AUTH_KEY',         'AVED+&n:Fx=h`lQNuB*{v)T6rb,~m@UY{?heA)kyZ(nkeJw@_x;Oe@`Ld$mXOmw)' );
define( 'SECURE_AUTH_KEY',  '4}pkdYlj(Am?Uz^xhTw~_fI%B$%f#uat3>Td;W?HGfCG*cN%:c3bv,m1BUbV1by!' );
define( 'LOGGED_IN_KEY',    '%-@5hkb&?1,dUxm&MP@hqhBj,D h,B84WKq]SE Ki6et;A{1i5X^x5d2%3<QPMVX' );
define( 'NONCE_KEY',        'w=hp+%H9!||,@ =)8=Im@E*j^:KcpZN][*6ZlP0,K$ndBI~PKq8}^H_BN?5eJ,f2' );
define( 'AUTH_SALT',        'E==C1XFjL3_(>`YK!>p/3os =v2|/kQQ7(U@2L.tCwvFhv/%lGn!S 4 )1PMrg-K' );
define( 'SECURE_AUTH_SALT', 'IzOTHA$UXS6v|9]Ht*)5B@aE[vzt,yr0k@9litTZqys/wZg#^|H:/bujBF)lEAP%' );
define( 'LOGGED_IN_SALT',   'dvKit1>ty|Ko ngx%]%o*3o-gZmnhO}:)?W7&!_FD>a<Q![4%,G=yZ:/YeDg%*mz' );
define( 'NONCE_SALT',       'XV|*yEMcBndhAVk*a2w ?N{h>@6i8 JoZa27~ZguwjkTxjZ@A!:u&x*!2oLtOn{m' );

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'hs_';

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

define('ALLOW_UNFILTERED_UPLOADS', true);
define('WP_MEMORY_LIMIT', '512M');

/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
