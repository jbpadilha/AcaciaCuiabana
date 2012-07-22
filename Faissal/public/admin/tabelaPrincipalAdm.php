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
      function alterar(idTabelaPrincipal)
      {
      	var formulario = $('#deletaAltera').serialize(true);
      	carregaPagina('tabelaPrincipalAdm.php?idTabelaPrincipal='+idTabelaPrincipal,'conteudo');
      }

      function deletar(idTabelaPrincipal)
      {
      	document.deletaAltera.funcao.value = "deletar";
      	document.deletaAltera.idTabelaPrincipal.value = idTabelaPrincipals;
      	var formulario = $('#deletaAltera').serialize(true);
      	enviaFormulario($('#deletaAltera').attr("action"),'conteudo',formulario);
      }
      function cadastra()
      {
      	if ( $('#contatoTabelaPrincipal').val() == '') {
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
		<td class="tituloAdm">Cadastro da Tabela Principal</td>
	</tr>
</table>
<br>
<br>


<form name="deletaAltera" id="deletaAltera" method="post" action="../../application/recebePostGet.php" >
	<input type="hidden" id="control" name="control" value="TabelaPrincipal"/>
	<input type="hidden" id="funcao" name="funcao" value=""/>
	<input type="hidden" id="idTabelaPrincipal" name="idTabelaPrincipal" value=""/>
	<table width="100%">
		<tr>
			<td class="titulo" colspan="2">Cadastro</td>
		</tr>
		<tr>
			<td>&nbsp;</td>
			<td>Ações</td>
		</tr>
		<?php  
		$tabelaPrincipal = new TabelaPrincipal();
		$tabelaPrincipal->reset();
		if($tabelaPrincipal->find()>0)
		{
			while($tabelaPrincipal->fetch())
			{
			?>
			<tr>
				<td><?=$tabelaPrincipal->getContatoTabelaPrincipal()?></td>
				<td width="31"><a href="javascript:void(0);" onclick="alterar(<?=$tabelaPrincipal->getIdTabelaPrincipal() ?>)"><img src="../images/botao_editar.gif" width="16" height="16" border="0" alt="Alterar" /></a></td>
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
			<td colspan="5">Não existem tabela cadastrada.</td>
		</tr>
	<?php 
	}
	?>
</table>
</form>
<?php 
?>
<div id="cadastroClass" <?php if (!isset($_GET['idTabelaPrincipal'])) echo "style=\"display:none;\"";?>>
<h3 class="t">Cadastro da Tabela Principal</h3>
<?php 
$tabelaPrincipal = null;
$tabelaPrincipal = new TabelaPrincipal();
if(isset($_GET['idTabelaPrincipal']))
{
	$tabelaPrincipal->reset();
	$tabelaPrincipal->setIdTabelaPrincipal($_GET['idTabelaPrincipal']);
	$tabelaPrincipal->find(true);
}

?>
<form name="cadastrar" id="cadastrar" method="post" action="../../application/recebePostGet.php" enctype="multipart/form-data">
	<input type="hidden" id="control" name="control" value="TabelaPrincipal"/>
	<input type="hidden" id="funcao" name="funcao" value="<?=(isset($_GET['idTabelaPrincipal']))?"alterar":"cadastrar"?>"/>
	<input type="hidden" id="idTabelaPrincipal" name="idTabelaPrincipal" value="<?=$tabelaPrincipal->getIdTabelaPrincipal()?>"/>
	<table width="100%">
		<tr>
			<td valign="top"><p>Contato*:</p></td>
			<td valign="top">
				<input type="text" id="contatoTabelaPrincipal" name="contatoTabelaPrincipal" value="<?=$tabelaPrincipal->getContatoTabelaPrincipal()?>" size="60">
			</td>
		</tr>
		<tr>
			<td valign="top"><p>Frase Destaque:</p></td>
			<td valign="top" colspan="2">
 				<textarea readonly="readonly" name="fraseDestaqueTabelaPrincipal" cols="50" rows="6" id="fraseDestaqueTabelaPrincipal" onfocus="javascript:document.forms[1].Submit.focus();" title="Para editar o conteúdo da página, precione no botão Editar Campo, ao lado."><?=$tabelaPrincipal->getFraseDestaqueTabelaPrincipal()?></textarea>
				<input name="Submit2" type="button" class="botao" value="Editar Campo" onclick="javascript:abrepagina('editorHtml.php?nomeExibicaoCampo=Conteúdo da Página&formulario=cadastrar&campo=fraseDestaqueTabelaPrincipal',750,400);"/>
			</td>
		</tr>
		<tr>
			<td valign="top"><p>Localização*:</p></td>
			<td valign="top">
				<input type="text" id="localizacaoTabelaPrincipal" name="localizacaoTabelaPrincipal" value="<?=$tabelaPrincipal->getLocalizacaoTabelaPrincipal()?>" size="60">
			</td>
		</tr>
		<tr>
			<td valign="top"><p>Rodapé:</p></td>
			<td valign="top" colspan="2">
 				<textarea readonly="readonly" name="rodapeTabelaPrincipal" cols="50" rows="6" id="rodapeTabelaPrincipal" onfocus="javascript:document.forms[1].Submit.focus();" title="Para editar o conteúdo da página, precione no botão Editar Campo, ao lado."><?=$tabelaPrincipal->getRodapeTabelaPrincipal()?></textarea>
				<input name="Submit2" type="button" class="botao" value="Editar Campo" onclick="javascript:abrepagina('editorHtml.php?nomeExibicaoCampo=Conteúdo da Página&formulario=cadastrar&campo=rodapeTabelaPrincipal',750,400);"/>
			</td>
		</tr>
		<tr>
			<td colspan="3">
				* Campos Obrigatórios.<br>
				<input type="button" name="submit" id="submit" value="<?=(isset($_GET['idTabelaPrincipal']))?"Alterar":"Cadastrar"?>" onclick="cadastra();"/>
			</td>
		</tr>
	</table>
</form>
</div>
		
