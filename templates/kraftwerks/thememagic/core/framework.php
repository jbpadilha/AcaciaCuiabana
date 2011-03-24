<?php       

// no direct access
defined( '_JEXEC' ) or die( 'Restricted access' );

// ------------------------------------------------------------------------

/**
 * Framework Initialization File.
 *
 * @note All The core stuff happens here so bad idea to make modifications anywhere in the core folder.
 * Monsters, bugs. headaches and swear words abound. Tread softly and carry a big debugger.  
 *    
 * @package		themeMagic
 * @subpackage  core
 * @version		1.0 Beta. 
 * @author		Ken Erickson AKA Bookworm http://www.bookwormproductions.net
 * @copyright 	Copyright 2009 - 2010 DesignBreakDown
 * @license		http://www.gnu.org/licenses/gpl-2.0.html GNU/GPLv2       
 * please visit the themeMagic site http://www.theme-magic.com  for support. 
 * Do not e-mail (or god forbid IM or call) me directly.
 */

// ------------------------------------------------------------------------   
 
// Set Production Mode
define('IN_DEVELOPMENT', FALSE);

// Make sure the we are running PHP 5.2 or newer
version_compare(PHP_VERSION, '5.2', '<') and exit('ThemeMagic requires PHP 5.2 or newer.');  

// Set PHP Error Reporting Level 
error_reporting(E_WARNING | E_PARSE);
     
// Globals and Super Objs  
global $mainframe;
$templateName = $mainframe->getTemplate();    
$templateOBJ =& JFactory::getDocument();  

// File Sytem Path Definitions.
define('BASEPATH', JPATH_BASE . DS . 'templates' .  DS . $templateName);  
define('FRAMEWORKPATH', JPATH_BASE . DS . 'templates' .  DS . $templateName. DS . 'thememagic');      
define('MEDIAPATH', JPATH_BASE . DS . 'templates' .  DS . $templateName . DS . 'media');      
define('CSSCACHEPATH', MEDIAPATH . '/css/cache/');

// URl Paths. Used for media files, scripts, css etc.
define('TEMPLATEURLPATH',  $this->baseurl . '/templates/' . $templateName);  
define('FRAMEWORKURLPATH', $this->baseurl . '/templates/' . $templateName. '/thememagic'); 
define('MEDIAURLPATH', $this->baseurl . '/templates/' . $templateName . '/media');    
define('JSITEURL', $this->baseurl);    


// Require needed files and then load up themeMagic.
if(!defined('MIN_MAGIC'))  require_once(FRAMEWORKPATH . '/libraries/magicModHelper.class.php'); 
require_once(FRAMEWORKPATH . '/core/Common.php');
load_class('Loader', false);   
require_once(FRAMEWORKPATH . '/core/Base5.php');    
$magic =& load_class("themeMagic", true, 'core', $templateOBJ);             
  



                                   

