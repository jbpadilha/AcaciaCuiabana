<?php
   
// no direct access
defined( '_JEXEC' ) or die( 'Restricted access' );
    
// ------------------------------------------------------------------------

/**
 * Array Helpers. 
 *
 * @package		themeMagic
 * @subpackage	Helpers
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
 * Clean print_r interface
 * 
 * @param array $array Array of data to pretty print.
 * @return array 
 *
 **/   
if(!function_exists('cprint_r'))
{
	function cprint_r($array) 
	{
		$prettyPrint = '<pre>' . print_r($array) . '</pre>';
		return $prettyPrint;
	}   
}

// ------------------------------------------------------------------------  
  
/**
 * Cleans An Array of junk 
 * 
 * 
 * @param array $array Array to clean 
 * @param bool $reKey re-generated numeric keys 
 *
 * @return void
 **/  
if(!function_exists('cleanArray'))
{
	function cleanArray($array, $reKey = false, $typecheck = false, $type = null)
	{  	 
		$type = 'is_' . $type;     
		
		foreach($array as $key => $arrayItem)  
		{
			if($arrayItem == null)
			{
				unset($array[$key]);
			} 
			
			if($typecheck == true) 
			{   
				$checkresult = call_user_func($type, $arrayItem);
				if($checkresult) 
				{
				  	unset($array[$key]); 
				}
			}
		}  
			   
	    if($reKey == true) $array = array_values($array);
		return $array; 
	}
}

// ------------------------------------------------------------------------  

/**
 * Returns the value of a key, using dot notion e.g bob.name.bob
 *
 * @param   array   array to search
 * @param   string  dot-noted string: foo.bar.baz
 * @return  string  if the key is found
 * @return  void    if the key is not found  
 */
if(!function_exists('keyString'))
{
	function keyString($array, $keys)
	{
		if (empty($array))
			return NULL;

		// Prepare for loop
		$keys = explode('.', $keys);

		do 
		{
			// Get the next key
			$key = array_shift($keys);

			if (isset($array[$key]))
			{
				if (is_array($array[$key]) AND ! empty($keys))
				{
					// Dig down to prepare the next loop
					$array = $array[$key];
				}
				else
				{
					// Requested key was found
					return $array[$key];
				}
			}
			else
			{
				// Requested key is not set
				break;
			}
		}
		while ( ! empty($keys));

		return NULL;
	}  
} 
  
// ------------------------------------------------------------------------  

/**
 * Sets values in an array by using a 'dot-noted' string.
 *
 * @param   array   array to set keys in (reference)
 * @param   string  dot-noted string: foo.bar.baz
 * @return  mixed   fill value for the key
 * @return  void
 */ 
if(!function_exists('keyStringSet')) 
{
	function keyStringSet( & $array, $keys, $fill = NULL)
	{
		if (is_object($array) AND ($array instanceof ArrayObject))
		{
			// Copy the array
			$array_copy = $array->getArrayCopy();

			// Is an object
			$array_object = TRUE;
		}
		else
		{
			if ( ! is_array($array))
			{
				// Must always be an array
				$array = (array) $array;
			}

			// Copy is a reference to the array
			$array_copy =& $array;
		}

		if (empty($keys))
			return $array;

		// Create keys
		$keys = explode('.', $keys);

		// Create reference to the array
		$row =& $array_copy;

		for ($i = 0, $end = count($keys) - 1; $i <= $end; $i++)
		{
			// Get the current key
			$key = $keys[$i];

			if ( ! isset($row[$key]))
			{
				if (isset($keys[$i + 1]))
				{
					// Make the value an array
					$row[$key] = array();
				}
				else
				{
					// Add the fill key
					$row[$key] = $fill;
				}
			}
			elseif (isset($keys[$i + 1]))
			{
				// Make the value an array
				$row[$key] = (array) $row[$key];
			}

			// Go down a level, creating a new row reference
			$row =& $row[$key];
		}

		if (isset($array_object))
		{
			// Swap the array back in
			$array->exchangeArray($array_copy);
		}
	} 
}

// ------------------------------------------------------------------------  

/**
 * Sorts array elements by length
 *
 * @param $param
 * @return return type    
 */  
if(!function_exists('sortByLength'))
{
	function sortByLength($a,$b)
	{
		if($a == $b) return 0;
		return (strlen($a) > strlen($b) ? -1 : 1);
	}  
}    
