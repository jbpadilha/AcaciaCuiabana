window.addEvent('domready', function(){

	var contents = $$('.contentdiv');
	contents.setStyles({'visibility':'hidden'});
	contents[0].setStyles({'visibility':'visible'});

	var tigg = $$('.toc');
	
	

	tigg.each(function(tig, i){

		tig.addEvent('click',function(e){
			e = new Event(e).stop();
			contents.setStyles({'visibility':'hidden'});
			contents[i].effect('opacity',{	duration: 600,
												transition: Fx.Transitions.bounceOut
									}).start(0,1);

		});
	});

});