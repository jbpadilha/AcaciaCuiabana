<?php

class Noticias extends Lumine_Base {
	
	protected $_tablename = 'noticias';
    protected $_package   = 'model';
    
	public $idnoticia = null;
	public $titulonoticia = null;
	public $descricaonoticia = null;
	public $datanoticia = null;
	public $imagemnoticia = null;
	public $destaque = null;
	public $statusnoticia = null;
	
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
        $this->_addField("imagemnoticia", "imagemnoticia", "varchar", 255, array('notnull' => false));
        $this->_addField("destaque", "destaque", "int", 1, array('notnull' => true));
        $this->_addField("statusnoticia", "statusnoticia", "int", 1, array('notnull' => true));
    }

    /**
     * Recupera um objeto estaticamente
     * @author João Batista Padilha e Silva
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
			$dataHora = explode(" ",$this->getDatanoticia());
			$data = explode("/", $dataHora[0]);
			return $data[2]."-".$data[1]."-".$data[0]." ".$dataHora[1];
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
	
	

	/**
	 * @return the $statusnoticia
	 */
	public function getStatusnoticia() {
		return $this->statusnoticia;
	}

	/**
	 * @param field_type $statusnoticia
	 */
	public function setStatusnoticia($statusnoticia) {
		$this->statusnoticia = $statusnoticia;
	}
	
	/**
	 * 
	 * @return string
	 */
	public function getDescricaoStatusNoticia()
	{
		if($this->statusnoticia != null)
		{
			if($this->statusnoticia == 1)
				return "Ativo";
			else 
				return "Inativo";
		}
		else {
			return "";
		}
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