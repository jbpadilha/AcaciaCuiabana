<?php
	if ($this->countModules( 'user8t') || $this->countModules( 'user9') || $this->countModules( 'user10') || $this->countModules( 'user11') || $this->countModules( 'user12') || $this->countModules( 'user13')) {
	$region5class = 'r5wrap1';
	} else if($this->countModules( 'user14')) {
    $region5class = 'r5wrap2';
	} else {
    $region5class = 'r5wrap3';
	}

	
	$columnArray = array();
	$columnArray['user15'] = '<jdoc:include type="modules" name="user15" style="xtc" />';
	$columnArray['user16'] = '<jdoc:include type="modules" name="user16" style="xtc" />';
	$columnArray['user17'] = '<jdoc:include type="modules" name="user17" style="xtc" />';
	$columnArray['user18'] = '<jdoc:include type="modules" name="user18" style="xtc" />';
	$columnArray['user19'] = '<jdoc:include type="modules" name="user19" style="xtc" />';
	$columnArray['user20'] = '<jdoc:include type="modules" name="user20" style="xtc" />';

	$areaWidth = $gridParams->wrapperwidth;
	$gutter = $gridParams->columnseparatorwidth;
	$order = 'user15,user16,user17,user18,user19,user20';
	$grid = xtcGrid($areaWidth,$gutter,$order,$columnArray);
	if ($this->countModules( 'user14') || ($grid)) {
	
	echo '<div id="region6"">';
	echo '<div id="region6wrap2" class="xtc-wrapperwide">';
	echo '<div id="region6wrap3" class="g'.$region5class.'">';
	echo '<div id="region6wr">';
	echo '<div class="pad2 clearfix">';
	if ($this->countModules( 'user14' )) {echo '<div id="gridwrap1" class="clearfix xtc-wrapperwide"><jdoc:include type="modules" name="user14" style="xtc" /></div>';}
	if ($grid) {
     echo '<div id="gridwrap2" class="xtc-wrapper clearfix">';
    echo $grid;
    echo '</div>';
	}		
	echo '</div>';
	echo '</div>';
	echo '</div>';
	echo '</div>';
	echo '</div>';
	}
?>
