<?php 
include '../carregamentoInicial.php';
?>
<script type="text/javascript">
      function abaCadastra()
      {
    	  $('#cadastroClass').toggle();
      }
      function alterar(idmenu)
      {
      	var formulario = $('#deletaAltera').serialize(true);
      	carregaPagina('menuAdm.php?idmenu='+idmenu,'conteudo');
      }

      function deletar(idmenu)
      {
      	document.deletaAltera.funcao.value = "deletar";
      	document.deletaAltera.idmenu.value = idmenu;
      	var formulario = $('#deletaAltera').serialize(true);
      	enviaFormulario($('#deletaAltera').attr("action"),'conteudo',formulario);
      }
      function cadastra()
      {
      	if ( $('#descricaomenu').val() == '') {
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
		<td class="tituloAdm">Cadastro de Menu</td>
	</tr>
</table>
<br>
<br>


<form name="deletaAltera" id="deletaAltera" method="post" action="../../application/recebePostGet.php" >
	<input type="hidden" id="control" name="control" value="Menu"/>
	<input type="hidden" id="funcao" name="funcao" value=""/>
	<input type="hidden" id="idmenu" name="idmenu" value=""/>
	<table width="100%">
		<tr>
			<td class="titulo" colspan="5">Menu Cadastrados</td>
		</tr>
		<tr>
			<td>id</td>
			<td>Descrição</td>
			<td colspan="2">Ações</td>
		</tr>
		<?php  
		$menu = null;
		$menu = new Menu();
		$menu->reset();
		if($menu->find()>0)
		{
			while($menu->fetch())
			{
			?>
			<tr>
				<td><?=$menu->getIdmenu()?></td>
				<td><?=$menu->getDescricaomenu()?></td>
				<td width="31"><a href="javascript:void(0);" onclick="alterar(<?=$menu->getIdmenu() ?>)"><img src="../images/botao_editar.gif" width="16" height="16" border="0" /></a></td>
  				<td width="20"><a href="javascript:void(0);" onclick="deletar(<?=$menu->getIdmenu() ?>)"><img src="../images/botao_apagar.gif" width="16" height="16" border="0" /></a></td>
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
			<td colspan="5">Não existem menu cadastrados.</td>
		</tr>
	<?php 
	}
	?>
</table>
</form>
<?php 
?>
<input type="button" id="btCadastra" value="Cadastrar" onclick="abaCadastra();">
<div id="cadastroClass" <?php if (!isset($_GET['idmenu'])) echo "style=\"display:none;\"";?>>
<h3 class="t">Cadastro de Menu</h3>
<?php 
$menu = null;
$menu = new Menu();
if(isset($_GET['idmenu']))
{
	$menu->reset();
	$menu->setIdmenu($_GET['idmenu']);
	$menu->find(true);
}

?>
<form name="cadastrar" id="cadastrar" method="post" action="../../application/recebePostGet.php">
	<input type="hidden" id="control" name="control" value="Menu"/>
	<input type="hidden" id="funcao" name="funcao" value="<?=(isset($_GET['idmenu']))?"alterar":"cadastrar"?>"/>
	<input type="hidden" id="idmenu" name="idmenu" value="<?=$menu->getIdmenu()?>"/>
	<table width="100%">
		<tr>
			<td valign="top"><p>Descrição do Menu*:</p></td>
			<td valign="top">
				<input type="text" id="descricaomenu" name="descricaomenu" value="<?=$menu->getDescricaomenu()?>" size="60">
			</td>
		</tr>
		<tr>
			<td valign="top"><p>Página Criada:</p></td>
			<td valign="top">
				<select id="idpagina" name="idpagina">
					<option value="">Selecione a Página</option>
					<?php 
						$paginas = new Paginas();
						if($paginas->find()>0)
						{
							while($paginas->fetch())
							{
								?>
								<option value="<?=$paginas->getIdpagina()?>" <?=($paginas->getIdpagina() == $menu->getIdpagina()) ? "selected" : ""?>><?=$paginas->getNomepagina()?></option>
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
				<input id="linkmenu" name="linkmenu" value="<?=$menu->getLinkmenu()?>" />
			</td>
		</tr>
		<tr>
			<td colspan="3">
				* Campos Obrigatórios.<br>
				<input type="button" name="submit" id="submit" value="<?=(isset($_GET['idmenu']))?"Alterar":"Cadastrar"?>" onclick="cadastra();"/>
			</td>
		</tr>
	</table>
</form>
</div>
		