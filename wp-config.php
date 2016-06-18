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

define('DB_NAME', 'wp2');


/** MySQL database username */

define('DB_USER', 'root');


/** MySQL database password */

define('DB_PASSWORD', '');


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

define('AUTH_KEY', ']kgpoU/f%vWsgzmEAlwDxik]!$(+P(FA<k?JScDsxuD]NolQK+yoUHHCTzyHaBodP{saP&zg=YauBlLKg<lmA@_{nwe>^@Avb(RTj[h/=XvvosPH(EK{T=oBfzO!SnPx');
define('SECURE_AUTH_KEY', ')[qFVrI*UK&y%xNsjy&jSSGTZYPvjWhZ@c/vbj)?U$rsMnq{Fyaxr]hDh]KxSb]s*r$ahFk|{<YM)qG-wK/RjgjCt*TuqZ(qMZZ+mMKI!o_HFkhTh(&w>j!p[qWkHNmO');
define('LOGGED_IN_KEY', 'QUi_C)$K%CjvkweNXPopuVtK=spl$NkOnoME/+$l&&sb=Sg?CVReMKZzy*BB=yfahvJ]kSxcscYvc|*i(*oQlhIl+l_)p{GeG=>p)xz}YGUWtPDasmWt_h{QQpy$a%w+');
define('NONCE_KEY', 'ABj/DnUY&)Q(+-i[!da!P$>hVSR{*UB|{n?bUJlz@qwbm(pbHRkanbZt!lZ!?the]j&y?Shih}q=_+ip-xQXVCTLjjY-zkO)wA-;Sb_YzzqFCfP?oJNR_WpBL/=kyPn?');
define('AUTH_SALT', 'PGRFAp;ucBy!@PB;>wTv!]^O?O;kSH^cHM=mYHqzlPY$%mfCVH=+do{G[YGCRjoWDZdWN-CgGOddFs$NSd$SqHRDP]G@RlK+L>%*@)EXHg-IX]>UbRH}zcHRq)$V;NWh');
define('SECURE_AUTH_SALT', 'w$KRngHQqd!C{Bzv(NM/G&hmij^Yr$kHlE&O/ULWZVn-Jl?_YU&)Rg%-L*d;jvl>^soie@Y@x@jU>tKu}nDgXCwFf>EJ|!U&-_pGm*-N/RPIjbN=sXLLf[neZK}jUV|=');
define('LOGGED_IN_SALT', 'a+rPLj<[^dIYi_VAlI^Pw*@wz?(CDSu*wsm[o]WjxlBqIt*_tdnNeFHW*w-rQMiD/L<VkcN>vwswnXqu^Ktz[iZYFUYDTnyT<}XiWSyeaEtbmT*OgNCxXT_;K+nLaYWD');
define('NONCE_SALT', '>gCyECcmJ{!f{Jy=Msf(|V|QEZ<x+t@GlrYX$}?(+VeTYCSlPsE;AzGE|et[W;ju]xy+C!K^-kFj$Gf(AW>CnbDo<u=%yM^O}qTc;HrQmg)ZWE<wFXXXZOT{Hi{QQWlD');


/**#@-*/



/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */

$table_prefix = 'wp_tujv_';


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

