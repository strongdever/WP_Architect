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
 * @link https://wordpress.org/documentation/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** Database settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'architect' );

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
define( 'AUTH_KEY',         'ODDiL~$LY*)m3fTL^NwWu-RojD6%->[msrdk^0EX,%9e/qADFfcLG&$2<a_QxT0P' );
define( 'SECURE_AUTH_KEY',  'w(@5MhE~#M+G6V]he$LxDwbRhJemh Y]npsG^yIvfQ^=t/FHEcS<@ZB!shL+4_&k' );
define( 'LOGGED_IN_KEY',    '_YXH|YJZA.kDgJ*/QdC0plY`ZhZM8kdUGh`@$UIKN|b_daE5[5&1+9n>Tyh$Pht ' );
define( 'NONCE_KEY',        '+O>O%e2.,E[aKr12wM+lO9JH#/<Zv4}}VE}!dw_;*jP[TGalrIt5`qCHhK]RE ,i' );
define( 'AUTH_SALT',        'v^+=bOK<6>&&50lP)Ozj9BWQo;~&BG1ZX[HE4-|tI$&S4`I3q*vgX(f>N}hrSq<4' );
define( 'SECURE_AUTH_SALT', 'x$FhO.rNj[D3K`I27(SU(g7L7=;Zxe>Cv?1 GT|HKm5;gC=gGj,zw#K1@Cu7tEYH' );
define( 'LOGGED_IN_SALT',   '^FLP%F}]BP-$w5MmV y{!ogUWN@-`Z2x7SJz[)3df+m[>wZ~iY;mun)3#v?[0&7R' );
define( 'NONCE_SALT',       '$6)/pxzsb@6j,K~qyc8h3zpjYFE;#dQ_U8z^R9ZD?9RzyQzyzY}O0j>>poTTKf?1' );

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



/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
