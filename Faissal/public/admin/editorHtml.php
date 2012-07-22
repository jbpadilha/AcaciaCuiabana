<?php include '../carregamentoInicial.php';?>        
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
	<title>Editando <?=$_GET['nomeExibicaoCampo']?></title>
	<script language="JavaScript" type="text/javascript" src="../js/richtext.js"></script>
</head>
<body>

<form action="" method="post">
<input type="hidden" name="cmd" value="_xclick">
<input type="hidden" name="no_note" value="1">
<input type="hidden" name="currency_code" value="USD">
<input type="hidden" name="tax" value="0">
<input type="hidden" name="lc" value="US">
</form>

<form name="form" action="editorHtml.htm" method="post" onsubmit="return submitForm();">
<script language="JavaScript" type="text/javascript">
<!--
function submitForm() {
	//make sure hidden and iframe values are in sync before submitting form
	//to sync only 1 rte, use updateRTE(rte)
	//to sync all rtes, use updateRTEs
	updateRTE('rte1');
	//updateRTEs();
	window.opener.document.<?=$_GET['formulario'] ?>.<?=$_GET['campo']?>.value = document.form.rte1.value;
	//change the following line to true to submit form
	//return false;
	self.close();
}

//Usage: initRTE(imagesPath, includesPath, cssFile)
initRTE("../images/", "", "");
//-->
</script>

<script language="JavaScript" type="text/javascript">
<!--
//Usage: writeRichText(fieldname, html, width, height, buttons, readOnly)
writeRichText('rte1', ''+window.opener.document.<?=$_GET['formulario']?>.<?=$_GET['campo']?>.value+'', 500, 250, true, false);
//-->
</script>
<p><input type="submit" name="submit" value="Salvar"></p>
</form>

</body>
</html>        