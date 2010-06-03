$(document).ready(function() {
	$('a.vejaMais').click(function() {
		abrepagina($(this).attr('href'), 300, 480);
		return false;
	});
});