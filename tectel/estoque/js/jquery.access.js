//
// jq-access.js - handle button and accesskey highlights
//
// If this code works, it was written by dave.methvin@gmail.com.
// If it's broken, please send your fixes to the address above.
//
// Buttons and links should use accesskey attribute to define
// the character that is to be used for the accelerator.
//		<button accesskey="S" id="Send">Send</button>
//

$(document).ready(function() {

	// Tag the accesskey letter on links/buttons.
	// BUG: this will remove any internal HTML in the link or button!
	$("button[@accesskey], a[@accesskey]").each(function(){
		var k = this.getAttribute("accesskey");
		$(this).html($(this).text().replace(new RegExp("("+k+")","i"), "<b class='access'>$1</b>"));
	});

	// If an input with accesskey has a label, tag the label's letter.
	$("select[@accesskey], input[@accesskey], textarea[@accesskey]").each(function(){
		var k = this.getAttribute("accesskey");
		var lb = $("label[@for='"+this.id+"']");
		lb.html(lb.html().replace(new RegExp("("+k+")","i"), "<b class='access'>$1</b>"));
	});

	// Remove .access class for now and cache the jQuery object
	var access = $("b.access").removeClass("access");
	
	// When Alt is down, the .access class is added to the letters.
	// Alt repeats when held down, so use a timer to avoid repeated
	// adding/removing of class--it can cause flickering and eats up
	// a lot of memory.
	var active = 0;
	$(document)
		.keydown(function(e){
	        if ( (e.keyCode != 18 && !e.altKey) || ++active > 1 ) 
				return;
			access.addClass("access");
			setTimeout(function(){
				if ( active > 1 ) {
					active = 1;
					setTimeout(arguments.callee, 250);  // come back soon
				} else {
					active = 0;
					access.removeClass("access");
				}
			}, 750);
   	});
});
