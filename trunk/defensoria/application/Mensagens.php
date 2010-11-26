<?php

class Mensagens {
	
	public static $arrayMensagens = Array();
	
	public function __construct()
	{
		$this->arrayMensagens["ERRO"] = "Erro ao tentar carregar a funcionalidade.";
		$this->arrayMensagens["ACESSO_NEGADO"] = "Acesso não autorizado.";
		$this->arrayMensagens["USUARIO_SENHA_INCORRETO"] = "Usuario ou senha incorreto. Tente novamente.";
		$this->arrayMensagens["ACESSAR_BANCO_DADOS"] = "Erro ao tentar acessar o banco de dados.";
	}
}

?>