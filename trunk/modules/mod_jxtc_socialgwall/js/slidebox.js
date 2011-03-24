/*
	JoomlaXTC slidebox
	
	version 1.0
	
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

if (typeof slidebox != 'function') {
  /* Function: Transition Select */  
  if(typeof(transSel)== 'undefined'){
    function transSel(t,s){
      var tran;
      switch(t){
        case 'linear':
          tran = new Fx.Transition(Fx.Transitions.linear).easeIn;
          return tran;            
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
  
  function slidebox(id,sbfx,p,a){
    //sbfx = 'TRSI';
    var dix = $(id);
    var boxslides = dix.getElements('.slidebox');
    var pos = p;
    
    boxslides.each(function(b, i){
      b.setStyles({'overflow': 'hidden','position':'relative'});
      var slide = b.getElement('.slidepanel');
      slide.setStyles({'position': 'relative'});
      
      (function(){
        var s = b.getSize().size;
        switch(sbfx) {
        	case 'RSO':
            pos.xi = s.x; pos.xo = 0; pos.yi = 0; pos.yo = 0;
        	  break;
          case 'RSI':
            pos.xo = s.x; pos.xi = 0; pos.yi = 0; pos.yo = 0;
        	  break;
        	case 'LSO':
            pos.xi = -s.x; pos.xo = 0; pos.yi = 0; pos.yo = 0;
        		break;
          case 'LSI':
            pos.xo = -s.x; pos,xi = 0; pos.yi = 0; pos.yo = 0;
        		break;
          case 'BSO':
            pos.yi = s.y; pos.yo = 0; pos.xi = 0; pos.xo = 0;
        		break;
          case 'BSI':
            pos.yo = s.y; pos.yi = 0; pos.xi = 0; pos.xo = 0;
        		break;
          case 'TSO':
            pos.yo = s.y; pos.yi = 0; pos.xi = 0; pos.xo = 0;
        		break;
          case 'TSI':
            pos.yo = -s.y; pos.yi = 0; pos.xi = 0; pos.xo = 0;
        		break;
          case 'TRSO':
            pos.xi = s.x; pos.xo = 0; pos.yi = -s.y; pos.yo = 0;
        		break;
          case 'TRSI':
            pos.xo = s.x; pos.xi = 0; pos.yo = -s.y; pos.yi = 0;
        		break;
          case 'TLSO':
            pos.xi = -s.x; pos.xo = 0; pos.yi = -s.y; pos.yo = 0;
        		break;
          case 'TLSI':
            pos.xo = -s.x; pos.xi = 0; pos.yo = -s.y; pos.yi = 0;
        		break;
          case 'BRSO':
            pos.xi = s.x; pos.xo = 0; pos.yi = s.y; pos.yo = 0;
        		break;
          case 'BRSI':
            pos.xo = s.x; pos.xi = 0; pos.yo = s.y; pos.yi = 0;
            break;
          case 'BLSO':
            pos.xi = -s.x; pos.xo = 0; pos.yi = s.y; pos.yo = 0;
        		break;
          case 'BLSI':
            pos.xo = -s.x; pos.xi = 0; pos.yo = s.y; pos.yi = 0;
        		break;
        }
        
        slide.setStyles({
          'top': pos.yo,
          'left': pos.xo
        });
      }).delay(100);
      
      var tsfx = transSel(a.anim, a.ease);
      var sfx = new Fx.Styles(slide,{duration:a.dura,fps:a.frames,transition:tsfx,wait:false});
      
      b.addEvent('mouseenter', function(){
        sfx.start({
          'top': pos.yi,
          'left':pos.xi
        });
      });
      b.addEvent('mouseleave', function(){
        sfx.start({
          'top': pos.yo,
          'left':pos.xo
        });
      });
      
    });
  }
}