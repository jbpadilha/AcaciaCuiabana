<?php
/**
 * Classe de Condutores
 * @author Joao Padilha
 * @version 1.0
 */
class Condutores
{

	private $idCondutores;
	private $dataRegistroCondutores;
	private $obsCondutores;
	private $idPessoa;
	private $idCnh;
		
	/**
	 * @return the $idCondutores
	 */
	public function getIdCondutores() {
		return $this->idCondutores;
	}

	/**
	 * @return the $dataRegistroCondutores
	 */
	public function getDataRegistroCondutores() {
		return $this->dataRegistroCondutores;
	}

	/**
	 * @return the $obsCondutores
	 */
	public function getObsCondutores() {
		return $this->obsCondutores;
	}

	/**
	 * @return the $idPessoa
	 */
	public function getIdPessoa() {
		return $this->idPessoa;
	}

	/**
	 * @return the $idCnh
	 */
	public function getIdCnh() {
		return $this->idCnh;
	}

	/**
	 * @param $idCondutores the $idCondutores to set
	 */
	public function setIdCondutores($idCondutores) {
		$this->idCondutores = $idCondutores;
	}

	/**
	 * @param $dataRegistroCondutores the $dataRegistroCondutores to set
	 */
	public function setDataRegistroCondutores($dataRegistroCondutores) {
		$this->dataRegistroCondutores = $dataRegistroCondutores;
	}

	/**
	 * @param $obsCondutores the $obsCondutores to set
	 */
	public function setObsCondutores($obsCondutores) {
		$this->obsCondutores = $obsCondutores;
	}

	/**
	 * @param $idPessoa the $idPessoa to set
	 */
	public function setIdPessoa($idPessoa) {
		$this->idPessoa = $idPessoa;
	}

	/**
	 * @param $idCnh the $idCnh to set
	 */
	public function setIdCnh($idCnh) {
		$this->idCnh = $idCnh;
	}



}
?>