<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd"> 

<html>

<head>
	<title>SMC</title>
	<link rel="stylesheet" type="text/css" href="css/home.css" >
	<?php include 'scripts/geral.php'; ?>
	<script language="javascript" type="text/javascript" src="js/geral.js" ></script>
	<script language="javascript" type="text/javascript" src="js/acessibilidade.js" ></script>
	<script language="javascript" type="text/javascript" src="js/jquery-1.4.2.js" ></script>
	<meta name="description" lang="pt-BR" content="Manutenção como deve ser feita. - Bem vindo." xml:lang="pt-BR"/>
	<meta name="keywords" lang="pt-BR" content="noticias, manutenção, preventiva, sucesso, empresa, smc" xml:lang="pt-BR"/>
</head>

<style type="text/css">
	* { font-family: Verdana; font-size: 96%; }
	label { display: block; margin-top: 10px; }
	label.error { float: none; color: red; margin: 0 .5em 0 0; vertical-align: top; font-size: 10px }
	p { clear: both; }
	.submit { margin-top: 1em; }
	em { font-weight: bold; padding-right: 1em; vertical-align: top; }
</style>

<body>
	<div id="barra">
		<span id="ajustaFonte">
			Tamanho do texto:				
			<label onclick="AjustaFonte('conteudo', 'menos');" >[-]</label>
			<label onclick="AjustaFonte('conteudo', '12px');" >12px</label>
			<label onclick="AjustaFonte('conteudo', 'mais');" >[+]</label>
		</span>
	</div>

	<div id="site">

	<div id="logo">
		<?php echo $logo; ?>
	</div>

	<div id="slogan">
		<h1><?php echo $slogan; ?></h1>
	</div>

	<div id="corpo">

	<div id="corpo_top"> </div>

	<div id="menu">
		<ul>
		<?php
			Menu('Início');
			Menu('Notícias');
			Menu('Dicas');
			Menu('Parceiros');
			Menu('Clientes');
			Menu('Login');
			Menu('Contato');
		?>
		</ul>
	</div>

	<?php
		$pagina = isset($_REQUEST['p']) ? $_REQUEST['p'] : 'inicio';
		if (file_exists($pagina.'.php')) {
			include $pagina.'.php';
		} else {
			include 'indisponivel.php';
		}
	?>
	
	<div id="sidebar">
	</div>

	<div id="rodape">
		<p><?php echo $fantasia; ?></p>
		<p><?php echo $url; ?></p>
	</div>

	</div>

	</div>

</body>

</html>