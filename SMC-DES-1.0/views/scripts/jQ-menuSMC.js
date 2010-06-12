$(document).ready(function() {

	$('li.opcao').click(function() {
		window.location= 'index.php' + $(this).attr('href');
		return false;
	});
	
	$('li.webmail').click(function() {
		target = '#' + $(this).attr('class');
		$(target).toggle();
	});

});