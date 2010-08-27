<form action="" method="post">
<input type="text" name="enc">
<input type="submit" value="Encripta">
<form><br>
<?php
$senha = $_POST['enc'];
function encrypt ($senha) {return base64_encode(pack('H*', sha1($senha)));}
$enc	= encrypt($_POST['enc']);
if (@$_POST) {echo $enc; }
else {}
?>