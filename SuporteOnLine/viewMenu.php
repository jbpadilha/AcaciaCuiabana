<?php
//####################################
// * João Batista Padilha e Silva Analista/Desenvolvedor (Ábaco Tecnologia)
// * Arquivo: Login.php
// * Criação: João Batista Padilha e Silva
// * Revisão:
// * Data de criação: 04/07/2008
//####################################
/**
 * Página de Login do Usuário. Informe o Login e a senha para acesso ao sistema
 */
require("config.php");

if(!isset($_SESSION["usuario_Logado"]))
{
	header("Location:index.php");
}

?>
<ul>
	<li><h4><a href="javascript:void(0)" onclick="carregaPagina('interna.php','conteudo');">Início</a></h4></li>
</ul>
<ul>
	<li><h4>Pedidos</h4>
		<ul>
			<li><a href="javascript:void(0)" onclick="carregaPagina('viewPedidos.php?cadastro=true','formulario');">Novo Pedido</a></li>
			<li><a href="javascript:void(0)" onclick="carregaPagina('viewPedidos.php?pesquisa=true','formulario');">Localizar Pedidos</a></li>
		</ul>
	</li>
</ul>
<ul>
	<li><h4><a href="javascript:void(0)" onclick="carregaPagina('viewUsuarios.php?cadastro=true&id=<?=$_SESSION['id_Usuario']?>','formulario');">Meus dados</a></h4></li>
</ul>
<ul>
	<li><h4><a href="javascript:void(0)">Manual do Suporte</a></h4></li>
</ul>
<?php
$controlaFuncionalidades = new Controla_Funcionalidades();
$retorno = $controlaFuncionalidades->mostraFuncionalidadesMenu();
echo $retorno;
?>
<ul>
	<li><h4><a href="javascript:void(0)">Ajuda</a></h4></li>
</ul>
<ul>
	<li><h4><a href="index.php?logout=sim">Sair</a></h4></li>
</ul>