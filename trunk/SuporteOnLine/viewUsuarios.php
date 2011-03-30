<?php
//####################################
// * Rafael Henrique Vieira de Moura / Desenvolvedor (Ábaco Tecnologia)
// * Arquivo: Login.php
// * Criação: Rafael Henrique Vieira de Moura
// * Revisão:
// * Data de criação: 07/07/2008
//####################################
/**
 * Página de Manter Usuários do Sistema
 */
require("config.php");

if(!isset($_SESSION["usuario_Logado"]))
{
	header("Location:index.php");
}

if (isset($_GET['cadastro']))
{
	$descricao = htmlentities("Cadastro de Usuário");
}
elseif (isset($_GET['pesquisa']))
{
	$descricao = htmlentities("Localizar Usuários");
}
else 
{
	$descricao = htmlentities("Usuários Cadastrados");
}

$controla_Permissao = new Controla_Permissao();

?>
<script type="text/javascript">
	function consultar(){
		var formulario = $('#formPesqUsuarios').serialize(true);
		$('#conteudo').block({message:'<h4>Aguarde...</h4><br/><img src="./imagens/loading.gif" border="0" />'});
		$.post('class/ControlaPostGet.php',formulario,function(retorno){
			$('#conteudo').unblock();
			$('#contentRetorno').empty().html(retorno);
			$('#contentRetorno').slideDown('slow');
		})
	}
	function cadastrar(){
		var formulario = $('#form1').serialize(true);
		$('#conteudo').block({message:'<h4>Aguarde...</h4><br/><img src="./imagens/loading.gif" border="0" />'});
		$.post('class/ControlaPostGet.php',formulario,function(retorno){
			$('#conteudo').unblock();
			if(retorno == '1'){
				alert('Cadastrado com sucesso.');
				carregaPagina('viewUsuarios.php','formulario');
			} else {
				$('.informacao').empty().html(retorno);
				$('.informacao').slideDown('slow');
			}
		})
	}
