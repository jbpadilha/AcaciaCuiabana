/**
 * JQuery accesskey plugin
 *
 * shortaccesskey provides a simpler way to use the access keys assigned to HTML links.
 * You will be able to use access keys by just pressing the letter you have assigned to
 * the link instead of ALT+accesskey/ALT+SHIFT+accesskey making navigation easier for your users.
 *
 * Just call $.shortaccesskey.init() in $(document).ready
 *
 * @name shortaccesskey
 * @type jquery
 * @cat Plugin/Navigation
 * @return JQuery
 * @author Aditya Mooley <adityamooley@sanisoft.com>
 */

$.shortaccesskey = {
  accesskeyArr: Array(),

  init: function () {
    var i = 0;
    $("a[@accesskey]").each (function() {
      $.shortaccesskey.accesskeyArr[i] = $(this).attr('accesskey');
      i++;
    });
  
    $(document).keypress($.shortaccesskey.handleKeyPress);
  
    $("input,textarea,select").focus(function() {
      $(document).unbind();
    });
  
    $("input,textarea,select").blur(function() {
      $(document).keypress($.shortaccesskey.handleKeyPress);
    });
  },

  handleKeyPress: function(e) {
    var e = e || window.event;
    //var k = e.charCode ? e.charCode : e.keyCode ? e.keyCode : e.which;
    //keyCode - IE , charCode - NS6+
    var k = e.charCode || e.keyCode || 0; 
    var keyPressed = String.fromCharCode(k);
    if ($.inArray(keyPressed, $.shortaccesskey.accesskeyArr) >= 0) {
      window.location = $("a[@accesskey="+keyPressed+"]").attr("href");
    }
  }
};