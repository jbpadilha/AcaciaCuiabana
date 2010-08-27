<?php
/**
 * Classe de Aviso para Veiculos
 * @author Joao Padilha
 * @version 1.0
 */
class Avisos
{

	private $idAvisos;
	private $dataAvisos;
	private $idClientes;
	private $assuntoAvisos;
	/**
	 * @return the $idAvisos
	 */
	public function getIdAvisos() {
		return $this->idAvisos;
	}

	/**
	 * @return the $dataAvisos
	 */
	public function getDataAvisos() {
		return $this->dataAvisos;
	}

	/**
	 * @return the $idClientes
	 */
	public function getIdClientes() {
		return $this->idClientes;
	}

	/**
	 * @return the $assuntoAvisos
	 */
	public function getAssuntoAvisos() {
		return $this->assuntoAvisos;
	}

	/**
	 * @param $idAvisos the $idAvisos to set
	 */
	public function setIdAvisos($idAvisos) {
		$this->idAvisos = $idAvisos;
	}

	/**
	 * @param $dataAvisos the $dataAvisos to set
	 */
	public function setDataAvisos($dataAvisos) {
		$this->dataAvisos = $dataAvisos;
	}

	/**
	 * @param $idClientes the $idClientes to set
	 */
	public function setIdClientes($idClientes) {
		$this->idClientes = $idClientes;
	}

	/**
	 * @param $assuntoAvisos the $assuntoAvisos to set
	 */
	public function setAssuntoAvisos($assuntoAvisos) {
		$this->assuntoAvisos = $assuntoAvisos;
	}


	
}
?>