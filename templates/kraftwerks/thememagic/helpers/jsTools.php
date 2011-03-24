<?php  

// no direct access
defined( '_JEXEC' ) or die( 'Restricted access' );     

// ------------------------------------------------------------------------

/**
 * Some helper Functions for creating common JS objects. Uses jQuery and Jquery tools
 *
 * @note It's important to mention that no css is generated for you, I didn't want to lock you into any css.
 * Most of this wont even work without the necessary css so make sure you add it to your template.
 * Please refer to JQuery tools docs' http://flowplayer.org/tools/using.html for creating the css.
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

// If this file is included we will just go ahead and add Jquery tools to the head. We need it for all functions here anyway.
$document =& JFactory::getDocument();  
$magic =& get_instance();  
$jsToolsPath = FRAMEWORKURLPATH . '/media/js/jquery.tools.min.js';  
$document->addScript($jsToolsPath);


// ------------------------------------------------------------------------

/**
 * Takes some content and creates some tabs out of it.
 *
 * @param array $tabContent  The Content To Tab. The keys are used as link names, so make sure array is associative.
 * @param string $tabsID The unique ID for the tabs.
 * @param array $options an array of options to pass to the script
 * @param bool $enableMyOwnContent Rather than iterate through content you can pass in your own object for using tabs and sliders together.
 * @param mixed $myOwnContent Your Own Content should be a object containing markup of content already created. 
 *
 * @return obj  
 *
 **/  
if(!function_exists('tabs'))
{
	function tabs($tabContent = array(), $tabsType = 'array', $tabsID = null, $options = null, $enableMyOwnContent = false, $myOwnContent = null, $funcCallBack = null)
	{   
		$document =& JFactory::getDocument(); 
		
		ob_start();
		?>           
			jQuery("ul#tab_links-<?php echo $tabsID;?>").tabs("div#tabs_<?php echo $tabsID;?> > div"<?php if(!$options == null) : ?>
			,{ 
		        <?php echo jqOptions($options); ?>
			 }  
			<?php endif;?>
			);     
			  
		<?php
		$tabsDeclare = ob_get_clean(); 
		$tabsDeclare =  domReady($tabsDeclare); 
		$document->addScriptDeclaration($tabsDeclare);
      
		if($tabsType == 'array') 
		{
			ob_start();
			?>   
				<ul id="tab_links-<?php echo $tabsID;?>" class="tab_links"> 
					<?php if($tabLinks == null): ?>
						<?php foreach($tabContent as $tab): ?>     
							<li class="tab_link"><a href="#"><?php echo $tab['title'];?></a></li>  
						<?php endforeach;?>    
					<?php endif;?>
				</ul>
				<div id="tabs_<?php echo $tabsID;?>" class="tabs">
				<?php if($enableMyOwnContent == false):  ?>
					<?php echo $myOwnContent; ?>      
				<?php else:?>  
				    <?php foreach($tabContent as $tab): ?>
			            <div class="tab"><?php echo $tab['content'];?></div> 
					<?php endforeach;?>
				<?php endif;?>
				</div>
			<?php
		    return ob_get_clean();   
		}   
		
		else
		{   
			if(!function_exists($funcCallBack))
			{
				ob_start();
				?>   
					<ul id="tab_links-<?php echo $tabsID;?>" class="tab_links"> 
						<?php if($tabLinks == null): ?>
							<?php foreach($tabContent as $tab): ?>     
								<li class="tab_link"><a href="#"><?php echo $tab->title;?></a></li>  
							<?php endforeach;?>    
						<?php endif;?>
					</ul>
					<div id="tabs_<?php echo $tabsID;?>" class="tabs">
					<?php if($enableMyOwnContent == true):  ?>
						<?php echo $myOwnContent; ?>      
					<?php else:?>  
					    <?php foreach($tabContent as $tab): ?>
				            <div class="tab"><?php echo $tab->content;?></div> 
						<?php endforeach;?>
					<?php endif;?>
					</div>
				<?php
			    return ob_get_clean();
			} 
			
			else 
			{   
				$Args = array($tabContent);
			    return call_user_func($funcCallBack, $tabContent, $tabsID); 
			}

		}
 
	} 
}    

// ------------------------------------------------------------------------

/**
 * Takes some content and creates sliders out of it.
 *
 * @param array $sliderContent  The Content To Slide
 * @param string $sliderID The unique ID for the tabs.
 * @param string $vertical Enable or disable vertical. If disabled the script scrolls horizontally
 * @param string $size The number of visible items.   
 * @param bool $mouseWheel Enable or disable mouse scrolling 
 * @param string $prevLabel  Label For Previous button. Set to null to hideTxt class. 
 * @param string $nextLabel  Label For Next button. Set to null to hideTxt class.  
 * @param array $options an array of options to pass to the script 
 * @return obj     
 *
 **/
