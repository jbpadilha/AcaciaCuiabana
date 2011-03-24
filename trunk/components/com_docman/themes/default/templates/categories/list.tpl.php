<?php
/**
 * DOCman 1.4.x - Joomla! Document Manager
 * @version $Id: list.tpl.php 773 2009-01-08 17:38:08Z mathias $
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
* Display the category list (required)
*
* General variables  :
*	$this->theme->path (string) : template path
* 	$this->theme->name (string) : template name
* 	$this->theme->conf (object) : template configuartion parameters
*	$this->theme->icon (string) : template icon path
*   $this->theme->png  (boolean): browser png transparency support
*
* Template variables :
*	$this->items (array)  : holds an array of dcoument items
*/
?>

<?php if (count($this->items)) { ?>
    <div id="dm_cats">
	<div class="app-box-header"><div class="app-box-header">
		<h2 style="float:left; width:90%" class="app-box-title"><?php echo _DML_TPL_CATS;?></h2> <h2 class="app-box-title"><?php echo _DML_TPL_FILES;?></h2>
	</div></div>    
    <div class="app-box-content">
    <?php
     	/*
         * Include the list_item template and pass the item to it
        */

    	foreach($this->items as $item) :
    		if($this->theme->conf->cat_empty || $item->data->files != 0) :
    			include $this->loadTemplate('categories/list_item.tpl.php');
    		endif;
    	endforeach;
    ?>
    </div>
	<div class="app-box-footer no-border"><div class="app-box-footer no-border"> </div> </div>
    </div>
<?php } ?>