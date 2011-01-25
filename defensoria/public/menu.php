<ul class="dropdown">
	<li><a href="javascript:void(0);">Cadastros Principais</a>
		<ul class="sub_menu">
			<li><a href="javascript:void(0);" onclick="carregaPagina('../application/recebePostGet.php?control=Atividades','page')">Atividades</a></li>
			<li><a href="javascript:void(0);" onclick="carregaPagina('../application/recebePostGet.php?control=Comarca','page')">Comarca</a></li>
			<li><a href="javascript:void(0);" onclick="carregaPagina('../application/recebePostGet.php?control=NaturezaAcao','page')">Natureza da Ação</a></li>
			<li><a href="javascript:void(0);" onclick="carregaPagina('../application/recebePostGet.php?control=Nucleo','page')">Núcleo da Defensoria</a></li>
			<li><a href="javascript:void(0);" onclick="carregaPagina('../application/recebePostGet.php?control=TipoAcao','page')">Tipo de Ação</a></li>
			<li><a href="javascript:void(0);" onclick="carregaPagina('../application/recebePostGet.php?control=Vara','page')">Vara</a></li>
			<li><a href="javascript:void(0);" onclick="carregaPagina('../application/recebePostGet.php?control=Usuarios','page')">Usuários do Sistema</a></li>
			<li><a href="javascript:void(0);" onclick="carregaPagina('../application/recebePostGet.php?control=Defensor','page')">Defensor</a></li>
		</ul>
	</li>
	<li><a href="javascript:void(0);">Cadastros Funcionais</a>
		<ul class="sub_menu">
			<li><a href="javascript:void(0);" onclick="carregaPagina('../application/recebePostGet.php?control=Pessoa','page')">Pessoa</a></li>
			<li><a href="javascript:void(0);" onclick="carregaPagina('../application/recebePostGet.php?control=Entrevista','page')">Entrevista</a></li>
			<li><a href="javascript:void(0);" onclick="carregaPagina('../application/recebePostGet.php?control=Hipossuficiencia','page')">Hipossuficiência</a></li>
			<li><a href="javascript:void(0);" onclick="carregaPagina('../application/recebePostGet.php?control=Convite','page')">Agendar Convite</a></li>
		</ul>	
	</li>
	<li><a href="javascript:void(0);">Processos</a>
		<ul class="sub_menu">
			<li><a href="javascript:void(0);" onclick="carregaPagina('../application/recebePostGet.php?control=Processos','page')">Acompanhar/Movimentar Processo</a></li>
		</ul>	
	</li>
	<li><a href="javascript:void(0);">Relatórios/Fichas</a>
		<ul class="sub_menu">
			<li><a href="javascript:void(0);" onclick="carregaPagina('../application/recebePostGet.php?control=Relatorio&funcao=FichaHipo','page')">Ficha Hipossuficiência</a></li>
			<li><a href="javascript:void(0);" onclick="carregaPagina('../application/recebePostGet.php?control=Relatorio&funcao=FichaAtendimento','page')">Ficha Atendimento/Entrevista</a></li>
		</ul>	
	</li>
	<li><a href="javascript:void(0);" onclick="document.location.href='../application/recebePostGet.php?sair=1';">Sair do Sistema</a></li>
</ul>