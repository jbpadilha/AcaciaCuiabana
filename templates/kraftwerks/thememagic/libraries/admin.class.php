<?php  

// no direct access
defined( '_JEXEC' ) or die( 'Restricted access' );     

// ------------------------------------------------------------------------

/**
 * Admin Class. Provides methods for building and working with a template admin panel
 *
 * @note About the terminology used here.
 * Get refers to retrieving a parameter's value, save refers to saving the value.
 * Print is when a Parameter's controls(i.e slider, input field, texArea) are
 * generated and displayed
 *      
 * TODO: A Option for Auto Generation Of Admin Panel markup and JS. 
 * Manual creation of admin markup looks prettier go with it, it wont hurt and your users will love you. 
 *    
 * @package		themeMagic
 * @subpackage  libraries
 * @version		1.0 Beta. 
 * @author		Ken Erickson AKA Bookworm http://www.bookwormproductions.net
 * @copyright 	Copyright 2009 - 2010 DesignBreakDown
 * @license		http://www.gnu.org/licenses/gpl-2.0.html GNU/GPLv2       
 * please visit the themeMagic site http://www.theme-magic.com  for support. 
 * Do not e-mail (or god forbid IM or call) me directly.
 */    

// We will need all of this no matter what; so go ahead and load it.
$magic =& get_instance();
$magic->load->helper('file'); 
jimport('joomla.filesystem.file');
 
class admin 
{   
	/**
	 * Admin Constructor Function.
	 *
	 * @return void
	 **/
	function admin() 
	{       
	  
		$doc =& JFactory::getDocument();     
		
		/**
		 * Load The Config. By loading it the constructor we 'artificially'
		 * Create a singleton reference to it because the class is only
		 * instantiated once.
		 **/  
		$this->configPath = BASEPATH . '/template_files/config.xml'; 
		$this->configXML = simplexml_load_file($this->configPath);        
		
		// Do the same for The Core Config
		$this->coreConfigPath = FRAMEWORKPATH . '/config/core_config.xml'; 
		$this->coreConfigXML = simplexml_load_file($this->coreConfigPath);
	}    
	
	function adminInit()
	{
		$this->_adminFormJS();   
	}
      
//** Core Config **//	
// ------------------------------------------------------------------------

	/**
	 * Config Bar Displayer
	 *
	 **/
	function configBar()
	{     
		// Only An Admin Should Have Access
		if(!isAdmin()) return;      
		
		$this->_configBarJS();
		
		// These Are All On/Off Values So We Will Asume Radio Buttons
	    $settings = $this->coreConfigXML->xpath("//setting"); 
	    
		ob_start();
		?> 
			<div id="config-bar">   
				<div class="label_configbar_container"><span>themeMagic Config &amp; Dev Tools</span></div>
				<ul id="config-bar-options"> 
					<?php 
						$formClass = $formClass . ' config-bar-save';
						echo $this->openAdminForm($formClass, 'save-configbar');     
					?>            
					<?php foreach($settings as $setting): ?>
						<?php
							if(is_null($setting->value))
							{ 
								$settingValue = $setting->attributes()->default;  
							} else { $settingValue = $setting->value; } 
						?>   
						<?php $this->_coreSettingJS($setting, $settingValue); ?>
						   
						<li class="config-option-<?php echo $setting->attributes()->name;?>">     
							<div id="radio-wrap-<?php echo $setting->attributes()->name;?>">
								<label for="<?php echo $setting->attributes()->name;?>-radio" class="on-off-radio"><span class='label'><?php echo $setting->attributes()->label;?>:</span>
									<input type="radio" value="<?php echo $settingValue;?> " name="<?php echo $setting->attributes()->name;?>-radio" id="<?php echo $setting->attributes()->name;?>-radio" class="on-off-radio">
								</label>   
							</div>  
							<input type="hidden" value="<?php echo $settingValue;?> " name="<?php echo $setting->attributes()->name;?>" id="<?php echo $setting->attributes()->name;?>" class="actual-value">
						</li>    
						<?php 
								$toolTipTrigger = '.config-option-'  . $setting->attributes()->name; 
								$tooltipContent = $setting->tooltip;
								$toolTipID = $setting->attributes()->name; 
								echo tooltip($toolTipTrigger, $toolTipID, $tooltipContent);                
							?>
					<?php endforeach; ?>             
				</ul>  
				<div class="save-config-bar-wrap">
					<?php   
					    $submitData = array('class' => 'local_submit');   
					    echo formSubmit($submitData, 'Save');  
						echo formClose(); 
					?>   
				</div>
			</div>   
			<div class="toggle-config-wrap"><a href="#" id="toggle-config-bar">Close [-]</a></div>
		<?php
		echo ob_get_clean();
	}	   

// ------------------------------------------------------------------------      

