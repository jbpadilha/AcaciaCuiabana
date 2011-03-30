<?php
//####################################
// * Rafael Henrique Vieira de Moura / Desenvolvedor (Ábaco Tecnologia)
// * Arquivo: viewSubPedidos.php
// * Criação: Rafael Henrique Vieira de Moura
// * Revisão:
// * Data de criação: 23/07/2008
//####################################
/**
 * Página de SubPedidos
 * @author Rafael Henrique Vieira de Moura
 */

require("config.php");

if(!isset($_SESSION["usuario_Logado"]))
{
	header("Location:index.php");
}

$controlaPedidos = new Controla_Pedidos();
$pedidosVo = new PedidosVo();
$projetosVo = new ProjetosVo();
$permissaoVo = new Permissao_Usuarios_Funcionalidades_PapeisVo();
$controla_Permissao = new Controla_Permissao();
$permissaoVo->setIdUsuarios($_SESSION['id_Usuario']);

$pedidosVo->setIdPedidos(strip_tags(rawurldecode($_GET['idPedido'])));
$collVo_Pedidos = $controlaPedidos->pesquisarPedidos($pedidosVo);
$pedidosVo = (object) $collVo_Pedidos[0];

$controla_Historico = new Controla_Historico();
$historicoVo = new Historico_PedidosVo();
$historicoVo->setIdPedidos($pedidosVo->getIdPedidos());
$collVoHistorico = $controla_Historico->pesquisarHistorico($historicoVo);
$historicoVo = (object) $collVoHistorico[0];

/**
 * Pesquisa o Cliente
 */
$controlaProjetos = new Controla_Projetos();
$projetosVo = new ProjetosVo();
$collVo_Projetos = null;
$collVo_Projetos = $controlaProjetos->pesquisarProjetos($projetosVo);
$idCliente = '';
//Pesquisar o nome do Cliente para o Projeto, caso exista
if($pedidosVo->getIdProjetos() != '')
{
	if(!is_null($collVo_Projetos))
	{
		foreach ($collVo_Projetos as $projeto)
		{
			$projetosVo_Pesquisa = new ProjetosVo();
			$projetosVo_Pesquisa = (object) $projeto;
			
			if($projetosVo_Pesquisa->getIdProjetos() == $pedidosVo->getIdProjetos())
			{
				$idCliente = $projetosVo_Pesquisa->getIdClientes();
			}
		}
	}
}

/**
 * Projeto Selecionado
 */
$projetosVo = new ProjetosVo();
$projetosVo->setIdClientes($idCliente);
$projetosVo->setIdProjetos($pedidosVo->getIdProjetos());


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
<script type="text/javascript" src="js/jquery.livequery.js"></script>
<script type="text/javascript" src="js/ajaxfileupload.js"></script>
<script type="text/javascript">

$('#mostraCamposExtendidos').empty().html('<span style="color:#F00">carregando...</span>');
$('#mostraPapelOcupado').empty().html('<span style="color:#F00">carregando...</span>');
$('#mostraAssunto').empty().html('<span style="color:#F00">carregando...</span>');
$('#mostraAnexo').empty().html('<span style="color:#F00">carregando...</span>');
$('#mostraDescricao').empty().html('<span style="color:#F00">carregando...</span>');
$('#mostraSeveridade').empty().html('<span style="color:#F00">carregando...</span>');

$.post('class/ControlaPostGet.php',{idProjetos:'<?=$pedidosVo->getIdProjetos()?>',pagina:'carregarCamposPermissoes',idPedido:'<?=$pedidosVo->getIdPedidos()?>'},function(retorno){
	$('#mostraCamposExtendidos').empty().html(retorno);
});
$.post('class/ControlaPostGet.php',{pagina:'carregarSeveridadePedidos'},function(retorno){
	$('#mostraSeveridade').empty().html(retorno);
});
$.post('class/ControlaPostGet.php',{pagina:'carregarDescricaoPedidos'},function(retorno){
	$('#mostraDescricao').empty().html(retorno);
});
$('#mostraTituloPapelOcupado').empty().html('Papeis Ocupados no Projeto:');
$.post('class/ControlaPostGet.php',{idProjetos:'<?=$pedidosVo->getIdProjetos()?>',pagina:'carregarPapelOcupadoPedidos'},function(retorno){
	$('#mostraPapelOcupado').empty().html(retorno);
});
$.post('class/ControlaPostGet.php',{pagina:'carregarAssunto',assunto:'<?=$pedidosVo->getAssuntoPedido()?>'},function(retorno){
	$('#mostraAssunto').empty().html(retorno);
});
$.post('class/ControlaPostGet.php',{pagina:'carregarCampoAnexo'},function(retorno){
	$('#mostraAnexo').empty().html(retorno);
});


