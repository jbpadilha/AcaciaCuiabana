/*
jQuery(document).ready(function(){

    jQuery("#login_popup").overlay({
        top: 92,
        left: 680,
        expose: {
            color: '#000',
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

});



 * Mootools Template Scripts

function xtcLights(elClass, c1, c2){
	var lights = $$('.' + elClass);
	lights.each(function(l,i){
		l.setStyle('background-color', c2);
		var lfx = new Fx.Styles(l, {
			duration: 400,
			wait:false
		});
		l.addEvent('mouseenter', function(){
			lfx.start({'background-color':c1});
		});
		l.addEvent('mouseleave', function(){
			lfx.start({'background-color':c2});
		});
	});
}; */