</script>
<h3><?=$descricao?></h3>
<?php
if($controla_Permissao->verificaPermissaoPorUsuarioEFuncionalidade($_SESSION['id_Usuario'],basename(__FILE__)))
{
?>
<div id="barra">
	<a href="javascript:void(0)" onclick="carregaPagina('viewUsuarios.php?cadastro=true','formulario')" title="Cadastrar Novo Usu&aacute;rio"><img src="imagens/ico_novo.jpg" border="0"  />&nbsp;&nbsp;Novo Usu&aacute;rio&nbsp;&nbsp;|&nbsp;&nbsp;</a>
	<a href="javascript:void(0)" onclick="carregaPagina('viewUsuarios.php','formulario')" title="Localizar Usu&aacute;rios" ><img src="imagens/ico_localizar.gif" border="0"  />&nbsp;&nbsp;Localizar Usu&aacute;rios&nbsp;&nbsp;|&nbsp;&nbsp;</a>
</div>
<?php
}
?>
<br />
<div class="informacao" style="display:none"></div>
<?php
if (!isset($_GET['cadastro'])){
?>
<form method="post" id="formPesqUsuarios" action="#" onsubmit="return false">
	<table align="center">
		<tr>
			<td colspan="3" align="center"><strong>Pesquisa de Usuários</strong></td>
		</tr>
		<tr>
			<td class="formTdEsquerdo">Nome</td>
			<td><input type="text" size="30" name="nomeUsuarios" id="nomeUsuarios" class="campo" /></td>
		</tr>
		<tr>
			<td class="formTdEsquerdo">Suspenso</td>
			<td>
				<input type="radio" name="flagSuspenso" id="flagSuspenso" value="1" class="campo" />Sim&nbsp;
				<input type="radio" name="flagSuspenso" id="flagSuspenso" value="0" class="campo" />Não
			</td>
		</tr>
		<tr>
			<td colspan="2" align="center">
				<input type="button" name="<?=$dominio->botaoConfirmar?>" value="<?=$dominio->botaoConfirmar_TXT?>" title="<?=$dominio->botaoConfirmar_msg?>" class="botao" onclick="consultar()" />&nbsp;
				<input type="reset" name="<?=$dominio->botaoLimpar?>" value="<?=$dominio->botaoLimpar_TXT?>" title="<?=$dominio->botaoLimpar_msg?>" class="botao" />
			</td>
		</tr>
	</table>
	<input type="hidden" name="pagina" value="pesquisaUsuario" />
</form>
<br />
<div id="contentRetorno">
<table width="95%" border="0" cellpadding="1" cellspacing="0" class="tabelaListagem" align="center">
	<tr>
		<td class="tituloListagem">Nome</td>
		<td class="tituloListagem" colspan="2">Login</td>
	</tr>
	<?php
		$controlaUsuarios = new Controla_Usuarios();
		$controlaUsuarios->mostraUsuariosSistema();
	?>
</table>
<table width="95%" border="0" align="center">
	<tr>
		<td colspan="3" align="right"><img src="<?=PATH?>/imagens/marcador_vermelho.gif" alt="" /> Usu&aacute;rios suspensos</td>
	</tr>
</table>
</div>
<?php
} elseif (!isset($_GET['pesquisa'])) {
	$usuariosVo = new UsuariosVo();
		
	if (isset($_GET['id'])) {
		$controla_Permissao = new Controla_Permissao();
		$permissaoVo = new Permissao_Usuarios_Funcionalidades_PapeisVo();
		$controlaClientes = new Controla_Clientes();
		
		$usuariosVo->setIdUsuarios(strip_tags($_GET['id']));
		
		$controlaUsuarios = new Controla_Usuarios();
		$collVo = $controlaUsuarios->pesquisarUsuariosSistema($usuariosVo);
		$usuariosVo = (object) $collVo[0];
		
		// Pesquisa Funcionalidades para esse usuario
		$permissaoVo->setIdUsuarios($usuariosVo->getIdUsuarios());
		$collVo_Permissao = $controla_Permissao->buscaPermissoesSemMensagem($permissaoVo);
		if($usuariosVo->getDataNascimentoUsuarios() != '' || $usuariosVo->getDataNascimentoUsuarios() != '0000-00-00')
			$dataNascimentoUsuarios = $converte->toViewDate($usuariosVo->getDataNascimentoUsuarios());
	}
?>
<form action="#" id="form1" name="form1" method="post" onsubmit="return false">
	<table align="center">
		<tr>
			<td class="formTdEsquerdo">Nome <span class="asterisco">*</span></td>
			<td><input type="text" size="30" name="nomeUsuarios" id="nomeUsuarios" class="campo" value="<?=$usuariosVo->getNomeUsuarios()?>" /></td>
		</tr>
		<tr>
			<td class="formTdEsquerdo">Login <span class="asterisco">*</span></td>
			<td><input type="text" size="20" name="loginUsuarios" id="loginUsuarios" class="campo" value="<?=$usuariosVo->getLoginUsuarios()?>" /></td>
		</tr>
		<?php
			if ($usuariosVo->getIdUsuarios() != '') {
		?>
		<tr>
			<td class="formTdEsquerdo">Senha</td>
			<td><a href="viewAlterarSenhaUsuarios.php?id=<?=$usuariosVo->getIdUsuarios()?>&KeepThis=true&TB_iframe=true&height=150&width=300" class="thickbox" title="Alterar Senha">Alterar Senha</a></td>
		</tr>
		<?php
			} else {
		?>
		<tr>
			<td class="formTdEsquerdo">Senha <span class="asterisco">*</span></td>
			<td><input type="password" size="20" name="senhaUsuarios" id="senhaUsuarios" class="campo" /></td>
		</tr>
		<?php
			}
		?>
		<tr>
			<td class="formTdEsquerdo">E-mail <span class="asterisco">*</span></td>
			<td><input type="text" size="30" name="emailUsuarios" id="emailUsuarios" class="campo" value="<?=$usuariosVo->getEmailUsuarios()?>" /></td>
		</tr>
		<tr>
			<td class="formTdEsquerdo">Endere&ccedil;o</td>
			<td><input type="text" size="30" name="enderecoUsuarios" id="enderecoUsuarios" class="campo" value="<?=$usuariosVo->getEnderecoUsuarios()?>" /></td>
		</tr>
		<tr>
			<td class="formTdEsquerdo">CEP</td>
			<td><input type="text" size="12" maxlength="9" name="cepUsuarios" id="cepUsuarios" class="campo" value="<?=$usuariosVo->getCepUsuarios()?>" /></td>
		</tr>
		<tr>
			<td class="formTdEsquerdo">Cidade</td>
			<td><input type="text" size="30" name="cidadeUsuarios" id="cidadeUsuarios" class="campo" value="<?=$usuariosVo->getCidadeUsuarios()?>" /></td>
		</tr>
		<tr>
			<td class="formTdEsquerdo">Telefone</td>
			<td><input type="text" size="15" maxlength="13" name="telUsuarios" id="telUsuarios" class="campo" value="<?=$usuariosVo->getTelUsuarios()?>" /></td>
		</tr>
		<tr>
			<td class="formTdEsquerdo">Tel. Celular</td>
			<td><input type="text" size="15" maxlength="13" name="telCelUsuarios" id="telCelUsuarios" class="campo" value="<?=$usuariosVo->getTelCelUsuarios()?>" /></td>
		</tr>
		<tr>
			<td class="formTdEsquerdo">Data Nascimento</td>
			<td><input type="text" size="12" maxlength="10" name="dataNascimentoUsuarios" id="dataNascimentoUsuarios" class="campo" value="<?=$dataNascimentoUsuarios?>" /></td>
		</tr>
		<?php
		if($controla_Permissao->verificaPermissaoPorUsuarioEFuncionalidade($_SESSION['id_Usuario'],basename(__FILE__)))
		{
		?>
		<tr>
			<td class="formTdEsquerdo">Suspenso</td>
			<td>
				<input type="radio" name="flagSuspenso" id="flagSuspenso" value="1" class="campo" <?=($usuariosVo->getFlagSuspenso() == 1) ? "checked" : ""?> />Sim&nbsp;
				<input type="radio" name="flagSuspenso" id="flagSuspenso" value="0" class="campo" <?=($usuariosVo->getFlagSuspenso() == 0 || $usuariosVo->getFlagSuspenso() == '') ? "checked" : ""?> />Não
			</td>
		</tr>
		<tr>
			<td class="formTdEsquerdo">Usuário Tipo</td>
			<td><input type="radio" name="flagTipoUsuario" id="radio" value="1" class="campo" <?=($usuariosVo->getFlagTipoUsuario() == 1 || $usuariosVo->getFlagTipoUsuario() == '') ? "checked" : ""?> />
			  Interno&nbsp;
              <input type="radio" name="flagTipoUsuario" id="radio" value="0" class="campo" <?=($usuariosVo->getFlagTipoUsuario() == 0) ? "checked" : ""?> />
            Externo</td>
		</tr>
		<tr>
			<td class="formTdEsquerdo">Permissões</td>
			<td>
				<textarea cols="30" rows="4" disabled="disabled" id="funcionalidades_txt" class="campo"><?php
				$controlaFuncionalidades = new Controla_Funcionalidades();
				for($i = 0; $i < count($collVo_Permissao); $i++)
				{
					$permissaoVo = (object) $collVo_Permissao[$i];
					$funcionalidadesVo = new FuncionalidadesVo();
					$funcionalidadesVo->setIdFuncionalidades($permissaoVo->getIdFuncionalidades());
					$retornoFuncionalidadeDominio = $dominio->retornaDomnFunctionalidades($funcionalidadesVo->getIdFuncionalidades());
					if($retornoFuncionalidadeDominio == '')
					{
						$collVo_Funcionalidades = $controlaFuncionalidades->pesquisarFuncionalidades($funcionalidadesVo);
						$funcionalidadesVo = (object) $collVo_Funcionalidades[0];
					}
					else
					{
						$funcionalidadesVo->setNomeFuncionalidades($retornoFuncionalidadeDominio);
					}
					print $funcionalidadesVo->getNomeFuncionalidades()."\n";
				}
				?>
				</textarea><br />
				<a href="viewSelecionarFuncionalidades.php?KeepThis=true&TB_iframe=true&height=400&width=600" class="thickbox" title="Selecionar Permissões" id="permissoes">Selecionar permissões para funcionalidades</a>
			</td>
		</tr>
		<?php
		}
		?>
		<tr>
			<td colspan="3">&nbsp;</td>
		</tr>
		<tr>
			<td colspan="2" align="center">
				<input type="button" name="<?=$dominio->botaoConfirmar?>" value="<?=$dominio->botaoConfirmar_TXT?>" title="<?=$dominio->botaoConfirmar_msg?>" class="botao" onclick="cadastrar()" />&nbsp;
				<?php
				if ($usuariosVo->getIdUsuarios() == ''){
				?>
				<input type="reset" name="<?=$dominio->botaoLimpar?>" value="<?=$dominio->botaoLimpar_TXT?>" title="<?=$dominio->botaoLimpar_msg?>" class="botao" />
				<?php
				} else {
				?>
				<input type="button" name="<?=$dominio->botaoVoltar?>" value="<?=$dominio->botaoVoltar_TXT?>" title="<?=$dominio->botaoVoltar_msg?>" class="botao" onclick="carregaPagina('viewUsuarios.php','formulario')" />
				<?php
				}
				?>
			</td>
		</tr>
	</table>
	<input type="hidden" name="idUsuarios" value="<?=$usuariosVo->getIdUsuarios()?>" />
	<input type="hidden" name="idClientes" value="
	<?php
		//Caso seja alteração, carrega todas as clientes cadastrados.
		$mostra = "";
		for($i = 0; $i < count($collVo_Clientes); $i++)
		{
			if($mostra != "")
				$mostra = $mostra.";";
			$usuarios_ClientesVo = (object) $collVo_Clientes[$i];
			$mostra = $mostra.$usuarios_ClientesVo->getIdClientes();
		}
		echo $mostra;
	?>
	" />
	<input type="hidden" name="idFuncionalidades" value="
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
	" />
	<input type="hidden" name="pagina" value="cadastraUsuario" />
	<input type="hidden" name="funcionalidade" value="<?=basename(__FILE__)?>" />
</form>
<script type="text/javascript">
	$(document).ready(function(){
		$("#cepUsuarios").mask("99999-999");
		$("#telUsuarios").mask("(99)9999-9999");
		$("#telCelUsuarios").mask("(99)9999-9999");
		$("#dataNascimentoUsuarios").mask("99/99/9999");
	});
</script>
<?php
}
?>