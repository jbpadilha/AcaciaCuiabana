<?php if( !defined( '_VALID_MOS' ) && !defined( '_JEXEC' ) ) die( 'Direct Access to '.basename(__FILE__).' is not allowed.' ); 
mm_showMyFileName(__FILE__);
JHTML::_( 'behavior.mootools' );
/*
 * Include the quickinfo.js script
 * Add pop up feature to the browse page
 */
$document = &JFactory::getDocument();
$document->addScript(VM_THEMEURL.'/js/quickinfo.js');
?>

<h3><?php echo $browsepage_lbl ?></h3>
<div class="browseDesc"><?php echo $browsepage_lbltext ?></div>