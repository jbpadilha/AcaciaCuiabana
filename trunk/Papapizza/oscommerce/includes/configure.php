<?php
  define('HTTP_SERVER', 'http://localhost/Papapizza');
  define('HTTPS_SERVER', 'http://localhost/Papapizza');
  define('ENABLE_SSL', false);
  define('HTTP_COOKIE_DOMAIN', 'http://localhost/Papapizza');
  define('HTTPS_COOKIE_DOMAIN', 'localhost');
  define('HTTP_COOKIE_PATH', '/oscommerce/');
  define('HTTPS_COOKIE_PATH', '/oscommerce/');
  define('DIR_WS_HTTP_CATALOG', '/oscommerce/');
  define('DIR_WS_HTTPS_CATALOG', '/oscommerce/');
  define('DIR_WS_IMAGES', 'images/');

  define('DIR_WS_DOWNLOAD_PUBLIC', 'pub/');
  define('DIR_FS_CATALOG', 'C:/Paginas_Sistemas/Papapizza/oscommerce/');
  define('DIR_FS_WORK', 'C:/Paginas_Sistemas/Papapizza/oscommerce/includes/work/');
  define('DIR_FS_DOWNLOAD', DIR_FS_CATALOG . 'download/');
  define('DIR_FS_DOWNLOAD_PUBLIC', DIR_FS_CATALOG . 'pub/');
  define('DIR_FS_BACKUP', 'C:/Paginas_Sistemas/Papapizza/oscommerce/admin/backups/');

  define('DB_SERVER', 'localhost');
  define('DB_SERVER_USERNAME', 'root');
  define('DB_SERVER_PASSWORD', '');
  define('DB_DATABASE', 'papapizzacomerce');
  define('DB_DATABASE_CLASS', 'mysqli');
  define('DB_TABLE_PREFIX', 'osc_');
  define('USE_PCONNECT', 'false');
  define('STORE_SESSIONS', 'database');
?>