<?php // Selecionar abas
	$aba = (isset($_GET['p'])) ? $_GET['p'] : '';
	switch ($aba) {
		default: 			?><style>#abas .aba1 { width:108px; background:orange; } </style><?php ; break;
		case 'noticias'; 	?><style>#abas .aba2 { width:108px; background:orange; } </style><?php ; break;
		case 'dicas'; 		?><style>#abas .aba3 { width:108px; background:orange; } </style><?php ; break;
		case 'servicos'; 	?><style>#abas .aba4 { width:108px; background:orange; } </style><?php ; break;
		case 'parceiros'; 	?><style>#abas .aba5 { width:108px; background:orange; } </style><?php ; break;
		case 'clientes'; 	?><style>#abas .aba6 { width:108px; background:orange; } </style><?php ; break;
		case 'login'; 		?><style>#abas .aba7 { width:108px; background:orange; } </style><?php ; break;
		case 'contato'; 	?><style>#abas .aba8 { width:108px; background:orange; } </style><?php ; break;
	}
?>

<div id="conteudo">

<div id="abas"> <!-- Menu -->
	<a id="aba1" class="aba aba1" href="?p=inicio" 		> 	<img src="imagens/home.png" alt="" /> 			Início 				</a>
	<a id="aba2" class="aba aba2" href="?p=noticias" 	> 	<img src="imagens/noticias.png" alt="" /> 		Notícicas 			</a>
	<a id="aba2" class="aba aba3" href="?p=dicas" 		> 	<img src="imagens/dicas.png" alt="" /> 			Dicas 				</a>
	<a id="aba3" class="aba aba4" href="?p=servicos" 	> 	<img src="imagens/servicos.png" alt="" /> 		Nossos serviços 	</a>
	<a id="aba4" class="aba aba5" href="?p=parceiros" 	> 	<img src="imagens/parceiros.png" alt="" /> 		Nossos parceiros 	</a>
	<a id="aba5" class="aba aba6" href="?p=clientes" 	> 	<img src="imagens/clientes.png" alt="" /> 		Nossos clientes 	</a>
	<a id="aba6" class="aba aba7" href="?p=login" 		> 	<img src="imagens/login.png" alt="" /> 			Login 				</a>
	<a id="aba7" class="aba aba8" href="?p=contato" 	> 	<img src="imagens/small_contato.png" alt="" /> 	Contato 			</a>
</div>

<div id="container"> <!-- Mostrar conteúdo selecionado -->
	<?php
		$pagina = (isset($_GET['p'])) ? $_GET['p'] : '';
		switch ($pagina) {
			default: 			include ('inicio.php'); 			break;
			case 'noticias'; 	include ('noticias.php'); 			break;
			case 'dicas'; 		include ('dicas.php'); 				break;
			case 'servicos'; 	include ('servicos.php'); 			break;
			case 'parceiros'; 	include ('desenvolvimento.php'); 	break;
			case 'clientes'; 	include ('desenvolvimento.php'); 	break;
			case 'login'; 		include ('login.php'); 				break;
			case 'contato'; 	include ('contato.php'); 			break;
		}
	?>
</div>

<?php include ('sidebar.php') ?>

</div>