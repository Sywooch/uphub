   $(function() {
   	
 $('.web').click(function(e){
     e.preventDefault();
   //$("#bg").attr('src',"template_preview/images/2x2.gif");
    $("#device").attr('style',"margin: 0px auto;text-align: center;");
    $("#hw").attr('class',"web");
     $("#hw").attr('height',"100%");
      $("#hw").attr('width',"100%");
 });
 $('.Ipad-vertical').click(function(e){
     e.preventDefault();
   ///$("#bg").attr('src',"template_preview/images/ipad-landscape-big.png");
     $("#device").attr('style',"margin: 1em auto;text-align: center;");
      $("#hw").attr('class',"ipad-frame-land");
    // $("#hw").attr('style',"position: absolute;	left: 7.3%;	top: 55px;");
     $("#hw").attr('height',"680");
      $("#hw").attr('width',"1024");
     
 });
$('.Ipad-hori').click(function(e){
     e.preventDefault();
   //$("#bg").attr('src',"template_preview/images/ipad-vertical-big.png");
      $("#device").attr('style',"margin: 1em auto;text-align: center;");
       //$("#hw").attr('style',"left:50px;top:135px");
       $("#hw").attr('class',"ipad-frame-ver");
      // $("#hw").attr('style',"	position: absolute;	left: 7.3%;	top: 75px;");
     $("#hw").attr('height',"1024");
      $("#hw").attr('width',"768");
        
 });
 
 
 
 $('.Iphone-vertical').click(function(e){
     e.preventDefault();
   ///$("#bg").attr('src',"template_preview/images/ipad-landscape-big.png");
     $("#device").attr('style',"margin: 1em auto;text-align: center;");
      $("#hw").attr('class',"smart-frame-var");
    // $("#hw").attr('style',"position: absolute;	left: 7.3%;	top: 55px;");
     $("#hw").attr('height',"320");
      $("#hw").attr('width',"480");
     
 });
$('.Iphone-hori').click(function(e){
     e.preventDefault();
   //$("#bg").attr('src',"template_preview/images/ipad-vertical-big.png");
      $("#device").attr('style',"margin: 1em auto;text-align: center;");
       //$("#hw").attr('style',"left:50px;top:135px");
       $("#hw").attr('class',"smart-frame-land");
      // $("#hw").attr('style',"	position: absolute;	left: 7.3%;	top: 75px;");
     $("#hw").attr('height',"480");
      $("#hw").attr('width',"320");
      });
 
 $('.mobile').click(function(e){
     e.preventDefault();
   //$("#bg").attr('src',"template_preview/images/ipad-vertical-big.png");
      $("#device").attr('style',"margin: 1em auto;text-align: center;");
       //$("#hw").attr('style',"left:50px;top:135px");
       $("#hw").attr('class',"mobile-frame");
      // $("#hw").attr('style',"	position: absolute;	left: 7.3%;	top: 75px;");
     $("#hw").attr('height',"500");
      $("#hw").attr('width',"240");
        
 });
 
 
});