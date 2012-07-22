<?php 

error_reporting(E_ALL);

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" dir="ltr" lang="en-US" xml:lang="en">
<head>
    <!--
    Created by Artisteer v2.4.0.26594
    Base template (without user's data) checked by http://validator.w3.org : "This page is valid XHTML 1.0 Transitional"
    -->
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=EmulateIE7" />
    <title>Benemérita, Augusta e Respeitosa Loja Simbólica Acácia Cuiabana Nº 01</title>
	<!--[if IE 6]><link rel="stylesheet" href="./style.ie6.css" type="text/css" media="screen" /><![endif]-->
	<!--[if IE 7]><link rel="stylesheet" href="./style.ie7.css" type="text/css" media="screen" /><![endif]-->
	<script type="text/javascript" src="../js/script.js"></script>
    <script type="text/javascript" src="../js/jquery-1.3.1.min.js"></script>
	<script type="text/javascript" src="../js/jquery.maskedinput-1.2.2.js"></script>
	<script type="text/javascript" src="../js/jquery.alphanumeric.js"></script>
	<script type="text/javascript" src="../ckeditor/ckeditor.js"></script>
	<script type="text/javascript" src="../jscal/js/jscal2.js"></script> 
    <script type="text/javascript" src="../jscal/js/lang/pt.js"></script> 
    <link rel="stylesheet" type="text/css" href="../jscal/css/jscal2.css" /> 
    <link rel="stylesheet" type="text/css" href="../jscal/css/border-radius.css" /> 
    <link rel="stylesheet" type="text/css" href="../jscal/css/steel/steel.css" /> 
    <link rel="stylesheet" href="../css/style.css" type="text/css" media="screen" />
    <!--[if IE 6]><link rel="stylesheet" href="../css/styleie6.css" type="text/css" media="screen" /><![endif]-->
    <!--[if IE 7]><link rel="stylesheet" href="../css/style.ie7css" type="text/css" media="screen" /><![endif]-->

    
    <script type="text/javascript">
    function abrepagina(page, width, height)

    {

    	xposition=0;

    	yposition=0;

    	if (width==0) { width = 415; };

    	if (height==0) { height = 290; };

    	if (parseInt(navigator.appVersion) >= 4) {

    		xposition = (screen.width - width) / 2;

    		yposition = (screen.height - height) / 2;

    		yposition = yposition - 20;

    }

    	args = "width=" + width + ", height=" + height + ", location=0, menubar=0, " +

    		"resizable=0, scrollbars=1, status=1, titlebar=0, " +

    		"toolbar=0, hotkeys=0, screenx=" + xposition + ", screeny=" +

    		yposition + ", left=" + xposition + ", top=" + yposition;

    	window.open(page, "_blank", args);

    }
			function carregaPagina(url,id) {
				$( '#erros' ).html( '' );
				$( '#sucesso' ).html( '' ); 
			    $("div#"+id).html("<div aligh='center'><font color=\"#FF0000\">Carregando ...</font>  <img src='../images/loading.gif' align='top' alt='aguarde' /></div>");
			            $.get(url,{ }
			            ,function(retorno){$("#"+id).html(retorno)});
			}
			function enviaFormulario(url,id,dados) {
			    $("div#"+id).html("<div aligh='center'><font color=\"#FF0000\">Carregando ...</font>  <img src='../images/loading.gif' align='top' alt='aguarde' /></div>");
			            $.post(url,dados
			            ,function(retorno){$("#"+id).html(retorno)});
			}
		</script>
</head>
<body>
<div id="art-page-background-simple-gradient">
        <div id="art-page-background-gradient"></div>
    </div>
    <div id="art-main">
        <div class="art-sheet">
            <div class="art-sheet-tl"></div>
            <div class="art-sheet-tr"></div>
            <div class="art-sheet-bl"></div>
            <div class="art-sheet-br"></div>
            <div class="art-sheet-tc"></div>
            <div class="art-sheet-bc"></div>
            <div class="art-sheet-cl"></div>
            <div class="art-sheet-cr"></div>
            <div class="art-sheet-cc"></div>
            <div class="art-sheet-body">
                <div class="art-nav">
                	<div class="l"></div>
                	<div class="r"></div>
                	<?php
                	include_once 'menu_adm.php';
                	?>
                </div>
                <div class="art-header">
                    <div class="art-header-png"></div>
                    <div class="art-logo">
                        <h1 id="name-text" class="art-logo-name"><a href="#">Loja Simbólica Acácia Cuiabana N 01</a></h1>
                        <div id="slogan-text" class="art-logo-text">Fundado em 1900</div>
                    </div>
                </div>
                <div class="art-content-layout">
                    <div class="art-content-layout-row" >
				<div id="conteudo">
					Selecione um  menu para realizar uma operação.
				</div>
                    </div>
                </div>
                <div class="cleared"></div><div class="art-footer">
                    <div class="art-footer-inner">
                        <div class="art-footer-text">
                            <p>Copyright &copy; 2012 ---. Todos os direitos reservados.</p>
                        </div>
                    </div>
                    <div class="art-footer-background"></div>
                </div>
        		<div class="cleared"></div>
            </div>
        </div>
        <div class="cleared"></div>
        <p class="art-page-footer">by <a href="www.joaopadilha.com">João Padilha</a>.</p>
    </div>
    
</body>
</html>
