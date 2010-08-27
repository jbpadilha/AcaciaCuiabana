<?php
/**
 * Interface Dominios do Sistema
 * @author João Batista Padilha e Silva
 * @link Dominio.php
 * @copyright João Batista Padilha e Silva Especialista em TI (http://www.joaopadilha.com) / joao.padilha@globo.com
 * @version 1.0
 */
class Dominio
{
	public $DB_HOST = "mysql03.servicodespertador.net";
	public $DB_USER = "servicodespert2"; 
	public $DB_PASSWD = "tmpSMC"; 
	public $DB_DATA = "servicodespert2";
	
	public $path = "http://localhost/";    
	public $path_interno = "http://localhost/";
	public $path_imagens = "http://localhost/imagens";
	
	public static $ADMINISTRADOR = 5;
	public static $CLIENTE = 1;
	public static $ADMINISTRADOR_TXT = "Administrador";
	public static $CLIENTE_TXT = "Cliente";
	
	public $SOLTEIRO = 1;
	public $CASADO = 2;
	public $DIVORCIADO = 3;
	public $UNIAO = 4;
	public $SOLTEIRO_TXT = "Solteiro(a)";
	public $CASADO_TXT = "Casado(a)";
	public $DIVORCIADO_TXT = "Divorciado(a)";
	public $UNIAO_TXT = "União estável";
	
	public function  listaDominioEstadoCivilSelect($estadoAnterior)
	{
		$options = "<select name=\"ecivil_cliente\">
                        <option>Selecione</option>";
		$options .= "<option value=\"{$this->SOLTEIRO}\" ".(($estadoAnterior == $this->SOLTEIRO) ? "Selected" : "").">{$this->SOLTEIRO_TXT}</option>";
		$options .= "<option value=\"{$this->CASADO}\" ".(($estadoAnterior == $this->CASADO) ? "Selected" : "").">{$this->CASADO_TXT}</option>";
		$options .= "<option value=\"{$this->DIVORCIADO}\" ".(($estadoAnterior == $this->DIVORCIADO) ? "Selected" : "").">{$this->DIVORCIADO_TXT}</option>";
		$options .= "<option value=\"{$this->UNIAO}\" ".(($estadoAnterior == $this->UNIAO) ? "Selected" : "").">{$this->UNIAO_TXT}</option>";
		$options .= "</select>";
		return $options;
	}	
}	
?>
