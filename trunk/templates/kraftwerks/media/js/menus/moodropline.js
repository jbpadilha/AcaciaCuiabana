//SmartMenu DropLine
window.addEvent('domready', function() {

/*	var wwd = window.getWidth();


	var menuli = $$('#topmenu .menu li');
	
	menuli.each(function(mli, i) {
		var smli = mli.getLast();
		var childTag = smli.getTag();
		var hgI = mli.getStyle('height').toInt() - 5;
		var wdI = mli.getStyle('width').toInt();
		var wids = 0;

			if(childTag == 'ul'){
				var all = smli.getChildren();
				
				all.each(function(a,i){
					//alert(a.innerHTML + ' ' + a.getStyle('width'));
					wids = wids + a.getStyle('width').toInt() + 1;
				});

				var pos = mli.getLeft(['topmenu']);
				//alert(pos);
				if(pos + wids > wwd){
					smli.setStyles({right:'-400px'});
				}

				smli.setStyles({width: wids + 0 + 'px'});
				if (navigator.userAgent.indexOf('MSIE') !=-1){
					//smli.setStyles({width: wids + 90 + 'px'});
				}

			}

		var fx = new Fx.Styles(smli, {duration:1000,wait:false,transition: Fx.Transitions.Elastic.easeOut});

		mli.addEvent('mouseenter', function(event) {
		  if( childTag == 'ul'){
				smli.setStyles({height: '0px'});
				smli.setStyles({visibility: 'visible'});
				fx.start({'height': hgI + 'px'});
			}

		});

		mli.addEvent('mouseleave', function(event) {
		  if( childTag == 'ul'){
				smli.setStyle('visibility', 'hidden');
		  }
		});

	});
*/





//SmartMenu DropLine
window.addEvent('domready', function() {

	var wwd = window.getWidth();


	var menuli = $$('#topmenu .menu li');
	
	menuli.each(function(mli, i) {
		var smli = mli.getLast();
		var childTag = smli.getTag();
		var hgI = smli.getStyle('height');
		var wdI = smli.getStyle('width');
		var wids = 0;

			if(childTag == 'ul'){
				var all = smli.getChildren();
				
				all.each(function(a,i){
					wids = wids + 1 + a.getStyle('width').toInt();
				});

				var pos = mli.getLeft(['topmenu']);
				//alert(pos);
				if(pos + wids > wwd){
					smli.setStyles({right:'50px'});
				}

				smli.setStyles({width: wids  + 'px'});
			}

		var fx = new Fx.Styles(smli, {duration:1000,wait:false,transition: Fx.Transitions.Elastic.easeOut});

		mli.addEvent('mouseenter', function(event) {
		  if( childTag == 'ul'){
				smli.setStyles({height: '0px'});
				smli.setStyles({visibility: 'visible'});
				fx.start({'height': hgI + 'px'});
			}

		});

		mli.addEvent('mouseleave', function(event) {
		  if( childTag == 'ul'){
				smli.setStyle('visibility', 'hidden');
		  }
		});

	});

});


});