<?php
//####################################
// * Jo�o Batista Padilha e Silva Analista/Desenvolvedor (�baco Tecnologia)
// * Arquivo: viewSelecionarModulos.php
// * Cria��o: Jo�o Batista Padilha e Silva
// * Revis�o:
// * Data de cria��o: 15/07/2008
//####################################

/**
 * P�gina de Sele��o de M�dulos
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
 * Fun��o que verifica os M�dulos j� selecionados
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
 * Fun��o que adiciona todas os m�dulos e atribui a uma vari�vel de retorno.
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

<h3>M�dulos para o Projeto</h3>
<?php
if(!isset($_GET['cadastro']))
{	
?>
<form name="form1" id="form1">
<table width="95%" border="0" cellpadding="1" cellspacing="0" class="tabelaListagem" align="center">
	<tr>
		<td class="tituloListagem">Selecionar</td>
		<td class="tituloListagem">M�dulo</td>
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