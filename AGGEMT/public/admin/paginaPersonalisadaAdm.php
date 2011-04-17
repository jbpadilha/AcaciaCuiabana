<?php 
include '../carregamentoInicial.php';
include_once( '../ckeditor/ckeditor_php5.php' ) ;
?>
<script type="text/javascript">
      function abaCadastra()
      {
    	  $('#cadastroClass').toggle();
      }
      function alterar(idpagina)
      {
      	var formulario = $('#deletaAltera').serialize(true);
      	carregaPagina('paginaPersonalisadaAdm.php?idpagina='+idpagina,'conteudo');
      }

      function deletar(idpagina)
      {
      	document.deletaAltera.funcao.value = "deletar";
      	document.deletaAltera.idpagina.value = idpagina;
      	var formulario = $('#deletaAltera').serialize(true);
      	enviaFormulario($('#deletaAltera').attr("action"),'conteudo',formulario);
      }
      function cadastra()
      {
      	if ( $('#nome').val() == '') {
      		alert('Todos campos obrigatórios devem ser preenchidos!');
      		return false;
      	} else {
      		$('#descricaopagina').val(CKEDITOR.instances.descricaopagina.getData());
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
	<input type="hidden" id="idpagina" name="idpagina" value=""/>
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
				<td><?=$paginas->getIdpagina()?></td>
				<td><?=$paginas->getNomepagina()?></td>
				<td width="31"><a href="javascript:void(0);" onclick="alterar(<?=$paginas->getIdpagina() ?>)"><img src="../images/botao_editar.gif" width="16" height="16" border="0" alt="Alterar"/></a></td>
  				<td width="20"><a href="javascript:void(0);" onclick="deletar(<?=$paginas->getIdpagina() ?>)"><img src="../images/botao_apagar.gif" width="16" height="16" border="0" alt="Deletar"/></a></td>
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
<div id="cadastroClass" <?php if (!isset($_GET['idpagina'])) echo "style=\"display:none;\"";?>>
<h3 class="t">Cadastro de Páginas</h3>
<?php 
$paginas = null;
$paginas = new Paginas();
if(isset($_GET['idpagina']))
{
	$paginas->reset();
	$paginas->setIdpagina($_GET['idpagina']);
	$paginas->find(true);
}

?>
<form name="cadastrar" id="cadastrar" method="post" action="../../application/recebePostGet.php">
	<input type="hidden" id="control" name="control" value="Paginas"/>
	<input type="hidden" id="funcao" name="funcao" value="<?=(isset($_GET['idpagina']))?"alterar":"cadastrar"?>"/>
	<input type="hidden" id="idpagina" name="idpagina" value="<?=$paginas->getIdpagina()?>"/>
	<table width="100%">
		<tr>
			<td valign="top"><p>Nome da Página*:</p></td>
			<td valign="top">
				<input type="text" id="nomepagina" name="nomepagina" value="<?=$paginas->getNomepagina()?>" size="60">
			</td>
		</tr>
		<tr>
			<td valign="top"><p>Descrição:</p></td>
			<td valign="top" colspan="2">
				<?php 
				$CKEditor = new CKEditor();
 				$CKEditor->editor("descricaopagina", $paginas->getDescricaopagina());
 				?>
			</td>
		</tr>
		<tr>
			<td colspan="3">
				* Campos Obrigatórios.<br>
				<input type="button" name="submit" id="submit" value="<?=(isset($_GET['idpagina']))?"Alterar":"Cadastrar"?>" onclick="cadastra();"/>
			</td>
		</tr>
	</table>
</form>
</div>
		