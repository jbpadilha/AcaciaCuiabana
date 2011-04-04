<?php 
include '../carregamentoInicial.php';
include_once( '../ckeditor/ckeditor_php5.php' ) ;
?>
<script type="text/javascript">
		Calendar.setup({
	    inputField : "dataagenda",
	    trigger    : "f_btn1",
	    onSelect   : function() { this.hide() },
	    dateFormat : "%d-%m-%Y %H:%M:%S",
	    showTime: 24
	  });
	  $("#dataagenda").mask("99/99/9999 99:99:99");
      function abaCadastra()
      {
    	  $('#cadastroClass').toggle();
      }
      function alterar(idagenda)
      {
      	var formulario = $('#deletaAltera').serialize(true);
      	carregaPagina('agendaAdm.php?idagenda='+idagenda,'conteudo');
      }

      function deletar(idagenda)
      {
      	document.deletaAltera.funcao.value = "deletar";
      	document.deletaAltera.idagenda.value = idagenda;
      	var formulario = $('#deletaAltera').serialize(true);
      	enviaFormulario($('#deletaAltera').attr("action"),'conteudo',formulario);
      }
      function cadastra()
      {
      	if ( $('#tituloagenda').val() == '' && $('#dataagenda').val() == '') {
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
		<td class="tituloAdm">Cadastro de Agenda</td>
	</tr>
</table>
<br>
<br>


<form name="deletaAltera" id="deletaAltera" method="post" action="../../application/recebePostGet.php" >
	<input type="hidden" id="control" name="control" value="Agenda"/>
	<input type="hidden" id="funcao" name="funcao" value=""/>
	<input type="hidden" id="idagenda" name="idagenda" value=""/>
	<table width="100%">
		<tr>
			<td class="titulo" colspan="5">Agenda Cadastradas</td>
		</tr>
		<tr>
			<td>id</td>
			<td>Título</td>
			<td colspan="2">Ações</td>
		</tr>
		<?php  
		$agenda = null;
		$agenda = new Agenda();
		$agenda->reset();
		$agenda->limit();
		if($agenda->find()>0)
		{
			while($agenda->fetch())
			{
			?>
			<tr>
				<td><?=$agenda->getIdagenda()?></td>
				<td><?=$agenda->getTituloagenda()?></td>
				<td width="31"><a href="javascript:void(0);" onclick="alterar(<?=$agenda->getIdagenda() ?>)"><img src="../images/botao_editar.gif" width="16" height="16" border="0" /></a></td>
  				<td width="20"><a href="javascript:void(0);" onclick="deletar(<?=$agenda->getIdagenda() ?>)"><img src="../images/botao_apagar.gif" width="16" height="16" border="0" /></a></td>
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
			<td colspan="5">Não existem agendas cadastradas.</td>
		</tr>
	<?php 
	}
	?>
</table>
</form>
<?php 
?>
<input type="button" id="btCadastra" value="Cadastrar" onclick="abaCadastra();">
<div id="cadastroClass" <?php if (!isset($_GET['idagenda'])) echo "style=\"display:none;\"";?>>
<h3 class="t">Cadastro de Agenda</h3>
<?php 
$agenda = null;
$agenda = new Agenda();
if(isset($_GET['idagenda']))
{
	$agenda->reset();
	$agenda->setIdagenda($_GET['idagenda']);
	$agenda->find(true);
}

?>
<form name="cadastrar" id="cadastrar" method="post" action="../../application/recebePostGet.php" enctype="multipart/form-data">
	<input type="hidden" id="control" name="control" value="Agenda"/>
	<input type="hidden" id="funcao" name="funcao" value="<?=(isset($_GET['idagenda']))?"alterar":"cadastrar"?>"/>
	<input type="hidden" id="idagenda" name="idagenda" value="<?=$agenda->getIdagenda()?>"/>
	<table width="100%">
		<tr>
			<td valign="top"><p>Título da Agenda*:</p></td>
			<td valign="top">
				<input type="text" id="tituloagenda" name="tituloagenda" value="<?=$agenda->getTituloagenda()?>" size="60">
			</td>
		</tr>
		<tr>
			<td valign="top"><p>Data*:</p></td>
			<td valign="top">
				<input type="text" id="dataagenda" name="dataagenda" value="<?=$agenda->getDataAgendaFormatado()?>" size="20">
				<a id="f_btn1" href="javascript:void(0);"><img src="../images/bot-calendario.png" border="0"></a>
			</td>
		</tr>
		<tr>
			<td valign="top"><p>Descrição:</p></td>
			<td valign="top" colspan="2">
				<?php 
				$CKEditor = new CKEditor();
 				$CKEditor->editor("descricaoagenda", $agenda->getDescricaoagenda());
 				?>
			</td>
		</tr>
		<tr>
			<td colspan="3">
				* Campos Obrigatórios.<br>
				<input type="button" name="submit" id="submit" value="<?=(isset($_GET['idagenda']))?"Alterar":"Cadastrar"?>" onclick="cadastra();"/>
			</td>
		</tr>
	</table>
</form>
</div>
		