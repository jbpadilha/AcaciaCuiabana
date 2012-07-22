<?php 
include '../carregamentoInicial.php';
?>
<script type="text/javascript">
      function abaCadastra()
      {
    	  $('#cadastroClass').toggle();
    	  $("#deletaAltera").each(function(){
              this.reset();
          });
      }
      function alterar(idCursiosidades)
      {
      	var formulario = $('#deletaAltera').serialize(true);
      	carregaPagina('curiosidadesAdm.php?idCursiosidades='+idCursiosidades,'conteudo');
      }

      function deletar(idCursiosidades)
      {
      	document.deletaAltera.funcao.value = "deletar";
      	document.deletaAltera.idCursiosidades.value = idCursiosidades;
      	var formulario = $('#deletaAltera').serialize(true);
      	enviaFormulario($('#deletaAltera').attr("action"),'conteudo',formulario);
      }
      function cadastra()
      {
      	if ( $('#tituloCuriosidades').val() == '' && $('#descricaoCuriosidades').val() == '') {
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
		<td class="tituloAdm">Cadastro de Curiosidades (Frases Maçonicas)</td>
	</tr>
</table>
<br>
<br>


<form name="deletaAltera" id="deletaAltera" method="post" action="../../application/recebePostGet.php" >
	<input type="hidden" id="control" name="control" value="Curiosidades"/>
	<input type="hidden" id="funcao" name="funcao" value=""/>
	<input type="hidden" id="idCursiosidades" name="idCursiosidades" value=""/>
	<table width="100%">
		<tr bgcolor="#FFFF99">
			<td>id</td>
			<td>Título</td>
			<td colspan="2">Ações</td>
		</tr>
		<?php  
		$curiosidades = new Curiosidades();
		$curiosidades->reset();
		if($curiosidades->find()>0)
		{
			while($curiosidades->fetch())
			{
			?>
			<tr>
				<td><?=$curiosidades->getIdCuriosidades()?></td>
				<td><?=$curiosidades->getTituloCuriosidades()?></td>
				<td width="31"><a href="javascript:void(0);" onclick="alterar(<?=$curiosidades->getIdCuriosidades() ?>)"><img src="../images/botao_editar.gif" width="16" height="16" border="0" alt="Alterar" /></a></td>
  				<td width="20"><a href="javascript:void(0);" onclick="deletar(<?=$curiosidades->getIdCuriosidades() ?>)"><img src="../images/botao_apagar.gif" width="16" height="16" border="0" alt="Deletar" /></a></td>
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
			<td colspan="5">Não existem frases cadastradas.</td>
		</tr>
	<?php 
	}
	?>
</table>
</form>
<?php 
?>
<input type="button" id="btCadastra" value="Cadastrar" onclick="abaCadastra();">
<div id="cadastroClass" <?php if (!isset($_GET['idCursiosidades'])) echo "style=\"display:none;\"";?>>
<h3 class="t">Cadastro de Curiosidades (Frases Maçonicas)</h3>
<?php 
$curiosidades = null;
$curiosidades = new Curiosidades();
if(isset($_GET['idCursiosidades']))
{
	$curiosidades->reset();
	$curiosidades->setIdCuriosidades($_GET['idCursiosidades']);
	$curiosidades->find(true);
}

?>
<form name="cadastrar" id="cadastrar" method="post" action="../../application/recebePostGet.php" enctype="multipart/form-data">
	<input type="hidden" id="control" name="control" value="Curiosidades"/>
	<input type="hidden" id="funcao" name="funcao" value="<?=(isset($_GET['idCursiosidades']))?"alterar":"cadastrar"?>"/>
	<input type="hidden" id="idCursiosidades" name="idCursiosidades" value="<?=$curiosidades->getIdCuriosidades()?>"/>
	<table width="100%">
		<tr>
			<td valign="top"><p>Título da Frase*:</p></td>
			<td valign="top">
				<input type="text" id="tituloCuriosidades" name="tituloCuriosidades" value="<?=$curiosidades->getTituloCuriosidades()?>" size="60">
			</td>
		</tr>
		<tr>
			<td valign="top"><p>Descrição:</p></td>
			<td valign="top" colspan="2">
 				<textarea readonly="readonly" name="descricaoCuriosidades" cols="50" rows="6" id="descricaoCuriosidades" onfocus="javascript:document.forms[1].Submit.focus();" title="Para editar o conteúdo da página, precione no botão Editar Campo, ao lado."><?=$curiosidades->getDescricaoCuriosidades()?></textarea>
				<input name="Submit2" type="button" class="botao" value="Editar Campo" onclick="javascript:abrepagina('editorHtml.php?nomeExibicaoCampo=Conteúdo da Página&formulario=cadastrar&campo=descricaoCuriosidades',750,400);"/>
			</td>
		</tr>
		<tr>
			<td colspan="3">
				* Campos Obrigatórios.<br>
				<input type="button" name="submit" id="submit" value="<?=(isset($_GET['idCursiosidades']))?"Alterar":"Cadastrar"?>" onclick="cadastra();"/>
			</td>
		</tr>
	</table>
</form>
</div>
		
