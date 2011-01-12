<?php
  define('HTTP_SERVER', 'http://papapizza.joaopadilha.com');
  define('HTTPS_SERVER', 'http://papapizza.joaopadilha.com');
  define('ENABLE_SSL', false);
  define('HTTP_COOKIE_DOMAIN', 'papapizza.joaopadilha.com');
  define('HTTPS_COOKIE_DOMAIN', 'papapizza.joaopadilha.com');
  define('HTTP_COOKIE_PATH', '/oscommerce/');
  define('HTTPS_COOKIE_PATH', '/oscommerce/');
  define('DIR_WS_HTTP_CATALOG', '/oscommerce/');
  define('DIR_WS_HTTPS_CATALOG', '/oscommerce/');
  define('DIR_WS_IMAGES', 'images/');

  define('DIR_WS_DOWNLOAD_PUBLIC', 'pub/');
  define('DIR_FS_CATALOG', '/home/joaopadilha/papapizza.joaopadilha.com/oscommerce/');
  define('DIR_FS_WORK', '/home/joaopadilha/papapizza.joaopadilha.com/oscommerce/includes/work/');
  define('DIR_FS_DOWNLOAD', DIR_FS_CATALOG . 'download/');
  define('DIR_FS_DOWNLOAD_PUBLIC', DIR_FS_CATALOG . 'pub/');
  define('DIR_FS_BACKUP', '/home/joaopadilha/papapizza.joaopadilha.com/oscommerce/admin/backups/');

  define('DB_SERVER', 'mysql01.joaopadilha.com');
  define('DB_SERVER_USERNAME', 'joaopadilhacom');
  define('DB_SERVER_PASSWORD', 'padilha10');
  define('DB_DATABASE', 'papapizzacomerce');
  define('DB_DATABASE_CLASS', 'mysqli');
  define('DB_TABLE_PREFIX', 'osc_');
  define('USE_PCONNECT', 'false');
  define('STORE_SESSIONS', 'database');
?>