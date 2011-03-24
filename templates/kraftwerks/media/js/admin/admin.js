jQuery(document).ready(function() {        
                                     
    jQuery('a#editor_sidebar_toggle').click(function(){
		if(jQuery('#editor_sidebar').hasClass('collapsed')){
			jQuery('#editor_sidebar').animate({left: 0}, 750);   
			jQuery('#editor_sidebar_container').animate({'margin-left': 308}, 750);
			jQuery('#editor_sidebar').removeClass('collapsed');
		} else {
			jQuery('#editor_sidebar').animate({left: -308}, 750);    
			jQuery('#editor_sidebar_container').animate({'margin-left': 0}, 750);
			jQuery('#editor_sidebar').addClass('collapsed');
		}
	}); 
	
    jQuery("#sidebar_accordion").tabs("#sidebar_accordion div.pane", {tabs: 'h2', effect: 'slide', initialIndex: null});
                            
	jQuery('#sidebar_accordion .scrollpane').jScrollPane();     
	jQuery('#sidebar_accordion div.pane').hide();     
	
});
