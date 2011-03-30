<?php
//####################################
// * Jo�o Batista Padilha e Silva Analista/Desenvolvedor (�baco Tecnologia)
// * Arquivo: TabelaBasicaVo.php
// * Cria��o: Jo�o Batista Padilha e Silva
// * Revis�o:
// * Data de cria��o: 30/06/2008
//####################################
/**
 * Classe Value Objet. Serve para transportar os atributos dos usu�rios entre as camadas.
 * @author Jo�o Batista Padilha e Silva
 */
class TabelaBasicaVo extends AbstractVo 
{
	private $idTabelaBasica = null;
	private $emailPadraoTabelaBasica = '';
	private $nomeRemetenteTabelaBasica = '';
	private $toleranciaHoraConformidade = '';
	
	private $horasBaseTrabalhadasTabelaBasica = '';
	private $horasNaoTrabalhadasBaseTabelaBasica = '';
	private $horasInicioTrabalhoTabelaBasica = '';
	private $horasFimTrabalhoTabelaBasica = '';
	private $horasIntervaloInicioTabelaBasica = '';
	private $horasIntervaloFimTabelaBasica = '';
	private $horasBaseRecebimentoPedido = '';
	
	/**
	 * M�todo de moficia��o da Identifica��o da Tabela Basica
	 * @author Jo�o Batista Padilha e Silva
	 * @param integer $id
	 */
	public function setIdTabelaBasica($id = null)
	{
		$this->idTabelaBasica = $id;
	}
	
	/**
	 * M�todo de retorno da Identifica��o da tabela Basica
	 * @author Jo�o Batista Padilha e Silva
	 * @return integer
	 */
	public function getIdTabelaBasica()
	{
		return $this->idTabelaBasica;
	}
	
	/**
	 * M�todo de modifica��o do Email Padr�o da Tabela Basica
	 * @author Jo�o Batista Padilha e Silva
	 * @param var $email
	 */
	public function setEmailPadraoTabelaBasica($email = '')
	{
		$this->emailPadraoTabelaBasica = $email;
	}
	
	/**
	 * M�todo de retorno do Email Padr�o da Tabela Basica
	 * @author Jo�o Batista Padilha e Silva
	 * @return var
	 */
	public function getEmailPadraoTabelaBasica()
	{
		return $this->emailPadraoTabelaBasica;
	}
	
	/**
	 * M�todo de modifica��o do Nome do Remetente da Tabela Basica
	 * @author Jo�o Batista Padilha e Silva
	 * @param var $nomeRemetente
	 */
	public function setNomeRemetenteTabelaBasica($nomeRemetente = '')
	{
		$this->nomeRemetenteTabelaBasica = $nomeRemetente;
	}
	
	/**
	 * M�todo de retorno do Nome do Remetente Padr�o da Tabela Basica
	 * @author Jo�o Batista Padilha e Silva
	 * @return var
	 */
	public function getNomeRemetenteTabelaBasica()
	{
		return $this->nomeRemetenteTabelaBasica;
	}
	
	/**
	 * M�todo de moficia��o da tolerancia de tempo para as n�o conformidades
	 * @author Jo�o Batista Padilha e Silva
	 * @param time $hora
	 */
	public function setToleranciaHoraConformidade($hora = '')
	{
		$this->toleranciaHoraConformidade = $hora;
	}
	
	/**
	 * M�todo de retorno da toler�ncia de tempo para as n�o conformidades
	 * @author Jo�o Batista Padilha e Silva
	 * @return time
	 */
	public function getToleranciaHoraConformidade()
	{
		return $this->toleranciaHoraConformidade;
	}
	
	/**
	 * M�todo de atribui��o das Base de Horas trabalhadas na Empresa
	 * @author Jo�o Batista Padilha e Silva
	 * @param time $hora
	 */
	public function setHorasBaseTrabalhadasTabelaBasica($hora)
	{
		$this->horasBaseTrabalhadasTabelaBasica = $hora;
	}
	
