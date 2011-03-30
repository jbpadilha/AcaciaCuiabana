<?php
//####################################
// * Rafael Henrique Vieira de Moura /Desenvolvedor (Ábaco Tecnologia)
// * Arquivo: viewGrupoFluxos.php
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
	var formulario = $('#form1').serialize(true);
	$('#conteudo').block({message:'<h4>Aguarde...</h4><br/><img src="./imagens/loading.gif" border="0" />'});
	$.post('class/ControlaPostGet.php',formulario,function(retorno){
		$('#conteudo').unblock();
		if(retorno == '1'){
			alert('Cadastrado com sucesso.');
			carregaPagina('viewGrupoFluxos.php','formulario');
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

<h3>Grupo de Fluxos Cadastrados</h3>
<div id="barra">
	<a href="javascript:void(0)" title="Cadastrar Novo Grupo" onclick="carregaPagina('viewGrupoFluxos.php?cadastro=true','formulario');"><img src="imagens/ico_novo.jpg" border="0"  />&nbsp;&nbsp;Novo Grupo&nbsp;&nbsp;|&nbsp;&nbsp;</a>
	<a href="javascript:void(0)" title="Localizar Grupo" onclick="carregaPagina('viewGrupoFluxos.php','formulario');"><img src="imagens/ico_localizar.gif" border="0"  />&nbsp;&nbsp;Localizar Grupo&nbsp;&nbsp;|&nbsp;&nbsp;</a>
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
			<td class="formTdEsquerdo">Nome do Grupo:</td>
			<td><input type="text" size="30" name="nomeGrupoFluxos" id="nomeGrupoFluxos" class="campo" /></td>
		</tr>
		<tr>
			<td colspan="2" align="center">
				<input type="button" name="<?=$dominio->botaoConfirmar?>" value="<?=$dominio->botaoConfirmar_TXT?>" title="<?=$dominio->botaoConfirmar_msg?>" class="botao" onclick="consultar()" />&nbsp;
				<input type="reset" name="<?=$dominio->botaoLimpar?>" value="<?=$dominio->botaoLimpar_TXT?>" title="<?=$dominio->botaoLimpar_msg?>" class="botao" />
			</td>
		</tr>
	</table>
	<input type="hidden" name="pagina" value="pesquisaGrupoFluxos" />
</form>
<div id="contentRetorno">
<table width="95%" border="0" cellpadding="1" cellspacing="0" class="tabelaListagem" align="center">
	<tr>
		<td class="tituloListagem" colspan="2">Nome do Grupo</td>
	</tr>
	<?php
		$controlaGrupoFluxos = new Controla_GrupoFluxos();
		$controlaGrupoFluxos->mostraGrupoFluxos();
	?>
</table>
</div>
<?php
} 
elseif (!isset($_GET['pesquisa'])) 
{
	$controlaGrupoFluxos = new Controla_GrupoFluxos();
	$grupoFluxosVo = new GrupoFluxosVo();
	
	// Caso seja alteração
	if(isset($_GET['idGrupoFluxos']))
	{
		$grupoFluxosVo->setIdGrupoFluxos($_GET['idGrupoFluxos']);
		$collVo = $controlaGrupoFluxos->pesquisarGrupoFluxos($grupoFluxosVo);
		$grupoFluxosVo = (object) $collVo[0];
		
	}
?>
<form action="" method="POST" id="form1" name="form1">
	<table align="center" width="100%">
		<tr>
			<td class="formTdEsquerdo">Nome do Grupo:<span class="asterisco"> *</span></td>
			<td colspan="2"><input type="text" name="nomeGrupoFluxos" id="nomeGrupoFluxos" size="20" value="<?=$grupoFluxosVo->getNomeGrupoFluxos()?>" class="campo"/></td>
		</tr>			
		<tr align="center">
			<td colspan="3" class="formTdCentro">
				<input type="button" value="<?=$dominio->botaoConfirmar_TXT?>" id="<?=$dominio->botaoConfirmar?>" class="botao" onclick="cadastrar()"/>
				&nbsp;
				<input type="button" value="<?=$dominio->botaoVoltar_TXT?>" id="<?=$dominio->botaoVoltar?>" class="botao" onClick="carregaPagina('viewGrupoFluxos.php','formulario');" />
			</td>
		</tr>
	</table>
	<input type="hidden" name="pagina" id="pagina" value="cadastraGrupoFluxos"/>
	<input type="hidden" name="idGrupoFluxos" id="idGrupoFluxos" value="<?=$grupoFluxosVo->getIdGrupoFluxos()?>"/>
	<input type="hidden" name="funcionalidade" value="<?=basename(__FILE__)?>" />
</form>
<?php
}
?>