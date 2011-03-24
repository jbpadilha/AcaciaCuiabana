<?php
/**
 * DOCman 1.4.x - Joomla! Document Manager
 * @version $Id: menu.tpl.php 773 2009-01-08 17:38:08Z mathias $
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
* Display the menu (required)
*
* General variables  :
*	$this->theme->path (string) : template path
* 	$this->theme->name (string) : template name
* 	$this->theme->conf (object) : template configuartion parameters
*	$this->theme->icon (string) : template icon path
*   $this->theme->png  (boolean): browser png transparency support
*
* Template variables :
*	$this->links (object) : holds the different menu links
*   $this->perms (number) : upload user permissions
*
*/

if( !$this->theme->conf->menu_home
    AND !$this->theme->conf->menu_search
    AND !$this->theme->conf->menu_upload
    AND $this->perms->upload != DM_TPL_AUTHORIZED) {
        // No buttons to show
    	return;
    }

?>
<div class="box_left_title"><div class="box_right_title">
<div class="buttonlink">
<div style=" margin-top:20px; margin-right:10px;float:right;">
<?php
if($this->theme->conf->menu_home) :
	?>
		<a href="<?php echo $this->links->home;?>">	
			<div class="Button">
				<div class="ButtonLeft"></div>
				<div class="ButtonMiddle"><p class="Text"><?php echo _DML_TPL_CAT_VIEW;?></p></div>
				<div class="ButtonRight"></div>
			</div>			
		</a>
	<?php
endif;
if($this->theme->conf->menu_search) :
	?>	
		<a href="<?php echo $this->links->search;?>">			
			<div class="Button">
				<div class="ButtonLeft"></div>
				<div class="ButtonMiddle"><p class="Text"><?php echo _DML_TPL_SEARCH_DOC;?></p></div>
				<div class="ButtonRight"></div>
			</div>		
		</a>
	<?php
endif;
	/*
	 * Check to upload permissions and show the appropriate icon/text
	 * Values for $this->perms->upload
	 *		- DM_TPL_AUTHORIZED 	: the user is authorized to upload
	 *		- DM_TPL_NOT_LOGGED_IN  : the user isn't logged in
	 *		- DM_TPL_NOT_AUTHORIZED : the user isn't authorized to upload
	*/
if($this->theme->conf->menu_upload) :
	switch($this->perms->upload) :
		case DM_TPL_AUTHORIZED :
		?>		
		<a href="<?php echo $this->links->upload;?>">			
			<div class="Button">
				<div class="ButtonLeft"></div>
				<div class="ButtonMiddle"><p class="Text"><?php echo _DML_TPL_SUBMIT;?></p></div>
				<div class="ButtonRight"></div>
			</div>		
		</a>
		<?php break;
	endswitch;
endif;
	?>
</div>
</div></div></div>
<div class="clr"></div>