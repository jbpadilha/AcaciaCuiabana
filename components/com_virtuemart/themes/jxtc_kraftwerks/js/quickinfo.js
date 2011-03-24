window.addEvent('domready',function(){
  
  /* Get window dimensions */
  var wsize = window.getSize();
  
  /* Pop-Up dimensions */
  var psize = {'x':350,'y':250};
  
  /* Collect Quick Info Wraps */
  var qwraps = $$('div.quickinfo-wrapper');
  
  /* For each Quick Info Wraper */
  qwraps.each(function(w,i){
    
    /* Get the button and content */
    var qbutton = w.getElement('a.quickinfo');
    var qcontent = w.getElement('div.quickinfo-container');
    
    /* Validate button and content */
    if(qbutton && qcontent){
      
      /* Get close button */
      var qclose = qcontent.getElement('a.quickinfo-close');
      
      /* Get the content ready */
      qcontent.setStyles({
        'position':'fixed',
        'overflow':'hidden',
        'top':((wsize.size.y - psize.y)/2) + 'px',
        'left':((wsize.size.x - psize.x)/2) + 'px',
        'width':'0px',
        'height':'0px',
        'background':'#FFF',
        'border':'1px solid #000'
      });
      
      /* Create the Fx object */
      var qfx = new Fx.Styles(qcontent, {duration: 500, transition: Fx.Transitions.linear});
      
      /* Add button event on click */
      qbutton.addEvent('click',function(e){
        
        new Event(e).stop(); 
        
        qcontent.setStyles({
          'display':'block',
        });
        
        /* Animate the content block */
        qfx.start({
          'width':psize.x + 'px',
          'height':psize.y + 'px'
        }); 
        
        qclose.addEvent('click',function(e){
          
          new Event(e).stop(); 
          
          /* Reset content */
          qcontent.setStyles({
            'display':'none',
            'width':'0px',
            'height':'0px',
          });
          
        });

        
      });
      
    }
    
  });
  
});