if(!function_exists('slider'))
{
	function slider($sliderContent = array(), $sliderID = null, $vertical = 'false', $size = '5',  $mouseWheel = false, $prevLabel = 'Previous', $nextLabel = "Next", $options = null)
	{     
		$document =& JFactory::getDocument(); 
		
	   	ob_start();
		?>      
				jQuery("div#scrollable-<?php echo $sliderID;?>").scrollable({   
				    vertical:<?php echo $veritical?>,
					size: <?php echo $size; ?>
		            <?php if(!$options == null) : ?> , 
				        <?php echo jqOptions($options); ?>
					<?php endif;?>
				})<?php if(!$mouseWheel == false) :?>.mousewheel()<?php endif;?>;        
		<?php   
		$sliderDeclare = ob_get_clean();  
		$sliderDeclare = domReady($sliderDeclare);
		$document->addScriptDeclaration($sliderDeclare); 

		ob_start();
		?>   
			<div id="scroll_container-<?php echo $sliderID;?>" class="slider scroll">
				<div id="actions"> 
				    <a class="prevPage <?php if ($prevLabel == null):?>hideTxt<?php endif;?>"><?php if(!$prevLabel == null) echo $prevLabel;?></a> 
				    <a class="nextPage <?php if ($nextLabel == null):?>hideTxt<?php endif;?>"><?php if(!$nextLabel == null) echo $nextLabel;?></a> 
				</div> 
				<div class="scrollable <?php if($vertical == "true"):?>vertical <?php else:?> horizontal<?php endif;?>"> 
				    <div class="items">  
						  <?php foreach($scrollContent as $scroll): ?>
					            <div class="scroll_item"><?php echo $scroll['content'];?></div> 
						  <?php endforeach;?>
				    </div> 
				</div>              
			</div> 
		<?php
	    return ob_get_clean();          
	}  
}

// ------------------------------------------------------------------------

/**
 * Creates an accordion. Primarily used by modules but there are other uses I'm sure.
 * 
 * @param array $content  The Content To accordion.
 * @param string $ID The unique ID for the accordion 
 * @param string $paneTitleMarkup  The type of markup to use for pane titles
 * @return obj   
 *
 **/  
if(!function_exists('accordion')) 
{
	function accordion($content, $ID, $paneTitleMarkup = 'h3', $effect = 'slide')
	{   
		
       	$document =& JFactory::getDocument(); 

		ob_start();
		?>         
				jQuery("#accordion-<?php echo $ID;?>").tabs("#accordion-<?php echo $ID;?> div.pane", {tabs: '<?php echo $paneTitleMarkup;?>', effect: '<?php echo $effect;?>', initialIndex: null});   
				   
		<?php   
		$accordionDeclare = ob_get_clean(); 
		$accordionDeclare = domReady($accordionDeclare); 
		$document->addScriptDeclaration($accordionDeclare);   

		ob_start();
		?>
		<div id="accordion-<?php echo $ID;?>">        
	        <?php $l = count($content);
	        foreach($content as $i => $content): ?>
			    <?php if($i == 0) : ?>
					<?php echo "<$paneTitleMarkup";?> class="current"><?php echo $content;?><?php echo "</$paneTitleMarkup>";?> 
				    <div class="pane" style="display:block"><?php echo $content['content'];?></div> 
				<?php else: ?> 
					<?php echo "<$paneTitleMarkup";?> ><?php echo $content;?><?php echo "</$paneTitleMarkup>";?> 
					<div class="pane"><?php echo $content['content'];?></div>
	            <?php endif; ?>
			<?php endforeach; ?>
		</div> 
		<?php
		return ob_get_clean();
	}   
} 

// ------------------------------------------------------------------------
       
/**
 * Takes Some Content and adds a collapse and open button. Unfinished.
 * 
 * @param mixed $content Content to collapse     
 * @param string $ID The unique ID for the accordion 
 * @param string $default Open Or Closed.
 * @return void        
 *
 **/  
if(!function_exists('collapse')) 
{
	function collapse($content, $ID, $default = 'Closed')
	{   
		$document =& JFactory::getDocument(); 
		   
		if(!is_array($content))
		{
			$content = array_push($content);
		} 

		if($default ==  'Closed') 
		{
			$default = 'hide';
		} else { $default = 'show';}   

	    ob_start();
		?>       
			jQuery("#collapsed-<?php echo $ID;?>").<?php echo $default;?>();     
			
		<?php 
		$collapseDeclare = ob_get_clean();    
		$collapseDeclare = domReady($collapseDeclare);
		$document->addScriptDeclaration($collapseDeclare);   

		ob_start();
		?>
		<div id="collapsed-<?php echo $ID;?>" class="collapsed">   
			<?php foreach($content as $content): ?>
				<div class="collapsed_content"><?php echo $content;?></div>
			<?php endforeach; ?>  
		</div>

		<?php 
		return ob_get_clean(); 
	}   
}
    

// ------------------------------------------------------------------------

/**
 * Creates a ToolTip
 * 
 * @param string $tooltipTrigger a css selector for triggering the content. This should be the tooltipped item.
 * @param mixed $tooltipContent The Tooltip's Content.     
 * @param string $ID Unique ID for tooltip
 * @param string $effect The effect to use. Default is slide
 * @param array $options an array of options to pass to the script      
 * @return obj  
 *
 **/ 
if(!function_exists('tooltip'))
{
	function tooltip($tooltipTrigger, $ID, $tooltipContent, $effect = 'slide', $options = array())
	{    
		$document =& JFactory::getDocument(); 
		
		ob_start();
		?>  
			    jQuery("<?php echo $tooltipTrigger;?>").tooltip({ effect: '<?php echo $effect;?>',
					  // one configuration property 
					    position: "bottom center", 

					    // another property 
					    opacity: 0.7
			            <?php if(!$options == null) : ?> , 
				        <?php echo jqOptions($options); ?>
						<?php endif;?>    
				});  
		<?php   
		$tooltipDeclare = ob_get_clean();   
		$tooltipDeclare = domReady($tooltipDeclare);
		$document->addScriptDeclaration($tooltipDeclare);   

		ob_start();
		?>
		<div class="tooltip" style="display:none;">   
				<?php echo $tooltipContent; ?>
			</div>
		<?php
		return ob_get_clean();
	}   
}