	/**
	 * Adds The Config Bar JS
	 *
	 * @return void
	 **/
	function _configBarJS()
	{   
		$document =& JFactory::getDocument();  
		$j3sswJSpath = FRAMEWORKURLPATH . '/media/js/j3ssw/jquery.j3ssw.min.js';  
		$document->addScript($j3sswJSpath);  
		$configBarJSpath = FRAMEWORKURLPATH . '/media/js/config.bar.js';  
		$document->addScript($configBarJSpath);
		$j3sswCSSpath = FRAMEWORKURLPATH . '/media/js/j3ssw/jquery.j3ssw.css';  
		$document->addStyleSheet($j3sswCSSpath);    

		ob_start();
		?>       
		jQuery("#user-message").overlay({ 
		    top: 92, 
		    expose: { 
		        color: '#fff', 
		        loadSpeed: 200, 
		        opacity: 0.5 
		    }, 
		    closeOnClick: true, 
		    api: true 

		});

		jQuery(".config-bar-save").submit(
			function() {      
		    var actionForm = jQuery(this).attr('action');
			var data = jQuery.toJSON(jQuery(this).serializeObject());
			var formName = jQuery(this).attr("name");
			jQuery.post( actionForm, {
			action: "save-params", 
			formName: formName,
			data: data },
			function(response) { 
				jQuery('#user-message').empty();
				jQuery('#user-message').append('<div class="response">' + response + '</div>'); 
				if(jQuery('#user-message:hidden')) {
					jQuery('#user-message').overlay().load();  
				}
				return false;   
			});
			return false; }
		 );  

		<?php
		$adminFormDeclare = ob_get_clean(); 
		$adminFormDeclare =  domReady($adminFormDeclare); 
		$document->addScriptDeclaration($adminFormDeclare);       
	}  
   
// ------------------------------------------------------------------------      

	/**
	 * Adds Some Radio JS for a Core Setting    
	 *
	 * @param mixed $setting The Setting Objectx
	 * @return void
	 **/
	function _coreSettingJS($setting, $settingValue)
	{   
		$document =& JFactory::getDocument();  
		 
		// Reverse The Bool Setting Value for stupid jQuery plugin          
		if($settingValue == 'false') $settingValue = '1';
		else { $settingValue = '0'; }         
		
		ob_start();     
		?>
			jQuery("#radio-wrap-<?php echo $setting->attributes()->name;?>").j3ssw({
			                index:<?php echo $settingValue;?>,
							status:true,
							def:"def-radio", 
							off:"down-radio", 
							on:"up-radio",
							mode:2,
							callback:listener_<?php echo $setting->attributes()->name;?>
		    });   
			function listener_<?php echo $setting->attributes()->name;?>(selection, status, id, j3ssw){  
				jQuery('input#<?php echo $setting->attributes()->name;?>').val(status);
			}          
		<?php  
	   	$settingsDeclare = ob_get_clean(); 
		$settingsDeclare =  domReady($settingsDeclare); 
		$document->addScriptDeclaration($settingsDeclare);    
	}        
	
// ------------------------------------------------------------------------ 

