<?php
//####################################
// * João Batista Padilha e Silva Analista/Desenvolvedor (Ábaco Tecnologia)
// * Arquivo: viewSelecionarUsuarios.php
// * Criação: João Batista Padilha e Silva
// * Revisão:
// * Data de criação: 15/07/2008
//####################################

/**
 * Página de Seleção de Usuários
 */

require("config.php");

if(!isset($_SESSION["usuario_Logado"]))
{
	header("Location:index.php");
}
?>
<link rel="stylesheet" type="text/css" media="screen,projection" href="<?=PATH?>/css/default.css" />
<link rel="stylesheet" type="text/css" media="screen,projection" href="<?=PATH?>/css/jquery-calendar.css" />
<link rel="stylesheet" type="text/css" media="print, handheld" href="<?=PATH?>/css/print.css" />
<style type="text/css">
	body{
		height:100%;
	}
</style>
<script language="JavaScript" type="text/javascript">
<!--
/**
 * Função que verifica os usuários já selecionadas
 */
function verificaJaSelecionadas()
{
	usuarios = self.parent.document.form1.idUsuarios.value;
	form = document.form1;
	if(usuarios != '')
	{
		usuarios = usuarios.split(";");
		
		for(i = 0; i < usuarios.length; i ++)
		{
			for(j=0 ; j<form.elements.length ; j++)
			{
				if(form.elements[j].id == usuarios[i])
				{
					form.elements[j].checked = true;
				}
			}
		}
		
	}
}


/**
 * Função que adiciona todas as funcionalidades e atribui a uma variável de retorno.
 */
function addUsuarios() {
	retornoUsuarios = '';
	retornoUsuariosTxt = '';
	form = document.form1;
	for(i=0;i<form.elements.length;i++)
	{
		if(form.elements[i].checked)
		{
			if(retornoUsuarios != '')
			{
				retornoUsuarios = retornoUsuarios+';';
			}
			if(retornoUsuariosTxt != '')
			{
				retornoUsuariosTxt = retornoUsuariosTxt+'\n';
			}
			func = form.elements[i].value;
			func = func.split("&");
			retornoUsuarios = retornoUsuarios+func[0];
			retornoUsuariosTxt = retornoUsuariosTxt+func[1];
		}
	}
	self.parent.document.form1.idUsuarios.value = retornoUsuarios;
	self.parent.document.form1.usuariosTXT.value = retornoUsuariosTxt;
	self.parent.tb_remove();
}
//-->
</script>

<h3>Selecionar Usuários</h3>
<?php
if(!isset($_GET['cadastro']))
{	
?>
<form name="form1" id="form1">
<table width="95%" border="0" cellpadding="1" cellspacing="0" class="tabelaListagem" align="center">
	<tr>
		<td class="tituloListagem">Selecionar</td>
		<td class="tituloListagem">Nome do Usuário</td>
	</tr>
	<?php
		$controlaUsuarios = new Controla_Usuarios();
		echo $controlaUsuarios->mostraSelecionarUsuarios();
	?>
	<tr align="center">
		<td colspan="2" class="formTdCentro">
			<input type="button" value="<?=$dominio->botaoConfirmar_TXT?>" id="<?=$dominio->botaoConfirmar?>" class="botao" onclick="addUsuarios();"/>
			&nbsp;
			<input type="button" value="<?=$dominio->botaoVoltar_TXT?>" id="<?=$dominio->botaoVoltar?>" class="botao" onClick="self.parent.tb_remove();"/>
		</td>
	</tr>
</table>
</form>
<?php
}
?>
<script>verificaJaSelecionadas();</script>