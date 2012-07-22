<?php 
include '../carregamentoInicial.php';
?>
<script type="text/javascript">
      function abaCadastra()
      {
    	  $('#cadastroClass').toggle();
      }
      function alterar(idPagina)
      {
      	var formulario = $('#deletaAltera').serialize(true);
      	carregaPagina('paginaPersonalisadaAdm.php?idPagina='+idPagina,'conteudo');
      }

      function deletar(idPagina)
      {
      	document.deletaAltera.funcao.value = "deletar";
      	document.deletaAltera.idPagina.value = idPagina;
      	var formulario = $('#deletaAltera').serialize(true);
      	enviaFormulario($('#deletaAltera').attr("action"),'conteudo',formulario);
      }
      function cadastra()
      {
      	if ( $('#nome').val() == '') {
      		alert('Todos campos obrigatórios devem ser preenchidos!');
      		return false;
      	} else {
      		var formulario = $('#cadastrar').serialize(true);
      		enviaFormulario($('#cadastrar').attr("action"),'conteudo',formulario);
      	}
      }
</script>
<table>
	<tr>
		<td class="tituloAdm">Cadastro de Páginas Personalisadas</td>
	</tr>
</table>
<br>
<br>


<form name="deletaAltera" id="deletaAltera" method="post" action="../../application/recebePostGet.php" >
	<input type="hidden" id="control" name="control" value="Paginas"/>
	<input type="hidden" id="funcao" name="funcao" value=""/>
	<input type="hidden" id="idPagina" name="idPagina" value=""/>
	<table width="100%">
		<tr>
			<td class="titulo" colspan="5">Páginas Cadastradas</td>
		</tr>
		<tr>
			<td>id</td>
			<td>Nome</td>
			<td colspan="2">Ações</td>
		</tr>
		<?php  
		$paginas = null;
		$paginas = new Paginas();
		$paginas->reset();
		$paginas->limit();
		if($paginas->find()>0)
		{
			while($paginas->fetch())
			{
			?>
			<tr>
				<td><?=$paginas->getIdPagina()?></td>
				<td><?=$paginas->getNomePagina()?></td>
				<td width="31"><a href="javascript:void(0);" onclick="alterar(<?=$paginas->getIdPagina() ?>)"><img src="../images/botao_editar.gif" width="16" height="16" border="0" alt="Alterar"/></a></td>
  				<td width="20"><a href="javascript:void(0);" onclick="deletar(<?=$paginas->getIdPagina() ?>)"><img src="../images/botao_apagar.gif" width="16" height="16" border="0" alt="Deletar"/></a></td>
			</tr>
			<?
			}
		
		}
		else
		{
		?>
		<tr>
			<td colspan="5"></td>
		</tr>
		<tr>
			<td colspan="5">Não existem páginas cadastradas.</td>
		</tr>
	<?php 
	}
	?>
</table>
</form>
<?php 
?>
<input type="button" id="btCadastra" value="Cadastrar" onclick="abaCadastra();">
<div id="cadastroClass" <?php if (!isset($_GET['idPagina'])) echo "style=\"display:none;\"";?>>
<h3 class="t">Cadastro de Páginas</h3>
<?php 
$paginas = null;
$paginas = new Paginas();
if(isset($_GET['idPagina']))
{
	$paginas->reset();
	$paginas->setIdPagina($_GET['idPagina']);
	$paginas->find(true);
}

?>
<form name="cadastrar" id="cadastrar" method="post" action="../../application/recebePostGet.php">
	<input type="hidden" id="control" name="control" value="Paginas"/>
	<input type="hidden" id="funcao" name="funcao" value="<?=(isset($_GET['idPagina']))?"alterar":"cadastrar"?>"/>
	<input type="hidden" id="idPagina" name="idPagina" value="<?=$paginas->getIdPagina()?>"/>
	<table width="100%">
		<tr>
			<td valign="top"><p>Nome da Página*:</p></td>
			<td valign="top">
				<input type="text" id="nomePagina" name="nomePagina" value="<?=$paginas->getNomePagina()?>" size="60">
			</td>
		</tr>
		<tr>
			<td valign="top"><p>Conteudo:</p></td>
			<td valign="top" colspan="2">
 				<textarea readonly="readonly" name="conteudoPagina" cols="50" rows="6" id="conteudoPagina" onfocus="javascript:document.forms[1].Submit.focus();" title="Para editar o conteúdo da página, precione no botão Editar Campo, ao lado."><?=$paginas->getConteudoPagina()?></textarea>
				<input name="Submit2" type="button" class="botao" value="Editar Campo" onclick="javascript:abrepagina('editorHtml.php?nomeExibicaoCampo=Conteúdo da Página&formulario=cadastrar&campo=conteudoPagina',750,400);"/>
			</td>
		</tr>
		<tr>
			<td colspan="3">
				* Campos Obrigatórios.<br>
				<input type="button" name="submit" id="submit" value="<?=(isset($_GET['idPagina']))?"Alterar":"Cadastrar"?>" onclick="cadastra();"/>
			</td>
		</tr>
	</table>
</form>
</div>
		