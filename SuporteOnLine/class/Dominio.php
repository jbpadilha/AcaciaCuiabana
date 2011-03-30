<?php
///####################################
// * João Batista Padilha e Silva Analista/Desenvolvedor (Ábaco Tecnologia)
// * Arquivo: Dominio.php
// * Criação: João Batista Padilha e Silva
// * Revisão:
// * Data de criação: 24/06/2008
//####################################
 
/**
 * Classe de Dominios do Sistema.
 * @author João Batista Padilha e Silva
 */
class Dominio
{
	public $DB_HOST = "192.168.2.3";
	public $DB_USER = "des_suporte21";
	public $DB_PASSWD = "abacoaba";
	public $DB_DATA = "des_suporte21";
	
	public $path_fisico = "C:/Des/PHP/SuporteOnLine/";
	public $path_externo = "http://localhost/SuporteOnLine/";
	
	public $botaoVoltar = "btvoltar";
	public $botaoVoltar_TXT = " Voltar ";
	public $botaoVoltar_msg = "Clique para voltar";
	public $botaoConfirmar = "btconfirmar";
	public $botaoConfirmar_TXT = " Confirmar ";
	public $botaoConfirmar_msg = "Clique para confirmar";
	public $botaoLimpar = "btlimpar";
	public $botaoLimpar_TXT = " Limpar ";
	public $botaoLimpar_msg = "Clique para limpar os campos";
	public $botaoSubPedido = "btSubPedido";
	public $botaoSubPedido_TXT = " Criar Sub-Pedido ";
	public $botaoComplementarPedido = 'btComplementarPedido';
	public $botaoComplementarPedido_TXT = ' Complementar Pedido ';
	public $botaoReceberPedido = "btReceberPedido";
	public $botaoReceberPedido_TXT = " Receber Pedido ";
	public $botaoIniciarDesenvolvimentoPedido = "btIniciarDesenvolvimentoPedido";
	public $botaoIniciarDesenvolvimentoPedido_TXT = " Iniciar Atendimento ";
	public $botaoDevolverPedido = "brDevolverPedido";
	public $botaoDevolverPedido_TXT = " Devolver Pedido ";
	public $botaoFecharPedido = "btFecharPedido";
	public $botaoFecharPedido_TXT = " Concluir Atendimento ";
	public $botaoConcluirPedido = "btConcluirPedido";
	public $botaoConcluirPedido_TXT = " Concluir Pedido ";
	public $botaoReenviarPedido = "btReenviarPedido";
	public $botaoReenviarPedido_TXT = " Re-enviar Pedido ";
	public $botaoVerNaoConformidadePedido = "brVerNaoConformidades";
	public $botaoVerNaoConformidadePedido_TXT = " Ver Não Conformidade ";
	
	public $select = "----- SELECIONE -----";
	
	public $mensagemEmailLembrarSenha = "Sua nova senha é: ";
	
	 
	// Dominio Usuarios
	public $DomnUsuarios_Suspenso = 1;
	public $DomnUsuarios_NaoSuspenso = 0;
	
	//Dominio Funcionalidades
	public $DomnTipoFuncionalidade_Botao = 1;
	public $DomnTipoFuncionalidade_Menu = 2;
	public $DomnTipoFuncionalidade_SubMenu = 3;
	public $DomnTipoFuncionalidade_Campo = 4;
	
	public $DomnTipoFuncionalidade_Botao_TXT = "Botão";
	public $DomnTipoFuncionalidade_Menu_TXT = "Menu";
	public $DomnTipoFuncionalidade_SubMenu_TXT = "Sub-Menu";
	public $DomnTipoFuncionalidade_Campo_TXT = "Campo-Seleção";
	

	// Dominio Pedidos
	
	public $DomnStatusPedido_Novo = 1;
	public $DomnStatusPedido_Recebido = 2;
	public $DomnStatusPedido_Desenvolvimento = 3;
	public $DomnStatusPedido_Fechado = 4;
	public $DomnStatusPedido_Concluido = 5;
	public $DomnStatusPedido_Devolvido = 6;
	
	public $DomnStatusPedido_Novo_TXT = "Novo";
	public $DomnStatusPedido_Recebido_TXT = "Recebido";
	public $DomnStatusPedido_Desenvolvimento_TXT = "Em Desenvolvimento";
	public $DomnStatusPedido_Fechado_TXT = "Fechado";
	public $DomnStatusPedido_Concluido_TXT = "Concluído";
	public $DomnStatusPedido_Devolvido_TXT = "Devolvido";
	
	
	// Domínio Log Suporte
	
