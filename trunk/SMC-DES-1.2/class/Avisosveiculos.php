<?php
/**
 * Classe de Aviso para Veiculos
 * @author Joao Padilha
 * @version 1.0
 */
class Avisosveiculos
{

	private $idAvisosVeiculos;
	private $dataAvisoVeiculos;
	private $idVeiculos;
	
	/**
	 * @return the $idAvisosVeiculos
	 */
	public function getIdAvisosVeiculos() {
		return Avisosveiculos::$idAvisosVeiculos;
	}

	/**
	 * @return the $dataAvisoVeiculos
	 */
	public function getDataAvisoVeiculos() {
		return $this->dataAvisoVeiculos;
	}

	/**
	 * @return the $idVeiculos
	 */
	public function getIdVeiculos() {
		return $this->idVeiculos;
	}

	/**
	 * @param $idAvisosVeiculos the $idAvisosVeiculos to set
	 */
	public function setIdAvisosVeiculos($idAvisosVeiculos) {
		Avisosveiculos::$idAvisosVeiculos = $idAvisosVeiculos;
	}

	/**
	 * @param $dataAvisoVeiculos the $dataAvisoVeiculos to set
	 */
	public function setDataAvisoVeiculos($dataAvisoVeiculos) {
		$this->dataAvisoVeiculos = $dataAvisoVeiculos;
	}

	/**
	 * @param $idVeiculos the $idVeiculos to set
	 */
	public function setIdVeiculos($idVeiculos) {
		$this->idVeiculos = $idVeiculos;
	}


}
?>