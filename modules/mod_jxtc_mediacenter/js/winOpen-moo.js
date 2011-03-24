function winOpen(form, URL, wW, wH){

	var H =  window.getHeight().toInt();
	var W =  window.getWidth().toInt();
	var L = (W - wW)/2;
	var T = (H - wH)/2;

   window.open(URL,"winOpen","width=" + wW +",height=" + wH + ",top=" + T + ",left=" + L + "status=NO,location=NO,menubar=NO,scrollbars=NO,directories=NO,toolbar=NO");
   var a = window.setTimeout("document." + form + ".submit();",500); 
}