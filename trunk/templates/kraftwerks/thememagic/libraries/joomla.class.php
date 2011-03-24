<?php      

// no direct access
defined( '_JEXEC' ) or die( 'Restricted access' );

// ------------------------------------------------------------------------

/**
 * Joomla. Provides methods for working with Joomla!
 *
 *      
 *    
 * @package		themeMagic
 * @subpackage  libraries
 * @version		1.0 Beta. 
 * @author		Ken Erickson AKA Bookworm http://www.bookwormproductions.net
 * @copyright 	Copyright 2009 - 2010 DesignBreakDown
 * @license		http://www.gnu.org/licenses/gpl-2.0.html GNU/GPLv2       
 * please visit the themeMagic site http://www.theme-magic.com  for support. 
 * Do not e-mail (or god forbid IM or call) me directly.
 *
 */
class joomla
{    
	/**
	 * Constructor Function. Gets a magic instance and initializes some variables 
	 *
	 * @return void
	 *
	 */            
	function joomla()
	{
		$magic =& get_instance();      
		$this->_initJoomlaVars();
	}   
	
// ------------------------------------------------------------------------
	       
	/**
	 * Creates and generate some useful Joomla Related vars.
	 *
	 */
	function _initJoomlaVars()    
	{
		$document =& JFactory::getDocument();  
		$this->url = clone(JURI::getInstance());
		$this->site_uri = JURI::root();      
		$this->currentComponent = JRequest::getVar('option');    
		
		// The Peage refere to your html title i.e <title/>
		// Item title is generated from the last element in the path.        
		$this->pageTitle = $document->title;
		$this->itemTitle = $this->_contentItemTitle();
	}
	   
// ------------------------------------------------------------------------

	/**
	 * Function For Outputting the Joomla! Head
	 * j_head can be over-riden by defining the j_head(); function in the hooks class.
	 *
	 */   
	function j_head() 
	{    
		$magic =& get_instance();   
	      
		if(!function_exists('j_head'))
		{
		    ob_start();
		    ?>
			<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
			<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="<?php echo $magic->template->language; ?>" lang="<?php echo $magic->template->language; ?>">  			
			<head> 
				<jdoc:include type="head" />
			<?php
		    return ob_get_clean(); 
		    $magic->Hooks->call_hook('j_head');
		}  
		
		else {
			$magic->Hooks->j_head();
		}
	}   
	
// ------------------------------------------------------------------------

	/**
	 * The default chrome function for themeMagic
	 * 
	 */	 
	function moduleDefaultRender($module, &$params, $moduleClass, $moduleCSS = null)
	{    
		if(!$moduleCSS == null) $moduleCSS = "style=\"$moduleCSS\"";
		ob_start();
		?>              
			<div id="module-<?php echo $module->id;?>" class="module <?php echo $module->name;?> <?php echo $moduleClass; ?>" <?php echo $moduleCSS; ?> >
			<?php if ($module->showtitle != 0) : ?>
				<h3><?php echo $module->title; ?></h3>
			<?php endif; ?>
				<div class="modulecontent"><?php echo $module->content; ?></div>
			</div>   
		<?php
	    return ob_get_clean();
	}    
	
// ------------------------------------------------------------------------
	
	/**
	 * Future Component Buffer Modification Function. 
	 * @note The intent is to allow you to run a post process filter on the fully rendered template.
	 * Like you often do with object buffering.
	 * TODO: Finish    
	 *
	 */
	function renderComponent($component)
	{  
   		$doc =& JFactory::getDocument();
		$doc->setBuffer( 'This is some content', 'component');
		
		jimport('joomla.application.component.helper'); 
		$component = JComponentHelper::getComponent($component);
		$params = new JParameter($component->params);    
		return $component; 
	}  
	 
// ------------------------------------------------------------------------

	/**
	 * Generates a Page Title From Breadcrumb Path.
	 *
	 * @return void 
	 *
	 **/
	function _contentItemTitle() 
	{
		$doc =& JFactory::getDocument();  
		
   		global $mainframe;

		// Get the PathWay object from the application
		$pathway =& $mainframe->getPathway();
		$crumbs   = $pathway->getPathWay();  
		
		$l = count($crumbs);     
	    foreach($crumbs as $crumb)
		{
			if ($i == $l - 1) return $crumb->name;     
			$i++;
		}   
	}
	
// ------------------------------------------------------------------------

	/**
	 * Module Details
	 *
	 * @return void 
	 *
	 **/  
	function moduleDetails($classFunc, $module, &$params, $moduleClass, $moduleCSS = null)
	{
		ob_start();    
		?>  
			<div class="mod-specific-details-wrap">
				<div class="mod-specific-details"> 
					<div class="mod-chrome">
						<span class="label-mod-info">Module Chrome:</span>
						<span class="mod-info"><?php echo $classFunc; ?></span>     
					</div>
					<div class="mod-name">    
						<span class="label-mod-info">Module Type:</span>
						<span class="mod-info"><?php echo $module->name; ?></span>     
					</div>
					<div class="mod-classes">     
						<span class="label-mod-info">Module Class Suffixes:</span>
						<span class="mod-info"><?php echo $moduleClass;?></span>
					</div>
				</div>    
			</div>  
		<?php    
		echo ob_get_clean();
	}    
}