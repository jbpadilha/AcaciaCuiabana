<?php
/*
  $Id: backup.php 1739 2007-12-20 00:52:16Z hpdl $

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2003 osCommerce

  Released under the GNU General Public License
*/

define('HEADING_TITLE', 'Backup do Banco de Dados');

define('TABLE_HEADING_TITLE', 'Título');
define('TABLE_HEADING_FILE_DATE', 'Data');
define('TABLE_HEADING_FILE_SIZE', 'Tamanho');
define('TABLE_HEADING_ACTION', 'Ação');

define('TEXT_INFO_HEADING_NEW_BACKUP', 'Nova Cópia de Segurança');
define('TEXT_INFO_HEADING_RESTORE_LOCAL', 'Restaurar Localmente');
define('TEXT_INFO_NEW_BACKUP', 'O processo de cópia que deve levar alguns minutos, não interrompa-o. ');
define('TEXT_INFO_UNPACK', '<br><br>(Após descompactar o arquivo)');
define('TEXT_INFO_RESTORE', 'Não interrompa o processo de restauração.<br><br>Quanto maior a cópia de segurança mais demorado será esse processo!<br><br>Se possível, usar o cliente mysql.<br><br>Por exemplo:<br><br><b>mysql -h' . DB_SERVER . ' -u' . DB_SERVER_USERNAME . ' -p ' . DB_DATABASE . ' < %s </b> %s');
define('TEXT_INFO_RESTORE_LOCAL', 'Não interrompa o processo de restauração.<br><br>Quanto maior a cópia de segurança mais demorará esse processo!');
define('TEXT_INFO_RESTORE_LOCAL_RAW_FILE', 'Deve ser uma arquivo de texto.');
define('TEXT_INFO_DATE', 'Data:');
define('TEXT_INFO_SIZE', 'Tamanho:');
define('TEXT_INFO_COMPRESSION', 'Compressão:');
define('TEXT_INFO_USE_GZIP', 'Usar GZIP');
define('TEXT_INFO_USE_ZIP', 'Usar ZIP');
define('TEXT_INFO_USE_NO_COMPRESSION', 'Sem compressão (SQL diretamente)');
define('TEXT_INFO_DOWNLOAD_ONLY', 'Download apenas (não guardar no servidor)');
define('TEXT_INFO_BEST_THROUGH_HTTPS', 'De preferência com uma conexão segura');
define('TEXT_NO_EXTENSION', 'Nenhum');
define('TEXT_BACKUP_DIRECTORY', 'Diretório para Copias de Segurança:');
define('TEXT_LAST_RESTORATION', 'Ultima Restauração:');
define('TEXT_FORGET', '(<u>esquecer</u>)');
define('TEXT_DELETE_INTRO', 'Tem certeza de que deseja excluir esta cópia?');

define('ERROR_BACKUP_DIRECTORY_DOES_NOT_EXIST', 'Erro: O diretório de cópias de segurança não existe.');
define('ERROR_BACKUP_DIRECTORY_NOT_WRITEABLE', 'Erro: Não tenho permissão para salvar no diretório de cópias de segurança.');
define('ERROR_DOWNLOAD_LINK_NOT_ACCEPTABLE', 'Erro: Não é aceito links.');

define('SUCCESS_LAST_RESTORE_CLEARED', 'Sucesso: A data da última restauração foi apagada.');
define('SUCCESS_DATABASE_SAVED', 'Sucesso: A base de dados foi salva.');
define('SUCCESS_DATABASE_RESTORED', 'Sucesso: A base de dados foi restaurada.');
define('SUCCESS_BACKUP_DELETED', 'Sucesso: a cópia de segurança foi apagada.');
?>
