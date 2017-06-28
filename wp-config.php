<?php
/** Enable W3 Total Cache */
define('WP_CACHE', true); // Added by W3 Total Cache

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

//Added by WP-Cache Manager
define( 'WPCACHEHOME', '/home/nginx/domains/happivize.com/public/wp-content/plugins/wp-super-cache/' ); //Added by WP-Cache Manager
define('WP_MEMORY_LIMIT', '512M');

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define('DB_NAME', 'aimee_happivize');

/** MySQL database username */
define('DB_USER', 'root');

/** MySQL database password */
define('DB_PASSWORD', '');

/** MySQL hostname */
define('DB_HOST', 'localhost');

/** Database Charset to use in creating database tables. */
//define('DB_CHARSET', 'utf8mb4');
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
define('AUTH_KEY', 'O8VZ5pEOIZx0fxTWGg6M52VVoeeRhFPFpDBN69/jrj6YFSCLu5FhPUZ98dwWPlLu');
define('SECURE_AUTH_KEY', 'W9jjBa2EjqPZIuPTgB9WoVuWLDKxmUY3yTpk5R5Ts2hq+XOx5TALRb50bcx+zgkU');
define('LOGGED_IN_KEY', 'L50+aHI2UjH+FqMz2rn7K6mIfcvRSI9rbZNCllcJw6bxVWniDCeI8Wu+S+pkX9XL');
define('NONCE_KEY', 'qfcuxpgmJFhUAtrECp/1jVdS+khYr/071du6zmSdaS08wbOLpx58yLKMcvShigbe');
define('AUTH_SALT', 'kVKx9pjcchumAeWG2bJjFZ9PPqE0kUQAmgSjNUP7ymjrKmfOrc29/1+8nnK74cjP');
define('SECURE_AUTH_SALT', '5GE6OzlxP7UEq2u56nFkvXDW47c4eQMPdzzB5DkH+rq8WNTHOF5VO3gdnp/Yxwtu');
define('LOGGED_IN_SALT', 'fxrt1Blfl95xp2m/X2YsAi7ibjo93UC5u8g5SufWZ7kQyWVk3XOxVXqIxWA9iU91');
define('NONCE_SALT', 'vncx5+vZkNSvyr4SykFr+D0aDffF0yQfdFAYURNT8p8AF9T4CmV4V3Gs1UHgbmhd');

/**#@-*/

/**
* WordPress Database Table prefix.
*
* You can have multiple installations in one database if you give each
* a unique prefix. Only numbers, letters, and underscores please!
*/
$table_prefix = 'hp_';

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
//define('WP_DEBUG', false);
//define('WP_DEBUG', 1 );
define('WP_DEBUG_LOG', true );

/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');

