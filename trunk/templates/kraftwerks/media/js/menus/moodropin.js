window.addEvent('domready', function() {

if(menuSpeed == ''){
	menuSpeed = 300;
}

if(mooStyle == 'Fx.Transitions.linear') mooStyle = Fx.Transitions.linear;
if(mooStyle == 'Fx.Transitions.Bounce.easeOut') mooStyle = Fx.Transitions.Bounce.easeOut;
if(mooStyle == 'Fx.Transitions.Elastic.easeOut') mooStyle = Fx.Transitions.Elastic.easeOut;

function sortNumber(a, b){
	return b - a;
}

	var menuWd = $$('#topmenu .menu ul');
	menuWd.each(function(m, i){
		
		var factor = 1;
		var exclude = ((m.getParent()).getParent() ).getProperty('class');
		var max = new Array();
		var maxT = new Array();

		if(exclude == 'menu'){
			var par = m.getParent();
			var marg = par.getStyle('width').toInt();
			var pars = m.getChildren();
			pars.each(function(p, i){

				if(p.getTag() == 'li'){
					max[i] = p.getStyle('width').toInt();
				}
			});

			var maxT = max.sort(sortNumber);
		
			var max = maxT[0];
			
	    m.setStyles({'width': max + 0 + 'px'});
		}else{
			var par = m.getParent();
			var marg = par.getStyle('width').toInt();
			var pars = m.getChildren();
			pars.each(function(p, i){
				if(p.getTag() == 'li'){
					max[i] = p.getStyle('width').toInt();
				}
			});

			var maxT = max.sort(sortNumber);
		
			var max = maxT[0];
			
	    m.setStyles({'width': max + 0 + 'px'});
		}




		var exclude = ((m.getParent()).getParent() ).getProperty('class');

		if(exclude == 'menu'){
			var par = m.getParent();
			var pars = m.getChildren();
			pars.each(function(p, i){
				if(p.getTag() == 'li'){
						p.setStyles({'width': max + 'px'});
				}
			});

		}else{
			var pars = m.getChildren();
			pars.each(function(p, i){
				if(p.getTag() == 'li'){
					m.setStyles({'margin-top': -35 + 'px'});
					m.setStyles({'margin-left': marg + 'px'});
					p.setStyles({'width': max + 'px'});
				}
			});

		}

	});





	var menuli = $$('#topmenu .menu li');
	
	menuli.each(function(mli, i) {

		var smli = mli.getLast();
		var childTag = smli.getTag();
		var hgI = smli.getStyle('height');
		smli.setStyle('z-index', 9999);

		var exclude2 = (mli.getParent()).getProperty('class');
		if(exclude2 =='menu'){

		}else{

		}


		mli.addEvent('mouseenter', function(event) {
		
		  if( childTag == 'ul'){
	    smli.setStyles({visibility: 'visible'});
			smli.effect('height', {duration: menuSpeed, 
						transition: mooStyle}).start(0,hgI);
	   	  }

		});

		mli.addEvent('mouseleave', function(event) {
		  if( childTag == 'ul'){
				smli.setStyles({visibility: 'hidden'});
		  }
		});

	});




});