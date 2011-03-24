<?php
/**
 * @version 1.0 $Id: default.php 195 2009-01-30 06:33:12Z schlu $
 * @package Joomla
 * @subpackage QuickFAQ
 * @copyright (C) 2008 - 2009 Christoph Lukes
 * @license GNU/GPL, see LICENCE.php
 * QuickFAQ is free software; you can redistribute it and/or
 * modify it under the terms of the GNU General Public License 2
 * as published by the Free Software Foundation.

 * QuickFAQ is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.

 * You should have received a copy of the GNU General Public License
 * along with QuickFAQ; if not, write to the Free Software
 * Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston, MA  02110-1301, USA.
 */

defined( '_JEXEC' ) or die( 'Restricted access' );
?>
<div id="quickfaq" class="quickfaq">

<div class="app-box-header">
<div class="app-box-header">
	<?php if ($this->params->def( 'show_page_title', 1 )) : ?>
    <h2 style="width:85%; float:left;" class="app-box-title"><?php echo $this->params->get('page_title'); ?></h2>
	<?php endif; ?>
	<div class="app-box-actions">
		<p class="buttons">
		<?php echo quickfaq_html::favouritesbutton( $this->params ); ?>
		<?php echo quickfaq_html::addbutton( $this->params ); ?>
		</p>
	</div>
</div>
</div>
<div class="app-box-content">
<?php if ($this->params->get('showintrotext')) : ?>	
	<div class="app-box-info">
	<div class="description no_space floattext">
		<?php echo $this->params->get('introtext'); ?>
	</div>
	</div>		
<?php endif; ?>

<?php echo $this->loadTemplate('categories'); ?>
<div style="height:10px;" class="clr"></div></div>
	<div class="app-box-footer no-border"><div class="app-box-footer no-border"></div></div><div class="clr"></div>
<!--pagination-->
<p class="pageslinks">
	<?php echo $this->pageNav->getPagesLinks(); ?>
</p>

<p class="pagescounter">
	<?php echo $this->pageNav->getPagesCounter(); ?>
</p>

</div>