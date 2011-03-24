/*
	JoomlaXTC jxtcpops 
	
	version 1.1
	
	Copyright (C) 2009  Monev Software LLC.
	
	All Rights Reserved.
	
	THIS PROGRAM IS NOT FREE SOFTWARE
	
	You shall not modify, copy, duplicate, reproduce, sell, license or
	sublicense the Software, or transfer or convey the Software or
	any right in the Software to anyone else without the prior
	written consent of Developer; provided that Licensee may make
	one copy of the Software for backup or archival purposes.
	
	Monev Software LLC
	www.joomlaxtc.com
*/

if (typeof jxtcpops != 'function') {
  
  /* Function: Transition Select */  
  if (typeof(transSel) == 'undefined') {
    function transSel(t, s){
      var tran;
      switch (t) {
        case 'linear':
          switch (s) {
            case 'easeIn':
              tran = new Fx.Transition(Fx.Transitions.linear).easeIn;
              return tran;
              break;
              
            case 'easeOut':
              tran = new Fx.Transition(Fx.Transitions.linear).easeOut;
              return tran;
              break;
              
            case 'easeInOut':
              tran = new Fx.Transition(Fx.Transitions.linear).easeInOut;
              return tran;
              break;
          }
          break;
          
        case 'Quad':
          switch (s) {
            case 'easeIn':
              tran = new Fx.Transition(Fx.Transitions.Quad).easeIn;
              return tran;
              break;
              
            case 'easeOut':
              tran = new Fx.Transition(Fx.Transitions.Quad).easeOut;
              return tran;
              break;
              
            case 'easeInOut':
              tran = new Fx.Transition(Fx.Transitions.Quad).easeInOut;
              return tran;
              break;
          }
          break;
          
        case 'Cubic':
          switch (s) {
            case 'easeIn':
              tran = new Fx.Transition(Fx.Transitions.Cubic).easeIn;
              return tran;
              break;
              
            case 'easeOut':
              tran = new Fx.Transition(Fx.Transitions.Cubic).easeOut;
              return tran;
              break;
              
            case 'easeInOut':
              tran = new Fx.Transition(Fx.Transitions.Cubic).easeInOut;
              return tran;
              break;
          }
          break;
          
        case 'Quart':
          switch (s) {
            case 'easeIn':
              tran = new Fx.Transition(Fx.Transitions.Quart).easeIn;
              return tran;
              break;
              
            case 'easeOut':
              tran = new Fx.Transition(Fx.Transitions.Quart).easeOut;
              return tran;
              break;
              
            case 'easeInOut':
              tran = new Fx.Transition(Fx.Transitions.Quart).easeInOut;
              return tran;
              break;
          }
          break;
          
        case 'Quint':
          switch (s) {
            case 'easeIn':
              tran = new Fx.Transition(Fx.Transitions.Quint).easeIn;
              return tran;
              break;
              
            case 'easeOut':
              tran = new Fx.Transition(Fx.Transitions.Quint).easeOut;
              return tran;
              break;
              
            case 'easeInOut':
              tran = new Fx.Transition(Fx.Transitions.Quint).easeInOut;
              return tran;
              break;
          }
          break;
          
        case 'Pow':
          switch (s) {
            case 'easeIn':
              tran = new Fx.Transition(Fx.Transitions.Pow).easeIn;
              return tran;
              break;
              
            case 'easeOut':
              tran = new Fx.Transition(Fx.Transitions.Pow).easeOut;
              return tran;
              break;
              
            case 'easeInOut':
              tran = new Fx.Transition(Fx.Transitions.Pow).easeInOut;
              return tran;
              break;
          }
          break;
          
        case 'Expo':
          switch (s) {
            case 'easeIn':
              tran = new Fx.Transition(Fx.Transitions.Expo).easeIn;
              return tran;
              break;
              
            case 'easeOut':
              tran = new Fx.Transition(Fx.Transitions.Expo).easeOut;
              return tran;
              break;
              
            case 'easeInOut':
              tran = new Fx.Transition(Fx.Transitions.Expo).easeInOut;
              return tran;
              break;
          }
          break;
          
        case 'Circ':
          switch (s) {
            case 'easeIn':
              tran = new Fx.Transition(Fx.Transitions.Circ).easeIn;
              return tran;
              break;
              
            case 'easeOut':
              tran = new Fx.Transition(Fx.Transitions.Circ).easeOut;
              return tran;
              break;
              
            case 'easeInOut':
              tran = new Fx.Transition(Fx.Transitions.Circ).easeInOut;
              return tran;
              break;
          }
          break;
          
        case 'Sine':
          switch (s) {
            case 'easeIn':
              tran = new Fx.Transition(Fx.Transitions.Sine).easeIn;
              return tran;
              break;
              
            case 'easeOut':
              tran = new Fx.Transition(Fx.Transitions.Sine).easeOut;
              return tran;
              break;
              
            case 'easeInOut':
              tran = new Fx.Transition(Fx.Transitions.Sine).easeInOut;
              return tran;
              break;
          }
          break;
          
        case 'Back':
          switch (s) {
            case 'easeIn':
              tran = new Fx.Transition(Fx.Transitions.Back).easeIn;
              return tran;
              break;
              
            case 'easeOut':
              tran = new Fx.Transition(Fx.Transitions.Back).easeOut;
              return tran;
              break;
              
            case 'easeInOut':
              tran = new Fx.Transition(Fx.Transitions.Back).easeInOut;
              return tran;
              break;
          }
          break;
          
        case 'Bounce':
          switch (s) {
            case 'easeIn':
              tran = new Fx.Transition(Fx.Transitions.Bounce).easeIn;
              return tran;
              break;
              
            case 'easeOut':
              tran = new Fx.Transition(Fx.Transitions.Bounce).easeOut;
              return tran;
              break;
              
            case 'easeInOut':
              tran = new Fx.Transition(Fx.Transitions.Bounce).easeInOut;
              return tran;
              break;
          }
          break;
          
        case 'Elastic':
          switch (s) {
            case 'easeIn':
              tran = new Fx.Transition(Fx.Transitions.Elastic).easeIn;
              return tran;
              break;
              
            case 'easeOut':
              tran = new Fx.Transition(Fx.Transitions.Elastic).easeOut;
              return tran;
              break;
              
            case 'easeInOut':
              tran = new Fx.Transition(Fx.Transitions.Elastic).easeInOut;
              return tran;
              break;
          }
          break;
          
        default:
          switch (s) {
            case 'easeIn':
              tran = new Fx.Transition(Fx.Transitions.Quad).easeIn;
              return tran;
              break;
              
            case 'easeOut':
              tran = new Fx.Transition(Fx.Transitions.Quad).easeOut;
              return tran;
              break;
              
            case 'easeInOut':
              tran = new Fx.Transition(Fx.Transitions.Quad).easeInOut;
              return tran;
              break;
          }
          break;
      }/* End of Switch */
    } /* End of transSel */
  } /* End of Typeof */
   
   
  function jxtcpops(id, o){
    var dix = $(id);
    var popsh = dix.getElements('.popuphover');


		var vo = 0;
		var vi = 0;
		var ho = 0;
		var hi = 0;
    
    var box = new Element('div',{
      styles:{'opacity':0,'display':'none'}
    });
    box.injectInside(document.body);
    box.addClass('jxtcpopup');
    
    var inner = new Element('div');
    inner.addClass('jxtcinner');
    
    var x = new Element('div');
    x.addClass('jxtcpopupclose');
    x.innerHTML = 'CLOSE';
    
    var d = new Element('div');
    d.addClass('jxtcpopupdrag');
    d.innerHTML = 'DRAG';
    
    x.injectInside(box);
    d.injectInside(box);
    inner.injectInside(box);
    
    var tt = transSel(o.transition, o.subtransition);
    var fx = new Fx.Styles(box,{duration:o.durationin,transition:tt,wait:false});
    
    x.addEvent('click',function(){
      fx.start({
        'top':window.getScrollTop() + vo,
        'left':window.getScrollLeft() + ho,
        'opacity':o.opacityout
      }).chain(function(){
        box.setStyles({'display':'none'});
      });
    });
    
    popsh.each(function(p,i){
      var pop = p.getElement('div[class=pop]');
      pop.setStyles({'display':'none'});

			x.addEvent('click',function(){
				pop.setStyles({'display':'none'});
				p.adopt(pop);
			});
      
      p.addEvent('click',function(){
         
        box.setStyles({
          'position':'absolute',
          'display':'block'
        });
        box.makeDraggable();
				inner.adopt(pop);
				
				pop.setStyles({'display':'block'});

        box.setStyles({
          'height':'auto',
          'top': window.getScrollTop() + o.verticalout + 'px',
          'left': window.getScrollLeft() + o.horizontalout + 'px'
        });

				if(o.centered=='1'){
					var bw = box.getSize().size.x;
					var bh = box.getSize().size.y;

	        box.setStyles({
						'top': (window.getScrollTop()) + (window.getHeight() - box.getSize().size.y)/2 + 'px',
	          'left': (window.getScrollLeft() + window.getWidth() - bw)/2 + 'px'
	        });

					vo = vi = (window.getHeight() - box.getSize().size.y)/2;
					ho = hi = (window.getScrollLeft() + window.getWidth() - bw)/2;

				}
        
        fx.start({
          'top':window.getScrollTop() + vi,
          'left':window.getScrollLeft() + hi,
          'opacity':o.opacityin
        });

      });
      
    });
    
  }
}