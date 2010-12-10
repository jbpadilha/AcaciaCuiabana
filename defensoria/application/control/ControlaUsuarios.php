<?php

require_once ('control\ControlGeral.php');

class ControlaUsuarios extends ControlGeral {
	
	public function permiteAcesso($grupo) {
		return true;
	}
	
	public function get($GET) {
		header("Location:../public/usuarios.php");
	}
	
	public function post($POST) {
		
	}
}

?>