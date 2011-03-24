//SmartMenu DropColumns
window.addEvent('domready', function() {

function sortNumber(a, b)
{
return b - a;
}

	$('topmenu').setStyle('z-index', 1);
	var menuWd = $$('#topmenu .menu ul');

	menuWd.each(function(m, i){
		
		var factor = 1;
		var exclude = ((m.getParent()).getParent() ).getProperty('class');
		var widsP = new Array();
		var widsI = new Array();

		if(exclude == 'menu'){
			var par = m.getParent();
			var marg = par.getStyle('width').toInt();
			var pars = m.getChildren();
			pars.each(function(p, i){
				if((i+1)%2 == 0){
					if(p.getTag() == 'li'){
						widsP[i] = p.getStyle('width').toInt();
					}
				}else{
					if(p.getTag() == 'li'){
						widsI[i] = p.getStyle('width').toInt();
					}
				}
			});

			var maxP = widsP.sort(sortNumber);
			var maxI = widsI.sort(sortNumber);

			if(maxP[0] >= maxI[0]){
				var max = maxP[0] + 30;
			}else{
				var max = maxI[0] + 30;
			}

			if(pars[1] != null) var factor = 2;
			
	    m.setStyles({'width': max*factor + 2 + 'px'});
		}else{
			var par = m.getParent();
			var marg = par.getStyle('width').toInt();
			var pars = m.getChildren();
			pars.each(function(p, i){
				if((i+1)%2 == 0){
					if(p.getTag() == 'li'){
						widsP[i] = p.getStyle('width').toInt();
					}
				}else{
					if(p.getTag() == 'li'){
						widsI[i] = p.getStyle('width').toInt();
					}
				}
			});

			var maxP = widsP.sort(sortNumber);
			var maxI = widsI.sort(sortNumber);

			if(maxP[0] >= maxI[0]){
				var max = maxP[0];
			}else{
				var max = maxI[0];
			}

			if(pars[1] != null) var factor = 2;

	    m.setStyles({'width': max*factor + 2 + 'px'});
		}


//alert(max);



		if(exclude == 'menu'){
			var par = m.getParent();
			var pars = m.getChildren();
			pars.each(function(p, i){
				if((i+1)%2 == 0){
					if(p.getTag() == 'li'){
						p.setStyles({'width': max + 'px'});
						p.setStyles({'z-index': 999});
					}
				}else{
					if(p.getTag() == 'li'){
						p.setStyles({'width': max + 'px'});
						p.setStyles({'z-index': 999});
					}
				}
			});

		}else{
			var pars = m.getChildren();
			pars.each(function(p, i){
				if((i+1)%2 == 0){
					if(p.getTag() == 'li'){
						m.setStyles({'margin-top': -35 + 'px'});
						m.setStyles({'margin-left': marg + 'px'});
						p.setStyles({'width': max + 'px'});
					}
				}else{
					if(p.getTag() == 'li'){
						m.setStyles({'margin-top': -35 + 'px'});
						m.setStyles({'margin-left': marg + 'px'});
						p.setStyles({'width': max + 'px'});
					}
				}
			});

		}


	});





	var menuli = $$('#topmenu .menu li');
	
	menuli.each(function(mli, i) {

		var smli = mli.getLast();
		var childTag = smli.getTag();
		var hgI = smli.getStyle('height');
		smli.setStyle('z-index', 99999);

		var exclude2 = (mli.getParent()).getProperty('class');
		if(exclude2 =='menu'){

		}else{
			var ww = smli.getStyle('width');

		}


		mli.addEvent('mouseenter', function(event) {
		
		  if( childTag == 'ul'){
	    //smli.setStyle('width', ww);
	    smli.setStyles({visibility: 'visible'});
			smli.effect('height', {duration: 300, 
						transition: Fx.Transitions.Bounce.easeOut}).start(0,hgI);
	   	  }

		});

		mli.addEvent('mouseleave', function(event) {
		  if( childTag == 'ul'){
				smli.setStyles({visibility: 'hidden'});
		  }
		});

	});
});