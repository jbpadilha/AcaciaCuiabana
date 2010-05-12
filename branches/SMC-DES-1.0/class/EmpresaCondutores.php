<?php
/**
 * Classe de EmpresaCondutores
 * @author Joao Padilha
 * @version 1.0
 */
class EmpresaCondutores
{

	private static $idEmpresaCondutores;
	private $idEmpresa;
	private $idCondutores;

	
	/**
	 * @return the $idEmpresaCondutores
	 */
	public static function getIdEmpresaCondutores() {
		return EmpresaCondutores::$idEmpresaCondutores;
	}

	/**
	 * @return the $idEmpresa
	 */
	public function getIdEmpresa() {
		return $this->idEmpresa;
	}

	/**
	 * @return the $idCondutores
	 */
	public function getIdCondutores() {
		return $this->idCondutores;
	}

	/**
	 * @param $idEmpresaCondutores the $idEmpresaCondutores to set
	 */
	public static function setIdEmpresaCondutores($idEmpresaCondutores) {
		EmpresaCondutores::$idEmpresaCondutores = $idEmpresaCondutores;
	}

	/**
	 * @param $idEmpresa the $idEmpresa to set
	 */
	public function setIdEmpresa($idEmpresa) {
		$this->idEmpresa = $idEmpresa;
	}

	/**
	 * @param $idCondutores the $idCondutores to set
	 */
	public function setIdCondutores($idCondutores) {
		$this->idCondutores = $idCondutores;
	}



}
?>