<?php 
include '../carregamentoInicial.php';
?>
<script type="text/javascript">

      function abaCadastra()
      {
    	  $('#cadastroClass').toggle();
      }
      function alterar(idbanner)
      {
      	var formulario = $('#deletaAltera').serialize(true);
      	carregaPagina('bannersAdm.php?idbanner='+idbanner,'conteudo');
      }

      function deletar(idbanner)
      {
      	document.deletaAltera.funcao.value = "deletar";
      	document.deletaAltera.idbanner.value = idbanner;
      	var formulario = $('#deletaAltera').serialize(true);
      	enviaFormulario($('#deletaAltera').attr("action"),'conteudo',formulario);
      }
      function cadastra()
      {
      	if ( $('#nomebanner').val() == '') {
      		alert('Todos campos obrigatórios devem ser preenchidos!');
      		return false;
      	} else {
      		$('#cadastrar').submit();
      	}
      }
</script>
<table>
	<tr>
		<td class="tituloAdm">Cadastro de Banner</td>
	</tr>
</table>
<br>
<br>


<form name="deletaAltera" id="deletaAltera" method="post" action="../../application/recebePostGet.php" >
	<input type="hidden" id="control" name="control" value="Banners"/>
	<input type="hidden" id="funcao" name="funcao" value=""/>
	<input type="hidden" id="idbanner" name="idbanner" value=""/>
	<table width="100%">
		<tr>
			<td class="titulo" colspan="5">Banners Cadastrados</td>
		</tr>
		<tr>
			<td>id</td>
			<td>Nome do Banner:</td>
			<td>Status do Banner</td>
			<td colspan="2">Ações</td>
		</tr>
		<?php  
		$banners = null;
		$banners = new Banners();
		$banners->reset();
		if($banners->find()>0)
		{
			while($banners->fetch())
			{
			?>
			<tr>
				<td><?=$banners->getIdbanner()?></td>
				<td><?=$banners->getNomebanner()?></td>
				<td><?=($banners->getStatusbanner())? "Ativo" : "Inativo"?></td>
				<td width="31"><a href="javascript:void(0);" onclick="alterar(<?=$banners->getIdbanner() ?>)"><img src="../images/botao_editar.gif" width="16" height="16" border="0" alt="Alterar"/></a></td>
  				<td width="20"><a href="javascript:void(0);" onclick="deletar(<?=$banners->getIdbanner() ?>)"><img src="../images/botao_apagar.gif" width="16" height="16" border="0" alt="Deletar"/></a></td>
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
			<td colspan="5">Não existem banners cadastrados.</td>
		</tr>
	<?php 
	}
	?>
</table>
</form>
<?php 
?>
<input type="button" id="btCadastra" value="Cadastrar" onclick="abaCadastra();">
<div id="cadastroClass" <?php if (!isset($_GET['idbanner'])) echo "style=\"display:none;\"";?>>
<h3 class="t">Cadastro de Banner</h3>
<?php 
$banners = null;
$banners = new Banners();
if(isset($_GET['idbanner']))
{
	$banners->setIdbanner($_GET['idbanner']);
	$banners->find(true);
}

?>
<form name="cadastrar" id="cadastrar" method="post" action="../../application/recebePostGet.php" enctype="multipart/form-data" >
	<input type="hidden" id="control" name="control" value="Banners"/>
	<input type="hidden" id="funcao" name="funcao" value="<?=(isset($_GET['idbanner']))?"alterar":"cadastrar"?>"/>
	<input type="hidden" id="idbanner" name="idbanner" value="<?=$banners->getIdbanner()?>"/>
	<table width="100%">
		<tr>
			<td valign="top"><p>Nome do Banner*:</p></td>
			<td valign="top" colspan="2"><input type="text" id="nomebanner" name="nomebanner" value="<?=$banners->getNomebanner()?>" size="60"></td>
		</tr>
		<tr>
			<td valign="top"><p>Arquivo:</p></td>
			<td valign="top">
				<input type="file" name="imagem" id="imagem" class="input">
			</td>
		</tr>
		<?php 
		if($banners->getCaminhobanner()!=null)
		{
		?>
		<tr>
			<td valign="top">Arquivo Cadastrado:</td>
			<td valign="top">
				<a href="<?=PROJETO_CONTEXT?>public/images/<?=$banners->getCaminhobanner()?>" target="_blank">Download Aqui</a>
			</td>
		</tr>
		<?php 
		}
		?>
		<tr>
			<td valign="top">Status do Banner</td>
			<td valign="top">
				<select id="statusbanner" name="statusbanner">
					<option value="1" <?=($banners->getStatusbanner() == 1) ? "selected":""?>>Ativo</option>
					<option value="0" <?=($banners->getStatusbanner() == 0) ? "selected":""?>>Inativo</option>
				</select>
			</td>
		</tr>
		<tr>
			<td colspan="3">
				* Campos Obrigatórios.<br>
				<input type="submit" name="submit" id="submit" value="<?=(isset($_GET['idbanner']))?"Alterar":"Cadastrar"?>"/>
			</td>
		</tr>
	</table>
</form>
</div>
		