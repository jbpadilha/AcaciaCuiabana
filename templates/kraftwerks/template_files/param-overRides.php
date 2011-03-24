<?php         

/**
 * Over-rides For The Paramaters
 */
  

function param_onOff_create($param)
{   
	$magic =& get_instance();
	
	// Setup the Params Default Value.
    if(empty($param->value))
	{ 
		$paramValue = $param->attributes()->default;  
	} else { $paramValue = $param->value; }
	
	// Setup Form Attributes      
    $paramName = $param->attributes()->name;   
   
	$magic->admin->onOff->_genJS($param, $paramValue);
	 
	ob_start();
	?>      
	<div class="group-box-wrap">       
		<div class="param onOff section group-box">    
			<h3 class="heading group-box-heading"><?php echo $param->attributes()->label;?></h3>  
			<div class="option group-box-content">     
				<p class="explain desc">    
					<?php echo $param->description; ?>
				</p>
			   <div class="controls">     
				  	<div id="radio-wrap-<?php echo $paramName;?>">
						<label for="<?php echo $paramName;?>-radio" class="on-off-radio">
							<input type="radio" value="<?php echo $paramValue;?> " name="" id="<?php echo $paramName;?>-radio" class="on-off-radio">
						</label>   
					</div>  
					<input type="hidden" value="<?php echo $paramValue;?> " name="<?php echo $paramName;?>" id="<?php echo $paramName;?>" class="actual-value">
			   </div>      
			</div>
		</div>       
	</div>
	<?php
	echo ob_get_clean();
}
 
function param_textInput_create($param)
{
	// Setup the Params Default Value.
    if(empty($param->value))
	{ 
		$paramValue = $param->attributes()->default;  
	} else { $paramValue = $param->value; }
	      
	$paramName = $param->attributes()->name; 
	// Setup Form Attributes  
	$data = array(    
		 'name'   => "$paramName",
		 'value'  => "$paramValue"
	);
	 
	ob_start();
	?> 
	<div class="group-box-wrap">       
		<div class="param textInput section group-box">    
			<h3 class="heading group-box-heading"><?php echo $param->attributes()->label;?></h3>  
			<div class="option group-box-content">    
	  			<p class="explain desc">    
					<?php echo $param->description; ?>
				</p>    
			   <div class="controls">     
				   <?php echo formInput($data);  ?>
			   </div>      
			</div>
		</div>   
	</div>
	<?php
	echo ob_get_clean();
}

function param_fileSelect_create($param)
{        
		
	// Setup the Params Default Value.
	   if(empty($param->value))
	{ 
		$paramValue = $param->attributes()->default;  
	} else { $paramValue = $param->value; }         

	$ext = $param->attributes()->ext;                          
	$filesdir  = MEDIAPATH . DS . $ext . DS . $param->attributes()->folder . DS ; 
	$filesFiles = getFilenames($filesdir);  
	$fileslist = array();     
	$ext = '.' . $ext;   
			
	foreach($filesFiles as $key => $file)  
	{
		if(strpos($file, $ext))
		{
			array_push($fileslist, $file);  
		}  
	}       
	
	foreach($fileslist as $key => $file)
	{  
		$fileslist[$file] = $file;
		unset($fileslist[$key]);
	}
	
	    
	ob_start();
	?>
	<div class="group-box-wrap">       
		<div class="param fileSelect section group-box">    
			<h3 class="heading group-box-heading"><?php echo $param->attributes()->label;?></h3>  
			<div class="option group-box-content">  
				<p class="explain desc">    
					<?php echo $param->description; ?>
				</p>
			   <div class="controls">
				   <?php echo formDropdown($param->attributes()->name, $fileslist, $paramValue); ?>    
			   </div>      
			</div>
		</div> 
	</div>   
	<?php
	echo ob_get_clean();     
}    

function param_imgSelect_create($param)
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
	<div class="group-box-wrap">       
		<div class="param imageSelect section group-box">    
			<h3 class="group-box-heading"><?php echo $param->attributes()->label;?></h3>  
			<div class="option">  
				<p class="desc explain">    
					<?php echo $param->description; ?>
				</p>
			   <div class="controls">
				   <?php echo formDropdown($param->attributes()->name, $imageslist, $paramValue); ?>    
			   </div>      
			</div>
		</div>  
	</div>
	<?php
	echo ob_get_clean();  
}

function param_fontFamily_create($param)
{                           
	
	$cssAdminConfigPath = FRAMEWORKPATH . DS . 'config' . DS . 'CSS_Config.php';    
	require($cssAdminConfigPath);      
	
	$fontsList = $cssFontFamilies;
	
	// Setup the Params Default Value.
    if(empty($param->value))
	{ 
		$paramValue = $param->attributes()->default;  
	} else { $paramValue = $param->value; }
	
	ob_start();
	?> 
	<div class="group-box-wrap">           
		<div class="param fontFamily section group-box">    
			<h3 class="group-box-heading"><?php echo $param->attributes()->label;?></h3>  
			<div class="option">  
				<p class="explain desc">    
					<?php echo $param->description; ?>
				</p>
			   <div class="controls">     
				   <?php echo formDropdown($param->attributes()->name, $fontsList, $paramValue); ?>    
			   </div>      
			</div>
		</div>   
	</div>
	<?php
	echo ob_get_clean();
}