	public $DomnAcao_Log_Suporte_Incluir = 1;
	public $DomnAcao_Log_Suporte_Alterar = 2;
	public $DomnAcao_Log_Suporte_Deletar = 3;
	
	public $DomnAcao_Log_Suporte_Incluir_TXT = "Incluir";
	public $DomnAcao_Log_Suporte_Alterar_TXT = "Alterar";
	public $DomnAcao_Log_Suporte_Deletar_TXT = "Deletar";
	
	//Severidade
	public $DomnSeveridade_Leve = 1;
	public $DomnSeveridade_Leve_TXT = "Leve";
	public $DomnSeveridade_Moderada = 2;
	public $DomnSeveridade_Moderada_TXT = "Moderada";
	public $DomnSeveridade_Grave = 3;
	public $DomnSeveridade_Grave_TXT = "Grave";
	public $DomnSeveridade_Critica = 4;
	public $DomnSeveridade_Critica_TXT = "Critica";
	
	
	//Dominio Papel
	public $DomnPapel_Usuario = 1;
	public $DomnPapel_Usuario_TXT = "Usuário";
	
	//Dominio de Funcionalidades
	public $DomnFuncionalidade_Pedidos_Modulo_SubModulo = 1;
	public $DomnFuncionalidade_Pedidos_Modulo_SubModulo_TXT = "Acesso à selecionar Módulo/Sub-Módulo em Pedidos";
	public $DomnFuncionalidade_Pedidos_Tecnologia_Atividades = 2;
	public $DomnFuncionalidade_Pedidos_Tecnologia_Atividades_TXT = "Acesso à selecionar Tecnologias/Atividades em Pedidos";
	public $DomnFuncionalidade_Pedidos_Versao = 3;
	public $DomnFuncionalidade_Pedidos_Versao_TXT = "Acesso à selecionar Versão em Pedidos";
	public $DomnFuncionalidade_Pedidos_Papel_Usuario_Destinatario = 4;
	public $DomnFuncionalidade_Pedidos_Papel_Usuario_Destinatario_TXT = "Acesso à selecionar Papeis e Usuários em Pedidos";
	public $DomnFuncionalidade_Pedidos_Previsao_Entrega = 5;
	public $DomnFuncionalidade_Pedidos_Previsao_Entrega_TXT = "Acesso à visualizar Previsão de Entrega em Pedidos";
	public $DomnFuncionalidade_Pedidos_Pesquisar_Todos_Pedidos = 6;
	public $DomnFuncionalidade_Pedidos_Pesquisar_Todos_Pedidos_TXT = "Acesso a pesquisa Geral de Pedidos";
	public $DomnFuncionalidade_Pedidos_Concluir_Pedido = 7;
	public $DomnFuncionalidade_Pedidos_Concluir_Pedido_TXT = "Acesso à Concluir Pedido";
	
	//Dominio de Clientes
	public $DomnClientes_Abaco = 1;
	public $DomnClientes_Abaco_TXT = "Ábaco";
	
	
	//Dominio Motivos Não Conformidades
	
	
	/**
	 * Método que monta o select do tipo da funcionalidade
	 * @author João Batista Padilha e Silva
	 * @param integer $tipoFuncionalidade
	 * @param var $eventoOnChange
	 * @return var
	 */
	public function montaSelectDomnTipoFuncionalidades($tipoFuncionalidade,$eventoOnChange)
	{
		
		$montaSelect =' <select id="tipoFuncionalidades" name="tipoFuncionalidades" class="campo" onchange="'.$eventoOnChange.'">
							<option value="">'.$this->select.'</option>';
		
		if($tipoFuncionalidade == $this->DomnTipoFuncionalidade_Botao)
			$montaSelect .= '<option value="'.$this->DomnTipoFuncionalidade_Botao.'" selected="selected">'.$this->DomnTipoFuncionalidade_Botao_TXT.'</option>';
		else
			$montaSelect .= '<option value="'.$this->DomnTipoFuncionalidade_Botao.'">'.$this->DomnTipoFuncionalidade_Botao_TXT.'</option>';
			
		if($tipoFuncionalidade == $this->DomnTipoFuncionalidade_Menu)
			$montaSelect .= '<option value="'.$this->DomnTipoFuncionalidade_Menu.'" selected="selected">'.$this->DomnTipoFuncionalidade_Menu_TXT.'</option>';
		else
			$montaSelect .= '<option value="'.$this->DomnTipoFuncionalidade_Menu.'">'.$this->DomnTipoFuncionalidade_Menu_TXT.'</option>';

		if($tipoFuncionalidade == $this->DomnTipoFuncionalidade_SubMenu)
			$montaSelect .= '<option value="'.$this->DomnTipoFuncionalidade_SubMenu.'" selected="selected">'.$this->DomnTipoFuncionalidade_SubMenu_TXT.'</option>';
		else
			$montaSelect .= '<option value="'.$this->DomnTipoFuncionalidade_SubMenu.'">'.$this->DomnTipoFuncionalidade_SubMenu_TXT.'</option>';
		
		if($tipoFuncionalidade == $this->DomnTipoFuncionalidade_Campo)
			$montaSelect .= '<option value="'.$this->DomnTipoFuncionalidade_Campo.'" selected="selected">'.$this->DomnTipoFuncionalidade_Campo_TXT.'</option>';
		else
			$montaSelect .= '<option value="'.$this->DomnTipoFuncionalidade_Campo.'">'.$this->DomnTipoFuncionalidade_Campo_TXT.'</option>';
							
		$montaSelect .='</select>';
		
		return $montaSelect;
	}
	
