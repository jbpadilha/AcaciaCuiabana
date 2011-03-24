<?php
    $columnArray = array();
	$columnArray['user8'] = '<jdoc:include type="modules" name="user8" style="xtc" />';
	$columnArray['user9'] = '<jdoc:include type="modules" name="user9" style="xtc" />';
	$columnArray['user10'] = '<jdoc:include type="modules" name="user10" style="xtc" />';
	$columnArray['user11'] = '<jdoc:include type="modules" name="user11" style="xtc" />';
	$columnArray['user12'] = '<jdoc:include type="modules" name="user12" style="xtc" />';
	$columnArray['user13'] = '<jdoc:include type="modules" name="user13" style="xtc" />';

	$areaWidth = $gridParams->wrapperwidth;
	$gutter = 14;
	$order = 'user8,user9,user10,user11,user12,user13';
	$grid = xtcGrid($areaWidth,$gutter,$order,$columnArray);
	if ($grid){
    echo '<div id="region5" class="xtc-spacer">';
	echo '<div id="region5wrap2" class="xtc-wrapperwide">';
	echo '<div id="region5pad" class="xtc-wrapper">';
	echo '<div class="pad2 clearfix">';
	echo $grid;	
	echo '</div>';
	echo '</div>';
	echo '</div>';
	echo '</div>';
	}
?>