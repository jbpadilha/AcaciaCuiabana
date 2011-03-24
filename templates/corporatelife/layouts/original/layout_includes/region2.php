<?php
	$columnArray = array();
	$columnArray['user1'] = '<jdoc:include type="modules" name="user1" style="xtc" />';
	$columnArray['user2'] = '<jdoc:include type="modules" name="user2" style="xtc" />';
	$columnArray['user3'] = '<jdoc:include type="modules" name="user3" style="xtc" />';
	$columnArray['user4'] = '<jdoc:include type="modules" name="user4" style="xtc" />';
	$columnArray['user5'] = '<jdoc:include type="modules" name="user5" style="xtc" />';
	$columnArray['user6'] = '<jdoc:include type="modules" name="user6" style="xtc" />';

	$areaWidth = $gridParams->wrapperwidth;
	$gutter = $gridParams->columnseparatorwidth;
	$order = 'user1,user2,user3,user4,user5,user6';
	$columnClass = '';
    $gutter = 14;
	$grid = xtcGrid($areaWidth,$gutter,$order,$columnArray,$customWidths,$columnClass);

	if (!empty($grid)) {
		echo '<div id="region2" class="xtc-spacer xtc-wrapper">';
		echo '<div id="region2-inner" class="clearfix">';
		echo $grid;
		echo '</div></div>';
	}
return;
?>