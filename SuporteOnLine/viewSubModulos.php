<?php
//####################################
// * Rafael Henrique Vieira de Moura /Desenvolvedor (Ábaco Tecnologia)
// * Arquivo: viewSubModulos.php
// * Criação: Rafael Henrique Vieira de Moura
// * Revisão:
// * Data de criação: 10/07/2008
//####################################

/**
 * Página de Manter SubMódulos
 */

require("config.php");

if(!isset($_SESSION["usuario_Logado"]))
{
	header("Location:index.php");
}

if (isset($_GET['cadastro']))
{
	$descricao = htmlentities("Atualizar Cadastro de SubMódulo");
}
elseif (isset($_GET['pesquisa']))
{
	$descricao = htmlentities("Localizar SubMódulos");
}
else 
{
	$descricao = htmlentities("SubMódulos Cadastrados");
}
?>
<script type="text/javascript">
	function consultar(){
		var formulario = $('#formPesqSubModulos').serialize(true);
		$('#conteudo').block({message:'<h4>Aguarde...</h4><br/><img src="./imagens/loading.gif" border="0" />'});
		$.post('class/ControlaPostGet.php',formulario,function(retorno){
			$('#conteudo').unblock();
			$('#contentRetorno').empty().html(retorno);
			$('#contentRetorno').slideDown('slow');
		})
	}
	function cadastrar(){
		var formulario = $('#cadastraSubModulos').serialize(true);
		$('#conteudo').block({message:'<h4>Aguarde...</h4><br/><img src="./imagens/loading.gif" border="0" />'});
		$.post('class/ControlaPostGet.php',formulario,function(retorno){
			$('#conteudo').unblock();
			if(retorno == '1'){
				alert('Cadastrado com sucesso.');
				carregaPagina('viewSubModulos.php','formulario');
			} else {
				$('.informacao').empty().html(retorno);
				$('.informacao').slideDown('slow');
			}
		})
	}
</script>
<h3><?=$descricao?></h3>
<div id="barra">
	<a href="javascript:void(0)" title="Cadastrar Novo SubMódulo" onclick="carregaPagina('viewSubModulos.php?cadastro=true','formulario');"><img src="imagens/ico_novo.jpg" border="0"  />&nbsp;&nbsp;Novo SubMódulo&nbsp;&nbsp;|&nbsp;&nbsp;</a>
	<a href="javascript:void(0)" title="Localizar SubMódulos" onclick="carregaPagina('viewSubModulos.php','formulario');"><img src="imagens/ico_localizar.gif" border="0"  />&nbsp;&nbsp;Localizar SubMódulos&nbsp;&nbsp;|&nbsp;&nbsp;</a>
</div>
<br />
<div class="informacao" style="display:none"></div>
<?php
if (!isset($_GET['cadastro'])){
?>
<form method="post" id="formPesqSubModulos" action="#" onsubmit="return false">
	<table align="center">
		<tr>
			<td colspan="3" align="center"><strong>Pesquisa de SubMódulos</strong></td>
		</tr>
		<tr>
			<td class="formTdEsquerdo">Nome</td>
			<td><input type="text" size="30" name="nomeSubModulos" id="nomeSubModulos" class="campo" /></td>
		</tr>
		<tr>
			<td colspan="2" align="center">
				<input type="button" name="<?=$dominio->botaoConfirmar?>" value="<?=$dominio->botaoConfirmar_TXT?>" title="<?=$dominio->botaoConfirmar_msg?>" class="botao" onclick="consultar()" />&nbsp;
				<input type="reset" name="<?=$dominio->botaoLimpar?>" value="<?=$dominio->botaoLimpar_TXT?>" title="<?=$dominio->botaoLimpar_msg?>" class="botao" />
			</td>
		</tr>
	</table>
	<input type="hidden" name="pagina" value="pesquisaSubModulos" />
</form>
<br />
<div id="contentRetorno">
<?php
	$subModulosVo = new SubModulosVo();
	$controlaSubModulos = new Controla_SubModulos();
	$controlaSubModulos->mostraListaSubModulos($subModulosVo);
?>
</div>
<?php
} else {
	$subModulosVo = new SubModulosVo();
	
	if (isset($_GET['id'])) {
		$subModulosVo->setIdSubModulos(strip_tags($_GET['id']));
		$controlaSubModulos = new Controla_SubModulos();
		$collVo = $controlaSubModulos->pesquisaSubModulos($subModulosVo);
		$subModulosVo = (object) $collVo[0];
	}
?>
<form action="#" id="cadastraSubModulos" name="cadastraSubModulos" method="post" onsubmit="return false">
	<table align="center">
		<tr>
			<td class="formTdEsquerdo">Nome <span class="asterisco">*</span></td>
			<td><input type="text" size="30" name="nomeSubModulos" id="nomeSubModulos" class="campo" value="<?=$subModulosVo->getNomeSubModulos()?>" /></td>
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
	<input type="hidden" name="idSubModulos" value="<?=$subModulosVo->getIdSubModulos()?>" />
	<input type="hidden" name="pagina" value="cadastraSubModulos" />
	<input type="hidden" name="funcionalidade" value="<?=basename(__FILE__)?>" />
</form>
<?php
}
?>