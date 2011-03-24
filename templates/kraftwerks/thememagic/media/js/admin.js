jQuery(document).ready(function(){   
    var stack = {
            delay: 1000,
            actions:[],
            run: function() {
                    if (stack.actions.length) {
                            stack.actions.shift()();
                            setTimeout(stack.run, stack.delay);
                    }
            }
    };
    
    jQuery('.save_all').click(function() {
        jQuery('.option-admin-form').each(function(){   
            var elem = this;             
            stack.actions.push(function(){
                    jQuery(elem).trigger('submit');
            });   
        });
        stack.run();   
    });         
    
    jQuery('.reset_all').click(function() {
        jQuery('.option-admin-form').each(function(){
            jQuery(this).trigger('reset'); 
        });
    });  
});