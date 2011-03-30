<?php
//####################################
// * Rafael Henrique Vieira de Moura / Desenvolvedor (Сbaco Tecnologia)
// * Arquivo: Permissao_Usuarios_Funcionalidades_PapeisVo.php
// * Criaчуo: Rafael Henrique Vieira de Moura
// * Revisуo:
// * Data de criaчуo: 01/07/2008
//####################################
/*
   Classe Value Object. Serve para transportar os atributos de
   Permissao_Usuarios_Funcionalidades_papeis entre as camadas.
*/

class Permissao_Usuarios_Funcionalidades_PapeisVo extends AbstractVo 
{
	private $idPermissao_Usuarios_Funcionalidades_Papeis = null;
	private $idUsuarios = null;
	private $idPapeis = null;
	private $idFuncionalidades = null;
	
	public function setIdPermissao_Usuarios_Funcionalidades_Papeis($id = null)
	{
		$this->idPermissao_Usuarios_Funcionalidades_Papeis = $id;
	}
	
	public function getIdPermissao_Usuarios_Funcionalidades_Papeis()
	{
		return $this->idPermissao_Usuarios_Funcionalidades_Papeis;
	}
	
	public function setIdUsuarios($id = null)
	{
		$this->idUsuarios = $id;
	}
	
	public function getIdUsuarios()
	{
		return $this->idUsuarios;
	}
	
	public function setIdPapeis($id = null)
	{
		$this->idPapeis = $id;
	}
	
	public function getIdPapeis()
	{
		return $this->idPapeis;
	}
	
	public function setIdFuncionalidades($id = null)
	{
		$this->idFuncionalidades = $id;
	}
	
	public function getIdFuncionalidades()
	{
		return $this->idFuncionalidades;
	}
}
?>