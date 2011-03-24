<?php
/**
 * DOCman 1.4.x - Joomla! Document Manager
 * @version $Id: list_item.tpl.php 773 2009-01-08 17:38:08Z mathias $
 * @package DOCman_1.4
 * @copyright (C) 2003-2009 Joomlatools
 * @license http://www.gnu.org/copyleft/gpl.html GNU/GPL
 * @link http://www.joomlatools.eu/ Official website
 **/
defined('_VALID_MOS') or die('Restricted access');

/**
 * Default DOCman Theme
 *
 * Creator:  Joomlatools
 * Website:  http://www.joomlatools.eu/
 * Email:    support@joomlatools.eu
 * Revision: 1.4
 * Date:     February 2007
 **/

/*
* Display a category list item (called by categories/list.tpl.php)
*
* General variables  :
*	$this->theme->path (string) : template path
* 	$this->theme->name (string) : template name
* 	$this->theme->conf (object) : template configuartion parameters
*	$this->theme->icon (string) : template icon path
*   $this->theme->png  (boolean): browser png transparency support
*
* Template variables :
*	$item->data		(object) : holds the category data
*  $item->links 	(object) : holds the category operations
*  $item->paths 	(object) : holds the category paths
*/

?>
<div class="dm_row">
<div class="app-box-shadow-border">
	<h3 style="float:left; width:90%;">	
	<a  href="<?php echo $item->links->view;?>"><?php echo $item->data->name;?></a></h3><h3>(<?php echo $item->data->files;?>)</h3>
</div>
<div class="app-box-info">
<?php
switch ($this->theme->conf->cat_image) :
	case 0 : //none

		//do nothing
	break;

	case 1 : //icon
		?><div style="float:left;"><a class="dm_icon" href="<?php echo $item->links->view;?>"><img src="<?php echo $item->paths->icon;?>" alt="folder icon" /></a></div><?php
	break;

	case 2 : //thumb
		if($item->data->image) :
		?><div style="float:left;"><a class="dm_thumb" href="<?php echo $item->links->view;?>"><img src="<?php echo $item->paths->thumb;?>" alt="<?php echo $item->data->name;?>" /></a></div><?php
		endif;
	break;
endswitch;
?>
   
<div style="float:left; width:90%;" >
    <?php
    if($item->data->description) :
        ?><?php echo $item->data->description;?><?php
    endif;
    ?>
	</div>
</div><div class="clr"></div><div class="clr"></div>
</div>

<div class="clr"></div>
