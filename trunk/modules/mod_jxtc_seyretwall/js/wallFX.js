/*
 wallFX library

 version 1.0

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

if (typeof wallfx != 'function') {
	function wallfx(id, w, h, mode){
		var mode = (typeof mode != 'undefined') ? mode : 0;
	  var con = $(id);
	  if (con) {
	    var conSize = con.getSize();
	    var inside = con.getElement('div[id=' + id +'_sc]');
	    if (inside) {
		    inside.setStyles({
					'position': 'relative',
					'top':0,
					'left':0,
					'width': w + 'px',
					'height': h + 'px'
		    });
		    var inSize = inside.getSize();
				var divShow = inside.getElement('div');
				if(divShow){
		      divShow.setStyles({
						'position':'relative',
						'display':'block'
					});
					switch(mode)	{
					case 0:
			    inside.setStyles({
						'overflow': 'hidden'
			    });
					var table = divShow.getElement('table');
					var tSize = table.getSize().size;
		      table.setStyles({
						'position':'relative',
						'width': tSize.x,
						'height': tSize.y,
						'top':tSize.y - h,
						'left':tSize.x - w
					});
		      divShow.setStyles({
						'left': -(tSize.x - w),
						'top': -(tSize.y - h),
						'width': (tSize.x - w) + tSize.x,
						'height': (tSize.y - h) + tSize.y
					});
					table.makeDraggable({container:divShow});
					break;
					case 1:
					var table = divShow.getElement('table');
					var tSize = table.getSize().size;
		      table.setStyles({
						'position':'relative',
						'top':0,
						'left':0
					});
		      divShow.setStyles({
						'overflow': 'hidden',
						'position':'relative',
						'width': w,
						'height': h
					});
					var margenx = inSize.size.x * .05;
					var margeny = inSize.size.y * .05;
			    var dimDiffsx = tSize.x - inSize.size.x;
			    var dimDiffsy = tSize.y - inSize.size.y;
			    var dimPropsx = dimDiffsx / (inSize.size.x - (margenx * 2));
			    var dimPropsy = dimDiffsy / (inSize.size.y - (margeny * 2));

					inside.addEvent('mousemove', function(event){
				    var event = new Event(event);
						var mposx = event.page.x - inside.offsetLeft;
						var mposy = event.page.y - inside.offsetTop;
						var newx = parseInt(dimPropsx * (mposx - margenx));
						if (newx < 0) {newx = 0};
						if (newx > tSize.x - inSize.size.x) {newx = tSize.x - inSize.size.x};
						var newy = parseInt(dimPropsy * (mposy - margeny));
						if (newy < 0) {newy = 0};
						if (newy > tSize.y - inSize.size.y) {newy = tSize.y - inSize.size.y};
			    	table.style.left  = -newx + 'px';
			    	table.style.top  = -newy + 'px';
					});
					break;
	        }
	      }
	    }
	  }
	}
}