<?php
//####################################
// * Rafael Henrique Vieira de Moura / Desenvolvedor (Сbaco Tecnologia)
// * Arquivo: ClientesVo.php
// * Criaчуo: Rafael Henrique Vieira de Moura
// * Revisуo:
// * Data de criaчуo: 01/07/2008
//####################################
/*
   Classe Value Object. Serve para transportar os atributos dos clientes entre as camadas.
*/

class ClientesVo extends AbstractVo
{
	private $idClientes = null;
	private $nomeClientes = '';
	
	public function setIdClientes($id = null)
	{
		$this->idClientes = $id;
	}
	
	public function getIdClientes()
	{
		return $this->idClientes;
	}
	
	public function setNomeClientes($nome = '')
	{
		$this->nomeClientes = $nome;
	}
	
	public function getNomeClientes()
	{
		return $this->nomeClientes;
	}
}
?>