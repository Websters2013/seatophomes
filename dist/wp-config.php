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
define('DB_NAME', 'websters_sp');

/** MySQL database username */
define('DB_USER', 'root');

/** MySQL database password */
define('DB_PASSWORD', 'root');

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
define('AUTH_KEY',         'C/G4&1m>3p!&)R,|ML9[`3tM2e_c4 BiHZp;2fpW}OScB<7[C#:*Ak2:FgF$dZ&(');
define('SECURE_AUTH_KEY',  '2S_:<cz_(mZmuUa~)CAm*_n3}9>-{m_L4^MGw.^z]|>VhSm;r&X.*  LcAF,esfT');
define('LOGGED_IN_KEY',    ';UYAjC2uzA::=l&=+K<:h rV,g]Stc]X-9:`^-Y?jF=nE&d>I_H7v1^})h]UGY*O');
define('NONCE_KEY',        '/kc}@_X r-3Fqyn)xUf`hh|*2bP*Cp=dk)bnBS<g_$qYL=KX/i+PQ>3#OHKb$xD1');
define('AUTH_SALT',        '7Ai.o-<9N$-qYdae)1eVkR:T(ZSKE{NzsZd#c[vrHm;6n=0pg[Q!(o$-+569c7<A');
define('SECURE_AUTH_SALT', 'g1i1y##wx+;.a{i%=O8HQ,naTNft3)?3!7NYjL&lfX.J7LCJwG3I$JSUSdk_af| ');
define('LOGGED_IN_SALT',   'IP Cc)iW8.5)x0Pc[5WmpKmsNecf5Vh?)WWr<1*iF(@!-gxw4&%YbBe/lH[(&fG5');
define('NONCE_SALT',       'DgOkf3&<G1N?*|#8d~seJyX~l>m,C<yX ;-(XKfrHcO:{ou7[q@hDl!3H_4u`l&J');

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
