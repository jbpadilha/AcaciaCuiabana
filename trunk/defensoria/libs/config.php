<?php

require_once 'control/DefensoriaControl.php';
// carrega as configuracoes de Lumine
require_once dirname(dirname(__FILE__)).'/lumine-conf.php';
// instancia uma configuracao
$cfg = new Lumine_Configuration($lumineConfig);
// indica o timezone padrao
date_default_timezone_set('America/Cuiaba');
// auto-carregamento de classes de Lumine
spl_autoload_register(array('Lumine','Import'));
// auto-carregamento de classes DTO de Lumine
spl_autoload_register(array('Lumine','ImportDTO'));
// registra uma funcao para o fechamento da conexao ao termino do script
register_shutdown_function(array($cfg->getConnection(),'close'));