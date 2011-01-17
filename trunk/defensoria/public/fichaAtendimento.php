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
			$("#protocoloAtendimento").numeric();
		});
			function pesquisar()
			{
				if ( $('#nomePesquisa').val() == '' && $('#cpfPesquisa').val() == '' && $('#protocoloAtendimento').val() == '') {
					alert('O nome/CPF ou Protocolo de Atendimento deve ser informado.');
					return false;
				}
				else
				{
					var formulario = $('#pesquisaFichaAtendimento').serialize(true);
					carregaPaginaPesquisa($('#pesquisaFichaAtendimento').attr("action"),'page',formulario);
				}
			}

			function gerandoPDF(identrevista)
			{
				$('#identrevista').val(identrevista);
				$('#gerandoPdf').submit();
			}
		</script>
	</head>
	<body>
		<form name="pesquisaFichaAtendimento" id="pesquisaFichaAtendimento" method="get" action="../application/recebePostGet.php" >
			<input type="hidden" id="control" name="control" value="Entrevista"/>
			<input type="hidden" id="pesquisa" name="pesquisa" value="true"/>
			<fieldset>
				<legend class="subtitulo">Pesquisar Ficha Atendimento/Entrevista Emitidas:</legend>
				<table>
					<tr>
						<td colspan="3">A pesquisa pelo Nome/CPF ou Protocolo de atendimento é obrigatório.</td>
					</tr>
					<tr>
						<td>Protocolo de Atendimento:</td>
						<td colspan="2" align="left"><input type="text" name="protocoloAtendimento" id="protocoloAtendimento" style="text-transform: uppercase;" /></td>
					</tr>
					<tr>
						<td>Nome da Parte Promovente:</td>
						<td colspan="2" align="left"><input type="text" name="nomePesquisa" id="nomePesquisa" style="text-transform: uppercase;" /></td>
					</tr>
					<tr>
						<td>CPF da Parte Promovente:</td>
						<td align="left"><input type="text" name="cpfPesquisa" id="cpfPesquisa" /></td>
						<td><input type="button" name="submit" id="submit" value="Pesquisar" onClick="pesquisar();"/></td>
					</tr>
				</table>
			</fieldset>
		</form>
		<?php
		if(isset($_SESSION['fichaAtendimentoPesquisa']))
		{
			$arrayAtendimento = $_SESSION['fichaAtendimentoPesquisa'];
		?>
		<form name="gerandoPdf" id="gerandoPdf" method="post" action="../application/recebePostGet.php" target="_blank" >
			<input type="hidden" id="control" name="control" value="GerarPDF"/>
			<input type="hidden" id="funcao" name="funcao" value="FichaAtendimento"/>
			<input type="hidden" id="identrevista" name="identrevista" value=""/>
	      <table width="694">
		      <tr>
		        <td colspan="5">&nbsp;</td>
	        </tr>
		      <tr>
		        <td colspan="5"><strong>Ficha Atendimentos/Entrevista Emitidos</strong></td>
	        </tr>
		      <tr>
		        <td colspan="5">&nbsp;</td>
	        </tr>
		      <tr>
		        <td><strong>Nome da Parte Promovente</strong></td>
		        <td><strong>Nome da Parte Promovido</strong></td>
		        <td><strong>Protocolo de Atendimento</strong></td>
		        <td colspan="3"><strong>Data da Atendimento/Entrevista</strong></td>
	        </tr>
		      <?php 
				foreach ($arrayAtendimento as $fichaAtual)
				{
					$entrevista = new Entrevista();
					$entrevista->setIdentrevista($fichaAtual);
					$entrevista->find(true);
				?>
		      <tr>
		        <td width="335" nowrap><?=$entrevista->getProcesso()->getPartePromoventeProcesso()->getPessoa()->getNomepessoa()?></td>
		        <td width="335" nowrap><?=$entrevista->getProcesso()->getPartePromovidoProcesso()->getPessoa()->getNomepessoa()?></td>
		        <td width="335" nowrap><?=$entrevista->getProtocoloatendimento()?></td>
		        <td width="335" nowrap><?=$entrevista->getDataEntrevistaFormatadoPDF()?></td>
		        <td width="347" colspan="2"><a href="javascript:void(0);" onClick="gerandoPDF(<?=$entrevista->getIdentrevista()?>);"><img src="images/pdf.jpg" width="16" height="16" border="0" /></a></td>
	        </tr>
		      <?php 
				}
			  	?>
	      </table>
		</form>
		<?php
		unset($_SESSION['fichaAtendimentoPesquisa']); 
		}
		?>	
	</body>
</html>