<?php 

// no direct access
defined( '_JEXEC' ) or die( 'Restricted access' );

// ------------------------------------------------------------------------

/**
 * Some String Helper Functions.
 *
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
 * Takes a string and returns the number of words in it.
 * 
 * @param string $str String To Count Words on
 * @return int   
 *
 **/             
if(!function_exists('wordCount'))
{
	function wordCount($str)
	{
		$words = 0;
		$str = eregi_replace(" +", " ", $str);
		$array = explode(" ", $str);       

		for($i=0;$i < count($array);$i++)
		{
			if (eregi("[0-9A-Za-zÀ-ÖØ-öø-ÿ]", $array[$i]))
			$words++;
		}     

		return $words; 
	}   
}

// ------------------------------------------------------------------------

/**
 * Alternator
 *
 * Alternates a string a la even odd
 *
 * @access	public
 * @param	string takes anything
 * @return	string  
 *
 */	
if (!function_exists('alternator'))
{
	function alternator()
	{
		static $i;	

		if (func_num_args() == 0)
		{
			$i = 0;
			return '';
		}
		$args = func_get_args();
		return $args[($i++ % count($args))];
	}
}

// ------------------------------------------------------------------------

/**
 * Repeater function
 *
 * @access	public
 * @param	string
 * @param	integer	number of repeats
 * @return	string 
 *
 */	
if (!function_exists('repeater'))
{
	function repeater($data, $num = 1)
	{
		return (($num > 0) ? str_repeat($data, $num) : '');
	} 
}   

// ------------------------------------------------------------------------

/**
 * Reduce Multiples
 *
 * Reduces multiple instances of a particular character.  Example:
 *
 * Fred, Bill,, Joe, Jimmy
 *
 * becomes:
 *
 * Fred, Bill, Joe, Jimmy
 *
 * @access	public
 * @param	string
 * @param	string	the character you wish to reduce
 * @param	bool	true/false - whether to trim the character from the beginning/end
 * @return	string  
 *
 */	
if (!function_exists('reduceMultiples'))
{
	function reduceMultiples($str, $character = ',', $trim = false)
	{
		$str = preg_replace('#'.preg_quote($character, '#').'{2,}#', $character, $str);

		if ($trim === true)
		{
			$str = trim($str, $character);
		}

		return $str;
	}
}    

// ------------------------------------------------------------------------

/**
 * Finds the line a string is on  
 *
 */    
if(!function_exists('strline'))
{
	function strline($string, $base)
	{
		$base = explode("\n",$base);

		for($line = 0; $line < count($base); $line++) 
		{
			if(strpos($base[$line], $string) >= 0)
			{
				return $line;
			}
		}
	}   
} 
 
// ------------------------------------------------------------------------

/**
 * Quick regex matching
 *
 * @param $regex
 * @param $subject
 * @param $i
 * @return array     
 *
 */   
if(!function_exists('match'))
{
	function match($regex, $subject, $i = "")
	{
		if(preg_match_all($regex, $subject, $match))
		{
			return ($i == "") ? $match : $match[$i];
		}
		else
		{
			return array();
		}
	} 
}   

// ------------------------------------------------------------------------

/** 
 * Removes all quotes from a string
 *
 * @param $str string
 *
 */   
if(!function_exists('removeAllQuotes'))
{
	function removeAllQuotes($str)
	{
		return str_replace(array('"', "'"), '', $str);
	} 
}

// ------------------------------------------------------------------------

/** 
 * Removes quotes surrounding a string
 *
 * @param $str string     
 *
 */
if(!function_exists('unquote'))
{
	function unquote($str)
	{
		return preg_replace('#^("|\')|("|\')$#', '', $str);
	}   
}

// ------------------------------------------------------------------------

/** 
 * Surrounds a string with a quote
 *
 * @param $str string   
 *
 */  
if(!function_exists('quote'))  
{
	function quote($str)
	{
		return '"' . $str . '"';
	}  
}

// ------------------------------------------------------------------------

/** 
 * Makes sure the string ends with a /
 *
 * @param $str string 
 *
 */ 
if(!function_exists('addEndSlash'))  
{
	function addEndSlash($str)
	{
	    return rtrim($str, '/') . '/';
	} 
}

// ------------------------------------------------------------------------

/** 
 * Makes sure the string starts with a /
 *
 * @param $str string  
 *
 */    
if(!function_exists('addStartSlash'))
{
	function addStartSlash($str)
	{
	    return ltrim($str, '/') . '/';
	}   
} 

// ------------------------------------------------------------------------

/** 
 * Makes sure the string doesn't end with a /
 *
 * @param $str string   
 *
 */
if(!function_exists('trimSlashes'))
{
	function trimSlashes($str)
	{
	    return trim($str, '/');
	}   
}
  
// ------------------------------------------------------------------------

/** 
 * Replaces double slashes in urls with singles
 *
 * @param $str string
 *
 */ 
if(!function_exists('reduceDoubleSlashes'))
{
	function reduceDoubleSlashes($str)
	{
		return preg_replace("#([^:])//+#", "\\1/", $str);
	}   
}

// ------------------------------------------------------------------------

/**
 * Takes a string, a separator and a max number and generates
 * a long string from them
 *
 * @param $string
 * @return string  
 *
 */  
if(!function_exists('enumerate'))
{
	function enumerate($string, $min, $max, $sep = ",")
	{
		$ret = array();

		for ($i = $min; $i <= $max; $i++)
		{
			$ret[] = $string . $i;
		}

		return implode($sep, $ret);
	} 
}


