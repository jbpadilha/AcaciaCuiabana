<?php 
header("Content-Type: text/html; charset=ISO-8859-1",true);
session_start();
$_SESSION["PATH_PUBLIC"] = getcwd(); 
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<link href="css/html.css" rel="stylesheet" type="text/css" media="screen, projection, tv" />
<!--[if lte IE 7]>
	<link rel="stylesheet" type="text/css" href="css/ie.css" media="screen" />
<![endif]-->
<script type="text/javascript" src="js/jquery-1.3.1.min.js"></script>	
<script type="text/javascript" language="javascript" src="js/jquery.dropdownPlain.js"></script>
<script type="text/javascript" src="js/jquery.maskedinput-1.2.2.js"></script>
<script type="text/javascript" src="js/jquery.maskMoney.0.2.js"></script>
<script type="text/javascript" src="js/jquery.alphanumeric.js"></script>
<script type="text/javascript">
	function carregaPagina(url,id) {
		$( '#erros' ).html( '' );
		$( '#sucesso' ).html( '' ); 
	    $("div#"+id).html("<div aligh='center'><font color=\"#FF0000\">Carregando ...</font>  <img src='images/loading.gif' align='top' alt='aguarde' /></div>");
	            $.get(url,{ }
	            ,function(retorno){$("#"+id).html(retorno)});
	}
	function carregaPaginaPesquisa(url,id,formulario) {
		$( '#erros' ).html( '' );
		$( '#sucesso' ).html( '' ); 
	    $("div#"+id).html("<div aligh='center'><font color=\"#FF0000\">Carregando ...</font>  <img src='images/loading.gif' align='top' alt='aguarde' /></div>");
	            $.get(url,formulario
	            ,function(retorno){$("#"+id).html(retorno)});
	}
	function enviaFormulario(url,id,dados) {
	    $("div#"+id).html("<div aligh='center'><font color=\"#FF0000\">Carregando ...</font>  <img src='images/loading.gif' align='top' alt='aguarde' /></div>");
	            $.post(url,dados
	            ,function(retorno){$("#"+id).html(retorno)});
	}
</script>
<title>DEFENSORIA PÚBLICA DO ESTADO DE MATO GROSSO</title>
</head>
<body>
<div id="content">
	<div id="header">
    <span class="titulo">DEFENSORIA PÚBLICA DO ESTADO DE MATO GROSSO - SISTEMA DE PROTOCOLO E ACOMPANHAMENTO DE PROCESSOS</span>
	</div>
	<div id="headerImg">	
	  <div id="headerImg1"></div>
		<div id="headerImg2">
		<?php 
			include("menu.php");
		?>
        </div>
  	</div>
  	<div id="erros" class="erros"></div>
  	<div id="sucesso" class="sucesso"></div>
  	<br/><br/><br/>
    <div id="page">
    </div>
</div>
<div id="footer">
</div>
</body>
</html>
