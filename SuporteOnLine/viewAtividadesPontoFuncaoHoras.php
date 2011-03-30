<?php
//####################################
// * João Batista Padilha e Silva Analista/Desenvolvedor (Ábaco Tecnologia)
// * Arquivo: viewAtividadesPontoFuncaoHoras.php
// * Criação: João Batista Padilha e Silva
// * Revisão:
// * Data de criação: 11/07/2008
//####################################
/**
 * Página de Manter Atividades do Sistema
 */

require("config.php");

if(!isset($_SESSION["usuario_Logado"]))
{
	header("Location:index.php");
}
?>
<script type="text/javascript">

function cadastrar()
{
	var formulario = $('#form1').serialize(true);
	$('#conteudo').block({message:'<h4>Aguarde...</h4><br/><img src="./imagens/loading.gif" border="0" />'});
	$.post('class/ControlaPostGet.php',formulario,function(retorno){
		$('#conteudo').unblock();
		if(retorno == '1'){
			alert('Cadastrado com sucesso.');
			carregaPagina('viewAtividadesPontoFuncaoHoras.php','formulario');
		} else {
			$('.informacao').empty().html(retorno);
			$('.informacao').slideDown('slow');
		}
	})
}

/**
 *	Função que envia o formulário via Ajax. Basta passar o nome do formulario em "var formulario = $('#form1').serialize();"
 *  e indicar o retorno, como sera visto, em uma div ou dar um alert.
 * @author Rafael Moura
 */
function consultar()
{
	var formulario = $('#formPesquisa').serialize(true);
	$('#conteudo').block({message:'<h4>Aguarde...</h4><br/><img src="./imagens/loading.gif" border="0" />'});
	$.post('class/ControlaPostGet.php',formulario,function(retorno){
		$('#conteudo').unblock();
		$('#contentRetorno').empty().html(retorno);
		$('#contentRetorno').slideDown('slow');
	})
}

$(document).ready(function(){
	$('#horasAtividades').mask('99:99:99');
})
</script>

<h3>Atividades Cadastradas</h3>
<div id="barra">
	<a href="javascript:void(0)" title="Cadastrar Nova Atividade" onclick="carregaPagina('viewAtividadesPontoFuncaoHoras.php?cadastro=true','formulario');"><img src="imagens/ico_novo.jpg" border="0"  />&nbsp;&nbsp;Nova Atividade&nbsp;&nbsp;|&nbsp;&nbsp;</a>
	<a href="javascript:void(0)" title="Localizar Atividades" onclick="carregaPagina('viewAtividadesPontoFuncaoHoras.php','formulario');"><img src="imagens/ico_localizar.gif" border="0"  />&nbsp;&nbsp;Localizar Atividades&nbsp;&nbsp;|&nbsp;&nbsp;</a>