function consultarProjetos(campo)
{
	if(campo.value != ''){
		$('#mostraProjetos').empty().html('<span style="color:#F00">carregando...</span>');
		$.post('class/ControlaPostGet.php',{idClientes:campo.value,pagina:'carregarProjetosPedidos'},function(retorno){
			$('#mostraProjetos').empty().html(retorno);
		})
		$('#mostraTituloPapelOcupado').empty();
		$('#mostraPapelOcupado').empty();
		$('#mostraDescricao').empty();
		$('#mostraCamposExtendidos').empty();
		$('#mostraSeveridade').empty();
		$('#mostraAssunto').empty();
		$('#mostraAnexo').empty();
	}
	else
	{
		$('#mostraProjetos').empty();
		$('#mostraTituloPapelOcupado').empty();
		$('#mostraPapelOcupado').empty();
		$('#mostraDescricao').empty();
		$('#mostraCamposExtendidos').empty();
		$('#mostraSeveridade').empty();
		$('#mostraAssunto').empty();
		$('#mostraAnexo').empty();
	}
}
function consultarModulosPapeisUsuarios(campo)
{
	if(campo.value != '')
	{
		$('#mostraSeveridade').empty().html('<span style="color:#F00">carregando...</span>');
		$('#mostraTituloPapelOcupado').empty().html('<span style="color:#F00">carregando...</span>');
		$('#mostraPapelOcupado').empty().html('<span style="color:#F00">carregando...</span>');
		$('#mostraAssunto').empty().html('<span style="color:#F00">carregando...</span>');
		$('#mostraAnexo').empty().html('<span style="color:#F00">carregando...</span>');
		$('#mostraDescricao').empty().html('<span style="color:#F00">carregando...</span>');
		
		$('#mostraCamposExtendidos').empty().html('<span style="color:#F00">carregando...</span>');
		
		$.post('class/ControlaPostGet.php',{pagina:'carregarSeveridadePedidos'},function(retorno){
			$('#mostraSeveridade').empty().html(retorno);
		});
		$.post('class/ControlaPostGet.php',{pagina:'carregarDescricaoPedidos'},function(retorno){
			$('#mostraDescricao').empty().html(retorno);
		});
		$('#mostraTituloPapelOcupado').empty().html('Papeis Ocupados no Projeto:');
		$.post('class/ControlaPostGet.php',{idProjetos:campo.value,pagina:'carregarPapelOcupadoPedidos'},function(retorno){
			$('#mostraPapelOcupado').empty().html(retorno);
		});
		
		$.post('class/ControlaPostGet.php',{idProjetos:campo.value,pagina:'carregarCamposPermissoes',idPedido:'<?=$pedidosVo->getIdPedidos()?>'},function(retorno){
			$('#mostraCamposExtendidos').empty().html(retorno);
		});
		$.post('class/ControlaPostGet.php',{pagina:'carregarAssunto'},function(retorno){
			$('#mostraAssunto').empty().html(retorno);
		});
		$.post('class/ControlaPostGet.php',{pagina:'carregarCampoAnexo'},function(retorno){
			$('#mostraAnexo').empty().html(retorno);
		});
	}
	else
	{
		
		$('#mostraTituloPapelOcupado').empty();
		$('#mostraPapelOcupado').empty();
		$('#mostraSeveridade').empty();
		$('#mostraDescricao').empty();
		$('#mostraCamposExtendidos').empty();
		$('#mostraAssunto').empty();
		$('#mostraAnexo').empty();
	}
}

