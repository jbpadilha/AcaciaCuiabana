<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">

<html>

<head>
	<title>SMC - Serviço de Manutenção e Consultoria</title>
	<link rel="SHORTCUT ICON" href="imagens/smc.ico" />
	<meta http-equiv="Content-Language" content="pt-BR" />
	<meta name="author" content="Júnior Mendonçaa" />
	<meta name="copyright" content="SMC - Serviço de Manutenção e Consultoria">
	<meta name="description" content="SMC - Manutenção como deve ser feita." />
	<meta name="keywords" lang="pt-br" content="smc, serviço despertador, servico despertador, servicodespertador, manutenção, preventiva, gestão, frotas, ativos" />

    <link type="text/css" rel="stylesheet" media="screen" href="/_global/_css/smc/home.css" />

	<script type="text/javascript" language="javascript" src="/_global/_js/jquery-1.4.2.js"></script>
	<script type="text/javascript" language="javascript" src="/_global/_js/jquery.maskedinput-1.2.2.js"></script>
	<script type="text/javascript" language="javascript" src="/_global/_js/jquery.price_format.1.2.js"></script>
	<script type="text/javascript" language="javascript" src="/_global/_js/jquery.gt.extensions.js"></script>
	<script type="text/javascript" language="javascript" src="/_global/_js/demo.js"></script>
</head>

<body>

	<div id="barra">
		<span id="ajustaFonte">
		Tamanho do texto:
			<label alt="menor">[-]</label>
			<label alt="padrao">12px</label>
			<label alt="maior">[+]</label>
		</span>
	</div>

	<div id="site">

		<div id="header">
			<img src="/_global/_img/smc/smc_logo_276x120.png" alt="SMC" />
			<h1>Manutenção como deve ser feita</h1>
		</div>

		<div id="corpo">
			<div id="corpo_top"> </div>
			<div id="menu">
				<a href="home.php?page=inicio">Início<img src="/_global/_img/smc/menu_home/home.png" alt="" /></a>
				<a href="home.php?page=noticias">Notícias<img src="/_global/_img/smc/menu_home/noticias.png" alt="" /></a>
				<a href="home.php?page=dicas">Dicas<img src="/_global/_img/smc/menu_home/dicas.png" alt="" /></a>
				<a href="home.php?page=servicos">Serviços<img src="/_global/_img/smc/menu_home/servicos.png" alt="" /></a>
				<a href="home.php?page=parceiros">Parceiros<img src="/_global/_img/smc/menu_home/parceiros.png" alt="" /></a>
				<a href="home.php?page=clientes">Clientes<img src="/_global/_img/smc/menu_home/clientes.png" alt="" /></a>
				<a href="home.php?page=login">Login<img src="/_global/_img/smc/menu_home/login.png" alt="" /></a>
				<a href="home.php?page=contato">Contato<img src="/_global/_img/smc/menu_home/contato.png" alt="" /></a>
			</div>

			<?php
			$link = isset($_GET['page']) ? $_GET['page'] : 'inicio';
//                $link = isset($_GET['page']) ? removeAcentos(strtolower($_GET['page'])) : 'inicio';

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
	   ?>
	   <script type="text/javascript">
	   alert('<?php echo $_GET['msg']; ?>');
	   </script>
	  <?php
	}
	?>

</body>

</html>