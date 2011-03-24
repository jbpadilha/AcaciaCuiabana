<?php   

// no direct access
defined( '_JEXEC' ) or die( 'Restricted access' );     

// ------------------------------------------------------------------------

/**
 * Column Helpers. 
 * @note These Functions help load columns and control their widths.
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
 * Loads columns
 * 
 * @param array $columns. The Columns to load. Properties available columnName, width, class, and css 
 * @param int $parentWidth width of the parent item.
 * @param bool $separator Enable or Disable Separator. Default True  
 * @param string $separatorContent Content to place inside separator. 
 * @param string $sepWidth Width Of The Separator this is Subtracted from the columns except the last one.
 *
 * @return void
 * 
 **/ 
if(!function_exists('loadColumns'))
{
	function loadColumns($columns, $parentWidth, $separator = true, $separatorContent = null, $sepWidth = null)   
	{   
		if($separator == true)
		{
			ob_start();
			?>
			<div class="columnSeparator" style="width:<?php echo $sepWidth;?>px;">   
				<?php echo $separatorContent; ?>  
				</div> 
			<?php    
			$columnSep = ob_get_clean();   
		} 

		if(count($columns) ==  1)
		{
			$sepWidth = null;
			$columnSep = null;
		}

		if(is_array($columns))  {   

			// Setup the Columns array    
		    $columns = cleanArray($columns, true); 
	        if(count($columns) > 1)
			{                  
				$columns = callCheck($columns);  
			    $columns = widthCalc($columns, $parentWidth, $sepWidth);  
			    $columns = cssSetter($columns, ' last-column', ' column');    
			
				// Now We can Loop Through the Columns and load them          
				$i = 0;
				$l = count($columns);     
				foreach($columns as $column) 
				{   
				   $isLastItem = ($i == ($l - 1));

			        if($separator == true AND !$isLastItem)
					{
						echo loadColumn($column['column'], $column['css'], $column['class']);    
						echo $columnSep;
					}   

					else 
					{
						echo loadColumn($column['column'], $column['css'], $column['class']); 
					}

					++$i;  
				}
			} 
			
			else
			{   $parentWidth = $parentWidth . 'px'; 
			    $columns[0]['class'] = $columns[0]['class'] . ' only-column';
				echo loadColumn($columns[0]['column'], "width:$parentWidth;", $columns[0]['class']);
			}
		} else {
			return "Please Send a Columns array and parent width";
		} 
	}   
} 

// ------------------------------------------------------------------------  
  
/**
 * Loads a Column
 * 
 * @param string $columnName Name of the column to load. 
 * @param string $columnCSS CSS to add. Optional.
 * @param string $columnClass a class to add to the column wrap div.
 * @param string $columnPath Path to the Column File. Optional. Defaults to active childTheme directory.
 * @return void
 **/
if(!function_exists('loadColumn'))
{
	function loadColumn($columnName, $columnCSS = null, $columnClass = null, $columnPath = null, $themeName = null)  
	{   
		$magic =& get_instance();    
		
		if($themeName == null)
		{
			if(empty($magic->tconfig->themeName)) 
			{
				$themeName = 'default';
			}   else { $themeName = $magic->tconfig->themeName; }
		}

		if($columnPath == null) $columnPath = BASEPATH . '/child_themes/' . $themeName . '/layouts/columns/' . $columnName;   


		if($columnCSS) {
		   $columnStyleOutput = 'style="' . $columnCSS . '"';

		}   

		else { 
			 $columnStyleOutput = "";	
		} 

	    ob_start(); 
		?>
		<div id="<?php echo $columnName;?>" class="<?php echo $columnClass;?>" <?php echo $columnStyleOutput;?>> 
			<?php include(''.$columnPath.'.php') ;  ?>
		</div>
		<?php

		return ob_get_clean();;
	}   
}

// ------------------------------------------------------------------------

/**
 * Takes an array of items, with widths and a parent item width, then it auto-magically works out their new widths.
 *
 * @note used by loadModuleSet and loadColumns functions. 
 * It is very important that you've removed un-published items from the array before passing items in.
 *
 * @param array $items The items with widths
 * @param int $parentWidth width of the parent item. 
 * @param string $widthKey The key to get the width form. optional
 * @return array
 **/    
