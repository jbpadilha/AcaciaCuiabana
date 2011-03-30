<?php
//####################################
// * Rafael Henrique Vieira de Moura /Desenvolvedor (Ábaco Tecnologia)
// * Arquivo: viewAnexos.php
// * Criação: Rafael Henrique Vieira de Moura
// * Revisão:
// * Data de criação: 11/07/2008
//####################################

/**
 * Página de Manter Anexos
 */

require("config.php");

if(!isset($_SESSION["usuario_Logado"]))
{
	header("Location:index.php");
}

if (isset($_GET['cadastro']))
{
	$descricao = htmlentities("Atualizar Cadastro de Anexo");
}
elseif (isset($_GET['pesquisa']))
{
	$descricao = htmlentities("Localizar Anexos");
}
else 
{
	$descricao = htmlentities("Anexos Cadastrados");
}
?>
<script type="text/javascript">
	function consultar(){
		var formulario = $('#formPesqAnexos').serialize(true);
		$('#conteudo').block({message:'<h4>Aguarde...</h4><br/><img src="./imagens/loading.gif" border="0" />'});
		$.post('class/ControlaPostGet.php',formulario,function(retorno){
			$('#conteudo').unblock();
			$('#contentRetorno').empty().html(retorno);
			$('#contentRetorno').slideDown('slow');
		})
	}
	function cadastrar(){
		var formulario = $('#cadastraAnexos').serialize(true);
		$('#conteudo').block({message:'<h4>Aguarde...</h4><br/><img src="./imagens/loading.gif" border="0" />'});
		$.post('class/ControlaPostGet.php',formulario,function(retorno){
			$('#conteudo').unblock();
			if(retorno == '1'){
				alert('Cadastrado com sucesso.');
				carregaPagina('viewAnexos.php','formulario');
			} else {
				$('.informacao').empty().html(retorno);
				$('.informacao').slideDown('slow');
			}
		})
	}
</script>
<h3><?=$descricao?></h3>
<div id="barra">
	<a href="javascript:void(0)" title="Cadastrar Novo Anexo" onclick="carregaPagina('viewAnexos.php?cadastro=true','formulario');"><img src="imagens/ico_novo.jpg" border="0"  />&nbsp;&nbsp;Novo Anexo&nbsp;&nbsp;|&nbsp;&nbsp;</a>
	<a href="javascript:void(0)" title="Localizar Anexos" onclick="carregaPagina('viewAnexos.php','formulario');"><img src="imagens/ico_localizar.gif" border="0"  />&nbsp;&nbsp;Localizar Anexos&nbsp;&nbsp;|&nbsp;&nbsp;</a>
</div>
<br />
<div class="informacao" style="display:none"></div>
<?php
if (!isset($_GET['cadastro'])){
?>
<form method="post" id="formPesqAnexos" action="#" onsubmit="return false">
	<table align="center">
		<tr>
			<td colspan="3" align="center"><strong>Pesquisa de Anexos</strong></td>
		</tr>
		<tr>
			<td class="formTdEsquerdo">Nome</td>
			<td><input type="text" size="30" name="nomeAnexos" id="nomeAnexos" class="campo" /></td>
		</tr>
		<tr>
			<td colspan="2" align="center">
				<input type="button" name="<?=$dominio->botaoConfirmar?>" value="<?=$dominio->botaoConfirmar_TXT?>" title="<?=$dominio->botaoConfirmar_msg?>" class="botao" onclick="consultar()" />&nbsp;
				<input type="reset" name="<?=$dominio->botaoLimpar?>" value="<?=$dominio->botaoLimpar_TXT?>" title="<?=$dominio->botaoLimpar_msg?>" class="botao" />
			</td>
		</tr>
	</table>
	<input type="hidden" name="pagina" value="pesquisaAnexos" />
</form>
<br />
<div id="contentRetorno">
<?php
	$anexosVo = new AnexosVo();
	$controlaAnexos = new Controla_Anexos();
	$controlaAnexos->mostraListaAnexos($anexosVo);
?>
</div>
<?php
} else {
	$anexosVo = new AnexosVo();
	
	if (isset($_GET['id'])) {
		$anexosVo->setIdAnexos(strip_tags($_GET['id']));
		$controlaAnexos = new Controla_Anexos();
		$collVo = $controlaAnexos->pesquisaAnexos($anexosVo);
		$anexosVo = (object) $collVo[0];
	}
?>
<form action="#" id="cadastraAnexos" name="cadastraAnexos" method="post" enctype="multipart/form-data" onsubmit="return false">
	<table align="center">
		<tr>
			<td class="formTdEsquerdo">Nome <span class="asterisco">*</span></td>
			<td><input type="text" size="30" name="nomeAnexos" id="nomeAnexos" class="campo" value="<?=$anexosVo->getNomeAnexos()?>" /></td>
		</tr>
		<tr>
			<td class="formTdEsquerdo">Descrição</td>
			<td>
				<textarea cols="30" rows="4" name="descricaoAnexos" class="campo"><?=$anexosVo->getDescricaoAnexos()?></textarea>
			</td>
		</tr>
		<tr>
			<td class="formTdEsquerdo">Arquivo <span class="asterisco">*</span></td>
			<td>
				<?php
				if ($anexosVo->getIdAnexos() != '') {
					echo '<div id="fileUploaded" name="fileUploaded"><a href="'.$anexosVo->getCaminhoAnexos().'" target="_blank" title="Ver arquivo deste anexo">Arquivo cadastrado atualmente</a></div>';
				} else {
					echo '<div id="fileUploaded" name="fileUploaded"></div>';
				}
				?>
				<a href="viewUploadFile.php?id=<?=$anexosVo->getIdAnexos()?>&arquivo=<?=$anexosVo->getCaminhoAnexos()?>&KeepThis=true&TB_iframe=true&height=150&width=350" class="thickbox" title="Selecionar arquivo para o anexo">Selecionar <?=($anexosVo->getIdAnexos()!='')?"outro ":""?>arquivo para anexo</a>
			</td>
		</tr>
		<?php
		if ($anexosVo->getIdAnexos() != '') {
		?>
		<tr>
			<td class="formTdEsquerdo">Data de Inclusão</td>
			<td><?=$converte->toViewDate($anexosVo->getDataInclusaoAnexos())?></td>
		</tr>
		<?php
		}
		?>
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
	<input type="text" id="caminhoAnexos" name="caminhoAnexos" value="<?=$anexosVo->getCaminhoAnexos()?>" readonly style="display:none" />
	<!--<input type="hidden" name="caminhoAnexos" id="caminhoAnexos" value="<?=$anexosVo->getCaminhoAnexos()?>" />-->
	<input type="hidden" name="idAnexos" id="idAnexos" value="<?=$anexosVo->getIdAnexos()?>" />
	<input type="hidden" name="dataInclusaoAnexos" id="dataInclusaoAnexos" value="<?=$anexosVo->getDataInclusaoAnexos()?>" />
	<input type="hidden" name="pagina" id="pagina" value="cadastraAnexos" />
	<input type="hidden" name="funcionalidade" value="<?=basename(__FILE__)?>" />
</form>
<?php
}
?>