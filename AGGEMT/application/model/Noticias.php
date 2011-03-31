<?php

class Noticias extends Lumine_Base {
	
	protected $_tablename = 'noticias';
    protected $_package   = 'model';
    
	public $idnoticia;
	public $titulonoticia;
	public $descricaonoticia;
	public $datanoticia;
	public $imagemnoticia;
	public $destaque;
	
	/**
     * Inicia os valores da classe
     * @author Jo�o Batista Padilha e Silva
     * @return void
     */
    protected function _initialize()
    {
        
        $this->_addField("idnoticia", "idnoticia", "int", 11, array('primary' => true, 'notnull' => true, 'autoincrement' => true));
        $this->_addField("titulonoticia", "titulonoticia", "varchar", 255, array('notnull' => true));
        $this->_addField('descricaonoticia', 'descricaonoticia', 'text', null, array('notnull' => false));
        $this->_addField("datanoticia", "datanoticia", "datetime", null, array('notnull' => true));
        $this->_addField("destaque", "destaque", "varchar", 1, array('notnull' => true));
    }

    /**
     * Recupera um objeto estaticamente
     * @author Jo�o Batista Padilha e Silva
     * @return Pessoa
     */
    public static function staticGet($pk, $pkValue = null)
    {
        $obj = new Noticias();
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
	 * @return the $idnoticia
	 */
	public function getIdnoticia() {
		return $this->idnoticia;
	}

	/**
	 * @return the $titulonoticia
	 */
	public function getTitulonoticia() {
		return $this->titulonoticia;
	}

	/**
	 * @return the $descricaonoticia
	 */
	public function getDescricaonoticia() {
		return $this->descricaonoticia;
	}

	/**
	 * @return the $datanoticia
	 */
	public function getDatanoticia() {
		return $this->datanoticia;
	}
	
	public function getDatanoticiaFormatado()
	{
		if($this->getDatanoticia()!=null)
		{
			$dataHora = explode(" ",$this->getDatanoticia());
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
	 * @param field_type $idnoticia
	 */
	public function setIdnoticia($idnoticia) {
		$this->idnoticia = $idnoticia;
	}

	/**
	 * @param field_type $titulonoticia
	 */
	public function setTitulonoticia($titulonoticia) {
		$this->titulonoticia = $titulonoticia;
	}

	/**
	 * @param field_type $descricaonoticia
	 */
	public function setDescricaonoticia($descricaonoticia) {
		$this->descricaonoticia = $descricaonoticia;
	}

	/**
	 * @param field_type $datanoticia
	 */
	public function setDatanoticia($datanoticia) {
		$this->datanoticia = $datanoticia;
	}
	
	public function toDataNoticiaDB()
	{
		if($this->getDatanoticia())
		{
			$data = explode("-",$this->getDatanoticia());
			return $data[2]."-".$data[1]."-".$data[0]." ".date("H:i:s");
		}
		else
		{
			return null;
		}
	}
	
	
	/**
	 * @return the $imagemnoticia
	 */
	public function getImagemnoticia() {
		return $this->imagemnoticia;
	}

	/**
	 * @param field_type $imagemnoticia
	 */
	public function setImagemnoticia($imagemnoticia) {
		$this->imagemnoticia = $imagemnoticia;
	}
	
	

	/**
	 * @return the $destaque
	 */
	public function getDestaque() {
		return $this->destaque;
	}

	/**
	 * @param field_type $destaque
	 */
	public function setDestaque($destaque) {
		$this->destaque = $destaque;
	}

	public function validate(){
		
		// limpa os validators anteriores
		Lumine_Validator_PHPValidator::clearValidations($this);
		
		// adicionando as regras 
		Lumine_Validator_PHPValidator::addValidation($this, 'titulonoticia', Lumine_Validator::REQUIRED_STRING, 'Informe o título da notícia');
		return parent::validate();
	}
	
}

?>