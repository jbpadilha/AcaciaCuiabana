<script type="text/javascript">
<?php
		if(isset($_GET['mensagemErro']) || isset($_SESSION['mensagemErro']))
		{   
			$MENSAGEM_ERRO = new ArrayIterator(unserialize(urldecode($_GET['mensagemErro'])));
			echo "$( '#erros' ).html( '";
			foreach ($MENSAGEM_ERRO as $mensagem)
			{
				echo str_ireplace("'","\'",$mensagem)."<br/>";
			}
			echo "' );";
			echo "$('#sucesso').html('');'";
		}
		if(isset($_GET['mensagemSucesso']) || isset($_SESSION['mensagemSucesso']))
		{   
			$MENSAGEM_SUCESSO = new ArrayIterator(unserialize(urldecode($_GET['mensagemSucesso'])));
			echo "$( '#sucesso' ).html( '";
			foreach ($MENSAGEM_SUCESSO as $mensagem)
			{
				echo str_ireplace("'","\'",$mensagem)."<br/>";
			}
			echo "' );";
			echo "$('#erros').html('');'";
		}
	?>
</script>