	/**
	 * Método que monta o select de severidades
	 * @author João Batista Padilha e Silva
	 * @param var $eventoOnChange
	 * @return var
	 */
	public function montaSelectSeveridade($severidadeSelecionada = '', $eventoOnChange = '')
	{
		$montaSelect =' <select id="severidadePedidos" name="severidadePedidos" class="campo" onchange="'.$eventoOnChange.'">
							<option value="">'.$this->select.'</option>';
		$selected = '';
		if($severidadeSelecionada != '')
		{
			$selected = 'selected="selected"';
		}
		
		$montaSelect .= '<option value="'.$this->DomnSeveridade_Leve.'" '.$selected.'>'.$this->DomnSeveridade_Leve_TXT.'</option>';
		$montaSelect .= '<option value="'.$this->DomnSeveridade_Moderada.'" '.$selected.'>'.$this->DomnSeveridade_Moderada_TXT.'</option>';
		$montaSelect .= '<option value="'.$this->DomnSeveridade_Grave.'" '.$selected.'>'.$this->DomnSeveridade_Grave_TXT.'</option>';
		$montaSelect .= '<option value="'.$this->DomnSeveridade_Critica.'" '.$selected.'>'.$this->DomnSeveridade_Critica_TXT.'</option>';

		$montaSelect .='</select>';
		
		return $montaSelect;
	}
	
	/**
	 * Método que retorna o nome do DomnStatusPedido
	 * @author João Batista Padilha e Silva
	 * @param int $DomnStatusPedido
	 * @return var
	 */
	public function mostraDomnStatusPedido($DomnStatusPedido)
	{
		$mostra = '';
		if($DomnStatusPedido == $this->DomnStatusPedido_Concluido)
		{
			$mostra = $this->DomnStatusPedido_Concluido_TXT;
		}
		if($DomnStatusPedido == $this->DomnStatusPedido_Desenvolvimento)
		{
			$mostra = $this->DomnStatusPedido_Desenvolvimento_TXT;
		}
		if($DomnStatusPedido == $this->DomnStatusPedido_Devolvido)
		{
			$mostra = $this->DomnStatusPedido_Devolvido_TXT;
		}
		if($DomnStatusPedido == $this->DomnStatusPedido_Fechado)
		{
			$mostra = $this->DomnStatusPedido_Fechado_TXT;
		}
		if($DomnStatusPedido == $this->DomnStatusPedido_Novo)
		{
			$mostra = $this->DomnStatusPedido_Novo_TXT;
		}
		if($DomnStatusPedido == $this->DomnStatusPedido_Recebido)
		{
			$mostra = $this->DomnStatusPedido_Recebido_TXT;
		}
		return $mostra;
	}
	