	/**
	 * M�todo de retorno da base de horas trabalhadas na Empresa.
	 * @author Jo�o Batista Padilha e Silva
	 * @return time
	 */
	public function getHorasBaseTrabalhadasTabelaBasica()
	{
		return $this->horasBaseTrabalhadasTabelaBasica;
	}
	
	/**
	 * M�todo de atribui��o de Horas n�o trabalhadas na empresa
	 * @author Jo�o Batista Padilha e Silva
	 * @param time $hora
	 */
	public function setHorasNaoTrabalhadasBaseTabelaBasica($hora)
	{
		$this->horasNaoTrabalhadasBaseTabelaBasica = $hora;
	}
	
	/**
	 * M�todo de retorno das horas n�o trabalhadas no dia
	 * @author Jo�o Batista Padilha e Silva
	 * @return time
	 */
	public function getHorasNaoTrabalhadasBaseTabelaBasica()
	{
		return $this->horasNaoTrabalhadasBaseTabelaBasica;
	}
	
	/**
	 * M�todo de atribui��o de Inicio de Hora de Trabalho
	 * @author Jo�o Batista Padilha e Silva
	 * @param time $hora
	 */
	public function setHorasInicioTrabalhoTabelaBasica($hora)
	{
		$this->horasInicioTrabalhoTabelaBasica = $hora;
	}
	
	/**
	 * M�todo de retorno da Hora de In�cio de Trabalho
	 * @author Jo�o Batista Padilha e Silva
	 * @return time
	 */
	public function getHorasInicioTrabalhoTabelaBasica()
	{
		return $this->horasInicioTrabalhoTabelaBasica;
	}
	
	/**
	 * M�todo de atribui��o de Horario fim de trabalho
	 * @author Jo�o Batista Padilha e Silva
	 * @param time $hora
	 */
	public function setHorasFimTrabalhoTabelaBasica($hora)
	{
		$this->horasFimTrabalhoTabelaBasica = $hora;
	}
	
	/**
	 * M�todo de retorno da Hora Fim de Trabalho
	 * @author Jo�o Batista Padilha e Silva
	 * @return time
	 */
	public function getHorasFimTrabalhoTabelaBasica()
	{
		return $this->horasFimTrabalhoTabelaBasica;
	}
	
	/**
	 * M�todo de atribui��o de Inicio do Intervalo para almo�o
	 * @author Jo�o Batista Padilha e Silva
	 * @param time $hora
	 */
	public function setHorasIntervaloInicioTabelaBasica($hora)
	{
		$this->horasIntervaloInicioTabelaBasica = $hora;
	}
	
	/**
	 * M�todo de retorno do Inicio de Intervalo
	 * @author Jo�o Batista Padilha e Silva
	 * @return time
	 */
	public function getHorasIntervaloInicioTabelaBasica()
	{
		return $this->horasIntervaloInicioTabelaBasica;
	}
	
	/**
	 * M�todo de atribui��o de Fim de Intervalo de Almo�o
	 * @author Jo�o Batista Padilha e Silva
	 * @param time $hora
	 */
	public function setHorasIntervaloFimTabelaBasica($hora)
	{
		$this->horasIntervaloFimTabelaBasica = $hora;
	}
	
	/**
	 * M�todo de retorno de Horario fim do Intervalo de almo�o
	 * @author Jo�o Batista Padilha e Silva
	 * @return time
	 */
	public function getHorasIntervaloFimTabelaBasica()
	{
		return $this->horasIntervaloFimTabelaBasica;
	}
	
	/**
	 * M�todo de atribui��o de Horario base de Recebimento
	 * @author Jo�o Batista Padilha e Silva
	 * @param time $hora
	 */
	public function setHorasBaseRecebimentoPedido($hora)
	{
		$this->horasBaseRecebimentoPedido = $hora;
	}
	
	/**
	 * M�todo de retorno de Hora base de recebimento de Pedido
	 * @author Jo�o Batista Padilha e Silva
	 * @return time
	 */
	public function getHorasBaseRecebimentoPedido()
	{
		return $this->horasBaseRecebimentoPedido;
	}
}
?>