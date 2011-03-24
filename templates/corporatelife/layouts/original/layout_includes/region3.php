<?php
	$centerWidth=$gridParams->wrapperwidth-128;
	$areaWidth = $gridParams->wrapperwidth-128;
	$gutter = $gridParams->columnseparatorwidth;
	
	$columnArray = array();
	$columnArray['left'] 	= '<jdoc:include type="modules" name="left" style="xtc" />';
	$columnArray['center'] 	= array('<jdoc:include type="modules" name="newsflash" style="xtc" />',
																	'<jdoc:include type="modules" name="inset" style="xtc" />',
																	'<div id="breadcrumb-outer" class="xtc-spacer"><jdoc:include type="modules" name="breadcrumb" /></div>',
																	'<div id="component-outer" class="xtc-spacer clearfix"><jdoc:include type="component" /></div>',
																	'<div id="banner2" class="xtc-spacer"><jdoc:include type="modules" name="banner2" style="xtc" /></div>');
	$columnArray['right'] 	= '<jdoc:include type="modules" name="right" style="xtc" />';
	$order = $gridParams->region3cfg;
	$customWidths = array();
	$customWidths['left'] = $gridParams->leftwidth;
	$customWidths['right'] = $gridParams->rightwidth;

	$columnClass = '';
	$columnPadding=0;

	$grid = xtcGrid($areaWidth,$gutter,$order,$columnArray,$customWidths,$columnClass,$columnPadding,0);


	$columnArray = array(
		'showcase1' => '<jdoc:include type="modules" name="showcase1" style="xtc" />',
		'showcase2' => '<jdoc:include type="modules" name="showcase2" style="xtc" />',
		'showcase3' => '<jdoc:include type="modules" name="showcase3" style="xtc" />',
		'showcase4' => '<jdoc:include type="modules" name="showcase4" style="xtc" />',
	);
	$gutter = 32;
	$order = 'showcase1,showcase2,showcase3,showcase4';
	$customWidths = array();
	$columnClass = '';
	$columnPadding = 0;
	$grid2 = xtcGrid($areaWidth,$gutter,$order,$columnArray,$customWidths,$columnClass,$columnPadding,0);
	
	if ($grid || $grid2) {
	echo '<div id="region3w">';
    echo '<div class="wrap-top"></div>';
	echo '<div class="wrap-bottom"></div>';
	echo '<div id="region3wrap2" class="xtc-wrapperwide xtc-spacer">';
	echo '<div class="wrap-tl"></div>';
	echo '<div class="wrap-tr"></div>';
	echo '<div class="wrap-bl"></div>';
	echo '<div class="wrap-br"></div>';
	echo '<div id="region3" class="xtc-wrapper">';
	echo '<div class="pad">';
	echo '<div class="pad2">';
	if ($grid) {
	echo '<div id="content" class="clearfix">';
	echo $grid;
	echo '</div>';
	}
	// added a closing div to make the background go full width - there might be an extra div now //
	if ($grid2) { echo '</div><div id="region3b" class="clearfix">'.$grid2.'</div>'; 
	}
	echo '</div>';
	echo '</div>';
	echo '</div>';
	echo '</div>';
	echo '</div>';
    }
?>