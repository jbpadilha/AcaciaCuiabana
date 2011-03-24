<?php
/**
 * DOCman 1.4.x - Joomla! Document Manager
 * @version $Id: category.tpl.php 773 2009-01-08 17:38:08Z mathias $
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
* Display category details (required)
*
* General variables  :
*	$this->theme->path (string) : template path
* 	$this->theme->name (string) : template name
* 	$this->theme->conf (object) : template configuartion parameters
*	$this->theme->icon (string) : template icon path
*   $this->theme->png  (boolean): browser png transparency support
*
* Template variables :
*	$this->data		(object) : holds the category data
*  $this->links 	(object) : holds the category operations
*  $this->paths 	(object) : holds the category paths
*/
?>

<div>
<div class="app-box-header"><div class="app-box-header">
		<h2 class="app-box-title">
			 <?php if($this->data->title != '') :
				?><?php echo $this->data->title;?><?php
			endif; ?>
		</h2>
</div></div> 
<div class="app-box-content"><div class="app-box-info">   <div style="display:table; width:100%;">
<?php
    if($this->data->image) :
        ?><div style="float:left; width:22%;"><img class="dm_thumb" src="<?php echo $this->paths->thumb; ?>" style="float:<?php echo $this->data->image_position;?>" alt="" /></div><?php
    endif;

   

	if($this->data->description != '') :
		?><div style="float:left; width:78%;"><?php echo $this->data->description;?></div><?php
	endif;
?>
</div></div></div><div class="app-box-footer no-border"><div class="app-box-footer no-border"> </div> </div>
</div>
<div class="clr"></div>
