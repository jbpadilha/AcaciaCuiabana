<?php
//####################################
// * Joуo Batista Padilha e Silva Analista/Desenvolvedor (Сbaco Tecnologia)
// * Arquivo: UsuariosVo.php
// * Criaчуo: Joуo Batista Padilha e Silva
// * Revisуo:
// * Data de criaчуo: 30/06/2008
//####################################
/*
   Classe Value Objet. Serve para transportar os atributos dos usuсrios entre as camadas.
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