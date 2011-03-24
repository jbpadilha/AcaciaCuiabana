<?php 

// no direct access
defined( '_JEXEC' ) or die( 'Restricted access' ); 

// ------------------------------------------------------------------------

/**
 * This Interfaces with themeMagic admin panel and gets the data to save.
 * In other words you need this file if your using the admin features in themeMagic.
 * 
 *    
 * @package		themeMagic
 * @subpackage  admin
 * @version		1.0 Beta. 
 * @author		Ken Erickson AKA Bookworm http://www.bookwormproductions.net
 * @copyright 	Copyright 2009 - 2010 DesignBreakDown
 * @license		http://www.gnu.org/licenses/gpl-2.0.html GNU/GPLv2       
 * please visit the themeMagic site http://www.theme-magic.com  for support. 
 * Do not e-mail (or god forbid IM or call) me directly.
 */

require('thememagic/core/framework.php');  

if(!isAdmin()) die('Bad Boy! Your not an admin are you?');       

$data = JRequest::getVar('data');
$data = json_decode($data);    

echo $magic->admin->saveCSSParams($data);