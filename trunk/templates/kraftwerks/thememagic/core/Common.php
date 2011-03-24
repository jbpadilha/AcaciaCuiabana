<?php     

// no direct access
defined( '_JEXEC' ) or die( 'Restricted access' );
   
// ------------------------------------------------------------------------

/**
 * Common Functions needed across framework
 *
 * @note   
 *    
 * @package		themeMagic
 * @subpackage  core
 * @version		1.0 Beta. 
 * @author		Ken Erickson AKA Bookworm http://www.bookwormproductions.net
 * @copyright 	Copyright 2009 - 2010 DesignBreakDown
 * @license		http://www.gnu.org/licenses/gpl-2.0.html GNU/GPLv2       
 * please visit the themeMagic site http://www.theme-magic.com  for support. 
 * Do not e-mail (or god forbid IM or call) me directly.
 *
 */

// ------------------------------------------------------------------------

/**       
 * This acts as a Class Registry providing us the ability to create a Super Object and then
 * do things like $magic->browser->getBrowser() etc. For Design Patterns enthusiasts this is called 
 * a Singleton Class Registry.  
 * 
 * @param string $class The Class To be Loaded
 * @param bool  $instantiate Allows you to load but not instantiate a class.
 * @param string $type Specify a type of file to class to load. Allows loading of Config classes.  
 * @param mixed $classArg Arguments to pass to a class on instantiation.  
 *
 * @return class   
 */

function &load_class($class, $instantiate = true, $type = 'core', $classArg = null, $fullpath = null)
{
	static $objects = array();

	// Check To see if the class is already instantiated. If it is don't instantiate again. 
	if (isset($objects[$class]))
	{
		return $objects[$class];  
	}  
	
	// Set an extension type
    $type == 'config' ? $extType = null: $extType = '.class';    

    if($fullpath == null)   
	{
		if (file_exists(FRAMEWORKPATH . '/' . $type . '/' . $class .  $extType . '.php'))
		{
			require_once(FRAMEWORKPATH . '/' . $type . '/' . $class . $extType . '.php');
		} elseif(file_exists(BASEPATH . '/template_files/' . $type . '/' . $class .  $extType . '.php'))  {
			require_once(BASEPATH . '/template_files/' . $type . '/' . $class .  $extType . '.php');     
		}
		else {
			exit('No class of that name: ' . $class);
		}  
	}
	else
	{
		if (file_exists($fullpath . $class .'.php'))
		{
			require_once($fullpath . $class . '.php');
		}
		else {
			exit('No class of that name: ' . $class);
		}
	}

	$name = $class;     
	
	// This allows us to pass in some stuff form other classes on the init of the class.
	if (!$classArg == null) 
	{   
		$objects[$class] =& instantiate_class(new $name($classArg));
		   
	} else {
	   $objects[$class] =& instantiate_class(new $name());
	}

	return $objects[$class];
}

// ------------------------------------------------------------------------

/**
 * Instantiate A Class
 *
 * Returns a new class object by reference, used by load_class()
 *
 * Usage: $obj =& instantiate_class(new Foo());
 * 
 * @param	object $class_object The object to instantiate
 * @return	object
 */
function &instantiate_class(&$class_object)
{
	return $class_object;
}   