    /**
     * Gets a Core Config Item's Value  
     *
     * @param mixed $configs The config or configs to get.
     * @return void
     **/   
	function getCoreConfig($configs) 
	{   
		if(!is_array($configs))
		{
			$configs = array($configs);
		}

		foreach($configs as $key => $config)
		{
			$configObj = $this->coreConfigXML->xpath("//setting[@name = '$config']");       
		    $configVal = $configObj[0]->value;
			return $configVal;
	    }
	}  
      
//** CSS Panel **//   
// ------------------------------------------------------------------------ 

    /**
     * Returns A CSS Panel.
     *  
     * @return obj
     **/ 
	function getCSSAdmin()         
	{   
		$magic =& get_instance();   
				 
		$cssAdminConfigPath = FRAMEWORKPATH . DS . 'config' . DS . 'CSS_Config.php';    
		require($cssAdminConfigPath);
		
		$this->cssProps = $cssProps;    
		$this->cssGroups = $cssGroups;    
		
	    $this->_CSSAdminJS();       
		
		// Get The Options  
	    $cssOptions = $this->configXML->xpath("//cssoptionset");    
	
		// Generate The Select List Array  
		$listCSSOptions = $this->_selectListCSSArr();         
		array_unshift($listCSSOptions, 'please choose');

		// Lets Setup Our Form 
		$formClass =  ' option-admin-form cssAdmin';
		echo $this->openAdminForm($formClass, 'save-css'); 
		
		// Create The Select List        
		$cssAdminAttrs = 'id="css-admin-select"';    
		ob_start();
		?>      
		<div class="elements-wrap">
			<div class="group-box open elements">   
				<h3 class="group-box-heading">
					<span class="group-box-label">Element Selector</span>
				</h3>         
				<div class="group-box-content">  
					<p class="desc">Select An Element From The Selector and then you can change it's properties</p>
				   <div class="select_wrap">
						<?php echo formDropdown('cssAdmin', $listCSSOptions, null, $cssAdminAttrs);  ?>   
					</div>
				</div>
			</div>  
		</div>
		<?php
		echo ob_get_clean();
		
		echo $this->_cssOptionsBoxes();   
		 
		// Close form                                                
		$submitData = array('class' => 'css_submit');   
	    echo formSubmit($submitData, 'Save');  
		echo formClose();
	}      

// ------------------------------------------------------------------------ 

    /**
     * Creates and Adds The CSS Admin JS.
     *  
     * @return void
     **/ 
	function _CSSAdminJS()
	{
		$document =& JFactory::getDocument();  
		$jqueryColorJSPath = FRAMEWORKURLPATH . '/media/js/jquery.color.min.js';  
		$document->addScript($jqueryColorJSPath);

		$CSSAdminJSPath = FRAMEWORKURLPATH . '/media/js/CSSAdmin.min.js';  
		$document->addScript($CSSAdminJSPath);
	}  
   
// ------------------------------------------------------------------------ 

    /**
     * Builds a Associative Array Of Categories For the Select List
     **/ 
	function _selectListCSSArr()
	{  
		$listArr = array(); 
		
		// Setup The Option Set That Have A Category 	
		$optionsWithCat = $this->configXML->xpath("//cssoptionset[@category]");   
		foreach($optionsWithCat as $optionWithCat)
		{   
			$cat = $optionWithCat->attributes()->category; 
			$catsObj = $this->configXML->xpath("//cssoptionset[@category = '$cat']");   
			foreach($catsObj as $key => $optionSet)
			{     
				 $affects = (string) $optionSet->attributes()->affects;
				 $listArr["$cat"]["$affects"] = (string) $optionSet->attributes()->name;            
			} 
		}     
		
        // Setup The Option Set That Don't Have A Category 
		$optionsWithoutCat = $this->configXML->xpath("//cssoptionset[not(@category)]");   
		foreach($optionsWithoutCat as $key => $optionSet)
		{     
			 $affects = (string) $optionSet->attributes()->$affects;
			 $listArr['Other']["$affects"] = (string) $optionSet->attributes()->name;            
		}    

	    return $listArr;
	}  
	  
// ------------------------------------------------------------------------ 