if(!function_exists('widthCalc')) 
{
	function widthCalc($items, $parentWidth, $sepWidth = null)
	{     
	    if(!is_array($items) OR $parentWidth == null) return "Please send some items and set parent width";

		$itemsWithoutWidth = null;     
		$widthItems = array();         

		// If there is only one item we asssign the width and then we are done
		if(count($items) == 1)
		{  
			foreach($items as $key => $item)
			{
				if(isset($item['width'])) 
				{
					$items[$key]['width'] = $item['width'];
				} 
				else
				{
					$items[$key]['width'] = $parentWidth;
				}	
			} 
              
			return $items;
		} 

		else 
		{      

			// Setup parents width. If there are items with a set width we want to substract their widths.
			// from the parents width.       
			foreach($items as $key => $item) 
			{   
				if(isset($item['width']))  { 
					$parentWidth = $parentWidth - $item['width'];    
					$widthItems[$key] = $item;
				}   
				
				else {
					$itemsWithoutWidth++;      
				}     
			}      
			
			// Loop thorugh items without a set width and calculate their widths
			foreach($items as $key => $item)
			{  
				if(!isset($item['width']))
				{
					$items[$key]['width'] = $parentWidth / $itemsWithoutWidth;  
				}  
			}

			// Recalculate widths for separators.
			if(!$sepWidth == null) 
			{     
				$itemsCount = count($items); 
				$widthItemsCount = count($widthItems); 
				 
				if($itemsCount > 1) 
				{   
					$totalSepWidth = $sepWidth * ($itemsCount - 1); 
					$finalSepWidth = $totalSepWidth / ($itemsCount - $widthItemsCount);    
				}  
				
				foreach($items as $key => $item)
				{    
					if(!array_key_exists($key, $widthItems))     
					{
						$items[$key]['width'] = $item['width'] - $finalSepWidth;     		
					}
				}  
				
			} else { return $items; }

			return $items;
		}   
	}  
} 

// ------------------------------------------------------------------------  

/**
 * Takes an array of items and returns their css, applying classes along the way.
 *
 * @note used by loadModuleSet and loadColumns functions. 
 * Make sure you've ran the array through widthCalc() beforehand.
 *
 * @param array $items The items with widths
 * @param string $lastChildClass The Class for the Last Child  
 * @param string $defaultClass a Class to append to every item. e.g column or module.
 * @return array
 **/     
if(!function_exists('cssSetter'))
{
	function cssSetter($items, $lastChildClass = ' last-child', $defaultClass = null) 
	{     
		$i = 0;
		$l = count($items);
		
		foreach($items as $key => $item) 
		{ 
		    $isLastItem = ($i == ($l - 1));  

			if(isset($item['css'])) {
			    $items[$key]['css'] = 'width:' . $item['width'] . 'px;' . $item['css'];  
			}

			else {
			    $items[$key]['css'] = 'width:' . $item['width'] . 'px;';     
			}  
              
			$items[$key]['class'] = $item['class'] . ' ' . $defaultClass;

			if($isLastItem) { 
				$items[$key]['class'] = $items[$key]['class'] . $lastChildClass; 	
			}
			else {
				$items[$key]['class'] = $items[$key]['class'];  
			}  

			++$i; 
		}  

		return $items;
	}  
}     
  
// ------------------------------------------------------------------------

/**
 * Callback Function For Columns and Modules.
 * @note This Calls a Defined CallBack Function to see if a column should be loaded.
 *  
 * @param array $items Column or Module Array 
 * @return array    
 **/      
if(!function_exists('callCheck')) 
{
	function callCheck($items)
	{
		foreach($items as $key => $item)
		{
			if(!$item['callback'] == null)
			{   
				$callback = (string) $item['callback'];
				if(call_user_func($callback) == false) 
				{
					unset($items[$key]);
				}
			}
		}  

		return $items;
	} 
}
