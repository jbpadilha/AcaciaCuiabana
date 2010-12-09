<?php
$ps_ext_dir=dirname(__FILE__);
chdir('../../../../');
include('includes/application_top.php');

if ($_SERVER['REQUEST_METHOD']=='GET')
  tep_redirect(DIR_WS_HTTP_CATALOG.'checkout_process.php');

function retorno_automatico (
  $VendedorEmail, $TransacaoID, $Referencia, $TipoFrete,
  $ValorFrete, $Anotacao, $DataTransacao, $TipoPagamento,
  $StatusTransacao, $CliNome, $CliEmail, $CliEndereco,
  $CliNumero, $CliComplemento, $CliBairro, $CliCidade,
  $CliEstado, $CliCEP, $CliTelefone, $produtos, $NumItens
) {
  $status = in_array($StatusTransacao,array('Completo', 'Aprovado')) ? 2 : 1;
  tep_db_query("UPDATE `ps_status` set `status` = $status WHERE `id_pg_status` = '$Referencia'");
}

define('TOKEN', MODULE_PAYMENT_PAGSEGURO_TOKEN);
include("$ps_ext_dir/retorno.php");

?>