    /**
     * Creates Some CSS Options Boxes
     *  
     * @return void
     **/ 
	function _cssOptionsBoxes()
	{  
	    $optionsets = $this->configXML->xpath("//cssoptionset");
		foreach($optionsets as $optionset)
		{   $optionsetName = (string) $optionset->attributes()->name;
			$groups = $this->configXML->xpath("//cssoptionset[@name = '$optionsetName']/group"); 
			ob_start(); 
			?> 
			<div id="css-option-set-<?php echo $optionsetName;?>" class="css-option-set hidden"> 
				<?php   
					$l = count($groups);
					foreach($groups as $key => $group):
			    ?>       
					<div class="group-box <?php if ($key == 0): ?> open <?php else: ?> collasped <?php endif;?> ">   
						<h3 class="group-box-heading">
							<span class="group-box-label"><?php echo $group->attributes()->label;?>: <?php echo $optionsetName; ?></span>
							<a href="#" class="minimize">+</a>  
						</h3>         
						<div class="group-box-content">  
						   <?php echo $this->_processCSSParams($optionsetName, $group); ?> 
						</div>
					</div>
				<?php endforeach; ?>
			</div>              
			<?php 	
			echo ob_get_clean();     
		}  
	}
	
// ------------------------------------------------------------------------ 

    /**
     * Processes The CSS Params
     *  
     * TODO: Make This Support Groups So No More Individual Param Definition
     **/ 
	function _processCSSParams($optionsetName, $group)
	{  
		$magic =& get_instance();      
		
		$groupName = $group->attributes()->name;   
		
		$cssparams = $this->configXML->xpath("//cssoptionset[@name = '$optionsetName']/group[@name = '$groupName']/cssparam");
		$cssgroups = $this->configXML->xpath("//cssoptionset[@name = '$optionsetName']/group[@name = '$groupName']/cssgroup");
    
		// Turn The Groups Into a cssParams array. 
		if($cssgroups)       
		{
			$cssgroupParams = $this->_groupToCSSParams($cssgroups);
			$cssgroupParams = $cssgroupParams->xpath("//cssparam");     
			$cssgroupParams = $this->_CSSParamsToParams($cssgroupParams, $optionsetnName, $groupName);    
		}

	    $cssParams =   $this->_CSSParamsToParams($cssparams, $optionsetName, $groupName); 

		foreach($cssParams as $key => $param) 
		{    
		    $paramType = $param->attributes()->type; 
		    $paramObj = $param[0];
		    $$paramType = $paramType;
			echo $magic->admin->{$paramType}->create($paramObj);   
		}
	}	  

// ------------------------------------------------------------------------ 

    /**
     * Generates CSS Params From Group Params
     **/ 
	function _groupToCSSParams($groups)
	{   
		$xmlOutStr = "<cssparams>";   
		
		foreach($groups as $group)
		{   
		    $type = (string)  $group->attributes()->type;
 			if(array_key_exists($type, $this->cssGroups))
			{     
				$cssParams = $this->cssGroups["$type"];  
				foreach($cssParams as $cssParam):   ?>
				<?php ob_start(); ?>  
					<cssparam type="<?php echo $cssParam; ?>" default=""> 
						<value></value>
					</cssparam>
				<?php  
				$xmlOutStr .= ob_get_clean();
				endforeach;   
				$xmlOutStr .= "</cssparams>";
			} 
			else 
			{  
				$error = 'Group' . $group->attributes()->name . 'is Not Defined In Config';
				echo $error;
			}
		}    
		  
	   $xmlReturn = simplexml_load_string($xmlOutStr);
	   return $xmlReturn;
	}   
	
// ------------------------------------------------------------------------ 

