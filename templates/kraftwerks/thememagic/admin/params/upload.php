<?php    

// no direct access
defined( '_JEXEC' ) or die( 'Restricted access' );

// ------------------------------------------------------------------------

/**
 * Upload Parameter
 *  
 * @package		themeMagic
 * @subpackage  admin.params
 * @version		1.0 Beta. 
 * @author		Ken Erickson AKA Bookworm http://www.bookwormproductions.net
 * @copyright 	Copyright 2009 - 2010 DesignBreakDown
 * @license		http://www.gnu.org/licenses/gpl-2.0.html GNU/GPLv2 only       
 * please visit the themeMagic site http://www.theme-magic.com  for support. 
 * Do not e-mail (or god forbid IM or call) me directly.
 */

class upload
{    
	/**
     * Adds the Prerequisite JS for Uploads.
     * @note All Param constructors are pretty much only used for this purpose.
     *
     * @return void
     **/
	function upload()
	{
		$document =& JFactory::getDocument(); 
		$ajaxUploadJSpath = FRAMEWORKURLPATH . '/media/js/ajaxupload.min.js';   
	    $uploadJSpath = FRAMEWORKURLPATH . '/media/js/saveUpload.js';  
	    $document->addScript($ajaxUploadJSpath);
	    $document->addScript($uploadJSpath);
	} 
	
// ------------------------------------------------------------------------
	
	/**
	 * Creates A Upload Field
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
		
		// Setup Form Attributes  
		$data = array(    
			 'name'   => "$param->attributes()->name", 
			 'class'  => 'upload',
			 'value'  => "$paramValue"
		);

		ob_start();
		?>        
		<div class="param upload section">    
			<h3 class="heading"><?php echo $param->attributes()->label;?></h3>  
			<div class="option">
			   <div class="controls">   
				   <?php echo formInput($data);  ?>         
				   <div class="upload_button_div">
						<span class="button upload_button" id="<?php echo $param->attributes()->name;?>">Upload</span>
						<span class="button upload_reset_button hide">Remove</span>
					</div>
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
	 * Gets The Value From Param 
	 *
	 * @return void
	 **/
	function get($configXML, $param)
	{   
		$filePath =  $param[0]->value;
		return $filePath;
	} 
}