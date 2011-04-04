<?php 
include '../carregamentoInicial.php';
?>
<script type="text/javascript">
      function abaCadastra()
      {
    	  $('#cadastroClass').toggle();
      }
      function alterar(idlinksuteis)
      {
      	var formulario = $('#deletaAltera').serialize(true);
      	carregaPagina('linksuteisAdm.php?idlinksuteis='+idlinksuteis,'conteudo');
      }

      function deletar(idlinksuteis)
      {
      	document.deletaAltera.funcao.value = "deletar";
      	document.deletaAltera.idlinksuteis.value = idlinksuteis;
      	var formulario = $('#deletaAltera').serialize(true);
      	enviaFormulario($('#deletaAltera').attr("action"),'conteudo',formulario);
      }
      function cadastra()
      {
      	if ( $('#descricaolinksuteis').val() == '' && $('#link').val() == '') {
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
		<td class="tituloAdm">Cadastro de Links</td>
	</tr>
</table>
<br>
<br>


<form name="deletaAltera" id="deletaAltera" method="post" action="../../application/recebePostGet.php" >
	<input type="hidden" id="control" name="control" value="LinkUteis"/>
	<input type="hidden" id="funcao" name="funcao" value=""/>
	<input type="hidden" id="idlinksuteis" name="idlinksuteis" value=""/>
	<table width="100%">
		<tr>
			<td class="titulo" colspan="5">Links Úteis Cadastradas</td>
		</tr>
		<tr>
			<td>id</td>
			<td>Descricao</td>
			<td colspan="2">Ações</td>
		</tr>
		<?php  
		$linksUteis = null;
		$linksUteis = new Linksuteis();
		$linksUteis->reset();
		if($linksUteis->find()>0)
		{
			while($linksUteis->fetch())
			{
			?>
			<tr>
				<td><?=$linksUteis->getIdlinksuteis()?></td>
				<td><?=$linksUteis->getDescricaolinksuteis()?></td>
				<td width="31"><a href="javascript:void(0);" onclick="alterar(<?=$linksUteis->getIdlinksuteis() ?>)"><img src="../images/botao_editar.gif" width="16" height="16" border="0" /></a></td>
  				<td width="20"><a href="javascript:void(0);" onclick="deletar(<?=$linksUteis->getIdlinksuteis() ?>)"><img src="../images/botao_apagar.gif" width="16" height="16" border="0" /></a></td>
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
			<td colspan="5">Não existem links cadastrados.</td>
		</tr>
	<?php 
	}
	?>
</table>
</form>
<?php 
?>
<input type="button" id="btCadastra" value="Cadastrar" onclick="abaCadastra();">
<div id="cadastroClass" <?php if (!isset($_GET['idlinksuteis'])) echo "style=\"display:none;\"";?>>
<h3 class="t">Cadastro de Links</h3>
<?php 
$linksUteis = null;
$linksUteis = new Linksuteis();
if(isset($_GET['idlinksuteis']))
{
	$linksUteis->reset();
	$linksUteis->setIdlinksuteis($_GET['idlinksuteis']);
	$linksUteis->find(true);
}

?>
<form name="cadastrar" id="cadastrar" method="post" action="../../application/recebePostGet.php">
	<input type="hidden" id="control" name="control" value="LinkUteis"/>
	<input type="hidden" id="funcao" name="funcao" value="<?=(isset($_GET['idlinksuteis']))?"alterar":"cadastrar"?>"/>
	<input type="hidden" id="idlinksuteis" name="idlinksuteis" value="<?=$linksUteis->getIdlinksuteis()?>"/>
	<table width="100%">
		<tr>
			<td valign="top"><p>Descrição do Link*:</p></td>
			<td valign="top">
				<input type="text" id="descricaolinksuteis" name="descricaolinksuteis" value="<?=$linksUteis->getDescricaolinksuteis()?>" size="60">
			</td>
		</tr>
		<tr>
			<td valign="top"><p>Link*:</p></td>
			<td valign="top">
				<input type="text" id="link" name="link" value="<?=$linksUteis->getLink()?>" size="60">
			</td>
		</tr>
		<tr>
			<td colspan="3">
				* Campos Obrigatórios.<br>
				<input type="button" name="submit" id="submit" value="<?=(isset($_GET['idlinksuteis']))?"Alterar":"Cadastrar"?>" onclick="cadastra();"/>
			</td>
		</tr>
	</table>
</form>
</div>
		