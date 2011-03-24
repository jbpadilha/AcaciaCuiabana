<?php

/**
 * ImageReplacement class
 *
 **/
class ImageReplace extends CSScaffold_Plugins
{

	/**
	 * The second last process, should only be getting everything
	 * syntaxically correct, rather than doing any heavy processing
	 *
	 * @return $css string
	 */
	function postProcess()
	{			
		if($found = CSS::findPropertiesWithValue('image-replace', 'url\([\'\"]?([^)]+)[\'\"]?\)'))
		{
			foreach ($found[4] as $key => $value) 
			{
				$path = $url = str_replace("\\", "/", unquote($value));
			
				# If they're getting an absolute file
				if($path[0] == "/")
				{
					$path = DOCROOT . ltrim($path, "/");
				} 								
																				
				// Get the size of the image file
				$size = GetImageSize($path);
				$width = $size[0];
				$height = $size[1];
				
				// Make sure theres a value so it doesn't break the css
				if(!$width && !$height)
				{
					$width = $height = 0;
				}
				
				// Build the selector
				$properties = "
					background:url($url) no-repeat 0 0;
					height:{$height}px;
					width:{$width}px;
					display:block;
					text-indent:-9999px;
					overflow:hidden;
				";

				CSS::replace($found[2][$key], $properties);
			}
			
			# Remove any left overs
			CSS::replace($found[1], '');
		}
	}

}