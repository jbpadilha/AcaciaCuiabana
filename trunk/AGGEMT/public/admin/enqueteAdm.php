<?php 
include '../carregamentoInicial.php';
?>
<script type="text/javascript">
      function abaCadastra()
      {
    	  $('#cadastroClass').toggle();
      }
      function alterar(idenquete)
      {
      	var formulario = $('#deletaAltera').serialize(true);
      	carregaPagina('enqueteAdm.php?idenquete='+idenquete,'conteudo');
      }

      function deletar(idenquete)
      {
      	document.deletaAltera.funcao.value = "deletar";
      	document.deletaAltera.idenquete.value = idenquete;
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
	<input type="hidden" id="idenquete" name="idenquete" value=""/>
	<table width="100%">
		<tr>
			<td class="titulo" colspan="5">Enquetes Cadastradas</td>
		</tr>
		<tr>
			<td>id</td>
			<td>Descrição</td>
			<td>Status</td>
			<td colspan="2">Ações</td>
		</tr>
		<?php  
		$enquete = null;
		$enquete = new Enquete();
		$enquete->reset();
		if($enquete->find()>0)
		{
			while($enquete->fetch())
			{
			?>
			<tr>
				<td><?=$enquete->getIdenquete()?></td>
				<td><?=$enquete->getNomeenquete()?></td>
				<td><?=($enquete->getStatusenquete())?"Ativo":"inativo"?></td>
				<td width="31"><a href="javascript:void(0);" onclick="alterar(<?=$enquete->getIdenquete() ?>)"><img src="../images/botao_editar.gif" width="16" height="16" border="0" alt="Alterar"/></a></td>
  				<td width="20"><a href="javascript:void(0);" onclick="deletar(<?=$enquete->getIdenquete() ?>)"><img src="../images/botao_apagar.gif" width="16" height="16" border="0" alt="Deletar"/></a></td>
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
<div id="cadastroClass" <?php if (!isset($_GET['idenquete'])) echo "style=\"display:none;\"";?>>
<h3 class="t">Cadastro de Enquete</h3>
<?php 
$enquete = null;
$enquete = new Enquete();
if(isset($_GET['idenquete']))
{
	$enquete->reset();
	$enquete->setIdenquete($_GET['idenquete']);
	$enquete->find(true);
}

?>
<form name="cadastrar" id="cadastrar" method="post" action="../../application/recebePostGet.php">
	<input type="hidden" id="control" name="control" value="Enquete"/>
	<input type="hidden" id="funcao" name="funcao" value="<?=(isset($_GET['idenquete']))?"alterar":"cadastrar"?>"/>
	<input type="hidden" id="idenquete" name="idenquete" value="<?=$enquete->getIdenquete()?>"/>
	<table width="100%">
		<tr>
			<td valign="top"><p>Nome da Enquete*:</p></td>
			<td valign="top">
				<input type="text" id="nomeenquete" name="nomeenquete" value="<?=$enquete->getNomeenquete()?>" size="60">
			</td>
		</tr>
		<tr>
			<td valign="top">Tipo da Enquete</td>
			<td valign="top">
				<select id="tipoenquete" name="tipoenquete">
					<option value="0" <?=($enquete->getTipoenquete() == 0) ? "selected":""?>>Público</option>
					<option value="1" <?=($enquete->getTipoenquete() == 1) ? "selected":""?>>Interno</option>
				</select>
			</td>
		</tr>
		<tr>
			<td valign="top">Status</td>
			<td valign="top">
				<select id="statusenquete" name="statusenquete">
					<option value="0" <?=($enquete->getStatusenquete() == 0) ? "selected":""?>>Inativo</option>
					<option value="1" <?=($enquete->getStatusenquete() == 1) ? "selected":""?>>Ativo</option>
				</select>
			</td>
		</tr>
		<tr>
			<td valign="top"><p>Questão 1*:</p></td>
			<td valign="top">
				<input type="text" id="questao1enquete" name="questao1enquete" value="<?=$enquete->getQuestao1enquete()?>" size="60">
			</td>
		</tr>
		<tr>
			<td valign="top"><p>Votos Questão 1:</p></td>
			<td valign="top">
				<?=$enquete->getVotos1enqueste()?>
				<input type="hidden" id="votos1enqueste" name="votos1enqueste" value="<?=$enquete->getVotos1enqueste()?>">
			</td>
		</tr>
		<tr>
			<td valign="top"><p>Questão 2*:</p></td>
			<td valign="top">
				<input type="text" id="questao2enquete" name="questao2enquete" value="<?=$enquete->getQuestao2enquete()?>" size="60">
			</td>
		</tr>
		<tr>
			<td valign="top"><p>Votos Questão 2:</p></td>
			<td valign="top">
				<?=$enquete->getVotos2enqueste()?>
				<input type="hidden" id="votos2enqueste" name="votos2enqueste" value="<?=$enquete->getVotos2enqueste()?>">
			</td>
		</tr>
		<tr>
			<td valign="top"><p>Questão 3:</p></td>
			<td valign="top">
				<input type="text" id="questao3enquete" name="questao3enquete" value="<?=$enquete->getQuestao3enquete()?>" size="60">
			</td>
		</tr>
		<tr>
			<td valign="top"><p>Votos Questão 3:</p></td>
			<td valign="top">
				<?=$enquete->getVotos3enqueste()?>
				<input type="hidden" id="votos3enqueste" name="votos3enqueste" value="<?=$enquete->getVotos3enqueste()?>">
			</td>
		</tr>
		<tr>
			<td valign="top"><p>Questão 4:</p></td>
			<td valign="top">
				<input type="text" id="questao4enquete" name="questao4enquete" value="<?=$enquete->getQuestao4enquete()?>" size="60">
			</td>
		</tr>
		<tr>
			<td valign="top"><p>Votos Questão 4:</p></td>
			<td valign="top">
				<?=$enquete->getVotos4enqueste()?>
				<input type="hidden" id="votos4enqueste" name="votos4enqueste" value="<?=$enquete->getVotos4enqueste()?>">
			</td>
		</tr>
		<tr>
			<td valign="top"><p>Questão 5:</p></td>
			<td valign="top">
				<input type="text" id="questao5enquete" name="questao5enquete" value="<?=$enquete->getQuestao5enquete()?>" size="60">
			</td>
		</tr>
		<tr>
			<td valign="top"><p>Votos Questão 5:</p></td>
			<td valign="top">
				<?=$enquete->getVotos5enqueste()?>
				<input type="hidden" id="votos5enqueste" name="votos5enqueste" value="<?=$enquete->getVotos5enqueste()?>">
			</td>
		</tr>
		<tr>
			<td colspan="3">
				* Campos Obrigatórios.<br>
				<input type="button" name="submit" id="submit" value="<?=(isset($_GET['idenquete']))?"Alterar":"Cadastrar"?>" onclick="cadastra();"/>
			</td>
		</tr>
	</table>
</form>
</div>
		