<?php 
include '../carregamentoInicial.php';
?>
<script type="text/javascript">
      function abaCadastra()
      {
    	  $('#cadastroClass').toggle();
      }
      function alterar(idEnquete)
      {
      	var formulario = $('#deletaAltera').serialize(true);
      	carregaPagina('enqueteAdm.php?idEnquete='+idEnquete,'conteudo');
      }

      function deletar(idEnquete)
      {
      	document.deletaAltera.funcao.value = "deletar";
      	document.deletaAltera.idEnquete.value = idEnquete;
      	var formulario = $('#deletaAltera').serialize(true);
      	enviaFormulario($('#deletaAltera').attr("action"),'conteudo',formulario);
      }
      function cadastra()
      {
      	if ( $('#nomeenquete').val() == '') {
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
		<td class="tituloAdm">Cadastro de Enquete</td>
	</tr>
</table>
<br>
<br>


<form name="deletaAltera" id="deletaAltera" method="post" action="../../application/recebePostGet.php" >
	<input type="hidden" id="control" name="control" value="Menu"/>
	<input type="hidden" id="funcao" name="funcao" value=""/>
	<input type="hidden" id="idEnquete" name="idEnquete" value=""/>
	<table width="100%">
		<tr>
			<td class="titulo" colspan="5">Enquetes Cadastradas</td>
		</tr>
		<tr bgcolor="#FFFF99">
			<td>id</td>
			<td>Descrição</td>
			<td>Status</td>
			<td colspan="2">Ações</td>
		</tr>
		<?php  
		$enquete = null;
		$enquete = new Enquetes();
		$enquete->reset();
		if($enquete->find()>0)
		{
			while($enquete->fetch())
			{
			?>
			<tr>
				<td><?=$enquete->getidEnquete()?></td>
				<td><?=$enquete->getnomeEnquete()?></td>
				<td><?=($enquete->getexibirEnquete())?"Ativo":"inativo"?></td>
				<td width="31"><a href="javascript:void(0);" onclick="alterar(<?=$enquete->getidEnquete() ?>)"><img src="../images/botao_editar.gif" width="16" height="16" border="0" alt="Alterar"/></a></td>
  				<td width="20"><a href="javascript:void(0);" onclick="deletar(<?=$enquete->getidEnquete() ?>)"><img src="../images/botao_apagar.gif" width="16" height="16" border="0" alt="Deletar"/></a></td>
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
			<td colspan="5">Não existem enquetes cadastrados.</td>
		</tr>
	<?php 
	}
	?>
</table>
</form>
<?php 
?>
<input type="button" id="btCadastra" value="Cadastrar" onclick="abaCadastra();">
<div id="cadastroClass" <?php if (!isset($_GET['idEnquete'])) echo "style=\"display:none;\"";?>>

<?php 
$enquete = null;
$enquete = new Enquetes();
if(isset($_GET['idEnquete']))
{
	$enquete->reset();
	$enquete->setidEnquete($_GET['idEnquete']);
	$enquete->find(true);
}

?>
<form name="cadastrar" id="cadastrar" method="post" action="../../application/recebePostGet.php">
	<input type="hidden" id="control" name="control" value="Enquete"/>
	<input type="hidden" id="funcao" name="funcao" value="<?=(isset($_GET['idenquete']))?"alterar":"cadastrar"?>"/>
	<input type="hidden" id="idEnquete" name="idEnquete" value="<?=$enquete->getidEnquete()?>"/>
	<table width="100%">
		<tr>
			<td valign="top"><p>Nome da Enquete*:</p></td>
			<td valign="top">
				<input type="text" id="nomeEnquete" name="nomeEnquete" value="<?=$enquete->getnomeEnquete()?>" size="60">
			</td>
		</tr>
		<tr>
			<td valign="top"><p>Questão 1*:</p></td>
			<td valign="top">
				<input type="text" id="op1Enquete" name="op1Enquete" value="<?=$enquete->getop1Enquete()?>" size="60">
			</td>
		</tr>
		<tr>
			<td valign="top"><p>Votos Questão 1:</p></td>
			<td valign="top">
				<?=$enquete->getvotos1Enquete()?>
				<input type="hidden" id="votos1Enquete" name="votos1Enquete" value="<?=$enquete->getvotos1Enquete()?>">
			</td>
		</tr>
		<tr>
			<td valign="top"><p>Questão 2*:</p></td>
			<td valign="top">
				<input type="text" id="op2Enquete" name="op2Enquete" value="<?=$enquete->getop2Enquete()?>" size="60">
			</td>
		</tr>
		<tr>
			<td valign="top"><p>Votos Questão 2:</p></td>
			<td valign="top">
				<?=$enquete->getvotos2Enquete()?>
				<input type="hidden" id="votos2Enquete" name="votos2Enquete" value="<?=$enquete->getvotos2Enquete()?>">
			</td>
		</tr>
		<tr>
			<td valign="top"><p>Questão 3:</p></td>
			<td valign="top">
				<input type="text" id="op3Enquete" name="op3Enquete" value="<?=$enquete->getop3Enquete()?>" size="60">
			</td>
		</tr>
		<tr>
			<td valign="top"><p>Votos Questão 3:</p></td>
			<td valign="top">
				<?=$enquete->getvotos3Enquete()?>
				<input type="hidden" id="votos3Enquete" name="votos3Enquete" value="<?=$enquete->getvotos3Enquete()?>">
			</td>
		</tr>
		<tr>
			<td valign="top"><p>Questão 4:</p></td>
			<td valign="top">
				<input type="text" id="op4Enquete" name="op4Enquete" value="<?=$enquete->getop4Enquete()?>" size="60">
			</td>
		</tr>
		<tr>
			<td valign="top"><p>Votos Questão 4:</p></td>
			<td valign="top">
				<?=$enquete->getvotos4Enquete()?>
				<input type="hidden" id="votos4Enquete" name="votos4Enquete" value="<?=$enquete->getvotos4Enquete()?>">
			</td>
		</tr>
		<tr>
			<td valign="top"><p>Questão 5:</p></td>
			<td valign="top">
				<input type="text" id="op5Enquete" name="op5Enquete" value="<?=$enquete->getop5Enquete()?>" size="60">
			</td>
		</tr>
		<tr>
			<td valign="top"><p>Votos Questão 5:</p></td>
			<td valign="top">
				<?=$enquete->getvotos5Enquete()?>
				<input type="hidden" id="votos5Enquete" name="votos5Enquete" value="<?=$enquete->getvotos5Enquete()?>">
			</td>
		</tr>
		<tr>
			<td colspan="3">
				* Campos Obrigatórios.<br>
				<input type="button" name="submit" id="submit" value="<?=(isset($_GET['idEnquete']))?"Alterar":"Cadastrar"?>" onclick="cadastra();"/>
			</td>
		</tr>
	</table>
</form>
</div>
		