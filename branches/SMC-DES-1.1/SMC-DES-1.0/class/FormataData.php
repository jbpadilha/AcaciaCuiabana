<?php
//####################################
// * Jo�o Batista Padilha e Silva Analista/Desenvolvedor
// * Arquivo: index.php
// * Cria��o: Jo�o Batista Padilha e Silva
// * Revis�o:
// * Data de Cria��o: 23/06/2008
//####################################
/*
   Classe que formata data para Manter o banco de dados MySql e Oracle
*/

class FormataData
{

	private $db;
	private $formatoDataDB;
	private $formatoDataView;
	private $formatoDataHoraDB;
	private $formatoDataHoraView;
	private $formatoHora;
	
	private $separadorDataDB;
	private $separadorDataView;
	private $separadorHora;	
		
	//Construtor - Seta parâmetros de configura��o
	function FormataData($banco = "mysqli")
	 {
		$this->db = $banco;
		$this->separadorDataView = "/";
		$this->separadorHora = ":";
		$this->formatoDataView = "d/m/Y";
		$this->formatoHora = "H:i";
		$this->formatoDataHoraView = "d/m/Y";
				
		switch ($this->db) 
		{
			case "mysqli":
				$this->separadorDataDB = "-";
				$this->formatoDataDB = "Y-m-d";
				$this->formatoDataHoraDB = "Y-m-d H:i";
				break;

			case "oracle":
				$this->separadorDataDB = "/";
				$this->formatoDataDB = "d/m/Y";
				$this->formatoDataHoraDB = "d/m/Y H:i";
				break;
		}		
	}
	
	//M�todo respons�vel por converter a data para o formato do BD	
	public function toDBDate($data = null)
	 {	
		if ($data == null) 
			return date($this->formatoDataDB);
		else 
		{
			$data = explode($this->separadorDataView, $data);
			return date($this->formatoDataDB, strtotime($data[2]."-".$data[1]."-".$data[0]));
		}
	}
	
	//M�todo respons�vel por transformar a data do BD para o formato de visualiza��o	
	public function toViewDate($data = null)
	{
		if ($data == null) 
			return "";
		else
		{
			if (strlen($data)> 10) {
				$data = explode(" ", $data);
				$data = $data[0];
			}
			return date($this->formatoDataView, $this->toTimeStamp($data));
		}
	}
	
	//M�todo que converte uma data em timestamp
	public function toTimeStamp($data)
	{
		$data = explode($this->separadorDataDB, $data);
		$time = '';
		switch ($this->formatoDataDB) 
		{
			case "d/m/Y":
				$time = strtotime($data[1]."/".$data[0]."/".$data[2]);
				break;
				
			case "Y-m-d":
				$time = strtotime($data[1]."/".$data[2]."/".$data[0]);
				break;
		}
		return $time;
	}
	
	//M�todo que converte a Hora
	public function toTime($hora = null)
	{
		if ($hora == null) 
			return date($this->formatoHora);
		else 
		{
			$hora = explode($this->separadorHora, $hora);
			return date($this->formatoHora, strtotime($hora[0].":".$hora[1]));		
		}
	
	}
	
	//M�todo respons�vel por converter a data e hora para o formato do BD
	public function toDBDateTime($data = null) 
	{
		if ($data == null) 
			return date($this->formatoDataHoraDB);
			
		else 
		{
			$data = explode(" ", $data);
			return $this->toDBDate($data[0])." ".$this->toTime($data[1]);			
		}
		
	}
	
	//M�todo respons�vel por converter a data e hora para o formato do BD
	public function toViewDateTime($data = null) 
	{	
		if ($data == null) 
			return date($this->formatoDataHoraDB);
			
		else
		{
			$data = explode(" ", $data);
			return $this->toViewDate($data[0])." ".$this->toTime($data[1]);
		}
	}
	
}
?>
