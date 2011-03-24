<?php if( !defined( '_VALID_MOS' ) && !defined( '_JEXEC' ) ) die( 'Direct Access to '.basename(__FILE__).' is not allowed.' ); ?>
<div style="margin-left: -15px">
<?php if( !defined( '_VALID_MOS' ) && !defined( '_JEXEC' ) ) die( 'Direct Access to '.basename(__FILE__).' is not allowed.' ); ?>

<?php
echo $categories; ?>
<?php
echo '<table width="100%" border="0" cellpadding="0" cellspacing="0">';
echo '<tr><td valign="top" colspan="2" >';
$modules =& JModuleHelper::getModules('shoptop');
foreach ($modules as $module) {
	echo JModuleHelper::renderModule($module);
}
echo '</td></tr><tr><td valign="top">';
$modules =& JModuleHelper::getModules('shopleft');
foreach ($modules as $module) {
	echo JModuleHelper::renderModule($module);
}
echo '</td><td valign="top">';
$modules =& JModuleHelper::getModules('shopright');
foreach ($modules as $module) {
	echo JModuleHelper::renderModule($module);
}
echo '</td></tr>';
echo '<tr><td valign="top" colspan="2">';
?>

<?php
echo '</td></tr><tr><td valign="top" colspan="2">';
$modules =& JModuleHelper::getModules('shopbottom');
foreach ($modules as $module) {
	echo JModuleHelper::renderModule($module);
}
echo '</td></tr></table>';
?>
</div>