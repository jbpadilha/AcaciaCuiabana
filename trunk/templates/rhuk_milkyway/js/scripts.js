window.addEvent('domready',function(){
  var panel = $('kraftwerks-bottom-panel');
  if(panel){
    var panelH = panel.getSize().size.y;
    var slidefx = new Fx.Styles(panel,{duration:400,wait:false});
    
    var toggler = $('kraftwerks-bottom-panel-toggler');
    if (toggler) {
      var dir = true;
      toggler.addEvent('click', function(){
        if (dir) {
          slidefx.start({
            'height': '30px'
          });
          dir = false;
        }
        else {
          slidefx.start({
            'height': panelH + 'px'
          });
          dir = true;
        }
      });
    }
    
    var check = $('kraftwerks-checkout');
    if (check) {
      check.addEvent('click', function(e){
        new Event(e).stop();
        if (dir) {
          slidefx.start({
            'height': '200px'
          });
          dir = false;
        }
        else {
          slidefx.start({
            'height': panelH + 'px'
          });
          dir = true;
        }
      });
    }
    
  }
});
