function getElementsByClass( searchClass, domNode, tagName) {
	if (domNode == null) domNode = document;
	if (tagName == null) tagName = '*';
	var el = new Array();
	var tags = domNode.getElementsByTagName(tagName);
	var tcl = " "+searchClass+" ";
	for(i=0,j=0; i<tags.length; i++) {
		var test = " " + tags[i].className + " ";
		if (test.indexOf(tcl) != -1)
			el[j++] = tags[i];
	}
	return el;
}


function jxtcxtips(el,o){
	var tip = getElementsByClass('tip', el);
	tip[0].style.display = "block";
	tip[0].style.marginTop = o.verticalin.toString() + "px";
	tip[0].style.marginLeft = o.horizontalin.toString() + "px";
}

function jxtcxtipsout(el){
	var tip = getElementsByClass('tip', el);
	tip[0].style.display = "none";
}