jQuery(document).ready(function(){

var flip = 0;
	
    jQuery('#toggle-config-bar').click(function(){
    	if(flip == 0){
    		flip = 1;
    		jQuery('#config-bar').slideUp(350);
    		jQuery(this).text('Open [+]');  
    		jQuery(this).animate({'top': 0}, 350);      
    		
    		  
    	} else {
    		flip = 0;
    		jQuery('#config-bar').slideDown(350);
    		jQuery(this).text('Close [-]');  
    		jQuery(this).animate({'top': 49}, 350);      
    	}
    }); 
    
    
     /*   var nextGuyPosition = jQuery('.toggle-config-wrap').next().css('position');  
       if(nextGuyPosition == 'fixed')
       {
           jQuery('.toggle-config-wrap').next().css({'top' : '0px'});

           if(jQuery('#editor_sidebar'))
           {
               var currentTop = jQuery('#editor_sidebar').css('top');    
               var newTop = currentTop - 48;     
               newTop = newTop + 'px';   
               jQuery('#editor_sidebar').css({'top' : newTop + 'px'});
           }
       }   */
     
});   


