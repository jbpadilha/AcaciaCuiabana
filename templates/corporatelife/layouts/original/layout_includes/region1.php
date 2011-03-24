<?php
if ($this->countModules( 'banner' )) {
	$topmenuid = 'topmenuwrap';
} else {
	$topmenuid = 'topmenuwraps';	
}
if ($this->countModules( 'topmenu' )) {
	$topmenuclass = 'xtc-spacerlarge';
} else {
	$topmenuclass = 'xtc-spacersmall';
}
?>

<div id="header_outer">
  <div id="headerwrap">
    <?php if ($this->countModules( 'banner' )) { ?>
    <div id="banner">
      <div class="xtc-wrapperwide">
        <jdoc:include type="modules" name="banner" style="raw"/>
      </div>
    </div>
    <div id="head-bottom" class="<?php echo $topmenuclass;?>"></div>
    <?php } ?>
    <div id="head-top"></div>
    <div id="header">
      <div id="logowrap" class="clearfix xtc-wrapper"> <a id="logo" class="hideTxt" href="<?php echo JURI::base();?>">Logo</a> 
     <?php if ($this->countModules( 'top' )) { ?>
    <div id="top">
        <jdoc:include type="modules" name="top" style="raw"/>
    </div>
    <?php } ?>
    </div>
      <div id="menu" class="xtc-wrapper">
        <jdoc:include type="modules" name="menubar"/>
      </div>
    </div>
    <?php if ($this->countModules( 'topmenu' )) { ?>
    <div id="<?php echo $topmenuid;?>">
      <div id="topmenu" class="xtc-wrapper">
        <jdoc:include type="modules" name="topmenu" style="xhtml"/>
      </div>
    </div>
    <?php } ?>
  </div>
</div>
