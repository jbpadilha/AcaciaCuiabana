<?php
//####################################
// * João Batista Padilha e Silva Analista/Desenvolvedor (Ábaco Tecnologia)
// * Arquivo: viewSelecionarModulos.php
// * Criação: João Batista Padilha e Silva
// * Revisão:
// * Data de criação: 15/07/2008
//####################################

/**
 * Página de Seleção de Módulos
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
 * Função que verifica os Módulos já selecionados
 */
function verificaJaSelecionadas()
{
	modulos = self.parent.document.form1.idModulos.value;
	form = document.form1;
	if(modulos != '')
	{
		modulos = modulos.split(";");
		
		for(i = 0; i < modulos.length; i ++)
		{
			for(j=0 ; j<form.elements.length ; j++)
			{
				if(form.elements[j].id == modulos[i])
				{
					form.elements[j].checked = true;
				}
			}
		}
		
	}
}


/**
 * Função que adiciona todas os módulos e atribui a uma variável de retorno.
 */
function addModulos() {
	retornoModulos = '';
	retornoModulosTxt = '';
	form = document.form1;
	for(i=0;i<form.elements.length;i++)
	{
		if(form.elements[i].checked)
		{
			if(retornoModulos != '')
			{
				retornoModulos = retornoModulos+';';
			}
			if(retornoModulosTxt != '')
			{
				retornoModulosTxt = retornoModulosTxt+'\n';
			}
			func = form.elements[i].value;
			func = func.split("&");
			retornoModulos = retornoModulos+func[0];
			retornoModulosTxt = retornoModulosTxt+func[1];
		}
	}
	self.parent.document.form1.idModulos.value = retornoModulos;
	self.parent.document.form1.modulosTXT.value = retornoModulosTxt;
	self.parent.tb_remove();
}
//-->
</script>

<h3>Módulos para o Projeto</h3>
<?php
if(!isset($_GET['cadastro']))
{	
?>
<form name="form1" id="form1">
<table width="95%" border="0" cellpadding="1" cellspacing="0" class="tabelaListagem" align="center">
	<tr>
		<td class="tituloListagem">Selecionar</td>
		<td class="tituloListagem">Módulo</td>
	</tr>
	<?php
		$controlaModulos = new Controla_Modulos();
		echo $controlaModulos->mostraSelecionarModulos();
	?>
	<tr align="center">
		<td colspan="2" class="formTdCentro">
			<input type="button" value="<?=$dominio->botaoConfirmar_TXT?>" id="<?=$dominio->botaoConfirmar?>" class="botao" onclick="addModulos();"/>
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