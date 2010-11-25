<?php

class ProjetoUtil
{	
	public function __construct()
	{
		// carrega Lumine
		require_once '../libs/lumine/Lumine.php';
		// carrega as configuracoes de Lumine
		$lumineConfig = array(
					'dialect' => 'MySQL',
					'database' => 'defensoria',
				    'user' => 'joaopadilhacom',
				    'password' => 'padilha10',
				    'port' => '3306',
				    'host' => 'mysql01.joaopadilha.com',
				    'class_path' => dirname(__FILE__),
				    'package' => 'application',
				 
				    'options' => array(
				        'schema_name' => '',
				        'generate_files' => '1',
				        'generate_zip' => '',
				        'class_sufix' => '',
				        'remove_count_chars_start' => '',
				        'remove_count_chars_end' => '',
				        'remove_prefix' => '',
				        'create_entities_for_many_to_many' => '',
				        'plural' => 's',
				        'many_to_many_style' => '',
				        'create_controls' => '',
				        'xml_validation_path' => '',
				        'php_validator_path' => ''
				    )
				);
		
		Lumine_Util::import('application.control','application.model');
		
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
	}
	
	public static function verificaBrancoNulo($string)
	{
		if(!isset($string) && $string == "")
		{
			return true;
		}
		else
		{
			return false;
		}
	}
	
}

?>