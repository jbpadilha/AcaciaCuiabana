<?php
//####################################
// * João Batista Padilha e Silva Analista/Desenvolvedor (Ábaco Tecnologia)
// * Arquivo: viewPrincipal.php
// * Criação: João Batista Padilha e Silva
// * Revisão:
// * Data de criação: 10/07/2008
//####################################
/**
 * Página Principal do Sistema
 * @author João Batista Padilha e Silva
 */

require("config.php");

if(!isset($_SESSION["usuario_Logado"]))
{
	header("Location:index.php");
}
$controlaPedidos = new Controla_Pedidos();
$pedidosVo = new PedidosVo();
$controlaNaoConformidades = new Controla_NaoConformidades();
$cellSpacing = (stristr($_SERVER['HTTP_USER_AGENT'],"msie")) ? "1" : "0";
?>
<h3>Bem vindo ao Suporte On Line 3.0</h3>
<?php
	$controlaNaoConformidades->montaListaNaoConformidades();
?><br />
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
		<td class="tituloListagem" colspan="2">&nbsp;</td>
	</tr>
</table>
<br>
<table width="95%" border="0" cellpadding="1" cellspacing="<?=$cellSpacing?>" class="tabelaListagemAtendimento" align="center">
	<tr>
		<td class="tituloListagemAtendimento" colspan="6">Pedidos que estou atendendo</td>
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