<?php
//####################################
// * João Batista Padilha e Silva Analista/Desenvolvedor (Ábaco Tecnologia)
// * Arquivo: viewPapeis.php
// * Criação: João Batista Padilha e Silva
// * Revisão:
// * Data de criação: 07/07/2008
//####################################
/**
 * Página de Manter Papeis do Sistema - Cadastrar e Alterar
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
function cadastrar()
{
	var formulario = $('#form1').serialize(true);
	$('#conteudo').block({message:'<h4>Aguarde...</h4><br/><img src="./imagens/loading.gif" border="0" />'});
	$.post('class/ControlaPostGet.php',formulario,function(retorno){
		$('#conteudo').unblock();
		if(retorno == "1")
		{
			alert('Cadastrado com sucesso.');
			carregaPagina('viewPapeis.php','formulario');
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
</script>

<h3>Papeis Cadastrados</h3>
<div id="barra">
	<a href="javascript:void(0)" title="Cadastrar Novo Papel" onclick="carregaPagina('viewPapeis.php?cadastro=true','formulario');"><img src="imagens/ico_novo.jpg" border="0"  />&nbsp;&nbsp;Novo Papel&nbsp;&nbsp;|&nbsp;&nbsp;</a>
	<a href="javascript:void(0)" title="Localizar Papeis" onclick="carregaPagina('viewPapeis.php','formulario');"><img src="imagens/ico_localizar.gif" border="0"  />&nbsp;&nbsp;Localizar Papeis&nbsp;&nbsp;|&nbsp;&nbsp;</a>
</div>
<br />
<div id="informacao" class="informacao" style="display:none"></div>
<?php
if (!isset($_GET['cadastro']))
{
?>
<form method="post" id="formPesquisa" action="#" onsubmit="return false">
	<table align="center">
		<tr>
			<td class="formTdEsquerdo">Nome do Papel:</td>
			<td><input type="text" size="30" name="nomePapeis" id="nomePapeis" class="campo" /></td>
		</tr>
		<tr>
			<td colspan="2" align="center">
				<input type="button" name="<?=$dominio->botaoConfirmar?>" value="<?=$dominio->botaoConfirmar_TXT?>" title="<?=$dominio->botaoConfirmar_msg?>" class="botao" onclick="consultar()" />&nbsp;
				<input type="reset" name="<?=$dominio->botaoLimpar?>" value="<?=$dominio->botaoLimpar_TXT?>" title="<?=$dominio->botaoLimpar_msg?>" class="botao" />
			</td>
		</tr>
	</table>
	<input type="hidden" name="pagina" value="pesquisaPapeis" />
</form>
<div id="contentRetorno">
<table width="95%" border="0" cellpadding="1" cellspacing="0" class="tabelaListagem" align="center">
	<tr>
		<td class="tituloListagem" colspan="2">Tabela Básica</td>
	</tr>
	<?php
		
		$controlaPapeis = new Controla_Papeis();
		$papeisVo = new PapeisVo();
		echo $controlaPapeis->mostraPapeis($papeisVo);
	?>
</table>
</div>
<?php
} 
else
{
	$papeisVo = new PapeisVo();

	// Caso seja alteração do registro
	if(isset($_GET['idPapel']))
	{
		$controlaPapeis = new Controla_Papeis();
		$controla_Permissao = new Controla_Permissao();
		$permissaoVo = new Permissao_Usuarios_Funcionalidades_PapeisVo();
		
		$papeisVo->setIdPapeis($_GET['idPapel']);
		$collVo = $controlaPapeis->pesquisarPapeis($papeisVo);
		$papeisVo = (object) $collVo[0];
		
		// Pesquisa Funcionalidades para esse papel
		$permissaoVo->setIdPapeis($papeisVo->getIdPapeis());
		
		$collVo_Permissao = $controla_Permissao->buscaPermissoesSemMensagem($permissaoVo);
		
	}
?>
<form action="#" method="POST" id="form1" name="form1">
	<table align="center" width="100%">
		<tr>
			<td class="formTdEsquerdo">Nome do Papel<span class="asterisco"> *</span></td>
			<td><input type="text" name="nomePapeis" id="nomePapeis" size="20" value="<?=$papeisVo->getNomePapeis()?>" class="campo"/></td>
		</tr>
		<tr>
			<td class="formTdEsquerdo">Permissões das funcionalidades:</td>
			<td>
			<textarea cols="60" rows="4" readonly="readonly" id="funcionalidades_txt" class="campo"><?php
			$controlaFuncionalidades = new Controla_Funcionalidades();
			for($i = 0; $i < count($collVo_Permissao); $i++)
			{
				$permissaoVo = (object) $collVo_Permissao[$i];
				$funcionalidadesVo = new FuncionalidadesVo();
				$funcionalidadesVo->setIdFuncionalidades($permissaoVo->getIdFuncionalidades());
				
				//Pesquisa De funcionalidade.
				if($permissaoVo->getIdFuncionalidades() == $dominio->DomnFuncionalidade_Pedidos_Modulo_SubModulo)
				{
					$funcionalidadesVo->setNomeFuncionalidades($dominio->DomnFuncionalidade_Pedidos_Modulo_SubModulo_TXT);
				}
				elseif ($permissaoVo->getIdFuncionalidades() == $dominio->DomnFuncionalidade_Pedidos_Tecnologia_Atividades)
				{
					$funcionalidadesVo->setNomeFuncionalidades($dominio->DomnFuncionalidade_Pedidos_Tecnologia_Atividades_TXT);
				}
				elseif ($permissaoVo->getIdFuncionalidades() == $dominio->DomnFuncionalidade_Pedidos_Versao)
				{
					$funcionalidadesVo->setNomeFuncionalidades($dominio->DomnFuncionalidade_Pedidos_Versao_TXT);
				}
				elseif ($permissaoVo->getIdFuncionalidades() == $dominio->DomnFuncionalidade_Pedidos_Papel_Usuario_Destinatario)
				{
					$funcionalidadesVo->setNomeFuncionalidades($dominio->DomnFuncionalidade_Pedidos_Papel_Usuario_Destinatario_TXT);
				}
				elseif ($permissaoVo->getIdFuncionalidades() == $dominio->DomnFuncionalidade_Pedidos_Previsao_Entrega)
				{
					$funcionalidadesVo->setNomeFuncionalidades($dominio->DomnFuncionalidade_Pedidos_Previsao_Entrega_TXT);
				}
				elseif ($permissaoVo->getIdFuncionalidades() == $dominio->DomnFuncionalidade_Pedidos_Pesquisar_Todos_Pedidos)
				{
					$funcionalidadesVo->setNomeFuncionalidades($dominio->DomnFuncionalidade_Pedidos_Pesquisar_Todos_Pedidos_TXT);
				}
				elseif ($permissaoVo->getIdFuncionalidades() == $dominio->DomnFuncionalidade_Pedidos_Concluir_Pedido)
				{
					$funcionalidadesVo->setNomeFuncionalidades($dominio->DomnFuncionalidade_Pedidos_Concluir_Pedido_TXT);
				}
				elseif ($permissaoVo->getIdFuncionalidades() == $dominio->DomnFuncionalidade_Pedidos_Homologado_Pedido)
				{
					$funcionalidadesVo->setNomeFuncionalidades($dominio->DomnFuncionalidade_Pedidos_Homologado_Pedido_TXT);
				}
				else
				{ 
					$collVo_Funcionalidades = $controlaFuncionalidades->pesquisarFuncionalidades($funcionalidadesVo);
					$funcionalidadesVo = (object) $collVo_Funcionalidades[0];
				}
				echo $funcionalidadesVo->getNomeFuncionalidades();
				if((count($collVo_Permissao)-1) != $i)
				{
					echo "\n";
				}
			}
			?></textarea><br>
			<a href="viewSelecionarFuncionalidades.php?KeepThis=true&TB_iframe=true&height=400&width=600" class="thickbox" title="Selecionar Permissões" id="permissoes">Selecionar permissões para funcionalidades</a></td>
		</tr>
		<tr>
			<td>&nbsp;</td>
		</tr>				
		<tr align="center">
			<td colspan="2" class="formTdCentro">
				<input type="button" value="<?=$dominio->botaoConfirmar_TXT?>" id="<?=$dominio->botaoConfirmar?>" class="botao" onclick="cadastrar()"/>
				&nbsp;
				<input type="button" value="<?=$dominio->botaoVoltar_TXT?>" id="<?=$dominio->botaoVoltar?>" class="botao" onClick="carregaPagina('viewPapeis.php','formulario');" />
			</td>
		</tr>
	</table>
	<input type="hidden" name="pagina" id="pagina" value="cadastraPapeis"/>
	<input type="hidden" name="idPapeis" id="idPapeis" value="<?=$papeisVo->getIdPapeis()?>"/>
	<input type="hidden" name="idFuncionalidades" id="idFuncionalidades" value="
	<?php
		//Caso seja alteração, carrega todas as funcionalidades cadastradas.
	
		$mostra = "";
		for($i = 0; $i < count($collVo_Permissao); $i++)
		{
			if($mostra != "")
				$mostra = $mostra.";";
			$permissaoVo = (object) $collVo_Permissao[$i];
			$mostra = $mostra.$permissaoVo->getIdFuncionalidades();
		}
		echo $mostra;
	?>
	
	"/>
	<input type="hidden" name="funcionalidade" value="<?=basename(__FILE__)?>" />
</form>
<?php
}
?>