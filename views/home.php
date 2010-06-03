<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="pt-br" lang="pt-br">

<head>

	<title>SMC - Serviço de Manutenção e Consultoria</title>
	<link rel="SHORTCUT ICON" href="imagens/smc.ico" />
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta http-equiv="Content-Language" content="pt-BR" />
	<meta name="author" content="Júnior Mendonçaa" />
	<meta name="copyright" content="SMC - Serviço de Manutenção e Consultoria">
	<meta name="description" content="SMC - Manutenção como deve ser feita." />
	<meta name="keywords" lang="pt-br" content="smc, serviço despertador, servico despertador, servicodespertador, manutenção, preventiva, gestão, frotas, ativos" />

    <link type="text/css" rel="Stylesheet" media="screen" href="_css/home.css" />

	<script language="javascript" type="text/javascript" src="js/jquery.js" ></script>
	<script language="javascript" type="text/javascript" src="js/acessibilidade.js" ></script>
	<script language="javascript" type="text/javascript" src="js/geral.js" ></script>

	<?php include '_php/scripts.php'; ?>
</head>

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

		<div id="header">
			<img src="_img/smc_logo_276x120.png" alt="SMC" />
			<h1>Manutenção como deve ser feita</h1>
		</div>

		<div id="corpo">
			<div id="corpo_top"> </div>
			<div id="menu">
				<a href="home.php?page=inicio">Início<img src="_img/menu_home/home.png" alt="" /></a>
				<a href="home.php?page=noticias">Notícias<img src="_img/menu_home/noticias.png" alt="" /></a>
				<a href="home.php?page=dicas">Dicas<img src="_img/menu_home/dicas.png" alt="" /></a>
				<a href="home.php?page=servicos">Serviços<img src="_img/menu_home/servicos.png" alt="" /></a>
				<a href="home.php?page=parceiros">Parceiros<img src="_img/menu_home/parceiros.png" alt="" /></a>
				<a href="home.php?page=clientes">Clientes<img src="_img/menu_home/clientes.png" alt="" /></a>
				<a href="home.php?page=login">Login<img src="_img/menu_home/login.png" alt="" /></a>
				<a href="home.php?page=contato">Contato<img src="_img/menu_home/contato.png" alt="" /></a>
			</div>

			<?php

				$link = isset($_GET['page']) ? removeAcentos(strtolower($_GET['page'])) : 'inicio';

				if (file_exists($link.'.php')) {
					include $link.'.php';
				} else {
					include 'indisponivel.php';
				}

			?>

			<div id="sidebar">
			</div>

			<div id="rodape">
				<p>SMC - Serviço de Manutenção e Consultoria</p>
				<p><a href="http://servicodespertador.net" title="Acesse" alt="Acesse" target="_blank">http://servicodespertador.net</a></p>
			</div>
		</div>
	</div>

<?php
	if(isset($_GET['msg'])) {
		echo "<script>alert('".$_GET['msg']."');</script>\n";
	}
?>

</body>

</html>