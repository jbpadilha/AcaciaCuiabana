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
	<link rel="stylesheet" href="../css/default.css" type="text/css" media="all">
</head>
<body>
<style>
	div#placa { float:right; background: url("../imagens/v_placa_particular.png") no-repeat; width:105px; height:60px; text-align:center; padding:2px 0px; }
	div#placa #local { font:10px Consolas; width:100%; margin:0px; padding-top:4px; height:16px;  text-transform:uppercase; }
	div#placa #numero { font:bold 16px Consolas; width:100%; height:auto; margin-top:-2px; padding:0px; }
</style>
<div id="form_busca">

	<form name="busca_veiculo" method="POST" action="../../class/RecebePostGet.php" >
		<input type="hidden" id="acao" name="acao" value="buscaVeiculos">
		<input type="hidden" id="idCliente" name="idCliente" value="<?=$logon->getIdClientes()?>">
		<p class="caption"> Consulta de veículos </p>
		<label>Placa:</label>
		<input name="busca" type="text" class="placa" >
		<span class="borda"> </span> 
		<p class="tright"> <input class="f_right" type="submit" value="Procurar" > </p>
	</form>	

</div>
<?php 
		$collVeiculosPesquisados = null;
		if(isset($_GET['veiculosPesquisados']))
		{
			if($_GET['veiculosPesquisados'] != '')
			{
				$collVeiculosPesquisados = unserialize(urldecode($_GET['veiculosPesquisados']));
			}
			else 
			{
				$collVeiculosPesquisados = null;
			}
			if(!is_null($collVeiculosPesquisados) && count($collVeiculosPesquisados) > 0)
			{
				if(count($collVeiculosPesquisados) > 1)
					echo "<p>".count($collVeiculosPesquisados)." resultados encontrados</p><br><br>";
				else
					echo "<p>".count($collVeiculosPesquisados)." resultado encontrado</p><br><br>";
			}
			else
			{
				echo "<p align=\"center\">Nenhum resultado encontrado.</p>";
			}
		} 
		
		$veiculoPesquisado = new Veiculos();
		if(!is_null($collVeiculosPesquisados) && count($collVeiculosPesquisados) > 0)
		{
			?>
<div id="form_resultados">
<div id="titulos">
	<label class="nome tleft">Placa</label> 
	<label class="cpf tcenter">Modelo</label>
</div>
<?php 
			foreach ($collVeiculosPesquisados as $veiculos)
			{
				$veiculoPesquisado = (object)$veiculos;
?>
	<form class="esq" method="get" action="index.php" >
		<table width="655">
	      	<tr>
		        <td width="293"><b>
		          <?=$veiculoPesquisado->getPlacaVeiculos()?>
		        </b></td>
		        <td width="244"><b>
		          <?=$veiculoPesquisado->getModeloVeiculos()?>
		        </b></td>
		        <td width="102"><input type="submit" value="Detalhar / Alterar"/> </td>
	      	</tr>
   	 	</table>
		<input type="hidden" value="<?=$veiculoPesquisado->getIdVeiculos()?>" name="idVeiculosAlterar" />
    	<input type="hidden" value="detalhe_veiculo" name="p" />
	</form>
	<?php 
			}
	?>
</div>
<?php 
		}
?>
<div id="separador"> </div>
</body>
</html>