<?php
/**
 * The base configuration for WordPress
 *
 * The wp-config.php creation script uses this file during the installation.
 * You don't have to use the website, you can copy this file to "wp-config.php"
 * and fill in the values.
 *
 * This file contains the following configurations:
 *
 * * Database settings
 * * Secret keys
 * * Database table prefix
 * * ABSPATH
 *
 * @link https://developer.wordpress.org/advanced-administration/wordpress/wp-config/
 *
 * @package WordPress
 */

// ** Database settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'wordpress_practical' );

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
define( 'AUTH_KEY',         '7!zouh}Yn&PGNBmcI3S!e:46Vxx++qf39V~sGX7-r4NX%%2DUCQUs,VnMe_$mo:y' );
define( 'SECURE_AUTH_KEY',  ']/PhCvGeS_;+p=M%p5g,@hG@R#)|R]9`+p+hd]Mm6giL@hee8f=%8w(Y3Y66:O:9' );
define( 'LOGGED_IN_KEY',    'ecMOy]7~)dYOX8V^MB.eJXv6<E oPzj0.~RGP_~/VtcHXwhLgnCo9a;&WoNx9PEs' );
define( 'NONCE_KEY',        '&1ML|#?E4o/4S]DTSjg}8;ivaliBiCzo0<`Lt +mE%=&C0/?xUey=gIvA&>)J~%Y' );
define( 'AUTH_SALT',        ']g#D1UZC zQgaxkvmONcwFwOV+)trej,s&jKalsqZl[s<VI.Ird}H$pS:;g[5`{l' );
define( 'SECURE_AUTH_SALT', 'm<9^:lJqmdN=zPgS}+wP/XRpbSbK-J.Yu&/dlq#)6nk/sWoT:ST5OyXJf2-#d<}Q' );
define( 'LOGGED_IN_SALT',   '*k3G$h<J7S,MUpTPP@fP ?Lp:T2ECFcxlX2c?3RuMSe*-h /V#5~?/6yXs3k:W44' );
define( 'NONCE_SALT',       'bz!M0wdqF;hHDQ;9{#&?A|!IF,*%.kh#*-X5_S}A|J`M:heZ5Q/Oh5h/A,@ozg3D' );

/**#@-*/

/**
 * WordPress database table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 *
 * At the installation time, database tables are created with the specified prefix.
 * Changing this value after WordPress is installed will make your site think
 * it has not been installed.
 *
 * @link https://developer.wordpress.org/advanced-administration/wordpress/wp-config/#table-prefix
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
 * @link https://developer.wordpress.org/advanced-administration/debug/debug-wordpress/
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
