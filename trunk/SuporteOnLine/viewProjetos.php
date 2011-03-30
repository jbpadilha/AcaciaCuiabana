<?php
//####################################
// * Rafael Henrique Vieira de Moura /Desenvolvedor (Ábaco Tecnologia)
// * Arquivo: viewProjetos.php
// * Criação: João Batista Padilha e Silva
// * Revisão:
// * Data de criação: 14/07/2008
//####################################

/**
 * Página de Manter Projetos
 */

require("config.php");

if(!isset($_SESSION["usuario_Logado"]))
{
	header("Location:index.php");
}
?>
<script type="text/javascript">

function cadastrar()
{
	var formulario = $('#form1').serialize(true);
	$('#conteudo').block({message:'<h4>Aguarde...</h4><br/><img src="./imagens/loading.gif" border="0" />'});
	$.post('class/ControlaPostGet.php',formulario,function(retorno){
		$('#conteudo').unblock();
		if(retorno == '1'){
			alert('Cadastrado com sucesso.');
			carregaPagina('viewProjetos.php','formulario');
		} else {
			$('.informacao').empty().html(retorno);
			$('.informacao').slideDown('slow');
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

/**
 * Função que insere o texto e os ids escolhidos de cada papel para cada usuário;
 * Testa se a ID já foi inserida.
 * @author João Batista Padilha e Silva
 */
function inserirPapeisUsuariosProjetos()
{
	var papel = document.form1.selectPapeis.value;
	var usuario = document.form1.selectUsuarios.value;
	var papelTxt = document.form1.selectPapeis.options[document.form1.selectPapeis.selectedIndex].text;
	var usuarioTxt = document.form1.selectUsuarios.options[document.form1.selectUsuarios.selectedIndex].text;
	var ids = document.form1.idsPapeisProjetos.value;
	
	if(papel == '' && usuario != '')
	{
		alert('O Papel deve ser selecionado.');
		return false;
	}
	else if(papel != '' && usuario == '')
	{
		alert('O Usuário deve ser selecionado.');
		return false;
	}
	else if(papel != '' && usuario != '')
	{
		//Testar se o Usuário já foi inserido para este papel
		var testePapelUsuario = ids.split(";");
		var idsNova = papel+"-"+usuario;
		var retorno = true;
		for(i = 0; i<testePapelUsuario.length;i++)
		{
			if(testePapelUsuario[i] == idsNova)
			{
				alert("Usuário já inserido para este papel.");
				return false;
			}
		}
		//Insere o texto para amostragem
		addOption(document.form1.papeisUsuariosProjetos_txt, papel + "-"+usuario, papelTxt + " - "+usuarioTxt);
		
		//Insere os Ids
		if(document.form1.idsPapeisProjetos.value != '')
		{
			document.form1.idsPapeisProjetos.value = document.form1.idsPapeisProjetos.value + ";";
		}
		document.form1.idsPapeisProjetos.value = document.form1.idsPapeisProjetos.value + idsNova;
		
		return true;
	}
	
}

/**
 * Função que adiciona option ao select;
 * @author João Batista Padilha e Silva
 * @param select - O select que deseja inserir o option
 * @param val - o value do option
 * @param tex - o text do option
 */
function addOption(selec, val, tex) 
{
	var opt = document.createElement('option');
	opt.value = val;
	opt.text = tex;
	try 
	{ 
		selec.add(opt, null);
	} // NS/FF
	catch(e) 
	{
		selec.add(opt);
	} // IE
}


      
/**
 * Função remove o Papel usuário da lista;
 * @author João Batista Padilha e Silva
 */
function removePapelUsuario()
{
	var selec = document.form1.papeisUsuariosProjetos_txt;
		
	//Remove o TXT selecionado
	
	for(var i = 0; i < selec.options.length; i++)
	{
		if(selec.options[i].selected == true)
		{
			removeIdPapelUsuario(selec.options[i].value);
			selec.remove(i);
		}
	}
}

/**
 * Função remove o id Papel usuário da lista e retorna as ids novas;
 * @param idPapelUsuario - identificação a ser removida
 * @author João Batista Padilha e Silva
 */
function removeIdPapelUsuario(idPapelUsuario)
{
	var selecId = document.form1.idsPapeisProjetos.value;
	var ids = selecId.split(";");
	var retorno = '';
	
	for(var i = 0; i < ids.length; i++)
	{
		if(ids[i] != idPapelUsuario)
		{
			if(retorno != '')
				retorno = retorno + ";";
				
			retorno = retorno+ids[i];
		}
	}
	
	document.form1.idsPapeisProjetos.value = retorno;
}

function mostraFluxos(campoFluxos)
{
	if(campoFluxos.value != '')
	{
		$.post('class/ControlaPostGet.php',{campoFluxos:campoFluxos.value,pagina:'carregaFluxosProjetos'},function(retorno){
			$('#mostraFluxosSelecionados').empty().html(retorno);
			$('#mostraFluxosSelecionados').slideDown('slow');
		})
	}
	else
	{
		$('#mostraFluxosSelecionados').slideUp('slow');
	}
}

</script>

<h3>Projetos Cadastrados</h3>
<div id="barra">
	<a href="javascript:void(0)" title="Cadastrar Novo Projeto" onclick="carregaPagina('viewProjetos.php?cadastro=true','formulario');"><img src="imagens/ico_novo.jpg" border="0"  />&nbsp;&nbsp;Novo Projeto&nbsp;&nbsp;|&nbsp;&nbsp;</a>
	<a href="javascript:void(0)" title="Localizar Projeto" onclick="carregaPagina('viewProjetos.php','formulario');"><img src="imagens/ico_localizar.gif" border="0"  />&nbsp;&nbsp;Localizar Projeto&nbsp;&nbsp;|&nbsp;&nbsp;</a>
</div>
<br />
<div id="informacao" class="informacao" style="display:none"></div>
<?php
if (!isset($_GET['cadastro']) && !isset($_GET['pesquisa']))
{
	$projetosVo = new ProjetosVo();
	$controlaProjetos = new Controla_Projetos();
?>
<form method="post" id="formPesquisa" action="#" onsubmit="return false">
	<table align="center">
		<tr>
			<td class="formTdEsquerdo">Nome do Projeto:</td>
			<td><input type="text" size="30" name="nomeProjetos" id="nomeProjetos" class="campo" /></td>
		</tr>
		<tr>
			<td class="formTdEsquerdo">Cliente:</td>
			<td><?=$controlaProjetos->montaSelectClientes()?></td>
		</tr>
		<tr>
			<td colspan="2" align="center">
				<input type="button" name="<?=$dominio->botaoConfirmar?>" value="<?=$dominio->botaoConfirmar_TXT?>" title="<?=$dominio->botaoConfirmar_msg?>" class="botao" onclick="consultar()" />&nbsp;
				<input type="reset" name="<?=$dominio->botaoLimpar?>" value="<?=$dominio->botaoLimpar_TXT?>" title="<?=$dominio->botaoLimpar_msg?>" class="botao" />
			</td>
		</tr>
	</table>
	<input type="hidden" name="pagina" value="pesquisarProjetos" />
</form>
<div id="contentRetorno">
<table width="95%" border="0" cellpadding="1" cellspacing="0" class="tabelaListagem" align="center">
	<tr>
		<td class="tituloListagem" colspan="2">Nome do Projeto</td>
	</tr>
	<?=$controlaProjetos->mostraProjetos($projetosVo);?>
</table>
</div>
<?php
} 
elseif (!isset($_GET['pesquisa'])) 
{
	$projetosVo = new ProjetosVo();
	$destinatariosVo = new DestinatariosNaoConformidadesVo();
	$usuariosVo = new UsuariosVo();
	$modulosVo = new ModulosVo();
	$projetosModulosVo = new Projetos_ModulosVo();
	$controlaProjetos = new Controla_Projetos();
	$controlaUsuarios = new Controla_Usuarios();
	$controlaNaoConformidades = new Controla_NaoConformidades();
	$controlaModulos = new Controla_Modulos();
	$collVo_destinatarios = null;
	$collVo_projetosModulos = null;
	// Caso seja alteração
	if(isset($_GET['idProjetos']))
	{
		$projetosVo->setIdProjetos($_GET['idProjetos']);
		$collVo = $controlaProjetos->pesquisarProjetos($projetosVo);
		$projetosVo = (object) $collVo[0];
		
		// Pesquisa Destinatarios para este projeto
		$destinatariosVo->setIdProjetos($_GET['idProjetos']);
		$collVo_destinatarios = $controlaNaoConformidades->pesquisarDestinatariosNaoConformidades($destinatariosVo);
		
		//Pesquisa de Módulos do Projeto
		$projetosModulosVo->setIdProjetos($_GET['idProjetos']);
		$collVo_projetosModulos = $controlaProjetos->pesquisarProjetosModulos($projetosModulosVo);
	}
?>
<form action="#" method="POST" id="form1" name="form1">
	<table align="center" width="100%">
		<tr>
			<td width="25%" class="formTdEsquerdo">Nome do Projeto:<span class="asterisco"> *</span></td>
			<td colspan="2"><input type="text" name="nomeProjetos" id="nomeProjetos" size="20" value="<?=$projetosVo->getNomeProjetos()?>" class="campo"/></td>
		</tr>
		<tr>
			<td width="25%" class="formTdEsquerdo">Cliente:</td>
			<td colspan="2">
			<?=$controlaProjetos->montaSelectClientes($projetosVo->getIdClientes())?>
			</td>
		</tr>
		<tr>
			<td width="25%" class="formTdEsquerdo">Grupo de Fluxo:<span class="asterisco"> *</span></td>
			<td colspan="2">
			<?=$controlaProjetos->montaSelectGrupoFluxos($projetosVo->getIdGrupoFluxos(),'onChange="mostraFluxos(this)"')?>
			<div id="mostraFluxosSelecionados" style="display:none;"></div>
			</td>
		</tr>
		<tr>
			<td class="formTdEsquerdo">Módulos para este Projeto:</td>
			<td>
			<textarea cols="30" rows="4" readonly="readonly" id="modulosTXT" class="campo" name="modulosTXT"><?php 		
			for($i = 0; $i < count($collVo_projetosModulos); $i++)
			{
				$projetosModulosVo = (object) $collVo_projetosModulos[$i];
				$modulosVo->setIdModulos($projetosModulosVo->getIdModulos());
				$collVo_Modulos = $controlaModulos->pesquisaModulos($modulosVo);
				$modulosVo = (object) $collVo_Modulos[0];
				echo $modulosVo->getNomeModulos()."\n";
			}
			?></textarea><br>
			<a href="viewSelecionarModulos.php?KeepThis=true&TB_iframe=true&height=400&width=600" class="thickbox" title="Selecionar Módulos para o Projeto" id="destinatarios">Selecionar Módulos para o Projeto.</a></td>
		</tr>
		<tr>
			<td width="25%" class="formTdEsquerdo">Selecione o Papel e o Usuário para o papel:</td>
			<td colspan="2">
			<?=$controlaProjetos->montaSelectPapeis()?> - <?=$controlaProjetos->montaSelectUsuarios('selectUsuarios')?>
			<input type="button" value="<?=$dominio->botaoConfirmar_TXT?>" id="<?=$dominio->botaoConfirmar?>" class="botao" onclick="inserirPapeisUsuariosProjetos();"/>
			</td>
		</tr>
		<tr>
			<td width="25%" class="formTdEsquerdo">Papeis Selecionados:</td>
			<td colspan="2">
				<select name="papeisUsuariosProjetos_txt" id="papeisUsuariosProjetos_txt" size="5" multiple="multiple" class="campo">
				<?=$controlaProjetos->montaTextoPapeisUsuarios($projetosVo);?>
			    </select>
				<br />
				<a href="javascript:void(0);" onclick="removePapelUsuario();" title="Selecione o Papel/Usuário que deseja retirar da lista">Remover papel/Usuário da lista.</a><br>
				* Para remover o papel/usuário, selecione o papel/usuário e logo após click no link acima.
			</td>
		</tr>
		<tr>
			<td class="formTdEsquerdo">Usuários destinatários das não conformidades deste projeto:</td>
			<td>
			<textarea cols="30" rows="4" readonly="readonly" id="usuariosTXT" class="campo" name="usuariosTXT"><?php 		
			for($i = 0; $i < count($collVo_destinatarios); $i++)
			{
				$destinatariosVo = (object) $collVo_destinatarios[$i];
				$usuariosVo->setIdUsuarios($destinatariosVo->getIdUsuarios());
				$collVo_Usuarios = $controlaUsuarios->pesquisarUsuariosSistema($usuariosVo);
				$usuariosVo = (object) $collVo_Usuarios[0];
				echo $usuariosVo->getNomeUsuarios()."\n";
			}
			?></textarea><br>
			<a href="viewSelecionarUsuarios.php?KeepThis=true&TB_iframe=true&height=400&width=600" class="thickbox" title="Selecionar Usuários destinatários das não conformidades" id="destinatarios">Selecionar usuários à receber as não conformidades</a></td>
		</tr>
		<tr align="center">
			<td colspan="3" class="formTdCentro">
				<input type="button" value="<?=$dominio->botaoConfirmar_TXT?>" id="<?=$dominio->botaoConfirmar?>" class="botao" onclick="cadastrar()"/>
				&nbsp;
				<input type="button" value="<?=$dominio->botaoVoltar_TXT?>" id="<?=$dominio->botaoVoltar?>" class="botao" onClick="carregaPagina('viewProjetos.php','formulario')" />
			</td>
		</tr>
	</table>
	<input type="hidden" name="pagina" id="pagina" value="cadastrarProjetos"/>
	<input type="hidden" name="idProjetos" id="idProjetos" value="<?=$projetosVo->getIdProjetos()?>"/>
	<input type="hidden" name="idsPapeisProjetos" id="idsPapeisProjetos" value="
	<?
	if($projetosVo->getIdProjetos() != '')
	{
		$controlaProjetos->montaIdsPapeisUsuarios($projetosVo);
	}
	?>" />
	<input type="hidden" name="idUsuarios" id="idUsuarios" value="<?php
		//Caso seja alteração, carrega todas os usuários destinatários.
		$mostra = "";
		for($i = 0; $i < count($collVo_destinatarios); $i++)
		{
			if($mostra != "")
				$mostra = $mostra.";";
			$destinatariosVo = (object) $collVo_destinatarios[$i];
			$mostra = $mostra.$destinatariosVo->getIdUsuarios();
		}
		echo $mostra;
	?>"/>
	<input type="hidden" name="idModulos" id="idModulos" value="<?php
		//Caso seja alteração, carrega todas os módulos para o Projeto
		$mostra = "";
		for($i = 0; $i < count($collVo_projetosModulos); $i++)
		{
			if($mostra != "")
				$mostra = $mostra.";";
			$projetosModulosVo = (object) $collVo_projetosModulos[$i];
			$mostra = $mostra.$projetosModulosVo->getIdModulos();
		}
		echo $mostra;
	?>"/>
	<input type="hidden" name="funcionalidade" value="<?=basename(__FILE__)?>" />
</form>
<?php
}
?>