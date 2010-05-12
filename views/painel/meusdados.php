<?php 
require_once ('../../class/Config.php');
if(!isset($_SESSION['usuarioLogon']))
{
	header("Location:../views/home.php?p=login");
}
$logon = new Logon();
$logon = $_SESSION["usuarioLogon"];

$pessoa = new Pessoa();
$pessoa->setIdPessoa($logon->getIdPessoa());

$collVoPessoa = $controla->findPessoas($pessoa);
if(!is_null($collVoPessoa))
{
	$pessoa = $collVoPessoa[0];
}

?>
<link rel="stylesheet" href="../css/home.css" type="text/css" media="all" >
<form class="padrao">
<fieldset> <legend>Dados pessoais</legend>
	<div id="left">
		<p> <label class="normal">Nome: 			</label> <input type="text" name="nome_cliente" 		readonly="readonly" value="<?=$pessoa->getNomePessoa()?>" class="x9" /></p>
		<p> <label class="normal">Nascimento: 		</label> <input type="text" name="nascimento_cliente" 	readonly="readonly" value="<?=$formataData->toViewDate($pessoa->getDataNascimentoPessoa())?>" class="x2" /></p>
		<p> <label class="normal">Sexo: 			</label> <input type="text" name="sexo_cliente" 		readonly="readonly" value="<?=$pessoa->getSexoPessoa()?>" class="x3" /></p>
		<p> <label class="normal">Estado Civil: 	</label> <input type="text" name="ecivil_cliente" 		readonly="readonly" value="<?=$pessoa->getEstadoCivilPessoa()?>" class="x3"></p>
		<p> <label class="normal">Observações: 	</label> <input type="text" name="nota" 				readonly="readonly" value="<?=$pessoa->getComplementoPessoa()?>" class="x9" /></p>
	</div>
	<div id="right">
		<p> <label class="normal">RG: 				</label> <input type="text" name="rg_cliente" 		readonly="readonly" value="<?=$pessoa->getRgPessoa()?>" class="x3" /></p>
		<p> <label class="normal">Órgao Exped./UF: </label> <input type="text" name="orgexprg_cliente" readonly="readonly" value="<?=$pessoa->getOrgExpPessoa()?>" class="x1" />
		<label class="x0"> - </label>		 <input type="text" name="ufexprg_cliente" 	readonly="readonly" value="<?=$pessoa->getUfOrgExpPessoa()?>" class="x1"></p>
		<p> <label class="normal">CPF: 			</label> <input type="text" name="cpf_cliente" 	  	readonly="readonly" value="<?=$pessoa->getCpfPessoa()?>" class="x3" /></p>
</fieldset>
<?php 
$endereco = new Endereco();
$endereco->setIdPessoa($pessoa->getIdPessoa());
$collVoEndereco = $controla->findEndereco($endereco);
if(!is_null($collVoEndereco))
{
	$endereco = $collVoEndereco[0];
}
?>
<fieldset> <legend>Contato</legend>
<div id="left">
		<p> <label class="normal">Rua, avenida, logradouro: 	</label> <input type="text" name="rua_contato" 			readonly="readonly" value="<?=$endereco->getRuaEndereco()?>" class="x9" /></p>
		<p> <label class="normal">Complemento: 				</label> <input type="text" name="complemento_contato" 	readonly="readonly" value="<?=$endereco->getComplementoEndereco()?>" class="x9" /></p>
		<p> <label class="normal">Bairro: 						</label> <input type="text" name="bairro_contato" 		readonly="readonly" value="<?=$endereco->getBairroEndereco()?>" class="x9" /></p>
		<p> <label class="normal">CEP: 						</label> <input type="text" name="cep_contato" 			readonly="readonly" value="<?=$endereco->getCepEndereco()?>" class="x2" /></p>
		<p> <label class="normal">Cidade: 						</label> <input type="text" name="cidade_contato" 		readonly="readonly" value="<?=$endereco->getCidadeEndereco()?>" class="x5" />
	<label class="x2" >Estado: 					</label> <input type="text" name="estado_contato" 		readonly="readonly" value="<?=$endereco->getEstadoEndereco()?>" class="x15" > 
		</p>
		<p> <label class="normal">E-mail: 						</label> <input type="text" name="email_contato" 		readonly="readonly" value="<?=$endereco->getEmailEndereco()?>" class="x9" /></p>
</div>
<div id="right">
		<p> <label class="normal">Telefone: 			</label> <input type="text" name="tel_contato" readonly="readonly" value="<?=$endereco->getTelefoneEndereco()?>" class="x3" ></p>
		<p> <label class="normal">Celular: 			</label> <input type="text" name="cel_contato" readonly="readonly" value="<?=$endereco->getCelEndereco()?>" class="x3" ></p>
		<p> <label class="normal">Fax: 				</label> <input type="text" name="fax_contato" readonly="readonly" value="<?=$endereco->getFaxEndereco()?>" class="x3" ></p>
</div>
</fieldset>
<?php 
if($pessoa->getIdConjuguePessoa() != null)
{
	$pessoaConjugue = new Pessoa();
	$pessoaConjugue->setIdPessoa($pessoa->getIdConjuguePessoa());
	$collVoConjugue = $controla->findPessoas($pessoaConjugue);
	if(!is_null($collVoConjugue))
	{
		$pessoaConjugue = $collVoConjugue[0];
	}
?>
<fieldset> <legend>Dados do cônjuge</legend>
<div id="left">
		<p><label class="normal">Nome: 					</label> <input type="text" name="nome_conjuge"  readonly="readonly" value="<?=$pessoaConjugue->getNomePessoa()?>" class="x9" /></p>
</div>
<div id="right">
		<p> <label class="normal">Nascimento: 				</label> <input type="text" name="nasc_conjuge" readonly="readonly" value="<?=$formataData->toViewDate($pessoaConjugue->getDataNascimentoPessoa())?>" class="x2" /></p>
		<p> <label class="normal">Sexo: 					</label> <input type="text" name="sexo_cliente" readonly="readonly" value="<?=$pessoaConjugue->getSexoPessoa()?>" class="x3" /></p>
</div>
</fieldset>
<?php 
}
?>
</form>

</body>
	<script type="text/javascript" language="javascript" src="../scripts/full.js" > </script>
</html>