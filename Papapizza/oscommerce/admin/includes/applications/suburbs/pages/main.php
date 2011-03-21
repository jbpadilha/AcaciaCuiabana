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
?>

<h1><?php echo osc_link_object(osc_href_link_admin(FILENAME_DEFAULT, $osC_Template->getModule()), $osC_Template->getPageTitle()); ?></h1>

<?php
  if ( $osC_MessageStack->exists($osC_Template->getModule()) ) {
    echo $osC_MessageStack->get($osC_Template->getModule());
  }
?>

<div style="padding-bottom: 10px;">
  <span><form id="liveSearchForm"><input type="text" id="liveSearchField" name="search" class="searchField fieldTitleAsDefault" title="Search.." /><input type="button" value="Reset" class="operationButton" onclick="osC_DataTable.reset();" /></form></span>
  <span style="float: right;"><?php echo '<input type="button" value="' . $osC_Language->get('button_insert') . '" onclick="document.location.href=\'' . osc_href_link_admin(FILENAME_DEFAULT, $osC_Template->getModule() . '&action=save') . '\';" class="infoBoxButton" />'; ?></span>
</div>

<div style="clear: both; padding: 2px; height: 16px;">
  <span id="batchTotalPages"></span>
  <span id="batchPageLinks"></span>
</div>

<form name="batch" action="#" method="post">

<table border="0" width="100%" cellspacing="0" cellpadding="2" class="dataTable" id="suburbsDataTable">
  <thead>
    <tr>
      <th><?php echo $osC_Language->get('table_heading_suburbs'); ?></th>
      <th><?php echo $osC_Language->get('table_heading_price'); ?></th>
      <th width="150"><?php echo $osC_Language->get('table_heading_action'); ?></th>
      <th align="center" width="20"><?php echo osc_draw_checkbox_field('batchFlag', null, null, 'onclick="flagCheckboxes(this);"'); ?></th>
    </tr>
  </thead>
  <tfoot>
    <tr>
      <th align="right" colspan="2"><?php echo '<input type="image" src="' . osc_icon_raw('edit.png') . '" title="' . $osC_Language->get('icon_edit') . '" onclick="document.batch.action=\'' . osc_href_link_admin(FILENAME_DEFAULT, $osC_Template->getModule() . '&action=batch_save') . '\';" />&nbsp;<input type="image" src="' . osc_icon_raw('trash.png') . '" title="' . $osC_Language->get('icon_trash') . '" onclick="document.batch.action=\'' . osc_href_link_admin(FILENAME_DEFAULT, $osC_Template->getModule() . '&action=batch_delete') . '\';" />'; ?></th>
      <th align="center" width="20"><?php echo osc_draw_checkbox_field('batchFlag', null, null, 'onclick="flagCheckboxes(this);"'); ?></th>
    </tr>
  </tfoot>
  <tbody>
  </tbody>
</table>

</form>

<div style="padding: 2px;">
  <span id="dataTableLegend"><?php echo '<b>' . $osC_Language->get('table_action_legend') . '</b> ' . osc_icon('edit.png') . '&nbsp;' . $osC_Language->get('icon_edit') . '&nbsp;&nbsp;' . osc_icon('trash.png') . '&nbsp;' . $osC_Language->get('icon_trash'); ?></span>
  <span id="batchPullDownMenu"></span>
</div>

<script type="text/javascript"><!--
  var moduleParamsCookieName = 'oscadmin_module_' + pageModule;

  var moduleParams = new Object();
  moduleParams.page = 1;
  moduleParams.search = '';

  if ( $.cookie(moduleParamsCookieName) != null ) {
    var p = $.secureEvalJSON($.cookie(moduleParamsCookieName));
    moduleParams.page = parseInt(p.page);
    moduleParams.search = String(p.search);
  }

  var dataTableName = 'suburbsDataTable';
  var dataTableDataURL = '<?php echo osc_href_link_admin('rpc.php', $osC_Template->getModule() . '&action=getAll'); ?>';

  var suburbsLink = '<?php echo osc_href_link_admin(FILENAME_DEFAULT, $osC_Template->getModule() . '=SUBURBSID'); ?>';
  var suburbsLinkIcon = '<?php echo osc_icon('folder.png'); ?>';
  
  var suburbsEditLink = '<?php echo osc_href_link_admin(FILENAME_DEFAULT, $osC_Template->getModule() . '&aID=SUBURBSID&action=save'); ?>';
  var suburbsEditLinkIcon  = '<?php echo osc_icon('edit.png'); ?>';

  var suburbsExportLink = '<?php echo osc_href_link_admin(FILENAME_DEFAULT, $osC_Template->getModule() . '&lID=SUBURBSID&action=export'); ?>';
  var suburbsExportLinkIcon = '<?php echo osc_icon('export.png'); ?>';

  var suburbsDeleteLink = '<?php echo osc_href_link_admin(FILENAME_DEFAULT, $osC_Template->getModule() . '&aID=SUBURBSID&action=delete'); ?>';
  var suburbsDeleteLinkIcon = '<?php echo osc_icon('trash.png'); ?>';

  var osC_DataTable = new osC_DataTable();
  osC_DataTable.load();

  function feedDataTable(data) {
    var rowCounter = 0;

    for ( var r in data.entries ) {
      var record = data.entries[r];

      var newRow = $('#' + dataTableName)[0].tBodies[0].insertRow(rowCounter);
      newRow.id = 'row' + parseInt(record.suburbs_id);

      $('#row' + parseInt(record.suburbs_id)).mouseover( function() { rowOverEffect(this); }).mouseout( function() { rowOutEffect(this); }).click(function(event) {
        if (event.target.type !== 'checkbox') {
          $(':checkbox', this).trigger('click');
        }
      }).css('cursor', 'pointer');

      var newCell = newRow.insertCell(0);
      newCell.innerHTML = '<a href="' + suburbsLink.replace('SUBURBSID', parseInt(record.suburbs_id)) + '">' + suburbsLinkIcon + '&nbsp;' + htmlSpecialChars(record.suburbs_name) + '</a>';

      newCell = newRow.insertCell(1);
      newCell.innerHTML = htmlSpecialChars(record.suburbs_price);

      newCell = newRow.insertCell(2);
      newCell.innerHTML = '<a href="' + suburbsEditLink.replace('SUBURBSID', parseInt(record.suburbs_id)) + '">' + suburbsEditLinkIcon + '</a>&nbsp;<a href="' + suburbsExportLink.replace('SUBURBSID', parseInt(record.suburbs_id)) + '">' + suburbsExportLinkIcon + '</a>&nbsp;<a href="' + suburbsDeleteLink.replace('SUBURBSID', parseInt(record.suburbs_id)) + '">' + suburbsDeleteLinkIcon + '</a>';
      newCell.align = 'right';

      newCell = newRow.insertCell(3);
      newCell.innerHTML = '<input type="checkbox" name="batch[]" value="' + parseInt(record.suburbs_id) + '" id="batch' + parseInt(record.suburbs_id) + '" />';
      newCell.align = 'center';

      rowCounter++;
    }
  }
//--></script>
