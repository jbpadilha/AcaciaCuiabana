<?php
//####################################
// * Joгo Batista Padilha e Silva Analista/Desenvolvedor (Бbaco Tecnologia)
// * Arquivo: TabelaBasicaVo.php
// * Criaзгo: Joгo Batista Padilha e Silva
// * Revisгo:
// * Data de criaзгo: 30/06/2008
//####################################
/**
 * Classe Value Objet. Serve para transportar os atributos dos usuбrios entre as camadas.
 * @author Joгo Batista Padilha e Silva
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
	 * Mйtodo de moficiaзгo da Identificaзгo da Tabela Basica
	 * @author Joгo Batista Padilha e Silva
	 * @param integer $id
	 */
	public function setIdTabelaBasica($id = null)
	{
		$this->idTabelaBasica = $id;
	}
	
	/**
	 * Mйtodo de retorno da Identificaзгo da tabela Basica
	 * @author Joгo Batista Padilha e Silva
	 * @return integer
	 */
	public function getIdTabelaBasica()
	{
		return $this->idTabelaBasica;
	}
	
	/**
	 * Mйtodo de modificaзгo do Email Padrгo da Tabela Basica
	 * @author Joгo Batista Padilha e Silva
	 * @param var $email
	 */
	public function setEmailPadraoTabelaBasica($email = '')
	{
		$this->emailPadraoTabelaBasica = $email;
	}
	
	/**
	 * Mйtodo de retorno do Email Padrгo da Tabela Basica
	 * @author Joгo Batista Padilha e Silva
	 * @return var
	 */
	public function getEmailPadraoTabelaBasica()
	{
		return $this->emailPadraoTabelaBasica;
	}
	
	/**
	 * Mйtodo de modificaзгo do Nome do Remetente da Tabela Basica
	 * @author Joгo Batista Padilha e Silva
	 * @param var $nomeRemetente
	 */
	public function setNomeRemetenteTabelaBasica($nomeRemetente = '')
	{
		$this->nomeRemetenteTabelaBasica = $nomeRemetente;
	}
	
	/**
	 * Mйtodo de retorno do Nome do Remetente Padrгo da Tabela Basica
	 * @author Joгo Batista Padilha e Silva
	 * @return var
	 */
	public function getNomeRemetenteTabelaBasica()
	{
		return $this->nomeRemetenteTabelaBasica;
	}
	
	/**
	 * Mйtodo de moficiaзгo da tolerancia de tempo para as nгo conformidades
	 * @author Joгo Batista Padilha e Silva
	 * @param time $hora
	 */
	public function setToleranciaHoraConformidade($hora = '')
	{
		$this->toleranciaHoraConformidade = $hora;
	}
	
	/**
	 * Mйtodo de retorno da tolerвncia de tempo para as nгo conformidades
	 * @author Joгo Batista Padilha e Silva
	 * @return time
	 */
	public function getToleranciaHoraConformidade()
	{
		return $this->toleranciaHoraConformidade;
	}
	
	/**
	 * Mйtodo de atribuiзгo das Base de Horas trabalhadas na Empresa
	 * @author Joгo Batista Padilha e Silva
	 * @param time $hora
	 */
	public function setHorasBaseTrabalhadasTabelaBasica($hora)
	{
		$this->horasBaseTrabalhadasTabelaBasica = $hora;
	}
	
	/**
	 * Mйtodo de retorno da base de horas trabalhadas na Empresa.
	 * @author Joгo Batista Padilha e Silva
	 * @return time
	 */
	public function getHorasBaseTrabalhadasTabelaBasica()
	{
		return $this->horasBaseTrabalhadasTabelaBasica;
	}
	
	/**
	 * Mйtodo de atribuiзгo de Horas nгo trabalhadas na empresa
	 * @author Joгo Batista Padilha e Silva
	 * @param time $hora
	 */
	public function setHorasNaoTrabalhadasBaseTabelaBasica($hora)
	{
		$this->horasNaoTrabalhadasBaseTabelaBasica = $hora;
	}
	
	/**
	 * Mйtodo de retorno das horas nгo trabalhadas no dia
	 * @author Joгo Batista Padilha e Silva
	 * @return time
	 */
	public function getHorasNaoTrabalhadasBaseTabelaBasica()
	{
		return $this->horasNaoTrabalhadasBaseTabelaBasica;
	}
	
	/**
	 * Mйtodo de atribuiзгo de Inicio de Hora de Trabalho
	 * @author Joгo Batista Padilha e Silva
	 * @param time $hora
	 */
	public function setHorasInicioTrabalhoTabelaBasica($hora)
	{
		$this->horasInicioTrabalhoTabelaBasica = $hora;
	}
	
	/**
	 * Mйtodo de retorno da Hora de Inнcio de Trabalho
	 * @author Joгo Batista Padilha e Silva
	 * @return time
	 */
	public function getHorasInicioTrabalhoTabelaBasica()
	{
		return $this->horasInicioTrabalhoTabelaBasica;
	}
	
	/**
	 * Mйtodo de atribuiзгo de Horario fim de trabalho
	 * @author Joгo Batista Padilha e Silva
	 * @param time $hora
	 */
	public function setHorasFimTrabalhoTabelaBasica($hora)
	{
		$this->horasFimTrabalhoTabelaBasica = $hora;
	}
	
	/**
	 * Mйtodo de retorno da Hora Fim de Trabalho
	 * @author Joгo Batista Padilha e Silva
	 * @return time
	 */
	public function getHorasFimTrabalhoTabelaBasica()
	{
		return $this->horasFimTrabalhoTabelaBasica;
	}
	
	/**
	 * Mйtodo de atribuiзгo de Inicio do Intervalo para almoзo
	 * @author Joгo Batista Padilha e Silva
	 * @param time $hora
	 */
	public function setHorasIntervaloInicioTabelaBasica($hora)
	{
		$this->horasIntervaloInicioTabelaBasica = $hora;
	}
	
	/**
	 * Mйtodo de retorno do Inicio de Intervalo
	 * @author Joгo Batista Padilha e Silva
	 * @return time
	 */
	public function getHorasIntervaloInicioTabelaBasica()
	{
		return $this->horasIntervaloInicioTabelaBasica;
	}
	
	/**
	 * Mйtodo de atribuiзгo de Fim de Intervalo de Almoзo
	 * @author Joгo Batista Padilha e Silva
	 * @param time $hora
	 */
	public function setHorasIntervaloFimTabelaBasica($hora)
	{
		$this->horasIntervaloFimTabelaBasica = $hora;
	}
	
	/**
	 * Mйtodo de retorno de Horario fim do Intervalo de almoзo
	 * @author Joгo Batista Padilha e Silva
	 * @return time
	 */
	public function getHorasIntervaloFimTabelaBasica()
	{
		return $this->horasIntervaloFimTabelaBasica;
	}
	
	/**
	 * Mйtodo de atribuiзгo de Horario base de Recebimento
	 * @author Joгo Batista Padilha e Silva
	 * @param time $hora
	 */
	public function setHorasBaseRecebimentoPedido($hora)
	{
		$this->horasBaseRecebimentoPedido = $hora;
	}
	
	/**
	 * Mйtodo de retorno de Hora base de recebimento de Pedido
	 * @author Joгo Batista Padilha e Silva
	 * @return time
	 */
	public function getHorasBaseRecebimentoPedido()
	{
		return $this->horasBaseRecebimentoPedido;
	}
}
?>