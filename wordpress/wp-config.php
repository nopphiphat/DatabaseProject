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
define( 'DB_NAME', 'db_project' );

/** MySQL database username */
define( 'DB_USER', 'kaiwen' );

/** MySQL database password */
define( 'DB_PASSWORD', '19950314' );

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
define( 'AUTH_KEY',         'RSD`af5Rcv4unDmw~Kw$wLX>KGS*g:Je-`ZBrNR/r5c;zUgTQ`NP<j7Im=#682k}' );
define( 'SECURE_AUTH_KEY',  ':a;KrCYJj}d+WdA7Bb|<oOPEtJ:Yf:[-X*4o(uX>c0vx08VDJ sBcMy)~pdXdN/W' );
define( 'LOGGED_IN_KEY',    'p<HHUu;,WhR*1Tjw:JM> wF)AS!:4c.(%j}+%!]~t%pc1tY)N*z1btES&[E?y]sS' );
define( 'NONCE_KEY',        '^VH!zf!n*rUm:{R+U%jP?pHMM%:8hN>4z. 5I_ <.<G4q^fD;_AZ<G,>)p5{^%{/' );
define( 'AUTH_SALT',        'a(:JQ-<jQG7QJVM?ItTZ9VU~^f`43JV_ICldV4LNk$99R[D~XX_%nbVKtLY):8Ua' );
define( 'SECURE_AUTH_SALT', ';/50#]SgDp(*IruUtRTxfb%ST?=kfSw!U-Ap8xaOF1mTSC9TZqw`M##B;y2!KC|>' );
define( 'LOGGED_IN_SALT',   'ay:7ejs1!~mBPjNV]>:zBAZ;w }RfeN?/!Blo}_ZG4G1,n`J`c&31`REfiE]C/&;' );
define( 'NONCE_SALT',       ':6>rfy;ma`><9@h.3effu1J,ivR]u{,Vny#X^gj6kRmG>jFQ>GGa3R@8elJL)uYU' );

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'h_';

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
define( 'WP_DEBUG', false );

/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', dirname( __FILE__ ) . '/' );
}

/** Sets up WordPress vars and included files. */
require_once( ABSPATH . 'wp-settings.php' );
