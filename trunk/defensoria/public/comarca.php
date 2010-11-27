<?php 
header("Content-Type: text/html; charset=ISO-8859-1",true);
?>
<legend class="subtitulo">Cadastro de Comarcas:</legend>
<br/>
<?php 
include 'mensagensErro_sucesso.php';
?>
<form name="login" id="login" action="../application/recebePostGet.php" method="post">
	<input type="hidden" id="control" name="control" value="Comarca"/>
	<input type="hidden" id="function" name="function" value="cadastrar"/>
	<table>
		<tr>
			<td width="120">Nome da Comarca:</td>
			<td width="144"><input type="text" name="nome" value=""/></td>
			<td width="49"><input type="submit" name="submit" id="submit" value="Cadastrar"/></td>
		</tr>
	</table>
</form>
<?php
if(isset($_SESSION['comarcas']))
{
	$comarcas = new ArrayObject(array($_SESSION['comarcas']));
?>
<table>
	<tr>
    	<td colspan="4"><strong>Comarcas Cadastradas</strong></td>
    </tr>
	<tr>
	  <td width="126">&nbsp;</td>
	  <td colspan="3">&nbsp;</td>
  </tr>
	<tr>
	  <td><strong>ID</strong></td>
	  <td colspan="3"><strong>Comarca</strong></td>
  </tr>
  <?php 
  	$comarcaAtual = new Comarca();
  	foreach ($comarcas as $comarca)
  	{
		$comarcaAtual = (object) $comarca;
  ?>
	<tr>
	  <td><?=$comarcaAtual->getIdcomarca() ?></td>
	  <td width="243"><?=$comarcaAtual->getNomecomarca() ?></td>
	  <td width="31"><img src="images/botao_editar.gif" width="16" height="16" /></td>
	  <td width="20"><img src="images/botao_apagar.gif" width="16" height="16" /></td>
  </tr>
  <?php 
  	}
  ?>
</table>
<?php 
}
else
{
?>
Não existem comarcas cadastradas.
<?php 
}
?>