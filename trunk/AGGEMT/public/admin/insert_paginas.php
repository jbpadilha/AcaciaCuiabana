<?php 
include '../carregamentoInicial.php';
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">

<html>
<head>
	<title>Inserir Página Personalizada</title>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<script language="JavaScript" type="text/javascript">
<!--
function AddLink() {
	var html = '<a href="#" onClick="carregaPagina(\'pagina.php?idpagina='+document.form.paginas.value+'\',\'conteudo\');">'+document.form.textoEntrada.value+'</a>';
	window.opener.insertHTML(html);
	window.close();
}
//-->
</script>
</head>

<body style="margin: 10px; background: #ffffff;">

<form name="form">
<table cellpadding="4" cellspacing="0" border="0">
	<tr>
		<td align="right">Selecione uma página cadastrada:</td>
		<td>
		<select name="paginas">
        <?
        	$paginas = new Paginas();
        	$paginas->reset();
        	if($paginas->find()>0)
        	{
        		while($paginas->fetch())
        		{
        ?>
          <option value="<?=$paginas->getIdpagina()?>"><?=$paginas->getNomepagina()?></option>
        <?
        		}
        	}
	    ?>
        </select>
		</td>
	</tr>
	<tr>
		<td align="right">Digite o texto que aparecerá como link:</td>
		<td><input type="text" name="textoEntrada" id="textoEntrada"></td>
	</tr>
	<tr>
		<td colspan="3" align="center">
			<input type="button" value="Inserir o Link" onClick="AddLink();" />
			<input type="button" value="Cancel" onClick="window.close();" />
		</td>
	</tr>
</table>

</form>

</body>
</html>