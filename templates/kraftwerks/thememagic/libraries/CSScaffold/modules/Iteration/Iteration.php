<?php


/**
 * Iterator
 *
 **/
class Iteration extends CSScaffold_Plugins
{
	
	/**
	 * This function occurs before everything else
	 *
	 * @param $css
	 */
	function parse()
	{		
		# Find all the @server imports
		self::parseFors(CSS::$css);
	}
	
	/**
	 * Parses @fors within the css
	 *
	 * @param $string
	 * @return string
	 */
	function parseFors($string)
	{
		if($found = self::findFors($string))
		{			
			foreach($found[0] as $key => $value)
			{				
				$s = "";
				
				$from = $found[2][$key];
				$to = $found[3][$key];
				$var = $found[1][$key];
				
				for ($i = $from; $i <= $to; $i++)
				{
					$s .= str_replace("!{$var}", $i, $found[5][$key]);	
				}
				
				CSS::replace($found[0][$key], $s);				
			}
		}
	}
	
	/**
	 * Finds for statements in a string
	 *
	 * @param $string
	 * @return array
	 */
	function findFors($string = "")
	{
		$recursive = 4; 
		
		$regex = 
			"/
				
				# Find the @if's
				(?:@(?:for))\s\!(.*?)\sfrom\s(\d+)\sto\s(\d+)\s*
				
				# Return all inner selectors and properties
				(
					(?:[0-9a-zA-Z\_\-\*&]*?)\s*
					\{	
						((?:[^{}]+|(?{$recursive}))*)
					\}
				)
				
			/xs";
		
		if(preg_match_all($regex, $string, $match))
		{
			return $match;
		}
		else
		{
			return array();
		}
	}
	



}