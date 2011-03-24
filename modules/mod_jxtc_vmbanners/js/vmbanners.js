/*
	JoomlaXTC VMBanner Effect

	version 1.1
	
	Copyright (C) 2009 Monev Software LLC. All Rights Reserved.
	
	THIS PROGRAM IS NOT FREE SOFTWARE
	
	You shall not modify, copy, duplicate, reproduce, sell, license or
	sublicense the Software, or transfer or convey the Software or
	any right in the Software to anyone else without the prior
	written consent of Developer; provided that Licensee may make
	one copy of the Software for backup or archival purposes.
	
	www.joomlaxtc.com
	
	See COPYRIGHT.php for copyright notices and details.
*/
function vmbanners(id, type, direction, infoxy, infow, wd, hg, sp, layer, tf, tc, df, dc){

	var ff = 'sans-serif';
	var fs = '3';
	var fc = '#ffffff';
	var ff2 = 'sans-serif';
	var fs2 = '2';
	var fc2 = '#ffffff';
	var pp = '19';
	
  var idx = $(id);
  var vmbanner = idx.getElements('div[class=vmbanner]');

//  var vmbanner = $$('.vmbanner');
  vmbanner.setStyles({'height':'0px', 'display':'none'});
  var repeat;
	var i = 0;
	var j = 1; 

  
	switch (type) {
	case 'fade':  top1 = 0; left1 = 0; top2 = 0; left2 = 0; break;
	case 'slideHor': top1 = 0; left1 = 0; top2 = 0; left2 = wd + 0; break;
	case 'slideVer': top1 = 0; left1 = 0; top2 = hg; left2 = 0; break;
	}

	var dix = $(id);
  dix.setStyles({'overflow': 'hidden', 'position': 'relative', 'padding':'0px'});
  
	var div = new Element('div',{
			'styles':{
			'position':'absolute',
			'width': wd + 'px',
			'height': hg + 'px',
			'top': top1 + 'px',
			'left': left1 + 'px'
			}
	});
	
	var div2 = new Element('div',{
			'styles':{
			'position':'absolute',
			'width': wd + 'px',
			'height': hg + 'px',
			'top': top2 + 'px',
			'left': left2 + 'px'
		}
	});
	
	var box = new Element('div',{
			'styles': {
      'display': 'block',
			'overflow': 'hidden',
			'position': 'relative',
			'top': '0px',
			'width': wd + 'px',
			'height': hg + 'px',
			'z-index': layer
			}
  });
  
  fs = (hg / 20);
  if (fs < 10) fs = 10;
  var info = new Element('div',{
			'styles': {
      'display': 'block',
      'overflow': 'hidden',
			'position': 'absolute',
			'width': wd + 'px',
			'padding': '19px',
			'padding-top': '10px',
		  'font-weight': 'bold',
      'font-size': fs +'px',
			'font-family': 'Arial',
      'background-image': 'url(modules/mod_jxtc_vmbanners/images/infobackground.png)',
			'z-index': layer + 12
			}
  });

  var fxinfo = new Fx.Styles(info, {duration:800, wait:false});
         
	box.injectInside(dix); 
  info.injectInside(box);
	div.injectInside(box);
	div2.injectInside(box); 


	if(type=='fade'){
	var loop = function(){
  
			var fx2 = new Fx.Styles(div2, {fps: 100, duration:(sp/2), wait:false});
			var fx = new Fx.Styles(div2, {fps: 100, duration:sp, wait:false});
			var htmlC = '<div class="title">' + vmbanner[j].getAttribute('title') + '<div class="description">' + vmbanner[j].getAttribute('rev') + '</div></div>';
      
			div.setHTML(vmbanner[i].innerHTML);
			div2.setHTML(vmbanner[j].innerHTML);
			info.innerHTML = htmlC;

      var ihg = info.getStyle('height').toInt();
        
      if(infoxy=='bottom'){
      info.setStyle('left', '0px');
      info.setStyle('bottom', -ihg + 'px');
      fxinfo.start({'bottom': '0px'});
      } 
      
      if(infoxy=='top'){
      info.setStyle('left', '0px');
      info.setStyle('top', -ihg + 'px');
      fxinfo.start({'top': '0px'});
      }
      
      if(infoxy=='right'){
      info.setStyle('bottom', '0px');
      info.setStyle('width', infow + 'px');
      info.setStyle('height', hg - 20 + 'px');
      info.setStyle('left', wd + 'px');
      fxinfo.start({'left': wd - (infow + 38) + 'px'});
      } 
      
      if(infoxy=='left'){
      info.setStyle('bottom', '0px');
      info.setStyle('width', infow + 'px');
      info.setStyle('height', hg - 20 + 'px');
      info.setStyle('left', -wd + 'px');
      fxinfo.start({'left': '0px'}); 
      }
      
			div2.setStyle('opacity',0);

			fx2.start({'opacity': 1}).chain(function(){
        div.setHTML(vmbanner[i].innerHTML);
				fx2.start({'opacity': 0}).chain(function(){
					fx2.start('opacity',1).chain(function(){
					});
				});
			});



//FADE TO BLACK MODE
/*
			fx2.start({'opacity': 1}).chain(function(){
        fx.start({'opacity': 1}).chain(function(){
          div.setHTML(vmbanner[i].innerHTML);
            fx2.start({'opacity': 0}).chain(function(){
              fx2.start({'opacity':1}).chain(function(){
              });
            });
				});
			});
*/			
			i++;
			j++;
			if(i>vmbanner.length-1){i=0;}
			if(j>vmbanner.length-1){j=0;}
	}
	var timex = sp*2;
	}





	if(type=='slideHor'){
	var loop = function(){

			var fx = new Fx.Styles(div, {fps: 100, duration:800, wait:false});
			var fx2 = new Fx.Styles(div2, {fps: 100, duration:800, wait:false});
			var fxA = new Fx.Styles(div, {fps: 100, duration:sp, wait:false});
      var htmlC = vmbanner[j].getAttribute('title') + 
        '<div class="description">' + vmbanner[j].getAttribute('rev') + '</div>';
 			
      info.setHTML(htmlC);
      var ihg = info.getStyle('height').toInt();
      
      if(infoxy=='bottom'){
      info.setStyle('left', '0px');
      info.setStyle('bottom', -ihg + 'px');
      fxinfo.start({'bottom': '0px'});
      } 
      
      if(infoxy=='top'){
      info.setStyle('left', '0px');
      info.setStyle('top', -ihg + 'px');
      fxinfo.start({'top': '0px'});
      }
      
      if(infoxy=='right'){
      info.setStyle('bottom', '0px');
      info.setStyle('width', infow + 'px');
      info.setStyle('height', hg - 20 + 'px');
      info.setStyle('left', wd + 'px');
      fxinfo.start({'left': wd - infow + 'px'});
      } 
      
      if(infoxy=='left'){
      info.setStyle('bottom', '0px');
      info.setStyle('width', infow + 'px');
      info.setStyle('height', hg - 20 + 'px');
      info.setStyle('left', -wd + 'px');
      fxinfo.start({'left': '0px'}); 
      }
      
      if(direction=='RightLeft'){
      	div.setHTML(vmbanner[i].innerHTML);
        div2.setHTML(vmbanner[j].innerHTML); 
        
        div.setStyle('left',0);
        div2.setStyle('left', wd + 0); 
      
        fx.start({'left': -(wd + 0)}).chain(function(){
          fxA.start({});
        });

        fx2.start({'left': 0}).chain(function(){
          fxA.start({});
        });
			}
      
      if(direction=='LeftRight'){
      	div.setHTML(vmbanner[j].innerHTML);
        div2.setHTML(vmbanner[i].innerHTML); 
      
        div.setStyle('left', -(wd + 0));
        div2.setStyle('left', 0); 
      
        fx.start({'left': 0}).chain(function(){
          fxA.start({});
        });

        fx2.start({'left': wd + 0}).chain(function(){
          fxA.start({});
        });
			}
      
      i++;
			j++;
			if(i>vmbanner.length-1){i=0;}
			if(j>vmbanner.length-1){j=0;}
	}
	var timex = sp;
	}


	if(type=='slideVer'){
	var loop = function(){
			var fx = new Fx.Styles(div, {fps: 100, duration:800, wait:false});
			var fx2 = new Fx.Styles(div2, {fps: 100, duration:800, wait:false});
			var fxA = new Fx.Styles(div, {fps: 100, duration:sp, wait:false});
      var htmlC = vmbanner[j].getAttribute('title') + 
        '<div class="description" >' + vmbanner[j].getAttribute('rev') + '</div>';
      
      info.setHTML(htmlC);
      var ihg = info.getStyle('height').toInt();
      
      if(infoxy=='bottom'){
      info.setStyle('left', '0px');
      info.setStyle('bottom', -ihg + 'px');
      fxinfo.start({'bottom': '0px'});
      } 
      
      if(infoxy=='top'){
      info.setStyle('left', '0px');
      info.setStyle('top', -ihg + 'px');
      fxinfo.start({'top': '0px'});
      }
      
      if(infoxy=='right'){
      info.setStyle('bottom', '0px');
      info.setStyle('width', infow + 'px');
      info.setStyle('height', hg - 20 + 'px');
      info.setStyle('left', wd + 'px');
      fxinfo.start({'left': wd - infow + 'px'});
      } 
      
      if(infoxy=='left'){
      info.setStyle('bottom', '0px');
      info.setStyle('width', infow + 'px');
      info.setStyle('height', hg - 20 + 'px');
      info.setStyle('left', -wd + 'px');
      fxinfo.start({'left': '0px'}); 
      }
      
      if(direction=='BottomTop'){
      	div.setHTML(vmbanner[i].innerHTML);
        div2.setHTML(vmbanner[j].innerHTML);
      
        div.setStyle('top',0);
        div2.setStyle('top', hg + 0);

        fx.start({'top': -(hg + 0)}).chain(function(){
          fxA.start({})
        });

        fx2.start({'top': 0}).chain(function(){
          fxA.start({})
        });
			}
      
      if(direction=='TopBottom'){
      	div.setHTML(vmbanner[j].innerHTML);
        div2.setHTML(vmbanner[i].innerHTML);
      
        div.setStyle('top', -(hg + 0));
        div2.setStyle('top', 0);

        fx.start({'top': 0}).chain(function(){
          fxA.start({})
        });

        fx2.start({'top': hg + 0}).chain(function(){
          fxA.start({})
        });
			}
      
      
			i++;
			j++;
			if(i>vmbanner.length-1){i=0;}
			if(j>vmbanner.length-1){j=0;}
	}
	var timex = sp;
	}

	
	loop();
	repeat = loop.periodical(timex);
	return true;
}