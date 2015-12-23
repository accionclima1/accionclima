<?php


// ** MySQL settings ** //
/** The name of the database for WordPress */
define('DB_NAME', 'wordpress_default');

/** MySQL database username */
define('DB_USER', 'wp');

/** MySQL database password */
define('DB_PASSWORD', 'wp');

/** MySQL hostname */
define('DB_HOST', 'localhost');

/** Database Charset to use in creating database tables. */
define('DB_CHARSET', 'utf8');

/** The Database Collate type. Don't change this if in doubt. */
define('DB_COLLATE', '');

define('AUTH_KEY',         '=i)|, 8OcuZPfaVc,cC?@lYYxvV#H`9}AEXl-#=]ZF6&+L#{+%16$/Z6?w+)|}Ny');
define('SECURE_AUTH_KEY',  '2~s@IN5UN{hm!HXQGkhw=+mF7xWz@oEQ:._z;u[GF5j5Sm}^.S#w{{.oAi`c~DTf');
define('LOGGED_IN_KEY',    'd]tye2ghJ-pt,oD/)z8 [.~}>ju7Bqt)ShpIfI;PTEqb`R2v}?lku*@;j<fduG#r');
define('NONCE_KEY',        'xP=c.L/|X*bG1sUO3;:`X*n+*Qgj@J#i}tf3y5AwVsw638=q!._/o[+UwBrfREEx');
define('AUTH_SALT',        'svd0?^Wo_m1%_$u|]p,.q<r&FR&|`L_FWe$|0hNg|0tWjy3&s<-cw=Wvx3cFgJ,n');
define('SECURE_AUTH_SALT', '+x3<IkT/kc]39e3XJKP(Z}__@`A%p11*ZR$jS2`.pnRfb+e=xj?|8Gru*qj1bv]&');
define('LOGGED_IN_SALT',   'g)7k O1gbl{+S}kXA}s7]I?d$_>NnS:ShWfw@^Iv8keK]~V+FvqZ5-9w641kwJA(');
define('NONCE_SALT',       '5Nl7r?+roa_7{-[c,<KTv:gSTqV4$lXc-eBcu!y|;m w3/TU)W#k+Y^*!7+wMn=-');


$table_prefix = 'accionclima_';


define( 'WP_DEBUG', true );

/* Multisite */
define( 'WP_ALLOW_MULTISITE', true );
define('MULTISITE', true);
define('SUBDOMAIN_INSTALL', false);
define('DOMAIN_CURRENT_SITE', 'local.accionclima.org');
define('PATH_CURRENT_SITE', '/');
define('SITE_ID_CURRENT_SITE', 1);
define('BLOG_ID_CURRENT_SITE', 1);

/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');
