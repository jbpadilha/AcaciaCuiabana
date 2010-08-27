<?php
	require_once ('../class/Config.php');

	if(!isset($_SESSION['usuarioLogon'])) {
		header("Location:../views/home.php?p=login");
	}

	$logon = new Logon();
	$logon = $_SESSION['usuarioLogon'];
	$clientes = new Clientes();
	$collVo = null;
	if(!is_null($logon->getIdClientes())) {
		$clientes->setIdClientes($logon->getIdClientes());
		$collVo = $controla->findClientes($clientes);
	}
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="pt-br" lang="pt-br">

    <head>

        <title>SMC - Serviço de Manutenção e Consultoria</title>
        <link rel="SHORTCUT ICON" href="imagens/smc.ico" />
        <meta http-equiv="Content-Language" content="pt-BR" />
        <meta name="author" content="Júnior Mendonça" />
        <meta name="copyright" content="SMC - Serviço de Manutenção e Consultoria">
        <meta name="description" content="SMC - Manutenção como deve ser feita." />
        <meta name="keywords" lang="pt-br" content="smc, serviço despertador, servico despertador, servicodespertador, manutenção, preventiva, gestão, frotas, ativos" />

		<style type="text/css">
			body { margin:0px; padding:0px; font:normal 12px "Segoe UI", Arial; text-align:center; background:#FFF url('/_global/_img/bg_10px.png'); }
			a { text-decoration:underline; color:#FA0; }
			#wait { position:absolute; top:50%; left:50%; margin:-50px 0px 0px -200px; padding:10px 20px; width:400px; border:3px solid #FFBB33; background:#FFF; text-align:justify; font-size:120%; }
			#wait p { margin:0px 0px 5px 0px; }
			#wait a, #wait span { font-weight:bold; }	
		</style>

	</head>

    <script type="text/javascript">
        function count(){
            if (document.getElementById('tempo').innerHTML != 0) {
                document.getElementById('tempo').innerHTML = document.getElementById('tempo').innerHTML - 1;
                setTimeout("count()", 1500);
            } else {
<?php
	if(!is_null($collVo)) {
?>
                window.location='meusdados.php';
            }
        }
        setTimeout("count()", 1000);
    </script>

    <body onload="count()">

        <div id="wait">

            <p>Você será redirecionado para a página com seus dados em <span id="tempo">10</span> segundos...</p>
            <p><a href="meusdados.php" target="_self">Clique aqui</a> se não deseja esperar.</p>
<?php
	} else {
?>
                window.location='add_meucpf.php';
            }
        }
        setTimeout("count()",1000);
    </script>

    <body onload="count()">

        <div id="wait">

            <p>Você precisa atualizar os seus dados.</p>
            <p><a href="add_meucpf.php" target="_self">Clique aqui</a> para acessar o formulário ou aguarde <span id="tempo">10</span> segundos...</p>
<?php
	}
?>
            <br />
			<center>
				<img src="/_global/_img/loadingGray.gif" alt="loading" />
			</center>
        </div>

    </body>

</html>