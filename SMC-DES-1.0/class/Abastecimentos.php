<?php
/**
 * Classe de Abastecimentos
 * @author Joao Padilha
 * @version 1.0
 */
class Abastecimentos
{

	private $idAbastecimentos;
	private $dataAbastecimentos;
	private $kmAbastecimentos;
	private $postoAbastecimentos;
	private $nfAbastecimentos;
	private $tipoCombustivelAbastecimentos;
	private $valorAbastecimentos;
	private $litrosAbastecimentos;
	private $idVeiculos;
	private $idPessoa;
	
	/**
	 * @return the $idAbastecimentos
	 */
	public function getIdAbastecimentos() {
		return $this->idAbastecimentos;
	}

	/**
	 * @return the $dataAbastecimentos
	 */
	public function getDataAbastecimentos() {
		return $this->dataAbastecimentos;
	}

	/**
	 * @return the $kmAbastecimentos
	 */
	public function getKmAbastecimentos() {
		return $this->kmAbastecimentos;
	}

	/**
	 * @return the $postoAbastecimentos
	 */
	public function getPostoAbastecimentos() {
		return $this->postoAbastecimentos;
	}

	/**
	 * @return the $nfAbastecimentos
	 */
	public function getNfAbastecimentos() {
		return $this->nfAbastecimentos;
	}

	/**
	 * @return the $tipoCombustivelAbastecimentos
	 */
	public function getTipoCombustivelAbastecimentos() {
		return $this->tipoCombustivelAbastecimentos;
	}

	/**
	 * @return the $valorAbastecimentos
	 */
	public function getValorAbastecimentos() {
		return $this->valorAbastecimentos;
	}

	/**
	 * @return the $litrosAbastecimentos
	 */
	public function getLitrosAbastecimentos() {
		return $this->litrosAbastecimentos;
	}

	/**
	 * @return the $idVeiculos
	 */
	public function getIdVeiculos() {
		return $this->idVeiculos;
	}

	/**
	 * @return the $idPessoa
	 */
	public function getIdPessoa() {
		return $this->idPessoa;
	}

	/**
	 * @param $idAbastecimentos the $idAbastecimentos to set
	 */
	public function setIdAbastecimentos($idAbastecimentos) {
		$this->idAbastecimentos = $idAbastecimentos;
	}

	/**
	 * @param $dataAbastecimentos the $dataAbastecimentos to set
	 */
	public function setDataAbastecimentos($dataAbastecimentos) {
		$this->dataAbastecimentos = $dataAbastecimentos;
	}

	/**
	 * @param $kmAbastecimentos the $kmAbastecimentos to set
	 */
	public function setKmAbastecimentos($kmAbastecimentos) {
		$this->kmAbastecimentos = $kmAbastecimentos;
	}

	/**
	 * @param $postoAbastecimentos the $postoAbastecimentos to set
	 */
	public function setPostoAbastecimentos($postoAbastecimentos) {
		$this->postoAbastecimentos = $postoAbastecimentos;
	}

	/**
	 * @param $nfAbastecimentos the $nfAbastecimentos to set
	 */
	public function setNfAbastecimentos($nfAbastecimentos) {
		$this->nfAbastecimentos = $nfAbastecimentos;
	}

	/**
	 * @param $tipoCombustivelAbastecimentos the $tipoCombustivelAbastecimentos to set
	 */
	public function setTipoCombustivelAbastecimentos($tipoCombustivelAbastecimentos) {
		$this->tipoCombustivelAbastecimentos = $tipoCombustivelAbastecimentos;
	}

	/**
	 * @param $valorAbastecimentos the $valorAbastecimentos to set
	 */
	public function setValorAbastecimentos($valorAbastecimentos) {
		$this->valorAbastecimentos = $valorAbastecimentos;
	}

	/**
	 * @param $litrosAbastecimentos the $litrosAbastecimentos to set
	 */
	public function setLitrosAbastecimentos($litrosAbastecimentos) {
		$this->litrosAbastecimentos = $litrosAbastecimentos;
	}

	/**
	 * @param $idVeiculos the $idVeiculos to set
	 */
	public function setIdVeiculos($idVeiculos) {
		$this->idVeiculos = $idVeiculos;
	}

	/**
	 * @param $idPessoa the $idPessoa to set
	 */
	public function setIdPessoa($idPessoa) {
		$this->idPessoa = $idPessoa;
	}



}
?>