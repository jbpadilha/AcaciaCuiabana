jQuery(document).ready(function(){
    
    jQuery("ul.dropdown").lavaLamp({
    	fx: 'easeInCirc',
    	speed: 200,
    	click: function() {return true;},
    	setOnClick: false,
        startItem: 1
    });


    jQuery('ul.dropdown').superfish();    
});  


/*
 * Mootools Scripts
 * Vertical Menu Hover effect
 */

window.addEvent('domready', function(){

	var vMenu = $$('ul.vertmenu li');
	
	vMenu.each(function(l,i){
	
		var lSize = l.getSize();

		var bg = new Element('div',{
			'styles':{
				'display':'none',
				'position':'absolute',
				'height':  lSize.size.y + 'px',
				'width': lSize.size.x + 'px',
				'margin-top': -lSize.size.y + 'px'
			}
		});

		bg.addClass('vMenuBg');

		(l.getFirst()).setStyles({'position':'relative','z-index':20});
		bg.setStyles({'z-index':10});

		bg.injectInside(l);

		var fx = new Fx.Styles(bg, {duration: 200, transition: Fx.Transitions.linear});

		l.addEvent('mouseenter',function(){

			bg.setStyles({'display':'block','opacity':1});

		});

		l.addEvent('mouseleave',function(){

			fx.start({'opacity':0});

		});


	});
	
});