	/**
	 * Método que retorna o nome do DomnSeveridade
	 * @author João Batista Padilha e Silva
	 * @param int $DomnSeveridade
	 * @return var
	 */
	public function mostraDomnSeveridade($DomnSeveridade)
	{
		$mostra = '';
		
		if($DomnSeveridade == $this->DomnSeveridade_Leve)
		{
			$mostra = $this->DomnSeveridade_Leve_TXT;
		}
		if($DomnSeveridade == $this->DomnSeveridade_Moderada)
		{
			$mostra = $this->DomnSeveridade_Moderada_TXT;
		}
		if($DomnSeveridade == $this->DomnSeveridade_Grave)
		{
			$mostra = $this->DomnSeveridade_Grave_TXT;
		}
		if($DomnSeveridade == $this->DomnSeveridade_Critica)
		{
			$mostra = $this->DomnSeveridade_Critica_TXT;
		}
		return $mostra;
	}
	
	/**
	 * Método que mostra todos os Dominios de Funcionalidades em TR
	 * @author João Batista Padilha e Silva
	 * @return var
	 */
	public function mostraTodosDomnFuncionalidades()
	{
		$mostra = '
				<tr class="linhaListagem">
					<td><input type="checkbox" name="'.$this->DomnFuncionalidade_Pedidos_Modulo_SubModulo.'" id="'.$this->DomnFuncionalidade_Pedidos_Modulo_SubModulo.'" value="'.$this->DomnFuncionalidade_Pedidos_Modulo_SubModulo."&".$this->DomnFuncionalidade_Pedidos_Modulo_SubModulo_TXT.'" /></td>
					<td>'.$this->DomnFuncionalidade_Pedidos_Modulo_SubModulo_TXT.'</td>
					<td>&nbsp;</td>
					<td>&nbsp;</td>
				</tr>
					';
		$mostra .= '
				<tr class="linha2Listagem">
					<td><input type="checkbox" name="'.$this->DomnFuncionalidade_Pedidos_Papel_Usuario_Destinatario.'" id="'.$this->DomnFuncionalidade_Pedidos_Papel_Usuario_Destinatario.'" value="'.$this->DomnFuncionalidade_Pedidos_Papel_Usuario_Destinatario."&".$this->DomnFuncionalidade_Pedidos_Papel_Usuario_Destinatario_TXT.'" /></td>
					<td>'.$this->DomnFuncionalidade_Pedidos_Papel_Usuario_Destinatario_TXT.'</td>
					<td>&nbsp;</td>
					<td>&nbsp;</td>
				</tr>
					';
		$mostra .= '
				<tr class="linhaListagem">
					<td><input type="checkbox" name="'.$this->DomnFuncionalidade_Pedidos_Previsao_Entrega.'" id="'.$this->DomnFuncionalidade_Pedidos_Previsao_Entrega.'" value="'.$this->DomnFuncionalidade_Pedidos_Previsao_Entrega."&".$this->DomnFuncionalidade_Pedidos_Previsao_Entrega_TXT.'" /></td>
					<td>'.$this->DomnFuncionalidade_Pedidos_Previsao_Entrega_TXT.'</td>
					<td>&nbsp;</td>
					<td>&nbsp;</td>
				</tr>
					';
		$mostra .= '
				<tr class="linha2Listagem">
					<td><input type="checkbox" name="'.$this->DomnFuncionalidade_Pedidos_Tecnologia_Atividades.'" id="'.$this->DomnFuncionalidade_Pedidos_Tecnologia_Atividades.'" value="'.$this->DomnFuncionalidade_Pedidos_Tecnologia_Atividades."&".$this->DomnFuncionalidade_Pedidos_Tecnologia_Atividades_TXT.'" /></td>
					<td>'.$this->DomnFuncionalidade_Pedidos_Tecnologia_Atividades_TXT.'</td>
					<td>&nbsp;</td>
					<td>&nbsp;</td>
				</tr>
					';
		$mostra .= '
				<tr class="linhaListagem">
					<td><input type="checkbox" name="'.$this->DomnFuncionalidade_Pedidos_Versao.'" id="'.$this->DomnFuncionalidade_Pedidos_Versao.'" value="'.$this->DomnFuncionalidade_Pedidos_Versao."&".$this->DomnFuncionalidade_Pedidos_Versao_TXT.'" /></td>
					<td>'.$this->DomnFuncionalidade_Pedidos_Versao_TXT.'</td>
					<td>&nbsp;</td>
					<td>&nbsp;</td>
				</tr>
					';
		$mostra .= '
				<tr class="linha2Listagem">
					<td><input type="checkbox" name="'.$this->DomnFuncionalidade_Pedidos_Pesquisar_Todos_Pedidos.'" id="'.$this->DomnFuncionalidade_Pedidos_Pesquisar_Todos_Pedidos.'" value="'.$this->DomnFuncionalidade_Pedidos_Pesquisar_Todos_Pedidos."&".$this->DomnFuncionalidade_Pedidos_Pesquisar_Todos_Pedidos_TXT.'" /></td>
					<td>'.$this->DomnFuncionalidade_Pedidos_Pesquisar_Todos_Pedidos_TXT.'</td>
					<td>&nbsp;</td>
					<td>&nbsp;</td>
				</tr>
					';
		$mostra .= '
				<tr class="linhaListagem">
					<td><input type="checkbox" name="'.$this->DomnFuncionalidade_Pedidos_Concluir_Pedido.'" id="'.$this->DomnFuncionalidade_Pedidos_Concluir_Pedido.'" value="'.$this->DomnFuncionalidade_Pedidos_Concluir_Pedido."&".$this->DomnFuncionalidade_Pedidos_Concluir_Pedido_TXT.'" /></td>
					<td>'.$this->DomnFuncionalidade_Pedidos_Concluir_Pedido_TXT.'</td>
					<td>&nbsp;</td>
					<td>&nbsp;</td>
				</tr>
					';
		return $mostra;
	}
	
