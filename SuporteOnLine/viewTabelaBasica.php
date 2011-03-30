<?php
//####################################
// * Rafael Henrique Vieira de Moura /Desenvolvedor (Ábaco Tecnologia)
// * Arquivo: viewTabelaBasica.php
// * Criação: João Batista Padilha e Silva
// * Revisão:
// * Data de criação: 10/07/2008
//####################################

/**
 * Página de Manter Tabela Basica
 */

require("config.php");

if(!isset($_SESSION["usuario_Logado"]))
{
	header("Location:index.php");
}
?>
<script type="text/javascript">

function cadastrar(){
	var formulario = $('#cadastraTabelaBasica').serialize(true);
	$('#conteudo').block({message:'<h4>Aguarde...</h4><br/><img src="./imagens/loading.gif" border="0" />'});
	$.post('class/ControlaPostGet.php',formulario,function(retorno){
		$('#conteudo').unblock();
		if(retorno == '1'){
			alert('Cadastrado com sucesso.');
			carregaPagina('viewTabelaBasica.php','formulario');
		} else {
			$('.informacao').empty().html(retorno);
			$('.informacao').slideDown('slow');
		}
	})
}

$(document).ready(function(){
	$("#toleranciaTabelaBasica").mask("99:99:99");
	$("#horasBaseTrabalhadasTabelaBasica").mask("99:99:99");
	$("#horasNaoTrabalhadasBaseTabelaBasica").mask("99:99:99");
	$("#horasInicioTrabalhoTabelaBasica").mask("99:99:99");
	$("#horasFimTrabalhoTabelaBasica").mask("99:99:99");
	$("#horasIntervaloInicioTabelaBasica").mask("99:99:99");
	$("#horasIntervaloFimTabelaBasica").mask("99:99:99");
	$("#horasBaseRecebimentoPedido").mask("99:99:99");
});

