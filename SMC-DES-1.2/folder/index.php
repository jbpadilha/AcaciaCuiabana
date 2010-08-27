<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">

<head>
	<title>SMC - Demonstração</title>
    <link type="text/css" rel="stylesheet" media="screen" href="/_global/_css/foder.css" />
	<script type="text/javascript" language="javascript" src="/_global/_js/jquery-1.4.2.js"></script>
	<script type="text/javascript" language="javascript" src="/_global/_js/imageZoom.js"></script>
</head>

<style type="text/css">
body { margin:0px; padding:0px; background:#000; overflow:scroll; overflow-x:hidden; }

table.folder { margin:5px auto; z-index:1; }
tr.paginas, tr.paginas td img { height:200px; }
tr.paginas td img { position:absolute; top:5px; height:200px; }
tr.paginas td.right img { left:50%; border-right:1px solid #AAA; }
tr.paginas td.left img { right:50%; display:none; }
tr.legenda td img { height:32px; cursor:pointer; }

img.pag01 { z-index:8; width:332px; }
img.pag02b { z-index:7; width:377px; }
img.pag03b { z-index:6; width:422px; }
img.pag04b { z-index:5; width:467px; }
img.pag02a { z-index:1; width:0px; }
img.pag03a { z-index:2; width:0px; }
img.pag04a { z-index:3; width:0px; }
img.pag05 { z-index:4; width:0px; }

#zoom { clear:both; bottom:10px; margin:0px auto; z-index:2; }
#zoom img { max-width:90%; max-height:400px; display:none; z-index:2; }
#zoom img:hover { margin-top:-80px; max-width:960px; max-height:480px; z-index:99; }
</style>

<script type="text/javascript">
$(document).ready(function() {

$('.prev').click(function() {
	var left = $('.paginas .right');
	var x = '';
	for (i = 0; i < left.children().length; i++) {
		if (x == '' && $(x).css('width') != '0') x = $(left.children()[i]).attr('class');
	}
	switch (x) {
		case 'pag01': var target = $('.pag02a'); var width = '332px'; break;
		case 'pag02a': var target = $('.pag01'); var width = '332px'; break;
		case 'pag03a': var target = $('.pag02b'); var width = '377px'; break;
		case 'pag02b': var target = $('.pag03a'); var width = '377px'; break;
		case 'pag04a': var target = $('.pag03b'); var width = '422px'; break;
		case 'pag03b': var target = $('.pag04a'); var width = '422px'; break;
		case 'pag04b': var target = $('.pag05'); var width = '467px'; break;
		case 'pag05': var target = $('.pag04b'); var width = '467px'; break;		
	}
	if (target) {
		target.animate({ width: '0px' }, 500, function() {
			$('.' + x).animate({ width: width }, 500);
		});
	}
});

$('.next').click(function() {
	var next = $('.paginas .left');
	var x = '';
	for (i = 0; i < next.children().length; i++) if (x == '') x = $(next.children()[i]).attr('class');
	switch (x) {
		case 'pag01': var target = $('.pag02a'); var width = '332px'; break;
		case 'pag02a': var target = $('.pag01'); var width = '332px'; break;
		case 'pag03a': var target = $('.pag02b'); var width = '377px'; break;
		case 'pag02b': var target = $('.pag03a'); var width = '377px'; break;
		case 'pag04a': var target = $('.pag03b'); var width = '422px'; break;
		case 'pag03b': var target = $('.pag04a'); var width = '422px'; break;
		case 'pag04b': var target = $('.pag05'); var width = '467px'; break;
		case 'pag05': var target = $('.pag04b'); var width = '467px'; break;		
	}
	if (target) {
		target.animate({ width: '0px' }, 500, function() {
			$('.' + x).animate({ width: width }, 500);
		});
	}
});

$('.paginas img')
	.mousemove(function() {
		var source = $(this);
		var target = $('#zoom img');
		if ($(this).attr('src') != $(target).attr('src')) {
			$('#zoom img').fadeOut(250, function() {
				$(this)
					.attr('src', source.attr('src'))
					.fadeIn(250);
			});
		}
	})
	.click(function() {
		$(this).animate({ width: '0px' }, 500, function() {
			switch ($(this).attr('class')) {
				case 'pag01': var target = $('.pag02a'); var width = '332px'; break;
				case 'pag02a': var target = $('.pag01'); var width = '332px'; break;
				case 'pag03a': var target = $('.pag02b'); var width = '377px'; break;
				case 'pag02b': var target = $('.pag03a'); var width = '377px'; break;
				case 'pag04a': var target = $('.pag03b'); var width = '422px'; break;
				case 'pag03b': var target = $('.pag04a'); var width = '422px'; break;
				case 'pag04b': var target = $('.pag05'); var width = '467px'; break;
				case 'pag05': var target = $('.pag04b'); var width = '467px'; break;
			}
			if (target) target.animate({ width: width }, 500);
		});
	});

});
</script>

<body>

<center>

<table class="folder">
	<tr class="paginas">
		<td class="left">
			<img src="/smc/folder/02.jpg" alt="02" class="pag02a" />
			<img src="/smc/folder/04.jpg" alt="04" class="pag03a" />
			<img src="/smc/folder/06.jpg" alt="06" class="pag04a" />
			<img src="/smc/folder/08.jpg" alt="08" class="pag05" />
		</td>
		<td class="right">
			<img src="/smc/folder/01.jpg" alt="01" class="pag01" />
			<img src="/smc/folder/03.jpg" alt="03" class="pag02b" />
			<img src="/smc/folder/05.jpg" alt="05" class="pag03b" />
			<img src="/smc/folder/07.jpg" alt="07" class="pag04b" />
		</td>
	</tr>
	<tr class="legenda">
		<td>
			<img src="/smc/folder/prev.png" alt="Página anterior" class="prev" />
		</td>
		<td>
			<img src="/smc/folder/next.png" alt="Próxima página" class="next" />
		</td>
	</tr>
</table>

<div id="zoom">
	<img src="" />
</div>

</center>

</body>

</html>