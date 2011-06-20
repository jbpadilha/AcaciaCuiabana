<?php 
include '../carregamentoInicial.php';
?>
<script type="text/javascript">
      function abaCadastra()
      {
    	  $('#cadastroClass').toggle();
      }
      function alterar(idsubmenu)
      {
      	var formulario = $('#deletaAltera').serialize(true);
      	carregaPagina('subMenuAdm.php?idsubmenu='+idsubmenu,'conteudo');
      }

      function deletar(idsubmenu)
      {
      	document.deletaAltera.funcao.value = "deletar";
      	document.deletaAltera.idsubmenu.value = idsubmenu;
      	var formulario = $('#deletaAltera').serialize(true);
      	enviaFormulario($('#deletaAltera').attr("action"),'conteudo',formulario);
      }
      function cadastra()
      {
      	if ( $('#descricaosubmenu').val() == '' || $('#idmenu').val() == '') {
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
		<td class="tituloAdm">Cadastro de Sub-Menu</td>
	</tr>
</table>
<br>
<br>


<form name="deletaAltera" id="deletaAltera" method="post" action="../../application/recebePostGet.php" >
	<input type="hidden" id="control" name="control" value="Submenu"/>
	<input type="hidden" id="funcao" name="funcao" value=""/>
	<input type="hidden" id="idsubmenu" name="idsubmenu" value=""/>
	<table width="100%">
		<tr>
			<td class="titulo" colspan="5">Sub-Menu Cadastrados</td>
		</tr>
		<tr>
			<td>id</td>
			<td>Descrição</td>
			<td>Menu Relacionado</td>
			<td colspan="2">Ações</td>
		</tr>
		<?php  
		$submenu = null;
		$submenu = new Submenu();
		$submenu->reset();
		if($submenu->find()>0)
		{
			while($submenu->fetch())
			{
			?>
			<tr>
				<td><?=$submenu->getIdsubmenu()?></td>
				<td><?=$submenu->getDescricaosubmenu()?></td>
				<td><?=$submenu->getMenu()->getDescricaomenu()?></td>
				<td width="31"><a href="javascript:void(0);" onclick="alterar(<?=$submenu->getIdsubmenu() ?>)"><img src="../images/botao_editar.gif" width="16" height="16" border="0" alt="Alterar"/></a></td>
  				<td width="20"><a href="javascript:void(0);" onclick="deletar(<?=$submenu->getIdsubmenu() ?>)"><img src="../images/botao_apagar.gif" width="16" height="16" border="0" alt="Deletar"/></a></td>
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
			<td colspan="5">Não existem sub-menu cadastrados.</td>
		</tr>
	<?php 
	}
	?>
</table>
</form>
<?php 
?>
<input type="button" id="btCadastra" value="Cadastrar" onclick="abaCadastra();">
<div id="cadastroClass" <?php if (!isset($_GET['idsubmenu'])) echo "style=\"display:none;\"";?>>
<h3 class="t">Cadastro de Sub-Menu</h3>
<?php 
$submenu = null;
$submenu = new Submenu();
if(isset($_GET['idsubmenu']))
{
	$submenu->reset();
	$submenu->setIdsubmenu($_GET['idsubmenu']);
	$submenu->find(true);
}

?>
<form name="cadastrar" id="cadastrar" method="post" action="../../application/recebePostGet.php">
	<input type="hidden" id="control" name="control" value="Submenu"/>
	<input type="hidden" id="funcao" name="funcao" value="<?=(isset($_GET['idsubmenu']))?"alterar":"cadastrar"?>"/>
	<input type="hidden" id="idsubmenu" name="idsubmenu" value="<?=$submenu->getIdsubmenu()?>"/>
	<table width="100%">
		<tr>
			<td valign="top"><p>Descrição do Sub-Menu*:</p></td>
			<td valign="top">
				<input type="text" id="descricaosubmenu" name="descricaosubmenu" value="<?=$submenu->getDescricaosubmenu()?>" size="60">
			</td>
		</tr>
		<tr>
			<td valign="top"><p>Menu Relacionado:</p></td>
			<td valign="top">
				<select id="idmenu" name="idmenu">
					<option value="">Selecione o Menu</option>
					<?php 
						$menu = null;
						$menu = new Menu();
						$menu->reset();
						if($menu->find()>0)
						{
							while($menu->fetch())
							{
								?>
								<option value="<?=$menu->getIdmenu()?>" <?=($menu->getIdmenu() == $submenu->getIdmenu()) ? "selected" : ""?>><?=$menu->getDescricaomenu()?></option>
								<?php 
							}
						}
					?>
				</select>
			</td>
		</tr>
		<tr>
			<td valign="top"><p>Página Criada:</p></td>
			<td valign="top">
				<select id="idpagina" name="idpagina">
					<option value="">Selecione a Página</option>
					<?php 
						$paginas = null;
						$paginas = new Paginas();
						$paginas->reset();
						if($paginas->find()>0)
						{
							while($paginas->fetch())
							{
								?>
								<option value="<?=$paginas->getIdpagina()?>" <?=($paginas->getIdpagina() == $submenu->getIdpagina()) ? "selected" : ""?>><?=$paginas->getNomepagina()?></option>
								<?php 
							}
						}
					?>
				</select>
			</td>
		</tr>
		<tr>
			<td valign="top"><p>Anexo:</p></td>
			<td valign="top">
				<select id="idanexo" name="idanexo">
					<option value="">Selecione o Anexo</option>
					<?php 
						$anexos = null;
						$anexos = new Anexos();
						$anexos->reset();
						if($anexos->find()>0)
						{
							while($anexos->fetch())
							{
								?>
								<option value="<?=$anexos->getIdanexo()?>" <?=($anexos->getIdanexo() == $submenu->getIdanexo()) ? "selected" : ""?>><?=$anexos->getNomeanexo()?></option>
								<?php 
							}
						}
					?>
				</select>
			</td>
		</tr>
		<tr>
			<td valign="top"><p>Link externo:</p></td>
			<td valign="top" colspan="2">
				<input id="linksubmenu" name="linksubmenu" value="<?=$submenu->getLinksubmenu()?>" />
			</td>
		</tr>
		<tr>
			<td colspan="3">
				* Campos Obrigatórios.<br>
				<input type="button" name="submit" id="submit" value="<?=(isset($_GET['idsubmenu']))?"Alterar":"Cadastrar"?>" onclick="cadastra();"/>
			</td>
		</tr>
	</table>
</form>
</div>
		