</script>
<h3>Tabela Básica</h3>
<div id="barra" style="display:none">
<br>
</div>
<br />
<div class="informacao" style="display:none"></div>
<?php
if (!isset($_GET['cadastro'])){
?>
<div id="contentRetorno">
<table width="95%" border="0" cellpadding="1" cellspacing="0" class="tabelaListagem" align="center">
	<tr>
		<td class="tituloListagem" colspan="2">Tabela Básica</td>
	</tr>
<?php
	$controlaTabelaBasica = new Controla_TabelaBasica();
	$tabelaBasicaVo = new TabelaBasicaVo();
	echo $controlaTabelaBasica->mostraTabelaBasica($tabelaBasicaVo);
?>
</table>
</div>
<?php
} else {
	$tabelaBasicaVo = new TabelaBasicaVo();
	
	if (isset($_GET['idTabelaBasica'])) {
		$tabelaBasicaVo->setIdTabelaBasica($_GET['idTabelaBasica']);
		$controlaTabelaBasica = new Controla_TabelaBasica();
		$collVo = $controlaTabelaBasica->pesquisaTabelaBasica($tabelaBasicaVo);
		$tabelaBasicaVo = (object) $collVo[0];
	}
?>
<form action="#" id="cadastraTabelaBasica" name="cadastraTabelaBasica" method="post" onsubmit="return false">
	<table align="center">
		<tr>
			<td class="formTdEsquerdo">E-mail Remetente Padrão:</td>
			<td><input type="text" size="30" name="emailPadraoTabelaBasica" id="emailPadraoTabelaBasica" class="campo" value="<?=$tabelaBasicaVo->getEmailPadraoTabelaBasica()?>" /></td>
		</tr>
		<tr>
			<td class="formTdEsquerdo">Nome do Remetente Padrão:</td>
			<td><input type="text" size="30" name="remetentePadraoTabelaBasica" id="remetentePadraoTabelaBasica" class="campo" value="<?=$tabelaBasicaVo->getNomeRemetenteTabelaBasica()?>" /></td>
		</tr>
		<tr>
			<td class="formTdEsquerdo">Tempo de Tolerância das não conformidades:<span class="asterisco">*</span></td>
			<td><input type="text" size="30" name="toleranciaTabelaBasica" id="toleranciaTabelaBasica" class="campo" value="<?=$tabelaBasicaVo->getToleranciaHoraConformidade()?>" />(hh:mm:ss)</td>
		</tr>
		<tr>
			<td class="formTdEsquerdo">Indique as horas base trabalhadas na empresa:<span class="asterisco">*</span></td>
			<td><input type="text" size="30" name="horasBaseTrabalhadasTabelaBasica" id="horasBaseTrabalhadasTabelaBasica" class="campo" value="<?=$tabelaBasicaVo->getHorasBaseTrabalhadasTabelaBasica()?>" />(hh:mm:ss)</td>
		</tr>
		<tr>
			<td class="formTdEsquerdo">Indique as horas base Não trabalhadas na empresa:<span class="asterisco">*</span></td>
			<td><input type="text" size="30" name="horasNaoTrabalhadasBaseTabelaBasica" id="horasNaoTrabalhadasBaseTabelaBasica" class="campo" value="<?=$tabelaBasicaVo->getHorasNaoTrabalhadasBaseTabelaBasica()?>" />(hh:mm:ss)</td>
		</tr>
		<tr>
			<td class="formTdEsquerdo">Indique a hora de início de trabalho:<span class="asterisco">*</span></td>
			<td><input type="text" size="30" name="horasInicioTrabalhoTabelaBasica" id="horasInicioTrabalhoTabelaBasica" class="campo" value="<?=$tabelaBasicaVo->getHorasInicioTrabalhoTabelaBasica()?>" />(hh:mm:ss)</td>
		</tr>
		<tr>
			<td class="formTdEsquerdo">Indique a hora do fim de trabalho:<span class="asterisco">*</span></td>
			<td><input type="text" size="30" name="horasFimTrabalhoTabelaBasica" id="horasFimTrabalhoTabelaBasica" class="campo" value="<?=$tabelaBasicaVo->getHorasFimTrabalhoTabelaBasica()?>" />(hh:mm:ss)</td>
		</tr>
		<tr>
			<td class="formTdEsquerdo">Indique a hora do início de horário de almoço:<span class="asterisco">*</span></td>
			<td><input type="text" size="30" name="horasIntervaloInicioTabelaBasica" id="horasIntervaloInicioTabelaBasica" class="campo" value="<?=$tabelaBasicaVo->getHorasIntervaloInicioTabelaBasica()?>" />(hh:mm:ss)</td>
		</tr>
		<tr>
			<td class="formTdEsquerdo">Indique a hora do fim de horário de almoço:<span class="asterisco">*</span></td>
			<td><input type="text" size="30" name="horasIntervaloFimTabelaBasica" id="horasIntervaloFimTabelaBasica" class="campo" value="<?=$tabelaBasicaVo->getHorasIntervaloFimTabelaBasica()?>" />(hh:mm:ss)</td>
		</tr>
		<tr>
			<td class="formTdEsquerdo">Indique as horas máximas permitida para receber o pedido (caso ultrapasse, gerar não conformidade):<span class="asterisco">*</span></td>
			<td><input type="text" size="30" name="horasBaseRecebimentoPedido" id="horasBaseRecebimentoPedido" class="campo" value="<?=$tabelaBasicaVo->getHorasBaseRecebimentoPedido()?>" />(hh:mm:ss)</td>
		</tr>
		<tr>
			<td colspan="2">&nbsp;</td>
		</tr>
		<tr>
			<td colspan="2" align="center">
				<input type="button" name="<?=$dominio->botaoConfirmar?>" value="<?=$dominio->botaoConfirmar_TXT?>" title="<?=$dominio->botaoConfirmar_msg?>" class="botao" onclick="cadastrar()" />&nbsp;
				<input type="reset" name="<?=$dominio->botaoLimpar?>" value="<?=$dominio->botaoLimpar_TXT?>" title="<?=$dominio->botaoLimpar_msg?>" class="botao" />
			</td>
		</tr>
	</table>
	<input type="hidden" name="idTabelaBasica" value="<?=$tabelaBasicaVo->getIdTabelaBasica()?>" />
	<input type="hidden" name="pagina" value="cadastraTabelaBasica" />
	<input type="hidden" name="funcionalidade" value="<?=basename(__FILE__)?>" />
</form>
<?php
}
?>