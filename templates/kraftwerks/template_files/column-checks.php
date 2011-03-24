<?php   

function leftColCheck()
{
	if(!module('left')) { return false; }
	else { return true; }
}    

function rightColCheck()
{
	if(!module('right')) { return false; }
	else { return true; }
}     

function centerColCheck()
{
	  return true; 
}    

function user5ColCheck()
{
	if(module('user5')) { return true; }
	else { return false;}
}      
    
function userModsColCheck()
{    
	$magic =& get_instance();
	
	if(modules($magic->tconfig->userMods6_8) OR modules($magic->tconfig->userMods9_10) OR modules($magic->tconfig->userMods11_14))
	{
		return true;
	}  else { return false; }
}
