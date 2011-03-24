<?php  
        
// no direct access
defined( '_JEXEC' ) or die( 'Restricted access' );

// ------------------------------------------------------------------------

/**
 * Returns A list Of Img Files In A Folder
 *  
 * @package		themeMagic
 * @subpackage  admin.params
 * @version		1.0 Beta. 
 * @author		Ken Erickson AKA Bookworm http://www.bookwormproductions.net
 * @copyright 	Copyright 2009 - 2010 DesignBreakDown
 * @license		http://www.gnu.org/licenses/gpl-2.0.html GNU/GPLv2       
 * please visit the themeMagic site http://www.theme-magic.com  for support. 
 * Do not e-mail (or god forbid IM or call) me directly.
 */

class imgSelect
{
	/**
	 * Creates A imageselect 
	 *
	 * @return void
	 **/
	function create($param)
	{   
		// Setup the Params Default Value.
		   if(empty($param->value))
		{ 
			$paramValue = $param->attributes()->default;  
		} else { $paramValue = $param->value; }
		   
		$imagesdir  = MEDIAPATH . DS . 'images' . DS . $param->attributes()->folder . DS ; 
		$imagesFiles = getFilenames($imagesdir);  
		$imageslist = array();   
		
		if($imagesFiles)
		{
			foreach($imagesFiles as $key => $image)  
			{
				if(isImage($image))
				{
					array_push($imageslist, $image);  
				}  
			}   
		}   
		
		foreach($imageslist as $key => $image)
		{  
			$imageslist[$image] = $image;
			unset($imageslist[$key]);
		}
		
		ob_start();
		?>     
		<div class="param imageSelect section">    
			<h3 class="heading"><?php echo $param->attributes()->label;?></h3>  
			<div class="option">
			   <div class="controls">
				   <?php echo formDropdown($param->attributes()->name, $imageslist, $paramValue); ?>    
			   </div>      
			   <div class="explain">    
					<?php echo $param->description; ?>
				</div>
			</div>
		</div>  
		<?php
		echo ob_get_clean();
	}

// ------------------------------------------------------------------------

	/**
	 * Explodes The Param and Returns A Keyed Array Containing image name, image path, width and height.   
	 *
	 * @return array
	 **/
	function get($configXMl, $param)
	{    
		$imgProps = array();     
		$imagesdir  = MEDIAPATH . DS . 'images' . DS . $param[0]->attributes()->folder . DS; 
		
		// Setup the Params Default Value.
	    if(empty($param->value))
		{ 
			$paramValue = $param[0]->attributes()->default;  
		} else { $paramValue = $param->value; }
		   
		$imagePath = $imagesdir . $paramValue; 
		                              
		// Set Img Properties 
		$imgProps['name']   =  (string) $param[0]->value;     
		$imgProps['path']   =  (string) $imagePath;   
		$imgProps['width']  = (string) $param[0]->width;
		$imgProps['height'] =  (string) $param[0]->height; 
		
		return $imgProps; 
	} 
	
// ------------------------------------------------------------------------

	/**
	 * Saves A Image Param   
	 *
	 * @return array
	 **/
	function save($paramObj, $param)    
	{   
		$imagesdir  = MEDIAPATH . DS . 'images' . DS . $paramObj[0]->attributes()->folder . DS; 
		
		$imagePath = $imagesdir . $param;
		$imgSize = getimagesize($imagePath);     
	    $imgWidth = $imgSize[0]  . 'px';
		$imgHeight = $imgSize[1] . 'px';          
		
		$paramObj[0]->width = $imgWidth; 
		$paramObj[0]->height = $imgHeight;    
	    $paramObj[0]->value = $param;
		
		return $paramObj;
	} 
}