function consultarModulosPapeisUsuarios(campo)
{
	if(campo.value != '')
	{
		$('#mostraSeveridade').empty().html('<span style="color:#F00">carregando...</span>');
		$('#mostraTituloPapelOcupado').empty().html('<span style="color:#F00">carregando...</span>');
		$('#mostraPapelOcupado').empty().html('<span style="color:#F00">carregando...</span>');
		$('#mostraAssunto').empty().html('<span style="color:#F00">carregando...</span>');
		$('#mostraAnexo').empty().html('<span style="color:#F00">carregando...</span>');
		
		$('#mostraCamposExtendidos').empty().html('<span style="color:#F00">carregando...</span>');
		
		$.post('class/ControlaPostGet.php',{pagina:'carregarSeveridadePedidos'},function(retorno){
			$('#mostraSeveridade').empty().html(retorno);
		});
		$.post('class/ControlaPostGet.php',{pagina:'carregarDescricaoPedidos'},function(retorno){
			$('#mostraDescricao').empty().html(retorno);
		});
		$('#mostraTituloPapelOcupado').empty().html('Papeis Ocupados no Projeto:');
		$.post('class/ControlaPostGet.php',{idProjetos:campo.value,pagina:'carregarPapelOcupadoPedidos'},function(retorno){
			$('#mostraPapelOcupado').empty().html(retorno);
		});
		
		$.post('class/ControlaPostGet.php',{idProjetos:campo.value,pagina:'carregarCamposPermissoes'},function(retorno){
			$('#mostraCamposExtendidos').empty().html(retorno);
		});
		$.post('class/ControlaPostGet.php',{pagina:'carregarAssunto'},function(retorno){
			$('#mostraAssunto').empty().html(retorno);
		});
		$.post('class/ControlaPostGet.php',{pagina:'carregarCampoAnexo'},function(retorno){
			$('#mostraAnexo').empty().html(retorno);
		});
	}
	else
	{
		
		$('#mostraTituloPapelOcupado').empty();
		$('#mostraPapelOcupado').empty();
		$('#mostraSeveridade').empty();
		$('#mostraDescricao').empty();
		$('#mostraCamposExtendidos').empty();
		$('#mostraAssunto').empty();
		$('#mostraAnexo').empty();
	}
}
function consultarSubModulos(campo)
{
	if(campo.value != ''){
		$('#mostraSubModulos').empty().html('<span style="color:#F00">carregando...</span>');
		$.post('class/ControlaPostGet.php',{idModulo:campo.value,pagina:'carregarSubModulosPedidos'},function(retorno){
			$('#mostraSubModulos').empty().html(retorno);
		})
	}
	else
	{
		$('#mostraSubModulos').empty();
	}
}
function consultarAtividades(campo)
{
	if(campo.value != ''){
		$('#mostraAtividades').empty().html('<span style="color:#F00">carregando...</span>');
		$.post('class/ControlaPostGet.php',{idTecnologia:campo.value,pagina:'carregarAtividadesPedidos'},function(retorno){
			$('#mostraAtividades').empty().html(retorno);
		})
	}
	else
	{
		$('#mostraAtividades').empty();
		$('#mostraPrevisaoEntrega').empty();
	}
}

function consultarPrevisaoEntrega(campo)
{
	if(campo.value != ''){
		$('#mostraPrevisaoEntrega').empty().html('<span style="color:#F00">carregando...</span>');
		$.post('class/ControlaPostGet.php',{idAtividades:campo.value,pagina:'carregarPrevisaoEntregaPedidos'},function(retorno){
			$('#mostraPrevisaoEntrega').empty().html(retorno);
		})
	}
	else
	{
		$('#mostraPrevisaoEntrega').empty();
	}
}

function consultarUsuarios(campo)
{
	if(campo.value != ''){
		$('#mostraUsuarios').empty().html('<span style="color:#F00">carregando...</span>');
		$.post('class/ControlaPostGet.php',{idProjetos:document.form1.selectProjetos.value,idPapeis:campo.value,pagina:'carregarUsuariosPedidos'},function(retorno){
			$('#mostraUsuarios').empty().html(retorno);
		})
	}
	else
	{
		$('#mostraUsuarios').empty().html('<span style="color:#F00">carregando...</span>');
		$.post('class/ControlaPostGet.php',{idProjetos:document.form1.selectProjetos.value,idPapeis:'',pagina:'carregarUsuariosPedidos'},function(retorno){
			$('#mostraUsuarios').empty().html(retorno);
		})
	}
}

function consultarPedidos()
{
	var formulario = $('#formPesquisa').serialize(true);
		$('#conteudo').block({message:'<h4>Aguarde...</h4><br/><img src="./imagens/loading.gif" border="0" />'});
		$.post('class/ControlaPostGet.php',formulario,function(retorno){
			$('#conteudo').unblock();
			$('#contentRetorno').empty().html(retorno);
			$('#contentRetorno').slideDown('slow');
		})
}



function cadastrarPedido()
{
	var formulario = $('#form1').serialize(true);
	var anexoPreenchido = '';
	if(document.form1.arquivoAnexo)
	{
		anexoPreenchido = document.form1.arquivoAnexo.value;
	}
	$('#conteudo').block({message:'<h4>Aguarde...</h4><br/><img src="./imagens/loading.gif" border="0" />'});
	$.post('class/ControlaPostGet.php',formulario,function(retorno){
		if(retorno == "Sucesso")
		{
			if(anexoPreenchido != '')
			{
				retornoAnexo = ajaxFileUpload();
				if(retornoAnexo === true)
				{
					retorno = "Pedido aberto com sucesso. Aguarde o tempo de recebimento do pedido.";
					alert(retorno);
					self.parent.tb_remove();
					self.parent.carregaPagina('viewPedidos.php?pesquisa=true','formulario');
				}
				else
				{
					retorno = "Erro ao anexar arquivo.";
					$('#informacao').empty().html(retorno);
					$('#informacao').slideDown('slow');
				}
			}
			else
			{
				retorno = "Pedido aberto com sucesso. Aguarde o tempo de recebimento do pedido.";
				alert(retorno);
				self.parent.tb_remove();
				self.parent.carregaPagina('viewPedidos.php?pesquisa=true','formulario');
			}
		}
		else
		{
			$('#informacao').empty().html(retorno);
			$('#informacao').slideDown('slow');
		}
		$('#conteudo').unblock();
		
	})
}

