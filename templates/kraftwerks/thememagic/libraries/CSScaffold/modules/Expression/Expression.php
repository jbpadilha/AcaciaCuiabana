<?php 

/**
 * Math
 *
 * Lets you do simple math equations within your css via math()
 *
 **/
class Expression extends CSScaffold_Plugins
{
	/**
	 * The final process before it is cached. This is usually just
	 * formatting of css or anything else just before it's cached
	 *
	 * @param $css
	*/
	function parse()
	{
		CSS::$css = self::parseExpressions();
	}
	
	/**
	 * Finds eval chunks in property values
	 *
	 * @return null
	 */
	function findExpressions($css)
	{
		return match('/(\#\[[\'\"]?([^]]*?)[\'\"]?\])/', $css);
	}
	
	/**
	 * Parses the expressions in an array from find_expressions
	 *
	 * @return null
	 */
	function parseExpressions($css = "")
	{
		# If theres no css string given, use the master css
		if($css == "") $css = CSS::$css;
		
		# Find all of the property values which have [] in them.
		if($matches = self::findExpressions($css))
		{
			# So we don't double up on the same expression
			$originals 		= array_unique($matches[1]);
			$expressions 	= array_unique($matches[2]);
					
			foreach($expressions as $key => $expression)
			{
				$result = false;
							
				# Remove units and quotes
				$expression = preg_replace('/(px|em|%)/','', $expression); 
				
				$result = eval("return $expression;");
				
				if($result !== false)
				{
					# Replace the string in the css
					$css = str_replace($originals[$key], $result, $css);
				}
				else
				{
				   // throw new Scaffold_Exception("Expression.cannot_parse", $matches[0][$key]);
				}
			}
		}
		
		return $css;
	}
	
}