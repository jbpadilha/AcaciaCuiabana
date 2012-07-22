<?php 
include '../carregamentoInicial.php';
?>
<script type="text/javascript">
		Calendar.setup({
	    inputField : "dataAgenda",
	    trigger    : "f_btn1",
	    onSelect   : function() { this.hide() },
	    dateFormat : "%d-%m-%Y %H:%M:%S",
	    showTime: 24
	  });
	  $("#dataAgenda").mask("99/99/9999 99:99:99");
      function abaCadastra()
      {
    	  $('#cadastroClass').toggle();
    	  $("#deletaAltera").each(function(){
              this.reset();
          });
      }
      function alterar(idAgenda)
      {
      	var formulario = $('#deletaAltera').serialize(true);
      	carregaPagina('agendaAdm.php?idAgenda='+idAgenda,'conteudo');
      }

      function deletar(idAgenda)
      {
      	document.deletaAltera.funcao.value = "deletar";
      	document.deletaAltera.idAgenda.value = idagenda;
      	var formulario = $('#deletaAltera').serialize(true);
      	enviaFormulario($('#deletaAltera').attr("action"),'conteudo',formulario);
      }
      function cadastra()
      {
      	if ( $('#nomeAgenda').val() == '' && $('#dataAgenda').val() == '') {
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
	<input type="hidden" id="idAgenda" name="idAgenda" value=""/>
	<table width="100%">
		<tr>
			<td class="titulo" colspan="5">Agenda Cadastradas</td>
		</tr>
		<tr bgcolor="#FFFF99">
			<td>id</td>
			<td>Título</td>
			<td colspan="2">Ações</td>
		</tr>
		<?php  
		$agenda = new Agenda();
		$agenda->reset();
		if($agenda->find()>0)
		{
			while($agenda->fetch())
			{
			?>
			<tr>
				<td><?=$agenda->getIdAgenda()?></td>
				<td><?=$agenda->getNomeAgenda()?></td>
				<td width="31"><a href="javascript:void(0);" onclick="alterar(<?=$agenda->getIdAgenda() ?>)"><img src="../images/botao_editar.gif" width="16" height="16" border="0" alt="Alterar" /></a></td>
  				<td width="20"><a href="javascript:void(0);" onclick="deletar(<?=$agenda->getIdAgenda() ?>)"><img src="../images/botao_apagar.gif" width="16" height="16" border="0" alt="Deletar" /></a></td>
			</tr>
			<?php
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
<div id="cadastroClass" <?php if (!isset($_GET['idAgenda'])) echo "style=\"display:none;\"";?>>
<?php 
$agenda = null;
$agenda = new Agenda();
if(isset($_GET['idAgenda']))
{
	$agenda->reset();
	$agenda->setIdAgenda($_GET['idAgenda']);
	$agenda->find(true);
}

?>
<form name="cadastrar" id="cadastrar" method="post" action="../../application/recebePostGet.php" enctype="multipart/form-data">
	<input type="hidden" id="control" name="control" value="Agenda"/>
	<input type="hidden" id="funcao" name="funcao" value="<?=(isset($_GET['idAgenda']))?"alterar":"cadastrar"?>"/>
	<input type="hidden" id="idAgenda" name="idAgenda" value="<?=$agenda->getIdAgenda()?>"/>
	<table width="100%">
		<tr>
			<td valign="top"><p>Título da Agenda*:</p></td>
			<td valign="top">
				<input type="text" id="nomeAgenda" name="nomeAgenda" value="<?=$agenda->getNomeAgenda()?>" size="60">
			</td>
		</tr>
		<tr>
			<td valign="top"><p>Data*:</p></td>
			<td valign="top">
				<input type="text" id="dataAgenda" name="dataAgenda" value="<?=$agenda->getDataAgendaFormatado()?>" size="20">
				<a id="f_btn1" href="javascript:void(0);"><img src="../images/bot-calendario.png" border="0"></a>
			</td>
		</tr>
		<tr>
			<td valign="top"><p>Descrição:</p></td>
			<td valign="top" colspan="2">
 				<textarea readonly="readonly" name="descricaoAgenda" cols="50" rows="6" id="descricaoAgenda" onfocus="javascript:document.forms[1].Submit.focus();" title="Para editar o conteúdo da página, precione no botão Editar Campo, ao lado."><?=$agenda->getDescricaoAgenda()?></textarea>
				<input name="Submit2" type="button" class="botao" value="Editar Campo" onclick="javascript:abrepagina('editorHtml.php?nomeExibicaoCampo=Conteúdo da Página&formulario=cadastrar&campo=descricaoAgenda',750,400);"/>
			</td>
		</tr>
		<tr>
			<td colspan="3">
				* Campos Obrigatórios.<br>
				<input type="button" name="submit" id="submit" value="<?=(isset($_GET['idAgenda']))?"Alterar":"Cadastrar"?>" onclick="cadastra();"/>
			</td>
		</tr>
	</table>
</form>
</div>
		
