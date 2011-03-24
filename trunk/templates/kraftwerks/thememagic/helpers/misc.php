<?php    

// no direct access
defined( '_JEXEC' ) or die( 'Restricted access' );

// ------------------------------------------------------------------------

/**
 * themeMagic Misc Helpers for working with misc stuff. 
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

// --------------------------------------------------------------------

/**
 * Prints out the value and exits
 *
 * @param $var
 */    
if(!function_exists('stop'))     
{
	function stop($var) 
	{
		header('Content-Type: text/plain');
		print_r($var);
		exit;
	}  
}

// --------------------------------------------------------------------

/**
 * Convert links, hash tags, @s etc in a Twitter post to links
 *
 * @param string $ret The String to 'Twitterify'
 * @return string  
 *
 */      
if(!function_exists('twitterify'))  
{
	function twitterify($ret) 
	{
	  $ret = preg_replace("#(^|[\n ])([\w]+?://[\w]+[^ \"\n\r\t< ]*)#", "\\1<a href=\"\\2\" target=\"_blank\">\\2</a>", $ret);
	  $ret = preg_replace("#(^|[\n ])((www|ftp)\.[^ \"\t\n\r< ]*)#", "\\1<a href=\"http://\\2\" target=\"_blank\">\\2</a>", $ret);
	  $ret = preg_replace("/@(\w+)/", "<a href=\"http://www.twitter.com/\\1\" target=\"_blank\">@\\1</a>", $ret);
	  $ret = preg_replace("/#(\w+)/", "<a href=\"http://search.twitter.com/search?q=\\1\" target=\"_blank\">#\\1</a>", $ret);
	  return $ret;
	} 
}

// --------------------------------------------------------------------

/**
 * Takes a Date TimeStamp and Returns The Time Ago
 *
 * @param timestamp $timestamp The Date TimeStamp
 * @return string
 *
 */    
if(!function_exists('ago'))
{
	function ago($timestamp)
	{
	   $difference = time() - $timestamp;
	   $periods = array("second", "minute", "hour", "day", "week", "month", "years", "decade");
	   $lengths = array("60","60","24","7","4.35","12","10");
	   for($j = 0; $difference >= $lengths[$j]; $j++)
	   $difference /= $lengths[$j];
	   $difference = round($difference);
	   if($difference != 1) $periods[$j].= "s";
	   $text = "$difference $periods[$j] ago";
	   return $text;
	} 
}
