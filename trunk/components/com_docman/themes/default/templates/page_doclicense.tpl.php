<?php
/**
 * DOCman 1.4.x - Joomla! Document Manager
 * @version $Id: page_doclicense.tpl.php 773 2009-01-08 17:38:08Z mathias $
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
* Display the move document form (required)
*
* This template is called when u user preform a move operation on a document.
*
* General variables  :
*	$this->theme->path (string) : template path
*	$this->theme->name (string) : template name
*	$this->theme->conf (object) : template configuartion parameters
*	$this->theme->icon (string) : template icon path
*   $this->theme->png  (boolean): browser png transparency support
*
* Preformatted variables :
*	$this->html->doclicense (string)(hardcoded, can change in future versions)
*   $this->html->license    (string)(the actual license text)
*/
?>

<?php echo $this->plugin('stylesheet', $this->theme->path."css/theme.css") ?>
<?php $theme = defined('_DM_J15') ? "css/theme15.css" : "css/theme10.css";
      echo $this->plugin('stylesheet', $this->theme->path . $theme) ?>

<div class="app-box-header"><div class="app-box-header">
		<h2 class="app-box-title"><?php echo _DML_TPL_LICENSE_DOC;?></h2>
</div></div>

<div class="app-box-content"><div class="app-box-info">
<div class="dm_license_body">
	<?php echo $this->license; ?>
</div>

<div class="dm_license_form">
<?php echo $this->html->doclicense ?>
</div>

<div class="dm_taskbar"><div class="buttonlink">
<a href="javascript: history.go(-1);">
<div class="Button">
	<div class="ButtonLeft"></div>
	<div class="ButtonMiddle"><p class="Text"><?php echo _DML_TPL_BACK ?></p></div>
	<div class="ButtonRight"></div>
</div>
</a>
</div></div>
</div><div class="clr"></div></div><div class="app-box-footer no-border"><div class="app-box-footer no-border"> </div> </div>  


