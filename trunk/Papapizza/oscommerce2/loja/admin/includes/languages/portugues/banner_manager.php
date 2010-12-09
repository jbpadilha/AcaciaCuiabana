<?php
/*
  $Id: banner_manager.php 1739 2007-12-20 00:52:16Z hpdl $

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2003 osCommerce

  Released under the GNU General Public License
*/

define('HEADING_TITLE', 'Gerenciador de Banners');

define('TABLE_HEADING_BANNERS', 'Banners');
define('TABLE_HEADING_GROUPS', 'Grupos');
define('TABLE_HEADING_STATISTICS', 'Exibições / Clicks');
define('TABLE_HEADING_STATUS', 'Estado');
define('TABLE_HEADING_ACTION', 'Ação');

define('TEXT_BANNERS_TITLE', 'Título:');
define('TEXT_BANNERS_URL', 'URL:');
define('TEXT_BANNERS_GROUP', 'Grupo:');
define('TEXT_BANNERS_NEW_GROUP', ', ou  entre com um grupo novo de banners abaixo');
define('TEXT_BANNERS_IMAGE', 'Imagem:');
define('TEXT_BANNERS_IMAGE_LOCAL', ', ou entre com um arquivo local abaixo.');
define('TEXT_BANNERS_IMAGE_TARGET', 'Destino da Imagem (Salvar em):');
define('TEXT_BANNERS_HTML_TEXT', 'Texto HTML:');
define('TEXT_BANNERS_EXPIRES_ON', 'Expira em:');
define('TEXT_BANNERS_OR_AT', ',ou depois');
define('TEXT_BANNERS_IMPRESSIONS', 'exibições.');
define('TEXT_BANNERS_SCHEDULED_AT', 'Programado para:');
define('TEXT_BANNERS_BANNER_NOTE', '<b>Notas sobre o Banner:</b><ul><li>Utilize uma imagem ou texto HTML para o banner - não ambos.</li><li>O texto HTML tem prioridade sobre a imagem.</li></ul>');
define('TEXT_BANNERS_INSERT_NOTE', '<b>Notas sobre a Imagem:</b><ul><li>Os diretórios de upload (envio) devem ter as permissões de escrita (CHMOD) apropriadas.</li><li>Não preencha o campo "Salvar em" se você não estiver fazendo o upload de uma imagem para o servidor (por exemplo: se estiver usando uma imagem local).</li><li>O campo "Salvar em" deve ser um diretório existente e deve terminar em uma barra (por exemplo: banners/).</li></ul>');
define('TEXT_BANNERS_EXPIRCY_NOTE', '<b> Notas sobre a Expiração:</b><ul><li>Só se deve preencher um dos campos.</li><li>Se quer um banner que não expire não preencha nenhum dos campos.</li></ul>');
define('TEXT_BANNERS_SCHEDULE_NOTE', '<b>Notas sobre a Progamação:</b><ul><li>Se você definir uma data no campo "Programado em:" o banner será ativado nessa data.</li><li>Todos os banners progamados ficam inativos até a data prevista, quando então são ativados.</li></ul>');

define('TEXT_BANNERS_DATE_ADDED', 'Adicionado:');
define('TEXT_BANNERS_SCHEDULED_AT_DATE', 'Programado em: <b>%s</b>');
define('TEXT_BANNERS_EXPIRES_AT_DATE', 'Expira em: <b>%s</b>');
define('TEXT_BANNERS_EXPIRES_AT_IMPRESSIONS', 'Expira depois: <b>%s</b> exibições');
define('TEXT_BANNERS_STATUS_CHANGE', 'Mudar Status: %s');

define('TEXT_BANNERS_DATA', 'D<br>A<br>D<br>O<br>S');
define('TEXT_BANNERS_LAST_3_DAYS', 'Últimos 3 dias');
define('TEXT_BANNERS_BANNER_VIEWS', 'Exibições');
define('TEXT_BANNERS_BANNER_CLICKS', 'Clicks');

define('TEXT_INFO_DELETE_INTRO', 'Tem certeza que deseja deletar o banner?');
define('TEXT_INFO_DELETE_IMAGE', 'Apagar Imagem');

define('SUCCESS_BANNER_INSERTED', 'Sucesso: O banner foi adicionado.');
define('SUCCESS_BANNER_UPDATED', 'Sucesso: O banner foi atualizado.');
define('SUCCESS_BANNER_REMOVED', 'Sucesso: O banner foi apagado.');
define('SUCCESS_BANNER_STATUS_UPDATED', 'Sucesso: O status do banner foi atualizado.');

define('ERROR_BANNER_TITLE_REQUIRED', 'Erro: É necessário um título para o banner.');
define('ERROR_BANNER_GROUP_REQUIRED', 'Erro: É necessário um grupo para o banner.');
define('ERROR_IMAGE_DIRECTORY_DOES_NOT_EXIST', 'Erro: Não existe o diretório: %s');
define('ERROR_IMAGE_DIRECTORY_NOT_WRITEABLE', 'Erro: Sem permissão para salvar no diretório: %s');
define('ERROR_IMAGE_DOES_NOT_EXIST', 'Erro: A imagem não existe.');
define('ERROR_IMAGE_IS_NOT_WRITEABLE', 'Erro: Não se pode apagar a imagem.');
define('ERROR_UNKNOWN_STATUS_FLAG', 'Erro: Status desconhecido.');

define('ERROR_GRAPHS_DIRECTORY_DOES_NOT_EXIST', 'Erro: O diretório "graphs" não existe. Por favor crie um pasta em seu servidor com o nome de \'graphs\' dentro da pasta \'images\'.');
define('ERROR_GRAPHS_DIRECTORY_NOT_WRITEABLE', 'Erro: Não se pode salvar no diretório \'graphs\' ".');
?>