    /**
     * Generates Params From CSS Params
     **/ 
	function _CSSParamsToParams($cssParams, $optionsetName, $groupName)
	{   
	    $xmlOutStr = "<params>"; 
		foreach($cssParams as $cssParam)
		{
			$type = (string) $cssParam->attributes()->type;
			$default = $cssParam->attributes()->default; 
						
 			if(array_key_exists($type, $this->cssProps))
			{     
				$params = $this->cssProps["$type"]; 
			    $optionName = (string) $optionsetName; 
			    $optionset =  $this->configXML->xpath("//cssoptionset[@name = '$optionName']");
			    $affects = $optionset[0]->attributes()->affects;    
			
			    ob_start(); ?>
					<param name="<?php echo $optionName;?>_-<?php echo $type; ?>" affects="<?php echo $affects; ?>"  <?php foreach($params as $key => $attr): ?> <?php if(!is_array($attr)): ?> <?php echo $key; ?>="<?php echo $attr;?>" <?php endif; ?> <?php endforeach; ?>>     
						<value><?php echo $cssParam->value; ?></value>  
						<?php 
							/** 
							 * Rather Convoluted Code For Taking Options In The cssProps array
							 * and converting them to child nodes in the param.    
							 */
						?>     
						<?php foreach($params as $key => $options): ?> 
							<?php if(is_array($options)): ?>   
								<<?php echo $options['plural-type']; ?>>   
								<?php foreach($options['values'] as $key => $value): ?>    
								    <<?php echo $options['type']; ?> <?php foreach($value as $key => $attr): ?> <?php echo $key; ?>="<?php echo $attr; ?>"<?php endforeach; ?>>   
										<?php echo $key; ?>   							 
									</<?php echo $options['type']; ?>> 
								<?php endforeach; ?>
								</<?php echo $options['plural-type']; ?>>
							<?php endif; ?> 
						<?php endforeach; ?>
					</param>   
				<?php  
				$xmlOutStr .= ob_get_clean();
			}       
			
			else 
			{  
				$error = 'CSS Param' . $cssParam->attributes()->name . 'is Not Defined In Config';
				echo $error;
			}          
		}   		
	   	$xmlOutStr .= "</params>";     
		$xmlReturn = simplexml_load_string($xmlOutStr);
		return $xmlReturn;     
	}   

// ------------------------------------------------------------------------ 

    /**
     * Returns A Keyed Array Of The CSS Params       
	 *
     * TODO: Options Limiting 
     * @param array $options An Array of Options To Get The Params From. Optional
     * @return array    
     **/   
    function getAllCSSParams($options = null)  
	{
		$returnParams = array();
		
		if($options == null)
		{   
			$params = $this->configXML->xpath("//cssparam"); 			
			foreach($params as $key => $param)
			{   
				$name = (string) $param[0]->attributes()->name;
				if(empty($param->value)) 
				{
					$value = (string) $param[0]->attributes()->default;            
					
				}  else {  $value = (string) $param->value; }  
				
				$returnParams[$name] = $value;         
			} 
		   $returnParams = cleanArray($returnParams); 
		   return $returnParams;
		}
		
		else
		{
		    if(!is_array($options))
			{
				$options = array($options);
			} 
			return "Option Limiter Not Completed. Coming Soon"; 
		}
	}   
	    
//** Params **//	       
// ------------------------------------------------------------------------ 

