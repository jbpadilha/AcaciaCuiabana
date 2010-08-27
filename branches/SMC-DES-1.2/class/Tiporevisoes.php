<?php
/**
 * Classe TipoRevisoes
 * @author Joao Padilha
 * @version 1.0
 */
class Tiporevisoes
{

	private $idTipoRevisoes;
	private $descricaoTipoRevisoes;
	
	
	/**
	 * @return the $idTipoRevisoes
	 */
	public function getIdTipoRevisoes() {
		return $this->idTipoRevisoes;
	}

	/**
	 * @return the $descricaoTipoRevisoes
	 */
	public function getDescricaoTipoRevisoes() {
		return $this->descricaoTipoRevisoes;
	}

	/**
	 * @param $idTipoRevisoes the $idTipoRevisoes to set
	 */
	public function setIdTipoRevisoes($idTipoRevisoes) {
		$this->idTipoRevisoes = $idTipoRevisoes;
	}

	/**
	 * @param $descricaoTipoRevisoes the $descricaoTipoRevisoes to set
	 */
	public function setDescricaoTipoRevisoes($descricaoTipoRevisoes) {
		$this->descricaoTipoRevisoes = $descricaoTipoRevisoes;
	}



}
?>