function ajaxFileUpload()
{
	if($.ajaxFileUpload
	(
		{
			url:'class/ControlaPostGet.php?pagina=cadastraAnexoPedido',
			secureuri:false,
			fileElementId:'arquivoAnexo',
			dataType: 'json',
			success: function (data, status)
			{
				if(data.error != '')
				{
					$('#informacao').empty().html(data.error);
					$('.informacao').slideDown('slow');
					retornoValida = false;
					return false;
				}
				else
				{
					$('#informacao').empty();
					return true;
				}
				
			},
			error: function (data, status, e)
			{
				$('#informacao').empty().html(e);
				$('.informacao').slideDown('slow');
				return false;
			}
		}
	))
	{
		return true;
	}
	else
	{
		return false;
	}
}


</script>
<h3>Novo SubPedido</h3>
<br />
<div id="informacao" class="informacao" style="display:none"></div>
<form action="" method="POST" id="form1" name="form1">
	<table width="95%" border="0" cellpadding="2" cellspacing="3" class="tabelaListagem" align="center">
	<tr>
	<td>
		<table width="100%" border="0" cellpadding="2" cellspacing="3" align="center" >
		<tr>
			<td width="25%" valign="top" class="formTdEsquerdo">Cliente:</td>
			<td width="27%" valign="top"><?=$controlaPedidos->montaSelectClientes($pedidosVo,'consultarProjetos(this)')?></td>
			<td width="22%" valign="top">&nbsp;</td>
			<td width="26%" valign="top">&nbsp;</td>
		</tr>
		<tr>
			<td valign="top" class="formTdEsquerdo">Projeto/Sistema:</td>
			<td valign="top" id="mostraProjetos"><?=$controlaPedidos->montaSelectProjetos($projetosVo,'consultarModulosPapeisUsuarios(this)')?></td>
			<td valign="top">&nbsp;</td>
			<td valign="top">&nbsp;</td>
		</tr>
		<tr>
			<td valign="top" class="formTdEsquerdo" id="mostraTituloPapelOcupado" colspan="2">&nbsp;</td>
			<td valign="top" id="mostraPapelOcupado" colspan="2" class="linhaListagem">&nbsp;</td>
		</tr>
		</table>
		<div id="mostraCamposExtendidos">
		</div>
		<table width="100%" border="0" align="center" cellpadding="2" cellspacing="3">
			<tr>
				<td width="21%" valign="top" class="formTdEsquerdo">Assunto:</td>
				<td width="56%" valign="top" id="mostraAssunto">&nbsp;</td>
				<td width="13%" valign="top" class="formTdEsquerdo">&nbsp;</td>
				<td width="10%" valign="top">&nbsp;</td>
			</tr>
			<tr>
				<td width="24%" height="23" valign="top" class="formTdEsquerdo">Severidade:</td>
				<td width="35%" valign="top" id="mostraSeveridade">&nbsp;</td>
				<td width="20%" valign="top" class="formTdEsquerdo">&nbsp;</td>
				<td width="21%" valign="top">&nbsp;</td>
			</tr>
			<tr>
			  <td valign="top" class="formTdEsquerdo">Anexo:</td>
			  <td colspan="3" valign="top" id="mostraAnexo">&nbsp;</td>
			</tr>
			<tr>
				<td colspan="4" valign="top">&nbsp;</td>
			</tr>
			<tr>
				<td width="24%" valign="top" class="formTdEsquerdo">Descri&ccedil;&atilde;o do Pedido: </td>
				<td colspan="3" valign="top" id="mostraDescricao">&nbsp;</td>
			</tr>
			<tr>
				<td colspan="4">
					<div align="center">
						<input type="button" value="<?=$dominio->botaoConfirmar_TXT?>" id="<?=$dominio->botaoConfirmar?>" class="botao" onclick="cadastrarPedido()"/>
						&nbsp;&nbsp;&nbsp;
						<input type="button" value="<?=$dominio->botaoVoltar_TXT?>" id="<?=$dominio->botaoVoltar?>" class="botao" onClick="self.parent.tb_remove();"/>
					</div>
				</td>
			</tr>
	  </table>
	</td>
	</tr>
	<input type="hidden" name="pagina" id="pagina" value="cadastrarPedidos"/>
	<input type="hidden" name="idPrecedente" id="idPrecedente" value="<?=$pedidosVo->getIdPedidos()?>"/>
	<input type="hidden" name="funcionalidade" value="<?=basename(__FILE__)?>" />
</form>
