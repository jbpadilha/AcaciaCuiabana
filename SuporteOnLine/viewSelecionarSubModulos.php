<?php
//####################################
// * Jo�o Batista Padilha e Silva Analista/Desenvolvedor (�baco Tecnologia)
// * Arquivo: viewSelecionarSubModulos.php
// * Cria��o: Jo�o Batista Padilha e Silva
// * Revis�o:
// * Data de cria��o: 10/07/2008
//####################################

/**
 * P�gina de Selecionar Sub-M�dulos
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
 * Fun��o que verifica os Sub-M�dulos j� selecionados
 */
function verificaSubModulosJaSelecionados()
{
	subModulos = self.parent.document.form1.idSubModulos.value;
	form = document.form1;
	if(subModulos != '')
	{
		subModulos = subModulos.split(";");
		
		for(i = 0; i < subModulos.length; i ++)
		{
			for(j=0 ; j<form.elements.length ; j++)
			{
				if(form.elements[j].id == subModulos[i])
				{
					form.elements[j].checked = true;
				}
			}
		}
		
	}
}


/**
 * Fun��o que adiciona todas os Sub-M�dulos e atribui a uma vari�vel de retorno.
 */
function addSubModulos() {
	retornoSubModulos = '';
	retornoSubModulosTXT = '';
	form = document.form1;
	for(i=0;i<form.elements.length;i++)
	{
		if(form.elements[i].checked)
		{
			if(retornoSubModulos != '')
			{
				retornoSubModulos = retornoSubModulos+';';
			}
			if(retornoSubModulosTXT != '')
			{
				retornoSubModulosTXT = retornoSubModulosTXT+'\n';
			}
			func = form.elements[i].value;
			func = func.split("&");
			retornoSubModulos = retornoSubModulos+func[0];
			retornoSubModulosTXT = retornoSubModulosTXT+func[1];
		}
	}
	self.parent.document.form1.idSubModulos.value = retornoSubModulos;
	self.parent.document.form1.subModulos_txt.value = retornoSubModulosTXT;
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
		<td class="tituloListagem">Sub-M�dulos</td>
	</tr>
	<?php
		$controla_SubModulos = new Controla_SubModulos();
		echo $controla_SubModulos->mostraSelecionarSubModulos();
	?>
	<tr align="center">
		<td colspan="2" class="formTdCentro">
			<input type="button" value="<?=$dominio->botaoConfirmar_TXT?>" id="<?=$dominio->botaoConfirmar?>" class="botao" onclick="addSubModulos();"/>
			&nbsp;
			<input type="button" value="<?=$dominio->botaoVoltar_TXT?>" id="<?=$dominio->botaoVoltar?>" class="botao" onClick="self.parent.tb_remove();"/>
		</td>
	</tr>
</table>
</form>
<?php
}
?>
<script>verificaSubModulosJaSelecionados();</script>