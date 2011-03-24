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
<script language="javascript" type="text/javascript">
	function tableOrdering( order, dir, task ) {
	var form = document.adminForm;

	form.filter_order.value 	= order;
	form.filter_order_Dir.value	= dir;
	document.adminForm.submit( task );
}
</script>

<form action="<?php echo JFilterOutput::ampReplace($this->action); ?>" method="post" name="adminForm">
<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr>
	<td align="right" colspan="4">
	<?php
		echo JText::_('Display Num') .'&nbsp;';
		echo $this->pagination->getLimitBox();
	?>
	</td>
</tr>
<?php if ( $this->params->def( 'show_headings', 1 ) ) : ?>
<tr>
	<td width="10" style="text-align:right;" class="sectiontableheader<?php echo $this->escape($this->params->get('pageclass_sfx')); ?>">
		<?php echo JText::_('Num'); ?>
	</td>
	<td width="90%" height="20" class="sectiontableheader<?php echo $this->escape($this->params->get( 'pageclass_sfx' )); ?>">
		<?php echo JHTML::_('grid.sort',  'Web Link', 'title', $this->lists['order_Dir'], $this->lists['order'] ); ?>
	</td>
	<?php if ( $this->params->get( 'show_link_hits' ) ) : ?>

	<td width="30" height="20" class="sectiontableheader<?php echo $this->escape($this->params->get( 'pageclass_sfx' )); ?>" style="text-align:center;" nowrap="nowrap">
		<?php echo JHTML::_('grid.sort',  'Hits', 'hits', $this->lists['order_Dir'], $this->lists['order'] ); ?>
	</td>
	<?php endif; ?>
</tr>
<?php endif; ?>
<?php foreach ($this->items as $item) : ?>
<tr class="sectiontableentry<?php echo $item->odd + 1; ?>">
	<td align="right">
		<?php echo $this->pagination->getRowOffset( $item->count ); ?>
	</td>
	<td height="20">
		<?php	if ( $this->show_thumbnail ) { ?>
		<div style="float:left;margin-right:1em">
			<?php	echo ($item->thumbnail ? $item->thumbnail : $item->image); ?>
		</div>
		<?php echo $item->link; ?>
		<?php if ( $this->params->get( 'show_link_description' ) ) { ?>
			<br />
			<span class="description"><?php echo nl2br($this->escape($item->description)); ?></span>
		<?php }
					}
					else {
						if ( $item->image ) { ?>
				&nbsp;&nbsp;<?php echo $item->image;?>&nbsp;&nbsp;
			<?php } ?>
			<?php echo $item->link; ?>
			<?php if ( $this->params->get( 'show_link_description' ) ) { ?>
			<br /><span class="description"><?php echo nl2br($this->escape($item->description)); ?></span>
			<?php }
					}?>
	</td>


	<?php if ( $this->params->get( 'show_link_hits' ) ) : ?>
	<td align="center">
		<?php echo $item->hits; ?>
	</td>
	<?php endif; ?>
</tr>
<?php endforeach; ?>
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
