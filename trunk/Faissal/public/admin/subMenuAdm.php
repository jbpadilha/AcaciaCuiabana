<?php 
include '../carregamentoInicial.php';
?>
<script type="text/javascript">
      function abaCadastra()
      {
    	  $('#cadastroClass').toggle();
      }
      function alterar(idSubMenu)
      {
      	var formulario = $('#deletaAltera').serialize(true);
      	carregaPagina('subMenuAdm.php?idSubMenu='+idSubMenu,'conteudo');
      }

      function deletar(idSubmenu)
      {
      	document.deletaAltera.funcao.value = "deletar";
      	document.deletaAltera.idSubMenu.value = idsubmenu;
      	var formulario = $('#deletaAltera').serialize(true);
      	enviaFormulario($('#deletaAltera').attr("action"),'conteudo',formulario);
      }
      function cadastra()
      {
      	if ( $('#nomeSubMenu').val() == '' || $('#idMenu').val() == '') {
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
	<input type="hidden" id="control" name="control" value="SubMenu"/>
	<input type="hidden" id="funcao" name="funcao" value=""/>
	<input type="hidden" id="idSubMenu" name="idSubMenu" value=""/>
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
		$submenu = new Submenus();
		$submenu->reset();
		if($submenu->find()>0)
		{
			while($submenu->fetch())
			{
			?>
			<tr>
				<td><?=$submenu->getIdSubMenu()?></td>
				<td><?=$submenu->getNomeSubMenu()?></td>
				<td><?=$submenu->getMenu()->getNomeMenu()?></td>
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
<div id="cadastroClass" <?php if (!isset($_GET['idSubMenu'])) echo "style=\"display:none;\"";?>>
<h3 class="t">Cadastro de Sub-Menu</h3>
<?php 
$submenu = null;
$submenu = new Submenus();
if(isset($_GET['idSubMenu']))
{
	$submenu->reset();
	$submenu->setIdSubMenu($_GET['idSubMenu']);
	$submenu->find(true);
}

?>
<form name="cadastrar" id="cadastrar" method="post" action="../../application/recebePostGet.php">
	<input type="hidden" id="control" name="control" value="SubMenu"/>
	<input type="hidden" id="funcao" name="funcao" value="<?=(isset($_GET['idSubMenu']))?"alterar":"cadastrar"?>"/>
	<input type="hidden" id="idSubMenu" name="idSubMenu" value="<?=$submenu->getIdSubMenu()?>"/>
	<table width="100%">
		<tr>
			<td valign="top"><p>Nome do Sub-Menu*:</p></td>
			<td valign="top">
				<input type="text" id="nomeSubMenu" name="nomeSubMenu" value="<?=$submenu->getNomeSubMenu()?>" size="60">
			</td>
		</tr>
		<tr>
			<td valign="top"><p>Menu Relacionado:</p></td>
			<td valign="top">
				<select id="idMenu" name="idMenu">
					<option value="">Selecione o Menu</option>
					<?php 
						$menu = null;
						$menu = new Menus();
						$menu->reset();
						if($menu->find()>0)
						{
							while($menu->fetch())
							{
								?>
								<option value="<?=$menu->getIdMenu()?>" <?=($menu->getIdMenu() == $submenu->getIdMenu()) ? "selected" : ""?>><?=$menu->getNomeMenu()?></option>
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
				<select id="idPagina" name="idPagina">
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
								<option value="<?=$paginas->getIdPagina()?>" <?=($paginas->getIdPagina() == $submenu->getIdPagina()) ? "selected" : ""?>><?=$paginas->getNomePagina()?></option>
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
				<input id="linkSubMenu" name="linkSubMenu" value="<?=$submenu->getLinkSubMenu()?>" />
			</td>
		</tr>
		<tr>
			<td colspan="3">
				* Campos Obrigatórios.<br>
				<input type="button" name="submit" id="submit" value="<?=(isset($_GET['idSubMenu']))?"Alterar":"Cadastrar"?>" onclick="cadastra();"/>
			</td>
		</tr>
	</table>
</form>
</div>
		