    /**
     * Prints A Set of Params or Multiple Sets Of Params.
     *  
     * @param array $options An Array of Options To Get The Params From. 
     * @return obj
     **/    
	function printParamSet($options, $formClass = null, $returnObj = false)
	{
		$configOptions = $this->configXML->config->options; 
	    $optionsXML = array();       
	    $optionsReturn = array();     

		if(!is_array($options))
		{
			$options = array($options);
		}     
		
		foreach($options as $key => $option)
		{   
		   $optionObj = $this->configXML->xpath("//optionset[@name = '$option']"); 
		   $optionsXML[$option] = $optionObj; 
		} 
		
		foreach($optionsXML as $key => $option)
		{    
			if($returnObj == true) ob_start();       
			
			$formClass = $formClass . ' option-admin-form';
			echo $this->openAdminForm($formClass);        
			
			foreach($option[0]->param as $param)  
			{
				$this->printParam($param->attributes()->name);      
			} 
			
			$submitData = array('class' => 'local_submit');   
		    $resetData = array('class' => 'local_reset');   
		
		    echo formSubmit($submitData);  
			echo formReset($resetData);
			echo formClose();     
			
			if($returnObj == true) 
			{  
				$optionsObj = ob_get_clean();
				$optionsReturn[$key] = $optionsObj;   
			}
		}    

		if($returnObj == true) return $optionsReturn;  
	}   
	
// ------------------------------------------------------------------------ 

    /**
     * Short But Sweet function that returns a keyed array of all the params and their value.
     *  
     * @param array $options An Array of Options To Get The Params From. Optional   
	 * @param bool  $multiParam If param is array it will split up these values and return multiple params
     * @return array
     **/   
    function getAllParams($options = null, $multiParam = false)
	{    
		$returnParams = array();
		
		if($options == null)
		{   
			$params = $this->configXML->xpath("//param");  
			
			foreach($params as $key => $param)
			{           
				
				$name = (string) $param->attributes()->name;  
				$value =  $this->getParam($name);   
				if($multiParam == true AND is_array($value)) 
				{                        
					foreach($value as $key => $val)
					{   
						if(is_numeric($key))
						{
							$newName = $name . '_' . $val;  
						}  
						else { $newName = $name . '_' . $key; }  
						
						$returnParams[$newName] = $val;
					} 
				}        
				
				else { $returnParams[$name] = (string) $value; }
			}    
			   
		   return $returnParams;
		}       
		
		else
		{
		   	if(!is_array($options))
			{
				$options = array($options);
			}
			
			foreach($options as $key => $option)
			{   
			   $optionObj = $this->configXML->xpath("//optionset[@name = '$option']"); 
			   $optionsXML[$option] = $optionObj; 
			}   
			
			foreach($optionsXML as $key => $option)
			{
				$params = $this->configXML->xpath("//optionset[@name = '$key']/*");  
          
				foreach($params as $key => $param)
				{   
					$name = (string) $param->attributes()->name;  
					$value = (string) $this->getParam($name); 
					if($multiParam == true AND is_array($value)) 
					{
						foreach($value as $key => $val)
						{   
							if(is_numeric($key))
							{
								$newName = $name . '_' . $val;  
							}  
							else { $newName = $name . '_' . $key; }  

							$returnParams[$newName] = $val;
						} 
					} 
					else { $returnParams[$name] = $value; }      
				}    

			   $returnParams = cleanArray($returnParams); 
			   return $returnParams;
			}
		}
	}  
	
// ------------------------------------------------------------------------ 

    /**
     * Prints a Param or params.  
     *
     * @paaram mixed $params The param or params to print.
     * @return void
     **/   
	function printParam($params) 
	{   
		$magic =& get_instance();      

		if(!is_array($params))
		{
			$params = array($params);
		}

		foreach($params as $param)
		{
			$paramObj = $this->configXML->xpath("//param[@name = '$param']"); 
			$paramObj = $paramObj[0];
		    $paramType = $paramObj->attributes()->type;    
		    $$paramType = $paramType;
			$paramCreateCallback = 'param_' . $paramType . '_create';
		    if(function_exists($paramCreateCallback))   
			{
				echo call_user_func($paramCreateCallback, $paramObj);
			} else { echo $magic->admin->{$paramType}->create($paramObj); }  
		}
	}  

// ------------------------------------------------------------------------ 

