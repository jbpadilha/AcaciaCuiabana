<?php
// no direct access
defined( '_JEXEC' ) or die( 'Restricted access' );
function modChrome_xtc($module, $params, $moduleClass)
{
	$content         = $module->content;
	$suffix          = $params->get('moduleclass_sfx', '');
    if ($module->showtitle) 
    {
		$moduleClass = 'title-on';
	} else { 
	    $moduleClass = 'title-off';
    }
?>
<div class="module <?php echo $moduleClass;?> <?php echo  $suffix; ?>">
   <?php if ($module->showtitle != 0) : ?>
    <h3><span><?php echo $module->title; ?></span></h3>
   <?php endif; ?>
 <div class="modulecontent">
  <?php echo $content; ?>
  </div>
</div>
<?php }?>
	
