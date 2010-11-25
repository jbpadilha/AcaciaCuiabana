<?php

class ControlaComarca extends DefensoriaControl{
	
	public function ControlaComarca($GET)
	{
		echo "teste";
		var_dump($GET);
	}
	
	public function cadastrar(Comarca $comarca)
	{
		try {
		if($comarca->getNomecomarca()!=null)
		{
			$comarca->save();
		}
		}
		catch (Exception $e)
		{
			throw new Exception();
		}
	}
	
	public function deletar(Comarca $comarca)
	{
		if($comarca->getIdcomarca()!= null)
		{
			$comarca->delete();
		}
	}
	
	public function alterar(Comarca $comarca)
	{
		if($comarca->getIdcomarca()!= null && $comarca->getNomecomarca()!=null)
		{
			$comarca->update();
		}
	}
	
	/**
	 * @param unknown_type unknown_type $GET
	 */
	public function get($GET) {
		
	}

	/**
	 * @param unknown_type unknown_type $POST
	 */
	public function post($POST) {
		
	}

	/**
	 * @param unknown_type unknown_type $grupo
	 */
	public function permiteAcesso($grupo) {
			
	}


	
}

?>