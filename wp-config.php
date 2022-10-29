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
define( 'DB_NAME', 'landshop' );

/** Database username */
define( 'DB_USER', 'root' );

/** Database password */
define( 'DB_PASSWORD', '' );

/** Database hostname */
define( 'DB_HOST', 'localhost' );

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
define( 'AUTH_KEY',         '/nG29M(DPwLOl5GTnh#.Klk~}y*IMl2JGP{{f,fA$f`$qNwC(7N_IO*g-OMTL#$P' );
define( 'SECURE_AUTH_KEY',  'eriC,{OPYz#P&5U^?$IpHq^HZbs=8{Z{8k.EIz^U. y(+m+vJ]o[D z#U!``IJco' );
define( 'LOGGED_IN_KEY',    '5^L(&eX.zSk|jt3BwP))M3Uv%{R:X^ah4k+1v-,*:(Yc0(<VdPl5K=4dJO7@|F_U' );
define( 'NONCE_KEY',        'q0rIiyQ#2Im)0)}k$+3HI4c6^GgLKIQF!6JL*3nq5U9G!b?P; enJ(igH,:PI/nb' );
define( 'AUTH_SALT',        'fjf)kL4Nn=^DaoDkxH.?-bJIyx<RZ{J0lb@-oNxgFV]:(M]~j^ A2@MPA5#!~:&r' );
define( 'SECURE_AUTH_SALT', '|zRAVC|`-~1-K3Sm@^-kM~GB>y_4IN iM#2mf3r4hot2k1Vrz@/aED (V4Y~DF^]' );
define( 'LOGGED_IN_SALT',   'soC@%& ed~=uG{`;64)Dx,oOOfz>0mucDl<{}vkg.OC%:tbP-> Xn*ar}Hku`[0V' );
define( 'NONCE_SALT',       'TeU.SQ.zNM8$hk`9qg[.^@NVq9pN8SF0{5M<*.ZJUi9?ic*4t!Q8>_Lj!>9%X2f?' );

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
 * @link https://wordpress.org/support/article/debugging-in-wordpress/
 */
define( 'WP_DEBUG', true );

/* Add any custom values between this line and the "stop editing" line. */



/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';


define( 'FS_METHOD', 'direct' );