<?php 
include '../carregamentoInicial.php';
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">

<html>
<head>
	<title>Inserir Link para Anexos/Publicações</title>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<script language="JavaScript" type="text/javascript">
<!--
function AddLink() {
	var html = '<a href="<?=PROJETO_CONTEXT?>images/'+document.form.anexos.value+'" target="_blank">'+document.form.textoEntrada.value+'</a>';
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
		<select name="anexos">
        <?
        	$anexos = new Anexos();
        	$anexos->reset();
        	if($anexos->find()>0)
        	{
        		while($anexos->fetch())
        		{
        ?>
          <option value="<?=$anexos->getCaminhoanexo()?>"><?=$anexos->getNomeanexo()?></option>
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