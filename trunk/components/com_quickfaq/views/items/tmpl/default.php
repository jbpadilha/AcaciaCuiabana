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
    <h2 style="width:82%; float:left;" class="app-box-title"><?php echo $this->params->get('page_title'); ?></h2>
	<?php endif; ?>
	<div class="app-box-actions">
		<p class="buttons">
		<?php echo quickfaq_html::favouritesbutton( $this->params ); ?>
		<?php echo quickfaq_html::pdfbutton( $this->item, $this->params ); ?>
		<?php echo quickfaq_html::mailbutton( 'items', $this->params, $this->parentcat->categoryslug, $this->item->slug ); ?>
		<?php echo quickfaq_html::printbutton( $this->print_link, $this->params ); ?>
		<?php echo quickfaq_html::addbutton( $this->params ); ?>
		<?php echo quickfaq_html::editbutton( $this->item, $this->params ); ?>
		</p>
	</div>
</div>
</div>
<div class="app-box-content"><div class="app-box-info">
<h3 style="margin:0px; " class="quickfaq item<?php echo $this->item->id; ?>">
	<?php echo $this->escape($this->item->title); ?>
</h3>

<div class="item_details floattext">

	<dl class="item_info_left floattext">
		<?php if ($this->params->get('show_author')) : ?>
			<dt class="author"><?php echo JText::_( 'AUTHOR' ).':'; ?></dt>
    		<dd class="author"><?php echo $this->escape($this->item->creator); ?></dd>
    	<?php endif; ?>
    	
    	<?php if ($this->params->get('show_create_date')) : ?>
  			<dt class="created"><?php echo JText::_( 'DATE ADDED' ).':'; ?></dt>
			<dd class="created"><?php echo JHTML::date( $this->item->created ); ?></dd>
		<?php endif; ?>
		
		<?php if ($this->params->get('show_modify_date')) : ?>
			<dt class="modified"><?php echo JText::_( 'LAST REVISED' ).':'; ?></dt>
			<dd class="modified"><?php echo $this->item->modified ? JHTML::date( $this->item->modified ) : JText::_('NEVER'); ?></dd>
		<?php endif; ?>
		
		<?php if ($this->user->authorize('com_quickfaq', 'state') && $this->params->get('show_state_icon')) : ?>
			<dt class="hits"><?php echo JText::_( 'STATE' ).':'; ?></dt>
    		<dd class="hits">
    		<ul id="statetoggler" class="qf_statetoggler">
				<li class="topLevel">
					<a href="javascript:void(0);" class="opener">
					<div id="states" class="qf_states">
						<?php echo quickfaq_html::stateicon( $this->item->state, $this->params ); ?>
					</div>
					</a>
					<div class="options">
						<ul>
							<li>
								<a href="javascript:void(0);" onclick="dostate('1', '<?php echo $this->item->id; ?>')" class="closer">
									<?php echo JText::_( 'PUBLISHED' ); ?>
								</a>
							</li>
							<li>
								<a href="javascript:void(0);" onclick="dostate('0', '<?php echo $this->item->id; ?>')" class="closer">
									<?php echo JText::_( 'UNPUBLISHED' ); ?>
								</a>	
							</li>
							<li>
								<a href="javascript:void(0);" onclick="dostate('-1', '<?php echo $this->item->id; ?>')" class="closer">
									<?php echo JText::_( 'ARCHIVED' ); ?>
								</a>
							</li>
							<li>
								<a href="javascript:void(0);" onclick="dostate('-2', '<?php echo $this->item->id; ?>')" class="closer">
									<?php echo JText::_( 'PENDING' ); ?>
								</a>
							</li>
							<li>
								<a href="javascript:void(0);" onclick="dostate('-3', '<?php echo $this->item->id; ?>')" class="closer">
									<?php echo JText::_( 'OPEN QUESTION' ); ?>
								</a>	
							</li>
							<li>
								<a href="javascript:void(0);" onclick="dostate('-4', '<?php echo $this->item->id; ?>')" class="closer">
									<?php echo JText::_( 'IN PROGRESS' ); ?>
								</a>	
							</li>
						</ul>
					</div>
				</li>
			</ul>
       		</dd>
    	<?php endif; ?>
	</dl>
	
	<dl class="item_info_right floattext">
		<?php if ($this->params->get('show_hits')) : ?>
			<dt class="hits"><?php echo JText::_( 'HITS' ).':'; ?></dt>
    		<dd class="hits"><?php echo $this->item->hits; ?></dd>
    	<?php endif; ?>
    	
    	<?php if ($this->params->get('show_vote')) : ?>
  			<dt class="votes"><?php echo JText::_( 'RATING' ).':'; ?></dt>
			<dd class="votes">
				<?php echo quickfaq_html::ratingbar( $this->item ); ?>
			</dd>
		
			<dt class="vote"><?php echo JText::_( 'VOTE THIS' ).':'; ?></dt>
			<dd class="vote">
				<?php echo quickfaq_html::voteicons( $this->item, $this->params ); ?>
			</dd>
		<?php endif; ?>
		<?php if ($this->params->get('show_favourites')) : ?>
			<dt class="favourites"><?php echo JText::_( 'FAVOURED' ).':'; ?></dt>
			<dd class="favourites">
				<?php echo $this->favourites.' '.quickfaq_html::favoure( $this->item, $this->params, $this->favoured ); ?>
			</dd>
		<?php endif; ?>
	</dl>

