<?php
//####################################
// * Rafael Henrique Vieira de Moura /Desenvolvedor (Ábaco Tecnologia)
// * Arquivo: viewClientes.php
// * Criação: Rafael Henrique Vieira de Moura
// * Revisão:
// * Data de criação: 10/07/2008
//####################################

/**
 * Página de Manter Clientes
 */

require("config.php");

if(!isset($_SESSION["usuario_Logado"]))
{
	header("Location:index.php");
}

if (isset($_GET['cadastro']))
{
	$descricao = htmlentities("Cadastro de Cliente");
}
elseif (isset($_GET['pesquisa']))
{
	$descricao = htmlentities("Localizar Clientes");
}
else 
{
	$descricao = htmlentities("Clientes Cadastrados");
}
?>
<script type="text/javascript">
	function consultar(){
		var formulario = $('#formPesqClientes').serialize(true);
		$('#conteudo').block({message:'<h4>Aguarde...</h4><br/><img src="./imagens/loading.gif" border="0" />'});
		$.post('class/ControlaPostGet.php',formulario,function(retorno){
			$('#conteudo').unblock();
			$('#contentRetorno').empty().html(retorno);
			$('#contentRetorno').slideDown('slow');
		})
	}
	function cadastrar(){
		var formulario = $('#cadastraClientes').serialize(true);
		$('#conteudo').block({message:'<h4>Aguarde...</h4><br/><img src="./imagens/loading.gif" border="0" />'});
		$.post('class/ControlaPostGet.php',formulario,function(retorno){
			$('#conteudo').unblock();
			if(retorno == '1'){
				alert('Cadastrado com sucesso.');
				carregaPagina('viewClientes.php','formulario');
			} else {
				$('.informacao').empty().html(retorno);
				$('.informacao').slideDown('slow');
			}
		})
	}
</script>
<h3><?=$descricao?></h3>
<div id="barra">
	<a href="javascript:void(0)" title="Cadastrar Novo Cliente" onclick="carregaPagina('viewClientes.php?cadastro=true','formulario');"><img src="imagens/ico_novo.jpg" border="0"  />&nbsp;&nbsp;Novo Cliente&nbsp;&nbsp;|&nbsp;&nbsp;</a>
	<a href="javascript:void(0)" title="Localizar Clientes" onclick="carregaPagina('viewClientes.php','formulario');"><img src="imagens/ico_localizar.gif" border="0"  />&nbsp;&nbsp;Localizar Clientes&nbsp;&nbsp;|&nbsp;&nbsp;</a>
</div>
<br />
<div class="informacao" style="display:none"></div>
<?php
if (!isset($_GET['cadastro'])){
?>
<form method="post" id="formPesqClientes" action="#" onsubmit="return false">
	<table align="center">
		<tr>
			<td colspan="3" align="center"><strong>Pesquisa de Clientes</strong></td>
		</tr>
		<tr>
			<td class="formTdEsquerdo">Nome</td>
			<td><input type="text" size="30" name="nomeClientes" id="nomeClientes" class="campo" /></td>
		</tr>
		<tr>
			<td colspan="2" align="center">
				<input type="button" name="<?=$dominio->botaoConfirmar?>" value="<?=$dominio->botaoConfirmar_TXT?>" title="<?=$dominio->botaoConfirmar_msg?>" class="botao" onclick="consultar()" />&nbsp;
				<input type="reset" name="<?=$dominio->botaoLimpar?>" value="<?=$dominio->botaoLimpar_TXT?>" title="<?=$dominio->botaoLimpar_msg?>" class="botao" />
			</td>
		</tr>
	</table>
	<input type="hidden" name="pagina" value="pesquisaClientes" />
</form>
<br />
<div id="contentRetorno">
<?php
	$clientesVo = new ClientesVo();
	$controlaClientes = new Controla_Clientes();
	$controlaClientes->mostraListaClientes($clientesVo);
?>
</div>
<?php
} else {
	$clientesVo = new ClientesVo();
	
	if (isset($_GET['id'])) {
		$clientesVo->setIdClientes(strip_tags($_GET['id']));
		$controlaClientes = new Controla_Clientes();
		$collVo = $controlaClientes->pesquisarClientes($clientesVo);
		$clientesVo = (object) $collVo[0];
	}
?>
<form action="#" id="cadastraClientes" name="cadastraClientes" method="post" onsubmit="return false">
	<table align="center">
		<tr>
			<td class="formTdEsquerdo">Nome <span class="asterisco">*</span></td>
			<td><input type="text" size="30" name="nomeClientes" id="nomeClientes" class="campo" value="<?=$clientesVo->getNomeClientes()?>" /></td>
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
	<input type="hidden" name="idClientes" value="<?=$clientesVo->getIdClientes()?>" />
	<input type="hidden" name="pagina" value="cadastraClientes" />
	<input type="hidden" name="funcionalidade" value="<?=basename(__FILE__)?>" />
</form>
<?php
}
?>