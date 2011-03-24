/*
	JoomlaXTC jxtchover 
	
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

if (typeof jxtchover != 'function'){
  function jxtchover(id,hi,ho){
  	var ghover = $(id).getElements('.js_hover');
  	ghover.each(function(el) {
  		var fx = new Fx.Styles(el, {duration:300, wait:false});
  		el.addEvent('mouseenter', function(){
  			fx.start({
  				'background-color': hi
  			});
  		});
  		el.addEvent('mouseleave', function(){
  			fx.start({
  				'background-color': ho
  			});
  		});
  	});
  }
}