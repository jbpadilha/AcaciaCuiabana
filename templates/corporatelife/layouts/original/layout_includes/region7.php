<?php
	$columnArray = array();
	$columnArray['footer'] = '<jdoc:include type="modules" name="footer" style="xtc" />';
	$columnArray['legals'] = '<jdoc:include type="modules" name="legals" style="xtc" />';

	$areaWidth = $gridParams->wrapperwidth;
	$gutter = $gridParams->columnseparatorwidth;
	$order = 'footer,legals';
	$grid = xtcGrid($areaWidth,$gutter,$order,$columnArray);

	if (!empty($grid)) {
		echo '<div id="region7">';
		echo '<div id="region7wrap2" class="xtc-wrapperwide">';
		echo '<div id="region7-inner" class="clearfix xtc-wrapper">';
		echo $grid;
		echo '</div></div></div>';
	}
?>