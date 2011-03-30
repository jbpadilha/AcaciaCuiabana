<?php
//####################################
// * Rafael Henrique Vieira de Moura / Desenvolvedor (Ábaco Tecnologia)
// * Arquivo: viewSelecionarClientes.php
// * Criação: Rafael Henrique Vieira de Moura
// * Revisão:
// * Data de criação: 11/07/2008
//####################################

/**
 * Página de Seleção de Clientes
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
<script type="text/javascript">
<!--
/**
 * Função que verifica os clientes já selecionados
 */
function verificaClientesJaSelecionados()
{
	clientes = self.parent.document.form1.idClientes.value;
	form = document.form1;
	if(clientes != '')
	{
		clientes = clientes.split(";");
		
		for(i = 0; i < clientes.length; i ++)
		{
			for(j=0 ; j<form.elements.length ; j++)
			{
				if(form.elements[j].id == clientes[i])
				{
					form.elements[j].checked = true;
				}
			}
		}
		
	}
}


/**
 * Função que adiciona todos os clientes e atribui a uma variável de retorno.
 */
function addClientes() {
	retornoClientes = '';
	retornoClientesTxt = '';
	form = document.form1;
	for(i=0;i<form.elements.length;i++)
	{
		if(form.elements[i].checked)
		{
			if(retornoClientes != '')
			{
				retornoClientes = retornoClientes + ';';
			}
			if(retornoClientesTxt != '')
			{
				retornoClientesTxt = retornoClientesTxt+'\n';
			}
			cli = form.elements[i].value;
			cli = cli.split("&");
			retornoClientes = retornoClientes + cli[0];
			retornoClientesTxt = retornoClientesTxt+cli[1];
		}
	}
	self.parent.document.form1.idClientes.value = retornoClientes;
	self.parent.document.form1.clientes_txt.value = retornoClientesTxt;
	self.parent.tb_remove();
}
//-->
</script>
<h3>Clientes</h3>
<form name="form1" id="form1">
<table width="95%" border="0" cellpadding="1" cellspacing="0" class="tabelaListagem" align="center">
	<tr>
		<td class="tituloListagem">Selecionar</td>
		<td class="tituloListagem">Clientes Cadastrados</td>
	</tr>
	<?php
		$controlaClientes = new Controla_Clientes();
		$clientesVo = new ClientesVo();
		$collVo = $controlaClientes->pesquisarClientes($clientesVo);
		for ($i = 0; $i < count($collVo); $i++)
		{
			$clientesVo = (object) $collVo[$i];
			echo '
			<tr>
				<td><input type="checkbox" name="'.$clientesVo->getIdClientes().'" id="'.$clientesVo->getIdClientes().'" value="'.$clientesVo->getIdClientes()."&".$clientesVo->getNomeClientes().'" /></td>
				<td>'.$clientesVo->getNomeClientes().'</td>
			</tr>
			';
		}
	?>
	<tr align="center">
		<td colspan="2" class="formTdCentro">
			<input type="button" value="<?=$dominio->botaoConfirmar_TXT?>" id="<?=$dominio->botaoConfirmar?>" class="botao" onclick="addClientes();"/>
			&nbsp;
			<input type="button" value="<?=$dominio->botaoVoltar_TXT?>" id="<?=$dominio->botaoVoltar?>" class="botao" onClick="self.parent.tb_remove();"/>
		</td>
	</tr>
</table>
</form>
<script type="text/javascript">
	verificaClientesJaSelecionados();
</script>