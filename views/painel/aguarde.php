<?php
require_once ('../../class/Config.php');
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
if(!is_null($collVo)) {
    ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
        <link rel="stylesheet" href="../css/home.css" type="text/css" media="all" />
    </head>

    <script type="text/javascript">
        function count(){
            if(document.getElementById('tempo').innerHTML!='0'){
                document.getElementById('tempo').innerHTML=document.getElementById('tempo').innerHTML-1;
                setTimeout("count()",1500);
            }else{
                window.location='meusdados.php';
            }
        }
        setTimeout("count()",1000);
    </script>

    <body onload="count()">

        <div id="wait">

            <p>Voc� ser� redirecionado para a p�gina com seus dados em <span id="tempo">10</span> segundos...</p>
            <p><a href="meusdados.php" target="_self">Clique aqui</a> se n�o deseja esperar ou <a href="../home.php">aqui</a> para voltar � p�gina principal.</p>
            <br /><br />
            <img src="../imagens/loading.gif" alt="loading" />

        </div>
    </body>
</html>
    <?php
}
else {
    ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
        <link rel="stylesheet" href="../css/home.css" type="text/css" media="all" />
    </head>

    <script type="text/javascript">
        function count(){
            if(document.getElementById('tempo').innerHTML!='0'){
                document.getElementById('tempo').innerHTML=document.getElementById('tempo').innerHTML-1;
                setTimeout("count()",1500);
            }else{
                window.location='add_meucpf.php';
            }

        }
        setTimeout("count()",1000);
    </script>

    <body onload="count()">

        <div id="wait">

            <p>Você ainda não possui um registro em nosso banco de dados.</p>
            <p>Para preencher o formulário <a href="add_meucpf.php" target="_self">clique aqui</a> ou aguarde <span id="tempo">10</span> segundos...</p>
            <br /><br />
            <img src="../imagens/loading.gif" alt="loading" />

        </div>

    </body>

</html>
    <?php
}
?>