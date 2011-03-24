<?php   

// The FrontPage On Off Function
if(!function_exists('isFrontPage'))  
{   
	function isFrontPage()
	{  
		$magic =& get_instance();
		$frontpageParam = (string) $magic->admin->getParam('frontpage'); 
		$currentCom = $magic->joomla->currentComponent;
		 
		if(!isHome())
		{
			return true;
		}    
		if(isHome() AND $frontpageParam == 'true') 
		{ return true; }            
		elseif (isHome() AND in_array($currentCom, $magic->tconfig->excludedComsFront))
		{
			return true;
		}
		elseif (isHome()  AND $frontpageParam == 'false') 
		{ return false; }
		else { return true; }
	}
}
