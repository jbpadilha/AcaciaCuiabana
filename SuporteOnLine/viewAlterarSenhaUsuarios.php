<?php
//####################################
// * Rafael Henrique Vieira de Moura /Desenvolvedor (Ábaco Tecnologia)
// * Arquivo: viewSelecionarFuncionalidades.php
// * Criação: Rafael Henrique Vieira de Moura
// * Revisão:
// * Data de criação: 09/07/2008
//####################################

/**
 * Página de Alteração de senha do usuário no sistema
 */

require("config.php");

if(!isset($_SESSION["usuario_Logado"]))
{
	header("Location:index.php");
}
?>
<link rel="stylesheet" type="text/css" media="screen,projection" href="<?=PATH?>/css/default.css" />
<link rel="stylesheet" type="text/css" media="print, handheld" href="<?=PATH?>/css/print.css" />
<style type="text/css">
	body{
		height:100%;
	}
</style>
<script type="text/javascript" src="js/jquery.js"></script>
<script type="text/javascript" src="js/jquery.blockui.js"></script>
<script language="JavaScript" type="text/javascript">
	function cadastrar(){
		var formulario = $('#formAlterarSenha').serialize(true);
		$.blockUI({message:'<h4>Aguarde...</h4><br/><img src="./imagens/loading.gif" border="0" />'});
		$.post('class/ControlaPostGet.php',formulario,function(retorno){
			$.unblockUI();
			if(retorno == '1'){
				alert('Senha alterada com sucesso.');
				self.parent.tb_remove();
			} else {
				alert(retorno);
			}
		})
	}
</script>

<h3>Alterar Senha do Usuário <?=$_GET['nomeUsuarios']?></h3>
<form name="formAlterarSenha" id="formAlterarSenha" action="#">
<table width="95%" border="0" cellpadding="1" cellspacing="0" class="tabelaListagem" align="center">
	<tr>
		<td colspan="2">&nbsp;</td>
	</tr>
	<tr>
		<td class="formTdEsquerdo">Nova Senha</td>
		<td><input type="password" size="30" name="senhaUsuarios" id="senhaUsuarios" class="campo" /></td>
	</tr>
	<tr>
		<td class="formTdEsquerdo">Confirmar Senha</td>
		<td><input type="password" size="30" name="confirmarSenhaUsuarios" id="confirmarSenhaUsuarios" class="campo" /></td>
	</tr>
	<tr>
		<td colspan="2" align="center">
			<input type="button" name="<?=$dominio->botaoConfirmar?>" value="<?=$dominio->botaoConfirmar_TXT?>" title="<?=$dominio->botaoConfirmar_msg?>" class="botao" onclick="cadastrar()" />&nbsp;
			<input type="button" name="<?=$dominio->botaoVoltar?>" value="<?=$dominio->botaoVoltar_TXT?>" title="<?=$dominio->botaoVoltar_msg?>" class="botao" onclick="self.parent.tb_remove()" />
		</td>
	</tr>
	<tr>
		<td colspan="2">&nbsp;</td>
	</tr>
</table>
<input type="hidden" name="idUsuarios" value="<?=strip_tags($_GET['id'])?>" />
<input type="hidden" name="pagina" value="alteraSenhaUsuario" />
</form>