    /**
     * Gets a param's value.  
     *
     * @param mixed $params The param or params to get.   
     * @return void
     **/   
	function getParam($params) 
	{   
		$magic =& get_instance();

		if(!is_array($params))
		{
			$params = array($params);
		}

		foreach($params as $param)
		{
			$paramObj = $this->configXML->xpath("//param[@name = '$param']");  
			$paramType = $paramObj[0]->attributes()->type;    
		    $$paramType = $paramType;

			if(method_exists($magic->admin->{$paramType}, 'get'))
			{   
				$paramVal = $magic->admin->{$paramType}->get($this->configXML, $paramObj); 
			}   

			else
			{
				$paramVal = $paramObj[0]->value;
			}   
             
		   return $paramVal;
	    }
	}     
	
//** General Admin Functions -- Forms Etc **//   
// ------------------------------------------------------------------------      

	/**
	 * Prints a Global Form Reset and Global Save.
	 *
	 * @return obj
	 *
	 **/
	function multiAdminFormClose()
	{   
		ob_start();
		?>   
		<div class="save_all_wrap"><a href="#" class="save_all">Save All Changes</a></div>  
		<div class="reset_all_wrap"><a href="#" class="reset_all" title="This will not reset to defaults, it only clears the form">Reset All Changes</a></div>  
		<?php
		echo ob_get_clean();    
	}    
    
// ------------------------------------------------------------------------ 

    /**
     * Closes an Admin Form.   
     *
     * @return void
     **/
    function closeAdminForm($class = null, $savePath = null)        
    {      
		$submitData = array('class' => 'local_submit');   
	    $resetData = array('class' => 'local_reset');   
	    echo formSubmit($submitData);  
		echo formReset($resetData);
    }

// ------------------------------------------------------------------------ 

    /**
     * Opens an Admin Form.   
     *
     * @return void
     **/
    function openAdminForm($class = 'option-admin-form', $savePath = null)        
    {      
		if($savePath == null) $savePath = '?tmpl='. 'save-params';
		else { $savePath = '?tmpl=' . $savePath; }   

		ob_start();         
		?>  
		<div id="user-message" style="display:none;"></div>
		<?php         
		echo ob_get_clean();
		$formAttrs = array('class' => "$class");
		echo formOpenMultipart($savePath, $formAttrs);
    }  

// ------------------------------------------------------------------------ 

    /**
     * Adds The Admin Form JS.
     *
     * @return void
     **/
    function _adminFormJS($savePath = null)
    {    
	    // Only Run This Once;  
	    $run = false;   
	    
		if($run == true) return;
	
		$document =& JFactory::getDocument();  
		     
		$jsonPath = FRAMEWORKURLPATH . '/media/js/jquery.json.min.js';  
		$serializerPath =  FRAMEWORKURLPATH . '/media/js/serializer.js'; 
		$jsToolsPath =  FRAMEWORKURLPATH . '/media/js/jquery.tools.min.js';      
		$adminJSPath =  FRAMEWORKURLPATH . '/media/js/admin.js'; 
		
		$document->addScript($jsonPath);          
		$document->addScript($serializerPath);
		$document->addScript($jsToolsPath);  
		$document->addScript($adminJSPath);
  
		ob_start();
		?>       
		jQuery("#user-message").overlay({ 
		    top: 92, 
		    expose: { 
		        color: '#fff', 
		        loadSpeed: 200, 
		        opacity: 0.5 
		    }, 
		    closeOnClick: true, 
		    api: true 

		});
		       
		jQuery(".option-admin-form").submit(
			function() {      
		    var actionForm = jQuery(this).attr('action');
			var data = jQuery.toJSON(jQuery(this).serializeObject());
			var formName = jQuery(this).attr("name");
			jQuery.post( actionForm, {
			action: "save-params", 
			formName: formName,
			data: data },
			function(response) { 
				jQuery('#user-message').empty();
				jQuery('#user-message').append('<div class="response">' + response + '</div>'); 
				if(jQuery('#user-message:hidden')) {
					jQuery('#user-message').overlay().load();  
				}
				return false;   
			});
			return false; }
		 );  
		
		<?php
		$adminFormDeclare = ob_get_clean(); 
		$adminFormDeclare =  domReady($adminFormDeclare); 
		$document->addScriptDeclaration($adminFormDeclare);      
		 
		$run = true;
	}   
	   
//** Saves **//	
// ------------------------------------------------------------------------ 

