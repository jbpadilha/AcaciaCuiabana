<?php 
include '../carregamentoInicial.php';
?>
<script type="text/javascript">
		Calendar.setup({
	    inputField : "dataGaleria",
	    trigger    : "f_btn1",
	    onSelect   : function() { this.hide() },
	    dateFormat : "%d/%m/%Y %H:%M:%S",
	    showTime: 24
	  });
	  $("#dataGaleria").mask("99/99/9999 99:99:99");
      function abaCadastra()
      {
    	  $('#cadastroClass').toggle();
    	  $("#deletaAltera").each(function(){
              this.reset();
          });
      }
      function alterar(idGaleria)
      {
      	var formulario = $('#deletaAltera').serialize(true);
      	carregaPagina('galeriasAdm.php?idGaleria='+idGaleria,'conteudo');
      }

      function deletar(idGaleria)
      {
      	document.deletaAltera.funcao.value = "deletar";
      	document.deletaAltera.idGaleria.value = idGaleria;
      	var formulario = $('#deletaAltera').serialize(true);
      	enviaFormulario($('#deletaAltera').attr("action"),'conteudo',formulario);
      }
</script>
<table>
	<tr>
		<td class="tituloAdm">Cadastro de Galeria de Fotos</td>
	</tr>
</table>
<br>
<br>


<form name="deletaAltera" id="deletaAltera" method="post" action="../../application/recebePostGet.php" >
	<input type="hidden" id="control" name="control" value="Galerias"/>
	<input type="hidden" id="funcao" name="funcao" value=""/>
	<input type="hidden" id="idGaleria" name="idGaleria" value=""/>
	<table width="100%">
		<tr>
			<td class="titulo" colspan="5">Galerias Cadastradas</td>
		</tr>
		<tr bgcolor="#FFFF99">
			<td>id</td>
			<td>Nome</td>
			<td colspan="2">Ações</td>
		</tr>
		<?php  
		$galerias = new Galerias();
		$galerias->reset();
		if($galerias->find()>0)
		{
			while($galerias->fetch())
			{
			?>
			<tr>
				<td><?=$galerias->getIdGaleria()?></td>
				<td><?=$galerias->getNomeGaleria()?></td>
				<td width="31"><a href="javascript:void(0);" onclick="alterar(<?=$galerias->getIdGaleria() ?>)"><img src="../images/botao_editar.gif" width="16" height="16" border="0" alt="Alterar" /></a></td>
  				<td width="20"><a href="javascript:void(0);" onclick="deletar(<?=$galerias->getIdGaleria() ?>)"><img src="../images/botao_apagar.gif" width="16" height="16" border="0" alt="Deletar" /></a></td>
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
			<td colspan="5">Não existem galerias cadastradas.</td>
		</tr>
	<?php 
	}
	?>
</table>
</form>
<?php 
?>
<input type="button" id="btCadastra" value="Cadastrar" onclick="abaCadastra();">
<div id="cadastroClass" <?php if (!isset($_GET['idGaleria'])) echo "style=\"display:none;\"";?>>
<?php 
$galerias = null;
$galerias = new Galerias();
if(isset($_GET['idGaleria']))
{
	$galerias->reset();
	$galerias->setIdGaleria($_GET['idGaleria']);
	$galerias->find(true);
}

?>
<form name="cadastrar" id="cadastrar" method="post" action="../../application/recebePostGet.php" enctype="multipart/form-data" >
	<input type="hidden" id="control" name="control" value="Galerias"/>
	<input type="hidden" id="funcao" name="funcao" value="<?=(isset($_GET['idGaleria']))?"alterar":"cadastrar"?>"/>
	<input type="hidden" id="idGaleria" name="idGaleria" value="<?=$galerias->getIdGaleria()?>"/>
	<table width="100%">
		<tr>
			<td valign="top"><p>Nome da Galeria*:</p></td>
			<td valign="top">
				<input type="text" id="nomeGaleria" name="nomeGaleria" value="<?=$galerias->getNomeGaleria()?>" size="60">
			</td>
		</tr>
		<tr>
			<td valign="top"><p>Data*:</p></td>
			<td valign="top">
				<input type="text" id="dataGaleria" name="dataGaleria" value="<?=$galerias->getDataGaleriaFormatado()?>" size="20">
				<a id="f_btn1" href="javascript:void(0);"><img src="../images/bot-calendario.png" border="0"></a>
			</td>
		</tr>
		<tr>
			<td valign="top"><p>Local:</p></td>
			<td valign="top">
				<input type="text" id="localGaleria" name="localGaleria" value="<?=$galerias->getLocalGaleria()?>" size="60">
			</td>
		</tr>
		<tr>
			<td valign="top"><p>Imagens **:</p></td>
			<td valign="top">
				<input name="imagens" type="file" id="imagens" size="50" title="Selecione um arquivo onde contenha as fotos(arquivo compactado em ZIP)."/>
	                (formato compactado)
	                  &nbsp;&nbsp;
	                <?php 
	                if($galerias->getPastaGaleria() != '')
	                {
	                ?>
	                	<a href="javascript:abrepagina('viewImagens.php?idGaleria=<?=$galerias->getIdGaleria()?>',500,600);">Ver imagens Cadastrada</a>
	                <?php
	                }
	                ?>
			</td>
		</tr>
		<tr>
			<td colspan="3">
				* Campos Obrigatórios.<br>
				** As imagens devem ser numeradas de 1 até a quantidade total,sendo a imagen de n 1 como a da capa. As imagens devem ser compatadas em um único arquivo ZIP.<br>
				<input type="submit" name="submit" id="submit" value="<?=(isset($_GET['idGaleria']))?"Alterar":"Cadastrar"?>"/>
			</td>
		</tr>
	</table>
</form>
</div>
		
