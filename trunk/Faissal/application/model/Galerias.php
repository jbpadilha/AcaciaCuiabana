<?php
//####################################
// * Jo�o Batista Padilha e Silva Especialista em TI (http://www.joaopadilha.com)
// * Arquivo: Galerias.php
// * Cria��o: Jo�o Batista Padilha e Silva
// * Data de cria��o: 11/02/2011
// * E-mail: joao.padilha@globo.com
//####################################
/*
   Classe Galerias, que transfere dados de uma Camada para outra.
*/
class Galerias extends Lumine_Base
{
	protected $_tablename = 'galerias';
    protected $_package   = 'model';
	
	public $idGaleria = null;
	public $nomeGaleria = '';
	public $dataGaleria = '';
	public $localGaleria = '';
	public $pastaGaleria = '';
	public $imgInicioGaleria = '';
	
	/**
     * Inicia os valores da classe
     * @author Jo�o Batista Padilha e Silva
     * @return void
     */
    protected function _initialize()
    {
        $this->_addField("idGaleria", "idGaleria", "int", 11, array('primary' => true, 'notnull' => true, 'autoincrement' => true));
        $this->_addField("nomeGaleria", "nomeGaleria", "varchar", 255, array('notnull' => true));
        $this->_addField("dataGaleria", "dataGaleria", "datetime", null, array('notnull' => true));
        $this->_addField("localGaleria", "localGaleria", "varchar", 255, array('notnull' => true));
        $this->_addField("pastaGaleria", "pastaGaleria", "varchar", 255, array('notnull' => true));
        $this->_addField("imgInicioGaleria", "imgInicioGaleria", "varchar", 255, array('notnull' => true));
    }
	
    /**
     * Recupera um objeto estaticamente
     * @author Jo�o Batista Padilha e Silva
     * @return Pessoa
     */
    public static function staticGet($pk, $pkValue = null)
    {
        $obj = new Galerias();
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
	 * @return the $idGaleria
	 */
	public function getIdGaleria() {
		return $this->idGaleria;
	}

	/**
	 * @return the $nomeGaleria
	 */
	public function getNomeGaleria() {
		return $this->nomeGaleria;
	}

	/**
	 * @return the $dataGaleria
	 */
	public function getDataGaleria() {
		return $this->dataGaleria;
	}

	/**
	 * @return the $localGaleria
	 */
	public function getLocalGaleria() {
		return $this->localGaleria;
	}

	/**
	 * @return the $pastaGaleria
	 */
	public function getPastaGaleria() {
		return $this->pastaGaleria;
	}

	/**
	 * @return the $imgInicioGaleria
	 */
	public function getImgInicioGaleria() {
		return $this->imgInicioGaleria;
	}

	/**
	 * @param field_type $idGaleria
	 */
	public function setIdGaleria($idGaleria) {
		$this->idGaleria = $idGaleria;
	}

	/**
	 * @param field_type $nomeGaleria
	 */
	public function setNomeGaleria($nomeGaleria) {
		$this->nomeGaleria = $nomeGaleria;
	}

	/**
	 * @param field_type $dataGaleria
	 */
	public function setDataGaleria($dataGaleria) {
		$this->dataGaleria = $dataGaleria;
	}

	/**
	 * @param field_type $localGaleria
	 */
	public function setLocalGaleria($localGaleria) {
		$this->localGaleria = $localGaleria;
	}

	/**
	 * @param field_type $pastaGaleria
	 */
	public function setPastaGaleria($pastaGaleria) {
		$this->pastaGaleria = $pastaGaleria;
	}

	/**
	 * @param field_type $imgInicioGaleria
	 */
	public function setImgInicioGaleria($imgInicioGaleria) {
		$this->imgInicioGaleria = $imgInicioGaleria;
	}
	
	public function toDataGaleriaDB()
	{
		if($this->getDataGaleria()!=null)
		{
			$dataHora = explode(" ",$this->getDataGaleria());
			$data = explode("/",$dataHora[0]);
			return $data[2]."-".$data[1]."-".$data[0]." ".$dataHora[1];
		}
		else
		{
			return null;
		}
	}
	
	public function getDataGaleriaFormatado()
	{
		if($this->getDataGaleria()!=null)
		{
			$dataHora = explode(" ",$this->getDataGaleria());
			$data = explode("-",$dataHora[0]);
			$dataRetorno = $data[2]."/".$data[1]."/".$data[0]." ".$dataHora[1];
			return $dataRetorno;
		}
		else
		{
			return "";
		}
	}

	public function validate()
	{
		// limpa os validators anteriores
		Lumine_Validator_PHPValidator::clearValidations($this);
		// adicionando as regras 
		Lumine_Validator_PHPValidator::addValidation($this, 'nomeGaleria', Lumine_Validator::REQUIRED_STRING, 'Informe o nome da galeria');
		Lumine_Validator_PHPValidator::addValidation($this, 'localGaleria', Lumine_Validator::REQUIRED_STRING, 'Informe a local onde foi realizado o evento');
		
		return parent::validate();
	}
	
}
?>