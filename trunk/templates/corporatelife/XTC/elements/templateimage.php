<?php
/**
* @version		$Id: imagelist.php 14401 2010-01-26 14:10:00Z louis $
* @package		Joomla.Framework
* @subpackage	Parameter
* @copyright	Copyright (C) 2005 - 2010 Open Source Matters. All rights reserved.
* @license		GNU/GPL, see LICENSE.php
* Joomla! is free software. This version may have been modified pursuant
* to the GNU General Public License, and as distributed it includes or
* is derivative of works licensed under the GNU General Public License or
* other free or open source software licenses.
* See COPYRIGHT.php for copyright notices and details.
*/

// Check to ensure this file is within the rest of the framework
defined('JPATH_BASE') or die();

/**
 * Renders a imagelist element
 *
 * @package 	Joomla.Framework
 * @subpackage		Parameter
 * @since		1.5
 */

class JElementTemplateimage extends JElement
{
	/**
	* Element name
	*
	* @access	protected
	* @var		string
	*/
	var	$_name = 'ImageList';

	function fetchElement($name, $value, &$node, $control_name)	{
		$filter = '\.png$|\.gif$|\.jpg$|\.bmp$|\.ico$';
		$node->addAttribute('filter', $filter);

		$template = basename(dirname(dirname(dirname(__FILE__))));

		$directory = $node->attributes('directory');
		$directory = $directory ? '/images/'.$directory : '/images';
		$path = '/templates/'.$template.$directory;
		
		$node->addAttribute('hide_default',1);
		$node->removeAttribute('directory');
		$node->addAttribute('directory',$path);

		$parameter =& $this->_parent->loadElement('filelist');

		$html = '<div class="hasTip" title="'.htmlentities('Directory: '.$directory).'">';
		$html .= $parameter->fetchElement($name, $value, $node, $control_name);
		$html .= '</div>';

		return $html;
	}
}