</div>
<br />
<div id="informacao" class="informacao" style="display:none"></div>
<?php
if (!isset($_GET['cadastro']) && !isset($_GET['pesquisa']))
{
		$controlaAtividadesPontoFuncaoHoras = new Controla_AtividadesPontoFuncaoHoras();
		$atividadesVo = new AtividadesPontoFuncaoHorasVo();
?>
<form method="post" id="formPesquisa" action="#" onsubmit="return false">
	<table align="center">
		<tr>
			<td class="formTdEsquerdo">Nome da Atividade:</td>
			<td><input type="text" size="30" name="nomeAtividades" id="nomeAtividades" class="campo" /></td>
		</tr>
		<tr>
			<td class="formTdEsquerdo">Tecnologia:</td>
			<td>
				<?=$controlaAtividadesPontoFuncaoHoras->montaSelectTecnologias($atividadesVo);?>
			</td>
		</tr>
		<tr>
			<td colspan="2" align="center">
				<input type="button" name="<?=$dominio->botaoConfirmar?>" value="<?=$dominio->botaoConfirmar_TXT?>" title="<?=$dominio->botaoConfirmar_msg?>" class="botao" onclick="consultar()" />&nbsp;
				<input type="reset" name="<?=$dominio->botaoLimpar?>" value="<?=$dominio->botaoLimpar_TXT?>" title="<?=$dominio->botaoLimpar_msg?>" class="botao" />
			</td>
		</tr>
	</table>
	<input type="hidden" name="pagina" value="pesquisaAtividades" />
</form>
<div id="contentRetorno">
<table width="95%" border="0" cellpadding="1" cellspacing="0" class="tabelaListagem" align="center">
	<tr>
		<td class="tituloListagem">Nome da Atividade</td>
		<td class="tituloListagem" colspan="2">Tecnologia</td>
	</tr>
	<?php
		$controlaAtividadesPontoFuncaoHoras = new Controla_AtividadesPontoFuncaoHoras();
		$controlaAtividadesPontoFuncaoHoras->mostraAtividades();
	?>
</table>
</div>
<?php
} 
elseif (!isset($_GET['pesquisa'])) 
{
	$controlaAtividadesPontoFuncaoHoras = new Controla_AtividadesPontoFuncaoHoras();
	$atividadesVo = new AtividadesPontoFuncaoHorasVo();
	
	// Caso seja alteração
	if(isset($_GET['idAtividades']))
	{
		$atividadesVo->setIdAtividadePontoFuncaoHoras($_GET['idAtividades']);
		$collVo = $controlaAtividadesPontoFuncaoHoras->pesquisarAtividades($atividadesVo);
		$atividadesVo = (object) $collVo[0];	
	}
?>
<form action="" method="POST" id="form1" name="form1">
	<table align="center" width="100%">
		<tr>
			<td class="formTdEsquerdo">Nome da Atividade:<span class="asterisco"> *</span></td>
			<td colspan="2"><input type="text" name="nomeAtividades" id="nomeAtividades" size="20" value="<?=$atividadesVo->getNomeAtividadesPontoFuncaoHoras()?>" class="campo"/></td>
		</tr>
		<tr>
			<td class="formTdEsquerdo">Tecnologia:<span class="asterisco"> *</span></td>
			<td colspan="2">
			<?=$controlaAtividadesPontoFuncaoHoras->montaSelectTecnologias($atividadesVo);?>
			</td>
		</tr>
		<tr>
			<td class="formTdEsquerdo">Quantidade de Ponto Função:</td>
			<td colspan="2"><input type="text" name="pontoFuncaoAtividades" id="pontoFuncaoAtividades" size="20" value="<?=$atividadesVo->getPontoFuncaoAtividadesPontoFuncaoHoras()?>" class="campo"/></td>
		</tr>
		<tr>
			<td class="formTdEsquerdo">Quantidade de Horas:</td>
			<td colspan="2"><input type="text" name="horasAtividades" id="horasAtividades" size="20" value="<?=$atividadesVo->getHorasAtividadesPontoFuncaoHoras()?>" class="campo"/></td>
		</tr>
		<tr align="center">
			<td colspan="3" class="formTdCentro">
			<input type="button" value="<?=$dominio->botaoConfirmar_TXT?>" id="<?=$dominio->botaoConfirmar?>" class="botao" onclick="cadastrar()"/>
			&nbsp;
			<input type="button" value="<?=$dominio->botaoVoltar_TXT?>" id="<?=$dominio->botaoVoltar?>" class="botao" onClick="carregaPagina('viewAtividadesPontoFuncaoHoras.php','formulario')" />
			</td>
		</tr>
	</table>
	<input type="hidden" name="pagina" id="pagina" value="cadastraAtividades"/>
	<input type="hidden" name="idAtividades" id="idAtividades" value="<?=$atividadesVo->getIdAtividadePontoFuncaoHoras()?>"/>
	<input type="hidden" name="funcionalidade" value="<?=basename(__FILE__)?>" />
</form>
<?php
}
?>