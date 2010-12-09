<?php
include_once('pagseguro/pgs.php');

class pagseguro {
  var $code             = 'pagseguro';
  var $form_action_url  = MODULE_PAYMENT_PAGSEGURO_FORM_ACTION_URL;
  var $title            = MODULE_PAYMENT_PAGSEGURO_TEXT_TITLE;
  var $public_title     = MODULE_PAYMENT_PAGSEGURO_TEXT_PUBLIC_TITLE;
  var $description      = MODULE_PAYMENT_PAGSEGURO_TEXT_DESCRIPTION;
  var $sort_order       = MODULE_PAYMENT_PAGSEGURO_SORT_ORDER;
  var $enabled          = false;
  var $_check           = false;

  /**
   * Funcao de inicializacao
   */
  function pagseguro() {
    global $order;
    $this->enabled = (bool) $this->check();
    if ('object'===gettype($order)) $this->update_status();
  }

  function update_status() {
  }
  function javascript_validation() {
    return false;
  }
  function selection(){
    # Verificando se o Modulo esta habilitado
    $check_query = tep_db_query("SELECT `configuration_value` as `value` from `".TABLE_CONFIGURATION."` WHERE `configuration_key` = 'MODULE_PAYMENT_PAGSEGURO_STATUS'");
    if (!tep_db_num_rows($check_query)) return false;
    $check_query=tep_db_fetch_array($check_query);
    if ($check_query['value']!='Sim') return false;

    return array('id'     => $this->code,
                 'module' => $this->public_title);
  }
  function pre_confirmation_check() {
    $_SESSION['PagSeguro_OrderId'] = uniqid(true);
  }
  function confirmation() {
  }
  function process_button(){
    include_once('pagseguro/tratadados.php');
    # Verificando se o Modulo esta habilitado
    $check_query = tep_db_query("SELECT `configuration_value` as `value` from `".TABLE_CONFIGURATION."` WHERE `configuration_key` = 'MODULE_PAYMENT_PAGSEGURO_STATUS'");
    if (!tep_db_num_rows($check_query)) return false;
    $check_query=tep_db_fetch_array($check_query);
    if ($check_query['value']!='Sim') return false;

    global $order;

    # Inserindo o elemento no Banco de dados
    tep_db_perform('ps_status', array(
      'id_pg_status' => $_SESSION['PagSeguro_OrderId'], 
      'customer_id'  => $_SESSION['customer_id'],
      'status'       => 1,
      'session'      => serialize($_SESSION),
    ));

    $pgs=new pgs(array(
      'email_cobranca' => MODULE_PAYMENT_PAGSEGURO_EMAIL,
      'tipo'           => MODULE_PAYMENT_PAGSEGURO_TIPO,
      'tipo_frete'     => array_shift(explode(' ', MODULE_PAYMENT_PAGSEGURO_TIPO_FRETE)),
      'ref_transacao'  => $_SESSION['PagSeguro_OrderId'],
    ));
    list($ddd,$telefone)=trataTelefone($order->customer['telephone']);
    list($end,$num,$compl)=trataEndereco($order->delivery['street_address']);
    $pgs->cliente(array(
      'nome'    => $order->customer['firstname'] . ' ' . $order->customer['lastname'],
      'cep'     => $order->customer['postcode'],
      'end'     => $end,
      'num'     => $num,
      'compl'   => $compl,
      'bairro'  => $order->customer['suburb'],
      'cidade'  => $order->customer['city'],
      'uf'      => $order->customer['state'],
      'pais'    => $order->customer['country']['iso_code_2'],
      'ddd'     => $ddd,
      'tel'     => $telefone,
      'email'   => $order->customer['email_address'],
    ));
    foreach ($order->products as $product) {
      $pgs->adicionar (array (
        'id'          => (string) $product['id'],
        'descricao'   => $product['name'] . ' ' . $product['model'],
        'quantidade'  => $product['qty'],
        'valor'       => $product['price'],
        'peso'        => (int) number_format($product['weight'], 2, '', ''),
        'frete'       => $product['tax'],
      ));
    }
    $i=$pgs->mostra(array('print'=>false, 'open_form'=>false, 'close_form'=>false, 'show_submit'=>false));
    return $i;
  }
  function before_process(){
    global $order;
    $query=tep_db_query("SELECT * FROM `ps_status` WHERE `id_pg_status` = '".$_SESSION['PagSeguro_OrderId']."'");
    if(tep_db_num_rows($query)) {
      $result=tep_db_fetch_array($query);
      $order->info['order_status']=$result['status'];
    }
  }
  function after_process(){
    global $insert_id;
    $query=tep_db_query("SELECT * FROM `ps_status` WHERE `id_pg_status` = '".$_SESSION['PagSeguro_OrderId']."'");
    if(tep_db_num_rows($query)) {
      $result=tep_db_fetch_array($query);
      tep_db_perform('ps_status', array('order_id'=> $insert_id), 'update', "id_pg_status = '{$result['id_pg_status']}'"); 
    }
  }
  function get_error(){
  }
  /**
   * Checa se o modulo esta instalado
   */
  function check() {
    if ($this->_check === false) {
      $check_query = tep_db_query("SELECT `configuration_value` from `".TABLE_CONFIGURATION."` WHERE `configuration_key` = 'MODULE_PAYMENT_PAGSEGURO_STATUS'");
      $this->_check = tep_db_num_rows($check_query) > 0 ? 1 : 0;
    }
    return $this->_check;
  }
  /**
   * Retorna um array com tdas as chaves
   */
  function keys() {
    return array('MODULE_PAYMENT_PAGSEGURO_STATUS', 'MODULE_PAYMENT_PAGSEGURO_SORT_ORDER', 'MODULE_PAYMENT_PAGSEGURO_EMAIL', 'MODULE_PAYMENT_PAGSEGURO_TOKEN', 'MODULE_PAYMENT_PAGSEGURO_TIPO_FRETE');
  }
  /**
   * Instala o modulo
   */
  function install() {
    $data = array (
      array(
        'configuration_title'       => 'Habilitar o Modulo PagSeguro',
        'configuration_key'         => 'MODULE_PAYMENT_PAGSEGURO_STATUS',
        'configuration_value'       => 'Sim',
        'configuration_description' => 'Voce gostaria de aceitar Pagamentos via PagSeguro?',
        'configuration_group_id'    => 6,
        'sort_order'                => 0,
        'set_function'              => "tep_cfg_select_option(array('Sim', 'Nao'),",
      ),
      array (
        'configuration_title'       => 'Posicao (ordem)',
        'configuration_key'         => 'MODULE_PAYMENT_PAGSEGURO_SORT_ORDER',
        'configuration_value'       => '0',
        'configuration_description' => 'Posicao de demonstracao (quanto menor mostra primeiro)',
        'configuration_group_id'    => 6,
        'sort_order'                => 0,
        'set_function'              => false,
      ),
      array (
        'configuration_title'       => 'E-mail',
        'configuration_key'         => 'MODULE_PAYMENT_PAGSEGURO_EMAIL',
        'configuration_value'       => 'CONFIGURE SEU E-MAIL',
        'configuration_description' => 'E-mail da sua conta PagSeguro',
        'configuration_group_id'    => 6,
        'sort_order'                => 0,
        'set_function'              => false,
      ),
      array (
        'configuration_title'       => 'Token',
        'configuration_key'         => 'MODULE_PAYMENT_PAGSEGURO_TOKEN',
        'configuration_value'       => 'CONFIGURE SEU TOKEN',
        'configuration_description' => 'Digite seu Token (voce pode consegui-lo no site do <a href="https://pagseguro.uol.com.br/Login.aspx?ReturnUrl=%2fSecurity%2fConfiguracoesWeb%2fRetornoAutomatico.aspx" title="Va para sua conta e pegue o seu Token">PagSeguro</a>',
        'configuration_group_id'    => 6,
        'sort_order'                => 0,
        'set_function'              => false,
      ),
      array (
        'configuration_title'       => 'Tipo de Frete',
        'configuration_key'         => 'MODULE_PAYMENT_PAGSEGURO_TIPO_FRETE',
        'configuration_value'       => 'EN - PAC (Encomenda Normal)',
        'configuration_description' => 'Qual o tipo de Frete que você gostaria de cobrar aos seus clientes?',
        'configuration_group_id'    => 6,
        'sort_order'                => 0,
        'set_function'              => "tep_cfg_select_option(array ('EN - PAC (Encomenda Normal)', 'SD - Sedex'), ",
      ),
      array (
        'configuration_title'       => 'Carrinho',
        'configuration_key'         => 'MODULE_PAYMENT_PAGSEGURO_TIPO',
        'configuration_value'       => 'CP',
        'configuration_description' => 'Tipo de Carrinho que gostaria de utilizar',
        'configuration_group_id'    => 6,
        'sort_order'                => 0,
        'set_function'              => false,
      ),
      array (
        'configuration_title'       => 'Pais para utilizar no Modulo PagSeguro',
        'configuration_key'         => 'MODULE_PAYMENT_PAGSEGURO_PAIS',
        'configuration_value'       => 'BR',
        'configuration_description' => 'Pais para utilizar no modulo',
        'configuration_group_id'    => 6,
        'sort_order'                => 0,
        'set_function'              => false,
      ),
      array (
        'configuration_title'       => 'Moeda',
        'configuration_key'         => 'MODULE_PAYMENT_PAGSEGURO_MOEDA',
        'configuration_value'       => 'BRL',
        'configuration_description' => 'Tipo de moeda que sera trabalhada pelo PagSeguro',
        'configuration_group_id'    => 6,
        'sort_order'                => 0,
        'set_function'              => false,
      ),
    );
    $Qinsert = "INSERT INTO ".TABLE_CONFIGURATION." (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) VALUES (:configuration_title, :configuration_key, :configuration_value, :configuration_description, :configuration_group_id, :sort_order, :set_function, now())";
    foreach ($data as $item){
      $tmp = $Qinsert;
      foreach ($item as $key=>$value)
        $tmp = str_replace(":$key", $value===false?'NULL':"'".addslashes($value)."'", $tmp);
      tep_db_query($tmp);
    }
    tep_db_query("
      CREATE TABLE IF NOT EXISTS `ps_status` (
        `id_pg_status` varchar(255),
        `order_id`     int DEFAULT 0,
        `customer_id`  int,
        `status`       int,
        `session`      text
      )
    ");
  }
  /**
   * Desinstala o modulo PagSeguro
   */
  function remove() {
    $keys = join("', '", array_merge(array('MODULE_PAYMENT_PAGSEGURO_MOEDA', 'MODULE_PAYMENT_PAGSEGURO_PAIS', 'MODULE_PAYMENT_PAGSEGURO_TIPO') , $this->keys()));
    tep_db_query("DELETE FROM ".TABLE_CONFIGURATION." WHERE `configuration_key` IN ('". $keys . "')");
    tep_db_query("DROP TABLE IF EXISTS `ps_status`");
  }
}

?>