<?php

class Mensagens {
	
	public static $arrayMensagens = Array();
	
	public function __construct()
	{
		//MENSAGENS DE ERRO
		$this->arrayMensagens["ERRO"] = "Erro ao tentar carregar a funcionalidade.";
		$this->arrayMensagens["ACESSO_NEGADO"] = "Acesso não autorizado.";
		$this->arrayMensagens["ACESSAR_BANCO_DADOS"] = "Erro ao tentar acessar o banco de dados.";
		$this->arrayMensagens["ERRO_ACESSAR_FUNCIONALIDADE"] = "Erro ao tentar acessar a funcionalidade.";
		
		//CAMPOS
		$this->arrayMensagens["USUARIO_SENHA_INCORRETO"] = "Usuario ou senha incorreto. Tente novamente.";
		$this->arrayMensagens["CAMPO_OBRIGATORIO"] = "Por favor, preencher todos os campos obrigatórios.";
		
		//MENSAGENS DE SUCESSO
		$this->arrayMensagens["SUCESSO_CADASTRO"] = "Cadastro realizado com sucesso.";
	}
	
	
}

?>