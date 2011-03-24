<?php 
// no direct access
defined( '_JEXEC' ) or die( 'Restricted access' );

// ------------------------------------------------------------------------

/**
 * CSS Params. Provides An Associative Array associating a css property with the relevant param.
 * This Is used for the construction of css params; which will eventually, provide a full emulation of all
 * CSS properties.
 */  
$cssProps = array
( 
	'color' => array
	(    
		'type' => 'colorInput',
		'changes' => 'color',
		'label' => 'Color' 
	),   

	'background-color' => array
	(    
		'type' => 'colorInput',
		'changes' => 'background-color',
		'label'  => 'Background Color' 
	),  

	'font-size' => array
	(    
		'type' => 'sizer',
		'changes' => 'font-size', 
		'label' => 'Font Size' 
	), 
	
	'line-height' => array
	(    
		'type' => 'sizer',
		'changes' => 'line-height', 
		'label' => 'Line Height' 
	),     
	
	'letter-spacing' => array
	(    
		'type' => 'sizer',
		'changes' => 'letter-spacing', 
		'label' => 'Letter spacing' 
	),
	
	'text-transform' => array
	(    
		'type' => 'liveList',
		'changes' => 'text-transform', 
		'label' => 'Text Transform',
		'options' => array
		( 
			'Uppercase' => array
			(    
				'value' => 'uppercase',
				'name' => 'Uppercase'
			),   
			 
			'Lowercase' => array
			(    
				'value' => 'lowercase',
				'name' => 'Lowercase'
			),
		) 
	), 
	
	'font-weight' => array
	(    
		'type' => 'liveList',
		'changes' => 'font-weight', 
		'label' => 'Font Weight',
		'options' => array
		( 
			'Normal' => array
			(    
				'value' => 'normal',
				'name' => 'Normal'
			),   
			 
			'Bold' => array
			(    
				'value' => 'bold',
				'name' => 'Bold'
			),
		) 
	),  
	
	'text-decoration' => array
	(    
		'type' => 'liveList',
		'changes' => 'text-decoration', 
		'label' => 'Text Decoration',
		'options' => array
		( 
			'Normal' => array
			(    
				'value' => 'normal',
				'name' => 'Normal'
			),   
			 
			'Underline' => array
			(    
				'value' => 'underline',
				'name' => 'Underline'
			),
		) 
	),

	'font-family' => array
	(    
		'type' => 'fontFamily',
		'label' => 'Font' 
	),    

	'background-image' => array
	(    
		'type' => 'uploadImage',
		'changes' => 'background-image',
		'label'   => 'Background'
	),

); 

// ------------------------------------------------------------------------
    
/**
 * CSS Groups are a shorthand for creating css params. E.g adding a css group of "fonts" 
 * will create all font css params; color, font-size, font-famliy etc.
 */
$cssGroups = array
(   
	'fonts' => array
	(   
		'font-size',
	    'font-family',
	    'color',
	),
);            

$cssFontFamilies = array 
(  
   'Serif Fonts' => array
   (  
	    'Georgia'         => 'georgia, serif',
		'Times'           =>  'times, serif',
		'Times New Roman' => '"times new roman", serif',
   ),

   'Sans-Serif Fonts' => array 
   (    
		'Arial'          => 'arial, sans-serif',
		'Arial Black'    => '"arial black", sans-serif',
		'Arial Narrow'   => '"arial narrow", sans-serif',
		'Courier'        => 'courier, monospace',
		'Courier New'    => '"courier new", monospace', 
		'Gill Sans'      => '"gill sans", sans-serif',
		'Helvetica'      => 'helvetica, sans-serif',
		'Lucida Grande'  => '"lucida grande", sans-serif',
		'Tahoma'         => 'tahoma, sans-serif',
		'Trebuchet MS'   => '"trebuchet ms", sans-serif',
		'Verdana'        => 'verdana, sans-serif',
   )
); 

?>