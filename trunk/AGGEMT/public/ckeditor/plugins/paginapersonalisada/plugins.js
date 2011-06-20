(function() {
var o = { exec: function(p) {
url = baseUrl + "/GetSomeData";
$.post(url, function(response) {
alert(response)
});
}
};
CKEDITOR.plugins.add('paginapersonalisada', {
init: function(editor) {
editor.addCommand('paginapersonalisada', o);
editor.ui.addButton('paginapersonalisada', {
label: 'paginapersonalisada',
icon: this.path + 'anchor.png',
command: 'paginapersonalisada'
});
}
});
})();