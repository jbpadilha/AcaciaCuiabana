/*
	JoomlaXTC jxtctips
	
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

if (typeof jxtctips != 'function') {
  /* Function: Transition Select */  
  if(typeof(transSel)== 'undefined'){
    function transSel(t,s){
      var tran;
      switch(t){
        case 'linear':
            switch(s){
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
            switch(s){
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
            switch(s){
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
            switch(s){
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
            switch(s){
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
            switch(s){
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
            switch(s){
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
            switch(s){
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
            switch(s){
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
            switch(s){
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
            switch(s){
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
            switch(s){
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
            switch(s){
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
  }/* End of Typeof */
 
  function jxtctips(id,options){
    var dix = $(id);
    var triggers = dix.getElements('.jxtctooltip');
    triggers.each(function(t,i){
      
      var tip = t.getElement('.tip');
      t.setStyles({'position':'relative'});
      tip.setStyles({'opacity':0,'display':'block','position':'absolute','z-index':9999,'top':options.verticalout,'left':options.horizontalout});
      
      var ttran = transSel(options.transition, options.subtransition);
      var tfxi = new Fx.Styles(tip, {duration: options.durationin, fps:80, transtion: ttran, wait: false});
      var tfxo = new Fx.Styles(tip, {duration: options.durationout, fps:80, transtion: ttran, wait: false});
      var tfxp = new Fx.Styles(tip, {duration: options.pause,wait: false});
      
      t.addEvent('mouseenter', function(){
        tfxi.start({
          'opacity': options.opacityin,
          'top': options.verticalin + 'px',
          'left': options.horizontalin + 'px'          
        });
      });
      t.addEvent('mouseleave', function(){
        tfxp.start({}).chain(function(){
          tfxo.start({
            'opacity': options.opacityout,
            'top' : options.verticalout + 'px',
  					'left' : options.horizontalout + 'px'

          });
        });
      });
            
    });
  }
}