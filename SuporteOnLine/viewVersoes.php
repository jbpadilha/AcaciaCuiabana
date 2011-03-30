<?php
//####################################
// * João Batista Padilha e Silva Analista/Desenvolvedor (Ábaco Tecnologia)
// * Arquivo: viewVersoes.php
// * Criação: João Batista Padilha e Silva
// * Revisão:
// * Data de criação: 11/07/2008
//####################################
/**
 * Página de Manter Versões de Sistema
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
function cadastrar()
{
	var formulario = $('#form1').serialize(true);
	$('#conteudo').block({message:'<h4>Aguarde...</h4><br/><img src="./imagens/loading.gif" border="0" />'});
	$.post('class/ControlaPostGet.php',formulario,function(retorno){
		$('#conteudo').unblock();
		if(retorno == "1")
		{
			alert('Cadastrado com sucesso.');
			carregaPagina('viewVersoes.php','formulario');
		}
		else
		{
			$('#informacao').empty().html(retorno);
			$('#informacao').slideDown('slow');$('#informacao').slideDown('slow');
		}
		
	})
}

/**
 *	Função que envia o formulário via Ajax. Basta passar o nome do formulario em "var formulario = $('#form1').serialize();"
 *  e indicar o retorno, como sera visto, em uma div ou dar um alert.
 * @author Rafael Moura
 */
function consultar()
{
	var formulario = $('#formPesquisa').serialize(true);
	$('#conteudo').block({message:'<h4>Aguarde...</h4><br/><img src="./imagens/loading.gif" border="0" />'});
	$.post('class/ControlaPostGet.php',formulario,function(retorno){
		$('#conteudo').unblock();
		$('#contentRetorno').empty().html(retorno);
		$('#contentRetorno').slideDown('slow');$('#contentRetorno').slideDown('slow');
	})
}

