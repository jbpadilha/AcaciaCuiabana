<?php
/*
	JoomlaXTC Weblinks Plus Pro
	
	Version 1.1.1
	
	Copyright (C) 2010  Monev Software LLC.	All Rights Reserved.
	
	Based on work done by Open Source Matters for Joomla.
	
  Joomla! is free software. This version may have been modified pursuant
  to the GNU General Public License, and as distributed it includes or
  is derivative of works licensed under the GNU General Public License or
  other free or open source software licenses.

	This program is free software; you can redistribute it and/or modify
	it under the terms of the GNU General Public License as published by
	the Free Software Foundation; either version 2 of the License, or
	(at your option) any later version.
	
	This program is distributed in the hope that it will be useful,
	but WITHOUT ANY WARRANTY; without even the implied warranty of
	MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
	GNU General Public License for more details.
	
	You should have received a copy of the GNU General Public License
	along with this program; if not, write to the Free Software
	Foundation, Inc., 59 Temple Place, Suite 330, Boston, MA  02111-1307  USA
	
	THIS LICENSE MIGHT NOT APPLY TO OTHER FILES CONTAINED IN THE SAME PACKAGE.
	
	See COPYRIGHT.php for more information.
	See LICENSE.php for more information.
	
	Monev Software LLC
	www.joomlaxtc.com
*/

defined('_JEXEC') or die( 'Restricted access' );
?>

<form action="<?php echo JFilterOutput::ampReplace($this->action); ?>" method="post" name="adminForm">
<table width="100%" border="0" cellspacing="0" cellpadding="0">
<?php
$row = 1;
$col = 1;
foreach ($this->items as $item) {
//	if ($row > $this->rows) { continue; }
	if ($col==1) {
		?><tr><?php
	}
	?><td width="<?php echo round(100/$this->columns) ?>" valign="top" align="center"><?php
	if ($this->show_thumbnail) {
		?>
		<div class="wl_image" style="text-align:center">
			<?php echo $item->thumbnail; ?><br/>
		</div>
		<?php
	}
	?>
	<div class="wl_rest">
	<div class="wl_links"><?php echo $item->link; ?></div><br/><?php
	if ($this->show_link_hits) {
		?>
			<div class="wl_hits"><?php echo JText::_('Hits:').' '.$item->hits; ?></div><br/>
		<?php
	}
	if ($this->show_link_description) {
		?>
			<div class="wl_description"><?php echo $item->description; ?></div><br/>
		<?php
	}
	if ($item->article_id) {
		?>
			<a class="wl_readme" href="<?php echo JRoute::_(ContentHelperRoute::getArticleRoute($item->article_id)); ?>" alt="Read More"><?php echo JText::_('Read More'); ?></a><br/>
		<?php
	}

	?>
    </div>
    <br/></td><?php
	if ($col++ >= $this->columns) {
		?></tr><?php
		$col=1;
		$row++;
	}
}
if ($col > 1) {
	?></tr><?php
}
?>

<tr>
	<td align="center" colspan="4" class="sectiontablefooter<?php echo $this->escape($this->params->get('pageclass_sfx')); ?>">
	<?php echo $this->pagination->getPagesLinks(); ?>
	</td>
</tr>
<tr>
	<td colspan="4" align="right" class="pagecounter">
		<?php echo $this->pagination->getPagesCounter(); ?>
	</td>
</tr>
</table>
<input type="hidden" name="filter_order" value="<?php echo $this->lists['order']; ?>" />
<input type="hidden" name="filter_order_Dir" value="" />
<input type="hidden" name="viewcache" value="0" />
</form>
