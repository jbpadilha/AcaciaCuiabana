<?php
//####################################
// * Rafael Henrique Vieira de Moura /Desenvolvedor (Ábaco Tecnologia)
// * Arquivo: viewTecnologias.php
// * Criação: João Batista Padilha e Silva
// * Revisão:
// * Data de criação: 11/07/2008
//####################################

/**
 * Página de Manter Tecnologias do Sistema
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
	var formulario = $('#cadastraTecnologias').serialize(true);
	$('#conteudo').block({message:'<h4>Aguarde...</h4><br/><img src="./imagens/loading.gif" border="0" />'});
	$.post('class/ControlaPostGet.php',formulario,function(retorno){
		$('#conteudo').unblock();
		if(retorno == '1'){
			alert('Cadastrado com sucesso.');
			carregaPagina('viewTecnologias.php','formulario');
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
		$('#contentRetorno').slideDown('slow');$('#contentRetorno').slideDown('slow');
	})
}

</script>

<h3>Tecnologias Cadastradas</h3>
<div id="barra">
	<a href="javascript:void(0)" title="Cadastrar Nova Tecnologia" onclick="carregaPagina('viewTecnologias.php?cadastro=true','formulario');"><img src="imagens/ico_novo.jpg" border="0"  />&nbsp;&nbsp;Nova Tecnologia&nbsp;&nbsp;|&nbsp;&nbsp;</a>
	<a href="javascript:void(0)" title="Localizar Tecnologia" onclick="carregaPagina('viewTecnologias.php','formulario');"><img src="imagens/ico_localizar.gif" border="0"  />&nbsp;&nbsp;Localizar Tecnologia&nbsp;&nbsp;|&nbsp;&nbsp;</a>
</div>
<br />
<div id="informacao" class="informacao" style="display:none"></div>
<?php
if (!isset($_GET['cadastro']) && !isset($_GET['pesquisa']))
{
?>
<form method="post" id="formPesquisa" action="#" onsubmit="return false">
	<table align="center">
		<tr>
			<td class="formTdEsquerdo">Nome da Tecnologia:</td>
			<td><input type="text" size="30" name="nomeTecnologias" id="nomeTecnologias" class="campo" /></td>
		</tr>
		<tr>
			<td colspan="2" align="center">
				<input type="button" name="<?=$dominio->botaoConfirmar?>" value="<?=$dominio->botaoConfirmar_TXT?>" title="<?=$dominio->botaoConfirmar_msg?>" class="botao" onclick="consultar()" />&nbsp;
				<input type="reset" name="<?=$dominio->botaoLimpar?>" value="<?=$dominio->botaoLimpar_TXT?>" title="<?=$dominio->botaoLimpar_msg?>" class="botao" />
			</td>
		</tr>
	</table>
	<input type="hidden" name="pagina" value="pesquisaTecnologias" />
</form>
<div id="contentRetorno">
<table width="95%" border="0" cellpadding="1" cellspacing="0" class="tabelaListagem" align="center">
	<tr>
		<td class="tituloListagem" colspan="2">Nome da Tecnologia</td>
	</tr>
	<?php
		$controlaTecnologias = new Controla_Tecnologias();
		echo $controlaTecnologias->mostraTecnologias();
	?>
</table>
</div>
<?php
} 
elseif (!isset($_GET['pesquisa'])) 
{
	$controlaTecnologias = new Controla_Tecnologias();
	$tecnologiasVo = new TecnologiasVo();
	
	// Caso seja alteração
	if(isset($_GET['idTecnologias']))
	{
		$tecnologiasVo->setIdTecnologias($_GET['idTecnologias']);
		$collVo = $controlaTecnologias->pesquisarTecnologias($tecnologiasVo);
		$tecnologiasVo = (object) $collVo[0];
		
	}
?>
<form action="" method="POST" id="cadastraTecnologias" name="cadastraTecnologias">
	<table align="center" width="100%">
		<tr>
			<td class="formTdEsquerdo">Nome da Tecnologia:<span class="asterisco"> *</span></td>
			<td colspan="2"><input type="text" name="nomeTecnologias" id="nomeTecnologias" size="20" value="<?=$tecnologiasVo->getNomeTecnologias()?>" class="campo"/></td>
		</tr>			
		<tr align="center">
			<td colspan="3" class="formTdCentro">
				<input type="button" value="<?=$dominio->botaoConfirmar_TXT?>" id="<?=$dominio->botaoConfirmar?>" class="botao" onclick="cadastrar()"/>
				&nbsp;
				<input type="button" value="<?=$dominio->botaoVoltar_TXT?>" id="<?=$dominio->botaoVoltar?>" class="botao" onClick="carregaPagina('viewTecnologias.php','formulario')" />
			</td>
		</tr>
	</table>
	<input type="hidden" name="pagina" id="pagina" value="cadastraTecnologias"/>
	<input type="hidden" name="idTecnologias" id="idTecnologias" value="<?=$tecnologiasVo->getIdTecnologias()?>"/>
	<input type="hidden" name="funcionalidade" value="<?=basename(__FILE__)?>" />
</form>
<?php
}
?>