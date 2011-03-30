<?php
header("Content-Type: text/html; charset=UTF-8",true);
class ProjetoUtil
{	
	public static $DOMINIO_SOLTEIRO = 1;
	public static $DOMINIO_CASADO = 2;
	public static $DOMINIO_SEPARADO = 3;
	public static $DOMINIO_VIUVO = 4;
	public static $DOMINIO_OUTROS = 5;
	
	public static $DOMINIO_SOLTEIRO_TXT = "Solteiro";
	public static $DOMINIO_CASADO_TXT = "Casado";
	public static $DOMINIO_SEPARADO_TXT = "Separado";
	public static $DOMINIO_VIUVO_TXT = "Viúvo";
	public static $DOMINIO_OUTROS_TXT = "Outros";
	
	public function __construct()
	{
		session_cache_limiter(5);
		// carrega Lumine
		
		require_once PATH_PROJETO.'libs/lumine/Lumine.php';
		// carrega as configuracoes de Lumine
		$lumineConfig = array(
					'dialect' => 'MySQL',
					'database' => 'aggemt',
				    'user' => 'root',
				    'password' => '123',
				    'port' => '3306',
				    'host' => 'localhost',
				    'class_path' => dirname(__FILE__),
				    'package' => 'model',
					'keep_foreign_column_name' => '1', 
				    'create_paths' => '1', 
				    'create_dtos' => '1',
				 
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
				        'camel_case' => '1', 
				        'generateAccessors' => '', 
				        'usar_dicionario' => '1', 
				        'dto_format' => '%sDTO', 
				        'auto_cast_dto' => '1', 
				        'dto_package' => '', 
				        'keep_foreign_column_name' => '1', 
				        'use_formatter_as_default' => '', 
				        'empty_as_null' => '', 
				        'create_paths' => '', 
				        'create_dtos' => '1'
				    )
				);
		//Lumine_Util::import($arquivo);

		// instancia uma configuracao
		$cfg = new Lumine_Configuration($lumineConfig);
		// indica o timezone padrao
		date_default_timezone_set('America/Cuiaba');
		// auto-carregamento de classes de Lumine
		spl_autoload_register(array('Lumine','Import'));
		// auto-carregamento de classes DTO de Lumine
		spl_autoload_register(array('Lumine','ImportDTO'));
		// registra uma funcao para o fechamento da conexao ao termino do script
		//register_shutdown_function(array($cfg->getConnection(),'close'));
		
		
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
	
	public static function getEstadoCivil($dominio)
	{
		if($dominio == ProjetoUtil::$DOMINIO_CASADO)
		{
			return ProjetoUtil::$DOMINIO_CASADO_TXT;
		}
		else if($dominio == ProjetoUtil::$DOMINIO_OUTROS)
		{
			return ProjetoUtil::$DOMINIO_OUTROS_TXT;
		}
		else if($dominio == ProjetoUtil::$DOMINIO_SEPARADO)
		{
			return ProjetoUtil::$DOMINIO_SEPARADO_TXT;
		}
		else if($dominio == ProjetoUtil::$DOMINIO_SOLTEIRO)
		{
			return ProjetoUtil::$DOMINIO_SOLTEIRO_TXT;
		}
		else if($dominio == ProjetoUtil::$DOMINIO_VIUVO)
		{
			return ProjetoUtil::$DOMINIO_VIUVO_TXT;
		}
	}
	

}

?>