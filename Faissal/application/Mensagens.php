<?php
class Mensagens {
	
	public $arrayMensagens = Array();
	
	public function __construct()
	{
		//MENSAGENS DE ERRO
		$this->arrayMensagens["ERRO"] = "Erro ao tentar carregar a funcionalidade.";
		$this->arrayMensagens["ACESSO_NEGADO"] = "Acesso n�o autorizado.";
		$this->arrayMensagens["ACESSAR_BANCO_DADOS"] = "Erro ao tentar acessar o banco de dados.";
		$this->arrayMensagens["ERRO_ACESSAR_FUNCIONALIDADE"] = "Erro ao tentar acessar a funcionalidade.";
		$this->arrayMensagens["ERRO_USUARIO_EXISTENTE"] = "Os dados Informados j� foi utilizado por outra pessoa.";
		
		//CAMPOS
		$this->arrayMensagens["USUARIO_SENHA_INCORRETO"] = "Usuario ou senha incorreto. Tente novamente.";
		$this->arrayMensagens["CAMPO_OBRIGATORIO"] = "Por favor, preencher todos os campos obrigat�rios.";
		
		//MENSAGENS DE SUCESSO
		$this->arrayMensagens["SUCESSO_CADASTRO"] = "Cadastro realizado com sucesso.";
		$this->arrayMensagens["SUCESSO_DELETAR"] = "Deletado com sucesso.";
		$this->arrayMensagens["SUCESSO_ALTERAR"] = "Alterado com sucesso.";
	}
	
	public function getMensagem($chavemensagem)
	{
		$mensagens = new Mensagens();
		if(array_key_exists($chavemensagem,$mensagens->arrayMensagens))
		{
			return $mensagens->arrayMensagens[$chavemensagem];
		}
		else
		{
			return "";
		}
	}
	
}

?>