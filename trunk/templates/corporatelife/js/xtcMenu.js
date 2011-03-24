/*
 * WordpressXTC MooMenu JavaScript
 * WXTC MooMenu
 * All Rights Reserved to Monev Software LCC
 */

function xtcMenu(container, menuClass, sp, del, a, tr, afps, cnt, ali){
	var topmenu;
	if(container === null) { topmenu = $(document.body); }
	else { topmenu = $(container); }
	
	if( !$defined(tr) ) { tr = new Fx.Transition(Fx.Transitions.Quint.easeInOut); }
	if( !$defined(afps) ) {afps = 50; }
	if( !$defined(cnt) ) { cnt = false; }
	if( !$defined(del) ) { del = 0; }
	
  if(topmenu) {
  	var menus = topmenu.getElements('ul.' + menuClass);
  	
  	menus.each(function(menu){
      var menu_lis = menu.getElements('li');
      var uMain = menu.getCoordinates();
          
  		menu_lis.each(function(l,i){
  			var u = l.getElement('ul');
  			if(u) {
  				/* u.setStyles({'visibility':'visible'}); */
  				if(menu.hasClass('suckerfish')) { u.addClass('suckerfish'); }
					if(menu.hasClass('dualfish')) { u.addClass('dualfish'); }
					if(menu.hasClass('dropline')) { u.addClass('dropline'); }
  				
  				var uLevel = ((u.getParent()).getParent()).hasClass(menuClass);
  				var fx = new Fx.Styles(u, { duration: sp, wait:false, transition: tr, fps: afps } );
  				var uDim = u.getCoordinates([menu]);
  				var uh = uDim.height;
  				var mAnimIn;
  		    var mAnimOut;
  		      		    
  		    /* IF 1st level dropdown */
  		    if(uLevel) {
  		    	if (window.ie){ uDim.left = u.getBoundingClientRect().left; }
  		    	//if( (uMain.left + uMain.width) < (uDim.left + uDim.width) ) { u.setStyles({'right': 0 + 'px'}); }
  		    	if(cnt) {
  		    		if( l.getSize().size.x <= uDim.width ) {
  		    			u.setStyles({'margin-left': ((l.getSize().size.x - uDim.width)/2) + 'px'});
  		    		} 
  		    		else {
  		    			u.setStyles({'margin-left': ((uDim.width - l.getSize().size.x)/2) + 'px'});
  		    		}
  		    		uDim = u.getCoordinates([menu]);
  		    	}
  		    	if( ali && (uMain.left + uMain.width) < (uDim.left + uDim.width) ) { u.setStyles({'right': 0 + 'px', 'margin-left': 0 + 'px'}); }
  		    	if( ali && (uMain.left) > (uDim.left) ) { u.setStyles({'left': 0 + 'px', 'margin-left': 0 + 'px'}); }


  		    /* IF 2nd or deeper dropdown */
  		    }else {
  		    	if (window.ie){ uDim.left = u.getBoundingClientRect().left; }
  		    	if(ali) {
  		    		if( (uMain.left + uMain.width) < (uDim.left + uDim.width) ) { u.setStyles({'left': -uDim.width + 'px'}); }
  		    	}
  		    }
  		    
  		    /* u.addClass('xtcHide'); */
  		      				
  				switch(a) {
  					case 'h':
  						u.setStyles({'height':'0px'});
  						mAnimIn = {'height': uh + 'px'};
  						mAnimOut = {'height': 0 + 'px'};
  					break;
  					
  					case 'f':
  						u.setStyles({'opacity':0});
  						mAnimIn = {'opacity': 1};
  						mAnimOut = {'opacity': 0};
  					break;
  					
  					case 'hf':
  						u.setStyles({'height':'0px', 'opacity':0});
  						mAnimIn = {'height': uh + 'px', 'opacity': 1};
  						mAnimOut = {'height': 0 + 'px', 'opacity': 0};
  					break;
  				}
  				
  				var timer;
  				l.addEvent('mouseenter', function(){
  					l.addClass('xtcHover');
  					if(window.ie7) { u.setStyle('display', 'block'); }
  					timer = $clear(timer);
  					fx.stop();
  					fx.start(mAnimIn);
  				});
  				
  				l.addEvent('mouseleave', function(){
  					timer = (function(){
  						fx.start(mAnimOut).chain(function(){
    						l.removeClass('xtcHover');
    						if(window.ie7) { u.setStyle('display', 'none'); }
    					})
  					}).delay(del);	
  				});
  				
  			}/* If there is submenu */
  			
  		});
  		
  	});/* if(menu) END */
  }/* if(topmenu) END */
}