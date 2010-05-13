<?php
require_once ('../../class/Config.php');
if(!isset($_SESSION['usuarioLogon']))
{
	header("Location:../views/home.php?p=login");
}
$logon = new Logon();
$logon = $_SESSION["usuarioLogon"];

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd" >
<html xmlns="http://www.w3.org/1999/xhtml" >

<head>
	<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
	<title>SMC - Busca CPF (Pessoa física)</title>
	<meta name="Description" content="SMC - Novo cadastro de Pessoa Física" >
	<meta http-equiv="X-UA-Compatible" content="IE=7" > 
	<link rel="stylesheet" href="../css/meucpf.css" type="text/css" media="all" >
</head>
<body>
<div id="form_busca">

	<form name="busca_cpf" action="../../class/ControlaFuncionalidades.php" method="POST">
		<input type="hidden" id="acao" name="acao" value="buscaCpf">
		<input type="hidden" id="idCliente" name="idCliente" value="<?=$logon->getIdClientes()?>">
		<p class="caption"> Consulta de Pessoas</p>
		<label>Nome:</label>
		<input name="busca" type="text" value="" class="nome" >
		<span class="borda"> </span> 
		<p class="tright"> <input class="f_right" type="submit" value="Procurar" > </p>
	</form>	

</div>

<div>
  <p>&nbsp;  </p>
  <p>&nbsp;</p>
  <p>&nbsp;</p>
  <p>&nbsp;</p>
  <p>
    <?php 
		$collPessoasPesquisadas = null;
		if(isset($_GET['pessoasPesquisadas']))
		{
			if($_GET['pessoasPesquisadas'] != '')
			{
				$collPessoasPesquisadas = unserialize(urldecode($_GET['pessoasPesquisadas']));
			}
			else 
			{
				$collPessoasPesquisadas = null;
			}
			if(!is_null($collPessoasPesquisadas) && count($collPessoasPesquisadas) > 0)
			{
				if(count($collPessoasPesquisadas) > 1)
					echo "<p>".count($collPessoasPesquisadas)." resultados encontrados</p><br><br>";
				else
					echo "<p>".count($collPessoasPesquisadas)." resultado encontrado</p><br><br>";
			}
			else
			{
				echo "<p align=\"center\">Nenhum resultado encontrado.</p>";
			}
		} 
		
		$pessoaPesquisada = new Pessoa();
		if(!is_null($collPessoasPesquisadas) && count($collPessoasPesquisadas) > 0)
		{
			?>
  </p>
  <table width="655">
    <tr>
      <td width="295">Nome</td>
      <td width="348" colspan="2">CPF</td>
    </tr>
  </table>
  <?
			foreach ($collPessoasPesquisadas as $pessoas)
			{
				$pessoaPesquisada = (object)$pessoas;
	?>
  <form class="esq" method="get" action="index.php" id="form" name="form">
    <table width="655">
      <tr>
        <td width="293"><b>
          <?=$pessoaPesquisada->getNomePessoa()?>
        </b></td>
        <td width="244"><b>
          <?=$pessoaPesquisada->getCpfPessoa()?>
        </b></td>
        <td width="102"><input type="submit" value="Detalhar / Alterar"/> </td>
      </tr>
    </table>
    <input type="hidden" value="<?=$pessoaPesquisada->getIdPessoa()?>" name="idPessoaAlterar" />
    <input type="hidden" value="detalhe_cpf" name="p" />
  </form>
  <?php
			}
		}
	?>
</div>
</body>
</html>