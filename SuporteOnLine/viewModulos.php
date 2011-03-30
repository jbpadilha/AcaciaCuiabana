<?php
//####################################
// * João Batista Padilha e Silva Analista/Desenvolvedor (Ábaco Tecnologia)
// * Arquivo: viewModulos.php
// * Criação: João Batista Padilha e Silva
// * Revisão:
// * Data de criação: 10/07/2008
//####################################
/**
 * Página de Manter Módulos do Sistema - Cadastrar e Alterar
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
			carregaPagina('viewModulos.php','formulario');
		}
		else
		{
			$('#informacao').empty().html(retorno);
			$('#informacao').slideDown('slow');
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
		$('#contentRetorno').slideDown('slow');
	})
}
</script>

<h3>Módulos Cadastrados</h3>
<div id="barra">
	<a href="javascript:void(0)" title="Cadastrar Novo Módulo" onclick="carregaPagina('viewModulos.php?cadastro=true','formulario');"><img src="imagens/ico_novo.jpg" border="0"  />&nbsp;&nbsp;Novo Módulo&nbsp;&nbsp;|&nbsp;&nbsp;</a>
	<a href="javascript:void(0)" title="Localizar Módulos" onclick="carregaPagina('viewModulos.php','formulario');"><img src="imagens/ico_localizar.gif" border="0"  />&nbsp;&nbsp;Localizar Módulos&nbsp;&nbsp;|&nbsp;&nbsp;</a>
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
			<td class="formTdEsquerdo">Nome do Módulo:</td>
			<td><input type="text" size="30" name="nomeModulo" id="nomeModulo" class="campo" /></td>
		</tr>
		<tr>
			<td colspan="2" align="center">
				<input type="button" name="<?=$dominio->botaoConfirmar?>" value="<?=$dominio->botaoConfirmar_TXT?>" title="<?=$dominio->botaoConfirmar_msg?>" class="botao" onclick="consultar()" />&nbsp;
				<input type="reset" name="<?=$dominio->botaoLimpar?>" value="<?=$dominio->botaoLimpar_TXT?>" title="<?=$dominio->botaoLimpar_msg?>" class="botao" />
			</td>
		</tr>
	</table>
	<input type="hidden" name="pagina" value="pesquisaModulos" />
</form>
<div id="contentRetorno">
<table width="95%" border="0" cellpadding="1" cellspacing="0" class="tabelaListagem" align="center">
	<tr>
		<td class="tituloListagem" colspan="2">Papel</td>
	</tr>
	<?php
		$controla_Modulos = new Controla_Modulos();
		$modulosVo = new ModulosVo();
		echo $controla_Modulos->mostraModulos($modulosVo);
	?>
</table>
</div>
<?php
} 
elseif (!isset($_GET['pesquisa'])) 
{
	$modulosVo = new ModulosVo();
	$controla_Modulos = new Controla_Modulos();

	// Caso seja alteração do registro
	if(isset($_GET['idModulos']))
	{
		$controla_Permissao = new Controla_Permissao();
		$modulosVo->setIdModulos($_GET['idModulos']);
		$collVo = $controla_Modulos->pesquisaModulos($modulosVo);
		$modulosVo = (object) $collVo[0];
		
		// Busca todos os Sub-Módulos do Sistema
		$controla_SubModulos = new Controla_SubModulos();
		$subModulosVo = new SubModulosVo();
		$collVo_SubModulos = $controla_SubModulos->pesquisaSubModulos($subModulosVo);
		
		//Busca os Sub-Módulos para este Módulo
		$modulosSubModulosVo = new Modulos_SubModulosVo();
		$modulosSubModulosVo->setIdModulos($modulosVo->getIdModulos());
		$collVo_ModulosSubModulos = $controla_Modulos->pesquisarModulosSubModulos($modulosSubModulosVo);
	}
?>
<form action="" method="POST" id="form1" name="form1">
	<table align="center" width="100%">
		<tr>
			<td class="formTdEsquerdo">Nome do Módulo<span class="asterisco"> *</span></td>
			<td><input type="text" name="nomeModulo" id="nomeModulo" size="20" value="<?=$modulosVo->getNomeModulos()?>" class="campo"/></td>
		</tr>
		<tr>
			<td class="formTdEsquerdo">Sub-Módulos:</td>
			<td>
			<textarea cols="30" rows="4" readonly="readonly" id="subModulos_txt" class="campo" name="subModulos_txt"><?php
			if(!is_null($collVo_ModulosSubModulos))
			{
				foreach ($collVo_ModulosSubModulos as $modulosSubModulos)
				{
					$modulosSubModulosVo = (object) $modulosSubModulos;
					
					foreach ($collVo_SubModulos as $subModulos)
					{
						$subModulosVo = (object) $subModulos;
						if($modulosSubModulosVo->getIdSubModulos() == $subModulosVo->getIdSubModulos())
							echo $subModulosVo->getNomeSubModulos()."\n";
					}
				}
			}
			?></textarea><br>
			<a href="viewSelecionarSubModulos.php?KeepThis=true&TB_iframe=true&height=400&width=600" class="thickbox" title="Selecionar Sub-Módulos" id="subModulos">Selecione Sub-Módulos para este Módulo</a></td>
		</tr>
		<tr>
			<td>&nbsp;</td>
		</tr>				
		<tr align="center">
			<td colspan="2" class="formTdCentro">
				<input type="button" value="<?=$dominio->botaoConfirmar_TXT?>" id="<?=$dominio->botaoConfirmar?>" class="botao" onclick="cadastrar()"/>
				&nbsp;
				<input type="button" value="<?=$dominio->botaoVoltar_TXT?>" id="<?=$dominio->botaoVoltar?>" class="botao" onClick="carregaPagina('viewModulos.php','formulario')" />
			</td>
		</tr>
	</table>
	<input type="hidden" name="pagina" id="pagina" value="cadastrarModulos"/>
	<input type="hidden" name="idModulos" id="idModulos" value="<?=$modulosVo->getIdModulos()?>"/>
	<input type="hidden" name="idSubModulos" id="idSubModulos" value="<?php
	$mostra = "";
	if(!is_null($collVo_ModulosSubModulos))
	{
		foreach ($collVo_ModulosSubModulos as $modulosSubModulos)
		{
			$modulosSubModulosVo = (object) $modulosSubModulos;
			if($mostra != "")
				$mostra .= ";";
			$mostra .= $modulosSubModulosVo->getIdSubModulos();
		}	
	}
	echo $mostra;
	?>"/>
	<input type="hidden" name="funcionalidade" value="<?=basename(__FILE__)?>" />
</form>
<?php
}
?>