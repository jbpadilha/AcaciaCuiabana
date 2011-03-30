<?php
//####################################
// * Rafael Henrique Vieira de Moura / Desenvolvedor (Ábaco Tecnologia)
// * Arquivo: viewUploadFiles.php
// * Criação: Rafael Henrique Vieira de Moura
// * Revisão:
// * Data de criação: 11/07/2008
//####################################

/**
 * Página de Upload de arquivos dos anexos
 */

require("config.php");

if(!isset($_SESSION["usuario_Logado"]))
{
	header("Location:index.php");
}

/*if ($_POST['pagina'] == 'upload') {
	$businessEntity = new BusinessEntity();
	$anexosVo = new AnexosVo();
	if($_FILES['arquivoAnexo']['tmp_name']!=''){
		$caminhoRetorno = $businessEntity->uploadArquivoAnexos($_FILES['arquivoAnexo']);
?>
	<script type="text/javascript">
		self.parent.document.getElementById('caminhoAnexos').value = '';
		self.parent.document.getElementById('caminhoAnexos').value = '<?=$caminhoRetorno?>';
		self.parent.document.getElementById('fileUploaded').innerHTML = "&nbsp;&nbsp;&nbsp;<a href='<?=$caminhoRetorno?>' target='_blank'>Visualizar arquivo enviado</a>";
		self.parent.tb_remove();
	</script>
<?php
	exit;
	} else {
		echo '<script type="text/javascript">alert("Selecione um arquivo.")</script>';
	}
}*/
?>
<link rel="stylesheet" type="text/css" media="screen,projection" href="<?=PATH?>/css/default.css" />
<link rel="stylesheet" type="text/css" media="screen,projection" href="<?=PATH?>/css/jquery-calendar.css" />
<link rel="stylesheet" type="text/css" media="print, handheld" href="<?=PATH?>/css/print.css" />
<script type="text/javascript" src="js/jquery.js"></script>
<script type="text/javascript" src="js/jquery.blockui.js"></script>
<style type="text/css">
	body{
		height:100%;
	}
</style>
<h3>Anexo</h3>
<form name="form1" id="form1" method="post" action="<?=$_SERVER['PHP_SELF']?>" enctype="multipart/form-data">
<input type="hidden" name="pagina" value="upload" />
<table width="95%" border="0" cellpadding="1" cellspacing="0" class="tabelaListagem" align="center">
	<tr>
		<td class="formTdEsquerdo">Arquivo</td>
		<td><input type="file" name="arquivoAnexo" size="30" /></td>
	</tr>
	<tr align="center">
		<td colspan="2" class="formTdCentro">
			<input type="submit" value="<?=$dominio->botaoConfirmar_TXT?>" id="<?=$dominio->botaoConfirmar?>" class="botao"/>
			&nbsp;
			<input type="button" value="<?=$dominio->botaoVoltar_TXT?>" id="<?=$dominio->botaoVoltar?>" class="botao" onClick="self.parent.tb_remove();"/>
		</td>
	</tr>
</table>
<input type="hidden" name="arquivo" id="arquivo" value="<?=strip_tags(rawurldecode($_GET['arquivo']))?>" />
<?php
if ($_GET['arquivo'] == '') {
	echo "<script type='text/javascript'>document.getElementById('arquivo').value = self.parent.document.getElementById('caminhoAnexos').value;</script>";
}
?>
</form>