<?php
//####################################
// * Rafael Henrique Vieira de Moura /Desenvolvedor (Ábaco Tecnologia)
// * Arquivo: viewNaoConformidades.php
// * Criação: Rafael Henrique Vieira de Moura
// * Revisão:
// * Data de criação: 29/07/2008
//####################################

/**
 * Página de Manter Não Conformidades
 */

require("config.php");

$formataData = new FormataData();

if(!isset($_SESSION["usuario_Logado"]))
{
	header("Location:index.php");
}
?>
<script type="text/javascript">
	function consultar(){
		var formulario = $('#formNaoConformidades').serialize(true);
		$('#conteudo').block({message:'<h4>Aguarde...</h4><br/><img src="./imagens/loading.gif" border="0" />'});
		$.post('class/ControlaPostGet.php',formulario,function(retorno){
			$('#conteudo').unblock();
			$('#contentRetorno').empty().html(retorno);
			$('#contentRetorno').slideDown('slow');
		})
	}
	function cadastrar(){
		var formulario = $('#formNaoConformidades').serialize(true);
		$('#conteudo').block({message:'<h4>Aguarde...</h4><br/><img src="./imagens/loading.gif" border="0" />'});
		$.post('class/ControlaPostGet.php',formulario,function(retorno){
			$('#conteudo').unblock();
			if(retorno == 'Sucesso'){
				alert('Cadastrado com sucesso.');
				carregaPagina('viewNaoConformidades.php','formulario');
			} else {
				$('.informacao').empty().html(retorno);
				$('.informacao').slideDown('slow');
			}
		})
	}
	
	$(document).ready(function(){
		$('.calendario').calendar({
			//autoPopUp: "button",
			clearText: "Limpar", //Nome do botao limpar
			closeText: "Fechar", //nome do botao fechar
			prevText: "&lt;Ant", // nome do botao anterior
			nextText: "Prox&gt;", //nome do botao proximo
			currentText: "Hoje", //nome do botao hoje
			dayNames: new Array("Dom","Seg","Ter","Qua","Qui","Sex","Sab"), // Array com dias da seman
			monthNames: new Array("Jan","Fev","Mar","Abr","Mai","Jun","Jul","Ago","Set","Out","Nov","Dez"), //array com os nome dos meses
			speed: "fast" //velocidade de abertura
			//buttonImageOnly: true, //apresentar botao somente na img
			//buttonImage: "/images/onix/calendar.gif", //nome da img e local onde vai abrir o click para o calendario
			//buttonText: "Calendario" //nome do botao
		});
		$('#dataNaoConformidades').mask('99/99/9999');
	})
</script>
<h3><?=htmlentities("Não Conformidades")?></h3>
<div id="barra">
	<a href="javascript:void(0)" title="Localizar Não Conformidades" onclick="carregaPagina('viewNaoConformidades.php?pesquisa=true','formulario');"><img src="imagens/ico_localizar.gif" border="0"  />&nbsp;&nbsp;Localizar Não Conformidades</a>
