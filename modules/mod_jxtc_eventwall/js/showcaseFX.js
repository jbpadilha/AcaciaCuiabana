/*
 ShowcaseFX library

 version 1.4

 Copyright (C)  2009  Monev Software LLC

 All Rights Reserved.

 THIS PROGRAM IS NOT FREE SOFTWARE

 You shall not modify, copy, duplicate, reproduce, sell, license or
 sublicense the Software, or transfer or convey the Software or
 any right in the Software to anyone else without the prior
 written consent of Monev Software LLC; provided that Licensee may make
 one copy of the Software for backup or archival purposes.

 Monev Software LLC
 www.joomlaxtc.com
*/

if (typeof showcasefx != 'function') {
	function showcasefx(id, type, direction, sp, tsp, layer, transition){

	  var idx = $(id);
		if(idx){

	  var shows = idx.getElements('div[class=' + id + 'shows]');
	  var stotal = shows.length;
		if(stotal > 0){

		if(stotal == 1) {
	    shows.setStyle('display','block');
		}else{
	    shows.setStyle('display','block');

	  var repeat;
	  var wd = 0;
	  var hg = 0;
	  var finalhg = 0;
		var i = 0;
		var j = 1;
	  var factor = 1;
	  var aux;
	  var op;
	  var keepy;
	  var keep = '';
		var stnoplay = true;
		var tsp_a;

	  switch (type) {
			case 'fade':  top1 = 0; left1 = 0; top2 = 0; left2 = 0; break;
			case 'slideHor': top1 = 0; left1 = 0; top2 = 0; left2 = wd + 0; break;
			case 'slideVer': top1 = 0; left1 = 0; top2 = hg; left2 = 0; break;
		}

	  var dix = $(id);
	  var subidx = $(id + '_sc');
	  subidx.setStyles({'overflow': 'hidden'});

	  var box = new Element('div',{
				'styles': {
	      'display': 'block',
				'overflow': 'hidden',
				'position': 'relative',
				'top': '0px',
				'width': '100%',
				'height': 'auto',
				'z-index': layer
				}
	  });
		box.addClass('showcasefx_box');

		var div = new Element('div',{
				'styles':{
				'position':'relative',
				'width': 'auto',
				'height': 'auto',
				'top': top1 + 'px',
				'left': left1 + 'px',
	      'padding': '0px'
				}
		});

		var div2 = new Element('div',{
				'styles':{
				'position':'relative',
				'width': 'auto',
				'height': 'auto',
				'top': top2 + 'px',
				'left': left2 + 'px',
	      'padding': '0px'
			}
		});

	  box.injectInside(subidx);

	  shows.each(function(s,x){
	    div.setHTML(shows[x].innerHTML);
	    div.injectInside(box);
	    Size = box.getSize();
	    wd = Size.size.x;
	    hg = Size.size.y;
	    if(hg > finalhg){
	      finalhg = hg;
	    }
	  });
		div.setHTML('');

	  hg = finalhg;

	  box.setStyle('height',hg + 'px');
	  div.setStyle('position', 'absolute');

	  switch (type) {
		case 'fade':  top1 = 0; left1 = 0; top2 = 0; left2 = 0; break;
		case 'slideHor': top1 = 0; left1 = 0; top2 = 0; left2 = wd + 0; break;
		case 'slideVer': top1 = 0; left1 = 0; top2 = hg; left2 = 0; break;
		}

		div2.injectInside(box);
	  div2.setStyle('position', 'absolute');
	  div.setStyles({'width': wd + 'px', 'top': top1 + 'px', 'left': left1 + 'px'});
	  div2.setStyles({'width': wd + 'px', 'top': top2 + 'px', 'left': left2 + 'px'});

		if(type=='fade'){
		var loop = function(){

	      if(keepy == 'on'){
	        if(op == 'rev'){
	        }else{
	        }
	      }else{
	        if(op == 'rev'){
	        i = j-1;
	        j = i-1;
	        op = 'rev';
	        }
	      }

	      if(i<0){i = stotal + i;}
	      if(j<0){j = stotal + j;}

	      if(i>stotal-1){i = i - stotal;}
	      if(j>stotal-1){j = j - stotal;}


				if(stnoplay==true){
					j=0;
					i=stotal-1;
					stnoplay = false;
					tsp_a = tsp;
					tsp = 0;
				}else{
					tsp = tsp_a;
				}

			  switch (transition) {
				default:
					var fx = new Fx.Styles(div, {duration: tsp, wait:false, transition: Fx.Transitions.linear});
					var fx2 = new Fx.Styles(div2, {duration: tsp, wait:false, transition: Fx.Transitions.linear});
				break;
				case '2':
					var fx = new Fx.Styles(div, {duration: tsp, wait:false, transition: Fx.Transitions.Quad.easeInOut});
					var fx2 = new Fx.Styles(div2, {duration: tsp, wait:false, transition: Fx.Transitions.Quad.easeInOut});
				break;
				case '3':
					var fx = new Fx.Styles(div, {duration: tsp, wait:false, transition: Fx.Transitions.Cubic.easeInOut});
					var fx2 = new Fx.Styles(div2, {duration: tsp, wait:false, transition: Fx.Transitions.Cubic.easeInOut});
				break;
				case '4':
					var fx= new Fx.Styles(div, {duration: tsp, wait:false, transition: Fx.Transitions.Quart.easeInOut});
					var fx2 = new Fx.Styles(div2, {duration: tsp, wait:false, transition: Fx.Transitions.Quart.easeInOut});
				break;
				case '5':
					var fx = new Fx.Styles(div, {duration: tsp, wait:false, transition: Fx.Transitions.Quint.easeInOut});
					var fx2 = new Fx.Styles(div2, {duration: tsp, wait:false, transition: Fx.Transitions.Quint.easeInOut});
				break;
				case '6':
					var fx = new Fx.Styles(div, {duration: tsp, wait:false, transition: Fx.Transitions.Expo.easeInOut});
					var fx2 = new Fx.Styles(div2, {duration: tsp, wait:false, transition: Fx.Transitions.Expo.easeInOut});
				break;
				case '7':
					var fx = new Fx.Styles(div, {duration: tsp, wait:false, transition: Fx.Transitions.Circ.easeInOut});
					var fx2 = new Fx.Styles(div2, {duration: tsp, wait:false, transition: Fx.Transitions.Circ.easeInOut});
				break;
				case '8':
					var fx = new Fx.Styles(div, {duration: tsp, wait:false, transition: Fx.Transitions.Sine.easeInOut});
					var fx2 = new Fx.Styles(div2, {duration: tsp, wait:false, transition: Fx.Transitions.Sine.easeInOut});
				break;
				case '9':
					var fx = new Fx.Styles(div, {duration: tsp, wait:false, transition: Fx.Transitions.Back.easeInOut});
					var fx2 = new Fx.Styles(div2, {duration: tsp, wait:false, transition: Fx.Transitions.Back.easeInOut});
				break;
				case '10':
					var fx = new Fx.Styles(div, {duration: tsp, wait:false, transition: Fx.Transitions.Bounce.easeInOut});
					var fx2 = new Fx.Styles(div2, {duration: tsp, wait:false, transition: Fx.Transitions.Bounce.easeInOut});
				break;
				case '11':
					var fx = new Fx.Styles(div, {duration: tsp, wait:false, transition: Fx.Transitions.Elastic.easeInOut});
					var fx2 = new Fx.Styles(div2, {duration: tsp, wait:false, transition: Fx.Transitions.Elastic.easeInOut});
				break;
				}

				var fxA = new Fx.Styles(div, {duration:sp+tsp, wait:false,fps:120});

	      //div.setHTML(shows[i].innerHTML);
        div.adopt(shows[i]);
	      //div2.setHTML(shows[j].innerHTML);
        div2.adopt(shows[j]);

	      div.setStyle('opacity', 1);
	      div2.setStyle('opacity', 0);

				fx.start({'opacity':0}).chain(function(){
	        fxA.start({})
				});

				fx2.start({'opacity':1}).chain(function(){
	        fxA.start({})
				});

	      if(keepy=='on'){
	        if(op == 'rev'){i = keep-1; j = keep;}
	        else{i = keep-1; j = keep;}
	        keepy = '';
	      }

	      if(keepy=='on'){
	        if(op == 'rev'){i = keep-1; j = keep;}
	        else{i = keep-1; j = keep;}
	        keepy = '';
	      }

	      if(op == 'fow'){
	      aux = i;
	      i = j-1;
	      j = i+1;
	      op = '';
	      }

				i++;
				j++;
				if(i>stotal-1){i=0;}
				if(j>stotal-1){j=0;}
		}
		var timex = sp+tsp;
		}

		if(type=='slideHor'){
		var loop = function(){

	      if(keepy == 'on'){
	        if(op == 'rev'){
	        }else{
	        }
	      }else{
	        if(op == 'rev'){
	        i = j-1;
	        j = i-1;
	        op = 'rev';
	        }
	      }

	      if(i<0){i = stotal + i;}
	      if(j<0){j = stotal + j;}

	      if(i>stotal-1){i = i - stotal;}
	      if(j>stotal-1){j = j - stotal;}

				if(sp==-1){
					if(stnoplay==true){
						j=0;
						i=stotal-1;
						stnoplay = false;
						tsp_a = tsp;
						tsp = 0;
					}else{
						tsp = tsp_a;
					}
				}

			  switch (transition) {
				default:
					var fx = new Fx.Styles(div, {duration: tsp, wait:false, transition: Fx.Transitions.linear});
					var fx2 = new Fx.Styles(div2, {duration: tsp, wait:false, transition: Fx.Transitions.linear});
				break;
				case '2':
					var fx = new Fx.Styles(div, {duration: tsp, wait:false, transition: Fx.Transitions.Quad.easeInOut});
					var fx2 = new Fx.Styles(div2, {duration: tsp, wait:false, transition: Fx.Transitions.Quad.easeInOut});
				break;
				case '3':
					var fx = new Fx.Styles(div, {duration: tsp, wait:false, transition: Fx.Transitions.Cubic.easeInOut});
					var fx2 = new Fx.Styles(div2, {duration: tsp, wait:false, transition: Fx.Transitions.Cubic.easeInOut});
				break;
				case '4':
					var fx= new Fx.Styles(div, {duration: tsp, wait:false, transition: Fx.Transitions.Quart.easeInOut});
					var fx2 = new Fx.Styles(div2, {duration: tsp, wait:false, transition: Fx.Transitions.Quart.easeInOut});
				break;
				case '5':
					var fx = new Fx.Styles(div, {duration: tsp, wait:false, transition: Fx.Transitions.Quint.easeInOut});
					var fx2 = new Fx.Styles(div2, {duration: tsp, wait:false, transition: Fx.Transitions.Quint.easeInOut});
				break;
				case '6':
					var fx = new Fx.Styles(div, {duration: tsp, wait:false, transition: Fx.Transitions.Expo.easeInOut});
					var fx2 = new Fx.Styles(div2, {duration: tsp, wait:false, transition: Fx.Transitions.Expo.easeInOut});
				break;
				case '7':
					var fx = new Fx.Styles(div, {duration: tsp, wait:false, transition: Fx.Transitions.Circ.easeInOut});
					var fx2 = new Fx.Styles(div2, {duration: tsp, wait:false, transition: Fx.Transitions.Circ.easeInOut});
				break;
				case '8':
					var fx = new Fx.Styles(div, {duration: tsp, wait:false, transition: Fx.Transitions.Sine.easeInOut});
					var fx2 = new Fx.Styles(div2, {duration: tsp, wait:false, transition: Fx.Transitions.Sine.easeInOut});
				break;
				case '9':
					var fx = new Fx.Styles(div, {duration: tsp, wait:false, transition: Fx.Transitions.Back.easeInOut});
					var fx2 = new Fx.Styles(div2, {duration: tsp, wait:false, transition: Fx.Transitions.Back.easeInOut});
				break;
				case '10':
					var fx = new Fx.Styles(div, {duration: tsp, wait:false, transition: Fx.Transitions.Bounce.easeInOut});
					var fx2 = new Fx.Styles(div2, {duration: tsp, wait:false, transition: Fx.Transitions.Bounce.easeInOut});
				break;
				case '11':
					var fx = new Fx.Styles(div, {duration: tsp, wait:false, transition: Fx.Transitions.Elastic.easeInOut});
					var fx2 = new Fx.Styles(div2, {duration: tsp, wait:false, transition: Fx.Transitions.Elastic.easeInOut});
				break;
				}
				var fxA = new Fx.Styles(div, {duration:sp+tsp, wait:false,fps:120});

	      if(direction=='RightLeft'){
	      	//div.setHTML(shows[i].innerHTML);
          div.adopt(shows[i]);
  	      //div2.setHTML(shows[j].innerHTML);
          div2.adopt(shows[j]);

	        div.setStyle('left',0);
	        div2.setStyle('left', factor*wd + 0);

	        fx.start({'left': -(factor*wd + 0)}).chain(function(){
	          fxA.start({});
	        });

	        fx2.start({'left': 0}).chain(function(){
	          fxA.start({});
	        });
				}

	      if(direction=='LeftRight'){
	      	//div.setHTML(shows[i].innerHTML);
          div.adopt(shows[i]);
  	      //div2.setHTML(shows[j].innerHTML);
          div2.adopt(shows[j]);

	        div.setStyle('left', -(factor*wd + 0));
	        div2.setStyle('left', 0);

	        fx.start({'left': 0}).chain(function(){
	          fxA.start({});
	        });

	        fx2.start({'left': factor*wd + 0}).chain(function(){
	          fxA.start({});
	        });
				}

	      if(keepy=='on'){
	        if(op == 'rev'){i = keep-1; j = keep;}
	        else{i = keep-1; j = keep;}
	        keepy = '';
	      }

	      if(op == 'fow'){
	      aux = i;
	      i = j-1;
	      j = i+1;
	      op = '';
	      }

				i++;
				j++;
				if(i>stotal-1){i=0;}
				if(j>stotal-1){j=0;}
		}
		var timex = sp+tsp;
		}

		if(type=='slideVer'){
		var loop = function(){
	  //alert('i ' + i + ' - j ' + j);

	      if(keepy == 'on'){
	        if(op == 'rev'){
	        }else{
	        }
	      }else{
	        if(op == 'rev'){
	        i = j-1;
	        j = i-1;
	        op = 'rev';
	        }
	      }

	      if(i<0){i = stotal + i;}
	      if(j<0){j = stotal + j;}

	      if(i>stotal-1){i = i - stotal;}
	      if(j>stotal-1){j = j - stotal;}

				if(sp==-1){
					if(stnoplay==true){
						j=0;
						i=stotal-1;
						stnoplay = false;
						tsp_a = tsp;
						tsp = 0;
					}else{
						tsp = tsp_a;
					}
				}

			  switch (transition) {
				default:
					var fx = new Fx.Styles(div, {duration: tsp, wait:false, transition: Fx.Transitions.linear});
					var fx2 = new Fx.Styles(div2, {duration: tsp, wait:false, transition: Fx.Transitions.linear});
				break;
				case '2':
					var fx = new Fx.Styles(div, {duration: tsp, wait:false, transition: Fx.Transitions.Quad.easeInOut});
					var fx2 = new Fx.Styles(div2, {duration: tsp, wait:false, transition: Fx.Transitions.Quad.easeInOut});
				break;
				case '3':
					var fx = new Fx.Styles(div, {duration: tsp, wait:false, transition: Fx.Transitions.Cubic.easeInOut});
					var fx2 = new Fx.Styles(div2, {duration: tsp, wait:false, transition: Fx.Transitions.Cubic.easeInOut});
				break;
				case '4':
					var fx= new Fx.Styles(div, {duration: tsp, wait:false, transition: Fx.Transitions.Quart.easeInOut});
					var fx2 = new Fx.Styles(div2, {duration: tsp, wait:false, transition: Fx.Transitions.Quart.easeInOut});
				break;
				case '5':
					var fx = new Fx.Styles(div, {duration: tsp, wait:false, transition: Fx.Transitions.Quint.easeInOut});
					var fx2 = new Fx.Styles(div2, {duration: tsp, wait:false, transition: Fx.Transitions.Quint.easeInOut});
				break;
				case '6':
					var fx = new Fx.Styles(div, {duration: tsp, wait:false, transition: Fx.Transitions.Expo.easeInOut});
					var fx2 = new Fx.Styles(div2, {duration: tsp, wait:false, transition: Fx.Transitions.Expo.easeInOut});
				break;
				case '7':
					var fx = new Fx.Styles(div, {duration: tsp, wait:false, transition: Fx.Transitions.Circ.easeInOut});
					var fx2 = new Fx.Styles(div2, {duration: tsp, wait:false, transition: Fx.Transitions.Circ.easeInOut});
				break;
				case '8':
					var fx = new Fx.Styles(div, {duration: tsp, wait:false, transition: Fx.Transitions.Sine.easeInOut});
					var fx2 = new Fx.Styles(div2, {duration: tsp, wait:false, transition: Fx.Transitions.Sine.easeInOut});
				break;
				case '9':
					var fx = new Fx.Styles(div, {duration: tsp, wait:false, transition: Fx.Transitions.Back.easeInOut});
					var fx2 = new Fx.Styles(div2, {duration: tsp, wait:false, transition: Fx.Transitions.Back.easeInOut});
				break;
				case '10':
					var fx = new Fx.Styles(div, {duration: tsp, wait:false, transition: Fx.Transitions.Bounce.easeInOut});
					var fx2 = new Fx.Styles(div2, {duration: tsp, wait:false, transition: Fx.Transitions.Bounce.easeInOut});
				break;
				case '11':
					var fx = new Fx.Styles(div, {duration: tsp, wait:false, transition: Fx.Transitions.Elastic.easeInOut});
					var fx2 = new Fx.Styles(div2, {duration: tsp, wait:false, transition: Fx.Transitions.Elastic.easeInOut});
				break;
				}
				var fxA = new Fx.Styles(div, {duration:sp+tsp, wait:false,fps:120});

	      if(direction=='BottomTop'){
	        //div.setHTML(shows[i].innerHTML);
          div.adopt(shows[i]);
  	      //div2.setHTML(shows[j].innerHTML);
          div2.adopt(shows[j]);

	        div.setStyle('top',0);
	        div2.setStyle('top', factor*hg + 0);

	        fx.start({'top': -(factor*hg + 0)}).chain(function(){
	          fxA.start({})
	        });

	        fx2.start({'top': 0}).chain(function(){
	          fxA.start({})
	        });
				}

	      if(direction=='TopBottom'){
	        if(status == 'init'){
	          div.setHTML('');
	        }else{
	          //div.setHTML(shows[j].innerHTML);
            div.adopt(shows[j]);
	        }
	        //div2.setHTML(shows[i].innerHTML);
          div2.adopt(shows[i]);

	        div.setStyle('top', -(factor*hg + 0));
	        div2.setStyle('top', 0);

	        fx.start({'top': 0}).chain(function(){
	          fxA.start({})
	        });

	        fx2.start({'top': factor*hg + 0}).chain(function(){
	          fxA.start({})
	        });
				}

	      if(keepy=='on'){
	        if(op == 'rev'){i = keep-1; j = keep;}
	        else{i = keep-1; j = keep;}
	        keepy = '';
	      }

	      if(op == 'fow'){
	      aux = i;
	      i = j-1;
	      j = i+1;
	      op = '';
	      }

				i++;
				j++;
				if(i>stotal-1){i=0;}
				if(j>stotal-1){j=0;}
		}
		var timex = sp+tsp;
		}

		loop();
		if (sp >= 0) {
			repeat = loop.periodical(timex);
		}
	  var fow = $(id+'_foward');
	  var bac = $(id+'_back');
		var idp = 'a[class=' + id + '_pag]';
	  var steps = idx.getElements(idp);

	  if(steps!=null){
	  steps.each(function(step, y){
	    var y = y +1;
	    var lnk = $(id + '_p' + y);

	    lnk.addEvent('click', function(e){
	      new Event(e).stop();
	      if(y-1!=i){
	      $clear(repeat);

	      if(op == 'rev'){i = j-1; j = y-1;}
	      else{j = y-1;}

	      keep = y-1;
	      keepy = 'on';

	      loop();
		if (sp >= 0) {
			repeat = loop.periodical(timex);
		}
	      }
	    });
	  });
	  }

	  if(fow!=null){
	  fow.addEvent('click', function(e) {
	    new Event(e).stop();
	    $clear(repeat);
	    if(op == 'rev'){
	      aux = i;
	      i = j-1;
	      j = i+1;
	      op = 'fow';
	    }
	    factor = 1;
	    loop();
		if (sp >= 0) {
			repeat = loop.periodical(timex);
		}
	  });
	  }

	  if(bac!=null){
	  bac.addEvent('click', function(e) {
	    new Event(e).stop();
	    $clear(repeat);
	    op = 'rev';
	    factor = -1;
	    loop();
		if (sp >= 0) {
			repeat = loop.periodical(timex);
		}
	  });
	  }

		return true;

		} // if more than 1

		} // if shows

		}

	}
}