$(document).ready(function(){
	$('#dataVersoes,#dataVersoesClientes').calendar({
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
	$("#dataVersoes").mask("99/99/9999");
	$("#dataVersoesClientes").mask("99/99/9999");
});

</script>

<h3>Versões Cadastrados</h3>
<div id="barra">
	<a href="javascript:void(0)" title="Cadastrar Nova Versões" onclick="carregaPagina('viewVersoes.php?cadastro=true','formulario');"><img src="imagens/ico_novo.jpg" border="0"  />&nbsp;&nbsp;Nova Versões&nbsp;&nbsp;|&nbsp;&nbsp;</a>
	<a href="javascript:void(0)" title="Localizar Versões" onclick="carregaPagina('viewVersoes.php','formulario');"><img src="imagens/ico_localizar.gif" border="0"  />&nbsp;&nbsp;Localizar Versões&nbsp;&nbsp;|&nbsp;&nbsp;</a>
</div>
<br />
<div id="informacao" class="informacao" style="display:none"></div>
<?php
if (!isset($_GET['cadastro']) && !isset($_GET['pesquisa']))
{
?>
<form method="post" id="formPesquisa" action="#" onsubmit="return false">
	<table align="center">
		<tr>
			<td colspan="2" align="center"><strong>Pesquisa de Versões</strong></td>
		</tr>
		<tr>
			<td class="formTdEsquerdo">Nome da Versão:</td>
			<td><input type="text" size="30" name="nomeVersoes" id="nomeVersoes" class="campo" /></td>
		</tr>
		<tr>
			<td class="formTdEsquerdo">Data de Entrega das Versões:</td>
			<td><input type="text" size="12" name="dataVersoes" id="dataVersoes" class="campo" /></td>
		</tr>
		<tr>
			<td class="formTdEsquerdo">Data de Entrega das Versões para o Cliente:</td>
			<td><input type="text" size="12" name="dataVersoesClientes" id="dataVersoesClientes" class="campo" /></td>
		</tr>
		<tr>
			<td class="formTdEsquerdo">Projeto:</td>
			<td>
				<?php
					$versoesVo = new VersoesVo();
					$controlaVersoes = new Controla_Versoes();
					echo $controlaVersoes->montaSelectProjetos($versoesVo);
				?>
			</td>
		</tr>
		<tr>
			<td colspan="2" align="center">
				<input type="button" name="<?=$dominio->botaoConfirmar?>" value="<?=$dominio->botaoConfirmar_TXT?>" title="<?=$dominio->botaoConfirmar_msg?>" class="botao" onclick="consultar()" />&nbsp;
				<input type="reset" name="<?=$dominio->botaoLimpar?>" value="<?=$dominio->botaoLimpar_TXT?>" title="<?=$dominio->botaoLimpar_msg?>" class="botao" />
			</td>
		</tr>
	</table>
	<input type="hidden" name="pagina" value="pesquisaVersoes" />
</form>
<div id="contentRetorno">
<table width="95%" border="0" cellpadding="1" cellspacing="0" class="tabelaListagem" align="center">
	<tr>
		<td class="tituloListagem">Nome da Versão</td>
		<td class="tituloListagem">Data da Entrega</td>
		<td class="tituloListagem">Entrega para Cliente</td>
		<td class="tituloListagem" colspan="2">Projeto</td>
	</tr>
	<?php
		$controlaVersoes = new Controla_Versoes();
		$controlaVersoes->mostraVersoes();
	?>
</table>
</div>
<?php
} 
elseif (!isset($_GET['pesquisa'])) 
{
	$controlaVersoes = new Controla_Versoes();
	$versoesVo = new VersoesVo();
	
	// Caso seja alteração
	if(isset($_GET['idVersoes']))
	{
		$versoesVo->setIdVersoes($_GET['idVersoes']);
		$collVo = $controlaVersoes->buscaVersoes($versoesVo);
		$versoesVo = (object) $collVo[0];	
	}
?>
<form action="" method="POST" id="form1" name="form1">
	<table align="center" width="100%">
		<tr>
			<td class="formTdEsquerdo">Nome da Versão:<span class="asterisco"> *</span></td>
			<td><input type="text" name="nomeVersoes" id="nomeVersoes" size="20" value="<?=$versoesVo->getNomeVersoes()?>" class="campo"/></td>
		</tr>
		<tr>
			<td class="formTdEsquerdo">Data da Entrega da Versão:<span class="asterisco"> *</span></td>
			<td><input type="text" name="dataVersoes" id="dataVersoes" size="20" value="<?=$converte->toViewDate($versoesVo->getDataEntregaVersoes())?>" class="campo"/></td>
		</tr>
		<tr>
			<td class="formTdEsquerdo">Data da Entrega para o Cliente:<span class="asterisco"> *</span></td>
			<td><input type="text" name="dataVersoesClientes" id="dataVersoesClientes" size="20" value="<?=$converte->toViewDate($versoesVo->getDataEntregaVersoesClientes())?>" class="campo"/></td>
		</tr>
		<tr>
			<td class="formTdEsquerdo">Projeto:<span class="asterisco"> *</span></td>
			<td>
			<?php
				echo $controlaVersoes->montaSelectProjetos($versoesVo);
			?>
			</td>
		</tr>
		<tr>
			<td class="formTdEsquerdo">Anexos:</td>
			<td>
			<?php
			if(isset($_GET['visualizar']))
				echo $controlaVersoes->montaSelectAnexos($versoesVo,$_GET['visualizar']);
			else 
				echo $controlaVersoes->montaSelectAnexos($versoesVo);
			?></td>
		</tr>	
		<tr align="center">
			<td colspan="2" class="formTdCentro">
			<?php
			if(!isset($_GET['visualizar']))
			{
			?>
				<input type="button" value="<?=$dominio->botaoConfirmar_TXT?>" id="<?=$dominio->botaoConfirmar?>" class="botao" onclick="cadastrar()"/>
			<?php
			}
			?>
				&nbsp;
				<input type="button" value="<?=$dominio->botaoVoltar_TXT?>" id="<?=$dominio->botaoVoltar?>" class="botao" onClick="carregaPagina('viewVersoes.php','formulario')" />
			</td>
		</tr>
	</table>
	<input type="hidden" name="pagina" id="pagina" value="cadastraVersoes"/>
	<input type="hidden" name="idVersoes" id="idVersoes" value="<?=$versoesVo->getIdVersoes()?>"/>
	<input type="hidden" name="funcionalidade" value="<?=basename(__FILE__)?>" />
</form>
<?php
}
?>