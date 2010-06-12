/* Exemplo de uso: --------------------------------------------------------------------------------------- *\
|
|	<style>
|		#link { position:absolute; z-index:1; display:none; background:#9900FF; left: 52px; top: 16px; }
|	</style>
|		
|	<div id="hint"> texto do hint </div>
|	
|	<label onMouseMove="Hint('link',2)" onMouseOut="Hint('link',1)">Mostrar hint</label>
|
\* ------------------------------------------------------------------------------------------------------- */

var sAgent = navigator.userAgent;
var bIsIE = sAgent.indexOf("MSIE") > -1;
var bIsNav = sAgent.indexOf("Mozilla") > -1 && !bIsIE;

var xmouse = 0;
var ymouse = 0;
document.onmousemove = MouseMove;

function MouseMove(e) {  
	if (e) {
		MousePos(e);
	} else { 
		MousePos();
	}
}

function MousePos(e) {
	if (bIsNav) {
		xmouse = e.pageX;
		ymouse = e.pageY;
	} 
	if (bIsIE) {
		xmouse = document.body.scrollLeft + event.x;
		ymouse = document.body.scrollTop + event.y;
	}
}

function Hint(objNome, action) {
	if (bIsIE) { objHint = document.all[objNome]; }
	if (bIsNav) {
		objHint = document.getElementById(objNome);
		event = objHint;
	}
	switch (action) {
		case 1:
			objHint.style.display = 'none';
			break;
		case 2: 
			objHint.style.display = 'block';
			objHint.style.left = xmouse + 15;
			objHint.style.top = ymouse + 15;
			break;
	}
}