<?php
//####################################
// * João Batista Padilha e Silva Especialista em TI (http://www.joaopadilha.com)
// * Arquivo: Agenda.php
// * Criaçsão: João Batista Padilha e Silva
// * Data de criação: 11/02/2011
// * E-mail: joao.padilha@globo.com
//####################################
/*
   Classe Agenda, que transfere dados de uma Camada para outra.
*/

class Agenda extends Lumine_Base {
	
	protected $_tablename = 'agenda';
    protected $_package   = 'model';
	
	public $idAgenda = null;
	public $nomeAgenda = "";
	public $descricaoAgenda = "";
	public $dataAgenda = "";
	
	/**
     * Inicia os valores da classe
     * @author Jo�o Batista Padilha e Silva
     * @return void
     */
    protected function _initialize()
    {
		# idatividades, atividades
        
        $this->_addField("idAgenda", "idAgenda", "int", 11, array('primary' => true, 'notnull' => true, 'autoincrement' => true));
        $this->_addField("nomeAgenda", "nomeAgenda", "varchar", 255, array('notnull' => true));
        $this->_addField("descricaoAgenda", "descricaoAgenda", "text", null, array('notnull' => true));
        $this->_addField("dataAgenda", "dataAgenda", "datetime", null, array('notnull' => true));
        
    }
	
    /**
     * Recupera um objeto estaticamente
     * @author Jo�o Batista Padilha e Silva
     * @return Pessoa
     */
    public static function staticGet($pk, $pkValue = null)
    {
        $obj = new Agenda();
        $obj->get($pk, $pkValue);
        return $obj;
    }

	/**
	 * chama o destrutor pai
	 *
	 */
	function __destruct()
	{
		parent::__destruct();
	}
	
	/**
	 * @return the $idAgenda
	 */
	public function getIdAgenda() {
		return $this->idAgenda;
	}

	/**
	 * @return the $nomeAgenda
	 */
	public function getNomeAgenda() {
		return $this->nomeAgenda;
	}

	/**
	 * @return the $descricaoAgenda
	 */
	public function getDescricaoAgenda() {
		return $this->descricaoAgenda;
	}

	/**
	 * @return the $dataAgenda
	 */
	public function getDataAgenda() {
		return $this->dataAgenda;
	}

	/**
	 * @param $idAgenda the $idAgenda to set
	 */
	public function setIdAgenda($idAgenda) {
		$this->idAgenda = $idAgenda;
	}

	/**
	 * @param $nomeAgenda the $nomeAgenda to set
	 */
	public function setNomeAgenda($nomeAgenda) {
		$this->nomeAgenda = $nomeAgenda;
	}

	/**
	 * @param $descricaoAgenda the $descricaoAgenda to set
	 */
	public function setDescricaoAgenda($descricaoAgenda) {
		$this->descricaoAgenda = $descricaoAgenda;
	}

	/**
	 * @param $dataAgenda the $dataAgenda to set
	 */
	public function setDataAgenda($dataAgenda) {
		$this->dataAgenda = $dataAgenda;
	}
	
	public function toDataAgendaDB()
	{
		if($this->getDataAgenda()!=null)
		{
			$dataHora = explode(" ",$this->getDataagenda());
			$data = explode("/",$dataHora[0]);
			return $data[2]."-".$data[1]."-".$data[0]." ".$dataHora[1];
		}
		else
		{
			return null;
		}
	}
	
	public function getDataAgendaFormatado()
	{
		if($this->getDataAgenda()!=null)
		{
			$dataHora = explode(" ",$this->getDataagenda());
			$data = explode("-",$dataHora[0]);
			$dataRetorno = $data[2]."/".$data[1]."/".$data[0]." ".$dataHora[1];
			return $dataRetorno;
		}
		else
		{
			return "";
		}
	}

	/**
	 * Valida��o(non-PHPdoc)
	 * @see lumine/lib/Lumine_Base#validate()
	 */
	public function validate()
	{
		// limpa os validators anteriores
		Lumine_Validator_PHPValidator::clearValidations($this);
		
		// adicionando as regras 
		Lumine_Validator_PHPValidator::addValidation($this, 'nomeAgenda', Lumine_Validator::REQUIRED_STRING, 'Informe o nome da agenda');
		
		return parent::validate();
	}
	
}
?>