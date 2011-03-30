<?php
//####################################
// * Joуo Batista Padilha e Silva Analista/Desenvolvedor (Сbaco Tecnologia)
// * Arquivo: config.php
// * Criaчуo: Joуo Batista Padilha e Silva
// * Revisуo:
// * Data de criaчуo: 23/06/2008
//####################################
/**
 * Configuraчуo do Sistema. Conterс Constantes e instтncia principal.
 */
require_once("class/FormataData.php");
require("class/Dominio.php");

require("class/AbstractVo.php");
require_once("class/Dominio.php");
require_once("class/TabelaBasica/TabelaBasicaVo.php");
require_once("class/LogSuporte/Controla_LogSuporte.php");

require_once("class/Papeis/Controla_Papeis.php");
require_once("class/Permissao/Controla_Permissao.php");
require_once("class/Usuarios/Controla_Usuarios.php");
require_once("class/Papeis/Controla_Papeis.php");
require_once("class/Funcionalidades/Controla_Funcionalidades.php");
require_once("class/Modulos/Controla_Modulos.php");
require_once("class/SubModulos/Controla_SubModulos.php");
require_once("class/Clientes/Controla_Clientes.php");
require_once("class/TabelaBasica/Controla_TabelaBasica.php");
require_once("class/Tecnologias/Controla_Tecnologias.php");
require_once("class/Versoes/Controla_Versoes.php");
require_once("class/AtividadesPontoFuncao/Controla_AtividadesPontoFuncaoHoras.php");
require_once("class/Anexos/Controla_Anexos.php");
require_once("class/GrupoFluxos/Controla_GrupoFluxos.php");
require_once("class/Fluxos/Controla_Fluxos.php");
require_once("class/NaoConformidade/Controla_NaoConformidades.php");
require_once("class/Projetos/Controla_Projetos.php");
require_once("class/Historicos/Controla_Historico.php");
require_once("class/Pedidos/Controla_Pedidos.php");
require_once("class/BusinessEntity.php");


setlocale(LC_ALL, NULL);
setlocale(LC_ALL, 'pt_BR');
date_default_timezone_set('America/Cuiaba');

$converte = new FormataData();
$dominio = new Dominio();

//Definir Usuario e Senha para o banco
define ("DB_HOST", $dominio->DB_HOST);
define ("DB_USER", $dominio->DB_USER);
define ("DB_PASSWD", $dominio->DB_PASSWD);
define ("DB_DATA", $dominio->DB_DATA);


//define("PATH",'http://localhost/SuporteOnLine');
define("PATH",'.');
define("TITULO","..: Suporte 3.0 - Suporte On Line :..");
define("VERSAO","Vers&atilde;o 3.0");


header("Content-Type: text/html; charset=ISO-8859-1",true);
session_start();

if(isset($_GET['logout']))
{
	logout();
}

/**
 * Cadastro das Nуo Conformidades
 */
$controlaNaoConformidades = new Controla_NaoConformidades();
$controlaNaoConformidades->cadastrarNaoConformidades();


function logout()
{
	session_destroy();
	session_regenerate_id("loginUsuarios");
	header("location:index.php");
}

?>