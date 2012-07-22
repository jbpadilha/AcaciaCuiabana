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

    <link rel="stylesheet" href="../css/style.css" type="text/css" media="screen" />
    <!--[if IE 6]><link rel="stylesheet" href="../css/styleie6.css" type="text/css" media="screen" /><![endif]-->
    <!--[if IE 7]><link rel="stylesheet" href="../css/style.ie7css" type="text/css" media="screen" /><![endif]-->

    <script type="text/javascript" src="../js/script.js"></script>
    <script type="text/javascript" src="../js/jquery-1.3.1.min.js"></script>
    <script type="text/javascript">
	function carregaPagina(url,id) {
	    $("div#"+id).html("<div aligh='center'><font color=\"#FF0000\">Carregando ...</font>  <img src='images/loading.gif' align='top' alt='aguarde' /></div>");
	            $.get(url,{ }
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
                </div>
                <div class="art-header">
                    <div class="art-header-png"></div>
                    <div class="art-logo">
                        <h1 id="name-text" class="art-logo-name"><a href="#">Loja Simbólica Acácia Cuiabana N. 01</a></h1>
                        <div id="slogan-text" class="art-logo-text">Fundado em 1900</div>
                    </div>
                </div>
                <div class="art-content-layout">
                    <div class="art-content-layout-row" >
				<div id="conteudo">
	                      <div class="art-layout-cell art-content">
								<div class="art-post">
									<div class="art-post-body">
										<div class="art-post-inner art-article">
											<div id="erros" class="erros"></div>
	  										<div id="sucesso" class="sucesso"></div>
											<div class="art-postcontent">
												<p>Entre com seu usuário e senha.</p>
												<form name="form" action="../../application/recebePostGet.php" method="post">
												<input type="hidden" id="control" name="control" value="Login"/>
												<table>
													<tr>
														<td>Usuário:</td>
														<td colspan="2" align="left"><input type="text" name="usuario" id="usuario" style="text-transform: lowercase;" /></td>
													</tr>
													<tr>
														<td>Senha:</td>
														<td><input type="password" name="senha" id="senha" /></td>
														<td><input type="submit" name="submit" id="submit" value="Logar"/></td>
													</tr>
												</table>
												</form>
											</div>
											<div class="cleared"></div>
										</div>
										<div class="cleared"></div>
									</div>
								</div>
								<div class="cleared"></div>
							</div> 
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
        <p class="art-page-footer">by <a href="www.joaopadilha.com">Jo�o Padilha</a>.</p>
    </div>
    
</body>
</html>
