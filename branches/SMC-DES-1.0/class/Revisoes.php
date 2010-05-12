<?php
/**
 * Classe Revisoes
 * @author Joao Padilha
 * @version 1.0
 */
class Revisoes
{

	private $idRevisoes;
	private $dataRevisoes;
	private $kmRevisoes;
	private $proxDataRevisoes;
	private $proxKmRevisoes;
	private $oleoKmRevisoes;
	private $idVeiculos;
	private $idTipoRevisoes;

	
	/**
	 * @return the $idRevisoes
	 */
	public function getIdRevisoes() {
		return $this->idRevisoes;
	}

	/**
	 * @return the $dataRevisoes
	 */
	public function getDataRevisoes() {
		return $this->dataRevisoes;
	}

	/**
	 * @return the $kmRevisoes
	 */
	public function getKmRevisoes() {
		return $this->kmRevisoes;
	}

	/**
	 * @return the $proxDataRevisoes
	 */
	public function getProxDataRevisoes() {
		return $this->proxDataRevisoes;
	}

	/**
	 * @return the $proxKmRevisoes
	 */
	public function getProxKmRevisoes() {
		return $this->proxKmRevisoes;
	}

	/**
	 * @return the $oleoKmRevisoes
	 */
	public function getOleoKmRevisoes() {
		return $this->oleoKmRevisoes;
	}

	/**
	 * @return the $idVeiculos
	 */
	public function getIdVeiculos() {
		return $this->idVeiculos;
	}

	/**
	 * @return the $idTipoRevisoes
	 */
	public function getIdTipoRevisoes() {
		return $this->idTipoRevisoes;
	}

	/**
	 * @param $idRevisoes the $idRevisoes to set
	 */
	public function setIdRevisoes($idRevisoes) {
		$this->idRevisoes = $idRevisoes;
	}

	/**
	 * @param $dataRevisoes the $dataRevisoes to set
	 */
	public function setDataRevisoes($dataRevisoes) {
		$this->dataRevisoes = $dataRevisoes;
	}

	/**
	 * @param $kmRevisoes the $kmRevisoes to set
	 */
	public function setKmRevisoes($kmRevisoes) {
		$this->kmRevisoes = $kmRevisoes;
	}

	/**
	 * @param $proxDataRevisoes the $proxDataRevisoes to set
	 */
	public function setProxDataRevisoes($proxDataRevisoes) {
		$this->proxDataRevisoes = $proxDataRevisoes;
	}

	/**
	 * @param $proxKmRevisoes the $proxKmRevisoes to set
	 */
	public function setProxKmRevisoes($proxKmRevisoes) {
		$this->proxKmRevisoes = $proxKmRevisoes;
	}

	/**
	 * @param $oleoKmRevisoes the $oleoKmRevisoes to set
	 */
	public function setOleoKmRevisoes($oleoKmRevisoes) {
		$this->oleoKmRevisoes = $oleoKmRevisoes;
	}

	/**
	 * @param $idVeiculos the $idVeiculos to set
	 */
	public function setIdVeiculos($idVeiculos) {
		$this->idVeiculos = $idVeiculos;
	}

	/**
	 * @param $idTipoRevisoes the $idTipoRevisoes to set
	 */
	public function setIdTipoRevisoes($idTipoRevisoes) {
		$this->idTipoRevisoes = $idTipoRevisoes;
	}

	public function getUltimaRevisaoCadastrada()
	{
		$controla = new ControlaFuncionalidades();
		$collVo = $controla->findRevisoes($this);
		$ultimaRevisao = new Revisoes();
		if(!is_null($collVo))
		{
			$ultimaRevisao = end($collVo);
		}
		return $ultimaRevisao;
	}

}
?>