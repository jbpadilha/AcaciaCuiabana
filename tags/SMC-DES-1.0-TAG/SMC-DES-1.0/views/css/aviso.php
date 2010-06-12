<?php
mysql_connect('localhost','s87637_root','admin') or die (mysql_error());
mysql_select_db('s87637_tudo') or die (mysql_error());

$aviso = mysql_query("SELECT * FROM login");

while ($avisa = mysql_fetch_array($aviso)) {

$assunto = "Feliz 2010!";
$destinatario = $avisa['email'];

$headers = "MIME-Version: 1.0\r\n";
$headers .= "Content-type: text/html; charset=iso-8859-1\r\n";
$headers .= "From: SMC - Serviço Despertador \r\n";

$conteudo = '
	<style>
		#mensagem { float:left; font:14px "Segoe UI", Verdana, Arial; text-align:center; border-left:3px solid #FFAA00; width:760px; }
		a { text-decoration:none; color:#FF8800; }
		img { border:none; margin-top:5px; margin-right:10px; }
		p { margin:0px 10px; }
		b.smc { color:#FF8800; }
		p.logo { font: 14px "Segoe UI", Verdana, Arial;  }
		#texto { float:left; width:760px; color:#000; font:normal 16px "Segoe UI", Verdana, Arial; border-bottom:1px dotted #AAA; text-align:justify; margin-bottom:0px; background:#040404; color:#FFF; }
		img.back { width:100%; height:200px; }
		img.brinde { float:left; height:200px; margin-right:35px; }
		img.logo { clear:both; width:260px; }
	</style>
	
	<div id="mensagem">
		<div id="texto">
			<img src="http://servicodespertador.net/imagens/fogos.jpg" alt="" title="" class="back" />
			<img src="http://servicodespertador.net/imagens/brinde.png" alt="Se beber, Não diriga!" title="Se beber, Não diriga!" class="brinde" />
			<br><br>
			<p><b>'.$avisa["nome"].'</b>,</p>
			<br><br><br>
			<p>A <b class="smc">SMC</b> deseja a você e a sua famï¿½lia um 2010 repleto de <b>saï¿½de</b> e <b>sucesso</b>.</p>
			<br>
			<p align="center"><b>Boas festas!</b></p>
			<br>
			<center>
			</center>
		</div>
	<a href="http://servicodespertador.net" target="SMC" title="Visite-nos.">
		<img src="http://servicodespertador.net/imagens/smc_logo.png" alt="A manutenï¿½ï¿½o como deve ser feita." title="A manutenï¿½ï¿½o como deve ser feita." class="logo" />
	</a>
	
	<p class="logo"> <b>S</b>erviï¿½os, <b>M</b>anutenï¿½ï¿½o e <b>C</b>onsultoria. </p>
	<p> <a href="http://servicodespertador.net" target="SMC" title="Visite-nos.">servicodespertador.net</a>
	</div>
';

$enviar = mail($destinatario, $assunto, $conteudo, $headers);
echo "Um e-mail foi enviado para: {$avisa['email']}<br/>";
}
?>