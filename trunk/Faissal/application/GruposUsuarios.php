<?php

class GruposUsuarios {
	
	public static $GRUPO_ADMIN = 0;
	public static $GRUPO_PUBLICO = 1;
	
	public static $GRUPO_ADMIN_TXT = "Administrador";
	public static $GRUPO_PUBLICO_TXT = "Público";
	
	public static function montaOptionsSelect($idGrupo)
	{
		$options = '<option value="">SELECIONE</option>';
		$options .= '<option value="'.GruposUsuarios::$GRUPO_ADMIN.'">'.GruposUsuarios::$GRUPO_ADMIN_TXT.'</option>';
		$options .= '<option value="'.GruposUsuarios::$GRUPO_PUBLICO.'">'.GruposUsuarios::$GRUPO_PUBLICO_TXT.'</option>';
		return $options; 
	}

}

?>