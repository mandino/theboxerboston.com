<?php

  $_SERVER['HTTPS']='on';
  define('FORCE_SSL', true);
  define('FORCE_SSL_ADMIN',true);
  define('W3TC_CONFIG_DATABASE',true);

  define('DB_NAME', $_SERVER['RDS_DB_NAME']);
  define('DB_USER', $_SERVER['RDS_DB_USER']);
  define('DB_PASSWORD', $_SERVER['RDS_DB_PASSWORD']);
  define('DB_HOST', $_SERVER['RDS_DB_HOST']);
  define('DB_CHARSET', 'utf8');
  define('DB_COLLATE', '');

  define('AUTH_KEY',         $_SERVER['AUTH_KEY']);
  define('SECURE_AUTH_KEY',  $_SERVER['SECURE_AUTH_KEY']);
  define('LOGGED_IN_KEY',    $_SERVER['LOGGED_IN_KEY']);
  define('NONCE_KEY',        $_SERVER['NONCE_KEY']);
  define('AUTH_SALT',        $_SERVER['AUTH_SALT']);
  define('SECURE_AUTH_SALT', $_SERVER['SECURE_AUTH_SALT']);
  define('LOGGED_IN_SALT',   $_SERVER['LOGGED_IN_SALT']);
  define('NONCE_SALT',       $_SERVER['NONCE_SALT']);

  define( 'WP_HOME', $_SERVER['WP_HOME'] );
  define( 'WP_SITEURL', $_SERVER['WP_SITEURL'] );

  define( 'AS3CF_SETTINGS', serialize( array(
    'access-key-id' => $_SERVER['AWS_KEY'],
    'secret-access-key' => $_SERVER['AWS_SECRET']
  )));

  
  $table_prefix = ($_SERVER['TABLE_PREFIX']) ? $_SERVER['TABLE_PREFIX'] : 'wp_';
  define('WP_DEBUG', false);
  define('COOKIE_DOMAIN', $_SERVER['HTTP_HOST'] );
  
  if ( !defined('ABSPATH') )
    define('ABSPATH', dirname(__FILE__) . '/');
  require_once(ABSPATH . 'wp-settings.php');