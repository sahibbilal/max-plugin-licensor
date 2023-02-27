<?php

//Begin Really Simple SSL session cookie settings
@ini_set('session.cookie_httponly', true);
@ini_set('session.cookie_secure', true);
@ini_set('session.use_only_cookies', true);
//define( 'WP_DEBUG', true );
//END Really Simple SSL
define('WP_AUTO_UPDATE_CORE', 'minor');// This setting is required to make sure that WordPress updates can be properly managed in WordPress Toolkit. Remove this line if this WordPress website is not managed by WordPress Toolkit anymore.
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
define( 'DB_NAME', "refineph_stag" );
/** MySQL database username */
define( 'DB_USER', "refineph_stag" );
/** MySQL database password */
define( 'DB_PASSWORD', "Sunny123!@#" );
/** MySQL hostname */
define( 'DB_HOST', "localhost" );
/** Database Charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8' );
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
define( 'AUTH_KEY',         'A[A@H)|t3fHP5Yd]3Q/|mMO@AOR$ba)|+#zTT#Kz&kYZ`&w;7!Z2zV*Px=Wv0esB' );
define( 'SECURE_AUTH_KEY',  '@LFJ=iHVYL$XBf9rfz||O+r3Ls=`Y;)Q_//a|wlg;ByGf+*Fq+MdvGu7KG.;~QA}' );
define( 'LOGGED_IN_KEY',    'Ki~HhE}&D0%x}>b]}; eAP+P8oOz}hG}mn,IRwj(r YJolYMer^$NG(%-zG)vZH6' );
define( 'NONCE_KEY',        'E.71_7JVQXnSd+ &oH5m$WLxXplLTrz+ScA~?+f*E*@xf(XrtU> JIa `?)Nr{%6' );
define( 'AUTH_SALT',        'n1Q+Zv-(-u!W;].&c+?kAx;%&&6jDS[6K *zwH/b2O=}{^GF]?:n%m|>`a_Ss`3z' );
define( 'SECURE_AUTH_SALT', '<(+6wDp4yv@4Zl>S>!1`Vk]>c<*#Nj}6p-E;K(Pe1lYn^#+Yh&m$7)s+.Jn~dj11' );
define( 'LOGGED_IN_SALT',   '2,|(DC:3 i Kq^(*%foBe1:0z _Co|xx,iAe`s5<?@mWT!g ]s]gw/#>[+3eykB*' );
define( 'NONCE_SALT',       'XAbfL:0qeW!Z%p-rVX|s0Lwnu^FY7V{WU-Z _Fa/rOVCc*-vAb!^,%EL#0Bm`&Qy' );
/**#@-*/
/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'wppir_';
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
/* That's all, stop editing! Happy publishing. */
/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}
/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';