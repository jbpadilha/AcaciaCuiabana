<?php
//####################################
// * Jo�o Batista Padilha e Silva Analista/Desenvolvedor (�baco Tecnologia)
// * Arquivo: UsuariosVo.php
// * Cria��o: Jo�o Batista Padilha e Silva
// * Revis�o:
// * Data de cria��o: 30/06/2008
//####################################
/*
   Classe Value Objet. Serve para transportar os atributos dos usu�rios entre as camadas.
*/

class AbstractVo
{
	private $parametroConsulta = '';
	
	public function setParametroConsulta($parametro = '')
	{
		$this->parametroConsulta = $parametro;
	}
	
	public function getParametroConsulta()
	{
		return $this->parametroConsulta;
	}
}
?>