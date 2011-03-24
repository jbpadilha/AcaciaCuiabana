// Login Popup
jQuery(document).ready(function(){
    
    jQuery("#login_popup").overlay({ 
        top: 92, 
        expose: { 
            color: '#fff', 
            loadSpeed: 200, 
            opacity: 0.5 
        }, 
        closeOnClick: true, 
        api: true 
    });      
   
    jQuery('form#form-login submit').click(function() { 
          jQuery(location).attr('href',url);   
    });

    jQuery('.login_open_wrap, #login_open').click(function(){
        jQuery('#login_popup').overlay().load();  
        jQuery('#user_pass').focus();
    });    
    
    
    // Fixes Scrolling Issue on FF 3.5 
    if(jQuery.browser.mozilla)  
    {
        jQuery('#nav_container ul li').hover(
            function () {
              jQuery('#nav_container').css({'overflow-y': 'visible'});
            },
            function () {
                jQuery('#nav_container').css({'overflow-y': 'hidden'});
            }
        );
    }


});

/* Footer JS */
window.addEvent('domready',function(){
  var panel = $('cart');
  if(panel){
    var panelH = panel.getSize().size.y;
    var slidefx = new Fx.Styles(panel,{duration:400,wait:false});
    
    var toggler = $('kraftwerks-bottom-panel-toggler');
    if (toggler) {
      var dir = true;
      toggler.addEvent('click', function(){
        if (dir) {
          slidefx.start({
            'height': '109px'
          });
          dir = false;
        }
        else {
          slidefx.start({
            'height': panelH + 'px'
          });
          dir = true;
        }
      });
    }
    
    var check = $('kraftwerks-checkout');
    if (check) {
      check.addEvent('click', function(e){
        new Event(e).stop();
        if (dir) {
          slidefx.start({
            'height': '200px'
          });
          dir = false;
        }
        else {
          slidefx.start({
            'height': panelH + 'px'
          });
          dir = true;
        }
      });
    }
    
  }
});




