<?php 
if(isset($_GET['msg']))
{
	echo "<script>alert('{$_GET['msg']}');</script>";
}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Frameset//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-frameset.dtd">
<html>

<head>
	<title>SMC</title>
	<link href="imagens/smc.ico" rel="SHORTCUT ICON"/>
	<link href="css/home.css" rel="stylesheet" type="text/css" >
	<script language="javascript" type="text/javascript" src="scripts/inputs.js" ></script>
	<meta name="description" lang="pt-BR" content="Manutenção como deve ser feita. - Bem vindo." xml:lang="pt-BR"/>
	<meta name="keywords" lang="pt-BR" content="noticias, manutenção, preventiva, sucesso, empresa, smc" xml:lang="pt-BR"/>
</head>

<link rel="stylesheet" media="screen" type="text/css" href="css/datepicker.css" />
<script type="text/javascript" src="js/datepicker.js"></script>

<body class="home">
<div id="topo">
	<p><a href="index.php" ><img src="imagens/smc_logo.png" alt="SMC - Serviços, Manutenção e Consultoria" title="Serviços, Manutenção e Consultoria" ></a></p>
	<p>A manutenção como deve ser feita.</p>
</div>

<?php /* Inicio conteudo */
	$aba_selecionada = 'width:110px; color:#000; background:url("imagens/bg_abass.png") no-repeat left center;';
	$aba = (isset($_GET['p'])) ? $_GET['p'] : '';
	switch ($aba) {
		default: ?><style>ul.abas .aba1 {<?php echo $aba_selecionada ?>}</style><?php ; break;
		case 'noticias'; ?><style>ul.abas .aba2 {<?php echo $aba_selecionada ?>}</style><?php ; break;
		case 'dicas'; ?><style>ul.abas .aba3 {<?php echo $aba_selecionada ?>}</style><?php ; break;
		case 'servicos'; ?><style>ul.abas .aba4 {<?php echo $aba_selecionada ?>}</style><?php ; break;
		case 'parceiros'; ?><style>ul.abas .aba5 {<?php echo $aba_selecionada ?>}</style><?php ; break;
		case 'clientes'; ?><style>ul.abas .aba6 {<?php echo $aba_selecionada ?>}</style><?php ; break;
		case 'login'; ?><style>ul.abas .aba7 {<?php echo $aba_selecionada ?>}</style><?php ; break;
		case 'contato'; ?><style>ul.abas .aba8 {<?php echo $aba_selecionada ?>}</style><?php ; break;
	}
?>

<div id="conteudo">

	<ul class="abas">
		<li class="aba aba1" onclick="window.location='?p=inicio';" ><img src="imagens/home.png" alt="Início" />Início</li>
		<li class="aba aba2" onclick="window.location='?p=noticias';" ><img src="imagens/noticias.png" alt="Notícias" />Notícicas</li>
		<li class="aba aba3" onclick="window.location='?p=dicas';" ><img src="imagens/dicas.png" alt="Dicas" />Dicas</li>
		<li class="aba aba4" onclick="window.location='?p=servicos';" ><img src="imagens/servicos.png" alt="Serviços" />Nossos serviços</li>
		<li class="aba aba5" onclick="window.location='?p=parceiros';" ><img src="imagens/parceiros.png" alt="Parceiros" />Nossos parceiros</li>
		<li class="aba aba6" onclick="window.location='?p=clientes';" ><img src="imagens/clientes.png" alt="Clientes" />Nossos clientes</li>
		<li class="aba aba7" onclick="window.location='?p=login';" ><img src="imagens/login.png" alt="Login" />Login</li>
		<li class="aba aba8" onclick="window.location='?p=contato';" ><img src="imagens/small_contato.png" alt="Contato" />Contato</li>
	</ul>

	<div id="container">
	<?php
		$pagina = (isset($_GET['p'])) ? $_GET['p'] : '';
		switch ($pagina) {
			default: include ('inicio.php'); break;
			case 'noticias'; include ('noticias.php'); break;
			case 'dicas'; include ('dicas.php'); break;
			case 'servicos'; include ('servicos.php'); break;
			case 'parceiros'; include ('parceiros.php'); break;
			case 'clientes'; include ('clientes.php'); break;
			case 'login'; include ('login.php'); break;
			case 'contato'; include ('contato.php'); break;
		}
	?>
	</div>

	<div id="sidebar">
		<div id="parceiros"><p>PARCEIROS</p>
			<img src="imagens/sejaparceiro.png" alt="Seja nosso parceiro" title="Seja nosso parceiro" onclick="window.location='?p=contato';" />
			<img src="imagens/ng20.jpg" alt="NG 20 anos" title="NG 20 anos" onclick="window.open('http://www.ngi.com.br','NG20');" />
		</div>
		<div id="vertical"> </div>
		<div id="links"><p>LINKS ÚTEIS</p>
			<a href="http://www.denatran.gov.br/" target="_links"><img src="http://www.iti.gov.br/twiki/pub/Noticias/PressRelease2009Mar27_142336/logo_denatran.jpg" alt="DENATRAN" title="Departamento Nacional de Trânsito" /></a>
			<a href="http://www.detran.mt.gov.br/" target="_links"><img src="http://www.detran.mt.gov.br/images/logo.jpg" alt="DETRAN - MT" title="Departamento Estadual de Trânsito de Mato Grosso" /></a>
			<a href="http://www.correios.com.br/" target="_links"><img src="http://www.correios.com.br/imagesect/lg_correios_original.gif" alt="CORREIOS" title="Site dos correios" /></a>
		</div>
	</div>

</div>

<div id="separador"></div>

<div id="rodape">
	<p class="titulo">SMC - Serviços, Manutenção e Consultoria</p>
	<p><a href="http://www.servicodespertador.net">www.servicodespertador.net</a></p>
</div>

</body>

</html>