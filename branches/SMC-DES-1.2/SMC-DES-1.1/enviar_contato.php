<?php

// Recebendo os dados passados pela p�gina "form_contato.php"
$recebenome 	= $_POST['nome'];
$recebemail 	= $_POST['email'];
$recebeempresa 	= $_POST['empresa'];
$recebefone 	= $_POST['fone'];
$recebemsg  	= $_POST['mensagem'];

$data_tmp 		= date("d/m/Y");
$hora_tmp 		= date("h:i:s");

// Definindo os cabe�alhos do e-mail
$headers = "MIME-Version: 1.0\r\n";
$headers .= "Content-type:text/html; charset=iso-8859-1\r\n";
$headers .= "From: $recebenome <$recebemail> \r\n";

// Vamos definir agora o destinat�rio do email, ou seja, VOC� ou SEU CLIENTE
$para = "contato@servicodespertador.net";

// Definindo o aspecto da mensagem
$mensagem = "
De.......: ".$recebenome." <".$recebemail.">
Fone.....: ".$recebefone."
Assunto..: Contato do site"."
Mensagem.: ".$recebemsg."
";

$envia =  mail($para,"Contato (".$data_tmp." - ".$hora_tmp.")",$mensagem,$headers);
  
// Envia um e-mail para o remetente, agradecendo a visita no site, e dizendo que em breve o e-mail ser� respondido.
$headers2 = "MIME-Version: 1.0\r\n";
$headers2 .= "Content-type:text/html; charset=iso-8859-1\r\n";
$headers2 .= "From: SMC - Servi�o Despertador <$para> \r\n";

$para2 = $recebemail;
$mensagem2  = "
	<p>Ol� {$recebenome}. Agrade�emos o seu contato.</p>
	<p>* N�o � necess�rio responder esta mensagem.</p>
";
$envia2 =  mail($para2,"a SMC recebeu a sua mensagem!",$mensagem2,$headers2);

// Exibe na tela a mensagem de sucesso, e depois redireciona devolta para a p�gina anterior.
echo "<script>alert('Sua mensagem foi enviada.');window.location='http://servicodespertador.net/home.php'; </script>";

?>