</div>
<br />
<div class="informacao" style="display:none"></div>
<?php
if (isset($_GET['pesquisa']) || (!isset($_GET['pesquisa']) && !isset($_GET['idNaoConformidades']) && !isset($_GET['idPedidos'])))
{
?>
<form action="#" id="formNaoConformidades" name="formNaoConformidades" method="post" onsubmit="return false">
	<table align="center">
		<tr>
			<td colspan="2"><strong>Pesquisa de Não Conformidades</strong></td>
		</tr>
		<tr>
			<td class="formTdEsquerdo">Nº Pedido:</td>
			<td><input type="text" name="idPedidos" id="idPedidos" class="campo" size="15" /></td>
		</tr>
		<tr>
			<td class="formTdEsquerdo">Data:</td>
			<td><input type="text" name="dataNaoConformidades" id="dataNaoConformidades" class="calendario campo" size="12" maxlength="10" /></td>
		</tr>
		<tr>
			<td colspan="2" align="center">
				<input type="button" value="<?=$dominio->botaoConfirmar_TXT?>" name="<?=$dominio->botaoConfirmar?>" title="<?=$dominio->botaoConfirmar_msg?>" class="botao" onclick="consultar()" />&nbsp;
				<input type="reset" value="<?=$dominio->botaoLimpar_TXT?>" name="<?=$dominio->botaoLimpar?>" title="<?=$dominio->botaoLimpar_msg?>" class="botao" />
			</td>
		</tr>
	</table>
	<input type="hidden" name="pagina" value="consultarNaoConformidades" />
</form>
<div id="contentRetorno">
<?php
$controlaNaoConformidades = new Controla_NaoConformidades();
$controlaNaoConformidades->montaListaNaoConformidades();
?>
</div>
<?php
}
elseif (($_GET['idNaoConformidades'] != '' || $_GET['idPedidos'] != '') && !isset($_GET['pesquisa']))
{
	$controlaNaoConformidades = new Controla_NaoConformidades();
	$naoConformidadesVo = new NaoConformidadesVo();
	$controlaPedidos = new Controla_Pedidos();
	$controlaHistorico = new Controla_Historico();
	$pedidosVo = new PedidosVo();
	if (isset($_GET['idNaoConformidades']))
	{
		$naoConformidadesVo->setIdNaoConformidades(strip_tags(rawurldecode($_GET['idNaoConformidades'])));
	}
	if (isset($_GET['idPedidos']))
	{
		$naoConformidadesVo->setIdPedidos(strip_tags(rawurldecode($_GET['idPedidos'])));
	}
	$collVo_NaoConformidades = $controlaNaoConformidades->pesquisarNaoConformidades($naoConformidadesVo);
	$naoConformidadesVo = (object) $collVo_NaoConformidades[0];
	
	$pedidosVo->setIdPedidos($naoConformidadesVo->getIdPedidos());
	
	$collVo_Pedidos = $controlaPedidos->pesquisarPedidos($pedidosVo);
	$pedidosVo = (object) $collVo_Pedidos[0];
	
	//Carregar os id's do Usuários responsáveis por receber as Não Conformidades
	$destinatariosNaoConformidadesVo = new DestinatariosNaoConformidadesVo();
	$destinatariosNaoConformidadesVo->setIdProjetos($pedidosVo->getIdProjetos());
	$collVo_Destinatarios = $controlaNaoConformidades->pesquisarDestinatariosNaoConformidades($destinatariosNaoConformidadesVo);
	
	$arrayDestinatarios = array();
	if (!is_null($collVo_Destinatarios))
	{
		foreach ($collVo_Destinatarios as $destinatarios)
		{
			$destinatariosNaoConformidadesVo = (object) $destinatarios;
			$arrayDestinatarios[] = $destinatariosNaoConformidadesVo->getIdUsuarios();
		}
	}
	
	//Carregar o id do Usuário que deverá justificar a Não Conformidade
	$historicoVo = new Historico_PedidosVo();
	$historicoVo->setIdPedidos($pedidosVo->getIdPedidos());
	$collVo_Historico = $controlaHistorico->pesquisarHistorico($historicoVo);
	$i = count($collVo_Historico) - 1;
	$historicoVo = (object) $collVo_Historico[$i];
?>
	<form action="#" id="formNaoConformidades" name="formNaoConformidades" method="post" onsubmit="return false">
	<table align="center">
	<?php
	if (in_array($_SESSION['id_Usuario'],$arrayDestinatarios) || $_SESSION['id_Usuario'] == $historicoVo->getIdUsuariosDestinatario())
	{
	?>
		<tr>
			<td class="formTdEsquerdo">Pedido:</td>
			<td><?=$naoConformidadesVo->getIdPedidos()?></td>
		</tr>
		<tr>
			<td class="formTdEsquerdo">Data Não Conformidade:</td>
			<td><?=$formataData->toViewDateTime($naoConformidadesVo->getDataNaoConformidades())?></td>
		</tr>
		<tr>
			<td class="formTdEsquerdo">Motivo:</td>
			<td>
			<?php
					if ($naoConformidadesVo->getJustificativaNaoConformidades() != '')
					{
						echo $naoConformidadesVo->getDomnMotivo();
			?>
				<input type="hidden" name="domnMotivo" id="domnMotivo" value="<?=$naoConformidadesVo->getDomnMotivo()?>" />
			<?php
					}
					else
					{
						if ($_SESSION['id_Usuario'] == $historicoVo->getIdUsuariosDestinatario())
						{
			?>
				<input type="text" size="30" name="domnMotivo" id="domnMotivo" class="campo" />
			<?php
						}
						else
						{
							echo "Aguardando Motivo.";
						}
					}
			?>
			</td>
		</tr>
		<tr>
			<td class="formTdEsquerdo">Justificativa:</td>
			<td>
			<?php
					if ($naoConformidadesVo->getJustificativaNaoConformidades() != '')
					{
						echo $naoConformidadesVo->getJustificativaNaoConformidades();
			?>
				<input type="hidden" name="justificativaNaoConformidades" id="justificativaNaoConformidades" value="<?=$naoConformidadesVo->getJustificativaNaoConformidades()?>" />
			<?php
					}
					else
					{
						if ($_SESSION['id_Usuario'] == $historicoVo->getIdUsuariosDestinatario())
						{
			?>
				<textarea name="justificativaNaoConformidades" id="justificativaNaoConformidades" cols="25" rows="4" class="campo"></textarea>
			<?php
						}
						else
						{
							echo "Aguardando Justificativa.";
						}
					}
			?>
			</td>
		</tr>
		<tr>
			<td class="formTdEsquerdo">Contra-Medida:</td>
			<td>
			<?php
					if ($naoConformidadesVo->getContraMedidasNaoConformidades() != '')
					{
						echo $naoConformidadesVo->getContraMedidasNaoConformidades();
			?>
				<input type="hidden" name="contraMedidasNaoConformidades" id="contraMedidasNaoConformidades" value="<?=$naoConformidadesVo->getContraMedidasNaoConformidades()?>" />
			<?php
					}
					elseif ($naoConformidadesVo->getJustificativaNaoConformidades() != '')
					{
						if (in_array($_SESSION['id_Usuario'],$arrayDestinatarios))
						{
			?>
				<textarea name="contraMedidasNaoConformidades" id="contraMedidasNaoConformidades" cols="25" rows="4" class="campo"></textarea>
			<?php
						}
						else
						{
							echo "Aguardando Contra-Medida.";
						}
					}
					else
					{
						echo "Aguardando Justificativa.";
					}
					
			?>
			</td>
		</tr>
		<tr>
			<td colspan="2">&nbsp;</td>
		</tr>
		<tr>
			<td colspan="2" align="center">
			<?php
				if (($naoConformidadesVo->getJustificativaNaoConformidades() == '' && $_SESSION['id_Usuario'] == $historicoVo->getIdUsuariosDestinatario()) || (in_array($_SESSION['id_Usuario'],$arrayDestinatarios) && $naoConformidadesVo->getContraMedidasNaoConformidades() == '' && $naoConformidadesVo->getJustificativaNaoConformidades() != ''))
				{
			?>
				<input type="button" name="<?=$dominio->botaoConfirmar?>" value="<?=$dominio->botaoConfirmar_TXT?>" title="<?=$dominio->botaoConfirmar_msg?>" class="botao" onclick="cadastrar()" />&nbsp;
				<input type="reset" name="<?=$dominio->botaoLimpar?>" value="<?=$dominio->botaoLimpar_TXT?>" title="<?=$dominio->botaoLimpar_msg?>" class="botao" />
			<?php
				}
				else 
				{
			?>
				<input type="button" name="<?=$dominio->botaoVoltar?>" value="<?=$dominio->botaoVoltar_TXT?>" title="<?=$dominio->botaoVoltar_msg?>" class="botao" onclick="carregaPagina('viewNaoConformidades.php','formulario')" />
			<?php
				}
			?>
			</td>
		</tr>
	<?php
	}
	else 
	{
	?>
	<tr>
		<td colspan="2" align="center">Usuário não autorizado a visualizar esta Não Conformidade.</td>
	</tr>
	<?php
	}
	?>
	</table>
	<input type="hidden" name="idPedidos" value="<?=$naoConformidadesVo->getIdPedidos()?>" />
	<input type="hidden" name="dataNaoConformidades" value="<?=$naoConformidadesVo->getDataNaoConformidades()?>" />
	<input type="hidden" name="idNaoConformidades" value="<?=$naoConformidadesVo->getIdNaoConformidades()?>" />
	<input type="hidden" name="pagina" value="atualizarNaoConformidades" />
	<input type="hidden" name="funcionalidade" value="<?=basename(__FILE__)?>" />
</form>
<?php
}
?>