</div></div>
<div class="app-box-shadow-border">
<h3><?php echo JText::_('ANSWER'); ?></h3>
</div>
<div class="app-box-info">
<div class="description item_text">
	<?php echo $this->item->text; ?>
</div>
</div>

<!--files-->
<?php
$n = count($this->files);
$i = 0;
if ($n != 0) :
?>
<div class="app-box-shadow-border">
<h3><?php echo JText::_('ATTACHED FILES'); ?></h3>
</div>
<div class="app-box-info">
<div class="filelist">
	<?php foreach ($this->files as $file) : ?>
		<?php echo JHTML::image($file->icon, '').' '; ?><strong><a href="<?php echo JRoute::_( 'index.php?fileid='. $file->fileid .'&task=download'); ?>"><?php echo $file->altname ? $this->escape($file->altname) : $this->escape($file->filename); ?></a></strong>
		<?php 
		$i++;
		if ($i != $n) :
			echo ',';
		endif;
	endforeach; ?>
</div></div>
<?php endif; ?>

<!--categories-->
<?php if ($this->params->get('show_categories')) : ?>
<div class="app-box-shadow-border">
<h3><?php echo JText::_('CATEGORY'); ?></h3>
</div>
<div class="app-box-info">
<?php
$n = count($this->categories);
$i = 0;
?>
<div class="categorylist">
	<?php foreach ($this->categories as $category) : ?>
		<strong><a href="<?php echo JRoute::_( 'index.php?view=category&cid='. $category->slug ); ?>"><?php echo $this->escape($category->title); ?></a></strong>
		<?php 
		$i++;
		if ($i != $n) :
			echo ',';
		endif;
	endforeach; ?>
</div></div>
<?php endif; ?>

<!--tags-->
<?php
if ($this->params->get('show_tags')) :
$n = count($this->tags);
$i = 0;
if ($n != 0) :
?>
<div class="app-box-shadow-border">
<h3><?php echo JText::_('TAGS FOR THIS ITEM'); ?></h3>
</div>
<div class="app-box-info">
<div class="taglist">
	<?php foreach ($this->tags as $tag) : ?>
		<strong><a href="<?php echo JRoute::_( 'index.php?view=tags&id='. $tag->slug ); ?>"><?php echo $this->escape($tag->name); ?></a></strong>
		<?php 
		$i++;
		if ($i != $n) :
			echo ',';
		endif;
	endforeach; ?>
</div></div>
<?php endif; ?>
<?php endif; ?>
<div style="height:10px;" class="clr"></div></div>
<div class="app-box-footer no-border"><div class="app-box-footer no-border"></div></div><div class="clr"></div>

<!--comments-->
<?php if ($this->params->get('show_jcomments') || $this->params->get('show_jomcomments')) : ?>
<div class="qf_comments">
<?php
	if ($this->params->get('show_jcomments')) :
		if (file_exists(JPATH_SITE.DS.'components'.DS.'com_jcomments'.DS.'jcomments.php')) :
			require_once(JPATH_SITE.DS.'components'.DS.'com_jcomments'.DS.'jcomments.php');
			echo JComments::showComments($this->item->id, 'com_quickfaq', $this->escape($this->item->title));
		endif;
	endif;
	
	if ($this->params->get('show_jomcomments')) :
		if (file_exists(JPATH_SITE.DS.'plugins'.DS.'content'.DS.'jom_comment_bot.php')) :
    		require_once(JPATH_SITE.DS.'plugins'.DS.'content'.DS.'jom_comment_bot.php');
    		echo jomcomment($this->item->id, 'com_quickfaq');
  		endif;
  	endif;
?>
</div>
<?php endif; ?>

</div>