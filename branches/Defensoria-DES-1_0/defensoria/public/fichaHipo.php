<?php
require '../application/GruposUsuarios.php';
require '../application/ProjetoUtil.php'; 
include 'carregamentoInicial.php';
?>
<html>
	<head>
		<script type="text/javascript">
		$(document).ready(function(){ 
			$("#cpfPesquisa").mask("999.999.999-99");
		});
			function pesquisar()
			{
				if ( $('#nomePesquisa').val() == '' && $('#cpfPesquisa').val() == '') {
					alert('O nome ou CPF deve ser informado.');
					return false;
				}
				else
				{
					var formulario = $('#pesquisaFichaHipo').serialize(true);
					carregaPaginaPesquisa($('#pesquisaFichaHipo').attr("action"),'page',formulario);
				}
			}

			function gerandoPDF(idhipossuficiencia)
			{
				$('#idhipossuficiencia').val(idhipossuficiencia);
				$('#gerandoPdf').submit();
			}
		</script>
	</head>
	<body>
		<form name="pesquisaFichaHipo" id="pesquisaFichaHipo" method="get" action="../application/recebePostGet.php" >
			<input type="hidden" id="control" name="control" value="Hipossuficiencia"/>
			<input type="hidden" id="pesquisa" name="pesquisa" value="true"/>
			<fieldset>
				<legend class="subtitulo">Pesquisar Ficha Hipossuficiência Emitida:</legend>
				<table>
					<tr>
						<td colspan="3">A pesquisa pelo Nome ou CPF é obrigatório.</td>
					</tr>
					<tr>
						<td>Nome:</td>
						<td colspan="2" align="left"><input type="text" name="nomePesquisa" id="nomePesquisa" style="text-transform: uppercase;" /></td>
					</tr>
					<tr>
						<td>CPF:</td>
						<td align="left"><input type="text" name="cpfPesquisa" id="cpfPesquisa" /></td>
						<td><input type="button" name="submit" id="submit" value="Pesquisar" onClick="pesquisar();"/></td>
					</tr>
				</table>
			</fieldset>
		</form>
		<?php
		if(isset($_SESSION['fichaHipoPesquisa']))
		{
			$arrayConvites = $_SESSION['fichaHipoPesquisa'];
		?>
		<form name="gerandoPdf" id="gerandoPdf" method="post" action="../application/recebePostGet.php" target="_blank" >
			<input type="hidden" id="control" name="control" value="GerarPDF"/>
			<input type="hidden" id="funcao" name="funcao" value="FichaHipo"/>
			<input type="hidden" id="idhipossuficiencia" name="idhipossuficiencia" value=""/>
	      <table width="694">
		      <tr>
		        <td colspan="3">&nbsp;</td>
	        </tr>
		      <tr>
		        <td colspan="3"><strong>Ficha Hipossuficiência Emitidos</strong></td>
	        </tr>
		      <tr>
		        <td colspan="3">&nbsp;</td>
	        </tr>
		      <tr>
		        <td colspan="3"><strong>Nome da Pessoa</strong></td>
	        </tr>
		      <?php 
				foreach ($arrayConvites as $fichaAtual)
				{
					$fichaHipo = new Hipossuficiencia();
					$fichaHipo->setIdhipossuficiencia($fichaAtual);
					$fichaHipo->find(true);
				?>
		      <tr>
		        <td width="335" nowrap><?=$fichaHipo->getPessoa()->getNomepessoa()?></td>
		        <td width="347" colspan="2"><a href="javascript:void(0);" onClick="gerandoPDF(<?=$fichaHipo->getIdhipossuficiencia()?>);"><img src="images/pdf.jpg" width="16" height="16" border="0" /></a></td>
	        </tr>
		      <?php 
				}
			  	?>
	      </table>
		</form>
		<?php
		unset($_SESSION['fichaHipoPesquisa']); 
		}
		?>	
	</body>
</html>