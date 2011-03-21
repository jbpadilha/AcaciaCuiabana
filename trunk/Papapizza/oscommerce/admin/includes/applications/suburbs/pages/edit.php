<?php
/*
  $Id: $

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2009 osCommerce

  This program is free software; you can redistribute it and/or modify
  it under the terms of the GNU General Public License v2 (1991)
  as published by the Free Software Foundation.
*/

  $osC_ObjectInfo = new osC_ObjectInfo(osC_Suburbs_Admin::get($_GET['aID']));
?>

<h1><?php echo osc_link_object(osc_href_link_admin(FILENAME_DEFAULT, $osC_Template->getModule()), $osC_Template->getPageTitle()); ?></h1>

<?php
  if ( $osC_MessageStack->exists($osC_Template->getModule()) ) {
    echo $osC_MessageStack->get($osC_Template->getModule());
  }
?>

<div class="infoBoxHeading"><?php echo osc_icon('edit.png') . ' ' . $osC_ObjectInfo->getProtected('suburbs_name'); ?></div>
<div class="infoBoxContent">
  <form name="lEdit" class="dataForm" action="<?php echo osc_href_link_admin(FILENAME_DEFAULT, $osC_Template->getModule() . '&aID=' . $osC_ObjectInfo->getInt('suburbs_id') . '&action=save'); ?>" method="post">

  <p><?php echo $osC_Language->get('introduction_edit_suburbs'); ?></p>

  <fieldset>
    <div><label for="suburbs_name"><?php echo $osC_Language->get('field_suburbs_name'); ?></label><?php echo osc_draw_input_field('suburbs_name', $osC_ObjectInfo->get('suburbs_name')); ?></div>
    <div><label for="suburbs_price"><?php echo $osC_Language->get('field_suburbs_price'); ?></label><?php echo osc_draw_input_field('suburbs_price', $osC_ObjectInfo->get('suburbs_price')) ; ?></div>
    <script type="text/javascript">
    $(document).ready(function(){
		$("#suburbs_price").maskMoney({symbol:"R$",decimal:".",thousands:""})
	});
	</script>
  </fieldset>

  <p align="center"><?php echo osc_draw_hidden_field('subaction', 'confirm') . '<input type="submit" value="' . $osC_Language->get('button_save') . '" class="operationButton" /> <input type="button" value="' . $osC_Language->get('button_cancel') . '" onclick="document.location.href=\'' . osc_href_link_admin(FILENAME_DEFAULT, $osC_Template->getModule()) . '\';" class="operationButton" />'; ?></p>

  </form>
</div>