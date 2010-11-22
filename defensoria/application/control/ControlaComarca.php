<?php

class ControlaComarca {
	
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

}

?>