    /**
     * Saves a Core Config Value 
     *
     * @param mixed $saveData The data to save.
     * @return void
     **/ 
	function saveCoreConfig($saveData)  
	{   
		   
		foreach($saveData as $key => $config) 
		{
			$configObj = $this->coreConfigXML->xpath("//setting[@name = '$key']");   
		    $configObj[0]->value = $config;         
		}      
		
		$configSave = $this->coreConfigXML->asXML(); 

		JFile::write($this->coreConfigPath, $configSave);
	    echo 'Core Options Have Been Saved. Please Refresh';
	}
	
// ------------------------------------------------------------------------ 

    /**
     * Saves a param or params
     *
     * @param mixed $saveData The data to save.
     * @return void
     **/   
	function save($saveData, $value = null) 
	{   
		$magic =& get_instance();  
		
		if(empty($saveData)) 
		{
			 return 'Empty Save Data'; 
		}
		
	    if(is_string($saveData))
		{   
			$saveData2 = array();
			$saveData2["$saveData"] = $value; 
			$saveData = $saveData2;
		}  

		foreach($saveData as $key => $param)
		{
			$paramObj = $this->configXML->xpath("//param[@name = '$key']");       
			$paramType = $paramObj[0]->attributes()->type;       
		    $$paramType = $paramType;
     
			if(method_exists($magic->admin->{$paramType}, 'save'))
			{   
				$paramObj = $magic->admin->{$paramType}->save($paramObj, $param);
			}   
			   
			else
			{  
				$paramObj[0]->value = $param;   
				$paramObj[0]->description = $paramObj[0]->description;
			}                 
		}  
		
		$configSave = $this->configXML->asXML();
		JFile::write($this->configPath, $configSave);
		
		echo 'Options Have Been Saved';
	}  
	
// ------------------------------------------------------------------------ 

    /**
     * Saves a Some CSS Params 
     *
     * @param mixed $saveData The data to save.
     * @return void
     **/   
	function saveCSSParams($saveData) 
	{   

		foreach($saveData as $key => $param)
		{                                               
			$names = explode("_-", $key);   
			$optionName =  $names[0];      
			$paramType = $names[1];  
			$paramObj = $this->configXML->xpath("//cssoptionset[@name = '$optionName']/group/cssparam[@type = '$paramType']");
		    $paramObj[0]->value = $param;   
		}         
		
		$configSave = $this->configXML->asXML();
		JFile::write($this->configPath, $configSave);
		echo 'CSS Options Have Been Saved';
	}   
		  
// ------------------------------------------------------------------------ 

    /**
     * Saves a Uploaded File  
     *
     * @param string $paramName The name of the param
     * @return void
     **/   
	function saveFileUpload($paramName) 
	{   
		$magic =& get_instance();
		  
		$paramObj = $this->configXML->xpath("//param[@name = '$paramName']");       
		$paramType = $paramObj[0]->attributes()->type;       
	    $$paramType = $paramType;

		if(method_exists($magic->admin->{$paramType}, 'save'))
		{   
		   $magic->admin->{$paramType}->save($paramObj, $paramName);
		}   

		else
		{         
			$paramObj[0]->value = $_FILES[$paramName]['name'];   
			$paramObj[0]->description = $paramObj[0]->description;  
			
			$uploaddir = MEDIAPATH . DS .$paramObj[0]->attributes()->folder;
			$uploadfile = $uploaddir . DS . basename($_FILES[$paramName]['name']);

			if (move_uploaded_file($_FILES[$paramName]['tmp_name'], $uploadfile))
			{ 
				$configSave = $this->configXML->asXML();
				JFile::write($this->configPath, $configSave);
				return $_FILES[$paramName]['name'];
			} 
			else
			{
				echo "Upload Failed";
			}
		}       
	}    
}