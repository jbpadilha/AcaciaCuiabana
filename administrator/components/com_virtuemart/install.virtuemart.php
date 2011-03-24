<?php
if( !defined( '_VALID_MOS' ) && !defined( '_JEXEC' ) ) {
	die( 'Direct Access to '.basename(__FILE__).' is not allowed.' );
}
/**
* @version $Id: install.virtuemart.php 1336 2008-03-31 17:06:23Z soeren_nb $
* @package VirtueMart
* @subpackage core
* @copyright Copyright (C) 2004-2007 soeren - All rights reserved.
* @license http://www.gnu.org/copyleft/gpl.html GNU/GPL, see LICENSE.php
* VirtueMart is free software. This version may have been modified pursuant
* to the GNU General Public License, and as distributed it includes or
* is derivative of works licensed under the GNU General Public License or
* other free or open source software licenses.
*
* http://virtuemart.net
*/
global $option;
include_once( dirname(__FILE__).'/compat.joomla1.5.php' );

if (isset($_REQUEST['install_type']) && file_exists( $mosConfig_absolute_path.'/administrator/components/'.$option.'/install.php' )) {
	virtuemart_is_installed();
	include( $mosConfig_absolute_path.'/administrator/components/'.$option.'/install.php' );

	/** can be update and newinstall **/
	$install_type = empty($_REQUEST['install_type']) ? 'newinstall' : $_REQUEST['install_type'];

	/** true or false **/
	$install_sample_data = (bool)@$_GET['install_sample_data'];

	installvirtuemart( $install_type, $install_sample_data );
	$error = "";
	$page = "store.index";

	$installfile = dirname( __FILE__ ) . "/install.php";
	if( !@unlink( $installfile ) ) {
		echo "<br /><span class=\"message\">Ocorreu um erro ao tentar excluir o arquivo <strong>install.php</strong>!<br />";
		echo "Você terá que excluir o arquivo manualmente antes de poder usar o VirtueMart!</span>";
	}

}
elseif( file_exists( $mosConfig_absolute_path.'/administrator/components/'.$option.'/install.php' )) {
	echo '<html><head><title>Instalação do VirtueMart</title>
	</head>
	<body>';
	virtuemart_is_installed();
	com_install();
	echo '</body></html>';
	exit();

}
function virtuemart_is_installed() {
	global $database, $mosConfig_absolute_path, $mosConfig_dbprefix,
		$VMVERSION, $shortversion, $myVersion, $version_info;
	if( is_null( $database ) && class_exists('jfactory')) {
		$database = JFactory::getDBO();
	}
	//add VirtueMart admin menu image
	$database->setQuery( "UPDATE #__components SET admin_menu_img = '../components/com_virtuemart/shop_image/ps_image/menu_icon.png' WHERE admin_menu_link = 'option=com_virtuemart'");
	$database->query();

	$option = 'com_virtuemart';
	$installfile = dirname( __FILE__ ) . "/install.php";

	$database->setQuery( "SHOW TABLES LIKE '".$mosConfig_dbprefix."vm_%'" );
	$vm_tables = $database->loadObjectList();

	if( file_exists( $mosConfig_absolute_path.'/administrator/components/'.$option.'/classes/htmlTools.class.php' )
		&& count( $vm_tables)> 30 ) {
		// VirtueMart is installed! But is it an older version that needs to be updated?
		$database->setQuery( 'SELECT id, params FROM `#__components` WHERE name = \'virtuemart_version\'' );
		$database->loadObject( $old_version );
		if( $old_version && file_exists( $mosConfig_absolute_path.'/administrator/components/com_virtuemart/classes/htmlTools.class.php')) {
			$version_info = new mosParameters( $old_version->params );
			include_once( $mosConfig_absolute_path.'/administrator/components/'.$option.'/version.php' );
			$VMVERSION = new vmVersion();
			$result = version_compare( $version_info->get( 'RELEASE' ), '1.1.0' );

			if( $result == -1 ) {
				return false;
			}
		}

		@unlink( $installfile );
		if( ( file_exists($installfile)) || !file_exists(dirname( __FILE__ ) . "/virtuemart.cfg.php")) {
			die('<h2>Avivo da Instalação do Virtuemart</h2>
			<p>Você já tem o VirtueMart instalado!</p>
			<p>Você DEVE
			<ol>
				<li>EXCLUIR o arquivo <strong>'.$installfile.'</strong>,</li>
				<li>RENOMEAR o arquivo <strong>virtuemart.cfg-dist.php</strong> para <strong>virtuemart.cfg.php</strong></li>
			</ol>antes de poder usar o VirtueMart.
			</p>');
		}
		else {
			header('Location: index2.php?option=com_virtuemart');
			echo '<script type="text/javascript">document.location=\''.$GLOBALS['mosConfig_live_site'].'/administrator/index2.php?option=com_virtuemart\';</script>';
			exit;
		}
	}
	return false;

}
function com_install() {
	global $mosConfig_absolute_path, $mosConfig_dbprefix, $database,
		$VMVERSION, $myVersion, $shortversion, $version_info;
	include( $mosConfig_absolute_path. "/administrator/components/com_virtuemart/version.php" );
	if( !isset( $shortversion )) {
		$shortversion = $VMVERSION->PRODUCT . " " . $VMVERSION->RELEASE . " " . $VMVERSION->DEV_STATUS. " ";
		$myVersion = $shortversion . " [".$VMVERSION->CODENAME ."] <br />" . $VMVERSION->RELDATE . " "
					. $VMVERSION->RELTIME . " " . $VMVERSION->RELTZ;
	}
	if( defined( '_RELEASE' )) {
		// Refuse to install on Mambo 4.5.0
		if( _RELEASE == '4.5' || (float)_RELEASE <= 4.50 )
			die( '<h2>A instalação do VirtueMart não pode continuar: Versão errada do Mambo!</h2>
<p>VirtueMart requer no mínimo Mambo versão <strong>4.5.1</strong></p>
<p>Sua Versão: Mambo <strong>'._RELEASE.'.0 '._DEV_STATUS.' '._DEV_LEVEL.'</strong>, Codename: '._CODENAME.'</p>' );
	}
	// Check for old mambo-phpShop Tables. When they exist,
	// offer an Upgrade
	if( is_null( $database ) && class_exists('jfactory')) {
		$database = JFactory::getDBO();
	}
	$database->setQuery( "SHOW TABLES LIKE '".$mosConfig_dbprefix."pshop_%'" );
	$pshop_tables = $database->loadObjectList();

	if( !empty( $pshop_tables )) {
	  $installation = "phpshopupdate";
	}
	else {
		$database->setQuery( 'SELECT id FROM `#__components` WHERE name = \'virtuemart_version\'' );
		$old_version =  $database->loadResult();
		if( $old_version && file_exists( $mosConfig_absolute_path.'/administrator/components/com_virtuemart/classes/htmlTools.class.php')) {
			$installation = 'vm_update';
		}
		else {
			$installation = "new";
		}
	}
	?>
	<link rel="stylesheet" href="components/com_virtuemart/install.css" type="text/css" />
	<div align="center">
		<table width="100%" border="0">
			<tr>
				<td valign="middle" align="center">
					<div id="ctr" align="center">
						<div class="install">
							<div id="stepbar">
								<div style="text-align: center; ">
									<a href="http://virtuemart.net" target="_blank"><img border="0" align="center" src="components/com_virtuemart/cart.gif" alt="Cart" /></a><br/><a href="http://www.joomlaclube.com.br" target="_blank"><img border="0" align="center" src="components/com_virtuemart/jcb.jpg" alt="JoomlaClube - brazil open source" /></a>
									<br/>
								</div>
								<div class="clr"></div>
								<br/><br/><br/>
								<div class="step-on" >
									<form action="https://www.paypal.com/cgi-bin/webscr" method="post" target="_blank">
										Por favor, considere uma pequena doação para ajudar-me a manter o trabalho com este componente.<br /><br />
										<input type="hidden" name="cmd" value="_xclick" />
										<input type="hidden" name="business" value="soeren_nb@yahoo.de" />
										<input type="hidden" name="item_name" value="VirtueMart Donation" />
										<input type="hidden" name="item_number" value="" />
										<input type="hidden" name="currency_code" value="EUR" />
										<input type="hidden" name="tax" value="0" />
										<input type="hidden" name="no_note" value="0" />
										<input type="hidden" name="amount" value="" />
										<input type="image" src="components/com_virtuemart/x-click-but21.gif" border="0" name="submit" alt="Make payments with PayPal - it's fast, free and secure!" />
									</form>
								</div>
							</div>
							<div id="right">
								<div id="step">Bem vindo ao <?php echo $shortversion ?>!</div>

								<div class="clr"></div>
								<pre><?php echo $myVersion ?></pre>
								<h1>O primeiro passo da instalação foi concluído com <font color="green">SUCESSO</font>!</h1>
								<table>
								<?php
								if( $installation == "new" ) { ?>
									<tr>
										<td colspan="3" class="error">Vamos preparar o banco de dados agora (o Script de Instalação não encontrou tabelas existentes do mambo-phpShop/VirtueMart, então vamos iniciar uma nova instalação).</td>
									</tr>
									<tr>
										<td width="40%">Instalação Básica concluída. Você pode usar VirtueMart depois de clicar no link abaixo.<br/></td>
										<td width="20%">&nbsp;</td>
										<td width="40%">Para preencher a sua loja com produtos fictícios, e ter uma idéia de como as coisas podem ser configuradas,
										você pode instalar alguns Dados de Exemplo.
										</td>
									</tr>
									<tr>
										<td width="40%">
											<a title="Ir diretamente à Loja &gt;&gt;" onclick="alert('Por favor não interrompa o próximo passo!\n Ele é essencial para a aualização a execução do VirtueMart.');" name="Button1" class="button" href="index2.php?option=com_virtuemart&install_type=newinstall">Ir diretamente à Loja &gt;&gt;</a>
										</td>
										<td width="20%">&nbsp;</td>
										<td width="40%">
											<a name="Button2" onclick="alert('Por favor não interrompa o próximo passo!\n Ele é essencial para a execução do VirtueMart.');" class="button" title="Instalar DADOS DE EXEMPLO &gt;&gt;" href="index2.php?option=com_virtuemart&install_type=newinstall&install_sample_data=true">Instalar DADOS DE EXEMPLO &gt;&gt;</a>
										</td>
									</tr>
									<tr>
										<td align="center" colspan="3"><br /><br /><hr /><br /></td>
									</tr>
									<?php
								}
								elseif( $installation == 'vm_update' ) {
									$old_version = get_class($version_info) =='mosparameters' ? $version_info->get( 'RELEASE') : '1.0.x';
									?>
										<td colspan="3" class="error">[MODO DE ATUALIZAÇÃO]<br/>O Script tem de Instalação descobriu que você já tem o VirtueMart instalado <?php echo $old_version; ?>, por isso, vamos atualizar o seu banco de dados.</td>
									<tr>
									</tr>
									<tr>
										<td align="left" colspan="3">
											<div align="center">
												<a title="ATUALIZAR DA VERSÃO <?php echo $old_version ?> &gt;&gt;" onclick="alert('Por favor não interrompa o próximo passo!\n Ele é essencial para a aualização do VirtueMart.');" name="Button2" class="button" href="index2.php?option=com_virtuemart&install_type=updatevm10x">ATUALIZAR DA VERSÃO <?php echo $old_version ?> &gt;&gt;</a>
											</div><br /><br/>
											Sua versão do VirtueMart NÃO é <strong><?php echo $old_version ?></strong>? Então, por favor, exclua o arquivo <strong><?php echo dirname(__FILE__).'/install.php' ?></strong><br />
											
										</td>
									</tr>
									<?php
								}
								elseif( $installation == 'phpshopupdate' ) {  ?>
									<tr>
										<td colspan="3" class="error">[MODO DE ATUALIZAÇÃO]<br/>O Script de Instalação encontrou tabelas existentes do mambo-phpShop, então vamos atualizar o seu banco de dados.</td>
									</tr>
									<tr>
										<td align="left" colspan="3">Se você estiver atualizando do mambo-phpShop, versão <strong>1.2 stable-pl3</strong> ou <strong>Mambo eCommerce Edition</strong> então terá que clicar neste link!<br />
											<br /><br/>
											<div align="center">
												<a title="ATUALIZAR DA VERSÃO 1.2 stable-pl3 &gt;&gt;" onclick="alert('Por favor não interrompa o próximo passo!\n Ele é essencial para a aualização do mambo-phpShop para VirtueMart.');" name="Button2" class="button" href="index2.php?option=com_virtuemart&install_type=update12pl3">ATUALIZAR DA VERSÃO 1.2 stable-pl3 &gt;&gt;</a>
											</div>
											<div class="error">Nota:</div>
											Se o seu número de versão é entre 1.1 e 1.2 stable.pl3 (por exemplo, <i>1.2 beta3</i>), você tem que atualizar o seu banco de dados antes de usar os Scripts SQL Atualização Passo-a-Passo da pasta
											<pre>/administrator/components/com_virtuemart/sql/other</pre> de sua instalação VirtueMart. VOcê pode executar estes Scripts com <a href="http://mamboforge.net/projects/mosphpmyadmin/" target="_blank">phpMyAdmin para Mambo/Joomla</a>.
										</td>
									</tr>
									<tr>
										<td align="center" colspan="3"><br /><br /><hr /><br /></td>
									</tr>
									<tr>
										<td align="center" colspan="3">
											<br /><br/>
											<div align="center">
												<a title="ATUALIZAR DA VERSÃO 1.2 RC2 &gt;&gt;" onclick="alert('Por favor não interrompa o próximo passo!\n Ele é essencial para a atualização do mambo-phpShop para VirtueMart.');" name="Button2" class="button" href="index2.php?option=com_virtuemart&install_type=update12">ATUALIZAR DA VERSÃO 1.2 RC2 &gt;&gt;</a>
											</div>
										</td>
									</tr>
									<tr>
										<td align="center" colspan="3">Se você estiver atualizando da versão 1.1(a) então terá que clicar neste link!<br /><br />
											<a name="Button2" class="button" title="ATUALIZAR DA VERSÃO 1.1(a) &gt;&gt;" onclick="alert('Por favor não interrompa o próximo passo!\n Ele é essencial para a atualização do mambo-phpShop para VirtuMart.');" href="index2.php?option=com_virtuemart&install_type=update11">ATUALIZAR DA VERSÃO 1.1(a) &gt;&gt;<a />
										</td>
									</tr>
									<tr>
										<td align="center" colspan="3"><br /><br /><hr /><br /></td>
									</tr>
									<?php
								}
									?>
									<tr>
										<td align="center" colspan="3">Acesse <a href="http://www.virtuemart.net" target="_blank">virtuemart.net</a> para mais Ajuda</td>
									</tr>
								</table>
							</div>
							<div class="clr"></div>
					</div>
				</td>
			</tr>
		</table>
	</div>
	<?php
}
?>