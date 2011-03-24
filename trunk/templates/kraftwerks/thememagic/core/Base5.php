<?php     

// no direct access
defined( '_JEXEC' ) or die( 'Restricted access' );

// ------------------------------------------------------------------------

/**
 * BASE - For PHP 5 
 *
 * @note Potentially This framework can be made PHP 4 compatible; that depends on demand.    
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

class Base 
{ 
	private static $instance;

	public function Base()  
	{    
		self::$instance =& $this;
	}

	public static function &get_instance()
	{
		return self::$instance;
	}
} 

// ------------------------------------------------------------------------

/**
 *  Good old Singleton Return.
 *
 **/
function &get_instance()
{
	return Base::get_instance();
}
