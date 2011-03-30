<?php
//####################################
// * João Batista Padilha e Silva Analista/Desenvolvedor (Ábaco Tecnologia)
// * Arquivo: viewModulos.php
// * Criação: João Batista Padilha e Silva
// * Revisão:
// * Data de criação: 10/07/2008
//####################################
/**
 * Página de Pedidos
 * @author João Batista Padilha e Silva
 */

require("config.php");

if(!isset($_SESSION["usuario_Logado"]))
{
	header("Location:index.php");
}
?>

<script type="text/javascript">
/**
 *	Função que envia o formulário via Ajax. Basta passar o nome do formulario em "var formulario = $('#form1').serialize();"
 *  e indicar o retorno, como sera visto, em uma div ou dar um alert.
 * @author Rafael Moura
 */
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
					carregaPagina('viewPedidos.php?pesquisa=true','formulario');
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
				carregaPagina('viewPedidos.php?pesquisa=true','formulario');
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

function alterarStatusPedido(idPedido,idStatusAtual,mensagem)
{
	document.formAlteraStatus.idPedido.value = idPedido;
	document.formAlteraStatus.statusAtual.value = idStatusAtual;
	var anexoPreenchido = '';
	if(document.formAlteraStatus.arquivoAnexo)
	{
		anexoPreenchido = document.formAlteraStatus.arquivoAnexo.value;
	}
	var formulario = $('#formAlteraStatus').serialize(true);
	$('#conteudo').block({message:'<h4>Aguarde...</h4><br/><img src="./imagens/loading.gif" border="0" />'});
	$.post('class/ControlaPostGet.php',formulario,function(retorno){
		if(retorno == "Sucesso")
		{
			if(anexoPreenchido != '')
			{
				retornoAnexo = ajaxFileUpload();
				if(retornoAnexo === true)
				{
					retorno = mensagem;
					alert(retorno);
					carregaPagina('viewPedidos.php?visualiza=true&idPedidos='+idPedido,'formulario');
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
				retorno = mensagem;
				alert(retorno);
				carregaPagina('viewPedidos.php?visualiza=true&idPedidos='+idPedido,'formulario');
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

function alterarMotivoStatusPedido(idPedido)
{
	document.formComplementarStatus.idPedido.value = idPedido;
	var formulario = $('#formComplementarStatus').serialize(true);
	$('#conteudo').block({message:'<h4>Aguarde...</h4><br/><img src="./imagens/loading.gif" border="0" />'});
	$.post('class/ControlaPostGet.php',formulario,function(retorno){
		if(retorno == "Sucesso")
		{
			retorno = document.formComplementarStatus.mensagemBotao.value;
			alert(retorno);
			carregaPagina('viewPedidos.php?visualiza=true&idPedidos='+idPedido,'formulario');
		}
		else
		{
			$('#informacao').empty().html(retorno);
			$('#informacao').slideDown('slow');
		}
		$('#conteudo').unblock();
		
	})
}

function complementarPedido()
{
	$('#tabelaMotivo').slideUp('slow');
	$('#mostraDescricao1').empty();
	
	$('#tabelaComplemento').slideDown('slow');
	$('#mostraAnexo').empty().html('<span style="color:#F00">carregando...</span>');
	$('#mostraDescricao').empty().html('<span style="color:#F00">carregando...</span>');
	$.post('class/ControlaPostGet.php',{pagina:'carregarCampoAnexo'},function(retorno){
			$('#mostraAnexo').empty().html(retorno);
		});
	$.post('class/ControlaPostGet.php',{pagina:'carregarDescricaoPedidos'},function(retorno){
			$('#mostraDescricao').empty().html(retorno);
		});

}
function devolverConcluirFecharReenviarPedido(idPedido,idStatusAtual,mensagem,textoCampo)
{
	$('#tabelaComplemento').slideUp('slow');
	$('#mostraDescricao').empty();
	$('#mostraAnexo').empty();
	
	$('#tabelaMotivo').slideDown('slow');
	$('#mostraDescricao1').empty().html('<span style="color:#F00">carregando...</span>');
	$.post('class/ControlaPostGet.php',{pagina:'carregarDescricaoPedidos'},function(retorno){
			$('#mostraDescricao1').empty().html(retorno);
		});
	$('#mostraTextoCampo').empty().html(textoCampo);
	document.formComplementarStatus.mensagemBotao.value = mensagem;
	document.formComplementarStatus.statusAtual.value = idStatusAtual;
}

function consultarProjetos(cliente)
{
	if(cliente.value != ''){
		$('#mostraProjetos').empty().html('<span style="color:#F00">carregando...</span>');
		$.post('class/ControlaPostGet.php',{idClientes:cliente.value,pagina:'carregarProjetosPedidos'},function(retorno){
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
function consultarModulosPapeisUsuarios(projeto)
{
	if(projeto.value != '')
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
		$.post('class/ControlaPostGet.php',{idProjetos:projeto.value,pagina:'carregarPapelOcupadoPedidos'},function(retorno){
			$('#mostraPapelOcupado').empty().html(retorno);
		});
		
		$.post('class/ControlaPostGet.php',{idProjetos:projeto.value,pagina:'carregarCamposPermissoes'},function(retorno){
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
function consultarSubModulos(modulo)
{
	if(modulo.value != ''){
		$('#mostraSubModulos').empty().html('<span style="color:#F00">carregando...</span>');
		$.post('class/ControlaPostGet.php',{idModulo:modulo.value,pagina:'carregarSubModulosPedidos'},function(retorno){
			$('#mostraSubModulos').empty().html(retorno);
		})
	}
	else
	{
		$('#mostraSubModulos').empty();
	}
}
function consultarAtividades(tecnologia)
{
	if(tecnologia.value != ''){
		$('#mostraAtividades').empty().html('<span style="color:#F00">carregando...</span>');
		$.post('class/ControlaPostGet.php',{idTecnologia:tecnologia.value,pagina:'carregarAtividadesPedidos'},function(retorno){
			$('#mostraAtividades').empty().html(retorno);
		})
	}
	else
	{
		$('#mostraAtividades').empty();
		$('#mostraPrevisaoEntrega').empty();
	}
}

function consultarPrevisaoEntrega(atividades)
{
	if(atividades.value != ''){
		$('#mostraPrevisaoEntrega').empty().html('<span style="color:#F00">carregando...</span>');
		$.post('class/ControlaPostGet.php',{idAtividades:atividades.value,pagina:'carregarPrevisaoEntregaPedidos'},function(retorno){
			$('#mostraPrevisaoEntrega').empty().html(retorno);
		})
	}
}

function consultarUsuarios(papel)
{
	if(papel.value != ''){
		$('#mostraUsuarios').empty().html('<span style="color:#F00">carregando...</span>');
		$.post('class/ControlaPostGet.php',{idProjetos:document.form1.selectProjetos.value,idPapeis:papel.value,pagina:'carregarUsuariosPedidos'},function(retorno){
			$('#mostraUsuarios').empty().html(retorno);
		})
	}
	else
	{
		$('#mostraUsuarios').empty();
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

</script>
<?php
	$controlaPedidos = new Controla_Pedidos();
	$pedidosVo = new PedidosVo();
	$permissaoVo = new Permissao_Usuarios_Funcionalidades_PapeisVo();
	$controla_Permissao = new Controla_Permissao();
	$permissaoVo->setIdUsuarios($_SESSION['id_Usuario']);
	
if (!isset($_GET['cadastro']) && isset($_GET['pesquisa']))
{
	?>
	<h3>Pesquisar Pedido</h3>
	<?php
}
elseif (!isset($_GET['pesquisa']))
{
?>
<h3>Novo Pedido</h3>
<?php
}
?>
<div id="barra">
	<a href="javascript:void(0);" title="Novo Pedido" onclick="carregaPagina('viewPedidos.php?cadastro=true','formulario');"><img src="imagens/ico_novo.jpg" border="0"  />&nbsp;&nbsp;Novo Pedido&nbsp;&nbsp;|&nbsp;&nbsp;</a>
	<a href="javascript:void(0);" title="Localizar Pedidos" onclick="carregaPagina('viewPedidos.php?pesquisa=true','formulario');"><img src="imagens/ico_localizar.gif" border="0"  />&nbsp;&nbsp;Localizar Pedido&nbsp;&nbsp;|&nbsp;&nbsp;</a>
</div>
<br />
<div id="informacao" class="informacao" style="display:none"></div>
<?php
if (!isset($_GET['cadastro']) && isset($_GET['pesquisa']))
{
	$cellSpacing = (stristr($_SERVER['HTTP_USER_AGENT'],"msie")) ? "1" : "0";
?>
<form method="post" id="formPesquisa" action="#" onsubmit="return false">
	<table align="center">
		<tr>
			<td class="formTdEsquerdo"><b>Nº do Pedido:</b></td>
			<td><input type="text" size="30" name="numeroPedido" id="numeroPedido" class="campo" /></td>
		</tr>
		<tr>
			<td class="formTdEsquerdo"><b>Cliente:</b></td>
			<td><?=$controlaPedidos->montaSelectClientes($pedidosVo,'consultarProjetos(this)')?></td>
		</tr>
		<tr>
			<td class="formTdEsquerdo"><b>Projeto/Sistema:</b></td>
			<td id="mostraProjetos"></td>
		</tr>
		<tr>
			<td class="formTdEsquerdo">&nbsp;</td>
			<td>&nbsp;</td>
		</tr>
		<tr>
			<td colspan="2" align="center">
				<input type="button" name="<?=$dominio->botaoConfirmar?>" value="<?=$dominio->botaoConfirmar_TXT?>" title="<?=$dominio->botaoConfirmar_msg?>" class="botao" onclick="consultarPedidos()" />&nbsp;
				<input type="reset" name="<?=$dominio->botaoLimpar?>" value="<?=$dominio->botaoLimpar_TXT?>" title="<?=$dominio->botaoLimpar_msg?>" class="botao" />
			</td>
		</tr>
	</table>
	<input type="hidden" name="pagina" value="pesquisaPedido" />
</form>
<div id="contentRetorno">
<table width="95%" border="0" cellpadding="1" cellspacing="<?=$cellSpacing?>" class="tabelaListagemReceber" align="center">
	<tr>
		<td class="tituloListagemReceber" colspan="2">Meus Pedidos à receber / recebidos</td>
	</tr>
	<?php
	$status = $dominio->DomnStatusPedido_Novo.";".$dominio->DomnStatusPedido_Recebido;	
	$controlaPedidos->mostraPedidosStatus($pedidosVo,$status,'Receber');
	?>
	<tr>
		<td class="tituloListagemReceber" colspan="2">&nbsp;</td>
	</tr>
</table>
<br>
<table width="95%" border="0" cellpadding="1" cellspacing="<?=$cellSpacing?>" class="tabelaListagemAtendimento" align="center">
	<tr>
		<td class="tituloListagemAtendimento" colspan="2">Pedidos que estou atendendo</td>
	</tr>
	<?php
		$controlaPedidos->mostraPedidosStatus($pedidosVo,$dominio->DomnStatusPedido_Desenvolvimento,'Atendimento');
	?>
</table>
<br>
<table width="95%" border="0" cellpadding="1" cellspacing="<?=$cellSpacing?>" class="tabelaListagemFechadosDevolvidos" align="center">
	<tr>
		<td class="tituloListagemFechadosDevolvidos" colspan="2">Meus Pedidos Fechados / Devolvidos</td>
	</tr>
	<?php
		$status = $dominio->DomnStatusPedido_Fechado.";".$dominio->DomnStatusPedido_Devolvido;	
		$controlaPedidos->mostraPedidosStatus($pedidosVo,$status,'FechadosDevolvidos');
	?>
</table>
<br>
<table width="95%" border="0" cellpadding="1" cellspacing="<?=$cellSpacing?>" class="tabelaListagemPedidosProjeto" align="center">
	<tr>
		<td class="tituloListagemPedidosProjeto" colspan="2">Pedidos do Projeto</td>
	</tr>
	<table width="95%" border="0" cellpadding="1" cellspacing="0" class="tabelaListagemPedidosProjeto" align="center">
	<tr>
		<td class="tituloListagemPedidosProjeto">Nº do Pedido</td>
		<td class="tituloListagemPedidosProjeto">Data de Abertura</td>
		<td class="tituloListagemPedidosProjeto">Projeto/Sistema</td>
		<td class="tituloListagemPedidosProjeto">Situação</td>
		<td class="tituloListagemPedidosProjeto" colspan="2">Severidade</td>
	</tr>
	<?php
		$status = $dominio->DomnStatusPedido_Novo.";".$dominio->DomnStatusPedido_Recebido.";".$dominio->DomnStatusPedido_Desenvolvimento.";".$dominio->DomnStatusPedido_Fechado;
		$retornoPedidos = $controlaPedidos->mostraPedidosProjetos($pedidosVo,$status,'PedidosProjeto');
		echo $retornoPedidos;
	?>
	</table>
</table>
</div>
<?php
} 
elseif (isset($_GET['cadastro']) && !isset($_GET['pesquisa'])) 
{
?>
<form action="" method="POST" enctype="multipart/form-data" name="form1" id="form1">
	<table width="95%" border="0" cellpadding="2" cellspacing="3" class="tabelaListagem" align="center">
	<tr>
	<td>
		<table width="100%" border="0" cellpadding="2" cellspacing="3" align="center">
		<tr>
			<td width="21%" valign="top" class="formTdEsquerdo"><b>Cliente:</b></td>
			<td width="31%" valign="top"><?=$controlaPedidos->montaSelectClientes($pedidosVo,'consultarProjetos(this)')?></td>
			<td width="22%" valign="top">&nbsp;</td>
			<td width="26%" valign="top">&nbsp;</td>
		</tr>
		<tr>
			<td valign="top" class="formTdEsquerdo"><b>Projeto/Sistema:</b></td>
			<td valign="top" id="mostraProjetos">&nbsp;</td>
			<td valign="top">&nbsp;</td>
			<td valign="top">&nbsp;</td>
		</tr>
		<tr>
			<td valign="top" class="formTdEsquerdo" id="mostraTituloPapelOcupado" colspan="2">&nbsp;</td>
			<td valign="top" id="mostraPapelOcupado" colspan="2">&nbsp;</td>
		</tr>
		</table>
		<div id="mostraCamposExtendidos">
		</div>
		<table width="100%" border="0" align="center" cellpadding="2" cellspacing="3">
			<tr>
				<td width="21%" valign="top" class="formTdEsquerdo"><b>Assunto:</b></td>
				<td width="56%" valign="top" id="mostraAssunto" colspan="3">&nbsp;</td>
			</tr>
			<tr>
				<td width="21%" valign="top" class="formTdEsquerdo"><b>Severidade:</b></td>
				<td width="56%" valign="top" id="mostraSeveridade">&nbsp;</td>
				<td width="13%" valign="top" class="formTdEsquerdo">&nbsp;</td>
				<td width="10%" valign="top">&nbsp;</td>
			</tr>
		</table>
		<table width="100%" border="0" align="center" cellpadding="2" cellspacing="3">
		<tr>
			<td colspan="4" valign="top">&nbsp;</td>
		</tr>
		<tr>
		  <td valign="top" class="formTdEsquerdo"><b>Anexo:</b></td>
		  <td colspan="3" valign="top" id="mostraAnexo">&nbsp;</td>
		</tr>
		<tr>
			<td width="21%" valign="top" class="formTdEsquerdo"><b>Descri&ccedil;&atilde;o do Pedido:</b></td>
			<td width="79%" colspan="3" valign="top" id="mostraDescricao">&nbsp;</td>
		</tr>
		<tr>
			<td colspan="4">
				<div align="center">
					<input type="button" value="<?=$dominio->botaoConfirmar_TXT?>" id="<?=$dominio->botaoConfirmar?>" class="botao" onclick="cadastrarPedido();"/>
					&nbsp;&nbsp;&nbsp;
					<input type="button" value="<?=$dominio->botaoVoltar_TXT?>" id="<?=$dominio->botaoVoltar?>" class="botao" onClick="carregaPagina('viewPedidos.php','formulario');"/>
				</div>
			</td>
		</tr>
  </table>
	</td>
	</tr>
	<input type="hidden" name="pagina" id="pagina" value="cadastrarPedidos"/>
	<input type="hidden" name="idPedidos" id="idPedidos" value="<?=$pedidosVo->getIdPedidos()?>"/>
	<input type="hidden" name="idPrecedente" id="idPrecedente" value="<?=$pedidosVo->getPrecedentePedidos()?>"/>
	<input type="hidden" name="funcionalidade" value="<?=basename(__FILE__)?>" />
</form>
<?php
}
if(isset($_GET['visualiza']))
{
	if(isset($_GET['idPedidos']))
	{
		$collVo_Pedidos = null;
		$collVo_Projetos = null;
		$collVo_Historico = null;
		$collVo_Usuarios = null;
		$collVo_Modulos = null;
		$collVo_SubModulos = null;
		$collVo_Atividades = null;
		$collVo_Tecnologias = null;
		$collVo_Versoes = null;
		
		$pedidosVo->setIdPedidos($_GET['idPedidos']);
		$collVo_Pedidos = $controlaPedidos->pesquisarPedidos($pedidosVo);
		$pedidosVo = (object) $collVo_Pedidos[0];
		
		/**
		 * Verificação de Projetos
		 */
		$controlaProjetos = new Controla_Projetos();
		$projetosVo = new ProjetosVo();
		$projetosVo->setIdProjetos($pedidosVo->getIdProjetos());
		$collVo_Projetos = $controlaProjetos->pesquisarProjetos($projetosVo);
		$projetosVo = (object) $collVo_Projetos[0];
		
		/**
		 * Pesquisa de Cliente
		 */
		$controlaClientes = new Controla_Clientes();
		$clientesVo = new ClientesVo();
		$clientesVo->setIdClientes($projetosVo->getIdClientes());
		if($clientesVo->getIdClientes() == $dominio->DomnClientes_Abaco)
		{
			$clientesVo->setNomeClientes($dominio->DomnClientes_Abaco_TXT);
		}
		else 
		{
			$collVo_Clientes = $controlaClientes->pesquisarClientes($clientesVo);
			$clientesVo = (object) $collVo_Clientes[0];
		}
		
		
		/**
		 * Verificação de Histórico do Pedido
		 */
		$controlaHistorico = new Controla_Historico();
		$historicoVo = new Historico_PedidosVo();
		$historicoVo->setIdPedidos($pedidosVo->getIdPedidos());
		$collVo_Historico = $controlaHistorico->pesquisarHistorico($historicoVo);
		$historicoVo = (object) $collVo_Historico[0];
		
		/**
		 * Verificação de Papeis
		 */
		$controlaPapeis = new Controla_Papeis();
		$papeisVo = new PapeisVo();
		$papeisVo->setIdPapeis($historicoVo->getIdPapeisOrigem());
		$papelOrigem = $controlaPapeis->pesquisaNomePapeis($papeisVo);
		
		$papeisVo->setIdPapeis($historicoVo->getIdPapeisDestinatario());
		$papelDestinatario = $controlaPapeis->pesquisaNomePapeis($papeisVo);
		
		/**
		 * Pesquisa de Usuários para o Pedido.
		 */
		$controlaUsuarios = new Controla_Usuarios();
		$usuariosVo = new UsuariosVo();
		$usuariosVo->setIdUsuarios($historicoVo->getIdUsuarioOrigem());
		$collVo_Usuarios = $controlaUsuarios->pesquisarUsuarios($usuariosVo);
		$usuariosVo = (object) $collVo_Usuarios[0];
		$usuarioOrigem = $usuariosVo->getNomeUsuarios();
		
		$usuariosVo = new UsuariosVo();
		$usuariosVo->setIdUsuarios($historicoVo->getIdUsuariosDestinatario());
		$collVo_Usuarios = $controlaUsuarios->pesquisarUsuarios($usuariosVo);
		$usuariosVo = (object) $collVo_Usuarios[0];
		$usuarioDestinatário = $usuariosVo->getNomeUsuarios();
		
		
		/**
		 * Pesquisa Módulo
		 */
		$controlaModulos = new Controla_Modulos();
		$modulosVo = new ModulosVo();
		if($pedidosVo->getIdModulos() != '')
		{
			$modulosVo->setIdModulos($pedidosVo->getIdModulos());
			$collVo_Modulos = $controlaModulos->pesquisaModulos($modulosVo);
			if(!is_null($collVo_Modulos))
			{
				$modulosVo = (object) $collVo_Modulos[0];
			}
		}
		
		/**
		 * Pesquisa Sub-Módulo
		 */
		$controlaSubModulos = new Controla_SubModulos();
		$subModulosVo = new SubModulosVo();
		if($pedidosVo->getIdSubModulos() != '')
		{
			$subModulosVo->setIdSubModulos($pedidosVo->getIdSubModulos());
			$collVo_SubModulos = $controlaSubModulos->pesquisaSubModulos($subModulosVo);
			if(!is_null($collVo_SubModulos))
			{
				$subModulosVo = (object) $collVo_SubModulos[0];
			}
		}
		
		/**
		 * Pesquisa de Atividade
		 */
		$controlaAtividadesPontoFuncaoHoras = new Controla_AtividadesPontoFuncaoHoras();
		$atividadesVo = new AtividadesPontoFuncaoHorasVo();
		if($pedidosVo->getIdAtividadesPontoFuncaoHoras() != '')
		{
			$atividadesVo->setIdAtividadePontoFuncaoHoras($pedidosVo->getIdAtividadesPontoFuncaoHoras());
			$collVo_Atividades = $controlaAtividadesPontoFuncaoHoras->pesquisarAtividades($atividadesVo);
			if(!is_null($collVo_Atividades))
			{
				$atividadesVo = (object) $collVo_Atividades[0];
			}
		}
		
		/**
		 * Pesquisa de Tecnologia Utilizada
		 */
		$controlaTecnologias = new Controla_Tecnologias();
		$tecnologiasVo = new TecnologiasVo();
		if($atividadesVo->getIdTecnologias() != '')
		{
			$tecnologiasVo->setIdTecnologias($atividadesVo->getIdTecnologias());
			$collVo_Tecnologias = $controlaTecnologias->pesquisarTecnologias($tecnologiasVo);
			if(!is_null($collVo_Tecnologias))
			{
				$tecnologiasVo = (object) $collVo_Tecnologias[0];
			}
		}
		
		/**
		 * Pesquisa da Versão
		 */
		$controlaVersoes = new Controla_Versoes();
		$versoesVo = new VersoesVo();
		if($pedidosVo->getIdVersoes() != '')
		{
			$versoesVo->setIdVersoes($pedidosVo->getIdVersoes());
			$collVo_Versoes = $controlaVersoes->buscaVersoes($versoesVo);
			if(!is_null($collVo_Versoes))
			{
				$versoesVo = (object) $collVo_Versoes[0];
			}
		}
		
		/**
		 * Verificação de papel ocupado no projeto
		 */
		$papeisProjetosVo = new Papeis_ProjetosVo();
		$papeisProjetosVo->setIdUsuarios($_SESSION['id_Usuario']);
		$papeisProjetosVo->setIdProjetos($projetosVo->getIdProjetos());
		$collVoPermissoesPapeis = $controlaProjetos->pesquisarUsuariosPapeisProjetos($papeisProjetosVo);
		$papeisProjetosVo = (object) $collVoPermissoesPapeis[0];
		
		//Verifica se Existe Sub-Pedido para este Pedido
		$retornoSubPedido = $controlaPedidos->verificaSubPedidosExistentes($pedidosVo);
		
		//Pegar o Último Historico do Pedido
		$historicoVo_Ultimo = new Historico_PedidosVo();
		$historicoVo_Ultimo->setIdPedidos($pedidosVo->getIdPedidos());
		$collVo_UltimoHistorico = $controlaHistorico->pesquisarHistorico($historicoVo_Ultimo);
		$ultimoH = count($collVo_UltimoHistorico)-1;
		$historicoVo_Ultimo = (object) $collVo_UltimoHistorico[$ultimoH];
	}
?>
<table width="95%" border="0" cellpadding="2" cellspacing="3" class="tabelaListagem" align="center">
	<tr>
	<td>
		<table width="100%" border="0" cellpadding="2" cellspacing="3" align="center">
		<?php
		if($pedidosVo->getPrecedentePedidos() != '')
		{
		?>
		<tr>
			<td width="18%" valign="top" class="formTdEsquerdo"><b>Pedido Nº Origem:</b></td>
			<td width="29%" valign="top" colspan="3"><?=$pedidosVo->getPrecedentePedidos()?> - <a href="javascript:void(0);" onclick="carregaPagina('viewPedidos.php?visualiza=true&idPedidos=<?=$pedidosVo->getPrecedentePedidos()?>','formulario');" class="thickbox" id="destinatarios">Clique e veja o Pedido Origem</a></td>
		</tr>
		<?php
		}
		if($pedidosVo->getPrecedentePedidos() != '')
		{
		?>
		<tr>
			<td width="18%" valign="top" class="formTdEsquerdo"><b>Sub-Pedido Nº:</b></td>
			<td width="29%" valign="top" colspan="3"><?=$pedidosVo->getIdPedidos()?></td>
		</tr>
		<?php
		}
		else 
		{
		?>
		<tr>
			<td width="18%" valign="top" class="formTdEsquerdo"><b>Pedido Nº:</b></td>
			<td width="29%" valign="top" colspan="3"><?=$pedidosVo->getIdPedidos()?></td>
		</tr>
		<?
		}
		?>
		<tr>
			<td width="18%" valign="top" class="formTdEsquerdo"><b>Cliente:</b></td>
			<td width="29%" valign="top" colspan="3"><?=$clientesVo->getNomeClientes()?></td>
		</tr>
		<tr>
			<td valign="top" class="formTdEsquerdo"><b>Projeto/Sistema:</b></td>
			<td valign="top"><?=$projetosVo->getNomeProjetos()?></td>
			<td valign="top">&nbsp;</td>
			<td valign="top">&nbsp;</td>
		</tr>
		<?php
		if($papeisProjetosVo->getIdPapeis() != $dominio->DomnPapel_Usuario || $_SESSION['usuario_Clientes'] != 0)
		{
		?>
		<tr>
			<td valign="top" class="formTdEsquerdo"><b>Módulo:</b></td>
			<td valign="top"><?=$modulosVo->getNomeModulos()?></td>
			<td valign="top"><b>Sub-Módulo:</b></td>
			<td valign="top"><?=$subModulosVo->getNomeSubModulos()?></td>
		</tr>
		<tr>
			<td valign="top" class="formTdEsquerdo"><b>Origem do Pedido</b></td>
			<td valign="top" colspan="3"><?=$papelOrigem?> - <?=$usuarioOrigem?></td>
		</tr>
		<tr>
			<td valign="top" class="formTdEsquerdo"><b>Destinatário do Pedido</b></td>
			<td valign="top" colspan="3"><?=$papelDestinatario?> - <?=$usuarioDestinatário?></td>
		</tr>
		<tr>
			<td valign="top" class="formTdEsquerdo"><b>Tecnologia Utilizada:</b></td>
			<td valign="top"><?=$tecnologiasVo->getNomeTecnologias()?></td>
			<td valign="top"><b>Atividade:</b></td>
			<td valign="top"><?=$atividadesVo->getNomeAtividadesPontoFuncaoHoras()?></td>
		</tr>
		<?php
		}
		?>
		<tr>
			<td valign="top" class="formTdEsquerdo"><b>Data de abertura do Pedido:</b></td>
			<td valign="top"><?=$converte->toViewDateTime($historicoVo->getDataHoraHistorico_Pedidos())?></td>
			<td valign="top"><b><?php
			if($_SESSION['usuario_Clientes'] != 0)
			{
				if($pedidosVo->getDomnStatusPedidos() == $dominio->DomnStatusPedido_Novo || $pedidosVo->getDomnStatusPedidos() == $dominio->DomnStatusPedido_Recebido)
				{
					echo "Previsão de Recebimento:";
				}
				elseif ($pedidosVo->getDomnStatusPedidos() == $dominio->DomnStatusPedido_Fechado)
				{
					echo "Fechado Atendimento em:";
				}
				elseif($pedidosVo->getDomnStatusPedidos() == $dominio->DomnStatusPedido_Concluido)
				{
					echo "Pedido Concluído em:";
				}
				elseif($pedidosVo->getDomnStatusPedidos() == $dominio->DomnStatusPedido_Desenvolvimento)
				{
					echo "Previsão de Conclusão:";
				}
				elseif ($pedidosVo->getDomnStatusPedidos() == $dominio->DomnStatusPedido_Devolvido)
				{
					echo "Devolvido em:";
				}
			}
			?></b></td>
			<td valign="top"><?
			if($_SESSION['usuario_Clientes'] != 0)
			{
				if($pedidosVo->getDomnStatusPedidos() == $dominio->DomnStatusPedido_Novo || $pedidosVo->getDomnStatusPedidos() == $dominio->DomnStatusPedido_Recebido || $pedidosVo->getDomnStatusPedidos() == $dominio->DomnStatusPedido_Desenvolvimento)
				{
					echo $converte->toViewDateTime($pedidosVo->getDataHoraPrevisaoPedidos());
				}
				elseif ($pedidosVo->getDomnStatusPedidos() == $dominio->DomnStatusPedido_Fechado || $pedidosVo->getDomnStatusPedidos() == $dominio->DomnStatusPedido_Concluido || $pedidosVo->getDomnStatusPedidos() == $dominio->DomnStatusPedido_Devolvido)
				{
					echo $converte->toViewDateTime($historicoVo_Ultimo->getDataHoraAtendimentoHistorico_Pedidos());
				}
			}
			?></td>
		</tr>
		<tr>
			<td valign="top" class="formTdEsquerdo"><b>Status do Pedido:</b></td>
			<td valign="top" colspan="3">
			<?php
			if($papeisProjetosVo->getIdPapeis() == $dominio->DomnPapel_Usuario)
			{
				if($pedidosVo->getDomnStatusPedidos() == $dominio->DomnStatusPedido_Recebido)
				{
					echo $dominio->DomnStatusPedido_Desenvolvimento_TXT;
				}
				else 
				{
					echo $dominio->mostraDomnStatusPedido($pedidosVo->getDomnStatusPedidos());
				}
				
			}
			else 
			{
				echo $dominio->mostraDomnStatusPedido($pedidosVo->getDomnStatusPedidos());
			}
			?></td>
		</tr>
		<?php
		if($papeisProjetosVo->getIdPapeis() != $dominio->DomnPapel_Usuario || $_SESSION['usuario_Clientes'] == 0)
		{
		?>
		<tr>
			<td valign="top" class="formTdEsquerdo"><b>Versão:</b></td>
			<td valign="top" colspan="3"><?=$versoesVo->getNomeVersoes()?><br>
			<?php
			if($_SESSION['usuario_Clientes'] != 0)
			{
			?>
			Data de Entrega Interna: <?=$converte->toViewDate($versoesVo->getDataEntregaVersoes())?><br>
			<?
			}
			?>
			Data de Entrega ao Cliente: <?=$converte->toViewDate($versoesVo->getDataEntregaVersoesClientes())?></td>
		</tr>
		<?php
		}
		?>
		<tr>
			<td width="18%" valign="top" class="formTdEsquerdo"><b>Severidade:</b></td>
			<td width="29%" valign="top"><?=$dominio->mostraDomnSeveridade($pedidosVo->getDomnSeveridadePedidos())?></td>
			<td width="24%" valign="top" class="formTdEsquerdo">&nbsp;</td>
			<td width="29%" valign="top">&nbsp;</td>
		</tr>
		<tr>
			<td width="18%" valign="top" class="formTdEsquerdo"><b>Assunto:</b></td>
			<td width="29%" valign="top" colspan="3"><?=$pedidosVo->getAssuntoPedido()?></td>
		</tr>
		</table>
		<table width="100%" border="0" align="center" cellpadding="2" cellspacing="3">
		<tr>
			<td width="21%" valign="top" class="formTdEsquerdo"><b>Descri&ccedil;&atilde;o do Pedido:</b></td>
			<td width="79%" colspan="3" valign="top"><?=$historicoVo->getComplementoHistorico_Pedidos()?></td>
		</tr>
		<tr>
			<td width="79%" colspan="4" valign="top">&nbsp;</td>
		</tr>
		<?php
		if($_SESSION['usuario_Clientes'] == 1)
		{
			$subPedidoVo = new PedidosVo();
			$collVo_SubPedidos = null;
			$subPedidoVo->setPrecedentePedidos($pedidosVo->getIdPedidos());
			$collVo_SubPedidos = $controlaPedidos->pesquisarPedidosPorPrecedente($subPedidoVo);
			
			if(!is_null($collVo_SubPedidos))
			{
		?>
		<tr>
			<td width="21%" valign="top" class="formTdEsquerdo"><b>Sub-Pedidos:</b></td>
			<td width="79%" colspan="3" valign="top"><?=$controlaPedidos->mostraSubPedidosExistentes($pedidosVo)?></td>
		</tr>
		<?php
			}
		}
		?>
		<tr>
			<td width="79%" colspan="4" valign="top">&nbsp;</td>
		</tr>
		<tr>
			<td colspan="4">
				<div align="center">
					<?php
					if(isset($_GET['idPedidos']))
					{
						$controlaPedidos->mostrarBotoesAcaoPedidos($pedidosVo,$historicoVo);
					}
					?>
					<br>
					<br>
					<br>
					<input type="button" value="<?=$dominio->botaoVoltar_TXT?>" id="<?=$dominio->botaoVoltar?>" class="botao" onClick="carregaPagina('viewPedidos.php?pesquisa=true','formulario');"/>
				</div>
				<div id="mostraComplementarPedido">
				<form id="formComplementarStatus" name="formComplementarStatus">
					<input type="hidden" id="idPedido" name="idPedido" value=""/>
					<input type="hidden" id="statusAtual" name="statusAtual" value=""/>
					<input type="hidden" id="pagina" name="pagina" value="alterarStatusComplementoPedido"/>
					<input type="hidden" id="mensagemBotao" name="mensagemBotao" value="">
					<input type="hidden" id="MudancaStatus" name="MudancaStatus" value="true">
					<table width="100%" border="0" cellspacing="2" cellpadding="2" style="display:none;" id="tabelaMotivo">
						<tr>
						  <td valign="top" class="formTdEsquerdo">&nbsp;</td>
						  <td colspan="3" valign="top">&nbsp;</td>
						</tr>
						<tr>
							<td width="21%" valign="top" class="formTdEsquerdo"><div id="mostraTextoCampo"></div></td>
							<td width="79%" colspan="3" valign="top" id="mostraDescricao1">&nbsp;</td>
						</tr>
						<tr>
						  <td valign="top" class="formTdEsquerdo">&nbsp;</td>
						  <td colspan="3" valign="top">&nbsp;</td>
						</tr>
						<tr>
							<td colspan="4">
								<div align="center">
									<input type="button" value="<?=$dominio->botaoConfirmar_TXT?>" id="<?=$dominio->botaoConfirmar?>" class="botao" onclick="alterarMotivoStatusPedido(<?=$pedidosVo->getIdPedidos()?>);"/>
								</div>
							</td>
						</tr>
					</table>
				</form>
				</div>
				<div id="mostraFormularioAlteraStatus">
				<form id="formAlteraStatus" name="formAlteraStatus" enctype="multipart/form-data">
					<input type="hidden" id="idPedido" name="idPedido" value=""/>
					<input type="hidden" id="statusAtual" name="statusAtual" value=""/>
					<input type="hidden" id="pagina" name="pagina" value="alterarStatusComplementoPedido"/>
					<table width="100%" border="0" cellspacing="2" cellpadding="2" style="display:none;" id="tabelaComplemento">
						<tr>
						  <td valign="top" class="formTdEsquerdo">&nbsp;</td>
						  <td colspan="3" valign="top">&nbsp;</td>
						</tr>
						<?php
						//Verifica Permissão para Alterar Prazo.Pelo Usuário
						$permissaoVo_NovoPrazo = new Permissao_Usuarios_Funcionalidades_PapeisVo();
						$controlaPermissoes = new Controla_Permissao();
						$collVo_Permissao_NovoPrazo = null;
						$permissaoVo_NovoPrazo->setIdUsuarios($_SESSION['id_Usuario']);
						$collVo_Permissao_NovoPrazo = $controlaPermissoes->buscaPermissoesSemMensagem($permissaoVo_NovoPrazo);
						$permite = 0;
						$permiteVersao = 0;
						
						if(!is_null($collVo_Permissao_NovoPrazo))
						{
							foreach ($collVo_Permissao_NovoPrazo as $permNovoPrazo)
							{
								$permissaoVo_NovoPrazo = (object) $permNovoPrazo;
								if($permissaoVo_NovoPrazo->getIdFuncionalidades() == $dominio->DomnFuncionalidade_Pedidos_Previsao_Entrega)
								{
									$permite = 1;
								}
								elseif ($permissaoVo_NovoPrazo->getIdFuncionalidades() == $dominio->DomnFuncionalidade_Pedidos_Versao)
								{
									$permiteVersao = 1;
								}
							}
						}
						
						//Verifica Permissão para Alterar Prazo.Pelo Papel Ocupado
						$collVo_Permissao_NovoPrazo = null;
						$permissaoVo_NovoPrazo = new Permissao_Usuarios_Funcionalidades_PapeisVo();
						if($_SESSION['id_Usuario'] == $historicoVo->getIdUsuariosDestinatario())
						{
							$permissaoVo_NovoPrazo->setIdPapeis($historicoVo->getIdPapeisDestinatario());
							$collVo_Permissao_NovoPrazo = $controlaPermissoes->buscaPermissoesSemMensagem($permissaoVo_NovoPrazo);
						}
						elseif ($_SESSION['id_Usuario'] == $historicoVo->getIdUsuarioOrigem())
						{
							$permissaoVo_NovoPrazo->setIdPapeis($historicoVo->getIdPapeisOrigem());
							$collVo_Permissao_NovoPrazo = $controlaPermissoes->buscaPermissoesSemMensagem($permissaoVo_NovoPrazo);
						}
						
						
						if(!is_null($collVo_Permissao_NovoPrazo) && $permite == 0)
						{
							foreach ($collVo_Permissao_NovoPrazo as $permNovoPrazo)
							{
								$permissaoVo_NovoPrazo = (object) $permNovoPrazo;
								if($permissaoVo_NovoPrazo->getIdFuncionalidades() == $dominio->DomnFuncionalidade_Pedidos_Previsao_Entrega)
								{
									$permite = 1;
								}
								elseif ($permissaoVo_NovoPrazo->getIdFuncionalidades() == $dominio->DomnFuncionalidade_Pedidos_Versao)
								{
									$permiteVersao = 1;
								}
							}
						}
						
						if($permite == 1)
						{
							echo '
							<tr>
								<td width="25%" valign="top" class="formTdEsquerdo">Tecnologia Utilizada:</td>
								<td width="31%" valign="top" id="mostraTecnologias">'.$controlaPedidos->montaOptionsSelectTecnologias('consultarAtividades(this)').'</td>
								<td width="20%" valign="top" class="formTdEsquerdo">Atividade:</td>
								<td width="24%" valign="top" id="mostraAtividades">&nbsp;</td>
							</tr>
							<tr>
								<td width="25%" valign="top" class="formTdEsquerdo">Previs&atilde;o de Entrega:  </td>
								<td width="31%" valign="top" id="mostraPrevisaoEntrega">&nbsp;</td>
								<td width="20%" valign="top" class="formTdEsquerdo">&nbsp;</td>
								<td width="24%" valign="top">&nbsp;</td>
							</tr>
							';
						}
						if($permiteVersao == 1)
						{
							echo '
								<tr>
									<td width="25%" valign="top" class="formTdEsquerdo">Vers&atilde;o:</td>
									<td width="31%" valign="top" id="mostraVersoes">'.$controlaPedidos->montaSelectVersoes($versoesVo).'</td>
									<td width="20%" valign="top" class="formTdEsquerdo"></td>
									<td width="24%" valign="top">&nbsp;</td>
								</tr>
								';
						}
						?>
						<tr>
						  <td valign="top" class="formTdEsquerdo">Anexo:</td>
						  <td colspan="3" valign="top" id="mostraAnexo">&nbsp;</td>
						</tr>
						<tr>
							<td width="21%" valign="top" class="formTdEsquerdo">Descri&ccedil;&atilde;o do Pedido: </td>
							<td width="79%" colspan="3" valign="top" id="mostraDescricao">&nbsp;</td>
						</tr>
						<tr>
						  <td valign="top" class="formTdEsquerdo">&nbsp;</td>
						  <td colspan="3" valign="top">&nbsp;</td>
						</tr>
						<tr>
							<td colspan="4">
								<div align="center">
									<input type="button" value="<?=$dominio->botaoConfirmar_TXT?>" id="<?=$dominio->botaoConfirmar?>" class="botao" onclick="alterarStatusPedido(<?=$pedidosVo->getIdPedidos()?>,<?=$pedidosVo->getDomnStatusPedidos()?>,'Pedido complementado com sucesso.');"/>
								</div>
							</td>
						</tr>
					</table>
					<?php
					if($permite == 1)
					{
					?>
					<script type="text/javascript">
					consultarPrevisaoEntrega('');
					</script>
					<?php
					}
					?>
				</form>
				</div>
				</td>
		</tr>
		<tr>
		  <td colspan="4">&nbsp;</td>
		  </tr>
		<tr>
		  <td colspan="4" class="tituloListagem"><b>Hist&oacute;ricos do Pedido</b></td>
		  </tr>
		<tr>
		  <td colspan="4">
		  <table width="100%" border="0" cellspacing="2" cellpadding="2">
		  <?php
		  foreach ($collVo_Historico as $hist)
		  {
		  	$historicoVo_Historico = new Historico_PedidosVo();
		  	$historicoVo_Historico = (object) $hist;
		  	
		  	//Usuario
		  	$usuariosVo_Historico = new UsuariosVo();
			if($historicoVo_Historico->getIdUsuarioHistorico_Pedidos() != '')
			{
				$usuariosVo_Historico->setIdUsuarios($historicoVo_Historico->getIdUsuarioHistorico_Pedidos());
				$collVo_UsuariosHistorico = $controlaUsuarios->pesquisarUsuarios($usuariosVo_Historico);
				$usuariosVo_Historico = (object) $collVo_UsuariosHistorico[0];
			}
		  ?>
            <tr>
            	<td width="21%"><b>Data:</b></td>
              	<td width="79%" colspan="3"><?=$converte->toViewDateTime($historicoVo_Historico->getDataHoraHistorico_Pedidos())?> - <?=$usuariosVo_Historico->getNomeUsuarios()?></td>
            </tr>
            <tr>
              	<td><b>Status do Pedido:</b></td>
              	<td colspan="3"><?=$dominio->mostraDomnStatusPedido($historicoVo_Historico->getDomnStatusPedidoHistorico_Pedidos())?></td>
            </tr>
            <?php
            if($historicoVo_Historico->getIdVersoes() != '')
            {
            ?>
            <tr>
            	<td><b>Versão do Pedido:</b></td>
             	<td colspan="3"><?php
				$versoesVo_Historico = new VersoesVo();
				$versoesVo_Historico->setIdVersoes($historicoVo_Historico->getIdVersoes());
				$collVo_VersoesHistorico = $controlaVersoes->buscaVersoes($versoesVo_Historico);
				$versoesVo_Historico = (object) $collVo_VersoesHistorico[0];
				echo $versoesVo_Historico->getNomeVersoes()."<br>";
				if($_SESSION['usuario_Clientes'] == 1)
				{
					echo "Previsão de Entrega Interna: ".$converte->toViewDate($versoesVo_Historico->getDataEntregaVersoes())."<br>";
				}
				echo "Previsão ao Cliente: ".$converte->toViewDate($versoesVo_Historico->getDataEntregaVersoesClientes());
              ?></td>
            </tr>
            <?php
            }
            ?>
            <tr>
              <td colspan="4"><div align="justify"><?=$historicoVo_Historico->getComplementoHistorico_Pedidos()?></div></td>
            </tr>
            <?php
            if($historicoVo_Historico->getIdAnexos() != '')
            {
            ?>
            <tr>
              <td><b>Anexo:</b></td>
              <td colspan="3">
              <?php
              
	              $controla_Anexos = new Controla_Anexos();
	              $anexosVo = new AnexosVo();
	              $anexosVo->setIdAnexos($historicoVo_Historico->getIdAnexos());
	              $collVoAnexos = $controla_Anexos->pesquisaAnexos($anexosVo);
	              $anexosVo = (object) $collVoAnexos[0];
              ?>
              	<a href="<?=$dominio->path_externo.$anexosVo->getCaminhoAnexos()?>" target="_blank"><?=$anexosVo->getNomeAnexos()?></a>
              </td>
            </tr>
            <?php
            }
            ?>
            <tr>
		  		<td colspan="4"><hr color="#0033FF" width="100%"></td>
		  	</tr>
		  	<tr>
		  		<td colspan="4">&nbsp;</td>
		  	</tr>
          <?php
		  }
		  ?>
		  
          </table>
          </td>
		  </tr>
  </table>
	</td>
	</tr>
<?php
}
?>