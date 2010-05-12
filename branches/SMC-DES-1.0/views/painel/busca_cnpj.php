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
	<form name="busca_cnpj" method="POST" action="../../class/ControlaFuncionalidades.php" >
		<input type="hidden" id="acao" name="acao" value="buscaCnpj">
		<input type="hidden" id="idCliente" name="idCliente" value="<?=$logon->getIdClientes()?>">
		<p class="caption"> Consulta de Pessoa Jurídica</p>
		<label>Nome da empresa:</label>
		<input name="busca" type="text" class="nome" >
		<span class="borda"> </span> 
		<p class="tright"> <input class="f_right" type="submit" value="Procurar" > </p>
	</form>	

</div>
<?php 
		$collEmpresasPesquisadas = null;
		if(isset($_GET['empresasPesquisadas']))
		{
			if($_GET['empresasPesquisadas'] != '')
			{
				$collEmpresasPesquisadas = unserialize(urldecode($_GET['empresasPesquisadas']));
			}
			else 
			{
				$collEmpresasPesquisadas = null;
			}
			if(!is_null($collEmpresasPesquisadas) && count($collEmpresasPesquisadas) > 0)
			{
				if(count($collEmpresasPesquisadas) > 1)
					echo "<p>".count($collEmpresasPesquisadas)." resultados encontrados</p><br><br>";
				else
					echo "<p>".count($collEmpresasPesquisadas)." resultado encontrado</p><br><br>";
			}
			else
			{
				echo "<p align=\"center\">Nenhum resultado encontrado.</p>";
			}
		} 
		
		$empresaPesquisada = new Empresas();
		if(!is_null($collEmpresasPesquisadas) && count($collEmpresasPesquisadas) > 0)
		{
?>
<div id="form_resultados">
	<div id="titulos">
		<label class="nome tleft">Nome</label> 
		<label class="cpf tcenter">CPF</label>
	</div>
	<?php 
	foreach ($collEmpresasPesquisadas as $empresaAtual)
	{
		$empresaPesquisada = (object)$empresaAtual;
	?>
	<form class="esq" method="get" action="index.php"  id="form" name="form">
		<table width="655">
      <tr>
        <td width="293"><b>
          <?=$empresaPesquisada->getNomeEmpresa()?>
        </b></td>
        <td width="244"><b>
          <?=$empresaPesquisada->getCnpjEmpresa()?>
        </b></td>
        <td width="102"><a href="javascript:void(0)" onclick="document.form.submit();">Detalhar / Alterar</a></td>
      </tr>
   	 </table>
		<input type="hidden" value="<?=$empresaPesquisada->getIdEmpresa()?>" name="idEmpresaAlterar" />
    	<input type="hidden" value="detalhe_cnpj" name="p" />
	</form>
	<?php 
	}
	?>
</div>
<?php 
		}
?>
</body>
</html>