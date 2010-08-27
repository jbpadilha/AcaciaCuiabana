<?php
/**
 * Classe de CNH
 * @author Joao Padilha
 * @version 1.0
 */
class Cnh
{

	private $idCnh;
	private $numeroCnh;
	private $categoriaCnh;
	private $ufCnh;
	private $vencCnh;
	
	/**
	 * @return the $idCnh
	 */
	public function getIdCnh() {
		return $this->idCnh;
	}

	/**
	 * @return the $numeroCnh
	 */
	public function getNumeroCnh() {
		return $this->numeroCnh;
	}

	/**
	 * @return the $categoriaCnh
	 */
	public function getCategoriaCnh() {
		return $this->categoriaCnh;
	}

	/**
	 * @return the $ufCnh
	 */
	public function getUfCnh() {
		return $this->ufCnh;
	}

	/**
	 * @return the $vencCnh
	 */
	public function getVencCnh() {
		return $this->vencCnh;
	}

	/**
	 * @param $idCnh the $idCnh to set
	 */
	public function setIdCnh($idCnh) {
		$this->idCnh = $idCnh;
	}

	/**
	 * @param $numeroCnh the $numeroCnh to set
	 */
	public function setNumeroCnh($numeroCnh) {
		$this->numeroCnh = $numeroCnh;
	}

	/**
	 * @param $categoriaCnh the $categoriaCnh to set
	 */
	public function setCategoriaCnh($categoriaCnh) {
		$this->categoriaCnh = $categoriaCnh;
	}

	/**
	 * @param $ufCnh the $ufCnh to set
	 */
	public function setUfCnh($ufCnh) {
		$this->ufCnh = $ufCnh;
	}

	/**
	 * @param $vencCnh the $vencCnh to set
	 */
	public function setVencCnh($vencCnh) {
		$this->vencCnh = $vencCnh;
	}
	
	public function retornaCondutor()
	{
		$controla = new ControlaFuncionalidades();
		$condutor = new Condutores();
		$condutor->setIdCnh($this->idCnh);
		$collVo = $controla->findCondutores($condutor);
		return $condutor = $collVo[0];  
	}
	
	public function retornaPessoa()
	{
		$controla = new ControlaFuncionalidades();
		$condutor = new Condutores($this->retornaCondutor());
		$pessoa = new Pessoa();
		$pessoa->setIdPessoa($condutor->getIdPessoa());
		$collVo = $controla->findPessoas($pessoa);
		return $pessoa = $collVo[0]; 
	}
}
?>