<?php      

// no direct access
defined( '_JEXEC' ) or die( 'Restricted access' );

// ------------------------------------------------------------------------

/**
 * Some helper Functions for working with css. 
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
 * Takes some fonts and outputs a font family
 *  
 * @param mixed $fonts Font or Fonts for font-family.
 *
 * @return void
 **/    
if(!function_exists('font'))  
{
	function font($fonts)
	{   
		if(!is_array($fonts))
		{
			$fonts = array_push($fonts);
		}  

		ob_start();
		?>
	 	   font-family:<?php $l = count($) 
			foreach($fonts as $i => $font): ?>	
				<?php if(wordCount($font) > 1) :?>"<?php echo $font; ?>"<?php else:?><?php echo $font; if(!$i == $l - 1): ?>,<?php endif;?>
		<?php
		return ob_get_clean; 
	} 
}

// ------------------------------------------------------------------------

/**
 * Takes a Image Param and a style and returns the necessary css
 * 
 * @param string $imgParam the image param to use 
 * @param string $cssSelector a css selector to apply the background on
 * @param string $imgFolder folder name where image is stored  
 * @param string $bgStyle style for the backgrounds
 * @return void
 **/   
if(!function_exists('getImgCss'))  
{
	function getImgCss($imgParam, $cssSelector, $imgFolder, $bgStyle = null, $bgColor = null, $widthHeight = null, $imgWidth)
	{   
		if(!$bgStyle) {
			$bgStyle = "repeat";
		}     

		if(!$bgColor) {
			$bgColor ="transparent";
		} 

		// Take the Params and Generate Image data
		$img_path =  TEMPLATEURLPATH . '/media/images/' . $imgFolder . '/' . $imgParam;  
		$img_url  =  TEMPLATEURLPATH  . '/media/images/' . $imgFolder . '/' . $imgParam; 
		$img_size = getimagesize($img_path);  
		if(!$imgWidth) {   
			$img_width = $img_size[0]  . 'px';
		}  

		else {
			$img_width = $imgWidth;
		}     

		$img_height = $img_size[1] . 'px'; 

		if($widthHeight == True) {
			echo "  
					$cssSelector {
						background:$bgColor url($img_url) $bgStyle;
						width:$img_width;
						height:$img_height;	           
					}   
			     ";
		}   

		else {   
			echo "  
					$cssSelector {
						background:$bgColor url($img_url) $bgStyle;      
					}   
			     ";
		}

	}  
}

// ------------------------------------------------------------------------

/**
 * Takes an opacity value and returns the necessary css for cross-browser compat
 * 
 * @param string $opacity the opacity value to use 
 * @return void
 **/  
if(!function_exists('opacity'))   
{
	function opacity($opacity)
	{
		ob_start();
		?>
		opacity: <?php echo $opacity;?>;
		-moz-opacity: <?php echo $opacity;?>;
		filter:alpha(opacity=<?php echo $opacity;?><?php echo $opacity;?>);    

		<?php
		return ob_get_clean();
	}  
}

// ------------------------------------------------------------------------

/**
 * Takes a border-radius and returns the necessary css for cross-browser compat 
 * 
 * @param string $radius the border radius value
 * @return obj
 **/    
if(!function_exists('borderRadius'))
{
	function borderRadius($radius)
	{
		ob_start();
		?>
		-moz-border-radius:<?php echo $radius;?>;
		-webkit-border-radius:<?php echo $radius;?>;
		border-radius:<?php echo $radius;?>;     

		<?php
		return ob_get_clean();
	} 
	
}

// ------------------------------------------------------------------------

/**
 * Takes an an array of css properties and their values
 * 
 * @param mixed $css the array of css props
 * @return obj
 **/    
if(!function_exists('css'))
{
	function css($css)
	{    
		if(!is_array($css))
		{
		   $css = array($css);
		}    
		
		ob_start();
		?> 
		<?php foreach($css as $key => $cssVal): ?> 
			<?php echo $key;?>:<?php echo $cssVal; ?>;   
		<?php endforeach;?>  
		
		<?php
		return ob_get_clean();
	} 
}



  