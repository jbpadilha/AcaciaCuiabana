<?php
//####################################
// * João Batista Padilha e Silva Analista/Desenvolvedor (Ábaco Tecnologia)
// * Arquivo: viewSelecionarFuncionalidades.php
// * Criação: João Batista Padilha e Silva
// * Revisão:
// * Data de criação: 07/07/2008
//####################################

/**
 * Página de Seleção de Funcionalidades
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
 * Função que verifica as funcionalidades já selecionadas
 */
function verificaFuncionalidadesJaSelecionadas()
{
	funcionalidades = self.parent.document.form1.idFuncionalidades.value;
	form = document.form1;
	if(funcionalidades != '')
	{
		funcionalidades = funcionalidades.split(";");
		
		for(i = 0; i < funcionalidades.length; i ++)
		{
			for(j=0 ; j<form.elements.length ; j++)
			{
				if(form.elements[j].id == funcionalidades[i])
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
function addFuncionalidades() {
	retornoFuncionalidades = '';
	retornoFuncionalidadesTxt = '';
	form = document.form1;
	for(i=0;i<form.elements.length;i++)
	{
		if(form.elements[i].checked)
		{
			if(retornoFuncionalidades != '')
			{
				retornoFuncionalidades = retornoFuncionalidades+';';
			}
			if(retornoFuncionalidadesTxt != '')
			{
				retornoFuncionalidadesTxt = retornoFuncionalidadesTxt+'\n';
			}
			func = form.elements[i].value;
			func = func.split("&");
			retornoFuncionalidades = retornoFuncionalidades+func[0];
			retornoFuncionalidadesTxt = retornoFuncionalidadesTxt+func[1];
		}
	}
	self.parent.document.form1.idFuncionalidades.value = retornoFuncionalidades;
	self.parent.document.form1.funcionalidades_txt.value = retornoFuncionalidadesTxt;
	self.parent.tb_remove();
}
//-->
</script>

<h3>Funcionalidades Permitidas</h3>
<?php
if(!isset($_GET['cadastro']))
{	
?>
<form name="form1" id="form1">
<table width="95%" border="0" cellpadding="1" cellspacing="0" class="tabelaListagem" align="center">
	<tr>
		<td class="tituloListagem">Selecionar</td>
		<td class="tituloListagem">Funcionalidades</td>
		<td class="tituloListagem">Tipo da Funcionalidade</td>
		<td class="tituloListagem">Pertencente ao Menu</td>
	</tr>
	<?php
		$controlaFuncionalidades = new Controla_Funcionalidades();
		echo $controlaFuncionalidades->mostraSelecionarFuncionalidades();
	?>
	<tr align="center">
		<td colspan="2" class="formTdCentro">
			<input type="button" value="<?=$dominio->botaoConfirmar_TXT?>" id="<?=$dominio->botaoConfirmar?>" class="botao" onclick="addFuncionalidades();"/>
			&nbsp;
			<input type="button" value="<?=$dominio->botaoVoltar_TXT?>" id="<?=$dominio->botaoVoltar?>" class="botao" onClick="self.parent.tb_remove();"/>
		</td>
	</tr>
</table>
</form>
<?php
}
?>
<script>verificaFuncionalidadesJaSelecionadas();</script>