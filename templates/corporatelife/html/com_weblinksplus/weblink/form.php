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
function submitbutton(pressbutton)
{
	var form = document.adminForm;
	if (pressbutton == 'cancel') {
		submitform( pressbutton );
		return;
	}

	// do field validation
	if (document.getElementById('jformtitle').value == ""){
		alert( "<?php echo JText::_( 'Weblink item must have a title', true ); ?>" );
	} else if (document.getElementById('jformcatid').value < 1) {
		alert( "<?php echo JText::_( 'You must select a category.', true ); ?>" );
	} else if (document.getElementById('jformurl').value == ""){
		alert( "<?php echo JText::_( 'You must have a url.', true ); ?>" );
	} else {
		submitform( pressbutton );
	}
}
</script>

<form action="<?php echo $this->action ?>" method="post" name="adminForm" id="adminForm" enctype="multipart/form-data">
<?php if ( $this->params->def( 'show_page_title', 1 ) ) : ?>
	<div class="componentheading<?php echo $this->escape($this->params->get('pageclass_sfx')); ?>">
		<?php echo $this->escape($this->params->get('page_title')); ?>
	</div>
<?php endif; ?>
<table cellpadding="4" cellspacing="1" border="0" width="100%">
<tr>
	<td width="10%">
		<label for="jformtitle">
			<?php echo JText::_( 'Name' ); ?>:
		</label>
	</td>
	<td width="80%">
		<input class="inputbox" type="text" id="jformtitle" name="jform[title]" size="50" maxlength="250" value="<?php echo $this->escape($this->weblink->title);?>" />
	</td>
</tr>
<tr>
	<td valign="top">
		<label for="jformcatid">
			<?php echo JText::_( 'Category' ); ?>:
		</label>
	</td>
	<td>
		<?php echo $this->lists['catid']; ?>
	</td>
</tr>
<tr>
	<td valign="top">
		<label for="jformurl">
			<?php echo JText::_( 'URL' ); ?>:
		</label>
	</td>
	<td>
		<input class="inputbox" type="text" id="jformurl" name="jform[url]" value="<?php echo $this->escape($this->weblink->url); ?>" size="50" maxlength="250" />
	</td>
</tr>
<tr>
	<td valign="top">
		<label for="jformthumbnail">
			<?php echo JText::_( 'Image' ); ?>:
		</label>
	</td>
	<td>
		<input class="inputbox" type="file" id="jformthumbnail" name="jformthumbnail" />
	</td>
</tr>
<tr>
	<td valign="top">
		<label for="jformpublished">
			<?php echo JText::_( 'Published' ); ?>:
		</label>
	</td>
	<td>
			<?php echo $this->lists['published']; ?>
	</td>
</tr>
<tr>
	<td valign="top">
		<label for="jformdescription">
			<?php echo JText::_( 'Description' ); ?>:
		</label>
	</td>
	<td>
		<textarea class="inputbox" cols="30" rows="6" id="jformdescription" name="jform[description]" style="width:300px"><?php echo $this->escape( $this->weblink->description);?></textarea>
	</td>
</tr>
<tr>
	<td class="key">
		<label for="jformordering">
			<?php echo JText::_( 'Ordering' ); ?>:
		</label>
	</td>
	<td>
		<?php echo $this->lists['ordering']; ?>
	</td>
</tr>
</table>

<div>
	<button type="button" onclick="submitbutton('save')">
		<?php echo JText::_('Save') ?>
	</button>
	<button type="button" onclick="submitbutton('cancel')">
		<?php echo JText::_('Cancel') ?>
	</button>
</div>

	<input type="hidden" name="jform[id]" value="<?php echo $this->weblink->id; ?>" />
	<input type="hidden" name="jform[ordering]" value="<?php echo $this->weblink->ordering; ?>" />
	<input type="hidden" name="jform[approved]" value="<?php echo $this->weblink->approved; ?>" />
	<input type="hidden" name="option" value="com_weblinksplus" />
	<input type="hidden" name="controller" value="weblink" />
	<input type="hidden" name="task" value="" />
	<?php echo JHTML::_( 'form.token' ); ?>
</form>