	/**
	 * Método que retorna o nome da Funcionalidade DOminio
	 * @author João Batista Padilha e Silva
	 * @param int $idFuncionalidade
	 * @return var
	 */
	public function retornaDomnFunctionalidades($idFuncionalidade)
	{
		$retornoNomeFuncionalidade = '';
		if($idFuncionalidade == $this->DomnFuncionalidade_Pedidos_Concluir_Pedido)
		{
			$retornoNomeFuncionalidade = $this->DomnFuncionalidade_Pedidos_Concluir_Pedido_TXT;
		}
		elseif ($idFuncionalidade == $this->DomnFuncionalidade_Pedidos_Modulo_SubModulo)
		{
			$retornoNomeFuncionalidade = $this->DomnFuncionalidade_Pedidos_Modulo_SubModulo_TXT;
		}
		elseif ($idFuncionalidade == $this->DomnFuncionalidade_Pedidos_Papel_Usuario_Destinatario)
		{
			$retornoNomeFuncionalidade = $this->DomnFuncionalidade_Pedidos_Papel_Usuario_Destinatario;
		}
		elseif ($idFuncionalidade == $this->DomnFuncionalidade_Pedidos_Pesquisar_Todos_Pedidos)
		{
			$retornoNomeFuncionalidade = $this->DomnFuncionalidade_Pedidos_Pesquisar_Todos_Pedidos_TXT;
		}
		elseif ($idFuncionalidade == $this->DomnFuncionalidade_Pedidos_Previsao_Entrega)
		{
			$retornoNomeFuncionalidade = $this->DomnFuncionalidade_Pedidos_Previsao_Entrega_TXT;
		}
		elseif ($idFuncionalidade == $this->DomnFuncionalidade_Pedidos_Tecnologia_Atividades)
		{
			$retornoNomeFuncionalidade = $this->DomnFuncionalidade_Pedidos_Tecnologia_Atividades_TXT;
		}
		elseif ($idFuncionalidade == $this->DomnFuncionalidade_Pedidos_Versao)
		{
			$retornoNomeFuncionalidade = $this->DomnFuncionalidade_Pedidos_Versao_TXT;
		}
		return $retornoNomeFuncionalidade;
	}
	
	/**
	 * Monta os Options de Domínios de Usuários para Select de Usuários
	 * @author João Batista Padilha e Silva
	 * @return var
	 */
	public function montaOptionsDomnPapeis($idPapelComparacao = '')
	{
		$selected = "";
		if($idPapelComparacao == $this->DomnPapel_Usuario)
		{
			$selected = 'selected="selected"';
		}
		$montaSelect = '<option value="'.$this->DomnPapel_Usuario.'" '.$selected.'>'.$this->DomnPapel_Usuario_TXT.'</option>';
		return $montaSelect;
	}
	
	/**
	 * Método que monta os Options de DomnClientes para o Selec de Clientes
	 * @author João Batista Padilha e Silva
	 * @return var
	 */
	public function montaOptionsDomnClientes($idCliente = '')
	{
		$selected = "";
		if($idCliente == $this->DomnClientes_Abaco)
		{
			$selected = 'selected="selected"';
		}
		$montaSelect = '<option value="'.$this->DomnClientes_Abaco.'" '.$selected.'>'.$this->DomnClientes_Abaco_TXT.'</option>';
		return $montaSelect;
	}
}
?>